<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/pedido_equipos.class.php");
	
	$q = $_GET["id"];

	if ($_GET['accion'] == "modificar" || $_GET['accion'] == "modAbono")
		$accion = '';
	else if ($_GET['accion'] == "revision" || $_GET['accion'] == "nuevo" || $_GET['accion'] == "pedido" || $_GET['accion'] == "duplicar" || $_GET['accion'] == "abono")
		$accion = 'nuevo';
	
	if (!$q) return;
	
	$aEquipos = array();
	$equipos = new PedidoEquipos();
	
	$aEquipos = $equipos->getEquipos($q);

    if ($_GET['vieneDe'] == "pedidos")
    {
		for ($i=0;$i<count($aEquipos);$i++)
	    {
		    $result .= "<tr id='row_" . ($i+1). "'>\n
						    <td><input name='referencia_" . ($i+1) . "' id='referencia_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['referencia'] . "'/></td>\n
						    <td><textarea name='descripcion_" . ($i+1) . "' id='descripcion_" . ($i+1) . "' cols='0' rows='0'>" . $aEquipos[$i]['descripcion'] . "</textarea></td>\n
						    <td><input name='cantidad_" . ($i+1) . "' id='cantidad_" . ($i+1) . "' type='text' class='input01' value='" . $aEquipos[$i]['cantidad'] . "' /></td>\n
						    <td><input name='precio_" . ($i+1) . "' id='precio_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['precio_venta'] . "' /></td>\n
						    <td><input name='precio_coste_" . ($i+1) . "' id='precio_coste_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['precio_coste'] . "' /></td>\n
						    <td>
							    <a href='#' onClick='buscar_equipos(\"" . ($i + 1) . "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;
							    <a href='#' onClick='borraEquipo(\"" . ($i + 1) . "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>
							    <input type='hidden' name='accion_" . ($i + 1) . "' id='accion_" . ($i + 1) . "' value='" . $accion . "'/>
							    <input type='hidden' name='id_" . ($i + 1) . "' id='id_" . ($i + 1) . "' value='" . $aEquipos[$i]['id'] . "'/>
						    </td>\n
					    </tr>\n";
	    }
    }
    else if ($_GET['vieneDe'] == "acusepedido")
    {
		for ($i=0;$i<count($aEquipos);$i++)
        {
            $result .= "<tr id='row_" . ($i+1). "'>\n
                            <td><input name='referencia_" . ($i+1) . "' id='referencia_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['referencia'] . "'/></td>\n
                            <td><textarea name='descripcion_" . ($i+1) . "' id='descripcion_" . ($i+1) . "' cols='0' rows='0'>" . $aEquipos[$i]['descripcion'] . "</textarea></td>\n
                            <td><input name='cantidad_" . ($i+1) . "' id='cantidad_" . ($i+1) . "' type='text' class='input01' value='" . $aEquipos[$i]['cantidad'] . "' /></td>\n
                            <td><input name='precio_" . ($i+1) . "' id='precio_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['precio_venta'] . "' /></td>\n
                            <td><input name='plazo_entrega_" . ($i+1) . "' id='plazo_entrega_" . ($i+1) . "' type='text' /></td>\n
                            <td>
                                <a href='#' onClick='buscar_equipos(\"" . ($i + 1) . "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;
                                <a href='#' onClick='borraEquipo(\"" . ($i + 1) . "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>
                                <input type='hidden' name='accion_" . ($i + 1) . "' id='accion_" . ($i + 1) . "' value='" . $accion . "'/>
                                <input type='hidden' name='id_" . ($i + 1) . "' id='id_" . ($i + 1) . "' value='" . $aEquipos[$i]['id'] . "'/>
                            </td>\n
                        </tr>\n";
        }
    }
    else if ($_GET['vieneDe'] == "ordencompra")
    {
		for ($i=0;$i<count($aEquipos);$i++)
        {
            $result .= "<tr>\n
                            <td><div class='btn05'><input type='button' class='btn05' value='incluir' onClick='anadeEquipo(\"" . $aEquipos[$i]['id'] . "\")' /></div></td>\n
                            <td><input name='p_referencia_" . $aEquipos[$i]['id'] . "' id='p_referencia_" . $aEquipos[$i]['id'] . "' type='text' value='" . $aEquipos[$i]['referencia'] . "'/></td>\n
                            <td><textarea name='p_descripcion_" . $aEquipos[$i]['id'] . "' id='p_descripcion_" . $aEquipos[$i]['id'] . "' cols='0' rows='0'>" . $aEquipos[$i]['descripcion'] . "</textarea></td>\n
                            <td><input name='p_cantidad_" . $aEquipos[$i]['id'] . "' id='p_cantidad_" . $aEquipos[$i]['id'] . "' type='text' class='input01' value='" . $aEquipos[$i]['cantidad'] . "' /></td>\n
                            <td><input name='p_importe_" . $aEquipos[$i]['id'] . "' id='p_importe_" . $aEquipos[$i]['id'] . "' type='text' value='" . $aEquipos[$i]['precio_coste'] . "' /></td>\n
                        </tr>\n";
        }
    }
	else if ($_GET['vieneDe'] == "albaran")
    {
        for ($i=0;$i<count($aEquipos);$i++)
        {
            $result .= "<tr id='row_" . ($i+1). "'>\n
                            <td><input name='referencia_" . ($i+1) . "' id='referencia_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['referencia'] . "'/></td>\n
                            <td><textarea name='descripcion_" . ($i+1) . "' id='descripcion_" . ($i+1) . "' cols='0' rows='0'>" . $aEquipos[$i]['descripcion'] . "</textarea></td>\n
                            <td><input name='cantidad_" . ($i+1) . "' id='cantidad_" . ($i+1) . "' type='text' class='input01' value='" . $aEquipos[$i]['cantidad'] . "' /></td>\n
                            <td><input name='precio_" . ($i+1) . "' id='precio_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['precio_venta'] . "' /></td>\n
                            <td>
                                <a href='#' onClick='buscar_equipos(\"" . ($i + 1) . "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;
                                <a href='#' onClick='borraEquipo(\"" . ($i + 1) . "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>
                                <input type='hidden' name='accion_" . ($i + 1) . "' id='accion_" . ($i + 1) . "' value='" . $accion . "'/>
                                <input type='hidden' name='id_" . ($i + 1) . "' id='id_" . ($i + 1) . "' value='" . $aEquipos[$i]['id'] . "'/>
                            </td>\n
                        </tr>\n";
        }
    }
	else if ($_GET['vieneDe'] == "facturas")
    {
        for ($i=0;$i<count($aEquipos);$i++)
        {
            $result .= "<tr id='row_" . ($i+1). "'>\n
                            <td><input name='referencia_" . ($i+1) . "' id='referencia_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['referencia'] . "'/></td>\n
                            <td><textarea name='descripcion_" . ($i+1) . "' id='descripcion_" . ($i+1) . "' cols='0' rows='0'>" . $aEquipos[$i]['descripcion'] . "</textarea></td>\n
                            <td><input name='cantidad_" . ($i+1) . "' id='cantidad_" . ($i+1) . "' type='text' class='input01' value='" . $aEquipos[$i]['cantidad'] . "' /></td>\n
                            <td><input name='precio_" . ($i+1) . "' id='precio_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['precio_venta'] . "' /></td>\n
                            <td>
                                <a href='#' onClick='buscar_equipos(\"" . ($i + 1) . "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;
                                <a href='#' onClick='borraEquipo(\"" . ($i + 1) . "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>
                                <input type='hidden' name='accion_" . ($i + 1) . "' id='accion_" . ($i + 1) . "' value='" . $accion . "'/>
                                <input type='hidden' name='id_" . ($i + 1) . "' id='id_" . ($i + 1) . "' value='" . $aEquipos[$i]['id'] . "'/>
                            </td>\n
                        </tr>\n";
        }
    }
	echo utf8_encode($result);
?>