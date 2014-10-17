<?php
	class OfertaEquipos
	{
		var $id;
		var $referencia;
		var $descripcion;
		var $cantidad;
		var $descuento;
		var $precio;
		var $id_oferta;
		
		function OfertaEquipos()
		{			
		}
		
		function getEquipos($id_oferta)
		{
			if (!empty($id_oferta))
			{				
				$aEquipos = array();
				$i=0;
				$sql = "SELECT * FROM ofertas_equipos WHERE id_oferta = " . $id_oferta . " ORDER BY id";
				$res = mysql_query($sql);
				while ($row = mysql_fetch_array($res))
				{
					$aEquipos[$i]['id'] = $row['id'];
					$aEquipos[$i]['referencia'] = $row['referencia'];
					$aEquipos[$i]['descripcion'] = $row['descripcion'];
					$aEquipos[$i]['cantidad'] = $row['cantidad'];
					$aEquipos[$i]['descuento'] = $row['descuento'];
					$aEquipos[$i]['precio'] = $row['precio'];
					//$aEquipos[$i++]['id_oferta'] = $row['id_oferta'];
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
		
		function getDescuento()
		{
			return $this->descuento;
		}
		
		function getPrecio()
		{
			return $this->precio;
		}
		
		function getIdOferta()
		{
			return $this->id_oferta;
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
		
		function setDescuento($valor)
		{
			$this->descuento = $valor;
		}
		
		function setPrecio($valor)
		{
			$this->precio = $valor;
		}
		
		function setIdOferta($valor)
		{
			$this->id_oferta = $valor;
		}
		
		function delete()
		{
			$sql = "DELETE FROM ofertas_equipos WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function update()
		{
			$sql = "UPDATE ofertas_equipos SET referencia = '" . $this->referencia . "', descripcion = '" . $this->descripcion . "', cantidad = '" . $this->cantidad . "', descuento = '" . $this->descuento . "', precio = '" . $this->precio . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function add()
		{
			$sql = "INSERT INTO ofertas_equipos (referencia,descripcion,cantidad,descuento,precio,id_oferta) VALUES ('" . $this->referencia . "','" . $this->descripcion . "','" . $this->cantidad . "','" . $this->descuento . "','" . $this->precio . "','" . $this->id_oferta . "')";
			mysql_query($sql);
		}
		
		function deleteByOferta()
		{
			$sql = "DELETE FROM ofertas_equipos WHERE id_oferta = " .$this->id_oferta;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>