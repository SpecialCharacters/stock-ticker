-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2016 at 06:51 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockticker`
--

DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `stockmovements`;
DROP TABLE IF EXISTS `playerstocks`;
DROP TABLE IF EXISTS `stocks`;
DROP TABLE IF EXISTS `players`;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
    `username` varchar(30) NOT NULL,
    `firstname` varchar(30) NOT NULL,
    `lastname` varchar(30) NOT NULL,
    `password` varchar(30) NOT NULL,
    `cash` int(10) NOT NULL,
	`role` varchar(10) NOT NULL,
    PRIMARY KEY(`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`username`, `firstname`, `lastname`, `password`, `cash`, `role`) VALUES
('admin', 'Jim', 'Parry', 'jlparry', 1000000, 'admin'),
('mick123','Mickey','Jaggar', 'sarauer', 1000, 'user'),
('don123','Donald', 'Trumper', '12345', 3000, 'user'),
('geo123','George','Bushy', 'testpass', 2000, 'user'),
('hen123','Henry','Thirdy', 'password', 2500, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
    `code` varchar(4) DEFAULT NULL,
    `stockname` varchar(10) DEFAULT NULL,
    `category` varchar(1) DEFAULT NULL,
    `stockvalue` int(3) DEFAULT NULL,
    PRIMARY KEY(code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`code`, `stockname`, `category`, `stockvalue`) VALUES
('BOND', 'Bonds', 'B', 66),
('GOLD', 'Gold', 'B', 110),
('GRAN', 'Grain', 'B', 113),
('IND', 'Industrial', 'B', 39),
('OIL', 'Oil', 'B', 52),
('TECH', 'Tech', 'B', 37);

-- --------------------------------------------------------

--
-- Table structure for table `playerstocks`
--

CREATE TABLE IF NOT EXISTS `playerstocks` (
    `username` varchar(30) NOT NULL,
    `code` varchar(4) NOT NULL,
    `amount` int(7) NOT NULL,
    PRIMARY KEY(`username`, `code`),
    FOREIGN KEY (`username`)
		REFERENCES players(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`code`)
		REFERENCES stocks(`code`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playerstocks`
--

INSERT INTO `playerstocks` (`username`, `code`, `amount`) VALUES
('mick123', 'GOLD', 500),
('don123', 'BOND', 800),
('don123', 'GOLD', 900),
('geo123', 'OIL', 700),
('geo123', 'IND', 420);

-- --------------------------------------------------------

--
-- Table structure for table `stockmovements`
--

CREATE TABLE IF NOT EXISTS `stockmovements` (
    `movementID` int(5) NOT NULL,
    `datetime` varchar(19) NOT NULL,
    `code` varchar(4) NOT NULL,
    `action` varchar(4) NOT NULL,
    `amount` int(2) NOT NULL,
    PRIMARY KEY(`movementID`),
    FOREIGN KEY (`code`)
	REFERENCES stocks(`code`)
	ON UPDATE CASCADE
	ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movements`
--

INSERT INTO `stockmovements` (`movementID`, `datetime`, `code`, `action`, `amount`) VALUES
(00001, '2016.02.01-09:01:00', 'BOND', 'down', 5),
(00002, '2016.02.01-09:01:02', 'IND', 'div', 5),
(00003, '2016.02.01-09:01:04', 'OIL', 'down', 10),
(00004, '2016.02.01-09:01:06', 'GOLD', 'div', 5),
(00005, '2016.02.01-09:01:08', 'BOND', 'up', 20),
(00006, '2016.02.01-09:01:10', 'GOLD', 'div', 5),
(00007, '2016.02.01-09:01:12', 'GOLD', 'down', 20),
(00008, '2016.02.01-09:01:14', 'IND', 'div', 10),
(00009, '2016.02.01-09:01:16', 'OIL', 'up', 20),
(00010, '2016.02.01-09:01:18', 'BOND', 'down', 5),
(00011, '2016.02.01-09:01:20', 'BOND', 'up', 5),
(00012, '2016.02.01-09:01:22', 'BOND', 'div', 20),
(00013, '2016.02.01-09:01:24', 'BOND', 'div', 20),
(00014, '2016.02.01-09:01:26', 'GOLD', 'div', 20),
(00015, '2016.02.01-09:01:28', 'IND', 'up', 20),
(00016, '2016.02.01-09:01:30', 'OIL', 'down', 20),
(00017, '2016.02.01-09:01:32', 'GRAN', 'down', 20),
(00018, '2016.02.01-09:01:34', 'BOND', 'up', 5),
(00019, '2016.02.01-09:01:36', 'GOLD', 'down', 20),
(00020, '2016.02.01-09:01:38', 'GOLD', 'down', 20),
(00021, '2016.02.01-09:01:40', 'TECH', 'down', 20),
(00022, '2016.02.01-09:01:42', 'TECH', 'up', 5),
(00023, '2016.02.01-09:01:44', 'OIL', 'up', 20),
(00024, '2016.02.01-09:01:46', 'BOND', 'up', 5),
(00025, '2016.02.01-09:01:48', 'GOLD', 'div', 10),
(00026, '2016.02.01-09:01:50', 'GOLD', 'down', 5),
(00027, '2016.02.01-09:01:52', 'GOLD', 'up', 20),
(00028, '2016.02.01-09:01:54', 'IND', 'down', 10),
(00029, '2016.02.01-09:01:56', 'GOLD', 'div', 20);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
    `transactionID` int(5) NOT NULL,
    `datetime` varchar(19) NOT NULL,
    `username` varchar(6) NOT NULL,
    `code` varchar(4) NOT NULL,
    `type` varchar(4) NOT NULL,
    `amount` int(4) NOT NULL,
    PRIMARY KEY(transactionID),
    FOREIGN KEY (`username`)
        REFERENCES players(`username`)
        ON UPDATE CASCADE
	ON DELETE CASCADE,
    FOREIGN KEY (`code`)
        REFERENCES stocks(`code`)
        ON UPDATE CASCADE
	ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transactionID`,`datetime`, `username`, `code`, `type`, `amount`) VALUES
(00001, '2016.02.01-09:01:00', 'don123', 'BOND', 'buy', 100),
(00002, '2016.02.01-09:01:05', 'don123', 'TECH', 'sell', 1000),
(00003, '2016.02.01-09:01:10', 'hen123', 'TECH', 'sell', 1000),
(00004, '2016.02.01-09:01:15', 'don123', 'IND', 'sell', 1000),
(00005, '2016.02.01-09:01:20', 'geo123', 'GOLD', 'sell', 100),
(00006, '2016.02.01-09:01:25', 'geo123', 'OIL', 'buy', 500),
(00007, '2016.02.01-09:01:30', 'hen123', 'GOLD', 'sell', 100),
(00008, '2016.02.01-09:01:35', 'hen123', 'GOLD', 'buy', 1000),
(00009, '2016.02.01-09:01:40', 'don123', 'TECH', 'buy', 100),
(00010, '2016.02.01-09:01:45', 'don123', 'OIL', 'sell', 100),
(00011, '2016.02.01-09:01:50', 'don123', 'TECH', 'sell', 100),
(00012, '2016.02.01-09:01:55', 'geo123', 'OIL', 'buy', 100),
(00013, '2016.02.01-09:01:60', 'geo123', 'IND', 'buy', 100);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;