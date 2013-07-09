-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 17 2013 р., 12:04
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

DROP TABLE IF EXISTS `shop_sorting`;
CREATE TABLE IF NOT EXISTS `shop_sorting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `name_front` varchar(50) DEFAULT NULL,
  `tooltip` varchar(50) NOT NULL,
  `get` varchar(15) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп даних таблиці `shop_sorting`
--

INSERT INTO `shop_sorting` (`id`, `pos`, `name`, `name_front`, `tooltip`, `get`, `active`) VALUES
(1, 3, 'По рейтингу', 'Рейтинг', '', 'rating', 1),
(2, 0, 'От дешевих к дорогим', 'От дешевих к дорогим', '', 'price', 1),
(3, 2, 'От дорогих к дешевым', 'От дорогих к дешевим', '', 'price_desc', 1),
(4, 1, 'Популярные', 'Популярние', '', 'hit', 1),
(5, 4, 'Новинки', 'Новинки', '', 'hot', 1),
(6, 5, 'Акции', 'Акции', '', 'action', 1),
(7, 6, 'А-Я', 'Имени', '', 'name', 1),
(8, 7, 'Я-А', 'Имени(Я-А)', '', 'name_desc', 1),
(9, 7, 'Просмотров', 'Количеству просмотров', '', 'views', 1),
(10, 9, 'Топ продаж', 'Топ продаж', '', 'topsales', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
