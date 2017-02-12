<?php

echo "Pruebas de paginación<br><br>";

$conexion=new mysqli("localhost","root","","happybooks","3306");

$cantidadPorPagina=5;


if(isset($_GET["paginaActual"])){
if($_GET["paginaActual"]==1){
    
    header("location:paginacion.php");
}else{
    
   $paginaActual=$_GET["paginaActual"];
}
}else{
    
   $paginaActual=1; 
}

$empezar_desde=($paginaActual-1)*$cantidadPorPagina;

$query="SELECT count(*) as total FROM login";
$query2="SELECT*FROM login limit $empezar_desde,$cantidadPorPagina";


$resultado=$conexion->query($query);
$resultado2=$conexion->query($query2);


$row=$resultado->fetch_assoc();
$row["total"];
    
$totalRegistros=$row["total"];

$numPaginados=ceil($totalRegistros/$cantidadPorPagina);



while($row2=$resultado2->fetch_assoc()){
    
echo $row2["nombre"]."<br><br>";
    
}



    
if($paginaActual!=1){
$anterior=$paginaActual-1;
    
    echo "<a href='?paginaActual=$anterior'>&laquo</a>";
}

for($i=1;$i<=$numPaginados;$i++){
    
    echo "<a href='paginacion.php?paginaActual=$i'>$i</a>"." ";
}

if($paginaActual!=$numPaginados){

    $siguiente=$paginaActual+1;
echo "<a href='?paginaActual=$siguiente'>&raquo</a>";  
}



echo "<br>";
echo "Numero total de registros".$totalRegistros."<br>";
echo "cantidad por pagina".$cantidadPorPagina."<br>";
echo "Numero de paginaciones".$numPaginados."<br>";
echo "Pagina Actual ".$paginaActual."<br>";




?>