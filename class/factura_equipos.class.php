<?php
	class FacturaEquipos
	{
		var $id;
		var $referencia;
		var $descripcion;
		var $cantidad;
		var $precio;
		var $id_factura;
		
		function FacturaEquipos()
		{			
		}
		
		function getEquipos($id_factura)
		{
			if (!empty($id_factura))
			{				
				$aEquipos = array();
				$i=0;
				$sql = "SELECT * FROM facturas_equipos WHERE id_factura = " . $id_factura . " ORDER BY id";
				$res = mysql_query($sql);
				while ($row = mysql_fetch_array($res))
				{
					$aEquipos[$i]['id'] = $row['id'];
					$aEquipos[$i]['referencia'] = $row['referencia'];
					$aEquipos[$i]['descripcion'] = $row['descripcion'];
					$aEquipos[$i]['cantidad'] = $row['cantidad'];
					$aEquipos[$i]['precio'] = $row['precio'];
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
		
		function getPrecio()
		{
			return $this->precio;
		}
		
		function getIdFactura()
		{
			return $this->id_factura;
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
		
		function setPrecio($valor)
		{
			$this->precio = $valor;
		}
		
		function setIdFactura($valor)
		{
			$this->id_factura = $valor;
		}
		
		function delete()
		{
			$sql = "DELETE FROM facturas_equipos WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function update()
		{
			$sql = "UPDATE facturas_equipos SET referencia = '" . $this->referencia . "', descripcion = '" . $this->descripcion . "', cantidad = '" . $this->cantidad . "', precio = '" . $this->precio . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function add()
		{
			$sql = "INSERT INTO facturas_equipos (referencia,descripcion,cantidad,precio,id_factura) VALUES ('" . $this->referencia . "','" . $this->descripcion . "','" . $this->cantidad . "','" . $this->precio . "','" . $this->id_factura . "')";
			mysql_query($sql);
		}
		
		function deleteByFactura()
		{
			$sql = "DELETE FROM facturas_equipos WHERE id_factura = " .$this->id_factura;
			$res = mysql_query($sql);
			return $res;
		}
	}
?>