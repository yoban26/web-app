<?php
//validar si el usuario inicio session en la app
session_start();
if ($_SESSION['login_status'] != 1) {
      header("location: login.php");
  exit;
}else{
    /*incluir script de conexion*/
    include('../connect.php');
    /*crear instancia de la clase conexion*/
    $con = new Conexion;
    //parametros que dependen del usuario
    $nombre_db = $_SESSION['nombre_db'];
    //obteber id a borrar
    $user_type = $_GET['user_type'];
    $username = $_GET['user'];
    //variable para conectar a la db dependiente el cliente
    $conn = $con->conectar_db($nombre_db);

        if(mysqli_connect_errno()){
          //si hay algun error al conectar a la base de datos
          //printf("Falló la conexión: %s\n", mysqli_connect_error());
          //exit();
          echo '<div class="alert alert-danger">
                <strong>Error de conexion!</strong> Se ha producido un error al conectar con la base de datos, intente recargar la pagina.
                </div>';
        }else{
            $sql = "UPDATE user SET user_type = '".$user_type."' WHERE username = '".$username."' ";
            //echo $sql;
            if(mysqli_query($conn,$sql)){
               echo "1"; 
            }else{
               echo "0";
            }
            //echo 'Se ha borrado con exito';
        }//fin if

  }//fin del else
?>
