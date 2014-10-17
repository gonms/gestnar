<?php
    include("../includes/conf.php");
    
    $q = strtolower($_GET["q"]);
    if (!$q) return;

    $sql = "SELECT id,numero,revision FROM ordencompra WHERE numero LIKE '%" . $q . "%'";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_array($res))
    {
        $revision = (empty($row['revision'])) ? "" : "-" . $row['revision'];
		echo $row['numero'] . $revision . "|" . $row['id'] . "\n";
    }
?>