-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 10 déc. 2024 à 07:33
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `activites`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prix` decimal(15,2) DEFAULT NULL,
  `date_activite` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id`, `nom`, `prix`, `date_activite`, `heure`) VALUES
(1, 'dance ', 6.50, '2024-11-07', '14:11:09'),
(2, 'YOYO', 4.00, '2024-12-05', '14:00:00'),
(3, 'YOYOs', 4.00, '2024-12-05', '14:00:00'),
(5, 'YOYOsss', 4.00, '2024-12-05', '14:00:00'),
(6, 'YOYOsssttt', 5.00, '2024-12-05', '14:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `congressiste`
--

DROP TABLE IF EXISTS `congressiste`;
CREATE TABLE IF NOT EXISTS `congressiste` (
  `id` int NOT NULL,
  `petit_dej` tinyint(1) DEFAULT NULL,
  `nom_congressiste` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `codepostal` int DEFAULT NULL,
  `date_inscription` date DEFAULT NULL,
  `preference_hotel` varchar(50) DEFAULT NULL,
  `id_organisme` int DEFAULT NULL,
  `id_hotel` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_organisme` (`id_organisme`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int NOT NULL,
  `date_facture` date DEFAULT NULL,
  `code_reglement` int DEFAULT NULL,
  `id_congressiste` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_congressiste` (`id_congressiste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int NOT NULL,
  `prix_nuit` decimal(15,2) DEFAULT NULL,
  `prix_petitdej` decimal(15,2) DEFAULT NULL,
  `nb_etoile` int DEFAULT NULL,
  `nb_chambre` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `organisme_payeurs`
--

DROP TABLE IF EXISTS `organisme_payeurs`;
CREATE TABLE IF NOT EXISTS `organisme_payeurs` (
  `id` int NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participer_activite`
--

DROP TABLE IF EXISTS `participer_activite`;
CREATE TABLE IF NOT EXISTS `participer_activite` (
  `id_congressiste` int NOT NULL,
  `id_activite` int NOT NULL,
  PRIMARY KEY (`id_congressiste`,`id_activite`),
  KEY `id_activite` (`id_activite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participer_session`
--

DROP TABLE IF EXISTS `participer_session`;
CREATE TABLE IF NOT EXISTS `participer_session` (
  `id_congressiste` int NOT NULL,
  `nomId` varchar(50) NOT NULL,
  PRIMARY KEY (`id_congressiste`,`nomId`),
  KEY `nomId` (`nomId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `nomId` varchar(50) NOT NULL,
  `date_session` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `prix` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`nomId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `congressiste`
--
ALTER TABLE `congressiste`
  ADD CONSTRAINT `congressiste_ibfk_1` FOREIGN KEY (`id_organisme`) REFERENCES `organisme_payeurs` (`id`),
  ADD CONSTRAINT `congressiste_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`id_congressiste`) REFERENCES `congressiste` (`id`);

--
-- Contraintes pour la table `participer_activite`
--
ALTER TABLE `participer_activite`
  ADD CONSTRAINT `participer_activite_ibfk_1` FOREIGN KEY (`id_congressiste`) REFERENCES `congressiste` (`id`),
  ADD CONSTRAINT `participer_activite_ibfk_2` FOREIGN KEY (`id_activite`) REFERENCES `activite` (`id`);

--
-- Contraintes pour la table `participer_session`
--
ALTER TABLE `participer_session`
  ADD CONSTRAINT `participer_session_ibfk_1` FOREIGN KEY (`id_congressiste`) REFERENCES `congressiste` (`id`),
  ADD CONSTRAINT `participer_session_ibfk_2` FOREIGN KEY (`nomId`) REFERENCES `session` (`nomId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
