<?php
	include("../includes/conf.php");	    
	
	$q = $_GET["id"];
	if (!$q) return;
	
	$aDirecciones = array();
	
    switch ($_GET['tabla'])
    {
        case 'clientes': 
            include("../class/cliente_direccion_envio.class.php");
            $direcciones = new ClienteDireccionEnvio();	
            $aDirecciones = $direcciones->getDireccionesCliente($q);
            break;
	}
	$result = count($aDirecciones);
	
	echo $result;
?>