<?php
	include("../includes/conf.php");
	
	$tabla = $_GET['tabla'];
	$id = $_GET['id'];

	switch ($tabla)
	{
		case "oferta":
			include ("../class/oferta.class.php");
			$oferta = new Oferta();
			$oferta->setId($id);
			$res = $oferta->delete();
			if ($res > 0)
			{
				include ("../class/oferta_equipos.class.php");
				$equipos = new OfertaEquipos();
				$equipos->setIdOferta($id);
				$res = $equipos->deleteByOferta();
				$result = ($res > 0) ? "OK" : "KO";
			}
			else
				$result = "KO";
			break;
		
		case "pedido":
			include ("../class/pedido.class.php");
			$pedido = new Pedido();
			$pedido->setId($id);
			$res = $pedido->delete();
			if ($res > 0)
			{
				include ("../class/pedido_equipos.class.php");
				$equipos = new PedidoEquipos();
				$equipos->setIdPedido($id);
				$res = $equipos->deleteByPedido();
				$result = ($res > 0) ? "OK" : "KO";
			}
			else
				$result = "KO";
			break;
		
		case "acusepedido":
			include ("../class/acusepedido.class.php");
			$acuse = new AcusePedido();
			$acuse->setId($id);
			$res = $acuse->delete();
			if ($res > 0)
			{
				include ("../class/acusepedido_equipos.class.php");
				$equipos = new AcusePedidoEquipos();
				$equipos->setIdAcusePedido($id);
				$res = $equipos->deleteByAcusePedido();
				$result = ($res > 0) ? "OK" : "KO";
			}
			else
				$result = "KO";
			break;
		
		case "ordencompra":
			include ("../class/ordencompra.class.php");
			$orden = new OrdenCompra();
			$orden->setId($id);
			$res = $orden->delete();
			if ($res > 0)
			{
				include ("../class/ordencompra_equipos.class.php");
				$equipos = new OrdenCompraEquipos();
				$equipos->setIdOrdenCompra($id);
				$res = $equipos->deleteByOrdenCompra();
				$result = ($res > 0) ? "OK" : "KO";
			}
			else
				$result = "KO";
			break;
		
		case "albaran":
			include ("../class/albaran.class.php");
			$albaran = new Albaran();
			$albaran->setId($id);
			$res = $albaran->delete();
			if ($res > 0)
			{
				include ("../class/albaran_equipos.class.php");
				$equipos = new AlbaranEquipos();
				$equipos->setIdAlbaran($id);
				$res = $equipos->deleteByAlbaran();
				$result = ($res > 0) ? "OK" : "KO";
			}
			else
				$result = "KO";
			break;
		
		case "factura":
		case "abono":
			include ("../class/factura.class.php");
			$factura = new Factura();
			$factura->setId($id);
			$res = $factura->delete();
			if ($res > 0)
			{
				include ("../class/factura_equipos.class.php");
				$equipos = new FacturaEquipos();
				$equipos->setIdFactura($id);
				$res = $equipos->deleteByFactura();
				$result = ($res > 0) ? "OK" : "KO";
			}
			else
				$result = "KO";
			break;
	}
	
	echo $result;
?>