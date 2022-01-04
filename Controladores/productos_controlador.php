<?php 
	
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();
	if (isset($_GET['subir_imagen']) && $_GET['subir_imagen']=="subir_imagen_ajax") {
		$trozos=explode(".",$_FILES['file-0']['name']);
		$extension= end($trozos);
		$name="img_".$_GET['id'].".".$extension;
		$file_path = "../archivo_expdiente/".$name;
		try {
			$mover = move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path);
			$array_update= array(
				"table" => "tb_producto",
				"int_idproducto"=>$_GET['id'],
				"nva_image_producto"=> $file_path,
			);
			$resultado =$modelo->actualizar_generica($array_update);
			if($resultado[0]=='1' && $resultado[4]>0){
 			print json_encode(array("Exito",$mover,$resultado));

			}else{
             print json_encode(array("Error",$mover,$resultado));

			}			 
		} catch (Exception $e) {
			print json_encode(array("Error",$_POST));
				exit();
		}
		 

	}else if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="si_actualizalo") {
		$array_update = array(
            "table" => "tb_producto",
            "int_idproducto" => $_POST['llave_producto'],
            "nva_nom_producto"=>$_POST['nombre_Producto'],
            "txt_descrip_producto" => $_POST['descrip_Producto'],
            "dat_fecha_vencimiento" => $modelo->formatear_fecha($_POST['fechav_Producto']),
            "dou_costo_producto" => $_POST['precio_Producto'], 
            "dou_precio_venta_producto" => $_POST['costo_Producto'], 
            "int_existencia" => $_POST['existencia_Producto'],
            "nva_estado_producto" => $_POST['estado_productos'],
            "int_idcategoria" => $_POST['categoria_Producto']
        );
		$resultado = $modelo->actualizar_generica($array_update);

		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }

	}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_coneste_id") {


			$array_select = array(
			"table"=>"tb_categoria",
			"int_idcategoria"=>"nva_nom_categoria" 

		);
		//$where = "WHERE nva_nom_categoria='".$_POST['nombre_categoria']."'";
		$result_select = $modelo->crear_select($array_select);


		$resultado = $modelo->get_todos("tb_producto","WHERE int_idproducto = '".$_POST['id']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0],$result_select));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }

	}else if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevo") {
		$id_insertar = $modelo->retonrar_id_insertar("tb_producto"); 
		$estado_producto = "Activo";
        $array_insertar = array(
            "table" => "tb_producto",
            "int_idproducto"=>$id_insertar,
            "nva_nom_producto" => $_POST['nombre_Producto'],
            "int_existencia" => $_POST['existencia_Producto'],
            "dou_costo_producto" => $_POST['precio_Producto'],
            "dou_precio_venta_producto" => $_POST['costo_Producto'],
            "txt_descrip_producto" => $_POST['descrip_Producto'],
            "dat_fecha_vencimiento" => $modelo->formatear_fecha($_POST['fechav_Producto']),
            "nva_estado_producto" => $estado_producto,
            "int_idcategoria" => $_POST['categoria_Producto']  
        );
        $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){


        	print json_encode(array("Exito",$id_insertar,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
    
		 
	}else if (isset($_POST['baja_datos']) && $_POST['baja_datos']=="si_baja") {
		$estado="inactivo";
			$array_update = array(
            "table" => "tb_producto",
            "int_idproducto" => $_POST['id_producto_baja'],
            "nva_estado_producto"=>$estado
        );

			$resultado_Expediente = $modelo->actualizar_generica($array_update);

			if ($resultado_Expediente[0] == '1') {
				print json_encode(array("Exito",$_POST,$resultado_Expediente));
				exit();
			}else{
				print json_encode(array("Exito",$_POST,$resultado_Expediente));
				exit();
			}
        	
	 
	}else if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevoc") {
		$id_insertar = $modelo->retonrar_id_insertar("tb_categoria"); 
        $array_insertar = array(
            "table" => "tb_categoria",
            "int_idcategoria"=>$id_insertar,
            "nva_nom_categoria" => $_POST['nombre_Categoria']
        );
        $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){
        	print json_encode(array("Exito",$id_insertar,$_POST,$result));
			exit();
        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
    
		 
	}else{

		$array_select = array(
			"table"=>"tb_categoria",
			"int_idcategoria"=>"nva_nom_categoria"

		);		 
		$result_select = $modelo->crear_select($array_select);
		$htmltr = $html="";
		$cuantos = 0;
		$sql = "SELECT
						int_idproducto,
                        nva_nom_producto,
                        int_existencia,
                        dou_costo_producto,
                        dou_precio_venta_producto,
                        txt_descrip_producto,
                        dat_fecha_vencimiento,
                        nva_nom_categoria,
                        nva_image_producto,
                        nva_estado_producto
                    FROM
                        tb_producto 
                        INNER JOIN
                        tb_categoria 
                        ON 
                            tb_producto.int_idcategoria = tb_categoria.int_idcategoria WHERE nva_estado_producto = 'Activo'";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {	
				 $htmltr.='<tr>
	                            <td>'.$row['nva_nom_producto'].'</td>
	                            <td><img alt="img" width="90" height="100" src="'.$row['nva_image_producto'].'"></td>
	                            <td>'.$row['int_existencia'].'</td>
	                            <td>$'.$row['dou_costo_producto'].'</td>
	                            <td>$'.$row['dou_precio_venta_producto'].'</td>
	                            <td>'.$modelo->formatear_fecha($row['dat_fecha_vencimiento']).'</td>
	                            <td>'.$row['nva_nom_categoria'].'</td>	                           
	                            <td class="text-center project-actions">
			                        <button class="btn btn-info btn-sm btn_editar" 
			                        	data-idproducto='.$row['int_idproducto'].' data-nombrecategoria='.$row['nva_nom_categoria'].'>
			                            <i class="fas fa-pencil-alt"></i>
			                        </button>
			                        <button class="btn btn-danger btn-sm btn_baja"  
			                            data-idcltbaja='.$row['int_idproducto'].' >
			                            <i class="fas fa-trash"></i>
			                        </button>
			                    </td>
	                        </tr>';	
			}
			$html.='<table id="example1" class="table table-striped projects"  style="text-align:center;"width="100%">
                    <thead>
                        <tr>
                            <th >Producto</th>
                            <th style="width: 20%">Imagen</th>
                            <th style="width: 1%">Existencia</th>
                            <th style="width: 1%">Costo</th>
                            <th style="width: 1%">Precio</th>
                            <th>Fecha Vencimiento</th>
                            <th style="width: 1%">Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';


        	print json_encode(array("Exito",$html,$cuantos,$result_select,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
	}

?>