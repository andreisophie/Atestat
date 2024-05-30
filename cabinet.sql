-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cabinet
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `consultatii`
--

DROP TABLE IF EXISTS `consultatii`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultatii` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_pacient` int(11) NOT NULL,
  `ID_medic` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Ora` time NOT NULL,
  `Observatii` text DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Consultatie.Pacient` (`ID_pacient`),
  KEY `Consultatie.Medic` (`ID_medic`),
  CONSTRAINT `Consultatie.Medic` FOREIGN KEY (`ID_medic`) REFERENCES `doctori` (`ID`),
  CONSTRAINT `Consultatie.Pacient` FOREIGN KEY (`ID_pacient`) REFERENCES `pacienti` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultatii`
--

LOCK TABLES `consultatii` WRITE;
/*!40000 ALTER TABLE `consultatii` DISABLE KEYS */;
INSERT INTO `consultatii` VALUES (1,9,5,'2021-04-04','21:30:00','Pacientul este sanatos              &gt;'),(2,16,2,'2021-02-17','21:34:00','Pacientul necesita verificare'),(4,16,2,'2021-02-26','04:15:00','Maseaua D4 ranita, necesita medicatie 2 luni'),(7,19,1,'2021-04-11','15:57:00','Marire dioptrii 0.2'),(8,37,4,'2021-04-02','13:01:00','Patentul nu are nevoie de tratament'),(12,9,1,'2021-04-10','21:42:00','Este bine.'),(23,19,2,'2020-07-17','22:42:00','Pacientul necesita vitamine.');
/*!40000 ALTER TABLE `consultatii` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctori`
--

DROP TABLE IF EXISTS `doctori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctori` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(50) NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `Sex` enum('M','F','Altele') NOT NULL DEFAULT 'Altele',
  `Data nasterii` date NOT NULL,
  `CNP` bigint(13) NOT NULL,
  `Varsta` int(11) NOT NULL,
  `E-mail` varchar(50) NOT NULL,
  `Telefon` varchar(10) NOT NULL,
  `ID_specializare` int(11) NOT NULL,
  `Sporuri salariu` int(11) NOT NULL DEFAULT 0,
  `Data angajarii` date NOT NULL,
  `ID_judet` int(11) NOT NULL,
  `Oras` varchar(50) NOT NULL,
  `Strada` varchar(50) NOT NULL,
  `Cod postal` varchar(11) NOT NULL,
  `Numar` varchar(11) DEFAULT NULL,
  `Bloc` varchar(10) DEFAULT NULL,
  `Apartament` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Medici.Specializare` (`ID_specializare`),
  KEY `Medici.Judet` (`ID_judet`),
  CONSTRAINT `Medici.Judet` FOREIGN KEY (`ID_judet`) REFERENCES `judete` (`ID`),
  CONSTRAINT `Medici.Specializare` FOREIGN KEY (`ID_specializare`) REFERENCES `specializari` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctori`
--

LOCK TABLES `doctori` WRITE;
/*!40000 ALTER TABLE `doctori` DISABLE KEYS */;
INSERT INTO `doctori` VALUES (1,'Tache','Daniela','F','1983-08-06',2648953124987,37,'tachedanela@yahoo.com','0729865214',1,250,'2020-06-19',32,'Ploiesti','Str Unirii','168952','24','3C','14'),(2,'Fossil','Mirel','M','1946-05-12',3589654987258,74,'fossil_mirel@gmail.com','0727564387',2,1020,'2016-07-07',42,'Focsani','Str Revolutiei','6952','1223',NULL,NULL),(4,'Radio','Cornelius','M','1965-11-23',1389465789324,55,'racio_codrnelius@yahoo.com','0726589532',4,1000,'2019-05-15',11,'Buzau','Str Gloriei','138698','45',NULL,NULL),(5,'Coca','Melania','F','1988-03-11',3569875316498,33,'mcoca@gmail.com','0726589478',5,2500,'2020-06-13',11,'Maracineni','Str Principala','139654','10','','0');
/*!40000 ALTER TABLE `doctori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `judete`
--

DROP TABLE IF EXISTS `judete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `judete` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `judete`
--

LOCK TABLES `judete` WRITE;
/*!40000 ALTER TABLE `judete` DISABLE KEYS */;
INSERT INTO `judete` VALUES (1,'Alba'),(2,'Arad'),(3,'Argeș'),(4,'Bacău'),(5,'Bihor'),(6,'Bistrița-Năsăud'),(7,'Botoșani'),(8,'Brașov'),(9,'Brăila'),(10,'București'),(11,'Buzău'),(12,'Caraș-Severin'),(13,'Călărași'),(14,'Cluj'),(15,'Constanța'),(16,'Covasna'),(17,'Dămbovița'),(18,'Dolj'),(19,'Galați'),(20,'Giurgiu'),(21,'Gorj'),(22,'Harghita'),(23,'Hunedoara'),(24,'Ialomița'),(25,'Iași'),(26,'Ilfov'),(27,'Maramureș'),(28,'Mehedinți'),(29,'Mureș'),(30,'Neamț'),(31,'Olt'),(32,'Prahova'),(33,'Satu Mare'),(34,'Sălaj'),(35,'Sibiu'),(36,'Suceava'),(37,'Teleorman'),(38,'Timiș'),(39,'Tulcea'),(40,'Vaslui'),(41,'Vâlcea'),(42,'Vrancea');
/*!40000 ALTER TABLE `judete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamente`
--

DROP TABLE IF EXISTS `medicamente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Denumire` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamente`
--

LOCK TABLES `medicamente` WRITE;
/*!40000 ALTER TABLE `medicamente` DISABLE KEYS */;
INSERT INTO `medicamente` VALUES (1,'Paracetamol'),(2,'Lacium'),(3,'Vitamina C 3000mg'),(4,'Aspirina 1000mg'),(5,'Faringosept'),(6,'Supramax articulații'),(8,'Bioforte 3000');
/*!40000 ALTER TABLE `medicamente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacienti`
--

DROP TABLE IF EXISTS `pacienti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacienti` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(50) NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `Sex` enum('M','F','Altele') NOT NULL DEFAULT 'Altele',
  `Data nasterii` date NOT NULL,
  `CNP` bigint(13) NOT NULL,
  `Telefon` varchar(10) NOT NULL,
  `E-mail` varchar(50) DEFAULT NULL,
  `Varsta` int(11) NOT NULL,
  `ID_judet` int(11) NOT NULL,
  `Oras` varchar(50) NOT NULL,
  `Strada` varchar(50) NOT NULL,
  `Cod postal` varchar(11) NOT NULL,
  `Numar` varchar(11) DEFAULT NULL,
  `Bloc` varchar(10) DEFAULT NULL,
  `Apartament` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Pacienti.Judet` (`ID_judet`),
  CONSTRAINT `Pacienti.Judet` FOREIGN KEY (`ID_judet`) REFERENCES `judete` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacienti`
--

LOCK TABLES `pacienti` WRITE;
/*!40000 ALTER TABLE `pacienti` DISABLE KEYS */;
INSERT INTO `pacienti` VALUES (9,'Popescu','Cecilia','F','1983-08-06',4830806100131,'0724685621','Popcec@gmail.com',37,11,'Buzau','Bd 1 Dec 1918','124649','22','3J','16'),(11,'Dan','Silviu','M','1975-05-23',1648953214785,'0726358941','dsilviu@yahoo.com',46,37,'Vaslui','Str Capitalei','165235','46',NULL,NULL),(16,'Ionel','Valina','M','1999-06-11',5698324759861,'0725689475','ival@gmail.com',21,11,'Buzau','Str Unirii','054321','29','7H','16'),(19,'Stan','Consuela','F','1999-06-11',5698324759861,'0725689475','consuela@gmail.com',21,11,'Buzau','Str Decebal','000001','5','2I','51'),(37,'Esperantia','Piscopesco','M','1973-07-07',23186489456,'0735698324','ep@gmail.com',47,24,'Slobozia','Str Buzaului','15487','23','5C','4');
/*!40000 ALTER TABLE `pacienti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retete`
--

DROP TABLE IF EXISTS `retete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retete` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_consultatie` int(11) NOT NULL,
  `ID_medicament` int(11) NOT NULL,
  `Cantitate` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Retete.Medicament` (`ID_medicament`),
  KEY `ID_consultatie` (`ID_consultatie`),
  CONSTRAINT `Retete.Consultatie` FOREIGN KEY (`ID_consultatie`) REFERENCES `consultatii` (`ID`),
  CONSTRAINT `Retete.Medicament` FOREIGN KEY (`ID_medicament`) REFERENCES `medicamente` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retete`
--

LOCK TABLES `retete` WRITE;
/*!40000 ALTER TABLE `retete` DISABLE KEYS */;
INSERT INTO `retete` VALUES (10,1,8,'3 pastile/saptamana'),(11,2,5,'1 pastila/zi'),(14,2,3,'2 pastile/saptamana'),(15,1,3,'1/2 pastile/zi'),(16,4,6,'3 pastile/zi'),(18,4,8,'3 pastile/zi'),(19,1,1,'3 pastile/zi timp de 1 saptamana'),(21,8,3,'1 pastila/zi'),(22,8,6,'1 pastila/saptamana'),(37,7,1,'7 pastile/zi'),(42,7,4,'14 pastile/zi'),(44,23,3,'213');
/*!40000 ALTER TABLE `retete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specializari`
--

DROP TABLE IF EXISTS `specializari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specializari` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Denumire` varchar(50) NOT NULL,
  `Salariu_baza` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specializari`
--

LOCK TABLES `specializari` WRITE;
/*!40000 ALTER TABLE `specializari` DISABLE KEYS */;
INSERT INTO `specializari` VALUES (1,'Oftalmolog',5000),(2,'Stomatolog',8000),(4,'Cardiolog',9500),(5,'Neurolog',9000);
/*!40000 ALTER TABLE `specializari` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-13 14:10:40
