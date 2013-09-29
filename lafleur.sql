-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 16 Septembre 2013 à 19:05
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lafleur`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` char(3) NOT NULL,
  `nom` char(32) NOT NULL,
  `mdp` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `mdp`) VALUES
('1', 'toto', 'toto'),
('2', 'titi', 'titi');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` char(32) NOT NULL,
  `libelle` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
('com', 'Composition'),
('fle', 'Fleurs'),
('pla', 'Plantes');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` char(32) NOT NULL,
  `dateCommande` date DEFAULT NULL,
  `nomPrenomClient` char(32) DEFAULT NULL,
  `adresseRueClient` char(32) DEFAULT NULL,
  `cpClient` char(5) DEFAULT NULL,
  `villeClient` char(32) DEFAULT NULL,
  `mailClient` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `dateCommande`, `nomPrenomClient`, `adresseRueClient`, `cpClient`, `villeClient`, `mailClient`) VALUES
('1101461660', '2011-07-12', 'Dupont Jacques', '12, rue haute', '75001', 'Paris', 'dupont@wanadoo.fr'),
('1101461665', '2011-07-20', 'Durant Yves', '23, rue des ombres', '75012', 'Paris', 'durant@free.fr');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `idCommande` char(32) NOT NULL,
  `idProduit` char(32) NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`),
  KEY `I_FK_CONTENIR_COMMANDE` (`idCommande`),
  KEY `I_FK_CONTENIR_Produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contenir`
--

INSERT INTO `contenir` (`idCommande`, `idProduit`) VALUES
('1101461660', 'f03'),
('1101461660', 'p01'),
('1101461665', 'f05'),
('1101461665', 'p06');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id` char(32) NOT NULL,
  `description` char(50) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` char(32) DEFAULT NULL,
  `idCategorie` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `I_FK_Produit_CATEGORIE` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `description`, `prix`, `image`, `idCategorie`) VALUES
('c01', 'Panier de fleurs variées', '53.00', 'images/compo/aniwa.gif', 'com'),
('c02', 'Coup de charme jaune', '38.00', 'images/compo/kos.gif', 'com'),
('c03', 'Bel arrangement de fleurs de saison', '68.00', 'images/compo/loth.gif', 'com'),
('c04', 'Coup de charme vert', '41.00', 'images/compo/luzon.gif', 'com'),
('c05', 'Très beau panier de fleurs précieuses', '98.00', 'images/compo/makin.gif', 'com'),
('c06', 'Bel assemblage de fleurs précieuses', '68.00', 'images/compo/mosso.gif', 'com'),
('c07', 'Présentation prestigieuse', '128.00', 'images/compo/rawaki.gif', 'com'),
('c11', 'fleur', '200.00', 'images/nondisponible.gif', 'com'),
('f01', 'Bouquet de roses multicolores', '58.00', 'images/fleurs/comores.gif', 'fle'),
('f02', 'Bouquet de roses rouges', '50.00', 'images/fleurs/grenadines.gif', 'fle'),
('f03', 'Bouquet de roses jaunes', '78.00', 'images/fleurs/mariejaune.gif', 'fle'),
('f04', 'Bouquet de petites roses jaunes', '48.00', 'images/fleurs/mayotte.gif', 'fle'),
('f05', 'Fuseau de roses multicolores', '63.00', 'images/fleurs/philippines.gif', 'fle'),
('f06', 'Petit bouquet de roses roses', '43.00', 'images/fleurs/pakopoka.gif', 'fle'),
('f07', 'Panier de roses multicolores', '78.00', 'images/fleurs/seychelles.gif', 'fle'),
('f9', 'tulipe', '50.00', 'images/nondisponible.gif', 'fle'),
('p01', 'Plante fleurie', '43.00', 'images/plantes/antharium.gif', 'pla'),
('p02', 'Pot de phalaonopsis', '58.00', 'images/plantes/galante.gif', 'pla'),
('p03', 'Assemblage paysagé', '103.00', 'images/plantes/lifou.gif', 'pla'),
('p04', 'Belle coupe de plantes blanches', '128.00', 'images/plantes/losloque.gif', 'pla'),
('p05', 'Pot de mitonia mauve', '83.00', 'images/plantes/papouasi.gif', 'pla'),
('p06', 'Pot de phalaonopsis blanc', '58.00', 'images/plantes/pionosa.gif', 'pla'),
('p07', 'Pot de phalaonopsis rose mauve', '58.00', 'images/plantes/sabana.gif', 'pla'),
('p9', 'fleur de merde', '50.00', 'images/nondisponible.gif', 'pla');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
