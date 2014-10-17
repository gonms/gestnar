<?php
	include("../includes/conf.php");
	include("../includes/funciones.php");
	include("../class/revision.class.php");
	
	$q = $_POST["seccion"];
	if (!$q) return;
	
	$revision = new Revision();
	$revision->setSeccion($q);
	$revision->setFecha(dateToMy($_POST['fecha']));
	$revision->setRevision($_POST['revision']);
	$result = $revision->add();
	if ($result > 0)
	{
		$result = "<label>
				<span>&nbsp;</span>\n
				<input type='text' size='10' value='". $_POST['fecha'] . "' /> - \n
				<input type='text' class='input01' value='". $_POST['revision'] . "' />\n
			</label>\n";
		echo "OK#" . $result;
	}
	else
		echo "ERROR";
?>