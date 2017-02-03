<?php
include_once("inc/head.inc");
include_once("session.php");
include_once("database.php");
include_once("inc/navbarConfig.inc");
include("config.php");


?>


<script type="text/javascript">

function EnviarDatos(){
   /*     
var nombre=document.getElementById('inputnombre2').value;    
   
$("#nuevoUsuario").on('click',function(){
    
    
 $.ajax({
    
    type:'POST',
    url:'insertarUsuarios.php',
    data:('nombre='+nombre),
    success:function(respuesta){
    if(respuesta==1){
        
        $('#mensaje').html('El mensaje se ha enviado correctamente');
        
          var nombre=document.getElementById('inputnombre2').value="";    
           
    }else{
          $('#mensaje').html('El mensaje no se ha podido enviar, intentalo denuevo');
    }    
}        
})     
   
})    
    
  */    
}
    
</script>


<script>

function BorrarDatos(){
/*
    
        
$.ajax({
    
    type:'POST',
    //url:'eliminarUsuarios.php',
    success:function(respuesta){
    if(respuesta==1){
        
        $('#mensaje').html('El mensaje se ha enviado correctamente');
        
         // var nombre=document.getElementById('hola').value="";    
           
    }else{
          $('#mensaje').html('El mensaje no se ha podido enviar, intentalo denuevo');
    }    
}        
})    
*/
}  
</script>

<?php

$instancia=new database(host,user,pass,db,port);
$totalRegistros=$instancia->totalUsuarios();

$cantidadPorPagina=10;

if(isset($_GET["paginaActual"])){
if($_GET["paginaActual"]==1){ 
    header("location:usuarios.php");
}else{
   $paginaActual=$_GET["paginaActual"];
}
}else{
   $paginaActual=1; 
}


$empezar_desde=($paginaActual-1)*$cantidadPorPagina;


$resultado=$instancia->listarUsuarios($empezar_desde,$cantidadPorPagina);


$numPaginados=ceil($totalRegistros/$cantidadPorPagina);

?>

<div id='panelizquierdo'>
  
<ul id='listaUsuarios' class='list-group'>

<?php
while($row=$resultado->fetch_assoc()){
?>
    
<a href='usuarios.php?id=<?php echo $row['idLogin']?>' class='list-group-item'><?php echo $row['nombre']?></a>

<?php  
};

?>

<nav aria-label='Page navigation'>
  <ul class='pagination'>
   
     
     <?php
        
        if($paginaActual!=1){
        $anterior=$paginaActual-1;
            
    echo "        
     <li>
      <a href='usuarios.php?paginaActual=$anterior' aria-label='Previous'>
        <span aria-hidden='true'>&laquo;</span>
      </a>
    </li>        
            
    ";        
}
?>
     

    <?php for($i=1;$i<=$numPaginados;$i++){ ?>
    <li><a href='usuarios.php?paginaActual=<?php echo $i?>'><?php echo $i ?></a></li>
   <?php } ?>
  
<?php     
     if($paginaActual!=$numPaginados){

     $siguiente=$paginaActual+1;
         
    echo "
    
       <li>
      <a href='usuarios.php?paginaActual=$siguiente' aria-label='Next'>
        <span aria-hidden='true'>&raquo;</span>
      </a>
    </li>
    ";
          
     }
?>
     
    
  </ul>
</nav>

</ul></div>



<h3>Editar usuarios de panel</h3>


<p>
<?php 
    
if(isset($_GET["id"])){
        
        
    echo "Id: [{$_GET['id']}]</p>";
}else{
  
   echo "<p>Id: [0]</p>";
  }
   
  ?> 
   
   
   
   
    <div id="panelderecho">
    

     <form id="formularioUsuarios">
                
 <div class="btn btn-danger pull-right" data-toggle="modal" data-target="#usuarios"> <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></div><br>
                 
       <div class="form-group"> 
       <label for="inputnombre">Nombre Usuario: </label>
        <input name="nombre" type="text" id="inputnombre" class="form-control" placeholder="Ingresa tu nombre" required="required" autofocus>
      </div>
       
        <div class="form-group">
           <label for="inputemail">Email: </label>
        <input name="email" type="email" id="inputemail" class="form-control" placeholder="Ingresa tu email" required="required">
          </div>
          <hr>
          
           <div class="form-group">
           <label for="inputcontrasena">Contraseña: </label>
        <input name="contrasena" type="password" id="inputcontrasena" class="form-control" placeholder="Ingresa tu contraseña" required="required" autocomplete="off">
          </div>
          
           <div class="form-group">
           <label for="inputcontrasena2">Repita la contraseña: </label>
        <input name="contrasena2" type="password" id="inputcontrasena2" class="form-control" placeholder="Ingresa tu contraseña nuevamente" required="required" autocomplete="off">
          </div>
          
          <hr>
          
           <div class="form-group">
           <label>Tipo de usuario: </label>
        <select class="form-control">
            
            <option>Maestro</option>
            <option>Administrador</option>
            
        </select>
          </div>
          
           <div class="form-group">
           <label>Estado: </label>
         <select class="form-control">
            
            <option>Activo</option>
            <option>inactivo</option>
            
        </select>
            <br>
            <!--boton borrar-->
            
          <div data-toggle="modal" data-target="#borrarUsuarios" class="btn btn-default pull-right"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
            
          </div>

    <button type="submit" class="btn btn-sucess">Guardar</button>
     
      </form>

</div>

<!--modal agregar-->
   
    <div class="modal fade" id="usuarios" tabindex="-1" role="dialog" aria-labelledby="myMosalLabel1" arial-hidden="true">
    
    <div class="modal-dialog">
      
      <!--action="usuarios.php"-->
       <form method="post" action="insertarUsuarios.php">
       
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">Cerrar</button>
                
                <h4>Agregar Nuevo Usuario</h4>
            </div>

           
            <div class="modal-body">
                 <div class="form-group"> 
       <label for="inputnombre">Nombre Usuario: </label>
        <input name="agregarNombre" type="text" id="inputnombre2" class="form-control" placeholder="Ingresa tu nombre" required="required" autofocus>
      </div>
            
            </div>
            
           
            <div class="modal-footer">
                
                 <button id="nuevoUsuario" type="submit" class="btn btn-sucess">Guardar</button>
                               
            </div>
            
            
        </div>
         </form>
        
    </div>
</div>


    <div class="modal fade" id="borrarUsuarios" tabindex="-1" role="dialog" aria-labelledby="myMosalLabel1" arial-hidden="true">
    
    <div class="modal-dialog">
      
      <!--action="usuarios.php"-->
       <form method="post" action="eliminarUsuarios.php">
       
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">Cerrar</button>
                
                <h4>Panel de confirmación de eliminacion de registro</h4>
            </div>

           
            <div class="modal-body">
        <div class="form-group"> 
     
       
    <?php
            
    if(!isset($_GET["id"])){
        
     echo "<h4 style='text-align:center;padding: 30px 30px;'>Para continuar, selecione un elemento de la lista</h4>";
        
    }  else{ 
        
        
            
    ?>
    
<p style="text-align:center;padding: 30px 30px;">¿Esta seguro de querer eliminar el registro Nº: <?php echo $_GET["id"]?></p> 
       
       
        <input name="borrarNombre" type="hidden" id="inputnombre3" class="form-control" placeholder="Ingresa tu nombre" required="required" autofocus value="<?php echo $_GET['id']?>">
      </div>
            
            </div>        
           
    <div class="modal-footer">

         <button id="nuevoUsuario" type="submit" class="btn btn-sucess">Guardar</button>

    </div>
            
            
        </div>
         </form>
        
    </div>
</div>










<div id="mensaje">.</div>


<div id="cargando" style="display:none">Cargando...</div>



<?php } include_once("inc/footer.inc")?>