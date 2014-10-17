<?php
	class AlbaranEquipos
	{
		var $id;
		var $referencia;
		var $descripcion;
		var $cantidad;
		var $precio;
		var $id_albaran;
		
		function AlbaranEquipos()
		{			
		}
		
		function getEquipos($id_albaran)
		{
			if (!empty($id_albaran))
			{				
				$aEquipos = array();
				$i=0;
				$sql = "SELECT * FROM albaranes_equipos WHERE id_albaran = " . $id_albaran . " ORDER BY id";
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
		
		function getIdAlbaran()
		{
			return $this->id_albaran;
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
		
		function setIdAlbaran($valor)
		{
			$this->id_albaran = $valor;
		}
		
		function delete()
		{
			$sql = "DELETE FROM albaranes_equipos WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function update()
		{
			$sql = "UPDATE albaranes_equipos SET referencia = '" . $this->referencia . "', descripcion = '" . $this->descripcion . "', cantidad = '" . $this->cantidad . "', precio = '" . $this->precio . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function add()
		{
			$sql = "INSERT INTO albaranes_equipos (referencia,descripcion,cantidad,precio,id_albaran) VALUES ('" . $this->referencia . "','" . $this->descripcion . "','" . $this->cantidad . "','" . $this->precio . "','" . $this->id_albaran . "')";
			mysql_query($sql);
		}
		
		function deleteByAlbaran()
		{
			$sql = "DELETE FROM albaranes_equipos WHERE id_albaran = " .$this->id_albaran;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>