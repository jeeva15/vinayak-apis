-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2018 at 12:30 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinayak`
--

-- --------------------------------------------------------

--
-- Table structure for table `mat_users`
--

CREATE TABLE `mat_users` (
  `uId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobileNo` int(11) NOT NULL,
  `userType` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_category`
--

CREATE TABLE `v_category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `categoryStatus` tinyint(1) NOT NULL DEFAULT '1',
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_category`
--

INSERT INTO `v_category` (`categoryId`, `categoryName`, `categoryStatus`, `createdOn`, `createdBy`) VALUES
(1, 'PLANK', 1, '2018-04-29 05:53:22', 2),
(2, 'PIPE', 1, '2018-04-29 05:53:22', 2),
(3, 'PIPE TYPE 2', 1, '2018-04-29 05:53:56', 1),
(4, 'PIPE TYPE 3', 1, '2018-04-29 05:53:56', 2),
(99999, 'Others', 1, '2018-05-27 06:16:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `v_dogenerationhistory`
--

CREATE TABLE `v_dogenerationhistory` (
  `categoryId` int(11) NOT NULL,
  `subCategoryId` int(11) NOT NULL,
  `requestId` int(11) NOT NULL,
  `quantityDelivered` int(11) NOT NULL,
  `DONumber` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_drivers`
--

CREATE TABLE `v_drivers` (
  `driverId` int(11) NOT NULL,
  `driverName` varchar(100) NOT NULL,
  `mobileNo` bigint(20) NOT NULL,
  `driverStatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_drivers`
--

INSERT INTO `v_drivers` (`driverId`, `driverName`, `mobileNo`, `driverStatus`) VALUES
(1, 'jeeva', 950006190, 1),
(2, 'rohit', 96660000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `v_materialrequests`
--

CREATE TABLE `v_materialrequests` (
  `id` int(11) NOT NULL,
  `requestId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `subCategoryId` int(11) NOT NULL,
  `quantityRequested` int(11) NOT NULL,
  `quantityDelivered` int(11) NOT NULL,
  `quantityAccepted` int(11) NOT NULL,
  `description` text NOT NULL,
  `activeDoNumber` int(11) NOT NULL,
  `quantityRemaining` int(11) NOT NULL DEFAULT '-1',
  `modfiedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_projects`
--

CREATE TABLE `v_projects` (
  `projectId` int(11) NOT NULL,
  `projectName` varchar(100) NOT NULL,
  `projectStatus` tinyint(1) NOT NULL DEFAULT '1',
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_projects`
--

INSERT INTO `v_projects` (`projectId`, `projectName`, `projectStatus`, `modifiedOn`, `createdBy`, `createdOn`) VALUES
(3, 'project1', 1, '2018-04-29 05:06:33', 2, '2018-04-29 00:00:00'),
(4, 'project2', 1, '2018-04-29 05:06:33', 2, '2018-04-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `v_requests`
--

CREATE TABLE `v_requests` (
  `requestId` int(11) NOT NULL,
  `notificationType` tinyint(1) NOT NULL,
  `projectIdFrom` int(11) NOT NULL,
  `projectIdTo` int(11) NOT NULL,
  `description` text NOT NULL,
  `driverId` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `approx` tinyint(1) NOT NULL DEFAULT '0',
  `requestStatus` tinyint(2) NOT NULL,
  `approverComments` text NOT NULL,
  `notificationNumber` varchar(100) NOT NULL,
  `DORemarks` text NOT NULL,
  `driverRemarks` text NOT NULL,
  `parentId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdOn` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_status`
--

CREATE TABLE `v_status` (
  `statusId` int(11) NOT NULL,
  `statusName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_subcategory`
--

CREATE TABLE `v_subcategory` (
  `subCategoryId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `subCategoryName` varchar(100) NOT NULL,
  `subCategoryStatus` tinyint(1) NOT NULL DEFAULT '1',
  `createdBy` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_subcategory`
--

INSERT INTO `v_subcategory` (`subCategoryId`, `categoryId`, `subCategoryName`, `subCategoryStatus`, `createdBy`, `createdOn`) VALUES
(1, 1, '10MM', 1, 2, '2018-04-29 05:55:20'),
(2, 1, '15MM', 1, 2, '2018-04-29 05:55:20'),
(3, 2, '6MM', 1, 2, '2018-04-29 05:56:00'),
(4, 2, '8MM', 1, 2, '2018-04-29 05:56:00'),
(5, 3, '50MM', 1, 2, '2018-04-29 05:56:39'),
(6, 4, '25MM', 1, 2, '2018-04-29 05:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `v_users`
--

CREATE TABLE `v_users` (
  `userId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userType` smallint(2) NOT NULL,
  `userStatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_users`
--

INSERT INTO `v_users` (`userId`, `Name`, `userName`, `password`, `userType`, `userStatus`) VALUES
(2, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 1, 1),
(3, 'jeeva', 'storeman', 'c6f929f8c30078248c2a2151be9f0f39', 3, 1),
(4, 'driver', 'driver', '703b02a2a8bb363f50386bb338892471', 4, 1),
(5, 'super', 'super', 'f35364bc808b079853de5a1e343e7159', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `v_vehicles`
--

CREATE TABLE `v_vehicles` (
  `vehicleId` int(11) NOT NULL,
  `vehicleNumber` varchar(50) NOT NULL,
  `vehicleStatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_vehicles`
--

INSERT INTO `v_vehicles` (`vehicleId`, `vehicleNumber`, `vehicleStatus`) VALUES
(2, 'TN22DE2690', 1),
(3, 'TN10AC9680', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mat_users`
--
ALTER TABLE `mat_users`
  ADD PRIMARY KEY (`uId`);

--
-- Indexes for table `v_category`
--
ALTER TABLE `v_category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `v_drivers`
--
ALTER TABLE `v_drivers`
  ADD PRIMARY KEY (`driverId`);

--
-- Indexes for table `v_materialrequests`
--
ALTER TABLE `v_materialrequests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `v_projects`
--
ALTER TABLE `v_projects`
  ADD PRIMARY KEY (`projectId`);

--
-- Indexes for table `v_requests`
--
ALTER TABLE `v_requests`
  ADD PRIMARY KEY (`requestId`);

--
-- Indexes for table `v_subcategory`
--
ALTER TABLE `v_subcategory`
  ADD PRIMARY KEY (`subCategoryId`);

--
-- Indexes for table `v_users`
--
ALTER TABLE `v_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `v_vehicles`
--
ALTER TABLE `v_vehicles`
  ADD PRIMARY KEY (`vehicleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mat_users`
--
ALTER TABLE `mat_users`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `v_category`
--
ALTER TABLE `v_category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000;

--
-- AUTO_INCREMENT for table `v_drivers`
--
ALTER TABLE `v_drivers`
  MODIFY `driverId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `v_materialrequests`
--
ALTER TABLE `v_materialrequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `v_projects`
--
ALTER TABLE `v_projects`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `v_requests`
--
ALTER TABLE `v_requests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `v_subcategory`
--
ALTER TABLE `v_subcategory`
  MODIFY `subCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `v_users`
--
ALTER TABLE `v_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `v_vehicles`
--
ALTER TABLE `v_vehicles`
  MODIFY `vehicleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
