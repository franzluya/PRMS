-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 01:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aah_prms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) NOT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkup_test`
--

CREATE TABLE `checkup_test` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `petid` int(11) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `reason` text NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('Scheduled','Confirmed','Completed','Cancelled') NOT NULL DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkup_test`
--

INSERT INTO `checkup_test` (`id`, `clientid`, `petid`, `appointment_date`, `reason`, `notes`, `status`, `created_at`) VALUES
(5, 2, 2, '1977-09-01 00:25:00', 'Dolore impedit pari', 'Culpa quas et ipsa', 'Scheduled', '2025-01-03 07:58:11'),
(6, 3, 2, '1969-06-10 07:08:00', 'Ea nulla nostrum lab', 'Dignissimos accusamu', 'Cancelled', '2025-01-03 08:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `client_info`
--

CREATE TABLE `client_info` (
  `id` int(6) NOT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `middle` varchar(1) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `no_of_pets` varchar(20) DEFAULT NULL,
  `pet_type` varchar(20) DEFAULT NULL,
  `reg_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_info`
--

INSERT INTO `client_info` (`id`, `lname`, `fname`, `middle`, `address`, `contact_no`, `no_of_pets`, `pet_type`, `reg_date`) VALUES
(2, 'Halee Long', 'Emmanuel Porter', 'R', '70 West Rocky Nobel Boulevard', 'Sed in quis', '79', 'Veniam vel dolore i', '2025-01-03 15:14:41'),
(3, 'Jemima Jones', 'Alden Avery', 'E', '58 Green Hague Boulevard', 'Quae except', '14', 'Et sit dignissimos p', '2025-01-03 16:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `pet_info`
--

CREATE TABLE `pet_info` (
  `id` int(6) NOT NULL,
  `pet_type` varchar(20) DEFAULT NULL,
  `pet_breed` varchar(20) DEFAULT NULL,
  `pet_name` varchar(20) DEFAULT NULL,
  `pet_gender` varchar(20) DEFAULT NULL,
  `pet_color` varchar(20) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `med_history` varchar(50) DEFAULT NULL,
  `reg_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_info`
--

INSERT INTO `pet_info` (`id`, `pet_type`, `pet_breed`, `pet_name`, `pet_gender`, `pet_color`, `dob`, `age`, `weight`, `med_history`, `reg_date`) VALUES
(2, 'Quia unde non adipis', 'Consequatur Laborio', 'Omar Stokes', 'Female', 'Mollitia praesentium', '2011-09-16 00:00:00', 'Ipsam corporis et en', 'Reprehenderit odio r', 'Enim fuga Fugiat do', '2025-01-03 15:52:48'),
(3, 'Quis elit placeat ', 'Qui veniam quaerat ', 'Raya Walker', 'Male', 'Ea excepturi harum n', '1970-01-12 00:00:00', 'Soluta eligendi quos', 'Sit asperiores enim ', 'Nostrum hic aliquid ', '2025-01-03 16:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_info`
--

CREATE TABLE `vaccination_info` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `petid` int(11) NOT NULL,
  `vaccination_date` date NOT NULL,
  `vaccine_type` varchar(100) NOT NULL,
  `vaccine_brand` varchar(100) NOT NULL,
  `next_vaccination_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination_info`
--

INSERT INTO `vaccination_info` (`id`, `clientid`, `petid`, `vaccination_date`, `vaccine_type`, `vaccine_brand`, `next_vaccination_date`, `notes`, `status`) VALUES
(1, 2, 2, '2003-04-03', 'Aute velit magnam re', 'Cillum omnis aliquam', '1975-03-29', 'Cupidatat molestias ', 'Cancelled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkup_test`
--
ALTER TABLE `checkup_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `petid` (`petid`);

--
-- Indexes for table `client_info`
--
ALTER TABLE `client_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_info`
--
ALTER TABLE `pet_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccination_info`
--
ALTER TABLE `vaccination_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `petid` (`petid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkup_test`
--
ALTER TABLE `checkup_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `client_info`
--
ALTER TABLE `client_info`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pet_info`
--
ALTER TABLE `pet_info`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vaccination_info`
--
ALTER TABLE `vaccination_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkup_test`
--
ALTER TABLE `checkup_test`
  ADD CONSTRAINT `checkup_test_ibfk_1` FOREIGN KEY (`clientid`) REFERENCES `client_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkup_test_ibfk_2` FOREIGN KEY (`petid`) REFERENCES `pet_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccination_info`
--
ALTER TABLE `vaccination_info`
  ADD CONSTRAINT `vaccination_info_ibfk_1` FOREIGN KEY (`clientid`) REFERENCES `client_info` (`id`),
  ADD CONSTRAINT `vaccination_info_ibfk_2` FOREIGN KEY (`petid`) REFERENCES `pet_info` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
