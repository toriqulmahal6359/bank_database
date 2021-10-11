-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2021 at 02:07 PM
-- Server version: 8.0.23
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_number` varchar(50) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_number`, `branch_name`, `balance`) VALUES
('AC-100', 'Farmgate', 30000),
('AC-101', 'Dhanmondi', 30000),
('AC-102', 'Dhanmondi', 45000),
('AC-103', 'Perryridge', 20000),
('AC-104', 'Perryridge', 25000),
('AC-105', 'Mirpur', 25000),
('AC-106', 'Dhanmondi', 18000),
('AC-107', 'Mirpur', 20000),
('AC-108', 'Perryridge', 30000),
('AC-109', 'Perryridge', 15000),
('AC-110', 'Nasirabad', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `customer_name` varchar(100) NOT NULL,
  `loan_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`customer_name`, `loan_number`) VALUES
('Afzal', 'L-101'),
('Ashraf', 'L-106'),
('Faisal', 'L-108'),
('Jaman', 'L-111'),
('Jamil', 'L-105'),
('Rahim', 'L-103');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_name` varchar(100) NOT NULL,
  `branch_city` varchar(100) NOT NULL,
  `assets` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_name`, `branch_city`, `assets`) VALUES
('Bakshibazar', 'Dhaka', 4000000),
('Dhanmondi', 'Dhaka', 1500000),
('Farmgate', 'Dhaka', 3000000),
('Mirpur', 'Dhaka', 2500000),
('Mohakhali', 'Dhaka', 1900000),
('Nasirabad', 'Chittagong', 3500000),
('Perryridge', 'Dhaka', 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_name` varchar(100) NOT NULL,
  `customer_street` varchar(100) NOT NULL,
  `customer_city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_name`, `customer_street`, `customer_city`) VALUES
('Afzal', 'Wari', 'Dhaka'),
('Ashraf', 'Mirpur-1', 'Dhaka'),
('Faisal', 'Farmgate', 'Dhaka'),
('Jaman', 'Hazaribagh', 'Chittagong'),
('Jamil', 'Kazipara', 'Dhaka'),
('Karim', 'Mirpur-10', 'Dhaka'),
('Nurul', 'Agargaon', 'Dhaka'),
('Rahat', 'Banani', 'Dhaka'),
('Rahim', 'Dhanmondi-27', 'Dhaka'),
('Raihan', 'Taltola', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `depositor`
--

CREATE TABLE `depositor` (
  `customer_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `depositor`
--

INSERT INTO `depositor` (`customer_name`, `account_number`) VALUES
('Afzal', 'AC-105'),
('Ashraf', 'AC-102'),
('Faisal', 'AC-106'),
('Jaman', 'AC-110'),
('Jamil', 'AC-100'),
('Karim', 'AC-109'),
('Nurul', 'AC-103'),
('Rahat', 'AC-107'),
('Rahim', 'AC-108'),
('Raihan', 'AC-104');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_number` varchar(50) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_number`, `branch_name`, `amount`) VALUES
('L-101', 'Mirpur', 25000),
('L-102', 'Perryridge', 30000),
('L-103', 'Dhannmondi', 15000),
('L-104', 'Perryridge', 20000),
('L-105', 'Perryridge', 50000),
('L-106', 'Dhanmondi', 15000),
('L-107', 'Farmgate', 10000),
('L-108', 'Perryridge', 10000),
('L-109', 'Mirpur', 8000),
('L-111', 'Agrabad', 12000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_number`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`customer_name`,`loan_number`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_name`);

--
-- Indexes for table `depositor`
--
ALTER TABLE `depositor`
  ADD PRIMARY KEY (`customer_name`,`account_number`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
