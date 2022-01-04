<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];

	
	if (isset($_POST['almacenar_venta']) && $_POST['almacenar_venta']=="nueva_venta") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		
		if(isset($_POST['idproducto_v']) && isset($_POST['precio_item_venta']) && isset($_POST['cantidad'])){
				$idproducto_v = $_POST['idproducto_v'];
				$precio_item = $_POST['precio_item_venta'];
				$cantidad = $_POST['cantidad'];

				//INSERTO EL ENCBEZADO DE LA VENTA
				$id_insertar = $modelo->retonrar_id_insertar("tb_venta");
				$sitio_compra = "n/a";				
		        $array_insertar = array(
		            "table" => "tb_venta",
		            "int_idventa"=>$id_insertar,
		            "dou_total_venta" => $_POST['total_g_venta_d'],
		            "dat_fecha_venta" => $modelo->formatear_fecha_hora($_POST['fecha_venta_d']),
		            "dat_fecha_sistema_venta" => date("Y-m-d G:i:s"),
		            "int_idempleado" => $_POST['empleado_venta'],
		            "int_id_cliente" => $_POST['cliente_venta_d']
		        );
		        $result_venta = $modelo->insertar_generica($array_insertar);

		    if($result_venta[0]=='1'){//EVALUA SI LA VENTA SE RALIAZÓ CORRECTAMENTE

										
		        	//CON ESTA CONSULTA OBTENGO EL ÚLTIMO REGISTRO INGRESADO EN EL ENCABEZADO DE LA VEENTA
			        $sql ="SELECT * FROM tb_venta ORDER BY int_idventa DESC LIMIT 1;";
					$result_ultima_venta = $modelo->get_query($sql);

					$num_elementos=0;

					if($result_ultima_venta[0]=='1'){						
						
						while ($num_elementos < count($idproducto_v)) {
							//OBTENGO LA EXISTENCIA ACTUAL DE CADA PRODUCTO A COMPRAR PARA RESTAR LA CANTIDAD A VENDER
						 	$sql ="SELECT * FROM tb_producto WHERE int_idproducto = '$idproducto_v[$num_elementos]'";
							$result_existencia = $modelo->get_query($sql);

							if($result_existencia[0]=='1' && $result_existencia[4]>0){
								//SUMO LA CANTIDAD A COMPRAR, CON LA EXISTENCIA ACTUAL DEL PRODUCTO
								$existencia_Actual = $result_existencia[2][0]['int_existencia'];
								$nueva_existencia = 0;
								$nueva_existencia = $existencia_Actual - $cantidad[$num_elementos];
							}else{
								//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
								$array = array("Error","existencias",$result_existencia,$idproducto_v);
								print json_encode($array);
								exit();
							}

							//INSERTANDO EN LA TABLA DETALLE-VENTA
							$id_insertar = $modelo->retonrar_id_insertar("tb_detalle_venta");				
					        $array_insertar = array(
					            "table" => "tb_detalle_venta",
					            "int_iddventa"=> $id_insertar,
					            "int_cantidad_vender" => $cantidad[$num_elementos],
					            "dou_precio_venta" => $precio_item[$num_elementos],
					            "dou_subtotal_item_vender" => $cantidad[$num_elementos] * $precio_item[$num_elementos],
					            "int_idproducto" =>  $idproducto_v[$num_elementos],
					            "int_idventa" => $result_ultima_venta[2][0]['int_idventa']
					        );
					        $result_det_compra = $modelo->insertar_generica($array_insertar);
					        //ACTUALIZO L EXISTANCIA DE LOS PRODUCTOS COMPRADOS 
				        	$array_update_stock_productos = array(
					            "table" => "tb_producto",
					            "int_idproducto" => $idproducto_v[$num_elementos],
					            "int_existencia"=> $nueva_existencia           
				       		);
							$resultado_stock = $modelo->actualizar_generica($array_update_stock_productos);							
						 	$num_elementos=$num_elementos+1;
						}
					}else{
						//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
						$array = array("Error","ultimaventa",$result_existencia);
						print json_encode($array);
						exit();
					}
					
		        	
		        	print json_encode(array("Exito",$_POST,$result_venta));
					exit();
	        }else {
	        	//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
				$array = array("Error","en la insercion de la venta",$result_venta);
				print json_encode($array);
				exit();
	        }
    	}else {
	        //CUANDO NO HAY PRODUCTOS SELECCIONADOS
			$array = array("Error","no hay productos",$_POST);
			print json_encode($array);
			exit();
	    }		 
	}else{

		$array_select = array(
			"table"=>"tb_clientes",
			"int_idcliente"=>"nva_nom_cliente"

		);
		 
		$result_select = $modelo->crear_select($array_select);		
					
		$htmltr = $html="";
		$cuantos = 0;
		$sql ="SELECT int_idproducto, nva_image_producto, nva_nom_producto, dou_precio_venta_producto FROM tb_producto WHERE int_idcategoria = 1";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {	
				 $htmltr.='<tr>
	                            <td>'.$row['nva_nom_producto'].'</td>
	                             <td class="text-center"><img alt="img" width="90" height="100" src="'.$row['nva_image_producto'].'">
	                             </td>
	                            <td class="text-center">'."$".''.$row['dou_precio_venta_producto'].'</td>
	                            <td class="text-center project-actions">
			                        <button class="btn btn-info btn-sm btn_item_seleccionado" 
			                        	data-idproducto_seleccionado="'.$row['int_idproducto'].'" 
			                        	data-nombre_item_selec="'.$row['nva_nom_producto'].'"	
			                        	data-precio_item_selec="'.$row['dou_precio_venta_producto'].'"
			                        	data-image_item_selec="'.$row['nva_image_producto'].'">
			                            <i class="fas fa-check"></i>
			                        </button>
			                    </td>
	                        </tr>';	
			}
			$html.='<table id="example1" class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Imagen</th>
                            <th class="text-center">Precio Unitario $</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';

        	print json_encode(array("Exito",$html,$cuantos,$_POST,$result,$result_select));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result,$_SESSION));
			exit();
        }
	}



?>