-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 11:07 AM
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
  `comment_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `comment_status`, `created_at`) VALUES
(71, 71, 27, 'I can comment on my post.', '', '2024-04-22 15:36:29'),
(74, 71, 27, 'asdf', '', '2024-04-22 15:37:04'),
(75, 71, 28, 'I can also delete my comment on your post.', '', '2024-04-22 15:40:05'),
(77, 71, 28, 'I can only update and delete my comments on your post.', '', '2024-04-22 15:40:57'),
(78, 71, 28, 'Boang ka', '', '2024-04-22 15:41:02'),
(82, 74, 27, 'I can update comment on your post.', '', '2024-04-24 02:55:47'),
(84, 83, 27, 'This is a comment.', '', '2024-04-24 03:01:44'),
(85, 83, 27, 'asdf', '', '2024-04-24 03:03:17'),
(90, 106, 27, 'dsfdsfdsf', '', '2024-04-25 15:04:47'),
(91, 107, 27, 'This is another comment', '', '2024-04-25 15:05:07'),
(92, 97, 27, 'afasdfsd', '', '2024-04-25 15:48:29'),
(93, 105, 27, 'I know', '', '2024-04-25 15:55:09'),
(94, 106, 27, 'adfsdf', '', '2024-04-25 15:59:41'),
(95, 107, 27, 'afafdasfaf', '', '2024-04-25 16:00:50'),
(96, 74, 27, 'I can see your comment, Goldfish.', '', '2024-04-25 16:34:44'),
(97, 73, 27, 'I can comment on Touko\'s page.', '', '2024-04-25 16:42:10'),
(98, 120, 32, 'This is my comment', '', '2024-04-25 17:26:42'),
(99, 120, 32, 'This an updated comment.', '', '2024-04-25 17:26:50'),
(101, 120, 30, 'edited', '', '2024-04-25 17:29:49'),
(103, 112, 31, 'I can comment on your post', '', '2024-04-27 17:39:29'),
(105, 108, 31, 'I love you, Claire.', '', '2024-04-27 17:40:07'),
(106, 108, 30, 'Wait. I\'m supposed to be the one saying that.', '', '2024-04-27 17:40:55'),
(107, 108, 31, 'fgsdfg', '', '2024-04-27 17:41:35'),
(108, 108, 31, 'sgsdg', '', '2024-04-27 17:41:38'),
(109, 108, 31, 'sgd', '', '2024-04-27 17:41:42'),
(110, 108, 31, 'sdgsg', '', '2024-04-27 17:41:50'),
(111, 128, 27, 'I can comment on my post.', '', '2024-04-28 03:46:38'),
(112, 108, 27, 'I can also comment on your post.', '', '2024-04-28 03:48:56'),
(114, 138, 31, 'I can comment on my post.', '', '2024-04-28 13:25:47'),
(116, 134, 31, 'I can comment', '', '2024-04-28 13:27:29'),
(117, 135, 31, 'This looks nice.', '', '2024-04-28 13:27:37'),
(120, 73, 27, 'This is another comment on Touko\'s page. 123', '', '2024-04-29 01:58:43'),
(121, 142, 27, 'guugyu', '', '2024-04-29 08:16:13'),
(122, 141, 27, 'Mama mo', '', '2024-06-09 06:10:23'),
(123, 146, 27, 'mama mo', '', '2024-06-09 08:56:24');

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
(34, 27, 28, '2024-04-24 11:28:17'),
(35, 31, 30, '2024-04-25 17:07:52'),
(36, 30, 31, '2024-04-25 17:12:09'),
(37, 31, 27, '2024-04-25 17:19:26'),
(39, 30, 27, '2024-04-25 17:20:27'),
(41, 32, 30, '2024-04-25 17:27:20'),
(42, 32, 31, '2024-04-25 17:27:22'),
(43, 30, 32, '2024-04-25 17:29:21'),
(45, 34, 30, '2024-04-28 11:38:36'),
(46, 34, 31, '2024-04-28 11:38:50'),
(48, 35, 30, '2024-04-28 13:24:25'),
(49, 35, 31, '2024-04-28 13:24:45'),
(50, 31, 35, '2024-04-28 13:26:36'),
(51, 28, 31, '2024-04-29 02:04:58'),
(52, 31, 28, '2024-04-29 02:05:13'),
(54, 27, 31, '2024-04-29 08:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `seen_status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`post_id`, `user_id`, `message`, `seen_status`, `created_at`) VALUES
(147, 28, 'LIKED POST', 1, '2024-06-12 06:31:52'),
(145, 28, 'idk anymore', 1, '2024-06-12 06:32:17'),
(151, 28, 'ambot nimo', 1, '2024-06-12 06:33:16'),
(150, 28, 'ambot nimo ', 1, '2024-06-12 06:40:26'),
(141, 28, 't', 1, '2024-06-12 06:40:38'),
(148, 27, 'ddd', 1, '2024-06-12 06:41:37'),
(74, 27, 'Gwapa ko hehe', 0, '2024-06-12 06:41:57'),
(151, 27, 'ambot nimo', 1, '2024-06-12 06:43:28'),
(147, 27, 'LIKED POST', 1, '2024-06-12 06:44:12'),
(146, 28, 'idk', 1, '2024-06-12 06:44:22'),
(144, 28, 'boang', 1, '2024-06-12 06:44:51'),
(143, 28, 'uyyuhh', 1, '2024-06-12 06:44:56'),
(149, 27, 'addd', 1, '2024-06-12 06:46:37'),
(140, 27, 'I don\'t know what to post.', 1, '2024-06-12 06:46:47'),
(153, 28, 'YUU\'S LATEST POST', 1, '2024-06-12 06:48:25'),
(152, 27, 'TOUKO\'S LATES POST', 1, '2024-06-12 06:49:46'),
(149, 28, 'addd', 1, '2024-06-12 06:55:50'),
(128, 28, 'Kuyawan ko yawa', 1, '2024-06-12 06:56:09'),
(153, 27, 'YUU\'S LATEST POST', 1, '2024-06-12 06:59:48'),
(148, 28, 'ddd', 1, '2024-06-12 07:01:23'),
(154, 27, 'asdfdasf', 1, '2024-06-12 07:02:19'),
(155, 28, '', 1, '2024-06-12 07:02:41'),
(156, 27, 'I LOVE YOU YUU', 1, '2024-06-12 07:08:56'),
(155, 28, '', 1, '2024-06-12 07:10:49'),
(156, 28, 'I LOVE YOU YUU', 1, '2024-06-12 07:13:34'),
(157, 28, 'BOANG KA ', 1, '2024-06-12 07:20:16'),
(157, 27, 'BOANG KA ', 1, '2024-06-12 07:20:22'),
(158, 27, 'I love you Touko', 1, '2024-06-12 07:23:34'),
(158, 28, 'I love you Touko', 0, '2024-06-12 08:42:02');

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
(74, 'Gwapa ko hehe', NULL, 29),
(108, 'This is Claire\'s news feed - claire', NULL, 31),
(111, '', NULL, 31),
(112, 'sfdgsdfg', NULL, 31),
(113, 'sdfsdfdsfsdfsdfds', NULL, 31),
(117, 'I don\'t know what\'s on my mind.', NULL, 32),
(118, 'This is a post with a photo. Updated', '662a920cc2351_brunosmar.jpg', 32),
(119, 'Yawa lagi to', NULL, 32),
(120, 'Posted on my news feed', NULL, 32),
(122, 'My name is Rae Taylor and I posted this on my newsfeed.', '662cd1a470e4e_creeper.jpeg', 30),
(123, 'My name is Yuu and this is posted on my profile page.', '662cd68aa53e7_tuyu_hero_btn.png', 27),
(124, 'Yuu Koito - posted on newsfeed.', NULL, 27),
(125, 'Kanno - posted on NEWSFEED', NULL, 33),
(126, 'Kanno - posted on PROFILE PAGE', NULL, 33),
(127, 'trya', NULL, 27),
(128, 'Kuyawan ko yawa', '662cf0bb5c9f4_kanno.jpg', 27),
(131, 'Bruno - this was posted on my newsfeed.', '662e34f4d2586_desktop-wallpaper-tuyu.jpg', 34),
(132, 'This is another post posted on my newsfeed.', '662e34c95c0be_brunosmar.jpg', 34),
(134, 'Posted on my news feed.', NULL, 35),
(135, 'Another post', '662e4dbf00c6e_Guitar Abstract.png', 35),
(138, 'Claire is my name.', '662e4e50b5e92_bg_fix2.jpg', 31),
(140, 'I don\'t know what to post.', '662eff4dddae6_mc background.jpg', 28),
(141, 't', NULL, 28),
(142, 'fdgdfg', '662f04096b674_1.png', 31),
(143, 'uyyuhh', '662f57d484cba_midterm logo.jpg', 27),
(144, 'boang', NULL, 27),
(145, 'idk anymore', '66596b33d8be5_Screenshot 2024-03-17 142940.png', 27),
(146, 'idk', '666547fe49847_1.png', 27),
(147, 'LIKED POST', NULL, 27),
(148, 'ddd', NULL, 28),
(149, 'addd', '66657f29f326c_box.png', 28),
(150, 'ambot nimo ', '66666ff67eefb_box.png', 27),
(151, 'ambot nimo', '666916ef4d95a_facebook.png', 27),
(152, 'TOUKO\'S LATES POST', NULL, 28),
(153, 'YUU\'S LATEST POST', NULL, 27),
(154, 'asdfdasf', NULL, 28),
(155, '', '6669480edb3e8_adobe-illustrator.ico', 28),
(156, 'I LOVE YOU YUU', NULL, 28),
(157, 'BOANG KA ', NULL, 28),
(158, 'I love you Touko', '66694c7b0fd64_box.png', 27),
(159, 'mom', NULL, 28),
(160, 'mama mo', NULL, 28),
(161, 'dsaf', NULL, 28),
(162, 'Mama mo', NULL, 28),
(163, '', NULL, 28),
(164, '', NULL, 28),
(165, '', NULL, 28);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(81, 147, 28, '2024-06-12 06:31:52'),
(82, 145, 28, '2024-06-12 06:32:17'),
(83, 151, 28, '2024-06-12 06:33:16'),
(84, 150, 28, '2024-06-12 06:40:26'),
(85, 141, 28, '2024-06-12 06:40:38'),
(86, 148, 27, '2024-06-12 06:41:37'),
(87, 74, 27, '2024-06-12 06:41:57'),
(89, 151, 27, '2024-06-12 06:43:28'),
(90, 147, 27, '2024-06-12 06:44:12'),
(91, 146, 28, '2024-06-12 06:44:22'),
(92, 144, 28, '2024-06-12 06:44:51'),
(93, 143, 28, '2024-06-12 06:44:56'),
(94, 149, 27, '2024-06-12 06:46:37'),
(95, 140, 27, '2024-06-12 06:46:47'),
(105, 153, 28, '2024-06-12 06:48:25'),
(106, 152, 27, '2024-06-12 06:49:46'),
(107, 149, 28, '2024-06-12 06:55:50'),
(108, 128, 28, '2024-06-12 06:56:09'),
(109, 153, 27, '2024-06-12 06:59:48'),
(110, 148, 28, '2024-06-12 07:01:23'),
(111, 154, 27, '2024-06-12 07:02:19'),
(112, 155, 28, '2024-06-12 07:02:41'),
(115, 156, 27, '2024-06-12 07:08:56'),
(117, 155, 28, '2024-06-12 07:10:49'),
(119, 156, 28, '2024-06-12 07:13:34'),
(120, 157, 28, '2024-06-12 07:20:16'),
(121, 157, 27, '2024-06-12 07:20:22'),
(126, 158, 27, '2024-06-12 07:23:34'),
(127, 158, 28, '2024-06-12 08:42:02');

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
(27, 'Yuu', 'Koito', 'February', '14', '2003', 'Female', 'yuukoito@gmail.com', '1234567890', '662d36684f4e4_adobe-illustrator.ico', NULL),
(28, 'Touko', 'Nanami', 'April', '16', '1999', 'Custom', 'toukonanami@gmail.com', '1234567890', NULL, NULL),
(29, 'Goldfish', 'Secret', 'January', '1', '2000', 'Female', 'goldfishsecret@gmail.com', '123', NULL, NULL),
(30, 'Rae', 'Taylor', 'July', '17', '2003', 'Female', 'raetaylor@gmail.com', 'claire', '662d370b4b4f4_miro.png', NULL),
(31, 'Claire', 'Francois', 'April', '15', '2004', 'Female', 'clairefrancois@gmail.com', 'rae', NULL, NULL),
(32, 'Ambot', 'Nimo', 'July', '7', '2007', 'Female', 'ambotnimo@gmail.com', '1234567890', NULL, NULL),
(33, 'Kanno', 'Kobayashi', 'January', '1', '2022', 'Male', 'kannokobayashi@gmail.com', 'kanno', NULL, NULL),
(34, 'Brunos', 'Mar', 'June', '14', '1999', 'Male', 'brunosmar@gmail.com', 'bruno', NULL, NULL),
(35, 'Yuzu', 'Aihara', 'May', '15', '2002', 'Female', 'yuzuaihara@gmail.com', 'mei', NULL, NULL);

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
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `posts_table`
--
ALTER TABLE `posts_table`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `userinfo_table`
--
ALTER TABLE `userinfo_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `userinfo_table` (`user_id`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `userinfo_table` (`user_id`);

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts_table` (`post_id`),
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userinfo_table` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
