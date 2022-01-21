-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 11:59 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `is3 online tutoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartcourses`
--

CREATE TABLE `cartcourses` (
  `UserID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chaptermaterials`
--

CREATE TABLE `chaptermaterials` (
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `CourseID` int(11) NOT NULL,
  `chapter` int(11) NOT NULL,
  `resourceID` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coursechapters`
--

CREATE TABLE `coursechapters` (
  `CourseID` int(11) NOT NULL,
  `chapter` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursechapters`
--

INSERT INTO `coursechapters` (`CourseID`, `chapter`, `Title`, `Description`) VALUES
(1, 1, 'Course Introduction', NULL),
(1, 2, 'What is Angular', NULL),
(1, 3, 'Angular vs Angular 2', NULL),
(1, 4, 'Project setup', NULL),
(1, 5, 'What is typescript', NULL),
(5, 1, 'Basics of Makeup', NULL),
(5, 2, 'Simple eyeliner', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `Code` varchar(8) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Hours` int(11) NOT NULL,
  `Level` varchar(15) NOT NULL,
  `Price` int(11) NOT NULL,
  `Approved` tinyint(1) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `Categories` varchar(25) NOT NULL,
  `Overview` varchar(255) DEFAULT NULL,
  `Thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `Code`, `Title`, `Description`, `Hours`, `Level`, `Price`, `Approved`, `CreatedBy`, `Categories`, `Overview`, `Thumbnail`) VALUES
(1, 'CSC225', 'Angular - The Complete Guide', 'Master Angular 13 (formerly &#34;Angular 2&#34;) and build awesome, reactive web apps with the successor of Angular.js', 36, 'Beginner', 800, 1, 11, 'Computer Science', '1642805056_Course_Overview1.mp4', '1642363389_angular.png'),
(3, 'BUS837', 'Social Media Marketing', 'MASTER online marketing on Twitter, Pinterest, Instagram, YouTube, Facebook, Google and more ad platforms! Coursenvy ®', 12, 'Beginner', 500, 1, 11, 'Business', NULL, '1642363447_socialmedia.jpg'),
(5, 'LFS102', 'Makeup Artistry Basics', 'Daily make up and evening makeup on different skin tones, eye shapes & face shape, online makeup courses , Makeup artist', 8, 'Intermediate', 1500, 1, 11, 'Lifestyle', NULL, '1642363515_makeup.jpg'),
(6, 'MUS466', 'Music Production', 'Join Successful Music Production + Logic Pro X students in Creating, Recording, Mixing Music + Mastering in Logic Pro X', 30, 'Intermediate', 999, 1, 11, 'Music', NULL, '1642363554_music.jpg'),
(7, 'ENG1928', 'Ultimate Solar Energy', 'Learn How To Design And Install Solar Energy Systems With Step By Step Examples In 10 Solar Energy Courses', 40, 'Intermediate', 1400, 0, 12, 'Engineering', NULL, '1642363600_physics.jpg'),
(8, 'ENG766', 'Industrial Robotics', 'Mathematical models and practical applications', 20, 'Hard', 800, 0, 12, 'Engineering', NULL, '1642363634_robot.jpg'),
(9, 'CSC315', 'Data Structures and Algorithms', 'Learn all about trees, hashmaps, BSTs, and a lot more', 60, 'Intermediate', 800, 1, 12, 'Computer Science', NULL, '1642363836_function.jpg'),
(10, 'CSC128', 'Computer Networks', 'This class is offered as CS6250 at Georgia Tech where it is a part of the Online Masters Degree (OMS). Taking this course here will not earn credit towards the OMS degree.', 24, 'Intermediate', 2000, 1, 12, 'Computer Science', NULL, '1642363936_computernetworks.jpg'),
(11, 'IS388', 'Web development', 'Learn web development with HTML, CSS, Bootstrap 4, ES6 React and Node', 45, 'Intermediate', 2000, 1, 11, 'Computer Science', NULL, '1642364051_laptop.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `UserID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `EnrollDate` date NOT NULL,
  `Done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`UserID`, `CourseID`, `EnrollDate`, `Done`) VALUES
(6, 3, '2022-01-16', 0),
(7, 1, '2022-01-16', 0),
(7, 5, '2022-01-16', 0),
(8, 1, '2022-01-16', 0),
(8, 8, '2022-01-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `error_log`
--

CREATE TABLE `error_log` (
  `errorID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `isException` tinyint(1) NOT NULL DEFAULT 0,
  `error_msg` varchar(255) NOT NULL,
  `error_level` varchar(255) DEFAULT NULL,
  `error_file` varchar(255) NOT NULL,
  `error_line` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `error_log`
--

INSERT INTO `error_log` (`errorID`, `userID`, `isException`, `error_msg`, `error_level`, `error_file`, `error_line`) VALUES
(228, 11, 1, 'SELECT * FROM cours where Approved=\'1\'', NULL, 'C:\\xampp\\htdocs\\IS3-Online-Tutoring\\src\\public\\home.php', 30),
(229, 11, 0, 'Undefined variable $variable', '2', 'C:\\xampp\\htdocs\\IS3-Online-Tutoring\\src\\public\\home.php', 32);

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

CREATE TABLE `learners` (
  `UserID` int(11) NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learners`
--

INSERT INTO `learners` (`UserID`, `profile_picture`) VALUES
(6, '1642803924_man.jpg'),
(7, '1642361954_mostafa.jpg'),
(8, '1642362122_mariam.jpg'),
(9, '1642362090_nancy.jpg'),
(10, '1642361865_akram.jpg'),
(20, ''),
(21, ''),
(22, '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `fromUserID` int(11) NOT NULL,
  `toUserID` int(11) DEFAULT NULL,
  `text` varchar(1000) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `isRead` tinyint(1) DEFAULT NULL,
  `date` datetime NOT NULL,
  `isReadAuditor` tinyint(1) DEFAULT NULL,
  `parentMessageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `fromUserID`, `toUserID`, `text`, `link`, `file`, `isRead`, `date`, `isReadAuditor`, `parentMessageID`) VALUES
(1, 7, NULL, 'Hello admin', '', NULL, 1, '2022-01-16 22:27:20', 1, NULL),
(2, 7, NULL, 'I need a database course ', '', NULL, 1, '2022-01-16 22:27:45', 1, NULL),
(3, 7, NULL, 'Here is a link to a similar code', 'https://www.udemy.com/course/relational-database-design/', NULL, 1, '2022-01-16 22:28:36', 1, NULL),
(4, 7, NULL, '', '', '1642365005_database.png', 1, '2022-01-16 22:30:05', 1, NULL),
(5, 3, 7, 'Okay, we will work on that', NULL, NULL, NULL, '2022-01-16 22:31:02', 1, NULL),
(6, 3, 7, 'Please send us more information', NULL, NULL, NULL, '2022-01-16 22:31:12', 1, NULL),
(7, 13, 3, 'Good but not enough', NULL, NULL, 0, '2022-01-16 22:33:24', NULL, 6),
(8, 9, NULL, 'Please help me, I need a course about writing research papers', '', NULL, 1, '2022-01-16 22:34:28', 1, NULL),
(9, 3, 9, 'Okay sure, we will try to offer that ', NULL, NULL, NULL, '2022-01-16 22:34:51', 1, NULL),
(11, 6, NULL, ' Hello ', '', NULL, 1, '2022-01-21 21:45:35', 1, NULL),
(12, 3, 6, 'How can we help you', NULL, NULL, NULL, '2022-01-21 22:59:48', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `FromUserID` int(11) NOT NULL,
  `ToUserID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `Type` varchar(25) NOT NULL,
  `Text` text NOT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordercourses`
--

CREATE TABLE `ordercourses` (
  `orderID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordercourses`
--

INSERT INTO `ordercourses` (`orderID`, `CourseID`) VALUES
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderTime` datetime NOT NULL,
  `Amount` int(11) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `UserID`, `OrderTime`, `Amount`, `Total`) VALUES
(1, 7, '2022-01-16 22:15:26', 3, 3300),
(2, 8, '2022-01-16 22:17:54', 3, 2600);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `CourseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`CourseID`, `UserID`, `rating`, `review`, `date`) VALUES
(1, 7, 4, 'A very informative course! Thanks a lot', '2022-01-16'),
(1, 8, 5, 'I loved the course! And I am giving it 5 stars even though I do have a few comments. It is a well-rounded course but if you are here to learn Data Science, there may be other courses out there. After all this is a boot camp and the background needed to understand Data Science is not provided in this course. Other than that, I fully recommend this course, it is really great for all levels (beginners to advanced); Angela\'s videos are amazing as always.', '2022-01-16'),
(5, 7, 4, 'Simple yet very useful', '2022-01-16'),
(8, 8, 4, '', '2022-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `surveyID` int(11) NOT NULL,
  `fromLearnerID` int(11) NOT NULL,
  `toTutorID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `question1` int(11) DEFAULT NULL,
  `question2` int(11) DEFAULT NULL,
  `question3` int(11) DEFAULT NULL,
  `question4` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `UserID` int(11) NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`UserID`, `profile_picture`) VALUES
(11, '1642362387_teacher.jpg'),
(12, '1642362984_man.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `PhoneNumber` varchar(25) DEFAULT NULL,
  `Country` varchar(25) DEFAULT NULL,
  `BirthDate` date NOT NULL,
  `UserType` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Country`, `BirthDate`, `UserType`) VALUES
(1, 'ahmed@123', '$2y$10$jKJVIvQsISBDZaTFWEG08.LPhM17C9kC/6Q0vZzxStJHSlZe17Uj6', 'Ahmed', 'Bassem', 'ahmed@gmail.com', '010087634877', 'Egypt', '2001-03-30', 'Administrator'),
(3, 'judy@123', '$2y$10$V4e0wk3dmjdhs/GHlrz0i.tdtB/4yiqvIbpECrLmkOEz4JHHEhBAa', 'Judy', 'Wagdy', 'judy@gmail.com', '+201022208997', 'Egypt', '2001-01-13', 'Administrator'),
(4, 'reem@123', '$2y$10$t8bTxs7xdjDTRtUY5LxupevMAG9QlyklPf3dfWtkQlgolghJTFPoq', 'Reem', 'Mansour', 'reem@gmail.com', '0109283749283', 'Egypt', '2001-05-21', 'Administrator'),
(6, 'johnsmith87', '$2y$10$hcaab4e3MaO.ie4eVOuW5OmYJRVAEsTaXrStYuqrsk3Fo1gqOFrdS', 'John', 'Smith', 'smith@gmail.com', '01006757633', 'Austria', '2010-10-12', 'Learner'),
(7, 'mostafawahba09', '$2y$10$3lMgIM/pWfdSzZW.77hUSuuWUE2R72g0O.AjNaYtCBs9yvaeWl/w2', 'Mostafa', 'Wahba', 'mostafa@gmail.com', '01009879855', 'United', '1993-01-12', 'Learner'),
(8, 'mariamnader73', '$2y$10$hHWRVH31qOrpBAcUd7y54.LT0r2tpLisvATeac4dK/FWHjn0.TvY6', 'Mariam', 'Nader', 'mariamnader73@gmail.com', '01028374638', 'Morocco', '1982-02-02', 'Learner'),
(9, 'nancymsawires', '$2y$10$c67k5UuPm7QXP.Oy.8NaYe3xWY6Hg35bC6ogpc6MHR03a2eGMW5mu', 'Nancy', 'Maged', 'nancy.m.sawires@hotmail.c', '01554367988', 'Bahrain', '1955-02-08', 'Learner'),
(10, 'akram_adel', '$2y$10$XRG5cSEO31WVwdQov6IGROsGR0KYaczpEjYIfXLeZo6VZLHZ5KCv6', 'Akram', 'Adel', 'akramaadel@yahoo.com', '01028374823', 'Bangladesh', '1979-02-05', 'Learner'),
(11, 'magdamohsen', '$2y$10$iX/DA/aBf2iCqugOsBji0O7JJAh6pBnkoL43aUljmDw3FODGveGlG', 'Magda', 'Mohsen', 'magdamohsen@hotmail.com', '010098767655', 'Djibouti', '1967-11-02', 'Tutor'),
(12, 'samerwahidk', '$2y$10$SxkENfsX0yZHpeMPiqvYBOr4tFuUACBTi.6U2.fNxc36nsEkqE.6u', 'Samer', 'Wahid', 'saamer.w.khaled@gmail.com', '0102938473', 'Bahrain', '1990-06-19', 'Tutor'),
(13, 'samir@123', '$2y$10$oqSkqu2hgYtD2gQzmAvAHO2gCTbrEKb/dn8tyQby3KxAKWY2VUdEG', 'Samir', 'Bassem', 'samir@2001', '0102938472', 'Egypt', '2000-11-02', 'Auditor'),
(15, 'steven@123', '$2y$10$wMISXng/u0L0nNRc3pTQCONSexN29UqEmZ/BZa1wXty7OKPKFdGE2', 'Steven', 'Albert', 'stevenalbert@gmail.com', '010035726483', 'Bahrain', '2021-11-29', 'Administrator'),
(20, 'judy', '$2y$10$V2M6hrffQsYTyUN0XWhhB.wlrGxkf.wlbaQS.ckEuluNCpitQsssG', 'Judy', 'Wagdy', 'judykhairalla@gmail.com', '01022208997', 'Bahrain', '2021-11-29', 'Learner'),
(21, 'judy@12', '$2y$10$R8g6p6C5pDvoyWYe/DebdenCwZOpgHSUI.rxmOfxyO9el1vTgvkyu', 'Judy', 'Wagdy', 'judy@gmail.com', '01006757544', 'Armenia', '2021-11-30', 'Learner'),
(22, 'judy@1', '$2y$10$G2iTwt5Eu5sxsX0leGuoe.LTEQh.3dUmpNoY1f589RhA/dVcKwjv2', 'Judy', 'Wagdy', 'judykhairalla@gmail.com', '01007868677', 'Azerbaijan', '2021-12-06', 'Learner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartcourses`
--
ALTER TABLE `cartcourses`
  ADD PRIMARY KEY (`UserID`,`CourseID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `chaptermaterials`
--
ALTER TABLE `chaptermaterials`
  ADD PRIMARY KEY (`resourceID`),
  ADD KEY `CourseID` (`CourseID`,`chapter`);

--
-- Indexes for table `coursechapters`
--
ALTER TABLE `coursechapters`
  ADD PRIMARY KEY (`CourseID`,`chapter`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`UserID`,`CourseID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `error_log`
--
ALTER TABLE `error_log`
  ADD PRIMARY KEY (`errorID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `learners`
--
ALTER TABLE `learners`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `fromUserID` (`fromUserID`),
  ADD KEY `toUserID` (`toUserID`),
  ADD KEY `parentMessageID` (`parentMessageID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `FromUserID` (`FromUserID`),
  ADD KEY `ToUserID` (`ToUserID`);

--
-- Indexes for table `ordercourses`
--
ALTER TABLE `ordercourses`
  ADD PRIMARY KEY (`orderID`,`CourseID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`CourseID`,`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`surveyID`,`fromLearnerID`,`courseID`) USING BTREE,
  ADD KEY `fromUserID` (`fromLearnerID`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `toTutorID` (`toTutorID`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chaptermaterials`
--
ALTER TABLE `chaptermaterials`
  MODIFY `resourceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `error_log`
--
ALTER TABLE `error_log`
  MODIFY `errorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `surveyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartcourses`
--
ALTER TABLE `cartcourses`
  ADD CONSTRAINT `cartcourses_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `learners` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cartcourses_ibfk_4` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE;

--
-- Constraints for table `chaptermaterials`
--
ALTER TABLE `chaptermaterials`
  ADD CONSTRAINT `chaptermaterials_ibfk_1` FOREIGN KEY (`CourseID`,`chapter`) REFERENCES `coursechapters` (`CourseID`, `chapter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chaptermaterials_ibfk_2` FOREIGN KEY (`CourseID`,`chapter`) REFERENCES `coursechapters` (`CourseID`, `chapter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coursechapters`
--
ALTER TABLE `coursechapters`
  ADD CONSTRAINT `coursechapters_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enroll_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `learners` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `error_log`
--
ALTER TABLE `error_log`
  ADD CONSTRAINT `error_log_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `learners`
--
ALTER TABLE `learners`
  ADD CONSTRAINT `learners_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`fromUserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`toUserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`parentMessageID`) REFERENCES `messages` (`messageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`FromUserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`ToUserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordercourses`
--
ALTER TABLE `ordercourses`
  ADD CONSTRAINT `ordercourses_ibfk_3` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordercourses_ibfk_4` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `learners` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_4` FOREIGN KEY (`UserID`) REFERENCES `learners` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD CONSTRAINT `resetpassword_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_ibfk_2` FOREIGN KEY (`fromLearnerID`) REFERENCES `learners` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_ibfk_3` FOREIGN KEY (`toTutorID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutors`
--
ALTER TABLE `tutors`
  ADD CONSTRAINT `tutors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
