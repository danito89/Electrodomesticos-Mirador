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
        <h1>Electrodomesticos Mirador</h1>
        <nav>
            <ul>
                <li><a href="../index.html">Inicio</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Carrito Section -->
        <section id="carrito">
            <h2>Carrito de Compras</h2>
            <!-- Integración del código PHP -->
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

<!-- Carrito dinámico -->
<div id="contenido-carrito">
    <ul id="lista-carrito">
        <!-- Los productos del carrito se agregarán aquí dinámicamente -->
    </ul>
    <p id="mensaje-vacio" style="display: none;">Tu carrito está vacío</p> <!-- Mensaje de carrito vacío -->
    <?php
    // Detectar el nombre del archivo actual
    $currentPage = basename($_SERVER['PHP_SELF']);
    // Mostrar el botón solo si no estás en 'carritodecompra.php'
    if ($currentPage !== 'carritodecompra.php') {
        echo '<button id="continuar-compra">Continuar Compra</button>';
    }
    ?>
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
                    <input type="radio" name="pago" value="MercadoPago" id="MercadoPago"> Mercado Pago<br>
                    <input type="radio" name="pago" value="transferencia" id="transferencia"> Transferencia bancaria<br><br>
                    <input type="submit" value="Realizar pago">
                </form>';
            ?>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Electrodomesticos Mirador. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts -->
    <script>
        // Recuperar el carrito del sessionStorage
        const carrito = JSON.parse(sessionStorage.getItem('carrito')) || []; // Si no hay carrito, devuelve un array vacío

        // Función para mostrar los productos en el carrito
        function mostrarCarrito() {
            const listaCarrito = document.getElementById('lista-carrito'); // Lista dinámica
            const mensajeVacio = document.getElementById('mensaje-vacio'); // Mensaje de carrito vacío

            // Limpiar la lista antes de agregar los productos
            listaCarrito.innerHTML = '';

            if (carrito.length === 0) {
                mensajeVacio.style.display = 'block'; // Muestra mensaje vacío si no hay productos
            } else {
                mensajeVacio.style.display = 'none'; // Oculta el mensaje vacío si hay productos
                // Agregar cada producto a la lista
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

        // Llamar a la función para mostrar los productos cuando la página se carga
        mostrarCarrito();

        // Evento para el botón de "Continuar Compra"
        document.getElementById('continuar-compra').addEventListener('click', () => {
            window.location.href = './php/carritodecompra.php'; // Redirige a la página de carrito de compra
        });
    </script>
</body>
</html>
