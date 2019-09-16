</html>
<?php
session_start();


include "ModelEvento.php";
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>

        <title>RaspFree Evento Próximo</title>

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
                    //Mostramos notificaciones
                    if(isset($_GET['comentarioOk'])) { ?>
                        <div class="panel panel-success">
                            <div class="panel-heading centrado"><?php echo $_GET['comentarioOk'] ?></div>
                        </div>
                    <?php }
                    if(isset($_GET['comentarioFail'])) { ?>
                         <div class="panel panel-danger">
                            <div class="panel-heading centrado"><?php echo $_GET['comentarioFail'] ?></div>
                        </div>
                    <?php }
                    if(isset($_GET['comentarioFail'])) { ?>
                         <div class="panel panel-danger">
                            <div class="panel-heading centrado"><?php echo $_GET['comentarioFail'] ?></div>
                        </div>
                    <?php }
                    if(isset($_GET['editoreventoOk'])) { ?>
                         <div class="panel panel-success">
                            <div class="panel-heading centrado"><?php echo $_GET['editoreventoOk'] ?></div>
                        </div>
                    <?php }
            ?>


                <?php
                    
                    $consult = getEvento($id);
                    $evento = mysqli_fetch_object($consult);
                    $tittle = $evento->tittle;
                    $image = $evento->image;
                    $author = $evento->author;
                    $date = $evento->date;
                    $body = $evento->body;
                    $place = $evento->place;
                    $numeroParticipantes = numeroParticipantes($id);
                    $current_date = date("Y-m-d H:i:s");


                    if ($date > $current_date) {
                ?>

                <!-- *************************************** MIGAS DE PAN ****************************************** -->
                        <!-- Evento Próximo -->
                        <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Raspfree</a></li>
                                <li><a href="eventosProximos.php">Eventos Próximos</a></li>
                                <li class="active">Evento</li>
                            </ol>
                        </div>
                <?php
                    }
                    else {
                ?>
                        <!-- Evento Pasado -->
                        <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Raspfree</a></li>
                                <li><a href="eventosPasados.php">Eventos Pasados</a></li>
                                <li class="active">Evento</li>
                            </ol>
                        </div>
                <?php
                    }
                ?>




        <!-- *********************************************** EVENTOS ********************************************************************* -->



                <!-- *********************************************** EVENTO 1 ********************************************************************* -->
                <div class="eventos-proximos-margin eventos-proximos-padding-large eventos-proximos-content">
                    <div class="col-md-12 col-sm-12">
                        <h1 class = "titNov"> <?php echo $tittle ?> </h1>
                    </div>
                    <?php
                        //EDITAR
                        if (isset($_SESSION['admin']) == true) {

                            //BOTÓN IZQUIERDO - EDITAR EVENTO
                            ?>
                            
                            <div class="eventos-proximos-center"><p class="eventos-proximos-left eventos-proximos-padding-large"><a <?php echo "href='editorEvento.php?id=$id&active=evento'"; ?>><span class="eventos-proximos-button eventos-proximos-white eventos-proximos-border"><span class="fa fa-edit"></span> Editar </span></a></p></div>
                            
                            
                            <?php
                            if ($date <= $current_date) {
                                //BOTÓN DERECHO - AÑADIR IMAGEN (EVENTOS PASADOS)
                            ?>
                                <div class="eventos-proximos-center"><p class="eventos-proximos-right eventos-proximos-padding-large"><a <?php echo "href='crearImagen.php?id=$id&active=galeria'"; ?>><span class="eventos-proximos-button eventos-proximos-white eventos-proximos-border"><span class="fa fa-edit"></span> Añadir Imagen </span></a></p></div>
                            
                            <p class="clear"></p>
                            <hr>
                            <?php
                            }
                        }
                    ?>

                    <div class="eventos-proximos-justify">
                        <?php echo '<img class="eventos-proximos-padding-16 img-responsive imgEvento" alt="Imagen" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
                        <p><?php echo $body ?></p>

                    <!--BOTÓN IZQUIERDO - PARTICIPAR/MOSTRAR PARTICIPANTES (EVENTO PROXIMO) O VER ÁLBUM (EVENTO PASADO)-->
                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            //EVENTO PRÓXIMO
                            if ($date > $current_date) {
                                $_SESSION['evento'] = $id;
                                if (yaParticipa($_SESSION['username'], $id)) { //Si ya participas te avisa de que ya estás apuntado y te muestra el número de participates
                        ?>
                                    <p class="eventos-proximos-left eventos-proximos-button eventos-proximos-white eventos-proximos-border">Ya estás apuntado <span class="eventos-proximos-tag eventos-proximos-border eventos-proximos-white"> <?php echo numeroParticipantes($id); ?></p>
                        <?php
                                } //if
                                else { //Si no estás apuntado te dejará unirse mediante al pulsar el botón
                        ?>
                                    <p class="eventos-proximos-left"><span id="botonUnirse" class="eventos-proximos-button eventos-proximos-white eventos-proximos-border"><span class="fa fa-thumbs-up"></span> Unirse </span></p>
                        <?php
                                } //else
                            } //if
                        }
                            //EVENTO PASADO
                            if ($date <= $current_date) { //Si se trata de un evento pasado, lo que aparecerá a la izquierda es un boton para ver el album
                                echo '<p class="eventos-proximos-left"><a href="album.php?id='.$id.'"><span class="eventos-proximos-button eventos-proximos-white eventos-proximos-border"><span class="fa fa-camera"></span> Ver álbum</span></a></p>';
                            } //lese
                        ?>
                    <!-- FIN BOTÓN IZQUIERDO--> 



                    <!--BOTÓN DERECHO - VER/AÑADIR COMENTARIOS-->
                        <p class="eventos-proximos-right "><span class="eventos-proximos-button eventos-proximos-black" id="myBtn">Comentarios  <span class="eventos-proximos-tag eventos-proximos-white"> <?php echo numeroComentarios($id); ?> </span></span></p>

                        <!--Para que no se monte la foto ecima del <hr>-->
                        <p class="clear"></p>
                        
                        <div class="evento-display" id="comentarios">
                        <!--Comentarios-->
                            <div class="eventos-proximos-row">
                                <hr>
                                <?php
                                    $consult = getComentarios($id);
                                    while ($comentario = mysqli_fetch_object($consult)) {
                                        $idcomentario = $comentario->id;
                                        $emisor = $comentario->userId;
                                        $evento = $comentario->eventId;
                                        $date = $comentario->date;
                                        $coment = $comentario->coment;
                                        $consult2 = datosUser($emisor);
                                        while ($usuario = mysqli_fetch_object($consult2)) {
                                            $image = $usuario->image;
                                        
                                ?>
                                <div class="col-xs-3 col-sm-2">
                                    <?php echo '<img class="eventos-proximos-padding-16 img-responsive" alt="imagenUsuario" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
                                </div>
                                <div class="col-xs-9 col-sm-10">
                                    <h4 class="hidden-xs"> <?php echo $emisor ?> <span class="eventos-proximos-opacity eventos-proximos-medium hidden-xs"> <?php echo $date ?> </span></h4>
                                    <p> <?php echo $coment ?> </p>
                                </div>
                                <p class="clear"></p>
                                <?php
                            }
                                    }
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                ?>
                                <hr>
                                <?php echo '<a href="añadirComentarioEvento.php?id='.$id.'" class="btn btn-default pull-right btnComentarios">Comentar</a>';
                                    }
                                ?>
                            </div>
                        </div>
                    <!--FIN BOTÓN DERECHO-->


                    </div>
                        <p class="clear"></p>
                        <hr>
                        <div class="eventos-localizacion-margenes">
                            <div class="eventos-no-padding-izquierda eventos-margin-top col-sm-6">
                                <h4>Fecha del evento:</h4>
                                <span class="fa fa-calendar eventos-simbolo-rojo"></span> <?php echo $date ?>
                            </div>

                            <div class="eventos-no-padding-derecha eventos-margin-top col-sm-6">
                                <h4>Localización del evento:</h4>
                                <span class="fa fa-map-marker eventos-simbolo-rojo"></span> <?php echo $place ?> <br>
                            </div>
                        </div>
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