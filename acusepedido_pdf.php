<?php
include("includes/security.php");
require('fpdf/fpdf.php');
include('includes/conf.php');
include('includes/funciones.php');
include('class/acusepedido.class.php');
include('class/acusepedido_equipos.class.php');
include('class/cliente.class.php');
include('class/cliente_direccion_envio.class.php');
include('class/revision.class.php');

class PDF extends FPDF
{
	var $num_paginas;
    var $sum_precio;
	var $acusepedido;
	var $cliente;
	var $dirEnvio;
	var $revision;
	var $aplicarIVA;
    
    function Header()
	{
        if ($this->acusepedido->getRevision() > 0) $revision = $this->acusepedido->getRevision();
            
        $this->Image('img/logo1.jpg',15,4,45);
	    $this->SetXY(10,5);
		$this->Cell(55,16,'','LT',0);
	    $this->SetFont('Arial','B',14);
	    $this->Cell(85,16,'ACUSE DE PEDIDO','LTR',0,'C');
	    $this->SetFont('Arial','B',10);
	    $this->SetXY(150,5);
	    $this->Cell(5,5,'','');
		$this->Cell(15,5,'Nº','T',0);
	    $this->SetFont('Arial','',10);
		$this->Cell(32,5,$this->acusepedido->getCodigo() . "-" . $this->acusepedido->getNumero(),'',0);
	    $this->Ln(6);	    
		$this->SetX(150);
	    $this->SetFont('Arial','B',12);	    
	    $this->Cell(5,5,'','');
		$this->Cell(15,5,'Rev.','',0);
	    $this->SetFont('Arial','',10);		
	    $this->Cell(32,5,$revision,'',0);
	    $this->Ln(6);
	    $this->SetX(150);
	    $this->SetFont('Arial','B',12);	    
	    $this->Cell(5,5,'','');
		$this->Cell(15,5,'Fecha','',0);
	    $this->SetFont('Arial','',10);		
	    $this->Cell(32,5,myToDate($this->acusepedido->getFecha()),'',0);
		$this->Ln();
		$this->SetXY(150,5);
		$this->Cell(52,16,'','TR',0);
	    $this->Ln();
	    $this->Cell(50,6,'CLIENTE:','LT',0,'R');
	    $this->Cell(80,6,$this->cliente->getNombre(),'T',0);
	    $this->Cell(23,6,'s/Referencia:','T',0,'L');
	    $this->Cell(39,6,$this->acusepedido->getSuReferencia(),'TR',0);
	    $this->Ln(6);
	    
	    $this->Cell(50,6,'Dirección:','L',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(80,6,$this->cliente->getDireccion());
	    $this->SetFont('Arial','',10);
	    $this->Cell(23,6,'de Fecha:','',0,'L');
	    $this->Cell(39,6,myToDate($this->acusepedido->getDeFecha()),'R',0);
	    $this->Ln(5);
	    
	    $this->Cell(50,6,'','L',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(80,6,$this->cliente->getLocalidad());
	    $this->Cell(62,6,'','R',0,'L');
	    $this->Ln(5);
	    
	    $this->Cell(50,6,'','L',0,'R');
	    $this->SetFont('Arial','',8);
	    $this->Cell(80,6,$this->cliente->getCodPostal() . " " . $this->cliente->getProvincia());
	    $this->Cell(62,6,'','R',0,'L');
	    $this->Ln(6);
	    
	    $this->SetFont('Arial','',10);
	    $this->Cell(50,6,'Dirección Envío:','LT',0,'R');
	    $this->SetFont('Arial','',8);
		
		$y = $this->GetY();
	    $this->Cell(80,6,$this->dirEnvio->getNombre(),'T',0);
		$this->Ln(4);
		$this->Cell(50,4,'','L',0);
		$this->SetX(60);
		$this->Cell(70,4,$this->dirEnvio->getDireccion1(),'',0);
		$this->Ln(3);
		$this->Cell(50,4,'','L',0);
		$this->SetX(60);
		$this->Cell(70,4,$this->dirEnvio->getDireccion2(),'',0);
		$this->Ln(3);
		$this->Cell(50,4,'','L',0);
		$this->SetX(60);
		$loc = $this->dirEnvio->getLocalidad();
		$prov = $this->dirEnvio->getProvincia();
		$provincia = "";
		if (!empty($loc) && !empty($prov))
			$provincia = $loc . ", " . $prov;
		else if (empty($loc) && !empty($prov))
			$provincia = $prov;
		else if (!empty($loc) && empty($prov))
			$provincia = $loc;
		$this->Cell(70,4,$this->dirEnvio->getCodPostal() . " " . $provincia,'',0);
		$this->setXY(140,$y);
		$this->SetFont('Arial','',10);
		$this->Cell(23,6,'Tel:','T',0,'L');
	    $this->Cell(39,6,$this->cliente->getTelefono(),'TR',0);
		$this->Ln(6);
		$this->setX(140);
		$this->Cell(23,7,'Fax:','',0,'L');
	    $this->Cell(39,7,$this->cliente->getFax(),'R',0);
		$this->Ln(6);
	    $this->Cell(50,8,'Fecha Envío:','L',0,'R');
	    $this->Cell(80,8,myToDate($this->acusepedido->getFechaEnvio()),'',0);
	    $this->Cell(23,6,'e-mail:','',0,'L');
		$this->SetFont('Arial','',8);
	    $this->Cell(39,6,$this->cliente->getEmail(),'R',0);
	    $this->Ln(6);
	    
	    $this->SetFont('Arial','B',10);
	    $this->Cell(67,5,' MATERIAL',1,0,'C');
	    $this->Cell(25,5,' Referencia',1,0,'C');
	    $this->Cell(20,5,'Cantidad',1,0,'C');
	    $this->Cell(35,5,'Plazo Entrega',1,0,'C');
	    $this->Cell(20,5,'P. Unitario',1,0,'C');
	    $this->Cell(25,5,'Total ',1,0,'C');
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
        if ($this->PageNo() == $this->num_paginas)
        {
            $subtotal = number_format(($this->sum_precio),1,',','.');
        	
        	
            $forma_envio = $this->acusepedido->getFormaEnvio();
            $forma_pago = str_replace("@"," ",$this->acusepedido->getFormaPago());
            $portes = $this->acusepedido->getPortes();
            
			if ($this->aplicarIVA == "1")
			{
				$iva = "21";
				$total_iva = ($this->sum_precio * (21 / 100));
				$total = ($this->sum_precio + $total_iva);
				$total_iva = number_format($total_iva,1,',','.');		
			}
			else
			{
				$iva = "";
				$total_iva = "";
				$total = ($this->sum_precio);
			}
			
        	$total = number_format($total,1,',','.');
        }
        
        $this->SetX(10);
        $this->SetY(-47);

        //total
        $this->SetFont('Arial','B',11);
        $this->Cell(167,7,'TOTAL: ','LT',0,'R');
        $this->Cell(22,7,$subtotal,'T',0,'R');
        $this->Cell(3,7,'','TR',0);
        $this->Ln();        
        
        $this->SetFont('Arial','B',11);
        $this->Cell(112,5,'Forma de Envío','LTR',0);
        $this->SetFont('Arial','',9);
        $this->Cell(80,5,'','TR',0);
        $this->Ln();
        $this->Cell(112,6,$forma_envio,'LR',0,'R');
        $this->Cell(80,6,'','R',0);
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->Cell(112,5,'Forma de Pago','LTR',0);
        $this->SetFont('Arial','',11);
        $this->Cell(35,5,'I.V.A. (%): ','',0);
        $this->Cell(20,5,$iva,'',0,'C');
        $this->Cell(22,5,$total_iva,'',0,'R');
        $this->Cell(3,5,'','R',0);
        $this->Ln();
		$this->SetFont('Arial','',9);
        $this->Cell(112,6,$forma_pago,'LR',0,'R');
        $this->Cell(80,6,'','R',0);
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->Cell(112,5,'Portes','LTR',0);
        $this->SetFont('Arial','B',12);
        $this->Cell(35,5,'TOTAL: ','',0,'R');
        $this->Cell(20,5,'','',0);
        $this->Cell(22,5,$total,'',0,'R');
        $this->Cell(3,5,'','R',0);
        $this->Ln();
        $this->SetFont('Arial','',9);
        $this->Cell(112,6,$portes,'LBR',0,'R');
        $this->Cell(80,6,'','BR',0);
        
        $this->Ln();
        $this->SetFont('Arial','',6);
        $this->Cell(192,4,'PGC11-F03-' . $this->revision,'',0,'R');
    }
    
    function LineItems($array_conceptos,$array_referencias,$array_cantidades,$array_plazoentrega,$array_precio)
    {
        $w=array(67,25,20,35,20,25);

        $x = $this->GetX();
        $this->SetFont('Arial','',8);
        
        for($i=0;$i<count($array_conceptos);$i++)
        {    
            if ( ($this->getY() + $this->dameAlto($array_conceptos[$i])) > 250 )
            {
                $alto = 250 - $this->GetY();
                $this->Cell($w[0],$alto,'','LR',0);
                $this->Cell($w[1],$alto,'','R',0);
                $this->Cell($w[2],$alto,'','R',0);
                $this->Cell($w[3],$alto,'','R',0,'R');
                $this->Cell($w[4],$alto,'','R',0,'R');
                $this->Cell($w[5],$alto,'','R',0,'R');
                $this->AddPage();
            }

            $y1 = $this->GetY();
            $this->MultiCell($w[0], 5, $array_conceptos[$i], 'LR');    
            $y2 = $this->GetY();
            $yH = $y2 - $y1;
            
            $this->SetY($y1);
            $this->SetX($x + $w[0]);
            $this->Cell($w[1], 5, $array_referencias[$i], 'R',0,'C');
            $this->Cell($w[2], 5, $array_cantidades[$i], 'R', 0, 'R');                      
            
            $tot_precio = $array_precio[$i] * $array_cantidades[$i];
            $this->Cell($w[3], 5, $array_plazoentrega[$i], 'R', 0, 'C');
            $this->Cell($w[4], 5, number_format($array_precio[$i], 1,',','.'), 'R', 0, 'R');
            $this->Cell($w[5], 5, number_format($tot_precio, 1,',','.'), 'R', 0, 'R');
            $this->sum_precio += $tot_precio;
                        
            //relleno de las lineas
            $this->Ln();
            $this->SetX($x);                    
            $this->SetX($x + $w[0]);
            $this->Cell($w[1], $yH, '', 'LR');    
            $this->Cell($w[2], $yH, '', 'R');    
            $this->Cell($w[3], $yH, '', 'R');    
            $this->Cell($w[4], $yH, '', 'R');    
            $this->Cell($w[5], $yH, '', 'R');    
            $this->Ln();
            $this->SetX($x);
        }
        
        if ($this->PageNo() == $this->num_paginas)
        {           
            $alto = 250 - $this->GetY();
            $this->Cell($w[0],$alto,'','LR',0);
            $this->Cell($w[1],$alto,'','R',0);
            $this->Cell($w[2],$alto,'','R',0);
            $this->Cell($w[3],$alto,'','R',0,'R');
            $this->Cell($w[4],$alto,'','R',0,'R');
            $this->Cell($w[5],$alto,'','R',0,'R');
            $this->Ln();
        }        
    } 
}

$pdf=new PDF();

$pdf->acusepedido = new AcusePedido($_GET['id_acusepedido']);
$pdf->cliente = new Cliente($pdf->acusepedido->getIdCliente());
$pdf->dirEnvio = new ClienteDireccionEnvio($pdf->acusepedido->getIdClienteDireccionEnvio());
$revision = new Revision();
$pdf->revision = $revision->getRevisionByDate($pdf->acusepedido->getFecha(),'acusepedido');

$equipos = new AcusePedidoEquipos();
$aEquipos = $equipos->getEquipos($_GET['id_acusepedido']);
for ($i=0;$i<count($aEquipos);$i++)
{
	$aReferencias[] = $aEquipos[$i]['referencia'];
	$aCantidades[] = $aEquipos[$i]['cantidad'];
	$aConceptos[] = $aEquipos[$i]['descripcion'];
	$aPrecios[] = $aEquipos[$i]['precio_venta'];
    $aPlazoEntrega[] = $aEquipos[$i]['plazo_entrega'];
    
	$total_alto += $pdf->dameAlto($aEquipos[$i]['descripcion']);
}

$pdf->num_paginas = ceil((70 + $total_alto) / 250);  //TODO: optimizar
$pdf->aplicarIVA = $_GET['iva'];
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->LineItems($aConceptos,$aReferencias,$aCantidades,$aPlazoEntrega,$aPrecios);
$pdf->Output();
?>