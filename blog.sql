-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 05:58 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `postid`, `userid`, `status`) VALUES
(68, 66, 58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `s_price` float(10,2) NOT NULL,
  `currency` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'SGD',
  `published` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `participant_limit` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `topic_id`, `title`, `image`, `body`, `category`, `s_price`, `currency`, `published`, `created_at`, `status`, `participant_limit`) VALUES
(77, 58, 10, 'Event Solo Test', '1638576633_1633917743_Desktop Screenshot 2021.10.11 - 09.52.25.88 (3).png', '&lt;p&gt;Testing&lt;/p&gt;', 'Solo', 5.00, 'SGD', 1, '2021-12-04 08:10:33', 1, 10),
(78, 58, 10, 'Event Team Test', '1638576655_1633917743_Desktop Screenshot 2021.10.11 - 09.52.25.88 (3).png', '&lt;p&gt;Test&lt;/p&gt;', 'Team', 5.00, 'SGD', 1, '2021-12-04 08:10:55', 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `txn_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payer_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `payer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payer_country` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `team` int(255) NOT NULL,
  `approval` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `topic_id`, `title`, `image`, `body`, `published`, `created_at`) VALUES
(66, 58, 9, 'Post 1 ', '1638593452_1634188240_game.jpg', '&lt;p&gt;this is the first post of Esport Brunei Thank you for reading this post !&lt;/p&gt;', 1, '2021-12-04 12:50:52'),
(67, 58, 15, 'Post 2', '1638593698_1634190231_G.jpg', '&lt;p&gt;this is the second post of Esport Brunei Thank you for reading this post !&lt;/p&gt;', 1, '2021-12-04 12:51:33'),
(68, 58, 9, 'Post 3', '1638593710_oren.jpg', '&lt;p&gt;this is the third post of Esport Brunei Thank you for reading this post !&lt;/p&gt;', 1, '2021-12-04 12:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `comment` varchar(200) NOT NULL,
  `comment_sender_name` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_like_unlike`
--

CREATE TABLE `tbl_like_unlike` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `like_unlike` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(255) NOT NULL,
  `team_name` varchar(1000) NOT NULL,
  `team_coach` varchar(1000) NOT NULL,
  `team_creator` int(255) NOT NULL,
  `team_captain` int(255) NOT NULL,
  `team_logo` varchar(255) NOT NULL,
  `limit_members` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `team_coach`, `team_creator`, `team_captain`, `team_logo`, `limit_members`) VALUES
(52, 'Team Zylioth', 'Zylioth', 91, 91, '1638592568_1633868565_post2.PNG', 3),
(53, 'Team User', 'User', 69, 69, '1638592592_1633868936_post4.PNG', 2);

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(255) NOT NULL,
  `team_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `team_id`, `member_id`) VALUES
(80, 52, 91),
(81, 53, 69);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(9, 'Gaming', '<p>game related stuff</p>'),
(10, 'Tournaments', '<p>upcoming or past Tournaments/events information will be here</p>'),
(15, 'news', '<p>Any sort of news</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bio` text NOT NULL DEFAULT 'No Bio Yet ... ',
  `instagram` text NOT NULL DEFAULT 'EsportBrunei',
  `steam` text NOT NULL DEFAULT 'SteamID',
  `discord` text NOT NULL DEFAULT 'name#0000',
  `pic` varchar(255) NOT NULL DEFAULT '1634018908_profile.png',
  `blocked` tinyint(4) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `organiser_status` int(11) NOT NULL,
  `phone_number` int(7) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `code`, `status`, `created_at`, `bio`, `instagram`, `steam`, `discord`, `pic`, `blocked`, `proof`, `organiser_status`, `phone_number`, `details`) VALUES
(39, 2, 'moderator', 'moderator@account.com', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 0, 'verified', '2021-10-04 05:40:32', 'test saja', '', '', 'name#0000', '1633613077_profile.png', 0, '1633611742_Desktop Screenshot 2021.10.07 - 20.21.52.15.png', 0, 0, ''),
(49, 1, 'Admin', 'Admin@account.com', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 174631, 'verified', '2021-10-05 12:02:29', 'Hello', '', '', 'name#0000', '1633768397_961279.png', 0, '1633612832_961279.png', 0, 7258975, ''),
(53, 3, 'organiser', 'organiser@account.com', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 904720, 'verified', '2021-10-08 03:21:09', 'This is the organiser\'s bio take a peek at my profile tehee', '', '', 'name#0000', '1633674352_Siesta (2).jpg', 0, '1633696357_Siesta (2).jpg', 2, 0, ''),
(58, 1, 'Izzat', 'izzat.latif4@gmail.com', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 259092, 'verified', '2021-10-10 11:58:50', 'Hi it\'s Izzat , Head-developer for EsportsBrunei . Eventhough it looks like rotten carcass but hey .. there\'s room for improvement am I right ??? xD', 'izzxtlxtif', '76561198450007053', 'kerol#1903', '1636977941_1634037650_Siesta.jpg', 0, '1633955682_orange-top-gradient-background.jpg', 0, 7258975, ''),
(59, 1, 'Amir Sabrin', 'AmirSabrin@gmail.com', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 196742, 'verified', '2021-10-10 11:59:23', 'One of the Co-Creator of Esports Brunei', '', '', 'name#0000', '1635135602_Miu.jpg', 0, '', 0, 8645562, ''),
(60, 1, 'Danial Kamsur', 'DanialKamsur@gmail.com', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 699403, 'verified', '2021-10-10 11:59:56', '', '', '', 'name#0000', '', 0, '', 0, 0, ''),
(61, 1, 'NydiaWesdi', 'NydiaWesdi@gmail.com', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 917176, 'verified', '2021-10-10 12:00:25', '', '', '', 'name#0000', '', 0, '', 0, 0, ''),
(69, 0, 'User', 'User@account', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 0, 'verified', '2021-10-14 13:27:59', 'hello ', '', '', 'name#0000', '1636975942_1634018908_profile.png', 0, '1636976645_1634037650_Siesta.jpg', 1, 1234456, '&lt;p&gt;yo&lt;/p&gt;'),
(91, 0, 'Zylioth', 'amirsabrin8@gmail.com', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 0, 'verified', '2021-10-27 13:12:53', 'Hello World', '_amir02', '76561199032818871', 'Zylioth#1580', '1635416514_Miu.jpg', 0, '1635416688_cert.png', 3, 8645562, '&lt;p&gt;Official Organiser for Esports Brunei&lt;/p&gt;'),
(100, 0, 'user1 ', 'user1@account', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 0, 'verified', '2021-12-04 00:16:00', 'No Bio Yet ... ', 'EsportBrunei', 'SteamID', 'name#0000', '1634018908_profile.png', 0, '', 0, 0, ''),
(101, 0, 'user2', 'user2@account', '$2y$10$GItInD/.ykAyDu5tEGt66u3xdCbpytYWdg0O.CLgK4.R.92gyNtCG', 0, 'verified', '2021-12-04 00:16:15', 'No Bio Yet ... ', 'EsportBrunei', 'SteamID', 'name#0000', '1634018908_profile.png', 0, '', 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_ibfk_1` (`topic_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_like_unlike`
--
ALTER TABLE `tbl_like_unlike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `tbl_like_unlike`
--
ALTER TABLE `tbl_like_unlike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
