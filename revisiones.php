<?php 
    include("includes/security.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Revisiones de formato - Gestnar</title>
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
    <script type="text/javascript" src="js/jquery.js"></script>    
    <script type="text/javascript" src="js/funciones_revisiones.js"></script>
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
       <ul id="navBar">
        	<li><a href="clientes.php"><span>Clientes</span></a></li>
        	<li><a href="proveedores.php"><span>Proveedores</span></a></li>
        	<li class="first sel"><a href="revisiones.php"><span>Revisiones Formato</span></a></li>
			<li class="last"><a href="#" id="volver"><span>Volver</span></a></li>
        </ul>
        <hr />
        
    	<div id="content">
        	<div class="module inter">
        		<form method="post" action="#" id="fRevisiones" class="ofertas">
        			
                    <span class="title">Revisiones de formato</span>
                    <fieldset class="datosCliente">
                    	<label>
                            <span>&nbsp;</span>
                            Elige la sección para las revisiones
                        </label>
                        <label>
                            <span>&nbsp;</span>
                            <select name="seccion" id="seccion">
                            	<option value="">Selecciona...</option>
								<option value="oferta">Ofertas</option>
								<option value="pedido">Pedidos</option>
								<option value="acusepedido">Acuse Pedido</option>
								<option value="ordencompra">Orden Compra</option>
                            </select>
                        </label>                        

						<div id="div_revisiones">
                    	</div>
						<span class="title02">Nueva revisión</span>      
						<label>
                            <span>Fecha</span>
                            <input type="text" name="fecha" id="fecha" />
                        </label>
						
						<label>
                            <span>Revisión</span>
                            <input type="text" name="revision" id="revision" />
                        </label>

						<div class="btn05">
                        	<input type="button" class="btn05" id="btn-NuevaRevision" value="Añadir"/>
                        </div>                    							
					</fieldset>
					
					<br />

				</form>
            </div>
        </div>
                     
    </div>
    <div id="pie">&copy; <?php echo date("Y");?> EINAR S.A.</div>    
</body>
</html>