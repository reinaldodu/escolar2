<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idmateria = $_POST['idmateria'];

    $sql = "SELECT * FROM laboratorios WHERE materia_id = ?";
    $query = $pdo->prepare(($sql));
    $query->execute(array($idmateria));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if(!empty($data)){
        $sql = "DELETE * FROM laboratorios WHERE materia_id = ?";
        $query = $pdo->prepare(($sql));
        $query->execute(array($idmateria));
        $data = $query->fetch(PDO::FETCH_ASSOC);
    }

    $sql = "SELECT * FROM profesor_materia WHERE materia_id = ?";
    $query = $pdo->prepare(($sql));
    $query->execute(array($idmateria));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if(!empty($data)){
        $sql = "DELETE * FROM profesor_materia WHERE materia_id = ?";
        $query = $pdo->prepare(($sql));
        $query->execute(array($idmateria));
        $data = $query->fetch(PDO::FETCH_ASSOC);
    }

    $sql = "SELECT * FROM alumno_profesor WHERE pm_id = ?";
    $query = $pdo->prepare(($sql));
    $query->execute(array($idmateria));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if(!empty($data)){
        $sql = "DELETE * FROM alumno_profesor WHERE pm_id = ?";
        $query = $pdo->prepare(($sql));
        $query->execute(array($idmateria));
        $data = $query->fetch(PDO::FETCH_ASSOC);
    }

    $sqle = "SELECT * FROM materias WHERE materia_id = ?";
    $querye = $pdo->prepare(($sqle));
    $querye->execute(array($idmateria));
    $data2 = $querye->fetch(PDO::FETCH_ASSOC);

    if(!empty($data2)){
        $sql_update = "DELETE FROM materias WHERE materia_id = ?";
        $query_update = $pdo->prepare($sql_update);
        $result = $query_update->execute(array($idmateria));
        if($result){
            $arrResponse = array('status' => true,'msg' => 'Eliminada Correctamente');
        } else {
            $arrResponse = array('status' => false,'msg' => 'Error al eliminar');
        }
    } else {
        $arrResponse = array('status' => false,'msg' => 'No se puede eliminar, ya tiene una evaluacion asignada');
    }

    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
}