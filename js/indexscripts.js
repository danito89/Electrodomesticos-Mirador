// Manejador para el cambio de categorías
document.getElementById('categorias').addEventListener('change', function() {
    const selectedValue = this.value; // Obtiene el valor de la opción seleccionada

    // Selecciona todas las secciones de categorías dentro de main, excluyendo el slider-box
    const sections = document.querySelectorAll('main > section:not(#slider-box)'); 
    sections.forEach(section => section.classList.add('hidden')); // Oculta todas las secciones excepto el slider-box

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
        console.log("Productos cargados:", productos); // Verificar en la consola
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
        // Formatear el precio
        const precioFormateado = `$ ${parseFloat(producto.PRECIO).toFixed(2).replace('.', ',')}`;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td><img src="${producto.imagen}" alt="${producto.NOMBRE_PRODUCTO}" class="img-fluid"></td>
            <td>${producto.NOMBRE_PRODUCTO}</td>
            <td>${precioFormateado}</td>
            <td><button class="btn btn-primary">Añadir al Carrito</button></td>
        `;
        tbody.appendChild(row);
    });
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
    console.log("Categoria:", categoria);
    console.log("Tbody seleccionado:", tbody);

    tbody.innerHTML = '';
    productosFiltrados.forEach(producto => {
        // Formatear el precio
        const precioFormateado = `$ ${parseFloat(producto.PRECIO).toFixed(2).replace('.', ',')}`;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td><img src="${producto.imagen}" alt="${producto.NOMBRE_PRODUCTO}" class="img-fluid"></td>
            <td>${producto.NOMBRE_PRODUCTO}</td>
            <td>${precioFormateado}</td>
            <td><button class="btn btn-primary">Añadir al Carrito</button></td>
        `;
        tbody.appendChild(row);
    });
}


// Ejecuta mostrarProductosDestacados cuando la página carga
document.addEventListener('DOMContentLoaded', mostrarProductosDestacados);

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
