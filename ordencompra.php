<?php 
    include("includes/security.php");
	$accion = (empty($_GET['accion'])) ? "pedido" : $_GET['accion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Orden de compra - Gestnar</title>
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
    <link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />    
    <link href="css/popup.css" rel="stylesheet" type="text/css" />    
    
    <!-- Icono en la barra de la URL -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript" src="js/jquery.js"></script>    
    <script type="text/javascript" src="js/jquery.autocomplete.js"></script>  
    <script type="text/javascript" src="js/popup.js"></script>      
    <script type="text/javascript" src="js/funciones_ordencompra.js"></script>    
    <script type="text/javascript" src="js/funciones_equipos.js"></script>
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
        <ul id="navBar">
            <li <?php echo (($accion == "pedido")?"class='first sel'":"");?>><a href="ordencompra.php?accion=pedido"><span>Pedido</span></a></li>
            <li <?php echo (($accion == "modificar")?"class='first sel'":"");?>><a href="ordencompra.php?accion=modificar"><span>Modificar</span></a></li>
            <li <?php echo (($accion == "revision")?"class='first sel'":"");?>><a href="ordencompra.php?accion=revision"><span>Revisión</span></a></li>
			<li <?php echo (($accion == "nuevo")?"class='first sel'":"");?>><a href="ordencompra.php?accion=nuevo"><span>Nuevo</span></a></li>
			<li class="last"><a href="#" id="volver"><span>Volver</span></a></li>
        </ul>
        <hr />
        
    	<div id="content">
        	<div class="module inter">
				
				<form method="post" action="guarda_ordencompra.php" id="fOrdenCompra" class="ofertas">
					
					<span class="title"  onClick="toggle('fset_orden')" style="cursor:pointer">Orden de compra</span>     
					<fieldset class="datosOfertas" id="fset_orden">
						<label>
                            <span>&nbsp;</span>
							<div id="txtInstruccion">Introduce el número de pedido:</div>
                        </label>
						<br />
						<div id="div_proveedores">
						<label>
                        	<span>Número de pedido</span>
							<input type="text" class="input70" name="numero_pedido" id="numero_pedido"/> 
                        </label>
						Elige un proveedor: 
						<table id="tabla_pedido_proveedores">
							<colgroup><col width="22" /><col width="380"/><col width="145" span="4"/></colgroup>
							<tr>
								<th></th>
								<th>Proveedor</th>
								<th>Número</th>
								<th>Fecha</th>
								<th>Importe</th>
								<th>F.Entrega</th>
							</tr>
						</table>
						<table>
							<tr>
								<td>
									<div id="btn-eligeProveedor" class="btn04">
                                        <input type="button" value="aceptar" class="btn04"/>
                                    </div>
								</td>
                            </tr>
						</table>
						<br />
						</div>
						<label>
                        	<span>Número de orden</span>
							<input type="text" size="12" id="numero_ordencompra" name="numero_ordencompra"/>
						</label>
						<?php if ($accion != "nuevo")
						{
						?>
						<label>
							<span>Revisión</span>
                        	<input type="text" class="input01 disabled" id="revision" name="revision" readonly="readonly" />
							<?php
								if ($accion != "modificar")
									echo "(El número de revisión se calcula automáticamente)";
							?>
						</label>
						<?php
						}
						?>
						<label>
                        	<span>Su oferta</span>
							<input type="text" class="input100" id="su_oferta" name="su_oferta"/>
						</label>
						<label>
                            <span>Portes</span>
                            <select id="portes" name="portes">
                                <option value="">Selecciona...</option>
								<option value="Debidos">Debidos</option>
								<option value="Pagados">Pagados</option>								
                            </select>
                        </label>                 
						<label>
                        	<span>Fecha</span>
							<input type="text" class="inputFecha" name="fecha" id="fecha"/> (d/m/a)
                        </label>                        
						<label>
                        	<span>Fecha entrega</span>
							<input type="text" class="inputFecha" name="fecha_entrega" id="fecha_entrega"/> (d/m/a)
                        </label>
                        <span class="title02">Documentación a suministrar</span>
                        <label>
                        	<span>Estándar: (s/ EN 10 204)</span>
                        </label>                        
                    	<label>
                            Testificación de Conformidad con el pedido "2.1"
                            <input type="checkbox" class="check" name="chkDS1" id="chkDS1" />
                            Testificación de inspección "2.2"
                            <input type="checkbox" class="check" name="chkDS2" id="chkDS2" />
                        </label>        
                        <label>
                        	<span>Otros:</span>
                        </label>                        
                    	<label>
                            Certificado de materiales
                            <input type="checkbox" class="check" name="chkDS3" id="chkDS3" />
                        </label>  
                        <span class="title02">Documentación que se adjunta</span>      
                    	<label>
                        	<span>Documentación</span>
                            <textarea rows="0" cols="0" name="documentacion_incluir" id="documentacion_incluir"></textarea>
                        </label> 
                        <span class="title02">Condiciones de pago</span>        
                    	<label class="small">                        	
                            <span>&nbsp;</span>
							<input type="text" class="input02" id="condiciones_pago" name="condiciones_pago" />							
                        </label>
                        <span class="title02">Responsables</span>      
                    	<label>
                        	<span>Responsable compra</span>
                            <input type="text" class="input100" id="responsable" name="responsable"/>
                        </label>   
                    	<label>
                        	<span>Vº Bº D. Técnica</span>
                            <input type="text" class="input100" id="visto_bueno" name="visto_bueno"/>
                        </label> 
					</fieldset>
                    
					
					<span class="title"  onClick="toggle('fset_proveedor')" style="cursor:pointer">Datos del proveedor</span>
					<fieldset class="datosCliente" id="fset_proveedor">
						<label>
                            <span>&nbsp;</span>
                            Para buscar proveedor, escribirlo en la caja de texto.
                        </label>                                  
						<label>
                            <span>Proveedor</span>
                            <input type="text" size="35" name="proveedor" id="proveedor" />
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
                            <input type="text" class="input50" name="cod_postal" id="cod_postal"/>
                        </label>                        
                        <label>
                            <span>Teléfono</span>
                            <input type="text" class="input70" name="telefono" id="telefono"/>
                        </label>                        
                        <label>
                            <span>Fax</span>
                            <input type="text" class="input70" name="fax" id="fax"/>
                        </label>
						<label>
                            <span>P. Contacto</span>
                            <input type="text" size="12" name="persona_contacto" id="persona_contacto"/>
                        </label>
						<div class="btn04">
                        	<input type="button" class="btn04" id="btn-NuevoProveedor" value="Nuevo"/>
                        </div>
                        <input type="hidden" id="id_proveedor" name="id_proveedor" />
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
                            <input type="text" class="input50" name="de_cod_postal" id="de_cod_postal"/>
                        </label>                                                
                        <label>
                            <span>Localidad</span>
                            <input type="text" size="30" name="de_localidad" id="de_localidad"/>
                        </label>                        
                        <label>
                            <span>Provincia</span>
                            <input type="text" name="de_provincia" id="de_provincia"/>
                        </label>
                        
                        <div class="btn05" id="boton_siguiente" name="boton_siguiente">
                        	<input type="button" class="btn05" value="siguiente" />
                        </div>


						<div class="btn05" id="boton_anterior" name="boton_anterior">
                        	<input type="button" class="btn05" value="anterior" />
                        </div>
                        
						<div class="btn04">
                        	<input type="button" class="btn04" id="btn-DireccionEnvio" value="Nuevo"/>
                        </div>
						<br />
                        <input type="hidden" id="id_proveedor_direccion_envio" name="id_proveedor_direccion_envio" />
                        <input type="hidden" id="total_direcciones" name="total_direcciones" />
                        <input type="hidden" id="posicion" name="posicion" />
                    </fieldset>
					
					<span class="title"  onClick="toggle('fset_equipos');" style="cursor:pointer">Equipos</span>
                    <fieldset class="datosEquipos" id="fset_equipos">
						<div id="equiposOC">
						Equipos del pedido. Selecciona los que quieras incluir en la orden de compra
						<table>
							<colgroup><col width="75" /><col width="92" /><col width="350" /><col width="90" span="2" /></colgroup>
							<tr>
								<th></th>
								<th>Referencia</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>
						</table>
						<table id="tabla_equipos_pedido">
							<colgroup><col width="25" /><col width="92" /><col width="350" /><col width="90" span="2" /></colgroup>
						</table>
						</div>
						
						<br />Equipos de la orden de compra
						<table>
							<colgroup><col width="92" /><col width="350" /><col width="90" span="3" /></colgroup>
							<tr>
								<th>Referencia</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th></th>
							</tr>
						</table>
						<table id="tabla_equipos_ordencompra">
							<colgroup><col width="92" /><col width="350" /><col width="90" span="3" /></colgroup>
						</table>

						<br />Nuevo equipo
						<table id="tabla_equipos"></table>
						<table>
							<colgroup><col width="92" /><col width="350" /><col width="90" span="3" /></colgroup>
							<tr>
								<th>Referencia</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th></th>
							</tr>
							<tr>
								<td><input type="text" id="referencia_nuevo" name="referencia_nuevo"/></td>
								<td><textarea rows="0" cols="0" id="descripcion_nuevo" name="descripcion_nuevo"></textarea></td>
								<td><input type="text" class="input01" id="cantidad_nuevo" name="cantidad_nuevo"/></td>
								<td><input type="text" id="precio_nuevo" name="precio_nuevo"/></td>
								<td>
                                	<div class="btn04 btnPeque">
										<input type="button" class="btn04" id="btnPeque" onclick="nuevoEquipo('tabla_equipos');" value="Añadir"/>
                                    </div>									
								</td>
							</tr>
							<tr>
                                <td colspan="5">
                                    <div id="button" class="btn04">
                                        <input type="button" value="Buscar equipo" class="btn04"/>
                                    </div>
                                </td>
                            </tr>
						</table>
						<input type="hidden" id="num_equipos_pedido" name="num_equipos_pedido"/>
						<input type="hidden" id="num_equipos_ordencompra" name="num_equipos_ordencompra"/>
					</fieldset>
                    
					<div class="btn03">
	                    <input type="button" class="btn03" value="Guardar" id="btn-GuardaOrdenCompra" name="btn-GuardaOrdenCompra"/>	
                    </div>
					<input type="hidden" id="id_ordencompra" name="id_ordencompra" value="<?php echo $_GET['id_ordencompra'];?>" />
					<input type="hidden" id="id_pedido" name="id_pedido" />
                    <input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>" />
				</form>
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