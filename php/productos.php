<?php
include 'conexion.php';

try {
    // Consulta para obtener todos los productos
    $query = $pdo->query("SELECT * FROM productos");
    $productos = $query->fetchAll(PDO::FETCH_ASSOC);

    // Convertir el resultado en JSON y devolverlo
    header('Content-Type: application/json');
    echo json_encode($productos);

} catch (Exception $e) {
    // Manejo de errores en caso de fallo en la consulta
    echo json_encode(["error" => "Error al obtener los productos: " . $e->getMessage()]);
}

/* lo siguiente no serviria
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Detalle</th>
            <th>Precio</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo $producto['IDPRODUCTO']; ?></td>
            <td><?php echo $producto['NOMBRE_PRODUCTO']; ?></td>
            <td><?php echo $producto['DETALLE']; ?></td>
            <td><?php echo number_format($producto['PRECIO'], 2, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
*/
?>
