-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Час створення: Січ 02 2014 р., 19:55
-- Версія сервера: 5.6.14-log
-- Версія PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `image_pre`
--

-- --------------------------------------------------------

--
-- Структура таблиці `shop_sorting`
--

CREATE TABLE IF NOT EXISTS `shop_sorting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) DEFAULT NULL,
  `get` varchar(25) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп даних таблиці `shop_sorting`
--

INSERT INTO `shop_sorting` (`id`, `pos`, `get`, `active`) VALUES
(1, 4, 'rating', 1),
(2, 1, 'price', 1),
(3, 2, 'price_desc', 1),
(4, 3, 'hit', 1),
(5, 5, 'hot', 1),
(6, 0, 'action', 1),
(7, 8, 'name', 0),
(8, 9, 'name_desc', 0),
(9, 6, 'views', 0),
(10, 7, 'topsales', 0),
(11, 10, 'created_asc', 1),
(12, 11, 'created_desc', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_sorting_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_sorting_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(11) NOT NULL DEFAULT 'ru',
  `name` varchar(50) NOT NULL,
  `name_front` varchar(50) DEFAULT NULL,
  `tooltip` varchar(256) NOT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп даних таблиці `shop_sorting_i18n`
--

INSERT INTO `shop_sorting_i18n` (`id`, `locale`, `name`, `name_front`, `tooltip`) VALUES
(1, 'ru', 'По рейтингу', 'Рейтинг', ''),
(2, 'ru', 'От дешевых к дорогим', 'От дешевых к дорогим', ''),
(3, 'ru', 'От дорогих к дешевым', 'От дорогих к дешевым', ''),
(4, 'ru', 'Популярные', 'Популярные', ''),
(5, 'ru', 'Новинки', 'Новинки', ''),
(6, 'ru', 'Акции', 'Акции', ''),
(6, 'ua', '', '', ''),
(7, 'ru', 'А-Я', 'Имени', ''),
(8, 'ru', 'Я-А', 'Имени(Я-А)', ''),
(9, 'ru', 'Просмотров', 'Количеству просмотров', ''),
(10, 'ru', 'Топ продаж', 'Топ продаж', ''),
(11, 'ru', 'Дата создания', 'Дата создания (сначала старые)', ''),
(12, 'ru', 'Дата создания', 'Дата создания (сначала новые)', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
