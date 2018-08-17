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
            <div class="btn-group pull-right">
              <button type='button' class="btn btn-info" data-toggle="modal" data-target="#NuevoUsuarioModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Usuario</button>
            </div>
            <h4><i class='glyphicon glyphicon-edit'></i> Usuarios del Sistema</h4>
            </div>
            <div class="panel-body">
              <?php
                include('/modal/NuevoUsuario.php');
              ?>
            </div><!-- fin panel body-->
      </div>
    </div>
  </div>
</body>

<footer>
   <?php include '/Plantilla/footer.php'; ?>
</footer>
</html>
