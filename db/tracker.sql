-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-11-2012 a las 00:28:34
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tracker`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `fecha_estimado` timestamp NULL DEFAULT NULL,
  `fecha_finalizado` timestamp NULL DEFAULT NULL,
  `completo` int(11) NOT NULL DEFAULT '0',
  `fecha_creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `nombre`, `fecha_estimado`, `fecha_finalizado`, `completo`, `fecha_creado`) VALUES
(1, 'Hacer pagina besysoft', '2012-11-22 03:00:00', '2012-11-09 02:31:34', 1, '2012-11-07 01:25:47'),
(2, 'hacer sistema basado en web services.', '2012-11-13 03:00:00', NULL, 0, '2012-11-07 01:25:47'),
(3, 'hacer caca', '2012-11-09 03:09:57', NULL, 0, '2012-11-08 23:09:57'),
(4, 'hacer caca', '2012-11-09 03:10:09', NULL, 0, '2012-11-08 23:10:09'),
(5, 'hacer caca', '2012-11-09 03:10:53', '2012-11-09 03:14:42', 1, '2012-11-08 23:10:53'),
(6, 'hacer caca', '2012-11-09 03:12:47', NULL, 0, '2012-11-08 23:12:47'),
(7, 'hacer caca', '2012-11-09 03:14:28', NULL, 0, '2012-11-08 23:14:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
