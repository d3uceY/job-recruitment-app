-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 09:59 AM
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
-- Database: `career_bank_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `educational_level`
--

CREATE TABLE `educational_level` (
  `id` int(11) NOT NULL,
  `education` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educational_level`
--

INSERT INTO `educational_level` (`id`, `education`) VALUES
(4, 'BsC'),
(6, 'PhD'),
(7, 'M.S degree'),
(8, 'Ed'),
(10, 'HND'),
(11, 'NCE'),
(12, 'OND'),
(13, 'SSCE');

-- --------------------------------------------------------

--
-- Table structure for table `industry_category`
--

CREATE TABLE `industry_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `industry_category`
--

INSERT INTO `industry_category` (`id`, `category`) VALUES
(6, 'Aviation'),
(8, 'Information Technology'),
(9, 'Medicine'),
(10, 'Data Management');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `expected_salary` decimal(10,2) DEFAULT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `application_date` datetime DEFAULT NULL,
  `preferred_location` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `cover_letter_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_application_status`
--

CREATE TABLE `job_application_status` (
  `status` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_application_status`
--

INSERT INTO `job_application_status` (`status`, `id`) VALUES
('NEW', 1),
('PENDING', 2),
('OPENED', 3),
('HIRED', 4),
('REJECTED', 5),
('SHORTLISTED', 6);

-- --------------------------------------------------------

--
-- Table structure for table `job_openings`
--

CREATE TABLE `job_openings` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `job_summary` text NOT NULL,
  `job_responsibility` text NOT NULL,
  `job_requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_openings`
--

INSERT INTO `job_openings` (`id`, `job_title`, `job_location`, `duration`, `job_summary`, `job_responsibility`, `job_requirements`) VALUES
(4, 'IT Officer- Full Stack Developer ', '4', '2025-01-30', '<p>The primary objective of this role is to leverage expertise in front-end and back-end technologies to design, develop, and maintain robust web applications while collaborating with cross-functional teams to deliver high-quality, scalable, and innovative solutions that meet business objectives and user needs.</p>', '<ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span> <span style=\"color: rgb(108, 122, 135);\">Design, develop, and maintain robust and user-friendly web applications, ensuring high performance, responsiveness, and security across the stack.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Create visually appealing and intuitive user interfaces using modern frontend technologies while ensuring compatibility across multiple browsers and devices.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Build scalable backend systems and APIs using server-side technologies and database management to handle data storage, retrieval, and manipulation efficiently.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Collaborate to implement automated testing strategies, ensuring the reliability and integrity of the applications. Integrate third-party APIs and services as needed</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Continuously improve the codebase, optimize application performance, and troubleshoot issues to maintain high standards of quality and efficiency</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Provide technical assistance and software support to PC users within the company, troubleshooting hardware, software, and network issues promptly</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Manage and maintain software, ensuring all systems and applications are up-to-date and secure</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Collaborate with cross-functional teams to understand their needs and develop technical solutions aligned with business objectives.</span></li></ol><p><br></p>', '<h1><br></h1><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Bachelor\'s degree in Computer Science, Engineering, or an equivalent field.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Proven experience as a Full Stack Developer or similar role.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Proficiency in frontend and backend technologies, along with strong knowledge of database systems.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Familiarity with cloud platforms, deployment strategies, and DevOps practices is a plus.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Excellent problem-solving skills and the ability to work in a dynamic, fast-paced environment.</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><span style=\"color: rgb(108, 122, 135);\">Strong communication skills and the ability to collaborate effectively within a team.</span></li></ol><p><br></p>'),
(7, 'Janitor', '5', '2025-01-31', '<p>this is a job opening</p>', '<p>this is a job opening</p>', '<p>this is a job opening</p>');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `state`, `country`) VALUES
(4, 'Lagos', 'Nigeria'),
(5, 'Anambra', 'Nigeria'),
(6, 'Washinton DC', 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `referral` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `referral`) VALUES
(2, 'LinkedIn'),
(4, 'Whatsapp'),
(5, 'Friends'),
(7, 'Company website'),
(8, 'Facebook'),
(9, 'Indeed'),
(10, 'Telegram'),
(11, 'myjobmag'),
(12, 'Glassdoor'),
(13, 'Jobgurus'),
(14, 'Ngcareers'),
(15, 'GrabJobs'),
(16, 'Twitter'),
(17, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `talents`
--

CREATE TABLE `talents` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `position` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `experience` int(11) NOT NULL,
  `salary_expectation` int(255) NOT NULL,
  `skills` text NOT NULL,
  `start_date` date NOT NULL,
  `resume_path` varchar(255) NOT NULL,
  `cover_letter_path` varchar(255) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password`) VALUES
(2, 'Deuce', 'onyekwelujesse1234@gmail.com', '$2y$10$NKUntlxCKMor1UKLfQQL1eDP6vqZKuxLCg5BEd0aTVltSYR/izUyK'),
(3, 'Quandale', 'hillary@gmail.com', '$2y$10$HfnTyNiKzavcPZrf6xyGlO3GJHLh4tPdp2fntPJ9p8BU66ek268hi'),
(4, 'Jesse', 'Levinho@gmail.com', '$2y$10$aB7kex2/o07hMhSZZIAWl.0MsThiz1MyIkcpvBwpU0wcyFBwFR7R.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `educational_level`
--
ALTER TABLE `educational_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industry_category`
--
ALTER TABLE `industry_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job_application_status`
--
ALTER TABLE `job_application_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_openings`
--
ALTER TABLE `job_openings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `talents`
--
ALTER TABLE `talents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `educational_level`
--
ALTER TABLE `educational_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `industry_category`
--
ALTER TABLE `industry_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `job_application_status`
--
ALTER TABLE `job_application_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_openings`
--
ALTER TABLE `job_openings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `talents`
--
ALTER TABLE `talents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_openings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
