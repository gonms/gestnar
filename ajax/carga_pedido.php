<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/pedido.class.php");
	include("../class/oferta.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$pedido = new Pedido($q);
	$aPedido = array();
	$aPedido[] = $pedido->getId();
    $aPedido[] = $pedido->getIdOferta();
	$aPedido[] = $pedido->getNumero();
	$aPedido[] = $pedido->getCodigo();
	$aPedido[] = $pedido->getRevision();
	$aPedido[] = myToDate($pedido->getFecha());
	$aPedido[] = $pedido->getFormaPago();
	$aPedido[] = $pedido->getPorcentajeAgente();
	$aPedido[] = $pedido->getAgente();
	$aPedido[] = $pedido->getRequerimientos();
	$aPedido[] = $pedido->getIdCliente();
	$aPedido[] = $pedido->getIdClienteDireccionEnvio();
	$aPedido[] = $pedido->getIdClienteContacto();
    $aPedido[] = myToDate($pedido->getFechaEnvio());
    $aPedido[] = $pedido->getSuReferencia();
    $aPedido[] = myToDate($pedido->getDeFecha());
    $aPedido[] = $pedido->getPortes();
	
	$oferta = new Oferta($pedido->getIdOferta());
	$numero_oferta = $oferta->getCodigo() ."-" . $oferta->getNumero();
	$dpto = $oferta->getDepartamento();
	if (!empty($dpto))
		$numero_oferta .= "-" . $dpto;
	$extra = $oferta->getExtra();
	if (!empty($extra))
		$numero_oferta .= "-" . $extra;		
	$aPedido[] = $numero_oferta;
	
	echo utf8_encode(implode("#",$aPedido));
?>