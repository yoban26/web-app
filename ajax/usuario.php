<?php
	/*incluir script de conexion*/
  include('../connect.php');
  /*crear instancia de la clase conexion*/
  $con = new Conexion;
  /*usar metodo de conectar*/
  $conn = $con->conectar();

  //parametros a recibir
  $nombre = $_GET['nombre'];
	$apellido = $_GET['apellido'];
	$username = $_GET['username'];
	$password = md5($_GET['password']);
	$estado = $_GET['estado'];
	$id_rol = $_GET['id_rol'];
	$id_region = $_GET['id_region'];
	$id_cliente = $_GET['id_cliente'];
	
  		if(mysqli_connect_errno()){
  			echo '<div class="alert alert-danger">
              <strong>Error de conexion!</strong> Se ha producido un error al conectar con la base de datos, intente recargar la pagina.
              </div>';
  		}else{
  			$query = "INSERT INTO master_user (username,firstName,lastName,password,active,user_type) VALUES ('".$username."','".$nombre."','".$apellido."','".$password."','".$estado."','".$id_rol."')";
    		mysqli_query($conn,"SET CHARSET utf8");
    		//si pudo crear/insetar el nuevo usuario
    		if(mysqli_query($conn,$query)){
    			//asiginarle region y cliente al usuario
    			$query_region = "INSERT INTO master_region_user (username,region) VALUES ('".$username."','".$id_region."')";
    			$query_cliente = "INSERT INTO master_user_cliente (cliente,username) VALUES ('".$id_cliente."','".$username."')";
    			mysqli_query($conn,$query_region);
    			mysqli_query($conn,$query_cliente);
    			echo "1";
    		}else{
    			if(mysqli_errno($conn_db) == 1062){
					//el nombre de usuario ya existe
             		  echo "0";
    			}else{
    				//se produjo un error interno
             		  echo "-1";
    			}

    		}
  		}
  	
?>