<div class="modal fade" id="modalTarea" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Laboratorio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formTarea" name="formTarea">
        <input type="hidden" name="idtarea" id="idtarea" value="">
        <div class="form-group">
                <label for="listEstado">Seleccione Laboratorio</label>
                <select class="form-control" name="listMateria" id="listMateria">
                    <!-- CONTENIDO AJAX -->
                </select>
            </div>
        
        <div class="form-group">
            <label for="control-label">Titulo de la Tarea:</label>
            <input type="text" class="form-control" name="titulo" id="titulo">
          </div>
          <div class="form-group">
            <label for="control-label">Adjuntar Imagen</label>
            <input type="file" class="form-control" name="file" id="file">
          </div>

          <div class="form-group">
            <label for="control-label">Descripcion :</label>
            <textarea name="descripcion" class="form-control"id="descripcion" rows="4"></textarea>
          </div>
         
          <div class="form-group">
            <label for="control-label">codigo unitario:</label>
            <textarea name="codigo" class="form-control"id="codigo" rows="4"></textarea>
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