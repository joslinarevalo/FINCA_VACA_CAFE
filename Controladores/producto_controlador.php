<?php 
     require_once("../Conexion/Conexion.php");

$action = (isset($_REQUEST["action"])) ? $_REQUEST["action"] : "";

 //variables de Guardar
 $nombre_pr = (isset($_REQUEST["nombre_Producto"])) ? $_REQUEST["nombre_Producto"] : "";
 $existencia_pr = (isset($_REQUEST["existencia_Producto"])) ? $_REQUEST["existencia_Producto"] : "";
 $costo_pr = (isset($_REQUEST["precio_Producto"])) ? $_REQUEST["precio_Producto"] : "";
 $descrip_pr = (isset($_REQUEST["descrip_Producto"])) ? $_REQUEST["descrip_Producto"] : "";
 $fechav_pr = (isset($_REQUEST["fechav_Producto"])) ? $_REQUEST["fechav_Producto"] : "";
 $categ_pr = (isset($_REQUEST["categoria_Producto"])) ? $_REQUEST["categoria_Producto"] : "";
 $estado_pro = "Activo";

//variables de Actualizar
$nombre_pr_edit = (isset($_REQUEST["nombre_Producto_edit"])) ? $_REQUEST["nombre_Producto_edit"] : "";
$existencia_pr_edit = (isset($_REQUEST["existencia_Producto_edit"])) ? $_REQUEST["existencia_Producto_edit"] : "";
$costo_pr_edit= (isset($_REQUEST["precio_Producto_edit"])) ? $_REQUEST["precio_Producto_edit"] : "";
$descrip_pr_edit = (isset($_REQUEST["descrip_Producto_edit"])) ? $_REQUEST["descrip_Producto_edit"] : "";
$fechav_pr_edit = (isset($_REQUEST["fechav_Producto_edit"])) ? $_REQUEST["fechav_Producto_edit"] : "";
$categ_pr_edit = (isset($_REQUEST["categoria_Producto_edit"])) ? $_REQUEST["categoria_Producto_edit"] : "";
$id_produ_edit = (isset($_REQUEST["id_Producto_edit"])) ? $_REQUEST["id_Producto_edit"] : "";


if(isset($_POST['estado_producto_edit']) && $_POST['estado_producto_edit'] == "activo"){
    $estado_pro_edit = "Activo";    
}else if(isset($_POST['estado_producto_edit']) && $_POST['estado_producto_edit'] == "inactivo"){
    $estado_pro_edit = "Inactivo";    
}

//Variables dar Baja
$idbajapr = (isset($_REQUEST["id_baja"])) ? $_REQUEST["id_baja"] : "";
$baja_producto= "Inactivo";

$instancia = new Conexion();
    if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevo") {
        if($nombre_pr!="" && $existencia_pr!="" && $costo_pr!="" && $descrip_pr!="" && $fechav_pr!="" && $categ_pr!=""){
            try {
                $conectar = $instancia->obtener_conexion();
                $sql = "INSERT INTO tb_producto(int_idproducto,nva_nom_producto,int_existencia,dou_costo_producto,txt_descrip_producto,dat_fecha_vencimiento,int_idcategoria,nva_estado_producto) VALUES(?,?,?,?,?,?,?,?)";

                $statement = $conectar->prepare($sql);                       
                $statement->execute(array(null,$nombre_pr,$existencia_pr,$costo_pr,$descrip_pr,$fechav_pr,$categ_pr,$estado_pro));
                $afectados = $statement->rowCount();
                    print json_encode(array("exito",$afectados));
            } catch (Exception $e) {
                print json_encode(array("error"));
            }              
                
        } else{
            print "NO entra al IF";
        }
     }else if (isset($_POST['editar_datos']) && $_POST['editar_datos']=="datoeditar") {                    
                            
        if($nombre_pr_edit!="" && $existencia_pr_edit!="" && $costo_pr_edit!="" && $descrip_pr_edit!="" && $fechav_pr_edit!="" && $categ_pr_edit!="" && $id_produ_edit!="" ){
                try {

                    $conectar = $instancia->obtener_conexion();
                    $sql = "UPDATE tb_producto SET nva_nom_producto = ?,int_existencia = ?,dou_costo_producto = ?,txt_descrip_producto = ?,dat_fecha_vencimiento = ?,nva_estado_producto = ?, int_idcategoria = ? WHERE int_idproducto=?;";

                     $statement = $conectar->prepare($sql);                       
                    $statement->execute(array($nombre_pr_edit, $existencia_pr_edit, $costo_pr_edit, $descrip_pr_edit, $fechav_pr_edit, $estado_pro_edit, $categ_pr_edit, $id_produ_edit));
                    $afectados = $statement->rowCount();
                    print json_encode(array("exito",$afectados));

                } catch (Exception $e) {
                    print json_encode(array("error"));
                     print $e;
                } 
        } else{
            print "NO entra al IF";
        }
    }else if (isset($_POST['baja_datos']) && $_POST['baja_datos']=="datobaja") {
        if($idbajapr!="" ){
                try {
                    $conectar = $instancia->obtener_conexion();
                    $sql = "UPDATE tb_producto SET nva_estado_producto = ? WHERE int_idproducto=?;";

                     $statement = $conectar->prepare($sql);                       
                    $statement->execute(array($baja_producto, $idbajapr));
                    $afectados = $statement->rowCount();
                    print json_encode(array("exito",$afectados));

                } catch (Exception $e) {
                    print json_encode(array("error"));
                     print $e;
                } 
        } else{
            print "NO entra al IF";
        }
    }else{

                
                $conexion = $instancia->obtener_conexion();
                $sql ="SELECT
                        nva_nom_producto,
                        int_existencia,
                        dou_costo_producto,
                        txt_descrip_producto,
                        dat_fecha_vencimiento,
                        nva_nom_categoria
                    FROM
                        tb_producto 
                        INNER JOIN
                        tb_categoria 
                        ON 
                            tb_producto.int_idcategoria = tb_categoria.int_idcategoria;";
                $statement = $conexion->prepare($sql); 
                $statement->execute();
                $datos = $statement->fetchAll();
                $html=$hml_td="";
                foreach ($datos as $row) {
                    $hml_td.='<tr>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_producto'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['int_existencia'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['dou_costo_producto'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['txt_descrip_producto'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['dat_fecha_vencimiento'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_categoria'].'</td>';
                    $hml_td.='<td class="text-center project-actions">
                        <button class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modalProductoEdit" data-toggle="tooltip"
                        data-namepro='.$row['nva_nom_producto'].'  data-exispro='.$row['int_existencia'].' data-costopro='.$row['dou_costo_producto'].' data-descpro='.$row['txt_descrip_producto'].' data-fechapro='.$row['dat_fecha_vencimiento'].' data-idpro='.$row['nva_nom_categoria'].'>
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" href="#modalBajaCliente" data-toggle="modal">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>';
                    $hml_td.='</tr>';
                }
                $html.='<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th class="text-center">Producto</th>
                          <th class="text-center">Existencia</th>
                          <th class="text-center">Costo</th>
                          <th class="text-center">Descripción</th>
                          <th class="text-center">Fecha</th>
                          <th class="text-center">Categoria</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                         '.$hml_td.'
                     
                      </tbody>
                    </table>';
                print json_encode(array($html,$_POST,$datos));



               /* $instancia = new Conexion();
                $conexion = $instancia->obtener_conexion();
                $sql = "SELECT * FROM tb_producto WHERE nva_estado_producto = 'Activo' and nva_nom_producto != 'Holaaaaass'";
                $statement = $conexion->prepare($sql); 
                $statement->execute();
                $datos = $statement->fetchAll();
                $html=$hml_td="";
                foreach ($datos as $row) {
                    $hml_td.='<tr>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_producto'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['int_existencia'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['dou_costo_producto'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['txt_descrip_producto'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['dat_fecha_vencimiento'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_categoria'].'</td>';
                    $hml_td.='<td class="text-center project-actions">
                                <button class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modalProductoEdit" data-toggle="tooltip" data-namepro='.$row['nva_nom_producto'].'  data-exispro='.$row['int_existencia'].' data-costopro='.$row['dou_costo_producto'].' data-descpro='.$row['txt_descrip_producto'].' data-fechapro='.$row['dat_fecha_vencimiento'].' data-catepro='.$row['nva_nom_categoria'].' data-idpro='.$row['int_idproducto'].'>
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" href="#modalBajaProducto" data-toggle="modal" 
                                    data-idprobaja='.$row['int_idproducto'].'>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>';
                    $hml_td.='</tr>';
                }
                    
                $html.='<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th class="text-center">Producto</th>
                          <th class="text-center">Existencia</th>
                          <th class="text-center">Costo</th>
                          <th class="text-center">Descripción</th>
                          <th class="text-center">Fecha</th>
                          <th class="text-center">Categoria</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                         '.$hml_td.'
                     
                      </tbody>
                    </table>';
                print json_encode(array($html,$_POST,$datos));*/
    }          
           
        
    
 ?>