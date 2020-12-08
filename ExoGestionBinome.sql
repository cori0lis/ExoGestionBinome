-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 08 déc. 2020 à 19:58
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ExoGestionBinome`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(1, 'Langues', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat consectetur euismod. Vivamus vitae vehicula ante. Sed rhoncus libero sed.\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201123093827', '2020-11-23 09:38:57', 401),
('DoctrineMigrations\\Version20201126152707', '2020-11-26 15:27:23', 119);

-- --------------------------------------------------------

--
-- Structure de la table `duree`
--

CREATE TABLE `duree` (
  `id` int(11) NOT NULL,
  `formation_id` int(11) DEFAULT NULL,
  `modules_id` int(11) DEFAULT NULL,
  `nb_jours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `duree`
--

INSERT INTO `duree` (`id`, `formation_id`, `modules_id`, `nb_jours`) VALUES
(1, NULL, 1, 12),
(2, NULL, 3, 13),
(3, NULL, 1, 12),
(4, NULL, 1, 31),
(5, 6, 1, 21);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `nom`, `description`) VALUES
(6, 'gdfgfdgdfgs', 'rzerzerezrzeerzrze');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `categorie_id`, `nom`, `description`) VALUES
(1, 1, 'Allemand', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat consectetur euismod. Vivamus vitae vehicula ante. Sed rhoncus libero sed.\r\n'),
(2, 1, 'Russe', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat consectetur euismod. Vivamus vitae vehicula ante. Sed rhoncus libero sed.\r\n'),
(3, 1, 'Anglais', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec volutpat consectetur euismod. Vivamus vitae vehicula ante. Sed rhoncus libero sed.\r\n'),
(4, 1, 'kldfsklfdskl', 'dlksfmqfklsqmld');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `formation_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nombre_places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `formation_id`, `nom`, `date_debut`, `date_fin`, `nombre_places`) VALUES
(1, 6, 'LOREM', '2020-06-15', '2021-09-09', 10),
(2, 6, 'rgffgfd', '2015-01-01', '2015-01-01', 10),
(3, 6, 'TESTSessionsddq', '2015-01-01', '2015-01-01', 10);

-- --------------------------------------------------------

--
-- Structure de la table `session_stagiaire`
--

CREATE TABLE `session_stagiaire` (
  `session_id` int(11) NOT NULL,
  `stagiaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `session_stagiaire`
--

INSERT INTO `session_stagiaire` (`session_id`, `stagiaire_id`) VALUES
(1, 1),
(1, 2),
(1, 5),
(1, 6),
(1, 8),
(2, 5),
(3, 1),
(3, 2),
(3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `civilite`, `date_naissance`, `ville`, `adresse`, `cp`, `email`, `telephone`) VALUES
(1, 'KLOS', 'Matthias', 'H', '1993-06-21', 'Algolsheim', '1 Rue d\'Alsace', '68600', 'm.z.klos@gmail.com', '0612345678'),
(2, 'BENSAADA', 'Iann', 'H', '1992-12-24', 'Wintzenheim', '1 Rue de Colmar', '68920', 'beniann@hotmail.com', '0600121212'),
(5, 'TEST', 'test', 'F', '2020-01-01', 'TESTY', 'rue test', '67000', 'test@test.frfdfddfdfs', '0695782323'),
(6, 'TEST', 'test', 'F', '2020-01-01', 'TESTY', 'rue test', '67000', 'sdfsdffds@dfs.FR', '0695782323'),
(8, 'Klos', 'Matthias', 'F', '2020-01-01', 'Rhinau', '9B Rue du Rhin', '67860', 'm.z.klos@gmail.com', '0695782323');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `civilite`, `date_naissance`, `ville`, `adresse`, `cp`, `telephone`, `reset_token`) VALUES
(17, 'admin@test.fr', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$7SNVf942bu821AzLnHZAKw$gZiFVLHbsWZnUqv1D/rbvBIqyn71nzSyhBPmWWyVmdE', 'ADMIN', 'secretaire', 'F', '2020-01-01', 'Strasbourg', '7B rue de l\'abreuvoir', '67000', '0980998089', NULL),
(18, 'user@test.fr', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$7SNVf942bu821AzLnHZAKw$gZiFVLHbsWZnUqv1D/rbvBIqyn71nzSyhBPmWWyVmdE', 'USER', 'Formateur', 'F', '2020-01-01', 'Strasbourg', '7B rue de l\'abreuvoir', '67000', '0980998089', NULL),
(19, 'superadmin@test.fr', '[\"ROLE_SUPER_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$7SNVf942bu821AzLnHZAKw$gZiFVLHbsWZnUqv1D/rbvBIqyn71nzSyhBPmWWyVmdE', 'SUPERADMIN', 'Direction', 'F', '2020-01-01', 'Rhinau', '9B Rue du Rhin', '67860', '0695782323', NULL),
(20, 'test@test.frfdfddfdfs', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$7SNVf942bu821AzLnHZAKw$gZiFVLHbsWZnUqv1D/rbvBIqyn71nzSyhBPmWWyVmdE', 'TEST', 'test', 'F', '2020-01-01', 'TESTY', 'rue test', '67000', '0695782323', NULL),
(22, 'exogestion@yopmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$7SNVf942bu821AzLnHZAKw$gZiFVLHbsWZnUqv1D/rbvBIqyn71nzSyhBPmWWyVmdE', 'TESTdds', 'test', 'F', '2020-01-01', 'TESTY', 'rue test', '67000', '0695782312', 'w-Zoy4Wgr4SdZORXC6BlWMyd9CXlEK7E92Jncxn0BCY'),
(26, 'm.z.klos@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$ZQY1iNF/Gl/6HZyGLs1NUw$t7Yzl1iVCowyLCSM/y4jkMrhYnfz6wQLwO849/pl+hg', 'Klos', 'Matthias', 'F', '2020-01-01', 'Rhinau', '9B Rue du Rhin', '67860', '0695782323', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_categorie`
--

CREATE TABLE `utilisateur_categorie` (
  `utilisateur_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur_categorie`
--

INSERT INTO `utilisateur_categorie` (`utilisateur_id`, `categorie_id`) VALUES
(18, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `duree`
--
ALTER TABLE `duree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8456C0355200282E` (`formation_id`),
  ADD KEY `IDX_8456C03560D6DC42` (`modules_id`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C242628BCF5E72D` (`categorie_id`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D044D5D45200282E` (`formation_id`);

--
-- Index pour la table `session_stagiaire`
--
ALTER TABLE `session_stagiaire`
  ADD PRIMARY KEY (`session_id`,`stagiaire_id`),
  ADD KEY `IDX_C80B23B613FECDF` (`session_id`),
  ADD KEY `IDX_C80B23BBBA93DD6` (`stagiaire_id`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1D1C63B3E7927C74` (`email`);

--
-- Index pour la table `utilisateur_categorie`
--
ALTER TABLE `utilisateur_categorie`
  ADD PRIMARY KEY (`utilisateur_id`,`categorie_id`),
  ADD KEY `IDX_29D32318FB88E14F` (`utilisateur_id`),
  ADD KEY `IDX_29D32318BCF5E72D` (`categorie_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `duree`
--
ALTER TABLE `duree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `duree`
--
ALTER TABLE `duree`
  ADD CONSTRAINT `FK_8456C0355200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`),
  ADD CONSTRAINT `FK_8456C03560D6DC42` FOREIGN KEY (`modules_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `FK_C242628BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`);

--
-- Contraintes pour la table `session_stagiaire`
--
ALTER TABLE `session_stagiaire`
  ADD CONSTRAINT `FK_C80B23B613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C80B23BBBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur_categorie`
--
ALTER TABLE `utilisateur_categorie`
  ADD CONSTRAINT `FK_29D32318BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_29D32318FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
