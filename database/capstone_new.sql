-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2022 at 03:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `attempt` int(11) NOT NULL,
  `log_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `last_login`, `attempt`, `log_time`) VALUES
(1, 'admin', '$2y$10$YhOFcSoNHW1F/IZE2HnIFOo7O//rD4BPGrOnwJuQNZ5kCBi84ZtfW', '11/28/2022 07:36 PM', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `individual_treatment`
--

CREATE TABLE `individual_treatment` (
  `id` int(11) NOT NULL,
  `clynisis_fsn` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `educ_attainment` varchar(255) NOT NULL,
  `employ_status` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `st_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `family_member` varchar(255) NOT NULL,
  `phlhealth_type` varchar(255) NOT NULL,
  `phlhealth_no` varchar(255) NOT NULL,
  `mother_lname` varchar(255) NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) NOT NULL,
  `nhts_member` varchar(255) NOT NULL,
  `pantawid_pamilya` varchar(255) NOT NULL,
  `hh_no` varchar(255) NOT NULL,
  `allergy` varchar(255) NOT NULL,
  `disability` varchar(255) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `handicap` varchar(255) NOT NULL,
  `impairment` varchar(255) NOT NULL,
  `others` varchar(255) NOT NULL,
  `med_history` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pregnancy`
--

CREATE TABLE `pregnancy` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_date` varchar(255) NOT NULL,
  `prenatal_visit` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `blood_pressure` varchar(255) NOT NULL,
  `aog` varchar(255) NOT NULL,
  `fundic_height` varchar(255) NOT NULL,
  `fhb` varchar(255) NOT NULL,
  `presentation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bhw_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `birthday`, `gender`, `username`, `password`, `bhw_id`, `status`, `avatar`, `last_login`) VALUES
(10, 'Jhomme', 'dimasuay', '1998-02-06', 'Male', 'BHW-Jhomme', '$2y$10$xxdAIzgZ36WA5W4SBLaPt.w8uzKkqIJWLU8O9JnU5IICTyUMHL7Ie', '134543', 'Active', 'avatar/default.jpg', '10-02-2022'),
(24, 'Test', 'Sample', '2001-03-01', 'Male', 'BHW-Test', '$2y$10$Pu3yjPbf9zWGG0DUx2rxCubXlpJRhnHrfm80t37VJ1A1WNOzVYvW2', '17808253', 'Active', 'avatar/1667186288.jfif', '12-04-2022'),
(25, 'sample', 'asdfasdf', '1991-07-11', 'Female', 'BHW-Sample', '$2y$10$mhPqqC1pcog9YhPMVK/5fO5usUtfc8N9fstCTFW2dMrIYPRuXDP0m', '1345365354562', 'Active', 'avatar/default-woman.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individual_treatment`
--
ALTER TABLE `individual_treatment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `individual_treatment`
--
ALTER TABLE `individual_treatment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
