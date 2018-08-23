<?php

    include 'config/session_expire.php';

    //validar si el usuario inicio session en la app
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
        //parametros que dependen del usuario
        //evaluar los valores de nombre_db e id_region
        if(!isset($_SESSION['nombre_db']) && !isset($_SESSION['id_region'])){
          echo '<div class="alert alert-warning alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Aviso!</strong> Debe seleccionar region y cliente en el dashboard.
                </div>';
        }else{
          //si esta definida, guardar el valor
          $nombre_db = $_SESSION['nombre_db'];
          $id_region = $_SESSION['id_region'];
          //variable para conectar a la db dependiente el cliente
          $conn_db = $con->conectar_db($nombre_db);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <?php
      $title = "Gestionar Usuario";
      include 'Plantilla/header.php';
    ?>
    <script type="text/javascript" src="js/buscar_usuario.js"></script>
    <link rel="stylesheet" href="css/snackbar.css">
    <script type="text/javascript" src="js/update.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#myModal').on('hidden.bs.modal',function(e){
          $('.form-control').val('');
          $('#show_advice').html('');
          //verificar si el boton de asignar esta habilitado
          $("#guardar_datos").removeAttr('disabled');
        });
      });
    </script>
</head>

<body>
    <?php
      if(strcmp($user_type,"1")==0){
        include 'Plantilla/navbar.php';
      }else{
        include 'Plantilla/navbar_consultor.php';
      }
    ?>

    <div class="wrapper">
      <div class="container">

        <div class="panel panel-info">
          <div class="panel-heading">
            <h4><i class='glyphicon glyphicon-edit'></i> Gestionar Usuarios</h4>
            </div>
            <div class="panel-body">
              <?php
                include('modal/ModificarRol.php');
              ?>
              <form class="form-horizontal" role="form" id="datos_cotizacion">
                  <div class="form-group row">
                    <label for="q" class="col-md-2 control-label">Usuario</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" id="name_user" placeholder="ingrese nombre o usuario" onkeydown="return (event.keyCode!=13);">
                    </div>
                    <div class="col-md-3">
                      <button type="button" class="btn btn-default" onclick="getUsuario()">
                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                      <span id="loader"></span>
                    </div>
                  </div>
              </form>
              <div id="snackbar"></div>
              <input type="hidden" id="aux">
            </div><!-- fin panel body-->
      </div><!-- fin panel info -->
      <div id="result"></div>
    </div><!-- fin de container -->
  </div><!-- fin de wrapper -->
</body>

<footer>
   <?php include 'Plantilla/footer.php'; ?>
</footer>
</html>
