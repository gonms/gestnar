<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/proveedor.class.php");
	
	if (empty($_POST)) return;

	$proveedor = new Proveedor();
	
	$proveedor->setNombre(utf8_decode(str_replace("'","\'",$_POST['proveedor'])));
	$proveedor->setDireccion(utf8_decode(str_replace("'","\'",$_POST['direccion'])));
	$proveedor->setCodPostal($_POST['cod_postal']);
	$proveedor->setLocalidad(utf8_decode(str_replace("'","\'",$_POST['localidad'])));
	$proveedor->setProvincia(utf8_decode(str_replace("'","\'",$_POST['provincia'])));
	$proveedor->setTelefono($_POST['telefono']);
	$proveedor->setFax($_POST['fax']);
	$proveedor->setContacto(utf8_decode(str_replace("'","\'",$_POST['persona_contacto'])));
	
	$result = $proveedor->add();
	if ($result > 0)
		echo "OK#" . $_POST['proveedor'] . "#" . $_POST['direccion'] . "#" . $_POST['cod_postal'] . "#" . $_POST['localidad'] . "#" . $_POST['provincia'] . "#" . $_POST['telefono'] . "#" . $_POST['fax'] . "#" . $_POST['persona_contacto'] . "#" . $result;
	else
		echo "ERROR";
?>