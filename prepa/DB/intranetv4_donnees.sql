-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 12 sep. 2019 à 09:51
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `intranetv4`
--

--
-- Déchargement des données de la table `lafiliere`
--

INSERT INTO `lafiliere` (`idlafiliere`, `lenom`, `lacronyme`, `lacouleur`, `lepicto`) VALUES
(1, 'Web Developer', 'WEB', NULL, 'images/web.png'),
(2, 'Animateur Multimédia', 'AMM', NULL, 'images/amm.png');

--
-- Déchargement des données de la table `lasession`
--

INSERT INTO `lasession` (`idlasession`, `lenom`, `lacronyme`, `lannee`, `lenumero`, `letype`, `debut`, `fin`, `lafiliere_idfiliere`) VALUES
(1, 'WEB2019', 'WEB2019', 2019, 1, 2, '2019-01-07', '2019-11-08', 1),
(2, 'AMM2019', 'AMM2019', 2019, 1, 2, '2019-02-04', '2019-12-20', 2);

--
-- Déchargement des données de la table `leconge`
--

INSERT INTO `leconge` (`idleconge`, `debut`, `fin`, `letype`, `lasession_idlasession`) VALUES
(1, '2019-05-31', '2019-05-31', 2, 1),
(2, '2019-12-27', '2019-12-27', 2, 1),
(3, '2019-07-06', '2019-08-25', 3, 1),
(4, '2019-06-19', '2019-06-19', 1, 1),
(5, '2019-05-02', '2019-05-02', 3, 1),
(6, '2019-07-03', '2019-07-03', 2, 1);

--
-- Déchargement des données de la table `ledroit`
--

INSERT INTO `ledroit` (`idledroit`, `lintitule`, `ladescription`) VALUES
(1, 'Imprimer la feuille de signature', 'Imprimer la feuille de signature pour chaque groupe'),
(2, 'Modifier un droit', 'Pouvoir modifier un droit existant'),
(3, 'Créer un rôle', 'Pouvoir créer un nouveau rôle pour l\'associer à un utilisateur'),
(4, 'Supprimer un droit', 'Pouvoir supprimer un droit existant'),
(5, 'Lire un droit', 'Pouvoir lire un droit existant associé à un rôle'),
(6, 'Créer un droit', 'Pouvoir créer un nouveau droit pour l\'associer à un rôle'),
(7, 'Lire un rôle', 'Pouvoir lire un rôle existant associé à un utilisateur'),
(8, 'Modifier un rôle', 'Pouvoir modifier un rôle existant'),
(9, 'Supprimer un rôle', 'Pouvoir supprimer un rôle existant'),
(10, 'Encoder les présences', 'Pouvoir encoder les présences, les retards, les absences des stagiaires'),
(11, 'Consulter les présences', 'Pouvoir visualiser les statistiques de présence des stagiaires');

--
-- Déchargement des données de la table `lerole`
--

INSERT INTO `lerole` (`idlerole`, `lintitule`, `ladescription`) VALUES
(1, 'Membre du personnel', 'Toute personne faisant partie du personnel du CF2M'),
(2, 'Agent d\'accueil', 'La personne à l\'accueil qui enregistre les arrivées et départs des stagiaires'),
(3, 'Référent Pédagogique', 'La personne qui s\'occupe du suivi pédagogique des stagiaires'),
(4, 'Administrateur Technique', 'La personne qui gère la configuration du système'),
(5, 'Stagiaire', 'La personne qui suit une formation au CF2M');

--
-- Déchargement des données de la table `linscription`
--

INSERT INTO `linscription` (`idlinscription`, `debut`, `fin`, `utilisateur_idutilisateur`, `lasession_idsession`) VALUES
(1, '2019-01-07', '2019-11-08', 9, 1),
(2, '2019-02-04', '2019-11-08', 10, 1);

--
-- Déchargement des données de la table `lutilisateur`
--

INSERT INTO `lutilisateur` (`idlutilisateur`, `lenomutilisateur`, `lemotdepasse`, `lenom`, `leprenom`, `lemail`, `luniqueid`) VALUES
(1, 'sylviane.mol', '$2y$10$INbdexessFV77JvfdT6UZOfhGhTiLPig5LklRzBE8FYYl/JJ/OGcO', 'Mol', 'Sylviane', 'sylviane.mol@cf2m.be', ''),
(2, 'pierre.sandron', '$2y$10$6UP1Ay5XP22TfgdW5mtuF..FpPiqn0V3U1R2AGv3W4JxveudUkOTS', 'Sandron', 'Pierre', 'pierre.sandron@cf2m.be', ''),
(9, 'oumar.abakar', '$2y$10$Uy5JcTI0Umd8g6yKdz03NujB.c8XAXvYOxUxiKpxmt1SqjAc.6wyC', 'Abakar', 'Oumar', 'oumar.abakar@cf2m', ''),
(10, 'dimitri.bouvy', '$2y$10$P7298YzZQtTrR8LbPYjjKOaTK8QtUABsd3RK1VvJjF4mSRP7q4ocG', 'Bouvy', 'Dimitri', 'dimitri.bouvy@cf2m', ''),
(11, 'michael.pitz', '$2y$10$AFDabmByLMmB9X55LMSy5eW31q.bpeJrtPYfD6VS5S35fGtX4/Uca', 'Pitz', 'Michaël', 'michael.pitz@cf2m.be', 'key5d79f7898ac7d1.65147365');

--
-- Déchargement des données de la table `lutilisateur_has_lerole`
--

INSERT INTO `lutilisateur_has_lerole` (`lutilisateur_idutilisateur`, `lerole_idlerole`) VALUES
(9, 1),
(2, 2),
(1, 3),
(11, 4),
(10, 5);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
