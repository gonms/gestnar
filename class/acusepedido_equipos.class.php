<?php
	class AcusePedidoEquipos
	{
		var $id;
		var $referencia;
		var $descripcion;
		var $cantidad;
		var $precio_venta;
		var $plazo_entrega;
		var $id_acusepedido;
		
		function AcusePedidoEquipos()
		{			
		}
		
		function getEquipos($id_acusepedido)
		{
			if (!empty($id_acusepedido))
			{				
				$aEquipos = array();
				$i=0;
				$sql = "SELECT * FROM acusepedido_equipos WHERE id_acusepedido = " . $id_acusepedido . " ORDER BY id";
				$res = mysql_query($sql);
				while ($row = mysql_fetch_array($res))
				{
					$aEquipos[$i]['id'] = $row['id'];
					$aEquipos[$i]['referencia'] = $row['referencia'];
					$aEquipos[$i]['descripcion'] = $row['descripcion'];
					$aEquipos[$i]['cantidad'] = $row['cantidad'];
					$aEquipos[$i]['precio_venta'] = $row['precio_venta'];
					$aEquipos[$i]['plazo_entrega'] = $row['plazo_entrega'];
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
		
		function getPlazoEntrega()
		{
			return $this->plazo_entrega;
		}
		
		function getIdAcusePedido()
		{
			return $this->id_acusepedido;
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
		
		function setPlazoEntrega($valor)
		{
			$this->plazo_entrega = $valor;
		}
		
		function setIdAcusePedido($valor)
		{
			$this->id_acusepedido = $valor;
		}
		
		function delete()
		{
			$sql = "DELETE FROM acusepedido_equipos WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function update()
		{
			$sql = "UPDATE acusepedido_equipos SET referencia = '" . $this->referencia . "', descripcion = '" . $this->descripcion . "', cantidad = '" . $this->cantidad . "', precio_venta = '" . $this->precio_venta . "', plazo_entrega = '" . $this->plazo_entrega . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function add()
		{
			$sql = "INSERT INTO acusepedido_equipos (referencia,descripcion,cantidad,precio_venta,plazo_entrega,id_acusepedido) VALUES ('" . $this->referencia . "','" . $this->descripcion . "','" . $this->cantidad . "','" . $this->precio_venta . "','" . $this->plazo_entrega . "','" . $this->id_acusepedido . "')";
			mysql_query($sql);
		}
		
		function deleteByAcusePedido()
		{
			$sql = "DELETE FROM acusepedido_equipos WHERE id_acusepedido = " .$this->id_acusepedido;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>