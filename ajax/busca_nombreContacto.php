<?php
	include("../includes/conf.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	if ($_GET['tabla'] == "cliente")
	{
		include("../class/cliente_contactos.class.php");
		$contacto = new ClienteContactos($q);
	}
	else if ($_GET['tabla'] == "proveedor")
	{
		include("../class/proveedor_contactos.class.php");
		$contacto = new ProveedorContactos($q);
	}
	
	echo $contacto->getNombre();
?>