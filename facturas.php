<?php 
    include("includes/security.php");
	$accion = (empty($_GET['accion'])) ? "nuevo" : $_GET['accion'];
	$titulo = (strpos(strtolower($accion),"abono") === false) ? "Factura" : "Abono";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Factura - Gestnar</title>
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
    <script type="text/javascript" src="js/funciones_facturas.js"></script>    
    <script type="text/javascript" src="js/funciones_equipos.js"></script>
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
       <ul id="navBar">
        	<li <?php echo (($accion == "nuevo")?"class='first sel'":"");?>><a href="facturas.php?accion=nuevo"><span>Nueva</span></a></li>
			<li <?php echo (($accion == "pedido")?"class='first sel'":"");?>><a href="facturas.php?accion=pedido"><span>De pedido</span></a></li>
        	<li <?php echo (($accion == "modificar")?"class='first sel'":"");?>><a href="facturas.php?accion=modificar"><span>Modificar</span></a></li>
			<li <?php echo (($accion == "duplicar")?"class='first sel'":"");?>><a href="facturas.php?accion=duplicar"><span>Duplicar</span></a></li>
			<li <?php echo (($accion == "abono")?"class='first sel'":"");?>><a href="facturas.php?accion=abono"><span>Abono</span></a></li>
			<li <?php echo (($accion == "modAbono")?"class='first sel'":"");?>><a href="facturas.php?accion=modAbono"><span>Modificar Abono</span></a></li>
			<li class="last"><a href="#" id="volver"><span>Volver</span></a></li>
        </ul>
        <hr />
        
    	<div id="content">
        	<div class="module inter">
				
				<form method="post" action="guarda_factura.php" id="fFactura" class="ofertas">
                    <span class="title" onClick="toggle('fset_factura')" style="cursor:pointer"><?php echo $titulo;?></span>
                    <fieldset class="datosOferta" id="fset_factura">
                        <?php if ($accion == "pedido")
						{
						?>
						<label>
							<span>&nbsp;</span>
							<span>Introduce el número de pedido:</span><br /><br />
							<span>Número de Pedido</span>
							<input type="text" class="input70" name="numero_pedido" id="numero_pedido"/>
						</label>
						<?php
						}
						else if ($accion == "modificar" || $accion == "duplicar")
						{
						?>
						<label>
							<span>&nbsp;</span>
							Introduce el número de factura:
						</label>
						<?php
						}
						else if ($accion == "modAbono")
						{
						?>
						<label>
							<span>&nbsp;</span>
							Introduce el número de abono:
						</label>
						<?php
						}
						?>
						<label>                          	
                        	<span id="txtNumero">Número de Factura</span>
							<input type="text" class="input70" name="numero_factura" id="numero_factura"/>
						</label>
						<?php
						if ($accion == "duplicar")
						{
						?>
						<label>                          	
                        	<span id="txtNumero">Nuevo número de Factura</span>
							<input type="text" class="input70" name="nuevo_numero_factura" id="nuevo_numero_factura"/>
						</label>
						<?php
						}
						?>
						<label>
                        	<span>Año</span>
							<input type="text" class="input01" name="codigo" id="codigo"/>
                        </label>
						<?php if ($accion == "nuevo" || $accion == "modificar" || $accion == "duplicar" || $accion == "abono" || $accion == "modAbono")
						{
						?>
						<label>
							<span>Número de Pedido</span>
							<input type="text" class="input70" name="numero_pedido" id="numero_pedido"/>
						</label>
						<?php
						}
						?>
						<label>
                        	<span>Número de Albarán</span>
							<input type="text" class="input70" name="numero_albaran" id="numero_albaran"/>
                        </label>
						<label>
                        	<span>Fecha</span>
							<input type="text" class="inputFecha" name="fecha" id="fecha" /> (d/m/a)
                        </label>   
						<label>
                        	<span>I.V.A.</span>
							<input type="text" class="input01" name="iva" id="iva" value="21" />
                        </label>   
						<label>
                        	<span>Obra</span>
							<input type="text" name="obra" id="obra"/>
                        </label> 
                        <label>
                        	<span>Aval</span>
							<input type="text" class="input70" name="aval" id="aval"/>
                        </label>
                        <span class="title02">Retención</span>
						<label>
                        	<span>Retencion %</span>
							<input type="text" name="porcentaje_retencion" id="porcentaje_retencion" class="input01"/>
                            <input type="radio" class="check" name="tipo_retencion" id="tipo_retencionCI" value="con_iva" /> Retención con IVA
                            <input type="radio" class="check" name="tipo_retencion" id="tipo_retencionSI" value="sin_iva" /> Retención sin IVA                            
                        </label>
						<span class="title02">Opciones</span>
						<span>&nbsp;</span>
                        <input type="checkbox" class="check" id="factura_en_origen" name="factura_en_origen" /> Factura en origen&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" class="check" id="factura_en_dolares" name="factura_en_dolares" /> En Dólares&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" class="check" id="factura_sin_iva" name="factura_sin_iva" /> Factura Sin I.V.A.&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" class="check" id="factura_proforma" name="factura_proforma" /> Factura Proforma
                        <br /><br />
                        <span>&nbsp;</span>
                        Forma de pago: <input type="text" name="forma_pago_manual" id="forma_pago_manual" />
                        
					</fieldset>
                    <span class="title"  onClick="toggle('fset_cliente')" style="cursor:pointer">Datos del cliente</span>
                    <fieldset class="datosCliente" id="fset_cliente">
						<label>
							<span>&nbsp;</span>
							Introduce el cliente para la búsqueda
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
                            <span>C.I.F.</span>
                            <input type="text" size="12" name="cif" id="cif"/>
                        </label>
                        <label>
                            <span>Forma de Pago</span>
                            <input type="text" size="12" name="forma_pago" id="forma_pago"/>
                        </label>
						<label>
                            <span>Número de cuenta</span>
                            <input type="text" name="numero_cuenta" id="numero_cuenta"/>
                        </label>
						<div class="btn04">
                        	<input type="button" class="btn04" id="btn-NuevoCliente" value="Nuevo"/>
                        </div>	
                        <div class="btn05">
                            <input type="button" class="btn05" id="btn-ModificaCliente" name="btn-ModificaCliente" value="Guardar Datos"/>
                        </div>
						
                        <input type="hidden" id="id_cliente" name="id_cliente" />
                        <input type="hidden" id="id_cliente_contacto" name="id_cliente_contacto" />
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
                        <input type="hidden" id="id_cliente_direccion_envio" name="id_cliente_direccion_envio" />
                        <input type="hidden" id="total_direcciones" name="total_direcciones" />
                        <input type="hidden" id="posicion" name="posicion" />
                    </fieldset>
					
                    <span class="title"  onClick="toggle('fset_equipos');" style="cursor:pointer">Equipos</span>
                    <fieldset class="datosEquipos" id="fset_equipos">
						<table>
							<colgroup><col width="92" /><col width="350" /><col width="90" span="3" /></colgroup>
							<tr>
								<th>Referencia</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th>Importe</th>
								<th></th>
							</tr>
						</table>						
						<table id="tabla_equipos">
							<colgroup><col width="92" /><col width="350" /><col width="90" span="3" /></colgroup>
						</table>
						<table>
							<colgroup><col width="92" /><col width="350" /><col width="90" span="3" /></colgroup>
							<tr>
								<td colspan="5">Nuevo Equipo</td>
							</tr>							
							<tr>
								<th>Referencia</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th>Importe</th>
								<th></th>
							</tr>
							<tr>
								<td><input type="text" id="referencia_nuevo" name="referencia_nuevo"/></td>
								<td><textarea rows="2" cols="0" id="descripcion_nuevo" name="descripcion_nuevo"></textarea></td>
								<td><input type="text" class="input01" id="cantidad_nuevo" name="cantidad_nuevo"/></td>
								<td><input type="text" id="precio_nuevo" name="precio_nuevo"/></td>
								<td>
                                	<div class="btn04 btnPeque">
										<input type="button" class="btn04" id="btnPeque" onclick="nuevoEquipo('tabla_equipos');" value="Añadir"/>
                                    </div>
									<input type="hidden" id="num_equipos" name="num_equipos"/>
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
					</fieldset>
                    
					<div class="btn03">
	                    <input type="button" class="btn03" value="Guardar" id="btn-GuardaFactura" name="btn-GuardaFactura"/>
                    </div>
					<input type="hidden" id="es_abono" name="es_abono" />
					<input type="hidden" id="su_referencia" name="su_referencia" />					
					<input type="hidden" id="id_pedido" name="id_pedido" />
                    <input type="hidden" id="id_factura" name="id_factura" value="<?php echo $_GET['id_factura'];?>" />
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