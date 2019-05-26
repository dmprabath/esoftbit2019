-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2019 at 05:51 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bitproject2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` char(8) NOT NULL,
  `emp_title` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_gender` int(11) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_mobile` char(12) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_nic` varchar(12) NOT NULL,
  `emp_doj` date NOT NULL,
  `emp_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `emp_title`, `emp_name`, `emp_dob`, `emp_gender`, `emp_address`, `emp_mobile`, `emp_email`, `emp_nic`, `emp_doj`, `emp_status`) VALUES
('EMP00001', 1, 'Lahiru chamara', '1995-04-11', 1, 'No.183,Mahayaya road ,Beliatta', '0712208520', 'mahiru1995@gmail.com', '951023299V', '2012-02-15', 1),
('EMP00002', 1, 'DMP Lakshitha', '1995-02-03', 1, 'School rd,Beliatta', '0712346578', 'lakshitha@gmail.com', '956723456V', '2014-02-13', 0),
('EMP00003', 1, 'Udara Shakthi', '1997-06-14', 1, 'Seruwila,Trincomalee', '0773456789', 'udaras@gmail.com', '973465922V', '2016-05-17', 1),
('EMP00004', 1, 'Miron Nishmika', '1997-06-18', 1, 'Kaduwela,Colombo', '0712345679', 'mironnis@gmail.com', '972345786V', '2018-12-12', 1),
('EMP00005', 1, 'Shahen Fernando', '1995-08-18', 1, 'Rathmalana,Colombo', '0762345687', 'shahenfer@live.com', '953467896V', '2009-03-13', 1),
('EMP00006', 1, 'Tharindu Dananjaya', '1995-09-16', 1, 'Darmapala Mw,Anuradapura', '0772345697', 'tarindanjya@live.com', '956734599V', '2014-08-20', 1),
('EMP00007', 2, 'Sachini Nirmali', '1997-09-17', 0, 'Kadana road, Gampaha', '0719723487', 'sachnir@yahoo.com', '975693456V', '2016-06-12', 1),
('EMP00008', 2, 'Vindya Ranathunga', '1995-07-09', 0, 'Main Road, Ranala', '0774569326', 'vindyaran@gmail.com', '953487299V', '2019-01-08', 1),
('EMP00009', 2, 'Malithi Kuruwitarachchi', '1996-08-10', 0, 'Temple Road, Kaduwela', '0773459245', 'malithikuru@gmail.com', '963456876V', '2018-09-19', 1),
('EMP00010', 2, 'Ravindya ridmi', '1997-03-13', 0, 'Mountan road,Walapane', '0752345756', 'ridmiravi@hotmail.com', '971254789V', '2010-11-08', 1),
('EMP00011', 2, 'Hiruni Dayawansa', '1997-11-11', 0, 'manik Mw,Rathnapura', '0723456789', 'hirudaya@yahoo.com', '972354234V', '2017-02-14', 1),
('EMP00012', 1, 'Tharindu Deeptha', '1994-09-10', 1, 'galle road,rathmalana', '0765423849', 'tharindud@hotmail.com', '941234654V', '2016-07-11', 1),
('EMP00013', 2, 'Jeniffer Iresha', '1997-01-06', 0, 'Gahata gahak mw,Moratuwa', '0712346598', 'ireshaj@hotmail.com', '972354167V', '2010-03-10', 1),
('EMP00014', 1, 'Nipuna ranathunga', '1997-10-25', 1, 'Lotus rd, Moratuwa', '0785467823', 'nipooo@ymail.com', '972378546V', '2013-06-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `usr_name` varchar(25) NOT NULL,
  `usr_pass` varchar(50) NOT NULL,
  `usr_type` tinyint(4) NOT NULL,
  `usr_status` tinyint(4) NOT NULL,
  `pwd_reset` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`usr_name`, `usr_pass`, `usr_type`, `usr_status`, `pwd_reset`) VALUES
('admin', '202cb962ac59075b964b07152d234b70', 1, 1, 0),
('lakshitha@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 0, 0),
('mahiru1995@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, 0),
('mironnis@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 1, 0),
('sachnir@yahoo.com', '6466fa20d406adf8e4a6461df5536caf', 3, 1, 1),
('shahenfer@live.com', 'feeab4fee67320c8d107525a7c7a74a3', 1, 1, 1),
('tarindanjya@live.com', 'dd8f339035ad353e126a8db03727857a', 2, 1, 1),
('udaras@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`usr_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
