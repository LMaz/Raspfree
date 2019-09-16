<?php
session_start();
ob_start();
?>

<?php
   
   include "ModelUser.php";
    $userName = isset($_POST['name']) ? htmlspecialchars(trim(strip_tags($_POST['name']))):null;
    $password = isset($_POST['pass']) ? htmlspecialchars(trim(strip_tags($_POST['pass']))):null;
   
if ($userName != null && $password != null ) {
    if (existeUsuario($userName)) {   //si el usuario existe  


        if (checkPassword($userName, $password)) { //comprobar que la clave es valida
           $_SESSION['loggedin'] = true;
           $_SESSION['username'] = $_POST['name'];
           $datos = datosUser($_POST['name']);
           $_SESSION['edad']= $datos->age;
           $_SESSION['mail']= $datos->mail;
           $_SESSION['body']= $datos->body;
           $_SESSION['start'] = time();
           $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);      
           $_SESSION['admin'] = checkAdmin($userName);
           $_SESSION['image'] = $datos->image;
           header('Location: http://raspfree.com/index.php');
           

        } else { 
            $message = "La contraseña es incorrecta.";
            header("Location: index.php?login=$message");
            
        }
    }else{
        $message = "El usuario no existe";
        header("Location: index.php?login=$message");

    }
}
 ob_end_flush();
 ?>
