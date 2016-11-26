-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2016 at 10:27 PM
-- Server version: 5.6.33
-- PHP Version: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xdudla00`
--

-- --------------------------------------------------------

--
-- Table structure for table `bochniky`
--

CREATE TABLE IF NOT EXISTS `bochniky` (
  `id_bochnika` int(11) NOT NULL AUTO_INCREMENT,
  `poc_hmot` decimal(5,2) NOT NULL,
  `akt_hmot` decimal(5,2) NOT NULL,
  `tuk` decimal(3,0) NOT NULL,
  `trvanlivost` date NOT NULL,
  `umiestnenie` varchar(8) NOT NULL,
  `id_syr` int(11) NOT NULL,
  `krajina` char(2) NOT NULL,
  `id_obj` int(11) NOT NULL,
  PRIMARY KEY (`id_bochnika`),
  KEY `fk_boch_syr` (`id_syr`),
  KEY `fk_boch_kraj` (`krajina`),
  KEY `id_obj` (`id_obj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `bochniky`
--

INSERT INTO `bochniky` (`id_bochnika`, `poc_hmot`, `akt_hmot`, `tuk`, `trvanlivost`, `umiestnenie`, `id_syr`, `krajina`, `id_obj`) VALUES
(1, 906.25, 145.78, 40, '2017-10-10', 'sklad', 8, 'IT', 1),
(2, 25.00, 1.22, 50, '2016-05-03', 'predajna', 1, 'SK', 2),
(3, 80.25, 5.80, 50, '2016-05-01', 'predajna', 4, 'SK', 4),
(4, 26.20, 1.98, 50, '2017-05-01', 'predajna', 10, 'FR', 3),
(5, 27.50, 20.00, 50, '2016-12-10', 'predajna', 5, 'GB', 5),
(8, 5.00, 5.00, 5, '2016-11-30', 'sklad', 1, 'NL', 10),
(9, 5.00, 5.00, 5, '2016-11-30', 'sklad', 6, 'SK', 10),
(10, 9.00, 9.00, 9, '2016-11-06', 'predajna', 1, 'SK', 11),
(11, 9.00, 9.00, 9, '2016-11-06', 'predajna', 2, 'CZ', 11),
(12, 9.00, 9.00, 9, '2016-11-06', 'predajna', 9, 'DE', 11),
(13, 99.00, 99.00, 99, '2016-11-10', 'sklad', 1, 'CZ', 12),
(14, 99.00, 99.00, 99, '2016-11-11', 'sklad', 6, 'SK', 12),
(15, 10.00, 10.00, 49, '2016-11-30', 'predajna', 1, 'SK', 13),
(16, 10.00, 10.00, 49, '2016-11-30', 'predajna', 6, 'NL', 13),
(17, 100.00, 100.00, 50, '2016-11-24', 'sklad', 1, 'FR', 14),
(18, 100.00, 100.00, 50, '2016-11-20', 'sklad', 6, 'SK', 14),
(19, 8.00, 8.00, 28, '2016-11-11', 'predajna', 2, 'NL', 15),
(20, 8.00, 8.00, 38, '2016-11-30', 'predajna', 6, 'SK', 15),
(21, 8.00, 8.00, 28, '2016-11-11', 'predajna', 2, 'NL', 16),
(22, 8.00, 8.00, 38, '2016-11-30', 'predajna', 6, 'SK', 16),
(23, 8.00, 8.00, 28, '2016-11-11', 'predajna', 2, 'NL', 17),
(24, 8.00, 8.00, 38, '2016-11-30', 'predajna', 6, 'SK', 17),
(25, 8.00, 8.00, 28, '2016-11-11', 'predajna', 2, 'NL', 18),
(26, 8.00, 8.00, 38, '2016-11-30', 'predajna', 6, 'SK', 18),
(27, 8.00, 8.00, 28, '2016-11-11', 'predajna', 2, 'NL', 19),
(28, 8.00, 8.00, 38, '2016-11-30', 'predajna', 6, 'SK', 19),
(29, 5.00, 5.00, 5, '2019-01-13', 'predajna', 2, 'SK', 20),
(30, 5.00, 5.00, 5, '2013-08-09', 'predajna', 6, 'SK', 20),
(31, 4.00, 4.00, 4, '2019-01-13', 'predajna', 6, 'SK', 21),
(32, 9.00, 9.00, 9, '2019-01-13', 'predajna', 6, 'SK', 22),
(33, 30.00, 30.00, 29, '2017-03-17', 'sklad', 2, 'CZ', 23),
(34, 52.00, 52.00, 40, '2017-04-26', 'sklad', 1, 'SK', 24),
(35, 89.00, 89.00, 50, '2020-11-30', 'sklad', 9, 'SK', 24),
(36, 80.00, 80.00, 25, '2020-11-19', 'sklad', 4, 'SK', 25),
(37, 50.00, 50.00, 45, '2017-02-09', 'sklad', 14, 'SK', 25);

--
-- Triggers `bochniky`
--
DROP TRIGGER IF EXISTS `cisla_check`;
DELIMITER //
CREATE TRIGGER `cisla_check` BEFORE INSERT ON `bochniky`
 FOR EACH ROW BEGIN
    IF NEW.tuk < 0 THEN
        SET NEW.tuk = 0;
    ELSEIF NEW.tuk > 100 THEN
        SET NEW.tuk = 100;
    END IF;
    IF NEW.akt_hmot > NEW.poc_hmot THEN
        SET NEW.akt_hmot = NEW.poc_hmot;
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dodavatelia`
--

CREATE TABLE IF NOT EXISTS `dodavatelia` (
  `id_dod` int(11) NOT NULL AUTO_INCREMENT,
  `nazov` varchar(30) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `cislo` int(11) NOT NULL,
  `mesto` varchar(30) NOT NULL,
  `psc` char(5) NOT NULL,
  `typ` char(2) NOT NULL,
  `r_cislo` varchar(11) DEFAULT NULL,
  `meno` varchar(20) DEFAULT NULL,
  `priezvisko` varchar(20) DEFAULT NULL,
  `ico` varchar(8) DEFAULT NULL,
  `dic` char(10) DEFAULT NULL,
  `ic_dph` char(12) DEFAULT NULL,
  PRIMARY KEY (`id_dod`),
  UNIQUE KEY `nazov` (`nazov`),
  UNIQUE KEY `ic_dph` (`ic_dph`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dodavatelia`
--

INSERT INTO `dodavatelia` (`id_dod`, `nazov`, `ulica`, `cislo`, `mesto`, `psc`, `typ`, `r_cislo`, `meno`, `priezvisko`, `ico`, `dic`, `ic_dph`) VALUES
(1, 'Karička a.s.', 'Prášilova', 1, 'Bratislava', '84105', 'PO', NULL, NULL, NULL, '12345678', '0123456789', 'SK123465789'),
(2, 'Veselá Krava a.s.', 'Májová', 87, 'Žilina', '54005', 'PO', NULL, NULL, NULL, '12345677', '012345688', 'SK123465788'),
(3, 'Olomoucké tvarůžky', 'Náměstí Míru', 11, 'Loštice', '78983', 'PO', NULL, NULL, NULL, '12345677', '1123456789', 'CZ123465789'),
(4, 'Juraj Jánošík', 'Na háku', 4, 'Lesík', '99998', 'FO', '223465/789', 'Juraj', 'Jánošík', NULL, NULL, NULL),
(5, 'Arnold Schwarzenegger', 'Dolziger', 9, 'Berlin', '10101', 'FO', '993465/189', 'Arnold', 'Schwarzenegger', NULL, NULL, NULL),
(6, 'Star', 'Cejl', 9, 'Brno', '61200', 'PO', NULL, NULL, NULL, '99880681', '987456823', 'CZ914987654'),
(7, 'Varsyrs', 'Fish', 8, 'Rome', '54978', 'PO', NULL, NULL, NULL, '90181681', '987456823', 'IT914987654'),
(8, 'Cheesex', 'Page', 79, 'London', '98799', 'PO', NULL, NULL, NULL, '99182981', '987456823', 'GB914987654'),
(9, 'Cheese', 'Baguette', 27, 'Paris', '98999', 'PO', NULL, NULL, NULL, '99183681', '987456823', 'FR914987654'),
(10, 'Kotuč s.r.o.', 'Dolna', 90, 'Ražňany', '51469', 'PO', NULL, NULL, NULL, '09184681', '987456123', 'SK014987654');

--
-- Triggers `dodavatelia`
--
DROP TRIGGER IF EXISTS `zmaz_ponuky`;
DELIMITER //
CREATE TRIGGER `zmaz_ponuky` AFTER DELETE ON `dodavatelia`
 FOR EACH ROW BEGIN
    DELETE FROM ponukaju WHERE ponukaju.id_dod = old.id_dod;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `krajiny`
--

CREATE TABLE IF NOT EXISTS `krajiny` (
  `skratka` char(2) NOT NULL,
  `nazov` varchar(20) NOT NULL,
  `info` varchar(255) NOT NULL,
  PRIMARY KEY (`skratka`),
  UNIQUE KEY `nazov` (`nazov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `krajiny`
--

INSERT INTO `krajiny` (`skratka`, `nazov`, `info`) VALUES
('CZ', 'Česká Republika', 'Chodia často do Tatier'),
('DE', 'Nemecko', 'Hlavne mesto Berlin'),
('FR', 'Francúzsko', 'Super Bagety'),
('GB', 'Anglicko', 'Opacni ludia'),
('IT', 'Taliansko', 'Super PIZZA'),
('NL', 'Holandsko', '420'),
('SK', 'Slovensko', 'Krajina z pod Tatier');

-- --------------------------------------------------------

--
-- Table structure for table `objednavky`
--

CREATE TABLE IF NOT EXISTS `objednavky` (
  `id_obj` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `suma` decimal(19,4) NOT NULL,
  `r_cislo` varchar(11) NOT NULL,
  `id_dod` int(11) NOT NULL,
  PRIMARY KEY (`id_obj`),
  KEY `fk_obj_zam` (`r_cislo`),
  KEY `fk_obj_dod` (`id_dod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `objednavky`
--

INSERT INTO `objednavky` (`id_obj`, `datum`, `suma`, `r_cislo`, `id_dod`) VALUES
(1, '2016-01-10', 10754.7800, '950217/9720', 7),
(2, '2016-03-14', 924.5000, '950217/9775', 2),
(3, '2016-03-04', 1278.9900, '530919/907', 4),
(4, '2016-02-24', 704.0000, '950217/9720', 6),
(5, '2015-12-12', 284.7700, '950217/9775', 8),
(10, '2016-11-06', 10.0000, '123456/1234', 1),
(11, '2016-11-06', 999.0000, '123456/1234', 1),
(12, '2016-11-06', 9999.0000, '123456/1234', 2),
(13, '2016-11-06', 100.0000, '123456/1234', 2),
(14, '2016-11-06', 1000.0000, '123456/1234', 1),
(15, '2016-11-11', 100.0000, '530919/907', 1),
(16, '2016-11-11', 100.0000, '530919/907', 1),
(17, '2016-11-11', 100.0000, '530919/907', 1),
(18, '2016-11-11', 100.0000, '530919/907', 1),
(19, '2016-11-11', 100.0000, '530919/907', 1),
(20, '2016-11-12', 5.0000, '530919/907', 1),
(21, '2019-01-13', 9.0000, '530919/907', 1),
(22, '2019-01-13', 2000.0000, '530919/907', 1),
(23, '2016-11-26', 159.0000, '950217/9742', 3),
(24, '2016-11-26', 1237.1000, '950217/9742', 10),
(25, '2016-11-26', 802.0000, '950217/9742', 4);

--
-- Triggers `objednavky`
--
DROP TRIGGER IF EXISTS `triggerOBJ`;
DELIMITER //
CREATE TRIGGER `triggerOBJ` BEFORE INSERT ON `objednavky`
 FOR EACH ROW BEGIN
    IF NEW.r_cislo NOT IN (SELECT r_cislo FROM zamestnanci WHERE NEW.r_cislo = zamestnanci.r_cislo) THEN
        CALL `Zamestnanec s takymto rodnym cislom neexistuje!`;
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ponukaju`
--

CREATE TABLE IF NOT EXISTS `ponukaju` (
  `id_dod` int(11) NOT NULL,
  `id_syr` int(11) NOT NULL,
  `cena_za_kg` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_dod`,`id_syr`),
  KEY `fk_pon_syr` (`id_syr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ponukaju`
--

INSERT INTO `ponukaju` (`id_dod`, `id_syr`, `cena_za_kg`) VALUES
(1, 1, 3.50),
(1, 2, 3.90),
(1, 6, 2.80),
(1, 9, 5.20),
(2, 1, 2.80),
(2, 6, 6.30),
(3, 2, 5.30),
(4, 4, 4.40),
(4, 14, 9.00),
(5, 3, 3.50),
(6, 10, 6.50),
(7, 8, 4.60),
(7, 11, 3.80),
(8, 5, 5.20),
(9, 5, 4.20),
(10, 1, 8.90),
(10, 9, 8.70);

-- --------------------------------------------------------

--
-- Table structure for table `syry`
--

CREATE TABLE IF NOT EXISTS `syry` (
  `id_syr` int(11) NOT NULL AUTO_INCREMENT,
  `nazov` varchar(30) NOT NULL,
  `typ` varchar(20) NOT NULL,
  `zivocich` varchar(20) NOT NULL,
  PRIMARY KEY (`id_syr`),
  UNIQUE KEY `nazov` (`nazov`,`typ`,`zivocich`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `syry`
--

INSERT INTO `syry` (`id_syr`, `nazov`, `typ`, `zivocich`) VALUES
(3, 'Brie', 'plesnivý', 'krava'),
(4, 'Bryndza', 'hrudkový', 'ovca'),
(10, 'Camembert', 'mäkký', 'krava'),
(5, 'Čedar', 'lisovaný', 'krava'),
(14, 'Eidam', 'polotvrdý', 'krava'),
(6, 'Eidam', 'tvrdý', 'krava'),
(7, 'Ementál', 'polotvrdý', 'krava'),
(2, 'Encian', 'plesnivý', 'krava'),
(9, 'Gouda', 'polotvrdý', 'krava'),
(11, 'Mozzarella', 'mäkký', 'krava'),
(1, 'Niva', 'plesnivý', 'krava'),
(8, 'Parmezán', 'lisovaný', 'krava');

-- --------------------------------------------------------

--
-- Table structure for table `zamestnanci`
--

CREATE TABLE IF NOT EXISTS `zamestnanci` (
  `r_cislo` varchar(11) NOT NULL,
  `login` varchar(32) DEFAULT NULL,
  `pass` varchar(32) NOT NULL,
  `meno` varchar(20) NOT NULL,
  `priezvisko` varchar(20) NOT NULL,
  `ulica` varchar(30) DEFAULT 'Kolejní',
  `cislo` int(11) DEFAULT '2',
  `mesto` varchar(30) DEFAULT 'Brno',
  `psc` char(5) DEFAULT '61200',
  `plat` int(11) NOT NULL DEFAULT '333',
  `veduci` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`r_cislo`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zamestnanci`
--

INSERT INTO `zamestnanci` (`r_cislo`, `login`, `pass`, `meno`, `priezvisko`, `ulica`, `cislo`, `mesto`, `psc`, `plat`, `veduci`) VALUES
('530919/907', 'admin', 'nimda', 'Peter', 'Sveter', 'Rododendron', 2, 'Brno', '61200', 2599, ''),
('880808/9885', 'miro', 'aaa', 'Miroslav', 'Sud', 'Hujíčkova', 87, 'Brno', '61200', 12, '\0'),
('921210/9720', 'peto', 'aaa', 'Peter', 'Klobása', 'Staňkova', 2, 'Brno', '60200', 8, '\0'),
('950217/9742', 'tiboris', 'g', 'Tibor', 'Dudlák', 'Kolejni', 9, 'Brno', '99999', 456, '');

--
-- Triggers `zamestnanci`
--
DROP TRIGGER IF EXISTS `triggerRC`;
DELIMITER //
CREATE TRIGGER `triggerRC` BEFORE INSERT ON `zamestnanci`
 FOR EACH ROW BEGIN
    DECLARE RC varchar(11);
    DECLARE TMP int;
    DECLARE MESIAC int;
    DECLARE DAT date;
    SET RC = NEW.r_cislo;
    SET MESIAC = CAST(SUBSTR(RC, 3, 2)AS UNSIGNED);
    SET TMP = CAST(SUBSTR(RC, 1, 6) AS UNSIGNED);
    IF (MESIAC > 12) THEN
        SET TMP = TMP - 5000;
    END IF;
    SET DAT = STR_TO_DATE( TMP , 'YYMMDD');
END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
