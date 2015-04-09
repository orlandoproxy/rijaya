-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2015 a las 02:59:05
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pdv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
`id_empleado` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
`id_productos` int(11) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `imagen` text NOT NULL,
  `precio` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE IF NOT EXISTS `sucursales` (
`id_sucursal` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telempleados`
--

CREATE TABLE IF NOT EXISTS `telempleados` (
  `telefono` varchar(20) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telesucursales`
--

CREATE TABLE IF NOT EXISTS `telesucursales` (
  `telefono` varchar(20) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `activador` int(11) NOT NULL,
  `numsuc` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `activador`, `numsuc`) VALUES
(1, 'paco', '12345', 1, 5),
(2, 'pepe', '123456', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `num_venta` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_productos` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `costo` double NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
 ADD PRIMARY KEY (`id_empleado`), ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`id_productos`), ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
 ADD PRIMARY KEY (`id_sucursal`), ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `telempleados`
--
ALTER TABLE `telempleados`
 ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `telesucursales`
--
ALTER TABLE `telesucursales`
 ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
 ADD KEY `id_empleado` (`id_empleado`,`id_productos`,`id_sucursal`), ADD KEY `id_productos` (`id_productos`), ADD KEY `id_sucursal` (`id_sucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sucursales`
--
ALTER TABLE `sucursales`
ADD CONSTRAINT `sucursales_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `telempleados`
--
ALTER TABLE `telempleados`
ADD CONSTRAINT `telempleados_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `telesucursales`
--
ALTER TABLE `telesucursales`
ADD CONSTRAINT `telesucursales_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON UPDATE CASCADE,
ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_productos`) ON UPDATE CASCADE,
ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
