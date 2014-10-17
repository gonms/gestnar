$().ready(function()
{
	$('#btn-Login').click(function(e){
		if ($('#user').val() == "") {
			$('#txtError').html("Introduzca nombre de usuario");
			return false;
		}
		else if ($('#pass').val() == "")
		{
			$('#txtError').html("Introduzca contrase�a");
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
		$('#txtNavegador').html('Est�s usando Internet Explorer para esta aplicaci�n, y est� optimizada para Mozilla Firefox.');
	}
});

function validaLogin()
{
	$.post("ajax/valida_login.php",{user: $('#user').val(), pass: $('#pass').val()}, function(data)
    {
		if (data == "OK")
            $('#fLogin').submit();
        else
            $('#txtError').html("Usuario no v�lido");
    });
}