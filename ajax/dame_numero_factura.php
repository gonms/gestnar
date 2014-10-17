<?php
	include("../includes/conf.php");
	include("../class/factura.class.php");
	
	$q = $_GET["accion"];
	if (!empty($_GET['proforma']))
		$esProforma = $_GET['proforma'];
	else
		$esProforma = "0";
	if (!$q) return;
	
	$factura = new Factura();
	$numero = $factura->dameNumero($q,$esProforma);

	echo $numero;
?>