-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: viveros
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(10) DEFAULT NULL,
  `CORREO` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENTE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Juan Carlos Pérez','amazona','0991234567','juan.perez@email.com');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_de_venta`
--

DROP TABLE IF EXISTS `detalle_de_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_de_venta` (
  `ID_DETALLE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PLANTA` int(11) DEFAULT NULL,
  `ID_SERVICIO` int(11) DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `PRECIO_UNITARIO` float DEFAULT NULL,
  PRIMARY KEY (`ID_DETALLE`),
  KEY `FK_OFRECE` (`ID_SERVICIO`),
  KEY `FK_TIENE` (`ID_PLANTA`),
  CONSTRAINT `FK_OFRECE` FOREIGN KEY (`ID_SERVICIO`) REFERENCES `servicios` (`ID_SERVICIO`),
  CONSTRAINT `FK_TIENE` FOREIGN KEY (`ID_PLANTA`) REFERENCES `plantas` (`ID_PLANTA`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_de_venta`
--

LOCK TABLES `detalle_de_venta` WRITE;
/*!40000 ALTER TABLE `detalle_de_venta` DISABLE KEYS */;
INSERT INTO `detalle_de_venta` VALUES (1,1,NULL,1,25.5);
/*!40000 ALTER TABLE `detalle_de_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `ID_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT,
  `CARGO` varchar(30) DEFAULT NULL,
  `ESPECIALIDAD` varchar(30) DEFAULT NULL,
  `TELEFONO` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_EMPLEADO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Gerente de Tienda','Botánica y Administración','0998765432');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plantas`
--

DROP TABLE IF EXISTS `plantas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plantas` (
  `ID_PLANTA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROVEEDORES` int(11) DEFAULT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `ESPECIE` varchar(50) DEFAULT NULL,
  `TIPO` varchar(25) DEFAULT NULL,
  `PRECIO` varchar(10) DEFAULT NULL,
  `STOCK` decimal(8,0) DEFAULT NULL,
  PRIMARY KEY (`ID_PLANTA`),
  KEY `FK_SUMINISTRA` (`ID_PROVEEDORES`),
  CONSTRAINT `FK_SUMINISTRA` FOREIGN KEY (`ID_PROVEEDORES`) REFERENCES `proveedores` (`ID_PROVEEDORES`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantas`
--

LOCK TABLES `plantas` WRITE;
/*!40000 ALTER TABLE `plantas` DISABLE KEYS */;
INSERT INTO `plantas` VALUES (1,1,'Monstera Deliciosa','Monstera deliciosa','Exterior','25.50',100),(2,1,'Polepis','Arbol de papel','exterior','12.60',15),(3,1,'Monstera Deliciosa','Monstera deliciosa','Exterior','25.50',50),(4,1,'Mandarina','frutal','exterior','56.60',34);
/*!40000 ALTER TABLE `plantas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `ID_PROVEEDORES` int(11) NOT NULL AUTO_INCREMENT,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `CONTACTO` varchar(10) DEFAULT NULL,
  `PRODUCTOS` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_PROVEEDORES`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Valle de Cumbayá, Lote 14, Quito','0995551122','Plantas ornamentales de interior y exterior, árboles frutales, sustratos.'),(4,'Riobamba','0978720653','Abono'),(5,'Chillogallo','0978720765','Arbustos y orquideas');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `ID_SERVICIO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL,
  `PRECIO` decimal(8,0) DEFAULT NULL,
  PRIMARY KEY (`ID_SERVICIO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'Diseño de Jardines','Diseño y planificación paisajística para espacios residenciales y comerciales.',150);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `ID__VENTA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) DEFAULT NULL,
  `ID_EMPLEADO` int(11) DEFAULT NULL,
  `ID_DETALLE` int(11) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `TIPO` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID__VENTA`),
  KEY `FK_COMPRA` (`ID_CLIENTE`),
  KEY `FK_CONTIENE` (`ID_DETALLE`),
  KEY `FK_VENDE` (`ID_EMPLEADO`),
  CONSTRAINT `FK_COMPRA` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `clientes` (`ID_CLIENTE`),
  CONSTRAINT `FK_CONTIENE` FOREIGN KEY (`ID_DETALLE`) REFERENCES `detalle_de_venta` (`ID_DETALLE`),
  CONSTRAINT `FK_VENDE` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'viveros'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-18 20:00:39
