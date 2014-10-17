var num_equipos = 0;

$().ready(function()
{
	if ($('#accion').val() == "guardar")
    {
        $("#popup").css({"width": 400});
        $("#popup").css({"height": 150});
        $("#div_popup").load("popup.php?tipo=ordencompra&id=" + $("#id_ordencompra").val());
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

	$('#btn-eligeProveedor').click(function(){
		eligeProveedor();
	});
	
    $(document).keypress(function(e){
        if(e.keyCode==27 && popupStatus==1){
            disablePopup();
        }
    });	
	
	$('#fset_proveedor').css('display','none');
    $('#fset_dirEnvio').css('display','none');
    $('#fset_equipos').css('display','none');
	
	$('#btn-DireccionEnvio').click(function(e)
	{
		nuevaDireccionEnvio();
	});	
	
	$("#btn-GuardaOrdenCompra").click(function(e)
	{
		var errores = "";
		
		if ($("#numero_orden").val() == '')
			errores = "- Número de orden\n";
		if ($("#fecha").val() == '')
			errores += "- Fecha\n";
		if ($("#id_proveedor").val() == '')
			errores += "- Proveedor\n";
			
		if (errores != "")
		{
			alert("Los siguientes campos no pueden estar vacíos: \n\n" + errores);
			return false;
		}
		$("#fOrdenCompra").submit();
	});
	
	if($("#accion").val() == "pedido")
	{
		$("#numero_pedido").autocomplete("ajax/busca_pedidos.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosPedidoProveedores(data[1]);
		});
		$('#div_proveedores').css('display','');
		$('#txtInstruccion').html("Introduce el número de pedido:");
	}
	else
	{
		$("#numero_ordencompra").autocomplete("ajax/busca_ordencompra.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosOrdenCompra(data[1]);
		});
		$('#div_proveedores').css('display','none');
		$('#txtInstruccion').html("Introduce el número de orden de compra:");
	}
	
	if($("#accion").val() == "nuevo")
	{
		$('#equiposOC').css('display','none');
	}
	else
	{
		$('#equiposOC').css('display','');
	}
	
	$("#proveedor").autocomplete("ajax/busca_proveedores.php", { width: 450}).result(function(event, data, formatted)
		{
		 	cargaDatosProveedor(data[1]);
		});
	
	$('#boton_anterior').click(function(e)
    {
        var posicion = parseInt($('#posicion').val());
        posicion = posicion - 1;
        $.get("ajax/busca_direccionEnvio.php",{tabla:'proveedor', id: $('#id_proveedor').val(), posicion: posicion}, function(data){
               var datos = data.split("#");
               $('#id_proveedor_direccion_envio').val(datos[0]);
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
        $.get("ajax/busca_direccionEnvio.php",{tabla:'proveedor', id: $('#id_proveedor').val(), posicion: posicion}, function(data){
               var datos = data.split("#");
               $('#id_proveedor_direccion_envio').val(datos[0]);
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
	
	$('#chkCondicionesPago').click(function(e)
	{
		chkCondicionesPago();
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
	
	$('#btn-NuevoProveedor').click(function(e)
	{
		nuevoProveedor();
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
		txtError += "Debes introducir un precio correcto.";
	}
    
	if (txtError != "")
	{
		alert(txtError);
		return false;
	}
	
	var table = document.getElementById('tabla_equipos_ordencompra');
	var idRow=table.getElementsByTagName("TR").length+1;

	var tr = "<tr id='row_" + idRow + "'>\n";
	tr += "<td><input name='referencia_" + idRow + "' id='referencia_" + idRow + "' type='text' value='" + $('#referencia_nuevo').val() + "' /></td>\n";
	tr += "<td><textarea name='descripcion_" + idRow + "' id='descripcion_" + idRow + "' cols='0' rows='0'>" + $('#descripcion_nuevo').val() + "</textarea></td>\n";
	tr += "<td><input name='cantidad_" + idRow + "' id='cantidad_" + idRow + "' type='text' class='input01' value='" + $('#cantidad_nuevo').val() + "' /></td>\n";
	tr += "<td><input name='precio_" + idRow + "' id='precio_" + idRow + "' type='text' value='" + $('#precio_nuevo').val() + "' /></td>\n";
	tr += "<td><a href='#' onClick='buscar_equipos(\"" + idRow + "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;<a href='#' onClick='borraEquipo(\"" + idRow + "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a><input type='hidden' name='accion_" + idRow + "' id='accion_" + idRow + "' value='nuevo'/><input type='hidden' name='id_" + idRow + "' id='id_" + idRow + "' value=''/></td>\n";
	tr += "</tr>\n";
	
	$("#tabla_equipos_ordencompra").append(tr);
	
    num_equipos = parseInt(num_equipos) + 1;
    document.getElementById('num_equipos_ordencompra').value = num_equipos; 
    document.getElementById('referencia_nuevo').value = "";
    document.getElementById('descripcion_nuevo').value = "";
    document.getElementById('cantidad_nuevo').value = "";
    document.getElementById('precio_nuevo').value = "";
}

function anadeEquipo(id)
{
	if (confirm(String.fromCharCode(191) + "Añadir este equipo?"))
	{
		var table = document.getElementById('tabla_equipos_ordencompra');
		var idRow = table.getElementsByTagName("TR").length + 1;
		
		var tr = "<tr id='row_" + idRow + "'>\n";
		tr += "<td><input name='referencia_" + idRow + "' id='referencia_" + idRow + "' type='text' value='" + $('#p_referencia_' + id).val() + "' /></td>\n";
		tr += "<td><textarea name='descripcion_" + idRow + "' id='descripcion_" + idRow + "' cols='0' rows='0'>" + $('#p_descripcion_' + id).val() + "</textarea></td>\n";
		tr += "<td><input name='cantidad_" + idRow + "' id='cantidad_" + idRow + "' type='text' class='input01' value='" + $('#p_cantidad_' + id).val() + "' /></td>\n";
		tr += "<td><input name='precio_" + idRow + "' id='precio_" + idRow + "' type='text' value='" + $('#p_importe_' + id).val() + "' /></td>\n";
		tr += "<td><a href='#' onClick='buscar_equipos(\"" + idRow + "\")' alt='Buscar equipo' title='Buscar equipo'><img src='img/buscar.jpg' height='20' width='20' border='0' /></a>&nbsp;<a href='#' onClick='borraEquipo(\"" + idRow + "\")' alt='Borrar equipo' title='Borrar equipo'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a><input type='hidden' name='accion_" + idRow + "' id='accion_" + idRow + "' value='nuevo'/><input type='hidden' name='id_" + idRow + "' id='id_" + idRow + "' value=''/></td>\n";
		tr += "</tr>\n";
		
		$("#tabla_equipos_ordencompra").append(tr);
	    num_equipos = parseInt(num_equipos) + 1;
    	document.getElementById('num_equipos_ordencompra').value = num_equipos; 		
	}
}

function cargaDatosPedidoProveedores(id) {
    var valor = id;
    $.get("ajax/carga_pedidoProveedores.php",{ id: valor, vieneDe: 'ordencompra'}, function(data){
        $('#tabla_pedido_proveedores').append(data);
    });
	$('#id_pedido').val(valor);
}


function eligeProveedor()
{
    var prov = $("input[@name='rdPedidoProveedor']:checked").val();
    if (prov > 0)
    {
        $('#fecha_entrega').val($('#fecha_entrega_' + prov).val());
		$('#fecha').val($('#fecha_' + prov).val());
		$('#numero_ordencompra').val($('#numero_' + prov).val());
        cargaEquiposPedido($('#id_pedido').val());
    }
    else
    {
        alert("Elige un proveedor");
    }
}

function cargaEquiposPedido(pedido)
{
    $.get("ajax/carga_pedidoEquipos.php",{ id: pedido, vieneDe: 'ordencompra'}, function(data){
        $('#tabla_equipos_pedido').append(data);
    });
}

function cargaDatosOrdenCompra(id)
{
    var valor = id;
    $.get("ajax/carga_ordencompra.php",{ id: valor}, function(data){
		var datos = data.split("#");
        $('#id_ordencompra').val(datos[0]);
        $('#id_pedido').val(datos[1]);
        $('#numero_ordencompra').val(datos[2]);
        $('#fecha').val(datos[4]);
        $('#id_proveedor').val(datos[5]);
        $('#id_proveedor_direccion_envio').val(datos[6]);
        $('#su_oferta').val(datos[7]);
        $('#fecha_entrega').val(datos[8]);
        $('#portes').val(datos[9]);
        var doc_suministrar = datos[10].split("@");
		for (var i = 1; i <= 3; i++)
		{
			if (doc_suministrar[i-1] == '1') 
				$('#chkDS' + i).attr('checked', 'true');
		}
        $('#documentacion_incluir').val(datos[11]);
		$('#condiciones_pago').val(datos[12]);		
        $('#responsable').val(datos[13]);
        $('#visto_bueno').val(datos[14]);

        $.get("ajax/dame_revision.php",{ tabla: 'ordencompra', valor: datos[3], accion: $('#accion').val()}, function(data){
			$('#revision').val(data);
		});
		
		$.get("ajax/carga_proveedor.php",{ id: datos[5]}, function(data){
               var datos = data.split("#");
               $('#proveedor').val(datos[1]);
               $('#direccion').val(datos[2]);
               $('#localidad').val(datos[3]);
               $('#provincia').val(datos[4]);
               $('#cod_postal').val(datos[5]);
               $('#telefono').val(datos[6]);
               $('#fax').val(datos[7]);
			   $('#persona_contacto').val(datos[8]);
        });
	 	
		$.get("ajax/carga_direccionEnvio.php",{tabla:'proveedor', id: datos[5], id_direccion: datos[6]}, function(data){
	       var datos = data.split("#");
	       $('#total_direcciones').val(datos[0]);
	       $('#posicion').val(datos[1]);
	       $('#de_nombre').val(datos[2]);
	       $('#de_direccion1').val(datos[3]);
	       $('#de_direccion2').val(datos[4]);
	       $('#de_cod_postal').val(datos[5]);
	       $('#de_localidad').val(datos[6]);
	       $('#de_provincia').val(datos[7]);
	       
	       if ($('#posicion').val() == '1')
	       {
	            $('#boton_anterior').css('display','none');
	       }
	       
	       if ($('#posicion').val() == $('#total_direcciones').val())
	       {
	            $('#boton_siguiente').css('display','none');
	       }
	    });
     
		 $.get("ajax/carga_pedidoEquipos.php",{ id: datos[1], vieneDe: 'ordencompra'}, function(data){
	        $('#tabla_equipos_pedido').append(data);
	     });
	     
	     $.get("ajax/carga_numeroEquipos.php",{ id: datos[1], tabla: 'pedidos'}, function(data){
	        $('#num_equipos_pedido').val(data);
	     });
	     
	     $.get("ajax/carga_ordencompraEquipos.php",{ id: valor, accion: $('#accion').val()}, function(data){
	        $('#tabla_equipos_ordencompra').append(data);
	     });
	     
	     $.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'ordencompra'}, function(data){
			num_equipos = data;
	        $('#num_equipos_ordencompra').val(data);
	     });
     });		 
}

function cargaDatosProveedor(id) {
	var valor = id;
 	$.get("ajax/carga_proveedor.php",{ id: valor}, function(data){
   		var datos = data.split("#");
   		$('#id_proveedor').val(datos[0]);
   		$('#empresa').val(datos[1]);
   		$('#direccion').val(datos[2]);
   		$('#localidad').val(datos[3]);
   		$('#provincia').val(datos[4]);
   		$('#cod_postal').val(datos[5]);
   		$('#telefono').val(datos[6]);
   		$('#fax').val(datos[7]);
		$('#persona_contacto').val(datos[8]);
 	});
	
	$.get("ajax/carga_direccionEnvio.php",{tabla:'proveedor', id: valor, id_direccion: '0'}, function(data){
       var datos = data.split("#");
       $('#total_direcciones').val(datos[0]);
       $('#posicion').val(datos[1]);
       $('#de_nombre').val(datos[2]);
       $('#de_direccion1').val(datos[3]);
       $('#de_direccion2').val(datos[4]);
       $('#de_cod_postal').val(datos[5]);
       $('#de_localidad').val(datos[6]);
       $('#de_provincia').val(datos[7]);
	   $('#id_proveedor_direccion_envio').val(datos[8]);
       
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
    $('#fset_orden').css('display','none');
    $('#fset_proveedor').css('display','none');
    $('#fset_dirEnvio').css('display','none');
    $('#fset_equipos').css('display','none');
    
    $('#'+elem).slideToggle("slow");
}

function nuevaDireccionEnvio()
{
	var id = $('#id_proveedor').val();
		
	centerPopup();
    loadPopup();
    $("#popup").css({"width": 800});
    $("#popup").css({"height": 350});
    $('#div_popup').load("nueva_direccion_envio.php?tabla=proveedor&id="+id);
	$('#popup').css('display','block');
}

function nuevoProveedor()
{
	centerPopup();
    loadPopup();
    $("#popup").css({"width": 800});
    $("#popup").css({"height": 420});
    $('#div_popup').load("nuevo_proveedor.php");
	$('#popup').css('display','block');
}