<?php
include("includes/security.php");

require('fpdf/fpdf.php');
include('includes/conf.php');
include('includes/funciones.php');
include('class/oferta.class.php');
include('class/oferta_equipos.class.php');
include('class/cliente.class.php');
include('class/cliente_contactos.class.php');
include('class/revision.class.php');

class PDF extends FPDF
{
    var $num_paginas;
    var $importe_total;
	var $oferta;
	var $cliente;
	var $contacto;
	var $revision;
    
    function Header()
	{
	    /* ORIGINAL
	    $this->Image('img/img1.jpg',5,0,110);
	    $this->Image('img/img2.jpg',110,0,100);
	    $this->Image('img/img3.jpg',204,17,8);
	    */
	    
	    /*
	    $this->SetFillColor(237,237,239);
	    $this->Image('img/img3.jpg',13,18,8);
	    $this->Image('img/img1.jpg',20,0,85);
	    $this->Rect(80,0,55,13,'F');
	    $this->Rect(80,0,55,13,'F');
	    $this->Image('img/img3.jpg',204,10,8);
	    $this->Image('img/img2.jpg',135,0,75);
	    */
	    $this->Image('img/fondo6.jpg',5,-2,205);
	    
	    /* ORIGINAL
	    $this->SetXY(115,17);
	    $this->SetFont('Gothic','B',10);
	    $this->Cell(89,4,$this->cliente->getNombre(),'LTR',1);
	    $this->SetX(115);
	    $this->SetFont('Gothic','',10);
		list($dir1,$dir2) = explode("\n",$this->cliente->getDireccion());
	    $this->Cell(89,4,$dir1,'LR',1);
		if (!empty($dir2))
		{
			$this->SetX(115);
			$this->Cell(89,4,$dir2,'LR',1);
		}		
	    $this->SetX(115);
	    $this->Cell(89,4,$this->cliente->getLocalidad(),'LR',1);
	    $this->SetX(115);
	    $this->Cell(89,4,$this->cliente->getCodPostal() . " " . strtoupper($this->cliente->getProvincia()),'LR',1);
	    $this->SetX(115);    
	    $this->Cell(89,4,'Att. ' . $this->contacto->getNombre(),'LR',1);
	    $this->SetX(115);
		
		$valor = $this->cliente->getTelefono();
		if (!empty($valor))
			$telfax = 'Tlfo: ' . $this->cliente->getTelefono();
		
		$valor = $this->cliente->getFax();
		if (!empty($valor))
			$telfax .= '    Fax: ' . $this->cliente->getFax();
	    $this->Cell(89,4,$telfax,'LBR',1);
	    $this->Ln(15);
	    */
	    $this->SetFillColor(237,237,239);
	    $this->Rect(99,12,105,10,'F');
	    $this->SetDrawColor(237,237,239);
	    $anchoCaja = 105;
	    $posXCaja = 99;
	    $posYCaja = 22;
	    $this->SetXY($posXCaja,$posYCaja);
	    $this->SetFont('Gothic','B',8);
	    $this->Cell($anchoCaja,5,$this->cliente->getNombre(),'LTR',1);
	    $this->SetX($posXCaja);
	    $this->SetFont('Gothic','',8);
		list($dir1,$dir2) = explode("\n",$this->cliente->getDireccion());
	    $this->Cell($anchoCaja,5,$dir1,'LR',1);
		if (!empty($dir2))
		{
			$this->SetX($posXCaja);
			$this->Cell($anchoCaja,5,$dir2,'LR',1);
		}		
	    $this->SetX($posXCaja);
	    $this->Cell($anchoCaja,5,$this->cliente->getLocalidad(),'LR',1);
	    $this->SetX($posXCaja);
	    $this->Cell($anchoCaja,5,$this->cliente->getCodPostal() . " " . strtoupper($this->cliente->getProvincia()),'LR',1);
	    $this->SetX($posXCaja);    
	    $this->Cell($anchoCaja,5,'Att. ' . $this->contacto->getNombre(),'LR',1);
	    $this->SetX($posXCaja);
		
		$valor = $this->cliente->getTelefono();
		if (!empty($valor))
			$telfax = 'Tlfo: ' . $this->cliente->getTelefono();
		
		$valor = $this->cliente->getFax();
		if (!empty($valor))
			$telfax .= '    Fax: ' . $this->cliente->getFax();
	    $this->Cell($anchoCaja,4,$telfax,'LBR',1);
	    
	    $this->SetDrawColor(0,0,255);
	    $numero_oferta = $this->oferta->getNumeroOferta();
		
	    $this->Cell(7);
	    $this->SetFont('Gothic','',9);
	    $this->Cell(80,4,'Muy Srs. Nuestros:',0,1);
	    $this->Ln(4);
	    $this->Cell(7);
	    $this->MultiCell(115,4,'Tenemos el gusto de someter a su consideración nuestra mejor oferta para el posible suministro del material que seguidamente les detallamos:');
	    $this->Ln(10);
	    $this->SetTextColor(0,0,255);
	    $this->SetFont('Gothic','B',10);
	    $this->Cell(45,8,'OFERTA Nº',1,0,'C');
	    $this->Cell(25,8,'FECHA',1,0,'C');
	    $this->Cell(120,8,'REFERENCIA Y OBRA',1,1,'C');
	    $this->SetFont('Gothic','',10);
	    $this->SetTextColor(0,0,0);
	    $this->Cell(45,9,$numero_oferta,1,0,'C');
	    $this->Cell(25,9,myToDate($this->oferta->getFechaEnvio()),1,0,'C');
	    $this->Cell(120,9,$this->oferta->getObra(),1,1);
	    
	    $this->Ln(5);
	    $this->SetFont('Gothic','',8);
	    $this->SetTextColor(0,0,255);
	    $this->Cell(25,8,'REFERENCIA',1,0,'C');
		$this->Cell(20,8,'CANTIDAD',1,0,'C');
		$this->Cell(95,8,' CONCEPTO',1,0,'C');
		$this->Cell(25,8,'PRECIO UD.',1,0,'C');
		$this->Cell(25,8,'IMPORTE',1,0,'C');
		$this->Ln(8);
	}
	
	function Footer()
	{
	  	if ($this->PageNo() == $this->num_paginas)
        {
            list($plazo_entrega1,$plazo_entrega2) = explode("@",$this->oferta->getPlazoEntrega());
			list($condiciones_pago1,$condiciones_pago2) = explode("@",$this->oferta->getCondicionesPago());
			$condiciones_pago = $this->oferta->getCondicionesPago();
			$mercancia_franco = $this->oferta->getMercanciaFranco();
			$embalaje = $this->oferta->getEmbalaje();
			$validez_oferta = $this->oferta->getValidezOferta();

			if ($this->sumar_equipos == 1)
            {
				$this->SetY(-75);
			    $this->Cell(25,5,'',0,0,'C');
				$this->Cell(20,5,'',0,0,'C');
				$this->Cell(95,5,'',0,0,'C');
				$this->SetTextColor(0,0,255);
				$this->Cell(25,5,'TOTAL: ','R',0,'R');
				$this->SetTextColor(0,0,0);
				$this->Cell(25,5,number_format($this->importe_total,1,',','.') . '€','R',0,'R');
				$this->Ln(5);
			}
        }
        else
        	$this->SetY(-70); //-44

	    $this->SetFont('Gothic','B',8);
	    $this->SetTextColor(0,0,255);
	    $this->Cell(140,5,'PLAZO DE ENTREGA','LTR',0);
	    $this->Cell(50,5,'IVA NO INCLUIDO','LTR',1);
	    $this->SetFont('Gothic','',8);
	    $this->SetTextColor(0,0,0);
	    $this->Cell(140,5,$plazo_entrega1,'LR',0);
	    $this->Cell(50,5,'','R',1);
	    
	    $this->SetFont('Gothic','B',8);
	    $this->SetTextColor(0,0,255);
		$this->Cell(190,5,'CONDICIONES DE PAGO','LTR',1);
		$this->SetFont('Gothic','',8);
		$this->SetTextColor(0,0,0);
		$this->Cell(190,5,$condiciones_pago1,'LR',1);
		$this->Cell(190,5,$condiciones_pago2,'LR',1);

		$this->SetFont('Gothic','B',8);
		$this->SetTextColor(0,0,255);
		$this->Cell(190,5,'TRANSPORTE','LTR',1);
		$this->SetFont('Gothic','',8);
		$this->SetTextColor(0,0,0);
		$this->Cell(190,5,$mercancia_franco,'LR',1);

	    $this->SetFont('Gothic','B',8);
	    $this->SetTextColor(0,0,255);
	    $this->Cell(140,5,'EMBALAJES:','LTR',0);
	    $this->Cell(50,5,'VALIDEZ OFERTA:','LTR',1);
	    $this->SetFont('Gothic','',8);
	    $this->SetTextColor(0,0,0);
	    $this->Cell(140,5,$embalaje,'LBR',0,'L');
	    $this->Cell(50,5,$validez_oferta,'LBR',1,'L');
	    
	    $this->SetTextColor(0,0,255);
	    $this->Cell(0,6,'PGC12-F06-' . $this->revision,0,1,'R');	    

	    $y = $this->GetY();
	    $this->Image('img/ISO9001_nuevo.jpg',10,null,15);
	    $this->Image('img/ISO14001.jpg',26,$y,15);

	    $this->SetFont('Gothic','',8);
	    $this->SetXY(70,$y);
	    $this->SetTextColor(0,0,255);
	    $this->Cell(0,5,'Einar S.A.','',1);
	    $this->SetXY(70,$y+4);
	    $this->SetTextColor(0,0,0);
	    $this->Cell(0,4,'Area Empresarial Andalucia, Sector I, Calle Marismas, 7, 28320 Pinto, Madrid - España.','',1);
	    $this->SetXY(70,$y+8);
	    $this->Cell(0,4,'Teléfono: +34 91 621 30 70 . FAX : +34 91 691 93 66. E-mail : einar@einar.es','',1);
	    $this->SetFont('Gothic','',6);
	    $this->SetXY(70,$y+12);
	    $this->SetTextColor(0,0,255);
	    $this->Cell(0,4,'Inscrita en el R.M. de Madrid. T. 7411 General, 6384 de la Secc. 3ª, Lib Soc. F81, Hoja 73668, Inscrip. 1ª, C.I.F. : A-78420627 ','');
	}

	function dameAlto($texto)
	{
		$saltos=substr_count($texto,"\n");
		$aTexto = explode("\n",$texto);
		for ($i=0;$i<count($aTexto);$i++)
		{
			$long_linea = ceil(strlen($aTexto[$i]) / 64);
			$saltos += ($long_linea);
		}
		
		return ($saltos * 5);
	}
    
    function LineItems($array_referencias,$array_cantidades,$array_conceptos,$array_precios,$array_importes)
    {
        $this->SetTextColor(0,0,0);
        $w=array(25,20,95,25,25);

        $x = $this->GetX();
        $this->SetFont('Gothic','',9);
        
        for($i=0;$i<count($array_conceptos);$i++)
        {    
            if ( ($this->getY() + $this->dameAlto($array_conceptos[$i])) > 222) //243 )
            {
                $alto = 227 - $this->GetY(); //253
                $this->Cell($w[0],$alto,'','LR',0,'C');
                $this->Cell($w[1],$alto,'','LR',0,'R');
                $this->Cell($w[2],$alto,'','LR',0,'L');
                $this->Cell($w[3],$alto,'','LR',0,'R');
                $this->Cell($w[4],$alto,'','LR',1,'R');
                $this->AddPage();
            }
            
			$cantidad = $array_cantidades[$i];
			if ($cantidad == 0) $cantidad = "";
			
			$precio = $array_precios[$i];
			if ($precio == 0) $precio = "";
			else $precio = number_format($array_precios[$i], 1,',','.') . '€';
			
			$importe = $array_importes[$i];
			if ($importe == 0) $importe = "";
			else $importe = number_format($array_importes[$i], 1,',','.') . '€';
			
            $this->Cell($w[0], 5, $array_referencias[$i], 'LR');           
            $this->Cell($w[1], 5, $cantidad, 'LR', 0, 'R');
            
            $y1 = $this->GetY();
            $this->MultiCell($w[2], 4, $array_conceptos[$i], 'LR');    
            $y2 = $this->GetY();
            $yH = $y2 - $y1 + 2;
                        
            $this->SetY($y1);
            $this->SetX($x + 140);
            $this->Cell($w[3], 5, $precio, 'LR', 0, 'R');
            $this->Cell($w[4], 5, $importe, 'LR', 0, 'R');
            $this->importe_total += $array_importes[$i];
                        
            //relleno de las lineas
            $this->Ln();
            $this->SetX($x);                    
            $this->Cell($w[0], $yH, '', 'LR');
            $this->Cell($w[1], $yH, '', 'LR');    
            $this->SetX($x + 140);
            $this->Cell($w[3], $yH, '', 'LR');    
            $this->Cell($w[4], $yH, '', 'LR');    

            $this->Ln();            
            $this->SetX($x);
        }
        
        if ($this->PageNo() == $this->num_paginas)
        {
            $this->SetFont('Gothic','B',10);
            
            $alto = 222 - $this->GetY(); //248
            $this->Cell($w[0],$alto,'','LR',0,'C');
            $this->Cell($w[1],$alto,'','LR',0,'R');
            $this->Cell($w[2],$alto,'','LR',0,'L');
            $this->Cell($w[3],$alto,'','LR',0,'R');
            $this->Cell($w[4],$alto,'','LR',1,'R');
            
            $this->Cell($w[0],5,'','LR',0,'L');
            $this->Cell($w[1],5,'','LR',0,'L');
            $this->Cell($w[2],5,'','LR',0,'R');                
            $this->Cell($w[3],5,'','LR',0,'L');
            $this->Cell($w[4],5,'','LR',0,'R');

            $this->Ln();
        }
    }
}
$pdf=new PDF();

$pdf->SetTopMargin(0);
$pdf->SetDrawColor(0,0,255);
$pdf->AddFont('Gothic','','gothic.php');
$pdf->AddFont('Gothic','B','gothicb.php');

$pdf->oferta = new Oferta($_GET['id_oferta']);
$pdf->cliente = new Cliente($pdf->oferta->getIdCliente());
$pdf->contacto = new ClienteContactos($pdf->oferta->getIdContacto());
$revision = new Revision();
$pdf->revision = $revision->getRevisionByDate($pdf->oferta->getFechaRecepcion(),'oferta');

$equipos = new OfertaEquipos();
$aEquipos = $equipos->getEquipos($_GET['id_oferta']);
for ($i=0;$i<count($aEquipos);$i++)
{
	$aReferencias[] = $aEquipos[$i]['referencia'];
	$aCantidades[] = $aEquipos[$i]['cantidad'];
	$aConceptos[] = $aEquipos[$i]['descripcion'];
	$descuento = $aEquipos[$i]['precio'] * ($aEquipos[$i]['descuento'] /100);
	$precio = $aEquipos[$i]['precio'] - $descuento;
	$aPrecios[] = $precio;
	$importe = $aEquipos[$i]['cantidad'] * $precio;
	$aImportes[] = $importe;
    
    $total_alto += $pdf->dameAlto($aEquipos[$i]['descripcion']);	    
}

$num_paginas = $pdf->oferta->getNumPaginas();

if (!empty($_GET['paginas']) && $_GET['paginas'] > 0)
{
	$pdf->num_paginas = $_GET['paginas'];
	$pdf->oferta->setNumPaginas($_GET['paginas']);
}
else if ($num_paginas > 0)
{
	$pdf->num_paginas = $num_paginas;
}
else
{
	$pdf->num_paginas = ceil((92 + $total_alto) / 227); //253
}

$pdf->sumar_equipos = $_GET['sumar'];

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->LineItems($aReferencias,$aCantidades,$aConceptos,$aPrecios,$aImportes);
$pdf->Output();

?>