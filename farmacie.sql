-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 05:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmacie`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresa`
--

CREATE TABLE `adresa` (
  `id` int(11) NOT NULL,
  `adresa` varchar(100) NOT NULL,
  `id_utilizator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adresa`
--

INSERT INTO `adresa` (`id`, `adresa`, `id_utilizator`) VALUES
(1, 'Bucuresti,12', 2),
(2, 'Ploiesti,22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cos`
--

CREATE TABLE `cos` (
  `id_cos` int(10) NOT NULL,
  `id_utilizator` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `date_personale`
--

CREATE TABLE `date_personale` (
  `id` int(11) NOT NULL,
  `nume` text NOT NULL,
  `prenume` text NOT NULL,
  `cnp` int(20) NOT NULL,
  `telefon` int(10) NOT NULL,
  `adresa` varchar(30) NOT NULL,
  `varsta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `date_personale`
--

INSERT INTO `date_personale` (`id`, `nume`, `prenume`, `cnp`, `telefon`, `adresa`, `varsta`) VALUES
(9, 'Jercan', 'Alex', 777777, 7233337, 'vg', 88),
(10, 'Apostol', 'Sabin Andrei', 777777, 727120008, 'Maneciu', 22);

-- --------------------------------------------------------

--
-- Table structure for table `medicamente`
--

CREATE TABLE `medicamente` (
  `id_medicamente` int(10) NOT NULL,
  `denumire` varchar(100) NOT NULL,
  `gramaj` int(10) NOT NULL,
  `forma` varchar(10) NOT NULL,
  `descriere` varchar(300) NOT NULL,
  `lot` varchar(10) NOT NULL,
  `data_expirare` date NOT NULL,
  `nr_bucati_stoc` int(11) NOT NULL,
  `id_cos` int(10) DEFAULT NULL,
  `cantitate` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicamente`
--

INSERT INTO `medicamente` (`id_medicamente`, `denumire`, `gramaj`, `forma`, `descriere`, `lot`, `data_expirare`, `nr_bucati_stoc`, `id_cos`, `cantitate`) VALUES
(9, 'parasinus', 10, ' cerc', 'ceva1', '10', '2012-12-12', -3, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `utilizator`
--

CREATE TABLE `utilizator` (
  `id_utilizator` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `parola` text NOT NULL,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `cnp` int(20) NOT NULL,
  `telefon` int(12) NOT NULL,
  `adresa` varchar(30) NOT NULL,
  `varsta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilizator`
--

INSERT INTO `utilizator` (`id_utilizator`, `email`, `parola`, `nume`, `prenume`, `cnp`, `telefon`, `adresa`, `varsta`) VALUES
(2, 'alex@yahoo.com', 'b8b28fcfe009057f2ef7362b1e91fe7a', 'alex', 'apo', 777777, 7233337, 'vg', 22),
(3, 'andrei_jercan@yahoo.com', '970c7956028654ac329b12c10b112058', 'Jercan', 'Andrei', 777777, 7233337, 'Maneciu', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresa`
--
ALTER TABLE `adresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilizator` (`id_utilizator`);

--
-- Indexes for table `cos`
--
ALTER TABLE `cos`
  ADD PRIMARY KEY (`id_cos`),
  ADD KEY `id_utilizator` (`id_utilizator`);

--
-- Indexes for table `date_personale`
--
ALTER TABLE `date_personale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicamente`
--
ALTER TABLE `medicamente`
  ADD PRIMARY KEY (`id_medicamente`),
  ADD KEY `id_cos` (`id_cos`);

--
-- Indexes for table `utilizator`
--
ALTER TABLE `utilizator`
  ADD PRIMARY KEY (`id_utilizator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cos`
--
ALTER TABLE `cos`
  MODIFY `id_cos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `date_personale`
--
ALTER TABLE `date_personale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medicamente`
--
ALTER TABLE `medicamente`
  MODIFY `id_medicamente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `utilizator`
--
ALTER TABLE `utilizator`
  MODIFY `id_utilizator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresa`
--
ALTER TABLE `adresa`
  ADD CONSTRAINT `adresa_ibfk_1` FOREIGN KEY (`id_utilizator`) REFERENCES `utilizator` (`id_utilizator`);

--
-- Constraints for table `cos`
--
ALTER TABLE `cos`
  ADD CONSTRAINT `cos_ibfk_1` FOREIGN KEY (`id_utilizator`) REFERENCES `utilizator` (`id_utilizator`);

--
-- Constraints for table `medicamente`
--
ALTER TABLE `medicamente`
  ADD CONSTRAINT `medicamente_ibfk_1` FOREIGN KEY (`id_cos`) REFERENCES `cos` (`id_cos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
