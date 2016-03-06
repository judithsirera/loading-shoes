-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-03-2016 a las 16:56:02
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_instruments`
--
CREATE DATABASE IF NOT EXISTS `db_instruments` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_instruments`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instrument`
--

DROP TABLE IF EXISTS `instrument`;
CREATE TABLE IF NOT EXISTS `instrument` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `url` varchar(2000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `instrument`
--

INSERT INTO `instrument` (`id`, `name`, `type`, `url`) VALUES
(1, 'piano', 'Corda', 'http://www.indieorama.com/wp-content/uploads/2015/11/677.jpg'),
(2, 'flauta', 'Vent', 'http://fotos.imagenesdeposito.com/imagenes/f/flauta_de_madera_del_peru-24143.jpg'),
(3, 'piano', 'Corda', 'http://www.indieorama.com/wp-content/uploads/2015/11/677.jpg'),
(4, 'triangle', 'Percussio', 'https://upload.wikimedia.org/wikipedia/commons/c/c6/Triangle_instrument.png'),
(5, 'violi', 'Corda', 'http://eduwiki.cat/images/Violin.jpg'),
(6, 'timbal', 'Percussio', 'http://www.jugarijugar.com/410-1313-thickbox/timbal-de-pell.jpg'),
(7, 'Guitarra', 'Electronic', 'https://escuelahispanicademusica.files.wordpress.com/2010/08/guitarra_electrica.jpg'),
(8, 'arpa', 'Corda', 'https://www.espaciodemusicalaclave.com/wp-content/uploads/2013/05/arpa.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `instrument`
--
ALTER TABLE `instrument`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instrument`
--
ALTER TABLE `instrument`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
