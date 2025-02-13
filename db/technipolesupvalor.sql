-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 13 fév. 2025 à 14:43
-- Version du serveur : 8.0.30
-- Version de PHP : 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `technipolesupvalor`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'admin', '$2y$10$2CMT01V4.kTXxI2qUPGlsOk3qLSH1ffx95xipWSDknCE5xB2ddcJ2', '2025-02-01 20:10:21');

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

CREATE TABLE `applications` (
  `id` int NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sector` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `document_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `applications`
--

INSERT INTO `applications` (`id`, `full_name`, `email`, `phone`, `project_name`, `sector`, `description`, `document_path`, `status`, `created_at`) VALUES
(1, 'POUM', 'poum.bimbar@onacc.cm', '656064153', 'TOGETTECH', 'TIC', 'Secteur d\'activité', './admin/uploads/applications/doc_67a60c05902213.34948813.pdf', 'pending', '2025-02-07 13:35:01');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mentors`
--

CREATE TABLE `mentors` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expertise` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_general_ci DEFAULT 'draft',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `author`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test', '<p>Test</p>', '/uploads/news/news_679f38fe4b6582.23575480.png', 'Admin', 'published', '2025-02-02 10:21:02', '2025-02-02 10:21:36'),
(2, 'DeepSeek-R1 : ces flous qui jettent le doute sur sa conception', '<p>DeepSeek. C&rsquo;&eacute;tait jusqu&rsquo;alors&nbsp;<a href=\"https://www.lemagit.fr/actualites/366617648/Codestral-2501-Mistral-AI-se-pose-en-champion-de-la-completion-de-code\">l&rsquo;adversaire choisi par Mistral AI.</a>&nbsp;Il est d&eacute;sormais un concurrent d&rsquo;OpenAI. Et un symbole de la course &agrave; l&rsquo;armement en mati&egrave;re d&rsquo;IA entre la Chine et les &Eacute;tats-Unis. Fond&eacute; en 2023, le laboratoire chinois, propri&eacute;t&eacute; du fonds Hedge High Flyer, a diffus&eacute; la semaine derni&egrave;re DeepSeek&nbsp;R1 Zero et R1, deux mod&egrave;les &laquo;&nbsp;open weight&nbsp;&raquo; (dont les poids sont sous licence MIT) dot&eacute;s de &laquo;&nbsp;raisonnement&nbsp;&raquo;. Ils seraient capables&nbsp;<a href=\"https://www.lemagit.fr/actualites/366610674/Avec-o1-preview-et-o1-mini-OpenAI-met-laccent-sur-le-raisonnement\">d&rsquo;&eacute;galer o1 d&rsquo;OpenAI.</a></p>\r\n\r\n<p><a href=\"https://www.lemagit.fr/actualites/366618592/DeepSeek-cachez-ces-couts-que-je-ne-saurais-voir\">Ce sont des variantes de DeepSeek&nbsp;v3</a>, d&eacute;voil&eacute; &agrave; la fin du mois de d&eacute;cembre&nbsp;2024. Ce mod&egrave;le sMoE (m&eacute;lange &eacute;pars de r&eacute;seaux de neurones experts) de 671&nbsp;milliards de param&egrave;tres a &eacute;t&eacute; entra&icirc;n&eacute; &agrave; l&rsquo;aide de 14&nbsp;800&nbsp;milliards de tokens. Comme leur mod&egrave;le d&rsquo;origine, DeepSeek&nbsp;R1 Zero et R1 n&rsquo;activent que 37&nbsp;milliards de param&egrave;tres &agrave; l&rsquo;inf&eacute;rence. Tous deux disposent d&rsquo;une fen&ecirc;tre de contexte de 128&nbsp;000 tokens.</p>\r\n\r\n<p>Les mod&egrave;les&nbsp;R1 h&eacute;ritent des capacit&eacute;s de leur a&icirc;n&eacute;. Outre l&rsquo;efficacit&eacute; de l&rsquo;architecture SMoE &agrave; &laquo;&nbsp;grains fins&nbsp;&raquo;, l&rsquo;adoption d&rsquo;un m&eacute;canisme d&rsquo;attention privil&eacute;giant la compression des donn&eacute;es &agrave; l&rsquo;inf&eacute;rence, l&rsquo;encodage des op&eacute;rations en virgule flottante en 8&nbsp;bits (et un grand nombre d&rsquo;optimisations pour y arriver), DeepSeek a adopt&eacute; un syst&egrave;me de pr&eacute;diction multitoken pour DeepSeek&nbsp;V3. Celui-ci permet de g&eacute;n&eacute;rer des tokens en parall&egrave;le afin d&rsquo;acc&eacute;l&eacute;rer la r&eacute;ponse du mod&egrave;le. Toutes ces techniques permettraient de r&eacute;duire les ressources n&eacute;cessaires &agrave; l&rsquo;entra&icirc;nement et rendre le LLM plus efficace.</p>\r\n\r\n<h2 style=\"font-style:normal\">Donner plus de place &agrave; l&rsquo;entra&icirc;nement non supervis&eacute;</h2>\r\n\r\n<p>Mais R1 se distingue par la nature de son pipeline d&rsquo;entra&icirc;nement.</p>\r\n\r\n<p>De fait, les mod&egrave;les&nbsp;R1 peuvent &ecirc;tre consid&eacute;r&eacute;s comme des variantes affin&eacute;es d&rsquo;un mod&egrave;le pr&eacute;entra&icirc;n&eacute;&nbsp;: DeepSeek V3. Pour se repr&eacute;senter la chose, il est bon de se r&eacute;f&eacute;rer &agrave; un sch&eacute;ma, celui concoct&eacute; par Meta pour&nbsp;<a href=\"https://www.lemagit.fr/conseil/Les-lecons-a-retenir-de-lentrainement-de-Llama-2\">pr&eacute;senter Llama&nbsp;2</a>.</p>\r\n', '/uploads/news/news_679f3cf82edbf1.82193988.png', 'Admin', 'published', '2025-02-02 10:38:00', '2025-02-02 10:38:00');

-- --------------------------------------------------------

--
-- Structure de la table `partners`
--

CREATE TABLE `partners` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `site_web` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('actif','inactif') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'actif',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `partners`
--

INSERT INTO `partners` (`id`, `nom`, `logo`, `description`, `site_web`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MINPMEESA', 'logo_67a4ad27f34459.22753547.png', 'Ministère des petites et moyennes entreprises de l’économie sociale et de l’artisanat', 'https://www.minpmeesa.cm/', 'actif', '2025-02-06 13:38:00', NULL),
(2, 'MINSUP', 'logo_67a4af007acda7.84738204.jpg', 'Ministère de l\'Enseignement supérieur', 'https://www.minesup.gov.cm/', 'actif', '2025-02-06 13:45:52', NULL),
(3, 'Orange', 'logo_67a4c980983f42.19258835.png', 'Portail Orange | Offres Mobiles, Internet, TV, Actu & Accès compte Mail', 'https://www.orange.fr/portail', 'actif', '2025-02-06 15:38:56', NULL),
(4, 'Campus France', 'logo_67a4cac31c02c3.08145264.png', 'Campus France vous accompagne pour venir Etudier en France.', 'https://www.campusfrance.org/fr', 'actif', '2025-02-06 15:44:19', NULL),
(5, 'Bond’Innov', 'logo_67a4cb696a5534.14639521.webp', 'Bond’innov est un accélérateur d’innovation qui accompagne depuis plus de 10 ans les projets à fort impact économique et social en Europe et en Afrique, via des outils et des méthodologies agiles, et une approche centrée sur l’humain.', 'https://bondinnov.com/', 'actif', '2025-02-06 15:47:05', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `startups`
--

CREATE TABLE `startups` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('active','suspended') COLLATE utf8mb4_general_ci DEFAULT 'active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `startups`
--

INSERT INTO `startups` (`id`, `name`, `description`, `logo`, `website`, `status`, `created_at`) VALUES
(4, 'AVU ECM', 'AVU ECM', 'logo_67a4d16c3a4d79.58895360.jpg', 'https://technipolesupvalor.com/', 'active', '2025-02-06 16:12:44');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `startups`
--
ALTER TABLE `startups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mentors`
--
ALTER TABLE `mentors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `startups`
--
ALTER TABLE `startups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
