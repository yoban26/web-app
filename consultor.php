<?php

    session_start();

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
        $title = "Dashboard | Consultor";
        include '/Plantilla/header.php';
    ?>
</head>
<body>
    <nav>
        <?php
            include '/Plantilla/navbar_consultor.php';
        ?>
    </nav>

        <?php
          /* comprobar la conexión */
          if (mysqli_connect_errno()) {
              //si hay algun error al conectar a la base de datos
              printf("Falló la conexión: %s\n", mysqli_connect_error());
              exit();
          }else{
            //obtener el nombre de la region del usuario
            $query = "SELECT master_region.id_master_region as id_region,master_region.nombre_region FROM master_region_user,master_region WHERE master_region_user.region = master_region.id_master_region AND master_region_user.username = '".$username."' ";
            $result = mysqli_query($conn,$query);

            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)) {
                    $id_region = $row["id_region"];
                    $nombre_region = $row["nombre_region"];
                }
            }
            echo "<p> Region: ".$id_region."</p>";
            echo "<p> Nombre Region: ".$nombre_region."</p>";
        }
        ?>

        <?php
          if (mysqli_connect_errno()) {
              //si hay algun error al conectar a la base de datos
              printf("Falló la conexión: %s\n", mysqli_connect_error());
              exit();
          }else{
            if(!empty($id_region)){
              echo "<br>";
              $query_cliente = "SELECT master_cliente.nombre_db FROM master_user_cliente,master_cliente WHERE master_user_cliente.cliente = master_cliente.id_master_cliente AND master_user_cliente.username = '".$username."' ";
              $result_db = mysqli_query($conn,$query_cliente);

              if(mysqli_num_rows($result_db)>0){
                  while($row = mysqli_fetch_assoc($result_db)) {
                      $nombre_db = $row["nombre_db"];
                      $_SESSION['nombre_db'] = $nombre_db;
                  }
              }
              echo "Nombre db a conectar: ".$nombre_db;
            }else{
              echo "id_region es nulo";
            }
          }

          mysqli_close($conn);
        ?>

        <?php
            $con1 = new Conexion();
            $conn_db = $con1->conectar_db($nombre_db);
            echo "<br>";
            if (mysqli_connect_errno()) {
                //si hay algun error al conectar a la base de datos
                printf("Falló la conexión: %s\n", mysqli_connect_error());
                exit();
            }else{
              $query_region = "SELECT id_region FROM region WHERE nombre LIKE '%".$nombre_region."%' ";
              $result_reg= mysqli_query($conn_db,$query_region);

              if(mysqli_num_rows($result_reg)>0){
                  while($row = mysqli_fetch_assoc($result_reg)) {
                      $id_region = $row["id_region"];
                      $_SESSION['id_region'] = $id_region;
                  }
              }

              echo "id region de db conectado: ".$id_region;
          }
          mysqli_close($conn_db);
        ?>
    <footer>
        <?php
            include '/Plantilla/footer_buttom.php';
        ?>
    </footer>
</body>
</html>
