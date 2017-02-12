 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.html">HappyReads</a>
        </div>
        <div id="navbar" class=" navbar-collapse">
       
            <ul class="nav navbar-nav navbar-default">
            <li><a href="#" data-toggle="modal" data-target="#miventana">Menu</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            
            <li><a href="#"><?php echo ($_SESSION['nombre']); ?></a></li>
            <li><a href="#">
               
               <?php 
                
    
                echo $_SESSION['tipo'];
            
                ?>
                </a></li>
            <li><a href="cerrarsesion.php">Cerrar Sesion</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    
    <div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myMosalLabel1" arial-hidden="true">
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                
                <button type="button" class="close" data-dismiss="modal">Cerrar</button>
                
                <h4>Menu de Configuracion</h4>
            </div>
            
            <div class="modal-body">
            
            <?php
            
            if($_SESSION['tipo']=='Maestro' || $_SESSION['tipo']=='Administrador'){
            
            echo " <a style='display:block' href='usuarios.php'>Panel de usuarios</a>";
             echo " <a style='display:block' href='#'>Agregar Autores</a>";
             echo " <a style='display:block' href='#'>Agregar Libros</a>";
            }else{
        
              echo "
              <div>
              <a style='display:block;color:gray' href='#'>Panel de usuarios</a>
              <a style='display:block' href='#'>Agregar Autores</a>
              <a style='display:block' href='#'>Agregar Libros</a>
            </div>" ;
            
            }
            
            ?>
               
            
            </div>
            
            <div class="modal-footer">
                
                <h6>Soy el footer del modal</h6>
            </div>
            
            
        </div>
        
        
    </div>
    
</div>