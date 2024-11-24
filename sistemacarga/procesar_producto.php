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

    // Validar datos del formulario
    $categoria = $_POST['categoria'];
    $nombre_producto = $_POST['nombre_producto'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Manejar la subida de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_imagen = basename($_FILES['imagen']['name']);
        $ruta_destino = "imagenes/" . $nombre_imagen;

        // Crear carpeta "imagenes" si no existe
        if (!file_exists("imagenes")) {
            mkdir("imagenes", 0777, true);
        }

        // Mover la imagen a la carpeta "imagenes"
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
            // Insertar producto en la base de datos con la ruta de la imagen
            $sql = "INSERT INTO productos (CATEGORIA, NOMBRE_PRODUCTO, DETALLE, PRECIO, STOCK, IMAGEN) 
                    VALUES (:categoria, :nombre_producto, :detalle, :precio, :stock, :imagen)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':categoria' => $categoria,
                ':nombre_producto' => $nombre_producto,
                ':detalle' => $detalle,
                ':precio' => $precio,
                ':stock' => $stock,
                ':imagen' => $ruta_destino
            ]);
        } else {
            // Si ocurre un error al mover la imagen, redirigir con mensaje de error
            header("Location: administrador.php?mensaje=error_imagen");
            exit;
        }
    } else {
        // Si no se recibe una imagen válida, redirigir con mensaje de error
        header("Location: administrador.php?mensaje=imagen_invalida");
        exit;
    }
} catch (PDOException $e) {
    // Si ocurre un error en la conexión o consulta, redirigir con mensaje de error
    header("Location: administrador.php?mensaje=error_bd&detalle=" . urlencode($e->getMessage()));
    exit;
}

// Redirigir a administrador.php después de agregar el producto exitosamente
header("Location: administrador.php?mensaje=exito");
exit;
?>
