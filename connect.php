<?php /* script para conectarse a la base de datos master db */

	/* incluir script de parametros de conexion */
	include('config/parameters.php');

	class Conexion{

		/*metodo para conectar a la base de datos master */
		public function conectar(){
			$con = mysqli_connect(HOST,USER,PASS,DB);
			return $con;
		}

		/*metodo para conectar a la base de datos segun el nombre */
		public function conectar_db($nombre_db){
			$con = mysqli_connect(HOST,USER,PASS,$nombre_db);
			return $con;
		}

		public function desconectar(){
			$con = mysqli_connect(HOST,USER,PASS,DB);
			mysqli_close($con);
		}
	}

?>
