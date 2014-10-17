<?php
include("includes/security.php");
require('fpdf/fpdf.php');
include('includes/conf.php');
include('includes/funciones.php');
include('class/factura.class.php');
include('class/factura_equipos.class.php');
include('class/cliente.class.php');
include('class/cliente_direccion_envio.class.php');

class PDF extends FPDF
{
    var $sum_precio;
    var $factura;
    var $cliente;
    var $dirEnvio;
    
    function Header()
	{
        if ($this->factura->getEsAbono() == '1')
        {
            $titFactura = 'ABONO Nº';
            $tipoInforme = ' ABONO ';
            $anchoTipo = 33;
            $alineacion = 'L';
            $posX = 158;
        }
        else if ($this->factura->getFacturaProforma() == '1')
        {
            $titFactura = 'FACTURA Nº';
            $tipoInforme = ' FACTURA PROFORMA ';
            $anchoTipo = 82;
            $alineacion = 'R';
            $posX = 110;
        }
        else
        {
            $titFactura = 'FACTURA Nº';
            $tipoInforme = ' FACTURA ';
            $anchoTipo = 40;
            $alineacion = 'L';
            $posX = 150;
        }
        
        if ($this->factura->getFacturaEnDolares() == '1')
            $tipoMoneda = 'DOLARES';
        else            
            $tipoMoneda = 'PRECIO UD.';
            
        $this->Image('img/logo1.jpg',10,5,65);
	    $this->SetXY(120,5);
        $this->SetFont('Arial','B',10);
        $this->Cell(75,6,'EINAR, S.A.','',0);
        $this->Ln(5);
		$this->SetX(120);
		$this->SetFont('Arial','',10);
		$this->Cell(75,6,'SERVICIOS TÉCNICOS Y COMERCIALES','',0);
        $this->Ln(5);
        $this->SetX(120);
        $this->Cell(75,6,'AREA EMPRESARIAL ANDALUCÍA Sector 1','',0);	    
	    $this->Ln(5);
	    $this->SetX(120);
	    $this->Cell(75,6,'C/ Marismas, 7.   28320 PINTO (Madrid)','',0);
	    $this->Ln(5);
	    $this->SetX(120);
	    $this->Cell(75,6,'T: +34(9)1 621 30 70  F: +34(9)1 691 93 66','',0);
	    $this->Ln(5);
	    $this->SetX(120);
	    $this->Cell(75,5,'E-mail: einar@einar.es','',0);
	    $this->Ln(10);
        $y = $this->GetY();
        
	    $this->Cell(190,4,'','TB',0);
        $this->Ln();
        
        $this->SetY($this->GetY() - 5);
        $this->SetX($posX);
        $this->SetFont('Arial','BI',20);
        $this->SetFillColor(255,255,255);
        $this->Cell($anchoTipo,6,$tipoInforme,'',0,$alineacion,true);
        $this->Ln(11);        
        
        $this->Cell(90,4,'','LTR');
        $this->Cell(10,4,'');
        $this->Cell(90,4,'','LTR');
        $this->Ln(4); 
        
        $y = $this->GetY();
        $this->SetFont('Arial','',10);       
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$this->dirEnvio->getNombre());
        $this->Cell(5,5,'','R');
        $this->Cell(10,5,'');
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$this->cliente->getNombre());
        $this->Cell(5,5,'','R');
        $this->Ln();
        
		list($dir1,$dir2) = explode("\n",$this->cliente->getDireccion());
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$this->dirEnvio->getDireccion1());
        $this->Cell(5,5,'','R');
        $this->Cell(10,5,'');
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$dir1);
        $this->Cell(5,5,'','R');
        $this->Ln();
        
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$this->dirEnvio->getDireccion2());
        $this->Cell(5,5,'','R');
        $this->Cell(10,5,'');
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$dir2);
        $this->Cell(5,5,'','R');
        $this->Ln();
        
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$this->dirEnvio->getLocalidad());
        $this->Cell(5,5,'','R');
        $this->Cell(10,5,'');
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$this->cliente->getLocalidad());
        $this->Cell(5,5,'','R');
        $this->Ln();
        
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$this->dirEnvio->getCodPostal() . " " . $this->dirEnvio->getProvincia());
        $this->Cell(5,5,'','R');
        $this->Cell(10,5,'');
        $this->Cell(5,5,'','L');
        $this->Cell(80,5,$this->cliente->getCodPostal() . " " . $this->cliente->getProvincia());
        $this->Cell(5,5,'','R');
        $this->Ln();
        
        $this->Cell(90,2,'','LBR');
        $this->Cell(10,2,'');
        $this->Cell(90,2,'','LBR');
        $y1 = $this->GetY();
        
        $this->SetFont('Arial','B',10);
        $this->SetXY(15,($y - 7));
        $this->Cell(50,6,'DIRECCIÓN DE EXPEDICIÓN','',0,'L',true);
        $this->SetX(115);
        $this->Cell(18,6,'CLIENTE','',0,'L',true);
        $this->SetY($y1-2);
        $this->Ln();
        
        $this->SetFont('Arial','',10);
        $this->Cell(32,6,$titFactura,1,0,'C');
        $this->Cell(33,6,'ALBARAN Nº',1,0,'C');
        $this->Cell(30,6,'FECHA FRA.',1,0,'C');
        $this->Cell(30,6,'N/REF',1,0,'C');
        $this->Cell(30,6,'S/REF',1,0,'C');
        $this->Cell(35,6,'C.I.F. CLIENTE',1,0,'C');
        $this->Ln(6);
        $this->Cell(32,6,$this->factura->getNumero() . "/" . $this->factura->getCodigo(),1,0,'C');
        $this->Cell(33,6,$this->factura->getNumeroAlbaran(),1,0,'C');
        $this->Cell(30,6,myToDate($this->factura->getFecha()),1,0,'C');
        $this->Cell(30,6,$this->factura->getNumeroPedido(),1,0,'C');
        $this->Cell(30,6,$this->factura->getSuReferencia(),1,0,'C');
        $this->Cell(35,6,$this->cliente->getCIF(),1,0,'C');
        $this->Ln(9);
        
        $this->Cell(18,6,'TITULO:','LTB',0,'C');
        $this->Cell(172,6,$this->factura->getObra(),'TBR');
        $this->Ln(9);

	    $this->SetFont('Arial','B',9);
	    $this->Cell(32,5,'REF.',1,0,'C');
	    $this->Cell(100,5,' CONCEPTO',1,0,'C');
	    $this->Cell(15,5,'UD.',1,0,'C');
	    $this->Cell(21,5,$tipoMoneda,1,0,'C');
	    $this->Cell(22,5,'IMPORTE',1,0,'C');
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
		
		return ($saltos * 4);
	}
    
	function myFooter($mostrarDatos)
    {
        if ($this->factura->getFacturaEnDolares() == '1')
            $moneda = 'DOLARES';
        else            
            $moneda = 'EUROS';
        
		if ($mostrarDatos == "true")
        {
            if ($this->factura->getEsAbono() == '1')
			{
				$txtTotal = 'SUMA ........';
			}
			else if ($this->factura->getFacturaEnOrigen() == '1')
            {
                if ($this->factura->getFacturaEnDolares() == '1')
                    $txtTotal = 'DIFERENCIA (en Dólares)........';
                else
                    $txtTotal = 'DIFERENCIA ........';
            }
            else
            {
                if ($this->factura->getFacturaEnDolares() == '1')
                    $txtTotal = 'SUMA (en Dólares)........';
                else
                    $txtTotal = 'SUMA ........';
            }
            
            $subtotal = number_format($this->sum_precio,2,',','.');
            
            $aval = $this->factura->getAval();
            if (!empty($aval))
                $aval = number_format($this->factura->getAval(),2,',','.');
            else
                $aval = "";
            
            if ($this->factura->getFacturaSinIVA() == '0')
            {
                $porcentaje_retencion = $this->factura->getPorcentajeRetencion();
                $porcentaje_iva = $this->factura->getIVA();
                $importe_retencion = $this->sum_precio * ($porcentaje_retencion / 100);
                
                if ($this->factura->getTipoRetencion() == 'sin_iva')
                {
                    $base_iva = $this->sum_precio;
                    $importe_iva = $base_iva * ($porcentaje_iva / 100);
                    $total = number_format($base_iva - $importe_retencion + $importe_iva,2,',','.');
                }
				else //($this->factura->getTipoRetencion() == 'con_iva')
                {
                    $base_iva = $this->sum_precio - $importe_retencion;
                    $importe_iva = $this->sum_precio * ($porcentaje_iva / 100);
                    $total = number_format($base_iva + $importe_iva,2,',','.');
                }
                
                $base_iva = number_format($base_iva,2,',','.');
                $importe_iva = number_format($importe_iva,2,',','.');
                $importe_retencion = number_format($importe_retencion,2,',','.');
				
				if ($importe_retencion == 0) $importe_retencion = "";
				if ($porcentaje_retencion == 0) $porcentaje_retencion = "";
            }
            else
            {
                $total = $subtotal;
            }
			
			$num_cuenta = $this->factura->getNumeroCuenta();
			$forma_pago_factura = $this->factura->getFormaPago();
            if (empty($forma_pago_factura))
            {
                $forma_pago = $this->cliente->getFormaPago();
                
                if (strpos($forma_pago,"días") !== false)
                {
                    $aFP = explode("días",$forma_pago);
                    $dias = ereg_replace("[^0-9]", "", $aFP[0]); 
                    if ($dias > 0)
                    {
                        $fechaFactura = $this->factura->getFecha();
                        list($a,$m,$d) = explode("-",$fechaFactura);
                        $fecha = date("d/m/Y",mktime(0,0,0,$m, $d + $dias, $a));
                    }
                    
                    $forma_pago .= " Fecha de pago: " . $fecha;
                }
            }
            else
                $forma_pago = $forma_pago_factura;
        } 

        $this->SetX(10);        
        $this->SetY(-45);
        
        $this->SetFont('Arial','B',12);
        $this->Cell(32,5,'','LBR',0,'C');
        $this->Cell(100,5,$txtTotal,'LBR',0,'R');
        $this->Cell(15,5,'','LBR',0,'C');
        $this->Cell(21,5,'','LBR',0,'C');
        $this->SetFont('Arial','B',10);
        $this->Cell(22,5,$subtotal,'LBR',0,'C');
        $this->Ln(8);
        
        $this->SetFont('Arial','',9);
        $this->Cell(32,6,'SUBTOTAL'.$mostarDatos,'LTR',0,'C');
        $this->Cell(27,6,'DESCUENTO','LTR',0,'C');
        $this->Cell(27,6,'RETENCIÓN','LTR',0,'C');
        $this->Cell(20,6,'AVAL','LTR',0,'C');
        $this->Cell(25,6,'BASE I.V.A.','LTR',0,'C');
        $this->Cell(27,6,'I.V.A.','LTR',0,'C');
        $this->Cell(32,6,'TOTAL FACTURA','LTR',0,'C');
        $this->Ln(6);
        $this->Cell(32,5,'','LBR',0,'C');
        $this->Cell(8,5,'%','LBR',0,'C');
        $this->Cell(19,5,'IMPORTE','LBR',0,'C');
        $this->Cell(8,5,'%','LBR',0,'C');
        $this->Cell(19,5,'IMPORTE','LBR',0,'C');
        $this->Cell(20,5,'','LBR',0,'C');
        $this->Cell(25,5,'','LBR',0,'C');
        $this->Cell(8,5,'%','LBR',0,'C');
        $this->Cell(19,5,'IMPORTE','LBR',0,'C');
        $this->Cell(32,5,$moneda,'LBR',0,'C');
        $this->Ln();
        $this->Cell(32,8,$subtotal,'LBR',0,'C');
        $this->Cell(8,8,$porcentaje_descuento,'LBR',0,'C');
        $this->Cell(19,8,$importe_descuento,'LBR',0,'C');
        $this->Cell(8,8,$porcentaje_retencion,'LBR',0,'C');
        $this->Cell(19,8,$importe_retencion,'LBR',0,'C');
        $this->Cell(20,8,$aval,'LBR',0,'C');
        $this->Cell(25,8,$base_iva,'LBR',0,'C');
        $this->Cell(8,8,$porcentaje_iva,'LBR',0,'C');
        $this->Cell(19,8,$importe_iva,'LBR',0,'C');
        $this->Cell(32,8,$total,'LBR',0,'C');        
        $this->Ln();
        $this->Cell(40,6,'FORMA DE PAGO:','',0,'C');
        $this->Cell(150,6,$forma_pago);
        $this->Ln(4);
        $this->Cell(40,6,'','',0,'C');
        $this->Cell(150,6,$num_cuenta);
        $this->Ln(4);
        $this->SetFont('Arial','',6);
        $this->Cell(190,6,'R.M. Madrid, T. 1995, libro 0, folio 63, sección 8, hoja M-35636, inscrip. 8ª. C.I.F. A-78420627','',0,'C');
    }
    
    function LineItems($array_referencias,$array_conceptos,$array_cantidades,$array_precio)
    {
        $w=array(32,100,15,21,22);

        $x = $this->GetX();
        
        for($i=0;$i<count($array_conceptos);$i++)
        {    
            if ( ($this->getY() + $this->dameAlto($array_conceptos[$i])) > 252 )
            {
                $alto = 252 - $this->GetY();
                $this->Cell($w[0],$alto,'','L',0);
                $this->Cell($w[1],$alto,'','L',0);
                $this->Cell($w[2],$alto,'','L',0);
                $this->Cell($w[3],$alto,'','L',0);
                $this->Cell($w[4],$alto,'','LR',0);
				$this->myFooter("false");
                $this->AddPage();
            }
			
			$this->SetFont('Arial','',8);
            $this->Cell($w[0], 5, $array_referencias[$i], 'L',0,'C');
            $y1 = $this->GetY();
            $this->MultiCell($w[1], 4, $array_conceptos[$i], 'L');
            $y2 = $this->GetY();
            $yH = $y2 - $y1+2;
            
            $this->SetY($y1);
            $this->SetX($x + $w[0] + $w[1]);
            
            $facturaEnOrigen = $this->factura->getFacturaEnOrigen();
			
			$cantidad = floatval($array_cantidades[$i]);
			if ($cantidad == 0 && $facturaEnOrigen == "0") $cantidad = '';
			$this->Cell($w[2], 5, $cantidad, 'L', 0, 'R');
            
            $tot_precio = $array_precio[$i] * $array_cantidades[$i];
			$this->sum_precio += $tot_precio;
			
			$tot_precio = number_format($tot_precio, 2,',','.');
			if (intval($tot_precio) == 0 && $facturaEnOrigen == "0") $tot_precio = '';
			
			$precio = number_format($array_precio[$i], 2,',','.');
			if (intval($precio) == 0 && $facturaEnOrigen == "0") $precio = '';
            $this->Cell($w[3], 5, $precio, 'L', 0, 'R');
            $this->Cell($w[4], 5, $tot_precio, 'LR', 0, 'R');

            //relleno de las lineas
            $this->Ln();
            $this->SetX($x);
            $this->Cell($w[0], $yH+5, '', 'LR');
            $this->SetX($x + $w[0] + $w[1]);
            $this->Cell($w[2], $yH, '', 'L');    
            $this->Cell($w[3], $yH, '', 'L');    
            $this->Cell($w[4], $yH, '', 'LR');    
            $this->Ln();
            $this->SetX($x);
        }

        $alto = 252 - $this->GetY();
        $this->Cell($w[0],$alto,'','L',0);
        $this->Cell($w[1],$alto,'','L',0);
        $this->Cell($w[2],$alto,'','L',0);
        $this->Cell($w[3],$alto,'','L',0);
        $this->Cell($w[4],$alto,'','LR',0);
        $this->Ln();
		$this->myFooter("true");
    } 
}

$pdf=new PDF();

$pdf->factura = new Factura($_GET['id_factura']);
$pdf->cliente = new Cliente($pdf->factura->getIdCliente());
$pdf->dirEnvio = new ClienteDireccionEnvio($pdf->factura->getIdClienteDireccionEnvio());

$equipos = new FacturaEquipos();
$aEquipos = $equipos->getEquipos($_GET['id_factura']);
for ($i=0;$i<count($aEquipos);$i++)
{
	$aReferencias[] = $aEquipos[$i]['referencia'];
	$aCantidades[] = $aEquipos[$i]['cantidad'];
	$aConceptos[] = $aEquipos[$i]['descripcion'];
	$aPrecios[] = $aEquipos[$i]['precio'];
}

$pdf->SetAutoPageBreak(false);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->LineItems($aReferencias,$aConceptos,$aCantidades,$aPrecios);
$pdf->Output();
?>