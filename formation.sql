-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 26 août 2019 à 07:43
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `formation`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Mécanique'),
(2, 'Bureautique'),
(3, 'Mode');

-- --------------------------------------------------------

--
-- Structure de la table `duree_module`
--

DROP TABLE IF EXISTS `duree_module`;
CREATE TABLE IF NOT EXISTS `duree_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formation_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CBCC4EED5200282E` (`formation_id`),
  KEY `IDX_CBCC4EEDAFC2B591` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `duree_module`
--

INSERT INTO `duree_module` (`id`, `formation_id`, `module_id`, `duree`) VALUES
(1, 1, 1, 15),
(2, 1, 4, 12),
(3, 1, 3, 4),
(4, 2, 2, 2),
(5, 2, 6, 4),
(6, 2, 10, 5),
(7, 3, 7, 6),
(8, 3, 8, 9),
(9, 5, 7, 25),
(10, 2, 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE IF NOT EXISTS `formateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `ville`, `email`, `telephone`) VALUES
(1, 'Legrand', 'Hervé', 'H', '2012-07-18', 'TROYES', 'zouzou@boum.com', '03 88 64 97 26'),
(3, 'Meck', 'Annick', 'F', '2012-02-07', 'SCHTROUMPFHOUSE', 'annick.meck@boum.com', '04 68 77 21 64'),
(4, 'Durand', 'Albert', 'H', '2012-08-16', 'LISIEUX', 'albator@gogo.com', '54 25 87 89 65'),
(5, 'Dubois', 'Lise', 'F', '1997-06-05', 'OBERNAI', 'lise.dubois@gogo.fr', '03 77 17 26 30'),
(6, 'Durand', 'Luc', 'H', '1996-01-01', 'Gfftrdtr', 'ld@gogo.fr', '031245879');

-- --------------------------------------------------------

--
-- Structure de la table `formateur_categorie`
--

DROP TABLE IF EXISTS `formateur_categorie`;
CREATE TABLE IF NOT EXISTS `formateur_categorie` (
  `formateur_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`formateur_id`,`categorie_id`),
  KEY `IDX_5B796C83155D8F51` (`formateur_id`),
  KEY `IDX_5B796C83BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formateur_categorie`
--

INSERT INTO `formateur_categorie` (`formateur_id`, `categorie_id`) VALUES
(1, 2),
(3, 1),
(4, 1),
(4, 2),
(5, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nb_places` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `date_debut`, `date_fin`, `nb_places`, `nom`) VALUES
(1, '2020-07-23', '2021-02-20', 10, 'Mécanicien polyvalent'),
(2, '2020-05-20', '2021-07-10', 12, 'Formation de Pack Outils'),
(3, '2019-12-16', '2020-01-10', 12, 'Chiffons et clefs de douze'),
(5, '2019-09-29', '2020-11-16', 10, 'Vendeur mode'),
(6, '2019-01-01', '2019-03-01', 5, 'TEST DIPLOME');

-- --------------------------------------------------------

--
-- Structure de la table `formation_module`
--

DROP TABLE IF EXISTS `formation_module`;
CREATE TABLE IF NOT EXISTS `formation_module` (
  `formation_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`formation_id`,`module_id`),
  KEY `IDX_2C3D28055200282E` (`formation_id`),
  KEY `IDX_2C3D2805AFC2B591` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation_module`
--

INSERT INTO `formation_module` (`formation_id`, `module_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(2, 2),
(2, 6),
(2, 10),
(3, 4),
(3, 5),
(3, 9),
(3, 11),
(5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `formation_stagiaire`
--

DROP TABLE IF EXISTS `formation_stagiaire`;
CREATE TABLE IF NOT EXISTS `formation_stagiaire` (
  `formation_id` int(11) NOT NULL,
  `stagiaire_id` int(11) NOT NULL,
  PRIMARY KEY (`formation_id`,`stagiaire_id`),
  KEY `IDX_851FA7EC5200282E` (`formation_id`),
  KEY `IDX_851FA7ECBBA93DD6` (`stagiaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation_stagiaire`
--

INSERT INTO `formation_stagiaire` (`formation_id`, `stagiaire_id`) VALUES
(1, 7),
(1, 10),
(1, 11),
(2, 1),
(2, 5),
(2, 14),
(2, 15),
(3, 5),
(3, 13),
(5, 9),
(5, 12),
(5, 13),
(6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190723125501', '2019-07-23 12:56:33');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C242628BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `categorie_id`, `nom`) VALUES
(1, 1, 'Mécanique quantique'),
(2, 2, 'Word'),
(3, 1, 'Orange mécanique'),
(4, 1, 'Mécanique automobile'),
(5, 1, 'Derviche-tourneur-fraiseur'),
(6, 2, 'Excel'),
(7, 3, 'Broderie'),
(8, 3, 'Tricot'),
(9, 3, 'Couture'),
(10, 2, 'Power Point'),
(11, 3, 'Mercerie');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `ville`, `email`, `telephone`) VALUES
(1, 'Mirouet', 'Ursule', 'H', '2023-08-27', 'CHERBOURG', 'urs.mir@tsointsoin.fr', '03 89 37 11 82'),
(5, 'Durand', 'Albert', 'H', '2012-03-28', 'COLMAR', 'albert.durand@gogo.com', '02 42 66 89 34'),
(7, 'Groumpf', 'Loïc', 'H', '2012-08-18', 'ANDLAU', 'loic.groumpf@gogo.com', '02 42 66 89 34'),
(9, 'Desbordes-Valmore', 'Marceline', 'F', '1942-02-10', 'BRUYERES', 'marce.desval@gogo.fr', '00 00 00 00 00'),
(10, 'Valjean', 'Jean', 'H', '1944-10-01', 'PARIS', 'jeanvaljean@gogo.fr', '00 00 00 00 00'),
(11, 'Grangier', 'Gilles', 'H', '1960-08-04', 'CORBIGNY', 'gilles.grangier@gogo.fr', '00 00 00 00 00'),
(12, 'Joyeux', 'Odette', 'F', '1946-07-27', 'ROMAGNE', 'odettejoyeux@gogo.fr', '04 07 68 22 46'),
(13, 'Natanson', 'Agathe', 'F', '1952-03-22', 'MULSANNE', 'agaganat@gogo.fr', '02 77 22 99 00'),
(14, 'Baudelaire', 'Charles', 'H', '1998-01-08', 'NEMOURS', 'chabaude@boum.com', '00 00 00 00 00'),
(15, 'Chenard', 'Cindy', 'F', '2004-05-30', 'MONTMIRAIL', 'cindychenard@boum.com', '02 62 88 14 63');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(2, 'admin', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=6,p=1$dkpOYVovTmhja2JBM21FYg$99xMjkHK4QAr1AEXM5il/XcJabsInu03H7yFW8RCwKQ'),
(3, 'test', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=6,p=1$TFlUREhLZXFHaDJubVdiTQ$g6CR5Fbix6oR6mwdzmW+XlOq2giVgo1NFzyTRMgeKis');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `duree_module`
--
ALTER TABLE `duree_module`
  ADD CONSTRAINT `FK_CBCC4EED5200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`),
  ADD CONSTRAINT `FK_CBCC4EEDAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `formateur_categorie`
--
ALTER TABLE `formateur_categorie`
  ADD CONSTRAINT `FK_5B796C83155D8F51` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5B796C83BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formation_module`
--
ALTER TABLE `formation_module`
  ADD CONSTRAINT `FK_2C3D28055200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2C3D2805AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formation_stagiaire`
--
ALTER TABLE `formation_stagiaire`
  ADD CONSTRAINT `FK_851FA7EC5200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_851FA7ECBBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `FK_C242628BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
