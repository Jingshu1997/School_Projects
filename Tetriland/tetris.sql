-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 02 déc. 2021 à 13:19
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tetris`
--

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `difficulte` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `joueur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `JOUEUR_id` (`joueur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`id`, `difficulte`, `score`, `joueur_id`) VALUES
(1, 'hard', 727, 13),
(2, 'easy', 69, 14),
(3, 'medium', 420, 13),
(4, 'hard', 69420, 13),
(5, 'hard', 2, 13),
(6, 'easy', 100, 13),
(38, 'medium', 3000, 13),
(39, 'medium', 800, 13);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `joueur_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `best_score_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`joueur_id`),
  KEY `BEST_SCORE_id` (`best_score_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`joueur_id`, `nom`, `prenom`, `pseudo`, `mdp`, `email`, `best_score_id`, `age`) VALUES
(17, 'A', 'B', 'C', '$2y$10$74qiXKfEY.bEk7r9uD0SZucZBFj7HDWa8THS3cCPbtICjk4UlFIhC', 'e', 0, 6),
(15, 'Cabotte', 'Martin', 'M', '$2y$10$b6A7kz5m54YUbeafJjJlWOyHi736jqW1ZfiX1so3qxoMvhcAHiDeO', 'm@m.m', 0, 2),
(16, 'Chebrek', 'Alexis', 'AlexisC', '$2y$10$seYmvzbzddFhcJ/BTSJtX.xcSta32W/abGGMRXZ3adyFPSkyoezSa', 'alexis@chebrek.com', 0, 1),
(14, 'Bermudes', 'BDE', 'BDEDB', '$2y$10$50YmCfU5f8sy/beimgJ0K.EaEJ1h45oFC1vey.GU6c0AQmwZS15p2', 'bde@eilco-ulco.fr', 2, 30),
(13, 'Lefevre', 'Pierre', 'MineCrp', '$2y$10$UrXU4JvHyqqbdWVHJmeeJ.GVqwRnUs7i7AKpPdoC3Qkpew.1RKfQ6', 'p.lefevre62100@hotmail.fr', 39, 21);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
