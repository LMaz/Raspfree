<?php

    include "DBfunctions.php";
    
    // Insertamos una nueva novedad en la base de datos.
    function insertNov($img, $imgName, $titulo, $author, $date, $contenido) {
        
        $conexion = conecta();
        
        $id = uniqid(); // Generams un id único.
        $sql = "INSERT INTO news VALUES ('$id', '$titulo', '$author', '$date', '$imgName', '$img', '$contenido')";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
        
    }
    
    // Actualizamos la imagen de una novedad en base de datos.
    function updateImgNovedad($img, $imgName, $id) {
        
        $conexion = conecta();
        
        $sql = "UPDATE news SET imgName = '$imgName', image = '$img' WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        if ($consult != null) {
            $done = true;
        } else {
            $done = false;
        }
       
        return $done;
    }
    
    // Actualzamos el título de la novedad en base de datos.
    function updateTittleNovedad($titulo, $id) {
        
        $conexion = conecta();
        
        $sql = "UPDATE news SET tittle = '$titulo' WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        if ($consult != null) {
            $done = true;
        } else {
            $done = false;
        }
       
        return $done;
    }
    
    // Actualizamos el contenido de una novedad en base de datos.
    function updateBodyNovedad($content, $id) {
        
        $conexion = conecta();
        
        $sql = "UPDATE news SET body = '$content' WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        if ($consult != null) {
            $done = true;
        } else {
            $done = false;
        }
       
        return $done;
    }
    
    // Obtenemos todas las novedades de la base de datos ordenadas por fecha.
    function getNovedades () {
        
        $conexion = conecta();
        
        $sql = "SELECT * FROM news ORDER BY date desc";
        $consult = mysqli_query($conexion, $sql);

        mysqli_close($conexion);
        
        return $consult;
    }
    
    // Obtenemos las novedades que se muestran en una página del paginador.
    function getNovedadesPag ($offset, $rowsPerPage) {
         
        $conexion = conecta();
       
        $sql = "SELECT * FROM news ORDER BY date DESC LIMIT $offset, $rowsPerPage";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
    }

    // Obtenemos la información de una novedad.
    function getNovedad ($id) {
        
        $conexion = conecta();
        
        $sql = "SELECT * FROM news WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);

        mysqli_close($conexion);
        
        return $consult;
        
    }
    
    
    // ******************************************* EVENTOS ******************************************
    
    // Obtenemos los $num últimos eventos.
    function getUltEventos ($num) {
         
        $conexion = conecta();
        
        $today = date("Y-m-d H:i:s");
       
        $sql = "SELECT * FROM events  WHERE date > '$today' ORDER BY date DESC LIMIT $num";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
    }
    
    // ******************************************* TUTORIALES ******************************************

    // Obtenemos los $num últimos tutorieles.
    function getUltTutoriales ($num) {
         
        $conexion = conecta();
       
        $sql = "SELECT * FROM tutorials WHERE moderated = true ORDER BY fecha DESC LIMIT $num";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
    }
 
        // Obtenemos todas los tutoriales de la base de datos ordenadas por fecha.
    function getTutorialesNoModerated () {
        
        $conexion = conecta();
        
        $sql = "SELECT * FROM tutorials WHERE moderated = false ORDER BY fecha desc";
        $consult = mysqli_query($conexion, $sql);

        mysqli_close($conexion);
        
        return $consult;
    }
    
    // Obtenemos las novedades que se muestran en una página del paginador.
    function getTutorialesPagModerated ($offset, $rowsPerPage) {
         
        $conexion = conecta();
       
        $sql = "SELECT * FROM tutorials WHERE moderated = false ORDER BY fecha DESC LIMIT $offset, $rowsPerPage";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
    }

    // Obtenemos la información de un tutorial.
    function getTutorial ($id) {
        
        $conexion = conecta();
        
        $sql = "SELECT * FROM tutorials WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);

        mysqli_close($conexion);
        
        return $consult;
        
    }
    
    // Marcamos un tutorial como moderado.
    function acceptTut ($id) {
        
        $conexion = conecta();
        
        $sql = "UPDATE tutorials SET moderated = true WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
        
    }
    
    // Eliminamos un tutorial.
    function eraseTut ($id) {
        
        $conexion = conecta();
        
        $sql = "DELETE FROM tutorials WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        
        mysqli_close($conexion);
        
        return $consult;
    }
 
?>

