-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2023 at 11:01 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `studentid` bigint(20) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(25) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `avatar` varchar(60) DEFAULT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `studentid`, `firstname`, `middlename`, `lastname`, `avatar`, `password`) VALUES
(1, 201910416, 'Jeremiah', NULL, 'Velasco', '/admin/admins/201910416.jpg', '$2y$10$XwhSm2cAK2Pgn88yM4/MFecIEGd2xLQtTLXaF6e3OYxNuChu1LzDG');

-- --------------------------------------------------------

--
-- Table structure for table `backend`
--

CREATE TABLE `backend` (
  `id` int(11) NOT NULL,
  `title` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `graphics` text DEFAULT NULL,
  `input` text DEFAULT NULL,
  `output` text NOT NULL,
  `followup` text DEFAULT NULL,
  `difficulty` varchar(25) NOT NULL,
  `points` int(6) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backend`
--

INSERT INTO `backend` (`id`, `title`, `description`, `graphics`, `input`, `output`, `followup`, `difficulty`, `points`, `status`) VALUES
(1, 'FizzBuzz', 'Given a program that would loop from numbers from 1 to 100, create a condition that would print “Fizz” if the number is divisible by 3 and print “Buzz” if the number is divisible by 5. If both numbers are divisible by 3 and 5, print FizzBuzz, otherwise just print the number. You may use any programming language to solve this problem', NULL, 'null', '1\r\n2\r\nFizz\r\n4\r\nBuzz\r\n...\r\n11\r\nFizz\r\n13\r\n14\r\nFizzBuzz', 'Given a new condition where if the number is divisible by 7 which would print \'Comb\', kindly modify the code such that if the number is divisible by 7 and 3 it prints \'FizzComb\' or if the number is divisible by 7 and 5 it prints \'BuzzComb\' otherwise if both numbers are divisible by 3, 5 and 7 print \'FizzBuzzComb\'', 'easy', 10, 'active'),
(2, 'Reverse Number', 'Given an integer number (e.g. 12345), print its reversed form without using any built in string functions. You may use any programming language to solve this problem', NULL, 'Enter a number: 369', '963', NULL, 'easy', 10, 'inactive'),
(4, 'Converting Number to Roman Numerals', 'Provided the roman numeral table below, create a program that would convert an integer number (e.g 128) into roman numerals. You may use any programming language to solve this problem.', NULL, 'Enter a Number: 671', 'DCLXXI', 'null', 'easy', 10, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `frontend`
--

CREATE TABLE `frontend` (
  `id` int(11) NOT NULL,
  `title` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `graphics` varchar(100) NOT NULL,
  `difficulty` varchar(10) NOT NULL,
  `points` int(6) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frontend`
--

INSERT INTO `frontend` (`id`, `title`, `description`, `graphics`, `difficulty`, `points`, `status`) VALUES
(3, 'Triangle', 'Follow the shape image bellow using html, css, and javascript', 'admin/codeQuestUploads/graphics/frontend/Triangle.png', 'easy', 10, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
(5, 'Multiple Choice 1', 'Week 1 multiple choice for the peeps', '[{\"numb\":1,\"question\":\"What does HTML stand for?\",\"answer\":\"Hyper Text Markup Language\",\"options\":[\"Hyper Text Preprocessor\",\"Hyper Text Markup Language\",\"Hyper Text Multiple Language\",\"Hyper Tool Multi Language\"]},{\"numb\":2,\"question\":\"What does PHP stand for?\",\"answer\":\"Hypertext Preprocessor\",\"options\":[\"Hypertext Preprocessor\",\"Hypertext Programming\",\"Hypertext Preprogramming\",\"Hometext Preprocessor\"]},{\"numb\":3,\"question\":\"What does SQL stand for?\",\"answer\":\"Structured Query Language\",\"options\":[\"Stylish Question Language\",\"Stylesheet Query Language\",\"Statement Question Language\",\"Structured Query Language\"]},{\"numb\":4,\"question\":\"What does XML stand for?\",\"answer\":\"eXtensible Markup Language\",\"options\":[\"eXtensible Markup Language\",\"eXecutable Multiple Language\",\"eXTra Multi-Program Language\",\"eXamine Multiple Language\"]},{\"numb\":5,\"question\":\"What does CSS stand for?\",\"answer\":\"Cascading Style Sheet\",\"options\":[\"Common Style Sheet\",\"Colorful Style Sheet\",\"Computer Style Sheet\",\"Cascading Style Sheet\"]}]', 'easy', 5, 'active'),
(6, 'Multiple Choice 2', 'Week 2 multiple choice for peeps', '[{\"numb\":1,\"question\":\"Given this JavaScript code: console.log(1==1), what would be the output?\",\"answer\":\"true\",\"options\":[\"false\",\"undefined\",\"null\",\"true\"]}]', 'easy', 1, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `studentid` bigint(20) NOT NULL,
  `avatar` varchar(60) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `middlename` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) NOT NULL,
  `yearlevel` int(11) NOT NULL,
  `program` varchar(45) NOT NULL,
  `completed` int(11) DEFAULT NULL,
  `streak` int(11) DEFAULT NULL,
  `medals` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `studentid`, `avatar`, `email`, `firstname`, `middlename`, `lastname`, `yearlevel`, `program`, `completed`, `streak`, `medals`, `points`, `password`) VALUES
(6, 201910126, 'users/201910126.jpeg', '201910126@feudiliman.edu.ph', 'Elay', 'Vi', 'Jay', 5, 'BSITAGD', NULL, NULL, NULL, NULL, '$2y$10$Ba/QzPhuG83V3Br2Mt2dT.QM4pi4geaZy1ugKd.NH5tAsZ271burG'),
(21, 201911744, NULL, 'clifton.wilderman@example.com', 'Amani', 'Preston', 'Eichmann', 4, 'BSITAGD', NULL, NULL, NULL, NULL, '$2y$10$xV5DcGMIImv7m8NfBUjwg.BYyl3LJDmkorhxxIenVu9qQVh6C5ute'),
(19, 201977645, NULL, 'raphaelle.oconnell@example.net', 'Mckenzie', 'Hearthwell', 'Kessler', 2, 'BSITAGD', NULL, NULL, NULL, NULL, '$2y$10$hiqhURRDaICyoC8cpHWoh.TzyT1XUcjk9nQrMJ7XX83OWH4w0JjYK'),
(18, 201992727, NULL, 'hwhite@example.com', 'Paolo', NULL, 'Pagac', 3, 'BSITWMA', NULL, NULL, NULL, NULL, '$2y$10$Rsk2AzDC6QxTNkZrJft03O8/cH2EnwcADbbILnf3juhbEcxEU/sQG'),
(7, 202010075, NULL, '202010075@feudiliman.edu.ph', 'Craig', 'Trevor', 'Ronquilio', 4, 'BSITWMA', NULL, NULL, NULL, NULL, '$2y$10$4bOfIX9nwxwj5rOFFZDmVOUVIZOei43GsWzttXpK1Ikec7gzQ6SUW'),
(5, 202010106, NULL, 'kafelnikovdelarosa2341@gmail.com', 'Kafelnikov', 'Celles', 'Dela Rosa', 4, 'BSITWMA', NULL, NULL, NULL, NULL, '$2y$10$VYh73rGdV4lFHutUuIgbdeWGF41RHWZt4xfUu4x1g2p4xaRyb3t6m'),
(22, 202012423, NULL, 'goodwin.jana@example.com', 'Jack', 'Vinnie', 'Tremblay', 2, 'BSITWMA', NULL, NULL, NULL, NULL, '$2y$10$9n2xxmqvsYgS7GK12PK1seKIn1m.6Pw.R1b3GunzuhHuGgt144YZi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backend`
--
ALTER TABLE `backend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontend`
--
ALTER TABLE `frontend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiplechoice`
--
ALTER TABLE `multiplechoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`studentid`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `studentid_UNIQUE` (`studentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `backend`
--
ALTER TABLE `backend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `frontend`
--
ALTER TABLE `frontend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `multiplechoice`
--
ALTER TABLE `multiplechoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
