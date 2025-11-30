-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2025 a las 19:16:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consultorio_dental`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `ID_Cita` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `ID_Paciente` int(11) NOT NULL,
  `ID_Empleado` int(11) NOT NULL,
  `ID_Servicio` int(11) NOT NULL,
  `Estado` enum('Programada','Confirmada','Completada','Cancelada','No Asistio') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`ID_Cita`, `Fecha`, `Hora`, `ID_Paciente`, `ID_Empleado`, `ID_Servicio`, `Estado`) VALUES
(1, '2025-01-15', '10:00:00', 1, 2, 1, 'Programada'),
(2, '2025-01-15', '11:30:00', 2, 2, 3, 'Confirmada'),
(3, '2025-01-16', '09:00:00', 3, 2, 2, 'Confirmada'),
(4, '2025-01-14', '16:00:00', 1, 2, 4, 'Completada'),
(5, '2025-12-04', '12:00:00', 4, 5, 2, 'Programada'),
(6, '2025-11-30', '14:00:00', 4, 2, 5, 'Programada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ID_Empleado` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Direccion` text DEFAULT NULL,
  `Puesto` enum('Dentista','Recepcionista','Administrador') NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ID_Empleado`, `Nombre`, `Apellido`, `Telefono`, `Correo`, `Direccion`, `Puesto`, `Password`) VALUES
(1, 'Ana', 'Garcia', '8112345678', 'admin@consultorio.com', 'Av. Universidad 123', 'Administrador', '123456'),
(2, 'Carlos', 'Lopez', '8112345679', 'dentista@consultorio.com', 'Calle Morelos 456', 'Dentista', '123456'),
(3, 'Maria', 'Rodriguez', '8112345680', 'recepcion@consultorio.com', 'Blvd. Díaz Ordaz 789', 'Recepcionista', '123456'),
(5, 'Gabriel', 'Perez', '5511223344', 'gab@ejemplo.com', NULL, 'Dentista', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `ID_Factura` int(11) NOT NULL,
  `Fecha_Emision` datetime NOT NULL,
  `Monto_Total` decimal(10,2) NOT NULL,
  `Metodo_Pago` enum('Efectivo','Tarjeta','Transferencia') NOT NULL,
  `ID_Cita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`ID_Factura`, `Fecha_Emision`, `Monto_Total`, `Metodo_Pago`, `ID_Cita`) VALUES
(1, '2025-01-14 17:30:00', 800.00, 'Efectivo', 4),
(2, '2025-01-15 12:00:00', 2500.00, 'Tarjeta', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `ID_Paciente` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Direccion` text DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `RFC` varchar(20) DEFAULT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`ID_Paciente`, `Nombre`, `Apellido`, `Telefono`, `Correo`, `Direccion`, `Fecha_Nacimiento`, `RFC`, `Password`) VALUES
(1, 'Juan', 'Perez', '8112345681', 'juan.perez@email.com', 'Calle Hidalgo 321', '1990-05-15', 'PEJM900515ABC', '123456'),
(2, 'Laura', 'Martinez', '8112345682', 'laura.mtz@email.com', 'Av. Revolución 654', '1985-08-22', 'MAL850822DEF', '123456'),
(3, 'Roberto', 'Sanchez', '8112345683', 'roberto.s@email.com', 'Blvd. Constitución 987', '1995-12-10', 'SARR951210GHI', '123456'),
(4, 'Jose', 'Santos', '5512345679', 'jose@ejemplo.com', 'Av. Eloy Cavazos', '2025-12-04', '', '1234567');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `ID_Servicio` int(11) NOT NULL,
  `Nombre_Servicio` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Costo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`ID_Servicio`, `Nombre_Servicio`, `Descripcion`, `Costo`) VALUES
(1, 'Limpieza dental', 'Eliminación de placa y sarro para una salud bucal óptima', 500.00),
(2, 'Blanqueamiento', 'Tratamientos seguros para conseguir una sonrisa más blanca y brillante', 1500.00),
(3, 'Ortodoncia', 'Corrección de la posición de los dientes para una mordida perfecta', 2500.00),
(4, 'Extracciones', 'Procedimientos cuidadosos para remover dientes dañados', 800.00),
(5, 'Consulta general', 'Revisión dental completa y diagnóstico', 300.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`ID_Cita`),
  ADD KEY `ID_Paciente` (`ID_Paciente`),
  ADD KEY `ID_Empleado` (`ID_Empleado`),
  ADD KEY `ID_Servicio` (`ID_Servicio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`ID_Empleado`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID_Factura`),
  ADD KEY `ID_Cita` (`ID_Cita`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`ID_Paciente`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`ID_Servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `ID_Cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `ID_Empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID_Factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `ID_Paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `ID_Servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`ID_Paciente`) REFERENCES `paciente` (`ID_Paciente`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`ID_Empleado`) REFERENCES `empleado` (`ID_Empleado`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`ID_Servicio`) REFERENCES `servicios` (`ID_Servicio`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`ID_Cita`) REFERENCES `cita` (`ID_Cita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
