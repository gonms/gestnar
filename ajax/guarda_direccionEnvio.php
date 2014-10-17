<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	
	$q = $_POST["id"];
	if (!$q) return;

	if ($_POST['tabla'] == "cliente")
	{
		include("../class/cliente_direccion_envio.class.php");
		$direccion = new ClienteDireccionEnvio();
		$direccion->setIdCliente($_POST['id']);
	}
	else if ($_POST['tabla'] == "proveedor")
	{
		include("../class/proveedor_direccion_envio.class.php");
		$direccion = new ProveedorDireccionEnvio();
		$direccion->setIdProveedor($_POST['id']);
	}
	
	$direccion->setNombre(utf8_decode(str_replace("'","\'",$_POST['nombre'])));
	$direccion->setDireccion1(utf8_decode(str_replace("'","\'",$_POST['direccion1'])));
	$direccion->setDireccion2(utf8_decode(str_replace("'","\'",$_POST['direccion2'])));
	$direccion->setCodPostal($_POST['cod_postal']);
	$direccion->setLocalidad(utf8_decode(str_replace("'","\'",$_POST['localidad'])));
	$direccion->setProvincia(utf8_decode(str_replace("'","\'",$_POST['provincia'])));
	
	$result = $direccion->add();
	if ($result > 0)
		echo "OK#" . $_POST['nombre'] . "#" . $_POST['direccion1'] . "#" . $_POST['direccion2'] . "#" . $_POST['cod_postal'] . "#" . $_POST['localidad'] . "#" . $_POST['provincia'] . "#" . $result;
	else
		echo "ERROR";
?>