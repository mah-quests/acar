-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2019 at 09:31 AM
-- Server version: 5.7.25
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
(1, 'administrator', 'dc647eb65e6711e155375218212b3964', 'super', '111111111111'),
(2, 'thenjiwe.base', '482c811da5d5b4bc6d497ffa98491e38', 'candidate', '9810110208082'),
(8, 'thato.mohono', '5511cf23120e545d66036be92c04e6ae', 'candidate', '8007084563089'),
(9, 'judah.mohono', '482c811da5d5b4bc6d497ffa98491e38', 'candidate', '1008035727080');

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

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `first_names`, `last_name`, `gender`, `hosting_company`, `supervisor_name`, `supervisor_email`, `phone`, `email`, `date_of_birth`, `id_number`, `created_at`, `updated_at`, `supervisor_phone`, `hosting_address`, `user_name`, `candidate_address`) VALUES
(5, 'Thato', 'Mohono', 'Male', 'MaH Quests Enterprises (Pty) Ltd', 'Mang Mang', 'thato@mahcc.co.za', '27825561420', 'thato@mahcc.co.za', '2008-07-08', '8007084563089', '2019-06-05 07:23:55', '2019-06-05 07:23:55', '112171000', 'Shop 12, Newtown Mall,\r\n77 Harrison St,                                         ', 'thato.mohono', '136 2nd Street, Halfway House,                                                  '),
(6, 'Judah', 'Mohono', 'Male', 'MaH Quests Enterprises (Pty) Ltd', 'Madibuseng', 'madibuseng@mahquests.co.za', '082 820 4383', 'juhad@mahcc.co.za', '2010-08-13', '1008035727080', '2019-05-28 19:59:53', '2019-05-28 19:59:53', '0710713452', '136 2nd Road Street, Halfway House', 'judah.mohono', '136 2nd Street, Halfway House,');

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
(1, 'Jun-19', '38', '0', '0', '0.00'),
(2, 'Jul-19', '46', '0', '0', '0.00'),
(3, 'Aug-19', '44', '0', '0', '0.00'),
(4, 'Sep-19', '40', '0', '0', '0.00'),
(5, 'Oct-19', '46', '0', '0', '0.00'),
(6, 'Nov-19', '46', '0', '0', '0.00'),
(7, 'Dec-19', '38', '0', '0', '0.00'),
(8, 'Jan-20', '44', '0', '0', '0.00'),
(9, 'Feb-20', '40', '0', '0', '0.00'),
(10, 'Mar-20', '44', '0', '0', '0.00'),
(11, 'Apr-20', '38', '0', '0', '0.00'),
(12, 'May-20', '40', '0', '0', '0.00');

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

--
-- Dumping data for table `internship_details`
--

INSERT INTO `internship_details` (`id`, `id_number`, `employment_date`, `position`, `department`, `tax_ref`, `salary_amount`) VALUES
(7, '8007084563089', '2002-05-10', 'Sales Marketing', 'Sales Marketing', '', '3500'),
(8, '8007084563089', '2002-05-10', 'Sales Marketing', 'Sales Marketing', '', '3500'),
(9, '8007084563089', '2002-05-10', 'Sales Marketing', 'Sales Marketing', '', '3500'),
(10, '8007084563089', '2002-05-10', 'Sales Marketing', 'Sales Marketing', '', '3500'),
(11, '1008035727080', '2019-04-01', 'Sales', 'IT', '', '5000');

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
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `graph_details`
--
ALTER TABLE `graph_details`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `internship_details`
--
ALTER TABLE `internship_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
