-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 22 sep. 2021 à 08:37
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbfestilab`
--

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `name_uppercase` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_simple` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_real` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` decimal(5,0) NOT NULL,
  `longitude_deg` decimal(10,5) NOT NULL,
  `latitude_deg` decimal(10,5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D95DB16BAE80F5DF` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36570 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`id`, `department_id`, `name_uppercase`, `name_simple`, `name_real`, `zip`, `longitude_deg`, `latitude_deg`) VALUES
(11024, 29, 'CROZON', 'crozon', 'Crozon', '29160', '-4.48333', '48.25000'),
(11151, 29, 'CARHAIX-PLOUGUER', 'carhaix plouguer', 'Carhaix-Plouguer', '29270', '-3.58333', '48.28330'),
(16656, 44, 'CORSEPT', 'corsept', 'Corsept', '44560', '-2.05000', '47.28330'),
(16726, 44, 'CLISSON', 'clisson', 'Clisson', '44190', '-1.28333', '47.08330'),
(16756, 44, 'NANTES', 'nantes', 'Nantes', '44000', '-1.55000', '47.21670'),
(16798, 44, 'NORT-SUR-ERDRE', 'nort sur erdre', 'Nort-sur-Erdre', '44390', '-1.50000', '47.43330'),
(16826, 44, 'SAINT-NAZAIRE', 'saint nazaire', 'Saint-Nazaire', '44600', '-2.20000', '47.28330'),
(21469, 56, 'MALESTROIT', 'malestroit', 'Malestroit', '56140', '-2.38333', '47.81670');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `FK_D95DB16BAE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
