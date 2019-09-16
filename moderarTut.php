<?php
session_start();

if (isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['loggedin'] == true &&  $_SESSION['admin'] == true) {
    
} else {
    $error = "Hay que estar registrado para poder ver la página a la que intentas acceder.";
    header("Location: index.php?noLog=$error");
}

include "ModelNovedad.php";

?>


<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>Moderar tutorial</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Moderar tutorial">
        <meta name="author" content="Sara Vegas Cañas y Alejandro Torralbo">
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
                        <li><a href="moderar.php&active=admin">Moderar</a></li>
                        <li class="active">Moderar tutorial</li>
                    </ol>
                </div>
                <!-- *************************************** FIN MIGAS DE PAN ****************************************** -->
                
                 <?php 

                    if(isset($_GET['tut'])) { 
                        $id = $_GET['tut'];

                        $consult = getTutorial ($id);

                        while ($tut = mysqli_fetch_object($consult)) {

                               $img = $tut->image;
                               $body = $tut->body;

                           echo "<div class='col-lg-12 col-xs-12'>
                                    <h1> $tut->tittle </h1>
                                </div>";

                           echo "<small class='col-md-12'>  $tut->author / $tut->fecha </small>";

                            echo '<img class="img-responsive imgNov" src="data:image/jpeg;base64,'.base64_encode($img).'"/>';

                          echo " <p class='col-md-12'>
                               $tut->body 
                           </p>";
                           
                        }
                    }  else {
                        echo "<div class='col-lg-12 col-xs-12'>
                               <h1>No se ha indicado ninguna novedad.</h1>
                           </div>";
                    }
                    
                    $_SESSION['tut'] = $id; 
                    
                    ?>
                </div>
                

                <div class="moderar row col-md-12 col-sm-12">
                  
                    <input id="acceptTut" type="button" class="btn btn-success" value="Aceptar" </input>
                    <input id="eraseTut" type="button" class="btn btn-danger" value="Rechazar" </input>
                    

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
