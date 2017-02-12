<?php
include("../database.php");
include("../config.php");    
    
$instancia=new database(host,user,pass,db,port);

$id=$_POST["id"];
$nombre=$_POST["nombre"];
$correo=$_POST["email"];
$contrasena=$_POST["contrasena"];
$tipo=$_POST["tipo"];
$activo=$_POST["activo"];

$instancia->actualizarUsuario($id,$nombre,$correo,$contrasena,$tipo,$activo);
?>
