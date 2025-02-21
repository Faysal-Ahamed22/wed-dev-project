-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 10:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correct_option` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `topic`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_option`) VALUES
(1, 'c++', 'Which of the following is used to declare a constant variable in C++?', 'const', 'constant', '#define', 'final', 1),
(2, 'c++', 'What is the output of \"cout << 5/2;\" in C++?', '2', '2.5', '3', 'Depends on compiler', 4),
(3, 'c++', 'Which of the following is a correct comment in C++?', '/* comment */', '// comment', '# comment', '<!-- comment -->', 2),
(4, 'c++', 'Which operator is used to get the address of a variable?', '&', '*', '->', '%', 1),
(5, 'c++', 'What does STL stand for in C++?', 'Standard Type Library', 'Standard Template Library', 'Simple Template Library', 'System Template Library', 2),
(6, 'c++', 'Which of these is a valid way to allocate memory in C++?', 'malloc()', 'new', 'alloc()', 'create()', 2),
(7, 'c++', 'Which of these is not a C++ access specifier?', 'public', 'private', 'protected', 'internal', 4),
(8, 'c++', 'Which keyword is used to define a macro in C++?', 'macro', '#define', 'const', 'define', 2),
(9, 'c++', 'Which header file is required to use cout in C++?', '<iostream>', '<stdio.h>', '<conio.h>', '<iomanip>', 1),
(10, 'c++', 'Which of the following is the correct way to include a user-defined header file?', '#include \"myheader.h\"', '#include <myheader.h>', '#include <myheader>', '#include \"myheader\"', 1),
(11, 'java', 'Which of these is the correct entry point for a Java program?', 'public void main(String args[])', 'public static void main(String[] args)', 'static public void main(String args)', 'void main()', 2),
(12, 'java', 'What is the size of an int in Java?', '2 bytes', '4 bytes', '8 bytes', 'Depends on the system', 2),
(13, 'java', 'Which of the following is not a Java keyword?', 'class', 'interface', 'extends', 'include', 4),
(14, 'java', 'What does JVM stand for?', 'Java Variable Machine', 'Java Virtual Method', 'Java Virtual Machine', 'Java Visual Machine', 3),
(15, 'java', 'Which company originally developed Java?', 'Microsoft', 'Sun Microsystems', 'Oracle', 'Google', 2),
(16, 'java', 'Which of these is a valid access modifier in Java?', 'friend', 'protected', 'package', 'internal', 2),
(17, 'java', 'Which method is used to print output in Java?', 'System.out.print()', 'Console.WriteLine()', 'print()', 'printf()', 1),
(18, 'java', 'What is the default value of a boolean in Java?', 'true', 'false', '0', 'null', 2),
(19, 'java', 'Which keyword is used to create an object in Java?', 'malloc', 'new', 'create', 'object()', 2),
(20, 'java', 'Which package is used for input and output operations in Java?', 'java.util', 'java.io', 'java.net', 'java.sql', 2),
(21, 'python', 'Which of the following is the correct file extension for Python files?', '.py', '.python', '.pt', '.pyt', 1),
(22, 'python', 'Which keyword is used for function declaration in Python?', 'def', 'function', 'fun', 'define', 1),
(23, 'python', 'What is the output of \"print(2 ** 3)\" in Python?', '6', '8', '9', 'Error', 2),
(24, 'python', 'Which of these is used to comment a single line in Python?', '//', '/*', '#', '<!--', 3),
(25, 'python', 'Which data type is used to store a sequence of elements in Python?', 'list', 'tuple', 'array', 'dictionary', 1),
(26, 'python', 'Which method is used to add an element to the end of a list in Python?', 'add()', 'append()', 'insert()', 'push()', 2),
(27, 'python', 'What does the len() function do in Python?', 'Returns the length of an object', 'Deletes an object', 'Converts an object to string', 'Returns the type of an object', 1),
(28, 'python', 'Which of these is not a built-in Python data type?', 'set', 'tuple', 'array', 'dictionary', 3),
(29, 'python', 'Which keyword is used to handle exceptions in Python?', 'catch', 'try', 'handle', 'except', 4),
(30, 'python', 'What is the correct way to start a for loop in Python?', 'for(i=0;i<5;i++)', 'for i in range(5):', 'for i=0; i<5; i++', 'foreach i in range(5)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `topic`, `total_questions`, `start_time`, `duration`, `created_by`, `created_at`) VALUES
(1, 'c++', 5, '2025-01-01 00:00:00', 10, 1, '2025-02-21 08:32:36'),
(2, 'c++', 7, '2025-02-21 12:12:12', 1200, 1, '2025-02-21 08:35:41'),
(3, 'c++', 6, '2025-02-20 00:00:00', 12000, 1, '2025-02-21 08:37:51'),
(4, 'java', 5, '2025-02-20 00:00:00', 12000, 1, '2025-02-21 09:24:12'),
(5, 'python', 10, '2025-02-20 00:00:00', 11000, 1, '2025-02-21 09:34:50'),
(6, 'python', 10, '2025-02-20 00:00:00', 11000, 1, '2025-02-21 09:36:16'),
(7, 'c++', 10, '2025-02-20 00:00:00', 11000, 1, '2025-02-21 09:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_id`) VALUES
(1, 1, 6),
(2, 1, 10),
(3, 1, 3),
(4, 1, 8),
(5, 1, 9),
(6, 2, 10),
(7, 2, 6),
(8, 2, 7),
(9, 2, 5),
(10, 2, 3),
(11, 2, 4),
(12, 2, 1),
(13, 3, 6),
(14, 3, 8),
(15, 3, 4),
(16, 3, 10),
(17, 3, 9),
(18, 3, 7),
(19, 4, 11),
(20, 4, 14),
(21, 4, 13),
(22, 4, 20),
(23, 4, 15),
(24, 5, 30),
(25, 5, 23),
(26, 5, 28),
(27, 5, 25),
(28, 5, 26),
(29, 5, 27),
(30, 5, 24),
(31, 5, 29),
(32, 5, 22),
(33, 5, 21),
(34, 6, 21),
(35, 6, 24),
(36, 6, 28),
(37, 6, 22),
(38, 6, 25),
(39, 6, 27),
(40, 6, 23),
(41, 6, 29),
(42, 6, 30),
(43, 6, 26),
(44, 7, 3),
(45, 7, 7),
(46, 7, 2),
(47, 7, 5),
(48, 7, 6),
(49, 7, 4),
(50, 7, 9),
(51, 7, 8),
(52, 7, 1),
(53, 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `quiz_id`, `user_id`, `score`, `submitted_at`) VALUES
(1, 3, 13, 3, '2025-02-21 08:38:48'),
(2, 4, 13, 0, '2025-02-21 09:25:29'),
(3, 3, 13, 2, '2025-02-21 09:27:47'),
(4, 3, 13, 2, '2025-02-21 09:29:06'),
(5, 4, 13, 2, '2025-02-21 09:33:31'),
(6, 7, 13, 4, '2025-02-21 09:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'faysal', '1234', 'admin', '2025-02-21 08:20:07'),
(2, 'teacher2', 'teacherpass2', 'admin', '2025-02-21 08:20:07'),
(12, 'student1', 'studentpass', 'student', '2025-02-21 08:22:17'),
(13, 'faysal12', '1234', 'student', '2025-02-21 08:22:17'),
(14, 'student3', 'studentpass3', 'student', '2025-02-21 08:22:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `quiz_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `quiz_results_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
