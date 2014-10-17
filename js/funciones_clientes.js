$().ready(function()
{
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
	
    $('#fset_dirEnvio').css('display','none');
    $('#fset_contacto').css('display','none');
    	
	$('#btn-DireccionEnvio').click(function(e)
	{
		nuevaDireccionEnvio();
	});
	
	$('#btn-NuevoCliente').click(function(e)
	{
		nuevoCliente();
	});	
	
	$('#btn-NuevoContacto').click(function(e)
	{
		nuevoContacto();
	});
	
	
	$("#empresa").autocomplete("ajax/busca_clientes.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosCliente(data[1]);
		});
    
    
	$('#boton_anterior').css('display','none');
	$('#boton_siguiente').css('display','none');
	$('#btn-ModificaCliente').css('display','none');
	
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
		$.post("ajax/actualiza_cliente.php",{id_cliente: $('#id_cliente').val(), empresa: $('#empresa').val(), direccion: $('#direccion').val(),localidad: $('#localidad').val(),provincia: $('#provincia').val(),cod_postal: $('#cod_postal').val(),telefono: $('#telefono').val(),fax: $('#fax').val(),cif: $('#cif').val(),forma_pago: $('#forma_pago').val(),email: $('#email').val(),tipo_cliente: 'ficheros'});
		
 		$('#txtConfirmacion').html("Datos modificados correctamente");
 		$('#txtConfirmacion').fadeIn(2000);
 		$('#txtConfirmacion').fadeOut(2000);
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

function cargaDatosCliente(id) {
	var valor = id;
 	$.get("ajax/carga_cliente.php",{ id: valor, campos: 'todos'}, function(data){
   		var datos = data.split("#");
   		$('#id_cliente').val(datos[0]);		
   		$('#empresa').val(datos[1]);
   		$('#direccion').val(datos[2]);
   		$('#localidad').val(datos[3]);
   		$('#provincia').val(datos[4]);
   		$('#cod_postal').val(datos[5]);
   		$('#telefono').val(datos[6]);
   		$('#fax').val(datos[7]);
		$('#cif').val(datos[8]);
		$('#forma_pago').val(datos[9]);
		$('#email').val(datos[10]);
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
		else
		{
			$('#boton_anterior').css('display','');
		}
       
		if ($('#posicion').val() == $('#total_direcciones').val())
		{
		    $('#boton_siguiente').css('display','none');
		}
		else
		{
			$('#boton_siguiente').css('display','');
		}

       	if ($('#total_direcciones').val() == 0)
		{
			$('#boton_anterior').css('display','none');
			$('#boton_siguiente').css('display','none');
		}		
	});

	$.get("ajax/carga_clienteContactos.php",{ id: valor, vieneDe: 'ficheros'}, function(data){
		$('#div_contactos').append(data);
 	});
	
	$('#btn-ModificaCliente').css('display','');
}

function toggle(elem)
{
    $('#fset_cliente').css('display','none');
    $('#fset_dirEnvio').css('display','none');
    $('#fset_contacto').css('display','none');
    
    $('#'+elem).slideToggle("slow");
}

function nuevaDireccionEnvio()
{
	if ($('#id_cliente').val() == "")
	{
		alert("Tienes que cargar un cliente antes de añadir una direcci\u00f3n");
		return false;
	}
	
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
    $("#popup").css({"height": 500});
    $('#div_popup').load("nuevo_registro.php?tabla=cliente");
	$('#popup').css('display','block');
}

function modificaContacto(id_contacto)
{
	$.post("ajax/guarda_clienteContactos.php",{id: id_contacto, nombre: $('#contacto_' + id_contacto).val(), accion: 'modificar'}, function(data){
		if (data == "OK")
		{
			alert("Contacto modificado correctamente");
		}
		else
		{
			alert("Ocurri\u00f3 un error al modificar los datos");
		}
	});
}

function nuevoContacto()
{
	if ($('#id_cliente').val() == "")
	{
		alert("Tienes que cargar un cliente antes de añadir el contacto");
		return false;
	}
	
	if ($('#contacto_nuevo').val() == "")
	{
		alert("Tienes que escribir el nombre del contacto");
		return false;
	}
		
	$.post("ajax/guarda_clienteContactos.php",{id_cliente: $('#id_cliente').val(), nombre: $('#contacto_nuevo').val(), accion: 'nuevo'}, function(data){
		var datos = data.split("#");
		if (datos[1] > 0)
		{
			alert("Contacto añadido correctamente");
			
			$.get("ajax/carga_clienteContactos.php",{ id: $('#id_cliente').val(), vieneDe: 'ficheros'}, function(data){
				$('#div_contactos').html(data);
				$('#contacto_nuevo').val("");
			});
		}
		else
		{
			alert("Ocurri\u00f3 un error al añadir el contacto");
		}
	});
}