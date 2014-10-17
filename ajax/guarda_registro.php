<?php
	include("../includes/conf.php");
	
	$q = $_POST["tabla"];
	if (!$q) return;

	if ($q == "cliente")
	{
		include("../class/cliente.class.php");
		$registro = new Cliente();
		$registro->setCIF($_POST['cif']);
		$registro->setFormaPago(utf8_decode($_POST['forma_pago']));
		$registro->setEmail($_POST['email']);
	}
	else if ($q == "proveedor")
	{
		include("../class/proveedor.class.php");
		$registro = new Proveedor();
		$registro->setContacto(utf8_decode($_POST['contacto']));
	}
	
	$registro->setNombre(utf8_decode($_POST['empresa']));
	$registro->setDireccion(utf8_decode($_POST['direccion']));
	$registro->setCodpostal($_POST['cod_postal']);
	$registro->setProvincia(utf8_decode($_POST['provincia']));
	$registro->setLocalidad(utf8_decode($_POST['localidad']));
	$registro->setTelefono($_POST['telefono']);
	$registro->setFax($_POST['fax']);
	
	$id = $registro->add();
	if ($id > 0)
	{
		$result = "OK#" . $id . "#" . $_POST['empresa'] . "#" . $_POST['direccion'] . "#" . $_POST['cod_postal'] . "#" . $_POST['localidad'] . "#" . $_POST['provincia'] . "#" . $_POST['telefono'] . "#" . $_POST['fax'];
		if ($q == "cliente")
			$result .= "#" . $_POST['cif'] . "#" . $_POST['forma_pago'] . "#" . $_POST['email'];
		else
			$result .= "#" . $_POST['contacto'];
			
		echo $result;
	}
	else
		echo "ERROR";
?>