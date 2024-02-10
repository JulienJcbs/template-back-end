-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : sam. 10 fév. 2024 à 04:26
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `corale`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` text COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `first_name`, `last_name`, `tel`) VALUES
('6zCFXRVtC4kzIwUfsxa8tQ4C86nvVJ6PPcrZ', 'julien.j.1999@hotmail.com', '$2y$14$lLGGdG6ZAj6vi2PJvSfKaOS9.vHuXV8TID0sQgxNsiuZgnDgLWR/C', 'Julien', 'Jacobs', '0470938633');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `create_at`, `visible`) VALUES
('yAQ9AILVU43VAXWeeo2ze8f3yTuZDfG5FqmD', 'Merci à nos donateurs.', '2024-02-04 12:09:31', 1),
('aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'Nouveau concert le 24/02/2024', '2024-02-04 10:44:42', 1),
('XaBnzPRhnm0bHhM2nR8dhujyU82GHVaZFBbJ', 'Notre nouveau site web est disponnible.', '2024-02-09 23:48:56', 0);

-- --------------------------------------------------------

--
-- Structure de la table `article_content`
--

DROP TABLE IF EXISTS `article_content`;
CREATE TABLE IF NOT EXISTS `article_content` (
  `id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `article_id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `order_index` int NOT NULL DEFAULT '0',
  `text_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'black',
  `font_size` double NOT NULL DEFAULT '1',
  `uri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `text_align` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'start',
  `link_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '#',
  `text_content_fr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `text_content_nl` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `text_content_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `article_content`
--

INSERT INTO `article_content` (`id`, `article_id`, `type`, `order_index`, `text_color`, `font_size`, `uri`, `text_align`, `link_to`, `text_content_fr`, `text_content_nl`, `text_content_en`) VALUES
('dHLygfUzfI203ijsB2RvGJhsu3AFJUyoVmTp', 'WiMVy6MKfmlIJpylZ3RfiKi8shsFatEUbLTi', 'p', 0, 'black', 1, '', 'start', '', 'p', '', ''),
('ZukwxzVS8Ien8Luz7o5nYeGRgt2ahkdCMiRq', 'WiMVy6MKfmlIJpylZ3RfiKi8shsFatEUbLTi', 'p', 1, 'black', 1.6, '', 'center', '', 'Mon superbe texte est génial', '', ''),
('hpHprpSitpTGnrOXhruUTblsiU9Tt5Py2czJ', 'WiMVy6MKfmlIJpylZ3RfiKi8shsFatEUbLTi', 'img', 0, 'black', 1, 'HunTUoh7HKpfe6Wc6ybDWMtORaITrKE1tNcHlaiv7sj9vWB4', 'center', '', 'img', '', ''),
('29aUH90tJBoABL9A1V6L88VrsxO92fv92zv6', 'WiMVy6MKfmlIJpylZ3RfiKi8shsFatEUbLTi', '', 0, 'black', 1, '', 'start', '', '', '', ''),
('YPeEnZil7OUfgj1U5X7ic9Ud1SXQ0qVniOMj', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'h2', 0, 'black', 1, '', 'start', '', 'h2', '', ''),
('vADualSNius8NIXiFuxWWFwUUPqFcqoSgj9e', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'p', 2, 'black', 1.4, '', 'start', '', 'Dans l\'éclat des projecteurs, l\'atmosphère électrique enveloppe la salle de concert d\'une aura vibrante, prête à accueillir les mélodies enchanteresses qui vont bientôt résonner. Les murmures excités des spectateurs créent un bourdonnement constant, une symphonie de pré-anticipation, alors que chacun attend avec impatience l\'expérience musicale à venir.', 'In het schijnsel van de spotlights omhult een elektrische sfeer de concertzaal met een vibrerende aura, klaar om de betoverende melodieën te ontvangen die binnenkort zullen weerklinken. De opgewonden fluisteringen van het publiek creëren een voortdurend gezoem, een symfonie van voor-anticipatie, terwijl iedereen vol ongeduld wacht op de komende muzikale ervaring', ''),
('MNyxTh5pGaqkIaS0XCuenROcuxGCaDFwLBcD', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'p', 3, 'black', 1.4, '', 'start', '', 'Les lumières s\'éteignent, plongeant la salle dans l\'obscurité, créant une toile parfaite pour les étoiles qui vont bientôt illuminer la scène. Le murmure de l\'excitation atteint son apogée lorsque les premières notes timides résonnent, initiant un voyage musical captivant. Les accords puissants des guitares, la cadence hypnotique de la batterie et la douce mélodie des claviers se mélangent pour créer une symphonie envoûtante qui emporte le public dans un tourbillon d\'émotions. Sur scène, les artistes deviennent des maestros, dirigeant un orchestre de passion et d\'énergie. Le public, une mer ondulante de têtes se balançant au rythme envoûtant, est emporté par la magie sonore qui les transporte loin de la réalité quotidienne. Les paroles résonnent, évoquant des souvenirs, des rêves et des émotions partagées. Chaque chanson est une pièce unique de l\'énorme puzzle musical, contribuant à la création d\'un moment inoubliable. Les applaudissements entre les morceaux créent une symphonie d\'appréciation, une reconnaissance collective de l\'artiste et de la connexion partagée entre scène et public. Le concert devient une célébration commune de la musique, transcendant les barrières individuelles pour créer un lien entre des milliers d\'âmes réunies par leur amour commun pour les mélodies et les harmonies. La musique pulse dans les veines du public, créant une énergie contagieuse qui unit tous les spectateurs dans une expérience collective unique. Et alors que la dernière note résonne, laissant une réverbération dans l\'air, la magie persiste, laissant derrière elle des souvenirs gravés dans le cœur de chaque spectateur. Le concert se termine, mais l\'empreinte musicale demeure, prête à être évoquée à tout moment, rappelant la puissance intemporelle de la musique live.', 'De lichten gaan uit, waardoor de zaal in duisternis gehuld wordt en een perfect canvas creëert voor de sterren die binnenkort het podium zullen verlichten. Het gefluister van opwinding bereikt zijn hoogtepunt wanneer de eerste verlegen noten weerklinken, waardoor een meeslepende muzikale reis wordt ingeluid. De krachtige akkoorden van de gitaren, het hypnotiserende ritme van de drums en de zachte melodie van de toetsen vermengen zich tot een betoverende symfonie die het publiek meesleept in een draaikolk van emoties. Op het podium worden de artiesten dirigenten, die een orkest van passie en energie leiden. Het publiek, een golvende zee van hoofden die meedeinen op het betoverende ritme, wordt meegesleept door de sonische magie die hen ver weg van de dagelijkse realiteit brengt. De songteksten resoneren, roepen herinneringen, dromen en gedeelde emoties op. Elk nummer is een uniek stuk van de enorme muzikale puzzel, bijdragend aan het creëren van een onvergetelijk moment. Het applaus tussen de nummers creëert een symfonie van waardering, een collectieve erkenning van de artiest en de gedeelde verbinding tussen podium en publiek. Het concert wordt een gezamenlijke viering van muziek, waarbij individuele barrières worden overstegen om een band te creëren tussen duizenden zielen die verenigd zijn door hun gemeenschappelijke liefde voor melodieën en harmonieën. De muziek pulseert door de aderen van het publiek, waardoor een aanstekelijke energie ontstaat die alle toeschouwers verenigt in een unieke collectieve ervaring. En terwijl de laatste noot weerklinkt, achterlatend een echo in de lucht, blijft de magie voortbestaan, met herinneringen die in het hart van elke toeschouwer gegrift staan. Het concert eindigt, maar de muzikale indruk blijft bestaan, klaar om op elk moment opgeroepen te worden, waardoor de tijdloze kracht van live muziek wordt herinnerd.', ''),
('bQXiZifBZnW4DbjcKY40nZjUrLj6wVGfaJC5', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'img', 0, 'black', 1, '6P6kdgWPpxOtVv2qpESrJjhVNDoGyusjTCYEDMQYfNHMzVq5', 'start', '', 'img', '', ''),
('EHTl3nTzuNl4jXVwfuKgzWURlSaGlWXatsik', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'p', 4, 'black', 1.4, '', 'start', '', 'Sur scène, les artistes deviennent des maestros, dirigeant un orchestre de passion et d\'énergie. Le public, une mer ondulante de têtes se balançant au rythme envoûtant, est emporté par la magie sonore qui les transporte loin de la réalité quotidienne. Les paroles résonnent, évoquant des souvenirs, des rêves et des émotions partagées.', 'Op het podium veranderen de artiesten in meesters, die een orkest van passie en energie leiden. Het publiek, een golvende zee van hoofden die zich wiegen op het betoverende ritme, wordt meegesleept door de sonische magie die hen ver weg van de alledaagse realiteit brengt. De woorden resoneren, roepen herinneringen, dromen en gedeelde emoties op.', ''),
('udWM4ZHnEyQ7iMD0umIln1Tat09wFiTSlNmw', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'p', 5, 'black', 1.4, '', 'start', '', 'Chaque chanson est une pièce unique de l\'énorme puzzle musical, contribuant à la création d\'un moment inoubliable. Les applaudissements entre les morceaux créent une symphonie d\'appréciation, une reconnaissance collective de l\'artiste et de la connexion partagée entre scène et public.', 'Elk nummer is een uniek stuk van de enorme muzikale puzzel, bijdragend aan het creëren van een onvergetelijk moment. Het applaus tussen de nummers creëert een symfonie van waardering, een collectieve erkenning van de artiest en de gedeelde verbinding tussen podium en publiek.', ''),
('6GcY26hswPfTv7KJFF1gh0JuRUGVYKCQG9Df', 'yAQ9AILVU43VAXWeeo2ze8f3yTuZDfG5FqmD', 'p', 1, '#000000', 1.4, '', 'start', '', 'Par la présente, nous souhaitons exprimer notre plus profonde gratitude envers chacun de nos généreux donateurs. Votre soutien inestimable a été la pierre angulaire de notre mission, nous permettant d\'accomplir des réalisations significatives et d\'apporter des changements positifs dans la vie de ceux que nous servons. Chaque contribution, grande ou petite, a eu un impact tangible, nourrissant nos efforts pour créer un monde meilleur. Votre confiance et votre générosité continuent d\'insuffler une énergie renouvelée à notre engagement, et nous tenons à vous remercier chaleureusement pour votre précieuse contribution à notre cause.', '', ''),
('9txNRpsptZ9NujwuX5WInJOOnLoBrC3iEOmN', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'p', 6, 'black', 1.4, '', 'center', '', 'Le concert devient une célébration commune de la musique, transcendant les barrières individuelles pour créer un lien entre des milliers d\'âmes réunies par leur amour commun pour les mélodies et les harmonies. La musique pulse dans les veines du public, créant une énergie contagieuse qui unit tous les spectateurs dans une expérience collective unique.', 'Het concert wordt een gezamenlijke viering van muziek, waarbij individuele barrières worden overstegen om een band te creëren tussen duizenden zielen die verenigd zijn door hun gemeenschappelijke liefde voor melodieën en harmonieën. De muziek pulseert door de aderen van het publiek, waardoor een aanstekelijke energie ontstaat die alle toeschouwers verenigt in een unieke collectieve ervaring.', ''),
('yOZcNvkp7t1Yig5SrTkP6gmySkKZ79xwmha6', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'p', 7, 'black', 1.4, '', 'center', '', 'Et alors que la dernière note résonne, laissant une réverbération dans l\'air, la magie persiste, laissant derrière elle des souvenirs gravés dans le cœur de chaque spectateur. Le concert se termine, mais l\'empreinte musicale demeure, prête à être évoquée à tout moment, rappelant la puissance intemporelle de la musique live.', 'En terwijl de laatste noot weerklinkt, achterlatend een echo in de lucht, blijft de magie voortbestaan, met herinneringen die in het hart van elke toeschouwer gegrift staan. Het concert eindigt, maar de muzikale indruk blijft bestaan, klaar om op elk moment opgeroepen te worden, waardoor de tijdloze kracht van live muziek wordt herinnerd.', ''),
('k1KCejBqi0wBKmHt9SuZOF9VZfYtpGgQChhs', 'yAQ9AILVU43VAXWeeo2ze8f3yTuZDfG5FqmD', 'p', 2, 'black', 1.4, '', 'start', '', 'C\'est grâce à des individus tels que vous que nous pouvons poursuivre notre mission avec détermination et espoir. Chaque don représente bien plus qu\'une simple contribution financière ; il incarne un acte de solidarité et de compassion envers notre communauté. Nous sommes profondément reconnaissants de votre soutien indéfectible et de votre engagement envers notre cause. Ensemble, nous continuons à bâtir un avenir meilleur, et cela n\'aurait pas été possible sans votre générosité exceptionnelle. Merci du fond du cœur pour votre précieux soutien.', '', ''),
('DDM58RXx1E9Lr68Amqd8PBnzSUdMKAJpvgUN', 'yAQ9AILVU43VAXWeeo2ze8f3yTuZDfG5FqmD', 'img', 0, 'black', 1, 'wfsuMfE1dFsk9Yse9ctwXZmCsPNDpA1HkuR2OG0u7aZFL3NK', 'start', '', 'img', '', ''),
('FmsDLnvYmINvc66ndphO6YTMPHRWRLYdSSpF', 'XaBnzPRhnm0bHhM2nR8dhujyU82GHVaZFBbJ', 'h1', 0, 'black', 1, '', 'start', '', 'Notre nouveau site web est disponnible.', '', ''),
('WGk5GmjJhfHzXt6kgvZaAYjSPDDtvndy2gDe', 'XaBnzPRhnm0bHhM2nR8dhujyU82GHVaZFBbJ', 'h1', 0, 'black', 1, '', 'start', '', 'Allez y faire un tours.', '', ''),
('lheE4HhzGH9tfDlAnoh34GrTdWMOlo0JcEwB', 'XaBnzPRhnm0bHhM2nR8dhujyU82GHVaZFBbJ', 'h1', 0, 'black', 1, '', 'start', '', 'Merci d\'avoir lu.', '', ''),
('Q5NYlLqmPfkLfOj6VmqaWZoXasa6kF8wezaB', 'XaBnzPRhnm0bHhM2nR8dhujyU82GHVaZFBbJ', 'img', 0, 'black', 1, 'pQniXeKcqBaWNT04NDKDNeNKqk74bwRjbg1wLmFjjAEaDOpA', 'start', '', 'img', '', ''),
('UihIhc3LtXrVDlcGIliKRCZ523OrXOuoqPL5', 'yAQ9AILVU43VAXWeeo2ze8f3yTuZDfG5FqmD', 'h1', -1, '#000000', 3, '', 'center', '', 'Présentation.', '', ''),
('k0Kzf4rSnWGbPqyskunHFrk4vMS8uMmoaQvJ', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'h1', -1, 'black', 2.4, '', 'center', '', 'Bientôt un nouveau concert.', '', ''),
('HwcsF7TdNWtz5ybWfSU3tS3jdommQmQFWTBO', 'aZW23eoDDiU9PDAmRJfWq8NQCzVsP2rn6oM3', 'a', 3, 'black', 1, '', 'end', 'http://localhost:3000/members', 'Nous tenons tout de même à remercier nos membres.', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `nb_persons_regular` int NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `nb_persons_vip` int NOT NULL DEFAULT '0',
  `reg_prize` double NOT NULL DEFAULT '0',
  `vip_prize` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `nb_persons_regular`, `visible`, `date`, `event_name`, `nb_persons_vip`, `reg_prize`, `vip_prize`) VALUES
('oUt1fYIlLDjVvWSNxu9ih9Sjqip06MhYE3qA', 300, 0, '2024-05-08 15:00:00', 'Soirée du 8 mai.', 40, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `event_reservations`
--

DROP TABLE IF EXISTS `event_reservations`;
CREATE TABLE IF NOT EXISTS `event_reservations` (
  `id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `nb_persons` int NOT NULL,
  `user_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ref` varchar(18) COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(16) COLLATE utf8mb4_bin NOT NULL,
  `event_id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(64) COLLATE utf8mb4_bin NOT NULL DEFAULT 'waiting',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref` (`ref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `event_reservations`
--

INSERT INTO `event_reservations` (`id`, `nb_persons`, `user_id`, `timestamp`, `ref`, `type`, `event_id`, `status`) VALUES
('HCRYfx7LBDNy4ew7NsIY5oz56DzzfsMbe8TY', 1, 'k5c8gAYIxL0ucsR2Tkqy2z2UMTZA821jCuBq', '2024-02-10 02:52:35', 'IOPsJDvL857AonC3gZ', 'regular', '9', 'waiting'),
('hhZUcSEWrVjZcgKjHPDbunx4786JUbKkPPhh', 1, 'k5c8gAYIxL0ucsR2Tkqy2z2UMTZA821jCuBq', '2024-02-10 02:51:41', '0HxPMh3Z4ugvVv8QIt', 'regular', '9', 'waiting'),
('5J78wYwUSTAfXc2qC5EsqnCHVS6WbSOJNHmB', 1, 'k5c8gAYIxL0ucsR2Tkqy2z2UMTZA821jCuBq', '2024-02-10 02:52:08', 'p5V23A1KDTGQ6yvUyr', 'regular', '9', 'waiting');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `image_uri` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `role`, `description`, `image_uri`, `tel`, `email`) VALUES
('WMJwURTEpdhfPiRIfeXKeISYipJhqLzMyFw7', 'Eglantine', 'Didier', 'Régis', 'Superbe description. Après tout c\'est ma pote', '48yiV2iXRVhWB9jv8n07rZTiDoXYWsuIdD01rKVHNbKKuq4a', '0470938633', 'micromachine77@gmail.com'),
('6NT4mZZO8lqbGrIJpi5pskocJ4BDlBPxIYTE', 'Julien', 'Jacobs', 'Développeur', 'Développeur du site présenter actuellement.\r\nConnait React et php.', 'NrOCpnT5Y389c9YyyJgRPgPNLCgGGh89C18r5XWuVr9d4qo8', '0470938633', 'julien.j.1999@hotmail.com'),
('DTXyGqaJzePcqZXSQG7eTpSk3Prn6rVhBF0i', 'Léocadie', 'Jacobs', 'Chanteur', 'Léocadie à la voix d\'ors fait des miracles.', 'VUPPaY4fNz1paxy7K4BV7uH5rQxhsMNn03KAwLo6YlHQMavc', '0479764646', 'leocadie@live.be');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `email_sender` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `quest_type` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT 'waiting',
  `full_name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `email_sender`, `content`, `quest_type`, `status`, `full_name`, `timestamp`) VALUES
('wCy2EO67kiBsF6KN0qqKw5CxQ9IchfqHl6j6', 'micromachine77@gmail.com', 'Bonjour comment est-ce que ca se passe concernant les dons? A qui vont t\'ils?\r\nCar j\'ai un amis qui voudrait faire partie de votre espace donateur.', 'Concernant les dons', 'waiting', 'Julien Jacobs', '2024-02-03 12:29:02'),
('FOWuEK9LDj01UDAGtKm8YzBcUwQgAnuhLpFD', 'micromachine77@gmail.com', 'Comment pourrais-je obtenir plus de renseignements?\r\nJe voudrais créer mon propre site web et faire appel à votre développeur, où puis-je le trouver?', 'Autre', 'waiting', 'Julien Jacobs', '2024-02-03 17:16:34');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `password` text COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(64) COLLATE utf8mb4_bin NOT NULL DEFAULT 'guest',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `tel`, `password`, `type`) VALUES
('k5c8gAYIxL0ucsR2Tkqy2z2UMTZA821jCuBq', 'julien.j.1999@hotmail.com', 'Julien', 'Jacobs', '0470938633', '$2y$14$JmEd2BldzlRBZ/Flj4qYX.3Bxyjog06dqdvat9wCIiWtPYZlmRnD.', 'Developper');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
