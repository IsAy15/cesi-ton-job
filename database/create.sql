-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 13 mars 2024 à 12:03
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cesi_ton_job`
--

-- --------------------------------------------------------

--
-- Structure de la table `abilities`
--

CREATE TABLE `abilities` (
  `ab_id` int(11) NOT NULL,
  `ab_title` varchar(50) DEFAULT NULL,
  `ab_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `affects`
--

CREATE TABLE `affects` (
  `user_id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

CREATE TABLE `applications` (
  `of_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ap_cv` varchar(50) DEFAULT NULL,
  `ap_letter` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

CREATE TABLE `companies` (
  `cp_id` int(11) NOT NULL,
  `cp_name` varchar(50) DEFAULT NULL,
  `cp_sector` varchar(50) DEFAULT NULL,
  `cp_localization` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE `grades` (
  `user_id` int(11) NOT NULL,
  `cp_id` int(11) NOT NULL,
  `gr_value` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offers`
--

CREATE TABLE `offers` (
  `of_id` int(11) NOT NULL,
  `of_localization` text DEFAULT NULL,
  `of_starting_date` date DEFAULT NULL,
  `of_ending_date` date DEFAULT NULL,
  `of_places` int(11) DEFAULT NULL,
  `of_salary` double DEFAULT NULL,
  `of_applies_count` int(11) DEFAULT NULL,
  `of_type` varchar(50) DEFAULT NULL,
  `of_created_at` timestamp NULL DEFAULT current_timestamp(),
  `of_updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offer_requirements`
--

CREATE TABLE `offer_requirements` (
  `of_id` int(11) NOT NULL,
  `ab_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE `promotions` (
  `promo_id` int(11) NOT NULL,
  `promo_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `student_abilities`
--

CREATE TABLE `student_abilities` (
  `user_id` int(11) NOT NULL,
  `ab_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_lastname` varchar(50) DEFAULT NULL,
  `user_firstname` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_offer`
--

CREATE TABLE `user_offer` (
  `of_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_wishlist`
--

CREATE TABLE `user_wishlist` (
  `of_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`ab_id`);

--
-- Index pour la table `affects`
--
ALTER TABLE `affects`
  ADD PRIMARY KEY (`user_id`,`promo_id`),
  ADD KEY `promo_id` (`promo_id`);

--
-- Index pour la table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`of_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`cp_id`);

--
-- Index pour la table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`user_id`,`cp_id`),
  ADD KEY `cp_id` (`cp_id`);

--
-- Index pour la table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`of_id`),
  ADD KEY `cp_id` (`cp_id`);

--
-- Index pour la table `offer_requirements`
--
ALTER TABLE `offer_requirements`
  ADD PRIMARY KEY (`of_id`,`ab_id`),
  ADD KEY `ab_id` (`ab_id`);

--
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promo_id`);

--
-- Index pour la table `student_abilities`
--
ALTER TABLE `student_abilities`
  ADD PRIMARY KEY (`user_id`,`ab_id`),
  ADD KEY `ab_id` (`ab_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
