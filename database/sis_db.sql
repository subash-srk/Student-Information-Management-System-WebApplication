-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 04, 2022 at 01:30 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_history`
--

DROP TABLE IF EXISTS `academic_history`;
CREATE TABLE IF NOT EXISTS `academic_history` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `student_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `semester` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `school_year` text NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '1= New,\r\n2= Regular,\r\n3= Returnee,\r\n4= Transferee',
  `end_status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0=pending,\r\n1=Completed,\r\n2=Dropout,\r\n3=failed,\r\n4=Transferred-out,\r\n5=Graduated',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

DROP TABLE IF EXISTS `course_list`;
CREATE TABLE IF NOT EXISTS `course_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `department_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `department_id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 1, 'BE CIVIL EM', 'Civil Engineering English', 1, 0, '2022-01-27 10:03:25', '2022-11-04 18:55:08'),
(2, 1, 'BE CIVIL TM', 'Civil Engineering Tamil', 1, 0, '2022-01-27 10:06:43', '2022-11-04 18:55:34'),
(3, 3, 'BE CSE', 'Computer Science & Engineering', 1, 0, '2022-01-27 10:07:21', '2022-11-04 18:59:09'),
(4, 4, 'BE EEE', 'Electrical & Electronics Engineering', 1, 0, '2022-01-27 10:07:52', '2022-11-04 18:58:12'),
(5, 5, 'BE ECE', 'Electronics and Communication Engineering', 1, 0, '2022-01-27 10:08:21', '2022-11-04 18:59:16'),
(6, 2, 'BE MECH TM', 'Mechanical Engineering Tamil', 1, 0, '2022-01-27 10:08:48', '2022-11-04 18:58:45'),
(7, 2, 'BE MECH EM', 'Mechanical Engineering English', 1, 0, '2022-01-27 10:09:00', '2022-11-04 18:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

DROP TABLE IF EXISTS `department_list`;
CREATE TABLE IF NOT EXISTS `department_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'CIVIL', 'Civil Engineering', 1, 0, '2022-01-27 09:22:31', '2022-11-04 18:52:19'),
(2, 'MECH', 'Mechanical Engineering', 1, 0, '2022-01-27 09:22:54', '2022-11-04 18:52:42'),
(3, 'CSE', 'Computer Science & Engineering', 1, 0, '2022-01-27 09:23:20', '2022-11-04 18:53:08'),
(4, 'EEE', 'Electrical & Electronics Engineering', 1, 0, '2022-01-27 09:25:42', '2022-11-04 18:53:29'),
(5, 'ECE', 'Electronics and Communication Engineering', 1, 0, '2022-01-27 09:26:35', '2022-11-04 18:54:07'),
(6, 'Sample101', 'Deleted Department', 1, 1, '2022-01-27 09:27:17', '2022-01-27 09:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

DROP TABLE IF EXISTS `student_list`;
CREATE TABLE IF NOT EXISTS `student_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `roll` varchar(100) NOT NULL,
  `dept` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text,
  `lastname` text,
  `fathername` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `dob` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `roll`,`dept`,`firstname`, `middlename`, `lastname`,`fathername`, `gender`, `contact`,`email`, `present_address`, `permanent_address`, `dob`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '231415061007','CSE', 'Augustus',NULL,'Waters','Matt Waters','Male', '09123456789','mail@gmail.com','This my sample present address.', 'This my sample permanent address.', '2007-06-23', 1, 0, '2022-01-27 11:14:07', '2022-01-28 08:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
CREATE TABLE IF NOT EXISTS `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Student Information Management System'),
(6, 'short_name', 'SIS'),
(11, 'logo', 'uploads/logo.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `middlename` text,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, '2021-01-20 14:02:37', '2021-12-14 15:47:08'),
(8, 'Claire', NULL, 'Blake', 'cblake', '4744ddea876b11dcb1d169fadf494418', 'uploads/avatar-8.png?v=1643185259', NULL, 2, 1, '2022-01-26 16:20:59', '2022-01-26 16:20:59');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_history`
--
ALTER TABLE `academic_history`
  ADD CONSTRAINT `academic_history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `academic_history_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_list`
--
ALTER TABLE `course_list`
  ADD CONSTRAINT `course_list_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
