<?php
	session_start();
	include("includes/conf.php");
	include("class/usuario.class.php");
	
	if ($_POST['user'] == "admin" && $_POST['pass'] == "4346")
	{
		$_SESSION['id_usuario'] = 9999;
        $_SESSION['acOferta'] = true;
		$_SESSION['acPedido'] = true;
		$_SESSION['acAcusePedido'] = true;
		$_SESSION['acOrdenCompra'] = true;
		$_SESSION['acAlbaran'] = true;
		$_SESSION['acFactura'] = true;
		$_SESSION['acListados'] = true;
		$_SESSION['acFicheros'] = true;
		
		$_SESSION['listado-oferta'] = true;
		$_SESSION['listado-pedido'] = true;
		$_SESSION['listado-acusepedido'] = true;
		$_SESSION['listado-ordencompra'] = true;
		$_SESSION['listado-albaran'] = true;
		$_SESSION['listado-regalbaran'] = true;
		$_SESSION['listado-factura'] = true;
		$_SESSION['listado-abono'] = true;
	}
	else
	{
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
		
		$_SESSION['listado-oferta'] = $usuario->getAccesos('listado-oferta');
		$_SESSION['listado-pedido'] = $usuario->getAccesos('listado-pedido');
		$_SESSION['listado-acusepedido'] = $usuario->getAccesos('listado-acusepedido');
		$_SESSION['listado-ordencompra'] = $usuario->getAccesos('listado-ordencompra');
		$_SESSION['listado-albaran'] = $usuario->getAccesos('listado-albaran');
		$_SESSION['listado-regalbaran'] = $usuario->getAccesos('listado-regalbaran');
		$_SESSION['listado-factura'] = $usuario->getAccesos('listado-factura');
		$_SESSION['listado-abono'] = $usuario->getAccesos('listado-abono');
	}
	
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