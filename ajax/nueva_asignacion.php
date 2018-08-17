<?php
  session_start();
  include('../connect.php');
  /*crear instancia de la clase conexion*/
  $con = new Conexion;
  /*usar metodo de conectar*/
  $nombre_db = $_SESSION['nombre_db'];
  $id_region = $_SESSION['id_region'];
  //variable para conectar a la db dependiente el cliente
  $conn_db = $con->conectar_db($nombre_db);
  $tipo_usuario = $_GET['tu'];
  $tipo_cliente = $_GET['tc'];
  $id_cuestionario = $_GET['id'];

  if(mysqli_connect_errno()){
      echo '<div class="alert alert-danger">
              <strong>Aviso!</strong> Se ha un error en la conexion, intente recargar la pagina.
              </div>';
  }else{
    $query = "INSERT INTO asignar_cuestionario (user_type,cuestionario,enviar_correo,tipo_cliente) VALUES ('".$tipo_usuario."','".$id_cuestionario."','','".$tipo_cliente."')";

    if(mysqli_query($conn_db,$query)){
      /*echo '<div class="alert alert-success">
                        <strong>Aviso!</strong> cuestionario asignado exitosamente.
                        </div>';*/
      //echo "Cuestionario asignado exitosamente";
      echo "1";                  
    }else{
      if(mysqli_errno($conn_db) == 1062){
          /*echo '<div class="alert alert-danger">
                      <strong>Aviso!</strong> Ya existe una asignacion con esos datos.
                      </div>';*/
          //echo "Ya existe una asignacion con ese cuestioanrio";
          echo "0";            
      }else{
        /*echo '<div class="alert alert-danger">
                      <strong>Aviso!</strong> Error al insertar los datos.
                      </div>';*/
        //echo "Error al asignar cuestionario";      
        echo "-1";        
      }
      
    }

    mysqli_close($conn_db);
  }
?>
