<?php

    session_start(); 
    /* Si no hay una sesión creada, redireccionar al index. */
    if(empty($_SESSION['correo'])) { 
       
        header('Location: login.php');  
    }

?>