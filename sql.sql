-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2010 at 12:59 AM
-- Server version: 5.0.75
-- PHP Version: 5.2.6-3ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `cmsw`
--

-- --------------------------------------------------------

--
-- Table structure for table `alias`
--

DROP TABLE IF EXISTS `alias`;
CREATE TABLE IF NOT EXISTS `alias` (
  `id` int(11) NOT NULL auto_increment,
  `alias` varchar(200) NOT NULL,
  `pageId` int(200) NOT NULL,
  `default` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `alias`
--

INSERT INTO `alias` (`id`, `alias`, `pageId`, `default`) VALUES
(1, '/homepage', 1, 0),
(2, '/index', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL auto_increment,
  `class` varchar(200) NOT NULL,
  `active` int(11) NOT NULL,
  `page` varchar(200) NOT NULL COMMENT 'page slug',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `modules`
--


-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL auto_increment,
  `pageName` varchar(200) NOT NULL,
  `parent` int(11) NOT NULL default '0',
  `locked` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `pageName`, `parent`, `locked`) VALUES
(1, 'Home', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL auto_increment,
  `websiteName` varchar(200) NOT NULL,
  `slogan` varchar(200) NOT NULL,
  `uriFormat` varchar(5) NOT NULL COMMENT '.html, /, _, ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `websiteName`, `slogan`, `uriFormat`) VALUES
(1, 'Solow-Projects', 'Some crappy cms system', '/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `role`) VALUES
(1, 'solow', '6f15ad9ad4923f7946fe633f5d217ba11f8c70b1', 'as723SDw3', 'mathematica@live.nl', 'Admin');

