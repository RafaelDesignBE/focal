-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 mei 2018 om 10:28
-- Serverversie: 10.1.30-MariaDB
-- PHP-versie: 7.2.2

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
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `comment`, `users_id`, `posts_id`) VALUES
(138, 'Nice screenshot!', 11, 46),
(139, 'More like Game of Malones', 13, 47),
(140, 'Cool reflections', 13, 46),
(141, 'Wanneer was dit?', 17, 46),
(142, 'Handy!', 18, 51),
(143, 'Nu is het wel een gym?', 18, 50),
(144, '#blessed', 18, 48);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `followers`
--

INSERT INTO `followers` (`id`, `u_id`, `f_id`) VALUES
(1, 13, 2),
(2, 13, 13),
(3, 15, 15),
(4, 15, 13),
(5, 16, 16),
(6, 13, 15),
(7, 13, 16),
(8, 17, 17),
(9, 18, 18),
(10, 17, 13),
(11, 17, 15),
(12, 17, 13),
(13, 17, 15),
(14, 13, 16),
(15, 18, 13),
(16, 18, 15),
(17, 18, 16),
(18, 18, 17),
(19, 13, 17),
(20, 13, 18);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `posts_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`id`, `type`, `posts_id`, `users_id`) VALUES
(1, 0, 20, 1),
(2, 1, 20, 2),
(4, 1, 20, 4),
(5, 0, 20, 5),
(6, 0, 20, 9),
(7, 0, 20, 10),
(8, 1, 10, 12),
(10, 10, 10, 5),
(826, 0, 21, 1),
(1292, 0, 29, 13),
(1295, 1, 16, 13),
(1296, 0, 18, 13),
(1327, 2, 20, 13),
(1344, 0, 19, 13),
(1361, 0, 21, 13),
(1365, 2, 35, 15),
(1366, 0, 32, 15),
(1367, 1, 31, 15),
(1371, 0, 38, 15),
(1372, 2, 21, 15),
(1373, 2, 47, 13),
(1374, 0, 46, 13),
(1376, 0, 48, 17),
(1377, 0, 47, 17),
(1378, 0, 49, 17),
(1379, 0, 46, 17),
(1380, 2, 47, 18),
(1381, 0, 46, 18),
(1382, 0, 48, 18),
(1383, 0, 49, 18),
(1384, 1, 50, 18),
(1386, 1, 51, 18),
(1387, 0, 52, 18),
(1388, 1, 52, 13),
(1389, 1, 51, 13),
(1390, 2, 50, 13),
(1391, 1, 49, 13);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `locations`
--

INSERT INTO `locations` (`id`, `place`, `latitude`, `longitude`, `city`, `region`, `country`) VALUES
(6, 'Antwerpen,Antwerpen,Belgium', '51.20376950', '4.41126370', 'Antwerpen', 'Antwerpen', 'Belgium'),
(7, '', '51.20376950', '4.41126370', '', '', ''),
(8, 'Kapelle-op-den-Bos,Vlaams-Brabant,Belgium', '51.01666820', '4.34895060', 'Kapelle-op-den-Bos', 'Vlaams-Brabant', 'Belgium'),
(9, 'Kapelle-op-den-Bos,Vlaams-Brabant,Belgium', '51.01668100', '4.34909830', 'Kapelle-op-den-Bos', 'Vlaams-Brabant', 'Belgium'),
(10, 'Kapelle-op-den-Bos,Vlaams-Brabant,Belgium', '51.01668100', '4.34909130', 'Kapelle-op-den-Bos', 'Vlaams-Brabant', 'Belgium');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `thmb_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL,
  `marked` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `tags`, `photo_url`, `title`, `categories_id`, `users_id`, `thmb_url`, `location_id`, `marked`, `deleted`) VALUES
(46, '2018-05-11 22:14:14', 'cleopatra, egypt', 'uploads/5953a38b2c2b14cd7832642739ec8550.jpg', 'Cleopatra', 0, 15, 'uploads/5953a38b2c2b14cd7832642739ec8550_thmb.jpg', 6, '', 0),
(47, '2018-05-11 22:49:02', 'post, throne, post malone', 'uploads/9bbe58c872d0cf8c4744136a04931b5b.jpg', 'Post on the Throne', 0, 16, 'uploads/9bbe58c872d0cf8c4744136a04931b5b_thmb.jpg', 6, '', 0),
(48, '2018-05-11 22:52:23', 'blessed, typography, text', 'uploads/0aee0bbe5efc58460cca7758be67e941.png', 'Blessed', 0, 13, 'uploads/0aee0bbe5efc58460cca7758be67e941_thmb.jpg', 7, '', 0),
(49, '2018-05-11 22:55:49', 'wolf, vector, howling, moon', 'uploads/3b07f0689e735fb13e93817b7fe5289f.png', 'Howling Wolf', 0, 13, 'uploads/3b07f0689e735fb13e93817b7fe5289f_thmb.jpg', 6, '', 0),
(50, '2018-05-11 23:21:01', 'gym, creativity gym', 'uploads/15b96be225151b2be7d7032cd95aad52.jpg', 'This is not a gym', 0, 17, 'uploads/15b96be225151b2be7d7032cd95aad52_thmb.jpg', 8, '', 0),
(51, '2018-05-11 23:21:39', 'devil, hand, fire', 'uploads/7d602689febab0ce83f82b05cddc8aaf.png', 'Devil\'s Hand', 0, 17, 'uploads/7d602689febab0ce83f82b05cddc8aaf_thmb.jpg', 9, '', 0),
(52, '2018-05-11 23:29:55', 'woman, blinds', 'uploads/04cf35dd5c17718ac84b7c894b4f303c.jpg', 'In front of blinds', 0, 18, 'uploads/04cf35dd5c17718ac84b7c894b4f303c_thmb.jpg', 10, '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
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
-- Gegevens worden geëxporteerd voor tabel `users`
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
(11, 'balleke@balleke.com', '$2y$12$RBVw57Qi6YKe8f3gzNbakOf3foEpknZebH3P/5863lmfrl13EyjDS', 'TomPeeters', 'Tom Peeters', 'Tom Peeters', '2018-05-11 23:20:05'),
(12, 'scdftgryhuj@dscfdgh.com', '$2y$12$RYJSVDUeUYpUu3kvVFc35ubzEibYvu07KKujx/g1f.2OLL3SmO9ii', 'RafaelDesign', 'sdcfrtghyju', 'dfghj', '2018-04-25 09:45:25'),
(13, 'contact@rafaeldesign.be', '$2y$12$uP0CDsjLkUWW7bNKketJieHI//Uc3CCafF8e/A2NTNeSb2PzpYVpC', 'RafaelDesign', 'Rafael', 'Fernandez', '2018-04-25 16:15:32'),
(14, 'contactr@rafaeldesign.be', '$2y$12$VaU6yeMK7XVJ.rk3fUYnB.Y5x9RTd8o3EwUpBFMqvHXkdRRV8r0fK', '&lt;h1&gt;lol&lt;/h1&gt;', 'vgivir', 'TJGITGJI', '2018-04-26 11:26:04'),
(15, 'ecoscanr@rafaeldesign.be', '$2y$12$PLR620QpLEBjkSlOt/h0t.vnb1zE1PjGmseGmg9Ucpzvvwsoa8S.K', 'Gamer22', 'Rafael', 'Fernandez', '2018-05-11 22:45:22'),
(16, 'memelord@example.com', '$2y$12$AAOSJ/5ZJ/z.E5ijkcu5kua84nNjDnUVh2z9osIQ14PY4/q.BuuG6', 'MemeLord', 'Meme', 'Lord', '2018-05-11 22:46:49'),
(17, 'materofarts@example.com', '$2y$12$5VPoqrIfJwRwIYzQKuVpx.14y20aPVYIKJv8VAajsSo7giz/viOMO', 'MasterOfArts', 'Master', 'Of Arts', '2018-05-11 23:01:32'),
(18, 'amber@example.com', '$2y$12$p8rq1CyENxBTYX3rIc5BS.1u/aZkN10VRkrrFUjYg3YkOdFm4.z6y', 'Amber', 'Amber', 'Janssens', '2018-05-11 23:24:15');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT voor een tabel `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1392;

--
-- AUTO_INCREMENT voor een tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
