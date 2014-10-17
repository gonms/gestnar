<?php
	class PedidoEquipos
	{
		var $id;
		var $referencia;
		var $descripcion;
		var $cantidad;
		var $precio_venta;
		var $precio_coste;
		var $id_pedido;
		
		function PedidoEquipos()
		{			
		}
		
		function getEquipos($id_pedido)
		{
			if (!empty($id_pedido))
			{				
				$aEquipos = array();
				$i=0;
				$sql = "SELECT * FROM pedidos_equipos WHERE id_pedido = " . $id_pedido . " ORDER BY id";
				$res = mysql_query($sql);
				while ($row = mysql_fetch_array($res))
				{
					$aEquipos[$i]['id'] = $row['id'];
					$aEquipos[$i]['referencia'] = $row['referencia'];
					$aEquipos[$i]['descripcion'] = $row['descripcion'];
					$aEquipos[$i]['cantidad'] = $row['cantidad'];
					$aEquipos[$i]['precio_venta'] = $row['precio_venta'];
					$aEquipos[$i]['precio_coste'] = $row['precio_coste'];
					$i++;
				}
				return $aEquipos;
			}
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getReferencia()
		{
			return $this->referencia;
		}
		
		function getDescripcion()
		{
			return $this->descripcion;
		}
		
		function getCantidad()
		{
			return $this->cantidad;
		}
		
		function getPrecioVenta()
		{
			return $this->precio_venta;
		}
		
		function getPrecioCoste()
		{
			return $this->precio_coste;
		}
		
		function getIdPedido()
		{
			return $this->id_pedido;
		}
		
		function setId($valor)
		{
			$this->id = $valor;
		}
		
		function setReferencia($valor)
		{
			$this->referencia = $valor;
		}
		
		function setDescripcion($valor)
		{
			$this->descripcion = $valor;
		}
		
		function setCantidad($valor)
		{
			$this->cantidad = $valor;
		}
		
		function setPrecioVenta($valor)
		{
			$this->precio_venta = $valor;
		}
		
		function setPrecioCoste($valor)
		{
			$this->precio_coste = $valor;
		}
		
		function setIdPedido($valor)
		{
			$this->id_pedido = $valor;
		}
		
		function delete()
		{
			$sql = "DELETE FROM pedidos_equipos WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function update()
		{
			$sql = "UPDATE pedidos_equipos SET referencia = '" . $this->referencia . "', descripcion = '" . $this->descripcion . "', cantidad = '" . $this->cantidad . "', precio_venta = '" . $this->precio_venta . "', precio_coste = '" . $this->precio_coste . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function add()
		{
			$sql = "INSERT INTO pedidos_equipos (referencia,descripcion,cantidad,precio_venta,precio_coste,id_pedido) VALUES ('" . $this->referencia . "','" . $this->descripcion . "','" . $this->cantidad . "','" . $this->precio_venta . "','" . $this->precio_coste . "','" . $this->id_pedido . "')";
			mysql_query($sql);
		}
		
		function deleteByPedido()
		{
			$sql = "DELETE FROM pedidos_equipos WHERE id_pedido = " .$this->id_pedido;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>