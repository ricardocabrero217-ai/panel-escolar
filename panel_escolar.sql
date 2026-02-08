-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2026 a las 05:48:43
-- Versión del servidor: 8.4.0
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `panel_escolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido_paterno` varchar(80) NOT NULL,
  `apellido_materno` varchar(80) NOT NULL,
  `grupo_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `grupo_id`, `created_at`) VALUES
(1, 'Ana', 'López', 'Hernández', 1, '2026-02-06 01:02:17'),
(2, 'Carlos Eduardo', 'Gomez', 'Serafin', 1, '2026-02-06 01:05:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `abreviatura` varchar(10) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `abreviatura`, `activo`, `created_at`) VALUES
(1, 'Ingeniería en Sistemas', 'ISC', 1, '2026-02-06 01:02:17'),
(2, 'Administración', 'ADM', 1, '2026-02-06 01:02:17'),
(3, 'Derecho', 'DER', 1, '2026-02-06 01:02:17'),
(4, 'Contaduría', 'CON', 1, '2026-02-06 01:02:17'),
(5, 'Psicología', 'PSI', 1, '2026-02-06 01:02:17'),
(6, 'Ingeniería en Sistemas Computacionales', 'ISC', 1, '2026-02-08 04:41:44'),
(7, 'Administración de Empresas', 'ADM', 1, '2026-02-08 04:41:44'),
(8, 'Contaduría Pública y Finanzas', 'CPF', 1, '2026-02-08 04:41:44'),
(9, 'Mercadotecnia y Publicidad', 'MYP', 1, '2026-02-08 04:41:44'),
(10, 'Administración de Empresas Turísticas', 'AET', 1, '2026-02-08 04:41:44'),
(11, 'Relaciones Internacionales', 'RI', 1, '2026-02-08 04:41:44'),
(12, 'Gastronomía', 'GAS', 1, '2026-02-08 04:41:44'),
(13, 'Periodismo y Ciencias de la Comunicación', 'PCC', 1, '2026-02-08 04:41:44'),
(14, 'Diseño de Modas', 'DM', 1, '2026-02-08 04:41:44'),
(15, 'Pedagogía', 'PED', 1, '2026-02-08 04:41:44'),
(16, 'Cultura Física y Educación del Deporte', 'CFED', 1, '2026-02-08 04:41:44'),
(17, 'Idiomas (Inglés y Francés)', 'IDI', 1, '2026-02-08 04:41:44'),
(18, 'Diseño de Interiores', 'DI', 1, '2026-02-08 04:41:44'),
(19, 'Diseño Gráfico', 'DG', 1, '2026-02-08 04:41:44'),
(20, 'Ingeniería en Logística y Transporte', 'ILT', 1, '2026-02-08 04:41:44'),
(21, 'Ingeniero Arquitecto', 'IARQ', 1, '2026-02-08 04:41:44'),
(22, 'Informática Administrativa y Fiscal', 'IAF', 1, '2026-02-08 04:41:44'),
(23, 'Ingeniería Mecánica Automotriz', 'IMA', 1, '2026-02-08 04:41:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id` int NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `numero` int NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id`, `nombre`, `numero`, `activo`, `created_at`) VALUES
(1, '10mo cuatrimestre', 10, 1, '2026-02-06 01:02:17'),
(2, '11vo cuatrimestre', 11, 1, '2026-02-06 01:02:17'),
(4, '1er cuatrimestre', 1, 1, '2026-02-08 04:45:30'),
(5, '2do cuatrimestre', 2, 1, '2026-02-08 04:45:30'),
(6, '3er cuatrimestre', 3, 1, '2026-02-08 04:45:30'),
(7, '4to cuatrimestre', 4, 1, '2026-02-08 04:45:30'),
(8, '5to cuatrimestre', 5, 1, '2026-02-08 04:45:30'),
(9, '6to cuatrimestre', 6, 1, '2026-02-08 04:45:30'),
(10, '7mo cuatrimestre', 7, 1, '2026-02-08 04:45:30'),
(11, '8vo cuatrimestre', 8, 1, '2026-02-08 04:45:30'),
(12, '9no cuatrimestre', 9, 1, '2026-02-08 04:45:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int NOT NULL,
  `carrera_id` int NOT NULL,
  `turno_id` int NOT NULL,
  `grado_id` int NOT NULL,
  `clave_num` int NOT NULL,
  `clave_completa` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `carrera_id`, `turno_id`, `grado_id`, `clave_num`, `clave_completa`, `created_at`) VALUES
(1, 1, 2, 2, 1101, 'ISC-1101-V', '2026-02-06 01:02:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `codigo` char(1) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `nombre`, `codigo`, `activo`, `created_at`) VALUES
(1, 'Matutino', 'M', 1, '2026-02-06 01:02:17'),
(2, 'Vespertino', 'V', 1, '2026-02-06 01:02:17'),
(3, 'Mixto', 'X', 1, '2026-02-06 01:02:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clave_completa` (`clave_completa`),
  ADD KEY `turno_id` (`turno_id`),
  ADD KEY `grado_id` (`grado_id`),
  ADD KEY `carrera_id` (`carrera_id`,`turno_id`,`grado_id`,`clave_num`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`),
  ADD CONSTRAINT `grupos_ibfk_2` FOREIGN KEY (`turno_id`) REFERENCES `turnos` (`id`),
  ADD CONSTRAINT `grupos_ibfk_3` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
