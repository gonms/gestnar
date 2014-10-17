<?php
	include("../includes/conf.php");

	$sql = "SELECT * FROM " . $_POST['tabla'] . " WHERE subgrupo = '" . $_POST['subgrupo'] . "'";
	$res = mysql_query($sql);
	
	$aTitulos = $aAnchos = $aCampos = array();
	
	switch ($_POST['tabla'])
	{
		case "presion_compuerta":
		case "presion_drenar":
				$aTitulos[] = 'DN';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 80;
				$aAnchos[] = 200;
				$aAnchos[] = 100;
				$aCampos[] = 'DN';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "presion_chorro":
		case "presion_narsonic":
				$aTitulos[] = 'DN';
				$aTitulos[] = 'PN';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 50;
				$aAnchos[] = 50;
				$aAnchos[] = 200;
				$aAnchos[] = 80;
				$aCampos[] = 'DN';
				$aCampos[] = 'PN';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "presion_multinar":
				$aTitulos[] = 'DN/PN';
				$aTitulos[] = 'Dp';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 70;
				$aAnchos[] = 60;
				$aAnchos[] = 170;
				$aAnchos[] = 80;
				$aCampos[] = 'DNPN';
				$aCampos[] = 'Dp';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "presion_obturadores":
				$aTitulos[] = 'DN';
				$aTitulos[] = 'Hs';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 50;
				$aAnchos[] = 70;
				$aAnchos[] = 180;
				$aAnchos[] = 80;
				$aCampos[] = 'DN';
				$aCampos[] = 'Hs';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "presion_retenar":
				$aTitulos[] = 'DN';
				$aTitulos[] = 'Tipo';
				$aTitulos[] = 'PN';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 40;
				$aAnchos[] = 50;
				$aAnchos[] = 60;
				$aAnchos[] = 150;
				$aAnchos[] = 80;
				$aCampos[] = 'DN';
				$aCampos[] = 'Tipo';
				$aCampos[] = 'PN';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "presion_vanar":
				$aTitulos[] = 'DN';
				$aTitulos[] = 'Cuerpo';
				$aTitulos[] = 'Muelle';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 40;
				$aAnchos[] = 60;
				$aAnchos[] = 60;
				$aAnchos[] = 140;
				$aAnchos[] = 80;
				$aCampos[] = 'DN';
				$aCampos[] = 'Cuerpo';
				$aCampos[] = 'Muelle';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "presion_bocar":
				$aTitulos[] = 'Tipo';
				$aTitulos[] = 'DN';
				$aTitulos[] = 'Caudal';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 40;
				$aAnchos[] = 60;
				$aAnchos[] = 60;
				$aAnchos[] = 140;
				$aAnchos[] = 80;
				$aCampos[] = 'Tipo';
				$aCampos[] = 'DN';
				$aCampos[] = 'Caudal';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "lamina_narbio":
		case "lamina_narbis":
		case "lamina_narmil":
		case "lamina_partidores":
		case "lamina_sifones":
		case "lamina_narcy":
				$aTitulos[] = 'Tipo';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 80;
				$aAnchos[] = 200;
				$aAnchos[] = 100;
				$aCampos[] = 'Tipo';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "lamina_almenaras":
				$aTitulos[] = 'Tipo';
				$aTitulos[] = 'Número';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 50;
				$aAnchos[] = 50;
				$aAnchos[] = 200;
				$aAnchos[] = 80;
				$aCampos[] = 'Tipo';
				$aCampos[] = 'Numero';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "lamina_cplana":
				$aTitulos[] = 'Tipo';
				$aTitulos[] = 'Dimensiones';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 50;
				$aAnchos[] = 50;
				$aAnchos[] = 200;
				$aAnchos[] = 80;
				$aCampos[] = 'Tipo';
				$aCampos[] = 'Dimensiones';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
		case "lamina_narmix":
				$aTitulos[] = 'Modelo';
				$aTitulos[] = 'Tipo';
				$aTitulos[] = 'Referencia';
				$aTitulos[] = 'Precio';
				$aAnchos[] = 50;
				$aAnchos[] = 50;
				$aAnchos[] = 200;
				$aAnchos[] = 80;
				$aCampos[] = 'Modelo';
				$aCampos[] = 'Tipo';
				$aCampos[] = 'Referencia';
				$aCampos[] = 'Precio';
				break;
	}
	
	if ($res)
	{
		$result = "<input type='hidden' name='nombre_tabla' id='nombre_tabla' value='" . $_POST['tabla'] . "' />\n";
		$result .= "<input type='hidden' name='definicion' id='definicion' value='" . $_POST['definicion'] . "' />\n";
		$result .= "<table border='0' cellpadding='2' cellspacing='3' width='380px'>\n";
		$result .= "<tr>\n";
		$result .= "<td></td>\n";
		for ($i=0;$i<count($aTitulos);$i++)
		{
			$result .= "<td width='" . $aAnchos[$i] . "px'><strong>" . $aTitulos[$i] . "</strong></td>";
		}
		$result .= "</tr>\n";
		
		$j = 0;
		while ($row = mysql_fetch_array($res))
		{
			$bgcolor = ($j % 2 == 0)?"#DDDDDD":"#FFFFFF";
			$result .= "<tr bgcolor='" . $bgcolor . "'>\n";
			$result .= "<td ><input type='radio' name='rdEquipoElegido' value='" . $row['Id'] . "' id='" . $row['Id'] . "' /></td>";
			for ($i=0;$i<count($aCampos);$i++)
			{
				$valor = ($aCampos[$i] == 'Precio') ? number_format($row[$aCampos[$i]],1,',','.') : $row[$aCampos[$i]];
				$result .= "<td width='" . $aAnchos[$i] . "px'>" . $valor . "</td>";
			}
			$result .= "</tr>\n";
			$j++;
		}
		$result .= "</table>\n";
		echo utf8_encode($result);
	}
?>