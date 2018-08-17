<?php
  session_start();
  /*incluir script de conexion*/
  include('../connect.php');
  /*crear instancia de la clase conexion*/
  $con = new Conexion;
  /*usar metodo de conectar*/
  $conn = $con->conectar();

  //parametros a recibir
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $username = $_POST['usuario'];
  $password = md5($_POST['password_confirm']);
  $estado = $_POST['estado'];
  $tipo_usuario = $_POST['tipo_usuario'];

  $error = '<div class="alert alert-danger"><strong>Autentication Fail!</strong> username or password is wrong.</div>';

  /* comprobar la conexión */
  if (mysqli_connect_errno()) {
      //si hay algun error al conectar a la base de datos
      printf("Falló la conexión: %s\n", mysqli_connect_error());
      exit();
  }else{
    //insertar usuario
    $query = "INSERT INTO master_user (username,firstName,lastName,password,active,user_type) VALUES ('".$username."','".$nombre."','".$apellido."','".$password."','".$estado."','".$tipo_usuario."')";
    mysqli_query($conn,"SET CHARSET utf8");
    mysqli_query($conn,$query);
    echo "<script>
              alert('Usuario guardado con exito!');
              window.location.href='../NuevoUsuario.php';
              </script>";
  }

  mysqli_close($conn);

?>
