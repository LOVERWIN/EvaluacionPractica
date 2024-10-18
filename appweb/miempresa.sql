-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-10-2023 a las 15:51:19
-- Versión del servidor: 10.5.20-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id21339672_miempresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--

CREATE TABLE `tb_productos` (
  `idPro` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Precio` float NOT NULL,
  `Ext` int(11) NOT NULL,
   PRIMARY KEY (`idPro`)  -- Definir la llave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_productos` (`Nombre`, `Precio`, `Ext`)
VALUES
('Laptop HP 15"', 650.99, 25),
('Smartphone Samsung Galaxy S21', 799.99, 15),
('Monitor LG 24"', 189.50, 40),
('Teclado Mecánico RGB', 89.99, 100),
('Ratón Gaming Logitech', 45.75, 80);


CREATE TABLE `tb_usuarios` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `NomUser` varchar(20) NOT NULL,
  `Passwd` varchar(25) NOT NULL,
  `NiveUser` int(11) NOT NULL,
   PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_usuarios` (`NomUser`, `Passwd`, `NiveUser`)
VALUES
('admin', 'password123', 1),
('user1', 'userpass1', 2),
('user2', 'userpass2', 2),
('erwin', 'erwinpass', 2);


CREATE TABLE `tb_usuarios_detalles` (
  `idUser` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `ApellidoPaterno` varchar(50) NOT NULL,
  `ApellidoMaterno` varchar(50) NOT NULL,
  PRIMARY KEY (`idUser`), 
  FOREIGN KEY (`idUser`) REFERENCES `tb_usuarios`(`idUser`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tb_usuarios_detalles` (`idUser`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`)
VALUES
(1, 'Admin', 'Master', 'Control'),
(2, 'Juan', 'Pérez', 'López'),
(3, 'Ana', 'Ramírez', 'García'),
(4, 'Erwin', 'González', 'Martínez');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
