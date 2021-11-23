-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 10:35 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiket_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `id_airlines` varchar(15) NOT NULL,
  `airlines` varchar(25) NOT NULL,
  `digit_code` varchar(3) NOT NULL,
  `country` varchar(25) NOT NULL,
  `thumb` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id_airlines`, `airlines`, `digit_code`, `country`, `thumb`, `create_at`, `create_by`) VALUES
('86ee9f730be10af', 'Brunei air', 'BRN', 'Afghanistan', 'e116710d433232c308626e3e25b7be2b', '2021-11-21 00:17:10', NULL),
('8c25655ab94eb75', 'Soekarno Hatta', 'SKT', 'Pakistan', 'e94046b3d349b514df0d62710305fa09', '2021-11-21 23:32:04', NULL),
('949071c412e822a', 'Hisana Audit', 'HSN', 'Republic of the Congo', 'd758ef5f2fbde4e3746309819626c534.png', '2021-11-21 00:16:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id_airports` varchar(15) NOT NULL,
  `airports` varchar(75) NOT NULL,
  `code` varchar(3) NOT NULL,
  `citycode` varchar(3) NOT NULL,
  `cityname` varchar(25) NOT NULL,
  `countryname` varchar(25) NOT NULL,
  `countrycode` varchar(3) NOT NULL,
  `timezone` char(2) NOT NULL,
  `lat` char(15) NOT NULL,
  `lon` char(15) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id_airports`, `airports`, `code`, `citycode`, `cityname`, `countryname`, `countrycode`, `timezone`, `lat`, `lon`, `create_at`) VALUES
('a2aa218a3191b94', 'Airports Name', 'BAW', 'ḨŪT', 'Ḩukūmatī Dahanah-ye Ghōrī', 'Afghanistan', 'AFG', '5', '3131881.2893123', '-1216682.9215', '2021-11-22 14:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `flight_routes`
--

CREATE TABLE `flight_routes` (
  `id_flight` varchar(25) NOT NULL,
  `main_routes` varchar(25) NOT NULL,
  `type` enum('Departure','Transit','Arrival') NOT NULL,
  `airport_flight` varchar(15) DEFAULT NULL,
  `airlines_plane` varchar(15) DEFAULT NULL,
  `flight_no` char(4) NOT NULL,
  `flight_time` time NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flight_routes`
--

INSERT INTO `flight_routes` (`id_flight`, `main_routes`, `type`, `airport_flight`, `airlines_plane`, `flight_no`, `flight_time`, `create_at`) VALUES
('28a08ee4401671b5ee40783b0', 'b534b291bb967933cc8593482', 'Departure', 'a2aa218a3191b94', '86ee9f730be10af', '1234', '06:30:00', '2021-11-24 04:27:33'),
('2f7cf1a294c3270541a8dddb2', 'b534b291bb967933cc8593482', 'Transit', 'a2aa218a3191b94', '86ee9f730be10af', '4444', '07:31:00', '2021-11-24 04:29:32'),
('924fa1fbff1270a134743101f', 'b534b291bb967933cc8593482', 'Transit', 'a2aa218a3191b94', '86ee9f730be10af', '5555', '08:32:00', '2021-11-24 04:29:32'),
('e678699144855946dcf102e44', 'b534b291bb967933cc8593482', 'Arrival', 'a2aa218a3191b94', '8c25655ab94eb75', '5678', '10:33:00', '2021-11-24 04:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `main_routes`
--

CREATE TABLE `main_routes` (
  `id_routes` varchar(25) NOT NULL,
  `status` enum('Enabled','Disabled') NOT NULL,
  `bagage` int(4) NOT NULL,
  `total_hour` int(2) NOT NULL,
  `vat_tax` char(6) NOT NULL,
  `class` enum('Economy','Business') NOT NULL,
  `refundable` enum('Refundable','Non Refundable') NOT NULL,
  `description` text DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_routes`
--

INSERT INTO `main_routes` (`id_routes`, `status`, `bagage`, `total_hour`, `vat_tax`, `class`, `refundable`, `description`, `create_at`) VALUES
('b534b291bb967933cc8593482', 'Disabled', 25, 15, '14', 'Business', 'Non Refundable', '', '2021-11-24 04:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id_price` varchar(25) NOT NULL,
  `flight` varchar(25) NOT NULL,
  `from_date` varchar(15) DEFAULT NULL,
  `to_date` varchar(15) DEFAULT NULL,
  `adult` int(12) NOT NULL,
  `children` int(12) NOT NULL,
  `infants` int(12) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id_airlines`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id_airports`);

--
-- Indexes for table `flight_routes`
--
ALTER TABLE `flight_routes`
  ADD PRIMARY KEY (`id_flight`),
  ADD KEY `main_routes` (`main_routes`),
  ADD KEY `airport` (`airport_flight`),
  ADD KEY `airlines_plane` (`airlines_plane`);

--
-- Indexes for table `main_routes`
--
ALTER TABLE `main_routes`
  ADD PRIMARY KEY (`id_routes`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id_price`),
  ADD KEY `flight` (`flight`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight_routes`
--
ALTER TABLE `flight_routes`
  ADD CONSTRAINT `flight_routes_ibfk_1` FOREIGN KEY (`main_routes`) REFERENCES `main_routes` (`id_routes`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `flight_routes_ibfk_5` FOREIGN KEY (`airport_flight`) REFERENCES `airports` (`id_airports`) ON DELETE CASCADE,
  ADD CONSTRAINT `flight_routes_ibfk_6` FOREIGN KEY (`airlines_plane`) REFERENCES `airlines` (`id_airlines`) ON DELETE CASCADE;

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`flight`) REFERENCES `main_routes` (`id_routes`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
