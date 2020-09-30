-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2018 a las 10:03:22
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `florart`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
`id` int(7) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Clave` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `Nombre`, `Clave`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'borja', '758af45d6ed1c16c9e60e5d1a20f1850');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `CodigoCat` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CodigoCat`, `Nombre`, `Descripcion`) VALUES
('001', 'colección invierno', 'especial invierno'),
('002', 'colección primavera', 'especial primavera'),
('003', 'colección verano', 'especial verano'),
('004', 'colección otoño', 'especial otoño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `NIT` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `NombreCompleto` varchar(70) NOT NULL,
  `Apellido` varchar(70) NOT NULL,
  `Clave` text NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`NIT`, `Nombre`, `NombreCompleto`, `Apellido`, `Clave`, `Direccion`, `Telefono`, `Email`) VALUES
('123', '123', 'a', 'a', '202cb962ac59075b964b07152d234b70', '123', '123', 'a@a.es'),
('3', 'a', 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', '1', 'a@a'),
('33', '3', 'tres', 'tres', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '3', '3', '3@e.es'),
('4', 'd', 'd', 'd', '8277e0910d750195b448797616e091ad', 'd', 'd', 'd@d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentabanco`
--

CREATE TABLE IF NOT EXISTS `cuentabanco` (
`id` int(50) NOT NULL,
  `NumeroCuenta` varchar(100) NOT NULL,
  `NombreBanco` varchar(100) NOT NULL,
  `NombreBeneficiario` varchar(100) NOT NULL,
  `TipoCuenta` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuentabanco`
--

INSERT INTO `cuentabanco` (`id`, `NumeroCuenta`, `NombreBanco`, `NombreBeneficiario`, `TipoCuenta`) VALUES
(1, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE IF NOT EXISTS `detalle` (
  `NumPedido` int(20) NOT NULL,
  `CodigoProd` varchar(30) NOT NULL,
  `CantidadProductos` int(20) NOT NULL,
  `PrecioProd` decimal(30,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`id` int(20) NOT NULL,
  `CodigoProd` varchar(30) NOT NULL,
  `NombreProd` varchar(30) NOT NULL,
  `CodigoCat` varchar(30) NOT NULL,
  `Precio` decimal(30,2) NOT NULL,
  `Modelo` varchar(30) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `Stock` int(20) NOT NULL,
  `NITProveedor` varchar(30) NOT NULL,
  `Imagen` varchar(150) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Estado` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `CodigoProd`, `NombreProd`, `CodigoCat`, `Precio`, `Modelo`, `Marca`, `Stock`, `NITProveedor`, `Imagen`, `Nombre`, `Estado`) VALUES
(14, '001', 'ALSACIA', '001', '85.00', 'INVIERNO', 'INVIERNO', 100, '1', '001.jpg', 'admin', 'Activo'),
(15, '002', 'SIROCO', '001', '64.00', 'INVIERNO', 'INVIERNO', 100, '1', '002.jpg', 'admin', 'Activo'),
(16, '003', 'INTENSO', '001', '101.00', 'INVIERNO', 'INVIERNO', 100, '1', '003.jpg', 'admin', 'Activo'),
(17, '004', 'EQUINOCCIO', '001', '57.50', 'INVIERNO', 'INVIERNO', 100, '1', '004.jpg', 'admin', 'Activo'),
(18, '005', 'CALATHEA', '001', '50.00', 'INVIERNO', 'INVIERNO', 100, '1', '005.jpg', 'admin', 'Activo'),
(19, '006', 'LORENA', '001', '49.01', 'INVIERNO', 'INVIERNO', 100, '1', '006.jpg', 'admin', 'Activo'),
(20, '007', 'DELICIA ROJA', '002', '34.90', 'PRIMAVERA', 'PRIMAVERA', 100, '1', '007.jpg', 'admin', 'Activo'),
(21, '008', 'ALEGRES BEGONIAS', '002', '25.90', 'PRIMAVERA', 'PRIMAVERA', 100, '1', '008.png', 'admin', 'Activo'),
(22, '009', 'ZAMIOCULCA', '002', '44.90', 'PRIMAVERA', 'PRIMAVERA', 100, '1', '009.jpg', 'admin', 'Activo'),
(23, '010', 'UN DIA SOLEADO', '002', '39.90', 'PRIMAVERA', 'PRIMAVERA', 100, '1', '010.png', 'admin', 'Activo'),
(24, '011', 'ALEGRIA', '002', '25.90', 'PRIMAVERA', 'PRIMAVERA', 100, '1', '011.png', 'admin', 'Activo'),
(25, '012', 'LAZO INDESTRUCTIBLE', '002', '100.90', 'PRIMAVERA', 'PRIMAVERA', 100, '1', '012.png', 'admin', 'Activo'),
(26, '013', 'ÍNDICO', '003', '44.65', 'VERANO', 'VERANO', 100, '1', '013.jpg', 'admin', 'Activo'),
(27, '014', 'CHAMAEDOREA', '003', '43.00', 'VERANO', 'VERANO', 100, '1', '014.jpg', 'admin', 'Activo'),
(28, '015', 'MERLOT', '003', '81.00', 'VERANO', 'VERANO', 100, '1', '015.jpg', 'admin', 'Activo'),
(29, '016', 'DESEO', '003', '39.90', 'VERANO', 'VERANO', 100, '1', '016.jpg', 'admin', 'Activo'),
(30, '017', 'TOSCANA', '003', '55.00', 'VERANO', 'VERANO', 100, '1', '017.jpg', 'admin', 'Activo'),
(31, '018', 'MALDIVAS', '003', '49.95', 'VERANO', 'VERANO', 100, '1', '018.jpg', 'admin', 'Activo'),
(32, '019', 'RÓDANO', '004', '39.50', 'OTOÑO', 'OTOÑO', 100, '1', '019.jpg', 'admin', 'Activo'),
(33, '020', 'NASSAU', '004', '49.50', 'OTOÑO', 'OTOÑO', 100, '1', '020.jpg', 'admin', 'Activo'),
(34, '021', 'ANTHURIUM', '004', '44.00', 'OTOÑO', 'OTOÑO', 100, '1', '021.jpg', 'admin', 'Activo'),
(35, '022', 'RECIFE', '004', '120.00', 'OTOÑO', 'OTOÑO', 100, '1', '022.jpg', 'admin', 'Activo'),
(36, '023', 'BROMELÍA', '004', '41.25', 'OTOÑO', 'OTOÑO', 100, '1', '023.jpg', 'admin', 'Activo'),
(37, '024', 'BORA BORA', '004', '64.00', 'OTOÑO', 'OTOÑO', 100, '1', '024.jpg', 'admin', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `NITProveedor` varchar(30) NOT NULL,
  `NombreProveedor` varchar(30) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `PaginaWeb` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`NITProveedor`, `NombreProveedor`, `Direccion`, `Telefono`, `PaginaWeb`) VALUES
('1', 'prov1', 'prov1', '123456789', 'http://ejemplo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
`NumPedido` int(20) NOT NULL,
  `Fecha` varchar(150) NOT NULL,
  `NIT` varchar(30) NOT NULL,
  `Descuento` int(20) NOT NULL,
  `TotalPagar` decimal(30,2) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `NumeroDeposito` varchar(50) NOT NULL,
  `Adjunto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`CodigoCat`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`NIT`);

--
-- Indices de la tabla `cuentabanco`
--
ALTER TABLE `cuentabanco`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
 ADD KEY `NumPedido` (`NumPedido`), ADD KEY `CodigoProd` (`CodigoProd`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`id`), ADD KEY `CodigoCat` (`CodigoCat`), ADD KEY `NITProveedor` (`NITProveedor`), ADD KEY `Agregado` (`Nombre`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
 ADD PRIMARY KEY (`NITProveedor`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
 ADD PRIMARY KEY (`NumPedido`), ADD KEY `NIT` (`NIT`), ADD KEY `NIT_2` (`NIT`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `cuentabanco`
--
ALTER TABLE `cuentabanco`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
MODIFY `NumPedido` int(20) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
ADD CONSTRAINT `detalle_ibfk_9` FOREIGN KEY (`NumPedido`) REFERENCES `venta` (`NumPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
ADD CONSTRAINT `producto_ibfk_7` FOREIGN KEY (`CodigoCat`) REFERENCES `categoria` (`CodigoCat`) ON UPDATE CASCADE,
ADD CONSTRAINT `producto_ibfk_8` FOREIGN KEY (`NITProveedor`) REFERENCES `proveedor` (`NITProveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`NIT`) REFERENCES `cliente` (`NIT`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
