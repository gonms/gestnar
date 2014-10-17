<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/acusepedido.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$acusepedido = new AcusePedido($q);
	$aAcusePedido = array();
	$aAcusePedido[] = $acusepedido->getId();
    $aAcusePedido[] = $acusepedido->getIdPedido();
	$aAcusePedido[] = $acusepedido->getNumero();
	$aAcusePedido[] = $acusepedido->getCodigo();
	$aAcusePedido[] = $acusepedido->getRevision();
	$aAcusePedido[] = myToDate($acusepedido->getFecha());
    $aAcusePedido[] = $acusepedido->getPortes();
	$aAcusePedido[] = $acusepedido->getFormaEnvio();
    $aAcusePedido[] = $acusepedido->getIdCliente();
    $aAcusePedido[] = $acusepedido->getIdClienteDireccionEnvio();
    $aAcusePedido[] = $acusepedido->getFormaPago();
    $aAcusePedido[] = $acusepedido->getSuReferencia();
    $aAcusePedido[] = myToDate($acusepedido->getDeFecha());
    $aAcusePedido[] = myToDate($acusepedido->getFechaEnvio());
	echo utf8_encode(implode("#",$aAcusePedido));
?>