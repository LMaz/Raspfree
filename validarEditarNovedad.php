<?php
    session_start();
    ob_start();
    include "ModelNovedad.php";
    
// Comprobanos si nos pasan el id de la novedad.
    if(isset($_GET['id'])) { 
        $id = $_GET['id'];
        
        $ok1 = true;
        
        $titulo = isset($_POST['titulo']) ? htmlspecialchars(trim(strip_tags($_POST['titulo']))):null; 
        $contenido = isset($_POST['editor']) ? $_POST['editor'] : null;

        // Comprobamos que se han introducido todos los datos.
        if ($titulo != null & $contenido != null) {
            //Comprobamos si han editado la imagen.
            if (!empty($_FILES['imagen']['name'])  ){

                // Generamos el archivo temporal de la imagen subida.
                $binario_nombre_temporal = $_FILES['imagen']['tmp_name'] ;
                $imgName = $_FILES['imagen']['name'];

                // Leemos la imagen (archivo binario).
                $binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

                // Obtener del array FILES los datos del binario .. nombre, tamaño y tipo.
                $binario_nombre = $_FILES['imagen']['name'];
                $binario_peso = $_FILES['imagen']['size'];
                $binario_tipo = $_FILES['imagen']['type'];

                // Comprobamos el tamaño de la imagen.
                if ($binario_peso < 600000) {

                    if ($binario_tipo == 'image/jpeg') {
                        //Modificamos BD la imagen.
                        $ok1 = updateImgNovedad($binario_contenido, $imgName, $id);

                    } else {
                        $message = "La imagen debe ser .jpg.";
                        header("Location: editarNovedad.php?novFail=$message&id=$id&active=admin");
                    }

                } else {
                        $message = "La imagen es demasiado grande.";
                        header("Location: editarNovedad.php?novFail=$message&id=$id&active=admin");
                }

            } 
           
            $ok2 = updateTittleNovedad($titulo, $id);    
            $ok3 = updateBodyNovedad($contenido, $id);
            
            if ($ok1 && $ok2 && $ok3)
            {
                $message = "Se ha editado la novedad correctamente.";
                header("Location: editarNovedad.php?novOk=$message&id=$id&active=admin");
            } else {
                $message = "No se ha podido editar la novedad.";
                header("Location: editarNovedad.php?novFail=$message&id=$id&active=admin");
            }

        } else { 
            $message = "No se pueden enviar campos vacíos.";
            header("Location: editarNovedad.php?novFail=$message&id=$id&active=admin");
        }
       
    } else {
        $error = "Error: no se ha indicado ninguna novedad.";
        header("Location: index.php?noLog=$error&active=admin");
    }
    
  ob_end_flush();  
?>
