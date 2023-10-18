-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2023 a las 04:52:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe_web2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `nombre_gen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre_gen`) VALUES
(1, 'accion'),
(2, 'aventura'),
(3, 'terror'),
(4, 'zombies');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Imagen` varchar(200) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `Descripcion`, `Imagen`, `precio`, `id_genero`) VALUES
(14, 'Resident evil 4 remake', 'Resident Evil 4 es un juego de terror y supervivencia en el que los jugadores deben sobrevivir a situaciones de miedo extremo.', '', 20000, 4),
(15, 'resident evil 2 remake', 'Resident Evil 2 es un juego de terror y supervivencia en el que los jugadores deben sobrevivir a situaciones de miedo extremo.', '', 10000, 4),
(16, 'dead island', 'La experiencia Dead Island Revienta cabezas, aplasta cráneos y rebana sesos con un combate cuerpo a cuerpo brutal y un modo cooperativo para 4 jugadores ', '', 10000, 4),
(17, 'Outlast 2', 'Outlast 2 es un videojuego de terror y supervivencia en primera persona.', '', 10000, 3),
(18, 'Assasins creed collection', 'Assassins Creed es un videojuego de aventura de acción y de sigilo en la que el jugador sobre todo asume el papel de Altaïr, experimentado por el protagonista Desmond Miles.', '', 21000, 2),
(19, 'avengers', 'Forma un equipo de hasta 4 jugadores online, domina habilidades extraordinarias, personaliza un plantel de héroes en crecimiento y defiende la Tierra de amenazas cada vez mayores.', '', 10000, 1),
(20, 'GTA V', 'Grand Theft Auto V (abreviado como GTA V o GTA 5) es un videojuego de acción-aventura de mundo abierto en tercera persona', '', 8000, 1),
(21, 'Dragon ball kakarot', 'Kakarot es principalmente un juego de rol de acción con elementos de juegos de lucha.', '', 8000, 2),
(22, 'skyrim deluxe edition', 'La historia de Skyrim se centra en los esfuerzos del personaje, Dovahkiin (sangre de dragón), para derrotar a Alduin, un dragón/dovah que, según la profecía, destruirá el mundo.', '', 10000, 2),
(23, 'Call Of Duty WW2', 'Call of Duty es una serie de videojuegos de disparos en primera persona, de estilo bélico.', '', 12000, 1),
(24, 'Phasmofobia', 'Phasmophobia es un videojuego de aventura y acción de terror psicológico compatible con realidad virtual a cargo de Kinetic Games para PC, PlayStation 5 y Xbox Series en el que hasta 4 jugadores.', '', 6000, 3),
(25, 'Fallout 79', 'Fallout 76 es un videojuego de rol de acción desarrollado por Bethesda Game Studios, para las plataformas PlayStation 4, Xbox One (próximamente al PlayStation 5 Y Xbox Series X/S),', '', 12000, 2),
(26, 'Dead Space 2', 'La historia se sitúa tres años después de Dead Space, con el protagonista viajando a la deriva por el espacio tras escapar del infierno de Aegis VII, siendo finalmente rescatado e internado.', '', 10000, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `rol`, `contraseña`) VALUES
(1, 'webadmin', 'administrador', '$2y$10$5GwG0402mEVQFI6bkcwIbePBJfu047GKpYACV48XvUB/YZCQk/SSG'),
(2, 'usuario', 'user', '$2y$10$5GwG0402mEVQFI6bkcwIbePBJfu047GKpYACV48XvUB/YZCQk/SSG');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD UNIQUE KEY `fk_genero` (`id_genero`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
