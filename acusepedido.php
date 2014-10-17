<?php 
	include("includes/security.php");
    $accion = (empty($_GET['accion'])) ? "nuevo" : $_GET['accion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Acuse de pedido - Gestnar</title>
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
    <script type="text/javascript" src="js/funciones_acusepedido.js"></script>
    <script type="text/javascript" src="js/funciones_equipos.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
        <ul id="navBar">
            <li <?php echo (($accion == "nuevo")?"class='first sel'":"");?>><a href="acusepedido.php?accion=nuevo"><span>Nuevo</span></a></li>
            <li <?php echo (($accion == "modificar")?"class='first sel'":"");?>><a href="acusepedido.php?accion=modificar"><span>Modificar</span></a></li>
            <li <?php echo (($accion == "revision")?"class='first sel'":"");?>><a href="acusepedido.php?accion=revision"><span>Revisión</span></a></li>
			<li class="last"><a href="#" id="volver"><span>Volver</span></a></li>
        </ul>
        <hr />
        
        <div id="content">
            <div class="module inter">
                
                <form method="post" action="guarda_acusepedido.php" id="fAcusePedido" class="ofertas">
                    <span class="title"  onClick="toggle('fset_acuse');" style="cursor:pointer">Acuse de pedido</span>    
                    <fieldset class="datosOferta" id="fset_acuse">
                    	<label>
                            <span>Introduce el número de pedido:</span>
                        </label>
						<br /><br />
                        <label>
                            <span>Número de pedido</span>
                            <input type="text" class="input70" id="numero_pedido" name="numero_pedido" />
                        </label>
                        <label>
                            <span>Código de pedido</span>
                            <input type="text" class="input50" id="codigo_pedido" name="codigo_pedido" />
                        </label>
						<?php 
						if ($accion != "nuevo")
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
                            <span>Fecha</span>
                            <input type="text" class="inputFecha" name="fecha" id="fecha"/> (d/m/a)
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
                            <span>Forma de envío</span>
                            <input type="text" size="10" name="forma_envio" id="forma_envio"/>
                        </label>
                    </fieldset>
                    
                    <span class="title"  onClick="toggle('fset_equipos');" style="cursor:pointer">Equipos</span>
                    <fieldset class="datosEquipos" id="fset_equipos">
                        <table>
                            <colgroup><col width="92" /><col width="390" /><col width="90" span="4" /></colgroup>
                            <tr>
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Plazo Entrega</th>
                                <th></th>
                            </tr>
                        </table>
                        <table id="tabla_equipos">
                        	<colgroup><col width="92" /><col width="390" /><col width="90" span="4" /></colgroup>
                        </table>
                        <table>
                            <colgroup><col width="92" /><col width="390" /><col width="90" span="4" /></colgroup>
							<tr>
                                <td colspan="6">Nuevo Equipo</td>
                            </tr>
                            <tr>
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Plazo Entrega</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td><input type="text" id="referencia_nuevo" name="referencia_nuevo"/></td>
                                <td><textarea rows="2" cols="0" id="descripcion_nuevo" name="descripcion_nuevo"></textarea></td>
                                <td><input type="text" class="input01" id="cantidad_nuevo" name="cantidad_nuevo"/></td>
                                <td><input type="text" id="precio_nuevo" name="precio_nuevo"/></td>
                                <td><input type="text" id="plazo_entrega_nuevo" name="plazo_entrega_nuevo"/></td>
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
                        <input type="button" class="btn03" value="Guardar" id="btn-GuardaAcusePedido" name="btn-GuardaAcusePedido"/>  
                    </div>
                    <input type="hidden" id="id_acusepedido" name="id_acusepedido" value="<?php echo $_GET['id_acusepedido'];?>" />
                    <input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>" />
					<input type="hidden" name="id_pedido" id="id_pedido" />
                    <input type="hidden" name="id_cliente" id="id_cliente" />
                    <input type="hidden" name="id_cliente_direccion_envio" id="id_cliente_direccion_envio" />
                    <input type="hidden" name="su_referencia" id="su_referencia" />
                    <input type="hidden" name="fecha_envio" id="fecha_envio" />
                    <input type="hidden" name="de_fecha" id="de_fecha" />
                    <input type="hidden" name="forma_pago" id="forma_pago" />                    
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