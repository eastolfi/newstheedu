-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2018 a las 20:32:19
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `theedunews`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletin`
--

CREATE TABLE IF NOT EXISTS `boletin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `okPelis` tinyint(1) NOT NULL DEFAULT '0',
  `okLibros` tinyint(1) NOT NULL DEFAULT '0',
  `activa` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `boletin`
--

INSERT INTO `boletin` (`id`, `email`, `fechaAlta`, `okPelis`, `okLibros`, `activa`) VALUES
(1, 'ed@as.com', '2018-09-17 18:33:47', 0, 1, 1),
(2, 'ed2@as.com', '2018-09-17 18:40:59', 1, 1, 1),
(3, 'ed@as2.com', '2018-09-18 06:33:29', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `idComentario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idNoticia` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Comentario` text COLLATE utf8_spanish_ci,
  `Valoracion` int(11) DEFAULT NULL,
  `FechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Aprobado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idComentario`),
  UNIQUE KEY `idComentario` (`idComentario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `idNoticia`, `idUsuario`, `Comentario`, `Valoracion`, `FechaAlta`, `Aprobado`) VALUES
(5, 1, 20, 'Es una novela que juega muy bien con las paradojas que se van sucediendo.', 5, '2018-07-17 22:00:00', 1),
(6, 4, 20, 'Me ha gustado', 4, '0000-00-00 00:00:00', 1),
(7, 4, 20, 'Y a mi más', 5, '2018-09-17 19:54:51', 1),
(8, 2, 20, 'Es un proyecto casero divertido y alocado que es por una parte una película de actuaciones y por otra una agradable y agitada ensoñación (...) No es para todo el mundo, pero no necesita serlo.', 5, '2018-09-18 11:37:21', 1),
(9, 3, 20, 'Debo resaltar con qué maestría se nos muestra la evolución que sufre el Viajero: conforme va interiorizando la sociedad "medieval", su personalidad se vuelve más retorcidamente egocéntrica. ', 4, '2018-09-18 14:05:49', 1),
(10, 3, 20, 'Defectos, pocos. Quizá una sociedad excesivamente evolucionada para la época escogida (aunque con avances ingeniosos y científicamente explicados), y un comienzo un poco lento (probablemente con el afán de situar al lector).', 3, '2018-09-18 14:17:41', 1),
(11, 3, 20, 'Debo decir que para mí esta novela marcó un antes y un después en mi manera de entender la ciencia-ficción, entendiendo que incluso los argumentos más genuinamente reconocibles del género podían desembocar en aguas aún sin transitar', 3, '2018-09-18 14:26:58', 1),
(12, 1, 20, 'Me ha parecido un poco ñoña', 1, '2018-09-19 17:57:21', 1),
(20, 8, 20, 'Una buena novela erotica transtemporal', 1, '2018-09-19 20:37:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `IdNoticia` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `IdCategoria` int(11) NOT NULL,
  `Titulo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `TituloOriginal` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Ano` int(11) DEFAULT NULL,
  `Resumen` text COLLATE utf8_spanish_ci,
  `ImagenUrl` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `MetaAutor` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `MetaEditorial` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `MetaDirector` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `MetaProtagonistas` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Valoracion` decimal(11,1) DEFAULT NULL,
  `Visitas` int(11) DEFAULT NULL,
  `FechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaCaducidad` timestamp NOT NULL DEFAULT '2024-12-31 23:00:00',
  `FechaRevision` date NOT NULL,
  `Aprobado` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdNoticia`),
  UNIQUE KEY `IdNoticia` (`IdNoticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`IdNoticia`, `IdCategoria`, `Titulo`, `TituloOriginal`, `Ano`, `Resumen`, `ImagenUrl`, `MetaAutor`, `MetaEditorial`, `MetaDirector`, `MetaProtagonistas`, `Valoracion`, `Visitas`, `FechaAlta`, `FechaCaducidad`, `FechaRevision`, `Aprobado`) VALUES
(1, 1, 'La Viajera del Tiempo (2ª parte)', 'La Viajera del Tiempo', 2017, 'Un viaje a través del tiempo sorprendente, una historia inolvidable que te atrapará de principio a fin. «-¿Qué es el amor? Le preguntó una niña de cinco años a su hermano mayor. Y él le respondió: -El amor es cuando tú me robas cada día mi trozo de chocolate del almuerzo y yo, aún así, sigo dejándolo en el mismo sitio para ti todos los días». William y Lía son hermanos. Almas gemelas. Una infancia difícil ha hecho que William y Lía dependan el uno del otro desde siempre. Todo cambia cuando William desaparece sin dejar rastro, el mismo día en el que entierran a su madre en el año 2007. Nadie sabe qué es lo que ha podido suceder, ni siquiera Lía, convertida ya en una abogada de éxito. Cinco años más tarde, cuando Lía entra por casualidad en una galería de arte neoyorquina en la que exponen retratos de escritores y pintores de principios del siglo XIX, descubre en uno de ellos el rostro de su hermano William. En la placa, un seudónimo: ESCORPIÓN, un misterioso escritor cuyas obras fueron publicadas entre 1808 y 1813. Un maravilloso y mágico descubrimiento hará que Lía se convierta en una viajera del tiempo, con la esperanza de encontrar a su hermano en el pasado y traerlo de vuelta a casa. Una mágica historia sobre el amor y la esperanza. Los recuerdos y el destino. Secretos y Misterio. Descubrimientos fortuitos. Vidas memorables más allá del tiempo y su caprichoso sino.', '/imagenes/noticias/lore2.jpg', 'Lorena Franco', 'Versión Kindle', NULL, NULL, '3.0', 18, '2018-09-18 20:16:06', '2025-10-30 23:00:00', '0000-00-00', 1),
(2, 2, 'Paradox', 'Paradox', 2016, 'Un científico, parte de un equipo que investiga los viajes en el tiempo, consigue adelantarse una hora y al volver, trae noticias impactantes.', '/imagenes/noticias/paradox.jpg', '', NULL, 'Michael Hurst', 'Zoë Bell,  Malik Yoba,  Adam Huss', '5.0', 17, '2018-03-18 21:17:52', '0000-00-00 00:00:00', '0000-00-00', 1),
(3, 1, 'Las máscaras del tiempo', 'The Mask Of Time', 1968, 'Es la tarde del día de Navidad cuando Vornan-19 cae del cielo y aterriza, completamente desnudo, en las escaleras de la Plaza de España de Roma. Es el año 1999. El siglo está a punto de cambiar, y el mundo se halla al borde de la histeria de masas, aferrado por apocalípticas visiones de la inminente condenación del Hombre. ', '/imagenes/noticias/mascaras.jpg', 'Robert Silverberg', 'Ultramar', NULL, NULL, '3.3', 14, '2017-12-18 21:14:51', '2025-12-30 23:00:00', '0000-00-00', 1),
(4, 1, 'Placer en París', 'Naughty Paris', 2009, 'Autumn Maguire se siente triste después de haber sido abandonada por su prometido. Así que para sentirse mejor, decide aprovechar los billetes de la luna de miel con destino París. Ella sola se sumerge en la inigualable ciudad parisina y acaba posando para un extraño pintor, en la casa del cual hay una pintura de un atractivo artista de antaño llamado Paul Borquet y gracias al poder de la magia negra, acaba en los brazos de Paul, en un París antiguo, donde la vida no es nada fácil. ¿Podrá Autumn regresar al presente?', '/imagenes/noticias/paris.jpg', 'Jina Bacarr', 'Harlequin', NULL, NULL, '4.5', 11, '2018-09-18 20:15:54', '2025-12-30 23:00:00', '0000-00-00', 1),
(5, 1, 'La Viajera del Tiempo', 'La Viajera del Tiempo', 2017, 'Un viaje a través del tiempo sorprendente, una historia inolvidable que te atrapará de principio a fin. «-¿Qué es el amor? Le preguntó una niña de cinco años a su hermano mayor. Y él le respondió: -El amor es cuando tú me robas cada día mi trozo de chocolate del almuerzo y yo, aún así, sigo dejándolo en el mismo sitio para ti todos los días». William y Lía son hermanos. Almas gemelas. Una infancia difícil ha hecho que William y Lía dependan el uno del otro desde siempre. Todo cambia cuando William desaparece sin dejar rastro, el mismo día en el que entierran a su madre en el año 2007. Nadie sabe qué es lo que ha podido suceder, ni siquiera Lía, convertida ya en una abogada de éxito. Cinco años más tarde, cuando Lía entra por casualidad en una galería de arte neoyorquina en la que exponen retratos de escritores y pintores de principios del siglo XIX, descubre en uno de ellos el rostro de su hermano William. En la placa, un seudónimo: ESCORPIÓN, un misterioso escritor cuyas obras fueron publicadas entre 1808 y 1813. Un maravilloso y mágico descubrimiento hará que Lía se convierta en una viajera del tiempo, con la esperanza de encontrar a su hermano en el pasado y traerlo de vuelta a casa. Una mágica historia sobre el amor y la esperanza. Los recuerdos y el destino. Secretos y Misterio. Descubrimientos fortuitos. Vidas memorables más allá del tiempo y su caprichoso sino.', '/imagenes/noticias/lore2.jpg', 'Lorena Franco', 'Versión Kindle', NULL, NULL, '0.0', 5, '2017-06-26 20:00:00', '2025-10-30 22:00:00', '0000-00-00', 1),
(6, 2, 'Paradox (2ª parte)', 'Paradox (2ª parte)', 2016, 'Un científico, parte de un equipo que investiga los viajes en el tiempo, consigue adelantarse una hora y al volver, trae noticias impactantes.', '/imagenes/noticias/paradox.jpg', '', NULL, 'Michael Hurst', 'Zoë Bell,  Malik Yoba,  Adam Huss', '0.0', 5, '2018-09-18 13:31:45', '2018-12-30 22:00:00', '0000-00-00', 1),
(7, 1, 'Las máscaras del tiempo (2ª parte)', 'The Mask Of Time (2ª parte)', 1968, 'Es la tarde del día de Navidad cuando Vornan-19 cae del cielo y aterriza, completamente desnudo, en las escaleras de la Plaza de España de Roma. Es el año 1999. El siglo está a punto de cambiar, y el mundo se halla al borde de la histeria de masas, aferrado por apocalípticas visiones de la inminente condenación del Hombre. ', '/imagenes/noticias/mascaras.jpg', 'Robert Silverberg', 'Ultramar', NULL, NULL, '0.0', 1, '2018-09-18 13:17:45', '2025-12-30 22:00:00', '0000-00-00', 1),
(8, 1, 'Puerta al verano', 'Summer Door', 1956, 'Dan Davis, vive en un "futuro" 1970 con un excéntrico gato aficionado al ginger ale llamado Petronius, que nunca abandona la esperanza, durante el invierno, de que alguna de las muchas puertas de la casa se abra al verano. Dan es un ingeniero que empieza a despuntar como inventor de robots para el trabajo doméstico, pero después de ser traicionado por su socio y su novia, acaba criogenizado durante 30 años, ', '/imagenes/noticias/puerta.jpg', 'Jina Bacarr', 'Harlequin', '', '', '0.0', 2, '2016-09-18 13:16:49', '2025-12-30 22:00:00', '0000-00-00', 1),
(9, 1, 'El Tunel Del Tiempo ', 'El Tunel Del Tiempo ', 1965, 'Dos científicos aventureros dispuestos a viajar por distintas épocas de la humanidad intentan realizar la maniobra, uno por demostrar que la invención funciona y el otro por rescatar al compañero. ', '/imagenes/noticias/doctor_who_vincent_and_the_doctor_tv-469546786-large.jpg', '', '', '', '', '0.0', 1, '2018-10-05 20:03:44', '2024-12-31 23:00:00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE IF NOT EXISTS `respuestas` (
  `idRespuesta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idComentario` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Comentario` text COLLATE utf8_spanish_ci,
  `FechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Aprobado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRespuesta`),
  UNIQUE KEY `idRespuesta` (`idRespuesta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idRespuesta`, `idComentario`, `idUsuario`, `Comentario`, `FechaAlta`, `Aprobado`) VALUES
(5, 5, 20, 'Talmente de acuerdo!!', '2018-07-17 22:00:00', 1),
(10, 5, 21, 'Y yo!!', '2018-07-17 22:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Contrasena` varchar(75) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Rol` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Usuario`, `Email`, `Contrasena`, `Rol`, `fechaAlta`, `Activo`) VALUES
(20, 'Admin', 'esilvano150@hotmail.com', '$2y$10$bHAXAMQ7NnpxU26t0tL.eu/WaW7Rlb3o95.9f3RT.AerdUwwT231m', 'admin', '2018-10-03 18:39:10', b'1'),
(21, 'Edu', 'eastolfi@yahoo.com', '$2y$10$5w2IRD65YNIvhTd/OBngd.1e3lF/ad.bd1YG86SmecEwIDstHQZOO', 'visitante', '2018-09-17 19:53:17', b'1'),
(22, 'Edu1', 'eastolfi@yahoo.com', '$2y$10$hgpnQudDzKp1VLSGyjevs.TyGAlldlzaeHRyYsFhv.r0K78qLsZta', 'visitante', '2018-09-17 19:53:17', b'1'),
(23, 'Edu1111', 'esilvano150@hotmail.com', '$2y$10$LzaBU6pbq3pWQVgTrwMzv.wAayW0TRIpxYGsg36EEXDY4REbM6c1e', 'visitante', '2018-10-01 20:17:16', b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
