// Manejador para el cambio de categorías
document.getElementById('categorias').addEventListener('change', function() {
    const selectedValue = this.value; // Obtiene el valor de la opción seleccionada

    // Selecciona todas las secciones de categorías dentro de main, excluyendo el slider-box
    const sections = document.querySelectorAll('main > section:not(#slider-box)');
    sections.forEach(section => section.classList.add('hidden')); // Oculta todas las secciones excepto el slider

    if (selectedValue === 'categorias') {
        document.getElementById('productos').classList.remove('hidden'); // Muestra la sección de productos destacados
    } else {
        const selectedSection = document.getElementById(selectedValue);
        if (selectedSection) {
            selectedSection.classList.remove('hidden');
            cargarProductosPorCategoria(selectedValue); // Carga productos de la categoría seleccionada
        }
    }
});

// Función para cargar productos desde "productos.php"
async function cargarProductos() {
    try {
        const response = await fetch('php/productos.php');
        const productos = await response.json();
        console.log("Productos cargados desde productos.php:", productos); // Verificar en la consola
        return productos;
    } catch (error) {
        console.error("Error al cargar los productos:", error);
    }
}

// Función para mostrar productos en la sección de "Productos Destacados"
async function mostrarProductosDestacados() {
    const productos = await cargarProductos();
    const productosAleatorios = productos.sort(() => 0.5 - Math.random()).slice(0, 5);
    const tbody = document.querySelector('#productos tbody');
    tbody.innerHTML = '';
    productosAleatorios.forEach(producto => {
        // Formato del precio
        const precioFormateado = `$ ${parseFloat(producto.PRECIO).toFixed(2).replace('.', ',')}`;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td><img src="${producto.IMAGEN}" alt="${producto.NOMBRE_PRODUCTO}" class="img-fluid"></td>
            <td>${producto.NOMBRE_PRODUCTO}</td>
            <td>${precioFormateado}</td>
            <td><button class="btn btn-primary add-to-cart">Añadir al Carrito</button></td>
        `;
        tbody.appendChild(row);
    });

    agregarEventosCarrito(); // Para asegurar que se asignen eventos a los botones
}

// Función para cargar y mostrar productos por categoría
async function cargarProductosPorCategoria(categoria) {
    const productos = await cargarProductos();
    const productosFiltrados = productos.filter(producto => producto.CATEGORIA === categoria);
    
    console.log("Productos filtrados:", productosFiltrados); // Línea de depuración
    const tbody = document.querySelector(`#${categoria} tbody`);
    
    if (!productosFiltrados.length) {
        console.warn(`No se encontraron productos para la categoría: ${categoria}`);
    }

    tbody.innerHTML = '';
    productosFiltrados.forEach(producto => {
        // Formato del precio
        const precioFormateado = `$ ${parseFloat(producto.PRECIO).toFixed(2).replace('.', ',')}`;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td><img src="${producto.IMAGEN}" alt="${producto.NOMBRE_PRODUCTO}" class="img-fluid"></td>
            <td>${producto.NOMBRE_PRODUCTO}</td>
            <td>${precioFormateado}</td>
            <td><button class="btn btn-primary add-to-cart">Añadir al Carrito</button></td>
        `;
        tbody.appendChild(row);
    });

    agregarEventosCarrito(); // Aseguramos que se asignen eventos a los botones
}

// Funcionalidad del carrito
const carrito = []; // Array para almacenar los productos en el carrito

function agregarEventosCarrito() {
    const botonesCarrito = document.querySelectorAll('.add-to-cart');

    console.log("Botones disponibles:", botonesCarrito); // Verifica si los botones existen

    botonesCarrito.forEach(boton => {
        boton.addEventListener('click', (e) => {
            console.log("Botón clic detectado"); // Depura si el clic en el botón funciona
            const producto = e.target.closest('tr'); // Encuentra la fila del producto
            const nombre = producto.querySelector('td:nth-child(2)').innerText;
            const precio = producto.querySelector('td:nth-child(3)').innerText;
            const imagen = producto.querySelector('td:nth-child(1) img').src;

            console.log("Producto seleccionado:", { nombre, precio, imagen }); // Depuración: verifica datos del producto
            agregarProductoAlCarrito({ nombre, precio, imagen });
        });
    });
}

function agregarProductoAlCarrito(producto) {
    const productoExistente = carrito.find(item => item.nombre === producto.nombre);

    if (productoExistente) {
        productoExistente.cantidad += 1;
    } else {
        carrito.push({ ...producto, cantidad: 1 });
    }
    
    console.log("Producto añadido al carrito:", producto);
    console.log("Carrito ahora:", carrito);
    
    // Guardar carrito en la sesión
    sessionStorage.setItem('carrito', JSON.stringify(carrito)); // Hecho por ChatGPT: Guardamos el carrito en sessionStorage

    // Ahora enviamos el carrito al servidor con AJAX
    enviarCarritoAServidor(carrito); // Hecho por ChatGPT: Llamada AJAX para enviar el carrito al servidor

    actualizarCarrito(); // Aseguramos que se actualice el carrito
}

// Enviar carrito al servidor usando AJAX
function enviarCarritoAServidor(carrito) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "guardar_carrito.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.send(JSON.stringify({ carrito: carrito })); // Hecho por ChatGPT: Enviamos el carrito al servidor
}

function actualizarCarrito() {
    const contenidoCarrito = document.getElementById('contenido-carrito');
    const listaCarrito = document.getElementById('lista-carrito');
    const mensajeVacio = document.getElementById('mensaje-vacio');

    // Limpiar solo la lista de productos
    listaCarrito.innerHTML = '';

    console.log("Carrito actual:", carrito);

    if (carrito.length === 0) {
        // Si el carrito está vacío, mostrar el mensaje y ocultar la lista
        mensajeVacio.style.display = 'block';
    } else {
        // Si el carrito tiene productos, ocultar el mensaje vacío y mostrar la lista
        mensajeVacio.style.display = 'none';
        carrito.forEach(item => {
            const li = document.createElement('li');
            li.innerHTML = `
                <img src="${item.IMAGEN}" alt="${item.nombre}" style="width: 50px; height: 50px;">
                ${item.nombre} - ${item.precio} (x${item.cantidad})
            `;
            listaCarrito.appendChild(li);
        });
    }

    // Asegurarse de que el botón "Continuar compra" siga estando al final
    const botonContinuar = document.getElementById('continuar-compra');
    if (!contenidoCarrito.contains(botonContinuar)) {
        contenidoCarrito.appendChild(botonContinuar); // Hecho por ChatGPT: Reagregar el botón si es necesario
    }
}

document.getElementById('continuar-compra').addEventListener('click', () => {
    window.location.href = './php/carritodecompra.php'; // Hecho por ChatGPT: Redirige a la página de carrito de compra
});


// SLIDER - Lógica del slider y de sus botones de navegación
const imagenesProductos = [
    "images/ofertas/00.png",
    "images/ofertas/01.png",
    "images/ofertas/02.png",
    "images/ofertas/03.png",
    "images/ofertas/04.png",
];

let imagenActual = 0;

function mostrarSliderAleatorio() {
    const sliderBox = document.querySelector('#slider-box ul');
    sliderBox.innerHTML = '';
    const imagenesAleatorias = obtenerImagenesAleatorias(5);
    imagenesAleatorias.forEach(imagen => {
        const li = document.createElement('li');
        li.innerHTML = `<img src="${imagen}" alt="Imagen aleatoria">`;
        sliderBox.appendChild(li);
    });
    imagenActual = 0;
    sliderBox.style.marginLeft = '0';
}

function moverAdelante() {
    const sliderBox = document.querySelector('#slider-box ul');
    imagenActual = (imagenActual + 1) % 5;
    sliderBox.style.marginLeft = `-${imagenActual * 750}px`;
}

function moverAtras() {
    const sliderBox = document.querySelector('#slider-box ul');
    imagenActual = (imagenActual - 1 + 5) % 5;
    sliderBox.style.marginLeft = `-${imagenActual * 750}px`;
}

document.addEventListener('DOMContentLoaded', () => {
    mostrarSliderAleatorio();
    const botonAdelante = document.querySelector('#next');
    const botonAtras = document.querySelector('#prev');
    botonAdelante.addEventListener('click', moverAdelante);
    botonAtras.addEventListener('click', moverAtras);
    setInterval(moverAdelante, 3000);
});

// Función para obtener imágenes aleatorias para el slider
function obtenerImagenesAleatorias(cantidad) {
    const imagenesSeleccionadas = [];
    const imagenesCopy = [...imagenesProductos]; // Copia de la lista original

    while (imagenesSeleccionadas.length < cantidad && imagenesCopy.length > 0) {
        const indexAleatorio = Math.floor(Math.random() * imagenesCopy.length);
        imagenesSeleccionadas.push(imagenesCopy.splice(indexAleatorio, 1)[0]);
    }
    return imagenesSeleccionadas;
}

// Ejecuta mostrarProductosDestacados cuando la página carga
document.addEventListener('DOMContentLoaded', mostrarProductosDestacados);
