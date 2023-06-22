-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 22, 2023 at 02:26 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nom_admin`, `prenom_admin`, `email_admin`, `mdp_admin`, `tele_admin`) VALUES
(1, 'KADDOURI', 'Jalal', 'jalalkadori2@gmail.com', '$2y$10$eOPLTT/NYSKN0M960zuFA.1Fy0wq2vew0IswvtR1usR2vtC.2Ft9q', '0601020304');

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
  `img_url` varchar(255) NOT NULL,
  `date_publication` date DEFAULT NULL,
  `ecrivain_nom` varchar(50) DEFAULT NULL,
  `id_admin` int NOT NULL,
  PRIMARY KEY (`id_Article`),
  KEY `id_admin` (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_Article`, `titre_article`, `corp_article`, `categorie_acticle`, `img_url`, `date_publication`, `ecrivain_nom`, `id_admin`) VALUES
(1, 'Comment peindre un mur ?', 'Comment peindre un mur intérieur ou bien un mur extérieur ? Suivez dans cet article les conseils et les détails des étapes à suivre pour bien peindre son mur.\r\n\r\ncomment peindre un mur ? \r\nLes bonnes techniques pour peindre un mur convenablement\r\nComment peindre un mur intérieur ou bien un mur extérieur ? Voilà la première question qui se pose quand vous songez à refaçonner votre propriété. Peindre les murs forme un travail de bricolage à la portée de tous qui nécessite la disposition d’un éventail d’astuces. \r\n\r\nA priori, la préparation au niveau logistique reste l’étape la plus indispensable. S’en suit l’adoption de quelques techniques de peinture. Suivez dans cet article les conseils et les détails des étapes à suivre pour bien peindre son mur.', 'Peinture', '../images/blog/articles/6486d682e7124_peinture.jpg', '2023-06-12', NULL, 1);

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
  `email` varchar(120) DEFAULT NULL,
  `mdp_bricoleur` varchar(255) DEFAULT NULL,
  `speciality` varchar(50) NOT NULL,
  `id_admin` int DEFAULT NULL,
  PRIMARY KEY (`id_bricoleur`),
  KEY `id_admin` (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bricoleur`
--

INSERT INTO `bricoleur` (`id_bricoleur`, `nom_bricoleur`, `prenom_bricoleur`, `tele_bricoleur`, `cin_bricoleur`, `adresse_bricoleur`, `ville_bricoleur`, `img_profile`, `email`, `mdp_bricoleur`, `speciality`, `id_admin`) VALUES
(2, 'KADDOURI', 'Jalal', '0601020304', 'CD000000', '1 rue de la marche verte', 'Tanger', '../images/bricoleur/profil/649215725d092.jpg', 'jalalkadori2@gmail.com', '$2y$10$18obm176wkRG.vGeYVYjouJqCDAQkiBgO0e8EejwvX.7tM3r4XH6W', 'Electricité', 1),
(6, 'Hassan', 'Ahmed', '0601949570', 'AB123456', 'Omar Ibn Al-Khattab Street', 'Casablanca', '../images/bricoleur/profil/649213170809e.jpg', 'ahmed.hassan@example.com', '$2y$10$2/byB17xUrbMJVrLBUkRgOccnHxmt83dItm1jyuQit198uWxpxyea', 'Electricité', 1),
(5, 'Al-Maliki', 'Abdulaziz', '0651234567', 'EF012345', 'Al-Huda Street, Tetouan', 'Rabat', '../images/bricoleur/profil/6492138854f32.jpg', 'abdulaziz.almaliki@example.com', '$2y$10$yAwlOHrU038Rj8aSVL3fW..yjxsHmU2o6IsCKjUTJD3/plx2RFfae', 'Electricité', 1),
(7, 'Al-Hamdi', 'Ziad', '0676543210', 'WX901234', 'Al-Karam Street', 'Fès', '../images/bricoleur/profil/6493b0cabbf3a.jpg', 'ziad.alhamdi@example.com', '$2y$10$QfoAikbXfwJKSQ/9jQcATOa67ROdAJJds9KhqsJ0UaWcK69oLTEH.', 'Electricité', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chercheur`
--

INSERT INTO `chercheur` (`id_chercheur`, `nom_chercheur`, `prenom_chercheur`, `tele_chercheur`, `adresse_chercheur`, `ville_chercheur`, `email_chercheur`, `mdp_chercheur`) VALUES
(1, 'Mabrouki', 'Ihsan', '0601949570', '1 rue de la mere atlantique', 'Tanger', 'ihsan.mabrouki@example.com', '$2y$10$C2rx4LlyMG3OKCw/syVb8ecOrZtc6zwKGo9Fj/kUqZaAvL7ZbEtXm');

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
  `img_realisation` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_realisation` date NOT NULL,
  `id_bricoleur` int NOT NULL,
  PRIMARY KEY (`id_realisation`),
  KEY `id_bricoleur` (`id_bricoleur`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `realisations`
--

INSERT INTO `realisations` (`id_realisation`, `titre_realisation`, `description_realisation`, `img_realisation`, `date_realisation`, `id_bricoleur`) VALUES
(4, 'Qu\'est-ce que le Lorem Ipsum?', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de tex', '../images/bricoleur/realisations/equipe-projet-en-discussion.jpg', '2023-06-07', 5),
(5, 'Pourquoi l\'utiliser?', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.', '../images/bricoleur/realisations/64909131e418c.jpg', '2023-06-07', 5),
(6, 'Où puis-je m\'en procurer?', 'Plusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d\'entre elles a été altérée par l\'addition d\'humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard. Si vous voulez utiliser un passag', '../images/bricoleur/realisations/649091cd1e6d8.png', '2023-06-07', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
