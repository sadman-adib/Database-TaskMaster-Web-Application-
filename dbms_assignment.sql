-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 08:29 PM
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
-- Database: `dbms_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `task_name`, `completed`, `created_at`) VALUES
(10, 3, 'electrical', 0, '2024-03-28 16:56:08'),
(13, 3, 'Roofing', 1, '2024-03-28 18:09:06'),
(15, 3, 'eating', 1, '2024-03-28 18:46:57'),
(16, 15, 'drinking', 0, '2024-03-29 08:51:24'),
(17, 15, 'furnishing', 0, '2024-03-29 08:51:40'),
(18, 15, 'travelling', 1, '2024-03-29 08:51:54'),
(19, 16, 'doing hw', 0, '2024-03-29 10:13:49'),
(20, 17, 'washing', 1, '2024-04-02 20:21:13'),
(21, 16, 'doing assignment', 1, '2024-04-02 20:43:48'),
(22, 19, 'doing hw', 1, '2024-04-03 05:20:31'),
(23, 20, 'gardening', 1, '2024-04-03 11:45:30'),
(24, 21, 'eating', 1, '2024-04-17 05:52:18'),
(25, 24, 'sleeping', 1, '2024-04-17 05:59:36'),
(26, 25, 'walking', 1, '2024-04-17 06:49:16'),
(27, 25, 'eating', 0, '2024-04-17 06:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(2, 'Adib', '1234'),
(3, 'robin', '1234'),
(4, 'rahim', '1234'),
(5, 'sukumar', '1234'),
(6, 'shankar', '1234'),
(7, 'allu', '1234'),
(14, 'sakib', '1234'),
(15, 'arjun', '2345'),
(16, 'sraboni', '1234'),
(17, 'nabila', '1234'),
(19, 'zobaer', '1234'),
(20, 'ahsanul kabir', 'samir007'),
(21, 'mim', '1234'),
(22, 'mimma', '12345'),
(24, 'shammi', '2222'),
(25, 'salman', '1111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
