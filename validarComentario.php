<?php
session_start();

	include "ModelEvento.php";

	$userId = $_SESSION['username'];
	$eventId = $_GET['id'];
	$date = date("Y-m-d H:i:s");
	$coment = isset($_POST['editor']) ? htmlspecialchars(trim(strip_tags($_POST['editor']))) : null;
 	// Comprobamos que se han introducido todos los datos.
	if ($coment != null){
		$id = uniqid();
		$consult = insertarComentario($id, $userId, $eventId, $date, $coment);
		if ($consult != null) {
            $message = "Se ha creado el comentario correctamente";
            header("Location:evento.php?comentarioOk=$message&id=$eventId");
        }
        else {
            $message = "No se ha podido crear el comentario";
            header("Location:evento.php?comentarioFail=$message&id=$eventId");
        }
	}
	else {
       $message = "Hay que introducir todos los datos.";
       header("Location:evento.php?comentarioFail=$message&id=$eventId");
	}


?>