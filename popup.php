<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gestnar. Gestión de aguas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />

<!--[if lte IE 6]>
    <link rel="stylesheet" type="text/css" href="css/fixIE6.css" />
<![endif]-->
<!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="css/fixIE7.css" />
<![endif]-->

<script type="text/javascript" src="js/jquery.js"></script>    
<script type="text/javascript">
function activaChk()
{
    if ($('#chk_pdf').attr('checked'))
        $('#chk_extra').attr('disabled','');
    else
        $('#chk_extra').attr('disabled','disabled');
}
function aceptar()
{
	var tipo = "";
    if ($('#popup_tipo').val() == "")
		tipo = "oferta";
	else
		tipo = $('#popup_tipo').val();
		
	if ($('#chk_pdf').attr('checked'))
    {
		if (tipo == "oferta")
		{
			var sumar = 0;
			if ($('#chk_extra').attr('checked')) 
				sumar = 1;
			window.open(tipo + '_pdf.php?id_' + tipo + '=' + $('#popup_id').val() + '&sumar=' + sumar + '&paginas=');
		}
		else if (tipo == "acusepedido")
		{
			var iva = 0;
			if ($('#chk_extra').attr('checked')) 
				iva = 1;
			window.open(tipo + '_pdf.php?id_' + tipo + '=' + $('#popup_id').val() + '&iva=' + iva);
		} 
		else
			window.open(tipo + '_pdf.php?id_' + tipo + '=' + $('#popup_id').val());
    }
    window.location='menu.php';
}
</script>
</head>
<body style="font-size:11px;font-family:Verdana;">
    <div style="width:400px;">
		<h2>Datos guardados correctamente.</h2>
        <br />
        <input type="checkbox" id="chk_pdf" name="chk_pdf" onClick="activaChk()" />
        <span>Generar PDF</span>
		<?php
		if ($_GET['tipo'] == "oferta")
		{
		?>
        <br />
		<input type="checkbox" id="chk_extra" name="chk_extra" disabled="disabled" />
        <span>Calcular el total de la oferta</span>
		<?php
		}
		if ($_GET['tipo'] == "acusepedido")
		{
		?>
        <br />
		<input type="checkbox" id="chk_extra" name="chk_extra" disabled="disabled" />
        <span>Calcular el IVA</span>
		<?php
		}
		?>
        <br /><br />
        <div class="btn04">
            <input type="button" class="btn04" value="Aceptar" onclick="aceptar()" />
			<input type="hidden" name="tipo" id="popup_tipo" value="<?php echo $_GET['tipo'];?>" />
			<input type="hidden" name="id" id="popup_id" value="<?php echo $_GET['id'];?>" />
        </div>
    </div>
</body>
</html>