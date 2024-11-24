<?php
// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto si usas un usuario diferente
$password = "";
$base_datos = "bdd_elecmir";

if (!isset($_GET['id'])) {
    // Redirigir si no se especificó un ID
    header("Location: administrador.php?mensaje=id_no_especificado");
    exit;
}

$id_producto = $_GET['id'];

try {
    // Crear conexión con PDO
    $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener datos del producto
    $sql = "SELECT * FROM productos WHERE IDPRODUCTO = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':id' => $id_producto]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        // Redirigir si no se encuentra el producto
        header("Location: administrador.php?mensaje=producto_no_encontrado");
        exit;
    }
} catch (PDOException $e) {
    // Redirigir si hay un error en la conexión o consulta
    header("Location: administrador.php?mensaje=error_bd&detalle=" . urlencode($e->getMessage()));
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="actualizar_producto.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['IDPRODUCTO']); ?>">

        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($producto['CATEGORIA']); ?>" required><br><br>

        <label for="nombre_producto">Nombre del Producto:</label><br>
        <input type="text" id="nombre_producto" name="nombre_producto" value="<?php echo htmlspecialchars($producto['NOMBRE_PRODUCTO']); ?>" required><br><br>

        <label for="detalle">Detalle:</label><br>
        <textarea id="detalle" name="detalle"><?php echo htmlspecialchars($producto['DETALLE']); ?></textarea><br><br>

        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['PRECIO']); ?>" step="0.01" required><br><br>

        <label for="stock">Stock:</label><br>
        <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($producto['STOCK']); ?>" required><br><br>

        <label for="imagen">Imagen del Producto:</label><br>
        <input type="file" id="imagen" name="imagen" accept="image/*"><br>
        <p>Imagen actual: <?php echo htmlspecialchars($producto['IMAGEN']); ?></p><br>

        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>
