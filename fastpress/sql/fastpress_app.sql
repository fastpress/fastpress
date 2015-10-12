-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2015 at 10:42 PM
-- Server version: 5.5.44-MariaDB
-- PHP Version: 7.0.0beta3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastpress_app`
--
CREATE DATABASE IF NOT EXISTS `fastpress_app` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fastpress_app`;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_added` datetime NOT NULL,
  `is_active` bit(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='	';

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `slug`, `title`, `tags`, `content`, `date_added`, `is_active`) VALUES
(12, 'lorem-ipsum', 'Lorem Ipsum', 'php, lorem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n', '2015-09-23 15:42:21', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(80) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `blog_id`, `date_added`) VALUES
(1, 'php', 1, '2015-09-07'),
(2, ' begginer', 1, '2015-09-07'),
(3, 'cars', 2, '2015-09-07'),
(4, 'money', 2, '2015-09-07'),
(5, 'open-source', 3, '2015-09-07'),
(6, 'github', 3, '2015-09-07'),
(7, 'js', 4, '2015-09-07'),
(8, 'programmig', 4, '2015-09-07'),
(9, 'php', 5, '2015-09-07'),
(10, 'programmig', 5, '2015-09-07'),
(11, 'php', 6, '2015-09-08'),
(12, 'oop', 6, '2015-09-08'),
(13, 'ddd', 6, '2015-09-08'),
(14, 'php', 7, '2015-09-08'),
(15, 'oop', 7, '2015-09-08'),
(16, 'php', 8, '2015-09-08'),
(17, 'oop', 8, '2015-09-08'),
(18, 'fastpress', 1, '2015-09-08'),
(19, 'php', 1, '2015-09-08'),
(20, 'php', 2, '2015-09-08'),
(21, 'oopprettyprint', 2, '2015-09-08'),
(22, 'php', 3, '2015-09-08'),
(23, 'oop', 3, '2015-09-08'),
(24, 'php', 4, '2015-09-08'),
(25, 'oop', 4, '2015-09-08'),
(26, 'php', 5, '2015-09-08'),
(27, 'oop', 5, '2015-09-08'),
(28, 'open-source', 6, '2015-09-08'),
(29, 'github', 6, '2015-09-08'),
(30, 'php', 7, '2015-09-08'),
(31, 'oop', 7, '2015-09-08'),
(32, 'open-source', 8, '2015-09-08'),
(33, 'github', 8, '2015-09-08'),
(34, 'php', 1, '2015-09-08'),
(35, 'tricks', 1, '2015-09-08'),
(36, 'php', 2, '2015-09-08'),
(37, 'oop', 2, '2015-09-08'),
(38, 'ddd', 2, '2015-09-08'),
(39, 'oop', 3, '2015-09-13'),
(40, 'php', 3, '2015-09-13'),
(41, 'LIL WAYNE', 4, '2015-09-17'),
(42, 'php', 5, '2015-09-17'),
(43, 'oop', 5, '2015-09-17'),
(44, 'js', 5, '2015-09-17'),
(45, 'php', 6, '2015-09-17'),
(46, 'oop', 6, '2015-09-17'),
(47, 'php', 7, '2015-09-17'),
(48, 'css', 7, '2015-09-17'),
(49, 'php', 8, '2015-09-17'),
(50, 'oop', 8, '2015-09-17'),
(51, 'open-source', 9, '2015-09-17'),
(52, 'github', 9, '2015-09-17'),
(53, 'php', 10, '2015-09-23'),
(54, 'oopprettyprint', 10, '2015-09-23'),
(55, 'php', 11, '2015-09-23'),
(56, 'oop', 11, '2015-09-23'),
(57, 'php', 12, '2015-09-23'),
(58, 'lorem', 12, '2015-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'simon', 'simon@example.com', '$2y$10$ifU4GsQksY26qt9C.nKve.TYy5xUKhfJt5SxTWS/WvSs406R1OqV.', 0),
(2, 'admin', 'admin@example.com', '$2y$10$j39zkPyuw.9da8BjdjjMP.R8KxEWnyR2LckxhkltvwnSlHaHHXLYa', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
