<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../CSS/carritostyles.css"> <!-- Enlace al archivo CSS -->
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Tu Tienda en Línea</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="carrito.php">Carrito</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Carrito Section -->
        <section id="carrito">
            <h2>Carrito de Compras</h2>
            <?php
            session_start();  // Iniciar la sesión

            // Recuperar los productos del carrito desde la sesión
            $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

            // Mostrar los productos en el carrito
            if (empty($carrito)) {
                echo "<p>Tu carrito está vacío.</p>";
            } else {
                echo "<h2>Productos en tu carrito</h2>";
                echo "<table>";
                echo "<tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr>";

                $total = 0;
                foreach ($carrito as $producto) {
                    $total += $producto['precio'] * $producto['cantidad'];
                    echo "<tr>
                            <td>{$producto['nombre']}</td>
                            <td>{$producto['precio']}</td>
                            <td>{$producto['cantidad']}</td>
                            <td>" . $producto['precio'] * $producto['cantidad'] . "</td>
                          </tr>";
                }
                echo "</table>";
                echo "<p>Total: $total</p>";
            }
            ?>
        </section>

        <!-- Opciones de Pago Section -->
        <section id="opciones-pago">
            <h3>Opciones de Pago</h3>
            <form id="form-pago">
                <label for="pago">Elige un método de pago:</label><br>
                <input type="radio" name="pago" value="Tarjeta de crédito" id="tarjeta"> Tarjeta de crédito<br>
                <input type="radio" name="pago" value="PayPal" id="paypal"> PayPal<br>
                <input type="radio" name="pago" value="Transferencia bancaria" id="transferencia"> Transferencia bancaria<br><br>
                <button type="button" id="btn-pago">Realizar Pago</button>
            </form>
            <p id="mensaje-pago" style="display: none; color: green; font-weight: bold;"></p>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Tu Tienda en Línea. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts -->
    <script>
        // Capturar el botón y los inputs del formulario
        const botonPago = document.getElementById('btn-pago');
        const opcionesPago = document.getElementsByName('pago');

        // Agregar evento al botón de pago
        botonPago.addEventListener('click', () => {
            let seleccion = '';

            // Verificar cuál opción está seleccionada
            opcionesPago.forEach(opcion => {
                if (opcion.checked) {
                    seleccion = opcion.value; // Obtener el valor de la opción seleccionada
                }
            });

            if (seleccion) {
                // Mostrar mensaje con la opción seleccionada
                alert(`Usted seleccionó: ${seleccion}`);
            } else {
                // Mostrar alerta si no se seleccionó ninguna opción
                alert('Por favor, seleccione un método de pago.');
            }
        });
    </script>
</body>
</html>


