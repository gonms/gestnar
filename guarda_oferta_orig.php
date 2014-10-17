<?php
	include("includes/security.php");
	include("class/oferta.class.php");
	include("class/oferta_equipos.class.php");
	include("includes/funciones.php");
	include("includes/conf.php");

	$oferta = new Oferta();	
    if ($_POST['accion'] == "duplicar")
	   $oferta->setNumero($_POST['nuevo_numero_oferta']);
    else
        $oferta->setNumero($_POST['numero']);
	$oferta->setObra(str_replace("'","\'",$_POST['obra']));
	/*if ($_POST['accion'] == "modificar")
        $oferta->setCodigo($_POST['codigo']);
    else*/
        $oferta->setCodigo($_SESSION['codigo_oferta']);
	$oferta->setDepartamento($_POST['departamento']);
	$oferta->setFechaRecepcion(dateToMy($_POST['fecha_recepcion']));
	$oferta->setCondicionesPago(str_replace("'","\'",$_POST['condiciones_pago1'] . "@" . $_POST['condiciones_pago2']));
	$oferta->setPlazoEntrega(str_replace("'","\'",$_POST['plazo_entrega1'] . "@" . $_POST['plazo_entrega2']));
	$oferta->setEmbalaje(str_replace("'","\'",$_POST['embalaje']));
	$oferta->setFechaEnvio(dateToMy($_POST['fecha_envio']));
	$oferta->setMercanciaFranco(str_replace("'","\'",$_POST['mercancia_franco']));
	$oferta->setValidezOferta(str_replace("'","\'",$_POST['validez_oferta']));
	$oferta->setTipo($_POST['tipo']);
	$oferta->setSituacion($_POST['situacion']);
	/*$oferta->setDescuento($_POST['descuento']);*/
	$oferta->setIVA($_POST['iva']);
	$oferta->setIdCliente($_POST['id_cliente']);
	$oferta->setIdContacto($_POST['id_contacto']);
	$oferta->setExtra($_POST['extra']);
	$oferta->setTipoOferta($_POST['tipo_oferta']);
	
	if ($_POST['accion'] == "nuevo" || $_POST['accion'] == "duplicar")
		$id_oferta = $oferta->add();
	else if ($_POST['accion'] == "modificar")
	{
		$id_oferta = $_POST['id_oferta'];
		$oferta->setId($_POST['id_oferta']);
		$oferta->update();
	}
	else
	{
		if ($_POST['accion'] == "revision")
			$tOferta = "rev";
		else if ($_POST['accion'] == "multioferta")
			$tOferta = "mof";
		else if ($_POST['accion'] == "revMultioferta")
			$tOferta = "rmo";
		$oferta->setTipoOferta($tOferta);
		//$oferta->setExtra(dameExtra($_POST['extra'],$tOferta));
		$id_oferta = $oferta->add();
	}
	
	$equipos = new OfertaEquipos();
	
	for ($i=1;$i<=$_POST['num_equipos'];$i++)
	{
		$equipos->setReferencia(str_replace("'","\'",$_POST['referencia_' . $i]));
		$equipos->setDescripcion(str_replace("'","\'",$_POST['descripcion_' . $i]));
		$equipos->setCantidad($_POST['cantidad_' . $i]);
		$equipos->setDescuento($_POST['descuento_' . $i]);
		$equipos->setPrecio(str_replace(",",".",$_POST['precio_' . $i]));
		$equipos->setIdOferta($id_oferta);
			
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
	header("Location: ofertas.php?accion=guardar&id_oferta=" . $id_oferta);	
?>