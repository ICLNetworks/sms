-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2025 at 09:08 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'admin', '$2y$10$5R.1YtnwxkKmO4czIhvrFOaPyEOfyK41x4qTSzxn072./TnMQwf8C', '2025-09-08 12:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `adno` varchar(250) NOT NULL,
  `ayear` varchar(250) NOT NULL,
  `emisno` varchar(250) NOT NULL,
  `std` varchar(100) NOT NULL,
  `doa` date NOT NULL,
  `astandard` varchar(255) NOT NULL,
  `name` varchar(250) NOT NULL,
  `name1` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `fname1` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `mname1` varchar(100) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `comm` varchar(250) NOT NULL,
  `subc` varchar(250) NOT NULL,
  `pschool` varchar(250) NOT NULL,
  `national` varchar(250) NOT NULL,
  `religion` varchar(250) NOT NULL,
  `dist` varchar(250) NOT NULL,
  `van` varchar(250) NOT NULL,
  `bg` varchar(250) NOT NULL,
  `occ` varchar(250) NOT NULL,
  `income` varchar(250) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `mobileno` varchar(250) NOT NULL,
  `tags` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `timestamp` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `adno`, `ayear`, `emisno`, `std`, `doa`, `astandard`, `name`, `name1`, `fname`, `fname1`, `mname`, `mname1`, `gender`, `dob`, `comm`, `subc`, `pschool`, `national`, `religion`, `dist`, `van`, `bg`, `occ`, `income`, `address`, `mobileno`, `tags`, `photo`, `status`, `timestamp`) VALUES
(1, '1001', '2025', '1234567890', 'UKG', '2022-12-31', '', 'JEGANNATHAN P C', 'fghjklmnbvftyui', 'kjhgfdsrtyuj', 'jjlkjoioijoij', 'ghgugijbjvjvhjbjhjhvih', 'hoouoiuoi', 'Male', '2006-09-17', 'BC', 'Sourashtra', 'SSS', 'Indian', 'Hindu', 'Ramanathapuram', '', 'A1B+', '', '', 'AJHKHKHKhk', '1234567890', '1. & 2.', 'uploads/360_F_439646649_qblIzOC8xrNyBR2pgbCuC60gIKoMZJzG.jpg', 'Fees Not Paid', '');

-- --------------------------------------------------------

--
-- Table structure for table `school_expenses`
--

CREATE TABLE `school_expenses` (
  `bill_no` varchar(50) NOT NULL,
  `expense_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `billtype` enum('Credit','Debit') NOT NULL DEFAULT 'Debit',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_type` enum('Cash','GPay') NOT NULL DEFAULT 'Cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_expenses`
--

INSERT INTO `school_expenses` (`bill_no`, `expense_date`, `description`, `amount`, `billtype`, `created_at`, `payment_type`) VALUES
('SMSBill0001', '2025-10-04', 'Student Fee - 1001 - JEGANNATHAN P C', '10.00', 'Credit', '2025-10-04 18:44:43', 'Cash'),
('SMSBill0002', '2025-10-04', 'Testing', '1000.00', 'Credit', '2025-10-04 18:55:01', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `sclfeedetails`
--

CREATE TABLE `sclfeedetails` (
  `id` int(11) NOT NULL,
  `standard` varchar(50) NOT NULL,
  `study_year` varchar(15) NOT NULL,
  `total_fee` decimal(10,2) NOT NULL,
  `discount_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sclfeedetails`
--

INSERT INTO `sclfeedetails` (`id`, `standard`, `study_year`, `total_fee`, `discount_fee`) VALUES
(2, 'LKG', '2025-2026', '12150.00', '7250.00'),
(3, 'UKG', '2025-2026', '12150.00', '7250.00'),
(4, 'I Std', '2025-2026', '12600.00', '7500.00'),
(5, 'II Std', '2025-2026', '12600.00', '7500.00'),
(6, 'III Std', '2025-2026', '12600.00', '7500.00'),
(7, 'IV Std', '2025-2026', '12600.00', '7500.00'),
(8, 'V Std', '2025-2026', '12600.00', '7500.00'),
(9, 'VI Std', '2025-2026', '15150.00', '9100.00'),
(10, 'VII Std', '2025-2026', '15150.00', '9100.00'),
(11, 'VIII Std', '2025-2026', '15150.00', '9100.00'),
(12, 'IX Std', '2025-2026', '17000.00', '10200.00'),
(13, 'X Std', '2025-2026', '17250.00', '10500.00');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(50) DEFAULT NULL,
  `admission_id` varchar(255) NOT NULL,
  `fee_type` enum('van','study') NOT NULL,
  `pending_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_date` date NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_fees`
--

INSERT INTO `student_fees` (`id`, `bill_no`, `admission_id`, `fee_type`, `pending_amount`, `paid_amount`, `paid_date`, `created_date`) VALUES
(1, NULL, '1001', 'study', '7300.00', '0.00', '2022-12-31', '2025-10-04 17:36:08'),
(2, NULL, '1001', 'van', '50.00', '0.00', '2022-12-31', '2025-10-04 17:36:08'),
(8, 'SMSBill0001', '1001', 'study', '7290.00', '10.00', '2025-10-04', '2025-10-04 18:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `stu_basic_info`
--

CREATE TABLE `stu_basic_info` (
  `id` int(11) NOT NULL,
  `admission_id` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `emis_number` varchar(50) DEFAULT NULL,
  `standard` varchar(20) DEFAULT NULL,
  `full_school_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pending_school_fee` decimal(10,2) NOT NULL,
  `school_fee_pd` date DEFAULT NULL,
  `last_year_pending_scl` decimal(10,2) NOT NULL DEFAULT 0.00,
  `full_van_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pending_van_fee` decimal(10,2) NOT NULL,
  `van_fee_pd` date DEFAULT NULL,
  `last_year_pending_van` decimal(10,2) NOT NULL DEFAULT 0.00,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stu_basic_info`
--

INSERT INTO `stu_basic_info` (`id`, `admission_id`, `student_name`, `father_name`, `mother_name`, `emis_number`, `standard`, `full_school_fee`, `pending_school_fee`, `school_fee_pd`, `last_year_pending_scl`, `full_van_fee`, `pending_van_fee`, `van_fee_pd`, `last_year_pending_van`, `photo`) VALUES
(1, '1001', 'JEGANNATHAN P C', 'kjhgfdsrtyuj', 'ghgugijbjvjvhjbjhjhvih', '1234567890', 'UKG', '7250.00', '7250.00', '2025-10-04', '40.00', '0.00', '0.00', NULL, '50.00', 'uploads/360_F_439646649_qblIzOC8xrNyBR2pgbCuC60gIKoMZJzG.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vanfeedetails`
--

CREATE TABLE `vanfeedetails` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `study_year` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vanfeedetails`
--

INSERT INTO `vanfeedetails` (`id`, `city`, `study_year`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Emaneswaram', '2025-2026', '4500.00', '2025-09-09 15:41:46', '2025-09-11 07:03:56'),
(5, 'Paramakudi', '2025-2026', '16000.00', '2025-09-11 07:36:42', '2025-09-11 07:36:42'),
(6, 'Nainar Kovil', '2025-2026', '9850.00', '2025-09-11 12:10:57', '2025-09-11 12:10:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adno` (`adno`);

--
-- Indexes for table `school_expenses`
--
ALTER TABLE `school_expenses`
  ADD UNIQUE KEY `bill_no` (`bill_no`);

--
-- Indexes for table `sclfeedetails`
--
ALTER TABLE `sclfeedetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_sclfeedetails` (`standard`,`study_year`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stu_basic_info`
--
ALTER TABLE `stu_basic_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vanfeedetails`
--
ALTER TABLE `vanfeedetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_vanfeedetails` (`city`,`study_year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sclfeedetails`
--
ALTER TABLE `sclfeedetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stu_basic_info`
--
ALTER TABLE `stu_basic_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vanfeedetails`
--
ALTER TABLE `vanfeedetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
