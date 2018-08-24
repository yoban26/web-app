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
      $conn = $con->conectar();

      if(mysqli_connect_errno()){
        //si hay algun error al conectar a la base de datos
        //printf("Falló la conexión: %s\n", mysqli_connect_error());
        //exit();
        echo '<div class="alert alert-danger">
              <strong>Error de conexion!</strong> Se ha producido un error al conectar con la base de datos, intente recargar la pagina.
              </div>';
      }else{
        $query = "SELECT firstName,lastName,username,user_type,active FROM master_user,master_user_type WHERE master_user.user_type = master_user_type.id_user_type ORDER BY firstName DESC";

        $result = mysqli_query($conn,"SET CHARSET utf8");
        $result = mysqli_query($conn,$query);
        echo '<table class="table table-hover">';
        echo '<thead>';
        echo '<tr class="info">';
        echo '<th>NOMBRE</th>';
        echo '<th>APELLIDO</th>';
        echo '<th>NOMBRE DE USUARIO</th>';
        echo '<th>ROL DE USUARIO</th>';
        echo '<th>ESTADO</th>';
        echo '<th class="text-right">ACCIONES</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['firstName']."</td>";
                echo "<td>".$row['lastName']."</td>";
                echo "<td>".$row['username']."</td>";
                echo "<td>".$row['user_type']."</td>";
                $estado = $row['active'];
                if(strcmp($estado,"1")==0){
                  $est = "Activo";
                }else{
                  $est = "Inactivo";
                }
                echo "<td>".$est."</td>";
                //modificar
                echo '<td class="text-right">';
                /*echo '<a title="quitar cuestionario" class="btn btn-default" onclick="eliminar('.$row['id'].')">';*/
                echo '<a title="modificar usuario" class="btn btn-default" onclick="eliminar('.$row['username'].')">';
                echo '<i class="glyphicon glyphicon-cogwheel"></i>';
                echo '</a></td>';
                //eliminar
                echo '<td class="text-right">';
                /*echo '<a title="quitar cuestionario" class="btn btn-default" onclick="eliminar('.$row['id'].')">';*/
                echo '<a title="eliminar usuario" class="btn btn-default" onclick="eliminar('.$row['username'].')">';
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