<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/ordencompra.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$ordencompra = new OrdenCompra($q);
	$aOrdenCompra = array();
	$aOrdenCompra[] = $ordencompra->getId();
    $aOrdenCompra[] = $ordencompra->getIdPedido();
	$aOrdenCompra[] = $ordencompra->getNumero();
	$aOrdenCompra[] = $ordencompra->getRevision();
	$aOrdenCompra[] = myToDate($ordencompra->getFecha());
	$aOrdenCompra[] = $ordencompra->getIdProveedor();
	$aOrdenCompra[] = $ordencompra->getIdProveedorDireccionEnvio();
	$aOrdenCompra[] = $ordencompra->getSuOferta();
	$aOrdenCompra[] = myToDate($ordencompra->getFechaEntrega());
	$aOrdenCompra[] = $ordencompra->getPortes();
	$aOrdenCompra[] = $ordencompra->getDocumentacionSuministrar();
	$aOrdenCompra[] = $ordencompra->getDocumentacionIncluir();
	$aOrdenCompra[] = $ordencompra->getCondicionesPago();
	$aOrdenCompra[] = $ordencompra->getResponsable();
	$aOrdenCompra[] = $ordencompra->getVistoBueno();
	echo utf8_encode(implode("#",$aOrdenCompra));
?>