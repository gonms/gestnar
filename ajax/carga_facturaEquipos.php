<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/factura_equipos.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;

	if ($_GET['accion'] == "modificar" || $_GET['accion'] == "modAbono")
		$accion = 'modificar';
	else //if ($_GET['accion'] == "duplicar")
		$accion = 'nuevo';
	
	$aEquipos = array();
	$equipos = new FacturaEquipos();
	
	$aEquipos = $equipos->getEquipos($q);
	for ($i=0;$i<count($aEquipos);$i++)
	{
        $result .= "<tr id='row_" . ($i+1). "'>\n
                        <td><input name='referencia_" . ($i+1) . "' id='referencia_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['referencia'] . "'/></td>\n
                        <td><textarea name='descripcion_" . ($i+1) . "' id='descripcion_" . ($i+1) . "' cols='0' rows='0'>" . $aEquipos[$i]['descripcion'] . "</textarea></td>\n
                        <td><input name='cantidad_" . ($i+1) . "' id='cantidad_" . ($i+1) . "' type='text' class='input01' value='" . $aEquipos[$i]['cantidad'] . "' /></td>\n
                        <td><input name='precio_" . ($i+1) . "' id='precio_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['precio'] . "' /></td>\n
                        <td>
	                        <a href='#' onClick='buscar_equipos(\"" . ($i + 1) . "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;
	                        <a href='#' onClick='borraEquipo(\"" . ($i + 1) . "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>
	                        <input type='hidden' name='accion_" . ($i + 1) . "' id='accion_" . ($i + 1) . "' value='" . $accion . "'/>
	                        <input type='hidden' name='id_" . ($i + 1) . "' id='id_" . ($i + 1) . "' value='" . $aEquipos[$i]['id'] . "'/>
                        </td>\n
                    </tr>\n";
    }
	echo utf8_encode($result);
?>