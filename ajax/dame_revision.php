<?php
	include("../includes/conf.php");
	include("../class/oferta.class.php");
	
	function dameExtra($extra,$tipo_oferta,$numero,$codigo)
	{		
		$oferta = new Oferta();
		if ($tipo_oferta == "revision")
		{
			$dato = $oferta->getRevision($numero,$codigo,'rev');

			if (empty($dato))
				$valor = 1;
			else
			{
				$valor = $dato;
				$valor++;
			}
		}
		else if ($tipo_oferta == "multioferta")
		{
			/*if (strlen($extra) > 1 || ($extra >= 1 && $extra <= 9))
            {
                $numRevision = $extra[0];
				$dato = $oferta->getRevision($numero,$codigo,'mof',$numRevision);
            }
            else
			{
				$numRevision = "";
				$dato = $oferta->getRevision($numero,$codigo,'mof','letras');
			}
            */
            
            if (strlen($extra) > 1 && intval($extra) > 0)
			{
				$numRevision = $extra[0];
				$dato = $oferta->getRevision($numero,$codigo,'mof',$numRevision);
			}
            else if (strlen($extra) > 1)
			{
				$numRevision = "";
				$dato = $oferta->getRevision($numero,$codigo,'mof','letras');
			}
            else if ($extra >= 1 && $extra <= 9)
            {
				$numRevision = $extra;
                $dato = $oferta->getRevision($numero,$codigo,'mof',$extra);
            }
			else
			{
				$numRevision = "";
				$dato = "";
			}
				
			if (empty($dato))
				$valor = "a";
			else
			{
                if ($dato == "z")
                {
                    $valor = "aa";
                }
                else if ($dato == "zz")
                {
                    $valor = "aaa";
                }
                else if (strlen($dato) > 1)
                {
               	  $numRevision = "";
			for ($i=0;$i<strlen($dato);$i++)
                    {
                        if (($i+1) < strlen($dato))
                            $aux .= $dato[$i];
                        else
                            $valor = $dato[$i];
                    }
                    $valor = ord($valor);
                    $valor++;
				    $valor = $aux . chr($valor);
                }
                else
                {
   					$valor = ord($dato);
                    $valor++;
				    $valor = chr($valor);
                }
			}
			
			$valor = $numRevision . $valor;
		}
		else if ($tipo_oferta == "revMultioferta")
		{
			list($letra,$revision) = explode("-",$extra);
			if (empty($revision))
				$revision = 1;
			else
				$revision++;
			$valor = $letra . "-" . $revision;
		}
		return $valor;
	}
    
    function dameNumeroRevision($numero)
    {
		if (empty($numero))
            $valor = 1;
        else
            $valor = $numero + 1;
   
        return $valor;
    }
	
	
	
	if ($_GET['accion'] != "modificar" && $_GET['accion'] != "duplicar")
	{
		if ($_GET['tabla'] == "oferta")
		{
			$result = dameExtra($_GET['valor'], $_GET['accion'], $_GET['numero'], $_GET['codigo']);
		}
		else
		{
			$result = dameNumeroRevision($_GET['valor']);
		}
	}
	else
		$result = $_GET['valor'];

	echo $result;	
?>