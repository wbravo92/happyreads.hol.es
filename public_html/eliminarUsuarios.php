<?php




include("config.php");


$conexion=new mysqli(host,user,pass,db,port);


echo "valor".$_POST['borrarNombre'];



$resultado=$conexion->query("DELETE FROM login WHERE idLogin ={$_POST['borrarNombre']}");
    
$conexion->close();

header('Location: usuarios.php');

?>

