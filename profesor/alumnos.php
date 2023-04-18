<?php
    require_once 'includes/header.php';
    require_once 'includes/modals/modal_alumno_profesor.php';
    require_once '../includes/conexion.php';

    //consultar la lista de estudiantes que pertenecen al curso
    $sql = "SELECT * FROM alumno_profesor INNER JOIN alumnos ON alumno_profesor.alumno_id = alumnos.alumno_id WHERE pm_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($_GET['curso']));
    $row = $query->rowCount();
    //$result = $query->fetchAll(PDO::FETCH_ASSOC);
    //print_r($result);
?>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Lista de Proceso Alumnos</h1>
          <button class="btn btn-success" type="button" onclick="openModalAlumnoProfesor(<?= $_GET['curso'] ?>)">Agregar Alumno</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de proceso alumnos</a></li>
        </ul>
      </div>
      <div class="row">     
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablealumnoprofesor">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE DEL ALUMNO</th>
                      <th>Correo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($row > 0) {
                      while ($data = $query->fetch()) {
                        ?>
                        <tr>
                          <td>
                            <button class="btn btn-danger icon-btn" onclick="eliminarAlumnoProfesor(<?=$data['ap_id']; ?>)">
                            <i class="fa fa-trash"></i>Eliminar alumno</button>
                          </td>
                          <td><?= $data['alumno_id'] ?></td>
                          <td><?= $data['nombre_alumno'] . " " . $data['apellido'] ?></td>
                          <td><?= $data['correo'] ?></td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php
    require_once 'includes/footer.php';
?>