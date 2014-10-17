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
	
    $('#seccion').change(function(e)
	{
		if ($('#seccion').val() != "")
		{
			$.get("ajax/carga_revision.php",{seccion: $('#seccion').val()},function(data)
			{
				$('#div_revisiones').html(data);
			});
		}
		else
		{
			$('#div_revisiones').html("");
		}
	})
	
	$('#btn-NuevaRevision').click(function(e)
	{
		nuevaRevision();
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

function nuevaRevision()
{
	if ($('#seccion').val() == "")
	{
		alert("Tienes que elegir la opción a la que añadir la revisión");
		return false;
	}
	
	if ($('#fecha').val() == "")
	{
		alert("Tienes que introducir la fecha de la revisión");
		return false;
	}
	
	if ($('#revision').val() == "")
	{
		alert("Tienes que introducir la revisión");
		return false;
	}
	
	$.post("ajax/nueva_revision.php",{seccion: $('#seccion').val(), fecha: $('#fecha').val(), revision: $('#revision').val()},function(data)
	{
		var datos = data.split("#");
		if (datos[0] == "OK")
			$('#div_revisiones').append(datos[1]);
		else
			alert("Ocurrió un error al añadir la revisión");
	});
}