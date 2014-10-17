<?php 
    include("includes/security.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Clientes - Gestnar</title>
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
    <script type="text/javascript" src="js/funciones_clientes.js"></script>
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
       <ul id="navBar">
        	<li class="first sel"><a href="clientes.php"><span>Clientes</span></a></li>
        	<li><a href="proveedores.php"><span>Proveedores</span></a></li>
        	<li><a href="revisiones.php"><span>Revisiones Formato</span></a></li>
			<li class="last"><a href="#" id="volver"><span>Volver</span></a></li>
        </ul>
        <hr />
        
    	<div id="content">
        	<div class="module inter">
        		<form method="post" action="#" id="fClientes" class="ofertas">
        			
                    <span class="title"  onClick="toggle('fset_cliente')" style="cursor:pointer">Datos del cliente</span>
                    <fieldset class="datosCliente" id="fset_cliente">
                    	<label>
                            <span>&nbsp;</span>
                            Introduce un cliente para la búsqueda
                        </label>
                        <label>
                            <span>Cliente</span>
                            <input type="text" size="35" name="empresa" id="empresa" />
                        </label>                        
                        <label>
                            <span>Dirección</span>
                            <textarea rows="2" cols="27" name="direccion" id="direccion"></textarea>
                        </label>                        
                        <label>
                            <span>Localidad</span>
                            <input type="text" size="30" name="localidad" id="localidad"/>
                        </label>                        
                        <label>
                            <span>Provincia</span>
                            <input type="text" name="provincia" id="provincia"/>
                        </label>                        
                        <label>
                            <span>Cod. Postal</span>
                            <input type="text" size="10" name="cod_postal" id="cod_postal"/>
                        </label>                        
                        <label>
                            <span>Teléfono</span>
                            <input type="text" size="12" name="telefono" id="telefono"/>
                        </label>                        
                        <label>
                            <span>Fax</span>
                            <input type="text" size="12" name="fax" id="fax"/>
                        </label>
						
                        <label>
                            <span>C.I.F.</span>
                            <input type="text" size="12" name="cif" id="cif"/>
                        </label>

                        <label>
                            <span>Forma de Pago</span>
                            <input type="text" size="12" name="forma_pago" id="forma_pago"/>
                        </label>

                        <label>
                            <span>Email</span>
                            <input type="text" size="12" name="email" id="email"/>
                        </label>
                        <div class="btn04">
                            <input type="button" class="btn04" id="btn-NuevoCliente" name="btn-NuevoCliente" value="Nuevo"/>
                        </div>
						
						<div class="btn05">
                            <input type="button" class="btn05" id="btn-ModificaCliente" name="btn-ModificaCliente" value="Modificar cliente"/>
                        </div>		
						<input type="hidden" id="id_cliente" name="id_cliente"/>
                        <input type="hidden" value="modificar" id="tipo_cliente" name="tipo_cliente"/>
                        <div id="txtConfirmacion"></div>				
					</fieldset>

                    <span class="title"  onClick="toggle('fset_dirEnvio')" style="cursor:pointer">Dirección de envío</span>
                    <fieldset class="datosCliente" id="fset_dirEnvio">                        
                        <label>
                            <span>Nombre</span>
                            <input type="text" size="35" name="de_nombre" id="de_nombre" />
                        </label>              
                        <label>
                            <span>Dirección</span>
                            <input type="text" size="35" name="de_direccion1" id="de_direccion1" />
                        </label>                        
                        <label>
                            <span>&nbsp;</span>
                            <input type="text" size="35" name="de_direccion2" id="de_direccion2" />
                        </label>                                                
                        <label>
                            <span>Cod. Postal</span>
                            <input type="text" size="10" name="de_cod_postal" id="de_cod_postal"/>
                        </label>                                                
                        <label>
                            <span>Localidad</span>
                            <input type="text" size="30" name="de_localidad" id="de_localidad"/>
                        </label>                        
                        <label>
                            <span>Provincia</span>
                            <input type="text" name="de_provincia" id="de_provincia"/>
                        </label>
                        
						<div class="btn05" id="boton_anterior" name="boton_anterior">
                        	<input type="button" class="btn05" value="anterior" />
                        </div>
						
                        <div class="btn05" id="boton_siguiente" name="boton_siguiente">
                        	<input type="button" class="btn05" value="siguiente" />
                        </div>
                        
						<div class="btn04">
                        	<input type="button" class="btn04" id="btn-DireccionEnvio" value="Nuevo"/>
                        </div>
						<br />
                        <input type="hidden" id="id_cliente_direccion_envio" name="id_cliente_direccion_envio" />
                        <input type="hidden" id="total_direcciones" name="total_direcciones" />
                        <input type="hidden" id="posicion" name="posicion" />
                    </fieldset>
					
					<span class="title"  onClick="toggle('fset_contacto')" style="cursor:pointer">Contactos</span>
                    <fieldset class="datosCliente" id="fset_contacto">
                    	<div id="div_contactos">
                    	</div>
						
						<label>
                            <span>Nuevo</span>
                            <input type="text" size="35" name="contacto_nuevo" id="contacto_nuevo" />
                        </label>

						<div class="btn05">
                        	<input type="button" class="btn05" id="btn-NuevoContacto" value="Añadir"/>
                        </div>						
					</fieldset>
					
					<br />

				</form>
            </div>
        </div>
                     
    </div>
    <div id="pie">EINAR S.A. :: <?php echo date("Y");?> </div>    
<div id="popup">
    <a id="popupClose">cerrar</a>
    <br />
    <div id="div_popup"></div>
</div>
<div id="backgroundPopup"></div>	
</body>
</html>