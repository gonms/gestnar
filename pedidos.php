<?php 
    include("includes/security.php");
	$accion = (empty($_GET['accion'])) ? "nuevo" : $_GET['accion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Pedidos - Gestnar</title>
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
    <script type="text/javascript" src="js/funciones_pedidos.js"></script>    
    <script type="text/javascript" src="js/funciones_equipos.js"></script>    
</head>

<body>
    <div id="wrapper">
        <div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
        <ul id="navBar">
            <li <?php echo (($accion == "nuevo")?"class='first sel'":"");?>><a href="pedidos.php?accion=nuevo"><span>Nuevo</span></a></li>
            <li <?php echo (($accion == "modificar")?"class='first sel'":"");?>><a href="pedidos.php?accion=modificar"><span>Modificar</span></a></li>
            <li <?php echo (($accion == "revision")?"class='first sel'":"");?>><a href="pedidos.php?accion=revision"><span>Revisión</span></a></li>
			<li class="last"><a href="#" id="volver"><span>Volver</span></a></li>
        </ul>
        <hr />
        
        <div id="content">
            <div class="module inter">
                
                <form method="post" action="guarda_pedido.php" id="fPedido" class="ofertas">
                    <span class="title"  onClick="toggle('fset_pedido')" style="cursor:pointer">Datos del pedido</span>
                    <fieldset class="datosOferta" id="fset_pedido">
                        <?php
						if ($accion == "nuevo")
						{
						?>
						<label>
                            <span>&nbsp;</span>
                            Introduce el número de oferta
                        </label>
						<label>
                            <span>Número de oferta</span>
                            <input type="text" class="input90" id="numero_oferta" name="numero_oferta" />
                        </label>    
                        <label class="small">
                            <span>Código de pedido</span>
                            <input type="text" size="5" id="codigo_pedido" name="codigo_pedido"/>
                        </label>      
                        <label class="small">
                            <span>Número de pedido</span>
                            <input type="text" size="5" id="numero_pedido" name="numero_pedido"/>
                        </label>
						<?php
						}
						else
						{
						?>
                        <label>
                            <span>&nbsp;</span>
                            Introduce el número de pedido
                        </label>
						<label>
                            <span>Número de pedido</span>
                            <input type="text" class="input70" id="numero_pedido" name="numero_pedido"/>
                        </label>
                        <label class="small">
                            <span>Código de pedido</span>
                            <input type="text" size="5" id="codigo_pedido" name="codigo_pedido"/>
                        </label>
                        <?php
                            if ($accion != "nuevo")
                            {
                        ?>
                            <label>
                                <span>Revisión</span>
                                <input type="text" id="revision" name="revision" class="input01 disabled" readonly="readonly" />
								<?php
								if ($accion != "modificar")
									echo "(El número de revisión se calcula automáticamente)";
								?>
                            </label>
                        <?php
                            }
                        ?>
						<label>
                            <span>Número de oferta</span>
                            <input type="text" class="input90 disabled" id="numero_oferta" name="numero_oferta" readonly="readonly" />
                        </label>
						<?php
						}
						?>
                        <label>
                            <span>Fecha</span>
                            <input type="text" class="inputFecha" name="fecha" id="fecha"/> (d/m/a)
                        </label>                        
                        <label>
                            <span>Forma de pago</span>
                            <input type="text" size="10" name="forma_pago1" id="forma_pago1" maxlength="35" />
                        </label>
						<label>
                            <span>&nbsp;</span>
                            <input type="text" size="10" name="forma_pago2" id="forma_pago2" maxlength="35" />
                        </label>
                        <label>
                            <span>De fecha</span>
                            <input type="text" class="inputFecha" name="de_fecha" id="de_fecha"/> (d/m/a)
                        </label>                        
                        <label>
                            <span>Fecha envío</span>
                            <input type="text" class="inputFecha" name="fecha_envio" id="fecha_envio"/> (d/m/a)
                        </label>                        
                        <label>
                            <span>Portes</span>
                            <input type="text" size="10" name="portes" id="portes"/>
                        </label>                        
                        <label>
                            <span>Su referencia</span>
                            <input type="text" size="10" name="su_referencia" id="su_referencia"/>
                        </label>
                        <label class="small">
                            <span>Agente</span>
                            % <input type="text" size="5" id="porcentaje_agente" name="porcentaje_agente"/>
						</label>
						<label class="small">
							<span>&nbsp;</span>
                            a: <input type="text" size="15" id="agente" name="agente" style="width:150px" />
                        </label> 
                    </fieldset>
                                     
                    <span class="title"  onClick="toggle('fset_cliente')" style="cursor:pointer">Datos del cliente</span>
                    <fieldset class="datosCliente" id="fset_cliente">
                    	<label>
                            <span>&nbsp;</span>
                            Introduce el cliente para la búsqueda
                        </label>             
                        <label>
                            <span>Empresa</span>
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
                            <span>P. Contacto</span>
                            <select id="id_contacto" name="id_contacto">
                                <option value="">Selecciona...</option>
								<option value="nuevo">Nuevo</option>
                            </select>
                        </label>
						<label id="div_persona_contacto" style="display: none;">
                        	<span>&nbsp;</span>
							<input type="text" size="35" name="persona_contacto_nuevo" id="persona_contacto_nuevo" />
						</label>
						<div class="btn04">
                        	<input type="button" class="btn04" id="btn-NuevoCliente" value="Nuevo"/>
                        </div>
						<div class="btn05">
                            <input type="button" class="btn05" id="btn-ModificaCliente" name="btn-ModificaCliente" value="Guardar Datos"/>
                        </div>
						
                        <input type="hidden" id="id_cliente" name="id_cliente" />
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
                            <input type="text" name="de_localidad" id="de_localidad"/>
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
                    
                    <span class="title"  onClick="toggle('fset_equipos');" style="cursor:pointer">Equipos</span>
                    <fieldset class="datosEquipos" id="fset_equipos">
                        <table>
                            <colgroup><col width="92" /><col width="350" /><col width="60" /><col width="80" span="3" /></colgroup>
                            <tr>
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio Venta</th>
                                <th>Precio Coste</th>
                                <th></th>
                            </tr>
                        </table>
                        <table id="tabla_equipos">
                        	<colgroup><col width="92" /><col width="350" /><col width="60" /><col width="80" span="3" /></colgroup>
                        </table>
                        <table>
							<colgroup><col width="92" /><col width="350" /><col width="60" /><col width="80" span="3" /></colgroup>
                            <tr>
                                <td colspan="6">Nuevo Equipo</td>
                            </tr>
                            <tr>
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio Venta</th>
                                <th>Precio Coste</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td><input type="text" id="referencia_nuevo" name="referencia_nuevo"/></td>
                                <td><textarea rows="" cols="0" id="descripcion_nuevo" name="descripcion_nuevo"></textarea></td>
                                <td><input type="text" class="input01" id="cantidad_nuevo" name="cantidad_nuevo"/></td>
                                <td><input type="text" id="precio_nuevo" name="precio_nuevo"/></td>
                                <td><input type="text" id="precio_coste_nuevo" name="precio_coste_nuevo"/></td>
                                <td>
                                    <div class="btn04 btnPeque">
                                        <input type="button" class="btn04" id="btnPeque" onclick="nuevoEquipo('tabla_equipos');" value="Añadir"/>
                                    </div>
                                    <input type="hidden" id="num_equipos" name="num_equipos"/>
                                </td>
                            </tr>
							<tr>
                                <td colspan="6">
                                    <div id="button" class="btn04">
                                        <input type="button" value="Buscar equipo" class="btn04"/>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <span class="title"  onClick="toggle('fset_proveedores');sacaNumeroProveedor();" style="cursor:pointer">Pedido a proveedores</span>
                    <fieldset class="datosEquipos" id="fset_proveedores">
                        <table id="tabla_proveedores">
                            <colgroup><col width="300" /><col width="60" span="4" /></colgroup>
                            <tr>
                                <th>Empresa</th>
                                <th>Número</th>
                                <th>Fecha</th>
                                <th>Importe</th>
                                <th>F.Entrega</th>
								<th>&nbsp;</th>
                            </tr>
						</table>
                        <table>
                            <colgroup><col width="300" /><col width="60" span="4" /></colgroup>
                            <tr>
                                <th>Empresa</th>
                                <th>Número</th>
                                <th>Fecha</th>
                                <th>Importe</th>
                                <th>F.Entrega</th>
                            </tr>
                            <tr>
                                <td><input type="text" class="input02" id="prov_empresa_nuevo" name="prov_empresa_nuevo"/></td>
                                <td><input type="text" id="prov_numero_nuevo" name="prov_numero_nuevo" size='15'/></td>
                                <td><input type="text" id="prov_fecha_nuevo" name="prov_fecha_nuevo"/></td>
                                <td><input type="text" id="prov_importe_nuevo" name="prov_importe_nuevo"/></td>
                                <td><input type="text" id="prov_fecha_entrega_nuevo" name="prov_fecha_entrega_nuevo"/></td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div class="btn04">
                                        <input type="button" class="btn04" value="Añadir" onclick="nuevoProveedor('tabla_proveedores');" />
                                    </div>
                                    <input type="hidden" id="num_proveedores" name="num_proveedores"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <span class="title" onClick="toggle('fset_requerimientos')" style="cursor:pointer">Requerimientos exigidos al pedido</span>
                    <fieldset class="checkboxes" id="fset_requerimientos">
                        <label>
                            <input type="checkbox" class="check" name="chkReq1" id="chkReq1" /><span>Descripción del material</span>
                        </label>                          
                        <label>
                            <input type="checkbox" class="check" name="chkReq2" id="chkReq2" /><span>Especificación técnica (suministro)</span>
                        </label>                      
                        <label>
                            <input type="checkbox" class="check" name="chkReq3" id="chkReq3" /><span>Expediente de calidad</span>
                        </label>                     
                        <label>
                            <input type="checkbox" class="check" name="chkReq4" id="chkReq4" /><span>Estándar</span>
                        </label>                 
                        <label>
                            <input type="checkbox" class="check" name="chkReq5" id="chkReq5" /><span>Estándar: (s/EN 10 204)</span>
                        </label>                  
                        <label>
                            <input type="checkbox" class="check" name="chkReq6" id="chkReq6" /><span>Excepcionales a la estandar si las hubiera</span>
                        </label>                 
                        <label>
                            <input type="checkbox" class="check" name="chkReq7" id="chkReq7" /><span>Testificación de conformidad con el pedido  "2.1."</span>
                        </label>                 
                        <label>
                            <input type="checkbox" class="check" name="chkReq8" id="chkReq8" /><span>Especificación de envío</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq9" id="chkReq9" /><span>Testificación de Inspección "2.2"</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq10" id="chkReq10" /><span>Placas de identificación</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq11" id="chkReq11" /><span>Otros (si requieren)</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq12" id="chkReq12" /><span>Tipo de embalaje</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq13" id="chkReq13" /><span>Certificado de materiales</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq14" id="chkReq14" /><span>Dirección de envío</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq15" id="chkReq15" /><span>Otros especificos del pedido</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq16" id="chkReq16" /><span>Transportista</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq17" id="chkReq17" /><span>Planos de ejecución o generales de implantación</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq18" id="chkReq18" /><span>Albarán de envío</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq19" id="chkReq19" /><span>Especificaciones, Libros o Instrucciones de montaje, ajuste y equilibrado</span>
                        </label>                
                        <label>
                            <input type="checkbox" class="check" name="chkReq20" id="chkReq20" /><span>Persona de contacto y teléfono si la hubiera</span>
                        </label>
                    </fieldset>
                    
                    <div class="btn03">
                        <input type="button" class="btn03" value="Guardar" id="btn-GuardaPedido" name="btn-GuardaPedido"/>    
                    </div>
                    <input type="hidden" id="id_oferta" name="id_oferta" />
                    <input type="hidden" id="id_pedido" name="id_pedido" value="<?php echo $_GET['id_pedido'];?>" />
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