<?php
	include("class/acusepedido.class.php");
	include("class/acusepedido_equipos.class.php");
	include("includes/funciones.php");
	include("includes/conf.php");

	$acusepedido = new AcusePedido();	
    $acusepedido->setIdPedido($_POST['id_pedido']);
    $acusepedido->setIdCliente($_POST['id_cliente']);
    $acusepedido->setIdClienteDireccionEnvio($_POST['id_cliente_direccion_envio']);
    $acusepedido->setNumero($_POST['numero_pedido']);
    $acusepedido->setCodigo($_POST['codigo_pedido']);
    $acusepedido->setRevision($_POST['revision']);    
    $acusepedido->setFecha(dateToMy($_POST['fecha']));
    $acusepedido->setPortes(str_replace("'","\'",$_POST['portes']));
    $acusepedido->setFormaEnvio(str_replace("'","\'",$_POST['forma_envio']));
    $acusepedido->setFormaPago(str_replace("'","\'",$_POST['forma_pago']));
    $acusepedido->setSuReferencia(str_replace("'","\'",$_POST['su_referencia']));
    $acusepedido->setDeFecha(dateToMy($_POST['de_fecha']));
    $acusepedido->setFechaEnvio(dateToMy($_POST['fecha_envio']));
    	
    if ($_POST['accion'] == "nuevo")
		$id_acusepedido = $acusepedido->add();
	else if ($_POST['accion'] == "modificar")
	{
		$id_acusepedido = $_POST['id_acusepedido'];
		$acusepedido->setId($_POST['id_acusepedido']);
		$acusepedido->update();
	}
	else if ($_POST['accion'] == "revision")
    {
		$id_acusepedido = $acusepedido->add();
	}
	
	$equipos = new AcusePedidoEquipos();
	
	for ($i=1;$i<=$_POST['num_equipos'];$i++)
	{
		$equipos->setReferencia(str_replace("'","\'",$_POST['referencia_' . $i]));
		$equipos->setDescripcion(str_replace("'","\'",$_POST['descripcion_' . $i]));
		$equipos->setCantidad($_POST['cantidad_' . $i]);
		$equipos->setPrecioVenta(str_replace(",",".",$_POST['precio_' . $i]));
		$equipos->setPlazoEntrega($_POST['plazo_entrega_' . $i]);
		$equipos->setIdAcusePedido($id_acusepedido);
			
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
	header("Location: acusepedido.php?accion=guardar&id_acusepedido=" . $id_acusepedido);
?>