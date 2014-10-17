<?php
	include("../class/cliente.class.php");
	include("../includes/conf.php");

	$cliente = new Cliente();
	
	$cliente->setNombre(utf8_decode(str_replace("'","\'",$_POST['empresa'])));
	$cliente->setDireccion(utf8_decode(str_replace("'","\'",$_POST['direccion'])));
	$cliente->setLocalidad(utf8_decode(str_replace("'","\'",$_POST['localidad'])));
	$cliente->setProvincia(utf8_decode(str_replace("'","\'",$_POST['provincia'])));
	$cliente->setCodpostal($_POST['cod_postal']);
	$cliente->setTelefono($_POST['telefono']);
	$cliente->setFax($_POST['fax']);
	$cliente->setCIF($_POST['cif']);
	$cliente->setFormaPago(utf8_decode($_POST['forma_pago']));
	$cliente->setEmail($_POST['email']);
	$cliente->setNumeroCuenta($_POST['numero_cuenta']);
	if ($_POST['tipo_cliente'] == "nuevo")
		$cliente->add();
	else if ($_POST['tipo_cliente'] == "modificar" || $_POST['tipo_cliente'] == "ficheros")
	{
		$cliente->setId($_POST['id_cliente']);
		$cliente->update();
	}
?>