function sacaEquipos(_tabla, _subgrupo, _definicion)
{
	$.post("ajax/carga_equipos.php",{tabla: _tabla, subgrupo: _subgrupo, definicion: _definicion}, function(data)
	{
		$('#equipos').html(data);
	}
	);
}

function ePresion()
{
	$.get("ajax/carga_descripciones.php",{grupo: 'P'},function(data)
	{
		$('#descripciones').html(data);
	}
	);
}

function eLamina()
{
	$.get("ajax/carga_descripciones.php",{grupo: 'L'},function(data)
	{
		$('#descripciones').html(data);
	}
	);
}

function eHidrometria()
{
	$.get("ajax/carga_descripciones.php",{grupo: 'H'},function(data)
	{
		$('#descripciones').html(data);
	}
	);
}

function aceptaEquipo(pos)
{
	var valor = $("input[name='rdEquipoElegido']:checked").val();
	if (valor > 0)
    {
	    $.post("ajax/acepta_equipo.php",{id_equipo: valor, tabla: $('#nombre_tabla').val(), definicion: $('#definicion').val()},function(data)
	    {
		    var aDatos = data.split("#");
		    
		    $('#referencia_' + pos).val(aDatos[0]);
		    $('#descripcion_' + pos).val(aDatos[1]);
		    $('#precio_' + pos).val(aDatos[2]);
		    if (pos == "nuevo")
			    $('#cantidad_nuevo').focus();
	    }
	    );
        disablePopup();
    }
}