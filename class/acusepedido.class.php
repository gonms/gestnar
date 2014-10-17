<?php	
	class AcusePedido
	{
		var $id;
        var $id_pedido;
        var $id_cliente;
        var $id_cliente_direccion_envio;
		var $numero;
		var $codigo;
		var $revision;
		var $fecha;
        var $portes;
		var $forma_envio;
		var $forma_pago;
		var $su_referencia;
		var $de_fecha;
		var $fecha_envio;
		
		function AcusePedido($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM acusepedido WHERE id = '" . $id . "'";
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				$this->id = $row['id'];
                $this->id_pedido = $row['id_pedido'];
                $this->id_cliente = $row['id_cliente'];
                $this->id_cliente_direccion_envio = $row['id_cliente_direccion_envio'];
				$this->numero = $row['numero'];
				$this->codigo = $row['codigo'];
				$this->revision = $row['revision'];
				$this->fecha = $row['fecha']; 
                $this->portes = $row['portes']; 
				$this->forma_envio = $row['forma_envio'];
				$this->forma_pago = $row['forma_pago'];
                $this->su_referencia = $row['su_referencia']; 
                $this->de_fecha = $row['de_fecha']; 
                $this->fecha_envio = $row['fecha_envio']; 
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
        
        function getIdCliente()
		{
			return $this->id_cliente;
		}
		
		function getIdClienteDireccionEnvio()
		{
			return $this->id_cliente_direccion_envio;
		}
		        
        function getNumero()
		{
			return $this->numero;
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
        
        function getPortes()
        {
            return $this->portes;
        }
		
		function getFormaEnvio()
		{
			return $this->forma_envio;
		}
		
		function getFormaPago()
		{
			return $this->forma_pago;
		}

        function getSuReferencia()
		{
			return $this->su_referencia;
		}
		
		function getDeFecha()
		{
			return $this->de_fecha;
		}
		
		function getFechaEnvio()
		{
			return $this->fecha_envio;
		}
		
		function getListado($tipo,$valor)
		{
			if ($tipo == "numero")
				$sql = "SELECT id,codigo,numero,revision,fecha,id_pedido FROM acusepedido WHERE numero LIKE '%" . $valor . "%'";
			else
				$sql = "SELECT id,codigo,numero,revision,fecha,id_pedido FROM acusepedido WHERE fecha >= '" . $valor[0] . "' AND fecha <= '" . $valor[1] . "'";
			$res = mysql_query($sql);
			$aAcusePedido = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$aAcusePedido[$i]['id'] = $row['id'];
				$numero = $row['codigo'] . "-" . $row['numero'];
				if (!empty($row['revision'])) $numero .= "-" . $row['revision'];
				$aAcusePedido[$i]['numero'] = $numero;
				$aAcusePedido[$i]['id_pedido'] = $row['id_pedido'];
				$aAcusePedido[$i]['fecha'] = $row['fecha'];
				$i++;
			}
			return $aAcusePedido;
		}
		
		
		
		function setId($valor)
		{
			$this->id = $valor;
		}
        
        function setIdPedido($valor)
        {
            $this->id_pedido = $valor;
        }
        
        function setIdCliente($valor)
		{
			$this->id_cliente = $valor;
		}
		
		function setIdClienteDireccionEnvio($valor)
		{
			$this->id_cliente_direccion_envio = $valor;
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
        
        function setPortes($valor)
        {
            $this->portes = $valor;
        }
		
		function setFormaEnvio($valor)
		{
			$this->forma_envio = $valor;
		}

		function setFormaPago($valor)
		{
			$this->forma_pago = $valor;
		}
		
        function setSuReferencia($valor)
		{
			$this->su_referencia = $valor;
		}
		
		function setDeFecha($valor)
		{
			$this->de_fecha = $valor;
		}
		
		function setFechaEnvio($valor)
		{
			$this->fecha_envio = $valor;
		}
        
		
		
		function add()
		{
			$sql = "INSERT INTO acusepedido (id_pedido, id_cliente, id_cliente_direccion_envio, numero, codigo, revision, fecha, portes, forma_envio, forma_pago, su_referencia, de_fecha, fecha_envio) VALUES ('" . $this->id_pedido . "', '" . $this->id_cliente . "','" . $this->id_cliente_direccion_envio . "','" . $this->numero . "', '" . $this->codigo . "', '" . $this->revision . "', '" . $this->fecha . "', '" . $this->portes . "', '" . $this->forma_envio . "', '" . $this->forma_pago . "', '" . $this->su_referencia . "', '" . $this->de_fecha . "', '" . $this->fecha_envio . "')";
			mysql_query($sql);
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE acusepedido SET id_pedido = '" . $this->id_pedido . "', id_cliente = '" . $this->id_cliente . "', id_cliente_direccion_envio = '" . $this->id_cliente_direccion_envio . "', numero = '" . $this->numero . "', codigo = '" . $this->codigo . "', revision = '" . $this->revision . "', fecha = '" . $this->fecha . "', portes = '" . $this->portes . "', forma_envio = '" . $this->forma_envio . "', forma_pago = '" . $this->forma_pago . "', su_referencia = '" . $this->su_referencia . "', de_fecha = '" . $this->de_fecha . "', fecha_envio = '" . $this->fecha_envio . "' WHERE id = " . $this->id;
            mysql_query($sql);
		}
		
		function delete()
		{
			$sql = "DELETE FROM acusepedido WHERE id = " .$this->id;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>