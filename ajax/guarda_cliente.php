<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/cliente.class.php");
	
	if (empty($_POST)) return;

	$cliente = new Cliente();
	
	$cliente->setNombre(utf8_decode(str_replace("'","\'",$_POST['nombre'])));
	$cliente->setDireccion(utf8_decode(str_replace("'","\'",$_POST['direccion'])));
	$cliente->setCodPostal($_POST['cod_postal']);
	$cliente->setLocalidad(utf8_decode(str_replace("'","\'",$_POST['localidad'])));
	$cliente->setProvincia(utf8_decode(str_replace("'","\'",$_POST['provincia'])));
	$cliente->setTelefono($_POST['telefono']);
	$cliente->setFax($_POST['fax']);
	
	$result = $cliente->add();
	if ($result > 0)
		echo "OK#" . $_POST['nombre'] . "#" . $_POST['direccion'] . "#" . $_POST['cod_postal'] . "#" . $_POST['localidad'] . "#" . $_POST['provincia'] . "#" . $_POST['telefono'] . "#" . $_POST['fax'] . "#" . $result;
	else
		echo "ERROR";
?>