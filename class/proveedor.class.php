<?php
	class Proveedor
	{
		var $id;
		var $nombre;
		var $direccion;
		var $localidad;
		var $provincia;
		var $codpostal;
		var $telefono;		
		var $fax;
		var $contacto;
		
		function Proveedor($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM proveedores WHERE id = " . $id;
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				
				$this->id = $row['id'];
				$this->nombre = $row['nombre'];
				$this->direccion = $row['direccion'];
				$this->localidad = $row['localidad'];
				$this->provincia = $row['provincia'];
				$this->codpostal = $row['codpostal'];
				$this->telefono = $row['telefono'];				
				$this->fax = $row['fax'];
				$this->contacto = $row['contacto'];
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
		
		function getDireccion()
		{
			return $this->direccion;
		}
		
		function getLocalidad()
		{
			return $this->localidad;
		}
		function getProvincia()
		{
			return $this->provincia;
		}
		function getCodpostal()
		{
			return $this->codpostal;
		}
		function getTelefono()
		{
			return $this->telefono;
		}
		function getFax()
		{
			return $this->fax;
		}
		function getContacto()
		{
			return $this->contacto;
		}
		
		function getListado($valor)
		{
			$sql = "SELECT id,numero,codigo,revision,DATE_FORMAT(fecha,'%d/%m/%Y') as fecha FROM ordencompra  WHERE id_proveedor = '" . $valor . "'";
			$res = mysql_query($sql);
			$aProveedor = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$total = 0;
				$sql = "SELECT * FROM ordencompra_equipos WHERE id_ordencompra = '" . $row['id'] . "'";
				$resE = mysql_query($sql);
				while ($rowE = mysql_fetch_array($resE))
				{
					$tot = $rowE['cantidad'] * $rowE['precio'];
					$total += $tot;
				}
				
				$numero = "";
				if (!empty($row['codigo'])) $numero = $row['codigo'] . "-";
				$numero .= $row['numero'];
				if (!empty($row['revision'])) $numero .= "-" . $row['revision'];
				
				$aProveedor[$i]['orden'] = $numero;
				$aProveedor[$i]['fecha'] = $row['fecha'];
				$aProveedor[$i]['total'] = number_format($total,2,",",".");
				$i++;
			}
			return $aProveedor;
		}
		
		
		function setId($valor)
		{
			$this->id = $valor;
		}
		
		function setNombre($valor)
		{
			$this->nombre = $valor;
		}
		
		function setDireccion($valor)
		{
			$this->direccion = $valor;
		}
		
		function setLocalidad($valor)
		{
			$this->localidad = $valor;
		}
		function setProvincia($valor)
		{
			$this->provincia = $valor;
		}
		function setCodpostal($valor)
		{
			$this->codpostal = $valor;
		}
		function setTelefono($valor)
		{
			$this->telefono = $valor;
		}
		function setFax($valor)
		{
			$this->fax = $valor;
		}
		function setContacto($valor)
		{
			$this->contacto = $valor;
		}
		
		function add()
		{
			$sql = "INSERT INTO proveedores (nombre,direccion,localidad,provincia,codpostal,telefono,fax,contacto) VALUES ('" . $this->nombre . "','" . $this->direccion . "','" . $this->localidad . "','" . $this->provincia . "','" . $this->codpostal . "','" . $this->telefono . "','" . $this->fax . "','" . $this->contacto . "')";
			mysql_query($sql);
			
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE proveedores SET nombre = '" . $this->nombre . "', direccion = '" . $this->direccion . "', localidad = '" . $this->localidad . "', provincia = '" . $this->provincia . "', codpostal = '" . $this->codpostal . "', telefono = '" . $this->telefono . "', fax = '" . $this->fax . "', contacto = '" . $this->contacto . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
	}
?>