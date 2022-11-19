-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Nov 2022 um 10:15
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be17_cr5_animal_adoption_markoschoretits`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `plz` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `address`
--

INSERT INTO `address` (`id`, `street`, `plz`, `city`) VALUES
(1, 'Alszeile 1', 1111, 'Alsdorf'),
(2, 'Alszeile 2', 2222, 'Braunsdorf'),
(3, 'Alszeile 3', 3333, 'Cerndorf'),
(4, 'Alszeile 4', 4444, 'Dammdorf'),
(5, 'Alszeile 5', 5555, 'Elsdorf'),
(6, 'Alszeile 6', 6666, 'Freistadt'),
(7, 'Alszeile 7', 7777, 'Gamsdorf'),
(8, 'Alszeile 8', 8888, 'Horndorf'),
(9, 'Alszeile 9', 9999, 'Innsteg'),
(10, 'Alszeile 10', 1010, 'Jahndorf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adoptions`
--

CREATE TABLE `adoptions` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fk_address_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` enum('small','BIG') NOT NULL,
  `age` int(11) NOT NULL,
  `vaccines` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` enum('adopted','available') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`id`, `name`, `fk_address_id`, `description`, `size`, `age`, `vaccines`, `breed`, `picture`, `status`) VALUES
(1, 'Achmed', 1, 'only one hump', 'BIG', 11, 'none', 'Camel/Dromedar', 'Animal-960x640.png', 'available'),
(2, 'Bernie', 2, 'Bisons are not Bulls', 'BIG', 8, 'Worms', 'Bison', 'Bison-1a.jpg', 'available'),
(3, 'Claudia', 3, 'hunts for roadrunners', 'BIG', 7, 'none', 'Coyote', 'Coyote-animal-sentience-research.jpg', 'available'),
(4, 'Dave', 4, 'They all belong to China', 'BIG', 5, 'SARS Cov 2', 'Panda', 'Giant_Panda_2004-03-2.jpg', 'available'),
(5, 'Ernie', 5, 'Don´t call me Porcupine!', 'small', 2, 'none', 'Hedgehog', 'hedgehog.jpg', 'available'),
(6, 'Frida', 6, 'My chess openings are very solid', 'BIG', 17, 'Malaria', 'Hippo', 'idn1221teres_graphic_01_web.jpg', 'available'),
(7, 'Gustav', 7, 'I was the Model for Pierre Lang´s famous Ring', 'small', 4, 'chicken pocks', 'Tucan', 'K1-habitat-back.jpg', 'available'),
(8, 'Henriette', 8, 'I´m a vixen, you know ;-)', 'BIG', 9, 'Worms', 'Fox', 'ms-animals-habitats-mammals.jpg', 'available'),
(9, 'Ingo', 9, 'I suffer from Zebra Paradox: black stripes on orange, or the other way round', 'BIG', 12, 'Worms', 'Tiger', 'tiger_laying_hero_background.jpg', 'available'),
(10, 'Jenna', 10, 'Cuter than a Coon', 'small', 3, 'none', 'Red Panda', 'wild_and_wonderful_asian_animals_header_1140.jpg', 'available'),
(11, 'Karlie', 10, 'Red Pandas may be cute ... but I am the original.', 'small', 2, 'none', 'Raccoon', 'Mammals-Raccoon.jpg', 'available'),
(12, 'Dudu', 10, 'Duuuza zabica', 'BIG', 1, 'all of them', 'Komodo Dragon', '6377c3d1b74c0.jpg', 'adopted'),
(13, 'Bärli', 10, 'mrrrummm', 'small', 39, 'all of them', 'Bear', '6377c5e640164.jpg', 'adopted'),
(16, 'Hamsti', 10, 'The lockdown made me who I am', 'small', 48, 'all of them', 'Hamster', '6377df582c51a.jpg', 'adopted');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fk_address_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `password`, `fk_address_id`, `email`, `picture`, `status`) VALUES
(2, 'Marko', 'Schore', '+1-555-1234', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 10, 'm@s.com', 'avatar.png', 'adm'),
(3, 'Second', 'Two', '+111-555-1234', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 3, '2@s.com', '6377a4092305a.jpg', 'user'),
(6, 'Fiver', 'Fifth', '+9317467tzou', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 4, 'f@s.com', '637899412175b.jpg', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`);

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_address_id` (`fk_address_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_address_id` (`fk_address_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `adoptions_ibfk_2` FOREIGN KEY (`fk_animal_id`) REFERENCES `animals` (`id`);

--
-- Constraints der Tabelle `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`fk_address_id`) REFERENCES `address` (`id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_address_id`) REFERENCES `address` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
