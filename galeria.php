<?php
session_start();

  include "ModelEvento.php";
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Galería</title>

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

                <!-- *************************************** MIGAS DE PAN ****************************************** -->
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Raspfree</a></li>
                        <li class="active">Galería</li>
                    </ol>
                </div>

                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Galería</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>





                <?php
                  
                    $consult = getEventosPasados();
                    if ($consult != null) {
                ?>

                <!-- *********************************************** ÁLBUMES ********************************************************************* -->
                <div class="eventos-proximos-content galeria-padding">


                    <div class="galeria-row-padding eventos-proximos-padding-16 eventos-proximos-center">
                <?php                    
	                    while ($evento = mysqli_fetch_object($consult)) {
			                $id = $evento->id;
			                $tittle = $evento->tittle;
			                $image = $evento->image;
			                $author = $evento->author;
			                $date = $evento->date;
			                $body = $evento->body;
			                $place = $evento->place;
                            $resum = substr($tittle, 0, 15) . "...";
	            ?>
		                    <div class="galeria-quarter">
		                    	<?php echo '<img class="img-responsive gal " alt="Imagen" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
		                    	<h3><?php echo $resum ?></h3>
		                    	
		                        
                                <p><a class=" eventos-proximos-button eventos-proximos-black" <?php echo "href='album.php?id=$id&active=galeria'"; ?>Ver álbum</a></p>
                                <p class="clear"></p>
		                    </div>
	            <?php
	                	}
	        	?>

                    </div>
                <?php
                }
                    else {
                        echo '<h3> No hay álbumes. </h3>';
                    }
                ?>
                </div>
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
    </body>
</html>