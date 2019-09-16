<?php

	include "DBfunctions.php";

	function insertarTutorial($img, $titulo, $type, $author, $date, $contenido){


		$conexion = conecta();


		$id = uniqid();
		$sql = "INSERT INTO tutorials VALUES ('$id', '$titulo', '$type', '$author', '$date', '$img', '$contenido', '0')";
		$consult = mysqli_query($conexion, $sql);


	    mysqli_close($conexion);

	    return $consult;


	}

	function getTutorialesVar () {

		$conexion = conecta();
		$sql = "SELECT * FROM tutorials WHERE type='varios' and  moderated='1' ORDER BY fecha DESC";
		$consult = mysqli_query($conexion, $sql);

	    mysqli_close($conexion);

	    return $consult;
	}

	function getTutorialesDron () {

		$conexion = conecta();
		$sql = "SELECT * FROM tutorials WHERE type='drones' and moderated='1' ORDER BY fecha desc";
		$consult = mysqli_query($conexion, $sql);
	    mysqli_close($conexion);

	    return $consult;
	}

	 function getTutorialesPagDron ($offset, $rowsPerPage) {
         
        $conexion = conecta();
       
        $sql = "SELECT * FROM tutorials WHERE type='drones' and moderated='1' ORDER BY fecha desc LIMIT $offset, $rowsPerPage";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
    }

     function getTutorialesPagVar ($offset, $rowsPerPage) {
         
        $conexion = conecta();
       
        $sql = "SELECT * FROM tutorials WHERE type='varios' and moderated='1' ORDER BY fecha DESC LIMIT $offset, $rowsPerPage";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
    }


   function getTutorial ($id) {
        
        $conexion = conecta();
        
        $sql = "SELECT * FROM tutorials WHERE id = '$id'";

        $consult = mysqli_query($conexion, $sql);

        mysqli_close($conexion);
        
        return $consult;
        
    }


   function updateImgTutorial($img, $id) {
        
   $conexion = conecta();
        
   $sql = "UPDATE tutorials SET image = '$img' WHERE id = '$id'";
   $consult = mysqli_query($conexion, $sql);
        
   mysqli_close($conexion);
        
   if ($consult != null) {
        	$done = true;
        } else {
            $done = false;
        }
       
        return $done;
    }
    
    function updateTittleTutorial($titulo, $id) {
        
        $conexion = conecta();
        
        $sql = "UPDATE tutorials SET tittle = '$titulo' WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        if ($consult != null) {
            $done = true;
        } else {
            $done = false;
        }
       
        return $done;
    }
    
     function updateBodyTutorial($content, $id) {
        
        $conexion = conecta();
        
        $sql = "UPDATE tutorials SET body = '$content' WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        if ($consult != null) {
            $done = true;
        } else {
            $done = false;
        }
       
        return $done;
    }

    //------------------------------COMENTARIOS--------------------------------

    function insertarComentario($id, $userId, $tutorialId, $date, $coment){
        $conexion = conecta();
        $id = uniqid();
        $sql = "INSERT INTO tutorialcoments VALUES('$id', '$userId', '$tutorialId', '$date', '$coment')";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

    function numeroComentarios($id_tut) {
        $conexion = conecta();
        $sql="SELECT * FROM tutorialcoments where tutorialId = '$id_tut'";
        $consulta = mysqli_query($conexion,$sql);
        $filas = mysqli_num_rows($consulta);
        mysqli_close($conexion);

        return $filas;
    }

    function getComentarios($id_tut) {
        $conexion = conecta();
        $sql = "SELECT * FROM tutorialcoments WHERE TutorialId = '$id_tut' ORDER BY date desc";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }


    //------------------------------LIKES--------------------------------

    function numeroLikes($id_tut) {
        $conexion = conecta();
        $sql="SELECT * FROM liketutorial WHERE tutId = '$id_tut'";
        $consulta = mysqli_query($conexion,$sql);
        $filas = mysqli_num_rows($consulta);
        mysqli_close($conexion);

        return $filas;
    }

    function yaParticipa($usuario, $id_tut) {
        $conexion = conecta();
        $sql = "SELECT * FROM liketutorial WHERE userid = '$usuario' AND tutId = '$id_tut'";
        $consulta = mysqli_query($conexion,$sql);
        $filas = mysqli_num_rows($consulta);
        mysqli_close($conexion);
        if ($filas > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    function datosUser($usuario) {
    $conexion = conecta();


    $result = mysqli_query($conexion, "SELECT * FROM users WHERE userName = '$usuario'") or die(mysqli_error());
    mysqli_close($conexion);
    return $result;
}
?>


   
    


