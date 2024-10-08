CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_producto VARCHAR(50) NOT NULL,
    nombre_producto VARCHAR(100),
    categoria VARCHAR(50),
    descripcion TEXT,
    precio DECIMAL(10,2),
    stock INT
);

INSERT INTO productos (codigo_producto, nombre_producto, categoria, descripcion, precio, stock) VALUES
('CAM001', 'Canon EOS R6', 'Fotografia', 'Cámara mirrorless con sensor full frame', 2999.99, 5),
('CAM002', 'Nikon Z6 II', 'Fotografia', 'Cámara mirrorless con excelente enfoque', 1999.99, 3),
('CAM003', 'Sony Alpha a7 III', 'Fotografia', 'Cámara mirrorless con estabilización', 2399.99, 4);
