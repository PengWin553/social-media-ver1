-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 04:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `midterm_social_media_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(71, 71, 27, 'I can comment on my post.', '2024-04-22 15:36:29'),
(74, 71, 27, 'asdf', '2024-04-22 15:37:04'),
(75, 71, 28, 'I can also delete my comment on your post.', '2024-04-22 15:40:05'),
(77, 71, 28, 'I can only update and delete my comments on your post.', '2024-04-22 15:40:57'),
(78, 71, 28, 'Boang ka', '2024-04-22 15:41:02'),
(82, 74, 27, 'I can update comment on your post.', '2024-04-24 02:55:47'),
(84, 83, 27, 'This is a comment.', '2024-04-24 03:01:44'),
(85, 83, 27, 'asdf', '2024-04-24 03:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `follow_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `follower_id`, `followed_id`, `follow_date`) VALUES
(26, 28, 27, '2024-04-22 15:38:51'),
(28, 29, 27, '2024-04-22 15:42:48'),
(30, 27, 29, '2024-04-24 02:59:33'),
(34, 27, 28, '2024-04-24 11:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `posts_table`
--

CREATE TABLE `posts_table` (
  `post_id` int(11) NOT NULL,
  `text_input` varchar(200) DEFAULT NULL,
  `image_input` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts_table`
--

INSERT INTO `posts_table` (`post_id`, `text_input`, `image_input`, `user_id`) VALUES
(73, 'This is Touko\'s profile page.', NULL, 28),
(74, 'Gwapa ko hehe', NULL, 29),
(81, 'I\'m trying to post a picture', '6627b3936bbfb_box.png', 27),
(82, 'tHIS IS A POST', NULL, 27),
(83, 'This is a post with a photo.', '6627f474be8f3_underkids_wallpaper.jpg', 27),
(89, 'This is my news feed huh', NULL, 30),
(91, 'I created another post.', NULL, 27),
(92, 'I need to display post on my news feed too.', NULL, 27),
(93, 'This was posted on my newsfeed.', '66290b760cc95_cat.png', 27),
(94, 'afasdf', NULL, 27),
(95, 'I don\'t know why I can\'t see it added on my news feed.', NULL, 27),
(96, 'sadfasdf', NULL, 27),
(97, 'Trial', NULL, 27),
(98, 'afasdf', NULL, 27),
(102, 'dOES IT DUPLICATE?', NULL, 27),
(103, 'adsf', NULL, 27),
(104, 'duplicated?', NULL, 27);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo_table`
--

CREATE TABLE `userinfo_table` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `dob_month` varchar(60) DEFAULT NULL,
  `dob_day` varchar(60) DEFAULT NULL,
  `dob_year` year(4) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `gmail` varchar(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `background_picture` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo_table`
--

INSERT INTO `userinfo_table` (`user_id`, `first_name`, `last_name`, `dob_month`, `dob_day`, `dob_year`, `gender`, `gmail`, `password`, `profile_picture`, `background_picture`) VALUES
(27, 'Yuu', 'Koito', 'February', '14', '2003', 'Female', 'yuukoito@gmail.com', '1234567890', NULL, NULL),
(28, 'Touko', 'Nanami', 'April', '16', '1999', 'Custom', 'toukonanami@gmail.com', '1234567890', NULL, NULL),
(29, 'Goldfish', 'Secret', 'January', '1', '2000', 'Female', 'goldfishsecret@gmail.com', '123', NULL, NULL),
(30, 'Rae', 'Taylor', 'July', '17', '2003', 'Female', 'raetaylor@gmail.com', 'claire', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `follower_id` (`follower_id`,`followed_id`),
  ADD KEY `followed_id` (`followed_id`);

--
-- Indexes for table `posts_table`
--
ALTER TABLE `posts_table`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `userinfo_table`
--
ALTER TABLE `userinfo_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `posts_table`
--
ALTER TABLE `posts_table`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `userinfo_table`
--
ALTER TABLE `userinfo_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `userinfo_table` (`user_id`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `userinfo_table` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
