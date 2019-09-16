<?php

include "DBfunctions.php";

function existeUsuario($usuario) {

    $conexion = conecta();
    $result = mysqli_query($conexion, "SELECT * FROM users WHERE userName = '" . $usuario . "'") or die(mysql_error());

    if (mysqli_num_rows($result) == 0) {//el usuario no existe
        $check = false;
    } else {
        $check = true;
    }
    mysqli_close($conexion);
    return $check;
}

function checkPassword($userName, $password) {
    $conexion = conecta();

    $result = mysqli_query($conexion, "SELECT password FROM users WHERE userName = '$userName'") or die(mysqli_error());
    $row = mysqli_fetch_object($result);
    $hashPass = hash('sha512', $password);
    if ($hashPass == $row->password) {
        $check = true;
    } else {
        $check = false;
    }

    mysqli_close($conexion);
    return $check;
}

function insertarUser($userName, $password, $age, $mail, $body, $image, $admin) {
    $conexion = conecta();
    $hashPass = hash('sha512', $password);
    
    // prepare and bind
    $stmt = $conexion->prepare("INSERT INTO users (userName, password, age, mail, body,  admin) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $userName, $hashPass, $age, $mail, $body, $admin);    
    $stmt->execute();
   
    mysqli_query($conexion, "UPDATE users SET image='$image' WHERE userName='$userName'")or die(mysqli_error());
   
    mysqli_close($conexion);
}

function checkAdmin($user) {
    $conexion = conecta();
    $result = mysqli_query($conexion, "SELECT admin FROM users WHERE userName = '$user'") or die(mysqli_error());
    $row = mysqli_fetch_object($result);

    if ($row->admin == true) {
        $check = true;
    } else {
        $check = false;
    }

    mysqli_close($conexion);
    return $check;
}


function datosUser($usuario) {
    $conexion = conecta();

    $result = mysqli_query($conexion, "SELECT * FROM users WHERE userName = '$usuario'") or die(mysqli_error());
    $row = mysqli_fetch_object($result);
    mysqli_close($conexion);
    return $row;
}
?>

