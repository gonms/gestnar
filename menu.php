<?php
	include("includes/security.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Menú principal - Gestnar</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Language" content="ES" />
    
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    
    <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="css/fixIE6.css" />
    <![endif]-->
    <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="css/fixIE7.css" />
    <![endif]-->        
    
    <!-- Icono en la barra de la URL -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" /></h1>
        </div>
        <hr />
        <div class="sinMenu"></div>
        
    	<div id="content">
        	<div class="module inter02">
                <ul class="navBar">
                	<?php 
						if ($_SESSION['acOferta'])
						{
					?>
						<li class="opt01"><a href="ofertas.php?accion=nuevo"><span>Ofertas</span></a></li>
					<?php
						}
						else
						{
					?>
						<li class="opt01 out"><a href="ofertas.php?accion=nuevo"><span>Ofertas</span></a></li>
					<?php 
						}
						if ($_SESSION['acPedido']) 
						{
					?>					
                	<li class="opt02"><a href="pedidos.php?accion=nuevo"><span>Pedidos</span></a></li>
					<?php
						}
						else
						{
					?>
					<li class="opt02 out"><a href="#"><span>Pedidos</span></a></li>
					<?php 
						}
						if ($_SESSION['acAcusePedido']) 
						{
					?>
                	<li class="opt08"><a href="acusepedido.php?accion=nuevo"><span>Acuse de pedido</span></a></li>
					<?php
						}
						else
						{
					?>
					<li class="opt08 out"><a href="#"><span>Acuse de pedido</span></a></li>
					<?php 
						}
						if ($_SESSION['acOrdenCompra']) 
						{
					?>					
                	<li class="opt07"><a href="ordencompra.php?accion=pedido"><span>Orden de compra</span></a></li>
					<?php
						}
						else
						{
					?>
                	<li class="opt07 out"><a href="#"><span>Orden de compra</span></a></li>
					<?php 
						}
						if ($_SESSION['acAlbaran']) 
						{
					?>
                	<li class="opt04"><a href="albaranes.php?accion=nuevo"><span>Albaranes</span></a></li>
					<?php
						}
						else
						{
					?>
					<li class="opt04 out"><a href="#"><span>Albaranes</span></a></li>
					<?php
						}
						if ($_SESSION['acFactura']) 
						{
					?>
                	<li class="opt03"><a href="facturas.php?accion=nuevo"><span>Facturas</span></a></li>
					<?php
						}
						else
						{
					?>
					<li class="opt03 out"><a href="#"><span>Facturas</span></a></li>
					<?php 
						}
						if ($_SESSION['acListados']) 
						{
					?>
                	<li class="opt06 <?php if (!$_SESSION['acListados']) echo 'out';?>"><a href="listados.php"><span>Listados</span></a></li>
					<?php
						}
						else
						{
					?>
					<li class="opt06 out"><a href="#"><span>Listados</span></a></li>
					<?php 
						}
						
						if ($_SESSION['acFicheros']) 
						{
					?>
                	<li class="opt05"><a href="clientes.php"><span>Ficheros</span></a></li>
					<?php 
						}
						else
						{
					?>
					<li class="opt05 out"><a href="#"><span>Ficheros</span></a></li>
					<?php
						}
					?>
                </ul>
            </div>
        </div>
    </div>
	<div id="pieVersion">GestNAR v2.0 - &copy; <?php echo date("Y");?> EINAR S.A.</div>
</body>
</html>