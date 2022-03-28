-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 28 mars 2022 à 13:05
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
-- Base de données : `gsbextranet`
--

-- --------------------------------------------------------

--
-- Structure de la table `archhistoriqueco`
--

DROP TABLE IF EXISTS `archhistoriqueco`;
CREATE TABLE IF NOT EXISTS `archhistoriqueco` (
  `id` int(11) NOT NULL,
  `dateDebutLog` datetime NOT NULL,
  `dateFinLog` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`dateDebutLog`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `archhistoriqueco`
--

INSERT INTO `archhistoriqueco` (`id`, `dateDebutLog`, `dateFinLog`) VALUES
(6, '2021-09-08 16:39:00', '2021-09-08 16:39:00'),
(6, '2021-09-16 20:40:35', '2021-09-16 20:40:35'),
(5, '2021-09-16 20:40:35', '2021-09-16 20:40:35'),
(7, '2021-09-16 20:44:03', '2021-09-16 20:44:03'),
(7, '2016-10-01 16:07:45', '2016-10-01 16:08:45'),
(7, '2021-12-17 23:12:14', '2021-12-17 23:12:36'),
(7, '2021-09-29 16:16:02', NULL),
(11, '2021-11-29 11:32:46', '2021-11-29 11:32:46');

-- --------------------------------------------------------

--
-- Structure de la table `archmedecin`
--

DROP TABLE IF EXISTS `archmedecin`;
CREATE TABLE IF NOT EXISTS `archmedecin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anneeNaiss` year(4) DEFAULT NULL,
  `dateCreation` date DEFAULT NULL,
  `dateArchivage` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `archmedecin`
--

INSERT INTO `archmedecin` (`id`, `anneeNaiss`, `dateCreation`, `dateArchivage`) VALUES
(5, 2000, '2021-11-10', '2021-11-18 22:39:01'),
(7, 1965, '2021-11-18', '2021-11-18 22:51:29'),
(11, NULL, '2021-11-29', '2021-12-23 18:44:57');

-- --------------------------------------------------------

--
-- Structure de la table `archproduit`
--

DROP TABLE IF EXISTS `archproduit`;
CREATE TABLE IF NOT EXISTS `archproduit` (
  `idMedecin` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  PRIMARY KEY (`idMedecin`,`idProduit`,`date`,`heure`) USING BTREE,
  KEY `fk_idProduit` (`idProduit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `archproduit`
--

INSERT INTO `archproduit` (`idMedecin`, `idProduit`, `date`, `heure`) VALUES
(5, 3, '2021-11-03', '22:41:02'),
(6, 1, '2021-11-11', '22:23:33'),
(7, 3, '2021-11-04', '22:50:05');

-- --------------------------------------------------------

--
-- Structure de la table `archvisioconsulte`
--

DROP TABLE IF EXISTS `archvisioconsulte`;
CREATE TABLE IF NOT EXISTS `archvisioconsulte` (
  `idMedecin` int(11) NOT NULL,
  `idVisio` int(11) NOT NULL,
  `dateInscription` datetime DEFAULT NULL,
  PRIMARY KEY (`idMedecin`,`idVisio`) USING BTREE,
  KEY `fk_idVisio` (`idVisio`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `archvisioconsulte`
--

INSERT INTO `archvisioconsulte` (`idMedecin`, `idVisio`, `dateInscription`) VALUES
(6, 1, '2021-10-12 00:00:00'),
(5, 1, '2021-11-10 00:00:00'),
(7, 2, '2021-11-05 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `idGrade` int(11) NOT NULL AUTO_INCREMENT,
  `libelleGrade` varchar(30) NOT NULL,
  PRIMARY KEY (`idGrade`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`idGrade`, `libelleGrade`) VALUES
(1, 'Administrateur'),
(2, 'Visteur');

-- --------------------------------------------------------

--
-- Structure de la table `historiqueconnexion`
--

DROP TABLE IF EXISTS `historiqueconnexion`;
CREATE TABLE IF NOT EXISTS `historiqueconnexion` (
  `idMedecin` int(11) NOT NULL,
  `dateDebutLog` datetime NOT NULL,
  `dateFinLog` datetime DEFAULT NULL,
  PRIMARY KEY (`idMedecin`,`dateDebutLog`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historiqueconnexion`
--

INSERT INTO `historiqueconnexion` (`idMedecin`, `dateDebutLog`, `dateFinLog`) VALUES
(16, '2021-12-23 18:31:18', '2021-12-23 18:31:18'),
(16, '2021-12-23 18:31:37', NULL),
(16, '2021-12-23 18:32:26', NULL),
(16, '2021-12-23 18:37:29', NULL),
(16, '2022-01-04 15:24:59', NULL),
(16, '2022-01-07 16:11:54', NULL),
(16, '2022-01-07 16:12:23', '2022-01-07 16:12:30'),
(16, '2022-03-14 19:04:38', '2022-03-14 19:05:21'),
(16, '2022-03-14 19:05:26', NULL),
(16, '2022-03-14 19:23:48', NULL),
(16, '2022-03-14 19:24:24', NULL),
(16, '2022-03-14 19:24:51', NULL),
(16, '2022-03-14 19:25:12', NULL),
(16, '2022-03-14 19:25:40', NULL),
(16, '2022-03-17 19:03:43', NULL),
(16, '2022-03-21 14:10:50', NULL),
(16, '2022-03-27 16:35:45', NULL),
(16, '2022-03-27 16:35:54', NULL),
(16, '2022-03-27 16:36:30', NULL),
(16, '2022-03-27 16:38:51', NULL),
(16, '2022-03-27 16:48:04', NULL),
(16, '2022-03-28 14:18:32', '2022-03-28 14:52:16'),
(17, '2022-03-28 14:59:50', '2022-03-28 14:59:50'),
(17, '2022-03-28 15:01:33', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bascule` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`id`, `bascule`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `dateNaissance` year(4) DEFAULT NULL,
  `motDePasse` varchar(255) DEFAULT NULL,
  `dateCreation` datetime DEFAULT NULL,
  `rpps` varchar(10) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `dateDiplome` date DEFAULT NULL,
  `dateConsentement` date DEFAULT NULL,
  `numGrade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_GradeMedecin` (`numGrade`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id`, `nom`, `prenom`, `mail`, `dateNaissance`, `motDePasse`, `dateCreation`, `rpps`, `token`, `dateDiplome`, `dateConsentement`, `numGrade`) VALUES
(16, 'Ramillon', 'Théo', 'u????\'???[?f??0ak?7a???ibEjF???E????', NULL, '$2y$10$Z/gbQs.jdiCgkaethSLrQOcnMsHRmYoiaEI8yfxNROq5jPT4dXTXq', '2021-12-23 18:31:18', NULL, NULL, NULL, '2021-12-23', 1),
(17, 'Docteur', 'Medecin', '??k??>???????>ak?7a???ib3;???O?', NULL, '$2y$10$elyf2GoURpcG2VjTm3tYFeLSBn20.dSwhQmmnsw2r.g4kxotBckr.', '2022-03-28 14:59:50', NULL, NULL, NULL, '2022-03-28', 2);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `medecininactifs`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `medecininactifs`;
CREATE TABLE IF NOT EXISTS `medecininactifs` (
`idMedecin` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `medecinproduit`
--

DROP TABLE IF EXISTS `medecinproduit`;
CREATE TABLE IF NOT EXISTS `medecinproduit` (
  `idMedecin` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  PRIMARY KEY (`idMedecin`,`idProduit`,`Date`,`Heure`),
  KEY `idProduit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medecinvisio`
--

DROP TABLE IF EXISTS `medecinvisio`;
CREATE TABLE IF NOT EXISTS `medecinvisio` (
  `idMedecin` int(11) NOT NULL,
  `idVisio` int(11) NOT NULL,
  `dateInscription` date NOT NULL,
  PRIMARY KEY (`idMedecin`,`idVisio`),
  KEY `idVisio` (`idVisio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecinvisio`
--

INSERT INTO `medecinvisio` (`idMedecin`, `idVisio`, `dateInscription`) VALUES
(16, 2, '2022-03-27');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `objectif` mediumtext NOT NULL,
  `information` mediumtext NOT NULL,
  `effetIndesirable` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `objectif`, `information`, `effetIndesirable`) VALUES
(1, 'Doliprane', 'Soulager', 'cool', 'La'),
(3, 'Medoc', 'Aider', 'Ils sont bon', 'Diaré'),
(10, 'Un produit', 'soigne', 'il soigne', 'Urticaire');

-- --------------------------------------------------------

--
-- Structure de la table `visioconference`
--

DROP TABLE IF EXISTS `visioconference`;
CREATE TABLE IF NOT EXISTS `visioconference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomVisio` varchar(100) DEFAULT NULL,
  `objectif` text,
  `url` varchar(100) DEFAULT NULL,
  `dateVisio` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visioconference`
--

INSERT INTO `visioconference` (`id`, `nomVisio`, `objectif`, `url`, `dateVisio`) VALUES
(1, 'test', 'test', 'test', '2021-10-14'),
(2, 'Choucroute', NULL, NULL, '2021-11-02');

-- --------------------------------------------------------

--
-- Structure de la vue `medecininactifs`
--
DROP TABLE IF EXISTS `medecininactifs`;

DROP VIEW IF EXISTS `medecininactifs`;
CREATE ALGORITHM=UNDEFINED DEFINER=`GSBEXTRANET`@`%` SQL SECURITY DEFINER VIEW `medecininactifs`  AS  select `historiqueconnexion`.`idMedecin` AS `idMedecin` from `historiqueconnexion` group by `historiqueconnexion`.`idMedecin` having ((year(now()) - year(max(`historiqueconnexion`.`dateFinLog`))) >= 3) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historiqueconnexion`
--
ALTER TABLE `historiqueconnexion`
  ADD CONSTRAINT `historiqueconnexion_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `fk_GradeMedecin` FOREIGN KEY (`numGrade`) REFERENCES `grade` (`idGrade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `medecinproduit`
--
ALTER TABLE `medecinproduit`
  ADD CONSTRAINT `medecinproduit_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medecinproduit_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `medecinvisio`
--
ALTER TABLE `medecinvisio`
  ADD CONSTRAINT `medecinvisio_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medecinvisio_ibfk_2` FOREIGN KEY (`idVisio`) REFERENCES `visioconference` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Évènements
--
DROP EVENT `suppressionMedecin`$$
CREATE DEFINER=`GSBEXTRANET`@`%` EVENT `suppressionMedecin` ON SCHEDULE EVERY 1 MINUTE STARTS '2021-10-08 16:25:38' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
DELETE FROM medecinvisio
WHERE idMedecin IN (SELECT idMedecin FROM medecininactifs);
DELETE FROM medecinproduit
WHERE idMedecin IN (SELECT idMedecin FROM medecininactifs);
CREATE TABLE Temporaire SELECT * FROM medecininactifs;
DELETE FROM historiqueconnexion
WHERE idMedecin IN (SELECT idMedecin FROM medecininactifs);
DELETE FROM medecin
WHERE id IN (SELECT idMedecin FROM Temporaire);
DROP TABLE Temporaire;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
