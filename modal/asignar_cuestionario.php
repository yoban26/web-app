<!-- Modal -->
<div class="modal fade" id="NewAsignModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Asignar cuestionario</h4>
    </div><!-- modal header -->

    <span id="result" class="result"></span>
    <div class="modal-body">
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

          <div class="form-group">
            <label for="nombre" class="col-sm-3 control-label">Tipo Cliente</label>
            <div class="col-sm-8">
              <select class="form-control" id="tipo_cliente_modal" name="tipo_cliente_modal" required>
                  <option value="">Selecciona tipo cliente</option>
                  <?php
                    $query_tipo="SELECT id_tipo_cliente,nombre FROM tipo_cliente ORDER BY nombre ASC";
                    $result1 = mysqli_query($conn_db,$query_tipo);
                    if(mysqli_num_rows($result1)>0){
                        while($row = mysqli_fetch_assoc($result1)) {
                            echo "<option value=".$row["id_tipo_cliente"].">".$row["nombre"]."</option>";
                        }
                    }
                  ?>
              </select>
            </div>
          </div><!-- form group -->

          <div class="form-group">
            <label for="precio" class="col-sm-3 control-label">Cuestionario</label>
            <div class="col-sm-8">
              <select class="form-control" id="cuestionario_modal" name="cuestionario_modal" required>
                          <option value="">Selecciona cuestioanrio</option>
                          <?php
                            $query_tipo="SELECT id_cuestionario,nombre FROM cuestionario WHERE region = '".$id_region."' ORDER BY nombre ASC";
                            $result1 = mysqli_query($conn_db,$query_tipo);
                            if(mysqli_num_rows($result1)>0){
                                while($row = mysqli_fetch_assoc($result1)) {
                                    echo "<option value=".$row["id_cuestionario"].">".$row["nombre"]."</option>";
                                }
                            }
                          ?>
              </select>
            </div>
          </div><!-- form group-->

          <div id="show_advice">
          </div>

        </div><!-- modal body -->

        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" id="btn_cancel" data-dismiss="modal" onclick="clear()">Cancelar</button>-->
          <button type="button" class="btn btn-default" id="btn_cancel" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="guardar_datos" data-keyboard="false" data-backdrop="static" onclick="guardar()">Asignar</button>
        </div><!-- modal footer -->

      </form><!-- form -->
    </div><!-- modal content -->
  </div><!-- modal dialog -->
</div><!-- modal -->
