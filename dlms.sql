-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2022 at 01:19 PM
-- Server version: 10.4.10-MariaDB
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
-- Database: `dlms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `admin_photo` longblob DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_name` (`admin_name`),
  UNIQUE KEY `admin_username` (`admin_username`),
  UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

DROP TABLE IF EXISTS `learners`;
CREATE TABLE IF NOT EXISTS `learners` (
  `learners_id` int(11) NOT NULL AUTO_INCREMENT,
  `learners_photo` longblob DEFAULT NULL,
  `learners_name` varchar(20) NOT NULL,
  `learners_address` varchar(60) NOT NULL,
  `learners_province` varchar(20) NOT NULL,
  `max_students` int(11) NOT NULL,
  `learners_contact` varchar(20) NOT NULL,
  `learners_email` varchar(50) NOT NULL,
  `learners_website` varchar(100) DEFAULT NULL,
  `vehicle1` varchar(10) DEFAULT NULL,
  `bike_P` int(11) DEFAULT NULL,
  `vehicle2` varchar(20) DEFAULT NULL,
  `threeWheeler_P` int(11) DEFAULT NULL,
  `vehicle3` varchar(10) DEFAULT NULL,
  `car_P` int(11) DEFAULT NULL,
  `vehicle4` varchar(10) DEFAULT NULL,
  `van_P` int(11) DEFAULT NULL,
  `vehicle5` varchar(10) DEFAULT NULL,
  `truck_P` int(11) DEFAULT NULL,
  `vehicle6` varchar(10) DEFAULT NULL,
  `bus_P` int(11) DEFAULT NULL,
  `learners_password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`learners_id`),
  UNIQUE KEY `learners_name` (`learners_name`),
  UNIQUE KEY `learners_address` (`learners_address`),
  UNIQUE KEY `learners_email` (`learners_email`),
  UNIQUE KEY `learners_name_2` (`learners_name`),
  UNIQUE KEY `learners_name_3` (`learners_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

DROP TABLE IF EXISTS `permit`;
CREATE TABLE IF NOT EXISTS `permit` (
  `user_id` int(11) NOT NULL,
  `document` longblob NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `renewal_payment`
--

DROP TABLE IF EXISTS `renewal_payment`;
CREATE TABLE IF NOT EXISTS `renewal_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(225) DEFAULT NULL,
  `amount` int(11) DEFAULT 500,
  `paid` varchar(10) DEFAULT 'Yes',
  `paid_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploads`
--

DROP TABLE IF EXISTS `tbl_uploads`;
CREATE TABLE IF NOT EXISTS `tbl_uploads` (
  `fileid` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) NOT NULL,
  `filetype` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`fileid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trial_exam`
--

DROP TABLE IF EXISTS `trial_exam`;
CREATE TABLE IF NOT EXISTS `trial_exam` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `attempt` varchar(10) DEFAULT '1',
  `nic` varchar(20) NOT NULL,
  `date1` date DEFAULT NULL,
  `time1` varchar(255) DEFAULT NULL,
  `location1` varchar(255) DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `time2` varchar(255) DEFAULT NULL,
  `location2` varchar(255) DEFAULT NULL,
  `date3` date DEFAULT NULL,
  `time3` varchar(255) DEFAULT NULL,
  `location3` varchar(255) DEFAULT NULL,
  `date4` date DEFAULT NULL,
  `time4` varchar(255) DEFAULT NULL,
  `location4` varchar(255) DEFAULT NULL,
  `date5` date DEFAULT NULL,
  `time5` varchar(255) DEFAULT NULL,
  `location5` varchar(255) DEFAULT NULL,
  `date6` date DEFAULT NULL,
  `time6` varchar(255) DEFAULT NULL,
  `location6` varchar(255) DEFAULT NULL,
  `date7` date DEFAULT NULL,
  `time7` varchar(255) DEFAULT NULL,
  `location7` varchar(255) DEFAULT NULL,
  `overall` varchar(10) DEFAULT 'N/A',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trial_result`
--

DROP TABLE IF EXISTS `trial_result`;
CREATE TABLE IF NOT EXISTS `trial_result` (
  `user_id` int(11) NOT NULL,
  `attemptA1` varchar(10) DEFAULT '1',
  `resultA1` varchar(10) DEFAULT NULL,
  `attemptA` varchar(10) DEFAULT '1',
  `resultA` varchar(10) DEFAULT NULL,
  `attemptB1` varchar(10) DEFAULT '1',
  `resultB1` varchar(10) DEFAULT NULL,
  `attemptB` varchar(10) DEFAULT '1',
  `resultB` varchar(10) DEFAULT NULL,
  `attemptC1` varchar(10) DEFAULT '1',
  `resultC1` varchar(10) DEFAULT NULL,
  `attemptC` varchar(10) DEFAULT '1',
  `resultC` varchar(10) DEFAULT NULL,
  `attemptCE` varchar(10) DEFAULT '1',
  `resultCE` varchar(10) DEFAULT NULL,
  `attemptD1` varchar(10) DEFAULT '1',
  `resultD1` varchar(10) DEFAULT NULL,
  `attemptD` varchar(10) DEFAULT '1',
  `resultD` varchar(10) DEFAULT NULL,
  `attemptDE` varchar(10) DEFAULT '1',
  `resultDE` varchar(10) DEFAULT NULL,
  `attemptG1` varchar(10) DEFAULT '1',
  `resultG1` varchar(10) DEFAULT NULL,
  `attemptG` varchar(10) DEFAULT '1',
  `resultG` varchar(10) DEFAULT NULL,
  `attemptJ` varchar(10) DEFAULT '1',
  `resultJ` varchar(10) DEFAULT NULL,
  `paid` varchar(10) DEFAULT 'Yes',
  `Issued_state` int(11) DEFAULT NULL,
  `Issued_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trial_slip`
--

DROP TABLE IF EXISTS `trial_slip`;
CREATE TABLE IF NOT EXISTS `trial_slip` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `document` longblob NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `nic` (`nic`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_learners`
--

DROP TABLE IF EXISTS `users_learners`;
CREATE TABLE IF NOT EXISTS `users_learners` (
  `user_id` int(11) NOT NULL,
  `learners_id` int(11) NOT NULL,
  `joined_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `bike` tinyint(1) NOT NULL DEFAULT 0,
  `bike_s1` datetime DEFAULT NULL,
  `bike_s2` datetime DEFAULT NULL,
  `threeWheeler` tinyint(1) NOT NULL DEFAULT 0,
  `threeWheeler_s1` datetime DEFAULT NULL,
  `threeWheeler_s2` datetime DEFAULT NULL,
  `car` tinyint(1) NOT NULL DEFAULT 0,
  `car_s1` datetime DEFAULT NULL,
  `car_s2` datetime DEFAULT NULL,
  `van` tinyint(1) NOT NULL DEFAULT 0,
  `van_s1` datetime DEFAULT NULL,
  `van_s2` datetime DEFAULT NULL,
  `truck` tinyint(1) NOT NULL DEFAULT 0,
  `truck_s1` datetime DEFAULT NULL,
  `truck_s2` datetime DEFAULT NULL,
  `bus` tinyint(1) NOT NULL DEFAULT 0,
  `bus_s1` datetime DEFAULT NULL,
  `bus_s2` datetime DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `scheduled` varchar(1) DEFAULT '0',
  `no` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL,
  `address` varchar(225) NOT NULL,
  `province` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `A1` tinyint(1) DEFAULT NULL,
  `A` tinyint(1) DEFAULT NULL,
  `B1` tinyint(1) DEFAULT NULL,
  `B` tinyint(1) DEFAULT NULL,
  `C1` tinyint(1) DEFAULT NULL,
  `C` tinyint(1) DEFAULT NULL,
  `CE` tinyint(1) DEFAULT NULL,
  `D1` tinyint(1) DEFAULT NULL,
  `D` tinyint(1) DEFAULT NULL,
  `DE` tinyint(1) DEFAULT NULL,
  `G1` tinyint(1) DEFAULT NULL,
  `G` tinyint(1) DEFAULT NULL,
  `J` tinyint(1) DEFAULT NULL,
  `user_photo` longblob DEFAULT NULL,
  `photo_status` varchar(25) DEFAULT NULL,
  `nic_copy` longblob DEFAULT NULL,
  `nic_status` varchar(25) DEFAULT NULL,
  `birth_certificate` longblob DEFAULT NULL,
  `bc_status` varchar(25) DEFAULT NULL,
  `medical` longblob DEFAULT NULL,
  `medical_status` varchar(25) DEFAULT NULL,
  `status` varchar(25) DEFAULT 'Pending',
  `Description` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details_renewal`
--

DROP TABLE IF EXISTS `user_details_renewal`;
CREATE TABLE IF NOT EXISTS `user_details_renewal` (
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `province` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `user_photo` longblob DEFAULT NULL,
  `photo_status` varchar(25) DEFAULT NULL,
  `previous_license` longblob DEFAULT NULL,
  `license_status` varchar(25) DEFAULT NULL,
  `medical` longblob DEFAULT NULL,
  `medical_status` varchar(25) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `Issuing_State` int(11) DEFAULT NULL,
  `Issued_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `written_exam`
--

DROP TABLE IF EXISTS `written_exam`;
CREATE TABLE IF NOT EXISTS `written_exam` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `attempt` varchar(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `result` varchar(10) DEFAULT 'N/A',
  `trial_scheduled` varchar(10) DEFAULT 'No',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `written_exam_slip`
--

DROP TABLE IF EXISTS `written_exam_slip`;
CREATE TABLE IF NOT EXISTS `written_exam_slip` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `document` longblob NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `written_payment`
--

DROP TABLE IF EXISTS `written_payment`;
CREATE TABLE IF NOT EXISTS `written_payment` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `paid_at` datetime DEFAULT current_timestamp(),
  `paid` varchar(10) DEFAULT 'Yes',
  `scheduled` varchar(10) DEFAULT 'No',
  `attempt` varchar(10) DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
