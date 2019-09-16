<?php
session_start();

include "ModelNovedad.php";

?>

<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Página home">
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

        <div id="content">
        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">

            <!--**********************************************CAROUSEL*****************************************************-->
            <div   class="row hidden-print">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <li data-slide-to="0" class="active"></li>
                        <li data-slide-to="1"></li>
                        <li data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner" role="listbox">

                        <div class="item active">
                            <img class="img-responsive" src="img/logo_1.png" alt="">
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="img/logo2.jpg" alt="">
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="img/carr2.jpg" alt="">
                        </div>

                    </div>

                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>

            </div>
            <!--********************************************** FIN CAROUSEL *****************************************************-->
            
            
            <div class="row well  well-sm">

                <!-- *************************************** TITULO ****************************************** -->
                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="">
                    <h1 class="col-md-4 col-sm-4">Novedades</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>
                <!-- *************************************** FIN TITULO ****************************************** -->
                
                <!-- *********************************************** NOVEDADES ****************************************************** -->          
                <div class="MargenSuperior20" id="content">
                    <div class="col-md-8">
                    <!-- ************************* APARTADO DE MENSAJES DE ERROR EN LOGIN ********************************* -->   
                    <?php
                        if(isset($_GET['noLog'])) { ?>
                            <div class="panel panel-danger">
                                <div class="panel-heading centrado"><?php echo $_GET['noLog'] ?></div>
                            </div>
                    <?php 
                        }
                        if(isset($_GET['register'])) { ?>
                            <div class="panel panel-danger">
                                <div class="panel-heading centrado"><?php echo $_GET['register'] ?></div>
                            </div>
                     <?php 
                        }
                         if(isset($_GET['registerOK'])) { ?>
                            <div class="panel panel-success">
                                <div class="panel-heading centrado"><?php echo $_GET['registerOK'] ?></div>
                            </div>
                     <?php 
                        }
                        if(isset($_GET['login'])) { ?>
                            <div class="panel panel-danger">
                                <div class="panel-heading centrado"><?php echo $_GET['login'] ?></div>
                            </div>
                     <?php 
                        }
                    // <!-- ************************* FIN APARTADO DE MENSAJES DE ERROR EN LOGIN ********************************* -->   
	
            
// ************************************* Mostrar novedades con paginador**********************************************
                $consult = getNovedades ();
                $num_total_registros = mysqli_num_rows($consult);

                $total_paginas = 0;
                //Si hay registros
                if ($num_total_registros > 0) {
                    
                    $rowsPerPage = 5;//Número de novedades por página.

                    // Por defecto mostramos la página 1
                    $pageNum = 1;

                    // Si $_GET['page'] esta definido, usamos este número de página
                    if(isset($_GET['page'])) {  
                        $pageNum = $_GET['page'];
                    }

                    // Contando el desplazamiento
                    $offset = ($pageNum - 1) * $rowsPerPage;
                    $total_paginas = ceil($num_total_registros / $rowsPerPage);

                    $consult2 = getNovedadesPag($offset, $rowsPerPage);
                    
                    while ($nov = mysqli_fetch_object($consult2)) {   
                           
                        $id = $nov->id;
                        $img = $nov->image;
                        $body = $nov->body;
                        $resum = substr($body, 0, 200) . "...";

                        ?>

                        <div class="row">
                            <div class="col-lg-4">
                                <?php  echo '<img class="img-responsive imgNovedad" src="data:image/jpeg;base64,'.base64_encode($img).'"/>'; ?>
                            </div>   
                            <div class="col-lg-8">
                                <h3 class="hidden-xs hidden-sm"> <?php echo $nov->tittle ?> </h3>
                                <h3 class="hidden-md hidden-lg MargenSuperior20"><?php echo $nov->tittle ?></h3>
                                <small class="novAutor">
                                   <?php echo $nov->author ?>  / <?php echo $nov->date; ?>
                                </small>
                                <p>
                                    <?php echo $resum ?>
                                </p>
                                <a class=" leerMas pull-right" <?php echo "href='novedad.php?nov=$id&active=novedad'"; ?> >Leer más...</a>                            
                            </div>                        
                        </div>

                        <hr class="hrNov">

                        <?php
                        
                    }
                  
                } else {
                   echo "<h3> No hay novedades. </h3>";
                }
     // ************************************* Fin mostrar novedades **********************************************

            ?>
                </div>
            <!-- *********************************************** FIN NOVEDADES ****************************************************** -->          

                <div class="col-md-4">
                    <!-- *********************************************** ÚLTIMOS TUTORIALES ****************************************************** --> 
                    <div class="ultTutoriales">

                        <h2 class="tituloResumen">Últimos tutoriales</h2>
                        <hr class="separaTitulo">

                         <?php 

                            $consult = getUltTutoriales(4);
                            while ($tut = mysqli_fetch_object($consult)) {  

                                $img = $tut->image;
                                $tu = $tut->id;
                                
                         ?>

                        <div class="resumenTuto">
                            <small><?php echo $tut->author ?></small>
                            <h3><a  <?php echo "href='tutorial.php?tut=$tu&active=tutorial'"; ?>><?php echo $tut->tittle ?></a></h3>
                        </div>

                        <hr>

                        <?php
                            }
                        ?>
                    </div>
                    <!-- *********************************************** FIN ÚLTIMOS TUTORIALES ****************************************************** --> 


                    <!-- *********************************************** PÓXIMOS EVENTOS ****************************************************** --> 
                    <div class="proxEventos">
                        
                        <h2 class="tituloResumen  ">Próximos Eventos</h2>
                         <hr class="separaTitulo">
                         
                        <?php 

                            $consult = getUltEventos(3);
                            while ($event = mysqli_fetch_object($consult)) {  

                                $img = $event->image;
                                $ev = $event->id;
                         ?>

                            <div class="row MargenSuperior20 Margen10">

                                <div class="col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-xs-offset-1 col-xs-3">
                                    <?php  echo '<img class="img-responsive imgRedonda" src="data:image/jpeg;base64,'.base64_encode($img).'"/>'; ?>
                                </div>   

                                <div class="col-lg-8 col-md-8 col-xs-8 eventInfo">
                                    
                                    <h3><a <?php echo "href='evento.php?id=$ev&active=evento'"; ?>><?php echo $event->tittle ?></a></h3>
                                    
                                    <div class="eventFecha">
                                        <small><?php echo $event->date ?></small>       
                                    </div>      
                                    
                                </div>                        
                            </div>  
                          <hr>

                        <?php
                            }
                        ?>

                    </div>
                    <!-- *********************************************** FIN PRÓXIMOS EVENTOS ****************************************************** -->
                </div>
            </div>
        </div>

            <!-- ******************************************************* PAGINADOR ****************************************************** --> 

            <?php
            
            if ($total_paginas > 1) {
                echo '<div class="paginateNov">';
                    echo '<nav class="paginador" aria-label="Page navigation">';
                        echo '<ul  class="pagination">';
                    
                        if ($pageNum != 1) 
                            echo '<li><a data="'.($pageNum-1).'"> <span class="fa fa-backward" aria-hidden="true"></span> Anterior</a></li>';

                        for ($i=1; $i <= $total_paginas; $i++) {
                            if ($pageNum == $i)
                                // Si estamos en la misma página, no ponemos enlace.
                                echo ' <li class="active"><a>'.$i.'<span class="sr-only"></span></a></li>';

                            else
                                // Si no estamos en la misma página, enlazamos a la página $i.
                                echo '<li class="disabled"><a data="'.$i.'">'.$i.'</a></li>';
                        }
                        
                        if ($pageNum != $total_paginas)
                            echo '<li><a data="'.($pageNum+1).'">Siguiente <span class="fa fa-forward" aria-hidden="true"></span></a></li>';
                        
                        echo '</ul>';
                    echo '</nav>';
                echo '</div>';
            }
            
    ?>

            <!-- ************************************************** FIN PAGINADOR ****************************************************** -->               

        </div>

        <!-- ************************************************** FOOTER ****************************************************** -->  

        <?php include "footer.php"; ?>

        <!-- ************************************************** FIN FOOTER ****************************************************** -->  

        <!-- Script -->
        
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>
        
        <script>
           

        </script>

    </body>

</html>

