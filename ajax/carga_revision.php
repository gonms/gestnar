<?php
	include("../includes/conf.php");
	include("../includes/funciones.php");
	include("../class/revision.class.php");
	
	$q = $_GET["seccion"];
	if (!$q) return;
	
	$revision = new Revision();
	$aRevisiones = array();
	$aRevisiones = $revision->getRevisionBySeccion($q);
	for ($i=0;$i<count($aRevisiones);$i++)
	{
		$result .= "<label>
						<span>&nbsp;</span>\n
						<input type='text' size='10' value='". myToDate($aRevisiones[$i]['fecha']) . "' /> - \n
						<input type='text' class='input01' value='". $aRevisiones[$i]['revision'] . "' />\n
					</label>\n";
	}
	echo utf8_encode($result);
?>