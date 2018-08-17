<?php
    session_start();
    //remover todas las variables de session
    session_unset();
    //destruir la session
    session_destroy();
    header("Location: login.php");
    exit;
?>
