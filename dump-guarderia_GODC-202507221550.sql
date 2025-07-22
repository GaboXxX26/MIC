-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: guarderia_GODC
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
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actividad` (
  `ID_ACTIVIDAD` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` char(50) NOT NULL,
  `DESCRIPCION` text DEFAULT NULL,
  `DURACION` int(60) NOT NULL,
  PRIMARY KEY (`ID_ACTIVIDAD`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
INSERT INTO `actividad` VALUES (4,'deporte',NULL,45),(5,'vocalizacion',NULL,60),(6,'pintura',NULL,30);
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asistencia` (
  `ID_ASISTENCIA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_NINO` int(11) DEFAULT NULL,
  `FECHA` date NOT NULL,
  `HORA_ENTRADA` time NOT NULL,
  `HORA_SALIDA` time DEFAULT NULL,
  `OBSERVACIONES` text DEFAULT NULL,
  PRIMARY KEY (`ID_ASISTENCIA`),
  KEY `FK_REGISTRA` (`ID_NINO`),
  CONSTRAINT `FK_REGISTRA` FOREIGN KEY (`ID_NINO`) REFERENCES `ninos` (`ID_NINO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` VALUES (1,2,'2025-07-22','08:30:00',NULL,'El niño llegó contento.'),(2,1,'2025-07-22','09:30:00',NULL,'El niño llegó con un juguete.'),(3,3,'2025-07-22','07:50:00','05:00:00','El niño ingresa sin chompa.');
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educador`
--

DROP TABLE IF EXISTS `educador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `educador` (
  `ID_EDUCADORA` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` char(50) NOT NULL,
  `APELLIDO` char(50) NOT NULL,
  `CEDULA` varchar(10) NOT NULL,
  `ESPECIALIDAD` char(10) NOT NULL,
  `CELULAR` varchar(10) DEFAULT NULL,
  `EDAD` int(11) NOT NULL,
  PRIMARY KEY (`ID_EDUCADORA`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educador`
--

LOCK TABLES `educador` WRITE;
/*!40000 ALTER TABLE `educador` DISABLE KEYS */;
INSERT INTO `educador` VALUES (6,'Julian','Alvarez','1721688965','Pintura','0678720652',35),(7,'Matias','Alvarez','1721688765','Lenguaje','0678722652',29);
/*!40000 ALTER TABLE `educador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluaciones`
--

DROP TABLE IF EXISTS `evaluaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluaciones` (
  `ID_EVALUACION` int(11) NOT NULL AUTO_INCREMENT,
  `ID_NINO` int(11) DEFAULT NULL,
  `FECHA` date NOT NULL,
  `AREA_DESARROLLO` char(25) NOT NULL,
  `DESCRIPCION` text DEFAULT NULL,
  `NOTA` float NOT NULL,
  PRIMARY KEY (`ID_EVALUACION`),
  KEY `FK_RINDE` (`ID_NINO`),
  CONSTRAINT `FK_RINDE` FOREIGN KEY (`ID_NINO`) REFERENCES `ninos` (`ID_NINO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluaciones`
--

LOCK TABLES `evaluaciones` WRITE;
/*!40000 ALTER TABLE `evaluaciones` DISABLE KEYS */;
INSERT INTO `evaluaciones` VALUES (1,3,'2025-07-22','Lenguaje','Aprueba excelente.',9),(2,3,'2025-07-22','Cognitivo','Aprueba notablemente.',7),(3,2,'2025-07-22','Cognitivo','Aprueba exelente.',9.9);
/*!40000 ALTER TABLE `evaluaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `ID_GRUPO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EDUCADORA` int(11) DEFAULT NULL,
  `ID_ACTIVIDAD` int(11) DEFAULT NULL,
  `NOMBRE` char(50) NOT NULL,
  `UBICACION` text NOT NULL,
  PRIMARY KEY (`ID_GRUPO`),
  KEY `FK_IMPARTE` (`ID_EDUCADORA`),
  KEY `FK_REALIZA` (`ID_ACTIVIDAD`),
  CONSTRAINT `FK_IMPARTE` FOREIGN KEY (`ID_EDUCADORA`) REFERENCES `educador` (`ID_EDUCADORA`),
  CONSTRAINT `FK_REALIZA` FOREIGN KEY (`ID_ACTIVIDAD`) REFERENCES `actividad` (`ID_ACTIVIDAD`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,7,6,'Grupo de PROPVP','Patio trasero'),(2,6,5,'Grupo de los Leones','Patio Principal'),(3,7,6,'Grupo de los Hadas','Patio trasero');
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario` (
  `ID_HORARIO` int(11) NOT NULL AUTO_INCREMENT,
  `HORA_INICIO` time NOT NULL,
  `HORA_FIN` time NOT NULL,
  PRIMARY KEY (`ID_HORARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (1,'10:00:00','11:00:00'),(3,'11:30:00','12:30:00'),(4,'13:00:00','14:00:00');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ninos`
--

DROP TABLE IF EXISTS `ninos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ninos` (
  `ID_NINO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` char(50) NOT NULL,
  `APELLIDO` char(50) NOT NULL,
  `EDAD` int(11) NOT NULL,
  `GENERO` char(10) NOT NULL,
  `DIRECCION` char(100) DEFAULT NULL,
  `CEDULA` decimal(10,0) NOT NULL,
  `ALERGIAS` text NOT NULL,
  `ENFERMEDADES` text NOT NULL,
  `OBSERVACIONES` text DEFAULT NULL,
  PRIMARY KEY (`ID_NINO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ninos`
--

LOCK TABLES `ninos` WRITE;
/*!40000 ALTER TABLE `ninos` DISABLE KEYS */;
INSERT INTO `ninos` VALUES (1,'Luis','Mendoza',4,'Masculino','Calle Secundaria 456',1788990011,'Polvo','Asma leve','Llevar siempre su inhalador.'),(2,'Jose','Mujica',3,'Masculino','Calle Secundaria 456',1721688974,'Polvo,Polen','Asma leve','Llevar siempre su inhalador.'),(3,'Ana','Garcia',6,'Masculino','Calle Secundaria 456',1721688975,'Polvo','Asma leve','Llevar siempre su inhalador.');
/*!40000 ALTER TABLE `ninos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertenece`
--

DROP TABLE IF EXISTS `pertenece`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pertenece` (
  `ID_GRUPO` int(11) NOT NULL,
  `ID_NINO` int(11) NOT NULL,
  PRIMARY KEY (`ID_GRUPO`,`ID_NINO`),
  KEY `FK_PERTENECE2` (`ID_NINO`),
  CONSTRAINT `FK_PERTENECE` FOREIGN KEY (`ID_GRUPO`) REFERENCES `grupos` (`ID_GRUPO`),
  CONSTRAINT `FK_PERTENECE2` FOREIGN KEY (`ID_NINO`) REFERENCES `ninos` (`ID_NINO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertenece`
--

LOCK TABLES `pertenece` WRITE;
/*!40000 ALTER TABLE `pertenece` DISABLE KEYS */;
INSERT INTO `pertenece` VALUES (1,1),(1,2),(2,2),(2,3),(3,1),(3,2);
/*!40000 ALTER TABLE `pertenece` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programa`
--

DROP TABLE IF EXISTS `programa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programa` (
  `ID_ACTIVIDAD` int(11) NOT NULL,
  `ID_HORARIO` int(11) NOT NULL,
  PRIMARY KEY (`ID_ACTIVIDAD`,`ID_HORARIO`),
  KEY `FK_PROGRAMA2` (`ID_HORARIO`),
  CONSTRAINT `FK_PROGRAMA` FOREIGN KEY (`ID_ACTIVIDAD`) REFERENCES `actividad` (`ID_ACTIVIDAD`),
  CONSTRAINT `FK_PROGRAMA2` FOREIGN KEY (`ID_HORARIO`) REFERENCES `horario` (`ID_HORARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programa`
--

LOCK TABLES `programa` WRITE;
/*!40000 ALTER TABLE `programa` DISABLE KEYS */;
INSERT INTO `programa` VALUES (4,1),(5,1),(6,4);
/*!40000 ALTER TABLE `programa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representa`
--

DROP TABLE IF EXISTS `representa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `representa` (
  `ID_NINO` int(11) NOT NULL,
  `ID_REPRESENTANTE` int(11) NOT NULL,
  PRIMARY KEY (`ID_NINO`,`ID_REPRESENTANTE`),
  KEY `FK_REPRESENTA2` (`ID_REPRESENTANTE`),
  CONSTRAINT `FK_REPRESENTA` FOREIGN KEY (`ID_NINO`) REFERENCES `ninos` (`ID_NINO`),
  CONSTRAINT `FK_REPRESENTA2` FOREIGN KEY (`ID_REPRESENTANTE`) REFERENCES `representante` (`ID_REPRESENTANTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representa`
--

LOCK TABLES `representa` WRITE;
/*!40000 ALTER TABLE `representa` DISABLE KEYS */;
INSERT INTO `representa` VALUES (1,3),(2,2),(3,3);
/*!40000 ALTER TABLE `representa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representante`
--

DROP TABLE IF EXISTS `representante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `representante` (
  `ID_REPRESENTANTE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` char(50) NOT NULL,
  `APELLIDO` char(50) NOT NULL,
  `EDAD` int(11) NOT NULL,
  `CELULAR` varchar(10) NOT NULL,
  `CEDULA` varchar(10) NOT NULL,
  `PARENTEZCO` varchar(50) NOT NULL,
  `LUGAR_DE_TRABAJO` text NOT NULL,
  `GENERO` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_REPRESENTANTE`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representante`
--

LOCK TABLES `representante` WRITE;
/*!40000 ALTER TABLE `representante` DISABLE KEYS */;
INSERT INTO `representante` VALUES (2,'Ana','Pérez',30,'0991234567','1712345678','Madre','Oficina Central','Femenino'),(3,'Mateo','Tinitana',23,'0987654321','1234567890','Padre','Oficina Central','Maculino');
/*!40000 ALTER TABLE `representante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'guarderia_GODC'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-22 15:50:58
