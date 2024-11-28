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

            <div id="contenido-carrito">
                <ul id="lista-carrito">
                    <!-- Los productos del carrito se agregarán aquí dinámicamente -->
                </ul>
                <button id="continuar-compra">Continuar Compra</button>
            </div>
        </section>

        <!-- Opciones de Pago Section -->
        <section id="opciones-pago">
            <h3>Opciones de Pago</h3>
            <?php
            // Formulario generado dinámicamente con PHP
            echo '<form action="procesar_pago.php" method="POST">
                    <label for="pago">Elige un método de pago:</label><br>
                    <input type="radio" name="pago" value="tarjeta" id="tarjeta"> Tarjeta de crédito<br>
                    <input type="radio" name="pago" value="paypal" id="paypal"> PayPal<br>
                    <input type="radio" name="pago" value="transferencia" id="transferencia"> Transferencia bancaria<br><br>
                    <input type="submit" value="Realizar pago">
                </form>';
            ?>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Tu Tienda en Línea. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts -->
    <script>
        // Recuperar el carrito del sessionStorage
        const carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];

        // Mostrar productos del carrito dinámicamente
        function mostrarCarrito() {
            const listaCarrito = document.getElementById('lista-carrito');
            const mensajeVacio = document.getElementById('mensaje-vacio');

            listaCarrito.innerHTML = '';

            if (carrito.length === 0) {
                mensajeVacio.style.display = 'block';
            } else {
                mensajeVacio.style.display = 'none';
                carrito.forEach(item => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <img src="${item.imagen}" alt="${item.nombre}" style="width: 50px; height: 50px;">
                        ${item.nombre} - ${item.precio} (x${item.cantidad})
                    `;
                    listaCarrito.appendChild(li);
                });
            }
        }

        // Llamar a la función al cargar la página
        mostrarCarrito();

        // Redirección al continuar compra
        document.getElementById('continuar-compra').addEventListener('click', () => {
            window.location.href = './php/carritodecompra.php';
        });
    </script>
</body>
</html>

