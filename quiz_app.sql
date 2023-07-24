-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 08:51 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `name` varchar(255) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `percentage` float(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaderboard`
--

-- INSERT INTO `leaderboard` (`id`, `name`, `score`) VALUES
-- (1, 'w11', 1),
-- (2, 'sufyan', 2),
-- (3, 'qwere', 1);



-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `correct_answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `options`, `correct_answer`) VALUES
(1, 'What is the capital of France?', '[\"Paris\", \"London\", \"Berlin\", \"Rome\"]', 0),
(2, 'Which planet is known as the Red Planet.?', '[\"Mars\", \"Jupiter\", \"Venus\", \"Mercury\"]', 0),
(3, 'Who is the owner of Facebook?', '[\"Mark Zuckerburg\", \"Elon Musk\", \"Jeff Bezos\", \"Bill Gates\"]', 3),
(4, 'The place of origin of an earthquake is called', '[\"Epicentre\", \"Seismal\", \"Focus\", \"Amphidromic point\"]', 2),
(5, 'The difference in the duration of day and night increases as one moves from', '[\"West to East\", \"East and west of the prime meridian\", \"Poles to equator\", \"Equator to poles\"]', 3),
(6, 'The busiest  sea route is ', '[\"The Mediterranean Red-Sea Route\", \"The South Atlantic Route\", \"The North Atlantic Route\", \"The Pacific Route\"]', 2),
(8, 'Name the Continents that form a mirror image of each other___', '[\"North America and South America\", \"Asia and Africa\", \"Africa and South America\", \" Europe and Asia\"]', 2),
(9, 'The highest average salinity amongst the following seas is reported from', '[\"Dead Sea\", \"Red Sea\", \"Black Sea\", \"Migration Sea\"]', 0),
(10, 'what does the term Lithosphere refer to', '[\"Interior of the earth\", \"Crust of the earth\", \"Plants and animals\", \"None of the above\"]', 1),
(11, 'The number indicating the intensity of an earthquake on a Richter scale range between', '[\"1 to 7\", \"1 to 9\", \"1 to 8\", \"1 to 12\"]', 1),
(12, 'Epsom(England) is the place associated with', '[\"Snooker\", \"Shooting\", \"Polo\", \" Horse racing\"]', 3),
(13, '“One People, One State, One leader” was the policy of', '[\"Stalin\", \"Hitler\", \"Lenin\", \"Mussolin\"]', 1),
(14, 'Which is a green planet in the solar system?', '[\"Pluto\", \"Venus\", \"Uranus\", \"Mars\"]', 2),
(15, 'FFC stands for', '[\"Foreign Finance Corporation\", \"xyz\", \"abc\", \"No\"]', 3),
(16, 'Bats can fly in the dark because', '[\"They have a better vision in the dark\", \"The light startles in them\", \"They produce high pitched sounds called ultrasonics\", \"None of the above\"]', 2),
(17, '6 months day and 6 months night - Country Name?', '[\"Nepal\", \"Tibet\", \"Norway\", \"Iceland\"]', 2),
(18, 'Which kind of power accounts for the largest share of power generation in India', '[\"Hydro - electricity\", \"Thermal\", \"Nuclear\", \"Solar\"]', 1),
(19, 'What is the full form of GDP', '[\"Gross domestic product\", \"Global domestic Ratio\", \"Gross depository revenue\", \"Global depository receipts\"]', 0),
(20, 'In India, planned economy is based on', '[\"Mixed Economy System\", \"Capitalist System\", \"Gandhian System\", \"Socialist System\"]', 3)

;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaderboard`
--
-- ALTER TABLE `leaderboard`
--   ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

CREATE TABLE users (
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    joined DATE DEFAULT CURRENT_TIMESTAMP
);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leaderboard`
--

--
-- AUTO_INCREMENT for table `questions`
--
-- ALTER TABLE `questions`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
