-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-05-2016 a las 21:31:31
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_practica_final`
--
CREATE DATABASE IF NOT EXISTS `db_practica_final` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE `db_practica_final`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `subject` varchar(300) COLLATE latin1_bin DEFAULT NULL,
  `text` varchar(3000) COLLATE latin1_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `from_user` varchar(50) COLLATE latin1_bin NOT NULL,
  `to_user` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id_comment`, `subject`, `text`, `date`, `from_user`, `to_user`) VALUES
(1, 'guapa', '<p>hoahaob</p>', '2016-05-11', 'jsirera', 'jud'),
(5, 'Guapa editat', '<p>BNAOHBOA</p>', '2016-05-12', 'juju', 'jsirera'),
(6, 'se rompen', '', '2016-05-13', 'eluskie', 'jsirera'),
(9, 'hello', '<p>hello</p>', '2016-05-15', 'jsirera', 'dasix');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE latin1_bin NOT NULL,
  `description` varchar(500) COLLATE latin1_bin NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '1',
  `limit_date` date DEFAULT NULL,
  `image_path` varchar(100) COLLATE latin1_bin NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `URL` varchar(100) COLLATE latin1_bin NOT NULL,
  `last_URL` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `usuari` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `stock`, `limit_date`, `image_path`, `views`, `URL`, `last_URL`, `usuari`) VALUES
(1, 'nike bambas', 'bambas muy lindas', 49, 20, '2016-05-12', 'nike_prova.jpg', 33, 'nike-bambas', NULL, 'dasix'),
(2, 'nike bambas azules', 'bambas muy lindas y azules', 20, 0, '2016-05-27', 'nike_prova.jpg', 47, 'nike-bambas-azules', NULL, 'dasix'),
(76, 'Nike bonitas', '<p>jejejeje ja funciona</p>', 45, 45, '2016-05-17', 'nike_prova.jpg', 15, 'Nike-bonitas', NULL, 'jsirera'),
(77, 'Guitarrista/Cantant', '<p>Bla&nbsp;<strong>wrrn</strong></p>', 4, 12, '2016-05-10', 'IMG_0021.JPG', 0, 'Guitarrista/Cantant', NULL, 'jud'),
(79, 'Victoria editat 4', '<p>Estic provant la practica</p>', 23, 0, '2016-05-27', 'victoria.gif', 13, 'Victoria-editat-4', 'Victoria-editat-2', 'juju'),
(83, 'prova 4 45', '<p>jboahboa</p>', 34, 2, '2016-05-28', 'user_default.png', 25, 'prova-4-45', NULL, 'juju'),
(87, 'prova 4', '<p>jboahboa</p>', 34, -2, '2016-05-30', 'victoria.gif', 16, 'prova-4', NULL, 'juju'),
(89, 'gaga', '<p>dagag</p>', 3, 4, '1970-01-01', 'user_default.png', 10, 'gaga', NULL, 'jsirera'),
(90, 'victoria bonitas', '<p>hoabhoahgoa hagohboaho afhoahgoa</p>', 34, 2, '1970-01-01', 'victoria.gif', 2, 'victoria-bonitas', NULL, 'jsirera'),
(91, 'emoji', '<p>baohboad</p>', 3, 3, '1970-01-01', 'emoji.jpg', 1, 'emoji', NULL, 'jsirera'),
(92, 'eree', '<p>rgg</p>', 4, 3, '2016-05-31', 'victoria.gif', 2, 'eree', NULL, 'jsirera'),
(93, 'Victoria', '<p><span style="text-decoration: underline;"><strong>Victoria de tots colors de la imatge.</strong></span></p>\r\n<p><span style="text-decoration: underline;">Talles</span>: 38 / 39 / 40</p>', 23, 1, '2016-05-31', 'victoria.gif', 3, 'Victoria', NULL, 'jsirera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `user_sell` varchar(50) COLLATE latin1_bin NOT NULL,
  `user_buy` varchar(50) COLLATE latin1_bin NOT NULL,
  `product` varchar(50) COLLATE latin1_bin NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `purchase`
--

INSERT INTO `purchase` (`id`, `user_sell`, `user_buy`, `product`, `product_id`, `purchase_date`, `price`) VALUES
(53, 'jud', 'jsirera', 'prova2', 71, '2016-05-09', 23),
(54, 'dasix', 'jud', 'nike bambas azules', 2, '2016-05-09', 20),
(55, 'jsirera', 'juju', 'Victoria', 75, '2016-05-11', 34),
(56, 'jsirera', 'eluskie', 'prova1', 70, '2016-05-13', 23),
(57, 'dasix', 'jsirera', 'nike bambas azules', 2, '2016-05-14', 20),
(58, 'dasix', 'jsirera', 'nike bambas azules', 2, '2016-05-14', 20),
(59, 'juju', 'jsirera', 'Victoria editat 4', 79, '2016-05-15', 23),
(60, 'juju', 'jsirera', 'prova 4', 87, '2016-05-15', 34),
(61, 'juju', 'jsirera', 'prova 4', 87, '2016-05-15', 34),
(62, 'juju', 'jsirera', 'prova 4', 87, '2016-05-15', 34),
(63, 'juju', 'jsirera', 'prova 4', 87, '2016-05-15', 34),
(64, 'juju', 'jsirera', 'prova 4', 87, '2016-05-15', 34),
(65, 'juju', 'jsirera', 'prova 4 45', 83, '2016-05-15', 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuari`
--

CREATE TABLE `usuari` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE latin1_bin NOT NULL,
  `email` varchar(100) COLLATE latin1_bin NOT NULL,
  `password` varchar(100) COLLATE latin1_bin NOT NULL,
  `u_twitter` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `image_path` varchar(100) COLLATE latin1_bin NOT NULL DEFAULT 'user_default.png',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `success` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `usuari`
--

INSERT INTO `usuari` (`id_user`, `username`, `email`, `password`, `u_twitter`, `image_path`, `isActive`, `money`, `success`) VALUES
(51, 'adrively', 'adrianvr1995@yahoo.es', 'hola123', '@adrively', 'user_default.png', 1, 110, 0),
(62, 'alex', 'alex@hotmail.com', 'hola1234', NULL, 'alex.png', 0, 0, 0),
(49, 'dasix', 'dasix.98@gmail.com', 'lavevafea', NULL, 'user_default.png', 1, 852, 4.16667),
(65, 'eluskie', 'gerardmt22@gmail.com', '$2y$10$l2colfD2BFzeXCqSJEqLAuG66cv0XP3NIzmD/mfSlI24Xpk.tALri', '@hola', 'eluskie.JPG', 1, 88, 0),
(63, 'hola', 'hola@gmail.com', '$2y$10$cGu270LZeYDMLNyaMXM6Q.7j37v3lsV18FZQEWFCtNyx/dOcgfiGq', NULL, 'user_default.png', 1, 0, 0),
(70, 'jsirera', 'judsirera@gmail.com', '$2y$10$WKA95LXZFD2Gz53N0JiI9uMMt4CFmpuxHwNWGTSxpWd34Bb/4preC', NULL, 'user_default.png', 1, 727, 0),
(69, 'jud', 'judithsp95@hotmail.com', '$2y$10$I5RvfwijNmzNbKjDZq04QuNIBRJJa9.Hyr9/wejS0CR0FkIWOqRyG', NULL, 'user_default.png', 1, 0, 0),
(64, 'juju', 'juju@gmail.com', '$2y$10$3xovs6qnRbSawgWc3fQps.OHT640KV8Yuj95lOjxEQSePFRLx41aW', NULL, 'juju.gif', 1, 354, 1.12903),
(1, 'lluisk', 'lluiscornella@hotmail.com', 'lluisk15', '@llcornella_95', 'user_default.png', 1, 0, 0),
(67, 'lolo', 'lolo@gmail.com', '$2y$10$SGUTcFzYNkssPbM2sckLuO.YvLNRqtKOmzlYmn0oYGEGJTEnHYQVW', NULL, 'user_default.png', 0, 0, 0),
(68, 'ok', 'ok@gmail.com', '$2y$10$2eHXB7JTo1mxrqR1ZNotAOXfnNEEf7/ZzCT3AVTNA9AUS2S4mgI0q', NULL, 'user_default.png', 0, 0, 0),
(42, 'pinocho', 'pinocho@gmail.com', 'pipnocho', '@pesaos', 'user_default.png', 1, 41, 0),
(48, 'xavier sirera', 'sirera.javier@gmail.com', '123456', NULL, 'user_default.png', 1, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
