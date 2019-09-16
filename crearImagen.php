<?php
session_start();
        
if (isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['loggedin'] == true &&  $_SESSION['admin'] == true) {
    
} else {
    $error = "Hay que estar registrado para poder ver la página a la que intentas acceder.";
    header("Location: index.php?noLog=$error");
}

include "ModelGaleria.php";

?>



<!DOCTYPE html>

<html>
    <head>
        <title>Crear galeria</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Crear novedad">
        <meta name="author" content="Lucas Mazariegos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Favicon -->
        <link rel="icon" href="img/favicon.png" type="image/png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilos.css" type="text/css">  

    <body>
       
        <?php include "navbar.php"; ?>
        
        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">
            <div class="row well  well-sm">

                <!-- *************************************** MIGAS DE PAN ****************************************** -->
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="indexAdmin.html">Raspfree</a></li>
                        <li class="active">Crear Galería</li>
                    </ol>
                </div>
                <!-- *************************************** FIN MIGAS DE PAN ****************************************** -->

                <!-- *************************************** TITULO ****************************************** -->
                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Crear Galería</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>
                <!-- *************************************** FIN TITULO ****************************************** -->
                
                <?php
                
                    if(isset($_GET['galOk'])) { ?>
                        <div class="panel panel-success">
                            <div class="panel-heading centrado"><?php echo $_GET['galOk'] ?></div>
                        </div>

                    <?php } 
                    if(isset($_GET['galFail'])) { ?>
                         <div class="panel panel-danger">
                            <div class="panel-heading centrado"><?php echo $_GET['galFail'] ?></div>
                        </div>

                    <?php } 
            
                    $eventId = $_GET['id'];



                    ?>
                    
                <!-- *************************************** FORMULARIO ****************************************** -->
                <?php echo '<form autocomplete="off" action="validarGaleria.php?eventId='.$eventId.'" enctype="multipart/form-data" method="post">' ?>


                    <div class="form-group">
                        <label for="titulo"> Título: </label><br>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required="" maxlength="100">
                    </div>

                    <!-- Imagen del evento -->
                    <div class="form-group">
                         <label for="imagen"> Imagen principal: </label><br>
                        <input type="file" class="form-control-file" id="imagen" name="imagen" required="" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Seleccione la imagen del evento</small>
                    </div>
                    

                    

                    
                    <button class="btn btn-default btnEnviar pull-right" type="submit">Enviar</button>
                
                <!-- *************************************** FIN FORMULARIO ****************************************** -->


            </div>
        </div>
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
        <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>


    </body>
</html>

