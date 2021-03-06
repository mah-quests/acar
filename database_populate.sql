-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2019 at 08:48 PM
-- Server version: 5.7.25
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";

--
-- Database: `ewc`
--

-- --------------------------------------------------------

--
-- Table structure for table `absenteeism_stats`
--

CREATE TABLE `absenteeism_stats` (
  `id` int(25) NOT NULL,
  `full_names` varchar(20) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `hosting_company` varchar(20) NOT NULL,
  `days_absent` varchar(20) NOT NULL,
  `gender` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(25) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `admin_type` varchar(10) NOT NULL,
  `id_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `user_name`, `passwd`, `admin_type`, `id_number`) VALUES
(1, 'administrator', 'dc647eb65e6711e155375218212b3964', 'super', '111111111111');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id_number` varchar(15) NOT NULL,
  `account_owner` varchar(30) NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `branch_name` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `branch_code` varchar(10) NOT NULL,
  `account_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_infomation`
--

CREATE TABLE `business_infomation` (
  `business_name` varchar(50) NOT NULL,
  `ck_number` varchar(15) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `id` int(11) NOT NULL,
  `city` varchar(200) NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `sdl_number` varchar(10) NOT NULL,
  `paye_number` varchar(10) NOT NULL,
  `uif_number` varchar(10) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_infomation`
--

INSERT INTO `business_infomation` (`business_name`, `ck_number`, `address1`, `address2`, `id`, `city`, `postal_code`, `phone_number`, `email`, `web`, `sdl_number`, `paye_number`, `uif_number`, `updated_at`) VALUES
('Ekurhuleni West College', '2012/206601/07', 'Driehoek Road  & Sol St', 'North Germiston', 1, 'Germiston', '1400', '011 876 6900', 'info@ewc.edu.za', 'http://www.ewc.edu.za', '', '', '', '2019-05-22 20:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(10) NOT NULL,
  `first_names` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `hosting_company` varchar(100) DEFAULT NULL,
  `supervisor_name` varchar(30) NOT NULL,
  `supervisor_email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date_of_birth` date NOT NULL,
  `id_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `supervisor_phone` varchar(30) NOT NULL,
  `hosting_address` varchar(80) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `candidate_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `graph_details`
--

CREATE TABLE `graph_details` (
  `id` int(25) NOT NULL,
  `month_name` varchar(20) NOT NULL,
  `expected_checks` varchar(50) NOT NULL,
  `actual_check_ins` varchar(20) NOT NULL,
  `actual_check_outs` varchar(20) NOT NULL,
  `success_percentage` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graph_details`
--

INSERT INTO `graph_details` (`id`, `month_name`, `expected_checks`, `actual_check_ins`, `actual_check_outs`, `success_percentage`) VALUES
(1, 'Jun-19', '0', '0', '0', '0.00'),
(2, 'Jul-19', '0', '0', '0', '0.00'),
(3, 'Aug-19', '0', '0', '0', '0.00'),
(4, 'Sep-19', '0', '0', '0', '0.00'),
(5, 'Oct-19', '0', '0', '0', '0.00'),
(6, 'Nov-19', '0', '0', '0', '0.00'),
(7, 'Dec-19', '0', '0', '0', '0.00'),
(8, 'Jan-20', '0', '0', '0', '0.00'),
(9, 'Feb-20', '0', '0', '0', '0.00'),
(10, 'Mar-20', '0', '0', '0', '0.00'),
(11, 'Apr-20', '0', '0', '0', '0.00'),
(12, 'May-20', '0', '0', '0', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `internship_details`
--

CREATE TABLE `internship_details` (
  `id` int(11) NOT NULL,
  `id_number` varchar(15) NOT NULL,
  `employment_date` date NOT NULL,
  `position` varchar(50) NOT NULL,
  `department` varchar(20) NOT NULL,
  `tax_ref` varchar(10) DEFAULT NULL,
  `salary_amount` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payslips`
--

CREATE TABLE `payslips` (
  `id` int(11) NOT NULL,
  `id_number` varchar(15) NOT NULL,
  `gross` varchar(11) NOT NULL DEFAULT '0',
  `commission` varchar(11) NOT NULL DEFAULT '0',
  `overtime` varchar(11) NOT NULL DEFAULT '0',
  `bonus` varchar(11) NOT NULL DEFAULT '0',
  `other` varchar(11) NOT NULL DEFAULT '0',
  `paye_amount` varchar(11) NOT NULL DEFAULT '0',
  `uif_amount` varchar(11) NOT NULL DEFAULT '0',
  `nett_pay` varchar(11) NOT NULL,
  `payslip_date` date NOT NULL,
  `generated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_leave` varchar(100) NOT NULL DEFAULT '0',
  `rate_per_day` varchar(25) NOT NULL,
  `sdl_amount` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `time_in`
--

CREATE TABLE `time_in` (
  `id` int(10) NOT NULL,
  `first_names` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `hosting_company` varchar(50) NOT NULL,
  `supervisor_name` varchar(50) NOT NULL,
  `check_in_date` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_number` varchar(20) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `check_in_time` varchar(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `time_out`
--

CREATE TABLE `time_out` (
  `id` int(10) NOT NULL,
  `first_names` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `hosting_company` varchar(50) NOT NULL,
  `supervisor_name` varchar(50) NOT NULL,
  `check_out_date` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_number` varchar(20) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `check_out_time` varchar(20) NOT NULL,
  `ip_address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absenteeism_stats`
--
ALTER TABLE `absenteeism_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UserNameUnique` (`user_name`),
  ADD UNIQUE KEY `IDNUmber` (`id_number`) USING BTREE;

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `IDNumber` (`id_number`);

--
-- Indexes for table `business_infomation`
--
ALTER TABLE `business_infomation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `IDNumber` (`id_number`);

--
-- Indexes for table `graph_details`
--
ALTER TABLE `graph_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internship_details`
--
ALTER TABLE `internship_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_number` (`id_number`);

--
-- Indexes for table `payslips`
--
ALTER TABLE `payslips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_number` (`id_number`);

--
-- Indexes for table `time_in`
--
ALTER TABLE `time_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDNumber` (`id_number`);

--
-- Indexes for table `time_out`
--
ALTER TABLE `time_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDNumber` (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absenteeism_stats`
--
ALTER TABLE `absenteeism_stats`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_infomation`
--
ALTER TABLE `business_infomation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `graph_details`
--
ALTER TABLE `graph_details`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `internship_details`
--
ALTER TABLE `internship_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payslips`
--
ALTER TABLE `payslips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_in`
--
ALTER TABLE `time_in`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_out`
--
ALTER TABLE `time_out`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `bank_account_ibfk_1` FOREIGN KEY (`id_number`) REFERENCES `candidates` (`id_number`);

--
-- Constraints for table `internship_details`
--
ALTER TABLE `internship_details`
  ADD CONSTRAINT `internship_details_ibfk_1` FOREIGN KEY (`id_number`) REFERENCES `candidates` (`id_number`);

--
-- Constraints for table `payslips`
--
ALTER TABLE `payslips`
  ADD CONSTRAINT `payslips_ibfk_1` FOREIGN KEY (`id_number`) REFERENCES `candidates` (`id_number`);
