<?php  

require_once("../Conexion/Conexion.php");

$instancia = new Conexion();
$conexion = $instancia->obtener_conexion();

if (isset($_POST['idProducto']) != "") {
                $sql ="SELECT nva_nom_producto, dou_costo_producto FROM tb_producto WHERE int_idproducto = ?;";
                $statement = $conexion->prepare($sql); 
                $statement->execute(array($_POST['idProducto']));
                $datos = $statement->fetchAll();
                $html=$hml_td="";
                foreach ($datos as $row) {
                    $hml_td.='<tr>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_producto'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['dou_costo_producto'].'</td>';
                    $hml_td.='<td>
                                <input type="number" class="form-control" placeholder="$1.50">
                              </td>';
                    $hml_td.='<td>
                                <input type="number" class="form-control" placeholder="25">
                              </td>';
                    $hml_td.='<td class="text-center project-actions">
                                    <a class="btn btn-info btn-sm" href="#" >
                                        <i class="fa fa-sync-alt"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#" >
                                        <i class="fas fa-trash"></i>
                                    </a>                     
                                </td>';
                    $hml_td.='</tr>';
                }
                $html.='<table class="table table-striped projects">
                      <thead>
                        <tr>
                            <th style="width: 300px">Producto</th>
                            <th style="width: 10px">Costo Unitario</th>
                            <th style="width: 10px">Cantidad</th>
                           <th style="width: 50px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                         '.$hml_td.'
                     
                      </tbody>
                    </table>';
                print json_encode(array($html,$_POST,$datos));
}else{

}
                
            
?>

