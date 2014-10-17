<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Nueva dirección de envío - Gestnar</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Language" content="ES" />
    
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    
    <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="css/fixIE6.css" />
    <![endif]-->
    <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="css/fixIE7.css" />
    <![endif]-->        
    
    <!-- Icono en la barra de la URL -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		function guardar()
		{
			$.post("ajax/guarda_direccionEnvio.php",{id: $('#n_id').val(), tabla: $('#n_tabla').val(), nombre: $('#n_nombre').val(), direccion1:$('#n_direccion1').val(), direccion2: $('#n_direccion2').val(), cod_postal: $('#n_cod_postal').val(), localidad: $('#n_localidad').val(), provincia: $('#n_provincia').val()},function(data)
		    {
			    var aDatos = data.split("#");
			    if (aDatos[0] == "OK")
				{
					$('#de_nombre').val(aDatos[1]);
				    $('#de_direccion1').val(aDatos[2]);
				    $('#de_direccion2').val(aDatos[3]);
					$('#de_cod_postal').val(aDatos[4]);
					$('#de_localidad').val(aDatos[5]);
					$('#de_provincia').val(aDatos[6]);
					$('#id_' + $('#n_tabla').val() + '_direccion_envio').val(aDatos[7]);
                    
                    var total_registros = parseInt($('#total_direcciones').val());
                    $('#total_direcciones').val(total_registros + 1);
                    var posicion = total_registros;
                    $('#posicion').val(posicion);
                    $('#boton_siguiente').css('display','none');
                    $('#boton_anterior').css('display','');
				}
				else
				{
					alert("Ocurri\u00f3 un problema al guardar los datos");
				}
		    });
	        disablePopup();
		}
	</script>    
 </head>

<body>
<div class="ofertas">
<fieldset class="datosCliente">                        
	<span class="title" style="cursor:pointer">Direcci&oacute;n de env&iacute;o</span>
	<br/>
    <label>
        <span>Nombre</span>
        <input type="text" size="35" name="n_nombre" id="n_nombre" />
    </label>
    <label>
        <span>Direcci&oacute;n</span>
        <input type="text" size="35" name="n_direccion1" id="n_direccion1" />
    </label>                        
    <label>
        <span>Direcci&oacute;n</span>
        <input type="text" size="35" name="n_direccion2" id="n_direccion2" />
    </label>                                                
    <label>
        <span>Cod. Postal</span>
        <input type="text" size="10" name="n_cod_postal" id="n_cod_postal"/>
    </label>                                                
    <label>
        <span>Localidad</span>
        <input type="text" size="30" name="n_localidad" id="n_localidad"/>
    </label>                        
    <label>
        <span>Provincia</span>
        <input type="text" name="n_provincia" id="n_provincia"/>
    </label>
	<input type="hidden" name="n_tabla" id="n_tabla" value="<?php echo $_GET['tabla'];?>"/>
	<input type="hidden" name="n_id" id="n_id" value="<?php echo $_GET['id'];?>"/>
	<div class="btn04">
    	<input type="button" class="btn04" onclick="guardar()" value="Guardar"/>
    </div>
</fieldset>
</div>
</body>
</html>