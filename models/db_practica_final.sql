-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-05-2016 a las 19:29:53
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
-- Estructura de tabla para la tabla `product`
--

DROP TABLE IF EXISTS `product`;
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
  `usuari` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `stock`, `limit_date`, `image_path`, `views`, `URL`, `usuari`) VALUES
(1, 'nike bambas', 'bambas muy lindas', 49, 20, '2016-05-12', 'nike_prova.jpg', 32, 'nike-bambas', 'dasix'),
(2, 'nike bambas azules', 'bambas muy lindas y azules', 20, 3, '2016-05-27', 'nike_prova.jpg', 41, 'nike-bambas-azules', 'dasix'),
(52, 'new balance', 'new balance bonitas. \r\nGranates\r\nTalla 39.', 40, 39, '2016-05-31', 'new balance.jpg', 6, 'new-balance', 'jsirera'),
(53, 'bambas presioses', 'hboaho', 4, 985, '2016-05-16', 'new balance.jpg', 1, 'bambas-presioses', 'jud'),
(54, 'bhoah oq', 'hboshoa', 54, 56, '2016-05-25', 'new balance.jpg', 9, 'bhoah-oq', 'jud'),
(55, 'ab', 'gwrf', 5, 6, '2016-05-19', 'new balance.jpg', 0, 'ab', 'jsirera'),
(56, 'baoibao', 'hobhoba', 405, 58, '2016-05-17', 'new balance.jpg', 0, 'baoibao', 'jsirera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `user_sell` varchar(50) COLLATE latin1_bin NOT NULL,
  `user_buy` varchar(50) COLLATE latin1_bin NOT NULL,
  `product` varchar(50) COLLATE latin1_bin NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `purchase`
--

INSERT INTO `purchase` (`id`, `user_sell`, `user_buy`, `product`, `product_id`, `purchase_date`, `price`) VALUES
(35, 'dasix', 'jsirera', 'nike bambas azules', NULL, '2016-05-02', 20),
(36, 'dasix', 'jsirera', 'nike bambas azules', NULL, '2016-05-02', 20),
(37, 'dasix', 'jsirera', 'nike bambas azules', NULL, '2016-05-02', 20),
(38, 'dasix', 'jsirera', 'nike bambas azules', NULL, '2016-05-02', 20),
(39, 'dasix', 'jsirera', 'nike bambas azules', NULL, '2016-05-02', 20),
(40, 'pepito', 'jsirera', 'nike bambas azules', NULL, '2016-05-02', 20),
(41, 'dasix', 'jsirera', 'nike bambas azules', NULL, '2016-05-02', 20),
(42, 'dasix', 'jsirera', 'nike bambas', NULL, '2016-05-03', 49),
(43, 'dasix', 'jsirera', 'nike bambas', NULL, '2016-05-03', 49),
(44, 'dasix', 'jsirera', 'nike bambas', NULL, '2016-05-03', 49),
(45, 'dasix', 'jsirera', 'nike bambas', NULL, '2016-05-03', 49),
(46, 'dasix', 'jsirera', 'nike bambas', NULL, '2016-05-03', 49),
(47, 'dasix', 'jsirera', 'nike bambas', NULL, '2016-05-03', 49),
(48, 'dasix', 'jsirera', 'nike bambas', NULL, '2016-05-03', 49),
(49, 'dasix', 'jsirera', 'nike bambas azules', NULL, '2016-05-03', 20),
(50, 'dasix', 'jsirera', 'nike bambas azules', NULL, '2016-05-03', 20),
(51, 'dasix', 'adrively', 'nike bambas azules', NULL, '2016-05-03', 20),
(52, 'dasix', 'adrively', 'nike bambas azules', NULL, '2016-05-03', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuari`
--

DROP TABLE IF EXISTS `usuari`;
CREATE TABLE `usuari` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE latin1_bin NOT NULL,
  `email` varchar(100) COLLATE latin1_bin NOT NULL,
  `password` varchar(11) COLLATE latin1_bin NOT NULL,
  `u_twitter` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `image_path` varchar(100) COLLATE latin1_bin NOT NULL DEFAULT 'user_default.jpg',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `success` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Volcado de datos para la tabla `usuari`
--

INSERT INTO `usuari` (`id_user`, `username`, `email`, `password`, `u_twitter`, `image_path`, `isActive`, `money`, `success`) VALUES
(51, 'adrively', 'adrianvr1995@yahoo.es', 'hola123', '@adrively', 'user_default.jpg', 1, 110, 0),
(49, 'dasix', 'dasix.98@gmail.com', 'lavevafea', NULL, 'user_default.jpg', 1, 792, 3.44828),
(47, 'jsirera', 'judsirera@gmail.com', 'judloading', NULL, 'user_default.jpg', 1, 463, 0.166667),
(59, 'jud', 'judithsp95@hotmail.com', 'jud1234', NULL, 'jud.jpg', 0, 0, 0),
(1, 'lluisk', 'lluiscornella@hotmail.com', 'lluisk15', '@llcornella_95', 'user_default.jpg', 1, 0, 0),
(42, 'pinocho', 'pinocho@gmail.com', 'pipnocho', '@pesaos', 'user_default.jpg', 1, 41, 0),
(48, 'xavier sirera', 'sirera.javier@gmail.com', '123456', NULL, 'user_default.jpg', 1, 0, 0);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
