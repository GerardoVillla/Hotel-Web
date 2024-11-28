-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2024 a las 06:56:38
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
-- Base de datos: `ecologico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `user` text NOT NULL,
  `contraseña` text NOT NULL,
  `rol` enum('administrador','cliente') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='tabla de clientes registrados';

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `user`, `contraseña`, `rol`) VALUES
(1, 'gera', 'qwerty', 'cliente'),
(6, 'juan', '123', 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesreservacion`
--

CREATE TABLE `detallesreservacion` (
  `idReserva` int(10) UNSIGNED NOT NULL,
  `formaDePago` enum('Credito','Debido','','') NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
(1, 'Cascada Secreta', 'Deluxe', 10, 20, 'Habitación con ambiente de cascada, incluye sonidos relajantes de agua.', 2150, 3, 'cascada-secreta.jpg'),
(2, 'Ártico Blanco', 'Suite', 1, 8, 'Suite ambientada en el Ártico, con efectos de iluminación y una decoración minimalista y fresca.', 3900, 4, 'artico-blanco.jpg'),
(3, 'Santuario Marino', 'Estandar', 1, 4, 'Habitación con una decoración marina, con elementos de madera sostenible y vista a un estanque.', 1000, 1, 'santuario-marino.jpg'),
(4, 'Nido Tropical', 'Deluxe', 1, 5, 'Habitación de lujo con temática tropical, incluye jardín interior y plantas exóticas.', 1900, 2, 'nido-tropical.jpg'),
(5, 'Fuego Vivo', 'Suite', 1, 5, 'Suite inspirada en un volcán, con tonos cálidos y decoración con rocas naturales.', 4200, 4, 'fuego-vivo.jpg'),
(6, 'Desierto Vivo', 'Deluxe', 1, 3, 'Habitación con decoración inspirada en el desierto, con colores cálidos y plantas del clima árido.', 2000, 3, 'desierto-vivo.jpg'),
(7, 'Selva Mística', 'Suite', 1, 8, 'Suite con inspiración amazónica, amplio espacio verde y decoración temática de jungla.', 3500, 4, 'selva-mistica.jpg'),
(8, 'Refugio Verde', 'Suite', 0, 3, 'Refugio Verde es un espacio único diseñado para aquellos que buscan lujo y tranquilidad en un entorno completamente natural. Esta suite combina un diseño ecológico con materiales sostenibles y una distribución espaciosa que incluye áreas de descanso.', 3400, 10, 'refugio-verde.jpg'),
(9, 'Bambú Natura', 'Deluxe', 1, 3, 'Ubicada en un entorno rodeado de la belleza natural del bambú, esta habitación ofrece un ambiente cálido y relajante ideal para desconectarse del ajetreo diario. Con grandes ventanales y una decoración minimalista inspirada en la naturaleza, Bambú Na', 2400, 2, 'bambu-natural.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `idReservacion` int(10) UNSIGNED NOT NULL,
  `idHabitacion` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `fechaReservacion` date DEFAULT NULL,
  `inicioEstadia` date DEFAULT NULL,
  `finEstadia` date DEFAULT NULL,
  `subtotal` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='tabla de reservaciones del hotel';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `detallesreservacion`
--
ALTER TABLE `detallesreservacion`
  ADD UNIQUE KEY `idReservaUnique` (`idReserva`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`idhabitacion`),
  ADD UNIQUE KEY `idhabitacion_UNIQUE` (`idhabitacion`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`idReservacion`),
  ADD KEY `idCliente_idx` (`idCliente`),
  ADD KEY `idHabitacion_idx` (`idHabitacion`),
  ADD KEY `idreservaciones_UNIQUE` (`idReservacion`) USING BTREE,
  ADD KEY `idReservacion` (`idReservacion`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `idhabitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `idReservacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD CONSTRAINT `idCliente` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idHabitacion` FOREIGN KEY (`idHabitacion`) REFERENCES `habitaciones` (`idhabitacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
