// Manejador para el cambio de categorías
document.getElementById('categorias').addEventListener('change', function() {
    const selectedValue = this.value; // Obtiene el valor de la opción seleccionada
    const sections = document.querySelectorAll('main > section'); // Selecciona todas las secciones de categorías
    sections.forEach(section => section.classList.add('hidden')); // Oculta todas las secciones
    if (selectedValue === 'categorias') {
        document.getElementById('productos').classList.remove('hidden'); // Muestra la sección de productos destacados
    } else {
        const selectedSection = document.getElementById(selectedValue); // Muestra la sección correspondiente a la categoría
        if (selectedSection) {
            selectedSection.classList.remove('hidden');
        }
    }
});

// Lista de productos disponibles (esto es para que aleatoriamente se muestren al actualizar index)
const productosDisponibles = [
    // CELULARES
    { nombre: 'Celular Xiaomi Redmi 13C 6.74" 128GB Negro', imagen: 'images/productos/CELULARES/Celular Xiaomi Redmi 13C/01.png', precio: '$ 411.770' },
    { nombre: 'Celular Samsung A05 6.5" 64GB Plata', imagen: 'images/productos/CELULARES/Celular Samsung A05/01.jpg', precio: '$ 239.979' },
    { nombre: 'Celular Samsung A15 6.5" 128GB Black Blue', imagen: 'images/productos/CELULARES/Celular Samsung A15/01.png', precio: '$ 349.999' },
    { nombre: 'Celular Motorola G24 6.6" 128GB Gris', imagen: 'images/productos/CELULARES/Celular Motorola G24/01.png', precio: '$ 369.899' },
    { nombre: 'Celular Xiaomi Redmi A3 6.71" 64GB Azul', imagen: 'images/productos/CELULARES/Celular Xiaomi Redmi A3/01.jpg', precio: '$ 199.989' },   
    // COMPUTADORAS
    { nombre: 'Computadora Gamer Gfast X-501 Rooki Intel Core I5 16GB/240GB', imagen: 'images/productos/COMPUTACION/Computadora Gamer Gfast X-501/01.jpg', precio: '$ 972.630' },
    { nombre: 'Computadora Gfast H-350 Intel Core I3 Slim', imagen: 'images/productos/COMPUTACION/Computadora Gfast H-350 Intel Core I3 Slim/01.png', precio: '$ 742.580' },
    { nombre: 'Pc Aio Lenovo IC3 24IAP7 23.8" Intel Core I5 12GB/512GB', imagen: 'images/productos/COMPUTACION/Pc Aio Lenovo IC3 24IAP7/01.jpg', precio: '$ 1.476.600' },
    { nombre: 'Notebook Lenovo LOQ15ARP9 Gamer R7 15.6" 24GB/512GB', imagen: 'images/productos/COMPUTACION/Notebook Lenovo LOQ15ARP9 Gamer R7/01.jpg', precio: '$ 2.302.899' },
    { nombre: 'Notebook HP 255-G10 Ryzer 7 15.6" 16GB/512GB', imagen: 'images/productos/COMPUTACION/Notebook HP 255-G10 Ryzer 7/01.jpg', precio: '$ 1.562.200' },
    // CONSOLAS
    { nombre: 'Consola Sony Playstation 5 1TB Digital + 2 Juegos', imagen: 'images/productos/CONSOLAS/Consola Sony Playstation 5/01.jpg', precio: '$ 1.647.060' },
    { nombre: 'Consola Xbox Series S 512GB Ssd Digital', imagen: 'images/productos/CONSOLAS/Consola Xbox Series S/01.jpg', precio: '$ 954.440' },
    { nombre: 'Consola Video Juego Level Up Retro Nes HDMI 500 Juegos', imagen: 'images/productos/CONSOLAS/Consola Video Juego Level Up Retro Nes HDMI 500 Juegos/01.png', precio: '$ 56.174' },
    { nombre: 'Consola Retro Kanji KJ-START 145 Juegos', imagen: 'images/productos/CONSOLAS/Consola Retro Kanji KJ-START/01.jpg', precio: '$ 38.733' },
    { nombre: 'Consola Kanji KJ-Pocket 400 Juegos Portátil', imagen: 'images/productos/CONSOLAS/Consola Kanji KJ-Pocket/01.jpg', precio: '$ 38.309' },
    // TELEVISORES
    { nombre: 'Smart Tv Philips 32" 32PHD6918 HD Google Tv', imagen: 'images/productos/SMARTTV/Smart Tv Philips 32/01.jpg', precio: '$ 410.490' },
    { nombre: 'Smart Tv Samsung 32" UN32T4300AGCZB HD', imagen: 'images/productos/SMARTTV/Smart Tv Samsung 32/01.png', precio: '$ 395.900' },
    { nombre: 'Smart Tv LG 32" 9132LQ630BPSA HD WebOS', imagen: 'images/productos/SMARTTV/Smart Tv LG 32/01.jpg', precio: '$ 426.930' },
    { nombre: 'Smart Tv Noblex 32" 91DR32X7050 HD Android Tv', imagen: 'images/productos/SMARTTV/Smart Tv Noblex 32/01.jpg', precio: '$ 470.780' },
    { nombre: 'Smart Tv Rca 32" C32AND Android Tv', imagen: 'images/productos/SMARTTV/Smart Tv Rca 32/01.jpg', precio: '$ 331.700' },
    // CLIMATIZACIÓN
    { nombre: 'Aire Acondicionado Split Electra ENTRDO32TC 3200WTS f/c', imagen: 'images/productos/CLIMATIZACION/Aire Acondicionado Split Electra/01.png', precio: '$ 862.420' },
    { nombre: 'Aire Acondicionado Split Hyundai HY11INV 3200Watts f/c Inverter', imagen: 'images/productos/CLIMATIZACION/Aire Acondicionado Split Hyundai/01.png', precio: '$ 1.465.010' },
    { nombre: 'Ventilador Liliana VPRN20 20" 90 Watts', imagen: 'images/productos/CLIMATIZACION/Ventilador Liliana VPRN20 20 90 Watts/01.png', precio: '$ 138.360' },
    { nombre: 'Climatizador de Aire Midea MCC/12 Frío C/Remoto 10Lts', imagen: 'images/productos/CLIMATIZACION/Climatizador de Aire Midea/01.jpeg', precio: '$ 190.460' },
    { nombre: 'Caloventor Eiffel E543 2000Watts Vertical', imagen: 'images/productos/CLIMATIZACION/Caloventor Eiffel E543 2000Watts Vertical/01.jpg', precio: '$ 34.106' },
    // COCINA
    { nombre: 'Cocina Morelli 018027P Acero Inoxidable 60CM', imagen: 'images/productos/COCINA/Cocina Morelli/01.png', precio: '$ 842.624' },
    { nombre: 'Cocina Usman Carliplancha Mod 992 Gas Natural 85Cm', imagen: 'images/productos/COCINA/Cocina Usman/01.png', precio: '$ 902.499' },
    { nombre: 'Horno Eléctrico Enova HE3510-AI 35Lts 1500Watts C/Espiedo', imagen: 'images/productos/COCINA/Horno Eléctrico Enova/01.jpg', precio: '$ 150.870' },
    { nombre: 'Microondas Whirlpool MCP346SL 25Lts 800Watts', imagen: 'images/productos/COCINA/Microondas Whirlpool/01.jpg', precio: '$ 488.990' },
    { nombre: 'Microondas Daewoo 120DS20', imagen: 'images/productos/COCINA/Microondas Daewoo/01.jpg', precio: '$ 234.330' },
    // HELADERAS Y FREEZERS
    { nombre: 'Heladera Cíclica Gafa HGF358AFB 282Lts', imagen: 'images/productos/HELADERAS/Heladera Cíclica Gafa/01.jpg', precio: '$ 826.040' },
    { nombre: 'Freezer Gafa FGHI300B/L 280Lts Inverter', imagen: 'images/productos/HELADERAS/Freezer Gafa/01.jpg', precio: '$ 888.100' },
    { nombre: 'Heladera Cíclica Neba A280 280Lts', imagen: 'images/productos/HELADERAS/Heladera Cíclica Neba/01.png', precio: '$ 616.320' },
    { nombre: 'Heladera No Frost Samsung RT32 330Lts Inverter', imagen: 'images/productos/HELADERAS/Heladera No Frost Samsung/01.png', precio: '$ 1.284.000' },
    { nombre: 'Freezer Briket FR3300 295Lts', imagen: 'images/productos/HELADERAS/Freezer Briket/01.jpg', precio: '$ 732.950' }
];

// Función para obtener productos aleatorios
function obtenerProductosAleatorios(cantidad) {
    const productosSeleccionados = [];
    const productosCopy = [...productosDisponibles];
    while (productosSeleccionados.length < cantidad && productosCopy.length > 0) {
        const indexAleatorio = Math.floor(Math.random() * productosCopy.length);
        productosSeleccionados.push(productosCopy.splice(indexAleatorio, 1)[0]);
    }
    return productosSeleccionados;
}

// Función para mostrar productos en la sección de "Productos Destacados"
function mostrarProductosDestacados() {
    const productosAleatorios = obtenerProductosAleatorios(5);
    const tbody = document.querySelector('#productos tbody');
    tbody.innerHTML = '';
    productosAleatorios.forEach(producto => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><img src="${producto.imagen}" alt="${producto.nombre}" class="img-fluid"></td>
            <td>${producto.nombre}</td>
            <td>${producto.precio}</td>
            <td><button class="btn btn-primary">Añadir al Carrito</button></td>
        `;
        tbody.appendChild(row);
    });
}

// Ejecuta mostrarProductosDestacados cuando la página carga
document.addEventListener('DOMContentLoaded', mostrarProductosDestacados);
