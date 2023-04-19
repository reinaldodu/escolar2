<?php

require_once '../../../includes/conexion.php';

//eliminar una materia y sus relaciones (laboratorios, profesor_materia, alumno_profesor)
if($_POST) {
    $idmateria = $_POST['idmateria'];

    //Eliminar la materia
    $sql = "DELETE FROM materias WHERE materia_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idmateria));

    //Eliminar la imagen de la carpeta images/materias del directorio del profesor
    $ruta = '../../../images/materias/'.$idmateria.'.jpg';
    $ruta2 = '../../../images/materias/'.$idmateria.'.png';
    //verificar si existe la imagen
    if(file_exists($ruta)) {
        unlink($ruta);
    } else if(file_exists($ruta2)) {
        unlink($ruta2);
    }
    

    //Eliminar las relaciones de la materia con los laboratorios
    $sql = "DELETE FROM laboratorios WHERE materia_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idmateria));

    //Eliminar las relaciones de la materia con los profesores
    $sql = "DELETE FROM profesor_materia WHERE materia_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idmateria));

    //Eliminar las relaciones de la materia con los alumnos
    $sql = "DELETE FROM alumno_profesor WHERE pm_id IN (SELECT pm_id FROM profesor_materia WHERE materia_id = ?)";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idmateria));

    if($result) {
        $arrResponse = array('status' => true,'msg' => 'Materia eliminada correctamente');
    } else {
        $arrResponse = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
}