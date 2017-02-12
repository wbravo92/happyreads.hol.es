<?php
include_once("inc/head.inc");
include_once("session.php");
include_once("../database.php");
include_once("inc/navbarConfig.inc");
include("../config.php");?>

<script type="text/javascript">
$(document).ready(function(){ 
$("#btnformulario").click(function(e){                 
e.preventDefault();
   // var pet = $("#formularioUsuarios").attr('action');
   // var met = $("#formularioUsuarios").attr('method');
    
    $.ajax({
        
        beforeSend: function(){
            
      //  $("#status").spin({radius:3,width:2,height:2,length:4});
       $("#mensaje").html("Cargando....");
        console.log("Preparandose para enviar");
        },
         
        url: 'actualizarUsuarios.php',
        type : 'POST',
        data:$("#formularioUsuarios").serialize(),
        
        success:function(resp){
            
            if(resp="Correcto"){
                
                 $("#mensaje").html("Cargado correctamente");
            }else{
                
                  $("#mensaje").html("Error al actualizar");
            }       
         
        },
        
        error : function (jqXHR,estado,error){
            
            console.log(estado)
            console.log(error)
            
        },
        complete : function (jqXHR,estado){
            
            console.log(estado)         
        },
          timeout:10000  
                     
        })
})
    
 });
</script>

<?php

$instancia=new database(host,user,pass,db,port);
$totalRegistros=$instancia->totalUsuarios();

$cantidadPorPagina=10;

if(isset($_GET["paginaActual"])){
if($_GET["paginaActual"]==1){ 
   // header("location:usuarios.php");
      $paginaActual=1; 
}else{
   $paginaActual=$_GET["paginaActual"];
}
}else{
   $paginaActual=1; 
}
$tipo=$_SESSION['tipo'];
$empezar_desde=($paginaActual-1)*$cantidadPorPagina;
$resultado=$instancia->listarUsuarios($empezar_desde,$cantidadPorPagina,$tipo);
$numPaginados=ceil($totalRegistros/$cantidadPorPagina);
?>
 <h3 id="titulopanel">Editar usuarios de panel</h3>
<div id='panelizquierdo'>

<ul id='listaUsuarios' class='list-group'>

<?php
while($row=$resultado->fetch_assoc()){
?>
    
<a href='usuarios.php?paginaActual=<?php echo $paginaActual?>&id=<?php echo $row['idLogin']?>' class='list-group-item'><?php echo $row['nombre']?></a>

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
    <li><a class="active" href='usuarios.php?paginaActual=<?php echo $i?>'><?php echo $i ?></a></li>
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
</ul>
 </div>
    <div id="panelderecho"> 
    <?php 
    
if(isset($_GET["id"])){
        
 echo "Id: [{$_GET['id']}]</p>";
}else{
  
   echo "<p>Id: [0]</p>";
  }
   
    
    if(isset($_GET["id"])){
$resultado22=$instancia->cargaDetalleUsuarios($_GET["id"]);
                
       
 while($row=$resultado22->fetch_assoc()){
             
  ?> 
    
<!--Actualizar-->
    
     <form id="formularioUsuarios" method="POST" action="actualizarUsuarios.php">
                
 <div class="btn btn-danger pull-right" data-toggle="modal" data-target="#usuarios"> <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></div><br>
                 
       <div class="form-group"> 
       <label for="inputnombre">Nombre Usuario: </label>
        <input name="nombre" type="text" id="inputnombre" class="form-control" placeholder="Ingresa tu nombre" value="<?php echo $row["nombre"]?>" autofocus>
      </div>
       
        <div class="form-group">
           <label for="inputemail">Email: </label>
        <input name="email" type="email" id="inputemail" class="form-control" value="<?php echo $row["correo"];?>" placeholder="Ingresa tu email" required="required">
          </div>     
           <div class="form-group">
           <label for="inputcontrasena">Contraseña: </label>
        <input name="contrasena" type="password" id="inputcontrasena" class="form-control" value="<?php  echo $row["contrasena"];?>"placeholder="Ingresa tu contraseña" required="required" autocomplete="off">
          </div>    
           <div class="form-group">
           <label for="inputcontrasena2">Repita la contraseña: </label>
        <input name="contrasena2" type="password" id="inputcontrasena2" class="form-control" value="<?php echo $row["contrasena"];?>" placeholder="Ingresa tu contraseña nuevamente" required="required" autocomplete="off">
          </div>
           <div class="form-group">
           <label>Tipo de usuario: </label>
        <select class="form-control" name="tipo"> 
           <?php
            
            if($tipo=="Maestro"){
                if($row['tipo']==1){
                 
            echo "            
            <option selected value='1'>Maestro</option>
            <option value='2'>Administrador</option>
            <option value='3''>Usuario</option>
            <option value='4'>Invitado</option>"; 
            }
            if($row['tipo']==2){
            echo "            
            <option value='1'>Maestro</option>
            <option selected value='2'>Administrador</option>
            <option value='3''>Usuario</option>
            <option value='4'>Invitado</option>"; 
            }
            if($row['tipo']==3){
            echo "            
            <option value='1'>Maestro</option>
            <option value='2'>Administrador</option>
            <option selected value='3''>Usuario</option>
            <option value='4'>Invitado</option>"; 
            }    
            if($row['tipo']==4){
            echo "            
            <option value='1'>Maestro</option>
            <option  value='2'>Administrador</option>
            <option value='3''>Usuario</option>
            <option selected value='4'>Invitado</option>"; }
    
            }  
     
            if($tipo=="Administrador"){ 
                
             if($row['tipo']==2){    
            echo "            
            <option selected value='2'>Administrador</option>
            <option value='3''>Usuario</option>
            <option value='4'>Invitado</option>"; 
            }  
             if($row['tipo']==3){
            echo "            
            <option value='2'>Administrador</option>
            <option selected value='3''>Usuario</option>
            <option value='4'>Invitado</option>"; 
            }  
            if($row['tipo']==4){
            echo "            
            <option value='2'>Administrador</option>
            <option value='3''>Usuario</option>
            <option selected value='4'>Invitado</option>"; 
            }
            }
            ?>
        </select>
          </div>
          
           <div class="form-group">
           <label>Estado: </label>
           
           
         <select class="form-control" name="activo">
            
            
            <?php
             
             
            if($row["activo"]==1){
                
            echo "       
            <option selected value='1'>Activo</option>
            <option value='0'>inactivo</option>
            ";
                
            }else{
            echo"    
            <option value='1'>Activo</option>
            <option value='0' selected>inactivo</option>   
            ";
            }    
             ?>
  
        </select>
            <br>
            <!--boton borrar-->
            
          <div data-toggle="modal" data-target="#borrarUsuarios" class="btn btn-default pull-right"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
            
          </div>

     <?php    } 
         
    }
         ?>
         <input type="text" hidden="hidden" name="id" value='<?php echo $_GET["id"]?>'>
         
          <button id="btnformulario" type="button" class="btn btn-sucess">Guardar</button>
      </form>

</div>

<!--modal agregar-->
   
    <div class="modal fade" id="usuarios" tabindex="-1" role="dialog" aria-labelledby="myMosalLabel1" arial-hidden="true">
    
    <div class="modal-dialog">
      
      <!--action="usuarios.php"-->
       <form id="formulario" method="post" action="insertarUsuarios.php">
       
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


<div id="mensaje"></div>


<div id="cargando" style="display:none">Cargando...</div>


<?php 
    
    } include_once("inc/footer.inc")?>