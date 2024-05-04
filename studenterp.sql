-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 01:11 PM
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
-- Database: `studenterp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `token_expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `type`, `userID`, `password`, `name`, `email`, `image_path`, `reset_token`, `token_expiry`, `blocked`) VALUES
(1, 'teacher', '', 'a426dcf72ba25d046591f81a5495eab7', 'Prof. Vikram Joshi', 'vikram564@gmail.com', '', '', '2024-04-26 07:18:39', 0),
(2, 'teacher', '', 'techer123', 'Prof. Siddharth Desai', 'siddhart543@gmail.com', '', '', '2024-04-26 07:18:46', 0),
(15, 'admin', 'admin', '4d8a64201228437c85b8ab6a0e98efe6', 'admin', 'admin@gmail.com', 'admin.jpg', 'cbc7e4dab1e6cc2a6661ff6b2e10f318d115b44ee1260176ec4b10c129e3cc22', '2024-04-26 07:34:04', 0),
(17, 'student', 'b520003', '5cd0d63dae31a30a6af9d6a89754b42b', 'Sudhansu Kumar', 'student3@gmail.com', '../uploads/1573709.jpg', '', '2024-04-26 07:41:04', 0),
(18, 'student', 'b520005', 'f4fd77ef3bf8ee85f199bb4d9dcd9bc8', 'Divya Joshi', 'student5@gmail.com', '../uploads/1701881678797-01.jpeg.jpg', '', '2024-04-26 07:34:16', 0),
(38, 'student', 'A250076', '586727d614c60f7829efee5f6a5fb248', 'Shrijan Mohapatra', 'A250076@gmail.com', '../uploads/2021-06-22 21.08.17.jpg', '', '2024-04-26 06:20:05', 0),
(41, 'teacher', 'teacher6', '218dd27aebeccecae69ad8408d9a36bf', 'Dr. Riya Sharma', 'riya.sharma@example.com', '', '', '2024-04-26 08:33:50', 0),
(42, 'teacher', 'teacher7', '00cdb7bb942cf6b290ceb97d6aca64a3', 'Professor Arjun Patel', 'arjun.patel@example.com', '', '', '2024-04-26 08:33:50', 0),
(43, 'teacher', 'teacher8', 'b25ef06be3b6948c0bc431da46c2c738', 'Dr. Ananya Singh', 'ananya.singh@example.com', '', '', '2024-04-26 08:33:50', 0),
(44, 'teacher', 'teacher9', '5d69dd95ac183c9643780ed7027d128a', 'Professor Yuvraj Kumar', 'yuvraj.kumar@example.com', '', '', '2024-04-26 08:33:50', 0),
(45, 'teacher', 'teacher10', '87e897e3b54a405da144968b2ca19b45', 'Dr. Aisha Gupta', 'aisha.gupta@example.com', '', '', '2024-04-26 08:33:50', 0),
(46, 'teacher', 'teacher11', '1e5c2776cf544e213c3d279c40719643', 'Professor Kabir Sharma', 'kabir.sharma@example.com', '', '', '2024-04-26 08:33:50', 0),
(47, 'teacher', 'teacher12', 'c24a542f884e144451f9063b79e7994e', 'Dr. Aaradhya Patel', 'aaradhya.patel@example.com', '', '', '2024-04-26 08:33:50', 0),
(48, 'teacher', 'teacher13', 'ee684912c7e588d03ccb40f17ed080c9', 'Professor Diya Singh', 'diya.singh@example.com', '', '', '2024-04-26 08:33:50', 0),
(49, 'teacher', 'teacher14', '8ee736784ce419bd16554ed5677ff35b', 'Dr. Advik Kumar', 'advik.kumar@example.com', '', '', '2024-04-26 08:33:50', 0),
(50, 'teacher', 'teacher15', '9141fea0574f83e190ab7479d516630d', 'Professor Anvi Gupta', 'anvi.gupta@example.com', '', '', '2024-04-26 08:33:50', 0),
(51, 'teacher', 'teacher16', '2b40aaa979727c43411c305540bbed50', 'Dr. Kabir Singh', 'kabir.singh@example.com', '', '', '2024-04-26 08:33:50', 0),
(52, 'teacher', 'teacher17', 'a63f9709abc75bf8bd8f6e1ba9992573', 'Professor Aisha Sharma', 'aisha.sharma@example.com', '', '', '2024-04-26 08:33:50', 0),
(53, 'teacher', 'teacher18', '80b8bdceb474b5127b6aca386bb8ce14', 'Dr. Vihaan Patel', 'vihaan.patel@example.com', '', '', '2024-04-26 08:33:50', 0),
(54, 'teacher', 'teacher19', 'e532ae6f28f4c2be70b500d3d34724eb', 'Professor Myra Gupta', 'myra.gupta@example.com', '', '', '2024-04-26 08:33:50', 0),
(55, 'teacher', 'teacher20', 'aee67d9bb569ad1562f7b67cfccbd2ef', 'Dr. Dhruv Kumar', 'dhruv.kumar@example.com', '', '', '2024-04-26 08:33:50', 0),
(56, 'student', 'A20345', '218dd27aebeccecae69ad8408d9a36bf', 'Aarav Kumar', 'A20345@gmail.com', '', '', '2024-04-26 08:33:50', 0),
(57, 'student', 'A21478', '00cdb7bb942cf6b290ceb97d6aca64a3', 'Isha Sharma', 'A21678@gmail.com', '', '', '2024-04-26 08:33:50', 0),
(58, 'student', 'A20457', 'b25ef06be3b6948c0bc431da46c2c738', 'Aditi Patel', 'A20457@gmail.com', '', '', '2024-04-26 08:33:50', 0),
(59, 'student', 'A23565', '5d69dd95ac183c9643780ed7027d128a', 'Neha Gupta', 'A23565@gmail.com', '', '', '2024-04-26 08:33:50', 0),
(60, 'student', 'A21603', 'password10', 'Vivaan Singh', 'A21603@gmail.com', '', '', '2024-04-26 08:29:14', 0),
(61, 'student', 'A22605', 'password11', 'Aaradhya Gupta', 'A22605@gmail.com', '', '', '2024-04-26 08:29:14', 0),
(62, 'student', 'A23798', 'password12', 'Kabir Nagar', 'A23798@gmail.com', '', '', '2024-04-26 08:29:14', 0),
(63, 'student', 'A22408', 'password13', 'Ananya Sharma', 'A22408@gmail.com', '', '', '2024-04-26 08:29:14', 0),
(64, 'student', 'A24545', 'password14', 'Advik Patel', 'A24545@gmail.com', '', '', '2024-04-26 08:29:14', 0),
(65, 'student', 'A23534', 'password15', 'Myra Kumar', 'A23534@gmail.com', '', '', '2024-04-26 08:29:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_replies`
--

CREATE TABLE `admin_replies` (
  `id` int(11) NOT NULL,
  `query_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_replies`
--

INSERT INTO `admin_replies` (`id`, `query_id`, `admin_id`, `reply`, `timestamp`) VALUES
(8, 23, 15, 'Thank you for reaching out regarding the availability of the \"Introduction to Data Science\" course for the upcoming semester. We appreciate your interest in this field and your proactive approach to planning your academic schedule.', '2024-04-26 13:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `date`, `status`) VALUES
(1, '18', '2024-04-10', 'Present '),
(2, '3', '2024-04-10', 'Present'),
(3, '18', '2024-04-11', 'Present'),
(4, '18', '2024-04-18', 'Present'),
(5, '18', '2024-04-19', 'Present'),
(6, '18', '2024-04-22', 'Present'),
(7, '18', '2024-04-23', 'Present'),
(8, '38', '2024-04-26', 'Present'),
(9, '18', '2024-04-26', 'Present'),
(10, '17', '2024-04-26', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `campusfunctions`
--

CREATE TABLE `campusfunctions` (
  `id` int(11) NOT NULL,
  `headline` varchar(1000) NOT NULL,
  `content` mediumtext NOT NULL,
  `published_by` varchar(50) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `file_path` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campusfunctions`
--

INSERT INTO `campusfunctions` (`id`, `headline`, `content`, `published_by`, `created_at`, `file_path`) VALUES
(5, 'Exciting Upcoming Campus Events!', '1.Spring Fling Carnival:  Get ready for a day of fun and games at our annual Spring Fling Carnival! Join us on the quad for carnival rides, delicious food trucks, live music, and plenty of prizes. It\'s the perfect opportunity to soak up the sun and enjoy some well-deserved relaxation with your fellow students.\r\n\r\n2.Guest Speaker Series: Expand your horizons with our guest speaker series featuring prominent industry professionals and thought leaders. This month, we\'re honored to welcome a renowned entrepreneur who will share insights into building successful startups and navigating the business world. Don\'t miss this chance to gain valuable knowledge and network with industry insiders.\r\n\r\n3.Outdoor Movie Night: Grab your blankets and popcorn for an unforgettable outdoor movie night under the stars! Join us on the lawn for a screening of a classic film that\'s sure to entertain audiences of all ages. It\'s the perfect way to unwind after a long week of classes and connect with friends in a relaxed, laid-back atmosphere.\r\nFitness Workshops: Kickstart your fitness journey with our series of interactive workshops designed to help you stay healthy and active. From yoga and meditation sessions to high-intensity interval training, there\'s something for every fitness level and interest. Join us in the campus gym and discover new ways to prioritize your physical and mental well-being.\r\n\r\n', 'Campus Events Committee', '2024-04-26', ''),
(9, 'Call for Campus Sustainability Initiatives', 'Green Campus Projects: Do you have ideas for projects that can help reduce our environmental footprint? Whether it\'s implementing recycling programs, promoting energy conservation, or advocating for sustainable transportation options, we want to hear from you! Form teams with your peers and submit proposals for innovative sustainability projects that can make a tangible difference on campus.\r\n Expand your knowledge and skills with our series of sustainability workshops and seminars. Learn about topics such as renewable energy, waste reduction, sustainable agriculture, and more from experts in the field. These interactive sessions will provide valuable insights and practical tips for incorporating sustainable practices into your daily life.', 'Sustainability Committee', '2024-04-26', ''),
(10, 'Invitation to Campus Diversity Dialogue Series', 'Dear Students,\r\n\r\nWe are excited to invite you to participate in our upcoming Campus Diversity Dialogue Series, a platform designed to foster meaningful conversations and promote understanding and appreciation of diversity on our campus.\r\n\r\nIn today\'s interconnected world, embracing diversity and promoting inclusivity are more important than ever. Through this dialogue series, we aim to create a safe and welcoming space where students from all backgrounds can come together to share their experiences, perspectives, and ideas.', 'Diversity and Inclusion Committee', '2024-04-26', '662bb190d2da2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `programmes` text NOT NULL,
  `added_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_payments`
--

CREATE TABLE `fee_payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `fee_payments`
--

INSERT INTO `fee_payments` (`id`, `student_id`, `month`, `status`, `payment_date`) VALUES
(4, 18, '5th sem', 'success', '2024-04-23 18:30:00'),
(6, 3, '4th sem', 'pending', '2024-04-25 17:40:52'),
(11, 18, '6th sem', 'success', '2024-04-23 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metadata`
--

CREATE TABLE `metadata` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metadata`
--

INSERT INTO `metadata` (`id`, `item_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'programme ', '3'),
(2, 1, 'programme', '4'),
(9, 2, 'programme', '3'),
(10, 2, 'programme', '4'),
(14, 10, 'day_name', 'monday'),
(20, 10, 'subject_id', '24'),
(21, 10, 'period_id', '8'),
(26, 8, 'from', '09:00'),
(27, 8, 'to', '09:45'),
(30, 9, 'from', '09:50'),
(31, 9, 'to', '10:35'),
(32, 18, 'from', '10:40'),
(33, 18, 'to', '11:25'),
(34, 19, 'from', '11:30'),
(35, 19, 'to', '12:15'),
(39, 20, 'period_id', '8'),
(40, 20, 'day_name', 'tuesday'),
(41, 23, 'subject_id', '25'),
(42, 10, 'semester_id', '1'),
(43, 10, 'programme_id', '3'),
(44, 19, 'subjects', '19'),
(45, 10, 'Data Structures', '22'),
(46, 23, 'semester_id', '1'),
(47, 23, 'programme_id', '3'),
(49, 23, 'period_id', '8'),
(50, 23, 'day_name', 'tuesday'),
(51, 23, 'subject_id', '1'),
(53, 26, 'semester_id', '1'),
(54, 26, 'programme_id', '3'),
(56, 26, 'period_id', '18'),
(57, 26, 'day_name', 'wednesday'),
(58, 26, 'subject_id', '25'),
(60, 27, 'status', 'success'),
(61, 27, 'student_id', '18'),
(62, 27, 'month', 'April'),
(67, 29, 'programme', '3'),
(68, 29, 'programme', '4'),
(69, 29, 'programme', '3'),
(70, 29, 'programme', '4'),
(74, 32, 'programme', '3'),
(75, 32, 'programme', '4'),
(79, 33, 'programme', '3'),
(80, 33, 'programme', '4'),
(84, 34, 'programme', '3'),
(85, 34, 'programme', '4'),
(89, 37, 'from', '12:20'),
(90, 37, 'to', '13:05'),
(91, 38, 'from', '12:20'),
(92, 38, 'to', '13:05'),
(93, 39, 'from', '13:05'),
(94, 39, 'to', '14:00'),
(95, 40, 'from', '02:00'),
(96, 40, 'to', '02:45'),
(97, 41, 'from', '02:50'),
(98, 41, 'to', '03:35'),
(99, 42, 'from', '14:00'),
(100, 42, 'to', '14:45'),
(101, 43, 'from', '14:50'),
(102, 43, 'to', '15:35'),
(103, 44, 'from', '15:40'),
(104, 44, 'to', '16:25'),
(105, 45, 'from', '16:30'),
(106, 45, 'to', '17:15'),
(107, 46, 'semester_id', '1'),
(108, 46, 'programme_id', '3'),
(110, 46, 'period_id', '8'),
(111, 46, 'day_name', 'tuesday'),
(112, 46, 'subject_id', '25'),
(113, 47, 'semester_id', '1'),
(114, 47, 'programme_id', '3'),
(116, 47, 'period_id', '9'),
(117, 47, 'day_name', 'monday'),
(118, 47, 'subject_id', '24'),
(119, 48, 'programme', '3'),
(120, 48, 'programme', '4'),
(124, 49, 'programme', '3'),
(125, 49, 'programme', '4'),
(129, 50, 'programme', '3'),
(130, 50, 'programme', '4'),
(134, 64, 'programme', '3'),
(135, 64, 'programme', '4'),
(171, 74, 'amount', '500'),
(172, 74, 'status', 'success'),
(173, 74, 'student_id', '18'),
(174, 74, 'month', '8th Sem'),
(175, 75, 'amount', '500'),
(176, 75, 'status', 'success'),
(177, 75, 'student_id', '18'),
(178, 75, 'month', '1st Sem'),
(179, 77, 'amount', '500'),
(180, 77, 'status', 'success'),
(181, 77, 'student_id', '19'),
(182, 77, 'month', '8th Sem'),
(183, 78, 'amount', '500'),
(184, 78, 'status', 'success'),
(185, 78, 'student_id', '19'),
(186, 78, 'month', '8th Sem'),
(187, 79, 'amount', '500'),
(188, 79, 'status', 'success'),
(189, 79, 'student_id', '19'),
(190, 79, 'month', '2nd Sem'),
(191, 80, 'amount', '500'),
(192, 80, 'status', 'success'),
(193, 80, 'student_id', '20'),
(194, 80, 'month', '4th Sem'),
(195, 81, 'semester_id', '1'),
(196, 81, 'programme_id', '3'),
(198, 81, 'period_id', '18'),
(199, 81, 'day_name', 'wednesday'),
(200, 81, 'subject_id', '51'),
(201, 82, 'semester_id', '1'),
(202, 82, 'programme_id', '3'),
(204, 82, 'period_id', '8'),
(205, 82, 'day_name', 'thursday'),
(206, 82, 'subject_id', '54'),
(207, 83, 'semester_id', '2'),
(208, 83, 'programme_id', '3'),
(210, 83, 'period_id', '8'),
(211, 83, 'day_name', 'monday'),
(212, 83, 'subject_id', '76'),
(213, 86, 'amount', '500'),
(214, 86, 'status', 'success'),
(215, 86, 'student_id', '18'),
(216, 86, 'month', '8th Sem'),
(217, 87, 'amount', '500'),
(218, 87, 'status', 'success'),
(219, 87, 'student_id', '18'),
(220, 87, 'month', '8th Sem'),
(221, 88, 'amount', '500'),
(222, 88, 'status', 'success'),
(223, 88, 'student_id', '18'),
(224, 88, 'month', '8th Sem'),
(225, 89, 'amount', '500'),
(226, 89, 'status', 'success'),
(227, 89, 'student_id', '18'),
(228, 89, 'month', '8th Sem'),
(229, 90, 'amount', '500'),
(230, 90, 'status', 'success'),
(231, 90, 'student_id', '18'),
(232, 90, 'month', '8th Sem'),
(233, 91, 'amount', '500'),
(234, 91, 'status', 'success'),
(235, 91, 'student_id', '18'),
(236, 91, 'month', '8th Sem'),
(237, 92, 'amount', '500'),
(238, 92, 'status', 'success'),
(239, 92, 'student_id', '18'),
(240, 92, 'month', '1st Sem'),
(241, 93, 'amount', '500'),
(242, 93, 'status', 'success'),
(243, 93, 'student_id', '18'),
(244, 93, 'month', '1st Sem'),
(245, 94, 'amount', '500'),
(246, 94, 'status', 'success'),
(247, 94, 'student_id', '18'),
(248, 94, 'month', '2nd Sem'),
(249, 95, 'programme', '3'),
(250, 95, 'programme', '4'),
(255, 96, 'programme', '3'),
(256, 105, 'programme', '4'),
(261, 97, 'programme', '3'),
(262, 97, 'programme', '4'),
(263, 97, 'programme', '5'),
(264, 97, 'programme', '6'),
(265, 97, 'programme', '105'),
(267, 98, 'programme', '3'),
(268, 98, 'programme', '4'),
(269, 98, 'programme', '5'),
(270, 98, 'programme', '6'),
(271, 98, 'programme', '105'),
(273, 99, 'programme', '3'),
(274, 99, 'programme', '4'),
(275, 99, 'programme', '5'),
(276, 99, 'programme', '6'),
(277, 99, 'programme', '105'),
(279, 100, 'programme', '3'),
(280, 100, 'programme', '4'),
(281, 100, 'programme', '5'),
(282, 100, 'programme', '6'),
(283, 100, 'programme', '105'),
(285, 101, 'programme', '3'),
(286, 101, 'programme', '4'),
(287, 101, 'programme', '5'),
(288, 101, 'programme', '6'),
(289, 101, 'programme', '105'),
(291, 102, 'programme', '3'),
(292, 102, 'programme', '4'),
(293, 102, 'programme', '5'),
(294, 102, 'programme', '6'),
(295, 102, 'programme', '105'),
(297, 103, 'programme', '3'),
(298, 103, 'programme', '4'),
(299, 103, 'programme', '5'),
(300, 103, 'programme', '6'),
(301, 103, 'programme', '105'),
(303, 104, 'programme', '3'),
(304, 104, 'programme', '4'),
(305, 104, 'programme', '5'),
(306, 104, 'programme', '6'),
(307, 104, 'programme', '105'),
(309, 106, 'semester_id', '97'),
(310, 106, 'programme_id', '3'),
(312, 106, 'period_id', '8'),
(313, 106, 'day_name', 'monday'),
(314, 106, 'subject_id', '24'),
(315, 107, 'semester_id', '97'),
(316, 107, 'programme_id', '3'),
(318, 107, 'period_id', '9'),
(319, 107, 'day_name', 'monday'),
(320, 107, 'subject_id', '54'),
(321, 108, 'amount', '500'),
(322, 108, 'status', 'success'),
(323, 108, 'student_id', '18'),
(324, 108, 'month', '5th Sem'),
(325, 109, 'amount', '500'),
(326, 109, 'status', 'success'),
(327, 109, 'student_id', '18'),
(328, 109, 'month', '1st Sem'),
(329, 110, 'amount', '500'),
(330, 110, 'status', 'success'),
(331, 110, 'student_id', '18'),
(332, 110, 'month', '8th Sem'),
(333, 111, 'amount', '500'),
(334, 111, 'status', 'success'),
(335, 111, 'student_id', '18'),
(336, 111, 'month', '1st Sem'),
(337, 112, 'amount', '500'),
(338, 112, 'status', 'success'),
(339, 112, 'student_id', '18'),
(340, 112, 'month', 'December'),
(341, 113, 'amount', '500'),
(342, 113, 'status', 'success'),
(343, 113, 'student_id', '18'),
(344, 113, 'month', 'Fabruary'),
(345, 114, 'amount', '500'),
(346, 114, 'status', 'success'),
(347, 114, 'student_id', '18'),
(348, 114, 'month', 'December'),
(349, 115, 'amount', '500'),
(350, 115, 'status', 'success'),
(351, 115, 'student_id', '18'),
(352, 115, 'month', '8th Sem'),
(353, 116, 'amount', '500'),
(354, 116, 'status', 'success'),
(355, 116, 'student_id', '18'),
(356, 116, 'month', '8th Sem'),
(357, 117, 'amount', '500'),
(358, 117, 'status', 'success'),
(359, 117, 'student_id', '18'),
(360, 117, 'month', '8th Sem'),
(361, 118, 'amount', '500'),
(362, 118, 'status', 'success'),
(363, 118, 'student_id', '18'),
(364, 118, 'month', '4th Sem'),
(365, 119, 'amount', '500'),
(366, 119, 'status', 'success'),
(367, 119, 'student_id', '18'),
(368, 119, 'month', '5th Sem'),
(369, 120, 'amount', '500'),
(370, 120, 'status', 'success'),
(371, 120, 'student_id', '18'),
(372, 120, 'month', '5th Sem'),
(373, 121, 'amount', '500'),
(374, 121, 'status', 'success'),
(375, 121, 'student_id', '18'),
(376, 121, 'month', '3rd Sem'),
(377, 122, 'amount', '500'),
(378, 122, 'status', 'success'),
(379, 122, 'student_id', '18'),
(380, 122, 'month', '3rd Sem'),
(381, 123, 'amount', '500'),
(382, 123, 'status', 'success'),
(383, 123, 'student_id', '18'),
(384, 123, 'month', '3rd Sem'),
(385, 124, 'amount', '500'),
(386, 124, 'status', 'success'),
(387, 124, 'student_id', '18'),
(388, 124, 'month', '2nd Sem'),
(389, 125, 'amount', '500'),
(390, 125, 'status', 'success'),
(391, 125, 'student_id', '18'),
(392, 125, 'month', '5th Sem'),
(393, 126, 'amount', '500'),
(394, 126, 'status', 'success'),
(395, 126, 'student_id', '18'),
(396, 126, 'month', '5th Sem'),
(397, 126, 'payment_date', '2024-04-24'),
(398, 127, 'amount', '500'),
(399, 127, 'status', 'success'),
(400, 127, 'student_id', '18'),
(401, 127, 'month', '5th Sem'),
(402, 127, 'payment_date', '2024-04-24'),
(403, 128, 'amount', '500'),
(404, 128, 'status', 'success'),
(405, 128, 'student_id', '18'),
(406, 128, 'month', '5th Sem'),
(407, 128, 'payment_date', '2024-04-24'),
(408, 129, 'amount', '500'),
(409, 129, 'status', 'success'),
(410, 129, 'student_id', '18'),
(411, 129, 'month', '6th Sem'),
(412, 129, 'payment_date', '2024-04-24'),
(413, 130, 'amount', '500'),
(414, 130, 'status', 'success'),
(415, 130, 'student_id', '3'),
(416, 130, 'month', '4th Sem'),
(417, 130, 'payment_date', '2024-04-24'),
(418, 131, 'amount', '500'),
(419, 131, 'status', 'success'),
(420, 131, 'student_id', '15'),
(421, 131, 'month', 'akankhya'),
(422, 131, 'payment_date', '2024-04-24'),
(423, 132, 'amount', '500'),
(424, 132, 'status', 'success'),
(425, 132, 'student_id', '15'),
(426, 132, 'month', 'akankhya'),
(427, 132, 'payment_date', '2024-04-24'),
(428, 133, 'amount', '500'),
(429, 133, 'status', 'success'),
(430, 133, 'student_id', '15'),
(431, 133, 'month', 'akankhya'),
(432, 133, 'payment_date', '2024-04-24'),
(433, 134, 'amount', '500'),
(434, 134, 'status', 'success'),
(435, 134, 'student_id', '15'),
(436, 134, 'month', 'akankhya'),
(437, 134, 'payment_date', '2024-04-24'),
(438, 135, 'amount', '500'),
(439, 135, 'status', 'success'),
(440, 135, 'student_id', '18'),
(441, 135, 'month', '6th Sem'),
(442, 135, 'payment_date', '2024-04-24'),
(443, 136, 'amount', '500'),
(444, 136, 'status', 'success'),
(445, 136, 'student_id', '15'),
(446, 136, 'month', 'akankhya'),
(447, 136, 'payment_date', '2024-04-24'),
(448, 137, 'amount', '500'),
(449, 137, 'status', 'success'),
(450, 137, 'student_id', '15'),
(451, 137, 'month', '5th Sem'),
(452, 137, 'payment_date', '2024-04-25'),
(453, 138, 'amount', '500'),
(454, 138, 'status', 'success'),
(455, 138, 'student_id', '15'),
(456, 138, 'month', 'akankhya'),
(457, 138, 'payment_date', '2024-04-25'),
(458, 139, 'amount', '500'),
(459, 139, 'status', 'success'),
(460, 139, 'student_id', '15'),
(461, 139, 'month', 'akankhya'),
(462, 139, 'payment_date', '2024-04-25'),
(463, 140, 'amount', '500'),
(464, 140, 'status', 'success'),
(465, 140, 'student_id', '15'),
(466, 140, 'month', 'akankhya'),
(467, 140, 'payment_date', '2024-04-25'),
(468, 141, 'amount', '500'),
(469, 141, 'status', 'success'),
(470, 141, 'student_id', '15'),
(471, 141, 'month', 'akankhya'),
(472, 141, 'payment_date', '2024-04-25'),
(473, 142, 'semester_id', '97'),
(474, 142, 'programme_id', '3'),
(476, 142, 'period_id', '8'),
(477, 142, 'day_name', 'monday'),
(478, 142, 'subject_id', '24'),
(479, 142, 'teacher_id', '2'),
(480, 143, 'semester_id', '97'),
(481, 143, 'programme_id', '3'),
(482, 143, 'teacher_id', '1'),
(483, 143, 'period_id', '9'),
(484, 143, 'day_name', 'monday'),
(485, 143, 'subject_id', '54'),
(486, 143, 'teacher_id', '2'),
(487, 144, 'semester_id', '98'),
(488, 144, 'programme_id', '4'),
(489, 144, 'teacher_id', '2'),
(490, 144, 'period_id', '8'),
(491, 144, 'day_name', 'monday'),
(492, 144, 'subject_id', '62'),
(493, 166, 'semester_id', '97'),
(494, 166, 'programme_id', '3'),
(495, 166, 'teacher_id', '45'),
(496, 166, 'period_id', '18'),
(497, 166, 'day_name', 'tuesday'),
(498, 166, 'subject_id', '147'),
(499, 167, 'semester_id', '97'),
(500, 167, 'programme_id', '3'),
(501, 167, 'teacher_id', '49'),
(502, 167, 'period_id', '18'),
(503, 167, 'day_name', 'monday'),
(504, 167, 'subject_id', '153'),
(505, 168, 'semester_id', '97'),
(506, 168, 'programme_id', '5'),
(507, 168, 'teacher_id', '43'),
(508, 168, 'period_id', '9'),
(509, 168, 'day_name', 'monday'),
(510, 168, 'subject_id', '85'),
(511, 169, 'semester_id', '97'),
(512, 169, 'programme_id', '3'),
(513, 169, 'teacher_id', '53'),
(514, 169, 'period_id', '19'),
(515, 169, 'day_name', 'monday'),
(516, 169, 'subject_id', '151');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_charges`
--

CREATE TABLE `monthly_charges` (
  `id` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `charge` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_charges`
--

INSERT INTO `monthly_charges` (`id`, `month`, `title`, `charge`) VALUES
(1, '1st sem', 'Hostel Accommodation', 28000.00),
(2, '1st sem', 'Extended Hostel Service', 700.00),
(3, '1st sem', 'Placement Fee', 2250.00),
(4, '1st sem', 'Library and IT Services', 8000.00),
(5, '1st sem', 'Student Welfare Fund', 1800.00),
(6, '1st sem', 'Examination Fee', 2500.00),
(7, '1st sem', 'Tuition Fees B.Tech', 98000.00),
(8, '1st sem', 'Alumni Fees', 400.00),
(9, '2nd sem', 'Hostel Accommodation', 12000.00),
(10, '2nd sem', 'Extended Hostel Service', 700.00),
(11, '2nd sem', 'Placement Fee', 2250.00),
(12, '2nd sem', 'Library and IT Services', 8000.00),
(13, '2nd sem', 'Student Welfare Fund', 1800.00),
(14, '2nd sem', 'Examination Fee', 2500.00),
(15, '2nd sem', 'Tuition Fees B.Tech', 98000.00),
(16, '2nd sem', 'Alumni Fees', 400.00),
(17, '3rd sem', 'Hostel Accommodation', 12000.00),
(18, '3rd sem', 'Extended Hostel Service', 700.00),
(19, '3rd sem', 'Placement Fee', 2250.00),
(20, '3rd sem', 'Library and IT Services', 8000.00),
(21, '3rd sem', 'Student Welfare Fund', 1800.00),
(22, '3rd sem', 'Examination Fee', 2500.00),
(23, '3rd sem', 'Tuition Fees B.Tech', 98000.00),
(24, '3rd sem', 'Alumni Fees', 400.00),
(25, '4th sem', 'Hostel Accommodation', 28000.00),
(26, '4th sem', 'Extended Hostel Service', 700.00),
(27, '4th sem', 'Placement Fee', 2250.00),
(28, '4th sem', 'Library and IT Services', 8000.00),
(29, '4th sem', 'Student Welfare Fund', 1800.00),
(30, '4th sem', 'Examination Fee', 2500.00),
(31, '4th sem', 'Tuition Fees B.Tech', 98000.00),
(32, '4th sem', 'Alumni Fees', 400.00),
(33, '5th sem', 'Hostel Accommodation', 12000.00),
(34, '5th sem', 'Extended Hostel Service', 700.00),
(35, '5th sem', 'Placement Fee', 2250.00),
(36, '5th sem', 'Library and IT Services', 8000.00),
(37, '5th sem', 'Student Welfare Fund', 1800.00),
(38, '5th sem', 'Examination Fee', 2500.00),
(39, '5th sem', 'Tuition Fees B.Tech', 98000.00),
(40, '5th sem', 'Alumni Fees', 400.00),
(41, '6th sem', 'Hostel Accommodation', 28000.00),
(42, '6th sem', 'Extended Hostel Service', 700.00),
(43, '6th sem', 'Placement Fee', 2250.00),
(44, '6th sem', 'Library and IT Services', 8000.00),
(45, '6th sem', 'Student Welfare Fund', 1800.00),
(46, '6th sem', 'Examination Fee', 2500.00),
(47, '6th sem', 'Tuition Fees B.Tech', 98000.00),
(48, '6th sem', 'Alumni Fees', 400.00),
(49, '7th sem', 'Hostel Accommodation', 28000.00),
(50, '7th sem', 'Extended Hostel Service', 700.00),
(51, '7th sem', 'Placement Fee', 2250.00),
(52, '7th sem', 'Library and IT Services', 8000.00),
(53, '7th sem', 'Student Welfare Fund', 1800.00),
(54, '7th sem', 'Examination Fee', 2500.00),
(55, '7th sem', 'Tuition Fees B.Tech', 98000.00),
(56, '7th sem', 'Alumni Fees', 400.00),
(57, '8th sem', 'Hostel Accommodation', 0.00),
(58, '8th sem', 'Extended Hostel Service', 700.00),
(59, '8th sem', 'Placement Fee', 2250.00),
(60, '8th sem', 'Library and IT Services', 8000.00),
(61, '8th sem', 'Student Welfare Fund', 1800.00),
(62, '8th sem', 'Examination Fee', 2500.00),
(63, '8th sem', 'Tuition Fees B.Tech', 98000.00),
(64, '8th sem', 'Alumni Fees', 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `published_by` varchar(50) NOT NULL,
  `headline` varchar(100) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `content`, `created_at`, `published_by`, `headline`, `file_path`) VALUES
(1, 'Midterm Examinations Schedule:\r\n Kindly review your midterm examination schedule available on the college portal. Ensure you are aware of the dates, times, and locations of your exams.', '2024-04-09 18:32:15', 'Examination department', 'Midterm Examination Schedule', '661ea4cb53629.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'akankhyamishra123@gmail.com', '7d90b85fd005caadd39e972fac4477c8d2e9bb3b6e691b842f56b8cad25dee40', '2024-04-19 07:53:14'),
(2, 'admin@gmail.com', '268a03b887f276ee1125aa00c4611c515b672ddfa51acf25ea28a956bb375920', '2024-04-19 07:58:13'),
(3, 'admin@gmail.com', 'de22877b1f3e1704ce1b1a8e10b4f8c7809c0d372b2e88c776a86ad5731d2cba', '2024-04-19 07:58:15'),
(4, 'akankhyamishra123@gmail.com', '5fda0d9cf3f03123fe8ff80525ce2ce4db9c265114a0245df11552486e68df1f', '2024-04-19 07:59:19'),
(5, 'admin@gmail.com', '94fbfd34aa53b1fba4d4e6afa6ca624a7543c5c16b0bea106eb2a24acdd1dce0', '2024-04-19 07:59:56'),
(6, 'akankhyamishra123@gmail.com', '067a8fa769053af49803a55548b7937b029e3da2ab78f5dcddd00ce74e7ed00f', '2024-04-19 08:06:18'),
(7, 'akankhyamishra123@gmail.com', 'f995dbc036e32c957bb4973ec728a0d9ee8c2164a00823d7f3250f6eb8e952c2', '2024-04-19 08:07:14'),
(8, 'akankhyamishra123@gmail.com', '652271c0a22c8bff9dffe6882d061b60a90b6f0357a0dccb6edb52ca0ed11132', '2024-04-19 08:07:19'),
(9, 'akankhyamishra123@gmail.com', '205ada328bea4260d2219d8dc3921d0e52d5a7b118b849a615ad71d6b075f223', '2024-04-19 08:08:23'),
(10, 'akankhyamishra123@gmail.com', '6b7e8ecb2a63dce5c4e1fedfe65fb08ab8139b1f34d25ece35f71e598ef16ab2', '2024-04-19 08:13:09'),
(11, 'akankhyamishra123@gmail.com', '020e5e5e54892fa81d023c7a9253ffb162691ef5ba34e48068b7c97d356cf832', '2024-04-19 08:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL DEFAULT 1,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author`, `title`, `description`, `type`, `publish_date`, `modified_date`, `status`, `parent`) VALUES
(3, 1, 'Computer Science', 'Computer Science and Engineering \r\n Description', 'programme', '2024-04-22 20:58:49', '2024-04-22 20:58:49', 'publish', 0),
(4, 1, 'Computer Engineering', 'Computer Engineering Description', 'programme', '2024-03-21 17:27:45', '2024-03-21 17:27:45', 'publish', 0),
(5, 1, 'Information Technology ', 'Information Technology Description', 'programme', '2024-03-21 17:28:16', '2024-03-21 17:28:16', 'publish', 0),
(6, 1, 'Electrics and Electronics Engineering ', 'Electrics and Electronics Engineering Description', 'programme', '2024-03-21 17:47:48', '2024-03-21 17:47:48', 'publish', 0),
(8, 1, 'first-period', 'first-period Description', 'period', '2024-03-23 07:03:31', '2024-03-23 07:03:31', 'publish', 0),
(9, 1, 'second-period', 'second-period Description', 'period', '2024-03-23 07:03:31', '2024-03-23 07:03:31', 'publish', 0),
(18, 1, 'third-period', '', 'period', '2024-03-24 20:54:27', '2024-03-25 13:24:27', 'publish', 0),
(19, 1, 'fourth-period', '', 'period', '2024-03-24 21:07:27', '2024-03-25 13:37:27', 'publish', 0),
(24, 1, 'Discrete Mathematics', '2.5', 'subject', '2024-04-26 11:30:53', '2024-04-26 11:30:53', 'publish', 0),
(25, 1, 'Data Structures', '4.5', 'subject', '2024-04-04 09:14:00', '2024-04-04 09:14:00', 'publish', 0),
(38, 1, 'fifth-period', '', 'period', '2024-04-02 04:44:14', '2024-04-02 20:14:14', 'publish', 0),
(42, 1, 'sixth-period', '', 'period', '2024-04-02 04:47:02', '2024-04-02 20:17:02', 'publish', 0),
(43, 1, 'seventh-period', '', 'period', '2024-04-02 04:47:23', '2024-04-02 20:17:23', 'publish', 0),
(44, 1, 'eighth-period', '', 'period', '2024-04-02 04:49:21', '2024-04-02 20:19:21', 'publish', 0),
(45, 1, 'ninth-period', '', 'period', '2024-04-02 04:49:52', '2024-04-02 20:19:52', 'publish', 0),
(51, 1, 'C++', '4.5', 'subject', '2024-04-04 09:14:06', '2024-04-04 09:14:06', 'publish', 0),
(54, 1, 'BET', '3', 'subject', '2024-04-26 11:30:39', '2024-04-26 11:30:39', 'publish', 0),
(62, 1, 'Computer Architecture ', '4', 'subject', '2024-04-04 12:35:57', '2024-04-04 12:35:57', 'publish', 0),
(74, 18, '8th Sem - Fee', '', 'payment', '2024-04-08 19:13:12', '2024-04-08 19:13:12', 'success', 0),
(75, 18, '1st Sem - Fee', '', 'payment', '2024-04-09 18:33:40', '2024-04-09 18:33:40', 'success', 0),
(76, 1, 'Advance Computer Architecture', '4', 'subject', '2024-04-10 06:56:20', '2024-04-10 06:56:20', 'publish', 0),
(77, 19, '8th Sem - Fee', '', 'payment', '2024-04-10 07:38:27', '2024-04-10 07:38:27', 'success', 0),
(80, 20, '4th Sem - Fee', '', 'payment', '2024-04-10 07:45:40', '2024-04-10 07:45:40', 'success', 0),
(85, 1, 'Operating Systems', '4', 'subject', '2024-04-22 21:03:49', '2024-04-22 21:03:49', 'publish', 0),
(86, 18, '8th Sem - Fee', '', 'payment', '2024-04-18 17:41:12', '2024-04-18 17:41:12', 'success', 0),
(92, 18, '1st Sem - Fee', '', 'payment', '2024-04-22 16:52:13', '2024-04-22 16:52:13', 'success', 0),
(94, 18, '2nd Sem - Fee', '', 'payment', '2024-04-22 17:58:34', '2024-04-22 17:58:34', 'success', 0),
(97, 1, '1st semester', 'description', 'class', '2024-04-22 20:43:21', '2024-04-22 20:43:21', 'publish', 0),
(98, 1, '2nd semester', 'description', 'class', '2024-04-22 20:43:36', '2024-04-22 20:43:36', 'publish', 0),
(99, 1, '3rd semester', 'description', 'class', '2024-04-22 20:43:49', '2024-04-22 20:43:49', 'publish', 0),
(100, 1, '4th semester', 'description', 'class', '2024-04-22 20:44:02', '2024-04-22 20:44:02', 'publish', 0),
(101, 1, '5th semester', 'description', 'class', '2024-04-22 20:45:54', '2024-04-22 20:45:54', 'publish', 0),
(102, 1, '6th semester', 'description', 'class', '2024-04-22 20:44:40', '2024-04-22 20:44:40', 'publish', 0),
(103, 1, '7th semester', 'description', 'class', '2024-04-22 20:44:51', '2024-04-22 20:44:51', 'publish', 0),
(104, 1, '8th semester', 'description', 'class', '2024-04-22 20:45:04', '2024-04-22 20:45:04', 'publish', 0),
(105, 1, 'Electronics and Telecommunication Engineering', 'description', 'programme', '2024-04-22 20:58:29', '2024-04-22 20:58:29', 'publish', 0),
(108, 18, '5th Sem - Fee', '', 'payment', '2024-04-24 12:15:01', '2024-04-24 12:15:01', 'success', 0),
(109, 18, '1st Sem - Fee', '', 'payment', '2024-04-24 12:21:44', '2024-04-24 12:21:44', 'success', 0),
(110, 18, '8th Sem - Fee', '', 'payment', '2024-04-24 12:32:52', '2024-04-24 12:32:52', 'success', 0),
(111, 18, '1st Sem - Fee', '', 'payment', '2024-04-24 12:41:19', '2024-04-24 12:41:19', 'success', 0),
(112, 18, 'December - Fee', '', 'payment', '2024-04-24 12:43:50', '2024-04-24 12:43:50', 'success', 0),
(113, 18, 'Fabruary - Fee', '', 'payment', '2024-04-24 12:44:26', '2024-04-24 12:44:26', 'success', 0),
(114, 18, 'December - Fee', '', 'payment', '2024-04-24 12:45:11', '2024-04-24 12:45:11', 'success', 0),
(115, 18, '8th Sem - Fee', '', 'payment', '2024-04-24 13:25:51', '2024-04-24 13:25:51', 'success', 0),
(116, 18, '8th Sem - Fee', '', 'payment', '2024-04-24 13:40:10', '2024-04-24 13:40:10', 'success', 0),
(117, 18, '8th Sem - Fee', '', 'payment', '2024-04-24 13:45:28', '2024-04-24 13:45:28', 'success', 0),
(118, 18, '4th Sem - Fee', '', 'payment', '2024-04-24 13:45:38', '2024-04-24 13:45:38', 'success', 0),
(119, 18, '5th Sem - Fee', '', 'payment', '2024-04-24 13:49:59', '2024-04-24 13:49:59', 'success', 0),
(120, 18, '5th Sem - Fee', '', 'payment', '2024-04-24 13:55:12', '2024-04-24 13:55:12', 'success', 0),
(121, 18, '3rd Sem - Fee', '', 'payment', '2024-04-24 13:55:33', '2024-04-24 13:55:33', 'success', 0),
(122, 18, '3rd Sem - Fee', '', 'payment', '2024-04-24 13:58:18', '2024-04-24 13:58:18', 'success', 0),
(123, 18, '3rd Sem - Fee', '', 'payment', '2024-04-24 14:03:40', '2024-04-24 14:03:40', 'success', 0),
(124, 18, '2nd Sem - Fee', '', 'payment', '2024-04-24 14:04:32', '2024-04-24 14:04:32', 'success', 0),
(125, 18, '5th Sem - Fee', '', 'payment', '2024-04-24 14:12:09', '2024-04-24 14:12:09', 'success', 0),
(126, 18, '5th Sem - Fee', '', 'payment', '2024-04-24 14:27:56', '2024-04-24 14:27:56', 'success', 0),
(127, 18, '5th Sem - Fee', '', 'payment', '2024-04-24 14:28:36', '2024-04-24 14:28:36', 'success', 0),
(128, 18, '5th Sem - Fee', '', 'payment', '2024-04-24 14:31:57', '2024-04-24 14:31:57', 'success', 0),
(129, 18, '6th Sem - Fee', '', 'payment', '2024-04-24 14:33:58', '2024-04-24 14:33:58', 'success', 0),
(130, 3, '4th Sem - Fee', '', 'payment', '2024-04-24 16:17:56', '2024-04-24 16:17:56', 'success', 0),
(135, 18, '6th Sem - Fee', '', 'payment', '2024-04-24 18:14:52', '2024-04-24 18:14:52', 'success', 0),
(142, 1, 'timetable', 'description', 'timetable', '2024-04-26 07:17:56', '2024-04-26 07:17:56', 'publish', 0),
(143, 1, 'timetable', 'description', 'timetable', '2024-04-26 07:24:23', '2024-04-26 07:24:23', 'publish', 0),
(144, 1, 'timetable', 'description', 'timetable', '2024-04-26 07:58:22', '2024-04-26 07:58:22', 'publish', 0),
(145, 1, 'Artificial Intelligence and Machine Learning', '4', 'subject', '2024-04-26 08:45:28', '2024-04-26 08:45:28', 'publish', 0),
(146, 1, 'Linear Algebra', '3', 'subject', '2024-04-26 08:46:15', '2024-04-26 08:46:15', 'publish', 0),
(147, 1, 'Theory of Computation', '3.5', 'subject', '2024-04-26 08:46:48', '2024-04-26 08:46:48', 'publish', 0),
(148, 1, 'Software Engineering', '4', 'subject', '2024-04-26 08:47:11', '2024-04-26 08:47:11', 'publish', 0),
(149, 1, 'Advanced Programming Languages', '3', 'subject', '2024-04-26 08:47:35', '2024-04-26 08:47:35', 'publish', 0),
(150, 1, 'Ethical Hacking and Cybersecurity ', '4', 'subject', '2024-04-26 08:47:50', '2024-04-26 08:47:50', 'publish', 0),
(151, 1, 'Database Management Systems', '3', 'subject', '2024-04-26 08:48:04', '2024-04-26 08:48:04', 'publish', 0),
(152, 1, 'Calculus I ', '4', 'subject', '2024-04-26 08:48:16', '2024-04-26 08:48:16', 'publish', 0),
(153, 1, 'English Composition', '3', 'subject', '2024-04-26 08:48:31', '2024-04-26 08:48:31', 'publish', 0),
(154, 1, 'Introduction to Programming', '4.5', 'subject', '2024-04-26 08:48:58', '2024-04-26 08:48:58', 'publish', 0),
(155, 1, 'Advanced Programming Languages', '4', 'subject', '2024-04-26 08:49:14', '2024-04-26 08:49:14', 'publish', 0),
(156, 1, 'VLSI Design ', '3.5', 'subject', '2024-04-26 08:50:25', '2024-04-26 08:50:25', 'publish', 0),
(157, 1, 'Embedded Systems', '3.5', 'subject', '2024-04-26 08:50:36', '2024-04-26 08:50:36', 'publish', 0),
(158, 1, 'Robotics', '3', 'subject', '2024-04-26 08:50:46', '2024-04-26 08:50:46', 'publish', 0),
(159, 1, 'Industrial Electronics', '2.5', 'subject', '2024-04-26 11:31:10', '2024-04-26 11:31:10', 'publish', 0),
(160, 1, 'High Voltage Engineering', '4.5', 'subject', '2024-04-26 08:51:14', '2024-04-26 08:51:14', 'publish', 0),
(161, 1, 'Power System Protection', '3.5', 'subject', '2024-04-26 08:51:27', '2024-04-26 08:51:27', 'publish', 0),
(162, 1, 'Renewable Energy Technologies', '2', 'subject', '2024-04-26 11:31:22', '2024-04-26 11:31:22', 'publish', 0),
(163, 1, 'Electric Circuits Analysis', '2', 'subject', '2024-04-26 11:31:17', '2024-04-26 11:31:17', 'publish', 0),
(164, 1, 'Analog Electronics', '4', 'subject', '2024-04-26 08:52:17', '2024-04-26 08:52:17', 'publish', 0),
(165, 1, 'Advanced Control Systems', '2.5', 'subject', '2024-04-26 08:52:32', '2024-04-26 08:52:32', 'publish', 0),
(166, 1, 'timetable', 'description', 'timetable', '2024-04-26 08:53:12', '2024-04-26 08:53:12', 'publish', 0),
(167, 1, 'timetable', 'description', 'timetable', '2024-04-26 13:12:15', '2024-04-26 13:12:15', 'publish', 0),
(168, 1, 'timetable', 'description', 'timetable', '2024-04-26 13:12:57', '2024-04-26 13:12:57', 'publish', 0),
(169, 1, 'timetable', 'description', 'timetable', '2024-04-26 13:13:31', '2024-04-26 13:13:31', 'publish', 0);

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `shortcut` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_queries`
--

CREATE TABLE `student_queries` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_queries`
--

INSERT INTO `student_queries` (`id`, `student_id`, `subject`, `message`, `timestamp`) VALUES
(23, 18, ' Inquiry Regarding Course Availability', 'I hope this message finds you well. I am writing to inquire about the availability of a specific course for the upcoming semester. As I was reviewing the course catalog, I noticed that \"Introduction to Data Science\" is not listed among the offerings for the upcoming term.', '2024-04-26 13:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `student_results`
--

CREATE TABLE `student_results` (
  `id` int(11) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `quizz_mark` int(11) NOT NULL,
  `midterm_mark` int(11) NOT NULL,
  `endterm_mark` int(11) NOT NULL,
  `total_marks_obtained` int(11) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_results`
--

INSERT INTO `student_results` (`id`, `userID`, `semester`, `quizz_mark`, `midterm_mark`, `endterm_mark`, `total_marks_obtained`, `grade`, `subject_id`) VALUES
(1, 'b520001', '99', 0, 0, 0, 75, 'B', 24),
(2, 'b520001', '99', 8, 19, 33, 60, 'D', 25),
(3, 'b520001', '99', 6, 19, 49, 73, 'B', 51),
(4, 'b520001', '99', 9, 26, 37, 72, 'B', 54),
(5, 'b520001', '99', 10, 25, 33, 67, 'C', 62),
(6, 'b520001', '99', 10, 28, 29, 67, 'C', 76),
(7, 'b520001', '99', 9, 25, 40, 74, 'B', 85),
(8, 'b520005', '99', 6, 25, 46, 77, 'B', 24),
(9, 'b520005', '99', 10, 20, 41, 70, 'B', 25),
(10, 'b520005', '99', 10, 19, 33, 62, 'C', 51),
(11, 'b520005', '99', 8, 17, 36, 60, 'C', 54),
(12, 'b520005', '99', 8, 21, 38, 67, 'C', 62),
(13, 'b520005', '99', 9, 24, 42, 75, 'B', 76),
(14, 'b520005', '99', 9, 29, 47, 85, 'A', 85);

-- --------------------------------------------------------

--
-- Table structure for table `study_materials`
--

CREATE TABLE `study_materials` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `file_extension` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_materials`
--

INSERT INTO `study_materials` (`id`, `title`, `description`, `file_name`, `uploaded_at`, `class_id`, `subject_id`, `file_extension`) VALUES
(7, 'Notes', 'Notes for calculus I', 'Vector_Calculus_&_Line_Integrals.pdf', '2024-04-26 14:00:37', 98, 152, 'pdf'),
(9, 'PYQ', 'PYQ midsem 2019 for all subjects', '2nd Sem 2019 Mid Sem Papers.pdf', '2024-04-26 14:07:21', 98, 24, 'pdf'),
(10, 'PYQ', 'PYQ Endsem 2023', '2023 2nd sem endsem.pdf', '2024-04-26 14:08:08', 98, 25, 'pdf'),
(11, 'Syllabus', 'Syllabus for electronics', 'Handout (EEE- B Tech 2nd Sem-Electronics).pdf', '2024-04-26 14:09:12', 97, 164, 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `usermeta`
--

CREATE TABLE `usermeta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usermeta`
--

INSERT INTO `usermeta` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 18, 'dob', '2006-06-16'),
(2, 18, 'mobile', '9437186022'),
(3, 18, 'payment_method', 'online'),
(4, 18, 'semester', '99'),
(101, 18, 'address', 'E/24/B, Ashok Nagar'),
(102, 18, 'country', 'India'),
(103, 18, 'state', 'odisha'),
(104, 18, 'zip', '751006'),
(105, 18, 'email1', 'student576@gmail.com'),
(106, 18, 'father_name', 'Shashank Shekhar'),
(107, 18, 'father_occupation', 'USFD Railway'),
(108, 18, 'father_mobile', '9658355885'),
(109, 18, 'mother_occupation', 'HouseWife'),
(110, 18, 'mother_name', 'Monalisha Shekhar'),
(111, 18, 'mother_mobile', '86537376838'),
(112, 18, 'school_name', 'St.Paul High Shool'),
(113, 18, 'school_name2', 'BJEM Public Schhol'),
(114, 18, '10th_percentage', '98'),
(115, 18, '12th_percentage', '87.5'),
(449, 17, 'dob', '2006-06-16'),
(450, 17, 'mobile', '9437186024'),
(451, 17, 'payment_method', 'online'),
(452, 17, 'semester', '99'),
(453, 17, 'address', 'E/24/B, Ashok Nagar'),
(454, 17, 'country', 'India'),
(455, 17, 'state', 'odisha'),
(456, 17, 'zip', '751006'),
(457, 17, 'email1', 'sudhanshu@gmail.com'),
(458, 17, 'father_name', 'Shashank Shekhar'),
(459, 17, 'father_occupation', 'USFD Railway'),
(460, 17, 'father_mobile', '9658355885'),
(461, 17, 'mother_occupation', 'HouseWife'),
(462, 17, 'mother_name', 'Monalisha Shekhar'),
(463, 17, 'mother_mobile', '86537376838'),
(464, 17, 'school_name', 'St.Paul High Shool'),
(465, 17, 'school_name2', 'BJEM Public Schhol'),
(466, 17, '10th_percentage', '98'),
(467, 17, '12th_percentage', '87.5'),
(468, 18, 'programme', '4'),
(469, 17, 'programme', '4'),
(470, 38, 'dob', '2003-06-17'),
(471, 38, 'mobile', '8475668475'),
(472, 38, 'payment_method', 'online'),
(473, 38, 'semester', '101'),
(474, 38, 'email1', 'shri234@gmail.com'),
(475, 38, 'address', '123, Station Road, Bhubaneswar, Odisha, Pin: 751001'),
(476, 38, 'country', 'India'),
(477, 38, 'state', 'Odisha'),
(478, 38, 'zip', '751001'),
(479, 38, 'father_name', 'Mukesh Mohapatra'),
(480, 38, 'father_occupation', 'Senior Software Engineer'),
(481, 38, 'father_mobile', '65825459567'),
(482, 38, 'mother_occupation', 'House Wife'),
(483, 38, 'mother_name', 'Monalisha Mohapatra'),
(484, 38, 'mother_mobile', '9846742585'),
(485, 38, 'school_name', 'St. Xavier Public School'),
(486, 38, 'school_name2', 'St. Xavier Public School'),
(487, 38, '10th_percentage', '67'),
(488, 38, '12th_percentage', '98'),
(489, 38, 'status', 'passed'),
(490, 38, 'programme', '5'),
(491, 38, 'doa', '2020-11-24'),
(492, 38, 'dob', '2005-02-10'),
(493, 38, 'mobile', '9876543210'),
(494, 38, 'payment_method', 'online'),
(495, 38, 'semester', '102'),
(496, 38, 'programme', '105'),
(497, 38, 'address', '123, Main Street'),
(498, 38, 'country', 'India'),
(499, 38, 'state', 'Maharashtra'),
(500, 38, 'zip', '400001'),
(501, 38, 'email1', 'shrijan@gmail.com'),
(502, 38, 'father_name', 'Advik Mohapatra'),
(503, 38, 'father_occupation', 'Senior Engineer'),
(504, 38, 'father_mobile', '9988776655'),
(505, 38, 'mother_occupation', 'Doctor'),
(506, 38, 'mother_name', 'Asha Nagar'),
(507, 38, 'mother_mobile', '9876543210'),
(508, 38, 'school_name', 'Stuart High School'),
(509, 38, 'school_name2', 'BJEM Public School'),
(510, 38, '10th_percentage', '94.3'),
(511, 38, '12th_percentage', '80.6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_replies`
--
ALTER TABLE `admin_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `admin_replies_ibfk_1` (`query_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campusfunctions`
--
ALTER TABLE `campusfunctions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_payments`
--
ALTER TABLE `fee_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_payment` (`student_id`,`month`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `messages_ibfk_2` (`receiver_id`);

--
-- Indexes for table `metadata`
--
ALTER TABLE `metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_charges`
--
ALTER TABLE `monthly_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_queries`
--
ALTER TABLE `student_queries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_results`
--
ALTER TABLE `student_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_materials`
--
ALTER TABLE `study_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class` (`class_id`),
  ADD KEY `fk_subject` (`subject_id`);

--
-- Indexes for table `usermeta`
--
ALTER TABLE `usermeta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `admin_replies`
--
ALTER TABLE `admin_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `campusfunctions`
--
ALTER TABLE `campusfunctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fee_payments`
--
ALTER TABLE `fee_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `metadata`
--
ALTER TABLE `metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;

--
-- AUTO_INCREMENT for table `monthly_charges`
--
ALTER TABLE `monthly_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_queries`
--
ALTER TABLE `student_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student_results`
--
ALTER TABLE `student_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `study_materials`
--
ALTER TABLE `study_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usermeta`
--
ALTER TABLE `usermeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=512;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_replies`
--
ALTER TABLE `admin_replies`
  ADD CONSTRAINT `admin_replies_ibfk_1` FOREIGN KEY (`query_id`) REFERENCES `student_queries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_replies_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_queries`
--
ALTER TABLE `student_queries`
  ADD CONSTRAINT `student_queries_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `study_materials`
--
ALTER TABLE `study_materials`
  ADD CONSTRAINT `fk_class` FOREIGN KEY (`class_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_subject` FOREIGN KEY (`subject_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
