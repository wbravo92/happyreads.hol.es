<?php


class database{
    
    public $conexion;
    public $query;
    public $prep;

    
    public function __construct($host,$user,$pass,$bd,$port){
        
        $this->conexion=new mysqli($host,$user,$pass,$bd,$port);
        
        if(!$this->conexion){
        
    echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") ";
    die();
            
        }
    }
    
    public function existeUsuario($correo,$contrasena){
    
    $consulta="select * from login where correo= '$correo'  and contrasena= '$contrasena'  ";       
    $resultado=$this->conexion->query($consulta);
 
    if($resultado->num_rows === 0){
             
        $resultado->free();
         return false;      
    }else{
         $resultado->free();
        return true;
    }
}
    
    public function datos(){
        
        
       return $this->conexion->query("SELECT * FROM login");
        
    }
    
    
    function cerrarConexion(){
    $this->conexion->close();
    }
}


    







?>