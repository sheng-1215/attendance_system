-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 10:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngweisheng`
--

-- --------------------------------------------------------

--
-- Table structure for table `ws_attendance`
--

CREATE TABLE `ws_attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `8am_checkin` time NOT NULL,
  `12am_checkout` time NOT NULL,
  `1pm_checkin` time NOT NULL,
  `5pm_checkout` time NOT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ws_attendance`
--

INSERT INTO `ws_attendance` (`id`, `student_id`, `8am_checkin`, `12am_checkout`, `1pm_checkin`, `5pm_checkout`, `date`) VALUES
(29, 1, '09:03:04', '00:00:00', '15:50:59', '00:00:00', '2024-05-21'),
(30, 3, '10:08:24', '00:00:00', '13:23:18', '00:00:00', '2024-05-21'),
(31, 4, '00:00:00', '00:00:00', '13:30:49', '00:00:00', '2024-05-21'),
(33, 2, '00:00:00', '00:00:00', '15:50:13', '00:00:00', '2024-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `ws_students`
--

CREATE TABLE `ws_students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(522) NOT NULL,
  `card_number` varchar(522) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ws_students`
--

INSERT INTO `ws_students` (`student_id`, `student_name`, `card_number`) VALUES
(1, 'ngweisheng', '0010118447'),
(2, 'khoojiahan', '0010951825'),
(3, 'tanlikpin', '04020397837'),
(4, 'Tanjianlin', '0016607346');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ws_attendance`
--
ALTER TABLE `ws_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ws_students`
--
ALTER TABLE `ws_students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ws_attendance`
--
ALTER TABLE `ws_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ws_students`
--
ALTER TABLE `ws_students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
