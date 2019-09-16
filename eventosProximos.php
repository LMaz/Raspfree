<?php
session_start();

include "ModelEvento.php";
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Eventos Próximos</title>

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

    <body id="content">
        <!-- *********************************************** MENÚ ********************************************************************* -->
        <?php include"navbar.php";?>
        <div class="container MargenSup60">

            <!-- *************************************** CAJA ****************************************** -->
            <div class="row well  well-sm">

                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Eventos</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>

                <!-- *************************************** MIGAS DE PAN ****************************************** -->
                
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Raspfree</a></li>
                        <li class="active">Eventos Próximos</li>
                    </ol>
                </div>
                
                <?php
                    

                    $consult = getEventosFuturos();
                    $num_total_registros = mysqli_num_rows($consult);

                    //Si hay registros
                    if ($num_total_registros > 0) {
                        //Numero de registros por pagina
                        $rowsPerPage = 3;

                        //Por defecto mostramos la pagina 1
                        $pageNum = 1;

                        //Si $_GET['page'] esta definido, usamos este numero de pagina
                        if(isset($_GET['page'])) {
                            $pageNum = $_GET['page'];
                        }

                        //contando el desplazamiento
                        $offset = ($pageNum - 1) * $rowsPerPage;
                        $total_paginas = ceil($num_total_registros / $rowsPerPage);

                        $consult2 = getEventoFuturoPag($offset, $rowsPerPage);

                        if ($consult2 != null) {
                            while ($evento = mysqli_fetch_object($consult2)) {
                                $id = $evento->id;
                                $_SESSION['evento'] = $id; //para insertar participantes
                                $tittle = $evento->tittle;
                                $image = $evento->image;
                                $author = $evento->author;
                                $date = $evento->date;
                                $body = $evento->body;
                                $place = $evento->place;
                                $resum = substr($body, 0, 200) . "...";
                                $numeroParticipantes = numeroParticipantes($id);
                ?>

                                <!-- *********************************************** EVENTO ********************************************************************* -->
                                <div class="eventos-proximos-margin eventos-proximos-padding-large eventos-proximos-content">
                                    <div class="eventos-proximos-center eventos-no-padding">
                                        <h2> <?php echo $tittle ?> </h2>
                                    </div>
                                    
                                    <div class="col-md-12 eventos-no-padding">
                                        <div class="eventos-no-padding-izquierda col-md-6">
                                            <?php echo '<img class="imgEvento" alt="Imagen" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
                                        </div>
                                        <!--Se deja un margen a la izquierda para separar de la imagen-->
                                        <div class="eventos-proximos-justify eventos-no-padding-derecha col-md-6">
                                            <p> <?php echo $body ?> </p>
                                        </div>
                                    </div>

                                    <?php
                                        if (isset($_SESSION['username'])) {
                                    ?>
                                            <div class="eventos-proximos-justify">
                                            <!--Botón izquierdo-->
                                            <p class="eventos-proximos-left"><a class=" eventos-proximos-button eventos-proximos-black" <?php echo "href='evento.php?id=$id&active=evento'"; ?>>Leer más...</a></p>

                                            <!--Botón derecho-->
                                            <?php
                                                if (yaParticipa($_SESSION['username'], $id)) {
                                            ?>
                                                    <p class="eventos-proximos-right eventos-proximos-button eventos-proximos-white eventos-proximos-border">Ya estás apuntado <span class="eventos-proximos-tag eventos-proximos-border eventos-proximos-white"> <?php echo numeroParticipantes($id); ?></p>
                                            <?php
                                                }
                                                else {
                                            ?> 
                                                    <p class="eventos-proximos-right eventos-proximos-button eventos-proximos-white eventos-proximos-border">Participantes <span class="eventos-proximos-tag eventos-proximos-border eventos-proximos-white"> <?php echo numeroParticipantes($id); ?></p>
                                            <?php
                                                }
                                            ?>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <p class="clear"></p>
                                <hr>
                <!-- *********************************************** FIN EVENTO ********************************************************************* -->
                <?php
                            } //cerramos el while
                        } //cerramos el if

                    } //if
                    else {
                        echo '<h3> No hay eventos. </h3>';
                    } //else
                ?>

            </div> <!--class box-->



            <!-- ************************************************** PAGINADOR ****************************************************** -->  

            <?php
	            if ($num_total_registros != null) {
	                if ($total_paginas > 1) {
	                    echo '<div class="paginateEventProx">';
	                        echo '<nav class="paginador" aria-label="Page navigation">';
	                            echo '<ul  class="pagination">';
	                        
	                            if ($pageNum != 1) 
	                                echo '<li><a data="'.($pageNum-1).'"> <span class="fa fa-backward" aria-hidden="true"></span> Anterior</a></li>';

	                            for ($i=1; $i <= $total_paginas; $i++) {
	                                if ($pageNum == $i)
	                                    //si muestro el índice de la página actual, no coloco enlace
	                                    echo '<li class="active"><a>'.$i.'<span class="sr-only"></span></a></li>';

	                                else
	                                    //si el índice no corresponde con la página mostrada actualmente,
	                                    //coloco el enlace para ir a esa página
	                                    echo '<li class="disabled"><a data="'.$i.'">'.$i.'</a></li>';
	                            }
	                            
	                            if ($pageNum != $total_paginas)
	                                echo '<li><a data="'.($pageNum+1).'">Siguiente <span class="fa fa-forward" aria-hidden="true"></span></a></li>';
	                            
	                            echo '</ul>';
	                        echo '</nav>';
	                    echo '</div>';
	                }
	            }
            
            ?>
            <!-- ************************************************** FIN PAGINADOR ****************************************************** -->  



        </div> <!--container-->            



        <!-- ************************************************** FOOTER ****************************************************** -->
       <?php include"footer.php";?>

       
        <!-- ************************************************** FIN FOOTER ****************************************************** -->  

         <!-- Script -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/modal.js"></script>

    </body>
</html>
