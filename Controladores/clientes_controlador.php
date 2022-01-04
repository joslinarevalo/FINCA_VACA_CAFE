<?php 
     require_once("../Conexion/Conexion.php");


 //variables de Guardar
 $dui_cl = (isset($_REQUEST["dui_cliente"])) ? $_REQUEST["dui_cliente"] : "";
 $nombre_cl = (isset($_REQUEST["nombre_Cliente"])) ? $_REQUEST["nombre_Cliente"] : "";
 $apellido_cl = (isset($_REQUEST["apellido_Cliente"])) ? $_REQUEST["apellido_Cliente"] : "";
 $direc_cl = (isset($_REQUEST["direc_cliente"])) ? $_REQUEST["direc_cliente"] : "";
 $telefono_cl = (isset($_REQUEST["telefono_Cliente"])) ? $_REQUEST["telefono_Cliente"] : "";
 $estado_cl = "Activo";



 
//variables de Actualizar
$dui_cl_edit = (isset($_REQUEST["dui_cliente_edit"])) ? $_REQUEST["dui_cliente_edit"] : "";
$nombre_cl_edit = (isset($_REQUEST["nombre_Cliente_edit"])) ? $_REQUEST["nombre_Cliente_edit"] : "";
$apellido_cl_edit= (isset($_REQUEST["apellido_Cliente_edit"])) ? $_REQUEST["apellido_Cliente_edit"] : "";
$direc_cl_edit = (isset($_REQUEST["direc_cliente_edit"])) ? $_REQUEST["direc_cliente_edit"] : "";
$telefono_cl_edit = (isset($_REQUEST["telefono_Cliente_edit"])) ? $_REQUEST["telefono_Cliente_edit"] : "";
$id_cliente_edit = (isset($_REQUEST["id_cliente_edit"])) ? $_REQUEST["id_cliente_edit"] : "";

if(isset($_POST['estado_cliente_editar']) && $_POST['estado_cliente_editar'] == "activo"){
    $estado_cl_edit = "Activo";    
}else if(isset($_POST['estado_cliente_editar']) && $_POST['estado_cliente_editar'] == "inactivo"){
    $estado_cl_edit = "Inactivo";    
}

//Variables dar Baja
$idbajacl = (isset($_REQUEST["id_baja"])) ? $_REQUEST["id_baja"] : "";
$baja_cliente= "Inactivo";

$instancia = new Conexion();
    if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevo") {
        if($dui_cl!="" && $nombre_cl!="" && $apellido_cl!="" && $direc_cl!="" && $telefono_cl!=""){
            try {

                $conectar = $instancia->obtener_conexion();
                $sql = "INSERT INTO tb_clientes(int_idcliente,nva_dui_cliente,nva_nom_cliente,nva_ape_cliente,txt_direc_cliente,nva_telefono_cliente,nva_estado_cliente) VALUES(?,?,?,?,?,?,?)";

                $statement = $conectar->prepare($sql);                       
                $statement->execute(array(null,$dui_cl,$nombre_cl,$apellido_cl,$direc_cl,$telefono_cl,$estado_cl));
                $afectados = $statement->rowCount();
                print json_encode(array("exito",$afectados));
            } catch (Exception $e) {
                print json_encode(array("error"));
            } 
        } else{
            print "NO entra al IF";
        }  
    }else if (isset($_POST['editar_datos']) && $_POST['editar_datos']=="datoeditar") {                    
                            
        if($dui_cl_edit!="" && $nombre_cl_edit!="" && $apellido_cl_edit!="" && $direc_cl_edit!="" && $telefono_cl_edit!="" && $id_cliente_edit!="" ){
                try {

                    $conectar = $instancia->obtener_conexion();
                    $sql = "UPDATE tb_clientes SET nva_dui_cliente = ?,nva_nom_cliente = ?,nva_ape_cliente = ?,txt_direc_cliente = ?,nva_telefono_cliente = ?,nva_estado_cliente = ? WHERE int_idcliente=?;";

                     $statement = $conectar->prepare($sql);                       
                    $statement->execute(array($dui_cl_edit, $nombre_cl_edit, $apellido_cl_edit, $direc_cl_edit, $telefono_cl_edit, $estado_cl_edit, $id_cliente_edit));
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
        if($idbajacl!="" ){
                try {
                    $conectar = $instancia->obtener_conexion();
                    $sql = "UPDATE tb_clientes SET nva_estado_cliente = ? WHERE int_idcliente=?;";

                     $statement = $conectar->prepare($sql);                       
                    $statement->execute(array($baja_cliente, $idbajacl));
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
                $instancia = new Conexion();
                $conexion = $instancia->obtener_conexion();
                $sql ="SELECT * FROM tb_clientes WHERE nva_estado_cliente = 'Activo' AND nva_nom_cliente != 'Cliente Frecuente'";
                $statement = $conexion->prepare($sql); 
                $statement->execute();
                $datos = $statement->fetchAll();
                $html=$hml_td="";
                foreach ($datos as $row) {
                    $hml_td.='<tr>';
                    $hml_td.='<td class="text-center">'.$row['nva_dui_cliente'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_nom_cliente'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_ape_cliente'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['txt_direc_cliente'].'</td>';
                    $hml_td.='<td class="text-center">'.$row['nva_telefono_cliente'].'</td>';
                    $hml_td.='<td class="text-center project-actions">
                        <button class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modalClienteEdit" data-toggle="tooltip" data-duiclt='.$row['nva_dui_cliente'].'  data-nombreclt='.$row['nva_nom_cliente'].' data-apellidoclt='.$row['nva_ape_cliente'].' data-direcclt='.$row['txt_direc_cliente'].' data-teledonoclt='.$row['nva_telefono_cliente'].' data-idclt='.$row['int_idcliente'].'>
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" href="#modalBajaCliente" data-toggle="modal" 
                            data-idcltbaja='.$row['int_idcliente'].'>
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>';
                    $hml_td.='</tr>';
                }
                $html.='<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th class="text-center">DUI</th>
                          <th class="text-center">Nombre</th>
                          <th class="text-center">Apellido</th>
                          <th class="text-center">Teléfono</th>
                          <th class="text-center">Dirección</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                         '.$hml_td.'
                     
                      </tbody>
                    </table>';
                print json_encode(array($html,$_POST,$datos));
    }
    
 ?>