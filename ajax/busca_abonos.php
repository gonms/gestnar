<?php
	include("../includes/conf.php");
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$sql = "SELECT * FROM facturas WHERE numero LIKE '%" . $q . "%' and es_abono = 1";
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res))
	{
		echo $row['numero'] . "|" . $row['id'] . "\n";
	}
?>