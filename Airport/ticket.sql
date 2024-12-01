-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-11-2024 a las 04:55:20
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
-- Base de datos: `ticket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion`
--

CREATE TABLE `atencion` (
  `id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_evento` int DEFAULT NULL,
  `mensaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `captcha` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `atencion`
--

INSERT INTO `atencion` (`id`, `nombre`, `apellido`, `email`, `id_evento`, `mensaje`, `captcha`) VALUES
(1, 'Fabricio', 'Echeverría', 'fabricio.echeverria@example.com', 1, '¿A qué hora empieza el concierto?', 'ABC123'),
(2, 'Marcela', 'Choque', 'marcela.choque@example.com', 2, '¿Habrá descuentos para estudiantes?', 'DEF456'),
(3, 'Hernán', 'Cárdenas', 'hernan.cardenas@example.com', 3, '¿Cuánto tiempo durará el festival?', 'GHI789'),
(4, 'Susana', 'Ramos', 'susana.ramos@example.com', 4, '¿Se permite la entrada con cámaras al evento?', 'JKL012'),
(5, 'Carlos', 'Lopez', 'carlos.lopez@example.com', 5, '¿Habrá opciones vegetarianas en el evento?', 'MNO345'),
(6, 'Fabr', 'Poma', 'fab.oliver.e@gmail.com', 2, 'Hubo un problema de ingreso ', '61edfb'),
(7, 'Fabricio', 'Poma', 'fab.oliver.e@gmail.com', 2, 'qqq', 'qqq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_evento` int DEFAULT NULL,
  `id_servicio` int DEFAULT NULL,
  `cantidad` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `id_usuario`, `id_evento`, `id_servicio`, `cantidad`) VALUES
(1, 1, 1, 1, 5),
(2, 2, 2, 3, 3),
(3, 3, 3, 5, 3),
(4, 10, 4, 6, 2),
(5, 10, 5, 2, 1),
(6, 10, 3, 5, 2),
(9, 10, 1, NULL, 1),
(10, 10, 2, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `titulo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ubicacion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_evento` date NOT NULL,
  `hora` time NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `imagen`, `titulo`, `ubicacion`, `fecha_evento`, `hora`, `precio`) VALUES
(1, '1.png', 'Concierto Bronco', 'Estadio Hernando Siles, Santa Cruz', '2024-10-25', '19:00:00', 150.00),
(2, '2.png', 'Concierto Kudai', 'Parque Urbano Central, La Paz', '2025-01-24', '10:00:00', 20.00),
(3, '3.png', 'Concierto Juyphi', 'C. Yanachocha entre comercio y potosi - La Paz', '2024-08-14', '08:00:00', 50.00),
(4, '4.png', 'Hagamos Historia', 'Teatro al Aire Libre - La Paz', '2024-09-20', '18:30:00', 120.00),
(5, '5.png', 'Te amo pero no te soporto', 'Teatro 16 de agosto - La Paz', '2024-11-30', '16:00:00', 30.00),
(6, 'eve1.jpg', 'La Nave', 'Galpon Inti - La Paz', '2024-11-15', '01:39:00', 12.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int NOT NULL,
  `codigo_evento` int NOT NULL,
  `servicios_adicionales` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caracteristicas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `detalle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `codigo_evento`, `servicios_adicionales`, `img`, `caracteristicas`, `precio`, `detalle`) VALUES
(1, 1, 'Acceso NO', 'img_vip.jpg', 'Acceso exclusivo, ubicación preferencial', 300.00, 'Entrada especial al área VIP con acceso a barra libre y asientos preferenciales'),
(2, 1, 'Estacionamiento', 'img_estacionamiento.jpg', 'Estacionamiento seguro y cercano al evento', 50.00, 'Acceso a estacionamiento exclusivo para asistentes con vigilancia 24 horas'),
(3, 2, 'Recuerdos de la feria', 'img_recuerdos.jpg', 'Recuerdos únicos del evento', 25.00, 'Incluye postales y artículos temáticos del evento para llevar a casa'),
(4, 3, 'Guía turístico', 'img_guia.jpg', 'Tour guiado por el evento', 75.00, 'Incluye guía experto en el evento con explicaciones detalladas'),
(5, 4, 'Traductor en vivo', 'img_traductor.jpg', 'Traductor en vivo en varios idiomas', 150.00, 'Servicio de traducción simultánea en diferentes idiomas durante el evento'),
(6, 5, 'Acceso a salas privadas', 'img_sala_privada.jpg', 'Acceso a áreas privadas con servicios adicionales', 200.00, 'Entrada a salas privadas con comida, bebida y lugares de descanso exclusivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rol` enum('admin','cliente') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `password`, `rol`) VALUES
(1, 'Juan', 'Pérez', 'juan.perez@example.com', 'password123', 'cliente'),
(2, 'Ana', 'García', 'ana.garcia@example.com', 'password123', 'admin'),
(3, 'Carlos', 'López', 'carlos.lopez@example.com', 'password123', 'cliente'),
(4, 'María', 'Rodríguez', 'maria.rodriguez@example.com', 'password123', 'cliente'),
(5, 'Luis', 'Martínez', 'luis.martinez@example.com', 'password123', 'cliente'),
(6, 'Fabricio', 'Poma', 'fab.oliver.e@gmail.com', '$2y$10$G498Sa.ynfg97jgdYLhLY.pGGqk6.hUNDP9kso7vYO0gCP8gbpMXC', 'cliente'),
(7, 'Pepe', 'Poma', 'Pepe@admin.com', '$2y$10$LeriVhlBYgZ7QADN8aO8guWJAb1JFdJUc5Kp.lbsADiLl41GuLSv6', 'admin'),
(8, 'Pepe', 'Grillo', 'Grillo@admin.com', '$2y$10$mCEzB3HGHdaByNFTKC2wE.JGDIXXytiFUJ8axhjRgZBLAuExNqjKi', 'admin'),
(9, 'Wily', 'Wonka', 'wilywonka123@admin.com', '$2y$10$wHEJxW95PVUeWSn2ZnaMee8HNXQv79vdMFCVSCvJOimuIxEKVLwBy', 'admin'),
(10, 'Jeraldine', 'Jimenes', 'jeral@gmail.com', '$2y$10$gzCkUQZCErLyKVxs1LuwVO0TyFDYFf61ieyovhLHWoSy8fPKOnvC6', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vender`
--

CREATE TABLE `vender` (
  `id` int NOT NULL,
  `organizador` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_evento` int NOT NULL,
  `evento_mensaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vender`
--

INSERT INTO `vender` (`id`, `organizador`, `email`, `telefono`, `id_evento`, `evento_mensaje`) VALUES
(1, 'Juan Pérez', 'juan.perez@example.com', '789456123', 1, '¡No te pierdas el concierto de música andina en La Paz!'),
(2, 'Ana García', 'ana.garcia@example.com', '789456124', 2, 'Ven a disfrutar de la Feria de la Alasita en el Parque Urbano Central.'),
(3, 'Carlos López', 'carlos.lopez@example.com', '789456125', 3, 'Vive la experiencia del Festival de la Virgen de Urkupiña en Cochabamba.'),
(4, 'María Rodríguez', 'maria.rodriguez@example.com', '789456126', 4, 'El mejor teatro internacional llega a Santa Cruz de la Sierra.'),
(5, 'Luis Martínez', 'luis.martinez@example.com', '789456127', 5, 'No te pierdas el Día de la Tradición Chapaca en Tarija, un evento único.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `atencion`
--
ALTER TABLE `atencion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_evento` (`codigo_evento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `vender`
--
ALTER TABLE `vender`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atencion`
--
ALTER TABLE `atencion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vender`
--
ALTER TABLE `vender`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atencion`
--
ALTER TABLE `atencion`
  ADD CONSTRAINT `atencion_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`);

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `carrito_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`codigo_evento`) REFERENCES `evento` (`id`);

--
-- Filtros para la tabla `vender`
--
ALTER TABLE `vender`
  ADD CONSTRAINT `vender_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
