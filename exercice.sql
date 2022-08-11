-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 août 2022 à 09:18
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `exercice`
--

-- --------------------------------------------------------

--
-- Structure de la table `attestation`
--

DROP TABLE IF EXISTS `attestation`;
CREATE TABLE IF NOT EXISTS `attestation` (
  `IdAttestation` int NOT NULL AUTO_INCREMENT,
  `etudiant` int NOT NULL,
  `convention` int NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`IdAttestation`),
  KEY `idConvention` (`convention`),
  KEY `idEtudiant` (`etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `convention`
--

DROP TABLE IF EXISTS `convention`;
CREATE TABLE IF NOT EXISTS `convention` (
  `IdConvention` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nbHeur` int NOT NULL,
  PRIMARY KEY (`IdConvention`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `convention`
--

INSERT INTO `convention` (`IdConvention`, `nom`, `nbHeur`) VALUES
(1, 'Martin', 20),
(2, 'Bernard', 15),
(3, 'Martin', 22),
(4, 'Lopez', 20),
(5, 'Louis', 10),
(6, 'Dubois', 18);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `IdEtudiant` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `convention` int NOT NULL,
  PRIMARY KEY (`IdEtudiant`),
  KEY `idConvention` (`convention`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`IdEtudiant`, `nom`, `prenom`, `mail`, `convention`) VALUES
(1, 'Martin', 'Arnold', 'arnmart@yahoo.fr', 1),
(2, 'Louis ', 'Vitton', 'vitlou@gmail.com', 5),
(3, 'Dubois', 'Cloé', 'cdubois@gmail.com', 6),
(4, 'Bernard', 'Eloise', 'eloisebernard586@yahoo.fr', 2),
(5, 'Martin', 'Bienvenue', 'bienvenuemartin@gmail.com', 3),
(6, 'Lopez', 'Jenni', 'jennilo@yahoo.fr', 4),
(7, 'Lopez', 'Lucas', 'lopezlucas@gmail.com', 4),
(8, 'Bernard', 'Kevin', 'kevin_bernard@outlook.fr', 2),
(9, 'Dubois', 'Nani', 'nanidubois2@gmail.com', 6),
(10, 'Martin', 'Lutter', 'luttermart@gmail.com', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attestation`
--
ALTER TABLE `attestation`
  ADD CONSTRAINT `attestation_ibfk_1` FOREIGN KEY (`convention`) REFERENCES `convention` (`IdConvention`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `attestation_ibfk_2` FOREIGN KEY (`etudiant`) REFERENCES `etudiant` (`IdEtudiant`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`convention`) REFERENCES `convention` (`IdConvention`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
