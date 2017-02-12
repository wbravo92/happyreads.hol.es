<?php
include("../database.php");
include("../config.php");   

$instancia=new database(host,user,pass,db,port);


$instancia->insertarUsuario($_POST['agregarNombre']);

header('Location: usuarios.php');

?>