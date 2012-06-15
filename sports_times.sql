-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2012 at 10:58 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
  `time_of_alert` datetime NOT NULL,
  `time_diff_value` int(11) NOT NULL,
  `time_diff_unit` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `alerts`
--


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
  `date_time` datetime NOT NULL,
  `other` varchar(1000) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `sport`, `category`, `teams`, `match_name`, `location`, `date_time`, `other`, `date_updated`) VALUES
(1, 'soccer', 'euro 2012', 'spain vs ireland', 'euro 2012 match 14', ' Municipal Stadium Gdansk - Poland', '2012-06-14 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-14-spain-vs-ireland-tickets-municipal-stadium-gdansk-poland-june-14-845pm.html', '2012-06-15 00:10:46'),
(2, 'soccer', 'euro 2012', 'ukraine vs france', 'euro 2012 match 16', ' DONBASS ARENA - Ukraine', '2012-06-15 18:00:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-16-ukraine-vs-france-tickets-donbass-arena-ukraine-june-15-600pm.html', '2012-06-15 00:10:46'),
(3, 'soccer', 'euro 2012', 'sweden vs england', 'euro 2012 match 15', ' Olympic Stadium Kyiv - Ukraine', '2012-06-15 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-15-sweden-vs-england-ticketsolympic-stadium-kyiv-ukraine-june-15-845pm.html', '2012-06-15 00:10:46'),
(4, 'soccer', 'euro 2012', 'czech vs poland', 'euro 2012 match 17', ' Municipal Stadium Wroclaw - Poland', '2012-06-16 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-17-czech-vs-poland-tickets-municipal-stadium-wroclaw-poland-june-16-845pm.html', '2012-06-15 00:10:47'),
(5, 'soccer', 'euro 2012', 'greece vs russia', 'euro 2012 match 18', ' National Stadium', '2012-06-16 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-18-greece-vs-russia-tickets-national-stadium-june-16-845pm.html', '2012-06-15 00:10:47'),
(6, 'soccer', 'euro 2012', 'portugal vs netherlands', 'euro 2012 match 19', ' METALIST STADIUM - Ukraine', '2012-06-17 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-19-portugal-vs-netherlands-tickets-metalist-stadium-ukraine-june-17-845pm.html', '2012-06-15 00:10:47'),
(7, 'soccer', 'euro 2012', 'denmark vs germany', 'euro 2012 match 20', ' Arena Lviv - Ukraine', '2012-06-17 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-20-denmark-vs-germany-ticketsarena-lviv-ukraine-june-17-845pm.html', '2012-06-15 00:10:47'),
(8, 'soccer', 'euro 2012', 'croatia vs spain', 'euro 2012 match 21', ' Municipal Stadium Gdansk - Poland', '2012-06-18 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-21-croatia-vs-spain-tickets-municipal-stadium-gdansk-poland-june-18-845pm.html', '2012-06-15 00:10:47'),
(9, 'soccer', 'euro 2012', 'italy vs ireland', 'euro 2012 match 22', ' Municipal Stadium Poznan - Poland', '2012-06-18 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-22-italy-vs-ireland-tickets-municipal-stadium-poznan-poland-june-18-845pm.html', '2012-06-15 00:10:47'),
(10, 'soccer', 'euro 2012', 'england vs ukraine', 'euro 2012 match 23', ' DONBASS ARENA - Ukraine', '2012-06-19 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-23-england-vs-ukraine-tickets-donbass-arena-ukraine-june-19-845pm.html', '2012-06-15 00:10:47'),
(11, 'soccer', 'euro 2012', 'sweden vs france', 'euro 2012 match 24', ' Olympic Stadium Kyiv - Ukraine', '2012-06-19 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-24-sweden-vs-france-ticketsolympic-stadium-kyiv-ukraine-june-19-845pm.html', '2012-06-15 00:10:47'),
(12, 'soccer', 'euro 2012', 'quarterfinal 1 (wa vs rb)', 'euro 2012 match 25', ' National Stadium', '2012-06-21 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-25-quarterfinal-1-(wa-vs-rb)-tickets-national-stadium-june-21-845pm.html', '2012-06-15 00:10:47'),
(13, 'soccer', 'euro 2012', 'quarterfinal 2 (wb vs ra)', 'euro 2012 match 26', ' Municipal Stadium Gdansk - Poland', '2012-06-22 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-26-quarterfinal-2-(wb-vs-ra)-tickets-municipal-stadium-gdansk-poland-june-22-845pm.html', '2012-06-15 00:10:47'),
(14, 'soccer', 'euro 2012', 'quarterfinal 3 (wc vs rd)', 'euro 2012 match 27', ' DONBASS ARENA - Ukraine', '2012-06-23 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-27-quarterfinal-3-(wc-vs-rd)-tickets-donbass-arena-ukraine-june-23-845pm.html', '2012-06-15 00:10:47'),
(15, 'soccer', 'euro 2012', 'quarterfinal 4 (wd vs rc)', 'euro 2012 match 28', ' Olympic Stadium Kyiv - Ukraine', '2012-06-24 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-28-quarterfinal-4-(wd-vs-rc)-ticketsolympic-stadium-kyiv-ukraine-june-24-845pm.html', '2012-06-15 00:10:47'),
(16, 'soccer', 'euro 2012', 'semifinal 1 (w25 vs w27)', 'euro 2012 match 29', ' DONBASS ARENA - Ukraine', '2012-06-27 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-29-semifinal-1-(w25-vs-w27)-tickets-donbass-arena-ukraine-june-27-845pm.html', '2012-06-15 00:10:47'),
(17, 'soccer', 'euro 2012', 'semifinal 2 (w26 vs w28)', 'euro 2012 match 30', ' National Stadium', '2012-06-28 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-30-semifinal-2-(w26-vs-w28)-ticketsnational-stadium-june-28-845pm.html', '2012-06-15 00:10:47'),
(18, 'soccer', 'euro 2012', 'championship game', 'euro 2012 final', ' Olympic Stadium Kyiv - Ukraine', '2012-07-01 20:45:00', 'http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-final-championship-game-ticketsolympic-stadium-kyiv-ukraine-july-1-845pm.html', '2012-06-15 00:10:47');
