-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2024 a las 23:27:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nutricion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificador`
--

CREATE TABLE `planificador` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `dia` varchar(20) NOT NULL,
  `desayuno` text DEFAULT NULL,
  `almuerzo` text DEFAULT NULL,
  `cena` text DEFAULT NULL,
  `realizado` int(11) NOT NULL DEFAULT 0,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planificador`
--

INSERT INTO `planificador` (`id`, `user_id`, `dia`, `desayuno`, `almuerzo`, `cena`, `realizado`, `creado_en`, `actualizado_en`) VALUES
(2, 1, 'Martes', '', '', '', 0, '2024-09-09 13:55:01', '2024-09-09 13:55:01'),
(3, 1, 'Miércoles', '', '', '', 0, '2024-09-09 13:55:01', '2024-09-09 13:55:01'),
(4, 1, 'Jueves', '', '', '', 0, '2024-09-09 13:55:01', '2024-09-09 13:55:01'),
(5, 1, 'Viernes', '', '', '', 0, '2024-09-09 13:55:01', '2024-09-09 13:55:01'),
(6, 1, 'Sábado', '', '', '', 0, '2024-09-09 13:55:01', '2024-09-09 13:55:01'),
(7, 1, 'Domingo', '', '', '', 0, '2024-09-09 13:55:01', '2024-09-09 13:55:01'),
(9, 1, 'Martes', '', '', '', 0, '2024-09-14 15:52:02', '2024-09-14 15:52:02'),
(10, 1, 'Miércoles', '', '', '', 0, '2024-09-14 15:52:02', '2024-09-14 15:52:02'),
(11, 1, 'Jueves', '', '', '', 0, '2024-09-14 15:52:02', '2024-09-14 15:52:02'),
(12, 1, 'Viernes', '', '', '', 0, '2024-09-14 15:52:02', '2024-09-14 15:52:02'),
(13, 1, 'Sábado', '', '', '', 0, '2024-09-14 15:52:02', '2024-09-14 15:52:02'),
(14, 1, 'Domingo', '', '', '', 0, '2024-09-14 15:52:02', '2024-09-14 15:52:02'),
(15, 1, 'Lunes', 'arepa asada, huevo revuelto y chocolate con leche', 'Sancocho de carne, arroz, jugo de lulo', 'plantano cocinado, salchichas rancheras y chocolate caliente', 1, '2024-09-20 13:39:21', '2024-09-20 13:39:21'),
(16, 1, 'Martes', '', '', '', 0, '2024-09-20 13:39:21', '2024-09-20 13:39:21'),
(17, 1, 'Miércoles', '', '', '', 0, '2024-09-20 13:39:21', '2024-09-20 13:39:21'),
(18, 1, 'Jueves', '', '', '', 0, '2024-09-20 13:39:21', '2024-09-20 13:39:21'),
(19, 1, 'Viernes', '', '', '', 0, '2024-09-20 13:39:21', '2024-09-20 13:39:21'),
(20, 1, 'Sábado', '', '', '', 0, '2024-09-20 13:39:21', '2024-09-20 13:39:21'),
(21, 1, 'Domingo', '', '', '', 0, '2024-09-20 13:39:21', '2024-09-20 13:39:21'),
(22, 1, 'Lunes', '', '', '', 0, '2024-09-20 14:59:52', '2024-09-20 14:59:52'),
(23, 1, 'Martes', 'platano, huevo revuelto y agua de panela', 'sopa de pasta con queso, arroz, jugo de marachulla', 'plantano frito, salchichas rancheras y chocolate caliente', 0, '2024-09-20 14:59:52', '2024-09-20 14:59:52'),
(24, 1, 'Miércoles', '', '', '', 0, '2024-09-20 14:59:52', '2024-09-20 14:59:52'),
(25, 1, 'Jueves', '', '', '', 0, '2024-09-20 14:59:52', '2024-09-20 14:59:52'),
(26, 1, 'Viernes', '', '', '', 0, '2024-09-20 14:59:52', '2024-09-20 14:59:52'),
(27, 1, 'Sábado', '', '', '', 0, '2024-09-20 14:59:52', '2024-09-20 14:59:52'),
(28, 1, 'Domingo', '', '', '', 0, '2024-09-20 14:59:52', '2024-09-20 14:59:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso_salud`
--

CREATE TABLE `progreso_salud` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `grasa_corporal` decimal(5,2) DEFAULT NULL,
  `masa_muscular` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `progreso_salud`
--

INSERT INTO `progreso_salud` (`id`, `user_id`, `fecha_registro`, `peso`, `grasa_corporal`, `masa_muscular`) VALUES
(5, 2, '2024-09-11', 70.00, 30.00, 22.00),
(6, 2, '2024-09-12', 68.00, 37.00, 22.00),
(7, 2, '2024-09-13', 72.00, 39.00, 57.00),
(11, 1, '2023-08-04', 74.50, 18.20, 40.70),
(12, 1, '2023-08-05', 74.30, 18.10, 40.80),
(13, 1, '2023-08-06', 74.10, 18.00, 40.90),
(14, 1, '2023-08-07', 73.90, 17.90, 41.00),
(15, 1, '2023-08-08', 73.70, 17.80, 41.20),
(16, 1, '2023-08-09', 73.50, 17.70, 41.30),
(17, 1, '2023-08-10', 73.30, 17.60, 41.40),
(18, 1, '2023-08-11', 73.10, 17.50, 41.50),
(19, 1, '2023-08-12', 72.90, 17.40, 41.60),
(20, 1, '2023-08-13', 72.70, 17.30, 41.70),
(21, 1, '2023-08-14', 72.50, 17.20, 41.80),
(22, 1, '2023-08-15', 72.30, 17.10, 41.90),
(23, 1, '2023-08-16', 72.10, 17.00, 42.00),
(24, 1, '2023-08-17', 71.90, 16.90, 42.10),
(25, 1, '2023-08-18', 71.70, 16.80, 42.20),
(26, 1, '2023-08-19', 71.50, 16.70, 42.30),
(27, 1, '2023-08-20', 71.30, 16.60, 42.40),
(28, 1, '2023-08-21', 71.10, 16.50, 42.50),
(29, 1, '2023-08-22', 70.90, 16.40, 42.60),
(30, 1, '2023-08-23', 70.70, 16.30, 42.70),
(31, 1, '2023-08-24', 70.50, 16.20, 42.80),
(32, 1, '2023-08-25', 70.30, 16.10, 42.90),
(33, 1, '2023-08-26', 70.10, 16.00, 43.00),
(34, 1, '2023-08-27', 69.90, 15.90, 43.10),
(35, 1, '2023-08-28', 69.70, 15.80, 43.20),
(36, 1, '2023-08-29', 69.50, 15.70, 43.30),
(37, 1, '2023-08-30', 69.30, 15.60, 43.40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `altura` decimal(5,2) NOT NULL,
  `genero` enum('masculino','femenino','otro') NOT NULL,
  `nivel_actividad` enum('bajo','moderado','alto') NOT NULL,
  `objetivo_salud` enum('bajar peso','aumentar musculo','mantener salud','otro') NOT NULL,
  `calorias_diarias` int(11) NOT NULL,
  `carbohidratos_diarios` int(11) NOT NULL,
  `proteinas_diarias` int(11) NOT NULL,
  `grasas_diarias` int(11) NOT NULL,
  `condiciones_medicas` enum('diabetes','hipertension','asma','otro') NOT NULL,
  `alergias` enum('penicilina','pollen','mariscos','otro') NOT NULL,
  `intolerancias` enum('lactosa','gluten','fructosa','otro') NOT NULL,
  `tipo_dieta` enum('vegetariana','vegana','cetogenica','omnívora','sin_restricciones','otro') NOT NULL,
  `otro_objetivo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `otro_condicion` varchar(255) DEFAULT NULL,
  `otro_alergia` varchar(255) DEFAULT NULL,
  `otra_intolerancia` varchar(255) DEFAULT NULL,
  `otra_dieta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `edad`, `peso`, `altura`, `genero`, `nivel_actividad`, `objetivo_salud`, `calorias_diarias`, `carbohidratos_diarios`, `proteinas_diarias`, `grasas_diarias`, `condiciones_medicas`, `alergias`, `intolerancias`, `tipo_dieta`, `otro_objetivo`, `created_at`, `updated_at`, `otro_condicion`, `otro_alergia`, `otra_intolerancia`, `otra_dieta`) VALUES
(1, 'Leison', 'Palacios', 'leison@gmail.com', '$2y$10$gxhj2Iowr.Jm8Tdg3bvK/OK6spumicgBLRaBjFsmUlX0aenHD1QVW', 25, 24.00, 181.00, 'masculino', 'bajo', 'aumentar musculo', 100, 100, 70, 70, 'asma', 'mariscos', 'lactosa', 'cetogenica', NULL, '2024-09-09 02:53:37', '2024-09-11 04:59:51', NULL, NULL, NULL, NULL),
(2, 'Haminton Jair', 'Mena Mena', 'ing.haminton@outlook.com', '$2y$10$Z6gG4e16vsI08/d.q60d2.b0BK3CZniPmR1AfsLCiUvR1wWVV6lGi', 25, 68.00, 180.00, 'masculino', 'bajo', 'aumentar musculo', 1999, 250, 150, 69, 'diabetes', 'pollen', 'lactosa', 'vegana', NULL, '2024-09-14 03:28:26', '2024-09-14 03:51:49', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `planificador`
--
ALTER TABLE `planificador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `progreso_salud`
--
ALTER TABLE `progreso_salud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT de la tabla `planificador`
--
ALTER TABLE `planificador`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `progreso_salud`
--
ALTER TABLE `progreso_salud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `planificador`
--
ALTER TABLE `planificador`
  ADD CONSTRAINT `planificador_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `progreso_salud`
--
ALTER TABLE `progreso_salud`
  ADD CONSTRAINT `progreso_salud_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
