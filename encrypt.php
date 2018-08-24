<?php
	$pass = $_GET['password'];
	$pass_encrytp = md5($pass);
	echo "pass encrypt with variable: ".$pass_encrytp;
?>  
 