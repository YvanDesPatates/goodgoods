-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2022 at 04:17 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goodgoods`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `nomCategorie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`nomCategorie`) VALUES
('animaux'),
('electromenager'),
('mobilier '),
('nourriture');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `idCommande` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `mailUtilisateur` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `date`, `mailUtilisateur`) VALUES
(1, '2001-01-11', 'a@a.aa'),
(2, '2022-05-24', 'a@a.aa'),
(3, '2067-04-03', 'a@a.aa'),
(4, '2022-05-17', 'a@a.aa'),
(5, '2022-05-17', 'a@a.aa'),
(6, '2022-05-17', 'a@a.aa'),
(7, '2022-05-17', 'a@a.aa'),
(8, '2022-05-17', 'a@a.aa'),
(9, '2022-05-17', 'a@a.aa'),
(10, '2022-05-17', 'a@a.aa'),
(11, '2022-05-17', 'a@a.aa'),
(12, '2022-05-17', 'e@e.ee'),
(13, '2022-05-17', 'e@e.ee');

-- --------------------------------------------------------

--
-- Table structure for table `lignescommande`
--

CREATE TABLE `lignescommande` (
  `idProduit` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lignescommande`
--

INSERT INTO `lignescommande` (`idProduit`, `idCommande`, `quantite`) VALUES
(1, 3, 1),
(1, 4, 3),
(1, 9, 1),
(1, 11, 24),
(1, 12, 1),
(1, 13, 1),
(2, 1, 1),
(2, 4, 2),
(2, 10, 2),
(2, 12, 1),
(3, 2, 4),
(4, 2, 2),
(4, 7, 1),
(5, 3, 2),
(5, 4, 1),
(5, 5, 10),
(5, 6, 10),
(5, 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lignespanier`
--

CREATE TABLE `lignespanier` (
  `idProduit` int(11) NOT NULL,
  `idPanier` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paniers`
--

CREATE TABLE `paniers` (
  `idPanier` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `mailUtilisateur` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paniers`
--

INSERT INTO `paniers` (`idPanier`, `date`, `mailUtilisateur`) VALUES
(25, '2022-05-17', 'a@a.aa'),
(26, '2022-05-17', 'e@e.ee'),
(27, NULL, 'admin@a.aa');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `idProduit` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `nomCategorie` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`idProduit`, `nom`, `prix`, `description`, `nomCategorie`) VALUES
(1, 'O\'Hare Air', 130, 'Besoin de respirer ? Achetez notre air de haute qualité ! \r\nCertifiée sans pollution <3', 'nourriture'),
(2, 'Pomme de la reine', 78, 'Envie de fructose ? Cette douce pomme au goût caramélisée raviera vos papilles !\r\nGarantie sans \"additif\" <3', 'nourriture'),
(3, 'Miroir Magique', 600, 'Vous vous sentez seul ? Notre miroir vous tiendra compagnie !\r\nGarantie 100% magique <3', 'mobilier '),
(4, 'Omnidroide by Syndrome', 1000, 'Fatigué de faire le ménage ? Notre robot ménager prendra soin de votre intérieur !\r\nDélicatesse 100% garantie <3', 'electromenager'),
(5, 'Iago le perroquet', 30, 'Besoin d\'un ami fidèle ? Iago est le partenaire idéale pour vos moments de gossip !\r\nGarantie 100% fiable <3', 'animaux');

-- --------------------------------------------------------

--
-- Table structure for table `produitspartags`
--

CREATE TABLE `produitspartags` (
  `nomTag` varchar(32) NOT NULL,
  `idProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produitspartags`
--

INSERT INTO `produitspartags` (`nomTag`, `idProduit`) VALUES
('disney', 1),
('disney', 2),
('mort', 2),
('rouge', 2),
('disney', 3),
('magique', 3),
('vivant', 3),
('disney', 4),
('electrique', 4),
('disney', 5),
('rouge', 5),
('vivant', 5),
('volant', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `nomTag` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`nomTag`) VALUES
('disney'),
('electrique'),
('magique'),
('mort'),
('rouge'),
('vilain'),
('vivant'),
('volant');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `mail` varchar(64) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `estAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`mail`, `mdp`, `nom`, `prenom`, `adresse`, `estAdmin`) VALUES
('a@a.aa', 'a', 'a', 'a', 'a', 0),
('admin@a.aa', 'a', 'admin1', 'admin1', 'a', 1),
('e@e.ee', 'e', 'e', 'e', 'e', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`nomCategorie`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `fk_mailUtilisateur` (`mailUtilisateur`);

--
-- Indexes for table `lignescommande`
--
ALTER TABLE `lignescommande`
  ADD PRIMARY KEY (`idProduit`,`idCommande`),
  ADD KEY `fk_idCommande` (`idCommande`);

--
-- Indexes for table `lignespanier`
--
ALTER TABLE `lignespanier`
  ADD PRIMARY KEY (`idProduit`,`idPanier`),
  ADD KEY `fk_idpanier` (`idPanier`);

--
-- Indexes for table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`idPanier`),
  ADD KEY `fk_mailUtilisateur` (`mailUtilisateur`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `fk_nomCategorie` (`nomCategorie`);

--
-- Indexes for table `produitspartags`
--
ALTER TABLE `produitspartags`
  ADD PRIMARY KEY (`nomTag`,`idProduit`),
  ADD KEY `fk_ProduitTag` (`idProduit`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`nomTag`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_mailUtilisateur_commandes` FOREIGN KEY (`mailUtilisateur`) REFERENCES `utilisateurs` (`mail`);

--
-- Constraints for table `lignescommande`
--
ALTER TABLE `lignescommande`
  ADD CONSTRAINT `fk_idCommande` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  ADD CONSTRAINT `fk_idProduit_commande` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`);

--
-- Constraints for table `lignespanier`
--
ALTER TABLE `lignespanier`
  ADD CONSTRAINT `fk_idPanier` FOREIGN KEY (`idPanier`) REFERENCES `paniers` (`idPanier`),
  ADD CONSTRAINT `fk_idProduit` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`);

--
-- Constraints for table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `fk_mailUtilisateur` FOREIGN KEY (`mailUtilisateur`) REFERENCES `utilisateurs` (`mail`);

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_nomCategorie` FOREIGN KEY (`nomCategorie`) REFERENCES `categories` (`nomCategorie`);

--
-- Constraints for table `produitspartags`
--
ALTER TABLE `produitspartags`
  ADD CONSTRAINT `fk_ProduitTag` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`),
  ADD CONSTRAINT `fk_idNomTag` FOREIGN KEY (`nomTag`) REFERENCES `tags` (`nomTag`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
