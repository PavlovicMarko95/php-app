-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 06, 2026 at 01:21 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_korisnik` int NOT NULL,
  `vreme` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_vest` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `komentar_korisnik` (`id_korisnik`),
  KEY `komentar_vest` (`id_vest`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `id_korisnik`, `vreme`, `tekst`, `id_vest`) VALUES
(1, 1, '2025-10-04 13:20:22', 'Prvi komentar.', 1),
(16, 4, '2025-10-31 00:32:27', 'Novi komentar...', 1),
(17, 7, '2025-10-31 00:43:50', 'Novi komentar.', 2),
(18, 7, '2025-10-31 07:56:56', 'Jos jedan komentar.', 1),
(23, 4, '2026-01-30 23:16:23', 'Komentar...', 3);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kor_ime` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ime` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `lozinka` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kor_ime` (`kor_ime`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `kor_ime`, `ime`, `is_admin`, `lozinka`) VALUES
(1, 'marko', 'Marko', 1, 'marko'),
(3, 'dule', 'dule', 0, '123456'),
(4, 'janko', 'janko', 0, '123456'),
(5, 'pera', 'pera', 0, '123456'),
(7, 'maki', 'maki', 0, '123456');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pogledproizvodi`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `pogledproizvodi`;
CREATE TABLE IF NOT EXISTS `pogledproizvodi` (
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pogledvesti`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `pogledvesti`;
CREATE TABLE IF NOT EXISTS `pogledvesti` (
);

-- --------------------------------------------------------

--
-- Table structure for table `vest`
--

DROP TABLE IF EXISTS `vest`;
CREATE TABLE IF NOT EXISTS `vest` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_korisnik` int NOT NULL,
  `vreme` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `naslov` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vest_korisnik` (`id_korisnik`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vest`
--

INSERT INTO `vest` (`id`, `id_korisnik`, `vreme`, `tekst`, `naslov`) VALUES
(1, 1, '2025-10-04 13:12:04', 'tekst vesti', 'naslov vesti'),
(2, 1, '2025-10-04 14:32:11', 'Tekst druge vesti', 'Naslov druge vesti'),
(3, 7, '2025-11-01 08:16:49', 'Tekst trece vesti.', 'Treca vest'),
(7, 4, '2025-12-10 23:44:34', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'cetvrta');

-- --------------------------------------------------------

--
-- Structure for view `pogledproizvodi`
--
DROP TABLE IF EXISTS `pogledproizvodi`;

DROP VIEW IF EXISTS `pogledproizvodi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pogledproizvodi`  AS SELECT `proizvodi`.`id` AS `id`, `proizvodi`.`naslov` AS `naslov`, `proizvodi`.`tekst` AS `tekst`, `proizvodi`.`kategorija` AS `kategorija`, `proizvodi`.`vreme` AS `vreme`, `proizvodi`.`autor` AS `autor`, `proizvodi`.`vremeIzmene` AS `vremeIzmene`, `proizvodi`.`obrisan` AS `obrisan`, `proizvodi`.`cena` AS `cena`, `proizvodi`.`pogledan` AS `pogledan`, `kategorije`.`naziv` AS `naziv`, `korisnici`.`ime` AS `ime`, `korisnici`.`prezime` AS `prezime` FROM ((`proizvodi` join `kategorije` on((`proizvodi`.`kategorija` = `kategorije`.`id`))) join `korisnici` on((`proizvodi`.`autor` = `korisnici`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `pogledvesti`
--
DROP TABLE IF EXISTS `pogledvesti`;

DROP VIEW IF EXISTS `pogledvesti`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pogledvesti`  AS SELECT `id` AS `id`, `naslov` AS `naslov`, `tekst` AS `tekst`, `kategorija` AS `kategorija`, `vreme` AS `vreme`, `autor` AS `autor`, `vremeIzmene` AS `vremeIzmene`, `obrisan` AS `obrisan`, `kategorije`.`naziv` AS `naziv`, `korisnici`.`ime` AS `ime`, `korisnici`.`prezime` AS `prezime` FROM ((`vesti` join `korisnici` on((`autor` = `korisnici`.`id`))) join `kategorije` on((`kategorija` = `kategorije`.`id`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_korisnik` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `komentar_vest` FOREIGN KEY (`id_vest`) REFERENCES `vest` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `vest`
--
ALTER TABLE `vest`
  ADD CONSTRAINT `vest_korisnik` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
