-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 12:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `last_login`, `attempt`, `log_time`) VALUES
(1, 'admin', '$2y$10$YhOFcSoNHW1F/IZE2HnIFOo7O//rD4BPGrOnwJuQNZ5kCBi84ZtfW', '01/10/2023 01:59 PM', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `family_planning`
--

CREATE TABLE `family_planning` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `appointment` varchar(255) NOT NULL,
  `spouse_name` varchar(255) NOT NULL,
  `spouse_purok` varchar(255) NOT NULL,
  `spouse_barangay` varchar(255) NOT NULL,
  `heent` varchar(255) NOT NULL,
  `bp` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `pr` varchar(255) NOT NULL,
  `chLB` varchar(255) NOT NULL,
  `conjunctive` varchar(255) NOT NULL,
  `neck` varchar(255) NOT NULL,
  `abdomen` varchar(255) NOT NULL,
  `thorax` varchar(255) NOT NULL,
  `femGenital` varchar(255) NOT NULL,
  `maleGenital` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `max_limit` int(11) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_planning`
--

INSERT INTO `family_planning` (`id`, `patient_id`, `purok`, `barangay`, `appointment`, `spouse_name`, `spouse_purok`, `spouse_barangay`, `heent`, `bp`, `weight`, `pr`, `chLB`, `conjunctive`, `neck`, `abdomen`, `thorax`, `femGenital`, `maleGenital`, `day`, `month`, `year`, `max_limit`, `section`) VALUES
(1, 60, 'awdawd', 'awdawd', 'December 14, 2022', 'Awdawd Awdaw', 'awda', 'awdad', 'Epilepsy/Convulsion/Seizure', '34', '34', '34', 'Shortness of breath', 'Yellowish', 'Enlarged lymph nodes', 'History of gallbladder disease', 'Abnormal heart sounds/cardiac rate', 'Vaginal discharge', 'Hydrocele', '14', 'Dec', '2022', 0, 'Family Planning'),
(2, 61, 'Paho North', 'Taloc', 'December 15, 2022', 'Arthur Mering', 'Paho North', 'Taloc', 'Severe headache/dizziness', '', '52', '80', '', '', '', '', '', 'Unusual vaginal bleeding', 'Hernia', '15', 'Dec', '2022', 0, 'Family Planning'),
(3, 62, 'Paho', 'Taloc', 'December 15, 2022', 'John Lavadia', 'Paho', 'Taloc', 'Severe headache/dizziness', '89', '47', '79', 'Shortness of breath', 'Reddish', 'Enlarged thyroid', 'History of gallbladder disease', 'Abnormal heart sounds/cardiac rate', 'Mass in the Uterus', 'Hydrocele', '15', 'Dec', '2022', 0, 'Family Planning');

-- --------------------------------------------------------

--
-- Table structure for table `immunization`
--

CREATE TABLE `immunization` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `child_no` varchar(255) NOT NULL,
  `mother_name` varchar(200) NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `appointment` varchar(200) NOT NULL,
  `age` varchar(11) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `immunization_given` varchar(200) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `max_limit` int(11) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunization`
--

INSERT INTO `immunization` (`id`, `patient_id`, `child_no`, `mother_name`, `father_name`, `purok`, `barangay`, `appointment`, `age`, `weight`, `temp`, `immunization_given`, `day`, `month`, `year`, `max_limit`, `section`) VALUES
(1, 1, '', 'Mila A. Dimasuay', 'Alex A. Dimasuay', 'Caingin', '3', 'November 28, 2022', '24', '70', '36', 'astra zenica', '28', 'Nov', '2022', 0, ''),
(2, 2, '', 'Lorena G. Alba', 'Alan B. Alba', 'Cabubu-an', 'Pilar', 'November 28, 2022', '22', '55', '36', 'astra zenica', '28', 'Nov', '2022', 0, ''),
(3, 3, '', 'Marietta A. Panoncillo', 'Rodrigo G. Panoncillo', 'Paghidaet', 'Taloc', 'November 28, 2022', '23', '79', '37.1', 'Zinovac', '28', 'Nov', '2022', 0, ''),
(4, 13, '', 'Mila A. Dimasuay', 'Alex A. Dimasuay', 'Caingin', '3', 'November 29, 2022', '1', '70', '36', 'Astra zenica', '29', 'Nov', '2022', 0, ''),
(5, 14, '', 'Mila A. Dimasuay', 'Alex A. Dimasuay', 'Caingin', '3', 'November 29, 2022', '1', '70', '36', 'Astra zenica', '29', 'Nov', '2022', 0, ''),
(6, 15, '', 'Mila A. Dimasuay', 'Alex A. Dimasuay', 'Caingin', '3', 'November 29, 2022', '1', '70', '36', 'Astra zenica', '29', 'Nov', '2022', 0, ''),
(7, 25, '', 'Charisse . Laus', 'Ferdinand . Laus', 'Paho', 'Malvar', 'November 30, 2022', '1', '48', '36', 'ASTRA ZENICA', '30', 'Nov', '2022', 0, ''),
(8, 26, '', 'Mila A. Dimasuay', 'Alex A. Dimasuay', 'Caingin', '3', 'November 30, 2022', '2', '70', '36', 'Wed Nov 30 2022 00:00:00 GMT+0800 (Singapore Standard Time)', '30', 'Nov', '2022', 0, ''),
(9, 30, '', 'Mila A. Dimasuay', 'Alex A. Dimasuay', 'Caingin', 'Taloc', 'November 30, 2022', '4', '50', '37', '2022-11-30', '30', 'Nov', '2022', 0, ''),
(10, 38, '', 'Emilia . Desposado', 'Diosdado . Desposado', 'Paghidaet', 'Taloc', 'December 1, 2022', '4', '59', '36', '2022-12-30', '01', 'Dec', '2022', 0, ''),
(11, 41, '', 'Mathilda . Occida', 'Balmond . Occida', 'Paghidaet', 'Taloc', 'December 2, 2022', '22', '60', '37', '2022-12-31', '02', 'Dec', '2022', 0, ''),
(12, 42, '', 'Wda A. Awd', 'Wad . Awdawd', 'awdadw', 'awdawd', 'December 5, 2022', '0', '23', '32', '2022-12-13', '05', 'Dec', '2022', 0, ''),
(13, 43, '', 'AWDD A. Szczsc', 'Dawdawd A. AWAWD', 'awad', 'awdawd', 'December 7, 2022', '1 day old', '24', '32', '2022-12-07', '07', 'Dec', '2022', 0, ''),
(14, 44, '', 'Awdaw A. Dwadaw', 'Awdaw A. Awdaw', 'awdda', 'awdawd', 'December 7, 2022', '1 day old', '24', '23', '2022-12-30', '07', 'Dec', '2022', 0, ''),
(15, 48, '', 'Awdawd A. Wadawd', 'Dawdaw A. Adwdawd', 'awdawd', 'awdad', 'December 14, 2022', '1 year old', '34', '34', 'awdada', '14', 'Dec', '2022', 0, 'Immunization'),
(16, 49, '', 'Awdaw A. Awdawd', 'Awd A. Awd', 'wadaw', 'awdawd', 'December 14, 2022', '2 days old', '35', '34', 'dwadaw', '14', 'Dec', '2022', 0, 'Immunization'),
(17, 50, '', 'Awdawd A. Awdawd', 'Awdaw A. Awdwad', 'awdawd', 'wdad', 'December 14, 2022', '2 days old', '34', '34', 'awdawd', '14', 'Dec', '2022', 0, 'Immunization'),
(18, 51, '', 'Awdawd A. Awdawd', 'Awdaw A. Awdwad', 'awdawd', 'wdad', 'December 14, 2022', '2 days old', '34', '34', 'awdawd', '14', 'Dec', '2022', 0, 'Immunization'),
(19, 52, '', 'Awdaw A. Dwadawd', 'Awd A. Awd', 'awd', 'awd', 'December 14, 2022', '2 days old', '34', '34', 'adwada', '14', 'Dec', '2022', 0, 'Immunization');

-- --------------------------------------------------------

--
-- Table structure for table `individual_treatment`
--

CREATE TABLE `individual_treatment` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `clinisys` varchar(255) NOT NULL,
  `civil_status` varchar(200) NOT NULL,
  `spouse` varchar(200) NOT NULL,
  `educ_attainment` varchar(200) NOT NULL,
  `employment_status` varchar(200) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `religion` varchar(200) NOT NULL,
  `street` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `blood_type` varchar(200) NOT NULL,
  `family_member` varchar(255) NOT NULL,
  `other_member` varchar(255) NOT NULL,
  `philhealth_type` varchar(200) NOT NULL,
  `philhealth_no` varchar(255) NOT NULL,
  `m_lastname` varchar(200) NOT NULL,
  `m_firstname` varchar(255) NOT NULL,
  `m_middlename` varchar(255) NOT NULL,
  `nhts` varchar(255) NOT NULL,
  `pantawid_member` varchar(255) NOT NULL,
  `hh_no` varchar(255) NOT NULL,
  `alert_type` varchar(200) NOT NULL,
  `other_alert` varchar(255) NOT NULL,
  `medical_history` varchar(255) NOT NULL,
  `other_history` varchar(255) NOT NULL,
  `encounter_type` varchar(255) NOT NULL,
  `consultation_type` varchar(255) NOT NULL,
  `consultation_date` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `transaction_mode` varchar(255) NOT NULL,
  `s` varchar(255) NOT NULL,
  `o` varchar(255) NOT NULL,
  `pr` varchar(255) NOT NULL,
  `rr` varchar(255) NOT NULL,
  `bp` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `a` varchar(255) NOT NULL,
  `p` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `max_limit` int(11) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `individual_treatment`
--

INSERT INTO `individual_treatment` (`id`, `patient_id`, `clinisys`, `civil_status`, `spouse`, `educ_attainment`, `employment_status`, `occupation`, `religion`, `street`, `purok`, `barangay`, `blood_type`, `family_member`, `other_member`, `philhealth_type`, `philhealth_no`, `m_lastname`, `m_firstname`, `m_middlename`, `nhts`, `pantawid_member`, `hh_no`, `alert_type`, `other_alert`, `medical_history`, `other_history`, `encounter_type`, `consultation_type`, `consultation_date`, `age`, `transaction_mode`, `s`, `o`, `pr`, `rr`, `bp`, `weight`, `height`, `temp`, `a`, `p`, `day`, `month`, `year`, `max_limit`, `section`) VALUES
(1, 22, '', 'Separated', '', 'Elementary', 'Student', '', 'Roman Catholic', 'Rizal St', 'Ba-o', 'Cadulunan', 'A', 'Mother', '', 'Dependent', '', 'Quinto', 'Analita', 'Pavila', 'No', 'No', '', 'Impairmaent', '', 'HPN', '', 'Consultation', 'General', 'November 29, 2022', '22', 'Visited', 'Sakit ulo', 'Taking adequate calories and fluid', '89', '89', '88/70', '79', '5', '36', 'No obstruction', 'Check liver tests tomorrow', '29', 'Nov', '2022', 0, '0'),
(2, 23, '', 'Separated', '', 'Elementary', 'Unemployed', '', 'Roman Catholic', 'Rizal St', 'Caingin', '3', 'O', 'Mother', '', 'Dependent', '', 'Dimasuay', 'Mila', 'Apayart', 'No', 'No', '', 'Handicap', '', 'DM', '', 'New Admission', 'Prental', 'November 30, 2022', '3', 'Walk-in', 'Nauseated', 'Less jaundiced', '87', '87', '90', '78', '5', '36', 'No obstruction', 'Check liver tests tomorrow', '30', 'Nov', '2022', 0, '0'),
(3, 32, '', 'Separated', '', 'College', 'Employed', 'firewoman', 'Aglipay', 'Irragasyon', '13', 'Taloc', 'A', 'Mother', '', 'Dependent', '', 'Palarion', 'Grace', 'Dimasuay', 'No', 'No', '', 'Drug', '', 'Asthma', '', 'Consultation', 'Prental', 'November 30, 2022', '24', 'Walk-in', 'Nauseated', 'Less jaundice', '80', '80', '80', '69', '5', '36', 'No obstruction', 'Check liver tests tomorrow', '30', 'Nov', '2022', 0, '0'),
(4, 40, '', 'Single', '', 'College', 'Unemployed', '', 'Catholic', 'Rizal', 'Paghidaet', 'Taloc', 'B', 'Father', '', 'Dependent', '', 'Mendoza', 'Carmela', '', 'No', 'No', '', 'Impairmaent', '', 'Asthma', '', 'Consultation', 'General', 'December 2, 2022', '23', 'Walk-in', 'Headache', 'Taking adequate calories and fluid', '80', '90', '80', '80', '5', '36', 'No obstruction', 'Check liver tests tomorrow', '02', 'Dec', '2022', 0, '0'),
(5, 2, '', 'Separated', '', 'Elementary', 'Student', '', 'dwadawd', 'awda', 'wad', 'awd', 'awd', 'Mother', '', 'Member', '', 'awdawd', 'awdawd', 'awdawd', 'No', 'No', '', 'Impairmaent', '', 'DM', '', 'Consultation', 'Child Immunization', 'December 14, 2022', '22 years old', 'Walk-in', 'dawd', 'awdawd', '23', '23', '34', '34', '43', '33', 'adwaw', 'awdawwa', '14', 'Dec', '2022', 0, 'Individual Treatment'),
(6, 0, '', 'Separated', '', 'Elementary', 'Student', '', 'wadawda', 'awdawd', 'awdawd', 'awdaw', 'awdawd', 'Mother', '', 'Dependent', '', 'awdad', 'adaw', 'awdaw', 'Yes', 'No', '', 'Impairmaent', '', 'DM', '', 'Consultation', 'Child Immunization', 'December 14, 2022', '23 years old', 'Walk-in', 'awdawd', 'awdawd', '43', '34', '34', '34', '43', '34', 'awdawd', 'awdawda', '14', 'Dec', '2022', 0, 'Individual Treatment'),
(7, 0, '', 'Single', '', 'Elementary', 'Student', '', 'awdawd', 'wadawd', 'awdawd', 'awdawd', 'awdawd', 'Mother', '', 'Member', '', 'dawdaw', 'awdawd', 'awdawd', 'No', 'No', '', 'Disabilty', '', 'HPN', '', 'Consultation', 'General', 'December 14, 2022', '30 days old', 'Walk-in', 'wadawd', 'awdawd', '35', '34', '34', '53', '45', '34', 'dawdawd', 'awdawd', '14', 'Dec', '2022', 0, 'Individual Treatment'),
(8, 0, 'undefined', 'Divorced', 'undefined', 'Elementary', 'Student', 'undefined', 'dawawd', 'awdawd', 'awdaw', 'awdawd', 'awd', 'Mother', 'undefined', 'Member', 'undefined', 'awdawd', 'awdaw', 'awdawd', 'No', 'No', 'undefined', 'Disabilty', 'undefined', 'HPN', 'undefined', 'Consultation', 'General', 'undefined', '2 days old', 'Walk-in', 'awdawd', 'awdawd', '34', '34', '34', '34', '34', '34', 'awda', 'awdawd', '14', 'Dec', '2022', 0, 'Individual Treatment'),
(9, 0, '', 'Divorced', '', 'Elementary', 'Student', '', 'wadawd', 'awd', 'awd', 'wad', 'awdw', 'Father', '', 'Member', '', 'awd', 'awd', 'awd', 'No', 'No', '', 'Impairmaent', '', 'DM', '', 'Consultation', 'Child Immunization', 'December 14, 2022', '2 days old', 'Visited', 'awdawd', 'awdawd', '34', '34', '34', '43', '34', '43', 'adwawd', 'awdwad', '14', 'Dec', '2022', 0, 'Individual Treatment'),
(10, 53, '', 'Divorced', '', 'Elementary', 'Student', '', 'wadawd', 'awdawd', 'awdawd', 'awdawd', 'awdwad', 'Father', '', 'Member', '', 'awdawd', 'awdawd', 'awdawd', 'No', 'No', '', 'Allergy', '', 'HPN', '', 'Consultation', 'Prental', 'December 14, 2022', '3 days old', 'Visited', 'awdawd', 'awdawd', '34', '34', '34', '34', '34', '34', 'adawd', 'awd', '14', 'Dec', '2022', 0, 'Individual Treatment'),
(11, 64, '', 'Married', 'Jona Pilapil', 'No Formal Educ.', 'Employed', 'Taga Tapas Buto', 'Roman Catholic', 'Backstreet Bois', 'Paghidaet', 'Taloc', 'A', 'Others', '', 'Dependent', '', 'De', 'Minyang', 'Pil', 'No', 'No', '', 'Others', 'None', 'Others', 'None', 'New Admission', 'General', 'January 5, 2023', '34 years old', 'Walk-in', 'hmm', 'oo', '12', '12', '80/100', '50', '170', '37', '2', '3', '05', 'Jan', '2023', 0, 'Individual Treatment');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `fsn` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `max_limit` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `request_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fsn`, `first_name`, `middle_name`, `last_name`, `suffix`, `birthdate`, `gender`, `username`, `password`, `avatar`, `phone_number`, `max_limit`, `day`, `month`, `year`, `last_login`, `request_id`, `section`) VALUES
(1, '1', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', '1998-02-05T16:00:00.000Z', 'Male', 'PATIENT-Jhomme', '$2y$10$Vb0WCQYw4wF5ZR9f4PXxQ.8OtWm3S8dKFAXtESY1./37c0ZVm7xve', 'avatar/default.png', '09476371070', 0, '28', 'Nov', '2022', '', 0, '0'),
(2, '2', 'Andrew', 'Gonzaga', 'Alba', 'undefined', 'Fri Mar 17 2000 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Andrew', '$2y$10$oPIAvMW/WY9UGxgse/FDSuqFkobbvzDg3dLlJFOfBcQDr1sM/F4PC', 'avatar/default.png', '09636084380', 0, '28', 'Nov', '2022', '', 0, '0'),
(3, '3', 'Jan Carlo', 'Durato', 'Panoncillo', 'undefined', 'Mon Mar 01 1999 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Jan Carlo', '$2y$10$hH4.jgWlBI32dgzMhMu/EOuk6wva467bDBq42JDNfBJBn5k9nsN1W', 'avatar/default.png', '09275372968', 0, '28', 'Nov', '2022', '', 0, '0'),
(4, '4', 'Salvacion', '', ' Haboc', 'undefined', 'Tue Apr 11 1972 00:00:00 GMT+0730 (Singapore Standard Time)', 'Male', 'PATIENT-Salvacion', '$2y$10$ROD3uRZWswhV.SbLchrYvutWiqYgqcpJJAHSHo.IKtV3OmZxJ4eCK', 'avatar/default.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(5, '5', 'Ricky', '', 'Cotalbas', 'undefined', 'Sat May 24 1975 00:00:00 GMT+0730 (Singapore Standard Time)', 'Male', 'PATIENT-Ricky', '$2y$10$J8qvWxRl08NM6nZ2yLdbWuvcVOxqQshMpOqYYLktt8yHg54BmBE62', 'avatar/default.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(6, '6', 'Lemuel', '', 'Arsua', 'undefined', 'Thu Apr 07 1983 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Lemuel', '$2y$10$a6hr16MNgYGFX2i8DWr7ruKjJZ25FWtvfCEL8wmWP0FQA9c.IH8kS', 'avatar/default.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(7, '7', 'Carlito', '', 'Malunes', 'undefined', 'Thu Aug 05 1976 00:00:00 GMT+0730 (Singapore Standard Time)', 'Male', 'PATIENT-Carlito', '$2y$10$IMMnT8JYBv2L8BDvSL095uyPFMUqCGu1zFYax0zVu8/o.sBHC6zRK', 'avatar/default.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(8, '8', 'Renelyn', 'undefined', 'Villarmino', 'undefined', 'Thu Jul 11 1991 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Renelyn', '$2y$10$HBI4MPzLeAfX7afb3VOn.OuIrrxYCY2jOXwzahdypt8KRmVBUEeia', 'avatar/default-woman.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(9, '9', 'Jesalyn', 'undefined', 'Sangalan', 'undefined', 'Thu Jul 13 1995 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Jesalyn', '$2y$10$poDFGR2zdURyO/iRTvlyxu3SoPxa6PbuD160wZgkbBknjcFQ/3PV.', 'avatar/default-woman.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(10, '10', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', 'Fri Feb 06 1998 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Jhomme', '$2y$10$wCohpAX1.pjq95oV0LepIO3CLacsuTvwuynpTqz9tgfJOf.I4A0Uy', 'avatar/default.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(11, '11', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', 'Fri Feb 06 1998 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Jhomme', '$2y$10$npiBmzDleJRnGER2FZ2DHuChsgBfgWyo.nJvuhLCaEoQ3YvLqu1Qu', 'avatar/default.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(12, '12', 'Jhomme', 'Apayart', 'DImasuay', 'undefined', 'Fri Feb 06 1998 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Jhomme', '$2y$10$CbaIWlki5B0dazJRBWpvVOKJnzTMMvlp.qpLQStKWpPfDZA/JpJVu', 'avatar/default.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(13, '13', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', 'Mon Nov 15 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Jhomme', '$2y$10$vq2/DimpcdVs8aSkukmr2uYtdCAEAxMN/Ch8GpYM5fIUA32ETyq8W', 'avatar/default.png', '09123123213', 0, '29', 'Nov', '2022', '', 0, '0'),
(14, '13', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', 'Mon Nov 15 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Jhomme', '$2y$10$K5jJ/GaosaBs.SZqjFNa3.vEe4gRdC8jJTBbJrBRJIxusC9VH4ie2', 'avatar/default.png', '09123123213', 0, '29', 'Nov', '2022', '', 0, '0'),
(15, '14', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', 'Mon Nov 15 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Jhomme', '$2y$10$H9CUdl9Pv9n765H9OzNLFuKASguoQ9RkaBQVMWyXfDKu6J6aEYHA.', 'avatar/default.png', '09123123213', 0, '29', 'Nov', '2022', '', 0, '0'),
(16, '14', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', '2021-11-14T16:00:00.000Z', 'Male', 'PATIENT-Jhomme', '$2y$10$7N6VzxBETD2rt1nlMa4Gh.xJ08v1xOKq8ty9qFIlyDl0dZb2BwN3K', 'avatar/default.png', '09123123213', 0, '29', 'Nov', '2022', '', 0, '0'),
(17, '14', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', '2021-11-14T16:00:00.000Z', 'Male', 'PATIENT-Jhomme', '$2y$10$RNOk5/ImXxCAGcG87peY9uonqaQT8YBs4mFXX50tY0t4jfrz68oGm', 'avatar/default.png', '09123123213', 0, '29', 'Nov', '2022', '', 0, '0'),
(18, '15', 'Mila', 'Apayart', 'Dimasuay', '', '1995-06-20T16:00:00.000Z', 'Female', 'PATIENT-Mila', '$2y$10$EMO.rhgpyh6ShvQRqR47bu5N5B2oqg2wvAMIxJ.w6vTzFbT8ApELC', 'avatar/default-woman.png', '09476371070', 0, '29', 'Nov', '2022', '', 0, '0'),
(19, '16', 'Kolyne', 'Ocup', 'Lavadia', 'undefined', '2018-02-06T16:00:00.000Z', 'Female', 'PATIENT-Kolyne', '$2y$10$ymioFGTg/OMYSde7F7RoZuVC/WfOXK7umvCkaMeu/yzLhegfif9L6', 'avatar/default-woman.png', '09166128254', 0, '29', 'Nov', '2022', '', 0, '0'),
(20, '16', 'Kolyne', 'Ocup', 'Lavadia', 'undefined', '2018-02-06T16:00:00.000Z', 'Female', 'PATIENT-Kolyne', '$2y$10$ukK7TGLhJNJOaYBZkq7ayertpi3K/6oOEDWQDXLpMKUO4m/Jthwgy', 'avatar/default-woman.png', '09166128254', 0, '29', 'Nov', '2022', '', 0, '0'),
(22, '17', 'Charlie', 'Pavila', 'Quinto', 'undefined', '2000-09-17T16:00:00.000Z', 'Male', 'PATIENT-Charlie', '$2y$10$.gS5SEsuJZ7CBiT3CDX4.eROOpdVG05nAVQQyzhPoBuSNtlTYBSq2', 'avatar/default.png', '09123123123', 0, '29', 'Nov', '2022', '', 0, '0'),
(23, '18', 'Jhomme', 'Apayart', 'Lavadia', 'undefined', 'Sat Nov 30 2019 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Jhomme', '$2y$10$i.6kN6nIV7U45W6Si2FZdOreCAqYKcLwZu6OwrNNNwsN/l8ipVN02', 'avatar/default.png', '09131231231', 0, '30', 'Nov', '2022', '', 0, '0'),
(24, '19', 'Jenine', 'Cordero', 'Alba', '', 'Wed Feb 02 2000 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Jenine', '$2y$10$O4E/NQPIpwz028Eis.Ol2.YRjju1R5uoeRSere33DL6xrjhiWo7ii', 'avatar/default-woman.png', '09123123123', 0, '30', 'Nov', '2022', '', 0, '0'),
(25, '20', 'Charie', 'undefined', 'Laus', 'undefined', 'Tue Nov 23 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Charie', '$2y$10$epqkBGHYIGY7XJDiF/jpPuUsg9SyOJ7hHfwim3KYRSk77d.l.GPr.', 'avatar/default-woman.png', '09454823837', 0, '30', 'Nov', '2022', '', 0, '0'),
(26, '21', 'Jhomme', 'Apayart', 'Dimasuay', 'undefined', '2020-11-22T16:00:00.000Z', 'Male', 'PATIENT-Jhomme', '$2y$10$U71hjT1Tj2yV3u/xJNimyelJFf7g3J/syC..1q7UGlysG6jehI6Y2', 'avatar/default.png', '09243434343', 0, '30', 'Nov', '2022', '', 0, '0'),
(27, '22', 'Myra', 'undefined', 'Amido', '', 'Wed Nov 29 2000 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Myra', '$2y$10$PIBDeP7kX7f7N8vIKxhS.ukxSebbO.2N1LhfYloScOwG2TkAL9eD6', 'avatar/default-woman.png', '09112321312', 0, '30', 'Nov', '2022', '', 0, '0'),
(28, '23', 'Myra', 'undefined', 'Amido', '', '2000-11-28T16:00:00.000Z', 'Female', 'PATIENT-Myra', '$2y$10$x3h9FfzoxSMtkp2iEfXey.WJnCmvQhfQmqM9ruSUbAuZIDCRVBNLm', 'avatar/default-woman.png', '09112321312', 0, '30', 'Nov', '2022', '', 0, '0'),
(29, '24', 'Myra', 'undefined', 'Amido', '', '2000-11-28T16:00:00.000Z', 'Female', 'PATIENT-Myra', '$2y$10$7dA.AjDwQxlE4imlknAwPe7DuNgg43blQNGBFObVo1KG2W7Bcceba', 'avatar/default-woman.png', '09112321312', 0, '30', 'Nov', '2022', '', 0, '0'),
(30, '25', 'James', 'Apayart', 'Dimasuay', 'undefined', 'Tue Feb 06 2018 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-James', '$2y$10$PAv8HmXT.nwxi3yq67vG3uPMGNPYx3PccEN37FijkSvUpioeuSSP6', 'avatar/default.png', '09321231231', 0, '30', 'Nov', '2022', '01-10-2023', 0, '0'),
(31, '26', 'Jessa', 'Dimasuay', 'Palarion', '', 'Thu Dec 25 1997 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Jessa', '$2y$10$xGVa.JAqejgacytmArOqKebekFIsJuOjBz.BlMqp/LcfWTfxFipzu', 'avatar/default-woman.png', '09123123123', 0, '30', 'Nov', '2022', '', 0, '0'),
(32, '27', 'Jessa', 'Dimasuay', 'Palarion', 'undefined', '1997-12-24T16:00:00.000Z', 'Female', 'PATIENT-Jessa', '$2y$10$fl0VHzn3XkATutaDJlzuh.oPfP.VLuR9FyRKiZMNKokPq4lKpjdKq', 'avatar/default-woman.png', '09123123123', 0, '30', 'Nov', '2022', '', 0, '0'),
(33, '28', 'Maribelle', 'Genit', 'Melendez', '', 'Sun Sep 25 1988 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Maribelle', '$2y$10$prFzBlTtDifoR3ZUhHgQxekjFCrUACQ03yOXdxh2YJffaxq9m6d2e', 'avatar/default-woman.png', '09231231231', 0, '30', 'Nov', '2022', '', 0, '0'),
(34, '29', 'Erika', 'undefined', 'Panagsagan', '', 'Tue Jul 24 2001 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Erika', '$2y$10$Yq7JmQbRCIObByx./LIujuBwAi3133y82OzRopvtcKkRRKA6k0EIe', 'avatar/default-woman.png', '09237236767', 0, '30', 'Nov', '2022', '', 0, '0'),
(35, '30', 'Erika', 'undefined', 'Panagsagan', '', '2001-07-23T16:00:00.000Z', 'Female', 'PATIENT-Erika', '$2y$10$3u.ZPK.gcV0MWiG9ZXVF4uKhyFG0lfk6FQSSPBgmFYHUpgYcnETA2', 'avatar/default-woman.png', '09237236767', 0, '30', 'Nov', '2022', '', 0, '0'),
(36, '31', 'Erika', 'undefined', 'Panagsagan', '', '2001-07-23T16:00:00.000Z', 'Female', 'PATIENT-Erika', '$2y$10$DY/1LZl4pj8htaWdcZM3PuQuTScerykFwWoDxGG.K187lyrxvcdae', 'avatar/default-woman.png', '09237236767', 0, '30', 'Nov', '2022', '', 0, '0'),
(37, '31', 'Erika', 'undefined', 'Panagsagan', '', '2001-07-23T16:00:00.000Z', 'Female', 'PATIENT-Erika', '$2y$10$lYNr8iRDyAmeCwJL0Sk6IuGwZqUvAB2o9ayXaS/v3PQij/J8vAMoq', 'avatar/default-woman.png', '09237236767', 0, '30', 'Nov', '2022', '', 0, '0'),
(38, '32', 'Emilie', 'undefined', 'Desposado', 'undefined', 'Tue Dec 19 2017 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Emilie', '$2y$10$pz8.UTrKnroZHHPKqVtB/eqzdNROKOdeE8sO9cuf85RbVQZhv2w9u', 'avatar/default-woman.png', '09818027251', 0, '01', 'Dec', '2022', '', 0, '0'),
(39, '33', 'Emilie', 'undefined', 'Desposado', '', '2017-12-18T16:00:00.000Z', 'Female', 'PATIENT-Emilie', '$2y$10$Pck7IvtyMtTnVFmUZgNkiuQIVwFfVzZVHfOILrB3L6CzEZhqJOwrq', 'avatar/default-woman.png', '09818027251', 0, '01', 'Dec', '2022', '', 0, '0'),
(40, '34', 'Ian', 'Orbeta', 'Mendoza', 'undefined', 'Tue Jan 19 1999 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Ian', '$2y$10$54dipMDRjqYW.maxtZv26.U1xCiDIRRiIXd32GRzupRZVAUkdX/Uu', 'avatar/default.png', '09131231231', 0, '02', 'Dec', '2022', '', 0, '0'),
(41, '35', 'Ian', 'undefined', 'Occida', 'undefined', 'Tue Jun 06 2000 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Ian', '$2y$10$pToEGbDXH1DLBXKwyEf7P.1mSXP86IGYDRkW0P8.cvGQfYmB0qHGy', 'avatar/default.png', '09476371070', 0, '02', 'Dec', '2022', '', 0, '0'),
(42, '37', 'awda', '', 'wadaw', 'undefined', 'Sun Dec 12 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Awda', '$2y$10$6nfMjMj5pROasp9bvEtBXuEmoo8aOQ3t30j5KGemfutRmPxjPEx6O', 'avatar/default.png', '09476371070', 0, '05', 'Dec', '2022', '', 0, '0'),
(43, 'undefined', 'awdaw', 'undefined', 'dawd', 'undefined', '2022-12-05T16:00:00.000Z', 'Male', 'PATIENT-Awdaw', '$2y$10$FQpH/L1mDzLiPSryPJ6Mhud1BwZQjqEtN61pOSqHi3E.MamwmTa4G', 'avatar/default.png', '09232323232', 0, '07', 'Dec', '2022', '', 0, '0'),
(44, 'undefined', 'xdxxdx', 'undefined', 'gsssrs', 'undefined', 'Tue Dec 06 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Xdxxdx623', '$2y$10$PcYbVn.hUBhk/npjemmPz.pX2QashAYfs4IaCqrPjmwfp96K0P7A6', 'avatar/default-woman.png', '09232323232', 0, '07', 'Dec', '2022', '', 0, '0'),
(45, 'undefined', 'awdawd', 'undefined', 'wadawd', 'undefined', 'Mon May 03 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Awdawd734', '$2y$10$mn62gN/3AVyJA4uFxf/InOxPrYsQSlepngNUZL9sBk8XT.rn87Uhe', 'avatar/default.png', '09123123123', 0, '10', 'Dec', '2022', '', 0, '0'),
(46, 'undefined', 'aadwdwdq', 'q', 'dwadawd', 'undefined', 'Sun Dec 04 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Aadwdwdq271', '$2y$10$3tRl9/QkTgy9GFfZHdxAzes6Ne6Hvb173OGmZ80lJ6kQJ4HQxJuYO', 'avatar/default.png', '09232323223', 0, '14', 'Dec', '2022', '', 0, 'Immunization'),
(47, 'undefined', 'aadwdwdq', 'q', 'dwadawd', 'undefined', 'Sun Dec 04 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Aadwdwdq547', '$2y$10$ye2sl6jhSamhfEH9XF09DuyDASFXd3k0U/flmWybtEPBGPznDITyi', 'avatar/default.png', '09232323223', 0, '14', 'Dec', '2022', '', 0, 'Immunization'),
(48, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'PATIENT-Undefined649', '$2y$10$c8ElpzzwGJDHFC40NKoCJ.MStlMheSmOFoo2Yyn3zAwqaukECipii', 'avatar/default-woman.png', 'undefined', 0, '14', 'Dec', '2022', '', 0, 'Immunization'),
(49, 'undefined', 'awdawd', 'undefined', 'awdawd', 'undefined', 'Mon Dec 12 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Awdawd964', '$2y$10$QLcAKSK9kAx5iBa132WUx.dH3IjgcOlGpfGiyq0CaH1GsxJcXXC.e', 'avatar/default.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Immunization'),
(50, 'undefined', 'awdawd', 'undefined', 'awdwad', 'undefined', 'Mon Dec 12 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Awdawd428', '$2y$10$JWK9xa8kIvMJBRI8j0iYGejupiDwxqant2vRrNHXK6meSKkbAl1x6', 'avatar/default.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Immunization'),
(51, 'undefined', 'awdawd', 'undefined', 'awdwad', 'undefined', 'Mon Dec 12 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Awdawd827', '$2y$10$jvsQhaEOBw4Euj3eo/PYEOhFnZIy1oW3Q9qlaIn/pXM8CC.WgfXLC', 'avatar/default.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Immunization'),
(52, 'undefined', 'awdawd', 'undefined', 'dwadawd', 'undefined', '2022-12-11T16:00:00.000Z', 'Male', 'PATIENT-Awdawd293', '$2y$10$genFCrHhuN.It.JJDULG5utVt.hggbxo6rQOmdKDruqx4TOP8pdJ2', 'avatar/default.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Immunization'),
(53, 'undefined', 'awdawd', 'aw', 'dawdawd', 'undefined', 'Sun Dec 11 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Male', 'PATIENT-Awdawd278', '$2y$10$8OJdtPkyR/8ZHMGC6AIzUegNarQ.bHM4yDrH5uANssSn.8TOExe7G', 'avatar/default.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Individual Treatment'),
(54, 'undefined', 'awdawdgr', '', 'fegrg', '', 'Thu Nov 14 1974 00:00:00 GMT+0730 (Singapore Standard Time)', 'Female', 'PATIENT-Awdawdgr469', '$2y$10$B.Owz3uzp1g2aazzA1.cq.S8gQnSa.dScOszy8D5NQbQDFkk2N2/S', 'avatar/default-woman.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Maternity'),
(55, 'undefined', 'qdqfqfw', 'fe', 'awdawd', '', 'Tue Jun 18 1985 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Qdqfqfw287', '$2y$10$6R/GAApkheXoyhhUz8h9s.6/GUWwoUinyElpELIz4IJ4MBDuMtZf2', 'avatar/default-woman.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Family Planning'),
(56, 'undefined', 'awdawd', 'awdawd', 'awdawd', '', 'Tue Oct 20 1981 00:00:00 GMT+0730 (Singapore Standard Time)', 'Female', 'PATIENT-Awdawd574', '$2y$10$xJaPIPo.2OA/5JwN9h9yMe6.4D4qf2JcA052BlQ/e/dMJgn9mD6Zq', 'avatar/default-woman.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Family Planning'),
(57, 'undefined', 'wawdawd', 'awdad', 'dwadaw', '', 'Sun May 06 2001 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Wawdawd792', '$2y$10$T1H65bsfJU2.aYuWh8HF8O0AKQSnmBeBxlHWSeE.jdoPDJi/cInHm', 'avatar/default-woman.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Family Planning'),
(58, 'undefined', 'wawdawd', 'awdad', 'dwadaw', '', 'Sun May 06 2001 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Wawdawd691', '$2y$10$EAeqvn2SS7IAHTxu3bh2T.pj4aREhdc.Ye/jJMIqprDOf/VvCxnm2', 'avatar/default-woman.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Family Planning'),
(59, 'undefined', 'wawdawd', 'awdad', 'dwadaw', '', 'Sun May 06 2001 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Wawdawd932', '$2y$10$5zp4YB/.jDEcifUHgDDFPOpRCDPQcWt5tbguW1dz0wfV787HGP5z6', 'avatar/default-woman.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Family Planning'),
(60, 'undefined', 'wawdawd', 'awdad', 'dwadaw', '', 'Sun May 06 2001 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Wawdawd639', '$2y$10$GfQ5k9ymja1ptcL64nQAqOLno7xAy89T9.leSI7LNugE2McHAUCj6', 'avatar/default-woman.png', '09232323232', 0, '14', 'Dec', '2022', '', 0, 'Family Planning'),
(61, 'undefined', 'Kolyne', 'Ocup', 'Lavadia', '', 'Sun Jan 14 2001 00:00:00 GMT+0800 (Philippine Standard Time)', 'Female', 'PATIENT-Kolyne584', '$2y$10$.BsYAg3hNkjLQHRxNNiecefn96hYyjn8jnrbNV4Y20pXN6ajGrW0u', 'avatar/default-woman.png', '09166128254', 0, '15', 'Dec', '2022', '', 0, 'Family Planning'),
(62, 'undefined', 'Kolyne', 'undefined', 'Lavadia', '', 'Sun Jan 14 2001 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Kolyne416', '$2y$10$o.HeQyokogkqoUlkyLd9nenKkwUyUmgGpg8mRA3dvt7/pZXXrEMry', 'avatar/default-woman.png', '09476371070', 0, '15', 'Dec', '2022', '', 0, 'Family Planning'),
(63, 'undefined', 'Kolyne', 'undefined', 'Lavadia', '', 'Sun Jan 14 2001 00:00:00 GMT+0800 (Singapore Standard Time)', 'Female', 'PATIENT-Kolyne958', '$2y$10$5uWzcZ0rW7tvLMk2EgqiNemlkzObk1xTCDLRLMHXnZA83iy1XUp.i', 'avatar/default-woman.png', '09476371070', 0, '15', 'Dec', '2022', '', 0, 'Maternity');

-- --------------------------------------------------------

--
-- Table structure for table `pending_request`
--

CREATE TABLE `pending_request` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `appointment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_request`
--

INSERT INTO `pending_request` (`id`, `patient_id`, `date`, `section`, `status`, `appointment`) VALUES
(1, 30, 'Nov 30, 2022', 'Immunization', 'Approved', 'December 21, 2022'),
(2, 30, 'Dec 01, 2022', 'Immunization', 'Approved', 'December 30, 2022'),
(3, 30, 'Dec 02, 2022', 'Family Planning', 'Pending', ''),
(5, 30, 'Dec 12, 2022', 'Immunization', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `prenatal`
--

CREATE TABLE `prenatal` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `spouse_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `gp` varchar(255) NOT NULL,
  `lmp` varchar(255) NOT NULL,
  `edc` varchar(255) NOT NULL,
  `tt_status` varchar(255) NOT NULL,
  `appointment` varchar(200) NOT NULL,
  `date_visit` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `bp` varchar(11) NOT NULL,
  `cr` varchar(11) NOT NULL,
  `rr` varchar(11) NOT NULL,
  `temp` varchar(11) NOT NULL,
  `aog` varchar(11) NOT NULL,
  `fundic_height` varchar(11) NOT NULL,
  `fhb` varchar(11) NOT NULL,
  `presentation` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `max_limit` int(11) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prenatal`
--

INSERT INTO `prenatal` (`id`, `patient_id`, `spouse_name`, `purok`, `barangay`, `gp`, `lmp`, `edc`, `tt_status`, `appointment`, `date_visit`, `weight`, `bp`, `cr`, `rr`, `temp`, `aog`, `fundic_height`, `fhb`, `presentation`, `day`, `month`, `year`, `max_limit`, `section`) VALUES
(1, 18, 'Alex Dimasuay', 'Caingin', '3', 'Alexandra Carpio', 'Sun Nov 06 2011 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed May 31 2023 00:00:00 GMT+0800 (Singapore Standard Time)', '3', 'November 29, 2022', 'November 29, 2022', '59', '120', '79', '79', '36', '3', '5', '110', 'Boy', '29', 'Nov', '2022', 0, ''),
(2, 24, 'Andrew Alba', 'Alianza', 'Ma-ao', 'Luzviminda Marasigan', 'Mon Feb 14 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Mon Nov 14 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'CDC', 'November 30, 2022', 'November 30, 2022', '39', '70', '72', '60', '36', '8', '5', '100', 'Boy', '30', 'Nov', '2022', 0, ''),
(3, 27, 'Mark Villar', 'Piaya', 'Taloc', 'Avelino Porter', 'Thu Jun 30 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed Mar 22 2023 00:00:00 GMT+0800 (Singapore Standard Time)', 'Normal', 'November 30, 2022', 'November 30, 2022', '50', '80', '45', '80', '36', '37', '6', '100', 'Girl', '30', 'Nov', '2022', 0, ''),
(4, 28, 'Mark Pronopio', 'Langka ', 'Taloc', 'Charity Dela cruz', 'Wed Aug 24 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed May 31 2023 00:00:00 GMT+0800 (Singapore Standard Time)', 'Normal', 'November 30, 2022', 'November 30, 2022', '50', '80', '39', '80', '35', '12', '5', '120', 'Girl', '30', 'Nov', '2022', 0, ''),
(5, 29, 'Mark Candido', 'Irrigasyon', 'Taloc', 'Luzviminda', 'Fri Nov 26 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed Aug 24 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Normal', 'November 30, 2022', 'November 30, 2022', '50', '90', '24', '23', '36', '14', '5', '110', 'Boy', '30', 'Nov', '2022', 0, ''),
(6, 31, 'Robert Palarion', 'Irrigasyon', 'Taloc', 'Mabelle Gustillo', 'Tue Nov 30 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Fri Aug 26 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'CDC', 'November 30, 2022', 'November 30, 2022', '50', '90', '80', '80', '36', '5', '4', '121', 'Boy', '30', 'Nov', '2022', 0, ''),
(7, 33, 'Fred Melendez', 'Paghidaet', 'Taloc', 'Gina Parreno', 'Thu Feb 24 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed Nov 30 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'CDC', 'November 30, 2022', 'November 30, 2022', '79', '90', '80', '80', '36', '6', '5', '100', 'Boy', '30', 'Nov', '2022', 0, ''),
(8, 34, 'Vhong Dimasuay', 'Paghidaet', 'Taloc', 'Mila Cruz', 'Sat Nov 27 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Thu Aug 31 2023 00:00:00 GMT+0800 (Singapore Standard Time)', 'CDC', 'November 30, 2022', 'November 30, 2022', '50', '80', '87', '87', '36', '5', '8', '110', 'Boy', '30', 'Nov', '2022', 0, ''),
(9, 35, 'Jhomme DImasuay', 'Paghidaet', 'Taloc', 'Mabelle Gustillo', 'Mon Nov 15 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Thu Aug 31 2023 00:00:00 GMT+0800 (Singapore Standard Time)', 'CDC', 'November 30, 2022', 'November 30, 2022', '70', '80', '79', '97', '36', '6', '5', '100', 'Boy', '30', 'Nov', '2022', 0, ''),
(10, 36, 'Jugo Esperanza', 'Paghidaet', 'Taloc', 'Mabelle Gustillo', 'Wed Nov 30 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Fri Aug 25 2023 00:00:00 GMT+0800 (Singapore Standard Time)', 'CDC', 'November 30, 2022', 'November 30, 2022', '40', '80', '70', '80', '36', '', '', '', 'Boy', '30', 'Nov', '2022', 0, ''),
(11, 37, 'Jugo Esperanza', 'Paghidaet', 'Taloc', 'Mabelle Gustillo', 'Wed Nov 30 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Fri Aug 25 2023 00:00:00 GMT+0800 (Singapore Standard Time)', 'CDC', 'November 30, 2022', 'November 30, 2022', '40', '80', '70', '80', '36', '', '', '', 'Boy', '30', 'Nov', '2022', 0, ''),
(12, 39, 'Rodulfo Desposado', 'Paghidaet', 'Taloc', 'Nona Obando', 'Wed Dec 22 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Sat Oct 29 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'CDC', 'December 1, 2022', 'December 1, 2022', '60', '80', '79', '87', '36', '6', '5', '110', 'Boy', '01', 'Dec', '2022', 0, ''),
(13, 30, 'Awdawd Awdad', 'addawd', 'awdawd', 'awdawd', 'Tue Dec 13 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed Dec 28 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'awdawd', 'December 12, 2022', 'December 12, 2022', '23', '23', '34', '343', '343', '34', '34', 'dwada', 'Girl', '12', 'Dec', '2022', 0, 'Maternity'),
(14, 8, 'Awdaw Awda', 'awdawd', 'awdawd', 'awdawd', 'Wed Dec 21 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Thu Dec 22 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'dawdaw', 'December 14, 2022', 'December 14, 2022', '34', '43', '23', '44', '34', '23', '5', '111', 'dawda', '14', 'Dec', '2022', 0, 'Maternity'),
(15, 8, 'Dwad Awda', 'awd', 'wad', 'wawd', 'Tue Dec 06 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed Dec 28 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'dawd', 'December 14, 2022', 'December 14, 2022', '23', '42', '23', '24', '43', '23', '23', '2442', 'dawdawda', '14', 'Dec', '2022', 0, 'Maternity'),
(16, 0, 'Dawdawd Awda', 'awdawd', 'awdawd', 'awdawd', 'Mon Dec 13 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Tue Dec 13 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'dawdawd', 'December 14, 2022', 'December 14, 2022', '34', '43', '43', '34', '43', '34', '43', 'wawd', 'awwda', '14', 'Dec', '2022', 0, 'Maternity'),
(17, 0, 'Dawdawd Awdawd', 'awd', 'awd', 'awd', 'Sun Dec 11 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Fri Dec 16 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'adwa', 'Wed Dec 14 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed Dec 14 2022 00:00:00 GMT+0800 (Singapore Standard Time)', '35', '34', '43', '34', '43', '43', '43', '434', 'dadaw', '14', 'Dec', '2022', 0, 'Maternity'),
(18, 0, 'Dawdwa Awdaw', 'awdad', 'awd', 'awdaw', 'Sun Dec 04 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Mon Dec 26 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'awdawd', 'December 14, 2022', 'December 14, 2022', '34', '34', '43', '34', '34', '34', '43', '34', 'wadawdawd', '14', 'Dec', '2022', 0, 'Maternity'),
(19, 0, 'Awdawdw Awdaw', 'awd', 'awd', 'awd', 'Tue Dec 13 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Fri Dec 30 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'awad', 'December 14, 2022', 'December 14, 2022', '', '', '34', '34', '43', '43', '43', '434', 'aawdawd', '14', 'Dec', '2022', 0, 'Maternity'),
(20, 0, 'Awdawdw Awdaw', 'awd', 'awd', 'awd', 'Tue Dec 13 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Fri Dec 30 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'awad', 'December 14, 2022', 'December 14, 2022', '', '', '34', '34', '43', '43', '43', '434', 'aawdawd', '14', 'Dec', '2022', 0, 'Maternity'),
(21, 0, 'Wadawd Awdawd', 'awdawawd', 'awdawd', 'awdawd', 'Tue Dec 13 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Thu Dec 22 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'awdawd', 'Tue Dec 20 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Tue Dec 20 2022 00:00:00 GMT+0800 (Singapore Standard Time)', '24', '4', '23', '23', '23', '23', '23', '344', 'awawdawd', '14', 'Dec', '2022', 0, 'Maternity'),
(22, 54, 'Awdawd Awdawd', 'awdawd', 'awdaw', 'wadaw', 'Sun Dec 04 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed Dec 28 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'wadawd', 'Wed Dec 14 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'Wed Dec 14 2022 00:00:00 GMT+0800 (Singapore Standard Time)', '34', '34', '34', '43', '34', '23', '32', '42', 'wadaawd', '14', 'Dec', '2022', 0, 'Maternity'),
(23, 63, 'John Lavadia', 'Paho', 'Taloc', 'Jose', 'Tue Dec 07 2021 00:00:00 GMT+0800 (Singapore Standard Time)', 'Tue Nov 08 2022 00:00:00 GMT+0800 (Singapore Standard Time)', 'wad', 'December 15, 2022', 'December 15, 2022', '45', '89', '87', '87', '46', '4', '5', '100', 'Boy', '15', 'Dec', '2022', 0, 'Maternity');

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
  `avatar` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `col_month` varchar(255) NOT NULL,
  `col_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `birthday`, `gender`, `username`, `password`, `bhw_id`, `avatar`, `last_login`, `status`, `col_month`, `col_year`) VALUES
(24, 'Nema', 'Menente', '1960-07-14', 'Female', 'BHW-Nema', '$2y$10$a.vXKuzvCEI6yTlYEWaX4uM6vdwei1aQYSTsVDEyohCE0kCL9ijy6', '09-0118', 'avatar/default-woman.png', '01-05-2023', 'Active', 'Oct', '2022'),
(51, 'Emilie', 'Desposado', '1972-09-22', 'Female', 'BHW-Emilie', '$2y$10$deuL2SiLSXXV8Qh1nPcwiuG2jDuQzCWRQLGsh4WpSaU7GAHCQiARe', '09-0119', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(52, 'Ma Lina', 'Carmona', '1975-03-13', 'Female', 'BHW-MaLina', '$2y$10$uVGLziQJ4gkrCQ1cXEFzFOVUuOCYJgcRqQmskYxzqH9ATYbN.JLI6', '09-0120', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(53, 'Andrea', 'Amacio', '1968-06-04', 'Female', 'BHW-Andrea', '$2y$10$DrAzk5fRlgbK.KzGktOFL.XKKTn/bNHpGqmRVCL9BfqvMc7umJBd2', '09-0121', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(54, 'Mila', 'Andrico', '1974-05-07', 'Female', 'BHW-Mila', '$2y$10$7bBOK2BxClAYaDTN8XOb1.ji4GlE2P6Bape3Eei8d.DJno5nbSrM.', '09-0122', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(55, 'wada', 'awdaw', '1945-06-05', 'Female', 'BHW-Wada', '$2y$10$q/vEeaG2yS3Zfsf1vddLj.sY4L87ywQzoPWTKIhBJNCY3k5qzx62S', '09-2323', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(56, 'awdaw', 'awdaw', '1955-06-07', 'Female', 'BHW-Awdaw', '$2y$10$NhEaheoBIPX6L8kVwxPjOONLoC6Q6rhRMWY8NVJxzNFwh4Z7pTn4a', '09-2322', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(57, 'wada', 'adwwad', '1964-05-04', 'Male', 'BHW-Wada', '$2y$10$D3Ig/Ycpztj3osDYWwj12OV3YSvAc5UbGG9cd8tjyH2yAmECVSCdO', '09-2324', 'avatar/default.png', '', 'Active', 'Dec', '2022'),
(58, 'dwa', 'waud', '1960-06-07', 'Female', 'BHW-Dwa', '$2y$10$wd.Uk94vQcSUNZwe0hRuNejUW4Z9WAMMiXE5KUDbeZuEdlfdnfoZK', '90-0099', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(59, 'dwad', 'awdaw', '1945-06-05', 'Female', 'BHW-Dwad', '$2y$10$g7NUMRaYN139fPjbnnkUSeQKI4QjDKN.ycCLPYVoJAOSEH0VLcQBa', '89-2323', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(60, 'dawdaw', 'awdawd', '', 'Female', 'BHW-Dawdaw', '$2y$10$3FG4EBgGKmYkMJdiT8u3TOnkq4MR7fbfhhOTIzsL3ABWYnW4DSXY2', '23-1232', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(61, 'awddawd', 'awdawd', '', 'Female', 'BHW-Awddawd', '$2y$10$eHl1xR6bYGRI322QlkRyIOlVlENQjNgHvyu.LefJ8o7rWknSMBkUu', '23-1312', 'avatar/default-woman.png', '', 'Active', 'Dec', '2022'),
(62, 'daawdawd', 'awdawd', '', 'Male', 'BHW-Daawdawd', '$2y$10$MH41NIIdbDhECp0/S/41veVJ/i2uziQPBzpxs8QRzdUPP1aaBG0Vi', '09-1221', 'avatar/default.png', '', 'Active', 'Dec', '2022'),
(63, 'Marina', 'Palsita', '', 'Female', 'BHW-Marina', '$2y$10$15WHN9VNKOfkAjcTTuj47OQPMh1aRA.W/PPAtXchfBjVH6VlQQSOS', '09-0123', 'avatar/default-woman.png', '12-10-2022', 'Active', 'Dec', '2022'),
(64, 'Alexis', 'Mundayo', '', 'Male', 'BHW-Alexis', '$2y$10$yLBRqBBrN0.Mzw7XB1OieO9wGJ9k5N8O/uqWFR5npXl3IEUmlKhi.', '09-0124', 'avatar/default.png', '12-10-2022', 'Active', 'Dec', '2022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_planning`
--
ALTER TABLE `family_planning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunization`
--
ALTER TABLE `immunization`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fsn` (`fsn`);

--
-- Indexes for table `pending_request`
--
ALTER TABLE `pending_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prenatal`
--
ALTER TABLE `prenatal`
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
-- AUTO_INCREMENT for table `family_planning`
--
ALTER TABLE `family_planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `immunization`
--
ALTER TABLE `immunization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `individual_treatment`
--
ALTER TABLE `individual_treatment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `pending_request`
--
ALTER TABLE `pending_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prenatal`
--
ALTER TABLE `prenatal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
