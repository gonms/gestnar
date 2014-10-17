<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/albaran.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$albaran = new Albaran($q);
	$aAlbaran = array();
	$aAlbaran[] = $albaran->getId();
	$aAlbaran[] = $albaran->getNumero();
	$aAlbaran[] = $albaran->getNumeroPedido();	
	$aAlbaran[] = myToDate($albaran->getFecha());
	$aAlbaran[] = $albaran->getAsunto();
	$aAlbaran[] = $albaran->getEnviado();
	$aAlbaran[] = $albaran->getTipo();
	$aAlbaran[] = $albaran->getIVA();
	$aAlbaran[] = $albaran->getIdPedido();
	$aAlbaran[] = $albaran->getDestinatario();
	$aAlbaran[] = $albaran->getContacto();
	
	echo utf8_encode(implode("#",$aAlbaran));
?>