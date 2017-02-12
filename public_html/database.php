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

$consulta="select login.nombre as nombre,login_tipo.nombre as tipo
from login inner join login_tipo on login.tipo=login_tipo.idTIpo where correo= '$correo' limit 1 ";  

$resultado=$this->conexion->query($consulta);    
$row=$resultado->fetch_assoc();
$nombre=$row["nombre"];
$tipo=$row["tipo"];
$array=["nombre"=>"$nombre","tipo"=>"$tipo"];
return $array;
}
    
//********************************Panel de usuarios***********************************************
    
public function listarUsuarios($empezar_desde,$cantidadPorPagina,$tipo){    
if($tipo=="Maestro"){
return $this->conexion->query("SELECT idLogin,nombre FROM login limit $empezar_desde,$cantidadPorPagina");
}
if($tipo=="Administrador"){
return $this->conexion->query("SELECT idLogin,nombre FROM login where tipo !=1 limit $empezar_desde,$cantidadPorPagina"); 
}
}
    
public function totalUsuarios(){
$query="select count(*) as total from login";
$resultado=$this->conexion->query($query);
$row=$resultado->fetch_assoc();
return $row["total"];   
}
    
public function cargaDetalleUsuarios($id){
$resultado = $this->conexion->query("SELECT * FROM login where idLogin=$id limit 1");  
return $resultado;
}
      
public function insertarUsuario($nombre){
$query="INSERT INTO login(nombre) values('$nombre')";
$this->conexion->query($query); 
}
    
public function borrarUsuario($id){
$query="DELETE FROM login WHERE idLogin =$id";
$this->conexion->query($query); 
}    
    
public function actualizarUsuario($id,$nombre,$correo,$contrasena,$tipo,$activo){                      
$query="UPDATE login SET nombre='$nombre',correo='$correo',contrasena='$contrasena',tipo='$tipo',activo='$activo' WHERE idLogin=$id";
$this->conexion->query($query);
}
    
//***********************************************************************************************************
     
function cerrarConexion(){
$this->conexion->close();
}
}
?>