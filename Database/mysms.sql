-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 09:52 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Full_name` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `phone` int(15) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Full_name`, `Address`, `phone`, `username`, `password`) VALUES
(1, 'Ephraim Messay', 'Addis Ababa', 968464361, 'Efa/123', 'Efa@123');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `current_semester`
--

CREATE TABLE `current_semester` (
  `student_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_semester`
--

INSERT INTO `current_semester` (`student_id`, `semester_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade_id` int(11) NOT NULL,
  `grade_name` text DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grade9`
--

CREATE TABLE `grade9` (
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade9`
--

INSERT INTO `grade9` (`student_id`) VALUES
(1),
(2),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- Table structure for table `grade10`
--

CREATE TABLE `grade10` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade10`
--

INSERT INTO `grade10` (`id`, `student_id`) VALUES
(1, '1'),
(2, '2'),
(3, '4'),
(4, '5'),
(5, '6'),
(6, '7'),
(7, '8'),
(8, '9'),
(9, '10');

-- --------------------------------------------------------

--
-- Table structure for table `gradee`
--

CREATE TABLE `gradee` (
  `grade_idd` int(100) NOT NULL,
  `GRADE_NAME` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gradee`
--

INSERT INTO `gradee` (`grade_idd`, `GRADE_NAME`) VALUES
(1, 'Grade 9'),
(2, 'Grade 10'),
(3, 'Grade 11'),
(4, 'Grade 12');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `instructor_id` text NOT NULL,
  `Full_name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` int(12) NOT NULL,
  `address` varchar(32) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `degree_level` varchar(32) NOT NULL,
  `usename` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `instructor_id`, `Full_name`, `email`, `phone`, `address`, `subject`, `degree_level`, `usename`, `password`) VALUES
(1, '', 'Peter Messay', '', 0, '', '', '', 'peter', 'peter'),
(2, '', 'Abel', 'abel@gmail.com', 974268517, 'A7', 'civisc', 'ms', '', ' '),
(3, '', 'ABEBE', 'peter@gmail.com', 0, 'addis', 'rwgeg', 'rea', 'ABEBE', 'ABEBE'),
(4, '', 'Amanuel', 'amanuel@gmail.com', 904767142, 'Mehal', 'Operating system', 'ms', 'Amanuel/4', 'Amanuel@4'),
(5, '', '', 'peter@gmail.com', 1357688900, 'hawasa', '', '', '', ''),
(6, '', 'Yilikal', 'peter@gmail.com', 1357688900, 'hawasa', 'che', '', 'Yilikal/6', 'Yilikal@6'),
(7, '', 'karo', 'peter@gmail.com', 1357688900, 'hawasa', 'che', '', '', ''),
(8, '', 'karo', 'peter@gmail.com', 1357688900, 'hawasa', 'che', '', '', ''),
(9, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(10, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(11, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(12, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(13, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(14, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(15, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(16, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(17, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(18, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(19, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(20, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(21, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(22, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(23, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(24, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(25, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(26, '', 'karo', 'rsgsdfs@gmail.com', 912345678, 'addis', 'ma', 'ms', '', ''),
(27, '', 'abel', 'abe;@gmail.com', 912345678, 'arba minch', 'tools', 'ms', '', ''),
(28, '', 'Gashaw ', 'Gashaw@gmail.com', 974268517, 'A7', 'IOT', 'ms', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_course_assignment`
--

CREATE TABLE `instructor_course_assignment` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor_course_assignment`
--

INSERT INTO `instructor_course_assignment` (`id`, `subject_id`, `semester_id`) VALUES
(1, 3, 0),
(3, 3, 0),
(3, 4, 0),
(4, 7, 0),
(6, 3, 0),
(15, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `instructor_student`
--

CREATE TABLE `instructor_student` (
  `student_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor_student`
--

INSERT INTO `instructor_student` (`student_id`, `id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 3),
(13, 3),
(14, 3),
(15, 1),
(15, 13),
(17, 3),
(18, 17),
(19, 1),
(19, 4),
(19, 6);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade_idd` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `mark` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`student_id`, `subject_id`, `grade_idd`, `semester_id`, `mark`) VALUES
(1, 3, 1, 1, 0),
(1, 3, 1, 2, 70),
(2, 3, 1, 1, 0),
(2, 3, 1, 2, 87),
(3, 3, 1, 1, 90),
(3, 3, 1, 2, 76),
(4, 3, 1, 1, 0),
(4, 3, 1, 2, 57),
(5, 3, 1, 1, 0),
(5, 3, 1, 2, 95),
(6, 3, 1, 1, 0),
(6, 3, 1, 2, 75),
(7, 3, 1, 1, 0),
(7, 3, 1, 2, 97),
(8, 3, 1, 1, 0),
(8, 3, 1, 2, 58),
(9, 3, 1, 1, 0),
(9, 3, 1, 2, 48),
(10, 3, 1, 1, 0),
(10, 3, 1, 2, 88),
(11, 3, 1, 1, 0),
(11, 3, 1, 2, 86),
(19, 3, 1, 1, 0),
(19, 3, 1, 2, 50),
(19, 7, 1, 1, 80),
(19, 7, 1, 2, 88);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `Title` varchar(1000) NOT NULL,
  `Post` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `Title`, `Post`) VALUES
(1, 'Final exam', 'Dear students we will start our final exam on this day'),
(2, 'Mid exam', 'Dear students we will start our mid exam on this.');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `questions` varchar(1000) DEFAULT NULL,
  `optiona` varchar(20) DEFAULT NULL,
  `optionb` varchar(20) DEFAULT NULL,
  `optionc` varchar(20) DEFAULT NULL,
  `optiond` varchar(20) DEFAULT NULL,
  `answer` varchar(20) DEFAULT NULL,
  `examStartTime` time NOT NULL,
  `examEndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question_number`, `questions`, `optiona`, `optionb`, `optionc`, `optiond`, `answer`, `examStartTime`, `examEndTime`) VALUES
(1, 1, 'whAT IS THE CAPITAL CITY OF FRANCS', 'London', 'Paris ', 'Madrid', 'Berlin', 'B', '00:00:00', '00:00:00'),
(2, 2, 'What is the capital city of Ethiopia?', 'Addis Ababa', 'Nirobi', 'Mogadishu', 'Asmara', 'A', '00:00:00', '00:00:00'),
(3, 3, 'What is the capital city of Kenya?', 'AA', 'Nirobi', 'Madrid', 'Asmara', 'B', '00:00:00', '00:00:00'),
(4, 4, 'what is the capital of USA?', 'London', 'Paris ', 'AA', 'New York', 'D', '00:00:00', '00:00:00'),
(5, 4, 'what is the capital of USA?', 'London', 'Paris ', 'AA', 'New York', 'D', '00:00:00', '00:00:00'),
(6, 4, 'what is the capital of USA?', 'London', 'Paris ', 'AA', 'New York', 'D', '00:00:00', '00:00:00'),
(7, 5, 'what is the capital of Nigeria', 'Abuja', 'Paris ', 'Mogadishu', 'Asmara', 'A', '00:00:00', '00:00:00'),
(8, 7, 'erhtyh', 'London', 'Paris ', 'Mogadishu', 'Asmara', 'A', '00:00:00', '00:00:00'),
(9, 7, 'erhtyh', 'London', 'Paris ', 'Mogadishu', 'Asmara', 'A', '00:00:00', '00:00:00'),
(10, 7, 'erhtyh', 'London', 'Paris ', 'Mogadishu', 'Asmara', 'A', '00:00:00', '00:00:00'),
(11, 7, 'erhtyh', 'London', 'Paris ', 'Mogadishu', 'Asmara', 'A', '00:00:00', '00:00:00'),
(12, 0, '', '', '', '', '', '', '04:30:00', '04:32:00'),
(13, 0, '', '', '', '', '', '', '04:30:00', '04:32:00'),
(14, 9, 'rgqg', 'Addis Ababa', 'Paris ', 'Mogadishu', 'Berlin', 'C', '04:46:00', '04:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `result_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`result_id`, `student_id`, `score`) VALUES
(7, 19, 1),
(8, 8, 2),
(9, 19, 9),
(10, 19, 9),
(11, 19, 9),
(12, 19, 9),
(13, 8, 3),
(14, 8, 3),
(15, 8, 2),
(16, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(50) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`, `starting_date`, `ending_date`) VALUES
(1, 'Semester I', '2024-03-20', '2024-06-20'),
(2, 'I', '2024-03-30', '2024-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `std_semester_grade`
--

CREATE TABLE `std_semester_grade` (
  `student_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `Full_name` varchar(50) NOT NULL,
  `mother_full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` text NOT NULL,
  `address` varchar(50) NOT NULL,
  `Gender` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `grade_point` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `Full_name`, `mother_full_name`, `email`, `phone`, `address`, `Gender`, `username`, `password`, `grade_point`) VALUES
(1, 'peter', 'mam', 'peter@gmail.come', '0974268517', 'amu', 'Male', '', '', ''),
(2, 'trehy', 'gdn', 'peter@gmail.com', '1357688900', 'addis', '', '', '', ''),
(3, 'abebe', 'almaz', 'peter@gmail.com', '1357688900', 'addis', '', '', '', ''),
(4, 'Abrish', '', '', '', '', '', '', ' ', ''),
(5, 'Eliyas', '', '', '', '', '', '', ' ', ''),
(6, 'Nahom', '', '', '', '', '', '', ' ', ''),
(7, 'Bernaebas Tesema', '', '', '096283718', '', '', 'Bernabas/77', ' Bernabas@77', ''),
(8, 'Firaol', 'sthh', 'firaol@gmail.com', '1357688900', 'ambo', '', 'firaol/8', 'firaol@8', ''),
(9, 'beze', '', 'beze@gmail.com', '0912345678', 'hawasa', '', '', '', ''),
(10, 'abeni', '', 'pabeni@gmail.com', '1357688900', 'amu', '', '', '', ''),
(11, 'Yordanos', '', '', '', '', '', '', ' ', ''),
(12, 'behailu', 'mimi', 'behailu@gmail.com', '0904767142', 'dicha', 'Male', 'Behailu/12', 'Behailu@12', ''),
(13, 'Desta', '', '', '', '', '', '', ' ', ''),
(14, 'Nardos', '', '', '', '', '', 'fenet', ' fenet', ''),
(15, 'Samuel', '', '', '', '', '', '', ' ', ''),
(16, 'Mintesinot', '', '', '', '', '', '', ' ', ''),
(17, 'Nahom Negash', 'Rachel', 'rsgsdfs@gmail.com', '1357688900', 'arba minch', '', '', '', ''),
(18, 'Dibo', 'afadga', 'rsgs@gmail.com', '0912345678', 'arba minch', 'Female', 'dibo', 'diboo', ''),
(19, 'Dibora', 'afadga', 'rsgs@gmail.com', '0912345678', 'arba minch', 'Female', 'dibora/19', '123456', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_average`
--

CREATE TABLE `student_average` (
  `student_id` int(11) NOT NULL,
  `average` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_average`
--

INSERT INTO `student_average` (`student_id`, `average`) VALUES
(1, 100),
(2, 80),
(3, 0),
(4, 87.5),
(5, 55),
(6, 88.1667),
(7, 86.6667),
(8, 74),
(9, 89.3333),
(10, 92),
(19, 98);

-- --------------------------------------------------------

--
-- Table structure for table `student_marklist`
--

CREATE TABLE `student_marklist` (
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_mark` decimal(10,0) DEFAULT NULL,
  `average` float NOT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `grade_idd` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_marklist`
--

INSERT INTO `student_marklist` (`student_id`, `subject_id`, `student_mark`, `average`, `semester_id`, `grade_idd`, `section_id`) VALUES
(0, 0, '0', 0, NULL, NULL, NULL),
(1, 3, '0', 0, NULL, NULL, NULL),
(2, 2, '80', 0, NULL, NULL, NULL),
(2, 3, '0', 0, 2, 1, NULL),
(3, 3, '0', 0, NULL, NULL, NULL),
(4, 1, '80', 0, NULL, NULL, NULL),
(4, 3, '0', 0, NULL, NULL, NULL),
(4, 4, '95', 0, NULL, NULL, NULL),
(5, 1, '0', 0, NULL, NULL, NULL),
(5, 2, '80', 0, NULL, NULL, NULL),
(5, 3, '0', 0, NULL, NULL, NULL),
(5, 4, '0', 0, NULL, NULL, NULL),
(5, 5, '100', 0, NULL, NULL, NULL),
(5, 6, '75', 0, NULL, NULL, NULL),
(6, 1, '77', 0, NULL, NULL, NULL),
(6, 2, '77', 0, NULL, NULL, NULL),
(6, 3, '0', 0, NULL, NULL, NULL),
(6, 4, '89', 0, NULL, NULL, NULL),
(6, 5, '97', 0, NULL, NULL, NULL),
(6, 6, '94', 0, NULL, NULL, NULL),
(7, 1, '90', 0, NULL, NULL, NULL),
(7, 2, '95', 0, NULL, NULL, NULL),
(7, 3, '0', 0, NULL, NULL, NULL),
(7, 4, '92', 0, NULL, NULL, NULL),
(7, 5, '80', 0, NULL, NULL, NULL),
(7, 6, '78', 0, NULL, NULL, NULL),
(8, 1, '85', 0, NULL, NULL, NULL),
(8, 2, '94', 0, NULL, NULL, NULL),
(8, 3, '0', 0, NULL, NULL, NULL),
(8, 4, '90', 0, NULL, NULL, NULL),
(8, 5, '97', 0, NULL, NULL, NULL),
(8, 6, '81', 0, NULL, NULL, NULL),
(9, 1, '80', 0, NULL, NULL, NULL),
(9, 2, '87', 0, NULL, NULL, NULL),
(9, 3, '0', 0, NULL, NULL, NULL),
(9, 4, '94', 0, NULL, NULL, NULL),
(9, 5, '98', 0, NULL, NULL, NULL),
(9, 6, '87', 0, NULL, NULL, NULL),
(10, 1, '100', 0, NULL, NULL, NULL),
(10, 2, '95', 0, NULL, NULL, NULL),
(10, 3, '0', 0, NULL, NULL, NULL),
(10, 4, '77', 0, NULL, NULL, NULL),
(10, 5, '98', 0, NULL, NULL, NULL),
(10, 6, '93', 0, NULL, NULL, NULL),
(11, 1, '80', 0, NULL, NULL, NULL),
(11, 3, '0', 0, 2, 1, NULL),
(12, 3, '90', 0, NULL, NULL, NULL),
(12, 4, '90', 0, NULL, NULL, NULL),
(19, 3, '98', 0, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_rank`
--

CREATE TABLE `student_rank` (
  `student_id` int(11) NOT NULL,
  `rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_rank`
--

INSERT INTO `student_rank` (`student_id`, `rank`) VALUES
(1, 1),
(2, 4),
(3, 6),
(4, 3),
(5, 5),
(6, 2),
(7, 4),
(8, 4),
(9, 2),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `grade_idd` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`student_id`, `subject_id`, `year`, `semester_id`, `grade_id`, `grade_idd`, `section_id`) VALUES
(1, 1, 0, NULL, NULL, NULL, NULL),
(2, 2, 0, NULL, NULL, NULL, NULL),
(3, 1, 0, NULL, NULL, NULL, NULL),
(3, 3, 0, NULL, NULL, NULL, NULL),
(4, 1, 0, NULL, NULL, NULL, NULL),
(4, 2, 0, NULL, NULL, NULL, NULL),
(4, 3, 0, NULL, NULL, NULL, NULL),
(4, 4, 0, NULL, NULL, NULL, NULL),
(4, 5, 0, NULL, NULL, NULL, NULL),
(4, 6, 0, NULL, NULL, NULL, NULL),
(5, 1, 0, NULL, NULL, NULL, NULL),
(5, 4, 0, NULL, NULL, NULL, NULL),
(5, 5, 0, NULL, NULL, NULL, NULL),
(5, 6, 0, NULL, NULL, NULL, NULL),
(6, 1, 0, NULL, NULL, NULL, NULL),
(6, 4, 0, NULL, NULL, NULL, NULL),
(6, 5, 0, NULL, NULL, NULL, NULL),
(6, 6, 0, NULL, NULL, NULL, NULL),
(7, 2, 0, NULL, NULL, NULL, NULL),
(7, 3, 0, NULL, NULL, NULL, NULL),
(7, 4, 0, NULL, NULL, NULL, NULL),
(7, 5, 0, NULL, NULL, NULL, NULL),
(7, 6, 0, NULL, NULL, NULL, NULL),
(8, 1, 0, NULL, NULL, NULL, NULL),
(8, 2, 0, NULL, NULL, NULL, NULL),
(8, 3, 0, NULL, NULL, NULL, NULL),
(8, 4, 0, NULL, NULL, NULL, NULL),
(8, 5, 0, NULL, NULL, NULL, NULL),
(8, 6, 0, NULL, NULL, NULL, NULL),
(8, 11, 0, 2, NULL, 1, 1),
(9, 1, 0, NULL, NULL, NULL, NULL),
(9, 2, 0, NULL, NULL, NULL, NULL),
(9, 3, 0, NULL, NULL, NULL, NULL),
(9, 4, 0, NULL, NULL, NULL, NULL),
(9, 5, 0, NULL, NULL, NULL, NULL),
(9, 6, 0, NULL, NULL, NULL, NULL),
(12, 3, 0, NULL, NULL, NULL, NULL),
(12, 4, 0, NULL, NULL, NULL, NULL),
(18, 1, 0, 2, NULL, 1, NULL),
(18, 2, 0, 2, NULL, 1, NULL),
(18, 3, 0, 2, NULL, 1, NULL),
(18, 4, 0, 2, NULL, 1, NULL),
(18, 5, 0, 2, NULL, 1, NULL),
(18, 6, 0, 2, NULL, 1, NULL),
(18, 7, 0, 2, NULL, 1, NULL),
(18, 8, 0, 2, NULL, 1, NULL),
(18, 9, 0, 2, NULL, 1, NULL),
(18, 10, 0, 2, NULL, 1, NULL),
(18, 11, 0, 2, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `Subject_name` varchar(50) NOT NULL,
  `semester` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `Subject_name`, `semester`, `year`) VALUES
(1, 'Civics', '', ''),
(2, 'Chemistry', '', ''),
(3, 'Physics', '', ''),
(4, 'English', '', ''),
(5, 'Mathis', '', ''),
(6, 'Sport', '', ''),
(7, 'Biology', '', ''),
(8, 'Amharic', '', ''),
(9, 'Geography', '', ''),
(10, 'History', '', ''),
(11, 'General', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`,`question_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `current_semester`
--
ALTER TABLE `current_semester`
  ADD PRIMARY KEY (`student_id`,`semester_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`grade_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `grade9`
--
ALTER TABLE `grade9`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `grade10`
--
ALTER TABLE `grade10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gradee`
--
ALTER TABLE `gradee`
  ADD PRIMARY KEY (`grade_idd`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_course_assignment`
--
ALTER TABLE `instructor_course_assignment`
  ADD PRIMARY KEY (`id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `instructor_student`
--
ALTER TABLE `instructor_student`
  ADD PRIMARY KEY (`student_id`,`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`student_id`,`subject_id`,`grade_idd`,`semester_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `grade_idd` (`grade_idd`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `std_semester_grade`
--
ALTER TABLE `std_semester_grade`
  ADD PRIMARY KEY (`student_id`,`semester_id`,`grade_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_average`
--
ALTER TABLE `student_average`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_marklist`
--
ALTER TABLE `student_marklist`
  ADD PRIMARY KEY (`student_id`,`subject_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `grade_idd` (`grade_idd`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `student_rank`
--
ALTER TABLE `student_rank`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`student_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `grade_idd` (`grade_idd`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grade10`
--
ALTER TABLE `grade10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gradee`
--
ALTER TABLE `gradee`
  MODIFY `grade_idd` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `current_semester`
--
ALTER TABLE `current_semester`
  ADD CONSTRAINT `current_semester_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `current_semester_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`);

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `grade9`
--
ALTER TABLE `grade9`
  ADD CONSTRAINT `grade9_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `instructor_course_assignment`
--
ALTER TABLE `instructor_course_assignment`
  ADD CONSTRAINT `instructor_course_assignment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `instructor` (`id`),
  ADD CONSTRAINT `instructor_course_assignment_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);

--
-- Constraints for table `instructor_student`
--
ALTER TABLE `instructor_student`
  ADD CONSTRAINT `instructor_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `instructor_student_ibfk_2` FOREIGN KEY (`id`) REFERENCES `instructor` (`id`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`grade_idd`) REFERENCES `gradee` (`grade_idd`),
  ADD CONSTRAINT `marks_ibfk_4` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `std_semester_grade`
--
ALTER TABLE `std_semester_grade`
  ADD CONSTRAINT `std_semester_grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `std_semester_grade_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `std_semester_grade_ibfk_3` FOREIGN KEY (`grade_id`) REFERENCES `gradee` (`grade_idd`);

--
-- Constraints for table `student_average`
--
ALTER TABLE `student_average`
  ADD CONSTRAINT `student_average_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `student_marklist`
--
ALTER TABLE `student_marklist`
  ADD CONSTRAINT `student_marklist_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `student_marklist_ibfk_2` FOREIGN KEY (`grade_idd`) REFERENCES `gradee` (`grade_idd`),
  ADD CONSTRAINT `student_marklist_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `student_rank`
--
ALTER TABLE `student_rank`
  ADD CONSTRAINT `student_rank_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `student_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `student_subject_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `student_subject_ibfk_4` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `student_subject_ibfk_5` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`grade_id`),
  ADD CONSTRAINT `student_subject_ibfk_6` FOREIGN KEY (`grade_idd`) REFERENCES `gradee` (`grade_idd`),
  ADD CONSTRAINT `student_subject_ibfk_7` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
