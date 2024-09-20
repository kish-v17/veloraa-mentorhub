-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 06:46 AM
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
-- Database: `veloraa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow_tbl`
--

CREATE TABLE `follow_tbl` (
  `F_MentorId` int(11) DEFAULT NULL,
  `F_FollowedById` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `U_Id` int(11) NOT NULL,
  `U_Fnm` varchar(60) NOT NULL,
  `U_Email` varchar(60) NOT NULL,
  `U_Phn` varchar(60) NOT NULL,
  `U_Pwd` varchar(255) NOT NULL,
  `U_City` varchar(60) NOT NULL,
  `U_State` varchar(60) NOT NULL,
  `U_Country` varchar(60) NOT NULL,
  `U_About` text NOT NULL,
  `U_GitHub` varchar(60) NOT NULL,
  `U_LinkedIn` varchar(60) NOT NULL,
  `U_Skill` text NOT NULL,
  `U_Profile` text NOT NULL,
  `U_Status` tinyint(1) NOT NULL,
  `U_Fee` decimal(10,0) NOT NULL,
  `U_Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`U_Id`, `U_Fnm`, `U_Email`, `U_Phn`, `U_Pwd`, `U_City`, `U_State`, `U_Country`, `U_About`, `U_GitHub`, `U_LinkedIn`, `U_Skill`, `U_Profile`, `U_Status`, `U_Fee`, `U_Role`) VALUES
(1, 'rixit', 'rixit05@gmail.com', '', '$2y$10$mT3lJGYokfyJQUrlBtg1DeFfsLbBF97tX0RgWjfUj1O72BxO3oBE6', '', '', '', '', '', '', '', '', 0, '0', 3),
(2, 'Abhi Dudhagara', 'abhi07@gmail.com', '', '$2y$10$51WPcgYgqwHky2.nNJwBYuk0brkDhKVG0yZnRy3NvtLOn4sqtAW4m', '', '', '', '', '', '', '', '', 0, '0', 3),
(3, 'Kishan Vekariya', 'kish.v07@gmail.com', '', '$2y$10$AhbtevanSdLA2m5v4.oIXeZ0VEhymmLaaN5ZWPgrOrgnjAtS1hAOS', '', '', '', '', '', '', '', '', 0, '0', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow_tbl`
--
ALTER TABLE `follow_tbl`
  ADD KEY `F_MentorId` (`F_MentorId`),
  ADD KEY `F_FollowedById` (`F_FollowedById`);

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
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `U_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follow_tbl`
--
ALTER TABLE `follow_tbl`
  ADD CONSTRAINT `follow_tbl_ibfk_1` FOREIGN KEY (`F_MentorId`) REFERENCES `user_tbl` (`U_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_tbl_ibfk_2` FOREIGN KEY (`F_FollowedById`) REFERENCES `user_tbl` (`U_Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
