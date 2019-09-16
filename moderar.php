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

        <title>Moderar</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Moderar">
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
        <div id="content" class="container MargenSup60 ">

            <div class="row well  well-sm">

                <!-- *************************************** MIGAS DE PAN ****************************************** -->
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php?active=novedad">Raspfree</a></li>
                        <li class="active">Moderar</li>
                    </ol>
                </div>
                <!-- *************************************** FIN MIGAS DE PAN ****************************************** -->
                
                <!-- *************************************** TITULO ****************************************** -->
                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Moderar</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>
                <!-- *************************************** FIN TITULO ****************************************** -->
                
                <!-- ************************* APARTADO DE MENSAJES DE ERROR O DE ÉXITO ********************************* -->
                <?php
                
                    if(isset($_GET['tutOk'])) { ?>
                        <div class="panel panel-success">
                            <div class="panel-heading centrado"><?php echo $_GET['tutOk'] ?></div>
                        </div>
                       
                    <?php } 
                    if(isset($_GET['tutFail'])) { ?>
                         <div class="panel panel-danger">
                            <div class="panel-heading centrado"><?php echo $_GET['tutFail'] ?></div>
                        </div>
                    <?php } 
                
                //<!-- ************************* FIN APARTADO DE MENSAJES DE ERROR O DE ÉXITO ********************************* -->
               
                // ************************************* Mostrar tutoriales con paginador**********************************************
                $consult = getTutorialesNoModerated ();
                $num_total_registros = mysqli_num_rows($consult);

                //Si hay registros
                $total_paginas = 0;
                if ($num_total_registros > 0) {
                    
                    $rowsPerPage = 3;//Número de tutoriales por página.

                    // Por defecto mostramos la página 1
                    $pageNum = 1;

                    // Si $_GET['page'] esta definido, usamos este número de página
                    if(isset($_GET['page'])) {  
                        $pageNum = $_GET['page'];
                    }

                    // Contando el desplazamiento
                    $offset = ($pageNum - 1) * $rowsPerPage;
                    
                    $total_paginas = ceil($num_total_registros / $rowsPerPage);

                    $consult2 = getTutorialesPagModerated($offset, $rowsPerPage);
                    
                    while ($tut = mysqli_fetch_object($consult2)) {   
                           
                        $id = $tut->id;
                        $img = $tut->image;
                        $body = $tut->body;
                        $resum = substr($body, 0, 500) . "...";

                        ?>

                        <div class="MargenSuperior40">
                            <div class="row col-md-offset-1">
                                <div class=" col-md-4">
                                    <?php  echo '<img class="imgTuto img-responsive" alt="raspberry" src="data:image/jpeg;base64,'.base64_encode($img).'"/>'; ?>
                                </div>

                                <div class="col-md-6">
                                    <h3><?php echo $tut->tittle ?></h3>

                                    <small class="novAutor">
                                        <?php echo $tut->author ?> / <?php echo $tut->fecha ?>
                                    </small>
                                    <p> <?php echo$resum ?> </p>

                                    <a class=" leerMas pull-right" <?php echo "href='moderarTut.php?tut=$id&active=admin'"; ?>>Moderar...</a>     

                                </div>

                            </div>
                            <hr class="hrTut col-md-offset-1 col-md-10">

                </div>

                        <?php
                        
                    }
                  
                } else {
                   echo "<h3> No hay más tutoriales para moderar. </h3>";
                }
                  // ************************************* Fin mostrar TUTORIALES **********************************************
                ?>

            </div>
        
            <?php
            
                if ($total_paginas > 1) {
                    echo '<div class="paginateMod">';
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

        <script>
            
            $(".paginateMod a").bind("click", function(){

                var page = $(this).attr('data');    
                var dataString = 'page='+page;

                $('body').animate({scrollTop:0}, 'slow');
                $.ajax({

                    type: "GET",
                    url: "moderar.php",
                    data: dataString,
                    success: function(data) {
                        $('#content').html(data);
                    }
                });

            });
            
            </script>

    </body>
</html>

