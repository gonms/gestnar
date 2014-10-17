var num_equipos = 0;
var existePedido = false;

$().ready(function()
{
	if ($('#accion').val() == "guardar")
    {
        $("#popup").css({"width": 400});
        $("#popup").css({"height": 150});
        $("#div_popup").load("popup.php?tipo=pedido&id=" + $("#id_pedido").val());
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
    $('#fset_proveedores').css('display','none');
    $('#fset_requerimientos').css('display','none');
    	
	$('#btn-DireccionEnvio').click(function(e)
	{
		nuevaDireccionEnvio();
	});
	
	$("#btn-ModificaCliente").click(function(e)
	{
		if ($('#id_cliente').val() != "")
		{
			$.post("ajax/actualiza_cliente.php",{id_cliente: $('#id_cliente').val(), empresa: $('#empresa').val(), direccion: $('#direccion').val(),localidad: $('#localidad').val(),provincia: $('#provincia').val(),cod_postal: $('#cod_postal').val(),telefono: $('#telefono').val(),fax: $('#fax').val(),tipo_cliente: $('#tipo_cliente').val()});
		
			if ($('#id_contacto').val() == "nuevo")
			{
				$.post("ajax/guarda_clienteContactos.php",{id_cliente: $('#id_cliente').val(), nombre: $('#persona_contacto_nuevo').val()}, function(data){
					var datos = data.split('#');
					$.get("ajax/carga_clienteContactos.php",{ id: datos[0], id_contacto: datos[1]}, function(data){
		 				$('#id_contacto').html(data);
		 				$('#id_contacto').val(datos[1]);
		 				$("#div_persona_contacto").hide();
		 			});
		 		});
	 		}
	 		$('#txtConfirmacion').html("Datos modificados correctamente");
	 		$('#txtConfirmacion').fadeIn(2000);
	 		$('#txtConfirmacion').fadeOut(2000);
		}
		else
		{
			alert("Introduzca un cliente");
		}
	});
	
	$("#btn-GuardaPedido").click(function(e)
	{
		var errores = "";
		
		if ($("#numero_pedido").val() == '')
			errores = "- Número de pedido\n";
		if ($("#codigo_pedido").val() == '')
			errores += "- Código de pedido\n";
		if ($("#fecha").val() == '')
			errores += "- Fecha\n";
		if ($("#forma_pago1").val() == '')
			errores += "- Forma de pago\n";
		if ($("#fecha_envio").val() == '')
			errores += "- Fecha de envío\n";
		if ($("#id_cliente").val() == '')
			errores += "- Cliente\n";
			
		if (errores != "")
		{
			alert("Los siguientes campos no pueden estar vacíos: \n\n" + errores);
			return false;
		}
		if (existePedido)
		{
			alert("El n\u00famero de pedido ya existe.");
			return false;
		}
		$("#fPedido").submit();
	});
	
	if($("#accion").val() == "nuevo")
	{
		$("#numero_oferta").autocomplete("ajax/busca_ofertas.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosOferta(data[1]);
		});
		var anio = new Date();
		anio = anio.getFullYear().toString();
		anio = anio.substring(2);
		$("#codigo_pedido").val("P/" + anio);
	}
	else
	{
		$("#numero_pedido").autocomplete("ajax/busca_pedidos.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosPedido(data[1]);
		});
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
	
	$('#id_contacto').change(function()
	{
		if ($('#id_cliente').val() == "")
		{
			alert("Selecciona un cliente antes de elegir persona de contacto");
			$('#id_contacto').val("");
			return false;
		}
		var valor = $(this).val();
		
		if (valor == "nuevo")
		{
			$("#div_persona_contacto").show();
		}
		else
		{
			$("#div_persona_contacto").hide();
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
	
	$("#numero_pedido").blur(function()
	{
		if ($("#accion").val() == "nuevo")
		{
			$.get("ajax/busca_numero.php", {
				tabla: 'pedidos',
				numero: $(this).val()
			}, function(data){
				if (data == "true") 
				{
					alert("El n\u00famero de pedido ya existe.");
					existePedido = true;
				}
				else
					existePedido = false;
			});
		}
	});
	
	$('#btn-NuevoCliente').click(function(e)
	{
		nuevoCliente();
	});
});

function nuevoEquipo(id)
{
	var txtError = "";
	if ($('#cantidad_nuevo').val() == "" || $('#cantidad_nuevo').val() == "0")
	{
		txtError = "Debes introducir una cantidad correcta.\n\n";
	}	
	
	if ($('#precio_nuevo').val() == "" || $('#precio_nuevo').val() == "0")
	{
		txtError += "Debes introducir un precio de venta correcto.";
	}
    
    if ($('#precio_coste_nuevo').val() == "" || $('#precio_coste_nuevo').val() == "0")
    {
        txtError += "Debes introducir un precio de coste correcto.";
    }
	
	if (txtError != "")
	{
		alert(txtError);
		return false;
	}
	
	var table = document.getElementById('tabla_equipos');
	var idRow=table.getElementsByTagName("TR").length+1;

	var tr = "<tr id='row_" + idRow + "'>\n";
	tr += "<td><input name='referencia_" + idRow + "' id='referencia_" + idRow + "' type='text' size='10' value='" + $('#referencia_nuevo').val() + "' /></td>\n";
	tr += "<td><textarea name='descripcion_" + idRow + "' id='descripcion_" + idRow + "' cols='2' rows='0'>" + $('#descripcion_nuevo').val() + "</textarea></td>\n";
	tr += "<td><input name='cantidad_" + idRow + "' id='cantidad_" + idRow + "' type='text' value='" + $('#cantidad_nuevo').val() + "' class='input01' /></td>\n";
	tr += "<td><input name='precio_" + idRow + "' id='precio_" + idRow + "' type='text' size='4' value='" + $('#precio_nuevo').val() + "' /></td>\n";
	tr += "<td><input name='precio_coste_" + idRow + "' id='precio_coste_" + idRow + "' type='text' size='7' value='" + $('#precio_coste_nuevo').val() + "' /></td>\n";
	tr += "<td><a href='#' onClick='buscar_equipos(\"" + idRow + "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;<a href='#' onClick='borraEquipo(\"" + idRow + "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a><input type='hidden' name='accion_" + idRow + "' id='accion_" + idRow + "' value='nuevo'/><input type='hidden' name='id_" + idRow + "' id='id_" + idRow + "' value=''/></td>\n";
	tr += "</tr>\n";
	
	$("#tabla_equipos").append(tr);
	
    num_equipos = parseInt(num_equipos) + 1;
	document.getElementById('num_equipos').value = num_equipos; 
    document.getElementById('referencia_nuevo').value = "";
    document.getElementById('descripcion_nuevo').value = "";
    document.getElementById('cantidad_nuevo').value = "";
    document.getElementById('precio_nuevo').value = "";
    document.getElementById('precio_coste_nuevo').value = "";
}

function cargaDatosOferta(id) {
	var valor = id;
 	$.get("ajax/carga_oferta.php",{ id: valor}, function(data){
   		var datos = data.split("#");
   		
   		$('#id_oferta').val(datos[0]);
		var fecha = new Date();
		var codigo = "P/" + fecha.getFullYear().toString().substring(2,4);
		$('#codigo_pedido').val(codigo);
   		  		
   		$.get("ajax/carga_cliente.php",{ id: datos[16]}, function(data){
	   		var datos = data.split("#");
	   		$('#id_cliente').val(datos[0]);
	   		$('#empresa').val(datos[1]);
	   		$('#direccion').val(datos[2]);
	   		$('#localidad').val(datos[3]);
	   		$('#provincia').val(datos[4]);
	   		$('#cod_postal').val(datos[5]);
	   		$('#telefono').val(datos[6]);
	   		$('#fax').val(datos[7]);
 		});

		$.get("ajax/carga_clienteContactos.php",{ id: datos[16], id_contacto: datos[17]}, function(data){
 			$('#id_contacto').html(data);
 			$('#id_contacto').val(datos[17]);
 		});
		
		$.get("ajax/carga_direccionEnvio.php",{tabla:'cliente', id: datos[16]}, function(data){
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
 	
 	$.get("ajax/carga_ofertaEquipos.php",{ id: valor, pagina: 'pedidos', accion: $('#accion').val()}, function(data){
 		$('#tabla_equipos').append(data);
 	});
 	
 	$.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'ofertas'}, function(data){
		num_equipos = data;
 		$('#num_equipos').val(data);
 	});
}

function cargaDatosPedido(id) {
	var valor = id;
     $.get("ajax/carga_pedido.php",{ id: valor}, function(data){
        var datos = data.split("#");
        $('#id_pedido').val(datos[0]);
        $('#id_oferta').val(datos[1]);
        $('#numero_pedido').val(datos[2]);
        $('#codigo_pedido').val(datos[3]);
        $('#fecha').val(datos[5]);
		var forma_pago = datos[6].split("@");
        $('#forma_pago1').val(forma_pago[0]);
		$('#forma_pago2').val(forma_pago[1]);
        if (datos[7] > 0)
			$('#porcentaje_agente').val(datos[7]);
        $('#agente').val(datos[8]);
        var requerimientos = datos[9].split("@");
        for (var i=1;i<=20;i++)
        {
            if (requerimientos[i-1] == '1')
                $('#chkReq' + i).attr('checked','true');
        }
        $('#id_cliente').val(datos[10]);
        $('#id_cliente_direccion_envio').val(datos[11]);
        $('#fecha_envio').val(datos[13]);
        $('#su_referencia').val(datos[14]);
        $('#de_fecha').val(datos[15]);
        $('#portes').val(datos[16]);
		$('#numero_oferta').val(datos[17]);

		$.get("ajax/dame_revision.php",{ tabla: 'pedido', valor: datos[4], accion: $('#accion').val()}, function(data){
			$('#revision').val(data);
		});

        $.get("ajax/carga_cliente.php",{ id: datos[10]}, function(data){
               var datos = data.split("#");
               $('#empresa').val(datos[1]);
               $('#direccion').val(datos[2]);
               $('#localidad').val(datos[3]);
               $('#provincia').val(datos[4]);
               $('#cod_postal').val(datos[5]);
               $('#telefono').val(datos[6]);
               $('#fax').val(datos[7]);
         });
		 
		 $.get("ajax/carga_clienteContactos.php",{ id: datos[10], id_contacto: datos[12]}, function(data){
 			$('#id_contacto').html(data);
 			$('#id_contacto').val(datos[13]);
 		});
         
         $.get("ajax/carga_direccionEnvio.php",{tabla:'cliente', id: datos[10], id_direccion: datos[11]}, function(data){
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
     
     $.get("ajax/carga_pedidoEquipos.php",{ id: valor, vieneDe: 'pedidos', accion: $('#accion').val()}, function(data){
         $('#tabla_equipos').append(data);
     });
     
     $.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'pedidos'}, function(data){
	 	num_equipos = data;
        $('#num_equipos').val(data);
     });
     
     $.get("ajax/carga_pedidoProveedores.php",{ id: valor, vieneDe: 'pedidos', accion: $('#accion').val()}, function(data){
         $('#tabla_proveedores').append(data);
     });
     
     $.get("ajax/carga_numeroProveedores.php",{ id: valor}, function(data){
         $('#num_proveedores').val(data);
     });
}

function cargaDatosCliente(id) {
	var valor = id;
 	$.get("ajax/carga_cliente.php",{ id: valor}, function(data){
   		var datos = data.split("#");
   		$('#id_cliente').val(datos[0]);		
   		$('#empresa').val(datos[1]);
   		$('#direccion').val(datos[2]);
   		$('#localidad').val(datos[3]);
   		$('#provincia').val(datos[4]);
   		$('#cod_postal').val(datos[5]);
   		$('#telefono').val(datos[6]);
   		$('#fax').val(datos[7]);
 	});
	
 	$.get("ajax/carga_clienteContactos.php",{ id: valor}, function(data){
 		$('#id_contacto').html(data);
 	});
	
	$.get("ajax/carga_direccionEnvio.php",{tabla:'cliente', id: valor}, function(data){
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

function nuevoProveedor()
{	
	var table = document.getElementById('tabla_proveedores');
	var idRow=table.getElementsByTagName("TR").length;

	var tr = "<tr id='row_prov_" + idRow + "'>\n";
	tr += "<td><input type='text' id='prov_empresa_" + idRow + "' name='prov_empresa_" + idRow + "' value='" + $('#prov_empresa_nuevo').val() + "' class='input02' /></td>\n";
	tr += "<td><input type='text' id='prov_numero_" + idRow + "' name='prov_numero_" + idRow + "' value='" + $('#prov_numero_nuevo').val() + "'/></td>\n";
	tr += "<td><input type='text' id='prov_fecha_" + idRow + "' name='prov_fecha_" + idRow + "' value='" + $('#prov_fecha_nuevo').val() + "'/></td>\n";
	tr += "<td><input type='text' id='prov_importe_" + idRow + "' name='prov_importe_" + idRow + "' value='" + $('#prov_importe_nuevo').val() + "'/></td>\n";
	tr += "<td><input type='text' id='prov_fecha_entrega_" + idRow + "' name='prov_fecha_entrega_" + idRow + "' value='" + $('#prov_fecha_entrega_nuevo').val() + "'/></td>\n";
	tr += "<td><a href='#' onClick='borraPedidoProv(\"" + idRow + "\");' alt='Borrar pedido proveedores' title='Borrar pedido proveedores'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>";
	tr += "<input type='hidden' name='accion_prov_" + idRow + "' id='accion_prov_" + idRow + "' value='nuevo'/><input type='hidden' name='id_prov_" + idRow + "' id='id_prov_" + idRow + "' value=''/></td>\n";
	tr += "</tr>\n";
	
	$("#tabla_proveedores").append(tr);
	
    document.getElementById('num_proveedores').value = idRow; 
    document.getElementById('prov_empresa_nuevo').value = "";
    document.getElementById('prov_numero_nuevo').value = "";
    document.getElementById('prov_fecha_nuevo').value = "";
    document.getElementById('prov_importe_nuevo').value = "";
    document.getElementById('prov_fecha_entrega_nuevo').value = "";
	
	sacaNumeroProveedor();
}

function modificaEquipo(pos)
{
	if ($('#accion_' + pos).val() == 'nuevo') {
		$('#accion_' + pos).val('nuevo');
	}
	else {
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

function borraPedidoProv(pos)
{
	if (confirm(String.fromCharCode(191) + "Borrar este pedido a proveedores?"))
	{
		if($('#accion_prov_' + pos).val() == 'nuevo')
		{
			$('#accion_prov_' + pos).val('noguardar');
		}
		else
		{
			$('#accion_prov_' + pos).val('borrar');
		}
		$('#row_prov_' + pos).fadeOut(1000);
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
    $('#fset_pedido').css('display','none');
    $('#fset_cliente').css('display','none');
    $('#fset_dirEnvio').css('display','none');
    $('#fset_equipos').css('display','none');
    $('#fset_proveedores').css('display','none');
    $('#fset_requerimientos').css('display','none');
    
    $('#'+elem).slideToggle("slow");
}

function sacaNumeroProveedor()
{
	var table = document.getElementById('tabla_proveedores');
	var idRow=table.getElementsByTagName("TR").length;
	var numero = $('#codigo_pedido').val() + "-" + $('#numero_pedido').val() + "-" + idRow;
	$('#prov_numero_nuevo').val(numero);
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
    $('#div_popup').load("nuevo_cliente.php");
	$('#popup').css('display','block');
}