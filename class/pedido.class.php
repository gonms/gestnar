<?php	
	class Pedido
	{
		var $id;
        var $id_oferta;
		var $numero;
		var $codigo;
		var $revision;
		var $fecha;
		var $forma_pago;
		var $porcentaje_agente;
		var $agente;
		var $requerimientos;
		var $id_cliente;
		var $id_cliente_direccion_envio;
		var $id_cliente_contacto;
        var $fecha_envio;
        var $su_referencia;
        var $de_fecha;
        var $portes;
		
		function Pedido($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM pedidos WHERE id = '" . $id . "'";
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				$this->id = $row['id'];
                $this->id_oferta = $row['id_oferta'];
				$this->numero = $row['numero'];
				$this->codigo = $row['codigo'];
				$this->revision = $row['revision'];
				$this->fecha = $row['fecha']; 
				$this->forma_pago = $row['forma_pago']; 
				$this->porcentaje_agente = $row['porcentaje_agente']; 
				$this->agente = $row['agente']; 
				$this->requerimientos = $row['requerimientos']; 
				$this->id_cliente = $row['id_cliente']; 
				$this->id_cliente_direccion_envio = $row['id_cliente_direccion_envio']; 
				$this->id_cliente_contacto = $row['id_cliente_contacto']; 
                $this->fecha_envio = $row['fecha_envio']; 
                $this->su_referencia = $row['su_referencia']; 
                $this->de_fecha = $row['de_fecha']; 
                $this->portes = $row['portes']; 
			}
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getIdOferta()
        {
            return $this->id_oferta;
        }
        
        function getNumero()
		{
			return $this->numero;
		}
		
		function getNumeroPedido()
		{
			$result = $this->getCodigo() . "-" . $this->getNumero();
			$revision = $this->getRevision();
			if (!empty($revision)) $result .= "-" . $revision;
			
			return $result;
		}
		
		function getCodigo()
		{
			return $this->codigo;
		}
		
		function getRevision()
		{
			return $this->revision;
		}
		
		function getFecha()
		{
			return $this->fecha;
		}
		
		function getFormaPago()
		{
			return $this->forma_pago;
		}
		
		function getPorcentajeAgente()
		{
			return $this->porcentaje_agente;
		}
		
		function getAgente()
		{
			return $this->agente;
		}
		
		function getRequerimientos()
		{
			return $this->requerimientos;
		}
		
		function getIdCliente()
		{
			return $this->id_cliente;
		}
		
		function getIdClienteDireccionEnvio()
		{
			return $this->id_cliente_direccion_envio;
		}
		
		function getIdClienteContacto()
		{
			return $this->id_cliente_contacto;
		}
        
        function getFechaEnvio()
        {
            return $this->fecha_envio;
        }
        
        function getSuReferencia()
        {
            return $this->su_referencia;
        }
        
        function getDeFecha()
		{
            return $this->de_fecha;
        }
        
        function getPortes()
        {
            return $this->portes;
        }
		
		function getListado($tipo,$valor)
		{
			if ($tipo == "numero")
				$sql = "SELECT id,codigo,numero,revision,fecha,id_oferta FROM pedidos WHERE numero LIKE '" . $valor . "'";
			else
				$sql = "SELECT id,codigo,numero,revision,fecha,id_oferta FROM pedidos WHERE fecha >= '" . $valor[0] . "' AND fecha <= '" . $valor[1] . "'";
			$res = mysql_query($sql);
			$aPedido = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$aPedido[$i]['id'] = $row['id'];
				$numero = $row['codigo'] . "-" . $row['numero'];
				if (!empty($row['revision'])) $numero .= "-" . $row['revision'];
				$aPedido[$i]['numero'] = $numero;
				$aPedido[$i]['id_oferta'] = $row['id_oferta'];
				$aPedido[$i]['fecha'] = $row['fecha'];
				$i++;
			}
			return $aPedido;
		}
		
		
		
		function setId($valor)
		{
			$this->id = $valor;
		}
        
        function setIdOferta($valor)
        {
            $this->id_oferta = $valor;
        }
		
		function setNumero($valor)
		{
			$this->numero = $valor;
		}
		
		function setCodigo($valor)
		{
			$this->codigo = $valor;
		}
		
		function setRevision($valor)
		{
			$this->revision = $valor;
		}
		
		function setFecha($valor)
		{
			$this->fecha = $valor;
		}
		
		function setFormaPago($valor)
		{
			$this->forma_pago = $valor;
		}
		
		function setPorcentajeAgente($valor)
		{
			$this->porcentaje_agente = $valor;
		}
        
        function setAgente($valor)
        {
            $this->agente = $valor;
        }
        
		function setRequerimientos($valor)
		{
			$this->requerimientos = $valor;
		}
		
		function setIdCliente($valor)
		{
			$this->id_cliente = $valor;
		}
		
		function setIdClienteDireccionEnvio($valor)
		{
			$this->id_cliente_direccion_envio = $valor;
		}
		
		function setIdClienteContacto($valor)
		{
			$this->id_cliente_contacto = $valor;
		}
        
        function setFechaEnvio($valor)
        {
            $this->fecha_envio = $valor;
        }
        
        function setSuReferencia($valor)
        {
            $this->su_referencia = $valor;
        }
        
        function setDeFecha($valor)
        {
            $this->de_fecha = $valor;
        }
        
        function setPortes($valor)
        {
            $this->portes = $valor;
        }
		
		
		function add()
		{
			$sql = "INSERT INTO pedidos (id_oferta, numero, codigo, revision, fecha, forma_pago, porcentaje_agente, agente, requerimientos, id_cliente, id_cliente_direccion_envio, id_cliente_contacto, fecha_envio, su_referencia, de_fecha, portes) VALUES ('" . $this->id_oferta . "', '" . $this->numero . "', '" . $this->codigo . "', '" . $this->revision . "', '" . $this->fecha . "', '" . $this->forma_pago . "', '" . $this->porcentaje_agente . "', '" . $this->agente . "', '" . $this->requerimientos . "', '" . $this->id_cliente . "', '" . $this->id_cliente_direccion_envio . "', '" . $this->id_cliente_contacto . "', '" . $this->fecha_envio . "', '" . $this->su_referencia . "', '" . $this->de_fecha . "', '" . $this->portes . "')";
			mysql_query($sql);
			
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE pedidos SET id_oferta = '" . $this->id_oferta . "', numero = '" . $this->numero . "', codigo = '" . $this->codigo . "', revision = '" . $this->revision . "', fecha = '" . $this->fecha . "', forma_pago = '" . $this->forma_pago . "', porcentaje_agente = '" . $this->porcentaje_agente . "', agente = '" . $this->agente . "', requerimientos = '" . $this->requerimientos . "', id_cliente = '" . $this->id_cliente . "', id_cliente_direccion_envio = '" . $this->id_cliente_direccion_envio . "', id_cliente_contacto = '" . $this->id_cliente_contacto . "', fecha_envio = '" . $this->fecha_envio . "', su_referencia = '" . $this->su_referencia . "', de_fecha = '" . $this->de_fecha . "', portes = '" . $this->portes . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function delete()
		{
			$sql = "DELETE FROM pedidos WHERE id = " .$this->id;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>