<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");	
	
    if ($_GET['tabla'] == 'cliente')
    {
        $tabla = "clientes_direccion_envio";
        $campo = "id_cliente";        
    }
	else if ($_GET['tabla'] == 'proveedor')
    {
        $tabla = "proveedores_direccion_envio";
        $campo = "id_proveedor";        
    }
    
    $posicion = $_GET['posicion'] - 1;
    
    $sql = "SELECT * FROM " . $tabla . " WHERE " . $campo . " = " . $_GET['id'] . " LIMIT " . $posicion . ",1";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $aDatos[] = $row['id'];
	$aDatos[] = $row['nombre'];
    $aDatos[] = $row['direccion1'];
    $aDatos[] = $row['direccion2'];
    $aDatos[] = $row['codpostal'];
    $aDatos[] = $row['localidad'];
    $aDatos[] = $row['provincia'];

    $result = implode("#",$aDatos);
    
    echo $result;
?>