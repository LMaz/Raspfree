<?php

function conecta() {
    $db_host = "db683769016.db.1and1.com";
    $db_user = "dbo683769016";
    $db_password = "3sTr4T0sf3r4.";
    $db_name = "db683769016";

    $db_connect = mysqli_connect($db_host, $db_user, $db_password, $db_name)or die(mysql_error());
    if (!$db_connect) {
        die('No se ha podido conectar a la base de datos');
    }
    return $db_connect;
}

?>
