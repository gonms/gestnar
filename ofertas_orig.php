<?php 
    include("includes/security.php");
	$accion = (empty($_GET['accion'])) ? "nuevo" : $_GET['accion'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ofertas - Gestnar</title>
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
    <script type="text/javascript" src="js/funciones_ofertas.js"></script>    
    <script type="text/javascript" src="js/funciones_equipos.js"></script>    
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
        <ul id="navBar">
            <li <?php echo (($accion == "nuevo")?"class='first sel'":"");?>><a href="ofertas.php?accion=nuevo"><span>Nueva</span></a></li>
            <li <?php echo (($accion == "modificar")?"class='first sel'":"");?>><a href="ofertas.php?accion=modificar"><span>Modificar</span></a></li>
            <li <?php echo (($accion == "duplicar")?"class='first sel'":"");?>><a href="ofertas.php?accion=duplicar"><span>Duplicar</span></a></li>
            <li <?php echo (($accion == "revision")?"class='first sel'":"");?>><a href="ofertas.php?accion=revision"><span>Revisión</span></a></li>
            <li <?php echo (($accion == "multioferta")?"class='first sel'":"");?>><a href="ofertas.php?accion=multioferta"><span>Multioferta</span></a></li>
            <li <?php echo (($accion == "revMultioferta")?"class='first sel'":"");?>><a href="ofertas.php?accion=revMultioferta"><span>Revisión Multioferta</span></a></li>
			<li class="last"><a href="#" id="volver"><span>Volver</span></a></li>
        </ul>
        <hr />
        
    	<div id="content">
        	<div class="module inter">
				<form method="post" action="guarda_oferta.php" id="fOferta" class="ofertas">
                    <span class="title" onClick="toggle('fset_oferta')" style="cursor:pointer">Datos de la oferta</span>
                    <fieldset id="fset_oferta" class="datosOferta">
                    	<?php
						if ($accion != "nuevo")
						{
						?>
						<label>
                    		<span>&nbsp;</span>
							Introduce el número de oferta
						</label>
						<?php
						}
						?>
                        <label class="small">
                            <span>Número de oferta</span>
                            <input type="text" id="codigo" name="codigo" disabled="true" value="<?php echo $_SESSION['codigo_oferta'];?>" class="disabled" />
							-
                            <select id="departamento" name="departamento">
                                <option value="">Dpto</option>
                                <option value="PR">Presión</option>
                                <option value="LL">Lámina libre</option>
                                <option value="HD">Hidrometría</option>
                            </select>
							-
                            <input type="text" id="numero" name="numero" />
                        </label> 
                        <?php
                            if ($accion != "nuevo" && $accion != "duplicar")
                            {
                            	if ($accion != "modificar")
								{
									$txt = ($accion == "multioferta") ? "multioferta" : "revisión";
								}
                        ?>
                            <label>
                                <span id="label_extra">Revisión / Multioferta</span>
                                <input type="text" id="extra" name="extra" class="input01" />
								<?php 
									echo "(El número de " . $txt . " se calcula automáticamente)";
								?>
                            </label>
                        <?php
                            }
                            if ($accion == "duplicar")
                            {
                        ?>
                        <label>                          	
                        	<span id="txtNumero">Nuevo número de Oferta</span>
							<input type="text" class="input70" name="nuevo_numero_oferta" id="nuevo_numero_oferta"/>
						</label>
						<?php
						}
						?>
                        <label>
                            <span>Obra</span>
                            <input type="text" id="obra" name="obra" />
                        </label>
                        <label>
                            <span>Fecha recepción</span>
                            <input type="text" class="inputFecha" name="fecha_recepcion" id="fecha_recepcion"/> (d/m/a)
                        </label>                        
                        <label>
                            <span>Fecha de envío</span>
                            <input type="text" class="inputFecha" name="fecha_envio" id="fecha_envio"/> (d/m/a)
                        </label>                        
                        <label>
                            <span>Condiciones de pago</span>
                            <input type="text" size="15" name="condiciones_pago1" id="condiciones_pago1" maxlength="75" />
						</label>
						<label>
                            <span>&nbsp;</span>
							<input type="text" size="15" name="condiciones_pago2" id="condiciones_pago2" maxlength="75" />
                        </label>                        
                        <label>
                            <span>Plazo de entrega</span>
							<input type="text" size="15" name="plazo_entrega1" id="plazo_entrega1" maxlength="27" />
                        </label>
						<label>
                            <span>&nbsp;</span>
							<input type="text" size="15" name="plazo_entrega2" id="plazo_entrega2" maxlength="27" />
                        </label>
                        <label>
                            <span>Embalaje</span>
                            <input type="text" name="embalaje" id="embalaje"/>
                        </label>                            
                        <label>
                            <span>Transporte</span>
                            <input type="text" name="mercancia_franco" id="mercancia_franco" />
                        </label>
                        <label>
                            <span>Validez oferta</span>
                            <input type="text" size="15" name="validez_oferta" id="validez_oferta"/>
                        </label>                            
                        <label>
                            <span>Tipo</span>
                            <select id="tipo" name="tipo">
                                <option value="">Selecciona...</option>
                                <option value="A">Contacto Clientes</option>
                                <option value="B">Proyectos Ingeniería</option>
                                <option value="C">Proyectos en Licitación</option>
                                <option value="D">Obras Adjudicadas</option>
                                <option value="E">Ofertas Directas</option>
                            </select>
                        </label>                            
                        <label>
                            <span>Situación</span>
                            <select id="situacion" name="situacion">
                                <option value="">Selecciona...</option>
                                <option value="C">En Curso</option>
                                <option value="P">Perdida</option>
                                <option value="PD">Pasa a Pedido</option>
                            </select>
                        </label>
                        <label>
                            <span>I.V.A.</span>
                            <input type="text" class="input01" id="iva" name="iva" value="21"/>
                        </label>
                    </fieldset>
                    
                    <span class="title" onclick="toggle('fset_cliente');" style="cursor:pointer"> Datos del cliente</span>
                    <fieldset id="fset_cliente" class="datosCliente">
                    	<label>
                            <span>&nbsp;</span>
                            Introduce el cliente para la búsqueda
                        </label>
                        <label>
                            <span>Empresa</span>
                            <input type="text" size="35" name="empresa" id="empresa" autocomplete="off" class="ac_input"/>
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
                        
                        <input type="hidden" id="id_cliente" name="id_cliente"/>
                        <input type="hidden" value="modificar" id="tipo_cliente" name="tipo_cliente"/>
                        <div id="txtConfirmacion"></div>
                    </fieldset>
                    
                    <span class="title" onClick="toggle('fset_equipos')" style="cursor:pointer">Equipos</span>                        
                    <fieldset id="fset_equipos" class="datosEquipos">
                        <table>
							<colgroup><col width="75" /><col width="360" /><col width="78" /><col width="75" /><col width="90" /><col width="90" /></colgroup>
                            <tr>
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Descuento</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                        </table>
                        <table id="tabla_equipos">
                        	<colgroup><col width="75" /><col width="360" /><col width="78" /><col width="75" /><col width="90" /><col width="90" /></colgroup>
                        </table>
                        <table>
							<colgroup><col width="75" /><col width="360" /><col width="78" /><col width="75" /><col width="90" /><col width="90" /></colgroup>
                            <tr>
                                <td colspan="6">Nuevo Equipo</td>
                            </tr>
                            <tr>
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Descuento</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>

                            <tr>
                                <td><input type="text" id="referencia_nuevo" name="referencia_nuevo"/></td>
                                <td><textarea rows="0" cols="0" id="descripcion_nuevo" name="descripcion_nuevo"></textarea></td>
                                <td><input type="text" class="input01" id="cantidad_nuevo" name="cantidad_nuevo"/></td>
                                <td><input type="text" class="input01" id="descuento_nuevo" name="descuento_nuevo"/></td>
                                <td><input type="text" id="precio_nuevo" name="precio_nuevo"/></td>
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
                    <div class="btn03">
                        <input type="button" class="btn03" value="Guardar" id="btn-GuardaOferta" name="btn-GuardaOferta"/>    
                    </div>
                        
                    <input type="hidden" id="id_oferta" name="id_oferta" value="<?php echo $_GET['id_oferta'];?>" />
                    <input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>" />
                    <input type="hidden" id="tipo_oferta" name="tipo_oferta"/>        
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