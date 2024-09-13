-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 12:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_kpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `sem` int(3) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `level` varchar(20) NOT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `userID`, `sem`, `year`, `activity`, `level`, `remark`) VALUES
(9, 3, 2, '2023', 'Netball Monthly Meeting', 'Faculty', 'Participated as a team member'),
(10, 3, 1, '2022', 'Volunteer Work', 'University', 'Assisted in local community cleanup'),
(11, 3, 1, '2022', 'Internship', 'Faculty', 'Worked as an intern at XYZ Company'),
(14, 3, 2, '2023', 'FKI Fun Run Day', 'Faculty', 'Certificate and SMP point'),
(16, 4, 1, '2023', 'FKI Fun Run', 'Faculty', 'Certificate and SDP point');

-- --------------------------------------------------------

--
-- Table structure for table `challenge`
--

CREATE TABLE `challenge` (
  `ch_id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `sem` int(3) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `challenge` text DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `img_path` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challenge`
--

INSERT INTO `challenge` (`ch_id`, `userID`, `sem`, `year`, `challenge`, `plan`, `remark`, `img_path`) VALUES
(15, 3, 1, '2023', 'Coding Challenge', 'Learn a new programming language', 'Excited to improve coding skills', 'google-icon-1024x102'),
(16, 3, 2, '2022', 'Fitness Challenge', 'Daily workout routine', 'Working towards a healthier lifestyle', NULL),
(17, 3, 1, '2022', 'Language Learning Challenge', 'Master a new language', 'Excited to explore a different culture through language study', NULL),
(19, 3, 1, '2023', 'Healthy Cooking Challenge', 'Prepare nutritious meals every day', 'Promote a balanced diet and cooking skills', NULL),
(20, 4, 2, '2022', 'Mobile App Development', 'Build a mobile app using React Native', 'In progress', 'chart-removebg-previ');

-- --------------------------------------------------------

--
-- Table structure for table `kpi`
--

CREATE TABLE `kpi` (
  `kpi_id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `cgpa_myself` decimal(10,2) DEFAULT NULL,
  `faculty` int(11) DEFAULT NULL,
  `university` int(11) DEFAULT NULL,
  `national` int(11) DEFAULT NULL,
  `international` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi`
--

INSERT INTO `kpi` (`kpi_id`, `userID`, `cgpa_myself`, `faculty`, `university`, `national`, `international`) VALUES
(1, 3, 3.55, 2, 2, 1, 1),
(2, 4, 4.00, 4, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kpi_cgpa`
--

CREATE TABLE `kpi_cgpa` (
  `cgpa_id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `sem1year1` decimal(10,2) DEFAULT NULL,
  `sem2year1` decimal(10,2) DEFAULT NULL,
  `sem1year2` decimal(10,2) DEFAULT NULL,
  `sem2year2` decimal(10,2) DEFAULT NULL,
  `sem1year3` decimal(10,2) DEFAULT NULL,
  `sem2year3` decimal(10,2) DEFAULT NULL,
  `sem1year4` decimal(10,2) DEFAULT NULL,
  `sem2year4` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi_cgpa`
--

INSERT INTO `kpi_cgpa` (`cgpa_id`, `userID`, `sem1year1`, `sem2year1`, `sem1year2`, `sem2year2`, `sem1year3`, `sem2year3`, `sem1year4`, `sem2year4`) VALUES
(1, 3, 3.25, 3.20, 3.08, 3.10, 3.20, 3.30, 3.45, 3.50);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(4) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `mentor` varchar(255) DEFAULT NULL,
  `motto` text DEFAULT NULL,
  `profile_img` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `userID`, `username`, `program`, `mentor`, `motto`, `profile_img`) VALUES
(3, 3, 'Nur Atikah binti Ramly', 'Software Engineering', 'Dr James Mountstephen', 'Never give up\r\n', 'mine.png'),
(4, 4, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `matricNo` varchar(20) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPwd` varchar(255) NOT NULL,
  `userRoles` int(11) NOT NULL DEFAULT 2 COMMENT '1 - Admin, 2 - User',
  `registrationDate` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `matricNo`, `userEmail`, `userPwd`, `userRoles`, `registrationDate`) VALUES
(3, 'bi21110112', 'nur@gmail.com', '$2y$10$MyC1RK0K3xlKbbHa0kRiR.uimSKWIOQWqtlHXU3bX5FzHmIo8YCBO', 2, '2023-12-31'),
(4, 'bi21110344', 'wani@gmail.com', '$2y$10$EZvLW9qWc5D7ipxlY0H8QOTxsrpcS.RORNHCg/AV8U.TBwE85MDHu', 2, '2024-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `challenge`
--
ALTER TABLE `challenge`
  ADD PRIMARY KEY (`ch_id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `kpi`
--
ALTER TABLE `kpi`
  ADD PRIMARY KEY (`kpi_id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `kpi_cgpa`
--
ALTER TABLE `kpi_cgpa`
  ADD PRIMARY KEY (`cgpa_id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `challenge`
--
ALTER TABLE `challenge`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kpi_cgpa`
--
ALTER TABLE `kpi_cgpa`
  MODIFY `cgpa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `challenge`
--
ALTER TABLE `challenge`
  ADD CONSTRAINT `challenge_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `kpi_cgpa`
--
ALTER TABLE `kpi_cgpa`
  ADD CONSTRAINT `kpi_cgpa_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
