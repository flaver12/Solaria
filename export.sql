-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Mai 2017 um 12:28
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `farming_manager`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` varchar(45) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`, `created`, `enabled`) VALUES
(1, 'Schwarzes Brett', '2017-04-29 23:57:31', NULL),
(2, 'ArmA', '2017-04-29 23:59:02', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cronjobs`
--

CREATE TABLE `cronjobs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `priority` int(10) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `cronjobs`
--

INSERT INTO `cronjobs` (`id`, `name`, `priority`) VALUES
(1, 'TestCronjob', 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'read'),
(2, 'write'),
(3, 'edit'),
(4, 'delete');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL COMMENT 'This id is set, when it is a response to a post',
  `title` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `post`
--

INSERT INTO `post` (`id`, `topic_id`, `user_id`, `post_id`, `title`, `content`, `created`, `enabled`) VALUES
(2, 4, 4, NULL, 'BBCode Test', 'So das nÃ¤chste kleine flaver and friends Event steht an.\r\nWie immer seid ihr alle dazu eingeladen.\r\n\r\n[b]Wann[/b]\r\n12 Mai\r\n1700 SQL\'s und PL Briefing\r\n1915 Sloten\r\n1930 Missionsstart\r\n[b]11 Mai Techcheck ab 1800[/b]\r\n\r\n[b]Wo[/b]\r\nServer-Ip: N/A\r\nRepo-Link: N/A\r\nTS3: N/A\r\n\r\nSlotliste\r\n01 Platoonleader\r\n02 RTO [color=#FF8C00]flaver[/color]\r\n\r\n03 SQL[color=#FF8C00] Assa[/color]\r\n04 Medic\r\n05 RTO\r\n\r\n06 FTL\r\n07 MG [color=#FF8C00]Zero[/color]\r\n08 MG-Assist\r\n09 Rifleman\r\n\r\n10 FTL [color=#FF8C00][40LK][/color]\r\n11 MG [color=#FF8C00][40LK] Trueffel[/color]\r\n12 MG-Assist[color=#FF8C00][40LK][/color]\r\n13 Rifleman [color=#FF8C00][40LK]\r\n[/color]\r\n14 SQL [color=#FF8C00][1st CAT][/color]\r\n15 Medic [color=#FF8C00][1st CAT][/color]\r\n16 RTO [color=#FF8C00][1st CAT][/color]\r\n\r\n17 FTL [color=#FF8C00][1st CAT][/color]\r\n18 MG [color=#FF8C00][1st CAT][/color]\r\n19 MG-Assist [color=#FF8C00][1st CAT][/color]\r\n20 Rifleman [color=#FF8C00][1st CAT][/color]\r\n\r\n21FTL [color=#FF8C00][1st CAT][/color]\r\n22MG [color=#FF8C00][1st CAT][/color]\r\n23MG-Assist [color=#FF8C00][1st CAT][/color]\r\n24Rifleman [color=#FF8C00][1st CAT][/color]\r\n\r\n25 SQL\r\n26 Medic\r\n27 RTO\r\n\r\n28 Heavy-MG\r\n29 Heavy-MG-Assist\r\n\r\n30 Mortar\r\n31 Mortar\r\n\r\n32 Pilot\r\n33 Pilot\r\n\r\nWeitere Infos sind hier zu finden: [url]http://ni39748_1.vweb06.nitrado.net/[/url]', '2017-04-30 00:08:32', 1),
(3, 4, 1, 2, 'NOT IMPLEMENTED-Response', 'Eine kleine test Antwort', '2017-05-08 08:58:00', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `resource`
--

CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `resource`
--

INSERT INTO `resource` (`id`, `name`) VALUES
(1, 'IndexController.indexAction.*'),
(2, 'ForumController.indexAction.*'),
(3, 'AdminController.*.*'),
(4, 'SessionController.*.*');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `resource_role`
--

CREATE TABLE `resource_role` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `resource_role`
--

INSERT INTO `resource_role` (`id`, `resource_id`, `role_id`) VALUES
(2, 1, 6),
(3, 2, 6),
(4, 3, 1),
(5, 4, 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `extend_id` int(11) NOT NULL COMMENT 'If this id is set it means that this role extends from a other group'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`id`, `name`, `extend_id`) VALUES
(1, 'Admin', 2),
(2, 'Moderator', 5),
(5, 'Member', 6),
(6, 'Guest', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `topic`
--

INSERT INTO `topic` (`id`, `category_id`, `name`, `enabled`, `created`) VALUES
(1, 1, 'Allgemeine Nachrichten', NULL, '2017-04-29 23:58:11'),
(2, 1, 'Interne Nachrichten', NULL, '2017-04-29 23:58:40'),
(3, 2, 'MissionsankÃ¼ndigung', NULL, '2017-04-29 23:59:19'),
(4, 2, 'Missionsbau', NULL, '2017-04-30 00:02:02');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'flaver', '3da541559918a808c2402bba5012f6c60b27661c'),
(2, 'mod', '3da541559918a808c2402bba5012f6c60b27661c'),
(4, 'member ', '3da541559918a808c2402bba5012f6c60b27661c');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(6, 2, 2),
(9, 4, 5);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cronjobs`
--
ALTER TABLE `cronjobs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `resource_role`
--
ALTER TABLE `resource_role`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `cronjobs`
--
ALTER TABLE `cronjobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `resource_role`
--
ALTER TABLE `resource_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
