<?php require_once("inc/head.inc");?>
    
<body id="body-config">

   <div class="container">
     
       <h2 class="form-signin-heading text-center">Panel de configuración</h2>

     <form class="form-signin col-md-6 col-centrar" method="post" action="login.php">
            
          <legend>Iniciar sesión</legend>
    
       <div class="form-group"> 
        <input name="correo" type="email" id="inputEmail" class="form-control" placeholder="Ingresa tu Correo" required="required" autofocus>
      </div>
       
        <div class="form-group">
        <input name="contrasena" type="password" id="inputPassword" class="form-control" placeholder="Ingresa tu contraseña" required="required">
          </div>
        
        <div class="checkbox">
          <label>
            <input type="checkbox" value="Recordar"> Recordar
          </label>
        </div>
        <button class="btn btn-lg btn-default btn-block" type="submit">Ingresar</button>
     
     <a id="link-control" class="pull-right" href="index.html">Regresar</a>
     
      </form>
      
<?php 
        
include("config.php");
include("database.php");


$c=new database(host,user,pass,db,port);

/*
$resultado=$c->datos();


while($row=$resultado->fetch_array(MYSQLI_NUM)){

  echo $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]."<br>";

};

*/
  
if($_POST){
    
$correo=$_POST["correo"];
$contrasena=$_POST["contrasena"];
    

$boolean=$c->existeUsuario($correo,$contrasena);

if($boolean!=false){
    
  $array=$c->obtenerNombre($correo);  

echo "El correo existe";
    
 require("session.php");
    
    
    $_SESSION['correo']=$correo;
    $_SESSION['nombre']=$array["nombre"];
    $_SESSION['tipo']=$array["tipo"];
    
    header("Location: panel_config.php");

}else{

echo "
    
<div class='alert alert-danger form-signin col-md-6 col-centrar' style='margin-top:50px' role='alert'>
<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
El correo No existe
</div>
";   

}
  $c->cerrarConexion();  
}

?>    
      
    </div> 

 
 
 
 
 
 
 
 

 
 
 
 
 
  
  <?php require_once("inc/footer.inc");
