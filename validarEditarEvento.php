<?php
session_start();

	include "ModelEvento.php";

    $tittle = $_POST['tittle'] ? htmlspecialchars(trim(strip_tags($_POST['tittle']))) : null;
    $place = $_POST['place'] ? htmlspecialchars(trim(strip_tags($_POST['place']))) : null;
    $date = $_POST['date'] ? htmlspecialchars(trim(strip_tags($_POST['date']))) : null;
    $body = isset($_POST['editor']) ? $_POST['editor'] : null;
 	// Comprobamos que se han introducido todos los datos.

    if (!empty($_FILES['image']['name']) && $tittle != null && $body != null && $place != null && $date != null){
        
        $current_date = date("Y-m-d H:i:s");
    	//Comprobamos si la fecha en la que se sucederá el evento es posterior a la actual
        if ($date > $current_date) {
        
        // Generamos el archivo temporal de la imagen subida.
        $binario_nombre_temporal = $_FILES['image']['tmp_name'] ;

        // Leemos la imagen (archivo binario).
        $binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

        // Obtener del array FILES los datos del binario .. nombre, tamaño y tipo.
        $binario_nombre = $_FILES['image']['name'];
        $binario_peso = $_FILES['image']['size'];
        $binario_tipo = $_FILES['image']['type'];

        // Comprobamos el tamaño de la imagen.
        if ($binario_peso < 600000) {
            if ($binario_tipo == 'image/jpeg') {
                 // Insertamos los datos en la BD.
                $id = $_GET['id'];
                $author = $_SESSION['username'];
                $consult = updateEvento($id, $tittle, $binario_contenido, $author, $date, $body, $place);

                if ($consult != null) {
                    $message = "Se ha editado el evento correctamente";
                    header("Location:evento.php?editoreventoOk=$message&id=$id");
                } else {
                    $message = "No se ha podido editar el evento";
                    header("Location:crearEvento.php?editoreventoFail=$message&id=$id");
                }
                
            } else {
                    $message = "La imagen debe ser .jpg";
                    header("Location:crearEvento.php?editoreventoFail=$message&id=$id");
            }
           
        } else {
                $message = "La imagen es demasiado grande";
                header("Location:crearEvento.php?editoreventoFail=$message&id=$id");
        }
        }else {
	        $message = "La fecha elegida debe posterior a la actual";
	        header("Location:crearEvento.php?eventoFail=$message");
	    }

    } else {
       $message = "Hay que introducir todos los datos.";
       header("Location:crearEvento.php?editoreventoFail=$message&id=$id");
    }

?>