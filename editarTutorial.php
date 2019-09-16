<?php
session_start();
	    
if (isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['loggedin'] == true &&  $_SESSION['admin'] == true) {
    
} else {
    $error = "Hay que estar registrado para poder ver la página a la que intentas acceder.";
    header("Location: index.php?noLog=$error");
}

include "ModelTutorial.php";

?>

<!DOCTYPE html>

<html>
    <head>
        <title>RaspFree Editar Tutorial</title>

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

    <body>
       
        <?php include"navbar.php";?>
        
        <!-- *********************************************** CONTENIDO ****************************************************** --> 
        <div class="container MargenSup60">
            <div class="row well  well-sm">
                
                <!-- *************************************** MIGAS DE PAN ****************************************** -->

                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Raspfree</a></li>
                        <li class="active">Editar Tutorial</li>
                    </ol>
                </div>
                
                
                <?php 
                    if(isset($_GET['id'])) { 
                        $id = $_GET['id'];

                        $consult = getTutorial ($id);

                        while ($tut = mysqli_fetch_object($consult)) {     
                
                ?>
                                   
                <div class ="titulo row">
                    <img class="img-responsive col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2 hidden-xs imgTit" src="img/tit.png" alt="decoración">
                    <h1 class="col-md-4 col-sm-4">Editar Tutorial</h1>
                    <img class="img-responsive col-md-3 col-sm-3 hidden-xs imgTit" src="img/tit1.png" alt="decoración">
                </div>
                
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
                ?>
                <form autocomplete="off" <?php echo "action='validarEditarTutorial.php?id=$id' "; ?> enctype="multipart/form-data" method="post">

                    <div class="form-group">
                        <h3>Título: </h3>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $tut->tittle ?>" required="">
                    </div>
                    <div class="form-group">
                        <h3>Imagen principal:</h3>
                        <input type="file" class="form-control-file"  id="imagen" name="imagen">
                        <small id="fileHelp" class="form-text text-muted">Imagen actual:</small>
                        <?php  echo '<img class="img-responsive imgTut" src="data:image/jpeg;base64,'.base64_encode($tut->image).'"/>'; ?>

                    </div>

                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Introduzca el contenido:</h3>
                        </div>

                        <div class="box-body pad">    
                            <textarea id="editor" name="editor" rows="100" cols="80">
                                <?php echo $tut->body ?>
                            </textarea>

                        </div>
                    </div>
                    
                     <button class="btn btn-default btnEnviar pull-right" type="submit">Enviar</button>
                </form>
                
                <?php 
                    
                    }
                        
                }
                
                ?>

            </div>
        </div>

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

