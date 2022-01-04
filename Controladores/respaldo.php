<?php if (isset($_SESSION['carrito'])) {
		  	// por si queremos acceder al carrito
		  	if (isset($_POST['idproducto'])) {
		  		// ponemos lo que hay en la sesión (que es un arreglo de objetos productos) en una variable
			    $arreglo = $_SESSION['carrito'];
			    $encontro = false;     
			    $numero = 0;

			    // recorremos el arreglo buscando si el producto camprado ya estaba en el carrito con anterioridad
			    for ($i=0; $i < count($arreglo) ; $i++) { 
			    	if ($arreglo[$i]['id'] == $_POST['idproducto']) {
			    		$encontro = true;
			    		// guardamos la posición del producto
			    		$numero = $i;
			    	}
			    }

		        // si el producto ya estaba en el carrito, incrementamos la cantidad del mismo
			    if ($encontro) {
			    	$arreglo[$numero]['cantidad']++;
			    	$_SESSION['carrito'] = $arreglo;
			    }
		        // si no estaba, lo ponemos en la sesión
		        else{
		        	$nombre = "";
		       	    $precio = 0;
		       	    $imagen = "";
		       	     $sql ="SELECT int_idproducto, nva_nom_producto, dou_costo_producto FROM tb_producto WHERE int_idproducto = '$_POST[idproducto]'";
					$result = $modelo->get_query($sql);
		            // guardamos algunos datos del producto en variables
		            if($result[0]=='1'){

			           foreach($result[2] as $row){
							$id_pro_selecciondo = $row['int_idproducto'];
							$nombre_pro_selecciondo = $row['nva_nom_producto'];
							$costo_pro_selecciondo = $row['dou_costo_producto'];
							$cantidad_pro_selecciondo = 1;
						} 
					// ponemos esas variables como atributos de un objeto de tipo producto
		            // como es la primera vez que entra el producto al carrito el valor de cantidad por defecto es uno 
						$nuevoproducto = array('id'=>$id_pro_selecciondo,
		            	               'nombre'=>$nombre_pro_selecciondo,
		            	               'costo'=>$costo_pro_selecciondo,
		            	               'cantidad'=>$cantidad_pro_selecciondo);
  						// metemos al objeto producto en el vector
						 array_push($arreglo, $nuevoproducto);
						$_SESSION['carrito'] = $arreglo;
						// ponemos el arreglo en la sesión 
						$datos = $_SESSION['carrito'];
						//Lo enviamos a la tabla
						tabladetalle($datos);
			        }		           
		        }
		        							
						 	$num_elementos=$num_elementos+1;
						}














						$lista_productos = $_POST['idarticulo'];//ENVIO LA LISTA DE LOS PRODUCTOS A U NUEVO ARREGLO
						foreach ($lista_productos as $row) {

							//OBTENGO LA EXISTENCIA ACTUAL DE CADA PRODUCTO A COMPRAR PARA SUMAR LA CANTIDAD A COMPRAR
			 				$sql ="SELECT * FROM tb_producto WHERE int_idproducto = '$row[idarticulo]'";
							$result_existencia = $modelo->get_query($sql);

							if($result_existencia[0]=='1'){
								//SUMO LA CANTIDAD A COMPRAR, CON LA EXISTENCIA ACTUAL DEL PRODUCTO
								$existencia_Actual = $result_existencia[2][0]['int_existencia'];
								$nueva_existencia = 0;
								$nueva_existencia = $existencia_Actual + $row['cantidad'];
							}else{
								//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
								$array = array("Error","existencias",$result_existencia);
								print json_encode($array);
								exit();
							}
							//INSERTANDO EN LA TABLA DETALLE-COMPRA
							$id_insertar = $modelo->retonrar_id_insertar("tb_detalle_compra");				
					        $array_insertar = array(
					            "table" => "tb_detalle_compra",
					            "int_iddcompra"=> $id_insertar,
					            "int_cantidad_compra" => $row['cantidad'],
					            "dou_costo_compra" => $row['costo_item_compra'],
					            "dou_subtotal_item_compra" => $row['subtotal'],
					            "int_idproducto" =>  $row['idarticulo'],
					            "int_idcompra" => $result_ultima_compra[2][0]['int_idcompra']
					        );
					        $result_det_compra = $modelo->insertar_generica($array_insertar);
					        //ACTUALIZO L EXISTANCIA DE LOS PRODUCTOS COMPRADOS 
				        	$array_update_stock_productos = array(
					            "table" => "tb_producto",
					            "int_idproducto" => $row['idarticulo'],
					            "int_existencia"=> $nueva_existencia           
				       		);
							$resultado_stock = $modelo->actualizar_generica($array_update_stock_productos);
						}
		  	}
		}else{
		       // si no existe, comprobamos que recibimos un producto
		    if (isset($_POST['idproducto'])) {
		       	    
		       	    $sql ="SELECT int_idproducto, nva_nom_producto, dou_costo_producto FROM tb_producto WHERE int_idproducto = '$_POST[idproducto]'";
					$result = $modelo->get_query($sql);

		            // guardamos algunos datos del resultado en variables
		            if($result[0]=='1'){

			           foreach($result[2] as $row){
							$id_pro_selecciondo = $row['int_idproducto'];
							$nombre_pro_selecciondo = $row['nva_nom_producto'];
							$costo_pro_selecciondo = $row['dou_costo_producto'];
							$cantidad_pro_selecciondo = 1;
						} 
						$arreglo[] = array('id'=>$_POST['idproducto'],
		            	               'nombre'=>$nombre_pro_selecciondo,
		            	               'costo'=>$costo_pro_selecciondo,
		            	               'cantidad'=>1); 
						$_SESSION['carrito'] = $arreglo;

						$datos = $_SESSION['carrito'];
						tabladetalle($datos);
			        }
		            // ponemos esas variables como atributos de un objeto de un array de objetos
		            // como es la primera vez que entra (por condición de condicional) el valor de cantidad por defecto es uno 
		           

		            // metemos al vector en la sesión
		           
		    }
		    
				
				
				
			
				 	$agregar_pro_seleccionado =	$_SESSION['compra'];
					$subtotal_todos = 0;
					$total_todos = 0;
					$iva_total = 0;
					$iva_producto = 0;
					$htmltr = $html="";
					foreach ($agregar_pro_seleccionado as $row) {
							
							$subtotal_producto = $row['cantidad'] * $row['costo'];
							$subtotal_todos = $subtotal_todos + $subtotal_producto;

							 $htmltr.='<tr>
				                            <td>'.$row['nombre'].'</td>

				                            <td class="text-center "><input type="text" id="costo_fila_pro" name="costo_fila_pro" autocomplete="off" class="form-control validcion_solo_numeros_totales" id="costo_producto"placeholder="$1.50" value = '.$row['costo'].'>
				                            </td>
				                            <td class="text-center"><input type="number"  id="cantidad_fila_pro" name="cantidad_fila_pro" autocomplete="off" class="form-control" placeholder="25" value = '.$row['cantidad'].' >
				                            </td>
				                            <td class="text-center "><input type="text" id="subtotal_fila_pro" name="subtotal_fila_pro" autocomplete="off" class="form-control validcion_solo_numeros_totales" readonly placeholder="$37.50" id="subtotal_producto" value = '.$subtotal_producto.'>
				                            </td>
				                            <td class="text-center project-actions">
			                                    <button class="btn btn-info btn-sm btn_actualizar_item" href="javascript:void(0)" data-idproducto_actualizar="'.$row['id'].'"> 
			                                        <i class="fa fa-sync-alt"></i>
			                                    </button>
			                                    <a class="btn btn-danger btn-sm btn_quitar_item" href="javascript:void(0)" data-idproducto_quitar="'.$row['id'].'">
			                                        <i class="fas fa-trash"></i>
			                                    </a>                     
			                                </td>
				                        </tr>';	
						}


						if ($iva_total == 0) {
							$total_todos = $subtotal_todos;
						}else{
							$total_todos = $subtotal_todos + $iva_total;
						}
						$totales = array($total_todos,$subtotal_todos,$iva_total);
						
						$html.='<table class="table table-striped projects" width="100%">
			                    <thead>
			                        <tr>
			                            <th >Producto</th>
			                            <th class="text-center col-2" >Costo Unitario</th>
			                            <th class="text-center col-2" >Cantidad</th>
			                            <th class="text-center col-2" >Sub Total</th>
			                            <th class="text-center col-2" >Acción</th>
			                        </tr>
			                    </thead>
			                    <tbody>';
			            $html.=$htmltr;
						$html.='</tbody>
			                    	</table>';
			                    	' <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h3 class="card-title">Compras</h3>
                                    </div>
                                    <form action="enhanced-results.html">
                                        <div class="row">
                                            <div class="col-md-10
                                                offset-md-1">
                                                <div class="row">
                                                    <div class="col-3">
		                                                <div class="form-group">
		                                                    <label>Proveedor</label>
		                                                    <div class="input-group
		                                                    mb-3">
		                                                        <select class="form-control">
		                                                            <option selected="selected">Todos</option>
		                                                            <option>Salinera Turcios</option>
		                                                            <option>Agroservicio El Frutal</option>
		                                                            <option>Agua El Manantial</option>
		                                                            <option>Finca Cuscatlán</option>
		                                                        </select>
		                                                    </div>
		                                                </div>
		                                            </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>Cliente</label>
                                                            <div class="input-group
                                                            mb-3">
                                                                <select class="form-control">
                                                                    <option selected="selected">Todos</option>
                                                                    <option>Cliente Frecuente</option>            
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
		                                            <div class="col-3">
		                                            	<div class="form-group">
		                                                    <label>Tipo Documento</label>
		                                                    <select class="form-control">
		                                                        <option selected="selected">Factura</option>
		                                                        <option>Ticket</option>
		                                                        <option>Crédito Fiscal</option>
		                                                    </select>
		                                                </div>		                                                
		                                            </div>
		                                            <div class="col-3">
		                                            	<div class="form-group">
		                                                    <label>No. Documento</label>
		                                                    <input type="text" onkeypress="return controltag(event)" class="form-control" id="descrip_compra" placeholder="1234567">
		                                                </div>
		                                              
		                                            </div>
		                                            
		                                            <div class="col-12">
		                                                <div class="form-group">
										                    <label for="">Descripción</label>
										                    <input type="text" class="form-control" id="descrip_compra" placeholder="Nueva Compra">
										                 </div>
								                	</div>
									                <div class="col-6">
		                                                <div class="form-group">
										                    <label for="">Sitio de Compra</label>
										                    <input type="text" class="form-control" id="sitio_compra" placeholder="San Vicente">
										                </div>
									                </div>
									                <div class="col-3">
		                                                <div class="form-group">
		                                                    <label>Fecha Compra</label>
		                                                    <div class="input-group mb-3">
		                                                        <input type="datetime-local" class="form-control
		                                                        disabled" placeholder="Juan...">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="col-3">
		                                                  <div class="form-group">
		                                                    <label>Fecha Sistema</label>
		                                                    <div class="input-group mb-3">
		                                                        <input type="text" class="form-control" value="<?php echo date('d/m/Y G:i:s');?>" disabled>
		                                                    </div>
		                                                </div>
		                                            </div>
                                                </div>
                                                
                                                <div class="form-group text-center">
                                                    <a class="btn bg-success" data-toggle="modal" data-target="#modalAgregar">
                                                        <i class="fas fa-shopping-cart"></i>
                                                        Agregar Producto
                                                    </a>
                                                    <a class="btn bg-success">
                                                        <i class="fa fa-trash"></i>
                                                        Limpiar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
'
		} ?>