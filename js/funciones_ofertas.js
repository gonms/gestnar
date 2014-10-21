var num_equipos = 0;
var existeOferta = false;
	
$().ready(function()
{
	if ($('#accion').val() == "guardar")
    {
        $("#popup").css({"width": 400});
        $("#popup").css({"height": 150});
        $("#div_popup").load("popup.php?tipo=oferta&id=" + $("#id_oferta").val());
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
    $('#fset_equipos').css('display','none');
    
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
	
	$("#btn-GuardaOferta").click(function(e)
	{
		var errores = "";
		
		if ($("#numero_oferta").val() == '')
			errores = "- Número de oferta\n";
		if ($("#obra").val() == '')
			errores += "- Obra\n";
		if ($("#fecha_envio").val() == '')
			errores += "- Fecha de envío\n";
		if ($("#condiciones_pago1").val() == '')
			errores += "- Condiciones de pago\n";
		if ($("#plazo_entrega1").val() == '')
			errores += "- Plazo de entrega\n";
		if ($("#validez_oferta").val() == '')
			errores += "- Validez\n";
		if ($("#id_cliente").val() == '')
			errores += "- Cliente\n";
			
		if (errores != "")
		{
			alert("Los siguientes campos no pueden estar vacíos: \n\n" + errores);
			return false;
		}
		if (existeOferta)
		{
			alert("El n\u00famero de oferta ya existe.");
			return false;
		}
		$("#fOferta").submit();
	});
	
    if($("#accion").val() != "nuevo")
	{		
		$("#numero").autocomplete("ajax/busca_ofertas.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosOferta(data[1]);
		});
		
		$("#obra").autocomplete("ajax/busca_ofertas_obra.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosOferta(data[1]);
		});
	}
	else
	{
		$("#validez_oferta").val("60 días");
	}
	
	$("#empresa").autocomplete("ajax/busca_clientes.php", {width: 450,max:100,scrollHeight: 350}).result(function(event, data, formatted)
		{
		 	cargaDatosCliente(data[1]);
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
	
	$("#numero").blur(function()
	{
		if ($("#accion").val() == "nuevo")
		{
			$.get("ajax/busca_numero.php", {
				tabla: 'ofertas',
				numero: $(this).val()
			}, function(data){
				if (data == "true") 
				{
					alert("El n\u00famero de oferta ya existe.");
					existeOferta = true;
				}
				else
					existeOferta = false;
			});
		}
	});
    
    $("#nuevo_numero_oferta").blur(function()
	{
		if ($("#accion").val() == "duplicar")
		{
			$.get("ajax/busca_numero.php", {
				tabla: 'ofertas',
				numero: $(this).val()
			}, function(data){
				if (data == "true") 
				{
					alert("El n\u00famero de oferta ya existe.");
					existeOferta = true;
				}
				else
					existeOferta = false;
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
/*	var txtError = "";
	if ($('#cantidad_nuevo').val() == "" || $('#cantidad_nuevo').val() == "0")
	{
		txtError = "Debes introducir una cantidad correcta.\n\n";
	}	
	
	if ($('#precio_nuevo').val() == "" || $('#precio_nuevo').val() == "0")
	{
		txtError += "Debes introducir un precio correcto.";
	}
	
	if (txtError != "")
	{
		alert(txtError);
		return false;
	}*/
	
	var table = document.getElementById('tabla_equipos');
	var idRow=table.getElementsByTagName("TR").length+1;

	var tr = "<tr id='row_" + idRow + "'>\n";
	tr += "<td><input name='referencia_" + idRow + "' id='referencia_" + idRow + "' type='text' value='" + $('#referencia_nuevo').val() + "' /></td>\n";
	tr += "<td><textarea name='descripcion_" + idRow + "' id='descripcion_" + idRow + "' cols='0' rows='0'>" + $('#descripcion_nuevo').val() + "</textarea></td>\n";
	tr += "<td><input name='cantidad_" + idRow + "' id='cantidad_" + idRow + "' type='text' class='input01' value='" + $('#cantidad_nuevo').val() + "' /></td>\n";
	tr += "<td><input name='descuento_" + idRow + "' id='descuento_" + idRow + "' type='text' class='input01' value='" + $('#descuento_nuevo').val() + "' /></td>\n";
	tr += "<td><input name='precio_" + idRow + "' id='precio_" + idRow + "' type='text' value='" + $('#precio_nuevo').val() + "' /></td>\n";
	tr += "<td>\n";
	tr += "	<a href='#' onClick='buscar_equipos(\"" + idRow + "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>\n";
//	tr += "	&nbsp;<a href='#' onClick='modificaEquipo(\"" + idRow + "\")' alt='Modificar equipo' title='Modificar equipo'><img src='img/modificar.jpg' height='20' width='20' border='0'/></a>\n";
	tr += "	&nbsp;<a href='#' onClick='borraEquipo(\"" + idRow + "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>\n";
	tr += "	<input type='hidden' name='accion_" + idRow + "' id='accion_" + idRow + "' value='nuevo'/>\n";
	tr += "	<input type='hidden' name='id_" + idRow + "' id='id_" + idRow + "' value=''/></td>\n";
	tr += "</tr>\n";
	
	$("#tabla_equipos").append(tr);
	
    num_equipos = parseInt(num_equipos) + 1;
	document.getElementById('num_equipos').value = num_equipos; 
    document.getElementById('referencia_nuevo').value = "";
    document.getElementById('descripcion_nuevo').value = "";
    document.getElementById('cantidad_nuevo').value = "";
    document.getElementById('descuento_nuevo').value = "";
    document.getElementById('precio_nuevo').value = "";
}

function cargaDatosOferta(id) {
	var valor = id;
 	$.get("ajax/carga_oferta.php",{ id: valor}, function(data){
   		var datos = data.split("#");
   		var aPlazo = datos[7].split("@");
		var aCondiciones = datos[6].split("@");
   		$('#id_oferta').val(datos[0]);
   		$('#numero').val(datos[1]);
   		$('#obra').val(datos[2]);
   		$('#codigo').val(datos[3]);
   		$('#departamento').val(datos[4]);
   		$('#fecha_recepcion').val(datos[5]);
   		$('#condiciones_pago1').val(aCondiciones[0]);
		$('#condiciones_pago2').val(aCondiciones[1]);
   		$('#plazo_entrega1').val(aPlazo[0]);
		$('#plazo_entrega2').val(aPlazo[1]);
   		$('#embalaje').val(datos[8]);
   		$('#fecha_envio').val(datos[9]);
   		$('#mercancia_franco').val(datos[10]);
   		$('#validez_oferta').val(datos[11]);
   		$('#tipo').val(datos[12]);
   		$('#situacion').val(datos[13]);
   		/*$('#descuento').val(datos[14]);*/
   		$('#iva').val(datos[14]);
   		$('#tipo_oferta').val(datos[18]);
   		
		$.get("ajax/dame_revision.php",{ tabla: 'oferta', valor: datos[17], accion: $('#accion').val(), numero: datos[1], codigo: datos[3]}, function(data){
			$('#extra').val(data);
		});
		
   		$.get("ajax/carga_cliente.php",{ id: datos[15]}, function(data){
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
 	
 		$.get("ajax/carga_clienteContactos.php",{ id: datos[15], id_contacto: datos[16], vieneDe: 'ofertas'}, function(data){
 			$('#id_contacto').html(data);
 			$('#id_contacto').val(datos[17]);
 		});
 	});
 	
 	$.get("ajax/carga_ofertaEquipos.php",{ id: valor, pagina: 'ofertas', accion: $('#accion').val()}, function(data){
 		$('#tabla_equipos').append(data);
 	});
 	
 	$.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'ofertas'}, function(data){
 		num_equipos = data;
		$('#num_equipos').val(data);
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
 	$.get("ajax/carga_clienteContactos.php",{ id: valor, vieneDe: 'ofertas'}, function(data){
 		$('#id_contacto').html(data);
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
    if ($('#accion').val() == "nuevo" || $('#accion').val() == "duplicar" || $('#accion').val() == "revision")
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
    $('#fset_oferta').css('display','none');
    $('#fset_cliente').css('display','none');
    $('#fset_equipos').css('display','none');

    $('#'+elem).slideToggle("slow");
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