<div class="modal fade" tabindex="-1" role="dialog" id="NuevoUsuarioModal" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Crear Nuevo Usuario</h4>
      </div>
      <div class="modal-body">
          <div id="show_advice"></div>
          <form action="" method="" onsubmit="">
          <!-- datos del usuario -->
          <div class="row">
            <div class="col-lg-8 col-sm-6">
              <!-- nombre usuario -->
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" placeholder="ingresa nombre" name="nombre" required>
              </div>
              <!-- apellido usuario -->
              <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" placeholder="ingresa apellido" name="apellido" required>
              </div>
              <!-- username -->
              <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" placeholder="ingresa usuario" name="usuario" required>
              </div>
              <!-- password -->
              <div class="form-group">
                <label for="password">Contrase&ntilde;a:</label>
                <input type="password" class="form-control" id="password" placeholder="ingresa contrase&ntilde;a" name="password" required>
              </div>
              <!-- confirmacion password -->
              <div class="form-group">
                <label for="password_confirm">Repita Contrase&ntilde;a:</label>
                <input type="password" class="form-control" id="password_confirm" placeholder="repita contrase&ntilde;a" name="password_confirm" required>
              </div>
              <span id="show_error"></span>
              <!-- estado -->
              <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control" id="estado" name="estado" required>
                  <option value="">Seleccion el estado</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
              <!-- asignar tipo usuario -->
              <div class="form-group">
                <label for="usuario">Rol de Usuario:</label>
                <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                  <option value="">Seleccione el rol de usuario</option>
                  <?php
                    $tipo_usuario = "SELECT * FROM master_user_type";
                    $result = mysqli_query($conn,$tipo_usuario);

                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=".$row["id_user_type"].">".$row["nombre"]."</option>";
                        }
                    }
                  ?>
                </select>
              </div>
              <!-- region -->
              <div class="form-group">
                <label for="estado">Region:</label>
                <select class="form-control" id="region_id" name="region_id" onchange="buscar_cliente(this.value)" required>
                  <option value="">Seleccione la region</option>
                  <?php
                    $query="SELECT id_master_region,nombre_region FROM master_region WHERE id_master_region != 7 ORDER BY nombre_region ASC";
                    $result = mysqli_query($conn,$query);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=".$row["id_master_region"].">".$row["nombre_region"]."</option>";
                        }
                    }
                  ?>
                </select>
              </div>
              <div class="form-group" id="id_cliente">
              </div>
              <!-- botones -->
              <div>
                <!-- enviar datos -->
                <button type="button" id="btn_save" class="btn btn-primary" onclick="guardar_usuario();" data-backdrop="static" data-keyboard="false" aria-hidden="true">Guardar</button>
                <!-- limpiar formulario -->
                <button type="reset" class="btn btn-primary" id="btn_clean">Limpiar</button>
                <!-- cancelar la digitacion del nuevo cliente -->
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_cancel">Cancelar
                  </button>
                </div>
              </div>
            </div>
        </form>
      </div><!-- final panel body-->
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
