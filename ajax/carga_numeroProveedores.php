<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");	    
    include("../class/pedido_proveedores.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$aProveedores = array();
    $proveedores = new PedidoProveedores();    
    $aProveedores = $proveedores->getProveedores($q);
                
	$result = count($aProveedores);
	
	echo $result;
?>