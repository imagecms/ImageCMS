-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 22 2015 г., 14:18
-- Версия сервера: 5.5.43
-- Версия PHP: 5.5.23-1+deb.sury.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `testOrigindemo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answer_notifications`
--

DROP TABLE IF EXISTS `answer_notifications`;
CREATE TABLE IF NOT EXISTS `answer_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `answer_notifications`
--

INSERT INTO `answer_notifications` (`id`, `locale`, `name`, `message`) VALUES
(1, 'ua', 'incoming', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(2, 'ua', 'callback', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(3, 'ua', 'order', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(4, 'ru', 'incoming', '<h2>Спасибо</h2>\r\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>'),
(5, 'ru', 'callback', '<h2>Спасибо</h2>\r\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>'),
(6, 'ru', 'order', '<h2>Спасибо</h2>\r\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>');

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` varchar(255) NOT NULL,
  `width` int(5) NOT NULL,
  `height` int(5) NOT NULL,
  `effects` text,
  `page_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `banners`
--

INSERT INTO `banners` (`id`, `place`, `width`, `height`, `effects`, `page_type`) VALUES
(1, 'main_left', 238, 248, '{"autoplay":0,"autoplaySpeed":"3","arrows":0,"centerMode":0,"dots":0,"draggable":0,"fade":0,"easing":"","infinite":0,"pauseOnHover":0,"pauseOnDotsHover":0,"speed":0,"swipe":0,"touchMove":0,"vertical":0,"rtl":0}', 'main'),
(2, 'main_center', 740, 248, '{"autoplay":1,"autoplaySpeed":"3","arrows":0,"centerMode":0,"dots":1,"draggable":0,"fade":0,"easing":"","infinite":0,"pauseOnHover":0,"pauseOnDotsHover":0,"speed":0,"swipe":0,"touchMove":0,"vertical":0,"rtl":0}', 'main'),
(3, 'main_right_top', 458, 124, '{"autoplay":0,"autoplaySpeed":"9","arrows":0,"centerMode":0,"dots":0,"draggable":0,"fade":0,"easing":"","infinite":0,"pauseOnHover":0,"pauseOnDotsHover":0,"speed":0,"swipe":0,"touchMove":0,"vertical":0,"rtl":0}', 'main'),
(4, 'main_right_bottom', 458, 123, '{"autoplay":0,"autoplaySpeed":"5","arrows":0,"centerMode":0,"dots":0,"draggable":0,"fade":0,"easing":"","infinite":0,"pauseOnHover":0,"pauseOnDotsHover":0,"speed":0,"swipe":0,"touchMove":0,"vertical":0,"rtl":0}', 'main'),
(5, 'category', 228, 268, '{"autoplay":0,"autoplaySpeed":"3","arrows":0,"centerMode":0,"dots":0,"draggable":0,"fade":0,"easing":"","infinite":0,"pauseOnHover":0,"pauseOnDotsHover":0,"speed":0,"swipe":0,"touchMove":0,"vertical":0,"rtl":0}', 'shop_category'),
(6, 'product', 310, 278, '{"autoplay":0,"autoplaySpeed":"999","arrows":0,"centerMode":0,"dots":0,"draggable":0,"fade":0,"easing":"","infinite":0,"pauseOnHover":0,"pauseOnDotsHover":0,"speed":0,"swipe":0,"touchMove":0,"vertical":0,"rtl":0}', 'product');

-- --------------------------------------------------------

--
-- Структура таблицы `banners_i18n`
--

DROP TABLE IF EXISTS `banners_i18n`;
CREATE TABLE IF NOT EXISTS `banners_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL DEFAULT 'ru',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banners_i18n`
--

INSERT INTO `banners_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Main left'),
(2, 'ru', 'Main center'),
(3, 'ru', 'Main right top'),
(4, 'ru', 'Main right bottom'),
(5, 'ru', 'Category banner'),
(6, 'ru', 'Product banner');

-- --------------------------------------------------------

--
-- Структура таблицы `banner_image`
--

DROP TABLE IF EXISTS `banner_image`;
CREATE TABLE IF NOT EXISTS `banner_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `target` int(2) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `allowed_page` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `active_from` int(11) DEFAULT NULL,
  `active_to` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `permanent` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banner_image_fi_0bb916` (`banner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `banner_image`
--

INSERT INTO `banner_image` (`id`, `banner_id`, `target`, `url`, `allowed_page`, `position`, `active_from`, `active_to`, `active`, `permanent`) VALUES
(1, 2, 0, '/shop/category/mebel', 0, 1, NULL, NULL, 1, 1),
(3, 1, 0, '/shop/category/elektronika', 0, 1, NULL, NULL, 1, 1),
(4, 3, 0, '/shop/category/detskie-tovary', 0, 1, NULL, NULL, 1, 1),
(5, 4, 0, '/shop/category/dom-i-sad', 0, 1, NULL, NULL, 1, 1),
(6, 5, 0, '/shop/category/elektronika', 0, 1, NULL, NULL, 1, 1),
(7, 6, 0, '/shop/category/elektronika', 0, 1, NULL, NULL, 1, 1),
(8, 2, 0, '/shop/category/elektronika', 0, 2, NULL, NULL, 1, 1),
(9, 2, 0, '/shop/category/dom-i-sad', 0, 3, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `banner_image_i18n`
--

DROP TABLE IF EXISTS `banner_image_i18n`;
CREATE TABLE IF NOT EXISTS `banner_image_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL DEFAULT 'ru',
  `src` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `clicks` int(20) DEFAULT NULL,
  `description` TEXT,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banner_image_i18n`
--

INSERT INTO `banner_image_i18n` (`id`, `locale`, `src`, `name`, `clicks`, `description`) VALUES
(1, 'ru', '1429265248.jpg', 'Мебель', 10, ''),
(3, 'ru', '1429266386.jpg', 'Электроника', 7, ''),
(4, 'ru', '1429266406.jpg', 'Детские товары', 6, ''),
(5, 'ru', '1429266425.jpg', 'Дом и сад', 7, ''),
(6, 'ru', '1429266483.jpg', 'Электроника', 6, ''),
(7, 'ru', '1429266497.jpg', 'Электроника', 7, ''),
(8, 'ru', '1429266721.jpg', 'Электроника', 6, ''),
(9, 'ru', '1429266792.jpg', 'Дом и сад', 9, '');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `position` mediumint(5) NOT NULL DEFAULT '0',
  `name` varchar(160) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `short_desc` text NOT NULL,
  `url` varchar(300) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `fetch_pages` text NOT NULL,
  `main_tpl` varchar(50) NOT NULL,
  `tpl` varchar(50) DEFAULT NULL,
  `page_tpl` varchar(50) DEFAULT NULL,
  `per_page` smallint(5) NOT NULL,
  `order_by` varchar(25) NOT NULL,
  `sort_order` varchar(25) NOT NULL,
  `comments_default` tinyint(1) NOT NULL DEFAULT '0',
  `field_group` int(11) NOT NULL,
  `category_field_group` int(11) NOT NULL,
  `settings` varchar(10000) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `position`, `name`, `title`, `short_desc`, `url`, `image`, `keywords`, `description`, `fetch_pages`, `main_tpl`, `tpl`, `page_tpl`, `per_page`, `order_by`, `sort_order`, `comments_default`, `field_group`, `category_field_group`, `settings`, `created`, `updated`) VALUES
(69, 0, 1, 'Новости', 'Новости', '', 'novosti', '', 'Новости', 'Новости интернет магазина', 'b:0;', '', '', '', 15, 'publish_date', 'desc', 0, 13, -1, 'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";b:0;}', NULL, 1429605575);

-- --------------------------------------------------------

--
-- Структура таблицы `category_translate`
--

DROP TABLE IF EXISTS `category_translate`;
CREATE TABLE IF NOT EXISTS `category_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `short_desc` text,
  `image` varchar(250) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `lang` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `category_translate`
--

INSERT INTO `category_translate` (`id`, `alias`, `name`, `title`, `short_desc`, `image`, `keywords`, `description`, `lang`) VALUES
(9, 69, 'News', '', '', '', '', '', 4),
(10, 69, 'Новини', '', '', '', '', '', 5),
(11, 69, 'Новости', '', '', '', '', '', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(25) NOT NULL DEFAULT 'core',
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_site` varchar(250) NOT NULL,
  `item_id` bigint(11) NOT NULL,
  `text` text,
  `date` int(11) NOT NULL,
  `status` smallint(1) NOT NULL,
  `agent` varchar(250) NOT NULL,
  `user_ip` varchar(64) NOT NULL,
  `rate` int(11) NOT NULL,
  `text_plus` varchar(500) DEFAULT NULL,
  `text_minus` varchar(500) DEFAULT NULL,
  `like` int(11) NOT NULL,
  `disslike` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module` (`module`),
  KEY `item_id` (`item_id`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=166 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `module`, `user_id`, `user_name`, `user_mail`, `user_site`, `item_id`, `text`, `date`, `status`, `agent`, `user_ip`, `rate`, `text_plus`, `text_minus`, `like`, `disslike`, `parent`) VALUES
(103, 'shop', 1, 'Сергей В.', 'ad@min.com', '', 17237, 'Покупкой доволен. Оценил бы товар на твердую 5 в своем ценовом сегменте. Обходит мой старый hdd по всем параметрам в разы, прекратились лаги и задержки из за диска. Так что ощущения положительные, надеюсь что в дальнейшем технология ссд будет только развиваться и гигабайт информации на ссд носителе будет только дешеветь.', 1425651428, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 5, '', '', 1, 0, 0),
(101, 'shop', 1, 'Мах', 'ad@min.com', '', 17236, 'Отличная флешка, надежная и удобная', 1425650319, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 5, '', '', 0, 0, 0),
(102, 'shop', 1, 'Анна', 'ad@min.com', '', 17236, 'Корпус GOODRAM Twister 3.0 изготовлен из прочного пластика. Благодаря богатой цветовой гамме каждая модель приобретает индивидуальный характер.<br/><br/>Дополнительным преимуществом является поворотная металлическая скоба, которая также защищает устройство памяти USB.', 1425650431, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 4, '', '', 0, 0, 0),
(100, 'shop', 1, 'Николай П.', 'ad@min.com', '', 17235, 'Пользуйтесь функцией записи радиопрограмм, встроенной в мини-систему. Установив время записи радиопрограммы, вы можете записать передачу в течение любого периода времени', 1425648951, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 4, '', '', 1, 0, 0),
(99, 'shop', 1, 'Administrator', 'ad@min.com', '', 17235, 'В комплектацию устройства караоке-диск не входит. Данная модель музыкального центра не поддерживает профильные издания караоке-дисков компании Samsung. Предусмотрена поддержка только универсальных DVD-караоке дисков.', 1425648880, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 98),
(98, 'shop', 1, 'Юлия', 'ad@min.com', '', 17235, 'Прилагается ли к центру диск с караоке? Какую версию караоке воспроизводит данный центр?', 1425648841, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 0),
(97, 'shop', 1, 'Андрей К.', 'ad@min.com', '', 17234, 'Да. Тогда же брал для себя, для игры на гитаре через комбоусилитель.', 1425645082, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 96),
(96, 'shop', 1, 'Оля', 'ad@min.com', '', 17234, 'KOSS BT540i появились на рынке в декабре 2014 года?', 1425644850, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 0),
(95, 'shop', 1, 'Admor', 'ad@min.com', '', 17234, 'KOSS BT540i абсолютно универсальны, поскольку могут быть использованы, как с плеером или компьютером, так с планшетом или смартфоном. Это качественные наушники-гарнитура с возможностью отвечать на срочные звонки, что для многих владельцев будет являться преимуществом.', 1425644774, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 4, '', '', 1, 0, 0),
(94, 'shop', 1, 'Дмитрий', 'ad@min.com', '', 17233, 'По формальным внешним признакам, Pro4S относятся к самой популярной сейчас категории наушников для портативной техники: они относительно компактные, лёгкие, складные, кабель съёмный и снабжён коннектором 3,5 мм. Кстати, подсоединять кабель можно к любой из чаш.', 1425643481, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 93),
(93, 'shop', 1, 'Динара', 'ad@min.com', '', 17233, 'Купила вчера - очень рада, звук порадовал, слушаю с плеером Fiio X1. Всем советую!', 1425641232, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 5, '', '', 0, 1, 0),
(104, 'shop', 1, 'Игорь', 'ad@min.com', '', 17237, 'Добрый день! У меня ssd good ram c40 перестал определятся ноутбуком также и компьютером.Куплен был у вас 08,10,2014. Какие мои должны быть дальнейшее действия?', 1425651474, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 1, 0),
(105, 'shop', 1, 'Administrator', 'ad@min.com', '', 17237, 'Стоит обратиться в сервис. Гарантия - 3 года', 1425651511, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 104),
(106, 'shop', 1, 'Administrator', 'ad@min.com', '', 17238, 'Неплохая надежная карта, но метка UHS 1 там явно для &quot;галочки&quot;, ни в чем не превосходит обычный 10-й класс, отстает по скорости и чтения и записи от карт UHS 1 от Transcend, Kingston не говоря уж о SanDisk и Toshiba', 1425652846, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 3, '', '', 0, 0, 0),
(107, 'shop', 1, 'Administrator', 'ad@min.com', '', 17238, 'Карта проработала около месяца. Потом начались проблемы с записью фото.', 1425652939, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 106),
(108, 'shop', 1, 'Administrator', 'ad@min.com', '', 17238, 'Нормальная, еще работает ( прошло полгода)', 1425653011, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 3, '', '', 0, 0, 0),
(109, 'shop', 1, 'Виталий', 'ad@min.com', '', 17239, 'Пользуюсь данным моноблок уже более двух лет. За свою цену просто идеальный мультимедийный комбайн, увеличил память одной планкой 4Gb. Установлен Windovs 7 64x. Хотел бы тоже заменить процессор...', 1425908485, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 4, '', '', 0, 0, 0),
(110, 'shop', 1, 'Administrator', 'ad@min.com', '', 17239, 'Можно поставить i5 и i7 процессор у которого сокет PGA988 и TPD не больше 35W', 1425908519, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 109),
(111, 'shop', 1, 'Виктор', 'ad@min.com', '', 17240, 'А есть на планшет прошивка с Kit Kat''om?', 1425910752, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 1, 0, 0),
(112, 'shop', 1, 'Administrator', 'ad@min.com', '', 17240, 'Пока что данной прошивки нет.', 1425910772, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 111),
(113, 'shop', 1, 'Фил72', 'ad@min.com', '', 17240, 'Планшет стоит своих денег. При работе с документами проблем не возникло. Игры идут на ура как и видео. Автономность 5 часов на средней нагрузке. Покупкой доволен.', 1425910802, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 4, '', '', 1, 0, 0),
(114, 'shop', 1, 'Марина', 'ad@min.com', '', 17241, 'Имиджевый планшет со стильным дизайном. Айпад полностью заменил ноутбук. Функциональный, ладная сборка, отлично  работают динамики, мощный, шустрый. Достойный аппарат, но iPad Air имеет свои недостатки. Юзая интернет приложения, они  постоянно вылетают. Плюс сильно греется. Огорчило отсутствие наушников, пришлось докупать аксессуар.', 1425912292, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 5, '', '', 0, 0, 0),
(115, 'shop', 1, 'Стас', 'ad@min.com', '', 17241, 'Дорогая игрушка. Приятно пользоваться девайсом такого качества. Apple подтвердил лидерский статус на рынке. iPad  «тянет» хорошие игрушки, софт функционален в отличие от Android. Батареи хватает на полтора дня. Если непрерывная работа –  часов десять. В интернете я летаю. После обычного ноута ощущение непередаваемой свободы. Чехол обязателен, ибо корпус  легко травмируется. Минус – отсутствие связки с картами памяти.', 1425912344, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 4, '', '', 1, 0, 0),
(116, 'shop', 1, 'Макс Р.', 'ad@min.com', '', 17241, 'Батарея быстро заканчивается.', 1425912399, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 115),
(117, 'shop', 1, 'Игорь', 'ad@min.com', '', 17242, 'Добрый день!\nСкажите, появиться ли у вас в продаже 16Gb версия данного планшета? \nЕсли да то когда?', 1425914404, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 1, 0, 0),
(118, 'shop', 1, 'Administrator', 'ad@min.com', '', 17242, 'Добрый день! Ожидаем в сентябре', 1425914434, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 117),
(120, 'shop', 1, 'Игорь', 'ad@min.com', '', 17243, 'как считаете, потянет такие программы как Archicad, Autocad и тд?﻿', 1425916473, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 0),
(119, 'shop', 1, 'Yuri', 'ad@min.com', '', 17242, 'Планшет 100% хит и лучший на сегодня 7" планшет. Кому 8GB мало: с альтернативной прошивкой можно подключать любые внешние накопители через miniUSB. Пробовал SanDisk microSD 64GB, тянет HD фильмы с него на ура. По поводу задней камеры много жалоб, как по мне она и вовсе не нужна, есть в телефоне, который всегда с собой', 1425914486, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 5, '', '', 1, 0, 0),
(121, 'shop', 1, 'Михаил', 'ad@min.com', '', 17243, 'У меня он уже год, 256 Гб, на пятом i-core, тащит ВСЁ и практически не греется при этом. С установкой программ проблем не было, как легальных, так и не очень. Race Driver Grid летает без тормозов, хотя до этого его и стационарный комп тянул с трудом, а Йоге далось влегкую. Покрытие до сих пор как новое, корпус крепкий (пару раз уже проверяли).', 1425916577, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 4, '', '', 1, 0, 0),
(122, 'shop', 1, 'Administrator', 'ad@min.com', '', 17243, 'Да, возможности позволяют', 1425916605, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 120),
(123, 'shop', 1, 'Паша', 'ad@min.com', '', 17244, 'Скажите пожалуйста, экран у него матовый или глянцевый ? Заранее благодарен', 1425919440, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 1, 0),
(124, 'shop', 1, 'Оля', 'ad@min.com', '', 17244, 'Экран глянцевый, очень удобно смотреть на свое отражение, а еще неплохо использовать мультитач', 1425919475, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 123),
(125, 'shop', 1, 'Никита', 'ad@min.com', '', 17244, 'Качество сборки не выдерживает критики', 1425919528, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 2, '', '', 0, 1, 0),
(126, 'shop', 1, 'Петрович', 'ad@min.com', '', 17245, 'Я, правда, не очень понял, действительно ли это самый первый хитрогнутый all-in-one, или «всего лишь» первый all-in-one с экраном 29 дюймов и соотношением сторон 21:9?', 1425920393, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 3, '', '', 0, 1, 0),
(127, 'shop', 1, 'Сергей', 'ad@min.com', '', 17245, 'Интерес представляет начинка ПК - там есть на что посмотреть. В частности, в пресс-релизе упомянутый процессор Intel Core i5-5200U с двумя ядрами и частотой 2,2 ГГц. Он относится к пятому поколению, известном как Broadwell...', 1425920492, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 3, '', '', 1, 0, 0),
(128, 'shop', 1, 'Андрей', 'ad@min.com', '', 17246, 'Купил в основном для интернета, на большее он в принципе и не способен.', 1425921327, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 2, '', '', 1, 0, 0),
(129, 'shop', 1, 'Николай', 'ad@min.com', '', 17247, 'Зарядка через micro-USB лишает одного USB, коих всего 2шт!<br/>Абсолютно бесполезная механическая кнопка Windows, на торце планшета, лучше бы её сделали сенсорной на рамке под дисплеем как в других моделях, а на её месте сделали бы ещё один micro-USB или micro-SD слот.<br/>Нет внешней камеры!<br/>Не хватает максимальной яркости экрана<br/>Коротковат провод USB, неудобно заряжать, если использовать удлинитель-заряжается дольше!', 1425922232, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 4, '', '', 0, 1, 0),
(131, 'shop', 1, 'Тамара', 'ad@min.com', '', 17248, 'Отличное кресло. Думала, что не смогу сама собрать :)) Собрала запросто! Установилось всё нормально, без проблем. Пока ничего не скрипит )) На коробке написано, что производство Эстонии. Экокожа без запаха.<br/>Выглядит отлично. Спасибо!', 1427717309, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 2, 0, 0),
(132, 'shop', 1, 'Вадим К.', 'ad@min.com', '', 17248, 'Кресло более, чем удобное. Первую неделю качалка туговато ходила, но сейчас все в шоколаде. Не скрипит. Я высокий и мне все равно, но для многих оно может показаться высоковатым. Пришел с работы и упал в этот трон - чувствую себя королем несуществующего королевства :) Нам на работы вчера прикатили какую-то фигню на тест-драйв за полторы штуки евро, типа если понравится, всем такие кресла купим. Так вот Contad кресло в разы будет лучше того.', 1427717384, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 1, 0, 0),
(133, 'shop', 1, 'Владимир Г.', 'ad@min.com', '', 17248, 'Пользуюсь ним год, по поводу качалки - в низу есть ручка (как вентель на кране) в её помощью регулируется жёсткость пружины-качалки', 1427717412, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 132),
(130, 'shop', 1, 'Миша', 'ad@min.com', '', 17247, 'Однажды увидели планшет Asus Transformer Book T100 и влюбились. На вид это оказался тот же привычный ME400, но усовершенствованный. В итоге старый планшет был продан (вместе с беспроводной клавиатурой) а за эти деньги приобрели новенький T100 с док-станцией (клавиатурой).', 1425922335, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', '194.44.121.196', 0, '', '', 0, 0, 129),
(134, 'shop', 1, 'Михаил', 'ad@min.com', '', 17249, 'Купил мини диван - качеством доволен. Сделали диван за 12 дней. Спасибо менеджеру за помощь.', 1427720002, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 4, '', '', 1, 0, 0),
(135, 'shop', 1, 'Ольга Петровна', 'ad@min.com', '', 17249, 'Сегодня привезли этот милый и чудесный диван.Со дня заказа прошло 4 недели . что немного больше чем обещали... Но в целом моя семья осталась довольна работой фирмы.', 1427720111, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 134),
(136, 'shop', 1, 'Анна', 'ad@min.com', '', 17249, 'Долго выбирали с мужем диван, но все варианты были либо слишком дорогие либо просто ужасные внешне. Изначально планировали купить угловой диван. Увидели в магазине этот диван случайно, очень понравился и привлекала цена.', 1427720122, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 4, '', '', 0, 1, 0),
(139, 'shop', 1, 'Тима', 'ad@min.com', '', 17251, 'Для многих это уже классика. Для меня это стиль и супер амортизация. Люблю эту модель. Хорошо будет выглядить как со спортивной одеждой так и кэжуал.', 1427729475, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 138),
(138, 'shop', 1, 'Сергей', 'ad@min.com', '', 17251, 'Кроссовки хорошие, мне понравился и внешний вид и то, как они сидят на ноге. В них комфортно, они очень легкие, мягкие, что позволяет их носить и в целях занятий спортом, а так же в повседневной жизни. Эта фирма получила популярность относительно недавно, но благодаря высокому качеству и комфорту, который она дает покупателям, многие полюбят эти кроссовки и будут покупать все чаще и больше!', 1427729417, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 4, '', '', 1, 0, 0),
(140, 'shop', 1, 'Виктор', 'ad@min.com', '', 17250, 'Красивый дизайн, качественная сборка, удобен.', 1427729666, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 4, '', '', 1, 0, 0),
(141, 'shop', 1, 'Василий П.', 'ad@min.com', '', 17252, 'Ощутить по полной разницу между занятиями с утяжелениями и без них можно после окончания тренировки, когда вы можете снять их и попробовать выполнить те же самые движения, но уже без дополнительного инвентаря.', 1427731020, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 3, '', '', 0, 0, 0),
(142, 'shop', 1, 'Sasha', 'ad@min.com', '', 17252, 'При этом не нужно забывать, что риск получить травму в таком случае увеличивается. Ведь такая нагрузка является не совсем естественной для суставов, так что будьте осторожны, не делайте неконтролируемых резких движений.', 1427731034, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 141),
(143, 'shop', 1, 'МАХ', 'ad@min.com', '', 17253, 'Удобный, надёжный рюкзак с достаточной вместительностью.', 1427736349, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 1, 0, 0),
(144, 'shop', 1, 'Николай Л.', 'ad@min.com', '', 17253, 'Как для меня - мало внешних карманов и довольно броский дизайн. Внутри ткань светлая - после длительного использовании может выглядеть неэстетично. Брелки на молнии - тканевые петли с пластмассовой вставкой - на любителя.', 1427736369, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 143),
(145, 'shop', 1, 'Вера', 'ad@min.com', '', 17253, 'Это уже мой второй рюкзак Osprey. Не могу нарадоваться на него! Во-первых, пошит очень хорошо и нитки нигде не торчат. Во-вторых, достаточно толстая ткань самого рюкзака и ее сложнее порвать. Ну и в-третьих, прочные молнии на рюкзаке. Берите, не пожалеете!', 1427736739, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 1, 0, 0),
(146, 'shop', 1, 'Иван В.', 'ad@min.com', '', 17254, 'Покупал для садово-дачных работ, небольшие деревья (до 30 см) - минутное дело, как по маслу. На 1 л топливной смеси съела около 250-300 мл масла на цепь, хотя оно довольно дешево. Убил одну цепь - в стволе вросшая стальная проволока была, два зуба с цепи исчезли и половина выгнутых и убитых, цепь - расходник, берите сразу 2-3 запасных.', 1427797102, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 4, '', '', 1, 0, 0),
(147, 'shop', 1, 'stacker', 'ad@min.com', '', 17254, 'Валили деревья до 90-100 см в диаметре.<br/>Только рекомендую предварительно RTFM что бы управлять направлением падения подпиленного дерева.<br/>Поломок небыло, главное не бояться вовремя найти где у неё фоздушный фильтр и как поступает масло на цепь. Берите модель с быстрым натяжением цепи.', 1427797139, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 1, 0, 0),
(148, 'shop', 1, 'Савелий', 'ad@min.com', '', 17254, 'Дачные потребности удовлетворяет полностью?', 1427797165, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 147),
(149, 'shop', 1, 'Андрей', 'ad@min.com', '', 17255, 'По работе: сначала немного медленно, а потом как изловчился то полторы сотки в час получалось, это один глубокий на всю глубину фрезы и один поверхностный - убрать следы. Не знаю почему везде пишут, что ширина обработки 60 см, наспради ширина по диках 78 см, по шести фрезах 75 см, четыре фрезы 53 см.', 1427799732, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 0, 0, 0),
(150, 'shop', 1, 'Георгий', 'ad@min.com', '', 17255, 'Двигатель Садко, это, конечно, не хонда или субару, но в интернете только положительные отзывы..', 1427799825, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 149),
(151, 'shop', 1, 'Маша', 'ad@min.com', '', 17256, 'для низкорослых деревьев ,кустарников и наземных растений - очень не плох', 1427800789, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 3, '', '', 0, 0, 0),
(152, 'shop', 1, 'Антон П.', 'ad@min.com', '', 17256, 'Дальность струи распыления не более 1-1.5м', 1427800866, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 151),
(154, 'shop', 1, 'Мах', 'ad@min.com', '', 17257, 'Настольный футбол - азартная и очень веселая игра. Самое интересное, как только вы начнете играть, оторваться будет очень сложно.', 1427806694, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 0, 1, 0),
(155, 'shop', 1, 'Паша ', 'ad@min.com', '', 17257, 'Это весело, это круто. Море наслаждения и удовольствия.', 1427806712, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 154),
(156, 'shop', 1, 'Катерина', 'ad@min.com', '', 17258, 'Два, три года выдерживает. Дерево отличное. Советую "качество превышает цену".', 1427808944, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 3, 1, 0),
(158, 'shop', 1, 'Оля Б.', 'ad@min.com', '', 17259, 'Все детали детского шкафа имеют безопасную округлую форму, поверхность хорошо отполированная', 1427810244, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 1, 0, 0),
(157, 'shop', 1, 'Оксана', 'ad@min.com', '', 17258, 'Стоимость кроватки указанна на 15-02-2015?', 1427808981, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 156),
(159, 'shop', 1, 'Саша', 'ad@min.com', '', 17259, 'Изделие имеет Сертификат ISO 9001?', 1427810293, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 0),
(161, 'shop', 1, 'Galina', 'ad@min.com', '', 17260, 'Очень удобный джемпер! Теплый, комфортный, мягенький. Сыночку понравился. Я покупкой довольна.', 1427814136, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 0, 0, 0),
(160, 'shop', 1, 'Administrator', 'ad@min.com', '', 17258, 'Как бы вы оценили качество сборки и фурнитуры?', 1427810496, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 156),
(162, 'shop', 1, 'Игорь', 'ad@min.com', '', 17261, 'Качество очень порадовало, сидят как влитые.', 1427815938, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 4, '', '', 0, 0, 0),
(163, 'shop', 1, 'Таня', 'ad@min.com', '', 17262, 'Тканый слинг-шарф я активно использовала прошлым летом параллельно с трикотажным шарфом, в дни, когда было жарко. Ткань этого шарфика существенно отличается по характеристикам от трикотажной: рыхлая, хорошо продуваемая, она не парила крошку летом. Благодаря хорошей "держучести" ткани, слинг можно мотать в однослойные намотки (значит по спине ребенка остается только один слой ткани), при этом не страдает поддержка спинки малыша. В тканом шарфе можно носить долго, спина фактически не чувствует веса ребенка, а крошке очень комфортно в нем спать.', 1427819904, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 4, '', '', 0, 2, 0),
(164, 'shop', 1, 'Юлия С.', 'ad@min.com', '', 17262, 'Чудесный шарфик! Тестировали намотки типа кенгуру и КНК. Слингогруз 12 кг., спина и плечи вполне нормально себя чувствуют)', 1427819954, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 5, '', '', 0, 2, 0),
(165, 'shop', 1, 'К.Л.С', 'ad@min.com', '', 17262, 'Очень много мнений "за" и "против" слинга можно найти в интернете. И самое интересное, что чаще всего мнения "против" вы можете услышать от тех, кто не пользовался слингом', 1427820059, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '213.174.5.223', 0, '', '', 0, 0, 163);

-- --------------------------------------------------------

--
-- Структура таблицы `components`
--

DROP TABLE IF EXISTS `components`;
CREATE TABLE IF NOT EXISTS `components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `identif` varchar(25) NOT NULL,
  `enabled` int(1) NOT NULL,
  `autoload` int(1) NOT NULL,
  `in_menu` int(1) NOT NULL DEFAULT '0',
  `settings` text,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `identif` (`identif`),
  KEY `enabled` (`enabled`),
  KEY `autoload` (`autoload`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=291 ;

--
-- Дамп данных таблицы `components`
--

INSERT INTO `components` (`name`, `identif`, `enabled`, `autoload`, `in_menu`, `settings`, `position`) VALUES
('user_manager', 'user_manager', 0, 0, 0, NULL, 19),
('auth', 'auth', 1, 0, 0, NULL, 28),
('comments', 'comments', 1, 1, 1, 'a:5:{s:18:"max_comment_length";i:0;s:6:"period";i:0;s:11:"can_comment";i:0;s:11:"use_captcha";b:0;s:14:"use_moderation";b:0;}', 9),
('navigation', 'navigation', 0, 0, 0, NULL, 29),
('tags', 'tags', 1, 1, 0, NULL, 27),
('gallery', 'gallery', 1, 0, 0, 'a:26:{s:14:"max_image_size";s:1:"5";s:9:"max_width";s:1:"0";s:10:"max_height";s:1:"0";s:7:"quality";s:2:"95";s:14:"maintain_ratio";b:1;s:19:"maintain_ratio_prev";b:1;s:19:"maintain_ratio_icon";b:1;s:4:"crop";b:0;s:9:"crop_prev";b:0;s:9:"crop_icon";b:0;s:14:"prev_img_width";s:3:"500";s:15:"prev_img_height";s:3:"500";s:11:"thumb_width";s:3:"100";s:12:"thumb_height";s:3:"100";s:14:"watermark_text";s:0:"";s:16:"wm_vrt_alignment";s:6:"bottom";s:16:"wm_hor_alignment";s:4:"left";s:19:"watermark_font_size";s:2:"14";s:15:"watermark_color";s:6:"ffffff";s:17:"watermark_padding";s:2:"-5";s:19:"watermark_font_path";s:25:"./uploads/defaultFont.ttf";s:15:"watermark_image";s:0:"";s:23:"watermark_image_opacity";s:2:"50";s:14:"watermark_type";s:4:"text";s:8:"order_by";s:4:"date";s:10:"sort_order";s:4:"desc";}', 13),
('rss', 'rss', 1, 0, 0, 'a:5:{s:5:"title";s:9:"Image CMS";s:11:"description";s:35:"Тестируем модуль RSS";s:10:"categories";a:1:{i:0;s:1:"3";}s:9:"cache_ttl";i:60;s:11:"pages_count";i:10;}', 14),
('menu', 'menu', 0, 1, 1, NULL, 0),
('sitemap', 'sitemap', 1, 1, 0, 'a:5:{s:12:"robotsStatus";i:0;s:11:"generateXML";i:1;s:11:"sendSiteMap";i:1;s:8:"lastSend";i:0;s:18:"sendWhenUrlChanged";i:0;}', 15),
('search', 'search', 1, 0, 0, NULL, 22),
('feedback', 'feedback', 1, 0, 0, 'a:2:{s:5:"email";s:19:"admin@localhost.loc";s:15:"message_max_len";i:550;}', 25),
('template_editor', 'template_editor', 0, 0, 0, NULL, 17),
('group_mailer', 'group_mailer', 0, 0, 1, NULL, 10),
('filter', 'filter', 1, 1, 0, NULL, 30),
('cfcm', 'cfcm', 0, 0, 0, NULL, 16),
('shop', 'shop', 1, 0, 0, NULL, 17),
('sample_mail', 'sample_mail', 0, 0, 0, NULL, 20),
('mailer', 'mailer', 1, 0, 0, NULL, 21),
('share', 'share', 1, 0, 1, 'a:6:{s:5:"vkcom";s:1:"1";s:8:"facebook";s:1:"1";s:4:"type";s:4:"none";s:13:"facebook_like";s:1:"1";s:7:"vk_like";s:1:"1";s:8:"vk_apiid";s:7:"3901548";}', 11),
('banners', 'banners', 1, 0, 0, 'a:1:{s:8:"show_tpl";i:1;}', 1),
('new_level', 'new_level', 1, 1, 1, 'a:3:{s:15:"propertiesTypes";a:2:{i:0;s:6:"scroll";i:2;s:8:"dropDown";}s:7:"columns";a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}s:5:"thema";s:18:"css/color_scheme_1";}', 6),
('shop_news', 'shop_news', 1, 1, 0, NULL, 24),
('categories_settings', 'categories_settings', 1, 1, 0, NULL, 7),
('wishlist', 'wishlist', 1, 1, 1, 'a:10:{s:11:"maxUserName";s:3:"256";s:11:"maxListName";s:3:"254";s:13:"maxListsCount";s:2:"10";s:13:"maxItemsCount";s:3:"100";s:16:"maxCommentLenght";s:3:"500";s:13:"maxDescLenght";s:4:"1000";s:15:"maxWLDescLenght";s:4:"1000";s:13:"maxImageWidth";s:3:"150";s:14:"maxImageHeight";s:3:"150";s:12:"maxImageSize";s:7:"2000000";}" }', 3),
('exchange', 'exchange', 1, 0, 1, 'a:13:{s:3:"zip";s:2:"no";s:8:"filesize";s:7:"2048000";s:7:"validIP";s:9:"127.0.0.1";s:5:"login";s:10:"ad@min.com";s:8:"password";s:5:"admin";s:11:"usepassword";s:2:"on";s:12:"userstatuses";N;s:10:"autoresize";N;s:5:"debug";N;s:5:"email";s:0:"";s:5:"brand";s:0:"";s:18:"userstatuses_after";s:1:"1";s:6:"backup";s:1:"1";}', 4),
('cmsemail', 'cmsemail', 1, 0, 1, 'a:3:{s:2:"ru";a:13:{s:4:"from";s:41:"Интернет-магазин ImageShop";s:10:"from_email";s:18:"noreplay@client.ru";s:11:"admin_email";s:14:"info@client.ru";s:5:"theme";s:41:"Интернет-магазин ImageShop";s:12:"wraper_activ";s:2:"on";s:6:"wraper";s:304:"<h2>Интернет-магазин "ImageShop"</h2>\n<div>$content</div>\n<hr />\n<p>С уважением, Интернет-магазин "ImageShop"</p>\n<p><small>Данное письмо создано автоматически, пожалуйста не отвечайте на него.</small></p>";s:8:"mailpath";s:0:"";s:8:"protocol";s:4:"mail";s:9:"smtp_host";s:0:"";s:9:"smtp_user";s:10:"ad@min.com";s:9:"smtp_pass";s:5:"admin";s:4:"port";s:0:"";s:10:"encryption";s:0:"";}s:2:"en";a:13:{s:4:"from";s:22:"Online store ImageShop";s:10:"from_email";s:19:"noreplay@client.com";s:11:"admin_email";s:15:"info@client.com";s:5:"theme";s:22:"Online store ImageShop";s:12:"wraper_activ";s:2:"on";s:6:"wraper";s:159:"<h2>Online store "ImageShop"</h2>\n<div>$content</div>\n<hr />\n<p>Sincerely, online store "ImageShop"</p>\n<p>This is an automated email, please do not reply.</p>";s:8:"mailpath";s:0:"";s:8:"protocol";s:4:"mail";s:9:"smtp_host";s:0:"";s:9:"smtp_user";s:10:"ad@min.com";s:9:"smtp_pass";s:5:"admin";s:4:"port";s:0:"";s:10:"encryption";s:0:"";}s:2:"ua";a:13:{s:4:"from";s:41:"Інтернет-магазин ImageShop";s:10:"from_email";s:22:"noreplay@client.com.ua";s:11:"admin_email";s:18:"info@client.com.ua";s:5:"theme";s:41:"Інтернет-магазин ImageShop";s:12:"wraper_activ";s:2:"on";s:6:"wraper";s:284:"<h2>Інтернет-магазин "ImageShop"</h2>\n<div>$content</div>\n<hr />\n<p>З повагою, Інтернет-магазин "ImageShop"</p>\n<p>Даний лист створено автоматично, будь ласка не відповідайте на нього.</p>";s:8:"mailpath";s:0:"";s:8:"protocol";s:4:"mail";s:9:"smtp_host";s:0:"";s:9:"smtp_user";s:10:"ad@min.com";s:9:"smtp_pass";s:5:"admin";s:4:"port";s:0:"";s:10:"encryption";s:0:"";}}', 4),
('mod_discount', 'mod_discount', 1, 1, 1, NULL, 2),
('smart_filter', 'smart_filter', 1, 0, 0, NULL, 26),
('mobile', 'mobile', 1, 1, 1, 'a:4:{s:15:"MobileVersionON";s:1:"1";s:17:"MobileVersionSite";s:21:"demoshop.imagecms.net";s:20:"MobileVersionAddress";s:23:"m.demoshop.imagecms.net";s:18:"mobileTemplatePath";s:33:"./templates/commerce_mobiles/shop";}', 7),
('trash', 'trash', 0, 1, 1, NULL, 5),
('language_switch', 'language_switch', 0, 0, 0, NULL, 23),
('star_rating', 'star_rating', 1, 0, 0, NULL, 12),
('translator', 'translator', 1, 1, 1, 'a:2:{s:11:"originsLang";s:2:"en";s:11:"editorTheme";s:6:"chrome";}', 11),
('imagebox', 'imagebox', 0, 1, 0, NULL, 18),
('sample_module', 'sample_module', 1, 1, 0, NULL, NULL),
('mod_stats', 'mod_stats', 1, 1, 0, NULL, 4),
('mod_seo', 'mod_seo', 0, 1, 1, NULL, 5),
('template_manager', 'template_manager', 1, 1, 1, NULL, NULL),
('payment_method_2checkout', 'payment_method_2checkout', 1, 0, 0, NULL, NULL),
('payment_method_oschadbank', 'payment_method_oschadbank', 1, 0, 0, NULL, NULL),
('payment_method_robokassa', 'payment_method_robokassa', 1, 0, 0, NULL, NULL),
('payment_method_webmoney', 'payment_method_webmoney', 1, 0, 0, NULL, NULL),
('payment_method_paypal', 'payment_method_paypal', 1, 0, 0, NULL, NULL),
('payment_method_liqpay', 'payment_method_liqpay', 1, 0, 0, NULL, NULL),
('payment_method_privat24', 'payment_method_privat24', 1, 0, 0, NULL, NULL),
('payment_method_sberbank', 'payment_method_sberbank', 1, 0, 0, NULL, NULL),
('payment_method_interkassa', 'payment_method_interkassa', 1, 0, 0, NULL, NULL),
('payment_method_yakassa', 'payment_method_yakassa', 1, 0, 0, NULL, NULL),
('ga_dashboard', 'ga_dashboard', 1, 1, 0, NULL, NULL),
('seo_snippets', 'seo_snippets', 1, 1, 0, NULL, NULL),
('xbanners', 'xbanners', 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `meta_title` varchar(300) DEFAULT NULL,
  `url` varchar(500) NOT NULL,
  `cat_url` varchar(260) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `prev_text` text,
  `full_text` longtext NOT NULL,
  `category` int(11) NOT NULL,
  `full_tpl` varchar(50) DEFAULT NULL,
  `main_tpl` varchar(50) NOT NULL,
  `position` smallint(5) NOT NULL,
  `comments_status` smallint(1) NOT NULL,
  `comments_count` int(9) DEFAULT '0',
  `post_status` varchar(15) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publish_date` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `showed` int(11) NOT NULL,
  `lang` int(11) NOT NULL DEFAULT '0',
  `lang_alias` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `url` (`url`(333)),
  KEY `lang` (`lang`),
  KEY `post_status` (`post_status`(4)),
  KEY `cat_url` (`cat_url`),
  KEY `publish_date` (`publish_date`),
  KEY `category` (`category`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Дамп данных таблицы `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(64, 'О магазине', '', 'o-magazine', '', 'магазине', 'О магазине', '<p>В нашем интернет-магазине Вы найдете информацию, об интересующих Вас товарах; сможете получить консультацию специалистов и купить интересующие Вас товары не выходя из дома или офиса. Сегодня наш интернет-магазин набирает все большую популярность среди интернет-пользователей. На страницах нашего магазина Вас ждет огромный выбор товаров любой тематики, представленная продукция сертифицированная, современнае, надежнае, и, что немаловажно, по приемлемым ценем.</p>\n<h2>Наша задача</h2>\n<p>Наша задача состоит не только в том, чтобы просто продать нужный товар, но и в том, чтобы информировать и просвещать покупателя. Для этого мы снимаем видеообзоры &laquo;горячих&raquo; новинок, готовим статьи и новости. Вооружившись всесторонней информацией об интересном устройстве и его главных конкурентах, Вы сможете самостоятельно принять взвешенное решение о покупке именно того товара, который Вам нужен. Нашей главной целью и основополагающим принципом в работе является удовлетворенность клиентов &mdash; как розничных покупателей, так и организаций. С некоторыми компаниями мы сотрудничаем уже более 10 лет. При решении любых вопросов мы всегда на Вашей стороне, потому что понимаем &mdash; наше будущее на 100% в Ваших руках.</p>\n<h2>Наша цель</h2>\n<p>Мы стремимся предоставить Вам максимум полезной информации о продаваемых товарах. Интернет-магазин снабжен простыми и эффективными инструментами подбора товаров по техническим характеристикам. Например, в категории вы можете задать сортировку по параметрам. Мы готовы предложить 100% совместимые сопутствующие товары, аксессуары и расходные материалы. Все товары в нашем магазине сопровождаются гарантией. Мы дорожим своей репутацией, и поэтому сознательно не продаём неофициальный или нелегальный товар без гарантии и сервисной поддержки в Украине. В конечном итоге покупка продуктов сомнительного происхождения доставляет головную боль и для продавца, и для покупателя.</p>', '', 0, '', '', 0, 0, 0, 'publish', 'Valera', 1291295776, 0, 1429278874, 339, 3, 0),
(66, 'Доставка и оплата', '', 'dostavka-i-oplata', '', 'доставка', 'Доставка', '<p>В нашем интернет-магазине вы с комфортом выберите для себя нужный товар, а после можете за считанные секунды оформить заказ и получить его в максимально короткие сроки. Менеджеры и консультанты нашего интернет-магазина с радостью помогут вам в выборе товара, подскажут наиболее оптимальный для вас метод оплаты и доставки.</p>\n<h2>Доставка</h2>\n<p>В нашем интернет-магазине предаставлены наиболее популярные, быстрые и удобные методы доставки товара покупателю. На сегодняшний день для наших покупателей актуальны такие способы доставки, как:</p>\n<ul>\n<li>Доставка службой Автомир по всему миру</li>\n<li>Доставка в отделение курьерской службы</li>\n<li>Доставка курьером до дверей квартиры или офиса</li>\n<li>Самовывоз купленныого вами товара с нашего склада или офиса</li>\n</ul>\n<h2>Оплата</h2>\n<p>Наш магазин поддерживает все доступные на данный момент методы оплаты, включая онлайн-оплату и перечисление средств на карточку либо расчетный счет. Также действует возможность оплаты курьеру при доставке. Возможность оплаты курьеру в Вашем городе уточняйте по телефону 8 800 567-43-21. Обмен и возврат товара осуществляется на протяжение 10 дней с момента покупки, а также только при наличии упаковки и гарантии купленного товара.</p>', '', 0, '', '', 1, 0, 0, 'publish', 'Valera', 1291295844, 1291295851, 1429514830, 180, 3, 0),
(67, 'Помощь', '', 'pomoshch', '', 'помощь', 'Помощь', '<p>Для того, чтобы приобрести товар в нашем магазине, Вам нужно выполнить несколько простых шагов:</p>\n<ul>\n<li>Выбрать нужный товар, воспользовавшить навигацией слева, либо поиском.</li>\n<li>Добавить товар в корзину.</li>\n<li>Перейти в корзину, выбрать способ доставки и указать Ваши контактные данные.</li>\n<li>Подтвердить заказ и выбрать способ оплаты.</li>\n</ul>\n<p>После этого наши менеджеры свяжуться с Вами и помогут с оплатой и доставкой товара, а также проконсультируют по любому вопросу.</p>', '', 0, '', '', 3, 0, 0, 'publish', 'ad@min.com', 1291295855, 1291295867, 1395046640, 114, 3, 0),
(68, 'Контакты', '', 'kontakty', '', 'контакты', 'Контакты', '<p>Менеджеры и консультанты нашего интернет-магазина всегда рады помочь вам в выборе товара или проконсультировать по поводу методов доставки и оплаты. Также мы всегда готовы выслушать и принять во внимание ваши рекомендации, чтоб улучшить сервис нашего магазина.</p>', '', 0, 'contacts.tpl', '', 4, 0, 0, 'publish', 'Valera', 1291295870, 1291295888, 1429280414, 153, 3, 0),
(75, 'Contact', '', 'kontakty', '', 'ssss', 'ssss', '<p><span id="result_box" lang="en"><span>Hot Phone</span><span>:</span> <span>0800</span> <span>80</span> <span>80 800</span><br /><br /> <span>Head office in</span> <span>Moscow</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>095</span> <span>095</span> <span>00</span> <span>00</span><br /><br /> <span>The main office</span> <span>in Kiev</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>098</span> <span>098</span> <span>00</span> <span>00</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295870, 1291295888, 1343664873, 35, 30, 68),
(76, 'Delivery', '', 'dostavka-i-oplata', '', 'support, the, delivery, service, autoworld, around, world, also, possible, all, major, cities, ukraine, and, russia, possibility, courier, your, area, please, call, desired, you, can, pick, purchased, goods, themselves, our, offices', 'We support the delivery of service Autoworld around the world. It is also possible delivery to all major cities of Ukraine and Russia (the possibility of delivery by courier in your area please call 0800820 22 22.) If desired, you can pick up the purchase', '<p><span id="result_box" lang="en"><span>We support the</span> <span>delivery of</span> <span>service</span> <span>Autoworld</span> <span>around the world.</span><br /><br /> <span>It is also possible</span> <span>delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine and Russia</span> <span>(the possibility of</span> <span>delivery</span> <span>by courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span><br /><br /> <span>If desired,</span> <span>you can</span> <span>pick up the</span> <span>purchased goods</span> <span>themselves</span> <span>in our offices.</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295844, 1291295851, 1343664842, 8, 30, 66),
(77, 'Help', '', 'pomoshch', '', 'order, purchase, goods, our, store, you, must, follow, few, simple, steps, choose, the, right, product, vospolzovavshit, navigation, left, search, add, products, cart, shopping, select, shipping, method, and, provide, your, contact', 'In order to purchase goods in our store, you must follow a few simple steps: Choose the right product, vospolzovavshit navigation on the left, or search. Add products to cart. Go to the shopping cart, select shipping method and provide your contact inform', '<p><span id="result_box" lang="en"><span>In order to</span> <span>purchase goods</span> <span>in our store,</span> <span>you must follow</span> <span>a few simple steps</span><span>:</span><br /><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Choose</span> <span>the right product,</span> <span>vospolzovavshit</span> <span>navigation</span> <span>on the left</span><span>, or</span> <span>search.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Add products</span> <span>to cart</span><span>.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Go to the</span> <span>shopping cart,</span> <span>select</span> <span>shipping method</span> <span>and provide</span> <span>your contact information.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Proceed to checkout</span> <span>and select the</span> <span>payment method.</span><br /><br /> <span>After that,</span> <span>our managers</span> <span>will contact</span> <span>you and</span> <span>help you</span> <span>with payment</span> <span>and delivery</span> <span>of the goods</span><span>, as well</span> <span>as give advice on</span> <span>any subject.</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1343664897, 11, 30, 67),
(79, 'About us', '', 'o-magazine', '', 'shop, imagecms, offers, huge, selection, vehicles, suit, every, taste, the, best, prices, our, store, has, more, than, years, and, during, that, time, was, not, single, return, goods, serve, hundreds, customers', 'Shop ImageCMS Shop offers a huge selection of vehicles to suit every taste at the best prices. Our store has more than 5 years and during that time was not a single return of the goods. We serve hundreds of customers every day and do it with joy. Buy equi', '<p><span id="result_box" lang="en"><span>Shop</span> <span>ImageCMS Shop</span> <span>offers</span> <span>a huge selection</span> <span>of vehicles</span> <span>to suit every taste</span> <span>at the best prices</span><span>.</span><br /><br /> <span>Our store</span> <span>has more than</span> <span>5 years</span> <span>and during that time</span> <span>was not a single</span> <span>return of the goods</span><span>.</span><br /><br /> <span>We serve</span> <span>hundreds of</span> <span>customers</span> <span>every day</span> <span>and do</span> <span>it with joy.</span><br /><br /> <span>Buy</span> <span>equipment from</span> <span>us and</span> <span>become the owner of</span> <span>the world''s best</span> <span>technology</span><span>!</span></span></p>', '', 0, '', '', 0, 1, 1, 'publish', 'admin', 1291295776, 1291295792, 1343745649, 5, 30, 64),
(98, 'Contacts', '', 'kontakty', '', '', '', '<p><strong>Hotline</strong>: 0 800 80 80 800</p>\n<p><strong>Main office</strong></p>\n<p>st. Gagarina 1/2</p>\n<p>tel. 095 095 00 00</p>', '', 0, '', '', 0, 0, 0, 'publish', 'admin', 1291295870, 1291295888, 1422442146, 0, 4, 68),
(99, 'Контакти', '', 'kontakty', '', '', '', '<p><strong>Гаряча лінія</strong>: 0 800 80 80 800</p>\n<p><strong>Головний офіс</strong></p>\n<p>вул. Гагаріна 1/2</p>\n<p>тел. 095 095 00 00</p>', '', 0, '', '', 0, 0, 0, 'publish', 'admin', 1291295870, 1291295888, 1422442020, 0, 5, 68),
(100, 'About shop', '', 'o-magazine', '', '', '', '<p>Shop ImageCMS Shop offers a huge selection of equipment to suit all tastes at the best prices.</p>\n<p>Our store has more than 5 years and during that time there was not a single return of the goods.</p>\n<p>We serve hundreds of customers every day and do it with joy.</p>\n<p>Buy equipment from us and become the owner of the worlds best technology !!!</p>', '', 0, '', '', 0, 0, 0, 'publish', 'admin', 1291295776, 1422434969, 1422434969, 0, 4, 64),
(101, 'Про магазин', '', 'o-magazine', '', '', '', '<p>Магазин ImageCMS Shop надає величезний вибір техніки на будь-який смак за кращими цінами.</p>\n<p>Наш магазин існує більше 5 років і за цей час не було жодного повернення товару.</p>\n<p>Ми обслуговуємо щодня сотні покупців і робимо це з радістю.</p>\n<p>Купуйте техніку у нас і стаєте власником найкращої в світі техніки !!!</p>', '', 0, '', '', 0, 0, 0, 'publish', 'admin', 1291295776, 0, 1422434783, 0, 5, 64),
(105, 'Доставка', '', 'dostavka-i-oplata', '', '', '', '<p>Ми підтримуємо доставку службою Автосвіт по всьому світу.</p>\n<p>Також можлива доставка курєром для всіх великих міст України та Росії (можливість доставки курєром у Вашому місті уточнюйте по телефону 0800820 22 22).</p>\n<p>При бажанні Ви можете самі забрати куплений товар в наших офісах.</p>', '', 0, '', '', 0, 0, 0, 'publish', 'admin', 1291295844, 1291295851, 1422441441, 0, 5, 66),
(104, 'Delivery', '', 'dostavka-i-oplata', '', '', '', '<p>We support shipping service Autoworld worldwide.</p>\n<p>It is also possible delivery to all major cities of Ukraine and Russia (the possibility of delivery by courier in your city please call 0800820 22 22).</p>\n<p>If you wish you can pick yourself goods purchased at our offices.</p>', '', 0, '', '', 0, 0, 0, 'publish', 'admin', 1291295844, 1291295851, 1422441403, 0, 4, 66),
(108, 'Help', '', 'pomoshch', '', '', '', '<p>To purchase goods in our store, you need to follow some simple steps:</p>\n<ul>\n<li>Select the right product, vospolzovavshit left navigation or search.</li>\n<li>Add this item to your cart.</li>\n<li>Go to shopping cart, choose the method of delivery and specify your contact information.</li>\n<li>To confirm the order and select the payment method.</li>\n</ul>\n<p>After that, our managers will contact you and help you with the payment and delivery of goods, as well as advise on any issue.</p>', '', 0, '', '', 0, 0, 0, 'publish', 'admin', 1291295855, 1291295867, 1422441780, 0, 4, 67),
(109, 'Допомога', '', 'pomoshch', '', '', '', '<p>Для того, щоб придбати товар в нашому магазині, Вам потрібно виконати кілька простих кроків:</p>\n<ul>\n<li>Вибрати потрібний товар, скориставшись навігацією зліва, або пошуком.</li>\n<li>Додати товар в корзину.</li>\n<li>Перейти в кошик, вибрати спосіб доставки і вказати Ваші контактні дані.</li>\n<li>Підтвердити замовлення і вибрати спосіб оплати.</li>\n</ul>\n<p>Після цього наші менеджери звяжуться з Вами і допоможуть з оплатою і доставкою товару, а також проконсультують по будь-якому питанню.</p>', '', 0, '', '', 0, 0, 0, 'publish', 'admin', 1291295855, 1291295867, 1422441947, 0, 5, 67),
(123, 'Что выбрать: нетбук или ноутбук?', '', 'chto-vybrat-netbuk-ili-noutbuk', 'novosti/', 'нетбуки, ультралегкие, компактные, недорогие, ноутбуки, полноразмерные, полнофункциональные, стоят, недешево, нужно, знать, чтобы, сделать, разумный, выгодный, выбор, наиболее, распространенные, модели, нетбуков, имеют, размер, экрана, дюймов, вес, чуть, больше, килограмма, при, таких', 'Нетбуки - ультралегкие, компактные и недорогие. Ноутбуки - полноразмерные, полнофункциональные, но и стоят недешево. Что нужно знать, чтобы сделать разумный и выгодный выбор? Нетбуки Наиболее распространённые модели нетбуков имеют размер экрана 10 дюймов,', 'Нетбуки - ультралегкие, компактные и недорогие. Ноутбуки - полноразмерные, полнофункциональные, но и стоят недешево. Что нужно знать, чтобы сделать разумный и выгодный выбор?', '<h2>Нетбуки</h2>\n<p>Наиболее распространённые модели нетбуков имеют размер экрана 10 дюймов, а вес - лишь чуть больше килограмма; при таких параметрах они легко помещаются в небольшом городском рюкзаке или даже женской сумке. Открытый нетбук можно держать на весу одной рукой, что позволяет работать с ним даже в не слишком удобной для этого обстановке.</p>\n<p>Малые габариты имеют и свои недостатки - в нетбуках негде разместить DVD-привод, поэтому, если нетбук будет не самым удачным выбором для просмотра фильмов. Вообще говоря, по своему замыслу нетбуки - это компьютеры, предназначенные в первую очередь для работы в Сети и потребления контента из интернета. Кроме того, в нетбуках используются экономичные процессоры, энергопотребление которых сильно уменьшено за счёт их упрощения и уменьшения производительности, поэтому нетбуки плохо подходят для одновременной работы в большом количестве программ, а также для запуска "тяжёлых" приложений, требующий серьёзных вычислительных ресурсов. Под стать процессору и другие комплектующие: в нетбуках редко встречается более 2 Гбайт оперативной памяти, а видеокарта не подходит даже для простых игр.</p>\n<p>Впрочем, есть и обратная сторона медали: скромная потребляемая мощность позволяет нетбукам ставить рекорды по времени работы от аккумулятора: время жизни вдали от розетки, превышающее десять часов, уже стало вполне обычным. Более того, если и этого вам недостаточно, обратите внимание на модель Samsung NC215, оснащённую солнечной батареей, подзаряжающей аккумулятор при наличии достаточного количества света - при том, что даже в темноте NC215 способен проработать в автономной режиме до 14,5 часа, то есть больше половины суток!</p>\n<p>Таким образом, если приоритетами для вас являются автономность, компактность и лёгкость при разумной стоимости, то нетбук может стать отличным приобретением, не отягощающим ни ваш кошелёк, ни вашу сумку.</p>\n<h2>Ноутбуки</h2>\n<p>Ноутбуки весят больше, клавиатура и экран у них крупнее, в них часто встроен DVD-привод, и главное - они обладают более высокой вычислительной мощностью. Тем не менее, в арсенале Samsung есть модели ноутбуков, вполне способные по весу и размерам соперничать с нетбуками: это 11,6-дюймовые 300U1A и 900X1A, 12,5-дюймовые 350U2A и 350U2B, а также сверхтонкий и сверхъизящный 13,3-дюймовый 900X3A. При лишь немного больших габаритах, чем у нетбуков, эти ноутбуки отличаются значительно более удобными клавиатурами и экранами, а также мощными процессорами Intel Core и большими объёмами памяти - и всё это при весе от 1,0 до 1,35 кг. Если вы ищете компьютер, легко умещающийся в любую сумку и при этом способный справиться с любыми задачами - обязательно обратите внимание на перечисленные выше модели.</p>\n<p>Минимальный вес наиболее типичных моделей ноутбуков с экранами размером 14" и крупнее - уже около 2 кг, но зато их мощность зачастую позволяет заменить ими серьёзный настольный компьютер, ничего не потеряв в производительности, но зато приобретя в мобильности. Мощные процессоры, ёмкие жёсткие диски и большие объёмы памяти таких ноутбуков позволяют с лёгкостью не только потреблять, но и создавать контент - редактировать видеофайлы, обрабатывать фотографии и собирать большие музыкальные библиотеки. Однако имейте в виду: чем выше производительность такого компьютера, тем больше вы будете тратить сил, чтобы носить его с собой, и электроэнергии, чтобы обеспечить питание. Самые мощные из ноутбуков, модели с экраном диагональю 17,3 дюйма - например, игровой ноутбук с 3D-экраном Samsung 700G7A - портативными можно назвать уже лишь условно: их размеры таковы, что они поместятся не во всякую сумку.</p>\n<p>Так что, если мобильность и возможность носить ноутбук на плече, не уставая, для вас находятся на втором месте, а главное - возможность с полной скоростью работать с любыми программами, включая компьютерные игры и создание контента, то обратите внимание на мощные модели ноутбуков с экранами с диагональю 14 дюймов и выше.</p>\n<h2>Созидание или потребление: выбор за вами</h2>\n<p>Что Вы делаете чаще - создаете или потребляете информацию? Обрабатываете фотографии или отвечаете на письма? Сводите огромные таблицы в Excel или просматриваете отчёты в PDF? Стиль вашей работы во многом определяет ваш выбор: если вам нужна возможность создания больших объёмов информации, выбирайте ноутбук; если вы цените лёгкость, мобильность и возможность в любой момент получить доступ к нужной вам информации - обратите внимание на нетбуки. И не забывайте, что Samsung может предложить вам решения на все случаи жизни, позволив вам сделать обдуманный выбор.</p>', 69, '', '', 0, 0, 0, 'publish', 'Valera', 1425923398, 1425923398, 1429267867, 14, 3, 0),
(122, 'Sony представляет Walkman NW-ZX2 с аудио высокого разрешения', '', 'sony-predstavliaet-walkman-nw-zx2-s-audio-vysokogo-razresheniia', 'novosti/', 'семейство, легендарных, плееров, sony, walkman, reg, пополнилось, новой, флагманской, моделью, созданной, специально, истинных, ценителей, музыки, поддержкой, аудио, высокого, разрешения, high, resolution, audio, целый, симфонический, оркестр, вашем, кармане, получаете, звук, превосходящий', 'Семейство легендарных плееров Sony Walkman пополнилось новой флагманской моделью, созданной специально для истинных ценителей музыки. Walkman NW-ZX2 с поддержкой аудио высокого разрешения (High Resolution Audio)  это целый симфонический оркестр в вашем ка', '<p>Семейство легендарных плееров Sony Walkman пополнилось новой флагманской моделью, созданной специально для истинных ценителей музыки. Walkman NW-ZX2 с поддержкой аудио высокого разрешения (High Resolution Audio) - это целый симфонический оркестр в вашем кармане. Вы получаете звук, превосходящий по качеству компакт-диски, и можете наслаждаться непревзойденной чистотой звучания, где бы вы ни были.</p>', '<p>Аналоговый звук, преобразованный в такие цифровые форматы, как CD и MP3, обычно теряет свою первоначальную чистоту. В случае с аудио высокого разрешения (High Resolution Audio) в процессе преобразования сохраняется гораздо больше звуковых оттенков, что позволяет наслаждаться более естественной и эмоционально насыщенной музыкой.</p>\n<p><img src="/uploads/images/news/news-big.jpg" width="1046" height="288" /></p>\n<p>Стильный Walkman NW-ZX2 - это превосходный "исполнитель", каждая деталь которого призвана обеспечить звук, передающий все нюансы и эмоции оригинальной композиции.</p>\n<p>Цифровой усилитель Sony S-Master HX улучшает аудиосигнал, не сжимая его, что гарантирует кристально чистый звук высокого разрешения. Совершенная технология обеспечивает точное усиление аудиосигнала с максимально широким динамическим диапазоном и одновременное подавление шума и искажений.</p>\n<p>Дополнительная обработка сигнала в модуле DSEE HX воссоздает важную высокочастотную составляющую звука, которая теряется в сжатых звуковых файлах. Качество звука при воспроизведении CD и MP3 повышается благодаря увеличению частоты дискретизации и битовой глубины и приближается к качеству аудио высокого разрешения (192 кГц/24 бита).</p>\n<p>Благодаря невероятному многообразию музыкальных оттенков вы слышите музыку так, как если бы находились в студии или концерном зале.</p>\n<p>С первого прикосновения к Walkman NW-ZX2 становится понятно, что он создан для настоящих ценителей качества. Корпус плеера изготовлен из алюминиевого сплава высокого качества и имеет исключительную прочность, а покрытая золотом медная пластина внутри уменьшает электромагнитные наводки на компоненты внутри корпуса, внося свой вклад в общее качество звука.</p>\n<p>Впечатляющий перечень других инженерных решений приведет в восторг любого истинного аудиофила. Значительно улучшен источник питания плеера, в котором теперь используется конденсатор высшего класса и повышенной мощности для сглаживания перепадов напряжения и сохранения глубокого баса даже на максимальной громкости.</p>\n<p>Все каскады тракта аудиосигнала улучшены с помощью толстопленочных печатных плат с медным покрытием, OFC-кабелей (с использованием бескислородной меди), а также бессвинцового припоя высокой степени очистки. Качество звука еще больше повышается благодаря тщательно подобранным компонентам, среди которых катушки, MELF-резисторы и пленочные конденсаторы с превосходными характеристиками.</p>\n<p>Вместо одного источника тактовых импульсов теперь используется два с отдельными кварцевыми генераторами - 44,1/88,2/176,4 кГц (CD/DSD) и 48/96/192 кГц. Благодаря улучшенному разделению стереосигнала вы получаете исключительно четкий и чистый звук независимо от формата и характеристик музыкального файла.</p>\n<p>Модель NW-ZX2 - это первый в истории плеер Walkman с поддержкой кодека LDAC. Эта новая технология компании Sony позволяет наслаждаться высококачественным звуком, передаваемым по каналу Bluetooth. Благодаря в три раза более эффективной передаче данных (чем у обычных подключений Bluetooth[1]) технология LDAC предлагает более высокое качество звука при использовании беспроводных устройств. Функция сопряжения в одно касание, реализованная с помощью технологии NFC, позволяет подключать беспроводные устройства к Walkman практически мгновенно.</p>\n<p>Истинные любители музыки по достоинству оценят большой объем встроенной памяти (128 ГБ), предоставляющий достаточно места для музыкальной коллекции высокого разрешения. Учитывая возможность расширения памяти до 256 ГБ (с помощью дополнительной карты microSD), у вас будет достаточно места для сохранения более 1700 композиций в виде аудиофайлов высокого разрешения (из расчета 150 МБ на одну композицию). Кроме того, благодаря новой литий-ионной батарее время автономного воспроизведения увеличено до 60 часов (для МР3 файлов).</p>', 69, '', '', 0, 0, 0, 'publish', 'Valera', 1425923134, 1425923134, 1429278611, 15, 3, 0),
(121, 'Встречайте новую коллекцию наушников!', '', 'vstrechaite-novuiu-kollektsiiu-naushnikov', 'novosti/', 'культовая, компания, koss, вот, более, полувека, выпускает, очень, качественную, продукцию, устает, радовать, своих, поклонников, интересными, новинками, предновогодний, месяц, обещает, быть, ярким, ведь, продажу, поступят, сразу, несколько, новых, интересных, наушников, накладные', 'Культовая компания Koss вот уже более полувека выпускает очень качественную продукцию и не устает радовать своих поклонников интересными новинками. Предновогодний месяц обещает быть ярким, ведь в продажу поступят сразу несколько новых интересных наушников', '<p>Культовая компания Koss вот уже более полувека выпускает очень качественную продукцию и не устает радовать своих поклонников интересными новинками. Предновогодний месяц обещает быть ярким, ведь в продажу поступят сразу несколько новых интересных наушников: накладные SP330, полноразмерные портативные SP540, профессиональные Pro4S, а также домашние BT540i с возможностью беспроводной передачи.</p>', '<p>Компания выпустила новую продукцию на любой вкус, а мы с удовольствием расскажем про каждую новинку!</p>\n<p>Твоя музыка всегда с тобой с помощью легких портативных мини-мониторных шумоизолирующих наушников KOSS SP330! Эргономичный дизайн, удобная посадка благодаря особым D-образным амбушюрам, покрытие soft-touch, металлические петли, односторонний съемный кабель - всё это делает данную модель не только удобной, но и позволяет насладиться превосходным звучанием.</p>\n<img src="../../../uploads/images/Image%2015.jpg" alt="" width="959" height="259" />\n<p>Почувствуйте все грани любимой музыки с ультра легкими компактными мониторными наушниками KOSS SP540! Они очень приятные на ощупь благодаря материалам soft-touch, приятные взору благодаря металлическим элементам и приятные уху благодаря знаменитому аудио качеству компании KOSS. Помимо всего выше перечисленного, у SP540 ассиметричные амбушюры D-формы, повторяющие и запоминающие форму уха слушателя, функция пассивного шумоподавления, усиленные металлические петли и поворотные на 180 градусов чашки, что делает их удобными для хранения и перевозки.</p>\n<p>Создай свой неповторимый звук с мощными студийными наушниками KOSS Pro4S. Бесконечно удобные, с уникальными чашками D-формы, мягкими амбушюрами и легкой конструкцией с металлическими вставками - эти чудесные наушники откроют для вас звучание любимой музыки совершенно по-новому, и подарят бесконечное чувство комфорта, даже при длительном использовании. KOSS Pro4S прекрасно подходят для студийной работы, они выделяются улучшенной звукоизоляцией, наличием разъема для кабеля на обеих чашках и возможностью подключить еще одну пару наушников.</p>\n<p>Всегда и везде будьте на связи с помощью мощных беспроводных полноразмерных наушников KOSS BT540i. Эти элегантные, очень удобные наушники с легкой складной конструкцией и функцией пассивного шумоподавления не только дарят качественное чистое звучание, но и предоставляют возможность передачи аудиосигнала по Bluetooth-соединению. BT540i отличают звуковые катушки из бескислородной меди, глубокие басы с четкой звукопередачей, поддержка протокола aptX и технологии малого радиуса NFC.</p>\n<p>Имея такое разнообразие новинок, мы уверены, что каждая модель найдет своего покупателя, потому что KOSS - это всегда очень хорошее качество звука!</p>', 69, '', '', 0, 0, 0, 'publish', 'Administrator', 1425645264, 1425645264, 1425923999, 21, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `content_fields`
--

DROP TABLE IF EXISTS `content_fields`;
CREATE TABLE IF NOT EXISTS `content_fields` (
  `field_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `weight` int(11) NOT NULL,
  `in_search` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`field_name`),
  UNIQUE KEY `field_name` (`field_name`),
  KEY `type` (`type`),
  KEY `in_search` (`in_search`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `content_fields`
--

INSERT INTO `content_fields` (`field_name`, `type`, `label`, `data`, `weight`, `in_search`) VALUES
('field_list_image', 'text', 'Изображение в списке', 'a:7:{s:5:"label";s:38:"Изображение в списке";s:7:"initial";s:0:"";s:9:"help_text";s:109:"Это изображение будет выводиться на странице списка статей";s:4:"type";s:4:"text";s:20:"enable_image_browser";s:1:"1";s:10:"validation";s:0:"";s:6:"groups";a:1:{i:0;s:2:"13";}}', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `content_fields_data`
--

DROP TABLE IF EXISTS `content_fields_data`;
CREATE TABLE IF NOT EXISTS `content_fields_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(15) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `item_type` (`item_type`),
  KEY `field_name` (`field_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `content_fields_data`
--

INSERT INTO `content_fields_data` (`id`, `item_id`, `item_type`, `field_name`, `data`) VALUES
(26, 122, 'page', 'field_list_image', '/uploads/images/news/news-2.jpg'),
(25, 121, 'page', 'field_list_image', 'http://lightnew.siteimage.com.ua/uploads/images/i.jpg'),
(27, 123, 'page', 'field_list_image', '/uploads/images/news/news-1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `content_fields_groups_relations`
--

DROP TABLE IF EXISTS `content_fields_groups_relations`;
CREATE TABLE IF NOT EXISTS `content_fields_groups_relations` (
  `field_name` varchar(64) NOT NULL,
  `group_id` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `content_fields_groups_relations`
--

INSERT INTO `content_fields_groups_relations` (`field_name`, `group_id`) VALUES
('field_sfsdfsdf', 0),
('field_sfsdfsdf', 0),
('field_fyjtyutyu', 0),
('field_fg12', 0),
('field_fg12', 0),
('field_list_image', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `content_field_groups`
--

DROP TABLE IF EXISTS `content_field_groups`;
CREATE TABLE IF NOT EXISTS `content_field_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `content_field_groups`
--

INSERT INTO `content_field_groups` (`id`, `name`, `description`) VALUES
(13, 'Новости', '');

-- --------------------------------------------------------

--
-- Структура таблицы `content_permissions`
--

DROP TABLE IF EXISTS `content_permissions`;
CREATE TABLE IF NOT EXISTS `content_permissions` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `content_permissions`
--

INSERT INTO `content_permissions` (`id`, `page_id`, `data`) VALUES
(23, 80, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `content_tags`
--

DROP TABLE IF EXISTS `content_tags`;
CREATE TABLE IF NOT EXISTS `content_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_type_id` int(11) NOT NULL,
  `field_name` varchar(64) NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  `validators` varchar(255) DEFAULT NULL,
  `entity` varchar(32) DEFAULT NULL,
  `options` varchar(65) DEFAULT NULL,
  `classes` text,
  `position` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Дамп данных таблицы `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `field_type_id`, `field_name`, `is_required`, `is_active`, `is_private`, `validators`, `entity`, `options`, `classes`, `position`) VALUES
(96, 0, 'city', 0, 1, 0, NULL, 'user', NULL, '', NULL),
(97, 0, 'city', 0, 1, 0, NULL, 'order', NULL, '', NULL),
(99, 0, 'addphone', 0, 1, 0, NULL, 'user', NULL, '', NULL),
(100, 0, 'addphone', 0, 1, 0, NULL, 'order', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `custom_fields_data`
--

DROP TABLE IF EXISTS `custom_fields_data`;
CREATE TABLE IF NOT EXISTS `custom_fields_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `field_data` text,
  `locale` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=516 ;

--
-- Дамп данных таблицы `custom_fields_data`
--

INSERT INTO `custom_fields_data` (`id`, `field_id`, `entity_id`, `field_data`, `locale`) VALUES
(514, 97, 51, '', 'ru'),
(515, 96, 53, 'test', 'ru');

-- --------------------------------------------------------

--
-- Структура таблицы `custom_fields_i18n`
--

DROP TABLE IF EXISTS `custom_fields_i18n`;
CREATE TABLE IF NOT EXISTS `custom_fields_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(4) NOT NULL,
  `field_label` varchar(255) DEFAULT NULL,
  `field_description` text,
  `possible_values` text,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `custom_fields_i18n`
--

INSERT INTO `custom_fields_i18n` (`id`, `locale`, `field_label`, `field_description`, `possible_values`) VALUES
(96, 'ru', 'Город', '', NULL),
(97, 'ru', 'Город', '', NULL),
(99, 'ru', 'Доп. телефон', '', NULL),
(100, 'ru', 'Доп. телефон', '', NULL),
(96, 'en', 'City', '', NULL),
(97, 'en', 'City', '', NULL),
(99, 'en', 'Additional phone', '', NULL),
(100, 'en', 'Additional phone', '', NULL),
(96, 'ua', 'Місто', '', NULL),
(97, 'ua', 'Місто', '', NULL),
(99, 'ua', 'Дод. телефон', '', NULL),
(100, 'ua', 'Дод. телефон', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `template` text CHARACTER SET utf8 NOT NULL,
  `settings` text CHARACTER SET utf8 NOT NULL,
  `locale` varchar(5) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`name`, `template`, `settings`, `locale`, `description`) VALUES
('wishListMail', 'Шановний %userName%. Ви створили наступний список побажань %wishKey%<br>Створений: %wishDateCreated%  ', 'a:4:{s:5:"theme";s:29:"Список побажань";s:4:"from";s:43:"Адміністрація магазину";s:9:"from_mail";s:19:"admin@localhost.loc";s:9:"variables";a:3:{i:0;s:10:"%userName%";i:1;s:9:"%wishKey%";i:2;s:17:"%wishDateCreated%";}}', 'ua', 'Лист про створений список побажань  '),
('wishListMail', '<h2> Уважаемый %userName%.</h2> Вы создали следующий список желаний %wishKey%<div>Ссылка на просмотр списка желаний -&nbsp;&nbsp; %wishLink% <br>Создан %wishDateCreated%   %orderId% </div>  ', 'a:5:{s:5:"theme";s:14:"Вишлист";s:4:"from";s:43:"Администрация магазина";s:9:"from_mail";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Письмо о создании списка желаний.  '),
('noticeOfAppearance', 'Шаблон письма  ', 'a:5:{s:5:"theme";s:46:"Уведомлениен о появлении";s:4:"from";s:37:"Администрация сайта";s:9:"from_mail";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма об уведомлении о появлении  '),
('callBackNotification', 'Callback notification  ', 'a:5:{s:5:"theme";s:8:"Callback";s:4:"from";s:24:"Пользователь";s:10:"from_email";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма для callback  '),
('toAdminOrderNotification', 'Шаблон письма для администратора о совершении заказа  ', 'a:5:{s:5:"theme";s:59:"Уведомление о совершении заказа";s:4:"from";s:34:"Админ панель сайта";s:10:"from_email";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма для администратора о совершении заказа    '),
('toUserOrderNotification', 'Здравствуйте, %userName%.<br><br>Мы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop"<br><br>Вы указали следующие контактные данные:<br><br>Email адрес: %userEmail%<br><br>Номер телефона: %userPhone%<br><br>Адрес доставки: %userDeliver%<br><br>Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.<br><br>Также, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:&nbsp; %orderLink%.<br><br>Спасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.<br><br>При возникновении любых вопросов, обращайтесь за телефонами:<br><br>+7 (095) 222-33-22 +38 (098) 222-33-22  ', 'a:5:{s:5:"theme";s:80:"Уведомление покупателя о совершении заказа";s:4:"from";b:0;s:9:"from_mail";s:21:"noreply@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Уведомление покупателя о совершении заказа  '),
('toUserChangeOrderStatusNotification', 'Уведомление пользователя о смене статуса заказа    ', 'a:5:{s:5:"theme";s:89:"Уведомление пользователя о смене статуса заказа";s:4:"from";s:37:"Администрация сайта";s:10:"from_email";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Уведомление пользователя о смене статуса заказа    '),
('afterOrderUserRegistration', 'Письмо о регистрации на сатйе после совершения заказа  ', 'a:5:{s:5:"theme";s:38:"Регистрация на сайте";s:4:"from";s:43:"Администрация магазина";s:10:"from_email";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Письмо о регистрации на сатйе после совершения заказа    '),
('forgotPassword', 'Здравствуйте!<br><br>На сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.<br><br>Для завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri%<br><br>Ваш новый пароль для входа: %password%<br><br>Если это письмо попало к Вам по ошибке просто проигнорируйте его.<br><br>При возникновении любых вопросов, обращайтесь по телефонам:<br><br>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89<br><br>---<br><br>С уважением,<br><br>сотрудники службы продаж %webSiteName%  ', 'a:5:{s:5:"theme";s:41:"Восстановление пароля";s:4:"from";s:37:"Администрация сайта";s:9:"from_mail";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма о восстановлении пароля  '),
('wishListMail', 'Шановний %userName%. Ви створили наступний список побажань %wishKey%<br>Створений: %wishDateCreated%  ', 'a:4:{s:5:"theme";s:29:"Список побажань";s:4:"from";s:43:"Адміністрація магазину";s:9:"from_mail";s:19:"admin@localhost.loc";s:9:"variables";a:3:{i:0;s:10:"%userName%";i:1;s:9:"%wishKey%";i:2;s:17:"%wishDateCreated%";}}', 'ua', 'Лист про створений список побажань  '),
('wishListMail', '<h2> Уважаемый %userName%.</h2> Вы создали следующий список желаний %wishKey%<div>Ссылка на просмотр списка желаний -&nbsp;&nbsp; %wishLink% <br>Создан %wishDateCreated%   %orderId% </div>  ', 'a:5:{s:5:"theme";s:14:"Вишлист";s:4:"from";s:43:"Администрация магазина";s:9:"from_mail";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Письмо о создании списка желаний.  '),
('noticeOfAppearance', 'Шаблон письма  ', 'a:5:{s:5:"theme";s:46:"Уведомлениен о появлении";s:4:"from";s:37:"Администрация сайта";s:9:"from_mail";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма об уведомлении о появлении  '),
('callBackNotification', 'Callback notification  ', 'a:5:{s:5:"theme";s:8:"Callback";s:4:"from";s:24:"Пользователь";s:10:"from_email";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма для callback  '),
('toAdminOrderNotification', 'Шаблон письма для администратора о совершении заказа  ', 'a:5:{s:5:"theme";s:59:"Уведомление о совершении заказа";s:4:"from";s:34:"Админ панель сайта";s:10:"from_email";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма для администратора о совершении заказа    '),
('toUserOrderNotification', 'Здравствуйте, %userName%.<br><br>Мы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop"<br><br>Вы указали следующие контактные данные:<br><br>Email адрес: %userEmail%<br><br>Номер телефона: %userPhone%<br><br>Адрес доставки: %userDeliver%<br><br>Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.<br><br>Также, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:&nbsp; %orderLink%.<br><br>Спасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.<br><br>При возникновении любых вопросов, обращайтесь за телефонами:<br><br>+7 (095) 222-33-22 +38 (098) 222-33-22  ', 'a:5:{s:5:"theme";s:80:"Уведомление покупателя о совершении заказа";s:4:"from";b:0;s:9:"from_mail";s:21:"noreply@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Уведомление покупателя о совершении заказа  '),
('toUserChangeOrderStatusNotification', 'Уведомление пользователя о смене статуса заказа    ', 'a:5:{s:5:"theme";s:89:"Уведомление пользователя о смене статуса заказа";s:4:"from";s:37:"Администрация сайта";s:10:"from_email";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Уведомление пользователя о смене статуса заказа    '),
('afterOrderUserRegistration', 'Письмо о регистрации на сатйе после совершения заказа  ', 'a:5:{s:5:"theme";s:38:"Регистрация на сайте";s:4:"from";s:43:"Администрация магазина";s:10:"from_email";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Письмо о регистрации на сатйе после совершения заказа    '),
('forgotPassword', 'Здравствуйте!<br><br>На сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.<br><br>Для завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri%<br><br>Ваш новый пароль для входа: %password%<br><br>Если это письмо попало к Вам по ошибке просто проигнорируйте его.<br><br>При возникновении любых вопросов, обращайтесь по телефонам:<br><br>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89<br><br>---<br><br>С уважением,<br><br>сотрудники службы продаж %webSiteName%  ', 'a:5:{s:5:"theme";s:41:"Восстановление пароля";s:4:"from";s:37:"Администрация сайта";s:9:"from_mail";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма о восстановлении пароля  ');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_albums`
--

DROP TABLE IF EXISTS `gallery_albums`;
CREATE TABLE IF NOT EXISTS `gallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `cover_id` int(11) NOT NULL DEFAULT '0',
  `position` int(9) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `tpl_file` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `created` (`created`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_albums_i18n`
--

DROP TABLE IF EXISTS `gallery_albums_i18n`;
CREATE TABLE IF NOT EXISTS `gallery_albums_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `description` text NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_category`
--

DROP TABLE IF EXISTS `gallery_category`;
CREATE TABLE IF NOT EXISTS `gallery_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_id` int(11) NOT NULL DEFAULT '0',
  `position` int(9) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_category_i18n`
--

DROP TABLE IF EXISTS `gallery_category_i18n`;
CREATE TABLE IF NOT EXISTS `gallery_category_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `description` text,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `file_name` varchar(150) NOT NULL,
  `file_ext` varchar(8) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `position` int(9) NOT NULL,
  `width` int(6) NOT NULL,
  `height` int(6) NOT NULL,
  `uploaded` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_images_i18n`
--

DROP TABLE IF EXISTS `gallery_images_i18n`;
CREATE TABLE IF NOT EXISTS `gallery_images_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(100) NOT NULL,
  `identif` varchar(10) NOT NULL,
  `image` text NOT NULL,
  `folder` varchar(100) NOT NULL,
  `template` varchar(100) NOT NULL,
  `default` int(1) NOT NULL,
  `locale` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `identif` (`identif`),
  KEY `default` (`default`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `identif`, `image`, `folder`, `template`, `default`, `locale`) VALUES
(3, 'Русский', 'ru', '', 'russian', 'commerce', 1, 'ru_RU'),
(4, 'Английский', 'en', '', 'english', 'commerce', 0, 'en_US'),
(5, 'Украинский', 'ua', '', 'ukrainian', 'commerce', 0, 'uk_UA');

-- --------------------------------------------------------

--
-- Структура таблицы `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip_address` (`ip_address`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1127 ;

--
-- Дамп данных таблицы `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `username`, `message`, `date`) VALUES
(741, 1, 'admin', 'Вышел из панели управления', 1363601996),
(1126, 49, 'admin', 'Введен IP панели управления 127.0.0.1', 1387375239);

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `date` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `main_title` varchar(300) NOT NULL,
  `tpl` varchar(255) DEFAULT NULL,
  `expand_level` int(255) DEFAULT NULL,
  `description` text,
  `created` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `menus`
--

INSERT INTO `menus` (`id`, `name`, `main_title`, `tpl`, `expand_level`, `description`, `created`) VALUES
(4, 'top_menu', 'Top menu', 'top_menu', 0, 'Menu at the top of the template', '2013-12-18 13:35:13');

-- --------------------------------------------------------

--
-- Структура таблиці `menus_data`
--

DROP TABLE IF EXISTS `menus_data`;
CREATE TABLE IF NOT EXISTS `menus_data` (
  `id` int(11) NOT NULL,
  `menu_id` int(9) NOT NULL,
  `item_id` int(9) NOT NULL,
  `item_type` varchar(15) NOT NULL,
  `item_image` varchar(255) DEFAULT NULL,
  `roles` text,
  `hidden` smallint(1) NOT NULL DEFAULT '0',
  `title` varchar(300) NOT NULL,
  `parent_id` int(9) NOT NULL,
  `position` smallint(5) DEFAULT NULL,
  `description` text,
  `add_data` text
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `menus_data`
--

INSERT INTO `menus_data` (`id`, `menu_id`, `item_id`, `item_type`, `item_image`, `roles`, `hidden`, `title`, `parent_id`, `position`, `description`, `add_data`) VALUES
(10, 1, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(8, 1, 0, 'url', '', '', 0, 'Главная', 0, 1, NULL, 'a:2:{s:3:"url";s:1:"/";s:7:"newpage";s:1:"0";}'),
(9, 1, 64, 'page', '', '', 0, 'О магазине', 0, 2, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(11, 1, 0, 'url', '', '', 0, 'Доставка', 0, 4, NULL, 'a:2:{s:3:"url";s:9:"/dostavka";s:7:"newpage";s:1:"0";}'),
(12, 1, 0, 'url', '', '', 0, 'Помощь', 0, 5, NULL, 'a:2:{s:3:"url";s:5:"/help";s:7:"newpage";s:1:"0";}'),
(13, 1, 0, 'url', '', '', 0, 'Контакты', 0, 6, NULL, 'a:2:{s:3:"url";s:11:"/contact_us";s:7:"newpage";s:1:"0";}'),
(15, 4, 64, 'page', '', '', 0, 'О магазине', 0, 1, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(16, 4, 66, 'page', NULL, '', 0, 'Доставка и оплата', 0, 2, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";i:0;}'),
(17, 4, 67, 'page', '', '', 0, 'Помощь', 0, 3, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(18, 4, 68, 'page', '', '', 0, 'Контакты', 0, 6, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(19, 5, 0, 'url', '', '', 0, 'Главная', 0, 1, NULL, 'a:2:{s:3:"url";s:1:"/";s:7:"newpage";s:1:"0";}'),
(20, 5, 0, 'url', '', '', 0, 'Видео', 0, 2, NULL, 'a:2:{s:3:"url";s:20:"/shop/category/video";s:7:"newpage";s:1:"0";}'),
(21, 5, 64, 'page', '', '', 0, 'О магазине', 0, 3, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(22, 5, 0, 'url', '', '', 0, 'Домашнее  аудио', 0, 4, NULL, 'a:2:{s:3:"url";s:30:"/shop/category/domashnee_audio";s:7:"newpage";s:1:"0";}'),
(23, 5, 66, 'page', '', '', 0, 'Доставка и оплата', 0, 5, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(24, 5, 0, 'url', '', '', 0, 'Фото и камеры', 0, 6, NULL, 'a:2:{s:3:"url";s:28:"/shop/category/foto_i_kamery";s:7:"newpage";s:1:"0";}'),
(25, 5, 67, 'page', '', '', 0, 'Помощь', 0, 7, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(26, 5, 0, 'url', '', '', 0, 'Домашняя электроника', 0, 8, NULL, 'a:2:{s:3:"url";s:38:"/shop/category/domashniaia_elektronika";s:7:"newpage";s:1:"0";}'),
(27, 5, 68, 'page', '', '', 0, 'Контакты', 0, 9, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(28, 5, 0, 'url', '', '', 0, 'Авто музыка и видео', 0, 10, NULL, 'a:2:{s:3:"url";s:34:"/shop/category/avto_muzyka_i_video";s:7:"newpage";s:1:"0";}'),
(40, 4, 69, 'category', NULL, '', 0, 'Новости', 0, 4, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(51, 4, 0, 'url', '', '', 0, 'Бренды', 0, 5, NULL, 'a:2:{s:3:"url";s:10:"shop/brand";s:7:"newpage";i:0;}');

--
-- Структура таблиці `menu_translate`
--

DROP TABLE IF EXISTS `menu_translate`;
CREATE TABLE IF NOT EXISTS `menu_translate` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `menu_translate`
--

INSERT INTO `menu_translate` (`id`, `item_id`, `lang_id`, `title`) VALUES
(31, 8, 3, 'Главная'),
(5, 9, 3, 'О Магазине'),
(7, 13, 3, 'Контакты'),
(11, 10, 3, 'Оплата'),
(15, 12, 3, 'Помощь'),
(52, 14, 3, 'Главная'),
(55, 15, 3, 'О магазине'),
(58, 16, 3, 'Доставка и оплата'),
(64, 17, 3, 'Помощь'),
(70, 18, 3, 'Контакты'),
(29, 19, 3, 'Главная'),
(33, 20, 3, 'Видео'),
(36, 21, 3, 'О магазине'),
(38, 22, 3, 'Домашнее аудио'),
(40, 23, 3, 'Доставка и оплата'),
(42, 24, 3, 'Фото и камеры'),
(44, 25, 3, 'Помощь'),
(46, 26, 3, 'Домашняя электроника'),
(48, 27, 3, 'Контакты'),
(50, 28, 3, 'Авто музыка и видео'),
(53, 14, 4, 'Main'),
(54, 14, 5, 'Головна'),
(56, 15, 4, 'About store'),
(57, 15, 5, 'Про магазин'),
(59, 16, 4, 'Shipping'),
(60, 16, 5, 'Доставка'),
(61, 48, 3, 'Оплата'),
(62, 48, 4, 'Payment'),
(63, 48, 5, 'Оплата'),
(65, 17, 4, 'Help'),
(66, 17, 5, 'Допомога'),
(67, 40, 3, 'Новости'),
(68, 40, 4, 'News'),
(69, 40, 5, 'Новини'),
(71, 18, 4, 'Contact Information'),
(72, 18, 5, 'Контакты'),
(73, 41, 3, 'О магазине'),
(74, 41, 4, 'About'),
(75, 41, 5, 'Про магазин'),
(76, 42, 3, 'Доставка'),
(77, 42, 4, 'Shipping'),
(78, 42, 5, 'Доставка'),
(79, 50, 3, 'Оплата'),
(80, 50, 4, 'Payment'),
(81, 50, 5, 'Оплата'),
(82, 43, 3, 'Помощь'),
(83, 43, 4, 'Help'),
(84, 43, 5, 'Допомога'),
(85, 37, 3, 'Новости'),
(86, 37, 4, 'News'),
(87, 37, 5, 'Новини'),
(88, 49, 3, 'Контакты'),
(89, 49, 4, 'Contact Information'),
(90, 49, 5, 'Контакти'),
(91, 44, 3, 'Помощь'),
(92, 44, 4, 'Help'),
(93, 44, 5, 'Допомога'),
(94, 45, 3, 'Оплата'),
(95, 45, 4, 'Payment'),
(96, 45, 5, 'Оплата'),
(98, 47, 3, 'Доставка'),
(99, 47, 4, 'Shipping'),
(100, 47, 5, 'Доставка'),
(101, 46, 3, 'О сайте'),
(102, 46, 4, 'About'),
(103, 46, 5, 'Про сайт'),
(104, 51, 3, 'Бренды');

--
-- Структура таблицы `mod_banner`
--

DROP TABLE IF EXISTS `mod_banner`;
CREATE TABLE IF NOT EXISTS `mod_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(4) NOT NULL,
  `active_to` int(11) DEFAULT NULL,
  `where_show` text,
  `group` text,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `mod_banner`
--

INSERT INTO `mod_banner` (`id`, `active`, `active_to`, `where_show`, `group`, `position`) VALUES
(3, 0, -1, 'a:1:{i:0;s:6:"main_0";}', 'b:0;', 0),
(4, 0, -1, 'a:1:{i:0;s:6:"main_0";}', 'b:0;', 1),
(5, 0, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:13:"leftStartPage";}', 0),
(6, 0, -1, 'a:1:{i:0;s:6:"main_0";}', '', 0),
(7, 0, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:14:"rightStartPage";}', 0),
(8, 0, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:14:"rightStartPage";}', 0),
(9, 0, -1, 'a:1:{i:0;s:18:"shop_category_3019";}', NULL, 0),
(10, 0, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:13:"leftStartPage";}', 0),
(11, 0, -1, 'a:1:{i:0;s:6:"main_0";}', '', 0),
(12, 0, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:14:"rightStartPage";}', 0),
(13, 0, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:14:"rightStartPage";}', 0),
(14, 0, -1, 'a:1:{i:0;s:6:"main_0";}', '', 0),
(15, 0, -1, 'a:1:{i:0;s:6:"main_0";}', '', 1),
(16, 0, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:10:"right-main";}', 2),
(17, 0, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:10:"right-main";}', 3),
(18, 1, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:13:"leftStartPage";}', 0),
(19, 1, -1, 'a:1:{i:0;s:6:"main_0";}', '', 0),
(20, 1, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:14:"rightStartPage";}', 0),
(21, 1, -1, 'a:1:{i:0;s:7:"default";}', 'a:1:{i:0;s:14:"rightStartPage";}', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_banner_groups`
--

DROP TABLE IF EXISTS `mod_banner_groups`;
CREATE TABLE IF NOT EXISTS `mod_banner_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `mod_banner_groups`
--

INSERT INTO `mod_banner_groups` (`id`, `name`) VALUES
(1, 'right-main');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_banner_i18n`
--

DROP TABLE IF EXISTS `mod_banner_i18n`;
CREATE TABLE IF NOT EXISTS `mod_banner_i18n` (
  `id` int(11) NOT NULL,
  `url` text,
  `locale` varchar(5) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `description` text,
  `photo` varchar(255) DEFAULT NULL,
  KEY `id` (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mod_banner_i18n`
--

INSERT INTO `mod_banner_i18n` (`id`, `url`, `locale`, `name`, `description`, `photo`) VALUES
(3, '/shop/category/sredstva-po-uhodu-za-telom', 'ru', 'Первый баннер на главной ', '', '/uploads/shop/banners/ten-rules.png'),
(4, '/shop/category/sredstva-po-uhodu-za-litsom/antivozrastnoi-uhod/maski', 'ru', 'Второй баннер на главной ', '', '/uploads/shop/banners/reducing-cream.png'),
(5, 'shop/product/mobilnyi-telefon-sony-xperia-v-lt25i-black', 'ru', '1', '1', '/uploads/shop/banners/1.jpg'),
(6, 'shop/product/mobilnyi-telefon-lg-nexus-4-e960-black', 'ru', 'main', 'main', '/uploads/shop/banners/2.jpg'),
(7, 'shop/product/karta-pamiati-kingston-microsd-16-gb-sdc4-16gb', 'ru', '3', '3', '/uploads/shop/banners/3.jpg'),
(8, 'shop/product/garnitura-samsung-bhm1100-black', 'ru', '4', '4', '/uploads/shop/banners/4.jpg'),
(9, '', 'ru', 'Каталог', '', 'http://img.loc/uploads/catalog-banner.jpg'),
(10, 'shop/product/mobilnyi-telefon-sony-xperia-v-lt25i-black', 'ru', '1', '1', '/uploads/shop/banners/1.jpg'),
(11, 'shop/product/mobilnyi-telefon-lg-nexus-4-e960-black', 'ru', 'main', 'main', '/uploads/shop/banners/2.jpg'),
(12, 'shop/product/karta-pamiati-kingston-microsd-16-gb-sdc4-16gb', 'ru', '3', '3', '/uploads/shop/banners/3.jpg'),
(13, 'shop/product/garnitura-samsung-bhm1100-black', 'ru', '4', '4', '/uploads/shop/banners/4.jpg'),
(14, '', 'ru', 'Первый баннер на главной ', '', '/uploads/shop/banners/main1.jpg'),
(15, '', 'ru', 'Второй баннер на главной ', '', '/uploads/shop/banners/main2.jpg'),
(16, '', 'ru', 'Третий баннер на главной ', '', '/uploads/shop/banners/side1.png'),
(17, '', 'ru', 'Четвертый баннер на главн', '', '/uploads/shop/banners/side2.png'),
(18, 'shop/product/mobilnyi-telefon-sony-xperia-v-lt25i-black', 'ru', '1', '1', '/uploads/shop/banners/1.jpg'),
(19, 'shop/product/mobilnyi-telefon-lg-nexus-4-e960-black', 'ru', 'main', 'main', '/uploads/shop/banners/2.jpg'),
(20, 'shop/product/karta-pamiati-kingston-microsd-16-gb-sdc4-16gb', 'ru', '3', '3', '/uploads/shop/banners/3.jpg'),
(21, 'shop/product/garnitura-samsung-bhm1100-black', 'ru', '4', '4', '/uploads/shop/banners/4.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_categories_additional_settings`
--

DROP TABLE IF EXISTS `mod_categories_additional_settings`;
CREATE TABLE IF NOT EXISTS `mod_categories_additional_settings` (
  `category_id` int(11) NOT NULL,
  `column` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_discount_all_order`
--

DROP TABLE IF EXISTS `mod_discount_all_order`;
CREATE TABLE IF NOT EXISTS `mod_discount_all_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `for_autorized` tinyint(4) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `is_gift` tinyint(4) DEFAULT NULL,
  `begin_value` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `mod_discount_all_order`
--

INSERT INTO `mod_discount_all_order` (`id`, `for_autorized`, `discount_id`, `is_gift`, `begin_value`) VALUES
(3, NULL, 6, 1, 200);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_discount_brand`
--

DROP TABLE IF EXISTS `mod_discount_brand`;
CREATE TABLE IF NOT EXISTS `mod_discount_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_discount_category`
--

DROP TABLE IF EXISTS `mod_discount_category`;
CREATE TABLE IF NOT EXISTS `mod_discount_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `mod_discount_category`
--

INSERT INTO `mod_discount_category` (`id`, `category_id`, `discount_id`) VALUES
(3, 930, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_discount_comulativ`
--

DROP TABLE IF EXISTS `mod_discount_comulativ`;
CREATE TABLE IF NOT EXISTS `mod_discount_comulativ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_id` int(11) DEFAULT NULL,
  `begin_value` int(11) DEFAULT NULL,
  `end_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_discount_group_user`
--

DROP TABLE IF EXISTS `mod_discount_group_user`;
CREATE TABLE IF NOT EXISTS `mod_discount_group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_discount_product`
--

DROP TABLE IF EXISTS `mod_discount_product`;
CREATE TABLE IF NOT EXISTS `mod_discount_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_discount_user`
--

DROP TABLE IF EXISTS `mod_discount_user`;
CREATE TABLE IF NOT EXISTS `mod_discount_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_email_paterns`
--

DROP TABLE IF EXISTS `mod_email_paterns`;
CREATE TABLE IF NOT EXISTS `mod_email_paterns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `patern` text,
  `from` varchar(256) NOT NULL,
  `from_email` varchar(256) NOT NULL,
  `admin_email` varchar(256) NOT NULL,
  `type` enum('HTML','Text') NOT NULL DEFAULT 'HTML',
  `user_message_active` tinyint(1) NOT NULL,
  `admin_message_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `mod_email_paterns`
--

INSERT INTO `mod_email_paterns` (`id`, `name`, `patern`, `from`, `from_email`, `admin_email`, `type`, `user_message_active`, `admin_message_active`) VALUES
(1, 'make_order', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 1),
(2, 'change_order_status', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 0),
(3, 'notification_email', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 0),
(4, 'create_user', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 1),
(5, 'forgot_password', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 0),
(6, 'change_password', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 0),
(7, 'price_change', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 0),
(8, 'wish_list', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 1),
(9, 'callback', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_email_paterns_i18n`
--

DROP TABLE IF EXISTS `mod_email_paterns_i18n`;
CREATE TABLE IF NOT EXISTS `mod_email_paterns_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `theme` varchar(256) NOT NULL,
  `user_message` text NOT NULL,
  `admin_message` text NOT NULL,
  `description` text NOT NULL,
  `variables` text NOT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mod_email_paterns_i18n`
--

INSERT INTO `mod_email_paterns_i18n` (`id`, `locale`, `theme`, `user_message`, `admin_message`, `description`, `variables`) VALUES
(1, 'ru', 'Заказ товара', '<p><span>Здравствуйте, $userName$.</span><br /><br /><span>Мы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop"</span><br /><br /><span>Вы указали следующие контактные данные:</span><br /><br /><span>Email адрес: $userEmail$</span><br /><br /><span>Номер телефона: $userPhone$</span><br /><br /><span>Адрес доставки: $userDeliver$</span><br /><br /><span>Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.</span><br /><br /><span>Также, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:&nbsp; $orderLink$.</span><br /><br /><span>Спасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь за телефонами:</span><br /><br /><span>+7 (095) 222-33-22 +38 (098) 222-33-22</span></p>', '<p>Пользователь&nbsp;<span>$userName$ совершил заказ товара&nbsp;</span></p>\n<p><span><span>Email адрес: $userEmail$</span><br /><br /><span>Номер телефона: $userPhone$</span><br /><br /><span>Адрес доставки: $userDeliver$</span></span></p>', '<p><span>Уведомление покупателя о совершении заказа</span></p>', 'a:7:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$userPhone$";s:39:"Телефон Пользователя";s:13:"$userDeliver$";s:27:"Адрес доставки";s:11:"$orderLink$";s:28:"Ссылка на заказ";s:16:"$deliveryMethod$";s:29:"Способ доставки";s:15:"$paymentMethod$";s:25:"Способ оплаты";}'),
(2, 'ru', 'Смена статуса заказа', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Статус вашего заказа изменен на <strong>$status$</strong></p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Вы указали следующие контактные данные:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$userEmail$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Номер телефона: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Адрес доставки: </span>$userDeliver$</div>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.</p>\n<p style="font-family: arial; font-size: 13px;">Также, Вы можете всегда посмотреть за статусом Вашего заказа, <a href="$orderLink$" target="_blank">перейдя по ссылке</a>.</p>', '', '<p>Смена статуса заказа</p>', 'a:6:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$orderLink$";s:28:"Ссылка на заказ";s:8:"$status$";s:25:"Статус заказа";s:11:"$userPhone$";s:39:"Телефон пользователя";s:13:"$userDeliver$";s:27:"Адрес доставки";}'),
(3, 'ru', 'Товар появился на складе!', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Товар&nbsp;<a href="$productLink$" target="_blank">$productName$</a>&nbsp;появился на складе. Вы можете его заказать.</p>', '', '<p>Уведомление о появлении</p>', 'a:5:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:13:"$productName$";s:33:"Название продукта";s:8:"$status$";s:12:"Статус";s:13:"$productLink$";s:32:"Ссылка на продукт";}'),
(4, 'ru', 'Создание пользователя', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $user_name$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Поздравляем! Ваша регистрация прошла успешно.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Данные для входа в магазин:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$userEmail$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Пароль: </span>$user_password$</div>', '<p><span>Создан пользователь $user_name$:</span><br /><span>С паролем: $user_password$</span><br /><span>Адресом: &nbsp;$<span>user_</span>address$</span><br /><span>Email пользователя: $user_email$</span><br /><span>Телефон пользователя: $user_phone$</span></p>', '<p>Шаблон письма на создание пользователя</p>', 'a:5:{s:11:"$user_name$";s:31:"Имя пользователя";s:15:"$user_password$";s:12:"Пароль";s:14:"$user_address$";s:12:"Адресс";s:12:"$user_email$";s:5:"Email";s:12:"$user_phone$";s:14:"Телефон";}'),
(5, 'ru', 'Восстановление пароля', '<p><span>Здравствуйте!</span><br /><br /><span>На сайте $webSiteName$ создан запрос на восстановление пароля для Вашего аккаунта.</span><br /><br /><span>Для завершения процедуры восстановления пароля перейдите по ссылке $resetPasswordUri$</span><br /><br /><span>Ваш новый пароль для входа: $password$</span><br /><br /><span>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь по телефонам:</span><br /><br /><span>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89</span><br /><br /><span>---</span><br /><br /><span>С уважением,</span><br /><br /><span>сотрудники службы продаж $webSiteName$</span></p>', '', 'Шаблон письма на  восстановление пароля', 'a:5:{s:13:"$webSiteName$";s:17:"Имя сайта";s:18:"$resetPasswordUri$";s:59:"Ссылка на восстановления пароля";s:10:"$password$";s:12:"Пароль";s:5:"$key$";s:8:"Ключ";s:16:"$webMasterEmail$";s:54:"Email сотрудников службы продаж";}'),
(6, 'ru', 'Смена пароля', '<p><span>Здравствуйте $user_name$!</span><br /><br /><span>Ваш новый пароль для входа: $password$</span><br /><br /><span>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</span><br /><br /><span><br /></span></p>', '', '<p>Шаблон письма изменения пароля</p>', 'a:2:{s:11:"$user_name$";s:31:"Имя пользователя";s:10:"$password$";s:23:"Новый пароль";}'),
(7, 'ru', 'Изменение цены', '<p>Цена на $name$ за которым вы следите на сайте $server$ изменилась.<br /> <a title="Посмотреть список слежения" href="$list_url_look$">Посмотреть список слежения</a><br /> <a title="Отписатся от слежения" href="$delete_list_url_look$">Отписатся от слежения</a></p>\n<div id="dc_vk_code"  none;">&nbsp;</div>', '<p>&nbsp;</p>\n<div id="dc_vk_code">&nbsp;</div>', '<p>Изменение цены</p>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>', ''),
(7, 'ua', 'Ціна змінилася', '<p>Ціна на $name$ за яким Ви слідкуєте на сайті $server$ змінилася.<br /> <a title="Переглянути список слідкувань" href="$list_url_look$">Переглянути список слідкувань</a><br /> <a title="Відписатися від слідкування" href="$delete_list_url_look$">Відписатися від слідкування</a></p>\n<div id="dc_vk_code"  none;">&nbsp;</div>', '<p>&nbsp;</p>\n<div id="dc_vk_code">&nbsp;</div>', '<p>Слідкування за ціною</p>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>', ''),
(8, 'ru', 'Список Желаний', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Вы создали список желаний $wishName$</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Ссылка на просмотр списка желаний <a href="$wishLink$" target="_blank">$wishLink$</a></p>', '<p>Пользователь&nbsp;<span>$userName$ создал список желаний - $wishName$.<br /></span></p>\n<p><span><span>&nbsp;</span></span></p>', '<p><span>Уведомление о создании списка желаний</span></p>', 'a:4:{s:10:"$userName$";s:31:"Имя пользователя";s:10:"$wishName$";s:29:"Название списка";s:10:"$wishLink$";s:30:"Ссилка на список";s:15:"$wishListViews$";s:54:"Количество просмотров списка";}'),
(9, 'ru', 'Заказать звонок', '<p><span style="font-size: medium;">Спасибо за Ваше обращение, в ближайшее время администраторы свяжутся с Вами.</span></p>', '<p><span style="font-size: medium;">Новий запрос о Заказе дзвонка от&nbsp; $userName$.</span></p>\n<p>Тема колбека:&nbsp; $callbackTheme$</p>\n<p>Дата колбека:&nbsp; $dateCreated$</p>\n<p>Коментарий пользователя:&nbsp; $userComment$</p>', '<p>Шаблон заказа звонка</p>', 'a:6:{s:16:"$callbackStatus$";s:27:"Статус колбека";s:15:"$callbackTheme$";s:23:"Тема колбека";s:10:"$userName$";s:69:"Имя пользователя запросившего звонок";s:11:"$userPhone$";s:90:"Номер телефона пользователя запросившего колбек";s:13:"$dateCreated$";s:23:"Дата колбека";s:13:"$userComment$";s:63:" Комментарии пользователя колбека";}');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_exchange`
--

DROP TABLE IF EXISTS `mod_exchange`;
CREATE TABLE IF NOT EXISTS `mod_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `external_id` varchar(255) DEFAULT NULL,
  `property_id` varchar(255) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_new_level_columns`
--

DROP TABLE IF EXISTS `mod_new_level_columns`;
CREATE TABLE IF NOT EXISTS `mod_new_level_columns` (
  `category_id` varchar(500) NOT NULL,
  `column` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mod_new_level_columns`
--

INSERT INTO `mod_new_level_columns` (`category_id`, `column`) VALUES
('a:3:{i:0;s:3:"937";i:1;s:3:"938";i:2;s:4:"2597";}', '4'),
('a:2:{i:0;s:3:"935";i:1;s:3:"936";}', '3'),
('a:2:{i:0;s:3:"932";i:1;s:3:"933";}', '2'),
('a:3:{i:0;s:3:"930";i:1;s:3:"931";i:2;s:4:"2583";}', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_new_level_product_properties_types`
--

DROP TABLE IF EXISTS `mod_new_level_product_properties_types`;
CREATE TABLE IF NOT EXISTS `mod_new_level_product_properties_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `type` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=288 ;

--
-- Дамп данных таблицы `mod_new_level_product_properties_types`
--

INSERT INTO `mod_new_level_product_properties_types` (`id`, `property_id`, `name`, `type`) VALUES
(1, 26, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(2, 25, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(3, 24, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(4, 23, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(5, 22, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(6, 122, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(7, 121, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(8, 20, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(9, 28, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(10, 93, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(11, 31, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(12, 34, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(13, 35, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(14, 36, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(15, 37, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(16, 39, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(17, 41, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(18, 42, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(19, 46, 0, 'a:2:{i:3;s:6:"scroll";i:4;s:8:"dropDown";}'),
(20, 50, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(21, 51, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(22, 52, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(23, 92, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(24, 183, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(25, 53, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(26, 139, 0, 'a:1:{i:0;s:6:"scroll";}'),
(27, 141, 0, 'a:2:{i:1;s:8:"dropDown";i:2;s:6:"scroll";}'),
(28, 90, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(29, 91, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(30, 57, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(31, 58, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(32, 59, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(33, 60, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(34, 62, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(35, 64, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(36, 79, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(37, 66, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(38, 67, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(39, 68, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(40, 73, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(41, 74, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(42, 75, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(43, 76, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(44, 77, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(45, 101, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(46, 78, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(47, 89, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(48, 70, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(49, 95, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(50, 96, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(51, 97, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(52, 98, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(53, 99, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(54, 100, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(55, 184, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(56, 84, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(57, 355, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(58, 86, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(59, 102, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(60, 103, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(61, 104, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(62, 140, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(63, 111, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(64, 112, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(65, 113, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(66, 114, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(67, 115, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(68, 116, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(69, 117, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(70, 118, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(71, 119, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(72, 120, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(73, 345, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(74, 346, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(75, 347, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(76, 348, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(77, 349, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(78, 350, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(79, 351, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(80, 352, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(81, 353, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(82, 354, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(83, 105, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(84, 107, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(85, 108, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(86, 123, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(87, 124, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(88, 110, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(89, 125, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(90, 290, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(91, 127, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(92, 135, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(93, 131, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(94, 133, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(95, 134, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(96, 137, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(97, 138, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(99, 143, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(100, 144, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(101, 145, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(102, 146, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(103, 335, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(104, 336, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(105, 333, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(106, 334, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(107, 152, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(108, 337, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(109, 154, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(110, 155, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(111, 156, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(112, 157, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(113, 158, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(114, 159, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(115, 160, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(116, 161, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(117, 162, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(118, 163, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(119, 164, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(120, 165, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(121, 166, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(122, 167, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(123, 168, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(124, 169, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(125, 170, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(126, 171, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(127, 172, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(128, 173, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(129, 174, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(130, 178, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(131, 176, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(132, 177, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(133, 180, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(134, 179, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(135, 185, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(136, 182, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(137, 186, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(138, 210, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(139, 211, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(140, 212, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(141, 296, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(142, 256, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(143, 235, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(144, 283, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(145, 181, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(146, 187, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(147, 188, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(148, 189, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(149, 190, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(150, 191, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(151, 192, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(152, 193, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(153, 194, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(154, 197, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(155, 198, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(156, 199, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(157, 200, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(158, 201, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(159, 202, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(160, 203, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(161, 204, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(162, 206, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(163, 207, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(164, 208, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(165, 209, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(166, 213, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(167, 214, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(168, 215, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(169, 216, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(170, 217, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(171, 218, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(172, 219, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(173, 220, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(174, 221, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(175, 222, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(176, 223, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(177, 224, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(178, 225, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(179, 310, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(180, 226, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(181, 227, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(182, 228, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(183, 229, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(184, 230, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(185, 231, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(186, 232, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(187, 298, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(188, 297, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(189, 293, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(190, 295, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(191, 233, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(192, 234, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(193, 236, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(194, 237, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(195, 238, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(196, 239, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(197, 240, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(198, 241, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(199, 242, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(200, 243, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(201, 244, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(202, 246, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(203, 247, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(204, 248, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(205, 249, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(206, 250, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(207, 251, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(208, 252, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(209, 253, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(210, 254, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(211, 255, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(212, 257, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(213, 258, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(214, 260, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(215, 261, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(216, 262, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(217, 263, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(218, 264, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(219, 265, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(220, 266, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(221, 267, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(222, 268, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(223, 269, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(224, 270, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(225, 272, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(226, 273, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(227, 338, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(228, 339, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(229, 340, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(230, 341, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(231, 342, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(232, 343, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(233, 275, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(234, 276, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(235, 277, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(236, 278, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(237, 279, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(238, 280, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(239, 281, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(240, 282, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(241, 292, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(242, 291, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(243, 284, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(244, 285, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(245, 286, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(246, 287, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(247, 288, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(248, 289, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(249, 299, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(250, 300, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(251, 301, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(252, 303, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(253, 304, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(254, 305, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(255, 306, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(256, 307, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(257, 308, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(258, 309, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(259, 311, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(260, 312, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(261, 313, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(262, 314, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(263, 315, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(264, 316, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(265, 317, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(266, 318, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(267, 319, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(268, 320, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(269, 321, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(270, 322, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(271, 323, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(272, 324, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(273, 325, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(274, 326, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(275, 327, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(276, 328, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(277, 329, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(278, 330, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(279, 331, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(280, 332, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(281, 344, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(282, 356, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(283, 357, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(284, 358, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(285, 359, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(286, 360, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}'),
(287, 361, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_next_level_product_properties_types`
--

DROP TABLE IF EXISTS `mod_next_level_product_properties_types`;
CREATE TABLE IF NOT EXISTS `mod_next_level_product_properties_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `type` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_sample_settings`
--

DROP TABLE IF EXISTS `mod_sample_settings`;
CREATE TABLE IF NOT EXISTS `mod_sample_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `mod_sample_settings`
--

INSERT INTO `mod_sample_settings` (`id`, `name`, `value`) VALUES
(1, 'mailTo', 'admin@site.com'),
(2, 'useEmailNotification', 'TRUE'),
(3, 'key', 'UUUsssTTTeee');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_seo`
--

DROP TABLE IF EXISTS `mod_seo`;
CREATE TABLE IF NOT EXISTS `mod_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(5) DEFAULT NULL,
  `settings` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_seo_inflect`
--

DROP TABLE IF EXISTS `mod_seo_inflect`;
CREATE TABLE IF NOT EXISTS `mod_seo_inflect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original` varchar(250) NOT NULL,
  `inflection_id` int(11) NOT NULL,
  `inflected` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_seo_products`
--

DROP TABLE IF EXISTS `mod_seo_products`;
CREATE TABLE IF NOT EXISTS `mod_seo_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `locale` varchar(5) DEFAULT NULL,
  `settings` text,
  `active` tinyint(4) DEFAULT NULL,
  `empty_meta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_shop_discounts`
--

DROP TABLE IF EXISTS `mod_shop_discounts`;
CREATE TABLE IF NOT EXISTS `mod_shop_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(25) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `max_apply` int(11) DEFAULT NULL,
  `count_apply` int(11) DEFAULT NULL,
  `date_begin` int(11) DEFAULT NULL,
  `date_end` int(11) DEFAULT NULL,
  `type_value` tinyint(4) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `type_discount` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_UNIQUE` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `mod_shop_discounts`
--

INSERT INTO `mod_shop_discounts` (`id`, `key`, `active`, `max_apply`, `count_apply`, `date_begin`, `date_end`, `type_value`, `value`, `type_discount`) VALUES
(6, 'x707040bhtd85rjf', 0, NULL, NULL, 1379365200, 0, 2, 200, 'all_order'),
(7, 'sf622z81lrd5n7w8', 1, NULL, NULL, 1379365200, 0, 1, 5, 'category');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_shop_discounts_i18n`
--

DROP TABLE IF EXISTS `mod_shop_discounts_i18n`;
CREATE TABLE IF NOT EXISTS `mod_shop_discounts_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mod_shop_discounts_i18n`
--

INSERT INTO `mod_shop_discounts_i18n` (`id`, `locale`, `name`) VALUES
(6, 'ru', 'Промо-код'),
(7, 'ru', 'Каталог - Телефония, МР3-плееры, GPS');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_shop_news`
--

DROP TABLE IF EXISTS `mod_shop_news`;
CREATE TABLE IF NOT EXISTS `mod_shop_news` (
  `content_id` int(11) NOT NULL,
  `shop_categories_ids` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mod_shop_news`
--

INSERT INTO `mod_shop_news` (`content_id`, `shop_categories_ids`) VALUES
(91, '8,927,930,931,2583,932,933,935,936,937,938,2597,9,953,962,963,964,965,956,974,975,977,978,979,980,2976,958,983,960,996,5,459,497,498,499,500,501,512,460,517,461,527,528,529,530,532,533,534,536,537,538,539,540,545,546,548,551,553,462,471,472,473,474,475,476,477,478,479,480,481,482,483,484,486,489,490,491,492,493,494,495,496,463,554,555,557,558,559,560,464,562,565,566,567,568,571,572,574,575,581,582,586,589,590,591,595,596,597,600,601,603,605,611,613,620,465,625,627,630,631,635,637,638,639,645,647,466,659,660,661,662,663,665,667,668,467,671,672,673,674,675,676,677,678,683,685,686,689,707,709,711,715,716,468,718,719,720,723,724,726,469,728,470,732,733,734,735,736,737,3,245,2932,1285,1286,1287,254,255,256,257,258,259,260,261,262,263,265,266,267,268,269,270,271,272,273,274,275,246,276,277,278,279,280,281,282,283,284,285,286,288,289,290,291,298,299,247,300,301,303,304,306,307,308,248,309,310,311,312,313,249,314,315,316,317,318,319,320,321,1116,2559,292,293,295,297,1117,1223,1224,1225,2544,25');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_sitemap_blocked_urls`
--

DROP TABLE IF EXISTS `mod_sitemap_blocked_urls`;
CREATE TABLE IF NOT EXISTS `mod_sitemap_blocked_urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `robots_check` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_sitemap_changefreq`
--

DROP TABLE IF EXISTS `mod_sitemap_changefreq`;
CREATE TABLE IF NOT EXISTS `mod_sitemap_changefreq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_page_changefreq` varchar(255) DEFAULT NULL,
  `pages_changefreq` varchar(255) DEFAULT NULL,
  `product_changefreq` varchar(255) DEFAULT NULL,
  `categories_changefreq` varchar(255) DEFAULT NULL,
  `products_categories_changefreq` varchar(255) DEFAULT NULL,
  `products_sub_categories_changefreq` varchar(255) DEFAULT NULL,
  `brands_changefreq` varchar(255) DEFAULT NULL,
  `sub_categories_changefreq` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `mod_sitemap_changefreq`
--

INSERT INTO `mod_sitemap_changefreq` (`id`, `main_page_changefreq`, `pages_changefreq`, `product_changefreq`, `categories_changefreq`, `products_categories_changefreq`, `products_sub_categories_changefreq`, `brands_changefreq`, `sub_categories_changefreq`) VALUES
(1, 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_sitemap_priorities`
--

DROP TABLE IF EXISTS `mod_sitemap_priorities`;
CREATE TABLE IF NOT EXISTS `mod_sitemap_priorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_page_priority` float DEFAULT '1',
  `cats_priority` float DEFAULT '1',
  `pages_priority` float DEFAULT '1',
  `sub_cats_priority` float DEFAULT '1',
  `products_priority` float DEFAULT '1',
  `products_categories_priority` float DEFAULT '1',
  `products_sub_categories_priority` float DEFAULT '1',
  `brands_priority` float DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `mod_sitemap_priorities`
--

INSERT INTO `mod_sitemap_priorities` (`id`, `main_page_priority`, `cats_priority`, `pages_priority`, `sub_cats_priority`, `products_priority`, `products_categories_priority`, `products_sub_categories_priority`, `brands_priority`) VALUES
(1, 1, 0.8, 0.9, 0.7, 0.4, 0.6, 0.5, 0.3);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_stats_attendance`
--

DROP TABLE IF EXISTS `mod_stats_attendance`;
CREATE TABLE IF NOT EXISTS `mod_stats_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `type_id` int(2) NOT NULL,
  `id_entity` int(6) NOT NULL,
  `time_add` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_stats_attendance_robots`
--

DROP TABLE IF EXISTS `mod_stats_attendance_robots`;
CREATE TABLE IF NOT EXISTS `mod_stats_attendance_robots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_robot` int(5) NOT NULL,
  `type_id` int(2) NOT NULL,
  `id_entity` int(6) NOT NULL,
  `time_add` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_stats_search`
--

DROP TABLE IF EXISTS `mod_stats_search`;
CREATE TABLE IF NOT EXISTS `mod_stats_search` (
  `key` varchar(70) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `ac` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_stats_settings`
--

DROP TABLE IF EXISTS `mod_stats_settings`;
CREATE TABLE IF NOT EXISTS `mod_stats_settings` (
  `setting` varchar(70) DEFAULT NULL,
  `value` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_wish_list`
--

DROP TABLE IF EXISTS `mod_wish_list`;
CREATE TABLE IF NOT EXISTS `mod_wish_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(254) NOT NULL,
  `description` text,
  `access` enum('public','private','shared') NOT NULL DEFAULT 'shared',
  `user_id` int(11) NOT NULL,
  `review_count` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_wish_list_products`
--

DROP TABLE IF EXISTS `mod_wish_list_products`;
CREATE TABLE IF NOT EXISTS `mod_wish_list_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wish_list_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_wish_list_users`
--

DROP TABLE IF EXISTS `mod_wish_list_users`;
CREATE TABLE IF NOT EXISTS `mod_wish_list_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(254) DEFAULT NULL,
  `user_image` text,
  `user_birthday` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mod_wish_list_users`
--

INSERT INTO `mod_wish_list_users` (`id`, `user_name`, `user_image`, `user_birthday`, `description`) VALUES
(49, 'admin', NULL, 50000, 'asdfasdf');

-- --------------------------------------------------------

--
-- Структура таблицы `propel_migration`
--

DROP TABLE IF EXISTS `propel_migration`;
CREATE TABLE IF NOT EXISTS `propel_migration` (
  `version` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `propel_migration`
--

INSERT INTO `propel_migration` (`version`) VALUES
(1363604832);

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` varchar(25) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `votes` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `search`
--

DROP TABLE IF EXISTS `search`;
CREATE TABLE IF NOT EXISTS `search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(264) NOT NULL,
  `datetime` int(11) NOT NULL,
  `where_array` text NOT NULL,
  `select_array` text NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `order_by` text NOT NULL,
  `row_count` int(11) NOT NULL,
  `total_rows` int(11) NOT NULL,
  `ids` text NOT NULL,
  `search_title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`),
  KEY `datetime` (`datetime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `search`
--

INSERT INTO `search` (`id`, `hash`, `datetime`, `where_array`, `select_array`, `table_name`, `order_by`, `row_count`, `total_rows`, `ids`, `search_title`) VALUES
(11, '6c08ce0616e03b904259ad6bb429301bac06a66d', 1373301561, 'a:5:{i:0;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:1;a:2:{s:4:"id =";i:0;s:9:"backticks";s:4:"both";}i:2;a:3:{s:9:"prev_text";s:48:"Мышь компьютерная Asus GX900 Red";s:8:"operator";s:4:"LIKE";s:9:"backticks";s:4:"both";}i:3;a:3:{s:9:"full_text";s:48:"Мышь компьютерная Asus GX900 Red";s:8:"operator";s:7:"OR_LIKE";s:9:"backticks";s:4:"both";}i:4;a:3:{s:5:"title";s:48:"Мышь компьютерная Asus GX900 Red";s:8:"operator";s:7:"OR_LIKE";s:9:"backticks";s:4:"both";}}', 'a:0:{}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'Мышь компьютерная Asus GX900 Red');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(50) NOT NULL,
  `create_keywords` varchar(25) NOT NULL,
  `create_description` varchar(25) NOT NULL,
  `create_cat_keywords` varchar(25) NOT NULL,
  `create_cat_description` varchar(25) NOT NULL,
  `add_site_name` int(1) NOT NULL,
  `add_site_name_to_cat` int(1) NOT NULL,
  `delimiter` varchar(5) NOT NULL,
  `editor_theme` varchar(10) NOT NULL,
  `site_template` varchar(50) NOT NULL,
  `site_offline` varchar(5) NOT NULL,
  `google_analytics_id` varchar(40) DEFAULT NULL,
  `main_type` varchar(50) NOT NULL,
  `main_page_id` int(11) NOT NULL,
  `main_page_cat` text NOT NULL,
  `main_page_module` varchar(50) NOT NULL,
  `sidepanel` varchar(5) NOT NULL,
  `lk` varchar(250) DEFAULT NULL,
  `lang_sel` varchar(15) NOT NULL DEFAULT 'ru_RU',
  `google_webmaster` varchar(200) DEFAULT NULL,
  `yandex_webmaster` varchar(200) DEFAULT NULL,
  `yandex_metric` varchar(200) NOT NULL,
  `ss` varchar(255) NOT NULL,
  `cat_list` varchar(10) NOT NULL,
  `text_editor` varchar(30) NOT NULL,
  `siteinfo` text NOT NULL,
  `update` text,
  `backup` text,
  `robots_status` int(1) NOT NULL,
  `robots_settings_status` smallint(1) NOT NULL DEFAULT '0',
  `robots_settings` text NOT NULL,
  `google_analytics_ee` int(1) NOT NULL DEFAULT '1',
  `www_redirect` varchar(100) NOT NULL DEFAULT 'without',
  PRIMARY KEY (`id`),
  KEY `s_name` (`s_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `google_analytics_id`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`, `lang_sel`, `google_webmaster`, `yandex_webmaster`, `yandex_metric`, `ss`, `cat_list`, `text_editor`, `siteinfo`, `update`, `backup`, `robots_status`, `robots_settings_status`, `robots_settings`, `www_redirect`) VALUES
(2, 'main', 'auto', 'auto', '0', '0', 1, 1, '/', '0', 'fullMarket', 'no', '', 'module', 69, '63', 'shop', '', '', 'ru_RU', '', '', '', '', 'yes', 'tinymce', 'a:3:{s:13:"siteinfo_logo";s:8:"logo.png";s:16:"siteinfo_favicon";s:11:"favicon.ico";s:2:"ru";a:5:{s:20:"siteinfo_companytype";s:94:"© 2014-2015, Интернет-магазин Full Market. Все права защищены.";s:16:"siteinfo_address";s:31:"ул. Набережная 22а";s:18:"siteinfo_mainphone";s:15:"0 800 567-43-21";s:19:"siteinfo_adminemail";s:19:"info@fullmarket.com";s:8:"contacts";a:7:{s:5:"Skype";s:10:"fullmarket";s:5:"Email";s:19:"info@fullmarket.com";s:7:"vk-link";s:1:"#";s:7:"fb-link";s:1:"#";s:7:"tw-link";s:1:"#";s:8:"addphone";s:15:"0 800 567-43-21";s:3:"map";s:375:"<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235195.97371835003!2d-43.44970300000001!3d-22.91569115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997efe4224b50b%3A0xf988253c846c59ee!2z0KDQuNC-LdC00LUt0JbQsNC90LXQudGA0L4sINCR0YDQsNC30LjQu9C40Y8!5e0!3m2!1sru!2sua!4v1429280340531" width="100%" height="350" frameborder="0" style="border:0"></iframe>";}}}', '', NULL, 1, 0, '', 'without');

-- --------------------------------------------------------

--
-- Структура таблицы `settings_i18n`
--

DROP TABLE IF EXISTS `settings_i18n`;
CREATE TABLE IF NOT EXISTS `settings_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_ident` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `short_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings_i18n`
--

INSERT INTO `settings_i18n` (`id`, `lang_ident`, `name`, `short_name`, `description`, `keywords`) VALUES
(1, 3, 'Full Market - Бесплатный интернет магазин онлайн покупок', 'Full Market', 'Full Market - Бесплатный интернет магазин', 'бесплатный интернет магазин онлайн покупок');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_banners`
--

DROP TABLE IF EXISTS `shop_banners`;
CREATE TABLE IF NOT EXISTS `shop_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `categories` text,
  `on_main` tinyint(1) DEFAULT NULL,
  `espdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_banners_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `shop_banners`
--

INSERT INTO `shop_banners` (`id`, `position`, `active`, `categories`, `on_main`, `espdate`) VALUES
(7, 23, 1, 'false', 1, 2147483647),
(11, 24, 1, 'false', 1, 2147457600),
(12, 25, 1, 'false', 1, 2147457600);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_banners_i18n`
--

DROP TABLE IF EXISTS `shop_banners_i18n`;
CREATE TABLE IF NOT EXISTS `shop_banners_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_banners_i18n`
--

INSERT INTO `shop_banners_i18n` (`id`, `locale`, `name`, `text`, `url`, `image`) VALUES
(12, 'ru', 'Samsung', ' ', '/shop/brand/samsung', 'template-imageshop-banner-3.jpg'),
(7, 'ru', 'Epson', ' ', '/shop/brand/epson', 'template-imageshop-banner-1.jpg'),
(11, 'ru', 'Sony', ' ', '/shop/brand/sony', 'template-imageshop-banner-2.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_brands`
--

DROP TABLE IF EXISTS `shop_brands`;
CREATE TABLE IF NOT EXISTS `shop_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `position` smallint(6) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_brands_I_2` (`url`),
  KEY `shop_brands_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=294 ;

--
-- Дамп данных таблицы `shop_brands`
--

INSERT INTO `shop_brands` (`id`, `url`, `image`, `position`, `created`, `updated`) VALUES
(293, 'lovecarry', 'lovecarry.jpeg', 293, 1427880525, 1427880525),
(292, 'veres', 'veres.gif', 292, 1427807367, 1427807367),
(291, 'sadko', 'sadko.jpg', 291, 1427798454, 1427798454),
(290, 'stihl', 'stihl.jpg', 290, 1427797960, 1427797960),
(289, 'osprey', 'osprey.jpg', 289, 1427735369, 1427735369),
(288, 'adidas', 'adidas.png', 288, 1427728509, 1427728544),
(287, 'taranko', 'taranko.png', 287, 1427714634, 1427714638),
(286, 'miromark', 'miromark.png', 286, 1427714056, 1427714253),
(285, 'black-red-white', 'black-red-white.jpg', 285, 1427713950, 1427713957),
(284, 'lenovo', 'lenovo.png', 284, 1425570370, 1425570372),
(283, 'lg', 'lg.png', 283, 1425570326, 1425570343),
(282, 'samsung', 'samsung.png', 282, 1425570285, 1425570303),
(281, 'sony', 'sony.png', 281, 1425570251, 1425570271),
(280, 'htc', 'htc.jpg', 280, 1425570207, 1425570235),
(279, 'koss', 'koss.png', 279, 1425570172, 1425570193),
(278, 'goodram', 'goodram.jpg', 278, 1425570134, 1425570159),
(277, 'asus', 'asus.png', 277, 1425570097, 1425570119),
(276, 'apple', 'apple.png', 276, 1425570065, 1425570420),
(275, 'impression', 'impression.jpg', 275, 1425570041, 1425570045);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_brands_i18n`
--

DROP TABLE IF EXISTS `shop_brands_i18n`;
CREATE TABLE IF NOT EXISTS `shop_brands_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_brands_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_brands_i18n`
--

INSERT INTO `shop_brands_i18n` (`id`, `locale`, `name`, `description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(279, 'ru', 'Koss', '<p>Американская компания KOSS выпускает наушники и гарнитуры, которые на протяжении вот уже 50 лет пользуются заслуженной популярностью во всем мире.</p>\n<p>Первоклассный живой звук, удобство эксплуатации и стильный дизайн &ndash; вот основные преимущества продукции KOSS, будь то гарнитура или наушники. Компания выпускает надёжные устройства, предоставляя на них бессрочную гарантию. Разработчики KOSS стремятся создавать такие наушники и гарнитуры, которые предоставляют возможность наслаждаться творчеством других и творить самим.</p>', '', '', ''),
(278, 'ru', 'Goodram', '<p>Марка GOODRAM была создана в 2003 году компанией АО &laquo;Wilk Elektronik&raquo;. Однако, её история началась намного раньше, а именно в 1991 году, когда в городе Тыхи была основана наша фирма. С самого начала основной специализацией нашей деятельности были и остаются различные виды компьютерной памяти &ndash; вначале RAM, а с 2005 года также Flash.</p>', '', '', ''),
(276, 'ru', 'Apple', '<p>корпорация, производитель персональных и планшетных компьютеров, аудиоплееров, телефонов, программного обеспечения. Один из пионеров в области персональных компьютеров и современных многозадачных операционных систем с графическим интерфейсом.</p>\n<p>Благодаря инновационным технологиям и эстетичному дизайну, корпорация Apple создала уникальную репутацию, сравнимую с культом, в индустрии потребительской электроники. На 2014 год компания занимает первое место в мире по рыночной капитализации.</p>', '', '', ''),
(277, 'ru', 'Asus', '<p>Компания ASUS уделяет много внимания вопросам сохранения окружающей среды. Очень важно внедрить экологические принципы в каждом аспекте деятельности компании, поэтому в ASUS была разработана концепция Green ASUS, охватывающая важные экологические вопросы во всем комплексе &ndash; от административных бизнес-процессов до производства, от процессов разработки экологичной продукции до обучения персонала.</p>\n<p>ASUS первой в мире отказалась от использования свинца в производстве материнских плат и первой представила Full HD монитор, созданный с использованием безгалогенных технологий. Она является первым в мире производителем ноутбуков, получившим сертификаты Environmental Product Declaration (EPD) и EU Flower, а также первым производителем IT-оборудования из ведущей десятки, получившим сертификат Eco Mark (Япония).</p>', '', '', ''),
(275, 'ru', 'Impression', '<p>Контроль качества &mdash; главный принцип производства. Каждый готовый компьютер проходит тестирование в термокамере от 6 до 18 часов, что позволяет выявить большинство возможных дефектов. Для определения полной работоспособности компьютера проводится его тестирование с разной нагрузкой в течение 12-ти и более часов. Полученные результаты тестов хранятся в базе данных фабрики в течение всего гарантийного срока (2-3 года). Кроме того, после всех тестов ОТК выборочно тестирует 10% упакованных систем на работоспособность и полноту комплектации. Еще 5% компьютеров проходят выборочную полномасштабную проверку с переустановкой системы.</p>', '', '', ''),
(293, 'ru', 'Love&Carry', 'Компания Love &amp; Carry ведет свою историю с 2009 г. Именно тогда на свет появилась девочка Лия, которая изменила мир нашей молодой и творческой семьи. Вместе с появлением долгожданной крохи, родилась и мечта &ndash; жить полной жизнью, беспрепятственно продолжать познавать мир, но уже в полной гармонии с малышом. Именно такие ощущения нам подарили слинги.', '', '', ''),
(292, 'ru', 'Veres', '<p>Заботясь о своей семье, мы выбираем только лучшее: натуральные продукты, качественную одежду, комфортную и надежную мебель.</p>\n<p>Отечественный производитель мебели и текстиля для новорожденных &laquo;Компания &laquo;ВЕРЕС&raquo; вместе с Вами обеспечит уют и комфорт Вашему ребенку с первых дней его жизни.</p>', '', '', ''),
(291, 'ru', 'SADKO', '<p>ТМ &laquo;SADKO&raquo; выпускает широкий ассортимент техники для сада и огорода, которая уверенно завоевывает известность и получает все большее признание среди потребителей. Современные технологии, отличное качество и конкурентоспособная цена позволяет нашей продукции достойно соперничать с именитыми марками.</p>\n<p>Продукция &laquo;SADKO&raquo; изготовляется на современных заводах, оснащенных компьютеризированными линиями, использующими самые передовые технологии сборки. Все заводы сертифицированы по ISO 9001. На предприятиях внедрено и успешно осуществляется эффективное управление качеством на всех стадиях производства. Это гарантия того, что завод производит только высококачественную продукцию.</p>', '', '', ''),
(290, 'ru', 'Stihl', 'Андреас Штиль, закончив в 1926 году факультет машиностроения в Штутгарте, основал фирму &laquo;A. Stihl Ingenieursb&uuml;ro&raquo; по производству паровых котлов и стиральных машин. Благодаря этому предприниматель заработал свои первые деньги для создания мотопилы и спустя некоторое время вывел товар на рынок. Первая пила весила 48 кг и должна была обслуживаться двумя работниками в силу своего немаленького веса. Эти пилы в больших количествах экспортировались в Россию, Канаду и США.', '', '', ''),
(288, 'ru', 'Adidas', 'Hемецкий промышленный концерн, специализирующийся на выпуске спортивной обуви, одежды и инвентаря. Генеральный директор компании - Герберт Хайнер. В настоящий момент компания ответственна за дистрибуцию продукции компаний Adidas, Reebok, Rockport, Y-3, RBK, CCM Hockey, а также Taylor-Made Golf.', '', '', ''),
(289, 'ru', 'Osprey', 'Osprey - американский производитель, который на протяжении 40-летней истории специализируется на производстве рюкзаков, опираясь на инновации, внимание к деталям, качество и авторский дизайн владельца компании.', '', '', ''),
(287, 'ru', 'Taranko', '<p>В производстве мебели фабрика Taranko использует только передовые современные технологии и натуральные экологически чистые материалы. Это позволяет создавать шедевры, которые придутся по вкусу настоящим гурманам и ценителям классической мебели. Также поражает чрезвычайно широкий выбор этой мебели. Компания Taranko производит около 30 коллекций мебели, которые отличаются друг от друга стилем и дизайном</p>', '', '', ''),
(286, 'ru', 'MiroMark', '<p>Фабрика регулярно внедряет в производство инновационные технологии своих иностранных коллег. Например, метод напылительного покрытия мебели высококачественными полиуретановыми красками позаимствован у итальянской фирмы с более чем 40-летним опытом работы I.C.A. (IndustriaChimicaAdriatica). Это всемирно известный авторитетный производитель красок и лаков для дерева. Дизайн для большинства мебельных серий &laquo;Миро-Марк&raquo; разрабатывают итальянские художники-конструкторы.</p>', '', '', ''),
(285, 'ru', 'Black Red White', '<p>Компания Black Red White SA была основана в 1989. На сегодняшний день - это крупнейший производитель мебели в Польше. Продукция компании экспортируется в более чем 20 стран мира, в том числе в США, Канаду, Германию, Австрию, Бельгию, Норвегию, Швецию, Израиль, Хорватию, Болгарию, Грецию, Венгрию, Словакию, Чехию, Румынию, Боснию и Герцеговину, Россию, Белоруссию, Литву, Латвию, Эстонию, Казахстан и Украина.</p>\n<p>Мебель, представленная брендом Black Red White, рассчитанные на потребителя со средним уровнем достатка.</p>', '', '', ''),
(284, 'ru', 'Lenovo', '<p>Компания основана в 1984 году группой китайских учёных на средства Китайской академии наук. Первоначально компания носила название New Technology Developer Incorporated (спустя два года — Legend) и специализировалась на поставках компьютерной техники в Китай, а также на разработке кодировок для иероглифов.</p>\n\n<p>В декабре 2004 года было заключено широкое многолетнее соглашение между корпорацией IBM и компанией Lenovo. В соответствии с этим соглашением компания Lenovo выкупила IBM Personal Systems Group — подразделение по производству персональных компьютеров за $1,25 млрд (сделка была завершена в мае 2005 года). По условиям сделки Lenovo могла использовать бренд IBM до 2010 года, а после этой даты продукты компании выпускаются только под маркой Lenovo. В соответствии с заключённым альянсом[1] обе компании взаимно дополняют друг друга и могут предлагать клиентам через свои дистрибьюторские каналы продукты обеих компаний: как IBM, так и Lenovo.</p>', '', '', ''),
(283, 'ru', 'LG', '<p> южнокорейская компания, один из крупнейших мировых производителей потребительской электроники и бытовой техники. Входит в состав конгломерата LG Group. Главный офис компании LG Electronics находится в Сеуле, Республика Корея, 120 представительств компании открыты в 95 странах мира. По состоянию на 2010 год сотрудниками компании являлись 90 578 человек. Общий оборот компании по состоянию на 2010 составил 48,2 млрд долларов.</p>', '', '', ''),
(281, 'ru', 'Sony', '<p>Миссия Sony &mdash; вдохновлять вас на новые открытия и радовать достижениями.</p>\n<p>Наша приверженность технологиям, созданию контента и разнообразных сервисов и наше неиссякаемое стремление к инновациям помогают нам придумывать удивительные технологии и развлечения, которые всегда были визитной карточкой Sony. Мы стоим у истоков создания новой культуры и уникального опыта.</p>', '', '', ''),
(282, 'ru', 'Samsung', '<p>Из маленькой торговой компании Samsung превратилась в корпорацию мирового класса, бизнес которой охватывает прогрессивные технологии, производство полупроводниковых устройств, строительство небоскребов и заводов, нефтехимию, моду, медицину, финансы, гостиничное дело и многое другое. Наши открытия, изобретения и инновационные продукты позволили нам стать лидером в этих отраслях, постоянно продвигая их вперед.</p>', '', '', ''),
(280, 'ru', 'HTC', '<p>Основанная в 1997 году компания HTC зарекомендовала себя в качестве "работающего за кадром" дизайнера и производителя многих из популярных мобильных устройств, выпускаемых на рынок под торговой маркой производителя оборудования.</p>\n<p>Начиная с 2007 года мы регулярно представляли многие одобренные экспертами мобильные устройства под нашей собственной торговой маркой, и теперь наш портфолио включает смартфоны и планшеты с операционными системами Android и Windows Phone.</p>', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_callbacks`
--

DROP TABLE IF EXISTS `shop_callbacks`;
CREATE TABLE IF NOT EXISTS `shop_callbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `theme_id` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` text,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_callbacks_I_1` (`user_id`),
  KEY `shop_callbacks_I_2` (`status_id`),
  KEY `shop_callbacks_I_3` (`theme_id`),
  KEY `shop_callbacks_I_4` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `shop_callbacks`
--


-- --------------------------------------------------------

--
-- Структура таблицы `shop_callbacks_statuses`
--

DROP TABLE IF EXISTS `shop_callbacks_statuses`;
CREATE TABLE IF NOT EXISTS `shop_callbacks_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `shop_callbacks_statuses`
--

INSERT INTO `shop_callbacks_statuses` (`id`, `is_default`) VALUES
(1, 1),
(3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_callbacks_statuses_i18n`
--

DROP TABLE IF EXISTS `shop_callbacks_statuses_i18n`;
CREATE TABLE IF NOT EXISTS `shop_callbacks_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_callbacks_statuses_i18n_I_1` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_callbacks_statuses_i18n`
--

INSERT INTO `shop_callbacks_statuses_i18n` (`id`, `locale`, `text`) VALUES
(1, 'ru', 'Новый'),
(1, 'ua', 'Новий'),
(3, 'ru', 'Обработан'),
(3, 'ua', 'Оброблений'),
(1, 'en', 'New'),
(3, 'en', 'Processed');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_callbacks_themes`
--

DROP TABLE IF EXISTS `shop_callbacks_themes`;
CREATE TABLE IF NOT EXISTS `shop_callbacks_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `shop_callbacks_themes`
--

INSERT INTO `shop_callbacks_themes` (`id`, `position`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_callbacks_themes_i18n`
--

DROP TABLE IF EXISTS `shop_callbacks_themes_i18n`;
CREATE TABLE IF NOT EXISTS `shop_callbacks_themes_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_callbacks_themes_i18n_I_1` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_callbacks_themes_i18n`
--

INSERT INTO `shop_callbacks_themes_i18n` (`id`, `locale`, `text`) VALUES
(1, 'ru', 'Консультация'),
(1, 'ua', 'Перша тема'),
(1, 'en', 'Consultation');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_category`
--

DROP TABLE IF EXISTS `shop_category`;
CREATE TABLE IF NOT EXISTS `shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `full_path` varchar(1000) DEFAULT NULL,
  `full_path_ids` varchar(250) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tpl` varchar(250) DEFAULT NULL,
  `order_method` int(11) DEFAULT NULL,
  `showsitetitle` int(11) DEFAULT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_category_I_2` (`url`),
  KEY `shop_category_I_3` (`active`),
  KEY `shop_category_I_4` (`parent_id`),
  KEY `shop_category_I_5` (`position`),
  KEY `shop_category_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3032 ;

--
-- Дамп данных таблицы `shop_category`
--

INSERT INTO `shop_category` (`id`, `url`, `parent_id`, `position`, `full_path`, `full_path_ids`, `active`, `external_id`, `image`, `tpl`, `order_method`, `showsitetitle`, `created`, `updated`) VALUES
(3014, 'elektronika', 0, 1, 'elektronika', 'a:0:{}', 1, NULL, '', '', 0, 0, 1425574384, 1427707522),
(3015, 'planshety', 3014, 8, 'elektronika/planshety', 'a:1:{i:0;i:3014;}', 1, NULL, '', '', 0, 0, 1425574412, 1427706551),
(3017, 'audio', 3014, 10, 'elektronika/audio', 'a:1:{i:0;i:3014;}', 1, NULL, '', '', 0, 0, 1425574445, 1427706535),
(3018, 'noutbuki', 3023, 3, 'elektronika/kompiutery/noutbuki', 'a:2:{i:0;i:3014;i:1;i:3023;}', 1, NULL, '', '', 0, 0, 1425574535, 1425576032),
(3019, 'hranenie-dannyh', 3014, 6, 'elektronika/hranenie-dannyh', 'a:1:{i:0;i:3014;}', 1, NULL, '', '', 0, 0, 1425574633, 1425574633),
(3023, 'kompiutery', 3014, 2, 'elektronika/kompiutery', 'a:1:{i:0;i:3014;}', 1, NULL, '', '', 0, 0, 1425575999, 1425576004),
(3024, 'planshetnye-kompiutery', 3023, 4, 'elektronika/kompiutery/planshetnye-kompiutery', 'a:2:{i:0;i:3014;i:1;i:3023;}', 1, NULL, '', '', 0, 0, 1425576061, 1425576061),
(3025, 'pk-monobloki', 3023, 5, 'elektronika/kompiutery/pk-monobloki', 'a:2:{i:0;i:3014;i:1;i:3023;}', 1, NULL, '', '', 0, 0, 1425576131, 1425576131),
(3026, 'noutbuki2', 3014, 7, 'elektronika/noutbuki2', 'a:1:{i:0;i:3014;}', 1, NULL, '', '', 0, 0, 1425649108, 1427706558),
(3027, 'mebel', 0, 11, 'mebel', 'a:0:{}', 1, NULL, '', '', 0, 0, 1427714685, 1427714685),
(3028, 'sportivnye-tovary', 0, 12, 'sportivnye-tovary', 'a:0:{}', 1, NULL, '', '', 0, 0, 1427725735, 1427725735),
(3029, 'dom-i-sad', 0, 13, 'dom-i-sad', 'a:0:{}', 1, NULL, '', '', 0, 0, 1427794940, 1427794940),
(3030, 'detskie-tovary', 0, 14, 'detskie-tovary', 'a:0:{}', 1, NULL, '', '', 0, 0, 1427805256, 1427805256),
(3031, 'odezhda', 0, 15, 'odezhda', 'a:0:{}', 1, NULL, '', '', 0, 0, 1427810960, 1427812712);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_category_i18n`
--

DROP TABLE IF EXISTS `shop_category_i18n`;
CREATE TABLE IF NOT EXISTS `shop_category_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `description` text,
  `meta_desc` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_category_i18n_I_1` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_category_i18n`
--

INSERT INTO `shop_category_i18n` (`id`, `locale`, `name`, `h1`, `description`, `meta_desc`, `meta_title`, `meta_keywords`) VALUES
(3014, 'ru', 'Электроника', '', '', '', '', ''),
(3015, 'ru', 'Планшеты', '', '', '', '', ''),
(3017, 'ru', 'Аудио', '', '', '', '', ''),
(3018, 'ru', 'Ноутбуки', '', '', '', '', ''),
(3019, 'ru', 'Хранение данных', '', '', '', '', ''),
(3027, 'ru', 'Мебель', '', '', '', '', ''),
(3028, 'ru', 'Спортивные товары', '', '', '', '', ''),
(3029, 'ru', 'Дом и сад', '', '', '', '', ''),
(3023, 'ru', 'Компьютеры', '', '', '', '', ''),
(3024, 'ru', 'Планшетные компьютеры', '', '', '', '', ''),
(3025, 'ru', 'ПК моноблоки', '', '', '', '', ''),
(3026, 'ru', 'Ноутбуки', '', '', '', '', ''),
(3030, 'ru', 'Детские товары', '', '', '', '', ''),
(3031, 'ru', 'Одежда', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_comulativ_discount`
--

DROP TABLE IF EXISTS `shop_comulativ_discount`;
CREATE TABLE IF NOT EXISTS `shop_comulativ_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `discount` int(3) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `date` int(15) DEFAULT NULL,
  `total` int(255) DEFAULT NULL,
  `total_a` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_currencies`
--

DROP TABLE IF EXISTS `shop_currencies`;
CREATE TABLE IF NOT EXISTS `shop_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `main` tinyint(1) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `symbol` varchar(5) DEFAULT NULL,
  `rate` double(14,8) DEFAULT '1.00000000',
  `showOnSite` int(1) DEFAULT '0',
  `currency_template` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_currencies_I_1` (`name`),
  KEY `shop_currencies_I_2` (`main`),
  KEY `shop_currencies_I_3` (`is_default`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `shop_currencies`
--

INSERT INTO `shop_currencies` (`id`, `name`, `main`, `is_default`, `code`, `symbol`, `rate`, `showOnSite`, `currency_template`) VALUES
(1, 'Dollars', 1, 1, 'USD', '$', 1.00000000, 0, 'a:5:{s:19:"Thousands_separator";s:1:" ";s:14:"Separator_tens";s:1:",";s:14:"Decimal_places";s:1:"0";s:4:"Zero";s:1:"0";s:6:"Format";s:3:"$ #";}'),
(2, 'Рубль', 0, 0, 'RUB', 'руб', 0.40000000, 0, 'a:5:{s:19:"Thousands_separator";s:1:" ";s:14:"Separator_tens";s:1:",";s:14:"Decimal_places";s:1:"0";s:4:"Zero";s:1:"0";s:6:"Format";s:8:"# руб";}'),
(4, 'евро', 0, 0, 'EUR', '€', 0.01900000, 0, 'a:5:{s:19:"Thousands_separator";s:1:".";s:14:"Separator_tens";s:1:",";s:14:"Decimal_places";s:1:"0";s:4:"Zero";s:1:"1";s:6:"Format";s:5:"# €";}');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_delivery_methods`
--

DROP TABLE IF EXISTS `shop_delivery_methods`;
CREATE TABLE IF NOT EXISTS `shop_delivery_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` double(20,5) NOT NULL,
  `free_from` double(20,5) NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `is_price_in_percent` tinyint(1) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `delivery_sum_specified` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_delivery_methods_I_2` (`enabled`),
  KEY `shop_delivery_methods_I_1` (`enabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Дамп данных таблицы `shop_delivery_methods`
--

INSERT INTO `shop_delivery_methods` (`id`, `price`, `free_from`, `enabled`, `is_price_in_percent`, `position`, `delivery_sum_specified`) VALUES
(5, 80.00000, 5000.00000, 1, 0, NULL, 0),
(6, 0.00000, 0.00000, 1, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_delivery_methods_i18n`
--

DROP TABLE IF EXISTS `shop_delivery_methods_i18n`;
CREATE TABLE IF NOT EXISTS `shop_delivery_methods_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` text,
  `pricedescription` text,
  `delivery_sum_specified_message` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_delivery_methods_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_delivery_methods_i18n`
--

INSERT INTO `shop_delivery_methods_i18n` (`id`, `locale`, `name`, `description`, `pricedescription`, `delivery_sum_specified_message`) VALUES
(5, 'ru', 'Адресная доставка курьером', '<p>Сроки доставки: 1-2 дня</p>', '', ''),
(6, 'ru', 'Доставка экспресс службой', '<p>Сроки доставки 2-3 дня</p>', '', 'согласно тарифам перевозчиков');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_delivery_methods_systems`
--

DROP TABLE IF EXISTS `shop_delivery_methods_systems`;
CREATE TABLE IF NOT EXISTS `shop_delivery_methods_systems` (
  `delivery_method_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  PRIMARY KEY (`delivery_method_id`,`payment_method_id`),
  KEY `shop_delivery_methods_systems_FI_2` (`payment_method_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_delivery_methods_systems`
--

INSERT INTO `shop_delivery_methods_systems` (`delivery_method_id`, `payment_method_id`) VALUES
(5, 1),
(5, 2),
(5, 3),
(5, 9),
(5, 10),
(6, 2),
(6, 3),
(6, 9),
(6, 10),
(6, 11),
(15, 1),
(16, 1),
(16, 2),
(16, 3),
(20, 1),
(20, 3),
(21, 2),
(23, 3),
(24, 3),
(25, 1),
(25, 2),
(25, 3),
(25, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_discounts`
--

DROP TABLE IF EXISTS `shop_discounts`;
CREATE TABLE IF NOT EXISTS `shop_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_start` int(11) DEFAULT NULL,
  `date_stop` int(11) DEFAULT NULL,
  `discount` varchar(11) DEFAULT NULL,
  `min_price` float(10,2) DEFAULT NULL,
  `max_price` float(10,2) DEFAULT NULL,
  `categories` text,
  `products` text,
  `description` text,
  `user_group` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_gifts`
--

DROP TABLE IF EXISTS `shop_gifts`;
CREATE TABLE IF NOT EXISTS `shop_gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gift_key` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `espdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `shop_gifts`
--

INSERT INTO `shop_gifts` (`id`, `gift_key`, `active`, `price`, `created`, `espdate`) VALUES
(1, 'WTWWwPHJ4Al91jnZ', NULL, 100, 1354039607, 1354219200),
(2, '7WMAohSSCA3OViRL', NULL, 4, 1354039810, 1353700800),
(3, 'psnqw6IFxamCOCVmsd', NULL, 35, 1354039839, 1352404800);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_kit`
--

DROP TABLE IF EXISTS `shop_kit`;
CREATE TABLE IF NOT EXISTS `shop_kit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` smallint(6) NOT NULL,
  `only_for_logged` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shop_kit_FI_1` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `shop_kit`
--

INSERT INTO `shop_kit` (`id`, `product_id`, `active`, `position`, `only_for_logged`) VALUES
(17, 17234, 1, 0, 0),
(16, 17241, 1, 0, 0),
(18, 17242, 1, 0, 0),
(19, 17235, 1, 0, 0),
(20, 17247, 1, 0, 0),
(21, 17240, 1, 0, 0),
(22, 17259, 1, 0, 0),
(23, 17258, 1, 0, 0),
(24, 17261, 1, 0, 0),
(25, 17260, 1, 0, 0),
(26, 17252, 1, 0, 0),
(27, 17248, 1, 0, 0),
(28, 17253, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_kit_product`
--

DROP TABLE IF EXISTS `shop_kit_product`;
CREATE TABLE IF NOT EXISTS `shop_kit_product` (
  `product_id` int(11) NOT NULL,
  `kit_id` int(11) NOT NULL,
  `discount` varchar(11) DEFAULT '0',
  PRIMARY KEY (`product_id`,`kit_id`),
  KEY `shop_kit_product_FI_2` (`kit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_kit_product`
--

INSERT INTO `shop_kit_product` (`product_id`, `kit_id`, `discount`) VALUES
(17234, 16, '20'),
(17236, 16, '10'),
(17236, 17, '10'),
(17236, 18, '20'),
(17234, 19, '30'),
(17233, 20, '10'),
(17236, 20, '20'),
(17236, 21, '15'),
(17258, 22, '20'),
(17259, 23, '20'),
(17260, 24, '25'),
(17261, 25, '25'),
(17253, 26, '15'),
(17235, 27, '10'),
(17252, 28, '20');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_notifications`
--

DROP TABLE IF EXISTS `shop_notifications`;
CREATE TABLE IF NOT EXISTS `shop_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_phone` varchar(100) DEFAULT NULL,
  `user_comment` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `active_to` int(11) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `notified_by_email` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_notifications_I_1` (`user_email`),
  KEY `shop_notifications_I_2` (`user_phone`),
  KEY `shop_notifications_I_3` (`status`),
  KEY `shop_notifications_I_4` (`date_created`),
  KEY `shop_notifications_I_5` (`active_to`),
  KEY `shop_notifications_FI_1` (`product_id`),
  KEY `shop_notifications_FI_2` (`variant_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_notification_statuses`
--

DROP TABLE IF EXISTS `shop_notification_statuses`;
CREATE TABLE IF NOT EXISTS `shop_notification_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_notification_statuses_I_2` (`position`),
  KEY `shop_notification_statuses_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `shop_notification_statuses`
--

INSERT INTO `shop_notification_statuses` (`id`, `position`) VALUES
(1, 1),
(2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_notification_statuses_i18n`
--

DROP TABLE IF EXISTS `shop_notification_statuses_i18n`;
CREATE TABLE IF NOT EXISTS `shop_notification_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_notification_statuses_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_notification_statuses_i18n`
--

INSERT INTO `shop_notification_statuses_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Новый'),
(2, 'ru', 'Выполнен');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_orders`
--

DROP TABLE IF EXISTS `shop_orders`;
CREATE TABLE IF NOT EXISTS `shop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_key` varchar(255) NOT NULL,
  `delivery_method` int(11) DEFAULT NULL,
  `delivery_price` float(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `user_full_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `user_deliver_to` varchar(500) DEFAULT NULL,
  `user_comment` varchar(1000) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_updated` int(11) DEFAULT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `total_price` float(10,2) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `gift_cert_key` varchar(25) DEFAULT NULL,
  `gift_cert_price` float(10,2) DEFAULT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `discount_info` text,
  `origin_price` float(10,2) DEFAULT NULL,
  `user_surname` varchar(255) DEFAULT NULL,
  `comulativ` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_orders_I_1` (`order_key`),
  KEY `shop_orders_I_2` (`status`),
  KEY `shop_orders_I_3` (`date_created`),
  KEY `shop_orders_FI_1` (`delivery_method`),
  KEY `shop_orders_FI_2` (`payment_method`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Дамп данных таблицы `shop_orders`
--

INSERT INTO `shop_orders` (`id`, `order_key`, `delivery_method`, `delivery_price`, `status`, `paid`, `user_full_name`, `user_email`, `user_phone`, `user_deliver_to`, `user_comment`, `date_created`, `date_updated`, `user_ip`, `user_id`, `payment_method`, `total_price`, `external_id`, `gift_cert_key`, `gift_cert_price`, `discount`, `discount_info`, `origin_price`, `user_surname`, `comulativ`) VALUES
(52, '4284hw029z', 5, 80.00, 1, NULL, 'Виктория', 'oltarzhevskaya@gmail.com', '+07 (906) 760-26-63', 'Москва,Фрунзенская наб д34 кв 1', '', 1411422969, 1411422969, '188.123.241.158', 53, 1, 2107.00, NULL, NULL, NULL, NULL, NULL, 2107.00, NULL, NULL),
(53, '88kz90999j', 5, 80.00, 1, NULL, 'admin', 'ad@min.com', '+22 (323) 232-32-32', 'Водогинна', '', 1416225439, 1416225439, '127.0.0.1', 52, 2, 4076.00, NULL, NULL, NULL, NULL, NULL, 4076.00, NULL, NULL),
(54, '19135l59ir', 5, 80.00, 1, NULL, 'admin', 'ad@min.com', '+22 (323) 232-32-32', 'Водогинна', 'укукукук варрап врап', 1416226068, 1416226068, '127.0.0.1', 52, 2, 230.00, NULL, NULL, NULL, NULL, NULL, 230.00, NULL, NULL),
(55, '995a13ei17', 5, 80.00, 1, NULL, 'Valera', 'ad@min.com', '123123123123123', '', '', 1429276177, 1429276177, '194.44.123.242', 52, 10, 113.90, NULL, '6t3w206mc3x74ydz', 20.10, 0.00, 'product', 180.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_orders_products`
--

DROP TABLE IF EXISTS `shop_orders_products`;
CREATE TABLE IF NOT EXISTS `shop_orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `variant_name` varchar(255) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `origin_price` float(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `kit_id` int(11) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_orders_products_I_1` (`order_id`),
  KEY `shop_orders_products_FI_1` (`product_id`),
  KEY `shop_orders_products_FI_2` (`variant_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- Дамп данных таблицы `shop_orders_products`
--

INSERT INTO `shop_orders_products` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `price`, `origin_price`, `quantity`, `kit_id`, `is_main`) VALUES
(82, 52, 17232, 17945, 'Dermastir Caviar Luxury Mask - Маска на основе икры', '', 757.00, 757.00, 1, NULL, NULL),
(83, 52, 17233, 17946, 'Dermastir Peel Off Mask Whitening - Отбеливающая маска-пилинг', '', 100.00, 100.00, 6, NULL, NULL),
(84, 52, 17231, 17944, 'Dermastir Hyaluronic Post-OP Invisible Face Mask - Гиалуроновая маска', '', 125.00, 125.00, 6, NULL, NULL),
(85, 53, 17245, 17958, 'Lumene Vitamin C+ Pure Radiance Day Cream - Крем дневной для нормальной и сухой кожи', '', 68.00, 68.00, 2, 16, 1),
(86, 53, 17264, 17979, 'Peggy Sage Отшелушивающий крем для лица', '', 990.00, 990.00, 2, 16, 0),
(87, 53, 17268, 17983, 'Peggy Sage Отшелушивающий крем для лица для жирной и смешанной кожи 240 мл', '200 мл(копия)', 1500.00, 1500.00, 2, 16, 0),
(88, 54, 17249, 17964, 'Jean D''Arcel Olive Care 24h Creme Visage Riche – Питательный крем 24-часа', '', 230.00, 230.00, 1, NULL, NULL),
(89, 55, 17258, 18014, 'Детская кроватка Соня ЛД из экологически чистых материалов', 'Бук', 180.00, 180.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_orders_status_history`
--

DROP TABLE IF EXISTS `shop_orders_status_history`;
CREATE TABLE IF NOT EXISTS `shop_orders_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` int(11) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_orders_status_history_I_1` (`order_id`),
  KEY `shop_orders_status_history_FI_2` (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Дамп данных таблицы `shop_orders_status_history`
--

INSERT INTO `shop_orders_status_history` (`id`, `order_id`, `status_id`, `user_id`, `date_created`, `comment`) VALUES
(98, 98, 1, 49, 1379849023, ''),
(97, 97, 1, 49, 1379590750, ''),
(99, 93, 1, 49, 1387376212, '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_order_statuses`
--

DROP TABLE IF EXISTS `shop_order_statuses`;
CREATE TABLE IF NOT EXISTS `shop_order_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `fontcolor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_order_statuses_I_2` (`position`),
  KEY `shop_order_statuses_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `shop_order_statuses`
--

INSERT INTO `shop_order_statuses` (`id`, `position`, `color`, `fontcolor`) VALUES
(1, 0, '#5aad5a', '#ffffff'),
(2, 3, '#7d7c7d', '#ffffff');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_order_statuses_i18n`
--

DROP TABLE IF EXISTS `shop_order_statuses_i18n`;
CREATE TABLE IF NOT EXISTS `shop_order_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_order_statuses_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_order_statuses_i18n`
--

INSERT INTO `shop_order_statuses_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Новый'),
(2, 'ru', 'Доставлен');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_payment_methods`
--

DROP TABLE IF EXISTS `shop_payment_methods`;
CREATE TABLE IF NOT EXISTS `shop_payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `payment_system_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_payment_methods_I_2` (`position`),
  KEY `shop_payment_methods_FI_1` (`currency_id`),
  KEY `shop_payment_methods_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `shop_payment_methods`
--

INSERT INTO `shop_payment_methods` (`id`, `active`, `currency_id`, `position`, `payment_system_name`) VALUES
(1, 1, 1, 0, 'WebMoneySystem'),
(2, 1, 1, 1, 'OschadBankInvoiceSystem'),
(3, 1, 1, 2, 'SberBankInvoiceSystem'),
(4, 1, 1, 3, 'RobokassaSystem');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_payment_methods_i18n`
--

DROP TABLE IF EXISTS `shop_payment_methods_i18n`;
CREATE TABLE IF NOT EXISTS `shop_payment_methods_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_payment_methods_i18n_I_1` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_payment_methods_i18n`
--

INSERT INTO `shop_payment_methods_i18n` (`id`, `locale`, `name`, `description`) VALUES
(1, 'ru', 'Оплата курьеру', '<p>Оплата через веб-моней</p>'),
(2, 'ru', 'Оплата через Банк', '<p>Оплата через ОщадБанк Украины</p>'),
(3, 'ru', 'СберБанк России', '<p>Оплата через СберБанк России</p>'),
(4, 'ru', 'Robokassa', '<p>Оплата с помощью Robokassa</p>'),
(1, 'en', 'Payment for the courier', ''),
(2, 'en', 'Payment by bank', ''),
(3, 'en', 'Sberbank of Russia', ''),
(4, 'en', 'Robokassa', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_products`
--

DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE IF NOT EXISTS `shop_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `hit` tinyint(1) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `related_products` varchar(255) DEFAULT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `old_price` double(12,2) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `hot` tinyint(1) DEFAULT NULL,
  `action` tinyint(1) DEFAULT NULL,
  `added_to_cart_count` int(11) DEFAULT NULL,
  `enable_comments` tinyint(1) DEFAULT '1',
  `external_id` varchar(255) DEFAULT NULL,
  `tpl` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_products_I_2` (`url`),
  KEY `shop_products_I_3` (`brand_id`),
  KEY `shop_products_I_4` (`category_id`),
  KEY `shop_products_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17263 ;

--
-- Дамп данных таблицы `shop_products`
--

INSERT INTO `shop_products` (`id`, `url`, `active`, `hit`, `brand_id`, `category_id`, `related_products`, `created`, `updated`, `old_price`, `views`, `hot`, `action`, `added_to_cart_count`, `enable_comments`, `external_id`, `tpl`, `user_id`) VALUES
(17233, 'koss-pro4s', 1, 0, 279, 3017, NULL, 1425640456, 1429604818, 0.00, 39, 0, 0, 0, 1, NULL, '', NULL),
(17234, 'koss-bt540i', 1, 0, 279, 3017, '17238,17236', 1425644183, 1429608460, 0.00, 11, 0, 0, 0, 1, NULL, '', NULL),
(17235, 'minisistema-mx-f730db', 1, 0, 282, 3017, '17233', 1425646676, 1427880801, 130.00, 20, 0, 1, 0, 1, NULL, '', NULL),
(17236, 'goodram-twister-30', 1, 0, 278, 3019, NULL, 1425649225, 1427881028, 0.00, 7, 0, 0, 0, 1, NULL, '', NULL),
(17237, 'goodram-ssd-c40', 1, 0, 0, 3019, NULL, 1425650054, 1427881088, 0.00, 11, 0, 0, 0, 1, NULL, '', NULL),
(17238, 'goodram-sd-uhs-1', 1, 1, 278, 3019, NULL, 1425651955, 1427881043, 0.00, 9, 1, 0, 0, 1, NULL, '', NULL),
(17239, 'impression-studio-al-2311', 1, 0, 275, 3025, NULL, 1425906865, 1427881373, 0.00, 10, 0, 0, 0, 1, NULL, '', NULL),
(17240, 'impad-0314', 1, 0, 275, 3015, NULL, 1425909060, 1427881638, 120.00, 23, 0, 1, 0, 1, NULL, '', NULL),
(17241, 'ipad-air', 1, 1, 276, 3015, NULL, 1425911422, 1427881978, 0.00, 14, 0, 0, 0, 1, NULL, '', NULL),
(17242, 'nexus-9', 1, 1, 280, 3015, '17238,17234', 1425913547, 1429608550, 0.00, 19, 1, 0, 0, 1, NULL, '', NULL),
(17243, 'lenovo-ideapad-yoga', 1, 0, 284, 3026, NULL, 1425914940, 1429273920, 0.00, 26, 0, 0, 0, 1, NULL, '', NULL),
(17244, 'sony-vaio-svl2413m1r-b', 1, 0, 0, 3025, NULL, 1425918481, 1427881393, 0.00, 9, 0, 0, 0, 1, NULL, '', NULL),
(17245, 'lg-29v950', 1, 0, 283, 3025, NULL, 1425919606, 1427881367, 0.00, 8, 0, 0, 0, 1, NULL, '', NULL),
(17246, 'asus-x200ma-x200ma-kx506d', 1, 0, 277, 3018, NULL, 1425920971, 1429608696, 0.00, 11, 0, 0, 0, 1, NULL, '', NULL),
(17247, 'asus-transformer-book-t100ta', 1, 0, 277, 3018, '17242,17237', 1425921653, 1427882239, 240.00, 57, 1, 1, 0, 1, NULL, '', NULL),
(17248, 'ortopedicheskoe-ofisnoe-kreslo', 1, 1, 285, 3027, '17257,17250', 1427715900, 1427882658, 0.00, 14, 0, 0, 0, 1, NULL, '', NULL),
(17249, 'mini-divan', 1, 0, 286, 3027, '17259,17258', 1427719001, 1429608535, 120.00, 26, 0, 1, 0, 1, NULL, '', NULL),
(17250, 'kom4d', 1, 0, 287, 3027, '17259,17248', 1427721322, 1429607965, 0.00, 15, 0, 0, 0, 1, NULL, '', NULL),
(17251, 'lk-sport-cf-k', 1, 0, 288, 3028, '17260,17253', 1427728236, 1429608675, 0.00, 15, 1, 0, 0, 1, NULL, '', NULL),
(17252, 'adidas-weighted-west', 1, 0, 288, 3028, '17253,17251', 1427730618, 1427882811, 220.00, 24, 0, 1, 0, 1, NULL, '', NULL),
(17253, 'osprey-quantum-34', 1, 1, 289, 3028, '17251,17242,17233', 1427735387, 1427882925, 135.00, 36, 0, 1, 0, 1, NULL, '', NULL),
(17254, 'benzopila-stihl-ms-180', 1, 1, 290, 3029, '17256,17255', 1427796316, 1429274088, 0.00, 20, 0, 0, 0, 1, NULL, '', NULL),
(17255, 'kultivator-sadko-t-600', 1, 0, 291, 3029, '17256,17254', 1427798488, 1429274046, 0.00, 22, 1, 0, 0, 1, NULL, '', NULL),
(17256, 'forte-cl-16a', 1, 0, 291, 3029, '17255,17254', 1427800135, 1429608167, 0.00, 10, 0, 0, 0, 1, NULL, '', NULL),
(17257, 'futbol-nastolnyi', 1, 1, 292, 3030, '17250,17248', 1427806058, 1427822153, 0.00, 15, 1, 0, 0, 1, NULL, '', NULL),
(17258, 'detskaia-krovatka-sonia-ld', 1, 1, 292, 3030, '17262,17250,17249', 1427807401, 1427884090, 200.00, 63, 0, 1, 1, 1, NULL, '', NULL),
(17259, 'detskii-shkaf', 1, 0, 292, 3030, '17262,17258,17250', 1427809683, 1429607990, 0.00, 11, 0, 0, 0, 1, NULL, '', NULL),
(17260, 'dzhemper-s-kapiushonom', 1, 0, 288, 3031, '17261,17253,17251', 1427812985, 1429514536, 0.00, 25, 0, 0, 0, 1, NULL, '', NULL),
(17261, 'detskie-briuki', 1, 1, 288, 3031, '17260,17251', 1427815032, 1427883846, 0.00, 14, 0, 0, 0, 1, NULL, '', NULL),
(17262, 'sling-sharf-dlia-detei-do-3-h-let', 1, 1, 293, 3030, '17259,17258,17250', 1427819033, 1429523085, 0.00, 41, 0, 0, 0, 1, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_products_i18n`
--

DROP TABLE IF EXISTS `shop_products_i18n`;
CREATE TABLE IF NOT EXISTS `shop_products_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  `short_description` text,
  `full_description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_products_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_products_i18n`
--

INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(17233, 'ru', 'Наушники профессиональные KOSS Pro4S', 'Создай свой звук с мощными студийными наушниками Koss Pro4S! Модель снабжена 40-миллиметровыми драйверами SLX40, которые обеспечивают глубокие басы с четкой звукопередачей, а также чистые высокие частоты.', '<p>Наушники имеют легкую конструкцию и обладают улучшенной звукоизоляцией.</p>\n<p>Уникальные чашки D-образной формы плотно облегают уши, амбюшуры и оголовье выполнены из мягкой эко-кожи всё это дарит бесконечное чувство комфорта при длительном использовании. Оба наушника Koss Pro4S оборудованы разъемами для соединительного кабеля, в свободный разъем можно подключить вторые наушники для совместного прослушивания музыки.<br /><br /><iframe src="//www.youtube.com/embed/FPMBMMj6fI8" width="620" height="510"></iframe></p>', '', '', ''),
(17234, 'ru', 'Наушники профессиональные Koss BT540i', 'Полноразмерные наушники с возможностью беспроводной передачи аудиосигнала по Bluetooth- или NFC-соединению.', '<p>Модель имеет съёмный кабель и складную конструкцию, что удобно для хранения и транспортировки. Наушники отличаются комфортной посадкой за счет удобного оголовья, покрытого мягкой кожей сверху и приятным велюром с внутренней стороны.</p>\n<p>Ещё один важный момент: KOSS BT540i &mdash; не просто наушники, а гарнитура. На съёмном кабеле микрофонов нет, они находятся на правой чаше. Микрофонов два, что помогает отсекать внешний шум и повышает качество передачи речи. Основной микрофон &mdash; голосовой &mdash; расположен на чаше рядом с входом micro-USB. Второй, используемый в паре с основным для подавления внешних шумов, находится рядом с креплением чаши и выглядит, как небольшая полость в правом наушнике.<br /><br /><iframe src="//www.youtube.com/embed/lahJlYdVbTw" width="625" height="515"></iframe></p>', '', '', ''),
(17235, 'ru', 'Акустическая минисистема MX-F730DB', 'Дополните вашу мини-систему функцией Samsung Giga Sound Blast. Благодаря функции Giga Sound Blast, вы улучшите качество звука вашей мини-системы.', '<p>Пользуйтесь функцией записи радиопрограмм, встроенной в вашу мини-систему. Установив время записи радиопрограммы, вы можете записать передачу в течение любого периода времени, благодаря чему вы никогда не пропустите интересную передачу. Установите любое расписание для записи своих любимых радиопрограмм.</p>\n<p>Оцените быстроту и простоту создания MP3 файлов с любого источника музыки. Втроенная функция EZ MP3 Maker позволяет использовать вашу аудиосистему для перезаписи треков с CD дисков или записи музыкальных передач с FM радио или входа AUX. С помощью специального кабеля вы можете подключить деку для виниловых пластинок и переписать музыку на цифровой носитель. Теперь вы легко сможете перевести свою музыкальную коллекцию на виниловых пластинках в современный цифровой формат.</p>', '', '', ''),
(17248, 'ru', 'Ортопедическое кресло из экологически чистых материалов', '', '<p>Наличие подголовника - позволяет облокотиться и расслабить не только спину, но и шею, и частично плечи, что необходимо при длительной работе. Подголовники могут быть встроенными, либо приставными, некоторые кресла оснащены дополнительными возможностями регулировки подголовников по высоте или углу наклона.</p>\n<p>Профилированная спинка -спинка, имеющая анатомически правильную форму, повторяющая естественный изгиб позвоночника, создаваемый кривизной поясничной опоры и изгибом грудного отдела позвоночного столба. Такая спинка позволяет сохранять естественный кровоток для питания позвоночника и головного мозга. Что благотворно сказывается на здоровье и самочувствии.</p>\n<p>Состав - Хромированные детали , Каркас металлический; Ткань - Кожа , Эко кожа , Эко кожа перфорированная.</p>\n<ul>\n<li>Ширина раскладки - 70</li>\n<li>Ширина - 70</li>\n<li>Высота - 135 , 155</li>\n<li>Глубина - 70 , 100</li>\n<li>Гарантия качества - 12 месяцевх</li>\n</ul>\n<br /><iframe src="//www.youtube.com/embed/fbRccIgAEyU" width="625" height="515"></iframe>', '', '', ''),
(17236, 'ru', 'Устройство хранения данных, флеш накопитель GOODRAM Twister 3.0', '', 'Универсальность и функциональность &mdash; это важнейшие свойства GOODRAM Twister 3.0. Прочный корпус с металлической поворотной скобой не только превосходно защищает хранящиеся данные, но и позволяет не беспокоиться о колпачке, который может потеряться. GOODRAM Twister 3.0, в отличие от аналогичных продуктов на рынке, характеризуется фирменными компонентами и пожизненной гарантией а также быстрым интерфейсом 3.0.', '', '', ''),
(17237, 'ru', 'Устройство хранения данных, жесткий диск GOODRAM SSD C40', '', 'Диски C 50 оснащены надежными чипами памяти MLC марки Toshiba, контроллером PS3108, а также до 512 Мб памяти DDR3. В то же время диски серии C 50 являются, вероятно, одними из самых экономичных дисков SSD на рынке! Диски оснащены контроллером C3108, который по сравнению с другими популярных решениями, используемыми в дисках SSD, еще с большей производительностью обрабатывает несжимаемые файлы', '', '', ''),
(17238, 'ru', 'Устройство хранения данных, карта памяти GOODRAM SD UHS 1', '', '<p>Даже самое современное оборудование без надлежащей карты теряет свои возможности. Карта GOODRAM SDHC/SDXC UHS 1 предназначена для пользователей, которые хотят в полной мере использовать возможности своего фотоаппарата или камеры.</p>\n<p>Она применяется как в повседневных, так и в самых продвинутых приложениях. Технология UHS 1 обеспечивает самые лучшие параметры, а также стабильную и надежную работу вашего устройства. Теперь даже самые профессиональные операции выполняются без малейших проблем. Вы откроете для себя новые горизонты фотографии!</p>', '', '', ''),
(17239, 'ru', 'Мультимедийный моноблок - Impression Studio AL 2311', '', 'Impression Studio AL 2311 &mdash; это и мощный персональный компьютер и медиацентр одновременно, &nbsp;помещенные в стильный монитор толщиной всего 55 мм. Благодаря элегантному дизайну и эргономичности такой ПК украсит любое рабочеее место или домашний интерьер, занимая при этом минимум пространства. VESA-крепление позволит устройству легко разместиться и функционировать даже на стене вашего помещения. Идеален в качестве домашнего развлекательного центра (для просмотра телепередач, видео, различных игр).<br /><br /><iframe src="//www.youtube.com/embed/i1Bp8xYytZw" width="625" height="515"></iframe>', '', '', ''),
(17240, 'ru', 'Планшет на базе  Android - Impression ImPAD 0314', '', '<p>Планшет Impression ImPAD 5214 7" IPS (1024x600)//двухъядерный Rockchip 3026 (ядро ARM Cortex-A9) 1.0 ГГц//1024 MB DDR3//8 ГБ//Wi-Fi//Веб-камера 0.3 Мп, 2.0 Мп//Android 4.4.2//</p>\n<p>Гарантия 12 месяцев</p>\n<p><iframe src="//www.youtube.com/embed/rDj0empJ3vY" width="625" height="515"></iframe></p>', '', '', ''),
(17241, 'ru', 'Высокопроизводительный планшет на Mac OS - iPad Air', '', '<p>Первое, на что обращаешь внимание &mdash; насколько тонкое и лёгкое устройство у вас в руках. Толщина iPad Air 2 &mdash; всего 6,1 миллиметра. Это наш самый тонкий iPad. А весит он менее 450 грамм. Его ещё легче держать одной рукой и брать с собой повсюду.</p>\n<p>Самый первый iPad, представленный четыре года назад, задал стандарты толщины и веса. И с каждым разом мы делаем iPad ещё тоньше и ещё легче. Но при этом, благодаря алюминиевому корпусу iPad Air 2 остаётся таким же прочным. Стоит взять устройство в руки &mdash; и вы сразу поймёте, насколько он крепкий и монолитный.<br /><br /><iframe src="//www.youtube.com/embed/BCqJGoCMlVc" width="625" height="515"></iframe></p>', '', '', ''),
(17242, 'ru', 'Высокопроизводительный планшет Nexus 9', '', '<p>Созданный для работы и развлечений Nexus 9 имеет матовый металлический корпус с мягкой на ощупь крышкой и оснащен лучшим программным обеспечением Google и Android, предоставляющим практически безграничные возможности для развлечений и работы с бизнес-приложениями.</p>\n<p>Для активных и инициативных</p>\n<ul>\n<li>Экран 8,9 дюйма</li>\n<li>Вынесенные на переднюю панель стереодинамики</li>\n<li>Доступ более чем к миллиону приложений</li>\n<li>Автоматическое обновление ОС Android</li>\n<li>Легкая интеграция устройства</li>\n</ul>\n<iframe src="https://sketchfab.com/models/e70cfba33ab441409a43b0ab6cf360bd/embed" width="640" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>\n<p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4a4a4a;"><a style="font-weight: bold; color: #1caad9;" href="https://sketchfab.com/models/e70cfba33ab441409a43b0ab6cf360bd?utm_source=oembed&amp;utm_medium=embed&amp;utm_campaign=e70cfba33ab441409a43b0ab6cf360bd" target="_blank">Google Nexus 9 - Sand</a> by <a style="font-weight: bold; color: #1caad9;" href="https://sketchfab.com/htc?utm_source=oembed&amp;utm_medium=embed&amp;utm_campaign=e70cfba33ab441409a43b0ab6cf360bd" target="_blank">HTC</a> on <a style="font-weight: bold; color: #1caad9;" href="https://sketchfab.com?utm_source=oembed&amp;utm_medium=embed&amp;utm_campaign=e70cfba33ab441409a43b0ab6cf360bd" target="_blank">Sketchfab</a></p>', '', '', ''),
(17243, 'ru', 'Мультимедийный центр - Lenovo IdeaPad Yoga', '', '<p>По сравнению с обычными трансформируемыми форм-факторами запатентованное шарнирное крепление дисплея Yoga отличается большей устойчивостью и прочностью, а ноутбук имеет более тонкий и лёгкий корпус. Yoga является самым тонким в мире трансформируемым ультрабуком. Его толщина составляет 15.6 мм, а вес равен 1.27 кг. Ноутбук Yoga оснащён процессором nVidia Tegra 3, поставляется с операционной системой Windows RT и может работать 13 часов без подзарядки аккумулятора. Объём оперативной памяти составляет 2 ГБ, а ёмкость твердотельного накопителя &mdash; 32 ГБ.</p>\n<p>Кроме того, этот полноформатный ноутбук с гибкой конструкцией имеет небольшие, но необходимые детали, такие как мягкое каучуковое покрытие на корпусе, предотвращающее скольжение устройства, кожаное покрытие на панели для опоры рук и боковые кнопки для удобства использования всех режимов.</p>\n<iframe src="//www.youtube.com/embed/gChMBcprtZI" width="625" height="515"></iframe>', '', '', ''),
(17244, 'ru', 'Высокопроизводительный моноблок - Sony VAIO SVL2413M1R/B', '', '<p>Универсальный компьютер с сенсорным экраном, оснащенным технологией Sony TV</p>\n<ul>\n<li>Компьютер с плоским сенсорным экраном для всех развлечений</li>\n<li>Получайте удовольствие от изображения и звука в режиме 3D без всяких очков</li>\n<li>Мгновенное переключение VAIO в режим TVM</li>\n</ul>\n<p>Компьютер VAIO &mdash; это развлечение для всей семьи. Он имеет стильную моноблочную конструкцию, достаточно тонкую, чтобы разместиться в самом узком месте. Плоский большой экран мультитач создает современный облик, а щелевой дисковод для оптических дисков прост и удобен в эксплуатации.</p>\n<p>Панель мультитач, поддерживающая десять точек, позволяет управлять всеми пальцами одновременно. Теперь вы сможете действительно воспользоваться самыми захватывающими и полезными сенсорными возможностями Windows 8.</p>', '', '', ''),
(17245, 'ru', 'Моноблок с изогнутым экраном - LG 29V950', '', '<p>В десктопе с обозначением 29V950 применена IPS-панель формата WFHD (2560 &times; 1080 точек), обладающая яркостью 300 кд/м2 и контрастностью 1000:1. Угол обзора по горизонтали достигает 178 градусов.</p>\n<p>Моноблок выполнен на аппаратной платформе Intel Broadwell. Он оборудован 14-нанометровым двухъядерным процессором Core i5-5200U с тактовой частотой 2,2 ГГц (повышается до 2,7 ГГц). Чип трудится в тандеме с 8 Гбайт оперативной памяти. Видеоподсистема полагается на ускоритель NVIDIA GeForce 840M с 2 Гбайт памяти.</p>', '', '', ''),
(17246, 'ru', 'Производительный портативный нетбук - ASUS X200MA (X200MA-KX506D)', '', '<p>Важными аргументами в пользу приобретения ASUS X200MA можно считать внешнюю привлекательность и небольшие габариты/вес, хорошие характеристики в области производительности, эргономики и автономности, расширенный набор инструментов для взаимодействия с внешними устройствами.</p>\n<p>Ключевым элементом данного ноутбука выступает скоростной процессор из семейства Intel. В дополнение к нему идут интегрированный видеоадаптер Intel HD Graphics и DDR3-память с максимальным объемом 4 ГБ. Учитывая такую конфигурацию, ASUS X200MA способен справиться с множеством современных приложений и программ, как офисного и сетевого, так и мультимедийного развлекательного характера.</p>\n<p>Отдельно в ASUS X200MA стоит выделить четкий 11,6" дисплей с разрешением 1366x768 точек и системой LED-подсветки, фирменную аудиотехнологию ASUS SonicMaster и веб-камеру формата 720p для видеозвонков.</p>', '', '', ''),
(17247, 'ru', 'Энергоэкономный ноутбук два в одном - ASUS Transformer Book', '', '<p>Kомпактный ноутбук 2-в-1 из модельного ряда 2013 года, построенный на базе платформы Bay Trail (четырехъядерного процессора Intel Atom Z3740 с тактовой частотой 1,33 ГГц). Оперативной памяти в данном устройстве предусмотрено 2 Гб, в качестве видеоускорителя используется встроенная графика Intel HD Graphics.</p>\n<p>В комплексе с ОС Windows 8.1 все это гарантирует не просто высокую скорость загрузки различных приложений офисного и мультимедийного характера, но и полный комфорт работы в режиме многозадачности. Кроме этого в комплект ноутбука входит Microsoft Office Home &amp; Student 2013, благодаря чему сразу после первого включения вы сможете работать, а не отвлекаться на установку программного обеспечения.</p>\n<p>Дисплей, которым оснащен ASUS Transformer Book T100TA, мультисенсорный, глянцевый, изготовлен по технологии IPS, обладает разрешением HD, широкими углами обзора и превосходной цветопередачей. Аудиосистема, в свою очередь, включает в себя мощные стереодинамики с увеличенными резонансными камерами и передовой технологией ASUS SonicMaster. Что касается времени автономной работы новинки, оно заявлено на уровне 11 часов.</p>\n<p><iframe src="//www.youtube.com/embed/RFqDjBW1r9U" width="627" height="516"></iframe></p>', '', '', ''),
(17249, 'ru', 'Мини диван раскладной для детской и кухни', '', '<p>Такой диванчик идеально подойдет для прихожей, заменив собой неудобный табурет, теперь вы сможете обуваться с комфортом. Естественно, для такого помещения следует подбирать максимально компактную модель более темных тонов, тогда мебель прослужит вам дольше и ее не надо будет чистить чуть ли не через день.</p>\n<ul>\n<li>Размеры: 90хСп.</li>\n<li>Спальное место: 205x90 см</li>\n<li>Раскладка: аккордеон</li>\n<li>Каркас: металлический</li>\n<li>Наполнение: ламели и ППУ</li>\n<li>Обивка: ткань мебельная</li>\n</ul>', '', '', ''),
(17250, 'ru', 'Компактный комод KOM4D', '', '<p>Современный стильный комод имеет компактные габариты, что никак не влияет на его функциональность и практичность. Отметим, что данный комод изготавливается только в одной комбинации цвета, как показано на главном изображении товара. Данный комод состоит из трех одинаковых выдвижных ящичков и одного большого отделения с распашной дверцей, предназначенной для спиртных и прочих напитков, но вы, конечно же, можете это отделение использовать по собственному назначению.</p>\n<ul>\n<li>Размеры комода: 800х1285х370.</li>\n<li>Цвет: темный орех / венге св.</li>\n<li>Материал: корпус ДСП, фасад ДСП.</li>\n</ul>', '', '', ''),
(17251, 'ru', 'Кроссовки для бега - Adidas lk-sport CF K', '', '<p>Удобная беговая модель обуви на липучке. Верх кроссовок из высококачественного кожзаменителя, усиленного синтетическими накладками для прочности и поддержки стопы. Внутри кроссовок текстильная подкладка. Стелька с технологией Adidas OrthoLite&reg; для вентиляции и защиты от образования грибка, бактерий и неприятного запаха. Резиновая подошва Non-marking с бороздками для гибкости, не оставляющая следов на поверхности:</p>\n<ul>\n<li>Верх из дышащей текстильной сетки и легких синтетических</li>\n<li>материалов.</li>\n<li>Промежуточная подошва со вставками из ЭВА для устойчивости</li>\n<li>и комфорта.</li>\n<li>Немаркая подметка из прочной резиновой смеси.</li>\n<li>Вынимаемая стелька adiFIT с антимикробным покрытием OrthoLite</li>\n<li>помогает подобрать подходящий размер обуви.</li>\n</ul>\n<br /><iframe src="//www.youtube.com/embed/uiQVkoDlBbQ" width="625" height="515"></iframe>', '', '', ''),
(17252, 'ru', 'Спортивный жилет утяжелитель для бега - Adidas Weighted West', '', '<p>Как показали многочисленные исследования &ndash; используя утяжелители, спортсмен сжигает намного большее количество калорий. И если для мужчин тренировки с подобного рода инвентарем вполне естественны, то большинство женщин, тем не менее, чаще всего не используют его в своих занятиях из страха, что это приведет к чрезмерной раскачке мышц.</p>\n<ul>\n<li>Вес (максимальный) - кг 10</li>\n<li>Материал утяжелителей - металлический песок</li>\n<li>Структура утяжелителей - насыпные</li>\n</ul>\n<br /><iframe src="//www.youtube.com/embed/-qW1ABTHOvk" width="624" height="514"></iframe>', '', '', ''),
(17253, 'ru', 'Туристический рюкзак с отделением для ноутбука - Osprey Quantum 34', '', '<p>Эргономичный дизайн - это первое, что бросается в глаза при взгляде на рюкзак Osprey Quantum 34. Функциональный и универсальный Osprey Quantum 34 предусмотрен в основном для повседневного использования в городе. Он оснащён двумя большими карманами с боковым замком и передним эластичным карманом.</p>\n<p>Поскольку рюкзак Osprey Quantum 34 достаточно объёмный и вместительный, его можно рассматривать как отличный вариант для любителей недалёких поездок. Производитель удачно предусмотрел такие детали, как карман для МР3 плеера и петля для ледоруба, что делает его ещё более интересным и универсальным.</p>\n<p>Верхняя мягкая ручка и спина с использованием технологии AirScape обеспечивают максимально комфортное ношение. Конечно же, прогресс не стоит на месте, и для любителей техники предусмотрен эластичный карман для ноутбука (15.4"). Абсолютное качество и отлично продуманные детали сделают рюкзак Osprey Quantum 34 незаменимым помощником для Вас</p>', '', '', ''),
(17254, 'ru', 'Бензопила высокой мощности, с комплектом насадок STIHL MS 180', '', '<p>Одна из самых популярных моделей среди бензопил STIHL MS 180 заметно выделяется простотой в эксплуатации, компактными размерами и небольшим весом, что обеспечивает дополнительный комфорт во время работы с ней. STIHL MS 180 достаточно мощная, чтобы вы смогли на своем участке сделать заготовку дров, выполнить работы с деревом для строительства или привести в порядок деревья в саду. Преимуществами этой модели являются система легкого старта ErgoStart, устройство быстрого натяжения цепи и электронное зажигание. Приятным дополнением станет наличие системы &laquo;QuikStop&raquo;, обеспечивающей хорошую защиту от отдачи и снижение уровня вибрации, что дает вам возможность долго наслаждаться надежной и приятной работой с STIHL MS 180.</p>\n<ul>\n<li>Питание - бензин</li>\n<li>Мощность двигателя - 1,5 л.с.</li>\n<li>Длина шины, мм - 300/350</li>\n<li>Масса - 3,9 кг.</li>\n<li>Блокировка кнопки включения</li>\n<li>Автоматическая смазка цепи</li>\n<li>Тормоз цепи</li>\n</ul>\n<p><iframe src="//www.youtube.com/embed/kMBO08AWQSo" width="630" height="519"></iframe></p>', '', '', ''),
(17255, 'ru', 'Мотокультиватор бензиновый, большой мощности - SADKO T-600', '', '<p>Практичный в эксплуатации небольшой культиватор SADKO T-600 способен значительно облегчить целый ряд земельных работ в сельском хозяйстве. На SADKO T-600 надежный четырехтактный двигатель, дополненный воздушным охлаждением и ручным стартером с достаточной мощностью, чтобы обработать любой тип почвы на участках до 40 соток. Предусмотрена также и трехступенчатая коробка передач, что делает эту модель максимально маневренной и легкой в управлении. SADKO T-600 рассчитан на ширину обработки почвы в 60 см с глубиной в 15 см, в нем достаточно просто регулируются рукоятки, что позволит комфортно работать человеку с любым ростом.</p>\n<ul>\n<li>Питание - бензин/дизель</li>\n<li>Двигатель - четырехтактный, с воздушным охлаждением</li>\n<li>Мощность двигателя - 6,5 (4,8) л.с</li>\n<li>Обьем топливного бака - 4 л.</li>\n<li>Ширина захвата культивации - 60 см.</li>\n<li>Рабочая глубина - 15 см.</li>\n</ul>\n<br /><iframe src="//www.youtube.com/embed/ySFJjZNiLzI" width="630" height="519"></iframe>', '', '', ''),
(17256, 'ru', 'Садовый распылитель для ухода за кустарниками - Forte CL-16A', '', '<p>С таким опрыскивателем, как Forte CL-16A, работать одно удовольствие. Он прост в эксплуатации, имеет достаточно компактную конструкцию эргономичной формы и небольшим весом, практически не требующую обслуживания, и надежное исполнение. Forte CL-16A способен работать длительное время от заряда аккумулятора, показывая при этом высокую производительность и позволяя распылять препарат в радиусе до 12 м, регулируя мощность струи распыления. Телескопическая распылительная трубка, входящая в комплект, изготовлена из нержавеющей стали, позволит обрабатывать деревья в саду, а объемный бак в Forte CL-16A, рассчитанный на 16 л, обеспечит обработку территории без необходимости остановок.</p>\n<ul>\n<li>Дальность (радиус) распыления - до 12 м.</li>\n<li>Длина распылительной трубки - 65-110 см</li>\n<li>Объем бака - 16 л.</li>\n<li>Тип двигателя - электрический (аккумулятор 8 Ач)</li>\n<li>Мощность двигателя - 12 кВт</li>\n<li>Продолжительность автономной работы, 4 ч.</li>\n</ul>\n<p><iframe src="//www.youtube.com/embed/Z03h_kBNsOY" width="630" height="519"></iframe></p>', '', '', ''),
(17257, 'ru', 'Футбол настольный', '', '<p>Стабильный конструкция представленного оборудования подходит как для профессиональной игры в пабах, так и в домашних условиях! Фигурки футболистов размещены на укреплённых стальных рельсах. Особого внимания заслуживает внутренняя часть игрового поля нейтрального зеленого цвета (не отвлекает внимания игроков и обеспечивает полный контроль за движением мячика).</p>\n<p>Корпус настольного футбола выполнен из высококачественного дерева и ламинированного МДФ. Стол имеет удобные отверстия на задней части ворот для вытаскивания мяча, после забитого гола.</p>\n<p>Наш настольный футбол имеет высококачественные детали и является крепким и надежным (см. фото и убедитесь сами). Обратите внимание! Специально подготовленный дизайн стола предоставит вам непрерывное развлечение, благодаря увеличеным углам поля (мяч не будет останавливаться во время игры).</p>\n<p><strong>Габариты стола</strong></p>\n<ul>\n<li>Габариты стола: 119,5 x 61 x 79cм</li>\n<li>Габариты игрового поля : 102x58cм</li>\n<li>Габариты после упаковки : 125,5 x 60,5 x 12cм</li>\n</ul>', '', '', ''),
(17258, 'ru', 'Детская кроватка Соня ЛД из экологически чистых материалов', '', '<p>Характеристики кроватки:</p>\n<ul>\n<li>Поперечный маятниковый механизм для укачивания c фиксатором;</li>\n<li>Вместительный, закрытый, подкроватный ящик на телескопических направляющих;</li>\n<li>Колесики для удобного перемещения по комнате;</li>\n<li>Основание для матраса с двумя уровнями регулирования по высоте;</li>\n<li>Подвижная боковина;</li>\n<li>Надежный механизм опускания бортика;</li>\n<li>Все детали кроватки имеют безопасные округлые формы и полированные поверхности;</li>\n<li>Защитная профиль-накладка (грызунок) на верхней части боковин, которая защищает зубки ребенка;</li>\n<li>Дно кроватки изготавливается из ортопедических ламелей что обеспечивает достаточную вентиляцию матрасика и постельного белья;</li>\n<li>Возможность трансформации кроватки в детский диванчик;</li>\n<li>Кроватка изготовлена из высококачественных твердых лиственных пород деревьев;</li>\n</ul>\n<iframe src="//www.youtube.com/embed/wICMbVifcBw" width="630" height="519"></iframe>', '', '', ''),
(17259, 'ru', 'Шкаф в детскую комнату из экологически чистых материалов', '', '<p>Ящики снабжены системой выдвижения с телескопическими направляющими, которые делают невозможными их выпадение и травмирование любопытных малышей, которые будут пытаться разобраться в многообразии своих вещей самостоятельно.</p>\n<p><strong>Характеристики:</strong></p>\n<ul>\n<li>шкаф полностью собранный;</li>\n<li>имеет 3 выдвижных ящика для белья и 2 отделения для вещей;</li>\n<li>телескопические направляющие;</li>\n<li>Размеры: 1885 х 900 х 510 мм.</li>\n<li>Гарантия 18 месяцев</li>\n</ul>\n<p>Компания оставляет за собой право изменять внешний вид модели, без изменения функциональности изделия.</p>', '', '', ''),
(17260, 'ru', 'Спортивный джемпер с капюшоном из натуральной ткани', '', '<ul>\n<li>Боковые карманы</li>\n<li>Удобная застежка на молнию; капюшон на подкладке</li>\n<li>Контрастные три полоски на рукавах</li>\n<li>Вышитый логотип adidas</li>\n<li>70% хлопок / 30% полиэстер (футер)</li>\n</ul>\n<p>Легче сказать, чем сделать. Что делать, если Вы оказались в промежутке между двумя размерами? В этом случае безопаснее выбрать больший размер. И знаете, что? Вы всегда можете примерить вещь дома. Размер не подошел? Не переживайте! Простая процедура обмена доступна в течение 14 дней. Ознакомьтесь с условиями возврата, чтобы узнать больше.</p>', '', '', ''),
(17261, 'ru', 'Детские спортивные брюки Adidas из натуральной ткани', '', '<p>Как мы знаем, все дети любят брюки &ndash; и девочки, и мальчики. Брюки практичны, удобны, в конце концов, в них тепло. Без надежной пары брюк невозможно представить себе целый ряд детских забав. В них удобно и тепло гулять в непогоду, в них не страшно упасть при уличных активных играх. С другой стороны, брючные ансамбли вполне уместны и на днях рождения, и на иных торжественных мероприятиях</p>\n<ul>\n<li>Длина по внутреннему шву 27 см</li>\n<li>Эластичный пояс на завязках</li>\n<li>Контрастные три полоски на ногах</li>\n<li>70% хлопок / 30% полиэстер (футер)</li>\n</ul>\n<p><img src="../../../../../uploads/images/tab.jpg" alt="" width="634" height="240" /></p>', '', '', ''),
(17262, 'ru', 'Слинг-шарф для детей до 3-х лет', '', '<p>Слинг-шарф позволяет носить малыша в вертикальном и горизонтальном положениях уже с рождения и до 2-х лет (12 кг). В отличие от тканого, трикотажный слинг-шарф подходит для начинающих слингородителей.</p>\n<p>Его эластичность помогает сгладить погрешности в намотке, минимизируя стресс мамы во время обучения различным положениям. Носить в слинг-шарфе легче, нежели в слинге с кольцами или просто на руках: нагрузка распределяется равномерно на спину, плечи и бедра родителя.</p>\n<p>Поза &laquo;жабки&raquo; с широким разведением ножек не только максимально удобна для ребенка, но и полезна, поскольку является профилактикой дисплазии. Натуральные ткани и трехслойная поддержка малыша гарантируют безопасность и комфорт вашего чада во время нахождения в слинг-шарфе.</p>\n<p><strong>Параметры</strong></p>\n<ul>\n<li>Длина шарфа - 5,0 м</li>\n<li>Ширина - 60 см</li>\n<li>Вес слинга - 650 г</li>\n<li>Материал - 100% хлопок, трикотаж</li>\n</ul>\n<p><iframe src="//www.youtube.com/embed/UN9gc4re2C0" width="625" height="515"></iframe></p>', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_products_rating`
--

DROP TABLE IF EXISTS `shop_products_rating`;
CREATE TABLE IF NOT EXISTS `shop_products_rating` (
  `product_id` int(11) NOT NULL,
  `votes` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_products_rating`
--

INSERT INTO `shop_products_rating` (`product_id`, `votes`, `rating`) VALUES
(71, 1, 2),
(81, 1, 5),
(88, 2, 6),
(76, 3, 11),
(82, 1, 4),
(77, 2, 7),
(73, 1, 2),
(108, 2, 6),
(72, 1, 5),
(74, 2, 8),
(75, 2, 9),
(94, 1, 4),
(87, 1, 5),
(79, 1, 5),
(190, 3, 11),
(1104, 3, 13),
(17233, 1, 5),
(17234, 1, 4),
(17235, 1, 4),
(17236, 2, 9),
(17237, 1, 5),
(17238, 2, 6),
(17239, 1, 4),
(17240, 1, 4),
(17241, 2, 9),
(17242, 1, 5),
(17243, 1, 4),
(17244, 1, 2),
(17245, 2, 6),
(17246, 1, 2),
(17247, 1, 4),
(17248, 1, 5),
(17249, 2, 8),
(17251, 2, 8),
(17250, 1, 4),
(17252, 1, 3),
(17253, 2, 10),
(17254, 2, 9),
(17255, 1, 5),
(17256, 1, 3),
(17257, 2, 9),
(17258, 1, 5),
(17259, 1, 5),
(17260, 1, 5),
(17261, 1, 4),
(17262, 2, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_categories`
--

DROP TABLE IF EXISTS `shop_product_categories`;
CREATE TABLE IF NOT EXISTS `shop_product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `shop_product_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_product_categories`
--

INSERT INTO `shop_product_categories` (`product_id`, `category_id`) VALUES
(17233, 3017),
(17234, 3017),
(17234, 3031),
(17235, 3017),
(17236, 3014),
(17236, 3019),
(17237, 3014),
(17237, 3019),
(17238, 3014),
(17238, 3019),
(17239, 3014),
(17239, 3025),
(17240, 3015),
(17240, 3023),
(17240, 3024),
(17241, 3014),
(17241, 3015),
(17241, 3024),
(17242, 3014),
(17242, 3015),
(17242, 3024),
(17242, 3030),
(17243, 3014),
(17243, 3015),
(17243, 3018),
(17243, 3023),
(17243, 3024),
(17243, 3026),
(17244, 3023),
(17244, 3025),
(17245, 3023),
(17245, 3025),
(17246, 3014),
(17246, 3018),
(17246, 3023),
(17246, 3026),
(17246, 3030),
(17247, 3014),
(17247, 3015),
(17247, 3018),
(17247, 3023),
(17247, 3024),
(17247, 3026),
(17248, 3027),
(17248, 3029),
(17249, 3027),
(17249, 3029),
(17249, 3030),
(17250, 3027),
(17250, 3029),
(17250, 3031),
(17251, 3028),
(17251, 3030),
(17251, 3031),
(17252, 3028),
(17252, 3031),
(17253, 3028),
(17253, 3031),
(17254, 3029),
(17255, 3029),
(17256, 3029),
(17256, 3031),
(17257, 3027),
(17257, 3028),
(17257, 3030),
(17258, 3027),
(17258, 3030),
(17259, 3027),
(17259, 3030),
(17259, 3031),
(17260, 3028),
(17260, 3030),
(17260, 3031),
(17261, 3028),
(17261, 3030),
(17261, 3031),
(17262, 3030),
(17262, 3031);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_images`
--

DROP TABLE IF EXISTS `shop_product_images`;
CREATE TABLE IF NOT EXISTS `shop_product_images` (
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `position` smallint(6) DEFAULT NULL,
  KEY `shop_product_images_I_1` (`position`),
  KEY `shop_product_images_FK_1` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_product_images`
--

INSERT INTO `shop_product_images` (`product_id`, `image_name`, `position`) VALUES
(17243, 'ca34a3dcd3101256d5bbadcf164c9dae.jpg', 3),
(17233, '14e988b1bad66bed2ee0cea7e269ef6c.jpg', 1),
(17233, '205b99fd99c0e1ff6a4c0371d0e4110c.jpg', 0),
(17234, '6c76d37a5e2ecd7dea408ffa00e9ca85.jpg', 2),
(17234, '98a5800558f62f54cbc98048713565ee.jpg', 1),
(17248, '9c6b2bdd1b9ce0634a4932fa3346cb9b.jpg', 0),
(17233, 'c8cbbfa8c74d3a7fecdf1d47c55a176e.jpg', 2),
(17233, '434d9e225ce0f3dd3ae0eb8f763ce95d.jpg', 3),
(17235, '827c15f20fc9fa6e3f9d72ec5c9dd598.jpg', 0),
(17236, 'b3445ccf0d421f0b01327bfbd1fdbb9f.jpg', 0),
(17235, 'b8fafc6d7cc8d29540a1e732df13c96e.jpg', 4),
(17235, '60bb9787980f92a0d2ea01a78a4354a1.jpg', 1),
(17235, '2a8d26b9038b0dc38869485de31f253b.jpg', 2),
(17235, 'fce7c361abfc548ab33256cea1639462.jpg', 3),
(17236, 'b1bb177822a707358b3f413efa04e576.jpg', 1),
(17236, 'b87539594504a55b4d76ef8a9a347892.jpg', 2),
(17236, '0b541ed9b53f30d5472392aa04910cd1.jpg', 3),
(17236, 'd5eaed2e290e49f5d4d3cf880e16a440.jpg', 6),
(17236, 'd10bb68347bbbb484184a955e4aeaeb3.jpg', 4),
(17236, '7fdd258a55a68eff28f1ef902e786eb8.jpg', 5),
(17236, '8bb832c395d9be7a4b44be109ba43634.jpg', 7),
(17237, '3aa86332237d84200ba2dc7330722d40.jpg', 2),
(17237, 'e6058dd019ec3d3494d66a1ed1ec5602.jpg', 1),
(17237, '6340d0f8ad647b87449ad1f53db3d257.jpg', 0),
(17244, '8fc5d648e490d2f3edc16ebc2a8ca8f0.jpg', 2),
(17237, '809d1d7c38a1270bbc33cc4db9da48a4.jpg', 3),
(17238, '8cf39c10e1d1a575deb7e04b0b873b09.jpg', 0),
(17238, '950e432e5b9fc21c934c9e116424a8a9.jpg', 1),
(17238, 'a387c517875e5baf0dfd41e204fab1eb.jpg', 2),
(17238, 'b569b3fe1288e2cc7b1abf002dab6736.jpg', 3),
(17238, 'd2fe6b13b569f6b38c2d568d9b8ec982.jpg', 4),
(17238, '0700fe5643afc7c81a1f1c22503de1a8.jpg', 5),
(17239, 'b77fc5aef9e9ff3f013caef1467c6bc5.jpg', 0),
(17239, '712de452e4afbb0bbd706c6ea13f15f0.jpg', 1),
(17240, 'ed02236bb764da34cd05810d37a35287.jpg', 0),
(17240, 'dc5b5ef9970c9c0967eed42f1cc2fc6f.jpg', 1),
(17240, 'c972fc5d308c4a56d5ea1b27602e1935.jpg', 2),
(17240, '01f3c1ec765a3f0e84662532b22ac62c.jpg', 3),
(17248, 'c8724a3401f08fda1f83ac62059dd199.jpg', 1),
(17241, '5952400eaa237b5844270ca9f39c55c8.png', 1),
(17241, '9edf0863463eca8088a3de2c6d48c328.png', 2),
(17242, '967201336205db17ce3eb198bda0b57e.png', 0),
(17242, '7af717bd2cbd2e27b4a0c170173dd8ea.png', 1),
(17242, '2e46c648ffdcf93f910b4caec73f0f45.jpg', 2),
(17242, '845b82e489c81f2d1e05772d4f11998f.jpg', 3),
(17242, '479dc561da6a3a42302b614080257a95.jpg', 4),
(17242, '099fc178720651b3606f3059cb0c54dd.png', 5),
(17243, '5a6686d3bd55240920437d3980272135.jpg', 0),
(17243, '4e5a3c4cb4324e6259d07618d3342013.jpg', 1),
(17244, 'f074d3b84c31c83b1f9c4cf9eeffe521.jpg', 0),
(17244, '93b36b928b99fe1d0a28ab6e42ca247a.jpg', 1),
(17252, '4f43f56fa2938f06186ab7da4962f62d.jpg', 1),
(17252, '9d62b0c2340c795a54a93d1fbaaa4253.jpg', 0),
(17251, '2ca3209522d9ce171ce8ad37d7f603b2.jpg', 1),
(17251, '96c2115cf86fddab2f906af0bbf48cb3.jpg', 0),
(17250, '5455aeef19ecf43a4a3fef77480c31f4.jpg', 2),
(17245, 'b0fcba55948044947831d30da9e4b5a7.jpg', 2),
(17246, '81393b4aa22084c5be46ebea37851e92.jpg', 0),
(17246, '95d2760d03c2873d0bf4c35d885ed0dc.jpg', 1),
(17246, '9ff1d15872d05ec1600263d9d92e92aa.jpg', 2),
(17247, '99e633afa5372833de8adbe71fbdc056.jpg', 0),
(17248, '3f504e24798108423199db3852e0d1a0.jpg', 3),
(17248, 'c65e78d3898803448aeda8b586a9b8c7.jpg', 2),
(17249, '2dc60b4979b72dd7737859f5fa5f6e4c.jpg', 0),
(17249, 'f10efaba29ccf7e7cf8372b640165816.jpg', 1),
(17250, '0e711515bd306650fdd1fead2278203d.jpg', 0),
(17250, 'f50fa5947d9531970f2b992e249bb5f6.jpg', 1),
(17245, '5c6cdf1fd67a4eb21e7060c66650158d.jpg', 1),
(17245, '0d0a14a7af1e6823d9923cfedcb5315e.jpg', 0),
(17244, 'badec8f059cb1edb780c9d59c1d5e65d.jpg', 3),
(17243, '5231754e32d382ddd1bc52d68ed76b34.jpg', 2),
(17247, 'e06f4fcec5f11523bfa9a4f816ece1e2.jpg', 4),
(17247, '9679a8ef53ee8c0a99571cb80b3a09b3.jpg', 1),
(17247, 'a3b0b6057d0a7d60dabff8c600bf75ed.jpg', 2),
(17247, 'b52779554bf8fafbbbc9967660f2f3a4.jpg', 3),
(17252, '614405111c129429b36db4caa81e7703.jpg', 2),
(17253, '55e221583956892fc77f1e329e24119a.jpg', 0),
(17253, '643e218be300ed4df3638bd233d6015b.jpg', 1),
(17253, '5dcbcfadde76b0af2ae3540ee1650626.jpg', 2),
(17253, '034935745c6ab35d3e9bb2574f9a3e01.jpg', 3),
(17253, 'cdfbbc3a18277ea3de2508ff4733c8c1.jpg', 4),
(17253, '80857f36168615d1cf58974fb5922040.jpg', 5),
(17254, '6f802e57a37010cbbc9f027cc070a80c.jpg', 0),
(17254, '35af1d514422dfc968c1df2ed05e6506.jpg', 1),
(17256, 'b2491ded9d9070458660583d0d29ee22.jpg', 0),
(17256, '2d6d911be654c0d392543eaa90307bd9.jpg', 1),
(17257, 'e8f25f63a9fc06a8a2ebecbedb1f8d97.jpg', 0),
(17257, '2622f03d80a532966f5e9b15899e7b4b.jpg', 1),
(17257, '36e875c205312b9e3b17e8bafd553e87.jpg', 2),
(17257, 'f579be10b3558b32a344fb13a4fe52c9.jpg', 3),
(17257, '9a923d0cab109c2c11ccca671fa24756.jpg', 4),
(17257, '6450c3a9afca0f1775ccef9d46b5974f.jpg', 5),
(17257, '4c49d041ce3ea884d2a1445362b92bbc.jpg', 6),
(17257, 'be09c9960a289fccef57ac02cb6670e0.jpg', 7),
(17257, '66deb4296702febdca1c590e76f3dda8.jpg', 8),
(17258, 'b9ec33b563d0a6814195603d90863021.jpg', 0),
(17258, '3b8b7c4ef935ea660e1c2aeb755e61bb.jpg', 1),
(17259, 'db06d0658768e0e4fd92c093fcddf4a7.jpeg', 0),
(17259, '5fb9f9f4064ec94377daf92fe3a0e139.jpeg', 1),
(17259, '484071f6a1462b759e85e43acd7507e4.jpeg', 2),
(17260, 'e057ae5f15db6877cc3152585689767c.jpg', 0),
(17260, 'ca931f5b3756b5086219aaa619175d70.jpg', 1),
(17260, 'e3e892656a18eeac5bc2b74795570f5a.jpg', 2),
(17260, '6f5a1af448eac971acef8ce2393a15be.jpg', 3),
(17260, '8f91e05ad9a14511dfb9596c4d30eea7.jpg', 4),
(17261, '1fc35f92ff44a16c2538a4abeb71534c.jpg', 0),
(17261, '8873867b57916b5f36f8c14452f0d791.jpg', 1),
(17261, '019469eac4ce12f428bfff22ac0a35b6.jpg', 2),
(17262, '00898ae4ee9a3038407d065255ac4d51.jpg', 0),
(17262, '76cfbf38a407ada16667a349eb775db0.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties`
--

DROP TABLE IF EXISTS `shop_product_properties`;
CREATE TABLE IF NOT EXISTS `shop_product_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `csv_name` varchar(50) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `show_in_compare` tinyint(1) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `show_on_site` tinyint(1) DEFAULT NULL,
  `multiple` tinyint(1) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `show_in_filter` tinyint(1) DEFAULT NULL,
  `main_property` tinyint(1) DEFAULT NULL,
  `show_faq` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_properties_I_2` (`active`),
  KEY `shop_product_properties_I_3` (`show_on_site`),
  KEY `shop_product_properties_I_4` (`show_in_compare`),
  KEY `shop_product_properties_I_5` (`position`),
  KEY `shop_product_properties_I_1` (`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=388 ;

--
-- Дамп данных таблицы `shop_product_properties`
--

INSERT INTO `shop_product_properties` (`id`, `csv_name`, `active`, `show_in_compare`, `position`, `show_on_site`, `multiple`, `external_id`, `show_in_filter`, `main_property`, `show_faq`) VALUES
(387, 'pazmer', 1, 0, 0, 1, 1, NULL, 1, 0, 0),
(386, 'vozrastnaja-gruppa', 1, 0, 0, 0, 0, NULL, 1, 0, 0),
(385, 'obem-baka-l', 1, 0, 0, 1, 1, NULL, 1, 0, 0),
(384, 'tsvetmeb', 1, 0, 0, 1, 1, NULL, 1, 1, 0),
(383, 'material', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(382, 'garantija', 1, 1, 0, 1, 0, NULL, 1, 1, 0),
(381, 'obem-zhestkogo-diska', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(379, 'osnascheniekommunikatsii', 1, 1, 0, 1, 1, NULL, 1, 0, 0),
(378, 'obem-vstroennoj-pamjati-gb', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(377, 'operatsionnaja-sistema', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(376, 'razreshenie-ekrana', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(375, 'diagonal-ekrana', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(374, 'obem-gb', 1, 1, 0, 1, 1, NULL, 1, 0, 1),
(373, 'interfejs', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(372, 'material-korpusa', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(371, 'tipustrojstva', 1, 1, 0, 1, 0, NULL, 1, 1, 0),
(380, 'obem-operativnoj-pamjati-gb', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(369, 'tsvet', 1, 0, 0, 1, 1, NULL, 1, 1, 0),
(368, 'podderzhka-obemnogo-zvuka-', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(367, 'maksimalnaja-vosproizvodimaja-chastota-kgts', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(366, 'minimalnaja-vosproizvodimaja-chastota-gts-', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(365, 'soedinitelnyj-razem', 1, 1, 0, 1, 1, NULL, 1, NULL, NULL),
(364, 'tip-besprovodnogo-podkljuchenija', 1, 0, 0, 0, 1, NULL, 1, 1, 0),
(363, 'sposob-podkljuchenija', 1, 1, 0, 1, 1, NULL, 1, 1, 0),
(362, 'tip-ustrojstva', 1, NULL, 0, 1, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties_categories`
--

DROP TABLE IF EXISTS `shop_product_properties_categories`;
CREATE TABLE IF NOT EXISTS `shop_product_properties_categories` (
  `property_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`category_id`),
  KEY `shop_product_properties_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_product_properties_categories`
--

INSERT INTO `shop_product_properties_categories` (`property_id`, `category_id`) VALUES
(362, 3017),
(362, 3023),
(363, 3017),
(364, 3017),
(365, 3017),
(366, 3017),
(367, 3017),
(368, 3017),
(369, 3014),
(369, 3015),
(369, 3017),
(369, 3018),
(369, 3019),
(369, 3023),
(369, 3024),
(369, 3025),
(369, 3029),
(371, 3019),
(372, 3017),
(372, 3018),
(372, 3019),
(372, 3023),
(372, 3024),
(372, 3025),
(373, 3015),
(373, 3019),
(373, 3024),
(375, 3014),
(375, 3015),
(375, 3018),
(375, 3023),
(375, 3024),
(375, 3025),
(375, 3026),
(376, 3018),
(376, 3023),
(376, 3024),
(376, 3025),
(377, 3015),
(377, 3018),
(377, 3023),
(377, 3024),
(377, 3025),
(378, 3015),
(378, 3018),
(378, 3023),
(378, 3024),
(378, 3025),
(379, 3014),
(379, 3018),
(379, 3023),
(379, 3025),
(380, 3014),
(380, 3018),
(380, 3023),
(380, 3024),
(380, 3025),
(380, 3026),
(381, 3015),
(381, 3018),
(381, 3023),
(381, 3024),
(381, 3025),
(381, 3026),
(382, 3027),
(382, 3028),
(382, 3029),
(382, 3030),
(383, 3027),
(383, 3028),
(383, 3030),
(383, 3031),
(384, 3027),
(384, 3028),
(384, 3030),
(384, 3031),
(385, 3029),
(386, 3030),
(387, 3031);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties_data`
--

DROP TABLE IF EXISTS `shop_product_properties_data`;
CREATE TABLE IF NOT EXISTS `shop_product_properties_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `value` varchar(500) NOT NULL,
  `locale` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_properties_data_I_1` (`value`(333)),
  KEY `shop_product_properties_data_FI_2` (`product_id`),
  KEY `shop_product_properties_data_FI_1` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88698 ;

--
-- Дамп данных таблицы `shop_product_properties_data`
--

INSERT INTO `shop_product_properties_data` (`id`, `property_id`, `product_id`, `value`, `locale`) VALUES
(88615, 372, 17233, 'Пластик', 'ru'),
(88614, 372, 17233, 'Металл', 'ru'),
(88610, 366, 17233, '11-15', 'ru'),
(88611, 367, 17233, '21-25', 'ru'),
(88612, 368, 17233, '7.1', 'ru'),
(88613, 369, 17233, 'Черный', 'ru'),
(88609, 365, 17233, 'USB', 'ru'),
(88608, 365, 17233, 'Jack 3,5 мм', 'ru'),
(88607, 363, 17233, 'Проводной', 'ru'),
(88606, 362, 17233, 'Наушники без микрофона', 'ru'),
(88655, 366, 17234, '11-15', 'ru'),
(88656, 367, 17234, '26-30', 'ru'),
(88657, 368, 17234, '5.1', 'ru'),
(88658, 369, 17234, 'Черный', 'ru'),
(88654, 365, 17234, 'USB', 'ru'),
(88653, 364, 17234, 'Радиоканал', 'ru'),
(88652, 363, 17234, 'Проводной', 'ru'),
(88651, 363, 17234, 'Беспроводной', 'ru'),
(88650, 362, 17234, 'Наушники с микрофоном', 'ru'),
(88660, 372, 17234, 'Пластик', 'ru'),
(88659, 372, 17234, 'Другое', 'ru'),
(88093, 366, 17235, 'до 5', 'ru'),
(88094, 367, 17235, '31 и более', 'ru'),
(88095, 368, 17235, '7.1', 'ru'),
(88097, 369, 17235, 'Черный', 'ru'),
(88101, 365, 17235, 'mini-USB', 'ru'),
(88102, 364, 17235, '', 'ru'),
(88104, 363, 17235, 'Проводной', 'ru'),
(88106, 372, 17235, 'Пластик', 'ru'),
(88096, 369, 17235, 'Красный', 'ru'),
(88100, 365, 17235, 'micro-USB', 'ru'),
(88099, 365, 17235, 'USB', 'ru'),
(88098, 365, 17235, 'Jack 3,5 мм', 'ru'),
(88103, 363, 17235, 'Беспроводной', 'ru'),
(88105, 362, 17235, 'Аудио колонки', 'ru'),
(88127, 369, 17236, 'Черный', 'ru'),
(88126, 369, 17236, 'Синий/Голубой', 'ru'),
(88125, 369, 17236, 'Оранжевый', 'ru'),
(88124, 369, 17236, 'Желтый', 'ru'),
(88129, 373, 17236, 'USB 3.0', 'ru'),
(88128, 373, 17236, 'USB 2.0', 'ru'),
(88131, 372, 17236, 'Пластик', 'ru'),
(88130, 372, 17236, 'Металл', 'ru'),
(88132, 371, 17236, 'USB flash-драйв', 'ru'),
(88141, 369, 17237, 'Черный', 'ru'),
(88142, 373, 17237, 'eSATA', 'ru'),
(88143, 372, 17237, 'Металл', 'ru'),
(88144, 371, 17237, 'Жесткий диск', 'ru'),
(88133, 369, 17238, 'Черный', 'ru'),
(88135, 372, 17238, 'Пластик', 'ru'),
(88136, 371, 17238, 'Карта памяти', 'ru'),
(88134, 373, 17238, 'UHS 1', 'ru'),
(88258, 369, 17239, 'Черный', 'ru'),
(88261, 377, 17239, 'Без ОС', 'ru'),
(88260, 377, 17239, 'Windows 8', 'ru'),
(88259, 377, 17239, 'Windows 7', 'ru'),
(88262, 376, 17239, '1920x1200', 'ru'),
(88264, 378, 17239, '8', 'ru'),
(88265, 372, 17239, 'Пластик', 'ru'),
(88263, 375, 17239, '23&quot;', 'ru'),
(88266, 380, 17239, '4', 'ru'),
(88286, 369, 17240, 'Черный', 'ru'),
(88288, 377, 17240, 'Android 4.X', 'ru'),
(88270, 379, 17239, 'Wi-Fi', 'ru'),
(88269, 379, 17239, 'USB', 'ru'),
(88268, 379, 17239, 'HDMI', 'ru'),
(88267, 379, 17239, 'DLNA', 'ru'),
(88257, 381, 17239, '500', 'ru'),
(88289, 375, 17240, '10&quot; - 10,8&quot;', 'ru'),
(88292, 373, 17240, 'micro-USB', 'ru'),
(88291, 373, 17240, 'Wi-Fi', 'ru'),
(88290, 373, 17240, 'USB 2.0', 'ru'),
(88293, 381, 17240, '32', 'ru'),
(88287, 378, 17240, '', 'ru'),
(88346, 378, 17241, '32', 'ru'),
(88347, 377, 17241, 'Apple iOS', 'ru'),
(88348, 375, 17241, '11,6&quot; и больше', 'ru'),
(88354, 381, 17241, '350', 'ru'),
(88345, 369, 17241, 'Серебряный/Серый', 'ru'),
(88353, 373, 17241, 'Проприетарный разъем Apple iPad, iPod', 'ru'),
(88352, 373, 17241, 'USB 3.0', 'ru'),
(88351, 373, 17241, 'USB 2.0', 'ru'),
(88350, 373, 17241, 'UHS 1', 'ru'),
(88349, 373, 17241, '', 'ru'),
(88669, 369, 17242, 'Черный', 'ru'),
(88676, 377, 17242, 'Android 5.x', 'ru'),
(88675, 375, 17242, '11,6&quot; и больше', 'ru'),
(88677, 381, 17242, '32', 'ru'),
(88668, 369, 17242, 'Белый', 'ru'),
(88674, 373, 17242, 'micro-USB', 'ru'),
(88673, 373, 17242, 'USB 3.0', 'ru'),
(88672, 373, 17242, 'USB 2.0', 'ru'),
(88671, 373, 17242, 'UHS 1', 'ru'),
(88670, 373, 17242, 'FireWire', 'ru'),
(88271, 381, 17244, '350', 'ru'),
(88272, 369, 17244, 'Черный', 'ru'),
(88274, 377, 17244, 'Без ОС', 'ru'),
(88273, 377, 17244, 'Windows 8', 'ru'),
(88275, 376, 17244, '1920x1200', 'ru'),
(88276, 375, 17244, '23&quot; и больше', 'ru'),
(88278, 372, 17244, '', 'ru'),
(88279, 380, 17244, '2', 'ru'),
(88285, 379, 17244, 'USB-Host/OTG', 'ru'),
(88284, 379, 17244, 'USB', 'ru'),
(88283, 379, 17244, 'NFC', 'ru'),
(88282, 379, 17244, 'HDMI', 'ru'),
(88281, 379, 17244, 'GPS', 'ru'),
(88280, 379, 17244, 'DLNA', 'ru'),
(88277, 378, 17244, '', 'ru'),
(88244, 381, 17245, '64', 'ru'),
(88245, 369, 17245, 'Белый', 'ru'),
(88246, 377, 17245, 'Windows 8', 'ru'),
(88248, 376, 17245, '2560x1600', 'ru'),
(88247, 376, 17245, '', 'ru'),
(88249, 375, 17245, '23&quot; и больше', 'ru'),
(88251, 372, 17245, 'Пластик', 'ru'),
(88252, 380, 17245, '2', 'ru'),
(88256, 379, 17245, 'USB-Host/OTG', 'ru'),
(88255, 379, 17245, 'USB', 'ru'),
(88254, 379, 17245, 'HDMI', 'ru'),
(88253, 379, 17245, 'DLNA', 'ru'),
(88250, 378, 17245, '', 'ru'),
(88696, 380, 17246, '2', 'ru'),
(88686, 369, 17246, 'Красный', 'ru'),
(88685, 369, 17246, 'Белый', 'ru'),
(88691, 377, 17246, 'Windows 8', 'ru'),
(88690, 376, 17246, '1280x800', 'ru'),
(88689, 375, 17246, '10&quot; - 10,8&quot;', 'ru'),
(88688, 372, 17246, 'Пластик', 'ru'),
(88687, 372, 17246, 'Металл', 'ru'),
(88695, 379, 17246, 'Wi-Fi', 'ru'),
(88694, 379, 17246, 'USB-Host/OTG', 'ru'),
(88693, 379, 17246, 'USB', 'ru'),
(88692, 379, 17246, 'NFC', 'ru'),
(88697, 381, 17246, '350', 'ru'),
(88562, 381, 17243, '500', 'ru'),
(88560, 375, 17243, '15&quot;', 'ru'),
(88561, 380, 17243, '4', 'ru'),
(88383, 380, 17247, '4', 'ru'),
(88385, 378, 17247, '16', 'ru'),
(88388, 376, 17247, '1280x800', 'ru'),
(88389, 375, 17247, '15&quot;', 'ru'),
(88396, 381, 17247, '500', 'ru'),
(88384, 369, 17247, 'Серебряный/Серый', 'ru'),
(88386, 377, 17247, 'Windows 8', 'ru'),
(88387, 377, 17247, 'Без ОС', 'ru'),
(88390, 372, 17247, '', 'ru'),
(88391, 372, 17247, 'Пластик', 'ru'),
(88395, 379, 17247, 'Wi-Fi', 'ru'),
(88394, 379, 17247, 'USB-Host/OTG', 'ru'),
(88393, 379, 17247, 'USB', 'ru'),
(88392, 379, 17247, 'HDMI', 'ru'),
(88464, 384, 17248, 'Черный', 'ru'),
(88463, 384, 17248, 'Серый', 'ru'),
(88462, 384, 17248, 'Белый', 'ru'),
(88465, 382, 17248, '2 года', 'ru'),
(88661, 382, 17249, '12 месяцев', 'ru'),
(88663, 383, 17249, 'Ткань Антара', 'ru'),
(88662, 383, 17249, 'Дерево', 'ru'),
(88667, 384, 17249, 'Красный', 'ru'),
(88666, 384, 17249, 'Кобальт', 'ru'),
(88665, 384, 17249, 'Желтый', 'ru'),
(88664, 384, 17249, 'Бордо', 'ru'),
(87982, 383, 17257, 'Пластик', 'ru'),
(87981, 383, 17257, 'Металл', 'ru'),
(87980, 383, 17257, 'МДФ', 'ru'),
(88461, 383, 17248, 'Экокожа', 'ru'),
(88460, 383, 17248, 'Ткань Антара', 'ru'),
(88459, 383, 17248, 'Металл', 'ru'),
(88458, 383, 17248, 'Кожа', 'ru'),
(88617, 383, 17250, 'ДСП', 'ru'),
(88619, 384, 17250, 'Серый', 'ru'),
(88618, 384, 17250, 'Коричневый', 'ru'),
(88616, 382, 17250, '12 месяцев', 'ru'),
(88681, 383, 17251, 'Текстиль', 'ru'),
(88680, 383, 17251, 'Резина', 'ru'),
(88679, 383, 17251, 'Кожа', 'ru'),
(88684, 384, 17251, 'Черный', 'ru'),
(88683, 384, 17251, 'Оранжевый', 'ru'),
(88682, 384, 17251, 'Белый', 'ru'),
(88678, 382, 17251, '12 месяцев', 'ru'),
(88479, 383, 17252, 'Текстиль', 'ru'),
(88478, 383, 17252, 'Неопрен', 'ru'),
(88477, 384, 17252, 'Черный', 'ru'),
(88480, 382, 17252, '5 лет и больше', 'ru'),
(88495, 383, 17253, 'Текстиль', 'ru'),
(88494, 383, 17253, 'Неопрен', 'ru'),
(88493, 384, 17253, 'Черный', 'ru'),
(88492, 384, 17253, 'Синий', 'ru'),
(88491, 384, 17253, 'Красный', 'ru'),
(88490, 384, 17253, 'Зеленый', 'ru'),
(88489, 384, 17253, 'Желтый', 'ru'),
(88496, 382, 17253, '6 месяцев', 'ru'),
(88577, 382, 17254, '2 года', 'ru'),
(88576, 369, 17254, 'Оранжевый', 'ru'),
(88578, 385, 17254, '2-5', 'ru'),
(88574, 382, 17255, '5 лет и больше', 'ru'),
(88573, 369, 17255, 'Желтый', 'ru'),
(88575, 385, 17255, '6-12', 'ru'),
(88647, 369, 17256, 'Красный', 'ru'),
(88649, 385, 17256, 'более 20', 'ru'),
(88648, 382, 17256, '12 месяцев', 'ru'),
(87979, 383, 17257, 'Дерево', 'ru'),
(87985, 384, 17257, 'Черный', 'ru'),
(87984, 384, 17257, 'Красный', 'ru'),
(87983, 384, 17257, 'Каштановый', 'ru'),
(87977, 386, 17257, 'от 15 лет и старше', 'ru'),
(87978, 382, 17257, '6 месяцев', 'ru'),
(88537, 383, 17258, 'Дерево', 'ru'),
(88541, 384, 17258, 'Коричневый', 'ru'),
(88540, 384, 17258, 'Каштановый', 'ru'),
(88539, 384, 17258, 'Белый', 'ru'),
(88538, 384, 17258, 'Бежевый', 'ru'),
(88536, 382, 17258, '2 года', 'ru'),
(88535, 386, 17258, 'до 2 лет', 'ru'),
(88630, 383, 17259, 'Дерево', 'ru'),
(88629, 383, 17259, 'ДСП', 'ru'),
(88633, 384, 17259, 'Каштановый', 'ru'),
(88635, 386, 17259, 'от 7 до 15 лет', 'ru'),
(88628, 382, 17259, '5 лет и больше', 'ru'),
(88632, 384, 17259, 'Белый', 'ru'),
(88631, 384, 17259, 'Бежевый', 'ru'),
(88587, 383, 17260, 'Хлопок', 'ru'),
(88586, 383, 17260, 'Трикотаж', 'ru'),
(88585, 383, 17260, 'Текстиль', 'ru'),
(88588, 384, 17260, 'Серый', 'ru'),
(88517, 384, 17261, 'Серый', 'ru'),
(88604, 384, 17262, 'Розовый', 'ru'),
(88605, 386, 17262, 'до 2 лет', 'ru'),
(88600, 382, 17262, '12 месяцев', 'ru'),
(88601, 383, 17262, 'Хлопок', 'ru'),
(88603, 384, 17262, 'Оранжевый', 'ru'),
(88602, 384, 17262, 'Зеленый', 'ru'),
(88593, 387, 17260, 'S', 'ru'),
(88592, 387, 17260, 'M', 'ru'),
(88591, 387, 17260, 'L', 'ru'),
(88590, 387, 17260, '3X', 'ru'),
(88589, 387, 17260, '2X', 'ru'),
(88509, 387, 17261, '2X', 'ru'),
(88510, 387, 17261, '3X', 'ru'),
(88511, 387, 17261, 'L', 'ru'),
(88512, 387, 17261, 'M', 'ru'),
(88513, 383, 17261, '', 'ru'),
(88514, 383, 17261, 'Полиэстер', 'ru'),
(88515, 383, 17261, 'Текстиль', 'ru'),
(88516, 383, 17261, 'Хлопок', 'ru'),
(88634, 384, 17259, 'Песочный', 'ru');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties_data_i18n`
--

DROP TABLE IF EXISTS `shop_product_properties_data_i18n`;
CREATE TABLE IF NOT EXISTS `shop_product_properties_data_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_properties_data_i18n_I_1` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties_i18n`
--

DROP TABLE IF EXISTS `shop_product_properties_i18n`;
CREATE TABLE IF NOT EXISTS `shop_product_properties_i18n` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `data` text,
  `description` text,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_product_properties_i18n_I_2` (`name`),
  KEY `shop_product_properties_i18n_I_1` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_product_properties_i18n`
--

INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`, `data`, `description`) VALUES
(384, 'Цвет', 'ru', 'a:21:{i:0;s:14:"Бежевый";i:1;s:10:"Белый";i:2;s:12:"Черный";i:3;s:20:"Коричневый";i:4;s:14:"Красный";i:5;s:10:"Серый";i:6;s:18:"Бирюзовый";i:7;s:8:"Дюна";i:8;s:20:"Каштановый";i:9;s:14:"Кобальт";i:10;s:18:"Оливковый";i:11;s:14:"Розовый";i:12;s:20:"Серебряный";i:13;s:10:"Бордо";i:14;s:14:"Голубой";i:15;s:12:"Желтый";i:16;s:14:"Зеленый";i:17;s:14:"Золотой";i:18;s:18:"Оранжевый";i:19;s:16:"Песочный";i:20;s:10:"Синий";}', ''),
(385, 'Объем бака, л', 'ru', 'a:5:{i:0;s:6:"до 2";i:1;s:3:"2-5";i:2;s:4:"6-12";i:3;s:5:"13-20";i:4;s:13:"более 20";}', ''),
(386, 'Возрастная группа', 'ru', 'a:4:{i:0;s:13:"до 2 лет";i:1;s:20:"от 2 до 7 лет";i:2;s:21:"от 7 до 15 лет";i:3;s:30:"от 15 лет и старше";}', ''),
(387, 'Pазмер', 'ru', 'a:8:{i:0;s:2:"XS";i:1;s:1:"S";i:2;s:1:"M";i:3;s:1:"L";i:4;s:2:"XL";i:5;s:2:"2X";i:6;s:2:"3X";i:8;s:3:"XXL";}', ''),
(375, 'Диагональ экрана', 'ru', 'a:22:{i:0;s:8:"15&quot;";i:1;s:8:"17&quot;";i:2;s:8:"21&quot;";i:3;s:8:"23&quot;";i:4;s:24:"23&quot; и больше";i:5;s:25:"2,3&quot; и меньше";i:6;s:13:"2,4-3,9&quot;";i:7;s:7:"4&quot;";i:8;s:9:"4,3&quot;";i:9;s:9:"4,5&quot;";i:10;s:13:"4,6-4,8&quot;";i:11;s:7:"5&quot;";i:12;s:13:"5,1-5,3&quot;";i:13;s:9:"5,5&quot;";i:14;s:13:"5,6-5,9&quot;";i:15;s:9:"6,0&quot;";i:16;s:7:"7&quot;";i:17;s:21:"7,7&quot; - 8,4&quot;";i:18;s:21:"8,9&quot; - 9,4&quot;";i:19;s:9:"9,7&quot;";i:20;s:21:"10&quot; - 10,8&quot;";i:21;s:26:"11,6&quot; и больше";}', ''),
(376, 'Разрешение экрана', 'ru', 'a:13:{i:0;s:7:"800x480";i:1;s:7:"800x600";i:2;s:7:"960x540";i:3;s:8:"1024x600";i:4;s:8:"1024x768";i:5;s:8:"1280x800";i:6;s:8:"1366x768";i:7;s:8:"1440x900";i:8;s:9:"1920x1080";i:9;s:9:"1920x1200";i:10;s:9:"2048x1536";i:11;s:9:"2160x1440";i:12;s:9:"2560x1600";}', ''),
(377, 'Операционная система', 'ru', 'a:9:{i:0;s:11:"Android 5.x";i:1;s:11:"Android 4.X";i:2;s:9:"Windows 7";i:3;s:9:"Windows 8";i:4;s:10:"Windows RT";i:5;s:9:"Apple iOS";i:6;s:10:"Symbian OS";i:7;s:13:"Windows Phone";i:8;s:11:"Без ОС";}', ''),
(378, 'Объем встроенной памяти, ГБ', 'ru', 'a:6:{i:0;s:14:"Меньше 8";i:1;s:1:"8";i:2;s:2:"16";i:3;s:2:"32";i:4;s:2:"64";i:5;s:19:"128 и больше";}', ''),
(379, 'Оснащение/Коммуникации', 'ru', 'a:13:{i:0;s:3:"USB";i:1;s:4:"HDMI";i:2;s:12:"MHL/SlimPort";i:3;s:9:"Bluetooth";i:4;s:5:"Wi-Fi";i:5;s:4:"DLNA";i:6;s:3:"NFC";i:7;s:12:"USB-Host/OTG";i:8;s:18:"Картридер";i:9;s:3:"GPS";i:10;s:8:"Ethernet";i:11;s:42:"Док-станция/клавиатура";i:12;s:35:"Комплектный стилус";}', ''),
(381, 'Oбъем жесткого диска Гб', 'ru', 'a:7:{i:0;s:2:"12";i:1;s:2:"32";i:2;s:2:"64";i:3;s:3:"128";i:4;s:3:"500";i:5;s:3:"350";i:6;s:3:"750";}', ''),
(382, 'Гарантия', 'ru', 'a:5:{i:0;s:16:"6 месяцев";i:1;s:16:"9 месяцев";i:2;s:17:"12 месяцев";i:3;s:10:"2 года";i:4;s:24:"5 лет и больше";}', ''),
(383, 'Материал', 'ru', 'a:18:{i:0;s:8:"Кожа";i:1;s:43:"Экокожа перфорированая";i:2;s:14:"Экокожа";i:3;s:23:"Ткань Антара";i:4;s:12:"Дерево";i:5;s:6:"ДСП";i:6;s:12:"Металл";i:7;s:14:"Пластик";i:8;s:14:"Неопрен";i:9;s:12:"Резина";i:10;s:16:"Текстиль";i:11;s:16:"Трикотаж";i:12;s:6:"МДФ";i:13;s:18:"Полиэстер";i:14;s:12:"Шерсть";i:15;s:12:"Хлопок";i:16;s:10:"Джинс";i:17;s:8:"Флис";}', ''),
(374, 'Объем, ГБ', 'ru', 'a:16:{i:0;s:15:"2 и менее";i:1;s:1:"4";i:2;s:1:"8";i:3;s:2:"16";i:4;s:2:"32";i:5;s:2:"64";i:6;s:3:"128";i:7;s:3:"450";i:8;s:3:"500";i:9;s:7:"600-800";i:10;s:4:"1000";i:11;s:9:"1250-1500";i:12;s:4:"2000";i:13;s:9:"2500-3000";i:14;s:4:"4000";i:15;s:4:"5000";}', ''),
(380, 'Объем оперативной памяти Гб', 'ru', 'a:5:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"8";i:3;s:2:"16";i:4;s:2:"32";}', ''),
(371, 'Тип устройства:', 'ru', 'a:3:{i:0;s:23:"Карта памяти";i:1;s:23:"Жесткий диск";i:2;s:20:"USB flash-драйв";}', ''),
(372, 'Материал корпуса', 'ru', 'a:3:{i:0;s:12:"Металл";i:1;s:14:"Пластик";i:2;s:12:"Другое";}', ''),
(373, 'Интерфейс', 'ru', 'a:10:{i:0;s:7:"USB 2.0";i:1;s:5:"UHS 1";i:2;s:7:"USB 3.0";i:3;s:11:"Thunderbolt";i:4;s:5:"Wi-Fi";i:5;s:5:"eSATA";i:6;s:8:"FireWire";i:7;s:9:"micro-USB";i:8;s:9:"Lightning";i:9;s:56:"Проприетарный разъем Apple iPad, iPod";}', ''),
(368, 'Поддержка объемного звука  ', 'ru', 'a:2:{i:0;s:3:"5.1";i:1;s:3:"7.1";}', ''),
(369, 'Цвет', 'ru', 'a:12:{i:0;s:10:"Белый";i:1;s:12:"Черный";i:2;s:25:"Синий/Голубой";i:3;s:33:"Зеленый/Салатовый";i:4;s:39:"Фиолетовый/Пурпурный";i:5;s:14:"Красный";i:6;s:31:"Серебряный/Серый";i:7;s:12:"Желтый";i:8;s:14:"Розовый";i:9;s:18:"Оранжевый";i:10;s:20:"Коричневый";i:11;s:12:"Другой";}', ''),
(366, 'Минимальная частота, Гц  ', 'ru', 'a:7:{i:0;s:6:"до 5";i:1;s:4:"6-10";i:2;s:5:"11-15";i:3;s:5:"16-20";i:4;s:5:"21-30";i:5;s:5:"31-50";i:6;s:16:"51 и более";}', ''),
(367, 'Максимальная частота, кГц', 'ru', 'a:6:{i:0;s:7:"до 10";i:1;s:5:"11-15";i:2;s:5:"16-20";i:3;s:5:"21-25";i:4;s:5:"26-30";i:5;s:16:"31 и более";}', ''),
(365, 'Соединительный разъем', 'ru', 'a:6:{i:0;s:13:"Jack 3,5 мм";i:1;s:13:"Jack 6,3 мм";i:2;s:3:"USB";i:3;s:8:"mini-USB";i:4;s:9:"micro-USB";i:5;s:26:"Проприетарный";}', ''),
(363, 'Способ подключения', 'ru', 'a:2:{i:0;s:18:"Проводной";i:1;s:24:"Беспроводной";}', ''),
(364, 'Тип беспроводного подключения', 'ru', 'a:2:{i:0;s:20:"Радиоканал";i:1;s:4:"ИК";}', ''),
(362, 'Тип устройства', 'ru', 'a:9:{i:0;s:42:"Наушники без микрофона";i:1;s:40:"Наушники с микрофоном";i:2;s:39:"Телефонная гарнитура";i:3;s:43:"Компьютерная гарнитура";i:4;s:25:"Аудио колонки";i:5;s:4:"ПК";i:6;s:16:"Моноблок";i:7;s:14:"Планшет";i:8;s:14:"Ноутбук";}', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_variants`
--

DROP TABLE IF EXISTS `shop_product_variants`;
CREATE TABLE IF NOT EXISTS `shop_product_variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` double(20,5) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `mainImage` varchar(255) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `currency` int(11) DEFAULT NULL,
  `price_in_main` double(20,5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_variants_I_1` (`product_id`),
  KEY `shop_product_variants_I_2` (`position`),
  KEY `shop_product_variants_I_3` (`number`),
  KEY `shop_product_variants_I_5` (`price`),
  KEY `shop_product_variants_I_4` (`price`),
  KEY `shop_product_variants_FI_2` (`currency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18037 ;

--
-- Дамп данных таблицы `shop_product_variants`
--

INSERT INTO `shop_product_variants` (`id`, `product_id`, `price`, `number`, `stock`, `position`, `mainImage`, `external_id`, `currency`, `price_in_main`) VALUES
(17934, 17233, 35.00000, '', 0, NULL, '109cc4671f2da15e5d199e95246fe3bb.jpg', NULL, 1, 35.00000),
(17935, 17233, 35.00000, '', 0, 1, 'b97392d25e4f63dd768b60b782b4c9ed.jpg', NULL, 1, 35.00000),
(17937, 17234, 40.00000, '', 1, NULL, 'b775166a4945013ff8a34ac0c5758f30.jpg', NULL, 1, 40.00000),
(17938, 17234, 40.00000, '', 1, 1, '93a112b70456573a0b4ec737e17982a2.jpg', NULL, 1, 40.00000),
(17939, 17235, 110.00000, '', 1, NULL, 'c22411d7fdd57cccfa80fcbbde0481cd.jpg', NULL, 1, 110.00000),
(17940, 17236, 10.00000, '', 1, NULL, '28ed4775c04f42f63e090af581343bf4.jpg', NULL, 1, 10.00000),
(17941, 17236, 15.00000, '', 1, 1, '7d481bc091cd04cc80e1e0e860bd24da.jpg', NULL, 1, 15.00000),
(17942, 17236, 20.00000, '', 1, 2, 'beae55a999f6a35a221395524743e9ad.jpg', NULL, 1, 20.00000),
(17943, 17236, 25.00000, '', 1, 3, '571baabf376b67f1b9c7c69b897a6f6d.jpg', NULL, 1, 25.00000),
(17944, 17237, 90.00000, '', 1, NULL, '110c5a8c7d2ae26a323e422b4cecd239.jpg', NULL, 1, 90.00000),
(17945, 17237, 95.00000, '', 1, 1, '2fc94e99c527930629b19b582f4d42c1.jpg', NULL, 1, 95.00000),
(17946, 17237, 100.00000, '', 1, 2, '2162c023e816af31b668f5bc0535f845.jpg', NULL, 1, 100.00000),
(17947, 17237, 140.00000, '', 1, 3, 'd73e8e8bf88dd3881a8d3c14a76c8a7c.jpg', NULL, 1, 140.00000),
(17948, 17238, 10.00000, '', 1, NULL, '500bc9b9a8f9889054072ea2bb210739.jpg', NULL, 1, 10.00000),
(17949, 17238, 15.00000, '', 1, 1, '7071a83af0a37d6aeae002394bf1f656.jpg', NULL, 1, 15.00000),
(17950, 17238, 20.00000, '', 1, 2, '06ec550fd399cd31089ff4b0ed2b44c7.jpg', NULL, 1, 20.00000),
(17951, 17238, 30.00000, '', 1, 3, 'adf4f72a6b539ec8f6addb456b491a8d.jpg', NULL, 1, 30.00000),
(17952, 17239, 1220.00000, '', 1, NULL, '3ce5a44fd0468e6822541cd0683f8e26.jpg', NULL, 1, 1220.00000),
(17953, 17239, 1240.00000, '', 1, 1, 'bf1eb38ffa4fdb8986e044770fbade36.jpg', NULL, 1, 1240.00000),
(17954, 17239, 1200.00000, '', 1, 2, '2bf2776ef089c992fe0c64b9095907c8.jpg', NULL, 1, 1200.00000),
(17955, 17240, 100.00000, '', 1, NULL, '81a236507173638e57ed45e29c631c0d.jpg', NULL, 1, 100.00000),
(17956, 17240, 130.00000, '', 1, 1, '5d5a2b56fc621827f733789e68d127e3.jpg', NULL, 1, 130.00000),
(17957, 17240, 140.00000, '', 1, 2, '4bc1db6ff23b031c769de11879f15ee8.jpg', NULL, 1, 140.00000),
(17958, 17241, 1600.00000, '', 1, NULL, '407105a45a4b7877fd11eec3a2001f43.png', NULL, 1, 1600.00000),
(17959, 17241, 1600.00000, '', 1, 1, '71be5c23123fd09f5926416f82b1a09a.png', NULL, 1, 1600.00000),
(17960, 17241, 1600.00000, '', 1, 2, 'c4e28c9cb4275e6c48fadd2a440b293a.png', NULL, 1, 1600.00000),
(17961, 17242, 200.00000, '', 1, NULL, 'acf69088a10977480c618fba04867a77.jpg', NULL, 1, 200.00000),
(17962, 17242, 200.00000, '', 1, 1, 'fe1bbef36cb32027aae323d438977f91.png', NULL, 1, 200.00000),
(17963, 17242, 200.00000, '', 1, 2, '7946500aef0026c9a9a8c4d435dc973b.png', NULL, 1, 200.00000),
(17964, 17242, 200.00000, '', 1, 3, '173e82cf51b64a86cd025dca49f9db38.png', NULL, 1, 200.00000),
(17965, 17243, 1240.00000, '', 1, NULL, '81128bf3852c8e280ace44a03fc8361c.jpg', NULL, 1, 1240.00000),
(17966, 17243, 1240.00000, '', 1, 1, 'efc45a8b8f889ce3259fe0882fc28364.jpg', NULL, 1, 1240.00000),
(17967, 17243, 1240.00000, '', 1, 2, '056e23f42e6eca17023a9a7bbd6d3e98.jpg', NULL, 1, 1240.00000),
(17968, 17243, 1240.00000, '', 1, 3, 'fd9ab9996c721f1532a366c297f99a15.jpg', NULL, 1, 1240.00000),
(17969, 17243, 240.00000, '', 1, 4, '27f1cea192b1562e3bbaf271cca35910.jpg', NULL, 1, 240.00000),
(17970, 17244, 1310.00000, '', 1, NULL, '8b2371c31014b1e2491fc9a0ccf8997d.jpg', NULL, 1, 1310.00000),
(17971, 17244, 1280.00000, '', 1, 1, 'cf499b6786d174031134ed6cea5e52e8.jpg', NULL, 1, 1280.00000),
(17972, 17245, 1140.00000, '', 1, NULL, '8b5d4197be4fff6bcaf3319c8daf27b1.jpg', NULL, 1, 1140.00000),
(17973, 17245, 1120.00000, '', 1, 1, '1340b28911198c37dd707efce42c0ee4.jpg', NULL, 1, 1120.00000),
(17974, 17246, 1180.00000, '', 1, NULL, 'fcc85ba171f59afad68aba91bcdbe957.jpg', NULL, 1, 1180.00000),
(17975, 17246, 1180.00000, '', 1, 1, 'cbc89644815d6e051d617a4387acf55e.jpg', NULL, 1, 1180.00000),
(17976, 17247, 1220.00000, '', 1, NULL, 'bff453f14734bedc7e1231908a9d1aea.jpg', NULL, 1, 1220.00000),
(17977, 17247, 1200.00000, '', 1, 1, '129979b58d18a04494ff8ccf2eb59020.jpg', NULL, 1, 1200.00000),
(17978, 17248, 240.00000, '', 1, NULL, '6d2d7b326e8a8a1f1ac036390b8f91df.jpg', NULL, 1, 240.00000),
(17979, 17248, 240.00000, '', 1, 1, '5f195446285f94f79a4fba51ea55efd2.jpg', NULL, 1, 240.00000),
(17980, 17248, 210.00000, '', 1, 2, '4e70f2d5e3c63ced462a6d308f6e2a3c.jpg', NULL, 1, 210.00000),
(17981, 17249, 100.00000, '', 1, NULL, '5b8e718b6dbc01a21f4a4b6303e335f8.jpg', NULL, 1, 100.00000),
(17982, 17249, 100.00000, '', 1, 1, '8e4afccadda0a29ba9d3cdc0e60fbea2.jpg', NULL, 1, 100.00000),
(17983, 17249, 100.00000, '', 1, 2, '06dab0d4a432e7b2996101c317b5db05.jpg', NULL, 1, 100.00000),
(17984, 17249, 100.00000, '', 1, 3, 'daaad5656c35b37cfc83b145be95f993.jpg', NULL, 1, 100.00000),
(17985, 17250, 110.00000, '', 1, NULL, 'c14a5734c55cb2698b6d5b93a10c0902.jpg', NULL, 1, 110.00000),
(17986, 17250, 110.00000, '', 1, 1, '6671df8b4d4802b946f8a04f89c57edc.jpg', NULL, 1, 110.00000),
(17987, 17251, 110.00000, '', 1, NULL, 'daa5a957f567db38225c3ef5f73be2bc.jpg', NULL, 1, 110.00000),
(17988, 17251, 110.00000, '', 1, 1, '1a7538585e30dbf64c8970125bc248f2.jpg', NULL, 1, 110.00000),
(17989, 17251, 110.00000, '', 1, 2, 'ff0ca5a3aa39d21459b4cd28c60e78d3.jpg', NULL, 1, 110.00000),
(17990, 17252, 200.00000, '', 1, NULL, '666f57a6447b5d573c2eb39476d45278.jpg', NULL, 1, 200.00000),
(17991, 17252, 200.00000, '', 1, 1, '6d090482ee9925f44db6ec3ba9eb512e.jpg', NULL, 1, 200.00000),
(17992, 17252, 200.00000, '', 1, 2, 'd97e6cc118423e995aaa45fbe89cbf04.jpg', NULL, 1, 200.00000),
(17994, 17253, 120.00000, '', 1, NULL, '2d408577c1dd9614c1161835dd94d0d3.jpg', NULL, 1, 120.00000),
(17995, 17253, 120.00000, '', 1, 1, 'fe68412fc64e5a629a44b812ee9acae0.jpg', NULL, 1, 120.00000),
(17996, 17253, 120.00000, '', 1, 2, 'b80797ebf255b5e35da26ea1fd826080.jpg', NULL, 1, 120.00000),
(17997, 17253, 120.00000, '', 1, 3, 'd43971d4d8876a360639c7041d1bc260.jpg', NULL, 1, 120.00000),
(17998, 17253, 120.00000, '', 1, 4, 'e4bfa514d1971efd584cb28f95a8e847.jpg', NULL, 1, 120.00000),
(17999, 17254, 320.00000, '', 1, NULL, 'bcaa58524b34afd86b86f988dd204184.jpg', NULL, 1, 320.00000),
(18000, 17254, 325.00000, '', 1, 1, 'ad5d15993f1c08cfafa935eef5464e1e.jpg', NULL, 1, 325.00000),
(18001, 17254, 340.00000, '', 1, 2, 'e0df876838d4c24c4346c6b89165439b.jpg', NULL, 1, 340.00000),
(18002, 17254, 335.00000, '', 1, 3, 'e33ae52b3c0b8a44a623120bdf9f074f.jpg', NULL, 1, 335.00000),
(18003, 17255, 440.00000, '', 1, NULL, 'bc7c5e82cf4e4ef271ce0e15f4733558.jpg', NULL, 1, 440.00000),
(18004, 17255, 440.00000, '', 1, 1, '1f2cebd6c9727c48ff929233d513d096.jpg', NULL, 1, 440.00000),
(18005, 17255, 400.00000, '', 1, 2, '17256e89877ff916ac5bfcea2013840e.jpg', NULL, 1, 400.00000),
(18006, 17256, 105.00000, '', 1, NULL, '480a9d30494fa54cb28b40b70aa57156.jpg', NULL, 1, 105.00000),
(18007, 17256, 110.00000, '', 1, 1, '75d7ba22300a1229de10df9f90731703.jpg', NULL, 1, 110.00000),
(18009, 17256, 120.00000, '', 1, 2, 'cef198f0209c09cfaba55a7c177c5e7d.jpg', NULL, 1, 120.00000),
(18011, 17257, 240.00000, '', 1, NULL, '417d97a45aba9f80ee286172ba1ef14a.jpg', NULL, 1, 240.00000),
(18012, 17257, 240.00000, '', 1, 1, '22ff02313095cc78a69373563379c082.jpg', NULL, 1, 240.00000),
(18013, 17257, 240.00000, '', 1, 2, '7219a6f9544e619f8b4d2c9b266fe4c3.jpg', NULL, 1, 240.00000),
(18014, 17258, 180.00000, '', 1, NULL, '2abc3303a1e16da5395390df0f056f7f.jpg', NULL, 1, 180.00000),
(18015, 17258, 180.00000, '', 1, 1, 'bf71291cc1d8b3a1c07aab64e47808b9.jpg', NULL, 1, 180.00000),
(18016, 17258, 180.00000, '', 1, 2, 'e1b63a5783647e695ad731b5b9673318.jpg', NULL, 1, 180.00000),
(18017, 17258, 180.00000, '', 1, 3, '8c181b285b5e7fdabe8cbcd83476c7d6.jpg', NULL, 1, 180.00000),
(18018, 17259, 120.00000, '', 1, NULL, '1b241bbad23dad4ceb9efbf58093822b.jpeg', NULL, 1, 120.00000),
(18019, 17259, 120.00000, '', 1, 1, '175026abbb6fce8f99a695a5651ebbb2.jpeg', NULL, 1, 120.00000),
(18020, 17259, 120.00000, '', 1, 2, 'c96ca72e02cd42b52f626a53b586038c.jpeg', NULL, 1, 120.00000),
(18021, 17259, 120.00000, '', 1, 3, '77afe045f1e5a67a3cd3fe63d9fa312e.jpeg', NULL, 1, 120.00000),
(18022, 17259, 1110.00000, '', 1, 4, '3b8ff13abc5e36a1b15835702e55e442.jpeg', NULL, 1, 1110.00000),
(18024, 17260, 20.00000, '', 1, NULL, 'dcc1f5216a2817b49cb98798d0bc32c2.jpg', NULL, 1, 20.00000),
(18025, 17260, 20.00000, '', 1, 1, '22395356ce4232ebb004a741f54d6599.jpg', NULL, 1, 20.00000),
(18026, 17260, 20.00000, '', 1, 2, 'f936cdea200f3ee62b5f5470fd2f4f03.jpg', NULL, 1, 20.00000),
(18027, 17260, 20.00000, '', 1, 3, 'a26e89a4a9445c7280a3c5cfa88af7d6.jpg', NULL, 1, 20.00000),
(18028, 17261, 25.00000, '', 1, NULL, '655447cae8976d7fedec35d4b7d3e4ab.jpg', NULL, 1, 25.00000),
(18029, 17261, 20.00000, '', 1, 1, 'd3474d8ae1abff7ff59521e0412e3825.jpg', NULL, 1, 20.00000),
(18030, 17261, 21.00000, '', 1, 2, 'f2c528b417ba12309603d5e59ee8469e.jpg', NULL, 1, 21.00000),
(18031, 17261, 19.00000, '', 1, 3, '2230e3af5e016c02c9835344189bdf6e.jpg', NULL, 1, 19.00000),
(18032, 17262, 50.00000, '', 1, NULL, '62cff6a447fc6396f1bc7e72c325f177.jpg', NULL, 1, 50.00000),
(18033, 17262, 50.00000, '', 1, 1, '419210f63fa4ee69df0f1be3935abf50.jpg', NULL, 1, 50.00000),
(18034, 17262, 50.00000, '', 1, 2, 'c9765374a8020b07bfeba8ead6b8bf39.jpg', NULL, 1, 50.00000),
(18035, 17262, 50.00000, '', 1, 3, 'daeb0ba7db3ab40495928dd4d7bdf125.jpg', NULL, 1, 50.00000),
(18036, 17262, 50.00000, '', 1, 4, 'e91a84dd09d8d493f55953381792719e.jpg', NULL, 1, 50.00000);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_variants_i18n`
--

DROP TABLE IF EXISTS `shop_product_variants_i18n`;
CREATE TABLE IF NOT EXISTS `shop_product_variants_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_product_variants_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_product_variants_i18n`
--

INSERT INTO `shop_product_variants_i18n` (`id`, `locale`, `name`) VALUES
(17934, 'ru', 'Сопротивление 35 Ω'),
(17935, 'ru', 'Сопротивление 30 Ω'),
(17937, 'ru', 'проводное соединение'),
(17938, 'ru', 'беспроводное соединение'),
(17939, 'ru', NULL),
(17940, 'ru', '8 Гб'),
(17941, 'ru', '16 Гб'),
(17942, 'ru', '32 Гб'),
(17943, 'ru', '64 Гб'),
(17944, 'ru', '60 Гб'),
(17945, 'ru', '120 Гб'),
(17946, 'ru', '240 Гб'),
(17947, 'ru', '500 Гб'),
(17948, 'ru', '16 Гб'),
(17949, 'ru', '32 Гб'),
(17950, 'ru', '64 Гб'),
(17951, 'ru', '128 Гб'),
(17952, 'ru', 'Windows 8.1'),
(17953, 'ru', 'Windows 7'),
(17954, 'ru', 'Без ОС'),
(17955, 'ru', 'Android 4.4.2'),
(17956, 'ru', 'android 5.0 lollipop'),
(17957, 'ru', 'android 6.0 milkshake'),
(17958, 'ru', 'Серебристый'),
(17959, 'ru', 'Золотистый'),
(17960, 'ru', 'Серый космос'),
(17961, 'ru', 'Basic'),
(17962, 'ru', 'Black'),
(17963, 'ru', 'White'),
(17964, 'ru', 'Sand'),
(17965, 'ru', 'Basic'),
(17966, 'ru', 'Orange'),
(17967, 'ru', 'Black'),
(17968, 'ru', 'Red'),
(17969, 'ru', 'Grey'),
(17970, 'ru', 'windows 8.1'),
(17971, 'ru', 'без ОС'),
(17972, 'ru', 'Windows 8.1'),
(17973, 'ru', 'Без ОС'),
(17974, 'ru', 'White'),
(17975, 'ru', 'Red'),
(17976, 'ru', 'Windows 8.1'),
(17977, 'ru', 'Linux'),
(17978, 'ru', 'Черная экокожа'),
(17979, 'ru', 'Белая экокожа'),
(17980, 'ru', 'Серая Антара'),
(17981, 'ru', 'Желтый'),
(17982, 'ru', 'Кобальт'),
(17983, 'ru', 'Красный'),
(17984, 'ru', 'Пурпурный'),
(17985, 'ru', 'Венге'),
(17986, 'ru', 'Орех'),
(17987, 'ru', 'Оранжевые'),
(17988, 'ru', 'Чёрные'),
(17989, 'ru', 'Белые'),
(17990, 'ru', 'L'),
(17991, 'ru', 'XL'),
(17992, 'ru', 'XXL'),
(17994, 'ru', 'Зеленый'),
(17995, 'ru', 'Красный'),
(17996, 'ru', 'Черный'),
(17997, 'ru', 'Желтый'),
(17998, 'ru', 'Синий'),
(17999, 'ru', 'Обычная'),
(18000, 'ru', 'с насадкой кородер НК-100'),
(18001, 'ru', 'с насадкой болгарка Е-1'),
(18002, 'ru', 'с насадкой винтовой дровокол'),
(18003, 'ru', 'Обычный'),
(18004, 'ru', 'с бензиновым двигателем G-200'),
(18005, 'ru', 'с дизельным двигателем G-200d'),
(18006, 'ru', 'Объем 25 л.'),
(18007, 'ru', 'Объем 30 л.'),
(18009, 'ru', 'Объем 45 л.'),
(18011, 'ru', 'Каштановый'),
(18012, 'ru', 'Красный'),
(18013, 'ru', 'Черный'),
(18014, 'ru', 'Бук'),
(18015, 'ru', 'Ольха'),
(18016, 'ru', 'Орех'),
(18017, 'ru', 'Белая'),
(18018, 'ru', 'Бук'),
(18019, 'ru', 'Орех'),
(18020, 'ru', 'Белый'),
(18021, 'ru', 'Ольха'),
(18022, 'ru', 'Комби'),
(18024, 'ru', 'Pink 2X'),
(18025, 'ru', 'Blue L'),
(18026, 'ru', 'Pink 3X'),
(18027, 'ru', 'Blue M'),
(18028, 'ru', 'Blue L'),
(18029, 'ru', 'Pink 2X'),
(18030, 'ru', 'Blue M'),
(18031, 'ru', 'Pink 3X'),
(18032, 'ru', 'Обычный'),
(18033, 'ru', 'Оранжевый'),
(18034, 'ru', 'Фиолетовый'),
(18035, 'ru', 'Зеленый'),
(18036, 'ru', 'Розовый');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_group`
--

DROP TABLE IF EXISTS `shop_rbac_group`;
CREATE TABLE IF NOT EXISTS `shop_rbac_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- Дамп данных таблицы `shop_rbac_group`
--

INSERT INTO `shop_rbac_group` (`id`, `type`, `name`, `description`) VALUES
(1, 'shop', 'ShopAdminBanners', NULL),
(2, 'shop', 'ShopAdminBrands', NULL),
(3, 'shop', 'ShopAdminCallbacks', NULL),
(4, 'shop', 'ShopAdminCategories', NULL),
(5, 'shop', 'ShopAdminCharts', NULL),
(6, 'shop', 'ShopAdminComulativ', NULL),
(7, 'shop', 'ShopAdminCurrencies', NULL),
(8, 'shop', 'ShopAdminCustomfields', NULL),
(9, 'shop', 'ShopAdminDashboard', NULL),
(10, 'shop', 'ShopAdminDeliverymethods', NULL),
(11, 'shop', 'ShopAdminDiscounts', NULL),
(12, 'shop', 'ShopAdminGifts', NULL),
(13, 'shop', 'ShopAdminKits', NULL),
(14, 'shop', 'ShopAdminNotifications', NULL),
(15, 'shop', 'ShopAdminNotificationstatuses', NULL),
(16, 'shop', 'ShopAdminOrders', NULL),
(17, 'shop', 'ShopAdminOrderstatuses', NULL),
(18, 'shop', 'ShopAdminPaymentmethods', NULL),
(19, 'shop', 'ShopAdminProducts', NULL),
(20, 'shop', 'ShopAdminProductspy', NULL),
(21, 'shop', 'ShopAdminProperties', NULL),
(22, 'shop', 'ShopAdminRbac', NULL),
(23, 'shop', 'ShopAdminSearch', NULL),
(24, 'shop', 'ShopAdminSettings', NULL),
(25, 'shop', 'ShopAdminSystem', NULL),
(26, 'shop', 'ShopAdminUsers', NULL),
(27, 'shop', 'ShopAdminWarehouses', NULL),
(28, 'base', 'Admin', NULL),
(29, 'base', 'Admin_logs', NULL),
(30, 'base', 'Admin_search', NULL),
(31, 'base', 'Backup', NULL),
(32, 'base', 'Cache_all', NULL),
(33, 'base', 'Categories', NULL),
(34, 'base', 'Components', NULL),
(35, 'base', 'Dashboard', NULL),
(36, 'base', 'Languages', NULL),
(37, 'base', 'Login', NULL),
(39, 'base', 'Pages', NULL),
(40, 'base', 'Rbac', NULL),
(41, 'base', 'Settings', NULL),
(43, 'module', 'Cfcm', NULL),
(44, 'module', 'Comments', NULL),
(45, 'module', 'Feedback', NULL),
(46, 'module', 'Gallery', NULL),
(47, 'module', 'Group_mailer', NULL),
(48, 'module', 'Mailer', NULL),
(49, 'module', 'Menu', NULL),
(50, 'module', 'Rss', NULL),
(51, 'module', 'Sample_mail', NULL),
(52, 'module', 'Sample_module', NULL),
(53, 'module', 'Share', NULL),
(54, 'module', 'Sitemap', NULL),
(55, 'module', 'Social_servises', NULL),
(56, 'module', 'Template_editor', NULL),
(57, 'module', 'Trash', NULL),
(58, 'module', 'User_manager', NULL),
(59, 'base', 'Widgets_manager', NULL),
(60, 'module', 'Import_export', NULL),
(61, 'module', 'Template_manager', NULL),
(62, 'module', 'Banners', NULL),
(63, 'module', 'Mod_discount', NULL),
(64, 'module', 'Cmsemail', NULL),
(65, 'module', 'Mod_seo', NULL),
(66, 'module', 'Exchange', NULL),
(67, 'module', 'Translator', NULL),
(68, 'module', 'Imagebox', NULL),
(69, 'module', 'Star_rating', NULL),
(70, 'module', 'Mobile', NULL),
(71, 'module', 'Mod_stats', NULL),
(72, 'module', 'Wishlist', NULL),
(73, 'base', 'Sys_update', NULL),
(74, 'base', 'Sys_info', NULL),
(75, 'module', 'Ymarket', NULL),
(76, 'module', 'Module_frame', NULL),
(77, 'module', 'Hotline', NULL),
(78, 'module', 'Admin_menu', NULL),
(79, 'module', 'Xbanners', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_group_i18n`
--

DROP TABLE IF EXISTS `shop_rbac_group_i18n`;
CREATE TABLE IF NOT EXISTS `shop_rbac_group_i18n` (
  `id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `locale` varchar(5) NOT NULL,
  KEY `id_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_rbac_group_i18n`
--

INSERT INTO `shop_rbac_group_i18n` (`id`, `description`, `locale`) VALUES
(1, 'Управление баннерами', 'ru'),
(2, 'Управление брендами', 'ru'),
(3, 'Управление колбеками', 'ru'),
(4, 'Управление категориями товаров в магазине', 'ru'),
(5, 'Управление статистикой', 'ru'),
(6, 'Управление накопительными скидками', 'ru'),
(7, 'Управление валютами', 'ru'),
(8, 'Управление дополнительными полями для магазина', 'ru'),
(9, 'Главная страница панели управления магазином', 'ru'),
(10, 'Управление способами доставки', 'ru'),
(11, 'Управление скидками', 'ru'),
(12, 'Управление подарочными сертификатами', 'ru'),
(13, 'Управление наборами товаров', 'ru'),
(14, 'Управление уведомлениями', 'ru'),
(15, 'Управление статусами уведомлений', 'ru'),
(16, 'Управление заказами', 'ru'),
(17, 'Управление статусами заказов', 'ru'),
(18, 'Управление методами оплаты', 'ru'),
(19, 'Управление товарами', 'ru'),
(20, 'Управление слежением за товарами', 'ru'),
(21, 'Управление свойствами товаров', 'ru'),
(23, 'Управление поиском', 'ru'),
(24, 'Управление настройками магазина', 'ru'),
(25, 'Управление системой магазина (импорт\\экспорт)', 'ru'),
(26, 'Управление юзерами магазина', 'ru'),
(27, 'Управление складами', 'ru'),
(28, 'Доступ к админпанели', 'ru'),
(29, 'История событий', 'ru'),
(30, 'Управление поиском в базовой админ панели', 'ru'),
(31, 'Управление бекапами', 'ru'),
(32, 'Управление кэшем', 'ru'),
(33, 'Управление категориями сайта', 'ru'),
(34, 'Управление компонентами сайта', 'ru'),
(35, 'Управление главной станицой базовой админ панели', 'ru'),
(36, 'Управление языками', 'ru'),
(37, 'Вход в админпанель', 'ru'),
(38, 'Поиск модулей для установки', 'ru'),
(39, 'Управление страницами', 'ru'),
(40, 'Управление правами доступа', 'ru'),
(41, 'Управление базовыми настройками', 'ru'),
(42, 'Управление обновлением системы', 'ru'),
(43, 'Управление констуктором полей', 'ru'),
(44, 'Управление комментариями', 'ru'),
(45, 'Управление обратной связью', 'ru'),
(46, 'Управление галереей', 'ru'),
(47, 'Управление модулем рассылки', 'ru'),
(48, 'Управление модулем подписки и рассылки', 'ru'),
(49, 'Управление меню', 'ru'),
(50, 'Управление модулем RSS', 'ru'),
(51, 'Управление шаблонами писем', 'ru'),
(52, 'Шаблон модуля', 'ru'),
(53, 'Управление модулем кнопок соцсетей', 'ru'),
(54, 'Управление модулем карта сайта', 'ru'),
(55, 'Управление модулем интеграции с соцсетями', 'ru'),
(56, 'Управление модулем редактор шаблонов', 'ru'),
(57, 'Управление модулем перенаправления', 'ru'),
(58, 'Управление пользователями', 'ru'),
(59, 'Управление виджетами', 'ru'),
(59, 'Импорт/Експорт', 'ru');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_privileges`
--

DROP TABLE IF EXISTS `shop_rbac_privileges`;
CREATE TABLE IF NOT EXISTS `shop_rbac_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_rbac_privileges_I_1` (`name`),
  KEY `shop_rbac_privileges_FI_1` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=732 ;

--
-- Дамп данных таблицы `shop_rbac_privileges`
--

INSERT INTO `shop_rbac_privileges` (`id`, `name`, `group_id`, `description`) VALUES
(1, 'ShopAdminBanners::index', 1, NULL),
(2, 'ShopAdminBanners::create', 1, NULL),
(3, 'ShopAdminBanners::edit', 1, NULL),
(4, 'ShopAdminBanners::deleteAll', 1, NULL),
(5, 'ShopAdminBanners::translate', 1, NULL),
(6, 'ShopAdminBanners::changeActive', 1, NULL),
(7, 'ShopAdminBrands::index', 2, NULL),
(8, 'ShopAdminBrands::create', 2, NULL),
(9, 'ShopAdminBrands::edit', 2, NULL),
(10, 'ShopAdminBrands::delete', 2, NULL),
(11, 'ShopAdminBrands::c_list', 2, NULL),
(12, 'ShopAdminBrands::translate', 2, NULL),
(13, 'ShopAdminCallbacks::index', 3, NULL),
(14, 'ShopAdminCallbacks::update', 3, NULL),
(15, 'ShopAdminCallbacks::statuses', 3, NULL),
(16, 'ShopAdminCallbacks::createStatus', 3, NULL),
(17, 'ShopAdminCallbacks::updateStatus', 3, NULL),
(18, 'ShopAdminCallbacks::setDefaultStatus', 3, NULL),
(19, 'ShopAdminCallbacks::changeStatus', 3, NULL),
(20, 'ShopAdminCallbacks::reorderThemes', 3, NULL),
(21, 'ShopAdminCallbacks::changeTheme', 3, NULL),
(22, 'ShopAdminCallbacks::deleteCallback', 3, NULL),
(23, 'ShopAdminCallbacks::deleteStatus', 3, NULL),
(24, 'ShopAdminCallbacks::themes', 3, NULL),
(25, 'ShopAdminCallbacks::createTheme', 3, NULL),
(26, 'ShopAdminCallbacks::updateTheme', 3, NULL),
(27, 'ShopAdminCallbacks::deleteTheme', 3, NULL),
(28, 'ShopAdminCallbacks::search', 3, NULL),
(29, 'ShopAdminCategories::index', 4, NULL),
(30, 'ShopAdminCategories::create', 4, NULL),
(31, 'ShopAdminCategories::edit', 4, NULL),
(32, 'ShopAdminCategories::delete', 4, NULL),
(33, 'ShopAdminCategories::c_list', 4, NULL),
(34, 'ShopAdminCategories::save_positions', 4, NULL),
(35, 'ShopAdminCategories::ajax_translit', 4, NULL),
(36, 'ShopAdminCategories::translate', 4, NULL),
(37, 'ShopAdminCategories::changeActive', 4, NULL),
(38, 'ShopAdminCategories::create_tpl', 4, NULL),
(39, 'ShopAdminCategories::get_tpl_names', 4, NULL),
(40, 'ShopAdminCharts::orders', 5, NULL),
(41, 'ShopAdminCharts::byDate', 5, NULL),
(42, 'ShopAdminCharts::_createDatesDropDown', 5, NULL),
(43, 'ShopAdminComulativ::index', 6, NULL),
(44, 'ShopAdminComulativ::create', 6, NULL),
(45, 'ShopAdminComulativ::edit', 6, NULL),
(46, 'ShopAdminComulativ::allUsers', 6, NULL),
(47, 'ShopAdminComulativ::user', 6, NULL),
(48, 'ShopAdminComulativ::deleteAll', 6, NULL),
(49, 'ShopAdminComulativ::change_comulativ_dis_status', 6, NULL),
(50, 'ShopAdminCurrencies::index', 7, NULL),
(51, 'ShopAdminCurrencies::create', 7, NULL),
(52, 'ShopAdminCurrencies::edit', 7, NULL),
(53, 'ShopAdminCurrencies::makeCurrencyDefault', 7, NULL),
(54, 'ShopAdminCurrencies::makeCurrencyMain', 7, NULL),
(55, 'ShopAdminCurrencies::delete', 7, NULL),
(56, 'ShopAdminCurrencies::recount', 7, NULL),
(57, 'ShopAdminCurrencies::checkPrices', 7, NULL),
(58, 'ShopAdminCustomfields::index', 8, NULL),
(59, 'ShopAdminCustomfields::create', 8, NULL),
(60, 'ShopAdminCustomfields::edit', 8, NULL),
(61, 'ShopAdminCustomfields::deleteAll', 8, NULL),
(62, 'ShopAdminCustomfields::change_status_activ', 8, NULL),
(63, 'ShopAdminCustomfields::change_status_private', 8, NULL),
(64, 'ShopAdminCustomfields::change_status_required', 8, NULL),
(65, 'ShopAdminDashboard::index', 9, NULL),
(66, 'ShopAdminDeliverymethods::index', 10, NULL),
(67, 'ShopAdminDeliverymethods::create', 10, NULL),
(68, 'ShopAdminDeliverymethods::change_delivery_status', 10, NULL),
(69, 'ShopAdminDeliverymethods::edit', 10, NULL),
(70, 'ShopAdminDeliverymethods::deleteAll', 10, NULL),
(71, 'ShopAdminDeliverymethods::c_list', 10, NULL),
(72, 'ShopAdminDiscounts::index', 11, NULL),
(73, 'ShopAdminDiscounts::create', 11, NULL),
(74, 'ShopAdminDiscounts::change_discount_status', 11, NULL),
(75, 'ShopAdminDiscounts::edit', 11, NULL),
(76, 'ShopAdminDiscounts::deleteAll', 11, NULL),
(77, 'ShopAdminGifts::index', 12, NULL),
(78, 'ShopAdminGifts::create', 12, NULL),
(79, 'ShopAdminGifts::generateKey', 12, NULL),
(80, 'ShopAdminGifts::delete', 12, NULL),
(81, 'ShopAdminGifts::edit', 12, NULL),
(82, 'ShopAdminGifts::ChangeActive', 12, NULL),
(83, 'ShopAdminGifts::settings', 12, NULL),
(84, 'ShopAdminGifts::save_settings', 12, NULL),
(85, 'ShopAdminKits::index', 13, NULL),
(86, 'ShopAdminKits::kit_create', 13, NULL),
(87, 'ShopAdminKits::kit_edit', 13, NULL),
(88, 'ShopAdminKits::kit_save_positions', 13, NULL),
(89, 'ShopAdminKits::kit_change_active', 13, NULL),
(90, 'ShopAdminKits::kit_list', 13, NULL),
(91, 'ShopAdminKits::kit_delete', 13, NULL),
(92, 'ShopAdminKits::get_products_list', 13, NULL),
(93, 'ShopAdminNotifications::index', 14, NULL),
(94, 'ShopAdminNotifications::edit', 14, NULL),
(95, 'ShopAdminNotifications::changeStatus', 14, NULL),
(96, 'ShopAdminNotifications::notifyByEmail', 14, NULL),
(97, 'ShopAdminNotifications::deleteAll', 14, NULL),
(98, 'ShopAdminNotifications::ajaxDeleteNotifications', 14, NULL),
(99, 'ShopAdminNotifications::ajaxChangeNotificationsStatus', 14, NULL),
(100, 'ShopAdminNotifications::search', 14, NULL),
(101, 'ShopAdminNotifications::getAvailableNotification', 14, NULL),
(102, 'ShopAdminNotificationstatuses::index', 15, NULL),
(103, 'ShopAdminNotificationstatuses::create', 15, NULL),
(104, 'ShopAdminNotificationstatuses::edit', 15, NULL),
(105, 'ShopAdminNotificationstatuses::deleteAll', 15, NULL),
(106, 'ShopAdminNotificationstatuses::savePositions', 15, NULL),
(107, 'ShopAdminOrders::index', 16, NULL),
(108, 'ShopAdminOrders::edit', 16, NULL),
(109, 'ShopAdminOrders::changeStatus', 16, NULL),
(110, 'ShopAdminOrders::changePaid', 16, NULL),
(111, 'ShopAdminOrders::delete', 16, NULL),
(112, 'ShopAdminOrders::ajaxDeleteOrders', 16, NULL),
(113, 'ShopAdminOrders::ajaxChangeOrdersStatus', 16, NULL),
(114, 'ShopAdminOrders::ajaxChangeOrdersPaid', 16, NULL),
(115, 'ShopAdminOrders::ajaxEditWindow', 16, NULL),
(116, 'ShopAdminOrders::editKit', 16, NULL),
(117, 'ShopAdminOrders::ajaxEditAddToCartWindow', 16, NULL),
(118, 'ShopAdminOrders::ajaxDeleteProduct', 16, NULL),
(119, 'ShopAdminOrders::ajaxGetProductList', 16, NULL),
(120, 'ShopAdminOrders::ajaxEditOrderCart', 16, NULL),
(121, 'ShopAdminOrders::ajaxEditOrderAddToCart', 16, NULL),
(122, 'ShopAdminOrders::ajaxGetOrderCart', 16, NULL),
(123, 'ShopAdminOrders::search', 16, NULL),
(124, 'ShopAdminOrders::printChecks', 16, NULL),
(125, 'ShopAdminOrders::createPDFPage', 16, NULL),
(126, 'ShopAdminOrders::createPdf', 16, NULL),
(127, 'ShopAdminOrders::create', 16, NULL),
(128, 'ShopAdminOrderstatuses::index', 17, NULL),
(129, 'ShopAdminOrderstatuses::create', 17, NULL),
(130, 'ShopAdminOrderstatuses::edit', 17, NULL),
(131, 'ShopAdminOrderstatuses::delete', 17, NULL),
(132, 'ShopAdminOrderstatuses::ajaxDeleteWindow', 17, NULL),
(133, 'ShopAdminOrderstatuses::savePositions', 17, NULL),
(134, 'ShopAdminPaymentmethods::index', 18, NULL),
(135, 'ShopAdminPaymentmethods::create', 18, NULL),
(136, 'ShopAdminPaymentmethods::change_payment_status', 18, NULL),
(137, 'ShopAdminPaymentmethods::edit', 18, NULL),
(138, 'ShopAdminPaymentmethods::deleteAll', 18, NULL),
(139, 'ShopAdminPaymentmethods::savePositions', 18, NULL),
(140, 'ShopAdminPaymentmethods::getAdminForm', 18, NULL),
(141, 'ShopAdminProducts::index', 19, NULL),
(142, 'ShopAdminProducts::create', 19, NULL),
(143, 'ShopAdminProducts::edit', 19, NULL),
(144, 'ShopAdminProducts::saveAdditionalImages', 19, NULL),
(145, 'ShopAdminProducts::delete', 19, NULL),
(146, 'ShopAdminProducts::processImage', 19, NULL),
(147, 'ShopAdminProducts::deleteAddImage', 19, NULL),
(148, 'ShopAdminProducts::ajaxChangeActive', 19, NULL),
(149, 'ShopAdminProducts::ajaxChangeHit', 19, NULL),
(150, 'ShopAdminProducts::ajaxChangeHot', 19, NULL),
(151, 'ShopAdminProducts::ajaxChangeAction', 19, NULL),
(152, 'ShopAdminProducts::ajaxUpdatePrice', 19, NULL),
(153, 'ShopAdminProducts::ajaxCloneProducts', 19, NULL),
(154, 'ShopAdminProducts::ajaxDeleteProducts', 19, NULL),
(155, 'ShopAdminProducts::ajaxMoveWindow', 19, NULL),
(156, 'ShopAdminProducts::ajaxMoveProducts', 19, NULL),
(157, 'ShopAdminProducts::translate', 19, NULL),
(158, 'ShopAdminProducts::get_ids', 19, NULL),
(159, 'ShopAdminProducts::prev_next', 19, NULL),
(160, 'ShopAdminProductspy::index', 20, NULL),
(161, 'ShopAdminProductspy::delete', 20, NULL),
(162, 'ShopAdminProductspy::settings', 20, NULL),
(163, 'ShopAdminProperties::index', 21, NULL),
(164, 'ShopAdminProperties::create', 21, NULL),
(165, 'ShopAdminProperties::edit', 21, NULL),
(166, 'ShopAdminProperties::renderForm', 21, NULL),
(167, 'ShopAdminProperties::save_positions', 21, NULL),
(168, 'ShopAdminProperties::delete', 21, NULL),
(169, 'ShopAdminProperties::changeActive', 21, NULL),
(184, 'ShopAdminSearch::index', 23, NULL),
(185, 'ShopAdminSearch::save_positions_variant', 23, NULL),
(186, 'ShopAdminSearch::autocomplete', 23, NULL),
(187, 'ShopAdminSearch::advanced', 23, NULL),
(188, 'ShopAdminSearch::renderCustomFields', 23, NULL),
(189, 'ShopAdminSettings::index', 24, NULL),
(190, 'ShopAdminSettings::update', 24, NULL),
(191, 'ShopAdminSettings::get_fsettings', 24, NULL),
(192, 'ShopAdminSettings::get_vsettings', 24, NULL),
(193, 'ShopAdminSettings::_get_templates', 24, NULL),
(194, 'ShopAdminSettings::_load_settings', 24, NULL),
(195, 'ShopAdminSettings::runResize', 24, NULL),
(196, 'ShopAdminSystem::import', 25, NULL),
(197, 'ShopAdminSystem::export', 25, NULL),
(198, 'ShopAdminSystem::getAttributes', 25, NULL),
(199, 'ShopAdminSystem::exportUsers', 25, NULL),
(200, 'ShopAdminUsers::index', 26, NULL),
(201, 'ShopAdminUsers::search', 26, NULL),
(202, 'ShopAdminUsers::create', 26, NULL),
(203, 'ShopAdminUsers::edit', 26, NULL),
(204, 'ShopAdminUsers::deleteAll', 26, NULL),
(205, 'ShopAdminUsers::auto_complite', 26, NULL),
(206, 'ShopAdminWarehouses::index', 27, NULL),
(207, 'ShopAdminWarehouses::create', 27, NULL),
(208, 'ShopAdminWarehouses::edit', 27, NULL),
(209, 'ShopAdminWarehouses::deleteAll', 27, NULL),
(210, 'Admin::__construct', 28, NULL),
(211, 'Admin::init', 28, NULL),
(212, 'Admin::index', 28, NULL),
(213, 'Admin::sys_info', 28, NULL),
(214, 'Admin::delete_cache', 28, NULL),
(215, 'Admin::elfinder_init', 28, NULL),
(216, 'Admin::get_csrf', 28, NULL),
(217, 'Admin::sidebar_cats', 28, NULL),
(218, 'Admin::logout', 28, NULL),
(219, 'Admin::report_bug', 28, NULL),
(220, 'Admin_logs::__construct', 29, NULL),
(221, 'Admin_logs::index', 29, NULL),
(222, 'Admin_search::__construct', 30, NULL),
(223, 'Admin_search::index', 30, NULL),
(224, 'Admin_search::advanced_search', 30, NULL),
(225, 'Admin_search::do_advanced_search', 30, NULL),
(226, 'Admin_search::validate_advanced_search', 30, NULL),
(227, 'Admin_search::form_from_group', 30, NULL),
(228, 'Admin_search::_filter_pages', 30, NULL),
(229, 'Admin_search::autocomplete', 30, NULL),
(230, 'Backup::__construct', 31, NULL),
(231, 'Backup::index', 31, NULL),
(232, 'Backup::create', 31, NULL),
(233, 'Backup::force_download', 31, NULL),
(234, 'Cache_all::__construct', 32, NULL),
(235, 'Cache_all::index', 32, NULL),
(236, 'Categories::__construct', 33, NULL),
(237, 'Categories::index', 33, NULL),
(238, 'Categories::create_form', 33, NULL),
(239, 'Categories::update_block', 33, NULL),
(240, 'Categories::save_positions', 33, NULL),
(241, 'Categories::cat_list', 33, NULL),
(242, 'Categories::sub_cats', 33, NULL),
(243, 'Categories::create', 33, NULL),
(244, 'Categories::update_urls', 33, NULL),
(245, 'Categories::category_exists', 33, NULL),
(246, 'Categories::fast_add', 33, NULL),
(247, 'Categories::update_fast_block', 33, NULL),
(248, 'Categories::edit', 33, NULL),
(249, 'Categories::translate', 33, NULL),
(250, 'Categories::delete', 33, NULL),
(251, 'Categories::_get_sub_cats', 33, NULL),
(252, 'Categories::get_comments_status', 33, NULL),
(253, 'Components::__construct', 34, NULL),
(254, 'Components::index', 34, NULL),
(255, 'Components::modules_table', 34, NULL),
(256, 'Components::is_installed', 34, NULL),
(257, 'Components::install', 34, NULL),
(258, 'Components::deinstall', 34, NULL),
(259, 'Components::find_components', 34, NULL),
(260, 'Components::component_settings', 34, NULL),
(261, 'Components::save_settings', 34, NULL),
(262, 'Components::init_window', 34, NULL),
(263, 'Components::cp', 34, NULL),
(264, 'Components::run', 34, NULL),
(265, 'Components::com_info', 34, NULL),
(266, 'Components::get_module_info', 34, NULL),
(267, 'Components::change_autoload', 34, NULL),
(268, 'Components::change_url_access', 34, NULL),
(269, 'Components::save_components_positions', 34, NULL),
(270, 'Components::change_show_in_menu', 34, NULL),
(271, 'Dashboard::__construct', 35, NULL),
(272, 'Dashboard::index', 35, NULL),
(273, 'Languages::__construct', 36, NULL),
(274, 'Languages::index', 36, NULL),
(275, 'Languages::create_form', 36, NULL),
(276, 'Languages::insert', 36, NULL),
(277, 'Languages::edit', 36, NULL),
(278, 'Languages::update', 36, NULL),
(279, 'Languages::delete', 36, NULL),
(280, 'Languages::set_default', 36, NULL),
(281, 'Login::__construct', 37, NULL),
(282, 'Login::index', 37, NULL),
(283, 'Login::user_browser', 37, NULL),
(284, 'Login::do_login', 37, NULL),
(285, 'Login::forgot_password', 37, NULL),
(286, 'Login::update_captcha', 37, NULL),
(287, 'Login::captcha_check', 37, NULL),
(288, 'Mod_search::__construct', 38, NULL),
(289, 'Mod_search::index', 38, NULL),
(290, 'Mod_search::category', 38, NULL),
(291, 'Mod_search::display_install_window', 38, NULL),
(292, 'Mod_search::connect_ftp', 38, NULL),
(293, 'Pages::__construct', 39, NULL),
(294, 'Pages::index', 39, NULL),
(295, 'Pages::add', 39, NULL),
(296, 'Pages::_set_page_roles', 39, NULL),
(297, 'Pages::edit', 39, NULL),
(298, 'Pages::update', 39, NULL),
(299, 'Pages::delete', 39, NULL),
(300, 'Pages::ajax_translit', 39, NULL),
(301, 'Pages::save_positions', 39, NULL),
(302, 'Pages::delete_pages', 39, NULL),
(303, 'Pages::move_pages', 39, NULL),
(304, 'Pages::show_move_window', 39, NULL),
(305, 'Pages::json_tags', 39, NULL),
(306, 'Pages::ajax_create_keywords', 39, NULL),
(307, 'Pages::ajax_create_description', 39, NULL),
(308, 'Pages::ajax_change_status', 39, NULL),
(309, 'Pages::GetPagesByCategory', 39, NULL),
(310, 'Rbac::__construct', 40, NULL),
(311, 'Settings::__construct', 41, NULL),
(312, 'Settings::index', 41, NULL),
(313, 'Settings::main_page', 41, NULL),
(314, 'Settings::_get_templates', 41, NULL),
(315, 'Settings::save', 41, NULL),
(316, 'Settings::switch_admin_lang', 41, NULL),
(317, 'Settings::save_main', 41, NULL),
(318, 'Sys_upgrade::__construct', 42, NULL),
(319, 'Sys_upgrade::index', 42, NULL),
(320, 'Sys_upgrade::make_upgrade', 42, NULL),
(321, 'Sys_upgrade::_check_status', 42, NULL),
(322, 'cfcm::__construct', 43, NULL),
(323, 'cfcm::_set_forms_config', 43, NULL),
(324, 'cfcm::index', 43, NULL),
(325, 'cfcm::create_field', 43, NULL),
(326, 'cfcm::edit_field_data_type', 43, NULL),
(327, 'cfcm::delete_field', 43, NULL),
(328, 'cfcm::edit_field', 43, NULL),
(329, 'cfcm::create_group', 43, NULL),
(330, 'cfcm::edit_group', 43, NULL),
(331, 'cfcm::delete_group', 43, NULL),
(332, 'cfcm::form_from_category_group', 43, NULL),
(333, 'cfcm::get_form_attributes', 43, NULL),
(334, 'cfcm::save_weight', 43, NULL),
(335, 'cfcm::render', 43, NULL),
(336, 'cfcm::get_url', 43, NULL),
(337, 'cfcm::get_form', 43, NULL),
(338, 'comments::__construct', 44, NULL),
(339, 'comments::index', 44, NULL),
(340, 'comments::proccess_child_comments', 44, NULL),
(341, 'comments::render', 44, NULL),
(342, 'comments::edit', 44, NULL),
(343, 'comments::update', 44, NULL),
(344, 'comments::update_status', 44, NULL),
(345, 'comments::delete', 44, NULL),
(346, 'comments::delete_many', 44, NULL),
(347, 'comments::show_settings', 44, NULL),
(348, 'comments::update_settings', 44, NULL),
(349, 'feedback::__construct', 45, NULL),
(350, 'feedback::index', 45, NULL),
(351, 'feedback::settings', 45, NULL),
(352, 'gallery::__construct', 46, NULL),
(353, 'gallery::index', 46, NULL),
(354, 'gallery::category', 46, NULL),
(355, 'gallery::settings', 46, NULL),
(356, 'gallery::create_album', 46, NULL),
(357, 'gallery::update_album', 46, NULL),
(358, 'gallery::edit_album_params', 46, NULL),
(359, 'gallery::delete_album', 46, NULL),
(360, 'gallery::show_crate_album', 46, NULL),
(361, 'gallery::edit_album', 46, NULL),
(362, 'gallery::edit_image', 46, NULL),
(363, 'gallery::rename_image', 46, NULL),
(364, 'gallery::delete_image', 46, NULL),
(365, 'gallery::update_info', 46, NULL),
(366, 'gallery::update_positions', 46, NULL),
(367, 'gallery::update_album_positions', 46, NULL),
(368, 'gallery::update_img_positions', 46, NULL),
(369, 'gallery::show_create_category', 46, NULL),
(370, 'gallery::create_category', 46, NULL),
(371, 'gallery::edit_category', 46, NULL),
(372, 'gallery::update_category', 46, NULL),
(373, 'gallery::delete_category', 46, NULL),
(374, 'gallery::upload_image', 46, NULL),
(375, 'gallery::upload_archive', 46, NULL),
(376, 'group_mailer::__construct', 47, NULL),
(377, 'group_mailer::index', 47, NULL),
(378, 'group_mailer::send_email', 47, NULL),
(379, 'mailer::__construct', 48, NULL),
(380, 'mailer::index', 48, NULL),
(381, 'mailer::send_email', 48, NULL),
(382, 'mailer::delete', 48, NULL),
(383, 'menu::__construct', 49, NULL),
(384, 'menu::index', 49, NULL),
(385, 'menu::menu_item', 49, NULL),
(386, 'menu::list_menu_items', 49, NULL),
(387, 'menu::create_item', 49, NULL),
(388, 'menu::display_selector', 49, NULL),
(389, 'menu::get_name_by_id', 49, NULL),
(390, 'menu::delete_item', 49, NULL),
(391, 'menu::edit_item', 49, NULL),
(392, 'menu::process_root', 49, NULL),
(393, 'menu::insert_menu_item', 49, NULL),
(394, 'menu::save_positions', 49, NULL),
(395, 'menu::create_menu', 49, NULL),
(396, 'menu::edit_menu', 49, NULL),
(397, 'menu::update_menu', 49, NULL),
(398, 'menu::check_menu_data', 49, NULL),
(399, 'menu::delete_menu', 49, NULL),
(400, 'menu::create_tpl', 49, NULL),
(401, 'menu::get_pages', 49, NULL),
(402, 'menu::search_pages', 49, NULL),
(403, 'menu::get_item', 49, NULL),
(404, 'menu::display_tpl', 49, NULL),
(405, 'menu::fetch_tpl', 49, NULL),
(406, 'menu::translate_window', 49, NULL),
(407, 'menu::translate_item', 49, NULL),
(408, 'menu::_get_langs', 49, NULL),
(409, 'menu::render', 49, NULL),
(410, 'menu::change_hidden', 49, NULL),
(411, 'menu::get_children_items', 49, NULL),
(412, 'rss::__construct', 50, NULL),
(413, 'rss::index', 50, NULL),
(414, 'rss::render', 50, NULL),
(415, 'rss::settings_update', 50, NULL),
(416, 'rss::display_tpl', 50, NULL),
(417, 'rss::fetch_tpl', 50, NULL),
(418, 'sample_mail::__construct', 51, NULL),
(419, 'sample_mail::create', 51, NULL),
(420, 'sample_mail::edit', 51, NULL),
(421, 'sample_mail::render', 51, NULL),
(422, 'sample_mail::index', 51, NULL),
(423, 'sample_mail::delete', 51, NULL),
(424, 'sample_module::__construct', 52, NULL),
(425, 'sample_module::index', 52, NULL),
(426, 'share::__construct', 53, NULL),
(427, 'share::index', 53, NULL),
(428, 'share::update_settings', 53, NULL),
(429, 'share::get_settings', 53, NULL),
(430, 'share::render', 53, NULL),
(431, 'sitemap::__construct', 54, NULL),
(432, 'sitemap::index', 54, NULL),
(433, 'sitemap::_load_settings', 54, NULL),
(434, 'sitemap::update_settings', 54, NULL),
(435, 'sitemap::display_tpl', 54, NULL),
(436, 'sitemap::fetch_tpl', 54, NULL),
(437, 'sitemap::render', 54, NULL),
(438, 'social_servises::__construct', 55, NULL),
(439, 'social_servises::index', 55, NULL),
(440, 'social_servises::update_settings', 55, NULL),
(441, 'social_servises::get_fsettings', 55, NULL),
(442, 'social_servises::get_vsettings', 55, NULL),
(443, 'social_servises::_get_templates', 55, NULL),
(444, 'social_servises::render', 55, NULL),
(445, 'template_editor::index', 56, NULL),
(446, 'template_editor::render', 56, NULL),
(447, 'trash::__construct', 57, NULL),
(448, 'trash::index', 57, NULL),
(449, 'trash::create_trash', 57, NULL),
(450, 'trash::edit_trash', 57, NULL),
(451, 'trash::delete_trash', 57, NULL),
(452, 'user_manager::__construct', 58, NULL),
(453, 'user_manager::index', 58, NULL),
(454, 'user_manager::set_tpl_roles', 58, NULL),
(455, 'user_manager::getRolesTable', 58, NULL),
(456, 'user_manager::genre_user_table', 58, NULL),
(457, 'user_manager::auto_complit', 58, NULL),
(458, 'user_manager::create_user', 58, NULL),
(459, 'user_manager::actions', 58, NULL),
(460, 'user_manager::search', 58, NULL),
(461, 'user_manager::edit_user', 58, NULL),
(462, 'user_manager::update_user', 58, NULL),
(463, 'user_manager::groups_index', 58, NULL),
(464, 'user_manager::create', 58, NULL),
(465, 'user_manager::edit', 58, NULL),
(466, 'user_manager::save', 58, NULL),
(467, 'user_manager::delete', 58, NULL),
(468, 'user_manager::deleteAll', 58, NULL),
(469, 'user_manager::update_role_perms', 58, NULL),
(470, 'user_manager::show_edit_prems_tpl', 58, NULL),
(471, 'user_manager::get_permissions_table', 58, NULL),
(472, 'user_manager::get_group_names', 58, NULL),
(473, 'Widgets_manager::__construct', 59, NULL),
(474, 'Widgets_manager::index', 59, NULL),
(475, 'Widgets_manager::create', 59, NULL),
(476, 'Widgets_manager::create_tpl', 59, NULL),
(477, 'Widgets_manager::edit', 59, NULL),
(478, 'Widgets_manager::update_widget', 59, NULL),
(479, 'Widgets_manager::update_config', 59, NULL),
(480, 'Widgets_manager::delete', 59, NULL),
(481, 'Widgets_manager::get', 59, NULL),
(482, 'Widgets_manager::edit_html_widget', 59, NULL),
(483, 'Widgets_manager::edit_module_widget', 59, NULL),
(484, 'Widgets_manager::display_create_tpl', 59, NULL),
(485, 'ShopAdminProducts::get_images', 19, NULL),
(486, 'ShopAdminCategories::ajax_load_parent', 4, NULL),
(487, 'import_export::__construct', 60, NULL),
(488, 'import_export::index', 60, NULL),
(489, 'import_export::getImport', 60, NULL),
(490, 'import_export::getLangs', 60, NULL),
(491, 'import_export::getTpl', 60, NULL),
(492, 'import_export::getExport', 60, NULL),
(493, 'import_export::createFile', 60, NULL),
(494, 'import_export::downloadFile', 60, NULL),
(495, 'import_export::processErrors', 60, NULL),
(496, 'import_export::deleteArchive', 60, NULL),
(497, 'import_export::downloadZIP', 60, NULL),
(498, 'ShopAdminProducts::ajax_translit', 19, NULL),
(499, 'ShopAdminRbac::__construct', 22, NULL),
(500, 'Rbac::checkPermitions', 40, NULL),
(501, 'Rbac::groupEdit', 40, NULL),
(502, 'Rbac::groupList', 40, NULL),
(503, 'Rbac::roleCreate', 40, NULL),
(504, 'Rbac::groupCreate', 40, NULL),
(505, 'Rbac::groupDelete', 40, NULL),
(506, 'Rbac::translateRole', 40, NULL),
(507, 'Rbac::roleEdit', 40, NULL),
(508, 'Rbac::roleList', 40, NULL),
(509, 'Rbac::roleDelete', 40, NULL),
(510, 'Rbac::privilegeCreate', 40, NULL),
(511, 'Rbac::privilegeEdit', 40, NULL),
(512, 'Rbac::privilegeList', 40, NULL),
(513, 'Rbac::privilegeDelete', 40, NULL),
(514, 'Rbac::checkControlPanelAccess', 40, NULL),
(515, 'Rbac::deletePermition', 40, NULL),
(516, 'template_manager::__construct', 61, NULL),
(517, 'template_manager::index', 61, NULL),
(518, 'template_manager::installFullDemodata', 61, NULL),
(519, 'template_manager::registerJsVars', 61, NULL),
(520, 'template_manager::get_template_license', 61, NULL),
(521, 'template_manager::updateComponent', 61, NULL),
(522, 'template_manager::deleteTemplate', 61, NULL),
(523, 'template_manager::getRemoteTemplate', 61, NULL),
(524, 'banners::__construct', 62, NULL),
(525, 'banners::createGroup', 62, NULL),
(526, 'banners::delGroup', 62, NULL),
(527, 'banners::index', 62, NULL),
(528, 'banners::settings', 62, NULL),
(529, 'banners::chose_active', 62, NULL),
(530, 'banners::delete', 62, NULL),
(531, 'banners::create', 62, NULL),
(532, 'banners::edit', 62, NULL),
(533, 'banners::autosearch', 62, NULL),
(534, 'banners::save_positions', 62, NULL),
(535, 'mod_discount::__construct', 63, NULL),
(536, 'mod_discount::index', 63, NULL),
(537, 'mod_discount::create', 63, NULL),
(538, 'mod_discount::edit', 63, NULL),
(539, 'mod_discount::ajaxChangeActive', 63, NULL),
(540, 'mod_discount::ajaxDeleteDiscount', 63, NULL),
(541, 'mod_discount::generateDiscountKey', 63, NULL),
(542, 'mod_discount::autoCompliteUsers', 63, NULL),
(543, 'mod_discount::autoCompliteProducts', 63, NULL),
(544, 'mod_discount::saveQueryToSession', 63, NULL),
(545, 'cmsemail::__construct', 64, NULL),
(546, 'cmsemail::index', 64, NULL),
(547, 'cmsemail::create', 64, NULL),
(548, 'cmsemail::mailTest', 64, NULL),
(549, 'cmsemail::delete', 64, NULL),
(550, 'cmsemail::edit', 64, NULL),
(551, 'cmsemail::update_settings', 64, NULL),
(552, 'cmsemail::wraper_check', 64, NULL),
(553, 'cmsemail::deleteVariable', 64, NULL),
(554, 'cmsemail::updateVariable', 64, NULL),
(555, 'cmsemail::addVariable', 64, NULL),
(556, 'cmsemail::getTemplateVariables', 64, NULL),
(557, 'cmsemail::import_templates', 64, NULL),
(558, 'mod_seo::__construct', 65, NULL),
(559, 'mod_seo::index', 65, NULL),
(560, 'mod_seo::productsCategories', 65, NULL),
(561, 'mod_seo::productCategoryCreate', 65, NULL),
(562, 'mod_seo::productCategoryEdit', 65, NULL),
(563, 'mod_seo::categoryAutocomplete', 65, NULL),
(564, 'mod_seo::ajaxDeleteProductCategories', 65, NULL),
(565, 'mod_seo::ajaxChangeActiveCategory', 65, NULL),
(566, 'mod_seo::ajaxChangeEmptyMetaCategory', 65, NULL),
(567, 'exchange::__construct', 66, NULL),
(568, 'exchange::index', 66, NULL),
(569, 'exchange::update_settings', 66, NULL),
(570, 'exchange::startImagesResize', 66, NULL),
(571, 'exchange::setAdditionalCats', 66, NULL),
(572, 'exchange::clear', 66, NULL),
(573, 'exchange::log', 66, NULL),
(574, 'translator::__construct', 67, NULL),
(575, 'translator::setSettings', 67, NULL),
(576, 'translator::settings', 67, NULL),
(577, 'translator::index', 67, NULL),
(578, 'translator::search', 67, NULL),
(579, 'translator::parse', 67, NULL),
(580, 'translator::updateJsLangsFile', 67, NULL),
(581, 'translator::update', 67, NULL),
(582, 'translator::makeCorrectPoPaths', 67, NULL),
(583, 'translator::exchangeTranslation', 67, NULL),
(584, 'translator::renderModulePoFile', 67, NULL),
(585, 'translator::createFile', 67, NULL),
(586, 'translator::savePoArray', 67, NULL),
(587, 'translator::canselTranslation', 67, NULL),
(588, 'translator::getExistingLocales', 67, NULL),
(589, 'translator::renderModulesNames', 67, NULL),
(590, 'translator::renderTemplatesNames', 67, NULL),
(591, 'translator::translateWord', 67, NULL),
(592, 'translator::translate', 67, NULL),
(593, 'translator::getLangaugesNames', 67, NULL),
(594, 'translator::getLanguageByLocale', 67, NULL),
(595, 'translator::renderFile', 67, NULL),
(596, 'translator::saveEditingFile', 67, NULL),
(597, 'translator::getMainFilePaths', 67, NULL),
(598, 'translator::updateOne', 67, NULL),
(599, 'imagebox::__construct', 68, NULL),
(600, 'imagebox::index', 68, NULL),
(601, 'imagebox::main', 68, NULL),
(602, 'imagebox::upload', 68, NULL),
(603, 'imagebox::get_image_size', 68, NULL),
(604, 'imagebox::get_settings', 68, NULL),
(605, 'imagebox::save_settings', 68, NULL),
(606, 'star_rating::index', 69, NULL),
(607, 'star_rating::__construct', 69, NULL),
(608, 'star_rating::update_settings', 69, NULL),
(609, 'star_rating::render', 69, NULL),
(610, 'mobile::__construct', 70, NULL),
(611, 'mobile::get_settings', 70, NULL),
(612, 'mobile::index', 70, NULL),
(613, 'mobile::update', 70, NULL),
(614, 'mobile::_getMobileTemplatesList', 70, NULL),
(615, 'mod_stats::__construct', 71, NULL),
(616, 'mod_stats::index', 71, NULL),
(617, 'mod_stats::orders', 71, NULL),
(618, 'mod_stats::users', 71, NULL),
(619, 'mod_stats::products', 71, NULL),
(620, 'mod_stats::categories', 71, NULL),
(621, 'mod_stats::search', 71, NULL),
(622, 'mod_stats::adminAdd', 71, NULL),
(623, 'mod_stats::attendance_redirect', 71, NULL),
(624, 'mod_stats::runControllerAction', 71, NULL),
(625, 'mod_stats::import', 71, NULL),
(626, 'mod_stats::set_input', 71, NULL),
(627, 'wishlist::__construct', 72, NULL),
(628, 'wishlist::index', 72, NULL),
(629, 'wishlist::update_settings', 72, NULL),
(630, 'wishlist::settings', 72, NULL),
(631, 'wishlist::userWL', 72, NULL),
(632, 'wishlist::editWL', 72, NULL),
(633, 'wishlist::deleteWL', 72, NULL),
(634, 'wishlist::updateWL', 72, NULL),
(635, 'wishlist::userUpdate', 72, NULL),
(636, 'wishlist::createWishList', 72, NULL),
(637, 'wishlist::do_upload', 72, NULL),
(638, 'wishlist::renderPopup', 72, NULL),
(639, 'wishlist::deleteItem', 72, NULL),
(640, 'wishlist::moveItem', 72, NULL),
(641, 'wishlist::deleteImage', 72, NULL),
(642, 'wishlist::delete_user', 72, NULL),
(643, 'Sys_update::__construct', 73, NULL),
(644, 'Sys_update::index', 73, NULL),
(645, 'Sys_update::do_update', 73, NULL),
(646, 'Sys_update::update', 73, NULL),
(647, 'Sys_update::restore', 73, NULL),
(648, 'Sys_update::renderFile', 73, NULL),
(649, 'Sys_update::properties', 73, NULL),
(650, 'Sys_update::get_license', 73, NULL),
(651, 'Sys_update::backup', 73, NULL),
(652, 'Sys_update::sort', 73, NULL),
(653, 'Sys_update::delete_backup', 73, NULL),
(654, 'Sys_update::getQuerys', 73, NULL),
(655, 'Sys_update::Querys', 73, NULL),
(656, 'Sys_info::__construct', 74, NULL),
(657, 'Sys_info::index', 74, NULL),
(658, 'Sys_info::phpinfo', 74, NULL),
(659, 'Sys_info::mailTest', 74, NULL),
(660, 'ymarket::__construct', 75, NULL),
(661, 'ymarket::index', 75, NULL),
(662, 'ymarket::getSelectedCats', 75, NULL),
(663, 'ymarket::save', 75, NULL),
(664, 'module_frame::__construct', 76, NULL),
(665, 'module_frame::index', 76, NULL),
(666, 'hotline::index', 77, NULL),
(667, 'hotline::__construct', 77, NULL),
(668, 'hotline::update', 77, NULL),
(669, 'hotline::getSelectedCats', 77, NULL),
(670, 'hotline::getProperties', 77, NULL),
(671, 'hotline::setProperties', 77, NULL),
(672, 'cmsemail::settings', 64, NULL),
(673, 'mod_seo::save', 65, NULL),
(674, 'sitemap::priority_validation', 54, NULL),
(675, 'sitemap::settings', 54, NULL),
(676, 'sitemap::saveSiteMap', 54, NULL),
(677, 'sitemap::sitemapDownload', 54, NULL),
(678, 'sitemap::priorities', 54, NULL),
(679, 'sitemap::changefreq', 54, NULL),
(680, 'sitemap::blockedUrls', 54, NULL),
(681, 'sitemap::prepareUrls', 54, NULL),
(682, 'sitemap::robotsAdd', 54, NULL),
(683, 'sitemap::_viewSiteMap', 54, NULL),
(684, 'sample_module::updateSettings', 52, NULL),
(685, 'trash::create_trash_list', 57, NULL),
(686, 'ShopAdminOrders::ajaxGetProductVariants', 16, NULL),
(687, 'ShopAdminOrders::getImageName', 16, NULL),
(688, 'ShopAdminOrders::paginationVariant', 16, NULL),
(689, 'ShopAdminOrders::recountUserAmount', 16, NULL),
(690, 'ShopAdminOrders::recount_amount', 16, NULL),
(691, 'ShopAdminOrders::ajaxGetProductsList', 16, NULL),
(692, 'ShopAdminOrders::ajaxEditOrderCartNew', 16, NULL),
(693, 'ShopAdminOrders::recoutUserOrdersAmount', 16, NULL),
(694, 'ShopAdminOrders::getTotalRow', 16, NULL),
(695, 'ShopAdminOrders::ajaxGetProductsInCategory', 16, NULL),
(696, 'ShopAdminOrders::autoComplite', 16, NULL),
(697, 'ShopAdminOrders::createNewUser', 16, NULL),
(698, 'ShopAdminOrders::ajaxGetUserDiscount', 16, NULL),
(699, 'ShopAdminOrders::getPaymentsMethods', 16, NULL),
(700, 'ShopAdminOrders::checkGiftCert', 16, NULL),
(701, 'ShopAdminOrders::createCode', 16, NULL),
(702, 'ShopAdminOrders::getLastUserInfo', 16, NULL),
(703, 'ShopAdminOrders::createProducsInfoTable', 16, NULL),
(704, 'ShopAdminProducts::fastProdCreate', 19, NULL),
(705, 'ShopAdminCategories::createCatFast', 4, NULL),
(706, 'ShopAdminProperties::createPropFast', 21, NULL),
(707, 'trash::trash_list', 57, NULL),
(708, 'admin_menu::__construct', 78, NULL),
(709, 'admin_menu::index', 78, NULL),
(710, 'admin_menu::edit_menus', 78, NULL),
(711, 'admin_menu::edit_tariff_menus', 78, NULL),
(712, 'admin_menu::saveMenu', 78, NULL),
(713, 'admin_menu::saveTariffsMenus', 78, NULL),
(714, 'admin_menu::uploadTariffsMenus', 78, NULL),
(715, 'admin_menu::ajaxUpdateItemTitle', 78, NULL),
(716, 'admin_menu::ajaxGetNewMenuItem', 78, NULL),
(717, 'ShopAdminSystem::downExpUsers', 25, NULL),
(718, 'Settings::getSiteInfoDataJson', 41, NULL),
(719, 'ShopAdminSettings::changeSortActive', 24, NULL),
(720, 'ShopAdminSettings::checkGDLib', 24, NULL),
(721, 'ShopAdminSettings::runResizeById', 24, NULL),
(722, 'ShopAdminSettings::getAllProductsVariantsIds', 24, NULL),
(723, 'ShopAdminSettings::getAllProductsIds', 24, NULL),
(724, 'ShopAdminSettings::runResizeAllAdditionalJsone', 24, NULL),
(725, 'Widgets_manager::update_html_widget', 59, NULL),
(726, 'ShopAdminSystem::getCategoryProperties', 25, NULL),
(727, 'Backup::file_actions', 31, NULL),
(728, 'Backup::save_settings', 31, NULL),
(729, 'ShopAdminSettings::runResizeAllJsone', 24, NULL),
(730, 'ShopAdminSearch::per_page_cookie', 23, NULL),
(731, 'ShopAdminSettings::setSorting', 24, NULL),
(732 , 'ShopAdminProducts::fastBrandCreate', 19, NULL),
(733 , 'ShopAdminProducts::fastCategoryCreate', 19, NULL),
(735, 'Xbanners::__constructor', 79, NULL),
(736, 'Xbanners::index', 79, NULL),
(737, 'Xbanners::deleteA', 79, NULL),
(738, 'Xbanners::edit_banner', 79, NULL),
(739, 'Xbanners::saveImage', 79, NULL),
(740, 'Xbanners::validate_url', 79, NULL),
(741, 'Xbanners::uploadImage', 79, NULL),
(742, 'Xbanners::deleteSlideImage', 79, NULL),
(743, 'Xbanners::deleteSlide', 79, NULL),
(744, 'Xbanners::changePositions', 79, NULL),
(745, 'Xbanners::url_search_autocomplete', 79, NULL),
(746, 'Xbanners::updateBannersPlaces', 79, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_privileges_i18n`
--

DROP TABLE IF EXISTS `shop_rbac_privileges_i18n`;
CREATE TABLE IF NOT EXISTS `shop_rbac_privileges_i18n` (
  `id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `locale` varchar(45) NOT NULL,
  KEY `id_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_rbac_privileges_i18n`
--

INSERT INTO `shop_rbac_privileges_i18n` (`id`, `title`, `description`, `locale`) VALUES
(473, 'Управление виджетами', 'Доступ к управлению виджетами', 'ru'),
(1, 'Список баннеров', 'Доступ к списку баннеров', 'ru'),
(2, 'Создание баннера', 'Доступ к созданию баннера', 'ru'),
(3, 'Редактирование баннера', 'Доступ к редактированию баннера', 'ru'),
(4, 'Удаление баннера', 'Доступ к удалению баннера', 'ru'),
(5, 'Перевод баннера', 'Доступ к переводу баннера', 'ru'),
(6, 'Активность баннера', 'Управление активностью баннера', 'ru'),
(7, 'Список брендов', 'Доступ к списку брендов', 'ru'),
(8, 'Создание бренда', 'Доступ к созданию бренда', 'ru'),
(9, 'Редактирование бренда', 'Доступ к редактированию бренда', 'ru'),
(10, 'Удаление бренда', 'Доступ к удалению бренда', 'ru'),
(11, 'Список брендов', 'Доступ к списку брендов', 'ru'),
(12, 'Перевод бренда', 'Доступ к переводу бренда', 'ru'),
(13, 'Список колбеков', 'Доступ к просмотру колбеков', 'ru'),
(14, 'Редактирование колбека', 'Доступ к редактированию колбеков', 'ru'),
(15, 'Статусы колбеков', 'Просмотр статусов колбеков', 'ru'),
(16, 'Создание статуса колбеков', 'Доступ к созданию статусов колбеков', 'ru'),
(17, 'Редактирование статуса колбека', 'Доступ к редактированию статуса колбека', 'ru'),
(18, 'Установка статуса колбека по-умолчанию', 'Доступ к установке статуса колбека по-умолчанию', 'ru'),
(19, 'Изменение статуса колбека', 'Доступ к изменению статуса колбека', 'ru'),
(20, 'Смена порядка статусов колбеков', 'Доступ к изменению порядка статусов колбеков', 'ru'),
(21, 'Изменение темы колбека', 'Доступ к изменению статуса колбека', 'ru'),
(22, 'Удаление колбека', 'Доступ к удалению колбека', 'ru'),
(23, 'Удаление статуса', 'Доступ к удалению статуса колбека', 'ru'),
(24, 'Просмотр тем колбеков', 'Доступ к просмотру тем колбеков', 'ru'),
(25, 'Создание тем колбеков', 'Доступ к созданию тем колбеков', 'ru'),
(26, 'Редактирование темы колбека', 'Доступ к редактированию темы колбека', 'ru'),
(27, 'Удаление темы колбека', 'Доступ к удалению темы колбека', 'ru'),
(28, 'Поиск колбеков', 'Доступ к поиску колбеков', 'ru'),
(29, 'Просмотр категорий магазина', 'Доступ к просмотру категорий магазина', 'ru'),
(30, 'Создание категории магазина', 'Доступ к созданию категории магазина', 'ru'),
(31, 'Редактирование категории магазина', 'Доступ к редактированию категории магазина', 'ru'),
(32, 'Удаление категории магазина', 'Доступ к удалению категории магазина', 'ru'),
(33, 'Просмотр списка категорий магазина', 'Доступ к просмотру списка категорий магазина', 'ru'),
(34, 'Изменение порядка категорий магазина', 'Доступ к изменению порядка категорий магазина', 'ru'),
(35, 'Транслитерация строки', 'Доступ к транслитерации строки', 'ru'),
(36, 'Перевод категории магазина', 'Доступ к переводу категории магазина', 'ru'),
(37, 'Смена активности категории магазина', 'Доступ к изменению активности категории магазина', 'ru'),
(38, 'Создание шаблона категории', 'Доступ к созданию шаблона категории магазина', 'ru'),
(39, 'Список доступных шаблонов для категорий магаз', 'Доступ к списку доступных шаблонов для категорий магазина', 'ru'),
(40, 'Просмотр статистики заказов', 'Доступ к просмотру статистики заказов', 'ru'),
(41, 'Фильтр заказов по дате', 'Доступ к фильтру заказов по дате', 'ru'),
(42, 'ShopAdminCharts::_createDatesDropDown', '', 'ru'),
(43, 'Просмотр списка накопительных скидок', 'Доступ к просмотру списка накопительных скидок', 'ru'),
(44, 'Создание накопительной скидки', 'Доступ к созданию накопительной скидки', 'ru'),
(45, 'Редактирование накопительной скидки', 'Доступ к редактированию накопительной скидки', 'ru'),
(46, 'Просмотр списка пользовательских скидок', 'Доступ к просмотру списка пользовательских скидок', 'ru'),
(47, 'Просмотр скидки пользователя', 'Доступ к просмотру скидки пользователя', 'ru'),
(48, 'Удаление всех скидок', 'Доступ к удалению всех скидок', 'ru'),
(49, 'Смена статуса скидки', 'Доступ к смене статуса скидки', 'ru'),
(50, 'Просмотр списка валют', 'Доступ к просмотру списка валют', 'ru'),
(51, 'Создание валюты', 'Доступ к созданию валюты', 'ru'),
(52, 'Редактирование валюты', 'Доступ к редактированию валюты', 'ru'),
(53, 'Установка валюты по-умолчанию', 'Доступ к установке валюты по-умолчанию', 'ru'),
(54, 'Установка главной валюты', 'Доступ к установке главной валюты', 'ru'),
(55, 'Удаление валюты', 'Доступ к удалению валюты', 'ru'),
(56, 'Пересчет цен', 'Доступ к пересчету цен', 'ru'),
(57, 'Проверка цен в базе данных', 'Доступ к проверке цен в базе данных и их исправление', 'ru'),
(58, 'Просмотр списка дополнительных полей для мага', 'Доступ к просмотру списка дополнительных полей магазина', 'ru'),
(59, 'Создание дополнительного поля для магазина', 'Доступ к созданию дополнительного поля для магазина', 'ru'),
(60, 'Редактирование дополнительного поля для магаз', 'Доступ к редактированию дополнительного поля для магазина', 'ru'),
(61, 'Удаление всех дополнительных полей для магази', 'Доступ к удалению всех дополнительных полей для магазина', 'ru'),
(62, 'Смена активности дополнительного поля для маг', 'Доступ к смене активности дополнительного поля для магазина', 'ru'),
(63, 'Смена приватности дополнительного полю', 'Доступ к изменению приватности дополнительного поля', 'ru'),
(64, 'Смена необходимости дополнительного поля для ', 'Доступ к изменению необходимости дополнительного поля для магазина', 'ru'),
(65, 'Просмотр дашборда админ панели магазина', 'Доступ к просмотру дашборда админ панели магазина', 'ru'),
(66, 'Просмотр списка способов доставки', 'Доступ к просмотру списка способов доставки', 'ru'),
(67, 'Создание способа доставки', 'Доступ к созданию способа доставки', 'ru'),
(68, 'Смена статуса способа доставки', 'Доступ к смене статуса способа доставки', 'ru'),
(69, 'Редактирование способа доставки', 'Доступ к редактированию способа доставки', 'ru'),
(70, 'Удаление способа доставки', 'Доступ к удалению способа доставки', 'ru'),
(71, 'ShopAdminDeliverymethods::c_list', '', 'ru'),
(72, 'Просмотр списка постоянных скидок', 'Доступ к просмотру списка постоянных скидок', 'ru'),
(73, 'Создание постоянной скидки', 'Доступ к созданию постоянной скидки', 'ru'),
(74, 'Смена статуса постоянной скидки', 'Доступ к смене статуса постоянной скидки', 'ru'),
(75, 'Редактирование постоянной скидки', 'Доступ к редактированию постоянной скидки', 'ru'),
(76, 'Удаление постоянной скидки', 'Доступ к удалению постоянной скидки', 'ru'),
(77, 'Просмотр списка подарочных сертификатов', 'Доступ к просмотру списка подарочных сертификатов', 'ru'),
(78, 'Создание подарочного сертификата', 'Доступ к созданию подарочного сертификата', 'ru'),
(79, 'Создание кода для подарочного сертификата', 'Доступ к соданию кода для подарочного сертификата', 'ru'),
(80, 'Удаление подарочного сертификата', 'Доступ к удалению подарочного сертификата', 'ru'),
(81, 'Редактирование подарочного сертификата', 'Доступ к редактированию подарочного сертификата', 'ru'),
(82, 'Смена активности подарочного сертификата', 'Доступ к смене активности подарочного сертификата', 'ru'),
(83, 'Настройки подарочных сертификатов', 'Доступ к настройкам подарочных сертификатов', 'ru'),
(84, 'Сохранение настроек подарочных сертификатов', 'Доступ к сохранению настроек подарочных сертификатов', 'ru'),
(85, 'Просмотр списка наборов товаров', 'Доступ к просмотру списка наборов товаров', 'ru'),
(86, 'Создание набора товаров', 'Доступ к созданию набора товаров', 'ru'),
(87, 'Редактирование набора товаров', 'Доступ к редактированию набора товаров', 'ru'),
(88, 'Смена порядка наборов товаров', 'Доступ к смене порядка наборо товаров', 'ru'),
(89, 'Смена активности набора товаров', 'Доступ к смене активности набора товаров', 'ru'),
(90, 'ShopAdminKits::kit_list', '', 'ru'),
(91, 'Удаление набора товаров', 'Доступ к удалению набора товаров', 'ru'),
(92, 'Получение списка товаров', 'Доступ к получению списка товаров', 'ru'),
(93, 'Просмотр списка уведовлений', 'Доступ к просмотру списка уведомлений', 'ru'),
(94, 'Редактирование уведомления', 'Доступ к редактированию уведомления', 'ru'),
(95, 'Смена статуса уведомления', 'Доступ к смене статуса уведомления', 'ru'),
(96, 'Уведомление по почте', 'Доступ к уведомлению по почте', 'ru'),
(97, 'Удаление уведомления', 'Доступ к удалению уведомления', 'ru'),
(98, 'Удаление уведомления', 'Доступ к удалению уведомления', 'ru'),
(99, 'Смена статуса уведомления', 'Доступ к смене статуса уведомления', 'ru'),
(100, 'Поиск уведомления', 'Доступ к поиску уведомления', 'ru'),
(101, 'Поиск новых событий', 'Доступ к поиску новых событий', 'ru'),
(102, 'Просмотр статусов уведомлений', 'Доступ к просмотру статусов уведомлений', 'ru'),
(103, 'Создание статуса уведомления', 'Доступ к созданию статуса уведомления', 'ru'),
(104, 'Редактирование статуса уведомления', 'Доступ к редактированию статуса увдеомления', 'ru'),
(105, 'Удаление статуса уведомления', 'Доступ к удалению статуса уведомления', 'ru'),
(106, 'Смена порядка статусов уведомлений', 'Доступ к смене порядка статусов уведомлений', 'ru'),
(107, 'Просмотр списка заказов', 'Доступ к просмотру списка заказов', 'ru'),
(108, 'Редактирование заказа', 'Доступ к редактированию заказа', 'ru'),
(109, 'Смена статуса заказа', 'Доступ к смене статуса заказа', 'ru'),
(110, 'Смена статуса оплаты заказа', 'Доступ к смене  статуса оплаты заказа', 'ru'),
(111, 'Удаление заказа', 'Доступ к удалению статуса заказа', 'ru'),
(112, 'Удаление статуса заказа', 'Доступ к удалению статуса заказа', 'ru'),
(113, 'Смена статусов заказов', 'Доступ к смене статусов заказов', 'ru'),
(114, 'Смена статуса оплаты заказов', 'Доступ к смене статусов оплаты заказов', 'ru'),
(115, 'Отображение окна редактирования', 'Доступ к окну редактирования', 'ru'),
(116, 'Окно редактирования набора товаров', 'Доступ к окну редактирования набора товаров', 'ru'),
(117, 'Окно добавления товара к заказу', 'Доступ к окну добавления товаров к заказу', 'ru'),
(118, 'Удаление товара из заказа', 'Доступ к удалению товара из заказа', 'ru'),
(119, 'Получение списка товаров', 'Доступ к получению списка товаров', 'ru'),
(120, 'Редактирование товара в заказе', 'Доступ к редактированию товара в заказе', 'ru'),
(121, 'Добавление товара к заказу', 'Доступ к добавлению товара к заказу', 'ru'),
(122, 'Получение списка товаров в заказе', 'Доступ к получению списка товаров в заказе', 'ru'),
(123, 'Поиск заказа', 'Доступ к поиску заказа', 'ru'),
(124, 'Создание чеков', 'Доступ созданию чека', 'ru'),
(125, 'Создание pdf чека', 'Доступ созданию pdf чека', 'ru'),
(126, 'Создание чека', 'Доступ к созданию чека', 'ru'),
(127, 'Создание заказа', 'Доступ к созданию заказа', 'ru'),
(128, 'Просмотр списка статусов заказов', 'Доступ к просмотру списка статусов заказов', 'ru'),
(129, 'Создание статуса заказа', 'Доступ к созданию статуса заказа', 'ru'),
(130, 'Редактирование статуса заказа', 'Доступ к редактированию статуса заказа', 'ru'),
(131, 'Удаление статуса заказа', 'Доступ к удалению статуса заказа', 'ru'),
(132, 'Отображение окна удаления', 'Доступ к отображению окна удаления', 'ru'),
(133, 'Смена порядка статусов заказов', 'Доступ к смене порядка статусов заказов', 'ru'),
(134, 'Просмотр списка методов оплаты', 'Доступ к просмотру списка методов оплаты', 'ru'),
(135, 'Создание метода оплаты', 'Доступ к созданию метода оплаты', 'ru'),
(136, 'Смена статуса способа оплаты', 'Доступ к смене статуса способа оплаты', 'ru'),
(137, 'Редактирование способа оплаты', 'Доступ к редактированию способа оплаты', 'ru'),
(138, 'Удаление способа оплаты', 'Доступ к удалению способа оплаты', 'ru'),
(139, 'Смена порядка способов оплаты', 'Доступ к смене порядка способов оплаты', 'ru'),
(140, 'Отображение настроек способа оплаты', 'Доступ к отображению настроек способа оплаты', 'ru'),
(141, 'ShopAdminProducts::index', '', 'ru'),
(142, 'Создание продукта', 'Доступ к созданию продукта', 'ru'),
(143, 'Редактирование товара', 'Доступ к редактированию товара', 'ru'),
(144, 'Сохранение дополнительных изображений', 'Доступ к сохренению дополнительных изображений', 'ru'),
(145, 'Удаление товара', 'Доступ к удалению товара', 'ru'),
(146, 'Обработка изображений', 'Доступ к обработке изображений', 'ru'),
(147, 'Удаление дополнительных изображений', 'Доступ к удалению дополнительных изображений', 'ru'),
(148, 'Смена активности товара', 'Доступ к смене активности товара', 'ru'),
(149, 'Смена пункта "Хит" для товара', 'Доступ к смене пункта "Хит" для товара', 'ru'),
(150, 'Смена пункта "Новинка" для товара', 'Доступ к смене пункта "Новинка" для товара', 'ru'),
(151, 'Смена пункта "Акция" для товара', 'Доступ к смене пункта "Акция" для товара', 'ru'),
(152, 'Обновление цены', 'Доступ к обновлению цены товара', 'ru'),
(153, 'Копирование товаров', 'Доступ к копированию товаров', 'ru'),
(154, 'Удаление товаров', 'Доступ к удалению товаров', 'ru'),
(155, 'Просмотр окна перемещения товаров', 'Доступ к окну перемещения товаров', 'ru'),
(156, 'Перемещение товаров', 'Доступ к перемещению товаров', 'ru'),
(157, 'Перевод товара', 'Доступ к переводу товара', 'ru'),
(158, 'Получение списка id товаров', 'Доступ к получению списка id товаров', 'ru'),
(159, 'Переключение товаров', 'Доступ к переключению товаров', 'ru'),
(160, 'Просмотр списка слежения', 'Доступ к просмотру списка слежения', 'ru'),
(161, 'Удаления слежения', 'Доступ к удалению слежения', 'ru'),
(162, 'Настройки слежения за товарами', 'Доступ к настройкам слежения за товаром', 'ru'),
(163, 'Просмотр списка свойств', 'Доступ к просмотру списка свойств', 'ru'),
(164, 'Создание свойства товара', 'Доступ к созданию свойства товара', 'ru'),
(165, 'Редактирование свойства товара', 'Доступ к редактированию свойства товара', 'ru'),
(166, 'ShopAdminProperties::renderForm', '', 'ru'),
(167, 'Смена порядка свойств', 'Доступ к смене порядка свойств', 'ru'),
(168, 'Удаление свойств', 'Доступ к удалению свойств', 'ru'),
(169, 'Смена активности свойства', 'Доступ к смене активности свойства', 'ru'),
(180, 'ShopAdminRbac::group_create', '', 'ru'),
(181, 'ShopAdminRbac::group_edit', '', 'ru'),
(182, 'ShopAdminRbac::group_list', '', 'ru'),
(183, 'ShopAdminRbac::group_delete', '', 'ru'),
(184, 'Просмотр списка товаров', 'Доступ к просмотру списка товаров', 'ru'),
(185, 'Смена порядка вариантов товаров', 'Доступ к смене порядка вариантов товаров', 'ru'),
(186, 'Автодополнение к поиску', 'Доступ к автодополнению к поиску', 'ru'),
(187, 'Продвинутый поиск', 'Доступ к продвинутому поиску', 'ru'),
(188, 'ShopAdminSearch::renderCustomFields', '', 'ru'),
(189, 'Свойства магазина', 'Доступ к свойствам магазина', 'ru'),
(190, 'Изменение свойств магазина', 'Доступ к изменению свойств магазина', 'ru'),
(191, 'Получение настроек для интеграции с фейсбуком', 'Доступ к настройкам интеграции с фейсбуком', 'ru'),
(192, 'Получение настроек интеграции с вк', 'Доступ к настройкам интеграции с вк', 'ru'),
(193, 'Получение списка шаблонов', 'Доступ к получению списка шаблонов', 'ru'),
(194, 'Загрузка настроек', 'Доступ к загрузке настроек', 'ru'),
(195, 'Запуск ресайза изображений', 'Доступ к запуску ресайза изображений', 'ru'),
(196, 'Импорт товаров', 'Доступ к импорту товаров', 'ru'),
(197, 'Экспорт товаров', 'Доступ к экспорту товаров', 'ru'),
(198, 'Получение атрибутов', 'Доступ к получению атрибутов', 'ru'),
(199, 'Экспорт пользователей', 'Доступ к экспорту пользователей', 'ru'),
(200, 'Просмотр списка пользователей', 'Доступ к просмотру списка пользователей', 'ru'),
(201, 'Поиск пользователей', 'Доступ к поиску пользователей', 'ru'),
(202, 'Создание пользователя', 'Доступ к созданию пользователя', 'ru'),
(203, 'Редактирование пользователя', 'Доступ к редактированию пользователя', 'ru'),
(204, 'Удаление пользователя', 'Доступ к удалению пользователя', 'ru'),
(205, 'Автодополнение списка пользователей', 'Достпу к автодополнению списка пользователей', 'ru'),
(206, 'Просмотр списка складов', 'Доступ к просмотру списка складов', 'ru'),
(207, 'Создание склада', 'Доступ к созданию склада', 'ru'),
(208, 'Редактирование склада', 'Доступ к редактированию склада', 'ru'),
(209, 'Удаление склада', 'Доступ к удалению склада', 'ru'),
(210, 'Доступ к админпанели', 'Доступ к админпанели', 'ru'),
(211, 'Инициализация настроек', 'Доступ к инициализации настроек', 'ru'),
(212, 'Просмотр дашборда базовой админки', 'Доступ к просмотру дашборда базовой админки', 'ru'),
(213, 'Просмотр информации о системе', 'Доступ к просмотру информации о системе', 'ru'),
(214, 'Очистка кеша', 'Доступ к очистке кеша', 'ru'),
(215, 'Инициализация elfinder', 'Доступ к инициализации elfinder', 'ru'),
(216, 'Получение защитного токена', 'Доступ к получению токена', 'ru'),
(217, 'Admin::sidebar_cats', '', 'ru'),
(218, 'Выход с админки', 'Доступ к выходу с админки', 'ru'),
(219, 'Сообщить о ошибке', 'Доступ к сообщению о ошибке', 'ru'),
(220, 'История событий', 'Доступ к истории событий', 'ru'),
(221, 'Просмотр истории событий', 'Доступ к просмотру истории событий', 'ru'),
(222, 'Поиск в базовой версии', 'Доступ к поиску в базовой версии', 'ru'),
(223, 'Admin_search::index', '', 'ru'),
(224, 'Продвинутый поиск в базовой версии', 'Доступ к продвинутому поиску в базовой версии', 'ru'),
(225, 'Произвести поиск в базовой версии', 'Произвести поиск в базовой версии', 'ru'),
(226, 'Валидация поиска в базовой версии', 'Доступ к валидации поиска в базовой версии', 'ru'),
(227, 'Admin_search::form_from_group', '', 'ru'),
(228, 'Фильтрация страниц', 'Доступ к фильтрации страниц', 'ru'),
(229, 'Автодополнение поиска', 'Доступ к автодополнению поиска', 'ru'),
(230, 'Управление бекапами', 'Доступ к управлению бекапами', 'ru'),
(231, 'Подготовка резервного копирования', 'Доступ к подготовке резервного копирования', 'ru'),
(232, 'Создание бекапа', 'Доступ к созданию бекапа', 'ru'),
(233, 'Закачка резервной копии', 'Доступ к созданию резервной копии', 'ru'),
(234, 'Управление кешем', 'Достпу к управлению кешем', 'ru'),
(235, 'Управление кешем', 'Доступ к управлению кешем', 'ru'),
(236, 'Управление категориями сайта', 'Доступ к управлению категориями сайта', 'ru'),
(237, 'Просмотр списка категорий сайта', 'Доступ к просмотру списка категорий сайта', 'ru'),
(238, 'Отображение формы создания категории', 'Доступ к отображению формы создания категории', 'ru'),
(239, 'Обноление категории', 'Доступ к обновлению категорий', 'ru'),
(240, 'Смена порядка категорий сайта', 'Доступ к смене порядка категорий сайта', 'ru'),
(241, 'Просмотр списка категорий сайта', 'Доступ к просмотру списка категорий сайта', 'ru'),
(242, 'Подкатегории', 'Доступ к подкатегориям', 'ru'),
(243, 'Создание категории сайта', 'Доступ к категории сайта', 'ru'),
(244, 'Обновление урлов', 'Доступ к обновлению урлов', 'ru'),
(245, 'Проверка сушествования категории сайта', 'Доступ к проверке сушествования категории сайта', 'ru'),
(246, 'Быстрое добавление категории', 'Доступ к быстрому добавлению категории', 'ru'),
(247, 'Быстрое обновление блока', 'Доступ к быстрому обновлению блока', 'ru'),
(248, 'Редактирование категорий сайта', 'Доступ к редактированию категории сайта', 'ru'),
(249, 'Перевод категории сайта', 'Доступ к переводу категории сайта', 'ru'),
(250, 'Удаление категории сайта', 'Доступ к удалению категории сайта', 'ru'),
(251, 'Получение подкатегорий', 'Доступ к получению подкатегорий', 'ru'),
(252, 'Получение статуса комментариев', 'Доступ к получению статусув комментариев', 'ru'),
(253, 'Доступ к компонентам', 'Доступ к компонентам', 'ru'),
(254, 'Управление компонентами системы', 'Доступ к управлению компонентами системы', 'ru'),
(255, 'Просмотр списка компонентов сайта', 'Доступ к просмотру списка компонентов сайта', 'ru'),
(256, 'Проверка установки компонента', 'Доступ к проверке установки компонента', 'ru'),
(257, 'Установка модуля', 'Доступ к установке модуля', 'ru'),
(258, 'Удаление модуля', 'Доступ к удалению модуля', 'ru'),
(259, 'Поиск компонентов', 'Доступ к поиску компонентов', 'ru'),
(260, 'Настройки модуля', 'Доступ к настройкам модуля', 'ru'),
(261, 'Сохранение настроек модулей', 'Доступ к сохранению настроек модулей', 'ru'),
(262, 'Переход к админчасти модуля', 'Доступ к админчасти модуля', 'ru'),
(263, 'Запук модулей', 'Доступ к запуску модулей', 'ru'),
(264, 'Запук методов модулей', 'Доступ к запуску методов модулей', 'ru'),
(265, 'Получение информации о компонентах', 'Доступ к получению информации о компонентах', 'ru'),
(266, 'Получение информации о модуле', 'Доступ к получению информации о модуле', 'ru'),
(267, 'Смена статуса автозагрузки модуля', 'Доступ к смене статуса автозагрузки модуля', 'ru'),
(268, 'Смена доступа по url к модулю', 'Смена доступа по url к модулю', 'ru'),
(269, 'Смена порядка компонентов в списке', 'Доступ к смене порядка компонентов в списке', 'ru'),
(270, 'Включение\\отключение отображения модуля в мен', 'Доступ к включению\\отключению отображения модуля в меню', 'ru'),
(271, 'Отображение дашборда админки', 'Доступ к отображению дашборда админки', 'ru'),
(272, 'Отображение дашборда админки', 'Доступ к отображению дашборда админки', 'ru'),
(273, 'Управление языками', 'Доступ к управлению языками', 'ru'),
(274, 'Просмотр списка языков', 'Достпу к просмотру списка языков', 'ru'),
(275, 'Отображение формы создания языка', 'Доступ к отображению формы создания языка', 'ru'),
(276, 'Создание языка', 'Доступ к созданию языка', 'ru'),
(277, 'Редактирование языка', 'Доступ к редактированию языка', 'ru'),
(278, 'Обновление языка', 'Доступ к обновлению языка', 'ru'),
(279, 'Удаление языка', 'Доступ к удалению языка', 'ru'),
(280, 'Установка языка по-умолчанию', 'Доступ к установке языка по-умолчанию', 'ru'),
(281, 'Вход в админ панель', 'Доступ к входу в админ панель', 'ru'),
(282, 'Вход в админ панель', 'Доступ к входу в админ панель', 'ru'),
(283, 'Проверка браузера пользователя', 'Доступ к проверке браузера пользователя', 'ru'),
(284, 'Вход', 'Вход', 'ru'),
(285, 'Восстановление пароля', 'Восстановление пароля', 'ru'),
(286, 'Обновление капчи', 'Доступ к обновлению капчи', 'ru'),
(287, 'Проверка капчи', 'Доступ к проверке капчи', 'ru'),
(288, 'Mod_search::__construct', '', 'ru'),
(289, 'Mod_search::index', '', 'ru'),
(290, 'Mod_search::category', '', 'ru'),
(291, 'Mod_search::display_install_window', '', 'ru'),
(292, 'Mod_search::connect_ftp', '', 'ru'),
(293, 'Управление страницами', 'Доступ к управлению страницами', 'ru'),
(294, 'Просмотр списка страниц', 'Доступ к просмотру списка страниц', 'ru'),
(295, 'Добавление страницы', 'Доступ к добавлению страницы', 'ru'),
(296, 'Pages::_set_page_roles', '', 'ru'),
(297, 'Редактирование страницы', 'Доступ к редактированию страницы', 'ru'),
(298, 'Обновление страницы', 'Доступ к редактированию страницы', 'ru'),
(299, 'Удаление страницы', 'Доступ к удалению страницы', 'ru'),
(300, 'Транслит слов', 'Доступ к транслиту слов', 'ru'),
(301, 'Смена порядка страниц', 'Доступ к смене порядка страниц', 'ru'),
(302, 'Удаление страниц', 'Доступ к удалению страниц', 'ru'),
(303, 'Перемещение страниц', 'Доступ к перемещению страниц', 'ru'),
(304, 'Отображение страницы перемещения', 'Доступ к отображению страницы перемещения', 'ru'),
(305, 'Теги', 'Теги', 'ru'),
(306, 'Создание ключевых слов', 'Доступ к созданию ключевых слов', 'ru'),
(307, 'Создание описания', 'Доступ к созданию описания', 'ru'),
(308, 'Смена статуса', 'Доступ к смене статуса', 'ru'),
(309, 'Фильтр страниц по категории', 'Доступ к фильтру страниц по категории', 'ru'),
(310, 'Управление доступом', 'Управление доступом', 'ru'),
(311, 'Настройки сайта', 'Доступ к настройкам сайта', 'ru'),
(312, 'Настройки сайта', 'Доступ к настройкам сайта', 'ru'),
(313, 'Settings::main_page', '', 'ru'),
(314, 'Список папок с шаблонами', 'Список папок с шаблонами', 'ru'),
(315, 'Сохранение настроек', 'Доступ к сохранению настроек сайта', 'ru'),
(316, 'Переключение языка в админке', 'Доступ к переключению языка в админке', 'ru'),
(317, 'Settings::save_main', '', 'ru'),
(318, 'Обновление системы', 'Доступ к обновлению системы', 'ru'),
(319, 'Обновление системы', 'Доступ к обновлению системы', 'ru'),
(320, 'Запуск обновления системы', 'Доступ к запуску обновления системы', 'ru'),
(321, 'Проверка статуса обновления системы', 'Доступ к проверке статуса обновления системы', 'ru'),
(322, 'Управление дополнительными полями', 'Доступ к управлению дополнительными полями', 'ru'),
(323, 'Настройки форм', 'Доступ к настройкам форм', 'ru'),
(324, 'Управление дополнительными полями', 'Доступ к управлению дополнительными полями', 'ru'),
(325, 'Создание дополнительного поля', 'Доступ к созданию дополнительного поля', 'ru'),
(326, 'Редактирование типа дополнительного поля', 'Доступ к редактированию типа дополнительного поля', 'ru'),
(327, 'Удаление дополнительного поля', 'Доступ к удалению дополнительного поля', 'ru'),
(328, 'Редактирование дополнительного поля', 'Доступ к редактированию дополнительного поля', 'ru'),
(329, 'Создание групы полей', 'Доступ к созданию групы полей', 'ru'),
(330, 'Редактирование групы полей', 'Доступ к редактированию групы полей', 'ru'),
(331, 'Удаление групы полей', 'Доступ к удалению групы полей', 'ru'),
(332, 'Заполнение дополнительных полей', 'Заполнение дополнительных полей', 'ru'),
(333, 'Получение атрибутов формы', 'Доступ к получению атрибутов формы', 'ru'),
(334, 'Сохранение важности', 'Доступ к сохранению важности', 'ru'),
(335, 'Отображение поля', 'Доступ к отображению поля', 'ru'),
(336, 'Получение адреса', 'Доступ к получению адреса', 'ru'),
(337, 'Получение формы', 'Доступ к форме', 'ru'),
(338, 'Управление комментариями', 'Доступ к управлению комментариями', 'ru'),
(339, 'Отображения списка комментариев', 'Доступ к отображению списка комментариев', 'ru'),
(340, 'Обработка подкомментариев', 'Доступ к обработке подкомментариев', 'ru'),
(341, 'comments::render', '', 'ru'),
(342, 'Редактирование комментария', 'Доступ к редактированию комментария', 'ru'),
(343, 'Обновление комментария', 'Доступ к обновлению комментария', 'ru'),
(344, 'Обновление статуса комментария', 'Доступ к обновлению статуса комментария', 'ru'),
(345, 'Удаление комментария', 'Доступ к удалению комментария', 'ru'),
(346, 'Множественное удаление комментариев', 'Доступ к множественному удалению комментариев', 'ru'),
(347, 'Отображение настроек модуля комментарии', 'Доступ к отображению настроек модуля комментарии', 'ru'),
(348, 'Обновление настроек комментариев', 'Доступ к обновлению настроек комментариев', 'ru'),
(349, 'Управление обратноей связью', 'Доступ к управлению обратной связью', 'ru'),
(350, 'Настройки модуля обратная связь', 'Доступ к настройкам модуля обратная связь', 'ru'),
(351, 'Получение настроек модуля обратная связь', 'Доступ к получению настроек модуля обратная связь', 'ru'),
(352, 'Управление галереей', 'Доступ к галерее', 'ru'),
(353, 'Список категорий галереи', 'Доступ к списку категорий галереи', 'ru'),
(354, 'Категория галереи', 'Доступ к категории галереи', 'ru'),
(355, 'Настройки галереи', 'Доступ к настройкам галереи', 'ru'),
(356, 'Создание альбома', 'Доступ к созданию альбома', 'ru'),
(357, 'Редактирование альбома', 'Доступ к редактированию альбома', 'ru'),
(358, 'Редактирование настроек альбома', 'Доступ к редактированию настроек альбома', 'ru'),
(359, 'Удаление альбома', 'Доступ к удалению альбома', 'ru'),
(360, 'Отображение формы содания альбома', 'Доступ к форме создания альбома', 'ru'),
(361, 'Редактирование альбома', 'Доступ к редактированию альбома', 'ru'),
(362, 'Редактирование изображения', 'Доступ к редактированию изображения', 'ru'),
(363, 'Переименование изображения', 'Доступ к переименованию изображения', 'ru'),
(364, 'Удаление изображения', 'Доступ к удалению изображения', 'ru'),
(365, 'Обновление информации', 'Доступ к обновлению информации', 'ru'),
(366, 'Смена порядка категорий', 'Доступ к смене порядка категорий', 'ru'),
(367, 'Смена порядка альбомов', 'Доступ к смене порядка альбомов', 'ru'),
(368, 'Смена порядка изображений', 'Доступ к смене порядка изображений', 'ru'),
(369, 'Отображение формы создания категории', 'Доступ к отображению формы создания категории', 'ru'),
(370, 'Создание категории', 'Доступ к созданию категории', 'ru'),
(371, 'Редактирование категории', 'Доступ к редактированию категории', 'ru'),
(372, 'Обновление категории', 'Доступ к обновлению категории', 'ru'),
(373, 'Удаление категории', 'Доступ к удалению категории', 'ru'),
(374, 'Загрузка изображений', 'Доступ к загрузке изображений', 'ru'),
(375, 'Загрузка архива', 'Доступ к загрузке архива', 'ru'),
(376, 'Управление модулем рассылки', 'Управление модулем рассылки', 'ru'),
(377, 'Отправка писем групам', 'Доступ к отправке писем групам', 'ru'),
(378, 'Отправка писем групам', 'Доступ к отправке писем групам', 'ru'),
(379, 'Отправка писем подписчикам', 'Доступк отправке писем подписчикам', 'ru'),
(380, 'Отправка писем подписчикам', 'Доступк отправке писем подписчикам', 'ru'),
(381, 'Отправка писем подписчикам', 'Доступк отправке писем подписчикам', 'ru'),
(382, 'Удаление подписчиков', 'Доступ к удалению подписчиков', 'ru'),
(383, 'Управление меню', 'Доступ к управлению меню', 'ru'),
(384, 'Список меню сайта', 'Доступ к списку меню сайта', 'ru'),
(385, 'Отображение меню', 'Доступ к отображению меню', 'ru'),
(386, 'menu::list_menu_items', '', 'ru'),
(387, 'Создание пункта меню', 'Доступ к созданию пункта меню', 'ru'),
(388, 'menu::display_selector', '', 'ru'),
(389, 'menu::get_name_by_id', '', 'ru'),
(390, 'Удаление пункта меню', 'Доступ к удалению пункта меню', 'ru'),
(391, 'Редактирование пункта меню', 'Доступ к редактированию пункта меню', 'ru'),
(392, 'menu::process_root', '', 'ru'),
(393, 'menu::insert_menu_item', '', 'ru'),
(394, 'Смена порядка меню', 'Доступ к смене порядка меню', 'ru'),
(395, 'Создание меню', 'Доступ к созданию меню', 'ru'),
(396, 'Редактирование меню', 'Доступ к редактированию меню', 'ru'),
(397, 'Обновление меню', 'Доступ к обновлению меню', 'ru'),
(398, 'Проверка данных меню', 'Доступ к проверке данных меню', 'ru'),
(399, 'Удаление меню', 'Доступ к удалению меню', 'ru'),
(400, 'Отображение формы создания меню', 'Доступ к отображению формы создания меню', 'ru'),
(401, 'Получение списка страниц', 'Доступ к получению списка страниц', 'ru'),
(402, 'Поиск страниц', 'Доступ к поиску страниц', 'ru'),
(403, 'menu::get_item', '', 'ru'),
(404, 'menu::display_tpl', '', 'ru'),
(405, 'menu::fetch_tpl', '', 'ru'),
(406, 'Отображение окна перевода пункта меню', 'Доступ к отображению окна перевода пункта меню', 'ru'),
(407, 'Перевод пункта меню', 'Доступ к переводу пункта меню', 'ru'),
(408, 'Получение списка языков', 'Доступ к получению списка языков', 'ru'),
(409, 'menu::render', '', 'ru'),
(410, 'Смена активности меню', 'Доступ к смене активности меню', 'ru'),
(411, 'Получение дочерних елементов', 'Доступ к получению дочерних елементов', 'ru'),
(412, 'Управление rss', 'Управление rss', 'ru'),
(413, 'Управление rss', 'Управление rss', 'ru'),
(414, 'rss::render', '', 'ru'),
(415, 'rss::settings_update', '', 'ru'),
(416, 'rss::display_tpl', '', 'ru'),
(417, 'rss::fetch_tpl', '', 'ru'),
(418, 'Управление шаблонами писем', 'Доступ к управлению шаблонами писем', 'ru'),
(419, 'Создание шаблона письма', 'Доступ к созданию шаблона письма', 'ru'),
(420, 'Редактирование шаблона письма', 'Доступ к редактированию шаблона письма', 'ru'),
(421, 'sample_mail::render', '', 'ru'),
(422, 'Список шаблонов писем', 'Доступ к списку шаблонов писем', 'ru'),
(423, 'Удаление шаблона письма', 'Доступ к удалению шаблона письма', 'ru'),
(424, 'sample_module::__construct', '', 'ru');
INSERT INTO `shop_rbac_privileges_i18n` (`id`, `title`, `description`, `locale`) VALUES
(425, 'sample_module::index', '', 'ru'),
(426, 'Управление кнопками соцсетей', 'Доступ к управлению кнопками соцсетей', 'ru'),
(427, 'Управление кнопками соцсетей', 'Доступ к управлению кнопками соцсетей', 'ru'),
(428, 'Обновление настроек модуля кнопок соцсетей', 'Доступ к обновлению настроек модуля кнопок соцсетей', 'ru'),
(429, 'Получение настроек модуля кнопок соцсетей', 'Доступ к настройкам модуля кнопок соцсетей', 'ru'),
(430, 'share::render', '', 'ru'),
(431, 'Управление картой сайта', 'Доступ к управлению картой сайта', 'ru'),
(432, 'Настройки карты сайта', 'Доступ к настройкам карты сайта', 'ru'),
(433, 'sitemap::_load_settings', '', 'ru'),
(434, 'Обновление настроек катры сайта', 'Доступ к обновлению настроек карты сайта', 'ru'),
(435, 'sitemap::display_tpl', '', 'ru'),
(436, 'sitemap::fetch_tpl', '', 'ru'),
(437, 'sitemap::render', '', 'ru'),
(438, 'Управление интеграцией с соцсетями', 'Доступ к управлению интеграцией с соцсетями', 'ru'),
(439, 'Настройки модуля интеграции с соцсетями', 'Достпу к настройкам модуля интеграции с соцсетями', 'ru'),
(440, 'Обновление настроек модуля', 'Доступ к обновлению настроек модуля', 'ru'),
(441, 'social_servises::get_fsettings', '', 'ru'),
(442, 'social_servises::get_vsettings', '', 'ru'),
(443, 'social_servises::_get_templates', '', 'ru'),
(444, 'social_servises::render', '', 'ru'),
(445, 'Редактор шаблонов', 'Доступ к редактору шаблонов', 'ru'),
(446, 'template_editor::render', '', 'ru'),
(447, 'Управление редиректами с удаленнных товаров', 'Управление редиректами с удаленнных товаров', 'ru'),
(448, 'Список редиректов', 'Доступ к списку редиректов', 'ru'),
(449, 'Создание редиректа', 'Доступ к созданию редиректа', 'ru'),
(450, 'Редактирование редиректа', 'Доступ к редактированию редиректа', 'ru'),
(451, 'Удаление редаректа', 'Доступ к удалению редиректа', 'ru'),
(452, 'Управление пользователями', 'Доступ к управлению пользователями', 'ru'),
(453, 'Список пользователей', 'Доступ к списку пользователей', 'ru'),
(454, 'user_manager::set_tpl_roles', '', 'ru'),
(455, 'user_manager::getRolesTable', '', 'ru'),
(456, 'Создание списка юзеров', 'Доступ к созданию списка юзеров', 'ru'),
(457, 'user_manager::auto_complit', '', 'ru'),
(458, 'Создание юзера', 'Доступ к созданию юзера', 'ru'),
(459, 'user_manager::actions', '', 'ru'),
(460, 'Поиск пользователей', 'Доступ к поиску пользователей', 'ru'),
(461, 'Редактирование юзера', 'Доступ к редактированию юзера', 'ru'),
(462, 'Обновление информации о пользователе', 'Доступ к обновлению информации о пользователе', 'ru'),
(463, 'user_manager::groups_index', '', 'ru'),
(464, 'user_manager::create', '', 'ru'),
(465, 'user_manager::edit', '', 'ru'),
(466, 'user_manager::save', '', 'ru'),
(467, 'user_manager::delete', '', 'ru'),
(468, 'Удаление пользователя', 'Доступ к удалению пользвателя', 'ru'),
(469, 'user_manager::update_role_perms', '', 'ru'),
(470, 'user_manager::show_edit_prems_tpl', '', 'ru'),
(471, 'user_manager::get_permissions_table', '', 'ru'),
(472, 'user_manager::get_group_names', '', 'ru'),
(474, 'Список виджетов', 'Доступ к списку виджетов', 'ru'),
(475, 'Создание виджета', 'Доступ к созданию виджета', 'ru'),
(476, 'Отображение формы создания виджета', 'Доступ к отображению формы создания виджета', 'ru'),
(477, 'Редактирование виджетов', 'Доступ к отображению формы создания виджета', 'ru'),
(478, 'Обновление виджета', 'Доступ к обновлению виджетов', 'ru'),
(479, 'Обновление настроек виджета', 'Доступ к обновлению настроек виджета', 'ru'),
(480, 'Удаление виджета', 'Доступ к удалению виджета', 'ru'),
(482, 'Редактирование html виджета', 'Доступ к редактированию html виджета', 'ru'),
(483, 'Редактирование модульного виджета', 'Доступ к редактированию модульного виджета', 'ru'),
(485, 'Поиск картинок', NULL, 'ru'),
(486, 'Доступ к списку подкатегорий', NULL, 'ru');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_roles`
--

DROP TABLE IF EXISTS `shop_rbac_roles`;
CREATE TABLE IF NOT EXISTS `shop_rbac_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `importance` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `shop_rbac_roles`
--

INSERT INTO `shop_rbac_roles` (`id`, `name`, `importance`, `description`) VALUES
(1, 'Administrator', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_roles_i18n`
--

DROP TABLE IF EXISTS `shop_rbac_roles_i18n`;
CREATE TABLE IF NOT EXISTS `shop_rbac_roles_i18n` (
  `id` int(11) NOT NULL,
  `alt_name` varchar(45) DEFAULT NULL,
  `locale` varchar(5) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  KEY `role_id_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_rbac_roles_i18n`
--

INSERT INTO `shop_rbac_roles_i18n` (`id`, `alt_name`, `locale`, `description`) VALUES
(1, 'Администратор', 'ru', 'Доступны все елементы управления админкой'),
(1, 'Адмiнiстратор', 'ukr', ''),
(1, 'Адмiнiстратор', 'ua', ''),
(1, 'Admin', 'en', 'Access to all controls');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_roles_privileges`
--

DROP TABLE IF EXISTS `shop_rbac_roles_privileges`;
CREATE TABLE IF NOT EXISTS `shop_rbac_roles_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolepriv` (`role_id`,`privilege_id`),
  KEY `shop_rbac_roles_privileges_FK_2` (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3187 ;

--
-- Дамп данных таблицы `shop_rbac_roles_privileges`
--

INSERT INTO `shop_rbac_roles_privileges` (`id`, `role_id`, `privilege_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29),
(30, 1, 30),
(31, 1, 31),
(32, 1, 32),
(33, 1, 33),
(34, 1, 34),
(35, 1, 35),
(36, 1, 36),
(37, 1, 37),
(38, 1, 38),
(39, 1, 39),
(40, 1, 40),
(41, 1, 41),
(42, 1, 42),
(43, 1, 43),
(44, 1, 44),
(45, 1, 45),
(46, 1, 46),
(47, 1, 47),
(48, 1, 48),
(49, 1, 49),
(50, 1, 50),
(51, 1, 51),
(52, 1, 52),
(53, 1, 53),
(54, 1, 54),
(55, 1, 55),
(56, 1, 56),
(57, 1, 57),
(58, 1, 58),
(59, 1, 59),
(60, 1, 60),
(61, 1, 61),
(62, 1, 62),
(63, 1, 63),
(64, 1, 64),
(65, 1, 65),
(66, 1, 66),
(67, 1, 67),
(68, 1, 68),
(69, 1, 69),
(70, 1, 70),
(71, 1, 71),
(72, 1, 72),
(73, 1, 73),
(74, 1, 74),
(75, 1, 75),
(76, 1, 76),
(77, 1, 77),
(78, 1, 78),
(79, 1, 79),
(80, 1, 80),
(81, 1, 81),
(82, 1, 82),
(83, 1, 83),
(84, 1, 84),
(85, 1, 85),
(86, 1, 86),
(87, 1, 87),
(88, 1, 88),
(89, 1, 89),
(90, 1, 90),
(91, 1, 91),
(92, 1, 92),
(93, 1, 93),
(94, 1, 94),
(95, 1, 95),
(96, 1, 96),
(97, 1, 97),
(98, 1, 98),
(99, 1, 99),
(100, 1, 100),
(101, 1, 101),
(102, 1, 102),
(103, 1, 103),
(104, 1, 104),
(105, 1, 105),
(106, 1, 106),
(107, 1, 107),
(108, 1, 108),
(109, 1, 109),
(110, 1, 110),
(111, 1, 111),
(112, 1, 112),
(113, 1, 113),
(114, 1, 114),
(115, 1, 115),
(116, 1, 116),
(117, 1, 117),
(118, 1, 118),
(119, 1, 119),
(120, 1, 120),
(121, 1, 121),
(122, 1, 122),
(123, 1, 123),
(124, 1, 124),
(125, 1, 125),
(126, 1, 126),
(127, 1, 127),
(128, 1, 128),
(129, 1, 129),
(130, 1, 130),
(131, 1, 131),
(132, 1, 132),
(133, 1, 133),
(134, 1, 134),
(135, 1, 135),
(136, 1, 136),
(137, 1, 137),
(138, 1, 138),
(139, 1, 139),
(140, 1, 140),
(141, 1, 141),
(142, 1, 142),
(143, 1, 143),
(144, 1, 144),
(145, 1, 145),
(146, 1, 146),
(147, 1, 147),
(148, 1, 148),
(149, 1, 149),
(150, 1, 150),
(151, 1, 151),
(152, 1, 152),
(153, 1, 153),
(154, 1, 154),
(155, 1, 155),
(156, 1, 156),
(157, 1, 157),
(158, 1, 158),
(159, 1, 159),
(160, 1, 160),
(161, 1, 161),
(162, 1, 162),
(163, 1, 163),
(164, 1, 164),
(165, 1, 165),
(166, 1, 166),
(167, 1, 167),
(168, 1, 168),
(169, 1, 169),
(184, 1, 184),
(185, 1, 185),
(186, 1, 186),
(187, 1, 187),
(188, 1, 188),
(189, 1, 189),
(190, 1, 190),
(191, 1, 191),
(192, 1, 192),
(193, 1, 193),
(194, 1, 194),
(195, 1, 195),
(196, 1, 196),
(197, 1, 197),
(198, 1, 198),
(199, 1, 199),
(200, 1, 200),
(201, 1, 201),
(202, 1, 202),
(203, 1, 203),
(204, 1, 204),
(205, 1, 205),
(206, 1, 206),
(207, 1, 207),
(208, 1, 208),
(209, 1, 209),
(210, 1, 210),
(211, 1, 211),
(212, 1, 212),
(213, 1, 213),
(214, 1, 214),
(215, 1, 215),
(216, 1, 216),
(217, 1, 217),
(218, 1, 218),
(219, 1, 219),
(220, 1, 220),
(221, 1, 221),
(222, 1, 222),
(223, 1, 223),
(224, 1, 224),
(225, 1, 225),
(226, 1, 226),
(227, 1, 227),
(228, 1, 228),
(229, 1, 229),
(230, 1, 230),
(231, 1, 231),
(232, 1, 232),
(233, 1, 233),
(234, 1, 234),
(235, 1, 235),
(236, 1, 236),
(237, 1, 237),
(238, 1, 238),
(239, 1, 239),
(240, 1, 240),
(241, 1, 241),
(242, 1, 242),
(243, 1, 243),
(244, 1, 244),
(245, 1, 245),
(246, 1, 246),
(247, 1, 247),
(248, 1, 248),
(249, 1, 249),
(250, 1, 250),
(251, 1, 251),
(252, 1, 252),
(253, 1, 253),
(254, 1, 254),
(255, 1, 255),
(256, 1, 256),
(257, 1, 257),
(258, 1, 258),
(259, 1, 259),
(260, 1, 260),
(261, 1, 261),
(262, 1, 262),
(263, 1, 263),
(264, 1, 264),
(265, 1, 265),
(266, 1, 266),
(267, 1, 267),
(268, 1, 268),
(269, 1, 269),
(270, 1, 270),
(271, 1, 271),
(272, 1, 272),
(273, 1, 273),
(274, 1, 274),
(275, 1, 275),
(276, 1, 276),
(277, 1, 277),
(278, 1, 278),
(279, 1, 279),
(280, 1, 280),
(281, 1, 281),
(282, 1, 282),
(283, 1, 283),
(284, 1, 284),
(285, 1, 285),
(286, 1, 286),
(287, 1, 287),
(293, 1, 293),
(294, 1, 294),
(295, 1, 295),
(296, 1, 296),
(297, 1, 297),
(298, 1, 298),
(299, 1, 299),
(300, 1, 300),
(301, 1, 301),
(302, 1, 302),
(303, 1, 303),
(304, 1, 304),
(305, 1, 305),
(306, 1, 306),
(307, 1, 307),
(308, 1, 308),
(309, 1, 309),
(310, 1, 310),
(311, 1, 311),
(312, 1, 312),
(313, 1, 313),
(314, 1, 314),
(315, 1, 315),
(316, 1, 316),
(317, 1, 317),
(322, 1, 322),
(323, 1, 323),
(324, 1, 324),
(325, 1, 325),
(326, 1, 326),
(327, 1, 327),
(328, 1, 328),
(329, 1, 329),
(330, 1, 330),
(331, 1, 331),
(332, 1, 332),
(333, 1, 333),
(334, 1, 334),
(335, 1, 335),
(336, 1, 336),
(337, 1, 337),
(338, 1, 338),
(339, 1, 339),
(340, 1, 340),
(341, 1, 341),
(342, 1, 342),
(343, 1, 343),
(344, 1, 344),
(345, 1, 345),
(346, 1, 346),
(347, 1, 347),
(348, 1, 348),
(349, 1, 349),
(350, 1, 350),
(351, 1, 351),
(352, 1, 352),
(353, 1, 353),
(354, 1, 354),
(355, 1, 355),
(356, 1, 356),
(357, 1, 357),
(358, 1, 358),
(359, 1, 359),
(360, 1, 360),
(361, 1, 361),
(362, 1, 362),
(363, 1, 363),
(364, 1, 364),
(365, 1, 365),
(366, 1, 366),
(367, 1, 367),
(368, 1, 368),
(369, 1, 369),
(370, 1, 370),
(371, 1, 371),
(372, 1, 372),
(373, 1, 373),
(374, 1, 374),
(375, 1, 375),
(376, 1, 376),
(377, 1, 377),
(378, 1, 378),
(379, 1, 379),
(380, 1, 380),
(381, 1, 381),
(382, 1, 382),
(383, 1, 383),
(384, 1, 384),
(385, 1, 385),
(386, 1, 386),
(387, 1, 387),
(388, 1, 388),
(389, 1, 389),
(390, 1, 390),
(391, 1, 391),
(392, 1, 392),
(393, 1, 393),
(394, 1, 394),
(395, 1, 395),
(396, 1, 396),
(397, 1, 397),
(398, 1, 398),
(399, 1, 399),
(400, 1, 400),
(401, 1, 401),
(402, 1, 402),
(403, 1, 403),
(404, 1, 404),
(405, 1, 405),
(406, 1, 406),
(407, 1, 407),
(408, 1, 408),
(409, 1, 409),
(410, 1, 410),
(411, 1, 411),
(412, 1, 412),
(413, 1, 413),
(414, 1, 414),
(415, 1, 415),
(416, 1, 416),
(417, 1, 417),
(418, 1, 418),
(419, 1, 419),
(420, 1, 420),
(421, 1, 421),
(422, 1, 422),
(423, 1, 423),
(426, 1, 426),
(427, 1, 427),
(428, 1, 428),
(429, 1, 429),
(430, 1, 430),
(431, 1, 431),
(432, 1, 432),
(433, 1, 433),
(434, 1, 434),
(435, 1, 435),
(436, 1, 436),
(437, 1, 437),
(438, 1, 438),
(439, 1, 439),
(440, 1, 440),
(441, 1, 441),
(442, 1, 442),
(443, 1, 443),
(444, 1, 444),
(445, 1, 445),
(446, 1, 446),
(447, 1, 447),
(448, 1, 448),
(449, 1, 449),
(450, 1, 450),
(451, 1, 451),
(452, 1, 452),
(453, 1, 453),
(454, 1, 454),
(455, 1, 455),
(456, 1, 456),
(457, 1, 457),
(458, 1, 458),
(459, 1, 459),
(460, 1, 460),
(461, 1, 461),
(462, 1, 462),
(463, 1, 463),
(464, 1, 464),
(465, 1, 465),
(466, 1, 466),
(467, 1, 467),
(468, 1, 468),
(469, 1, 469),
(470, 1, 470),
(471, 1, 471),
(472, 1, 472),
(473, 1, 473),
(474, 1, 474),
(475, 1, 475),
(476, 1, 476),
(477, 1, 477),
(478, 1, 478),
(479, 1, 479),
(480, 1, 480),
(482, 1, 482),
(483, 1, 483),
(485, 1, 485),
(486, 1, 486),
(612, 1, 424),
(613, 1, 425),
(2456, 1, 672),
(2455, 1, 684),
(2454, 1, 703),
(2453, 1, 702),
(2452, 1, 701),
(2451, 1, 700),
(2450, 1, 699),
(2449, 1, 698),
(2448, 1, 697),
(2447, 1, 696),
(2446, 1, 695),
(2445, 1, 694),
(2444, 1, 693),
(2443, 1, 692),
(2442, 1, 691),
(2441, 1, 690),
(2440, 1, 689),
(2439, 1, 688),
(2438, 1, 687),
(2437, 1, 686),
(2436, 1, 704),
(2435, 1, 705),
(2434, 1, 706),
(2457, 1, 707),
(2458, 1, 708),
(2459, 1, 709),
(2460, 1, 710),
(2461, 1, 711),
(2462, 1, 712),
(2463, 1, 713),
(2464, 1, 714),
(2465, 1, 715),
(2466, 1, 716),
(2432, 1, 683),
(2431, 1, 682),
(2430, 1, 681),
(2429, 1, 680),
(2428, 1, 679),
(2427, 1, 678),
(2426, 1, 677),
(2425, 1, 676),
(2424, 1, 675),
(2423, 1, 674),
(2422, 1, 673),
(2421, 1, 685),
(1581, 1, 500),
(1582, 1, 501),
(1583, 1, 502),
(1584, 1, 503),
(1585, 1, 504),
(1586, 1, 505),
(1587, 1, 506),
(1588, 1, 507),
(1589, 1, 508),
(1590, 1, 509),
(1591, 1, 510),
(1592, 1, 511),
(1593, 1, 512),
(1594, 1, 513),
(1595, 1, 514),
(1596, 1, 515),
(1602, 1, 656),
(1603, 1, 657),
(1604, 1, 658),
(1605, 1, 659),
(1606, 1, 481),
(1607, 1, 484),
(1608, 1, 643),
(1609, 1, 644),
(1610, 1, 645),
(1611, 1, 646),
(1612, 1, 647),
(1613, 1, 648),
(1614, 1, 649),
(1615, 1, 650),
(1616, 1, 651),
(1617, 1, 652),
(1618, 1, 653),
(1619, 1, 654),
(1620, 1, 655),
(1621, 1, 499),
(1622, 1, 498),
(1623, 1, 664),
(1624, 1, 665),
(1625, 1, 606),
(1626, 1, 607),
(1627, 1, 608),
(1628, 1, 609),
(1629, 1, 660),
(1630, 1, 661),
(1631, 1, 662),
(1632, 1, 663),
(1633, 1, 610),
(1634, 1, 611),
(1635, 1, 612),
(1636, 1, 613),
(1637, 1, 614),
(1638, 1, 666),
(1639, 1, 667),
(1640, 1, 668),
(1641, 1, 669),
(1642, 1, 670),
(1643, 1, 671),
(1644, 1, 567),
(1645, 1, 568),
(1646, 1, 569),
(1647, 1, 570),
(1648, 1, 571),
(1649, 1, 572),
(1650, 1, 573),
(1651, 1, 599),
(1652, 1, 600),
(1653, 1, 601),
(1654, 1, 602),
(1655, 1, 603),
(1656, 1, 604),
(1657, 1, 605),
(1658, 1, 516),
(1659, 1, 517),
(1660, 1, 518),
(1661, 1, 519),
(1662, 1, 520),
(1663, 1, 521),
(1664, 1, 522),
(1665, 1, 523),
(1666, 1, 558),
(1667, 1, 559),
(1668, 1, 560),
(1669, 1, 561),
(1670, 1, 562),
(1671, 1, 563),
(1672, 1, 564),
(1673, 1, 565),
(1674, 1, 566),
(1675, 1, 535),
(1676, 1, 536),
(1677, 1, 537),
(1678, 1, 538),
(1679, 1, 539),
(1680, 1, 540),
(1681, 1, 541),
(1682, 1, 542),
(1683, 1, 543),
(1684, 1, 544),
(1685, 1, 487),
(1686, 1, 488),
(1687, 1, 489),
(1688, 1, 490),
(1689, 1, 491),
(1690, 1, 492),
(1691, 1, 493),
(1692, 1, 494),
(1693, 1, 495),
(1694, 1, 496),
(1695, 1, 497),
(1696, 1, 524),
(1697, 1, 525),
(1698, 1, 526),
(1699, 1, 527),
(1700, 1, 528),
(1701, 1, 529),
(1702, 1, 530),
(1703, 1, 531),
(1704, 1, 532),
(1705, 1, 533),
(1706, 1, 534),
(1707, 1, 615),
(1708, 1, 616),
(1709, 1, 617),
(1710, 1, 618),
(1711, 1, 619),
(1712, 1, 620),
(1713, 1, 621),
(1714, 1, 622),
(1715, 1, 623),
(1716, 1, 624),
(1717, 1, 625),
(1718, 1, 626),
(1719, 1, 545),
(1720, 1, 546),
(1721, 1, 547),
(1722, 1, 548),
(1723, 1, 549),
(1724, 1, 550),
(1725, 1, 551),
(1726, 1, 552),
(1727, 1, 553),
(1728, 1, 554),
(1729, 1, 555),
(1730, 1, 556),
(1731, 1, 557),
(1732, 1, 627),
(1733, 1, 628),
(1734, 1, 629),
(1735, 1, 630),
(1736, 1, 631),
(1737, 1, 632),
(1738, 1, 633),
(1739, 1, 634),
(1740, 1, 635),
(1741, 1, 636),
(1742, 1, 637),
(1743, 1, 638),
(1744, 1, 639),
(1745, 1, 640),
(1746, 1, 641),
(1747, 1, 642),
(1748, 1, 574),
(1749, 1, 575),
(1750, 1, 576),
(1751, 1, 577),
(1752, 1, 578),
(1753, 1, 579),
(1754, 1, 580),
(1755, 1, 581),
(1756, 1, 582),
(1757, 1, 583),
(1758, 1, 584),
(1759, 1, 585),
(1760, 1, 586),
(1761, 1, 587),
(1762, 1, 588),
(1763, 1, 589),
(1764, 1, 590),
(1765, 1, 591),
(1766, 1, 592),
(1767, 1, 593),
(1768, 1, 594),
(1769, 1, 595),
(1770, 1, 596),
(1771, 1, 597),
(1772, 1, 598),
(3160, 1, 717),
(3171, 1, 726),
(3172, 1, 719),
(3173, 1, 720),
(3174, 1, 721),
(3175, 1, 722),
(3176, 1, 723),
(3177, 1, 724),
(3178, 1, 718),
(3179, 1, 725),
(3182, 1, 727),
(3183, 1, 728),
(3184, 1, 729),
(3185, 1, 730),
(3186, 1, 731),
(3187, 1, 732),
(3188, 1, 733),
(3190, 1, 735),
(3191, 1, 736),
(3192, 1, 737),
(3193, 1, 738),
(3194, 1, 739),
(3195, 1, 740),
(3196, 1, 741),
(3197, 1, 742),
(3198, 1, 743),
(3199, 1, 744),
(3200, 1, 745),
(3201, 1, 746);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_settings`
--

DROP TABLE IF EXISTS `shop_settings`;
CREATE TABLE IF NOT EXISTS `shop_settings` (
  `name` varchar(255) NOT NULL,
  `value` text,
  `locale` varchar(5) NOT NULL,
  PRIMARY KEY (`name`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_settings`
--

INSERT INTO `shop_settings` (`name`, `value`, `locale`) VALUES
('mainImageWidth', '320', ''),
('mainImageHeight', '320', ''),
('smallImageWidth', '140', ''),
('smallImageHeight', '140', ''),
('addImageWidth', '800', ''),
('addImageHeight', '600', ''),
('imagesQuality', '99', ''),
('systemTemplatePath', './templates/fullMarket/shop/', ''),
('frontProductsPerPage', '12', ''),
('adminProductsPerPage', '24', ''),
('ordersMessageFormat', NULL, ''),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22', ''),
('ordersSendMessage', NULL, ''),
('ordersSenderEmail', NULL, ''),
('ordersSenderName', 'DemoShop ImageCms.net', ''),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки', ''),
('2_LMI_SECRET_KEY', 'bank', ''),
('2_LMI_PAYEE_PURSE', 'bank', ''),
('1_LMI_SECRET_KEY', 'cur', ''),
('1_LMI_PAYEE_PURSE', 'cur', ''),
('2_OschadBankData', 'a:5:{s:8:"receiver";s:41:"ТЗОВ "Екзампл Магазин" ";s:4:"code";s:9:"123456789";s:7:"account";s:12:"123456789123";s:3:"mfo";s:6:"123456";s:8:"banknote";s:7:"грн.";}', ''),
('3_SberBankData', 'a:8:{s:12:"receiverName";s:45:"Наименование получателя";s:8:"bankName";s:29:"Банк получателя";s:11:"receiverInn";s:10:"1231231231";s:7:"account";s:20:"15412398123312341237";s:3:"BIK";s:9:"123123123";s:11:"cor_account";s:20:"12312312334012340123";s:8:"bankNote";s:7:"руб.";s:9:"bankNote2";s:7:"коп.";}', ''),
('4_RobokassaData', 'a:3:{s:5:"login";s:5:"login";s:9:"password1";s:9:"password1";s:9:"password2";s:9:"password2";}', ''),
('notifyOrderStatusMessageFormat', NULL, ''),
('notifyOrderStatusMessageText', '', ''),
('notifyOrderStatusSenderEmail', NULL, ''),
('notifyOrderStatusSenderName', '', ''),
('notifyOrderStatusMessageTheme', '', ''),
('wishListsMessageFormat', 'text', ''),
('wishListsMessageText', '', ''),
('wishListsSenderEmail', 'noreply@example.com', ''),
('wishListsSenderName', '', ''),
('wishListsMessageTheme', '', ''),
('notificationsMessageFormat', 'text', ''),
('notificationsMessageText', '', ''),
('notificationsSenderEmail', 'noreply@example.com', ''),
('notificationsSenderName', '', ''),
('notificationsMessageTheme', '', ''),
('callbacksSendNotification', '0', ''),
('callbacksMessageFormat', 'text', ''),
('callbacksMessageText', '', ''),
('callbacksSendEmailTo', 'manager@example.com', ''),
('callbacksSenderEmail', 'noreply@example.com', ''),
('callbacksSenderName', '', ''),
('callbacksMessageTheme', '', ''),
('userInfoRegister', '1', ''),
('userInfoMessageFormat', 'text', ''),
('userInfoMessageText', '', ''),
('userInfoSenderEmail', 'noreply@example.com', ''),
('userInfoSenderName', '', ''),
('userInfoMessageTheme', '', ''),
('topSalesBlockFormulaCoef', '1', ''),
('pricePrecision', '4', ''),
('smallAddImageWidth', '90', ''),
('smallAddImageHeight', '90', ''),
('forgotPasswordMessageText', 'Здравствуйте!\n\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\n\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri% \n\nВаш новый пароль для входа: %password%\n\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\n\n\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\n\nС уважением, \nсотрудники службы продаж %webSiteName%', ''),
('watermark_wm_hor_alignment', 'left', ''),
('watermark_wm_vrt_alignment', 'bottom', ''),
('watermark_watermark_type', 'text', ''),
('watermark_watermark_image', '', ''),
('watermark_watermark_image_opacity', '50', ''),
('watermark_watermark_padding', '', ''),
('watermark_watermark_text', 'demoshop.imagecms.net', ''),
('watermark_watermark_font_size', '', ''),
('watermark_watermark_color', '', ''),
('watermark_watermark_font_path', '', ''),
('watermark_active', '', ''),
('forgotPasswordMessageText', NULL, 'ru'),
('ordersMessageText', NULL, 'ru'),
('ordersSenderName', NULL, 'ru'),
('ordersMessageTheme', NULL, 'ru'),
('11_LiqPayData', 'a:2:{s:11:"merchant_id";s:6:"111111";s:12:"merchant_sig";s:6:"111111";}', ''),
('notifyOrderStatusMessageText', NULL, 'ru'),
('notifyOrderStatusSenderName', NULL, 'ru'),
('notifyOrderStatusMessageTheme', NULL, 'ru'),
('wishListsMessageText', '', 'ru'),
('wishListsSenderName', 'admin', 'ru'),
('wishListsMessageTheme', '', 'ru'),
('notificationsMessageText', '', 'ru'),
('notificationsSenderName', '', 'ru'),
('notificationsMessageTheme', '', 'ru'),
('callbacksMessageText', '', 'ru'),
('callbacksSenderName', '', 'ru'),
('callbacksMessageTheme', '', 'ru'),
('userInfoMessageText', '', 'ru'),
('userInfoSenderName', '', 'ru'),
('userInfoMessageTheme', '', 'ru'),
('adminMessageCallback', '<h1>Спасибо за заказ звонка</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>  ', ''),
('adminMessages', 'a:3:{s:8:"incoming";s:0:"";s:8:"callback";s:27:"вфы вфыв фыв фы";s:5:"order";s:0:"";}', 'ru'),
('selectedProductCats', 'N;', ''),
('isAdult', NULL, ''),
('adminMessageIncoming', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>  ', ''),
('adminMessageOrderPage', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>  ', ''),
('mainModImageWidth', '640', ''),
('mainModImageHeight', '480', ''),
('smallModImageWidth', '90', ''),
('smallModImageHeight', '90', ''),
('order_method', NULL, ''),
('forgotPasswordMessageText', 'Здравствуйте!\n\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\n\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri% \n\nВаш новый пароль для входа: %password%\n\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\n\n\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\n\nС уважением, \nсотрудники службы продаж %webSiteName%', 'en'),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22', 'en'),
('ordersSenderName', 'DemoShop ImageCms.net', 'en'),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки', 'en'),
('ordersManagerEmail', NULL, ''),
('ordersSendManagerMessage', NULL, ''),
('notifyOrderStatusMessageText', '', 'en'),
('notifyOrderStatusSenderName', '', 'en'),
('notifyOrderStatusMessageTheme', '', 'en'),
('wishListsMessageText', '', 'en'),
('wishListsSenderName', '', 'en'),
('wishListsMessageTheme', '', 'en'),
('notificationsMessageText', '', 'en'),
('notificationsSenderName', '', 'en'),
('notificationsMessageTheme', '', 'en'),
('callbacksMessageText', '', 'en'),
('callbacksSenderName', '', 'en'),
('callbacksMessageTheme', '', 'en'),
('userInfoMessageText', '', 'en'),
('userInfoSenderName', '', 'en'),
('userInfoMessageTheme', '', 'en'),
('MemcachedSettings', 'a:1:{s:11:"MEMCACHE_ON";b:0;}', ''),
('10_PB_MERCHANT_PASSWORD', '999999999999', ''),
('10_PB_API_URL', 'https://api.privatbank.ua/p24api/ishop', ''),
('adminMessageMonkey', '', ''),
('adminMessageMonkeylist', '', ''),
('MobileVersionSettings', 'a:1:{s:15:"MobileVersionON";b:0;}', ''),
('10_PB_MERCHANT_ID', '99999', ''),
('facebook_int', 'a:3:{s:9:"secretkey";s:0:"";s:9:"appnumber";s:0:"";s:8:"template";s:10:"fullMarket";}', ''),
('vk_int', 'a:3:{s:7:"protkey";s:0:"";s:9:"appnumber";s:0:"";s:8:"template";s:10:"fullMarket";}', ''),
('xmlSiteMap', 'a:6:{s:18:"main_page_priority";b:0;s:13:"cats_priority";b:0;s:14:"pages_priority";b:0;s:20:"main_page_changefreq";b:0;s:21:"categories_changefreq";b:0;s:16:"pages_changefreq";b:0;}', ''),
('mobileTemplatePath', './templates/commerce_mobiles/shop/PIE', ''),
('ordersRecountGoods', '', ''),
('ordersuserInfoRegister', NULL, ''),
('notifyOrderStatusStatusEmail', NULL, ''),
('8_LMI_PAYEE_PURSE', '6456456456464', ''),
('8_LMI_SECRET_KEY', '456', ''),
('watermark_watermark_interest', '25', ''),
('9_OschadBankData', 'a:5:{s:8:"receiver";s:0:"";s:4:"code";s:10:"1234567890";s:7:"account";s:0:"";s:3:"mfo";s:0:"";s:8:"banknote";s:0:"";}', ''),
('ss', 'a:9:{s:4:"yaru";s:1:"1";s:5:"vkcom";s:1:"1";s:8:"facebook";s:1:"1";s:7:"twitter";s:1:"1";s:9:"odnoclass";s:1:"1";s:7:"myworld";s:1:"1";s:2:"lj";s:1:"1";s:4:"type";s:6:"button";s:8:"vk_apiid";s:0:"";}', ''),
('1CCatSettings', 'a:1:{s:8:"filesize";s:11:"file_limit=";}', ''),
('1CSettingsOS', 'N;', ''),
('usegifts', '0;', 'ru'),
('ordersCheckStocks', '', ''),
('imageSizesBlock', 'a:4:{s:5:"small";a:3:{s:4:"name";s:5:"small";s:5:"width";s:2:"62";s:6:"height";s:2:"62";}s:6:"medium";a:3:{s:4:"name";s:6:"medium";s:5:"width";s:3:"260";s:6:"height";s:3:"150";}s:4:"main";a:3:{s:4:"name";s:4:"main";s:5:"width";s:3:"452";s:6:"height";s:3:"288";}s:5:"large";a:3:{s:4:"name";s:5:"large";s:5:"width";s:4:"1000";s:6:"height";s:4:"1000";}}', ''),
('imagesMainSize', 'auto', ''),
('additionalImageWidth', '1000', ''),
('additionalImageHeight', '1000', ''),
('arrayFrontProductsPerPage', 'a:3:{i:0;s:2:"12";i:1;s:2:"24";i:2;s:2:"48";}', ''),
('thumbImageWidth', '62', ''),
('thumbImageHeight', '62', ''),
('watermark_delete_watermark_font_path', '0', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_sorting`
--

DROP TABLE IF EXISTS `shop_sorting`;
CREATE TABLE IF NOT EXISTS `shop_sorting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) DEFAULT NULL,
  `get` varchar(25) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `shop_sorting`
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
(10, 7, 'topsales', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_sorting_i18n`
--

DROP TABLE IF EXISTS `shop_sorting_i18n`;
CREATE TABLE IF NOT EXISTS `shop_sorting_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(11) NOT NULL DEFAULT 'ru',
  `name` varchar(50) NOT NULL,
  `name_front` varchar(50) DEFAULT NULL,
  `tooltip` varchar(256) NOT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `shop_sorting_i18n`
--

INSERT INTO `shop_sorting_i18n` (`id`, `locale`, `name`, `name_front`, `tooltip`) VALUES
(1, 'ru', 'По рейтингу', 'Рейтинг', ''),
(2, 'ru', 'От дешевих к дорогим', 'От дешевих к дорогим', ''),
(3, 'ru', 'От дорогих к дешевым', 'От дорогих к дешевим', ''),
(4, 'ru', 'Популярные', 'Популярние', ''),
(5, 'ru', 'Новинки', 'Новинки', ''),
(6, 'ru', 'Акции', 'Акции', ''),
(6, 'ua', '', '', ''),
(7, 'ru', 'А-Я', 'Имени', ''),
(8, 'ru', 'Я-А', 'Имени(Я-А)', ''),
(9, 'ru', 'Просмотров', 'Количеству просмотров', ''),
(10, 'ru', 'Топ продаж', 'Топ продаж', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_spy`
--

DROP TABLE IF EXISTS `shop_spy`;
CREATE TABLE IF NOT EXISTS `shop_spy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `key` varchar(500) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `old_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `shop_spy`
--

INSERT INTO `shop_spy` (`id`, `user_id`, `product_id`, `price`, `variant_id`, `key`, `email`, `old_price`) VALUES
(3, 69, 102, 550, 113, 'IPrMlWydoeP9Cmex30upNOUsdTa4bIrg', NULL, 549);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_warehouse`
--

DROP TABLE IF EXISTS `shop_warehouse`;
CREATE TABLE IF NOT EXISTS `shop_warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `shop_warehouse_I_1` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `shop_warehouse`
--

INSERT INTO `shop_warehouse` (`id`, `name`, `address`, `phone`, `description`) VALUES
(1, 'warehouse 1', 'address', 'phone', ''),
(2, 'warehouse 2', 'address 2', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_warehouse_data`
--

DROP TABLE IF EXISTS `shop_warehouse_data`;
CREATE TABLE IF NOT EXISTS `shop_warehouse_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_warehouse_data_FI_1` (`product_id`),
  KEY `shop_warehouse_data_FI_2` (`warehouse_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `shop_warehouse_data`
--

INSERT INTO `shop_warehouse_data` (`id`, `product_id`, `warehouse_id`, `count`) VALUES
(37, 132, 2, 3),
(36, 132, 1, 2),
(35, 132, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `support_comments`
--

DROP TABLE IF EXISTS `support_comments`;
CREATE TABLE IF NOT EXISTS `support_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_status` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `support_comments`
--

INSERT INTO `support_comments` (`id`, `ticket_id`, `user_id`, `user_status`, `user_name`, `text`, `date`) VALUES
(1, 3, 1, 1, 'admin', 'Вы можете оплатить услуги безналичным переводом и наличными.', 1353064129);

-- --------------------------------------------------------

--
-- Структура таблицы `support_departments`
--

DROP TABLE IF EXISTS `support_departments`;
CREATE TABLE IF NOT EXISTS `support_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `support_departments`
--

INSERT INTO `support_departments` (`id`, `name`) VALUES
(1, 'Техническая поддержка'),
(2, 'Финансовый отдел'),
(3, 'Отдел консультаций');

-- --------------------------------------------------------

--
-- Структура таблицы `support_tickets`
--

DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `last_comment_author` varchar(50) NOT NULL,
  `text` text,
  `theme` varchar(100) NOT NULL,
  `department` int(11) NOT NULL,
  `status` smallint(1) DEFAULT NULL,
  `priority` varchar(15) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `last_comment_author`, `text`, `theme`, `department`, `status`, `priority`, `date`, `updated`) VALUES
(1, 1, '', 'Не могу настроить на сайте переадресации. На локалке все работает. Помогите пожалуйста.', 'htaccess', 1, 0, '2', 1353061322, 1353061322),
(2, 1, '', 'Какой тарифный план лучше подходит для моего сайта?', 'хостинг', 3, 0, '1', 1353061376, 1353061376),
(3, 1, 'admin', 'Как я могу полатить хостинг?', 'Оплата услуг', 2, 0, '0', 1353061402, 1353064130);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `template_settings`
--

DROP TABLE IF EXISTS `template_settings`;
CREATE TABLE IF NOT EXISTS `template_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(255) NOT NULL,
  `key` text,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `template_settings`
--

INSERT INTO `template_settings` (`id`, `component`, `key`, `data`) VALUES
(1, 'TColorScheme', 'color_scheme', 'color_scheme_1'),
(2, 'TMenuColumn', 'columns', 'a:8:{i:3023;s:1:"0";i:3018;s:1:"0";i:3024;s:1:"0";i:3025;s:1:"0";i:3019;s:1:"0";i:3026;s:1:"0";i:3015;s:1:"0";i:3017;s:1:"0";}'),
(3, 'TMenuColumn', 'openLevels', 's:3:"all";');

-- --------------------------------------------------------

--
-- Структура таблицы `trash`
--

DROP TABLE IF EXISTS `trash`;
CREATE TABLE IF NOT EXISTS `trash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trash_id` varchar(255) DEFAULT NULL,
  `trash_url` varchar(255) DEFAULT NULL,
  `trash_redirect_type` varchar(20) DEFAULT NULL,
  `trash_redirect` varchar(255) DEFAULT NULL,
  `trash_type` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT NULL,
  `ban_reason` varchar(255) DEFAULT NULL,
  `newpass` varchar(255) DEFAULT NULL,
  `newpass_key` varchar(255) DEFAULT NULL,
  `newpass_time` int(11) DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cart_data` text,
  `wish_list_data` text,
  `key` varchar(255) NOT NULL,
  `amout` float(10,2) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_I_1` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`, `address`, `cart_data`, `wish_list_data`, `key`, `amout`, `discount`, `phone`) VALUES
(43, NULL, 'test', '$1$iX0.D40.$3KQvRugPWnG.ww.7YhMYA.', 'same_one@mail.ru', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2013, 1358358993, NULL, '', NULL, NULL, 'NvJLj', 0.00, NULL, ''),
(2, NULL, 'Василий Пупкин', '$1$fCYNXvZ/$8XtmYCvq/zhA3Fc//ou00.', 'vasil.pypkin@mail.ru', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2013, 944006400, NULL, 'г. Москва', 'a:1:{s:21:"SProducts_13399_13999";a:6:{s:8:"instance";s:9:"SProducts";s:9:"productId";i:13399;s:9:"variantId";i:13999;s:8:"quantity";i:1;s:5:"price";d:612.89999999999998;s:11:"variantName";s:0:"";}}', NULL, 'Rw9x4', 0.00, NULL, '+38050 123 45 67'),
(3, 2, 'Оксана', '$1$LjN2NDGo$pm.0w5ad56jcfU7d7lrMP1', 'oksana@mail.ru', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', NULL, 1116806400, NULL, 'г. Тула', NULL, NULL, 'iZkSk', 0.00, NULL, '+3 098 357 78 54'),
(4, NULL, 'Валентин', '$1$5E22OQfO$LSChb/.1d0am5RWhTVom10', 'valentin@rambler.ru', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', NULL, 1186963200, NULL, 'м. Львів', NULL, NULL, 'jzgdZ', 0.00, NULL, '+ 067 546 87 54'),
(5, NULL, 'Игор Петрович', '$1$SBeN16qQ$oaDnHR7lNu2RvEygOUpxq.', 'kalmar@gmail.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', NULL, 1300147200, NULL, 'г. Тверь', NULL, NULL, 'BHElK', 0.00, NULL, '054 245 64 34'),
(6, NULL, 'Валентина', '$1$mnMRiwMI$WAjrtxf8CuYzFCNKrgvvH0', 'geg@g.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1336867200, NULL, '', NULL, NULL, 'apgKh', 0.00, NULL, ''),
(7, NULL, 'Юлия', '$1$jpThhaAT$5rhMF1hVH/bU4SUboGAqY.', 'gola@go.go', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 923961600, NULL, '', NULL, NULL, 'PDO2h', 450.00, NULL, ''),
(8, NULL, 'Микола', '$1$LZwk8Zeq$FtEgH7kznQhfM/DYQp5Xt0', 'hi@hello.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1204588800, NULL, '', NULL, NULL, 'v7AL9', 372.00, NULL, ''),
(9, NULL, 'Петр', '$1$rtOiO.Kb$DoOEPmufZ0QoH6ALhIW8K/', 'go@gmail.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1179878400, NULL, '', NULL, NULL, 'DfFay', 534.61, NULL, ''),
(10, NULL, 'Юрий', '$1$7WY/C71c$yWo/60KT8o1Gpgz8NoR6g0', 'hell@hi.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1080000000, NULL, '', NULL, NULL, 'nnwHi', 1032.00, NULL, ''),
(11, NULL, 'Артур', '$1$fqe/B31z$SCEUoyGht45BD7P7sGntB1', 'joker@g.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1174608000, NULL, '', NULL, NULL, 'ZQMgY', 500.00, NULL, ''),
(12, NULL, 'Роман', '$1$Q5OGVHIL$EdIFtjfNZS0esJhNJBT4S/', 'h@g.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1139097600, NULL, '', NULL, NULL, 'vBYt5', 777.65, NULL, ''),
(13, NULL, 'Иван', '$1$NuYcOL2u$DT9IMVrhso30lkt.KjX3R0', 't@com.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1131148800, NULL, '', NULL, NULL, 'GvaoX', 39.95, NULL, ''),
(14, NULL, 'roman', '$1$O4xM5INE$xXS1VKjNGADRAQ2ECq.fb/', 'hh@f.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1103760000, NULL, '', NULL, NULL, '4vuGR', 60.99, NULL, ''),
(15, NULL, 'Степа', '$1$0URQeiKO$51AjUbMLddI89Q00wxbBd/', 'w@go.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1086307200, NULL, '', NULL, NULL, 'xjWwZ', 42.00, NULL, ''),
(16, NULL, 'Катерина', '$1$K4BWApqA$78xLQXHIxL6MjnGsXHr/40', 'd@com.ua', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 1094342400, NULL, '', NULL, NULL, 'L4TGA', 1000.00, NULL, ''),
(17, NULL, 'Валерия', '$1$K7RfsI0I$H51xxHN4K41e3bYNnwkK7/', 'q@w.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2012, 984441600, NULL, '', NULL, NULL, 'MAWZm', 1178.99, NULL, ''),
(49, 1, 'admin', '$1$Fw1.qV1.$hpzpRXISsGFCyRenafdBe1', 'ad@min.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 2013, 1379402955, NULL, '', 'a:1:{s:9:"ShopKit_1";a:4:{s:8:"instance";s:7:"ShopKit";s:5:"kitId";i:1;s:8:"quantity";i:1;s:5:"price";d:49993.269999999997;}}', NULL, 'ITgQQ', 0.00, NULL, ''),
(50, 1, 'admin', '$1$ibAAkeXH$Huxr5TSo4U6tmejt.w/kM0', 'test@admin.com', NULL, NULL, NULL, NULL, NULL, '89.112.6.86', 2013, 1380190776, NULL, '', NULL, NULL, 'Rw9W2', 0.00, NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_autologin`
--

DROP TABLE IF EXISTS `user_autologin`;
CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`),
  KEY `last_ip` (`last_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('ab1744557bc0e47cd2660144c6d948e5', 2, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36', '127.0.0.1', '2013-07-12 15:31:46'),
('a478974cf565fd296d51ace31cc09397', 48, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36', '127.0.0.1', '2013-07-24 11:54:04'),
('6fdb20c201d826e5d52949f841dbb5b7', 49, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36', '127.0.0.1', '2013-09-17 07:28:29');

-- --------------------------------------------------------

--
-- Структура таблицы `user_temp`
--

DROP TABLE IF EXISTS `user_temp`;
CREATE TABLE IF NOT EXISTS `user_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(34) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_key` varchar(50) NOT NULL,
  `last_ip` varchar(40) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `widgets`
--

DROP TABLE IF EXISTS `widgets`;
CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(15) NOT NULL,
  `data` text NOT NULL,
  `method` varchar(50) NOT NULL,
  `settings` text NOT NULL,
  `description` varchar(300) NOT NULL,
  `roles` text NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `type`, `data`, `method`, `settings`, `description`, `roles`, `created`) VALUES
(3, 'latest_news', 'module', 'core', 'recent_news', 'a:4:{s:10:"news_count";s:1:"2";s:11:"max_symdols";s:3:"140";s:10:"categories";a:1:{i:0;s:2:"69";}s:7:"display";s:6:"recent";}', 'Последние новости', '', 1291632457),
(4, 'recent_product_comments', 'module', 'comments', 'recent_product_comments', 'a:2:{s:14:"comments_count";s:1:"5";s:13:"symbols_count";s:1:"0";}', 'Последние комментарии продукта', '', 1308300371),
(5, 'tags', 'module', 'tags', 'tags_cloud', '', 'Теги', '', 1312362714),
(6, 'path', 'module', 'navigation', 'widget_navigation', '', 'Виджет навигации', '', 1328631622),
(10, 'popular_products', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:11:"popular,hit";s:5:"title";s:33:"Популярные товары";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Популярные товары', '', 1363606273),
(11, 'new_products', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:11:"popular,hot";s:5:"title";s:14:"Новинки";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Новые товары', '', 1363606324),
(12, 'action_products', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:14:"popular,action";s:5:"title";s:31:"Акционные товары";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Акционные товары', '', 1363606361),
(13, 'brands', 'module', 'shop', 'brands', 'a:4:{s:10:"withImages";b:1;s:11:"brandsCount";s:1:"8";s:7:"subpath";s:7:"widgets";s:5:"title";s:39:"Лучшие производители";}', 'Бренды', '', 1363606422),
(15, 'similar', 'module', 'shop', 'similar_products', 'a:3:{s:5:"title";s:27:"Похожие товары";s:13:"productsCount";s:1:"5";s:7:"subpath";s:7:"widgets";}', 'Похожие товары', '', 1363606582),
(28, 'popular_products_category', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:17:"date,hit,category";s:5:"title";s:16:"Popular products";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Популярная категория товара', '', 1374575193),
(27, 'ViewedProducts', 'module', 'shop', 'view_product', 'a:4:{s:12:"productsType";b:0;s:5:"title";s:14:"ViewedProducts";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Просмотренные товары', '', 1374575092),
(16, 'benefits', 'html', '<div class="container">\n<ul class="items items-benefits">\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_1">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Бесплатная</div>\n<p>доставка</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_2">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Гибкая система</div>\n<p>скидок</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_3">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Индивидуальный</div>\n<p>подход</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_4">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">высокий уровень</div>\n<p>сервиса</p>\n</div>\n</div>\n</li>\n</ul>\n</div>', '', '', 'Преимущества', '', 1371214822),
(17, 'payments_delivery_methods_info', 'html', '<div class="frame-delivery-payment"><dl><dt class="title f-s_0"><span class="icon_delivery">&nbsp;</span><span class="text-el">Доставка</span></dt><dd class="frame-list-delivery">\n<ul class="list-style-1">\n<li>Новая Почта</li>\n<li>Другие транспортные службы</li>\n<li>Курьером по Киеву</li>\n<li>Самовывоз</li>\n</ul>\n</dd><dt class="title f-s_0"><span class="icon_payment">&nbsp;</span><span class="text-el">Оплата</span></dt><dd class="frame-list-payment">\n<ul class="list-style-1">\n<li>Наличными при получении</li>\n<li>Безналичный перевод</li>\n<li>Приват 24</li>\n<li>WebMoney</li>\n</ul>\n</dd></dl></div>\n<div class="frame-phone-product">\n<div class="title f-s_0"><span class="icon_phone_product">&nbsp;</span><span class="text-el">Заказы по телефонах</span></div>\n<ul class="list-style-1">\n<li>(097) <span class="d_n">&minus;</span>567-43-21</li>\n<li>(097) <span class="d_n">&minus;</span>567-43-22</li>\n</ul>\n</div>', '', '', 'Информация о способах доставки', '', 1371821417),
(20, 'start_page_seo_text', 'html', '', '', '', '', '', 1378821714),
(29, 'schedule', 'html', '', '', '', 'график работы', '', 1416230733),
(30, 'workday', 'html', '', '', '', '', '', 1427880669),
(31, 'seo_text_footer', 'html', '', '', '', '', '', 1427880669);

-- --------------------------------------------------------

--
-- Структура таблицы `widget_i18n`
--

DROP TABLE IF EXISTS `widget_i18n`;
CREATE TABLE IF NOT EXISTS `widget_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `locale` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `widget_i18n`
--

INSERT INTO `widget_i18n` (`id`, `locale`, `title`, `data`) VALUES
(13, 'ru', 'Бренды', ''),
(16, 'ru', NULL, '<div class="benefits-title"><span class="title">Почему выбирают нас</span></div>\n<div class="container">\n<ul class="items items-benefits">\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_1">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Бесплатная доставка от 2000 р</div>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_2">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Гибкая система скидок</div>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_3">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Индивидуальный подход</div>\n</div>\n</div>\n</li>\n</ul>\n</div>'),
(17, 'ru', 'Доставка оплата на товаре', '<div class="frame-delivery-payment">\n<dl>\n<dt class="title f-s_0"><span class="icon_delivery">&nbsp;</span><span class="text-el">Доставка</span></dt>\n<dd class="frame-list-delivery">\n<ul>\n<li>Новая Почта</li>\n<li>Другие транспортные службы</li>\n<li>Курьером по Киеву</li>\n<li>Самовывоз</li>\n</ul>\n</dd>\n<dt class="title f-s_0"><span class="icon_payment">&nbsp;</span><span class="text-el">Оплата</span></dt>\n<dd class="frame-list-payment">\n<ul>\n<li>Наличными при получении</li>\n<li>Безналичный перевод</li>\n<li>Приват 24</li>\n<li>WebMoney</li>\n</ul>\n</dd>\n</dl>\n</div>'),
(20, 'ru', NULL, '<h1>Интернет-магазин</h1>\n<p>Интернет-магазин &mdash; сайт, торгующий товарами в интернете. Позволяет пользователям сформировать заказ на покупку, выбрать способ оплаты и доставки заказа в сети Интернет.</p>\n<p>Выбрав необходимые товары или услуги, пользователь обычно имеет возможность тут же на сайте выбрать метод оплаты и доставки.</p>'),
(29, 'ru', NULL, '<p><span class="c_b">Работаем:</span> <span class="s-t">Пн&ndash;Пт 09:00&ndash;20:00,<br />Сб 09:00&ndash;17:00, Вс выходной</span></p>'),
(30, 'ru', 'График', '<p>Пн&ndash;Сб 09:00&ndash;20:00,<br /> Вс 09:00&ndash;17:00</p>'),
(31, 'ru', 'Seo', '<h1>Универсальный интернет-магазин</h1>\n<p>Все больше и больше людей пользуются интернет магазинами. Поэтому если Вы или Ваша компания реализуете товар или предлагаете услуги, свое сотрудничество с клиентами Вы можете организовать продажи через интернет магазин. Интернет-магазин &ndash; это интерактивный сайт с каталогом, в котором представляются товары и услуги, а также корзиной для формирования заказа. В правильном интернет-магазине обязательно должны присутствовать: рекламируемые товары и услуги, контактная информация, предложения различных вариантов оплаты, предоставление счета. Работа интернет-магазина похожа на работу простого магазина. Посетитель интернет магазина просматривает перечень предлагаемых ему товаров или услуг, выбирает подходящую позицию и добавляет выбранный товар в свою покупательскую корзину. Далее таким же образом посетитель может выбрать еще несколько предлагаемых позиций &mdash; столько, сколько нужно. Когда все необходимые товары выбраны, можно приступать к оформлению заказа на покупку. При этом необходим минимум личной информации о покупателе, что способствует повышению безопасности покупок. Главный раздел интернет магазина это каталог товаров и услуг. Навигация по этому каталогу может быть различной в зависимости от ассортимента предлагаемых товаров и услуг.</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
