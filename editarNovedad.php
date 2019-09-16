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

<html>
    <head>
        <title>RaspFree Editar Novedad</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Editar novedad">
        <meta name="author" content="Sara Vegas y Alejandro Torralbo">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Favicon -->
        <link rel="icon" href="img/favicon.png" type="image/png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilos.css" type="text/css">  

    <body>
       
        <?php include"navbar.php";?>
        
        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">
            <div class="row well  well-sm">
                
                <!-- *************************************** MIGAS DE PAN ****************************************** -->
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php?active=novedad">Raspfree</a></li>
                        <li><a href="novedad.php?active=novedad">Novedad</a></li>
                        <li class="active">Editar novedad</li>
                    </ol>
                </div>
                <!-- *************************************** FIN MIGAS DE PAN ****************************************** -->
   
                <!-- *************************************** TITULO ****************************************** -->
                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Editar Novedad</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>
                <!-- *************************************** FIN TITULO ****************************************** -->

                <!-- Obtenemos los datos de la novedad para mostrarlos y poder editarlos. -->
                <?php 
                    if(isset($_GET['id'])) { 
                        $id = $_GET['id'];

                        $consult = getNovedad ($id);

                        while ($nov = mysqli_fetch_object($consult)) {     
                
                ?>  
                
               <!-- ************************* APARTADO DE MENSAJES DE ERROR O DE ÉXITO ********************************* -->

                <?php
                
                    if(isset($_GET['novOk'])) { ?>
                        <div class="panel panel-success">
                            <div class="panel-heading centrado"><?php echo $_GET['novOk'] ?></div>
                        </div>  
                    <?php } 
                    if(isset($_GET['novFail'])) { ?>
                         <div class="panel panel-danger">
                            <div class="panel-heading centrado"><?php echo $_GET['novFail'] ?></div>
                        </div>
                    <?php } 
                ?>
                <!-- ************************* FIN APARTADO DE MENSAJES DE ERROR O DE ÉXITO ********************************* -->

                <!-- **************************************** FORMULARIO ****************************************** -->
                <form autocomplete="off" <?php echo "action='validarEditarNovedad.php?id=$id' "; ?> enctype="multipart/form-data" method="post">

                    <div class="form-group">
                        <h3>Título: </h3>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $nov->tittle ?>" required="">
                    </div>
                    <div class="form-group">
                        <h3>Imagen principal:</h3>
                        <input type="file" class="form-control-file"  id="imagen" name="imagen" aria-describedby=" <?php echo $nov->imgName ?>">
                        <small id="fileHelp" class="form-text text-muted">Imagen actual:  <?php echo $nov->imgName ?></small>
                        <?php  echo '<img class="img-responsive imgNovedad" src="data:image/jpeg;base64,'.base64_encode($nov->image).'"/>'; ?>

                    </div>

                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Introduzca el contenido:</h3>
                        </div>

                        <div class="box-body pad">    
                            <textarea id="editor" name="editor" rows="100" cols="80">
                                <?php echo $nov->body ?>
                            </textarea>

                        </div>
                    </div>
                    
                     <button class="btn btn-default btnEnviar pull-right" type="submit">Enviar</button>
                </form>
                <!-- **************************************** FIN FORMULARIO ****************************************** -->
               
                <?php 
                    }     
                }
                ?>

            </div>
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
        <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        
    </body>
</html>

