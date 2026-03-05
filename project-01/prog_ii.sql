-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-02-2026 a las 22:51:56
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prog_ii`
--
CREATE DATABASE IF NOT EXISTS `prog_ii` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci;
USE `prog_ii`;
-- AQUI.SE.CREA.LA.BASE.DE.DATOS.'PROG_II'.SINO.EXISTE
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_productos`
--

CREATE TABLE `grupo_productos` (
  `id` int NOT NULL,
  `nombre` varchar(75) COLLATE utf8mb3_spanish_ci NOT NULL,
  `codigo` varchar(15) COLLATE utf8mb3_spanish_ci NOT NULL,
  `observa` text COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `grupo_productos`
--

INSERT INTO `grupo_productos` (`id`, `nombre`, `codigo`, `observa`) VALUES
(1, 'LEGUMBRES', '01-002', 'VARIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(75) COLLATE utf8mb3_spanish_ci NOT NULL,
  `precio_venta` decimal(10,0) NOT NULL,
  `costo` decimal(10,0) NOT NULL,
  `id_grupo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio_venta`, `costo`, `id_grupo`) VALUES
(1, 'CEBOLLAS', 1200, 150, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('Admin','Editor','Usuario') DEFAULT 'Usuario',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `usuarios`
-- CLAVE admin123
-- para.el.usuario.mtoro129@gmail.com

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `fecha_registro`, `foto`) VALUES
(4, 'Martin.Toro.I', 'mtoro129@hotmail.com', '$2y$10$11xwTqf86ptUcRssyzyTvuLGRqaV2leUFIFNztApGQ1JSrhrkBQAO', 'Admin', '2026-02-20 16:28:06', 'default.png'),
(9, 'MARTIN TORO BNC', 'suministrosxmg@gmail.com', '$2y$10$MF6jE1XmQV2hy0bzTE653ekSHCmL9pxkMVEn82beqWhLc3MZZPrLW', 'Editor', '2026-02-20 22:26:03', 'default.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupo_productos`
--
ALTER TABLE `grupo_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupo_productos`
--
ALTER TABLE `grupo_productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo_productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
