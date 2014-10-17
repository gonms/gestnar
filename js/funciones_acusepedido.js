var num_equipos = 0;

$().ready(function()
{
    if ($('#accion').val() == "guardar")
    {
        $("#popup").css({"width": 400});
        $("#popup").css({"height": 150});
        $("#div_popup").load("popup.php?tipo=acusepedido&id=" + $("#id_acusepedido").val());
        centerPopup();
        loadPopup();
    }
    
    $("#button").click(function(){        
        buscar_equipos('nuevo');
    });
                
    $("#popupClose").click(function(){
        disablePopup();
    });

    $("#backgroundPopup").click(function(){
        disablePopup();
    });

    $(document).keypress(function(e){
        if(e.keyCode==27 && popupStatus==1){
            disablePopup();
        }
    });    
    
    $('#fset_equipos').css('display','none');
    	
	
	$("#btn-GuardaAcusePedido").click(function(e)
	{
		var errores = "";
		
		if ($("#numero_pedido").val() == '')
			errores = "- Número de pedido\n";
		if ($("#fecha").val() == '')
			errores += "- Fecha\n";
		if ($("#forma_envio").val() == '')
			errores += "- Forma de envío\n";
			
		if (errores != "")
		{
			alert("Los siguientes campos no pueden estar vacíos: \n\n" + errores);
			return false;
		}
		$("#fAcusePedido").submit();
	});
	
	if($("#accion").val() == "nuevo")
	{
		$("#numero_pedido").autocomplete("ajax/busca_pedidos.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosPedido(data[1]);
		});
	}
	else
	{
		$("#numero_pedido").autocomplete("ajax/busca_acusepedido.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosAcusePedido(data[1]);
		});
	}
	
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

function nuevoEquipo(id)
{
	var txtError = "";
	if ($('#cantidad_nuevo').val() == "" || $('#cantidad_nuevo').val() == "0")
	{
		txtError = "Debes introducir una cantidad correcta.\n\n";
	}	
	
	if ($('#precio_venta_nuevo').val() == "" || $('#precio_venta_nuevo').val() == "0")
	{
		txtError += "Debes introducir un precio de venta correcto.";
	}
    	
	if (txtError != "")
	{
		alert(txtError);
		return false;
	}
	
	var table = document.getElementById('tabla_equipos');
	var idRow=table.getElementsByTagName("TR").length+1;

	var tr = "<tr id='row_" + idRow + "'>\n";
	tr += "<td><input name='referencia_" + idRow + "' id='referencia_" + idRow + "' type='text' value='" + $('#referencia_nuevo').val() + "' /></td>\n";
	tr += "<td><textarea name='descripcion_" + idRow + "' id='descripcion_" + idRow + "' cols='0' rows='0'>" + $('#descripcion_nuevo').val() + "</textarea></td>\n";
	tr += "<td><input name='cantidad_" + idRow + "' id='cantidad_" + idRow + "' type='text' class='input01' value='" + $('#cantidad_nuevo').val() + "' /></td>\n";
	tr += "<td><input name='precio_" + idRow + "' id='precio_" + idRow + "' type='text' value='" + $('#precio_nuevo').val() + "' /></td>\n";
	tr += "<td><input name='plazo_entrega_" + idRow + "' id='plazo_entrega_" + idRow + "' type='text' value='" + $('#plazo_entrega_nuevo').val() + "' /></td>\n";
	tr += "<td><a href='#' onClick='buscar_equipos(\"" + idRow + "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;<a href='#' onClick='borraEquipo(\"" + idRow + "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a><input type='hidden' name='accion_" + idRow + "' id='accion_" + idRow + "' value='nuevo'/><input type='hidden' name='id_" + idRow + "' id='id_" + idRow + "' value=''/></td>\n";
	tr += "</tr>\n";
	
	$("#tabla_equipos").append(tr);
	
    num_equipos = parseInt(num_equipos) + 1;
	document.getElementById('num_equipos').value = num_equipos; 
    document.getElementById('referencia_nuevo').value = "";
    document.getElementById('descripcion_nuevo').value = "";
    document.getElementById('cantidad_nuevo').value = "";
    document.getElementById('precio_nuevo').value = "";
    document.getElementById('plazo_entrega_nuevo').value = "";
}

function cargaDatosPedido(id) {
	var valor = id;
 	$.get("ajax/carga_pedido.php",{ id: valor}, function(data){
   		var datos = data.split("#");
   		
   		$('#id_pedido').val(datos[0]);        
        $('#numero_pedido').val(datos[2]);
        $('#codigo_pedido').val(datos[3]);
        $('#revision').val(datos[4]);
        $('#forma_pago').val(datos[6]);
        $('#id_cliente').val(datos[10]);
        $('#id_cliente_direccion_envio').val(datos[11]);
        $('#fecha_envio').val(datos[13]);
        $('#su_referencia').val(datos[14]);
        $('#de_fecha').val(datos[15]);
 	});
 	
 	$.get("ajax/carga_pedidoEquipos.php",{ id: valor, vieneDe: 'acusepedido', accion: $('#accion').val()}, function(data){
 		$('#tabla_equipos').append(data);
 	});
 	
 	$.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'pedidos'}, function(data){
		num_equipos = data;
 		$('#num_equipos').val(data);
 	});
}

function cargaDatosAcusePedido(id) {
    var valor = id;
     $.get("ajax/carga_acusepedido.php",{ id: valor}, function(data){
        var datos = data.split("#");
           
        $('#id_acusepedido').val(datos[0]);
        $('#id_pedido').val(datos[1]);
        $('#numero_pedido').val(datos[2]);
        $('#codigo_pedido').val(datos[3]);
        $('#fecha').val(datos[5]);
        $('#portes').val(datos[6]);
        $('#forma_envio').val(datos[7]);
        $('#id_cliente').val(datos[8]);
        $('#id_cliente_direccion_envio').val(datos[9]);
        $('#forma_pago').val(datos[10]);
        $('#su_referencia').val(datos[11]);
        $('#de_fecha').val(datos[12]);
        $('#fecha_envio').val(datos[13]);
		
		$.get("ajax/dame_revision.php",{ tabla: 'acusepedido', valor: datos[4], accion: $('#accion').val()}, function(data){
			$('#revision').val(data);
		});
     });
     
     $.get("ajax/carga_acusepedidoEquipos.php",{ id: valor, vieneDe: 'acusepedido', accion: $('#accion').val()}, function(data){
         $('#tabla_equipos').append(data);
     });
     
     $.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'acusepedido'}, function(data){
	 	num_equipos = data;
		$('#num_equipos').val(data);
     });     
}

function modificaEquipo(pos)
{
	if($('#accion_' + pos).val() == 'nuevo')
	{
		$('#accion_' + pos).val('nuevo');
	}
	else
	{
		$('#accion_' + pos).val('modificar');
	}
}

function borraEquipo(pos)
{
	if (confirm(String.fromCharCode(191) + "Borrar este equipo?"))
	{
		if($('#accion_' + pos).val() == 'nuevo')
		{
			$('#accion_' + pos).val('');
		}
		else
		{
			$('#accion_' + pos).val('borrar');
		}
		$('#row_' + pos).fadeOut(1000);
		return true;
	}
}

function buscar_equipos(pos)
{
    if ($('#accion').val() == "nuevo" || $('#accion').val() == "revision")
        $('#accion_' + pos).val("nuevo");
    else if ($('#accion').val() == "modificar")
        $('#accion_' + pos).val("modificar");
        
    centerPopup();
    loadPopup();
    
    $('#div_popup').load("equipos.php?pos="+pos);
    $('#popup').css('display','block');
    return false;    
}

function toggle(elem)
{
    $('#fset_acuse').css('display','none');
    $('#fset_equipos').css('display','none');
    
    $('#'+elem).slideToggle("slow");
}