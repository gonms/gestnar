<?php
	class ClienteContactos
	{
		var $id;
		var $nombre;
		var $id_cliente;
		
		function ClienteContactos($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM clientes_contactos WHERE id = " . $id;
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				
				$this->id = $row['id'];
				$this->nombre = $row['nombre'];
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
		
		function getIdCliente()
		{
			return $this->id_cliente;
		}
		
		function getContactosCliente($id_cliente)
		{
			$sql = "SELECT * FROM clientes_contactos WHERE id_cliente = " . $id_cliente;
			$res = mysql_query($sql);
			$aContactos = array();
			$i=0;
			while ($row = mysql_fetch_array($res))
			{
				$aContactos[$i]['id'] = $row['id'];
				$aContactos[$i]['nombre'] = $row['nombre'];
				$i++;
			}
			
			return $aContactos;
		}
		
		function setId($valor)
		{
			$this->id = $valor;
		}
		
		function setNombre($valor)
		{
			$this->nombre = $valor;
		}
		
		function setIdCliente($valor)
		{
			$this->id_cliente = $valor;
		}
		
		function add()
		{
			$sql = "INSERT INTO clientes_contactos (nombre,id_cliente) VALUES ('" . $this->nombre . "'," . $this->id_cliente . ")";
			mysql_query($sql);
			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE clientes_contactos SET nombre = '" . $this->nombre . "' WHERE id = " . $this->id;
			mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>