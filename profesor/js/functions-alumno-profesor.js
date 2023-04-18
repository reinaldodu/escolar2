    var formAlumnoProfesor = document.querySelector('#formAlumnoProfesor');
    formAlumnoProfesor.onsubmit = function(e) {
        e.preventDefault();

        var email_alumno = document.querySelector('#email_alumno').value;

        if(email_alumno == '') {
            swal('Atencion','Ingrese el email del alumno','error');
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumno-profesor/ajax-alumno-profesor.php';
        var form = new FormData(formAlumnoProfesor);
        request.open('POST',url,true);
        request.send(form);
        console.log(request);
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalAlumnoProfesor').modal('hide');
                    location.reload();
                    formAlumnoProfesor.reset();
                    swal('Crear Proceso Alumno',data.msg,'success');
                    tablealumnoprofesor.ajax.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }
    
    

function openModalAlumnoProfesor(pm_id) {
    console.log(pm_id)
    document.querySelector('#pm_id').value = pm_id;
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Proceso Alumno';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAlumnoProfesor').reset();
    $('#modalAlumnoProfesor').modal('show');
}

window.addEventListener('load',function(){
    showAlumno();
},false);



function showAlumno() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/options/options-alumno.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor){
                data += '<option value="'+valor.alumno_id+'">'+valor.nombre_alumno+'</option>';
            });
            document.querySelector('#listAlumno').innerHTML = data;
        }
    }
}


function editarAlumnoProfesor(id) {
    var idalumnoprofesor = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Proceso Alumno';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumno-profesor/edit-alumno-profesor.php?id='+idalumnoprofesor;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idalumnoprofesor').value = data.data.ap_id;
                    document.querySelector('#listAlumno').value = data.data.alumno_id;
                    document.querySelector('#listAProfesor').value = data.data.pm_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#listEstado').value = data.data.estadop;

                    $('#modalAlumnoProfesor').modal('show');
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
}

function eliminarAlumnoProfesor(id) {
    var idalumnoprofesor = id;

    swal({
        title: "Eliminar Alumno",
        text: "Realmente desea eliminar el alumno?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    },function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/alumno-profesor/delet-alumno-profesor.php';
            request.open('POST',url,true);
            var strData = "id="+idalumnoprofesor;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Eliminar',data.msg,'success');
                        //tablealumnoprofesor.ajax.reload();
                        location.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}