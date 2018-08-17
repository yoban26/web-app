<?php

    session_start();

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
      $title = "Asignar";
      include '/Plantilla/header.php';
    ?>
    <script type="text/javascript" src="js/buscar_asignaciones.js"></script>
    <script type="text/javascript" src="js/guardar_asignacion.js"></script>
    <script type="text/javascript" src="js/delete.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" href="css/notification.css">
    <link rel="stylesheet" href="css/snackbar.css">
    <script type="text/javascript">
      $(document).ready(function(){
        $('#NewAsignModal').on('hidden.bs.modal',function(e){
          $('.form-control').val('');
          $('#result').html('');
          //verificar si el boton de asignar esta habilitado
          document.getElementById("guadar_datos").disable = false;
        })
      })
    </script>
</head>

<body>
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
              <!--<button type='button' class="btn btn-info" data-toggle="modal" data-target="#NewAsignModal" id="btn_asign"><span class="glyphicon glyphicon-plus" ></span> Nueva Asignacion</button>-->
              <button type='button' class="btn btn-info" data-toggle="modal" data-target="#NewAsignModal" id="btn_asign"><span class="glyphicon glyphicon-plus" ></span> Nueva Asignacion</button>
            </div>
            <h4><i class='glyphicon glyphicon-edit'></i> Asignar Cuestionario</h4>
          </div>
          <div class="panel-body">
            <?php
              //agregar aqui los modal
              include("modal/asignar_cuestionario.php");
            ?>
            <p><h4>Consultar los cuestionarios asignados actualmente.</h4></p>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Tipo Usuario</div>
                            <div class="panel-body">
                                <select class="form-control" id="tipo_usuario">
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
                            </div><!-- panel body-->
                          </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Tipo Cliente</div>
                            <div class="panel-body">
                                <select class="form-control" id="tipo_cliente">
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
                          </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2">
                        <button type="button" class="btn btn-primary btn-md" style="align-content: center" id="btn_buscar" onclick="getAsignaciones()">
                            Consultar
                        </button>
                    </div>
                </div>
            </div>
            <div id="snackbar"></div>
          </div><!-- fin panel body-->
        </div><!-- final panel info-->
        <p><h3>Listado cuestionarios asignados</h3></p>
        <div id="show_data">
        </div>
        <span id="show"></span>
      </div><!-- final container -->
    </div><!-- final wrapper -->
</body>
<footer>
   <?php include '/Plantilla/footer.php'; ?>
</footer>
</html>
