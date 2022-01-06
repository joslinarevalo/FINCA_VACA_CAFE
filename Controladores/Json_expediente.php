<?php
require_once("../Conexion/Modelo.php");
$modelo = new Modelo();

if (isset($_GET['subir_imagen']) && $_GET['subir_imagen'] == "subir_imagen_ajax") {
	$trozos = explode(".", $_FILES['file-0']['name']);
	$extension = end($trozos);
	$name = "img_" . $_GET['id'] . "." . $extension;
	$file_path = "../archivo_carta_venta/" . $name;
	try {
		$mover = move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path);
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_GET['id'],
			"nva_carta_venta" => $file_path, //campo en la tabla

		);
		$resultado = $modelo->actualizar_generica($array_update);
		if ($resultado[0] == '1' && $resultado[4] > 0) {
			print json_encode(array("Exito", $mover, $resultado));
		} else {
			print json_encode(array("Error", $mover, $resultado));
		}
	} catch (Exception $e) {
		print json_encode(array("Error", $_POST));
		exit();
	}
} else if (isset($_GET['subir_imagen']) && $_GET['subir_imagen'] == "subir_imagen_bovino") {
	$trozos = explode(".", $_FILES['file-0']['name']);
	$extension = end($trozos);
	$name = "img_" . $_GET['id'] . "." . $extension;
	$file_path = "../archivo_expdiente/" . $name;
	try {
		$mover = move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path);
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_GET['id'],
			"nva_foto_bovino" => $file_path //campo en la tabla
		);
		$resultado = $modelo->actualizar_generica($array_update);
		if ($resultado[0] == '1' && $resultado[4] > 0) {
			print json_encode(array("Exito", $mover, $resultado));
		} else {
			print json_encode(array("Error", $mover, $resultado));
		}
	} catch (Exception $e) {
		print json_encode(array("Error", $_POST));
		exit();
	}
} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_expediente_especifico") {
	$sql = "SELECT
					*
				FROM
					tb_expediente WHERE int_idexpediente = '$_POST[idexpediente]'";


	$resultado = $modelo->get_query($sql);
	//get_todos("tb_expediente","WHERE int_idexpediente = '".$_POST['idexpediente']."'");
	if ($resultado[0] == '1') {
		print json_encode(array("Exito", $_POST, $resultado[2][0]));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
	}
} else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_registro") {
	if (isset($_POST['int_cant_parto']) && isset($_POST['dat_fecha_ult_parto'])) {
		$id_insertar = $modelo->retonrar_id_insertar("tb_expediente");
		$estado_bovino = "activo";
		$array_insertar = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $id_insertar,
			"nva_nom_bovino" => $_POST['nom_bovino'],
			"nva_estado_bovino" => $estado_bovino,

			"nva_sexo_bovino" => $_POST['sexo_bovino'],
			"int_cant_parto" => $_POST['cant_parto_bovino'],
			"txt_descrip_expediente" => $_POST['descrip_expediente'],
			"int_id_propietario" => $_POST['propietario'],
			"int_idraza" => $_POST['raza_bovino_select'],
			"nva_tipo_bovino" => $_POST['tipo_bovino'],
			"dat_fecha_ult_parto" => $modelo->formatear_fecha($_POST['fecha_ult_parto']),
		);
	} else {
		$id_insertar = $modelo->retonrar_id_insertar("tb_expediente");
		$estado_bovino = "activo";
		$array_insertar = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $id_insertar,
			"nva_nom_bovino" => $_POST['nom_bovino'],
			"nva_estado_bovino" => $estado_bovino,

			"nva_sexo_bovino" => $_POST['sexo_bovino'],
			"txt_descrip_expediente" => $_POST['descrip_expediente'],
			"int_id_propietario" => $_POST['propietario'],
			"int_idraza" => $_POST['raza_bovino_select'],
			"nva_tipo_bovino" => $_POST['tipo_bovino']
		);
	}

	$result = $modelo->insertar_generica($array_insertar);
	if ($result[0] == '1') {
		print json_encode(array("Exito", $id_insertar, $result));
		exit();
	} else {
		print json_encode(array("Error", $result));
		exit();
	}
} else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_actualizalo") {

	if (isset($_POST['int_cant_parto']) && isset($_POST['dat_fecha_ult_parto'])) {

		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_POST['llave_expediente'],
			"nva_nom_bovino" => $_POST['nva_nom_bovino'],
			"nva_estado_bovino" => $estado_bovino,
			"nva_sexo_bovino" => $_POST['nva_sexo_bovino'],
			"int_cant_parto" => $_POST['int_cant_parto'],
			//"nva_carta_venta" => $_POST['nva_carta_venta'],
			//"nva_foto_bovino" => $_POST['nva_foto_bovino'],
			"txt_descrip_expediente" => $_POST['txt_descrip_expediente'],
			"int_id_propietario" => $_POST['propietario'],
			"int_idraza" => $_POST['int_idraza'],
			"nva_tipo_bovino" => $_POST['nva_tipo_bovino'],
			"dat_fecha_ult_parto" => $modelo->formatear_fecha($_POST['dat_fecha_ult_parto'])
		);
	} else {
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_POST['llave_expediente'],
			"nva_nom_bovino" => $_POST['nva_nom_bovino'],
			"nva_estado_bovino" => $estado_bovino,
			"nva_sexo_bovino" => $_POST['nva_sexo_bovino'],
			"txt_descrip_expediente" => $_POST['txt_descrip_expediente'],
			"int_id_propietario" => $_POST['propietario'],
			"int_idraza" => $_POST['int_idraza'],
			"nva_tipo_bovino" => $_POST['nva_tipo_bovino']
		);
	}

	$resultado = $modelo->actualizar_generica($array_update);

	if ($resultado[0] == '1' && $resultado[4] > 0) {
		print json_encode(array("Exito", $_POST, $resultado));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
	}
} else {
	$htmltr = $html = "";
	$cuantos = 0;
	$sql = "SELECT
					nva_nom_raza, 
					int_idexpediente, 
					nva_nom_bovino, 
					txt_descrip_expediente, 
					nva_carta_venta,
					nva_nombres_propietario
				FROM
					tb_expediente
					INNER JOIN
					tb_propietario
					ON 
						tb_expediente.int_id_propietario = tb_propietario.int_id_propietario
					INNER JOIN
					tb_raza
					ON 
						tb_expediente.int_idraza = tb_raza.int_idraza";
	$result = $modelo->get_query($sql);
	if ($result[0] == '1') {

		foreach ($result[2] as $row) {
			$htmltr .= '<tr>
	                            <td>' . $row['nva_nom_bovino'] . '</td>
	                            <td><img alt="img" width="90" height="100" src="' . $row['nva_carta_venta'] . '"></td>
	                            <td>' . $row['txt_descrip_expediente'] . '</td>
	                            <td>' . $row['nva_nombres_propietario'] . '</td>
	                            <td>' . $row['nva_nom_raza'] . '</td>
	                            <td>
	                            <button class="btn btn-info btn-sm btn_editar"
			                        	data-int_idexpediente=' . $row['int_idexpediente'] . '>
			                            <i class="fas fa-pencil-alt"></i>
			                        </button>
			                          <button class="btn btn-danger btn-sm btn_baja"
			                        	data-int_idexpediente=' . $row['int_idexpediente'] . '>
			                            <i class="fas fa-trash"></i>
			                        </button>
			                </td>
	                        </tr>';
		}
		$html .= '<table id="tabla_expediente" class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                            <th>Bovino</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Propietario</th>
                            <th>Raza</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
		$html .= $htmltr;
		$html .= '</tbody>
                    	</table>';
		print json_encode(array("Exito", $html, $_POST, $result));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $result));
		exit();
	}
}
