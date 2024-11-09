<?php
include 'conexion.php';

$query = $pdo->query("SELECT * FROM productos"); //
$productos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

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
