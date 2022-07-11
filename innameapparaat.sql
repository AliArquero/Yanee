-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 jul 2022 om 10:03
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greendb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `innameapparaat`
--

CREATE TABLE `innameapparaat` (
  `ID` int(11) NOT NULL,
  `InnameID` int(11) NOT NULL,
  `ApparaatID` int(11) NOT NULL,
  `Ontleed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `innameapparaat`
--
ALTER TABLE `innameapparaat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `InnameID` (`InnameID`),
  ADD KEY `ApparatenID` (`ApparaatID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `innameapparaat`
--
ALTER TABLE `innameapparaat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `innameapparaat`
--
ALTER TABLE `innameapparaat`
  ADD CONSTRAINT `ApparatenID` FOREIGN KEY (`ApparaatID`) REFERENCES `apparaten` (`ID`),
  ADD CONSTRAINT `InnameID` FOREIGN KEY (`InnameID`) REFERENCES `innameapparaat` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
