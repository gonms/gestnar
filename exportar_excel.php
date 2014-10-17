<?php
	include("includes/conf.php");
	include("includes/funciones.php");
	include("includes/excelwriter.inc.php");  
		
	$tipo = $_GET['tipo'];
	if (!empty($_GET['valor2']))
	{
		$aValor = array($_GET['valor1'],$_GET['valor2']);
	}
	else
	{
		$aValor = $_GET['valor1'];
	}
	$tabla = $_GET['tabla'];
	
	if (!$tipo) return;
	
    $excel=new ExcelWriter($tabla . ".xls");
    switch ($tabla)
	{
		case "oferta":
			include ("class/oferta.class.php");
			$oferta = new Oferta();
			$aDatos = $oferta->getListado($tipo,$aValor);
						
			$excel->writeRow();  
			$excel->writeColHeader("<b>NUMERO</b>",100); 
			$excel->writeColHeader("<b>FECHA</b>",80);
			$excel->writeColHeader("<b>OBRA</b>",300);
			for ($i = 0; $i<count($aDatos); $i++)
			{
				$numero = $aDatos[$i]['codigo'] . "-" . $aDatos[$i]['numero'];
				if (!empty($aDatos[$i]['extra'])) $numero .= "-" . $aDatos[$i]['extra'];
				$excel->writeRow();
				$excel->writeCol($numero);
				$excel->writeCol(myToDate($aDatos[$i]['fecha']));
				$excel->writeCol($aDatos[$i]['obra']);
			}
			break;
		
		case "pedido":
			include ("class/oferta.class.php");
			include ("class/pedido.class.php");
			$pedido = new Pedido();
			$aDatos = $pedido->getListado($tipo,$aValor);
			
			$excel->writeRow();  
			$excel->writeColHeader("<b>NUMERO PEDIDO</b>",100); 
			$excel->writeColHeader("<b>NUMERO OFERTA</b>",100); 			
			$excel->writeColHeader("<b>FECHA</b>",80);
			
			for ($i = 0; $i<count($aDatos); $i++)
			{
				$oferta = new Oferta($aDatos[$i]['id_oferta']);
				$excel->writeRow();
				$excel->writeCol($aDatos[$i]['numero']);
				$excel->writeCol($oferta->getNumeroOferta());
				$excel->writeCol(myToDate($aDatos[$i]['fecha']));
			}
			break;
		
		case "acusepedido":
			include ("class/oferta.class.php");
			include ("class/pedido.class.php");
			include ("class/acusepedido.class.php");
			$acusepedido = new AcusePedido();
			$aDatos = $acusepedido->getListado($tipo,$aValor);
			
			$excel->writeRow();  
			$excel->writeColHeader("<b>NUMERO PEDIDO</b>",100); 
			$excel->writeColHeader("<b>NUMERO OFERTA</b>",100); 			
			$excel->writeColHeader("<b>FECHA</b>",80);

			for ($i = 0; $i<count($aDatos); $i++)
			{
				$pedido = new Pedido($aDatos[$i]['id_pedido']);				
				$oferta = new Oferta($pedido->getIdOferta());
				
				$excel->writeRow();
				$excel->writeCol($pedido->getNumeroPedido());
				$excel->writeCol($oferta->getNumeroOferta());
				$excel->writeCol(myToDate($aDatos[$i]['fecha']));
			}
			break;
			
		case "ordencompra":
			include ("class/pedido.class.php");
			include ("class/ordencompra.class.php");
			include ("class/proveedor.class.php");
			$ordencompra = new OrdenCompra();
			$aDatos = $ordencompra->getListado($tipo,$aValor);
	
			$excel->writeRow();  
			$excel->writeColHeader("<b>NUMERO ORDEN</b>",100); 
			$excel->writeColHeader("<b>NUMERO PEDIDO</b>",100); 			
			$excel->writeColHeader("<b>FECHA</b>",80);
			$excel->writeColHeader("<b>PROVEEDOR</b>",150);
			for ($i = 0; $i<count($aDatos); $i++)
			{
				$pedido = new Pedido($aDatos[$i]['id_pedido']);
				$proveedor = new Proveedor($aDatos[$i]['id_proveedor']);
				
				$excel->writeRow();
				$excel->writeCol($aDatos[$i]['numero']);
				$excel->writeCol($pedido->getNumeroPedido());
				$excel->writeCol(myToDate($aDatos[$i]['fecha']));
				$excel->writeCol($proveedor->getNombre());
			}
			break;
		
		case "albaran":
			include ("class/albaran.class.php");
			include ("class/albaran_equipos.class.php");
			$albaran = new Albaran();
			$equipos = new AlbaranEquipos();
			$aDatos = $albaran->getListado($tipo,$aValor);
			
			$excel->writeRow();  
			$excel->writeColHeader("<b>NUMERO ALBARAN</b>",100); 
			$excel->writeColHeader("<b>NUMERO PEDIDO</b>",100); 			
			$excel->writeColHeader("<b>FECHA</b>",80);
			$excel->writeColHeader("<b>CLIENTE</b>",150);
			$excel->writeColHeader("<b>MATERIAL</b>",300);			

			for ($i = 0; $i<count($aDatos); $i++)
			{
				$aEquipos = $equipos->getEquipos($aDatos[$i]['id']);
				for ($j = 0; $j<count($aEquipos); $j++)
				{
					$material .= $aEquipos[$j]['descripcion'] . "<br />";
				}
				$excel->writeRow();
				$excel->writeCol($aDatos[$i]['numero']);
				$excel->writeCol($aDatos[$i]['numero_pedido']);
				$excel->writeCol(myToDate($aDatos[$i]['fecha']));
				$excel->writeCol(str_replace("@","<br />",$aDatos[$i]['cliente']));
				$excel->writeCol($material);
			}
			break;
			
		case "factura":
			include ("class/factura.class.php");
			include ("class/cliente.class.php");
			$factura = new Factura();
			$aDatos = $factura->getListado($tipo,$aValor,"1");
			
			$excel->writeRow();  
			$excel->writeColHeader("<b>NUMERO FACTURA</b>",100); 
			$excel->writeColHeader("<b>NUMERO PEDIDO</b>",100); 			
			$excel->writeColHeader("<b>PROFORMA</b>",40);
			$excel->writeColHeader("<b>FECHA</b>",80);
			$excel->writeColHeader("<b>OBRA</b>",300);			
			$excel->writeColHeader("<b>CLIENTE</b>",300);
			$excel->writeColHeader("<b>TOTAL</b>",80);

			for ($i = 0; $i<count($aDatos); $i++)
			{
				$esProforma = ($aDatos[$i]['factura_proforma'] == "1") ? "Sí" : "No";
				$cliente = new Cliente($aDatos[$i]['id_cliente']);
				
				$excel->writeRow();
				$excel->writeCol($aDatos[$i]['numero']);
				$excel->writeCol($aDatos[$i]['numero_pedido']);
				$excel->writeCol($esProforma);
				$excel->writeCol(myToDate($aDatos[$i]['fecha']));
				$excel->writeCol($aDatos[$i]['obra']);
				$excel->writeCol($cliente->getNombre());
				$excel->writeCol(number_format($aDatos[$i]['total'],2,",","."));
			}
			break;
			
		case "abono":
			include ("class/factura.class.php");
			include ("class/cliente.class.php");
			$factura = new Factura();
			$aDatos = $factura->getListado($tipo,$aValor,"0");
			
			$excel->writeRow();  
			$excel->writeColHeader("<b>NUMERO ABONO</b>",100); 
			$excel->writeColHeader("<b>FECHA</b>",80); 			
			$excel->writeColHeader("<b>OBRA</b>",300);
			$excel->writeColHeader("<b>CLIENTE</b>",150);
			for ($i = 0; $i<count($aDatos); $i++)
			{
				$cliente = new Cliente($aDatos['id_cliente']);
				
				$excel->writeRow();
				$excel->writeCol($aDatos[$i]['numero']);
				$excel->writeCol(myToDate($aDatos[$i]['fecha']));
				$excel->writeCol($aDatos[$i]['obra']);
				$excel->writeCol($cliente->getNombre());
			}
			break;
		
		case "clientes":
			include ("class/cliente.class.php");
			$cliente = new Cliente($aValor);
			
			$excel->writeRow();  
			$excel->writeCol("<b>NOMBRE</b>",200); 
			$excel->writeCol("<b>LOCALIDAD</b>",200); 			
			$excel->writeCol("<b>PROVINCIA</b>",100);
			$excel->writeCol("<b>CIF</b>",100);
			$excel->writeRow();
			$excel->writeCol($cliente->getNombre());
			$excel->writeCol($cliente->getLocalidad());
			$excel->writeCol($cliente->getProvincia());
			$excel->writeCol($cliente->getCIF());
			
			$aDatos = $cliente->getListado($aValor);
			$excel->writeRow();  
			$excel->writeCol("",200); 
			$excel->writeCol("",200); 			
			$excel->writeCol("",100);
			$excel->writeRow();  
			$excel->writeCol("<b>PEDIDO</b>",200); 
			$excel->writeCol("<b>FECHA</b>",200); 			
			$excel->writeCol("<b>TOTAL</b>",100);
			for ($i = 0; $i<count($aDatos); $i++)
			{
				
				$excel->writeRow();
				$excel->writeCol($aDatos[$i]['pedido']);
				$excel->writeCol($aDatos[$i]['fecha']);
				$excel->writeCol($aDatos[$i]['total']);
			}
			break;
			
		case "proveedores":
			include ("class/proveedor.class.php");
			$proveedor = new Proveedor($aValor);
			$excel->writeRow();  
			$excel->writeCol("<b>NOMBRE</b>",200); 
			$excel->writeCol("<b>LOCALIDAD</b>",200); 			
			$excel->writeCol("<b>PROVINCIA</b>",100);
			$excel->writeRow();
			$excel->writeCol($proveedor->getNombre());
			$excel->writeCol($proveedor->getLocalidad());
			$excel->writeCol($proveedor->getProvincia());
			
			$aDatos = $proveedor->getListado($aValor);			
			$excel->writeRow();  
			$excel->writeCol("",200); 
			$excel->writeCol("",200); 			
			$excel->writeCol("",100);
			$excel->writeRow();  
			$excel->writeCol("<b>ORDEN DE COMPRA</b>",200); 
			$excel->writeCol("<b>FECHA</b>",200); 			
			$excel->writeCol("<b>TOTAL</b>",100);
			
			for ($i = 0; $i<count($aDatos); $i++)
			{
				
				$excel->writeRow();
				$excel->writeCol($aDatos[$i]['orden']);
				$excel->writeCol($aDatos[$i]['fecha']);
				$excel->writeCol($aDatos[$i]['total']);
			}
			break;
	}
	
	$excel->close();

    header("Location: " . $tabla . ".xls");
?>