<?php
session_start();
ob_start();

include "ModelUser.php";

$userName = isset($_POST['userName']) ? htmlspecialchars(trim(strip_tags($_POST['userName']))):null; 
$password1 = isset($_POST['pass1']) ? htmlspecialchars(trim(strip_tags($_POST['pass1']))):null;        
$password2 = isset($_POST['pass2']) ? htmlspecialchars(trim(strip_tags($_POST['pass2']))):null;        
$mail =isset($_POST['email']) ? htmlspecialchars(trim(strip_tags($_POST['email']))):null;       
$age = isset($_POST['age']) ? htmlspecialchars(trim(strip_tags($_POST['age']))):null;        
$body = isset($_POST['body']) ? htmlspecialchars(trim(strip_tags($_POST['body']))):null;        
$admin = 'false';


// Comprobamos que se han introducido todos los datos.
if(!empty($_FILES['imagen']['name']) && $userName != null && $password1 != null && $password2 != null && $mail != null
        && $age != null && $body != null){
    if ($_POST['pass1'] != $_POST['pass2']) {
           $message = "Las contraseñas no coinciden.";
           header("Location: index.php?register=$message");
    } else if (existeUsuario($userName)) {
         $message = "El usuario ya existe.";
        header("Location: index.php?register=$message");
    } else {          
        
            // Generamos el archivo temporal de la imagen subida.
            $binario_nombre_temporal = $_FILES['imagen']['tmp_name'] ;

            // Leemos la imagen (archivo binario).
            $binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

            // Obtener del array FILES los datos del binario .. nombre, tamaño y tipo.
            $binario_nombre = $_FILES['imagen']['name'];
            $binario_peso = $_FILES['imagen']['size'];
            $binario_tipo = $_FILES['imagen']['type'];

            // Comprobamos el tamaño de la imagen.
            if ($binario_peso < 600000) {

                if ($binario_tipo == 'image/jpeg') {
                    // Insertamos los datos en la BD.
                    $author = $userName;
                    $date = date("Y-m-d H:i:s");

                    insertarUser($userName, $password1, $age, $mail, $body, $binario_contenido, $admin);
                    $message = "Registro correcto!";
                    header("Location: /index.php?registerOK=$message");

                } else {
                        $message = "La imagen debe ser .jpg.";
                       header("Location: index.php?register=$message");
                }

            } else {
                    $message = "La imagen es demasiado grande.";
                   header("Location: index.php?register=$message");
            }       

    }
}  else {
           $message = "Hay que introducir todos los datos.";
          header("Location: index.php?register=$message");
        }
ob_end_flush();
?>
