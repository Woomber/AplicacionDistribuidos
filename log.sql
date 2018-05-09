-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2018 a las 12:30:01
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `log`
--
CREATE DATABASE IF NOT EXISTS `log` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `log`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logger`
--

CREATE TABLE `logger` (
  `id` int(11) NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` char(2) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `existencia` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `logger`
--

INSERT INTO `logger` (`id`, `usuario`, `fecha`, `accion`, `id_producto`, `nombre`, `existencia`, `precio`) VALUES
(30, 'admin', '2018-05-09 05:12:49', 'E', 35, 'test', 2, 1),
(31, 'admin', '2018-05-09 05:12:51', 'IE', 35, 'test', 1, 1),
(32, 'admin', '2018-05-09 05:18:57', 'B', 35, 'test', 2, 1),
(33, 'admin', '2018-05-09 05:18:58', 'IE', 35, 'test', 2, 1),
(34, 'admin', '2018-05-09 05:22:18', 'B', 30, 'NE', -1, -1),
(35, 'admin', '2018-05-09 05:23:09', 'IB', 30, 'NE', -1, -1),
(36, 'admin', '2018-05-09 05:23:44', 'IB', 30, 'NE', -1, -1),
(37, 'admin', '2018-05-09 05:25:15', 'IB', 30, 'NE', -1, -1),
(38, 'admin', '2018-05-09 05:25:35', 'IB', 30, 'NE', -1, -1),
(39, 'admin', '2018-05-09 05:25:43', 'IB', 30, 'NE', -1, -1),
(40, 'admin', '2018-05-09 05:25:57', 'A', 36, 'Test 1', 1, 1),
(41, 'admin', '2018-05-09 05:26:06', 'B', 36, 'Test 1', 1, 1),
(42, 'admin', '2018-05-09 05:26:07', 'IE', 36, 'Test 1', 1, 1),
(43, 'admin', '2018-05-09 05:26:47', 'A', 37, 'Test 2', 2, 2),
(44, 'admin', '2018-05-09 05:28:50', 'IB', 30, 'NE', -1, -1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logger`
--
ALTER TABLE `logger`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logger`
--
ALTER TABLE `logger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
