<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Modificar Rol de Usuario</h4>
      </div>
      <div class="modal-body">
        <div id="show_advice"></div>
        <form class="form-horizontal" method="post" id="guardar_asignacion" name="guardar_asignacion">
          <div class="form-group">
            <label for="tipo_usuario_modal" class="col-sm-3 control-label">Tipo Usuario</label>
            <div class="col-sm-8">
              <select class="form-control" id="tipo_usuario_modal" name="tipo_usuario_modal" required>
                  <option value="">Selecciona tipo usuario</option>
                  <?php
                    $query="SELECT id_user_type,name_type FROM user_type WHERE id_user_type != 5 ORDER BY name_type ASC";
                    $result = mysqli_query($conn_db,$query);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=".$row["id_user_type"].">".$row["name_type"]."</option>";
                        }
                    }
                  ?>
              </select>
            </div>
          </div><!-- form-group -->
        </form>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" id="btn_cancel" data-dismiss="modal" onclick="clear()">Cancelar</button>-->
          <button type="button" class="btn btn-default" id="btn_cancel" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="guardar_datos" data-keyboard="false" data-backdrop="static" onclick="update()">Modificar</button>
      </div>
    </div>

  </div>
</div>
