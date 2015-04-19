-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2015 at 02:49 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password_hash`, `salt`) VALUES
(3, 'admin1', 'password', 1),
(5, 'admin2', 'password', 1),
(6, 'admin3', 'password', 1);

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
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contributor`
--

CREATE TABLE IF NOT EXISTS `contributor` (
`id` int(10) unsigned NOT NULL,
  `first` varchar(35) DEFAULT NULL,
  `last` varchar(35) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contributor`
--

INSERT INTO `contributor` (`id`, `first`, `last`) VALUES
(1, 'Jesus', 'Christ');

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
(1, 1, 1, '', 'Lost', 0, 1);

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
(1, 1),
(2, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `mediaitem`
--

INSERT INTO `mediaitem` (`id`, `title`, `year`, `isbn`, `media_type`, `edition`, `volume`, `issue_no`) VALUES
(1, 'The Book of Mormon', 1900, 0, 'Book', NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `patron`
--

INSERT INTO `patron` (`id`, `username`, `password_hash`, `salt`, `first`, `last`, `email`, `phone`, `checkout_limit`, `renew_limit`) VALUES
(1, 'Obama', '1337', 0, 'Barrack', 'Obama', NULL, NULL, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'Author');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` enum('title','subject','genre','language') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `type`) VALUES
(1, 'Religous', 'subject'),
(2, 'Mormon', 'subject');

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
 ADD PRIMARY KEY (`id`);

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
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contributor`
--
ALTER TABLE `contributor`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mediaitem`
--
ALTER TABLE `mediaitem`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `patron`
--
ALTER TABLE `patron`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
