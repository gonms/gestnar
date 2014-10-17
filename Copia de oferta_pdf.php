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
    var $sumar_equipos;
	var $oferta;
	var $cliente;
	var $contacto;
	var $revision;
    
    function Header()
	{
	    $this->Image('img/logo1.jpg',10,0,65);
	    $this->Image('img/ISO9001_nuevo.jpg',165,5,15);
	    $this->Image('img/ISO14001.jpg',185,4,15);
	    $this->Ln(12);
	    $this->SetFont('Arial','B',8);
	    $this->Cell(0,4,'SERVICIOS T�CNICOS Y COMERCIALES',0,1);    
	    $this->SetFont('Arial','',8);
	    $this->Cell(0,4,'AREA EMPRESARIAL ANDALUC�A, Sector 1',0,1);
	    $this->Cell(0,4,'C/Marismas, 7     28320 Pinto (MADRID)',0,1);
	    $this->Cell(0,4,'T: +34 (9)1 621 30 70     F: +34 (9)1 691 93 66',0,1);
	    $this->Cell(0,4,'e-mail: einar@einar.es     www.einar.es',0,1);
	        
	    $this->SetXY(85,25);
	    $this->SetFont('Arial','B',10);
	    $this->Cell(95,4,$this->cliente->getNombre(),'LTR',1);
	    $this->SetX(85);
	    $this->SetFont('Arial','',10);
		list($dir1,$dir2) = explode("\n",$this->cliente->getDireccion());
	    $this->Cell(95,4,$dir1,'LR',1);
		if (!empty($dir2))
		{
			$this->SetX(85);
			$this->Cell(95,4,$dir2,'LR',1);
		}		
	    $this->SetX(85);
	    $this->Cell(95,4,$this->cliente->getLocalidad(),'LR',1);
	    $this->SetX(85);
	    $this->Cell(95,4,$this->cliente->getCodPostal() . " " . strtoupper($this->cliente->getProvincia()),'LR',1);
	    $this->SetX(85);    
	    $this->Cell(95,4,'Att. ' . $this->contacto->getNombre(),'LR',1);
	    $this->SetX(85);
		
		$valor = $this->cliente->getTelefono();
		if (!empty($valor))
			$telfax = 'Tlfo: ' . $this->cliente->getTelefono();
		
		$valor = $this->cliente->getFax();
		if (!empty($valor))
			$telfax .= '    Fax: ' . $this->cliente->getFax();
	    $this->Cell(95,4,$telfax,'LBR',1);
	    $this->Ln(5);
	    
	    $numero_oferta = $this->oferta->getNumeroOferta();
		
		$descuento = $this->oferta->getDescuento();
	    if ($descuento == "0") $descuento = "";
		else	$descuento = "T0" . $descuento;
	    
	    $this->Cell(7);
	    $this->SetFont('Arial','',11);
	    $this->Cell(80,4,'Muy Srs. Nuestros:',0,1);
	    $this->Ln(5);
	    $this->Cell(7);
	    $this->MultiCell(180,4,'Tenemos el gusto de someter a su consideraci�n nuestra mejor oferta para el posible suministro del material que seguidamente les detallamos:');
	    $this->Ln(5);
	    $this->SetFont('Arial','B',10);
	    $this->Cell(35,5,'OFERTA N�',1,0,'C');
	    $this->Cell(20,5,'FECHA',1,0,'C');
	    $this->Cell(20,5,'CDG',1,0,'C');
	    $this->Cell(115,5,'REFERENCIA Y OBRA',1,1,'C');
	    $this->SetFont('Arial','',10);
	    $this->Cell(35,5,$numero_oferta,1,0,'C');
	    $this->Cell(20,5,myToDate($this->oferta->getFechaEnvio()),1,0,'C');
	    $this->Cell(20,5,$descuento,1,0,'C');
	    $this->Cell(115,5,$this->oferta->getObra(),1,1);
	    
	    $this->Ln(5);
	    $this->SetFont('Arial','',8);
	    $this->Cell(25,5,'REFERENCIA',1,0,'C');
		$this->Cell(20,5,'CANTIDAD',1,0,'C');
		$this->Cell(95,5,' CONCEPTO',1,0,'L');
		$this->Cell(25,5,'PRECIO UD.',1,0,'C');
		$this->Cell(25,5,'IMPORTE',1,0,'C');
		$this->Ln(5);
	}
	
	function Footer()
	{
	  	if ($this->PageNo() == $this->num_paginas)
        {
            list($plazo_entrega1,$plazo_entrega2) = explode("@",$this->oferta->getPlazoEntrega());
			list($condiciones_pago1,$condiciones_pago2) = explode("@",$this->oferta->getCondicionesPago());
			$condiciones_pago = $this->oferta->getCondicionesPago();
			$iva = $this->oferta->getIVA() . '% no incluido';
			$mercancia_franco = "s/cami�n en " . $this->oferta->getMercanciaFranco();
			$embalaje = $this->oferta->getEmbalaje();
			$validez_oferta = $this->oferta->getValidezOferta();
        }
	    $this->SetY(-44);
	    $this->SetFont('Arial','B',8);
	    $this->Cell(45,7,'Plazo de Entrega','LTR',0);
	    $this->Cell(120,7,'Condiciones de Pago','LTR',0);
	    $this->Cell(25,7,'I.V.A.','LTR',1);
	    $this->SetFont('Arial','',8);
	    $this->Cell(45,3,$plazo_entrega1,'LR',0);
		$this->Cell(120,3,$condiciones_pago1,'LR',0);
		$this->Cell(25,3,'','LR',1,'R');
		$this->Cell(45,4,$plazo_entrega2,'LBR',0);
	    $this->Cell(120,4,$condiciones_pago2,'LBR',0);
	    $this->Cell(25,4,$iva,'LBR',1,'R');
	    $this->SetFont('Arial','B',8);
	    $this->Cell(45,7,'Mercanc�a Franco','LTR',0);
	    $this->Cell(120,7,'Embalaje','LTR',0);
	    $this->Cell(25,7,'Validez Oferta','LTR',1);
	    $this->SetFont('Arial','',8);
	    $this->Cell(45,7,$mercancia_franco,'LBR',0,'R');
	    $this->Cell(120,7,$embalaje,'LBR',0,'R');
	    $this->Cell(25,7,$validez_oferta,'LBR',1,'R');
	    $this->SetFont('Arial','B',6);
		$this->Cell(0,5,'* Conforme a la Ley 15/2010, de 5 de julio, de modificaci�n de la Ley 3/2004, de 29 de diciembre.',0,1,'L');
	    $this->Cell(0,5,'R.M. Madrid, T 7411 General, 6384 de la Secc. 3�, Lib Soc. F81, Hoja 73668, Inscrip. 1�, C.I.F. A 78 - 420627',0,1,'C');
	    $this->Cell(0,6,'PGC12-F06-' . $this->revision,0,1,'R');
	}

	function dameAlto($texto)
	{
		$saltos=substr_count ($texto,"\n");
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
        $w=array(25,20,95,25,25);

        $x = $this->GetX();
        $this->SetFont('Arial','',10);
        
        for($i=0;$i<count($array_conceptos);$i++)
        {    
            if ( ($this->getY() + $this->dameAlto($array_conceptos[$i])) > 243 )
            {
                $alto = 253 - $this->GetY();
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
			else $precio = number_format($array_precios[$i], 1,',','.');
			
			$importe = $array_importes[$i];
			if ($importe == 0) $importe = "";
			else $importe = number_format($array_importes[$i], 1,',','.');
			
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
            $importe_total += $array_importes[$i];
                        
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
            $this->SetFont('Arial','B',10);
            
            $alto = 248 - $this->GetY();
            $this->Cell($w[0],$alto,'','LR',0,'C');
            $this->Cell($w[1],$alto,'','LR',0,'R');
            $this->Cell($w[2],$alto,'','LR',0,'L');
            $this->Cell($w[3],$alto,'','LR',0,'R');
            $this->Cell($w[4],$alto,'','LR',1,'R');
            
            if ($this->sumar_equipos == 1)
            {
                $this->Cell($w[0],5,'','LR',0,'L');
                $this->Cell($w[1],5,'','LR',0,'L');
                $this->Cell($w[2],5,'TOTAL...... ','LR',0,'R');                
                $this->Cell($w[3],5,'','LR',0,'L');
                $this->Cell($w[4],5,number_format($importe_total,1,',','.'),'LR',0,'R');
            }
            else
            {
                $this->Cell($w[0],5,'','LR',0,'L');
                $this->Cell($w[1],5,'','LR',0,'L');
                $this->Cell($w[2],5,'','LR',0,'R');                
                $this->Cell($w[3],5,'','LR',0,'L');
                $this->Cell($w[4],5,'','LR',0,'R');
            }
            $this->Ln();
        }
    }
}
$pdf=new PDF();

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
$pdf->num_paginas = ceil((92 + $total_alto) / 253);  //TODO: optimizar
if ($_GET['id_oferta'] == 328)
	$pdf->num_paginas = 3;
else if ($_GET['id_oferta'] == 336)
	$pdf->num_paginas = 2;
else if ($_GET['id_oferta'] == 338)
	$pdf->num_paginas = 2;
else if ($_GET['id_oferta'] == 406)
	$pdf->num_paginas = 2;
else if ($_GET['id_oferta'] == 643)
	$pdf->num_paginas = 4;


$pdf->sumar_equipos = $_GET['sumar'];

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->LineItems($aReferencias,$aCantidades,$aConceptos,$aPrecios,$aImportes);
$pdf->Output();
?>