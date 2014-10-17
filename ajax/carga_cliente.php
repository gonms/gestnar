<?php
	include("../includes/conf.php");
	include("../class/cliente.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$cliente = new Cliente($q);
	$aCliente = array();
	$aCliente[] = $cliente->getId();
	$aCliente[] = $cliente->getNombre();
	$aCliente[] = $cliente->getDireccion();
	$aCliente[] = $cliente->getLocalidad();
	$aCliente[] = $cliente->getProvincia();
	$aCliente[] = $cliente->getCodpostal();
	$aCliente[] = $cliente->getTelefono();
	$aCliente[] = $cliente->getFax();
	if ($_GET['campos'] == "todos")
	{
		$aCliente[] = $cliente->getCIF();
		$aCliente[] = $cliente->getFormaPago();
		$aCliente[] = $cliente->getEmail();
		$aCliente[] = $cliente->getNumeroCuenta();
	}
	else if($_GET['campos'] == "facturas")
	{
		$aCliente[] = $cliente->getNumeroCuenta();
		$aCliente[] = $cliente->getCIF();
		$aCliente[] = $cliente->getFormaPago();
	}
		
	echo utf8_encode(implode("#",$aCliente));
?>