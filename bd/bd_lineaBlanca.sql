CREATE DATABASE  IF NOT EXISTS `bd_lineablanca` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bd_lineablanca`;
-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bd_lineablanca
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa` (
  `idEmpresa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provincia` varchar(45) DEFAULT NULL,
  `nombreEmpresa` varchar(120) DEFAULT NULL,
  `nombreTecnico` varchar(120) DEFAULT NULL,
  `especialidad` char(20) DEFAULT NULL,
  `direccion` varchar(120) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `web` varchar(200) DEFAULT NULL,
  `horario` varchar(120) DEFAULT NULL,
  `especificacion` varchar(1000) DEFAULT NULL,
  `contratado` char(2) DEFAULT NULL,
  `repetido` char(2) DEFAULT NULL,
  `webFound` varchar(200) DEFAULT NULL,
  `interesado` varchar(15) DEFAULT NULL,
  `comentario` varchar(1000) DEFAULT NULL,
  `creacion` datetime DEFAULT NULL,
  `ocultar` char(2) DEFAULT NULL,
  PRIMARY KEY (`idEmpresa`),
  UNIQUE KEY `ididempresa_UNIQUE` (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'ALMERIA','Servi OK','','Electrodomésticos','Avenida del Mediterráneo, 40, 04009, Almería','','http://serviok.es/?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/servi-ok_xUo6PXohUW.html','','','2020-01-13 02:09:29','no'),(2,'ALMERIA','Jbc Reparaciones','','Electrodomésticos','Avenida de Pablo Iglesias, 67, 04003, Almería','','http://www.jbcreparaciones.com/GENERICO?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/jbc-reparaciones_o4Y4UDo629.html','','','2020-01-13 02:09:29','no'),(3,'ALMERIA','Urgeservi','','Electrodomésticos','Calle España, 16, 04008, Almería','','https://urgeservi.com/?ref=600&utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas | Reparacion de electrodomestico a domicilio','no','no','https://www.paginasamarillas.es/f/almeria/urgeservi_ixvUAtb20q.html','','','2020-01-13 02:09:29','no'),(4,'ALMERIA','ASISTENCIA HOGAR 24H','','Electrodomésticos','Paseo de Almería, 38, 04001, Almería','','http://asistencia-hogar.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/asistencia-hogar-24h_sDVhbNa0UQ.html','','','2020-01-13 02:13:48','no'),(5,'ALMERIA','Fr24h Servicios Del Hogar','','Electrodomésticos','Calle Altamira, 39, 41, 04005, Almería','','https://fr24h.com/?ref=600&utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Cerrajeros, cerrajerias y cerraduras en Almería | Empresa multiservicio 24 horas | Reparacion de electrodomestico a domicilio','no','no','https://www.paginasamarillas.es/f/almeria/fr24h-servicios-del-hogar_FAJsvkY3x9.html','','','2020-01-13 02:17:51','no'),(6,'ALMERIA','Pedro Gómez','','Electrodomésticos','Calle America, 72, 04007, Almería','','http://www.autonomopedrogomez.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Servicios del hogar en Almería | Empresa multiservicio 24 horas | Reparacion de electrodomestico a domicilio','no','no','https://www.paginasamarillas.es/f/almeria/pedro-gomez_6yjamWNiA3.html','','','2020-01-13 02:17:51','no'),(7,'ALMERIA','URGECLICK REPARACIONES','','Electrodomésticos','Avenida de Pablo Iglesias, 67, 04003, Almería','','http://urgeclick.es/?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/urgeclick-reparaciones_pkUEX8b1Tt.html','','','2020-01-13 02:17:51','no'),(8,'ALMERIA','FCN FUNCIONA REPARACIONES','','Electrodomésticos','Paseo de Almería, 38, 04001, Almería','','http://funcionareparaciones.com.es/reparaciones-del-hogar?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/fcn-funciona-reparaciones_g8mNFKvUww.html','','','2020-01-13 02:17:51','no'),(9,'ALMERIA','RDH REPARACIONES DEL HOGAR','','Electrodomésticos','Avenida del Mediterráneo, 40, 04009, Almería','','http://reparaciones-del-hogar.com/?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/rdh-reparaciones-del-hogar_jZG25tatUj.html','','','2020-01-13 02:17:51','no'),(10,'ALMERIA','Reparaciones Inmediatas NCL','','Electrodomésticos','Avenida Federico García Lorca, 20, 04004, Almería','','http://reparacionesprofesionales.com/?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/reparaciones-inmediatas-ncl_up5TbwZv5E.html','','','2020-01-13 02:17:51','no'),(11,'ALMERIA','Yo Se Lo Arreglo','','Electrodomésticos','Calle González Garbín, 9, 04001, Almería','','http://yoseloarreglo.net?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas | Reparacion de electrodomestico a domicilio','no','no','https://www.paginasamarillas.es/f/almeria/yo-se-lo-arreglo_2H3F8AHxdn.html','','','2020-01-13 02:17:52','no'),(12,'ALMERIA','R. R. REPARACIONES RÁPIDAS','','Electrodomésticos','Avenida Federico García Lorca, 20, 04004, Almería','','http://reparacionesrapidas24h.com/?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/r-r-reparaciones-rapidas_wXUUvs5jWD.html','','','2020-01-13 02:17:52','no'),(13,'ALMERIA','TONI MUÑOZ','','Electrodomésticos','Calle Camaras, 24, 04003, Almería','','http://www.tonimunozservicios.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar: empresas multiservicios en Almería | Reparaciones del hogar en Almería | Empresa multiservicio 24 horas | Reparacion de electrodomestico a domicilio','no','no','https://www.paginasamarillas.es/f/almeria/toni-munoz_blN3TNWli7.html','','','2020-01-13 02:17:52','no'),(14,'ALMERIA','SOLUCIONAMOS Reparaciones Inmediatas','','Electrodomésticos','Avenida Federico García Lorca, 20, 04004, Almería','','http://solucionamos.es/GENERICO/index.html?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reparaciones del hogar en Almería | Empresa multiservicio 24 horas','no','no','https://www.paginasamarillas.es/f/almeria/solucionamos-reparaciones-inmediatas_o27eeB7gqH.html','','','2020-01-13 02:17:52','no'),(15,'GRANADA','Climagran.net','','Electrodomésticos','Avenida Málaga, 17 , 18210, Peligros (GRANADA)','','http://www.climagran.net?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Aire acondicionado: equipos e instalaciones en Peligros | Aire acondicionado en PeligrosEmpresa climatización y mantenimiento en Granada','no','no','https://www.paginasamarillas.es/f/peligros/climagran-net_224681189_000000001.html','','','2020-01-13 02:17:52','no'),(16,'ALMERIA','Servi-Altamira, S.L.','','Electrodomésticos','Calle Altamira, 55 BAJO, 04005, Almería','','https://es-es.facebook.com/ServiAltamiraSl','','Electrodomésticos: reparación en Almería | Electrodomésticos en AlmeríaÚnico servicio oficial Otsein,Cointra,Iberna,...','no','no','https://www.paginasamarillas.es/f/almeria/servi-altamira-s-l-_200427045_000000002.html','','','2020-01-13 02:17:52','no'),(17,'ALMERIA','Electroservis','','Electrodomésticos','Avenida de Roquetas, 8 JUNTO POLICIA LOCAL, 04740, Roquetas de Mar (ALMERIA)','','http://www.mastercadena.es?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electrodomésticos: reparación en Roquetas de Mar | Electrodomésticos en Roquetas de MarReparación electrodomésticos y Venta de repuestos','no','no','https://www.paginasamarillas.es/f/roquetas-de-mar/electroservis_220204622_000000002.html','','','2020-01-13 02:17:52','no'),(18,'ALMERIA','Electrodomésticos Fermín','','Electrodomésticos','Calle Circunvalación Ulpiano Díaz, 6, - Plaza del Mercado Centro, 04001, Almería','','http://www.electrorepuestosfermin.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electrodomesticos: asistencia tecnica y reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/electrodomesticos-fermin_006432595_000000001.html','','','2020-01-13 02:17:52','no'),(19,'ALMERIA','Jsp Electrodomésticos','','Electrodomésticos','Calle Cuenca, 1, 04007, Almería','','','','Electrodomésticos: establecimientos en Almería | Electrodomésticos en AlmeríaServicio Técnico','no','no','https://www.paginasamarillas.es/f/almeria/jsp-electrodomesticos_204494710_000000002.html','','','2020-01-13 02:17:52','no'),(20,'ALMERIA','Panelfri','','Electrodomésticos','Calle La Merced, 21 , 04006, Almería','','','','Aire acondicionado: equipos e instalaciones en Almería | Aire acondicionado en AlmeríaClimatización, reparación y mantenimiento de equip','no','no','https://www.paginasamarillas.es/f/almeria/panelfri_145036679_000000002.html','','','2020-01-13 02:17:52','no'),(21,'ALMERIA','SERGIO EDUARDO RODRIGUEZ ARAGÓN','','Electrodomésticos','Gran Capitán, 27 CASA, 04003, Almería','','','','Electrodomesticos: reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/sergio-eduardo-rodriguez-aragon_222906232_000000001.html','','','2020-01-13 02:17:52','no'),(22,'ALMERIA','ELECTRONICA BARCO','','Electrodomésticos','Berenguel, 71-73 BAJO, 04004, Almería','','http://www.electronicabarco.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Sonido tv y video: reparacion en Almería | Sonido tv y video en Almería','no','no','https://www.paginasamarillas.es/f/almeria/electronica-barco_020330445_000000001.html','','','2020-01-13 02:17:53','no'),(23,'ALMERIA','JOSE ANTONIO VICENTE SANCHEZ','','Electrodomésticos','Sierra Morena, 19 BAJO, 04009, Almería','','','','Electrodomésticos: reparación en Almería | Electrodomésticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/jose-antonio-vicente-sanchez_006475263_000000001.html','','','2020-01-13 02:17:53','no'),(24,'ALMERIA','ELECTRO YESTE VELEZ C.B.','','Electrodomésticos','Dr. Martínez Oña, 2 LOCAL, 04006, Almería','','','','Electrodomesticos: fabricantes y mayoristas en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/electro-yeste-velez-c-b-_017138413_000000001.html','','','2020-01-13 02:17:53','no'),(25,'ALMERIA','Meridional Sat','','Electrodomésticos','Manuel Azaña, 143 LOCAL, 04006, Almería','','http://www.fagor.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electrodomesticos: reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/meridional-sat_196453807_000000003.html','','','2020-01-13 02:17:53','no'),(26,'ALMERIA','JUAN MANUEL LLORCA SOLÍS','','Electrodomésticos','Turquesa, 73 BAJO, 04008, Almería','','http://www.reparaciondeelectrodomesticosalmeria.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electrodomesticos: reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/juan-manuel-llorca-solis_006418248_000000001.html','','','2020-01-13 02:17:53','no'),(27,'ALMERIA','SERVICIOS YUNQUE','','Electrodomésticos','Antonio González Vizcaíno, 16 BAJO, 04006, Almería','','','','Electrodomesticos: reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/servicios-yunque_219017860_000000001.html','','','2020-01-13 02:17:53','no'),(28,'ALMERIA','Va El Técnico','','Electrodomésticos','La Palma, 26, 04003, Almería','','http://www.vaeltecnico.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electrodomesticos: reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/va-el-tecnico_223083189_000000001.html','','','2020-01-13 02:17:53','no'),(29,'ALMERIA','SATELLA','','Electrodomésticos','Luzán, S/N, 04003, Almería','','','','Electrodomesticos: reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/satella_219377066_000000001.html','','','2020-01-13 02:17:53','no'),(30,'ALMERIA','Asis-Tec','','Electrodomésticos','Madre Sacramento, 2, 04008, Almería','','','','Electrodomésticos: reparación en Almería | Electrodomésticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/asis-tec_220956270_000000001.html','','','2020-01-13 02:17:53','no'),(31,'ALMERIA','DANIEL VÍCTOR MARISCAL GARCÍA','','Electrodomésticos','Etna, 8 5º H, 04008, Almería','','http://www.reparacioneselectrodomesticos-almeria.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electricidad: instalaciones en Almería | Electricidad en Almería','no','no','https://www.paginasamarillas.es/f/almeria/daniel-victor-mariscal-garcia_200628410_000000001.html','','','2020-01-13 02:17:53','no'),(32,'ALMERIA','Almeria Reparaciones.Com','','Electrodomésticos','Paseo Almería, 1, 04001, Almería','','http://www.almeriareparaciones.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electrodomésticos: reparación en Almería | Electrodomésticos en AlmeríaServicio técnico 24 horas.','no','no','https://www.paginasamarillas.es/f/almeria/almeria-reparaciones-com_204989156_000000003.html','','','2020-01-13 02:17:53','no'),(33,'ALMERIA','Rondasat 1959','','Electrodomésticos','Calle Dr. Barraquer, 7 BAJO, 04005, Almería','','','','Electrodomésticos: reparación en Almería | Electrodomésticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/rondasat-1959_165188285_000000001.html','','','2020-01-13 02:17:54','no'),(34,'ALMERIA','PUNTO AZUL','','Electrodomésticos','Guadarrama, 2, 04006, Almería','','','','Electrodomesticos: establecimientos en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/punto-azul_223864612_000000001.html','','','2020-01-13 02:17:54','no'),(35,'ALMERIA','JUAN ÁNGEL MÉNDEZ BERENGUEL','','Electrodomésticos','Pl. Santa Isabel, 1 BAJO, 04009, Almería','','','','Electrodomesticos: reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/juan-angel-mendez-berenguel_018074484_000000002.html','','','2020-01-13 02:17:54','no'),(36,'ALMERIA','Asistec','','Electrodomésticos','Calle El Olivo, 1 , 04006, Almería','','http://asistec-almeria.com?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electrodomésticos, pequeños aparatos: reparación en Almería | Electrodomésticos, pequeños aparatos en AlmeríaServicio tecnico de electrodomesticos y aire acon.','no','no','https://www.paginasamarillas.es/f/almeria/asistec_220956270_000000002.html','','','2020-01-13 02:17:54','no'),(37,'ALMERIA','Bogatec','','Electrodomésticos','Villa de Artes, 7, 04006, Almería','','','','Electrodomesticos: reparacion en Almería | Electrodomesticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/bogatec_203477914_000000002.html','','','2020-01-13 02:17:54','no'),(38,'ALMERIA','H.A.Gonzalez Reparaciones','','Electrodomésticos','Calle Mejorana, 27 BAJO, 04007, Almería','','http://www.reparacioneshag.es?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Reformas en general en Almería | Reparacion 24 horas aire acondicionado | Pintura a domicilioFontanería, albañilería, electricidad.','no','no','https://www.paginasamarillas.es/f/almeria/h-a-gonzalez-reparaciones_198277071_000000001.html','','','2020-01-13 02:17:54','no'),(39,'ALMERIA','La - Fri - Ter','','Electrodomésticos','Avenida de Santa Isabel, 88, 04009, Almería','','http://www.lafriter.es?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Electrodomésticos: recambios y accesorios en Almería | Electrodomésticos en Almería','no','no','https://www.paginasamarillas.es/f/almeria/la-fri-ter_019404672_000000001.html','','','2020-01-13 02:17:54','no'),(40,'ALMERIA','Talleres y Suministros Peyma','','Electrodomésticos','Carretera Málaga, 189 , 18015, Granada','','http://www.tallerespeyma.es?utm_campaign=paginasamarillas&utm_source=paginasamarillas&utm_medium=referral','','Torneros mecánicos en GranadaMantenimiento y reparación de todo tipo de maquina','no','no','https://www.paginasamarillas.es/f/granada/talleres-y-suministros-peyma_012188553_000000001.html','','','2020-01-13 02:17:54','no');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensaje` (
  `idMensaje` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(10) unsigned DEFAULT NULL,
  `fechaHora` datetime DEFAULT NULL,
  `mensaje` varchar(1000) DEFAULT NULL,
  `encargadoLLamar` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMensaje`),
  UNIQUE KEY `idContestacion_UNIQUE` (`idMensaje`),
  KEY `idEmpresa_idContestacion_idx` (`idEmpresa`),
  CONSTRAINT `FK_idEmpresa_mensaje` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefono`
--

DROP TABLE IF EXISTS `telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telefono` (
  `idTelefono` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(10) unsigned DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTelefono`),
  UNIQUE KEY `idLocal_UNIQUE` (`idTelefono`),
  KEY `idEmpresa_idLocal_idx` (`idEmpresa`),
  CONSTRAINT `FK_idEmpresa_telefono` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefono`
--

LOCK TABLES `telefono` WRITE;
/*!40000 ALTER TABLE `telefono` DISABLE KEYS */;
INSERT INTO `telefono` VALUES (1,1,'ALMERíA','600456033'),(2,2,'ALMERíA','609542400'),(3,3,'ALMERíA','640010623'),(4,4,'ALMERíA','659886670'),(5,5,'ALMERíA','640010649'),(6,6,'ALMERíA','662606607'),(7,7,'ALMERíA','628360672'),(8,8,'ALMERíA','628360817'),(9,9,'ALMERíA','660023051'),(10,10,'ALMERíA','628360873'),(11,11,'ALMERíA','640010662'),(12,12,'ALMERíA','683222805'),(13,13,'ALMERíA','667446446'),(14,14,'ALMERíA','628360668'),(15,15,'PELIGROS','958651019'),(16,16,'ALMERíA','950271156'),(17,17,'ROQUETAS DE MAR','950322337'),(18,18,'ALMERíA','950235989'),(19,19,'ALMERíA','692733712'),(20,20,'ALMERíA','607674000'),(21,21,'ALMERíA','607740048'),(22,22,'ALMERíA','950253465'),(23,23,'ALMERíA','950142666'),(24,17,'ALMERíA','950235282'),(25,24,'ALMERíA','950622222'),(26,25,'ALMERíA','950228460'),(27,26,'ALMERíA','639911626'),(28,27,'ALMERíA','950265000'),(29,28,'ALMERíA','672551395'),(30,29,'ALMERíA','950281028'),(31,30,'ALMERíA','627301499'),(32,31,'ALMERíA','665780713'),(33,32,'ALMERíA','950651922'),(34,33,'ALMERíA','950265286'),(35,34,'ALMERíA','662265490'),(36,35,'ALMERíA','950236133'),(37,36,'ALMERíA','642570327'),(38,37,'ALMERíA','654926913'),(39,17,'ALMERíA','625344952'),(40,38,'ALMERíA','679342369'),(41,39,'ALMERíA','950253905'),(42,40,'GRANADA','958277457');
/*!40000 ALTER TABLE `telefono` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-13 17:55:29
