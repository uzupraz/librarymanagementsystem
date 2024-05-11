-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2024 at 06:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `ActiveSubscriptions`
--

CREATE TABLE `ActiveSubscriptions` (
  `userid` int(11) NOT NULL,
  `subid` int(11) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE `Books` (
  `bookid` int(11) NOT NULL,
  `bookname` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publishdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`bookid`, `bookname`, `author`, `publisher`, `publishdate`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Scribner', '1925-04-10'),
(2, 'To Kill a Mockingbird', 'Harper Lee', 'J. B. Lippincott & Co.', '1960-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`categoryid`, `categoryname`) VALUES
(1, 'Classic'),
(2, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `CategoryMap`
--

CREATE TABLE `CategoryMap` (
  `bookid` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CategoryMap`
--

INSERT INTO `CategoryMap` (`bookid`, `categoryid`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `LentBooks`
--

CREATE TABLE `LentBooks` (
  `bookid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `lenddate` date DEFAULT NULL,
  `returndate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LentBooks`
--

INSERT INTO `LentBooks` (`bookid`, `userid`, `lenddate`, `returndate`) VALUES
(1, 1, '2024-02-01', '2024-02-15'),
(2, 2, '2024-03-01', '2024-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `LoginDetails`
--

CREATE TABLE `LoginDetails` (
  `userid` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LoginDetails`
--

INSERT INTO `LoginDetails` (`userid`, `Email`, `password`) VALUES
(1, 'user1@example.com', 'pass1'),
(2, 'user2@example.com', 'pass2');

-- --------------------------------------------------------

--
-- Table structure for table `SubscriptionType`
--

CREATE TABLE `SubscriptionType` (
  `subid` int(11) NOT NULL,
  `subname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SubscriptionType`
--

INSERT INTO `SubscriptionType` (`subid`, `subname`) VALUES
(1, 'Monthly'),
(2, 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `TotalBooks`
--

CREATE TABLE `TotalBooks` (
  `bookid` int(11) DEFAULT NULL,
  `totalnumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TotalBooks`
--

INSERT INTO `TotalBooks` (`bookid`, `totalnumber`) VALUES
(1, 3),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `UserDetails`
--

CREATE TABLE `UserDetails` (
  `userid` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `isSubscribed` int(2) DEFAULT 0,
  `isDeleted` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `UserDetails`
--

INSERT INTO `UserDetails` (`userid`, `FullName`, `Address`, `DateOfBirth`, `Gender`, `isSubscribed`, `isDeleted`) VALUES
(1, 'John Doe', '123 Elm Street', '1985-05-15', 'Male', 0, 0),
(2, 'Jane Smith', '456 Oak Avenue', '1990-08-20', 'Female', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ActiveSubscriptions`
--
ALTER TABLE `ActiveSubscriptions`
  ADD KEY `subid` (`subid`),
  ADD KEY `activesubscriptions_ibfk_1` (`userid`);

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `CategoryMap`
--
ALTER TABLE `CategoryMap`
  ADD KEY `bookid` (`bookid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `LentBooks`
--
ALTER TABLE `LentBooks`
  ADD KEY `bookid` (`bookid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `LoginDetails`
--
ALTER TABLE `LoginDetails`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `SubscriptionType`
--
ALTER TABLE `SubscriptionType`
  ADD PRIMARY KEY (`subid`);

--
-- Indexes for table `TotalBooks`
--
ALTER TABLE `TotalBooks`
  ADD KEY `bookid` (`bookid`);

--
-- Indexes for table `UserDetails`
--
ALTER TABLE `UserDetails`
  ADD PRIMARY KEY (`userid`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `UserDetails`
--
ALTER TABLE `UserDetails`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ActiveSubscriptions`
--
ALTER TABLE `ActiveSubscriptions`
  ADD CONSTRAINT `activesubscriptions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `UserDetails` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activesubscriptions_ibfk_2` FOREIGN KEY (`subid`) REFERENCES `SubscriptionType` (`subid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CategoryMap`
--
ALTER TABLE `CategoryMap`
  ADD CONSTRAINT `categorymap_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `Books` (`bookid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categorymap_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `Category` (`categoryid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `LentBooks`
--
ALTER TABLE `LentBooks`
  ADD CONSTRAINT `lentbooks_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `Books` (`bookid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `LoginDetails`
--
ALTER TABLE `LoginDetails`
  ADD CONSTRAINT `logindetails_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `UserDetails` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `TotalBooks`
--
ALTER TABLE `TotalBooks`
  ADD CONSTRAINT `totalbooks_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `Books` (`bookid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
