<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Nuevo proveedor - Gestnar</title>
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
			$.post("ajax/guarda_proveedor.php",{proveedor: $('#n_proveedor').val(), direccion:$('#n_direccion').val(), cod_postal: $('#n_cod_postal').val(), localidad: $('#n_localidad').val(), provincia: $('#n_provincia').val(), telefono: $('#n_telefono').val(), fax: $('#n_fax').val(), persona_contacto: $('#n_persona_contacto').val()},function(data)
		    {
			    alert(data);
				var aDatos = data.split("#");
			    if (aDatos[0] == "OK")
				{
					$('#proveedor').val(aDatos[1]);
				    $('#direccion').val(aDatos[2]);
					$('#cod_postal').val(aDatos[3]);
					$('#localidad').val(aDatos[4]);
					$('#provincia').val(aDatos[5]);
					$('#telefono').val(aDatos[6]);
					$('#fax').val(aDatos[7]);
					$('#persona_contacto').val(aDatos[8]);
					$('#id_proveedor').val(aDatos[9]);
				}
				else
				{
					alert("Ocurrió un problema al guardar los datos");
				}
		    });
	        disablePopup();
		}
	</script>    
 </head>

<body>
<div class="ofertas">
<fieldset class="datosCliente">                        
	<span class="title" style="cursor:pointer">Nuevo Proveedor</span>
	<br/>
    <label>
        <span>Nombre</span>
        <input type="text" size="35" name="n_proveedor" id="n_proveedor" />
    </label>
    <label>
        <span>Direcci&oacute;n</span>
        <textarea rows="2" cols="27" name="n_direccion" id="n_direccion"></textarea>
    </label>                        
    <label>
        <span>Localidad</span>
        <input type="text" size="30" name="n_localidad" id="n_localidad"/>
    </label>                        
    <label>
        <span>Provincia</span>
        <input type="text" name="n_provincia" id="n_provincia"/>
    </label>
    <label>
        <span>Cod. Postal</span>
        <input type="text" size="10" name="n_cod_postal" id="n_cod_postal"/>
    </label>
	<label>
        <span>Tel&eacute;fono</span>
        <input type="text" class="input70" name="n_telefono" id="n_telefono"/>
    </label>
    <label>
        <span>Fax</span>
        <input type="text" class="input70" name="n_fax" id="n_fax"/>
    </label>
	<label>
		<span>Persona Contacto</span>
		<input type="text" size="35" name="n_persona_contacto" id="n_persona_contacto" />
	</label>                                             
	<div class="btn04">
    	<input type="button" class="btn04" onclick="guardar()" value="Guardar"/>
    </div>
</fieldset>
</div>
</body>
</html>