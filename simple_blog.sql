-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2019 at 01:33 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `content`, `dt`, `id_user`) VALUES
(1, 'some article', 'hello, world!!!', '2019-08-12 19:27:02', 1),
(2, 'привет мир 2!', 'Lorem ipsum dolor sit.', '2019-08-12 20:46:16', 1),
(3, 'hello world', 'asdlfkj sldajf lasdjf al;sdjf ;lsdjf sdlfj', '2019-08-12 21:28:03', 1),
(4, 'hello world', 'hello worldhello worldhello world', '2019-08-12 21:30:39', 1),
(5, 'h e l l o', 'world!!!', '2019-08-13 09:58:56', 1),
(6, '123fsdfsd', '123123fsdfsdf123fsdfsd', '2019-08-14 12:03:03', 1),
(7, 'ssdafasdfsa df sdaff sa', 'fasd fasdf asd  sadf', '2019-08-14 12:30:15', 1),
(8, 'hello world 1', 'hello world 1', '2019-08-19 10:04:54', 1),
(9, '1234356671343af asd', 'asdfasdf sdf asdf asdf sadf', '2019-08-19 10:42:01', 1),
(10, 'Badass Badass', 'Badass Badass 123', '2019-08-20 17:32:27', 1),
(11, 'hello hru', 'world hru', '2019-08-24 10:14:57', 1),
(12, 'hello hru', 'world hru', '2019-08-24 10:17:18', 1),
(13, 'new title', 'new content', '2019-08-24 10:18:50', 1),
(14, 'привет мир 2!', 'htlloe ekjo lsdfjkdjf dsa f', '2019-08-24 10:20:28', 1),
(15, 'new user article', 'new user article new user article 1', '2019-08-25 23:51:01', NULL),
(16, 'тест на юзера', 'user test', '2019-08-26 00:08:19', 3),
(17, '___hello', 'users world 1', '2019-08-26 00:28:17', 4);

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_texts`
--

CREATE TABLE `dashboard_texts` (
  `alias` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboard_texts`
--

INSERT INTO `dashboard_texts` (`alias`, `name`, `value`) VALUES
('copyright', 'Копирайт', '© %s Untitled. All rights reserved. Design by TEMPLATED.'),
('footer_1', 'Футер - заголовок 1', 'Footer 1'),
('footer_2', 'Футер - заголовок 2', 'Footer 2'),
('footer_3', 'Футер - заголовок 3', 'Footer 3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `password`) VALUES
(1, 'admin', '947ed6bc5cc3aa6e0868c4ff71d62570a7a3fd457a308feb180533d6b3c109f64dbbd6359420ec2c8d07873166cac9f3514aab95d6dde0db99f979f43c06de11'),
(2, 'root', '73d3160c1a1166e65e7313a2b19a3793faaf9a8e1353a153143db651199ff889679f548738a35f1e5ad5b4f361eba20d7f200d3da090f9a14a883190b684948d'),
(3, 'rela589n', '411f248699f4f7ec6318d2e26ddf89729a788a2ef1c974dbce687c37d012ebebafab30b372c3ce834e17c61ddf6405069e3f1767ca15f6a547410f8540cd8af5'),
(4, 'hello', '37e5e0bb6507fb2547fb47f1433bf2c82699b7f56abfb2778dc26060d8924086d6e828110ae42d359f49b7dfc92df4a0eded8a836e96fe83916c876177f7d2d3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `dashboard_texts`
--
ALTER TABLE `dashboard_texts`
  ADD PRIMARY KEY (`alias`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
