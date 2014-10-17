var num_equipos = 0;
var existeAlbaran = false;

$().ready(function()
{
	if ($('#accion').val() == "guardar")
    {
        $("#popup").css({"width": 400});
        $("#popup").css({"height": 150});
        $("#div_popup").load("popup.php?tipo=albaran&id=" + $("#id_albaran").val());
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
	
	$('#tipo').change(function()
	{
		if ($(this).val() == "no_valorado")
		{
			$('#lIVA').css('display', 'none');
			$('th.texto').html("Peso");
		}
		else
		{ 
			$('#lIVA').css('display', '');
			$('th.texto').html("Importe");
		}		
	});
    
	$('#fset_cliente').css('display','none');
	$('#fset_equipos').css('display','none');

	$("#btn-GuardaAlbaran").click(function(e)
	{
		var errores = "";
		
		if ($("#numero_albaran").val() == '')
			errores = "- Número de albarán\n";
		if ($("#fecha").val() == '')
			errores += "- Fecha\n";
		if ($("#destinatario1").val() == '')
			errores += "- Destinatario\n";
		if ($("#contacto1").val() == '')
			errores += "- P. Contacto\n";
			
		if (errores != "")
		{
			alert("Los siguientes campos no pueden estar vacíos: \n\n" + errores);
			return false;
		}
		
		if (existeAlbaran)
		{
			alert("El n\u00famero de albarán ya existe.");
			return false;
		}
		
		$("#fAlbaran").submit();
	});
	
	if($("#accion").val() == "pedido")
	{
		$("#numero_pedido").autocomplete("ajax/busca_pedidos.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosPedido(data[1]);
		});
	}
	else if($("#accion").val() == "modificar")
	{
		$("#numero_albaran").autocomplete("ajax/busca_albaran.php", { width: 150}).result(function(event, data, formatted)
		{
		 	cargaDatosAlbaran(data[1]);
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
    
    $("#numero_albaran").blur(function(){        
        
        if ($("#accion").val() != "modificar")
		{
			$.get("ajax/busca_numero.php", {
				tabla: 'albaranes',
				numero: $(this).val()
			}, function(data){
				if (data == "true") 
				{
					alert("El n\u00famero de albarán ya existe.");
					existeAlbaran = true;
				}
				else
					existeAlbaran = false;
			});
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
	});
	
    $.get("ajax/carga_pedidoEquipos.php",{ id: valor, vieneDe: 'albaran', accion: $('#accion').val()}, function(data){
        $('#tabla_equipos').append(data);
    });
    
    $.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'pedidos'}, function(data){
		num_equipos = data;
        $('#num_equipos').val(data);
     });
}

function cargaDatosAlbaran(id) {
    var valor = id;
     $.get("ajax/carga_albaran.php",{ id: valor}, function(data){
        var datos = data.split("#");
           
        $('#id_albaran').val(datos[0]);
        $('#numero_albaran').val(datos[1]);
		$('#numero_pedido').val(datos[2]);        
        $('#fecha').val(datos[3]);
        $('#asunto').val(datos[4]);
        $('#enviado').val(datos[5]);
		$('#tipo').val(datos[6]);
        $('#iva').val(datos[7]);
		$('#id_pedido').val(datos[8]);
		var destinatario = datos[9].split("@");
		for (var i=0;i<4;i++)
		{
			var pos = i+1;
			$('#destinatario' + pos).val(destinatario[i])
		}
		var contacto = datos[10].split("@");
		for (var i=0;i<2;i++)
		{
			var pos = i+1;
			$('#contacto' + pos).val(contacto[i])
		}

		if (datos[8] == "0")
			$('#lPedido').css('display','none');
		else
			$('#lPedido').css('display','');
		
		if (datos[6] == "no_valorado")
			$('#lIVA').css('display','none');
		else
			$('#lIVA').css('display','');
     });
	 
     $.get("ajax/carga_albaranEquipos.php",{ id: valor, accion: $('#accion').val()}, function(data){
         $('#tabla_equipos').append(data);
     });
     
     $.get("ajax/carga_numeroEquipos.php",{ id: valor, tabla: 'albaran'}, function(data){
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
    if ($('#accion').val() == "nuevo" || $('#accion').val() == "pedido")
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
    $('#fset_albaran').css('display','none');
    $('#fset_cliente').css('display','none');
   	$('#fset_equipos').css('display','none');	

    $('#'+elem).slideToggle("slow");
}