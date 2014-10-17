<?php
	include("../includes/conf.php");
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;

	$sql = "SELECT id,codigo,extra,departamento,numero FROM ofertas WHERE numero LIKE '" . $q . "%' ORDER BY numero, extra";
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res))
	{
		$departamento = (!empty($row['departamento'])) ? "-" . $row['departamento'] : "";
		$extra = (!empty($row['extra'])) ? "-" . $row['extra'] : "";
		echo $row['codigo'] . $departamento . "-" . $row['numero'] . $extra . "|" . $row['id'] . "\n";
	}
?>