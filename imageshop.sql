-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2012 at 09:08 PM
-- Server version: 5.1.63
-- PHP Version: 5.3.2-1ubuntu4.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imageshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

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
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `position`, `name`, `title`, `short_desc`, `url`, `image`, `keywords`, `description`, `fetch_pages`, `main_tpl`, `tpl`, `page_tpl`, `per_page`, `order_by`, `sort_order`, `comments_default`, `field_group`, `category_field_group`) VALUES
(1, 0, 0, 'Главная', '', '', 'main', '', '', '', 'b:0;', '', '', '', 10, 'publish_date', 'desc', 1, 0, 0),
(56, 0, 0, 'Новости и акции', '', '', 'novosti_i_aktsii', '', '', '', 'b:0;', '', '', '', 15, 'publish_date', 'desc', 0, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_translate`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category_translate`
--


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(25) NOT NULL DEFAULT 'core',
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_site` varchar(250) NOT NULL,
  `item_id` bigint(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` int(11) NOT NULL,
  `status` smallint(1) NOT NULL,
  `agent` varchar(250) NOT NULL,
  `user_ip` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module` (`module`),
  KEY `item_id` (`item_id`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `module`, `user_id`, `user_name`, `user_mail`, `user_site`, `item_id`, `text`, `date`, `status`, `agent`, `user_ip`) VALUES
(10, 'core', 1, 'admin', 'admin@localhost.loc', '', 32, 'Первый комментарий.', 1267280509, 0, 'Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/532.8 (KHTML, like Gecko) Chrome/4.0.302.2 Safari/532.8', '127.0.0.5'),
(25, 'shop', 1, 'admin', 'admin@localhost.loc', '', 108, 'Отличный выбор!', 1328007661, 0, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.77 Safari/535.7', '127.0.0.2'),
(28, 'shop', 1, 'admin', 'admin@localhost.loc', '', 108, '&quot;&gt;', 1333614943, 0, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11', '127.0.0.2'),
(29, 'shop', 0, 'Kaero', 'grooteam@gmada.ss', '', 71, 'dasdasd', 1337863239, 0, 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:12.0) Gecko/20100101 Firefox/12.0', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE IF NOT EXISTS `components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `identif` varchar(25) NOT NULL,
  `enabled` int(1) NOT NULL,
  `autoload` int(1) NOT NULL,
  `in_menu` int(1) NOT NULL DEFAULT '0',
  `settings` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `identif` (`identif`),
  KEY `enabled` (`enabled`),
  KEY `autoload` (`autoload`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `name`, `identif`, `enabled`, `autoload`, `in_menu`, `settings`) VALUES
(1, 'user_manager', 'user_manager', 0, 0, 0, NULL),
(2, 'auth', 'auth', 1, 0, 0, NULL),
(4, 'comments', 'comments', 1, 1, 1, 'a:5:{s:18:"max_comment_length";i:550;s:6:"period";i:0;s:11:"can_comment";i:0;s:11:"use_captcha";b:0;s:14:"use_moderation";b:0;}'),
(7, 'navigation', 'navigation', 0, 0, 1, NULL),
(30, 'tags', 'tags', 1, 1, 1, NULL),
(92, 'gallery', 'gallery', 1, 0, 1, 'a:26:{s:13:"max_file_size";s:1:"5";s:9:"max_width";s:1:"0";s:10:"max_height";s:1:"0";s:7:"quality";s:2:"95";s:14:"maintain_ratio";b:1;s:19:"maintain_ratio_prev";b:1;s:19:"maintain_ratio_icon";b:1;s:4:"crop";b:0;s:9:"crop_prev";b:0;s:9:"crop_icon";b:0;s:14:"prev_img_width";s:3:"500";s:15:"prev_img_height";s:3:"500";s:11:"thumb_width";s:3:"100";s:12:"thumb_height";s:3:"100";s:14:"watermark_text";s:0:"";s:16:"wm_vrt_alignment";s:6:"bottom";s:16:"wm_hor_alignment";s:4:"left";s:19:"watermark_font_size";s:2:"14";s:15:"watermark_color";s:6:"ffffff";s:17:"watermark_padding";s:2:"-5";s:19:"watermark_font_path";s:20:"./system/fonts/1.ttf";s:15:"watermark_image";s:0:"";s:23:"watermark_image_opacity";s:2:"50";s:14:"watermark_type";s:4:"text";s:8:"order_by";s:4:"date";s:10:"sort_order";s:4:"desc";}'),
(55, 'rss', 'rss', 1, 0, 1, 'a:5:{s:5:"title";s:9:"Image CMS";s:11:"description";s:35:"Тестируем модуль RSS";s:10:"categories";a:1:{i:0;s:1:"3";}s:9:"cache_ttl";i:60;s:11:"pages_count";i:10;}'),
(72, 'imagebox', 'imagebox', 0, 1, 0, 'a:6:{s:9:"max_width";i:800;s:10:"max_height";i:600;s:11:"thumb_width";i:100;s:12:"thumb_height";i:100;s:14:"maintain_ratio";b:1;s:7:"quality";s:3:"95%";}'),
(60, 'menu', 'menu', 0, 1, 1, NULL),
(58, 'sitemap', 'sitemap', 1, 0, 1, 'a:5:{s:18:"main_page_priority";s:1:"1";s:13:"cats_priority";s:3:"0.9";s:14:"pages_priority";s:3:"0.5";s:20:"main_page_changefreq";s:6:"weekly";s:16:"pages_changefreq";s:7:"monthly";}'),
(80, 'search', 'search', 1, 0, 0, NULL),
(84, 'feedback', 'feedback', 1, 0, 0, 'a:2:{s:5:"email";s:19:"admin@localhost.loc";s:15:"message_max_len";i:550;}'),
(117, 'template_editor', 'template_editor', 0, 0, 0, NULL),
(86, 'group_mailer', 'group_mailer', 0, 0, 1, NULL),
(95, 'filter', 'filter', 1, 0, 0, NULL),
(96, 'cfcm', 'cfcm', 0, 0, 0, NULL),
(121, 'shop', 'shop', 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(35, 'О сайте', '', 'o-sajte', '', 'это, базовый, шаблон, imagecms, котором, релизованы, следующие, функции, вывод, фотогалереи, статической, статьи, блога', 'Это базовый шаблон ImageCMS, на котором релизованы следующие функции: вывод фотогалереи, вывод статической статьи, вывод блога.', '<p>Это базовый шаблон ImageCMS, на котором релизованы следующие функции: отображение фотогалереи, отображение статической статьи, отображение корпоративного блога, отображение формы обратной связи.</p>\n<p>Общий вид шаблона можно отредактировать и изменить лого, графическую вставку на свои тематические.</p>\n<p>Слева в сайдбаре Вы видите список категорий блога, который легко вставляется с помощью функции {sub_category_list()} в файле main.tpl. Также в левом сайдбаре находится форма поиска по сайту, виджет последних комментариев и виджет тегов сайта. В этот сайдбар можно также добавить виджет последних либо популярных новостей, а также любые счетчики, информеры.</p>\n<p>Верхнее меню реализовано с помощью модуля Меню. Управлять его содержимым можно из административной части в разделе Меню - Главное меню. Сюда как правило можно еще добавить страницы: о компании, контакты, услуги и т.п.</p>\n<p>За дополнительной информацией обращайтесь в официальный раздел документации: <a href="http://www.imagecms.net/wiki">http://www.imagecms.net/wiki</a></p>\n<p>Обсудить дополнительные возможности, а также вопросы по установке, настройке системы можно на официальном форуме: <a href="http://forum.imagecms.net/index.php">http://forum.imagecms.net/</a></p>', '', 0, 'page_static', '', 0, 1, 0, 'publish', 'admin', 1267203253, 1267203328, 1290100400, 8, 3, 0),
(64, 'О магазине', '', 'about', '', 'магазине', 'О магазине', '<p>Магазин ImageCMS Shop предоставляет огромный выбор техники на любой вкус по лучшим ценам.</p>\n<p>Наш магазин существует более 5 лет и за это время не было ни единого возврата товара.</p>\n<p>Мы обслуживаем ежедневно сотни покупателей и делаем это с радостью.</p>\n<p><strong>Покупайте технику у нас и становитесь обладателем лучшей в мире техники!!!</strong></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295776, 1291295792, 1291743386, 347, 3, 0),
(65, 'Оплата', '', 'oplata', '', 'оплата', 'Оплата', '<p>Наш магазин поддерживает все доступные на данный момент методы оплаты.</p>\n<p>Также действует возможность оплаты курьеру при доставке для всех крупных городов Украины и России. (возможность оплаты курьеру в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295824, 1291295836, 1291743521, 170, 3, 0),
(66, 'Доставка', '', 'dostavka', '', 'доставка', 'Доставка', '<p>Мы поддерживаем доставку службой Автомир по всему миру.</p>\n<p>Также возможна доставка курьером для всех больших городов Украины и России (возможность доставки курьером в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>\n<p>При желании Вы можете сами забрать купленный товар в наших офисах.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295844, 1291295851, 1291743683, 123, 3, 0),
(67, 'Помощь', '', 'help', '', 'помощь', 'Помощь', '<p>Для того, чтобы приобрести товар в нашем магазине, Вам нужно выполнить несколько простых шагов:</p>\n<ul>\n<li>Выбрать нужный товар, воспользовавшить навигацией слева, либо поиском.</li>\n<li>Добавить товар в корзину.</li>\n<li>Перейти в корзину, выбрать способ доставки и указать Ваши контактные данные.</li>\n<li>Подтвердить заказ и выбрать способ оплаты.</li>\n</ul>\n<p>После этого наши менеджеры свяжуться с Вами и помогут с оплатой и доставкой товара, а также проконсультируют по любому вопросу.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1291743919, 73, 3, 0),
(68, 'Контакты', '', 'contact_us', '', 'контакты', 'Контакты', '<p><strong>Горячий телефон</strong>: 0 800 80 80 800</p>\n<p><strong>Главный офис в Москве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 095 095 00 00</p>\n<p>&nbsp;</p>\n<p><strong>Главный офис в Киеве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 098 098 00 00</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295870, 1291295888, 1291744068, 67, 3, 0),
(74, 'Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok-1', 'novosti_i_aktsii/', 'windows, отримує, подарунок, сумку, ноутбука, кожен, покупець, акційних, ноутбуків, передвстановленою', 'ОС Windows отримує в подарунок сумку для ноутбука! Кожен покупець акційних ноутбуків з передвстановленою ОС Windows отримує в подарунок сумку для ноутбука!', '<p>ОС Windows отримує в подарунок сумку для ноутбука! Кожен покупець акційних ноутбуків з передвстановленою ОС Windows отримує в подарунок сумку для ноутбука!</p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336737588, 1336737588, 0, 2, 3, 0),
(73, 'Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok', 'novosti_i_aktsii/', 'windows, отримує, подарунок, сумку, ноутбука, кожен, покупець, акційних, ноутбуків, передвстановленою', 'ОС Windows отримує в подарунок сумку для ноутбука! Кожен  покупець акційних ноутбуків з передвстановленою ОС Windows отримує в  подарунок сумку для ноутбука!', '<p>ОС Windows отримує в подарунок сумку для ноутбука! Кожен  покупець акційних ноутбуків з передвстановленою ОС Windows отримує в  подарунок сумку для ноутбука!</p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336477654, 1336477654, 1336737669, 0, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `content_fields`
--

CREATE TABLE IF NOT EXISTS `content_fields` (
  `field_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `group` int(11) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL,
  `in_search` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`field_name`),
  UNIQUE KEY `field_name` (`field_name`),
  KEY `type` (`type`),
  KEY `in_search` (`in_search`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content_fields`
--

INSERT INTO `content_fields` (`field_name`, `type`, `label`, `data`, `group`, `weight`, `in_search`) VALUES
('field_field1', 'text', 'Field 1', '', 7, 1, 1),
('field_pole2', 'select', 'Pole 2', 'a:3:{s:7:"initial";s:13:"value1\nvalue2";s:9:"help_text";s:0:"";s:10:"validation";s:0:"";}', 7, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `content_fields_data`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `content_fields_data`
--

INSERT INTO `content_fields_data` (`id`, `item_id`, `item_type`, `field_name`, `data`) VALUES
(10, 74, 'page', 'field_pole2', '0'),
(9, 74, 'page', 'field_field1', ''),
(5, 72, 'page', 'field_field1', ''),
(6, 72, 'page', 'field_pole2', '0'),
(7, 73, 'page', 'field_field1', ''),
(8, 73, 'page', 'field_pole2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `content_field_groups`
--

CREATE TABLE IF NOT EXISTS `content_field_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `content_field_groups`
--

INSERT INTO `content_field_groups` (`id`, `name`, `description`) VALUES
(7, 'test', 'sdfsdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `content_permissions`
--

CREATE TABLE IF NOT EXISTS `content_permissions` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `content_permissions`
--

INSERT INTO `content_permissions` (`id`, `page_id`, `data`) VALUES
(21, 35, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}');

-- --------------------------------------------------------

--
-- Table structure for table `content_tags`
--

CREATE TABLE IF NOT EXISTS `content_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `content_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallery_albums`
--

CREATE TABLE IF NOT EXISTS `gallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `cover_id` int(11) DEFAULT '0',
  `position` int(9) DEFAULT '0',
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `tpl_file` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `created` (`created`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gallery_albums`
--

INSERT INTO `gallery_albums` (`id`, `category_id`, `name`, `description`, `cover_id`, `position`, `created`, `updated`, `tpl_file`) VALUES
(1, 1, 'new album', '', 0, 0, 1264086406, 1307538865, '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_category`
--

CREATE TABLE IF NOT EXISTS `gallery_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `cover_id` int(11) DEFAULT '0',
  `position` int(9) DEFAULT '0',
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created` (`created`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gallery_category`
--

INSERT INTO `gallery_category` (`id`, `name`, `description`, `cover_id`, `position`, `created`) VALUES
(1, 'test category', '', 0, 0, 1264086398);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `file_name` varchar(150) DEFAULT NULL,
  `file_ext` varchar(8) DEFAULT NULL,
  `file_size` varchar(20) DEFAULT NULL,
  `position` int(9) DEFAULT NULL,
  `width` int(6) DEFAULT NULL,
  `height` int(6) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `album_id`, `file_name`, `file_ext`, `file_size`, `position`, `width`, `height`, `description`, `uploaded`, `views`) VALUES
(18, 1, 'test', '.jpg', '201.3 Кб', 1, 800, 600, NULL, 1266935445, 229),
(19, 1, 'Frangipani_Flowers', '.jpg', '53.2 Кб', 2, 800, 600, NULL, 1266935848, 231),
(37, 1, 'flowers', '.jpg', '81.8 Кб', 4, 800, 600, NULL, 1307538860, 0),
(36, 1, 'winter', '.jpg', '103.1 Кб', 3, 800, 600, NULL, 1307538860, 0);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(100) NOT NULL,
  `identif` varchar(10) NOT NULL,
  `image` text NOT NULL,
  `folder` varchar(100) NOT NULL,
  `template` varchar(100) NOT NULL,
  `default` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `identif` (`identif`),
  KEY `default` (`default`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `identif`, `image`, `folder`, `template`, `default`) VALUES
(3, 'Русский', 'ru', '', 'russian', 'commerce', 1),
(30, 'Украинский', 'ua', '', 'english', 'commerce', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip_address` (`ip_address`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `username`, `message`, `date`) VALUES
(1, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1328788922),
(2, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1328884353),
(3, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1329137906),
(4, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1329213320),
(5, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1329218395),
(6, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1329321092),
(7, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1329386614),
(8, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1331835057),
(9, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1331903485),
(10, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1332148061),
(11, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1332233794),
(12, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1332325377),
(13, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1332328971),
(14, 1, 'admin', 'Установил модуль language_switch', 1332330224),
(15, 1, 'admin', 'Создал виджет language_swithcer', 1332331128),
(16, 1, 'admin', 'Удалил виджет language_swithcer', 1332331366),
(17, 1, 'admin', 'Удалил модуль language_switch', 1332331378),
(18, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1332421414),
(19, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1332496693),
(20, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1332748520),
(21, 1, 'admin', 'Создал пользователя user', 1332849604),
(22, 1, 'admin', 'Удалил пользователя user', 1332854772),
(23, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1333379757),
(24, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1333461375),
(25, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1333533522),
(26, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1333633996),
(27, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1333701261),
(28, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1333979622),
(29, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1334664573),
(30, 1, 'admin', 'Вошел в панель управления IP 127.0.0.2', 1334835786),
(31, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1336651868),
(32, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1336658719),
(33, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1336662094),
(34, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1336732290),
(35, 1, 'admin', '\n			Создал страницу\n			<a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336736882),
(36, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737315),
(37, 1, 'admin', 'Изменил язык Русский', 1336737433),
(38, 1, 'admin', 'Удалил страницу ID 69', 1336737581),
(39, 1, 'admin', '\n			Создал страницу\n			<a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/74''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737610),
(40, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737669),
(41, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1336986072),
(42, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1336987777),
(43, 1, 'admin', 'Изменил настройки сайта', 1337011518),
(44, 1, 'admin', 'Очистил кеш', 1337011527),
(45, 1, 'admin', 'Очистил кеш', 1337084965),
(46, 1, 'admin', 'Очистил кеш', 1337155730),
(47, 1, 'admin', 'Очистил кеш', 1337427423),
(48, 1, 'admin', 'Вышел из панели управления', 1337515935),
(49, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337517574),
(50, 1, 'admin', 'Вышел из панели управления', 1337517584),
(51, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337517639),
(52, 1, 'admin', 'Очистил кеш', 1337533523),
(53, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337596811),
(54, 1, 'admin', 'Вышел из панели управления', 1337597287),
(55, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337597293),
(56, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337678052),
(57, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337698985),
(58, 1, 'admin', 'Вышел из панели управления', 1337698991),
(59, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337699627),
(60, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337768262),
(61, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337773005),
(62, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337844389),
(63, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337846191),
(64, 1, 'admin', 'Очистил кеш', 1337852395),
(65, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337856238),
(66, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337863205),
(67, 1, 'admin', 'Вышел из панели управления', 1337863227),
(68, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337863396),
(69, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337929574),
(70, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1337930690),
(71, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1338306971),
(72, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1338471631),
(73, 1, 'admin', 'Вышел из панели управления', 1338471905),
(74, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1338471910),
(75, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1338544971),
(76, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1338564804),
(77, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1338635037),
(78, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1338822590),
(79, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1338993650),
(80, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1339059584),
(81, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1339068237),
(82, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1339079064),
(83, 1, 'admin', 'Очистил кеш', 1339080467),
(84, 1, 'admin', 'Изменил настройки сайта', 1339080575),
(85, 1, 'admin', 'Изменил настройки сайта', 1339081001),
(86, 1, 'admin', 'Изменил настройки сайта', 1339084127),
(87, 1, 'admin', 'Изменил настройки сайта', 1339084134),
(88, 1, 'admin', 'Изменил настройки сайта', 1339086554),
(89, 1, 'admin', 'Изменил настройки сайта', 1339086686),
(90, 1, 'admin', 'Изменил настройки сайта', 1339086700),
(91, 1, 'admin', 'Изменил настройки сайта', 1339086717),
(92, 1, 'admin', 'Изменил настройки сайта', 1339087351),
(93, 1, 'admin', 'Изменил настройки сайта', 1339087356),
(94, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1339581948),
(95, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1339582010),
(96, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1339677446),
(97, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1339694281),
(98, 1, 'admin', 'Установил модуль polls', 1339694292),
(99, 1, 'admin', 'Удалил модуль polls', 1339694481);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `main_title`, `tpl`, `expand_level`, `description`, `created`) VALUES
(1, 'main_menu', 'Главное меню', 'shop_menu', 0, '', '2012-02-07 15:34:41'),
(4, 'top_menu', 'Top menu', 'top_menu', 0, 'Menu at the top of template', '2012-05-11 14:53:24'),
(5, 'footer_menu', 'Footer menu', 'footer_menu', 0, '', '2012-05-25 11:43:06');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `menus_data`
--

INSERT INTO `menus_data` (`id`, `menu_id`, `item_id`, `item_type`, `item_image`, `roles`, `hidden`, `title`, `parent_id`, `position`, `description`, `add_data`) VALUES
(10, 1, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(8, 1, 0, 'url', '', '', 0, 'Главная', 0, 1, NULL, 'a:2:{s:3:"url";s:1:"/";s:7:"newpage";s:1:"0";}'),
(9, 1, 64, 'page', '', '', 0, 'О магазине', 0, 2, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(11, 1, 0, 'url', '', '', 0, 'Доставка', 0, 4, NULL, 'a:2:{s:3:"url";s:9:"/dostavka";s:7:"newpage";s:1:"0";}'),
(12, 1, 0, 'url', '', '', 0, 'Помощь', 0, 5, NULL, 'a:2:{s:3:"url";s:5:"/help";s:7:"newpage";s:1:"0";}'),
(13, 1, 0, 'url', '', '', 0, 'Контакты', 0, 6, NULL, 'a:2:{s:3:"url";s:11:"/contact_us";s:7:"newpage";s:1:"0";}'),
(14, 4, 0, 'url', '', '', 0, 'Главная', 0, 1, NULL, 'a:2:{s:3:"url";s:1:"/";s:7:"newpage";s:1:"0";}'),
(15, 4, 64, 'page', '', '', 0, 'О магазине', 0, 2, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(16, 4, 66, 'page', '', '', 0, 'Доставка', 0, 3, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(17, 4, 67, 'page', '', '', 0, 'Помощь', 0, 4, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(18, 4, 68, 'page', '', '', 0, 'Контакты', 0, 5, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
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
(29, 1, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(30, 1, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(31, 1, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(32, 1, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(33, 1, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(34, 4, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(35, 4, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `menu_translate`
--

INSERT INTO `menu_translate` (`id`, `item_id`, `lang_id`, `title`) VALUES
(1, 8, 3, 'Главная'),
(2, 8, 30, 'Головна'),
(3, 9, 3, 'О Магазине'),
(4, 9, 30, 'Про магазин');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `data`) VALUES
(1, 2, 'a:37:{s:9:"cp_access";s:1:"1";s:13:"cp_autoupdate";s:1:"1";s:14:"cp_page_search";s:1:"1";s:11:"lang_create";s:1:"1";s:9:"lang_edit";s:1:"1";s:11:"lang_delete";s:1:"1";s:16:"cp_site_settings";s:1:"1";s:11:"cache_clear";s:1:"1";s:11:"page_create";s:1:"1";s:9:"page_edit";s:1:"1";s:11:"page_delete";s:1:"1";s:15:"category_create";s:1:"1";s:13:"category_edit";s:1:"1";s:15:"category_delete";s:1:"1";s:14:"module_install";s:1:"1";s:16:"module_deinstall";s:1:"1";s:12:"module_admin";s:1:"1";s:13:"widget_create";s:1:"1";s:13:"widget_delete";s:1:"1";s:22:"widget_access_settings";s:1:"1";s:11:"menu_create";s:1:"1";s:9:"menu_edit";s:1:"1";s:11:"menu_delete";s:1:"1";s:11:"user_create";s:1:"1";s:21:"user_create_all_roles";s:1:"1";s:9:"user_edit";s:1:"1";s:11:"user_delete";s:1:"1";s:14:"user_view_data";s:1:"1";s:12:"roles_create";s:1:"1";s:10:"roles_edit";s:1:"1";s:12:"roles_delete";s:1:"1";s:9:"logs_view";s:1:"1";s:13:"backup_create";s:1:"1";s:15:"tinybrowser_all";s:1:"1";s:18:"tinybrowser_upload";s:1:"1";s:16:"tinybrowser_edit";s:1:"1";s:19:"tinybrowser_folders";s:1:"1";}');

-- --------------------------------------------------------

--
-- Table structure for table `propel_migration`
--

CREATE TABLE IF NOT EXISTS `propel_migration` (
  `version` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `propel_migration`
--

INSERT INTO `propel_migration` (`version`) VALUES
(1339581868);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `alt_name` varchar(50) NOT NULL,
  `desc` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`, `alt_name`, `desc`) VALUES
(1, 0, 'user', 'Пользователи', ''),
(2, 0, 'admin', 'Администраторы', '');

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(264) DEFAULT NULL,
  `datetime` int(11) DEFAULT NULL,
  `where_array` text,
  `select_array` text,
  `table_name` varchar(100) DEFAULT NULL,
  `order_by` text,
  `row_count` int(11) DEFAULT NULL,
  `total_rows` int(11) DEFAULT NULL,
  `ids` text,
  `search_title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`),
  KEY `datetime` (`datetime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `search`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(50) NOT NULL,
  `site_title` varchar(200) NOT NULL,
  `site_short_title` varchar(50) NOT NULL,
  `site_description` varchar(200) NOT NULL,
  `site_keywords` varchar(200) NOT NULL,
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
  `google_analytics_id` varchar(50) NOT NULL,
  `main_type` varchar(50) NOT NULL,
  `main_page_id` int(11) NOT NULL,
  `main_page_cat` text NOT NULL,
  `main_page_module` varchar(50) NOT NULL,
  `sidepanel` varchar(5) NOT NULL,
  `lk` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `s_name` (`s_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `site_title`, `site_short_title`, `site_description`, `site_keywords`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `google_analytics_id`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`) VALUES
(2, 'main', 'ImageCMS Shop - интернет-магазин качественной техники', 'ImageCMS Shop', 'Продажа качественной техники с гарантией и доставкой', 'магазин техники, покупка техники, доставка техники', 'auto', 'auto', '0', '0', 1, 1, '/', 'full', 'commerce', 'no', 'UA-27897209-1', 'module', 69, '56', 'shop', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_banners`
--

CREATE TABLE IF NOT EXISTS `shop_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_banners_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shop_banners`
--

INSERT INTO `shop_banners` (`id`, `position`) VALUES
(1, 19),
(3, NULL),
(4, 22);

-- --------------------------------------------------------

--
-- Table structure for table `shop_banners_i18n`
--

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
-- Dumping data for table `shop_banners_i18n`
--

INSERT INTO `shop_banners_i18n` (`id`, `locale`, `name`, `text`, `url`, `image`) VALUES
(1, 'ru', 'Samsung LN40C650 40" LCD TV', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/74', '1_ru.jpg'),
(3, 'ru', 'Panasonic KX-TG7433B Expandable', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/106', '3_ru.jpg'),
(4, 'ru', 'Samsung NX10 14 Megapixel Digital', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/98', '4_ru.jpg'),
(4, 'ua', 'Samsung NX10 14 Megapixel Digital', '<p>Високо технологічний продукт, який допоможе Вам оцінити якість.</p>', '/shop/product/98', '4_ua.jpg'),
(3, 'ua', 'Panasonic KX-TG7433B Expandable', '<p>Високо технологічний продукт, який допоможе Вам оцінити якість.</p>', '/shop/product/106', '3_ua.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_brands`
--

CREATE TABLE IF NOT EXISTS `shop_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_brands_I_2` (`url`),
  KEY `shop_brands_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `shop_brands`
--

INSERT INTO `shop_brands` (`id`, `url`, `image`) VALUES
(30, 'bravo-computers', 'bravo-computers.png'),
(31, 'samsung', 'samsung.png'),
(32, 'panasonic', NULL),
(26, 'hewlett-packard', 'hewlett-packard.png'),
(27, 'apple', 'apple.png'),
(28, 'brain', 'brain.png'),
(29, 'impression-computers', 'impression-computers.png'),
(38, 'test2', NULL),
(37, 'kaero', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_brands_i18n`
--

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
-- Dumping data for table `shop_brands_i18n`
--

INSERT INTO `shop_brands_i18n` (`id`, `locale`, `name`, `description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(31, 'ru', 'Samsung', '', '', '', ''),
(32, 'ru', 'Panasonic', '', '', '', ''),
(30, 'ru', 'Bravo Computers', '', '', '', ''),
(26, 'ru', 'Hewlett Packard', '', '', '', ''),
(27, 'ru', 'Apple', '', '', '', ''),
(28, 'ru', 'Brain', '', '', '', ''),
(29, 'ru', 'Impression Computers', '', '', '', ''),
(38, 'ru', 'test2', '', '', '', ''),
(37, 'ru', 'Kaero', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_callbacks`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `shop_callbacks`
--


-- --------------------------------------------------------

--
-- Table structure for table `shop_callbacks_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_callbacks_statuses`
--

INSERT INTO `shop_callbacks_statuses` (`id`, `is_default`) VALUES
(1, 1),
(3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_callbacks_statuses_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_callbacks_statuses_i18n_I_1` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_callbacks_statuses_i18n`
--

INSERT INTO `shop_callbacks_statuses_i18n` (`id`, `locale`, `text`) VALUES
(1, 'ru', 'Новый'),
(3, 'ru', 'Обработан');

-- --------------------------------------------------------

--
-- Table structure for table `shop_callbacks_themes`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_callbacks_themes`
--

INSERT INTO `shop_callbacks_themes` (`id`, `position`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_callbacks_themes_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_themes_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_callbacks_themes_i18n_I_1` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_callbacks_themes_i18n`
--

INSERT INTO `shop_callbacks_themes_i18n` (`id`, `locale`, `text`) VALUES
(1, 'ru', 'Первая тема'),
(1, 'ua', 'Перша тема');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

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
  PRIMARY KEY (`id`),
  KEY `shop_category_I_2` (`url`),
  KEY `shop_category_I_3` (`active`),
  KEY `shop_category_I_4` (`parent_id`),
  KEY `shop_category_I_5` (`position`),
  KEY `shop_category_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `shop_category`
--

INSERT INTO `shop_category` (`id`, `url`, `parent_id`, `position`, `full_path`, `full_path_ids`, `active`, `external_id`, `image`) VALUES
(52, 'avto_muzyka_i_video', 0, 17, 'avto_muzyka_i_video', 'a:0:{}', 1, NULL, NULL),
(51, 'bluetooth', 48, 16, 'domashniaia_elektronika/bluetooth', 'a:1:{i:0;i:48;}', 1, NULL, NULL),
(50, 'telefony', 48, 15, 'domashniaia_elektronika/telefony', 'a:1:{i:0;i:48;}', 1, NULL, NULL),
(48, 'domashniaia_elektronika', 0, 13, 'domashniaia_elektronika', 'a:0:{}', 1, NULL, NULL),
(46, 'fotoprintery', 44, 11, 'foto_i_kamery/fotoprintery', 'a:1:{i:0;i:44;}', 1, NULL, NULL),
(45, 'tsifrovye_kamery', 44, 10, 'foto_i_kamery/tsifrovye_kamery', 'a:1:{i:0;i:44;}', 1, NULL, NULL),
(44, 'foto_i_kamery', 0, 9, 'foto_i_kamery', 'a:0:{}', 1, NULL, NULL),
(43, 'saund_bary', 40, 8, 'domashnee_audio/saund_bary', 'a:1:{i:0;i:40;}', 1, NULL, NULL),
(41, 'domashnie_teatry', 40, 6, 'domashnee_audio/domashnie_teatry', 'a:1:{i:0;i:40;}', 1, NULL, NULL),
(40, 'domashnee_audio', 0, 5, 'domashnee_audio', 'a:0:{}', 1, NULL, NULL),
(36, 'video', 0, 1, 'video', 'a:0:{}', 1, NULL, NULL),
(37, 'tv_hdtv', 36, 2, 'video/tv_hdtv', 'a:1:{i:0;i:36;}', 1, NULL, NULL),
(38, 'dvd_dvr_pleery', 36, 3, 'video/dvd_dvr_pleery', 'a:1:{i:0;i:36;}', 1, NULL, NULL),
(39, 'blu-ray', 36, 4, 'video/blu-ray', 'a:1:{i:0;i:36;}', 1, NULL, NULL),
(53, 'subwoofer', 52, 18, 'avto_muzyka_i_video/subwoofer', 'a:1:{i:0;i:52;}', 1, NULL, NULL),
(54, 'cd_chendzhery', 52, 19, 'avto_muzyka_i_video/cd_chendzhery', 'a:1:{i:0;i:52;}', 1, NULL, NULL),
(55, 'gps', 52, 20, 'avto_muzyka_i_video/gps', 'a:1:{i:0;i:52;}', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_category_i18n`
--

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
-- Dumping data for table `shop_category_i18n`
--

INSERT INTO `shop_category_i18n` (`id`, `locale`, `name`, `h1`, `description`, `meta_desc`, `meta_title`, `meta_keywords`) VALUES
(52, 'ru', 'Авто музыка и видео', '', '', '', '', ''),
(51, 'ru', 'Bluetooth', '', '', '', '', ''),
(50, 'ru', 'Телефоны', '', '', '', '', ''),
(48, 'ru', 'Домашняя электроника', '', '', '', '', ''),
(46, 'ru', 'Фотопринтеры', '', '', '', '', ''),
(45, 'ru', 'Цифровые камеры', '', '', '', '', ''),
(44, 'ru', 'Фото и камеры', '', '', '', '', ''),
(43, 'ru', 'Спикеры', '', '', '', '', ''),
(41, 'ru', 'Домашние театры', '', '', '', '', ''),
(40, 'ru', 'Домашнее аудио', '', '', '', '', ''),
(36, 'ru', 'Видео', '', '', '', '', ''),
(37, 'ru', 'TV & HDTV русс', 'H1 Рус', '<p><span style="color: #384654; font-size: 13px; text-align: right; background-color: #f8f8f8;">Описание русс</span></p>', 'Meta Description русс', 'Meta Title русс', 'Meta Keywords русс'),
(38, 'ru', 'DVD/DVR Плееры', '', '', '', '', ''),
(39, 'ru', 'Blu-Ray Плееры', '', '', '', '', ''),
(53, 'ru', 'Сабвуферы', '', '', '', '', ''),
(54, 'ru', 'CD Ченджеры', '', '', '', '', ''),
(55, 'ru', 'GPS', '', '', '', '', ''),
(37, 'ua', 'TV & HDTV укр', 'H1 укр', '<p><span style="color: #384654; font-size: 13px; text-align: right; background-color: #f8f8f8;">Описание&nbsp;</span>укр</p>', 'Meta Description укр', 'Meta Title укр', 'Meta Keywords укр');

-- --------------------------------------------------------

--
-- Table structure for table `shop_currencies`
--

CREATE TABLE IF NOT EXISTS `shop_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `main` tinyint(1) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `symbol` varchar(5) DEFAULT NULL,
  `rate` float(6,3) DEFAULT '1.000',
  PRIMARY KEY (`id`),
  KEY `shop_currencies_I_1` (`name`),
  KEY `shop_currencies_I_2` (`main`),
  KEY `shop_currencies_I_3` (`is_default`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_currencies`
--

INSERT INTO `shop_currencies` (`id`, `name`, `main`, `is_default`, `code`, `symbol`, `rate`) VALUES
(1, 'Доллары', 0, 0, 'USD', '$', 0.400),
(2, 'Рубли', 1, 1, 'RUR', 'руб', 1.000);

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_methods`
--

CREATE TABLE IF NOT EXISTS `shop_delivery_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` float(10,2) NOT NULL,
  `free_from` float(10,2) NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `is_price_in_percent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_delivery_methods_I_2` (`enabled`),
  KEY `shop_delivery_methods_I_1` (`enabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `shop_delivery_methods`
--

INSERT INTO `shop_delivery_methods` (`id`, `price`, `free_from`, `enabled`, `is_price_in_percent`) VALUES
(7, 0.00, 0.00, 1, 0),
(5, 0.00, 0.00, 1, 0),
(6, 0.00, 0.00, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_methods_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_delivery_methods_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_delivery_methods_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_delivery_methods_i18n`
--

INSERT INTO `shop_delivery_methods_i18n` (`id`, `locale`, `name`, `description`) VALUES
(7, 'ru', 'Самовывоз', ''),
(5, 'ru', 'Курьером', '<p>Только по Киеву и Москве</p>'),
(6, 'ru', 'АвтоМир', '<p>Доставка по всему миру</p>'),
(7, 'ua', 'Самовивезення', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_methods_systems`
--

CREATE TABLE IF NOT EXISTS `shop_delivery_methods_systems` (
  `delivery_method_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  PRIMARY KEY (`delivery_method_id`,`payment_method_id`),
  KEY `shop_delivery_methods_systems_FI_2` (`payment_method_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_delivery_methods_systems`
--

INSERT INTO `shop_delivery_methods_systems` (`delivery_method_id`, `payment_method_id`) VALUES
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_discounts`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `shop_discounts`
--

INSERT INTO `shop_discounts` (`id`, `name`, `active`, `date_start`, `date_stop`, `discount`, `min_price`, `max_price`, `categories`, `products`, `description`, `user_group`) VALUES
(4, 'Скидка на Видео технику', 1, 1293829200, 1309377600, '10%', 0.00, 0.00, 'a:3:{i:0;s:2:"37";i:1;s:2:"38";i:2;s:2:"39";}', '', '<p>Скидка на Видео технику в размере 10%</p>', 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `shop_kit`
--

CREATE TABLE IF NOT EXISTS `shop_kit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_kit_FI_1` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shop_kit`
--


-- --------------------------------------------------------

--
-- Table structure for table `shop_kit_product`
--

CREATE TABLE IF NOT EXISTS `shop_kit_product` (
  `product_id` int(11) NOT NULL,
  `kit_id` int(11) NOT NULL,
  `discount` varchar(11) DEFAULT '0',
  PRIMARY KEY (`product_id`,`kit_id`),
  KEY `shop_kit_product_FI_2` (`kit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_kit_product`
--


-- --------------------------------------------------------

--
-- Table structure for table `shop_notifications`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shop_notifications`
--


-- --------------------------------------------------------

--
-- Table structure for table `shop_notification_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_notification_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_notification_statuses_I_2` (`position`),
  KEY `shop_notification_statuses_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_notification_statuses`
--

INSERT INTO `shop_notification_statuses` (`id`, `position`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shop_notification_statuses_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_notification_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_notification_statuses_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_notification_statuses_i18n`
--

INSERT INTO `shop_notification_statuses_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Новый'),
(2, 'ru', 'Выполнен');

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

CREATE TABLE IF NOT EXISTS `shop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `shop_orders_I_1` (`key`),
  KEY `shop_orders_I_2` (`status`),
  KEY `shop_orders_I_3` (`date_created`),
  KEY `shop_orders_FI_1` (`delivery_method`),
  KEY `shop_orders_FI_2` (`payment_method`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`id`, `key`, `delivery_method`, `delivery_price`, `status`, `paid`, `user_full_name`, `user_email`, `user_phone`, `user_deliver_to`, `user_comment`, `date_created`, `date_updated`, `user_ip`, `user_id`, `payment_method`, `total_price`) VALUES
(1, '9y6z99576n', 5, 0.00, 1, NULL, 'Administrator', 'admin@example.com', '', 'Тестер Siteimage', '', 1336662355, 1336662355, '127.0.0.1', 1, 1, 219.99),
(9, '', 0, 0.00, 1, 0, 'Полное Имя', 'dasd', '', 'Улица', '', 1338822604, 1338822604, NULL, NULL, 0, NULL),
(4, '6niq064559', 7, 0.00, 1, NULL, 'Administrator', 'admin@example.com', '', '', '', 1337695305, 1337695305, '127.0.0.1', 1, 1, 2799.97),
(7, '8510ub81h3', 5, 0.00, 2, 1, 'Administrator', 'admin@localhost.loc', '', '', '', 1337850902, 1337850902, '127.0.0.1', 1, 4, 1697.99);

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders_products`
--

CREATE TABLE IF NOT EXISTS `shop_orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `variant_name` varchar(255) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `kit_id` int(11) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_orders_products_I_1` (`order_id`),
  KEY `shop_orders_products_FI_1` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `shop_orders_products`
--

INSERT INTO `shop_orders_products` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `price`, `quantity`, `kit_id`, `is_main`) VALUES
(1, 1, 108, 119, 'Plantronics CS55 Wireless Earset', '', 219.99, 1, NULL, NULL),
(7, 4, 72, 83, 'LG 47LD450 - 47" Widescreen 1080p LCD HDTV', '', 999.99, 1, NULL, NULL),
(8, 4, 73, 84, 'Panasonic Viera TC-L42U22 42', '', 899.99, 1, NULL, NULL),
(9, 4, 74, 85, 'Samsung LN40C650 40" LCD TV', '', 899.99, 1, NULL, NULL),
(13, 7, 75, 86, 'Calypso CLP-32LC1A 32" LCD 720p LCD', '', 299.00, 1, NULL, NULL),
(14, 7, 72, 83, 'LG 47LD450 - 47" Widescreen 1080p LCD HDTV', '', 999.99, 1, NULL, NULL),
(15, 7, 76, 87, 'Calypso CLP-32LE110 32 русс', 'Красный', 399.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders_status_history`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `shop_orders_status_history`
--

INSERT INTO `shop_orders_status_history` (`id`, `order_id`, `status_id`, `user_id`, `date_created`, `comment`) VALUES
(7, 7, 2, 1, 1337851929, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_order_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_order_statuses_I_2` (`position`),
  KEY `shop_order_statuses_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shop_order_statuses`
--

INSERT INTO `shop_order_statuses` (`id`, `position`) VALUES
(1, 1),
(2, 99);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_statuses_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_order_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_order_statuses_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_order_statuses_i18n`
--

INSERT INTO `shop_order_statuses_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Новый'),
(2, 'ru', 'Доставлен');

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment_methods`
--

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
-- Dumping data for table `shop_payment_methods`
--

INSERT INTO `shop_payment_methods` (`id`, `active`, `currency_id`, `position`, `payment_system_name`) VALUES
(1, 1, 1, 1, 'WebMoneySystem'),
(2, 1, 2, 2, 'OschadBankInvoiceSystem'),
(3, 1, 2, 3, 'SberBankInvoiceSystem'),
(4, 1, 2, 4, 'RobokassaSystem');

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment_methods_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_payment_methods_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_payment_methods_i18n_I_1` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_payment_methods_i18n`
--

INSERT INTO `shop_payment_methods_i18n` (`id`, `locale`, `name`, `description`) VALUES
(1, 'ru', 'Оплата курьеру', '<p>Оплата через веб-моней</p>'),
(2, 'ru', 'Оплата через Банк', '<p>Оплата через ОщадБанк Украины</p>'),
(3, 'ru', 'СберБанк России', '<p>Оплата через СберБанк России</p>'),
(4, 'ru', 'Robokassa', '<p>Оплата с помощью Robokassa</p>');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

CREATE TABLE IF NOT EXISTS `shop_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `hit` tinyint(1) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `related_products` varchar(255) DEFAULT NULL,
  `mainImage` varchar(255) DEFAULT NULL,
  `smallImage` varchar(255) DEFAULT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `old_price` float(10,2) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `hot` tinyint(1) DEFAULT NULL,
  `action` tinyint(1) DEFAULT NULL,
  `added_to_cart_count` int(11) DEFAULT NULL,
  `enable_comments` tinyint(1) DEFAULT '1',
  `external_id` varchar(255) DEFAULT NULL,
  `mainModImage` varchar(255) DEFAULT NULL,
  `smallModImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_products_I_2` (`url`),
  KEY `shop_products_I_3` (`brand_id`),
  KEY `shop_products_I_4` (`category_id`),
  KEY `shop_products_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `url`, `active`, `hit`, `brand_id`, `category_id`, `related_products`, `mainImage`, `smallImage`, `created`, `updated`, `old_price`, `views`, `hot`, `action`, `added_to_cart_count`, `enable_comments`, `external_id`, `mainModImage`, `smallModImage`) VALUES
(71, '71', 1, NULL, 28, 37, '74,72,73', '71_main.jpg', '71_small.jpg', 1307542725, 1337881902, 1150.00, 62, 1, 1, 1, 1, NULL, '71_mainMod.jpg', '71_smallMod.jpg'),
(72, '72', 1, NULL, 27, 37, '', '72_main.jpg', '72_small.jpg', 1307542324, 1337930724, 0.00, 26, 1, 1, 6, 1, NULL, '72_mainMod.jpg', '72_smallMod.jpg'),
(73, '73', 1, NULL, 30, 37, '', '73_main.jpg', '73_small.jpg', 1307541561, 1337883015, 0.00, 28, 1, 0, 4, 1, NULL, '73_mainMod.jpg', '73_smallMod.jpg'),
(74, '74', 1, 1, 31, 37, '', '74_main.jpg', '74_small.jpg', 1307543711, 1337881567, 0.00, 57, 0, 0, 3, 1, NULL, '74_mainMod.jpg', '74_smallMod.jpg'),
(75, '75', 1, 1, 31, 37, '', '75_main.jpg', '75_small.jpg', 1307544631, 1337883138, 0.00, 97, 1, NULL, 3, 1, NULL, '75_mainMod.jpg', '75_smallMod.jpg'),
(76, '76', 1, NULL, 0, 37, '84,73', '76_main.jpg', '76_small.jpg', 1307543917, 1339696940, 0.00, 390, 1, 1, 4, 1, NULL, '76_mainMod.jpg', '76_smallMod.jpg'),
(96, '96', 1, 1, 0, 45, '', '96_main.jpg', '96_small.jpg', 1307542081, 1337885246, 0.00, 2, NULL, NULL, NULL, 1, NULL, '96_mainMod.jpg', '96_smallMod.jpg'),
(77, '77', 1, NULL, 0, 38, '', '77_main.jpg', '77_small.jpg', 1307542980, 1337931461, 0.00, 7, NULL, NULL, NULL, 1, NULL, '77_mainMod.jpg', '77_smallMod.jpg'),
(78, '78', 1, NULL, 0, 38, '', '78_main.jpg', '78_small.jpg', 1307543572, 1337883493, 0.00, 2, NULL, NULL, 2, 1, NULL, '78_mainMod.jpg', '78_smallMod.jpg'),
(79, '79', 1, NULL, 0, 38, '', '79_main.jpg', '79_small.jpg', 1307544450, 1337883384, 0.00, 1, NULL, NULL, NULL, 1, NULL, '79_mainMod.jpg', '79_smallMod.jpg'),
(80, '80', 1, NULL, 26, 38, '', '80_main.jpg', '80_small.jpg', 1307544569, 1338550178, 0.00, 5, NULL, NULL, 1, 1, NULL, '80_mainMod.jpg', '80_smallMod.jpg'),
(81, '81', 1, NULL, 30, 38, '', '81_main.jpg', '81_small.jpg', 1307544442, 1338549975, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '81_mainMod.jpg', '81_smallMod.jpg'),
(82, '82', 1, NULL, 0, 39, '', '82_main.jpg', '82_small.jpg', 1307542064, 1337884172, 0.00, 5, NULL, NULL, NULL, 1, NULL, '82_mainMod.jpg', '82_smallMod.jpg'),
(83, '83', 1, NULL, 0, 39, '', '83_main.jpg', '83_small.jpg', 1307545378, 1337884074, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '83_mainMod.jpg', '83_smallMod.jpg'),
(84, '84', 1, NULL, 0, 39, '', '84_main.jpg', '84_small.jpg', 1307541602, 1337883993, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '84_mainMod.jpg', '84_smallMod.jpg'),
(85, '85', 1, NULL, 0, 39, '', '85_main.jpg', '85_small.jpg', 1307544238, 1337883847, 0.00, 5, NULL, NULL, NULL, 1, NULL, '85_mainMod.jpg', '85_smallMod.jpg'),
(86, '86', 1, NULL, 0, 39, '', '86_main.jpg', '86_small.jpg', 1307545023, 1337883763, 0.00, 1, NULL, NULL, NULL, 1, NULL, '86_mainMod.jpg', '86_smallMod.jpg'),
(87, '87', 1, NULL, 0, 41, '', '87_main.jpg', '87_small.jpg', 1307541766, 1337884534, 0.00, 16, NULL, NULL, NULL, 1, NULL, '87_mainMod.jpg', '87_smallMod.jpg'),
(88, '88', 1, NULL, 0, 41, '', '88_main.jpg', '88_small.jpg', 1307544977, 1337884469, 0.00, 1, NULL, NULL, NULL, 1, NULL, '88_mainMod.jpg', '88_smallMod.jpg'),
(95, '95', 1, NULL, 0, 45, '', '95_main.jpg', '95_small.jpg', 1307542081, 1337885304, 0.00, 4, NULL, NULL, NULL, 1, NULL, '95_mainMod.jpg', '95_smallMod.jpg'),
(89, '89', 1, NULL, 0, 41, '', '89_main.jpg', '89_small.jpg', 1307541636, 1337884382, 0.00, 1, NULL, NULL, NULL, 1, NULL, '89_mainMod.jpg', '89_smallMod.jpg'),
(90, '90', 1, NULL, 0, 41, '', '90_main.jpg', '90_small.jpg', 1307543337, 1337884302, 0.00, 3, NULL, NULL, NULL, 1, NULL, '90_mainMod.jpg', '90_smallMod.jpg'),
(91, '91', 1, NULL, 0, 41, '', '91_main.jpg', '91_small.jpg', 1307544214, 1337884258, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '91_mainMod.jpg', '91_smallMod.jpg'),
(92, '92', 1, NULL, 0, 43, '', '92_main.jpg', '92_small.jpg', 1307544791, 1337884861, 0.00, 1, NULL, NULL, NULL, 1, NULL, '92_mainMod.jpg', '92_smallMod.jpg'),
(93, '93', 1, NULL, 0, 43, '', '93_main.jpg', '93_small.jpg', 1307542628, 1337884821, 0.00, 1, NULL, NULL, NULL, 1, NULL, '93_mainMod.jpg', '93_smallMod.jpg'),
(94, '94', 1, NULL, 0, 43, '', '94_main.jpg', '94_small.jpg', 1307544425, 1337884748, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '94_mainMod.jpg', '94_smallMod.jpg'),
(97, '97', 1, NULL, 0, 45, '', '97_main.jpg', '97_small.jpg', 1307541628, 1337885206, 0.00, 2, NULL, NULL, NULL, 1, NULL, '97_mainMod.jpg', '97_smallMod.jpg'),
(98, '98', 1, 1, 0, 45, '', '98_main.jpg', '98_small.jpg', 1307542730, 1337885026, 0.00, 14, NULL, NULL, NULL, 1, NULL, '98_mainMod.jpg', '98_smallMod.jpg'),
(99, '99', 1, NULL, 0, 45, '', '99_main.jpg', '99_small.jpg', 1307543877, 1337884953, 0.00, 1, NULL, NULL, NULL, 1, NULL, '99_mainMod.jpg', '99_smallMod.jpg'),
(100, '100', 1, NULL, 0, 46, '', '100_main.jpg', '100_small.jpg', 1307543018, 1337885677, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '100_mainMod.jpg', '100_smallMod.jpg'),
(101, '101', 1, NULL, 0, 46, '', '101_main.jpg', '101_small.jpg', 1307543107, 1337885614, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '101_mainMod.jpg', '101_smallMod.jpg'),
(102, '102', 1, NULL, 0, 46, '', '102_main.jpg', '102_small.jpg', 1307545161, 1337885576, 0.00, 7, NULL, NULL, NULL, 1, NULL, '102_mainMod.jpg', '102_smallMod.jpg'),
(103, '103', 1, NULL, 0, 46, '', '103_main.jpg', '103_small.jpg', 1307543901, 1337885481, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '103_mainMod.jpg', '103_smallMod.jpg'),
(104, '104', 1, NULL, 0, 46, '', '104_main.jpg', '104_small.jpg', 1307543227, 1337885425, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '104_mainMod.jpg', '104_smallMod.jpg'),
(105, '105', 1, NULL, 0, 50, '', '105_main.jpg', '105_small.jpg', 1307543429, 1337886062, 0.00, 2, NULL, NULL, NULL, 1, NULL, '105_mainMod.jpg', '105_smallMod.jpg'),
(106, '106', 1, 1, 0, 50, '', '106_main.jpg', '106_small.jpg', 1307543089, 1337885998, 0.00, 13, NULL, NULL, 1, 1, NULL, '106_mainMod.jpg', '106_smallMod.jpg'),
(107, '107', 1, NULL, 0, 50, '', '107_main.jpg', '107_small.jpg', 1307541701, 1337885945, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '107_mainMod.jpg', '107_smallMod.jpg'),
(108, '108', 1, 1, 0, 50, '', '108_main.jpg', '108_small.jpg', 1307544069, 1337885840, 0.00, 125, NULL, NULL, 4, 1, NULL, '108_mainMod.jpg', '108_smallMod.jpg'),
(109, '109', 1, NULL, 0, 50, '', '109_main.jpg', '109_small.jpg', 1307544627, 1337885755, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '109_mainMod.jpg', '109_smallMod.jpg'),
(110, '110', 1, NULL, 0, 51, '', '110_main.jpg', '110_small.jpg', 1307543831, 1337886363, 0.00, 5, NULL, NULL, 2, 1, NULL, '110_mainMod.jpg', '110_smallMod.jpg'),
(111, '111', 1, NULL, 0, 51, '', '111_main.jpg', '111_small.jpg', 1307543077, 1337886318, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '111_mainMod.jpg', '111_smallMod.jpg'),
(112, '112', 1, NULL, 0, 51, '', '112_main.jpg', '112_small.jpg', 1307543753, 1337886243, 0.00, 5, NULL, NULL, 1, 1, NULL, '112_mainMod.jpg', '112_smallMod.jpg'),
(113, '113', 1, NULL, 0, 51, '', '113_main.jpg', '113_small.jpg', 1307542831, 1337886210, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '113_mainMod.jpg', '113_smallMod.jpg'),
(114, '114', 1, NULL, 0, 51, '', '114_main.jpg', '114_small.jpg', 1307543699, 1337886165, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '114_mainMod.jpg', '114_smallMod.jpg'),
(115, '115', 1, NULL, 0, 53, '', '115_main.jpg', '115_small.jpg', 1307543689, 1337886710, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '115_mainMod.jpg', '115_smallMod.jpg'),
(116, '116', 1, NULL, 0, 53, '', '116_main.jpg', '116_small.jpg', 1307542992, 1337886664, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '116_mainMod.jpg', '116_smallMod.jpg'),
(117, '117', 1, NULL, 0, 53, '', '117_main.jpg', '117_small.jpg', 1307542495, 1337886566, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '117_mainMod.jpg', '117_smallMod.jpg'),
(118, '118', 1, NULL, 0, 53, '', '118_main.jpg', '118_small.jpg', 1307543269, 1337886505, 0.00, 1, NULL, NULL, NULL, 1, NULL, '118_mainMod.jpg', '118_smallMod.jpg'),
(119, '119', 1, 1, 0, 53, '', '119_main.jpg', '119_small.jpg', 1307543316, 1337886463, 0.00, 7, NULL, NULL, NULL, 1, NULL, '119_mainMod.jpg', '119_smallMod.jpg'),
(120, '120', 1, NULL, 0, 54, '', '120_main.jpg', '120_small.jpg', 1307542029, 1337887579, 0.00, 1, NULL, NULL, NULL, 1, NULL, '120_mainMod.jpg', '120_smallMod.jpg'),
(121, '121', 1, NULL, 0, 54, '', '121_main.jpg', '121_small.jpg', 1307543909, 1337887020, 0.00, 4, NULL, NULL, NULL, 1, NULL, '121_mainMod.jpg', '121_smallMod.jpg'),
(122, '122', 1, NULL, 0, 54, '', '122_main.jpg', '122_small.jpg', 1307543511, 1337886968, 0.00, 1, NULL, NULL, NULL, 1, NULL, '122_mainMod.jpg', '122_smallMod.jpg'),
(123, '123', 1, NULL, 0, 54, '', '123_main.jpg', '123_small.jpg', 1307543925, 1337886912, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '123_mainMod.jpg', '123_smallMod.jpg'),
(124, '124', 1, NULL, 0, 54, '', '124_main.jpg', '124_small.jpg', 1307542680, 1337886835, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '124_mainMod.jpg', '124_smallMod.jpg'),
(125, '125', 1, NULL, 0, 55, '', '125_main.jpg', '125_small.jpg', 1307542859, 1337887433, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '125_mainMod.jpg', '125_smallMod.jpg'),
(126, '126', 1, NULL, 0, 55, '', '126_main.jpg', '126_small.jpg', 1307545111, 1337887374, 0.00, 1, NULL, NULL, NULL, 1, NULL, '126_mainMod.jpg', '126_smallMod.jpg'),
(127, '127', 1, NULL, 0, 55, '', '127_main.jpg', '127_small.jpg', 1307541663, 1337887330, 0.00, 1, NULL, NULL, NULL, 1, NULL, '127_mainMod.jpg', '127_smallMod.jpg'),
(128, '128', 1, NULL, 0, 36, '', '128_main.jpg', '128_small.jpg', 1307543046, 1328721887, 0.00, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(129, '129', 1, NULL, 0, 55, '', '129_main.jpg', '129_small.jpg', 1307542398, 1337887298, 0.00, 55, NULL, NULL, NULL, 1, NULL, '129_mainMod.jpg', '129_smallMod.jpg'),
(184, '184', 1, NULL, 30, 37, '', '184_main.jpg', '184_small.jpg', 1337935898, 1337935920, 0.00, 1, NULL, NULL, NULL, 1, NULL, '184_mainMod.jpg', '184_smallMod.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_i18n`
--

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
-- Dumping data for table `shop_products_i18n`
--

INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(71, 'ru', 'Sony KDL46EX710 46" LCD 1080p HDTV', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(72, 'ru', 'LG 47LD450 - 47" Widescreen 1080p LCD HDTV', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(73, 'ru', 'Panasonic Viera TC-L42U22 42" LCD TV', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(74, 'ru', 'Samsung LN40C650 40" LCD TV', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br />На все продукты мы предоставляем гарантию качества.<br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', '', ''),
(75, 'ru', 'Calypso CLP-32LC1A 32" LCD 720p LCD', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(76, 'ru', 'Calypso CLP-32LE110 32" LED 720p HDTV111', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br />На все продукты мы предоставляем гарантию качества.<br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(96, 'ru', 'Canon VIXIA HF R11 Digital', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(77, 'ru', 'Sony EXTERNAL DVDIRECT DVD', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(78, 'ru', 'Panasonic DVD-S58 DVD Player', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(79, 'ru', 'Panasonic DVD-S38 DVD', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(80, 'ru', 'LG DN898 DVD Player', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(81, 'ru', 'Samsung DVD-H1080 - 1080p1', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(82, 'ru', 'Samsung BD-C5500 Blu-ray', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(83, 'ru', 'Sony BDP-S470 Network', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(84, 'ru', 'Panasonic DMP-BD45 Ultra-Fast', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(85, 'ru', 'LG BD570 Network Audio', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(86, 'ru', 'Samsung BD-C6900 1080p 3D Blu-ray', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(87, 'ru', 'Sony HT-SS370 Home Theater', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(88, 'ru', 'Samsung HW-C770BS 7.1 Channel', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(95, 'ru', 'Canon EOS Rebel T2i 18 Megapixel Digital', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(89, 'ru', 'Panasonic SCPTX7 Home Theater', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(90, 'ru', 'Samsung HT-C7530W 5.1 Channel', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(91, 'ru', 'Sony BDV-E770W Home Theater', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(92, 'ru', 'Samsung HW-C700 7.2 Channel', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(93, 'ru', 'Yamaha HS80M Powered Speaker', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(94, 'ru', 'Yamaha NSIW760 Speaker', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(97, 'ru', 'Sony Handycam HDR-CX3', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(98, 'ru', 'Samsung NX10 14 Megapixel Digital', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(99, 'ru', 'Samsung NX100 Interchangeable Lens', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(100, 'ru', 'Canon PIXMA iP100 Photo Printer', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(101, 'ru', 'Canon PIXMA iP4820 Premium', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(102, 'ru', 'Epson Stylus R1900 Photo Printer', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(103, 'ru', 'Epson Stylus C88+ Inkjet Printer', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(104, 'ru', 'Epson Stylus Photo R2880 Color', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(105, 'ru', 'Panasonic KX-TG6582T Cordless Phone', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(106, 'ru', 'Panasonic KX-TG7433B Expandable', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(107, 'ru', 'Plantronics CS70N Wireless Earset', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(108, 'ru', 'Plantronics CS55 Wireless Earset', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(109, 'ru', 'Panasonic KX-TG6445 Cordless Phone', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(110, 'ru', 'Motorola H720 Earset - Mono', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(111, 'ru', 'Plantronics Discovery 665 Wireless', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(112, 'ru', 'Motorola H270 Bluetooth Headset', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(113, 'ru', 'LG HBM-210 Bluetooth Headset', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(114, 'ru', 'Samsung AWEP450PBECSTA Bluetooth Headset Black', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(115, 'ru', 'Pioneer TS-SW3041D Shallow-Mount Subwoofer', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(116, 'ru', 'Pyle PLT-AB8 Subwoofer - PLTAB8', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(117, 'ru', 'Pyle PLSQ10D Red Label Square', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(118, 'ru', 'Pioneer TS-W251R Subwoofer', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(119, 'ru', 'Pioneer TSSW2541D Subwoofer', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(120, 'ru', 'Pioneer JD-1212S 12-disc CD', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(121, 'ru', 'Pioneer JD-612V 6-disc CD Magazine', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(122, 'ru', 'Panasonic CX-DP880U 8-Disc', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(123, 'ru', 'JVC - XCM200 - 12-Disc CD', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(124, 'ru', 'JVC - CHX1500RF - FM Modulation', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(125, 'ru', 'Garmin Forerunner 305 Portable Navigator', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(126, 'ru', 'Garmin Forerunner 205 Portable', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(127, 'ru', 'TomTom XXL 540 S Portable GPS System', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(128, 'ru', 'TOMTOM XL 350 Automobile', '', '', '', '', ''),
(129, 'ru', 'TOMTOM XXL 550M Automobile Portable Navigator', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(76, 'ua', 'Calypso CLP-32LE110 32 укр', '', '', '', '', ''),
(73, 'ua', 'Panasonic Viera TC-L42U22 42 укр', '', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br /><br />Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br /><br />На все продукты мы предоставляем гарантию качества.<br /><br />Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>', '', '', ''),
(184, 'ru', 'test1', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_rating`
--

CREATE TABLE IF NOT EXISTS `shop_products_rating` (
  `product_id` int(11) NOT NULL,
  `votes` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_products_rating`
--

INSERT INTO `shop_products_rating` (`product_id`, `votes`, `rating`) VALUES
(71, 1, 2),
(81, 1, 5),
(88, 1, 1),
(76, 3, 11),
(82, 1, 4),
(77, 2, 7),
(73, 1, 2),
(108, 1, 2),
(72, 1, 5),
(74, 1, 3),
(75, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `shop_product_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_product_categories`
--

INSERT INTO `shop_product_categories` (`product_id`, `category_id`) VALUES
(71, 36),
(71, 37),
(72, 36),
(72, 37),
(73, 36),
(73, 37),
(74, 36),
(74, 37),
(75, 36),
(75, 37),
(76, 36),
(76, 37),
(77, 36),
(77, 38),
(78, 36),
(78, 38),
(79, 36),
(79, 38),
(80, 36),
(80, 38),
(81, 36),
(81, 38),
(82, 36),
(82, 39),
(83, 36),
(83, 39),
(84, 36),
(84, 39),
(85, 36),
(85, 39),
(86, 36),
(86, 39),
(87, 40),
(87, 41),
(88, 40),
(88, 41),
(89, 40),
(89, 41),
(90, 40),
(90, 41),
(91, 40),
(91, 41),
(92, 40),
(92, 43),
(93, 40),
(93, 43),
(94, 40),
(94, 43),
(95, 44),
(95, 45),
(96, 44),
(96, 45),
(97, 44),
(97, 45),
(98, 44),
(98, 45),
(99, 44),
(99, 45),
(100, 44),
(100, 46),
(101, 44),
(101, 46),
(102, 44),
(102, 46),
(103, 44),
(103, 46),
(104, 44),
(104, 46),
(105, 48),
(105, 50),
(106, 48),
(106, 50),
(107, 48),
(107, 50),
(108, 48),
(108, 50),
(109, 48),
(109, 50),
(110, 48),
(110, 51),
(111, 48),
(111, 51),
(112, 48),
(112, 51),
(113, 48),
(113, 51),
(114, 48),
(114, 51),
(115, 52),
(115, 53),
(116, 53),
(117, 52),
(117, 53),
(118, 52),
(118, 53),
(119, 48),
(119, 53),
(120, 54),
(121, 54),
(122, 54),
(123, 52),
(123, 54),
(124, 52),
(124, 54),
(125, 52),
(125, 55),
(126, 52),
(126, 55),
(127, 52),
(127, 55),
(128, 36),
(128, 52),
(129, 52),
(129, 55),
(184, 37);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_images`
--

CREATE TABLE IF NOT EXISTS `shop_product_images` (
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`image_name`),
  KEY `shop_product_images_I_1` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_product_images`
--

INSERT INTO `shop_product_images` (`product_id`, `image_name`, `position`) VALUES
(71, '71_0.jpg', 0),
(71, '71_1.jpg', 1),
(71, '71_2.jpg', 2),
(72, '72_0.jpg', 0),
(72, '72_1.jpg', 1),
(72, '72_2.jpg', 2),
(74, '74_0.jpg', 0),
(74, '74_1.jpg', 1),
(74, '74_2.jpg', 2),
(81, '81_0.jpg', 0),
(81, '81_1.jpg', 1),
(76, '76_0.jpg', 0),
(76, '76_1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `csv_name` varchar(50) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `show_in_compare` tinyint(1) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `data` text,
  `show_on_site` tinyint(1) DEFAULT NULL,
  `multiple` tinyint(1) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `show_in_filter` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_properties_I_2` (`active`),
  KEY `shop_product_properties_I_3` (`show_on_site`),
  KEY `shop_product_properties_I_4` (`show_in_compare`),
  KEY `shop_product_properties_I_5` (`position`),
  KEY `shop_product_properties_I_1` (`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `shop_product_properties`
--

INSERT INTO `shop_product_properties` (`id`, `csv_name`, `active`, `show_in_compare`, `position`, `data`, `show_on_site`, `multiple`, `external_id`, `show_in_filter`) VALUES
(20, 'displaytech', 1, 1, 1, 'a:3:{i:0;s:3:"LCD";i:1;s:3:"LED";i:2;s:6:"Plasma";}', 1, 0, NULL, 1),
(21, 'razmerekrana', 1, 1, 2, 'a:11:{i:0;s:2:"32";i:1;s:2:"38";i:2;s:2:"39";i:3;s:2:"40";i:4;s:2:"41";i:5;s:2:"42";i:6;s:2:"43";i:7;s:2:"44";i:8;s:2:"45";i:9;s:2:"46";i:10;s:2:"47";}', 1, 0, NULL, 1),
(22, 'hdmi', 1, 1, 3, 'a:2:{i:0;s:8:"есть";i:1;s:6:"нет";}', 1, 0, NULL, 1),
(23, 'power', 1, 1, 4, 'a:3:{i:0;s:8:"1 кВт";i:1;s:8:"2 кВт";i:2;s:8:"3 кВт";}', 1, 0, NULL, 1),
(24, 'digitalopticalinput', 1, 1, 5, 'a:4:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"5";}', 1, 0, NULL, 0),
(25, 'focus', 1, 1, 6, 'a:2:{i:0;s:28:"автоматическая";i:1;s:12:"ручная";}', 1, 0, NULL, 0),
(26, 'megapixel', 1, 1, 7, 'a:5:{i:0;s:1:"5";i:1;s:2:"10";i:2;s:2:"15";i:3;s:2:"20";i:4;s:2:"25";}', 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties_categories` (
  `property_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`category_id`),
  KEY `shop_product_properties_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_product_properties_categories`
--

INSERT INTO `shop_product_properties_categories` (`property_id`, `category_id`) VALUES
(20, 36),
(20, 37),
(21, 36),
(21, 37),
(22, 40),
(22, 41),
(23, 36),
(23, 38),
(23, 40),
(23, 41),
(24, 40),
(24, 41),
(25, 44),
(25, 45),
(26, 44),
(26, 45),
(30, 37);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_data`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_properties_data_I_1` (`value`(333)),
  KEY `shop_product_properties_data_FI_2` (`product_id`),
  KEY `shop_product_properties_data_FI_1` (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=322 ;

--
-- Dumping data for table `shop_product_properties_data`
--

INSERT INTO `shop_product_properties_data` (`id`, `property_id`, `product_id`, `value`) VALUES
(204, 21, 72, '46'),
(203, 20, 72, 'LED'),
(174, 21, 71, '47'),
(173, 20, 71, 'LED'),
(178, 21, 73, '47'),
(177, 20, 73, 'LED'),
(168, 21, 74, '47'),
(167, 20, 74, 'LED'),
(321, 21, 76, '44'),
(320, 20, 76, 'Plasma'),
(196, 23, 87, '1 кВт'),
(193, 23, 88, '1 кВт'),
(192, 22, 88, 'есть'),
(190, 23, 89, '1 кВт'),
(189, 22, 89, 'есть'),
(187, 23, 90, '1 кВт'),
(186, 22, 90, 'есть'),
(184, 23, 91, '1 кВт'),
(183, 22, 91, 'есть'),
(200, 25, 97, 'автоматическая'),
(199, 25, 98, 'автоматическая'),
(201, 25, 96, 'автоматическая'),
(202, 25, 95, 'автоматическая'),
(198, 25, 99, 'автоматическая'),
(180, 21, 75, '47'),
(179, 20, 75, 'LED'),
(195, 22, 87, 'есть'),
(247, 23, 80, '2 кВт'),
(240, 23, 81, '3 кВт'),
(185, 24, 91, '2'),
(188, 24, 90, '2'),
(191, 24, 89, '2'),
(194, 24, 88, '2'),
(197, 24, 87, '2');

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties_i18n` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `locale` varchar(5) NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_product_properties_i18n_I_2` (`name`),
  KEY `shop_product_properties_i18n_I_1` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_product_properties_i18n`
--

INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`) VALUES
(26, 'Количество мегапикселей', 'ru'),
(25, 'Настройка фокуса', 'ru'),
(24, 'Количество цифровых входов', 'ru'),
(23, 'Мощность', 'ru'),
(22, 'HDMI', 'ru'),
(21, 'Размер экрана', 'ru'),
(20, 'Технология дисплея', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_variants`
--

CREATE TABLE IF NOT EXISTS `shop_product_variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` float(10,5) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `mainImage` varchar(255) DEFAULT NULL,
  `smallImage` varchar(255) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_variants_I_1` (`product_id`),
  KEY `shop_product_variants_I_2` (`position`),
  KEY `shop_product_variants_I_3` (`number`),
  KEY `shop_product_variants_I_5` (`price`),
  KEY `shop_product_variants_I_4` (`price`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=209 ;

--
-- Dumping data for table `shop_product_variants`
--

INSERT INTO `shop_product_variants` (`id`, `product_id`, `price`, `number`, `stock`, `position`, `mainImage`, `smallImage`, `external_id`) VALUES
(82, 71, 1000.00000, 'KDL4', 0, 0, NULL, NULL, NULL),
(83, 72, 999.98999, 'LD450', 6, 0, NULL, NULL, NULL),
(84, 73, 899.98999, 'TC-L42', 1, 0, NULL, NULL, NULL),
(85, 74, 899.98999, 'LN40C', 9, 0, NULL, NULL, NULL),
(86, 75, 299.00000, 'CLP-32', 9, 0, NULL, NULL, NULL),
(87, 76, 399.00000, 'CLP-32L', 4, 0, '', '', NULL),
(88, 77, 244.00000, '', 1, 0, NULL, NULL, NULL),
(89, 78, 67.79000, '', 2, 0, NULL, NULL, NULL),
(90, 79, 39.95000, '', 9, 0, NULL, NULL, NULL),
(91, 80, 44.77000, '', 5, 0, NULL, NULL, NULL),
(92, 81, 68.80000, '', 7, 0, NULL, NULL, NULL),
(93, 82, 129.00000, '', 5, 0, NULL, NULL, NULL),
(94, 83, 129.00000, '', 6, 0, NULL, NULL, NULL),
(95, 84, 100.51000, '', 8, 0, NULL, NULL, NULL),
(96, 85, 219.99001, 'D01B570', 7, 0, NULL, NULL, NULL),
(97, 86, 154.00000, '', 4, 0, NULL, NULL, NULL),
(98, 87, 349.00000, '', 7, 0, NULL, NULL, NULL),
(99, 88, 549.98999, '', 8, 0, NULL, NULL, NULL),
(100, 89, 371.98999, '', 9, 0, NULL, NULL, NULL),
(101, 90, 999.00000, '', 2, 0, NULL, NULL, NULL),
(102, 91, 548.00000, '', 1, 0, NULL, NULL, NULL),
(103, 92, 297.00000, '', 4, 0, NULL, NULL, NULL),
(104, 93, 349.98999, '', 8, 0, NULL, NULL, NULL),
(105, 94, 99.95000, '', 4, 0, NULL, NULL, NULL),
(106, 95, 799.00000, '', 5, 0, NULL, NULL, NULL),
(107, 96, 699.00000, '', 6, 0, NULL, NULL, NULL),
(108, 97, 799.00000, '', 1, 0, NULL, NULL, NULL),
(109, 98, 549.00000, '', 4, 0, NULL, NULL, NULL),
(110, 99, 499.98999, '', 8, 0, NULL, NULL, NULL),
(111, 100, 179.87000, '', 2, 0, NULL, NULL, NULL),
(112, 101, 74.99000, '', 9, 0, NULL, NULL, NULL),
(113, 102, 549.98999, '', 0, 0, NULL, NULL, NULL),
(114, 103, 86.91000, '', 8, 0, NULL, NULL, NULL),
(115, 104, 799.98999, '', 1, 0, NULL, NULL, NULL),
(116, 105, 99.95000, '', 2, 0, NULL, NULL, NULL),
(117, 106, 72.05000, '', 7, 0, NULL, NULL, NULL),
(118, 107, 219.28000, '', 5, 0, NULL, NULL, NULL),
(119, 108, 219.99001, '', 2, 0, NULL, NULL, NULL),
(120, 109, 123.37000, '', 9, 0, NULL, NULL, NULL),
(121, 110, 36.95000, '', 5, 0, NULL, NULL, NULL),
(122, 111, 20.40000, '', 7, 0, NULL, NULL, NULL),
(123, 112, 12.99000, '', 6, 0, NULL, NULL, NULL),
(124, 113, 10.99000, '', 9, 0, NULL, NULL, NULL),
(125, 114, 19.99000, '', 3, 0, NULL, NULL, NULL),
(126, 115, 45.00000, '', 5, 0, NULL, NULL, NULL),
(127, 116, 60.99000, '', 6, 0, NULL, NULL, NULL),
(128, 117, 47.22000, '', 7, 0, NULL, NULL, NULL),
(129, 118, 56.00000, '', 2, 0, NULL, NULL, NULL),
(130, 119, 69.00000, '', 5, 0, NULL, NULL, NULL),
(131, 120, 30.71000, '', 6, 0, NULL, NULL, NULL),
(132, 121, 28.18000, '', 4, 0, NULL, NULL, NULL),
(133, 122, 35.00000, '', 6, 0, NULL, NULL, NULL),
(134, 123, 42.00000, '', 1, 0, NULL, NULL, NULL),
(135, 124, 34.00000, '', 2, 0, NULL, NULL, NULL),
(136, 125, 137.12000, '', 9, 0, NULL, NULL, NULL),
(137, 126, 130.13000, '', 5, 0, NULL, NULL, NULL),
(138, 127, 100.35000, '', 8, 0, NULL, NULL, NULL),
(140, 129, 119.99000, '', 9, 0, NULL, NULL, NULL),
(141, 76, 299.00000, 'CLP-33L', 0, 1, '', '', NULL),
(142, 76, 499.00000, 'CLP-34L', 6, 2, '', '', NULL),
(192, 128, 179.99001, '', 2, 0, NULL, NULL, NULL),
(208, 184, 34.00000, '', 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_variants_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_product_variants_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_product_variants_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_product_variants_i18n`
--

INSERT INTO `shop_product_variants_i18n` (`id`, `locale`, `name`) VALUES
(82, 'ru', ''),
(83, 'ru', ''),
(84, 'ru', ''),
(85, 'ru', ''),
(86, 'ru', ''),
(87, 'ru', 'Красный'),
(88, 'ru', ''),
(89, 'ru', ''),
(90, 'ru', ''),
(91, 'ru', ''),
(92, 'ru', ''),
(93, 'ru', ''),
(94, 'ru', ''),
(95, 'ru', ''),
(96, 'ru', ''),
(97, 'ru', ''),
(98, 'ru', ''),
(99, 'ru', ''),
(100, 'ru', ''),
(101, 'ru', ''),
(102, 'ru', ''),
(103, 'ru', ''),
(104, 'ru', ''),
(105, 'ru', ''),
(106, 'ru', ''),
(107, 'ru', ''),
(108, 'ru', ''),
(109, 'ru', ''),
(110, 'ru', ''),
(111, 'ru', ''),
(112, 'ru', ''),
(113, 'ru', ''),
(114, 'ru', ''),
(115, 'ru', ''),
(116, 'ru', ''),
(117, 'ru', ''),
(118, 'ru', ''),
(119, 'ru', ''),
(120, 'ru', ''),
(121, 'ru', ''),
(122, 'ru', ''),
(123, 'ru', ''),
(124, 'ru', ''),
(125, 'ru', ''),
(126, 'ru', ''),
(127, 'ru', ''),
(128, 'ru', ''),
(129, 'ru', ''),
(130, 'ru', ''),
(131, 'ru', ''),
(132, 'ru', ''),
(133, 'ru', ''),
(134, 'ru', ''),
(135, 'ru', ''),
(136, 'ru', ''),
(137, 'ru', ''),
(138, 'ru', ''),
(140, 'ru', ''),
(141, 'ru', 'Зеленый'),
(142, 'ru', 'Белый'),
(192, 'ru', ''),
(87, 'ua', 'Червоний'),
(141, 'ua', 'Зелений'),
(142, 'ua', 'Білий'),
(84, 'ua', ''),
(208, 'ru', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_group`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_rbac_group_I_1` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `shop_rbac_group`
--

INSERT INTO `shop_rbac_group` (`id`, `name`, `description`) VALUES
(98, 'System', NULL),
(97, 'Settings', NULL),
(96, 'Search', NULL),
(95, 'Rbac', NULL),
(94, 'Properties', NULL),
(93, 'Products', NULL),
(92, 'Paymentmethods', NULL),
(91, 'Orderstatuses', NULL),
(90, 'Orders', NULL),
(89, 'Notificationstatuses', NULL),
(88, 'Notifications', NULL),
(87, 'Discounts', NULL),
(86, 'Deliverymethods', NULL),
(85, 'Currencies', NULL),
(84, 'Categories', NULL),
(83, 'Callbacks', NULL),
(81, 'Banners', ''),
(82, 'Brands', NULL),
(99, 'Users', NULL),
(100, 'Warehouses', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_privileges`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_rbac_privileges_I_1` (`name`),
  KEY `shop_rbac_privileges_FI_1` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1471 ;

--
-- Dumping data for table `shop_rbac_privileges`
--

INSERT INTO `shop_rbac_privileges` (`id`, `name`, `description`, `group_id`) VALUES
(1466, 'ShopAdminWarehouses::create', 'ShopAdminWarehouses::create', 100),
(1467, 'ShopAdminWarehouses::edit', 'ShopAdminWarehouses::edit', 100),
(1468, 'ShopAdminWarehouses::delete', 'ShopAdminWarehouses::delete', 100),
(1469, 'ShopAdminRbac::role_save_positions', 'ShopAdminRbac::role_save_positions', 95),
(1465, 'ShopAdminWarehouses::index', 'ShopAdminWarehouses::index', 100),
(1464, 'ShopAdminWarehouses::__construct', 'ShopAdminWarehouses::__construct', 100),
(1463, 'ShopAdminUsers::delete', 'ShopAdminUsers::delete', 99),
(1462, 'ShopAdminUsers::edit', 'ShopAdminUsers::edit', 99),
(1461, 'ShopAdminUsers::create', 'ShopAdminUsers::create', 99),
(1460, 'ShopAdminUsers::index', 'ShopAdminUsers::index', 99),
(1457, 'ShopAdminSystem::import', 'ShopAdminSystem::import', 98),
(1459, 'ShopAdminUsers::__construct', 'ShopAdminUsers::__construct', 99),
(1458, 'ShopAdminSystem::export', 'ShopAdminSystem::export', 98),
(1456, 'ShopAdminSystem::__construct', 'ShopAdminSystem::__construct', 98),
(1455, 'ShopAdminSettings::update', 'ShopAdminSettings::update', 97),
(1453, 'ShopAdminSettings::__construct', 'ShopAdminSettings::__construct', 97),
(1454, 'ShopAdminSettings::index', 'ShopAdminSettings::index', 97),
(1452, 'ShopAdminSearch::renderCustomFields', 'ShopAdminSearch::renderCustomFields', 96),
(1451, 'ShopAdminSearch::index', 'ShopAdminSearch::index', 96),
(1450, 'ShopAdminSearch::__construct', 'ShopAdminSearch::__construct', 96),
(1447, 'ShopAdminRbac::group_edit', 'ShopAdminRbac::group_edit', 95),
(1448, 'ShopAdminRbac::group_list', 'ShopAdminRbac::group_list', 95),
(1449, 'ShopAdminRbac::group_delete', 'ShopAdminRbac::group_delete', 95),
(1446, 'ShopAdminRbac::group_create', 'ShopAdminRbac::group_create', 95),
(1445, 'ShopAdminRbac::privilege_delete', 'ShopAdminRbac::privilege_delete', 95),
(1444, 'ShopAdminRbac::privilege_list', 'ShopAdminRbac::privilege_list', 95),
(1443, 'ShopAdminRbac::privilege_edit', 'ShopAdminRbac::privilege_edit', 95),
(1442, 'ShopAdminRbac::privilege_create', 'ShopAdminRbac::privilege_create', 95),
(1441, 'ShopAdminRbac::role_delete', 'ShopAdminRbac::role_delete', 95),
(1439, 'ShopAdminRbac::role_edit', 'ShopAdminRbac::role_edit', 95),
(1440, 'ShopAdminRbac::role_list', 'ShopAdminRbac::role_list', 95),
(1437, 'ShopAdminRbac::index', 'ShopAdminRbac::index', 95),
(1438, 'ShopAdminRbac::role_create', 'ShopAdminRbac::role_create', 95),
(1436, 'ShopAdminRbac::__construct', 'ShopAdminRbac::__construct', 95),
(1435, 'ShopAdminProperties::delete', 'ShopAdminProperties::delete', 94),
(1434, 'ShopAdminProperties::savePositions', 'ShopAdminProperties::savePositions', 94),
(1433, 'ShopAdminProperties::renderForm', 'ShopAdminProperties::renderForm', 94),
(1432, 'ShopAdminProperties::edit', 'ShopAdminProperties::edit', 94),
(1431, 'ShopAdminProperties::create', 'ShopAdminProperties::create', 94),
(1430, 'ShopAdminProperties::index', 'ShopAdminProperties::index', 94),
(1429, 'ShopAdminProperties::__construct', 'ShopAdminProperties::__construct', 94),
(1428, 'ShopAdminProducts::translate', 'ShopAdminProducts::translate', 93),
(1427, 'ShopAdminProducts::ajaxMoveProducts', 'ShopAdminProducts::ajaxMoveProducts', 93),
(1426, 'ShopAdminProducts::ajaxMoveWindow', 'ShopAdminProducts::ajaxMoveWindow', 93),
(1424, 'ShopAdminProducts::ajaxCloneProducts', 'ShopAdminProducts::ajaxCloneProducts', 93),
(1425, 'ShopAdminProducts::ajaxDeleteProducts', 'ShopAdminProducts::ajaxDeleteProducts', 93),
(1421, 'ShopAdminProducts::ajaxChangeHit', 'ShopAdminProducts::ajaxChangeHit', 93),
(1422, 'ShopAdminProducts::ajaxChangeHot', 'ShopAdminProducts::ajaxChangeHot', 93),
(1423, 'ShopAdminProducts::ajaxChangeAction', 'ShopAdminProducts::ajaxChangeAction', 93),
(1420, 'ShopAdminProducts::ajaxChangeActive', 'ShopAdminProducts::ajaxChangeActive', 93),
(1418, 'ShopAdminProducts::saveAdditionalImages', 'ShopAdminProducts::saveAdditionalImages', 93),
(1419, 'ShopAdminProducts::delete', 'ShopAdminProducts::delete', 93),
(1415, 'ShopAdminProducts::index', 'ShopAdminProducts::index', 93),
(1416, 'ShopAdminProducts::create', 'ShopAdminProducts::create', 93),
(1417, 'ShopAdminProducts::edit', 'ShopAdminProducts::edit', 93),
(1413, 'ShopAdminPaymentmethods::getAdminForm', 'ShopAdminPaymentmethods::getAdminForm', 92),
(1414, 'ShopAdminProducts::__construct', 'ShopAdminProducts::__construct', 93),
(1408, 'ShopAdminPaymentmethods::index', 'ShopAdminPaymentmethods::index', 92),
(1409, 'ShopAdminPaymentmethods::create', 'ShopAdminPaymentmethods::create', 92),
(1410, 'ShopAdminPaymentmethods::edit', 'ShopAdminPaymentmethods::edit', 92),
(1411, 'ShopAdminPaymentmethods::delete', 'ShopAdminPaymentmethods::delete', 92),
(1412, 'ShopAdminPaymentmethods::savePositions', 'ShopAdminPaymentmethods::savePositions', 92),
(1402, 'ShopAdminOrderstatuses::create', 'ShopAdminOrderstatuses::create', 91),
(1403, 'ShopAdminOrderstatuses::edit', 'ShopAdminOrderstatuses::edit', 91),
(1404, 'ShopAdminOrderstatuses::delete', 'ShopAdminOrderstatuses::delete', 91),
(1405, 'ShopAdminOrderstatuses::ajaxDeleteWindow', 'ShopAdminOrderstatuses::ajaxDeleteWindow', 91),
(1406, 'ShopAdminOrderstatuses::savePositions', 'ShopAdminOrderstatuses::savePositions', 91),
(1407, 'ShopAdminPaymentmethods::__construct', 'ShopAdminPaymentmethods::__construct', 92),
(1401, 'ShopAdminOrderstatuses::index', 'ShopAdminOrderstatuses::index', 91),
(1400, 'ShopAdminOrderstatuses::__construct', 'ShopAdminOrderstatuses::__construct', 91),
(1399, 'ShopAdminOrders::createPdf', 'ShopAdminOrders::createPdf', 90),
(1396, 'ShopAdminOrders::search', 'ShopAdminOrders::search', 90),
(1397, 'ShopAdminOrders::printChecks', 'ShopAdminOrders::printChecks', 90),
(1398, 'ShopAdminOrders::createPDFPage', 'ShopAdminOrders::createPDFPage', 90),
(1394, 'ShopAdminOrders::ajaxEditOrderAddToCart', 'ShopAdminOrders::ajaxEditOrderAddToCart', 90),
(1395, 'ShopAdminOrders::ajaxGetOrderCart', 'ShopAdminOrders::ajaxGetOrderCart', 90),
(1391, 'ShopAdminOrders::ajaxDeleteProduct', 'ShopAdminOrders::ajaxDeleteProduct', 90),
(1392, 'ShopAdminOrders::ajaxGetProductList', 'ShopAdminOrders::ajaxGetProductList', 90),
(1393, 'ShopAdminOrders::ajaxEditOrderCart', 'ShopAdminOrders::ajaxEditOrderCart', 90),
(1390, 'ShopAdminOrders::ajaxEditAddToCartWindow', 'ShopAdminOrders::ajaxEditAddToCartWindow', 90),
(1388, 'ShopAdminOrders::ajaxChangeOrdersPaid', 'ShopAdminOrders::ajaxChangeOrdersPaid', 90),
(1389, 'ShopAdminOrders::ajaxEditWindow', 'ShopAdminOrders::ajaxEditWindow', 90),
(1387, 'ShopAdminOrders::ajaxChangeOrdersStatus', 'ShopAdminOrders::ajaxChangeOrdersStatus', 90),
(1386, 'ShopAdminOrders::ajaxDeleteOrders', 'ShopAdminOrders::ajaxDeleteOrders', 90),
(1385, 'ShopAdminOrders::delete', 'ShopAdminOrders::delete', 90),
(1381, 'ShopAdminOrders::index', 'ShopAdminOrders::index', 90),
(1382, 'ShopAdminOrders::edit', 'ShopAdminOrders::edit', 90),
(1383, 'ShopAdminOrders::changeStatus', 'ShopAdminOrders::changeStatus', 90),
(1384, 'ShopAdminOrders::changePaid', 'ShopAdminOrders::changePaid', 90),
(1380, 'ShopAdminOrders::__construct', 'ShopAdminOrders::__construct', 90),
(1378, 'ShopAdminNotificationstatuses::delete', 'ShopAdminNotificationstatuses::delete', 89),
(1379, 'ShopAdminNotificationstatuses::savePositions', 'ShopAdminNotificationstatuses::savePositions', 89),
(1377, 'ShopAdminNotificationstatuses::edit', 'ShopAdminNotificationstatuses::edit', 89),
(1376, 'ShopAdminNotificationstatuses::create', 'ShopAdminNotificationstatuses::create', 89),
(1375, 'ShopAdminNotificationstatuses::index', 'ShopAdminNotificationstatuses::index', 89),
(1374, 'ShopAdminNotificationstatuses::__construct', 'ShopAdminNotificationstatuses::__construct', 89),
(1373, 'ShopAdminNotifications::getAvailableNotification', 'ShopAdminNotifications::getAvailableNotification', 88),
(1372, 'ShopAdminNotifications::search', 'ShopAdminNotifications::search', 88),
(1371, 'ShopAdminNotifications::ajaxChangeNotificationsStatus', 'ShopAdminNotifications::ajaxChangeNotificationsStatus', 88),
(1370, 'ShopAdminNotifications::ajaxDeleteNotifications', 'ShopAdminNotifications::ajaxDeleteNotifications', 88),
(1369, 'ShopAdminNotifications::delete', 'ShopAdminNotifications::delete', 88),
(1368, 'ShopAdminNotifications::notifyByEmail', 'ShopAdminNotifications::notifyByEmail', 88),
(1367, 'ShopAdminNotifications::changeStatus', 'ShopAdminNotifications::changeStatus', 88),
(1358, 'ShopAdminDiscounts::__construct', 'ShopAdminDiscounts::__construct', 87),
(1359, 'ShopAdminDiscounts::index', 'ShopAdminDiscounts::index', 87),
(1360, 'ShopAdminDiscounts::create', 'ShopAdminDiscounts::create', 87),
(1361, 'ShopAdminDiscounts::edit', 'ShopAdminDiscounts::edit', 87),
(1362, 'ShopAdminDiscounts::delete', 'ShopAdminDiscounts::delete', 87),
(1363, 'ShopAdminDiscounts::_redirect', 'ShopAdminDiscounts::_redirect', 87),
(1364, 'ShopAdminNotifications::__construct', 'ShopAdminNotifications::__construct', 88),
(1365, 'ShopAdminNotifications::index', 'ShopAdminNotifications::index', 88),
(1366, 'ShopAdminNotifications::edit', 'ShopAdminNotifications::edit', 88),
(1354, 'ShopAdminDeliverymethods::create', 'ShopAdminDeliverymethods::create', 86),
(1355, 'ShopAdminDeliverymethods::edit', 'ShopAdminDeliverymethods::edit', 86),
(1356, 'ShopAdminDeliverymethods::delete', 'ShopAdminDeliverymethods::delete', 86),
(1357, 'ShopAdminDeliverymethods::c_list', 'ShopAdminDeliverymethods::c_list', 86),
(1351, 'ShopAdminCurrencies::_redirect', 'ShopAdminCurrencies::_redirect', 85),
(1353, 'ShopAdminDeliverymethods::index', 'ShopAdminDeliverymethods::index', 86),
(1352, 'ShopAdminDeliverymethods::__construct', 'ShopAdminDeliverymethods::__construct', 86),
(1350, 'ShopAdminCurrencies::delete', 'ShopAdminCurrencies::delete', 85),
(1349, 'ShopAdminCurrencies::makeCurrencyMain', 'ShopAdminCurrencies::makeCurrencyMain', 85),
(1347, 'ShopAdminCurrencies::edit', 'ShopAdminCurrencies::edit', 85),
(1348, 'ShopAdminCurrencies::makeCurrencyDefault', 'ShopAdminCurrencies::makeCurrencyDefault', 85),
(1346, 'ShopAdminCurrencies::create', 'ShopAdminCurrencies::create', 85),
(1344, 'ShopAdminCurrencies::__construct', 'ShopAdminCurrencies::__construct', 85),
(1342, 'ShopAdminCategories::ajax_translit', 'ShopAdminCategories::ajax_translit', 84),
(1345, 'ShopAdminCurrencies::index', 'ShopAdminCurrencies::index', 85),
(1343, 'ShopAdminCategories::translate', 'ShopAdminCategories::translate', 84),
(1341, 'ShopAdminCategories::save_positions', 'ShopAdminCategories::save_positions', 84),
(1340, 'ShopAdminCategories::c_list', 'ShopAdminCategories::c_list', 84),
(1339, 'ShopAdminCategories::delete', 'ShopAdminCategories::delete', 84),
(1338, 'ShopAdminCategories::edit', 'ShopAdminCategories::edit', 84),
(1337, 'ShopAdminCategories::create', 'ShopAdminCategories::create', 84),
(1336, 'ShopAdminCategories::index', 'ShopAdminCategories::index', 84),
(1335, 'ShopAdminCategories::__construct', 'ShopAdminCategories::__construct', 84),
(1332, 'ShopAdminCallbacks::updateTheme', 'ShopAdminCallbacks::updateTheme', 83),
(1334, 'ShopAdminCallbacks::search', 'ShopAdminCallbacks::search', 83),
(1333, 'ShopAdminCallbacks::deleteTheme', 'ShopAdminCallbacks::deleteTheme', 83),
(1331, 'ShopAdminCallbacks::createTheme', 'ShopAdminCallbacks::createTheme', 83),
(1330, 'ShopAdminCallbacks::themesList', 'ShopAdminCallbacks::themesList', 83),
(1327, 'ShopAdminCallbacks::changeStatus', 'ShopAdminCallbacks::changeStatus', 83),
(1328, 'ShopAdminCallbacks::deleteCallback', 'ShopAdminCallbacks::deleteCallback', 83),
(1329, 'ShopAdminCallbacks::deleteStatus', 'ShopAdminCallbacks::deleteStatus', 83),
(1325, 'ShopAdminCallbacks::createStatus', 'ShopAdminCallbacks::createStatus', 83),
(1326, 'ShopAdminCallbacks::updateStatus', 'ShopAdminCallbacks::updateStatus', 83),
(1324, 'ShopAdminCallbacks::statuses', 'ShopAdminCallbacks::statuses', 83),
(1323, 'ShopAdminCallbacks::update', 'ShopAdminCallbacks::update', 83),
(1322, 'ShopAdminCallbacks::index', 'ShopAdminCallbacks::index', 83),
(1321, 'ShopAdminCallbacks::__construct', 'ShopAdminCallbacks::__construct', 83),
(1320, 'ShopAdminBrands::translate', 'ShopAdminBrands::translate', 82),
(1319, 'ShopAdminBrands::c_list', 'ShopAdminBrands::c_list', 82),
(1318, 'ShopAdminBrands::delete', 'ShopAdminBrands::delete', 82),
(1313, 'ShopAdminBanners::translate', 'Перевод баннера', 81),
(1314, 'ShopAdminBrands::__construct', 'ShopAdminBrands::__construct', 82),
(1315, 'ShopAdminBrands::index', 'ShopAdminBrands::index', 82),
(1316, 'ShopAdminBrands::create', 'ShopAdminBrands::create', 82),
(1317, 'ShopAdminBrands::edit', 'ShopAdminBrands::edit', 82),
(1312, 'ShopAdminBanners::deleteBanner', 'ShopAdminBanners::deleteBanner', 81),
(1310, 'ShopAdminBanners::create', 'ShopAdminBanners::create', 81),
(1308, 'ShopAdminBanners::__construct', 'ShopAdminBanners::__construct', 81),
(1311, 'ShopAdminBanners::edit', 'ShopAdminBanners::edit', 81),
(1309, 'ShopAdminBanners::index', 'ShopAdminBanners::index', 81);

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_roles`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `importance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `shop_rbac_roles`
--

INSERT INTO `shop_rbac_roles` (`id`, `name`, `description`, `importance`) VALUES
(12, 'Менеджер2', '', 3),
(10, 'Администартор', '', 1),
(11, 'Менеджер', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_roles_privileges`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_roles_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_rbac_roles_privileges_FI_1` (`role_id`),
  KEY `shop_rbac_roles_privileges_FI_2` (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1781 ;

--
-- Dumping data for table `shop_rbac_roles_privileges`
--

INSERT INTO `shop_rbac_roles_privileges` (`id`, `role_id`, `privilege_id`) VALUES
(1623, 10, 1465),
(1622, 10, 1469),
(1621, 10, 1468),
(1620, 10, 1467),
(1619, 10, 1466),
(1780, 10, 1309),
(1779, 10, 1311),
(1778, 10, 1308),
(1777, 10, 1310),
(1776, 10, 1312),
(1775, 10, 1317),
(1774, 10, 1316),
(1773, 10, 1315),
(1772, 10, 1314),
(1771, 10, 1313),
(1770, 10, 1318),
(1769, 10, 1319),
(1768, 10, 1320),
(1767, 10, 1321),
(1766, 10, 1322),
(1765, 10, 1323),
(1764, 10, 1324),
(1763, 10, 1326),
(1762, 10, 1325),
(1761, 10, 1329),
(1760, 10, 1328),
(1759, 10, 1327),
(1758, 10, 1330),
(1757, 10, 1331),
(1756, 10, 1333),
(1755, 10, 1334),
(1754, 10, 1332),
(1753, 10, 1335),
(1752, 10, 1336),
(1751, 10, 1337),
(1750, 10, 1338),
(1749, 10, 1339),
(1748, 10, 1340),
(1747, 10, 1341),
(1746, 10, 1343),
(1745, 10, 1345),
(1744, 10, 1342),
(1743, 10, 1344),
(1742, 10, 1346),
(1741, 10, 1348),
(1740, 10, 1347),
(1739, 10, 1349),
(1738, 10, 1350),
(1737, 10, 1352),
(1736, 10, 1353),
(1735, 10, 1351),
(1734, 10, 1357),
(1733, 10, 1356),
(1732, 10, 1355),
(1731, 10, 1354),
(1730, 10, 1366),
(1729, 10, 1365),
(1728, 10, 1364),
(1727, 10, 1363),
(1726, 10, 1362),
(1725, 10, 1361),
(1724, 10, 1360),
(1723, 10, 1359),
(1722, 10, 1358),
(1721, 10, 1367),
(1720, 10, 1368),
(1719, 10, 1369),
(1718, 10, 1370),
(1717, 10, 1371),
(1716, 10, 1372),
(1715, 10, 1373),
(1714, 10, 1374),
(1713, 10, 1375),
(1712, 10, 1376),
(1711, 10, 1377),
(1710, 10, 1379),
(1709, 10, 1378),
(1708, 10, 1380),
(1707, 10, 1384),
(1706, 10, 1383),
(1705, 10, 1382),
(1704, 10, 1381),
(1703, 10, 1385),
(1702, 10, 1386),
(1701, 10, 1387),
(1700, 10, 1389),
(1699, 10, 1388),
(1698, 10, 1390),
(1697, 10, 1393),
(1696, 10, 1392),
(1695, 10, 1391),
(1694, 10, 1395),
(1693, 10, 1394),
(1692, 10, 1398),
(1691, 10, 1397),
(1690, 10, 1396),
(1689, 10, 1399),
(1688, 10, 1400),
(1687, 10, 1401),
(1686, 10, 1407),
(1685, 10, 1406),
(1684, 10, 1405),
(1683, 10, 1404),
(1682, 10, 1403),
(1681, 10, 1402),
(1680, 10, 1412),
(1679, 10, 1411),
(1678, 10, 1410),
(1677, 10, 1409),
(1676, 10, 1408),
(1675, 10, 1414),
(1674, 10, 1413),
(1673, 10, 1417),
(1672, 10, 1416),
(1671, 10, 1415),
(1670, 10, 1419),
(1669, 10, 1418),
(1668, 10, 1420),
(1667, 10, 1423),
(1666, 10, 1422),
(1665, 10, 1421),
(1664, 10, 1425),
(1663, 10, 1424),
(1662, 10, 1426),
(1661, 10, 1427),
(1660, 10, 1428),
(1659, 10, 1429),
(1658, 10, 1430),
(1657, 10, 1431),
(1656, 10, 1432),
(1655, 10, 1433),
(1654, 10, 1434),
(1653, 10, 1435),
(1652, 10, 1436),
(1651, 10, 1438),
(1650, 10, 1437),
(1649, 10, 1440),
(1648, 10, 1439),
(1647, 10, 1441),
(1646, 10, 1442),
(1645, 10, 1443),
(1644, 10, 1444),
(1643, 10, 1445),
(1642, 10, 1446),
(1641, 10, 1449),
(1640, 10, 1448),
(1639, 10, 1447),
(1638, 10, 1450),
(1637, 10, 1451),
(1636, 10, 1452),
(1635, 10, 1454),
(1634, 10, 1453),
(1633, 10, 1455),
(1632, 10, 1456),
(1631, 10, 1458),
(1630, 10, 1459),
(1629, 10, 1457),
(1628, 10, 1460),
(1627, 10, 1461),
(1626, 10, 1462),
(1625, 10, 1463),
(1624, 10, 1464);

-- --------------------------------------------------------

--
-- Table structure for table `shop_settings`
--

CREATE TABLE IF NOT EXISTS `shop_settings` (
  `name` varchar(255) NOT NULL,
  `value` text,
  `locale` varchar(5) NOT NULL,
  PRIMARY KEY (`name`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_settings`
--

INSERT INTO `shop_settings` (`name`, `value`, `locale`) VALUES
('mainImageWidth', '370', ''),
('mainImageHeight', '320', ''),
('smallImageWidth', '140', ''),
('smallImageHeight', '140', ''),
('addImageWidth', '800', ''),
('addImageHeight', '600', ''),
('imagesQuality', '99', ''),
('systemTemplatePath', './templates/commerce/shop/default', ''),
('frontProductsPerPage', '12', ''),
('adminProductsPerPage', '24', ''),
('ordersMessageFormat', 'text', ''),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22', ''),
('ordersSendMessage', 'true', ''),
('ordersSenderEmail', 'noreply@demoshop.imagecm.net', ''),
('ordersSenderName', 'DemoShop ImageCms.net', ''),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки', ''),
('2_LMI_SECRET_KEY', 'bank', ''),
('2_LMI_PAYEE_PURSE', 'bank', ''),
('1_LMI_SECRET_KEY', 'cur', ''),
('1_LMI_PAYEE_PURSE', 'cur', ''),
('2_OschadBankData', 'a:5:{s:8:"receiver";s:41:"ТЗОВ "Екзампл Магазин" ";s:4:"code";s:9:"123456789";s:7:"account";s:12:"123456789123";s:3:"mfo";s:6:"123456";s:8:"banknote";s:7:"грн.";}', ''),
('3_SberBankData', 'a:8:{s:12:"receiverName";s:45:"Наименование получателя";s:8:"bankName";s:29:"Банк получателя";s:11:"receiverInn";s:10:"1231231231";s:7:"account";s:20:"15412398123312341237";s:3:"BIK";s:9:"123123123";s:11:"cor_account";s:20:"12312312334012340123";s:8:"bankNote";s:7:"руб.";s:9:"bankNote2";s:7:"коп.";}', ''),
('4_RobokassaData', 'a:3:{s:5:"login";s:5:"login";s:9:"password1";s:9:"password1";s:9:"password2";s:9:"password2";}', ''),
('notifyOrderStatusMessageFormat', 'text', ''),
('notifyOrderStatusMessageText', '', ''),
('notifyOrderStatusSenderEmail', 'noreply@example.com', ''),
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
('callbacksSendEmailTo', '', ''),
('callbacksSenderEmail', '', ''),
('callbacksSenderName', '', ''),
('callbacksMessageTheme', '', ''),
('userInfoRegister', '0', ''),
('userInfoMessageFormat', 'text', ''),
('userInfoMessageText', '', ''),
('userInfoSenderEmail', '', ''),
('userInfoSenderName', '', ''),
('userInfoMessageTheme', '', ''),
('topSalesBlockFormulaCoef', '1', ''),
('pricePrecision', '2', ''),
('smallAddImageWidth', '90', ''),
('smallAddImageHeight', '90', ''),
('forgotPasswordMessageText', 'Здравствуйте!\n\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\n\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri% \n\nВаш новый пароль для входа: %password%\n\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\n\n\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\n\nС уважением, \nсотрудники службы продаж %webSiteName%', ''),
('watermark_wm_hor_alignment', 'right', ''),
('watermark_wm_vrt_alignment', 'bottom', ''),
('watermark_watermark_type', 'text', ''),
('watermark_watermark_image', '', ''),
('watermark_watermark_image_opacity', '50', ''),
('watermark_watermark_padding', '', ''),
('watermark_watermark_text', '', ''),
('watermark_watermark_font_size', '', ''),
('watermark_watermark_color', '', ''),
('watermark_watermark_font_path', '', ''),
('watermark_active', '', ''),
('forgotPasswordMessageText', 'Здравствуйте!\n\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\n\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri% \n\nВаш новый пароль для входа: %password%\n\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\n\n\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\n\nС уважением, \nсотрудники службы продаж %webSiteName%', 'ru'),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22', 'ru'),
('ordersSenderName', 'DemoShop ImageCms.net', 'ru'),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки', 'ru'),
('notifyOrderStatusMessageText', '', 'ru'),
('notifyOrderStatusSenderName', '', 'ru'),
('notifyOrderStatusMessageTheme', '', 'ru'),
('wishListsMessageText', '', 'ru'),
('wishListsSenderName', '', 'ru'),
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
('adminMessageCallback', '<h1>Спасибо за заказ звонка</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>', ''),
('1CCatSettings', 'a:4:{s:3:"zip";s:8:"zip=no\\n";s:8:"filesize";s:6:"1024\\n";s:7:"validIP";s:9:"127.0.0.1";s:8:"password";s:0:"";}', ''),
('adminMessages', 'a:3:{s:8:"incoming";s:0:"";s:8:"callback";s:27:"вфы вфыв фыв фы";s:5:"order";s:0:"";}', 'ru'),
('selectedProductCats', 'a:5:{i:0;s:2:"36";i:1;s:2:"37";i:2;s:2:"38";i:3;s:2:"39";i:4;s:2:"41";}', ''),
('adminMessageIncoming', '', ''),
('adminMessageOrderPage', '', ''),
('mainModImageWidth', '140', ''),
('mainModImageHeight', '100', ''),
('smallModImageWidth', '90', ''),
('smallModImageHeight', '90', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_user_profile`
--

CREATE TABLE IF NOT EXISTS `shop_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cart_data` text,
  `user_email` varchar(100) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `key` varchar(255) NOT NULL,
  `wish_list_data` text,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_user_profile_I_1` (`key`),
  KEY `shop_user_profile_FI_1` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `shop_user_profile`
--

INSERT INTO `shop_user_profile` (`id`, `user_id`, `name`, `phone`, `address`, `cart_data`, `user_email`, `date_created`, `key`, `wish_list_data`, `role_id`) VALUES
(1, 1, 'Administrator', 'asdasdasd', 'dasdasd', 'a:2:{s:15:"SProducts_72_83";a:6:{s:8:"instance";s:9:"SProducts";s:9:"productId";i:72;s:9:"variantId";i:83;s:8:"quantity";i:1;s:5:"price";d:999.990000000000009094947017729282379150390625;s:11:"variantName";s:0:"";}s:15:"SProducts_80_91";a:6:{s:8:"instance";s:9:"SProducts";s:9:"productId";i:80;s:9:"variantId";i:91;s:8:"quantity";i:1;s:5:"price";d:44.77000000000000312638803734444081783294677734375;s:11:"variantName";s:0:"";}}', 'admin@localhost.loc', NULL, 'dasdasd', 'a:1:{i:0;a:2:{i:0;i:80;i:1;i:91;}}', 10),
(6, 92, 'Lasd', NULL, NULL, NULL, 'dasdsa@31gotofly.ss', 1339070640, '', NULL, NULL),
(7, 93, 'tester@tester.teste', NULL, NULL, NULL, 'tester@tester.teste', 1339692614, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_warehouse`
--

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
-- Dumping data for table `shop_warehouse`
--

INSERT INTO `shop_warehouse` (`id`, `name`, `address`, `phone`, `description`) VALUES
(1, 'warehouse 1', 'address', 'phone', ''),
(2, 'warehouse 2', 'address 2', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_warehouse_data`
--

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
-- Dumping data for table `shop_warehouse_data`
--

INSERT INTO `shop_warehouse_data` (`id`, `product_id`, `warehouse_id`, `count`) VALUES
(37, 132, 2, 3),
(36, 132, 1, 2),
(35, 132, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) DEFAULT NULL,
  `newpass` varchar(34) DEFAULT NULL,
  `newpass_key` varchar(32) DEFAULT NULL,
  `newpass_time` datetime DEFAULT NULL,
  `last_ip` varchar(40) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `banned` (`banned`),
  KEY `password` (`password`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 2, 'admin', '$1$tAfsqkpo$xP9ByZNdprtoB24BeGWly0', 'admin@localhost.loc', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '2012-06-14 21:18:01', '2008-11-30 04:56:32', '2012-06-14 20:18:01'),
(93, 1, 'tester@tester.teste', '$1$8Z381nBk$p6O4ZC66r1BUhdqZ0suwa1', 'tester@tester.teste', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '2012-06-14 20:50:25', '2012-06-14 20:50:14', '2012-06-14 19:50:25'),
(92, 1, 'dasdsa@31gotofly.ss', '$1$Fz8hM5jb$aT.GSRvpI0DKo74e91PEb1', 'dasdsa@31gotofly.ss', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2012-06-07 16:04:00', '2012-06-07 15:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

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
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('d0a935a7e38a7b35e448e762c8c39f88', 1, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11', '127.0.0.1', '2012-03-26 10:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`) VALUES
(3, 1),
(10, 93),
(9, 92),
(8, 91);

-- --------------------------------------------------------

--
-- Table structure for table `user_temp`
--

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

--
-- Dumping data for table `user_temp`
--


-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `type`, `data`, `method`, `settings`, `description`, `roles`, `created`) VALUES
(3, 'latest_news', 'module', 'core', 'recent_news', 'a:4:{s:10:"news_count";s:1:"2";s:11:"max_symdols";s:3:"150";s:10:"categories";a:1:{i:0;s:2:"56";}s:7:"display";s:6:"recent";}', 'Последние новости', '', 1291632457),
(4, 'recent_product_comments', 'module', 'comments', 'recent_product_comments', 'a:2:{s:14:"comments_count";s:1:"5";s:13:"symbols_count";s:1:"0";}', '', '', 1308300371),
(5, 'tags', 'module', 'tags', 'tags_cloud', '', 'tags', '', 1312362714),
(6, 'path', 'module', 'navigation', 'widget_navigation', '', 'path', '', 1328631622);
