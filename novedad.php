<?php
session_start();

include "ModelNovedad.php";

?>

<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Novedad Admin</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Ver novedad">
        <meta name="author" content="Sara Vegas y Alejandro Torralbo">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Favicon -->
        <link rel="icon" href="img/favicon.png" type="image/png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilos.css" type="text/css">  

    </head>

    <body>
        
       <?php include"navbar.php";?>


        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">


            <div class="row well  well-sm">
                
                 <!-- *************************************** MIGAS DE PAN ****************************************** -->
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php?active=novedad">Raspfree</a></li>
                        <li class="active">Novedad</li>
                    </ol>
                </div>
                 <!-- *************************************** FIN MIGAS DE PAN ****************************************** -->
                
                 <!-- *************************************** NOVEDAD ****************************************** -->
                <div class=" novedad">     
                    
                <?php 

                    if(isset($_GET['nov'])) { 
                        $id = $_GET['nov'];

                        $consult = getNovedad ($id);

                        while ($nov = mysqli_fetch_object($consult)) {

                               $img = $nov->image;
                               $body = $nov->body;

                           echo "<div class='col-lg-12 col-xs-12'>
                                    <h1> $nov->tittle </h1>
                                </div>";

                               if (isset($_SESSION['username'])) {
                                   if ($_SESSION['admin'] == true) {
                                       echo    "<div class='row'>
                                            
                                                   <a href='editarNovedad.php?id=$id&active=admin' role='button' class='btn btn-default btnEditar'> Editar Novedad </a>
                                               </div>";
                                   }
                               }
                           
                           echo "<small class='col-md-12'> $nov->author / $nov->date </small>";

                            echo '<img class="img-responsive imgNov" src="data:image/jpeg;base64,'.base64_encode($img).'"/>';

                          echo " <p class='col-md-12'>
                               $nov->body 
                           </p>";
                           
                        }
                    }  else {
                        echo "<div class='col-lg-12 col-xs-12'>
                               <h1>No se ha indicado ninguna novedad.</h1>
                           </div>";
                    }

                    ?>
                </div>
                 <!-- *************************************** FIN NOVEDAD ****************************************** -->
                 
            </div> 
            </div> 

        <!-- ************************************************** FOOTER ****************************************************** -->  
       <?php include "footer.php"; ?>

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
