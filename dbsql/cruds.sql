-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `cruds`;
CREATE DATABASE `cruds` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `cruds`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `image`) VALUES
(1,	'โจเซฟ',	'มาม่า',	'394753844.jpg'),
(2,	'จอน',	'มอสรี่',	'890621840.jpg'),
(3,	'ลีรี่',	'มาม่า',	'1617260552.jpg'),
(4,	'โยดา',	'ลาล่า',	'170613383.jpg'),
(5,	'คาร่า',	'คิมเมอรี่',	'1496678063.jpg'),
(6,	'คริสตินน่า',	'การีล่า',	'1380753429.jpg'),
(7,	'อารีน่า',	'ดาวิน',	'411988752.jpg'),
(8,	'กริส',	'แจ็คสัน',	'878501748.jpg'),
(9,	'ชาเรส',	'มาติน',	'53518951.jpg'),
(10,	'สมศรี',	'มีดี',	'1502287609.jpg'),
(11,	'แฟรงค์',	'ฟอยด์',	'401389414.jpg'),
(12,	'สีสุดา',	'มาลัย',	'1520516486.jpg'),
(13,	'เพ็ญศรี',	'ใจดี',	'1197769307.jpg'),
(14,	'วินัย',	'รักดี',	'2094210416.jpg'),
(15,	'ฐัศแก้ว',	'ศรีสด',	'251887424.jpg'),
(16,	'สาวิต',	'แก้วคำจันทร์',	'85572711.jpg');

-- 2021-08-25 13:59:50
