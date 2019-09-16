<?php
sleep(1);
include('DBfunctions.php');
if($_REQUEST) {
    $conexion = conecta();
    $username = $_REQUEST['userName'];
    $query = "SELECT * FROM users WHERE userName = '$username'";
    $result = mysqli_query($conexion, $query) or die('ok');

    if(mysqli_num_rows($result) > 0)
        echo '<div id="Error" class="ajaxExiste">Usuario ya existente :(</div>';
    else
        echo '<div id="Success" class="ajaxDisponible">Disponible!</div>';
     mysqli_close($conexion);
}
?>
