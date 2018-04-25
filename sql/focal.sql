-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2018 at 09:00 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `focal`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `u_id`, `f_id`) VALUES
(1, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `tags`, `photo_url`, `title`, `categories_id`, `users_id`) VALUES
(1, '2018-04-22 14:07:37', 'sport fans, sport, football', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(2, '2018-04-22 14:12:07', 'sport, sport fans, new york', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(3, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(4, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(5, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(6, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(7, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(8, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(9, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(10, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(11, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(12, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(13, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(14, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(15, '2018-04-17 17:18:25', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 1),
(16, '2018-04-22 14:27:06', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 2),
(17, '2018-04-21 13:34:54', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 2),
(18, '2018-04-21 12:45:20', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 2),
(19, '2018-04-21 12:45:09', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 2),
(20, '2018-04-21 12:42:58', 'sport', 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&s=9ada52cf13e2269e0cca421c043e434d&auto=format&fit=crop&w=1225&q=80', 'Sport fans', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `first_name`, `last_name`, `creation`) VALUES
(1, 'azerty@azerty.com', '$2y$12$OhAqvtANNPtZQOn7pphQYODL8fVhOpwBZW3345.9dG3FL3Qp8irpO', 'azerty', 'azerty', 'azerty', '2018-04-18 07:42:34'),
(2, 'poiuytreza@poiuytreza.com', '$2y$12$.djYcO/MM/fxG6FOQf6OKuU3SFTLugQtbMkikM6gOvJ24Q9npsjgG', 'poiuytreza', 'poiuytreza', 'poiuytreza', '2018-04-18 07:44:58'),
(3, 'jo@test.com', '$2y$12$UGQKyc9Qt1xe5tAPgMHFIObR4cAWfHRaak8Jq7zVvipwVFJDEBWVG', 'jo', 'jo', 'jo', '2018-04-20 13:20:10'),
(4, 'jefke@jefke.com', '$2y$12$YHvaHeQFlCqvK40zzA4YVe0ArYXYGDHiTIojDSqaiMVLdslSUixuu', 'Jefke', 'jefke', 'jefke', '2018-04-21 12:42:19'),
(5, 'wally@test.com', '$2y$12$O7xnEN7PqIE7Gc99zspXzOgAynO.CxkjFpHLp4ta1TqLia.G8HLZu', 'Wally', 'Wally', 'Wally', '2018-04-21 13:12:22'),
(6, 'willy@test.com', '$2y$12$I.4/NnFRmL6ZagzrlpzyAedLCYM48Z1jvkw/DfMbJe/nYdVZdq76C', 'Willy', 'Willy', 'Willy', '2018-04-21 13:24:40'),
(7, 'wilfred@wilfred.com', '$2y$12$M7L/4Bqpdnm7reBIAwDEoer43vPTH1wxc6TTbTfpJ1WE5TgOWm5VO', 'Wilfred', 'Wilfred', 'Wilfred', '2018-04-21 13:28:18'),
(8, 'anne@anne.com', '$2y$12$ZrjaoQEjHwzSxgRQrpxQK.INrspxp2PW15vvvu5opcrpSKNmymvve', 'Anne', 'Anne', 'Anne', '2018-04-21 13:29:06'),
(9, 'annelies@annelies.be', '$2y$12$ofc6dn265DxeA3Vol5/m4ue6GopWhY26rYdGZqgLe46OE7yGVzmhe', 'Annelies', 'Annelies', 'Annelies', '2018-04-21 13:29:42'),
(10, 'louwie@louwie.com', '$2y$12$IQ8hZM7nkxVpxVFNyeSSvudisPdmNR70jzozUORPNYLm5QrI5DKpm', 'Louwie', 'Louwie', 'Louwie', '2018-04-22 06:27:20'),
(11, 'balleke@balleke.com', '$2y$12$RBVw57Qi6YKe8f3gzNbakOf3foEpknZebH3P/5863lmfrl13EyjDS', 'Balleke', 'Balleke', 'Balleke', '2018-04-25 08:59:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
