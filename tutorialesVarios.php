<?php
session_start();

include "ModelTutorial.php";
?>


<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Tutoriales Varios</title>

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

        

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="content">

       <?php include "navbar.php"; ?>
        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">

            <div class="row well  well-sm">
                
                <!-- *************************************** MIGAS DE PAN ****************************************** -->

                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Raspfree</a></li>
                        <li class="active">Tutoriales Varios</li>
                    </ol>
                </div>

                <!-- ****************************************  TITULO ***************************************************-->
                
                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Tutoriales</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>

               

               <!--  ************************************* Mostrar Tutoriales ********************************************** -->

				<?php 

                $consult = getTutorialesVar();
                $num_total_registros = mysqli_num_rows($consult);

                //Si hay registros
                if ($num_total_registros > 0) {
                    //numero de registros por página
                    $rowsPerPage = 3;

                    //por defecto mostramos la página 1
                    $pageNum = 1;

                    // si $_GET['page'] esta definido, usamos este número de página
                 if(isset($_GET['page'])) {
                        
                        $pageNum = $_GET['page'];
                    }   

                    //contando el desplazamiento
                    $offset = ($pageNum - 1) * $rowsPerPage;
                    $total_paginas = ceil($num_total_registros / $rowsPerPage);

                    $consult2 = getTutorialesPagVar($offset, $rowsPerPage);
                    
                    while ($tut = mysqli_fetch_object($consult2)) {   
                         
                       
                        $id = $tut->id;
                        $img = $tut->image;
                        $body = $tut->body;
                        $resum = substr($body, 0, 800) . "...";

                        ?>


                	<div class="MargenSuperior40">
                    	<div class="row col-md-offset-1">
	                        <div class=" col-md-4">
	                            <img class="imgTuto img-responsive" alt="imagentutorial" <?php  echo 'src="data:image/jpeg;base64,'.base64_encode($img).'"/'; ?> >
	                        </div>

                            
                                <div class="col-md-6">
                                <h3><?php echo $tut->tittle ?></h3>

                                <small class="novAutor">
                                <?php echo $tut->author ?>  / <?php echo $tut->fecha; ?>
                                </small>
                                <p> <?php echo $resum ?>
                                </p>

                                <a class=" leerMas pull-right" <?php echo "href='tutorial.php?tut=$id'"; ?>>Leer más...</a>
                                

                                </div>

                            </div>
                    
                        </div>



                               <hr class="hrTut col-md-offset-1 col-md-10"> 
                           
                   
                         
                  <?php
                        
                    }
                  
                } else {
                   echo "<h3> No hay novedades. </h3>";
                }
                    ?>
  <!-- ********************************************************  FIN MOSTRAR TUTORIAL**************************************************************** -->              
			

                </div>

        </div>

   <!-- ******************************************************* PAGINADOR ***********************************************************************-->

 <?php
            
            if ($total_paginas > 1) {

           

                echo '<div class="paginateVar">';
                    echo '<nav class="paginador" aria-label="Page navigation">';
                        echo '<ul  class="pagination">';
                    
                        if ($pageNum != 1) 
                            echo '<li><a data="'.($pageNum-1).'"> <span class="fa fa-backward" aria-hidden="true"></span> Anterior</a></li>';

                        for ($i=1; $i <= $total_paginas; $i++) {
                            if ($pageNum == $i)
                                //si muestro el índice de la página actual, no coloco enlace
                                echo ' <li class="active"><a>'.$i.'<span class="sr-only"></span></a></li>';

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
            
    ?>
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


