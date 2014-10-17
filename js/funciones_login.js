$().ready(function()
{
	$('#btn-Login').click(function(e){
		if ($('#user').val() == "") {
			$('#txtError').html("Introduzca nombre de usuario");
			return false;
		}
		else if ($('#pass').val() == "")
		{
			$('#txtError').html("Introduzca contraseña");
			return false;
		}
		else
		{
			validaLogin();
			return false;
		}
	});
	
	if ($.browser.msie)
	{
		$('#txtNavegador').html('Estás usando Internet Explorer para esta aplicación, y está optimizada para Mozilla Firefox.');
	}
});

function validaLogin()
{
	$.post("ajax/valida_login.php",{user: $('#user').val(), pass: $('#pass').val()}, function(data)
    {
		if (data == "OK")
            $('#fLogin').submit();
        else
            $('#txtError').html("Usuario no válido");
    });
}