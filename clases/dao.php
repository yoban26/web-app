<?php
    /*incluir script de conexion*/
	include('../connect.php');

    /* iniciar la session */
    session_start();

    /*crear instancia de la clase conexion*/
	$con = new Conexion;

	/*usar metodo de conectar*/
    $conn = $con->conectar();

    function getListUserType(){
        /* comprobar la conexión */
        if (mysqli_connect_errno()) {
            //si hay algun error al conectar a la base de datos
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }else {

        }
    }

    function getListClientType(){
        /* comprobar la conexión */
        if (mysqli_connect_errno()) {
            //si hay algun error al conectar a la base de datos
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }else {

        }
    }

    function getListCuestionarios(){
        /* comprobar la conexión */
        if (mysqli_connect_errno()) {
            //si hay algun error al conectar a la base de datos
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }else {

        }
    }
?>