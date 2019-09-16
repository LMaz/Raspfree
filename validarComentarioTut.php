<?php
session_start();
ob_start();

	include "ModelTutorial.php";

	$userId = $_SESSION['username'];
	$tutId = $_GET['id'];
	$date = date("Y-m-d H:i:s");
	$coment = isset($_POST['editor']) ? $_POST['editor'] : null;
 	// Comprobamos que se han introducido todos los datos.
	if ($coment != null){
		$id = uniqid();
		$consult = insertarComentario($id, $userId, $tutId, $date, $coment);
		if ($consult != null) {
            $message = "Se ha creado el comentario correctamente";
            header("Location:tutorial.php?comentarioOk=$message&tut=$tutId");
        }
        else {
            $message = "No se ha podido crear el comentario";
            header("Location:tutorial.php?comentarioFail=$message&tut=$tutId");
        }
	}
	else {
       $message = "Hay que introducir todos los datos.";
       header("Location:tutorial.php?comentarioFail=$message&tut=$tutId");
	}

ob_end_flush();
?>