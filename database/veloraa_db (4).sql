-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2024 at 06:07 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veloraa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `calls_tbl`
--

CREATE TABLE `calls_tbl` (
  `id` int NOT NULL,
  `mentee_id` int NOT NULL,
  `mentor_id` int NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `calls_tbl`
--

INSERT INTO `calls_tbl` (`id`, `mentee_id`, `mentor_id`, `room_id`, `created_at`) VALUES
(1, 1, 1, 'Room-cda66a3d65a86182', '2024-09-20 05:13:36'),
(2, 1, 1, 'Room-8c1fab657dac68a5', '2024-09-20 05:14:47'),
(3, 1, 1, 'Room-bd99f654808388fa', '2024-09-20 05:16:25'),
(4, 1, 2, 'Room-beeccfa66e692cd5', '2024-09-20 05:22:35'),
(5, 1, 3, 'Room-c56f528f0a2d7640', '2024-09-20 05:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `follow_tbl`
--

CREATE TABLE `follow_tbl` (
  `F_MentorId` int DEFAULT NULL,
  `F_FollowedById` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `U_Id` int NOT NULL,
  `U_Fnm` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_Email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_Phn` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_Pwd` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_City` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_State` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_Country` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_About` text COLLATE utf8mb4_general_ci,
  `U_GitHub` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_LinkedIn` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_Skill` text COLLATE utf8mb4_general_ci,
  `U_Profile` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `U_Status` tinyint(1) DEFAULT '0',
  `U_Fee` decimal(10,2) DEFAULT '0.00',
  `U_Role` tinyint(1) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`U_Id`, `U_Fnm`, `U_Email`, `U_Phn`, `U_Pwd`, `U_City`, `U_State`, `U_Country`, `U_About`, `U_GitHub`, `U_LinkedIn`, `U_Skill`, `U_Profile`, `U_Status`, `U_Fee`, `U_Role`) VALUES
(1, 'Rixit', 'janujkumar409@rku.ac.in', NULL, '$2y$10$5Y.w0lgPqY2Rn3z7vIXuz.sidDlkQGVG95Tgew9HxUWj19Pei/GK2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.00, 3),
(2, 'Kishan', 'kishan@gmail.com', '9090909090', '$2y$10$5Y.w0lgPqY2Rn3z7vIXuz.sidDlkQGVG95Tgew9HxUWj19Pei/GK2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.00, 2),
(3, 'Mentor', 'mentor@gmail.com', NULL, '$2y$10$4VEWJJRKSyMqFd1H/Wy.L.KCcr4I6p.AVyZWmJrgVFLIR3wMZ9Adu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.00, 2),
(4, 'mentee', 'mentee@gmail.com', NULL, '$2y$10$XzWReqEMHXnrtUuvA8/RJu1FHsjLSjIvaeZyQDn06O24bHIo/fspa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.00, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calls_tbl`
--
ALTER TABLE `calls_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_id` (`room_id`),
  ADD KEY `mentee_id` (`mentee_id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`U_Id`),
  ADD UNIQUE KEY `unique_email` (`U_Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calls_tbl`
--
ALTER TABLE `calls_tbl`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `U_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calls_tbl`
--
ALTER TABLE `calls_tbl`
  ADD CONSTRAINT `calls_tbl_ibfk_1` FOREIGN KEY (`mentee_id`) REFERENCES `user_tbl` (`U_Id`),
  ADD CONSTRAINT `calls_tbl_ibfk_2` FOREIGN KEY (`mentor_id`) REFERENCES `user_tbl` (`U_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
