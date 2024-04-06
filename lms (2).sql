-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 05:06 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activesubscriptions`
--

CREATE TABLE `activesubscriptions` (
  `UserID` int(30) NOT NULL,
  `SubID` int(30) NOT NULL,
  `StartDate` int(30) NOT NULL,
  `EndDate` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `AuthorName` varchar(255) NOT NULL,
  `BookID` int(10) NOT NULL,
  `AuthorID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookID` int(10) NOT NULL,
  `BookName` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Categories` varchar(255) NOT NULL,
  `Publisher` varchar(255) NOT NULL,
  `PublishedDate` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(10) NOT NULL,
  `CategoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorymap`
--

CREATE TABLE `categorymap` (
  `BookID` int(10) NOT NULL,
  `CategoryID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lentbooks`
--

CREATE TABLE `lentbooks` (
  `BookID` int(30) NOT NULL,
  `UserID` int(30) NOT NULL,
  `LentDate` int(30) NOT NULL,
  `ReturnDate` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `UserID` int(22) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`UserID`, `Email`, `Password`) VALUES
(1, 'anushka@gmail.com', 'anushka123'),
(2, 'uzzu4456@gmail.com', 'uzzu123');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptiontype`
--

CREATE TABLE `subscriptiontype` (
  `SubID` int(10) NOT NULL,
  `SubName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `totalbooks`
--

CREATE TABLE `totalbooks` (
  `BookID` int(30) NOT NULL,
  `TotalNumber` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `UserID` int(20) DEFAULT NULL,
  `FullName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `DOB` int(20) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activesubscriptions`
--
ALTER TABLE `activesubscriptions`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`AuthorID`),
  ADD KEY `fk_bookid` (`BookID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD KEY `fk_category_categoryid` (`CategoryID`);

--
-- Indexes for table `categorymap`
--
ALTER TABLE `categorymap`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `fk_categoryid` (`CategoryID`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD KEY `fk_user_details_login` (`UserID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `fk_bookid` FOREIGN KEY (`BookID`) REFERENCES `books` (`BookID`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_categoryid` FOREIGN KEY (`CategoryID`) REFERENCES `categorymap` (`CategoryID`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `fk_user_details_login` FOREIGN KEY (`UserID`) REFERENCES `login_details` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
