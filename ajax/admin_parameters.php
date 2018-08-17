<?php
    //validar si el usuario inicio session en la app
    session_start();
    	if ($_SESSION['login_status'] != 1) {
            header("location: login.php");
    		exit;
      }else{
        $username = $_SESSION['username'];
        /*incluir script de conexion*/
    	  include('../connect.php');
        /*crear instancia de la clase conexion*/
    	  $con = new Conexion;
    	  /*usar metodo de conectar*/
    	  $conn = $con->conectar();

        //parametros para setear valore de administrador
        $region_id = $_GET['region_id'];
        $cliente_id = $_GET['cliente_id'];

        if (mysqli_connect_errno()) {
            //si hay algun error al conectar a la base de datos
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }else{
          //obtener el nombre de la region en master db
          $query = "SELECT master_region.nombre_region FROM master_region WHERE id_master_region = '".$region_id."' ";
          $result = mysqli_query($conn,$query);

          if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_assoc($result)) {
                  $nombre_region = $row["nombre_region"];
              }
          }
          //echo "<p> Region: ".$id_region."</p>";
          //echo "<p> Nombre Region: ".$nombre_region."</p>";

          $query_cliente = "SELECT nombre_db FROM master_cliente WHERE id_master_cliente = '".$cliente_id."' ";
          $result_cliente = mysqli_query($conn,$query_cliente);

          if(mysqli_num_rows($result_cliente)>0){
              while($row = mysqli_fetch_assoc($result_cliente)) {
                  $nombre_db = $row["nombre_db"];
                  $_SESSION['nombre_db'] = $nombre_db;
              }
          }

          mysqli_close($conn);

          $con1 = new Conexion();
          $conn_db = $con1->conectar_db($nombre_db);

          if (mysqli_connect_errno()) {
              //si hay algun error al conectar a la base de datos
              printf("Falló la conexión: %s\n", mysqli_connect_error());
              exit();
          }else{
            //buscar el id de la region en la db segun cliente
            $query_region = "SELECT id_region FROM region WHERE nombre LIKE '%".$nombre_region."%' ";
            $result_reg= mysqli_query($conn_db,$query_region);

            if(mysqli_num_rows($result_reg)>0){
                while($row = mysqli_fetch_assoc($result_reg)) {
                    $id_region = $row["id_region"];
                    $_SESSION['id_region'] = $id_region;
                }
            }
        }

        mysqli_close($conn_db);

        }//fin del else
        echo '<div class="alert alert-success">
              <strong>Listo!</strong> Los valores de region y cliente se han asignado exitosamente.
              </div>';
    }//fin primer else
?>
