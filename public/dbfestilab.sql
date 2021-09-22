-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 22 sep. 2021 à 09:18
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
-- Structure de la table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripton` longtext COLLATE utf8mb4_unicode_ci,
  `social_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `artists_festivals`
--

DROP TABLE IF EXISTS `artists_festivals`;
CREATE TABLE IF NOT EXISTS `artists_festivals` (
  `artists_id` int(11) NOT NULL,
  `festivals_id` int(11) NOT NULL,
  PRIMARY KEY (`artists_id`,`festivals_id`),
  KEY `IDX_AD0AEB0C54A05007` (`artists_id`),
  KEY `IDX_AD0AEB0C12F492DD` (`festivals_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(11024, 30, 'CROZON', 'crozon', 'Crozon', '29160', '-4.48333', '48.25000'),
(11151, 30, 'CARHAIX-PLOUGUER', 'carhaix plouguer', 'Carhaix-Plouguer', '29270', '-3.58333', '48.28330'),
(16656, 45, 'CORSEPT', 'corsept', 'Corsept', '44560', '-2.05000', '47.28330'),
(16726, 45, 'CLISSON', 'clisson', 'Clisson', '44190', '-1.28333', '47.08330'),
(16756, 45, 'NANTES', 'nantes', 'Nantes', '44000', '-1.55000', '47.21670'),
(16798, 45, 'NORT-SUR-ERDRE', 'nort sur erdre', 'Nort-sur-Erdre', '44390', '-1.50000', '47.43330'),
(16826, 45, 'SAINT-NAZAIRE', 'saint nazaire', 'Saint-Nazaire', '44600', '-2.20000', '47.28330'),
(21469, 57, 'MALESTROIT', 'malestroit', 'Malestroit', '56140', '-2.38333', '47.81670');

-- --------------------------------------------------------

--
-- Structure de la table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_uppercase` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departments`
--

INSERT INTO `departments` (`id`, `code`, `name`, `name_uppercase`) VALUES
(1, '01', 'Ain', 'AIN'),
(2, '02', 'Aisne', 'AISNE'),
(3, '03', 'Allier', 'ALLIER'),
(4, '04', 'Alpes-de-Haute-Provence', 'ALPES-DE-HAUTE-PROVENCE'),
(5, '05', 'Hautes-Alpes', 'HAUTES-ALPES'),
(6, '06', 'Alpes-Maritimes', 'ALPES-MARITIMES'),
(7, '07', 'Ardèche', 'ARDÈCHE'),
(8, '08', 'Ardennes', 'ARDENNES'),
(9, '09', 'Ariège', 'ARIÈGE'),
(10, '10', 'Aube', 'AUBE'),
(11, '11', 'Aude', 'AUDE'),
(12, '12', 'Aveyron', 'AVEYRON'),
(13, '13', 'Bouches-du-Rhône', 'BOUCHES-DU-RHÔNE'),
(14, '14', 'Calvados', 'CALVADOS'),
(15, '15', 'Cantal', 'CANTAL'),
(16, '16', 'Charente', 'CHARENTE'),
(17, '17', 'Charente-Maritime', 'CHARENTE-MARITIME'),
(18, '18', 'Cher', 'CHER'),
(19, '19', 'Corrèze', 'CORRÈZE'),
(20, '2a', 'Corse-du-sud', 'CORSE-DU-SUD'),
(21, '2b', 'Haute-corse', 'HAUTE-CORSE'),
(22, '21', 'Côte-d\'or', 'CÔTE-D\'OR'),
(23, '22', 'Côtes-d\'armor', 'CÔTES-D\'ARMOR'),
(24, '23', 'Creuse', 'CREUSE'),
(25, '24', 'Dordogne', 'DORDOGNE'),
(26, '25', 'Doubs', 'DOUBS'),
(27, '26', 'Drôme', 'DRÔME'),
(28, '27', 'Eure', 'EURE'),
(29, '28', 'Eure-et-Loir', 'EURE-ET-LOIR'),
(30, '29', 'Finistère', 'FINISTÈRE'),
(31, '30', 'Gard', 'GARD'),
(32, '31', 'Haute-Garonne', 'HAUTE-GARONNE'),
(33, '32', 'Gers', 'GERS'),
(34, '33', 'Gironde', 'GIRONDE'),
(35, '34', 'Hérault', 'HÉRAULT'),
(36, '35', 'Ile-et-Vilaine', 'ILE-ET-VILAINE'),
(37, '36', 'Indre', 'INDRE'),
(38, '37', 'Indre-et-Loire', 'INDRE-ET-LOIRE'),
(39, '38', 'Isère', 'ISÈRE'),
(40, '39', 'Jura', 'JURA'),
(41, '40', 'Landes', 'LANDES'),
(42, '41', 'Loir-et-Cher', 'LOIR-ET-CHER'),
(43, '42', 'Loire', 'LOIRE'),
(44, '43', 'Haute-Loire', 'HAUTE-LOIRE'),
(45, '44', 'Loire-Atlantique', 'LOIRE-ATLANTIQUE'),
(46, '45', 'Loiret', 'LOIRET'),
(47, '46', 'Lot', 'LOT'),
(48, '47', 'Lot-et-Garonne', 'LOT-ET-GARONNE'),
(49, '48', 'Lozère', 'LOZÈRE'),
(50, '49', 'Maine-et-Loire', 'MAINE-ET-LOIRE'),
(51, '50', 'Manche', 'MANCHE'),
(52, '51', 'Marne', 'MARNE'),
(53, '52', 'Haute-Marne', 'HAUTE-MARNE'),
(54, '53', 'Mayenne', 'MAYENNE'),
(55, '54', 'Meurthe-et-Moselle', 'MEURTHE-ET-MOSELLE'),
(56, '55', 'Meuse', 'MEUSE'),
(57, '56', 'Morbihan', 'MORBIHAN'),
(58, '57', 'Moselle', 'MOSELLE'),
(59, '58', 'Nièvre', 'NIÈVRE'),
(60, '59', 'Nord', 'NORD'),
(61, '60', 'Oise', 'OISE'),
(62, '61', 'Orne', 'ORNE'),
(63, '62', 'Pas-de-Calais', 'PAS-DE-CALAIS'),
(64, '63', 'Puy-de-Dôme', 'PUY-DE-DÔME'),
(65, '64', 'Pyrénées-Atlantiques', 'PYRÉNÉES-ATLANTIQUES'),
(66, '65', 'Hautes-Pyrénées', 'HAUTES-PYRÉNÉES'),
(67, '66', 'Pyrénées-Orientales', 'PYRÉNÉES-ORIENTALES'),
(68, '67', 'Bas-Rhin', 'BAS-RHIN'),
(69, '68', 'Haut-Rhin', 'HAUT-RHIN'),
(70, '69', 'Rhône', 'RHÔNE'),
(71, '70', 'Haute-Saône', 'HAUTE-SAÔNE'),
(72, '71', 'Saône-et-Loire', 'SAÔNE-ET-LOIRE'),
(73, '72', 'Sarthe', 'SARTHE'),
(74, '73', 'Savoie', 'SAVOIE'),
(75, '74', 'Haute-Savoie', 'HAUTE-SAVOIE'),
(76, '75', 'Paris', 'PARIS'),
(77, '76', 'Seine-Maritime', 'SEINE-MARITIME'),
(78, '77', 'Seine-et-Marne', 'SEINE-ET-MARNE'),
(79, '78', 'Yvelines', 'YVELINES'),
(80, '79', 'Deux-Sèvres', 'DEUX-SÈVRES'),
(81, '80', 'Somme', 'SOMME'),
(82, '81', 'Tarn', 'TARN'),
(83, '82', 'Tarn-et-Garonne', 'TARN-ET-GARONNE'),
(84, '83', 'Var', 'VAR'),
(85, '84', 'Vaucluse', 'VAUCLUSE'),
(86, '85', 'Vendée', 'VENDÉE'),
(87, '86', 'Vienne', 'VIENNE'),
(88, '87', 'Haute-Vienne', 'HAUTE-VIENNE'),
(89, '88', 'Vosges', 'VOSGES'),
(90, '89', 'Yonne', 'YONNE'),
(91, '90', 'Territoire de Belfort', 'TERRITOIRE DE BELFORT'),
(92, '91', 'Essonne', 'ESSONNE'),
(93, '92', 'Hauts-de-Seine', 'HAUTS-DE-SEINE'),
(94, '93', 'Seine-Saint-Denis', 'SEINE-SAINT-DENIS'),
(95, '94', 'Val-de-Marne', 'VAL-DE-MARNE'),
(96, '95', 'Val-d\'oise', 'VAL-D\'OISE'),
(97, '976', 'Mayotte', 'MAYOTTE'),
(98, '971', 'Guadeloupe', 'GUADELOUPE'),
(99, '973', 'Guyane', 'GUYANE'),
(100, '972', 'Martinique', 'MARTINIQUE'),
(101, '974', 'Réunion', 'RÉUNION');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210920162118', '2021-09-20 18:21:28', 154),
('DoctrineMigrations\\Version20210920163243', '2021-09-20 18:32:50', 84),
('DoctrineMigrations\\Version20210920164224', '2021-09-20 18:42:29', 160),
('DoctrineMigrations\\Version20210920165902', '2021-09-20 18:59:07', 95),
('DoctrineMigrations\\Version20210920171955', '2021-09-20 19:20:02', 98),
('DoctrineMigrations\\Version20210920172546', '2021-09-20 19:25:57', 52),
('DoctrineMigrations\\Version20210920173316', '2021-09-20 19:33:26', 77),
('DoctrineMigrations\\Version20210920175207', '2021-09-20 19:52:17', 82),
('DoctrineMigrations\\Version20210920180538', '2021-09-20 20:05:51', 164),
('DoctrineMigrations\\Version20210920181701', '2021-09-20 20:17:10', 155),
('DoctrineMigrations\\Version20210920182459', '2021-09-20 20:25:05', 59),
('DoctrineMigrations\\Version20210920184138', '2021-09-20 20:41:43', 293),
('DoctrineMigrations\\Version20210920184928', '2021-09-20 20:49:35', 205);

-- --------------------------------------------------------

--
-- Structure de la table `festivals`
--

DROP TABLE IF EXISTS `festivals`;
CREATE TABLE IF NOT EXISTS `festivals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_office_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tdg` tinyint(1) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `kind_id` int(11) NOT NULL,
  `public_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F6F887830602CA9` (`kind_id`),
  KEY `IDX_8F6F8878B5B48B91` (`public_id`),
  KEY `IDX_8F6F88786995AC4C` (`editor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `kinds`
--

DROP TABLE IF EXISTS `kinds`;
CREATE TABLE IF NOT EXISTS `kinds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `festival_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1DD399508AEBAF57` (`festival_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patners`
--

DROP TABLE IF EXISTS `patners`;
CREATE TABLE IF NOT EXISTS `patners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `festival_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F7C2FC08AEBAF57` (`festival_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citie_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FEAF6C55B40130FF` (`citie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `places_festivals`
--

DROP TABLE IF EXISTS `places_festivals`;
CREATE TABLE IF NOT EXISTS `places_festivals` (
  `places_id` int(11) NOT NULL,
  `festivals_id` int(11) NOT NULL,
  PRIMARY KEY (`places_id`,`festivals_id`),
  KEY `IDX_60B5A27D8317B347` (`places_id`),
  KEY `IDX_60B5A27D12F492DD` (`festivals_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `publics`
--

DROP TABLE IF EXISTS `publics`;
CREATE TABLE IF NOT EXISTS `publics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artists_festivals`
--
ALTER TABLE `artists_festivals`
  ADD CONSTRAINT `FK_AD0AEB0C12F492DD` FOREIGN KEY (`festivals_id`) REFERENCES `festivals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AD0AEB0C54A05007` FOREIGN KEY (`artists_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `FK_D95DB16BAE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Contraintes pour la table `festivals`
--
ALTER TABLE `festivals`
  ADD CONSTRAINT `FK_8F6F887830602CA9` FOREIGN KEY (`kind_id`) REFERENCES `kinds` (`id`),
  ADD CONSTRAINT `FK_8F6F88786995AC4C` FOREIGN KEY (`editor_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_8F6F8878B5B48B91` FOREIGN KEY (`public_id`) REFERENCES `publics` (`id`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_1DD399508AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `festivals` (`id`);

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `FK_8F7C2FC08AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `festivals` (`id`);

--
-- Contraintes pour la table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `FK_FEAF6C55B40130FF` FOREIGN KEY (`citie_id`) REFERENCES `cities` (`id`);

--
-- Contraintes pour la table `places_festivals`
--
ALTER TABLE `places_festivals`
  ADD CONSTRAINT `FK_60B5A27D12F492DD` FOREIGN KEY (`festivals_id`) REFERENCES `festivals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_60B5A27D8317B347` FOREIGN KEY (`places_id`) REFERENCES `places` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
