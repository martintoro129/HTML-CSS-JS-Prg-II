CREATE DATABASE tech_db;
USE tech_db;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    imagen_url VARCHAR(255) -- Aquí guardas la ruta: 'img/laptop.jpg'
);
