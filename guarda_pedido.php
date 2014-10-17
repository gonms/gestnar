<?php
	include("class/pedido.class.php");
	include("class/pedido_equipos.class.php");
    include("class/pedido_proveedores.class.php");
	include("includes/funciones.php");
	include("includes/conf.php");

	$pedido = new Pedido();
    $pedido->setIdOferta($_POST['id_oferta']);
    $pedido->setNumero($_POST['numero_pedido']);
    $pedido->setCodigo($_POST['codigo_pedido']);    
    $pedido->setFecha(dateToMy($_POST['fecha']));
    $pedido->setFormaPago(str_replace("'","\'",$_POST['forma_pago1'] . "@" . $_POST['forma_pago2']));
    $pedido->setPorcentajeAgente($_POST['porcentaje_agente']);
    $pedido->setAgente(str_replace("'","\'",$_POST['agente']));
    
    $aRequerimientos = array();
    for ($i=1;$i<=20;$i++)
    {
        if ($_POST['chkReq' . $i] == 'on')
            $aRequerimientos[] = 1;
        else
            $aRequerimientos[] = 0;
    }
    $requerimientos = implode("@",$aRequerimientos);
    $pedido->setRequerimientos($requerimientos);
    $pedido->setIdCliente($_POST['id_cliente']);
    $pedido->setIdClienteDireccionEnvio($_POST['id_cliente_direccion_envio']);
    $pedido->setIdClienteContacto($_POST['id_contacto']);
    $pedido->setFechaEnvio(dateToMy($_POST['fecha_envio']));
    $pedido->setSuReferencia(str_replace("'","\'",$_POST['su_referencia']));
    $pedido->setDeFecha(dateToMy($_POST['de_fecha']));
    $pedido->setPortes(str_replace("'","\'",$_POST['portes']));
	$pedido->setRevision($_POST['revision']);
    	
	$esRevision = false;
    
    if ($_POST['accion'] == "nuevo")
		$id_pedido = $pedido->add();
	else if ($_POST['accion'] == "modificar")
	{
		$id_pedido = $_POST['id_pedido'];
		$pedido->setId($_POST['id_pedido']);
		$pedido->update();
	}
	else if ($_POST['accion'] == "revision")
    {
		$id_pedido = $pedido->add();
        $esRevision = true;
	}
	
	$equipos = new PedidoEquipos();
	for ($i=1;$i<=$_POST['num_equipos'];$i++)
	{
		$equipos->setReferencia(str_replace("'","\'",$_POST['referencia_' . $i]));
		$equipos->setDescripcion(str_replace("'","\'",$_POST['descripcion_' . $i]));
		$equipos->setCantidad($_POST['cantidad_' . $i]);
		$equipos->setPrecioVenta(str_replace(",",".",$_POST['precio_' . $i]));
		$equipos->setPrecioCoste(str_replace(",",".",$_POST['precio_coste_' . $i]));
		$equipos->setIdPedido($id_pedido);
			
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

	$proveedores = new PedidoProveedores();
	
	for ($i=1;$i<=$_POST['num_proveedores'];$i++)
	{
		$proveedores->setEmpresa(str_replace("'","\'",$_POST['prov_empresa_' . $i]));
		$proveedores->setNumero($_POST['prov_numero_' . $i]);
		$proveedores->setFecha(dateToMy($_POST['prov_fecha_' . $i]));
		$proveedores->setImporte(str_replace(",",".",$_POST['prov_importe_' . $i]));
		$proveedores->setFechaEntrega(dateToMy($_POST['prov_fecha_entrega_' . $i]));
		$proveedores->setIdPedido($id_pedido);
		
		if ($esRevision)
		{
			if ($_POST['accion_prov_' . $i] != 'borrar')
					$proveedores->add();
		}
		else
		{
			if ($_POST['accion_prov_' . $i] == '')
			{								
				$proveedores->setId($_POST['id_prov_' .$i]);
				$proveedores->update();
			}
			else if ($_POST['accion_prov_' . $i] == 'nuevo')
			{
				$proveedores->add();
			}
			else if ($_POST['accion_prov_' . $i] == 'borrar')
			{
				$proveedores->setId($_POST['id_prov_' .$i]);
				$proveedores->delete();
			}
		}		
	}
		
	header("Location: pedidos.php?accion=guardar&id_pedido=" . $id_pedido);	
?>