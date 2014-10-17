<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gestnar. Gestión de aguas</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<!--<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/presentation.css" media="screen" />-->
<link rel="stylesheet" type="text/css" href="css/equipos.css" />

<script type="text/javascript" src="js/funciones_equipos.js"></script>	
</head>
<body class="cuerpo">
	<div style="width:800px;">
		<strong>Elecci&oacute;n de Equipos</strong>
		<div align="left" style="margin:5px 0 5px 10px;">
			<div class="btn04">
                <input type="button" name="btn-ePresion" id="btn-ePresion" value="Presi&oacute;n" class="btn04" onClick="ePresion()" />
            </div>
            <div class="btn04">
			    <input type="button" name="btn-eLamina" id="btn-eLamina" value="L&aacute;mina" class="btn04" onClick="eLamina()" />
            </div>
			<!--<input type="button" name="btn-eHidrometria" id="btn-eHidrometria" value="Hidrometr&iacute;a" class="boton" />-->
			<br />&nbsp;
		</div>
		<div id="descripciones">
		</div>
		<div style="float:left;width:5px"></div>
		<div id="equipos">
		</div>
		<div align="right" style="margin:15px 10px 15px 5px;">
			<br />&nbsp;<br />&nbsp;
			<div class="btn04" id="btnAceptaEquipo">
                <input type="button" name="btn-Aceptar" id="btn-Aceptar" value="Aceptar" class="btn04" onClick="aceptaEquipo('<?php echo $_GET['pos'];?>')" />
            </div>
			<br />&nbsp;<br />&nbsp;
		</div>
	</div>
</body>
</html>