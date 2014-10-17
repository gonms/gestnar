<?php
	include("../includes/conf.php");
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$sql = "SELECT id, numero, codigo, factura_proforma FROM facturas WHERE numero LIKE '%" . $q . "%' and es_abono = 0 ORDER BY numero";
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res))
	{
		$proforma = ($row['factura_proforma'] == "1") ? " proforma" : "";
		echo $row['numero'] . "/" . $row['codigo'] . $proforma . "|" . $row['id'] . "\n";
	}
?>