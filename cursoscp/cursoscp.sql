-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-01-2025 a las 21:49:48
-- Versión del servidor: 8.0.40-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursoscp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `user` varchar(15) NOT NULL,
  `pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `codigocurso` int NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `abierto` tinyint(1) NOT NULL DEFAULT '1',
  `numeroplazas` smallint NOT NULL DEFAULT '20',
  `plazoinscripcion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`codigocurso`, `nombre`, `abierto`, `numeroplazas`, `plazoinscripcion`) VALUES
(1, 'Instalacion y uso de Apache', 0, 5, '2025-01-10'),
(2, 'Administracion avanzada de Apache', 0, 5, '2025-01-10'),
(3, 'Elaboracion de recursos didacticos', 0, 5, '2025-01-10'),
(4, 'Uso didactico de Moodle en primaria', 1, 5, '2025-01-10'),
(5, 'Uso didactico de Moodle en secundaria', 1, 5, '2025-01-10'),
(6, 'Moodle y el aula de musica', 1, 5, '2025-01-10'),
(7, 'Tratamiento de imagenes', 1, 5, '2025-01-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE `solicitantes` (
  `dni` varchar(9) NOT NULL DEFAULT '',
  `nombre` varchar(20) NOT NULL DEFAULT '',
  `apellidos` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `telefono` varchar(12) NOT NULL DEFAULT '',
  `correo` varchar(50) NOT NULL DEFAULT '',
  `codcen` varchar(8) NOT NULL DEFAULT '',
  `coordinadortic` tinyint(1) NOT NULL DEFAULT '0',
  `grupotic` tinyint(1) NOT NULL DEFAULT '0',
  `nomgrupo` varchar(25) NOT NULL DEFAULT '',
  `pbilin` tinyint(1) NOT NULL DEFAULT '0',
  `cargo` tinyint(1) NOT NULL DEFAULT '0',
  `nombrecargo` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `situacion` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `fechanac` date DEFAULT NULL,
  `especialidad` varchar(50) NOT NULL DEFAULT '',
  `anyoinicio` int DEFAULT NULL,
  `puntos` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`dni`, `nombre`, `apellidos`, `telefono`, `correo`, `codcen`, `coordinadortic`, `grupotic`, `nomgrupo`, `pbilin`, `cargo`, `nombrecargo`, `situacion`, `fechanac`, `especialidad`, `anyoinicio`, `puntos`) VALUES
('01155600B', 'Renaldo', 'Trejo Carmona', '654194582', 'renaldotrejocarmona@educa.com', '4523', 1, 1, 'BigData e IA', 1, 1, 'Director', 'activo', NULL, '', 2004, 14),
('03839044E', 'Basemat', 'Gómez Tapia', '635512727', 'basematgomeztapia@educa.com', '1457', 1, 1, 'Tecnologia', 0, 1, 'Jefe Departamento', 'activo', '1973-01-06', 'Automatizacion y robotica', 1991, 10),
('25323498S', 'Eira', 'Cruz Figueroa', '665991877', 'eiracruzfigueroa@educa.com', '1457', 1, 1, 'Programacion', 0, 1, 'Director', 'activo', '1975-04-18', 'Python', 1996, 11),
('29315740D', 'Fortunata', 'Alcaraz Fierro', '743634866', 'fortunataalcarazfierro@educa.es', '4596', 0, 0, '', 1, 1, 'Director', 'inactivo', NULL, '', 1991, 6),
('57606382F', 'Amilca', 'Ledesma Bustos', '687331832', 'amilcaledesmabustos@educa.es', '4526', 1, 0, '', 1, 1, 'Secretario', 'activo', NULL, '', 2013, 10),
('58844419T', 'Gatty', 'Noriega Ramírez', '748050198', 'gattynoriegaramirez@educa.es', '4523', 1, 0, 'Linux', 1, 1, 'Secretario', 'activo', NULL, '', 1998, 11),
('59849284H', 'Eryk', 'Orta Madrid', '764894250', 'erykortamadrid@educa.com', '4536', 0, 0, '', 1, 1, 'Jefe Estudios', 'activo', '1974-04-14', '', 1995, 7),
('60162161A', 'Jonatán', 'Amaya Naranjo', '688291178', 'jonatanamayanaranjo@educa.com', '1836', 0, 0, 'Idiomas', 1, 1, 'Secretario', 'activo', '1979-11-20', 'Ingles', 2001, 7),
('66001916N', 'Alondra', 'Domínquez Guardado', '614944434', 'alondradominquezguardado@educa.com', '1453', 0, 1, 'Informatica', 1, 0, '', 'activo', '2000-10-08', 'Sistemas operativos en la nube Azure', 2021, 7),
('71687304F', 'Celerino', 'Noriega Alva', '605672841', 'celerinonoriegaalva@educa.es', '1457', 0, 0, '', 0, 0, '', 'activo', NULL, '', 1999, 2),
('90415837P', 'Melea', 'Bañuelos Cervantes', '774692169', 'meleabanueloscervantes@educa.com', '1453', 0, 0, 'Matematicas', 0, 1, 'Jefe Estudios', 'activo', '1982-12-10', 'Matematicas avanzadas', 2003, 4),
('97996053E', 'Otilio', 'Ocampo Salas', '713108207', 'otilioocamposalas@educa.com', '5362', 0, 0, 'Sistemas operativos', 0, 0, '', 'activo', '1973-05-21', '', 2003, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `idsolicitud` int NOT NULL,
  `dni` varchar(9) NOT NULL,
  `codigocurso` int NOT NULL,
  `fechasolicitud` date NOT NULL,
  `admitido` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`idsolicitud`, `dni`, `codigocurso`, `fechasolicitud`, `admitido`) VALUES
(114, '01155600B', 1, '2025-01-13', 1),
(115, '01155600B', 2, '2025-01-13', 0),
(116, '01155600B', 3, '2025-01-13', 1),
(117, '01155600B', 4, '2025-01-13', 0),
(118, '01155600B', 5, '2025-01-13', 0),
(119, '01155600B', 6, '2025-01-13', 0),
(120, '01155600B', 7, '2025-01-13', 0),
(121, '03839044E', 1, '2025-01-13', 1),
(122, '03839044E', 2, '2025-01-13', 0),
(123, '03839044E', 3, '2025-01-13', 0),
(124, '03839044E', 4, '2025-01-13', 0),
(125, '03839044E', 5, '2025-01-13', 0),
(126, '03839044E', 6, '2025-01-13', 0),
(127, '03839044E', 7, '2025-01-13', 0),
(128, '25323498S', 1, '2025-01-13', 1),
(129, '25323498S', 2, '2025-01-13', 0),
(130, '25323498S', 3, '2025-01-13', 1),
(131, '25323498S', 4, '2025-01-13', 0),
(132, '25323498S', 5, '2025-01-13', 0),
(133, '25323498S', 6, '2025-01-13', 0),
(134, '25323498S', 7, '2025-01-13', 0),
(135, '29315740D', 1, '2025-01-13', 0),
(136, '29315740D', 2, '2025-01-13', 1),
(137, '29315740D', 3, '2025-01-13', 0),
(138, '29315740D', 4, '2025-01-13', 0),
(139, '29315740D', 5, '2025-01-13', 0),
(140, '29315740D', 6, '2025-01-13', 0),
(141, '29315740D', 7, '2025-01-13', 0),
(142, '57606382F', 1, '2025-01-13', 1),
(143, '57606382F', 2, '2025-01-13', 0),
(144, '57606382F', 3, '2025-01-13', 0),
(145, '57606382F', 4, '2025-01-13', 0),
(146, '57606382F', 5, '2025-01-13', 0),
(147, '57606382F', 6, '2025-01-13', 0),
(148, '57606382F', 7, '2025-01-13', 0),
(149, '58844419T', 1, '2025-01-13', 1),
(150, '58844419T', 2, '2025-01-13', 0),
(151, '58844419T', 3, '2025-01-13', 1),
(152, '58844419T', 4, '2025-01-13', 0),
(153, '58844419T', 5, '2025-01-13', 0),
(154, '58844419T', 6, '2025-01-13', 0),
(155, '58844419T', 7, '2025-01-13', 0),
(156, '59849284H', 1, '2025-01-13', 0),
(157, '59849284H', 2, '2025-01-13', 1),
(158, '59849284H', 3, '2025-01-13', 0),
(159, '59849284H', 4, '2025-01-13', 0),
(160, '59849284H', 5, '2025-01-13', 0),
(161, '59849284H', 6, '2025-01-13', 0),
(162, '59849284H', 7, '2025-01-13', 0),
(163, '60162161A', 1, '2025-01-13', 0),
(164, '60162161A', 2, '2025-01-13', 1),
(165, '60162161A', 3, '2025-01-13', 0),
(166, '60162161A', 4, '2025-01-13', 0),
(167, '60162161A', 5, '2025-01-13', 0),
(168, '60162161A', 6, '2025-01-13', 0),
(169, '60162161A', 7, '2025-01-13', 0),
(170, '66001916N', 1, '2025-01-13', 0),
(171, '66001916N', 2, '2025-01-13', 1),
(172, '66001916N', 3, '2025-01-13', 0),
(173, '66001916N', 4, '2025-01-13', 0),
(174, '66001916N', 5, '2025-01-13', 0),
(175, '66001916N', 6, '2025-01-13', 0),
(176, '66001916N', 7, '2025-01-13', 0),
(177, '71687304F', 1, '2025-01-13', 0),
(178, '71687304F', 2, '2025-01-13', 0),
(179, '71687304F', 3, '2025-01-13', 1),
(180, '71687304F', 4, '2025-01-13', 0),
(181, '71687304F', 5, '2025-01-13', 0),
(182, '71687304F', 6, '2025-01-13', 0),
(183, '71687304F', 7, '2025-01-13', 0),
(184, '90415837P', 1, '2025-01-13', 0),
(185, '90415837P', 2, '2025-01-13', 1),
(186, '90415837P', 3, '2025-01-13', 0),
(187, '90415837P', 4, '2025-01-13', 0),
(188, '90415837P', 5, '2025-01-13', 0),
(189, '90415837P', 6, '2025-01-13', 0),
(190, '90415837P', 7, '2025-01-13', 0),
(191, '97996053E', 1, '2025-01-13', 0),
(192, '97996053E', 2, '2025-01-13', 0),
(193, '97996053E', 3, '2025-01-13', 1),
(194, '97996053E', 4, '2025-01-13', 0),
(195, '97996053E', 5, '2025-01-13', 0),
(196, '97996053E', 6, '2025-01-13', 0),
(197, '97996053E', 7, '2025-01-13', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigocurso`);

--
-- Indices de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`idsolicitud`),
  ADD KEY `dni` (`dni`),
  ADD KEY `codigocurso` (`codigocurso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `codigocurso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idsolicitud` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `solicitantes` (`dni`),
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`codigocurso`) REFERENCES `cursos` (`codigocurso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
