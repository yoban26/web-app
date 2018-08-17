<?php
    /*incluir script de conexion*/
	include('../connect.php');

    /* iniciar la session */
    session_start();

    /*crear instancia de la clase conexion*/
	$con = new Conexion;

	/*usar metodo de conectar*/
	$conn = $con->conectar();

    //parametros a recibir
    $username = $_POST['username'];
    //$username = mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
    $password = $_POST['password'];

    $error = '<div class="alert alert-danger"><strong>Autentication Fail!</strong> username or password is wrong.</div>';

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        //si hay algun error al conectar a la base de datos
        echo '<div class="alert alert-danger">
    					<strong>Error de conexion!</strong> Se ha perdido la conexion al servidor.
  						</div>';
    }else if(!empty($username) AND !empty($password)){

        //encrypt password
        $password_encrypt = md5($password);

        $sql =  "SELECT master_user.username,master_user.password FROM master_user WHERE master_user.username = '".$username."' AND master_user.password = '".$password_encrypt."' AND master_user.active = 1 ";

        if ($sentencia = mysqli_prepare($conn, $sql)) {

            /* ejecutar la consulta */
            mysqli_stmt_execute($sentencia);

            /* almacenar el resultado */
            mysqli_stmt_store_result($sentencia);

            $fila = mysqli_stmt_num_rows($sentencia);

            if($fila == 0){
                $flag="0";
            }else{
                $flag="1";
            }

            /* cerrar la sentencia */
            mysqli_stmt_close($sentencia);
        }


        if(strcmp($flag,"1")==0){
            //los datos de autenticacion son correctos
            //evaluar el rol del usuario
            getDataSession($username,$conn);
        }else{
            $_SESSION['error'] = $error;
            header("Location: ../login.php");
        }
    }

    function getDataSession($user,$conx){
        $sql1 = "SELECT user_type FROM master_user WHERE username = '".$user."' ";

        $result = mysqli_query($conx,$sql1);

        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["user_type"];
            }
        }

        if(strcmp($id,"1")==0){
            //es administrador enviarlo a su vista
            $_SESSION['username'] = $user;
            $_SESSION['login_status'] = 1;
            $_SESSION['user_type'] = $id;
            header("Location: ../administrador.php");
        }else{
            $_SESSION['username'] = $user;
            $_SESSION['login_status'] = 1;
            $_SESSION['user_type'] = $id;
            header("Location: ../consultor.php");
        }

        $conx = $con->desconectar();
    }

    function getNameDataBaseClient($user,$conn){
        //evaluar si el usuario es administrador o consultor
        $sql = "SELECT master_cliente.nombre_db FROM master_asign_cliente_user,master_cliente WHERE master_asign_cliente_user.cliente = master_cliente.id_master_cliente AND username = ".$user;
        $result = mysqli_query($conn,$sql);
        mysqli_data_seek($result,0);
        $id_cliente_get = mysqli_fetch_array($result);
        $id_cliente = $id_cliente_get['cliente'];
        return $id_cliente;
    }

?>
