<?php
	include("../includes/conf.php");

	$sql = "SELECT * FROM descripciones WHERE grupo = '" . $_GET['grupo'] . "' ORDER BY Nombre, Tipo";
	$res = mysql_query($sql);
	//$result = "<div style='width:380px'><div style='float:left;width:190px'>Nombre</div><div style='float:left;width:190px'>Tipo</div></div>\n";
	$result = "<table border='0' cellpadding='2' cellspacing='3' width='380px'>\n";
	$result .= "<tr>\n";
	$result .= "<td><strong>Nombre</strong></td>";
	$result .= "<td><strong>Tipo</strong></td>";
	$result .= "</tr>\n";
	$i = 0;
	while ($row = mysql_fetch_array($res))
	{		
		$bgcolor = ($i % 2 == 0)?"#DDDDDD":"#FFFFFF";
		
		$result .= "<tr bgcolor='" . $bgcolor . "'>\n";
		$result .= "<td><a ref='#' class='enlace_equipo' title='" . $row['Definicion'] . "' alt='" . $row['Definicion'] . "'  onClick='sacaEquipos(\"" . $row['Tabla'] . "\",\"" . $row['Subgrupo'] . "\",\"" . $row['Definicion'] . "\");'>" . $row['Nombre'] . "</a></td>";
		$result .= "<td>" . ((empty($row['Tipo']))?"&nbsp;":$row['Tipo']) . "</td>";
		$result .= "</tr>\n";
		
		/*
		$result .= "<div class='descripcion' title='" . $row['Definicion'] . "' alt='" . $row['Definicion'] . "' style='width:380px' onClick='sacaEquipos(\"" . $row['Tabla'] . "\",\"" . $row['Subgrupo'] . "\",\"" . $row['Definicion'] . "\");'>\n
						<div style='float:left;width:190px'>" . $row['Nombre'] . "</div><div style='float:left;width:190px'>" . ((empty($row['Tipo']))?"&nbsp;":$row['Tipo']) . "</div>
					</div>\n";
		*/
		$i++;
	}
	echo "</table>";
	echo utf8_encode($result);
?>