<?php
	class ProveedorDireccionEnvio
	{
		var $id;
		var $nombre;
        var $direccion1;
        var $direccion2;
        var $codpostal;
        var $localidad;
        var $provincia;
		var $id_proveedor;
		
		function ProveedorDireccionEnvio($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM proveedores_direccion_envio WHERE id = " . $id;
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				
				$this->id = $row['id'];
				$this->nombre = $row['nombre'];
                $this->direccion1 = $row['direccion1'];
                $this->direccion2 = $row['direccion2'];
                $this->codpostal = $row['codpostal'];
                $this->localidad = $row['localidad'];
                $this->provincia = $row['provincia'];
				$this->id_proveedor = $row['id_proveedor'];
			}
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getNombre()
		{
			return $this->nombre;
		}
        
        function getDireccion1()
        {
            return $this->direccion1;
        }
        
        function getDireccion2()
        {
            return $this->direccion2;
        }
        
        function getCodPostal()
        {
            return $this->codpostal;
        }
        
        function getLocalidad()
        {
            return $this->localidad;
        }
        
        function getProvincia()
        {
            return $this->provincia;
        }
		
		function getIdProveedor()
		{
			return $this->id_proveedor;
		}
		
		function getDireccionesProveedor($id_proveedor)
		{
			$sql = "SELECT * FROM proveedores_direccion_envio WHERE id_proveedor = " . $id_proveedor;
			$res = mysql_query($sql);
			$aDirecciones = array();
			$i=0;
			while ($row = mysql_fetch_array($res))
			{
				$aDirecciones[$i]['id'] = $row['id'];
				$aDirecciones[$i]['nombre'] = $row['nombre'];
                $aDirecciones[$i]['direccion1'] = $row['direccion1'];
                $aDirecciones[$i]['direccion2'] = $row['direccion2'];
                $aDirecciones[$i]['codpostal'] = $row['codpostal'];
                $aDirecciones[$i]['localidad'] = $row['localidad'];
                $aDirecciones[$i]['provincia'] = $row['provincia'];
				$i++;
			}
			
			return $aDirecciones;
		}
		
		function setId($valor)
		{
			$this->id = $valor;
		}
		
		function setNombre($valor)
		{
			$this->nombre = $valor;
		}
        
        function setDireccion1($valor)
        {
            $this->direccion1 = $valor;
        }
        
        function setDireccion2($valor)
        {
            $this->direccion2 = $valor;
        }
        
        function setCodPostal($valor)
        {
            $this->codpostal = $valor;
        }
        
        function setLocalidad($valor)
        {
            $this->localidad = $valor;
        }
        
        function setProvincia($valor)
        {
            $this->provincia = $valor;
        }
		
		function setIdProveedor($valor)
		{
			$this->id_proveedor = $valor;
		}
		
		function add()
		{
			$sql = "INSERT INTO proveedores_direccion_envio (nombre,direccion1,direccion2,codpostal,localidad,provincia,id_proveedor) VALUES ('" . $this->nombre . "','" . $this->direccion1 . "','" . $this->direccion2 . "','" . $this->codpostal . "','" . $this->localidad . "','" . $this->provincia . "','" . $this->id_proveedor . "')";
			mysql_query($sql);
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE proveedores_direccion_envio SET nombre = '" . $this->nombre . "', direccion1 = '" . $this->direccion1 . "', direccion2 = '" . $this->direccion2 . "', codpostal = '" . $this->codpostal . "', localidad = '" . $this->localidad . "', provincia = '" . $this->provincia . "', id_proveedor = " . $this->id_proveedor . " WHERE id = " . $this->id;
			mysql_query($sql);
		}
	}
?>