-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 11 mars 2021 kl 22:01
-- Serverversion: 10.4.17-MariaDB
-- PHP-version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `blogg`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` varchar(300) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user` varchar(30) NOT NULL,
  `postsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `content`, `date`, `user`, `postsId`) VALUES
(24, 'Jag gillar den blå färgen', '2021-03-11 14:08:25', 'admin', 17),
(25, 'Vilka fler färger kommer skjortan att komma in?', '2021-03-11 14:17:06', 'admin', 19),
(26, 'Säljer ni kavajen också?', '2021-03-11 14:17:22', 'admin', 19),
(27, 'Kommer ni få in några nya damklockor?', '2021-03-11 15:04:14', 'admin', 20),
(28, 'Köpte den här lampan och absolut älskar den', '2021-03-11 15:05:03', 'user', 18),
(29, 'Vad är det för mått på krukan?', '2021-03-11 20:12:10', 'admin', 21),
(30, 'skriver en kommentar som jag ska radera', '2021-03-11 20:22:21', 'admin', 21);

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `message` text NOT NULL,
  `image` text DEFAULT NULL,
  `category` varchar(15) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `title`, `message`, `image`, `category`, `date`) VALUES
(17, 'Plånböcker', 'Höstens färger på plånböcker är här, vilken gillar ni mest?', '../images/leather-case-1986378_640.jpg', 'Accessoarer', '2021-03-11'),
(18, 'Lampa', 'Vi har tagit in en ny lampa från house doctor.', '../images/table-lamp-977069_640.jpg', 'Inredning', '2021-03-09'),
(19, 'Skjorta', 'Ny skjorta inne gjord på egyptisk bomull, kommer komma i flera färger ', '../images/model-2911330_640.jpg', 'Clothing', '2021-03-10'),
(20, 'Herrklocka', 'Ny klocka för våren', '../images/wrist-watch-2745278_640.png', 'Accessoarer', '2021-03-11'),
(21, 'Kruka', 'Vit kruka, man kan också köpa med plast växten', '../images/flower-2592070_640.jpg', 'Inredning', '2021-03-13');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(4, 'test1', 'test1', 'user'),
(6, 'krypt', '08ce21881b5b02cd988413697aec1272', 'user'),
(11, 'admin', 'da9f96989d7a964a6d98ea63b16f8352', 'admin'),
(12, 'login', 'login', 'user'),
(15, 'test', 'e990d148dab12eb054d64eeb13c371b2', 'admin'),
(18, 'user', '637b2f478420a8e1b86427ffc4dfa5e4', 'user'),
(20, 'testarinlogg', 'c7c01f7f7dac40c38ba4d5566fa47ed7', 'user');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
