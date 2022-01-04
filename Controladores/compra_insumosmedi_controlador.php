<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];

	
	if (isset($_POST['almacenar_compra']) && $_POST['almacenar_compra']=="nueva_compra") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		
		if(isset($_POST['idproducto']) && isset($_POST['costo_item_compra']) && isset($_POST['cantidad'])){
				$idproducto = $_POST['idproducto'];
				$costo_item = $_POST['costo_item_compra'];
				$cantidad = $_POST['cantidad'];
				$id_insertar = $modelo->retonrar_id_insertar("tb_compra");
				$sitio_compra = "n/a";
				//INSERTO EL ENCBEZADO DE LA COMPRA
		        $array_insertar = array(
		            "table" => "tb_compra",
		            "int_idcompra"=>$id_insertar,
		            "txt_descrip_compra" => $_POST['descrip_compra'],
		            "dou_total_compra" => $_POST['total_compra_guardar'],
		            "dou_iva_aplicado" => $_POST['iva_guardar'],
		            "dat_fecha_compra" => $modelo->formatear_fecha_hora($_POST['fecha_compra']),
		            "dat_fecha_sistema" => date("Y-m-d G:i:s"),
		            "nva_tipo_documento" => $_POST['tipo_doc_compra'],
		            "nva_numero_documento" => $_POST['num_doc_compra'],
		            "txt_sitio_compra" => $sitio_compra,
		            "int_idproveedor" => $_POST['proveedores_compra'],
		            "int_idempleado" => $_POST['empleado_compra']
		        );
		        $result_compra = $modelo->insertar_generica($array_insertar);

		    if($result_compra[0]=='1'){//EVALUA SI LA COMPRA SE RALIAZÓ CORRECTAMENTE

										
		        	//CON ESTA CONSULTA OBTENGO EL ÚLTIMO REGISTRO INGRESADO EN EL ENCABEZADO DE LA COMPRA
			        $sql ="SELECT * FROM tb_compra ORDER BY int_idcompra DESC LIMIT 1;";
					$result_ultima_compra = $modelo->get_query($sql);

					$num_elementos=0;

					if($result_ultima_compra[0]=='1'){						
						
						while ($num_elementos < count($idproducto)) {
							//OBTENGO LA EXISTENCIA ACTUAL DE CADA PRODUCTO A COMPRAR PARA SUMAR LA CANTIDAD A COMPRAR
						 	$sql ="SELECT * FROM tb_producto WHERE int_idproducto = '$idproducto[$num_elementos]'";
							$result_existencia = $modelo->get_query($sql);

							if($result_existencia[0]=='1' && $result_existencia[4]>0){
								//SUMO LA CANTIDAD A COMPRAR, CON LA EXISTENCIA ACTUAL DEL PRODUCTO
								$existencia_Actual = $result_existencia[2][0]['int_existencia'];
								$nueva_existencia = 0;
								$nueva_existencia = $existencia_Actual + $cantidad[$num_elementos];
							}else{
								//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
								$array = array("Error","existencias",$result_existencia,$idproducto);
								print json_encode($array);
								exit();
							}

							//INSERTANDO EN LA TABLA DETALLE-COMPRA
							$id_insertar = $modelo->retonrar_id_insertar("tb_detalle_compra");				
					        $array_insertar = array(
					            "table" => "tb_detalle_compra",
					            "int_iddcompra"=> $id_insertar,
					            "int_cantidad_compra" => $cantidad[$num_elementos],
					            "dou_costo_compra" => $costo_item[$num_elementos],
					            "dou_subtotal_item_compra" => $cantidad[$num_elementos] * $costo_item[$num_elementos],
					            "int_idproducto" =>  $idproducto[$num_elementos],
					            "int_idcompra" => $result_ultima_compra[2][0]['int_idcompra']
					        );
					        $result_det_compra = $modelo->insertar_generica($array_insertar);
					        //ACTUALIZO L EXISTANCIA DE LOS PRODUCTOS COMPRADOS 
				        	$array_update_stock_productos = array(
					            "table" => "tb_producto",
					            "int_idproducto" => $idproducto[$num_elementos],
					            "int_existencia"=> $nueva_existencia           
				       		);
							$resultado_stock = $modelo->actualizar_generica($array_update_stock_productos);							
						 	$num_elementos=$num_elementos+1;
						}
					}else{
						//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
						$array = array("Error","ultimacompra",$result_existencia);
						print json_encode($array);
						exit();
					}
					
		        	
		        	print json_encode(array("Exito",$_POST,$result_compra,$_SESSION));
					exit();
	        }else {
	        	//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
				$array = array("Error","en la insercion de la compra",$result_compra);
				print json_encode($array);
				exit();
	        }
    	}else {
	        //CUANDO NO HAY PRODUCTOS SELECCIONADOS
			$array = array("Error","no hay productos",$_SESSION);
			print json_encode($array);
			exit();
	    }		 
	}else{

		$array_select = array(
			"table"=>"tb_proveedor",
			"int_idproveedor"=>"nva_nom_proveedor"
		);		 
		$result_select = $modelo->crear_select($array_select);		
					
		$htmltr = $html="";
		$cuantos = 0;
		$sql ="SELECT int_idproducto, nva_nom_producto, dou_costo_producto FROM tb_producto WHERE int_idcategoria = 3 AND nva_estado_producto = 'Activo'";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {	
				 $htmltr.='<tr>
	                            <td class="text-center">'.$row['nva_nom_producto'].'</td>
	                            <td class="text-center">'."$".''.$row['dou_costo_producto'].'</td>
	                            <td class="text-center project-actions">
			                        <button class="btn btn-info btn-sm btn_seleccionado" 
			                        	data-idproducto_seleccionado="'.$row['int_idproducto'].'"
			                        	data-nombre_item_selec="'.$row['nva_nom_producto'].'">
			                            <i class="fas fa-check"></i>
			                        </button>
			                    </td>
	                        </tr>';	
			}
			$html.='<table id="example1" class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Costo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';
        	print json_encode(array("Exito",$html,$cuantos,$_POST,$result,$result_select));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result,$result_select));
			exit();
        }
	}



?>