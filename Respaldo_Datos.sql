-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tintoreria_aries
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `almacen`
--

DROP TABLE IF EXISTS `almacen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `almacen` (
  `Clave_Producto_PK_FK` varchar(20) NOT NULL,
  `Identificador_Area_PK_FK` char(3) NOT NULL,
  `Existencias` int NOT NULL,
  PRIMARY KEY (`Clave_Producto_PK_FK`,`Identificador_Area_PK_FK`),
  KEY `Identificador_Area_Almacen` (`Identificador_Area_PK_FK`),
  CONSTRAINT `Clave_Producto_Almacen` FOREIGN KEY (`Clave_Producto_PK_FK`) REFERENCES `productos` (`Clave_Producto_PK`),
  CONSTRAINT `Identificador_Area_Almacen` FOREIGN KEY (`Identificador_Area_PK_FK`) REFERENCES `areas` (`Identificador_Area_PK`),
  CONSTRAINT `Existencias_Almacen` CHECK ((`Existencias` >= 0)),
  CONSTRAINT `Identificador_Almacen_Area` CHECK ((`Identificador_Area_PK_FK` = _utf8mb4'A'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen`
--

LOCK TABLES `almacen` WRITE;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
INSERT INTO `almacen` VALUES ('CPT-03','A',35),('HAN-01A','A',200),('HAN-06','A',175),('KC-02','A',1),('KC-04','A',2),('KC-09','A',2),('KC-12','A',1),('KC-16','A',2),('KC-23','A',1),('KC-25','A',2),('KC-28','A',1),('KC-30','A',2),('P-10','A',2),('T-B30-006','A',350),('V-14','A',10),('V-26','A',15),('V-33','A',50);
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `Identificador_Area_PK` char(3) NOT NULL,
  `Numero_Area` int NOT NULL,
  `Nombre_Area` varchar(30) NOT NULL,
  `Cantidad_Empleados` int NOT NULL,
  PRIMARY KEY (`Identificador_Area_PK`),
  CONSTRAINT `Identificador_Area_PK` CHECK ((`Identificador_Area_PK` in (_utf8mb4'A',_utf8mb4'L',_utf8mb4'M',_utf8mb4'P',_utf8mb4'PL',_utf8mb4'REP')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES ('A',5,'Almacen',0),('L',3,'Lavado',1),('M',1,'Mostrador',2),('P',2,'Planta',1),('PL',4,'Planchado',1),('REP',6,'Reparación',0);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `Numero_Telefono_PK` varchar(10) NOT NULL,
  `Primer_Nombre` varchar(30) NOT NULL,
  `Segundo_Nombre` varchar(30) DEFAULT NULL,
  `Primer_Apellido` varchar(30) NOT NULL,
  `Segundo_Apellido` varchar(30) NOT NULL,
  `Calle` varchar(50) DEFAULT NULL,
  `Numero_Exterior` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`Numero_Telefono_PK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES ('5503288379','Eduardo',NULL,'Romero','Torralba ','Oriente 19','176'),('5504711160','Araceli',NULL,'Ramirez','Gonzalez ','Oriente 1','132'),('5526015450','Erika',NULL,'Castro','Dominguez ','Jose Maria Morelos','127'),('5529628501','Julieta',NULL,'Cruz','Cruz ','Oriente 34','23'),('5539630068','Julio',NULL,'Romero','Zambrano ','Oriente 23','144'),('5545303785','Aquiles',NULL,'Piña','Olvera ','Oriente 22','166'),('5551901738','Victoria',NULL,'Herrera','Mendoza ','Loma 2','47'),('5552393774','Jose',NULL,'Mendoza','Cordero','Oriente 13','143'),('5552774867','Jordan',' Miguel ','Guitierrez','Lopez ','Oriente 12','192'),('5559849048','Alexis',NULL,'Bautista','Gonzalez ','Morelos','161'),('5561150401','Mitzy',' Ayelen  ','Ramirez ','Ramirez ','Oriente 24','156'),('5563802500','Antonio',NULL,'Rivera','Garcia','Morelo','98'),('5568346061','Virginia',NULL,'Romero','Hernandez ','Loma 2','45'),('5570472184','Jose',' Guadalupe  ','Mendez','Funetes ','Morelos','189'),('5572210522','Lidia ',NULL,'Hernandez','Lopez','Oriente 4','43'),('5573498028','Tania',NULL,'Martinez','Oivares ','Loma 2','45'),('5574721936','Enrique',NULL,'Rivera','Esperon ','Loma 2','79'),('5574873193','Diego',NULL,'Hernandez','Moreno ','Morelos','165'),('5579578291','Fredy',NULL,'Ramirez','Ramirez ','Loma 2','45'),('5583119396','Stephani',NULL,'Fuentes','Gomez ','Loma 2','78'),('5583510568','Jose','Angel ','Arzate','Torres','Oriente 13','152'),('5586249212','Zaid',NULL,'Ramirez','Ramirez ','Morelos','161'),('5586740704','Casandra',NULL,'Gonzalez','Cruz ','Loma 2','89'),('5587133077','Alfredo',NULL,'Ganzalez ','Moreno ','Oriente 20','12'),('5588728726','Fabiola',NULL,'Romero','Olguin ','Oriente 7','186'),('5591098389','Leonardo',NULL,'Saldivar','Gomez ','Loma 2','48'),('5592299421','Sergio',NULL,'Gonzalez','Ramirez ','Oriente 22','166'),('5596842072','Misael',NULL,'Flores','Flores ','Loma 2','45'),('5596984932','Janet',NULL,'Catro','Olvera ','Morelos','149'),('5598276753','Eduardo',NULL,'Pliego','Buen dia','Oriente 31','112');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colaboradores` (
  `Numero_Telefono_PK` varchar(10) NOT NULL,
  `Primer_Nombre` varchar(50) NOT NULL,
  `Segundo_Nombre` varchar(50) DEFAULT NULL,
  `Primer_Apellido` varchar(50) NOT NULL,
  `Segundo_Apellido` varchar(50) NOT NULL,
  `Vigente` tinyint(1) NOT NULL,
  PRIMARY KEY (`Numero_Telefono_PK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaboradores`
--

LOCK TABLES `colaboradores` WRITE;
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
INSERT INTO `colaboradores` VALUES ('5513106553','Oscar','Oscar','Riveros','Ortega',1);
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_pedidos`
--

DROP TABLE IF EXISTS `detalles_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalles_pedidos` (
  `Numero_Pedido_PK_FK` int NOT NULL,
  `Identificador_Producto_PK_FK` varchar(20) NOT NULL,
  `Cantidad_Producto` int NOT NULL,
  PRIMARY KEY (`Numero_Pedido_PK_FK`,`Identificador_Producto_PK_FK`),
  KEY `Identificador_Producto_Detalles` (`Identificador_Producto_PK_FK`),
  CONSTRAINT `Identificador_Producto_Detalles` FOREIGN KEY (`Identificador_Producto_PK_FK`) REFERENCES `productos` (`Clave_Producto_PK`),
  CONSTRAINT `Numero_Pedido_Detalles` FOREIGN KEY (`Numero_Pedido_PK_FK`) REFERENCES `pedidos` (`Numero_Pedido_PK`),
  CONSTRAINT `Cantidad_Producto_Detalles` CHECK ((`Cantidad_Producto` > 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_pedidos`
--

LOCK TABLES `detalles_pedidos` WRITE;
/*!40000 ALTER TABLE `detalles_pedidos` DISABLE KEYS */;
INSERT INTO `detalles_pedidos` VALUES (1,'CPT-03',1),(1,'HAN-01A',1),(1,'HAN-06',1),(1,'KC-02',2),(1,'KC-04',2),(1,'KC-09',2),(1,'KC-16',2),(1,'KC-23',2),(1,'KC-25',1),(1,'KC-28',1),(1,'KC-30',1),(1,'P-10',2),(1,'T-B30-006',1),(1,'V-14',2),(1,'V-26',2),(1,'V-33',1),(2,'HAN-01A',1),(2,'HAN-06',1),(2,'T-B30-006',1),(2,'V-14',2),(2,'V-26',2),(3,'CPT-03',1),(3,'HAN-01A',1),(3,'HAN-06',1),(3,'KC-02',2),(3,'KC-04',2),(3,'KC-09',2),(3,'KC-16',2),(3,'KC-23',2),(3,'KC-25',1),(3,'KC-28',1),(3,'KC-30',1),(3,'P-10',2),(3,'T-B30-006',1),(3,'V-14',2),(3,'V-26',2),(3,'V-33',1);
/*!40000 ALTER TABLE `detalles_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `Numero_Telefono_PK` varchar(10) NOT NULL,
  `Primer_Nombre` varchar(30) NOT NULL,
  `Segundo_Nombre` varchar(30) DEFAULT NULL,
  `Primer_Apellido` varchar(30) NOT NULL,
  `Segundo_Apellido` varchar(30) NOT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL,
  `Numero_Seguridad_Social` varchar(11) NOT NULL,
  `Salario` float NOT NULL,
  `Tipo_Nomina` varchar(30) NOT NULL,
  `Tipo_Empleado` varchar(10) NOT NULL,
  `Vigente` tinyint(1) NOT NULL,
  PRIMARY KEY (`Numero_Telefono_PK`),
  CONSTRAINT `Tipo_Empleado` CHECK ((`Tipo_Empleado` in (_utf8mb4'Empleado',_utf8mb4'Jefe'))),
  CONSTRAINT `Tipo_Nomina` CHECK ((`Tipo_Nomina` in (_utf8mb4'Quincenal',_utf8mb4'Mensual')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES ('5534566354','María','Isabel ','López','Fernández ','maria.lopez@example.com','374659827',2500,'Quincenal','Empleado',1),('5538455937','Carlos ','Alberto','Ramírez','Castro','carlos.ramirez@example.com','576483726',2500,'Quincenal','Jefe',1),('5545837302','Sofia','Lucia ','García','Martínez ','sofia.garcia@example.com    ','482759985',2500,'Quincenal','Empleado',1),('5567890378','Javier  ','Antonio ','Pérez','González ','javier.perez@example.com     ','475869283',2500,'Quincenal','Empleado',1),('5573582363','Alejandro','Andrés ','Rodríguez ','Gómez ','alejandro.rodriguez@example.com ','384759764',2500,'Quincenal','Empleado',1),('5583659236','Andrea','Carolina','Martínez','Sánchez','andrea.martinez@example.com  ','647580285',2500,'Quincenal','Jefe',1),('5589465345','Laura','Valentina ','Morales','Pérez','laura.morales@example.com','586958375',2500,'Quincenal','Empleado',1);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lavado`
--

DROP TABLE IF EXISTS `lavado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lavado` (
  `Folio_Nota_PK_FK` int NOT NULL,
  `Fecha_Entrada_PK` date NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Fecha_Salida` date DEFAULT NULL,
  `Hora_Salida` time DEFAULT NULL,
  `Identificador_Area_FK` char(3) NOT NULL,
  `Area_Siguiente` char(3) NOT NULL,
  `Estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`Folio_Nota_PK_FK`,`Fecha_Entrada_PK`),
  KEY `Identificador_Area_Lavado` (`Identificador_Area_FK`),
  CONSTRAINT `Folio_Nota_Lavado` FOREIGN KEY (`Folio_Nota_PK_FK`) REFERENCES `notas` (`Folio_Nota_PK`),
  CONSTRAINT `Identificador_Area_Lavado` FOREIGN KEY (`Identificador_Area_FK`) REFERENCES `areas` (`Identificador_Area_PK`),
  CONSTRAINT `Area_Siguiente_Lavado` CHECK ((`Area_Siguiente` in (_utf8mb4'PL',_utf8mb4'REP',_utf8mb4'M')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lavado`
--

LOCK TABLES `lavado` WRITE;
/*!40000 ALTER TABLE `lavado` DISABLE KEYS */;
INSERT INTO `lavado` VALUES (1,'2021-02-12','11:30:00',NULL,NULL,'L','PL',0),(5,'2021-08-02','11:30:00',NULL,NULL,'L','PL',0),(6,'2021-08-03','11:30:00',NULL,NULL,'L','PL',0),(7,'2021-08-10','11:30:00','2021-08-10','15:30:00','L','PL',1),(8,'2021-08-15','11:30:00','2021-08-15','15:30:00','L','PL',1),(15,'2021-09-14','11:30:00',NULL,NULL,'L','PL',0),(17,'2021-09-18','11:30:00',NULL,NULL,'L','PL',0),(18,'2021-09-25','11:30:00','2021-09-25','15:30:00','L','PL',1),(19,'2021-10-03','11:30:00','2021-10-03','15:30:00','L','PL',1),(20,'2021-10-07','11:30:00','2021-10-07','15:30:00','L','PL',1),(21,'2021-10-08','11:30:00',NULL,NULL,'L','PL',0),(22,'2021-10-09','11:30:00',NULL,NULL,'L','PL',0),(29,'2021-10-23','11:30:00',NULL,NULL,'L','PL',0),(30,'2021-11-04','11:30:00',NULL,NULL,'L','PL',0);
/*!40000 ALTER TABLE `lavado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mostrador`
--

DROP TABLE IF EXISTS `mostrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mostrador` (
  `Folio_Nota_PK_FK` int NOT NULL,
  `Fecha_Entrada_PK` date NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Fecha_Salida` date DEFAULT NULL,
  `Hora_Salida` time DEFAULT NULL,
  `Identificador_Area_FK` char(3) NOT NULL,
  `Area_Siguiente` char(3) NOT NULL,
  `Estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`Folio_Nota_PK_FK`,`Fecha_Entrada_PK`),
  KEY `Identificador_Areas_Mostrador` (`Identificador_Area_FK`),
  CONSTRAINT `Folio_Nota_Mostrador` FOREIGN KEY (`Folio_Nota_PK_FK`) REFERENCES `notas` (`Folio_Nota_PK`),
  CONSTRAINT `Identificador_Areas_Mostrador` FOREIGN KEY (`Identificador_Area_FK`) REFERENCES `areas` (`Identificador_Area_PK`),
  CONSTRAINT `Area_Siguiente_Mostrador` CHECK ((`Area_Siguiente` in (_utf8mb4'L',_utf8mb4'REP',_utf8mb4'P',_utf8mb4'PL'))),
  CONSTRAINT `Area_Siguiente_Mostrador_FK` CHECK ((`Area_Siguiente` in (_utf8mb4'L',_utf8mb4'REP',_utf8mb4'P',_utf8mb4'PL'))),
  CONSTRAINT `Identificador_Area_FK` CHECK ((`Identificador_Area_FK` = _utf8mb4'M')),
  CONSTRAINT `Identificador_Area_Mostrador` CHECK ((`Identificador_Area_FK` = _utf8mb4'M'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mostrador`
--

LOCK TABLES `mostrador` WRITE;
/*!40000 ALTER TABLE `mostrador` DISABLE KEYS */;
INSERT INTO `mostrador` VALUES (1,'2021-02-11','11:00:00','2021-02-11','19:30:00','M','L',1),(2,'2021-06-17','18:00:00','2021-06-17','19:30:00','M','REP',1),(3,'2021-07-04','15:30:00','2021-07-04','19:30:00','M','REP',1),(4,'2021-07-31','14:20:00','2021-07-31','19:30:00','M','P',1),(5,'2021-08-01','12:00:00','2021-08-01','19:30:00','M','L',1),(6,'2021-09-02','16:25:00','2021-09-02','19:30:00','M','L',1),(7,'2021-07-09','16:30:00','2021-07-09','19:30:00','M','L',1),(8,'2021-08-14','13:45:00','2021-08-14','19:30:00','M','L',1),(9,'2021-08-22','15:50:00','2021-08-22','19:30:00','M','REP',1),(10,'2021-08-24','17:40:00','2021-08-24','19:30:00','M','REP',1),(11,'2021-09-29','19:30:00','2021-09-29','19:30:00','M','REP',1),(12,'2021-09-04','14:35:00','2021-09-04','19:30:00','M','P',1),(13,'2021-09-08','19:20:00','2021-09-08','19:30:00','M','PL',1),(14,'2021-09-10','15:50:00','2021-09-10','19:30:00','M','PL',1),(15,'2021-09-13','07:42:00','2021-09-13','19:30:00','M','L',1),(16,'2021-09-13','16:55:00','2021-09-13','19:30:00','M','PL',1),(17,'2021-09-17','13:19:00','2021-09-17','19:30:00','M','L',1),(18,'2021-09-24','11:02:00','2021-09-24','19:30:00','M','L',1),(19,'2021-10-02','10:00:00','2021-10-02','19:30:00','M','L',1),(20,'2021-10-06','12:23:00','2021-10-06','19:30:00','M','L',1),(21,'2021-10-07','14:25:00','2021-10-07','19:30:00','M','L',1),(22,'2021-10-08','20:00:00','2021-10-08','19:30:00','M','L',1),(23,'2021-10-08','14:47:00','2021-10-08','19:30:00','M','PL',1),(24,'2021-10-09','13:22:00','2021-10-09','19:30:00','M','PL',1),(25,'2021-10-13','11:52:00','2021-10-13','19:30:00','M','PL',1),(26,'2021-10-16','16:34:00','2021-10-16','19:30:00','M','P',1),(27,'2021-10-18','17:34:00','2021-10-18','19:30:00','M','P',1),(28,'2021-10-19','13:20:00','2021-10-19','19:30:00','M','PL',1),(29,'2021-10-22','11:17:00','2021-10-22','19:30:00','M','L',1),(30,'2021-11-03','12:22:00','2021-11-03','19:30:00','M','L',1);
/*!40000 ALTER TABLE `mostrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notas` (
  `Folio_Nota_PK` int NOT NULL AUTO_INCREMENT,
  `Numero_Telefono_Cliente_FK` varchar(10) NOT NULL,
  `Numero_Telefono_Empleado_FK` varchar(10) NOT NULL,
  `Tipo_Servicio` varchar(30) NOT NULL,
  `Fecha_Entrega_Estimada` date NOT NULL,
  `Hora_Entrega_Estimada` time NOT NULL,
  PRIMARY KEY (`Folio_Nota_PK`),
  KEY `Telefono_Clientes_Notas` (`Numero_Telefono_Cliente_FK`),
  KEY `Telefono_Empleados_Notas` (`Numero_Telefono_Empleado_FK`),
  CONSTRAINT `Telefono_Clientes_Notas` FOREIGN KEY (`Numero_Telefono_Cliente_FK`) REFERENCES `clientes` (`Numero_Telefono_PK`),
  CONSTRAINT `Telefono_Empleados_Notas` FOREIGN KEY (`Numero_Telefono_Empleado_FK`) REFERENCES `empleados` (`Numero_Telefono_PK`),
  CONSTRAINT `Tipo_Servicio` CHECK ((`Tipo_Servicio` in (_utf8mb4'Lavado',_utf8mb4'Teñido',_utf8mb4'Reparación',_utf8mb4'Lavado en seco',_utf8mb4'Planchado')))
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
INSERT INTO `notas` VALUES (1,'5572210522','5545837302','Lavado','2021-02-13','19:30:00'),(2,'5526015450','5573582363','Teñido','2021-02-14','19:30:00'),(3,'5588728726','5534566354','Reparación','2021-02-15','19:30:00'),(4,'5552774867','5567890378','Lavado en seco','2021-02-16','19:30:00'),(5,'5570472184','5583659236','Lavado','2021-02-17','19:30:00'),(6,'5529628501','5538455937','Lavado','2021-02-18','19:30:00'),(7,'5583119396','5589465345','Lavado','2021-02-19','19:30:00'),(8,'5583510568','5545837302','Lavado','2021-02-20','19:30:00'),(9,'5586249212','5573582363','Teñido','2021-02-21','19:30:00'),(10,'5561150401','5534566354','Teñido','2021-02-22','19:30:00'),(11,'5568346061','5567890378','Teñido','2021-02-23','19:30:00'),(12,'5592299421','5583659236','Lavado en seco','2021-02-24','19:30:00'),(13,'5574721936','5538455937','Planchado','2021-02-25','19:30:00'),(14,'5587133077','5589465345','Planchado','2021-02-26','19:30:00'),(15,'5574873193','5545837302','Lavado','2021-02-27','19:30:00'),(16,'5545303785','5573582363','Planchado','2021-02-28','19:30:00'),(17,'5579578291','5534566354','Lavado','2021-03-01','19:30:00'),(18,'5598276753','5567890378','Lavado','2021-03-02','19:30:00'),(19,'5573498028','5583659236','Lavado','2021-03-03','19:30:00'),(20,'5596984932','5538455937','Lavado','2021-03-04','19:30:00'),(21,'5551901738','5589465345','Lavado','2021-03-05','19:30:00'),(22,'5504711160','5545837302','Lavado','2021-03-06','19:30:00'),(23,'5563802500','5573582363','Planchado','2021-03-07','19:30:00'),(24,'5503288379','5534566354','Planchado','2021-03-08','19:30:00'),(25,'5552393774','5567890378','Planchado','2021-03-09','19:30:00'),(26,'5591098389','5583659236','Lavado en seco','2021-03-10','19:30:00'),(27,'5539630068','5538455937','Lavado en seco','2021-03-11','19:30:00'),(28,'5596842072','5589465345','Planchado','2021-03-12','19:30:00'),(29,'5559849048','5545837302','Lavado','2021-03-13','19:30:00'),(30,'5586740704','5573582363','Lavado','2021-03-14','19:30:00');
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `Numero_Pedido_PK` int NOT NULL AUTO_INCREMENT,
  `Nombre_Distribuidora_PK_FK` varchar(80) NOT NULL,
  `Fecha_Pedido` date NOT NULL,
  `Total_Pagar` float NOT NULL,
  PRIMARY KEY (`Numero_Pedido_PK`),
  KEY `Nombre_Distribuidora_Pedidos` (`Nombre_Distribuidora_PK_FK`),
  CONSTRAINT `Nombre_Distribuidora_Pedidos` FOREIGN KEY (`Nombre_Distribuidora_PK_FK`) REFERENCES `proveedores` (`Nombre_Distribuidora_PK`),
  CONSTRAINT `Total_Pagar_Pedidos` CHECK ((`Total_Pagar` > 0))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'Velasquez','2020-01-11',5334.92),(2,'Velasquez','2020-01-28',4172.36),(3,'Velasquez','2020-02-11',5334.92);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planchado`
--

DROP TABLE IF EXISTS `planchado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planchado` (
  `Folio_Nota_PK_FK` int NOT NULL,
  `Fecha_Entrada_PK` date NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Fecha_Salida` date DEFAULT NULL,
  `Hora_Salida` time DEFAULT NULL,
  `Identificador_Area_FK` char(3) NOT NULL,
  `Area_Siguiente` char(3) NOT NULL,
  `Estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`Folio_Nota_PK_FK`,`Fecha_Entrada_PK`),
  KEY `Identificador_Area_Planchado` (`Identificador_Area_FK`),
  CONSTRAINT `Folio_Nota_Planchado` FOREIGN KEY (`Folio_Nota_PK_FK`) REFERENCES `notas` (`Folio_Nota_PK`),
  CONSTRAINT `Identificador_Area_Planchado` FOREIGN KEY (`Identificador_Area_FK`) REFERENCES `areas` (`Identificador_Area_PK`),
  CONSTRAINT `Area_Siguiente_Planchado` CHECK ((`Area_Siguiente` = _utf8mb4'M')),
  CONSTRAINT `Identificador_Area_Planchado` CHECK ((`Identificador_Area_FK` = _utf8mb4'PL'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planchado`
--

LOCK TABLES `planchado` WRITE;
/*!40000 ALTER TABLE `planchado` DISABLE KEYS */;
INSERT INTO `planchado` VALUES (13,'2021-09-09','16:00:00',NULL,NULL,'PL','M',0),(14,'2021-09-11','16:00:00',NULL,NULL,'PL','M',0),(16,'2021-09-14','16:00:00',NULL,NULL,'PL','M',0),(23,'2021-10-10','16:00:00','2021-10-10','19:40:00','PL','M',1),(24,'2021-10-11','16:00:00','2021-10-11','19:40:00','PL','M',1),(25,'2021-10-12','16:00:00',NULL,NULL,'PL','M',0),(28,'2021-10-11','16:00:00','2021-10-11','19:40:00','PL','M',1);
/*!40000 ALTER TABLE `planchado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planta`
--

DROP TABLE IF EXISTS `planta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planta` (
  `Folio_Nota_PK_FK` int NOT NULL,
  `Fecha_Entrada_PK` date NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Fecha_Salida` date DEFAULT NULL,
  `Hora_Salida` time DEFAULT NULL,
  `Identificador_Area_FK` char(3) NOT NULL,
  `Area_Siguiente` char(3) NOT NULL,
  `Estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`Folio_Nota_PK_FK`,`Fecha_Entrada_PK`),
  KEY `Identificador_Area_Planta` (`Identificador_Area_FK`),
  CONSTRAINT `Folio_Nota_Planta` FOREIGN KEY (`Folio_Nota_PK_FK`) REFERENCES `notas` (`Folio_Nota_PK`),
  CONSTRAINT `Identificador_Area_Planta` FOREIGN KEY (`Identificador_Area_FK`) REFERENCES `areas` (`Identificador_Area_PK`),
  CONSTRAINT `Area_Siguiente_Planta` CHECK ((`Area_Siguiente` in (_utf8mb4'REP',_utf8mb4'PL',_utf8mb4'M'))),
  CONSTRAINT `Identificador_Area_Planta` CHECK ((`Identificador_Area_FK` = _utf8mb4'P'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planta`
--

LOCK TABLES `planta` WRITE;
/*!40000 ALTER TABLE `planta` DISABLE KEYS */;
INSERT INTO `planta` VALUES (4,'2021-07-01','11:00:00','2021-07-01','15:00:00','P','PL',1),(12,'2021-09-05','11:00:00','2021-09-05','15:00:00','P','PL',1),(26,'2021-10-17','11:00:00','2021-10-17','15:00:00','P','PL',1),(27,'2021-10-19','11:00:00','2021-10-19','15:00:00','P','PL',1);
/*!40000 ALTER TABLE `planta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precio_prendas`
--

DROP TABLE IF EXISTS `precio_prendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `precio_prendas` (
  `Tipo_Prenda_PK` varchar(50) NOT NULL,
  `Precio_Unitario` float NOT NULL,
  PRIMARY KEY (`Tipo_Prenda_PK`),
  CONSTRAINT `Precio_Unitario_Prendas` CHECK ((`Precio_Unitario` > 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precio_prendas`
--

LOCK TABLES `precio_prendas` WRITE;
/*!40000 ALTER TABLE `precio_prendas` DISABLE KEYS */;
INSERT INTO `precio_prendas` VALUES ('Abrigo ',60),('Blusa ',32),('Camisa ',32),('Capa',30),('Chaleco ',40),('Chalinas ',15),('Chamarra ',65),('Cobertor ',85),('Cobija',80),('Corbata ',25),('Edredon ',100),('Falda',35),('Gabardina ',55),('Pans ',35),('Pantalon ',32),('Playera ',35),('Saco ',32),('Sudadera ',35),('Traje ',64),('Vestido de noche ',70);
/*!40000 ALTER TABLE `precio_prendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prendas`
--

DROP TABLE IF EXISTS `prendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prendas` (
  `Folio_Nota_PK_FK` int NOT NULL,
  `Tipo_Prenda_PK_FK` varchar(50) NOT NULL,
  `Color` varchar(40) NOT NULL,
  `Cantidad` int NOT NULL,
  `Precio_Total` float NOT NULL,
  `Observaciones` varchar(200) DEFAULT NULL,
  `Fecha_Entrada` date NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Fecha_Salida` date DEFAULT NULL,
  `Hora_Salida` time DEFAULT NULL,
  PRIMARY KEY (`Folio_Nota_PK_FK`,`Tipo_Prenda_PK_FK`),
  KEY `Tipo_Prenda_Prendas` (`Tipo_Prenda_PK_FK`),
  CONSTRAINT `Folio_Nota_Prendas` FOREIGN KEY (`Folio_Nota_PK_FK`) REFERENCES `notas` (`Folio_Nota_PK`),
  CONSTRAINT `Tipo_Prenda_Prendas` FOREIGN KEY (`Tipo_Prenda_PK_FK`) REFERENCES `precio_prendas` (`Tipo_Prenda_PK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prendas`
--

LOCK TABLES `prendas` WRITE;
/*!40000 ALTER TABLE `prendas` DISABLE KEYS */;
INSERT INTO `prendas` VALUES (1,'Chamarra ','verde',3,195,'Ninguna ','2021-02-12','12:00:00','2021-02-14','14:10:00'),(1,'Pantalon ','negro',2,64,'Ninguna ','2021-02-11','11:00:00','2021-02-13','13:10:00'),(2,'Sudadera ','azul',3,105,'Roto de la manga ','2021-06-17','18:00:00','2021-06-24','18:34:00'),(3,'Saco ','negro',5,160,'Ninguna','2021-07-04','15:30:00','2021-07-08','14:45:00'),(4,'Traje ','gris',4,256,'Ninguna','2021-07-30','14:20:00','2021-08-02','16:23:00'),(5,'Abrigo ','blanco',2,120,'Mancha de cloro ','2021-08-01','12:00:00','2021-08-03','13:45:00'),(6,'Chamarra ','verde',3,195,'Ninguna','2021-08-02','16:25:00','2021-09-04','16:14:00'),(7,'Vestido de noche ','rojo',6,420,'Luido','2021-08-09','16:30:00','2021-07-11','17:12:00'),(8,'Playera ','verde',2,70,'Ninguna','2021-08-14','13:45:00','2021-08-16','16:23:00'),(9,'Blusa ','blanca',2,64,'Ninguna','2021-08-22','15:50:00','2021-08-26','16:19:00'),(10,'Camisa ','lila',2,64,'Ninguna','2021-08-24','17:40:00','2021-09-06','14:45:00'),(11,'Edredon ','azul',2,200,'Ninguna','2021-09-29','19:30:00','2021-10-07','16:24:00'),(12,'Cobija','ginda',2,160,'Manchas de grasa','2021-09-04','14:35:00','2021-09-06','16:24:00'),(13,'Cobertor ','blanco',1,85,'Ninguna','2021-09-08','19:20:00','2021-09-09','18:16:00'),(14,'Sudadera ','verde',1,35,'Ninguna','2021-09-10','15:50:00','2021-09-11','08:12:00'),(15,'Blusa ','blanca',1,32,'Ninguna','2021-09-13','17:45:00','2021-09-15','09:18:00'),(16,'Chaleco ','azul ',3,40,'Rasgado ','2021-09-13','16:50:00','2021-09-14','12:46:00'),(17,'Capa','negra',1,30,'Ninguna','2021-09-17','13:25:00','2021-09-20','13:48:00'),(18,'Gabardina ','café',1,55,'Ninguna','2021-09-24','11:30:00','2021-09-27','18:37:00'),(19,'Falda','negra',2,70,'Pintada ','2021-10-02','10:00:00','2021-10-04','12:36:00'),(20,'Corbata ','lila',9,225,'Roto de un lado ','2021-10-06','12:00:00','2021-10-08','18:29:00'),(21,'Pantalon ','Azul',4,128,'Ninguna','2021-10-07','10:30:00','2021-10-09','13:39:00'),(22,'Pans ','rojo',4,140,'Ninguna','2021-10-08','17:55:00','2021-10-10','16:24:00'),(23,'Chalinas ','blancas',15,225,'Ninguna','2021-10-09','15:40:00','2021-10-10','13:15:00'),(24,'Camisa ','amarilla',12,384,'Ninguna','2021-10-10','19:00:00','2021-10-11','16:10:00'),(25,'Pantalon ','griz oxfo ',7,224,'Ninguna','2021-10-13','16:00:00','2021-10-15','15:14:00'),(26,'Sudadera ','beige ',6,210,'Ninguna','2021-10-16','14:15:00','2021-10-18','16:12:00'),(27,'Abrigo ','rosa ',3,180,'Manchas de grasa ','2021-10-18','20:00:00','2021-10-20','12:14:00'),(28,'Traje ','gris',3,180,'Ninguna','2021-10-19','13:45:00','2021-10-21','16:15:00'),(29,'Saco ','morado ',3,96,'Ninguna','2021-10-22','11:30:00','2021-10-24','13:15:00'),(30,'Pantalon ','verde',8,256,'Ninguna','2021-11-03','14:50:00','2021-11-05','15:13:00');
/*!40000 ALTER TABLE `prendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `Clave_Producto_PK` varchar(20) NOT NULL,
  `Nombre_Producto` varchar(100) NOT NULL,
  `Piezas` int NOT NULL,
  `UM` varchar(20) NOT NULL,
  `Descripcion_Producto` varchar(200) NOT NULL,
  `Precio_Unitario` float NOT NULL,
  `Vigente` tinyint(1) NOT NULL,
  `Stock_Minimo` int NOT NULL,
  PRIMARY KEY (`Clave_Producto_PK`),
  CONSTRAINT `Piezas_Productos` CHECK ((`Piezas` >= 0)),
  CONSTRAINT `Precio_Unitario_Productos` CHECK ((`Precio_Unitario` >= 0)),
  CONSTRAINT `Stock_Minimo_Productos` CHECK ((`Stock_Minimo` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES ('CPT-03','Carton para corbata',100,'Piezas','Caja',92.8,1,3),('HAN-01A','Gancho strut dorado o blanco',500,'Piezas','Caja',1000,1,3),('HAN-06','Gancho estandar azul cal 12,5',500,'Piezas','Caja',645,1,3),('KC-02','Jabon liquido para ropa blanca',4,'Litros','Garrafon ',60.7,1,3),('KC-04','jabon liquido para ropa obscura',4,'Litros','Garrafon ',60.7,1,3),('KC-09','jabon liquido aviva el color',4,'Litros','Garrafon ',337.63,1,3),('KC-12','Predesmanchado para cuello y puños',4,'Litros','Garrafon ',59.6,1,3),('KC-16','suavizante con agradable aroma',4,'Litros','Garrafon ',90.6,1,3),('KC-23','suavizante de telas',3,'Litros','Garrafon ',57.9,1,3),('KC-25','ultra klin',3,'Litros','Garrafon ',107.8,1,3),('KC-28','pino kilin',3,'Litros','Garafon',49.28,1,3),('KC-30','Predesmanchador ',3,'Litros','Garrafon ',59.6,1,3),('P-10','Rollo para marcar',10,'Metros','Caja',39.44,1,3),('T-B30-006','Paquete caballete engomado importado',500,'Piezas','Caja',255.2,1,3),('V-14','Rollo bolsa para vestido largo ',25,'Kilos ','Rollo ',568.04,1,3),('V-26','Rollo bolsa para saco ',25,'Kilos','Rollo ',568.04,1,3),('V-33','Bolsa para corbata',100,'Piezas','Rollo',92.8,1,3);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `Nombre_Distribuidora_PK` varchar(80) NOT NULL,
  `Telefono_Principal` varchar(10) NOT NULL,
  `Telefono_Alterno` varchar(10) DEFAULT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL,
  `Metodo_Pago` varchar(40) NOT NULL,
  `Catalogo_Producto` varchar(50) NOT NULL,
  `Calle` varchar(50) NOT NULL,
  `Numero_Exterior` varchar(6) NOT NULL,
  `Colonia` varchar(40) NOT NULL,
  `Codigo_Postal` varchar(5) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `Vigente` tinyint(1) NOT NULL,
  PRIMARY KEY (`Nombre_Distribuidora_PK`),
  CONSTRAINT `Metodo_Pago_Proveedores` CHECK ((`Metodo_Pago` in (_utf8mb4'Efectivo',_utf8mb4'Tarjeta',_utf8mb4'Transferencia')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES ('Velasquez','57460963','27333631','distribuidoravelazquez@hotmail.com','Efectivo','Accesorios para tintorerias y lavanderias','Jose Ma. Pino Suarez ','8-a','San Juan Ixhuatepec','54180','Tlanepantla','Estado de Mexico',1);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenido_reparacion`
--

DROP TABLE IF EXISTS `tenido_reparacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenido_reparacion` (
  `Folio_Nota_PK_FK` int NOT NULL,
  `Cantidad_Prendas_PK` int NOT NULL,
  `Tipo_Servicio` varchar(50) NOT NULL,
  `Telefono_Colaborador_FK` varchar(10) NOT NULL,
  `Estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`Folio_Nota_PK_FK`,`Cantidad_Prendas_PK`),
  KEY `Telefono_Colaborador_Tenido_Reparacion` (`Telefono_Colaborador_FK`),
  CONSTRAINT `Folio_Nota_Tenido_Reparacion` FOREIGN KEY (`Folio_Nota_PK_FK`) REFERENCES `notas` (`Folio_Nota_PK`),
  CONSTRAINT `Telefono_Colaborador_Tenido_Reparacion` FOREIGN KEY (`Telefono_Colaborador_FK`) REFERENCES `colaboradores` (`Numero_Telefono_PK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenido_reparacion`
--

LOCK TABLES `tenido_reparacion` WRITE;
/*!40000 ALTER TABLE `tenido_reparacion` DISABLE KEYS */;
INSERT INTO `tenido_reparacion` VALUES (3,2,'Reparacion de cierres','5513106553',0);
/*!40000 ALTER TABLE `tenido_reparacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-17 20:03:16
