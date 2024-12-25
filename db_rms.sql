-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2023 at 12:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `Uname` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL,
  `Pword` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL,
  `Lname` varchar(45) DEFAULT NULL,
  `Fname` varchar(45) DEFAULT NULL,
  `Mname` varchar(45) DEFAULT NULL,
  `Ename` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `userid`, `Uname`, `Pword`, `Lname`, `Fname`, `Mname`, `Ename`, `user_type`) VALUES
(5, 0, 'JDMnumbawan', 'HONDA', 'OBLEGO', 'ALEXANDER', 'CAMITAN', '', 'admin'),
(6, 0, 'alvin', '123', 'CAMACHO', 'ALVIN', 'E', '', 'user'),
(7, 0, 'clark', 'clarkTadeo1', 'TADEO', 'CLARK', '', '', 'admin'),
(8, 0, 'ediwow', '123456Hh', 'GONEDA', 'ERICK JAE', 'VERANA', '', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `collegestud`
--

CREATE TABLE `collegestud` (
  `ID` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `Stud_ID` varchar(255) NOT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Middlename` varchar(255) DEFAULT NULL,
  `Extensionname` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Perm_Address` varchar(255) DEFAULT NULL,
  `Nationality` varchar(255) DEFAULT NULL,
  `DoB` varchar(255) DEFAULT NULL,
  `PoB` varchar(255) DEFAULT NULL,
  `ContactNumber` varchar(255) DEFAULT NULL,
  `Course` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PSA` varchar(255) DEFAULT NULL,
  `Form138` varchar(255) DEFAULT NULL,
  `Form137` varchar(255) DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `MOA` varchar(255) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `Year` int(255) DEFAULT NULL,
  `user_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `am_pm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collegestud`
--

INSERT INTO `collegestud` (`ID`, `userid`, `Stud_ID`, `Lastname`, `Firstname`, `Middlename`, `Extensionname`, `Gender`, `Perm_Address`, `Nationality`, `DoB`, `PoB`, `ContactNumber`, `Course`, `Email`, `PSA`, `Form138`, `Form137`, `Picture`, `MOA`, `Status`, `Year`, `user_date`, `am_pm`) VALUES
(1, 0, '19-0029-490', 'OBLEGO', 'ALEXANDER', 'C.', '', 'Male', 'GMA CAVITE', 'FILIPINO', '2000-08-09', 'DASMARINAS CAVITE', '09666759522', 'BS Information Technology', 'alexanderoblego4570089@gmail.com', '', 'OBLEGO ALEXANDER C. .pdf', '', 'OBLEGO ALEXANDER C. .jpeg', 'OBLEGO ALEXANDER C. .pdf', 1, 2023, '2023-04-21 04:13:01.000000', 'AM'),
(2, 0, '18-2343-234', 'MINSI', 'GUSION', 'B.', '', 'Male', 'GMA CAVITE', 'FILIPINO', '2000-04-06', 'CEBU CITY', '09666759512', 'BS Information Technology', 'a1@gmail.com', 'MINSI GUSION B. .pdf', 'MINSI GUSION B. .pdf', 'MINSI GUSION B. .pdf', 'MINSI GUSION B. .jpeg', 'MINSI GUSION B. .pdf', 1, 2013, '2023-04-21 04:06:58.000000', 'AM'),
(3, 0, '17-2345-348', 'ALUCARD', 'BRUNO', 'E.', '', 'Male', 'GMA CAVITE', 'FILIPINO', '2000-09-08', 'GMA CAVITE', '09777658321', 'BS Information Technology', 'a6@gamil.com', 'ALUCARD BRUNO E. .pdf', 'ALUCARD BRUNO E. .pdf', 'ALUCARD BRUNO E. .pdf', 'ALUCARD BRUNO E. .jpeg', 'ALUCARD BRUNO E. .pdf', 1, 2022, '2023-04-21 04:09:33.000000', 'AM'),
(4, 0, '19-2452-789', 'ALICECERXANDER', 'COOPER', 'N.', '', 'Male', 'GMA CAVITE', 'FILIPINO', '2000-03-04', 'GMA CAVITE', '09666758432', 'BS Civil Engineering', 'a6@gmail.com', 'ALICE COOPER N. .pdf', 'ALICE COOPER N. .pdf', 'ALICE COOPER N. .pdf', 'ALICE COOPER N. .jpeg', '', 1, 2023, '2023-04-20 18:25:00.000000', 'AM'),
(5, 0, '17-5749-789', 'DELA CRUZ', 'JUAN DE LEON', 'Q.', '', 'Male', 'GMA CAVITE', 'FILIPINO', '2000-09-08', 'GMA CAVITE', '09777658234', 'BS Tourism', 'a7@gmail.com', 'DELA CRUZ JUAN DE LEON Q. .pdf', 'DELA CRUZ JUAN DE LEON Q. .pdf', 'WILLIS BRUCE Q. .pdf', 'DELA CRUZ JUAN DE LEON Q. .jpeg', 'DELA CRUZ JUAN DE LEON Q. .pdf', 1, 2023, '2023-04-20 17:46:38.000000', 'AM'),
(7, 0, '18-4235-457', 'ALCOS', 'GECKO', 'C.', '', 'Male', 'CARMONA CAVITE', 'FILIPINO', '2001-08-18', 'CARMONA CAVITE', '09666758432', 'BS Information Technology', 'alcos@gmail.com', 'ALCOS GECKO C. .pdf', 'ALCOS GECKO C. .pdf', '', '', '', 1, 2021, '2023-04-21 04:10:56.000000', 'AM'),
(8, 0, '19-0029-431', 'NOVELINO', 'ALEXIS JOHN', 'C.', '', 'Male', 'GMA CAVITE', 'FILIPINO', '2009-07-03', 'CEBU CITY', '09954943447', 'BS Computer Science', 'johnalexis167@gmail.com', '', '', 'NOVELINO ALEXIS JOHN C. .pdf', '', '', 1, 2023, '2023-04-10 19:35:42.000000', 'PM'),
(9, 0, 'g17-0298-738', 'GONEDA', 'ERICK JAE', 'VERANA', '', 'Male', 'P2 B13 L26 POB. 5', 'FILIPINO', '2001-10-05', 'G.M.A. CAVITE', '09274455961', 'AB Communication', 'goneda05@gmail.com', '', '', '', '', '', 1, 2017, '2023-04-10 19:37:03.000000', 'PM'),
(10, 0, '18-4234-456', 'GONEDA', 'ERICK', 'C,', '', 'Male', 'DFSDFSDFSD', 'FIL', '2000-08-09', 'GN', '56456456456', 'BS Information Technology', 'a1@gmail.com', 'GONEDA ERICK C, .pdf', 'GONEDA ERICK C, .pdf', '', '', '', 1, 2029, '2023-04-21 04:10:27.000000', 'AM');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shsstud`
--

CREATE TABLE `shsstud` (
  `ID` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `Stud_ID` varchar(255) NOT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Middlename` varchar(255) DEFAULT NULL,
  `Extensionname` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Perm_Address` varchar(255) DEFAULT NULL,
  `Nationality` varchar(255) DEFAULT NULL,
  `DoB` varchar(255) DEFAULT NULL,
  `PoB` varchar(255) DEFAULT NULL,
  `ContactNumber` varchar(255) DEFAULT NULL,
  `Strand` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PSA` varchar(255) DEFAULT NULL,
  `Form138` varchar(255) DEFAULT NULL,
  `Form137` varchar(255) DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `MOA` varchar(255) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `Year` int(255) NOT NULL,
  `user_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `am_pm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shsstud`
--

INSERT INTO `shsstud` (`ID`, `userid`, `Stud_ID`, `Lastname`, `Firstname`, `Middlename`, `Extensionname`, `Gender`, `Perm_Address`, `Nationality`, `DoB`, `PoB`, `ContactNumber`, `Strand`, `Email`, `PSA`, `Form138`, `Form137`, `Picture`, `MOA`, `Status`, `Year`, `user_date`, `am_pm`) VALUES
(1, 0, '18-23495-234', 'BATMAN', 'SUPERMAN', 'R.', '', 'Male', 'GAM CAVITE', 'FILIPINO', '2000-09-08', 'GMA CAVITE', '09666758421', 'Science, Technology, Engineering & Mathematics (STEM)', 'a6@gmail.com', '', '', '', '', '', 1, 2023, '2023-04-07 23:21:09.000000', 'PM'),
(2, 0, '4234-4234-4234', 'DASDAS', 'DASDA', 'C.', '', 'Male', 'FSDFSDFSDFSDFSD', 'FIL', '2000-08-01', 'FDFSDFSDF', '64564564564', 'Science, Technology, Engineering & Mathematics (STEM)', 'a1@gmail.com', 'DASDAS DASDA C. .pdf', 'DASDAS DASDA C. .pdf', 'DASDAS DASDA C. .pdf', 'DASDAS DASDA C. .jpeg', 'DASDAS DASDA C. .pdf', 1, 2023, '2023-04-13 23:58:10.000000', 'PM');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `user_log_id` int(3) NOT NULL,
  `userid` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `am_pm` varchar(255) NOT NULL,
  `actions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`user_log_id`, `userid`, `username`, `Lname`, `Fname`, `user_date`, `am_pm`, `actions`) VALUES
(1, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-10 19:30:57', 'PM', 'LOGGED OUT'),
(2, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:31:41', 'PM', 'LOGGED IN'),
(3, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:32:22', 'PM', 'UPDATED GECKO ALCOS IN COLLEGE'),
(4, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:32:22', 'PM', 'UPDATED GECKO ALCOS IN COLLEGE'),
(5, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:32:36', 'PM', 'LOGGED OUT'),
(6, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:32:51', 'PM', 'LOGGED IN'),
(7, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:34:41', 'PM', 'LOGGED OUT'),
(8, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:34:46', 'PM', 'LOGGED IN'),
(9, 0, 'ediwow', 'GONEDA', 'ERICK JAE', '2023-04-10 19:34:51', 'PM', 'LOGGED IN'),
(10, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:35:09', 'PM', 'UPDATED ALEXIS JOHN NOVELINO IN COLLEGE'),
(11, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:35:43', 'PM', 'UPDATED ALEXIS JOHN NOVELINO IN COLLEGE'),
(12, 0, 'ediwow', 'GONEDA', 'ERICK JAE', '2023-04-10 19:37:03', 'PM', 'ADDED ERICK JAE GONEDA IN COLLEGE'),
(13, 0, 'ediwow', 'GONEDA', 'ERICK JAE', '2023-04-10 19:37:24', 'PM', 'LOGGED OUT'),
(14, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:37:33', 'PM', 'LOGGED IN'),
(15, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:56:57', 'PM', 'LOGGED OUT'),
(16, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 19:57:15', 'PM', 'LOGGED OUT'),
(17, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-10 20:06:58', 'PM', 'LOGGED IN'),
(18, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-10 20:11:50', 'PM', 'LOGGED IN'),
(19, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-10 20:14:11', 'PM', 'LOGGED OUT'),
(20, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 20:14:55', 'PM', 'LOGGED IN'),
(21, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-10 20:17:05', 'PM', 'LOGGED OUT'),
(22, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 20:17:11', 'PM', 'LOGGED IN'),
(23, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 21:42:08', 'PM', 'LOGGED OUT'),
(24, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 21:42:41', 'PM', 'LOGGED IN'),
(25, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 21:42:53', 'PM', 'LOGGED OUT'),
(26, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-10 21:42:57', 'PM', 'LOGGED IN'),
(27, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-10 21:44:16', 'PM', 'LOGGED OUT'),
(28, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 21:44:24', 'PM', 'LOGGED IN'),
(29, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 21:46:42', 'PM', 'ADDED ERICK GONEDA IN COLLEGE'),
(30, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 21:50:04', 'PM', 'UPDATED THE PSA, FORM138 OF ERICK GONEDA IN COLLEGE'),
(31, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 21:52:42', 'PM', 'UPDATED ERICK GONEDA IN COLLEGE'),
(32, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 22:17:06', 'PM', 'LOGGED OUT'),
(33, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-10 22:18:03', 'PM', 'LOGGED IN'),
(34, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-12 03:45:47', 'PM', 'LOGGED IN'),
(35, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-13 04:35:39', 'AM', 'LOGGED OUT'),
(36, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-13 04:35:47', 'AM', 'LOGGED IN'),
(37, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-13 04:35:52', 'AM', 'LOGGED OUT'),
(38, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-13 04:36:01', 'AM', 'LOGGED IN'),
(39, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-13 04:37:12', 'AM', 'LOGGED OUT'),
(40, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-13 04:37:16', 'AM', 'LOGGED IN'),
(41, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-13 04:37:28', 'AM', 'LOGGED OUT'),
(42, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-13 04:40:58', 'AM', 'LOGGED IN'),
(43, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-12 17:19:54', 'AM', 'UPDATED GUSION MINSI IN COLLEGE'),
(44, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-12 17:39:26', 'AM', 'ADDED DASDA DASDAS IN SHS'),
(45, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-12 17:57:06', 'AM', 'LOGGED OUT'),
(46, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-13 23:16:22', 'PM', 'LOGGED IN'),
(47, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-13 23:58:09', 'PM', 'UPDATED THE PSA, FORM138, FORM137, PICTURE, MOA OF DASDA DASDAS IN SHS'),
(48, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-14 01:04:53', 'PM', 'UPDATED BRUNO ALUCARD IN COLLEGE'),
(49, 0, 'JDMnumbawan', 'OBLEGO', 'ALEXANDER', '2023-04-14 02:06:30', 'PM', 'LOGGED OUT'),
(50, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 04:50:42', 'PM', 'LOGGED IN'),
(51, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 02:37:46', 'PM', 'LOGGED IN'),
(52, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 03:14:17', 'PM', 'LOGGED OUT'),
(53, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 03:14:20', 'PM', 'LOGGED IN'),
(54, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 03:14:55', 'PM', 'UPDATED BRUNO ALUCARD IN COLLEGE'),
(55, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:03:10', 'AM', 'UPDATED ERICK GONEDA IN COLLEGE'),
(56, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:03:29', 'AM', 'UPDATED GECKO ALCOS IN COLLEGE'),
(57, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:03:50', 'AM', 'UPDATED GUSION MINSI IN COLLEGE'),
(58, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:06:58', 'AM', 'UPDATED GUSION MINSI IN COLLEGE'),
(59, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:07:50', 'AM', 'UPDATED ERICK GONEDA IN COLLEGE'),
(60, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:09:33', 'AM', 'UPDATED BRUNO ALUCARD IN COLLEGE'),
(61, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:10:28', 'AM', 'UPDATED ERICK GONEDA IN COLLEGE'),
(62, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:10:56', 'AM', 'UPDATED GECKO ALCOS IN COLLEGE'),
(63, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 04:13:01', 'AM', 'UPDATED ALEXANDER OBLEGO IN COLLEGE'),
(64, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 17:46:38', 'AM', 'UPDATED JUAN DE LEON DELA CRUZ IN COLLEGE'),
(65, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 17:46:52', 'AM', 'UPDATED COOPER ALICECERXANDER IN COLLEGE'),
(66, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 18:25:00', 'AM', 'UPDATED COOPER ALICECERXANDER IN COLLEGE'),
(67, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-20 19:33:40', 'PM', 'LOGGED IN'),
(68, 0, 'alvin', 'CAMACHO', 'ALVIN', '2023-04-21 01:34:53', 'PM', 'LOGGED OUT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `collegestud`
--
ALTER TABLE `collegestud`
  ADD PRIMARY KEY (`ID`,`Stud_ID`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shsstud`
--
ALTER TABLE `shsstud`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`user_log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `collegestud`
--
ALTER TABLE `collegestud`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shsstud`
--
ALTER TABLE `shsstud`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `user_log_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
