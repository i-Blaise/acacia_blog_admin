-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 03:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acacia_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(10) NOT NULL,
  `unique_code` varchar(100) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_body` varchar(10000) NOT NULL,
  `blog_video` varchar(255) DEFAULT NULL,
  `blog_single_img` varchar(255) DEFAULT NULL,
  `blog_slider1` varchar(255) DEFAULT NULL,
  `blog_slider2` varchar(255) DEFAULT NULL,
  `blog_slider3` varchar(255) DEFAULT NULL,
  `blog_slider4` varchar(255) DEFAULT NULL,
  `blog_slider5` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `unique_code`, `blog_title`, `blog_body`, `blog_video`, `blog_single_img`, `blog_slider1`, `blog_slider2`, `blog_slider3`, `blog_slider4`, `blog_slider5`, `date_added`) VALUES
(1, 'aca_blog635c7b9991045', 'dsf', 'dfa', '', '', NULL, NULL, NULL, NULL, NULL, '2022-10-29 01:02:28'),
(2, 'aca_blog635c7b9991045', 'dsf', 'dfa', '', 'http://localhost/acacia_blog_admin/images/uploads/20221029030258col-bottom-black-min-p-1080.png', NULL, NULL, NULL, NULL, NULL, '2022-10-29 01:02:58'),
(3, 'aca_blog635c7bedbc93e', 'dfa', 'fsd', '', NULL, 'http://localhost/acacia_blog_admin/images/uploads/20221029030418col-bottom-black-min-p-1080.png', 'http://localhost/acacia_blog_admin/images/uploads/20221029030418col-bottom-black-min-p-1080.png', 'http://localhost/acacia_blog_admin/images/uploads/20221029030418col-bottom-black-min-p-1080.png', 'http://localhost/acacia_blog_admin/images/uploads/20221029030418col-bottom-black-min-p-1080.png', 'http://localhost/acacia_blog_admin/images/uploads/20221029030418col-bottom-black-min-p-1080.png', '2022-10-29 01:04:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
