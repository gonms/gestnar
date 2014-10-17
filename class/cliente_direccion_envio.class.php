<?php
	class ClienteDireccionEnvio
	{
		var $id;
		var $nombre;
        var $direccion1;
        var $direccion2;
        var $codpostal;
        var $localidad;
        var $provincia;
		var $id_cliente;
		
		function ClienteDireccionEnvio($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM clientes_direccion_envio WHERE id = " . $id;
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				
				$this->id = $row['id'];
				$this->nombre = $row['nombre'];
                $this->direccion1 = $row['direccion1'];
                $this->direccion2 = $row['direccion2'];
                $this->codpostal = $row['codpostal'];
                $this->localidad = $row['localidad'];
                $this->provincia = $row['provincia'];
				$this->id_cliente = $row['id_cliente'];
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
		
		function getIdCliente()
		{
			return $this->id_cliente;
		}
		
		function getDireccionesCliente($id_cliente)
		{
			$sql = "SELECT * FROM clientes_direccion_envio WHERE id_cliente = " . $id_cliente;
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
		
		function setIdCliente($valor)
		{
			$this->id_cliente = $valor;
		}
		
		function add()
		{
			$sql = "INSERT INTO clientes_direccion_envio (nombre,direccion1,direccion2,codpostal,localidad,provincia,id_cliente) VALUES ('" . $this->nombre . "','" . $this->direccion1 . "','" . $this->direccion2 . "','" . $this->codpostal . "','" . $this->localidad . "','" . $this->provincia . "','" . $this->id_cliente . "')";
			mysql_query($sql);
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE clientes_direccion_envio SET nombre = '" . $this->nombre . "', direccion1 = '" . $this->direccion1 . "', direccion2 = '" . $this->direccion2 . "', codpostal = '" . $this->codpostal . "', localidad = '" . $this->localidad . "', provincia = '" . $this->provincia . "', id_cliente = " . $this->id_cliente . " WHERE id = " . $this->id;
			mysql_query($sql);
		}
	}
?>