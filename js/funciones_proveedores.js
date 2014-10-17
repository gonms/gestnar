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
    	
	$('#btn-DireccionEnvio').click(function(e)
	{
		nuevaDireccionEnvio();
	});
	
	$('#btn-NuevoProveedor').click(function(e)
	{
		nuevoProveedor();
	});	
	
	$("#empresa").autocomplete("ajax/busca_proveedores.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosProveedor(data[1]);
		});
    
    
	$('#boton_anterior').css('display','none');
	$('#boton_siguiente').css('display','none');
	$('#btn-ModificaProveedor').css('display','none');
	
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

    $("#btn-ModificaProveedor").click(function(e)
	{
		$.post("ajax/actualiza_proveedor.php",{id_proveedor: $('#id_proveedor').val(), empresa: $('#empresa').val(), direccion: $('#direccion').val(),localidad: $('#localidad').val(),provincia: $('#provincia').val(),cod_postal: $('#cod_postal').val(),telefono: $('#telefono').val(),fax: $('#fax').val(),contacto: $('#contacto').val()});
		
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
		$('#contacto').val(datos[8]);
 	});
	
	$.get("ajax/carga_direccionEnvio.php",{tabla:'proveedor', id: valor}, function(data){
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

	
	$('#btn-ModificaProveedor').css('display','');
}

function toggle(elem)
{
    $('#fset_proveedor').css('display','none');
    $('#fset_dirEnvio').css('display','none');
    
    $('#'+elem).slideToggle("slow");
}

function nuevaDireccionEnvio()
{
	if ($('#id_proveedor').val() == "")
	{
		alert("Tienes que cargar un proveedor antes de añadir una dirección");
		return false;
	}
	
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
    $("#popup").css({"height": 500});
    $('#div_popup').load("nuevo_registro.php?tabla=proveedor");
	$('#popup').css('display','block');
}