<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pago = $_POST['pago']; // Obtener el método de pago

    // añadir la lógica para procesar el pago con el método seleccionado.
    // Por ejemplo,  redirigir a MercadoPago, procesar la tarjeta, o confirmar una transferencia.

    echo "Has elegido pagar con $pago";
}
?>
