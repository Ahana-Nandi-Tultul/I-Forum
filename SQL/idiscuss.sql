-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2021 at 04:25 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idiscuss`
--
CREATE DATABASE IF NOT EXISTS `idiscuss` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `idiscuss`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_Id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `TimeStmp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_Id`, `category_name`, `category_description`, `TimeStmp`) VALUES
(1, 'Pyhton', 'Python is an interpreted high-level general-purpose programming language. Its design philosophy emphasizes code readability with its use of significant indentation. Its language constructs as well as its object-oriented approach aim to help programmers write clear, logical code for small and large-scale projects.', '2021-10-14 14:01:04'),
(2, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', '2021-10-14 14:01:54'),
(3, 'Django', 'Django is a Python-based free and open-source web framework that follows the model–template–views architectural pattern. It is maintained by the Django Software Foundation, an American independent organization established as a 501 non-profit.', '2021-10-14 14:02:37'),
(4, 'Ruby', 'Ruby is an interpreted, high-level, general-purpose programming language. It was designed and developed in the mid-1990s by Yukihiro \"Matz\" Matsumoto in Japan. Ruby is dynamically typed and uses garbage collection and just-in-time compilation.', '2021-10-14 14:03:37'),
(5, 'C#', 'C# is a general-purpose, multi-paradigm programming language. C# encompasses static typing, strong typing, lexically scoped, imperative, declarative, functional, generic, object-oriented, and component-oriented programming disciplines.', '2021-10-14 14:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment_by` int(11) NOT NULL,
  `Thread_Id` int(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_time`, `comment_by`, `Thread_Id`) VALUES
(1, 'Its design philosophy emphasizes code readability with its use of significant indentation. Its language constructs as well as its object-oriented approach aim to help programmers write clear, logical code for small and large-scale projects. ', '2021-10-14 14:19:56', 2, 3),
(2, 'JavaScript is a simple and easy-to-learn programming language as compared to other languages such as C++, Ruby, and Python. It is a high-level, interpreted language that can easily be embedded with languages like HTML. It was developed by Netscape Communications Corporation, Mozilla Foundation, and ECMA International.', '2021-10-14 14:22:56', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `threadlist`
--

DROP TABLE IF EXISTS `threadlist`;
CREATE TABLE `threadlist` (
  `Thread_Id` int(11) NOT NULL,
  `Thread_Title` varchar(255) NOT NULL,
  `Thread_desc` text NOT NULL,
  `Thread_cat_id` int(11) NOT NULL,
  `Thread_user_id` int(21) NOT NULL,
  `TimeStmp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threadlist`
--

INSERT INTO `threadlist` (`Thread_Id`, `Thread_Title`, `Thread_desc`, `Thread_cat_id`, `Thread_user_id`, `TimeStmp`) VALUES
(3, ' What is Python used for?', 'Python is an interpreted high-level general-purpose programming language. But why we use it?', 1, 1, '2021-10-14 14:18:00'),
(4, ' Is JavaScript easy to learn?', 'I have learned Java but I heard that JavaScript is so hard to learn. Is it true?', 2, 2, '2021-10-14 14:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `TimeStmp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `user_email`, `user_pass`, `TimeStmp`) VALUES
(1, 'ahana@gmail.com', '$2y$10$iTPZGq3QfRG2OOkyJnaKNO1mOKkikoFBn0PT2.M67GF1KfpZQXEkC', '2021-10-14 14:05:11'),
(2, 'tultul@gmail.com', '$2y$10$kf334frRmbwyKEXjIqpo5.smjsTMBMKhgCuR6eXGu5Q58aDIJyLhW', '2021-10-14 14:19:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_Id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threadlist`
--
ALTER TABLE `threadlist`
  ADD PRIMARY KEY (`Thread_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `threadlist`
--
ALTER TABLE `threadlist`
  MODIFY `Thread_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
