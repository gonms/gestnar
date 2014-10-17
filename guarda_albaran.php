<?php
	include("class/albaran.class.php");
	include("class/albaran_equipos.class.php");
	include("includes/funciones.php");
	include("includes/conf.php");

	$albaran = new Albaran();	
    $albaran->setIdPedido($_POST['id_pedido']);
	$albaran->setNumeroPedido($_POST['numero_pedido']);
    $albaran->setNumero($_POST['numero_albaran']);
    $albaran->setFecha(dateToMy($_POST['fecha']));
	$albaran->setAsunto(str_replace("'","\'",$_POST['asunto']));
	$albaran->setEnviado(str_replace("'","\'",$_POST['enviado']));
	$albaran->setTipo($_POST['tipo']);
	$albaran->setIVA($_POST['iva']);
	$albaran->setContacto(str_replace("'","\'",$_POST['contacto1'] . "@" . $_POST['contacto2']));
	$albaran->setDestinatario(str_replace("'","\'",$_POST['destinatario1'] . "@" . $_POST['destinatario2'] . "@" . $_POST['destinatario3'] . "@" . $_POST['destinatario4']));
    	
    if ($_POST['accion'] == "pedido")
	{
		$id_albaran = $albaran->add();
	}
	else if ($_POST['accion'] == "nuevo")
		$id_albaran = $albaran->add();

	else if ($_POST['accion'] == "modificar")
	{
		$id_albaran = $_POST['id_albaran'];
		$albaran->setId($_POST['id_albaran']);
		$albaran->update();
	}

	$equipos = new AlbaranEquipos();
	
	for ($i=1;$i<=$_POST['num_equipos'];$i++)
	{
		$equipos->setReferencia(str_replace("'","\'",$_POST['referencia_' . $i]));
		$equipos->setDescripcion(str_replace("'","\'",$_POST['descripcion_' . $i]));
		$equipos->setCantidad($_POST['cantidad_' . $i]);
		$equipos->setPrecio(str_replace(",",".",$_POST['precio_' . $i]));
		$equipos->setIdAlbaran($id_albaran);
			
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
	header("Location: albaranes.php?accion=guardar&id_albaran=" . $id_albaran);
?>