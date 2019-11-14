-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql56
-- Generation Time: Oct 19, 2019 at 06:57 PM
-- Server version: 5.6.33-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ite60010308_martd`
--

-- --------------------------------------------------------

--
-- Table structure for table `AllMeeting`
--

CREATE TABLE `AllMeeting` (
  `MeetingID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Topic` varchar(100) CHARACTER SET tis620 DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Host` varchar(50) CHARACTER SET tis620 DEFAULT NULL,
  `Place` tinytext CHARACTER SET tis620,
  `Doc_Link` varchar(200) CHARACTER SET tis620 DEFAULT NULL,
  `Conclusion` varchar(150) CHARACTER SET tis620 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AllMeeting`
--

INSERT INTO `AllMeeting` (`MeetingID`, `Topic`, `Date`, `Time`, `Host`, `Place`, `Doc_Link`, `Conclusion`) VALUES
(10043, 'How to use this web', '2019-05-08', '09:00:00', 'Group16', 'Building A', 'https://drive.google.com/', 'https://drive.google.com/'),
(10044, 'Openhouse', '2019-05-31', '17:00:00', 'Head', 'Building B', NULL, NULL),
(10076, 'Hello', '2020-01-01', '10:00:00', 'Sogood', 'World', 'https://drive.google.com/', NULL),
(10086, 'TestMeeting1', '2019-12-31', '20:00:00', 'PK', '', NULL, NULL),
(10087, 'TestMeeting2', '2019-12-31', '13:00:00', 'PK', 'Convention_Hall', NULL, NULL),
(10088, 'TestMeeting3', '2019-12-31', '05:00:00', 'PK', 'Hotel C', NULL, NULL),
(10089, 'TestMeeting4', '2019-11-12', '16:00:00', 'PK', 'MC', NULL, NULL),
(10090, 'your_topicofmeeting', '2019-07-09', '04:00:00', 'your_host', 'your_placetomeet', NULL, NULL),
(10091, 'easy', '2019-10-30', '08:02:00', 'ABC', 'easy clap', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `AllUser`
--

CREATE TABLE `AllUser` (
  `UserID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Name` varchar(100) CHARACTER SET tis620 DEFAULT NULL,
  `Last_Name` varchar(100) CHARACTER SET tis620 DEFAULT NULL,
  `Position` varchar(50) CHARACTER SET tis620 DEFAULT NULL,
  `Gender` varchar(20) CHARACTER SET tis620 DEFAULT NULL,
  `Age` tinyint(3) DEFAULT NULL,
  `Rank` varchar(10) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AllUser`
--

INSERT INTO `AllUser` (`UserID`, `Email`, `Password`, `Name`, `Last_Name`, `Position`, `Gender`, `Age`, `Rank`) VALUES
(01000, 'your_email@hotmail.com', 'your_password', 'your_firstname', 'your_lastname', 'your_position', 'your_gender', 18, 'your_rank'),
(01006, 'gameboy@hotmail.com', '123', 'Game', 'Matcha', 'Coding Assistant', 'Male', 21, 'User'),
(01009, 'lol@gmail.com', 'lol', 'Hello', 'World', 'Web Administrator', 'Female', 24, 'ADMIN'),
(01011, 'sMARCHz@gmail.com', 'sMARCHz', 'Nattanon', 'Chansamakr', 'Project Manager', 'Male', 21, 'User'),
(01012, 'coding@gmail.com', 'dev', 'I love', 'Coding', 'Developer', 'Male', 33, 'User'),
(01014, 'max@gmail.com', 'madmax', 'Hello', 'World', 'Just a guy', 'Male', 31, 'User'),
(01017, 'usertest@hotmail.com', 'testuser', 'Test_Account', 'User_Mode', 'Tester', 'Female', 26, 'User'),
(01018, 'meetingweb@gmail.com', 'meet', 'Test', 'Web', 'Tester', NULL, NULL, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE `Message` (
  `SenderID` int(5) NOT NULL,
  `ReceiverID` int(5) NOT NULL,
  `SendingTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Head` varchar(20) DEFAULT NULL,
  `MSID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `MeetingID` int(5) DEFAULT NULL,
  `Topic` varchar(100) CHARACTER SET tis620 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Message`
--

INSERT INTO `Message` (`SenderID`, `ReceiverID`, `SendingTime`, `Head`, `MSID`, `MeetingID`, `Topic`) VALUES
(1009, 1009, '2019-05-05 11:21:44', 'ADMINSEND', 00081, 10050, NULL),
(1009, 1009, '2019-05-05 11:45:05', 'ADMINSEND', 00085, 10051, NULL),
(1009, 1009, '2019-05-05 11:45:05', 'ADMINSEND', 00086, 10051, NULL),
(1009, 1009, '2019-05-05 12:18:54', 'ADMINSEND', 00089, 10052, NULL),
(1000, 1000, '2019-05-07 14:43:48', 'ADMINSEND', 00110, 10074, 'Thisismessage'),
(1000, 1000, '2019-05-07 15:07:52', 'ADMINSEND', 00113, 10075, 'Hello'),
(1009, 1009, '2019-05-18 07:40:32', 'ADMINSEND', 00129, 10045, 'Byenior'),
(1009, 1012, '2019-05-18 07:45:23', 'ADMINSEND', 00132, 10070, 'กินชาบู'),
(1009, 1012, '2019-05-18 07:45:23', 'ADMINSEND', 00137, 10070, 'กินชาบู'),
(1009, 1011, '2019-10-09 09:15:50', 'ADMINSEND', 00138, 10085, 'listen to spatify'),
(1009, 1014, '2019-10-09 09:15:50', 'ADMINSEND', 00139, 10085, 'listentospatify'),
(1009, 1012, '2019-10-09 09:16:34', 'ADMINSEND', 00141, 10081, 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `SelectedMeeting`
--

CREATE TABLE `SelectedMeeting` (
  `MeetingID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `SelectedID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `UserID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Priority` varchar(10) DEFAULT 'C',
  `MeetConf` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SelectedMeeting`
--

INSERT INTO `SelectedMeeting` (`MeetingID`, `SelectedID`, `UserID`, `Priority`, `MeetConf`) VALUES
(10076, 00394, 01017, 'C', 1),
(10043, 00415, 01018, 'C', 1),
(10044, 00416, 01000, 'A', 0),
(10044, 00417, 01006, 'B', 0),
(10044, 00418, 01009, 'A', 0),
(10044, 00419, 01011, 'B', 0),
(10044, 00420, 01012, 'C', 0),
(10076, 00425, 01009, 'B', 0),
(10086, 00426, 01017, 'A', 1),
(10087, 00427, 01017, 'B', 0),
(10087, 00428, 01012, 'B', 0),
(10088, 00429, 01017, 'C', 0),
(10089, 00430, 01006, 'A', 0),
(10089, 00431, 01017, 'C', 0),
(10090, 00432, 01017, 'A', 0),
(10076, 00433, 01006, 'B', 0),
(10076, 00434, 01000, 'C', 0),
(10091, 00435, 01000, 'A', 0),
(10091, 00436, 01006, 'B', 0),
(10091, 00437, 01011, 'B', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AllMeeting`
--
ALTER TABLE `AllMeeting`
  ADD PRIMARY KEY (`MeetingID`);

--
-- Indexes for table `AllUser`
--
ALTER TABLE `AllUser`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`MSID`);

--
-- Indexes for table `SelectedMeeting`
--
ALTER TABLE `SelectedMeeting`
  ADD PRIMARY KEY (`SelectedID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `MeetingID` (`MeetingID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AllMeeting`
--
ALTER TABLE `AllMeeting`
  MODIFY `MeetingID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10092;
--
-- AUTO_INCREMENT for table `AllUser`
--
ALTER TABLE `AllUser`
  MODIFY `UserID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1019;
--
-- AUTO_INCREMENT for table `Message`
--
ALTER TABLE `Message`
  MODIFY `MSID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `SelectedMeeting`
--
ALTER TABLE `SelectedMeeting`
  MODIFY `SelectedID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `SelectedMeeting`
--
ALTER TABLE `SelectedMeeting`
  ADD CONSTRAINT `SelectedMeeting_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `AllUser` (`UserID`),
  ADD CONSTRAINT `SelectedMeeting_ibfk_3` FOREIGN KEY (`MeetingID`) REFERENCES `AllMeeting` (`MeetingID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
