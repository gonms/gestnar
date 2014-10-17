<?php
	function dateToMy($fecha)
	{
		list($d,$m,$a) = explode("/",$fecha);
		$new_fecha = $a . "-" . $m . "-" . $d;
		
		return $new_fecha;
	}
	
	function myToDate($fecha)
	{
		list($a,$m,$d) = explode("-",$fecha);
		$new_fecha = $d . "/" . $m . "/" . $a;
		
		return $new_fecha;
	}
?>