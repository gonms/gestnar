<?php
	include("../includes/conf.php");
	include("../class/usuario.class.php");
	
	$usuario = new Usuario($_POST['user'], $_POST['pass']);
    if ($usuario->getId() > 0)
	{
		echo "OK";
	}
    else
        echo "KO";
?>