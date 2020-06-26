-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 26, 2020 at 02:36 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_manage`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(2000) NOT NULL,
  `pprice` float NOT NULL,
  `uid` int(3) NOT NULL,
  `date` date NOT NULL,
  `isdel` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `pname`, `pprice`, `uid`, `date`, `isdel`) VALUES
(1, 'Potato Chips', 20, 1, '2018-03-08', 0),
(2, 'Chips', 20, 2, '2018-03-10', 1),
(3, 'Book', 400, 3, '2018-03-10', 0),
(4, 'Pen', 15, 3, '2018-01-10', 0),
(5, 'Laptop', 500000, 2, '2018-03-10', 0),
(6, 'Pencil', 10, 8, '2020-06-19', 1),
(8, 'Pencil', 10, 8, '2020-06-19', 0),
(9, 'Pencil', 10, 8, '2020-06-19', 0),
(10, 'notebook', 20, 8, '2020-06-19', 0),
(11, 'grocery', 500, 8, '2020-06-20', 0),
(12, 'Real Estate', 1500, 8, '2020-06-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `income` varchar(2000) NOT NULL,
  `tvalue` float NOT NULL,
  `uid` int(3) NOT NULL,
  `date` date NOT NULL,
  `isdel` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `income`, `tvalue`, `uid`, `date`, `isdel`) VALUES
(1, 'Hack', 5000, 2, '2018-03-10', 1),
(2, 'Pocket Money', 1000, 3, '2018-03-10', 0),
(3, 'Won', 10000, 2, '2018-03-10', 0),
(5, 'Real Estate', 1000, 8, '2020-06-19', 1),
(7, 'Agriculture', 34678, 8, '2020-06-19', 1),
(12, 'Real Estate', 1000, 8, '2020-06-23', 0),
(13, 'Real Estate', 1000, 8, '2020-06-23', 1),
(14, 'Real Estate', 1000, 8, '2020-06-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(8) NOT NULL AUTO_INCREMENT,
  `uname` varchar(40) NOT NULL,
  `uemail` varchar(80) NOT NULL,
  `upass` varchar(32) NOT NULL,
  `Creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `uemail`, `upass`, `Creation_date`) VALUES
(1, 'Akash Mondal', 'akash@gmail.com', '94754d0abb89e4cf0a7f1c494dbb9d2c', '2018-03-08 17:35:52'),
(2, 'Satyapriya Mandal', 'satyapriya707@gmail.com', '38945b2bad7e3c5ffb9e39da2603c169', '2018-03-10 17:06:13'),
(3, 'Akash Mondal', 'akashmondal@gmail.com', '94754d0abb89e4cf0a7f1c494dbb9d2c', '2018-03-10 17:17:46'),
(4, 'satwik', 'satwikhegde015@gamil.com', 'satwikjhh', '2020-06-18 11:29:48'),
(5, 'satwik', 'sat@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2020-06-18 12:51:07'),
(6, 'sanju', 'sanjay@gmail.com', '6886badb36b23129002bbbae0d9432d0', '2020-06-18 16:51:58'),
(7, 'sujay', 'sujay@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-18 17:29:30'),
(8, 'santosh', 'santu@gmail.com', '0b7d74b06c8ed727700cfeacfe23b5e3', '2020-06-18 17:41:55'),
(9, 'sumanth', 'suman@gmail.com', '1533c67e5e70ae7439a9aa993d6a3393', '2020-06-20 16:40:35'),
(10, 'sujay', 'suj@gmail.com', 'a7753a6ee25ecd76462feaf2cd200a06', '2020-06-20 16:42:56'),
(11, 'virat', 'virat@gmail.com', '5a39fe36ce9aa092ffe8faa0eaedd5da', '2020-06-20 16:57:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
