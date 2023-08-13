-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 05:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `channel_id` int(11) NOT NULL,
  `channel_name` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`channel_id`, `channel_name`, `admin_id`, `thumbnail`, `created_at`) VALUES
(42, 'html', 7, 'uploads/thumb-1.png', '2023-03-30 14:03:03'),
(43, 'php', 7, 'uploads/thumb-1.png', '2023-03-30 14:03:03'),
(44, 'java', 7, 'uploads/thumb-4.png', '2023-03-30 14:03:03'),
(45, 'hiii', 7, 'uploads/post-1-5.png', '2023-03-30 14:03:03'),
(49, 'kaii', 7, 'uploads/thumb-6.png', '2023-03-30 14:03:03'),
(50, 'aswath', 7, 'uploads/thumb-4.png', '2023-03-31 08:12:36'),
(52, 'bharani', 7, 'uploads/529651.jpg', '2023-04-03 04:52:34'),
(53, 'hiiii', 7, 'uploads/529651.jpg', '2023-04-04 12:05:23'),
(57, 'cvbn', 7, 'uploads/529712.jpg', '2023-04-04 13:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(70) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `video_id`, `user_id`, `comment_text`, `created_at`, `username`, `total`) VALUES
(46, NULL, 17, 3, 'hiii', '2023-04-02 05:53:08', '', 0),
(54, NULL, 25, 7, 'hiii', '2023-04-02 08:13:58', '', 0),
(57, NULL, 24, 3, 'hiiii', '2023-04-03 01:57:19', '', 0),
(58, NULL, 33, 3, 'hiii', '2023-04-05 11:34:32', '', 0),
(59, 58, 33, 3, 'hii...', '2023-04-05 11:39:22', '', 0),
(60, 58, 33, 3, 'hiiiiiiiii', '2023-04-05 11:44:23', '', 0),
(61, 58, 33, 3, 'cvb', '2023-04-05 11:48:34', '', 0),
(62, NULL, 33, 1, 'jiiiii', '2023-04-05 11:52:25', '', 0),
(63, NULL, 33, 7, 'hiii', '2023-04-05 12:00:55', '', 0),
(64, 58, 33, 1, 'tnx', '2023-04-05 12:01:59', '', 0),
(65, 62, 33, 1, 'fghj', '2023-04-05 12:03:41', '', 0),
(66, 62, 33, 1, 'fg', '2023-04-05 12:04:20', '', 0),
(74, NULL, 18, 3, 'hiiii', '2023-04-08 03:12:47', '', 0),
(77, NULL, 18, 7, 'heloooo', '2023-04-08 03:21:08', '', 0),
(82, 74, 18, 7, 'tell..mee', '2023-04-08 03:32:13', '', 0),
(84, 74, 18, 7, 'hiiii', '2023-04-08 03:40:53', '', 0),
(85, 74, 18, 3, 'tnxxxxx', '2023-04-08 03:42:04', '', 0),
(86, 74, 18, 3, 'qwertyuiolkjvc', '2023-04-08 03:47:37', '', 0),
(87, 74, 18, 1, 'hiiii', '2023-04-11 01:46:23', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `msg` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `msg`) VALUES
(1, 'dilip', 'dilip@gmail.com', 'hiiiiiiiiii');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `video_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`video_id`, `user_id`) VALUES
(19, 1),
(19, 3),
(18, 3),
(17, 1),
(25, 1),
(33, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `image`) VALUES
(1, 'David', '6412b34c15a96pic-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userform`
--

CREATE TABLE `userform` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` char(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userform`
--

INSERT INTO `userform` (`id`, `name`, `email`, `password`, `usertype`, `created_at`, `image`) VALUES
(1, 'jai', 'jai@gmaail', 'ji123', 'user', '2023-03-09 14:02:02', '642d922057a82pic-6.jpg'),
(3, 'dilip', 'dilip@gmail', 'dilip', 'user', '2023-03-10 14:37:10', '642d8a2b0e470529615.jpg'),
(7, 'bharani', 'bharani@gmail.com', 'bha123', 'admin', '2023-03-15 08:21:41', '642d8a3f51182529826.jpg'),
(13, 'ak', 'ak@gmail.com', 'ak47', 'admin', '2023-04-12 15:14:54', '6436cbd87feb8195548-OY9OIN-908.jpg'),
(14, 'navven', 'naveen@gmail.com', 'naveen123', 'user', '2023-04-13 05:20:55', '6437915a52cc2195548-OY9OIN-908.jpg'),
(15, 'ussain', 'ussain@gmail.com', 'ussain123', 'user', '2023-05-05 14:56:16', '645519968884apic-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `likes` int(25) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `video_title`, `video_url`, `channel_id`, `admin_id`, `description`, `thumbnail`, `likes`, `total`, `created_at`) VALUES
(17, 'java', 'uploads/vid-1.mp4', 44, 7, 'java...', 'thumbnail/thumb-3.png', 1, 3, '2023-04-02 11:30:32'),
(18, 'sham', 'uploads/vid-1.mp4', 42, 7, 'hiii....', 'thumbnail/thumb-7.png', 1, 3, '2023-04-01 10:07:29'),
(19, 'deepak', 'uploads/vid-1.mp4', 42, 7, 'hiii...', 'thumbnail/thumb-2.png', 2, 3, '2023-03-30 14:51:43'),
(23, 'php', 'uploads/vid-3.mp4', 50, 7, 'php part 1', 'thumbnail/thumb-7.png', 0, 0, '2023-03-31 08:13:31'),
(24, 'mysql', 'uploads/vid-4.mp4', 42, 7, 'part-1', 'thumbnail/thumb-8.png', 0, 0, '2023-04-03 05:51:44'),
(25, 'mysql', 'uploads/vid-8.mp4', 43, 7, 'part1', 'thumbnail/thumb-8.png', 1, 0, '2023-04-02 11:41:11'),
(26, 'dbms', 'uploads/vid-5.mp4', 42, 7, 'part-1', 'thumbnail/thumb-8.png', 0, 0, '2023-04-03 04:51:17'),
(33, 'kil', 'uploads/vid-8.mp4', 42, 7, 'hiiii', 'thumbnail/post-1-1.png', 1, 0, '2023-04-05 15:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `video_likes`
--

CREATE TABLE `video_likes` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_likes`
--

INSERT INTO `video_likes` (`id`, `video_id`, `user_id`) VALUES
(1, 18, 1),
(2, 19, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`channel_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`parent_id`),
  ADD KEY `comments_ibfk_2` (`video_id`),
  ADD KEY `comments_ibfk_3` (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `text` (`user_id`),
  ADD KEY `video` (`video_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userform`
--
ALTER TABLE `userform`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `video_likes`
--
ALTER TABLE `video_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_id` (`video_id`,`user_id`),
  ADD KEY `test` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userform`
--
ALTER TABLE `userform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `video_likes`
--
ALTER TABLE `video_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `channel_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `userform` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`video_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `userform` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `text` FOREIGN KEY (`user_id`) REFERENCES `userform` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `video` FOREIGN KEY (`video_id`) REFERENCES `video` (`video_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`channel_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `userform` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_likes`
--
ALTER TABLE `video_likes`
  ADD CONSTRAINT `test` FOREIGN KEY (`user_id`) REFERENCES `userform` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
