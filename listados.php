<?php 
    include("includes/security.php");
	$tipo = $_GET['tipo'];
	
	/*
	puede el usuario acceder a ese listado?
	*/
	switch($_GET['tipo'])
	{
		case "oferta": $acceso = $_SESSION['listado-oferta']; break;
		case "pedido": $acceso = $_SESSION['listado-pedido']; break;
		case "acusepedido": $acceso = $_SESSION['listado-acusepedido']; break;
		case "ordencompra": $acceso = $_SESSION['listado-ordencompra']; break;
		case "albaran": $acceso = $_SESSION['listado-albaran']; break;
		case "registroalbaran": $acceso = $_SESSION['listado-regalbaran']; break;
		case "factura": $acceso = $_SESSION['listado-factura']; break;
		case "abono": $acceso = $_SESSION['listado-abono']; break;
		case "clientes":
		case "proveedores": $acceso = true; break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Listados - Gestnar</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Language" content="ES" />
    
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    
    <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="css/fixIE6.css" />
    <![endif]-->
    <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="css/fixIE7.css" />
    <![endif]-->
    <link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />       
    <link href="css/popup.css" rel="stylesheet" type="text/css" />    	
    
    <!-- Icono en la barra de la URL -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.autocomplete.js"></script> 
    <script type="text/javascript" src="js/popup.js"></script>
    <script type="text/javascript" src="js/funciones_listados.js"></script>	
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
       <ul id="navBar">
        	<li <?php echo (($tipo == "oferta")?"class='sel'":"");?>><a href="?tipo=oferta"><span>Oferta</span></a></li>
        	<li <?php echo (($tipo == "pedido")?"class='sel'":"");?>><a href="?tipo=pedido"><span>Pedido</span></a></li>
        	<li <?php echo (($tipo == "acusepedido")?"class='sel'":"");?>><a href="?tipo=acusepedido" alt="Acuse de pedido" title="Acuse de pedido"><span>Ac. de pedido</span></a></li>
        	<li <?php echo (($tipo == "ordencompra")?"class='sel'":"");?>><a href="?tipo=ordencompra" title="Orden de compra" alt="Orden de compra"><span>O. de compra</span></a></li>
        	<li <?php echo (($tipo == "albaran")?"class='sel'":"");?>><a href="?tipo=albaran"><span>Albarán</span></a></li>
			<li <?php echo (($tipo == "registroalbaran")?"class='sel'":"");?>><a href="?tipo=registroalbaran" alt="Registro de albaranes" title="Registro de albaranes"><span>Reg. albaranes</span></a></li>
        	<li <?php echo (($tipo == "factura")?"class='sel'":"");?>><a href="?tipo=factura"><span>Factura</span></a></li>
			<li <?php echo (($tipo == "abono")?"class='sel'":"");?>><a href="?tipo=abono"><span>Abono</span></a></li>
			<li <?php echo (($tipo == "clientes")?"class='sel'":"");?>><a href="?tipo=clientes"><span>Clientes</span></a></li>
			<li <?php echo (($tipo == "proveedores")?"class='sel'":"");?>><a href="?tipo=proveedores"><span>Proveedores</span></a></li>
        </ul>
        <hr />
    	
    	<div id="content">
        	<div class="module inter">
				<?php if (empty($tipo))
		    	{
		    	?>
		    		<p style='height:70px;text-align:center; font:18px "Trebuchet MS",Arial,Helvetica,sans-serif;'>PANTALLA DE LISTADOS</p>
				<?php
				}
				else if ($acceso)
		    	{
		    	?>
				<form method="post" action="guarda_oferta.php" id="fOferta" class="ofertas">
                    <input type="hidden" name="tabla" id="tabla" value="<?php echo $tipo;?>" />
                    
					<span class="title">Listados</span>	
					<fieldset>
                     <?php if ($tipo != "clientes" && $tipo != "proveedores")
                     {
                     ?>
						<label>
                            <span>Por año:</span>
							<input type="text" size="10" name="anio" id="anio"/>
                        </label>                       
						<label>
                            <span>Por fechas: Del </span> 
							<input type="text" size="10" name="fecha_desde" id="fecha_desde"/> (d/m/a)
						</label>
						<label>
                            <span>al</span>
							<input type="text" size="10" name="fecha_hasta" id="fecha_hasta"/> (d/m/a)
                        </label>
						<label>
                            <span>Por número:</span>
							<input type="text" size="10" name="numero" id="numero"/>
                        </label>   
						<?php
							if ($tipo == "factura" || $tipo == "albaran")
							{
						?>
						<label>
                            <span>Por número pedido:</span>
							<input type="text" size="10" name="numero_pedido" id="numero_pedido"/>
                        </label>
						<?php
							}

							if ($tipo == "registroalbaran")
							{
						?>
						<label>
                            <span>Por número pedido:</span>
							<input type="text" size="10" name="numero_pedido" id="numero_pedido"/>
                        </label>
						<label>
                            <span>Por equipos:</span>
							<input type="text" size="30" name="equipos" id="equipos"/>
                        </label>
						<?php
							}
						}
						else
						{
						?>
						<label>
                            <span>Nombre</span>
							<input type="text" size="30" name="nombre" id="nombre"/>
							<input type="hidden" name="id_nombre" id="id_nombre"/>
                        </label>
						<?php
						}
						?>
						<div class="btn04">
		                    <input type="button" class="btn04" value="Buscar" id="btn-Buscar" name="btn-Buscar" />	
	                    </div>
					</fieldset>
					
					<fieldset class="datosEquipos">
						<div id="tabla_listado" style="display:none;"></div>
					</fieldset>                    
					<br/>
				</form>
				<?php
		        }
		        else
		        {
		        ?>
					<p style='color:red;height:70px;text-align:center; font:18px "Trebuchet MS",Arial,Helvetica,sans-serif;'>NO TIENES ACCESO A ESTE LISTADO</p>
		        <?php
		        }
		        ?>
            </div>
        </div>
    </div>
    <div id="pie">&copy; <?php echo date("Y");?> EINAR S.A.</div>    
<div id="popup">
    <a id="popupClose">cerrar</a>
    <br />
    <div id="div_popup"></div>
</div>
<div id="backgroundPopup"></div>    
	
</body>
</html>