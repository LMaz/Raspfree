<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
} 

include "ModelTutorial.php";
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Añadir Comentario Tutorial</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Página home">
        <meta name="author" content="Lucas Mazariegos Arraiza">
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











                <!-- *************************************** MIGAS DE PAN ****************************************** -->
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Raspfree</a></li>
                        <li class="active">Añadir comentario</li>
                    </ol>
                </div>
                
                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Añadir Comentario</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>


                <?php
                    $id = $_GET['id'];
                ?>
                


                <!-- *************************************** INTRODUCCIÓN DE TEXTO ****************************************** -->
                <?php echo '<form autocomplete="off" action="validarComentarioTut.php?id='.$id.'" method="post">' ?>
                    <div class="box box-info">
                        <div class="box-body pad">
                            <label for="editor">Introduzca el contenido:</label>
                            <textarea id="editor" name="editor" rows="10" cols="80" required>

                            </textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-default btnEnviar pull-right">Enviar</button>
                </form>



            </div> <!--class box-->


        </div> <!--container-->            



        <!-- ************************************************** FOOTER ****************************************************** -->  
       <div data-include-html="footerUser.html"></div>

       
        <!-- ************************************************** FIN FOOTER ****************************************************** -->  

         <!-- Script -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>

        <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        
        <script>
            IncludeHTML();
        </script>
        
    </body>
</html>
