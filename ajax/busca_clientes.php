<?php
	include("../includes/conf.php");
	
	$q = strtolower($_GET["q"]);
	if (!$q) return;
	
	$sql = "SELECT id,nombre,direccion,localidad,provincia FROM clientes WHERE nombre LIKE '%" . $q . "%' ORDER BY nombre";
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res))
	{
		if (!empty($row['provincia'])) $provincia = ", " . $row['provincia'];
		echo utf8_encode($row['nombre'] . "<br />" . str_replace("\n"," ",$row['direccion']) . "<br />" . $row['localidad'] . $provincia) . "|" . $row['id'] . "\n";
	}
?>