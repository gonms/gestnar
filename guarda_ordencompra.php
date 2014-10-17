<?php
	include("class/ordencompra.class.php");
	include("class/ordencompra_equipos.class.php");
	include("includes/funciones.php");
	include("includes/conf.php");

	$ordencompra = new OrdenCompra();	
    $ordencompra->setIdPedido($_POST['id_pedido']);
    $ordencompra->setNumero($_POST['numero_ordencompra']);
    $ordencompra->setCodigo($_POST['codigo_ordencompra']);    
    $ordencompra->setFecha(dateToMy($_POST['fecha']));
    $ordencompra->setIdProveedor($_POST['id_proveedor']);
    $ordencompra->setIdProveedorDireccionEnvio($_POST['id_proveedor_direccion_envio']);
    $ordencompra->setSuOferta($_POST['su_oferta']);
    $ordencompra->setFechaEntrega(dateToMy($_POST['fecha_entrega']));
    $ordencompra->setPortes(str_replace("'","\'",$_POST['portes']));
	$ordencompra->setRevision($_POST['revision']);
	
    $aDocSuministrar = array();
    for ($i=1;$i<=3;$i++)
    {
        if ($_POST['chkDS' . $i] == 'on')
            $aDocSuministrar[] = 1;
        else
            $aDocSuministrar[] = 0;
    }
    $doc_suministrar = implode("@",$aDocSuministrar);
	$ordencompra->setDocumentacionSuministrar(str_replace("'","\'",$doc_suministrar));
    $ordencompra->setDocumentacionIncluir(str_replace("'","\'",$_POST['documentacion_incluir']));
    if ($_POST['chkCondicionesPago'] == "on")	
		$ordencompra->setCondicionesPago('Habituales');
	else
		$ordencompra->setCondicionesPago($_POST['condiciones_pago']);
    $ordencompra->setResponsable(str_replace("'","\'",$_POST['responsable']));
    $ordencompra->setVistoBueno(str_replace("'","\'",$_POST['visto_bueno']));
    	
	if ($_POST['accion'] == "modificar")
	{
		$id_ordencompra = $_POST['id_ordencompra'];
		$ordencompra->setId($_POST['id_ordencompra']);
		$ordencompra->update();
	}
	else
    {
		$id_ordencompra = $ordencompra->add();
	}
	
	$equipos = new OrdenCompraEquipos();
	
	for ($i=1;$i<=$_POST['num_equipos_ordencompra'];$i++)
	{
		$equipos->setReferencia(str_replace("'","\'",$_POST['referencia_' . $i]));
		$equipos->setDescripcion(str_replace("'","\'",$_POST['descripcion_' . $i]));
		$equipos->setCantidad($_POST['cantidad_' . $i]);
		$equipos->setPrecio(str_replace(",",".",$_POST['precio_' . $i]));
		$equipos->setIdOrdenCompra($id_ordencompra);
			
		if ($_POST['accion_' . $i] == '')
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
	header("Location: ordencompra.php?accion=guardar&id_ordencompra=" . $id_ordencompra);	
?>