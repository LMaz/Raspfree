<?php
session_start();

include "ModelGaleria.php";

?>

<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Album</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Página home">
        <meta name="author" content="Lucas Mazariegos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Favicon -->
        <link rel="icon" href="img/favicon.png" type="image/png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilos.css" type="text/css">  

    </head>

    <body id="content">
        
       <?php include"navbar.php";?>


        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">


            <div class="row well  well-sm">
                
                 <!-- *************************************** MIGAS DE PAN ****************************************** -->

                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Raspfree</a></li>
                        <li><a href="galeria.php">Galería</a></li>
                        <li class="active">Álbum</li>
                    </ol>
                </div>

                <div class=" novedad">     
                    
                <?php 

                    if(isset($_GET['id'])) { 
                        $id = $_GET['id'];
                        
                        

                        $consult2 = getEvento($id);
                        $evento = mysqli_fetch_object($consult2);
                        $tittle = $evento->tittle;

                        $consult = getImagenes($id);

                        if (mysqli_num_rows($consult)==0) echo '<h1> No hay ninguna imagen para este evento </h1>' ;

                      ?>
                        <div class="col-md-12 col-sm-12">
                          <h1 class = "titNov"> <?php echo $tittle ?> </h1>
                        </div>
                      <?php

                        while ($gal = mysqli_fetch_object($consult)) {

       

                        

                        

                               $img = $gal->image;
                               $idimg= $gal->id;

                               ?>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="zoom">

                          <?php  echo '<img class="img-thumbnail img-responsive gal" alt="foto" src="data:image/jpeg;base64,'.base64_encode($img).'"/>'; ?>
                          </div>

                          <div class="title"><?php echo $gal->tittle ?></div>

                          

                           <?php if (isset($_SESSION['username'])) {
                                   if ($_SESSION['admin'] == true) {
                                       echo    "<div class='row'>
                                            
                                                   <a href='editarImagen.php?id=$idimg' role='button' class='btn btn-default btnGal'> <span class='fa fa-edit'></span> Editar Foto </a>
                                               </div>";
                                   }
                               }

                               ?>

        
                        </div>

                       <?php  
                         
                        }

                    }  else {
                        echo "<div class='col-lg-12 col-xs-12'>
                               <h1>No se ha indicado ningun album.</h1>
                           </div>";
                    }

                    ?>
                </div>
          
              </div> 

        </div> 

         <!-- ******************************************************* PAGINADOR ***********************************************************************-->
 

        <!-- ************************************************** FOOTER ****************************************************** -->  
       <?php include"footer.php";?>

        <!-- ************************************************** FIN FOOTER ****************************************************** -->  
        
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- Script -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>
        
      
        
    </body>
</html>
