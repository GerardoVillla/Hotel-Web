-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2024 a las 04:57:09
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
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `user` text NOT NULL,
  `contraseña` text NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `rol` enum('administrador','cliente') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='tabla de clientes registrados';

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `user`, `contraseña`, `edad`, `rol`) VALUES
(1, 'gera', 'qwerty', 21, 'cliente'),
(2, 'Jhon', '12345', 83, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesreservacion`
--

CREATE TABLE `detallesreservacion` (
  `idReserva` int(10) UNSIGNED NOT NULL,
  `formaDePago` enum('Credito','Debido','','') NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detallesreservacion`
--

INSERT INTO `detallesreservacion` (`idReserva`, `formaDePago`, `total`) VALUES
(1, 'Credito', 4800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `idhabitacion` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `categoria` enum('estandar','deluxe','suite') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `disponibilidad` tinyint(1) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `costoPorNoche` int(11) NOT NULL,
  `capacidadDePersonas` int(11) DEFAULT NULL,
  `urlImagen` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='tabla de habitaciones del hotel';

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`idhabitacion`, `nombre`, `categoria`, `disponibilidad`, `descripcion`, `costoPorNoche`, `capacidadDePersonas`, `urlImagen`) VALUES
(1, 'Refugio Verde', 'estandar', 1, 'Habitación con vista al jardín, decorada con materiales reciclados y productos ecológicos.', 1200, 2, 'url_imagen_refugio_verde.jpg'),
(2, 'Bambú Natural', 'estandar', 1, 'Habitación inspirada en el bambú, con un estilo rústico y sostenible.', 1300, 2, 'url_imagen_bambu_natural.jpg'),
(3, 'Santuario Marino', 'estandar', 1, 'Habitación con una decoración marina, con elementos de madera sostenible y vista a un estanque.', 1000, 1, 'url_imagen_santuario_marino.jpg'),
(4, 'Nido Tropical', 'deluxe', 1, 'Habitación de lujo con temática tropical, incluye jardín interior y plantas exóticas.', 1900, 2, 'url_imagen_nido_tropical.jpg'),
(5, 'Cascada Secreta', 'deluxe', 1, 'Habitación con ambiente de cascada, incluye sonidos relajantes de agua.', 2150, 3, 'url_imagen_cascada_secreta.jpg'),
(6, 'Desierto Vivo', 'deluxe', 1, 'Habitación con decoración inspirada en el desierto, con colores cálidos y plantas del clima árido.', 2000, 3, 'url_imagen_desierto_vivo.jpg'),
(7, 'Selva Mística', 'suite', 1, 'Suite con inspiración amazónica, amplio espacio verde y decoración temática de jungla.', 3500, 4, 'url_imagen_selva_mistica.jpg'),
(8, 'Ártico Blanco', 'suite', 1, 'Suite ambientada en el Ártico, con efectos de iluminación y una decoración minimalista y fresca.', 3900, 4, 'url_imagen_artico_blanco.jpg'),
(9, 'Fuego Vivo', 'suite', 1, 'Suite inspirada en un volcán, con tonos cálidos y decoración con rocas naturales.', 4200, 4, 'url_imagen_fuego_vivo.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `idHabitacion` int(11) NOT NULL,
  `capacidadCuartos` int(11) DEFAULT NULL,
  `cuartosDisponibles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`idReservacion`, `idHabitacion`, `idCliente`, `fechaReservacion`, `inicioEstadia`, `finEstadia`, `subtotal`) VALUES
(0, 2, 1, '2024-11-05', '2024-11-08', '2024-11-12', 1300),
(1, 2, 1, '2024-11-05', '2024-11-08', '2024-11-12', 1300),
(1, 4, 1, '2024-11-05', '2024-11-12', '2024-11-15', 3500);

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
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD KEY `idHabitacion_idx` (`idHabitacion`),
  ADD KEY `idHabitacion_idx_hotel` (`idHabitacion`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD KEY `idCliente_idx` (`idCliente`),
  ADD KEY `idHabitacion_idx` (`idHabitacion`),
  ADD KEY `idreservaciones_UNIQUE` (`idReservacion`) USING BTREE,
  ADD KEY `idReservacion` (`idReservacion`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `idhabitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
