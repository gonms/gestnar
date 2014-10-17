<?php
	include("../includes/conf.php");
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;

	$sql = "SELECT id,numero FROM pedidos_proveedores WHERE numero LIKE '" . $q . "%'";
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res))
	{
        echo $row['numero'] . "|" . $row['id'] . "\n";
	}
?>