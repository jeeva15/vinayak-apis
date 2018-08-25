-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2018 at 07:48 PM
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
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `subCategoryId` int(11) NOT NULL,
  `requestId` int(11) NOT NULL,
  `quantityRequested` int(11) NOT NULL,
  `quantityDelivered` int(11) NOT NULL,
  `quantityAccepted` int(11) NOT NULL,
  `approx` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `DONumber` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `requestStatus` tinyint(2) NOT NULL,
  `modifiedOn` datetime NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `driverId` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `DORemarks` text NOT NULL,
  `collectionRemarks` text NOT NULL,
  `driverRemarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_dogenerationhistory`
--

INSERT INTO `v_dogenerationhistory` (`id`, `categoryId`, `subCategoryId`, `requestId`, `quantityRequested`, `quantityDelivered`, `quantityAccepted`, `approx`, `description`, `DONumber`, `createdOn`, `active`, `requestStatus`, `modifiedOn`, `modifiedBy`, `driverId`, `vehicleId`, `DORemarks`, `collectionRemarks`, `driverRemarks`) VALUES
(1, 1, 1, 1, 234, 200, 200, 0, 'as', 1, '2018-06-12 19:40:13', 1, 7, '2018-06-12 21:40:13', 4, 0, 0, '', '', ''),
(2, 3, 5, 1, 233, 200, 200, 0, '', 1, '2018-06-12 19:40:13', 1, 7, '2018-06-12 21:40:13', 4, 0, 0, '', '', ''),
(3, 1, 1, 1, 234, 15, 15, 0, 'as', 2, '2018-06-15 19:27:12', 1, 7, '2018-06-15 21:27:12', 2, 0, 0, '', 'AAS', ''),
(4, 3, 5, 1, 233, 15, 15, 0, '', 2, '2018-06-15 19:27:12', 1, 7, '2018-06-15 21:27:12', 2, 0, 0, '', 'AAS', ''),
(5, 3, 5, 2, 23, 10, 0, 0, 'dasd', 3, '2018-06-15 08:48:55', 1, 4, '0000-00-00 00:00:00', 0, 0, 0, 'do remarks', '', ''),
(6, 3, 5, 2, 23, 13, 0, 0, 'dasd', 4, '2018-06-15 08:51:45', 1, 4, '0000-00-00 00:00:00', 0, 0, 0, 'do remarks', '', ''),
(7, 2, 3, 4, 900, 90, 90, 0, 'aasd', 5, '2018-06-24 08:22:12', 1, 7, '2018-06-24 10:22:12', 2, 1, 2, 'jeeva', 'zas', ''),
(8, 3, 5, 4, 213, 21, 21, 0, 'asdasd', 5, '2018-06-24 08:22:12', 1, 7, '2018-06-24 10:22:12', 2, 1, 2, 'jeeva', 'zas', ''),
(9, 2, 3, 4, 900, 80, 80, 0, 'aasd', 6, '2018-06-24 08:25:06', 1, 7, '2018-06-24 10:25:06', 2, 2, 3, 'rohit remarks', '', 'driver remarks'),
(10, 3, 5, 4, 213, 10, 10, 0, 'asdasd', 6, '2018-06-24 08:25:06', 1, 7, '2018-06-24 10:25:06', 2, 2, 3, 'rohit remarks', '', 'driver remarks'),
(11, 1, 1, 1, 234, 19, 19, 0, 'as', 7, '2018-06-15 19:27:49', 1, 7, '2018-06-15 21:27:49', 2, 1, 3, 'remakrs in do', 'asAS', 'remarks by driver'),
(12, 3, 5, 1, 233, 18, 18, 0, '', 7, '2018-06-15 19:27:49', 1, 7, '2018-06-15 21:27:49', 2, 1, 3, 'remakrs in do', 'asAS', 'remarks by driver'),
(13, 1, 2, 7, 244, 200, 0, 0, 'asd', 8, '2018-06-16 09:09:52', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'sdfsdf', '', ''),
(14, 3, 5, 7, 324, 300, 0, 0, 'asasd', 8, '2018-06-16 09:09:52', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'sdfsdf', '', ''),
(20, 1, 1, 14, 2421, 2421, 2420, 1, 'adada', 0, '2018-06-23 06:21:09', 1, 11, '2018-06-23 08:21:09', 2, 1, 2, '', 'xfsdfsdf', 'KJHJJH'),
(21, 3, 5, 14, 34, 34, 34, 0, 'sfs', 0, '2018-06-23 06:21:09', 1, 11, '2018-06-23 08:21:09', 2, 1, 2, '', 'xfsdfsdf', 'KJHJJH'),
(24, 3, 5, 15, 343, 343, 0, 0, '', 0, '2018-06-23 06:26:03', 1, 8, '2018-06-23 08:26:03', 2, 0, 0, '', '', 'adasd'),
(25, 2, 4, 15, 23, 23, 0, 0, 'ewqe', 0, '2018-06-23 06:26:03', 1, 8, '2018-06-23 08:26:03', 2, 0, 0, '', '', 'adasd'),
(26, 1, 1, 8, 344, 3499, 0, 0, 'adasd', 9, '2018-06-24 08:01:34', 1, 4, '0000-00-00 00:00:00', 0, 1, 3, '', '', ''),
(27, 1, 1, 8, 344, -3155, 0, 0, 'adasd', 10, '2018-06-24 08:12:12', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, '', '', ''),
(28, 1, 2, 7, 244, 24, 0, 0, 'asd', 11, '2018-06-24 08:13:44', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, '', '', ''),
(29, 3, 5, 7, 324, 24, 0, 0, 'asasd', 11, '2018-06-24 08:13:44', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, '', '', ''),
(30, 1, 2, 7, 244, 20, 0, 0, 'asd', 12, '2018-06-24 08:14:12', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'sdf', '', ''),
(31, 3, 5, 7, 324, 0, 0, 0, 'asasd', 12, '2018-06-24 08:14:12', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'sdf', '', ''),
(42, 1, 1, 16, 234, 234, 0, 0, '', 13, '2018-06-29 19:26:41', 1, 4, '0000-00-00 00:00:00', 0, 1, 1, '', '', ''),
(43, 3, 5, 16, 234, 234, 0, 0, 'sdasd', 13, '2018-06-29 19:26:41', 1, 4, '0000-00-00 00:00:00', 0, 1, 1, '', '', ''),
(44, 2, 3, 17, 234, 234, 0, 0, 'asdasd', 14, '2018-06-29 19:30:00', 1, 5, '2018-06-29 21:30:00', 2, 1, 1, '', '', 'dfsdfsdf'),
(45, 1, 1, 18, 34, 34, 0, 0, 'sasd', 15, '2018-06-29 19:53:51', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, '', '', ''),
(46, 1, 1, 19, 325, 325, 325, 0, 'aasd', 16, '2018-06-29 20:45:09', 1, 13, '2018-06-29 22:45:09', 2, 1, 2, '', 'xcvxcv', 'sdasd'),
(47, 2, 3, 20, 214, 214, 214, 1, 'adad', 0, '2018-06-29 20:48:30', 1, 11, '2018-06-29 22:48:30', 2, 1, 3, '', 'zXZXC', 'sdsdfsdf'),
(48, 2, 3, 21, 234, 234, 0, 0, 'sd', 0, '2018-07-15 13:41:27', 1, 11, '2018-07-15 15:41:27', 2, 1, 2, '', 'sdfsfsdf', 'zxczxc'),
(49, 1, 1, 22, 234, 34, 15, 0, 'zcZ', 17, '2018-07-15 13:21:18', 1, 7, '2018-07-15 15:21:18', 2, 1, 2, 'asdasd', 'gdsgdfg', 'sdasd'),
(50, 1, 1, 23, 324, 324, 300, 0, 'fas', 18, '2018-07-15 16:40:54', 1, 13, '2018-07-15 18:40:54', 2, 1, 2, '', 'assfsa', 'asdasdasd'),
(51, 1, 1, 22, 234, 200, 0, 0, 'zcZ', 19, '2018-07-07 18:16:28', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'kjhjkjj', '', ''),
(52, 2, 3, 4, 900, 100, 0, 0, 'aasd', 20, '2018-07-07 18:21:14', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'sdsdf', '', ''),
(53, 3, 5, 4, 213, 100, 0, 0, 'asdasd', 20, '2018-07-07 18:21:14', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'sdsdf', '', ''),
(54, 2, 3, 4, 900, 100, 0, 0, 'aasd', 21, '2018-07-07 18:34:14', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, '', '', ''),
(55, 3, 5, 4, 213, 52, 0, 0, 'asdasd', 21, '2018-07-07 18:34:14', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, '', '', ''),
(56, 1, 1, 24, 211, 211, 200, 1, 'asdas', 0, '2018-07-07 18:44:32', 1, 11, '2018-07-07 20:44:32', 2, 1, 2, '', '', 'dADa'),
(57, 3, 5, 24, 233, 233, 200, 1, 'as', 0, '2018-07-07 18:44:32', 1, 11, '2018-07-07 20:44:32', 2, 1, 2, '', '', 'dADa'),
(58, 2, 3, 4, 900, 530, 0, 0, 'aasd', 22, '2018-08-12 10:28:53', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'asdasd', '', ''),
(59, 3, 5, 4, 213, 30, 0, 0, 'asdasd', 22, '2018-08-12 10:28:53', 1, 4, '0000-00-00 00:00:00', 0, 1, 2, 'asdasd', '', ''),
(60, 4, 6, 3, 900, 810, 810, 0, 'jhjh', 23, '2018-08-15 10:37:11', 1, 7, '2018-08-15 12:37:11', 2, 1, 2, 'asdasd', 'sdasd', 'sasd'),
(61, 3, 5, 3, 570, 513, 513, 0, 'cvbcv', 23, '2018-08-15 10:37:11', 1, 7, '2018-08-15 12:37:11', 2, 1, 2, 'asdasd', 'sdasd', 'sasd');

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

--
-- Dumping data for table `v_materialrequests`
--

INSERT INTO `v_materialrequests` (`id`, `requestId`, `categoryId`, `subCategoryId`, `quantityRequested`, `quantityDelivered`, `quantityAccepted`, `description`, `activeDoNumber`, `quantityRemaining`, `modfiedOn`) VALUES
(10, 2, 3, 5, 23, 13, 13, 'dasd', 4, 0, '2018-06-15 10:51:45'),
(22, 1, 1, 1, 234, 19, 19, 'as', 7, 0, '2018-06-15 20:13:34'),
(23, 1, 3, 5, 233, 18, 18, '', 7, 0, '2018-06-15 20:13:34'),
(25, 5, 1, 1, 342, 0, 0, 'sdas', 0, 342, '0000-00-00 00:00:00'),
(26, 6, 4, 6, 242, 0, 0, 'closed', 0, 242, '0000-00-00 00:00:00'),
(41, 12, 1, 1, 233, 0, 0, 'asd', 0, 233, '0000-00-00 00:00:00'),
(43, 13, 1, 1, 344, 0, 0, 'xvv', 0, 344, '0000-00-00 00:00:00'),
(44, 14, 1, 1, 2421, 0, 0, 'adada', 0, 2421, '0000-00-00 00:00:00'),
(45, 14, 3, 5, 34, 0, 0, 'sfs', 0, 34, '0000-00-00 00:00:00'),
(48, 15, 3, 5, 343, 0, 0, '', 0, 343, '0000-00-00 00:00:00'),
(49, 15, 2, 4, 23, 0, 0, 'ewqe', 0, 23, '0000-00-00 00:00:00'),
(52, 8, 1, 1, 344, -3155, -3155, 'adasd', 10, 0, '2018-06-24 10:12:11'),
(55, 7, 1, 2, 244, 20, 20, 'asd', 12, 0, '2018-06-24 10:14:12'),
(56, 7, 3, 5, 324, 0, 0, 'asasd', 12, 0, '2018-06-24 10:14:12'),
(67, 16, 1, 1, 234, 0, 0, '', 0, 234, '0000-00-00 00:00:00'),
(68, 16, 3, 5, 234, 0, 0, 'sdasd', 0, 234, '0000-00-00 00:00:00'),
(69, 17, 2, 3, 234, 0, 0, 'asdasd', 0, 234, '0000-00-00 00:00:00'),
(70, 18, 1, 1, 34, 0, 0, 'sasd', 0, 34, '0000-00-00 00:00:00'),
(71, 19, 1, 1, 325, 0, 0, 'aasd', 0, 325, '0000-00-00 00:00:00'),
(72, 20, 2, 3, 214, 0, 0, 'adad', 0, 214, '0000-00-00 00:00:00'),
(74, 21, 2, 3, 234, 0, 0, 'sd', 0, 234, '0000-00-00 00:00:00'),
(77, 23, 1, 1, 324, 0, 0, 'fas', 0, 324, '0000-00-00 00:00:00'),
(78, 22, 1, 1, 234, 200, 200, 'zcZ', 19, 0, '2018-07-07 20:16:28'),
(83, 24, 1, 1, 211, 0, 0, 'asdas', 0, 211, '0000-00-00 00:00:00'),
(84, 24, 3, 5, 233, 0, 0, 'as', 0, 233, '0000-00-00 00:00:00'),
(85, 25, 1, 1, 233, 0, 0, 'asdasd', 0, 233, '0000-00-00 00:00:00'),
(87, 26, 3, 5, 32324, 0, 0, 'descritpion', 0, 32324, '0000-00-00 00:00:00'),
(88, 4, 2, 3, 900, 530, 530, 'aasd', 22, 0, '2018-08-12 12:28:53'),
(89, 4, 3, 5, 213, 30, 30, 'asdasd', 22, 0, '2018-08-12 12:28:53'),
(90, 3, 4, 6, 900, 810, 810, 'jhjh', 23, 0, '2018-08-15 12:36:24'),
(91, 3, 3, 5, 570, 513, 513, 'cvbcv', 23, 0, '2018-08-15 12:36:24');

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
  `requestStatus` tinyint(2) NOT NULL,
  `approverComments` text NOT NULL,
  `notificationNumber` varchar(100) NOT NULL,
  `transferId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdOn` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_requests`
--

INSERT INTO `v_requests` (`requestId`, `notificationType`, `projectIdFrom`, `projectIdTo`, `description`, `driverId`, `vehicleId`, `remarks`, `requestStatus`, `approverComments`, `notificationNumber`, `transferId`, `createdBy`, `modifiedBy`, `modifiedOn`, `createdOn`) VALUES
(1, 1, 3, 0, '', 1, 2, 'asd', 4, 'approved', '', 0, 2, 2, '2018-06-15 15:57:49', '2018-06-12 15:44:39'),
(2, 1, 3, 0, '', 2, 3, 'asdasd', 4, 'approved', '', 0, 2, 0, '2018-06-15 05:21:45', '2018-06-15 04:32:57'),
(3, 1, 4, 0, '', 0, 0, 'zfdsdf', 4, 'approved', '', 0, 2, 2, '2018-08-15 07:07:11', '2018-06-15 05:27:29'),
(4, 1, 3, 0, '', 0, 0, 'asdasd', 4, 'rsDSA', '', 0, 2, 0, '2018-08-12 06:58:53', '2018-06-15 05:39:46'),
(5, 1, 3, 0, '', 0, 0, 'asdasd', 9, 'sdfsdf', '', 0, 2, 2, '2018-06-15 16:04:25', '2018-06-15 16:04:18'),
(6, 1, 4, 0, '', 0, 0, 'closed', 9, 'adasd', '', 0, 2, 0, '2018-06-15 19:36:56', '2018-06-15 16:06:56'),
(7, 1, 3, 0, '', 0, 0, 'ada', 4, 'asdasd', '', 0, 2, 0, '2018-06-24 04:44:12', '2018-06-16 05:39:18'),
(8, 1, 3, 0, '', 1, 2, 'fdgdfg', 4, 'approved', '', 0, 5, 0, '2018-06-24 04:42:12', '2018-06-16 06:46:20'),
(14, 2, 3, 0, '', 0, 0, 'zdfsdf', 11, '', '', 0, 2, 2, '2018-06-23 02:51:09', '2018-06-23 01:39:29'),
(15, 2, 3, 0, '', 0, 0, 'asasd', 8, '', '', 0, 2, 2, '2018-06-23 02:56:03', '2018-06-23 02:53:13'),
(16, 3, 3, 4, '', 0, 0, 'asdasd', 4, '', '3', 0, 2, 2, '2018-06-29 15:56:40', '2018-06-29 15:11:46'),
(17, 3, 4, 3, '', 0, 0, '', 4, '', '3', 0, 2, 2, '2018-06-29 16:00:00', '2018-06-29 15:58:04'),
(18, 3, 3, 4, '', 0, 0, 'asd', 4, '', '06/0003', 3, 2, 0, '2018-06-29 19:53:50', '2018-06-29 16:23:50'),
(19, 3, 3, 3, '', 0, 0, 'asdasd', 13, '', '06/0003', 3, 2, 2, '2018-06-29 17:15:09', '2018-06-29 16:50:26'),
(20, 2, 3, 0, '', 0, 0, 'asdasd', 11, '', '', 0, 2, 2, '2018-06-29 17:18:30', '2018-06-29 17:17:08'),
(21, 2, 3, 0, '', 0, 0, 'asdasd', 11, '', '', 0, 2, 2, '2018-07-15 10:11:27', '2018-06-29 17:31:11'),
(22, 1, 3, 0, '', 0, 0, 'ZXZX', 4, 'ZXZX', '', 0, 2, 2, '2018-07-15 09:51:18', '2018-06-30 00:39:52'),
(23, 3, 4, 3, '', 0, 0, 'dfdf', 13, '', '06/0003', 3, 2, 2, '2018-07-15 13:10:54', '2018-06-30 01:02:45'),
(24, 2, 3, 0, '', 0, 0, '', 11, '', '', 0, 2, 2, '2018-07-07 15:14:32', '2018-07-07 15:10:57'),
(25, 1, 3, 0, '', 0, 0, 'asdasd', 1, '', '', 0, 2, 0, '2018-07-13 20:15:24', '2018-07-13 16:45:24'),
(26, 1, 4, 0, '', 0, 0, 'REMARKS', 1, '', '', 0, 2, 2, '2018-07-13 17:01:13', '2018-07-13 17:01:06');

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
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `storeBalance` int(11) NOT NULL,
  `currentBalance` int(11) NOT NULL,
  `storeIn` int(11) NOT NULL,
  `storeOut` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `measurements` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_subcategory`
--

INSERT INTO `v_subcategory` (`subCategoryId`, `categoryId`, `subCategoryName`, `subCategoryStatus`, `createdBy`, `createdOn`, `storeBalance`, `currentBalance`, `storeIn`, `storeOut`, `price`, `measurements`) VALUES
(1, 1, '10MM', 1, 2, '2018-04-29 05:55:20', 10000, 10000, 0, 0, 100, 1),
(2, 1, '15MM', 1, 2, '2018-04-29 05:55:20', 10000, 10000, 0, 0, 100, 1),
(3, 2, '6MM', 1, 2, '2018-04-29 05:56:00', 10000, 9470, 0, 530, 100, 1),
(4, 2, '8MM', 1, 2, '2018-04-29 05:56:00', 10000, 10000, 0, 0, 100, 1),
(5, 3, '50MM', 1, 2, '2018-04-29 05:56:39', 10000, 9457, 0, 513, 100, 1),
(6, 4, '25MM', 1, 2, '2018-04-29 05:56:39', 10000, 9190, 0, 810, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `v_transferhistory`
--

CREATE TABLE `v_transferhistory` (
  `id` int(11) NOT NULL,
  `requestId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `subCategoryId` int(11) NOT NULL,
  `quantityRequested` int(11) NOT NULL,
  `quantityRemaining` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_transferhistory`
--

INSERT INTO `v_transferhistory` (`id`, `requestId`, `categoryId`, `subCategoryId`, `quantityRequested`, `quantityRemaining`, `description`) VALUES
(1, 21, 2, 3, 234, 234, 'sd'),
(2, 22, 1, 1, 234, 234, 'zcZ'),
(3, 25, 1, 1, 233, 233, 'asdasd'),
(4, 26, 3, 5, 32324, 32324, 'descritpion'),
(5, 26, 3, 5, 32324, 32324, 'descritpion');

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
-- Indexes for table `v_dogenerationhistory`
--
ALTER TABLE `v_dogenerationhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requestId` (`requestId`,`requestStatus`),
  ADD KEY `requestStatus` (`requestStatus`);

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
  ADD PRIMARY KEY (`requestId`),
  ADD KEY `requestId` (`requestId`,`notificationType`,`projectIdFrom`,`projectIdTo`,`requestStatus`),
  ADD KEY `requestStatus` (`requestStatus`);

--
-- Indexes for table `v_subcategory`
--
ALTER TABLE `v_subcategory`
  ADD PRIMARY KEY (`subCategoryId`),
  ADD KEY `subCategoryId` (`subCategoryId`,`categoryId`);

--
-- Indexes for table `v_transferhistory`
--
ALTER TABLE `v_transferhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `v_users`
--
ALTER TABLE `v_users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `userName` (`userName`,`password`);

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
-- AUTO_INCREMENT for table `v_dogenerationhistory`
--
ALTER TABLE `v_dogenerationhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `v_drivers`
--
ALTER TABLE `v_drivers`
  MODIFY `driverId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `v_materialrequests`
--
ALTER TABLE `v_materialrequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `v_projects`
--
ALTER TABLE `v_projects`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `v_requests`
--
ALTER TABLE `v_requests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `v_subcategory`
--
ALTER TABLE `v_subcategory`
  MODIFY `subCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `v_transferhistory`
--
ALTER TABLE `v_transferhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
