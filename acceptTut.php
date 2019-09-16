<?php
session_start();
 ob_start();
if (isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['loggedin'] == true &&  $_SESSION['admin'] == true) {
    
} else {
    $error = "Hay que estar registrado para poder ver la página a la que intentas acceder.";
    header("Location: index.php?noLog=$error&active=novedad");
}

include "ModelNovedad.php";


if(isset( $_SESSION['tut'])) {
    
   $id = $_SESSION['tut'];

    $consult = acceptTut($id);
    
    if ($consult != null) {
        $message = "Se ha admitido el tutorial correctamente.";
        header("Location: moderar.php?tutOk=$message&active=admin");
    } else {
        $message = "No se ha podido aceptar el tutorial.";
        header("Location: moderar.php?tutFail=$message&active=admin");
    }
    
} else {
        $message = "No se ha pasado un tutorial.";
        header("Location: moderar.php?tutFail=$message&active=admin");
    }
ob_end_flush();
?>