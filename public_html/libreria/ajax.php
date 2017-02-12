<?php
$name = utf8_decode($_POST['name']);
$password = md5($_POST['password']);

//Para la conexión deberás introducir el usuario y password de tu base de datos
$con = mysql_connect('localhost', 'root', '');
mysql_select_db("portal", $con);

$insert = "INSERT INTO app_user (nombre, apellido, estado) VALUES ('$name', '$password', now())";
mysql_query($insert);
?>