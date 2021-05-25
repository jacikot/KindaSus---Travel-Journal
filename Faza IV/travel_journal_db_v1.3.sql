-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2021 at 11:23 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_journal_db`
--
CREATE DATABASE IF NOT EXISTS `travel_journal_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `travel_journal_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_adm` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `username`, `password`) VALUES
(1, 'admin123', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id_ans` int NOT NULL AUTO_INCREMENT,
  `text` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category_1` tinyint NOT NULL,
  `category_2` tinyint NOT NULL,
  `category_3` tinyint NOT NULL,
  `category_4` tinyint NOT NULL,
  `category_5` tinyint NOT NULL,
  `id_qst` int NOT NULL,
  PRIMARY KEY (`id_ans`),
  KEY `FK_id_qst_answer_idx` (`id_qst`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awarded`
--

DROP TABLE IF EXISTS `awarded`;
CREATE TABLE IF NOT EXISTS `awarded` (
  `id_usr` int NOT NULL,
  `id_bdg` int NOT NULL,
  PRIMARY KEY (`id_usr`,`id_bdg`),
  KEY `FK_id_bdg_won_idx` (`id_bdg`),
  KEY `FK_id_usr_awarded_idx` (`id_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

DROP TABLE IF EXISTS `badge`;
CREATE TABLE IF NOT EXISTS `badge` (
  `id_bdg` int NOT NULL AUTO_INCREMENT,
  `icon_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_bdg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `continent`
--

DROP TABLE IF EXISTS `continent`;
CREATE TABLE IF NOT EXISTS `continent` (
  `id_con` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `continent`
--

INSERT INTO `continent` (`id_con`, `name`) VALUES
(1, 'Europe'),
(2, 'Asia'),
(3, 'Africa'),
(4, 'North America'),
(5, 'South America'),
(6, 'Australia'),
(7, 'Antarctica');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id_cnt` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_con` tinyint NOT NULL,
  PRIMARY KEY (`id_cnt`),
  KEY `FK_id_con_country_idx` (`id_con`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id_cnt`, `name`, `code`, `id_con`) VALUES
(1, 'France', 'fr', 1),
(2, 'Russia', 'ru', 1),
(3, 'Serbia', 'rs', 1),
(4, 'Tanzania', 'tz', 3);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_img` int NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_rev` int DEFAULT NULL,
  PRIMARY KEY (`id_img`),
  KEY `FK_id_rev_image_idx` (`id_rev`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id_img`, `image_path`, `id_rev`) VALUES
(4, 'dummy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
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
  KEY `FK_id_cnt_place_idx` (`id_cnt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`id_plc`, `name`, `categorized`, `category_1`, `category_2`, `category_3`, `category_4`, `category_5`, `id_img`, `id_cnt`) VALUES
(1, 'Paris', 0, 0, 0, 0, 0, 0, 4, 1),
(2, 'Sankt Petersburg', 0, 0, 0, 0, 0, 0, 4, 2),
(3, 'Moscow', 0, 0, 0, 0, 0, 0, 4, 2),
(4, 'Belgrade', 0, 0, 0, 0, 0, 0, 4, 3),
(5, 'Zanzibar', 0, 0, 0, 0, 0, 0, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_qst` int NOT NULL AUTO_INCREMENT,
  `text` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type_quiz` tinyint NOT NULL,
  `type_review` tinyint NOT NULL,
  `form` tinyint NOT NULL,
  PRIMARY KEY (`id_qst`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered_user`
--

DROP TABLE IF EXISTS `registered_user`;
CREATE TABLE IF NOT EXISTS `registered_user` (
  `id_usr` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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
  KEY `FK_id_plc_registered_user_idx` (`id_plc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registered_user`
--

INSERT INTO `registered_user` (`id_usr`, `username`, `password`, `name`, `surname`, `e-mail`, `security_answer_1`, `security_answer_2`, `security_answer_3`, `token_count`, `avatar_path`, `acc_creation_date`, `id_plc`) VALUES
(1, 'adriance', 'ASDf123', 'Adriana', 'Vidic', 'vidic79adriana@gmail.com', 'Srbija', 'cebe', 'Marina', 0, '', '0000-00-00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id_rev` int NOT NULL AUTO_INCREMENT,
  `title` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `privacy` tinyint NOT NULL,
  `token_count` int NOT NULL,
  `date_posted` date NOT NULL,
  `id_vis` int NOT NULL,
  PRIMARY KEY (`id_rev`),
  KEY `FK_id_vis_review_idx` (`id_vis`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_rev`, `title`, `text`, `privacy`, `token_count`, `date_posted`, `id_vis`) VALUES
(3, 'Love', 'City of love <3', 0, 0, '2021-05-07', 1),
(5, 'Love', '', 0, 0, '2021-05-05', 1),
(6, 'Love', '', 0, 0, '2021-05-11', 1),
(7, 'Love', 'Please <3', 0, 0, '2021-05-12', 1),
(8, 'Je\'taime', 'Paris is not a city, it’s a world', 0, 0, '2021-05-08', 1),
(9, 'Dream', 'Oh, London is a man\'s town, there\'s power in the air;\nAnd Paris is a woman\'s town, with flowers in her hair;\nAnd it\'s sweet to dream in Venice, and it\'s great to study Rome;\nBut when it comes to living, there is no place like home.', 0, 0, '2021-05-08', 1),
(10, 'Amor', 'There is but one Paris and however hard living may be here, and if it became worse and harder even—the French air clears up the brain and does good—a world of good.', 0, 0, '2021-05-11', 1),
(11, 'Love, love, so much love', 'He who contemplates the depths of Paris is seized with vertigo.\nNothing is more fantastic. Nothing is more tragic.\nNothing is more sublime.', 0, 0, '2021-05-07', 4);

-- --------------------------------------------------------

--
-- Table structure for table `to-go`
--

DROP TABLE IF EXISTS `to-go`;
CREATE TABLE IF NOT EXISTS `to-go` (
  `id_usr` int NOT NULL,
  `id_plc` int NOT NULL,
  `crossed_off` tinyint NOT NULL,
  PRIMARY KEY (`id_usr`,`id_plc`),
  KEY `FK_id_plc_to-go_idx` (`id_plc`),
  KEY `FK_id_usr_to-go_idx` (`id_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `to-go` (`id_usr`, `id_plc`, `crossed_off`) VALUES
(1, 5, 0);


-- --------------------------------------------------------

--
-- Table structure for table `visited`
--

DROP TABLE IF EXISTS `visited`;
CREATE TABLE IF NOT EXISTS `visited` (
  `id_vis` int NOT NULL AUTO_INCREMENT,
  `id_usr` int NOT NULL,
  `id_plc` int NOT NULL,
  PRIMARY KEY (`id_vis`),
  KEY `FK_id_plc_visited_idx` (`id_plc`),
  KEY `FK_id_usr_visited_idx` (`id_usr`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visited`
--

INSERT INTO `visited` (`id_vis`, `id_usr`, `id_plc`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 2);
(4, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `FK_id_qst_answer` FOREIGN KEY (`id_qst`) REFERENCES `question` (`id_qst`) ON UPDATE CASCADE;

--
-- Constraints for table `awarded`
--
ALTER TABLE `awarded`
  ADD CONSTRAINT `FK_id_bdg_awarded` FOREIGN KEY (`id_bdg`) REFERENCES `badge` (`id_bdg`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_usr_awarded` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON UPDATE CASCADE;

--
-- Constraints for table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `FK_id_con_country` FOREIGN KEY (`id_con`) REFERENCES `continent` (`id_con`) ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_id_rev_image` FOREIGN KEY (`id_rev`) REFERENCES `review` (`id_rev`) ON UPDATE CASCADE;

--
-- Constraints for table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `FK_id_cnt_place` FOREIGN KEY (`id_cnt`) REFERENCES `country` (`id_cnt`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_img_place` FOREIGN KEY (`id_img`) REFERENCES `image` (`id_img`) ON UPDATE CASCADE;

--
-- Constraints for table `registered_user`
--
ALTER TABLE `registered_user`
  ADD CONSTRAINT `FK_id_plc_registered_user` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_id_vis_review` FOREIGN KEY (`id_vis`) REFERENCES `visited` (`id_vis`) ON UPDATE CASCADE;

--
-- Constraints for table `to-go`
--
ALTER TABLE `to-go`
  ADD CONSTRAINT `FK_id_plc_to-go` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_usr_to-go` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON UPDATE CASCADE;

--
-- Constraints for table `visited`
--
ALTER TABLE `visited`
  ADD CONSTRAINT `FK_id_plc_visited` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_usr_visited` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
