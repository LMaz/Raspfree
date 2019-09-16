<?php
session_start();

include "ModelTutorial.php";

?>

<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Tutorial</title>

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

    <body>
        
       <?php include"navbar.php";?>


        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">


            <div class="row well  well-sm">
                
                 <!-- *************************************** MIGAS DE PAN ****************************************** -->

                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Raspfree</a></li>
                        <li class="active">tutorial</li>
                    </ol>
                </div>

                <div class=" novedad">     
                    
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

                               if (isset($_SESSION['username'])) {
                                   if ($_SESSION['admin'] == true) {
                                       echo    "<div class='row'>
                                            
                                                   <a href='editarTutorial.php?id=$id' role='button' class='btn btn-default btnEditar'> Editar Tutorial </a>
                                               </div>";
                                   }
                               }
                           
                           echo "<small class='col-md-12'> $tut->author / $tut->fecha </small>";

                            echo '<img class="img-responsive imgTutorial" src="data:image/jpeg;base64,'.base64_encode($img).'"/>';

                          echo " <div class='textos'<p class='col-md-12'> $tut->body </p></div>";
                           
                        }
                    }  else {
                        echo "<div class='col-lg-12 col-xs-12'>
                               <h1>No se ha indicado ningun Tutorial.</h1>
                           </div>";
                    }

                    ?>
                </div>
          

            <!-- ******************************************************* COMENTARIOS **************************************************** -->

            <!--Botón izquierdo-->



                <?php
                    $_SESSION['tutorial'] = $id;
                
                    if(yaParticipa($_SESSION['username'], $id)) {

                    ?>
                                          <p class="eventos-proximos-left eventos-proximos-button eventos-proximos-white eventos-proximos-border"><span class="fa fa-thumbs-up"></span> <?php echo numeroLikes($id); ?> </span></p>

                    <?php
                        }else {
                          
                    ?>
                                            <p class="eventos-proximos-left"><span id="botonUnirse" class="eventos-proximos-button eventos-proximos-white eventos-proximos-border"><span class="fa fa-thumbs-up"></span> like </span></p>

                    <?php } ?>


                        <!--Botón derecho-->
                        <p class="eventos-proximos-right "><span class="eventos-proximos-button eventos-proximos-black" id="myBtn">Comentarios  <span class="eventos-proximos-tag eventos-proximos-white"> <?php echo numeroComentarios($id); ?> </span></span></p>

                        <p class="clear"></p>


                         <div class="evento-display" id="comentarios">
                        <!--Comentarios-->
                            <div class="eventos-proximos-row">
                                <hr>
                            <?php
                            $consult = getComentarios($id);
                            while ($comentario = mysqli_fetch_object($consult)) {

                                $emisor= $comentario->userId;

                                $consult2 =datosUser($emisor);
                                while ($usuario = mysqli_fetch_object($consult2)) {

                                    $image =$usuario->image;


                              
                             
                                ?>
                              <div class="col-xs-3 col-sm-2">
                                    <?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
                                </div>
                                <div class="col-xs-9 col-sm-10">
                                    <h4 class="hidden-xs"> <?php echo $comentario->userId ?> <span class="eventos-proximos-opacity eventos-proximos-medium hidden-xs"> <?php echo  $comentario->date ?> </span></h4>
                                    <p> <?php echo $comentario->coment ?> </p>
                                </div>
                                <p class="clear"></p>
                                <?php
                                }
                            }

                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            ?>
                                <hr>
                                <?php echo '<a href="añadirComentarioTutorial.php?id='.$id.'" class="btn btn-default pull-right btnComentarios">Comentar</a>';
                                
                                }?>
                            </div>
                        </div>

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
        
    </body>
</html>
