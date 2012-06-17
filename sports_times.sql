-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2012 at 06:01 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sports_times`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE IF NOT EXISTS `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `contact_name` varchar(200) NOT NULL,
  `contact_type` varchar(100) NOT NULL,
  `contact_info` varchar(200) NOT NULL,
  `time_of_alert` int(11) NOT NULL,
  `time_diff_value` int(11) NOT NULL,
  `time_diff_unit` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sport` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `teams` varchar(200) NOT NULL,
  `match_name` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `country` varchar(200) NOT NULL,
  `timezone` varchar(200) NOT NULL,
  `timezone_abbr` varchar(10) NOT NULL,
  `date_time` int(11) NOT NULL,
  `other` varchar(1000) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `sport`, `category`, `teams`, `match_name`, `location`, `country`, `timezone`, `timezone_abbr`, `date_time`, `other`, `date_updated`) VALUES
(1, 'soccer', 'euro 2012', 'czech vs poland', 'euro 2012 match 17', 'WrocÅ‚aw, Poland', 'Poland', 'Europe/Warsaw', 'CEST', 1339872300, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-17-czech-vs-poland-tickets-municipal-stadium-wroclaw-poland-june-16-845pm.html', '2012-06-17 03:31:53'),
(2, 'soccer', 'euro 2012', 'greece vs russia', 'euro 2012 match 18', 'Stadion Narodowy, 1, 03-001 Aleja KsiÄ™cia JÃ³zefa Poniatowskiego, Mazowieckie', 'Poland', 'Europe/Warsaw', 'CEST', 1339872300, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-18-greece-vs-russia-tickets-national-stadium-june-16-845pm.html', '2012-06-17 03:31:54'),
(3, 'soccer', 'euro 2012', 'portugal vs netherlands', 'euro 2012 match 19', 'Metalist stadium, Kharkiv, Kharkivs''ka oblast, Ukraine, 61000', 'Ukraine', 'Europe/Kiev', 'EEST', 1339955100, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-19-portugal-vs-netherlands-tickets-metalist-stadium-ukraine-june-17-845pm.html', '2012-06-17 03:31:54'),
(4, 'soccer', 'euro 2012', 'denmark vs germany', 'euro 2012 match 20', 'L''viv, L''vivs''ka oblast, Ukraine, 79000', 'Ukraine', 'Europe/Kiev', 'EEST', 1339955100, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-20-denmark-vs-germany-ticketsarena-lviv-ukraine-june-17-845pm.html', '2012-06-17 03:31:55'),
(5, 'soccer', 'euro 2012', 'croatia vs spain', 'euro 2012 match 21', 'GdaÅ„sk, Poland', 'Poland', 'Europe/Warsaw', 'CEST', 1340045100, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-21-croatia-vs-spain-tickets-municipal-stadium-gdansk-poland-june-18-845pm.html', '2012-06-17 03:31:55'),
(6, 'soccer', 'euro 2012', 'italy vs ireland', 'euro 2012 match 22', 'PoznaÅ„, Poland', 'Poland', 'Europe/Warsaw', 'CEST', 1340045100, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-22-italy-vs-ireland-tickets-municipal-stadium-poznan-poland-june-18-845pm.html', '2012-06-17 03:31:56'),
(7, 'soccer', 'euro 2012', 'england vs ukraine', 'euro 2012 match 23', 'Donbas Arena stadium, Chelyuskintsiv St, 189, Donets''k, Donets''ka oblast, Ukraine, 83000', 'Ukraine', 'Europe/Kiev', 'EEST', 1340127900, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-23-england-vs-ukraine-tickets-donbass-arena-ukraine-june-19-845pm.html', '2012-06-17 03:31:56'),
(8, 'soccer', 'euro 2012', 'sweden vs france', 'euro 2012 match 24', 'Kiev, Kyiv city, Ukraine, 02000', 'Ukraine', 'Europe/Kiev', 'EEST', 1340127900, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-24-sweden-vs-france-ticketsolympic-stadium-kyiv-ukraine-june-19-845pm.html', '2012-06-17 03:31:57'),
(9, 'soccer', 'euro 2012', 'quarterfinal 1 (wa vs rb)', 'euro 2012 match 25', 'Stadion Narodowy, 1, 03-001 Aleja KsiÄ™cia JÃ³zefa Poniatowskiego, Mazowieckie', 'Poland', 'Europe/Warsaw', 'CEST', 1340304300, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-25-quarterfinal-1-(wa-vs-rb)-tickets-national-stadium-june-21-845pm.html', '2012-06-17 03:31:57'),
(10, 'soccer', 'euro 2012', 'quarterfinal 2 (wb vs ra)', 'euro 2012 match 26', 'GdaÅ„sk, Poland', 'Poland', 'Europe/Warsaw', 'CEST', 1340390700, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-26-quarterfinal-2-(wb-vs-ra)-tickets-municipal-stadium-gdansk-poland-june-22-845pm.html', '2012-06-17 03:31:58'),
(11, 'soccer', 'euro 2012', 'quarterfinal 3 (wc vs rd)', 'euro 2012 match 27', 'Donbas Arena stadium, Chelyuskintsiv St, 189, Donets''k, Donets''ka oblast, Ukraine, 83000', 'Ukraine', 'Europe/Kiev', 'EEST', 1340473500, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-27-quarterfinal-3-(wc-vs-rd)-tickets-donbass-arena-ukraine-june-23-845pm.html', '2012-06-17 03:31:58'),
(12, 'soccer', 'euro 2012', 'quarterfinal 4 (wd vs rc)', 'euro 2012 match 28', 'Kiev, Kyiv city, Ukraine, 02000', 'Ukraine', 'Europe/Kiev', 'EEST', 1340559900, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-28-quarterfinal-4-(wd-vs-rc)-ticketsolympic-stadium-kyiv-ukraine-june-24-845pm.html', '2012-06-17 03:31:59'),
(13, 'soccer', 'euro 2012', 'semifinal 1 (w25 vs w27)', 'euro 2012 match 29', 'Donbas Arena stadium, Chelyuskintsiv St, 189, Donets''k, Donets''ka oblast, Ukraine, 83000', 'Ukraine', 'Europe/Kiev', 'EEST', 1340819100, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-29-semifinal-1-(w25-vs-w27)-tickets-donbass-arena-ukraine-june-27-845pm.html', '2012-06-17 03:31:59'),
(14, 'soccer', 'euro 2012', 'semifinal 2 (w26 vs w28)', 'euro 2012 match 30', 'Stadion Narodowy, 1, 03-001 Aleja KsiÄ™cia JÃ³zefa Poniatowskiego, Mazowieckie', 'Poland', 'Europe/Warsaw', 'CEST', 1340909100, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-30-semifinal-2-(w26-vs-w28)-ticketsnational-stadium-june-28-845pm.html', '2012-06-17 03:32:00'),
(15, 'soccer', 'euro 2012', 'championship game', 'euro 2012 final', 'Kiev, Kyiv city, Ukraine, 02000', 'Ukraine', 'Europe/Kiev', 'EEST', 1341164700, 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-final-championship-game-ticketsolympic-stadium-kyiv-ukraine-july-1-845pm.html', '2012-06-17 03:32:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
