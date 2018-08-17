<div class="modal fade" tabindex="-1" role="dialog" id="NewTipoUsuarioModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Asignar nuevo cuestionario</h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal" method="POST" id="guardar_asignacion" name="guardar_asignacion">

          <!-- tipo usuario -->
          <div class="form-group">
            <label for="estado" class="col-sm-3 control-label">Tipo Usuario:</label>
              <div class="col-sm-8">
                    <select class="form-control" id="estado" name="estado" required>
                      <option value="">-- Selecciona estado --</option>
                      <option value="1" selected>Activo</option>
                      <option value="0">Inactivo</option>
                   </select>
              </div>
          </div>

          <!-- tipo cliente -->
          <div class="form-group">
            <label for="estado" class="col-sm-3 control-label">Tipo Cliente:</label>
              <div class="col-sm-8">
                    <select class="form-control" id="estado" name="estado" required>
                      <option value="">-- Selecciona estado --</option>
                      <option value="1" selected>Activo</option>
                      <option value="0">Inactivo</option>
                   </select>
              </div>
          </div>

          <!-- nombre cuestioanrio -->
          <div class="form-group">
            <label for="estado" class="col-sm-3 control-label">Cuestionario:</label>
              <div class="col-sm-8">
                    <select class="form-control" id="estado" name="estado" required>
                      <option value="">-- Selecciona estado --</option>
                      <option value="1" selected>Activo</option>
                      <option value="0">Inactivo</option>
                   </select>
              </div>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
