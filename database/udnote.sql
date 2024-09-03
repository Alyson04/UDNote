-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 02, 2024 at 05:20 PM
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
-- Database: `udnote`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_ID`, `title`, `description`, `date`) VALUES
(1, 3, 'update test', 'try again', '2024-08-28 08:53:56'),
(2, 3, 'holy shit is this real?', 'WTF GUMANA KA NA DIN SA WAKAS', '2024-08-19 14:15:04'),
(3, 18, 'working na ba?', 'is this true?', '2024-08-19 11:27:19'),
(4, 19, 'test', 'testing', '2024-08-19 11:29:13'),
(8, 3, 'gagana kaya ulit', 'try natin', '2024-08-19 14:35:48'),
(12, 3, 'nice one', 'gumagana na siya pwede na ako matulog ng mahimbing', '2024-08-19 14:37:05'),
(13, 3, 'test', 'asdasada', '2024-08-22 10:04:04'),
(14, 3, 'asdas', 'dsadasdas', '2024-08-22 14:04:44'),
(15, 21, 'test', 'testingsss', '2024-08-29 14:43:55'),
(16, 21, 'asdasda', 'dasdasd', '2024-08-29 14:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expiry`) VALUES
(1, 3, '881bc8aff429eaf294daa7ad98d89fa127e5ec66075f62fbeed899fc6b239113b4bd2cbbd3653ee37a2d4e2573036d9b814a', '2024-08-26 22:44:52'),
(36, 21, '66618af27425dc7cbb93e92f9ed83e562af1bfffc3bcd360ad9a6dff2c24a70b7c72df80f091ef3fa8f5b671aef0d413a189', '2024-08-29 08:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `fullName`, `username`, `email`, `password`, `profile_picture`) VALUES
(3, 'Alyson Calimag', 'Alyson', 'A@gmail.com', '$2y$10$tYZzFC67SJkSueUs.LJFHeZzS4DzSmxcNSjHaNqrcFPRfMpPsEgm2', '../uploads/profile_3.jpg'),
(16, 'alyson', 'bossing', 'boss@gmail.com', '$2y$10$UGBEJP6ZkkSSXpHrtPBWauMLcf2ZqL3IYbpfCLWmpmzfsozQ2k6ce', NULL),
(17, 'alyson', 'calimag', 'g@gmail.com', '$2y$10$7zcANhmsH6UYS.R4QWpRQOLIoX.RpvhTxFq8MO9aw3kLBXH2eoYm2', NULL),
(18, 'janna medina', 'janna', 'janna@gmail.com', '$2y$10$6pUBkX6tcKBUrNl2H.NE3.CA.yeaY3zlGz6hhRIpzjIuktLcKUSkK', NULL),
(19, 'stephen aries', 'aries', 'aries@gmail.com', '$2y$10$gK9XBsguVSsR/KPPqZKbueyionmvUjDbP0nPaJ5k2.QzTmxnHwoi6', NULL),
(20, 'bryan calimag', 'bryan', 'bryan@gmail.com', '$2y$10$7PBlg0UBvAVp7YQKXtTvyeLd.cMU2HrK5Wfvzj03HeFcGmFOmASkq', '../uploads/profile_20.jpg'),
(21, 'udnote', 'udnote', 'ud.note.123@gmail.com', '$2y$10$H.8sB3jewuyPtjyziCpEAusGyTqAm8bMvbu.6w0doGIkHptUN1xXG', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ID_fk` (`user_ID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
