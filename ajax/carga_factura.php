<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/factura.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$factura = new Factura($q);
	$aFactura = array();
	$aFactura[] = $factura->getId();
    $aFactura[] = $factura->getIdPedido();
	$aFactura[] = $factura->getNumero();
    $aFactura[] = $factura->getNumeroPedido();
    $aFactura[] = $factura->getNumeroAlbaran();
    $aFactura[] = myToDate($factura->getFecha());
    $aFactura[] = $factura->getIVA();
	$aFactura[] = $factura->getIdCliente();
	$aFactura[] = $factura->getIdClienteDireccionEnvio();
    $aFactura[] = $factura->getNumeroCuenta();
	$aFactura[] = $factura->getObra();
    $aFactura[] = $factura->getPorcentajeRetencion();
	$aFactura[] = $factura->getTipoRetencion();
    $aFactura[] = $factura->getFacturaEnOrigen();
    $aFactura[] = $factura->getFacturaEnDolares();
    $aFactura[] = $factura->getFacturaSinIVA();
    $aFactura[] = $factura->getFacturaProforma();
    $aFactura[] = $factura->getEsAbono();
    $aFactura[] = $factura->getSuReferencia();
	
	if ($_GET['duplicar'] == "1")
		$aFactura[] = substr(date("Y"),2,2);
	else
		$aFactura[] = $factura->getCodigo();
  
    $aFactura[] = $factura->getAval();
    $aFactura[] = $factura->getFormaPago();
    
	echo utf8_encode(implode("#",$aFactura));
?>