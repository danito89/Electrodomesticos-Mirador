<?php
// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto si usas un usuario diferente
$password = ""; // Cambia esto si tienes una contraseña
$base_datos = "bdd_elecmir";

try {
    // Crear conexión con PDO
    $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los productos
    $sql = "SELECT * FROM productos";
    $resultado = $conexion->query($sql);

    // Mostrar los productos en la tabla
    if ($resultado->rowCount() > 0) {
        foreach ($resultado as $producto) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($producto['IDPRODUCTO']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['CATEGORIA']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['NOMBRE_PRODUCTO']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['DETALLE']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['PRECIO']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['STOCK']) . "</td>";

            // Mostrar imagen desde la ruta almacenada
            echo "<td>";
            if (!empty($producto['IMAGEN'])) {
                // Mostrar la ruta de la imagen
                echo htmlspecialchars($producto['IMAGEN']);
            } else {
                echo "Sin Ruta";
            }
            echo "</td>";
                                    
            echo "<td><a href='editar_producto.php?id=" . urlencode($producto['IDPRODUCTO']) . "'>Editar</a></td>";
            echo "<td><a href='eliminar_producto.php?id=" . urlencode($producto['IDPRODUCTO']) . "'>Eliminar</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No hay productos registrados</td></tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='9'>Error en la conexión o consulta: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    exit;
}
?>
