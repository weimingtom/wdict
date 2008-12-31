-- phpMyAdmin SQL Dump
-- version 3.0.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2008 at 01:38 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webdict`
--

-- --------------------------------------------------------

--
-- Table structure for table `dict_en_vi`
--

CREATE TABLE IF NOT EXISTS `dict_en_vi` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `word` varchar(64) NOT NULL,
  `phonetic` varchar(64) NOT NULL,
  `meanings` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `dict_fr_vi`
--

CREATE TABLE IF NOT EXISTS `dict_fr_vi` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `word` varchar(64) NOT NULL,
  `phonetic` varchar(64) NOT NULL,
  `meanings` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `dict_users`
--

CREATE TABLE IF NOT EXISTS `dict_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `gid` int(10) NOT NULL default '4',
  `username` varchar(200) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `salt` varchar(12) default NULL,
  `email` varchar(80) NOT NULL,
  `title` varchar(50) default NULL,
  `realname` varchar(40) default NULL,
  PRIMARY KEY  (`id`),
  KEY `punbb_users_username_idx` (`username`(3))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `dict_vi_en`
--

CREATE TABLE IF NOT EXISTS `dict_vi_en` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `word` varchar(64) NOT NULL,
  `phonetic` varchar(64) NOT NULL,
  `meanings` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `dict_vi_fr`
--

CREATE TABLE IF NOT EXISTS `dict_vi_fr` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `word` varchar(64) NOT NULL,
  `phonetic` varchar(64) NOT NULL,
  `meanings` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
