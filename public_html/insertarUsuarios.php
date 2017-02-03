<?php

include("config.php");


$conexion=new mysqli(host,user,pass,db,port);


echo "valor".$_POST['agregarNombre'];
$resultado=$conexion->query("insert into login(nombre) values('{$_POST['agregarNombre']}')");
    $conexion->close();


header('Location: usuarios.php');

?>


