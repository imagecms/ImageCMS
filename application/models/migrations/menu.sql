-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2013 at 05:44 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19-1+debphp.org~precise+3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imagecms`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `main_title` varchar(300) NOT NULL,
  `tpl` varchar(255) DEFAULT NULL,
  `expand_level` int(255) DEFAULT NULL,
  `description` text,
  `created` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `main_title`, `tpl`, `expand_level`, `description`, `created`) VALUES
(1, 'main_menu', 'Главное меню', 'shop_menu', 0, '', '2012-02-07 15:34:41'),
(4, 'top_menu', 'Top menu', 'top_menu', 0, 'Menu at the top of template', '2013-05-24 18:07:17'),
(5, 'footer_menu', 'Footer menu', 'footer_menu', 0, '', '2012-05-25 11:43:06'),
(10, 'left_menu', 'left_menu', 'left_menu', 2, 'left_menu', '2013-03-02 15:52:02'),
(11, 'footer_menu_mobile', 'footer_menu_mobile', '', 0, 'footer mobile menu', '2013-09-19 17:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `menus_data`
--

CREATE TABLE IF NOT EXISTS `menus_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(9) NOT NULL,
  `item_id` int(9) NOT NULL,
  `item_type` varchar(15) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `roles` text,
  `hidden` smallint(1) NOT NULL DEFAULT '0',
  `title` varchar(300) NOT NULL,
  `parent_id` int(9) NOT NULL,
  `position` smallint(5) DEFAULT NULL,
  `description` text,
  `add_data` text,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `menus_data`
--

INSERT INTO `menus_data` (`id`, `menu_id`, `item_id`, `item_type`, `item_image`, `roles`, `hidden`, `title`, `parent_id`, `position`, `description`, `add_data`) VALUES
(43, 11, 68, 'page', '', '', 0, 'Контакты', 0, 1, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(44, 11, 67, 'page', '', '', 0, 'Помощь', 0, 2, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(8, 1, 0, 'url', 'sdf', 'a:1:{i:0;s:1:"0";}', 0, 'Главная', 0, 5, NULL, 'a:2:{s:3:"url";s:1:"/";s:7:"newpage";i:1;}'),
(9, 1, 64, 'page', '', '', 0, 'О магазине', 0, 4, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(11, 1, 0, 'url', '', '', 0, 'Доставка', 0, 3, NULL, 'a:2:{s:3:"url";s:9:"/dostavka";s:7:"newpage";s:1:"0";}'),
(12, 1, 0, 'page', '', '', 0, 'Помощь', 0, 15, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";s:1:"1";}'),
(13, 1, 0, 'url', '', '', 0, 'Контакты', 0, 1, NULL, 'a:2:{s:3:"url";s:11:"/contact_us";s:7:"newpage";s:1:"0";}'),
(36, 10, 71, 'category', '', 'a:1:{i:0;s:1:"0";}', 0, 'Архив', 35, 2, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(35, 10, 69, 'category', '', '', 0, 'Новоcти', 0, 3, NULL, 'N;'),
(15, 4, 64, 'page', '', '', 0, 'О магазине', 0, 6, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";s:1:"1";}'),
(16, 4, 66, 'page', '', '', 0, 'Доставка', 0, 5, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";s:1:"1";}'),
(17, 4, 67, 'page', '', '', 0, 'Помощь', 0, 3, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";s:1:"1";}'),
(18, 4, 68, 'page', '', '', 0, 'Контакты', 0, 4, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";s:1:"1";}'),
(34, 10, 70, 'category', '', '', 0, 'Текущие новости', 35, 1, NULL, 'N;'),
(20, 5, 0, 'url', '', '', 0, 'Видео', 0, 1, NULL, 'a:2:{s:3:"url";s:20:"/shop/category/video";s:7:"newpage";s:1:"0";}'),
(21, 5, 64, 'page', '', '', 0, 'О магазине', 0, 8, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(22, 5, 0, 'url', '', '', 0, 'Домашнее  аудио', 0, 3, NULL, 'a:2:{s:3:"url";s:30:"/shop/category/domashnee_audio";s:7:"newpage";s:1:"0";}'),
(23, 5, 66, 'page', '', '', 0, 'Доставка и оплата', 0, 6, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(24, 5, 0, 'url', '', '', 0, 'Фото и камеры', 0, 5, NULL, 'a:2:{s:3:"url";s:28:"/shop/category/foto_i_kamery";s:7:"newpage";s:1:"0";}'),
(25, 5, 67, 'page', '', '', 0, 'Помощь', 0, 2, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";s:1:"1";}'),
(26, 5, 0, 'url', '', '', 0, 'Домашняя электроника', 0, 7, NULL, 'a:2:{s:3:"url";s:38:"/shop/category/domashniaia_elektronika";s:7:"newpage";s:1:"0";}'),
(27, 5, 68, 'page', '', '', 0, 'Контакты', 0, 4, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(28, 5, 0, 'url', '', '', 0, 'Авто музыка и видео', 0, 9, NULL, 'a:2:{s:3:"url";s:34:"/shop/category/avto_muzyka_i_video";s:7:"newpage";s:1:"0";}'),
(33, 4, 90, 'page', '', '', 0, 'Главная', 0, 1, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";s:1:"0";}'),
(37, 1, 69, 'category', '', '', 0, 'Новоcти', 0, 14, NULL, 'N;'),
(38, 4, 69, 'category', '', '', 0, 'Новоcти', 0, 2, NULL, 'N;'),
(39, 1, 100, 'page', '', '', 0, '111', 0, 6, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(42, 4, 102, 'page', '', '', 0, 'dgdfgdfg', 0, 7, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(45, 11, 65, 'page', '', '', 0, 'Оплата', 0, 3, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(46, 11, 35, 'page', '', '', 0, 'О сайте', 0, 4, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(47, 11, 66, 'page', '', '', 0, 'Доставка', 0, 5, NULL, 'a:1:{s:7:"newpage";i:0;}');

-- --------------------------------------------------------

--
-- Table structure for table `menu_translate`
--

CREATE TABLE IF NOT EXISTS `menu_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `menu_translate`
--

INSERT INTO `menu_translate` (`id`, `item_id`, `lang_id`, `title`) VALUES
(32, 8, 30, 'Home'),
(31, 8, 3, 'Главная'),
(6, 9, 30, 'About'),
(5, 9, 3, 'О Магазине'),
(7, 13, 3, 'Контакты'),
(8, 13, 30, 'Contacts'),
(11, 10, 3, 'Оплата'),
(12, 10, 30, 'Delivery'),
(15, 12, 3, 'Помощь'),
(16, 12, 30, 'Help'),
(17, 14, 3, 'Главная'),
(18, 14, 30, 'Home'),
(19, 15, 3, 'О магазине'),
(20, 15, 30, 'About'),
(21, 16, 3, 'Доставка'),
(22, 16, 30, 'Delivery'),
(23, 17, 3, 'Помощь'),
(24, 17, 30, 'Help'),
(25, 18, 3, 'Контакты'),
(26, 18, 30, 'Contacts'),
(29, 19, 3, 'Главная'),
(30, 19, 30, 'Home'),
(33, 20, 3, 'Видео'),
(34, 20, 30, 'Video'),
(36, 21, 3, 'О магазине'),
(37, 21, 30, 'About'),
(38, 22, 3, 'Домашнее аудио'),
(39, 22, 30, 'Home music'),
(40, 23, 3, 'Доставка и оплата'),
(41, 23, 30, 'Delivery'),
(42, 24, 3, 'Фото и камеры'),
(43, 24, 30, 'Photo and Camera'),
(44, 25, 3, 'Помощь'),
(45, 25, 30, 'Help'),
(46, 26, 3, 'Домашняя электроника'),
(47, 26, 30, 'Home Electronics'),
(48, 27, 3, 'Контакты'),
(49, 27, 30, 'Contacts'),
(50, 28, 3, 'Авто музыка и видео'),
(51, 28, 30, 'Auto Tabs');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
