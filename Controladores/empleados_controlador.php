<?php 
	
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();
	if (isset($_POST['validar_campos']) && $_POST['validar_campos']=="si_por_campo") {

 
		$array_seleccionar = array();
		$array_seleccionar['table']="tb_persona";
		$array_seleccionar['campo']="id";

		if ($_POST['tipo']=="email") {
			$array_seleccionar['email']=$_POST['campo'];
		}else if ($_POST['tipo']=="usuario") {
			$array_seleccionar['table']="tb_usuario";
			$array_seleccionar['usuario']=$_POST['campo'];
		
		}else if ($_POST['tipo']=="dui") { 
			$array_seleccionar['dui']=$_POST['campo'];
		}else{
			$array_seleccionar['telefono']=$_POST['campo'];
		
		}

		

		$resultado = $modelo->seleccionar_cualquiera($array_seleccionar);
		if ($resultado[0]==0 && $resultado[4]==0) {
			print json_encode(array("Exito",$resultado,$array_seleccionar));
			exit();
		}else{
			print json_encode(array("Error",$resultado,$array_seleccionar));
			exit();
		}



	}else if (isset($_GET['subir_imagen']) && $_GET['subir_imagen']=="subir_imagen_ajax") {

		$file_path = "archivos_usuario/".basename($_FILES['file-0']['name']);
		try {
			$mover = move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path);
			 
				 print json_encode("Exito",$mover);
				 exit();
			 
		} catch (Exception $e) {
			print json_encode("Error",$e);
				exit();
		}
		


		 

	}else if (isset($_POST['consultar_municipios']) && $_POST['consultar_municipios']=="si_pordeptos") {

		$array_select = array(
			"table"=>"tb_municipios",
			"ID"=>"MunName" 

		);
		$where = "WHERE DEPSV_ID='".$_POST['depto']."'";
		$result_select = $modelo->crear_select($array_select,$where);
		if ($result_select[0]!=0) {
			print json_encode(array("Exito",$result_select));
			exit();
		}else{
			print json_encode(array("Error",$result_select));
			exit();
		}


	}else if (isset($_POST['enviar_contra']) && $_POST['enviar_contra']=="si_enviala") {
        
        $nueva_contra = $modelo->generarpass();
        $array_update = array(
            "table" => "tb_usuario",
            "id_persona" => $_POST['id'],
            "contrasena" => $modelo->encriptarlas_contrasenas($nueva_contra)
        );
        $resultado = $modelo->actualizar_generica($array_update);

        if($resultado[0]=='1' && $resultado[4]>0){

            $mensaje = $modelo->plantilla($nueva_contra);
            $titulo="Recuperación de contraseña";
            $para = $_POST['email'];
            $resultado = $modelo->envio_correo($para,$titulo,$mensaje);
            if ($resultado[0]==1) {
                print json_encode(array("Exito",$_POST,$resultado));
                exit();
            }else{
                print json_encode(array("Error",$_POST,$resultado));
                exit();
            }
            

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }


        print json_encode($_POST);


    }else if (isset($_POST['eliminar_persona']) && $_POST['eliminar_persona']=="si_eliminala") {
		$array_eliminar = array(
			"table"=>"tb_persona",
			"id"=>$_POST['id']

		);
		$resultado = $modelo->eliminar_generica($array_eliminar);
		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }
		


	}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_actualizalo") {
		$_POST['direccion'] = "Sin direccion";
		$array_update = array(
            "table" => "tb_persona",
            "id" => $_POST['llave_persona'],
            "dui"=>$_POST['dui'],
            "nombre" => $_POST['nombre'],
            "email" => $_POST['email'],
            "direccion" => $_POST['direccion'], 
            "telefono" => $_POST['telefono'],
            "fecha_nacimiento" => $modelo->formatear_fecha($_POST['fecha']), 
            "tipo_persona" => $_POST['tipo_persona']
        );
		$resultado = $modelo->actualizar_generica($array_update);

		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }


	}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_condui_especifico") {


		
		$resultado = $modelo->get_todos("tb_persona","WHERE id = '".$_POST['id']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



	}else if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevo") {		
		$id_insertar = $modelo->retonrar_id_insertar("tb_empleado");
		$estado_empleado = "Activo" ;
        $array_insertar = array(
            "table" => "tb_empleado",
            "int_idempleado"=>$id_insertar,
            "nva_dui_empledao" => $_POST['dui_empleado'],
            "nva_nom_empleado" => $_POST['nombre_empleado'],
            "nva_ape_empleado" => $_POST['apellido_empleado'],
            "txt_direc_empleado" => $_POST['direc_empleado'],
            "dat_fechanaci_empleado" => $_POST['fecha_naci_empleado'],
            "dou_salario_empleado" => $_POST['salario_empleado'],
            "nva_telefono_empleado" => $_POST['telefono_empleado'],
            "int_idcargo" => $_POST['cargo_empleado'],
            "nva_estado_empleado" => $estado_empleado,
            "nva_sexo_empleado" => $_POST['sexo_empleado']
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
			"table"=>"tb_cargo",
			"idcargo"=>"nva_nom_cargo"

		);
		 
		$result_select = $modelo->crear_select($array_select);


		$htmltr = $html="";
		$cuantos = 0;
		$sql = "SELECT
					int_idempleado, 
					nva_dui_empledao, 
					nva_nom_empleado, 
					nva_ape_empleado, 
					txt_direc_empleado, 
					dat_fechanaci_empleado, 
					dou_salario_empleado, 
					nva_telefono_empleado, 
					nva_email_empleado, 
					nva_estado_empleado, 
					nva_sexo_empleado, 
					nva_nom_cargo
				FROM
					tb_empleado
					INNER JOIN
					tb_cargo
					ON 
						tb_empleado.int_idcargo = tb_cargo.idcargo WHERE int_idcargo != 202109352;";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {	
				 $htmltr.='<tr>
	                            <td class="text-center">'.$row['nva_dui_empledao'].'</td>
	                            <td class="text-center">'.$row['nva_nom_empleado'].'</td>
	                            <td class="text-center">'.$row['nva_ape_empleado'].'</td>
	                            <td class="text-center">'.$modelo->formatear_fecha($row['dat_fechanaci_empleado']).'</td>
	                            <td class="text-center">'.$row['nva_nom_cargo'].'</td>	                            
	                            <td class="text-center project-actions">
			                        <button class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modalClienteEdit" data-toggle="tooltip" 
			                        	data-idempleado='.$row['int_idempleado'].'>
			                            <i class="fas fa-pencil-alt"></i>
			                        </button>
			                        <button class="btn btn-danger btn-sm" href="#modalBajaCliente" data-toggle="modal" 
			                            data-idcltbaja='.$row['int_idempleado'].'>
			                            <i class="fas fa-trash"></i>
			                        </button>
			                    </td>
	                        </tr>';	
			}
			$html.='<table class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">DUI</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Edad</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Acciones</th>
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