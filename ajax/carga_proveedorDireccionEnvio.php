<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/proveedor_direccion_envio.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$aDirecciones = array();
	$direcciones = new ProveedorDireccionEnvio();

	$aDirecciones = $direcciones->getDireccionesProveedor($q);

	echo utf8_encode($result);
?>