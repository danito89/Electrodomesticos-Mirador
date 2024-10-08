<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = ($_POST['nombre']);
    $apellido = ($_POST['apellido']);
    $email = ($_POST['email']);
    $producto = ($_POST['producto']);
    $fecha_compra = ($_POST['fecha_compra']);
    $satisfaccion = ($_POST['satisfaccion']);
    $medio = ($_POST['medio']);
    $otro_medio = isset($_POST['otro_medio']) ? $_POST['otro_medio'] : "No especificado";
    $suscribirse = ($_POST['suscribirse']);
    


    // Resultado de la encuesta
    echo "<h2>Resultado de la Encuesta</h2>";
    echo "Se ha enviado la siguiente información: <br><br>";
    echo "Nombre: $nombre <br>";
    echo "Apellido: $apellido <br>";
    echo "Email: $email <br>";
    echo "Producto adquirido: $producto <br>";
    echo "Fecha de compra: $fecha_compra <br>";
    echo "Satisfacción: $satisfaccion <br>";
    echo "Medio de contacto: $medio <br>";
    echo "Otro medio: $otro_medio <br>";
    echo "Suscripción a boletín: $suscribirse <br>";
}
?>