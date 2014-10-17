<?php
	session_start();
	include("includes/conf.php");
	include("class/usuario.class.php");
	
	$usuario = new Usuario($_POST['user'], $_POST['pass']);
	$_SESSION['id_usuario'] = $usuario->getId();
	$_SESSION['codigo_oferta'] = $usuario->getCodigoOferta() . "/" . date("y");
	$_SESSION['acOferta'] = $usuario->getAccesos('oferta');
	$_SESSION['acPedido'] = $usuario->getAccesos('pedido');
	$_SESSION['acAcusePedido'] = $usuario->getAccesos('acusepedido');
	$_SESSION['acOrdenCompra'] = $usuario->getAccesos('ordencompra');
	$_SESSION['acAlbaran'] = $usuario->getAccesos('albaran');
	$_SESSION['acFactura'] = $usuario->getAccesos('factura');
	$_SESSION['acListados'] = $usuario->getAccesos('listados');
	$_SESSION['acFicheros'] = $usuario->getAccesos('ficheros');
	
	if($_POST['chkRecordarme'] == "on")
	{
    	$time = time();
		setcookie("gestnar[username]", $_POST['user'], $time +60*60*24*365);
	    setcookie("gestnar[password]", $_POST['pass'], $time +60*60*24*365);
    }
	else
	{
		unset($_COOKIE['gestnar']);
	}

	header("Location: menu.php");
?>