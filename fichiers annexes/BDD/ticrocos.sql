-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 08 avr. 2022 à 14:30
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ticrocos`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id` int(11) NOT NULL,
  `adresse_num` int(5) NOT NULL,
  `adresse_rue` varchar(200) NOT NULL,
  `adresse_infos` text DEFAULT NULL,
  `adresse_ville` varchar(150) NOT NULL,
  `adresse_postal` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE `contrats` (
  `id` int(11) NOT NULL,
  `contrat_pro` int(11) NOT NULL,
  `contrat_facture` varchar(255) NOT NULL,
  `contrat_infos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `contrat_dispo_pivot`
--

CREATE TABLE `contrat_dispo_pivot` (
  `id` int(11) NOT NULL,
  `id_contrat` int(11) NOT NULL,
  `id_dispo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `contrat_enfants_pivot`
--

CREATE TABLE `contrat_enfants_pivot` (
  `id` int(11) NOT NULL,
  `id_enfant` int(11) NOT NULL,
  `id_contrat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites`
--

CREATE TABLE `disponibilites` (
  `id` int(11) NOT NULL,
  `dispo_id_groupe` int(11) NOT NULL,
  `dispo_id_pro` int(11) NOT NULL,
  `dispo_jour` varchar(20) NOT NULL,
  `dispo_heure_debut` time NOT NULL,
  `dispo_heure_fin` time NOT NULL,
  `dispo_places` int(11) NOT NULL,
  `dispo_suppr` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='disponibilité = 1h';

-- --------------------------------------------------------

--
-- Structure de la table `enfants`
--

CREATE TABLE `enfants` (
  `id` int(11) NOT NULL,
  `enfant_nom` varchar(100) NOT NULL,
  `enfant_prenom` varchar(100) NOT NULL,
  `enfant_sexe` varchar(1) NOT NULL,
  `enfant_parent` int(11) NOT NULL,
  `enfant_photo` varchar(255) DEFAULT NULL,
  `enfant_carnet` varchar(255) DEFAULT NULL,
  `enfant_naissance` date NOT NULL,
  `enfants_infos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `parent_nom` varchar(100) NOT NULL,
  `parent_prenom` varchar(100) NOT NULL,
  `parent_email` varchar(150) NOT NULL,
  `parent_password` varchar(255) NOT NULL,
  `parent_token` varchar(60) DEFAULT NULL,
  `parent_adresse` varchar(255) DEFAULT NULL,
  `parent_ville` varchar(255) NOT NULL,
  `parent_postal` int(5) NOT NULL,
  `parent_numAdresse` varchar(20) NOT NULL,
  `parent_infosAdresse` varchar(255) NOT NULL,
  `parent_naissance` date NOT NULL,
  `parent_tel` int(11) NOT NULL,
  `parent_photo` varchar(255) DEFAULT NULL,
  `est_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `parents`
--

INSERT INTO `parents` (`id`, `parent_nom`, `parent_prenom`, `parent_email`, `parent_password`, `parent_token`, `parent_adresse`, `parent_ville`, `parent_postal`, `parent_numAdresse`, `parent_infosAdresse`, `parent_naissance`, `parent_tel`, `parent_photo`, `est_admin`) VALUES
(1, 'Fradin', 'Théo', 'admin@gmail.com', '$2y$10$7lmXct8QNTbnHfcJMeGroun8g1lYY1RiNEMVU86BbPafY2JAsuiV6', NULL, 'Boulevard Gambetta', 'Rouen', 76000, '6', '', '2003-10-01', 608665145, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `professionnels`
--

CREATE TABLE `professionnels` (
  `id` int(11) NOT NULL,
  `pro_nom` varchar(100) NOT NULL,
  `pro_prenom` varchar(100) NOT NULL,
  `pro_entreprise` varchar(255) DEFAULT NULL,
  `pro_description` text NOT NULL,
  `pro_categorie` varchar(50) NOT NULL,
  `pro_adresse` varchar(255) NOT NULL,
  `pro_numAdresse` varchar(20) NOT NULL,
  `pro_infosAdresse` varchar(255) NOT NULL,
  `pro_ville` varchar(255) NOT NULL,
  `pro_postal` int(5) NOT NULL,
  `pro_telephone` int(11) NOT NULL,
  `pro_password` varchar(255) NOT NULL,
  `pro_email` varchar(150) NOT NULL,
  `pro_token` varchar(255) NOT NULL,
  `pro_photo` varchar(255) DEFAULT NULL,
  `pro_taux_horaire` int(11) NOT NULL,
  `pro_naissance` date DEFAULT NULL,
  `pro_siret` varchar(14) DEFAULT NULL,
  `pro_identite` varchar(255) DEFAULT NULL,
  `pro_iban` varchar(100) NOT NULL,
  `pro_approuve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contrat_dispo_pivot`
--
ALTER TABLE `contrat_dispo_pivot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contrat_enfants_pivot`
--
ALTER TABLE `contrat_enfants_pivot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `professionnels`
--
ALTER TABLE `professionnels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `contrat_dispo_pivot`
--
ALTER TABLE `contrat_dispo_pivot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `contrat_enfants_pivot`
--
ALTER TABLE `contrat_enfants_pivot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `enfants`
--
ALTER TABLE `enfants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `professionnels`
--
ALTER TABLE `professionnels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
