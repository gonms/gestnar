<?php
include("includes/security.php");
require('fpdf/fpdf.php');
include('includes/conf.php');
include('includes/funciones.php');
include('class/pedido.class.php');
include('class/pedido_proveedores.class.php');
include('class/pedido_equipos.class.php');
include('class/cliente.class.php');
include('class/cliente_direccion_envio.class.php');
include('class/cliente_contactos.class.php');
include('class/revision.class.php');

class PDF extends FPDF
{
	var $num_paginas;
    var $sum_venta;
    var $sum_coste;
	var $pedido;
	var $cliente;
	var $dirEnvio;
	var $contacto;
	var $aProveedores;
	var $revision;
	    
    function Header()
	{
		if ($this->pedido->getRevision() > 0)
			$revision = $this->pedido->getRevision();
		else
			$revision = "";

		$this->Image('img/logo1.jpg',10,4,45);
	    $this->SetXY(10,5);
		$this->Cell(50,15,'','LT',0);
	    $this->SetFont('Arial','B',14);
	    $this->Cell(85,6,'PEDIDOS','LTR',0,'C');
	    $this->SetFont('Arial','B',10);
	    $this->Cell(5,5,'','',0);
	    $this->Cell(15,5,'Nº','',0);
	    $this->SetFont('Arial','',10);
	    $this->Cell(15,5,$this->pedido->getNumeroPedido(),'',0);
	    $this->Ln();
		$this->SetX(60);
	    $this->SetFont('Arial','B',12);
	    $this->Cell(85,6,'','LR',0,'C');
	    $this->SetFont('Arial','B',10);
	    $this->Cell(5,5,'','',0);
	    $this->Cell(15,5,'Rev.','',0);
	    $this->SetFont('Arial','',10);
	    $this->Cell(95,5,$revision,'',0);
	    $this->Ln();
	    $this->SetX(60);
	    $this->SetFont('Arial','B',12);
	    $this->Cell(85,5,'FICHA DE CONTROL','LR',0,'C');
	    $this->SetFont('Arial','B',10);
	    $this->Cell(5,5,'','',0);
	    $this->Cell(15,5,'Fecha','',0);
	    $this->SetFont('Arial','',10);
	    $this->Cell(95,5,myToDate($this->pedido->getFecha()),'',0);
	    $this->Ln(5);
		$this->SetXY(135,5);
		$this->Cell(65,15,'','TR',0);
	    $this->Ln();
		
	    $this->Cell(20,6,'','LTR',0);
	    $this->Cell(40,6,'CLIENTE:','T',0,'R');
	    $this->Cell(70,6,$this->cliente->getNombre(),'T',0);
	    $this->Cell(25,6,'s/Ref:','T',0);
	    $this->Cell(35,6,$this->pedido->getSuReferencia(),'TR',0);
	    $this->Ln(6);
	    
	    $this->Cell(20,6,'','LR',0);
	    $this->Cell(40,6,'Dirección:','',0,'R');
	    $this->Cell(70,6,$this->cliente->getDireccion(),'',0);
	    $this->Cell(25,6,'de Fecha:','',0);
	    $this->Cell(35,6,myToDate($this->pedido->getDeFecha()),'R',0);
	    $this->Ln(6);
	    
	    $this->Cell(20,6,'','LR',0);
	    $this->Cell(40,6,'','',0,'R');
		$loc = $this->cliente->getLocalidad();
		$prov = $this->cliente->getProvincia();
		if (!empty($loc) && !empty($prov))
			$provincia = $loc . ", " . $prov;
		else if (empty($loc) && !empty($prov))
			$provincia = $prov;
		else if (!empty($loc) && empty($prov))
			$provincia = $loc;
	    $this->Cell(70,6,$this->cliente->getCodPostal() . " " . $provincia,'',0);
	    $this->Cell(25,6,'Tel:','',0);
	    $this->Cell(35,6,$this->cliente->getTelefono(),'R',0);
	    $this->Ln(6);
	    
	    $this->Cell(20,6,'','LR',0);
	    $this->Cell(40,6,'Persona Contacto:','',0,'R');
	    $this->Cell(70,6,$this->contacto->getNombre(),'',0);
	    $this->Cell(25,6,'Fax:','',0);
	    $this->Cell(35,6,$this->cliente->getFax(),'R',0);
	    $this->Ln(6);
	    
	    $this->Cell(20,6,'','LR',0);
	    $this->Cell(40,6,'Dirección Envío:','',0,'R');
		$y = $this->GetY();
	    $this->Cell(70,6,$this->dirEnvio->getNombre(),'',0);
		$this->Ln(5);
		$this->Cell(20,4,'','LR',0);
		$this->SetX(70);
		$this->Cell(70,4,$this->dirEnvio->getDireccion1(),'',0);
		$this->Ln(4);
		$this->Cell(20,4,'','LR',0);
		$this->SetX(70);
		$this->Cell(70,4,$this->dirEnvio->getDireccion2(),'',0);
		$this->Ln(4);
		$this->Cell(20,5,'','LR',0);
		$this->SetX(70);
		$loc = $this->dirEnvio->getLocalidad();
		$prov = $this->dirEnvio->getProvincia();
		$provincia = "";
		if (!empty($loc) && !empty($prov))
			$provincia = $loc . ", " . $prov;
		else if (empty($loc) && !empty($prov))
			$provincia = $prov;
		else if (!empty($loc) && empty($prov))
			$provincia = $loc;
		$this->Cell(70,4,$provincia,'',0);
		$this->Ln(1);
		$this->Cell(140,4,'','B',0);
		$this->setXY(140,$y);
	    $this->Cell(25,6,'e-mail:','',0);
	    $this->Cell(35,6,$this->cliente->getEmail(),'R',0);
	    $this->Ln(6);
		$this->setX(140);
		$this->Cell(25,6,'Fecha Envío:','',0);
	    $this->Cell(35,6,myToDate($this->pedido->getFechaEnvio()),'R',0);
	    $this->Ln(6);
		$this->setX(140);
		$this->Cell(25,6,'Portes:','B',0);
	    $this->Cell(35,6,$this->pedido->getPortes(),'BR',0);
	    $this->Ln(6);  
	    
	    $this->SetFont('Arial','B',10);
	    $this->Cell(20,5,' Ref.','LB',0);
	    $this->Cell(75,5,' MATERIAL','LB',0);
	    $this->Cell(10,5,'Uds.','LB',0);
	    $this->Cell(20,5,'P.Venta','LB',0,'R');
	    $this->Cell(20,5,'Total ','B',0,'R');
	    $this->Cell(20,5,'P.Coste','LB',0,'R');
	    $this->Cell(25,5,'Total ','BR',0,'R');
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
        	//$porcentaje_transporte = $this->pedido->getPorcentajeTransporte();
			$porcentaje_agente = $this->pedido->getPorcentajeAgente();
			//$importe_transporte = ($porcentaje_transporte / 100);
			
			$total_venta = $this->sum_venta;
			$total_coste = $this->sum_coste;			

			$importe_agente = $total_venta * ($porcentaje_agente / 100);
			$total_coste = $total_coste + ($importe_transporte * $total_venta);
			$margen = (100 * (1 - (($total_coste + $importe_agente) / $total_venta)));			 
			
			$total_coste = number_format($total_coste,1,',','.');
			$total_venta = number_format($total_venta,1,',','.');

			$margen = number_format($margen,1,',','.') . "% ";
			$porcentaje_transporte = (empty($porcentaje_transporte)) ? "" : $porcentaje_transporte . "% ";
			$importe_transporte = (empty($importe_transporte)) ? "" : number_format($importe_transporte,1,',','.'); 
			$importe_agente = (empty($importe_agente)) ? "" : number_format($importe_agente,1,',','.');
			
			$agente = $this->pedido->getAgente();
			list($forma_pago1,$forma_pago2) = explode("@",$this->pedido->getFormaPago());
			$requerimientos = str_replace("1","x",$this->pedido->getRequerimientos());
	        $requerimientos = str_replace("0","",$requerimientos);
        	$requerimientos = explode("@",$requerimientos);
        }
        
        $this->SetX(10);
        //embalaje y transporte
        $this->Cell(20,6,'','LB',0);
        $this->SetFont('Arial','B',10);
        $this->Cell(75,6,'','BL',0,'R');
        $this->SetFont('Arial','',10);
        $this->Cell(10,6,'','LB',0);
        $this->Cell(20,6,'','BL',0,'R');
        $this->Cell(20,6,'','B',0,'R');
        $this->Cell(20,6,'','BL',0,'R');
        $this->Cell(25,6,'','BR',0,'R');
        $this->Ln();

        //total
        $this->SetFont('Arial','B',11);
        $this->Cell(20,8,'','LB',0);
        $this->Cell(75,8,'TOTAL: ','BLR',0,'R');
        $this->Cell(50,8,$total_venta,'B',0,'R');
        $this->Cell(20,8,'','BL',0,'R');
        $this->Cell(25,8,$total_coste,'BR',0,'R');
        $this->Ln();

        //forma de pago y margen
        $this->SetFont('Arial','B',11);
        $this->Cell(20,8,'','L',0);
        $this->Cell(75,8,'FORMA DE PAGO: ','BL',0,'R');
		$this->SetFont('Arial','',9);
		$fpX = $this->getX();
		$fpY = $this->getY();
        
		if (empty($forma_pago2))
		{
			$this->Cell(50,8,$forma_pago1,'LB',0);
		}
		else
		{
			$this->Cell(50,4,$forma_pago1,'L',0);
			$this->Ln(4);
			$this->setX(105);
			$this->Cell(50,4,$forma_pago2,'LB',0);		
			$this->setY($fpY);
		}

		$this->setX(155);
		$this->SetFont('Arial','B',11);
        $this->Cell(45,8,'Margen: ' . $margen,'BLR',0,'C');
        $this->Ln();

        //pedidos a proveedores
        $this->SetFont('Arial','B',10);
        $this->Cell(20,5,'','L',0);
        $this->Cell(75,5,'PEDIDO a: ','BL',0,'C');
        $this->Cell(17,5,'nº','LB',0,'C');
        $this->Cell(18,5,'Fecha','B',0,'C');
        $this->Cell(15,5,'Importe','B',0,'C');
        $this->Cell(45,5,'Fecha Entrega','BLR',0,'C');
        $this->Ln();

        if ($this->PageNo() == $this->num_paginas)
        {        	
			for ($i=0;$i<count($this->aProveedores);$i++)
	        {
	            $this->SetFont('Arial','',8);
	            $this->Cell(20,5,'','L',0);
	            $this->Cell(75,5,$this->aProveedores[$i]['empresa'],'L',0);
	            $this->Cell(17,5,$this->aProveedores[$i]['numero'],'L',0);
	            $this->Cell(18,5,myToDate($this->aProveedores[$i]['fecha']),'',0,'R');
	            $this->Cell(15,5,number_format($this->aProveedores[$i]['importe'],1,',','.'),'',0,'R');
	            $this->Cell(45,5,myToDate($this->aProveedores[$i]['fecha_entrega']),'LR',0,'C');
	            $this->Ln();
	        }
		}
		else
		{
			$alto = count($this->aProveedores) * 5;
            $this->Cell(20,$alto,'','L',0);
            $this->Cell(75,$alto,'','L',0);
            $this->Cell(16,$alto,'','L',0);
            $this->Cell(17,$alto,'','',0);
            $this->Cell(17,$alto,'','',0);
            $this->Cell(45,$alto,'','LR',0);
            $this->Ln();
		}

        $alto = 247 - $this->getY();
        $this->Cell(20,$alto,'','L',0);
        $this->Cell(75,$alto,'','L',0);
        $this->Cell(16,$alto,'','L',0);
        $this->Cell(17,$alto,'','',0);
        $this->Cell(17,$alto,'','',0);
        $this->Cell(45,$alto,'','LR',0,'C');
        $this->Ln();

        //varios
        $this->SetFont('Arial','B',10);
        $this->Cell(20,5,'','L',0);
        $this->Cell(75,5,'VARIOS','TBL',0,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(50,5,'IMPORTE','TLB',0,'C');
        $this->Cell(45,5,'a:','TLRB',0,'C');
        $this->Ln();
        $this->Cell(20,5,'','L',0);
        $this->Cell(75,5,'AGENTE ','BL',0,'R');
        $this->Cell(50,5,$importe_agente,'LB',0,'C');
        $this->Cell(45,5,$agente,'LRB',0,'C');
        $this->Ln();

        //requerimientos        
        $this->SetFont('Arial','B',8);
        $this->Cell(20,5,'','LR',0);
        $this->Cell(3,5,'','',0);
        $this->Cell(167,5,'REQUERIMIENTOS EXIGIDOS:','R',0);
        $this->Ln();
        $this->SetFont('Arial','',6);
        $this->Cell(20,4,'','LR',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[0],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(48,4,'Descripción del material','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[14],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(70,4,'Otros específicos del pedido','',0);        
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[9],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(43,4,'Placas de identificación','R',0);
        $this->Ln();
        $this->Cell(20,4,'','LR',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[2],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(48,4,'Expediente de Calidad','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[16],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(70,4,'Planos de Ejecución o Generales de implantación','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[11],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(43,4,'Tipo de embalaje','R',0);
        $this->Ln();
        $this->Cell(20,4,'','LR',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[4],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(48,4,'Estándar: (s/EN 10 204)','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[18],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(70,4,'Especificaciones, Libros o Instrucciones de montaje, ajuste y equilibrado','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[13],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(43,4,'Dirección de envío','R',0);
        $this->Ln();
        $this->Cell(20,4,'','LR',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[6],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(48,4,'Testificación de Conformidad con el pedido "2.1"','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[1],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(70,4,'Especificación Técnica (suministro)','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[15],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(43,4,'Transportista','R',0);
        $this->Ln();
        $this->Cell(20,4,'','LR',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[8],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(48,4,'Testificación de Inspección "2.2"','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[3],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(70,4,'Estándar','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[17],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(43,4,'Albarán de envío','R',0);
        $this->Ln();
        $this->Cell(20,4,'','LR',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[10],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(48,4,'Otros: (si se requieren)','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[5],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(70,4,'Excepcionales a la estándar, si las hubiera','',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[19],'',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(43,4,'Persona de contacto y teléfono, si lo hubiera','R',0);
        $this->Ln();
        $this->Cell(20,4,'','LBR',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[12],'B',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(48,4,'Certificado de Materiales','B',0);
        $this->SetTextColor(0,0,0);
        $this->Cell(3,4,$requerimientos[7],'B',0,'C');
        $this->SetTextColor(255,0,0);
        $this->Cell(70,4,'Especificación de envío','B',0);
        $this->Cell(46,4,'','BR',0);
        $this->Ln(4);
        $this->Cell(20,4);
        $this->SetFont('Arial','B',6);
        $this->SetTextColor(0,0,0);
        $this->Cell(170,4,'PGC11-F02-' . $this->revision,'',0,'R');
    }
    
    function LineItems($array_referencias,$array_conceptos,$array_cantidades,$array_precioventa,$array_preciocoste)
    {
        $w=array(20,75,10,20,20,20,25);

        $x = $this->GetX();
        $this->SetFont('Arial','',8);
        
        for($i=0;$i<count($array_conceptos);$i++)
        {    
            if ( ($this->getY() + $this->dameAlto($array_conceptos[$i])) > 195 )
            {
                $alto = 195 - $this->GetY();
                $this->Cell($w[0],$alto,'','L',0);
                $this->Cell($w[1],$alto,'','L',0);
                $this->Cell($w[2],$alto,'','L',0);
                $this->Cell($w[3],$alto,'','L',0,'R');
                $this->Cell($w[4],$alto,'','',0,'R');
                $this->Cell($w[5],$alto,'','L',0,'R');
                $this->Cell($w[6],$alto,'','R',0,'R');
                $this->AddPage();
            }
            
            $this->Cell($w[0], 5, $array_referencias[$i], 'LR');           
            
            $y1 = $this->GetY();
            $this->MultiCell($w[1], 4, $array_conceptos[$i], 'LR');    
            $y2 = $this->GetY();
            $yH = $y2 - $y1 +2;
            
            $this->SetY($y1);
            $this->SetX($x + 95);
            $this->Cell($w[2], 5, $array_cantidades[$i], 'LR', 0, 'R');                      
            
            $tot_coste = $array_preciocoste[$i] * $array_cantidades[$i];
            $tot_venta = $array_precioventa[$i] * $array_cantidades[$i];
            $this->Cell($w[3], 5, number_format($array_precioventa[$i], 1,',','.'), '', 0, 'R');
            $this->Cell($w[4], 5, number_format($tot_venta, 1,',','.'), 'R', 0, 'R');
            $this->Cell($w[5], 5, number_format($array_preciocoste[$i], 1,',','.'), '', 0, 'R');
            $this->Cell($w[6], 5, number_format($tot_coste, 1,',','.'), 'R', 0, 'R');
            $this->sum_coste += $tot_coste;
            $this->sum_venta += $tot_venta;
                        
            //relleno de las lineas
            $this->Ln();
            $this->SetX($x);                    
            $this->Cell($w[0], $yH, '', 'LR');
            $this->SetX($x + 95);
            $this->Cell($w[2], $yH, '', 'LR');    
            $this->Cell($w[3], $yH, '', '');    
            $this->Cell($w[4], $yH, '', 'R');    
            $this->Cell($w[5], $yH, '', '');    
            $this->Cell($w[6], $yH, '', 'R');    
            $this->Ln();            
            $this->SetX($x);            
        }
        
        if ($this->PageNo() == $this->num_paginas)
        {           
            $alto = 195 - $this->GetY();
            $this->Cell($w[0],$alto,'','L',0);
            $this->Cell($w[1],$alto,'','L',0);
            $this->Cell($w[2],$alto,'','L',0);
            $this->Cell($w[3],$alto,'','L',0,'R');
            $this->Cell($w[4],$alto,'','',0,'R');
            $this->Cell($w[5],$alto,'','L',0,'R');
            $this->Cell($w[6],$alto,'','R',0,'R');
            $this->Ln();
        }
    } 
}

$pdf=new PDF();

$pdf->pedido = new Pedido($_GET['id_pedido']);
$pdf->cliente = new Cliente($pdf->pedido->getIdCliente());
$pdf->dirEnvio = new ClienteDireccionEnvio($pdf->pedido->getIdClienteDireccionEnvio());
$pdf->contacto = new ClienteContactos($pdf->pedido->getIdClienteContacto());

$proveedores = new PedidoProveedores();
$pdf->aProveedores = $proveedores->getProveedores($_GET['id_pedido']);

$revision = new Revision();
$pdf->revision = $revision->getRevisionByDate($pdf->pedido->getFecha(),'pedido');

$equipos = new PedidoEquipos();
$aEquipos = $equipos->getEquipos($_GET['id_pedido']);
for ($i=0;$i<count($aEquipos);$i++)
{
	$aReferencias[] = $aEquipos[$i]['referencia'];
	$aCantidades[] = $aEquipos[$i]['cantidad'];
	$aConceptos[] = $aEquipos[$i]['descripcion'];
	$aPrecioVenta[] = $aEquipos[$i]['precio_venta'];
    $aPrecioCoste[] = $aEquipos[$i]['precio_coste'];
    
	$total_alto += $pdf->dameAlto($aEquipos[$i]['descripcion']);
}

$pdf->num_paginas = ceil((64 + $total_alto) / 174);  //TODO: optimizar
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->LineItems($aReferencias,$aConceptos,$aCantidades,$aPrecioVenta,$aPrecioCoste);
$pdf->Output();
?>