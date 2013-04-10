-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Час створення: Квт 04 2013 р., 16:54
-- Версія сервера: 5.1.67-community-log
-- Версія PHP: 5.4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `image`
--

-- --------------------------------------------------------

--
-- Структура таблиці `shop_sorting`
--

CREATE TABLE IF NOT EXISTS `shop_sorting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `name_front` varchar(50) DEFAULT NULL,
  `tooltip` varchar(50) NOT NULL,
  `get` varchar(15) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп даних таблиці `shop_sorting`
--

INSERT INTO `shop_sorting` (`id`, `pos`, `name`, `name_front`, `tooltip`, `get`, `active`) VALUES
(1, 0, 'По рейтингу', NULL, '', 'rating', 0),
(2, 1, 'От дешевих к дорогим', NULL, '', 'price', 0),
(3, 2, 'От дорогих к дешевым', NULL, '', 'price_desc', 0),
(4, 3, 'Популярные', NULL, '', 'hit', 1),
(5, 5, 'Новинки', NULL, '', 'hot', 0),
(6, 4, 'Акции', NULL, '', 'action', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
