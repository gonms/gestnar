<?php	
	class Albaran
	{
		var $id;
        var $id_pedido;
		var $numero;
		var $numero_pedido;
		var $fecha;
		var $asunto;
		var $enviado;
		var $tipo;
		var $iva;
		var $destinatario;
		var $contacto;
		
		function Albaran($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM albaranes WHERE id = '" . $id . "'";
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				$this->id = $row['id'];
                $this->id_pedido = $row['id_pedido'];
                $this->numero = $row['numero'];
				$this->numero_pedido = $row['numero_pedido'];
				$this->fecha = $row['fecha']; 
				$this->asunto = $row['asunto'];
				$this->enviado= $row['enviado'];
				$this->tipo = $row['tipo'];
				$this->iva = $row['iva'];
				$this->destinatario = $row['destinatario'];
				$this->contacto = $row['contacto'];
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
		
		function getFecha()
		{
			return $this->fecha;
		}
		
		function getAsunto()
		{
			return $this->asunto;
		}
		
		function getEnviado()
		{
			return $this->enviado;
		}
		
		function getTipo()
		{
			return $this->tipo;
		}
		
		function getIVA()
		{
			return $this->iva;
		}

		function getDestinatario()
		{
			return $this->destinatario;
		}
		
		function getContacto()
		{
			return $this->contacto;
		}
				
		function getListado($tipo,$valor)
		{
			if ($tipo == "numero")
				$sql = "SELECT id,numero,fecha,numero_pedido,destinatario FROM albaranes WHERE numero LIKE '%" . $valor . "%'";
			else if ($tipo == "numero_pedido")
				$sql = "SELECT id,numero,fecha,numero_pedido,destinatario FROM albaranes WHERE numero_pedido LIKE '%" . $valor . "%'";
			else
				$sql = "SELECT id,numero,fecha,numero_pedido,destinatario FROM albaranes WHERE fecha >= '" . $valor[0] . "' AND fecha <= '" . $valor[1] . "'";
			$res = mysql_query($sql);
			$aAlbaran = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$aAlbaran[$i]['id'] = $row['id'];
				$aAlbaran[$i]['numero'] = $row['numero'];
				$aAlbaran[$i]['numero_pedido'] = $row['numero_pedido'];
				$aAlbaran[$i]['fecha'] = $row['fecha'];
				$aAlbaran[$i]['cliente'] = $row['destinatario'];//str_replace("@","<br/>",$row['destinatario']);
				$i++;
			}
			return $aAlbaran;
		}
		
		function getRegistro($tipo,$valor)
		{
			if ($tipo == "fechas")
			{
				list($fInicio,$fFinal) = explode("@",$valor);
				list($d,$m,$a) = explode("-",$fInicio);
				$fInicio = $a . "-" . $m . "-" . $d;
				list($d,$m,$a) = explode("-",$fFinal);
				$fFinal = $a . "-" . $m . "-" . $d;
				$sql = "SELECT id,numero,fecha,numero_pedido,destinatario FROM albaranes WHERE fecha >= '" . $fInicio . "' AND fecha <= '" . $fFinal . "' ORDER BY fecha";
			}
			else if ($tipo == "anio")
				$sql = "SELECT id,numero,fecha,numero_pedido,destinatario FROM albaranes WHERE fecha >= '" . $valor . "-01-01' AND fecha <= '" . $valor . "-12-31' ORDER BY fecha";
			else if ($tipo == "numero_pedido")
				$sql = "SELECT id,numero,fecha,numero_pedido,destinatario FROM albaranes WHERE numero_pedido LIKE '%" . $valor . "%' ORDER BY fecha";
			else if ($tipo == "numero")
				$sql = "SELECT id,numero,fecha,numero_pedido,destinatario FROM albaranes WHERE numero LIKE '%" . $valor . "%' ORDER BY fecha";

			$res = mysql_query($sql);
			$aAlbaran = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$aCliente = explode("@",$row['destinatario']);
				$cliente = $aCliente[0];
				$obra = $aCliente[1];
				$aAlbaran[$i]['id'] = $row['id'];
				$aAlbaran[$i]['numero'] = $row['numero'];
				$aAlbaran[$i]['numero_pedido'] = $row['numero_pedido'];
				$aAlbaran[$i]['fecha'] = $row['fecha'];
				$aAlbaran[$i]['cliente'] = $cliente;
				$aAlbaran[$i]['obra'] = $obra;
				$i++;
			}
			return $aAlbaran;
		}
		
		function getRegistroEquipos($valor)
		{
			list($anio,$fInicio,$fFinal,$numero,$numero_pedido,$equipos) = explode("@",$valor);
			
			if (!empty($anio))
			{
				$fInicio = $anio . "-01-01";
				$fFinal = $anio . "-12-31";
				$sWhere = " AND a.fecha >= '" . $fInicio . "' AND a.fecha <= '" . $fFinal . "'";
			}
			else if (!empty($fInicio))
			{
				list($d,$m,$a) = explode("-",$fInicio);
				$fInicio = $a . "-" . $m . "-" . $d;
				list($d,$m,$a) = explode("-",$fFinal);
				$fFinal = $a . "-" . $m . "-" . $d;
				$sWhere = " AND a.fecha >= '" . $fInicio . "' AND a.fecha <= '" . $fFinal . "'";
			}
			if (!empty($numero))
			{
				$sWhere .= " AND a.numero = '" . $numero . "'";
			}
			if (!empty($numero_pedido))
			{
				$sWhere .= " AND a.numero_pedido = '" . $numero_pedido . "'";
			}
			if (!empty($equipos))
			{
				$aEquipos = explode(" ",$equipos);
                for ($i=0;$i<count($aEquipos);$i++)
                {
                    $sWhere .= " AND ae.descripcion LIKE '%" . $aEquipos[$i] . "%'";
                }
			}
				
			$sql = "SELECT distinct a.id,a.numero,a.fecha,a.numero_pedido,a.destinatario FROM albaranes a INNER JOIN albaranes_equipos ae on a.id = ae.id_albaran WHERE 1 " . $sWhere . " ORDER BY a.fecha";
			$res = mysql_query($sql);
			$aAlbaran = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$aCliente = explode("@",$row['destinatario']);
				$cliente = $aCliente[0];
				$obra = $aCliente[1];
				$aAlbaran[$i]['id'] = $row['id'];
				$aAlbaran[$i]['numero'] = $row['numero'];
				$aAlbaran[$i]['numero_pedido'] = $row['numero_pedido'];
				$aAlbaran[$i]['fecha'] = $row['fecha'];
				$aAlbaran[$i]['cliente'] = $cliente;
				$aAlbaran[$i]['obra'] = $obra;
				$i++;
			}
			return $aAlbaran;
		}
		
		function existeNumero($num)
		{
			$sql = "SELECT numero FROM albaranes WHERE numero = '" . $num . "'";
			$res = mysql_query($sql);
			
			list($numero) = mysql_fetch_row($res);
			
			$res = ($numero > 0)?true:false;
			
			return $res;
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
		
		function setFecha($valor)
		{
			$this->fecha = $valor;
		}
        
		function setAsunto($valor)
		{
			$this->asunto = $valor;
		}
		
		function setEnviado($valor)
		{
			$this->enviado = $valor;
		}
		
		function setTipo($valor)
		{
			$this->tipo = $valor;
		}
		
		function setIVA($valor)
		{
			$this->iva = $valor;
		}

		function setDestinatario($valor)
		{
			$this->destinatario = $valor;
		}
		
		function setContacto($valor)
		{
			$this->contacto = $valor;
		}
		
		function add()
		{
			$sql = "INSERT INTO albaranes (id_pedido, numero, numero_pedido, fecha, asunto, enviado, tipo, iva, destinatario, contacto) VALUES ('" . $this->id_pedido . "', '" . $this->numero . "', '" . $this->numero_pedido . "', '" . $this->fecha . "', '" . $this->asunto . "', '" . $this->enviado . "', '" . $this->tipo . "', '" . $this->iva . "', '" . $this->destinatario . "', '" . $this->contacto . "')";
			mysql_query($sql);
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE albaranes SET id_pedido = '" . $this->id_pedido . "', numero = '" . $this->numero . "', numero_pedido = '" . $this->numero_pedido . "', fecha = '" . $this->fecha . "', asunto = '" . $this->asunto . "', enviado = '" . $this->enviado . "', tipo = '" . $this->tipo . "', iva = '" . $this->iva . "', destinatario = '" . $this->destinatario . "', contacto = '" . $this->contacto . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function delete()
		{
			$sql = "DELETE FROM albaranes WHERE id = " .$this->id;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>