<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/oferta_equipos.class.php");
	
	$q = $_GET["id"];
	if (!$q) return;
	
	if ($_GET['accion'] == "modificar")
		$accion = "modificar";
	else
		$accion = "nuevo";		
	
	$aEquipos = array();
	$equipos = new OfertaEquipos();
	
	$aEquipos = $equipos->getEquipos($q);

	if ($_GET['pagina'] == "pedidos")
    {
        for ($i=0;$i<count($aEquipos);$i++)
		{
			$result .= "<tr id='row_" . ($i+1). "'>\n
                        <td><input name='referencia_" . ($i+1) . "' id='referencia_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['referencia'] . "'/></td>\n
                        <td><textarea name='descripcion_" . ($i+1) . "' id='descripcion_" . ($i+1) . "' cols='0' rows='0'>" . $aEquipos[$i]['descripcion'] . "</textarea></td>\n
                        <td><input name='cantidad_" . ($i+1) . "' id='cantidad_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['cantidad'] . "' class='input01' /></td>\n
                        <td><input name='precio_" . ($i+1) . "' id='precio_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['precio'] . "' /></td>\n
                        <td><input name='precio_coste_" . ($i+1) . "' id='precio_coste_" . ($i+1) . "' type='text' /></td>\n
                        <td>
							<a href='#' onClick='buscar_equipos(\"" . ($i + 1) . "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;
                            <a href='#' onClick='borraEquipo(\"" . ($i + 1) . "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>
                            <input type='hidden' name='accion_" . ($i + 1) . "' id='accion_" . ($i + 1) . "' value='" . $accion . "'/>
                            <input type='hidden' name='id_" . ($i + 1) . "' id='id_" . ($i + 1) . "' value='" . $aEquipos[$i]['id'] . "'/>
                        </td>\n
                    </tr>\n";
        }
	}
    else if ($_GET['pagina'] == "ofertas")
    {
		for ($i=0;$i<count($aEquipos);$i++)
		{
		    $result .= "<tr id='row_" . ($i+1). "'>\n
						<td><input name='referencia_" . ($i+1) . "' id='referencia_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['referencia'] . "'/></td>\n
						<td><textarea name='descripcion_" . ($i+1) . "' id='descripcion_" . ($i+1) . "' cols='0' rows=''>" . $aEquipos[$i]['descripcion'] . "</textarea></td>\n
						<td><input name='cantidad_" . ($i+1) . "' id='cantidad_" . ($i+1) . "' type='text' class='input01' value='" . $aEquipos[$i]['cantidad'] . "' /></td>\n
						<td><input name='descuento_" . ($i+1) . "' id='descuento_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['descuento'] . "' /></td>\n
						<td><input name='precio_" . ($i+1) . "' id='precio_" . ($i+1) . "' type='text' value='" . $aEquipos[$i]['precio'] . "' /></td>\n
						<td>
                            <a href='#' class='tooltip' onClick='buscar_equipos(\"" . ($i + 1) . "\")' title='Buscar equipo - Muestra la pantalla de búsqueda de equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;
							<a href='#' class='tooltip' onClick='borraEquipo(\"" . ($i + 1) . "\")' title='Borrar equipo - Borra el equipo' ><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>
							<input type='hidden' name='accion_" . ($i + 1) . "' id='accion_" . ($i + 1) . "' value='" . $accion . "'/>
							<input type='hidden' name='id_" . ($i + 1) . "' id='id_" . ($i + 1) . "' value='" . $aEquipos[$i]['id'] . "'/>
						</td>\n
					</tr>\n";
        }
	}

	echo utf8_encode($result);
?>