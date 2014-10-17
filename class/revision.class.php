<?php
	class Revision
	{
		var $id;
		var $revision;
		var $fecha;
		var $seccion;
		
		function Revision($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM revisiones_formato WHERE id = " . $id;
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				
				$this->id = $row['id'];
				$this->revision = $row['revision'];
				$this->fecha = $row['fecha'];
				$this->seccion = $row['seccion'];
			}
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getRevision()
		{
			return $this->revision;
		}
		
		function getFecha()
		{
			return $this->fecha;
		}
		
		function getSeccion()
		{
			return $this->seccion;
		}
		
		function getRevisionBySeccion($seccion)
		{
			$sql = "SELECT * FROM revisiones_formato WHERE seccion = '" . $seccion . "' ORDER BY fecha";
			$res = mysql_query($sql);
			$aRevisiones = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$aRevisiones[$i]['fecha'] = $row['fecha'];
				$aRevisiones[$i]['revision'] = $row['revision'];
				$i++;
			}
			
			return $aRevisiones;
		}
		
		function getRevisionByDate($fecha, $seccion)
		{
			$sql = "SELECT revision FROM revisiones_formato WHERE seccion = '" . $seccion . "' and fecha <= '" . $fecha . "' ORDER BY fecha DESC LIMIT 0,1";
			$res = mysql_query($sql);
			$row = mysql_fetch_array($res);
			
			return $row['revision'];
		}
		
		function setId($valor)
		{
			$this->id = $valor;
		}
		
		function setRevision($valor)
		{
			$this->revision = $valor;
		}
		
		function setFecha($valor)
		{
			$this->fecha = $valor;
		}
		
		function setSeccion($valor)
		{
			$this->seccion = $valor;
		}		
	
		function add()
		{
			$sql = "INSERT INTO revisiones_formato (revision,fecha,seccion) VALUES ('" . $this->revision . "','" . $this->fecha . "','" . $this->seccion . "')";
			mysql_query($sql);
			
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE revisiones_formato SET revision = '" . $this->revision . "', fecha = '" . $this->fecha . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
	}
?>