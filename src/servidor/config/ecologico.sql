-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2024 a las 03:11:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotelecologico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `idhabitacion` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `categoria` enum('Estandar','Deluxe','Suite') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `disponibles` int(1) DEFAULT NULL,
  `numHabitaciones` int(11) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `costoPorNoche` int(11) NOT NULL,
  `capacidadDePersonas` int(11) DEFAULT NULL,
  `urlImagen` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='tabla de habitaciones del hotel';

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`idhabitacion`, `nombre`, `categoria`, `disponibles`, `numHabitaciones`, `descripcion`, `costoPorNoche`, `capacidadDePersonas`, `urlImagen`) VALUES
(1, 'Cascada Secreta', 'Deluxe', 1, 0, 'Habitación con ambiente de cascada, incluye sonidos relajantes de agua.', 2150, 3, 'cascada-secreta.jpg'),
(2, 'Ártico Blanco', 'Suite', 1, 0, 'Suite ambientada en el Ártico, con efectos de iluminación y una decoración minimalista y fresca.', 3900, 4, 'artico-blanco.jpg'),
(3, 'Santuario Marino', 'Estandar', 1, 0, 'Habitación con una decoración marina, con elementos de madera sostenible y vista a un estanque.', 1000, 1, 'santuario-marino.jpg'),
(4, 'Nido Tropical', 'Deluxe', 1, 0, 'Habitación de lujo con temática tropical, incluye jardín interior y plantas exóticas.', 1900, 2, 'nido-tropical.jpg'),
(5, 'Fuego Vivo', 'Suite', 1, 0, 'Suite inspirada en un volcán, con tonos cálidos y decoración con rocas naturales.', 4200, 4, 'fuego-vivo.jpg'),
(6, 'Desierto Vivo', 'Deluxe', 1, 0, 'Habitación con decoración inspirada en el desierto, con colores cálidos y plantas del clima árido.', 2000, 3, 'desierto-vivo.jpg'),
(7, 'Selva Mística', 'Suite', 1, 0, 'Suite con inspiración amazónica, amplio espacio verde y decoración temática de jungla.', 3500, 4, 'selva-mistica.jpg'),
(8, 'Refugio Verde', 'Estandar', 1, 0, 'Habitación con vista al jardín, decorada con materiales reciclados y productos ecológicos.', 1200, 2, 'refugio-verde.jpg'),
(9, 'Bambú Natural', 'Estandar', 1, 0, 'Habitación inspirada en el bambú, con un estilo rústico y sostenible.', 1300, 2, 'bambu-natural.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`idhabitacion`),
  ADD UNIQUE KEY `idhabitacion_UNIQUE` (`idhabitacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `idhabitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
