-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 30 Mei 2018 om 10:38
-- Serverversie: 5.1.37
-- PHP-Versie: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `remas_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `apparaten`
--

DROP TABLE IF EXISTS `apparaten`;
CREATE TABLE IF NOT EXISTS `apparaten` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(40) NOT NULL,
  `Omschrijving` varchar(200) NOT NULL,
  `Vergoeding` float NOT NULL,
  `GewichtGram` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `apparaten`
--

INSERT INTO `apparaten` (`ID`, `Naam`, `Omschrijving`, `Vergoeding`, `GewichtGram`) VALUES
(1, 'Koffiezetapparaat', 'Koffiezetapparaat inclusief glazen kan', 2.22, 560),
(2, 'Centrifuge', 'Losse centrifuge', 5.56, 25800),
(3, 'Desktop PC', 'Desktop PC zonder beeldscherm', 7.6, 2250),
(4, 'Laptop', 'Laptop zonder voeding', 4.95, 1950),
(6, 'Toetsenbord', 'Los toetsenbord', 1.1, 275);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `innameapparaat`
--

DROP TABLE IF EXISTS `innameapparaat`;
CREATE TABLE IF NOT EXISTS `innameapparaat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `InnameID` int(11) NOT NULL,
  `ApparaatID` int(11) NOT NULL,
  `Ontleed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `InnameID` (`InnameID`),
  KEY `ApparaatID` (`ApparaatID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=226 ;

--
-- Gegevens worden uitgevoerd voor tabel `innameapparaat`
--

INSERT INTO `innameapparaat` (`ID`, `InnameID`, `ApparaatID`, `Ontleed`) VALUES
(132, 65, 3, 1),
(133, 65, 3, 1),
(142, 65, 3, 1),
(143, 65, 2, 1),
(144, 65, 2, 1),
(146, 65, 1, 1),
(147, 53, 4, 1),
(150, 50, 3, 1),
(151, 50, 4, 1),
(152, 48, 3, 1),
(153, 48, 1, 1),
(156, 53, 6, 1),
(157, 54, 2, 1),
(158, 54, 3, 1),
(159, 55, 2, 1),
(160, 56, 1, 1),
(161, 56, 4, 1),
(162, 57, 3, 1),
(163, 57, 4, 1),
(164, 57, 6, 1),
(165, 58, 2, 1),
(166, 58, 3, 1),
(167, 59, 2, 1),
(168, 59, 3, 1),
(171, 61, 2, 1),
(172, 62, 2, 1),
(173, 62, 3, 1),
(174, 63, 2, 1),
(175, 63, 1, 1),
(176, 64, 2, 1),
(177, 64, 2, 1),
(178, 65, 1, 1),
(179, 65, 4, 1),
(180, 66, 2, 1),
(181, 67, 6, 1),
(182, 68, 2, 1),
(183, 69, 2, 1),
(184, 69, 3, 1),
(185, 71, 1, 1),
(186, 71, 4, 1),
(187, 72, 1, 1),
(188, 72, 4, 1),
(189, 74, 4, 1),
(190, 75, 4, 1),
(191, 76, 1, 1),
(192, 76, 1, 1),
(193, 77, 2, 1),
(194, 77, 3, 1),
(195, 78, 2, 1),
(196, 79, 3, 1),
(197, 80, 2, 1),
(198, 80, 3, 1),
(199, 81, 3, 1),
(200, 81, 1, 1),
(201, 82, 1, 1),
(202, 82, 4, 1),
(203, 83, 2, 1),
(204, 83, 3, 1),
(205, 84, 1, 1),
(206, 84, 3, 1),
(207, 85, 2, 1),
(208, 85, 1, 1),
(209, 86, 2, 1),
(210, 87, 4, NULL),
(211, 87, 3, NULL),
(212, 87, 1, NULL),
(215, 89, 2, NULL),
(216, 89, 1, NULL),
(217, 90, 2, 1),
(218, 90, 3, NULL),
(219, 90, 6, NULL),
(220, 91, 6, NULL),
(221, 92, 2, NULL),
(224, 94, 3, NULL),
(225, 94, 1, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `innames`
--

DROP TABLE IF EXISTS `innames`;
CREATE TABLE IF NOT EXISTS `innames` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MedewerkerID` int(11) NOT NULL,
  `Tijdstip` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `MedewerkerID` (`MedewerkerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Gegevens worden uitgevoerd voor tabel `innames`
--

INSERT INTO `innames` (`ID`, `MedewerkerID`, `Tijdstip`) VALUES
(47, 3, '2018-04-25 21:00:00'),
(48, 1, '2018-04-25 23:00:00'),
(50, 5, '2018-04-25 22:00:00'),
(51, 3, '2018-04-25 21:00:00'),
(52, 3, '2018-04-25 01:00:00'),
(53, 5, '2018-03-08 16:57:00'),
(54, 3, '2018-05-08 16:34:00'),
(55, 5, '2018-05-08 16:51:00'),
(56, 5, '2018-05-08 16:51:00'),
(57, 5, '2018-05-08 16:52:00'),
(58, 5, '2018-03-08 16:54:00'),
(59, 5, '2018-05-08 16:57:00'),
(61, 5, '2018-05-08 17:01:00'),
(62, 5, '2018-05-08 17:04:00'),
(63, 5, '2018-03-14 08:00:00'),
(64, 5, '2018-05-14 10:08:00'),
(65, 5, '2018-05-14 10:09:00'),
(66, 5, '2018-05-14 14:24:00'),
(67, 5, '2018-03-14 14:52:00'),
(68, 5, '2018-05-14 15:46:00'),
(69, 5, '2018-05-14 15:50:00'),
(70, 5, '2018-03-14 16:07:00'),
(71, 5, '2018-05-14 16:07:00'),
(72, 5, '2018-05-14 16:07:00'),
(73, 5, '2018-05-14 16:07:00'),
(74, 5, '2018-05-14 16:07:00'),
(75, 5, '2018-05-14 16:07:00'),
(76, 5, '2018-05-14 16:11:00'),
(77, 5, '2018-05-14 16:26:00'),
(78, 5, '2018-05-14 16:27:00'),
(79, 5, '2018-05-14 16:27:00'),
(80, 5, '2018-05-14 20:27:00'),
(81, 5, '2018-05-14 20:49:00'),
(82, 5, '2018-05-14 20:51:00'),
(83, 5, '2018-05-14 20:52:00'),
(84, 5, '2018-05-14 20:55:00'),
(85, 5, '2018-05-14 21:00:00'),
(86, 5, '2018-05-14 21:05:00'),
(87, 5, '2018-05-14 21:07:00'),
(89, 5, '2018-05-14 21:20:00'),
(90, 5, '2018-05-14 22:04:00'),
(91, 5, '2018-05-15 13:00:00'),
(92, 5, '2018-05-24 09:22:00'),
(93, 5, '2018-05-28 09:19:00'),
(94, 5, '2018-05-28 09:38:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerkers`
--

DROP TABLE IF EXISTS `medewerkers`;
CREATE TABLE IF NOT EXISTS `medewerkers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `RolID` int(11) NOT NULL,
  `Naam` varchar(40) NOT NULL,
  `Wachtwoord` varchar(100) NOT NULL,
  `Emailadres` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Naam` (`Naam`,`Wachtwoord`),
  KEY `RolID` (`RolID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `medewerkers`
--

INSERT INTO `medewerkers` (`ID`, `RolID`, `Naam`, `Wachtwoord`, `Emailadres`) VALUES
(1, 2, 'Koos', 'koos_daniels', 'koosdaniels@outlook.com'),
(2, 5, 'Koos', 'daniels_koos', 'koosdaniels@outlook.com'),
(3, 1, 'Dik', 'dik_vandalen', 'dikvandalen@itmkb.nl'),
(4, 5, 'Dik', 'vandalen_dik', 'dikvandalen@itmkb.nl'),
(5, 5, 'd', 'd', 'd'),
(6, 1, 'k', 'k', 'k@k.nl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `onderdeelapparaat`
--

DROP TABLE IF EXISTS `onderdeelapparaat`;
CREATE TABLE IF NOT EXISTS `onderdeelapparaat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OnderdeelID` int(11) NOT NULL,
  `ApparaatID` int(11) NOT NULL,
  `Percentage` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `OnderdeelID` (`OnderdeelID`),
  KEY `ApparaatID` (`ApparaatID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Gegevens worden uitgevoerd voor tabel `onderdeelapparaat`
--

INSERT INTO `onderdeelapparaat` (`ID`, `OnderdeelID`, `ApparaatID`, `Percentage`) VALUES
(1, 5, 1, 77),
(2, 6, 2, 45),
(3, 6, 1, 11),
(7, 7, 3, 20),
(8, 6, 3, 15),
(9, 8, 3, 40),
(10, 7, 3, 20),
(11, 6, 3, 15),
(12, 8, 3, 40),
(13, 10, 3, 15),
(14, 11, 4, 15),
(15, 6, 4, 15),
(16, 7, 4, 55),
(18, 7, 6, 5),
(19, 11, 6, 15),
(20, 6, 6, 5),
(21, 8, 4, 15),
(22, 10, 2, 20);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `onderdelen`
--

DROP TABLE IF EXISTS `onderdelen`;
CREATE TABLE IF NOT EXISTS `onderdelen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(40) NOT NULL,
  `Omschrijving` varchar(100) NOT NULL,
  `PrijsPerKg` float NOT NULL,
  `VoorraadKg` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `onderdelen`
--

INSERT INTO `onderdelen` (`ID`, `Naam`, `Omschrijving`, `PrijsPerKg`, `VoorraadKg`) VALUES
(5, 'Glas', 'Glazen onderdelen zoals kannen, ruitjes', 0.67, 10.594),
(6, 'Snoeren', 'Snoeren met stekker, koperen bedrading en koperen plaatmateriaal', 25.31, 512.257),
(7, 'Printplaat', 'Inclusief kleine componenten, zonder ventilator, koeling, voeding, stekkers', 21.15, 467.35),
(8, 'Behuizing algemeen', 'Ijzer, aluminium, plaatstaal.', 2.5, 137.686),
(9, 'Hout', 'Houten behuizing', 0.01, 32.25),
(10, 'Electromotoren', 'Zowel zwakstroom als 220/380 volt', 7.89, 456.78),
(11, 'Plastic onderdelen', 'Hard plastic', 0.12, 0),
(12, 'Kunststof isolatiemateriaal', 'Piepschuim, Schuimrubber', 0.05, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rollen`
--

DROP TABLE IF EXISTS `rollen`;
CREATE TABLE IF NOT EXISTS `rollen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(20) NOT NULL,
  `Omschrijving` varchar(200) DEFAULT NULL,
  `Waarde` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `rollen`
--

INSERT INTO `rollen` (`ID`, `Naam`, `Omschrijving`, `Waarde`) VALUES
(1, 'Algemeen', 'Algemene medewerker', 4),
(2, 'Inname', 'Medewerker Inname', 36),
(3, 'Verwerking', 'Medewerker verwerking', 48),
(4, 'Beheer', 'Applicatie beheerder', 62),
(5, 'Admin', 'Aministrator', 63),
(7, 'Uitgifte', 'Medewerker uitgifte', 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `uitgiftes`
--

DROP TABLE IF EXISTS `uitgiftes`;
CREATE TABLE IF NOT EXISTS `uitgiftes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MedewerkerID` int(11) NOT NULL,
  `OnderdeelID` int(11) NOT NULL,
  `Tijdstip` datetime NOT NULL,
  `GewichtKg` int(11) NOT NULL,
  `Prijs` float DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `OnderdeelID` (`OnderdeelID`),
  KEY `MedewerkerID` (`MedewerkerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Gegevens worden uitgevoerd voor tabel `uitgiftes`
--


--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `innameapparaat`
--
ALTER TABLE `innameapparaat`
  ADD CONSTRAINT `innameapparaat_ibfk_1` FOREIGN KEY (`ApparaatID`) REFERENCES `apparaten` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `innameapparaat_ibfk_2` FOREIGN KEY (`InnameID`) REFERENCES `innames` (`ID`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `innames`
--
ALTER TABLE `innames`
  ADD CONSTRAINT `innames_ibfk_1` FOREIGN KEY (`MedewerkerID`) REFERENCES `medewerkers` (`ID`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  ADD CONSTRAINT `medewerkers_ibfk_1` FOREIGN KEY (`RolID`) REFERENCES `rollen` (`ID`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `onderdeelapparaat`
--
ALTER TABLE `onderdeelapparaat`
  ADD CONSTRAINT `onderdeelapparaat_ibfk_1` FOREIGN KEY (`OnderdeelID`) REFERENCES `onderdelen` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `onderdeelapparaat_ibfk_2` FOREIGN KEY (`ApparaatID`) REFERENCES `apparaten` (`ID`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `uitgiftes`
--
ALTER TABLE `uitgiftes`
  ADD CONSTRAINT `uitgiftes_ibfk_1` FOREIGN KEY (`OnderdeelID`) REFERENCES `onderdelen` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `uitgiftes_ibfk_2` FOREIGN KEY (`MedewerkerID`) REFERENCES `medewerkers` (`ID`) ON DELETE CASCADE;