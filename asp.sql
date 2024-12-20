-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 12:03 AM
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
-- Database: `asp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `FName` text NOT NULL,
  `LName` text NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Role` text NOT NULL,
  `ROLEID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `FName`, `LName`, `Email`, `Password`, `Role`, `ROLEID`) VALUES
(1, 'youssef', 'eldemerdash', 'youssefashrafdem@gmail.com', '1234', 'Admin', 0),
(2, 'youssef', 'eldemerdash', 'youssefashrafdem@gmail.com', '1234', 'Admin', 0),
(3, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(4, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(5, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(6, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(7, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(8, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(9, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(10, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(11, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0),
(12, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,  -- Set as AUTO_INCREMENT
  `course_code` varchar(150) NOT NULL,   -- Renamed for consistency
  `course_name` text NOT NULL,            -- Renamed for consistency
  `pre_requisite` varchar(150) NOT NULL,  -- Renamed to remove hyphen
  `credit_hrs` int(11) NOT NULL,          -- Renamed to remove space
  `faculty_id` int(11) NOT NULL,          -- Faculty member ID
  `rt_id` int(11) NOT NULL,               -- Course-related teaching role ID (if applicable)
  PRIMARY KEY (`ID`),
  FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`ID`),  -- Link to the `faculty` table
  FOREIGN KEY (`rt_id`) REFERENCES `roles`(`ID`)          -- Assuming `roles` table exists for teaching roles
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
INSERT INTO `courses` (`course_code`, `course_name`, `pre_requisite`, `credit_hrs`, `faculty_id`, `rt_id`) 
VALUES
('CS101', 'Data Structures', 'None', 3, 1, 1),  -- Faculty ID 1 (Doctor)
('CS102', 'Introduction to Programming', 'None', 3, 1, 1),  -- Faculty ID 1 (Doctor)
('CS103', 'Operating Systems', 'CS101', 4, 1, 2),  -- Faculty ID 2 (TA or different role)
('CS104', 'Software Engineering', 'CS102', 3, 3, 1),  -- Faculty ID 3 (Doctor)
('CS105', 'Machine Learning', 'CS101', 3, 3, 2);  -- Faculty ID 2 (TA or different role)
--
-- Table structure for table `doctors`
--

CREATE TABLE `faculty` (
  `ID` int(11) NOT NULL,
  `FName` text NOT NULL,
  `LName` text NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Role` text NOT NULL,
  `ROLEID` int(11) NOT NULL,
  `faculty` text NOT NULL,
  `course code` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `FName` text NOT NULL,
  `LName` text NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Role` text NOT NULL,
  `ROLEID` int(11) NOT NULL,
  `Major` text NOT NULL,
  `Minor` text NOT NULL,
  `Status` text NOT NULL,
  `Sem gpa` double NOT NULL,
  `Cum gpa` double NOT NULL,
  `Sem crdth` int(11) NOT NULL,
  `Total crdth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `FName`, `LName`, `Email`, `Password`, `Role`, `ROLEID`, `Major`, `Minor`, `Status`, `Sem gpa`, `Cum gpa`, `Sem crdth`, `Total crdth`) VALUES
(1, 'Youssef', 'Eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(2, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(3, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(4, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(5, 'youssef', 'eldemerdash', 'sondosky@gmail.com', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(6, 'youssef', 'eldemerdash', 'sondosky@gmail.com', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(7, 'youssef', 'eldemerdash', 'sondosky@gmail.com', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(8, 'Karim', 'Ehab', 'youssef2202851@miuegypt.edu.eg', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(9, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(10, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', 'Student', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(11, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(12, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(13, 'mohamed', 'hassan', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(14, 'Karim', 'Ehab', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(15, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(16, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(17, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(18, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(19, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(20, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(21, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(22, 'Karim', 'Sameh', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(23, 'Ali', 'Sameh', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0),
(24, 'youssef', 'eldemerdash', 'youssef2202851@miuegypt.edu.eg', '1234', '0', 1, 'Computer Science', '', 'Regular Student', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ta`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`);
  -- Add a new column `faculty_id` to reference the faculty table
ALTER TABLE `courses`
ADD COLUMN `faculty_id` int(11) NOT NULL AFTER `credit_hrs`;  -- Placed after `credit_hrs` for example

-- Remove the `dr_id` and `ta_id` columns, as they are no longer needed
ALTER TABLE `courses`
DROP COLUMN `dr_id`, 
DROP COLUMN `ta_id`;

-- Create a foreign key constraint on `faculty_id` referencing `faculty` table
ALTER TABLE `courses`
ADD CONSTRAINT `fk_faculty_id`
FOREIGN KEY (`faculty_id`) REFERENCES `faculty`(`ID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ta`
--


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `faculty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ta`
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
