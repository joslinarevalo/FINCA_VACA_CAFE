<?php 
	
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();		
	if (isset($_POST['ver_compra']) && $_POST['ver_compra']=="si_esta") {
		
		$htmltr = $html="";
		$subtotal = 0.0;
		$sql = "SELECT txt_descrip_compra, dou_total_compra, dou_iva_aplicado, dat_fecha_compra, dat_fecha_sistema, nva_tipo_documento, nva_numero_documento, txt_sitio_compra, nva_nom_proveedor, nva_nom_empleado FROM tb_compra INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado WHERE int_idcompra = '$_POST[idcompra]'";
		$resultado_compra = $modelo->get_query($sql);			
//==========================================================================================================		
		$sql_det_insumos ="SELECT
					int_cantidad_compra, 
					dou_costo_compra,
					dou_subtotal_item_compra, 
					int_idcompra, 
					nva_nom_producto
				FROM
					tb_detalle_compra
					INNER JOIN
					tb_producto
					ON 
						tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
				WHERE
					int_idcompra = '$_POST[idcompra]'";

		$resultado_detcompra_insumos = $modelo->get_query($sql_det_insumos);
//================================================================================================================
		$sql_det_bovinos ="SELECT
								nva_nom_bovino, 
								nva_foto_bovino, 
								nva_nom_raza, 
								dou_subtotal_item_compra
							FROM
								tb_detalle_compra
								INNER JOIN
								tb_expediente
								ON 
									tb_detalle_compra.int_idexpediente = tb_expediente.int_idexpediente
								INNER JOIN
								tb_raza
								ON 
									tb_expediente.int_idraza = tb_raza.int_idraza WHERE	int_idcompra = '$_POST[idcompra]'";
		$resultado_detbovino = $modelo->get_query($sql_det_bovinos);
		
		if($resultado_compra[0]=='1'){

			if (($resultado_detcompra_insumos[0]=='1' && $resultado_detcompra_insumos[4]==1)) {
				
					foreach ($resultado_detcompra_insumos[2] as $row) {
					$subtotal = $subtotal + $row['dou_subtotal_item_compra'];
				 	$htmltr.='<tr>
				                <td>'.$row['nva_nom_producto'].'</td>
				                <td class="text-center ">'."$".''.$row['dou_costo_compra'].'</td>
				                <td class="text-center ">'.$row['int_cantidad_compra'].'</td>
				                <td class="text-center ">'."$".''.$row['dou_subtotal_item_compra'].'</td>
				            </tr>';		
					}
					$html.='<table class="table table-striped projects" width="100%">
		                    <thead>
					            <tr>
					                <th>Producto</th>
					                <th class="text-center col-2" >Costo Unitario</th>
					                <th class="text-center col-2" >Cantidad</th>
					                <th class="text-center col-2" >Sub Total</th>
					            </tr>
					        </thead>
	                    <tbody>';
		            $html.=$htmltr;
					$html.='</tbody>
		                    	</table>';					
				$array = array("Exito","detalle",$html,$_POST,$resultado_compra[2][0],$resultado_detcompra_insumos,$subtotal);
				print json_encode($array);
				exit();
					
			}else if ($resultado_detbovino[0]=='1' && $resultado_detbovino[4]==1) {
				foreach ($resultado_detbovino[2] as $row) {
					$subtotal = $subtotal + $row['dou_subtotal_item_compra'];
					$htmltr.='<tr>
					          <td>'.$row['nva_nom_bovino'].'</td>
						          <td class="text-center "><img alt="img" width="90" height="100" src="'.$row['nva_foto_bovino'].'"></td>
						           <td class="text-center ">'.$row['nva_nom_raza'].'</td>
						           <td class="text-center ">'."$".''.$row['dou_subtotal_item_compra'].'</td>
					           </tr>';		
				}
				$html.='<table class="table table-striped projects" width="100%">
			                <thead>
						        <tr>
						            <th >Bovino</th>
						            <th class="text-center col-2" >Foto</th>
                                    <th class="text-center col-2" >Raza</th>
                                    <th class="text-center col-2" >Costo $</th>
						        </tr>
						    </thead>
		                  <tbody>';
			    	$html.=$htmltr;
					$html.='</tbody>
			            </table>';
			    $array = array("Exito","detalle",$html,$_POST,$resultado_compra[2][0],$resultado_detcompra_insumos,$subtotal);
				print json_encode($array);
				exit();
			}else{
				$array = array("Error","no se pudo mostrar la tabla",$resultado_detcompra_insumos,$resultado_detbovino);
				print json_encode($array);
				exit();
			}

			$array = array("Exito","mostrado_encabezado",$html,$_POST,$resultado_compra[2][0],$resultado_detcompra_insumos,$subtotal);
			print json_encode($array);
			exit();

        }else {
        	$array = array("Error","no se mostro la compra",$_POST,$resultado_compra,$resultado_detcompra_insumos);
        	print json_encode($array);
			exit();
        }

	}else{		

		$htmltr = $html="";
		$cuantos = 0;
		$sql ="SELECT * FROM tb_compra INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor;";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {
			$fecha = datetimeformateado($row['dat_fecha_compra']);	
				 $htmltr.='<tr>
	                            <td class="text-center">'.$fecha.'</td>
	                            <td class="text-center">'.$row['nva_nom_proveedor'].'</td>
	                            <td class="text-center">'.$row['txt_descrip_compra'].'</td>
	                            <td class="text-center">'."$".''.$row['dou_total_compra'].'</td>
	                            <td class="text-center project-actions">
			                        <button class="btn btn-info btn-sm btn_ver" data-idcompra='.$row['int_idcompra'].'>
			                            <i class="fas fa-eye"></i>
			                        </button>
			                    </td>
	                        </tr>';	
			}
			$html.='<table id="example1" class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                        	<th class="text-center">Fecha y Hora</th>
                            <th class="text-center">Proveedor</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Total$</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';


        	print json_encode(array("Exito",$html,$cuantos,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
	}

	function datetimeformateado($fecha3){

			//divido la feha de la hora
			$separacion= explode(" ",$fecha3);
			$hora = $separacion[1];
			$fecha = $separacion[0];

			$pos = strpos($fecha, "/");
			if ($pos === false) $fecha = explode("-",$fecha);
			else $fecha = explode("/",$fecha);
			$dia1 = (strlen($fecha[0])==1) ? '0'.$fecha[0] : $fecha[0];

			//Concateno la fecha formteada con la hora y un espacio
			$fecha1 = $fecha[2].'-'.$fecha[1].'-'.$dia1.' '.$hora;
			return $fecha1;
	}


?>