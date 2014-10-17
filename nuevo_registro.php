<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Nuevo registro - Gestnar</title>
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
		function limpiaCampos()
		{
			$('#de_nombre').val("");
		    $('#de_direccion1').val("");
		    $('#de_direccion2').val("");
			$('#de_cod_postal').val("");
			$('#de_localidad').val("");
			$('#de_provincia').val("");
			
			$('#boton_anterior').css('display','none');
			$('#boton_siguiente').css('display','none');
		}
		
		function guardar()
		{
			if ($('#n_tabla').val() == "cliente")
			{
				$.post("ajax/guarda_registro.php",{tabla: 'cliente', empresa: $('#n_empresa').val(), direccion:$('#n_direccion').val(), cod_postal: $('#n_cod_postal').val(), localidad: $('#n_localidad').val(), provincia: $('#n_provincia').val(), telefono: $('#n_telefono').val(), fax: $('#n_fax').val(), cif: $('#n_cif').val(), forma_pago: $('#n_forma_pago').val(), email: $('#n_email').val()},function(data)
			    {
				    var aDatos = data.split("#");
				    if (aDatos[0] == "OK")
					{
						$('#id_cliente').val(aDatos[1]);
						$('#empresa').val(aDatos[2]);
					    $('#direccion').val(aDatos[3]);
						$('#cod_postal').val(aDatos[4]);
						$('#localidad').val(aDatos[5]);
						$('#provincia').val(aDatos[6]);
						$('#telefono').val(aDatos[7]);
						$('#fax').val(aDatos[8]);
						$('#cif').val(aDatos[9]);
						$('#forma_pago').val(aDatos[10]);
						$('#email').val(aDatos[11]);
					}
					else
					{
						alert("Ocurri\u00f3 un problema al guardar los datos");
					}
			    });
			}			
			else
			{
				$.post("ajax/guarda_registro.php",{tabla: 'proveedor', empresa: $('#n_empresa').val(), direccion:$('#n_direccion').val(), cod_postal: $('#n_cod_postal').val(), localidad: $('#n_localidad').val(), provincia: $('#n_provincia').val(), telefono: $('#n_telefono').val(), fax: $('#n_fax').val(), contacto: $('#n_contacto').val()},function(data)
			    {
				    var aDatos = data.split("#");
				    if (aDatos[0] == "OK")
					{
						$('#id_proveedor').val(aDatos[1]);
						$('#empresa').val(aDatos[2]);
					    $('#direccion').val(aDatos[3]);
						$('#cod_postal').val(aDatos[4]);
						$('#localidad').val(aDatos[5]);
						$('#provincia').val(aDatos[6]);
						$('#telefono').val(aDatos[7]);
						$('#fax').val(aDatos[8]);
						$('#contacto').val(aDatos[9]);
					}
					else
					{
						alert("Ocurri\u00f3 un problema al guardar los datos");
					}
			    });
			}
	        disablePopup();
			
			limpiaCampos();
		}
	</script>    
 </head>

<body>
<div class="ofertas">
<span class="title">Datos del <?php echo $_GET['tabla'];?></span>
<fieldset class="datosCliente">
    <label>
        <span><?php echo ucfirst($_GET['tabla']);?></span>
        <input type="text" size="35" name="n_empresa" id="n_empresa" />
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
        <input type="text" size="12" name="n_telefono" id="n_telefono"/>
    </label>                        
    <label>
        <span>Fax</span>
        <input type="text" size="12" name="n_fax" id="n_fax"/>
    </label>

	<?php
		if ($_GET['tabla'] == "cliente")	
		{
	?>
    <label>
        <span>C.I.F.</span>
        <input type="text" size="12" name="n_cif" id="n_cif"/>
    </label>

    <label>
        <span>Forma de Pago</span>
        <input type="text" size="12" name="n_forma_pago" id="n_forma_pago"/>
    </label>

    <label>
        <span>Email</span>
        <input type="text" size="12" name="n_email" id="n_email"/>
    </label>
	<?php
		}
		else
		{
	?>
    <label>
        <span>Persona Contacto</span>
        <input type="text" size="12" name="n_contacto" id="n_contacto"/>
    </label>	
	<?php
		}
	?>
	<input type="hidden" name="n_tabla" id="n_tabla" value="<?php echo $_GET['tabla'];?>"/>
	<div class="btn04">
    	<input type="button" class="btn04" onclick="guardar()" value="Guardar"/>
    </div>
</fieldset>
</div>
</body>
</html>