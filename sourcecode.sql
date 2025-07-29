-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: dbms_proj
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

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
-- Table structure for table `activevisitors`
--

DROP TABLE IF EXISTS `activevisitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activevisitors` (
  `flatno` int NOT NULL,
  `towerno` int NOT NULL,
  `visname` varchar(30) NOT NULL,
  `visdate` date NOT NULL,
  `otp` int NOT NULL,
  PRIMARY KEY (`otp`),
  KEY `fkactive` (`flatno`,`towerno`),
  CONSTRAINT `fkactive` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activevisitors`
--

LOCK TABLES `activevisitors` WRITE;
/*!40000 ALTER TABLE `activevisitors` DISABLE KEYS */;
INSERT INTO `activevisitors` VALUES (123,1,'akdh','2024-04-23',848920);
/*!40000 ALTER TABLE `activevisitors` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`debian-sys-maint`@`localhost`*/ /*!50003 TRIGGER `pastvisitors_entry` AFTER DELETE ON `activevisitors` FOR EACH ROW BEGIN
    INSERT INTO pastvisitors (flatno, towerno, visname, visdate, otp)
    VALUES (OLD.flatno, OLD.towerno, OLD.visname, OLD.visdate, OLD.otp);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `datey` date NOT NULL,
  `timeslot` varchar(20) NOT NULL,
  `area` varchar(30) NOT NULL,
  `flatno` int NOT NULL,
  `towerno` int NOT NULL,
  PRIMARY KEY (`flatno`,`towerno`,`timeslot`),
  CONSTRAINT `fkbook` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES ('2024-04-19','4-5','volleyball',123,1),('2024-04-24','5-6','cricketnet',123,1),('2024-04-26','6-7','volleyball',123,1),('2024-04-02','4-5','basketball',123,2),('2024-04-24','5-6','basketball',128,1),('2024-04-02','5-6','basketball',185,1),('2024-04-25','4-5','basketball',195,1);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complaints` (
  `place` varchar(30) NOT NULL,
  `timeslot` varchar(20) NOT NULL,
  `problem` varchar(100) NOT NULL,
  `towerno` int NOT NULL,
  `flatno` int NOT NULL,
  PRIMARY KEY (`flatno`,`towerno`,`problem`,`timeslot`),
  CONSTRAINT `fkcomp` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES ('5th floor','8-9','Plumber',1,123);
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`debian-sys-maint`@`localhost`*/ /*!50003 TRIGGER `complaints_trigger` AFTER DELETE ON `complaints` FOR EACH ROW BEGIN
    INSERT INTO pastcomplaints (flatno, towerno, place, timeslot, problem, timeofresolution)
    VALUES (OLD.flatno, OLD.towerno, OLD.place, OLD.timeslot, OLD.problem, NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `electricitybills`
--

DROP TABLE IF EXISTS `electricitybills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `electricitybills` (
  `flatno` int NOT NULL,
  `towerno` int NOT NULL,
  `mon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dueamt` int NOT NULL,
  PRIMARY KEY (`flatno`,`towerno`,`mon`),
  CONSTRAINT `fkelec` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `electricitybills`
--

LOCK TABLES `electricitybills` WRITE;
/*!40000 ALTER TABLE `electricitybills` DISABLE KEYS */;
INSERT INTO `electricitybills` VALUES (123,1,'july',250),(123,1,'may',2000),(200,5,'april',2000);
/*!40000 ALTER TABLE `electricitybills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flats`
--

DROP TABLE IF EXISTS `flats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flats` (
  `flatno` int NOT NULL,
  `towerno` int NOT NULL,
  PRIMARY KEY (`flatno`,`towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flats`
--

LOCK TABLES `flats` WRITE;
/*!40000 ALTER TABLE `flats` DISABLE KEYS */;
INSERT INTO `flats` VALUES (123,1),(123,2),(128,1),(156,2),(185,1),(195,1),(200,1),(200,5);
/*!40000 ALTER TABLE `flats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginids`
--

DROP TABLE IF EXISTS `loginids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginids` (
  `email` varchar(30) NOT NULL,
  `passcode` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `designation` varchar(30) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginids`
--

LOCK TABLES `loginids` WRITE;
/*!40000 ALTER TABLE `loginids` DISABLE KEYS */;
INSERT INTO `loginids` VALUES ('abhishek','abhi','resident'),('adi.com','adi','admin'),('balu','123','resident'),('first','first','resident'),('harshin.com','har','security'),('mukund','mukund','workforce'),('suh.com','suh','security'),('tar.com','tar','resident'),('ven.com','ven','workforce'),('venkatesh','venky','resident');
/*!40000 ALTER TABLE `loginids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintanencebills`
--

DROP TABLE IF EXISTS `maintanencebills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maintanencebills` (
  `flatno` int NOT NULL,
  `towerno` int NOT NULL,
  `mon` varchar(20) NOT NULL,
  `dueamt` int NOT NULL,
  PRIMARY KEY (`flatno`,`mon`,`towerno`),
  KEY `fkmain` (`flatno`,`towerno`),
  CONSTRAINT `fkmain` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintanencebills`
--

LOCK TABLES `maintanencebills` WRITE;
/*!40000 ALTER TABLE `maintanencebills` DISABLE KEYS */;
INSERT INTO `maintanencebills` VALUES (123,1,'january',505),(123,1,'may',5000),(200,5,'january',2500);
/*!40000 ALTER TABLE `maintanencebills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mem_presidents`
--

DROP TABLE IF EXISTS `mem_presidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mem_presidents` (
  `pres_name` varchar(30) NOT NULL,
  `towerno` int NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mem_presidents`
--

LOCK TABLES `mem_presidents` WRITE;
/*!40000 ALTER TABLE `mem_presidents` DISABLE KEYS */;
INSERT INTO `mem_presidents` VALUES ('suhas',1,'999999999');
/*!40000 ALTER TABLE `mem_presidents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mem_residents`
--

DROP TABLE IF EXISTS `mem_residents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mem_residents` (
  `flatno` int NOT NULL,
  `towerno` int NOT NULL,
  `resi_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`towerno`,`resi_name`,`flatno`),
  KEY `fkmemr` (`flatno`,`towerno`),
  CONSTRAINT `fkmemr` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mem_residents`
--

LOCK TABLES `mem_residents` WRITE;
/*!40000 ALTER TABLE `mem_residents` DISABLE KEYS */;
INSERT INTO `mem_residents` VALUES (123,1,'first','Male','884764638'),(128,1,'suhas','Male','9999999999'),(200,1,'venkat','Male','1234567899'),(156,2,'abhishek','Male','7937893247'),(200,5,'venkatesh','Male','9898989898');
/*!40000 ALTER TABLE `mem_residents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mem_security`
--

DROP TABLE IF EXISTS `mem_security`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mem_security` (
  `security_id` varchar(30) NOT NULL,
  `sec_name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `assigned_place` varchar(50) NOT NULL,
  PRIMARY KEY (`security_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mem_security`
--

LOCK TABLES `mem_security` WRITE;
/*!40000 ALTER TABLE `mem_security` DISABLE KEYS */;
INSERT INTO `mem_security` VALUES ('ABC','Bob','6666666666','gate');
/*!40000 ALTER TABLE `mem_security` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mem_workforce`
--

DROP TABLE IF EXISTS `mem_workforce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mem_workforce` (
  `worker_name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `field` varchar(15) NOT NULL,
  PRIMARY KEY (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mem_workforce`
--

LOCK TABLES `mem_workforce` WRITE;
/*!40000 ALTER TABLE `mem_workforce` DISABLE KEYS */;
INSERT INTO `mem_workforce` VALUES ('mukund','9898989898','Plumber');
/*!40000 ALTER TABLE `mem_workforce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notices` (
  `notice` varchar(258) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notices`
--

LOCK TABLES `notices` WRITE;
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
INSERT INTO `notices` VALUES ('welcome to iiita','2024-04-26','2024-04-27'),('welcome to clg','2024-04-26','2024-04-27'),('welcome','2024-04-25','2024-04-27'),('yufif','2024-04-25','2024-04-30');
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passcodes`
--

DROP TABLE IF EXISTS `passcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passcodes` (
  `visiname` varchar(30) NOT NULL,
  `visidate` date NOT NULL,
  `flatno` int NOT NULL,
  `towerno` int NOT NULL,
  `otp` int NOT NULL,
  PRIMARY KEY (`otp`),
  KEY `fkpass` (`flatno`,`towerno`),
  CONSTRAINT `fkpass` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passcodes`
--

LOCK TABLES `passcodes` WRITE;
/*!40000 ALTER TABLE `passcodes` DISABLE KEYS */;
INSERT INTO `passcodes` VALUES ('match','2024-04-19',195,1,746894);
/*!40000 ALTER TABLE `passcodes` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`debian-sys-maint`@`localhost`*/ /*!50003 TRIGGER `passcode_trigger` AFTER DELETE ON `passcodes` FOR EACH ROW BEGIN
    INSERT INTO activevisitors (flatno, towerno, visname, visdate, otp)
    VALUES (OLD.flatno, OLD.towerno, OLD.visiname, OLD.visidate, OLD.otp);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `pastcomplaints`
--

DROP TABLE IF EXISTS `pastcomplaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pastcomplaints` (
  `place` varchar(30) NOT NULL,
  `timeslot` varchar(30) NOT NULL,
  `problem` varchar(30) NOT NULL,
  `towerno` int NOT NULL,
  `flatno` int NOT NULL,
  `timeofresolution` timestamp(6) NOT NULL,
  KEY `fkpastc` (`flatno`,`towerno`),
  CONSTRAINT `fkpastc` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pastcomplaints`
--

LOCK TABLES `pastcomplaints` WRITE;
/*!40000 ALTER TABLE `pastcomplaints` DISABLE KEYS */;
INSERT INTO `pastcomplaints` VALUES ('gate','11:00 - 12:00','Network',1,123,'2024-04-23 19:49:04.000000'),('gate','17:00 - 18:00','Plumber',1,195,'2024-04-25 00:32:04.000000'),('cc3','10:00 - 11:00','Electrician',1,123,'2024-04-25 11:41:00.000000'),('cc3','12:00 - 13:00','Plumber',1,123,'2024-04-25 11:42:17.000000');
/*!40000 ALTER TABLE `pastcomplaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pastvisitors`
--

DROP TABLE IF EXISTS `pastvisitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pastvisitors` (
  `flatno` int NOT NULL,
  `towerno` int NOT NULL,
  `visname` varchar(30) NOT NULL,
  `visdate` date NOT NULL,
  `otp` int NOT NULL,
  PRIMARY KEY (`otp`,`visdate`),
  KEY `fkpastv` (`flatno`,`towerno`),
  CONSTRAINT `fkpastv` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pastvisitors`
--

LOCK TABLES `pastvisitors` WRITE;
/*!40000 ALTER TABLE `pastvisitors` DISABLE KEYS */;
INSERT INTO `pastvisitors` VALUES (195,1,'srh_always','2024-04-24',149887),(123,1,'adi','2024-04-20',332274),(123,1,'first','2024-04-26',392324),(123,2,'sdf','2024-04-16',584476),(195,1,'srh','2024-04-24',904205);
/*!40000 ALTER TABLE `pastvisitors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_res`
--

DROP TABLE IF EXISTS `user_res`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_res` (
  `email` varchar(30) NOT NULL,
  `passcode` varchar(20) NOT NULL,
  `towerno` int NOT NULL,
  `flatno` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fkuser` (`flatno`,`towerno`),
  CONSTRAINT `fkuser` FOREIGN KEY (`flatno`, `towerno`) REFERENCES `flats` (`flatno`, `towerno`),
  CONSTRAINT `fkuser_res` FOREIGN KEY (`email`) REFERENCES `loginids` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_res`
--

LOCK TABLES `user_res` WRITE;
/*!40000 ALTER TABLE `user_res` DISABLE KEYS */;
INSERT INTO `user_res` VALUES ('first','first',1,123),('tar.com','tar',1,195);
/*!40000 ALTER TABLE `user_res` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-29  4:43:27
