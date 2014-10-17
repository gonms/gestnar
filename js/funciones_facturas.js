var num_equipos = 0;
var quitarCheckBox = false;

$().ready(function()
{
	if ($('#accion').val() == "guardar")
    {
        $("#popup").css({"width": 400});
        $("#popup").css({"height": 150});
        $("#div_popup").load("popup.php?tipo=factura&id=" + $("#id_factura").val());
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
	
	$('#fset_cliente').css('display','none');
    $('#fset_dirEnvio').css('display','none');
    $('#fset_equipos').css('display','none');
    	
	$('#btn-DireccionEnvio').click(function(e)
	{
		nuevaDireccionEnvio();
	});

	$("#btn-GuardaFactura").click(function(e)
	{
		var errores = "";
		
		if ($("#numero_factura").val() == '')
			errores = "- Número de factura\n";
			
		if (errores != "")
		{
			alert("Los siguientes campos no pueden estar vacíos: \n\n" + errores);
			return false;
		}
		$("#fFactura").submit();
	});
	
	if($("#accion").val() != "modificar" && $("#accion").val() != "modAbono")
	{
		$.get("ajax/dame_numero_factura.php", {accion: $('#accion').val()}, function(data)
		{
			if ($('#accion').val() == "duplicar")
				$('#nuevo_numero_factura').val(data);
			else
				$('#numero_factura').val(data);
			
			var fecha = new Date();
			var codigo = fecha.getFullYear();
			var fecha_hoy = fecha.getDate() + "/" + parseInt(fecha.getMonth()+1) + "/" + fecha.getFullYear();
			$('#codigo').val(codigo.toString().substr(2,2));
			$('#fecha').val(fecha_hoy);
		});		
	}
	
	if($("#accion").val() == "pedido")
	{
		$("#numero_pedido").autocomplete("ajax/busca_pedidos.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosPedido(data[1]);
		});
	}
    else if($("#accion").val() == "modificar")
    {
        $("#numero_factura").autocomplete("ajax/busca_facturas.php", { width: 150,max:100,scrollHeight: 200}).result(function(event, data, formatted)
		{
		 	cargaDatosFactura(data[1],0);
		});
    }
	else if($("#accion").val() == "duplicar")
    {
        $("#numero_factura").autocomplete("ajax/busca_facturas.php", { width: 150,max:100,scrollHeight: 200}).result(function(event, data, formatted)
		{
		 	cargaDatosFactura(data[1],1);
		});
    }
    else if($("#accion").val() == "modAbono")
    {
        $("#numero_factura").autocomplete("ajax/busca_abonos.php", { width: 150,max:100,scrollHeight: 350}).result(function(event, data, formatted)
		{
		 	cargaDatosFactura(data[1],0);
		});
    }
	
	if ($('#accion').val() == "abono" || $('#accion').val() == "modAbono")
	{
		$('#txtNumero').html('Número de Abono');
	}
    
    $("#empresa").autocomplete("ajax/busca_clientes.php", {width: 450,max:100,scrollHeight: 350}).result(function(event, data, formatted)
		{
		 	cargaDatosCliente(data[1]);
		});
	
    $('#boton_anterior').click(function(e)
    {
        var posicion = parseInt($('#posicion').val());
        posicion = posicion - 1;
        $.get("ajax/busca_direccionEnvio.php",{tabla:'cliente', id: $('#id_cliente').val(), posicion: posicion}, function(data){
               var datos = data.split("#");
			   $('#id_cliente_direccion_envio').val(datos[0]);
               $('#de_nombre').val(datos[1]);
               $('#de_direccion1').val(datos[2]);
               $('#de_direccion2').val(datos[3]);
               $('#de_cod_postal').val(datos[4]);
               $('#de_localidad').val(datos[5]);
               $('#de_provincia').val(datos[6]);
        });
        $('#posicion').val(posicion);
        if (posicion == 1)
        {
            $('#boton_anterior').css('display','none');
        }
        if (posicion < $('#total_direcciones').val())
        {
            $('#boton_siguiente').css('display','');
        }
    });
    
    $('#boton_siguiente').click(function(e)
    {
        var posicion = parseInt($('#posicion').val());
        posicion = posicion + 1;
        $.get("ajax/busca_direccionEnvio.php",{tabla:'cliente', id: $('#id_cliente').val(), posicion: posicion}, function(data){
               var datos = data.split("#");
			   $('#id_cliente_direccion_envio').val(datos[0]);
               $('#de_nombre').val(datos[1]);
               $('#de_direccion1').val(datos[2]);
               $('#de_direccion2').val(datos[3]);
               $('#de_cod_postal').val(datos[4]);
               $('#de_localidad').val(datos[5]);
               $('#de_provincia').val(datos[6]);
        });
        $('#posicion').val(posicion);
        if (posicion > 1)
        {
            $('#boton_anterior').css('display','');
        }
        if (posicion == $('#total_direcciones').val())
        {
            $('#boton_siguiente').css('display','none');
        }
    });
	
	$("#btn-ModificaCliente").click(function(e)
	{
		if ($('#id_cliente').val() != "")
		{
			$.post("ajax/actualiza_cliente.php",{
										id_cliente: $('#id_cliente').val(), 
										empresa: $('#empresa').val(), 
										direccion: $('#direccion').val(),
										localidad: $('#localidad').val(),
										provincia: $('#provincia').val(),
										cod_postal: $('#cod_postal').val(),
										telefono: $('#telefono').val(),
										fax: $('#fax').val(),
										tipo_cliente: $('#tipo_cliente').val(),
										numero_cuenta: $('#numero_cuenta').val(),
										cif: $('#cif').val(),
										forma_pago: $('#forma_pago').val()
										});
		
	 		$('#txtConfirmacion').html("Datos modificados correctamente");
	 		$('#txtConfirmacion').fadeIn(2000);
	 		$('#txtConfirmacion').fadeOut(2000);
		}
		else
		{
			alert("Introduzca un cliente");
		}
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
	
	$('#btn-NuevoCliente').click(function(e)
	{
		nuevoCliente();
	});
	
	$('#factura_proforma').click(function(e)
	{
		if ($('#factura_proforma').attr('checked') == true)
			var valor = 1;
		else
			var valor = 0;
		$.get("ajax/dame_numero_factura.php", {accion: $('#accion').val(),proforma: valor}, function(data)
		{
			if ($('#accion').val() == "duplicar")
				$('#nuevo_numero_factura').val(data);
			else
				$('#numero_factura').val(data);
		});
	});
});

function nuevoEquipo(id)
{
	var table = document.getElementById('tabla_equipos');
	var idRow=table.getElementsByTagName("TR").length+1;

	var tr = "<tr id='row_" + idRow + "'>\n";
	tr += "<td><input name='referencia_" + idRow + "' id='referencia_" + idRow + "' type='text' value='" + $('#referencia_nuevo').val() + "' /></td>\n";
	tr += "<td><textarea name='descripcion_" + idRow + "' id='descripcion_" + idRow + "' cols='0' rows='0'>" + $('#descripcion_nuevo').val() + "</textarea></td>\n";
	tr += "<td><input name='cantidad_" + idRow + "' id='cantidad_" + idRow + "' type='text' class='input01' value='" + $('#cantidad_nuevo').val() + "' /></td>\n";
	tr += "<td><input name='precio_" + idRow + "' id='precio_" + idRow + "' type='text' value='" + $('#precio_nuevo').val() + "' /></td>\n";
	tr += "<td><a href='#' onClick='buscar_equipos(\"" + idRow + "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;<a href='#' onClick='borraEquipo(\"" + idRow + "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a><input type='hidden' name='accion_" + idRow + "' id='accion_" + idRow + "' value='nuevo'/><input type='hidden' name='id_" + idRow + "' id='id_" + idRow + "' value=''/></td>\n";
	tr += "</tr>\n";
	
	$("#tabla_equipos").append(tr);
	
	num_equipos = parseInt(num_equipos) + 1;
	document.getElementById('num_equipos').value = num_equipos; 
    document.getElementById('referencia_nuevo').value = "";
    document.getElementById('descripcion_nuevo').value = "";
    document.getElementById('cantidad_nuevo').value = "";
    document.getElementById('precio_nuevo').value = "";
}

function cargaDatosPedido(id) {
	var valor = id;
    
    $.get("ajax/carga_pedido.php",{ id: valor}, function(data){
		var datos = data.split("#");
		$('#id_pedido').val(datos[0]);
		$('#su_referencia').val(datos[15]);
		$('#id_cliente').val(datos[11]);
		$('#id_cliente_direccion_envio').val(datos[12]);
           
		$.get("ajax/carga_cliente.php",{ id: datos[11],campos: 'facturas'}, function(data){
			var datos = data.split("#");
			$('#id_cliente').val(datos[0]);
			$('#empresa').val(datos[1]);
			$('#direccion').val(datos[2]);
			$('#localidad').val(datos[3]);
			$('#provincia').val(datos[4]);
			$('#cod_postal').val(datos[5]);
			$('#telefono').val(datos[6]);
			$('#fax').val(datos[7]);
			$('#numero_cuenta').val(datos[8]);
			$('#cif').val(datos[9]);
			$('#forma_pago').val(datos[10]);
		});

    	$.get("ajax/carga_direccionEnvio.php",{tabla:'cliente', id: datos[11], id_direccion: datos[12]}, function(data){
			var datos = data.split("#");
			$('#total_direcciones').val(datos[0]);
			$('#posicion').val(datos[1]);
			$('#de_nombre').val(datos[2]);
			$('#de_direccion1').val(datos[3]);
			$('#de_direccion2').val(datos[4]);
			$('#de_cod_postal').val(datos[5]);
			$('#de_localidad').val(datos[6]);
			$('#de_provincia').val(datos[7]);
			$('#id_cliente_direccion_envio').val(datos[8]);
           
           	if ($('#posicion').val() == '1')
           	{
            	$('#boton_anterior').css('display','none');
           	}
           
           	if ($('#posicion').val() == $('#total_direcciones').val())
           	{
                $('#boton_siguiente').css('display','none');
           	}
     	});
	});

    $.get("ajax/carga_pedidoEquipos.php",{ id: valor, vieneDe: 'facturas', accion: $('#accion').val()}, function(data){
        $('#tabla_equipos').append(data);
    });
    
    $.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'pedidos'}, function(data){
		num_equipos = data;
        $('#num_equipos').val(data);
    });
}

function cargaDatosCliente(id) {
	var valor = id;
 	$.get("ajax/carga_cliente.php",{ id: valor,campos: 'facturas'}, function(data){
   		var datos = data.split("#");
   		$('#id_cliente').val(datos[0]);
   		$('#empresa').val(datos[1]);
   		$('#direccion').val(datos[2]);
   		$('#localidad').val(datos[3]);
   		$('#provincia').val(datos[4]);
   		$('#cod_postal').val(datos[5]);
   		$('#telefono').val(datos[6]);
   		$('#fax').val(datos[7]);
		$('#numero_cuenta').val(datos[8]);
		$('#cif').val(datos[9]);
		$('#forma_pago').val(datos[10]);
 	});
	
    $.get("ajax/carga_direccionEnvio.php",{tabla:'cliente', id: valor, id_direccion: 0}, function(data){
		var datos = data.split("#");
		$('#total_direcciones').val(datos[0]);
		$('#posicion').val(datos[1]);
		$('#de_nombre').val(datos[2]);
		$('#de_direccion1').val(datos[3]);
		$('#de_direccion2').val(datos[4]);
		$('#de_cod_postal').val(datos[5]);
		$('#de_localidad').val(datos[6]);
		$('#de_provincia').val(datos[7]);
		$('#id_cliente_direccion_envio').val(datos[8]);
		
		if ($('#posicion').val() == '1')
		{
		    $('#boton_anterior').css('display','none');
		}
		
		if ($('#posicion').val() == $('#total_direcciones').val())
		{
		    $('#boton_siguiente').css('display','none');
		}
	});
}

function cargaDatosFactura(id,duplicar) {
    var valor = id;
	var dup = duplicar;
    $.get("ajax/carga_factura.php",{id:valor, duplicar:dup}, function(data){
        var datos = data.split("#");
        $('#id_factura').val(datos[0]);
        if (datos[1] != 0)
            $('#id_pedido').val(datos[1]);
        $('#numero_factura').val(datos[2]);
        $('#numero_pedido').val(datos[3]);
        $('#numero_albaran').val(datos[4]);
        $('#fecha').val(datos[5]);
        $('#iva').val(datos[6]);
        $('#id_cliente').val(datos[7]);
        $('#id_cliente_direccion_envio').val(datos[8]);
        $('#numero_cuenta').val(datos[9]);
        $('#obra').val(datos[10]);
        $('#porcentaje_retencion').val(datos[11]);
        if (datos[12] == 'con_iva')
            $('#tipo_retencionCI').attr('checked','true');
        if (datos[12] == 'sin_iva')
            $('#tipo_retencionSI').attr('checked','true');
        if (datos[13] == 1)
            $('#factura_en_origen').attr('checked','true');
        if (datos[14] == 1)
            $('#factura_en_dolares').attr('checked','true');
        if (datos[15] == 1)
            $('#factura_sin_iva').attr('checked','true');
        if (datos[16] == 1)
            $('#factura_proforma').attr('checked','true');            
        $('#es_abono').val(datos[17]);
        $('#su_referencia').val(datos[18]);
		$('#codigo').val(datos[19]);
        $('#aval').val(datos[20]);
        $('#forma_pago_manual').val(datos[21]);
        
        $.get("ajax/carga_cliente.php",{ id: datos[7]}, function(data){
       		var datos = data.split("#");
			$('#id_cliente').val(datos[0]);
			$('#empresa').val(datos[1]);
			$('#direccion').val(datos[2]);
			$('#localidad').val(datos[3]);
			$('#provincia').val(datos[4]);
			$('#cod_postal').val(datos[5]);
			$('#telefono').val(datos[6]);
			$('#fax').val(datos[7]);
			$('#cif').val(datos[9]);
			$('#forma_pago').val(datos[10]);
        });
         
        $.get("ajax/carga_direccionEnvio.php",{tabla:'cliente', id: datos[7], id_direccion: datos[8]}, function(data){
			var datos = data.split("#");
			$('#total_direcciones').val(datos[0]);
			$('#posicion').val(datos[1]);
			$('#de_nombre').val(datos[2]);
			$('#de_direccion1').val(datos[3]);
			$('#de_direccion2').val(datos[4]);
			$('#de_cod_postal').val(datos[5]);
			$('#de_localidad').val(datos[6]);
			$('#de_provincia').val(datos[7]);
			$('#id_cliente_direccion_envio').val(datos[8]);
			
			if ($('#posicion').val() == '1')
			{
			    $('#boton_anterior').css('display','none');
			}
               
           	if ($('#posicion').val() == $('#total_direcciones').val())
           	{
                $('#boton_siguiente').css('display','none');
           	}
		});
         
        $.get("ajax/carga_facturaEquipos.php",{ id: valor, accion: $('#accion').val()}, function(data){
            $('#tabla_equipos').append(data);
        });
        
        $.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'facturas'}, function(data){
			num_equipos = data;
            $('#num_equipos').val(data);
        });
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
    if ($('#accion').val() == "nuevo" || $('#accion').val() == "duplicar" || $('#accion').val() == "pedido" || $('#accion').val() == "abono")
		$('#accion_' + pos).val("nuevo");
	else if ($('#accion').val() == "modificar" || $('#accion').val() == "modAbono")
		$('#accion_' + pos).val("modificar");
		
	centerPopup();
    loadPopup();
    
    $('#div_popup').load("equipos.php?pos="+pos);
	$('#popup').css('display','block');
	return false;	
}

function toggle(elem)
{
    $('#fset_factura').css('display','none');
    $('#fset_cliente').css('display','none');
    $('#fset_dirEnvio').css('display','none');
    $('#fset_equipos').css('display','none');
    
    $('#'+elem).slideToggle("slow");
}

function nuevaDireccionEnvio()
{
	var id = $('#id_cliente').val();
		
	centerPopup();
    loadPopup();
    $("#popup").css({"width": 800});
    $("#popup").css({"height": 350});
    $('#div_popup').load("nueva_direccion_envio.php?tabla=cliente&id="+id);
	$('#popup').css('display','block');
}

function nuevoCliente()
{
	centerPopup();
    loadPopup();
    $("#popup").css({"width": 800});
    $("#popup").css({"height": 420});
    $('#div_popup').load("nuevo_cliente.php?vieneDe=facturas");
	$('#popup').css('display','block');
}

function checkBox(elem)
{
	//alert($(elem).attr('id'));
	if ($(elem).attr('id') == "factura_en_origen" && !quitarCheckBox)
	{
		quitarCheckBox = false;
		$('#factura_en_dolares').attr('checked',false);
		$('#factura_sin_iva').attr('checked',false);
		$('#factura_proforma').attr('checked',false);
	}
	else if ($(elem).attr('id') == "factura_en_dolares")
	{
		quitarCheckBox = true;
		$('#factura_en_origen').attr('checked',false);
		$('#factura_sin_iva').attr('checked',false);
		$('#factura_proforma').attr('checked',false);
	}
	else if ($(elem).attr('id') == "factura_sin_iva")
	{
		quitarCheckBox = true;
		$('#factura_en_origen').attr('checked',false);
		$('#factura_en_dolares').attr('checked',false);
		$('#factura_proforma').attr('checked',false);
	}
	else if ($(elem).attr('id') == "factura_proforma")
	{
		quitarCheckBox = true;
		$('#factura_en_origen').attr('checked',false);
		$('#factura_sin_iva').attr('checked',false);
		$('#factura_en_dolares').attr('checked',false);
	}

	/*if ($(elem).attr('checked'))
		$(elem).attr('checked',false);
	else
		$(elem).attr('checked',true);*/

	if (quitarCheckBox)
		$('#factura_en_origen').attr('checked',false);
		
	//quitarCheckBox = false;
}