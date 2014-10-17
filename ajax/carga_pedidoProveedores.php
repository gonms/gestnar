<?php
	include("../includes/funciones.php");
	include("../includes/conf.php");
	include("../class/pedido_proveedores.class.php");
	
	$q = $_GET["id"];
	
	if (!$q) return;
	
	$aProveedores = array();
	$proveedores = new PedidoProveedores();
	
	$aProveedores = $proveedores->getProveedores($q);
    if ($_GET['vieneDe'] == "pedidos")
    {
        for ($i=0;$i<count($aProveedores);$i++)
        {
            $result .= "<tr id='row_prov_" . ($i+1). "'>\n
                            <td valign='top'><input name='prov_empresa_" . ($i+1) . "' id='prov_empresa_" . ($i+1) . "' type='text' value='" . $aProveedores[$i]['empresa'] . "' class='input02' /></td>\n
                            <td valign='top'><input name='prov_numero_" . ($i+1) . "' id='prov_numero_" . ($i+1) . "' type='text' value='" . $aProveedores[$i]['numero'] . "' /></td>\n
                            <td valign='top'><input name='prov_fecha_" . ($i+1) . "' id='prov_fecha_" . ($i+1) . "' type='text' value='" . myToDate($aProveedores[$i]['fecha']) . "' /></td>\n
                            <td valign='top'><input name='prov_importe_" . ($i+1) . "' id='prov_importe_" . ($i+1) . "' type='text' value='" . $aProveedores[$i]['importe'] . "' /></td>\n
                            <td valign='top'><input name='prov_fecha_entrega_" . ($i+1) . "' id='prov_fecha_entrega_" . ($i+1) . "' type='text' value='" . myToDate($aProveedores[$i]['fecha_entrega']) . "' /></td>\n
							<td>
							    <a href='#' onClick='borraPedidoProv(\"" . ($i + 1) . "\")' alt='Borrar pedido proveedores' title='Borrar pedido proveedores'><img src='img/borrar.jpg' height='20' width='20' border='0' /></a>
							    <input type='hidden' name='accion_prov_" . ($i+1) . "' id='accion_prov_" . ($i+1) . "' value=''/>
								<input type='hidden' name='id_prov_" . ($i+1) . "' id='id_prov_" . ($i+1) . "' value='" . $aProveedores[$i]['id'] . "'/>
						    </td>\n
                        </tr>\n";
        }        
    }
    else if ($_GET['vieneDe'] == "ordencompra")
    {
        for ($i=0;$i<count($aProveedores);$i++)
        {
            $result .= "<tr'>\n
                            <td><input type='radio' name='rdPedidoProveedor' id='rdPedidoProveedor_" . $aProveedores[$i]['id'] . "' value='" . $aProveedores[$i]['id'] . "' /></td>\n
                            <td><input name='proveedor_" . $aProveedores[$i]['id'] . "' id='proveedor_" . $aProveedores[$i]['id'] . "' type='text' value='" . $aProveedores[$i]['empresa'] . "' size='50' /></td>\n
                            <td><input name='numero_" . $aProveedores[$i]['id'] . "' id='numero_" . $aProveedores[$i]['id'] . "' type='text' value='" . $aProveedores[$i]['numero'] . "' size='12' /></td>\n
                            <td><input name='fecha_" . $aProveedores[$i]['id'] . "' id='fecha_" . $aProveedores[$i]['id'] . "' type='text' value='" . myToDate($aProveedores[$i]['fecha']) . "' size='10' /></td>\n
                            <td><input name='importe_" . $aProveedores[$i]['id'] . "' id='importe_" . $aProveedores[$i]['id'] . "' type='text' value='" . number_format($aProveedores[$i]['importe'],1,',','.') . "' size='10' /></td>\n
                            <td><input name='fecha_entrega_" . $aProveedores[$i]['id'] . "' id='fecha_entrega_" . $aProveedores[$i]['id'] . "' type='text' value='" . myToDate($aProveedores[$i]['fecha_entrega']) . "' size='10' /></td>\n
                        </tr>\n";
        }        
    }
    
	echo utf8_encode($result);
?>