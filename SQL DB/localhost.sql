-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-07-2015 a las 03:01:02
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `videoslink`
--
/*CREATE DATABASE `videoslink` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `videoslink`;
*/
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_post`
--

CREATE TABLE IF NOT EXISTS `comentarios_post` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_post` int(10) NOT NULL,
  `id_autor` int(10) NOT NULL,
  `comentario` varchar(10000) NOT NULL,
  `fecha_comentario` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `comentarios_post`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_post` int(10) NOT NULL,
  `id_usuario_guardar` int(10) NOT NULL,
  `fecha_guardar` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `favoritos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_privados`
--

CREATE TABLE IF NOT EXISTS `mensajes_privados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `contenido` varchar(10000) NOT NULL,
  `id_remitente` int(10) NOT NULL,
  `id_destinatario` int(10) NOT NULL,
  `fecha_envio` datetime NOT NULL,
  `estado_leido` varchar(25) NOT NULL,
  `borrado_remitente` varchar(25) NOT NULL,
  `borrado_destinatario` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `mensajes_privados`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_video`
--

CREATE TABLE IF NOT EXISTS `post_video` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `url_video` varchar(200) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `id_autor` int(10) NOT NULL,
  `autor_post` varchar(50) NOT NULL,
  `autor_original` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `estado_post` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `post_video`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_usuarios`
--

CREATE TABLE IF NOT EXISTS `registro_usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nivel_usuario` varchar(20) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `fecha_registro` date NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `codigo_registro` varchar(50) NOT NULL,
  `estado_registro` varchar(20) NOT NULL,
  `estado_cuenta` varchar(20) NOT NULL,
  `online` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `registro_usuarios`
--

