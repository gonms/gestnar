<?php
include("includes/security.php");
include('includes/conf.php');
include("includes/excelwriter.inc.php"); 
include('includes/funciones.php');
include('class/albaran.class.php');
include('class/albaran_equipos.class.php');

$albaran = new Albaran();
$equipos = new AlbaranEquipos();

$excel=new ExcelWriter("registro_albaranes.xls"); 

$excel->writeRow();  
$excel->writeColHeader("ALBARAN",100); 
$excel->writeColHeader("FECHA",80);
$excel->writeColHeader("PEDIDO",100);
$excel->writeColHeader("CLIENTE",300);
$excel->writeColHeader("OBRA",300);
$excel->writeColHeader("MATERIAL",800);

switch ($_GET['tipo'])
{
	case "anio":
	case "fechas":
	case "numero_pedido":
	case "numero":
		$aAlbaranes = $albaran->getRegistro($_GET['tipo'],$_GET['valor']);
		break;
	case "equipos":
		$aAlbaranes = $albaran->getRegistroEquipos($_GET['valor']);
		break;
}

for ($i=0;$i<count($aAlbaranes);$i++)
{
	$equipos = new AlbaranEquipos();
	$aEquipos = $equipos->getEquipos($aAlbaranes[$i]['id']);
	$aResult = array();
	for ($j=0;$j<count($aEquipos);$j++)
	{
		$aResult[] = $aEquipos[$j]['cantidad'] . " " . $aEquipos[$j]['descripcion'];
	}

	$excel->writeRow();
	$excel->writeCol($aAlbaranes[$i]['numero']);
	$excel->writeCol(myToDate($aAlbaranes[$i]['fecha']));
	$excel->writeCol($aAlbaranes[$i]['numero_pedido']);
	$excel->writeCol($aAlbaranes[$i]['cliente']);
	$excel->writeCol($aAlbaranes[$i]['obra']);
	$excel->writeCol(implode(",",$aResult));
	
}

$excel->close();  
  
header("location:registro_albaranes.xls"); 
?>