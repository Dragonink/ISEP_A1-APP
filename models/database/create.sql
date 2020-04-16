-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: infinite_measures
-- ------------------------------------------------------
-- Server version	8.0.19

DROP DATABASE IF EXISTS `infinite_measures`;
CREATE DATABASE IF NOT EXISTS `infinite_measures`;
USE `infinite_measures`;

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE `administrator` (
  `id` int NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `work_address` text NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `picture` mediumblob,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `nss` int NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `manager` int NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `picture` mediumblob,
  PRIMARY KEY (`nss`),
  KEY `manager` (`manager`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `banned`
--

DROP TABLE IF EXISTS `banned`;
CREATE TABLE `banned` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  CONSTRAINT `banned_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`nss`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `console`
--

DROP TABLE IF EXISTS `console`;
CREATE TABLE `console` (
  `id` int NOT NULL,
  `manager` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manager` (`manager`),
  CONSTRAINT `console_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE `exam` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `console` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `console` (`console`),
  CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`nss`),
  CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`console`) REFERENCES `console` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
  `id` int NOT NULL,
  `admin` int NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin` (`admin`),
  CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `administrator` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int NOT NULL,
  `exam` int NOT NULL,
  `type` varchar(3) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `result` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam` (`exam`),
  CONSTRAINT `test_ibfk_1` FOREIGN KEY (`exam`) REFERENCES `exam` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
