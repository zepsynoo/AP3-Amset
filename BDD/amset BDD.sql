-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 06 déc. 2024 à 13:59
-- Version du serveur : 8.3.0
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `amset`
--
CREATE DATABASE IF NOT EXISTS `amset` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `amset`;

-- --------------------------------------------------------

--
-- Structure de la table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_groups_users_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 2, 'admin', '2024-12-06 12:18:44'),
(3, 4, 'rhu', '2024-12-06 12:20:46'),
(4, 5, 'com', '2024-12-06 12:21:51');

-- --------------------------------------------------------

--
-- Structure de la table `auth_identities`
--

DROP TABLE IF EXISTS `auth_identities`;
CREATE TABLE IF NOT EXISTS `auth_identities` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `secret` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `secret2` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text COLLATE utf8mb3_unicode_ci,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_secret` (`type`,`secret`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(2, 2, 'email_password', NULL, 'admin@amset.com', '$2y$12$w.Iw8EVyGhfRGN0lrU/fme.Wlq0FH/GxCsvf48PLRJglkGe4lQAsy', NULL, NULL, 0, '2024-12-06 12:22:10', '2024-12-06 12:18:30', '2024-12-06 12:22:10'),
(4, 4, 'email_password', NULL, 'rhu@amset.com', '$2y$12$mq8VezENYCEh/53kI.JCWeL1BmY01Mf63e7IoS39U8UyPv89W5t.S', NULL, NULL, 0, NULL, '2024-12-06 12:20:31', '2024-12-06 12:20:32'),
(5, 5, 'email_password', NULL, 'com@amset.com', '$2y$12$qyI14C9vDFhP2IK3JJWHp.62geZ/l4MlLy3yqtLwlnZ2VRJwvCaBO', NULL, NULL, 0, NULL, '2024-12-06 12:21:35', '2024-12-06 12:21:35');

-- --------------------------------------------------------

--
-- Structure de la table `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'admin@amset.com', 1, '2024-12-06 12:02:04', 1),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'admin@amset.com', 1, '2024-12-06 12:02:20', 1),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'admin@amset.com', 1, '2024-12-06 12:03:54', 1),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'admin@amset.com', 1, '2024-12-06 12:10:28', 1),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'admin@amset.com', 1, '2024-12-06 12:11:45', 1),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'admin@amset.com', 2, '2024-12-06 12:22:10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `auth_permissions_users`
--

DROP TABLE IF EXISTS `auth_permissions_users`;
CREATE TABLE IF NOT EXISTS `auth_permissions_users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_permissions_users_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auth_remember_tokens`
--

DROP TABLE IF EXISTS `auth_remember_tokens`;
CREATE TABLE IF NOT EXISTS `auth_remember_tokens` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `auth_remember_tokens_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auth_token_logins`
--

DROP TABLE IF EXISTS `auth_token_logins`;
CREATE TABLE IF NOT EXISTS `auth_token_logins` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `ID_CLIENT` int NOT NULL AUTO_INCREMENT,
  `RAISON_SOCIAL` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NOM` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRENOM` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TELEPHONE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADRESSE` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CODE_POSTAL` int DEFAULT NULL,
  `VILLE` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IMG` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_CLIENT`, `RAISON_SOCIAL`, `NOM`, `PRENOM`, `EMAIL`, `TELEPHONE`, `ADRESSE`, `CODE_POSTAL`, `VILLE`, `IMG`) VALUES
(2, '826003', 'Test', 'Testeur', 'test@exemple.com', '0516123350', 'TestVille', 86201, 'ville', NULL),
(3, '826003', 'Amset', 'Amset', 'test@exemple.com', '0523628593', 'TestVille', 82700, 'ville', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1733486406, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1733486406, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1733486406, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

DROP TABLE IF EXISTS `mission`;
CREATE TABLE IF NOT EXISTS `mission` (
  `ID_MISSION` int NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int NOT NULL,
  `INTITULE_MISSION` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DESCRIPTION_MISSION` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DATE_DEBUT` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DATE_FIN` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_MISSION`),
  KEY `I_FK_MISSION_CLIENT` (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`ID_MISSION`, `ID_CLIENT`, `INTITULE_MISSION`, `DESCRIPTION_MISSION`, `DATE_DEBUT`, `DATE_FIN`) VALUES
(1, 1, 'Charaaba', 'Stupid stdubedubddfirferg', '11/10/2024', '11/10/2025'),
(3, 2, 'Test', 'testeur de test', '2021-12-12', '2022-12-12');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `ID_PROFIL` int NOT NULL AUTO_INCREMENT,
  `LIBELLE` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_PROFIL`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`ID_PROFIL`, `LIBELLE`) VALUES
(2, 'Développement'),
(3, 'Administration système et réseau'),
(4, 'Conception d’application'),
(5, 'DevOps'),
(6, 'Développement web Fullstack'),
(7, 'Ingénierie IA'),
(8, 'Chef de projet multimédia'),
(9, 'Chef de projet (général)'),
(10, 'Directeur de projet');

-- --------------------------------------------------------

--
-- Structure de la table `profil_mission`
--

DROP TABLE IF EXISTS `profil_mission`;
CREATE TABLE IF NOT EXISTS `profil_mission` (
  `ID_PROFIL` int NOT NULL,
  `ID_MISSION` int NOT NULL,
  `NOMBRE_PROFIL` int DEFAULT NULL,
  PRIMARY KEY (`ID_PROFIL`,`ID_MISSION`),
  KEY `I_FK_PROFIL_MISSION_PROFIL` (`ID_PROFIL`),
  KEY `I_FK_PROFIL_MISSION_MISSION` (`ID_MISSION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profil_mission`
--

INSERT INTO `profil_mission` (`ID_PROFIL`, `ID_MISSION`, `NOMBRE_PROFIL`) VALUES
(2, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

DROP TABLE IF EXISTS `salarie`;
CREATE TABLE IF NOT EXISTS `salarie` (
  `ID_SALARIE` int NOT NULL AUTO_INCREMENT,
  `NOM_SALARIE` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRENOM_SALARIE` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CIVILITE` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EMAIL_SALARIE` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TELEPHONE_SALARIE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADRESSE_SALARIE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CODE_POSTAL_SALARIE` int DEFAULT NULL,
  `VILLE_SALARIE` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IMG_SALARIE` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_SALARIE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salarie`
--

INSERT INTO `salarie` (`ID_SALARIE`, `NOM_SALARIE`, `PRENOM_SALARIE`, `CIVILITE`, `EMAIL_SALARIE`, `TELEPHONE_SALARIE`, `ADRESSE_SALARIE`, `CODE_POSTAL_SALARIE`, `VILLE_SALARIE`, `IMG_SALARIE`) VALUES
(1, 'test', 'test', 'homme', 'test@test.com', '03210320', '00603sdd', 16853, 'Paris', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `salarie_mission`
--

DROP TABLE IF EXISTS `salarie_mission`;
CREATE TABLE IF NOT EXISTS `salarie_mission` (
  `ID_SALARIE` int NOT NULL,
  `ID_MISSION` int NOT NULL,
  PRIMARY KEY (`ID_SALARIE`,`ID_MISSION`),
  KEY `I_FK_SALARIE_MISSION_SALARIE` (`ID_SALARIE`),
  KEY `I_FK_SALARIE_MISSION_MISSION` (`ID_MISSION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salarie_mission`
--

INSERT INTO `salarie_mission` (`ID_SALARIE`, `ID_MISSION`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `salarie_profil`
--

DROP TABLE IF EXISTS `salarie_profil`;
CREATE TABLE IF NOT EXISTS `salarie_profil` (
  `ID_PROFIL` int NOT NULL,
  `ID_SALARIE` int NOT NULL,
  PRIMARY KEY (`ID_PROFIL`,`ID_SALARIE`),
  KEY `I_FK_SALARIE_PROFIL_PROFIL` (`ID_PROFIL`),
  KEY `I_FK_SALARIE_PROFIL_SALARIE` (`ID_SALARIE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salarie_profil`
--

INSERT INTO `salarie_profil` (`ID_PROFIL`, `ID_SALARIE`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb3_unicode_ci,
  `type` varchar(31) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'string',
  `context` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'admin', NULL, NULL, 0, '2024-12-06 12:43:32', '2024-12-06 12:18:30', '2024-12-06 12:18:30', NULL),
(4, 'rhu', NULL, NULL, 0, NULL, '2024-12-06 12:20:31', '2024-12-06 12:20:31', NULL),
(5, 'com', NULL, NULL, 0, NULL, '2024-12-06 12:21:34', '2024-12-06 12:21:34', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;
