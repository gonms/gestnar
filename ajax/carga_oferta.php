<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/oferta.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$oferta = new Oferta($q);
	$aOferta = array();
	$aOferta[] = $oferta->getId();
	$aOferta[] = $oferta->getNumero();
	$aOferta[] = $oferta->getObra();
	$aOferta[] = $oferta->getCodigo();
	$aOferta[] = $oferta->getDepartamento();
	$aOferta[] = myToDate($oferta->getFechaRecepcion());
	$aOferta[] = $oferta->getCondicionesPago();
	$aOferta[] = $oferta->getPlazoEntrega();
	$aOferta[] = $oferta->getEmbalaje();
	$aOferta[] = myToDate($oferta->getFechaEnvio());
	$aOferta[] = $oferta->getMercanciaFranco();
	$aOferta[] = $oferta->getValidezOferta();
	$aOferta[] = $oferta->getTipo();
	$aOferta[] = $oferta->getSituacion();
	/*$aOferta[] = $oferta->getDescuento();*/
	$aOferta[] = $oferta->getIVA();
	$aOferta[] = $oferta->getIdCliente();
	$aOferta[] = $oferta->getIdContacto();
	$aOferta[] = $oferta->getExtra();
	$aOferta[] = $oferta->getTipoOferta();
	echo utf8_encode(implode("#",$aOferta));
?>