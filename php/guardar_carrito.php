<?php
session_start();  // Iniciar la sesión

// Obtener el carrito enviado desde JavaScript
$data = json_decode(file_get_contents("php://input"), true);

// Almacenar el carrito en la sesión
if (isset($data['carrito'])) {
    $_SESSION['carrito'] = $data['carrito'];
    echo json_encode(["status" => "success", "message" => "Carrito guardado en la sesión"]);
} else {
    echo json_encode(["status" => "error", "message" => "No se ha enviado el carrito"]);
}
?>
