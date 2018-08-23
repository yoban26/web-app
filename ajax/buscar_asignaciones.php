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
      $tipo_usuario = $_GET['tu'];
      $tipo_cliente = $_GET['tc'];
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
        $query = "SELECT id_asignar_cuestionario as id,cuestionario.nombre as cuestionario,user_type.name_type as tipo_usuario,tipo_cliente.nombre as tipo_cliente FROM asignar_cuestionario,user_type,cuestionario,tipo_cliente WHERE asignar_cuestionario.user_type = user_type.id_user_type AND asignar_cuestionario.cuestionario = cuestionario.id_cuestionario AND asignar_cuestionario.tipo_cliente = tipo_cliente.id_tipo_cliente AND cuestionario.region = '".$region."' AND asignar_cuestionario.tipo_cliente = '".$tipo_cliente."' AND asignar_cuestionario.user_type = '".$tipo_usuario."' ORDER BY cuestionario.nombre ASC";
        //AND asignar_cuestionario.tipo_cliente = '".$tipo_cliente."' ";
        //echo $query;
        $result = mysqli_query($conn,"SET CHARSET utf8");
        $result = mysqli_query($conn,$query);
        echo '<table class="table table-hover">';
        echo '<thead>';
        echo '<tr class="info">';
        echo '<th>NOMBRE CUESTIONARIO</th>';
        echo '<th>ROL DE USUARIO</th>';
        echo '<th>FORMATO CLIENTE</th>';
        echo '<th class="text-right">ACCIONES</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['cuestionario']."</td>";
                echo "<td>".$row['tipo_usuario']."</td>";
                echo "<td>".$row['tipo_cliente']."</td>";
                echo '<td class="text-right">';
                echo '<a title="quitar cuestionario" class="btn btn-default" onclick="eliminar('.$row['id'].')">';
                echo '<i class="glyphicon glyphicon-trash"></i>';
                echo '</a></td>';
                echo '</tr>';
            }
        echo '</tbody>';
        echo '</table>';
          }//fin if
        }//fin del else
     }//fin primer else
?>
