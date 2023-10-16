-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 03:04 AM
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
-- Database: `attendance/payroll_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_time_creeated` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date_time_creeated`, `date_time_updated`) VALUES
(1, 'admin', '$2y$10$7/iSfQk7ObrYa1HIXA1L1eBNByLIWnJ57j9iebn8qfUqMCeVEjQMy', '2022-10-16 18:24:58', '2022-10-16 18:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(100) NOT NULL,
  `employee_id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time_in` time NOT NULL DEFAULT current_timestamp(),
  `lunch_in` time NOT NULL,
  `lunch_out` time NOT NULL,
  `time_out` time NOT NULL DEFAULT current_timestamp(),
  `day` varchar(100) NOT NULL,
  `hours` int(100) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `lunch_in`, `lunch_out`, `time_out`, `day`, `hours`, `date_time_created`, `date_time_updated`) VALUES
(7, 20228035, 'Oct-19-2022', '08:00:00', '12:00:00', '13:00:00', '18:00:00', 'Wednesday', 8, '2022-10-19 10:10:00', '2022-10-19 10:10:00'),
(9, 20228035, 'Oct-20-2022', '08:00:00', '12:00:00', '13:00:00', '18:00:00', 'Thursday', 8, '2022-10-20 11:55:00', '2022-10-20 11:55:00'),
(10, 20228035, 'Oct-21-2022', '08:00:00', '12:00:00', '13:00:00', '18:00:00', 'Friday', 8, '2022-10-21 11:20:00', '2022-10-21 11:20:00'),
(12, 20228035, 'Oct-22-2022', '08:00:00', '12:00:00', '13:00:00', '18:00:00', 'Saturday', 8, '2022-10-22 03:10:00', '2022-10-22 03:10:00'),
(13, 20228035, 'Oct-26-2022', '08:00:00', '12:00:00', '13:00:00', '18:00:00', 'Wednesday', 8, '2022-10-26 11:13:00', '2022-10-26 11:13:00'),
(17, 20228035, 'Oct-28-2022', '08:00:00', '12:00:00', '13:00:00', '18:00:00', 'Friday', 8, '2022-10-28 08:47:00', '2022-10-28 08:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(50) NOT NULL,
  `employee_id` int(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` bigint(225) NOT NULL,
  `sss_id` varchar(100) NOT NULL,
  `pagibig_id` varchar(100) NOT NULL,
  `philhealth_id` varchar(100) NOT NULL,
  `wage` int(100) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `picture`, `first_name`, `middle_name`, `last_name`, `birth_date`, `email`, `contact_number`, `sss_id`, `pagibig_id`, `philhealth_id`, `wage`, `date_time_created`, `date_time_updated`) VALUES
(3, 20228035, '293634566_337767848567716_1948189264216432352_n.jpg', ' Thaddeus Jude ', 'Angeles', 'Gamit', '2001-11-26', 'thaddeusgamit31@gmail.com', 9127881465, '1234567890', '0987654321', '1026571498', 85, '2022-10-18 02:09:00', '2022-11-06 03:59:00'),
(8, 20224492, 'ERD.jpg', 'Odessa', 'Bethany Charles', 'Rowland', '2022-10-23', 'cytiqy@mailinator.com', 68, 'Accusamus facere dol', 'Adipisicing impedit', '', 75, '2022-11-06 02:47:00', '2022-11-06 02:47:00'),
(9, 20222525, 'ERD.jpg', 'Orli', 'Adam Myers', 'Hinton', '2010-08-25', 'runoj@mailinator.com', 2147483647, 'Consequatur dolorem', 'Ad debitis sed quia ', 'Consequatur recusand', 80, '2022-11-06 02:53:00', '2022-11-06 02:53:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
