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
      /*usar metodo de conectar*/
      $username = $_SESSION['username'];
      $user_type = $_SESSION['user_type'];
      //parametros que dependen del usuario
      $nombre_db = $_SESSION['nombre_db'];
      $region = $_SESSION['id_region'];
      //datos de asignarcion para buscar_asignaciones
      $usuario = $_GET['user'];
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
        $query = "SELECT DISTINCT mercaderista.nombre as mercaderista,user.username,user_type.name_type as tipo_usuario FROM user,mercaderista,user_type WHERE `user`.username = mercaderista.username AND user.user_type = user_type.id_user_type AND (mercaderista.nombre LIKE '%".$usuario."%' OR mercaderista.username LIKE '%".$usuario."%') AND mercaderista.region = '".$region."' AND user.active = 1";
        
        $result = mysqli_query($conn,"SET CHARSET utf8");
        $result = mysqli_query($conn,$query);
        echo '<table class="table table-hover">';
        echo '<thead>';
        echo '<tr class="info">';
        echo '<th>NOMBRE MERCADERISTA</th>';
        echo '<th>NOMBRE DE USUARIO</th>';
        echo '<th>ROL DE USUARIO</th>';
        echo '<th class="text-right">ACCIONES</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['mercaderista']."</td>";
                echo "<td>".$row['username']."</td>";
                echo "<td>".$row['tipo_usuario']."</td>";
                echo '<td class="text-right">';
                echo '<a title="modificar rol de usuario" class="btn btn-default"';
                echo 'onclick="modificar(';
                echo "'"; 
                echo ''.$row['username'].'';
                echo "'";
                echo ');" '; 
                echo 'href="#" data-toggle="modal" data-target="#myModal">';
                echo '<i class="glyphicon glyphicon-pencil"></i>';
                echo '</a></td>';
                echo '</tr>';
            }
        echo '</tbody>';
        echo '</table>';
          }//fin if
        }//fin del else
     }//fin primer else
?>
