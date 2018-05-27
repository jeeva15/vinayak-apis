-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2018 at 09:29 PM
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
  `requestId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `subCategoryId` int(11) NOT NULL,
  `quantityRequested` int(11) NOT NULL,
  `quantityDelivered` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_materialrequests`
--

INSERT INTO `v_materialrequests` (`requestId`, `categoryId`, `subCategoryId`, `quantityRequested`, `quantityDelivered`, `description`) VALUES
(20, 1, 1, 22, 0, ''),
(21, 1, 2, 12, 0, ''),
(26, 1, 1, 21, 0, ''),
(30, 2, 3, 23, 0, ''),
(30, 3, 5, 343, 0, ''),
(37, 1, 1, 22, 0, ''),
(37, 3, 5, 0, 0, ''),
(37, 1, 1, 556, 0, ''),
(40, 1, 1, 899, 0, ''),
(42, 1, 2, 6757, 0, ''),
(32, 2, 3, 22, 0, ''),
(41, 1, 1, 6565, 0, ''),
(41, 3, 5, 3434, 0, ''),
(19, 1, 1, 12, 12, ''),
(19, 2, 1, 787, 787, ''),
(23, 1, 1, 22, 22, ''),
(28, 3, 5, 224, 0, ''),
(28, 1, 2, 556, 0, ''),
(35, 1, 1, 22, 0, ''),
(35, 3, 5, 0, 0, ''),
(35, 2, 3, 808, 0, ''),
(35, 1, 1, 90, 0, ''),
(35, 1, 1, 77, 0, ''),
(35, 99999, 0, 566, 0, ''),
(43, 1, 1, 233, 0, ''),
(43, 4, 6, 123, 0, ''),
(34, 1, 1, 22, 0, ''),
(34, 4, 6, 456, 0, ''),
(34, 3, 5, 787, 0, ''),
(34, 4, 6, 45, 0, ''),
(44, 3, 5, 345, 0, '2333'),
(44, 99999, 0, 2445, 0, 'dsfsfsfs'),
(45, 1, 1, 3455, 3455, ''),
(45, 99999, 0, 3455, 3455, ''),
(27, 1, 1, 123, 123, 'test  deds'),
(46, 2, 4, 5354, 0, 'asfasas'),
(46, 99999, 0, 244, 0, 'asdsd'),
(29, 1, 2, 24, 0, ''),
(31, 1, 1, 22, 32234, ''),
(31, 1, 1, 32234, 32234, ''),
(22, 1, 1, 22, 22, ''),
(22, 4, 6, 3434, 3434, '');

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
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdOn` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_requests`
--

INSERT INTO `v_requests` (`requestId`, `notificationType`, `projectIdFrom`, `projectIdTo`, `description`, `driverId`, `vehicleId`, `remarks`, `approx`, `requestStatus`, `approverComments`, `notificationNumber`, `DORemarks`, `driverRemarks`, `createdBy`, `modifiedBy`, `modifiedOn`, `createdOn`) VALUES
(19, 2, 3, 0, 'description test', 1, 2, 'remarks test', 0, 4, 'approved', '2', 'this is test remarks do', '', 2, 0, '2018-05-25 01:26:25', '2018-05-01 16:48:31'),
(20, 3, 3, 3, 'description sk', 2, 2, 'this is test remarks', 0, 1, '', '2', '', '', 2, 0, '2018-05-01 20:20:46', '2018-05-01 16:50:46'),
(21, 1, 3, 0, 'this is test description', 0, 0, 'this is tet remarks', 0, 1, '', '', '', '', 2, 0, '2018-05-02 03:52:55', '2018-05-02 00:22:55'),
(22, 1, 3, 0, 'xv sfs sf s sdf', 1, 2, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs1', 0, 4, 'sdsdsadf', '', '', '', 2, 0, '2018-05-27 15:28:06', '2018-05-02 00:29:57'),
(23, 1, 3, 0, 'xv sfs sf s sdf', 2, 3, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 5, '', '', 'remarks in do generation', 'this is driver remarks', 2, 0, '2018-05-25 14:53:08', '2018-05-02 00:30:48'),
(26, 1, 3, 0, 'sadasd', 0, 0, 'safasfasfsdf', 0, 6, '', '', '', '', 2, 0, '2018-05-05 10:23:44', '2018-05-05 06:53:44'),
(27, 1, 3, 0, 'descriotion test', 1, 2, 'asasas', 0, 4, '', '', 'dff', '', 2, 0, '2018-05-27 07:17:02', '2018-05-05 07:22:59'),
(28, 1, 4, 0, 'xv sfs sf s sdf', 0, 0, 'test', 0, 1, '', '', '', '', 2, 2, '2018-05-26 10:48:59', '2018-05-06 04:43:04'),
(29, 2, 4, 0, '', 1, 2, 'cvzxzxc', 0, 2, '', '', '', '', 2, 2, '2018-05-27 08:38:14', '2018-05-06 04:54:53'),
(30, 1, 3, 0, '2saa asdasdasd a dsasd', 0, 0, 'asdasdasd', 0, 1, '', '', '', '', 2, 0, '2018-05-10 19:11:16', '2018-05-10 15:41:16'),
(31, 0, 4, 0, 'xv sfs sf s sdf', 0, 0, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 4, '', '', '', '', 2, 0, '2018-05-27 09:12:14', '2018-05-13 02:59:23'),
(32, 1, 3, 0, 'zx asasd', 0, 0, 'sasdasd', 0, 2, '', '', '', '', 2, 2, '2018-05-13 05:08:26', '2018-05-13 03:00:30'),
(34, 1, 3, 0, '', 0, 0, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 1, '', '', '', '', 2, 2, '2018-05-27 06:59:59', '2018-05-13 03:17:38'),
(35, 1, 3, 0, '', 0, 0, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 1, '', '', '', '', 2, 2, '2018-05-27 06:41:11', '2018-05-13 03:20:43'),
(37, 1, 3, 0, 'xv sfs sf s sdf', 0, 0, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 0, '', '', '', '', 2, 0, '2018-05-13 07:12:11', '2018-05-13 03:42:11'),
(40, 1, 3, 0, 'ghhjg bjhj', 0, 0, '8hghjhhjhjh jhgjgjjk', 0, 1, '', '', '', '', 2, 0, '2018-05-13 04:08:41', '2018-05-13 04:06:41'),
(41, 1, 3, 0, 'hjhghjgh', 0, 0, '', 0, 1, '', '', '', '', 2, 2, '2018-05-24 15:16:46', '2018-05-13 04:18:34'),
(42, 1, 3, 0, ',bjjhj', 0, 0, '', 0, 1, '', '', '', '', 2, 0, '2018-05-13 08:36:17', '2018-05-13 05:06:17'),
(43, 1, 3, 0, '', 0, 0, '', 0, 1, '', '', '', '', 2, 2, '2018-05-27 06:51:31', '2018-05-27 03:36:09'),
(44, 1, 3, 0, '', 0, 0, 'ddfsfs ssssd', 0, 1, '', '', '', '', 2, 0, '2018-05-27 10:33:50', '2018-05-27 07:03:50'),
(45, 1, 3, 0, '', 1, 2, 'fsfasfsf', 0, 5, 'ZXZCZXC', '', 'REMARkkss', '', 2, 0, '2018-05-27 15:56:21', '2018-05-27 07:05:35'),
(46, 1, 3, 0, '', 0, 0, 'asasdsa', 0, 3, 'sfasfasf', '', '', '', 2, 0, '2018-05-27 12:03:50', '2018-05-27 08:33:50');

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
(4, 'driver', 'driver', '703b02a2a8bb363f50386bb338892471', 4, 1);

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
-- AUTO_INCREMENT for table `v_projects`
--
ALTER TABLE `v_projects`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `v_requests`
--
ALTER TABLE `v_requests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `v_subcategory`
--
ALTER TABLE `v_subcategory`
  MODIFY `subCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `v_users`
--
ALTER TABLE `v_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `v_vehicles`
--
ALTER TABLE `v_vehicles`
  MODIFY `vehicleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
