<?php
    //validar si el usuario inicio session en la app
    include 'config/session_expire.php';

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
      include 'Plantilla/header.php';
    ?>
    <script type="text/javascript" src="js/lista_usuarios.js"></script>
    <script type="text/javascript" src="js/usuario.js"></script>
    <script type="text/javascript" src="js/select_cliente.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#NuevoUsuarioModal').on('hidden.bs.modal',function(e){
          $('.form-control').val('');
          $('#btn_save').attr('disable',false);
        });
      });
    </script>
</head>

<body data-spy="scroll" data-target="#myScroll" data-offset="20" onload="getUsuarios()">
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
            <div class="btn-group pull-right">
              <button type='button' class="btn btn-info" data-toggle="modal" data-target="#NuevoUsuarioModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Usuario</button>
            </div>
            <h4><i class='glyphicon glyphicon-edit'></i> Usuarios del Sistema</h4>
            </div>
            <div class="panel-body">
              <?php
                include('modal/NuevoUsuario.php');
              ?>
              <p><h3>Listado usuarios activos</h3></p>
              <div id="show_data">
            </div><!-- fin panel body-->
      </div>
    </div>
  </div>
</body>

<footer>
   <?php include 'Plantilla/footer.php'; ?>
</footer>
</html>
