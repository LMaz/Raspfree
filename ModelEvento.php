<?php
    include "DBfunctions.php";


//------------------------------EVENTOS--------------------------------

    function insertarEvento($id, $tittle, $image, $author, $date, $body, $place){
        $conexion = conecta();
        $id = uniqid();
        $sql = "INSERT INTO events VALUES('$id', '$tittle', '$image', '$author', '$date', '$body', '$place')";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

    function getEventosFuturos() {
        $conexion = conecta();
        $current_date = date("Y-m-d H:i:s");
        $sql = "SELECT * FROM events WHERE date > '$current_date'  ORDER BY date desc";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

    function getEventosPasados() {
        $conexion = conecta();
        $current_date = date("Y-m-d H:i:s");
        $sql = "SELECT * FROM events WHERE date <= '$current_date' ORDER BY date desc";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

    function getEvento($id) {
        $conexion = conecta();
        $sql = "SELECT * FROM events WHERE id = '$id'";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

    function updateEvento($id, $tittle, $binario_contenido, $author, $date, $body, $place) {
        $conexion = conecta();
        $sql = "UPDATE `events` SET `tittle`='$tittle', `image`='$binario_contenido',`author`='$author',`date`='$date',`body`='$body',`place`='$place' WHERE id='$id'";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

    function getEventoFuturoPag ($offset, $rowsPerPage) {
        $conexion = conecta();
        $current_date = date("Y-m-d H:i:s");
        $sql = "SELECT * FROM events WHERE date > '$current_date' ORDER BY date DESC LIMIT $offset, $rowsPerPage";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

    function getEventoPasadoPag ($offset, $rowsPerPage) {
        $conexion = conecta();
        $current_date = date("Y-m-d H:i:s");
        $sql = "SELECT * FROM events WHERE date <= '$current_date' ORDER BY date DESC LIMIT $offset, $rowsPerPage";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }



//------------------------------PARTICIPANTES--------------------------------

    function numeroParticipantes($id_evento) {
        $conexion = conecta();
        $sql="SELECT * FROM participants WHERE eventId = '$id_evento'";
        $consulta = mysqli_query($conexion,$sql);
        $filas = mysqli_num_rows($consulta);
        mysqli_close($conexion);

        return $filas;
    }

    function yaParticipa($usuario, $id_evento) {
        $conexion = conecta();
        $sql = "SELECT * FROM participants WHERE userId = '$usuario' AND eventId = '$id_evento'";
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

//------------------------------COMENTARIOS--------------------------------

    function insertarComentario($id, $userId, $eventId, $date, $coment){
        $conexion = conecta();
        $id = uniqid();
        $sql = "INSERT INTO eventcoments VALUES('$id', '$userId', '$eventId', '$date', '$coment')";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

    function numeroComentarios($id_evento) {
        $conexion = conecta();
        $sql="SELECT * FROM eventcoments where eventId = '$id_evento'";
        $consulta = mysqli_query($conexion,$sql);
        $filas = mysqli_num_rows($consulta);
        mysqli_close($conexion);

        return $filas;
    }

    function getComentarios($id_evento) {
        $conexion = conecta();
        $sql = "SELECT * FROM eventcoments WHERE eventId = '$id_evento' ORDER BY date desc";
        $consult = mysqli_query($conexion, $sql);
        mysqli_close($conexion);

        return $consult;
    }

//------------------------------USUARIOS (IMÁGENES)--------------------------------

    function datosUser($usuario) {
        $conexion = conecta();

        $result = mysqli_query($conexion, "SELECT * FROM users WHERE userName = '$usuario'") or die(mysqli_error());
        mysqli_close($conexion);

        return $result;
    }
?>