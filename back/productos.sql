-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-05-2022 a las 21:40:30
-- Versión del servidor: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `a18marcastru_peluqueria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `cantidad`, `precio`, `imagen`) VALUES
(1, 'TIJERAS FUTURA LINE PERFECT BEAUTY\r\n', 'Tijeras de la marca Bifull han sido fabricadas en acero japonés de máxima calidad, con un acabado brillante.', 1, 20, 'https://productosdepeluqueria.info/32429-large_default/tijeras-futura-line-perfect-beauty.jpg'),
(2, 'CREMA DEFINICION DE RIZO EASY CURL STYLING TOOLS 250ML\r\n', 'Esta crema separa y moldea los cabellos rizados y ondulados de Fanola.', 10, 5, 'Esta crema separa y moldea los cabellos rizados y ondulados de Fanola.'),
(3, 'PURE ALCOHOL REMOVER 1000ML VICTORIA VYNN', 'Líquido a base de alcohol sin acetona para retirar las manicuras de Pure Hybrid.', 9, 25, 'https://productosdepeluqueria.info/21584-large_default/pure-alcohol-remover-1000ml-victoria-vynn.jpg'),
(4, 'GOMINA FUERTE 250ML NIRVEL', 'Gel para esculpir peinados. Fijación fuerte.', 10, 5, 'https://productosdepeluqueria.info/34346-large_default/gomina-fuerte-250ml-nirvel.jpg'),
(5, 'SOLUCIÓN ESPECIAL TINTE EN CREMA THUYA', 'Permite la oxidación del color tinte para neutralizar el color natural del cabello. Utilizar este producto a partes iguales con el tinte.', 10, 10, 'https://productosdepeluqueria.info/35258-large_default/solucin-especial-tinte-en-crema-thuya.jpg'),
(6, 'DANDRUFF CONTROL SHAMPOO 250ML MORGANS POMADE', 'El Champú Dandruff Control Morgans Pomade es un champú profesional de alta calidad. Especialmente formulado para controlar el picor y las capas de caspa que se forman en el cuero cabelludo. Ligeramente perfumado.', 10, 10, 'https://productosdepeluqueria.info/25357-large_default/dandruff-control-shampoo-250ml-morgans-pomade.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
