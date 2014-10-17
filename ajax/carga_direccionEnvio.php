<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");	
	
	$q = $_GET["id"];
	if (!$q) return;
	
	if ($_GET['tabla'] == 'cliente')
    {
        include("../class/cliente_direccion_envio.class.php");
        
        $aDirecciones = array();
        $direcciones = new ClienteDireccionEnvio();
		$aDirecciones = $direcciones->getDireccionesCliente($q);
	}
	else if ($_GET['tabla'] == 'proveedor')
    {
        include("../class/proveedor_direccion_envio.class.php");
        
        $aDirecciones = array();
        $direcciones = new ProveedorDireccionEnvio();
		$aDirecciones = $direcciones->getDireccionesProveedor($q);
	}
    $totalRegistros = count($aDirecciones);
    
    $posicion = 0;
	for ($i=0;$i<$totalRegistros;$i++)
    {
        if ($aDirecciones[$i]['id'] == $_GET['id_direccion'])
            $posicion = $i;
    }
    $aDatos[] = $totalRegistros;
    $aDatos[] = $posicion + 1;
    $aDatos[] = $aDirecciones[$posicion]['nombre'];
    $aDatos[] = $aDirecciones[$posicion]['direccion1'];
    $aDatos[] = $aDirecciones[$posicion]['direccion2'];
    $aDatos[] = $aDirecciones[$posicion]['codpostal'];
    $aDatos[] = $aDirecciones[$posicion]['localidad'];
    $aDatos[] = $aDirecciones[$posicion]['provincia'];
	$aDatos[] = $aDirecciones[$posicion]['id'];

    $result = implode("#",$aDatos);
    
    echo utf8_encode($result);
?>