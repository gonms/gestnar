<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Nuevo cliente - Gestnar</title>
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
			$.post("ajax/guarda_cliente.php",{nombre: $('#n_nombre').val(), direccion:$('#n_direccion').val(), cod_postal: $('#n_cod_postal').val(), localidad: $('#n_localidad').val(), provincia: $('#n_provincia').val(), telefono: $('#n_telefono').val(), fax: $('#n_fax').val()},function(data)
		    {
			    var aDatos = data.split("#");
			    if (aDatos[0] == "OK")
				{
					$('#empresa').val(aDatos[1]);
				    $('#direccion').val(aDatos[2]);
					$('#cod_postal').val(aDatos[3]);
					$('#localidad').val(aDatos[4]);
					$('#provincia').val(aDatos[5]);
					$('#telefono').val(aDatos[6]);
					$('#fax').val(aDatos[7]);
					$('#id_cliente').val(aDatos[8]);
					
					if ($('#vieneDe').val() != "facturas")
					{
						if ($('#n_persona_contacto').val() != "")
						{
							$.post("ajax/guarda_clienteContactos.php",
							{
								id_cliente: aDatos[8],
								nombre: $('#n_persona_contacto').val()
							}, function(data)
							{
								var datos = data.split('#');
								$.get("ajax/carga_clienteContactos.php", 
								{
									id: datos[0],
									id_contacto: datos[1]
								}, function(data)
								{
									$('#id_contacto').html(data);
									$('#id_contacto').val(datos[1]);
								});
							});
						}
					}
				}
				else
				{
					alert(aDatos[0]);
				}
		    });
	        disablePopup();
		}
	</script>    
 </head>

<body>
<div class="ofertas">
<fieldset class="datosCliente">                        
	<span class="title" style="cursor:pointer">Nuevo Cliente</span>
	<br/>
    <label>
        <span>Nombre</span>
        <input type="text" size="35" name="n_nombre" id="n_nombre" />
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
	<?php 
		if ($_GET['vieneDe'] != "facturas")
		{
	?>
	<label>
		<span>Persona Contacto</span>
		<input type="text" size="35" name="n_persona_contacto" id="n_persona_contacto" />
	</label>
	<?php
		}
	?>
	<div class="btn04">
    	<input type="button" class="btn04" onclick="guardar()" value="Guardar"/>
    </div>
	<input type="hidden" value="<?php echo $_GET['vieneDe'];?>" name="vieneDe" id="vieneDe" />
</fieldset>
</div>
</body>
</html>