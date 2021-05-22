CREATE DATABASE  IF NOT EXISTS `travel_journal_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `travel_journal_db`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: travel_journal_db
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id_usr` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_usr`),
  CONSTRAINT `FK_id_usr_admin` FOREIGN KEY (`id_usr`) REFERENCES `user` (`id_usr`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answer` (
  `id_ans` int NOT NULL AUTO_INCREMENT,
  `text` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category_1` tinyint NOT NULL,
  `category_2` tinyint NOT NULL,
  `category_3` tinyint NOT NULL,
  `category_4` tinyint NOT NULL,
  `category_5` tinyint NOT NULL,
  `id_qst` int NOT NULL,
  PRIMARY KEY (`id_ans`),
  KEY `FK_id_qst_answer_idx` (`id_qst`),
  CONSTRAINT `FK_id_qst_answer` FOREIGN KEY (`id_qst`) REFERENCES `question` (`id_qst`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awarded`
--

DROP TABLE IF EXISTS `awarded`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awarded` (
  `id_usr` int NOT NULL,
  `id_bdg` int NOT NULL,
  PRIMARY KEY (`id_usr`,`id_bdg`),
  KEY `FK_id_bdg_won_idx` (`id_bdg`),
  CONSTRAINT `FK_id_bdg_awarded` FOREIGN KEY (`id_bdg`) REFERENCES `badge` (`id_bdg`) ON UPDATE CASCADE,
  CONSTRAINT `FK_id_usr_awarded` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awarded`
--

LOCK TABLES `awarded` WRITE;
/*!40000 ALTER TABLE `awarded` DISABLE KEYS */;
/*!40000 ALTER TABLE `awarded` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badge`
--

DROP TABLE IF EXISTS `badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `badge` (
  `id_bdg` int NOT NULL AUTO_INCREMENT,
  `icon_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_bdg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badge`
--

LOCK TABLES `badge` WRITE;
/*!40000 ALTER TABLE `badge` DISABLE KEYS */;
/*!40000 ALTER TABLE `badge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `continent`
--

DROP TABLE IF EXISTS `continent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `continent` (
  `id_con` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `continent`
--

LOCK TABLES `continent` WRITE;
/*!40000 ALTER TABLE `continent` DISABLE KEYS */;
INSERT INTO `continent` VALUES (1,'Europe'),(2,'Asia'),(3,'Africa'),(4,'North America'),(5,'South America'),(6,'Australia'),(7,'Antarctica');
/*!40000 ALTER TABLE `continent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id_cnt` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_con` tinyint NOT NULL,
  PRIMARY KEY (`id_cnt`),
  KEY `FK_id_con_country_idx` (`id_con`),
  CONSTRAINT `FK_id_con_country` FOREIGN KEY (`id_con`) REFERENCES `continent` (`id_con`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `id_img` int NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_rev` int DEFAULT NULL,
  PRIMARY KEY (`id_img`),
  KEY `FK_id_rev_image_idx` (`id_rev`),
  CONSTRAINT `FK_id_rev_image` FOREIGN KEY (`id_rev`) REFERENCES `review` (`id_rev`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `place` (
  `id_plc` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `categorized` tinyint NOT NULL,
  `category_1` tinyint NOT NULL,
  `category_2` tinyint NOT NULL,
  `category_3` tinyint NOT NULL,
  `category_4` tinyint NOT NULL,
  `category_5` tinyint NOT NULL,
  `id_img` int NOT NULL,
  `id_cnt` tinyint NOT NULL,
  PRIMARY KEY (`id_plc`),
  KEY `FK_id_img_place_idx` (`id_img`),
  KEY `FK_id_cnt_place_idx` (`id_cnt`),
  CONSTRAINT `FK_id_cnt_place` FOREIGN KEY (`id_cnt`) REFERENCES `country` (`id_cnt`) ON UPDATE CASCADE,
  CONSTRAINT `FK_id_img_place` FOREIGN KEY (`id_img`) REFERENCES `image` (`id_img`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `id_qst` int NOT NULL AUTO_INCREMENT,
  `text` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type_quiz` tinyint NOT NULL,
  `type_review` tinyint NOT NULL,
  `form` tinyint NOT NULL,
  PRIMARY KEY (`id_qst`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registered_user`
--

DROP TABLE IF EXISTS `registered_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registered_user` (
  `id_usr` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `surname` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `e-mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `security_answer_1` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `security_answer_2` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `security_answer_3` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `token_count` int NOT NULL,
  `avatar_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `acc_creation_date` date NOT NULL,
  `id_plc` int NOT NULL,
  PRIMARY KEY (`id_usr`),
  KEY `FK_id_plc_registered_user_idx` (`id_plc`),
  CONSTRAINT `FK_id_plc_registered_user` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE,
  CONSTRAINT `FK_id_usr_registered_user` FOREIGN KEY (`id_usr`) REFERENCES `user` (`id_usr`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registered_user`
--

LOCK TABLES `registered_user` WRITE;
/*!40000 ALTER TABLE `registered_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `registered_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `id_rev` int NOT NULL AUTO_INCREMENT,
  `title` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `privacy` tinyint NOT NULL,
  `token_count` int NOT NULL,
  `date_posted` date NOT NULL,
  `id_vis` int NOT NULL,
  PRIMARY KEY (`id_rev`),
  KEY `FK_id_vis_review_idx` (`id_vis`),
  CONSTRAINT `FK_id_vis_review` FOREIGN KEY (`id_vis`) REFERENCES `visited` (`id_vis`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `to-go`
--

DROP TABLE IF EXISTS `to-go`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `to-go` (
  `id_usr` int NOT NULL,
  `id_plc` int NOT NULL,
  `crossed_off` tinyint NOT NULL,
  PRIMARY KEY (`id_usr`,`id_plc`),
  KEY `FK_id_plc_to-go_idx` (`id_plc`),
  CONSTRAINT `FK_id_plc_to-go` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE,
  CONSTRAINT `FK_id_usr_to-go` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `to-go`
--

LOCK TABLES `to-go` WRITE;
/*!40000 ALTER TABLE `to-go` DISABLE KEYS */;
/*!40000 ALTER TABLE `to-go` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id_usr` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_usr`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin123','admin123');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visited`
--

DROP TABLE IF EXISTS `visited`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visited` (
  `id_vis` int NOT NULL AUTO_INCREMENT,
  `id_usr` int NOT NULL,
  `id_plc` int NOT NULL,
  PRIMARY KEY (`id_vis`),
  KEY `FK_id_usr_visited_idx` (`id_usr`),
  KEY `FK_id_plc_visited_idx` (`id_plc`),
  CONSTRAINT `FK_id_plc_visited` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE,
  CONSTRAINT `FK_id_usr_visited` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visited`
--

LOCK TABLES `visited` WRITE;
/*!40000 ALTER TABLE `visited` DISABLE KEYS */;
/*!40000 ALTER TABLE `visited` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-18 18:17:04
