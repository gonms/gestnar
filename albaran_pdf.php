<?php
include("includes/security.php");
require('fpdf/fpdf.php');
include('includes/conf.php');
include('includes/funciones.php');
include('class/albaran.class.php');
include('class/albaran_equipos.class.php');
include('class/cliente.class.php');
include('class/revision.class.php');

class PDF extends FPDF
{
	var $num_paginas;
    var $sum_precio;
	var $albaran;
	var $revision;
    
    function Header()
	{
        $this->Image('img/logo1.jpg',10,3,55);
        $this->SetXY(10,5);
	    $this->SetXY(128,5);
	    $this->SetFont('Arial','',9);
        $this->Cell(75,6,'SERVICIOS TÉCNICOS Y COMERCIALES','',0);	    
	    $this->Ln(4);
	    $this->SetX(135);    
	    $this->Cell(65,6,'Área Empresarial Andalucía - Sector 1','',0);
	    $this->Ln(4);
	    $this->SetX(132);    
	    $this->Cell(75,6,'C/ Marismas, nº7 - 28320 Pinto (Madrid)','',0);
	    $this->Ln(4);
	    $this->SetX(133);
	    $this->Cell(75,5,'Tel : 91-621.30.70    Fax : 91-691.93.66','',0);
	    $this->Ln(15);
        
		$this->SetX(72);
		$this->SetFont('Arial','B',14);
		$this->Cell(48,5,'ALBARAN DE ENTREGA','',0);
		$this->SetFont('Arial','',12);
		$this->Cell(60,5,'Nº','',0,'R');
		$this->Cell(15,5,$this->albaran->getNumero(),'',0);
		$this->Ln(10);
		
		$num_pedido = $this->albaran->getNumeroPedido();
		$numPedido = (empty($num_pedido)) ? "" : $num_pedido;
	    $this->Cell(5,6,'','LT',0);
        $this->SetFont('Arial','B',11);
	    $this->Cell(15,6,'N/REF: ','T',0);
        $this->SetFont('Arial','',11);
	    $this->Cell(50,6,$numPedido,'T',0);
		$this->SetFont('Arial','B',11);
	    $this->Cell(20,6,'EXPEDICIÓN Nº: ','T',0);
		$this->Cell(50,6,'','T',0);
		$this->Cell(20,6,'FECHA: ','T',0);
		$this->SetFont('Arial','',11);
	    $this->Cell(20,6,myToDate($this->albaran->getFecha()),'T',0);
		$this->Cell(10,6,'','RT',0);
	    $this->Ln(6);
		$this->Cell(5,6,'','L',0);
        $this->SetFont('Arial','B',11);
	    $this->Cell(35,6,'ASUNTO: ','',0);
        $this->SetFont('Arial','',11);
	    $this->Cell(150,6,$this->albaran->getAsunto(),'R',0);
		$this->Ln(6);
		$this->Cell(5,6,'','LB',0);
        $this->SetFont('Arial','B',11);
	    $this->Cell(35,6,'ENVIADO POR: ','B',0);
        $this->SetFont('Arial','',11);
	    $this->Cell(150,6,$this->albaran->getEnviado(),'BR',0);
		$this->Ln(10);
		
        list($des1,$des2,$des3,$des4) = explode("@",$this->albaran->getDestinatario());
		list($con1,$con2) = explode("@",$this->albaran->getContacto());
		$this->Cell(5,6,'','LT',0);
        $this->SetFont('Arial','B',11);
	    $this->Cell(35,6,'DESTINATARIO: ','T',0);
        $this->SetFont('Arial','',11);
	    $this->Cell(150,6,$des1,'TR',0);
		$this->Ln(6);
		$this->Cell(40,6,'','L',0);
	    $this->Cell(150,6,$des2,'R',0);
		$this->Ln(6);
		$this->Cell(40,6,'','L',0);
	    $this->Cell(150,6,$des3,'R',0);
		$this->Ln(6);
		$this->Cell(40,6,'','L',0);
	    $this->Cell(150,6,$des4,'R',0);
		$this->Ln(6);
		$this->Cell(5,6,'','L',0);
        $this->SetFont('Arial','B',11);
	    $this->Cell(35,6,'P. Contacto: ','',0);
        $this->SetFont('Arial','',11);
	    $this->Cell(150,6,$con1,'R',0);
		$this->Ln(6);
		$this->Cell(5,6,'','L',0);
		$this->Cell(35,6,'','B',0);
		$this->Cell(150,6,$con2,'BR',0);
		$this->Ln(6);
		
		$importe = ($this->albaran->getTipo() == "valorado") ? "IMPORTE" : "PESO";
	    $this->SetFont('Arial','B',9);
	    $this->Cell(20,5,'Nº UD.',1,0,'C');
	    $this->Cell(140,5,' MATERIAL',1,0,'C');
	    $this->Cell(30,5,$importe,1,0,'C');
        $this->Ln();
	}

	function dameAlto($texto)
	{
		$saltos=substr_count ($texto,"\n");
		$aTexto = explode("\n",$texto);
		for ($i=0;$i<count($aTexto);$i++)
		{
			$long_linea = ceil(strlen($aTexto[$i]) / 78);
			$saltos += $long_linea;
		}
		
		return ($saltos * 5);
	}
    
    
    function LineItems($array_referencias,$array_conceptos,$array_cantidades,$array_precio)
    {
        $w=array(20,140,30);

        $x = $this->GetX();
        $this->SetFont('Arial','',10);
        
        for($i=0;$i<count($array_conceptos);$i++)
        {    
            if ( ($this->getY() + $this->dameAlto($array_conceptos[$i])) > 275 )
            {
                $alto = 276 - $this->GetY();
                $this->Cell($w[0],$alto,'','L',0);
                $this->Cell($w[1],$alto,'','L',0);
                $this->Cell($w[2],$alto,'','LR',0);
                $this->AddPage();
            }

            $this->Cell($w[0], 5, $array_cantidades[$i], 'L',0,'C');
            $y1 = $this->GetY();
            $this->MultiCell($w[1], 5, $array_conceptos[$i], 'L');
            $y2 = $this->GetY();
            $yH = $y2 - $y1;
            
            $this->SetY($y1);
            $this->SetX($x + $w[0] + $w[1]);
            
            $tot_precio = $array_precio[$i] * $array_cantidades[$i];
			$tipo = $this->albaran->getTipo();
			if ( $tipo == "no_valorado" || floatval($tot_precio) == 0)
				$precio = "";
			else
				$precio = number_format($tot_precio, 1,',','.');
            $this->Cell($w[2], 5, $precio, 'LR', 0, 'R');
            $this->sum_precio += $tot_precio;
                        
            //relleno de las lineas
            $this->Ln();
            $this->SetX($x);
            $this->Cell($w[0], $yH, '', 'L');
            $this->SetX($x + $w[0] + $w[1]);
            $this->Cell($w[2], $yH, '', 'LR');    
            $this->Ln();
            $this->SetX($x);
        }
        
        if ($this->PageNo() == $this->num_paginas)
        {           
            $alto = 276 - $this->GetY();
            $this->Cell($w[0],$alto,'','L',0);
            $this->Cell($w[1],$alto,'','L',0);
            $this->Cell($w[2],$alto,'','LR',0);
            $this->Ln();
        }
    } 
	
	function Footer()
	{
		$this->SetY(-21);
		$this->Cell(20, '14', '', 'LB');
		$this->Cell(140, '14', '', 'LB');
		$this->Cell(30, '14', '', 'LBR');
	}
}

$pdf=new PDF();

$pdf->albaran = new Albaran($_GET['id_albaran']);
$revision = new Revision();
$pdf->revision = $revision->getRevisionByDate($pdf->albaran->getFecha(),'albaran');

$equipos = new AlbaranEquipos();
$aEquipos = $equipos->getEquipos($_GET['id_albaran']);
for ($i=0;$i<count($aEquipos);$i++)
{
	//$aReferencias[] = $aEquipos[$i]['referencia'];
	$aCantidades[] = $aEquipos[$i]['cantidad'];
	$aConceptos[] = $aEquipos[$i]['descripcion'];
	$aPrecios[] = $aEquipos[$i]['precio'];
    
	$total_alto += $pdf->dameAlto($aEquipos[$i]['descripcion']);
}

$pdf->num_paginas = ceil((100 + $total_alto) / 276);  //TODO: optimizar

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->LineItems($aReferencias,$aConceptos,$aCantidades,$aPrecios);
$pdf->Output();

?>