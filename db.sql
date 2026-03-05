-- 1. Crear la base de datos
CREATE DATABASE IF NOT EXISTS tech_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tech_db;

-- 2. Tabla para el Carrusel de Productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    imagen_url VARCHAR(255),
    precio DECIMAL(10, 2),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabla para el Formulario de Contacto (Feed de Mensajes)
CREATE TABLE IF NOT EXISTS contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Datos de prueba para el Carrusel (Seeders)
INSERT INTO productos (nombre, descripcion, imagen_url) VALUES 
('Quantum Processor v2', 'Procesador de computación cuántica de última generación.', 'https://picsum.photos/1200/500?random=11'),
('Neural Interface', 'Conexión directa cerebro-computadora con baja latencia.', 'https://picsum.photos/1200/500?random=12'),
('Holographic Display', 'Pantalla de proyección láser 3D para entornos industriales.', 'https://picsum.photos/1200/500?random=13');

-- 5. Datos de prueba para el Feed de Mensajes
INSERT INTO contactos (nombre, email, mensaje) VALUES 
('Elon Musk', 'elon@spacex.com', 'Excelente interfaz, ¿podemos integrarla en Starlink?'),
('Ada Lovelace', 'ada@history.com', 'El diseño del código es muy limpio y elegante.'),
('Satoshi Nakamoto', 'hidden@bitcoin.org', 'La descentralización de estos datos es el futuro.');
