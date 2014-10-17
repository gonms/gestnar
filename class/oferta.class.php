<?php	
	class Oferta
	{
		var $id;
		var $numero;
		var $codigo;
		var $departamento;
		var $obra;
		var $fecha_recepcion;
		var $condiciones_pago;
		var $plazo_entrega;
		var $embalaje;
		var $fecha_envio;
		var $mercancia_franco;
		var $validez_oferta;
		var $tipo;
		var $situacion;
		/*var $descuento;*/
		var $iva;
		var $id_cliente;
		var $id_contacto;
		var $extra;
		var $tipo_oferta;
		var $num_paginas;
		
		function Oferta($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM ofertas WHERE id = '" . $id . "'";
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				$this->id = $row['id'];
				$this->numero = $row['numero'];
				$this->codigo = $row['codigo'];
				$this->departamento = $row['departamento'];
				$this->obra = $row['obra']; 
				$this->fecha_recepcion = $row['fecha_recepcion']; 
				$this->condiciones_pago = $row['condiciones_pago']; 
				$this->plazo_entrega = $row['plazo_entrega']; 
				$this->embalaje = $row['embalaje']; 
				$this->fecha_envio = $row['fecha_envio']; 
				$this->mercancia_franco = $row['mercancia_franco']; 
				$this->validez_oferta = $row['validez_oferta']; 
				$this->tipo = $row['tipo'];
				$this->situacion = $row['situacion'];
				/*$this->descuento = $row['descuento'];*/
				$this->iva = $row['iva'];
				$this->id_cliente = $row['id_cliente'];
				$this->id_contacto = $row['id_contacto'];
				$this->extra = $row['extra'];
				$this->tipo_oferta = $row['tipo_oferta'];
				$this->num_paginas = $row['num_paginas'];
			}
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getNumero()
		{
			return $this->numero;
		}
		
		function getNumeroOferta()
		{
			$result = $this->getCodigo();
			$departamento = $this->getDepartamento();
			if (!empty($departamento))
			{
				$result .= "-" . $departamento;
			}
			$result .= "-" . $this->getNumero();
			
			$extra = $this->getExtra();
			if (!empty($extra))
			{
				$result .= "-" . $extra;
			}
			
			return $result;
		}
		
		function getCodigo()
		{
			return $this->codigo;
		}
		
		function getDepartamento()
		{
			return $this->departamento;
		}
		
		function getObra()
		{
			return $this->obra;
		}
		
		function getFechaRecepcion()
		{
			return $this->fecha_recepcion;
		}
		
		function getCondicionesPago()
		{
			return $this->condiciones_pago;
		}
		
		function getPlazoEntrega()
		{
			return $this->plazo_entrega;
		}
		
		function getEmbalaje()
		{
			return $this->embalaje;
		}
		
		function getFechaEnvio()
		{
			return $this->fecha_envio;
		}
		
		function getMercanciaFranco()
		{
			return $this->mercancia_franco;
		}
		
		function getValidezOferta()
		{
			return $this->validez_oferta;
		}
		
		function getTipo()
		{
			return $this->tipo;
		}
		
		function getSituacion()
		{
			return $this->situacion;
		}
		
		/*
		function getDescuento()
		{
			return $this->descuento;
		}
		*/
		
		function getIVA()
		{
			return $this->iva;
		}
		
		function getIdCliente()
		{
			return $this->id_cliente;
		}
		
		function getIdContacto()
		{
			return $this->id_contacto;
		}
		
		function getExtra()
		{
			return $this->extra;
		}
		
		function getTipoOferta()
		{
			return $this->tipo_oferta;
		}
		
		function getNumPaginas()
		{
			return $this->num_paginas;
		}
		
		function getListado($tipo,$valor)
		{
			if ($tipo == "numero")
				$sql = "SELECT * FROM ofertas WHERE numero LIKE '" . $valor . "'";
			else
				$sql = "SELECT * FROM ofertas WHERE fecha_recepcion >= '" . $valor[0] . "' AND fecha_recepcion <= '" . $valor[1] . "'";
			$res = mysql_query($sql);
			$aOferta = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$aOferta[$i]['id'] = $row['id'];
				$aOferta[$i]['codigo'] = $row['codigo'];
				$aOferta[$i]['numero'] = $row['numero'];
				$aOferta[$i]['extra'] = $row['extra'];
				$aOferta[$i]['obra'] = $row['obra'];
				$aOferta[$i]['fecha'] = $row['fecha_recepcion'];
				$i++;
			}
			return $aOferta;
		}
		
		function getRevision($numero,$codigo,$tipo,$extra = "")
		{
			//$sql = "SELECT MAX(extra) as extra FROM ofertas WHERE numero = '" . $numero . "' and codigo = '" . $codigo . "' and tipo_oferta = '" . $tipo . "'";
			//$sql = "SELECT MAX(extra) as extra FROM ofertas WHERE numero = '" . $numero . "' and tipo_oferta = '" . $tipo . "'";			
			if ($extra == "letras")
				$sql = "SELECT extra as extra FROM ofertas WHERE numero = '" . $numero . "' and tipo_oferta = '" . $tipo . "' ORDER BY LENGTH(extra) DESC, extra DESC LIMIT 1";
			else if (!empty($extra))
				$sql = "SELECT MAX(extra) as extra FROM ofertas WHERE numero = '" . $numero . "' and tipo_oferta = '" . $tipo . "' AND extra LIKE '" . $extra . "%'";
			else
                $sql = "SELECT MAX(extra) as extra FROM ofertas WHERE numero = '" . $numero . "' and tipo_oferta = '" . $tipo . "'";
			$res = mysql_query($sql);
			list($valor) = mysql_fetch_row($res);
			
			return $valor;
		}
		
		
		function setId($valor)
		{
			$this->id = $valor;
		}
		
		function setNumero($valor)
		{
			$this->numero = $valor;
		}
		
		function setCodigo($valor)
		{
			$this->codigo = $valor;
		}
		
		function setDepartamento($valor)
		{
			$this->departamento = $valor;
		}
		
		function setObra($valor)
		{
			$this->obra = $valor;
		}
		
		function setFechaRecepcion($valor)
		{
			$this->fecha_recepcion = $valor;
		}
		
		function setCondicionesPago($valor)
		{
			$this->condiciones_pago = $valor;
		}
		
		function setPlazoEntrega($valor)
		{
			$this->plazo_entrega = $valor;
		}
		
		function setEmbalaje($valor)
		{
			$this->embalaje = $valor;
		}
		
		function setFechaEnvio($valor)
		{
			$this->fecha_envio = $valor;
		}
		
		function setMercanciaFranco($valor)
		{
			$this->mercancia_franco = $valor;
		}
		
		function setValidezOferta($valor)
		{
			$this->validez_oferta = $valor;
		}
		
		function setTipo($valor)
		{
			$this->tipo = $valor;
		}
		
		function setSituacion($valor)
		{
			$this->situacion = $valor;
		}
		
		/*
		function setDescuento($valor)
		{
			$this->descuento = $valor;
		}
		*/
		
		function setIVA($valor)
		{
			$this->iva = $valor;
		}
		
		function setIdCliente($valor)
		{
			$this->id_cliente = $valor;
		}
		
		function setIdContacto($valor)
		{
			$this->id_contacto = $valor;
		}
		
		function setExtra($valor)
		{
			$this->extra = $valor;
		}
		
		function setTipoOferta($valor)
		{
			$this->tipo_oferta = $valor;
		}
		
		function setNumPaginas($numero)
		{
			$sql = "UPDATE ofertas SET num_paginas = '" . $numero . "' WHERE id = '" . $this->id . "';";
			mysql_query($sql);
		}
		
		function add()
		{
			$sql = "INSERT INTO ofertas (numero, codigo, departamento, obra, fecha_recepcion, condiciones_pago, plazo_entrega, embalaje, fecha_envio, mercancia_franco, validez_oferta, tipo, situacion, iva, id_cliente, id_contacto,extra,tipo_oferta) VALUES ('" . $this->numero . "', '" . $this->codigo . "', '" . $this->departamento . "', '" . $this->obra . "', '" . $this->fecha_recepcion . "', '" . $this->condiciones_pago . "', '" . $this->plazo_entrega . "', '" . $this->embalaje . "', '" . $this->fecha_envio . "', '" . $this->mercancia_franco . "', '" . $this->validez_oferta . "', '" . $this->tipo . "', '" . $this->situacion . "', '" . $this->iva . "', '" . $this->id_cliente . "', '" . $this->id_contacto . "', '" . $this->extra . "', '" . $this->tipo_oferta . "')";
			mysql_query($sql);
			
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE ofertas SET numero = '" . $this->numero . "', codigo = '" . $this->codigo . "', departamento = '" . $this->departamento . "', obra = '" . $this->obra . "', fecha_recepcion = '" . $this->fecha_recepcion . "', condiciones_pago = '" . $this->condiciones_pago . "', plazo_entrega = '" . $this->plazo_entrega . "', embalaje = '" . $this->embalaje . "', fecha_envio = '" . $this->fecha_envio . "', mercancia_franco = '" . $this->mercancia_franco . "', validez_oferta = '" . $this->validez_oferta . "', tipo = '" . $this->tipo . "', situacion = '" . $this->situacion . "', iva = '" . $this->iva . "', id_cliente = '" . $this->id_cliente . "', id_contacto = '" . $this->id_contacto . "', extra = '" . $this->extra . "', tipo_oferta = '" . $this->tipo_oferta . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function delete()
		{
			$sql = "DELETE FROM ofertas WHERE id = " .$this->id;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>