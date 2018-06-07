-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2018 at 09:43 PM
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

--
-- Dumping data for table `v_dogenerationhistory`
--

INSERT INTO `v_dogenerationhistory` (`categoryId`, `subCategoryId`, `requestId`, `quantityDelivered`, `DONumber`, `createdOn`, `active`) VALUES
(0, 0, 0, 0, 1, '2018-05-31 18:18:24', 1),
(1, 0, 1, 1, 1, '2018-05-31 18:18:43', 1),
(3, 5, 44, 34, 2, '2018-06-01 19:25:30', 0),
(99999, 0, 44, 244, 2, '2018-06-01 19:25:30', 0),
(1, 1, 43, 0, 3, '2018-06-04 03:32:32', 0),
(4, 6, 43, 123, 3, '2018-06-04 03:32:32', 0),
(1, 2, 42, 6757, 4, '2018-05-31 19:22:14', 1),
(1, 1, 31, 30000, 5, '2018-06-01 19:23:09', 1),
(1, 1, 31, 30000, 5, '2018-06-01 19:23:09', 1),
(1, 1, 27, 123, 6, '2018-06-01 19:23:35', 1),
(3, 5, 44, 311, 7, '2018-06-01 19:25:30', 1),
(99999, 0, 44, 2201, 7, '2018-06-01 19:25:31', 1),
(1, 1, 43, 0, 8, '2018-06-04 03:32:32', 1),
(4, 6, 43, 123, 8, '2018-06-04 03:32:32', 1),
(1, 1, 41, 6000, 9, '2018-06-04 03:34:36', 0),
(3, 5, 41, 3000, 9, '2018-06-04 03:34:36', 0),
(1, 1, 41, 500, 10, '2018-06-04 03:34:36', 1),
(3, 5, 41, 432, 10, '2018-06-04 03:34:36', 1),
(2, 4, 46, 0, 11, '2018-06-06 17:48:48', 1),
(99999, 0, 46, 0, 11, '2018-06-06 17:48:48', 1),
(1, 2, 47, 0, 12, '2018-06-06 18:00:01', 0),
(99999, 2, 47, 0, 12, '2018-06-06 18:00:01', 0),
(99999, 0, 47, 0, 12, '2018-06-06 18:00:01', 0),
(2, 3, 47, 0, 12, '2018-06-06 18:00:01', 0),
(1, 2, 47, 0, 13, '2018-06-06 18:03:20', 0),
(99999, 2, 47, 0, 13, '2018-06-06 18:03:20', 0),
(99999, 0, 47, 0, 13, '2018-06-06 18:03:20', 0),
(2, 3, 47, 0, 13, '2018-06-06 18:03:20', 0),
(1, 2, 47, 0, 14, '2018-06-06 18:07:36', 0),
(99999, 2, 47, 0, 14, '2018-06-06 18:07:36', 0),
(99999, 0, 47, 0, 14, '2018-06-06 18:07:36', 0),
(2, 3, 47, 0, 14, '2018-06-06 18:07:36', 0),
(1, 2, 47, 0, 15, '2018-06-06 18:07:36', 1),
(99999, 2, 47, 0, 15, '2018-06-06 18:07:36', 1),
(99999, 0, 47, 0, 15, '2018-06-06 18:07:36', 1),
(2, 3, 47, 0, 15, '2018-06-06 18:07:36', 1);

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
  `description` text NOT NULL,
  `activeDoNumber` int(11) NOT NULL,
  `quantityRemaining` int(11) NOT NULL DEFAULT '-1',
  `modfiedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_materialrequests`
--

INSERT INTO `v_materialrequests` (`id`, `requestId`, `categoryId`, `subCategoryId`, `quantityRequested`, `quantityDelivered`, `description`, `activeDoNumber`, `quantityRemaining`, `modfiedOn`) VALUES
(1, 20, 1, 1, 22, 0, '', 0, 22, '2018-06-02 00:25:39'),
(2, 21, 1, 2, 12, 0, '', 0, 12, '2018-06-02 00:25:39'),
(3, 26, 1, 1, 21, 0, '', 0, 21, '2018-06-02 00:25:39'),
(4, 30, 2, 3, 23, 0, '', 0, 23, '2018-06-02 00:25:39'),
(5, 30, 3, 5, 343, 0, '', 0, 343, '2018-06-02 00:25:39'),
(6, 37, 1, 1, 22, 0, '', 0, 22, '2018-06-02 00:25:39'),
(7, 37, 3, 5, 0, 0, '', 0, 0, '2018-06-02 00:25:39'),
(8, 37, 1, 1, 556, 0, '', 0, 556, '2018-06-02 00:25:39'),
(9, 40, 1, 1, 899, 0, '', 0, 899, '2018-06-02 00:25:39'),
(11, 32, 2, 3, 22, 0, '', 0, 22, '2018-06-02 00:25:39'),
(14, 19, 1, 1, 12, 12, '', 0, 12, '2018-06-02 00:25:39'),
(15, 19, 2, 1, 787, 787, '', 0, 0, '2018-06-02 00:25:39'),
(16, 23, 1, 1, 22, 22, '', 0, 0, '2018-06-02 00:25:39'),
(17, 28, 3, 5, 224, 0, '', 0, 224, '2018-06-02 00:25:39'),
(18, 28, 1, 2, 556, 0, '', 0, 556, '2018-06-02 00:25:39'),
(19, 35, 1, 1, 22, 0, '', 0, 22, '2018-06-02 00:25:39'),
(20, 35, 3, 5, 0, 0, '', 0, 0, '2018-06-02 00:25:39'),
(21, 35, 2, 3, 808, 0, '', 0, 808, '2018-06-02 00:25:39'),
(22, 35, 1, 1, 90, 0, '', 0, 90, '2018-06-02 00:25:39'),
(23, 35, 1, 1, 77, 0, '', 0, 77, '2018-06-02 00:25:39'),
(24, 35, 99999, 0, 566, 0, '', 0, 566, '2018-06-02 00:25:39'),
(27, 34, 1, 1, 22, 0, '', 0, 22, '2018-06-02 00:25:39'),
(28, 34, 4, 6, 456, 0, '', 0, 456, '2018-06-02 00:25:39'),
(29, 34, 3, 5, 787, 0, '', 0, 787, '2018-06-02 00:25:39'),
(30, 34, 4, 6, 45, 0, '', 0, 45, '2018-06-02 00:25:39'),
(31, 45, 1, 1, 3455, 3455, '', 0, 3455, '2018-06-02 00:25:39'),
(32, 45, 99999, 0, 3455, 3455, '', 0, 3455, '2018-06-02 00:25:39'),
(36, 29, 1, 2, 24, 0, '', 0, 24, '2018-06-02 00:25:39'),
(39, 22, 1, 1, 22, 22, '', 0, 22, '2018-06-02 00:25:39'),
(40, 22, 4, 6, 3434, 3434, '', 0, 3434, '2018-06-02 00:25:39'),
(47, 42, 1, 2, 6757, 6757, '', 4, 6757, '2018-06-02 00:25:39'),
(48, 31, 1, 1, 22, 30000, '', 5, 22, '2018-06-01 21:23:09'),
(49, 31, 1, 1, 32234, 30000, '', 5, 32234, '2018-06-01 21:23:09'),
(50, 27, 1, 1, 123, 123, 'test  deds', 6, 123, '2018-06-01 21:23:35'),
(51, 44, 3, 5, 345, 311, '2333', 7, 345, '2018-06-01 21:25:30'),
(52, 44, 99999, 0, 2445, 2201, 'dsfsfsfs', 7, 2445, '2018-06-01 21:25:30'),
(53, 43, 1, 1, 233, 0, '', 8, 233, '2018-06-04 05:32:32'),
(54, 43, 4, 6, 123, 123, '', 8, 123, '2018-06-04 05:32:32'),
(57, 41, 1, 1, 6565, 500, '', 10, 6565, '2018-06-04 05:34:36'),
(58, 41, 3, 5, 3434, 432, '', 10, 3434, '2018-06-04 05:34:36'),
(63, 48, 1, 1, 23423, 0, 'asdasd', 0, 23423, '0000-00-00 00:00:00'),
(64, 48, 99999, 0, 23234, 0, 'asasdasd', 0, 23234, '0000-00-00 00:00:00'),
(65, 46, 2, 4, 5354, 0, 'asfasas', 11, 0, '2018-06-06 19:48:48'),
(66, 46, 99999, 0, 244, 0, 'asdsd', 11, 0, '2018-06-06 19:48:48'),
(79, 47, 1, 2, 334, 24, '', 15, 219, '2018-06-06 20:07:36'),
(80, 47, 99999, 2, 233, 16, 'dasdasd', 15, 146, '2018-06-06 20:07:36'),
(81, 47, 99999, 0, 224, 16, 'afsfd', 15, 146, '2018-06-06 20:07:36'),
(82, 47, 2, 3, 234, 16, '', 15, 146, '2018-06-06 20:07:36'),
(83, 0, 1, 1, 899, 99, '', 0, 800, '2018-06-07 19:46:48'),
(84, 0, 1, 1, 899, 99, '', 0, 800, '2018-06-07 20:09:18'),
(85, 1, 1, 1, 899, 99, '', 0, 800, '2018-06-07 20:23:37'),
(86, 52, 1, 1, 899, 99, '', 0, 800, '2018-06-07 20:28:50'),
(87, 53, 1, 1, 899, 80, '', 0, 720, '2018-06-07 20:30:21'),
(88, 54, 1, 1, 899, 72, '', 0, 648, '2018-06-07 20:49:04'),
(89, 55, 1, 1, 899, 700, '', 0, 199, '2018-06-07 20:52:06'),
(90, 56, 1, 1, 899, 100, '', 0, 99, '2018-06-07 20:54:55'),
(91, 57, 1, 1, 899, 700, '', 0, 100, '2018-06-07 21:12:11'),
(92, 58, 1, 1, 899, 0, '', 0, 100, '2018-06-07 21:14:35'),
(93, 59, 1, 1, 899, 100, '', 0, 0, '2018-06-07 21:20:44'),
(94, 60, 1, 1, 899, 101, '', 0, -1, '2018-06-07 21:35:22');

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

--
-- Dumping data for table `v_requests`
--

INSERT INTO `v_requests` (`requestId`, `notificationType`, `projectIdFrom`, `projectIdTo`, `description`, `driverId`, `vehicleId`, `remarks`, `approx`, `requestStatus`, `approverComments`, `notificationNumber`, `DORemarks`, `driverRemarks`, `parentId`, `createdBy`, `modifiedBy`, `modifiedOn`, `createdOn`) VALUES
(19, 2, 3, 0, 'description test', 1, 2, 'remarks test', 0, 4, 'approved', '2', 'this is test remarks do', '', 0, 2, 0, '2018-05-25 01:26:25', '2018-05-01 16:48:31'),
(20, 3, 3, 3, 'description sk', 2, 2, 'this is test remarks', 0, 1, '', '2', '', '', 0, 2, 0, '2018-05-01 20:20:46', '2018-05-01 16:50:46'),
(21, 1, 3, 0, 'this is test description', 0, 0, 'this is tet remarks', 0, 1, '', '', '', '', 0, 2, 0, '2018-05-02 03:52:55', '2018-05-02 00:22:55'),
(22, 1, 3, 0, 'xv sfs sf s sdf', 1, 2, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs1', 0, 4, 'sdsdsadf', '', '', '', 0, 2, 0, '2018-05-27 15:28:06', '2018-05-02 00:29:57'),
(23, 1, 3, 0, 'xv sfs sf s sdf', 2, 3, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 5, '', '', 'remarks in do generation', 'this is driver remarks', 0, 2, 0, '2018-05-25 14:53:08', '2018-05-02 00:30:48'),
(26, 1, 3, 0, 'sadasd', 0, 0, 'safasfasfsdf', 0, 6, '', '', '', '', 0, 2, 0, '2018-05-05 10:23:44', '2018-05-05 06:53:44'),
(27, 1, 3, 0, 'descriotion test', 1, 3, 'asasas', 0, 4, '', '', '', '', 0, 2, 0, '2018-06-01 15:53:35', '2018-05-05 07:22:59'),
(28, 1, 4, 0, 'xv sfs sf s sdf', 0, 0, 'test', 0, 1, '', '', '', '', 0, 2, 2, '2018-05-26 10:48:59', '2018-05-06 04:43:04'),
(29, 2, 4, 0, '', 1, 2, 'cvzxzxc', 0, 2, '', '', '', '', 0, 2, 2, '2018-05-27 08:38:14', '2018-05-06 04:54:53'),
(30, 1, 3, 0, '2saa asdasdasd a dsasd', 0, 0, 'asdasdasd', 0, 1, '', '', '', '', 0, 2, 0, '2018-05-10 19:11:16', '2018-05-10 15:41:16'),
(31, 0, 4, 0, 'xv sfs sf s sdf', 1, 2, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 4, '', '', '', '', 0, 2, 0, '2018-06-01 15:53:09', '2018-05-13 02:59:23'),
(32, 1, 3, 0, 'zx asasd', 0, 0, 'sasdasd', 0, 2, '', '', '', '', 0, 2, 2, '2018-05-13 05:08:26', '2018-05-13 03:00:30'),
(34, 1, 3, 0, '', 0, 0, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 1, '', '', '', '', 0, 2, 2, '2018-05-27 06:59:59', '2018-05-13 03:17:38'),
(35, 1, 3, 0, '', 0, 0, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 1, '', '', '', '', 0, 2, 2, '2018-05-27 06:41:11', '2018-05-13 03:20:43'),
(37, 1, 3, 0, 'xv sfs sf s sdf', 0, 0, 'sdsdgsdg s sdfs sdfs sdf sdfsd sd fsdfs', 0, 0, '', '', '', '', 0, 2, 0, '2018-05-13 07:12:11', '2018-05-13 03:42:11'),
(40, 1, 3, 0, 'ghhjg bjhj', 0, 0, '8hghjhhjhjh jhgjgjjk', 0, 99, 'approved', '', '', '', 0, 2, 0, '2018-05-13 04:08:41', '2018-05-13 04:06:41'),
(41, 1, 3, 0, 'hjhghjgh', 1, 3, '', 0, 4, 'confirmed', '', 'sdfdsf', '', 0, 2, 0, '2018-06-04 00:04:36', '2018-05-13 04:18:34'),
(42, 1, 3, 0, ',bjjhj', 1, 2, '', 0, 4, 'dgszf', '', 'ADad', '', 0, 2, 0, '2018-05-31 15:52:14', '2018-05-13 05:06:17'),
(43, 1, 3, 0, '', 1, 3, '', 0, 4, 'sssss', '', '', '', 0, 2, 0, '2018-06-04 00:02:31', '2018-05-27 03:36:09'),
(44, 1, 3, 0, '', 1, 3, 'ddfsfs ssssd', 0, 4, 'approved', '', '', '', 0, 2, 0, '2018-06-01 15:55:30', '2018-05-27 07:03:50'),
(45, 1, 3, 0, '', 1, 2, 'fsfasfsf', 0, 5, 'ZXZCZXC', '', 'REMARkkss', '', 0, 2, 0, '2018-05-27 15:56:21', '2018-05-27 07:05:35'),
(46, 1, 3, 0, '', 1, 2, 'asasdsa', 0, 4, 'sfasfasf', '', '', '', 0, 2, 0, '2018-06-06 14:18:48', '2018-05-27 08:33:50'),
(47, 1, 3, 0, '', 1, 2, '', 0, 4, 'saasd', '', 'fff', '', 0, 2, 0, '2018-06-06 14:37:35', '2018-06-06 13:42:28'),
(48, 1, 3, 0, '', 0, 0, '', 0, 2, '', '', '', '', 0, 2, 0, '2018-06-06 17:16:12', '2018-06-06 13:46:12'),
(52, 1, 3, 0, 'ghhjg bjhj', 1, 2, '8hghjhhjhjh jhgjgjjk', 0, 99, 'approved', '', 'remarks do', '', 40, 2, 0, '2018-06-07 18:28:50', '2018-05-13 04:06:41'),
(53, 1, 3, 0, 'ghhjg bjhj', 2, 3, '8hghjhhjhjh jhgjgjjk', 0, 99, 'approved', '', 'remakrs do 2', '', 52, 2, 0, '2018-06-07 18:30:20', '2018-05-13 04:06:41'),
(54, 1, 3, 0, 'ghhjg bjhj', 1, 2, '8hghjhhjhjh jhgjgjjk', 0, 3, 'approved', '', 'sdfsdf', '', 53, 2, 0, '2018-06-07 18:49:02', '2018-05-13 04:06:41'),
(55, 1, 3, 0, 'ghhjg bjhj', 1, 2, '8hghjhhjhjh jhgjgjjk', 0, 99, 'approved', '', 'xsfsdf', '', 40, 2, 0, '2018-06-07 18:52:05', '2018-05-13 04:06:41'),
(56, 1, 3, 0, 'ghhjg bjhj', 1, 2, '8hghjhhjhjh jhgjgjjk', 0, 4, 'approved', '', 'doremarks', '', 55, 2, 0, '2018-06-07 18:54:55', '2018-05-13 04:06:41'),
(57, 1, 3, 0, 'ghhjg bjhj', 1, 2, '8hghjhhjhjh jhgjgjjk', 0, 4, 'approved', '', 'remarks', '', 52, 2, 0, '2018-06-07 19:12:10', '2018-05-13 04:06:41'),
(58, 1, 3, 0, 'ghhjg bjhj', 1, 3, '8hghjhhjhjh jhgjgjjk', 0, 4, 'approved', '', 'ddf', '', 57, 2, 0, '2018-06-07 19:14:34', '2018-05-13 04:06:41'),
(59, 1, 3, 0, 'ghhjg bjhj', 1, 2, '8hghjhhjhjh jhgjgjjk', 0, 4, 'approved', '', 'asdasdasd', '', 58, 2, 0, '2018-06-07 19:20:44', '2018-05-13 04:06:41'),
(60, 1, 3, 0, 'ghhjg bjhj', 2, 2, '8hghjhhjhjh jhgjgjjk', 0, 4, 'approved', '', '', '', 58, 2, 0, '2018-06-07 19:35:22', '2018-05-13 04:06:41');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `v_projects`
--
ALTER TABLE `v_projects`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `v_requests`
--
ALTER TABLE `v_requests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
