-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2015 at 03:46 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cls`
--
CREATE DATABASE IF NOT EXISTS `cls` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cls`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(17) NOT NULL,
  `password_hash` varchar(20) NOT NULL,
  `salt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `checkedout`
--

CREATE TABLE IF NOT EXISTS `checkedout` (
  `patron_id` int(10) unsigned NOT NULL,
  `hardcopy_barcode` int(10) unsigned NOT NULL,
  `due_date` date NOT NULL,
  `renew_count` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contribution`
--

CREATE TABLE IF NOT EXISTS `contribution` (
  `mediaitem_id` int(10) unsigned NOT NULL,
  `contributor_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contribution`
--

INSERT INTO `contribution` (`mediaitem_id`, `contributor_id`, `role_id`) VALUES
(149, 32, 1),
(150, 33, 1),
(151, 34, 1),
(151, 35, 1),
(153, 36, 1),
(155, 37, 1),
(156, 38, 1),
(173, 38, 1),
(168, 39, 1),
(176, 39, 1),
(169, 40, 1),
(170, 41, 1),
(171, 42, 1),
(172, 43, 1),
(174, 44, 1),
(175, 45, 1),
(177, 46, 1),
(178, 47, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contributor`
--

CREATE TABLE IF NOT EXISTS `contributor` (
`id` int(10) unsigned NOT NULL,
  `first` varchar(35) DEFAULT NULL,
  `last` varchar(35) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `contributor`
--

INSERT INTO `contributor` (`id`, `first`, `last`) VALUES
(32, '', 'The Institute of Stuff'),
(41, 'Audrey', 'Niffenegger'),
(33, 'Charles', 'Dickens'),
(39, 'Cormac', 'McCarthy'),
(38, 'Dan', 'Brown'),
(44, 'Elizabeth', 'Gilbert'),
(47, 'Eric', 'Schlosser'),
(28, 'J. K.', 'Rowling'),
(34, 'Jack', 'Canfield'),
(36, 'John', 'Richardson'),
(42, 'Khaled', 'Hosseini'),
(46, 'Margaret', 'Atwood'),
(35, 'Mark Victor', 'Hansen'),
(37, 'Markus', 'Zusak'),
(43, 'Rick', 'Riordan'),
(45, 'Steven D.', 'Levitt'),
(40, 'Stieg', 'Larsson');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE IF NOT EXISTS `fine` (
  `patron_id` int(10) unsigned NOT NULL,
  `hardcopy_barcode` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL COMMENT 'stored in # of pennies',
  `reason` enum('Damage','Lost','Overdue','Other') NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hardcopy`
--

CREATE TABLE IF NOT EXISTS `hardcopy` (
  `barcode` int(10) unsigned NOT NULL,
  `mediaitem_id` int(10) unsigned NOT NULL,
  `copy_no` tinyint(3) unsigned NOT NULL,
  `call_no` varchar(20) NOT NULL,
  `status` enum('Damaged/In Repair','Lost','In Transit','Out of Circulation','Normal') NOT NULL DEFAULT 'Normal',
  `checkout_duration` tinyint(3) unsigned NOT NULL,
  `renew_limit` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hardcopy`
--

INSERT INTO `hardcopy` (`barcode`, `mediaitem_id`, `copy_no`, `call_no`, `status`, `checkout_duration`, `renew_limit`) VALUES
(11111, 145, 1, '131415', 'Normal', 21, 1),
(111111, 150, 1, '32', 'Normal', 21, 3),
(111112, 151, 1, '33', 'Normal', 21, 3),
(111114, 153, 1, '34', 'Normal', 21, 3),
(111115, 155, 1, '35', 'Normal', 21, 3),
(111116, 156, 1, '37', 'Normal', 21, 3),
(111117, 168, 1, '38', 'Normal', 21, 3),
(111118, 169, 1, '38', 'Normal', 21, 3),
(111119, 170, 1, '39', 'Normal', 21, 3),
(111120, 171, 1, '40', 'Normal', 21, 3),
(111121, 172, 1, '41', 'Normal', 21, 3),
(111122, 173, 1, '42', 'Normal', 21, 3),
(111123, 174, 1, '43', 'Normal', 21, 3),
(111124, 175, 1, '44', 'Normal', 21, 3),
(111125, 176, 1, '45', 'Normal', 21, 3),
(111126, 177, 1, '46', 'Normal', 21, 3),
(111127, 178, 1, '47', 'Normal', 21, 3),
(132231, 149, 1, '131415', 'Normal', 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hold`
--

CREATE TABLE IF NOT EXISTS `hold` (
  `patron_id` int(10) unsigned NOT NULL,
  `mediaitem_id` int(10) unsigned NOT NULL,
  `time_placed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `itemtag`
--

CREATE TABLE IF NOT EXISTS `itemtag` (
  `tag_id` int(10) unsigned NOT NULL,
  `mediaitem_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemtag`
--

INSERT INTO `itemtag` (`tag_id`, `mediaitem_id`) VALUES
(73, 145),
(74, 145),
(75, 145),
(76, 145),
(77, 145),
(78, 145),
(79, 145),
(99, 149),
(100, 149),
(101, 149),
(102, 149),
(103, 149),
(104, 149),
(105, 149),
(106, 150),
(107, 150),
(108, 150),
(109, 150),
(110, 151),
(111, 151),
(112, 151),
(113, 151),
(114, 151),
(115, 151),
(116, 151),
(117, 151),
(75, 153),
(120, 153),
(121, 153),
(122, 153),
(123, 155),
(124, 155),
(125, 155),
(126, 155),
(127, 156),
(128, 156),
(129, 156),
(130, 156),
(131, 156),
(132, 168),
(133, 168),
(134, 168),
(135, 169),
(136, 169),
(137, 169),
(138, 169),
(139, 169),
(140, 170),
(141, 170),
(142, 170),
(143, 170),
(144, 170),
(145, 171),
(146, 171),
(147, 171),
(148, 171),
(124, 172),
(149, 172),
(150, 172),
(151, 172),
(130, 173),
(131, 173),
(152, 173),
(153, 173),
(154, 174),
(155, 174),
(156, 174),
(157, 174),
(158, 174),
(159, 175),
(160, 175),
(161, 175),
(162, 175),
(163, 175),
(164, 175),
(165, 175),
(166, 175),
(167, 175),
(168, 175),
(133, 176),
(134, 176),
(169, 176),
(170, 176),
(171, 176),
(172, 176),
(173, 177),
(174, 177),
(175, 177),
(176, 177),
(164, 178),
(177, 178),
(178, 178),
(179, 178),
(180, 178),
(181, 178),
(182, 178),
(183, 178),
(184, 178);

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE IF NOT EXISTS `librarian` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(17) NOT NULL,
  `password_hash` varchar(20) NOT NULL,
  `salt` int(11) NOT NULL,
  `check_in` tinyint(1) NOT NULL DEFAULT '0',
  `check_out` tinyint(1) NOT NULL DEFAULT '0',
  `add_book` tinyint(1) NOT NULL DEFAULT '0',
  `remove_book` tinyint(1) NOT NULL DEFAULT '0',
  `add_patron` tinyint(1) NOT NULL DEFAULT '0',
  `remove_patron` tinyint(1) NOT NULL DEFAULT '0',
  `manage_accounts` tinyint(1) NOT NULL DEFAULT '0',
  `pay_fines` tinyint(1) NOT NULL DEFAULT '0',
  `extend_due_date` tinyint(1) NOT NULL DEFAULT '0',
  `waive_fines` tinyint(1) NOT NULL DEFAULT '0',
  `edit_media_entry` tinyint(1) NOT NULL DEFAULT '0',
  `add_tag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`id`, `username`, `password_hash`, `salt`, `check_in`, `check_out`, `add_book`, `remove_book`, `add_patron`, `remove_patron`, `manage_accounts`, `pay_fines`, `extend_due_date`, `waive_fines`, `edit_media_entry`, `add_tag`) VALUES
(1, 'Tester', 'Hello World!', 5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mediaitem`
--

CREATE TABLE IF NOT EXISTS `mediaitem` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(350) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `year` smallint(6) DEFAULT NULL,
  `isbn` bigint(20) unsigned DEFAULT NULL,
  `media_type` enum('Book','DVD','VHS','CD','Cassette','Projected Medium','Posters and Art','Newspaper','Periodical','Musical Score','Software','Map') NOT NULL,
  `edition` tinyint(3) unsigned DEFAULT NULL,
  `volume` int(10) unsigned DEFAULT NULL,
  `issue_no` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=179 ;

--
-- Dumping data for table `mediaitem`
--

INSERT INTO `mediaitem` (`id`, `title`, `year`, `isbn`, `media_type`, `edition`, `volume`, `issue_no`) VALUES
(75, 'The Hunger Games', 2010, 24234256, 'Book', NULL, NULL, NULL),
(145, 'Harry Potter and the Sorcerer''s Stone', 1999, 131415, 'Book', 1, 1, NULL),
(149, 'The Journal of Highly Exciting Stuff and Things', 2008, 223322, 'Book', 2, 1, 404),
(150, 'A Christmas Carol', NULL, 7777, 'Book', 2, 1, 402),
(151, 'Chicken Soup for the Soul', NULL, 7778, 'Book', 2, 1, 402),
(153, 'The Sorcerer''s Apprentice', NULL, 7779, 'Book', NULL, NULL, NULL),
(155, 'The Book Thief', NULL, 7780, 'Book', NULL, NULL, NULL),
(156, ' The Da Vinci Code', NULL, 0, 'Book', NULL, NULL, NULL),
(168, ' The Road', NULL, 200000, 'Book', NULL, NULL, NULL),
(169, 'The Girl with the Dragon Tattoo', NULL, 200001, 'Book', NULL, NULL, NULL),
(170, 'The Time Traveler''s Wife', NULL, 200002, 'Book', NULL, NULL, NULL),
(171, 'The Kite Runner', NULL, 200003, 'Book', NULL, NULL, NULL),
(172, 'The Lightning Thief', NULL, 200004, 'Book', NULL, NULL, NULL),
(173, 'Angels & Demons', NULL, 200005, 'Book', NULL, NULL, NULL),
(174, 'Eat, Pray, Love', NULL, 200006, 'Book', NULL, NULL, NULL),
(175, 'Freakonomics: A Rogue Economist Explores the Hidden Side of Everything', NULL, 200007, 'Book', NULL, NULL, NULL),
(176, 'No Country for Old Men', NULL, 200008, 'Book', NULL, NULL, NULL),
(177, 'The Blind Assassin', NULL, 200009, 'Book', NULL, NULL, NULL),
(178, 'Fast Food Nation: The Dark Side of the All-American Meal', NULL, 200010, 'Book', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patron`
--

CREATE TABLE IF NOT EXISTS `patron` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(17) NOT NULL,
  `password_hash` varchar(20) NOT NULL,
  `salt` int(11) NOT NULL,
  `first` varchar(35) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `last` varchar(35) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `checkout_limit` smallint(6) NOT NULL,
  `renew_limit` tinyint(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `patron`
--

INSERT INTO `patron` (`id`, `username`, `password_hash`, `salt`, `first`, `last`, `email`, `phone`, `checkout_limit`, `renew_limit`) VALUES
(2, 'Someone', 'upthere', 2, 'Some', 'Guy', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(19, '0'),
(1, 'Author'),
(7, 'Director'),
(18, 'Producer');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` enum('title','subject','genre','language','contributor') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `type`) VALUES
(181, 'AllAmerican', 'title'),
(152, 'Angels', 'title'),
(120, 'Apprentice', 'title'),
(174, 'Assassin', 'title'),
(176, 'Atwood', 'contributor'),
(143, 'Audrey', 'contributor'),
(173, 'Blind', 'title'),
(123, 'Book', 'title'),
(131, 'Brown', 'contributor'),
(114, 'Canfield', 'contributor'),
(107, 'Carol', 'title'),
(108, 'Charles', 'contributor'),
(110, 'Chicken', 'title'),
(106, 'Christmas', 'title'),
(129, 'Code', 'title'),
(133, 'Cormac', 'contributor'),
(170, 'Country', 'title'),
(167, 'D', 'contributor'),
(127, 'Da', 'title'),
(130, 'Dan', 'contributor'),
(180, 'Dark', 'title'),
(153, 'Demons', 'title'),
(109, 'Dickens', 'contributor'),
(136, 'Dragon', 'title'),
(154, 'Eat', 'title'),
(161, 'Economist', 'title'),
(157, 'Elizabeth', 'contributor'),
(183, 'Eric', 'contributor'),
(165, 'Everything', 'title'),
(101, 'Exciting', 'title'),
(162, 'Explores', 'title'),
(177, 'Fast', 'title'),
(178, 'Food', 'title'),
(159, 'Freakonomics', 'title'),
(158, 'Gilbert', 'contributor'),
(135, 'Girl', 'title'),
(117, 'Hansen', 'contributor'),
(73, 'Harry', 'title'),
(163, 'Hidden', 'title'),
(100, 'Highly', 'title'),
(148, 'Hosseini', 'contributor'),
(104, 'Institute', 'contributor'),
(77, 'J', 'contributor'),
(113, 'Jack', 'contributor'),
(121, 'John', 'contributor'),
(99, 'Journal', 'title'),
(78, 'K', 'contributor'),
(147, 'Khaled', 'contributor'),
(145, 'Kite', 'title'),
(139, 'Larsson', 'contributor'),
(168, 'Levitt', 'contributor'),
(149, 'Lightning', 'title'),
(156, 'Love', 'title'),
(175, 'Margaret', 'contributor'),
(115, 'Mark', 'contributor'),
(125, 'Markus', 'contributor'),
(134, 'McCarthy', 'contributor'),
(182, 'Meal', 'title'),
(172, 'Men', 'title'),
(179, 'Nation', 'title'),
(144, 'Niffenegger', 'contributor'),
(169, 'No', 'title'),
(171, 'Old', 'title'),
(74, 'Potter', 'title'),
(155, 'Pray', 'title'),
(122, 'Richardson', 'contributor'),
(150, 'Rick', 'contributor'),
(151, 'Riordan', 'contributor'),
(132, 'Road', 'title'),
(160, 'Rogue', 'title'),
(79, 'Rowling', 'contributor'),
(146, 'Runner', 'title'),
(184, 'Schlosser', 'contributor'),
(164, 'Side', 'title'),
(75, 'Sorcerers', 'title'),
(112, 'Soul', 'title'),
(111, 'Soup', 'title'),
(166, 'Steven', 'contributor'),
(138, 'Stieg', 'contributor'),
(76, 'Stone', 'title'),
(102, 'Stuff', 'title'),
(105, 'Stuff', 'contributor'),
(137, 'Tattoo', 'title'),
(124, 'Thief', 'title'),
(103, 'Things', 'title'),
(140, 'Time', 'title'),
(141, 'Travelers', 'title'),
(116, 'Victor', 'contributor'),
(128, 'Vinci', 'title'),
(142, 'Wife', 'title'),
(126, 'Zusak', 'contributor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `checkedout`
--
ALTER TABLE `checkedout`
 ADD PRIMARY KEY (`patron_id`,`hardcopy_barcode`), ADD KEY `hardcopy_barcode` (`hardcopy_barcode`);

--
-- Indexes for table `contribution`
--
ALTER TABLE `contribution`
 ADD PRIMARY KEY (`mediaitem_id`,`contributor_id`,`role_id`), ADD KEY `contributor_id` (`contributor_id`), ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `contributor`
--
ALTER TABLE `contributor`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `first` (`first`,`last`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
 ADD PRIMARY KEY (`patron_id`,`hardcopy_barcode`), ADD KEY `hardcopy_barcode` (`hardcopy_barcode`);

--
-- Indexes for table `hardcopy`
--
ALTER TABLE `hardcopy`
 ADD PRIMARY KEY (`barcode`), ADD UNIQUE KEY `unique_index` (`mediaitem_id`,`copy_no`);

--
-- Indexes for table `hold`
--
ALTER TABLE `hold`
 ADD PRIMARY KEY (`patron_id`,`mediaitem_id`), ADD KEY `mediaitem_id` (`mediaitem_id`);

--
-- Indexes for table `itemtag`
--
ALTER TABLE `itemtag`
 ADD PRIMARY KEY (`tag_id`,`mediaitem_id`), ADD KEY `mediaitem_id` (`mediaitem_id`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `mediaitem`
--
ALTER TABLE `mediaitem`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `patron`
--
ALTER TABLE `patron`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`,`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contributor`
--
ALTER TABLE `contributor`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mediaitem`
--
ALTER TABLE `mediaitem`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=179;
--
-- AUTO_INCREMENT for table `patron`
--
ALTER TABLE `patron`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=185;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkedout`
--
ALTER TABLE `checkedout`
ADD CONSTRAINT `checkedout_ibfk_1` FOREIGN KEY (`patron_id`) REFERENCES `patron` (`id`),
ADD CONSTRAINT `checkedout_ibfk_2` FOREIGN KEY (`hardcopy_barcode`) REFERENCES `hardcopy` (`barcode`);

--
-- Constraints for table `contribution`
--
ALTER TABLE `contribution`
ADD CONSTRAINT `contribution_ibfk_2` FOREIGN KEY (`contributor_id`) REFERENCES `contributor` (`id`),
ADD CONSTRAINT `contribution_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
ADD CONSTRAINT `contribution_ibfk_4` FOREIGN KEY (`mediaitem_id`) REFERENCES `mediaitem` (`id`);

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
ADD CONSTRAINT `fine_ibfk_1` FOREIGN KEY (`patron_id`) REFERENCES `patron` (`id`),
ADD CONSTRAINT `fine_ibfk_2` FOREIGN KEY (`hardcopy_barcode`) REFERENCES `hardcopy` (`barcode`);

--
-- Constraints for table `hardcopy`
--
ALTER TABLE `hardcopy`
ADD CONSTRAINT `hardcopy_ibfk_1` FOREIGN KEY (`mediaitem_id`) REFERENCES `mediaitem` (`id`);

--
-- Constraints for table `hold`
--
ALTER TABLE `hold`
ADD CONSTRAINT `hold_ibfk_1` FOREIGN KEY (`patron_id`) REFERENCES `patron` (`id`),
ADD CONSTRAINT `hold_ibfk_2` FOREIGN KEY (`mediaitem_id`) REFERENCES `mediaitem` (`id`);

--
-- Constraints for table `itemtag`
--
ALTER TABLE `itemtag`
ADD CONSTRAINT `itemtag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`),
ADD CONSTRAINT `itemtag_ibfk_2` FOREIGN KEY (`mediaitem_id`) REFERENCES `mediaitem` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
