-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2021 at 02:04 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `username`, `password`) VALUES
(1, 'admin123', 'admin123'),
(2, 'adminka123', 'adminka123');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id_ans` int NOT NULL AUTO_INCREMENT,
  `text` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `heritage` tinyint NOT NULL,
  `relax` tinyint NOT NULL,
  `sightseeing` tinyint NOT NULL,
  `weather` tinyint NOT NULL,
  `populated` tinyint NOT NULL,
  `id_qst` int NOT NULL,
  PRIMARY KEY (`id_ans`),
  KEY `FK_id_qst_answer_idx` (`id_qst`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id_ans`, `text`, `heritage`, `relax`, `sightseeing`, `weather`, `populated`, `id_qst`) VALUES
(3, 'classic', 6, 5, 4, 2, 1, 1),
(4, 'pop', 1, 2, 3, 5, 4, 1),
(5, 'rock', 3, 1, 4, 2, 6, 1),
(6, 'hip-hop', 2, 3, 1, 6, 3, 1),
(7, 'yellow', 2, 1, 3, 6, 4, 2),
(8, 'blue', 3, 4, 5, 1, 2, 2),
(9, 'green', 3, 6, 3, 2, 1, 2),
(10, 'grey', 6, 3, 3, 1, 2, 2),
(11, 'Yes', 3, 6, 3, 5, 2, 3),
(12, 'No', 4, 0, 2, 2, 5, 3),
(15, 'small spaces', 5, 3, 4, 2, 0, 4),
(16, 'darkness', 4, 3, 4, 6, 2, 4),
(17, 'the future', 2, 6, 3, 4, 3, 4),
(18, 'flying', 3, 1, 3, 4, 6, 4),
(19, 'friends', 2, 1, 0, 5, 6, 5),
(20, 'phone', 1, 0, 6, 3, 5, 5),
(21, 'career', 6, 1, 5, 2, 3, 5),
(22, 'family', 3, 6, 4, 2, 2, 5),
(25, 'a castle', 6, 3, 4, 2, 1, 6),
(26, 'a modern apartment', 1, 5, 2, 3, 6, 6),
(27, 'a tree house', 3, 4, 3, 6, 1, 2),
(28, 'a suburban house', 1, 4, 6, 5, 2, 6),
(29, 'The Beatles', 6, 3, 4, 2, 1, 7),
(30, 'Eminem', 1, 3, 2, 3, 6, 7),
(33, 'Adele', 1, 5, 4, 3, 2, 7),
(34, 'Shakira', 2, 1, 3, 6, 5, 7),
(35, 'Reading', 4, 6, 3, 1, 2, 8),
(36, 'Sports', 1, 2, 3, 5, 6, 8),
(37, 'Partying', 2, 0, 4, 6, 5, 8),
(38, 'Watching movies', 3, 4, 6, 1, 2, 8),
(39, 'Yes', 1, 2, 3, 5, 6, 9),
(40, 'No', 6, 5, 4, 2, 1, 9),
(43, 'Vincent van Gogh', 5, 3, 4, 1, 2, 10),
(44, 'Claude Monet', 2, 4, 3, 5, 1, 10),
(45, 'Pablo Picasso', 1, 2, 4, 3, 5, 10),
(46, 'Salvador Dali', 2, 3, 6, 4, 1, 10),
(47, 'Stay at home', 4, 6, 3, 2, 1, 11),
(48, 'Go out', 2, 2, 3, 5, 6, 11),
(53, 'dreamer', 3, 5, 2, 4, 1, 12),
(54, 'hard worker', 6, 1, 5, 2, 3, 12),
(55, 'helper', 1, 3, 2, 5, 6, 12),
(56, 'passionate', 3, 1, 5, 2, 4, 12),
(57, 'give it to charity', 2, 4, 1, 5, 3, 13),
(58, 'give it to family', 6, 3, 1, 2, 5, 13),
(59, 'spend it all ', 1, 2, 5, 4, 6, 13),
(60, 'save it all', 4, 5, 2, 3, 2, 13),
(61, 'Dinner ', 4, 5, 3, 1, 2, 14),
(62, 'Movies ', 3, 5, 3, 1, 4, 14),
(63, 'Party ', 1, 1, 1, 4, 6, 14),
(64, 'Hiking ', 4, 3, 6, 3, 1, 14),
(65, 'None', 1, 2, 5, 3, 6, 15),
(66, 'Just one', 4, 2, 6, 2, 3, 15),
(67, 'More than 1', 4, 6, 2, 3, 1, 15),
(68, 'Meditation', 2, 6, 4, 1, 3, 16),
(69, 'I dont', 3, 6, 4, 2, 1, 16),
(70, 'Talking to friends', 6, 2, 4, 1, 3, 16),
(71, 'Drinking', 2, 1, 4, 3, 6, 16),
(72, 'invisibility', 4, 5, 6, 1, 2, 17),
(73, 'flying', 2, 3, 6, 4, 1, 17),
(74, 'reading minds', 2, 3, 2, 4, 6, 17),
(75, 'telekinesis', 3, 6, 1, 1, 4, 17),
(76, 'coca-cola', 2, 1, 4, 3, 6, 18),
(77, 'coffee', 4, 5, 3, 2, 1, 18),
(78, 'beer', 5, 2, 1, 4, 3, 18),
(79, 'juice', 2, 1, 4, 5, 6, 18),
(82, 'Be smart but not pretty', 6, 3, 4, 2, 1, 19),
(83, 'Be pretty but not smart', 2, 1, 5, 4, 6, 19),
(84, 'Leo', 4, 5, 6, 2, 1, 20),
(85, 'Gemini', 1, 2, 3, 5, 3, 20),
(86, 'Scorpio', 2, 5, 1, 3, 6, 20),
(87, 'very short', 1, 4, 3, 5, 2, 21),
(88, 'average', 3, 5, 5, 2, 3, 21),
(89, 'long', 5, 2, 4, 2, 3, 21),
(90, 'extremely long', 4, 1, 2, 3, 6, 21);

-- --------------------------------------------------------

--
-- Table structure for table `awarded`
--

DROP TABLE IF EXISTS `awarded`;
CREATE TABLE IF NOT EXISTS `awarded` (
  `id_awd` int NOT NULL AUTO_INCREMENT,
  `id_usr` int NOT NULL,
  `id_bdg` int NOT NULL,
  PRIMARY KEY (`id_awd`),
  KEY `FK_id_usr_awarded_idx` (`id_usr`),
  KEY `FK_id_bdg_awarded_idx` (`id_bdg`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `awarded`
--

INSERT INTO `awarded` (`id_awd`, `id_usr`, `id_bdg`) VALUES
(23, 1, 11),
(24, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

DROP TABLE IF EXISTS `badge`;
CREATE TABLE IF NOT EXISTS `badge` (
  `id_bdg` int NOT NULL AUTO_INCREMENT,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_bdg`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`id_bdg`, `title`, `description`) VALUES
(1, 'Europe', 'Visit Europe'),
(2, 'Asia', 'Visit Asia'),
(3, 'Beginner', 'Get 10 tokens on your reviews'),
(4, 'Medium', 'Get 100 tokens on your reviews'),
(5, 'Superstar', 'Get 1000 tokens on your reviews'),
(6, 'Africa', 'Visit Africa'),
(7, 'North America', 'Visit North America'),
(8, 'A newborn travelee', 'Complete 1 travel'),
(9, 'Getting into the business', 'Complete 5 travels'),
(10, 'Travelling maniac', 'Complete 20 travels'),
(11, 'South America', 'Visit South America'),
(12, 'Australia', 'Visit Australia'),
(13, 'Freshman', 'Be a traveller for 30 days'),
(14, 'Buddy', 'Be a traveller for 6 months'),
(15, 'Veteran', 'Be a traveller for 1 year'),
(16, 'how\'s the earth down there', 'visit all of the southern hemisphere continents in half a year'),
(17, 'the ice king', 'visit antartica and return alive if possible'),
(18, 'happy chinese new year', 'spend the chinese new year on a trip to china'),
(19, 'the A student', 'visit 4 countries and 16 places whose name starts with A'),
(20, 'the deserter', 'visit 3 deserts (we prefer desserts though)'),
(21, 'rocky mountain lad', 'visit the great mountains'),
(22, 'mr camouflage', 'change your avatar 3 times'),
(23, 'the great game', 'visit 10 countries in a year'),
(24, 'the ultimate master', 'visit all countries of the world');

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
  `id_cnt` int NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL COMMENT 'Two-letter country code (ISO 3166-1 alpha-2)',
  `name` varchar(64) NOT NULL COMMENT 'English country name',
  `id_con` tinyint NOT NULL,
  PRIMARY KEY (`id_cnt`),
  UNIQUE KEY `idx_code` (`code`) USING BTREE,
  KEY `idx_continent_code` (`id_con`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id_cnt`, `code`, `name`, `id_con`) VALUES
(1, 'AD', 'Andorra', 1),
(2, 'AE', 'United Arab Emirates', 2),
(3, 'AF', 'Afghanistan', 2),
(4, 'AG', 'Antigua and Barbuda', 4),
(5, 'AI', 'Anguilla', 4),
(6, 'AL', 'Albania', 1),
(7, 'AM', 'Armenia', 2),
(8, 'AN', 'Netherlands Antilles', 4),
(9, 'AO', 'Angola', 3),
(10, 'AQ', 'Antarctica', 7),
(11, 'AR', 'Argentina', 5),
(12, 'AS', 'American Samoa', 6),
(13, 'AT', 'Austria', 1),
(14, 'AU', 'Australia', 6),
(15, 'AW', 'Aruba', 4),
(16, 'AX', 'Åland', 1),
(17, 'AZ', 'Azerbaijan', 2),
(18, 'BA', 'Bosnia and Herzegovina', 1),
(19, 'BB', 'Barbados', 4),
(20, 'BD', 'Bangladesh', 2),
(21, 'BE', 'Belgium', 1),
(22, 'BF', 'Burkina Faso', 3),
(23, 'BG', 'Bulgaria', 1),
(24, 'BH', 'Bahrain', 2),
(25, 'BI', 'Burundi', 3),
(26, 'BJ', 'Benin', 3),
(27, 'BL', 'Saint Barthélemy', 4),
(28, 'BM', 'Bermuda', 4),
(29, 'BN', 'Brunei Darussalam', 2),
(30, 'BO', 'Bolivia', 5),
(31, 'BR', 'Brazil', 5),
(32, 'BS', 'Bahamas', 4),
(33, 'BT', 'Bhutan', 2),
(34, 'BV', 'Bouvet Island', 7),
(35, 'BW', 'Botswana', 3),
(36, 'BY', 'Belarus', 1),
(37, 'BZ', 'Belize', 4),
(38, 'CA', 'Canada', 4),
(39, 'CC', 'Cocos (Keeling) Islands', 2),
(40, 'CD', 'Congo (Kinshasa)', 3),
(41, 'CF', 'Central African Republic', 3),
(42, 'CG', 'Congo (Brazzaville)', 3),
(43, 'CH', 'Switzerland', 1),
(44, 'CI', 'Côte d\'Ivoire', 3),
(45, 'CK', 'Cook Islands', 6),
(46, 'CL', 'Chile', 5),
(47, 'CM', 'Cameroon', 3),
(48, 'CN', 'China', 2),
(49, 'CO', 'Colombia', 5),
(50, 'CR', 'Costa Rica', 4),
(51, 'CU', 'Cuba', 4),
(52, 'CV', 'Cape Verde', 3),
(53, 'CX', 'Christmas Island', 2),
(54, 'CY', 'Cyprus', 2),
(55, 'CZ', 'Czech Republic', 1),
(56, 'DE', 'Germany', 1),
(57, 'DJ', 'Djibouti', 3),
(58, 'DK', 'Denmark', 1),
(59, 'DM', 'Dominica', 4),
(60, 'DO', 'Dominican Republic', 4),
(61, 'DZ', 'Algeria', 3),
(62, 'EC', 'Ecuador', 5),
(63, 'EE', 'Estonia', 1),
(64, 'EG', 'Egypt', 3),
(65, 'EH', 'Western Sahara', 3),
(66, 'ER', 'Eritrea', 3),
(67, 'ES', 'Spain', 1),
(68, 'ET', 'Ethiopia', 3),
(69, 'FI', 'Finland', 1),
(70, 'FJ', 'Fiji', 6),
(71, 'FK', 'Falkland Islands', 5),
(72, 'FM', 'Micronesia', 6),
(73, 'FO', 'Faroe Islands', 1),
(74, 'FR', 'France', 1),
(75, 'GA', 'Gabon', 3),
(76, 'GB', 'United Kingdom', 1),
(77, 'GD', 'Grenada', 4),
(78, 'GE', 'Georgia', 2),
(79, 'GF', 'French Guiana', 5),
(80, 'GG', 'Guernsey', 1),
(81, 'GH', 'Ghana', 3),
(82, 'GI', 'Gibraltar', 1),
(83, 'GL', 'Greenland', 4),
(84, 'GM', 'Gambia', 3),
(85, 'GN', 'Guinea', 3),
(86, 'GP', 'Guadeloupe', 4),
(87, 'GQ', 'Equatorial Guinea', 3),
(88, 'GR', 'Greece', 1),
(89, 'GS', 'South Georgia and South Sandwich Islands', 7),
(90, 'GT', 'Guatemala', 4),
(91, 'GU', 'Guam', 6),
(92, 'GW', 'Guinea-Bissau', 3),
(93, 'GY', 'Guyana', 5),
(94, 'HK', 'Hong Kong', 2),
(95, 'HM', 'Heard and McDonald Islands', 7),
(96, 'HN', 'Honduras', 4),
(97, 'HR', 'Croatia', 1),
(98, 'HT', 'Haiti', 4),
(99, 'HU', 'Hungary', 1),
(100, 'ID', 'Indonesia', 2),
(101, 'IE', 'Ireland', 1),
(102, 'IL', 'Israel', 2),
(103, 'IM', 'Isle of Man', 1),
(104, 'IN', 'India', 2),
(105, 'IO', 'British Indian Ocean Territory', 2),
(106, 'IQ', 'Iraq', 2),
(107, 'IR', 'Iran', 2),
(108, 'IS', 'Iceland', 1),
(109, 'IT', 'Italy', 1),
(110, 'JE', 'Jersey', 1),
(111, 'JM', 'Jamaica', 4),
(112, 'JO', 'Jordan', 2),
(113, 'JP', 'Japan', 2),
(114, 'KE', 'Kenya', 3),
(115, 'KG', 'Kyrgyzstan', 2),
(116, 'KH', 'Cambodia', 2),
(117, 'KI', 'Kiribati', 6),
(118, 'KM', 'Comoros', 3),
(119, 'KN', 'Saint Kitts and Nevis', 4),
(120, 'KP', 'Korea, North', 2),
(121, 'KR', 'Korea, South', 2),
(122, 'KW', 'Kuwait', 2),
(123, 'KY', 'Cayman Islands', 4),
(124, 'KZ', 'Kazakhstan', 2),
(125, 'LA', 'Laos', 2),
(126, 'LB', 'Lebanon', 2),
(127, 'LC', 'Saint Lucia', 4),
(128, 'LI', 'Liechtenstein', 1),
(129, 'LK', 'Sri Lanka', 2),
(130, 'LR', 'Liberia', 3),
(131, 'LS', 'Lesotho', 3),
(132, 'LT', 'Lithuania', 1),
(133, 'LU', 'Luxembourg', 1),
(134, 'LV', 'Latvia', 1),
(135, 'LY', 'Libya', 3),
(136, 'MA', 'Morocco', 3),
(137, 'MC', 'Monaco', 1),
(138, 'MD', 'Moldova', 1),
(139, 'ME', 'Montenegro', 1),
(140, 'MF', 'Saint Martin (French part)', 4),
(141, 'MG', 'Madagascar', 3),
(142, 'MH', 'Marshall Islands', 6),
(143, 'MK', 'Macedonia', 1),
(144, 'ML', 'Mali', 3),
(145, 'MM', 'Myanmar', 2),
(146, 'MN', 'Mongolia', 2),
(147, 'MO', 'Macau', 2),
(148, 'MP', 'Northern Mariana Islands', 6),
(149, 'MQ', 'Martinique', 4),
(150, 'MR', 'Mauritania', 3),
(151, 'MS', 'Montserrat', 4),
(152, 'MT', 'Malta', 1),
(153, 'MU', 'Mauritius', 3),
(154, 'MV', 'Maldives', 2),
(155, 'MW', 'Malawi', 3),
(156, 'MX', 'Mexico', 4),
(157, 'MY', 'Malaysia', 2),
(158, 'MZ', 'Mozambique', 3),
(159, 'NA', 'Namibia', 3),
(160, 'NC', 'New Caledonia', 6),
(161, 'NE', 'Niger', 3),
(162, 'NF', 'Norfolk Island', 6),
(163, 'NG', 'Nigeria', 3),
(164, 'NI', 'Nicaragua', 4),
(165, 'NL', 'Netherlands', 1),
(166, 'NO', 'Norway', 1),
(167, 'NP', 'Nepal', 2),
(168, 'NR', 'Nauru', 6),
(169, 'NU', 'Niue', 6),
(170, 'NZ', 'New Zealand', 6),
(171, 'OM', 'Oman', 2),
(172, 'PA', 'Panama', 4),
(173, 'PE', 'Peru', 5),
(174, 'PF', 'French Polynesia', 6),
(175, 'PG', 'Papua New Guinea', 6),
(176, 'PH', 'Philippines', 2),
(177, 'PK', 'Pakistan', 2),
(178, 'PL', 'Poland', 1),
(179, 'PM', 'Saint Pierre and Miquelon', 4),
(180, 'PN', 'Pitcairn', 6),
(181, 'PR', 'Puerto Rico', 4),
(182, 'PS', 'Palestine', 2),
(183, 'PT', 'Portugal', 1),
(184, 'PW', 'Palau', 6),
(185, 'PY', 'Paraguay', 5),
(186, 'QA', 'Qatar', 2),
(187, 'RE', 'Reunion', 3),
(188, 'RO', 'Romania', 1),
(189, 'RS', 'Serbia', 1),
(190, 'RU', 'Russian Federation', 1),
(191, 'RW', 'Rwanda', 3),
(192, 'SA', 'Saudi Arabia', 2),
(193, 'SB', 'Solomon Islands', 6),
(194, 'SC', 'Seychelles', 3),
(195, 'SD', 'Sudan', 3),
(196, 'SE', 'Sweden', 1),
(197, 'SG', 'Singapore', 2),
(198, 'SH', 'Saint Helena', 3),
(199, 'SI', 'Slovenia', 1),
(200, 'SJ', 'Svalbard and Jan Mayen Islands', 1),
(201, 'SK', 'Slovakia', 1),
(202, 'SL', 'Sierra Leone', 3),
(203, 'SM', 'San Marino', 1),
(204, 'SN', 'Senegal', 3),
(205, 'SO', 'Somalia', 3),
(206, 'SR', 'Suriname', 5),
(207, 'ST', 'Sao Tome and Principe', 3),
(208, 'SV', 'El Salvador', 4),
(209, 'SY', 'Syria', 2),
(210, 'SZ', 'Swaziland', 3),
(211, 'TC', 'Turks and Caicos Islands', 4),
(212, 'TD', 'Chad', 3),
(213, 'TF', 'French Southern Lands', 7),
(214, 'TG', 'Togo', 3),
(215, 'TH', 'Thailand', 2),
(216, 'TJ', 'Tajikistan', 2),
(217, 'TK', 'Tokelau', 6),
(218, 'TL', 'Timor-Leste', 2),
(219, 'TM', 'Turkmenistan', 2),
(220, 'TN', 'Tunisia', 3),
(221, 'TO', 'Tonga', 6),
(222, 'TR', 'Turkey', 2),
(223, 'TT', 'Trinidad and Tobago', 4),
(224, 'TV', 'Tuvalu', 6),
(225, 'TW', 'Taiwan', 2),
(226, 'TZ', 'Tanzania', 3),
(227, 'UA', 'Ukraine', 1),
(228, 'UG', 'Uganda', 3),
(229, 'UM', 'United States Minor Outlying Islands', 6),
(230, 'US', 'United States of America', 4),
(231, 'UY', 'Uruguay', 5),
(232, 'UZ', 'Uzbekistan', 2),
(233, 'VA', 'Vatican City', 1),
(234, 'VC', 'Saint Vincent and the Grenadines', 4),
(235, 'VE', 'Venezuela', 5),
(236, 'VG', 'Virgin Islands, British', 4),
(237, 'VI', 'Virgin Islands, U.S.', 4),
(238, 'VN', 'Vietnam', 2),
(239, 'VU', 'Vanuatu', 6),
(240, 'WF', 'Wallis and Futuna Islands', 6),
(241, 'WS', 'Samoa', 6),
(242, 'YE', 'Yemen', 2),
(243, 'YT', 'Mayotte', 3),
(244, 'ZA', 'South Africa', 3),
(245, 'ZM', 'Zambia', 3),
(246, 'ZW', 'Zimbabwe', 3);

-- --------------------------------------------------------

--
-- Table structure for table `found_useful`
--

DROP TABLE IF EXISTS `found_useful`;
CREATE TABLE IF NOT EXISTS `found_useful` (
  `id_fnd` int NOT NULL AUTO_INCREMENT,
  `id_usr` int NOT NULL,
  `id_rev` int NOT NULL,
  PRIMARY KEY (`id_fnd`),
  KEY `FK_id_usr_found_useful_idx` (`id_usr`),
  KEY `FK_id_rev_found_useful_idx` (`id_rev`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_img` int NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_rev` int NOT NULL,
  PRIMARY KEY (`id_img`),
  KEY `FK_id_rev_image_idx` (`id_rev`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id_img`, `image_path`, `id_rev`) VALUES
(15, '/assets/db_files/1/review_img/15/review.15_0.jpg', 15),
(16, '/assets/db_files/1/review_img/15/review.15_1.jpg', 15),
(17, '/assets/db_files/1/review_img/15/review.15_2.jpg', 15),
(18, '/assets/db_files/1/review_img/15/review.15_3.jpg', 15),
(19, '/assets/db_files/1/review_img/15/review.15_4.jpg', 15),
(21, '/assets/db_files/1/review_img/19/review.19_0.jpg', 19),
(22, '/assets/db_files/1/review_img/20/review.20_0.jpg', 20),
(23, '/assets/db_files/1/review_img/20/review.20_1.jpg', 20),
(24, '/assets/db_files/1/review_img/20/review.20_2.jpg', 20),
(25, '/assets/db_files/1/review_img/21/review.21_0.jpg', 21),
(26, '/assets/db_files/1/review_img/22/review.22_0.jpg', 22),
(27, '/assets/db_files/1/review_img/22/review.22_1.jpg', 22),
(28, '/assets/db_files/1/review_img/23/review.23_0.jpg', 23),
(29, '/assets/db_files/1/review_img/23/review.23_1.jpg', 23),
(30, '/assets/db_files/1/review_img/24/review.24_0.jpg', 24),
(31, '/assets/db_files/1/review_img/24/review.24_1.jpg', 24),
(32, '/assets/db_files/1/review_img/24/review.24_2.jpg', 24),
(33, '/assets/db_files/1/review_img/24/review.24_3.jpg', 24),
(34, '/assets/db_files/1/review_img/25/review.25_0.jpg', 25),
(35, '/assets/db_files/1/review_img/26/review.26_0.jpg', 26),
(36, '/assets/db_files/1/review_img/26/review.26_1.jpg', 26),
(37, '/assets/db_files/2/review_img/29/review.29_0.jpg', 29),
(38, '/assets/db_files/2/review_img/30/review.30_0.jpg', 30),
(39, '/assets/db_files/2/review_img/31/review.31_0.jpg', 31);

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
  `id_plc` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `categorized` tinyint DEFAULT '0',
  `heritage` tinyint DEFAULT '0',
  `relax` tinyint DEFAULT '0',
  `sightseeing` tinyint DEFAULT '0',
  `weather` tinyint DEFAULT '0',
  `populated` tinyint DEFAULT '0',
  `taken_survey` int DEFAULT '0',
  `id_cnt` int NOT NULL,
  PRIMARY KEY (`id_plc`),
  KEY `FK_id_cnt_place_idx` (`id_cnt`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`id_plc`, `name`, `categorized`, `heritage`, `relax`, `sightseeing`, `weather`, `populated`, `taken_survey`, `id_cnt`) VALUES
(1, 'Paris', 0, 0, 0, 0, 0, 0, 0, 74),
(2, 'Shanghai', 0, 0, 0, 0, 0, 0, 0, 48),
(3, 'Rome', 0, 30, 12, 15, 27, 26, 3, 109),
(4, 'Saint Petersburg', 0, 0, 0, 0, 0, 0, 0, 190),
(5, 'Moscow', 0, 0, 0, 0, 0, 0, 0, 190),
(6, 'Canberra', 0, 0, 0, 0, 0, 0, 0, 14),
(7, 'Bogota', 0, 0, 0, 0, 0, 0, 0, 49),
(8, 'Munich', 0, 0, 0, 0, 0, 0, 0, 56),
(9, 'Los Angeles', 0, 0, 0, 0, 0, 0, 0, 230),
(10, 'Bajina Basta', 0, 0, 0, 0, 0, 0, 0, 189),
(12, 'Florence', 0, 30, 15, 15, 30, 27, 1, 109),
(13, 'Venice', 0, 29, 15, 20, 30, 24, 2, 109),
(14, 'Milan', 0, 27, 3, 15, 21, 27, 2, 109),
(15, 'Chaco', 0, 6, 18, 30, 27, 24, 1, 11),
(16, 'Tivoli', 0, 0, 0, 0, 0, 0, 0, 109),
(17, 'Crema', 0, 0, 0, 0, 0, 0, 0, 109);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_qst` int NOT NULL AUTO_INCREMENT,
  `text` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type_quiz` tinyint NOT NULL,
  `type_review` tinyint NOT NULL,
  `form` tinyint NOT NULL,
  PRIMARY KEY (`id_qst`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id_qst`, `text`, `type_quiz`, `type_review`, `form`) VALUES
(1, 'Which one of these music genres do u like the most?', 1, 0, 1),
(2, 'Which color describes you the best?', 1, 0, 1),
(3, 'Are u a workaholic?', 1, 0, 2),
(4, 'Pick the thing you fear the most', 1, 0, 1),
(5, 'Pick one thing you cant live without', 1, 0, 1),
(6, 'Pick your dream house', 1, 0, 1),
(7, 'What would you sing at karaoke night?', 1, 0, 1),
(8, 'Pick your favorite activity', 1, 0, 1),
(9, 'Do you like surprises?', 1, 0, 2),
(10, 'Favorite famous painter?', 1, 0, 1),
(11, 'After a hard working day would you rather?', 1, 0, 1),
(12, 'Word that describes you?', 1, 0, 1),
(13, 'What would you do if you won the lottery?', 1, 0, 1),
(14, 'Pick an ideal first date?', 1, 0, 1),
(15, 'How many pillows do you sleep with?', 1, 0, 1),
(16, 'How do you reduce stress?', 1, 0, 1),
(17, 'What superpowers would you like to have?', 1, 0, 1),
(18, 'Pick a favorite drink', 1, 0, 1),
(19, 'Would you rather?', 1, 0, 2),
(20, 'Which one of these zodiac signs do u dislike the most?', 1, 0, 1),
(21, 'How long does it take you to get ready?', 1, 0, 1),
(22, 'How are you feeling right now?', 1, 0, 1),
(23, 'Favorite subject in school?', 1, 0, 1),
(24, 'Who is your hero?', 1, 0, 1),
(25, 'What animal would you like to be?', 1, 0, 1),
(26, 'What motivates you to work hard?', 1, 0, 1),
(27, 'What era would you like to live in?', 1, 0, 1),
(28, 'Would you right now rather?', 1, 0, 1),
(29, 'How many kids would you like to have?', 1, 0, 1),
(30, 'Do you believe in life on other planets?', 1, 0, 2),
(31, 'Would a history buff enjoy this destination?', 0, 1, 3),
(32, 'Does this place give off chill vibes?', 0, 1, 4),
(33, 'Did you stumble upon many breathtakig views?', 0, 1, 5),
(34, 'Is this one of those endless summer places?', 0, 1, 6),
(35, 'Is this always buzzing with people?', 0, 1, 7);

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
  `token_count` int DEFAULT '0',
  `avatar_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '/assets/images/default-avatar-2.jpg',
  `acc_creation_date` date NOT NULL,
  `id_plc` int NOT NULL,
  PRIMARY KEY (`id_usr`),
  KEY `FK_id_plc_registered_user_idx` (`id_plc`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registered_user`
--

INSERT INTO `registered_user` (`id_usr`, `username`, `password`, `name`, `surname`, `e-mail`, `security_answer_1`, `security_answer_2`, `security_answer_3`, `token_count`, `avatar_path`, `acc_creation_date`, `id_plc`) VALUES
(1, 'adriance', 'Adriana79', 'Adriana', 'Vidic', 'vidic79adriana@gmail.com', 'Italy', 'Headphones', 'Elena', 0, '/assets/images/default-avatar-2.jpg', '2021-06-01', 3),
(2, 'jockobocko', 'jole123', 'Jovan', 'Djordjevic', 'jole@gmail.com', 'da', 'ne', 'mozda', 0, '/assets/images/default-avatar-2.jpg', '2021-06-01', 10),
(7, 'jacikot', 'jacikot123', 'Jana', 'Toljaga', 'jana.toljaga725@yahoo.com', 'Srbija', 'cebe', 'Marina', 0, '/assets/images/default-avatar-2.jpg', '2021-06-07', 14);

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
  `token_count` int DEFAULT '0',
  `date_posted` date NOT NULL,
  `id_vis` int NOT NULL,
  PRIMARY KEY (`id_rev`),
  KEY `FK_id_vis_review_idx` (`id_vis`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_rev`, `title`, `text`, `privacy`, `token_count`, `date_posted`, `id_vis`) VALUES
(15, 'like in a Fellini movie', 'Rome is a little bit different. There is something in Rome, incredible, like in a Fellini movie. Everybody’s screaming and laughing very loud', 0, 0, '2021-06-04', 19),
(19, 'a sight to stir the coldest nature', 'This is the fairest picture on our planet, the most enchanting to look upon, the most satisfying to the eye and the spirit. To see the sun sink down, drowned on his pink and purple and golden floods, and overwhelm Florence with tides of color that make all the sharp lines dim and faint and turn the solid city to a city of dreams, is a sight to stir the coldest nature, and make a sympathetic one drunk with ecstasy.', 0, 0, '2021-06-18', 23),
(20, 'one of the most elegant and grandest of cities', 'To build a city where it is impossible to build a city is madness in itself, but to build there one of the most elegant and grandest of cities is the madness of genius.', 0, 0, '2021-06-09', 24),
(21, 'cathedral of Milan', 'I went daily to the cathedral of Milan, that singular mountain which was torn out of the rocks of Carrara. I saw the church for the first time in the clear moonlight; dazzlingly white stood the upper part of it in the infinitely blue ether. Round about, wherever I looked, from every corner, upon every little tower with which the building was, as it were, overlaid, projected marble figures. Its interior dazzled me more than St. Peter’s Church; the strange gloom, the light which streamed through the painted windows – the wonderful mystical world which revealed itself here – yes, it was a church of God!', 0, 0, '2021-06-11', 25),
(22, 'a true metropolis:', 'Milan is a true metropolis: strong and fearless but welcoming, too. Little by little, I came to realize that I could become someone here.', 0, 0, '2021-06-11', 26),
(23, 'Rome to me', 'If I’m in Rome for only 48 hours, I would consider it a sin against God to not eat cacio e pepe, the most uniquely Roman of pastas, in some crummy little joint where Romans eat. I’d much rather do that than go to the Vatican. That’s Rome to me.', 0, 0, '2021-06-10', 27),
(24, 'City of the soul', 'I thought I knew everything when I came to Rome, but I soon found I had everything to learn. ', 0, 0, '2021-06-17', 28),
(25, 'St. Mary of the Flowers.', 'And when I thought of Florence, it was like a miracle city embalmed and like a corolla, because it was called the city of lilies and its cathedral, St. Mary of the Flowers.', 0, 0, '2021-06-04', 29),
(26, 'Impossible to stay a realist', 'A realist, in Venice, would become a romantic by mere faithfulness to what he saw before him.', 0, 0, '2021-06-04', 30),
(27, 'Saint Petersburg - Northern beauty!', 'St. Petersburg is a Russian port city on the Baltic Sea. It was the imperial capital for 2 centuries, having been founded in 1703 by Peter the Great, subject of the city\'s iconic “Bronze Horseman” statue. It remains Russia\'s cultural center, with venues such as the Mariinsky Theatre hosting opera and ballet, and the State Russian Museum showcasing Russian art, from Orthodox icon paintings to Kandinsky works. ', 0, 0, '2021-06-07', 31),
(28, 'Best vacation ever', 'Argetina is beautiful ', 0, 0, '2021-06-17', 32),
(29, 'Paris is a moveable feast', 'If you are lucky enough to have lived in Paris as a young man, then wherever you go for the rest of your life it stays with you, for Paris is a moveable feast.', 0, 0, '2021-06-10', 33),
(30, 'just Paris', 'That Paris exists and anyone could choose to live anywhere else in the world will always be a mystery to me.', 0, 0, '2021-06-10', 34),
(31, 'Paris is a world', 'Paris is not a city; it’s a world.', 0, 0, '2021-06-02', 35);

-- --------------------------------------------------------

--
-- Table structure for table `to-go`
--

DROP TABLE IF EXISTS `to-go`;
CREATE TABLE IF NOT EXISTS `to-go` (
  `id_tgl` int NOT NULL AUTO_INCREMENT,
  `id_usr` int NOT NULL,
  `id_plc` int NOT NULL,
  `crossed_off` tinyint DEFAULT '0',
  PRIMARY KEY (`id_tgl`),
  KEY `FK_id_plc_to-go_idx` (`id_plc`),
  KEY `FK_id_usr_to-go_idx` (`id_usr`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `to-go`
--

INSERT INTO `to-go` (`id_tgl`, `id_usr`, `id_plc`, `crossed_off`) VALUES
(1, 1, 7, 0),
(2, 7, 9, 0),
(21, 2, 12, 1),
(23, 2, 16, 1),
(24, 2, 3, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visited`
--

INSERT INTO `visited` (`id_vis`, `id_usr`, `id_plc`) VALUES
(19, 1, 3),
(20, 1, 12),
(21, 1, 12),
(22, 1, 12),
(23, 1, 12),
(24, 1, 13),
(25, 1, 14),
(26, 1, 14),
(27, 1, 3),
(28, 1, 3),
(29, 1, 12),
(30, 1, 13),
(31, 7, 4),
(32, 1, 15),
(33, 2, 1),
(34, 2, 1),
(35, 2, 1);

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
  ADD CONSTRAINT `FK_id_usr_awarded` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `FK_id_con_country2` FOREIGN KEY (`id_con`) REFERENCES `continent` (`id_con`) ON UPDATE CASCADE;

--
-- Constraints for table `found_useful`
--
ALTER TABLE `found_useful`
  ADD CONSTRAINT `FK_id_rev_found_useful` FOREIGN KEY (`id_rev`) REFERENCES `review` (`id_rev`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_usr_found_useful` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_id_rev_image` FOREIGN KEY (`id_rev`) REFERENCES `review` (`id_rev`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `FK_id_cnt_place` FOREIGN KEY (`id_cnt`) REFERENCES `country` (`id_cnt`) ON UPDATE CASCADE;

--
-- Constraints for table `registered_user`
--
ALTER TABLE `registered_user`
  ADD CONSTRAINT `FK_id_plc_registered_user` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_id_vis_review` FOREIGN KEY (`id_vis`) REFERENCES `visited` (`id_vis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `to-go`
--
ALTER TABLE `to-go`
  ADD CONSTRAINT `FK_id_plc_to-go` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_usr_to-go` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visited`
--
ALTER TABLE `visited`
  ADD CONSTRAINT `FK_id_plc_visited` FOREIGN KEY (`id_plc`) REFERENCES `place` (`id_plc`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_usr_visited` FOREIGN KEY (`id_usr`) REFERENCES `registered_user` (`id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
