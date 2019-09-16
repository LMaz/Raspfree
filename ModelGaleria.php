<?php

	include "DBfunctions.php";

	function insertarGaleria($eventId, $tit, $img, $fecha){

		$conexion = conecta();

    


		$id = uniqid();
		$sql = "INSERT INTO gallery VALUES ('$id', '$eventId', '$tit', '$img', '$fecha')";


		$consult = mysqli_query($conexion, $sql);



	    mysqli_close($conexion);

	    return $consult;


	}

	function getImagenes($eventId) {

		$conexion = conecta();
		$sql = "SELECT * FROM gallery  WHERE eventId= '$eventId' ORDER BY fecha DESC";

		$consult = mysqli_query($conexion, $sql);

	    mysqli_close($conexion);

	    return $consult;
	}

     function getImagen ($id) {
        
        $conexion = conecta();
        
        $sql = "SELECT * FROM gallery WHERE id = '$id'";

        $consult = mysqli_query($conexion, $sql);

        mysqli_close($conexion);
        
        return $consult;
        
    }

	
   function updateImgGaleria($img, $id) {
        
   $conexion = conecta();
        
   $sql = "UPDATE gallery SET image = '$img' WHERE id = '$id'";
   $consult = mysqli_query($conexion, $sql);
        
   mysqli_close($conexion);
        
   if ($consult != null) {
        	$done = true;
        } else {
            $done = false;
        }
       
        return $done;
    }

function updateTittleGaleria($titulo, $id) {
        
  $conexion = conecta();
        
        
  $sql = "UPDATE gallery SET tittle = '$titulo' WHERE id = '$id'";
  $consult = mysqli_query($conexion, $sql);
        
  mysqli_close($conexion);
        
  if ($consult != null) {
        $done = true;
        } else {
            $done = false;
        }
       
        return $done;
    }


    function getEvento($id) {
        $conexion = conecta();
        $sql = "SELECT * FROM events WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }
    ?>