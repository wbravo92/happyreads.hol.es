<?php
include("../database.php");
include("../config.php"); 
$instancia=new database(host,user,pass,db,port);
$instancia->borrarUsuario($_POST['borrarNombre']);
header('Location: usuarios.php');
?>
