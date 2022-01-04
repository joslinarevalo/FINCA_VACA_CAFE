<?php
require_once ("../Conexion/Conexion.php");



class DaoCliente{
    var $instancia;
    var $Conexion;
    var $Errno=0;
    var $Error="";
    
    function __construct(){
        $this->instancia=new Conexion();
        
    }
    function listaClientes(){

        $sql ="SELECT * FROM tb_clientes";
        $Conexion = $instancia->obtener_conexion();
        $statement = $Conexion->prepare($sql); 
        $statement->execute();
        $datos = $statement->fetchAll();
        
        return $datos;
    }
    function registroClientes(Cliente $cl){
        
            if(!($cl instanceof Cliente)){
                $this->Error="Error de instanciado,\n el objeto no es de tipo Clase Cliente";
                return 0;
            }            
            $result= $this->Conexion_ID->query("insert into tb_clientes(int_idcliente,nva_dui_cliente,nva_nom_cliente,nva_ape_cliente,txt_direc_cliente,nva_telefono_cliente,nva_estado_cliente) values ('null','".$cl->getDui_cl()."', '".$cl->getNombre_cl()."', '".$cl->getApellido_cl()."', '".$cl->getDireccion_cl()."', '".$cl->getTelfono_cl()."', '".$cl->getEstado_cl()."')");
            if(!$result){
                $this->Errno=mysqli_conecct_errno();
                $this->Errror=mysqli_conecct_error();
                return 0;
            }else {
                return 1;
            }   
            
    }
   
    function actualizarCliente(Cliente $cl){
        
        if(!($cl instanceof Cliente)){
            $this->Error="Error de instanciado,\n el objeto no es de tipo Clase Cliente";
            return 0;
        }
        $result= $this->Conexion_ID->query("UPDATE tb_clientes SET nva_dui_cliente ='".$cl->getDui_cl()."',nva_nom_cliente='".$cl->getNombre_cl()."',nva_ape_cliente='".$cl->getApellido_cl()."',txt_direc_cliente='".$cl->getDireccion_cl()."',nva_telefono_cliente='".$cl->getTelfono_cl()."',nva_estado_cliente='".$cl->getEstado_cl()."' WHERE int_idcliente='".$cl->getId_cl()."';");
        if(!$result){
            $this->Errno=mysqli_conecct_errno();
            $this->Errror=mysqli_conecct_error();
            return 0;
        }else {
            return 1;
        }   
        
    } 
    
    function bajaCliente(Cliente $cl){
        
        if(!($cl instanceof Cliente)){
            $this->Error="Error de instanciado,\n el objeto no es de tipo Clase Cliente";
            return 0;
        }
        $result= $this->Conexion_ID->query("UPDATE tb_clientes SET nva_estado_cliente='".$cl->getEstado_cl()."' WHERE int_idcliente='".$cl->getId_cl()."';");
        if(!$result){
            $this->Errno=mysqli_conecct_errno();
            $this->Errror=mysqli_conecct_error();
            return 0;
        }else {
            return 1;
        }   
         
        
    }
    

}
?>