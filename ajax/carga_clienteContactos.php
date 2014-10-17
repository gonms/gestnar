<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/cliente_contactos.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	if ($_GET['vieneDe'] == "ficheros")
	{
		$aContactos = array();
		$contactos = new ClienteContactos();
		$aContactos = $contactos->getContactosCliente($q);
		for ($i=0;$i<count($aContactos);$i++)
		{
			$result .= "<label>\n
                            <span>" . ($i + 1) . ".-</span>\n
                            <input type='text' size='35' name='contacto_" . $aContactos[$i]['id'] . "' id='contacto_" . $aContactos[$i]['id'] . "' value='" . $aContactos[$i]['nombre'] . "'/>\n
							&nbsp;<a href='#' onClick='modificaContacto(\"" . $aContactos[$i]['id'] . "\");'><img src='img/modificar.jpg' border='0' height='15' width='15' /></a>\n
                        </label>\n";
		}
	}
	else
	{
		$id_contactoOferta = $_GET['id_contacto'];
		
		$aContactos = array();
		$contactos = new ClienteContactos();
	
		$result = "<option value='' selected>Selecciona...</option>\n";
		$aContactos = $contactos->getContactosCliente($q);
		for ($i=0;$i<count($aContactos);$i++)
		{
			$selected = ($aContactos[$i]['id'] == $id_contactoOferta) ? " selected" : "";
			
			$result .= "<option value='" . $aContactos[$i]['id'] . "'" . $selected . ">" . $aContactos[$i]['nombre'] ."</option>\n";
		}
		$result .= "<option value='nuevo'>-Nuevo-</option>\n";
	}
	echo utf8_encode($result);
?>