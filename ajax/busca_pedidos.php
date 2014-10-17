<?php
	include("../includes/conf.php");
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;

	$sql = "SELECT id,codigo,numero,revision FROM pedidos WHERE numero LIKE '" . $q . "%'";
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res))
	{
		$revision = (empty($row['revision']))?"":" - " . $row['revision'];
        echo $row['codigo'] . "-" . $row['numero'] . $revision . "|" . $row['id'] . "\n";
	}
?>