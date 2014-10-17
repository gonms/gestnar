<?php
	class PedidoProveedores
	{
		var $id;
		var $empresa;
		var $numero;
		var $fecha;
		var $importe;
		var $fecha_entrega;
		var $id_pedido;
		
		function PedidoProveedores()
		{			
		}
		
		function getProveedores($id_pedido)
		{
			if (!empty($id_pedido))
			{				
				$aProveedores = array();
				$i=0;
				$sql = "SELECT * FROM pedidos_proveedores WHERE id_pedido = " . $id_pedido;
				$res = mysql_query($sql);
				while ($row = mysql_fetch_array($res))
				{
					$aProveedores[$i]['id'] = $row['id'];
					$aProveedores[$i]['empresa'] = $row['empresa'];
					$aProveedores[$i]['numero'] = $row['numero'];
					$aProveedores[$i]['fecha'] = $row['fecha'];
					$aProveedores[$i]['importe'] = $row['importe'];
					$aProveedores[$i]['fecha_entrega'] = $row['fecha_entrega'];
					$i++;
				}
				return $aProveedores;
			}
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getEmpresa()
		{
			return $this->empresa;
		}
		
		function getNumero()
		{
			return $this->numero;
		}
		
		function getFecha()
		{
			return $this->fecha;
		}
		
		function getImporte()
		{
			return $this->importe;
		}
		
		function getFechaEntrega()
		{
			return $this->fecha_entrega;
		}
		
		function getIdPedido()
		{
			return $this->id_pedido;
		}
		
		function setId($valor)
		{
			$this->id = $valor;
		}
		
		function setEmpresa($valor)
		{
			$this->empresa = $valor;
		}
		
		function setNumero($valor)
		{
			$this->numero = $valor;
		}
		
		function setFecha($valor)
		{
			$this->fecha = $valor;
		}
		
		function setImporte($valor)
		{
			$this->importe = $valor;
		}
		
		function setFechaEntrega($valor)
		{
			$this->fecha_entrega = $valor;
		}
		
		function setIdPedido($valor)
		{
			$this->id_pedido = $valor;
		}
		
		function delete()
		{
			$sql = "DELETE FROM pedidos_proveedores WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function update()
		{
			$sql = "UPDATE pedidos_proveedores SET empresa = '" . $this->empresa . "', numero = '" . $this->numero . "', fecha = '" . $this->fecha . "', importe = '" . $this->importe . "', fecha_entrega = '" . $this->fecha_entrega . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function add()
		{
			$sql = "INSERT INTO pedidos_proveedores (empresa,numero,fecha,importe,fecha_entrega,id_pedido) VALUES ('" . $this->empresa . "','" . $this->numero . "','" . $this->fecha . "','" . $this->importe . "','" . $this->fecha_entrega . "','" . $this->id_pedido . "')";
			mysql_query($sql);
		}
	}
?>