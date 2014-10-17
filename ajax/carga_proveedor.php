<?php
	include("../includes/conf.php");
	include("../class/proveedor.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$proveedor = new Proveedor($q);
	$aProveedor = array();
	$aProveedor[] = $proveedor->getId();
	$aProveedor[] = $proveedor->getNombre();
	$aProveedor[] = $proveedor->getDireccion();
	$aProveedor[] = $proveedor->getLocalidad();
	$aProveedor[] = $proveedor->getProvincia();
	$aProveedor[] = $proveedor->getCodpostal();
	$aProveedor[] = $proveedor->getTelefono();
	$aProveedor[] = $proveedor->getFax();
	$aProveedor[] = $proveedor->getContacto();
	echo utf8_encode(implode("#",$aProveedor));
?>