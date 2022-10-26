-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 05:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel_tool`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_account`
--

CREATE TABLE `active_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `request_date` varchar(50) NOT NULL,
  `is_active` varchar(11) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book_room`
--

CREATE TABLE `book_room` (
  `id` int(11) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `room_num` varchar(50) NOT NULL,
  `seater` varchar(50) NOT NULL,
  `total_duration` varchar(255) NOT NULL,
  `food_status` varchar(20) NOT NULL,
  `fees_per_month` varchar(50) NOT NULL,
  `advance_fees` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `num_seat` varchar(50) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `guardian_relation` varchar(50) NOT NULL,
  `guardian_number` varchar(50) NOT NULL,
  `current_address` varchar(200) NOT NULL,
  `current_city` varchar(50) NOT NULL,
  `current_state` varchar(50) NOT NULL,
  `current_pincode` varchar(50) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `permanent_city` varchar(50) NOT NULL,
  `permanent_state` varchar(50) NOT NULL,
  `permanent_pincode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Admin Group'),
(2, 'super admin', 'Super Admin Group'),
(3, 'general', 'General Group');

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `id` int(11) NOT NULL,
  `room_num` varchar(255) NOT NULL,
  `seater` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `avail_seat` varchar(50) NOT NULL,
  `fees` varchar(255) NOT NULL,
  `lunch_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` varchar(11) DEFAULT '3',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` varchar(255) NOT NULL,
  `is_active` varchar(20) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `gender`, `contact_no`, `password`, `reg_date`, `is_active`) VALUES
(1, '2', 'velappan', 'hello world', 'admin@gmail.com', 'male', '9597493545', '$2y$10$bc7DRLMePrHrwUJOZKgTsum3eiYi.rBQxrM9pax5ez9a6n6ih1Qj.', '2022-09-24', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_account`
--
ALTER TABLE `active_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `book_room`
--
ALTER TABLE `book_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_details`
--
ALTER TABLE `room_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_account`
--
ALTER TABLE `active_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_room`
--
ALTER TABLE `book_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_details`
--
ALTER TABLE `room_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
