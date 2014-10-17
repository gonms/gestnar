<?php
include("includes/security.php");
require('fpdf/fpdf.php');
include('includes/conf.php');
include('includes/funciones.php');
include('class/ordencompra.class.php');
include('class/ordencompra_equipos.class.php');
include('class/proveedor.class.php');
include('class/proveedor_direccion_envio.class.php');
include('class/revision.class.php');

class PDF extends FPDF
{
	var $num_paginas;
    var $sum_precio;
    var $altoDocIncluir;
	var $ordencompra;
	var $proveedor;
	var $dirEnvio;
	var $revision;
    
    function Header()
	{
        if ($this->ordencompra->getRevision() > 0) $revision = $this->ordencompra->getRevision();
            
        $this->Image('img/logo1.jpg',10,8,45);
	    $this->SetXY(10,5);
		$this->Cell(50,23,'','LT',0);
	    $this->SetFont('Arial','B',14);
	    $this->Cell(85,7,'EINAR, S.A.','LTR',0,'C');
	    $this->SetFont('Arial','B',10);
	    $this->SetXY(150,6);
	    $this->Cell(45,5,'ORDEN DE COMPRA',1,0,'C');
	    $this->Ln(6);	    
	    $this->SetX(60);
	    $this->SetFont('Arial','B',8);	    
	    $this->Cell(85,5,'C/ Marismas, 7. Area Empresarial Andalucía, Sector 1','LR',0,'C');
	    $this->SetX(150);
	    $this->SetFont('Arial','B',10);
	    $this->Cell(13,5,'Nº:','',0);
	    $this->SetFont('Arial','',10);
	    $this->Cell(30,5,$this->ordencompra->getNumero(),'',0);
	    $this->Ln();
	    $this->SetX(60);
	    $this->SetFont('Arial','B',8);	    
	    $this->Cell(85,5,'28320 PINTO (Madrid)','LR',0,'C');
	    $this->SetX(150);
	    $this->SetFont('Arial','B',10);
	    $this->Cell(13,5,'Rev:','',0);
	    $this->SetFont('Arial','',10);
	    $this->Cell(30,5,$revision,'',0);
	    $this->Ln();
	    $this->SetX(60);
	    $this->SetFont('Arial','B',8);	    
	    $this->Cell(85,6,'T: +34(9)1 621 30 70  F: +34(9)1 691 93 66   einar@einar.es','LR',0,'C');
	    $this->SetX(150);
	    $this->SetFont('Arial','B',10);
	    $this->Cell(13,5,'Fecha:','',0);
	    $this->SetFont('Arial','',10);
	    $this->Cell(30,5,myToDate($this->ordencompra->getFecha()),'',0);
	    $this->Ln(6);
		$this->SetXY(145,5);
		$this->Cell(57,23,'','TR',0);
		$this->Ln();

	    $this->Cell(20,6,'','LT',0,'R');
	    $this->Cell(35,6,'PROVEEDOR:','LT',0,'R');
	    $this->Cell(85,6,$this->proveedor->getNombre(),'T',0);
	    $this->Cell(15,6,'s/Oferta:','T',0,'L');
	    $this->SetFont('Arial','',8);
	    $this->Cell(37,6,$this->ordencompra->getSuOferta(),'TR',0);
	    $this->Ln(6);
	    
	    $this->Cell(20,6,'','L',0,'R');
	    $this->Cell(35,6,'Dirección:','L',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(85,6,$this->proveedor->getDireccion());
	    $this->Cell(52,6,'','R',0);
	    $this->Ln(5);
	    
	    $this->Cell(20,6,'','L',0,'R');
	    $this->Cell(35,6,'','L',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(85,6,$this->proveedor->getLocalidad());
	    $this->Cell(52,6,'','R',0,'L');
	    $this->Ln(5);
	    
	    $this->Cell(20,6,'','L',0,'R');
	    $this->Cell(35,6,'','L',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(85,6,$this->proveedor->getCodPostal() . " " . $this->proveedor->getProvincia());
	    $this->SetFont('Arial','',10);
	    $this->Cell(15,6,'Tel:','',0);
	    $this->SetFont('Arial','',8);
	    $this->Cell(37,6,$this->proveedor->getTelefono(),'R',0);
	    $this->Ln(6);
	    
	    $this->Cell(20,6,'','L',0,'R');
	    $this->SetFont('Arial','',10);
	    $this->Cell(35,6,'Persona Contacto:','L',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(85,6,$this->proveedor->getContacto(),'');
	    $this->SetFont('Arial','',10);
	    $this->Cell(15,6,'Fax:','',0,'L');
	    $this->SetFont('Arial','',8);
	    $this->Cell(37,6,$this->proveedor->getFax(),'R',0);
	    $this->Ln(5);

	    $this->Cell(20,4,'','L',0,'R');
	    $this->Cell(35,4,'Dirección Envío:','TL',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(85,4,$this->dirEnvio->getNombre(),'T');
	    $this->Cell(52,4,'','TR',0);
	    $this->Ln(3);
		
		$this->Cell(20,4,'','L',0,'R');
	    $this->Cell(35,4,'','L',0,'R');
	    $this->Cell(85,4,$this->dirEnvio->getDireccion1());
	    $this->Cell(52,4,'','R',0);
	    $this->Ln(3);
	    
	    $this->Cell(20,4,'','L',0,'R');
	    $this->Cell(35,4,'','L',0,'R');
	    $this->Cell(85,4,$this->dirEnvio->getDireccion2());
	    $this->Cell(52,4,'','R',0,'L');
	    $this->Ln(3);
	    
	    $this->Cell(20,4,'','L',0,'R');
	    $this->Cell(35,4,'','L',0,'R');
	    $this->Cell(85,4,$this->dirEnvio->getCodPostal() . " " . $this->dirEnvio->getProvincia());
	    $this->Cell(52,4,'','R',0,'L');
	    $this->Ln(4);
	    
		$this->Cell(20,6,'','L',0,'R');
	    $this->SetFont('Arial','',10);
	    $this->Cell(35,6,'Fecha Envío:','L',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(85,6,myToDate($this->ordencompra->getFechaEntrega()),'');
	    $this->SetFont('Arial','',10);
	    $this->Cell(15,6,'Portes:','',0,'L');
	    $this->SetFont('Arial','',8);
	    $this->Cell(37,6,$this->ordencompra->getPortes(),'R',0);
	    $this->Ln(6);
	    
	    $this->Cell(20,5,'','L',0,'R');
	    $this->SetFont('Arial','',9);
	    $this->Cell(5,5,'','LT',0,'R');
	    $this->Cell(167,5,'Muy Sres. Nuestros:','TR',1);
	    $this->Cell(20,5,'','L',0,'R');
	    $this->Cell(5,5,'','L',0,'R');
	    $this->Cell(167,5,'Conforme a su oferta y sometido a las Condiciones Generales de Compra que le adjuntamos y/o a las','R',1);
	    $this->Cell(20,5,'','L',0,'R');
	    $this->Cell(5,5,'','L',0,'R');
	    $this->Cell(167,5,'especiales reflejadas en este documento, les cursamos pedido del siguiente material:','R',1);

	    $this->SetFont('Arial','B',9);
	    $this->Cell(20,5,'Referencia',1,0);
	    $this->Cell(100,5,' MATERIAL',1,0,'C');
	    $this->Cell(20,5,'Uds.',1,0,'C');
	    $this->Cell(27,5,'Precio Ud.',1,0,'C');
	    $this->Cell(25,5,'Total €',1,0,'C');
        $this->Ln();
	}

	function dameAlto($texto)
	{
		$saltos=substr_count ($texto,"\n");
		$aTexto = explode("\n",$texto);
		for ($i=0;$i<count($aTexto);$i++)
		{
			$long_linea = ceil(strlen($aTexto[$i]) / 55);
			$saltos += $long_linea;
		}
		
		return ($saltos * 5);
	}
    
    function Footer()
    {
        $w=array(20,100,20,27,25);
        $posY = -79;
        $aDocIncluir = array("");
        
        //if ($this->PageNo() == $this->num_paginas)
        //{
            $total = number_format($this->sum_precio,1,',','.');
            $portes = $this->ordencompra->getPortes();
            $condiciones_pago = $this->ordencompra->getCondicionesPago();
            $vistobueno = $this->ordencompra->getVistoBueno();
            $responsable = $this->ordencompra->getResponsable();
            $doc_suministrar = str_replace("1","X",$this->ordencompra->getDocumentacionSuministrar());
            $doc_suministrar = str_replace("0","",$doc_suministrar);
            $doc_suministrar = explode("@",$doc_suministrar);
            $aDocIncluir = explode("\n",$this->ordencompra->getDocumentacionIncluir());
            $posY = (-79 - $this->altoDocIncluir);            
        //}        
        
        $this->SetX(10);        
        $this->SetY($posY);

        //TOTAL        
        $this->SetFont('Arial','B',10);
        $this->Cell($w[0],7,'','LR',0);
        $this->Cell($w[1],7,'TOTAL (s/I.V.A.):','LT',0,'R');
        $this->Cell(72,7,$total,'TR',1,'R');        
        
        //doc adjuntar
        $this->Cell($w[0],5,'','L',0);
        $this->Cell(172,5,'Documentación que se adjunta:',1,1);        
        
		for ($i=0;$i<count($aDocIncluir);$i++)
		{
        	$this->Cell($w[0],5,'','L',0);
        	$this->SetFont('Arial','',8);
        	$this->Cell(172,5,$aDocIncluir[$i],'LR');
        	$this->Ln(4);
        }        
        
        //doc suministrar
        $this->SetFont('Arial','B',10);
        $this->Cell($w[0],5,'','L',0);
        $this->Cell(172,5,'Documentación a suministrar:','LBR',1);
        $this->Cell($w[0],3,'','L',0);
        $this->SetFont('Arial','',6);
        $this->Cell(90,3,'o Estándar: (s/ EN 204)','L',0);
        $this->Cell(82,3,'o Otros','R',0);
        $this->Ln(2);
        $this->Cell($w[0],3,'','L',0);
        $this->Cell(5,3,'','L',0);
        $this->Cell(50,3,'Testificación de Conformidad con el pedido "2.1"','',0);
        $this->Cell(5,3,$doc_suministrar[0],'',0);
        $this->Cell(35,3,'','',0);
        $this->Cell(30,3,'Certificados de materiales','',0);
        $this->Cell(5,3,$doc_suministrar[2],'',0);
        $this->Cell(42,3,'','R',0);
        $this->Ln(2);
        $this->Cell($w[0],3,'','L',0);
        $this->Cell(5,3,'','L',0);
        $this->Cell(35,3,'Testificacion de Inspeccion "2.2"','',0);
        $this->Cell(5,3,$doc_suministrar[1],'',0);
        $this->Cell(127,3,'','R',0);
        $this->Ln(3);
        
        //condiciones de pago
        $this->SetFont('Arial','B',10);
        $this->Cell($w[0],5,'','L',0);
        $this->Cell(40,5,'Condiciones de pago:','LT',0);
        $this->SetFont('Arial','',9);
        $this->Cell(132,5,$condiciones_pago,'RT',0);
        $this->Ln();
        
        $this->SetFont('Arial','',10);
        $this->Cell($w[0],6,'','L',0);
        $this->Cell(172,6,'La ejecución de este pedido implica la aceptación de las condiciones establecidas','LTR',0);
        $this->Ln();
        
        $this->Cell($w[0],5,'','L',0);
        $this->Cell(98,5,'Atentamente le saluda:','L',0,'R');
        $this->Cell(27,5,'',0);
        $this->SetFont('Arial','B',10);
        $this->Cell(35,5,'Responsable Compra:',0);
        $this->Cell(12,5,'','R',0);
        $this->Ln();
        
        //firmas
        $this->SetFont('Arial','',7);
        $this->Cell($w[0],4,'','L',0);
        $this->Cell(30,4,'Vº Bº Dpto. Admon','LT',0);
        $this->Cell(30,4,'Vº Bº Técnico','LT',0);
        $this->SetFont('Arial','B',7);
        $this->Cell(55,4,'Aceptación Proveedor (firma y sello)','LTR',0);
        $this->Cell(57,4,'','R',0);
        $this->Ln(4);
        $this->Cell($w[0],9,'','L',0);
        $this->Cell(30,9,'','L',0);
        $this->Cell(30,9,'','L',0);
        $this->Cell(55,9,'','LR',0);
        $this->Cell(57,9,'','R',0);
        $this->Ln(9);
        $this->SetFont('Arial','',9);
        $this->Cell($w[0],5,'','LB',0);
        $this->Cell(30,5,'Fdo. B. Eresta','LB',0);
        //$this->Cell(30,5,$vistobueno,'LB',0);
        $this->Cell(30,5,'','LB',0);
        $this->Cell(55,5,'','LBR',0);
        $this->SetFont('Arial','B',9);
        $this->Cell(20,5,'Fdo: ','B',0,'R');
        $this->SetFont('Arial','',8);
        $this->Cell(37,5,$responsable,'BR',0);
        $this->Ln(5);
        
        //nota
        $this->SetFont('Arial','B',6);
        $this->Cell($w[0],4,'NOTA:','TLR',0,'C');
        $this->SetFont('Arial','',6);
        $this->Cell(172,4,'En el caso de no recibir confirmación de pedido, consideraremos definitivos: cantidad, precios, descuentos, plazos de entrega, portes, así como nuestras condiciones generales','TR',0);
        $this->Ln(2);
        $this->Cell($w[0],4,'','LR',0,'C');        
        $this->Cell(172,4,'de compra. Cualquier diferencia generará una devolución de su factura y/o retraso del pago.','R',0);
        $this->Ln(2);
        $this->Cell($w[0],4,'','BLR',0,'C');        
        $this->Cell(172,4,'Indíquese siempre en los albaranes nuestro número de pedido.','BR',0);
        $this->Ln(4);
        $this->SetFont('Arial','B',6);
        //$this->Cell(192,4,'PGC16-F01-' . $this->revision,'',0,'R');
        $this->Cell(192,4,'PGC16-F01-r03','',0,'R');       
    }
    
    function LineItems($array_referencias,$array_conceptos,$array_cantidades,$array_precio)
    {
        $w=array(20,100,20,27,25);

        $x = $this->GetX();
        $this->SetFont('Arial','',8);
        
        for($i=0;$i<count($array_conceptos);$i++)
        {    
            if ( ($this->getY() + $this->dameAlto($array_conceptos[$i])) > 222 )
            {
                $alto = 222 - $this->GetY();
                $this->Cell($w[0],$alto,'','L',0);
                $this->Cell($w[1],$alto,'','L',0);
                $this->Cell($w[2],$alto,'','L',0);
                $this->Cell($w[3],$alto,'','L',0);
                $this->Cell($w[4],$alto,'','LR',0);
                $this->AddPage();
            }

            $this->Cell($w[0], 5, $array_referencias[$i], 'L',0,'C');
            $y1 = $this->GetY();
            $this->MultiCell($w[1], 4, $array_conceptos[$i], 'L');
            $y2 = $this->GetY();
            $yH = $y2 - $y1;
            
            $this->SetY($y1);
            $this->SetX($x + $w[0] + $w[1]);
            
            $this->Cell($w[2], 5, $array_cantidades[$i], 'L', 0, 'R');
            
            $tot_precio = $array_precio[$i] * $array_cantidades[$i];
            $this->Cell($w[3], 5, number_format($array_precio[$i], 1,',','.'), 'L', 0, 'R');
            $this->Cell($w[4], 5, number_format($tot_precio, 1,',','.'), 'LR', 0, 'R');
            $this->sum_precio += $tot_precio;
                        
            //relleno de las lineas
            $this->Ln();
            $this->SetX($x);
            $this->Cell($w[0], $yH+2, '', 'LR');
            $this->SetX($x + $w[0] + $w[1]);
            $this->Cell($w[2], $yH, '', 'L');    
            $this->Cell($w[3], $yH, '', 'L');    
            $this->Cell($w[4], $yH, '', 'LR');    
            $this->Ln();
            $this->SetX($x);
        }
        
        //if ($this->PageNo() == $this->num_paginas)
        //{     
        	$posYactual = intval($this->GetY());
        	if ($posYactual > 140 && $posYactual <= 186)
        		$alto = 214 - $posYactual;
        	else      
            	$alto = 222 - $posYactual;
            $this->Cell($w[0],$alto,'','L',0);
            $this->Cell($w[1],$alto,'','L',0);
            $this->Cell($w[2],$alto,'','L',0);
            $this->Cell($w[3],$alto,'','L',0);
            $this->Cell($w[4],$alto,'','LR',0);
            $this->Ln();
        //}
    } 
}

$pdf=new PDF();

$pdf->ordencompra = new OrdenCompra($_GET['id_ordencompra']);

$pdf->proveedor = new Proveedor($pdf->ordencompra->getIdProveedor());
$pdf->dirEnvio = new ProveedorDireccionEnvio($pdf->ordencompra->getIdProveedorDireccionEnvio());

$revision = new Revision();
$pdf->revision = $revision->getRevisionByDate($pdf->ordencompra->getFecha(),'ordencompra');

$equipos = new OrdenCompraEquipos();
$aEquipos = $equipos->getEquipos($_GET['id_ordencompra']);
for ($i=0;$i<count($aEquipos);$i++)
{
	$aReferencias[] = $aEquipos[$i]['referencia'];
	$aCantidades[] = $aEquipos[$i]['cantidad'];
	$aConceptos[] = $aEquipos[$i]['descripcion'];
	$aPrecios[] = $aEquipos[$i]['precio'];
    
	$total_alto += $pdf->dameAlto($aEquipos[$i]['descripcion']);
}

$pdf->num_paginas = ceil((97 + $total_alto) / 222);  //TODO: optimizar

$saltos=substr_count ($pdf->ordencompra->getDocumentacionIncluir(),"\n");
$pdf->altoDocIncluir = (4 * ($saltos - 1));
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->LineItems($aReferencias,$aConceptos,$aCantidades,$aPrecios);
$pdf->Output();
?>