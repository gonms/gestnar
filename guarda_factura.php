<?php
	include("class/factura.class.php");
	include("class/factura_equipos.class.php");
	include("includes/funciones.php");
	include("includes/conf.php");

	$factura = new Factura();	
    $factura->setIdPedido($_POST['id_pedido']);
    if ($_POST['accion'] == "duplicar")
		$factura->setNumero($_POST['nuevo_numero_factura']);
	else
		$factura->setNumero($_POST['numero_factura']);
    $factura->setNumeroPedido($_POST['numero_pedido']);
    $factura->setNumeroAlbaran($_POST['numero_albaran']);
    $factura->setFecha(dateToMy($_POST['fecha']));
    $factura->setIVA($_POST['iva']);
    $factura->setIdCliente($_POST['id_cliente']);
    $factura->setIdClienteDireccionEnvio($_POST['id_cliente_direccion_envio']);
    $factura->setNumeroCuenta($_POST['numero_cuenta']);
    $factura->setObra(str_replace("'","\'",$_POST['obra']));
    $factura->setPorcentajeRetencion($_POST['porcentaje_retencion']);    
    $factura->setTipoRetencion($_POST['tipo_retencion']);
    $ff = ($_POST['factura_en_origen'] == "on")?  "1" : "0";
    $factura->setFacturaEnOrigen($ff);
    $ff = ($_POST['factura_en_dolares'] == "on")?  "1" : "0";
    $factura->setFacturaEnDolares($ff);
    $ff = ($_POST['factura_sin_iva'] == "on")?  "1" : "0";
    $factura->setFacturaSinIVA($ff);
    $ff = ($_POST['factura_proforma'] == "on")?  "1" : "0";
    $factura->setFacturaProforma($ff);
	if ($_POST['accion'] == "abono" || $_POST['accion'] == "modAbono")
	    $factura->setEsAbono("1");
	else
		$factura->setEsAbono("0");
    $factura->setSuReferencia(str_replace("'","\'",$_POST['su_referencia']));
    $factura->setCodigo($_POST['codigo']);
    $factura->setAval($_POST['aval']);
    $factura->setFormaPago($_POST['forma_pago_manual']);
	
    if ($_POST['accion'] == "nuevo" ||$_POST['accion'] == "duplicar" || $_POST['accion'] == "pedido" ||$_POST['accion'] == "abono")
		$id_factura = $factura->add();
	else if ($_POST['accion'] == "modificar" ||$_POST['accion'] == "modAbono")
	{
		$id_factura = $_POST['id_factura'];
		$factura->setId($_POST['id_factura']);
		$factura->update();
	}
	
	$equipos = new FacturaEquipos();
	
	for ($i=1;$i<=$_POST['num_equipos'];$i++)
	{
		$equipos->setReferencia(str_replace("'","\'",$_POST['referencia_' . $i]));
		$equipos->setDescripcion(str_replace("'","\'",$_POST['descripcion_' . $i]));
		$equipos->setCantidad(str_replace(",",".",$_POST['cantidad_' . $i]));
		$equipos->setPrecio(str_replace(",",".",$_POST['precio_' . $i]));
		$equipos->setIdFactura($id_factura);
			
		if ($_POST['accion_' . $i] == 'modificar')
		{								
			$equipos->setId($_POST['id_' .$i]);
			$equipos->update();
		}
		else if ($_POST['accion_' . $i] == 'nuevo')
		{
			$equipos->add();
		}
		else if ($_POST['accion_' . $i] == 'borrar')
		{
			$equipos->setId($_POST['id_' .$i]);
			$equipos->delete();
		}
	}
	header("Location: facturas.php?accion=guardar&id_factura=" . $id_factura);
?>