<?php
require_once("../Conexion/Conexion.php");
$instancia = new Conexion();
$conexion = $instancia->obtener_conexion();
$t_producto = "";
/*if(isset($_REQUEST["t_producto"])=='lechederivados'){
    $t_producto = "lechederivados";  
}
if(isset($_REQUEST["t_producto"])=='bovinos'){
        $t_producto = "bovinos";  
}*/

if (isset($_REQUEST['tipo_pro']) && $_REQUEST['tipo_pro'] =="lechederivados") {
				
				$sql ="SELECT int_idproducto, nva_nom_producto, dou_costo_producto FROM tb_producto";
                $statement = $conexion->prepare($sql); 
                $statement->execute();
                $datos = $statement->fetchAll();
                $html=$hml_td="";
                foreach ($datos as $row) {
                    $hml_td.='<tr>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_producto'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['dou_costo_producto'].'</td>';
                    $hml_td.='<td class="text-center project-actions">
                                <button class="btn btn-info btn-sm AgregarPro"  data-idpro="'.$row['int_idproducto'].'">
                                    <i class="fas fa-check"></i>
                                </button>                       
                            </td>';
                    $hml_td.='</tr>';
                }
                $html.='<table class="table table-striped projects">
                      <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
							<th class="text-center">Costo</th>
	                        <th class="text-center">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                         '.$hml_td.'
                     
                      </tbody>
                    </table>';
                print json_encode(array($html,$_POST,$datos));
	
}else if (isset($_REQUEST['tipo_pro']) && $_REQUEST['tipo_pro'] =="bovinos") {

				$sql ="SELECT nva_nom_bovino, nva_sexo_bovino, nva_tipo_bovino, nva_foto_bovino, nva_nom_raza 
				FROM tb_expediente INNER JOIN tb_raza ON tb_expediente.int_idraza = tb_raza.int_idraza";

                $statement = $conexion->prepare($sql); 
                $statement->execute();
                $datos = $statement->fetchAll();
                $html=$hml_td="";
                foreach ($datos as $row) {
                    $hml_td.='<tr>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_bovino'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_sexo_bovino'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_tipo_bovino'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_foto_bovino'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_raza'].'</td>';
                    $hml_td.='<td class="text-center project-actions">
                        <button class="btn btn-info btn-sm" href="#" id="agregarDerivado">
                            <i class="fas fa-check"></i>
                        </button>                        
                    </td>';
                    $hml_td.='</tr>';
                }
                $html.='<table class="table table-striped projects">
                      <thead>
                        <tr>
	                        <th class="text-center">Nombre</th>
	                        <th class="text-center">Sexo</th>
							<th class="text-center">Tipo</th>							
							<th class="text-center">Fotografía</th>
							<th class="text-center">Raza</th>
	                        <th class="text-center">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                         '.$hml_td.'
                     
                      </tbody>
                    </table>';
                print json_encode(array($html,$_POST,$datos));
}

				
                
                



/*	
isset($_POST['t_producto']) && $_POST['t_producto']=="lechederivados"									
'<table class="table table-sm">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Precio</th>
			<th style="width: 40px">Acción</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Botella de Leche</td>
			<td>$0.75</td>
			<td>
				<div class="form-group
					text-center">
					<a class="">
						<button type="button" class="btn
						btn-outline-primary">
						<i class="fa
						fa-check"></i>
						</button>
					</a>
				</div>
			</td>
		</tr>
	</tbody>
</table>'*/
?>