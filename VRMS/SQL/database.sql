-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 05:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicli`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(10) NOT NULL,
  `a_name` varchar(20) NOT NULL,
  `a_pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_pass`) VALUES
(1, 'Admin', 'Admin@213');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `cname` text NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_proof` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `vehicle_name` text NOT NULL,
  `eng_num` varchar(20) NOT NULL,
  `rc_num` varchar(20) NOT NULL,
  `SI_no` int(10) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`cname`, `dob`, `email`, `id_proof`, `mobile`, `vehicle_name`, `eng_num`, `rc_num`, `SI_no`, `reg_date`) VALUES
('Hemanth V', '2004-12-11', 'hemanth@gmail.com', '671005362629', '936383636', 'Access120', 'EN000023', 'RC000231', 7, '2025-02-03'),
('Madhan Gowda ', '2004-05-03', 'mmadhangowdabh@gmail.com', '303229294501', '9363836363', 'Honda shine125', 'EN00001', 'RC00021', 8, '2025-02-02'),
('Rachan K Gowda', '2004-08-02', 'rachan@gmail.com', '834546334523', '2147483647', 'XL 125', 'EN0042532', 'RC000123', 10, '2025-02-04'),
('Yashwanth G R', '2004-06-03', 'yashwanth@gmail.com', '9345643363433', '984533243', 'NS-400', 'EN092522', 'RC782532', 11, '2025-02-04'),
('Vaishnavi I H', '2009-02-05', 'vaishnavi@gmail.com', '9893645345', '2147483647', 'Honda Due-100', 'EN09837', 'RC00867', 13, '2025-02-04'),
('Mubarak', '2004-02-08', 'mubarak@gmail.com', '985634873423', '9873463423', 'Honda Unicorn', 'EN989262', 'RC098923', 14, '2025-02-05'),
('Iha Sathis', '2014-06-24', 'iha@gmail.com', '9086356423', '9086753487', 'Active 5G', 'EN00898', 'RC00978', 15, '2025-02-05'),
('manu', '2004-02-09', 'man8u@gmail.com', '9898978967', '98629253', 'xL100', 'EN 002728', 'RC00272', 16, '2025-02-07'),
('Ram Kumar', '2014-06-03', 'ramkumar@gmail.com', '6272 2562 72653', '9673537232', 'car', 'EN00373', 'RC00373', 17, '2025-05-14'),
('Ram', '2007-06-13', 'ramkumar@gmail.com', '256347895467', '9689745685', 'TATA Safari', 'EN000342', 'RC00043', 18, '2025-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `upass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `upass`) VALUES
(1, 'staff1', '$2y$10$8CTfvwGLgLl6h4Ak5fmwEulHbE.465QeFW4bM5GhqKk'),
(2, 'staff2', 'staff2@213'),
(4, 'manoj', '123'),
(7, 'Madhan', '$2y$10$wX5vtMhvcu04/pWQDRHRo.tjy.dgOO07imNKwIK/oCc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`SI_no`,`rc_num`,`eng_num`,`id_proof`),
  ADD KEY `SI_no` (`SI_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`,`upass`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `SI_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
