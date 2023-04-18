<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idalumnoprofesor = $_POST['id'];

    $sql = "DELETE FROM alumno_profesor WHERE ap_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idalumnoprofesor));
    
    if($result) {
        $respuesta = array('status' => true,'msg' => 'Alumno eliminado correctamente');
    } else {
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}