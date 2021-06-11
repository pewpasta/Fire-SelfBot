-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 11. Jun 2021 um 20:53
-- Server-Version: 10.3.27-MariaDB-0+deb10u1
-- PHP-Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `auth`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accs`
--

CREATE TABLE `accs` (
  `Username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `hwid` varchar(255) NOT NULL DEFAULT 'nohwid',
  `isAdmin` varchar(255) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `accs`
--

INSERT INTO `accs` (`Username`, `pass`, `hwid`, `isAdmin`) VALUES
('test', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 'B2A84A80-3946-11E0-BF0C-BCAEC565529B', 'false'),

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `keylist`
--

CREATE TABLE `keylist` (
  `keylist` varchar(255) NOT NULL,
  `benutzt` varchar(255) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `keylist`
--

INSERT INTO `keylist` (`keylist`, `benutzt`) VALUES
('FIRE-PJPUF-YWMHZ-QRBKN', 'no'),
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
