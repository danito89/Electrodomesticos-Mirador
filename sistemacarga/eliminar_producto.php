<?php
// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto si usas un usuario diferente
$password = ""; // Cambia esto si tienes una contraseña
$base_datos = "bdd_elecmir";

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    try {
        // Crear conexión con PDO
        $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos", $usuario, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener la imagen asociada al producto (si existe)
        $sql_imagen = "SELECT IMAGEN FROM productos WHERE IDPRODUCTO = :id";
        $stmt_imagen = $conexion->prepare($sql_imagen);
        $stmt_imagen->execute([':id' => $id_producto]);
        $producto = $stmt_imagen->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            // Eliminar la imagen del servidor si existe
            if (!empty($producto['IMAGEN']) && file_exists($producto['IMAGEN'])) {
                unlink($producto['IMAGEN']);
            }

            // Eliminar el producto de la base de datos
            $sql = "DELETE FROM productos WHERE IDPRODUCTO = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':id' => $id_producto]);

            // Redirigir con mensaje de éxito
            header("Location: administrador.php?mensaje=producto_eliminado");
            exit;
        } else {
            // Redirigir con mensaje de error: Producto no encontrado
            header("Location: administrador.php?mensaje=producto_no_encontrado");
            exit;
        }
    } catch (PDOException $e) {
        // Redirigir con mensaje de error en la consulta
        header("Location: administrador.php?mensaje=error_bd&detalle=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // Redirigir con mensaje de error: ID no especificado
    header("Location: administrador.php?mensaje=id_no_especificado");
    exit;
}
?>
