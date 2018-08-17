<?php
    //validar si el usuario inicio session en la app
    session_start();
	if ($_SESSION['login_status'] != 1) {
        header("location: login.php");
		exit;
    }else{
        /*incluir script de conexion*/
        include('connect.php');
        /*crear instancia de la clase conexion*/
        $con = new Conexion;
        /*usar metodo de conectar*/
        $conn = $con->conectar();
        $username = $_SESSION['username'];
        $user_type = $_SESSION['user_type'];
    }

?>

<!DOCTYPE html>
<html>
<head>
    <?php
      $title = "Nuevo Usuario";
      include '/Plantilla/header.php';
    ?>
    <script type="text/javascript" src="js/asignacion.js"></script>
    <script>
      function validatePassword(){
        var pass = document.getElementById("password").value;
        var pass_conf = document.getElementById("password_confirm").value;
        var error = "";
        if(pass != pass_conf){
          error = '<div class="alert alert-danger">'+
                  '<strong>Aviso!</strong> Las contrase&ntilde;as ingresadas no coinciden.'+
                  '</div>';
          //error = "error gorrso";
          document.getElementById("show_error").innerHTML = error;
          return false;
        }
      }
    </script>
</head>

<body data-spy="scroll" data-target="#myScroll" data-offset="20">
    <?php
      if(strcmp($user_type,"1")==0){
        include '/Plantilla/navbar.php';
      }else{
        include '/Plantilla/navbar_consultor.php';
      }
    ?>

    <div class="wrapper">
      <div class="container">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4><i class='glyphicon glyphicon-edit'></i> Nuevo Usuario</h4>
          </div>
            <div class="panel-body">
              <div class="container">
                <form action="controller/NuevoUsuarioController.php" method="post" onsubmit="return validatePassword();">
                <!-- datos del cliente -->
                <div class="row">
                  <div class="col-sm-6 col-md-4 col-md-offset-4">
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
                    <span id="show_error">
                    </span>
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
                    <!-- botones -->
                    <div>
                      <!-- enviar datos -->
                      <button type="submit" class="btn btn-primary">Guardar
                      </button>

                      <!-- limpiar formulario -->
                      <button type="reset" class="btn btn-primary">Limpiar</button>
                      <!-- cancelar la digitacion del nuevo cliente -->
                      <button type="button" class="btn btn-primary" onclick="cancelar()">Cancelar
                        <?php
                          if(strcmp($_SESSION['user_type'],"1")==0){
                        ?>
                        <script type="text/javascript">
                          function cancelar(){
                            alert('desea salir?');
                            window.location.href='administrador.php';
                          }
                        </script>
                        <?php
                          }else{
                        ?>
                        <script type="text/javascript">
                          function cancelar(){
                            alert('desea salir?');
                            window.location.href='consultor.php';
                          }
                        </script>
                        <?php
                          }
                        ?>
                        </button>
                      </div>
                    </div>
                  </div>
              </form>
          </div>
        </div><!-- fin panel body-->
      </div>
    </div>
  </div>
</body>

<footer>
   <?php include '/Plantilla/footer.php'; ?>
</footer>
</html>
