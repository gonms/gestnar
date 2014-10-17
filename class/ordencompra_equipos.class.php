<?php
	class OrdenCompraEquipos
	{
		var $id;
		var $referencia;
		var $descripcion;
		var $cantidad;
		var $precio;
		var $id_ordencompra;
		
		function OrdenCompraEquipos()
		{			
		}
		
		function getEquipos($id_ordencompra)
		{
			if (!empty($id_ordencompra))
			{				
				$aEquipos = array();
				$i=0;
				$sql = "SELECT * FROM ordencompra_equipos WHERE id_ordencompra = " . $id_ordencompra . " ORDER BY id";
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
		
		function getIdOrdenCompra()
		{
			return $this->id_ordencompra;
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
		
		function setIdOrdenCompra($valor)
		{
			$this->id_ordencompra = $valor;
		}
		
		function delete()
		{
			$sql = "DELETE FROM ordencompra_equipos WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function update()
		{
			$sql = "UPDATE ordencompra_equipos SET referencia = '" . $this->referencia . "', descripcion = '" . $this->descripcion . "', cantidad = '" . $this->cantidad . "', precio = '" . $this->precio . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function add()
		{
			$sql = "INSERT INTO ordencompra_equipos (referencia,descripcion,cantidad,precio,id_ordencompra) VALUES ('" . $this->referencia . "','" . $this->descripcion . "','" . $this->cantidad . "','" . $this->precio . "','" . $this->id_ordencompra . "')";
			mysql_query($sql);
		}
		
		function deleteByOrdenCompra()
		{
			$sql = "DELETE FROM ordencompra_equipos WHERE id_ordencompra = " .$this->id_ordencompra;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>