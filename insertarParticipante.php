<?php
	include "DBfunctions.php";
session_start();
	function insertarParticipante($usuario, $id_evento) {
		$conexion = conecta();
		$id = uniqid();
		$sql = "INSERT INTO participants VALUES('$id', '$id_evento', '$usuario')";
		$consult = mysqli_query($conexion, $sql);
	    mysqli_close($conexion);
	}
	insertarParticipante($_SESSION['username'], $_SESSION['evento']);
?>