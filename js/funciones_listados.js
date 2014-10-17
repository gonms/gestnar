$().ready(function()
{
    if ($('#tabla').val() != "registroalbaran" && $('#tabla').val() != "proveedores" && $('#tabla').val() != "clientes")
	{
        $('#anio').focus(function(e){
			$('#fecha_desde').val('');
			$('#fecha_hasta').val('');
			$('#numero').val('');
			$('#numero_pedido').val('');
			$('#equipos').val('');
		});
		
		$('#fecha_desde').focus(function(e){
			$('#anio').val('');
			$('#numero').val('');
			$('#numero_pedido').val('');
			$('#equipos').val('');
		});
		
		$('#fecha_hasta').focus(function(e){
			$('#anio').val('');
			$('#numero').val('');
			$('#numero_pedido').val('');
			$('#equipos').val('');
		});
		
		$('#numero').focus(function(e){
			$('#fecha_desde').val('');
			$('#fecha_hasta').val('');
			$('#anio').val('');
			$('#numero_pedido').val('');
			$('#equipos').val('');
		});

		$('#numero_pedido').focus(function(e){
			$('#fecha_desde').val('');
			$('#fecha_hasta').val('');
			$('#anio').val('');
			$('#numero').val('');
			$('#equipos').val('');
		});
	}	
	else if ($('#tabla').val() == "clientes")
	{
		$("#nombre").autocomplete("ajax/busca_clientes.php", {width: 450,max:100,scrollHeight: 350}).result(function(event, data, formatted)
		{
		 	var cID = data[1];
		 	$.get("ajax/carga_cliente.php",{ id: cID}, function(data){
		   		var datos = data.split("#");
		   		$('#nombre').val(datos[1]);
		 	});
		 	$('#id_nombre').val(cID);
		});
	}
	else if ($('#tabla').val() == "proveedores")
	{
		$("#nombre").autocomplete("ajax/busca_proveedores.php", {width: 450,max:100,scrollHeight: 350}).result(function(event, data, formatted)
		{
		 	var cID = data[1];
		 	$.get("ajax/carga_proveedor.php",{ id: cID}, function(data){
		   		var datos = data.split("#");
		   		$('#nombre').val(datos[1]);
		 	});
		 	$('#id_nombre').val(cID);
		});
	}
	
	$('#btn-Buscar').click(function(e){
		
		var _tabla = $('#tabla').val();
		
		if (_tabla == "registroalbaran")
        {
            
            if ($('#anio').val() == "" && $('#fecha_desde').val() == "" && $('#fecha_hasta').val() == "" && $('#numero').val() == "" && $('#numero_pedido').val() == "" && $('#equipos').val() == "")
            {
                alert("Introduce valores para la búsqueda");
                return false;
            }
		}
		else if (_tabla == "clientes" || _tabla == "proveedores")
        {
            
            if ($('#nombre').val() == "")
            {
                alert("Introduce valores para la búsqueda");
                return false;
            }
		}
		else
		{
            if (_tabla != "factura" && _tabla != "albaran" && $('#anio').val() == "" && $('#fecha_desde').val() == "" && $('#fecha_hasta').val() == "" && $('#numero').val() == "")
			{
                alert("Introduce valores para la búsqueda");
				return false;
			}
			
			if ((_tabla == "factura" || _tabla == "albaran") && $('#anio').val() == "" && $('#fecha_desde').val() == "" && $('#fecha_hasta').val() == "" && $('#numero').val() == "" && $('#numero_pedido').val() == "")
			{
				alert("Introduce valores para la búsqueda");
				return false;
			}
        }
			
		if ($('#tabla').val() != "proveedores" && $('#tabla').val() != "clientes")
		{
			if ($('#anio').val() != "")
			{
				var _tipo = "anio";
				var _valor = $('#anio').val();
			}
			else if ($('#numero').val() != "")
			{
				var _tipo = "numero";
				var _valor = $('#numero').val();
			}
			else if ($('#numero_pedido').val() != "" && (_tabla == "factura" || _tabla == "albaran"))
			{
				var _tipo = "numero_pedido";
				var _valor = $('#numero_pedido').val();
			}
			else if ($('#numero_pedido').val() != "" && _tabla == "registroalbaran")
			{
				var _tipo = "numero_pedido";
				var _valor = $('#numero_pedido').val();
			}
			else if (($('#fecha_desde').val() == "" || $('#fecha_hasta').val() == "") && $('#equipos').val() == undefined)
			{
				alert("Introduce el criterio de búsqueda");
				return false;
			}
			else
			{
				var _tipo = "fechas";
				var _valor = $('#fecha_desde').val() + "@" + $('#fecha_hasta').val();
			}
		}
		else if ($('#tabla').val() == "proveedores" || $('#tabla').val() == "clientes")
		{
			var _tipo = "nombre";
			var _valor = $('#id_nombre').val();
		}
		
		if ($('#equipos').val() != "" && _tabla == "registroalbaran")
		{
			var _tipo = "equipos";
			var _valor = $('#anio').val() + "@" + $('#fecha_desde').val() + "@" + $('#fecha_hasta').val() + "@" + $('#numero').val() + "@" + $('#numero_pedido').val() + "@" + $('#equipos').val();
		}
		
		$.get("ajax/carga_listado.php",{tabla: _tabla, tipo:_tipo, valor: _valor}, function(data){
			$('#tabla_listado').html(data);
			$('#tabla_listado').css("display","");
		});
	});
	
	$('#logo').click(function(e){
		window.location = 'menu.php';
	});
	
	$("#volver").click(function(){        
        if (confirm(String.fromCharCode(191) + "Volver al menu principal?"))
		{
			window.location = "menu.php";
		}
    });
});

function imprimir(tabla, id)
{
	window.open(tabla + '_pdf.php?id_' + tabla + '=' + id + '&paginas=','');
}

function imprimir_registro(tipo, valor)
{
	window.open('registroalbaranes.php?tipo=' + tipo + '&valor=' + valor,'');
}

function borrar(tabla, id)
{
	if (tabla == "oferta" || tabla == "ordencompra" || tabla == "factura") 
		var pronombre = " la ";
	else 
		var pronombre = " el ";
	
	if (confirm(String.fromCharCode(191) + "Borrar" + pronombre + tabla + "?")) {
		$.get("ajax/borra_listado.php", {
			tabla: tabla,
			id: id
		}, function(data){
			if (data == "OK") {
				alert(pronombre + tabla + " se ha borrado correctamente");
				$('#btn-Buscar').click();
			}
			else {
				alert("Ocurrió un problema al borrar" + pronombre + tabla);
			}
		});
	}
}