<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/cliente_direccion_envio.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$aDirecciones = array();
	$direcciones = new ClienteDireccionEnvio();

	$aDirecciones = $direcciones->getDireccionesCliente($q);

	echo utf8_encode($result);
?>