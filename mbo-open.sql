-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 mei 2022 om 10:50
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbo-open`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `aanmelding`
--

CREATE TABLE `aanmelding` (
  `spelerId` int(11) NOT NULL,
  `toernooiId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `school`
--

INSERT INTO `school` (`id`, `naam`) VALUES
(0, 'Dummy');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `speler`
--

CREATE TABLE `speler` (
  `id` int(11) NOT NULL,
  `roepnaam` varchar(50) NOT NULL,
  `tussenvoegsels` varchar(50) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `schoolId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `speler`
--

INSERT INTO `speler` (`id`, `roepnaam`, `tussenvoegsels`, `achternaam`, `schoolId`) VALUES
(0, 'Dumma', 'Dumma', 'Dumma', 0),
(3, 'Ali', 'el', 'Maaroufi', 0),
(4, 'hhgh', 'Maaroufi', 'Maaroufi', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `toernooi`
--

CREATE TABLE `toernooi` (
  `id` int(11) NOT NULL,
  `omschrijving` varchar(50) NOT NULL,
  `datum` date NOT NULL,
  `status` int(11) NOT NULL,
  `actieve_ronde` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wedstrijd`
--

CREATE TABLE `wedstrijd` (
  `id` int(11) NOT NULL,
  `toernooiId` int(11) NOT NULL,
  `speler1Id` int(11) NOT NULL,
  `speler2Id` int(11) NOT NULL,
  `score1` int(11) DEFAULT NULL,
  `score2` int(11) DEFAULT NULL,
  `ronde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `aanmelding`
--
ALTER TABLE `aanmelding`
  ADD PRIMARY KEY (`spelerId`,`toernooiId`),
  ADD KEY `toernooiId` (`toernooiId`);

--
-- Indexen voor tabel `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `speler`
--
ALTER TABLE `speler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schoolId` (`schoolId`);

--
-- Indexen voor tabel `toernooi`
--
ALTER TABLE `toernooi`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `wedstrijd`
--
ALTER TABLE `wedstrijd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toernooiId` (`toernooiId`),
  ADD KEY `speler1Id` (`speler1Id`),
  ADD KEY `speler2Id` (`speler2Id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `speler`
--
ALTER TABLE `speler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `toernooi`
--
ALTER TABLE `toernooi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `wedstrijd`
--
ALTER TABLE `wedstrijd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `aanmelding`
--
ALTER TABLE `aanmelding`
  ADD CONSTRAINT `aanmelding_ibfk_1` FOREIGN KEY (`spelerId`) REFERENCES `speler` (`id`),
  ADD CONSTRAINT `aanmelding_ibfk_2` FOREIGN KEY (`toernooiId`) REFERENCES `toernooi` (`id`);

--
-- Beperkingen voor tabel `speler`
--
ALTER TABLE `speler`
  ADD CONSTRAINT `speler_ibfk_1` FOREIGN KEY (`schoolId`) REFERENCES `school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `wedstrijd`
--
ALTER TABLE `wedstrijd`
  ADD CONSTRAINT `wedstrijd_ibfk_1` FOREIGN KEY (`speler1Id`) REFERENCES `speler` (`id`),
  ADD CONSTRAINT `wedstrijd_ibfk_2` FOREIGN KEY (`speler2Id`) REFERENCES `speler` (`id`),
  ADD CONSTRAINT `wedstrijd_ibfk_3` FOREIGN KEY (`toernooiId`) REFERENCES `toernooi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
