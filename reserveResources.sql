-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: mariadb:3306
-- Tiempo de generación: 09-11-2022 a las 12:40:36
-- Versión del servidor: 10.6.10-MariaDB
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reserveResources`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `idResources` int(10) UNSIGNED NOT NULL,
  `idTimeSlots` int(10) UNSIGNED NOT NULL,
  `idUsers` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`idResources`, `idTimeSlots`, `idUsers`, `date`, `remarks`) VALUES
(1, 2, 2, '2023-01-25', 'Reservo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE `resources` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(50) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `name`, `description`, `location`, `image`) VALUES
(1, 'Biblioteca1', 'Aula para estudiar o dar clase.', 'Primera planta, aula 16.', ''),
(2, 'Carrito de portátiles.', 'Carrito con diversos portátiles.', 'Segunda planta, Aula 21.', 'https://th.bing.com/th/id/OIP.09DNCC4G_Eg0OftkXc-HCgHaHa?pid=ImgDet&rs=1'),
(19, 'Aula8', 'Aula de infromática', 'Primera planta', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `timeSlots`
--

CREATE TABLE `timeSlots` (
  `id` int(10) UNSIGNED NOT NULL,
  `dayOfWeek` varchar(20) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `timeSlots`
--

INSERT INTO `timeSlots` (`id`, `dayOfWeek`, `startTime`, `endTime`) VALUES
(2, 'Lunes', '08:05:00', '09:05:00'),
(4, 'Lunes', '09:05:00', '10:05:00'),
(5, 'Lunes', '10:05:00', '11:05:00'),
(6, 'Lunes', '11:35:00', '12:35:00'),
(7, 'Lunes', '12:35:00', '13:35:00'),
(9, 'Lunes', '13:35:00', '14:35:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `type` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `realname`, `type`) VALUES
(2, 'Juan', '1234', 'Juan Diego', 'admin'),
(3, 'Dani', '1234', 'Daniela', 'user'),
(6, 'Henry', '1234', 'Enrique', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`idResources`,`idTimeSlots`,`idUsers`);

--
-- Indices de la tabla `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `timeSlots`
--
ALTER TABLE `timeSlots`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `timeSlots`
--
ALTER TABLE `timeSlots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
