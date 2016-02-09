-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2016 a las 23:28:28
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `postgrado`
--
CREATE DATABASE IF NOT EXISTS `postgrado` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `postgrado`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `descripcion`) VALUES
(1, 'COMPUTACION'),
(2, 'BIOLOGIA'),
(3, 'FISICA'),
(4, 'MATEMATICA'),
(5, 'QUIMICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
CREATE TABLE IF NOT EXISTS `prestamos` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '3',
  `fecha_entregado` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `codigo`, `cedula`, `fecha_prestamo`, `fecha_devolucion`, `estatus`, `fecha_entregado`) VALUES
(1, 1, '19481926A', '2016-02-05', '2016-02-08', 4, '2016-02-09'),
(11, 2, '19481926', '2016-02-05', '2016-02-08', 3, NULL),
(12, 1, '19481926A', '2016-02-09', '2016-02-12', 4, '2016-02-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

DROP TABLE IF EXISTS `recursos`;
CREATE TABLE IF NOT EXISTS `recursos` (
  `codigo` int(11) NOT NULL,
  `titulo` varchar(500) NOT NULL,
  `autor` varchar(500) NOT NULL,
  `tipo_recurso` int(11) NOT NULL,
  `total_existente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`codigo`, `titulo`, `autor`, `tipo_recurso`, `total_existente`) VALUES
(1, 'test', 'test', 1, 12),
(2, 'test 2', 'test 2', 2, 15),
(3, 'test 3', 'test 3', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `descripcion_status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `descripcion_status`) VALUES
(1, 'USUARIO ACTIVO'),
(2, 'USUARIO SUSPENDIDO'),
(3, 'PRESTAMO EN PROGRESO'),
(4, 'PRESTAMO DEVUELTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_recursos`
--

DROP TABLE IF EXISTS `tipo_recursos`;
CREATE TABLE IF NOT EXISTS `tipo_recursos` (
  `id` int(11) NOT NULL,
  `tipo_recurso` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_recursos`
--

INSERT INTO `tipo_recursos` (`id`, `tipo_recurso`) VALUES
(1, 'LIBRO'),
(2, 'REVISTA'),
(3, 'MANUAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `departamento` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fecha_suspension` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `nombre`, `estatus`, `departamento`, `email`, `fecha_suspension`) VALUES
('19481926', 'Yeraldine', 1, 1, 'yeralmmf@gmail.com', NULL),
('19481926A', 'Yeraldine', 1, 5, 'yeralmmf@gmail.com', NULL),
('19481926B', 'Yeraldine', 1, 2, 'yeralmmf@gmail.com', NULL),
('8830563', 'Test 1', 2, 2, 'test@gmail.com', NULL),
('8830563A', 'Test 2', 1, 3, 'test@gmail.com2', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_recursos`
--
ALTER TABLE `tipo_recursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_recursos`
--
ALTER TABLE `tipo_recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
