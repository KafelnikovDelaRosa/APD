-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2023 at 07:02 PM
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
-- Table structure for table `backend`
--

CREATE TABLE `backend` (
  `id` int(11) NOT NULL,
  `title` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `graphics` varchar(75) DEFAULT NULL,
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
(1, 'FizzBuzz', 'Given a program that would loop from numbers from 1 to 100, create a condition that would print \'Fizz\' if the number is divisible by 3 and print \'Buzz\' if the number is divisible by 5. If both numbers are divisible by 3 and 5, print \'FizzBuzz\', otherwise just print the number. You may use any programming language to solve this problem', NULL, NULL, '1\n2\nFizz\n4\nBuzz\n...\n11\nFizz\n13\n14\nFizzBuzz', 'Given a new condition where if the number is divisible by 7 which would print \'Comb\', kindly modify the code such that if the number is divisible by 7 and 3 it prints \'FizzComb\' or if the number is divisible by 7 and 5 it prints \'BuzzComb\' otherwise if both numbers are divisible by 3, 5 and 7 print \'FizzBuzzComb\'', 'easy', 10, 'inactive'),
(2, 'Reverse Number', 'Given an integer number (e.g. 12345), print its reversed form without using any built in string functions. You may use any programming language to solve this problem', NULL, 'Enter a number: 369', '963', NULL, 'easy', 10, 'inactive'),
(3, 'Fibonacci Sequence', 'Fibonacci sequence is defined as a sequence of numbers wherein the next sequence is equal to the sum of two previous numbers which could be in the form of Fn= Fn-1+Fn-2. Given an integer input num, print the first sequence of the fibonacci numbers until the desired input size num', NULL, 'Number of expected sequences: 6', '0,1,1,2,3,5', NULL, 'easy', 10, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backend`
--
ALTER TABLE `backend`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backend`
--
ALTER TABLE `backend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
