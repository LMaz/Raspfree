<?php
    session_start();
    ob_start();
    include "ModelNovedad.php";
    
    $titulo = isset($_POST['titulo']) ? htmlspecialchars(trim(strip_tags($_POST['titulo']))):null; 
    $contenido = isset($_POST['editor']) ? $_POST['editor'] : null;

    // Comprobamos que se han introducido todos los datos.
    if (!empty($_FILES['imagen']['name']) && $titulo != null && $contenido != null){
        
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
                // Insertamos los datos en la BD.
                $author = $_SESSION['username'];
                $date = date("Y-m-d H:i:s");

                $consult = insertNov($binario_contenido, $imgName, $titulo, $author, $date, $contenido);

                if ($consult != null) {
                    $message = "Se ha creado la novedad correctamente.";
                    header("Location: crearNovedad.php?novOk=$message&active=admin");
                } else {
                    $message = "No se ha podido crear la novedad.";
                    header("Location: crearNovedad.php?novFail=$message&active=admin");
                }
                
            } else {
                    $message = "La imagen debe ser .jpg.";
                    header("Location: crearNovedad.php?novFail=$message&active=admin");
            }
           
        } else {
                $message = "La imagen es demasiado grande.";
                header("Location: crearNovedad.php?novFail=$message&active=admin");
        }
        
    } else { 
        $message = "No se pueden enviar campos vacíos.";
        header("Location: crearNovedad.php?novFail=$message&id=$id&active=admin");
    }
ob_end_flush();
?>