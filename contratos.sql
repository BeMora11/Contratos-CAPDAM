-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2021 a las 18:34:47
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contratos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratacion`
--

CREATE TABLE `contratacion` (
  `id_contratacion` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `delegacion` int(11) NOT NULL,
  `derecho_posesion` varchar(50) NOT NULL,
  `predial` varchar(50) NOT NULL,
  `ine` varchar(50) NOT NULL,
  `curp` varchar(50) NOT NULL,
  `vocacion_uso` varchar(50) DEFAULT NULL,
  `fachada` varchar(50) NOT NULL,
  `tipo_contrato` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL,
  `fecha_solicitud` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id_cotizacion` int(11) NOT NULL,
  `contrato` int(11) NOT NULL,
  `cotizacion` varchar(120) NOT NULL,
  `fecha_cotizado` datetime NOT NULL,
  `estatus_cotizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delegaciones`
--

CREATE TABLE `delegaciones` (
  `id_delegacion` int(11) NOT NULL,
  `delegacion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `delegaciones`
--

INSERT INTO `delegaciones` (`id_delegacion`, `delegacion`) VALUES
(1, 'Santiago'),
(2, 'Valle de las Garzas'),
(3, 'Manzanillo centro'),
(4, 'Salagua'),
(5, 'Las Brisas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `rol` int(11) NOT NULL,
  `delegacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `correo`, `password`, `rol`, `delegacion`) VALUES
(9, 'admin@capdam.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, NULL),
(17, 'recepcionista', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, NULL),
(20, 'jefe', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1),
(21, 'jefe2@corrreo.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contratacion`
--
ALTER TABLE `contratacion`
  ADD PRIMARY KEY (`id_contratacion`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id_cotizacion`);

--
-- Indices de la tabla `delegaciones`
--
ALTER TABLE `delegaciones`
  ADD PRIMARY KEY (`id_delegacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contratacion`
--
ALTER TABLE `contratacion`
  MODIFY `id_contratacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id_cotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `delegaciones`
--
ALTER TABLE `delegaciones`
  MODIFY `id_delegacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
