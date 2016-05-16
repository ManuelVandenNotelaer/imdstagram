-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 mei 2016 om 14:18
-- Serverversie: 5.6.24
-- PHP-versie: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imdstagram`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` varchar(9999) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `post_id`, `text`) VALUES
(19, 29, 193, 'Test comment'),
(20, 29, 193, 'Wauw, mooie berg. '),
(21, 29, 191, 'Smakelijk!');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hashtag`
--

CREATE TABLE IF NOT EXISTS `hashtag` (
  `id` int(11) NOT NULL,
  `hashtag` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`id`, `postid`, `userid`) VALUES
(161, 193, 29),
(162, 191, 29),
(163, 188, 29),
(164, 193, 30);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `post`
--

INSERT INTO `post` (`id`, `username`, `photo`, `description`, `upload_date`, `location`) VALUES
(167, 'Manuel Van den Notelaer', 'images/posts/2920160516135743', 'Brood gekocht in de winkel!', '2016-05-16 11:57:43', 'test'),
(172, 'Manuel Van den Notelaer', 'images/posts/2920160516140040', 'Foto in Wenen #zon', '2016-05-16 12:00:40', 'test'),
(173, 'Manuel Van den Notelaer', 'images/posts/2920160516140058', 'Kamperen op reis', '2016-05-16 12:00:58', 'test'),
(174, 'Manuel Van den Notelaer', 'images/posts/2920160516140112', 'In de auto #roadtrip', '2016-05-16 12:01:12', 'test'),
(175, 'Manuel Van den Notelaer', 'images/posts/2920160516140134', 'Test test test', '2016-05-16 12:01:34', 'test'),
(176, 'Manuel Van den Notelaer', 'images/posts/2920160516140219', 'On the road', '2016-05-16 12:02:19', 'test'),
(177, 'Manuel Van den Notelaer', 'images/posts/2920160516140236', 'Mooie natuur', '2016-05-16 12:02:36', 'test'),
(178, 'Manuel Van den Notelaer', 'images/posts/2920160516140303', 'Bergen enzo test test', '2016-05-16 12:03:03', 'test'),
(179, 'Manuel Van den Notelaer', 'images/posts/2920160516140318', '2e camping spot', '2016-05-16 12:03:18', 'test'),
(180, 'Manuel Van den Notelaer', 'images/posts/2920160516140335', 'Vuur #fire', '2016-05-16 12:03:35', 'test'),
(181, 'Manuel Van den Notelaer', 'images/posts/2920160516140408', 'Optreden in Duitsland #germany', '2016-05-16 12:04:08', 'test'),
(182, 'Manuel Van den Notelaer', 'images/posts/2920160516140444', 'Foto gisteren avond la la la la la', '2016-05-16 12:04:44', 'test'),
(183, 'Manuel Van den Notelaer', 'images/posts/2920160516140504', 'Samen bla bla', '2016-05-16 12:05:04', 'test'),
(184, 'Manuel Van den Notelaer', 'images/posts/2920160516140524', 'Muziek band live spelen', '2016-05-16 12:05:24', 'test'),
(185, 'Manuel Van den Notelaer', 'images/posts/2920160516140551', 'Repetitie 4 jaar geleden', '2016-05-16 12:05:51', 'test'),
(186, 'Manuel Van den Notelaer', 'images/posts/2920160516140618', 'Groep mensen enzo', '2016-05-16 12:06:18', 'test'),
(187, 'Manuel Van den Notelaer', 'images/posts/2920160516140643', 'test test test leuke avond', '2016-05-16 12:06:43', 'test'),
(188, 'Manuel Van den Notelaer', 'images/posts/2920160516140658', 'Boterham wazige foto test test', '2016-05-16 12:06:58', 'test'),
(189, 'Manuel Van den Notelaer', 'images/posts/2920160516140729', 'Foto in een cafÃ©etjes, dit is een langere description dan zie je ook meteen hoe dit eruit zou zien want niet elke description is even kort.', '2016-05-16 12:07:29', 'test'),
(190, 'Manuel Van den Notelaer', 'images/posts/2920160516140803', 'Deze foto is wat donker', '2016-05-16 12:08:03', 'test'),
(191, 'Manuel Van den Notelaer', 'images/posts/2920160516140813', 'Brood kopen in de winkel\r\n', '2016-05-16 12:08:13', 'test'),
(192, 'Manuel Van den Notelaer', 'images/posts/2920160516140848', 'Tenten in Oostenrijk', '2016-05-16 12:08:48', 'test'),
(193, 'Manuel Van den Notelaer', 'images/posts/2920160516140858', 'Mooie foto enzo', '2016-05-16 12:08:58', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `profile_pic`, `account_type`) VALUES
(29, 'Manuel Van den Notelaer', 'test@test.com', 'test234', '$2y$12$MMLzGP8K4TrVen/cNyUqdeWNTJYjbjWfHiaDbOudbeu5Sa7L1/DSu', 'images/profielfotos/test@test.com_10382622_10152542177531814_1381983659804818523_n.jpg', 'private'),
(30, 'Tim Vantol', 'test2@test.com', 'Lalalalalal', '$2y$12$mR2UcJcxRQGxTWTcibVOZufW2Am4DBqdUs4ccIWfs.b1K/1E53J3y', 'images/profielfotos/test2@test.com_10168050_1703235936632234_6390722870769493688_n.jpg', 'private');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `hashtag`
--
ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT voor een tabel `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT voor een tabel `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT voor een tabel `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
