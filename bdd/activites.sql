-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 15 oct. 2024 à 08:30
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
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` text,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `nom`, `description`, `prix`) VALUES
(1, 'Visite de la Tour Eiffel', 'Visite guidée de la Tour Eiffel', 30.00),
(2, 'Concert Classique', 'Concert de musique classique à l\'Opéra Garnier', 50.00),
(3, 'Excursion Montmartre', 'Découverte du quartier historique de Montmartre', 25.00);

-- --------------------------------------------------------

--
-- Structure de la table `congressiste`
--

DROP TABLE IF EXISTS `congressiste`;
CREATE TABLE IF NOT EXISTS `congressiste` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateInscription` date NOT NULL,
  `preferenceHotel` varchar(50) NOT NULL,
  `petitDej` tinyint(1) NOT NULL,
  `id_1` int NOT NULL,
  `id_2` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_1` (`id_1`),
  KEY `id_2` (`id_2`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `congressiste`
--

INSERT INTO `congressiste` (`id`, `nom`, `prenom`, `adresse`, `email`, `dateInscription`, `preferenceHotel`, `petitDej`, `id_1`, `id_2`) VALUES
(1, 'Dupont', 'Jean', '10 rue des Fleurs', 'jean.dupont@example.com', '2024-09-10', 'Hotel Paris', 1, 1, 1),
(2, 'Durand', 'Marie', '20 rue des Champs', 'marie.durand@example.com', '2024-09-15', 'Hotel Lyon', 1, 2, 2),
(3, 'Martin', 'Luc', '30 avenue de la République', 'luc.martin@example.com', '2024-09-20', 'Hotel Marseille', 0, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `congressistes`
--

DROP TABLE IF EXISTS `congressistes`;
CREATE TABLE IF NOT EXISTS `congressistes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `acompte` decimal(10,2) DEFAULT '100.00',
  `organisme_payeur` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `congressistes`
--

INSERT INTO `congressistes` (`id`, `nom`, `prenom`, `adresse`, `email`, `acompte`, `organisme_payeur`) VALUES
(1, 'Dupont', 'Jean', '123 Rue de Paris, 75001 Paris', 'jean.dupont@example.com', 100.00, 'Université de Paris'),
(2, 'Martin', 'Elodie', '45 Boulevard Saint-Germain, 75005 Paris', 'elodie.martin@example.com', 100.00, 'Lycée Saint-Louis'),
(3, 'Durand', 'Pierre', '67 Avenue Victor Hugo, 75008 Paris', 'pierre.durand@example.com', 100.00, 'Entreprise XYZ');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_congressiste` int DEFAULT NULL,
  `montant_total` decimal(10,2) NOT NULL,
  `est_reglee` tinyint(1) DEFAULT '0',
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_congressiste` (`id_congressiste`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `id_congressiste`, `montant_total`, `est_reglee`, `date_creation`) VALUES
(1, 1, 180.00, 0, '2024-10-08 09:47:33'),
(2, 2, 250.00, 1, '2024-10-08 09:47:33'),
(3, 3, 150.00, 0, '2024-10-08 09:47:33');

-- --------------------------------------------------------

--
-- Structure de la table `hebergements`
--

DROP TABLE IF EXISTS `hebergements`;
CREATE TABLE IF NOT EXISTS `hebergements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_congressiste` int DEFAULT NULL,
  `id_hotel` int DEFAULT NULL,
  `petit_dejeuner` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_congressiste` (`id_congressiste`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hebergements`
--

INSERT INTO `hebergements` (`id`, `id_congressiste`, `id_hotel`, `petit_dejeuner`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 0),
(3, 3, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `prixNuit` int NOT NULL,
  `prixDej` int NOT NULL,
  `nbEtoile` varchar(50) NOT NULL,
  `nbChambre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`id`, `nom`, `adresse`, `prixNuit`, `prixDej`, `nbEtoile`, `nbChambre`) VALUES
(1, 'Hotel Paris', '1 rue de Paris', 100, 15, '5', '100'),
(2, 'Hotel Lyon', '2 rue de Lyon', 80, 12, '4', '80'),
(3, 'Hotel Marseille', '3 rue de Marseille', 70, 10, '3', '50');

-- --------------------------------------------------------

--
-- Structure de la table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
CREATE TABLE IF NOT EXISTS `hotels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `prix_par_nuit` decimal(10,2) NOT NULL,
  `petit_dejeuner` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hotels`
--

INSERT INTO `hotels` (`id`, `nom`, `adresse`, `prix_par_nuit`, `petit_dejeuner`) VALUES
(1, 'Hôtel Paris Centre', '10 Rue Lafayette, 75009 Paris', 150.00, 1),
(2, 'Hôtel Etoile', '20 Avenue des Champs-Élysées, 75008 Paris', 200.00, 0),
(3, 'Hôtel Montmartre', '5 Rue Lepic, 75018 Paris', 120.00, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions_activites`
--

DROP TABLE IF EXISTS `inscriptions_activites`;
CREATE TABLE IF NOT EXISTS `inscriptions_activites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_congressiste` int DEFAULT NULL,
  `id_activite` int DEFAULT NULL,
  `facture_creee` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_congressiste` (`id_congressiste`),
  KEY `id_activite` (`id_activite`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscriptions_activites`
--

INSERT INTO `inscriptions_activites` (`id`, `id_congressiste`, `id_activite`, `facture_creee`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 1),
(3, 3, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions_sessions`
--

DROP TABLE IF EXISTS `inscriptions_sessions`;
CREATE TABLE IF NOT EXISTS `inscriptions_sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_congressiste` int DEFAULT NULL,
  `id_session` int DEFAULT NULL,
  `facture_creee` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_congressiste` (`id_congressiste`),
  KEY `id_session` (`id_session`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscriptions_sessions`
--

INSERT INTO `inscriptions_sessions` (`id`, `id_congressiste`, `id_session`, `facture_creee`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 1),
(3, 3, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `organisateur`
--

DROP TABLE IF EXISTS `organisateur`;
CREATE TABLE IF NOT EXISTS `organisateur` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `organisateur`
--

INSERT INTO `organisateur` (`id`, `nom`) VALUES
(1, 'Organisateur A'),
(2, 'Organisateur B'),
(3, 'Organisateur C');

-- --------------------------------------------------------

--
-- Structure de la table `reglements`
--

DROP TABLE IF EXISTS `reglements`;
CREATE TABLE IF NOT EXISTS `reglements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_facture` int DEFAULT NULL,
  `montant_regle` decimal(10,2) NOT NULL,
  `date_reglement` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_facture` (`id_facture`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reglements`
--

INSERT INTO `reglements` (`id`, `id_facture`, `montant_regle`, `date_reglement`) VALUES
(1, 1, 100.00, '2024-10-08 09:47:33'),
(2, 2, 250.00, '2024-10-08 09:47:33'),
(3, 3, 150.00, '2024-10-08 09:47:33');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `titre`, `description`, `prix`) VALUES
(1, 'Tennis et Stratégie', 'Session dédiée aux stratégies dans le tennis', 50.00),
(2, 'Équipement du Bowling', 'Discussion autour des équipements modernes de bowling', 40.00),
(3, 'Football Féminin', 'Conférence sur le développement du football féminin', 60.00);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`id_congressiste`) REFERENCES `congressistes` (`id`);

--
-- Contraintes pour la table `hebergements`
--
ALTER TABLE `hebergements`
  ADD CONSTRAINT `hebergements_ibfk_1` FOREIGN KEY (`id_congressiste`) REFERENCES `congressistes` (`id`),
  ADD CONSTRAINT `hebergements_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id`);

--
-- Contraintes pour la table `inscriptions_activites`
--
ALTER TABLE `inscriptions_activites`
  ADD CONSTRAINT `inscriptions_activites_ibfk_1` FOREIGN KEY (`id_congressiste`) REFERENCES `congressistes` (`id`),
  ADD CONSTRAINT `inscriptions_activites_ibfk_2` FOREIGN KEY (`id_activite`) REFERENCES `activites` (`id`);

--
-- Contraintes pour la table `inscriptions_sessions`
--
ALTER TABLE `inscriptions_sessions`
  ADD CONSTRAINT `inscriptions_sessions_ibfk_1` FOREIGN KEY (`id_congressiste`) REFERENCES `congressistes` (`id`),
  ADD CONSTRAINT `inscriptions_sessions_ibfk_2` FOREIGN KEY (`id_session`) REFERENCES `sessions` (`id`);

--
-- Contraintes pour la table `reglements`
--
ALTER TABLE `reglements`
  ADD CONSTRAINT `reglements_ibfk_1` FOREIGN KEY (`id_facture`) REFERENCES `factures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
