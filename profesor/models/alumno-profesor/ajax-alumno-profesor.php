<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST)) {
    if(empty($_POST['email_alumno'])) {
        $arrResponse = array('status' => false,'msg' => 'Ingrese el email del estudiante');
    } 
    else {
        $email_alumno = $_POST['email_alumno'];
        $pm_id = $_POST['pm_id'];
        // Buscar si el el email del alumno existe en la tabla alumnos
        $sql = "SELECT * FROM alumnos WHERE correo = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($email_alumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        //si existen datos en la consulta obtener el id del alumno
        if($result > 0) {
            $alumno = $result['alumno_id'];
            //Verificar si el alumno existe en la tabla alumno_profesor
            $sql = "SELECT * FROM alumno_profesor WHERE alumno_id = ? AND pm_id = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($alumno,$pm_id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            //si el alumno ya existe en la tabla alumno_profesor enviar un mensaje de error
            if($result > 0) {
                $arrResponse = array('status' => false,'msg' => 'El alumno ya existe en el curso');
            } else {
                //Insertar el registro
                $sql_insert = "INSERT INTO alumno_profesor (alumno_id,pm_id) VALUES (?,?)";
                $query_insert = $pdo->prepare($sql_insert);
                $request = $query_insert->execute(array($alumno,$pm_id));
                if($request) {
                    $arrResponse = array('status' => true,'msg' => 'Alumno creado correctamente'); 
                }
            }

        } else {
            $arrResponse = array('status' => false,'msg' => 'El email del alumno no existe, verifique');
        }
    }
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
}
?>


