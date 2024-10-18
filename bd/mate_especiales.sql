-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 22:12:01
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mate_especiales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `totalPreguntas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `usuario`, `password`, `totalPreguntas`) VALUES
(1, 'admin', 'admin', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE `estadisticas` (
  `id` int(11) NOT NULL,
  `visitas` int(11) NOT NULL,
  `respondidas` int(11) NOT NULL,
  `completados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas`
--

INSERT INTO `estadisticas` (`id`, `visitas`, `respondidas`, `completados`) VALUES
(1, 135, 41, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `tema` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `opcion_a` text NOT NULL,
  `opcion_b` text NOT NULL,
  `opcion_c` text NOT NULL,
  `opcion_d` text NOT NULL,
  `correcta` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `tema`, `pregunta`, `opcion_a`, `opcion_b`, `opcion_c`, `opcion_d`, `correcta`) VALUES
(3, 2, 'A', 'a', 'b', 'c', 'd', 'A'),
(4, 2, 'b', 'a', 'b', 'c', 'd', 'B'),
(5, 2, 'c', 'a', 'b', 'c', 'd', 'C'),
(6, 2, 'd', 'a', 'b', 'c', 'd', 'D'),
(7, 2, 'a2', 'a', 'b', 'c', 'd', 'A'),
(8, 2, 'b2', 'a', 'b', 'c', 'd', 'B'),
(9, 2, 'c2', 'a', 'b', 'c', 'd', 'C'),
(10, 2, 'd2', 'a', 'b', 'c', 'd', 'D'),
(11, 1, 'a', 'a', 'b', 'c', 'd', 'A'),
(12, 1, 'b', 'a', 'b', 'c', 'd', 'B'),
(13, 1, 'c', 'a', 'b', 'c', 'd', 'C'),
(14, 1, 'd', 'a', 'b', 'c', 'd', 'D'),
(15, 1, 'a2', 'a', 'b', 'c', 'd', 'A'),
(16, 1, 'b2', 'a', 'b', 'c', 'd', 'B'),
(17, 1, 'c2', 'a', 'b', 'c', 'd', 'C'),
(18, 1, 'd2', 'a', 'b', 'c', 'd', 'D'),
(19, 1, 'a3', 'a', 'b', 'c', 'd', 'A'),
(20, 1, 'b3', 'a', 'b', 'c', 'd', 'B'),
(21, 1, 'c3', 'a', 'b', 'c', 'd', 'C'),
(22, 1, 'd3', 'a', 'b', 'c', 'd', 'D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'administrador '),
(2, 'profesores'),
(3, 'estudiantes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `nombre`) VALUES
(1, 'Programación'),
(2, 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(20) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `password` varchar(80) NOT NULL,
  `fechas_creacion` date NOT NULL,
  `totalPreguntas` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `telefono`, `correo`, `password`, `fechas_creacion`, `totalPreguntas`, `id_rol`) VALUES
('1004251550', 'Manuel Palacios Mosquera', '3246173924', 'manuel@gmail.com', '$2y$10$JFhjEdRVBkTuOPrupoOz0.i.yFMYQjUFWDFVnkphFqf.ZA3Nn63Bq', '2024-10-17', NULL, 3),
('1077425015', 'ferly palacios moya', '3234163627', 'admin@gmail.com', '$2y$10$yPMUxVcUdRWjWEmdv0sVv.JFdkbAgjJNzzfPDVfolESNm.F5lWkc.', '2024-10-17', 2, 1),
('542570187', 'Blanca', '3116094236', 'blanca@gmail.com', '$2y$10$5THU.WLkbNxUaiObk6UunexPDZMqIUI0a0ITU17vBXYpil8mgOz1u', '2024-10-17', NULL, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
