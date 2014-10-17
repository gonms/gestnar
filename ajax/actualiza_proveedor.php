<?php
	include("../class/proveedor.class.php");
	include("../includes/conf.php");

	$proveedor = new Proveedor();
	
	$proveedor->setNombre(str_replace("'","\'",$_POST['empresa']));
	$proveedor->setDireccion(str_replace("'","\'",$_POST['direccion']));
	$proveedor->setLocalidad(str_replace("'","\'",$_POST['localidad']));
	$proveedor->setProvincia(str_replace("'","\'",$_POST['provincia']));
	$proveedor->setCodpostal($_POST['cod_postal']);
	$proveedor->setTelefono($_POST['telefono']);
	$proveedor->setFax($_POST['fax']);
	$proveedor->setContacto(str_replace("'","\'",$_POST['contacto']));
	$proveedor->setId($_POST['id_proveedor']);
	$proveedor->update();
?>