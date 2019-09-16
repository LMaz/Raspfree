<?php

 //numero de tutoriales para moderar
    function numModerar(){        
        $conexion = conecta();
        $sql = "SELECT * FROM tutorials WHERE moderated = 'FALSE'";
        $consulta = mysqli_query($conexion,$sql);
        $num = mysqli_num_rows($consulta);
        mysqli_close($conexion);              
        
        return $num;
    }

?>