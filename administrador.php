<?php
    include 'config/session_expire.php';

    //validar si el usuario inicio session en la app
	  if ($_SESSION['login_status'] != 1) {
        header("location: login.php");
		    exit;
    }else{
        $username = $_SESSION['username'];
        /*incluir script de conexion*/
        include('connect.php');
        /*crear instancia de la clase conexion*/
        $con = new Conexion;
        /*usar metodo de conectar*/
        $conn = $con->conectar();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <?php
        $title = "Dashboard | Administrador";
        include 'Plantilla/header.php';
    ?>
    <script type="text/javascript" src="js/llenar_cliente.js"></script>
</head>
<body>
    <?php
        include 'Plantilla/navbar.php';
    ?>
    <div class="wrapper">
      <div class="container">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4><i class='glyphicon glyphicon-edit'></i> Seleccionar lo siguiente</h4>
          </div>
          <div class="panel-body" id="replace_data">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-2">
                <label for="region_id">Region</label>
                <select class="form-control" id="region_id" name="region_id" onchange="buscar_cliente(this.value)">
                  <option value="">Selecciona la region</option>
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
            </div><!-- end row -->
            <div class="row" id="id_cliente">
            </div><!-- end row -->
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-2">
                <button type="button" class="btn btn-success" id="btn_aceptar" onclick="setParameters()">Aceptar</button>
                <button type="button" class="btn btn-primary" id="btn_cancelar">Cancelar</button>
              </div>
            </div><!-- end row -->
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/admin_parameters.js"></script>
</body>
<footer>
    <?php
        include 'Plantilla/footer_buttom.php';
    ?>
</footer>
</html>
