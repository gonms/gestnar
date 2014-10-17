<?php 
    include("includes/security.php");
	$accion = (empty($_GET['accion'])) ? "nuevo" : $_GET['accion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Albarán - Gestnar</title>
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
    <script type="text/javascript" src="js/funciones_albaranes.js"></script>    
    <script type="text/javascript" src="js/funciones_equipos.js"></script>
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" id="logo" /></h1>
        </div>
        <hr />
        
       <ul id="navBar">
        	<li <?php echo (($accion == "nuevo")?"class='first sel'":"");?>><a href="albaranes.php?accion=nuevo"><span>Nuevo</span></a></li>
        	<li <?php echo (($accion == "pedido")?"class='first sel'":"");?>><a href="albaranes.php?accion=pedido"><span>De pedido</span></a></li>
			<li <?php echo (($accion == "modificar")?"class='first sel'":"");?>><a href="albaranes.php?accion=modificar"><span>Modificar</span></a></li>
			<li class="last"><a href="#" id="volver"><span>Volver</span></a></li>
        </ul>
        <hr />
        
    	<div id="content">
        	<div class="module inter">
				
				<form method="post" action="guarda_albaran.php" id="fAlbaran" class="ofertas">
                    <span class="title" onClick="toggle('fset_albaran')" style="cursor:pointer">Albarán</span>
                    <fieldset class="datosOferta" id="fset_albaran">
                    	<?php
						if ($accion == "pedido" || $accion == "nuevo")
						{
							if ($accion == "pedido")
							{
						?>
						<label>
							<span>&nbsp;</span>
							Introduce el número de pedido
						</label>
						<?php
							}
						?>
						<label>
                        	<span>Número de Pedido</span>
							<input type="text" class="input70" name="numero_pedido" id="numero_pedido"/>
                        </label>
						<?php
						}
						else if ($accion == "modificar")
						{
						?>
						<label>
							<span>&nbsp;</span>
							Introduce el número de albarán
						</label>
						<?php
						}
						?>
						<label>
                        	<span>Número de Albarán</span>
							<input type="text" class="input70" name="numero_albaran" id="numero_albaran"/>
                        </label>      
						<?php
						if ($accion == "modificar")
						{
						?>
						<label id="lPedido">
                        	<span>Número de Pedido</span>
							<input type="text" class="input70" name="numero_pedido" id="numero_pedido"/>
                        </label>
						<?php
						}
						?>
						<label>
                        	<span>Fecha</span>
							<input type="text" class="inputFecha" name="fecha" id="fecha" /> (d/m/a)
                        </label>
						<label>
                        	<span>Asunto</span>
							<input type="text" style="width:150px" name="asunto" id="asunto" />
                        </label>
						<label>
                        	<span>Enviado</span>
							<input type="text" style="width:150px" name="enviado" id="enviado"/>
                        </label>
						<label>
                        	<span>Tipo</span>
							<select name="tipo" id="tipo" style="width:100px" />
								<option value="valorado">Valorado</option>
								<option value="no_valorado">No valorado</option>
							</select>
                        </label>
						<label id="lIVA">
                        	<span>IVA</span>
							<input type="text" class="input01" name="iva" id="iva" value="21" />
                        </label>
					</fieldset>
					
                    <span class="title" onClick="toggle('fset_cliente')" style="cursor:pointer">Datos del cliente</span>
                    <fieldset class="datosCliente" id="fset_cliente">
                        <label>
                            <span>Destinatario</span>
                            <input type="text" size="35" name="destinatario1" id="destinatario1" />
                        </label>                                  
                        <label>
                            <span>&nbsp;</span>
                            <input type="text" size="35" name="destinatario2" id="destinatario2" />
                        </label>                        
                        <label>
                            <span>&nbsp;</span>
                            <input type="text" size="35" name="destinatario3" id="destinatario3" />
                        </label>                        
                        <label>
                            <span>&nbsp;</span>
                            <input type="text" size="35" name="destinatario4" id="destinatario4" />
                        </label>                        
                        <label>
                            <span>P. Contacto</span>
                            <input type="text" name="contacto1" id="contacto1" />
                        </label>
                        <label>
                            <span>&nbsp;</span>
                            <input type="text" name="contacto2" id="contacto2" />
                        </label>						
                    </fieldset>
					
                    <span class="title"  onClick="toggle('fset_equipos');" style="cursor:pointer">Equipos</span>
                    <fieldset class="datosEquipos" id="fset_equipos">
						<table>
							<colgroup><col width="92" /><col width="320" /><col width="90" span="3" /></colgroup>
							<tr>
								<th>Referencia</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th class="texto">Importe</th>
								<th></th>
							</tr>
						</table>
						<table id="tabla_equipos">
							<colgroup><col width="92" /><col width="325" /><col width="90" span="3" /></colgroup>
						</table>
						<table>
							<colgroup><col width="92" /><col width="325" /><col width="90" span="3" /></colgroup>
							<tr>
								<td colspan="5">Nuevo Equipo</td>
							</tr>							
							<tr>
								<th>Referencia</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th class="texto">Importe</th>
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
	                    <input type="button" class="btn03" value="Guardar" id="btn-GuardaAlbaran" name="btn-GuardaAlbaran"/>	
                    </div>
					<input type="hidden" id="id_pedido" name="id_pedido" />
                    <input type="hidden" id="id_albaran" name="id_albaran" value="<?php echo $_GET['id_albaran'];?>" />
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