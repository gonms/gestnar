<?php	
	class OrdenCompra
	{
		var $id;
        var $id_pedido;
		var $numero;
		var $codigo;
		var $revision;
		var $fecha;
        var $id_proveedor;
        var $id_proveedor_direccion_envio;
        var $su_oferta;
        var $fecha_entrega;
        var $portes;
        var $documentacion_suministrar;
        var $documentacion_incluir;
		var $condiciones_pago;
        var $responsable;
		var $visto_bueno;
		
		function OrdenCompra($id = "")
		{
			if (!empty($id))
			{
				$sql = "SELECT * FROM ordencompra WHERE id = '" . $id . "'";
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				$this->id = $row['id'];
                $this->id_pedido = $row['id_pedido'];
				$this->numero = $row['numero'];
				$this->codigo = $row['codigo'];
				$this->revision = $row['revision'];
				$this->fecha = $row['fecha']; 
                $this->id_proveedor = $row['id_proveedor'];
                $this->id_proveedor_direccion_envio = $row['id_proveedor_direccion_envio'];
                $this->su_oferta = $row['su_oferta'];
                $this->fecha_entrega = $row['fecha_entrega'];
                $this->portes = $row['portes']; 
				$this->documentacion_suministrar = $row['documentacion_suministrar']; 
				$this->documentacion_incluir = $row['documentacion_incluir']; 
                $this->condiciones_pago = $row['condiciones_pago']; 
                $this->responsable = $row['responsable'];
                $this->visto_bueno = $row['visto_bueno'];
			}
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getIdPedido()
        {
            return $this->id_pedido;
        }
        
        function getNumero()
		{
			return $this->numero;
		}
		
		function getCodigo()
		{
			return $this->codigo;
		}
		
		function getRevision()
		{
			return $this->revision;
		}
		
		function getFecha()
		{
			return $this->fecha;
		}
        
        function getIdProveedor()
        {
            return $this->id_proveedor;
        }
        
        function getIdProveedorDireccionEnvio()
        {
            return $this->id_proveedor_direccion_envio;
        }
        
        function getSuOferta()
        {
            return $this->su_oferta;
        }
        
        function getFechaEntrega()
        {
            return $this->fecha_entrega;
        }
        
        function getPortes()
        {
            return $this->portes;
        }
		
		function getDocumentacionSuministrar()
		{
			return $this->documentacion_suministrar;
		}

        function getDocumentacionIncluir()
        {
            return $this->documentacion_incluir;
        }
        		
		function getCondicionesPago()
		{
			return $this->condiciones_pago;
		}
        
        function getResponsable()
        {
            return $this->responsable;
        }
        
        function getVistoBueno()
        {
            return $this->visto_bueno;
        }
		
		function getListado($tipo,$valor)
		{
			if ($tipo == "numero")
				$sql = "SELECT id,numero,fecha,id_pedido,id_proveedor FROM ordencompra WHERE numero LIKE '%" . $valor . "%'";
			else
				$sql = "SELECT id,numero,fecha,id_pedido,id_proveedor FROM ordencompra WHERE fecha >= '" . $valor[0] . "' AND fecha <= '" . $valor[1] . "'";
			$res = mysql_query($sql);
			$aOrdenCompra = array();
			$i = 0;
			while ($row = mysql_fetch_array($res))
			{
				$aOrdenCompra[$i]['id'] = $row['id'];
				$aOrdenCompra[$i]['numero'] = $row['numero'];
				$aOrdenCompra[$i]['id_pedido'] = $row['id_pedido'];
				$aOrdenCompra[$i]['id_proveedor'] = $row['id_proveedor'];
				$aOrdenCompra[$i]['fecha'] = $row['fecha'];
				$i++;
			}
			return $aOrdenCompra;
		}
		
        
		
		
		function setId($valor)
		{
			$this->id = $valor;
		}
        
        function setIdPedido($valor)
        {
            $this->id_pedido = $valor;
        }
		
		function setNumero($valor)
		{
			$this->numero = $valor;
		}
		
		function setCodigo($valor)
		{
			$this->codigo = $valor;
		}
		
		function setRevision($valor)
		{
			$this->revision = $valor;
		}
		
		function setFecha($valor)
		{
			$this->fecha = $valor;
		}
        
        function setIdProveedor($valor)
        {
            $this->id_proveedor = $valor;
        }
        
        function setIdProveedorDireccionEnvio($valor)
        {
            $this->id_proveedor_direccion_envio = $valor;
        }
        
        function setSuOferta($valor)
        {
            $this->su_oferta = $valor;
        }
        
        function setFechaEntrega($valor)
        {
            $this->fecha_entrega = $valor;
        }
        
        function setPortes($valor)
        {
            $this->portes = $valor;
        }
        
        function setDocumentacionSuministrar($valor)
        {
            $this->documentacion_suministrar = $valor;
        }
		
		function setDocumentacionIncluir($valor)
		{
			$this->documentacion_incluir = $valor;
		}
		
		function setCondicionesPago($valor)
		{
			$this->condiciones_pago = $valor;
		}
        
        function setResponsable($valor)
        {
            $this->responsable = $valor;
        }
        
        function setVistoBueno($valor)
        {
            $this->visto_bueno = $valor;
        }
        
		
		
		function add()
		{
			$sql = "INSERT INTO ordencompra (id_pedido, numero, codigo, revision, fecha, id_proveedor, id_proveedor_direccion_envio, su_oferta, fecha_entrega, portes, documentacion_suministrar, documentacion_incluir, condiciones_pago, responsable, visto_bueno) VALUES ('" . $this->id_pedido . "', '" . $this->numero . "', '" . $this->codigo . "', '" . $this->revision . "', '" . $this->fecha . "', '" . $this->id_proveedor . "', '" . $this->id_proveedor_direccion_envio . "', '" . $this->su_oferta . "', '" . $this->fecha_entrega . "', '" . $this->portes . "', '" . $this->documentacion_suministrar . "', '" . $this->documentacion_incluir . "', '" . $this->condiciones_pago . "', '" . $this->responsable . "', '" . $this->visto_bueno . "')";
			mysql_query($sql);

			return mysql_insert_id();
		}
		
		function update()
		{
			$sql = "UPDATE ordencompra SET id_pedido = '" . $this->id_pedido . "', numero = '" . $this->numero . "', codigo = '" . $this->codigo . "', revision = '" . $this->revision . "', fecha = '" . $this->fecha . "', id_proveedor = '" . $this->id_proveedor . "', id_proveedor_direccion_envio = '" . $this->id_proveedor_direccion_envio . "', su_oferta = '" . $this->su_oferta . "', fecha_entrega = '" . $this->fecha_entrega . "', portes = '" . $this->portes . "', documentacion_suministrar = '" . $this->documentacion_suministrar . "', documentacion_incluir = '" . $this->documentacion_incluir . "', condiciones_pago = '" . $this->condiciones_pago . "', responsable = '" . $this->responsable . "', visto_bueno = '" . $this->visto_bueno . "' WHERE id = " . $this->id;
			mysql_query($sql);
		}
		
		function delete()
		{
			$sql = "DELETE FROM ordencompra WHERE id = " .$this->id;
			$res = mysql_query($sql);
			return mysql_affected_rows();
		}
	}
?>