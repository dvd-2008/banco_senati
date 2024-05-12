-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2017 a las 11:28:48
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco_senati`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `n_cuenta` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `dni` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`n_cuenta`, `nombre`, `apellido`, `dni`) VALUES
(1001, 'daniel', 'calzada', '25805514'),
(1002, 'cecilia', 'arias', '09903285');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `cod_dep` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` int(11) NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `depositos`
--

INSERT INTO `depositos` (`cod_dep`, `fecha`, `monto`, `cliente`) VALUES
(1, '2017-02-01', 1000, 1001),
(2, '2017-02-02', 500, 1001),
(3, '2017-02-01', 2500, 1002),
(4, '2017-02-02', 500, 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_servicios`
--

CREATE TABLE `pago_servicios` (
  `cod_pag` int(11) NOT NULL,
  `concepto` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `monto` int(11) NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago_servicios`
--

INSERT INTO `pago_servicios` (`cod_pag`, `concepto`, `fecha`, `monto`, `cliente`) VALUES
(1, 'pago de telefono', '2017-02-20', 75, 1001),
(2, 'pago del agua', '2017-02-27', 95, 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `cod_ret` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` int(11) NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `retiros`
--

INSERT INTO `retiros` (`cod_ret`, `fecha`, `monto`, `cliente`) VALUES
(1, '2017-02-18', 100, 1001),
(2, '2017-02-25', 100, 1001),
(3, '2017-02-18', 500, 1002),
(4, '2017-02-25', 100, 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `password` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'obrero', 'obre'),
(2, 'empleado', 'emple');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`n_cuenta`);

--
-- Indices de la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`cod_dep`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `cliente_2` (`cliente`);

--
-- Indices de la tabla `pago_servicios`
--
ALTER TABLE `pago_servicios`
  ADD PRIMARY KEY (`cod_pag`),
  ADD KEY `cliente` (`cliente`);

--
-- Indices de la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD PRIMARY KEY (`cod_ret`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `cliente_2` (`cliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `cod_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `pago_servicios`
--
ALTER TABLE `pago_servicios`
  MODIFY `cod_pag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `cod_ret` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD CONSTRAINT `depositos_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`n_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago_servicios`
--
ALTER TABLE `pago_servicios`
  ADD CONSTRAINT `pago_servicios_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`n_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD CONSTRAINT `retiros_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`n_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
