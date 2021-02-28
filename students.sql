-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2021 at 06:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_pass` varchar(41) NOT NULL,
  `admin_phone` varchar(20) DEFAULT NULL,
  `gender_id` char(2) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_phone`, `gender_id`, `created_at`) VALUES
(5, 'iniobong', 'iniobong@gmail.com', 'password', '08109221432', '2', '2021-01-22'),
(6, 'Aniekeme Frank', 'aniekeme@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', '09032428924', '1', '2021-01-19'),
(7, 'Wilson Dakubo', 'wilson.d@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99', '09032538523', '1', '2021-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attend_id` int(11) NOT NULL,
  `course_name` varchar(30) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `arrival_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(30) DEFAULT NULL,
  `std_id` int(11) DEFAULT NULL,
  `duration_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `std_id`, `duration_id`) VALUES
(1, 'Graphics Designs', 10, 1),
(3, 'Database Administrator', 25, 2),
(4, 'Programming', 25, 2),
(8, 'Web Design', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE `duration` (
  `duration_id` int(11) NOT NULL,
  `duration_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duration`
--

INSERT INTO `duration` (`duration_id`, `duration_name`) VALUES
(1, '5 Weeks'),
(2, '2 Months'),
(3, '3 Months'),
(4, '4 Months'),
(5, '8 Weeks'),
(6, '6 Months'),
(7, '9 Months'),
(8, '12 Months');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL,
  `gender_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender_name`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `std_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `duration_id` int(11) DEFAULT NULL,
  `pay_type_id` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `std_id`, `course_id`, `duration_id`, `pay_type_id`, `payment_date`, `amount`) VALUES
(1, 22, 1, 2, 2, '2021-01-16', '100000'),
(2, 6, 2, 1, 1, '2020-12-02', '50000'),
(3, 9, 3, 1, 2, '2020-12-02', '50,000'),
(4, 11, 4, 0, 2, '2020-12-02', '50,000'),
(5, 25, 4, 2, 3, '2020-12-05', '100,000'),
(7, 45, 1, 2, 1, '2020-12-31', '100,000'),
(8, 43, 1, 2, 1, '2020-12-31', '100,000'),
(9, 20, 0, 2, 2, '2021-01-30', '100,000');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `pay_type_id` int(11) NOT NULL,
  `payment_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`pay_type_id`, `payment_type`) VALUES
(1, 'CASH'),
(2, 'TRANSFER'),
(3, 'POS'),
(4, 'CHECK');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `sponsor_id` int(11) NOT NULL,
  `sponsor_name` varchar(30) DEFAULT NULL,
  `std_id` int(11) NOT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `sponsor_email` varchar(30) DEFAULT NULL,
  `sponsor_phone` varchar(30) DEFAULT NULL,
  `sponsor_address` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`sponsor_id`, `sponsor_name`, `std_id`, `relationship`, `sponsor_email`, `sponsor_phone`, `sponsor_address`) VALUES
(1, 'Saturday Tombrown', 20, 'Father', 'saturdaytom@gmail.com', '09032452365', 'Ikot Akam Ibesit'),
(2, 'Dick Ezekiel', 22, 'Father', 'dickezekiel@yahoo.com', '09087658654', 'Aya Obio Akpa'),
(3, 'Etim Essien', 25, 'Father', 'etim.essien@yahoo.com', '09032547685', 'Eliozu, Portharcourt'),
(9, 'Christopher Ezemgbu', 26, 'Guidance', 'c.ezemgbu@gmail.com', '08032140984', 'Enugu State'),
(20, 'Alexander Essien', 63, 'Parent', 'essien.alex@yahoo.com', '08068702143', '35 Ikot Ekpene road, AKS');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(11) NOT NULL,
  `std_name` varchar(50) DEFAULT NULL,
  `std_email` varchar(30) DEFAULT NULL,
  `std_phone` varchar(30) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `duration_id` int(11) DEFAULT NULL,
  `pay_type_id` int(11) DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_name`, `std_email`, `std_phone`, `course_id`, `gender_id`, `sponsor_id`, `duration_id`, `pay_type_id`, `payment_id`, `image`) VALUES
(6, 'Charity Ekanem', 'ekanem@yahoo.com', '09043872398', 4, 1, 3, 2, 4, 5, ''),
(9, 'Nkechi Eluwa', 'eluwankechi@gmail.com', '08043240987', 3, 2, 2, 3, 4, 0, ''),
(10, 'Emmanuel Essien', 'emmaessien@yahho.com', '09043240942', 1, 1, 3, 5, 4, 6, ''),
(11, 'Emmanuel Essien etim', 'emmaessien@yahho.com', '09043240942', 1, 1, 3, 1, 2, 8, ''),
(12, 'Anthony Egesie', 'anthonyegesie@gmail.com', '09032449823', 3, 2, 3, 3, 3, 0, ''),
(13, 'Chimezie Emmanuel', 'chimenauel@yahoo.com', '08143263498', 2, 2, 1, 3, 3, 1, 'Profile13_4968364284.jpg'),
(14, 'Amanze Enac', 'amanze@yahoo.com', '08198355487', 2, 1, 1, 1, 1, 1, 'Profile14_8143667680.jpg'),
(15, 'Amanze Enac', 'amanze@yahoo.com', '08198355487', 4, 1, 3, 2, 3, 0, ''),
(16, 'Amanze Enac', 'amanze@yahoo.com', '08198355487', 2, 0, 0, 1, 0, 0, ''),
(17, 'Ebenezer Alex', 'ebenezer@yahoo.com', '09034129821', 0, 1, 1, 3, 4, 9, 'Profile17_4417524260.jpg'),
(20, 'Tombrown Godwin', 'godwintombrown@yahoo.com', '08198355487', 8, 1, 20, 1, 1, 1, 'Profile20_327603341.jpg'),
(21, 'Tombrown Godwin Udoka', 'godwintombrown@yahoo.com', '08198355487', 4, 1, 1, 4, 2, 0, ''),
(22, 'David Ezekiel', 'davidezekiel@gmail.com', '09065437687', 1, 1, 1, 1, 0, 0, ''),
(23, 'Anieka Etim', 'aniekan.etim@gmail.com', '08142124284', 1, 0, 2, 1, 4, 0, ''),
(25, 'Rachel Essien', 'rachelessien@gmail.com', '08132549853', 1, 2, 3, 1, 4, 1, 'Profile25_4938556445.jpg'),
(26, 'Endurance Nkanang', 'nkanang@yahoo.com', '07054327534', 1, 2, 2, 2, 4, 0, ''),
(27, 'Rachel Essien', 'rachelessien@gmail.com', '08132549853', 1, 2, 3, 1, 3, 6, ''),
(28, 'Rachel Essien', 'rachelessien@gmail.com', '08132549853', 3, 1, 2, 2, 1, 5, 'Profile28_1157068969.jpg'),
(31, 'Amanze Enac', 'amanze@yahoo.com', '09034129821', 2, 1, 3, 1, 1, 4, ''),
(32, 'Chibuike Eluwa', 'chieluwa@gmail.com', '08021349802', 6, 1, 3, 3, 1, 8, 'Profile32_5583415731.jpg'),
(33, 'Ikenna Zion', 'ikezion@gmail.com', '09102873290', 1, 1, 1, 1, 3, 4, ''),
(34, 'Osilem Endwell', 'eosilem@gmail.com', '07032120932', 4, 1, 6, 4, 2, 5, ''),
(35, 'Ekere Alexander', 'ekere.alex@yahoo.com', '08108327432', 5, 2, 1, 5, 1, 3, 'Profile35_2157248085.jpg'),
(36, 'Edward Nnamdi', 'edward@yahoo.com', '09121983099', 4, 1, 3, 3, 2, 5, '1.jpg'),
(37, 'Ebenezer Alex', 'alex.eben@yahoo.com', '08132149854', 1, 1, 3, 3, 3, 4, '1.jpg'),
(38, 'Israel Akpan', 'akpan.isreal@gmail.com', '08109214984', 5, 1, 2, 5, 2, 5, '2.jpg'),
(39, 'Davido Adeleke', 'davido@gmail.com', '08132843845', 5, 1, 4, 1, 2, 5, '1.jpg'),
(40, 'Chikezie Onuoha', 'chikezie@yahoo.com', '09054329844', 3, 1, 5, 2, 1, 6, '4.jpg'),
(41, 'Sifon Udoudo', 'sifonudo@gmail.com', '08143082844', 0, 2, 1, 5, 1, 1, 'Profile41_2333268390.jpg'),
(42, 'Ebube Chima', 'ebube@yahoo.com', '09132982343', 6, 1, 3, 3, 2, 5, 'Profile42_5558241653.jpg'),
(44, 'Austine Ezekiel', 'godwintombrown@yahoo.com', '07021093298', 1, 1, 2, 1, 1, 7, 'Profile44_9303314043.jpg'),
(46, 'Edidiong Ibanga', 'edidiong@gmail.com', '09032120932', 4, 1, 1, 1, 1, 1, 'Profile46_7653061273.jpg'),
(60, 'Nnaeze Chiedozie', 'nnaezechie@gmail.com', '09011329842', 7, 2, 19, 4, 2, 5, 'Profile_6581184774.jpg'),
(63, 'Ekere Alexander', 'ekere.alex@yahoo.com', '09032138912', 6, 2, 19, 2, 1, 7, 'Profile_9770781057.jpg'),
(64, 'Ekere Alexander', 'ekere.alex@yahoo.com', '09011329842', 0, 2, 20, 4, 1, 8, 'Profile64_7356299385.jpg'),
(65, 'Nnaeze Chiedozie', 'godwintombrown@gmail.com', '09032138912', 2, 2, 18, 2, 4, 7, 'Profile_1576120691.jpg'),
(67, 'Tombrown Godwin', 'amanze3@yahoo.com', '08198355487', 1, 1, 1, 2, 2, 9, 'Profile1611403437_7707586042.jpg'),
(68, 'Grace Benson', 'gbenson@yahoo.com', '09034129821', 1, 2, 1, 4, 1, 8, 'Profile1612111062_3126724588.jpg'),
(69, 'Nnaeze Chiedozie', 'nnaezechiechuks3@gmail.com', '09032189912', 1, 1, 9, 4, 2, 9, 'Profile69_3002801536.jpg'),
(70, 'Nnaeze Chiedozie', 'nnaezechiechuksvb@gmail.com', '09032189913', 0, 1, 9, 4, 2, 9, 'Profile70_7053589132.jpg'),
(71, 'Nnaeze Chiedozie', 'godwintombrown12@gmail.com', '09032138942', 0, 1, 1, 4, 1, 9, 'Profile71_8066544668.jpg'),
(72, 'Roland Eze', 'rolly@gmail.com', '09143872454', 0, 1, 1, 4, 2, 7, 'Profile72_8689226047.jpg'),
(73, 'Nnaeze Chiedozie', 'rollyland@gmail.com', '09032134444', NULL, 1, 1, 4, 1, 9, 'Profile1612621081_5022804769.jpg'),
(74, 'Orland Ike', 'orland@yahoo.com', '08612972188', 0, 1, 2, 4, 1, 9, 'Profile74_906874255.jpg'),
(75, 'Kelechi Ebube', 'lelechi@yahoo.com', '07012983208', NULL, 2, 3, 4, 1, 8, 'Profile1612622357_325703516.jpg'),
(76, 'Jackson Nkanang', 'jack.Nka@yahoo.com', '09032129870', NULL, 1, 2, 4, 1, 9, 'Profile1612992041_5667585856.jpg'),
(77, 'Ebuka Emeh', 'ebuka.emeh@yahoo.com', '08054376907', NULL, 1, 3, 4, 1, 9, 'Profile1613058744_5150640964.jpg'),
(78, 'Ezekiel Etim', 'ezek.etim@gmail.com', '09086542312', 0, 1, 3, 4, 2, 8, 'Profile78_6742221018.jpg'),
(79, 'Nnana edozie', 'edozie@yahoo.com', '0991872365', 0, 1, 2, 4, 3, 9, 'Profile79_1064062576.jpg'),
(80, 'Emenike Yaweh', 'emek.yaweh1@gmail.com', '09021987632', 0, 1, 9, 4, 1, 9, 'Profile80_8072463823.jpg'),
(81, 'Anietie Bassey', 'anietie.bassey@gmail.com', '08135420987', NULL, 1, 3, 4, 4, 8, 'Profile81_5585295245.jpg'),
(82, 'Paul Cletus', 'cletus.paul@yahoo.com', '07067120987', NULL, 1, 20, 4, 1, 7, 'Profile1613200809_2563001492.jpg'),
(83, 'Nwokolo Emmanuel', 'nwokolo@yahoo.com', '08021093242', NULL, 1, 9, 4, 2, 9, 'Profile1613653736_645787034.jpg'),
(84, 'Ebuka Ntov', 'ebuka@gmail.com', '08120932893', NULL, 1, 3, 3, 0, 5, 'Profile1613654133_9941932587.jpg'),
(85, 'Kelechi Nwobi', 'kelechi@yahoo.com', '09023120987', NULL, 1, 9, 4, 3, 9, 'Profile85_8919283392.jpg'),
(86, 'Ndifreke Inanang', 'ndifreke@yahoo.com', '08021091293', NULL, 2, 3, 3, 3, 5, 'Profile86_2020646743.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `std_courses_id` int(11) NOT NULL,
  `new_stud_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`std_courses_id`, `new_stud_id`, `course_id`) VALUES
(1, 73, 1),
(2, 73, 3),
(3, 73, 4),
(7, 75, 1),
(8, 75, 4),
(9, 75, 7),
(10, 76, 4),
(11, 76, 6),
(33, 79, 1),
(34, 79, 3),
(35, 80, 4),
(36, 80, 8),
(37, 78, 1),
(38, 78, 8),
(39, 72, 1),
(40, 72, 3),
(43, 74, 3),
(44, 74, 4),
(45, 82, 1),
(46, 82, 8),
(47, 64, 1),
(48, 64, 3),
(49, 41, 1),
(50, 41, 3),
(51, 17, 1),
(52, 17, 3),
(53, 71, 1),
(54, 71, 3),
(55, 71, 4),
(56, 83, 1),
(57, 83, 8),
(58, 84, 3),
(59, 84, 4),
(63, 85, 1),
(64, 85, 3),
(65, 85, 8),
(70, 86, 1),
(71, 86, 4),
(72, 25, 1),
(73, 25, 4),
(74, 20, 1),
(75, 20, 3),
(76, 70, 1),
(77, 70, 4),
(81, 81, 1),
(82, 81, 3),
(83, 81, 8);

-- --------------------------------------------------------

--
-- Table structure for table `student_user`
--

CREATE TABLE `student_user` (
  `student_user_id` int(11) NOT NULL,
  `new_stud_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(41) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_user`
--

INSERT INTO `student_user` (`student_user_id`, `new_stud_id`, `username`, `password`) VALUES
(1, 81, 'Anietie', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 82, 'Paulo', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 84, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(4, 85, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(5, 86, 'Ndifreke', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(41) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'Tombrown', 'tom@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'emma', 'emma@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'Achigbo Daniel', 'dan@gmail.com', '12345'),
(4, 'Ebenezer Ukpanah', 'ebenezer@gmail.com', 'password'),
(5, 'Aniekan Etim', 'aniekan.etim@gmail.com', ''),
(6, 'Aniekan Etim', 'aniekan.etim@gmail.com', '12345'),
(7, 'Ebenezer Ukpanah', 'Ebeukpanah@gmial.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(8, 'Ezekiel', 'ezekiel@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(9, 'Andrew Oscar', 'andrew.oscar@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attend_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `duration`
--
ALTER TABLE `duration`
  ADD PRIMARY KEY (`duration_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`pay_type_id`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`sponsor_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`std_courses_id`);

--
-- Indexes for table `student_user`
--
ALTER TABLE `student_user`
  ADD PRIMARY KEY (`student_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `duration`
--
ALTER TABLE `duration`
  MODIFY `duration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `pay_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `std_courses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `student_user`
--
ALTER TABLE `student_user`
  MODIFY `student_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
