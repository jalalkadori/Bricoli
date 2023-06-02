-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2023 at 11:59 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bricoconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nom_admin` varchar(50) DEFAULT NULL,
  `prenom_admin` varchar(50) DEFAULT NULL,
  `email_admin` varchar(120) DEFAULT NULL,
  `mdp_admin` varchar(255) DEFAULT NULL,
  `tele_admin` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_Article` int NOT NULL AUTO_INCREMENT,
  `titre_article` varchar(120) DEFAULT NULL,
  `corp_article` varchar(8000) DEFAULT NULL,
  `categorie_acticle` varchar(50) DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  `ecrivain_nom` varchar(50) DEFAULT NULL,
  `id_admin` int NOT NULL,
  PRIMARY KEY (`id_Article`),
  KEY `id_admin` (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bricoleur`
--

DROP TABLE IF EXISTS `bricoleur`;
CREATE TABLE IF NOT EXISTS `bricoleur` (
  `id_bricoleur` int NOT NULL AUTO_INCREMENT,
  `nom_bricoleur` varchar(50) DEFAULT NULL,
  `prenom_bricoleur` varchar(50) DEFAULT NULL,
  `tele_bricoleur` varchar(10) DEFAULT NULL,
  `cin_bricoleur` varchar(10) DEFAULT NULL,
  `adresse_bricoleur` varchar(50) DEFAULT NULL,
  `ville_bricoleur` varchar(50) DEFAULT NULL,
  `img_profile` varchar(50) DEFAULT NULL,
  `cin_img_bricoleur` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `mdp_bricoleur` varchar(255) DEFAULT NULL,
  `id_admin` int DEFAULT NULL,
  PRIMARY KEY (`id_bricoleur`),
  KEY `id_admin` (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chercheur`
--

DROP TABLE IF EXISTS `chercheur`;
CREATE TABLE IF NOT EXISTS `chercheur` (
  `id_chercheur` int NOT NULL AUTO_INCREMENT,
  `nom_chercheur` varchar(50) DEFAULT NULL,
  `prenom_chercheur` varchar(50) DEFAULT NULL,
  `tele_chercheur` varchar(10) DEFAULT NULL,
  `adresse_chercheur` varchar(255) DEFAULT NULL,
  `ville_chercheur` varchar(50) DEFAULT NULL,
  `email_chercheur` varchar(120) DEFAULT NULL,
  `mdp_chercheur` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_chercheur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `id_chercheur` int NOT NULL,
  `id_realisation` int NOT NULL,
  `commentaire_evaluation` varchar(50) DEFAULT NULL,
  `evaluation_note` int DEFAULT NULL,
  PRIMARY KEY (`id_chercheur`,`id_realisation`),
  KEY `id_realisation` (`id_realisation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `realisations`
--

DROP TABLE IF EXISTS `realisations`;
CREATE TABLE IF NOT EXISTS `realisations` (
  `id_realisation` int NOT NULL AUTO_INCREMENT,
  `titre_realisation` varchar(120) DEFAULT NULL,
  `description_realisation` varchar(255) DEFAULT NULL,
  `img_realisation` varchar(50) DEFAULT NULL,
  `id_bricoleur` int NOT NULL,
  PRIMARY KEY (`id_realisation`),
  KEY `id_bricoleur` (`id_bricoleur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
