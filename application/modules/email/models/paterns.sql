-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2013 at 05:40 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.17RC1

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
-- Table structure for table `mod_email_paterns`
--

CREATE TABLE IF NOT EXISTS `mod_email_paterns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `patern` text NOT NULL,
  `from` varchar(256) NOT NULL,
  `from_email` varchar(256) NOT NULL,
  `admin_email` varchar(256) NOT NULL,
  `theme` varchar(256) NOT NULL,
  `type` enum('HTML','Text') NOT NULL DEFAULT 'HTML',
  `user_message` text NOT NULL,
  `user_message_active` tinyint(1) NOT NULL DEFAULT '0',
  `admin_message` text NOT NULL,
  `admin_message_active` tinyint(1) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `variables` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mod_email_paterns`
--

INSERT INTO `mod_email_paterns` (`id`, `name`, `patern`, `from`, `from_email`, `admin_email`, `theme`, `type`, `user_message`, `user_message_active`, `admin_message`, `admin_message_active`, `description`, `variables`) VALUES
(1, 'my_patern', 'Привет %user%', 'Mark', '', 'ad@min.com', 'Тема тест', 'HTML', '<p>повідомлення користувачу %user% от %user_email% sdsdsd %user%</p>', 1, '<p>повідомлення адміну</p>', 1, '<p>описание</p>', 'a:3:{s:10:"%order_id%";s:26:"Идентификатор";s:6:"%user%";s:24:"Пользователь";s:12:"%user_email%";s:30:"Email пользователя";}'),
(2, 'Создание пользователя', '', 'Admin', 'ad@min.com', 'ad@min.com', 'Создание пользователя', 'HTML', '<p><span>Успешно пройдена реєстрация $user_name$&nbsp;</span></p>\n<p>Ваши данние:<br /><span>Пароль: $user_password$</span><br /><span>Адрес: &nbsp;$user_address$</span><br /><span>Email: $user_email$</span><br /><span>Телефон: $user_phone$</span></p>', 1, '<p><span>Создан пользователь $user_name$:</span><br /><span>С паролем: $user_password$</span><br /><span>Адресом: &nbsp;$<span>user_</span>address$</span><br /><span>Email пользователя: $user_email$</span><br /><span>Телефон пользователя: $user_phone$</span></p>', 1, '<p>Шаблон письма на создание пользователя.</p>', 'a:6:{s:11:"$user_name$";s:31:"Имя пользователя";s:14:"$user_address$";s:35:"Адрес пользователя";s:15:"$user_password$";s:37:"Пароль пользователя";s:12:"$user_phone$";s:39:"Телефон пользователя";s:12:"$user_email$";s:30:"Email пользователя";s:8:"$asdasd$";s:6:"sdfsdf";}'),
(3, 'Востановление пароля', '', 'Администрация сайта', 'ad@min.com', '', 'Восстановление пароля', 'HTML', '<p><span>Здравствуйте!</span><br /><br /><span>На сайте $webSiteName$ создан запрос на восстановление пароля для Вашего аккаунта.</span><br /><br /><span>Для завершения процедуры восстановления пароля перейдите по ссылке $resetPasswordUri$</span><br /><br /><span>Ваш новый пароль для входа: $password$</span><br /><br /><span>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь по телефонам:</span><br /><br /><span>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89</span><br /><br /><span>---</span><br /><br /><span>С уважением,</span><br /><br /><span>сотрудники службы продаж $webSiteName$</span></p>', 1, '', 0, '', 'a:5:{s:13:"$webSiteName$";s:17:"Имя сайта";s:18:"$resetPasswordUri$";s:57:"Ссилка на востановления пароля";s:10:"$password$";s:12:"Пароль";s:5:"$key$";s:8:"Ключ";s:16:"$webMasterEmail$";s:52:"Email сотрудникjd службы продаж";}'),
(4, 'Смена пароля', '', 'Администрация сайта', 'ad@min.com', 'ad@min.com', 'Смена пароля', 'HTML', '<p><span>Здравствуйте $user_name$!</span><br /><br /><span>Ваш новый пароль для входа: $password$</span><br /><br /><span>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</span><br /><br /><span><br /></span></p>', 1, '', 0, '<p>Шаблон письма изменения пароля</p>', 'a:2:{s:11:"$user_name$";s:31:"Имя пользователя";s:10:"$password$";s:23:"Новий пароль";}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
