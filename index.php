<?php
	$user = "";
	$pass = "";
	$chk = "";
	if(isset($_COOKIE['gestnar']))
	{
		$user = $_COOKIE['gestnar']['username'];
		$pass = $_COOKIE['gestnar']['password'];
		$chk = " checked";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login - Gestnar</title>
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
    <script type="text/javascript" src="js/funciones_login.js"></script>		
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<h1><img src="img/logo.gif" alt="Gestnar" title="Gestnar" /></h1>
        </div>
        <hr />
        <div class="sinMenu"></div>
        
    	<div id="content">
        	<div class="module inter02">
        		<p class="txt01" id="txtNavegador"></p>
                <form id="fLogin" action="login.php" method="post" class="login">
                	<fieldset>
                    	<ul>
                        	<li>
                            	<label>
                            		<span>Usuario</span>
                                    <input type="text" id="user" name="user" value="<?php echo $user;?>" />
                                </label>
                            </li>
                        	<li>
                            	<label>
                            		<span>Password</span>
                                    <input type="password" id="pass" name="pass" value="<?php echo $pass;?>" />
                                </label>
                            </li>
                            <li class="error">
                            	<span id="txtError">&nbsp;</span>
                            </li>							
                            <li>
                            	<input type="image" src="img/btn01.gif" id="btn-Login" />
                            </li>
                            <li>
                            	<input type="checkbox" class="check" name="chkRecordarme" id="chkRecordarme" <?php echo $chk;?> />
                            	<span>&nbsp;Recordarme en este equipo</span>
                            </li>							
                        </ul>
                    </fieldset>
                </form>
            </div>
        </div>                     
    </div>
	<div id="pie">&copy; <?php echo date("Y");?> EINAR S.A.</div>
</body>
</html>