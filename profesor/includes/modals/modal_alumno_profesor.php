<div class="modal fade" id="modalAlumnoProfesor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Proceso Alumno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAlumnoProfesor" name="formAlumnoProfesor">
            <input type="hidden" name="pm_id" id="pm_id" value="">
            <div class="form-group">
                <label for="email_alumno">Escriba el email del alumno</label>
                <input type="text" class="form-control" name="email_alumno" id="email_alumno">
            </div>
            
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button class="btn btn-primary" id="action" type="submit">Guardar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>