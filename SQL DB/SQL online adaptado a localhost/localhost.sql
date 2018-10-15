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
CREATE DATABASE `videoslink` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `videoslink`;

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

INSERT INTO `comentarios_post` (`id`, `id_post`, `id_autor`, `comentario`, `fecha_comentario`) VALUES
(1, 4, 2, '<p>Es una distro basada en ubuntu</p>', '2015-09-18 19:53:21'),
(2, 6, 2, '<p>Lorem ipsum dolor sit amet, in solum moderatius nec, ne vix placerat petentium scripserit, usu debitis indoctum hendrerit cu. Ex sed omnis mollis salutatus. Munere copiosae corrumpit eum in. Eum ut autem volutpat iracundia, id sit amet debet noster</p>', '2015-09-18 20:10:29'),
(3, 6, 2, '<p>&nbsp;</p>\r\n<p><em>Minim aperiri ut vix, ex iusto feugait vix. Ei omnes rationibus eos. Noster consequat eam cu, sed dico vero legimus ei. Te facete blandit moderatius qui, usu ad prima dicit, vitae electram eum id. Exerci corpora et sit, cu per tale omnesque.</em></p>', '2015-09-18 20:10:59'),
(4, 6, 1, '<p>Nam id ferri causae scribentur, no libris similique consetetur cum. An qui idque augue dolorum. Ludus ceteros hendrerit duo ne, id soleat mandamus v</p>', '2015-09-18 20:13:37'),
(5, 1, 2, '<p>Nam id ferri causae scribentur, no libris similique consetetur cum. An qui idque augue dolorum. Ludus ceteros hendrerit duo ne, id soleat mandamus v</p>', '2015-09-18 20:16:23');

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

INSERT INTO `favoritos` (`id`, `id_post`, `id_usuario_guardar`, `fecha_guardar`) VALUES
(1, 4, 2, '2015-09-18'),
(2, 6, 1, '2015-09-18'),
(3, 1, 2, '2015-09-18');

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

INSERT INTO `mensajes_privados` (`id`, `titulo`, `contenido`, `id_remitente`, `id_destinatario`, `fecha_envio`, `estado_leido`, `borrado_remitente`, `borrado_destinatario`) VALUES
(1, 'mensaje de prueba', '<p><strong><em>Lorem ipsum dolor sit amet, in solum moderatius nec, ne vix placerat petentium scripserit, usu debitis indoctum hendrerit cu. Ex sed omnis mollis salutatus. Munere copiosae corrumpit eum in. Eum ut autem volutpat iracundia, id sit amet debet noster</em></strong></p>', 2, 1, '2015-09-18 07:05:06', 'si', 'no', 'no'),
(2, 'Lorem ipsum', '<p>Lorem ipsum dolor sit amet, in solum moderatius nec, ne vix placerat petentium scripserit, usu debitis indoctum hendrerit cu. Ex sed omnis mollis salutatus. Munere copiosae corrumpit eum in. Eum ut autem volutpat iracundia, id sit amet debet noster. Sensibus similique comprehensam quo et. Omnesque fabellas eleifend pro ut, natum sanctus vel ne.</p>', 1, 2, '2015-09-18 07:12:35', 'no', 'no', 'no');

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

INSERT INTO `post_video` (`id`, `titulo`, `url_video`, `descripcion`, `tags`, `id_autor`, `autor_post`, `autor_original`, `categoria`, `fecha_creacion`, `estado_post`) VALUES
(1, 'Gol de Di Maria a Suiza', 'http://www.youtube.com/v/g5Ku64cTSvU', '', 'argentina,suiza,gol,mundial,2014', 1, 'pablo', 'Fútbol Para Todos', 'Deportes', '2015-09-17', 'visible'),
(2, 'Colombia vs Uruguay 2014', 'http://www.youtube.com/v/NypTfw5sJ3g', '<p>Gol de James Rodrigueaz a Uruguay en el mundial de Brasil</p>', 'gol,james,colombia,2014,uruguay', 1, 'pablo', 'Fútbol Para Todos', 'Deportes', '2015-09-17', 'visible'),
(3, 'Ya no estas - Las Pelotas', 'http://www.youtube.com/v/6R8sX9Vu5Ls', '', 'las,pelotas,ya,no,estas', 1, 'pablo', 'russoterco', 'Musica', '2015-09-17', 'visible'),
(4, 'Lubuntu 15.04 novedades', 'http://www.youtube.com/v/9MYjFC6VUmM', '', 'lubuntu,1504,linux,novedades,distribucion', 1, 'pablo', 'Linux Scoop', 'Varios', '2015-09-17', 'visible'),
(5, 'PES 2016', 'http://www.youtube.com/v/vCp5JLnd1Eo', '', 'pes,2016,futbol,juego,pc', 2, 'juanperez', 'EurogamerPortugal', 'Juegos', '2015-09-18', 'visible'),
(6, 'El secreto de sus ojos', 'http://www.youtube.com/v/GcHkTSqeGoU', '<p><span style="color: #333333; font-family: Roboto, arial, sans-serif; font-size: 13px; line-height: 17px;">Sinopsis:&nbsp;</span><br style="color: #333333; font-family: Roboto, arial, sans-serif; font-size: 13px; line-height: 17px;" /><span style="color: #333333; font-family: Roboto, arial, sans-serif; font-size: 13px; line-height: 17px;">Benjam&iacute;n Esp&oacute;sito acaba de jubilarse despu&eacute;s de trabajar toda una vida como empleado en un Juzgado Penal. Para ocupar su tiempo libre decide escribir una novela, basada en una historia real de la que ha sido testigo y protagonista.</span></p>', 'el,secreto,de,sus,ojos', 2, 'juanperez', 'elsecretodesusojos', 'Peliculas', '2015-09-18', 'visible');

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
INSERT INTO `registro_usuarios` (`id`, `nivel_usuario`, `usuario`, `clave`, `email`, `nombre`, `apellido`, `fecha_nacimiento`, `sexo`, `pais`, `fecha_registro`, `avatar`, `codigo_registro`, `estado_registro`, `estado_cuenta`, `online`) VALUES
(1, 'administrador', 'pablo', 'argentina', 'pablomanuelcoronel@gmail.com', 'pablo', 'coronel', '1991-06-17', 'm', 'Argentina', '2015-08-23', 'imagenes/avatar/avatar_default.jpg', '3nt84z3m', 'finalizado', 'habilitado', 'no'),
(2, 'usuario', 'juanperez', 'juanperez', 'webvideosusuario@gmail.com', 'juan', 'perez', '1994-08-16', 'm', 'Australia', '2015-08-23', 'imagenes/avatar/avatar_default.jpg', '4nllto38', 'finalizado', 'habilitado', 'no');

