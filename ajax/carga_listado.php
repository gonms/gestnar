<?php
	include("../includes/conf.php");
	include("../includes/funciones.php");
	
	$tipo = $_GET['tipo'];
	$valor = $_GET['valor'];
	$tabla = $_GET['tabla'];
	
	if (!$tipo) return;
	
	$aValor = "";
	$aValor = $valor;
	
	if ($tipo == "fechas")
	{
		list($fecha_desde,$fecha_hasta) = explode("@",$valor);
		$aValor = array();
		$aValor[0] = DateToMy($fecha_desde);
		$aValor[1] = DateToMy($fecha_hasta);
	}
	else if ($tipo == "anio")
	{
		$aValor = array();
		$aValor[0] = $valor . "-01-01";
		$aValor[1] = $valor . "-12-31";
	}
	
	switch ($tabla)
	{
		case "oferta":
			include ("../class/oferta.class.php");
			$oferta = new Oferta();
			$aDatos = $oferta->getListado($tipo,$aValor);
			$result = "<table>";
			if (count($aDatos) > 0)
			{			
				$result .= "<colgroup><col width='20' /><col width='90' /><col width='90' /><col width='350' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th></th>\n";
				$result .= "<th>Número</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "<th>Obra</th>\n";
				$result .= "</tr>\n";
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$numero = $aDatos[$i]['codigo'] . "-" . $aDatos[$i]['numero'];
					if (!empty($aDatos[$i]['extra'])) $numero .= "-" . $aDatos[$i]['extra'];
					$result .= "<tr>\n";
					$result .= "<td><div class='btn05'><input type='button' class='btn05' value='Imprimir' onClick='imprimir(\"oferta\",\"" . $aDatos[$i]['id'] . "\")' /></div>
									<br /><br />
									<div class='btn05'><input type='button' class='btn05' value='Borrar' onClick='borrar(\"oferta\",\"" . $aDatos[$i]['id'] . "\")' /></div></td>\n";
					$result .= "<td><input type='text' value='" . $numero . "' class='input100' /></td>\n";
					$result .= "<td><input type='text' value='" . myToDate($aDatos[$i]['fecha']) . "' /></td>\n";
					$result .= "<td><input type='text' class='input02' value='" . $aDatos[$i]['obra'] . "' /></td>\n";
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result = "<table>";
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;
			
		case "pedido":
			include ("../class/oferta.class.php");
			include ("../class/pedido.class.php");
			$pedido = new Pedido();
			$aDatos = $pedido->getListado($tipo,$aValor);
			$result = "<table>";
			if (count($aDatos) > 0)
			{			
				$result .= "<colgroup><col width='20' /><col width='90' /><col width='90' /><col width='90' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th></th>\n";
				$result .= "<th>Número Pedido</th>\n";
				$result .= "<th>Número Oferta</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "</tr>\n";
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$oferta = new Oferta($aDatos[$i]['id_oferta']);				
					
					$result .= "<tr>\n";
					$result .= "<td><div class='btn05'><input type='button' class='btn05' value='Imprimir' onClick='imprimir(\"pedido\",\"" . $aDatos[$i]['id'] . "\")' /></div>
								<br /><br />
								<div class='btn05'><input type='button' class='btn05' value='Borrar' onClick='borrar(\"pedido\",\"" . $aDatos[$i]['id'] . "\")' /></div></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['numero'] . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $oferta->getNumeroOferta() . "' /></td>\n";
					$result .= "<td><input type='text' value='" . myToDate($aDatos[$i]['fecha']) . "' /></td>\n";
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;
			
		case "acusepedido":
			include ("../class/oferta.class.php");
			include ("../class/pedido.class.php");
			include ("../class/acusepedido.class.php");
			$acusepedido = new AcusePedido();
			$aDatos = $acusepedido->getListado($tipo,$aValor);
			$result = "<table>";
			if (count($aDatos) > 0)
			{			
				$result .= "<colgroup><col width='20' /><col width='90' /><col width='90' /><col width='90' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th></th>\n";
				$result .= "<th>Número Pedido</th>\n";
				$result .= "<th>Número Oferta</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "</tr>\n";
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$pedido = new Pedido($aDatos[$i]['id_pedido']);				
					$oferta = new Oferta($pedido->getIdOferta());
					
					$result .= "<tr>\n";
					$result .= "<td><div class='btn05'><input type='button' class='btn05' value='Imprimir' onClick='imprimir(\"acusepedido\",\"" . $aDatos[$i]['id'] . "\")' /></div>
								<br /><br />
								<div class='btn05'><input type='button' class='btn05' value='Borrar' onClick='borrar(\"acusepedido\",\"" . $aDatos[$i]['id'] . "\")' /></div></td>\n";
					$result .= "<td><input type='text' value='" . $pedido->getNumeroPedido() . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $oferta->getNumeroOferta() . "' /></td>\n";
					$result .= "<td><input type='text' value='" . myToDate($aDatos[$i]['fecha']) . "' /></td>\n";
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;

		case "ordencompra":
			include ("../class/pedido.class.php");
			include ("../class/ordencompra.class.php");
			include ("../class/proveedor.class.php");
			$ordencompra = new OrdenCompra();
			$aDatos = $ordencompra->getListado($tipo,$aValor);
			$result = "<table>";
			if (count($aDatos) > 0)
			{
				$result .= "<colgroup><col width='20' /><col width='90' /><col width='90' /><col width='90' /><col width='200' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th></th>\n";
				$result .= "<th>Número Orden</th>\n";
				$result .= "<th>Número Pedido</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "<th>Proveedor</th>\n";
				$result .= "</tr>\n";
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$pedido = new Pedido($aDatos[$i]['id_pedido']);
					$proveedor = new Proveedor($aDatos[$i]['id_proveedor']);
					
					$result .= "<tr>\n";
					$result .= "<td><div class='btn05'><input type='button' class='btn05' value='Imprimir' onClick='imprimir(\"ordencompra\",\"" . $aDatos[$i]['id'] . "\")' /></div>
								<br /><br />
								<div class='btn05'><input type='button' class='btn05' value='Borrar' onClick='borrar(\"ordencompra\",\"" . $aDatos[$i]['id'] . "\")' /></div></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['numero'] . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $pedido->getNumeroPedido() . "' /></td>\n";
					$result .= "<td><input type='text' value='" . myToDate($aDatos[$i]['fecha']) . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $proveedor->getNombre() . "' class='input02' /></td>\n";
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;
		
		case "albaran":
			include ("../class/albaran.class.php");
			$albaran = new Albaran();
			$aDatos = $albaran->getListado($tipo,$aValor);
			$result = "<table>";
			if (count($aDatos) > 0)
			{
				$result .= "<colgroup><col width='20' /><col width='90' /><col width='90' /><col width='90' /><col width='200' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th></th>\n";
				$result .= "<th>Número Albarán</th>\n";
				$result .= "<th>Número Pedido</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "<th>Cliente</th>\n";
				$result .= "</tr>\n";
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$result .= "<tr>\n";
					$result .= "<td><div class='btn05'><input type='button' class='btn05' value='Imprimir' onClick='imprimir(\"albaran\",\"" . $aDatos[$i]['id'] . "\")' /></div>
								<br /><br />
								<div class='btn05'><input type='button' class='btn05' value='Borrar' onClick='borrar(\"albaran\",\"" . $aDatos[$i]['id'] . "\")' /></div></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['numero'] . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['numero_pedido'] . "' /></td>\n";
					$result .= "<td><input type='text' value='" . myToDate($aDatos[$i]['fecha']) . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['cliente'] . "' class='input02' /></td>\n";
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;
		
		case "registroalbaran":
			$valor = str_replace("/", "-", $valor);
			$result = "<table>";
			$result .= "<tr>\n";
			$result .= "<td><div class='btn05'><input type='button' class='btn05' value='Guardar registro' onClick='imprimir_registro(\"" . $tipo . "\",\"" . $valor . "\")' /></div>\n";
			$result .= "</tr>\n";
			$result .= "</table>";
			break;
			
		case "factura":
			include ("../class/factura.class.php");
			include ("../class/cliente.class.php");			
			$factura = new Factura();
			$aDatos = $factura->getListado($tipo,$aValor,"1");
			$result = "<table>";
			if (count($aDatos) > 0)
			{
				$result .= "<colgroup><col width='20' /><col width='50' /><col width='90' /><col width='70' /><col width='70' /><col width='140' /><col width='80' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th></th>\n";
				$result .= "<th>Número Factura</th>\n";
				$result .= "<th>Número Pedido</th>\n";
				$result .= "<th>Es Proforma</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "<th>Obra</th>\n";
				$result .= "<th>Cliente</th>\n";
				$result .= "<th>Total</th>\n";
				$result .= "</tr>\n";
				
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$cliente = new Cliente($aDatos[$i]['id_cliente']);
					$esProforma = ($aDatos[$i]['factura_proforma'] == "1") ? "Sí" : "No";
					$result .= "<tr>\n";
					$result .= "<td><div class='btn05'><input type='button' class='btn05' value='Imprimir' onClick='imprimir(\"factura\",\"" . $aDatos[$i]['id'] . "\")' /></div>
								<br /><br />
								<div class='btn05'><input type='button' class='btn05' value='Borrar' onClick='borrar(\"factura\",\"" . $aDatos[$i]['id'] . "\")' /></div></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['numero'] . "' style='width:50px !important;' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['numero_pedido'] . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $esProforma . "' /></td>\n";
					$result .= "<td><input type='text' value='" . myToDate($aDatos[$i]['fecha']) . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['obra'] . "' style='width:140px !important;' /></td>\n";
					$result .= "<td><input type='text' value='" . $cliente->getNombre() . "' style='width:120px !important;' /></td>\n";
					$result .= "<td><input type='text' value='" . number_format($aDatos[$i]['total'],2,",",".") . "' /></td>\n";
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;

		case "abono":
			include ("../class/factura.class.php");
			include ("../class/cliente.class.php");
			$factura = new Factura();
			$aDatos = $factura->getListado($tipo,$aValor,"0");
			$result = "<table>";
			if (count($aDatos) > 0)
			{
				$result .= "<colgroup><col width='20' /><col width='90' /><col width='90' /><col width='200' /><col width='200' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th></th>\n";
				$result .= "<th>Número Abono</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "<th>Obra</th>\n";
				$result .= "<th>Cliente</th>\n";
				$result .= "</tr>\n";
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$cliente = new Cliente($aDatos[$i]['id_cliente']);
					
					$result .= "<tr>\n";
					$result .= "<td><div class='btn05'><input type='button' class='btn05' value='Imprimir' onClick='imprimir(\"factura\",\"" . $aDatos[$i]['id'] . "\")' /></div>
								<br /><br />
								<div class='btn05'><input type='button' class='btn05' value='Borrar' onClick='borrar(\"abono\",\"" . $aDatos[$i]['id'] . "\")' /></div></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['numero'] . "' /></td>\n";
					$result .= "<td><input type='text' value='" . myToDate($aDatos[$i]['fecha']) . "' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['obra'] . "' class='input02' /></td>\n";
					$result .= "<td><input type='text' value='" . $cliente->getNombre() . "' style='width:120px !important;' /></td>\n";
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;
			
		case "clientes":
			include ("../class/cliente.class.php");
			$cliente = new Cliente();
			$aDatos = $cliente->getListado($aValor);
			$result = "<table>";
			if (count($aDatos) > 0)
			{			
				$result .= "<colgroup><col width='90' /><col width='90' /><col width='90' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th>Pedido</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "<th>Total</th>\n";
				$result .= "</tr>\n";
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$result .= "<tr>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['pedido'] . "' class='input100' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['fecha'] . "' class='input100' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['total'] . "' class='input100' /></td>\n";	
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result = "<table>";
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;
		
		case "proveedores":
			include ("../class/proveedor.class.php");
			$proveedor = new Proveedor();
			$aDatos = $proveedor->getListado($aValor);
			$result = "<table>";
			if (count($aDatos) > 0)
			{			
				$result .= "<colgroup><col width='90' /><col width='90' /><col width='90' /></colgroup>\n";
				$result .= "<tr>\n";
				$result .= "<th>Orden de compra</th>\n";
				$result .= "<th>Fecha</th>\n";
				$result .= "<th>Total</th>\n";
				$result .= "</tr>\n";
				for ($i = 0; $i<count($aDatos); $i++)
				{
					$result .= "<tr>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['orden'] . "' class='input100' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['fecha'] . "' class='input100' /></td>\n";
					$result .= "<td><input type='text' value='" . $aDatos[$i]['total'] . "' class='input100' /></td>\n";	
					$result .= "</tr>\n";
				}
			}
			else
			{
				$result = "<table>";
				$result .= "<tr>\n";
				$result .= "<th>No existen datos con esos criterios.</th>\n";
				$result .= "</tr>\n";
			}
			$result .= "</table>";
			break;
	}
	
	if (count($aDatos) > 0)
	{
		if (is_array($aValor))
		{
			$expExcel = "<a alt='Exportar datos a Excel' title='Exportar datos a Excel' href='exportar_excel.php?tabla=" . $tabla . "&valor1=" . $aValor[0] . "&valor2=" . $aValor[1] . "&tipo=" . $tipo . "'><img src='img/excel_icon.png' width='50' height='50' /></a>";
		}
		else
		{
			$expExcel = "<a alt='Exportar datos a Excel' title='Exportar datos a Excel' href='exportar_excel.php?tabla=" . $tabla . "&valor1=" . $aValor . "&tipo=" . $tipo . "'><img src='img/excel_icon.png' width='50' height='50' /></a>";
		}
	}
	
	echo $expExcel . utf8_encode($result);
?>