<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/cliente_contactos.class.php");
	
	$accion = (empty($_POST['accion'])) ? "nuevo" : $_POST['accion'];
	$contacto = new ClienteContactos();
	
	if ($accion == "nuevo")
	{
		$contacto->setIdCliente($_POST['id_cliente']);
		$contacto->setNombre(utf8_decode(str_replace("'","\'",$_POST['nombre'])));
		$result = $contacto->add();
		
		echo $_POST['id_cliente'] . "#" . $result;
	}
	else if ($accion == "modificar")
	{
		$contacto->setNombre(utf8_decode(str_replace("'","\'",$_POST['nombre'])));
		$contacto->setId($_POST['id']);
		$result = $contacto->update();
		
		if ($result > 0)
			echo "OK";
		else
			echo "ERROR";
		

	}	
?>