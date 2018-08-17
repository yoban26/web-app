<?php
  session_start();
  if ($_SESSION['login_status'] != 1) {
    header("location: ../login.php");
    exit;
  }
?>
