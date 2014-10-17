<?php
	include("../includes/conf.php");
	
	$tabla = $_GET['tabla'];
	$numero = $_GET['numero'];
	
	$sql = "SELECT numero FROM " . $tabla . " WHERE numero = '" . $numero . "'";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) > 0)
		echo "true";
	else
		echo "false";
?>