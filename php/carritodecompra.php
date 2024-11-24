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

<!-- Aquí empieza la sección del carrito que se carga dinámicamente -->
<div id="contenido-carrito">
    <ul id="lista-carrito">
        <!-- Los productos del carrito se agregarán aquí dinámicamente -->
    </ul>
    <p id="mensaje-vacio" style="display: none;">Tu carrito está vacío</p>
    <button id="continuar-compra">Continuar Compra</button>
</div>

<?php
// Mostrar opciones de pago
echo '<h3>Opciones de Pago</h3>';
echo '<form action="procesar_pago.php" method="POST">
        <label for="pago">Elige un método de pago:</label><br>
        <input type="radio" name="pago" value="tarjeta" id="tarjeta"> Tarjeta de crédito<br>
        <input type="radio" name="pago" value="paypal" id="paypal"> PayPal<br>
        <input type="radio" name="pago" value="transferencia" id="transferencia"> Transferencia bancaria<br><br>
        <input type="submit" value="Realizar pago">
    </form>';
?>

<script>
    // Recuperar el carrito del sessionStorage
    const carrito = JSON.parse(sessionStorage.getItem('carrito')) || []; // Si no hay carrito, devuelve un array vacío

    // Función para mostrar los productos en el carrito
    function mostrarCarrito() {
        const listaCarrito = document.getElementById('lista-carrito'); // 
        const mensajeVacio = document.getElementById('mensaje-vacio'); // 

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
