<?php
    session_start();
    ob_start();

    include "ModelGaleria.php";
    
    $eventId = isset($_GET['eventId']) ? htmlspecialchars(trim(strip_tags($_GET['eventId']))) : null;
    $titulo = isset($_POST['titulo'])  ? htmlspecialchars(trim(strip_tags($_POST['titulo']))) : null;

    // Comprobamos que se han introducido todos los datos.
    if (!empty($_FILES['imagen']['name']) != null && $eventId != null && $titulo != null){
        
        // Generamos el archivo temporal de la imagen subida.
        $binario_nombre_temporal = $_FILES['imagen']['tmp_name'] ;

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

                $consult = insertarGaleria($eventId, $titulo, $binario_contenido, $date);

                if ($consult != null) {
                    $message = "Se ha creado la galeria correctamente.";
                    header("Location: crearImagen.php?galOk=$message&id=$eventId");
                } else {
                    $message = "No se ha podido crear la galeria.";
                    header("Location: crearImagen.php?galFail=$message");
                }
                
            } else {
                    $message = "La imagen debe ser .jpg.";
                    header("Location: crearImagen.php?galFail=$message&id=$eventId");
            }
           
        } else {
                $message = "La imagen es demasiado grande.";
                header("Location: crearImagen.php?galFail=$message&id=$eventId");
        }
        
    } else {
       $message = "Hay que introducir todos los datos.";
       header("Location: crearImagen.php?galFail=$message&id=$eventId");
    }
    ob_end_flush();
?>
