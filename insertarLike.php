<?php
	include "DBfunctions.php";
session_start();
	function insertarParticipante($usuario, $id_tuto) {
		$conexion = conecta();
		$id = uniqid();
		$sql = "INSERT INTO liketutorial VALUES('$id', '$id_tuto', '$usuario')";
		$consult = mysqli_query($conexion, $sql);
	    mysqli_close($conexion);
	}
	insertarParticipante($_SESSION['username'], $_SESSION['tutorial']);
?>