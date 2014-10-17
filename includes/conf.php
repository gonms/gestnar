<?php
	error_reporting(0);

	if ($_SERVER['HTTP_HOST'] == "localhost")
	{
		$host = "localhost";
		$bbddnombre = "gestnar";
		$user = "root";
		$pass = "";
	}
	else if ($_SERVER['HTTP_HOST'] == "192.168.0.201")
	{
		$host = "localhost";
		$bbddnombre = "gestnar";
		$user = "root";
		$pass = "";
	}
	else
	{
		$host = "localhost";
		$bbddnombre = "gestnar";
		$user = "root";
		$pass = "CxzYD8ojX4";
	}
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($bbddnombre,$link);
?>
