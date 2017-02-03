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
        
        $this->conexion->set_charset('utf8');
    }
    
    public function existeUsuario($correo,$contrasena){
    
    $consulta="select nombre from login where correo= '$correo'  and contrasena= '$contrasena' and activo=1 limit 1";       
    $resultado=$this->conexion->query($consulta);

 
    if($resultado->num_rows === 0){
             
        $resultado->free();
         return false;      
    }else{
         $resultado->free();
        return true;
    }
}
    
    function obtenerNombre($correo){
     $consulta=" SELECT login.nombre as nombre, login_tipo.nombre as tipo FROM login INNER JOIN login_tipo ON login_tipo.idLogin = login.idLogin where correo= '$correo' limit 1 ";  
    
        
        $resultado=$this->conexion->query($consulta);    
        $row=$resultado->fetch_assoc();
        $nombre=$row["nombre"];
        $tipo=$row["tipo"];
        $array=["nombre"=>"$nombre","tipo"=>"$tipo"];
        return $array;
        
    }
    
//********************************Panel de usuarios***********************************************
    
    public function listarUsuarios($empezar_desde,$cantidadPorPagina){    
       return $this->conexion->query("SELECT idLogin,nombre FROM login limit $empezar_desde,$cantidadPorPagina");     
    }
    
    public function totalUsuarios(){
    $query="select count(*) as total from login";
    $resultado=$this->conexion->query($query);
    $row=$resultado->fetch_assoc();
    return $row["total"];   
    }
    
    
    public function cargaDetalleUsuarios($id){
    
       return $this->conexion->query("SELECT * FROM login where idLogin=.$id. limit 1");        
    }
    
   
    public function insertarUsuario($nombre){
        
    $query="insert into login(nombre) values('$nombre')";
        
        $this->conexion->query($query);
        
    }
    

    
    
    function cerrarConexion(){
    $this->conexion->close();
    }
}


    







?>