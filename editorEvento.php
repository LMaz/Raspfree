<?php
session_start();

if (isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['loggedin'] == true &&  $_SESSION['admin'] == true) {
    
} else {
    $error = "Hay que estar registrado para poder ver la página a la que intentas acceder.";
    header("Location: index.php?noLog=$error");
}

include "ModelEvento.php";
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Editar Evento</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Página home">
        <meta name="author" content="Alejandro Torres Alonso">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Favicon -->
        <link rel="icon" href="img/favicon.png" type="image/png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilos.css" type="text/css">  

       
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <!-- *********************************************** MENÚ ********************************************************************* -->
        
        <?php include"navbar.php";?>


        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">

            <!-- *************************************** CAJA ****************************************** -->
            <div class="row well  well-sm">


            <?php
                $id = $_GET['id'];
            ?>




                <!-- *************************************** MIGAS DE PAN ****************************************** -->
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb  eventos-proximos-white">
                        <li><a href="index.php">Raspfree</a></li>
                        <li class="active">Editor Evento</li>
                    </ol>
                </div>

                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Editar evento</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>

                <!-- *************************************** INTRODUCCIÓN DE TEXTO ****************************************** -->


                <?php echo '<form class="mod animate" id="form" action="validarEditarEvento.php?id='.$id.'" enctype="multipart/form-data" method="post">'; ?>
                    <div class="form-group">
                        <label for="tittle">Título:</label> 
                        <input type="text" name="tittle" class="form-control" id="tittle" placeholder="Introduzca el título del evento" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Elegir imagen:</label>
                        <input type="file" name="image" class="form-control-file" id="image" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Seleccione imagen principal de evento.</small>
                    </div>

                    <div class="box box-info">
                        <div class="box-body pad">
                            <label for="editor">Introduzca el contenido:</label>
                            <textarea id="editor" name="editor" rows="10" cols="80" required>

                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="place">Dirección:</label>
                        <input type="text" name="place" class="form-control" id="place" placeholder="Introduzca la dirección" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Fecha:</label>
                        <input type="datetime-local" name="date" class="form-control" id="date" placeholder="Introduzca la fecha" required>
                    </div>
                    
                    <input type="submit" class="btn btn-default btnEnviar pull-right" name="enviar" id="enviar" value="Enviar" required>
                    

                </form>



            </div> <!--class box-->


        </div> <!--container-->            



        <!-- ************************************************** FOOTER ****************************************************** -->
       <?php include"footer.php";?>

       
        <!-- ************************************************** FIN FOOTER ****************************************************** -->  

         <!-- Script -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>

        <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

    </body>
</html>
