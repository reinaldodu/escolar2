<?php

require_once '../../../includes/conexion.php';

if(!empty($_POST))
{
    if(empty($_POST['nombre'])) {
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else {
        $idmateria = $_POST['idmateria'];
        $idprofesor = $_POST['idprofesor'];
        $nombre = $_POST['nombre'];
        $material = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $url_temp = $_FILES['file']['tmp_name'];

        $directorio = '../../../uploads/'.rand(1000,10000);
        if(!file_exists(($directorio))){
            mkdir($directorio, 0777, true);
        }

        $destino = $directorio.'/'.$material;

        $sql = 'SELECT * FROM materias WHERE nombre_materia = ? AND materia_id != ? ';
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idmateria));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($_FILES['file']['size'] > 1500000){
            $respuesta = array('status' => false,'msg' => 'Solo se permiten archivos hasta 15MB');
        } 
        else {

        if($result > 0) {
            $respuesta = array('status' => false,'msg' => 'La materia ya existe');
        } else {
            if($idmateria < 0) {
                $estado=1;
                $sqlInsert = 'INSERT INTO materias (nombre_materia) VALUES (?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre));
                // Agregar el id de la materia a la tabla de profesor_materia
                $idmateria = $pdo->lastInsertId();
                $sqlInsert = 'INSERT INTO profesor_materia (profesor_id,materia_id) VALUES (?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($idprofesor,$idmateria));
                $accion = 1;
            } else {
                    $sqlUpdate = 'UPDATE materias SET nombre_materia = ?,estado = ? WHERE materia_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idmateria));
                    // actualizar el id de la materia en la tabla de profesor_materia
                    $sqlUpdate = 'UPDATE profesor_materia SET materia_id = ? WHERE profesor_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($idmateria,$idprofesor));
                    $accion = 2;
            }  

            if($request > 0) {
                if($accion == 1) {
                    $respuesta = array('status' => true,'msg' => 'Materia creada correctamente');
                } else {
                    $respuesta = array('status' => true,'msg' => 'Materia actualizada correctamente');
                }
            } else {
                $respuesta = array('status' => false,'msg' => 'No es posible almacenar los datos');
            }
        }
    }
}
echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}


