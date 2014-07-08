-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-07-2014 a las 21:42:56
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cv`
--
CREATE DATABASE IF NOT EXISTS `cv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cv`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `educations`
--

CREATE TABLE IF NOT EXISTS `educations` (
  `id_education` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `id_user` int(10) unsigned NOT NULL COMMENT 'User identifier',
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Title or name',
  `type` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Type of education (degree, curse, postgraduate...)',
  `centre` varchar(70) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Centre where the education was taken',
  `recap` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Small description',
  `date_start` date DEFAULT NULL COMMENT 'Date when the education started',
  `date_end` date DEFAULT NULL COMMENT 'Date when the education ended (if ended)',
  PRIMARY KEY (`id_education`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `educations`
--

INSERT INTO `educations` (`id_education`, `id_user`, `title`, `type`, `centre`, `recap`, `date_start`, `date_end`) VALUES
(1, 1, '3-years university degree - Computer Engineering', 'Degree', 'University of Murcia', '3-year university degree with a focus on Computer, Information Technologies and Software Engineering', '1998-09-01', '2003-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiences`
--

CREATE TABLE IF NOT EXISTS `experiences` (
  `id_experience` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `id_user` int(10) unsigned NOT NULL COMMENT 'User identifier',
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Title o a few words description',
  `position` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Position inside the company',
  `company` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Name of the company',
  `tasks` text CHARACTER SET utf8 COMMENT 'Tasks taken place during the experience',
  `skills` text CHARACTER SET utf8 COMMENT 'Skills learnt or improved during the experience',
  `examples` text CHARACTER SET utf8 COMMENT 'Examples to show about this experience',
  `date_start` date DEFAULT NULL COMMENT 'Date when the experience started',
  `date_end` date DEFAULT NULL COMMENT 'Date when the experience ended (if ended)',
  PRIMARY KEY (`id_experience`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `experiences`
--

INSERT INTO `experiences` (`id_experience`, `id_user`, `title`, `position`, `company`, `tasks`, `skills`, `examples`, `date_start`, `date_end`) VALUES
(1, 1, 'Web developer in MyCompra', 'PHP Developer', 'MyCompra', 'Developing the website of the company, a kind of social network for shopping. We developed the frontend, the backend and created the database.', 'PHP, Javascript, JSON, Ajax, CSS, HTML, jQuery, MySQL', 'www.mycompra.com', '2013-11-01', '0000-00-00'),
(2, 1, 'Web developer and Community Manager in Tretelco', 'PHP Developer', 'Tretelco', 'Creating and modifying web shops based on Prestashop and web sites based on WordPress, and developing the company''s web. Managing the company''s profiles in social networks and forums.\n', 'PHP, Javascript, CSS, HTML', NULL, '2012-06-01', '2013-11-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_info`
--

CREATE TABLE IF NOT EXISTS `personal_info` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User identifier',
  `name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Real name',
  `surname` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'Surname or surnames',
  `birth_country` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Country where the user was born',
  `birth_date` date NOT NULL COMMENT 'Date when the user was born',
  `birth_city` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'City where the user was born',
  `address_city` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'City where the user lives',
  `address_country` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Country where the user lives',
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'User picture',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `personal_info`
--

INSERT INTO `personal_info` (`id_user`, `name`, `surname`, `birth_country`, `birth_date`, `birth_city`, `address_city`, `address_country`, `image`) VALUES
(1, 'Fernando', 'Castellar Mendez', 'Spain', '1980-10-02', 'Lorca', 'Murcia', 'Spain', 'fcastellar.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User identifier',
  `alias` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'Alias or nickname to login',
  `password` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Password to login',
  `email` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Email for notifications',
  `type` enum('editor','reader') CHARACTER SET utf8 NOT NULL COMMENT 'Role (editor, reader)',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `alias`, `password`, `email`, `type`) VALUES
(1, 'dixons', 'ec3e661d7bc7bfbf5334e7dfad309f947dace5f7', 'nan.castellar@gmail.com', 'editor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
