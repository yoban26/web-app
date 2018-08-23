<?php
  /*incluir script de conexion*/
  include('../connect.php');
  /*crear instancia de la clase conexion*/
  $con = new Conexion;
  /*usar metodo de conectar*/
  $conn = $con->conectar();

  $region = $_GET['region'];

  if(mysqli_connect_errno()){
    //si hay algun error al conectar a la base de datos
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
  }else{
    $query = "SELECT master_cliente.id_master_cliente,master_cliente.nombre_cliente FROM master_region_cliente,master_cliente WHERE master_region_cliente.cliente = master_cliente.id_master_cliente AND master_region_cliente.region = '".$region."' ";
    $result = mysqli_query($conn,"SET CHARSET utf8");
    $result = mysqli_query($conn,$query);
    echo '<label for="cliente_id">Cliente</label>';
    echo '<select class="form-control" id="cliente_id" required>';
          echo '<option value="">Selecciona el cliente</option>';
            if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_assoc($result)) {
                  echo '<option value='.$row["id_master_cliente"].'>'.$row["nombre_cliente"].'</option>';
                }
            }
    echo "</select>";
    echo "</div>";
    mysqli_close($conn);
  }
?>
