<?php

class Cliente{
    private $id_cl;
    private $dui_cl;
    private $nombre_cl;
    private $apellido_cl;
    private $direccion_cl;
    private $telfono_cl;
    private $estado_cl;

    

    function __construct($id_cl, $dui_cl, $nombre_cl, $apellido_cl, $direccion_cl, $telfono_cl, $estado_cl){     
        $this->id_cl=$id_cl;  
        $this->dui_cl=$dui_cl;
        $this->nombre_cl=$nombre_cl;
        $this->apellido_cl=$apellido_cl;
        $this->direccion_cl=$direccion_cl;
        $this->telfono_cl=$telfono_cl;
        $this->estado_cl=$estado_cl;
    }
    function __construct2($estado_cl){             
        $this->estado_cl=$estado_cl;
    }
   

    
       
    public function getDui_cl()
    {
        return $this->dui_cl;
    }

    public function setDui_cl($dui_cl)
    {
        $this->dui_cl = $dui_cl;

        return $this;
    }

   
    public function getNombre_cl()
    {
        return $this->nombre_cl;
    }

  
    public function setNombre_cl($nombre_cl)
    {
        $this->nombre_cl = $nombre_cl;

        return $this;
    }

    
    public function getApellido_cl()
    {
        return $this->apellido_cl;
    }

    
    public function setApellido_cl($apellido_cl)
    {
        $this->apellido_cl = $apellido_cl;

        return $this;
    }

    
    public function getDireccion_cl()
    {
        return $this->direccion_cl;
    }

   
    public function setDireccion_cl($direccion_cl)
    {
        $this->direccion_cl = $direccion_cl;

        return $this;
    }

    
    public function getTelfono_cl()
    {
        return $this->telfono_cl;
    }

    public function setTelfono_cl($telfono_cl)
    {
        $this->telfono_cl = $telfono_cl;

        return $this;
    }

 
    public function getId_cl()
    {
        return $this->id_cl;
    }
  
    public function setId_cl($id_cl)
    {
        $this->id_cl = $id_cl;

        return $this;
    }

    public function getEstado_cl()
    {
        return $this->estado_cl;
    }

   
    public function setEstado_cl($estado_cl)
    {
        $this->estado_cl = $estado_cl;

        return $this;
    }
}



?>