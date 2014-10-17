<?php
	class Cliente
	{
		var $id;
		var $nombre;
		var $direccion;
		var $localidad;
		var $provincia;
		var $codpostal;
		var $telefono;
		var $fax;
		var $cif;
		var $forma_pago;
		var $email;
		var $numero_cuenta;
		
		function Cliente($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM clientes WHERE id = " . $id;
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
				$this->cif = $row['cif'];
				$this->forma_pago = $row['forma_pago'];
				$this->email = $row['email'];
				$this->numero_cuenta = $row['numero_cuenta'];
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
		
		function getCIF()
		{
			return $this->cif;
		}
		
		function getFormaPago()
		{
			return $this->forma_pago;
		}
		
		function getEmail()
		{
			return $this->email;
		}
		
		function getNumeroCuenta()
		{
			return $this->numero_cuenta;
		}
		
		function getListado($valor)
		{
			$sql = "SELECT id,numero,codigo,revision,DATE_FORMAT(fecha,'%d/%m/%Y') as fecha FROM pedidos WHERE id_cliente = '" . $valor . "'";
			$res = mysql_query($sql);
			$aCliente = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$total = 0;
				$sql = "SELECT * FROM pedidos_equipos WHERE id_pedido = '" . $row['id'] . "'";
				$resE = mysql_query($sql);
				while ($rowE = mysql_fetch_array($resE))
				{
					$tot = $rowE['cantidad'] * $rowE['precio_venta'];
					$total += $tot;
				}
				$numero = $row['codigo'] . "-" . $row['numero'];
				if (!empty($row['revision'])) $numero .= "-" . $row['revision'];
				
				$aCliente[$i]['pedido'] = $numero;
				$aCliente[$i]['fecha'] = $row['fecha'];
				$aCliente[$i]['total'] = number_format($total,2,",",".");
				$i++;
			}
			return $aCliente;
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
		
		function setCIF($valor)
		{
			$this->cif = $valor;
		}
		
		function setFormaPago($valor)
		{
			$this->forma_pago = $valor;
		}
		
		function setEmail($valor)
		{
			$this->email = $valor;
		}
		
		function setNumeroCuenta($valor)
		{
			$this->numero_cuenta = $valor;
		}
		
		
		function add()
		{
			$sql = "INSERT INTO clientes (nombre,direccion,localidad,provincia,codpostal,telefono,fax,cif,forma_pago,email,numero_cuenta) VALUES ('" . $this->nombre . "','" . $this->direccion . "','" . $this->localidad . "','" . $this->provincia . "','" . $this->codpostal . "','" . $this->telefono . "','" . $this->fax . "','" . $this->cif . "','" . $this->forma_pago . "','" . $this->email . "','" . $this->numero_cuenta . "')";
			mysql_query($sql);
			return mysql_insert_id();
			
			/*if (mysql_affected_rows() > 0)
			else
				return $sql;*/
		}
		
		function update()
		{
			$sql = "UPDATE clientes SET nombre = '" . $this->nombre . "', direccion = '" . $this->direccion . "', localidad = '" . $this->localidad . "', provincia = '" . $this->provincia . "', codpostal = '" . $this->codpostal . "', telefono = '" . $this->telefono . "', fax = '" . $this->fax . "'";
			if (!empty($this->cif))
				$sql .= ", cif = '" . $this->cif . "'";
			if (!empty($this->forma_pago))
				$sql .= ", forma_pago = '" . $this->forma_pago . "'";
			if (!empty($this->email))
				$sql .= ", email = '" . $this->email . "'";
			if (!empty($this->numero_cuenta))
				$sql .= ", numero_cuenta = '" . $this->numero_cuenta . "'";
			$sql .= " WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function updateFromClientes()
		{
			$sql = "UPDATE clientes SET nombre = '" . $this->nombre . "', direccion = '" . $this->direccion . "', localidad = '" . $this->localidad . "', provincia = '" . $this->provincia . "', codpostal = '" . $this->codpostal . "', telefono = '" . $this->telefono . "', fax = '" . $this->fax . "'";
			if (!empty($this->cif))
				$sql .= ", cif = '" . $this->cif . "'";
			if (!empty($this->forma_pago))
				$sql .= ", forma_pago = '" . $this->forma_pago . "'";
			if (!empty($this->email))
				$sql .= ", email = '" . $this->email . "'";
			if (!empty($this->numero_cuenta))
				$sql .= ", numero_cuenta = '" . $this->numero_cuenta . "'";
			$sql .= " WHERE id = " . $this->id;
			mysql_query($sql);
		}		
	}
?>