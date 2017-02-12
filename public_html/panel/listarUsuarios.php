<?php
include_once("session.php");
include_once("database.php");
include("config.php");

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

</ul>