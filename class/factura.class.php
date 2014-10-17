<?php	
	class Factura
	{
		var $id;
        var $id_pedido;
        var $numero;
        var $codigo;
        var $numero_pedido;
        var $numero_albaran;
        var $fecha;
        var $iva;
        var $id_cliente;
        var $id_cliente_direccion_envio;
        var $numero_cuenta;
        var $obra;
        var $porcentaje_retencion;
        var $tipo_retencion;
        var $factura_en_origen;
        var $factura_en_dolares;
        var $factura_sin_iva;
        var $factura_proforma;
        var $es_abono;
        var $su_referencia;
        var $aval;	
        var $forma_pago;
		
		function Factura($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM facturas WHERE id = '" . $id . "'";
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				$this->id = $row['id'];
                $this->id_pedido = $row['id_pedido'];
                $this->numero = $row['numero'];
                $this->numero_pedido = $row['numero_pedido'];
                $this->numero_albaran = $row['numero_albaran'];
                $this->fecha = $row['fecha']; 
                $this->iva = $row['iva']; 
                $this->id_cliente = $row['id_cliente'];
                $this->id_cliente_direccion_envio = $row['id_cliente_direccion_envio'];
                $this->numero_cuenta = $row['numero_cuenta'];
                $this->obra = $row['obra'];
                $this->porcentaje_retencion = $row['porcentaje_retencion'];
                $this->tipo_retencion = $row['tipo_retencion'];
                $this->factura_en_origen = $row['factura_en_origen'];
                $this->factura_en_dolares = $row['factura_en_dolares'];
                $this->factura_sin_iva = $row['factura_sin_iva'];
                $this->factura_proforma = $row['factura_proforma'];
                $this->es_abono = $row['es_abono'];
                $this->su_referencia = $row['su_referencia'];
				$this->codigo = $row['codigo'];
                $this->aval = $row['aval'];
                $this->forma_pago = $row['forma_pago'];
			}
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getIdPedido()
        {
            return $this->id_pedido;
        }
        
        function getNumero()
        {
            return $this->numero;
        }
        
        function getNumeroPedido()
        {
            return $this->numero_pedido;
        }
        
        function getNumeroAlbaran()
        {
            return $this->numero_albaran;
        }
        
        function getIVA()
        {
            return $this->iva;
        }
        
        function getFecha()
        {
            return $this->fecha;
        }
        
        function getIdCliente()
		{
			return $this->id_cliente;
		}
        
        function getIdClienteDireccionEnvio()
        {
            return $this->id_cliente_direccion_envio;
        }
        
        function getNumeroCuenta()
        {
            return $this->numero_cuenta;
        }
		
        function getObra()
        {
            return $this->obra;
        }
		
		function getPorcentajeRetencion()
        {
            return $this->porcentaje_retencion;
        }
		
		function getTipoRetencion()
        {
            return $this->tipo_retencion;
        }
        
		function getFacturaEnOrigen()
        {
            return $this->factura_en_origen;
        }
		
        function getFacturaEnDolares()
        {
            return $this->factura_en_dolares;
        }
        
        function getFacturaSinIVA()
        {
            return $this->factura_sin_iva;
        }
        
        function getFacturaProforma()
        {
            return $this->factura_proforma;
        }
        
        function getEsAbono()
        {
            return $this->es_abono;
        }
        
        function getSuReferencia()
        {
            return $this->su_referencia;
        }
		
		function getCodigo()
        {
            return $this->codigo;
        }
        
        function getAval()
        {
            return $this->aval;
        }

        function getFormaPago()
        {
            return $this->forma_pago;
        }
		
		function getListado($tipo,$valor,$esFactura)
		{
			if ($tipo == "numero")
				$sql = "SELECT id,numero,codigo,numero_pedido,fecha,obra,factura_proforma,id_cliente FROM facturas WHERE numero LIKE '" . $valor . "'";
			else if ($tipo == "numero_pedido")
				$sql = "SELECT id,numero,codigo,numero_pedido,fecha,obra,factura_proforma,id_cliente FROM facturas WHERE numero_pedido LIKE '%" . $valor . "%'";
			else
				$sql = "SELECT id,numero,codigo,numero_pedido,fecha,obra,factura_proforma,id_cliente FROM facturas WHERE fecha >= '" . $valor[0] . "' AND fecha <= '" . $valor[1] . "'";

			if ($esFactura == "1")
			{
				$sql .= " AND es_abono = 0";
			}
			else
			{
				$sql .= " AND es_abono = 1";
			}
			
			$res = mysql_query($sql);
			$aFactura = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$total = 0;
				$sql = "SELECT * FROM facturas_equipos WHERE id_factura = '" . $row['id'] . "'";
				$resE = mysql_query($sql);
				while ($rowE = mysql_fetch_array($resE))
				{
					$tot = $rowE['cantidad'] * $rowE['precio'];
					$total += $tot;
				}
				$aFactura[$i]['id'] = $row['id'];
				$aFactura[$i]['numero'] = $row['numero'] . "/" . $row['codigo'];
				$aFactura[$i]['fecha'] = $row['fecha'];
				$aFactura[$i]['obra'] = $row['obra'];
				if ($esFactura == "1")
				{
					$aFactura[$i]['numero_pedido'] = $row['numero_pedido'];
					$aFactura[$i]['factura_proforma'] = $row['factura_proforma'];
					$aFactura[$i]['total'] = $total;
				}

				$aFactura[$i]['id_cliente'] = $row['id_cliente'];
				$i++;
			}
			return $aFactura;
		}
		
		function dameNumero($tipo,$proforma)
		{
			if ($tipo == "abono")
				$sql = "SELECT MAX(CONVERT(numero,SIGNED)) FROM facturas WHERE codigo = '" . date("y") . "' AND es_abono = 1";
			else
				$sql = "SELECT MAX(CONVERT(numero,SIGNED)) FROM facturas WHERE codigo = '" . date("y") . "' AND es_abono = 0 AND factura_proforma = " . $proforma;
			$res = mysql_query($sql);
			
			list($numero) = mysql_fetch_row($res);
			
			if (strpos($numero,"AB") === false)
			{
				$valor = intval($numero);
				$valor++;
				$abono = "";
			}
			else
			{
				$abono = substr($numero,0,2);
				$valor = substr($numero,2,strlen($numero)-2);
				$valor = intval($valor);
				$valor++;
				$valor = str_pad($valor,3,"0",STR_PAD_LEFT);
			}
				
			return $abono . $valor;
		}
        

        function setId($valor)
        {
            $this->id = $valor;
        }
        
        function setIdPedido($valor)
        {
            $this->id_pedido = $valor;
        }
        
        function setNumero($valor)
        {
            $this->numero = $valor;
        }
        
        function setNumeroPedido($valor)
        {
            $this->numero_pedido = $valor;
        }
        
        function setNumeroAlbaran($valor)
        {
            $this->numero_albaran = $valor;
        }
        
        function setIVA($valor)
        {
            $this->iva = $valor;
        }
        
        function setFecha($valor)
        {
            $this->fecha = $valor;
        }
        
        function setIdCliente($valor)
        {
            $this->id_cliente = $valor;
        }
        
        function setIdClienteDireccionEnvio($valor)
        {
            $this->id_cliente_direccion_envio = $valor;
        }
        
        function setNumeroCuenta($valor)
        {
            $this->numero_cuenta = $valor;
        }
        
        function setObra($valor)
        {
            $this->obra = $valor;
        }
        
        function setPorcentajeRetencion($valor)
        {
            $this->porcentaje_retencion = $valor;
        }
        
        function setTipoRetencion($valor)
        {
            $this->tipo_retencion = $valor;
        }
        
        function setFacturaEnOrigen($valor)
        {
            $this->factura_en_origen = $valor;
        }
        
        function setFacturaEnDolares($valor)
        {
            $this->factura_en_dolares = $valor;
        }
        
        function setFacturaSinIVA($valor)
        {
            $this->factura_sin_iva = $valor;
        }
        
        function setFacturaProforma($valor)
        {
            $this->factura_proforma = $valor;
        }
        
        function setEsAbono($valor)
        {
            $this->es_abono = $valor;
        }
        
        function setSuReferencia($valor)
        {
            $this->su_referencia = $valor;
        }
		
		function setCodigo($valor)
        {
            $this->codigo = $valor;
        }
        
        function setAval($valor)
        {
            $this->aval = $valor;
        }
		
        function setFormaPago($valor)
        {
            $this->forma_pago = $valor;
        }

        function add()
		{
			$sql = "INSERT INTO facturas (id_pedido, numero, numero_pedido, numero_albaran, fecha, iva, id_cliente, id_cliente_direccion_envio, numero_cuenta, obra, porcentaje_retencion, tipo_retencion, factura_en_origen, factura_en_dolares, factura_sin_iva, factura_proforma, es_abono, su_referencia, codigo, aval, forma_pago) VALUES ('" . $this->id_pedido . "', '" . $this->numero . "','" . $this->numero_pedido . "', '" . $this->numero_albaran . "', '" . $this->fecha . "', '" . $this->iva . "', '" . $this->id_cliente . "', '" . $this->id_cliente_direccion_envio . "', '" . $this->numero_cuenta . "', '" . $this->obra . "', '" . $this->porcentaje_retencion . "', '" . $this->tipo_retencion . "', '" . $this->factura_en_origen . "', '" . $this->factura_en_dolares . "', '" . $this->factura_sin_iva . "', '" . $this->factura_proforma . "', '" . $this->es_abono . "', '" . $this->su_referencia . "', '" . $this->codigo . "', '" . $this->aval . "', '" . $this->forma_pago . "')";
			mysql_query($sql);
			
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE facturas SET id_pedido = '" . $this->id_pedido . "', numero = '" . $this->numero . "', numero_albaran = '" . $this->numero_albaran . "', numero_pedido = '" . $this->numero_pedido . "', fecha = '" . $this->fecha . "', iva = '" . $this->iva . "', id_cliente = '" . $this->id_cliente . "', id_cliente_direccion_envio = '" . $this->id_cliente_direccion_envio . "', numero_cuenta = '" . $this->numero_cuenta . "', obra = '" . $this->obra . "', porcentaje_retencion = '" . $this->porcentaje_retencion . "', tipo_retencion = '" . $this->tipo_retencion . "', factura_en_origen = '" . $this->factura_en_origen . "', factura_en_dolares = '" . $this->factura_en_dolares . "', factura_sin_iva = '" . $this->factura_sin_iva . "', factura_proforma = '" . $this->factura_proforma . "', es_abono = '" . $this->es_abono . "', su_referencia = '" . $this->su_referencia . "', codigo = '" . $this->codigo . "', aval = '" . $this->aval . "', forma_pago = '" . $this->forma_pago . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function delete()
		{
			$sql = "DELETE FROM facturas WHERE id = " .$this->id;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>