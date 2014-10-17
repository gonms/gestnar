<?php
	error_reporting(0);
	
	session_start();
	
	if (empty($_SESSION['id_usuario']))
		header("Location: index.php");
?>