<?php
	include("../includes/conf.php");
	
	$sql = "SELECT * FROM " . $_POST['tabla'] . " WHERE Id = '" . $_POST['id_equipo'] . "'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	
	if ($row)
	{
		switch ($_POST['tabla'])
		{
			case "presion_compuerta":
			case "presion_drenar":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " DN-"  . $row['DN'];
					$precio = $row['Precio'];
					break;
			case "presion_chorro":
			case "presion_narsonic":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " DN-"  . $row['DN'] . " PN-" . $row['PN'];
					$precio = $row['Precio'];
					break;
			case "presion_multinar":
					list($dn,$pn) = explode ("/",$row['DNPN']);
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " DN-"  . $dn . " PN-" . $pn . " Dp=" . $row['Dp'];
					$precio = $row['Precio'];
					break;
			case "presion_obturadores":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " DN-"  . $row['DN'] . " Hs=" . str_replace("-","/",$row['Hs']) . " mca.";
					$precio = $row['Precio'];
					break;
			case "presion_retenar":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " Tipo " . $row['Tipo'] . " DN-"  . $row['DN'] . " PN-" . str_replace("-","/",$row['PN']);
					$precio = $row['Precio'];
					break;
			case "presion_vanar":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " DN-"  . $row['DN'] . $row['Cuerpo'] . $row['Muelle'];
					$precio = $row['Precio'];
					break;
			case "presion_bocar":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " Tipo "  . $row['Tipo'] . " DN-"  . $row['DN'] . " caudal " . $row['Caudal'] . " l/s";
					$precio = $row['Precio'];
					break;
			case "lamina_narbio":
			case "lamina_narbis":
			case "lamina_narmil":
			case "lamina_partidores":
			case "lamina_sifones":
			case "lamina_narcy":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " Tipo "  . $row['Tipo'];
					$precio = $row['Precio'];
					break;
			case "lamina_almenaras":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " Tipo " . $row['Tipo'] . " caudal " . $row['Numero'] . " l/s";
					$precio = $row['Precio'];
					break;
			case "lamina_cplana":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . $row['Dimensiones'];
					$precio = $row['Precio'];
					break;
			case "lamina_narmix":
					$referencia = $row['Referencia'];
					$descripcion = $_POST['definicion'] . " Modelo: "  . $row['Modelo'] . " Tipo: " . $row['Tipo'];
					$precio = $row['Precio'];
					break;
		}
		
		echo $referencia . "#" . utf8_decode($descripcion) . "#" . $precio;
	}	
?>