<?php
	class Usuario
	{
		var $id;
		var $nombre;
		var $user;
		var $password;
		var $accesos;
		var $codigo_oferta;
		
		function Usuario($user = "", $password = "")
		{
			if (!empty($user))
			{
				$sql = "SELECT * FROM usuarios WHERE user = '" . $user . "' and password = MD5('" . $password . "')";
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				
				$this->id = $row['id'];
				$this->nombre = $row['nombre'];
				$this->user = $row['user'];
				$this->accesos = $row['accesos'];
				$this->codigo_oferta = $row['codigo_oferta'];
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
		
		function getUser()
		{
			return $this->user;
		}
			
		function getAccesos($seccion)
		{
			list ($acOferta, $acPedido, $acAcusePedido, $acOrdenCompra, $acAlbaran, $acFactura, $acListados, $acFicheros) = explode("@", $this->accesos);
			
			switch ($seccion)
			{
				case "oferta": $acceso = ($acOferta == "1")?true:false;break;
				case "pedido": $acceso = ($acPedido == "1")?true:false;break;
				case "acusepedido": $acceso = ($acAcusePedido == "1")?true:false;break;
				case "ordencompra": $acceso = ($acOrdenCompra == "1")?true:false;break;
				case "albaran": $acceso = ($acAlbaran == "1")?true:false;break;
				case "factura": $acceso = ($acFactura == "1")?true:false;break;
				case "listados": $acceso = ($acListados == "1")?true:false;break;
				case "ficheros": $acceso = ($acFicheros == "1")?true:false;break;
			}
			return $acceso;
		}
		
		function getCodigoOferta()
		{
			return $this->codigo_oferta;
		}
				
		
		function setId($valor)
		{
			$this->id = $valor;
		}
		
		function setNombre($valor)
		{
			$this->nombre = $valor;
		}
		
		function setUser($valor)
		{
			$this->user = $valor;
		}
		
		function setPassword($valor)
		{
			$this->password = $valor;
		}
		
		function setAccesos($valor)
		{
			$this->accesos = $valor;
		}
		
		function setCodigoOferta($valor)
		{
			$this->codigo_oferta = $valor;
		}

		function add()
		{
			$sql = "INSERT INTO usuarios (nombre,user,password,accesos,codigo_oferta) VALUES ('" . $this->nombre . "','" . $this->user . "',MD5('" . $this->password . "'), '" . $this->accesos . "', '" . $this->codigo_oferta . "')";
			mysql_query($sql);
		}
		
		function update()
		{
			$sql = "UPDATE usuarios SET nombre = '" . $this->nombre . "', user = '" . $this->user . "', accesos = '" . $this->accesos . "', codigo_oferta = '" . $this->codigo_oferta . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function changePassword()
		{
			$sql = "UPDATE usuarios SET password = MD5('" . $this->password . "') WHERE id = " . $this->id;
			mysql_query($sql);
		}
	}
?>