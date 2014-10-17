<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");	    
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$aEquipos = array();
	
    switch ($_GET['tabla'])
    {
        case 'ofertas': 
                include("../class/oferta_equipos.class.php");
                $equipos = new OfertaEquipos();	
                break;
        case 'pedidos':
                include("../class/pedido_equipos.class.php");
                $equipos = new PedidoEquipos();    
                break;
        case 'acusepedido':
                include("../class/acusepedido_equipos.class.php");
                $equipos = new AcusePedidoEquipos();    
                break;
        case 'ordencompra':
                include("../class/ordencompra_equipos.class.php");
                $equipos = new OrdenCompraEquipos();    
                break;
		case 'albaran':
                include("../class/albaran_equipos.class.php");
                $equipos = new AlbaranEquipos();    
                break;
        case 'facturas':
                include("../class/factura_equipos.class.php");
                $equipos = new FacturaEquipos();    
                break;
	}
    $aEquipos = $equipos->getEquipos($q);
                
	$result = count($aEquipos);
	
	echo $result;
?>