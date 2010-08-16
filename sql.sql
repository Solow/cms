-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2010 at 11:50 PM
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

CREATE TABLE IF NOT EXISTS `alias` (
  `id` int(11) NOT NULL auto_increment,
  `alias` varchar(200) NOT NULL,
  `pageId` int(200) NOT NULL,
  `default` int(11) NOT NULL,
  `isBase` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `alias`
--

INSERT INTO `alias` (`id`, `alias`, `pageId`, `default`, `isBase`) VALUES
(1, '/', 1, 1, 1),
(2, '/homepage', 1, 0, 1),
(3, '/cars', 3, 1, 1),
(4, '/about', 8, 1, 1),
(9, '/index', 1, 0, 1),
(5, '/cars/brands', 4, 1, 1),
(6, '/buildings', 5, 1, 1),
(7, '/buildings/villas', 6, 1, 1),
(8, '/buildings/villas/forSale', 7, 1, 1),
(10, '/404', 2, 1, 1),
(11, '/cars/brands/opel', 10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL auto_increment,
  `pageId` int(11) NOT NULL,
  `rank` int(11) NOT NULL COMMENT 'Position in the area',
  `area` varchar(200) NOT NULL COMMENT 'Where to put the content',
  `type` varchar(300) NOT NULL COMMENT 'e.g. text, widget etc.',
  `spec` varchar(300) NOT NULL COMMENT 'e.g. widget name, textcontent id',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `pageId`, `rank`, `area`, `type`, `spec`) VALUES
(1, 1, 1, 'content', 'text', '1'),
(2, 1, 2, 'content', 'text', '2'),
(3, 8, 1, 'content', 'text', '3'),
(4, 2, 1, 'content', 'text', '4');

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE IF NOT EXISTS `layouts` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `path` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `layouts`
--

INSERT INTO `layouts` (`id`, `name`, `path`) VALUES
(1, 'Default wcms layout', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

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

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(65) NOT NULL,
  `keywords` varchar(160) NOT NULL,
  `description` varchar(160) NOT NULL,
  `parent` int(11) NOT NULL default '0',
  `locked` int(11) NOT NULL default '0',
  `visible` int(11) NOT NULL default '1',
  `rank` int(11) NOT NULL COMMENT 'Rank in the menu',
  `lastmod` date NOT NULL,
  `changefreq` varchar(50) NOT NULL default 'monthly',
  `priority` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `keywords`, `description`, `parent`, `locked`, `visible`, `rank`, `lastmod`, `changefreq`, `priority`) VALUES
(1, 'Homepage', 'some, test, keywords', 'This is my test homepage', 0, 1, 1, 0, '2010-08-06', 'weekly', '1'),
(8, 'about', 'about, page', 'This is the about page', 0, 1, 1, 3, '2010-08-06', 'monthly', '0.5'),
(3, 'cars', 'cars, of, mine', 'some cars', 0, 0, 1, 1, '2010-08-06', 'monthly', '0.5'),
(4, 'brands', 'car, brands', 'some car brands', 3, 0, 1, 1, '2010-08-06', 'monthly', '0.5'),
(5, 'buildings', 'buildings, available', 'available buildings', 0, 0, 1, 2, '2010-08-06', 'monthly', '0.5'),
(6, 'Villas', 'villa, available', 'villas available', 5, 0, 1, 1, '2010-08-06', 'monthly', '0.5'),
(7, 'forSale', 'for, sale, villas', 'villas for sale', 6, 0, 1, 1, '2010-08-06', 'monthly', '0.5'),
(10, 'opel', 'opel, cars, brands', 'The opel car brand', 4, 0, 1, 1, '2010-08-28', 'monthly', '0.5'),
(2, '404 - page not found', '404, page, not, found', 'This page has not been found.', 0, 1, 0, 5, '2010-08-14', 'monthly', '0.2');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL auto_increment,
  `websiteName` varchar(200) NOT NULL,
  `slogan` varchar(200) NOT NULL,
  `uriFormat` varchar(5) NOT NULL default '/' COMMENT '/, _, ID',
  `layoutId` int(11) NOT NULL,
  `footer` varchar(500) NOT NULL,
  `titleSeperator` varchar(10) NOT NULL default '-',
  `titleOrder` varchar(10) NOT NULL default 'append',
  `fullUrl` varchar(250) NOT NULL,
  `smartBrowse` int(11) NOT NULL default '1',
  `env` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `websiteName`, `slogan`, `uriFormat`, `layoutId`, `footer`, `titleSeperator`, `titleOrder`, `fullUrl`, `smartBrowse`, `env`) VALUES
(1, 'Solow-Projects', 'Some crappy cms system', '/', 1, 'Solow projects 2010. All rights reserved.', '-', 'append', 'http://localhost', 1, 'dev');

-- --------------------------------------------------------

--
-- Table structure for table `text`
--

CREATE TABLE IF NOT EXISTS `text` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `text`
--

INSERT INTO `text` (`id`, `title`, `content`) VALUES
(1, 'Welcome!', 'Welcome to your very own website! As you might have noticed, there are no pages yet, and I''m getting lonely... Could you create some page for me at the admin panel?'),
(2, '', 'Meaningless textbox.'),
(3, 'About', 'A little something about me.'),
(4, '404 - page not found', 'The page you have requested has not been found.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
