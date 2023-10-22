-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 21, 2023 at 06:19 PM
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
-- Database: `apd`
--

-- --------------------------------------------------------

--
-- Table structure for table `multiplechoice`
--

CREATE TABLE `multiplechoice` (
  `id` int(11) NOT NULL,
  `title` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `questions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`questions`)),
  `difficulty` varchar(10) NOT NULL,
  `points` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `multiplechoice`
--

INSERT INTO `multiplechoice` (`id`, `title`, `description`, `questions`, `difficulty`, `points`, `status`) VALUES
(5, 'Multiple Choice 1', 'Week 1 multiple choice for the peeps', '[{\"numb\":1,\"question\":\"What does HTML stand for?\",\"answer\":\"Hyper Text Markup Language\",\"options\":[\"Hyper Text Preprocessor\",\"Hyper Text Markup Language\",\"Hyper Text Multiple Language\",\"Hyper Tool Multi Language\"]},{\"numb\":2,\"question\":\"What does CSS stand for\",\"answer\":\"Cascading Style Sheet\",\"options\":[\"Common Style Shee\",\"Colorful Style Sheet\",\"Computer Style Sheet\",\"Cascading Style Sheet\"]}]', 'easy', 2, 'inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `multiplechoice`
--
ALTER TABLE `multiplechoice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `multiplechoice`
--
ALTER TABLE `multiplechoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
