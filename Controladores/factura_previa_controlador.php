<?php 
	
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();
	$subtotal = 0.0;
	$grantotal = 0.0;
	if (isset($_POST['estos_totales']) && $_POST['estos_totales']=="si_estos") {

		$sql_ultima_venta = "SELECT * FROM tb_venta ORDER BY int_idventa DESC LIMIT 1;";
		$resultado_idventa = $modelo->get_query($sql_ultima_venta);
		if ($resultado_idventa[0] =='1') {
			$idultventa = $resultado_idventa[2][0]['int_idventa'];
		}

		$sql_totales = "SELECT
							SUM(dou_subtotal_item_vender)	as subtotal_venta,
							dou_total_venta
						FROM
							tb_detalle_venta
							INNER JOIN
							tb_venta
							ON 
								tb_detalle_venta.int_idventa = tb_venta.int_idventa WHERE tb_venta.int_idventa = '$idultventa'";
		$resultado_totales = $modelo->get_query($sql_totales);

		if($resultado_idventa[0]=='1'){

			if ($resultado_totales[0]=='1' && $resultado_totales[4]>0) {
						
						$htmltr2 = $html2="";
						foreach ($resultado_totales[2] as $row) {
							$subtotal = $row['subtotal_venta'];
							$grantotal = $row['dou_total_venta'];
						}


						$html2.='<table class="table" width="100%">			                   
						            <tr>
						                <th style="width:50%">Sub Total: </th>
						                 <td>$'.$subtotal.'</td>
						            </tr>
						            <tr>
						                <th>Venta Total $:</th>
						                <td>$'.$grantotal.'</td>
						            </tr>
			           			</table>';					
					$array = array("obtenido","totales","",$html2);
					print json_encode($array);
					exit();	
			}				
		}else {
        	$array = array("Error","no se mostro la compra",$_POST,$resultado_venta,$resultado_detventa_derivados,$resultado_detbovino,);
        	print json_encode($array);
			exit();
        }

	}

	if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_esta") {
		
		$htmltr = $html="";
		$subtotal = 0.0;
		//SELECCIONAMOS EL ID DE LA ÚLTIMA VENTA 
		$sql_ultima_venta = "SELECT * FROM tb_venta ORDER BY int_idventa DESC LIMIT 1;";
		$resultado_idventa = $modelo->get_query($sql_ultima_venta);
		if ($resultado_idventa[0] =='1') {
			$idultventa = $resultado_idventa[2][0]['int_idventa'];
		}
//=======================OBTIENE LOS TOTALES============================================================	
		

		
		/*if ($resultado_totales[0]=='1' && $resultado_totales[4]>0) {
					
					$htmltr2 = $html2="";
					foreach ($resultado_totales[2] as $row) {
					
				 	$htmltr2.='<tr>
				                <td>'.$row['subtotal_venta'].'</td>
				                <td>'.$row['dou_total_venta'].'</td>
				            </tr>';		
					}
					$html2.='<table class="table table-striped projects" width="100%">
		                    <thead>
					            <tr>
					                <th style="width:50%">Sub Total: </th>
					                <th>Venta Total $:</th>
					            </tr>
					        </thead>
	                    <tbody>';
		            $html2.=$htmltr2;
					$html2.='</tbody>
		                    	</table>';					
				$array = array("Exito","detalle",$html2,$_POST,$resultado_venta[2][0],$resultado_totales,$subtotal);
				print json_encode($array);
				exit();
					
		}else {
        	$array = array("Error","no se mostraron los totales",$_POST,$resultado_venta,$resultado_detventa_derivados,$resultado_detbovino,);
        	print json_encode($array);
			exit();
        }*/
		
//======================ENCABEZADO DE LA VENTA======================================================
		$sql = "SELECT
					nva_nom_empleado,
					nva_dui_cliente, 
					nva_nom_cliente, 
					nva_ape_cliente, 
					txt_direc_cliente, 
					nva_telefono_cliente, 
					int_idventa, 
					dou_total_venta, 
					dat_fecha_venta, 
					dat_fecha_sistema_venta
				FROM
					tb_venta
					INNER JOIN
					tb_empleado
					ON 
						tb_venta.int_idempleado = tb_empleado.int_idempleado
					INNER JOIN
					tb_clientes
					ON 
						tb_venta.int_id_cliente = tb_clientes.int_idcliente WHERE int_idventa = '$idultventa'";
		$resultado_venta = $modelo->get_query($sql);

//=======================DETLLE DE LA VENTA DERIVADOS============================================================		
		$sql_det_derivados ="SELECT
								dou_precio_venta, 
								dou_subtotal_item_vender, 
								int_cantidad_vender, 
								nva_nom_producto
							FROM
								tb_detalle_venta
								INNER JOIN
								tb_producto
								ON 
									tb_detalle_venta.int_idproducto = tb_producto.int_idproducto WHERE int_idventa = '$idultventa'";

		$resultado_detventa_derivados = $modelo->get_query($sql_det_derivados);
//========================DETALLE DE LA VENTA BOVINOS===========================================================
		$sql_det_bovinos ="SELECT
								nva_nom_bovino, 
								dou_precio_venta_bovino, 
								dou_subtotal_item_vender, 
							    nva_nom_raza
							FROM
								tb_detalle_venta
								INNER JOIN
								tb_expediente
								ON 
									tb_detalle_venta.int_idexpediente = tb_expediente.int_idexpediente
								INNER JOIN
								tb_raza
								ON 
									tb_expediente.int_idraza = tb_raza.int_idraza
							WHERE
								int_idventa ='$idultventa'";
		$resultado_detbovino = $modelo->get_query($sql_det_bovinos);
		
		if($resultado_venta[0]=='1'){

			
			if ($resultado_detventa_derivados[0]=='1' && $resultado_detventa_derivados[4]>0) {
				
					foreach ($resultado_detventa_derivados[2] as $row) {
					$subtotal = $subtotal + $row['dou_subtotal_item_vender'];
				 	$htmltr.='<tr>
				                <td>'.$row['nva_nom_producto'].'</td>
				                <td class="text-center ">'."$".''.$row['dou_precio_venta'].'</td>
				                <td class="text-center ">'.$row['int_cantidad_vender'].'</td>
				                <td class="text-center ">'."$".''.$row['dou_subtotal_item_vender'].'</td>
				            </tr>';		
					}
					$html.='<table class="table table-striped projects" width="100%">
		                    <thead>
					            <tr>
					                <th>Producto</th>
					                <th class="text-center col-2" >Precio</th>
					                <th class="text-center col-2" >Cantidad</th>
					                <th class="text-center col-2" >Sub Total</th>
					            </tr>
					        </thead>
	                    <tbody>';
		            $html.=$htmltr;
					$html.='</tbody>
		                    	</table>';					
				$array = array("Exito","detalle",$html,$_POST,$resultado_venta[2][0],$resultado_detventa_derivados,$subtotal);
				print json_encode($array);
				exit();
					
			}else if ($resultado_detbovino[0]=='1' && $resultado_detbovino[4]>0) {
				foreach ($resultado_detbovino[2] as $row) {
					$subtotal = $subtotal + $row['dou_subtotal_item_vender'];
					$htmltr.='<tr>
						        <td>'.$row['nva_nom_bovino'].'</td>							   
							    <td class="text-center ">'.$row['nva_nom_raza'].'</td>
							    <td class="text-center ">'."$".''.$row['dou_precio_venta_bovino'].'</td>
					           </tr>';		
				}
				$html.='<table class="table table-striped projects" width="100%">
			                <thead>
						        <tr>
						            <th >Bovino</th>
                                    <th class="text-center col-2" >Raza</th>
                                    <th class="text-center col-2" >Precio $</th>
						        </tr>
						    </thead>
		                  <tbody>';
			    	$html.=$htmltr;
					$html.='</tbody>
			            </table>';
			    $array = array("Exito","detalle",$html,$_POST,$resultado_venta[2][0],$resultado_detventa_derivados,$resultado_detbovino,$subtotal);
				print json_encode($array);
				exit();
			}else{
				$array = array("Error","no se pudo mostrar la tabla",$resultado_detventa_derivados,$resultado_detbovino,$resultado_detbovino,);
				print json_encode($array);
				exit();
			}

			$array = array("Exito","mostrado_encabezado",$html,$_POST,$resultado_venta[2][0],$resultado_detventa_derivados,$subtotal,$resultado_detbovino,);
			print json_encode($array);
			exit();

        }else {
        	$array = array("Error","no se mostro la compra",$_POST,$resultado_venta,$resultado_detventa_derivados,$resultado_detbovino,);
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
				 $htmltr.='<tr>
	                            <td class="text-center">'.$row['dat_fecha_compra'].'</td>
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



?>