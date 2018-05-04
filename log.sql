-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2018 a las 15:42:23
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logger`
--

CREATE TABLE `logger` (
  `id` int(11) NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` char(1) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `existencia` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `logger`
--

INSERT INTO `logger` (`id`, `usuario`, `fecha`, `accion`, `id_producto`, `nombre`, `existencia`, `precio`) VALUES
(4, 'admin', '2018-05-04 08:27:01', 'B', 27, 'Test 1', 1, 1),
(5, 'admin2', '2018-05-04 08:28:20', 'B', 28, 'Test 2', 2, 2),
(6, 'admin2', '2018-05-04 08:34:52', 'A', 0, 'Test 1', 1, 1),
(7, 'admin2', '2018-05-04 08:35:37', 'A', 30, 'Test 2', 2, 2),
(8, 'admin2', '2018-05-04 08:36:14', 'B', 30, 'Test 2', 2, 2),
(9, 'admin', '2018-05-04 08:36:28', 'B', 29, 'Test 1', 1, 1),
(10, 'admin', '2018-05-04 08:36:37', 'A', 31, 'test 1', 1, 1),
(11, 'admin', '2018-05-04 08:38:53', 'E', 31, 'test 2', 2, 2),
(12, 'wero', '2018-05-04 08:39:47', 'E', 31, 'Paletas', 23, 12),
(13, 'wero', '2018-05-04 08:40:09', 'E', 31, 'Paletas', 23, 12);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
