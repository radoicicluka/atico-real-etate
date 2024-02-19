-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 01, 2023 at 03:34 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atico_real_estate`
--

CREATE DATABASE IF NOT EXISTS `atico_real_estate` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `atico_real_estate`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `korIme` varchar(20) NOT NULL,
  PRIMARY KEY (`korIme`),
  UNIQUE KEY `korIme_UNIQUE` (`korIme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`korIme`) VALUES
('boraThePro');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `korIme` varchar(20) NOT NULL,
  `aktivan` int DEFAULT NULL,
  `agencija` varchar(100) NOT NULL,
  PRIMARY KEY (`korIme`),
  UNIQUE KEY `korIme_UNIQUE` (`korIme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`korIme`, `aktivan`, `agencija`) VALUES
('dzoni', 1, 'Metropolitan'),
('lukka', 1, 'Lux.com'),
('milos', 1, 'Diamond'),
('nikola', 1, 'Lux.com'),
('pera123', 1, 'Diamond'),
('stefa', 1, 'Kosmopolis'),
('vuk123', 1, 'Metropolitan');

-- --------------------------------------------------------

--
-- Table structure for table `dodatne_specifikacije`
--

DROP TABLE IF EXISTS `dodatne_specifikacije`;
CREATE TABLE IF NOT EXISTS `dodatne_specifikacije` (
  `idS` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idS`),
  UNIQUE KEY `idS_UNIQUE` (`idS`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dodatne_specifikacije`
--

INSERT INTO `dodatne_specifikacije` (`idS`, `naziv`) VALUES
(1, 'Sank'),
(2, 'Kuhinja sa prozorom'),
(3, 'Kupatilo sa prozorm'),
(4, 'Garaza'),
(5, 'Lift'),
(6, 'Podrum'),
(7, 'Obezbedjenje'),
(8, 'Video nadzor'),
(9, 'Interfon'),
(10, 'Bazen'),
(11, 'Dvoriste'),
(12, 'Terasa'),
(13, 'Klima uredjaj'),
(14, 'Podno grejanje'),
(15, 'Opremljen'),
(16, 'Optika');

-- --------------------------------------------------------

--
-- Table structure for table `klijent`
--

DROP TABLE IF EXISTS `klijent`;
CREATE TABLE IF NOT EXISTS `klijent` (
  `korIme` varchar(20) NOT NULL,
  `aktivan` int DEFAULT NULL,
  PRIMARY KEY (`korIme`),
  UNIQUE KEY `korIme_UNIQUE` (`korIme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `klijent`
--

INSERT INTO `klijent` (`korIme`, `aktivan`) VALUES
('dellboy', 1),
('djole', 1),
('familyGuy', 1),
('filip', 1),
('insideno9', 1),
('lec16', 1),
('marcus', 1),
('mrmonaco', 1),
('msc91', 1),
('testtest', 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `korIme` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `lozinka` varchar(16) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(20) NOT NULL,
  PRIMARY KEY (`korIme`),
  UNIQUE KEY `korIme_UNIQUE` (`korIme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korIme`, `email`, `lozinka`, `ime`, `prezime`) VALUES
('boraThePro', 'borabora@gmail.com', 'sifra123', 'Bora', 'Miletic'),
('dellboy', 'derric@gmail.com', 'sifra123', 'Derrick', 'Trotter'),
('djole', 'djole@gmail.com', '123456', 'djole', 'djokovic'),
('dzoni', 'dzoni@gmail.com', 'sifra123', 'Nikola', 'Nikolic'),
('familyGuy', 'peterg@gmail.com', 'sifra123', 'Peter', 'Griffin'),
('filip', 'filip@gmail.com', 'sifra123', 'Filip', 'Filipovic'),
('insideno9', 'reece@gmail.com', 'sifra123', 'Reece', 'Shearsmith'),
('lec16', 'charleslec@gmail.com', 'sifra123', 'Charles', 'Leclerc'),
('lukka', 'luka123@gmail.com', 'sifra123', 'Luka', 'Radoicic'),
('marcus', 'marcus@gmail.com', 'sifra123', 'Marcus', 'Rashford'),
('milos', 'milos@gmail.com', 'sifra123', 'Milos', 'Milosevic'),
('mrmonaco', 'senna@gmail.com', '123456', 'Ayarton', 'Senna'),
('msc91', 'michaels@gmail.com', 'sifra123', 'Michael', 'Shumacher'),
('nikola', 'nikola@gmai.com', 'sifra123', 'Nikola', 'Lazic'),
('pera123', 'pera@gmail.com', 'sifra123', 'Petar', 'Peric'),
('stefa', 'dumictefan@gmail.com', 'sifra123', 'Stefan', 'Dumic'),
('testtest', 'test@gmail.com', 'sifra123', 'Novi', 'Korisnik'),
('vuk123', 'vuk@gmail.com', 'sifra123', 'vuk', 'vukovic');

-- --------------------------------------------------------

--
-- Table structure for table `licitacija`
--

DROP TABLE IF EXISTS `licitacija`;
CREATE TABLE IF NOT EXISTS `licitacija` (
  `idLic` int NOT NULL AUTO_INCREMENT,
  `korImeKlijent` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `idO` int DEFAULT NULL,
  `trenutnaCena` int DEFAULT NULL,
  `vremeKraj` datetime DEFAULT NULL,
  PRIMARY KEY (`idLic`),
  KEY `korImeKlijent_idx` (`korImeKlijent`),
  KEY `idO_idx` (`idO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obavestenje`
--

DROP TABLE IF EXISTS `obavestenje`;
CREATE TABLE IF NOT EXISTS `obavestenje` (
  `idOba` int NOT NULL AUTO_INCREMENT,
  `korIme` varchar(20) DEFAULT NULL,
  `tekst` varchar(100) DEFAULT NULL,
  `datumVreme` datetime DEFAULT NULL,
  PRIMARY KEY (`idOba`),
  UNIQUE KEY `idOba_UNIQUE` (`idOba`),
  KEY `korIme_idx` (`korIme`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `obavestenje`
--

INSERT INTO `obavestenje` (`idOba`, `korIme`, `tekst`) VALUES
(1, 'mrmonaco', 'Odobren nalog.'),
(2, 'msc91', 'Odbijen zahtev za licitaciju.');

-- --------------------------------------------------------

--
-- Table structure for table `oglas`
--

DROP TABLE IF EXISTS `oglas`;
CREATE TABLE IF NOT EXISTS `oglas` (
  `idO` int NOT NULL AUTO_INCREMENT,
  `korImeKlijent` varchar(20) DEFAULT NULL,
  `korImeAgent` varchar(20) DEFAULT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  `opis` varchar(1000) DEFAULT NULL,
  `cena` int DEFAULT NULL,
  `adresa` varchar(100) DEFAULT NULL,
  `brSoba` int DEFAULT NULL,
  `kvadratura` float DEFAULT NULL,
  `opstina` varchar(20) DEFAULT NULL,
  `grejanje` varchar(20) DEFAULT NULL,
  `aktivan` int DEFAULT NULL,
  `prodat` tinyint(1) DEFAULT NULL,
  `grad` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `agencija` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idO`),
  UNIQUE KEY `idO_UNIQUE` (`idO`),
  KEY `korImeAgent_idx` (`korImeAgent`),
  KEY `korImeKlijent_idx` (`korImeKlijent`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `oglas`
--

INSERT INTO `oglas` (`idO`, `korImeKlijent`, `korImeAgent`, `naziv`, `opis`, `cena`, `adresa`, `brSoba`, `kvadratura`, `opstina`, `grejanje`, `aktivan`, `prodat`, `grad`, `agencija`) VALUES
(1, 'mrmonaco', 'nikola', 'Veliki penthaus u srcu grada', 'Petosoban stan u centru grada, sa pogledom na hram Svetog Save u blizini pijace i sportskog centra.', 360000, 'Patrijarha Varnave 22', 5, 124, 'Vračar', 'centralno', 1, 0, 'Beograd', 'Lux.com'),
(2, 'dellboy', 'lukka', 'Garsonjera -  idealno za studente', 'Garsonjera blizu tehničkih fakulteta, idealna za studente ili mlade parove.Skoro renoviran.', 65000, 'Kraljice Marije 15', 1, 28, 'Palilula', 'centralno', 1, 0, 'Beograd', 'Lux.com'),
(3, 'insideno9', 'lukka', 'Atraktivan stan na Olimpu', 'Svetao dvosoban stan u vrlo mirnom kraju savršenom za mlade roditelje sa decom.', 160000, 'Brsjačka 7', 4, 74, 'Zvezdara', 'etažno', 1, 0, 'Beograd', 'Lux.com'),
(4, 'msc91', 'nikola', 'Dupleks - stara Bežanija', 'Dupleks u bloku 61 sa velikom terasom u blizini vrtića i osnovne škole sa dva kupatila. Poslednji sprat sa potkrovljem( pod kosinom ).', 200000, 'Dušana Vukasovića 40b', 5, 105, 'Novi Beograd', 'etažno', 1, 0, 'Beograd', 'Lux.com'),
(5, 'mrmonaco', 'nikola', 'Kuća na Dedinju', 'Kuća koja se sastoji od 4 stana sa velikim dvorištem i montažnim bazenom i garažom. Nalazi se u mirnom kraju dobro povezanom sa centrom grada.', 1050000, 'Generala Save Grujića', 16, 450, 'Savski Venac', 'TA', 1, 0, 'Beograd', 'Lux.com');

-- --------------------------------------------------------

--
-- Table structure for table `omiljeni_oglas`
--

DROP TABLE IF EXISTS `omiljeni_oglas`;
CREATE TABLE IF NOT EXISTS `omiljeni_oglas` (
  `korImeKlijent` varchar(20) NOT NULL,
  `idO` int NOT NULL,
  PRIMARY KEY (`korImeKlijent`,`idO`),
  KEY `idO_idx` (`idO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `omiljeni_oglas`
--

INSERT INTO `omiljeni_oglas` (`korImeKlijent`, `idO`) VALUES
('familyGuy', 1),
('familyGuy', 3),
('mrmonaco', 4),
('msc91', 4);

-- --------------------------------------------------------

--
-- Table structure for table `praceni_oglasi`
--

DROP TABLE IF EXISTS `praceni_oglasi`;
CREATE TABLE IF NOT EXISTS `praceni_oglasi` (
  `korImeKlijent` varchar(20) NOT NULL,
  `idO` int NOT NULL,
  PRIMARY KEY (`korImeKlijent`,`idO`),
  KEY `idO_idx` (`idO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `praceni_oglasi`
--

INSERT INTO `praceni_oglasi` (`korImeKlijent`, `idO`) VALUES
('familyGuy', 1),
('insideno9', 2),
('familyGuy', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sadrzi`
--

DROP TABLE IF EXISTS `sadrzi`;
CREATE TABLE IF NOT EXISTS `sadrzi` (
  `idS` int NOT NULL,
  `idO` int NOT NULL,
  PRIMARY KEY (`idS`,`idO`),
  KEY `idO_idx` (`idO`),
  KEY `idS_idx` (`idS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sadrzi`
--

INSERT INTO `sadrzi` (`idS`, `idO`) VALUES
(1, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(12, 1),
(13, 1),
(16, 1),
(2, 2),
(3, 2),
(5, 2),
(6, 2),
(9, 2),
(13, 2),
(16, 2),
(3, 3),
(4, 3),
(6, 3),
(9, 3),
(11, 3),
(12, 3),
(13, 3),
(16, 3),
(2, 4),
(4, 4),
(5, 4),
(6, 4),
(8, 4),
(9, 4),
(12, 4),
(13, 4),
(15, 4),
(16, 4),
(1, 5),
(2, 5),
(5, 5),
(9, 5),
(13, 5),
(14, 5);

-- --------------------------------------------------------

--
-- Table structure for table `termin`
--

DROP TABLE IF EXISTS `termin`;
CREATE TABLE IF NOT EXISTS `termin` (
  `idTer` int NOT NULL AUTO_INCREMENT,
  `korImeKlijent` varchar(20) DEFAULT NULL,
  `korImeAgent` varchar(20) DEFAULT NULL,
  `datumVreme` datetime DEFAULT NULL,
  `idO` int DEFAULT NULL,
  PRIMARY KEY (`idTer`),
  UNIQUE KEY `idTer_UNIQUE` (`idTer`),
  KEY `korImeKlijent_idx` (`korImeKlijent`),
  KEY `korImeAgent_idx` (`korImeAgent`),
  KEY `idO_idx` (`idO`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `termin`
--

INSERT INTO `termin` (`idTer`, `korImeKlijent`, `korImeAgent`, `datumVreme`, `idO`) VALUES
(1, 'insideno9', 'lukka', '2023-05-25 13:15:00', 2),
(2, 'mrmonaco', 'lukka', '2023-05-25 14:15:00', 2),
(3, 'msc91', 'nikola', '2023-05-25 10:00:00', 1),
(11, NULL, 'lukka', '2023-05-12 13:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zahtev`
--

DROP TABLE IF EXISTS `zahtev`;
CREATE TABLE IF NOT EXISTS `zahtev` (
  `idZah` int NOT NULL AUTO_INCREMENT,
  `tipZahteva` int DEFAULT NULL,
  PRIMARY KEY (`idZah`),
  UNIQUE KEY `idZah_UNIQUE` (`idZah`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zahtev`
--

INSERT INTO `zahtev` (`idZah`, `tipZahteva`) VALUES
(38, 1);

-- --------------------------------------------------------
--
-- Table structure for table `zahtev_za_licitaciju`
--
DROP TABLE IF EXISTS `zahtev_za_licitaciju`;
CREATE TABLE `zahtev_za_licitaciju` (
  `idZah` int(11) DEFAULT NULL,
  `idO` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `cena` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Table structure for table `zahtev_za_oglase`
--

DROP TABLE IF EXISTS `zahtev_za_oglase`;
CREATE TABLE IF NOT EXISTS `zahtev_za_oglase` (
  `idZah` int NOT NULL AUTO_INCREMENT,
  `opis` varchar(1000) DEFAULT NULL,
  `idO` int NOT NULL,
  `cena` int DEFAULT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idZah`),
  KEY `idO_idx` (`idO`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zahtev_za_registraciju`
--

DROP TABLE IF EXISTS `zahtev_za_registraciju`;
CREATE TABLE IF NOT EXISTS `zahtev_za_registraciju` (
  `idZah` int NOT NULL AUTO_INCREMENT,
  `korIme` varchar(20) DEFAULT NULL,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ime` varchar(20) DEFAULT NULL,
  `prezime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idZah`),
  KEY `korIme_idx` (`korIme`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zahtev_za_registraciju`
--

INSERT INTO `zahtev_za_registraciju` (`idZah`, `korIme`, `email`, `ime`, `prezime`) VALUES
(38, 'testtest', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
