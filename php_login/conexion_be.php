<?php

    $conexion = mysqli_connect("localhost", "root", "", "login_register_db");

     if($conexion){
         echo "conectado exitosamente a la base de datos";

    } else {
        echo " no se pudo conectar a la base de datos";
     }

?>