<?php
// Mostrar mensajes si existen en la URL
if (isset($_GET['mensaje'])) {
    echo '<div class="mensaje">';
    switch ($_GET['mensaje']) {
        case 'exito':
            echo "<p class='mensaje-exito'>Producto agregado exitosamente.</p>";
            break;
        case 'error_imagen':
            echo "<p class='mensaje-error'>Error al mover la imagen al servidor.</p>";
            break;
        case 'imagen_invalida':
            echo "<p class='mensaje-error'>No se recibió una imagen válida.</p>";
            break;
        case 'error_bd':
            echo "<p class='mensaje-error'>Error en la conexión o consulta con la base de datos.</p>";
            break;
        default:
            echo "<p class='mensaje-desconocido'>Mensaje desconocido.</p>";
            break;
    }
    echo '</div>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../css/administrador.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Productos</title>
</head>
<body>
    <div class="contenedor">
        <h1>Administrar Productos</h1>

        <!-- Formulario para agregar productos -->
        <section>
            <h2>Agregar Producto</h2>
            <form action="procesar_producto.php" method="POST" enctype="multipart/form-data">
                <label for="categoria">Categoría:</label><br>
                <select id="categoria" name="categoria" required>
                    <?php
                    // Cargar categorías desde la base de datos
                    $servidor = "localhost";
                    $usuario = "root";
                    $password = "";
                    $base_datos = "bdd_elecmir";

                    try {
                        $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos", $usuario, $password);
                        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT DISTINCT CATEGORIA FROM productos";
                        $resultado = $conexion->query($sql);

                        if ($resultado->rowCount() > 0) {
                            foreach ($resultado as $categoria) {
                                echo "<option value='" . htmlspecialchars($categoria['CATEGORIA']) . "'>" . htmlspecialchars($categoria['CATEGORIA']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay categorías disponibles</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Error: No se pudieron cargar las categorías.</option>";
                    }
                    ?>
                </select><br><br>

                <label for="nombre_producto">Nombre del Producto:</label><br>
                <input type="text" id="nombre_producto" name="nombre_producto" minlength="3" required><br><br>

                <label for="detalle">Detalle:</label><br>
                <textarea id="detalle" name="detalle" minlength="10" required></textarea><br><br>

                <label for="precio">Precio:</label><br>
                <input type="number" id="precio" name="precio" step="0.01" min="0.01" required><br><br>

                <label for="stock">Stock:</label><br>
                <input type="number" id="stock" name="stock" min="1" required><br><br>

                <label for="imagen">Imagen del Producto:</label><br>
                <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>

                <button type="submit">Guardar Producto</button>
            </form>
        </section>

        <!-- Listado de productos -->
        <section>
            <h2>Productos Existentes</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoría</th>
                            <th>Nombre</th>
                            <th>Detalle</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Editar</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'listar_productos.php'; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>
