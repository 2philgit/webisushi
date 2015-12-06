-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 03 Décembre 2015 à 14:30
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `isushi`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`id`, `name`, `firstname`, `email`, `password`, `phone`, `address`, `created`) VALUES
(1, 'Martinet', 'Philippe', 'philippe.agm@gmail.com', 'phil', '0699999999', '10, rue des Ecluses, 75010 Paris', '2015-12-02 12:12:21'),
(2, 'Rambutot', 'Arthur', 'tutur.sollet@laposte.net', 'tutur', '0699999998', '9, rue des Ecluses, 75010 Paris', '2015-12-01 11:00:21'),
(3, 'Durand', 'Catherine', 'ufm040@free.fr', 'cath', '0699999997', '11, rue des Ecluses, 75010 Paris', '2015-11-02 12:12:21');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_client` int(10) UNSIGNED NOT NULL,
  `id_produit` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `total` int(10) UNSIGNED NOT NULL,
  `id_magasin` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `magasins`
--

CREATE TABLE `magasins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `magasins`
--

INSERT INTO `magasins` (`id`, `name`, `address`, `phone`) VALUES
(1, 'Magasin1', '13, rue des Ecluses, 75010 Paris', '0120102010');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_produit_menu` int(10) UNSIGNED NOT NULL,
  `id_produit` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`id`, `id_produit_menu`, `id_produit`) VALUES
(1, 22, 7),
(2, 22, 16),
(3, 22, 6),
(4, 22, 5),
(5, 22, 14),
(6, 23, 7),
(7, 23, 16),
(8, 23, 21),
(9, 23, 11),
(10, 24, 7),
(11, 24, 16),
(12, 24, 10),
(13, 24, 8),
(14, 24, 9);

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_client` int(10) UNSIGNED NOT NULL,
  `id_menu` int(10) UNSIGNED NOT NULL,
  `count_cmd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(7) UNSIGNED NOT NULL,
  `is_menu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id`, `name`, `description`, `image`, `price`, `is_menu`) VALUES
(5, 'maki avocat', 'maki à l''avocat (x6)', 'imgisushi/maki-avocat.jpg', 4, 1),
(6, 'maki California', 'maki california (x6)', 'imgisushi/maki-california.jpg', 4, 1),
(7, 'miso soup', 'soupe japonaise', 'imgisushi/miso-soup.jpeg', 3, 1),
(8, 'nigiri crevette', 'Nigiri crevette (x2)', 'imgisushi/nigiri-crevette.jpg', 4, 1),
(9, 'nigiri saumon', 'Nigiri saumon (x2)', 'imgisushi/nigiri-saumon.jpg', 4, 1),
(10, 'nigiri thon otoro', 'Nigiri thon otoro (x2)', 'imgisushi/nigiri-thon.jpg', 8, 1),
(11, 'rice', 'bol de riz vapeur', 'imgisushi/rice.jpg', 3, 1),
(12, 'nigri omelette', 'nigiri omelette (x2)', 'imgisushi/nigiri-omelette.jpg', 4, 0),
(13, 'maki california crevette', 'california roll à la crevette (x6)', 'imgisushi/crevette-california.jpg', 5, 0),
(14, 'maki concombre', 'maki concombre (x6)', 'imgisushi/maki-concombre.jpg', 4, 1),
(15, 'maki thon avocat', 'maki thon-avocat (x6)', 'imgisushi/maki-thon-avocat.jpg', 5, 0),
(16, 'salade', 'salade japonaise', 'imgisushi/salade.jpg', 6, 1),
(17, 'sashimi macqueraux', 'sashimi de macqueraux', 'imgisushi/sashimi-macqueraux.jpg', 4, 0),
(18, 'sashimi thon otoro', 'sashimi du fameux et reputé thon otoro!', 'imgisushi/sashimi-thon-otoro.jpg', 10, 0),
(19, 'spicy crabe roll', 'california roll au crabe (x6)', 'imgisushi/spicy-crabe-roll.jpg', 5, 0),
(20, 'tempura crevette', 'Tempura aux crevettes', 'imgisushi/tempura-crevette.jpg', 5, 0),
(21, 'sashimi saumon', 'Sashimi de saumon', 'imgisushi/sashimi-saumon.jpg', 5, 1),
(22, 'menu Maki', 'Soupe, salade, maki California (x6), avocat (x6)et concombre (x6)', 'imgisushi/menu-maki.jpg', 12, 0),
(23, 'menu Sashimi', 'Soupe, salade, sashimi saumon, riz', 'imgisushi/menu-sashimi.jpg', 14, 0),
(24, 'menu Nigiri', 'Soupe, salade, nigiri saumon (x2), thon (x2), crevette (x2)', 'imgisushi/menu-nigiri.jpg', 15, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emails` (`email`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_ids` (`id_client`),
  ADD KEY `produit_ids` (`id_produit`),
  ADD KEY `magasin_ids` (`id_magasin`);

--
-- Index pour la table `magasins`
--
ALTER TABLE `magasins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produit_ids` (`id_produit`) USING BTREE,
  ADD KEY `produit_menu_ids` (`id_produit_menu`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_ids` (`id_client`),
  ADD KEY `menu_ids` (`id_menu`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `magasins`
--
ALTER TABLE `magasins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `clients_commandes` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `magasins_commandes` FOREIGN KEY (`id_magasin`) REFERENCES `magasins` (`id`),
  ADD CONSTRAINT `produits_commandes` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `produits_menus` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `produits_menus_menus` FOREIGN KEY (`id_produit_menu`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `clients_offres` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `menus_offres` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
