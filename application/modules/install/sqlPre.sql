-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2014 at 11:22 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.25-1+sury.org~precise+2

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
-- Table structure for table `answer_notifications`
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
-- Dumping data for table `answer_notifications`
--

INSERT INTO `answer_notifications` (`id`, `locale`, `name`, `message`) VALUES
(1, 'ua', 'incoming', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(2, 'ua', 'callback', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(3, 'ua', 'order', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(4, 'ru', 'incoming', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>'),
(5, 'ru', 'callback', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>'),
(6, 'ru', 'order', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>');

-- --------------------------------------------------------

--
-- Table structure for table `category`
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
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `position`, `name`, `title`, `short_desc`, `url`, `image`, `keywords`, `description`, `fetch_pages`, `main_tpl`, `tpl`, `page_tpl`, `per_page`, `order_by`, `sort_order`, `comments_default`, `field_group`, `category_field_group`, `settings`, `created`, `updated`) VALUES
(69, 0, 1, 'Новости', '', '', 'novosti', '', '', '', 'b:0;', '', '', '', 15, 'publish_date', 'desc', 0, 13, -1, 'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";b:0;}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_translate`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `module`, `user_id`, `user_name`, `user_mail`, `user_site`, `item_id`, `text`, `date`, `status`, `agent`, `user_ip`, `rate`, `text_plus`, `text_minus`, `like`, `disslike`, `parent`) VALUES
(90, 'shop', 49, 'ad@min.com', 'ad@min.com', '', 1104, 'Когда наушники из разьема вынимал, нельзя было слушать музыки, нельзя было разговаривать по телефону. Слышать телефонный сигнал можно было только при включении громкой связи, но микрофон на телефоне не включался, можно было разговаривать только через встроенный в наушники микрофон.', 1395054140, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 4, '', '', 1, 0, 0),
(88, 'shop', 0, 'Олег', 'o@mail.ru', '', 1104, 'Вынужден повторить, сбой со звуком устранен после подключения обыкновенных, без наличия встроенного микрофона, наушников', 1395054076, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 0, '', '', 0, 0, 87),
(89, 'shop', 0, 'Ирина', 'irina@mail.ru', '', 1104, 'Хотелось бы отметить еще один +. У меня очень большое сопротивление пальцев, почти мегомное. Поэтому другие смартфоны не чувствуют прикосновения, сложно управлять экраном. 520 имеет очень чувствительный экран и я был приятно удивлен отличной реакцией экрана на прикосновение.', 1395054106, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 0, '', '', 0, 0, 87),
(87, 'shop', 0, 'Николай', 'n@mail.ru', '', 1104, 'Скоро будет год, как купил телефон. В целом телефоном очень доволен. Связь стабильная, экран позволяет комфортно работать с приложениями, батарея держит хорошо<br/><br/>Минусы: Отсутствие фронтальной камеры для скайпа, вспышки', 1395054066, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 4, '', '', 0, 0, 0),
(86, 'shop', 0, 'Олег', 'o@mail.ru', '', 1104, 'Ну а так настройки достаточно простые - правда в это же время и тяжело доступные... - так сказать, было впервые, а сейчас уже знаю))) Но однако проц здесь мощный стоит', 1395053998, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 0, '', '', 0, 0, 0),
(84, 'shop', 0, 'Андрей', 'a@mail.ru', '', 1104, 'Ну OneNote может и не поддерживает. А вот остальное точно есть', 1395053881, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 0, '', '', 0, 0, 83),
(85, 'shop', 0, 'Олег', 'o@mail.ru', '', 1104, 'За такую цену отличный телефон', 1395053915, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 5, '', '', 0, 0, 0),
(83, 'shop', 0, 'Ирина', 'irina@mail.ru', '', 1104, 'Калькулятор Часы Календарь Телефонная книга Будильник Напоминания Заметки Социальные сети OneNote правда , что это все телефон не поддерживает?', 1395053846, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 0, '', '', 1, 0, 0),
(82, 'shop', 49, 'ad@min.com', 'ad@min.com', '', 1104, 'Ну такой, нормальный - ничего виделяющееся. Чисто брал как звонилку + в инете посидеть, ну и в игрушку какую-ту поиграть, еще на крайняк кмерой пользуюсь. Все предложения, которые шли я удалил, т.к. ни разу ими не пользовался.', 1395053778, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 4, '', '', 0, 0, 0),
(91, 'shop', 49, 'ad@min.com', 'ad@min.com', '', 1104, 'хороший телефон, но попался с браком телефон НОВЫЙ КУПЛЕН 16 Февраля этого года ( покупал не тут )', 1395054176, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 0, '', '', 0, 0, 83),
(92, 'shop', 49, 'ad@min.com', 'ad@min.com', '', 1104, 'Каждое по одному, но не значит, что вместе 2Ггц', 1395054192, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '194.44.52.70', 0, '', '', 0, 0, 87);

-- --------------------------------------------------------

--
-- Table structure for table `components`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=272 ;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `name`, `identif`, `enabled`, `autoload`, `in_menu`, `settings`, `position`) VALUES
(1, 'user_manager', 'user_manager', 0, 0, 0, NULL, 22),
(2, 'auth', 'auth', 1, 0, 0, NULL, 31),
(4, 'comments', 'comments', 1, 1, 1, 'a:5:{s:18:"max_comment_length";i:0;s:6:"period";i:0;s:11:"can_comment";i:0;s:11:"use_captcha";b:0;s:14:"use_moderation";b:0;}', 12),
(7, 'navigation', 'navigation', 0, 0, 0, NULL, 32),
(30, 'tags', 'tags', 1, 1, 0, NULL, 30),
(92, 'gallery', 'gallery', 1, 0, 0, 'a:26:{s:13:"max_file_size";s:1:"5";s:9:"max_width";s:1:"0";s:10:"max_height";s:1:"0";s:7:"quality";s:2:"95";s:14:"maintain_ratio";b:1;s:19:"maintain_ratio_prev";b:1;s:19:"maintain_ratio_icon";b:1;s:4:"crop";b:0;s:9:"crop_prev";b:0;s:9:"crop_icon";b:0;s:14:"prev_img_width";s:3:"500";s:15:"prev_img_height";s:3:"500";s:11:"thumb_width";s:3:"100";s:12:"thumb_height";s:3:"100";s:14:"watermark_text";s:0:"";s:16:"wm_vrt_alignment";s:6:"bottom";s:16:"wm_hor_alignment";s:4:"left";s:19:"watermark_font_size";s:2:"14";s:15:"watermark_color";s:6:"ffffff";s:17:"watermark_padding";s:2:"-5";s:19:"watermark_font_path";s:25:"./uploads/defaultFont.ttf";s:15:"watermark_image";s:0:"";s:23:"watermark_image_opacity";s:2:"50";s:14:"watermark_type";s:4:"text";s:8:"order_by";s:4:"date";s:10:"sort_order";s:4:"desc";}', 16),
(55, 'rss', 'rss', 1, 0, 0, 'a:5:{s:5:"title";s:9:"Image CMS";s:11:"description";s:35:"Тестируем модуль RSS";s:10:"categories";a:1:{i:0;s:1:"3";}s:9:"cache_ttl";i:60;s:11:"pages_count";i:10;}', 17),
(60, 'menu', 'menu', 0, 1, 1, NULL, 0),
(58, 'sitemap', 'sitemap', 1, 1, 0, 'a:6:{s:18:"main_page_priority";b:0;s:13:"cats_priority";b:0;s:14:"pages_priority";b:0;s:20:"main_page_changefreq";b:0;s:21:"categories_changefreq";b:0;s:16:"pages_changefreq";b:0;}', 18),
(80, 'search', 'search', 1, 0, 0, NULL, 25),
(84, 'feedback', 'feedback', 1, 0, 0, 'a:2:{s:5:"email";s:19:"admin@localhost.loc";s:15:"message_max_len";i:550;}', 28),
(117, 'template_editor', 'template_editor', 0, 0, 0, NULL, 20),
(86, 'group_mailer', 'group_mailer', 0, 0, 1, NULL, 13),
(95, 'filter', 'filter', 1, 1, 0, NULL, 33),
(96, 'cfcm', 'cfcm', 0, 0, 0, NULL, 19),
(121, 'shop', 'shop', 1, 0, 0, NULL, 17),
(135, 'sample_mail', 'sample_mail', 0, 0, 0, NULL, 23),
(137, 'mailer', 'mailer', 1, 0, 0, NULL, 24),
(153, 'share', 'share', 1, 0, 1, 'a:9:{s:5:"vkcom";s:1:"1";s:8:"facebook";s:1:"1";s:7:"twitter";s:1:"1";s:2:"gg";s:1:"1";s:4:"type";s:4:"none";s:13:"facebook_like";s:1:"1";s:8:"vk_apiid";s:0:"";s:7:"gg_like";s:1:"1";s:12:"twitter_like";s:1:"1";}', 11),
(266, 'banners', 'banners', 1, 0, 1, 'a:1:{s:8:"show_tpl";i:1;}', 1),
(216, 'new_level', 'new_level', 1, 1, 1, 'a:3:{s:15:"propertiesTypes";a:2:{i:0;s:6:"scroll";i:2;s:8:"dropDown";}s:7:"columns";a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}s:5:"thema";s:18:"css/color_scheme_1";}', 9),
(181, 'shop_news', 'shop_news', 1, 1, 0, NULL, 27),
(179, 'categories_settings', 'categories_settings', 1, 1, 0, NULL, 7),
(183, 'wishlist', 'wishlist', 1, 1, 0, 'a:10:{s:11:"maxUserName";s:3:"256";s:11:"maxListName";s:3:"254";s:13:"maxListsCount";s:2:"10";s:13:"maxItemsCount";s:3:"100";s:16:"maxCommentLenght";s:3:"500";s:13:"maxDescLenght";s:4:"1000";s:15:"maxWLDescLenght";s:4:"1000";s:13:"maxImageWidth";s:3:"150";s:14:"maxImageHeight";s:3:"150";s:12:"maxImageSize";s:7:"2000000";}" }', 3),
(185, 'exchange', 'exchange', 1, 0, 1, 'a:13:{s:3:"zip";s:2:"no";s:8:"filesize";s:7:"2048000";s:7:"validIP";s:9:"127.0.0.1";s:5:"login";s:10:"ad@min.com";s:8:"password";s:5:"admin";s:11:"usepassword";s:2:"on";s:12:"userstatuses";N;s:10:"autoresize";N;s:5:"debug";N;s:5:"email";s:0:"";s:5:"brand";s:0:"";s:18:"userstatuses_after";s:1:"1";s:6:"backup";s:1:"1";}', 6),
(188, 'cmsemail', 'cmsemail', 1, 0, 1, 'a:9:{s:4:"from";s:41:"Интернет-магазин ImageShop";s:10:"from_email";s:22:"noreplay@client.com.ua";s:11:"admin_email";s:18:"info@client.com.ua";s:5:"theme";s:41:"Интернет-магазин ImageShop";s:12:"wraper_activ";s:2:"on";s:6:"wraper";s:304:"<h2>Интернет-магазин "ImageShop"</h2>\n<div>$content</div>\n<hr />\n<p>С уважением, Интернет-магазин "ImageShop"</p>\n<p><small>Данное письмо создано автоматически, пожалуйста не отвечайте на него.</small></p>";s:8:"mailpath";s:0:"";s:8:"protocol";s:4:"mail";s:4:"port";s:0:"";}', 4),
(270, 'mod_stats', 'mod_stats', 1, 1, 0, NULL, 4),
(271, 'mod_seo', 'mod_seo', 0, 1, 1, NULL, 5),
(191, 'mod_discount', 'mod_discount', 1, 1, 1, NULL, 2),
(253, 'smart_filter', 'smart_filter', 1, 0, 0, NULL, 29),
(204, 'mobile', 'mobile', 1, 1, 0, 'a:5:{s:15:"MobileVersionON";s:1:"1";s:17:"MobileVersionSite";s:21:"demoshop.imagecms.net";s:20:"MobileVersionAddress";s:23:"m.demoshop.imagecms.net";s:18:"mobileTemplatePath";s:37:"./templates/commerce_mobiles/shop";s:6:"action";s:0:"";}', 10),
(261, 'trash', 'trash', 0, 1, 1, NULL, 8),
(264, 'language_switch', 'language_switch', 0, 0, 0, NULL, 26),
(265, 'star_rating', 'star_rating', 1, 0, 0, NULL, 15),
(267, 'translator', 'translator', 1, 1, 1, 'a:2:{s:11:"originsLang";s:2:"en";s:11:"editorTheme";s:6:"chrome";}', 14),
(268, 'imagebox', 'imagebox', 0, 1, 0, NULL, 21),
(269, 'sample_module', 'sample_module', 1, 1, 0, NULL, 7),
(272, 'template_manager', 'template_manager', 1, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(64, 'О магазине', '', 'o-magazine', '', 'магазине', 'О магазине', '<p>Магазин ImageCMS Shop предоставляет огромный выбор техники на любой вкус по лучшим ценам.</p>\n<p>Наш магазин существует более 5 лет и за это время не было ни единого возврата товара.</p>\n<p>Мы обслуживаем ежедневно сотни покупателей и делаем это с радостью.</p>\n<p><strong>Покупайте технику у нас и становитесь обладателем лучшей в мире техники!!!</strong></p>', '', 0, '', '', 0, 0, 0, 'publish', 'ad@min.com', 1291295776, 0, 1395046576, 312, 3, 0),
(65, 'Оплата', '', 'oplata', '', 'оплата', 'Оплата', '<p>Наш магазин поддерживает все доступные на данный момент методы оплаты.</p>\n<p>Также действует возможность оплаты курьеру при доставке для всех крупных городов Украины и России. (возможность оплаты курьеру в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>', '', 0, '', '', 2, 0, 0, 'publish', 'ad@min.com', 1291295824, 1291295836, 1395046610, 170, 3, 0),
(66, 'Доставка', '', 'dostavka', '', 'доставка', 'Доставка', '<p>Мы поддерживаем доставку службой Автомир по всему миру.</p>\n<p>Также возможна доставка курьером для всех больших городов Украины и России (возможность доставки курьером в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>\n<p>При желании Вы можете сами забрать купленный товар в наших офисах.</p>', '', 0, '', '', 1, 0, 0, 'publish', 'ad@min.com', 1291295844, 1291295851, 1395046625, 156, 3, 0),
(67, 'Помощь', '', 'pomoshch', '', 'помощь', 'Помощь', '<p>Для того, чтобы приобрести товар в нашем магазине, Вам нужно выполнить несколько простых шагов:</p>\n<ul>\n<li>Выбрать нужный товар, воспользовавшить навигацией слева, либо поиском.</li>\n<li>Добавить товар в корзину.</li>\n<li>Перейти в корзину, выбрать способ доставки и указать Ваши контактные данные.</li>\n<li>Подтвердить заказ и выбрать способ оплаты.</li>\n</ul>\n<p>После этого наши менеджеры свяжуться с Вами и помогут с оплатой и доставкой товара, а также проконсультируют по любому вопросу.</p>', '', 0, '', '', 3, 0, 0, 'publish', 'ad@min.com', 1291295855, 1291295867, 1395046640, 93, 3, 0),
(68, 'Контакты', '', 'kontakty', '', 'контакты', 'Контакты', '<p><strong>Горячий телефон</strong>: 0 800 80 80 800</p>\n<p><strong>Главный офис</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 095 095 00 00</p>', '', 0, '', '', 4, 0, 0, 'publish', 'ad@min.com', 1291295870, 1291295888, 1395046672, 95, 3, 0),
(75, 'Contact', '', 'kontakty', '', 'ssss', 'ssss', '<p><span id="result_box" lang="en"><span>Hot Phone</span><span>:</span> <span>0800</span> <span>80</span> <span>80 800</span><br /><br /> <span>Head office in</span> <span>Moscow</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>095</span> <span>095</span> <span>00</span> <span>00</span><br /><br /> <span>The main office</span> <span>in Kiev</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>098</span> <span>098</span> <span>00</span> <span>00</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295870, 1291295888, 1343664873, 35, 30, 68),
(76, 'Delivery', '', 'dostavka', '', 'support, the, delivery, service, autoworld, around, world, also, possible, all, major, cities, ukraine, and, russia, possibility, courier, your, area, please, call, desired, you, can, pick, purchased, goods, themselves, our, offices', 'We support the delivery of service Autoworld around the world. It is also possible delivery to all major cities of Ukraine and Russia (the possibility of delivery by courier in your area please call 0800820 22 22.) If desired, you can pick up the purchase', '<p><span id="result_box" lang="en"><span>We support the</span> <span>delivery of</span> <span>service</span> <span>Autoworld</span> <span>around the world.</span><br /><br /> <span>It is also possible</span> <span>delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine and Russia</span> <span>(the possibility of</span> <span>delivery</span> <span>by courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span><br /><br /> <span>If desired,</span> <span>you can</span> <span>pick up the</span> <span>purchased goods</span> <span>themselves</span> <span>in our offices.</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295844, 1291295851, 1343664842, 8, 30, 66),
(77, 'Help', '', 'pomoshch', '', 'order, purchase, goods, our, store, you, must, follow, few, simple, steps, choose, the, right, product, vospolzovavshit, navigation, left, search, add, products, cart, shopping, select, shipping, method, and, provide, your, contact', 'In order to purchase goods in our store, you must follow a few simple steps: Choose the right product, vospolzovavshit navigation on the left, or search. Add products to cart. Go to the shopping cart, select shipping method and provide your contact inform', '<p><span id="result_box" lang="en"><span>In order to</span> <span>purchase goods</span> <span>in our store,</span> <span>you must follow</span> <span>a few simple steps</span><span>:</span><br /><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Choose</span> <span>the right product,</span> <span>vospolzovavshit</span> <span>navigation</span> <span>on the left</span><span>, or</span> <span>search.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Add products</span> <span>to cart</span><span>.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Go to the</span> <span>shopping cart,</span> <span>select</span> <span>shipping method</span> <span>and provide</span> <span>your contact information.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Proceed to checkout</span> <span>and select the</span> <span>payment method.</span><br /><br /> <span>After that,</span> <span>our managers</span> <span>will contact</span> <span>you and</span> <span>help you</span> <span>with payment</span> <span>and delivery</span> <span>of the goods</span><span>, as well</span> <span>as give advice on</span> <span>any subject.</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1343664897, 11, 30, 67),
(78, 'Payment', '', 'oplata', '', 'our, store, supports, all, currently, available, methods, payment, also, there, possibility, pay, the, courier, for, delivery, major, cities, ukraine, and, russia, ability, your, area, please, call', 'Our store supports all currently available methods of payment. Also there is a possibility to pay the courier for delivery to all major cities of Ukraine and Russia. (ability to pay for the courier in your area please call 0800820 22 22.)', '<p><span id="result_box" lang="en"><span>Our store</span> <span>supports all</span> <span>currently available</span> <span>methods of payment.</span><br /><br /> <span>Also there is</span> <span>a possibility to pay</span> <span>the courier</span> <span>for delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine</span> <span>and Russia.</span> <span>(ability to</span> <span>pay for</span> <span>the courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span></span></p>', '', 0, '', '', 0, 1, 3, 'publish', 'admin', 1291295824, 1291295836, 1343664949, 1, 30, 65),
(79, 'About us', '', 'o-magazine', '', 'shop, imagecms, offers, huge, selection, vehicles, suit, every, taste, the, best, prices, our, store, has, more, than, years, and, during, that, time, was, not, single, return, goods, serve, hundreds, customers', 'Shop ImageCMS Shop offers a huge selection of vehicles to suit every taste at the best prices. Our store has more than 5 years and during that time was not a single return of the goods. We serve hundreds of customers every day and do it with joy. Buy equi', '<p><span id="result_box" lang="en"><span>Shop</span> <span>ImageCMS Shop</span> <span>offers</span> <span>a huge selection</span> <span>of vehicles</span> <span>to suit every taste</span> <span>at the best prices</span><span>.</span><br /><br /> <span>Our store</span> <span>has more than</span> <span>5 years</span> <span>and during that time</span> <span>was not a single</span> <span>return of the goods</span><span>.</span><br /><br /> <span>We serve</span> <span>hundreds of</span> <span>customers</span> <span>every day</span> <span>and do</span> <span>it with joy.</span><br /><br /> <span>Buy</span> <span>equipment from</span> <span>us and</span> <span>become the owner of</span> <span>the world''s best</span> <span>technology</span><span>!</span></span></p>', '', 0, '', '', 0, 1, 1, 'publish', 'admin', 1291295776, 1291295792, 1343745649, 5, 30, 64),
(91, 'Как раскрутить сайт? Методы поискового продвижения', '', 'kak-raskrutit-sait-metody-poiskovogo-prodvizheniia', 'novosti/', 'наличие, корпоративного, сайта, стало, стандартом, факто, знаком, хорошего, тона, любой, компании, только, известных, игроков, рынка, независимо, области, вашей, деятельности, собственный, ресурс, любом, случае, принесет, пользу, особенно, знаете, раскрутить, сайт, самостоятельно', 'Наличие корпоративного сайта уже стало стандартом де-факто и знаком   хорошего тона любой компании, а не только известных игроков рынка.   Независимо от области вашей деятельности, собственный ресурс в любом   случае принесет вам пользу, особенно если вы', '<p>Наличие корпоративного сайта уже стало стандартом де-факто и знаком хорошего тона любой компании, а не только известных игроков рынка. Независимо от области вашей деятельности, собственный ресурс в любом случае принесет вам пользу, особенно если вы знаете как раскрутить сайт самостоятельно. Его можно использовать не только для повышения узнаваемости бренда, но и в качестве эффективного инструмента продаж.</p>', '<h1>Интернет-магазин</h1>\n<p>Интернет-магазин &mdash; сайт, торгующий товарами в интернете. Позволяет пользователям сформировать заказ на покупку, выбрать способ оплаты и доставки заказа в сети Интернет.</p>\n<h2>Заголовок второго уровня</h2>\n<h3>Заголовок третьего уровня</h3>\n<p>Выбрав необходимые товары или услуги, пользователь обычно имеет возможность тут же на сайте выбрать метод оплаты и доставки.</p>\n<p>Совокупность отобранных товаров, способ оплаты и доставки представляют собой законченный заказ, который оформляется на сайте путем сообщения минимально необходимой информации о покупателе.</p>\n<h3>Заголовок третьего уровня</h3>\n<p><strong>Основные способы оплаты покупок в интернет-магазине:</strong></p>\n<ul>\n<li>наличный расчет &mdash; товар оплачивается курьеру наличными деньгами при получении покупателем товара, наличный расчет &mdash; товар оплачивается курьеру наличными деньгами при получении покупателем товара;</li>\n<li>электронные деньги &mdash; безналичный вид расчёта;</li>\n<li>терминалы моментальной оплаты &mdash; оплата производится в уличных платёжных терминалах;</li>\n</ul>\n<h4>Заголовок четвертого уровня</h4>\n<p>электронные кассы &mdash; вид расчета, объединяющий практически все перечисленные выше способы оплаты.</p>\n<table>\n<tbody>\n<tr>\n<td>название</td>\n<td>размер</td>\n<td>цена</td>\n</tr>\n<tr>\n<td>длинна трубы</td>\n<td>10 метров</td>\n<td>145 уе</td>\n</tr>\n<tr>\n<td>ширина трубы</td>\n<td>2 метра</td>\n<td>134 уе</td>\n</tr>\n</tbody>\n</table>\n<p>При выборе такого способа оплаты пользователю предлагается на выбор наиболее удобный способ перевода денег от пластиковой карточки до терминала и мобильного телефона.</p>\n<p>Основные способы оплаты покупок в интернет-магазине:</p>\n<ol>\n<li>наличный расчет &mdash; товар оплачивается курьеру наличными деньгами при получении покупателем товара, наличный расчет &mdash; товар оплачивается курьеру наличными деньгами при получении покупателем товара;</li>\n<li>электронные деньги &mdash; безналичный вид расчёта;</li>\n<li>терминалы моментальной оплаты &mdash; оплата производится в уличных платёжных терминалах;</li>\n</ol>\n<p>электронные кассы &mdash; вид расчета, объединяющий практически все перечисленные выше способы оплаты.</p>', 69, '', '', 5, 0, 0, 'publish', 'Administrator', 1362225580, 1362225580, 1387472085, 4, 3, 0),
(92, 'Как добавить сайт в Яндекс и Гугл. Советы начинающим вебмастерам', '', 'kak-dobavit-sait-v-iandeks-i-gugl-sovety-nachinaiushchim-vebmasteram', 'novosti/', 'создание, сайта, само, себе, является, нелегким, довольно, продолжительным, процессом, позади, неприятно, обнаружить, ваш, красивый, наполненный, полезными, материалами, сайт, никто, кроме, самих, заходит, пожалуй, владельцы, сайтов, которые, запустили, свой, первый, проект', 'Создание сайта само по себе является нелегким и довольно продолжительным   процессом, и когда все уже позади, довольно неприятно обнаружить, что   на ваш красивый и наполненный полезными материалами сайт никто кроме  вас  самих не заходит. Пожалуй, владел', '<p>Создание сайта само по себе является нелегким и довольно продолжительным процессом, и когда все уже позади, довольно неприятно обнаружить, что на ваш красивый и наполненный полезными материалами сайт никто кроме вас самих не заходит. Пожалуй, владельцы сайтов, которые запустили свой первый проект, чаще всего испытывают неприятное удивление в связи с этим фактом. А на самом деле все просто &ndash; прежде всего, нужно знать как добавить сайт в поисковики.</p>', '<p>Создание сайта само по себе является нелегким и довольно продолжительным процессом, и когда все уже позади, довольно неприятно обнаружить, что на ваш красивый и наполненный полезными материалами сайт никто кроме вас самих не заходит. Пожалуй, владельцы сайтов, которые запустили свой первый проект, чаще всего испытывают неприятное удивление в связи с этим фактом. А на самом деле все просто &ndash; прежде всего, нужно знать как добавить сайт в поисковики.</p>\n<p>Посетители переходят на сайты из результатов поиска, выдаваемых им Google при вводе определенного запроса. Но, чтобы появится в выдаче по этому запросу, нужно сначала, чтобы поисковый робот проиндексировал ваш сайт, то есть, внес его в свою поисковую базу. Поэтому, если вы имеете понятие про <a href="http://www.imagecms.net/blog/obzory/biznes-v-internete-kak-perspektivnyi-trend" target="_blank">бизнес в Интернете</a>, и уже запустили собственный ресурс, вопрос как добавить сайт в поисковики будет актуальным для каждого вебмастера.</p>\n<p><a href="http://www.imagecms.net/download"><img src="http://www.imagecms.net/uploads/images/blog/2.png" alt="Мощная система для создания сайтов любых типов" width="705" height="183" /></a></p>\n<p>Часто бывает, что ресурс может проиндексироваться сразу же после регистрации доменного имени, но лучше всего самостоятельно добавить сайт в поисковые системы. Тем более, учитывая тот факт, что это займет совсем немного времени.</p>\n<p>&nbsp;</p>\n<h3>Добавить сайт в Яндекс</h3>\n<p>&nbsp;</p>\n<p>Для того, чтобы сообщить этому поисковику о новом сайте, нужно перейти на страницу со специальной формой, которая находится по следующему адресу: <a href="http://webmaster.yandex.ua/addurl.xml" target="_blank">http://webmaster.yandex.ua/addurl.xml</a></p>\n<p>С помощью панельки можно просто и быстро добавить сайт в Яндекс с минимальными затратами времени и сил. Перейдя по ссылке, вы увидите следующую форму: <br /><img src="http://www.imagecms.net/uploads/images/blog/add_yandex.jpg" alt="Форма добавления сайта в индекс ПС Яндекс" width="695" height="266" /> <br />В поле URL ведите адрес сайта, ниже введите цифры с картинки каптчи (защита от спама), после чего нажмите кнопку &laquo;Добавить&raquo;. Поздравляем! Только что вы смогли добавить сайт в Яндекс и уже в ближайшее время на него заглянет поисковый паук, чтобы внести в свою базу. После этого он появится в результатах поиска, и вы получите первых посетителей.</p>\n<p>&nbsp;</p>\n<h3>Добавить сайт в Гугл</h3>\n<p>&nbsp;</p>\n<p>Эта поисковая система является мировым лидером в области web-поиска, и сообщить ей о своем сайте нужно обязательно. Добавить сайт в Гугл еще проще, чем в предыдущем случае, ведь не нужно даже вводить каптчу. Перейдите <a href="https://www.google.com/webmasters/tools/submit-url?hl=ru" target="_blank">по этой ссылке</a> и перед вами откроется окно, с помощью которого можно добавить сайт в Google: <br /><img src="http://www.imagecms.net/uploads/images/blog/add_google.jpg" alt="Добавление url в индекс ПС Google" width="695" height="311" /><br /> Введите адрес и по желанию можно добавить примечание. Хотя вряд ли в этом есть смысл, так как это ни на что не влияет. Кстати, не нужно вводить никаких отдельных страниц, чтобы добавить сайт в Гугл достаточно вставить в поле формы URL главной страницы.</p>\n<p>Как видите, добавить сайт в поисковые системы совсем не сложно. Тем более, если учитывать, что хорошая индексация ведет к росту посещаемости, а значит и повышает <a href="http://www.imagecms.net/blog/obzory/otsenka-stoimosti-saita-i-faktory-kotorye-vliiaiut-na-tsenu" target="_blank">стоимость сайта</a> в целом. Это займет у вас минимум времени, но благодаря проделанным операциям вы сможете быть уверены в том, что поисковые системы узнают о сайте и добавят его в базу, а значит, на сайт начнут заходить посетители. Теперь вы знаете как добавить сайт в Google и можете без проблем сделать это самостоятельно.</p>', 69, '', '', 6, 0, 0, 'publish', 'Administrator', 1362225699, 1362225699, 1387364028, 2, 3, 0),
(93, '8Р: Бизнес в сети', '', '8r-biznes-v-seti', 'novosti/', 'редкий, предприниматель, наше, время, задается, вопросом, «как, помощью, интернета, увеличить, продажи, подробный, обстоятельный, ответ, каждый, сможет, получить, традиционной, ежегодной, конференции, бизнес, сети, которая, третий, состоится, одессе, ожидается, около, участников, этом', 'Редкий предприниматель в наше время не задается вопросом: «Как с помощью  интернета увеличить продажи?» Подробный и обстоятельный ответ каждый  сможет получить на традиционной ежегодной конференции “8Р: Бизнес в  сети”, которая в третий раз состоится в Од', '<p>Редкий предприниматель в наше время не задается вопросом: &laquo;Как с помощью интернета увеличить продажи?&raquo; Подробный и обстоятельный ответ каждый сможет получить на традиционной ежегодной конференции &ldquo;8Р: Бизнес в сети&rdquo;, которая в третий раз состоится &nbsp;в Одессе 13.07.2013г. Ожидается около 700 участников.</p>', '<p>&nbsp;</p>\n<p><img src="http://www.imagecms.net/uploads/images/8p_logo.jpg" alt="" width="300" height="70" />Редкий предприниматель в наше время не задается вопросом: &laquo;Как с помощью интернета увеличить продажи?&raquo; Подробный и обстоятельный ответ каждый сможет получить на традиционной ежегодной конференции &ldquo;8Р: Бизнес в сети&rdquo;, которая в третий раз состоится &nbsp;в Одессе 13.07.2013г. Ожидается около 700 участников.</p>\n<p dir="ltr">В этом году оргкомитет выбрал наиболее актуальные темы, пригласил более 40 докладчиков и решил немного отойти от теоретики, сделав упор на примеры из практики. Большое количество кейсов &ndash; отличительная черта &ldquo;8P&rdquo; 2013.</p>\n<p dir="ltr">В программе конференции предусмотрены 4 потока:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">Интернет-маркетинг &nbsp;&ndash; инструменты онлайн продвижения бизнеса</li>\n<li dir="ltr">E-commerce &ndash; привлечение новых клиентов, увеличение конверсии, формирование лояльности</li>\n<li dir="ltr">Кейсы &ndash; примеры успешного продвижения в сети</li>\n<li dir="ltr">Мастер-классы &ndash; полтора часа непрерывного общения&nbsp;</li>\n</ul>\n<p>&nbsp;</p>\n<p>Оформить регистрацию на конференцию &ldquo;8Р: Бизнес в сети&rdquo; 2013 можно <a href="http://8p.ua/?utm_source=p20954&amp;utm_medium=press_release&amp;utm_campaign=8p">здесь</a>.</p>\n<p dir="ltr">Там же вы можете посмотреть фото и видео с прошлогодней конференции, прочитать отзывы участников.</p>\n<p dir="ltr">Стартовая цена билета &ndash; 950 грн. Внимание: с каждым проданным билетом она возрастает на 1 грн.<br />Адрес конференции: г.Одесса, банкетный дом Ренессанс. От железнодорожного вокзала будет курсировать комфортабельный автобус. Добираться можно и на своем автомобиле - бесплатная парковка к вашим услугам.</p>\n<p>В программе также кофе-брейки, обед, афтер-пати.<br />Испытание на стойкость - афтер-афтер-пати.<br /> <br />Организатор конференции: <a href="http://netpeak.ua">Netpeak</a> - агентство интернет-маркетинга</p>', 69, '', '', 7, 0, 0, 'publish', 'Administrator', 1362225792, 1362225792, 1387364038, 2, 3, 0),
(94, 'Lviv Social Media Camp 2013', '', 'lviv-social-media-camp-2013', 'novosti/', 'lviv, social, media, camp, третья, ежегодная, конференция, вопросам, продвижения, малого, бизнеса, социальных, сетях, состоится, февраля, успешные, форумы, года, собравшие, почти, участников, доказали, покорения, изменчивого, мира, медиа, необходимы, незаурядные, знания, опыт', 'Lviv Social Media Camp 2013 - третья ежегодная конференция по вопросам  продвижения малого бизнеса в социальных сетях - состоится 23 февраля.  Успешные форумы 2011 и 2012 года, собравшие почти 700 участников,  доказали - для покорения изменчивого мира соц', '<p>Lviv Social Media Camp 2013 - третья ежегодная конференция по вопросам продвижения малого бизнеса в социальных сетях - состоится 23 февраля. Успешные форумы 2011 и 2012 года, собравшие почти 700 участников, доказали - для покорения &nbsp;изменчивого мира социальных медиа необходимы незаурядные знания и опыт, которыми могут поделиться только настоящие профессионалы. Как следствие - десятки новых ярких звезд, вспыхнувших в украинском бизнес-пространстве. Такие результаты не могли не вдохновить организаторов на продолжение работы в этом перспективном направлении.</p>', '<p><img src="http://www.imagecms.net/uploads/images/smcamp2013.png" alt="" width="850" height="237" /><br /><a href="http://smcamp.com.ua">Lviv Social Media Camp 2013</a> - третья ежегодная конференция по вопросам продвижения малого бизнеса в социальных сетях - состоится 23 февраля. Успешные форумы 2011 и 2012 года, собравшие почти 700 участников, доказали - для покорения &nbsp;изменчивого мира социальных медиа необходимы незаурядные знания и опыт, которыми могут поделиться только настоящие профессионалы. Как следствие - десятки новых ярких звезд, вспыхнувших в украинском бизнес-пространстве. Такие результаты не могли не вдохновить организаторов на продолжение работы в этом перспективном направлении.<br /> <br />Красноречивые факты:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">22 млн. гривен - общий объем видеорекламы в Уанете.</li>\n<li dir="ltr">680 млн. гривен - объем украинского рынка интернет-рекламы</li>\n<li dir="ltr">180 млн. гривен - объем прошлогоднего рынка Digital-услуг</li>\n<li dir="ltr">Около 20% - &nbsp;прогнозируемый рост Digital на 2013 год</li>\n</ul>\n<p>&nbsp;</p>\n<p><br />Нынешняя программа конференции разработана специально для предпринимателей и представителей малого бизнеса, которым интересны &nbsp;новые возможности для продвижения своего продукта. К тому же, конференция станет точкой сбора для украинских профессионалов SMM.<br /> <br />По традиции, в программе конференции будет три потока:<br /> <br />Social Media Marketing:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">Украинский SMM в 2013 году - успехи и провалы</li>\n<li dir="ltr">Нужен ли SMM украинскому бизнесу?</li>\n<li dir="ltr">Методы манипулирования выдачей Facebook</li>\n<li dir="ltr">Как продвигать "звезд" в YouTube</li>\n<li dir="ltr">Вирусные промокампании</li>\n<li dir="ltr">Использование возможностей Pinterest и Instagram</li>\n<li dir="ltr">Social Media Optimization: о секретных алгоритмах Facebook</li>\n<li dir="ltr">Опыт работы лучших украинских Digital-агентств</li>\n</ul>\n<p>&nbsp;</p>\n<p><br />Social Media и бизнес:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">Нуждается ли мой бизнес в использовании &nbsp;соц. сетей - как узнать?</li>\n<li dir="ltr">Успешные локальные маркетинговые кампании - рассмотрим примеры</li>\n<li dir="ltr">Facebook в Украине, Киеве, во Львове - определяем пользу</li>\n<li dir="ltr">Facebook-страница - как правильно оформить?</li>\n<li dir="ltr">Максимум результата за минимум времени - как добиться?</li>\n<li dir="ltr">Агентства &ndash; стоит ли доверяться?</li>\n</ul>\n<p>&nbsp;</p>\n<p><br />Новые медиа, разработка, стартапы:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">Собственные сервисы и social media - вопросы интеграции</li>\n<li dir="ltr">Mixed media</li>\n<li dir="ltr">Twitter, Facebook, Foursquare API</li>\n<li dir="ltr">BlogCamp</li>\n<li dir="ltr">SmartTV</li>\n<li dir="ltr">Линчи social media стартапов</li>\n</ul>\n<p>&nbsp;</p>\n<p><br />Стоимость билета:<br />200 грн. - Первые 50 билетов для ранних пташек<br />300 грн. - Следующие 200 билетов<br />500 грн. - Предпоследние 50 билетов<br />800 грн. - Кто поздно приходит, тому последние 20 билетов<br /> <br />Встречаемся&nbsp;23 февраля в конференц-зале УКУ (ул.. Хуторовка, 35а).</p>', 69, '', '', 8, 0, 0, 'publish', 'Administrator', 1362225886, 1362225886, 1387364053, 2, 3, 0),
(95, 'Оценка стоимости сайта и факторы, которые влияют на цену', '', 'otsenka-stoimosti-saita-i-faktory-kotorye-vliiaiut-na-tsenu', 'novosti/', 'как, время, разработки, продажи, интернет, ресурса, учитывается, достаточно, много, факторов, влияющих, цену, поэтому, нужно, уметь, оценить, стоимость, сайта, своими, силами, важно, планируете, создание, коммерческого, собираетесь, запустить, личный, блог, знать, финансовые', 'Как во время разработки, так и во время продажи Интернет-ресурса   учитывается достаточно много факторов, влияющих на его цену. Поэтому   нужно уметь оценить стоимость сайта своими силами. Не важно, планируете   ли вы создание коммерческого сайта или соби', '<p>Как во время разработки, так и во время продажи Интернет-ресурса учитывается достаточно много факторов, влияющих на его цену. Поэтому нужно уметь оценить стоимость сайта своими силами. Не важно, планируете ли вы создание коммерческого сайта или собираетесь запустить личный блог, знать финансовые стороны вопроса никогда не будет лишним.</p>', '<p>&nbsp;</p>\n<p><img src="http://www.imagecms.net/uploads/images/blog/site-price.jpg" alt="Быстрая оценка любого сайта" width="250" height="172" />Как во время разработки, так и во время продажи Интернет-ресурса учитывается достаточно много факторов, влияющих на его цену. Поэтому нужно уметь оценить стоимость сайта своими силами. Не важно, планируете ли вы создание коммерческого сайта или собираетесь запустить личный блог, знать финансовые стороны вопроса никогда не будет лишним. <a title="стоимость создания сайта" href="http://www.imagecms.net/blog/obzory/skolko-stoit-sait-postroit" target="_blank">Стоимость создания сайта</a> для многих является ключевым фактором, влияющим на принятие решения о разработка. Многое зависит от необходимых вам возможностей, ведь для простого блога вполне хватит бесплатной версии ImageCMS, а вот уже для торговой площадки понадобится коммерческий модуль Интернет-магазина.</p>\n<p>Оценка стоимости сайта при его разработке зависит от нескольких факторов. Пройдемся по пунктам:</p>\n<p>&nbsp;</p>\n<ul>\n<li>Дизайн. Если он уникальный &ndash; стоимость будет выше, но в этом случае учитываются все ваши пожелания и специфика вашего бизнеса. Индивидуальный подход позволяет сделать внешний вид сайта именно таким, каким вы бы хотели его видеть, и поднять <a title="юзабилити сайт" href="http://www.imagecms.net/blog/obzory/osnovy-iuzabiliti-saita" target="_blank">юзабилити сайта</a> на действительно высокий уровень. Шаблонный сайт обойдется дешевле, что позволит оценить стоимость сайта ниже, но и качество не будет на высоком уровне. Кроме того, такой же шаблон может использоваться и на десятках других сайтов.</li>\n<li>Функциональность. Думаю, не нужно быть профессионалом в web-разработке, чтобы понять, что различие в цене разработки сайта-визитки для местного фотографа и туристического портала, будет существенным. Оценка стоимости сайта в таком случае определяется сложностью добавляемых модулей.</li>\n<li>Контент. Пожалуй, о важности качественного контента на данный момент можно и не напоминать, это аксиома известная всем, как заказчикам, так и исполнителям. Конечно, качественный копирайтинг не может стоить дешево, и чем больше таких страниц нужно создать, тем дороже это обойдется. Точные знания относительно необходимого количества контента, позволяет узнать стоимость сайта более подробно. Но стоит помнить, что вложения в качество обязательно окупятся в долгосрочной перспективе.</li>\n<li>Оптимизация под поисковые системы (SEO). Если вам не нужны посетители, а сайт сделан просто для галочки и надписи на визитке &ndash; можете смело пропускать этот пункт. Вот только зачем тогда его вообще создавать? Оптимизация сайта является важным пунктом договора, который заранее оговаривается при разработке. Чтобы узнать стоимость сайта, необязательно сразу же просчитывать этот пункт, это скорее затраты будущего периода. Особенно хорошо нужно проработать такой момент как <a title="подбор ключевых слов для сайта" href="http://www.imagecms.net/blog/obzory/podbor-kliuchevyh-slov-kak-sdelat-vse-pravilno" target="_blank">подбор ключевых слов</a> для сайта, то есть, составление семантического ядра.</li>\n<li>Тематика сайта. Коммерческая ниша в любом случае будет цениться гораздо выше, чем развлекательная.</li>\n<li>Количество страниц в индексе. Чем их больше, тем выше можно выставить цену при продаже. Хороший багаж в плане контента будет полезен для любого проекта, как залог лояльности со стороны поисковых систем. Главное &ndash; чтобы все материалы сайта были уникальными, а не обычным копипастом.</li>\n<li>Показатели тИЦ и PR. Пожалуй, оценить стоимость сайта на основе этого показателя проще всего. Тут действует простое правило &ndash; чем больше, тем лучше.</li>\n<li>Посещаемость сайта. Оценка стоимости сайта с высокой посещаемостью всегда была высокой. В последнее время, в связи с ужесточением поисковых алгоритмов и увеличением конкуренции, сайты с более-менее пристойным количеством посетителей стали цениться еще выше.</li>\n<li>Присутствие в каталогах DMOZ, Mail.ru и Яндекс.Каталог. Хотя данный фактор уже не имеет такого веса как во времена расцвета ссылочных бирж, но он все еще играет весомую роль, если вас интересует оценка стоимости сайта, так как является своеобразным знаком качества от поисковиков.</li>\n</ul>\n<p>&nbsp;</p>\n<p><a href="http://www.imagecms.net/download"><img src="http://www.imagecms.net/uploads/images/blog/2.png" alt="Загрузить ImageCMS Corporate бесплатно" width="705" height="183" /></a></p>\n<p>Перечисленные выше факторы позволяют точно оценить стоимость сайта еще на этапе проектирования, и в случае надобности &ndash; внести необходимые корректировки. В случае, если ресурс принадлежит вам лично, а не компании, узнать стоимость сайта также очень важно, ведь он является выгодным активом, который можно в любой момент продать. Это может быть как блог, так и узкотематический проект, который хорошо закрепился в своей нише и представляет ценность для пользователей.</p>\n<p>В таком случае узнать стоимость сайта можно с помощью оценки немного других показателей, чем в первом случае. При продаже на стоимость повлияют такие показатели:</p>\n<p>В этой статье мы перечислили все основные факторы, с учетом которых можно оценить стоимость сайта и применить данные методики по отношению как корпоративному, так и личному проекту.</p>', 69, '', '', 9, 0, 0, 'publish', 'Administrator', 1362225958, 1362225958, 1387364060, 2, 3, 0);
INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(96, 'Зачем вашему оффлайн-бизнесу нужен Интернет-магазин?', '', 'zachem-vashemu-offlain-biznesu-nuzhen-internet-magazin', 'novosti/', 'несмотря, бурный, рост, интернет, коммерции, далеко, предприниматели, понимают, преимущества, магазина, особенно, оффлайная, торговая, точка, именно, таком, случае, проявляются, лучше, всего, ведь, получаете, только, отличный, источник, дополнительного, дохода, возможность, сравнения, эффективности', 'Несмотря на бурный рост Интернет-коммерции, далеко не все  предприниматели понимают, в чем преимущества Интернет-магазина, особенно  если уже есть оффлайная торговая точка. Но именно в таком случае  преимущества Интернет-магазина проявляются лучше всего,', '<p>Несмотря на бурный рост Интернет-коммерции, далеко не все предприниматели понимают, в чем преимущества Интернет-магазина, особенно если уже есть оффлайная торговая точка. Но именно в таком случае преимущества Интернет-магазина проявляются лучше всего, ведь вы получаете не только отличный источник дополнительного дохода, но и возможность сравнения эффективности вложения средств.</p>', '<p>&nbsp;</p>\n<p><img src="http://www.imagecms.net/uploads/images/blog/inet-magaz.jpg" alt="Интернет как перспективная бизнес-среда" width="213" height="200" />Несмотря на бурный рост Интернет-коммерции, далеко не все предприниматели понимают, в чем преимущества Интернет-магазина, особенно если уже есть оффлайная торговая точка. Но именно в таком случае преимущества Интернет-магазина проявляются лучше всего, ведь вы получаете не только отличный источник дополнительного дохода, но и возможность сравнения эффективности вложения средств.</p>\n<p>Так зачем нужен Интернет-магазин современному предпринимателю? В зависимости от того, есть ли у вас уже действующий оффлайн-бизнес, он может быть как дополнением к нему, или же основным источником дохода. Уже отталкиваясь от этого, нужно планировать бюджет создания магазина и его развития. Над онлайновой торговой площадкой нужно вести постоянную работу, подробно проработать <a href="http://www.imagecms.net/blog/obzory/biznes-plan-internet-magazina-na-chto-obratit-vnimanie" target="_blank">бизнес-план Интернет-магазина</a> - это не просто визитка, созданная &laquo;для галочки&raquo;... это полноценный и очень эффективный инструмент продаж. Плюсов у онлайн-бизнеса, по сравнению с оффлайном, довольно много.</p>\n<p><a href="http://www.imagecms.net/download"><img src="http://www.imagecms.net/uploads/images/blog/2.png" alt="Система для создания интернет-магазинов - ImageCMS" width="705" height="183" /></a></p>\n<p>Перечислим основные преимущества Интернет-магазина:</p>\n<p>&nbsp;</p>\n<ul>\n<li>можно обойтись без аренды производственных площадей и складов - достаточно небольшого офиса для обслуживания;</li>\n<li>может быть как основным источником прибыли, так и дополнительным по отношению к основному бизнесу - это важное обоснование при вопросе зачем нужен Интернет-магазин;</li>\n<li>гораздо меньший порог вхождения, хотя конкуренция в разных тематиках отличается;</li>\n<li>нет региональных ограничений: можно находить клиентов как в своем городе или области, так и по всей стране;</li>\n<li>доступность в режиме 24/7: круглосуточно и семь дней в неделю;</li>\n<li>такие преимущества Интернет-магазина как экономия времени и свобода выбора, играют важную роль и для покупателей;</li>\n<li><a title="бизнес в Интернете" href="http://www.imagecms.net/blog/obzory/biznes-v-internete-kak-perspektivnyi-trend" target="_blank">бизнес в Интернете</a> не требует большого количества обслуживающего персонала: можно обойтись одним консультантом там, где обычные торговые точки обслуживают пятерых;</li>\n<li>нет ограничений по количеству представленных на виртуальной витрине товаров;</li>\n<li>в случае с раскруткой и продвижением можно сфокусироваться только на потенциально заинтересованных в ваших товарах или услугах пользователях.</li>\n</ul>\n<p>&nbsp;</p>\n<p>Можно привести несколько примеров развертывания Интернет-магазинов на платформе <a href="http://www.imagecms.net/products/imagecms-shop-professional">ImageCMS Shop Professional</a>: boutique-ekaterinasmolina.ru, euro-technika.com.ua и др. Как видно из примеров, можно торговать в онлайне как с небольшим ассортиментом, так и предлагая тысячи наименований товаров. Учитывая вышеперечисленное, каждый владелец бизнеса может понять, зачем нужен Интернет-магазин и какие выгоды от его разработки можно получить (независимо от того, работаете ли вы с розничной торговлей или в области B2B).</p>', 69, '', '', 10, 0, 0, 'publish', 'Administrator', 1362226037, 1362226037, 1387364069, 9, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `content_fields`
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
-- Dumping data for table `content_fields`
--

INSERT INTO `content_fields` (`field_name`, `type`, `label`, `data`, `weight`, `in_search`) VALUES
('field_list_image', 'text', 'Изображение в списке', 'a:7:{s:5:"label";s:38:"Изображение в списке";s:7:"initial";s:0:"";s:9:"help_text";s:109:"Это изображение будет выводиться на странице списка статей";s:4:"type";s:4:"text";s:20:"enable_image_browser";s:1:"1";s:10:"validation";s:0:"";s:6:"groups";a:1:{i:0;s:2:"13";}}', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `content_fields_data`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `content_fields_data`
--

INSERT INTO `content_fields_data` (`id`, `item_id`, `item_type`, `field_name`, `data`) VALUES
(24, 91, 'page', 'field_list_image', '');

-- --------------------------------------------------------

--
-- Table structure for table `content_fields_groups_relations`
--

DROP TABLE IF EXISTS `content_fields_groups_relations`;
CREATE TABLE IF NOT EXISTS `content_fields_groups_relations` (
  `field_name` varchar(64) NOT NULL,
  `group_id` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content_fields_groups_relations`
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
-- Table structure for table `content_field_groups`
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
-- Dumping data for table `content_field_groups`
--

INSERT INTO `content_field_groups` (`id`, `name`, `description`) VALUES
(13, 'Новости', '');

-- --------------------------------------------------------

--
-- Table structure for table `content_permissions`
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
-- Dumping data for table `content_permissions`
--

INSERT INTO `content_permissions` (`id`, `page_id`, `data`) VALUES
(23, 80, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}');

-- --------------------------------------------------------

--
-- Table structure for table `content_tags`
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
-- Table structure for table `custom_fields`
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
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `field_type_id`, `field_name`, `is_required`, `is_active`, `is_private`, `validators`, `entity`, `options`, `classes`, `position`) VALUES
(96, 0, 'city', 0, 1, 0, NULL, 'user', NULL, '', NULL),
(97, 0, 'city', 0, 1, 0, NULL, 'order', NULL, '', NULL),
(99, 0, 'addphone', 0, 1, 0, NULL, 'user', NULL, '', NULL),
(100, 0, 'addphone', 0, 1, 0, NULL, 'order', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields_data`
--

DROP TABLE IF EXISTS `custom_fields_data`;
CREATE TABLE IF NOT EXISTS `custom_fields_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `field_data` text,
  `locale` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=515 ;

--
-- Dumping data for table `custom_fields_data`
--

INSERT INTO `custom_fields_data` (`id`, `field_id`, `entity_id`, `field_data`, `locale`) VALUES
(514, 97, 51, '', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields_i18n`
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
-- Dumping data for table `custom_fields_i18n`
--

INSERT INTO `custom_fields_i18n` (`id`, `locale`, `field_label`, `field_description`, `possible_values`) VALUES
(96, 'ru', 'Город', '', NULL),
(97, 'ru', 'Город', '', NULL),
(99, 'ru', 'Доп. телефон', '', NULL),
(100, 'ru', 'Доп. телефон', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
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
-- Dumping data for table `emails`
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
-- Table structure for table `gallery_albums`
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
-- Table structure for table `gallery_albums_i18n`
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
-- Table structure for table `gallery_category`
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
-- Table structure for table `gallery_category_i18n`
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
-- Table structure for table `gallery_images`
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
-- Table structure for table `gallery_images_i18n`
--

DROP TABLE IF EXISTS `gallery_images_i18n`;
CREATE TABLE IF NOT EXISTS `gallery_images_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `identif`, `image`, `folder`, `template`, `default`, `locale`) VALUES
(3, 'Русский', 'ru', '', 'russian', 'newLevel', 1, 'ru_RU');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip_address` (`ip_address`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=878 ;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
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
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `main_title`, `tpl`, `expand_level`, `description`, `created`) VALUES
(4, 'top_menu', 'Top menu', 'top_menu', 0, 'Меню в верхней части шаблона', '2013-12-18 13:35:13'),
(11, 'left_menu', 'left_menu', 'left_menu', 1, 'Меню в левой части шаблона', '2013-03-18 16:13:38'),
(12, 'footer_menu_mobile', 'footer_menu_mobile', '', 0, 'Меню нижней части мобильной версии', '2013-09-19 17:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `menus_data`
--

DROP TABLE IF EXISTS `menus_data`;
CREATE TABLE IF NOT EXISTS `menus_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `add_data` text,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

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
(17, 4, 67, 'page', '', '', 0, 'Помощь', 0, 5, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
(18, 4, 68, 'page', '', '', 0, 'Контакты', 0, 7, NULL, 'a:1:{s:7:"newpage";s:1:"0";}'),
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
(37, 11, 69, 'category', NULL, '', 0, 'Новости', 0, 5, NULL, 'N;'),
(50, 11, 65, 'page', '', '', 0, 'Оплата', 0, 3, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(49, 11, 68, 'page', '', '', 0, 'Контакты', 0, 6, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(40, 4, 69, 'category', NULL, '', 0, 'Новости', 0, 6, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(41, 11, 64, 'page', NULL, 'a:1:{i:0;s:1:"0";}', 0, 'О магазине', 0, 1, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";i:0;}'),
(42, 11, 66, 'page', NULL, '', 0, 'Доставка', 0, 2, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(43, 11, 67, 'page', NULL, '', 0, 'Помощь', 0, 4, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(44, 12, 67, 'page', '', '', 0, 'Помощь', 0, 2, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(45, 12, 65, 'page', '', '', 0, 'Оплата', 0, 3, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(46, 12, 35, 'page', '', '', 0, 'О сайте', 0, 4, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(47, 12, 66, 'page', '', '', 0, 'Доставка', 0, 5, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(48, 4, 65, 'page', '', '', 0, 'Оплата', 0, 4, NULL, 'a:1:{s:7:"newpage";i:0;}');

-- --------------------------------------------------------

--
-- Table structure for table `menu_translate`
--

DROP TABLE IF EXISTS `menu_translate`;
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

-- --------------------------------------------------------

--
-- Table structure for table `mod_banner`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mod_banner`
--

INSERT INTO `mod_banner` (`id`, `active`, `active_to`, `where_show`, `group`, `position`) VALUES
(1, 1, 1512079200, 'a:3:{i:0;s:6:"main_0";i:1;s:16:"shop_category_40";i:2;s:16:"shop_category_43";}', NULL, 1),
(2, 1, 1572465600, 'a:2:{i:0;s:6:"main_0";i:1;s:8:"brand_26";}', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mod_banner_i18n`
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
-- Dumping data for table `mod_banner_i18n`
--

INSERT INTO `mod_banner_i18n` (`id`, `url`, `locale`, `name`, `description`, `photo`) VALUES
(1, 'shop/brand/epson', 'ru', 'epson', '', '/uploads/shop/banners/template-imageshop-banner-2.jpg'),
(2, '/shop/brand/sony', 'ru', 'sony', '', '/uploads/shop/banners/template-imageshop-banner-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mod_discount_all_order`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mod_discount_brand`
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
-- Table structure for table `mod_discount_category`
--

DROP TABLE IF EXISTS `mod_discount_category`;
CREATE TABLE IF NOT EXISTS `mod_discount_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `child` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mod_discount_comulativ`
--

DROP TABLE IF EXISTS `mod_discount_comulativ`;
CREATE TABLE IF NOT EXISTS `mod_discount_comulativ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_id` int(11) DEFAULT NULL,
  `begin_value` int(11) DEFAULT NULL,
  `end_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mod_discount_group_user`
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
-- Table structure for table `mod_discount_product`
--

DROP TABLE IF EXISTS `mod_discount_product`;
CREATE TABLE IF NOT EXISTS `mod_discount_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mod_discount_user`
--

DROP TABLE IF EXISTS `mod_discount_user`;
CREATE TABLE IF NOT EXISTS `mod_discount_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mod_discount_user`
--

INSERT INTO `mod_discount_user` (`id`, `user_id`, `discount_id`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mod_email_paterns`
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
-- Dumping data for table `mod_email_paterns`
--

INSERT INTO `mod_email_paterns` (`id`, `name`, `patern`, `from`, `from_email`, `admin_email`, `type`, `user_message_active`, `admin_message_active`) VALUES
(1, 'make_order', '', '', '', '', 'HTML', 1, 1),
(2, 'change_order_status', '', '', '', '', 'HTML', 1, 0),
(3, 'notification_email', '', '', '', '', 'HTML', 1, 0),
(4, 'create_user', '', '', '', '', 'HTML', 1, 0),
(5, 'forgot_password', '', '', '', '', 'HTML', 1, 0),
(6, 'change_password', '', '', '', '', 'HTML', 1, 0),
(7, 'price_change', '', '', '', '', 'HTML', 1, 0),
(8, 'wish_list', '', '', '', '', 'HTML', 1, 1),
(9, 'callback', '', '', '', '', 'HTML', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mod_email_paterns_i18n`
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
-- Dumping data for table `mod_email_paterns_i18n`
--

INSERT INTO `mod_email_paterns_i18n` (`id`, `locale`, `theme`, `user_message`, `admin_message`, `description`, `variables`) VALUES
(1, 'ru', 'Заказ товара', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Мы благодарны Вам за то, что совершили заказ в нашем магазине.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Вы указали следующие контактные данные:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$userEmail$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Номер телефона: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Адрес доставки: </span>$userDeliver$</div>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.</p>\n<p style="font-family: arial; font-size: 13px;">Также, Вы можете всегда посмотреть за статусом Вашего заказа, <a href="$orderLink$" target="_blank">перейдя по ссылке</a>.</p>', '<p>Пользователь&nbsp;$userName$ совершил заказ товара</p>\n<p>Email адрес: $userEmail$</p>\n<p>Номер телефона: $userPhone$</p>\n<p>Адрес доставки: $userDeliver$</p>', '<p><span>Уведомление покупателя о совершении заказа</span></p>', 'a:5:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$userPhone$";s:39:"Телефон Пользователя";s:13:"$userDeliver$";s:27:"Адрес доставки";s:11:"$orderLink$";s:28:"Ссылка на заказ";}'),
(2, 'ru', 'Смена статуса заказа', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Статус вашего заказа изменен на <strong>$status$</strong></p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Вы указали следующие контактные данные:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$userEmail$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Номер телефона: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Адрес доставки: </span>$userDeliver$</div>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.</p>\n<p style="font-family: arial; font-size: 13px;">Также, Вы можете всегда посмотреть за статусом Вашего заказа, <a href="$orderLink$" target="_blank">перейдя по ссылке</a>.</p>', '', '<p>Смена статуса заказа</p>', 'a:4:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$orderLink$";s:28:"Ссылка на заказ";s:8:"$status$";s:25:"Статус заказа";}'),
(3, 'ru', 'Товар появился на складе!', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Товар&nbsp;<a href="$productLink$" target="_blank">$productName$</a>&nbsp;появился на складе. Вы можете его заказать.</p>', '', '<p>Уведомление о появлении</p>', 'a:5:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:13:"$productName$";s:33:"Название продукта";s:8:"$status$";s:12:"Статус";s:13:"$productLink$";s:32:"Ссылка на продукт";}'),
(4, 'ru', 'Создание пользователя', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $user_name$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Поздравляем! Ваша регистрация прошла успешно.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Данные для входа в магазин:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$user_email$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Пароль: </span>$user_password$</div>', '<p><span>Создан пользователь $user_name$:</span><br /><span>С паролем: $user_password$</span><br /><span>Адресом: &nbsp;$<span>user_</span>address$</span><br /><span>Email пользователя: $user_email$</span><br /><span>Телефон пользователя: $user_phone$</span></p>', '<p>Шаблон письма на создание пользователя</p>', 'a:5:{s:11:"$user_name$";s:31:"Имя пользователя";s:15:"$user_password$";s:12:"Пароль";s:14:"$user_address$";s:12:"Адресс";s:12:"$user_email$";s:5:"Email";s:12:"$user_phone$";s:14:"Телефон";}'),
(5, 'ru', 'Восстановление пароля', '<p><span>Здравствуйте!</span><br /><br /><span>На сайте $webSiteName$ создан запрос на восстановление пароля для Вашего аккаунта.</span><br /><br /><span>Для завершения процедуры восстановления пароля перейдите по ссылке $resetPasswordUri$</span><br /><br /><span>Ваш новый пароль для входа: $password$</span><br /><br /><span>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь по телефонам:</span><br /><br /><span>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89</span><br /><br /><span>---</span><br /><br /><span>С уважением,</span><br /><br /><span>сотрудники службы продаж $webSiteName$</span></p>', '', 'Шаблон письма на  восстановление пароля', 'a:5:{s:13:"$webSiteName$";s:17:"Имя сайта";s:18:"$resetPasswordUri$";s:59:"Ссылка на восстановления пароля";s:10:"$password$";s:12:"Пароль";s:5:"$key$";s:8:"Ключ";s:16:"$webMasterEmail$";s:54:"Email сотрудников службы продаж";}'),
(6, 'ru', 'Смена пароля', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Вы успешно изменили пароль</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Ваш новый пароль для входа: $password$</p>', '', '<p>Шаблон письма изменения пароля</p>', 'a:2:{s:11:"$user_name$";s:31:"Имя пользователя";s:10:"$password$";s:23:"Новый пароль";}'),
(7, 'ru', 'Изменение цены', '<p>Цена на $name$ за которым вы следите на сайте $server$ изменилась.</p>\n<p><a title="Посмотреть список слежения" href="$list_url_look$">Посмотреть список слежения</a></p>\n<p><a title="Отписатся от слежения" href="$delete_list_url_look$">Отписатся от слежения</a></p>', '<p>&nbsp;</p>\n<div id="dc_vk_code">&nbsp;</div>', '<p>Изменение цены</p>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>', ''),
(7, 'ua', 'Ціна змінилася', '<p>Ціна на $name$ за яким Ви слідкуєте на сайті $server$ змінилася.<br /> <a title="Переглянути список слідкувань" href="$list_url_look$">Переглянути список слідкувань</a><br /> <a title="Відписатися від слідкування" href="$delete_list_url_look$">Відписатися від слідкування</a></p>\n<div id="dc_vk_code"  none;">&nbsp;</div>', '<p>&nbsp;</p>\n<div id="dc_vk_code">&nbsp;</div>', '<p>Слідкування за ціною</p>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>', ''),
(8, 'ru', 'Список Желаний', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Вы создали список желаний $wishName$</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Ссылка на просмотр списка желаний <a href="$wishLink$" target="_blank">$wishLink$</a></p>', '<p>Пользователь&nbsp;<span>$userName$ совершил заказ товара&nbsp;</span></p>\n<p><span><span>Email адрес: $userEmail$</span><br /><br /><span>Номер телефона: $userPhone$</span><br /><br /><span>Адрес доставки: $userDeliver$</span></span></p>', '<p><span>Уведомление покупателя о совершении заказа</span></p>', 'a:4:{s:10:"$userName$";s:31:"Имя пользователя";s:10:"$wishName$";s:29:"Название списка";s:10:"$wishLink$";s:30:"Ссилка на список";s:15:"$wishListViews$";s:54:"Количество просмотров списка";}'),
(9, 'ru', 'Заказ звонка', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Вы заказали звонок в нашей компании<br />Менеджеры нашего магазина вскоре свяжутся с Вами.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Вы указали следующие контактные данные:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Телефон: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Коментарий: </span>$userComment$</div>', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Новий запрос о Заказе дзвонка от $userName$</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Дата колбека: </span>$dateCreated$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Телефон пользователя: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Коментарий пользователя: </span>$userComment$</div>', '<p>Шаблон заказа звонока</p>', 'a:6:{s:16:"$callbackStatus$";s:27:"Статус колбека";s:15:"$callbackTheme$";s:23:"Тема колбека";s:10:"$userName$";s:69:"Имя пользователя запросившего звонок";s:13:"$dateCreated$";s:23:"Дата колбека";s:13:"$userComment$";s:63:" Комментарии пользователя колбека";s:11:"$userPhone$";s:90:"Номер телефона пользователя запросившего колбек";}');

-- --------------------------------------------------------

--
-- Table structure for table `mod_new_level_columns`
--

DROP TABLE IF EXISTS `mod_new_level_columns`;
CREATE TABLE IF NOT EXISTS `mod_new_level_columns` (
  `category_id` varchar(500) NOT NULL,
  `column` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mod_new_level_product_properties_types`
--

DROP TABLE IF EXISTS `mod_new_level_product_properties_types`;
CREATE TABLE IF NOT EXISTS `mod_new_level_product_properties_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `type` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mod_new_level_product_properties_types`
--

INSERT INTO `mod_new_level_product_properties_types` (`id`, `property_id`, `name`, `type`) VALUES
(1, 29, 0, 'a:1:{i:0;s:6:"scroll";}'),
(4, 28, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(5, 22, 0, 'a:1:{i:0;s:8:"dropDown";}'),
(6, 21, 0, 'a:1:{i:0;s:6:"scroll";}'),
(7, 24, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}');

-- --------------------------------------------------------

--
-- Table structure for table `mod_sample_settings`
--

DROP TABLE IF EXISTS `mod_sample_settings`;
CREATE TABLE IF NOT EXISTS `mod_sample_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mod_sample_settings`
--

INSERT INTO `mod_sample_settings` (`id`, `name`, `value`) VALUES
(1, 'mailTo', 'admin@site.com'),
(2, 'useEmailNotification', 'TRUE'),
(3, 'key', 'UUUsssTTTeee');

-- --------------------------------------------------------

--
-- Table structure for table `mod_seo`
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
-- Table structure for table `mod_seo_inflect`
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
-- Table structure for table `mod_seo_products`
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
-- Table structure for table `mod_shop_discounts`
--

DROP TABLE IF EXISTS `mod_shop_discounts`;
CREATE TABLE IF NOT EXISTS `mod_shop_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(25) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mod_shop_discounts`
--

INSERT INTO `mod_shop_discounts` (`id`, `key`, `name`, `active`, `max_apply`, `count_apply`, `date_begin`, `date_end`, `type_value`, `value`, `type_discount`) VALUES
(1, '1mf82j8lypb107d5', NULL, 1, NULL, NULL, 1387490400, 0, 1, 12, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `mod_shop_discounts_i18n`
--

DROP TABLE IF EXISTS `mod_shop_discounts_i18n`;
CREATE TABLE IF NOT EXISTS `mod_shop_discounts_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_shop_discounts_i18n`
--

INSERT INTO `mod_shop_discounts_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'знижка адміна');

-- --------------------------------------------------------

--
-- Table structure for table `mod_shop_news`
--

DROP TABLE IF EXISTS `mod_shop_news`;
CREATE TABLE IF NOT EXISTS `mod_shop_news` (
  `content_id` int(11) NOT NULL,
  `shop_categories_ids` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mod_sitemap_blocked_urls`
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
-- Table structure for table `mod_sitemap_changefreq`
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
-- Dumping data for table `mod_sitemap_changefreq`
--

INSERT INTO `mod_sitemap_changefreq` (`id`, `main_page_changefreq`, `pages_changefreq`, `product_changefreq`, `categories_changefreq`, `products_categories_changefreq`, `products_sub_categories_changefreq`, `brands_changefreq`, `sub_categories_changefreq`) VALUES
(1, 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly');

-- --------------------------------------------------------

--
-- Table structure for table `mod_sitemap_priorities`
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
-- Dumping data for table `mod_sitemap_priorities`
--

INSERT INTO `mod_sitemap_priorities` (`id`, `main_page_priority`, `cats_priority`, `pages_priority`, `sub_cats_priority`, `products_priority`, `products_categories_priority`, `products_sub_categories_priority`, `brands_priority`) VALUES
(1, 1, 0.8, 0.9, 0.7, 0.4, 0.6, 0.5, 0.3);

-- --------------------------------------------------------

--
-- Table structure for table `mod_stats_attendance`
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
-- Table structure for table `mod_stats_attendance_robots`
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
-- Table structure for table `mod_stats_search`
--

DROP TABLE IF EXISTS `mod_stats_search`;
CREATE TABLE IF NOT EXISTS `mod_stats_search` (
  `key` varchar(70) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `ac` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mod_stats_settings`
--

DROP TABLE IF EXISTS `mod_stats_settings`;
CREATE TABLE IF NOT EXISTS `mod_stats_settings` (
  `setting` varchar(70) DEFAULT NULL,
  `value` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mod_wish_list`
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
-- Table structure for table `mod_wish_list_products`
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
-- Table structure for table `mod_wish_list_users`
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

-- --------------------------------------------------------

--
-- Table structure for table `propel_migration`
--

DROP TABLE IF EXISTS `propel_migration`;
CREATE TABLE IF NOT EXISTS `propel_migration` (
  `version` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `propel_migration`
--

INSERT INTO `propel_migration` (`version`) VALUES
(1401265086);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
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
-- Table structure for table `search`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
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
  `lang_sel` varchar(15) NOT NULL DEFAULT 'russian_lang',
  `google_webmaster` varchar(200) DEFAULT NULL,
  `yandex_webmaster` varchar(200) DEFAULT NULL,
  `yandex_metric` varchar(11) NOT NULL,
  `ss` varchar(255) NOT NULL,
  `cat_list` varchar(10) NOT NULL,
  `text_editor` varchar(30) NOT NULL,
  `siteinfo` text NOT NULL,
  `update` text,
  `backup` text,
  `robots_status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `s_name` (`s_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `google_analytics_id`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`, `lang_sel`, `google_webmaster`, `yandex_webmaster`, `yandex_metric`, `ss`, `cat_list`, `text_editor`, `siteinfo`, `update`, `backup`, `robots_status`) VALUES
(2, 'main', 'auto', 'auto', '0', '0', 1, 1, '/', '0', 'newLevel', 'no', '', 'module', 69, '63', 'shop', '', '', 'russian_lang', '', '', '', '', 'yes', 'tinymce', 'a:3:{s:13:"siteinfo_logo";a:1:{s:8:"newLevel";s:8:"logo.png";}s:16:"siteinfo_favicon";a:1:{s:8:"newLevel";s:11:"favicon.ico";}s:2:"ru";a:5:{s:20:"siteinfo_companytype";s:97:"© Интернет-магазин «<a href="http://www.imagecms.net/">ImageCMS Shop</a>», 2013";s:16:"siteinfo_address";s:63:"Улица Шевченка, Буд. 22, офис: 39, Київ";s:18:"siteinfo_mainphone";s:15:"(097) 567-43-21";s:19:"siteinfo_adminemail";s:19:"webmaster@localhost";s:8:"contacts";a:2:{s:5:"Skype";s:8:"imagecms";s:5:"Email";s:20:"partner@imagecms.net";}}}', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings_i18n`
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
-- Dumping data for table `settings_i18n`
--

INSERT INTO `settings_i18n` (`id`, `lang_ident`, `name`, `short_name`, `description`, `keywords`) VALUES
(1, 3, 'ImageCMS DemoShop', 'ImageCMS', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_banners`
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
-- Dumping data for table `shop_banners`
--

INSERT INTO `shop_banners` (`id`, `position`, `active`, `categories`, `on_main`, `espdate`) VALUES
(7, 23, 1, 'false', 1, 2147483647),
(11, 24, 1, 'false', 1, 2147457600),
(12, 25, 1, 'false', 1, 2147457600);

-- --------------------------------------------------------

--
-- Table structure for table `shop_banners_i18n`
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
-- Dumping data for table `shop_banners_i18n`
--

INSERT INTO `shop_banners_i18n` (`id`, `locale`, `name`, `text`, `url`, `image`) VALUES
(12, 'ru', 'Samsung', ' ', '/shop/brand/samsung', 'template-imageshop-banner-3.jpg'),
(7, 'ru', 'Epson', ' ', '/shop/brand/epson', 'template-imageshop-banner-1.jpg'),
(11, 'ru', 'Sony', ' ', '/shop/brand/sony', 'template-imageshop-banner-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_brands`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=275 ;

--
-- Dumping data for table `shop_brands`
--

INSERT INTO `shop_brands` (`id`, `url`, `image`, `position`, `created`, `updated`) VALUES
(30, 'pioneer', 'pioneer.png', 0, 1401265119, 1401265119),
(39, 'motorola', NULL, 0, 1401265119, 1401265119),
(26, 'sony', 'sony.png', 0, 1401265119, 1401265119),
(27, 'apple', 'apple.png', 0, 1401265119, 1401265119),
(28, 'samsung', 'samsung.png', 0, 1401265119, 1401265119),
(29, 'panasonic', 'panasonic.jpg', 0, 1401265119, 1401265119),
(34, 'canon', NULL, 0, 1401265119, 1401265119),
(35, 'lg', 'lg.png', 0, 1401265119, 1401265119),
(36, 'yamaha', 'yamaha.png', 0, 1401265119, 1401265119),
(37, 'epson', NULL, 0, 1401265119, 1401265119),
(38, 'plantronics', NULL, 0, 1401265119, 1401265119),
(41, 'asus', 'asus.png', 0, 1401265119, 1401265119),
(42, 'nokia', 'nokia.png', 0, 1401265119, 1401265119),
(43, 'Dell', NULL, 0, 1401265119, 1401265119),
(44, 'acer', NULL, 0, 1401265119, 1401265119),
(45, 'fujitsu', NULL, 0, 1401265119, 1401265119),
(46, 'hp-hewlett-packard', NULL, 0, 1401265119, 1401265119),
(47, 'lenovo', NULL, 0, 1401265119, 1401265119),
(48, 'msi', NULL, 0, 1401265119, 1401265119),
(49, 'packard-bell', NULL, 0, 1401265119, 1401265119),
(50, 'toshiba', NULL, 0, 1401265119, 1401265119),
(51, 'aeg', NULL, 0, 1401265119, 1401265119),
(52, 'ardo', NULL, 0, 1401265119, 1401265119),
(53, 'atlant', NULL, 0, 1401265119, 1401265119),
(54, 'beko', NULL, 0, 1401265119, 1401265119),
(55, 'bosch', NULL, 0, 1401265119, 1401265119),
(56, 'candy', NULL, 0, 1401265119, 1401265119),
(57, 'daewoo', NULL, 0, 1401265119, 1401265119),
(58, 'delfa', NULL, 0, 1401265119, 1401265119),
(59, 'electrolux', NULL, 0, 1401265119, 1401265119),
(60, 'gorenje', NULL, 0, 1401265119, 1401265119),
(61, 'hitachi', NULL, 0, 1401265119, 1401265119),
(62, 'hotpoint-ariston', NULL, 0, 1401265119, 1401265119),
(63, 'indesit', NULL, 0, 1401265119, 1401265119),
(76, 'amf', 'amf.gif', 0, 1401265119, 1401265119),
(65, 'kaiser', NULL, 0, 1401265119, 1401265119),
(67, 'liebherr', NULL, 0, 1401265119, 1401265119),
(68, 'nord', NULL, 0, 1401265119, 1401265119),
(69, 'sharp', NULL, 0, 1401265119, 1401265119),
(70, 'siemens', NULL, 0, 1401265119, 1401265119),
(71, 'smeg', NULL, 0, 1401265119, 1401265119),
(72, 'snaige', NULL, 0, 1401265119, 1401265119),
(73, 'swizer', NULL, 0, 1401265119, 1401265119),
(74, 'whirlpool', NULL, 0, 1401265119, 1401265119),
(75, 'zanussi', NULL, 0, 1401265119, 1401265119),
(77, 'philsps', NULL, 0, 1401265119, 1401265119),
(78, 'clatronic', NULL, 0, 1401265119, 1401265119),
(79, 'dex', NULL, 0, 1401265119, 1401265119),
(80, 'liberton', NULL, 0, 1401265119, 1401265119),
(81, 'mystery', NULL, 0, 1401265119, 1401265119),
(82, 'saturn', NULL, 0, 1401265119, 1401265119),
(83, 'ves-electric', NULL, 0, 1401265119, 1401265119),
(84, 'illuminati', 'illuminati.jpg', 0, 1401265119, 1401265119),
(85, 'binatone', NULL, 0, 1401265119, 1401265119),
(86, 'braun', NULL, 0, 1401265119, 1401265119),
(87, 'maxwell', NULL, 0, 1401265119, 1401265119),
(88, 'moulinex', NULL, 0, 1401265119, 1401265119),
(89, 'vitek', NULL, 0, 1401265119, 1401265119),
(90, 'zelmer', NULL, 0, 1401265119, 1401265119),
(91, 'easy-camp', 'easy-camp.gif', 0, 1401265119, 1401265119),
(92, 'beco', 'beco.jpg', 0, 1401265119, 1401265119),
(93, 'atemi', 'atemi.jpg', 0, 1401265119, 1401265119),
(94, 'huawei', NULL, 0, 1401265119, 1401265119),
(95, 'aoc', NULL, 0, 1401265119, 1401265119),
(96, 'philips', NULL, 0, 1401265119, 1401265119),
(97, 'viewsonic', NULL, 0, 1401265119, 1401265119),
(98, 'babolat', 'babolat.jpg', 0, 1401265119, 1401265119),
(99, 'donic', 'donic.jpg', 0, 1401265119, 1401265119),
(100, 'abizal', 'abizal.jpg', 0, 1401265119, 1401265119),
(101, 'donic', NULL, 0, 1401265119, 1401265119),
(102, 'donic-schildkrot', 'donic-schildkrot.jpg', 0, 1401265119, 1401265119),
(103, 'fischer', 'fischer.jpg', 0, 1401265119, 1401265119),
(104, 'giant-dragon', 'giant-dragon.jpg', 0, 1401265119, 1401265119),
(105, 'outwell', 'outwell.jpg', 0, 1401265119, 1401265119),
(106, 'axl', 'axl.jpg', 0, 1401265119, 1401265119),
(107, 'bcrich', 'bcrich.jpg', 0, 1401265119, 1401265119),
(108, 'tefal', NULL, 0, 1401265119, 1401265119),
(109, 'TEXET', 'TEXET.jpg', 0, 1401265119, 1401265119),
(110, 'SportBaby', 'SportBaby.png', 0, 1401265119, 1401265119),
(111, 'brd', NULL, 0, 1401265119, 1401265119),
(112, 'HTC', 'HTC.jpg', 0, 1401265119, 1401265119),
(113, 'Assistant', NULL, 0, 1401265119, 1401265119),
(114, 'Kingston', 'Kingston.jpg', 0, 1401265119, 1401265119),
(115, 'delonghi', NULL, 0, 1401265119, 1401265119),
(116, 'dune', NULL, 0, 1401265119, 1401265119),
(117, 'nakamichi', NULL, 0, 1401265119, 1401265119),
(156, 'logitech', NULL, 0, 1401265119, 1401265119),
(119, 'fly', NULL, 0, 1401265119, 1401265119),
(120, '4232', NULL, 0, 1401265119, 1401265119),
(121, 'onkyo', NULL, 0, 1401265119, 1401265119),
(122, 'popcorn-hour', NULL, 0, 1401265119, 1401265119),
(123, 'acme-made', NULL, 0, 1401265119, 1401265119),
(124, 'case-logic', NULL, 0, 1401265119, 1401265119),
(125, 'thule', NULL, 0, 1401265119, 1401265119),
(126, 'x-digital', NULL, 0, 1401265119, 1401265119),
(127, 'continent', NULL, 0, 1401265119, 1401265119),
(128, 'sumdex', NULL, 0, 1401265119, 1401265119),
(129, 'trust', NULL, 0, 1401265119, 1401265119),
(130, 'hobby-engine', NULL, 0, 1401265119, 1401265119),
(131, 'digi', NULL, 0, 1401265119, 1401265119),
(132, 'Alcatel', 'Alcatel.jpg', 0, 1401265119, 1401265119),
(133, 'tarti', NULL, 0, 1401265119, 1401265119),
(134, 'viara', 'viara.jpg', 0, 1401265119, 1401265119),
(135, 'wish', 'wish.jpg', 0, 1401265119, 1401265119),
(136, 'vestfrost', NULL, 0, 1401265119, 1401265119),
(137, 'tiny-love', NULL, 0, 1401265119, 1401265119),
(138, 'Redox', 'Redox.jpg', 0, 1401265119, 1401265119),
(139, 'iron-body', NULL, 0, 1401265119, 1401265119),
(140, 'machuka', NULL, 0, 1401265119, 1401265119),
(141, 'winner', NULL, 0, 1401265119, 1401265119),
(142, 'Jabra', 'Jabra.jpg', 0, 1401265119, 1401265119),
(143, 'bbk', NULL, 0, 1401265119, 1401265119),
(144, 'horizont', NULL, 0, 1401265119, 1401265119),
(145, 'bcrich', NULL, 0, 1401265119, 1401265119),
(146, 'asrock', NULL, 0, 1401265119, 1401265119),
(147, 'biostar', NULL, 0, 1401265119, 1401265119),
(148, 'elitegroup', NULL, 0, 1401265119, 1401265119),
(149, 'yashima', NULL, 0, 1401265119, 1401265119),
(150, 'ufo', NULL, 0, 1401265119, 1401265119),
(151, 'behringer', 'behringer.jpg', 0, 1401265119, 1401265119),
(152, 'iriver', NULL, 0, 1401265119, 1401265119),
(153, 'transcend', NULL, 0, 1401265119, 1401265119),
(154, 'ergo', 'ergo.jpg', 0, 1401265119, 1401265119),
(155, 'iriver', 'iriver.jpg', 0, 1401265119, 1401265119),
(157, 'genius', NULL, 0, 1401265119, 1401265119),
(158, 'ariston', NULL, 0, 1401265119, 1401265119),
(159, 'hotpoin-ariston', NULL, 0, 1401265119, 1401265119),
(160, 'schildkrot', NULL, 0, 1401265119, 1401265119),
(161, 'robens', NULL, 0, 1401265119, 1401265119),
(162, 'apache', 'apache.jpg', 0, 1401265119, 1401265119),
(163, 'albertilivio', 'albertilivio.jpg', 0, 1401265119, 1401265119),
(164, 'exit', NULL, 0, 1401265119, 1401265119),
(165, 'jungle-gym', NULL, 0, 1401265119, 1401265119),
(166, 'space-scooter', NULL, 0, 1401265119, 1401265119),
(167, '4SeasonsOutdoor', '4SeasonsOutdoor.png', 0, 1401265119, 1401265119),
(168, 'koss', 'koss.jpg', 0, 1401265119, 1401265119),
(169, 'tm-katinka', NULL, 0, 1401265119, 1401265119),
(170, 'tramp', NULL, 0, 1401265119, 1401265119),
(171, 'sol', NULL, 0, 1401265119, 1401265119),
(172, 'totem', NULL, 0, 1401265119, 1401265119),
(173, 'destroyer', NULL, 0, 1401265119, 1401265119),
(176, 'famiche-darte-fl', ' ', 0, 1401265119, 1401265119),
(177, 'Eglo', 'Eglo.png', 0, 1401265119, 1401265119),
(178, 'stilars', 'stilars.jpg', 0, 1401265119, 1401265119),
(179, 'daniels-di-elisabetta-zucconi', NULL, 0, 1401265119, 1401265119),
(180, 'euromarchi-srl', NULL, 0, 1401265119, 1401265119),
(181, 'franco-srl', NULL, 0, 1401265119, 1401265119),
(182, 'binatone', NULL, 0, 1401265119, 1401265119),
(183, 'thomas', NULL, 0, 1401265119, 1401265119),
(184, 'rowenta', NULL, 0, 1401265119, 1401265119),
(185, 'elektrostatyk', NULL, 0, 1401265119, 1401265119),
(186, 'rock-empire', NULL, 0, 1401265119, 1401265119),
(187, 'kovea', NULL, 0, 1401265119, 1401265119),
(188, 'silicon-power', NULL, 0, 1401265119, 1401265119),
(189, 'pqi', NULL, 0, 1401265119, 1401265119),
(190, 'verbatim', NULL, 0, 1401265119, 1401265119),
(191, 'orgaz', NULL, 0, 1401265119, 1401265119),
(192, 'gzwm', NULL, 0, 1401265119, 1401265119),
(193, 'goodram', 'goodram.jpg', 0, 1401265119, 1401265119),
(194, 'sandisk', 'sandisk.jpg', 0, 1401265119, 1401265119),
(195, 'silicon-power', 'silicon-power.jpg', 0, 1401265119, 1401265119),
(196, 'orion', NULL, 0, 1401265119, 1401265119),
(197, 'supra', NULL, 0, 1401265119, 1401265119),
(198, 'x-digital', 'x-digital.gif', 0, 1401265119, 1401265119),
(199, 'tenex', 'tenex.jpg', 0, 1401265119, 1401265119),
(200, 'kapok', NULL, 0, 1401265119, 1401265119),
(201, 'multi-pulti', NULL, 0, 1401265119, 1401265119),
(202, 'ice-age-4', NULL, 0, 1401265119, 1401265119),
(203, 'ice-age-3', NULL, 0, 1401265119, 1401265119),
(204, 'grand', NULL, 0, 1401265119, 1401265119),
(205, 'lava', NULL, 0, 1401265119, 1401265119),
(206, 'shrek', NULL, 0, 1401265119, 1401265119),
(207, 'auldey', NULL, 0, 1401265119, 1401265119),
(208, 'bburago', NULL, 0, 1401265119, 1401265119),
(209, 'tehnopark', NULL, 0, 1401265119, 1401265119),
(210, 'tmnt', NULL, 0, 1401265119, 1401265119),
(211, 'sport-tech', NULL, 0, 1401265119, 1401265119),
(212, 'edison', NULL, 0, 1401265119, 1401265119),
(213, 'karapuz-govoriashchie-kukly', NULL, 0, 1401265119, 1401265119),
(214, 'penbo', NULL, 0, 1401265119, 1401265119),
(215, 'zapf', NULL, 0, 1401265119, 1401265119),
(216, 'lalaloopsy', NULL, 0, 1401265119, 1401265119),
(217, 'bratz', NULL, 0, 1401265119, 1401265119),
(218, 'mell', NULL, 0, 1401265119, 1401265119),
(219, 'moxie', NULL, 0, 1401265119, 1401265119),
(220, 'emotion-pets', NULL, 0, 1401265119, 1401265119),
(221, 'zvukovye-i-govoriashchie-plakaty', NULL, 0, 1401265119, 1401265119),
(222, 'startright', NULL, 0, 1401265119, 1401265119),
(223, 'caring-corners', NULL, 0, 1401265119, 1401265119),
(224, 'vtech', NULL, 0, 1401265119, 1401265119),
(225, 'lexibook', NULL, 0, 1401265119, 1401265119),
(226, 'znatok', NULL, 0, 1401265119, 1401265119),
(227, 'kiddisvit', NULL, 0, 1401265119, 1401265119),
(228, 'playpad', NULL, 0, 1401265119, 1401265119),
(229, 'flip-force', NULL, 0, 1401265119, 1401265119),
(230, 'little-inu', NULL, 0, 1401265119, 1401265119),
(231, 'legend-of-nara', NULL, 0, 1401265119, 1401265119),
(232, 'pleo', NULL, 0, 1401265119, 1401265119),
(233, 'roadbot', NULL, 0, 1401265119, 1401265119),
(234, 'x-bot', NULL, 0, 1401265119, 1401265119),
(235, 'v-create', NULL, 0, 1401265119, 1401265119),
(236, 'igraem-vmeste', NULL, 0, 1401265119, 1401265119),
(237, 'ses', NULL, 0, 1401265119, 1401265119),
(238, 'aqua-doodle', NULL, 0, 1401265119, 1401265119),
(239, 'quercetti', NULL, 0, 1401265119, 1401265119),
(240, 'billwin', NULL, 0, 1401265119, 1401265119),
(241, 'little-tikes', NULL, 0, 1401265119, 1401265119),
(242, 'dulcop', NULL, 0, 1401265119, 1401265119),
(243, 'mondo', NULL, 0, 1401265119, 1401265119),
(244, 'battat', NULL, 0, 1401265119, 1401265119),
(245, 'lil-woodzeez', NULL, 0, 1401265119, 1401265119),
(246, 'taf-toys', NULL, 0, 1401265119, 1401265119),
(247, 'kiddieland-preschool', NULL, 0, 1401265119, 1401265119),
(248, 'kiddieland-chudomobili', NULL, 0, 1401265119, 1401265119),
(249, 'ouaps', NULL, 0, 1401265119, 1401265119),
(250, 'faro', NULL, 0, 1401265119, 1401265119),
(251, 'henes', NULL, 0, 1401265119, 1401265119),
(252, 'litsenzionnye-detskie-velosipedy', NULL, 0, 1401265119, 1401265119),
(253, 'litsenzionnye-skutery', NULL, 0, 1401265119, 1401265119),
(254, 'jolly-ride', NULL, 0, 1401265119, 1401265119),
(255, 'nixor-sports', NULL, 0, 1401265119, 1401265119),
(256, 'kidy-land-modnye-shtuchki', NULL, 0, 1401265119, 1401265119),
(257, 'hilco', NULL, 0, 1401265119, 1401265119),
(258, 'walden', NULL, 0, 1401265119, 1401265119),
(259, 'hotpoint-ariston', NULL, 0, 1401265119, 1401265119),
(260, 'nils', NULL, 0, 1401265119, 1401265119),
(261, 'hms', NULL, 0, 1401265119, 1401265119),
(262, 'stimul', NULL, 0, 1401265119, 1401265119),
(263, 'moulinex', NULL, 0, 1401265119, 1401265119),
(264, 'magio', NULL, 0, 1401265119, 1401265119),
(265, 'scarlett', NULL, 0, 1401265119, 1401265119),
(266, 'ariete', NULL, 0, 1401265119, 1401265119),
(267, 'aurora', NULL, 0, 1401265119, 1401265119),
(268, 'russell-hobbs', NULL, 0, 1401265119, 1401265119),
(269, 'zanuss', NULL, 0, 1401265119, 1401265119),
(270, 'hoover', NULL, 0, 1401265119, 1401265119),
(271, 'kenwood', NULL, 0, 1401265119, 1401265119),
(272, 'sennheiser', NULL, 0, 1401265119, 1401265119),
(273, 'jvc', NULL, 0, 1401265119, 1401265119),
(274, 'pleomax', NULL, 0, 1401265119, 1401265119);

-- --------------------------------------------------------

--
-- Table structure for table `shop_brands_i18n`
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
-- Dumping data for table `shop_brands_i18n`
--

INSERT INTO `shop_brands_i18n` (`id`, `locale`, `name`, `description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(30, 'ru', 'Pioneer', '<p><span style="font-weight:bold">Pioneer Corporation </span>— производитель электронной и аудио-видеоаппаратуры для дома, автомобиля, коммерческих и промышленных предприятий.&nbsp;Основана в 1938 году в Токио.</p><br>  ', '', '', ''),
(26, 'ru', 'Sony', '<p><span style="font-weight:bold">Sony Corporation&nbsp;</span>— транснациональная корпорация со штаб-квартирой в Японии, возникшая в 1946 году.</p>  ', '', '', ''),
(27, 'ru', 'Apple', '', '', '', ''),
(28, 'ru', 'Samsung', '<p><span style="font-weight:bold">Samsung Group </span>&nbsp; — промышленный концерн (группа компаний), один из крупнейших в Южной Корее, основанный в 1938 году. На мировом рынке известен как производитель высокотехнологичных компонентов, телекоммуникационного оборудования, бытовой техники, аудио- и видео устройств.</p>  ', '', '', ''),
(29, 'ru', 'Panasonic', '<p><span style="font-weight:bold">Panasonic Corporation </span>— крупная японская машиностроительная корпорация, один из крупнейших в мире производителей бытовой техники и электронных товаров.</p>  ', '', '', ''),
(29, 'en', 'Impression Computers', '', '', '', ''),
(26, 'en', 'Hewlett Packard', '', '', '', ''),
(30, 'en', 'Bravo Computers', '', '', '', ''),
(28, 'en', 'Brain', '', '', '', ''),
(27, 'en', 'Apple', '', '', '', ''),
(34, 'ru', 'Canon', ' ', '', '', ''),
(35, 'ru', 'LG', '', '', '', ''),
(36, 'ru', 'Yamaha', '<span style="font-weight:bold">Yamaha Corporation </span>— японский концерн, производящий музыкальные инструменты, акустические системы, звуковое оборудование, спортивный инвентарь и многое другое.  ', '', '', ''),
(37, 'ru', 'Epson', ' ', '', '', ''),
(38, 'ru', 'Plantronics', ' ', '', '', ''),
(39, 'ru', 'Motorola', ' ', '', '', ''),
(41, 'ru', 'Asus', ' ', '', '', ''),
(42, 'ru', 'Nokia', ' ', '', '', ''),
(43, 'ru', 'Dell', ' ', '', '', ''),
(44, 'ru', 'Acer', ' ', '', '', ''),
(45, 'ru', 'Fujitsu', ' ', '', '', ''),
(46, 'ru', 'HP (Hewlett Packard)', ' ', '', '', ''),
(47, 'ru', 'Lenovo', ' ', '', '', ''),
(48, 'ru', 'MSI', ' ', '', '', ''),
(49, 'ru', 'Packard Bell', ' ', '', '', ''),
(50, 'ru', 'Toshiba', ' ', '', '', ''),
(51, 'ru', 'AEG', ' ', '', '', ''),
(52, 'ru', 'Ardo', ' ', '', '', ''),
(53, 'ru', 'Atlant ', ' ', '', '', ''),
(54, 'ru', 'Beko ', ' ', '', '', ''),
(55, 'ru', 'Bosch', ' ', '', '', ''),
(56, 'ru', 'Candy', ' ', '', '', ''),
(57, 'ru', 'Daewoo', ' ', '', '', ''),
(58, 'ru', 'Delfa', ' ', '', '', ''),
(59, 'ru', 'Electrolux', ' ', '', '', ''),
(60, 'ru', 'Gorenje', ' ', '', '', ''),
(61, 'ru', 'Hitachi ', ' ', '', '', ''),
(62, 'ru', 'Hotpoint Ariston', ' ', '', '', ''),
(63, 'ru', 'Indesit', ' ', '', '', ''),
(76, 'ru', 'AMF', '<p><strong>Компания АртМеталлФурнитура&nbsp;(AMF)</strong> - крупнейший производитель офисной мебели,&nbsp;объединяющий&nbsp;семь производственных предприятий, выпускающих мебель и комплектующие на территории Украины, России и&nbsp;Китая.&nbsp;</p>\n<p>Экспорт продукции производится в более&nbsp;35&nbsp;стран.</p><p>Производственный комплекс компании AMF обеспечивает полный и непрерывный цикл создания и сборки мебели: от сырья до готового продукта.</p><p>На производственных площадках компании работает 1500 сотрудников.</p><p>Дистрибьюторский офис AMF состоит из 250 человек.</p><p>Мощности компании позволяют выпускать более 4 млн. стульев в год.</p><p>На всю продукцию компании выдается сертификат происхождения товара для стран СНГ - (СТ-1) и Сertificate of Original (FORM-A) - для стран Европы.</p><p>Аудит качества ежегодно подтверждается сертификатом ISO-9001-2001.</p><p>Компания AMF - член Украинской Ассоциации Мебельщиков с 2002 года.</p><p>Постоянное стремление AMF создавать оптимальные и комфортные условия сотрудничества позволяет сделать их взаимовыгодными и эффективными для партнеров и клиентов.</p>    ', 'Компания АртМеталлФурнитура (AMF)', 'Компания АртМеталлФурнитура (AMF)', 'Компания АртМеталлФурнитура (AMF)'),
(65, 'ru', 'Kaiser ', ' ', '', '', ''),
(67, 'ru', 'Liebherr', ' ', '', '', ''),
(68, 'ru', 'Nord', ' ', '', '', ''),
(69, 'ru', 'Sharp', ' ', '', '', ''),
(70, 'ru', 'Siemens', ' ', '', '', ''),
(71, 'ru', 'Smeg', ' ', '', '', ''),
(72, 'ru', 'Snaige', ' ', '', '', ''),
(73, 'ru', 'Swizer', ' ', '', '', ''),
(74, 'ru', 'Whirlpool', ' ', '', '', ''),
(75, 'ru', 'Zanussi ', ' ', '', '', ''),
(77, 'ru', 'Philsps', 'Royal Philips Electronics of the Netherlands – это международная компания, работающая в индустрии «здоровья и благополучия» и нацеленная на улучшение жизни людей путем постоянного внедрения инноваций. Являясь мировым лидером в области здравоохранения, потребительских товаров и световых решений, Philips в своих технологических и дизайнерских решениях в первую очередь ориентируется на потребности людей. Принцип «разумно и просто» лежит в основе всех разработок компании<p><br></p>  <img src="/uploads/gallery/mainlogo_full_ua_ru.gif" style="width:148px;height:39px">  ', '', '', ''),
(78, 'ru', 'Clatronic', ' ', '', '', ''),
(79, 'ru', 'Dex', ' ', '', '', ''),
(80, 'ru', 'Liberton', ' ', '', '', ''),
(81, 'ru', 'Mystery ', ' ', '', '', ''),
(82, 'ru', 'Saturn', ' ', '', '', ''),
(83, 'ru', 'VES Electric', ' ', '', '', ''),
(84, 'ru', 'Illuminati (Италия)', 'Компания Illuminati создана в 2007 году в итальянском городе Пиза. На сегодняшний день компания является производителем предметов освещения премиум класса.<br><br><div><div>\n<div style="text-align:right">\n<p><em>"Никто\n не зажигает свечу, чтобы хранить ее за дверью, ибо свет затем и \nсуществует, чтобы светить, открывать людям глаза, показывать, какие \nвокруг чудеса."</em></p>\n<p><em> Пауло Коэльо</em></p>\n</div>\n</div></div>  ', 'Illuminati', 'Illuminati', 'Illuminati'),
(85, 'ru', ' Binatone', ' ', '', '', ''),
(86, 'ru', 'BRAUN', ' ', '', '', ''),
(87, 'ru', 'Maxwell', ' ', '', '', ''),
(88, 'ru', ' Moulinex ', ' ', '', '', ''),
(89, 'ru', 'Vitek', ' ', '', '', ''),
(90, 'ru', 'Zelmer', ' ', '', '', ''),
(91, 'ru', 'Easy Camp', 'В Easy Camp считают, что каждый должен испытать удовольствие от жизни на открытом воздухе по крайней мере один раз в жизни.  ', 'Easy Camp', 'Easy Camp', 'Easy Camp'),
(92, 'ru', 'BECO', 'Компания BECO – является инновационной компанией среднего размера, которая расположена в Германии в городе Бад Зальцуфлен.<br><br>Компания BECO была основана еще в 1923 году как предприятие оптовой торговли. И на то время большее количество клиентов это были аптеки и магазины галантерейных и парфюмерных товаров.<br><br>Но уже в 60-х годах состоялось первое значительное расширение ассортимента шапочками для купания, благодаря открытию собственного завода резиновых изделий в Испании.<br><br>В 70-х годах компания BECO начала разрабатывать модели купальных костюмов и плавок, которые изготовлялись на собственных заводах в Испании и Италии. С того времени и пошло непрерывное расширение ассортимента аксессуаров для водных видов спорта.<br><br>Наконец в 80-ые годы компания начала активно осваивать внешние рынки, в частности стран Европы. <br><br>А уже с 1990 года компания BECO расширилась на страны СНГ, Восточной Европы и заокеанские страны.<br><br>В последние годы наибольшее ударение компания BECO делает на разработку новых продуктов для занятий аквааэробикой (аквафитнессом), которые изготовляются под собственной торговой маркой и являются запатентованными на международных рынках.<br><br>Компания имеет тесные связи с самыми влиятельными ассоциациями, союзами и ключевыми игроками в сфере аквафитнесса и аквааэробики.<br><br>Купить товары для плавания BECO Вы можете в нашем интернет магазине.  ', 'BECO', 'BECO', 'BECO'),
(93, 'ru', 'ATEMI', '«ATEMI» — это федеральная сеть специализированных магазинов спортивно-туристической направленности, а также торговая марка, объединившая различные товары для спорта и активного отдыха.  ', 'ATEMI', 'ATEMI', 'ATEMI'),
(94, 'ru', 'HUAWEI', NULL, NULL, NULL, NULL),
(95, 'ru', 'AOC', NULL, NULL, NULL, NULL),
(96, 'ru', 'PHILIPS', NULL, NULL, NULL, NULL),
(97, 'ru', 'VIEWSONIC', NULL, NULL, NULL, NULL),
(98, 'ru', 'BABOLAT', 'Babolat (произносится Баболя) — компания, основанная в Лионе (Франция) в 1875 году. Является старейшей компанией, специализирующейся на производстве продукции для большого тенниса. Легко узнаваемая двойная линия на струнной поверхности ракетки — фирменный знак компании и гарантия высококачественного изделия.  ', 'BABOLAT', 'BABOLAT', 'BABOLAT'),
(99, 'ru', 'DONIC', 'Donic - топовый немецкий продукт, гаратия высочайшего качества и несомненной надежности. Помимо современных инновационных решений и высокотехнологичного производства, Donic выгодно отличаются от всех прочих производителей своим собственным стилем, продуманным дизайном и вызывающе агрессивными характеристиками, что позволяет им вот уже более 20 лет удерживать лидирующие позиции на всемирном рынке спортивных товаров для игры в настольный теннис.  ', 'DONIC', 'DONIC', 'DONIC'),
(100, 'ru', 'Абизаль', '"Абизаль" ведущий производитель коньков для фигурного катания.  ', 'Абизаль', 'Абизаль', 'Абизаль'),
(101, 'ru', 'DONIC', 'Великие достижения часто создаются из простых принципов. С DONIC вы верите в качество, с точки зрения скорости и передовых технологий.  ', '', '', ''),
(102, 'ru', 'DONIC-SCHILDKROT', 'Компания Donic-Schildkrot создала линейку ракеток Swedish Legend в дань уважения величайшим игрокам.  ', 'DONIC-SCHILDKROT', 'DONIC-SCHILDKROT', 'DONIC-SCHILDKROT'),
(103, 'ru', 'FISCHER', 'Компания Fischer GmBH, основанная в 1925 году в г. Риде господином Йозефом Фишером, сегодня является одной из ведущих в мире в области производства беговых и горных лыж, теннисного и хоккейного оборудования. История компании — это большой путь от цеха по производству деревянных лыж до крупнейшей компании мирового уровня, производящей высокотехнологичные товары. Девиз компании Fischer — “Emotion. Innovation. Success” (“Эмоции. Инновации. Успех”).  ', 'FISCHER', 'FISCHER', 'FISCHER'),
(104, 'ru', 'GIANT DRAGON', 'Компания GIANT DRAGON CO LTD основана в 1991 году. Благодаря высоким технологиям и постоянным инновациям, компания стала одним из крупнейших производителей аксессуаров для настольного тенниса в Китае. Сегодня торговая марка GIANT DRAGON достаточно известна и пользуется спросом во всем мире. Успех GIANT DRAGON основан на качестве, инновациях, современных технологиях и скорости их внедрения в производство. Многие игроки мирового класса, национальные команды и многочисленные клубы - все они достигли своего успеха благодаря огромному выбору, технологичности и идеальному соответствию продукции высоким требованиям.  ', 'GIANT DRAGON', 'GIANT DRAGON', 'GIANT DRAGON'),
(105, 'ru', 'OUTWELL', 'Датская компания Outwell — одна из крупнейших компаний по производству кемпингового оборудования.&nbsp;<br>   ', 'OUTWELL', 'OUTWELL', 'OUTWELL'),
(106, 'ru', 'AXL', 'Оригинальнй имидж на любой карман<br>Звукосниматели EMG designed<br>Самая низкая цена на Vintage гитары<br>Каждая гитара это &nbsp;Custom Shop  ', 'AXL', 'AXL', 'AXL'),
(107, 'ru', 'BCRICH', 'Почему B.C.RICH?<br> Инноватор и пионер экстримальных гитарных форм <br> Основа Heavy Metal <br>Доступные модели Signature <br>Оснащение звукоснимателями Rockfield <br>Эксклюзивные инструменты для эксклюзивных людей <br>Первые ввели понятие активной электроники.  ', 'BCRICH', 'BCRICH', 'BCRICH'),
(108, 'ru', 'Tefal', ' ', '', '', ''),
(109, 'ru', 'TEXET', 'Производитель телефонов , планшетов,&nbsp;MP3/MP4 - плееров  ', 'TEXET', 'TEXET', 'TEXET'),
(110, 'ru', 'SportBaby', '<br>SportBaby  -  отечественный производитель,  специализирующийся на производстве, <br>&nbsp;детских спорткомплексов и тренажеров как для дома, так и для улицы.   ', 'SportBaby', 'SportBaby', 'SportBaby'),
(111, 'ru', 'brd', NULL, NULL, NULL, NULL),
(112, 'ru', 'HTC', 'HTC -&nbsp;производитель смартфонов и коммуникаторов  ', 'HTC', 'HTC', 'HTC'),
(113, 'ru', 'Assistant', '<div><span style="font-weight:normal">Assistant - производитель MP3-плееров</span></div>  ', 'Assistant', 'Assistant', 'Assistant'),
(114, 'ru', 'Kingston', 'Производитель карт памяти  ', 'Kingston', 'Kingston', 'Kingston'),
(115, 'ru', ' DELONGHI  ', ' ', '', '', ''),
(116, 'ru', 'Dune HD', 'Компания Dune HD основана в 2006 году. Основным направлением деятельности компании является разработка передовых решений для воспроизведения видео-медиаплееров Dune HD.  ', '', '', ''),
(117, 'ru', 'Nakamichi ', ' ', '', '', ''),
(156, 'ru', 'Logitech', NULL, NULL, NULL, NULL),
(119, 'ru', 'Fly', NULL, NULL, NULL, NULL),
(120, 'ru', '4232', NULL, NULL, NULL, NULL),
(121, 'ru', 'Onkyo', ' ', '', '', ''),
(122, 'ru', 'Popcorn Hour', ' ', '', '', ''),
(123, 'ru', 'Acme Made', NULL, NULL, NULL, NULL),
(124, 'ru', 'Case Logic', NULL, NULL, NULL, NULL),
(125, 'ru', 'THULE', NULL, NULL, NULL, NULL),
(126, 'ru', 'X-Digital', NULL, NULL, NULL, NULL),
(127, 'ru', 'Continent', NULL, NULL, NULL, NULL),
(128, 'ru', 'SUMDEX', NULL, NULL, NULL, NULL),
(129, 'ru', 'Trust', NULL, NULL, NULL, NULL),
(130, 'ru', 'HOBBY ENGINE', NULL, NULL, NULL, NULL),
(131, 'ru', 'DiGi', NULL, NULL, NULL, NULL),
(132, 'ru', 'Alcatel', ' ', '', '', ''),
(133, 'ru', 'Tarti', NULL, NULL, NULL, NULL),
(134, 'ru', 'Viara', '<p>Инновационный, смелый, современный бренд террасной мебели, делающий акцент на модных дизайнах. Каждая наша коллекция выделяется, обладая уникальными формами и свойствами. Viara — это мебель для сильных личностей, ценящих красивую жизнь и качественные вещи.</p><p>Мы предлагаем вам мебель, выполненную из высококачественного искусственного ротанга — современного материала, не боящегося жары, морозов, солнечных лучей, дождя и снега. Первоклассный алюминий для каркасов и декоративных элементов, отличный текстилен для подушек, роскошный тик и безопасное стекло для столешниц делают мебель не просто надежной и качественной, но и превосходно выглядящей.</p><p>Благодаря сочетанию современных дизайнерских решений, высокого качества и разумной цены.</p>  ', 'viara', 'viara', 'viara'),
(135, 'ru', 'WISH', '<br><br>WISH — компания специализирующаяся на производстве продукции для бадминтона.    ', 'WISH', 'WISH', 'WISH'),
(136, 'ru', 'Vestfrost', NULL, NULL, NULL, NULL),
(137, 'ru', 'TINY LOVE', NULL, NULL, NULL, NULL),
(138, 'ru', 'Redox', '<br>Redox — компания специализирующаяся на производстве продукции для бадминтона.<br><br>На сегодняшний день, продукция компании Redox представлена более чем в 100 странах мира.  ', 'Redox', 'Redox', 'Redox'),
(139, 'ru', 'IRON BODY', NULL, NULL, NULL, NULL),
(140, 'ru', 'MACHUKA', NULL, NULL, NULL, NULL),
(141, 'ru', 'WINNER', NULL, NULL, NULL, NULL),
(142, 'ru', 'Jabra', ' ', '', 'Jabra', 'Jabra'),
(143, 'ru', 'BBK', NULL, NULL, NULL, NULL),
(144, 'ru', 'Horizont', NULL, NULL, NULL, NULL),
(145, 'ru', 'B.C.RICH', NULL, NULL, NULL, NULL),
(146, 'ru', 'ASRock', NULL, NULL, NULL, NULL),
(147, 'ru', 'Biostar', NULL, NULL, NULL, NULL),
(148, 'ru', 'ELITEGROUP', NULL, NULL, NULL, NULL),
(149, 'ru', 'YASHIMA', NULL, NULL, NULL, NULL),
(150, 'ru', 'UFO', NULL, NULL, NULL, NULL),
(151, 'ru', 'BEHRINGER', ' ', 'BEHRINGER', '', 'BEHRINGER'),
(152, 'ru', 'Iriver', NULL, NULL, NULL, NULL),
(153, 'ru', 'Transcend', NULL, NULL, NULL, NULL),
(154, 'ru', 'Ergo ', ' ', 'Ergo ', 'Ergo ', 'купить Ergo '),
(155, 'ru', ' Iriver', ' ', '', '', ''),
(157, 'ru', 'Genius', NULL, NULL, NULL, NULL),
(158, 'ru', 'Ariston', NULL, NULL, NULL, NULL),
(159, 'ru', 'Hotpoin Ariston', NULL, NULL, NULL, NULL),
(160, 'ru', 'SCHILDKROT', NULL, NULL, NULL, NULL),
(161, 'ru', 'ROBENS', NULL, NULL, NULL, NULL),
(162, 'ru', 'Apache', ' ', 'apache', '', 'купить apache, продать apache'),
(163, 'ru', 'Alberti Livio & C. SAS', 'Alberti Livio &amp; C.&nbsp;SAS<a href="http://www.albertilivio.com/"></a>&nbsp;Это производители сувениров и декоративных латуни для больше ", чем 25 лет.&nbsp;Все процессы, от литья до упаковки, происходят внутри компании, после каждого процесса с заботой и вниманием, благодаря традициям и опыту.&nbsp;Специализируется на производстве люстр и лжи, колокольчики настольные и настенные, брелки стене, лотки и пепельницы, письменные приборы и камин, часы, предметы домашнего обихода.&nbsp;Также возможны эксклюзивные производств по чертежу или образцу.  <a href="http://www.albertilivio.com/"></a>  ', 'Alberti Livio & C. SAS', '', 'Alberti Livio & C. SAS, часы настенные Alberti Livio, купить часы Alberti Livio, часы Alberti, часы настольные Alberti Livio, часы настенные Alberti, часы коминные Alberti'),
(164, 'ru', 'EXIT', NULL, NULL, NULL, NULL),
(165, 'ru', 'JUNGLE GYM', NULL, NULL, NULL, NULL),
(166, 'ru', 'SPACE SCOOTER', NULL, NULL, NULL, NULL),
(167, 'ru', '4 Seasons Outdoor', 'Индонезийская компания&nbsp;4 Seasons Outdoor начала свою деятельность в начале 90-х. Сегодня она владеет двумя крупными заводами&nbsp;по производству ротанговой мебели на острове Ява. На фабрике работает около 7000 человек и&nbsp;более 100 инспекторов по контролю качества. На всю продукцию завод дает 3-х летнюю гарантию.<div>Качество мебели подтверждены международными наградами, а современные дизайнерские идеи вы можете оценить и&nbsp;сами.</div>  ', '4 Seasons Outdoor', '4 Seasons Outdoor', '4 Seasons Outdoor'),
(168, 'ru', 'Koss ', ' ', '', '', 'купить Навушники Koss,  Koss'),
(169, 'ru', 'ТМ Katinka', NULL, NULL, NULL, NULL),
(170, 'ru', 'Tramp', NULL, NULL, NULL, NULL),
(171, 'ru', 'SOL', NULL, NULL, NULL, NULL),
(172, 'ru', 'Totem', NULL, NULL, NULL, NULL),
(173, 'ru', 'Destroyer', NULL, NULL, NULL, NULL),
(176, 'ru', 'Famiche d''arte f.l.', 'Famiche d''arte f.l.  <a href="http://www.albertilivio.com/"></a>&nbsp;Это производители сувениров и декоративных керамических изделий.&nbsp;Все процессы&nbsp;происходят внутри компании, после каждого процесса с заботой и вниманием, благодаря традициям и опыту.&nbsp;Специализируется на производстве декора из керамики.  ', '', '', 'Alberti Livio & C. SAS, часы настенные Alberti Livio, купить часы Alberti Livio, часы Alberti, часы настольные Alberti Livio, часы настенные Alberti, часы коминные Alberti'),
(177, 'ru', 'EGLO (Австрия)', 'EGLO – международная компания имеющая&nbsp;торгово-промышленную деятельность&nbsp;на пяти континентах и дистрибьюторов более чем в 50 странах.&nbsp;<div>В EGLO мы решили заниматься декоративным освещением для жилых площадей. Это то, о чем мы думаем и чем&nbsp;занимаемся. Начиная с гостиной, ванной и кухни и заканчивая наружными участками Вашего дома. Все что мы делаем, мы делаем должным образом, предлагая полный спектр дополнительных услуг.  </div><div>Обычные или с дизайнерским замыслом – наши светильники соответствуют Вашим желаниям. Все, что Вы приобретете, будет наивысшего качества.<br></div><div>Во всех сферах деятельности нашей компании мы гарантируем соответствие стандартам наивысшего уровня качества. Компетентность персонала – это ключ к продолжительному успеху, следовательно, мы поддерживаем персонал обучаем его и&nbsp;постоянно&nbsp;развиваем.<br></div>  ', 'Eglo', 'Eglo', 'Eglo'),
(178, 'ru', 'Stilars', 'Компания Stilars занимается украшением&nbsp;интерьера&nbsp;и в настоящее время занимает в мире одну из&nbsp;лидирующую позиций&nbsp;по производству классических украшений для интерьера из латуни. Изделия от&nbsp;Stilars относятся к разным стилям и эпохам интерьерного искусства и являются по своей сути&nbsp;копиями антикварных предметов, которыми в былые времена&nbsp;украшали интерьеры дворцов.  ', 'Stilars - аксессуары для каминов, Stilars изделия из латуни. Сувениры от Stilars каминные наборы.', 'Продукция Stilars, продажа и доставка аксессуаров от Stilars, аксессуары для каминов производство Италия.', 'Stilars в Украине, Купить продукцию Stilars, Stilars купить, изделия из латуни, подарок от Stilars'),
(179, 'ru', 'Daniels di elisabetta zucconi', 'Компания Daniels di elisabetta zucconi  , в сотрудничестве с молодыми&nbsp;художниками&nbsp;и опытных мастерами&nbsp;в индустрии, производят&nbsp;работы полностью в вручную, с использованием высококачественных продуктов, которые делают работы. Daniels di elisabetta zucconi оригинальный и долговечный, в полном соответствии с защитой окружающей среды.  ', 'Daniels di elisabetta zucconi - бренды, daniel&apos;s di elisabetta zucconi', 'От ведущих мировых производителей таких как Daniels di elisabetta zucconi ". Daniels di elisabetta zucconi', 'Daniels di elisabetta zucconi в Украине, Daniels di elisabetta zucconi кортины настенные, Daniels di elisabetta zucconi купить, Daniels di elisabetta zucconi купить кортину'),
(180, 'ru', 'Euromarchi s.r.l.', 'Торговая марка Euromarchi s.r.l. была основана между первой и второй мировой войной в Италии. Целью компании Euromarchi s.r.l. является создание декоративных статуэток и все возможных фигурок с использованием исключительно экологически чистых материалов.  ', 'Euromarchi s.r.l.', 'Euromarchi s.r.l.', 'Euromarchi s.r.l., фигурки от Euromarchi s.r.l., купить статуэтки Euromarchi s.r.l., Euromarchi s.r.l. в Украине'),
(181, 'ru', 'Franco s.r.l.', 'Franco s.r.l. это Итальянский производитель,&nbsp;один мировых лидеров в производстве изделий из стекла и фарфора.  ', 'Franco s.r.l. в Украине, Продукция Franco s.r.l. Franco s.r.l.  стекло фарфор', '', 'Franco s.r.l. в Украине, franco s r l, купить Franco s.r.l., купить вазу Franco, Стекло от Franco, ваза franco s r l'),
(182, 'ru', 'Binatone', NULL, NULL, NULL, NULL),
(183, 'ru', 'Thomas', NULL, NULL, NULL, NULL),
(184, 'ru', 'Rowenta', NULL, NULL, NULL, NULL),
(185, 'ru', 'Elektrostatyk', NULL, NULL, NULL, NULL),
(186, 'ru', 'Rock Empire', NULL, NULL, NULL, NULL),
(187, 'ru', 'Kovea', NULL, NULL, NULL, NULL),
(188, 'ru', 'Silicon Power', NULL, NULL, NULL, NULL),
(189, 'ru', 'PQI', NULL, NULL, NULL, NULL),
(190, 'ru', 'VERBATIM', NULL, NULL, NULL, NULL),
(191, 'ru', 'ORGAZ', NULL, NULL, NULL, NULL),
(192, 'ru', 'GZWM', NULL, NULL, NULL, NULL),
(193, 'ru', 'GOODRAM', '', 'GOODRAM', 'купить GOODRAM', 'GOODRAM'),
(194, 'ru', 'Sandisk', '', 'Sandisk', '', 'Sandisk'),
(195, 'ru', 'Silicon Power ', '', 'Silicon Power ', '', 'Silicon Power '),
(196, 'ru', 'Orion', NULL, NULL, NULL, NULL),
(197, 'ru', 'Supra', NULL, NULL, NULL, NULL),
(198, 'ru', 'X-Digital', '', '', '', ''),
(199, 'ru', 'Tenex', '', '', '', ''),
(200, 'ru', 'Kapok', NULL, NULL, NULL, NULL),
(201, 'ru', 'Мульти-Пульти', NULL, NULL, NULL, NULL),
(202, 'ru', 'Ice Age 4', NULL, NULL, NULL, NULL),
(203, 'ru', 'Ice Age 3', NULL, NULL, NULL, NULL),
(204, 'ru', 'Grand', NULL, NULL, NULL, NULL),
(205, 'ru', 'Lava', NULL, NULL, NULL, NULL),
(206, 'ru', 'Shrek', NULL, NULL, NULL, NULL),
(207, 'ru', 'Auldey', NULL, NULL, NULL, NULL),
(208, 'ru', 'Bburago', NULL, NULL, NULL, NULL),
(209, 'ru', 'Технопарк', NULL, NULL, NULL, NULL),
(210, 'ru', 'TMNT', NULL, NULL, NULL, NULL),
(211, 'ru', 'Sport tech', NULL, NULL, NULL, NULL),
(212, 'ru', 'Edison', NULL, NULL, NULL, NULL),
(213, 'ru', 'Карапуз - говорящие куклы', NULL, NULL, NULL, NULL),
(214, 'ru', 'Penbo', NULL, NULL, NULL, NULL),
(215, 'ru', 'Zapf', NULL, NULL, NULL, NULL),
(216, 'ru', 'Lalaloopsy', NULL, NULL, NULL, NULL),
(217, 'ru', 'Bratz', NULL, NULL, NULL, NULL),
(218, 'ru', 'Mell', NULL, NULL, NULL, NULL),
(219, 'ru', 'Moxie', NULL, NULL, NULL, NULL),
(220, 'ru', 'Emotion Pets', NULL, NULL, NULL, NULL),
(221, 'ru', 'Звуковые и говорящие плакаты', NULL, NULL, NULL, NULL),
(222, 'ru', 'Startright', NULL, NULL, NULL, NULL),
(223, 'ru', 'Caring Corners', NULL, NULL, NULL, NULL),
(224, 'ru', 'VTech', NULL, NULL, NULL, NULL),
(225, 'ru', 'Lexibook', NULL, NULL, NULL, NULL),
(226, 'ru', 'Знаток', NULL, NULL, NULL, NULL),
(227, 'ru', 'Киддисвит', NULL, NULL, NULL, NULL),
(228, 'ru', 'PlayPad', NULL, NULL, NULL, NULL),
(229, 'ru', 'Flip Force', NULL, NULL, NULL, NULL),
(230, 'ru', 'Little INU', NULL, NULL, NULL, NULL),
(231, 'ru', 'Legend of NARA', NULL, NULL, NULL, NULL),
(232, 'ru', 'Pleo', NULL, NULL, NULL, NULL),
(233, 'ru', 'Roadbot', NULL, NULL, NULL, NULL),
(234, 'ru', 'X-bot', NULL, NULL, NULL, NULL),
(235, 'ru', 'V-Create', NULL, NULL, NULL, NULL),
(236, 'ru', 'Играем вместе', NULL, NULL, NULL, NULL),
(237, 'ru', 'Ses', NULL, NULL, NULL, NULL),
(238, 'ru', 'Aqua Doodle', NULL, NULL, NULL, NULL),
(239, 'ru', 'Quercetti', NULL, NULL, NULL, NULL),
(240, 'ru', 'Billwin', NULL, NULL, NULL, NULL),
(241, 'ru', 'Little Tikes', NULL, NULL, NULL, NULL),
(242, 'ru', 'Dulcop', NULL, NULL, NULL, NULL),
(243, 'ru', 'Mondo', NULL, NULL, NULL, NULL),
(244, 'ru', 'Battat', NULL, NULL, NULL, NULL),
(245, 'ru', 'Li''l Woodzeez', NULL, NULL, NULL, NULL),
(246, 'ru', 'Taf Toys', NULL, NULL, NULL, NULL),
(247, 'ru', 'Kiddieland - preschool', NULL, NULL, NULL, NULL),
(248, 'ru', 'Kiddieland - Чудомобили', NULL, NULL, NULL, NULL),
(249, 'ru', 'Ouaps', NULL, NULL, NULL, NULL),
(250, 'ru', 'Faro', NULL, NULL, NULL, NULL),
(251, 'ru', 'Henes', NULL, NULL, NULL, NULL),
(252, 'ru', 'Лицензионные детские велосипеды', NULL, NULL, NULL, NULL),
(253, 'ru', 'Лицензионные скутеры', NULL, NULL, NULL, NULL),
(254, 'ru', 'Jolly Ride', NULL, NULL, NULL, NULL),
(255, 'ru', 'Nixor Sports', NULL, NULL, NULL, NULL),
(256, 'ru', 'Kidy Land - Модные штучки', NULL, NULL, NULL, NULL),
(257, 'ru', 'Hilco', NULL, NULL, NULL, NULL),
(258, 'ru', 'WALDEN', NULL, NULL, NULL, NULL),
(259, 'ru', 'HOTPOINT-ARISTON', NULL, NULL, NULL, NULL),
(260, 'ru', 'NILS', NULL, NULL, NULL, NULL),
(261, 'ru', 'HMS', NULL, NULL, NULL, NULL),
(262, 'ru', 'Stimul', NULL, NULL, NULL, NULL),
(263, 'ru', 'MOULINEX', NULL, NULL, NULL, NULL),
(264, 'ru', 'Magio', NULL, NULL, NULL, NULL),
(265, 'ru', 'Scarlett', NULL, NULL, NULL, NULL),
(266, 'ru', 'ARIETE', NULL, NULL, NULL, NULL),
(267, 'ru', 'Aurora', NULL, NULL, NULL, NULL),
(268, 'ru', 'Russell Hobbs', NULL, NULL, NULL, NULL),
(269, 'ru', 'ZANUSS', NULL, NULL, NULL, NULL),
(270, 'ru', 'HOOVER', NULL, NULL, NULL, NULL),
(271, 'ru', 'Kenwood', NULL, NULL, NULL, NULL),
(272, 'ru', 'SENNHEISER', NULL, NULL, NULL, NULL),
(273, 'ru', 'JVC', NULL, NULL, NULL, NULL),
(274, 'ru', 'PLEOMAX', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_callbacks`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_callbacks_statuses`
--

DROP TABLE IF EXISTS `shop_callbacks_statuses`;
CREATE TABLE IF NOT EXISTS `shop_callbacks_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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

DROP TABLE IF EXISTS `shop_callbacks_statuses_i18n`;
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

DROP TABLE IF EXISTS `shop_callbacks_themes`;
CREATE TABLE IF NOT EXISTS `shop_callbacks_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shop_callbacks_themes`
--

INSERT INTO `shop_callbacks_themes` (`id`, `position`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_callbacks_themes_i18n`
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
-- Dumping data for table `shop_callbacks_themes_i18n`
--

INSERT INTO `shop_callbacks_themes_i18n` (`id`, `locale`, `text`) VALUES
(1, 'ru', 'Консультация'),
(1, 'ua', 'Перша тема');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3014 ;

--
-- Dumping data for table `shop_category`
--

INSERT INTO `shop_category` (`id`, `url`, `parent_id`, `position`, `full_path`, `full_path_ids`, `active`, `external_id`, `image`, `tpl`, `order_method`, `showsitetitle`, `created`, `updated`) VALUES
(1, 'aktivnyi-otdyh-i-turizm', 0, 251, 'aktivnyi-otdyh-i-turizm', 'a:0:{}', 1, NULL, '/uploads/shop/categories/Aktivniy otdih/Logoaktivniy turizm.jpg', '', 0, 0, 1401265119, 1401265119),
(3, 'detskie-tovary', 0, 212, 'detskie-tovary', 'a:0:{}', 1, NULL, '/uploads/shop/categories/15687_main_origin.jpg', '', 0, 0, 1401265119, 1401265119),
(7, 'muzykalnye-instrumenty', 0, 348, 'muzykalnye-instrumenty', 'a:0:{}', 1, NULL, '/uploads/shop/categories/music/clasic gitar.jpeg', '', 0, 0, 1401265119, 1401265119),
(8, 'telefoniia-pleery-gps', 0, 1, 'telefoniia-pleery-gps', 'a:0:{}', 1, NULL, '/uploads/shop/categories/21.jpg', 'categorysubfirst', 0, NULL, 1401265119, 1401265119),
(9, 'domashnee-video', 0, 21, 'domashnee-video', 'a:0:{}', 1, NULL, '/uploads/shop/categories/7f43598622805660e8ab4f6c12514588.jpg', '', 0, 0, 1401265119, 1401265119),
(927, 'telefony', 8, 2, 'telefoniia-pleery-gps/telefony', 'a:1:{i:0;i:8;}', 1, NULL, '/uploads/shop/categories/21.jpg', 'categorysubsecond', 0, NULL, 1401265119, 1401265119),
(928, 'mp3-mp4-pleery', 8, 14, 'telefoniia-pleery-gps/mp3-mp4-pleery', 'a:1:{i:0;i:8;}', 1, NULL, '/uploads/shop/categories/19324_sony_nwz-a816_6.jpg', 'categorysubsecond', 0, NULL, 1401265119, 1401265119),
(930, 'mobilnye-telefony', 927, 3, 'telefoniia-pleery-gps/telefony/mobilnye-telefony', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/shop/categories/nokia-200-asha-graphite.jpg', NULL, 0, NULL, 1401265119, 1401265119),
(931, 'smartfony', 927, 4, 'telefoniia-pleery-gps/telefony/smartfony', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/shop/categories/elko_1129847_425_0_425NULL.jpg_62013.jpg', NULL, 0, NULL, 1401265119, 1401265119),
(932, 'bluetooth-garnitury', 927, 6, 'telefoniia-pleery-gps/telefony/bluetooth-garnitury', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/shop/categories/Plantronics_Marque_2_M165_Bluetooth_Mono_Headset_Black_BTM165BK_M_1.jpg', NULL, 0, NULL, 1401265119, 1401265119),
(933, 'provodnye-garnitury', 927, 7, 'telefoniia-pleery-gps/telefony/provodnye-garnitury', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/shop/categories/20809-500x500.jpg', NULL, 0, NULL, 1401265119, 1401265119),
(935, 'akkumuliatory', 3013, 8, 'telefoniia-pleery-gps/aksessuary/akkumuliatory', 'a:2:{i:0;i:8;i:1;i:3013;}', 1, NULL, '/uploads/shop/categories/555.jpg', '', 0, 0, 1401265119, 1401265119),
(936, 'zariadnye-ustroistva', 3013, 9, 'telefoniia-pleery-gps/aksessuary/zariadnye-ustroistva', 'a:2:{i:0;i:8;i:1;i:3013;}', 1, NULL, '/uploads/shop/categories/b500b45636b51ecaefa5c0c5de5e53a0_600.jpg', '', 0, 0, 1401265119, 1401265119),
(937, 'karty-pamiati', 3013, 10, 'telefoniia-pleery-gps/aksessuary/karty-pamiati', 'a:2:{i:0;i:8;i:1;i:3013;}', 1, NULL, '/uploads/shop/categories/apacer-microsdhc_class_10_8_gb_plus_sd_adapter-g68121b.jpg', '', 0, 0, 1401265119, 1401265119),
(938, 'zashchitnye-plenki', 3013, 11, 'telefoniia-pleery-gps/aksessuary/zashchitnye-plenki', 'a:2:{i:0;i:8;i:1;i:3013;}', 1, NULL, '/uploads/shop/categories/121130080029710763.jpg', '', 0, 0, 1401265119, 1401265119),
(939, 'apple-ipod-i-aksessuary', 928, 15, 'telefoniia-pleery-gps/mp3-mp4-pleery/apple-ipod-i-aksessuary', 'a:2:{i:0;i:8;i:1;i:928;}', 1, NULL, '/uploads/shop/categories/28_tn3.jpg', NULL, 0, NULL, 1401265119, 1401265119),
(940, 'mp3--i-mediapleery', 928, 16, 'telefoniia-pleery-gps/mp3-mp4-pleery/mp3--i-mediapleery', 'a:2:{i:0;i:8;i:1;i:928;}', 1, NULL, '/uploads/shop/categories/777.jpg', NULL, 0, NULL, 1401265119, 1401265119),
(942, 'naushniki', 928, 18, 'telefoniia-pleery-gps/mp3-mp4-pleery/naushniki', 'a:2:{i:0;i:8;i:1;i:928;}', 1, NULL, '/uploads/shop/categories/hn715.jpg', NULL, 0, NULL, 1401265119, 1401265119),
(2597, 'aksessuary-dlia-telefonov', 3013, 12, 'telefoniia-pleery-gps/aksessuary/aksessuary-dlia-telefonov', 'a:2:{i:0;i:8;i:1;i:3013;}', 1, NULL, '/uploads/shop/categories/aksessuary-dlia-telefonov.jpg', '', 0, 0, 1401265119, 1401265119),
(2583, 'chehly-dlia-telefonov', 927, 5, 'telefoniia-pleery-gps/telefony/chehly-dlia-telefonov', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/shop/categories/chehly-dlia-telefonov.jpg', NULL, 0, NULL, 1401265119, 1401265119),
(3013, 'aksessuary', 8, 13, 'telefoniia-pleery-gps/aksessuary', 'a:1:{i:0;i:8;}', 1, NULL, '/uploads/shop/categories/1956.jpeg', 'categorysubsecond', 0, 0, 1401265119, 1401265119);

-- --------------------------------------------------------

--
-- Table structure for table `shop_category_i18n`
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
-- Dumping data for table `shop_category_i18n`
--

INSERT INTO `shop_category_i18n` (`id`, `locale`, `name`, `h1`, `description`, `meta_desc`, `meta_title`, `meta_keywords`) VALUES
(1, 'ru', 'Активный отдых и туризм', '', '', '', '', ''),
(3, 'ru', 'Детские товары', '', '', '', '', ''),
(7, 'ru', 'Музыкальные инструменты', '', '', '', '', ''),
(8, 'ru', 'Телефония, МР3-плееры, GPS', '', NULL, '', '', ''),
(9, 'ru', 'Домашнее видео', 'ТВ, Аудио, Видео', '', '', '', ''),
(927, 'ru', 'Телефоны', 'Телефоны  ', NULL, '', '', ''),
(928, 'ru', 'MP3-MP4 плееры', 'MP3/MP4 плееры ', NULL, '', '', ''),
(930, 'ru', 'Мобильные телефоны', 'Мобильные телефоны', NULL, '', '', ''),
(931, 'ru', 'Смартфоны', 'Смартфоны', NULL, '', '', ''),
(932, 'ru', 'Bluetooth гарнитуры', 'Bluetooth гарнитуры', NULL, '', '', ''),
(933, 'ru', 'Проводные гарнитуры', 'Проводные гарнитуры', NULL, '', '', ''),
(935, 'ru', 'Аккумуляторы', 'Аккумуляторы', '', '', '', ''),
(936, 'ru', 'Зарядные устройства', 'Зарядные устройства', '', '', '', ''),
(937, 'ru', 'Карты памяти', 'Карты памяти', '', '', '', ''),
(938, 'ru', 'Защитные пленки', ' Защитные пленки', '', '', '', ''),
(939, 'ru', 'Apple iPod и аксессуары', 'Apple iPod и аксессуары', NULL, '', '', ''),
(940, 'ru', 'MP3- и медиаплееры', 'MP3- и медиаплееры', NULL, '', '', ''),
(942, 'ru', 'Наушники', 'Наушники', NULL, '', '', ''),
(2583, 'ru', 'Чехлы для телефонов', '', NULL, '', '', ''),
(2597, 'ru', 'Аксессуары для телефонов', '', '', '', '', ''),
(3013, 'ru', 'Аксессуары', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_comulativ_discount`
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
-- Table structure for table `shop_currencies`
--

DROP TABLE IF EXISTS `shop_currencies`;
CREATE TABLE IF NOT EXISTS `shop_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `main` tinyint(1) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `symbol` varchar(5) DEFAULT NULL,
  `rate` float(10,4) DEFAULT '1.0000',
  `showOnSite` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shop_currencies_I_1` (`name`),
  KEY `shop_currencies_I_2` (`main`),
  KEY `shop_currencies_I_3` (`is_default`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_currencies`
--

INSERT INTO `shop_currencies` (`id`, `name`, `main`, `is_default`, `code`, `symbol`, `rate`, `showOnSite`) VALUES
(1, 'Dollars', 0, 0, 'USD', '$', 0.0310, 1),
(2, 'Рубль', 1, 1, 'RUR', 'руб', 1.0000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_methods`
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
-- Dumping data for table `shop_delivery_methods`
--

INSERT INTO `shop_delivery_methods` (`id`, `price`, `free_from`, `enabled`, `is_price_in_percent`, `position`, `delivery_sum_specified`) VALUES
(5, 80.00000, 5000.00000, 1, 0, NULL, 0),
(6, 0.00000, 0.00000, 1, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_methods_i18n`
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
-- Dumping data for table `shop_delivery_methods_i18n`
--

INSERT INTO `shop_delivery_methods_i18n` (`id`, `locale`, `name`, `description`, `pricedescription`, `delivery_sum_specified_message`) VALUES
(5, 'ru', 'Адресная доставка курьером', '<p>Сроки доставки: 1-2 дня</p>', '', ''),
(6, 'ru', 'Доставка экспресс службой', '<p>Сроки доставки 2-3 дня</p>', '', 'согласно тарифам перевозчиков');

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivery_methods_systems`
--

DROP TABLE IF EXISTS `shop_delivery_methods_systems`;
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
-- Table structure for table `shop_discounts`
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
-- Table structure for table `shop_gifts`
--

DROP TABLE IF EXISTS `shop_gifts`;
CREATE TABLE IF NOT EXISTS `shop_gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `espdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_gifts`
--

INSERT INTO `shop_gifts` (`id`, `key`, `active`, `price`, `created`, `espdate`) VALUES
(1, 'WTWWwPHJ4Al91jnZ', NULL, 100, 1354039607, 1354219200),
(2, '7WMAohSSCA3OViRL', NULL, 4, 1354039810, 1353700800),
(3, 'psnqw6IFxamCOCVmsd', NULL, 35, 1354039839, 1352404800);

-- --------------------------------------------------------

--
-- Table structure for table `shop_kit`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `shop_kit`
--

INSERT INTO `shop_kit` (`id`, `product_id`, `active`, `position`, `only_for_logged`) VALUES
(15, 1104, 1, 1, 0),
(14, 1104, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_kit_product`
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
-- Dumping data for table `shop_kit_product`
--

INSERT INTO `shop_kit_product` (`product_id`, `kit_id`, `discount`) VALUES
(6193, 14, '4'),
(14196, 14, '5'),
(13904, 15, '0'),
(16833, 15, '4');

-- --------------------------------------------------------

--
-- Table structure for table `shop_notifications`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_notification_statuses`
--

DROP TABLE IF EXISTS `shop_notification_statuses`;
CREATE TABLE IF NOT EXISTS `shop_notification_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_notification_statuses_I_2` (`position`),
  KEY `shop_notification_statuses_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `shop_notification_statuses`
--

INSERT INTO `shop_notification_statuses` (`id`, `position`) VALUES
(1, 1),
(2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_notification_statuses_i18n`
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
-- Dumping data for table `shop_notification_statuses_i18n`
--

INSERT INTO `shop_notification_statuses_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Новый'),
(2, 'ru', 'Выполнен');

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

DROP TABLE IF EXISTS `shop_orders`;
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
  `external_id` varchar(255) DEFAULT NULL,
  `gift_cert_key` varchar(25) DEFAULT NULL,
  `gift_cert_price` float(10,2) DEFAULT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `discount_info` text,
  `origin_price` float(10,2) DEFAULT NULL,
  `user_surname` varchar(255) DEFAULT NULL,
  `comulativ` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_orders_I_1` (`key`),
  KEY `shop_orders_I_2` (`status`),
  KEY `shop_orders_I_3` (`date_created`),
  KEY `shop_orders_FI_1` (`delivery_method`),
  KEY `shop_orders_FI_2` (`payment_method`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders_products`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders_status_history`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_statuses`
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
-- Dumping data for table `shop_order_statuses`
--

INSERT INTO `shop_order_statuses` (`id`, `position`, `color`, `fontcolor`) VALUES
(1, 0, '#8b8f8b', '#ffffff'),
(2, 3, '#348c30', '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_statuses_i18n`
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
-- Dumping data for table `shop_order_statuses_i18n`
--

INSERT INTO `shop_order_statuses_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Новый'),
(2, 'ru', 'Доставлен');

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment_methods`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `shop_payment_methods`
--

INSERT INTO `shop_payment_methods` (`id`, `active`, `currency_id`, `position`, `payment_system_name`) VALUES
(1, 1, 2, 0, '0'),
(2, 1, 2, 2, 'OschadBankInvoiceSystem'),
(3, 1, 2, 3, 'SberBankInvoiceSystem'),
(10, 1, 2, 5, 'LiqPaySystem'),
(9, 1, 2, 4, 'WebMoneySystem'),
(11, 1, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment_methods_i18n`
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
-- Dumping data for table `shop_payment_methods_i18n`
--

INSERT INTO `shop_payment_methods_i18n` (`id`, `locale`, `name`, `description`) VALUES
(1, 'ru', 'Наличными курьеру', '<p>Оплата наличными курьеру</p>'),
(2, 'ru', 'Оплата через Банк', '<p>Оплата через ОщадБанк Украины</p>'),
(3, 'ru', 'СберБанк России', '<p>Оплата через СберБанк России</p>'),
(10, 'ru', 'Visa/Mastercard', '<p>Оплата картой через сервис Liqpay</p>'),
(1, 'en', 'Payment for the courier', ''),
(2, 'en', 'Payment by bank', ''),
(3, 'en', 'Sberbank of Russia', ''),
(9, 'ru', 'Webmoney', ''),
(11, 'ru', 'Наложенным платежем', '<p>Оплата наличными на складе экспресс службы</p>');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
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
  `old_price` float(10,2) DEFAULT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17193 ;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `url`, `active`, `hit`, `brand_id`, `category_id`, `related_products`, `created`, `updated`, `old_price`, `views`, `hot`, `action`, `added_to_cart_count`, `enable_comments`, `external_id`, `tpl`, `user_id`) VALUES
(1019, 'htc-one-sv-white', 1, 1, 112, 931, '', 1364500800, 1368877440, 0.00, 66, 0, NULL, 2, 1, NULL, '', NULL),
(937, '3d-led-televizor-samsung-ue65es8007uxua', 1, 0, 28, 9, '', 1364241600, 1364475954, 45424.00, 44, 0, 1, NULL, 1, NULL, '', NULL),
(945, '3d-led-televizor-samsung-ue50es6907-uxua', 1, 1, 96, 9, '', 1364241600, 1367068373, 16780.00, 40, 0, 0, NULL, 1, NULL, '', NULL),
(949, 'televizory-kakoi-vybrat', 1, 0, 96, 9, '', 1364328000, 1367068585, 0.00, 26, 1, 0, NULL, 1, NULL, '', NULL),
(955, '3d-ochkii-besprovodnoe-ustroistvo-samsungssg-4100gb-ru', 1, 0, 28, 9, '', 1364328000, 1367068741, 199.00, 41, 1, 0, NULL, 1, NULL, '', NULL),
(956, 'samsung-domashni-kinoteatr-ht-e330k-ru', 1, NULL, 28, 9, '', 1364328000, 1369922383, 0.00, 19, NULL, NULL, NULL, 1, NULL, '', NULL),
(957, 'plazmennyi-televizor-samsung-ps-51e497', 1, NULL, 28, 9, '', 1364328000, 1369922717, 8999.00, 25, NULL, NULL, NULL, 1, NULL, '', NULL),
(959, 'mp3-mp4-pleera-texet-t-930hd-8gb', 1, 1, 109, 940, '', 1364328000, 1364406869, 0.00, 36, 0, NULL, NULL, 1, NULL, '', NULL),
(1022, 'assistant-am-09404-4gb', 1, NULL, 113, 928, '', 1364500800, 1364509881, 0.00, 18, 0, NULL, NULL, 1, NULL, '', NULL),
(1006, 'mp3-mp4-pleer-apple-ipod-touch-5g-32gb-black', 1, 0, 27, 939, '', 1364500800, 1364504349, 0.00, 25, 0, NULL, NULL, 1, NULL, '', NULL),
(1018, 'mp3-mp4-pleer-texet-t-979hd-4gb', 1, 0, 109, 928, '', 1364500800, 1364506291, 0.00, 21, NULL, NULL, NULL, 1, NULL, '', NULL),
(1021, 'mp3-mp4-pleer-sony-walkman-nwz-b172-2gb-black', 1, NULL, 26, 928, '', 1364500800, 1364508747, 0.00, 19, 0, NULL, NULL, 1, NULL, '', NULL),
(1015, 'mp3-mp4-pleer-apple-ipod-touch-4-gen-8-gb', 1, NULL, 27, 928, '', 1364500800, 1364505410, 1500.00, 44, NULL, 0, NULL, 1, NULL, '', NULL),
(1023, 'nokia-asha-302-white', 1, 0, 42, 930, '', 1364500800, 1368270832, 0.00, 82, 0, NULL, 1, 1, NULL, '', NULL),
(1024, 'garnitura-nokia-bh-108', 1, NULL, 42, 932, '', 1364500800, 1364748383, 0.00, 15, 0, NULL, NULL, 1, NULL, '', NULL),
(1025, 'garnitura-samsung-ehs62asn-white', 1, NULL, 28, 933, '', 1364500800, 1364748482, 0.00, 22, 0, NULL, NULL, 1, NULL, '', NULL),
(1096, 'mobilnyi-telefon-samsung-galaxy-grand-duos-i9082-elegant-white', 1, 1, 28, 931, '', 1364673600, 1368876800, 0.00, 31, NULL, NULL, NULL, 1, NULL, '', NULL),
(1099, 'mobilnyi-telefon-sony-xperia-z-c6603-black', 1, NULL, 26, 931, '', 1364673600, 1368876582, 0.00, 19, 1, NULL, NULL, 1, NULL, '', NULL),
(1104, 'mobilnyi-telefon-sony-xperia-v-lt25i-black', 1, 1, 26, 931, '13893,13897,13902,13904,6199,6201,6204,6193,6194,5775', 1364760000, 1395052529, 5400.00, 33, NULL, NULL, 7, 1, NULL, '', NULL),
(1105, 'mobilnyi-telefon-lg-nexus-4-e960-black', 1, 1, 35, 931, NULL, 1364760000, 1395055056, 6000.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(1107, 'akkumuliator-k-telefonu-nokia-bl-4c', 1, NULL, 42, 935, '', 1364760000, 1367087224, 0.00, 16, NULL, NULL, NULL, 1, NULL, '', NULL),
(1108, 'nokia-lumia-920-white', 1, 0, 42, 931, '', 1364760000, 1368876641, 0.00, 36, 1, NULL, NULL, 1, NULL, '', NULL),
(1109, 'karta-pamiati-kingston-microsd-16-gb-sdc4-16gb', 1, 1, 114, 937, '', 1364760000, 1364764440, 0.00, 17, 0, NULL, NULL, 1, NULL, '', NULL),
(1110, 'zariadnoe-ustroistvo-setevoi-adapter-apple-mb707-white', 1, NULL, 27, 939, '', 1364760000, 1367087111, 0.00, 14, NULL, NULL, NULL, 1, NULL, '', NULL),
(1111, 'zariadnoe-ustroistvo-nokia-ac-4e', 1, NULL, 42, 936, '', 1364760000, 1364764446, 0.00, 14, NULL, 1, NULL, 1, NULL, '', NULL),
(1112, 'garnitura-nokia-bh-505', 1, NULL, 42, 932, '', 1364760000, 1364764812, NULL, 14, NULL, 1, NULL, 1, NULL, '', NULL),
(1113, 'naushniki-panasonic-rp-hje120e-g-green', 1, 0, 29, 942, '', 1364760000, 1368375958, 81.00, 22, NULL, 1, NULL, 1, NULL, '', NULL),
(1114, 'garnitura-samsung-p1000-ehs-60-black', 1, NULL, 28, 933, '', 1364760000, 1364765048, 0.00, 16, NULL, 1, NULL, 1, NULL, '', NULL),
(1115, 'garnitura-samsung-bhm1100-black', 1, 1, 28, 932, '', 1364760000, 1364765488, 0.00, 17, NULL, NULL, 3, 1, NULL, '', NULL),
(1117, 'garnitura-samsung-bhs6000-ebecsek', 1, NULL, 28, 933, '', 1364760000, 1364765823, 0.00, 27, 1, NULL, NULL, 1, NULL, '', NULL),
(4016, 'kolesnyi-pogruzchik-na-radioupravlenii', 1, NULL, 169, 3, '', 1366209446, 1369147608, 1.00, 14, NULL, NULL, NULL, 1, NULL, '', NULL),
(4018, 'gusenichnii-kran-na-radiokeruvanni', 1, NULL, 169, 3, '', 1366210573, 1368859997, 1.00, 23, NULL, NULL, NULL, 1, NULL, '', NULL),
(4020, 'karernii-samoskid-na-radiokeruvanni', 1, NULL, 169, 3, NULL, 1366210573, 1368628979, 1.00, 14, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(4021, 'mashina-z-pidiomnim-kranom-na-radiokeruvanni', 1, NULL, 169, 3, '', 1366210573, 1369147697, 1.00, 11, NULL, NULL, NULL, 1, NULL, '', NULL),
(12045, 'smartfon-samsung-gt-s7562-galaxy-s-duos-zka-black', 1, NULL, 28, 931, '', 1368874834, 1379865332, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(12043, 'smartfon-samsung-gt-s7530-omnia-m-eaa-deep-grey', 1, NULL, 28, 931, NULL, 1368874834, 1368874834, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12042, 'smartfon-samsung-gt-s7500-cwa-galaxy-ace-plus-chic-white', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12041, 'smartfon-samsung-gt-s7500-aba-galaxy-ace-plus-dark-blue', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12040, 'smartfon-samsung-gt-s6810-galaxy-fame-pure-white', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12039, 'smartfon-samsung-gt-s6810-galaxy-fame-metallic-blue', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12038, 'smartfon-samsung-gt-s6802-zya-galaxy-ace-duos-yellow', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12036, 'smartfon-samsung-gt-s6802-zia-galaxy-ace-duos-pink', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12035, 'smartfon-samsung-gt-s6802-tiz-galaxy-ace-duos-romantic-pink-la-fleur', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12034, 'smartfon-samsung-gt-s6802-galaxy-ace-duos-zka-black', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12033, 'smartfon-samsung-gt-s6802-cwa-galaxy-ace-duos-shic-white', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12032, 'smartfon-samsung-gt-s6802-aka-galaxy-ace-duos-metallic-black', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12031, 'smartfon-samsung-gt-s6500-galaxy-mini-2-zyd-yellow', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12030, 'smartfon-samsung-gt-s6500-galaxy-mini-2-rwd-ceramic-white', 1, NULL, 28, 931, NULL, 1368874833, 1368874833, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5596, 'mobilnyi-telefon-alcatel-ds-1060-dual-sim', 1, NULL, 132, 930, '', 1366890244, 1368270406, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(13389, 'zashchitnaia-plenka-htc-p840-dlia-desire', 1, NULL, 112, 938, '', 1369512000, 1369596264, 0.00, 10, NULL, NULL, NULL, 1, NULL, '', NULL),
(13388, 'zashchitnaia-plenka-htc-p870-dlia-wp-8x', 1, NULL, 112, 938, '', 1369512000, 1369595946, 0.00, 5, NULL, NULL, NULL, 1, NULL, '', NULL),
(13387, 'zashchitnaia-plenka-htc-sp-p890-dlia-wp8s-2sht', 1, NULL, 112, 938, '', 1369512000, 1369595664, NULL, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(13386, 'zashchitnaia-plenka-htc-sp-p900-dlia-one-sv-2sht', 1, NULL, 112, 938, '', 1369512000, 1369595172, NULL, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(13385, 'zashchitnaia-plenka-nokia-302', 1, NULL, 42, 938, '', 1369512000, 1369594706, NULL, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(13384, 'zashchitnaia-plenka-nokia-asha-311', 1, NULL, 42, 938, '', 1369512000, 1369594429, NULL, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(13383, 'zashchitnaia-plenka-samsung-n7100', 1, NULL, 28, 938, '', 1369512000, 1369594125, NULL, 5, NULL, NULL, NULL, 1, NULL, '', NULL),
(13382, 'zashchitnaia-plenka-samsung-wave-y-s5380', 1, NULL, 28, 938, '', 1369512000, 1369593881, 0.00, 12, NULL, NULL, NULL, 1, NULL, '', NULL),
(13381, 'zashchitnaia-plenka-samsung-s7562', 1, NULL, 28, 938, '', 1369512000, 1369593239, NULL, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(13380, 'zashchitnaia-plenka-samsung-i8160', 1, NULL, 28, 938, '', 1369512000, 1369592935, NULL, 5, NULL, NULL, NULL, 1, NULL, '', NULL),
(13379, 'zashchitnaia-plenka-dlia-samsung-i9300', 1, NULL, 28, 938, '', 1369512000, 1369592679, 0.00, 4, NULL, NULL, NULL, 1, NULL, '', NULL),
(4796, 'igrashka-poprigunchik-tiny-smarts-jumpy', 1, NULL, 169, 3, '', 1366711637, 1368866912, 96.00, 15, NULL, NULL, NULL, 1, NULL, '', NULL),
(4960, 'elektrogitara-seriyi-badwater-as820ckbk', 1, NULL, 258, 7, NULL, 1366728448, 1395068747, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(4959, 'elektrogitara-seriyi-badwater-as820br', 1, NULL, 258, 7, NULL, 1366728448, 1395068743, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(4958, 'elektrogitara-seriyi-badwater-as1120wo', 1, NULL, 258, 7, NULL, 1366728448, 1395068738, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(4957, 'elektrogitara-seriyi-badwater-as1120br', 1, NULL, 258, 7, NULL, 1366728448, 1395068733, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(4955, 'elektrogitara-seriyi-badwater-al820ckbw', 1, NULL, 106, 7, NULL, 1366728448, 1395068706, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(4950, 'elektrogitara-seriyi-badwater-al790ms', 1, NULL, 258, 7, NULL, 1366728448, 1395068692, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(5634, 'mobilnyi-telefon-fly-ezzy-flip-dual-sim-black', 1, NULL, 119, 930, '', 1366892811, 1368270427, 0.00, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(5633, 'mobilnyi-telefon-fly-ezzy-black', 1, NULL, 119, 930, '', 1366892811, 1368270447, 0.00, 4, NULL, NULL, NULL, 1, NULL, '', NULL),
(5632, 'mobilnyi-telefon-fly-e210-shrome', 1, NULL, 119, 930, '', 1366892811, 1368270478, 0.00, 14, NULL, NULL, NULL, 1, NULL, '', NULL),
(5631, 'mobilnyi-telefon-fly-e200-duos-metalic', 1, NULL, 119, 930, '', 1366892811, 1368270512, 0.00, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(5630, 'mobilnyi-telefon-fly-e190-duos-wi-fi-black', 1, NULL, 119, 930, '', 1366892811, 1368270530, 0.00, 2, NULL, NULL, NULL, 1, NULL, '', NULL),
(5629, 'mobilnyi-telefon-fly-e171-duos-high-glossy-black', 1, NULL, 119, 930, '', 1366892811, 1368270563, 0.00, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(5628, 'mobilnyi-telefon-fly-e154-dual-sim-silver', 1, NULL, 119, 930, '', 1366892811, 1368270592, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(5627, 'mobilnyi-telefon-fly-e154-dual-sim-black', 1, NULL, 119, 930, '', 1366892811, 1368270675, 0.00, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(5626, 'mobilnyi-telefon-fly-e145-tv-dual-sim-white', 1, NULL, 119, 930, '', 1366892811, 1368270888, 0.00, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(5625, 'mobilnyi-telefon-fly-e145-tv-dual-sim-black', 1, NULL, 119, 930, '', 1366892811, 1368270904, 0.00, 5, NULL, NULL, NULL, 1, NULL, '', NULL),
(5624, 'mobilnyi-telefon-fly-e141-tv-dual-sim-white', 1, NULL, 119, 930, NULL, 1366892811, 1366893240, NULL, 24, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5623, 'mobilnyi-telefon-fly-e141-tv-dual-sim-black', 1, NULL, 119, 930, NULL, 1366892811, 1366893240, NULL, 10, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5622, 'mobilnyi-telefon-fly-e133-duos-white', 1, NULL, 119, 930, '', 1366892811, 1368270931, 0.00, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(5602, 'mobilnyi-telefon-fly-ds103d-duos-black', 1, NULL, 119, 930, '', 1366892810, 1368270951, 0.00, 4, NULL, NULL, NULL, 1, NULL, '', NULL),
(5603, 'mobilnyi-telefon-fly-b300-duos-grey', 1, NULL, 119, 930, '', 1366892810, 1368270971, 0.00, 4, NULL, NULL, NULL, 1, NULL, '', NULL),
(5604, 'mobilnyi-telefon-fly-ds103-duos-grey', 1, NULL, 119, 930, '', 1366892811, 1368270996, 0.00, 4, NULL, NULL, NULL, 1, NULL, '', NULL),
(5605, 'mobilnyi-telefon-fly-e185-black-bronze', 1, NULL, 119, 930, '', 1366892811, 1368271009, 0.00, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(5606, 'mobilnyi-telefon-fly-e176-duos-silver', 1, NULL, 119, 930, '', 1366892811, 1368271026, 0.00, 5, NULL, NULL, NULL, 1, NULL, '', NULL),
(5775, 'mobilnyi-telefon-samsung-gt-s5610-msa-metallic-silver', 1, NULL, 28, 935, '', 1366892816, 1368280824, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6194, 'akkumuliator-samsung-eb-l1f2hvucstd-black-i9250', 1, NULL, 28, 935, '', 1366983383, 1368280837, 0.00, 10, NULL, NULL, NULL, 1, NULL, '', NULL),
(6195, 'akkumuliator-samsung-eb-l1g6llucstd-i9300-black', 1, NULL, 28, 935, NULL, 1366983383, 1366983508, NULL, 9, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(6196, 'akkumuliator-samsung-eb595675lucstd-n7100-black', 1, NULL, 28, 935, '', 1366983383, 1368280852, 0.00, 10, NULL, NULL, NULL, 1, NULL, '', NULL),
(6197, 'akkumuliator-samsung-eb615268vucstd-black-n7000', 1, NULL, 28, 935, '', 1366983383, 1368280872, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6198, 'vneshnii-akkumuliator-samsung-eeb-ei1cwegstd-white', 1, NULL, 28, 936, '', 1366983383, 1368280953, 0.00, 34, NULL, NULL, NULL, 1, NULL, '', NULL),
(6193, 'akkumuliator-samsung-eb-k1a2ewegstd-white', 1, NULL, 28, 935, NULL, 1366983383, 1395071557, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(6192, 'akkumuliator-samsung-eb-k1a2ebegstd-black', 1, NULL, 28, 935, '', 1366983383, 1368280921, 0.00, 10, NULL, NULL, NULL, 1, NULL, '', NULL),
(6199, 'zariadnoe-ustroistvo-samsung-eca-u16cbegstd-n7000-black', 1, NULL, 28, 936, '', 1366983580, 1368280974, 0.00, 16, NULL, NULL, NULL, 1, NULL, '', NULL),
(6200, 'zariadnoe-ustroistvo-samsung-eta-p11ebegstd-galaxy-p3100-p5100-n8000-black', 1, NULL, 28, 936, NULL, 1366983580, 1366983580, NULL, 16, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(6201, 'zariadnoe-ustroistvo-samsung-eta-u90ebegstd-n7100-black', 1, NULL, 28, 936, '', 1366983580, 1368281005, 0.00, 29, NULL, NULL, NULL, 1, NULL, '', NULL),
(6202, 'zariadnoe-ustroistvo-samsung-eta-u90ewegstd-n7100-white', 1, NULL, 28, 936, NULL, 1366983580, 1366983580, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(6203, 'zariadnoe-ustroistvo-samsung-eta0u10ebecstd-black', 1, NULL, 28, 936, '', 1366983580, 1368281020, 0.00, 22, NULL, NULL, NULL, 1, NULL, '', NULL),
(6204, 'zariadnoe-ustroistvo-samsung-eta0u80ebegstd-black-n7000', 1, NULL, 28, 936, '', 1366983580, 1368281035, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6205, 'zariadnoe-ustroistvo-ufo-ec-004-5v-2-adaptora-nokia-kit', 1, NULL, 150, 936, '', 1366983580, 1368281057, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6206, 'zariadnoe-ustroistvo-podstavka-samsung-edd-d100wegstd-tab-tab2-desktop-dock-white', 1, NULL, 28, 936, '', 1366983580, 1368281074, 0.00, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(6207, 'podstavka-s-zariadnym-ustroistvom-samsung-ebh1a2usbecstd-black', 1, NULL, 28, 936, '', 1366983580, 1368281087, 0.00, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(6208, 'podstavka-derzhatel-samsung-eb-h1j9vnegstd-n7100-white-akkumuliator', 1, NULL, 28, 936, '', 1366983580, 1368388734, 0.00, 12, NULL, NULL, NULL, 1, NULL, '', NULL),
(6211, 'garnitura-htc-rc-e240-black', 1, NULL, 112, 933, '', 1366983848, 1368277928, 0.00, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(6212, 'garnitura-htc-rc-e240-white', 1, NULL, 112, 933, '', 1366983848, 1368277947, 0.00, 10, NULL, NULL, NULL, 1, NULL, '', NULL),
(6215, 'garnitura-samsung-ehs60annbecstd-black', 1, NULL, 28, 933, '', 1366983848, 1368277960, 0.00, 10, NULL, NULL, NULL, 1, NULL, '', NULL),
(6216, 'garnitura-samsung-ehs60annwecstd-white', 1, NULL, 28, 933, '', 1366983848, 1368277979, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6217, 'garnitura-samsung-ehs60ennbecstd-black', 1, NULL, 28, 933, '', 1366983848, 1368277995, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6218, 'garnitura-samsung-ehs60ennwecstd-white', 1, NULL, 28, 933, '', 1366983848, 1368278015, 0.00, 11, NULL, NULL, NULL, 1, NULL, '', NULL),
(6219, 'garnitura-samsung-ehs62asnkecstd-blue', 1, NULL, 28, 933, '', 1366983848, 1369941720, 0.00, 12, NULL, NULL, NULL, 1, NULL, '', NULL),
(6220, 'garnitura-samsung-ehs62asnpecstd-pink', 1, NULL, 28, 933, '', 1366983848, 1368278045, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6221, 'garnitura-samsung-ehs62asnwecstd-white', 1, NULL, 28, 933, '', 1366983848, 1368278059, 0.00, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(6222, 'garnitura-samsung-ehs63asnbecstd-black', 1, NULL, 28, 933, '', 1366983848, 1368278075, 0.00, 10, NULL, NULL, NULL, 1, NULL, '', NULL),
(6223, 'garnitura-samsung-ehs64asfwecstd-white', 1, NULL, 28, 933, '', 1366983848, 1369941759, 0.00, 11, NULL, NULL, NULL, 1, NULL, '', NULL),
(6224, 'komplekt-svobodnye-ruki-jabra-bluetooth-headset-bt-2015', 1, NULL, 142, 932, '', 1366983848, 1369938078, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6225, 'komplekt-svobodnye-ruki-jabra-bluetooth-headset-bt-2070', 1, NULL, 142, 932, '', 1366983848, 1369938128, 0.00, 7, NULL, NULL, 3, 1, NULL, '', NULL),
(6226, 'komplekt-svobodnye-ruki-nokia-bluetooth-headset-bh-104-black', 1, NULL, 42, 932, '', 1366983848, 1369938195, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6227, 'komplekt-svobodnye-ruki-nokia-headset-bluetooth-bh-110-black', 1, NULL, 42, 932, '', 1366983848, 1369940214, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(6228, 'komplekt-svobodnye-ruki-nokia-headset-bluetooth-bh-110-white', 1, NULL, 42, 932, '', 1366983848, 1369938234, 0.00, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(6229, 'komplekt-svobodnye-ruki-samsung-awep460ebegsek-black-bluetooth-headset', 1, NULL, 28, 932, '', 1366983848, 1369938315, 0.00, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(6230, 'komplekt-svobodnye-ruki-samsung-bhm1200ebegsek-black', 1, NULL, 28, 932, '', 1366983848, 1369938273, 0.00, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(6843, 'dok-stantsiia-samsung-edd-d1e1begstd-black', 1, NULL, 28, 2597, '', 1367044666, 1368860874, 0.00, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(6844, 'dok-stantsiia-samsung-edd-h1f2begstd-black-i9250', 1, NULL, 28, 2597, '', 1367044666, 1368860874, 0.00, 6, NULL, NULL, NULL, 1, NULL, '', NULL),
(7974, 'mp3-flesh-pleer-ergo-zen-basic-4-gb-blue', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7975, 'mp3-flesh-pleer-ergo-zen-basic-4-gb-white', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 8, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7976, 'mp3-flesh-pleer-ergo-zen-basic-8-gb-black', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 8, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7977, 'mp3-flesh-pleer-ergo-zen-modern-2-gb-black', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 14, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7978, 'mp3-flesh-pleer-ergo-zen-modern-2-gb-red', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 18, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7979, 'mp3-flesh-pleer-ergo-zen-modern-4-gb-black', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 11, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7980, 'mp3-flesh-pleer-ergo-zen-modern-4-gb-blue', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 9, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7981, 'mp3-flesh-pleer-ergo-zen-modern-4-gb-red', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 10, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7982, 'mp3-flesh-pleer-ergo-zen-modern-8-gb-black', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 11, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7983, 'mp3-flesh-pleer-ergo-zen-modern-8-gb-red', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 6, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7984, 'mp3-flesh-pleer-ergo-zen-style-4-gb', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 12, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7985, 'mp3-flesh-pleer-ergo-zen-style-8-gb', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 8, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7986, 'mr3-flesh-pleer-ergo-zen-little-2-gb-blue', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 11, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7987, 'mr3-flesh-pleer-ergo-zen-clip-2-gb-black', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7988, 'mp3-flesh-pleer-ergo-zen-volume-4-gb-black', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 6, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7989, 'mp3-flesh-pleer-ergo-zen-volume-4-gb-white', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 6, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7990, 'mp3-flesh-pleer-ergo-zen-volume-8-gb-black', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7991, 'mp3-flesh-pleer-ergo-zen-volume-8-gb-white', 1, NULL, 154, 940, NULL, 1367067047, 1367067047, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7992, 'mp3-flesh-pleer-iriver-e-40-4-gb-dark-gray', 1, NULL, 152, 940, NULL, 1367067047, 1367067047, NULL, 8, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(8430, 'vkladysh-dlia-spalnogo-meshka-easy-camp-cotton-travel-sheet-mummy', 1, NULL, 91, 1, NULL, 1367073923, 1371131273, NULL, 9, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(8431, 'vkladysh-dlia-spalnogo-meshka-easy-camp-cotton-travel-sheet-rectangular', 1, NULL, 91, 1, NULL, 1367073923, 1371131273, NULL, 11, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(8432, 'spalnyi-meshok-easy-camp-atlanta-plus', 1, NULL, 91, 1, NULL, 1367073923, 1371131273, NULL, 10, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(8433, 'spalnyi-meshok-easy-camp-chakra-black', 1, NULL, 91, 1, NULL, 1367073923, 1395068540, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(8434, 'spalnyi-meshok-easy-camp-chakra-pink', 1, NULL, 91, 1, NULL, 1367073923, 1395068561, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(11216, 'zashchitnaia-plenka-samsung-etc-p1g5cegstd-p3100-p3110', 1, NULL, 28, 938, '', 1368860874, 1368861018, 0.00, 3, NULL, NULL, NULL, 1, NULL, '', NULL),
(10179, 'naushniki-koss-the-plug', 1, 0, 168, 942, '', 1368302400, 1368372037, 0.00, 12, NULL, NULL, NULL, 1, NULL, '', NULL),
(10180, 'naushniki-koss-porta-pro', 1, 0, 168, 942, '', 1368302400, 1373278481, 0.00, 17, NULL, NULL, NULL, 1, NULL, '', NULL),
(10181, 'naushniki-koss-kebdz-twinz-ke7', 1, NULL, 168, 942, '', 1368302400, 1368374085, 8.00, 12, NULL, 0, 29, 1, NULL, '', NULL),
(10182, 'naushniki-sony-mdr-ex10lp-black', 1, NULL, 26, 942, '', 1368302400, 1368374914, 0.00, 38, 0, NULL, NULL, 1, NULL, '', NULL),
(10183, 'naushniki-panasonic-rp-hje120e-k', 1, NULL, 29, 942, '', 1368302400, 1373278482, 0.00, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(10184, 'naushnik-a4tech-mk-690-v', 1, NULL, 0, 942, '', 1368302400, 1368375854, NULL, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(10734, 'chehol-htc-hc-v841', 1, NULL, 112, 2583, NULL, 1368802373, 1368878508, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12162, 'chehol-samsung-efc-1g6ppecstd-i9300-pink', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12163, 'chehol-samsung-efc-1g6swecstd-i9300-white', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12164, 'chehol-samsung-efc-1g6wbecstd-blue', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12165, 'chehol-samsung-efc-1g6wpecstd-i9300-pink', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12166, 'chehol-samsung-efc-1g6wwecstd-white', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12167, 'chehol-samsung-efc-1h8ngecstd-p5100-p5110', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12168, 'chehol-samsung-efc-1j9bbegstd-n7100-black', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12169, 'chehol-samsung-efc-1j9bpegstd-n7100-pink', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12170, 'chehol-samsung-efc-1j9bwegstd-n7100-white', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 1, NULL, NULL, 3, 1, NULL, NULL, NULL),
(12171, 'chehol-knizhka-samsung-efc-1g2naecstd-amber-brown', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12172, 'chehol-knizhka-samsung-efc-1g2ngecstd-dark-gray', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12173, 'chehol-knizhka-samsung-efc-1g2nlecstd-light-blue', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12174, 'chehol-knizhka-samsung-efc-1g2nrecstd-garnet-red', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12175, 'chehol-knizhka-samsung-efc-1g5ngecstd-p3100-p3110-black', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12176, 'chehol-knizhka-samsung-efc-1g5sgecstd-p3100-p3110-dark-gray', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12177, 'chehol-knizhka-samsung-efc-1g6fbecstd-i9300-pebble-blue', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12178, 'chehol-knizhka-samsung-efc-1g6fgecstd-i9300-titanium-silver', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12179, 'chehol-knizhka-samsung-efc-1g6flecstd-i9300-light-blue', 1, NULL, 28, 2583, NULL, 1368878509, 1368878509, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12215, 'chehol-futliar-samsung-efc-1j9ldegstd-n7100-dark-brown', 1, NULL, 28, 2583, NULL, 1368878510, 1368878510, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11210, 'usb-kabel-htc-dc-m410', 1, NULL, 112, 2597, NULL, 1368860873, 1368860873, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11211, 'zashchitnaia-plenka-htc-sp-p910', 1, NULL, 112, 938, '', 1368860873, 1368861094, 0.00, 2, NULL, NULL, NULL, 1, NULL, '', NULL),
(11212, 'multimediinyi-modul-htc-dg-h200', 1, NULL, 112, 2597, NULL, 1368860874, 1368860874, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11213, 'ctilus-i-ruchka-chehol-samsung-et-s110ebegstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11214, 'usb-adapter-samsung-epl-1pl0begstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11215, 'data-kabel-samsung-ecc1dp0ubecstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11217, 'kabel-dlia-podkliucheniia-k-televizoru-samsung-epl-3fhubegstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11218, 'klaviatura-samsung-ekd-k11rwegser-p3100-p3110-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11219, 'klaviatura-samsung-ekd-k12rwegser-p5100-p5110-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11220, 'podstavka-samsung-edd-d1c9begstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11221, 'podstavka-derzhatel-samsung-ebh-1e1sbegstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11222, 'stilus-samsung-et-s100ebegstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11223, 'stilus-samsung-etc-s10csegstd-i9300-silver', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11224, 'stilus-samsung-etc-s1j9segstd-n7100-dark-silver', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11225, 'stilus-samsung-etc-s1j9wegstd-n7100-white', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11226, 'universalnaia-podstavka-samsung-edd-d100begstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11227, 'universalnaia-podstavka-samsung-edd-d200begstd-black', 1, NULL, 28, 2597, NULL, 1368860874, 1368860874, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12737, 'zhk-televizor-bbk-lem2249hd-black', 1, NULL, 143, 9, NULL, 1369060816, 1369060998, NULL, 18, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13377, 'zashchitnaia-plenka-screen-ward-samsung-s5660', 1, NULL, 28, 938, '', 1369512000, 1369583657, 0.00, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(13378, 'zashchitnaia-plenka-samsung-i9300-matovaia', 1, NULL, 28, 938, '', 1369512000, 1369584252, 0.00, 6, NULL, NULL, NULL, 1, NULL, '', NULL),
(13376, 'zashchitnaia-plenka-screen-ward-samsung-s6102', 1, NULL, 28, 938, '', 1369512000, 1369582570, 0.00, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(13392, 'zashchitnaia-plenka-drobak-samsung-s7562', 1, NULL, 28, 938, '', 1369512000, 1369597151, NULL, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(13391, 'zashchitnaia-plenka-drobak-sony-xperia-j-st26', 1, NULL, 26, 938, '', 1369512000, 1369596889, NULL, 6, NULL, NULL, NULL, 1, NULL, '', NULL),
(13390, 'zashchitnaia-plenka-htc-p730-dlia-one-x', 1, NULL, 112, 938, '', 1369512000, 1369596543, NULL, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(13393, 'zashchitnaia-plenka-drobak-samsung-i9070', 1, NULL, 28, 938, '', 1369512000, 1369597391, NULL, 4, NULL, NULL, NULL, 1, NULL, '', NULL),
(13889, 'karta-pamiati-transcend-microsdhc-16-gb-class-10-uhs-i-ultimate-x600-adapter', 1, NULL, 153, 937, NULL, 1369839017, 1369910831, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13890, 'karta-pamiati-transcend-microsdhc-32-gb-class-10-uhs-i-ultimate-x600-adapter', 1, NULL, 153, 937, NULL, 1369839018, 1369910831, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13891, 'karta-pamiati-goodram-microsd-2-gb-adapter-retail-10', 1, NULL, 193, 937, NULL, 1369839018, 1369910831, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13892, 'karta-pamiati-goodram-microsd-2-gb-retail-9-adapter', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13893, 'karta-pamiati-goodram-microsd-4-gb-adapter-i-usb-kadtrider', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13894, 'karta-pamiati-goodram-microsd-8-gb-adapter-i-usb-kadtrider', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13895, 'karta-pamiati-goodram-microsdhc-16-gb-class-10-adapter-retail-10', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 6, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13896, 'karta-pamiati-goodram-microsdhc-16-gb-class-10-adapter', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 2, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13897, 'karta-pamiati-goodram-microsdhc-16-gb-class-10-uhs-i-adapter-retail-10', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 6, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13898, 'karta-pamiati-goodram-microsdhc-16-gb-class-4-adapter', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13899, 'karta-pamiati-goodram-microsdhc-32-gb-class-10-adapter-retail-10', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 6, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13900, 'karta-pamiati-goodram-microsdhc-32-gb-class-10-adapter', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 3, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13901, 'karta-pamiati-goodram-microsdhc-32-gb-class-10-uhs-i-adapter-retail-10', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13902, 'karta-pamiati-goodram-microsdhc-32-gb-class-4-adapter', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13903, 'karta-pamiati-goodram-microsdhc-4-gb-class-4-adapter-retail-10', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13904, 'karta-pamiati-goodram-microsdhc-4-gb-class-4-retail-9-adapter', 1, NULL, 193, 937, NULL, 1369839018, 1395071590, 0.00, 0, NULL, NULL, 0, 1, NULL, '', NULL),
(13905, 'karta-pamiati-goodram-microsdhc-8-gb-class-10-adapter-retail-10', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13906, 'karta-pamiati-goodram-microsdhc-8-gb-class-10-adapter', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 4, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13907, 'karta-pamiati-goodram-microsdhc-8-gb-class-4-adapter-retail-10', 1, NULL, 193, 937, NULL, 1369839018, 1369910832, NULL, 7, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(14190, 'garnitura-samsung-bhm-1200-black', 1, NULL, 28, 932, '', 1369857600, 1369921931, 0.00, 12, NULL, NULL, NULL, 1, NULL, '', NULL),
(14192, 'bluetooth-garnitura-nokia-bh-806', 1, NULL, 28, 932, '', 1369857600, 1369938293, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(14194, 'garnitura-nokia-bh-108-ice', 1, NULL, 28, 932, '', 1369857600, 1369923308, 0.00, 5, NULL, NULL, NULL, 1, NULL, '', NULL),
(14196, 'garnitura-jabra-easy-call', 1, NULL, 142, 932, '', 1369857600, 1369924423, 0.00, 6, NULL, NULL, NULL, 1, NULL, '', NULL),
(14198, 'garnitura-jabra-bt2045', 1, NULL, 142, 932, '', 1369857600, 1369925784, 0.00, 5, NULL, NULL, NULL, 1, NULL, '', NULL),
(14199, 'garnitura-bluetooth-nokia-bh-111-black', 1, NULL, 42, 932, '', 1369857600, 1369938866, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(14200, 'garnitura-jabra-easygo', 1, NULL, 142, 932, '', 1369857600, 1369939245, 0.00, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(14201, 'garnitura-nokia-bh-220-black', 1, NULL, 42, 932, '', 1369857600, 1369939815, 0.00, 4, NULL, NULL, NULL, 1, NULL, '', NULL),
(14202, 'garnitura-nokia-bh-112-black', 1, NULL, 42, 932, '', 1369857600, 1369940065, 0.00, 7, NULL, NULL, NULL, 1, NULL, '', NULL),
(14203, 'garnitura-nokia-hs-47-vakuumnaia', 1, NULL, 42, 933, '', 1369857600, 1369940564, NULL, 10, NULL, NULL, NULL, 1, NULL, '', NULL),
(14204, 'garnitura-nokia-wh-701', 1, NULL, 42, 933, '', 1369857600, 1369942105, 0.00, 8, NULL, NULL, NULL, 1, NULL, '', NULL),
(14205, 'garnitura-nokia-wh-205-stereo', 1, NULL, 42, 933, '', 1369857600, 1369941669, NULL, 6, NULL, NULL, NULL, 1, NULL, '', NULL),
(14206, 'garnitura-htc-rc-e190-black', 1, NULL, 112, 933, '', 1369857600, 1369941982, NULL, 6, NULL, NULL, NULL, 1, NULL, '', NULL),
(16825, 'naushniki-ergo-vd-290-white', 1, NULL, 154, 942, NULL, 1373276911, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(14775, 'gps-pioneer-e-800', 1, NULL, 154, 942, '', 1370721600, 1373278480, 0.00, 9, NULL, NULL, NULL, 1, NULL, '', NULL),
(16826, 'naushniki-ergo-vd-390-gold', 1, NULL, 154, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16827, 'naushniki-ergo-vd-390-grey', 1, NULL, 154, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16828, 'naushniki-ergo-vd-390-red', 1, NULL, 154, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16829, 'garnitura-vnutrikanalnogo-tipa-ergo-vm-901-black', 1, NULL, 154, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16830, 'multimediinaia-garnitura-ergo-vm-280-black', 1, NULL, 154, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16831, 'multimediinaia-garnitura-ergo-vm-280-green', 1, NULL, 154, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16832, 'nabor-zapasnyh-nakladnyh-ambushiur-koss-porta-sporta-pro6-sht', 1, NULL, 168, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16833, 'naushniki-sennheiser-ie-8i', 1, NULL, 272, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16834, 'naushniki-ergo-ear-vt11', 1, NULL, 154, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16835, 'naushniki-ergo-ear-vt12', 1, NULL, 154, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16836, 'naushniki-jvc-ha-s200-b', 1, NULL, 273, 942, NULL, 1373276912, 1373278480, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_i18n`
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
-- Dumping data for table `shop_products_i18n`
--

INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1019, 'ru', 'HTC One SV White ', 'HTC One SV c легкостью справится с твоим напряженным графиком благодаря сверхбыстрому двухъядерному процессору с частотой 1,2&nbsp;ГГц. Камера нового поколения, чистейший звук и элегантный дизайн&nbsp;— практичный телефон для такого требовательного пользователя, как Вы<br>  ', '<table><tbody><tr><td colspan="2"><h2></h2><hr></td></tr><tr><td>Форм-фактор телефона</td><td>Моноблок</td></tr><tr><td>Процессор</td><td>Qualcomm Snapdragon S4 (1.2 ГГц)</td></tr><tr><td>Размеры</td><td>128 x 66.9 x 9.2 мм&nbsp;<br>122 г</td></tr><tr><td>Поддержка нескольких СИМ-карт</td><td>Нет</td></tr><tr><td>Дисплей</td><td>Сенсорный 4.3", 480x800, Super LCD-2, емкостный<br>Стекло Corning Gorilla Glass 2</td></tr><tr><td>Сигналы вызова</td><td>Полифонические мелодии<br>МP3 звонок<br>Виброзвонок</td></tr><tr><td>Камера</td><td>5 Мп, автофокус, LED-подсветка, датчик BSI<br>28 мм объектив, светосила f/2.0<br>Запись видео FullHD 1080p<br>1.6 Мп фронтальная камера</td></tr><tr><td>Стандарт</td><td>GSM 850 / 900 / 1800 / 1900 МГц&nbsp;<br>HSDPA 900 / 1900 / 2100 МГц<br>LTE 800 / 1800 / 2600 МГц</td></tr><tr><td>Размеры СИМ-карты</td><td>Микро-СИМ</td></tr><tr><td>Функции памяти</td><td>ОЗУ: 1 ГБ<br>ПЗУ: 8 ГБ<br>Поддержка карт памяти microSD (до 32 ГБ)</td></tr><tr><td>Органайзер</td><td>Закладки, Калькулятор, Календарь, Часы, Контакты, Акции, Погода и другие</td></tr><tr><td>Развлечения</td><td>Медиаплеер<br>Поддерживаемые форматы аудио:.aac, .amr, .ogg, .m4a, .mid, .mp3, .wav, .wma<br>Поддерживаемые форматы видео: .3gp, .3g2, .mp4, .wmv (Windows Media Video 9), .avi (MP4 ASP и MP3)<br>Игры<br>Социальные сети</td></tr><tr><td>Работа с сообщениями</td><td>SMS, MMS, Email, Push Email</td></tr><tr><td>Интернет</td><td>GPRS<br>EDGE<br>3G: HSDPA 42 Мбит/с; HSUPA 5.76 Мбит/с</td></tr><tr><td>Беспроводные технологии</td><td>Wi-Fi 802.11 a/b/g/n<br>Bluetooth 4.0<br>DLNA&nbsp;<br>GPS (поддержка A-GPS и GLONASS)</td></tr><tr><td>Питание</td><td>Литий-ионный аккумулятор, 1800 мАч</td></tr><tr><td>Операционная система</td><td>Android</td></tr><tr><td>Комплект поставки</td><td>Смартфон HTC<br>Литий-ионный аккумулятор<br>Зарядное устройство<br>Руководство пользователя</td></tr><tr><td>Цвет</td><td>White</td></tr><tr><td><br></td><td><br><br></td></tr></tbody></table>    ', NULL, NULL, NULL),
(937, 'ru', '3D LED телевизор Samsung UE65ES8007UXUA', '<div>Диагональ экрана: 65"&nbsp;</div><div>Разрешение: 1920x1080&nbsp;</div><div>Угол обзора: 178°/178°&nbsp;</div><div>Габариты (ШxВxГ): 148x87.7x3.3 см&nbsp;</div><div>Цвет: черный</div>  ', '<div>Slim LED телевизор Samsung ES8007 - это окно в мир будущего телевидения у вас дома.</div> <p>Уже сегодня вы можете оценить, как телевизоры серии Smart TV управляются с помощью голоса, жестов, узнают пользователя по его фотоснимку; кроме того, вы сможете познакомиться с такими интеллектуальными функциями Функция Smart Content, как Family Story и AllShare, которая позволяет обеспечить возможность просмотра контента на телевизоре с любого мобильного устройства (смартфона, ноутбука и планшета). С помощью функции Функция Smart Evolution вы легко сможете установить программный пакет Samsung Evolution Kit, с помощью которого ваш телевизор, его прошивка , встроенное ПО и интерфейс будут раз в году обновляться и всегда оставаться актуальными. Ваш телевизор будет всегда соответствовать новейшему уровню технологического развития, пополняться новыми функциями и режимами вам не нужно будет каждый год приобретать новую модель.</p><p><strong>Серия</strong><br>Серия 8</p><p><br><strong>Звук</strong><br>3D Sound <br>Dolby Digital Plus / Dolby Pulse <br>DNSe <br>Dts 2.0+цифровой выход <br>Мощность звука 10 Вт x 2 (RMS) <br>Направлены вниз + полный диапазон <br>Авторегулировка громкости</p><p>&nbsp;<strong>Дизайн</strong><br>Металл <br>Серебристый <br>Световой эффект Deco <br>Арочная подставка <br>Тип рамки: D1&nbsp;<br><br><strong>Вес</strong><br>Вес без подставки 25.1 кг <br>Вес с подставкой 28.85 кг <br>Вес в упаковке 37.9 кг</p><p><br><strong>Smart Convenience</strong><br>Поддержка функции Personal Video Recorder <br>Поддержка функции Time Shift <br>ConnectShare™ Movie (HDD) <br>Возможность использования смартфона в качестве пульта ДУ <br>Поддержка функции BD Wise <br>Игровой режим <br>Anynet+ (HDMI-CEC) <br>Функция "Картинка-в-картинке" <br>29 европейских языков</p><p><br><strong>Smart Evolution</strong><br>Поддержка Smart Evolution</p><p><br><strong>Тип продукта</strong><br>Slim LED</p><p><br><strong>Интерфейсы</strong><br>3 HDMI <br>3 USB <br>Разъем для наушников x 1 <br>Встроенный адаптер беспроводной ЛВС <br>Встроенный адаптер беспроводной ЛВС <br>Компонентный вход (AV) x 1 (совместно используется для компонентного Y) <br>Цифровой выход (оптический) x 1 <br>Scart x 1 <br>Вход для антенны (эфирное / кабельное ТВ) x 1 <br>Вход для антенны (спутниковое ТВ) x 1 <br>DVI аудиовход (мини-джек) x 1 <br>Ethernet (LAN) x 1 <br>Поддержка MHL </p><p><br><strong>Питание</strong><br>Источник питания AC220 - 240 В 60 Гц <br>Экодатчик <br>Автоматическое выключение <br>Часы и таймер включения / выключения <br>Менее 0.5 Вт <br>Таймер перехода в спящий режим</p><p><br><strong>Аксессуары</strong><br>2 пары активных 3D-очков в комплекте <br>Пульт ДУ Smart Touch Control в комплекте <br>ИК-передатчик в комплекте <br>Пульты ДУ TM1290, TM1250B <br>Батарейки для пульта ДУ в комплекте <br>Поддержка ультратонкого крепления на стену <br>Поддержка крепления на стену Vesa <br>1 Scart <br>Кабель питания в комплекте <br>Инструкция в комплекте <br>Инструкция в электронном виде <br>Поддержка мини-крепления на стену </p><p><br><strong>Smart Convergence</strong><br>Allshare (на базе DLNA) <br>Функция AllShare Play <br>Поддержка Samsung SMART View <br>Поддержка Wi-Fi Direct</p><p><br><strong>3D</strong><br>Поддержка 3D <br>3D-конвертер <br>3D Sound </p><p><br></p><div style="text-align:left"><strong>Видео</strong></div>65 дюймов <br>Разрешение 1920 x 1080 <br>Wide Color Enhancer Plus <br>Ultra Clear Panel <br>Цифровой фильтр шумов <br>800 Clear Motion Rate <br>Micro Dimming Ultimate<br><p><br><strong>Функция Smart TV</strong><br>Поддержка Samsung Apps <br>Сервис "Семейная история" <br>Функциональность SMART TV <br>Сервис "Фитнес" <br>Функция Search All <br>Сервис "Дети" <br>Поддержка Skype™ <br>Портал Smart Hub <br>Функция Social TV <br>Веб-браузер <br>Функция Your Video</p><p><br><strong>Размеры (ШхВхГ)</strong><br>Размеры без подставки (Ш х В х Г): 1 480.5 x 877.2 x 33.1 мм <br>Размеры с подставкой (Ш х В х Г): 1 480.5 x 916 x 291 мм <br>Размеры в упаковке (Ш х В х Г): 1 630 x 1 034 x 370 мм</p><p><br><strong>Smart Content</strong><br>Двухъядерный процессор <br>Панель истории просмотров</p><p><br><strong>Smart Interaction</strong><br>Встроенная камера <br>Поддержка распознавания лиц <br>Поддержка управления жестами <br>Встроенная поддержка управления голосом <br>Поддержка управления голосом (сервер) <br>Camera App <br>Поддержка ТВ-приложений Samsung </p><p><br><strong>Tuner/Broadcasting</strong><br>DVB-T/DVB-T2/C <br>Аналоговый тюнер <br>Электронный гид по программам <br>USB-клонирование списка каналов <br>CI+ <br>Автоматический поиск каналов <br>Телетекст (1 000 страниц) <br>да (DE, AT, CH, ES, NL, BE, LU, FR) <br><br>Спецификации и цвет продукта могут меняться без предварительного уведомления.  </p>  ', NULL, NULL, NULL),
(945, 'ru', '3D LED-телевизор Philips 46PFL8008S/60', '<ul><li>3D LED-телевизор Philips 46PFL8008S/60</ul></li><li> Диагональ экрана 46</li><li> Разрешение экрана 1920x1080</li><li> Яркость 450 кд/м2, контрастность 500000:1 </li><li><i>Серебристый цвет</i></li></ul>', '<p><strong>Процессор высокой мощности</strong></p><ul>    <li>Perfect Pixel HD - удостоенная наград технология улучшения качества изображения Показатель Perfect Motion Rate (PMR) 1400 Гц для невероятной четкости изображения</li>    <li>Технология 3D Max гарантирует незабываемые впечатления от просмотра в формате 3D Full HD</li>    <li>3-сторонняя фоновая подсветка Ambilight XL для более ярких впечатлений от просмотра</li></ul><p><strong>Мир онлайн-контента в вашем распоряжении</strong></p><ul>    <li>Встроенный Skype и камера позволяют с легкостью совершать видеозвонки на телевизоре</li>    <li>Встроенный модуль Wi-Fi для удобного подключения к сети Интернет</li>    <li>Smart TV - мир онлайн-развлечений</li></ul><p><strong>Управление показом и записью на большом экране<br></strong></p><ul>    <li>Пульт ДУ с клавиатурой упрощает ввод текста</li>    <li>Wi-Fi Miracast - транслируйте изображение с устройств на экран ТВ</li>    <li>Приложение MyRemote - управляйте телевизором с помощью телефона или планшетного ПК</li>    <li>Продуманный дизайн и притягательные линии</li>    <li>Тонкая рамка из нержавеющей стали - воплощение безупречного дизайна</li></ul><p><strong>Perfect Pixel HD - удостоенная наград технология улучшения качества изображения</strong></p><p>Обеспечивает непревзойденную четкость и чистоту изображения без мерцания. Каждый пиксель изображения обрабатывается таким образом, чтобы максимально соответствовать соседним пикселям. В результате достигается уникальное сочетание характеристик: четкость, естественность в проработке деталей, яркость цветов, отличная контрастность и плавность динамичных сцен.</p><p><strong>Показатель Perfect Motion Rate (PMR) 1400 Гц для невероятной четкости изображения</strong></p><p>Для измерения плавности, естественности и точности движения на телеэкране в Philips разработали собственный стандарт четкости отображения динамичных сцен - PMR. Perfect Motion Rate - это суммарный показатель, учитывающий нашу уникальную обработку видеосигнала, количество кадров в секунду и частоту обновления каждого кадра, качество затемнения и технологию подсветки. Чем выше показатель PMR, тем выше контрастность и четкость динамичных сцен, а значит, тем лучше качество изображения в целом.</p><p><strong>Технология 3D Max гарантирует незабываемые впечатления от просмотра в формате 3D Full HD</strong></p><p>Активная 3D-технология и быстрая смена кадров обеспечивают непревзойденную реалистичность, глубину и контрастность 3D-изображения. Регулируя глубину 3D, можно выбрать оптимальный для ваших глаз эффект объемного изображения. 2D-контент можно преобразовать в естественное и стабильное 3D-изображение. Все преимущества трехмерного изображения.</p><p><strong>3-сторонняя фоновая подсветка Ambilight XL для более ярких впечатлений от просмотра</strong></p><p>Благодаря этой запатентованной технологии Philips на стену за телевизором по трем сторонам проецируется увеличенный световой шлейф — в результате чего телеэкран кажется больше, а впечатления от просмотра ярче. Цвет подсветки автоматически меняется в соответствии с изображением на экране. Благодаря адаптивной функции цвет фоновой подсветки всегда точно соответствует изображению — вне зависимости от цвета стены. Параметры подсветки можно менять по вашему вкусу.</p><p><strong>Встроенный Skype и камера позволяют с легкостью совершать видеозвонки на телевизоре</strong></p><p>Расширьте границы телефонной связи и общайтесь с близкими вам людьми, где бы они ни находились. Благодаря поддержке Skype и встроенной камере в вашем телевизоре вы сможете совершать голосовые и видеозвонки прямо из своей гостиной. Наслаждайтесь превосходным качеством видео и звука, не вставая с дивана.</p><p><strong>Встроенный модуль Wi-Fi для удобного подключения к сети Интернет</strong></p><p>Встроенный модуль Wi-Fi телевизора Philips Smart TV обеспечивает быстрое и простое подключение к домашней сети, позволяя получить доступ к различному контенту и выполнять потоковую передачу в беспроводном режиме.</p><p><strong>Smart TV - мир онлайн-развлечений</strong></p><p>Получите от своего телевизора больше, чем могут дать традиционные модели. Пользуйтесь прокатом фильмов и включайте потоковую передачу кино, видеороликов, игр и других материалов непосредственно на телевизор из онлайн-магазинов. Смотрите передачи вслед за эфиром и пользуйтесь разнообразными онлайн-приложениями Smart TV. Общайтесь с родными и друзьями по Skype™ или в социальных сетях. Больше того... на телевизоре можно даже просматривать веб-сайты!</p><p><strong>Пульт ДУ с клавиатурой упрощает ввод текста</strong></p><p>Простое управление. Пульт ДУ оснащен всеми привычными, интуитивно понятными кнопками навигации, быстрого доступа и регулировки громкости. Переверните пульт, чтобы получить доступ к полноформатной клавиатуре для удобного ввода текста в любой ситуации. Пульт оснащен гироскопическими датчиками, благодаря которым неактивная сторона пульта блокируется, а значит при вводе текста случайное переключение канала невозможно.</p><p><strong>Wi-Fi Miracast - транслируйте изображение с устройств на экран ТВ</strong></p><p>Смотрите, что хотите, когда хотите и где хотите. Передавайте разнообразный контент со своих устройств на большой экран. Можно, например, посмотреть на телевизоре фотографии со смартфона или ноутбука. Технология позволяет легко и быстро настроить подключение самых разных устройств.</p><p><strong>Приложение MyRemote - управляйте телевизором с помощью телефона или планшетного ПК</strong></p><p>С легкостью управляйте телевизором и выполняйте запись без использования пульта ДУ с помощью одного удобного приложения. Превратите ваш iPad или смартфон в универсальный пульт ДУ. Помимо привычных элементов управления, вы сможете воспользоваться дополнительными функциями, такими как ввод текста. Благодаря функции SimplyShare контент можно передать на экран ТВ. Выполняйте передачу программ цифрового телевещания на устройства с помощью Wi-Fi Smart Screen. Приложение MyRemote позволит вам всегда быть в курсе событий с помощью функции записи программ. Просто пролистайте гид телепередач и выберите программы, которые необходимо записать, чтобы просмотреть позже. Телевизор Smart TV заслуживает по-настоящему умного приложения!</p><p><strong>Тонкая рамка из нержавеющей стали - воплощение безупречного дизайна</strong></p><p>За хорошим дизайном обычно стоит история. Взять, к примеру, безукоризненную переднюю черную панель из нержавеющей стали с монолитной глянцевой поверхностью. Или сверхтонкую рамку, которая придает более изящный вид всей конструкции. Все это говорит о высоком качестве и надежности наших продуктов - как снаружи, так и внутри.</p>', NULL, NULL, NULL),
(949, 'ru', '3D LED-телевизор Philips 47PFL7008S/12', '<ul><li>3D LED-телевизор Philips 47PFL7008S/12</ul></li><li> Диагональ экрана 47</li><li> Разрешение экрана 1920x1080</li><li> Яркость 400 кд/м2, контрастность 500 000:1</li><li><i>Серебристый цвет</i></li></ul>', '<p><strong>Встроенный Skype и камера позволяют с легкостью совершать видеозвонки на телевизоре</strong></p><p>Расширьте границы телефонной связи и общайтесь с близкими вам людьми, где бы они ни находились. Благодаря поддержке Skype и встроенной камере в вашем телевизоре вы сможете совершать голосовые и видеозвонки прямо из своей гостиной. Наслаждайтесь превосходным качеством видео и звука, не вставая с дивана.</p><p><strong>Встроенный модуль Wi-Fi для удобного подключения к сети Интернет</strong></p><p>Встроенный модуль Wi-Fi телевизора Philips Smart TV обеспечивает быстрое и простое подключение к домашней сети, позволяя получить доступ к различному контенту и выполнять потоковую передачу в беспроводном режиме.</p><p><strong>Smart TV - мир онлайн-развлечений</strong></p><p>Получите от своего телевизора больше, чем могут дать традиционные модели. Пользуйтесь прокатом фильмов и включайте потоковую передачу кино, видеороликов, игр и других материалов непосредственно на телевизор из онлайн-магазинов. Смотрите передачи вслед за эфиром и пользуйтесь разнообразными онлайн-приложениями Smart TV. Общайтесь с родными и друзьями по Skype или в социальных сетях. Больше того... на телевизоре можно даже просматривать веб-сайты!</p><p><strong>Пульт ДУ с клавиатурой упрощает ввод текста</strong></p><p>Простое управление. Пульт ДУ оснащен всеми привычными, интуитивно понятными кнопками навигации, быстрого доступа и регулировки громкости. Переверните пульт, чтобы получить доступ к полноформатной клавиатуре для удобного ввода текста в любой ситуации. Пульт оснащен гироскопическими датчиками, благодаря которым неактивная сторона пульта блокируется, а значит при вводе текста случайное переключение канала невозможно.</p><p><strong>Приложение MyRemote - управляйте телевизором с помощью телефона или планшетного ПК</strong></p><p>С легкостью управляйте телевизором и выполняйте запись без использования пульта ДУ с помощью одного удобного приложения. Превратите ваш iPad или смартфон в универсальный пульт ДУ. Помимо привычных элементов управления, вы сможете воспользоваться дополнительными функциями, такими как ввод текста. Благодаря функции SimplyShare контент можно передать на экран ТВ. Выполняйте передачу программ цифрового телевещания на устройства с помощью Wi-Fi Smart Screen. Приложение MyRemote позволит вам всегда быть в курсе событий с помощью функции записи программ. Просто пролистайте гид телепередач и выберите программы, которые необходимо записать, чтобы просмотреть позже. Телевизор Smart TV заслуживает по-настоящему умного приложения!</p><p><strong>Wi-Fi Miracast - транслируйте изображение с устройств на экран ТВ</strong></p><p>Смотрите, что хотите, когда хотите и где хотите. Передавайте разнообразный контент со своих устройств на большой экран. Можно, например, посмотреть на телевизоре фотографии со смартфона или ноутбука. Технология позволяет легко и быстро настроить подключение самых разных устройств.</p><p><strong>3-сторонняя фоновая подсветка Ambilight XL для более ярких впечатлений от просмотра</strong></p><p>Благодаря этой запатентованной технологии Philips на стену за телевизором по трем сторонам проецируется увеличенный световой шлейф — в результате чего телеэкран кажется больше, а впечатления от просмотра ярче. Цвет подсветки автоматически меняется в соответствии с изображением на экране. Благодаря адаптивной функции цвет фоновой подсветки всегда точно соответствует изображению — вне зависимости от цвета стены. Параметры подсветки можно менять по вашему вкусу.</p><p><strong>Очки Easy 3D для комфортного просмотра контента в формате 3D</strong></p><p>Пассивная 3D-технология обеспечивает высокое качество изображения без мерцания и раздвоения, что позволяет долго и с удовольствием смотреть фильмы и передачи в 3D. Любой контент 2D можно преобразовать в естественное и стабильное 3D-изображение. Стильные и легкие 3D-очки без батарей невероятно комфортны.</p><p><strong>Показатель Perfect Motion Rate (PMR) 700 Гц для невероятной четкости динамичных сцен</strong></p><p>Для измерения плавности, естественности и точности движения на телеэкране в Philips разработали собственный стандарт четкости отображения динамичных сцен - PMR. Perfect Motion Rate - это суммарный показатель, учитывающий нашу уникальную обработку видеосигнала, количество кадров в секунду и частоту обновления каждого кадра, качество затемнения и технологию подсветки. Чем выше показатель PMR, тем выше контрастность и четкость динамичных сцен, а значит, тем лучше качество изображения в целом.</p><p><strong>Технология Pixel Precise HD для дополнительной четкости деталей в динамичных сценах</strong></p><p>Благодаря нашей передовой технологии Pixel Plus нам удалось поднять качество изображения высокой четкости на новую высоту. Технология Super Resolution с 4 триллионами цветов гарантирует лучшее качество телеизображения Full HD независимо от типа контента. Будь то онлайн-видеоигра или фильм высокого качества Blu-ray - удовольствие от просмотра вам гарантировано.</p><p><strong>Безрамочный дизайн придает утонченный вид</strong></p><p>Изящный и лаконичный дизайн. Панель выполнена из цельного высококачественного стекла, края которого обрамляет ультратонкая металлическая оправа. Устройство идеально впишется в любой интерьер.</p>', NULL, NULL, NULL),
(955, 'ru', '3D LED-телевизор Samsung UE32F6100AKXUA', '<ul><li>3D LED-телевизор Samsung UE32F6100AKXUA</ul></li><li> Диагональ экрана 32</li><li> Разрешение экрана 1920x1080</li><li> Контрастность Mega DCR</li><li><i>Черный цвет</i></li></ul>', '<p><strong>3D в совершенно новом свете</strong></p><p>С помощью новейших 3D-технологий визуализации, вы будете полностью погружены в новом мире reality-просмотра</p><p><strong>Откройте для себя новую реальность в Full HD</strong></p><p>Наслаждайтесь более высоким уровенем реализма дома, чем когда-либо прежде. Благодаря разрешению вдвое выше, чем у стандартных HD телевизоров, ваш телевизор Samsung обеспечивает захватывающие впечатления от просмотра, который переносят вас за пределы экрана в мир полного погружения. Когда вы увидете богатые и яркие текстуры HD, ваши любимые телевизионные программы и фильмы никогда не будет прежним. Откройте для себя новую реальность</p><p><strong>Более яркие цвета для улучшения качества снимков</strong></p><p>Samsung Wide Colour Enhancer Plus значительно улучшает качество любого изображения и раскрывает скрытые детали</p>', NULL, NULL, NULL),
(956, 'ru', '3D LED-телевизор Samsung UE32F6400AKXUA', '<ul><li>3D LED-телевизор Samsung UE32F6400AKXUA</ul></li><li> Диагональ экрана 32</li><li> Разрешение экрана 1920x1080</li><li> Контрастность Mega Contrast</li><li><i>Серебристый цвет</i></li></ul>', '<p>Телевизор Samsung LED TV серии 6 вводят вас в удивительный мир развлечений, доступных не сервисе Smart Hub. Сервис Smart Hub собрал в одном месте самый лучший контент, доступ к которому исключительно прост и удобен. Вы просто листаете страницы этой огромной библиотеки как страницы книги. Это действительно море интерактивного контента, который вы можете выбрать с экрана вашего телевизора.<br><br><strong>Smart телевизор, который вас понимает</strong><br>Спросите свой Smart телевизор, что бы вы хотели посмотреть. Теперь поиск новинок стал как никогда прост и удобен. <br><br><strong>Окно в фантастический мир ощущений от развлечений</strong><br>Попробуйте воспользоваться отличной возможностью выбрать фильм или приложение с помощью интуитивно-простого интерфейса портала Smart Hub <br><br><strong>Смотрите ваши дорогие сердцу фотоснимки на экране телевизора в высочайшем качества</strong><br>Новый Samsung Smart телевизор - это еще больше незабываемых впечатлений от просмотра любого контента.<br><br><strong>Smart телевизор, который вас понимает</strong><br>Теперь вы можете больше времени потратить на просмотр, а не на поиск интересных программ и фильмов путем просмотра содержания бесчисленного множества каналов. Функция голосового управления (Voice Interaction) понимает естественный язык и вы теперь можете просто задать вопрос телевизору, а он порекомендует вам ТВ шоу и фильмы, учитывая ваши интересы. Со временем, функция S Recommendation сможет более точно учитывать ваши пожелания, поскольку накопит больше информации о ваших предпочтениях. Будьте уверены, что каждое предложение вам посмотреть тот или иной фильм или шоу не будет повторяться снова и снова. Все так легко и просто!</p><p><strong>Окно в фантастический мир ощущений от развлечений<br></strong>Samsung меняет идеологию просмотра телевизионных передач с помощью обновленной версии сервиса Smart Hub. Благодаря 5 новым и простым в использовании панелям и интуитивному интерфейсу серфинга по страницам Smart Hub вы легко и быстро сможете найти нужный контент. Теперь вам не нужно изучать содержание множества каналов, чтобы найти интересующий вас контент, а просто воспользуйтесь рекомендациями вашего телевизора и наслаждайтесь просмотром любимых программ или фильмов. Оцените широкий выбор фильмов и ТВ шоу, предлагаемый функцией Видео по запросу, огромное количество приложений, доступных на вашем телевизоре Samsung Smart TV, а также отличную возможность поделиться контентом на Facebook и Twitter с вашими друзьями и близкими. Оцените удобный доступ к фотоснимкам, видеоклипам и музыке, хранящихся на совместимых с телевизором мобильных устройствах. Все это можно посмотреть и послушать через ваш телевизор.<br><br><strong>Панель On TV</strong><br><strong>Выбор, основанный на ваших предпочтениях</strong><br>Как только вы включите телевизор, на панели ON TV появится список рекомендованных вам ТВ программ, составленный с учетом ваших предпочтений и того, чтоы вы смотрели в последнее время. Эта полезная функция существенно облегчает общение с телевизором; вам не нужно тратить время на поиск интересных программ на десятках каналов.<br><strong><br>Смотрите ваши дорогие сердцу фотоснимки на экране телевизора в высочайшем качества</strong><br>Оцените новый, более высокий уровень качества изображения на новом Smart телевизоре Samsung. Технология Samsung†s Clear Motion Rate позволяет создавать четкое динамичное изображение за счет использования трех технологических компонентов: нового чипсета, улучшенной ТВ панели и обратной подсветки экрана. Эта новая система управления воспроизведением динамичных сцен обеспечивает исключительно четкое изображение благодаря использованию обратной подсветки ТВ панели. А такие функции, как Wide Colour Enhancer Plus и Full HD разработаны специально для улучшения качества передачи цвета и любого изобржаения с максимальной стеенью детализации, невидимых на телевизорах предшествующих моделей.</p><p>Стильный дизайн гармонирует с новым более высоким уровнем визуальных ощущений Испытайте новые ощущения и приобщите к ним своих близких. Тонкий LED телевизор серии 6 разработан для того, чтобы зрители испытали невиданные до сих пор визуальные ощущения. Концепция One Design позволяет превратить телевизор в предмет декора интерьера, тонкая рамка расширяет визуальное пространство, и изображение на экране ощущается как реальность. Новый телевизор органично вписывается в окружающее пространство и ничто не отвлекает Вас от погружения в виртуальную реальность. Оцените по достоинству концепцию дизайна One Design.<br>Изображение продукта является чисто репрeзентативным. Фактические цвета и дизайн подставки могут меняться в зависимости от региона продаж.<br><strong><br>Широкие возможности для подключений</strong><br>LED Телевизоры Samsung серии 6 обеспечат Вам беспроводной доступ в Интернет и загрузку потокового контента с любого устройства, например, с планшета. Кроме того, Вы можете вставить USB накопитель или жесткий диск в разъем USB и смотреть на экране телевизора свои любимые фильмы, фотоснимки и слушать музыку. Наконец, с помощью встроенной поддержки Wi-Fi, Вы можете расширить возможности подключения вашего телевизора к другим устройствам без использования дополнительного оборудования.</p>', NULL, NULL, NULL),
(957, 'ru', '3D LED-телевизор Samsung UE32F6330AKXUA', '<ul><li>3D LED-телевизор Samsung UE32F6330AKXUA</ul></li><li> Диагональ экрана 32</li><li> Разрешение экрана 1920x1080</li><li> Контрастность Mega</li><li><i>Черный цвет</i></li></ul>', '<p><strong>3D в совершенно новом свете</strong></p><p>С помощью новейших 3D-технологий визуализации, вы будете полностью погружены в новом мире reality-просмотра</p><p><strong>Откройте для себя новую реальность в Full HD</strong></p><p>Наслаждайтесь более высоким уровенем реализма дома, чем когда-либо прежде. Благодаря разрешению вдвое выше, чем у стандартных HD телевизоров, ваш телевизор Samsung обеспечивает захватывающие впечатления от просмотра, который переносят вас за пределы экрана в мир полного погружения. Когда вы увидете богатые и яркие текстуры HD, ваши любимые телевизионные программы и фильмы никогда не будет прежним. Откройте для себя новую реальность</p><p><strong>Более яркие цвета для улучшения качества изображения</strong></p><p>Samsung Wide Colour Enhancer Plus значительно улучшает качество любого изображения и раскрывает скрытые детали</p><p><strong>Всегда готов поделиться контентом с другими устройствами</strong></p><p>С помощью функции Samsung AllShare Вы всегда сможете подключить телевизор к другим совместимым устройствам. Функция AllShare позволит Вам загрузить на экран телевизора фотоснимки, видео и музыку с Вашего смартфона, планшета, ноутбука и фото-видеокамеры. Наслаждайтесь своим контентом на большом экране Smart телевизора</p><p><strong>Ощутите новую реальность в формате Full HD</strong></p><p>Оцените новый уровень реалистичности происходящего на экране в системе домашних развлечений. Благодаря двукратному увеличению разрешения по сравнению с обычными HD телевизорами, Ваш телевизор Samsung Smart TV позволит испытать новые ощущения от погружения в мир виртуальной реальности и почувствовать себя участником событий, происходящих на экране. После первых минут просмотра изображения в формате Full HD Вы не захотите смотреть Ваши любимые ТВ программы и фильмы в обычном стандартном разрешении. Откройте для себя всю прелесть виртуальной реальности в формате высокой четкости (HD формате)</p><p><strong>Смотрите спортивные программы в лучшем качестве</strong></p><p>Смотреть спортивные передачи на телевизоре Samsung не просто очень комфортно, но это еще и большое удовольствие благодаря высочайшему качеству изображения. Режим Sports Mode позволяет включать совершенно фантастические функции, которые можно активировать одновременно. Настройте качество изображения и звука на максимум и наслаждайтесь любимыми спортивными программами. Качество звука при этом настолько высоко, что в Вашей комнате создается атмосфера настоящего огромного стадиона</p><p><strong>Телевизор, который может стать украшением любого интерьера</strong></p><p>Дизайн телевизора Samsung разработан с учетом того, что телевизор может стать украшением любого интерьера. В LED телевизоре с дизайном типа «One Design» удачно сочетается узкая рамка с яркой и великолепной панелью, благодаря чему изображение кажется просто окном в другой мир</p>', NULL, NULL, NULL);
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(959, 'ru', 'MP3 / MP4-плеера TEXET T-930HD 8Gb', 'Новый МП3-плеер TEXET T-930HD 8Gb сочетает в себе максимум возможностей современного медиаустройства и сдержанный стиль. Новая модель воплощена в тонком, горизонтально ориентированном корпусе из металла, обрамленном темно-серой рамкой, которая отлично защищает плеер. Большая часть лицевой панели – это отзывчивый 5-дюймовый сенсорный дисплей с разрешением 800х480 пикселей. Тыльная сторона оборудована мощным встроенным динамиком, а правый торец оснащен слотом для microSD/SDHC карт, USB-разъемом, и выходами для наушников и ТВ.  ', '<em>&nbsp;</em> TEXET    T-930HD являет собой современный медиаплеер, способный воспроизводить множество аудио, видео, графических и текстовых форматов. Таким образом, его можно использовать как аудиоплеер, видеоплеер или электронную книгу. Для удобного просмотра фильмов, фотографий или чтения, TEXET   T-930HD оснастили большим 5-дюймовым сенсорным дисплеем, с разрешением 800х480 точек. Интересен тот факт, что плеер может воспроизводить видео в FullHD качестве и поддерживает субтитры. Для вывода изображения на экран телевизора предусмотрен ТВ-выход. Также, интересной особенностью медиаплеера TEXET  T-930HD является возможность подключения внешних накопителей, с помощью комплектного OTG-кабеля. При недостатке встроенной памяти можно использовать карты памяти microSD. Отметим также наличие игр, словаря, радиоприемника, диктофона и встроенного динамика.<div><br>   <div>Ещё&nbsp;информация&nbsp;о&nbsp;<em>MP3 / MP4-плеере</em><em>&nbsp;</em><em>TEXET </em><em>T-930HD 8Gb </em>  <br><table><tbody><tr><td>Диктофон</td><td>есть</td></tr><tr><td>Память</td><td>8 Gb</td></tr><tr><td>Тип носителя</td><td>Flash</td></tr><tr><td>Дисплей</td><td>Полноцветный сенсорный 5” TFT дисплей, 800х480 пикселей</td></tr><tr><td>Поддержка Video</td><td>да</td></tr><tr><td>Поддерживаемые типы файлов</td><td><strong>Аудио:</strong> MP3, WMA, FLAC, AAC, APE, OGG, WAV;&nbsp;<br><strong>Видео:</strong> MKV, MPG, VOB, AVI, TS/TP, M2TS, MOV, RM/RMVB, FLV, MP4/M4V, PMP, WMV <strong>Фото:</strong> JPEG, BMP, GIF/ANIGIF, PNG;<br><strong>Электронные книги:</strong> FB2, EPUB, RTF, TXT, PDF, PDB, MOBI, HTML</td></tr><tr><td>Питание</td><td>литий-полимерный аккумулятор</td></tr><tr><td>Размер, мм</td><td>128x84x13 мм</td></tr><tr><td>Комплектация</td><td>- Медиаплеер - Руководство по эксплуатации - USB-кабель - ТВ-кабель - OTG-кабель - Наушники - Гарантийный талон</td></tr></tbody></table>  <br></div>  </div>  ', NULL, NULL, NULL),
(1006, 'ru', '    MP3 / MP4-плеер Apple iPod touch 5G 32GB black', 'Apple iPod touch 5G 32GB black — новый сенсорный iPod, который отличается стильным дизайном и малым весом. Этот iPod Touch оснащен двухъядерным процессором Apple A5, который обеспечивает быструю обработку графики и многозадачность   ', '<div style="text-align:justify">Плеер отличается 4-дюймовым Retina дисплеем с разрешением 1136 x 640 пикселей, он идеально подходит для просмотра фильмов HD и мультимедийных развлечений. Появился в iPod новый штекер для подключения кабеля питания под названием Lightning. Новый разъем на 80 % меньше универсального разъема, он является цифровым. Кроме того, он симметричен — пользователю не придется переворачивать его, чтобы поместить в гнездо. Если вы находитесь в зоне действия беспроводной сети, iPod Touch мгновенно распознаёт её. Если это бесплатная сеть Wi-Fi, вы можете сразу заходить в Интернет. Запускайте любую программу, поддерживающую Wi–Fi, — например, Safari или iTunes — и путешествуйте по Сети. Некоторые беспроводные сети требуют ввести пароль, но с iPod Touch это не проблема. Просто введите пароль, и iPod Touch запомнит его. В следующий раз, когда вы окажетесь в зоне действия этой сети, он подключится к ней автоматически. Что отличает Apple iPod touch 5G 32GB black от обычных портативных игровых устройств — это интерфейс Multi-Touch. С ним вы не просто играете в игру — вы взаимодействуете с игрой. Управляйте скейтбордом поворотом пальцев. Проверьте свою реакцию, отбивая ритм песни. Вы даже можете превратить свой iPod Touch в музыкальный инструмент — например, ударную установку или гитару. И всё это благодаря потрясающей технологии Multi-Touch.  <br><br><br></div><div style="text-align:justify"><br>  </div>  ', NULL, NULL, NULL),
(1015, 'ru', 'MP3 / MP4-плеер Apple iPod touch 4 Gen 8 GB', 'Теперь, с новым усовершенствованным Apple iPod touch 4 Gen 8 GB, ваша любимая музыка, фильмы, игры и многое другое умещаются у вас на ладони. iPod Touch работает до 40 часов в режиме воспроизведения аудио – вся ваша любимая музыка всегда будет с вами.  ', '<div style="text-align:justify">Новое поколение iPod Touch почти на 50% быстрее, чем предыдущее. Если вы находитесь в зоне действия беспроводной сети, плеер мгновенно распознаёт её. Если это бесплатная сеть Wi-Fi, вы можете сразу заходить в Интернет. Запускайте любую программу, поддерживающую Wi-Fi, – например, Safari или iTunes – и путешествуйте по Сети. Safari – инновационный интернет-браузер для компьютеров Mac и PC – также установлен на данной модели. Просто подключитесь к беспроводной сети и пользуйтесь Safari почти так же, как и интернет-браузером на компьютере. Электронная почта выглядит и работает точно так же, как на компьютере. Сообщения можно просматривать в формате HTML, включая вложения. Программа Mail распознаёт такие типы файлов как DOC, JPG, MP3 и многие другие. А настроить Mail очень легко, так как плеер автоматически вводит настройки для учётных записей популярных служб Google Mail, MobileMe, Yahoo!, AOL и Microsoft Exchange. С приложением Карты вы всегда знаете, где вы находитесь и в какую сторону идёте. Если вы подключены к беспроводной сети, вы всегда можете определить своё местоположение и получить подробные пошаговые маршруты. Устройство обладает повышенной производительностью и поддерживает OpenGL ES версии 2.0. Благодаря этому разработчики могут создавать игры с превосходной графикой. Игры для iPod Touch созданы с учётом всех преимуществ его встроенных технологий: Multi-Touch, Wi-Fi и Bluetooth.  </div><div style="text-align:justify"><table><tbody><tr><td>Причина уценки</td><td>Уценка. Изделие было в использовании. Остались следы эксплуатации: потертости на корпусе и экране.</td></tr><tr><td>FM-тюнер</td><td>нет</td></tr><tr><td>Диктофон</td><td>есть</td></tr><tr><td>Память</td><td>8 Gb</td></tr><tr><td>Тип носителя</td><td>Flash</td></tr><tr><td>Дисплей</td><td>Широкоформатный дисплей Multi-Touch с диагональю 3,5 дюйма. Разрешение 960 x 640 пикселей (326 пикселей/ дюйм)</td></tr><tr><td>Поддержка Video</td><td>да</td></tr><tr><td>Поддерживаемые типы файлов</td><td>AAC, защищённый AAC, HE-AAC, MP3, MP3 VBR, Audible, Apple Lossless, AIFF, WAV, H.264, M4V, MP4, MOV, MPEG-4, M-JPEG</td></tr><tr><td>Питание</td><td>Встроенный литий-ионный аккумулятор. Время воспроизведения музыки: до 40 часов при полной зарядке. Время воспроизведения видео: до 7 часов при полной зарядке. Быстрая зарядка приблизительно за 2 часа (80% ёмкости)</td></tr><tr><td>Размер, мм</td><td>111,0 х 58,9 х 7,2</td></tr><tr><td>Вес, гр</td><td>101</td></tr><tr><td>Комплектация</td><td>Плеер iPod touch<br>Наушники<br>Кабель для подключения док-станции к порту USB<br>Руководство по началу работы<br>Гарантийный талон</td></tr></tbody></table>  <br></div>  ', NULL, NULL, NULL),
(1018, 'ru', 'MP3 / MP4-плеер TEXET T-979HD 4GB', '<span style="text-align:justify">Современные тенденции мира мобильных устройств сосредоточены в стремлении производителей объединить в компактном устройстве расширенный мультимедийный функционал. Компания «Электронные системы «Алкотел», являясь лидером цифровой техники, представляет новую модель – медиаплеер TEXET T-979HD 4GB, который отвечает всем требованиям рынка и обладает лучшей ценой в своем сегменте.</span>  ', 'Плеер оснащен большим 4,3-дюймовым сенсорным экраном разрешения 480×272 пикселей, что позволило отказаться от механических кнопок, за исключением слайдера включения/выключения питания. Еще одним достоинством новой модели медиаплеера teXet является поддержка FullHD видео с разрешением 1080p в форматах MKV, MPG, VOB, AVI, TS, M2TS, MOV, RM/RMVB, FLV, MP4, PMP, а также субтитров (ASS, SSA,SUB, SRT). Плеер оборудован разъемом 3.5 мм для наушников и встроенным громким динамиком, а благодаря большому качественному дисплею просматривать видеоконтент будет комфортно в путешествиях и поездках. Плеер можно использовать не только как портативный FullHD медиаплеер, но и как стационарный видеопроигрыватель, так как реализована функция вывода видео на внешний экран при помощи композитного ТВ-кабеля.<br>Новый медиаплеер отлично справляется с задачами ридера. И это не удивительно, так как устройство оснащено таким же процессором, что и самые современные устройства для чтения электронных книг. Кроме поддержки распространенных текстовых форматов (FB2, EPUB, TXT, PDF, PDB, RTF, HTML), в новинке реализованы функции сохранения закладок в тексте, изменения цвета и размера шрифта, выбора фона, поворота текста на 90, 180 и 270 градусов, а также назначения временного интервала перехода к следующей странице.<br>Данная модель воспроизводит все популярные аудиоформаты: MP3, WMA, FLAC, AAC, APE, OGG, WAV. Новинка выдает чистый звук, для любителей спецэффектов есть девять настроек эквалайзера, а также поддержка текста песен и ID3-тегов. Пользователю доступно FM-радио с ручным и автоматическим поиском радиостанций (плеер сохранит найденные волны по всему частотному диапазону) и диктофон с записью в формате MP3. По многочисленным пожеланиям пользователей в новой модели медиаплеера реализована функция выбора заставки рабочего стола из галереи. Плеер «читает» широкий спектр форматов изображения (JPEG, BMP, GIF/ANIGIF, PNG).&nbsp;<br>Устройство имеет компактные размеры (113×76×12 мм) и скромный вес (117,5 г), а благодаря слоту для карт microSD/SDHC объемом до 32 ГБ на борту новинки легко создать портативную медиабиблиотеку. Большой сенсорный дисплей, воспроизведение FullHD видео, функционал электронного ридера и привлекательная цена – главные преимущества нового медиаплеера teXet.&nbsp;<div><table><tbody><tr><td>FM-тюнер</td><td>есть</td></tr><tr><td>Диктофон</td><td>есть</td></tr><tr><td>Память</td><td>4 Gb</td></tr><tr><td>Тип носителя</td><td>Flash</td></tr><tr><td>Дисплей</td><td>Сенсорный 4,3” TFT дисплей, 480х272 пикселей</td></tr><tr><td>Поддержка Video</td><td>да</td></tr><tr><td>Поддерживаемые типы файлов</td><td>Воспроизведение аудио в форматах: MP3, WMA, FLAC, AAC, APE, OGG, WAV<br>Воспроизведение FullHD видео 1080p в форматах: MKV, MPG, VOB, AVI, TS, M2TS, MOV, RM/RMVB, FLV, MP4, PMP<br>Воспроизведение изображений в форматах: JPEG , BMP, GIF/ANIGIF, PNG<br>П</td></tr><tr><td>Питание</td><td>Li-Ion аккумулятор</td></tr><tr><td>Размер, мм</td><td>113x76x12</td></tr><tr><td>Вес, гр</td><td>117,5</td></tr></tbody></table>  <br></div>  ', NULL, NULL, NULL),
(1021, 'ru', 'MP3 / MP4-плеер Sony Walkman NWZ-B172 2GB black', 'Яркий и компактный музыкальный плеер Sony Walkman NWZ-B172 2GB black станет идеальным спутником меломана. Зажим нового типа обеспечивает надежную фиксацию девайса на одежде.  ', 'Плеер превосходно усиливает низкие частоты, отличается быстрой зарядкой и имеет подсветку Power Illuminator. Кроме того устройство может похвастаться наличием прямого разъема USB, функцией ZAPPIN™, а также возможностью переноса файлов с помощью WMP.<br>Мощные басы активируются всего одной кнопкой.<br>3-минутная быстрая зарядка, которой хватает на 90 минут воспроизведения.<br>Вы сможете с легкостью прикрепить свой Walkman® к карману или к сумке.   <div><table><tbody><tr><td>FM-тюнер</td><td>нет</td></tr><tr><td>Диктофон</td><td>нет</td></tr><tr><td>Память</td><td>2 Gb</td></tr><tr><td>Тип носителя</td><td>Flash</td></tr><tr><td>Дисплей</td><td>Тип экрана: Трехстрочный ЖК-экран</td></tr><tr><td>Поддержка Video</td><td>нет</td></tr><tr><td>Поддерживаемые типы файлов</td><td>mp3<br>WMA (не DRM)</td></tr><tr><td>Размер, мм</td><td>Ширина: 88,8<br>Высота: 22,5<br>Глубина: 15</td></tr><tr><td>Вес, гр</td><td>28</td></tr><tr><td>Комплектация</td><td>Плеер<br>Наушники (MDR-E804YLA)<br>Краткое руководство пользователя<br>Аккумулятор</td></tr></tbody></table>  <br></div>  ', NULL, NULL, NULL),
(1022, 'ru', 'Assistant АМ-09404 4GB', 'Компактный плеер&nbsp;<strong>Assistant АМ-09404</strong>&nbsp;имеет небольшой монохромный дисплей диагональю 1.1", для отображения меню и информации о песни и исполнителе. Благодаря емкому аккумулятору, вы сможете слушать любимые песни в течении 10 часов без дополнительной подзарядки<br><br>  ', '<div><table><tbody><tr><td>Краткие характеристики</td><td>4 ГБ / MP3, WMA, WAV, OGG / 1.1" LCD-дисплей / USB 2.0 / FM</td></tr><tr><td>Тип носителя</td><td>Флеш память</td></tr><tr><td>Объем памяти</td><td>4 ГБ</td></tr><tr><td>Поддержка форматов</td><td>MP3, WMA, WAV, OGG</td></tr><tr><td>Дисплей</td><td>LCD дисплей 1.1” двухцветный</td></tr><tr><td>FM-приемник</td><td>Есть</td></tr><tr><td>Диктофон</td><td>Есть</td></tr><tr><td>Характеристики питания</td><td>Аккумулятор: 240 мАч, проигрывание музыки – более 10 часов</td></tr><tr><td>Комплект поставки</td><td>MP3 Плеер Assistant АМ-09404, наушники, инсталяционный диск, инструкция по экспуатации, USB кабель, CD драйвер.</td></tr><tr><td>Цвет</td><td>White</td></tr></tbody></table>  <br></div>  ', NULL, NULL, NULL),
(1023, 'ru', 'Nokia Asha 302 White', 'Сочетание высококачественных материалов и эстетики делает&nbsp;Nokia Asha 302&nbsp;стоящим внимания. Сделанный из пластика, он выглядит так, будто его корпус выполнен из металла. Но речь идет не только о внешности — тщательно разработанные навигационные клавиши также обеспечивают легкую прокрутку и навигацию.<br>  ', '<div><strong><div><div><table><tbody><tr><td>Камера</td><td>3.2 Mpx</td></tr><tr><td>Диcплей</td><td>Экран 2,4"</td></tr><tr><td>Процессор</td><td>Процессор 1 Ггц</td></tr><tr><td>Поддержка карт памяти</td><td>microSD до 32 Гб</td></tr><tr><td>Беспроводные технологии</td><td>Wi-Fi, 3G, Bluetooth</td></tr></tbody></table></div><div></div></div><div><div><div><h3>Основные</h3><table><tbody><tr><td>Тип устройства</td><td>Мобильный телефон</td></tr><tr><td>Операционная система</td><td>Без ОС</td></tr><tr><td>Диагональ экрана</td><td>2.4"</td></tr><tr><td>Сенсорный экран</td><td>Нет</td></tr><tr><td>Количество SIM-карт</td><td>1 SIM</td></tr><tr><td>Формат SIM-карты</td><td>Стандартная</td></tr><tr><td>Тип корпуса</td><td>Моноблок</td></tr><tr><td>Материал корпуса</td><td>Пластик</td></tr></tbody></table><div></div></div><div><h3>Экран</h3><table><tbody><tr><td>Разрешение экрана</td><td>240x320</td></tr><tr><td>Тип экрана</td><td>TFT</td></tr><tr><td>Количество цветов</td><td>262 тысячи</td></tr></tbody></table><div></div></div><div><h3>Процессор</h3><table><tbody><tr><td>Процессор</td><td>1 ГГц</td></tr></tbody></table><div></div></div><div><h3>Камера</h3><table><tbody><tr><td>Камера</td><td>3.2 Mpx</td></tr><tr><td>Запись видео</td><td>Да</td></tr><tr><td>Фронтальная камера</td><td>Нет</td></tr></tbody></table><div></div></div><div><h3>Память</h3><table><tbody><tr><td>Внутренняя память</td><td>128 Мб</td></tr><tr><td>Оперативная память</td><td>256 Мб</td></tr><tr><td>Поддержка карт памяти</td><td>microSD до 32 Гб</td></tr></tbody></table><div></div></div></div><div><div><h3>Беспроводные технологии</h3><table><tbody><tr><td>Bluetooth</td><td>Bluetooth 2.1</td></tr><tr><td>Wi-Fi</td><td>IEEE 802.11 b/g/n</td></tr><tr><td>GPS</td><td>нет</td></tr></tbody></table><div></div></div><div><h3>Развлечения и мультимедиа</h3><table><tbody><tr><td>FM-тюнер</td><td>Есть</td></tr><tr><td>MP3-плеер</td><td>Есть</td></tr></tbody></table><div></div></div><div><h3>Интерфейсы</h3><table><tbody><tr><td>Интерфейсы и подключения</td><td>microUSB</td></tr></tbody></table><div></div></div><div><h3>Аккумулятор</h3><table><tbody><tr><td>Емкость аккумулятора</td><td>1320 mAh</td></tr><tr><td>Время работы в режиме разговора</td><td>9 часов</td></tr><tr><td>Время работы в режиме ожидания</td><td>707 часов</td></tr></tbody></table><div></div></div><div><h3>Прочее</h3><table><tbody><tr><td>Органайзер</td><td>Календарь, контакты, музыкальный плеер, социальные сети, браузер</td></tr><tr><td>SMS/EMS/MMS/E-mail</td><td>SMS&nbsp;<br>MMS+SMIL&nbsp;<br>AMS&nbsp;<br>Мгновенные сообщения</td></tr><tr><td>Стандарты и технологии</td><td>GSM: 850/ 900/1800/1900 МГц, HSPA/WCDMA: 900/2100 МГц</td></tr><tr><td>Размеры и вес</td><td>Высота - 116,5 мм.&nbsp;<br>Ширина 55,7 - мм.&nbsp;<br>Толщина - 13,9 мм.<br>Вес - 99 граммов</td></tr><tr><td>Комплектация</td><td>Телефон<br>Аккумулятор Nokia Battery BL-5J<br>Гарнитура Nokia Wired headset WH-102<br>ЗУ Nokia Charger AC-11<br>документация</td></tr></tbody></table></div></div></div>  <table><tbody></tbody></table></strong></div>  ', NULL, NULL, NULL),
(1024, 'ru', 'Гарнитура Nokia BH-108 ', 'Bluetooth-гарнитура Nokia BH-108 позволит управлять вызовами в режиме "свободные руки", и оставаться на связи, на протяжении всего дня.  ', 'Маленькая беспроводная гарнитура с аккуратным, и современным дизайном, удобно и надежно подойдет к вашему уху. Держите контроль над всеми звонками, занимаясь при этом, ежедневными делами, благодаря многофункциональной клавише. Сделайте ваше ежедневное общение еще проще, освободите свои руки.  <div><table><tbody><tr><td>Тип гарнитуры</td><td>Bluetooth</td></tr><tr><td>Спецификация Bluetooth</td><td>2</td></tr><tr><td>Максимальная дальность связи</td><td>10 м</td></tr><tr><td>Время работы от батареи: разговор/ожидание (ч)</td><td>5/120 ч</td></tr><tr><td>Размер, мм</td><td>(ШхВхТ): 16.2x53.5x8.3 мм</td></tr><tr><td>Вес, г</td><td>9г</td></tr><tr><td>Функции</td><td>Ответить/закончить разговор, ожидание/удержание вызова, голосовой набор, повтор последнего номера</td></tr><tr><td>Совместимость</td><td>широкая совместимость, по Bluetooth</td></tr><tr><td>Комплектация</td><td>Гарнитура, зарядное устройство, пособие пользователя</td></tr><tr><td>Другие функции</td><td>Крепление с заушиной</td></tr></tbody></table>  <br></div>  ', NULL, NULL, NULL),
(1025, 'ru', 'Гарнитура Samsung EHS62ASN White ', 'Боитесь пропустить важный звонок, когда прослушиваете любимую музыку на мобильном телефоне? Не нужно бояться! Музыка автоматически выключится, когда Вам на мобильный поступит звонок. С помощью проводной гарнитуры канального типа Samsung EHS62ASN White (EHS62ASNWECSTD) Вы сможете легко управлять звонками. Эти наушники призваны сделать работу более удобной и обезопасить водителя, когда он находится за рулем автомобиля, освобождая при этом руки от лишних движений.&nbsp;  ', 'Гарнитура отлично подходит не только для разговора, но и для прослушивания музыки или радио, просмотра фильмов на планшетнике. Если музыка является важной частью вашей жизни, то эта hands-free гарнитура создана специально для Вас. Два тонких и удобных наушника не будут создавать дискомфорта в ушных раковинах и помогут проигрывать любимые треки в стерео с отличным звучанием басов. Лёгкие и комфортные наушники Samsung EHS62ASN White оснащены тонким микрофоном и разъемом 3.5 мм (4 pin).   <div><table><tbody><tr><td>Тип гарнитуры</td><td>Проводная</td></tr><tr><td>Разъемы</td><td>3.5 мм</td></tr><tr><td>Функции</td><td>микрофон, кнопка ответа</td></tr><tr><td>Совместимость</td><td>C3530 / C3750 / Ch@t 335 / Ch@t 350 / Corby II / E2330 / Star II</td></tr></tbody></table>  <br></div>  ', NULL, NULL, NULL),
(1096, 'ru', 'Мобильный телефон Samsung Galaxy Grand Duos I9082 elegant white', '<span style="text-align:justify">Элегантный белый тонкий смартфон Samsung Galaxy Grand Duos I9082 elegant white будет настоящей находкой для людей, ценящих в мобильных устройствах прежде всего практичность и функциональность. Две SIM-карты позволят четко разделять рабочие и личные звонки, а также облегчают ориентацию в списке контактов. Сенсорный 5-дюймовый WVGA дисплей обладает отличной чувствительностью и быстро реагирует даже на легчайшие прикосновения пальцев.&nbsp;</span>  ', '<span style="text-align:justify" class="undefined">Модель &nbsp;оснащена достаточно мощным по меркам мобильной техники двухъядерным процессором с частотой 1.2 ГГц и 1 ГБ оперативной памяти. Благодаря этому будет максимально сокращено время включения телефона и запуска всевозможных приложений. Кстати, для последних предусмотрены 8 ГБ встроенной памяти, которую можно расширить до 64 ГБ с помощью карты памяти microSD. Так что ваши любимые игры, фотографии, видеозаписи, музыка будут всегда под рукой.<br></span><span style="text-align:justify">С помощью этого смартфона вы сможете делать отличные снимки не только статичных, но и движущихся объектов, поскольку он оснащен камерой с разрешением 8 Мп с автофокусом. Эта же камера позволит вам записывать видео в формате FullHD.</span><div><div style="text-align:justify"><br></div><div style="text-align:justify"><div><div><h3>Основные</h3><table><tbody><tr><td>Тип устройства</td><td>Смартфон</td></tr><tr><td>Операционная система</td><td>Android 4.1 Jelly Bean</td></tr><tr><td>Диагональ экрана</td><td>5"</td></tr><tr><td>Сенсорный экран</td><td>Да</td></tr><tr><td>Количество SIM-карт</td><td>2 SIM</td></tr><tr><td>Тип корпуса</td><td>Моноблок</td></tr></tbody></table><div></div></div><div><h3>Экран</h3><table><tbody><tr><td>Разрешение экрана</td><td>480x800</td></tr><tr><td>Количество цветов</td><td>16 миллионов</td></tr></tbody></table><div></div></div><div><h3>Процессор</h3><table><tbody><tr><td>Процессор</td><td>Двухъядерный Samsung Exynos (1.2 ГГц)</td></tr></tbody></table><div></div></div><div><h3>Камера</h3><table><tbody><tr><td>Камера</td><td>8 Mpx</td></tr><tr><td>Запись видео</td><td>1080p</td></tr><tr><td>Фронтальная камера</td><td>Есть</td></tr><tr><td>Дополнительно</td><td>Автофокус, LED-подсветка</td></tr></tbody></table><div></div></div><div><h3>Память</h3><table><tbody><tr><td>Внутренняя память</td><td>8 Гб</td></tr><tr><td>Оперативная память</td><td>1 Гб</td></tr><tr><td>Поддержка карт памяти</td><td>microSD до 64 Гб</td></tr></tbody></table><div></div></div></div><div><div><h3>Беспроводные технологии</h3><table><tbody><tr><td>Bluetooth</td><td>Bluetooth 4.0</td></tr><tr><td>Wi-Fi</td><td>IEEE 802.11 b/g/n</td></tr><tr><td>GPS</td><td>A-GPS</td></tr></tbody></table><div></div></div><div><h3>Развлечения и мультимедиа</h3><table><tbody><tr><td>FM-тюнер</td><td>Есть</td></tr><tr><td>MP3-плеер</td><td>Есть</td></tr></tbody></table><div></div></div><div><h3>Интерфейсы</h3><table><tbody><tr><td>Интерфейсы и подключения</td><td>microUSB</td></tr></tbody></table><div></div></div><div><h3>Аккумулятор</h3><table><tbody><tr><td>Емкость аккумулятора</td><td>2100 mAh</td></tr></tbody></table><div></div></div><div><h3>Прочее</h3><table><tbody><tr><td>Органайзер</td><td>Есть</td></tr><tr><td>SMS/EMS/MMS/E-mail</td><td>SMS/MMS/E-mail</td></tr><tr><td>Стандарты и технологии</td><td>GSM: 850/ 900/1800/1900 МГц, HSPA/WCDMA: 900/2100 МГц</td></tr><tr><td>Размеры и вес</td><td>143.5 x 76.9 x 9.6 мм<br>162 грамма</td></tr><tr><td>Комплектация</td><td>Смартфон Samsung Galaxy Grand Duos I9082 elegant white, аккумулятор, зарядное устройство, кабель USB, гарантийный талон, руководство пользователя</td></tr></tbody></table><div></div></div><div><h3>Гарантия</h3><table><tbody><tr><td>Гарантийный срок</td><td>12 месяцев</td></tr><tr><td>Дополнительно</td><td>Характеристики и комплектация товара могут быть изменены производителем без уведомления.&nbsp;<br>Товар сертифицирован, IMEI внесен в базу УДЦР</td></tr><tr><td>Обмен и возврат товара</td><td>Обмен и возврат товара осуществляется в течение 14 дней после покупки, согласно закону Украины "О защите прав потребителей Украины"</td></tr></tbody></table></div></div>  <br></div><span style="text-align:justify"></span><div><span style="text-align:justify"><br></span></div></div>  ', NULL, NULL, NULL),
(1099, 'ru', 'Мобильный телефон Sony Xperia Z C6603 Black', 'Мобильный телефон Sony Xperia Z C6603 Black можно смело назвать флагманом линейки Xperia. Данная модель оснащена невероятно четким и очень ярким 5-дюймовым дисплеем Reality Display с поддержкой формата Full HD/  ', 'Мобильный телефон Sony Xperia Z C6603 Black можно смело назвать флагманом линейки Xperia. Данная модель оснащена невероятно четким и очень ярким 5-дюймовым дисплеем Reality Display с поддержкой формата Full HD (стандарт 1080p с прогрессивной разверткой). Телефон оснащен 13-мегапиксельной камерой с поддержкой множества современных функций. Технология HDR (High Dynamic Range) позволит создавать четкие фотоснимки даже в условиях яркого заднего света. Режим серийной съемки позволяет снимать неограниченное количество фотографий со скоростью 10 кадров в секунду, после чего вы можете выбрать наиболее удачный кадр. Данная функция особенно актуальна при съемке во время движения. Sony Xperia Z прошел достаточное количество тестов, и доказал высокое соответствие стандартам IP55 и IP57. Это значит, что телефон защищен от попадания влаги и пыли внутрь корпуса.   <div><br></div><div><div><div><h3>Основные</h3><table><tbody><tr><td>Тип устройства</td><td>Смартфон</td></tr><tr><td>Операционная система</td><td>Android 4.1 Jelly Bean</td></tr><tr><td>Диагональ экрана</td><td>5"</td></tr><tr><td>Сенсорный экран</td><td>Да</td></tr><tr><td>Количество SIM-карт</td><td>1 SIM</td></tr><tr><td>Формат SIM-карты</td><td>Стандартная</td></tr><tr><td>Тип корпуса</td><td>Моноблок</td></tr><tr><td>Материал корпуса</td><td>Пластик</td></tr></tbody></table><div></div></div><div><h3>Экран</h3><table><tbody><tr><td>Разрешение экрана</td><td>1920x1080</td></tr><tr><td>Тип экрана</td><td>TFT</td></tr><tr><td>Количество цветов</td><td>16 миллионов</td></tr></tbody></table><div></div></div><div><h3>Процессор</h3><table><tbody><tr><td>Процессор</td><td>1.5 GHz Qualcomm APQ8064+MDM9215M Quad Core</td></tr></tbody></table><div></div></div><div><h3>Камера</h3><table><tbody><tr><td>Камера</td><td>13 Mpx</td></tr><tr><td>Запись видео</td><td>Да</td></tr><tr><td>Фронтальная камера</td><td>Есть</td></tr></tbody></table><div></div></div><div><h3>Память</h3><table><tbody><tr><td>Внутренняя память</td><td>16 Гб</td></tr><tr><td>Оперативная память</td><td>2 Гб</td></tr><tr><td>Поддержка карт памяти</td><td>microSD до 32 Гб</td></tr></tbody></table><div></div></div></div><div><div><h3>Беспроводные технологии</h3><table><tbody><tr><td>Bluetooth</td><td>Bluetooth 4.0</td></tr><tr><td>Wi-Fi</td><td>IEEE 802.11 b/g/n</td></tr><tr><td>GPS</td><td>A-GPS</td></tr></tbody></table><div></div></div><div><h3>Развлечения и мультимедиа</h3><table><tbody><tr><td>FM-тюнер</td><td>Есть</td></tr><tr><td>MP3-плеер</td><td>Есть</td></tr></tbody></table><div></div></div><div><h3>Интерфейсы</h3><table><tbody><tr><td>Интерфейсы и подключения</td><td>HDMI, microUSB, Аудио 3,5 мм</td></tr></tbody></table><div></div></div><div><h3>Аккумулятор</h3><table><tbody><tr><td>Емкость аккумулятора</td><td>2330 mAh</td></tr><tr><td>Время работы в режиме разговора</td><td>До 11 ч.</td></tr><tr><td>Время работы в режиме ожидания</td><td>До 550 ч</td></tr></tbody></table><div></div></div><div><h3>Прочее</h3><table><tbody><tr><td>Органайзер</td><td>Есть</td></tr><tr><td>SMS/EMS/MMS/E-mail</td><td>SMS/MMS/E-mail</td></tr><tr><td>Стандарты и технологии</td><td>GSM: 850/ 900/1800/1900 МГц, HSPA/WCDMA: 900/2100 МГц</td></tr><tr><td>Размеры и вес</td><td>139 x 71 x 7.9 мм<br>146 граммов</td></tr></tbody></table><div></div></div><div><h3>Гарантия</h3><table><tbody><tr><td>Гарантийный срок</td><td>12 месяцев</td></tr><tr><td>Дополнительно</td><td>Характеристики и комплектация товара могут быть изменены производителем без уведомления.&nbsp;<br>Товар сертифицирован, IMEI внесен в базу УДЦР</td></tr><tr><td>Обмен и возврат товара</td><td>Обмен и возврат товара осуществляется в течение 14 дней после покупки, согласно закону Украины "О защите прав потребителей Украины"</td></tr></tbody></table><div></div></div></div>  <br></div>  ', NULL, NULL, NULL),
(1104, 'ru', 'Мобильный телефон Sony Xperia V LT25i Black ', '<div><span style="font-weight: normal;">Sony Xperia V LT25i Black &ndash; это умный, стильный и надежный смартфон, готовый стать для своего владельца верным помощником во всех делах и товарищем по развлечениям. </span> <br /><br /></div>', '<p>Sony Xperia V LT25i Black &ndash; это умный, стильный и надежный смартфон, готовый стать для своего владельца верным помощником во всех делах и товарищем по развлечениям. Скорость его работы оставляет далеко позади всех потенциальных конкурентов &ndash; благодаря мощному двухъядерному процессору Snapdragon S4 новейшего поколения с частотой 1,5 ГГц все приложения будут открываться мгновенно, а серфинг в интернете будет быстрым и комфортным как никогда. Новинка может похвастаться водонепроницаемостью &ndash; смело разговаривайте под дождем или в бассейне &ndash; смартфон Xperia V не боится влаги.<br />Большой и яркий дисплей с диагональю 4,3 дюйма, HD-разрешением 1280 x 720 пикселей и 16 миллионами цветов позволит вам наслаждаться максимально реалистичным изображением, которое будет выглядеть на экране телефона ничуть не хуже, чем на вашем домашнем телевизоре.</p>\n<div>&nbsp;</div>\n<div>\n<div>\n<div>\n<h3>Основные</h3>\n<table>\n<tbody>\n<tr>\n<td>Тип устройства</td>\n<td>Смартфон</td>\n</tr>\n<tr>\n<td>Операционная система</td>\n<td>Android 4.0 (Ice Cream Sandwich)</td>\n</tr>\n<tr>\n<td>Диагональ экрана</td>\n<td>4.3"</td>\n</tr>\n<tr>\n<td>Сенсорный экран</td>\n<td>Да</td>\n</tr>\n<tr>\n<td>Количество SIM-карт</td>\n<td>1 SIM</td>\n</tr>\n<tr>\n<td>Формат SIM-карты</td>\n<td>microSIM</td>\n</tr>\n<tr>\n<td>Тип корпуса</td>\n<td>Моноблок</td>\n</tr>\n<tr>\n<td>Материал корпуса</td>\n<td>Пластик</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Экран</h3>\n<table>\n<tbody>\n<tr>\n<td>Разрешение экрана</td>\n<td>1280x720</td>\n</tr>\n<tr>\n<td>Тип экрана</td>\n<td>TFT</td>\n</tr>\n<tr>\n<td>Количество цветов</td>\n<td>16 миллионов</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Процессор</h3>\n<table>\n<tbody>\n<tr>\n<td>Процессор</td>\n<td>Qualcomm, 1,5 ГГц</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Камера</h3>\n<table>\n<tbody>\n<tr>\n<td>Запись видео</td>\n<td>Да</td>\n</tr>\n<tr>\n<td>Фронтальная камера</td>\n<td>Есть</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Память</h3>\n<table>\n<tbody>\n<tr>\n<td>Внутренняя память</td>\n<td>8 Гб</td>\n</tr>\n<tr>\n<td>Оперативная память</td>\n<td>1 Гб</td>\n</tr>\n<tr>\n<td>Поддержка карт памяти</td>\n<td>microSD до 32 Гб</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n</div>\n<div>\n<div>\n<h3>Беспроводные технологии</h3>\n<table>\n<tbody>\n<tr>\n<td>Bluetooth</td>\n<td>Bluetooth</td>\n</tr>\n<tr>\n<td>Wi-Fi</td>\n<td>IEEE 802.11 b/g/n</td>\n</tr>\n<tr>\n<td>GPS</td>\n<td>A-GPS</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Развлечения и мультимедиа</h3>\n<table>\n<tbody>\n<tr>\n<td>FM-тюнер</td>\n<td>Есть</td>\n</tr>\n<tr>\n<td>MP3-плеер</td>\n<td>Есть</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Интерфейсы</h3>\n<table>\n<tbody>\n<tr>\n<td>Интерфейсы и подключения</td>\n<td>microUSB, Аудио 3,5 мм</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Аккумулятор</h3>\n<table>\n<tbody>\n<tr>\n<td>Емкость аккумулятора</td>\n<td>1750 mAh</td>\n</tr>\n<tr>\n<td>Время работы в режиме разговора</td>\n<td>до 7 ч.</td>\n</tr>\n<tr>\n<td>Время работы в режиме ожидания</td>\n<td>до 400 ч.</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Прочее</h3>\n<table>\n<tbody>\n<tr>\n<td>Органайзер</td>\n<td>Есть</td>\n</tr>\n<tr>\n<td>SMS/EMS/MMS/E-mail</td>\n<td>SMS/MMS/E-mail</td>\n</tr>\n<tr>\n<td>Стандарты и технологии</td>\n<td>GSM: 850/ 900/1800/1900 МГц, HSPA/WCDMA: 900/2100 МГц</td>\n</tr>\n<tr>\n<td>Размеры и вес</td>\n<td>129 x 65 x 10,7 мм<br />120 граммов</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Гарантия</h3>\n<table>\n<tbody>\n<tr>\n<td>Гарантийный срок</td>\n<td>12 месяцев</td>\n</tr>\n<tr>\n<td>Дополнительно</td>\n<td>Характеристики и комплектация товара могут быть изменены производителем без уведомления.&nbsp;<br />Товар сертифицирован, IMEI внесен в базу УДЦР</td>\n</tr>\n<tr>\n<td>Обмен и возврат товара</td>\n<td>Обмен и возврат товара осуществляется в течение 14 дней после покупки, согласно закону Украины "О защите прав потребителей Украины"</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n</div>\n</div>', '', '', '');
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1105, 'ru', 'Мобильный телефон LG Nexus 4 E960 black', '<p>Смартфон обладает выдающимися характеристиками, а оснащение его самым новым производительным четырехъядерным 1,5-ГГц процессором Quad-core 1.5 GHz Krait, сопряженным с 2 Гбайт оперативной памяти, позволяет говорить о нём как об одном из самых быстрых в мире.</p>\n<div>\n<h2>&nbsp;</h2>\n</div>', '<p>&nbsp;Великолепный 4,7-дюймовый WXGA True HD IPS+ экран с разрешением 1280 на 768, вероятно, достался новинке от флагмана &ndash; LG Optimus G. Высокие показатели контрастности и яркости (470 нит) и применение технологии G2 Touch Hybrid Display позволили добиться очень живой и реалистичной картинки, а некоторый изгиб по краям упрощает управление. Также надо отметить высокую экономичность дисплея. По уверениям разработчиков, он потребляет энергии на 70% меньше, чем AMOLED-панели.<br />Смартфон оснащён двумя камерами. Основная оборудована качественной пятилинзовой оптикой, автофокусом, быстрым затвором и LED-вспышкой. В ней используется 8-МП CMOS датчик с обратной подсветкой. Фронтальная 1,3-мегапиксельная камера пригодится при видеозвонках или для проведения видеоконференций.<br />Корпус смартфона сделан из качественной пластмассы, торцы прорезинены, а передняя и задняя поверхности практически полностью закрыты износостойким стеклом Gorilla Glass 2.<br />Li-Po аккумулятор ёмкостью 2100 мАч обеспечивает работу аппарата до 15-часов в режиме разговора.</p>\n<div>\n<div>\n<div>\n<table>\n<tbody>\n<tr>\n<td>Диcплей</td>\n<td>True HD IPS Plus 4.7" (768 x 1280)</td>\n</tr>\n<tr>\n<td>Процессор</td>\n<td>4x-ядерный, 1.5 GHz Krait</td>\n</tr>\n<tr>\n<td>Операционная система</td>\n<td>Android 4.2 Jelly Bean</td>\n</tr>\n</tbody>\n</table>\n</div>\n<div>&nbsp;</div>\n</div>\n<div>\n<div>\n<div>\n<h3>Основные</h3>\n<table>\n<tbody>\n<tr>\n<td>Тип устройства</td>\n<td>Смартфон</td>\n</tr>\n<tr>\n<td>Операционная система</td>\n<td>Android 4.2 Jelly Bean</td>\n</tr>\n<tr>\n<td>Диагональ экрана</td>\n<td>4.7"</td>\n</tr>\n<tr>\n<td>Сенсорный экран</td>\n<td>Да</td>\n</tr>\n<tr>\n<td>Количество SIM-карт</td>\n<td>1 SIM</td>\n</tr>\n<tr>\n<td>Формат SIM-карты</td>\n<td>microSIM</td>\n</tr>\n<tr>\n<td>Тип корпуса</td>\n<td>Моноблок</td>\n</tr>\n<tr>\n<td>Материал корпуса</td>\n<td>Пластик</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Экран</h3>\n<table>\n<tbody>\n<tr>\n<td>Разрешение экрана</td>\n<td>1280x768</td>\n</tr>\n<tr>\n<td>Тип экрана</td>\n<td>IPS</td>\n</tr>\n<tr>\n<td>Количество цветов</td>\n<td>16 миллионов</td>\n</tr>\n<tr>\n<td>Дополнительно</td>\n<td>4.7" HD-IPS Plus LCD (768 x 1280 точек) / 16.7 млн. цветов / сенсорный, емкостной / стойкое к царапинам стекло Gorilla Glass 2</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Процессор</h3>\n<table>\n<tbody>\n<tr>\n<td>Процессор</td>\n<td>4-ядерный Qualcomm APQ8064 Snapdragon (1.5 ГГц) Krait с графическим ядром Adreno 320</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Камера</h3>\n<table>\n<tbody>\n<tr>\n<td>Камера</td>\n<td>8 Mpx</td>\n</tr>\n<tr>\n<td>Запись видео</td>\n<td>1080p</td>\n</tr>\n<tr>\n<td>Фронтальная камера</td>\n<td>Есть</td>\n</tr>\n<tr>\n<td>Дополнительно</td>\n<td>3264 x 2448 точек, автофокус, LED вспышка</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Память</h3>\n<table>\n<tbody>\n<tr>\n<td>Внутренняя память</td>\n<td>16 Гб</td>\n</tr>\n<tr>\n<td>Оперативная память</td>\n<td>2 Гб</td>\n</tr>\n<tr>\n<td>Поддержка карт памяти</td>\n<td>Нет</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n</div>\n<div>\n<div>\n<h3>Беспроводные технологии</h3>\n<table>\n<tbody>\n<tr>\n<td>Bluetooth</td>\n<td>Bluetooth 4.0</td>\n</tr>\n<tr>\n<td>Wi-Fi</td>\n<td>IEEE 802.11 b/g/n</td>\n</tr>\n<tr>\n<td>GPS</td>\n<td>A-GPS</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Развлечения и мультимедиа</h3>\n<table>\n<tbody>\n<tr>\n<td>FM-тюнер</td>\n<td>Нет</td>\n</tr>\n<tr>\n<td>MP3-плеер</td>\n<td>Есть</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Интерфейсы</h3>\n<table>\n<tbody>\n<tr>\n<td>Интерфейсы и подключения</td>\n<td>microUSB, Аудио 3,5 мм</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Аккумулятор</h3>\n<table>\n<tbody>\n<tr>\n<td>Емкость аккумулятора</td>\n<td>2100 mAh</td>\n</tr>\n<tr>\n<td>Время работы в режиме разговора</td>\n<td>до 15 часов (3G)</td>\n</tr>\n<tr>\n<td>Время работы в режиме ожидания</td>\n<td>до 390 часов (3G)</td>\n</tr>\n</tbody>\n</table>\n<div>&nbsp;</div>\n</div>\n<div>\n<h3>Прочее</h3>\n<table>\n<tbody>\n<tr>\n<td>Органайзер</td>\n<td>Часы<br />Планировщик<br />Просмотр офисных документов<br />Секундомер<br />Таймер</td>\n</tr>\n<tr>\n<td>SMS/EMS/MMS/E-mail</td>\n<td>SMS(threaded view)<br />MMS<br />Email<br />Push Mail<br />IM<br />RSS</td>\n</tr>\n<tr>\n<td>Стандарты и технологии</td>\n<td>GSM: 850/ 900/1800/1900 МГц, HSPA/WCDMA: 900/2100 МГц</td>\n</tr>\n<tr>\n<td>Размеры и вес</td>\n<td>133.9 x 68.7 x 9.1 мм<br />139 гр</td>\n</tr>\n<tr>\n<td>Комплектация</td>\n<td>Телефон<br />Батарея<br />Зарядное устройство<br />USB-кабель<br />Инструкция<br />Гарантийный талон.</td>\n</tr>\n</tbody>\n</table>\n</div>\n</div>\n</div>\n</div>', '', '', ''),
(1107, 'ru', 'Аккумулятор к телефону Nokia BL-4C', '<p>Nokia 2650/6260/7200/6100/5100/6170/7270&nbsp;</p>  ', '<p>Легкая батарея емкостью 820 мА•ч устанавливается под заднюю панель телефона Nokia.</p><p>Nokia 2650/6260/7200/6100/5100/6170/7270&nbsp;</p>  ', NULL, NULL, NULL),
(1108, 'ru', 'Nokia Lumia 920 White', 'Смелый дизайн, самые высокие технологии, как в аппаратном, так и программном обеспечении делают мобильный телефон Nokia Lumia 920 White достойным объектом для обожания миллионов пользователей и причин для этого, как Вы увидите ниже, более чем достаточно.<div><h2></h2></div>  ', 'Огромный 4,5-дюймовый дисплей, с вполне компьютерным разрешением 1280х768 пикселей, демонстрирует незаурядную яркость и четкость картинки, безукоризненно выполняя при этом роль устройства ввода, благодаря емкостной сенсорной панели, поддерживающей технологию Multipoint-Touch. Особенно приятно смотрится на этом экране «рабочий стол» операционной системы Windows Phone 8, открывающей новые горизонты удобства, функциональности и производительности мира мобильных устройств. «Бестормозная» работа всего этого добра обеспечивается также не «абы чем» - а великолепным двухъядерным процессором Snapdragon™ S4, 1 ГБ оперативной памяти и 32-ГБ накопителем, для хранения приложений, аудио видео и прочих файлов. Но самое главное – это безупречное качество связи в сетях 2G, 3G и 4G, поддержка Wi-Fi, в общем, все, то, что делает общение безграничным и доступным каждому.<br>Так что, если Вы готовы приобщиться к новым высотам информационных и коммуникационных технологий, мобильный телефон Nokia Lumia 920 White – это самый короткий путь к вершинам.&nbsp;   <div><div><div><table><tbody><tr><td>Внутренняя память</td><td>32 Гб</td></tr><tr><td>Диcплей</td><td>4.5" Gorilla Glass</td></tr><tr><td>Операционная система</td><td>Windows Phone 8</td></tr><tr><td>Процессор</td><td>Двухъядерный 1,5 Ггц</td></tr><tr><td>Корпус</td><td>Поликарбонатный корпус с модулем беспроводной зарядки</td></tr></tbody></table></div><div></div></div><div><div><div><h3>Основные</h3><table><tbody><tr><td>Тип устройства</td><td>Смартфон</td></tr><tr><td>Операционная система</td><td>Windows Phone 8</td></tr><tr><td>Диагональ экрана</td><td>4.5"</td></tr><tr><td>Сенсорный экран</td><td>Да</td></tr><tr><td>Количество SIM-карт</td><td>1 SIM</td></tr><tr><td>Формат SIM-карты</td><td>microSIM</td></tr><tr><td>Тип корпуса</td><td>Моноблок</td></tr><tr><td>Материал корпуса</td><td>Пластик</td></tr></tbody></table><div></div></div><div><h3>Экран</h3><table><tbody><tr><td>Разрешение экрана</td><td>1280x720</td></tr><tr><td>Тип экрана</td><td>Puremotion HD+</td></tr><tr><td>Количество цветов</td><td>16 миллионов</td></tr><tr><td>Дополнительно</td><td>емкостный, сенсорный, Corning Gorilla Glass</td></tr></tbody></table><div></div></div><div><h3>Процессор</h3><table><tbody><tr><td>Процессор</td><td>Snapdragon™ S4 (1.5ГГц)</td></tr></tbody></table><div></div></div><div><h3>Камера</h3><table><tbody><tr><td>Камера</td><td>8.7 Mpx</td></tr><tr><td>Запись видео</td><td>1080p</td></tr><tr><td>Фронтальная камера</td><td>Есть</td></tr><tr><td>Дополнительно</td><td>Двойная вспышка и автофокус</td></tr></tbody></table><div></div></div><div><h3>Память</h3><table><tbody><tr><td>Внутренняя память</td><td>32 Гб</td></tr><tr><td>Оперативная память</td><td>1 Гб</td></tr><tr><td>Поддержка карт памяти</td><td>Нет</td></tr></tbody></table><div></div></div></div><div><div><h3>Беспроводные технологии</h3><table><tbody><tr><td>Bluetooth</td><td>Bluetooth 3.0</td></tr><tr><td>Wi-Fi</td><td>IEEE 802.11 b/g/n</td></tr><tr><td>GPS</td><td>A-GPS</td></tr></tbody></table><div></div></div><div><h3>Развлечения и мультимедиа</h3><table><tbody><tr><td>FM-тюнер</td><td>Нет</td></tr><tr><td>MP3-плеер</td><td>Есть</td></tr></tbody></table><div></div></div><div><h3>Аккумулятор</h3><table><tbody><tr><td>Емкость аккумулятора</td><td>2000 mAh</td></tr><tr><td>Время работы в режиме разговора</td><td>Максимальное время работы в режиме разговора в сети 2G - 18.6 ч<br>Максимальное время работы в режиме разговора в сети 3G - 10.8 ч</td></tr><tr><td>Время работы в режиме ожидания</td><td>Максимальное время работы в режиме ожидания в сети 2G - 460 ч<br>Максимальное время работы в режиме ожидания в сети 3G - 460 ч<br></td></tr></tbody></table><div></div></div><div><h3>Прочее</h3><table><tbody><tr><td>Органайзер</td><td>Диктофон<br>Калькулятор<br>Часы<br>Календарь<br>Телефонная книга<br>Заметки<br>Напоминания<br>Список задач<br>Социальные сети в телефонной книге<br>OneNote<br>Кошелек</td></tr><tr><td>SMS/EMS/MMS/E-mail</td><td>SMS/MMS/E-mail</td></tr><tr><td>Стандарты и технологии</td><td>GSM: 850/ 900/1800/1900 МГц, HSPA/WCDMA: 900/2100 МГц</td></tr><tr><td>Размеры и вес</td><td>130,3 x 70,8 x 10,7 мм / 185 г</td></tr><tr><td>Комплектация</td><td>Nokia Lumia 920<br>Высокоэффективное зарядное устройство Nokia USB AC-16<br>Кабель для зарядки и передачи данных Nokia CA-190CD<br>Гарнитура Nokia WH-208<br>Краткое руководство<br>Клавиша SIM Door<br>Гарантийный талон</td></tr></tbody></table></div></div></div>  <br></div>  ', NULL, NULL, NULL),
(1109, 'ru', 'Карта памяти Kingston microSD 16 Gb (SDC4/16GB) ', 'Kingston microSD 16 GB Class 4 - универсальный носитель информации на основе технологии флеш-памяти для самых различных целей.&nbsp;  ', 'Эта карта памяти может использоваться в телефонах, коммуникаторах, видеокамерах, цифровых фотоаппаратах, персональных компьютерах, принтерах и других электронных устройствах.&nbsp;<div>&nbsp;Объем памяти-16 Gb.&nbsp;Индекс скорости-Class 4<br><div><br></div>  </div>  ', NULL, NULL, NULL),
(1110, 'ru', 'Зарядное устройство Сетевой адаптер Apple MB707 white', '<div><div><h3>Основные</h3><table><tbody><tr><td>Тип аксессуара</td><td>Сетевой адаптер</td></tr><tr><td>Описание</td><td>Цвет – белый&nbsp;<br>Компактный плоский корпус оригинального дизайна из ударопрочного пластика занимает места не более стандартной электрической вилки.</td></tr></tbody></table><div></div></div></div><div><div><h3>Гарантия</h3><table><tbody><tr><td>Гарантийный срок</td><td>6 месяцев</td></tr><tr><td>Дополнительно</td><td>Характеристики и комплектация товара могут быть изменены производителем без уведомления.</td></tr><tr><td>Обмен и возврат товара</td><td>Обмен и возврат товара осуществляется в течение 14 дней после покупки, согласно закону Украины "О защите прав потребителей Украины"</td></tr></tbody></table><br><div></div></div></div>  ', '<div><div><span style="font-weight:normal"><br></span><span style="font-weight:normal">Сетевое зарядное устройство Apple MB707 white – это очень полезный аксессуар для всех владельцев IPhone или IPod. Компактный плоский корпус оригинального дизайна из ударопрочного белого пластика занимает места не более стандартной электрической вилки, что делает устройство незаменимым спутником мобильного телефона или планшетника от Apple. Входящий в стандартную комплектацию USB-кабель позволяет использовать зарядное устройство совместно с док-станцией, а также заряжать и другие электронные устройства в любом месте: в транспорте, на работе или дома (лишь бы поблизости находилась электрическая розетка). Он также позволяет обмениваться информацией с любым компьютером, имеющим стандартный USB-разъем, что весьма полезно для синхронизации ваших данных, расположенных на различных носителях. Модель обеспечивает комфортное и удобное использование различных продуктов от Apple, реализуя практически неограниченную мобильность их владельцу. Гарантия – 6 месяцев</span>.  <br></div></div><div><div><div></div></div></div>  ', NULL, NULL, NULL),
(1112, 'ru', 'Гарнитура Nokia BH-505', 'Nokia BH-505 - легкая и удобная в использовании беспроводная стереогарнитура, позволяющая слушать музыку и другие аудиозаписи, а также принимать телефонные звонки, не занимая при этом руки.Дизайн Nokia BH-505 очень удобный и стильный, эту элегантную и легкую гарнитуру можно спокойно носить на шее. Подобрать подходящие наушники на свой вкус также может абсолютно любой пользователь.Разработчики предусмотрели в конструкции гарнитуры защиту от брызг, что делает Nokia BH-505 отличным решением для любителей активного отдыха. Прекрасное качество звука гарантировано даже при высоком шуме ветра, что обеспечено технологией цифровой обработки сигналов (DSP)  <br><div><br></div>  ', '<div><div><h3>Основные</h3><table><tbody><tr><td>Тип гарнитуры</td><td>Bluetooth</td></tr><tr><td>Спецификация Bluetooth</td><td>Bluetoooth 2.1 + EDRПрофили:(HSP) 1.0,(HFP) 1.5,(A2DP) 1.2,(AVRCP) 1.0</td></tr><tr><td>Максимальная дальность связи</td><td>10 м</td></tr><tr><td>Время работы от батареи: разговор/ожидание (ч)</td><td>в режиме разговора до 10 часов</td></tr><tr><td>Размер, мм</td><td>125 x 137 x 58,5</td></tr><tr><td>Вес, г</td><td>36 г</td></tr><tr><td>Функции</td><td>Управление музыкой и вызовами на гарнитуре: - Включение / выключение (включая спаривание); - Ответ / завершение вызова; - Воспроизведение / пауза; - Следующий трек / перемотка вперед, предыдущий трек / перемотка назад; -</td></tr><tr><td>Совместимость</td><td>Беспроводная стереогарнитура Nokia BH-505 совместима со следующими устройствами:Nokia 2323 classicNokia 5130 XpressMusicNokia 5230Nokia 5235 Вместе с музыкойNokia 5320 XpressMusicNokia 5730 XpressMusicNokia 5800 XpressMusicNokia 6085Nokia 6131N</td></tr><tr><td>Комплектация</td><td>Беспроводная стереогарнитура Nokia BH-505 Амбушюры-вкладыши Nokia размеров S, M и L (малый, средний и большой) Амбушюры для ушной раковины Nokia размеров S, M и L (малый, средний и большой) Дорожное зарядное устройство Nokia AC-3 Рук</td></tr><tr><td>Другие функции</td><td>Повторный набор последнего номера. Голосовой набор. Эта беспроводная стереогарнитура специально создана для активного образа жизни и предоставляет быстрый доступ к музыке и вызовам.</td></tr></tbody></table><br><div></div></div></div>  ', NULL, NULL, NULL),
(1111, 'ru', 'Зарядное устройство Nokia AC-4E', '<p>Зарядное устройство Nokia AC-4E &nbsp;для Nokia 6300/7500/N95</p>  ', '<p>Маленькое и легкое зарядное устройство с уменьшенным штекером обеспечивает быструю зарядку вашего телефона.</p><p>для Nokia 6300/7500/N95</p>  ', NULL, NULL, NULL),
(1113, 'ru', 'Наушники Panasonic RP-HJE120E-G Green ', 'Наушники-вкладыши Panasonic RP-HJE120E-G Green с первого взгляда привлекают своим сочным зелёным цветом.&nbsp;<div>Характеристики Panasonic RP-HJE120E-G Green</div><div> Тип наушников-вкладыши</div><div> Тип подключения-  Проводное</div><div> Интерфейс проводного подключения&nbsp;-  1 x mini-jack (разъем 3.5 мм)&nbsp;</div><div>Кабель -&nbsp;Двухсторонний&nbsp;</div>  ', 'Наушники-вкладыши Panasonic RP-HJE120E-G Green  отнюдь не тяжелы и не будут висеть гирьками. Также они&nbsp;&nbsp;способны предоставить идеальное качество звука, хорошую шумоизоляцию и отсутствие всяких погрешностей, шуршаний и помех. Комфортная посадка благодаря дизайну Ergo Fit, к тому же есть три комплекта амбушюров разного размера для максимального удобства. Благодаря универсальному разъему 3,5 мм (mini-jack), вы сможете использовать наушники не только с мобильным телефоном, но и любым другим устройством с аналогичным входом.   <div><h2>Технические Характеристики</h2><div><div><div><h3>Основные</h3><table><tbody><tr><td>Тип наушников</td><td>Вкладыши</td></tr><tr><td>Тип подключения</td><td>Проводное</td></tr><tr><td>Интерфейс проводного подключения</td><td>1 x mini-jack (разъем 3.5 мм)</td></tr><tr><td>Кабель</td><td>Двухсторонний</td></tr></tbody></table></div></div></div>  <br></div>  ', NULL, NULL, NULL),
(1114, 'ru', 'Гарнитура Samsung P1000 EHS-60 black', 'Гарнитура Samsung P1000 EHS-60 black используется для прослушивания музыки, просмотров фильмов и прохождения игр в звуком сопровождении. Мощные низкие и высокие частоты делают эти наушники идеальным решением для прослушивания музыки в вашем планшетном компьютере. Слушайте свою музыку везде и всегда с оригинальной стереогарнитурой Samsung P1000 EHS-60 black. Используйте свою технику максимально. Принимайте и отклоняйте вызовы, листайте любимые треки, просматривайте видео. Гладкие, легкие и удобные наушники Samsung P1000 EHS-60 black превосходно садятся в ушные раковины и не создают чувства дискомфорта. Купить Samsung P1000 EHS-60 black вы можете, оформив заказ у нас на сайте, а также по телефону горячей линии 0-800-300-100.  ', '<div><div><h3>Основные</h3><table><tbody><tr><td>Тип гарнитуры</td><td>Проводная</td></tr><tr><td>Совместимость</td><td>Samsung Galaxy Tab</td></tr><tr><td>Другие функции</td><td>Разъем: 3.5 мм</td></tr></tbody></table><br><div></div></div></div>  ', NULL, NULL, NULL),
(1115, 'ru', 'Гарнитура Samsung BHM1100 black', 'Bluetooth-гарнитура Samsung ВНМ1100 black отличается элегантным исполнением и высоким качеством звука. Гарнитура оснащена системой подавления эха и окружающего шума. Даже если пользователь находится в шумном месте, например, в аэропорту или в транспорте, его собеседник будет слышать только голос, без посторонних шумов. Отличное качество звука гарантировано не только собеседнику, но и самому владельцу гарнитуры за счет системы автоматического изменения громкости динамика. В зависимости от условий гарнитура сама меняет уровень громкости для комфортного общения без необходимости ручной настройки. Светодиодный индикатор не только отражает статус гарнитуры, но и показывает заряд аккумулятора устройства  ', '<h3>Основные</h3><table><tbody><tr><td>Тип гарнитуры</td><td>Bluetooth</td></tr><tr><td>Спецификация Bluetooth</td><td>2,1</td></tr><tr><td>Максимальная дальность связи</td><td>10 м</td></tr><tr><td>Время работы от батареи: разговор/ожидание (ч)</td><td>7 часов в режиме разговора. 400 часов в режиме ожидания.</td></tr><tr><td>Размер, мм</td><td>18x52x10 мм</td></tr><tr><td>Вес, г</td><td>11 г</td></tr><tr><td>Функции</td><td>Ответить/закончить разговор, Ожидание/удержание вызова, Голосовой набор, Повтор последнего номера,автоматическая подстройка громкости, автоматическое парное соединение, цифровое шумо- и эхоподавление.</td></tr><tr><td>Совместимость</td><td>Samsung</td></tr></tbody></table>  ', NULL, NULL, NULL),
(1117, 'ru', 'Гарнитура Samsung BHS6000 EBECSEK', 'Bluetooth-гарнитура Samsung BHS6000 EBECSEK – это отличная гарнитура в первую очередь для прослушивания музыки без потери качества, а потом уже для простых разговоров. В гарнитуре использованы самые передовые технологии при изготовлении динамиков. И если вы настоящий меломан, то эта гарнитура подойдет вам. Управление гарнитурой осуществляется кнопка: вызов, включение/выключение, регулировка звука, управление проигрывателем (плей/пауза, вперед/назад), голосовые команды. Поддерживаются голосовые команды: принять, отклонить, перезвонить и д.р. Время работы гарнитуры в режиме звонков 9 часов, в режиме ожидания 150 часов. Приблизительное время полной подзарядки – 3 часа.  ', '<h3>Основные</h3><table><tbody><tr><td>Тип гарнитуры</td><td>Bluetooth</td></tr><tr><td>Спецификация Bluetooth</td><td>Bluetooth 3.0</td></tr><tr><td>Максимальная дальность связи</td><td>До 10 метров</td></tr><tr><td>Время работы от батареи: разговор/ожидание (ч)</td><td>Время работы в режиме разговора до 9 ч<br>Время работы в режиме ожидания До 150 ч<br>Время полного заряда, приблизительно 3 ч</td></tr><tr><td>Вес, г</td><td>120</td></tr><tr><td>Разъемы</td><td>microUSB<br>Разъем 3.5 мм</td></tr><tr><td>Функции</td><td>Multipoint / одновременно с двумя устройствами<br>Шумоподавление<br>Регулятор громкости<br>Голосовой набор<br>Профиль A2DP<br>Профиль AVRCP</td></tr><tr><td>Другие функции</td><td>Световой индикатор состояния гарнитуры</td></tr></tbody></table>  ', NULL, NULL, NULL),
(7977, 'ru', 'MP3-флэш плеер Ergo Zen modern 2 GB Black', '<ul><li> Встроенная память 2 GB</li><li> ЖК-дисплей 1.8”</li><li> FM радио</li></ul>', '<p>Проигрывание музыкальных композиций, просмотр видеороликов и фотографий - всё это может компактный <b>Ergo</b> <b>Zen</b> <b>modern</b>. Объем встроенной памяти доступен от 2-х до 8-ми GB. <br><br><b>Ergo</b> <b>Zen</b> <b>modern</b> доступен в продаже в 3-х цветах: черный, красный и синий!<br><b>Характеристики:</b></p><o:p></o:p><ul>    <li>Память: 2 GB, 4 GB, 8 GB<o:p></o:p></li>    <li>1.8 TFT LCD-дисплей (160x128)<o:p></o:p></li>    <li>форматы: MP3, WMA, MTV, JPEG<o:p></o:p></li>    <li>FM-тюнер</li>    <li>USB 2.0<br>    <br>     </li></ul><p> </p>', NULL, NULL, NULL),
(7978, 'ru', 'MP3-флэш плеер Ergo Zen modern 2 GB Red', '<ul><li> Встроенная память 2 GB</li><li> ЖК-дисплей 1.8”</li><li> FM радио</li></ul>', '<p>Проигрывание музыкальных композиций, просмотр видеороликов и фотографий - всё это может компактный <b>Ergo</b> <b>Zen</b> <b>modern</b>. Объем встроенной памяти доступен от 2-х до 8-ми GB. <br><br><b>Ergo</b> <b>Zen</b> <b>modern</b> доступен в продаже в 3-х цветах: черный, красный и синий!<br><b>Характеристики:</b></p><o:p></o:p><ul>    <li>Память: 2 GB, 4 GB, 8 GB<o:p></o:p></li>    <li>1.8 TFT LCD-дисплей (160x128)<o:p></o:p></li>    <li>форматы: MP3, WMA, MTV, JPEG<o:p></o:p></li>    <li>FM-тюнер</li>    <li>USB 2.0<br>    <br>     </li></ul><p> </p>', NULL, NULL, NULL),
(7979, 'ru', 'MP3-флэш плеер Ergo Zen modern 4 GB Black', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей 1.8”</li><li> FM радио</li></ul>', '<p>Проигрывание музыкальных композиций, просмотр видеороликов и фотографий - всё это может компактный <b>Ergo</b> <b>Zen</b> <b>modern</b>. Объем встроенной памяти доступен от 2-х до 8-ми GB. <br><br><b>Ergo</b> <b>Zen</b> <b>modern</b> доступен в продаже в 3-х цветах: черный, красный и синий!<br><b>Характеристики:</b></p><o:p></o:p><ul>    <li>Память: 2 GB, 4 GB, 8 GB<o:p></o:p></li>    <li>1.8 TFT LCD-дисплей (160x128)<o:p></o:p></li>    <li>форматы: MP3, WMA, MTV, JPEG<o:p></o:p></li>    <li>FM-тюнер</li>    <li>USB 2.0<br>    <br>     </li></ul><p> </p>', NULL, NULL, NULL),
(7974, 'ru', 'MP3-флэш плеер Ergo Zen Basic 4 GB Blue', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей </li><li> FM радио</li></ul>', '<p>Компания Ergo в очередной раз решила порадовать меломанов, выпустив на рынок новинку - MP3-флэш плеер Ergo Zen Basiс.<o:p></o:p></p><p>Удобный и надежный, при этом компактный с лаконичным и в то же время элегантным дизайном, плеер станет незаменим в долгих пробках мегаполисов, во время прогулок или любое другое время, когда Вы захотите побаловать себя любимыми треками. MP3-флэш плеер Ergo Zen Basiс объединил в себе лучшие качества электронного продукта: функциональность и приятную цену.<o:p></o:p></p><p>Ergo Zen Basiс  - оптимальное решение для тех, кто ценит лаконичность за умеренную стоимость и не желает переплачивать за те характеристики, которыми он никогда не пользуется.<o:p></o:p></p><p>MP3-флэш плеер Ergo Zen Basiс представлен в трех цветовых решениях: классическом черном, белом и синем цветах. Объем памяти достигает 2, 4 или 8 GB, есть слот под карту памяти MicroSD, что дает возможность за раз закачивать порядка 1000 музыкальных композиций.<o:p></o:p></p><p><b>Комплектация:</b> наушники, инструкция пользователя.<o:p></o:p></p>', NULL, NULL, NULL),
(7975, 'ru', 'MP3-флэш плеер Ergo Zen Basic 4 GB White', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей </li><li> FM радио</li></ul>', '<p>Компания Ergo в очередной раз решила порадовать меломанов, выпустив на рынок новинку - MP3-флэш плеер Ergo Zen Basiс.<o:p></o:p></p><p>Удобный и надежный, при этом компактный с лаконичным и в то же время элегантным дизайном, плеер станет незаменим в долгих пробках мегаполисов, во время прогулок или любое другое время, когда Вы захотите побаловать себя любимыми треками. MP3-флэш плеер Ergo Zen Basiс объединил в себе лучшие качества электронного продукта: функциональность и приятную цену.<o:p></o:p></p><p>Ergo Zen Basiс  - оптимальное решение для тех, кто ценит лаконичность за умеренную стоимость и не желает переплачивать за те характеристики, которыми он никогда не пользуется.<o:p></o:p></p><p>MP3-флэш плеер Ergo Zen Basiс представлен в трех цветовых решениях: классическом черном, белом и синем цветах. Объем памяти достигает 2, 4 или 8 GB, есть слот под карту памяти MicroSD, что дает возможность за раз закачивать порядка 1000 музыкальных композиций.<o:p></o:p></p><p><b>Комплектация:</b> наушники, инструкция пользователя.<o:p></o:p></p>', NULL, NULL, NULL),
(4016, 'ru', 'Вставка для беременных в демисезонную слингокуртку (ВБДУ-010.00) ТМ Katinka', 'Вставка для беременных в демисезонную слингокуртку (ВБДУ-010.00) ТМ Katinka', 'Пристегивается к слингокуртке вместо слинговставки. Позволяет носить куртку до последних дней беременности. Ткань (состав) - плюс съемный флисовый утеплитель', NULL, NULL, NULL),
(4018, 'ru', 'Демисезонная мужская слингокуртка для папы. Размеры 44, 46, 48, 50, 52, 54 (ДСП-010.00) ТМ Katinka', 'Демисезонная мужская слингокуртка для папы. Размеры 44, 46, 48, 50, 52, 54 (ДСП-010.00) ТМ Katinka', 'Мужская слингокуртка для активных пап, которые помогают носить малышей в слингах и рюкзачках мамам :) Цвет мужской слингокуртки может быть любой из доступных к пошиву женских, молнии практически все идут в тон к основной ткани - плащевке.. Ткань (состав) - верх - плащевка, подкладка - полиэстр, утепление - синтепон 100 г/м.', NULL, NULL, NULL),
(4020, 'ru', 'Зимняя универсальная слингокуртка 5 в 1 с возможностью ношения за спиной. (ЗС-020.00) ТМ Katinka', 'Зимняя универсальная слингокуртка 5 в 1 с возможностью ношения за спиной. (ЗС-020.00) ТМ Katinka', 'Теплая зимняя куртка для мамы со съемной слинговставкой спереди и встроенной слинговставкой для ношения за спиной. . Ткань (состав) - верх - плащевка, подкладка - флис, утепление - синтепон 250 г/м.', NULL, NULL, NULL),
(4021, 'ru', 'Вставка для беременных в зимнюю слингокуртку (ВБЗ-010.00) ТМ Katinka', 'Вставка для беременных в зимнюю слингокуртку (ВБЗ-010.00) ТМ Katinka', 'Пристегивается к слингокуртке вместо передней слинговставки. Позволяет носить куртку до последних дней беременности. Ткань (состав) - верх - плащевка, подкладка - флис, утепление - синтепон.', NULL, NULL, NULL),
(12040, 'ru', 'Смартфон Samsung GT-S6810 Galaxy Fame Pure White', '<ul><li> OS Android 4.1 (Jelly Bean); CPU 1.0 Ghz, ROM 4 GB, RAM 512 MB, microSD до 32 GB</li><li> Дисплей 3.5, HVGA (320x480), TFT</li><li> Камера 5 MPx + AF, VGA, Bluetooth, Wi-Fi, A-GPS</li><li> Аккумулятор 1300 mAh; габариты 113.2 x 61.6 x 11.55 мм</li></ul>', '<p>В новом стильном и компактном смартфоне Samsung GALAXY Fame есть все, что необходимо для самой активной мобильной жизни!<br>Новейшая операционная система Jelly Bean OS в сочетании с мощным процессором обеспечат вам полный набор функций, присущих семейству смартфонов Samsung GALAXY. Помимо этого, этот смартфон оснащен массой самых инновационных функций для развлечений, а также доступ на портал Samsung Hub и к облачному сервису Cloud.</p><p><strong>Потрясающе быстрая реакция и высокая функциональность</strong></p><p>Обладая быстродействием и удобством ноутбука, смартфон Samsung’s GALAXY FAME позволит вам все делать легко и быстро. Созданный с использованием самых новейших технологических достижений, смартфон Samsung GALAXY FAME обладает рабочими характеристиками и функциональностью, о которых можно только мечтать.</p><p><strong>Жестовый интерфейс Motion UI</strong></p><p>Жестовый пользовательский интерфейс Motion UI использует простые и интуитивно-понятные жесты для выполнения повседневных задач</p><p><strong>Поддержка сервиса ChatON</strong></p><p>Подключитесь ко всем мобильным телефонам своих друзей с помощью одного мессенджера, поделитесь с ними видеоклипами, фотоснимками, отправьте им голосовые сообщения.</p><p><strong>Функция Change Display</strong></p><p>Функция Change Display поддерживает возможность передать на другие устройства видео, фотоснимки и музыкальные треки через Wi-Fi.</p><p><strong>Облачное хранилице Cloud</strong></p><p>Синхронизируйте все свои фотоснимки, документы, контакты и многое другое со всеми своими устройствами, сохранив весь контент на облачном сервисе, доступном в любой точке мира через всемирную паутину.</p>', NULL, NULL, NULL),
(12041, 'ru', 'Смартфон Samsung GT-S7500 ABA Galaxy Ace Plus Dark Blue', '<ul><li> OS Android 2.3.6; CPU 1.0 Ghz, ROM 3 GB, RAM 512 MB, microSD</li><li> Дисплей 3.65, (320х480), TFT</li><li> Камера 5 MPx, 3G, GPRS, Bluetooth, EDGE, Wi-Fi, USB</li><li> Аккумулятор 1300 mAh; габариты 114.7 x 62.5 x 11.3 мм</li></ul>', '<p><strong>Ключевые характеристики:</strong></p><ul>    <li>Операционная система: Android 2.3.6 (Gingerbread)</li>    <li>Стандарты: GSM: 850/900/1800/1900, UMTS: 900/2100</li>    <li>Основной дисплей: TFT, 3.65, сенсорный, 320 x 480 пикселей, 262 тыс. цветов</li>    <li>Встроенная 4 GB</li>    <li>Слот расширения для карт памяти microSDHC</li>    <li>Передача данных: 3G, GPRS, Bluetooth, EDGE, Wi-Fi, USB</li>    <li>Фотокамера: 5.0 мегапикселей</li></ul><p><em>Комплектация:</em> смартфон, аккумулятор, З/У, кабель подключения к ПЭВМ типа PC, руководство пользователя.</p>', NULL, NULL, NULL),
(12042, 'ru', 'Смартфон Samsung GT-S7500 CWA Galaxy Ace Plus Chic White', '<ul><li> OS Android 2.3.6; CPU 1.0 Ghz, ROM 3 GB, RAM 512 MB, microSD</li><li> Дисплей 3.65, (320х480), TFT</li><li> Камера 5 MPx, 3G, GPRS, Bluetooth, EDGE, Wi-Fi, USB</li><li> Аккумулятор 1300 mAh; габариты 114.7 x 62.5 x 11.3 мм</li></ul>', '<p><strong>Ключевые характеристики:</strong></p><ul>    <li>Операционная система: Android 2.3.6 (Gingerbread)</li>    <li>Стандарты: GSM: 850/900/1800/1900, UMTS: 900/2100</li>    <li>Основной дисплей: TFT, 3.65, сенсорный, 320 x 480 пикселей, 262 тыс. цветов</li>    <li>Встроенная 4 GB</li>    <li>Слот расширения для карт памяти microSDHC</li>    <li>Передача данных: 3G, GPRS, Bluetooth, EDGE, Wi-Fi, USB</li>    <li>Фотокамера: 5.0 мегапикселей</li></ul><p><em>Комплектация:</em> смартфон, аккумулятор, З/У, кабель подключения к ПЭВМ типа PC, руководство пользователя.</p>', NULL, NULL, NULL),
(12043, 'ru', 'Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey', '<ul><li> OS Windows Phone 7.5 Tango; CPU 1.0 Ghz, ROM 4 GB, RAM 384 MB</li><li> Дисплей 4, WVGA (800x480), Super AMOLED, G-сенсор</li><li> Камера 5 MPx + AF, VGA для видеозвонка, Bluetooth  2.1, A-GPS, WiFi 802.11 b/g/n</li><li> Аккумулятор 1500 mAh; габариты 121.6 x 64.1 x 10.5 мм</li></ul>', '<p><strong>Яркость. Люди. Общение</strong></p><p>Удивительно яркий и огромный 4 Super AMOLED дисплей. Исключительно яркие и чистые цвета изображения. Благодаря отсутствию бликов вы можете легко видеть текст даже на ярком солнце. Низкое энергопотребление позволяет на 20% увеличить время работы телефона от батареи.</p><p><strong>Простота общения и обмена информацией</strong></p><p>Это самое важное требование современной жизни реализован в телефонах Samsung, поддерживающих социальные сети и основные сервисы коммуникации Приложение Family Story позволяет обмениваться в близкими фотоснимками, описаниями знаменательных событий через облачное хранилище, благодаря чему доступ к этой информации можно получить с любого устройства в любое время. Функция ChatON - это универсальное средство общения позволяет обмениваться сообщениями, осуществлять групповой чат и обмен контентом. (Приложение Family story можно загрузить на телефон)</p><p><strong>Тонкий изысканный дизайн</strong></p><p>Строгий дизайн отличается совершенными пропорциями, телефон удобно лежит в руке и очень компактный. Лицевая панель оснащена большим 4” экраном, а комфортная задняя панель позволяет надежно удерживать телефон в руке. Тонкий, простой и изысканный телефон – это все, о чем можно</p>', NULL, NULL, NULL);
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(12045, 'ru', 'Смартфон Samsung GT-S7562 Galaxy S Duos ZKA Black', '<ul>\r\n<li>OS Android 4; CPU 1 Ghz, ROM 4 GB, microSD до 32 GB</li>\r\n<li>Дисплей 4, WVGA (800x480),TFT</li>\r\n<li>Камера 5 MPx + AF, Bluetooth, WI-FI, GPS</li>\r\n<li>Аккумулятор 1500 mAh; габариты 121.5 x 63.1 x 10.5 мм</li>\r\n</ul>', '<p><strong>Сервис Dual SIM Always On<br /></strong>Благодаря поддержке двух SIM-карт с сервисом Dual SIM Always On* вы не пропустите ни одного звонка. Путешествуете по разным странам? Пользуетесь Интернетом? Уже общаетесь с другим собеседником по одной из SIM-карт? Никаких проблем! Функция поддержки двух SIM-карт обеспечивает свободу выбора, позволяя выбирать различных сотовых операторов с различными зонами покрытия и разными тарифными планами или просто отделять вызовы по работе от личных звонков. Вы не пропустите ни одного вызова во время подключения к Интернету и даже при разговоре по другой SIM-карте.<br /><br /><strong>Большой 4 дисплей - это незабываемые впечатления от развлечений<br /></strong>Теперь, при попытке прочитать текст вам не надо будет прищуриваться! При просмотре фотографий и видео от вас теперь не ускользнет ни одна деталь! Большой 4 дисплей обеспечивает комфортный просмотр веб-страниц, длинных электронных писем, фотографий и видео. И все это отличается кристально-чистым изображением.<br /><br /><strong>Оптимизированная платформа Android 4.0<br /></strong>Смартфон оснащен современной платформой Android 4.0 Ice Cream Sadwich. Множество функций телефона, улучшенная графика, более организованные компоновки, делают выполнение каждой задачи более приятной и yдобной.<br /><br /><strong>Быстрый и мощный<br /></strong>Процессор с тактовой частотой 1 ГГц легко и быстро справляется с самыми сложными операциями. Вы можете быстро переключаться между приложениями в режиме многозадачности! С этим смартфоном вам не придется больше ждать!<br /><br /><strong>Chat On на большом и ярком дисплее с диагональю 4 дюйма<br /></strong>Сервис ChatON позволяет вам легко общаться с друзьями и это больше, чем просто обмен сообщениями. Этот сервис поддерживает обмен мультимедийными файлами или групповой чат со всеми друзьями, и позволяет даже создавать анимированные сообщения!</p>', '', '', ''),
(12039, 'ru', 'Смартфон Samsung GT-S6810 Galaxy Fame Metallic Blue', '<ul><li> OS Android 4.1 (Jelly Bean); CPU 1.0 Ghz, ROM 4 GB, RAM 512 MB, microSD до 32 GB</li><li> Дисплей 3.5, HVGA (320x480), TFT</li><li> Камера 5 MPx + AF, VGA, Bluetooth, Wi-Fi, A-GPS</li><li> Аккумулятор 1300 mAh; габариты 113.2 x 61.6 x 11.55 мм</li></ul>', '<p>В новом стильном и компактном смартфоне Samsung GALAXY Fame есть все, что необходимо для самой активной мобильной жизни!<br>Новейшая операционная система Jelly Bean OS в сочетании с мощным процессором обеспечат вам полный набор функций, присущих семейству смартфонов Samsung GALAXY. Помимо этого, этот смартфон оснащен массой самых инновационных функций для развлечений, а также доступ на портал Samsung Hub и к облачному сервису Cloud.</p><p><strong>Потрясающе быстрая реакция и высокая функциональность</strong></p><p>Обладая быстродействием и удобством ноутбука, смартфон Samsung’s GALAXY FAME позволит вам все делать легко и быстро. Созданный с использованием самых новейших технологических достижений, смартфон Samsung GALAXY FAME обладает рабочими характеристиками и функциональностью, о которых можно только мечтать.</p><p><strong>Жестовый интерфейс Motion UI</strong></p><p>Жестовый пользовательский интерфейс Motion UI использует простые и интуитивно-понятные жесты для выполнения повседневных задач</p><p><strong>Поддержка сервиса ChatON</strong></p><p>Подключитесь ко всем мобильным телефонам своих друзей с помощью одного мессенджера, поделитесь с ними видеоклипами, фотоснимками, отправьте им голосовые сообщения.</p><p><strong>Функция Change Display</strong></p><p>Функция Change Display поддерживает возможность передать на другие устройства видео, фотоснимки и музыкальные треки через Wi-Fi.</p><p><strong>Облачное хранилице Cloud</strong></p><p>Синхронизируйте все свои фотоснимки, документы, контакты и многое другое со всеми своими устройствами, сохранив весь контент на облачном сервисе, доступном в любой точке мира через всемирную паутину.</p>', NULL, NULL, NULL),
(12038, 'ru', 'Смартфон Samsung GT-S6802 ZYA Galaxy Ace Duos Yellow', '<ul><li> OS Android 2.3 (Gingerbread); CPU 0.832 Ghz, ROM 4 GB, RAM  512 MB, microSD до 32 GB</li><li> Дисплей 3.5, (320x480), TFT LCD</li><li> Камера 5 MPx + AF, 3G, Bluetooth, EDGE/GPRS, USB, Wi-Fi, GPS, PC Sync</li><li> Аккумулятор 1300 mAh; габариты 112.74 х 61.5 х 11.5 мм</li></ul>', '<p>Унаследовав от Galaxy Ace премиальный дизайн, высокую производительность, и широкие функциональные возможности, новинка поддерживает технологию Duos, которая позволяет одновременно использовать две SIM-карты. Со смартфоном Samsung Galaxy Ace Duos пользователь сможет легко сохранять баланс между профессиональной деятельностью и личной жизнью. Возможность автоматического переключения между тарифными планами позволит оптимизировать затраты на мобильную связь.</p><p>Samsung Galaxy Ace Duos максимально повышает гибкость коммуникаций и дает возможность использовать два телефонных номера в одном устройстве. Уникальная функция Dual SIM always on автоматически перенаправит входящий звонок с SIM-2 на SIM-1, даже если основная SIM-карта уже задействована. Благодаря этому пользователь сможет легко поддерживать баланс между профессиональной деятельностью и личной жизнью, не пропуская важные звонки.</p><p>Samsung Galaxy Ace Duos дополнит ваш стиль своим элегантным, компактным и ультрасовременным дизайном, который новинка унаследовала от Samsung Galaxy Ace. Смартфон оснащен 3.5-дюймовым экраном на котором удобно просматривать текстовые сообщения, мультимедиа и веб-контент. Технология HSDPA 7.2 (High-Speed Downlink Packet Access) обеспечит быстрый интернет-серфинг и загрузку контента за минимальное время. Встроенная 5-мегапиксельная камера позволит обмениваться изображениями и видео высокого качества.</p><p>В дополнение к превосходным техническим характеристикам, Galaxy Ace Duos обладает продуманным и интуитивно понятным интерфейсом TouchWiz, который предоставляет пользователям дополнительный комфорт при использовании смартфона. Для хранения музыки, видео и изображений доступно 3 GB встроенной памяти. Смартфон поддерживает кросс-платформенный коммуникационный сервис Samsung ChatON, объединяющий пользователей различных мобильных платформ в единое сообщество. Благодаря ChatON можно обмениваться сообщениями и различным мультимедийным контентом.</p>', NULL, NULL, NULL),
(12036, 'ru', 'Смартфон Samsung GT-S6802 ZIA Galaxy Ace Duos Pink', '<ul><li> OS Android 2.3 (Gingerbread); CPU 0.832 Ghz, ROM 4 GB, RAM  512 MB, microSD до 32 GB</li><li> Дисплей 3.5, (320x480), TFT LCD</li><li> Камера 5 MPx + AF, 3G, Bluetooth, EDGE/GPRS, USB, Wi-Fi, GPS, PC Sync</li><li> Аккумулятор 1300 mAh; габариты 112.74 х 61.5 х 11.5 мм</li></ul>', '<p>Унаследовав от Galaxy Ace премиальный дизайн, высокую производительность, и широкие функциональные возможности, новинка поддерживает технологию Duos, которая позволяет одновременно использовать две SIM-карты. Со смартфоном Samsung Galaxy Ace Duos пользователь сможет легко сохранять баланс между профессиональной деятельностью и личной жизнью. Возможность автоматического переключения между тарифными планами позволит оптимизировать затраты на мобильную связь.</p><p>Samsung Galaxy Ace Duos максимально повышает гибкость коммуникаций и дает возможность использовать два телефонных номера в одном устройстве. Уникальная функция Dual SIM always on автоматически перенаправит входящий звонок с SIM-2 на SIM-1, даже если основная SIM-карта уже задействована. Благодаря этому пользователь сможет легко поддерживать баланс между профессиональной деятельностью и личной жизнью, не пропуская важные звонки.</p><p>Samsung Galaxy Ace Duos дополнит ваш стиль своим элегантным, компактным и ультрасовременным дизайном, который новинка унаследовала от Samsung Galaxy Ace. Смартфон оснащен 3.5-дюймовым экраном на котором удобно просматривать текстовые сообщения, мультимедиа и веб-контент. Технология HSDPA 7.2 (High-Speed Downlink Packet Access) обеспечит быстрый интернет-серфинг и загрузку контента за минимальное время. Встроенная 5-мегапиксельная камера позволит обмениваться изображениями и видео высокого качества.</p><p>В дополнение к превосходным техническим характеристикам, Galaxy Ace Duos обладает продуманным и интуитивно понятным интерфейсом TouchWiz, который предоставляет пользователям дополнительный комфорт при использовании смартфона. Для хранения музыки, видео и изображений доступно 3 GB встроенной памяти. Смартфон поддерживает кросс-платформенный коммуникационный сервис Samsung ChatON, объединяющий пользователей различных мобильных платформ в единое сообщество. Благодаря ChatON можно обмениваться сообщениями и различным мультимедийным контентом.</p>', NULL, NULL, NULL),
(12033, 'ru', 'Смартфон Samsung GT-S6802 CWA Galaxy Ace Duos Сhic White', '<ul><li> OS Android 2.3 (Gingerbread); CPU 0.832 Ghz, ROM 4 GB, RAM  512 MB, microSD до 32 GB</li><li> Дисплей 3.5, (320x480), TFT LCD</li><li> Камера 5 MPx + AF, 3G, Bluetooth, EDGE/GPRS, USB, Wi-Fi, GPS, PC Sync</li><li> Аккумулятор 1300 mAh; габариты 112.74 х 61.5 х 11.5 мм</li></ul>', '<p>Унаследовав от Galaxy Ace премиальный дизайн, высокую производительность, и широкие функциональные возможности, новинка поддерживает технологию Duos, которая позволяет одновременно использовать две SIM-карты. Со смартфоном Samsung Galaxy Ace Duos пользователь сможет легко сохранять баланс между профессиональной деятельностью и личной жизнью. Возможность автоматического переключения между тарифными планами позволит оптимизировать затраты на мобильную связь.</p><p>Samsung Galaxy Ace Duos максимально повышает гибкость коммуникаций и дает возможность использовать два телефонных номера в одном устройстве. Уникальная функция Dual SIM always on автоматически перенаправит входящий звонок с SIM-2 на SIM-1, даже если основная SIM-карта уже задействована. Благодаря этому пользователь сможет легко поддерживать баланс между профессиональной деятельностью и личной жизнью, не пропуская важные звонки.</p><p>Samsung Galaxy Ace Duos дополнит ваш стиль своим элегантным, компактным и ультрасовременным дизайном, который новинка унаследовала от Samsung Galaxy Ace. Смартфон оснащен 3.5-дюймовым экраном на котором удобно просматривать текстовые сообщения, мультимедиа и веб-контент. Технология HSDPA 7.2 (High-Speed Downlink Packet Access) обеспечит быстрый интернет-серфинг и загрузку контента за минимальное время. Встроенная 5-мегапиксельная камера позволит обмениваться изображениями и видео высокого качества.</p><p>В дополнение к превосходным техническим характеристикам, Galaxy Ace Duos обладает продуманным и интуитивно понятным интерфейсом TouchWiz, который предоставляет пользователям дополнительный комфорт при использовании смартфона. Для хранения музыки, видео и изображений доступно 3 GB встроенной памяти. Смартфон поддерживает кросс-платформенный коммуникационный сервис Samsung ChatON, объединяющий пользователей различных мобильных платформ в единое сообщество. Благодаря ChatON можно обмениваться сообщениями и различным мультимедийным контентом.</p>', NULL, NULL, NULL),
(12034, 'ru', 'Смартфон Samsung GT-S6802 Galaxy Ace Duos ZKA Black', '<ul><li> OS Android 2.3; CPU 832 Мhz, ROM 4 GB, microSD до 32 GB</li><li> Дисплей 3.5, HVGA (320x480), TFT LCD</li><li> Камера 5 MPx + AF, VGA для видеозвонка, Bluetooth, WI-FI, GPS</li><li> Аккумулятор 1300 mAh; габариты 112.74 x 61.5 x 11.5 мм</li></ul>', '<p>Унаследовав от Galaxy Ace премиальный дизайн, высокую производительность, и широкие функциональные возможности, новинка поддерживает технологию Duos, которая позволяет одновременно использовать две SIM-карты. Со смартфоном Samsung Galaxy Ace Duos пользователь сможет легко сохранять баланс между профессиональной деятельностью и личной жизнью. Возможность автоматического переключения между тарифными планами позволит оптимизировать затраты на мобильную связь.</p><p>Samsung Galaxy Ace Duos максимально повышает гибкость коммуникаций и дает возможность использовать два телефонных номера в одном устройстве. Уникальная функция Dual SIM always on автоматически перенаправит входящий звонок с SIM-2 на SIM-1, даже если основная SIM-карта уже задействована. Благодаря этому пользователь сможет легко поддерживать баланс между профессиональной деятельностью и личной жизнью, не пропуская важные звонки.</p><p>Samsung Galaxy Ace Duos дополнит ваш стиль своим элегантным, компактным и ультрасовременным дизайном, который новинка унаследовала от Samsung Galaxy Ace. Смартфон оснащен 3.5-дюймовым экраном на котором удобно просматривать текстовые сообщения, мультимедиа и веб-контент. Технология HSDPA 7.2 (High-Speed Downlink Packet Access) обеспечит быстрый интернет-серфинг и загрузку контента за минимальное время. Встроенная 5-мегапиксельная камера позволит обмениваться изображениями и видео высокого качества.</p><p>В дополнение к превосходным техническим характеристикам, Galaxy Ace Duos обладает продуманным и интуитивно понятным интерфейсом TouchWiz, который предоставляет пользователям дополнительный комфорт при использовании смартфона. Для хранения музыки, видео и изображений доступно 3 GB встроенной памяти. Смартфон поддерживает кросс-платформенный коммуникационный сервис Samsung ChatON, объединяющий пользователей различных мобильных платформ в единое сообщество. Благодаря ChatON можно обмениваться сообщениями и различным мультимедийным контентом.</p>', NULL, NULL, NULL),
(12035, 'ru', 'Смартфон Samsung GT-S6802 TIZ Galaxy Ace Duos Romantic Pink La Fleur', '<ul><li> OS Android 2.3 (Gingerbread); CPU 0.832 Ghz, ROM 4 GB, RAM  512 MB, microSD до 32 GB</li><li> Дисплей 3.5, (320x480), TFT LCD</li><li> Камера 5 MPx + AF, 3G, Bluetooth, EDGE/GPRS, USB, Wi-Fi, GPS, PC Sync</li><li> Аккумулятор 1300 mAh; габариты 112.74 х 61.5 х 11.5 мм</li></ul>', '<p>Унаследовав от Galaxy Ace премиальный дизайн, высокую производительность, и широкие функциональные возможности, новинка поддерживает технологию Duos, которая позволяет одновременно использовать две SIM-карты. Со смартфоном Samsung Galaxy Ace Duos пользователь сможет легко сохранять баланс между профессиональной деятельностью и личной жизнью. Возможность автоматического переключения между тарифными планами позволит оптимизировать затраты на мобильную связь.</p><p>Samsung Galaxy Ace Duos максимально повышает гибкость коммуникаций и дает возможность использовать два телефонных номера в одном устройстве. Уникальная функция Dual SIM always on автоматически перенаправит входящий звонок с SIM-2 на SIM-1, даже если основная SIM-карта уже задействована. Благодаря этому пользователь сможет легко поддерживать баланс между профессиональной деятельностью и личной жизнью, не пропуская важные звонки.</p><p>Samsung Galaxy Ace Duos дополнит ваш стиль своим элегантным, компактным и ультрасовременным дизайном, который новинка унаследовала от Samsung Galaxy Ace. Смартфон оснащен 3.5-дюймовым экраном на котором удобно просматривать текстовые сообщения, мультимедиа и веб-контент. Технология HSDPA 7.2 (High-Speed Downlink Packet Access) обеспечит быстрый интернет-серфинг и загрузку контента за минимальное время. Встроенная 5-мегапиксельная камера позволит обмениваться изображениями и видео высокого качества.</p><p>В дополнение к превосходным техническим характеристикам, Galaxy Ace Duos обладает продуманным и интуитивно понятным интерфейсом TouchWiz, который предоставляет пользователям дополнительный комфорт при использовании смартфона. Для хранения музыки, видео и изображений доступно 3 GB встроенной памяти. Смартфон поддерживает кросс-платформенный коммуникационный сервис Samsung ChatON, объединяющий пользователей различных мобильных платформ в единое сообщество. Благодаря ChatON можно обмениваться сообщениями и различным мультимедийным контентом.</p>', NULL, NULL, NULL),
(12031, 'ru', 'Смартфон Samsung GT-S6500 Galaxy Mini 2 ZYD Yellow', '<ul><li> OS Android 2.3; CPU 800 Mhz (Cortex-A5), ROM 4 GB, RAM  512 MB, microSD до 32 GB</li><li> Дисплей 3.27, HVGA (800x480), TFT LCD, G-сенсор</li><li> Камера 3 MPx, VGA для видеозвонка, Bluetooth, WI-FI, GPS, Geotaging</li><li> Аккумулятор 1300 mAh; габариты 109.4 x 58.6 x 11.63 мм</li></ul>', '<p><strong>Свежий и стильный дизайн<br></strong>Теперь к вашим услугам более широкий, яркий и четкий дисплей, который идеально подходит для просмотра изображений, поиска информации в Интернете и общения в социальных сетях. Однако mini 2 остается таким же симпатичным, компактным и красочным, как и его предшественник. Настоящий символ вашего веселого и живого характера, этот смартфон очарует любого с первого взгляда. Изящество и тонкий корпус новой модели (11.63 мм) обеспечат абсолютный комфорт в дороге.</p><p><strong>Непревзойденное удобство просмотра<br></strong>Более крупный, но в то же время миниатюрный TFT-дисплей с разрешением HVGA гарантирует более сочные цвета и повышенную четкость изображения. Теперь еще проще просматривать обновления в любимых социальных сетях, будь то свежие фотографии или видеозаписи. На увеличенном дисплее намного удобнее искать интересующие вас места с помощью Карт Google, пользоваться приложениями и общаться в многопользовательских чатах.</p><p><strong>Сменная крышка аккумулятора<br></strong>Обладатели Galaxy mini 2 могут менять крышку аккумулятора по настроению — с новой моделью вы в любой момент освежите свой образ!</p><p><strong>Расширенная память и аппаратные возможности<br></strong>Пользователи Galaxy mini 2 никогда не будут страдать от нехватки развлечений с таким богатым набором мультимедийных возможностей. <br>Смартфон оснащен встроенной памятью щедрого объема — 2.7 ГБ для новых и давно любимых приложений, а также снимков, видеозаписей, музыки и игр. Емкий аккумулятор позволяет интенсивно работать с мультимедиа весь день и не даст смартфону разрядиться в неподходящий момент. Мощный процессор смартфона с тактовой частотой 800 МГц обеспечивает высокую скорость включения и перехода между экранами меню, работы с приложениями и мультимедиа.</p><p><strong>Обширные функциональные возможности<br></strong>Вы можете напрямую загрузить бесплатное приложение для обмена мгновенными сообщениями ChatON и окунуться в мир общения без границ! Кроме того, в вашем распоряжении окажутся все мобильные службы Google, включая Поиск, Карты, Gmail или YouTube. Не упустите и возможность постоянно оставаться на связи с друзьями в Facebook и Twitter.</p>', NULL, NULL, NULL),
(12032, 'ru', 'Смартфон Samsung GT-S6802 AKA Galaxy Ace Duos Metallic Black', '<ul><li> OS Android 2.3 (Gingerbread); CPU 0.832 Ghz, ROM 4 GB, RAM  512 MB, microSD до 32 GB</li><li> Дисплей 3.5, (320x480), TFT LCD</li><li> Камера 5 MPx + AF, 3G, Bluetooth, EDGE/GPRS, USB, Wi-Fi, GPS, PC Sync</li><li> Аккумулятор 1300 mAh; габариты 112.74 х 61.5 х 11.5 мм</li></ul>', '<p>Унаследовав от Galaxy Ace премиальный дизайн, высокую производительность, и широкие функциональные возможности, новинка поддерживает технологию Duos, которая позволяет одновременно использовать две SIM-карты. Со смартфоном Samsung Galaxy Ace Duos пользователь сможет легко сохранять баланс между профессиональной деятельностью и личной жизнью. Возможность автоматического переключения между тарифными планами позволит оптимизировать затраты на мобильную связь.</p><p>Samsung Galaxy Ace Duos максимально повышает гибкость коммуникаций и дает возможность использовать два телефонных номера в одном устройстве. Уникальная функция Dual SIM always on автоматически перенаправит входящий звонок с SIM-2 на SIM-1, даже если основная SIM-карта уже задействована. Благодаря этому пользователь сможет легко поддерживать баланс между профессиональной деятельностью и личной жизнью, не пропуская важные звонки.</p><p>Samsung Galaxy Ace Duos дополнит ваш стиль своим элегантным, компактным и ультрасовременным дизайном, который новинка унаследовала от Samsung Galaxy Ace. Смартфон оснащен 3.5-дюймовым экраном на котором удобно просматривать текстовые сообщения, мультимедиа и веб-контент. Технология HSDPA 7.2 (High-Speed Downlink Packet Access) обеспечит быстрый интернет-серфинг и загрузку контента за минимальное время. Встроенная 5-мегапиксельная камера позволит обмениваться изображениями и видео высокого качества.</p><p>В дополнение к превосходным техническим характеристикам, Galaxy Ace Duos обладает продуманным и интуитивно понятным интерфейсом TouchWiz, который предоставляет пользователям дополнительный комфорт при использовании смартфона. Для хранения музыки, видео и изображений доступно 3 GB встроенной памяти. Смартфон поддерживает кросс-платформенный коммуникационный сервис Samsung ChatON, объединяющий пользователей различных мобильных платформ в единое сообщество. Благодаря ChatON можно обмениваться сообщениями и различным мультимедийным контентом.</p>', NULL, NULL, NULL),
(12030, 'ru', 'Смартфон Samsung GT-S6500 Galaxy Mini 2 RWD Ceramic White', '<ul><li> OS Android 2.3; CPU 800 Mhz (Cortex-A5), ROM 4 GB, RAM  512 MB, microSD до 32 GB</li><li> Дисплей 3.27, HVGA (800x480),TFT LCD, G-сенсор</li><li> Камера 3 MPx, VGA для видеозвонка, Bluetooth, WI-FI, GPS, Geotaging</li><li> Аккумулятор 1300 mAh; габариты 109.4 x 58.6 x 11.63 мм</li></ul>', '<p><strong>Свежий и стильный дизайн<br></strong>Теперь к вашим услугам более широкий, яркий и четкий дисплей, который идеально подходит для просмотра изображений, поиска информации в Интернете и общения в социальных сетях. Однако mini 2 остается таким же симпатичным, компактным и красочным, как и его предшественник. Настоящий символ вашего веселого и живого характера, этот смартфон очарует любого с первого взгляда. Изящество и тонкий корпус новой модели (11.63 мм) обеспечат абсолютный комфорт в дороге.</p><p><strong>Непревзойденное удобство просмотра<br></strong>Более крупный, но в то же время миниатюрный TFT-дисплей с разрешением HVGA гарантирует более сочные цвета и повышенную четкость изображения. Теперь еще проще просматривать обновления в любимых социальных сетях, будь то свежие фотографии или видеозаписи. На увеличенном дисплее намного удобнее искать интересующие вас места с помощью Карт Google, пользоваться приложениями и общаться в многопользовательских чатах.</p><p><strong>Сменная крышка аккумулятора<br></strong>Обладатели Galaxy mini 2 могут менять крышку аккумулятора по настроению — с новой моделью вы в любой момент освежите свой образ!</p><p><strong>Расширенная память и аппаратные возможности<br></strong>Пользователи Galaxy mini 2 никогда не будут страдать от нехватки развлечений с таким богатым набором мультимедийных возможностей. <br>Смартфон оснащен встроенной памятью щедрого объема — 2.7 ГБ для новых и давно любимых приложений, а также снимков, видеозаписей, музыки и игр. Емкий аккумулятор позволяет интенсивно работать с мультимедиа весь день и не даст смартфону разрядиться в неподходящий момент. Мощный процессор смартфона с тактовой частотой 800 МГц обеспечивает высокую скорость включения и перехода между экранами меню, работы с приложениями и мультимедиа.</p><p><strong>Обширные функциональные возможности<br></strong>Вы можете напрямую загрузить бесплатное приложение для обмена мгновенными сообщениями ChatON и окунуться в мир общения без границ! Кроме того, в вашем распоряжении окажутся все мобильные службы Google, включая Поиск, Карты, Gmail или YouTube. Не упустите и возможность постоянно оставаться на связи с друзьями в Facebook и Twitter.</p>', NULL, NULL, NULL),
(4796, 'ru', 'Легкая универсальная слингокуртка-ветровка 3 в 1 Белый-розовый, размеры S, M, L (ЛС-010.00) ТМ Katinka', 'Легкая универсальная слингокуртка-ветровка 3 в 1, размеры S, M, L (ЛС-010.00) ТМ Katinka', 'Предназначена для ношения в беременность, для слингоношения, а также ношения как обычной женской курточки-ветровки в прохладную, ветренную или дождливую погоду конца весны, летом и в начале осени. Уникальная разработка беременной вставки позволяет легким движением превратить ее в слинговставку с приятным сюрпризом - воздушным капюшоном для малыша.. Ткань (состав) - верх - плащевка, подкладка - сеточка, 100% ПЭ', NULL, NULL, NULL),
(4950, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ СONCORDA CD550', '<p>гітара акустична "дреднат", топ суцільна ялина, чохол</p>', '', '', '', ''),
(4955, 'ru', 'Електрогітара серії "BADWATER" AL820CKBW', '<p>електрогітара,червоне дерево,22 лади, H-H звукознімачі(EMG-design),T.O.M, антична коричнево-біла</p>', '', '', '', ''),
(4957, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ STANDARD D350BG', '<p>гітара акустична "дреднат", колір чорний глянець, чохол</p>', '', '', '', ''),
(4958, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ STANDARD D350CEBG', '<p>гітара акустична "дреднат" з вирізом, Walden EQ, колір чорний глянець, чохол</p>', '', '', '', ''),
(4959, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ STANDARD D350CEG', '<p>гітара акустична "дреднат" з вирізом, Walden EQ, колір натуральний глянець, чохол</p>', '', '', '', ''),
(4960, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ STANDARD D350G', '<p>гітара акустична "дреднат", колір натуральний глянець, чохол</p>', '', '', '', ''),
(5634, 'ru', 'Мобильный телефон Fly Ezzy Flip Dual Sim Black', '<ul><li> Дисплей TFT, 176 х 220 пикселей, 262144 оттенков</li><li> WAP, GPRS, USB</li><li> Габариты 99.4 x 50.1 x 19.7 мм</li></ul>', '<p><strong>Fly Ezzy Flip Dual Sim Black </strong>- удобный телефон, который выполнен как моноблок и позиционирует себя как доступное по цене мобильное устройство. Модель удивительно компактна и очень приятна в эксплуатации - ее размеры составляют 99.4 x 50.1 x 19.7 мм, а вес при этом составляет 75 грамм.</p><p>Мобильный телефон <strong>Fly Ezzy Flip Dual Sim Black </strong>был выпущен в 2011 году, и уже новинка успела завоевать симпатии среди пользователей. Дисплей этой модели размером 2.2 дюйма воспроизводит изображение с разрешением 176x220 пикселей. Кроме того, отдельное внимание стоит уделить аккумулятору, емкость которого составляет 800 mAh.</p><p>Этот мобильный телефон способен проработать в режиме разговора до 5 часов, а в режиме ожидания - до 200. Также в устройстве предусмотрена фотокамера, которая создает снимки с разрешением 0.1 мегапикселей.</p><p>В этом мобильном телефоне предусмотрена возможность устанавливать и пользоваться сразу двумя сим-картами. Данные вводятся посредством физической клавиатуры.</p>', NULL, NULL, NULL),
(5633, 'ru', 'Мобильный телефон Fly EZZY Black', '<ul><li> Дисплей TFT, 128 x 64 пикселей, монохромный</li><li> Габариты 107 х 50 х 15 мм</li></ul>', '<p>Бюджетная модель, выполненная в моноблочном формфакторе, ориентированная на пожилых людей. <br>Отличительными особенностями этого аппарата являются: поддержка функции Dual-SIM, небольшой вес, компактные размеры и большие кнопки.</p><ul>    <li>GSM 900/1800/1900 МГц</li>    <li>1.6 - дюймовый дисплей (64 x 128 точек, монохромный)</li>    <li>FM-приемник</li>    <li>МР3-плеер</li>    <li>Фонарик</li>    <li>Слот для карт памяти формата microSD</li></ul><!--more-->', NULL, NULL, NULL),
(5632, 'ru', 'Мобильный телефон Fly E210 Сhrome', '<ul><li> Дисплей TFT, 240 x 320 пикселей, 262 000 оттенков</li><li> WAP, GPRS, Bluetooth, USB, PC Sync</li><li> Габариты 112.5 (91.5) х 51 х 13.5 мм</li></ul>', '<p>Fly представляет молодежный мобильный телефон со сменными панелями корпуса и поддержкой двух SIM-карт.</p><p>Мобильный телефон Fly E210 способен обрести форму тачфона без клавиатуры или классического моноблока с традиционной раскладкой клавиш. Все зависит от того, какую съемную панель установил пользователь. Смена панелей может производиться в горячем режиме без перезагрузки аппарата, а в комплекте можно найти удобный стилус, который сделает работу с сенсорным 2.4 дюймовым экраном более удобной.</p><p>Телефон-трансформер Fly E210 отличается компактными размерами, особенно в случае применения тачфон-панели: 112.5 (91.5) х 51 х 13.5 мм. Аппарат будет доступен в сером или хром-цветах.</p><p>Fly E210 - плод партнерства ТМ Fly и компании Hasbro, которая является гигантом- производителем игрушек в мире. Одной из самых успешных и популярных игрушек были Transformers (Трансформеры). Логотип Transformers нанесен на заднюю панель мобильного телефона Fly E210.</p><p>Новинка предложит пользователю полноценный набор мультимедийных функций и приложений: от камеры до FM-приемника. Аудио и видео-плеер позволят воспроизводить музыку самых популярных форматов. Подключить наушники можно благодаря наличию в комплекте переходника 3.5 мм, который подключается к универсальному разъему mini-USB, расположенному на правой грани корпуса. На левой грани находится гнездо для карт памяти формата microSDHC. Память телефона может быть увеличена до 16 Гб. Предусмотрена «горячая» замена карт.</p><p>Мобильный телефон Fly E210 предложит самые необходимые возможности для работы в Интернете. В аппарате предусмотрен WAP-доступ, GPRS-модем, а также поддержка Java. Среди предустановленных приложений следует выделить браузер Opera Mobile, uTalk, Fly: buzz, а также приложение для чтения электронных книг.</p><p>Батарея Fly E210 ёмкостью 950 мАч позволит активно использовать широкие возможности аппарата.</p>', NULL, NULL, NULL),
(5631, 'ru', 'Мобильный телефон Fly E200 Duos Metalic', '<ul><li> Дисплей TFT, 240 x 320 пикселей, 262 000 оттенков</li><li> WAP, GPRS, Bluetooth</li><li> Габариты 103.65 х 57.2 x 13.55 мм</li></ul>', '<p>Fly e200 представляет собой моноблок по форм-фактору, поддерживающий работу одновременно с двумя сим-картами.Вес телефона составляет 92 грамма.При этом в мобильном установлен аккумулятор ёмкостью 1000 MAH, с продолжительностью работы до 200 часов при ожидании и до 3 при разговоре.<br>В сотовом встроенной памяти - 112 кБ, но есть разъем для флеш-карт.Сенсорный дисплей fly e200 имеет разрешение 240х320 пикселей и диагональ 2.8 дюйма.Фотокамера особым качеством не отличается, разрешение - 0.3 Мегапикселя, а максимальное разрешение полученных фотографий составит 640 х 480 пикселей, так же есть возможность записи видео файлов.</p>', NULL, NULL, NULL);
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(5622, 'ru', 'Мобильный телефон Fly E133 Duos White', '<ul><li> Дисплей TFT, 240 х 320 пикселей, 262000 оттенков</li><li> WAP, GPRS, Bluetooth, USB</li><li> Габариты 92 x 52 x 14 мм</li></ul>', '<p><strong>Ключевые характеристики:<br></strong></p><ul>    <li>Корпус классический</li>    <li>Дисплей: TFT, 2.4, сенсорный, 240x320 пикселей, 262K цветов</li>    <li>Полифония: 64 тона</li>    <li>Память: встроенная 64 MB</li>    <li>Слот расширения для карт памяти microSD</li>    <li>WAP, GPRS, Bluetooth, USB</li>    <li>FM радио</li>    <li>Mp3 плеер</li>    <li>Видеоплеер</li>    <li>Фотокамера: 0.3 мегапикселя</li></ul>', NULL, NULL, NULL),
(5623, 'ru', 'Мобильный телефон Fly E141 TV Dual SIM Black', '<ul><li> Дисплей TFT, 240 х 320 пикселей, 65 000 оттенков</li><li> WAP, GPRS, Bluetooth</li><li> Габариты 104 x 57 x 13.3 мм</li></ul>', '<ul>    <li>Бюджетный класс</li>    <li>Корпус моноблок</li>    <li>Антенна встроенная</li>    <li>Стандарты: GSM 900/1800/1900</li>    <li>Основной дисплей: TFT, 2.8, сенсорный, 240x320 пикселей, 65000 цветов</li>    <li>Внешний дисплей: нет</li>    <li>Полифония: 64 тона</li>    <li>Память: встроенная 45 КB, слот расширения для карт памяти microSDHC</li>    <li>Телефонная книга</li>    <li>Передача данных: GPRS, WAP, Bluetooth, USB</li>    <li>Мобильный интернет WAP 2.0</li>    <li>Фотокамера: 640x480, 0.3 мегапикселя, зум</li>    <li>FM радио</li>     </ul>', NULL, NULL, NULL),
(5624, 'ru', 'Мобильный телефон Fly E141 TV Dual SIM White', '<ul><li> Дисплей TFT, 240 х 320 пикселей, 65 000 оттенков</li><li> WAP, GPRS, Bluetooth</li><li> Габариты 104 x 57 x 13.3 мм</li></ul>', '<ul>    <li>Бюджетный класс</li>    <li>Корпус моноблок</li>    <li>Антенна встроенная</li>    <li>Стандарты: GSM 900/1800/1900</li>    <li>Основной дисплей: TFT, 2.8, сенсорный, 240x320 пикселей, 65000 цветов</li>    <li>Внешний дисплей: нет</li>    <li>Полифония: 64 тона</li>    <li>Память: встроенная 45 КB, слот расширения для карт памяти microSDHC</li>    <li>Телефонная книга</li>    <li>Передача данных: GPRS, WAP, Bluetooth, USB</li>    <li>Мобильный интернет WAP 2.0</li>    <li>Фотокамера: 640x480, 0.3 мегапикселя, зум</li>    <li>FM радио</li>     </ul>', NULL, NULL, NULL),
(5625, 'ru', 'Мобильный телефон Fly E145 TV Dual Sim Black', '<ul><li> Дисплей TFT, 3.2, 240 х 320 пикселей, 262 000 оттенков</li><li> WAP, GPRS, Bluetooth, USB</li><li> Габариты 112.5 x 62 x 11.5 мм</li></ul>', '<p>Новый гаджет от Fly, который по сложившейся доброй традиции бренда работает сразу с 2-мя SIM-картами, станет полезным подарком тем близким друзьям и родственникам, которые стараются не пропускать выпуски любимых телешоу и телепрограмм – <strong>Fly Е145 TV </strong>поддерживает функцию просмотра аналогового телевидения.</p><p>Тачфон получил аккумулятор емкостью 950 мАч, который при наличии 3,2-дюймового сенсорного экрана с разрешением 240x320 пикселей гарантирует всем пользователям до 7-и часов беспрерывной работы. Максимальное время ожидания – до 250-и часов.<br>Новинка поддерживает карты памяти microSDHC объемом до 32 ГБ, в нее также встроена FM антенна.</p><p><strong>Fly Е145 TV </strong>имеет возможность делать снимки с разрешением 1280 x 960 точек с помощью камеры 1.3 Мп, есть поддержка Bluetooth, WAP, GPRS класса 10.</p>', NULL, NULL, NULL),
(5626, 'ru', 'Мобильный телефон Fly E145 TV Dual Sim White', '<ul><li> Дисплей TFT, 3.2, 240 х 320 пикселей, 262 000 оттенков</li><li> WAP, GPRS, Bluetooth, USB</li><li> Габариты 112.5 x 62 x 11.5 мм</li></ul>', '<p>Новый гаджет от Fly, который по сложившейся доброй традиции бренда работает сразу с 2-мя SIM-картами, станет полезным подарком тем близким друзьям и родственникам, которые стараются не пропускать выпуски любимых телешоу и телепрограмм – <strong>Fly Е145 TV </strong>поддерживает функцию просмотра аналогового телевидения.</p><p>Тачфон получил аккумулятор емкостью 950 мАч, который при наличии 3,2-дюймового сенсорного экрана с разрешением 240x320 пикселей гарантирует всем пользователям до 7-и часов беспрерывной работы. Максимальное время ожидания – до 250-и часов.<br>Новинка поддерживает карты памяти microSDHC объемом до 32 ГБ, в нее также встроена FM антенна.</p><p><strong>Fly Е145 TV </strong>имеет возможность делать снимки с разрешением 1280 x 960 точек с помощью камеры 1.3 Мп, есть поддержка Bluetooth, WAP, GPRS класса 10.</p>', NULL, NULL, NULL),
(5627, 'ru', 'Мобильный телефон Fly E154 Dual Sim Black', '<ul><li> Дисплей TFT, 480 х 320 пикселей, 265000 оттенков</li><li> WAP, GPRS, Bluetooth, Wi-Fi, EDGE, USB</li><li> Габариты 114 x 62 x 10.2 мм</li></ul>', '<p><em>Представитель популярной линейки мобильных телефонов серии «Е» отличается 3.5’’ экраном, поддержкой двух SIM-карт в режиме ожидания и наличием Wi-Fi.</em></p><p>Мобильный телефон Fly E154 представляет собой тачфон, корпус которого выполнен из пластика серебристого цвета с чёрной тач-панелью, диагональю 3.5 дюйма.</p><p>Новинка оборудована стандартными разъемами – 3.5 мм и micro-USB – встроенными в верхнюю грань корпуса. На правой грани расположен переключатель громкости. 2-мегапиксельная камера находится на задней панели.</p><p>Объем внутренней памяти мобильного телефона Fly E154 составляет 50 Мб, но может быть увеличен до 32 Гб благодаря microSDHC-карте.</p><p>Мультимедиа-возможности мобильного телефона Fly E154 дополнены широким спектром возможностей доступа в Интернет: E-mail клиент, WAP, GPRS, EDGE, Wi-Fi. Особое внимание следует уделить возможности настройки режима точки доступа Wi-Fi для работы с другими мобильными устройствами. Есть поддержка Bluetooth и Java.</p><p>Fly E154 обладает функциональным мультимедиа-плеером, способным воспроизводить аудио и видео-файлы самых популярных форматов. Присутствует FM-приемник.</p><p>Батарея Fly E154 ёмкостью 1050 мАч подарит до 5 часов непрерывного общения или порядка 400 часов в режиме ожидания. Зарядное устройство подключается через micro-USB разъем.</p>', NULL, NULL, NULL),
(5628, 'ru', 'Мобильный телефон Fly E154 Dual Sim Silver', '<ul><li> Дисплей TFT, 480 х 320 пикселей, 265000 оттенков</li><li> WAP, GPRS, Bluetooth, Wi-Fi, EDGE, USB</li><li> Габариты 114 x 62 x 10.2 мм</li></ul>', '<p><em>Представитель популярной линейки мобильных телефонов серии «Е» отличается 3.5’’ экраном, поддержкой двух SIM-карт в режиме ожидания и наличием Wi-Fi.</em></p><p>Мобильный телефон Fly E154 представляет собой тачфон, корпус которого выполнен из пластика серебристого цвета с чёрной тач-панелью, диагональю 3.5 дюйма.</p><p>Новинка оборудована стандартными разъемами – 3.5 мм и micro-USB – встроенными в верхнюю грань корпуса. На правой грани расположен переключатель громкости. 2-мегапиксельная камера находится на задней панели.</p><p>Объем внутренней памяти мобильного телефона Fly E154 составляет 50 Мб, но может быть увеличен до 32 Гб благодаря microSDHC-карте.</p><p>Мультимедиа-возможности мобильного телефона Fly E154 дополнены широким спектром возможностей доступа в Интернет: E-mail клиент, WAP, GPRS, EDGE, Wi-Fi. Особое внимание следует уделить возможности настройки режима точки доступа Wi-Fi для работы с другими мобильными устройствами. Есть поддержка Bluetooth и Java.</p><p>Fly E154 обладает функциональным мультимедиа-плеером, способным воспроизводить аудио и видео-файлы самых популярных форматов. Присутствует FM-приемник.</p><p>Батарея Fly E154 ёмкостью 1050 мАч подарит до 5 часов непрерывного общения или порядка 400 часов в режиме ожидания. Зарядное устройство подключается через micro-USB разъем.</p>', NULL, NULL, NULL),
(5629, 'ru', 'Мобильный телефон Fly E171 Duos High Glossy Black', '<ul><li> Дисплей TFT, 240 x 400 пикселей, 262144 оттенков</li><li> WAP, GPRS, EDGE, Bluetooth, USB, Wi-Fi</li><li> Габариты 111 х 54 х 12.8 мм</li></ul>', '<!--more--><p>Для всех, кто жаждет общения и хочет быть на связи всегда и везде, бренд Fly создал новый Fly E171 Wi-Fi стильный тонкий моноблок с металлическими линиями окантовки. Fly E171 Wi-Fi – легкий и компактный, его вес составляет всего 95 грамм. Как и все модели Fly, данный телефон поддерживает две SIM-карты в режиме ожидания.</p><p>Fly E171 Wi-Fi – настоящий мультимедийный телефон. Пользователи несомненно оценят его функциональность, неограниченные возможности для общения в сети, эргономичное меню и стильный дизайн. Fly E171 Wi-Fi оборудован встроенной 3.2 –мегапиксельной камерой с разрешением 2048x1536 пикселей, цифровым зумом и функцией записи видео, а также WEB-камерой. Модель поддерживает карты MicroSDHC размером до 16 GB. Для виртуального общения в модели Fly E171 Wi-Fi предусмотрено наличие модуля Wi-Fi, E-mail клиента, WAP 2.0 и GPRS модема, также телефон поддерживает JAVA.</p><p>Аудиоплейер с FM тюнером способен воспроизводить до 10 часов музыки беспрерывно,  аккумулятор телефона держит заряд до 5.5 часов в режиме разговора и до 150 часов в режиме ожидания.</p><p>Fly E171 Wi-Fi – предлагает широкий набор традиционных функций, в нем есть органайзер с функциями напоминания, задач, конвертером валют, календарем, будильником и калькулятором, а также телефонная книга с памятью на 1000 номеров и дополнительной памятью двух сим-карт. Fly E171 Wi-Fi оборудован специальной кнопкой экстренного вызова Emergency SOS Dailing. </p><!--more-->', NULL, NULL, NULL),
(5630, 'ru', 'Мобильный телефон Fly E190 Duos Wi-Fi Black', '<ul><li> Дисплей TFT, 480 x 320 пикселей</li><li> GPRS, EDGE, WAP, Wi-Fi, USB, Bluetooth</li><li> Габариты 116 х 62.5 х 11.6 мм</li></ul>', '<p>Fly E190 Wi-Fi обладает прекрасными мультимедийными возможностями и станет отличным бизнес- помощником. Для любителей интернет общения в модели Fly E190 Wi-Fi предусмотрено наличие электронной почты, IM, браузера Opera Mini и Wi-Fi модуля, предлагая пользователю отличные возможности для интернет серфинга. Также для передачи данных в модели Fly E190 Wi-Fi предусмотрены такие технологии, как Bluetooth 2.1, WAP, GPRS модем, EDGE и вэб – камера. Модель поддерживает Java.<br><br>3.5 дюймовый TFT экран занимает почти всю лицевую часть поверхности модели. Оригинальное  главное меню представлено в нескольких форматах и может меняться по желанию пользователя – от стандартного матричного вида до  красочного живого вихря, меняющего форму. Галерея ярких изображений, настраиваемый интерфейс с возможностью быстрого перехода, возможность установить живые обои, а также различные виджеты интернет-приложений делают общение с телефоном еще более приятным.<br><br>Экран позволяет с комфортом читать электронные книги, просматривать фотографии, снятые на встроенную 3.2 - мегапиксельную камеру с цифровым зумом или видеоролики, записанные в формате MP4, 3GP, AVI.<br>При габаритах 116 х 62.5 х 11.6 мм Fly E190 Wi-Fi весит 168 гр. Благодаря емкому источнику питания, аппарат способен работать до 6 часов в режиме разговора и до 400 часов в режиме ожидания. Телефон оснащен аудио-плеером с разъемом для наушников 3.5 мм и FM приемником. Объем внутренней памяти аппарата составляет 43.8 MB и может быть увеличен до 32 GB, благодаря поддержке карт формата microSDHC, что позволяет с легкостью хранить данные.<br><br>Fly E190 Wi-Fi обладает широким набором бизнес функций, являясь надежным помощником в ежедневных делах, в этом ему помогает встроенный органайзер с функциями напоминания, создания и редактирования заметок и задач, конвертером валют и единиц, календарем, будильником и калькулятором, а также телефонная книга в виде визиток с памятью на 1000 ячеек и памятью 2-х SIM-карт.<br> </p>', NULL, NULL, NULL),
(5596, 'ru', 'Мобильный телефон Alcatel DS 10.60 Dual SIM', '<ul><li> Дисплей QVGA, 1.8, 128 х 160 пикселей, 65 000 оттенков</li><li> GPRS, Bluetooth</li><li> Габариты 107 x 46 x 12 мм</li></ul>', '<ul>    <li>Дисплей QVGA, 1.8, 128 х 160 пикселей, 65 000 оттенков</li>    <li>GPRS, Bluetooth</li>    <li>Габариты: 107 x 46 x 12 мм</li>    <li>Диктофон</li>    <li>Black list</li></ul>', NULL, NULL, NULL),
(5602, 'ru', 'Мобильный телефон Fly DS103D Duos Black', '<ul><li> Дисплей TFT, 128 х 160 пикселей, 262 000 оттенков</li><li> USB</li><li> Габариты 110 х 46.5 х 15.4 мм</li></ul>', '<ul>    <li>Поддержка двух SIM-карт</li>    <li>Телефон с классическим корпусом</li>    <li>Диагональ экрана 1.77 , разрешение 128 x 160</li>    <li>Без камеры</li>    <li>Карты памяти micro SDHC до 32 GB</li>    <li>MP3-проигрыватель, радиоприемник</li></ul>', NULL, NULL, NULL),
(5603, 'ru', 'Мобильный телефон Fly B300 Duos Grey', '<ul><li> Дисплей TFT, 240 х 320 пикселей, 262000оттенков</li><li> WAP, GPRS, Bluetooth</li><li> Габариты 115.85 х 51 х 11.3 мм</li></ul>', '<p>Fly B300 разработан для деловых людей, ценящих элегантный дизайн и функциональность мобильного телефона. Аппарат выполнен в форме классического моноблока из черного пластика. На лицевой панели расположены удобную клавиатуру с выделенным блоком функциональных клавиш. Обратная панель корпуса имеет покрытие soft-touch, а также удобный выступ в нижней части крышки, благодаря которому аппарат удобно располагается в руке.<br>В верхней грани Fly B300 расположены разъем 3.5 мм для наушников. Что касается micro-USB, - он прикрыт заглушкой и расположен на правой грани - между переключателем громкости и кнопкой спуска затвора камеры.<br> <br>Новинка может похвастаться наличием встроенного звукового процессора Yamaha, благодаря которому пользователи смогут в полном объеме насладиться звучанием любимых композиций. Камера 3.2 Мпикс. оборудована цифровым зумом и позволяет записывать видео. В аппарате присутствуют аудио-и видео-плеер, способные воспроизводить файлы популярных форматов. К тому же можно расширить возможности хранения данных благодаря поддержке карт памяти microSDHC.<br> <br>Как и положено мобильному телефону бизнес-класса, Fly B300 предлагает широкий набор возможностей для работы с мобильным Интернетом: WAP-доступ и GPRS-модем, EDGE, Bluetooth и поддержку Java. Кроме того, пользователь получит набор приложений Fly: buzz. В телефоне используется браузер Opera Mobile, а для синхронизации контактов предусмотрена функция SyncML.<br> <br>Батарея Fly B300 позволит в течение 4 часов работать в режиме разговора или 220 часов находиться в режиме ожидания.</p>', NULL, NULL, NULL),
(5604, 'ru', 'Мобильный телефон Fly DS103 Duos Grey', '<ul><li> Дисплей TFT, 128 x 160 пикселей</li><li> Габариты 110 х 46.5 х 15.4 мм</li></ul>', '<p>Мобильный телефон на 2 карты в аскетичном и удобном корпусе - идеальное решение для деловых и уверенных в себе людей.</p><p><strong>Органайзер:</strong></p><ul>    <li>Календарь</li>    <li>Будильник</li>    <li>Задания</li>    <li>Напоминания</li>    <li>Калькулятор</li>    <li>Мировое время</li></ul><p> </p>', NULL, NULL, NULL),
(5605, 'ru', 'Мобильный телефон Fly E185 Black Bronze', '<ul><li> Дисплей TFT, 240 х 400 пикселей, 262000 оттенков</li><li> WAP, GPRS, EDGE, Bluetooth, USB</li><li> Габариты 107.8 x 53.6 x 12.6 мм</li></ul>', '<p>Fly E185 выполнен в классической форме моноблока с резистивным сенсорным экраном и единственной функциональной клавишей на лицевой панели. Телефон отличается полукруглыми формами верхней и нижней кромки, которая придает гаджету компактности. На обратной стороне телефона расположена камера 3.2 Мпкс.<br> <br>Fly E185 отличается традиционным для аппаратов этой линейки набором мультимедийных возможностей. Аудио и видеоплеер позволят воспроизвести файлы большинства популярных форматов. Фотокамера с цифровым зумом позволит выбрать эффекты для концептуальной съемки. А наличие слота для карт памяти формата SDHC превратит Fly E185 в удобную и достаточно вместительную «флэшку». Для любителей почитать новинка была оборудована программой для чтения электронных книг, E-book.<br> <br>Наличие WAP-доступа, GPRS-модема и EDGE открывает путь к непрерывной работе с мобильным интернетом. Удобными помощниками в этом деле станут также предустановленные браузер OperaMini, E-mail клиент, Java, а также IM для работы с социальными сетями.<br> <br>Телефонная книга с памятью на 500 номеров, в случае необходимости, может быть удобно синхронизирована благодаря программе SyncML.<br> <br>Новинка Fly E185 порадует владельца универсальными разъемами micro USB и 3.5 мм для наушников.<br>а батарея емкостью 1000 мАч подарит до 4 часов непрервного общения или около 500 часов в режиме ожидания.</p>', NULL, NULL, NULL),
(5606, 'ru', 'Мобильный телефон Fly E176 Duos Silver', '<ul><li> Дисплей TFT, 240 х 320 пикселей, 262144 оттенков</li><li> WAP, GPRS, Bluetooth, EDGE, USB</li><li> Габариты 114 x 49 x 10.8 мм</li></ul>', '<p>Fly E176 создан как мультимедийный аппарат с массой положительных способностей. Одно из самых заметных - его внешность: разработчики поместили Fly E176 в стальной стильный корпус, придав аппарату фантастический загадочный вид. Создается впечатление, что в руках держишь не мобильный телефон, а миниатюрную ракету. И ты осознаешь это уже тогда, когда видишь его впервые. Познакомившись поближе, понимаешь: ты был прав, сравнив Fly E176 с ракетой. Потому как работоспособность у этого металлизированного аппарата хорошая, да и функционалом он наполнен более чем.</p><p>TFT дисплей Fly E176, занимая большую половину лица телефона, напоминает 2.4-дюймовый иллюминатор, отражающий более 260 тысяч цветов. На таком окошке просмотр видео и фото становится увлекательнее и ярче. Встроенной памяти немного, но общий объем может доходить до 16 GB за счет употребления карт памяти microSDHC. В качестве топлива в телефоне используется емкий аккумулятор, благодаря которому ваши разговоры продлятся до 8 часов, а в режиме ожидания аппарат может пребывать до 250 часов.</p><p>Как же в ракете без возможности пофотографировать? Во Fly E176 встроена 2-мегапиксельная фотокамера 1600x1200 пикселей с цифровым зумом и разнообразными режимами и эффектами, есть веб-камера для общения с друзьями. <br>Среди развлечений, в телефоне Fly E176 предусмотрены аудиоплеер с усилителем Yamaha и SRS WOW HD, FM-радио, видеоплеер, JAVA, интернет. Кроме того, Fly E176 поддерживает работу двух SIM-карт в режиме ожидания.</p>', NULL, NULL, NULL),
(5775, 'ru', 'Аккумулятор Samsung EB-F1A2GBUCSTD I9100 Black', '<ul><li> Аккумулятор Li-Ion</li><li> Емкость 1650 mAh</li></ul>', '<p>Аккумуляторная батарея для Samsung Galaxy S II (I9100) на 1650 mAh</p><ul>    <li>Тип: Li-Ion</li>    <li>Емкость: 1650 mAh</li>    <li>Совместимость: <a>Samsung Galaxy S II (I9100) </a></li></ul>', NULL, NULL, NULL),
(6192, 'ru', 'Аккумулятор Samsung EB-K1A2EBEGSTD Black', '<ul><li> Для мобильного телефона Samsung I9100</li><li> Емкость 2000 mAh</li></ul>', '<p>Аккумулятор Samsung EB-K1A2EBEGSTD для мобильного телефона Samsung <a>I9100</a>. Емкость 2000 mAh</p>', NULL, NULL, NULL),
(6193, 'ru', 'Аккумулятор Samsung EB-K1A2EWEGSTD White', '<ul>\n<li>Для мобильного телефона Samsung I9100</li>\n<li>Емкость 2000 mAh</li>\n</ul>', '<p>Аккумулятор Samsung EB-K1A2EBEGSTD для мобильного телефона Samsung <a>I9100</a>. Емкость 2000 mAh</p>', '', '', ''),
(6194, 'ru', 'Аккумулятор Samsung EB-L1F2HVUCSTD Black I9250', '<ul><li> Аккумулятор Li-Ion</li><li> Емкость 1750 mA</li></ul>', '<p>Аккумуляторная батарея для Galaxy Nexus на 1750 мА/ч.</p>', NULL, NULL, NULL),
(6195, 'ru', 'Аккумулятор Samsung EB-L1G6LLUCSTD I9300 Black', '<ul><li> Аккумулятор Li-Ion</li><li> Емкость 2100 mAh</li></ul>', '<p><strong>Аккумуляторная батарея Samsung EB-L1G6LLUCSTD Black I9300</strong></p><ul>    <li>Совместимость: <a>Samsung Galaxy S III (I9300)</a></li>    <li>Емкость: 2100 mAh</li>    <li>Напряжение: 3.8 V</li></ul><p> </p>', NULL, NULL, NULL),
(6196, 'ru', 'Аккумулятор Samsung EB595675LUCSTD N7100 Black', '<ul><li> Аккумулятор Li-Ion</li><li> Емкость 3100 mAh</li></ul>', '<ul>    <li>Совместимость: <a>Samsung Galaxy Note II (N7100)</a></li>    <li>Емкость: 3100 mAh</li></ul>', NULL, NULL, NULL),
(6197, 'ru', 'Аккумулятор Samsung EB615268VUCSTD Black N7000', '<ul><li> Аккумулятор Li-Ion</li><li> Емкость 2500 mA</li></ul>', '<p>Аккумуляторная батарея для Galaxy Note на 2500 мА/ч.</p>', NULL, NULL, NULL),
(6198, 'ru', 'Автомобильное зарядное устройство Samsung ECA-P10CBECSTD Black', '<ul><li> Работа при напряжении 12-24V, 2 А</li><li> Адаптер питания от прикуривателя планшетов Samsung с разъемом 30pin</li></ul>', '<p><strong>Ключевые характеристики:</strong></p><ul>    <li>Совместим с: Galaxy Tab 10.1, Galaxy Tab 8.9, Galaxy Tab 7.0</li>    <li>Комплект поставки: USB Data кабель</li>    <li>Размеры: 30.5 x 30.5 x 88.7 мм</li></ul>', NULL, NULL, NULL),
(6199, 'ru', 'Зарядное устройство Samsung ECA-U16CBEGSTD N7000 Black', '<ul><li> Работа при напряжении 100-240V 50-60Hz </li><li> Автомобильное зарядное устройство</li></ul>', '<p>Зарядка для Galaxy Note, разъем Micro USB, ток зарядки 1000mA, 5В</p>', NULL, NULL, NULL),
(6200, 'ru', 'Зарядное устройство Samsung ETA-P11EBEGSTD Galaxy P3100/P5100/N8000 Black', '<ul><li> Работа при напряжении 100-240V, 2 А</li></ul>', '<p>Сетевое зарядное устройство для планшетных компьютеров Samsung. Компактное и практичное устройство для дома и поездок. С разъемом USB.</p><p><strong>Совместимость:</strong> Samsung <a>Galaxy Tab 2 7.0 (P3100)</a>, <a>Galaxy Tab 2 10.1 (P5100)</a>, <a>Galaxy Note 10.1 (N8000)</a><br> </p>', NULL, NULL, NULL),
(6201, 'ru', 'Зарядное устройство Samsung ETA-U90EBEGSTD N7100 Black', '<ul><li> Работа при напряжении в диапазоне 100V-240V</li><li> Для зарядки Galaxy Note N7100</li></ul>', '<ul>    <li>Зарядка, разъем Micro USB, ток зарядки 2000mA</li>    <li>Совместимость: <a>Samsung Galaxy Note II (N7100)</a></li></ul>', NULL, NULL, NULL),
(6202, 'ru', 'Зарядное устройство Samsung ETA-U90EWEGSTD N7100 White', '<ul><li> Работа при напряжении в диапазоне 100V-240V</li><li> Для зарядки Galaxy Note N7100</li></ul>', '<ul>    <li>Зарядка, разъем Micro USB, ток зарядки 2000mA</li>    <li>Совместимость: <a>Samsung Galaxy Note II (N7100)</a></li></ul>', NULL, NULL, NULL),
(6203, 'ru', 'Зарядное устройство Samsung ETA0U10EBECSTD Black', '<ul><li> Работа при напряжении 100-240V 50-60H</li></ul>', '<ul>    <li>Универсальное сетевое зарядное устройство для мобильных телефонов Samsung с разъемом micro USB</li>    <li>Ток зарядки 700 mA</li>    <li>Energy Star 4</li></ul>', NULL, NULL, NULL),
(6204, 'ru', 'Зарядное устройство Samsung ETA0U80EBEGSTD Black N7000', '<ul><li> Работа при напряжении в диапазоне 100V-240V</li><li> Для зарядки Galaxy Note N7000</li></ul>', '<p>Зарядка для Galaxy Note, разъем Micro USB, ток зарядки 1000mA.</p>', NULL, NULL, NULL),
(6205, 'ru', 'Зарядное устройство UFO EC-004 5V (+ 2 адаптора Nokia Kit)', '<ul><li> Для зарядки мобильных телефонов</li><li> В комплект входит 2 адаптора для Nokia 3310 и 6111</li></ul>', 'Скоростное зарядное устройство мобильных телефонов, берущее энергию от разряда аккумулятора AA, без подключения к элетросети 220В, в комплекте 2 коннектора для Nokia 3310 и 6111', NULL, NULL, NULL),
(6206, 'ru', 'Зарядное устройство-подставка Samsung EDD-D100WEGSTD TAB/TAB2 desktop dock White', '<ul><li>Зарядное устройство-подставка Galaxy TAB/TAB2/NOTE 10.1</li></ul>', '<ul>    <li>Интерфейс 1: 30-контактный</li>    <li>Интерфейс 2: 3.5 мм аудио линейный выход</li>    <li>Цвет: белый</li></ul>', NULL, NULL, NULL),
(6207, 'ru', 'Подставка с зарядным устройством Samsung EBH1A2USBECSTD Black', '<ul><li> Для зарядки Samsung GT-I9100 Galaxy S2 </li></ul>', '<ul>    <li>Для зарядки Samsung GT-I9100 Galaxy S2</li>    <li>Цвет: черный</li>    <li>Вес: 45 г.</li>    <li>Габариты: 12.6 х 58.45 х 104.9 мм</li></ul>', NULL, NULL, NULL),
(6208, 'ru', 'Подставка-держатель Samsung EB-H1J9VNEGSTD N7100 White (+ аккумулятор)', '<ul><li>Подставка-держатель для телефона с возможностью зарядки дополнительного аккумулятора</li><li><i>В комплекте аккумулятор</i></li></ul>', '<ul>    <li>Аккумулятор емкостью 3100 mAh в комплекте;</li>    <li>Отличное решение для тех, кто любит постоянно быть на связи и имеет более одного аккумулятора для Galaxy Note 2 (N7100);</li>    <li>Данный аксессуар быстро и беспрепятственно зарядит Ваш дополнительный аккумулятор;</li>    <li>Зарядное устройство совместимо с аккумулятором Galaxy Note 2 (N7100);</li>    <li>Встроенный microUSB порт позволит использовать стандартное сетевое устройство, которое идет в комплекте с Galaxy Note 2 (N7100);</li>    <li>Возможно использовать в качестве подставки для <a>Galaxy Note 2 (N7100)</a>.</li></ul>', NULL, NULL, NULL),
(6211, 'ru', 'Гарнитура HTC RC E240 Black', '<ul><li> С проводом</li><li><i>Черный цвет</i></li></ul>', '<p><strong>Совершенство каждой ноты</strong></p><p>Технология шумоподавления, а также эксклюзивный встроенный аудиопрофиль HTC обеспечивают насыщенный, естественный звук, который в достоверности воспроизводит каждую ноту оригинальной композиции. Голосовая связь при вызовах на твоем телефоне также кристально чистая</p><p><strong>Непревзойденная производительность</strong></p><p>Тонкие, плоские кабели стереонаушников сводят на нет постоянно мешающиеся узлы и перекрутки кабелей, так что ничего не помешает тебе слушать восхитительный звук на твоем телефоне HTC</p><p><strong>Удобство управления прямо на кабеле</strong></p><p>Трехкнопочное управление на самом кабеле упрощает воспроизведение и приостановку музыки, ответы и завершение вызовов и регулировку громкости. Можно даже перематывать вперед и назад, не касаясь телефона</p>', NULL, NULL, NULL),
(6212, 'ru', 'Гарнитура HTC RC E240 White', '<ul><li> С проводом</li><li><i>Белый цвет</i></li></ul>', '<p><strong>Совершенство каждой ноты</strong></p><p>Технология шумоподавления, а также эксклюзивный встроенный аудиопрофиль HTC обеспечивают насыщенный, естественный звук, который в достоверности воспроизводит каждую ноту оригинальной композиции. Голосовая связь при вызовах на твоем телефоне также кристально чистая</p><p><strong>Непревзойденная производительность</strong></p><p>Тонкие, плоские кабели стереонаушников сводят на нет постоянно мешающиеся узлы и перекрутки кабелей, так что ничего не помешает тебе слушать восхитительный звук на твоем телефоне HTC</p><p><strong>Удобство управления прямо на кабеле</strong></p><p>Трехкнопочное управление на самом кабеле упрощает воспроизведение и приостановку музыки, ответы и завершение вызовов и регулировку громкости. Можно даже перематывать вперед и назад, не касаясь телефона</p>', NULL, NULL, NULL),
(6215, 'ru', 'Гарнитура Samsung EHS60ANNBECSTD Black', '<ul><li> С проводом</li><li><i>Черный цвет</i></li></ul>', '<p>Проводная стереогарнитура предназначена для работы с телефонами Samsung</p>', NULL, NULL, NULL),
(6216, 'ru', 'Гарнитура Samsung EHS60ANNWECSTD White', '<ul><li> С проводом</li><li><i>Белый цвет</i></li></ul>', '<ul>    <li>Гарнитура проводная канального типа</li>    <li>Разъем 3.5 мм</li>    <li>Микрофон</li></ul>', NULL, NULL, NULL),
(6217, 'ru', 'Гарнитура Samsung EHS60ENNBECSTD Black', '<ul><li> С проводом</li><li><i>Черный цвет</i></li></ul>', '<ul>    <li>Цвет: черный, белый</li>    <li>Разъем: 3.5 мм разъем</li>    <li>Канального типа</li>    <li>Тонкий микрофон</li>    <li>Толщина провода 2.4 мм</li></ul>', NULL, NULL, NULL),
(6218, 'ru', 'Гарнитура Samsung EHS60ENNWECSTD White', '<ul><li> С проводом</li><li><i>Белый цвет</i></li></ul>', '<ul>    <li>Цвет: черный, белый</li>    <li>Разъем: 3.5 мм разъем</li>    <li>Канального типа</li>    <li>Тонкий микрофон</li>    <li>Толщина провода 2.4 мм</li></ul>', NULL, NULL, NULL),
(6219, 'ru', 'Гарнитура Samsung EHS62ASNKECSTD Blue', '<ul><li> С проводом</li><li><i>Сине-белый цвет</i></li></ul>', '<ul>    <li>Тип: Стерео-гарнитура</li>    <li>Цвета: синий с белым, розовый с белым</li>    <li>Разъем: 3.5 мм разъем</li>    <li>Канального типа</li>    <li>Тонкий микрофон</li>    <li>Толщина провода 2.4 мм</li>    <li>Импеданс: 32 Ом</li></ul>', NULL, NULL, NULL),
(6220, 'ru', 'Гарнитура Samsung EHS62ASNPECSTD Pink', '<ul><li> С проводом</li><li><i>Розово-белый цвет</i></li></ul>', '<ul>    <li>Тип: Стерео-гарнитура</li>    <li>Цвета: синий с белым, розовый с белым</li>    <li>Разъем: 3.5 мм разъем</li>    <li>Канального типа</li>    <li>Тонкий микрофон</li>    <li>Толщина провода 2.4 мм</li>    <li>Импеданс: 32 Ом</li></ul>', NULL, NULL, NULL),
(6221, 'ru', 'Гарнитура Samsung EHS62ASNWECSTD White', '<ul><li> С проводом</li></ul>', '<p>Проводная гарнитура канального типа</p><ul>    <li>Разъем – 3.5 мм, 4 pin</li>    <li>Тонкий микрофон</li>    <li>Импеданс – 32 Ом<br>     </li></ul>', NULL, NULL, NULL),
(6222, 'ru', 'Гарнитура Samsung EHS63ASNBECSTD Black', '<ul><li> С проводом</li><li><i>Черный цвет</i></li></ul>', '<ul>    <li>Цвет: черный, белый</li>    <li>Разъем: 3.5 мм разъем </li>    <li>Гибридного типа</li>    <li>Тонкий микрофон</li></ul>', NULL, NULL, NULL),
(6223, 'ru', 'Гарнитура Samsung EHS64ASFWECSTD White', '<ul><li> С проводом</li><li><i>Белый цвет</i></li></ul>', '<p>Цвет: черный, белый <br>Разъем: 3.5 мм разъем <br>Гибридного типа <br>Тонкий микрофон <br>Толщина провода: 2.1 мм</p>', NULL, NULL, NULL),
(6224, 'ru', 'Гарнитура Jabra Bluetooth Headset  BT 2015', '<ul><li> Беспроводной</li><li> В режиме разговора: до 7 часов</li><li> В режиме ожидания: до 200 часов</li></ul>', '<font>Бюджетная Bluetooth гарнитура выполнена в классическом дизайне. Данная разработка оснащена минимальным набором функций. Спецификации: Bluetooth 2.0/Hands-Free/Headset, максимальная дальность устойчивой связи составляет 10 метров от мобильного телефона; встроенный аккумулятор позволяет гарнитуре работать в режиме разговора до 7 часов, в режиме ожидания до 200 часов; вес устройства составляет 11 грамм.<br></font>', NULL, NULL, NULL),
(6225, 'ru', 'Гарнитура Jabra Bluetooth Headset  BT 2070', '<ul><li> Беспроводной</li><li> В режиме разговора: до 5.5 часов</li><li> В режиме ожидания: до 200 часов</li></ul>', '<p><strong><font>Стильный способ разговора по телефону</font></strong></p><p><font>Гарнитура Jabra BT2070 имеет оригинальный внешний вид, рассчитанный на людей, желающих пробрести что-либо неординарное. Эта уникальная гарнитура с интригующим дизайном, сформированным на основе желтого круга с подсветкой, которая включается при поступлении входящих вызовов.</font></p><p><font>Характеристики BT2070 хороши настолько же, насколько оригинален ее дизайн; гарнитура обладает простыми функциональными возможностями и источником питания повышенной емкости. Простой 3-кнопочный интерфейс управления обеспечивает удобство подключения и управления гарнитурой. Начните работу с гарнитурой с автоматического установления соединения и прикоснитесь к кругу для разговора по телефону. Аккумулятор этой компактной гарнитуры имеет большую емкость, время работы гарнитуры впечатляет - ее можно использовать с удобством и комфортом на протяжении всего дня.</font></p><p><font>Оригинальный дизайн и высокое качество обеспечивают привлекательность беспроводной гарнитуры Jabra BT2070, предлагающей стильный способ разговоров по телефону.<br></font> <br> <br></p>', NULL, NULL, NULL),
(14199, 'ru', 'Гарнитура Bluetooth Nokia BH-111 black', '<p><span>Стерео, вакуумные вкладыши, время работы в режиме разговора - 7 часов., Время работы в режиме ожидания - 120 час., Bluetooth 2.1 (+ EDR), AVRCP, A2DP, Headset, Handsfree, макс. Дальность связи - 10м, вес 15 , 5 г, black</span></p>', '<table class="pp-tab-characteristics-table">\n<tbody>\n<tr class="color">\n<td class="title">Спецификация Bluetooth</td>\n<td class="field">Bluetooth 2.1 EDR<br />Handsfree (HFP) 1.5<br />Headset (HSP) 1.0<br />A2DP 1.2<br />AVRCP 1.0</td>\n</tr>\n<tr>\n<td class="title">Максимальная дальность связи</td>\n<td class="field">10 м</td>\n</tr>\n<tr class="color">\n<td class="title">Разъем</td>\n<td class="field">2.5 мм</td>\n</tr>\n<tr>\n<td class="title">Время работы от батареи</td>\n<td class="field">В режиме разговора: до 7 часов<br />В режиме проигрывания музыки: до 6 часов<br />В режиме ожидания: до 120 часов</td>\n</tr>\n<tr class="color">\n<td class="title">Размеры (ВxШxГ), мм</td>\n<td class="field">48 x 37.6 x 12.8</td>\n</tr>\n<tr>\n<td class="title">Вес</td>\n<td class="field">15.5 г (основное устройство)<br />9.5 г (наушники)</td>\n</tr>\n<tr class="color">\n<td class="title">Гарантия</td>\n<td class="field">6 месяцев</td>\n</tr>\n<tr>\n<td class="title">Цвет</td>\n<td class="field">Black<span id="copyinfo"><br /><br /></span></td>\n</tr>\n</tbody>\n</table>', NULL, NULL, NULL),
(6226, 'ru', 'Гарнитура Nokia Bluetooth Headset BH-104 Black', '<ul><li> Беспроводной</li><li> В режиме разговора: до 10 часов</li><li> В режиме ожидания: до 200 часов</li><li><i>Черный цвет</i></li></ul>', '<font>Nokia BH-104 идеально сочетает в себе отличные характеристики, дизайн и невысокую цену. Устройство обладает небольшими размерами: 48.2 x 22.7 x 16.35 мм, вес без дужки - тринадцать грамм. Гарнитура поддерживает профиль Bluetooth 2.1 c EDR. <br></font>', NULL, NULL, NULL);
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(6227, 'ru', 'Гарнитура  Nokia Headset Bluetooth BH-110 Black', '<ul><li> Беспроводной</li><li> В режиме разговора: до 6 часов</li></ul>', '<p><strong>Nokia BH-110 - гарнитура для каждого.</strong></p><p>Общайтесь в режиме свободные руки с этой Bluetooth-гарнитурой. Она удобна в использовании, и Вы можете разговаривать, не останавливаясь. Подключайте одну гарнитуру к служебному и домашнему телефону одновременно, ведь устройство оснащено усовершенствованным многоканальным разъемом. Компактный дизайн обеспечивает простоту использования - Вы получаете полный контроль только с помощью одной мультифункциональной кнопки, а благодаря отличному дизайну ушной петли и ушной вкладки Вы можете долго и комфортно разговаривать, где бы Вы не находились.</p>', NULL, NULL, NULL),
(6228, 'ru', 'Гарнитура Nokia Headset Bluetooth BH-110 White', '<ul><li> Беспроводной</li><li> В режиме разговора: до 6 часов</li></ul>', '<p><strong>Nokia BH-110 - гарнитура для каждого.</strong></p><p>Общайтесь в режиме свободные руки с этой Bluetooth-гарнитурой. Она удобна в использовании, и Вы можете разговаривать, не останавливаясь. Подключайте одну гарнитуру к служебному и домашнему телефону одновременно, ведь устройство оснащено усовершенствованным многоканальным разъемом. Компактный дизайн обеспечивает простоту использования - Вы получаете полный контроль только с помощью одной мультифункциональной кнопки, а благодаря отличному дизайну ушной петли и ушной вкладки Вы можете долго и комфортно разговаривать, где бы Вы не находились.</p>', NULL, NULL, NULL),
(6229, 'ru', 'Гарнитура Samsung AWEP460EBEGSEK Black Bluetooth Headset', '<ul><li> Беспроводная</li><li> В режиме разговора: 8 часов</li><li> В режиме ожидания: 180 часов</li></ul>', '<p>Блютус гарнитура. Bluetooth 2.0+EDR<br>Время работы от батареи: В режиме разговора: до 8 часов<br>В режиме ожидания: до 180 часов<br>Вес: 12 гр</p>', NULL, NULL, NULL),
(6230, 'ru', 'Гарнитура  Samsung BHM1200EBEGSEK Black', '<ul><li> Беспроводная</li><li> В режиме разговора: 8 часов</li><li> В режиме ожидания: 300 часов</li></ul>', '<p>Bluetooth-моногарнитура <strong>HM1200 </strong>- это сочетание удобства, простоты и качества. Она отличается удобством в управлении и компактным стильным дизайном. При этом модель обеспечивает высочайшую четкость передачи голоса, которой славятся гарнитуры Samsung.</p><p><strong>Дизайн</strong><br>Гарнитура HM1200 отлично выглядит и проста в использовании. Светодиодный индикатор заряда батареи и отдельная кнопка включения/выключения помогают продлить время работы гарнитуры от аккумулятора.</p><p><strong>Технология Multipoint</strong><br>Благодаря технологии Multipoint гарнитуру HM1200 можно связать с двумя Bluetooth-телефонами одновременно. Это очень пригодится тем пользователям, которые пользуются двумя телефонами.</p><p><strong>Активное подключение</strong><br>Функция активного подключения (Active Pairing) позволяет гарнитуре автоматически устанавливать соединение с другими Bluetooth-устройствами.</p>', NULL, NULL, NULL),
(6843, 'ru', 'Док-станция Samsung EDD-D1E1BEGSTD Black', '<ul><li>Док-станция для Samsung Galaxy Note</li></ul>', '<p>Настольная подставка с возможностью зарядки, вертикальным и горизонтальным размещением телефона, стерео аудио выходом</p>', NULL, NULL, NULL),
(6844, 'ru', 'Док-станция Samsung EDD-H1F2BEGSTD Black I9250', '<ul><li> Док-станция с HDMI выходом и возможностью подзарядки и синхронизации</li></ul>', '<p>Настольная подставка с HDMI выходом и возможностью подзарядки и синхронизации.</p>', NULL, NULL, NULL),
(8431, 'ru', 'Вкладыш для спального мешка EASY CAMP Cotton Travel Sheet - Rectangular', 'Материал: 100% cotton\r\nВес: 360 гр\r\nРазмер: 80x210 мм\r\nРазмер в упаковке: 160x90х90 мм', 'Cotton Rectangular можно использовать в качестве вкладыша в спальный мешок, чтобы добавить тепла и сохранить внутреннюю часть спальника чистой, или его можно использовать сам по себе в качестве простыни. Во время путешествий в далекие края, иметь своё собственное постельное бельё часто является хорошей идеей из соображений гигиены, а также просто для удобства.\r\n Особенности:\r\nсекретный карман для безопасного хранения мелких ценных вещей\r\nлегкий и компактный, повышает комфорт\r\nпоставляется с мешочком из материала ripstop', NULL, NULL, NULL),
(13890, 'ru', 'Карта памяти Transcend microSDHC 32 GB Class 10 UHS-I Ultimate (X600) (+ адаптер)', '<ul><li><i>Емкость 32 GB<br></i></li><li>В комплекте адаптер</li></ul>', '<p>Карты памяти Transcend microSDHC UHS-I с поддержкой спецификации Ultra High Speed Class 1 созданы специально, чтобы улучшить качество работы со смартфонами и планшетами. Карты памяти используют технологию последнего поколения и гарантируют максимально возможный уровень производительности при работе активно задействующих память мобильных приложений и игр, а также обеспечивают плавную запись и воспроизведение видео в разрешении Full HD.</p><ul>    <li>Поддержка спецификации Ultra High Speed Class 1 (U1)</li>    <li>Совместимость с Class 10 </li>    <li>Полная совместимость со стандартом SD 3.01</li>    <li>Просты в использовании, подключение plug and play</li>    <li>Технология коррекции ошибок (ECC) для обнаружения и исправления ошибок при передаче данных</li>    <li>Поддержка автоматической активации режимов ожидания и сна, а также автоотключения</li>    <li>Отвечает RoHS</li></ul>', NULL, NULL, NULL),
(8430, 'ru', 'Вкладыш для спального мешка EASY CAMP Cotton Travel Sheet - Mummy', 'Размер: 210х75х50 см\r\nДлина тела: 190 см\r\nТкань: поликоттон, 20% хлопок  80% полиэстер\r\nРазмер упак.: 15х7 см\r\nВес: 240 г\r\nОсобенности:\r\n Компактная упаковка\r\nСохраняет спальный мешок чистым\r\nМягкая ткань\r\nФорма "кокон"', 'Для дополнительной защиты спального мешка и личной гигиены рекомендуется использование вкладышей для любой конструкции спальных мешков. Эти удобные вкладыши легко стирать и в тоже время держать свой спальный мешок чистым. Станет хорошим дополнением к спальному мешку формы "кокон".Артикул: 340693\r\nРазмер: 210х75х50 см\r\nДлина тела: 190 см\r\nТкань: поликоттон, 20% хлопок  80% полиэстер\r\nРазмер упак.: 15х7 см\r\nВес: 240 г\r\nОсобенности:\r\n Компактная упаковка\r\nСохраняет спальный мешок чистым\r\nМягкая ткань\r\nФорма "кокон"', NULL, NULL, NULL),
(7976, 'ru', 'MP3-флэш плеер Ergo Zen Basic 8 GB Black', '<ul><li> Встроенная память 8 GB</li><li> ЖК-дисплей </li><li> FM радио</li></ul>', '<p>Компания Ergo в очередной раз решила порадовать меломанов, выпустив на рынок новинку - MP3-флэш плеер Ergo Zen Basiс.<o:p></o:p></p><p>Удобный и надежный, при этом компактный с лаконичным и в то же время элегантным дизайном, плеер станет незаменим в долгих пробках мегаполисов, во время прогулок или любое другое время, когда Вы захотите побаловать себя любимыми треками. MP3-флэш плеер Ergo Zen Basiс объединил в себе лучшие качества электронного продукта: функциональность и приятную цену.<o:p></o:p></p><p>Ergo Zen Basiс  - оптимальное решение для тех, кто ценит лаконичность за умеренную стоимость и не желает переплачивать за те характеристики, которыми он никогда не пользуется.<o:p></o:p></p><p>MP3-флэш плеер Ergo Zen Basiс представлен в трех цветовых решениях: классическом черном, белом и синем цветах. Объем памяти достигает 2, 4 или 8 GB, есть слот под карту памяти MicroSD, что дает возможность за раз закачивать порядка 1000 музыкальных композиций.<o:p></o:p></p><p><b>Комплектация:</b> наушники, инструкция пользователя.<o:p></o:p></p>', NULL, NULL, NULL),
(7982, 'ru', 'MP3-флэш плеер Ergo Zen modern 8 GB Black', '<ul><li> Встроенная память 8 GB</li><li> ЖК-дисплей 1.8”</li><li> FM радио</li></ul>', '<p>Проигрывание музыкальных композиций, просмотр видеороликов и фотографий - всё это может компактный <b>Ergo</b> <b>Zen</b> <b>modern</b>. Объем встроенной памяти доступен от 2-х до 8-ми GB. <br><br><b>Ergo</b> <b>Zen</b> <b>modern</b> доступен в продаже в 3-х цветах: черный, красный и синий!<br><b>Характеристики:</b></p><o:p></o:p><ul>    <li>Память: 2 GB, 4 GB, 8 GB<o:p></o:p></li>    <li>1.8 TFT LCD-дисплей (160x128)<o:p></o:p></li>    <li>форматы: MP3, WMA, MTV, JPEG<o:p></o:p></li>    <li>FM-тюнер</li>    <li>USB 2.0<br>    <br>     </li></ul><p> </p>', NULL, NULL, NULL),
(7980, 'ru', 'MP3-флэш плеер Ergo Zen modern 4 GB Blue', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей 1.8”</li><li> FM радио</li></ul>', '<p>Проигрывание музыкальных композиций, просмотр видеороликов и фотографий - всё это может компактный <b>Ergo</b> <b>Zen</b> <b>modern</b>. Объем встроенной памяти доступен от 2-х до 8-ми GB. <br><br><b>Ergo</b> <b>Zen</b> <b>modern</b> доступен в продаже в 3-х цветах: черный, красный и синий!<br><b>Характеристики:</b></p><o:p></o:p><ul>    <li>Память: 2 GB, 4 GB, 8 GB<o:p></o:p></li>    <li>1.8 TFT LCD-дисплей (160x128)<o:p></o:p></li>    <li>форматы: MP3, WMA, MTV, JPEG<o:p></o:p></li>    <li>FM-тюнер</li>    <li>USB 2.0<br>    <br>     </li></ul><p> </p>', NULL, NULL, NULL),
(7981, 'ru', 'MP3-флэш плеер Ergo Zen modern 4 GB Red', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей 1.8”</li><li> FM радио</li></ul>', '<p>Проигрывание музыкальных композиций, просмотр видеороликов и фотографий - всё это может компактный <b>Ergo</b> <b>Zen</b> <b>modern</b>. Объем встроенной памяти доступен от 2-х до 8-ми GB. <br><br><b>Ergo</b> <b>Zen</b> <b>modern</b> доступен в продаже в 3-х цветах: черный, красный и синий!<br><b>Характеристики:</b></p><o:p></o:p><ul>    <li>Память: 2 GB, 4 GB, 8 GB<o:p></o:p></li>    <li>1.8 TFT LCD-дисплей (160x128)<o:p></o:p></li>    <li>форматы: MP3, WMA, MTV, JPEG<o:p></o:p></li>    <li>FM-тюнер</li>    <li>USB 2.0<br>    <br>     </li></ul><p> </p>', NULL, NULL, NULL),
(7983, 'ru', 'MP3-флэш плеер Ergo Zen modern 8 GB Red', '<ul><li> Встроенная память 8 GB</li><li> ЖК-дисплей 1.8”</li><li> FM радио</li></ul>', '<p>Проигрывание музыкальных композиций, просмотр видеороликов и фотографий - всё это может компактный <b>Ergo</b> <b>Zen</b> <b>modern</b>. Объем встроенной памяти доступен от 2-х до 8-ми GB. <br><br><b>Ergo</b> <b>Zen</b> <b>modern</b> доступен в продаже в 3-х цветах: черный, красный и синий!<br><b>Характеристики:</b></p><o:p></o:p><ul>    <li>Память: 2 GB, 4 GB, 8 GB<o:p></o:p></li>    <li>1.8 TFT LCD-дисплей (160x128)<o:p></o:p></li>    <li>форматы: MP3, WMA, MTV, JPEG<o:p></o:p></li>    <li>FM-тюнер</li>    <li>USB 2.0<br>    <br>     </li></ul><p> </p>', NULL, NULL, NULL),
(7984, 'ru', 'MP3-флэш плеер Ergo Zen Style 4 GB', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей 2” сенсорный</li><li> FM радио</li></ul>', '<p><b>MP3-флэш плеер Ergo Zen Style: с музыкой по жизни!<o:p></o:p></b></p><p>Новинка компании Ergo – отличное решение , позволяющее меломанам получить качественный и функциональный девайс с интуитивно понятным меню и высокой производительностью.<o:p></o:p></p><p>Модель предусматривает наличие флэш-памяти объемом в 4 или 8 GB, где с легкостью вместятся любимые альбомы и сотни треков.<o:p></o:p></p><p>Помимо этого, Ergo Zen Style может использоваться как внешняя флэш-память для хранения личных документов и файлов.<o:p></o:p></p><p>Двухдюймовый дисплей плеера имеет сенсорную технологию: откажитесь от неудобных кнопок на корпусе! <o:p></o:p></p><p>Устройство поддерживает наиболее распространенные форматы музыки: MP3, WMA, OGG. Поддержка видеоформатов: MTV.<o:p></o:p></p><p>Li-ion аккумулятор способен обеспечить до 6 часов непрерывной работы Ergo Zen Style. А металлический корпус убережет от механических повреждений, сохранив презентабельный внешний вид плеера даже после длительного использования.<o:p></o:p></p>', NULL, NULL, NULL),
(7985, 'ru', 'MP3-флэш плеер Ergo Zen Style 8 GB', '<ul><li> Встроенная память 8 GB</li><li> ЖК-дисплей 2” сенсорный</li><li> FM радио</li></ul>', '<p><b>MP3-флэш плеер Ergo Zen Style: с музыкой по жизни!<o:p></o:p></b></p><p>Новинка компании Ergo – отличное решение , позволяющее меломанам получить качественный и функциональный девайс с интуитивно понятным меню и высокой производительностью.<o:p></o:p></p><p>Модель предусматривает наличие флэш-памяти объемом в 4 или 8 GB, где с легкостью вместятся любимые альбомы и сотни треков.<o:p></o:p></p><p>Помимо этого, Ergo Zen Style может использоваться как внешняя флэш-память для хранения личных документов и файлов.<o:p></o:p></p><p>Двухдюймовый дисплей плеера имеет сенсорную технологию: откажитесь от неудобных кнопок на корпусе! <o:p></o:p></p><p>Устройство поддерживает наиболее распространенные форматы музыки: MP3, WMA, OGG. Поддержка видеоформатов: MTV.<o:p></o:p></p><p>Li-ion аккумулятор способен обеспечить до 6 часов непрерывной работы Ergo Zen Style. А металлический корпус убережет от механических повреждений, сохранив презентабельный внешний вид плеера даже после длительного использования.<o:p></o:p></p>', NULL, NULL, NULL),
(7986, 'ru', 'МР3-флэш плеер Ergo Zen Little 2 GB Blue', '<ul><li> Встроенная память 2 GB</li></ul>', '<!--more--><p><b>Ergo</b> <b>Zen</b> <b>Little</b>  - настоящая музыкальная находка для ценителей качественного звучания и комфорта!<br><br>Новинку можно назвать воплощением мечты любителей музыки о стильном аксессуаре, который проигрывает любимые композиции.<br><br><b>Ergo</b> <b>Zen</b> <b>Little</b> воспроизводит Мр3 и WMA аудиофайлы и оборудован высокоcкоростным USB 2.0.<br><br>Для хранения информации предусмотрена внутренняя память объемом  2 GB, что позволяет хранить большое количество музыкальных композиций без использования дополнительных карт памяти.<br><br>Питание плеера обеспечивает встроенная батарея.<br><br>Технические особенности  <b>Ergo</b> <b>Zen</b> <b>Little</b> великолепно сочетаются со стильным дизайнерским решением и отличной эргономикой.<br><br><!--more--></p>', NULL, NULL, NULL),
(7987, 'ru', 'МР3-флэш плеер Ergo Zen Clip 2 GB Black', '<ul><li> Встроенная память 2 GB</li></ul>', '<p><b>Ergo</b> <b>Zen</b> <b>clip</b> - настоящая музыкальная находка для ценителей качественного звучания и комфорта!<br>Новинку можно назвать воплощением мечты любителей музыки о стильном аксессуаре, который проигрывает любимые композиции.<br>Широкие технические возможности новинки формата Simple Plug&Play сочетаются с максимально удобной системой крепления <b>clip</b>, благодаря которой плеер крепится к одежде как обычный зажим. Подобная конструкция крепления позволяет пользоваться плеером во время занятия спортом и  в туристических походах.<br><b>Ergo</b> <b>Zen</b> <b>clip</b> воспроизводит Мр3 и WMA аудиофайлы и оборудован высокоcкоростным USB 2.0.<br>Для хранения информации предусмотрена внутренняя память объемом  2 и 4 GB, в зависимости от модели, что позволяет хранить большое количество музыкальных композиций без использования дополнительных карт памяти.<br>Для удобного использования устройство оснащено функцией блокировки клавиатуры, а режим случайного выбора музыкальной композиции shuffle сделает прослушивание трек-листа каждый раз оригинальным.<o:p></o:p></p><p>Питание плеера обеспечивает встроенная батарея.<br>Технические особенности  <b>Ergo</b> <b>Zen</b> <b>clip</b> великолепно сочетаются со стильным дизайнерским решением и отличной эргономикой.<br>Устройство выпускается в черном, синим, серебристом и красном корпусе.<o:p></o:p></p>', NULL, NULL, NULL),
(7988, 'ru', 'MP3-флэш плеер Ergo Zen Volume 4 GB Black', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей</li></ul>', '<p>Семейство аудиоплееров компании Ergo пополнилось новинкой – моделью Ergo Zen Volume с встроенной памятью на 4 и 8 ГБ. Главной особенностью нового плеера является наличие встроенного динамика мощностью 3 Вт.<br><br>Дизайн новинки простой и в то же время стильный и современный. <br>Истинные меломаны по достоинству оценят такие полезные функции Ergo Zen как возможность повторного проигрывания композиции и воспроизведение мультирежимов эквалайзера.<br>Устройство поддерживает карты памяти стандарта MicroSD и может использоваться в качестве флэш-носителя.<br><br>Плеер Zen Volume имеет встроенную функцию диктофона. Также характерным для него является прямое соединение типа USB Plug.<br><br>Перебросить любимые композиции в формате MP3 или WMA с домашнего ПК не составит труда, ведь плеер поддерживает все современные ОС Microsoft Windows Vista, Windows 98/SE/ME/2000/XP.</p><p> </p>', NULL, NULL, NULL),
(7989, 'ru', 'MP3-флэш плеер Ergo Zen Volume 4 GB White', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей</li></ul>', '<p>Семейство аудиоплееров компании Ergo пополнилось новинкой – моделью Ergo Zen Volume с встроенной памятью на 4 и 8 ГБ. Главной особенностью нового плеера является наличие встроенного динамика мощностью 3 Вт.<br><br>Дизайн новинки простой и в то же время стильный и современный. <br>Истинные меломаны по достоинству оценят такие полезные функции Ergo Zen как возможность повторного проигрывания композиции и воспроизведение мультирежимов эквалайзера.<br>Устройство поддерживает карты памяти стандарта MicroSD и может использоваться в качестве флэш-носителя.<br><br>Плеер Zen Volume имеет встроенную функцию диктофона. Также характерным для него является прямое соединение типа USB Plug.<br><br>Перебросить любимые композиции в формате MP3 или WMA с домашнего ПК не составит труда, ведь плеер поддерживает все современные ОС Microsoft Windows Vista, Windows 98/SE/ME/2000/XP.</p><p> </p>', NULL, NULL, NULL),
(7990, 'ru', 'MP3-флэш плеер Ergo Zen Volume 8 GB Black', '<ul><li> Встроенная память 8 GB</li><li> ЖК-дисплей</li></ul>', '<p>Семейство аудиоплееров компании Ergo пополнилось новинкой – моделью Ergo Zen Volume с встроенной памятью на 4 и 8 ГБ. Главной особенностью нового плеера является наличие встроенного динамика мощностью 3 Вт.<br><br>Дизайн новинки простой и в то же время стильный и современный. <br>Истинные меломаны по достоинству оценят такие полезные функции Ergo Zen как возможность повторного проигрывания композиции и воспроизведение мультирежимов эквалайзера.<br>Устройство поддерживает карты памяти стандарта MicroSD и может использоваться в качестве флэш-носителя.<br><br>Плеер Zen Volume имеет встроенную функцию диктофона. Также характерным для него является прямое соединение типа USB Plug.<br><br>Перебросить любимые композиции в формате MP3 или WMA с домашнего ПК не составит труда, ведь плеер поддерживает все современные ОС Microsoft Windows Vista, Windows 98/SE/ME/2000/XP.</p><p> </p>', NULL, NULL, NULL),
(7991, 'ru', 'MP3-флэш плеер Ergo Zen Volume 8 GB White', '<ul><li> Встроенная память 8 GB</li><li> ЖК-дисплей</li></ul>', '<p>Семейство аудиоплееров компании Ergo пополнилось новинкой – моделью Ergo Zen Volume с встроенной памятью на 4 и 8 ГБ. Главной особенностью нового плеера является наличие встроенного динамика мощностью 3 Вт.<br><br>Дизайн новинки простой и в то же время стильный и современный. <br>Истинные меломаны по достоинству оценят такие полезные функции Ergo Zen как возможность повторного проигрывания композиции и воспроизведение мультирежимов эквалайзера.<br>Устройство поддерживает карты памяти стандарта MicroSD и может использоваться в качестве флэш-носителя.<br><br>Плеер Zen Volume имеет встроенную функцию диктофона. Также характерным для него является прямое соединение типа USB Plug.<br><br>Перебросить любимые композиции в формате MP3 или WMA с домашнего ПК не составит труда, ведь плеер поддерживает все современные ОС Microsoft Windows Vista, Windows 98/SE/ME/2000/XP.</p><p> </p>', NULL, NULL, NULL),
(7992, 'ru', 'MP3-флэш плеер Iriver E-40 4 GB Dark Gray', '<ul><li> Встроенная память 4 GB</li><li> ЖК-дисплей 2</li><li> FM радио</li></ul>', '<p><strong>Стильный плеер «на каждый день» - 50 часов без подзарядки </strong></p><p>Легкий и компактный плеер Iriver E-40 станет незаменимым гаджетом «на каждый день»: удобный пластиковый корпус толщиной всего в 9 миллиметров со скругленными углами поместится не только в сумке, но и в самом неглубоком кармане. Емкий аккумулятор E-40 позволяет непрерывно слушать любимые композиции на протяжении более 50-ти часов, а подзаряжать его легко через любое устройство, оснащенное разъемом USB.</p><p>Плеер воспроизводит аудиофайлы большинства популярных форматов, среди которых MP3, WMA, WAV, APE и FLAC. Устройство не оставит равнодушными любителей музыки самых разных жанров: 30 предустановленных настроек эквалайзера дают возможность тонко подстраивать звучание в зависимости от стиля музыкального трека. Великолепное звучание плеера во всех диапазонах частот, от трелей до басов, обрадует даже взыскательных меломанов.</p><p>Еще одна особенность этого плеера - удобное меню, значительно улучшенное по сравнению с предыдущей моделью линейки, Iriver E30. В новом формате списка воспроизведения пользователь сможет видеть не только текущую композицию, но и предыдущую, и следующую.  <br>Мощный для этого класса устройств процессор обеспечивает быстрый переход между страницами меню. Устройство оснащено небольшим двухдюймовым дисплеем, позволяющим воспроизводить видеофайлы формата SMV. Есть у плеера и дополнительные функции: FM-радио и диктофон.</p>', NULL, NULL, NULL),
(8432, 'ru', 'Спальный мешок EASY CAMP Atlanta Plus', 'Размеры:  200 x90 см\r\nРассчитан на человека высотой:  200 см\r\nВнешняя ткань:  смесовая ткань (20% хлопка/80% полиэстер)\r\nМолния:  двусторонняя с замком\r\nКонструкция:   1 слой, машинная прошивка\r\nНаполнитель:  1 x250 г/м2 холлофайбер\r\nВнутренняя ткань:  смесовая ткань (20% хлопка/80% полиэстер)                                                                                                                                                                                                                                                               Температурный режим(min/comf/max): -5°С/+8°С/+22°С\r\nВес:  1750 г\r\nРазмеры упаковки:  46 x38 x15  см\r\nОсобенности:  можно использовать как одеяло, полностью расстегивается, лента от закусывания молнии\r\nСезонность: поздняя весна – ранняя осень', 'Atlanta– превосходные спальные мешки одеяла для семейного кемпинга в различных вариантах форм и размеров. Каждый может быть расстегнут и использован как одеяло, а 2 спальных мешка могут быть состегнуты в один двойной. Идеальны для семейного кемпинга, позволят вам не замерзнуть в любой летний месяц.\r\n Размеры:  200 x90 см\r\nРассчитан на человека высотой:  200 см\r\nВнешняя ткань:  смесовая ткань (20% хлопка/80% полиэстер)\r\nМолния:  двусторонняя с замком\r\nКонструкция:   1 слой, машинная прошивка\r\nНаполнитель:  1 x250 г/м2 холлофайбер\r\nВнутренняя ткань:  смесовая ткань (20% хлопка/80% полиэстер)                                                                                                                                                                                                                                                               Температурный режим(min/comf/max): -5°С/+8°С/+22°С\r\nВес:  1750 г\r\nРазмеры упаковки:  46 x38 x15  см\r\nОсобенности:  можно использовать как одеяло, полностью расстегивается, лента от закусывания молнии\r\nСезонность: поздняя весна – ранняя осень', NULL, NULL, NULL),
(13889, 'ru', 'Карта памяти Transcend microSDHC 16 GB Class 10 UHS-I Ultimate (X600) (+ адаптер)', '<ul><li><i>Емкость 16 GB<br></i></li><li>В комплекте адаптер</li></ul>', '<p>Карты памяти Transcend microSDHC UHS-I с поддержкой спецификации Ultra High Speed Class 1 созданы специально, чтобы улучшить качество работы со смартфонами и планшетами. Карты памяти используют технологию последнего поколения и гарантируют максимально возможный уровень производительности при работе активно задействующих память мобильных приложений и игр, а также обеспечивают плавную запись и воспроизведение видео в разрешении Full HD.</p><ul>    <li>Поддержка спецификации Ultra High Speed Class 1 (U1)</li>    <li>Совместимость с Class 10 </li>    <li>Полная совместимость со стандартом SD 3.01</li>    <li>Просты в использовании, подключение plug and play</li>    <li>Технология коррекции ошибок (ECC) для обнаружения и исправления ошибок при передаче данных</li>    <li>Поддержка автоматической активации режимов ожидания и сна, а также автоотключения</li>    <li>Отвечает RoHS</li></ul>', NULL, NULL, NULL),
(8433, 'ru', 'Спальный мешок EASY CAMP Chakra Black', '<p>сезон использования 1 форма Одеяло t&deg; комфорта +6 и выше наполнитель Polyester fibre верх Мягкий полиэстер вес до 1000 г подкладка Микрополиэстер</p>', '<p>Эти яркие и модные спальные мешки могут использоваться в качестве одеяла. Идеально подходят для праздников на природе, ночёвки дома и для длительных путешествий. Характеристики:Артикул: 240017 Green 240018 Black 240019 Pink Размер, см: 190х75 Вес, прибл.: 800 г Длина тела: 190 см Ткань сверху: 170Т Мягкий полиэстер Наполнитель: Волокно из полиэстера 1х150 г/м? Подкладка: 170Т Мягкий полиэстер Конструкция: Один слой, прошит Размер упак., см: 17х36 Дополнительные характеристики: Стильное одеяло Возможность соединения спальников вместе Защитный тепловой клапан по всей длине замка 1 сезон: для использования в летние месяцы.</p>', '', '', ''),
(8434, 'ru', 'Спальный мешок EASY CAMP Chakra Pink', '<p>сезон использования 1 форма Одеяло t&deg; комфорта +6 и выше наполнитель Polyester fibre верх Мягкий полиэстер вес до 1000 г подкладка Микрополиэстер</p>', '<p>Эти яркие и модные спальные мешки могут использоваться в качестве одеяла. Идеально подходят для праздников на природе, ночёвки дома и для длительных путешествий. Характеристики:Артикул: 240017 Green 240018 Black 240019 Pink Размер, см: 190х75 Вес, прибл.: 800 г Длина тела: 190 см Ткань сверху: 170Т Мягкий полиэстер Наполнитель: Волокно из полиэстера 1х150 г/м? Подкладка: 170Т Мягкий полиэстер Конструкция: Один слой, прошит Размер упак., см: 17х36 Дополнительные характеристики: Стильное одеяло Возможность соединения спальников вместе Защитный тепловой клапан по всей длине замка 1 сезон: для использования в летние месяцы.</p>', '', '', ''),
(14192, 'ru', ' Гарнитура  Nokia BH-806', '<table class="sm_params_tbl" border="0">\n<tbody>\n<tr>\n<td width="290">&nbsp;Вес:</td>\n<td>8 г</td>\n</tr>\n<tr>\n<td width="290"><span class="tire">&mdash;</span>&nbsp;Аккумулятор:</td>\n<td>Li-pol 100 мАч</td>\n</tr>\n<tr>\n<td width="290"><span class="tire">&mdash;</span>&nbsp;Время работы в режиме разговора:</td>\n<td>6 часов</td>\n</tr>\n<tr>\n<td width="290"><span class="tire">&mdash;</span>&nbsp;Время работы в режиме ожидания:</td>\n<td>80 часов</td>\n</tr>\n<tr>\n<td width="290"><span class="tire">&mdash;</span>&nbsp;Стереозвучание:</td>\n<td><span class="tire2">&mdash;</span></td>\n</tr>\n<tr>\n<td width="290"><span class="tire">&mdash;</span>&nbsp;Технология передачи:</td>\n<td>Bluetooth 2.1 + EDR</td>\n</tr>\n<tr>\n<td width="290"><span class="tire">&mdash;</span>&nbsp;Технология Multipoint:</td>\n<td><img src="http://mobistyle.com.ua/P/galka.gif" alt="" /></td>\n</tr>\n<tr>\n<td width="290"><span class="tire">&mdash;</span>&nbsp;Радиус действия:</td>\n<td>10 метров</td>\n</tr>\n</tbody>\n</table>', '<p><span>Благодаря функции постоянной готовности, присутствующей в гарнитуре Nokia BH-806, вам не составит никакого труда принять или сделать звонок в любой момент - просто возьмите наушник и начинайте говорить. Особая конструкция наушников-вкладышей создает эффект обволакивания звуком со всех сторон, а функции автоматической регулировки громкости и шумоподавления обеспечивают высочайшее качество звука в любой ситуации. В гарнитуре Nokia BH-806, созданной из эксклюзивных материалов, сочетаются роскошь, инновации и элегантный дизайн</span></p>', NULL, NULL, NULL),
(14190, 'ru', 'Гарнитура Samsung BHM 1200 black', '<p>&nbsp;</p>\n<table id="decoratedTable0" class="decorated-table">\n<tbody>\n<tr class="odd">\n<td>Тип гарнитуры</td>\n<td class="last">Bluetooth</td>\n</tr>\n<tr class="even">\n<td>Спецификация Bluetooth</td>\n<td class="last">3</td>\n</tr>\n<tr class="odd">\n<td>Функции</td>\n<td class="last">Ответить/закончить разговор, Ожидание/удержание вызова, Голосовой набор, Повтор последнего номера,автоматическая подстройка громкости, автоматическое парное соединение, цифровое шумо- и эхоподавление.</td>\n</tr>\n<tr class="even">\n<td>Совместимость</td>\n<td class="last">Samsung</td>\n</tr>\n</tbody>\n</table>', '<p><span>Bluetooth-моногарнитура HM1200 - это сочетание удобства, простоты и качества. Она отличается удобством в управлении и компактным стильным дизайном. При этом модель обеспечивает высочайшую четкость передачи голоса, которой славятся гарнитуры Samsung</span></p>', NULL, NULL, NULL),
(10734, 'ru', 'Чехол HTC HC V841', '<ul><li> Материал - микроволокно/поликарбонат под кожу</li><li> Цвет – черный/красный</li></ul>', '<p><strong>У тебя все под контролем</strong></p><p>Передняя крышка лицевой панели обеспечивает защиту экрана твоего нового HTC One, оберегая его от ударов и царапин. Ее можно с легкостью откинуть и начать действовать.</p><p><strong>Смотри на мир по-своему</strong></p><p>Снова поверни крышку, и твой новый HTC One получит удобную подставку — идеальную для просмотра фильмов или прослушивания аудиозаписей без необходимости держать телефон в руках.</p><p><strong>Привлекательный, долговечный вид</strong></p><p>Чехол Дабл Дип Флип сделан из первоклассного замшевого материала. Он подчеркивает красоту и прочность твоего нового HTC One.</p>', NULL, NULL, NULL),
(13392, 'ru', 'Защитная пленка  Drobak Samsung S7562', '<p>Защитная пленка Drobak 2 в 1 для Samsung Galaxy S Duos S7562<strong>&nbsp;</strong><span>идеально подойдет для Вашего устройства и надежно защитит его экран от появления царапин, потертостей, пятен, отпечатков пальцев на его поверхности. Пленка имеет два защитных слоя, поэтому легко клеится и снимается с экрана устройства, не оставляя следов</span></p>', '', NULL, NULL, NULL),
(13393, 'ru', 'Защитная пленка Drobak Samsung I9070 ', '<p><span>Защитная пленка для телефона Drobak Samsung I9070 высшего качества.</span></p>', '<p><span>Царапины на экране нового телефона появляются примерно через месяц работы без защитной пленки, поэтому если Вы цените свои вещи и хотите чтобы они надолго оставались новыми, стоит задуматься над приобретением защитной пленки, разработанной специально для Samsung I9070. Пленка имеет особое антибликовое покрытие, благодаря чему, даже в солнечную погоду, Вы без труда сможете читать информацию с экрана. Кроме того, защитная пленка Drobak не только защищает от появления царапин на экране, но и также скрывает уже существующие потертости и повреждения. Защитная пленка легко наклеивается и снимается, не оставляя следов. Ваш телефон с защитной пленкой Drobak всегда будет выглядеть, как новый.</span><br /><span><br /></span></p>', NULL, NULL, NULL);
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(10179, 'ru', 'Наушники Koss The Plug', 'Модель KOSS The PLUG – легендарные вставные наушники, первые в своем роде. Они обеспечивают исключительно точное воспроизведение звука, глубокие басы уже с 10 Гц (!) и потрясающую шумоизоляцию, которую можно найти только в полноразмерных закрытых наушниках. KOSS The PLUG – компактные и легкие вставки, комфортные в ношении. Они идеально подходят для портативного аудио, особенно для прослушивания музыки на улице и в метро.  ', 'Уникальные портативные наушники-вкладыши от KOSS – вставные закрытого типа!<br>Идеально подходят для использования в шумных местах: особенная конструкция амбушюров обеспечивает превосходную звукоизоляцию и направляет звук непосредственно вглубь уха<br>Великолепное воспроизведение, чистый неискаженный звук<br>Высокая чувствительность обеспечивает при необходимости громкое звучание<br>Оптимальный частотный диапазон, глубокие басы.<div><br></div><div><table cellpadding="5" cellspacing="0"><tbody><tr><td>Производитель</td><td>Koss</td></tr><tr><td>Вид наушников</td><td>вставные</td></tr><tr><td>Тип акустического оформления</td><td>закрытые</td></tr><tr><td>Тип подключения</td><td>с проводом</td></tr><tr><td>Микрофон</td><td>нет</td></tr><tr><td>Воспроизводимая частота, Гц</td><td>10-20000</td></tr><tr><td>Импеданс, Ом</td><td>16</td></tr><tr><td>Чувствительность, дБ</td><td>112</td></tr><tr><td>Система активного шумоподавления</td><td>нет</td></tr><tr><td>Тип крепления</td><td>без крепления</td></tr><tr><td>Регулятор громкости</td><td>нет</td></tr><tr><td>Отсоединяемый кабель</td><td>нет</td></tr><tr><td>Разъём</td><td>mini jack 3,5 mm</td></tr><tr><td>Переходник 6,3 мм в комплекте</td><td>нет</td></tr><tr><td>Переходник 3,5 мм в комплекте</td><td>нет</td></tr><tr><td>Позолоченные разъемы</td><td>есть</td></tr><tr><td>Витой шнур</td><td>нет</td></tr><tr><td>Удлинительный кабель в комплекте</td><td>нет</td></tr><tr><td>Цвет</td><td>черный</td></tr><tr><td>Длина кабеля, м</td><td>1,2<br><br></td></tr></tbody></table>  <br></div>  ', NULL, NULL, NULL),
(10180, 'ru', 'Наушники KOSS Porta Pro', '<ul><li> Частотный диапазон: 15 Гц - 25 кГц</li><li> Номинальное сопротивление: 60 Ом</li></ul>', '<p>KOSS Porta Pro - самые популярные и известные во всем мире портативные наушники, нестареющая классика на вроде автомата Калашникова. По качеству звука эти наушники способны удовлетворить потребности наиболее взыскательных меломанов. Модель отличается великолепными басами, широким частотным диапазоном и высокой чувствительностью. А уникальный дизайн и легкий вес позволяют комфортно носить KOSS Porta Pro в течение любого времени.</p><ul>    <li>Портативные дуговые наушники открытого типа</li>    <li>Чистый неискаженный звук, глубокие басы</li>    <li>Удобная складная конструкция, надежная металлическая дужка</li>    <li>Уникальный дизайн, повышенная комфортность</li>    <li>Самая популярная и известная во всем мире модель портативных наушников!</li></ul>', NULL, NULL, NULL),
(10181, 'ru', 'Наушники Koss KEBDZ Twinz/KE7', '&nbsp; KOSS Twinz – это две пары удобных и очень лёгких наушников-вкладышей, которые прекрасно подойдут для любителей дальних поездок. В комплект этих наушников входит удобный блистер для хранения, в котором соединительный шнур наматывается на колёсико, как в рулетке  ', '<table cellpadding="0" cellspacing="0"><tbody><tr><td>Тип наушников:</td><td>Вкладыши</td></tr><tr><td>Тип подключения:</td><td>Проводное</td></tr><tr><td>Диапазон частот наушников:</td><td>60 Гц - 20 КГц</td></tr><tr><td>Сопротивление наушников:</td><td>16 Oм</td></tr><tr><td>Возможности:</td><td>В комплект входит удобный блистер для хранения</td></tr><tr><td>Длина шнура:</td><td>1,2 м</td></tr><tr><td>Гарантия, мес:</td><td>24</td></tr></tbody></table>  ', NULL, NULL, NULL),
(10182, 'ru', 'Наушники Sony MDR EX10LP Black', 'Испытайте истинное наслаждение от абсолютного погружения в мир вашей любимой музыки с новыми удобными наушниками Sony MDR-EX10LP Black. Они сделаны по типу вкладышей, так что кроме выбранной музыки вы не будете слышать больше никаких посторонних шумов. Они будут идеальными спутниками абсолютно в любой поездке или походе, обеспечив вам четкий и кристально чистый звук без искажений. Благодаря классическому черному цвету и стандартному разъему в 3,5 мм эти наушники можно использовать не только для телефона, но и для mp3-плеера, ноутбука или планшета. И ничто не будет отвлекать вас от музыкального удовольствия  ', '<div>Характеристики</div><div><table><tbody><tr><th>Вид наушников</th><td>вставные ("затычки")</td></tr><tr><th>Подключение</th><td>с проводом</td></tr><tr><th>Диапазон частот</th><td>8 - 22000 Гц</td></tr><tr><th>Диаметр мембраны</th><td>9 мм</td></tr><tr><th>Особенности</th><td>неодимовые магниты, сменные амбушюры</td></tr><tr><th>Максимальная мощность</th><td>100 мВт</td></tr><tr><th>Вес</th><td>3 г</td></tr><tr><th>Количество излучателей</th><td>1</td></tr><tr><th>Сопротивление</th><td>16 Ом</td></tr><tr><th>Крепление</th><td>без крепления</td></tr><tr><th>Количество пар сменных амбушюр в комплекте</th><td>3</td></tr><tr><th>Позолоченные разъемы</th><td>есть</td></tr><tr><th>Разъём наушников</th><td>mini jack 3.5 mm</td></tr><tr><th>Чувствительность</th><td>100 дБ/мВт</td></tr><tr><th>Форма разъема наушников</th><td>L-образный</td></tr><tr><th>Длина провода</th><td>1.2 м</td></tr><tr><th>Тип кабеля</th><td>симметричный</td></tr></tbody></table></div>  ', NULL, NULL, NULL),
(10183, 'ru', 'Наушники Panasonic RP-HJE120E-K', '<ul><li> Частотный диапазон 20 Гц - 20 кГц</li><li><i>Черный цвет</i></li></ul>', '<p><strong>Ключевые характеристики:</strong></p><ul>    <li>3 комплекта амбушюров разного размера для максимального удобства</li>    <li>Комфортная посадка благодаря дизайну Ergo Fit</li>    <li>Длина шнура: 1.1 м</li>    <li>Большой диапазон цветов</li>    <li>Частотный диапазон: 20 Гц – 20 кГц</li>    <li>Чувствительность: 96 дБ/мВт</li>    <li>Мощность: 200 мВт</li>    <li>Сопротивление: 16 Ом</li></ul><p> </p>', NULL, NULL, NULL),
(10184, 'ru', 'Наушник A4Tech MK-690-В', 'A4Tech MK-690-В; Характеристика наушников: Наушники Проводной Вкладыши 20 - 20000Гц 102дБ 32Ом 3,5 мм; Цвет: Чёрный  ', '<ul><li>Производитель / Модель / Код [1]</li><li>Производитель изделияA4Tech</li><li>МодельMK-690-В</li><li>Код от производителяMK-690-В</li><li>Характеристика наушников [1]</li><li>Тип устройстваНаушники</li><li>Способ подключенияПроводной</li><li>Тип наушниковВкладыши</li><li>Диапазон воспроизводимых частот20 - 20000 Гц</li><li>Чувствительность102 дБ</li><li>Сопротивление32 Ом</li><li>Разъем3,5 мм</li><li>Цвет изделия [1]</li><li>Цвет изделияЧёрный</li></ul>  ', NULL, NULL, NULL),
(12179, 'ru', 'Чехол-книжка Samsung EFC-1G6FLECSTD I9300 Light Blue', '<ul><li> Материал - искусственная кожа</li><li> Цвет – голубой</li></ul>', '<ul>    <li>Совместимость: <a>Samsung Galaxy S III I9300</a></li>    <li>Материал: искусственная кожа</li></ul>', NULL, NULL, NULL),
(12177, 'ru', 'Чехол-книжка Samsung EFC-1G6FBECSTD I9300 Pebble Blue', '<ul><li> Материал - искусственная кожа</li><li> Цвет – синий</li></ul>', '<ul>    <li>Совместимость: <a>Samsung Galaxy S III I9300</a></li>    <li>Материал: искусственная кожа</li></ul>', NULL, NULL, NULL),
(12178, 'ru', 'Чехол-книжка Samsung EFC-1G6FGECSTD I9300 Titanium Silver', '<ul><li> Материал - искусственная кожа</li><li> Цвет – Titanium Silver</li></ul>', '<ul>    <li>Совместимость: <a>Samsung Galaxy S III I9300</a></li>    <li>Материал: искусственная кожа</li></ul>', NULL, NULL, NULL),
(12175, 'ru', 'Чехол-книжка Samsung EFC-1G5NGECSTD P3100/P3110 Black', '<ul><li> Материал – искусственная кожа</li><li> Цвет – черный</li></ul>', '<p>Чехол защищает Ваш планшет и делает его практичным и привлекательным. Возможность установки чехла под углом, удобным для просмотра видео и изображений в любом удобном для Вас месте.</p><ul>    <li>Материал: Искусственная кожа</li>    <li>Совместимость: Samsung Galaxy Tab 2 7.0 (<a>P3100</a>/<a>P3110</a>)<br>     </li></ul>', NULL, NULL, NULL),
(12176, 'ru', 'Чехол-книжка Samsung EFC-1G5SGECSTD P3100/P3110 Dark Gray', '<ul><li> Цвет – темно-серый</li></ul>', '<ul>    <li>Совместимость: Samsung Galaxy Tab 2 7.0 (<a>P3100</a>/<a>P3110</a>)</li></ul>', NULL, NULL, NULL),
(12174, 'ru', 'Чехол-книжка Samsung EFC-1G2NRECSTD Garnet Red', '<ul><li> Материал: Полиуретан (PU) и поликарбонат (PC)</li><li> Цвет - гранатовый</li></ul>', '<p>Чехол <strong>EFC-1G2N</strong> позволяет не только оптимально защитить ваш Samsung GALAXY Note 10.1 от внешних воздействий, попадания грязи и пыли, но и добавить комфорта при работе с планшетом, благодаря свободному доступу ко всем разъемам устройства и легкому превращению чехла в удобную подставку.</p><ul>    <li>Материал: Полиуретан (PU) и поликарбонат (PC)</li>    <li>Тип фиксации: Магнит</li>    <li>Чехол-книжка для Samsung GALAXY Note 10.1</li>    <li>Размеры: 279 x 224 x 9 мм</li></ul>', NULL, NULL, NULL),
(12173, 'ru', 'Чехол-книжка Samsung EFC-1G2NLECSTD Light Blue', '<ul><li> Материал: Полиуретан (PU) и поликарбонат (PC)</li><li> Цвет - светло-голубой</li></ul>', '<p>Чехол <strong>EFC-1G2N</strong> позволяет не только оптимально защитить ваш Samsung GALAXY Note 10.1 от внешних воздействий, попадания грязи и пыли, но и добавить комфорта при работе с планшетом, благодаря свободному доступу ко всем разъемам устройства и легкому превращению чехла в удобную подставку.</p><ul>    <li>Материал: Полиуретан (PU) и поликарбонат (PC)</li>    <li>Тип фиксации: Магнит</li>    <li>Чехол-книжка для Samsung GALAXY Note 10.1</li>    <li>Размеры: 279 x 224 x 9 мм</li></ul>', NULL, NULL, NULL),
(12172, 'ru', 'Чехол-книжка Samsung EFC-1G2NGECSTD Dark Gray', '<ul><li> Материал: Полиуретан (PU) и поликарбонат (PC)</li><li> Цвет - темно-серый</li></ul>', '<p>Чехол <strong>EFC-1G2N</strong> позволяет не только оптимально защитить ваш Samsung GALAXY Note 10.1 от внешних воздействий, попадания грязи и пыли, но и добавить комфорта при работе с планшетом, благодаря свободному доступу ко всем разъемам устройства и легкому превращению чехла в удобную подставку.</p><ul>    <li>Материал: Полиуретан (PU) и поликарбонат (PC)</li>    <li>Тип фиксации: Магнит</li>    <li>Чехол-книжка для Samsung GALAXY Note 10.1</li>    <li>Размеры: 279 x 224 x 9 мм</li></ul>', NULL, NULL, NULL),
(12171, 'ru', 'Чехол-книжка Samsung EFC-1G2NAECSTD Amber Brown', '<ul><li> Материал: Полиуретан (PU) и поликарбонат (PC)</li><li> Цвет - Янтарно-коричневый</li></ul>', '<p>Чехол <strong>EFC-1G2N</strong> позволяет не только оптимально защитить ваш Samsung GALAXY Note 10.1 от внешних воздействий, попадания грязи и пыли, но и добавить комфорта при работе с планшетом, благодаря свободному доступу ко всем разъемам устройства и легкому превращению чехла в удобную подставку.</p><ul>    <li>Материал: Полиуретан (PU) и поликарбонат (PC)</li>    <li>Тип фиксации: Магнит</li>    <li>Чехол-книжка для Samsung GALAXY Note 10.1</li>    <li>Размеры: 279 x 224 x 9 мм</li></ul>', NULL, NULL, NULL),
(12170, 'ru', 'Чехол Samsung EFC-1J9BWEGSTD N7100 White', '<ul><li> Материал - поликарбонат, термопластичный полиуретан </li><li> Цвет – белый</li></ul>', '<ul>    <li>Материал: Поликарбонат и термопластичный полиуретан</li>    <li>Защитный чехол для Samsung <a>GALAXY Note II </a></li>    <li>Тип упаковки: Блистер</li>    <li>Размеры: 154.2 x 83.7 x 11.6мм</li></ul>', NULL, NULL, NULL),
(12169, 'ru', 'Чехол Samsung EFC-1J9BPEGSTD N7100 Pink', '<ul><li> Материал - поликарбонат, термопластичный полиуретан </li><li> Цвет - розовый</li></ul>', '<ul>    <li>Материал: Поликарбонат и термопластичный полиуретан</li>    <li>Защитный чехол для Samsung <a>GALAXY Note II </a></li>    <li>Тип упаковки: Блистер</li>    <li>Размеры: 154.2 x 83.7 x 11.6мм</li></ul>', NULL, NULL, NULL),
(12168, 'ru', 'Чехол Samsung EFC-1J9BBEGSTD N7100 Black', '<ul><li> Материал - поликарбонат, термопластичный полиуретан </li><li> Цвет – черный</li></ul>', '<ul>    <li>Материал: Поликарбонат и термопластичный полиуретан</li>    <li>Защитный чехол для Samsung <a>GALAXY Note II </a></li>    <li>Тип упаковки: Блистер</li>    <li>Размеры: 154.2 x 83.7 x 11.6мм</li></ul>', NULL, NULL, NULL),
(12167, 'ru', 'Чехол Samsung EFC-1H8NGECSTD P5100/P5110', '<ul><li>Для мобильных интернет-устройств Samsung P5100/P5110</li><li><i>Черный цвет</i></li></ul>', '<p>Чехол из синтетической кожи, цвет черный, для <a>P5100</a>/<a>P5110</a></p>', NULL, NULL, NULL),
(12166, 'ru', 'Чехол Samsung EFC-1G6WWECSTD White', '<ul><li> Материал - силикон</li><li> Цвет – белый, полупрозрачный</li></ul>', '<ul>    <li>Материал - силикон</li>    <li>Цвет – белый, полупрозрачный</li>    <li>Совместимость: <a>Samsung Galaxy S III I9300</a></li>    <li><o:p>Свойства: водоотталкивающий чехол</o:p></li></ul>', NULL, NULL, NULL),
(12165, 'ru', 'Чехол Samsung EFC-1G6WPECSTD I9300 Pink', '<ul><li> Материал - силикон</li><li> Цвет – розовый</li></ul>', '<ul>    <li>Материал: cиликон</li>    <li>Совместимость: <a>Samsung Galaxy S III I9300 </a></li></ul>', NULL, NULL, NULL),
(12164, 'ru', 'Чехол Samsung EFC-1G6WBECSTD Blue', '<ul><li> Материал - cиликон</li><li> Цвет - синий</li></ul>', '<ul>    <li>Материал: cиликон</li>    <li>Совместимость: <a>Samsung Galaxy S III I9300 </a></li></ul>', NULL, NULL, NULL),
(12163, 'ru', 'Чехол Samsung EFC-1G6SWECSTD I9300 White', '<ul><li> Материал - силикон</li><li> Цвет – белый</li></ul>', '<ul>    <li>Материал: cиликон</li>    <li>Совместимость: <a>Samsung Galaxy S III I9300 </a></li></ul>', NULL, NULL, NULL),
(12162, 'ru', 'Чехол Samsung EFC-1G6PPECSTD I9300 Pink', '<ul><li> Материал - силикон</li><li> Цвет – розовый</li></ul>', '<ul>    <li>Материал: cиликон</li>    <li>Совместимость: <a>Samsung Galaxy S III I9300 </a></li></ul>', NULL, NULL, NULL),
(11210, 'ru', 'USB кабель HTC DC M410', '<ul><li> USB кабель</li></ul>', '<p>Оригинальный дата-кабель HTC DC M410 USB/microUSB поможет тебе использовать на все 100 % твой мобильный телефон или коммуникатор. Стоит лишь воспользоваться кабелем, подключив с его помощью гаджет к персональному компьютеру. HTC DC M410 USB/microUSB обеспечивает возможность быстрой передачи данных по протоколу USB 2.0. Закачивай на свой мобильный книги, картинки, видео и музыкальные файлы! И одновременно заряжай аккумуляторную батарею гаджета</p>', NULL, NULL, NULL),
(11211, 'ru', 'Защитная пленка HTC SP P910', '<ul><li> Комплект из 2-х защитных пленок для HTC One</li></ul>', '<p>Защитная пленка HTC SP P910 в двух экземплярах великолепно сбережет сенсорный экран смартфона <a>HTC One</a> от царапин, грязи, пыли и следов от отпечатков пальцев. Пленка имеет тонкую, но прочную структуру, абсолютно прозрачную и не ухудшающую сенсорные качества экрана. Накладывается она быстро и не образует пузырей и заломов. В случае необходимости пользователь также быстро сможет поменять пленку HTC SP P910 на новую</p>', NULL, NULL, NULL),
(11212, 'ru', 'Мультимедийный модуль HTC DG H200', '<ul><li> Мультимедийный модуль</li></ul>', '<p><strong>От маленького экрана - к большому</strong></p><p>Перенеси экран твоего смартфона на экран твоего ТВ высокой четкости или домашний кинотеатр с объемным звуком 5.1 по беспроводному соединению</p><p><strong>Многозадачность для мультимедиа</strong></p><p>HTC Media Link HD может сохранить до 30 фотографий, а новая функция цифровой фоторамки позволит передавать фотографии высокой четкости с телефона непосредственно на твой ТВ по беспроводной связи. Режим двух экранов позволяет смотреть кино или слайд-шоу на ТВ одновременно с просмотром почты и Интернета на устройстве HTC</p><p><strong>Просто, интуитивно понятно</strong></p><p>Простым движением трех пальцев настрой и отправь контент на твой ТВ высокой четкости. Поддержка автонастройки в смартфоне HTC и в устройствах HTC Media Link HD</p>', NULL, NULL, NULL),
(11213, 'ru', 'Cтилус и ручка-чехол Samsung ET-S110EBEGSTD Black', '<ul><li>Стилус + ручка-чехол для Samsung N7000</li></ul>', '<p>Стилус + ручка-чехол для Samsung N7000</p>', NULL, NULL, NULL),
(11214, 'ru', 'USB адаптер Samsung EPL-1PL0BEGSTD Black', '<ul><li>USB адаптер для Samsung Galaxy Tab 10.1 P7500 и 8.9 P7300</li></ul>', '<p><strong>USB адаптер Samsung EPL-1PL0BEGSTD Black</strong></p><ul>    <li>Совместимость: Samsung Galaxy Tab 10.1 P7500 и Samsung Galaxy Tab 8.9 P7300</li>    <li>Тип карт памяти: SD/MicroSD</li>    <li>Интерфейс: USB</li>    <li>Материал: пластик<br>     </li></ul>', NULL, NULL, NULL),
(11215, 'ru', 'Дата-кабель Samsung ECC1DP0UBECSTD Black', '<ul><li> Дата-кабель для Samsung Galaxy Tab</li></ul>', '<p>Дата-кабель для Samsung Galaxy Tab с возможностью зарядки</p><ul>    <li>Разъем: P30</li>    <li>Длина кабеля: 1 м</li>    <li>Совместимость: Galaxy Tab<br>     </li></ul>', NULL, NULL, NULL),
(11216, 'ru', 'Защитная пленка Samsung ETC-P1G5CEGSTD P3100/P3110', '<ul><li> Комплект из 2-х защитных пленок и тряпочки для протирки для Samsung P3100/P3110</li></ul>', '<ul>    <li>Комплект из 2-х защитных пленок и тряпочки для протирки</li>    <li>Совместимость: Samsung Galaxy Tab 2 7.0 (<a>P3100</a>/<a>P3110</a>)</li></ul>', NULL, NULL, NULL),
(11217, 'ru', 'Кабель для подключения к телевизору Samsung EPL-3FHUBEGSTD Black', '<ul><li> Кабель для подключения к HD телевизору </li><li> Для Samsung I9300 Galaxy SIII</li></ul>', '<p>С помощью кабеля EPL-3FHUBEGSTD, вы можете вывести ваше приложение, веб-презентации, фото или видео на большом экране телевизора с помощью HDMI-разъема.</p><p><strong>Ключевые характеристики: </strong></p><ul>    <li>Преобразование MHL -> HDMI</li>    <li>Поддержка HD сигнала до 1080p</li>    <li>Вход: Micro USB (11pin)</li>    <li>Выход: HDMI</li>    <li>Мощность: Micro USB (5pin)</li>    <li>Цвет: Черный</li>    <li>Габариты: 67 х 142 х 18 мм</li></ul>', NULL, NULL, NULL),
(11218, 'ru', 'Клавиатура Samsung EKD-K11RWEGSER P3100/P3110 Black', '<ul><li> Для Samsung P3100/P3110</li><li> Цвет – черный</li></ul>', '<p>Клавиатура с аудиовыходом 3.5 мм и возможностью подзарядки</p><p>Совместимость: Samsung <a>P3100</a>/<a>P3110</a><br> </p>', NULL, NULL, NULL),
(11219, 'ru', 'Клавиатура Samsung EKD-K12RWEGSER P5100/P5110 Black', '<ul><li> Для Samsung P5100/P5110</li><li> Цвет – черный</li></ul>', '<p>Клавиатура с аудиовыходом 3.5 мм и возможностью подзарядки</p><p>Совместимость: Samsung <a>P5100</a>/<a>P5110</a><br> </p>', NULL, NULL, NULL),
(11220, 'ru', 'Подставка Samsung EDD-D1C9BEGSTD Black', '<ul><li> Для Samsung P7300</li></ul>', '<p>Настольная подставка с аудио выходом (3.5 мм) и возможностью подзарядки для Samsung <a>P7300</a>.</p>', NULL, NULL, NULL),
(11221, 'ru', 'Подставка-держатель Samsung EBH-1E1SBEGSTD Black', '<ul><li>Подставка-держатель для телефона</li></ul>', '<p>Подставка-держатель для телефона с возможностью зарядки дополнительного аккумулятора</p>', NULL, NULL, NULL),
(11222, 'ru', 'Стилус Samsung ET-S100EBEGSTD Black', '<ul><li>Стилус для Samsung N7000</li></ul>', '<p>Черный стилус для Samsung N7000.</p>', NULL, NULL, NULL),
(11223, 'ru', 'Стилус Samsung ETC-S10CSEGSTD I9300 Silver', '<ul><li> Стилус для Samsung I9300</li></ul>', '<ul>    <li>Стилус для Samsung I9300</li>    <li>Совместимость: <a>Samsung GT-I9300 Galaxy S III</a></li></ul>', NULL, NULL, NULL),
(11224, 'ru', 'Стилус Samsung ETC-S1J9SEGSTD N7100 Dark Silver', '<ul><li> Стилус для Samsung N7100</li></ul>', '<ul>    <li>Стилус</li>    <li>Совместимость: <a>Samsung Galaxy Note II (N7100)</a></li></ul>', NULL, NULL, NULL),
(11225, 'ru', 'Стилус Samsung ETC-S1J9WEGSTD N7100 White', '<ul><li> Стилус для Samsung N7100</li></ul>', '<ul>    <li>Стилус</li>    <li>Совместимость: <a>Samsung Galaxy Note II (N7100)</a></li></ul>', NULL, NULL, NULL),
(11226, 'ru', 'Универсальная подставка Samsung EDD-D100BEGSTD Black', '<ul><li> Универсальная подставка с аудиовыходом для Galaxy Tab</li></ul>', '<p>Универсальная подставка с аудиовыходом для Galaxy Tab</p><ul>    <li>Интерфейс: аудиовыход 3.5 мм</li>    <li>Совместимость: Galaxy Tab / Tab 2</li>    <li>Размеры (ШхВхГ): 104 х 42 х 96 мм</li>    <li>Вес: 0.15 кг</li></ul>', NULL, NULL, NULL),
(11227, 'ru', 'Универсальная подставка Samsung EDD-D200BEGSTD Black', '<ul><li> Универсальная подставка с аудиовыходом</li></ul>', '<ul>    <li>Универсальная подставка с аудиовыходом</li>    <li>Может использоваться в книжной или альбомной ориентации</li>    <li>Тип разъема: Micro-USB</li>    <li>Совместимость: <a>Samsung I9300 Galaxy S III</a><br>     </li></ul>', NULL, NULL, NULL),
(12215, 'ru', 'Чехол-футляр Samsung EFC-1J9LDEGSTD N7100 Dark Brown', '<ul><li> Материал - искусственная кожа</li><li> Цвет – темно коричневый</li></ul>', '<ul>    <li>Чехол-футляр. Оптимальная защита и модный аксессуар.</li>    <li>Совместимость: <a>Samsung Galaxy Note II (N7100)</a></li></ul>', NULL, NULL, NULL),
(12737, 'ru', 'ЖК-телевизор BBK LEM2249HD Black', '<ul><li>ЖК-телевизор BBK LEM2249HD Black</li><li> Диагональ экрана 21.5</li><li> Разрешение экрана 1920 x 1080</li><li> Яркость 250 кд/м2, контрастность 1000:1 </li><li><i>Черный цвет</i></li></ul>', '<p><strong>Оснащение</strong></p><ul>    <li>Высококачественная цветная TFT-матрица с диагональю 55 см</li>    <li>Максимальное разрешение 1920x1080</li>    <li>2 цифровых аудио-, видеоинтерфейса HDMI</li>    <li>Разъем VGA и линейный аудиовход</li>    <li>Компонентный видеовход</li>    <li>Композитный видеовход</li>    <li>Стереофонический аудиовход</li>    <li>Видеовход SCART</li>    <li>USB2.0-порт, позволяющий воспроизводить все известные форматы (в том числе HD-Video файлы)</li>    <li>Русифицированное меню</li>    <li>Совместимость с настенными креплениями стандарта VESA</li>    <li>Настройка цветовой температуры</li>    <li>Регулировка тембра, баланса акустической системы</li>    <li>Предустановленные настройки звука</li></ul><p><strong>Режим телевизора</strong></p><ul>    <li>Чувствительный тюнер, обеспечивающий уверенный прием аналоговых каналов</li>    <li>Функция автоматического и ручного поиска каналов</li>    <li>Поддержка NICAM стерео</li>    <li>Функция телетекста</li>    <li>Регулировка яркости, контрастности и предустановленные настройки изображения</li>    <li>Современные методы шумоподавления</li></ul><p><strong>Режим монитора персонального компьютера</strong></p><ul>    <li>Широкий диапазон поддерживаемых разрешений</li>    <li>Регулировка частоты и фазы<!--more--></li></ul>', NULL, NULL, NULL),
(13390, 'ru', 'Защитная пленка HTC P730 для One X', '<p><span>Оригинальная защитная пленка HTC SP P730 для One X (2шт) защищает экран вашего смартфона от потертостей и царапин. Данная модель - это оригинальная пленка от компании HTC.</span></p>', '<p><span>Жесткий слой пленки создает прочный и износостойкий барьер, который будет противостоять суровости бытового использования телефона. Защитная пленка помогает держать экран телефона в идеальном состоянии, защищая его от потертостей, царапин и повреждений.</span><br /><span>Защитная пленка легко наносится и не оставляет липких следов при удалении. Для нанесения пленки вам необходимо протереть экран телефона салфеткой, далее необходимо осторожно положить пленку вниз с одной стороны на другую. После этого, используя, например пластиковую карту, необходимо разгладить все пузыри воздуха. После нанесения защитной пленки вы заметите, что она стала практически невидимой.</span></p>', NULL, NULL, NULL),
(13391, 'ru', 'Защитная пленка Drobak Sony Xperia J ST26 ', '<p><span>Защитная пленка Drobak имеет особое антибликовое покрытие, благодаря чему даже в солнечную погоду Вы без труда сможете читать информацию с экрана.</span></p>', '', NULL, NULL, NULL),
(13389, 'ru', 'Защитная пленка HTC  P840 для Desire', '<p>Эффективно предохраняет экран от царапин, пыли, грязи и отпечатков пальцев. Не оставляет видимых пузырьков и других следов на поверхности дисплея. Пленка изготовлена на бесклеевой основе и крепится к поверхности экрана электростатическим способом, устойчива к появлению царапин. Пленка произведена в соответствии с размером дисплея и имеет все необходимые прорези. Вам не нужно ничего вырезать и подгонять, только установить пленку на экран</p>', '', NULL, NULL, NULL),
(13387, 'ru', 'Защитная пленка HTC SP P890 для WP8S (2шт)', '<div><em>HTC SP P890</em>&nbsp;- Оригинальная защитная пленка на экран для смартфона&nbsp;<strong>HTC Windows Phone 8S</strong>.</div>\n<div>\n<div id="description" class="tab-pane active">\n<div class="typografy">В комплект входят 2 пленки<span id="ctrlcopy"><a href="http://vilka.ua/mobile/mob-aksessory/HTC-SP-P890-WP8S-115004/"><br /></a></span>\n<p>&nbsp;</p>\n</div>\n</div>\n</div>', '<p><span>Защитная пленка &mdash; тонкое полимерное покрытие, как правило, покрытое с одной или с двух сторон клеящим составом (адгезивом), способным прилипать к защищаемой поверхности. Защитная пленка &mdash; это упаковочный материал предназначенный для временной защиты электронной, компьютерной техники от загрязнений, которые могут испортить внешний вид изделия или товара во время его транспортировки, хранения, монтажа и эксплуатации</span><span id="ctrlcopy"><a href="http://vilka.ua/mobile/mob-aksessory/HTC-SP-P890-WP8S-115004/"><br /></a></span></p>\n<p>&nbsp;</p>', NULL, NULL, NULL),
(13388, 'ru', 'Защитная пленка HTC  P870 для WP 8X', '<p><span>Защитная пленка &mdash; тонкое полимерное покрытие, как правило, покрытое с одной или с двух сторон клеящим составом (адгезивом), способным прилипать к защищаемой поверхности</span></p>', '<p><span>Защитная пленка &mdash; это упаковочный материал предназначенный для временной защиты электронной, компьютерной техники от загрязнений, которые могут испортить внешний вид изделия или товара во время его транспортировки, хранения, монтажа и эксплуатации. Со своими обязанностями HTC SP P870 для WP8X (2шт) справится на &laquo;отлично&raquo;, поскольку качество данной пленки на очень высоком уровне. Теперь Вы можете не переживать, что экран Вашего устройства повредится или запачкается &ndash; весь удар берет на себя эта защитная пленка, производителем которой является фирма HTC. При правильной установке HTC SP P870 для WP8X (2шт) Вы не только защитите свое устройство от повреждений и загрязнений, но и подарите себе чувство спокойствия и удовлетворения. Носите свое устройство в кармане, в сумке, в руках, где угодно, отныне защита Вашего устройства под контролем защитной пленки.</span><br /><span><br /></span></p>', NULL, NULL, NULL),
(13383, 'ru', 'Защитная пленка SAMSUNG N7100', '<p>Тип: глянцевая<br />Совместимость: Samsung N7100</p>', '<p><span>Защитная пленка поможет на протяжении всего срока его эксплуатации сохранять дисплей устройства целым и невредимым. Протектор оградит идеальный глянец дисплея от царапин и потертостей, образование которых неизбежно в процессе использования устройства, а также от оседания пыли и отпечатков пальцев.</span></p>', NULL, NULL, NULL),
(13384, 'ru', 'Защитная пленка Nokia Asha 311', '<p><span>Защитная &nbsp;плёнка подкупает своей прозрачностью, т.к она совершенно не видна на экране&nbsp;</span><span>Nokia Asha 306 / Nokia Asha 365</span></p>', '<p><span>Данная плёнка будет прекрасной защитой для вашего&nbsp;Nokia Asha&nbsp;306 / Nokia Asha 365&nbsp;от царапин и других различных повреждений</span><br /><span>- Эта плёнка будет служить вам долгое время</span><br /><span>- Вы с лёгкостью сможете как приклеить, так и отклеить защитную плёнку, не боясь что могут остаться неприятные следы</span><br /><span>- Можно не волноваться за качество и быстродействие работы экрана. Они не меняются</span></p>', NULL, NULL, NULL),
(13385, 'ru', 'Защитная пленка  Nokia 302 ', '<p><span>Защитная пленка сохранит внешний вид вашего мобильного устройства. Пленка обладает полной прозрачностью и не нарушает функциональности сенсорного дисплея. Не затемняет и не изменяет естественные цвета экрана.&nbsp;</span></p>', '', NULL, NULL, NULL),
(13381, 'ru', 'Защитная пленка Samsung S7562', '<p><span>Защитная пленка для Samsung Galaxy S Duos S7562 отлично защитит дисплей вашего телефона от царапин и потертостей. Она не искажает изображение и легко наклеивается.</span></p>', '', NULL, NULL, NULL),
(13382, 'ru', 'Защитная пленка Samsung Wave Y S5380', '<p><span>&nbsp;Защитные пленки для экранов дисплеев телефонов/КПК предназначены для защиты дисплея от внешних повреждений, таких как царапины, потертости, загрязнение.&nbsp;</span></p>', '<p><span style="font-family: ''times new roman'', times;">&nbsp;</span></p>', NULL, NULL, NULL),
(13386, 'ru', 'Защитная пленка HTC SP P900 для One SV (2шт) ', '<p>Продлите работоспособность хрупкого сенсорного экрана вашего смартфона HTC One SV с помощью фирменной защитной пленки HTC SP P900 для One SV (2шт).</p>', '<p><span>&nbsp;Она изготовлена специально для этой модели смартфона, а потому идеально подходит под размер дисплея. Кроме того, ее плюсами являются исключительная прозрачность и простота в использовании, благодаря которой после наклеивания на поверхности экрана никогда не остается пузырьков. Она убережет дисплей вашего смартфона от несильных механических повреждений, пятен, царапин или пыли. В комплекте идут две пленки, так что через некоторое время вы сможете сменить отработавшую на новую.</span></p>', NULL, NULL, NULL),
(13378, 'ru', 'Защитная пленка Samsung i9300 матовая', '<ul>\n<li>100% прозрачность;</li>\n<li>Без клея;</li>\n<li>Не искажает цвета;</li>\n<li>Не маркая;</li>\n<li>Не оставляет следов после снятия;</li>\n<li>Не препятствует тактильной передаче;</li>\n<li>Сверхтонкая и прочная.</li>\n</ul>', '<p><span>Защищает дисплей Вашего Samsung i9300 Galaxy S III, а также спасает от назойливых бликов яркого света дисплей ВашегоSamsung i9300 Galaxy S III, обеспечивая совершенно мягкую и полную передачу цветов изображения экрана. Покрыта слоем, предотвращающим появление отпечатков пальцев.</span></p>', NULL, NULL, NULL),
(13379, 'ru', 'Защитная пленка для Samsung  I9300 ', '<p><strong></strong></p>\n<table>\n<tbody>\n<tr>\n<td class="title">Тип</td>\n<td class="field">Пленки</td>\n</tr>\n<tr>\n<td class="title">Назначение</td>\n<td class="field">для мобильных телефонов</td>\n</tr>\n<tr>\n<td class="title">Совместимость</td>\n<td class="field">Samsung Galaxy S III I9300<span id="copyinfo"><br /></span></td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>&nbsp;</p>', '<p><span>Защитная пленка Drobak имеет особое антибликовое покрытие, благодаря чему, даже в солнечную погоду, Вы без труда сможете читать информацию с экрана.</span><span id="copyinfo"><br /><br /></span></p>', NULL, NULL, NULL),
(13380, 'ru', 'Защитная пленка Samsung i8160', '<p><span>Прозрачная защитная пленка полностью повторяет форму дисплея и практически не заметна. Не снижает чувствительность касания и яркость дисплея. Цена Samsung Samsung i8160 Clear Glass указана за комплект из &nbsp;двух плёнок.</span></p>', '', NULL, NULL, NULL),
(13376, 'ru', 'Защитная пленка Screen Ward Samsung S6102', '<table class="pp-tab-characteristics-table">\n<tbody>\n<tr class="color">\n<td class="title">Тип</td>\n<td class="field">Пленки</td>\n</tr>\n<tr>\n<td class="title">Назначение</td>\n<td class="field">для мобильных телефонов</td>\n</tr>\n<tr class="color">\n<td class="title">Совместимость</td>\n<td class="field">Samsung S6102 Galaxy Y Duos</td>\n</tr>\n</tbody>\n</table>\n<p><span id="copyinfo"><br /><br /></span></p>', '<p><span>Ультрапрозрачная защитная пленка ADPO ScreenWard отличается высокой прозрачностью структуры (99%), поглощением отраженных ультрафиолетовых лучей, легкостью установки на экран. Изготовлена пленка из cверх прозрачного многослойного материала, произведенного в Японии.&nbsp;</span><br /><br /></p>', NULL, NULL, NULL),
(13377, 'ru', 'Защитная пленка Screen Ward Samsung S5660', '', '<p><span>Защитная пленка для Samsung S5660 изготовлена из высококачественных японских материалов. Пленка не препятствует управлению гаджетом, а также не понижает цветопередачу экрана телефона. Благодаря статическому способу нанесения, пленка для Samsung S5660 не оставляет следов и пятен на дисплее, поэтому удалить при необходимости с экрана телефона ее можно без следов. Пленка для Samsung S5660 отлично защитит экран вашего телефона от царапин, грязи и пыли, надолго сохранив презентабельный вид вашего телефона</span></p>', NULL, NULL, NULL),
(13891, 'ru', 'Карта памяти GOODRAM microSD 2 GB (+ адаптер Retail 10)', '<ul><li><i>Емкость 2 GB<br></i></li><li>В комплекте адаптер Retail 10</li></ul>', '<p>Карты памяти GOODRAM модели microSDHC были разработаны специально для мобильных устройств. Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.  <br><br>Скорость считывания и записи, а также бессрочная гарантия - вот несомненные достоинства карт microSDHC GOODRAM.</p>', NULL, NULL, NULL),
(13892, 'ru', 'Карта памяти GOODRAM microSD 2 GB Retail 9 (+ адаптер)', '<ul><li><i>Емкость 2 GB<br></i></li><li>В комплекте адаптер</li></ul>', '<p>Карты памяти GOODRAM модели microSDHC были разработаны специально для мобильных устройств. Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.  <br><br>Скорость считывания и записи, а также бессрочная гарантия - вот несомненные достоинства карт microSDHC GOODRAM.</p>', NULL, NULL, NULL),
(13893, 'ru', 'Карта памяти GOODRAM microSD 4 GB (+ адаптер и USB-кадтридер)', '<ul><li><i>Емкость 4 GB<br></i></li><li>В комплекте адаптер и USB-кадтридер</li></ul>', '<p>Карты памяти GOODRAM модели microSDHC были разработаны специально для мобильных устройств. Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.  <br><br>Скорость считывания и записи, а также бессрочная гарантия - вот несомненные достоинства карт microSDHC GOODRAM.</p>', NULL, NULL, NULL);
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(13894, 'ru', 'Карта памяти GOODRAM microSD 8 GB (+ адаптер и USB-кадтридер)', '<ul><li><i>Емкость 8 GB<br></i></li><li>В комплекте адаптер и USB-кадтридер</li></ul>', '<p>Карты памяти GOODRAM модели microSDHC были разработаны специально для мобильных устройств. Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.  <br><br>Скорость считывания и записи, а также бессрочная гарантия - вот несомненные достоинства карт microSDHC GOODRAM.</p>', NULL, NULL, NULL),
(13895, 'ru', 'Карта памяти GOODRAM microSDHC 16 GB Class 10 (+ адаптер Retail 10)', '<ul><li><i>Емкость 16 GB<br></i></li><li>В комплекте адаптер Retail 10</li></ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p><p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p><p>Скорость считывания и записи, а также бессрочная гарантия – вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', NULL, NULL, NULL),
(13896, 'ru', 'Карта памяти GOODRAM microSDHC 16 GB Class 10 (+ адаптер)', '<ul><li><i>Емкость 16 GB<br></i></li><li>В комплекте адаптер</li></ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p><p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p><p>Скорость считывания и записи, а также бессрочная гарантия – вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', NULL, NULL, NULL),
(13897, 'ru', 'Карта памяти GOODRAM microSDHC 16 GB Class 10 UHS I (+ адаптер Retail 10)', '<ul><li><i>Емкость 16 GB<br></i></li><li>В комплекте адаптер Retail 10</li></ul>', '<p>Карты памяти <strong>GOODRAM microSDHC UHS1 class 10</strong> совместимы с ультраскоростным интерфейсом UHS 1, позволяющим достичь в несколько раз высших, по сравнению со стандартными картами, рабочих параметров. Вместе с тем, они обратно совместимы с устройствами, поддерживающими стандарт работы 2.0. В этом случае карта будет работать с минимальными рабочими параметрами, соответствующими 10-му классу скорости (мин.10 МБ/с).</p>', NULL, NULL, NULL),
(13898, 'ru', 'Карта памяти GOODRAM microSDHC 16 GB Class 4 (+ адаптер)', '<ul><li><i>Емкость 16 GB<br></i></li><li>В комплекте адаптер</li></ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p><p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p><p>Скорость считывания и записи, а также бессрочная гарантия – вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', NULL, NULL, NULL),
(13899, 'ru', 'Карта памяти GOODRAM microSDHC 32 GB Class 10 (+ адаптер Retail 10)', '<ul><li><i>Емкость 32 GB<br></i></li><li>В комплекте адаптер Retail 10</li></ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p><p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p><p>Скорость считывания и записи, а также бессрочная гарантия – вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', NULL, NULL, NULL),
(13900, 'ru', 'Карта памяти GOODRAM microSDHC 32 GB Class 10 (+адаптер)', '<ul><li><i>Емкость 32 GB<br></i></li><li>В комплекте адаптер</li></ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p><p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p><p>Скорость считывания и записи, а также бессрочная гарантия – вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', NULL, NULL, NULL),
(13901, 'ru', 'Карта памяти GOODRAM microSDHC 32 GB Class 10 UHS I (+ адаптер Retail 10)', '<ul><li><i>Емкость 32 GB<br></i></li><li>В комплекте адаптер Retail 10</li></ul>', '<p>Карты памяти <strong>GOODRAM microSDHC UHS1 class 10</strong> совместимы с ультраскоростным интерфейсом UHS 1, позволяющим достичь в несколько раз высших, по сравнению со стандартными картами, рабочих параметров. Вместе с тем, они обратно совместимы с устройствами, поддерживающими стандарт работы 2.0. В этом случае карта будет работать с минимальными рабочими параметрами, соответствующими 10-му классу скорости (мин.10 МБ/с).</p>', NULL, NULL, NULL),
(13902, 'ru', 'Карта памяти GOODRAM microSDHC 32 GB Class 4 (+ адаптер)', '<ul><li><i>Емкость 32 GB<br></i></li><li>В комплекте адаптер</li></ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p><p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p><p>Скорость считывания и записи, а также бессрочная гарантия – вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', NULL, NULL, NULL),
(13903, 'ru', 'Карта памяти GOODRAM microSDHC 4 GB Class 4 (+ адаптер Retail 10)', '<ul><li><i>Емкость 4 GB<br></i></li><li>В комплекте адаптер Retail 10</li></ul>', '<p>Карты памяти GOODRAM модели microSDHC были разработаны специально для мобильных устройств. Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.  <br><br>Скорость считывания и записи, а также бессрочная гарантия - вот несомненные достоинства карт microSDHC GOODRAM.</p>', NULL, NULL, NULL),
(13904, 'ru', 'Карта памяти GOODRAM microSDHC 4 GB Class 4 Retail 9 (+ адаптер)', '<ul>\n<li><em>Емкость 4 GB<br /></em></li>\n<li>В комплекте адаптер</li>\n</ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p>\n<p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p>\n<p>Скорость считывания и записи, а также бессрочная гарантия &ndash; вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', '', '', ''),
(13905, 'ru', 'Карта памяти GOODRAM microSDHC 8 GB Class 10 (+ адаптер Retail 10)', '<ul><li><i>Емкость 8 GB<br></i></li><li>В комплекте адаптер Retail 10</li></ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p><p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p><p>Скорость считывания и записи, а также бессрочная гарантия – вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', NULL, NULL, NULL),
(13906, 'ru', 'Карта памяти GOODRAM microSDHC 8 GB Class 10 (+ адаптер)', '<ul><li><i>Емкость 8 GB<br></i></li><li>В комплекте адаптер</li></ul>', '<p>Карты памяти GOODRAM модели microSD (microSDHC) были разработаны специально для мобильных устройств.</p><p>Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.</p><p>Скорость считывания и записи, а также бессрочная гарантия – вот несомненные достоинства карт microSD (microSDHC) GOODRAM.</p>', NULL, NULL, NULL),
(13907, 'ru', 'Карта памяти GOODRAM microSDHC 8 GB Class 4 (+ адаптер Retail 10)', '<ul><li><i>Емкость 8 GB<br></i></li><li>В комплекте адаптер Retail 10</li></ul>', '<p>Карты памяти GOODRAM модели microSDHC были разработаны специально для мобильных устройств. Поэтому они идеально подходят для сотовых телефонов, навигаторов и плееров.  <br><br>Скорость считывания и записи, а также бессрочная гарантия - вот несомненные достоинства карт microSDHC GOODRAM.</p>', NULL, NULL, NULL),
(14194, 'ru', ' Гарнитура  Nokia BH-108 ice', '<p><span><strong>Питание</strong><br /><span>Литиево-полимерный аккумулятор 80 мАч.</span><br /><strong>Время работы от батареи</strong><br /><span>В режиме разговора: до 5 ч.</span><br /><span>В режиме ожидания: до 120 дней.</span><br /><span>Время зарядки: 2 ч.</span></span></p>\n<p><span><span><strong>Габаритные размеры</strong><br /><span>53,5 x 16,2 x 8,3 мм.</span><br /><strong>Вес</strong><br /><span>9 г.</span></span></span></p>', '<p>Nokia BH-108 - это компактная беспроводная гарнитура с удобным наушником и простыми элементами управления.</p>\n<p>Включайте и выключайте вашу гарнитуру или принимайте и завершайте вызовы с помощью удобной многофункциональной клавиши &mdash; для сохранения контроля достаточно одного касания.</p>', NULL, NULL, NULL),
(14196, 'ru', ' Гарнитура Jabra EASY CALL', '<p>- Голосовое оповещение о статусе батареи и соединения</p>\n<p>- Multiuse&trade; &ndash; одновременное соединение с 2 устройствами Bluetooth&reg;</p>\n<p>- Силиконовые ушные вкладыши Jabra Ultimate Comfort Eargel&trade;</p>\n<p>- Технология Bluetooth&reg; 2.1 для быстрого и безопасного сопряжения</p>\n<p>- Кристально чистый звук и голос (технология цифровой обработки сигналов)</p>\n<p>- До 6 часов в режиме разговора и до 8 дней в режиме ожидания</p>\n<p>- Данная гарнитура обладает совместимостью с устройствами, которые поддерживают&nbsp;Bluetooth Headset и Handsfree</p>', '<p>&nbsp;</p>\n<p>&nbsp;</p>', NULL, NULL, NULL),
(14198, 'ru', 'Гарнитура Jabra BT2045', '', '<p><span>Устройство обладает рядом преимуществ, помимо того, что гарнитура удобная, компактная, практичная, она отлично звучит. Гарнитура обеспечивает продолжительность работы в режиме разговора до 6 часов и до 5 дней в режиме ожидания.&nbsp;С помощью функции шумоподавления Ваш собеседник будет превосходно слышать Вас.&nbsp;Гарнитура совместима с телефонами с поддержкой Bluetooth 2.1. Гарнитура обладает рядом преимуществ, таких как: индикатор состояния гарнитуры, голосовые оповещения, технология Multipoint&nbsp;и многое другое.</span></p>', NULL, NULL, NULL),
(14200, 'ru', 'Гарнитура  Jabra EASYGO', '<p><span>Тип гарнитуры Bluetooth Спецификация Bluetooth Технология Bluetooth&reg; 2.1 для быстрого и безопасного сопряжения Максимальная дальность связи 10 м Время работы от батареи: разговор/ожидание (ч) до 6/8 дней в режиме разговора/ожидания Размер, мм 53.7-15.8-9 мм Вес, г 8 г</span><br /><span><br /></span></p>', '<p><span>Вы подбираете себе вашу первую гарнитуру Bluetooth? Jabra EASYGO избавит вас от сложностей выбора нужной модели. Эта гарнитура предоставит вам все уникальные преимущества беспроводного общения по непревзойденной цене. В ней нет сложных функций, а установка происходит быстро и интуитивно. Jabra EASYGO - эти стильная и одновременно с этим незаметная гарнитура. Благодаря ее легкому весу и форме вы с удовольствием будете носить эту гарнитуру целый день. Технология цифровой обработки сигналов обеспечивает кристально чистый звук, а функция автоматической регулировки громкости поддерживает громкость на постоянном уровне при перемещении из тихих в шумные помещения. Функции голосового предупреждения напомнят вам о необходимости зарядить аккумулятор или сообщат о прерывании соединения с вашим телефоном. Гарнитуру Jabra EASYGO можно одновременно подключать к двум устройствам Bluetooth.</span></p>', NULL, NULL, NULL),
(14201, 'ru', 'Гарнитура Nokia BH-220 black ', '<table id="decoratedTable0" class="decorated-table">\n<tbody>\n<tr class="odd">\n<td>Тип гарнитуры</td>\n<td class="last">Bluetooth</td>\n</tr>\n<tr class="even">\n<td>Спецификация Bluetooth</td>\n<td class="last">Bluetooth 2.1 с увеличенной скоростью передачи данных</td>\n</tr>\n<tr class="odd">\n<td>Максимальная дальность связи</td>\n<td class="last">10 м</td>\n</tr>\n<tr class="even">\n<td>Время работы от батареи: разговор/ожидание (ч)</td>\n<td class="last">В режиме разговора: до 8 часов (2 часа с гарнитурой, 6 часов в подставке (Bluetooth))&nbsp;<br />Время работы в режиме ожидания: до 60 дней на подставке, до 35 часов без подставки</td>\n</tr>\n<tr class="odd">\n<td>Размер, мм</td>\n<td class="last">гарнитура: 25,31 x 24,00 x 26,36 мм<br />подставка: 48,98 x 48,87 x 29,95 мм</td>\n</tr>\n<tr class="even">\n<td>Вес, г</td>\n<td class="last">гарнитура: 5 г,<br />подставка: 18,3 г</td>\n</tr>\n<tr class="odd">\n<td>Разъемы</td>\n<td class="last">интерфейс для зарядки microUSB (на подставке для подзарядки)</td>\n</tr>\n<tr class="even">\n<td>Функции</td>\n<td class="last">Принятие звонка.<br />Сброс звонка.<br />Подзарядка гарнитуры<br />Автоматическая регулировка громкости.</td>\n</tr>\n<tr class="odd">\n<td>Совместимость</td>\n<td class="last">Телефоны с функцией NFC: Nokia 700, Nokia 701, Nokia 603</td>\n</tr>\n<tr class="even">\n<td>Другие функции</td>\n<td class="last">Возможность подключения 2 телефонов</td>\n</tr>\n</tbody>\n</table>', '<p><span>Bluetooth-гарнитура Nokia BH-220 black имеет стильный дизайн, малый вес и потрясающего качества звук. В гарнитуре применена технология Always Ready. Чтобы достать гарнитуру необходимо просто нажать на кнопку в центре. Держатель удобен как для хранения так и для зарядки гарнитуры. Эта модель не похожа ни на одну другую, однако очень удобна в пользовании. Это наиболее интересная гарнитура за все времена - с привлекательным дизайном, изысканными цветами и выдвижным механизмом. Гарнитура всегда готова к использованию - только снимите гарнитуру с подставки, чтобы ответить на вызов или завершить его. Просто прикоснитесь устройством к совместимому телефону с функцией NFC, чтобы подключиться к нему. Подключение через NFC возможно для следующих устройств: Nokia 700, Nokia 701, Nokia 603. Есть возможность подключиться к 2 телефонам одновременно с помощью усовершенствованного многоканального разъема. Полезные голосовые подсказки, которыми оснащена данная модель, информируют о подключении и оповещают о состоянии батареи. Продолжительность работы в режиме ожидания (при хранении на подставке) составляет 2 месяца. Заявите о себе, выбрав беспроводную гарнитуру Nokia данной модели.</span></p>', NULL, NULL, NULL),
(14202, 'ru', 'Гарнитура Nokia BH-112 Black', '<p><span>Производителем предусмотрена поддержка многоточечных соединений, батарея продолжительностью работы до 5 часов в режиме разговора (150 часов в режиме ожидания) и 2-миллиметровый адаптер. При размерах 40 мм x 20 мм x 25 мм устройство весит всего 8, 1 граммов</span></p>', '<p><span>Освободите руки с помощью яркой и стильной Bluetooth-гарнитуры Nokia BH-112. Компактная, удобная и чрезвычайно простая в использовании легкая беспроводная гарнитура совместима с широким спектром мобильных телефонов. Небольшой вес и удобное крепление с двумя вариантами размеров заушных петель помогут Вам разговаривать комфортно</span></p>', NULL, NULL, NULL),
(14203, 'ru', 'Гарнитура  Nokia HS-47 вакуумная', '<table id="decoratedTable0" class="decorated-table">\n<tbody>\n<tr class="odd">\n<td>Тип гарнитуры</td>\n<td class="last">Проводная</td>\n</tr>\n<tr class="even">\n<td>Функции</td>\n<td class="last">Кнопка принятия/сброса звонка</td>\n</tr>\n<tr class="odd">\n<td>Совместимость</td>\n<td class="last">Совместим (ма, мо) с моделями: Nokia N95, N76, E90, E51, 8600 Luna, 7500 Prism,7390, 6500 Slide, 6300, 6110 Navigator, 5300 Xpress Music, 5200, 6290, 3500 Classic, 3110 Classic, 2760, 2630, 1650, 1208, 1200</td>\n</tr>\n<tr class="even">\n<td>Комплектация</td>\n<td class="last">вакуумная оригинальная гарнитура Nokia HS-47, зарядное устройство Nokia HS-47, руководство пользователя</td>\n</tr>\n</tbody>\n</table>', '<p><span>Эта замечательная оригинальная стереогарнитура Nokia HS-47 создана для тех, кто любит музыку и хочет принимать вызовы, не снимая наушники. А автоматическая функция отключения звука во время приема вызова на этой гарнитуре гарантирует, что вы ничего не пропустите. Кстати, данная функция - основная характеристика данной модели. Nokia HS-47 имеет качественный микрофон с кнопкой обработки вызовов. Имеется разъем 2,5 мм и переходник на разъем 3,5 мм, также есть автоматическая функция отключения звука во время приема вызова. Длина шнура - 1.3 м, цвет корпуса - черный.</span></p>', NULL, NULL, NULL),
(14204, 'ru', 'Гарнитура Nokia WH-701 ', '<table id="decoratedTable0" class="decorated-table">\n<tbody>\n<tr class="odd">\n<td>Тип гарнитуры</td>\n<td class="last">Проводная</td>\n</tr>\n<tr class="even">\n<td>Размер, мм</td>\n<td class="last">Шнур: 1350 мм, пульт дистанционного управления: 12,7 x 12,2 x 76 мм</td>\n</tr>\n<tr class="odd">\n<td>Функции</td>\n<td class="last">* Ответ / завершение вызова * Уменьшение / увеличение громкости * Воспроизведение / пауза * Предыдущий трек * Следующий трек</td>\n</tr>\n<tr class="even">\n<td>Совместимость</td>\n<td class="last">Для использования с устройствами, совместимыми с аудиовизуальным разъемом Nokia 3,5 мм.</td>\n</tr>\n<tr class="odd">\n<td>Комплектация</td>\n<td class="last">Стереогарнитура Nokia WH-701, наушники трех размеров</td>\n</tr>\n<tr class="even">\n<td>Другие функции</td>\n<td class="last">Кнопка принятия/сброса звонка, кнопка сброса звонка, управление плеером телефона</td>\n</tr>\n</tbody>\n</table>', '', NULL, NULL, NULL),
(14205, 'ru', 'Гарнитура Nokia WH-205 stereo ', '<table id="decoratedTable0" class="decorated-table">\n<tbody>\n<tr class="odd">\n<td>Тип гарнитуры</td>\n<td class="last">Проводная</td>\n</tr>\n<tr class="even">\n<td>Максимальная дальность связи</td>\n<td class="last">шнур: 1350 мм</td>\n</tr>\n<tr class="odd">\n<td>Вес, г</td>\n<td class="last">14 г</td>\n</tr>\n<tr class="even">\n<td>Функции</td>\n<td class="last">Клавиша ответ, клавиша закончить вызов</td>\n</tr>\n<tr class="odd">\n<td>Совместимость</td>\n<td class="last">совместима с устройствами Nokia с разъемом 3,5 мм.</td>\n</tr>\n<tr class="even">\n<td>Комплектация</td>\n<td class="last">Стереогарнитура, ушные вкладыши трех размеров</td>\n</tr>\n</tbody>\n</table>', '<p><span>Стереонаушники Nokia WH-205 stereo имеют в комлекте, 3 пары мягких ушных вкладок, также на шнуре присутствует шнур управления. Подключите эти наушники к совместимому устройству и наслаждайтесь любимыми записями, в качественном стереозвучании. Эта небольшая гарнитура с шнуром, который не путается создана для вашего комфорта. Совместима с устройствами Nokia, которые имеют разъем 3,5 мм. А благодаря клавише ответ, положить трубку, звонками можно регулировать одним нажатием пальца.</span></p>', NULL, NULL, NULL),
(14206, 'ru', 'Гарнитура HTC RC E190 black ', '<table id="decoratedTable0" class="decorated-table">\n<tbody>\n<tr class="odd">\n<td>Тип гарнитуры</td>\n<td class="last">Проводная</td>\n</tr>\n<tr class="even">\n<td>Вес, г</td>\n<td class="last">20</td>\n</tr>\n<tr class="odd">\n<td>Разъемы</td>\n<td class="last">3.5 мм</td>\n</tr>\n</tbody>\n</table>', '<p><span>Проводная гарнитура HTC RC E190 black подходит для коммуникаторов HTC с разъемом 3.5 мм.</span><br /><span>Гарнитура позволяет не только слушать музыку с качественным звуком, но и принимать звонки. Данная модель оснащена высокочувствительным микрофоном, который обеспечивает великолепный звук, и ваш собеседник будет слышать вас так, словно вы находитесь рядом. Еще одна приятная особенность данной гарнитуры заключается в том, что в этой модели использован плоский провод, благодаря которому наушники гораздо меньше запутываются.</span></p>', NULL, NULL, NULL),
(14775, 'ru', 'Наушники Ergo VD-290 Black', '<ul><li> Частотный диапазон 18 Гц – 20 кГц </li><li> <i>Черный цвет</i></li></ul>', '<p><strong>ERGO VD-290</strong> — это накладные наушники закрытого типа с отличным насыщенным звучанием, широким частотным диапазоном от 18 Гц до 20 кГц и глубоким чувством стиля. Наушники ERGO VD-290 созданы специально для меломанов, не представляющих свою жизнь без музыки.</p><p>Мягкие и удобные изолирующие подушки защитят чистое звучание музыки от воздействия шумов окружающей среды, а также позволят наслаждаться любимой музыкой на протяжении долгого времени. Благодаря гибкому оголовью, ERGO VD-290 надежно фиксируются на голове, не создавая при этом дискомфорт.</p><p><strong>Особенности<br></strong></p><ul>    <li>Закрытое акустическое оформление обеспечивает прекрасную звукоизоляцию</li>    <li>Широкий частотный диапазон</li>    <li>Современный дизайн</li>    <li>Доступные цвета: черный, белый</li></ul>', NULL, NULL, NULL),
(16825, 'ru', 'Наушники Ergo VD-290 White', '<ul><li> Частотный диапазон 18 Гц – 20 кГц </li><li> <i>Белый цвет</i></li></ul>', '<p><strong>ERGO VD-290</strong> — это накладные наушники закрытого типа с отличным насыщенным звучанием, широким частотным диапазоном от 18 Гц до 20 кГц и глубоким чувством стиля. Наушники ERGO VD-290 созданы специально для меломанов, не представляющих свою жизнь без музыки.</p><p>Мягкие и удобные изолирующие подушки защитят чистое звучание музыки от воздействия шумов окружающей среды, а также позволят наслаждаться любимой музыкой на протяжении долгого времени. Благодаря гибкому оголовью, ERGO VD-290 надежно фиксируются на голове, не создавая при этом дискомфорт.</p><p><strong>Особенности<br></strong></p><ul>    <li>Закрытое акустическое оформление обеспечивает прекрасную звукоизоляцию</li>    <li>Широкий частотный диапазон</li>    <li>Современный дизайн</li>    <li>Доступные цвета: черный, белый</li></ul>', NULL, NULL, NULL),
(16826, 'ru', 'Наушники Ergo VD-390 Gold', '<ul><li> Частотный диапазон 18 Гц – 20 кГц </li><li> <i>Золотистый цвет</i></li></ul>', '<p>Погрузитесь в мир музыки и получайте массу положительных эмоций от прослушивания любимых музыкальных композиций вместе наушниками <strong>ERGO VD-390</strong>. Насыщенные басы, широкий частотный диапазон и естественная передача оттенков вокала позволят насладиться музыкой именно в том виде, в котором она была исполнена музыкантом.</p><p>Благодаря своей компактной конструкции и гибкому оголовью, наушники ERGO VD-390 отлично сидят на голове и обеспечивают высокий уровень комфорта при длительном использовании.</p><p><strong>Особенности<br></strong></p><ul>    <li>Широкий частотный диапазон</li>    <li>Впечатляющие басы</li>    <li>Прочная конструкция с гибким оголовьем</li>    <li>Кабель длиной 1.2 м</li>    <li>Доступные цвета: золотистый, серый, красный</li></ul>', NULL, NULL, NULL),
(16827, 'ru', 'Наушники Ergo VD-390 Grey', '<ul><li> Частотный диапазон 18 Гц – 20 кГц </li><li> <i>Серый цвет</i></li></ul>', '<p>Погрузитесь в мир музыки и получайте массу положительных эмоций от прослушивания любимых музыкальных композиций вместе наушниками <strong>ERGO VD-390</strong>. Насыщенные басы, широкий частотный диапазон и естественная передача оттенков вокала позволят насладиться музыкой именно в том виде, в котором она была исполнена музыкантом.</p><p>Благодаря своей компактной конструкции и гибкому оголовью, наушники ERGO VD-390 отлично сидят на голове и обеспечивают высокий уровень комфорта при длительном использовании.</p><p><strong>Особенности<br></strong></p><ul>    <li>Широкий частотный диапазон</li>    <li>Впечатляющие басы</li>    <li>Прочная конструкция с гибким оголовьем</li>    <li>Кабель длиной 1.2 м</li>    <li>Доступные цвета: золотистый, серый, красный</li></ul>', NULL, NULL, NULL),
(16828, 'ru', 'Наушники Ergo VD-390 Red', '<ul><li> Частотный диапазон 18 Гц – 20 кГц </li><li> <i>Красный цвет</i></li></ul>', '<p>Погрузитесь в мир музыки и получайте массу положительных эмоций от прослушивания любимых музыкальных композиций вместе наушниками <strong>ERGO VD-390</strong>. Насыщенные басы, широкий частотный диапазон и естественная передача оттенков вокала позволят насладиться музыкой именно в том виде, в котором она была исполнена музыкантом.</p><p>Благодаря своей компактной конструкции и гибкому оголовью, наушники ERGO VD-390 отлично сидят на голове и обеспечивают высокий уровень комфорта при длительном использовании.</p><p><strong>Особенности<br></strong></p><ul>    <li>Широкий частотный диапазон</li>    <li>Впечатляющие басы</li>    <li>Прочная конструкция с гибким оголовьем</li>    <li>Кабель длиной 1.2 м</li>    <li>Доступные цвета: золотистый, серый, красный</li></ul>', NULL, NULL, NULL),
(16829, 'ru', 'Гарнитура внутриканального типа Ergo VM-901 Black', '<ul><li> Частотный диапазон 18 Гц - 20 кГц </li><li><i>Черный цвет</i></li></ul>', '<ul>    <li>Идеальный вариант для прослушивания музыки и общения</li>    <li>3.5мм адаптер для максимальной совместимости с мобильными телефонами</li>    <li>Прочный плоский кабель</li>    <li>Варианты цвета – черный</li></ul><p><strong>Характеристики микрофона: </strong></p><ul>    <li>Размер: D4x1.5 мм</li>    <li>Чувствительность: -42±4 дБ</li>    <li>Частотный диапазон: 50 Гц – 16 кГц</li>    <li>Направленность: всенаправленный</li></ul>', NULL, NULL, NULL),
(16830, 'ru', 'Мультимедийная гарнитура Ergo VM-280 Black', '<ul><li> Частотный диапазон 18 Гц - 20 кГц </li><li><i>Черный цвет</i></li></ul>', '<ul>    <li>Великолепный комфорт благодаря мягким амбушюрам</li>    <li>Регулировка микрофона для четкого восприятия голоса</li>    <li>Односторонний кабель повышает удобство эксплуатации</li>    <li>Варианты цвета – черный, зеленый</li></ul><p><strong>Характеристики микрофона</strong>:</p><ul>    <li>Размер: d6x5 мм</li>    <li>Чувствительность: -58±2 дБ</li>    <li>Частотный диапазон: 30 Гц – 16 кГц</li>    <li>Направленность: всенаправленный</li></ul><p> </p>', NULL, NULL, NULL),
(16831, 'ru', 'Мультимедийная гарнитура Ergo VM-280 Green', '<ul><li> Частотный диапазон 18 Гц - 20 кГц </li><li><i>Зеленый цвет</i></li></ul>', '<ul>    <li>Великолепный комфорт благодаря мягким амбушюрам</li>    <li>Регулировка микрофона для четкого восприятия голоса</li>    <li>Односторонний кабель повышает удобство эксплуатации</li>    <li>Варианты цвета – черный, зеленый</li></ul><p><strong>Характеристики микрофона</strong>:</p><ul>    <li>Размер: d6x5 мм</li>    <li>Чувствительность: -58±2 дБ</li>    <li>Частотный диапазон: 30 Гц – 16 кГц</li>    <li>Направленность: всенаправленный</li></ul><p> </p>', NULL, NULL, NULL),
(16832, 'ru', 'Набор запасных накладных амбушюр KOSS Porta/Sporta Pro(6 шт)', '<ul><li>Набор запасных накладных амбушюр</li></ul>', '<p>Набор запасных накладных амбушюр для наушников KOSS PORTA PRO, SPORTA PRO, KSC7, KTXPro 1, KSC10, KSC11, KSC12, KSC17, KTX8, KTX16, PTX6, CX6, KSC75, UR5.</p>', NULL, NULL, NULL),
(16833, 'ru', 'Наушники  SENNHEISER IE 8i', '<ul><li> Частотный диапазон: 10 Гц - 20 кГц</li><li><i>Черный цвет</i></li></ul>', '<p>Благодаря уникальной технологии наушники  IE 8i позволяют точно настроить воспроизведение низких частот на Ваше усмотрение.  Динамики с мощными неодимовыми магнитами гарантируют непревзойденную точность и чистоту звука, а умный пульт дистанционного контроля и микрофон обеспечивают удобное управление треками и звонками. </p><p>Особенности:<o:p></o:p></p><ul>    <li>Система динамиков с мощными неодимовыми магнитами обеспечивает непревзойденную точность и чистоту звука</li>    <li>Умное дистанционное управление iPhone с помощью микрофона</li>    <li>Чрезвычайно крепкий корпус и прочный сменный кабель</li>    <li>Уникальная функция ручной настройки частотного диапазона</li>    <li>Элегантный эргономический дизайн внутриканальных наушников с разными типами и размерами (S/M/L) ушных амбушюров для наилучшей посадки внутри уха и отличного подавления внешних шумов</li></ul><p>·     Функция дистанционного управления и микрофон поддерживаются с iPod touch (2-го и 3-го поколений), iPod classic, iPod nano (4-го и 5-го поколений), iPod shuffle (3-го поколения), iPhone 4, iPhone 3GS, iPad и Macbook, Macbook Pro и Mac Pro (2009 и более поздних версий). Возможность управления голосом поддерживается при использовании наушников с последними версиями устройств iPod touch, iPhone 4 и iPhone 3GS.</p><p>·     <!--more--><!--more--></p>', NULL, NULL, NULL),
(16834, 'ru', 'Наушники Ergo Ear VT11', '<ul><li> Частотный диапазон 18 Гц - 22 кГц</li></ul>', '<p><font>Эргономичные наушники-вкладыши Ergo несомненно понравятся любителям путешествовать с музыкой. Модель сочетает в себе оптимальное соотношение цены, удобства и высокого качества звучания. Наушники не выпадают и не натирают ушную раковину, что позволяет использовать их целый день. Модель предназначена для использования с портативной техникой - dvd, cd, md и mp3-плейерами.</font> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p>', NULL, NULL, NULL),
(16835, 'ru', 'Наушники Ergo Ear VT12', '<ul><li>Частотный диапазон 18Гц - 23кГц</li></ul>', '<p><font>Эргономичные наушники-вкладыши Ergo несомненно понравятся любителям путешествовать с музыкой. Модель сочетает в себе оптимальное соотношение цены, удобства и высокого качества звучания. Наушники не выпадают и не натирают ушную раковину, что позволяет использовать их целый день. Модель предназначена для использования с портативной техникой - dvd, cd, md и mp3-плейерами.</font> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p>', NULL, NULL, NULL),
(16836, 'ru', 'Наушники JVC HA-S200-B', '<ul><li> Частотный диапазон 12 Гц - 22 кГц</li><li><i>Черный цвет</i></li></ul>', '<ul>    <li>Поворотные амбушуры для контроля звука в DJ-стиле</li>    <li>Динамическая головка 30 мм</li>    <li>Неодимовый магнит</li>    <li>Частотная характеристика 12 - 22000 Гц</li>    <li>Номинальное сопротивление 32 Ом </li>    <li>Чувствительность (1 кГц) 107 дБ/мВт </li>    <li>Макс. входная мощность 1000 мВт (IEC) </li>    <li>Вес без провода 128 г </li>    <li>Шнур диной 1.2 м </li>    <li>Позолоченный штекер, совместимый с iPhone</li></ul>', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_rating`
--

DROP TABLE IF EXISTS `shop_products_rating`;
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
(1104, 3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_categories`
--

DROP TABLE IF EXISTS `shop_product_categories`;
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
(937, 9),
(945, 9),
(949, 9),
(955, 9),
(956, 9),
(957, 9),
(959, 940),
(1006, 928),
(1006, 939),
(1015, 928),
(1015, 939),
(1018, 928),
(1018, 940),
(1019, 931),
(1021, 928),
(1021, 940),
(1022, 928),
(1022, 940),
(1023, 930),
(1024, 932),
(1025, 933),
(1096, 931),
(1099, 931),
(1104, 931),
(1105, 931),
(1107, 935),
(1108, 931),
(1109, 937),
(1110, 939),
(1111, 936),
(1112, 932),
(1113, 942),
(1114, 933),
(1115, 932),
(1117, 933),
(4016, 3),
(4018, 3),
(4020, 3),
(4021, 3),
(4796, 3),
(4950, 7),
(4955, 7),
(4957, 7),
(4958, 7),
(4959, 7),
(4960, 7),
(5596, 8),
(5596, 927),
(5596, 930),
(5602, 8),
(5602, 927),
(5602, 930),
(5603, 8),
(5603, 927),
(5603, 930),
(5604, 8),
(5604, 927),
(5604, 930),
(5605, 8),
(5605, 927),
(5605, 930),
(5606, 8),
(5606, 927),
(5606, 930),
(5622, 8),
(5622, 927),
(5622, 930),
(5623, 8),
(5623, 927),
(5623, 930),
(5624, 8),
(5624, 927),
(5624, 930),
(5625, 8),
(5625, 927),
(5625, 930),
(5626, 8),
(5626, 927),
(5626, 930),
(5627, 8),
(5627, 927),
(5627, 930),
(5628, 8),
(5628, 927),
(5628, 930),
(5629, 8),
(5629, 927),
(5629, 930),
(5630, 8),
(5630, 927),
(5630, 930),
(5631, 8),
(5631, 927),
(5631, 930),
(5632, 8),
(5632, 927),
(5632, 930),
(5633, 8),
(5633, 927),
(5633, 930),
(5634, 8),
(5634, 927),
(5634, 930),
(5775, 8),
(5775, 927),
(5775, 935),
(6192, 8),
(6192, 927),
(6192, 935),
(6193, 8),
(6193, 927),
(6193, 935),
(6194, 8),
(6194, 927),
(6194, 935),
(6195, 8),
(6195, 927),
(6195, 935),
(6196, 8),
(6196, 927),
(6196, 935),
(6197, 8),
(6197, 927),
(6197, 935),
(6198, 8),
(6198, 927),
(6198, 936),
(6199, 8),
(6199, 927),
(6199, 936),
(6200, 8),
(6200, 927),
(6200, 936),
(6201, 8),
(6201, 927),
(6201, 936),
(6202, 8),
(6202, 927),
(6202, 936),
(6203, 8),
(6203, 927),
(6203, 936),
(6204, 8),
(6204, 927),
(6204, 936),
(6205, 8),
(6205, 927),
(6205, 936),
(6206, 8),
(6206, 927),
(6206, 936),
(6207, 8),
(6207, 927),
(6207, 936),
(6208, 8),
(6208, 927),
(6208, 936),
(6211, 8),
(6211, 927),
(6211, 933),
(6212, 8),
(6212, 927),
(6212, 933),
(6215, 8),
(6215, 927),
(6215, 933),
(6216, 8),
(6216, 927),
(6216, 933),
(6217, 8),
(6217, 927),
(6217, 933),
(6218, 8),
(6218, 927),
(6218, 933),
(6219, 8),
(6219, 927),
(6219, 933),
(6220, 8),
(6220, 927),
(6220, 933),
(6221, 8),
(6221, 927),
(6221, 933),
(6222, 8),
(6222, 927),
(6222, 933),
(6223, 8),
(6223, 927),
(6223, 933),
(6224, 8),
(6224, 927),
(6224, 932),
(6225, 8),
(6225, 927),
(6225, 932),
(6226, 8),
(6226, 927),
(6226, 932),
(6227, 8),
(6227, 927),
(6227, 932),
(6228, 8),
(6228, 927),
(6228, 932),
(6229, 8),
(6229, 927),
(6229, 932),
(6230, 8),
(6230, 927),
(6230, 932),
(6843, 8),
(6843, 927),
(6843, 2597),
(6844, 8),
(6844, 927),
(6844, 2597),
(7974, 8),
(7974, 928),
(7974, 940),
(7975, 8),
(7975, 928),
(7975, 940),
(7976, 8),
(7976, 928),
(7976, 940),
(7977, 8),
(7977, 928),
(7977, 940),
(7978, 8),
(7978, 928),
(7978, 940),
(7979, 8),
(7979, 928),
(7979, 940),
(7980, 8),
(7980, 928),
(7980, 940),
(7981, 8),
(7981, 928),
(7981, 940),
(7982, 8),
(7982, 928),
(7982, 940),
(7983, 8),
(7983, 928),
(7983, 940),
(7984, 8),
(7984, 928),
(7984, 940),
(7985, 8),
(7985, 928),
(7985, 940),
(7986, 8),
(7986, 928),
(7986, 940),
(7987, 8),
(7987, 928),
(7987, 940),
(7988, 8),
(7988, 928),
(7988, 940),
(7989, 8),
(7989, 928),
(7989, 940),
(7990, 8),
(7990, 928),
(7990, 940),
(7991, 8),
(7991, 928),
(7991, 940),
(7992, 8),
(7992, 928),
(7992, 940),
(8430, 1),
(8431, 1),
(8432, 1),
(8433, 1),
(8434, 1),
(10179, 928),
(10179, 942),
(10180, 8),
(10180, 928),
(10180, 942),
(10181, 928),
(10181, 942),
(10182, 928),
(10182, 942),
(10183, 8),
(10183, 928),
(10183, 942),
(10184, 928),
(10184, 942),
(10734, 8),
(10734, 927),
(10734, 2583),
(11210, 8),
(11210, 927),
(11210, 2597),
(11211, 8),
(11211, 927),
(11211, 938),
(11212, 8),
(11212, 927),
(11212, 2597),
(11213, 8),
(11213, 927),
(11213, 2597),
(11214, 8),
(11214, 927),
(11214, 2597),
(11215, 8),
(11215, 927),
(11215, 2597),
(11216, 8),
(11216, 927),
(11216, 938),
(11217, 8),
(11217, 927),
(11217, 2597),
(11218, 8),
(11218, 927),
(11218, 2597),
(11219, 8),
(11219, 927),
(11219, 2597),
(11220, 8),
(11220, 927),
(11220, 2597),
(11221, 8),
(11221, 927),
(11221, 2597),
(11222, 8),
(11222, 927),
(11222, 2597),
(11223, 8),
(11223, 927),
(11223, 2597),
(11224, 8),
(11224, 927),
(11224, 2597),
(11225, 8),
(11225, 927),
(11225, 2597),
(11226, 8),
(11226, 927),
(11226, 2597),
(11227, 8),
(11227, 927),
(11227, 2597),
(12030, 8),
(12030, 927),
(12030, 931),
(12031, 8),
(12031, 927),
(12031, 931),
(12032, 8),
(12032, 927),
(12032, 931),
(12033, 8),
(12033, 927),
(12033, 931),
(12034, 8),
(12034, 927),
(12034, 931),
(12035, 8),
(12035, 927),
(12035, 931),
(12036, 8),
(12036, 927),
(12036, 931),
(12038, 8),
(12038, 927),
(12038, 931),
(12039, 8),
(12039, 927),
(12039, 931),
(12040, 8),
(12040, 927),
(12040, 931),
(12041, 8),
(12041, 927),
(12041, 931),
(12042, 8),
(12042, 927),
(12042, 931),
(12043, 8),
(12043, 927),
(12043, 931),
(12045, 8),
(12045, 927),
(12045, 931),
(12162, 8),
(12162, 927),
(12162, 2583),
(12163, 8),
(12163, 927),
(12163, 2583),
(12164, 8),
(12164, 927),
(12164, 2583),
(12165, 8),
(12165, 927),
(12165, 2583),
(12166, 8),
(12166, 927),
(12166, 2583),
(12167, 8),
(12167, 927),
(12167, 2583),
(12168, 8),
(12168, 927),
(12168, 2583),
(12169, 8),
(12169, 927),
(12169, 2583),
(12170, 8),
(12170, 927),
(12170, 2583),
(12171, 8),
(12171, 927),
(12171, 2583),
(12172, 8),
(12172, 927),
(12172, 2583),
(12173, 8),
(12173, 927),
(12173, 2583),
(12174, 8),
(12174, 927),
(12174, 2583),
(12175, 8),
(12175, 927),
(12175, 2583),
(12176, 8),
(12176, 927),
(12176, 2583),
(12177, 8),
(12177, 927),
(12177, 2583),
(12178, 8),
(12178, 927),
(12178, 2583),
(12179, 8),
(12179, 927),
(12179, 2583),
(12215, 8),
(12215, 927),
(12215, 2583),
(12737, 9),
(13376, 927),
(13376, 938),
(13377, 8),
(13377, 938),
(13378, 8),
(13378, 938),
(13379, 927),
(13379, 938),
(13380, 8),
(13380, 938),
(13381, 8),
(13381, 938),
(13382, 938),
(13383, 927),
(13383, 938),
(13384, 927),
(13384, 938),
(13385, 938),
(13386, 8),
(13386, 938),
(13387, 8),
(13387, 938),
(13388, 8),
(13388, 938),
(13389, 938),
(13390, 8),
(13390, 938),
(13391, 8),
(13391, 938),
(13392, 8),
(13392, 938),
(13393, 8),
(13393, 938),
(13889, 8),
(13889, 927),
(13889, 937),
(13890, 8),
(13890, 927),
(13890, 937),
(13891, 8),
(13891, 927),
(13891, 937),
(13892, 8),
(13892, 927),
(13892, 937),
(13893, 8),
(13893, 927),
(13893, 937),
(13894, 8),
(13894, 927),
(13894, 937),
(13895, 8),
(13895, 927),
(13895, 937),
(13896, 8),
(13896, 927),
(13896, 937),
(13897, 8),
(13897, 927),
(13897, 937),
(13898, 8),
(13898, 927),
(13898, 937),
(13899, 8),
(13899, 927),
(13899, 937),
(13900, 8),
(13900, 927),
(13900, 937),
(13901, 8),
(13901, 927),
(13901, 937),
(13902, 8),
(13902, 927),
(13902, 937),
(13903, 8),
(13903, 927),
(13903, 937),
(13904, 8),
(13904, 927),
(13904, 937),
(13905, 8),
(13905, 927),
(13905, 937),
(13906, 8),
(13906, 927),
(13906, 937),
(13907, 8),
(13907, 927),
(13907, 937),
(14190, 8),
(14190, 932),
(14192, 8),
(14192, 932),
(14194, 8),
(14194, 932),
(14196, 8),
(14196, 932),
(14198, 8),
(14198, 932),
(14199, 8),
(14199, 932),
(14200, 8),
(14200, 932),
(14201, 8),
(14201, 932),
(14202, 8),
(14202, 932),
(14203, 8),
(14203, 933),
(14204, 8),
(14204, 933),
(14205, 8),
(14205, 933),
(14206, 8),
(14206, 933),
(14775, 8),
(14775, 928),
(14775, 942),
(16825, 8),
(16825, 928),
(16825, 942),
(16826, 8),
(16826, 928),
(16826, 942),
(16827, 8),
(16827, 928),
(16827, 942),
(16828, 8),
(16828, 928),
(16828, 942),
(16829, 8),
(16829, 928),
(16829, 942),
(16830, 8),
(16830, 928),
(16830, 942),
(16831, 8),
(16831, 928),
(16831, 942),
(16832, 8),
(16832, 928),
(16832, 942),
(16833, 8),
(16833, 928),
(16833, 942),
(16834, 8),
(16834, 928),
(16834, 942),
(16835, 8),
(16835, 928),
(16835, 942),
(16836, 8),
(16836, 928),
(16836, 942);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_images`
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
-- Dumping data for table `shop_product_images`
--

INSERT INTO `shop_product_images` (`product_id`, `image_name`, `position`) VALUES
(1018, '1018_1.jpg', 1),
(1018, '1018_1.jpg', 0),
(937, '937_0.jpg', 0),
(937, '937_1.jpg', 2),
(937, '937_2.jpg', 4),
(956, '956_0.jpg', 1),
(957, '957_0.jpg', 2),
(955, '955_0.jpg', 1),
(949, '949_0.jpg', 2),
(949, '949_1.jpg', 1),
(949, '949_2.jpg', 0),
(945, '945_0.jpg', 2),
(945, '945_1.jpg', 1),
(945, '945_2.jpg', 0),
(12036, '12036_0.jpg', 0),
(12035, '12035_0.jpg', 0),
(12034, '12034_0.jpg', 2),
(12034, '12034_1.jpg', 1),
(955, '955_1.jpg', 0),
(956, '956_1.jpg', 0),
(957, '957_1.jpg', 1),
(957, '957_2.jpg', 0),
(959, '959_0.jpg', 0),
(1006, '1006_1.jpg', 1),
(1006, '1006_1.jpg', 0),
(1006, '1006_2.jpg', 2),
(1006, '1006_3.jpg', 3),
(1015, '1015_1.jpg', 1),
(1015, '1015_1.jpg', 0),
(1015, '1015_2.jpg', 2),
(1018, '1018_2.jpg', 2),
(1019, '1019_0.jpg', 0),
(1019, '1019_1.jpg', 1),
(1019, '1019_2.jpg', 2),
(1021, '1021_0.jpg', 0),
(1021, '1021_1.jpg', 1),
(1022, '1022_0.jpg', 0),
(1023, '1023_0.jpg', 0),
(1023, '1023_1.jpg', 1),
(1023, '1023_2.jpg', 2),
(1023, '1023_3.jpg', 3),
(1023, '1023_4.jpg', 4),
(1025, '1025_0.jpg', 0),
(1025, '1025_1.jpg', 1),
(1025, '1025_2.jpg', 2),
(1096, '1096_0.jpg', 0),
(1096, '1096_1.jpg', 1),
(1096, '1096_2.jpg', 2),
(1096, '1096_3.jpg', 3),
(1096, '1096_4.jpg', 4),
(1096, '1096_5.jpg', 5),
(1096, '1096_6.jpg', 6),
(1099, '1099_0.jpg', 0),
(1099, '1099_1.jpg', 1),
(1099, '1099_2.jpg', 2),
(1104, '1104_0.jpg', 0),
(1104, '1104_1.jpg', 1),
(1105, '1105_0.jpg', 0),
(1105, '1105_1.jpg', 1),
(1105, '1105_2.jpg', 2),
(1105, '1105_3.jpg', 3),
(1105, '1105_4.jpg', 4),
(1105, '1105_5.jpg', 5),
(1105, '1105_6.jpg', 6),
(1108, '1108_0.jpg', 0),
(1108, '1108_1.jpg', 1),
(1108, '1108_2.jpg', 2),
(1108, '1108_3.jpg', 3),
(1110, '1110_0.jpg', 0),
(1110, '1110_1.jpg', 1),
(1109, '1109_0.jpg', 0),
(1113, '1113_0.jpg', 0),
(1117, '1117_0.jpg', 0),
(1117, '1117_1.jpg', 1),
(1117, '1117_2.jpg', 2),
(10180, '10180_2.jpg', 2),
(10180, '10180_1.jpg', 1),
(10180, '10180_2.jpg', 0),
(10179, '10179_1.jpg', 1),
(10179, '10179_1.jpg', 0),
(12030, '12030_0.jpg', 0),
(12034, '12034_2.jpg', 0),
(12033, '12033_0.jpg', 1),
(12033, '12033_1.jpg', 0),
(12032, '12032_0.jpg', 0),
(12031, '12031_0.jpg', 6),
(12031, '12031_1.jpg', 5),
(12031, '12031_2.jpg', 4),
(12031, '12031_3.jpg', 3),
(12031, '12031_4.jpg', 2),
(12031, '12031_5.jpg', 1),
(12031, '12031_6.jpg', 0),
(12030, '12030_1.jpg', 3),
(12030, '12030_2.jpg', 2),
(12030, '12030_3.jpg', 1),
(5631, '5631_0.jpg', 2),
(5626, '5626_0.jpg', 2),
(5626, '5626_1.jpg', 1),
(5626, '5626_2.jpg', 0),
(5624, '5624_0.jpg', 2),
(5624, '5624_1.jpg', 1),
(5624, '5624_2.jpg', 0),
(5623, '5623_0.jpg', 2),
(5623, '5623_1.jpg', 1),
(5623, '5623_2.jpg', 0),
(5622, '5622_0.jpg', 0),
(5603, '5603_0.jpg', 1),
(5603, '5603_1.jpg', 0),
(5605, '5605_0.jpg', 0),
(5606, '5606_0.jpg', 2),
(5606, '5606_1.jpg', 1),
(5606, '5606_2.jpg', 0),
(5596, '5596_0.jpg', 0),
(5631, '5631_1.jpg', 0),
(5632, '5632_0.jpg', 0),
(5634, '5634_0.jpg', 3),
(5634, '5634_1.jpg', 2),
(5634, '5634_2.jpg', 1),
(5634, '5634_3.jpg', 0),
(5631, '5631_2.jpg', 1),
(5775, '5775_0.jpg', 1),
(5775, '5775_1.jpg', 0),
(6195, '6195_0.jpg', 0),
(6200, '6200_0.jpg', 0),
(6198, '6198_0.jpg', 0),
(6200, '6200_1.jpg', 1),
(6200, '6200_2.jpg', 2),
(6207, '6207_0.jpg', 0),
(6208, '6208_0.jpg', 0),
(6208, '6208_1.jpg', 1),
(6230, '6230_0.jpg', 1),
(6230, '6230_1.jpg', 0),
(5628, '5628_0.jpg', 0),
(10734, '10734_0.jpg', 0),
(12179, '12179_0.jpg', 0),
(12178, '12178_0.jpg', 1),
(12178, '12178_1.jpg', 0),
(12177, '12177_0.jpg', 1),
(12177, '12177_1.jpg', 0),
(12176, '12176_0.jpg', 0),
(12175, '12175_0.jpg', 0),
(12174, '12174_0.jpg', 3),
(12174, '12174_1.jpg', 2),
(12174, '12174_2.jpg', 1),
(12174, '12174_3.jpg', 0),
(12173, '12173_0.jpg', 3),
(12173, '12173_1.jpg', 2),
(12173, '12173_2.jpg', 1),
(12173, '12173_3.jpg', 0),
(12172, '12172_0.jpg', 3),
(12172, '12172_1.jpg', 2),
(12172, '12172_2.jpg', 1),
(12172, '12172_3.jpg', 0),
(12171, '12171_0.jpg', 3),
(12171, '12171_1.jpg', 2),
(12171, '12171_2.jpg', 1),
(12171, '12171_3.jpg', 0),
(12170, '12170_0.jpg', 0),
(12169, '12169_0.jpg', 0),
(12165, '12165_0.jpg', 0),
(12163, '12163_0.jpg', 0),
(12162, '12162_0.jpg', 0),
(10734, '10734_1.jpg', 1),
(4018, '4018_0.jpg', 0),
(11214, '11214_0.jpg', 0),
(11217, '11217_0.jpg', 0),
(11218, '11218_0.jpg', 0),
(11218, '11218_1.jpg', 1),
(11219, '11219_0.jpg', 0),
(11223, '11223_0.jpg', 0),
(11224, '11224_0.jpg', 0),
(11225, '11225_0.jpg', 0),
(11226, '11226_0.jpg', 0),
(11226, '11226_1.jpg', 1),
(11226, '11226_2.jpg', 2),
(11227, '11227_0.jpg', 0),
(11227, '11227_1.jpg', 1),
(11227, '11227_2.jpg', 2),
(11227, '11227_3.jpg', 3),
(4796, '4796_0.jpg', 0),
(4796, '4796_1.jpg', 1),
(12039, '12039_0.jpg', 0),
(12039, '12039_1.jpg', 1),
(12039, '12039_2.jpg', 2),
(12040, '12040_0.jpg', 0),
(12040, '12040_1.jpg', 1),
(12042, '12042_0.jpg', 0),
(12042, '12042_1.jpg', 1),
(12043, '12043_0.jpg', 0),
(12043, '12043_1.jpg', 1),
(12045, '12045_0.jpg', 0),
(12045, '12045_1.jpg', 1),
(12045, '12045_2.jpg', 2),
(4016, '4016_0.jpg', 0),
(4016, '4016_1.jpg', 1),
(4016, '4016_2.jpg', 2),
(4016, '4016_3.jpg', 3),
(4016, '4016_4.jpg', 4),
(4016, '4016_5.jpg', 5),
(4016, '4016_6.jpg', 6),
(4016, '4016_7.jpg', 7),
(4016, '4016_8.jpg', 8),
(4016, '4016_9.jpg', 9),
(4021, '4021_0.jpg', 0),
(4021, '4021_1.jpg', 1),
(4021, '4021_2.jpg', 2),
(4021, '4021_3.jpg', 3),
(4021, '4021_4.jpg', 4),
(4021, '4021_5.jpg', 5),
(13897, '13897_0.jpg', 0),
(13901, '13901_0.jpg', 0),
(14196, '14196_0.jpg', 0),
(14196, '14196_1.jpg', 1),
(14200, '14200_1.jpg', 1),
(14201, '14201_0.jpg', 0),
(14201, '14201_1.jpg', 1),
(14201, '14201_2.jpg', 2),
(14202, '14202_0.jpg', 0),
(14202, '14202_1.jpg', 1),
(14775, '14775_0.jpg', 0),
(16825, '16825_0.jpg', 0),
(16826, '16826_0.jpg', 0),
(16827, '16827_0.jpg', 0),
(16828, '16828_0.jpg', 0),
(16829, '16829_0.jpg', 0),
(16830, '16830_0.jpg', 0),
(16831, '16831_0.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=362 ;

--
-- Dumping data for table `shop_product_properties`
--

INSERT INTO `shop_product_properties` (`id`, `csv_name`, `active`, `show_in_compare`, `position`, `show_on_site`, `multiple`, `external_id`, `show_in_filter`, `main_property`, `show_faq`) VALUES
(20, 'displaytech', 1, 1, 258, 1, 0, NULL, 1, 0, NULL),
(121, 'gabariti', 1, 1, 232, 1, NULL, NULL, 1, 1, NULL),
(22, 'hdmi', 1, 1, 68, 1, 0, NULL, 1, 0, NULL),
(23, 'power', 1, 1, 259, 1, 0, NULL, 0, 0, NULL),
(24, 'digitalopticalinput', 1, 1, 260, 1, 0, NULL, 0, 0, NULL),
(25, 'focus', 1, 1, 261, 1, 0, NULL, 0, 0, NULL),
(26, 'megapixel', 1, 1, 262, 1, 0, NULL, 0, 0, NULL),
(28, 'audioformats', 1, 1, 257, 1, 1, NULL, 1, 0, NULL),
(198, 'vidysumok', 1, 1, 146, 1, NULL, NULL, 1, NULL, NULL),
(31, 'ram', 1, NULL, 256, NULL, NULL, NULL, NULL, NULL, NULL),
(239, 'superzamorozka', 1, 1, 34, 1, 0, NULL, 1, 0, NULL),
(238, 'razmorazhiwanie', 1, 1, 28, 1, NULL, NULL, 1, NULL, NULL),
(34, 'organizer', 1, 1, 251, 1, 1, NULL, NULL, NULL, NULL),
(35, 'printertype', 1, 1, 252, 1, 1, NULL, 1, 0, NULL),
(36, 'paperformat', 1, 1, 253, 1, 1, NULL, 0, 0, NULL),
(37, 'network', 1, 1, 254, 1, 1, NULL, 0, 0, NULL),
(41, 'multysimcard', 1, 1, 118, 1, 0, NULL, 1, 0, NULL),
(39, 'korpys', 0, 1, 255, 1, 0, NULL, 0, 0, NULL),
(42, 'corpstype', 0, 1, 122, 1, 0, NULL, 1, 0, NULL),
(79, 'Primeneniesvetilnikov', 1, 1, 35, 1, 0, NULL, 1, 0, NULL),
(46, 'razreshenieekrana', 1, 1, 243, 1, 0, NULL, 1, 1, NULL),
(335, 'GPSpriemnik', 1, 1, 0, 1, 0, NULL, 1, 0, NULL),
(50, 'operativnayapamyat', 0, 1, 235, 1, 0, NULL, 1, 0, NULL),
(51, 'videokarta', 1, 1, 241, 1, 0, NULL, 1, 0, NULL),
(52, 'obiemhdd', 1, 1, 244, 1, 0, NULL, 1, 0, NULL),
(53, 'opticheskiyprivod', 1, 1, 139, 1, 0, NULL, 1, 0, NULL),
(73, 'chastotarazvertki', 1, NULL, 230, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 'operazionajsistema', 1, 1, 137, 1, 0, NULL, 1, 0, NULL),
(57, 'typholodilnika', 0, 1, 8, 1, 0, NULL, 1, 0, NULL),
(58, 'objomholodilnoykameri', 1, 1, 3, 1, 0, NULL, 1, 0, NULL),
(59, 'objommorozilnoykameri', 1, 1, 4, 1, 0, NULL, 1, 0, NULL),
(60, 'raspolozeniemorozilnoykamery', 1, 1, 7, 1, 0, NULL, 1, 0, NULL),
(62, 'podderjka', 1, 1, 228, 1, 0, NULL, 1, 0, NULL),
(64, 'tipuprawlenija', 1, 1, 1, 1, 0, NULL, 1, 0, NULL),
(66, 'nofrost', 1, 1, 5, 1, 0, NULL, 1, 0, NULL),
(67, 'Zonaswezhesti', 0, 1, 14, 1, NULL, NULL, 1, NULL, NULL),
(68, 'klassenergopotreblenija', 1, 1, 0, 1, 0, NULL, 1, 0, NULL),
(70, 'cveta', 0, 1, 112, 1, 0, NULL, 1, 0, NULL),
(74, 'usb', 1, NULL, 227, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'cifrovoitwner', 1, 1, 229, 1, NULL, NULL, 1, 1, NULL),
(76, 'akystika', 1, 1, 231, 1, NULL, NULL, 1, 1, NULL),
(77, 'vixodvinternet', 1, 1, 233, 1, 0, NULL, 1, 1, NULL),
(78, 'material', 1, 1, 234, 1, 0, NULL, 1, 0, NULL),
(141, 'diagekr', 1, 1, 7, 1, 0, NULL, 1, 0, NULL),
(334, 'vremjraboti', 1, 1, 0, 1, 0, NULL, 1, 0, NULL),
(84, 'diapazonmochnosti', 1, 1, 184, 1, 0, NULL, 1, 0, NULL),
(86, 'sistemarewersa', 1, 1, 202, 1, 0, NULL, 1, 0, NULL),
(89, 'tipekrana', 1, 1, 182, 1, 0, NULL, 1, 0, NULL),
(90, 'kolichestvoprocessorov', 0, 1, 239, 1, 0, NULL, 1, 0, NULL),
(91, 'zheskiydisk', 1, 1, 237, 1, 0, NULL, 1, 0, NULL),
(92, 'besprovodnayacvyaz', 0, 1, 248, 1, 0, NULL, 1, 0, NULL),
(93, 'gps', 0, 1, 180, 1, 0, NULL, 1, 0, NULL),
(304, 'dlinavsm', 1, 1, 72, 1, 0, NULL, 0, 0, NULL),
(305, 'dopolnitelno', 1, 1, 69, 1, NULL, NULL, NULL, NULL, NULL),
(95, 'cvetarmaturi', 1, 1, 42, 1, 0, NULL, 1, 0, NULL),
(96, 'cvetplafona', 1, 1, 49, 1, 0, NULL, 1, 0, NULL),
(97, 'dizainsvetilnikov', 1, 1, 21, 1, 0, NULL, 1, 0, NULL),
(98, 'geometriyaplafonasvetilnika', 1, 1, 55, 1, 0, NULL, 1, 0, NULL),
(99, 'tiplampisvetilnika', 1, 1, 58, 1, 0, NULL, 1, 0, NULL),
(100, 'kolichestvolampsvetilnikov', 1, 1, 60, 1, 0, NULL, 1, 0, NULL),
(101, 'materialplafonasvetilnika', 1, 1, 44, 1, 0, NULL, 1, 0, NULL),
(102, 'materialarmaturisvetilnika', 1, 1, 39, 1, 0, NULL, 1, 0, NULL),
(103, 'upravlenieosvescheniem', 1, 1, 86, 1, 0, NULL, 0, 0, NULL),
(104, 'seriyaIlluminatisvetilniki', 0, 1, 88, 1, 0, NULL, 0, 0, NULL),
(306, 'napryajenievseti', 1, 1, 79, 1, NULL, NULL, NULL, NULL, NULL),
(105, 'kategoriiosvescheniya', 0, 1, 19, 0, 0, NULL, 1, 0, NULL),
(246, 'diagonal', 1, 1, 108, 1, 0, NULL, 1, 0, NULL),
(107, 'kolichestwoskorostey', 1, 1, 203, 1, 0, NULL, 1, 0, NULL),
(108, 'mocshnost', 1, 1, 204, 1, 0, NULL, 1, 0, NULL),
(140, 'oppam', 1, 1, 130, 1, 0, NULL, 1, 0, NULL),
(110, 'kolichestvomest', 1, 1, 205, 1, 0, NULL, 1, 0, NULL),
(111, 'karkas', 1, 1, 206, 1, 0, NULL, 1, 0, NULL),
(112, 'vnutrinnyyvisota', 1, 1, 201, 1, 0, NULL, 1, 0, NULL),
(113, 'naznachenie', 0, 1, 200, 1, 0, NULL, 1, 0, NULL),
(114, 'nalichietambura', 1, 1, 195, 1, 0, NULL, 1, 0, NULL),
(115, 'visotaholodilnika', 1, 1, 9, 1, 0, NULL, 1, 0, NULL),
(116, 'schirina', 1, 1, 10, 1, 0, NULL, 1, 0, NULL),
(117, 'glubinaholodilnika', 1, 1, 11, 1, 0, NULL, 1, 0, NULL),
(118, 'display', 0, 1, 12, 1, 0, NULL, 1, 0, NULL),
(119, 'kolichestwokompressorow', 1, 1, 2, 1, 0, NULL, 1, 0, NULL),
(120, 'cwetholodilnika', 1, 1, 13, 1, 0, NULL, 1, 0, NULL),
(122, 'kamera', 1, 1, 196, 1, 0, NULL, 1, 0, NULL),
(123, 'fmtynir', 1, 1, 197, 1, 0, NULL, 1, 0, NULL),
(124, 'diktofon', 1, 1, 198, 1, 0, NULL, 1, 0, NULL),
(125, 'pamjtt', 1, 1, 199, 1, 0, NULL, 1, 1, NULL),
(127, 'PitanieLiIon', 1, 1, 109, 1, 0, NULL, 1, 0, NULL),
(134, 'podderzhkakartpamjati', 0, 1, 217, 1, 0, NULL, 1, 0, NULL),
(135, 'zastotaprozesora', 1, 1, 218, 1, 0, NULL, 1, 0, NULL),
(131, 'proizvoditel', 1, 1, 219, 1, 0, NULL, 1, 0, NULL),
(133, 'vstroenpam', 1, 1, 220, 1, 0, NULL, 1, 0, NULL),
(137, 'podderzkakartpamjati', 0, 1, 221, 1, 0, NULL, 1, 0, NULL),
(138, 'tipkofewarki', 1, 1, 222, 1, 0, NULL, 1, 0, NULL),
(142, 'razekr', 1, 1, 107, 1, 0, NULL, 1, 0, NULL),
(143, 'proc', 1, 1, 126, 1, 0, NULL, 1, 0, NULL),
(152, 'pitanie', 1, 1, 223, 1, NULL, NULL, 1, NULL, NULL),
(144, 'videokarta', 1, 1, 135, 1, 0, NULL, 1, 0, NULL),
(145, 'obhdd', 1, 1, 1, 1, 0, NULL, 1, 0, NULL),
(146, 'ves', 1, 1, 116, 1, 0, NULL, 0, 0, NULL),
(333, 'razmerdisplej', 1, 1, 0, 1, 0, NULL, 1, 0, NULL),
(154, 'Vusota', 1, 1, 215, 1, 0, NULL, 1, 0, NULL),
(155, 'kolizestvokamer', 1, 1, 207, 1, NULL, NULL, 1, NULL, NULL),
(156, 'razreshenievideo', 1, 1, 208, 1, NULL, NULL, 1, NULL, NULL),
(157, 'Pitanie', 1, 1, 48, 1, 0, NULL, 1, 0, NULL),
(158, 'Aktivatsiazapisi', 0, 1, 209, 1, NULL, NULL, 1, NULL, NULL),
(159, 'Shirina', 1, 1, 236, 1, 0, NULL, 1, 0, NULL),
(160, 'material', 1, 1, 33, 1, 0, NULL, 1, 0, NULL),
(161, 'Peregladina', 1, 1, 238, 1, 0, NULL, 1, 0, NULL),
(162, 'Vustypvpered', 1, 1, 240, 1, NULL, NULL, 1, NULL, NULL),
(163, 'Trebuemayavusotapomesheniya', 1, 1, 242, 1, NULL, NULL, 1, NULL, NULL),
(164, 'Nagryzkanavesnoe', 1, 1, 245, 1, NULL, NULL, 1, NULL, NULL),
(165, 'Nagryzkinasportygolok', 1, 1, 246, 1, NULL, NULL, 1, NULL, NULL),
(166, 'Vidkrepleniya', 1, 1, 247, 1, NULL, NULL, 1, NULL, NULL),
(167, 'Vestovara', 1, 1, 249, 1, 0, NULL, 1, 0, NULL),
(168, 'Cvet', 1, 1, 250, 1, 0, NULL, 1, 0, NULL),
(169, 'setvozmozhnosti', 1, NULL, 210, 1, NULL, NULL, 1, NULL, NULL),
(170, 'osobenosti', 1, 1, 211, 1, NULL, NULL, 1, 1, NULL),
(171, 'nalichiedispleya', 1, 1, 212, 1, NULL, NULL, 1, 1, NULL),
(172, 'nalichietunera', 1, 1, 213, 1, NULL, NULL, 1, 1, NULL),
(173, 'kolochestvopiksiley', 1, 1, 214, 1, 0, NULL, 1, 0, NULL),
(174, 'zapisvideo', 1, 1, 225, 1, 0, NULL, 1, 0, NULL),
(176, 'raxreshvideo', 1, 1, 181, 1, NULL, NULL, 1, 1, NULL),
(307, 'klasszaschiti', 1, 1, 81, 1, NULL, NULL, NULL, NULL, NULL),
(278, 'tiptele', 1, 1, 87, 1, NULL, NULL, 1, NULL, NULL),
(284, 'tipzagruzki', 1, 1, 32, 1, NULL, NULL, 1, NULL, NULL),
(177, 'tipnositelya', 1, 1, 177, 1, 0, NULL, 1, 1, NULL),
(178, 'tipvideokamery', 1, 1, 179, 1, NULL, NULL, 1, 1, NULL),
(179, 'category', 1, 1, 175, 1, 0, NULL, 1, 0, NULL),
(180, 'maxrazresheniee', 1, 1, 172, 1, 0, NULL, 1, 1, NULL),
(181, 'osobenostimediapleer', 1, 1, 171, 1, NULL, NULL, 1, NULL, NULL),
(182, 'setvozm', 1, 1, 163, 1, 0, NULL, 1, 0, NULL),
(183, 'tipshtativa', 1, 1, 185, 1, NULL, NULL, 1, NULL, NULL),
(184, 'diametrfiltra', 1, 1, 186, 1, NULL, NULL, 1, NULL, NULL),
(185, 'tipakkum', 1, 1, 193, 1, NULL, NULL, 1, NULL, NULL),
(186, 'sovmestimost', 1, 1, 151, 1, 0, NULL, 1, 0, NULL),
(187, 'tip', 1, 1, 18, 1, 0, NULL, 1, 0, NULL),
(188, 'standartmemory', 1, 1, 192, 1, NULL, NULL, 1, NULL, NULL),
(189, 'obiempamyati', 1, 1, 191, 1, NULL, NULL, 1, NULL, NULL),
(190, 'class', 1, 1, 190, 1, 0, NULL, 1, 0, NULL),
(191, 'supportnositeley', 1, 1, 189, 1, NULL, NULL, 1, NULL, NULL),
(192, 'kolichestvokanalov', 1, 1, 194, 1, NULL, NULL, 1, NULL, NULL),
(193, 'karaoke', 1, 1, 188, 1, NULL, NULL, 1, NULL, NULL),
(194, 'supportiosandroid', 1, 1, 143, 1, NULL, NULL, 1, NULL, NULL),
(207, 'tiptopliva', 1, 1, 134, 1, NULL, NULL, 1, NULL, NULL),
(199, 'dlyanouta', 1, 1, 152, 1, 0, NULL, 1, 0, NULL),
(197, 'sistema', 1, 0, 153, 1, 0, NULL, 0, 1, NULL),
(200, 'cvetsumki', 1, 1, 157, 1, 0, NULL, 1, 0, NULL),
(201, 'materialsumki', 1, 1, 154, 1, 0, NULL, 1, 0, NULL),
(202, 'naznachenie', 1, 1, 142, 1, 0, NULL, 1, 0, NULL),
(203, 'vid', 1, 1, 141, 1, 0, NULL, 1, 0, NULL),
(204, 'razmer', 1, 1, 140, 1, 0, NULL, 1, 0, NULL),
(206, 'obemrukzaka', 1, 1, 138, 1, 0, NULL, 1, 0, NULL),
(208, 'kolichestvoperson', 1, 1, 136, 1, 0, NULL, 1, 0, NULL),
(209, 'sistemasmiva', 1, 1, 145, 1, 0, NULL, 1, 0, NULL),
(210, 'ruchnaypompa', 1, 1, 105, 1, 0, NULL, 1, 0, NULL),
(211, 'primenenie', 1, 1, 132, 1, 0, NULL, 1, 0, NULL),
(212, 'cvetpoverhnosti', 1, 1, 129, 1, NULL, NULL, 1, NULL, NULL),
(213, 'formaruchki', 0, 1, 128, 1, NULL, NULL, 1, NULL, NULL),
(214, 'stiligri', 1, 1, 124, 1, 0, NULL, 1, 0, NULL),
(215, 'tipmatricy', 1, 1, 158, 1, NULL, NULL, 1, NULL, NULL),
(216, 'kluchevietech', 1, 1, 159, 1, NULL, NULL, 1, NULL, NULL),
(217, 'sootnoscheniestoron', 1, 1, 54, 1, 0, NULL, 1, 0, NULL),
(218, 'tipkrepleniy', 1, 1, 144, 1, NULL, NULL, 1, NULL, NULL),
(219, 'ugolpovertikali', 1, 1, 168, 1, NULL, NULL, 1, NULL, NULL),
(220, 'ugolpogorizontali', 1, 1, 170, 1, NULL, NULL, 1, NULL, NULL),
(221, 'yarkostmonit', 1, 1, 166, 1, NULL, NULL, 1, NULL, NULL),
(222, 'vremyaotklika', 1, 1, 167, 1, NULL, NULL, 1, NULL, NULL),
(223, 'tvtuner', 1, 1, 162, 1, NULL, NULL, 1, NULL, NULL),
(224, 'vozrostnaykategoriy', 1, 1, 147, 1, NULL, NULL, 1, NULL, NULL),
(225, 'cvetmonitora', 1, 1, 165, 1, NULL, NULL, 1, NULL, NULL),
(226, 'vstroenyekolonki', 1, 1, 164, 1, NULL, NULL, 1, NULL, NULL),
(227, 'kolichestvovupakovke', 1, 1, 149, 1, 0, NULL, 1, 0, NULL),
(228, 'seriyamonitotra', 1, 1, 155, 1, NULL, NULL, 1, NULL, NULL),
(229, 'Tipfotoalboma', 1, 1, 150, 1, 0, NULL, 1, 0, NULL),
(230, 'Kolizestvofotografiu', 1, 1, 148, 1, 0, NULL, 1, 0, NULL),
(231, 'cvetchehla', 1, 1, 156, 1, NULL, NULL, 1, NULL, NULL),
(232, 'pilevlago', 1, 1, 160, 1, NULL, NULL, 1, NULL, NULL),
(233, 'Vozrast', 1, 1, 119, 1, 0, NULL, 1, 0, NULL),
(234, 'Vesrebenka', 1, 1, 114, 1, 0, NULL, 1, 0, NULL),
(235, 'Kolvotochek', 1, 1, 113, 1, 0, NULL, 1, 0, NULL),
(236, 'Gryppa', 1, 1, 110, 1, 0, NULL, 1, 0, NULL),
(237, 'tipdisp', 1, 1, 121, 1, NULL, NULL, 1, NULL, NULL),
(240, 'moshnostzamorashiwanija', 0, 1, 41, 1, 0, NULL, 1, 0, NULL),
(241, 'avtonomnoesohranenieholoda', 0, 1, 46, 1, 0, NULL, 1, 0, NULL),
(242, 'urowenschuma', 1, 1, 11, 1, 0, NULL, 1, 0, NULL),
(243, 'pereweshiwaemiedweri', 1, 1, 36, 1, 0, NULL, 1, 0, NULL),
(244, 'antibakterialnoepokritie', 1, 1, 56, 1, 0, NULL, 1, 0, NULL),
(247, 'razreshenie', 1, 1, 43, 1, 0, NULL, 1, 0, NULL),
(248, 'formatekrana', 1, 1, 17, 1, 0, NULL, 0, 0, NULL),
(249, 'progressivnajrazvertka', 1, 1, 45, 1, 0, NULL, 1, 0, NULL),
(250, 'chastota', 1, 1, 23, 1, 0, NULL, 1, 0, NULL),
(251, 'stereozvyk', 1, 1, 26, 1, 0, NULL, 1, 0, NULL),
(252, 'kolichestvodinamikov', 1, 1, 31, 1, 0, NULL, 1, 0, NULL),
(253, 'moshnostzvyka', 1, 1, 37, 1, 0, NULL, 1, 0, NULL),
(254, 'tvtuner', 1, 1, 50, 1, 0, NULL, 1, 0, NULL),
(255, 'taimersna', 1, 1, 61, 1, 0, NULL, 1, 0, NULL),
(256, 'teletekst', 1, 1, 66, 1, 0, NULL, 1, 0, NULL),
(257, 'zashitaotdetei', 1, 1, 59, 1, 0, NULL, 1, 0, NULL),
(258, 'sabvyfer', 1, 1, 63, 1, 0, NULL, 1, 0, NULL),
(261, 'rotang', 1, 1, 99, 1, 0, NULL, 1, 0, NULL),
(260, 'kollekciya', 1, 1, 29, 1, 0, NULL, 0, 0, NULL),
(262, 'tipwarpaneli', 1, 1, 97, 1, 0, NULL, 1, 0, NULL),
(263, 'tipduhovki', 1, 1, 106, 1, NULL, NULL, 1, NULL, NULL),
(264, 'schirina', 1, 1, 6, 1, 0, NULL, 1, 0, NULL),
(265, 'glubina', 1, 1, 111, 1, NULL, NULL, 1, NULL, NULL),
(266, 'visota', 1, 1, 115, 1, 0, NULL, 1, 0, NULL),
(267, 'gril', 1, 1, 120, 1, NULL, NULL, 1, NULL, NULL),
(268, 'vertelvduchow', 1, 1, 123, 1, NULL, NULL, 1, NULL, NULL),
(269, 'gazkontrolkonforok', 1, 1, 125, 1, NULL, NULL, 1, NULL, NULL),
(270, 'gazkontrolduchowki', 1, 1, 127, 1, NULL, NULL, 1, NULL, NULL),
(272, 'fmtuner', 1, 1, 1, 1, 1, NULL, 1, 1, NULL),
(273, 'tippleera', 1, 1, 0, 1, 1, NULL, 1, 1, NULL),
(338, 'interfes', 1, NULL, 0, 1, NULL, NULL, NULL, 1, NULL),
(275, 'komlektakkysticheskixsistem', 0, NULL, 3, 1, NULL, NULL, NULL, 1, NULL),
(276, 'slotdljkartpamjti', 1, 1, 4, 1, 1, NULL, 1, 1, NULL),
(277, 'proizvoditel', 1, NULL, 100, 1, NULL, NULL, NULL, 1, NULL),
(279, 'podderpam', 1, 1, 101, 1, NULL, NULL, 1, NULL, NULL),
(280, 'chipset', 1, 1, 102, 1, NULL, NULL, 1, NULL, NULL),
(281, 'vstroenvideo', 1, 1, 103, 1, NULL, NULL, 1, NULL, NULL),
(282, 'tiprazema', 1, 1, 104, 1, NULL, NULL, 1, NULL, NULL),
(283, 'chastotaschyn', 1, 1, 89, 1, 0, NULL, 1, 0, NULL),
(299, 'obyem', 1, 1, 82, 1, 0, NULL, 1, 0, NULL),
(285, 'classtirki', 1, 1, 16, 1, NULL, NULL, 1, NULL, NULL),
(286, 'clasotczima', 1, 1, 64, 1, NULL, NULL, 1, NULL, NULL),
(287, 'zagruzkabelja', 1, 1, 62, 1, NULL, NULL, 1, NULL, NULL),
(288, 'maksimalnajaskorostotcz', 1, 1, 57, 1, 0, NULL, 1, 0, NULL),
(289, 'glubina', 1, 1, 52, 1, 0, NULL, 1, 0, NULL),
(290, 'tippodkluch', 1, 1, 51, 1, 0, NULL, 1, 0, NULL),
(291, 'tipsensora', 1, 1, 47, 1, NULL, NULL, 1, NULL, NULL),
(292, 'interfeis', 1, 1, 27, 1, 0, NULL, 1, 0, NULL),
(293, 'typ', 1, 1, 74, 1, 0, NULL, 1, 0, NULL),
(296, 'glubinamebeli', 1, 1, 38, 1, 0, NULL, 0, 0, NULL),
(295, 'moschnost', 1, 1, 67, 1, 0, NULL, 0, 0, NULL),
(297, 'shirinamebeli', 1, 1, 73, 1, 0, NULL, 0, 0, NULL),
(298, 'visotamebeli', 1, 1, 77, 1, 0, NULL, 0, 0, NULL),
(300, 'moschnostmikrowoln', 1, 1, 90, 1, NULL, NULL, 1, NULL, NULL),
(301, 'nasadkadljakolbas', 1, 1, 71, 1, NULL, NULL, 1, NULL, NULL),
(303, 'diapazonproizwoditelnosti', 1, 1, 30, 1, 0, NULL, 1, 0, NULL),
(308, 'tipzaschiti', 1, 1, 83, 1, NULL, NULL, NULL, NULL, NULL),
(309, 'sertifikat', 1, 1, 85, 1, NULL, NULL, NULL, NULL, NULL),
(310, 'akamulatorl', 1, NULL, 22, 1, NULL, NULL, 1, 1, NULL),
(311, 'ItemNo', 1, 1, 5, 1, 0, NULL, 0, 0, NULL),
(312, 'tipuborki', 1, 1, 70, 1, NULL, NULL, 1, NULL, NULL),
(313, 'maksimalnajamoschnost', 1, 1, 80, 1, NULL, NULL, 1, NULL, NULL),
(314, 'obyompilesbornika', 1, 1, 84, 1, 0, NULL, 1, 0, NULL),
(315, 'turbochetka', 1, 1, 91, 1, 0, NULL, 1, 0, NULL),
(316, 'aquafiltr', 1, 1, 92, 1, NULL, NULL, 1, NULL, NULL),
(317, 'reguljatormochnostinarukojatke', 1, 1, 95, 1, NULL, NULL, 1, NULL, NULL),
(318, 'diametrsm', 1, 1, 75, 1, NULL, NULL, NULL, NULL, NULL),
(319, 'rasstoyanieotstenism', 1, 1, 78, 1, NULL, NULL, NULL, NULL, NULL),
(320, 'tippatrona', 1, 1, 65, 1, NULL, NULL, NULL, NULL, NULL),
(321, 'formatt', 1, 1, 40, 1, 0, NULL, 1, 0, NULL),
(322, 'tipnakop', 1, 1, 20, 1, NULL, NULL, 1, NULL, NULL),
(323, 'cvetnakop', 1, 1, 25, 1, NULL, NULL, 1, NULL, NULL),
(324, 'istochnikenergii', 1, 1, 10, 1, 0, NULL, 1, 0, NULL),
(325, 'zahichenost', 1, 1, 12, 1, NULL, NULL, 1, NULL, NULL),
(326, 'aksesuar', 1, 1, 15, 1, NULL, NULL, 1, NULL, NULL),
(327, 'masshtab', 1, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL),
(328, 'marka', 1, 1, 3, 1, 1, NULL, 1, 0, NULL),
(329, 'vmestimostk', 1, 1, 0, 1, 0, NULL, 1, 0, NULL),
(330, 'klassmoyki', 1, 1, 4, 1, NULL, NULL, 1, NULL, NULL),
(331, 'klassuschki', 1, 1, 6, 1, NULL, NULL, 1, NULL, NULL),
(332, 'rashodvody', 1, 1, 9, 1, 0, NULL, 1, 0, NULL),
(336, 'RAMpamjt', 1, 1, 0, 1, 0, NULL, 1, 0, NULL),
(337, 'Osobenosti', 1, 1, 0, 1, 0, NULL, 1, 0, NULL),
(339, 'interfes', 0, NULL, 0, 1, NULL, NULL, NULL, 1, NULL),
(340, 'proizvoditelnost', 1, 1, 2, 1, 0, NULL, 1, 0, NULL),
(341, 'cvet', 1, 1, 3, 1, 0, NULL, 1, 0, NULL),
(342, 'kolichestvodvigateley', 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL),
(343, 'shirinadlyvstraivaniy', 0, 1, 4, 1, 0, NULL, 1, 0, NULL),
(344, 'materialpodoshvi', 1, 1, 0, 0, 0, NULL, 1, 0, NULL),
(345, 'emkostchashi', 1, 1, 0, 1, 0, NULL, 1, 0, NULL),
(346, 'blender', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(347, 'masorubka', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(348, 'sokovujumalka', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(349, 'materialkorpysa', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(350, 'tip', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(351, 'diapazonmoshnosti', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(352, 'obyem', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(353, 'spalnoemesto', 1, 0, 0, 0, 0, NULL, 0, 0, NULL),
(354, 'Belevoyyashik', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(355, 'diapazonmochnosti', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(356, 'tip', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(357, 'kolichestwoskorostey', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(358, 'dlinashnura', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(359, 'Impedans', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(360, 'Cuvstvitelnost', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL),
(361, 'kolichestvoinstrumentov', 1, 1, 0, 1, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_categories`
--

DROP TABLE IF EXISTS `shop_product_properties_categories`;
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
(22, 9),
(22, 953),
(39, 931),
(41, 8),
(41, 927),
(41, 930),
(41, 931),
(42, 8),
(42, 927),
(42, 930),
(42, 931),
(42, 2583),
(46, 953),
(50, 931),
(53, 1279),
(62, 953),
(70, 928),
(70, 930),
(70, 931),
(70, 939),
(70, 940),
(70, 942),
(73, 953),
(74, 953),
(75, 953),
(76, 953),
(77, 953),
(90, 931),
(92, 931),
(93, 931),
(110, 1),
(110, 21),
(110, 34),
(110, 39),
(111, 1),
(111, 21),
(111, 34),
(111, 39),
(112, 1),
(112, 21),
(112, 34),
(112, 39),
(113, 1),
(114, 1),
(114, 21),
(114, 34),
(114, 39),
(121, 953),
(122, 8),
(122, 927),
(122, 931),
(123, 8),
(123, 928),
(123, 939),
(123, 940),
(124, 8),
(124, 928),
(124, 939),
(124, 940),
(127, 8),
(127, 927),
(127, 930),
(133, 8),
(133, 928),
(133, 939),
(133, 940),
(134, 931),
(135, 8),
(135, 927),
(135, 931),
(137, 931),
(139, 8),
(139, 927),
(139, 931),
(141, 8),
(141, 9),
(141, 927),
(141, 930),
(141, 931),
(141, 953),
(141, 962),
(141, 964),
(141, 965),
(142, 8),
(142, 927),
(142, 930),
(142, 931),
(146, 8),
(146, 927),
(146, 928),
(146, 930),
(146, 939),
(146, 940),
(160, 1),
(160, 3),
(160, 245),
(160, 254),
(160, 260),
(160, 1285),
(161, 3),
(162, 3),
(163, 3),
(164, 3),
(165, 3),
(166, 3),
(167, 3),
(168, 3),
(187, 1),
(187, 9),
(187, 21),
(187, 36),
(187, 37),
(187, 953),
(190, 1),
(201, 1),
(201, 21),
(201, 36),
(202, 1),
(202, 21),
(202, 32),
(202, 34),
(202, 35),
(202, 39),
(203, 1),
(203, 21),
(203, 32),
(203, 38),
(203, 39),
(204, 1),
(204, 3),
(204, 21),
(204, 245),
(204, 254),
(204, 255),
(204, 256),
(204, 257),
(204, 1285),
(206, 1),
(206, 21),
(206, 35),
(207, 21),
(208, 21),
(209, 21),
(210, 21),
(211, 1),
(212, 1),
(214, 1),
(217, 9),
(217, 953),
(217, 965),
(224, 1),
(227, 1),
(233, 3),
(233, 245),
(233, 254),
(233, 255),
(233, 256),
(233, 257),
(233, 258),
(233, 260),
(233, 1285),
(234, 3),
(235, 3),
(236, 3),
(246, 9),
(246, 953),
(246, 963),
(246, 964),
(247, 9),
(247, 953),
(247, 963),
(247, 964),
(247, 965),
(248, 9),
(248, 953),
(248, 962),
(248, 963),
(248, 964),
(248, 965),
(249, 953),
(250, 9),
(250, 953),
(250, 962),
(250, 963),
(250, 964),
(250, 965),
(251, 9),
(251, 953),
(251, 962),
(251, 963),
(251, 964),
(251, 965),
(252, 9),
(252, 953),
(252, 962),
(252, 963),
(252, 964),
(252, 965),
(253, 9),
(253, 953),
(253, 962),
(253, 963),
(253, 964),
(253, 965),
(254, 953),
(255, 953),
(256, 953),
(257, 953),
(258, 953),
(264, 3),
(266, 3),
(272, 9),
(272, 956),
(272, 975),
(272, 977),
(272, 978),
(272, 979),
(272, 980),
(272, 2976),
(273, 9),
(273, 956),
(273, 975),
(273, 977),
(273, 978),
(273, 979),
(273, 980),
(273, 2976),
(275, 956),
(275, 975),
(275, 977),
(275, 978),
(275, 979),
(275, 980),
(276, 9),
(276, 956),
(276, 975),
(276, 977),
(276, 978),
(276, 979),
(276, 980),
(276, 2976),
(278, 9),
(278, 953),
(278, 965),
(297, 3),
(298, 3),
(304, 3),
(310, 8),
(310, 927),
(310, 931),
(324, 1),
(324, 21),
(325, 1),
(325, 21),
(326, 1),
(327, 3),
(327, 245),
(327, 260),
(328, 3),
(328, 245),
(328, 254),
(328, 255),
(328, 256),
(328, 257),
(328, 258),
(328, 260),
(339, 956),
(339, 975),
(339, 977),
(339, 978),
(339, 979),
(339, 980),
(353, 3),
(354, 3),
(358, 8),
(358, 928),
(358, 942),
(359, 8),
(359, 928),
(359, 942),
(360, 8),
(360, 928),
(360, 942);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_data`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86210 ;

--
-- Dumping data for table `shop_product_properties_data`
--

INSERT INTO `shop_product_properties_data` (`id`, `property_id`, `product_id`, `value`, `locale`) VALUES
(35533, 187, 8532, 'Сумка туристическая', 'ru'),
(54152, 111, 941, 'Стекловолокно', 'ru'),
(54141, 110, 926, '1', 'ru'),
(54142, 111, 926, 'Стекловолокно', 'ru'),
(54140, 112, 926, '160 — 190', 'ru'),
(54139, 114, 926, 'Нет', 'ru'),
(54138, 202, 926, 'Кемпинговая', 'ru'),
(54144, 114, 938, 'Нет', 'ru'),
(54145, 112, 938, 'до 130', 'ru'),
(54146, 110, 938, '2', 'ru'),
(54147, 111, 938, 'Стекловолокно', 'ru'),
(54143, 202, 938, 'Кемпинговая', 'ru'),
(54151, 110, 941, '2', 'ru'),
(54150, 112, 941, 'до 130', 'ru'),
(54149, 114, 941, 'Нет', 'ru'),
(54156, 110, 942, '2', 'ru'),
(54157, 111, 942, 'Стекловолокно', 'ru'),
(54155, 112, 942, 'до 130', 'ru'),
(54154, 114, 942, 'Нет', 'ru'),
(54153, 202, 942, 'Кемпинговая', 'ru'),
(54148, 202, 941, 'Кемпинговая', 'ru'),
(54161, 110, 950, '2', 'ru'),
(54160, 112, 950, 'до 130', 'ru'),
(54159, 114, 950, 'Нет', 'ru'),
(54158, 202, 950, 'Туристическая', 'ru'),
(54167, 111, 951, 'Сталь', 'ru'),
(54166, 110, 951, '4', 'ru'),
(54165, 112, 951, 'свыше 190', 'ru'),
(54164, 114, 951, 'Нет', 'ru'),
(54163, 202, 951, 'Кемпинговая', 'ru'),
(54171, 110, 952, '3', 'ru'),
(54170, 112, 952, 'до 130', 'ru'),
(54169, 114, 952, 'Нет', 'ru'),
(54168, 202, 952, 'Туристическая', 'ru'),
(54177, 111, 953, 'Стекловолокно', 'ru'),
(54175, 112, 953, 'до 130', 'ru'),
(54176, 110, 953, '2', 'ru'),
(54174, 114, 953, 'Есть', 'ru'),
(54173, 202, 953, 'Туристическая', 'ru'),
(54181, 110, 954, '2', 'ru'),
(54180, 112, 954, 'до 130', 'ru'),
(54179, 114, 954, 'Нет', 'ru'),
(54178, 202, 954, 'Туристическая', 'ru'),
(1579, 70, 959, 'Black', 'ru'),
(1577, 124, 959, 'Да', 'ru'),
(1576, 125, 959, '8 Gb', 'ru'),
(1574, 127, 959, 'литий-полимерный аккумулятор', 'ru'),
(1570, 123, 959, 'да', 'ru'),
(54191, 110, 960, '2', 'ru'),
(54190, 112, 960, 'до 130', 'ru'),
(54189, 114, 960, 'Есть', 'ru'),
(54188, 202, 960, 'Туристическая', 'ru'),
(54187, 111, 961, 'Стекловолокно', 'ru'),
(54186, 110, 961, '2', 'ru'),
(54185, 112, 961, 'до 130', 'ru'),
(54183, 202, 961, 'Туристическая', 'ru'),
(54196, 110, 962, '3', 'ru'),
(54197, 111, 962, 'Стекловолокно', 'ru'),
(54195, 112, 962, 'до 130', 'ru'),
(54194, 114, 962, 'Есть', 'ru'),
(54201, 110, 963, '3', 'ru'),
(54200, 112, 963, '160 — 190', 'ru'),
(54199, 114, 963, 'Нет', 'ru'),
(54198, 202, 963, 'Кемпинговая', 'ru'),
(1841, 123, 1015, 'Нет', 'ru'),
(1757, 70, 1006, 'Black', 'ru'),
(1755, 124, 1006, 'Нет', 'ru'),
(1754, 133, 1006, '32 Gb', 'ru'),
(1752, 127, 1006, 'литий-ионный аккумулятор', 'ru'),
(1749, 123, 1006, 'Нет', 'ru'),
(1840, 124, 1015, 'Да', 'ru'),
(1838, 127, 1015, 'литий-ионный аккумулятор', 'ru'),
(1835, 133, 1015, '8 Gb', 'ru'),
(1842, 70, 1015, 'Black', 'ru'),
(1854, 127, 1018, 'литий-ионный аккумулятор', 'ru'),
(58813, 135, 1096, 'от 1 до 1.5 GHz', 'ru'),
(58812, 122, 1096, '8 Mpx', 'ru'),
(58811, 139, 1096, 'Android 4.1', 'ru'),
(1851, 133, 1018, '4 Gb', 'ru'),
(1856, 124, 1018, 'Да', 'ru'),
(1857, 123, 1018, 'Да', 'ru'),
(1858, 70, 1018, 'Black', 'ru'),
(58835, 135, 1019, 'от 1.5 до 2 GHz', 'ru'),
(58834, 122, 1019, '5 Mpx', 'ru'),
(58833, 139, 1019, 'Android', 'ru'),
(58832, 41, 1019, '1', 'ru'),
(1883, 133, 1021, '2 Gb', 'ru'),
(58810, 41, 1096, '2', 'ru'),
(1885, 124, 1021, 'Нет', 'ru'),
(1886, 123, 1021, 'Нет', 'ru'),
(1887, 70, 1021, 'Black', 'ru'),
(1897, 124, 1022, 'Да', 'ru'),
(58809, 141, 1096, '5.0', 'ru'),
(58808, 310, 1096, 'от 2000 до 3000 mAh', 'ru'),
(1894, 133, 1022, '4 Gb', 'ru'),
(1898, 123, 1022, 'Да', 'ru'),
(1899, 70, 1022, 'White', 'ru'),
(47854, 41, 5604, '2', 'ru'),
(47855, 42, 5604, 'Моноблок', 'ru'),
(47850, 42, 5603, 'Моноблок', 'ru'),
(47849, 41, 5603, '2', 'ru'),
(47844, 42, 5602, 'Моноблок', 'ru'),
(47843, 41, 5602, '2', 'ru'),
(47838, 41, 5622, '2', 'ru'),
(47839, 42, 5622, 'Моноблок', 'ru'),
(86178, 141, 1104, '', 'ru'),
(86182, 41, 1104, '1', 'ru'),
(86184, 139, 1104, 'Android 4.0', 'ru'),
(86186, 122, 1104, '13 Mpx', 'ru'),
(86188, 135, 1104, 'от 1.5 до 2 GHz', 'ru'),
(47833, 42, 5625, 'Моноблок', 'ru'),
(54206, 110, 1121, '3', 'ru'),
(54207, 111, 1121, 'Стекловолокно', 'ru'),
(54205, 112, 1121, 'до 130', 'ru'),
(54203, 202, 1121, 'Туристическая', 'ru'),
(54204, 114, 1121, 'Есть', 'ru'),
(54211, 110, 1122, '4', 'ru'),
(54210, 112, 1122, 'до 130', 'ru'),
(54209, 114, 1122, 'Есть', 'ru'),
(54208, 202, 1122, 'Туристическая', 'ru'),
(54216, 110, 1124, '5', 'ru'),
(54215, 112, 1124, 'до 130', 'ru'),
(54214, 114, 1124, 'Есть', 'ru'),
(54213, 202, 1124, 'Туристическая', 'ru'),
(54221, 110, 1125, '3', 'ru'),
(54220, 112, 1125, 'до 130', 'ru'),
(54219, 114, 1125, 'Нет', 'ru'),
(54218, 202, 1125, 'Туристическая', 'ru'),
(54226, 110, 1128, '3', 'ru'),
(54225, 112, 1128, 'до 130', 'ru'),
(54224, 114, 1128, 'Нет', 'ru'),
(54223, 202, 1128, 'Туристическая', 'ru'),
(58806, 122, 1099, '13 Mpx', 'ru'),
(86179, 310, 1104, 'от 1500 до 2000 mAh', 'ru'),
(58807, 122, 1108, '8 Mpx', 'ru'),
(54231, 110, 1243, '4', 'ru'),
(54230, 112, 1243, 'до 130', 'ru'),
(54229, 114, 1243, 'Нет', 'ru'),
(54184, 114, 961, 'Нет', 'ru'),
(54228, 202, 1243, 'Туристическая', 'ru'),
(54236, 110, 1245, '4', 'ru'),
(54235, 112, 1245, 'до 130', 'ru'),
(54234, 114, 1245, 'Есть', 'ru'),
(54193, 202, 962, 'Туристическая', 'ru'),
(4052, 78, 1247, 'Латекс', 'ru'),
(54233, 202, 1245, 'Туристическая', 'ru'),
(32865, 217, 955, '16:09', 'ru'),
(32861, 250, 955, '200 Гц', 'ru'),
(32862, 251, 955, 'Dolby Digital Plus', 'ru'),
(32863, 252, 955, '2 шт', 'ru'),
(32864, 253, 955, '2х10 Вт', 'ru'),
(32856, 217, 949, '16:09', 'ru'),
(32855, 253, 949, '2х12 Вт', 'ru'),
(32854, 252, 949, '2 шт', 'ru'),
(32853, 251, 949, 'Есть', 'ru'),
(32850, 141, 949, '47', 'ru'),
(32851, 247, 949, '1920x1080', 'ru'),
(32852, 250, 949, '700 Гц', 'ru'),
(32847, 217, 945, '16:09', 'ru'),
(32846, 253, 945, '2х15 Вт', 'ru'),
(32844, 251, 945, 'Есть', 'ru'),
(32845, 252, 945, '2 шт', 'ru'),
(32843, 250, 945, '1400 Гц', 'ru'),
(32842, 247, 945, '1920x1080', 'ru'),
(32841, 141, 945, '46', 'ru'),
(33456, 217, 5123, '16:09', 'ru'),
(33455, 253, 5123, '2х12 Вт', 'ru'),
(33454, 252, 5123, '2 шт', 'ru'),
(33453, 251, 5123, 'Есть', 'ru'),
(33450, 141, 5123, '42', 'ru'),
(33451, 247, 5123, '1920x1080', 'ru'),
(33452, 250, 5123, '700 Гц', 'ru'),
(33448, 217, 5122, '16:09', 'ru'),
(33447, 253, 5122, '2х10 Вт', 'ru'),
(33446, 252, 5122, '2 шт', 'ru'),
(33445, 251, 5122, 'Есть', 'ru'),
(33444, 250, 5122, '200 Гц', 'ru'),
(33443, 247, 5122, '1920x1080', 'ru'),
(32860, 247, 955, '1920x1080', 'ru'),
(32859, 141, 955, '32', 'ru'),
(65081, 217, 957, '16:09', 'ru'),
(65082, 278, 957, '3D LED-телевизор', 'ru'),
(65080, 247, 957, '1920x1080', 'ru'),
(65079, 253, 957, '2х10 Вт', 'ru'),
(65078, 252, 957, '2 шт', 'ru'),
(65061, 278, 956, '3D LED-телевизор', 'ru'),
(65060, 217, 956, '16:09', 'ru'),
(65059, 247, 956, '1920x1080', 'ru'),
(65058, 253, 956, '2х10 Вт', 'ru'),
(65057, 252, 956, '2 шт', 'ru'),
(65089, 278, 989, '3D LED-телевизор', 'ru'),
(65088, 217, 989, '16:09', 'ru'),
(65085, 252, 989, '2 шт', 'ru'),
(65086, 253, 989, '2х10 Вт', 'ru'),
(65087, 247, 989, '1920x1080', 'ru'),
(22027, 187, 5124, '3D LED-телевизор', 'ru'),
(22028, 246, 5124, '32"', 'ru'),
(22029, 247, 5124, '1920x1080', 'ru'),
(22030, 217, 5124, '16:09', 'ru'),
(22031, 250, 5124, '400 Гц', 'ru'),
(22032, 251, 5124, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(22033, 252, 5124, '2 шт', 'ru'),
(22034, 253, 5124, '2х10 Вт', 'ru'),
(32901, 252, 995, '2 шт', 'ru'),
(32900, 251, 995, 'Dolby Digital Plus', 'ru'),
(32899, 250, 995, '200 Гц', 'ru'),
(32898, 247, 995, '1920x1080', 'ru'),
(32897, 141, 995, '40', 'ru'),
(65095, 217, 1027, '16:09', 'ru'),
(65096, 278, 1027, '3D LED-телевизор', 'ru'),
(65094, 247, 1027, '1920x1080', 'ru'),
(65093, 253, 1027, '2х10 Вт', 'ru'),
(65092, 252, 1027, '2 шт', 'ru'),
(62110, 253, 1028, '2х10 Вт', 'ru'),
(62109, 252, 1028, '2 шт', 'ru'),
(62108, 251, 1028, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(62107, 250, 1028, '400 Гц', 'ru'),
(62106, 247, 1028, '1920x1080', 'ru'),
(62124, 253, 1029, '2х10 Вт', 'ru'),
(62123, 252, 1029, '2 шт', 'ru'),
(62122, 251, 1029, 'Dolby Digital Plus', 'ru'),
(62121, 250, 1029, '100 ГЦ', 'ru'),
(62120, 247, 1029, '1920x1080', 'ru'),
(62131, 253, 1030, '2х5 Вт', 'ru'),
(62130, 252, 1030, '2 шт', 'ru'),
(62129, 251, 1030, 'Dolby Digital Plus', 'ru'),
(62128, 250, 1030, '100 ГЦ', 'ru'),
(62127, 247, 1030, '1920x1080', 'ru'),
(33418, 217, 1034, '16:09', 'ru'),
(33417, 253, 1034, '2х3 Вт', 'ru'),
(33416, 252, 1034, '2 шт', 'ru'),
(33415, 251, 1034, 'Есть', 'ru'),
(33414, 250, 1034, '50 Гц', 'ru'),
(33425, 217, 1032, '16:09', 'ru'),
(33424, 253, 1032, '2х5 Вт', 'ru'),
(33423, 252, 1032, '2 шт', 'ru'),
(33422, 251, 1032, 'Есть', 'ru'),
(33421, 250, 1032, '50 Гц', 'ru'),
(62138, 253, 1031, '2х10 Вт', 'ru'),
(62137, 252, 1031, '2 шт', 'ru'),
(62136, 251, 1031, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(62135, 250, 1031, '600 Гц', 'ru'),
(62134, 247, 1031, '1920x1080', 'ru'),
(33431, 252, 3404, '2 шт', 'ru'),
(33430, 251, 3404, 'Dolby Digital Plus', 'ru'),
(33429, 250, 3404, '200 Гц', 'ru'),
(33428, 247, 3404, '1920x1080', 'ru'),
(33427, 141, 3404, '46', 'ru'),
(22243, 187, 5240, '3D LED-телевизор', 'ru'),
(22244, 246, 5240, '46"', 'ru'),
(22245, 247, 5240, '1920x1080', 'ru'),
(22246, 217, 5240, '16:09', 'ru'),
(22247, 250, 5240, '200 Гц', 'ru'),
(22248, 251, 5240, 'Dolby Digital Plus', 'ru'),
(22249, 252, 5240, '2 шт', 'ru'),
(22250, 253, 5240, '2х10 Вт', 'ru'),
(33442, 278, 5122, '3D LED-телевизор', 'ru'),
(33449, 278, 5123, '3D LED-телевизор', 'ru'),
(32840, 278, 945, '3D LED-телевизор', 'ru'),
(32849, 278, 949, '3D LED-телевизор', 'ru'),
(32858, 278, 955, '3D LED-телевизор', 'ru'),
(65076, 250, 957, '200 Гц', 'ru'),
(65056, 251, 956, 'Dolby Digital Plus', 'ru'),
(24596, 278, 5124, '3D LED-телевизор', 'ru'),
(24597, 141, 5124, '32', 'ru'),
(32896, 278, 995, '3D LED-телевизор', 'ru'),
(65091, 251, 1027, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(62105, 278, 1028, '3D LED-телевизор', 'ru'),
(62126, 278, 1030, 'LED-телевизор', 'ru'),
(33413, 247, 1034, '1366x768', 'ru'),
(33420, 247, 1032, '1366x768', 'ru'),
(62133, 278, 1031, '3D LED-телевизор', 'ru'),
(33426, 278, 3404, '3D LED-телевизор', 'ru'),
(24622, 278, 5240, '3D LED-телевизор', 'ru'),
(24623, 141, 5240, '46', 'ru'),
(47731, 41, 5596, '2', 'ru'),
(47730, 127, 5596, 'от 400 до 800 mAh', 'ru'),
(47729, 141, 5596, '1.8', 'ru'),
(47728, 142, 5596, '160х128', 'ru'),
(47842, 127, 5602, 'от 800 до 1000 mAh', 'ru'),
(47841, 141, 5602, '1.7', 'ru'),
(47840, 142, 5602, '160х128', 'ru'),
(47848, 146, 5603, 'от 80 до 100 г.', 'ru'),
(47847, 127, 5603, 'от 800 до 1000 mAh', 'ru'),
(47846, 141, 5603, '2.4', 'ru'),
(47845, 142, 5603, '320х240', 'ru'),
(47853, 127, 5604, 'от 800 до 1000 mAh', 'ru'),
(47852, 141, 5604, '1.7', 'ru'),
(47851, 142, 5604, '160х128', 'ru'),
(47876, 127, 5605, 'от 1000 до 1500 mAh', 'ru'),
(47875, 141, 5605, '3.2', 'ru'),
(47874, 142, 5605, '400x240', 'ru'),
(47883, 146, 5606, 'от 100 до 150 г.', 'ru'),
(47882, 127, 5606, 'от 800 до 1000 mAh', 'ru'),
(47881, 141, 5606, '2.4', 'ru'),
(47880, 142, 5606, '320х240', 'ru'),
(47837, 146, 5622, 'от 80 до 100 г.', 'ru'),
(47836, 127, 5622, 'от 800 до 1000 mAh', 'ru'),
(47835, 141, 5622, '2.4', 'ru'),
(47834, 142, 5622, '320х240', 'ru'),
(25399, 42, 5623, 'Моноблок', 'ru'),
(25400, 141, 5623, '2.8', 'ru'),
(25401, 142, 5623, '320х240', 'ru'),
(25402, 127, 5623, 'от 800 до 1000 mAh', 'ru'),
(25403, 146, 5623, 'от 80 до 100 г.', 'ru'),
(25404, 41, 5623, '2', 'ru'),
(25405, 42, 5624, 'Моноблок', 'ru'),
(25406, 141, 5624, '2.8', 'ru'),
(25407, 142, 5624, '320х240', 'ru'),
(25408, 127, 5624, 'от 800 до 1000 mAh', 'ru'),
(25409, 146, 5624, 'от 80 до 100 г.', 'ru'),
(25410, 41, 5624, '2', 'ru'),
(47831, 146, 5625, 'от 80 до 100 г.', 'ru'),
(47830, 127, 5625, 'от 800 до 1000 mAh', 'ru'),
(47829, 141, 5625, '3.2', 'ru'),
(47828, 142, 5625, '320х240', 'ru'),
(47826, 41, 5626, '2', 'ru'),
(47825, 146, 5626, 'от 80 до 100 г.', 'ru'),
(47824, 127, 5626, 'от 800 до 1000 mAh', 'ru'),
(47823, 141, 5626, '3.2', 'ru'),
(47822, 142, 5626, '320х240', 'ru'),
(47816, 41, 5627, '2', 'ru'),
(47815, 146, 5627, 'от 100 до 150 г.', 'ru'),
(47781, 41, 5628, '2', 'ru'),
(47780, 146, 5628, 'от 100 до 150 г.', 'ru'),
(47777, 42, 5629, 'Моноблок', 'ru'),
(47817, 42, 5627, 'Моноблок', 'ru'),
(47776, 41, 5629, '2', 'ru'),
(47775, 146, 5629, 'от 80 до 100 г.', 'ru'),
(47764, 146, 5630, 'от 100 до 150 г.', 'ru'),
(47763, 127, 5630, 'от 1000 до 1500 mAh', 'ru'),
(47762, 141, 5630, '3.5', 'ru'),
(47761, 142, 5630, '480х320', 'ru'),
(47758, 146, 5631, 'от 80 до 100 г.', 'ru'),
(47757, 141, 5631, '2.8', 'ru'),
(47756, 142, 5631, '320х240', 'ru'),
(47754, 41, 5632, '1', 'ru'),
(47753, 146, 5632, 'от 80 до 100 г.', 'ru'),
(47741, 127, 5633, 'от 1000 до 1500 mAh', 'ru'),
(47740, 141, 5633, '1.6', 'ru'),
(47739, 142, 5633, '128x64', 'ru'),
(47736, 146, 5634, 'от 60 до 80 г.', 'ru'),
(47735, 127, 5634, 'от 800 до 1000 mAh', 'ru'),
(47734, 141, 5634, '2.2', 'ru'),
(47733, 142, 5634, '220х176', 'ru'),
(54239, 202, 8551, 'Для пешего и горного туризма', 'ru'),
(54238, 206, 8551, '25 л', 'ru'),
(54182, 111, 954, 'Стекловолокно', 'ru'),
(54172, 111, 952, 'Стекловолокно', 'ru'),
(54162, 111, 950, 'Стекловолокно', 'ru'),
(32599, 123, 7978, 'Есть', 'ru'),
(32598, 133, 7977, '2 GB', 'ru'),
(32597, 123, 7977, 'Есть', 'ru'),
(32596, 133, 7976, '8 GB', 'ru'),
(32595, 123, 7976, 'Есть', 'ru'),
(32594, 133, 7975, '4 GB', 'ru'),
(32593, 123, 7975, 'Есть', 'ru'),
(32592, 133, 7974, '4 GB', 'ru'),
(32591, 123, 7974, 'Есть', 'ru'),
(32600, 133, 7978, '2 GB', 'ru'),
(32601, 123, 7979, 'Есть', 'ru'),
(32602, 133, 7979, '4 GB', 'ru'),
(32603, 123, 7980, 'Есть', 'ru'),
(32604, 133, 7980, '4 GB', 'ru'),
(32605, 123, 7981, 'Есть', 'ru'),
(32606, 133, 7981, '4 GB', 'ru'),
(32607, 123, 7982, 'Есть', 'ru'),
(32608, 133, 7982, '8 GB', 'ru'),
(32609, 123, 7983, 'Есть', 'ru'),
(32610, 133, 7983, '8 GB', 'ru'),
(32611, 123, 7984, 'Есть', 'ru'),
(32612, 133, 7984, '4 GB', 'ru'),
(32613, 124, 7984, 'Нет', 'ru'),
(32614, 123, 7985, 'Есть', 'ru'),
(32615, 133, 7985, '8 GB', 'ru'),
(32616, 124, 7985, 'Нет', 'ru'),
(32617, 133, 7986, '2 GB', 'ru'),
(32618, 133, 7987, '2 GB', 'ru'),
(32619, 123, 7988, 'Есть', 'ru'),
(32620, 133, 7988, '4 GB', 'ru'),
(32621, 124, 7988, 'Есть', 'ru'),
(32622, 123, 7989, 'Есть', 'ru'),
(32623, 133, 7989, '4 GB', 'ru'),
(32624, 124, 7989, 'Есть', 'ru'),
(32625, 123, 7990, 'Есть', 'ru'),
(32626, 133, 7990, '8 GB', 'ru'),
(32627, 124, 7990, 'Есть', 'ru'),
(32628, 123, 7991, 'Есть', 'ru'),
(32629, 133, 7991, '8 GB', 'ru'),
(32630, 124, 7991, 'Есть', 'ru'),
(32631, 123, 7992, 'Есть', 'ru'),
(32632, 146, 7992, 'от 10 до 60 г.', 'ru'),
(32633, 133, 7992, '4 GB', 'ru'),
(32634, 124, 7992, 'Есть', 'ru'),
(32902, 253, 995, '2х10 Вт', 'ru'),
(32903, 217, 995, '16:09', 'ru'),
(33419, 278, 1032, 'LED-телевизор', 'ru'),
(33432, 253, 3404, '2х10 Вт', 'ru'),
(33412, 278, 1034, 'LED-телевизор', 'ru'),
(33433, 217, 3404, '16:09', 'ru'),
(35160, 187, 8430, 'Вкладыш для спального мешка', 'ru'),
(35161, 187, 8431, 'Вкладыш для спального мешка', 'ru'),
(35162, 187, 8432, 'Одеяло', 'ru'),
(35163, 187, 8433, 'Одеяло', 'ru'),
(35164, 187, 8434, 'Одеяло', 'ru'),
(35165, 187, 8435, 'Одеяло', 'ru'),
(35166, 187, 8436, 'Одеяло', 'ru'),
(35167, 187, 8437, 'Одеяло', 'ru'),
(35168, 187, 8438, 'Кокон', 'ru'),
(35169, 187, 8439, 'Кокон', 'ru'),
(35170, 187, 8440, 'Кокон', 'ru'),
(35171, 187, 8441, 'Кокон', 'ru'),
(35172, 187, 8442, 'Одеяло', 'ru'),
(35173, 187, 8443, 'Одеяло', 'ru'),
(35174, 187, 8444, 'Кокон', 'ru'),
(35175, 187, 8445, 'Кокон', 'ru'),
(35176, 187, 8446, 'Кокон', 'ru'),
(54957, 42, 10734, 'купить Чехол HTC HC V841', 'ru'),
(47782, 42, 5628, 'Моноблок', 'ru'),
(47779, 127, 5628, 'от 1000 до 1500 mAh', 'ru'),
(47778, 142, 5628, '480х320', 'ru'),
(35534, 201, 8532, 'Полиэстер', 'ru'),
(35535, 187, 8533, 'Сумка туристическая', 'ru'),
(35536, 201, 8533, 'Полиэстер', 'ru'),
(35537, 187, 8534, 'Сумка туристическая', 'ru'),
(35538, 201, 8534, 'Полиэстер', 'ru'),
(35539, 187, 8535, 'Сумка туристическая', 'ru'),
(35540, 201, 8535, 'Полиэстер', 'ru'),
(35541, 187, 8536, 'Сумка кухонная', 'ru'),
(35542, 201, 8536, 'Полиэстер', 'ru'),
(35543, 187, 8537, 'Сумка кухонная', 'ru'),
(35544, 201, 8537, 'Полиэстер', 'ru'),
(35545, 187, 8538, 'Сумка кухонная', 'ru'),
(35546, 201, 8538, 'Полиэстер', 'ru'),
(35547, 187, 8539, 'Сумка на плече', 'ru'),
(35548, 201, 8539, 'Полиэстер', 'ru'),
(35549, 187, 8540, 'Сумка на плече', 'ru'),
(35550, 201, 8540, 'Полиэстер', 'ru'),
(35551, 187, 8541, 'Сумка туристическая', 'ru'),
(35552, 201, 8541, 'Полиэстер', 'ru'),
(35553, 187, 8542, 'Сумка туристическая', 'ru'),
(35554, 201, 8542, 'Полиэстер', 'ru'),
(35555, 187, 8543, 'Сумочка для мелочей', 'ru'),
(35556, 201, 8543, 'Полиэстер', 'ru'),
(35557, 187, 8544, 'Сумочка для средств гигиены', 'ru'),
(35558, 201, 8544, 'Полиэстер', 'ru'),
(35559, 187, 8545, 'Сумочка для средств гигиены', 'ru'),
(35560, 201, 8545, 'Полиэстер', 'ru'),
(35561, 187, 8546, 'Сумочка для средств гигиены', 'ru'),
(35562, 201, 8546, 'Полиэстер', 'ru'),
(35563, 187, 8547, 'Сумочка для средств гигиены', 'ru'),
(35564, 201, 8547, 'Полиэстер', 'ru'),
(35565, 187, 8548, 'Сумочка для средств гигиены', 'ru'),
(35566, 201, 8548, 'Полиэстер', 'ru'),
(35567, 187, 8549, 'Сумочка для средств гигиены', 'ru'),
(35568, 201, 8549, 'Полиэстер', 'ru'),
(35571, 187, 8550, 'Сумочка для средств гигиены', 'ru'),
(35572, 201, 8550, 'Брезент', 'ru'),
(35604, 203, 8551, 'Каркасы', 'ru'),
(35605, 203, 8552, 'Каркасы', 'ru'),
(35606, 203, 8553, 'Колышки', 'ru'),
(35576, 203, 8554, 'Колышки', 'ru'),
(35577, 203, 8555, 'Колышки', 'ru'),
(35578, 203, 8556, 'Колышки', 'ru'),
(35579, 203, 8557, 'Колышки', 'ru'),
(35580, 203, 8558, 'Молотки', 'ru'),
(35581, 203, 8559, 'Растяжки', 'ru'),
(35582, 203, 8560, 'Растяжки', 'ru'),
(35583, 203, 8561, 'Альпенштоки', 'ru'),
(35584, 203, 8562, 'Экстракторы', 'ru'),
(35585, 203, 8563, 'Каркасы', 'ru'),
(35586, 203, 8564, 'Каркасы', 'ru'),
(47732, 42, 5596, 'Моноблок', 'ru'),
(47737, 41, 5634, '2', 'ru'),
(47738, 42, 5634, 'Раскладной', 'ru'),
(47742, 146, 5633, 'от 60 до 80 г.', 'ru'),
(47743, 41, 5633, '1', 'ru'),
(47744, 42, 5633, 'Моноблок', 'ru'),
(47755, 42, 5632, 'Моноблок', 'ru'),
(47752, 127, 5632, 'от 800 до 1000 mAh', 'ru'),
(47751, 142, 5632, '320х240', 'ru'),
(47759, 41, 5631, '2', 'ru'),
(47760, 42, 5631, 'Моноблок', 'ru'),
(47765, 41, 5630, '2', 'ru'),
(47766, 42, 5630, 'Моноблок', 'ru'),
(47774, 127, 5629, 'от 1000 до 1500 mAh', 'ru'),
(47773, 142, 5629, '400x240', 'ru'),
(47814, 127, 5627, 'от 1000 до 1500 mAh', 'ru'),
(47813, 142, 5627, '480х320', 'ru'),
(47832, 41, 5625, '2', 'ru'),
(47827, 42, 5626, 'Моноблок', 'ru'),
(47821, 41, 1023, '1', 'ru'),
(47820, 127, 1023, 'от 1000 до 1500 mAh', 'ru'),
(47877, 146, 5605, 'от 80 до 100 г.', 'ru'),
(47878, 41, 5605, '2', 'ru'),
(47879, 42, 5605, 'Моноблок', 'ru'),
(47884, 41, 5606, '2', 'ru'),
(47885, 42, 5606, 'Моноблок', 'ru'),
(54192, 111, 960, 'Стекловолокно', 'ru'),
(54202, 111, 963, 'Стекловолокно', 'ru'),
(54212, 111, 1122, 'Стекловолокно', 'ru'),
(54217, 111, 1124, 'Стекловолокно', 'ru'),
(54222, 111, 1125, 'Стекловолокно', 'ru'),
(54227, 111, 1128, 'Стекловолокно', 'ru'),
(54232, 111, 1243, 'Стекловолокно', 'ru'),
(54237, 111, 1245, 'Стекловолокно', 'ru'),
(54240, 206, 8552, '35 л', 'ru'),
(54241, 202, 8552, 'Для пешего и горного туризма', 'ru'),
(54242, 206, 8553, '60 л', 'ru'),
(54243, 202, 8553, 'Для пешего и горного туризма', 'ru'),
(54244, 206, 8554, '65 л', 'ru'),
(54245, 202, 8554, 'Для пешего и горного туризма', 'ru'),
(54246, 206, 8555, '85 л', 'ru'),
(54247, 202, 8555, 'Для пешего и горного туризма', 'ru'),
(54248, 206, 8556, '10 л', 'ru'),
(54249, 202, 8556, 'Для пешего и горного туризма', 'ru'),
(54250, 206, 8557, '30 л', 'ru'),
(54251, 202, 8557, 'Для пешего и горного туризма', 'ru'),
(54252, 206, 8558, '60 л', 'ru'),
(54253, 202, 8558, 'Для пешего и горного туризма', 'ru'),
(54254, 206, 8559, '70 л', 'ru'),
(54255, 202, 8559, 'Для пешего и горного туризма', 'ru'),
(54256, 206, 8560, '22 л', 'ru'),
(54257, 202, 8560, 'Городские', 'ru'),
(54258, 206, 8561, '22 л', 'ru'),
(54259, 202, 8561, 'Городские', 'ru'),
(54260, 206, 8562, '22 л', 'ru'),
(54261, 202, 8562, 'Городские', 'ru'),
(54262, 206, 8563, '18л', 'ru'),
(54263, 202, 8563, 'Городские', 'ru'),
(54264, 206, 8564, '18л', 'ru'),
(54265, 202, 8564, 'Городские', 'ru'),
(54266, 206, 10353, '110 л', 'ru'),
(54267, 202, 10353, 'Для пешего и горного туризма', 'ru'),
(54268, 206, 10354, '90 л', 'ru'),
(54269, 202, 10354, 'Для пешего и горного туризма', 'ru'),
(54270, 206, 10355, '60 л', 'ru'),
(54271, 202, 10355, 'Для пешего и горного туризма', 'ru'),
(54280, 206, 10360, '38 л', 'ru'),
(54281, 202, 10360, 'Городские', 'ru'),
(54282, 206, 10361, '25 л', 'ru'),
(54283, 202, 10361, 'Городские', 'ru'),
(54284, 202, 10362, 'Городские', 'ru'),
(54285, 203, 10363, 'Кресла', 'ru'),
(54286, 203, 10364, 'Кресла', 'ru'),
(54287, 203, 10365, 'Кресла', 'ru'),
(54288, 203, 10366, 'Кресла', 'ru'),
(54289, 203, 10367, 'Кресла', 'ru'),
(54290, 203, 10368, 'Кресла', 'ru'),
(54291, 203, 10369, 'Кресла', 'ru'),
(54292, 203, 10370, 'Наборы', 'ru'),
(54293, 203, 10371, 'Наборы', 'ru'),
(54294, 203, 10372, 'Раскладушки', 'ru'),
(54295, 203, 10373, 'Раскладушки', 'ru'),
(54296, 203, 10374, 'Столы', 'ru'),
(54297, 203, 10375, 'Столы', 'ru'),
(54298, 203, 10376, 'Столы', 'ru'),
(54299, 203, 10377, 'Столы', 'ru'),
(54300, 203, 10378, 'Столы', 'ru'),
(54301, 203, 10379, 'Столы', 'ru'),
(54302, 203, 10380, 'Столы', 'ru'),
(54879, 203, 10699, 'Брюки', 'ru'),
(54880, 202, 10699, 'Мужское', 'ru'),
(54883, 203, 10701, 'Футболка с длинным рукавом', 'ru'),
(54884, 202, 10701, 'Унисекс', 'ru'),
(54916, 202, 10694, 'Женское', 'ru'),
(54871, 203, 10695, 'Лосины', 'ru'),
(54872, 202, 10695, 'Женское', 'ru'),
(54873, 203, 10696, 'Футболка с длинным рукавом', 'ru'),
(54874, 202, 10696, 'Мужское', 'ru'),
(54875, 203, 10697, 'Кальсоны', 'ru'),
(54876, 202, 10697, 'Мужское', 'ru'),
(54915, 203, 10694, 'Футболка с длинным рукавом', 'ru'),
(54860, 202, 10689, 'Женское', 'ru'),
(54859, 203, 10689, 'Лосины', 'ru'),
(54858, 202, 10688, 'Женское', 'ru'),
(54857, 203, 10688, 'Футболка с длинным рукавом', 'ru'),
(54856, 202, 10687, 'Женское', 'ru'),
(54855, 203, 10687, 'Лосины', 'ru'),
(54854, 202, 10686, 'Женское', 'ru'),
(54853, 203, 10686, 'Футболка с длинным рукавом', 'ru'),
(54852, 202, 10685, 'Мужское', 'ru'),
(54851, 203, 10685, 'Кальсоны', 'ru'),
(54848, 202, 10683, 'Мужское', 'ru'),
(54847, 203, 10683, 'Кальсоны', 'ru'),
(54846, 202, 10682, 'Мужское', 'ru'),
(54845, 203, 10682, 'Футболка с длинным рукавом', 'ru'),
(54922, 202, 10681, 'Мужское', 'ru'),
(54921, 203, 10681, 'Кальсоны', 'ru'),
(54885, 203, 10702, 'Брюки', 'ru'),
(54886, 202, 10702, 'Мужское', 'ru'),
(54887, 203, 10703, 'Брюки', 'ru'),
(54888, 202, 10703, 'Женское', 'ru'),
(54889, 203, 10704, 'Футболка с длинным рукавом', 'ru'),
(54890, 202, 10704, 'Унисекс', 'ru'),
(54891, 203, 10705, 'Футболка с коротким рукавом', 'ru'),
(54892, 202, 10705, 'Унисекс', 'ru'),
(54893, 203, 10706, 'Брюки', 'ru'),
(54894, 202, 10706, 'Мужское', 'ru'),
(54895, 203, 10707, 'Брюки', 'ru'),
(54896, 202, 10707, 'Женское', 'ru'),
(59101, 203, 10381, 'Стулья', 'ru'),
(58831, 310, 1019, 'от 1500 до 2000 mAh', 'ru'),
(58450, 122, 12030, '3 Mpx', 'ru'),
(58451, 41, 12030, '1', 'ru'),
(58452, 135, 12030, 'от 800 до 1000 MHz', 'ru'),
(58453, 141, 12030, '3.2', 'ru'),
(58454, 139, 12030, 'Android 2.3', 'ru'),
(58455, 310, 12030, 'от 1000 до 1500 mAh', 'ru'),
(58456, 122, 12031, '3 Mpx', 'ru'),
(58457, 41, 12031, '1', 'ru'),
(58458, 135, 12031, 'от 800 до 1000 MHz', 'ru'),
(58459, 141, 12031, '3.2', 'ru'),
(58460, 139, 12031, 'Android 2.3', 'ru'),
(58461, 310, 12031, 'от 1000 до 1500 mAh', 'ru'),
(58462, 122, 12032, '5 Mpx', 'ru'),
(58463, 41, 12032, '2', 'ru'),
(58464, 135, 12032, 'от 800 до 1000 MHz', 'ru'),
(58465, 141, 12032, '3.0', 'ru'),
(58466, 139, 12032, 'Android 2.3', 'ru'),
(58467, 310, 12032, 'от 1000 до 1500 mAh', 'ru'),
(58468, 122, 12033, '5 Mpx', 'ru'),
(58469, 41, 12033, '2', 'ru'),
(58470, 135, 12033, 'от 800 до 1000 MHz', 'ru'),
(58471, 141, 12033, '3.0', 'ru'),
(58472, 139, 12033, 'Android 2.3', 'ru'),
(58473, 310, 12033, 'от 1000 до 1500 mAh', 'ru'),
(58474, 122, 12034, '5 Mpx', 'ru'),
(58475, 41, 12034, '2', 'ru'),
(58476, 135, 12034, 'от 800 до 1000 MHz', 'ru'),
(58477, 141, 12034, '3.0', 'ru'),
(58478, 139, 12034, 'Android 2.3', 'ru'),
(58479, 310, 12034, 'от 1000 до 1500 mAh', 'ru'),
(58480, 122, 12035, '5 Mpx', 'ru'),
(58481, 41, 12035, '2', 'ru'),
(58482, 135, 12035, 'от 800 до 1000 MHz', 'ru'),
(58483, 141, 12035, '3.0', 'ru'),
(58484, 139, 12035, 'Android 2.3', 'ru'),
(58485, 310, 12035, 'от 1000 до 1500 mAh', 'ru'),
(58486, 122, 12036, '5 Mpx', 'ru'),
(58487, 41, 12036, '2', 'ru'),
(58488, 135, 12036, 'от 800 до 1000 MHz', 'ru'),
(58489, 141, 12036, '3.0', 'ru'),
(58490, 139, 12036, 'Android 2.3', 'ru'),
(58491, 310, 12036, 'от 1000 до 1500 mAh', 'ru'),
(58498, 122, 12038, '5 Mpx', 'ru'),
(58499, 41, 12038, '2', 'ru'),
(58500, 135, 12038, 'от 800 до 1000 MHz', 'ru'),
(58501, 141, 12038, '3.0', 'ru'),
(58502, 139, 12038, 'Android 2.3', 'ru'),
(58503, 310, 12038, 'от 1000 до 1500 mAh', 'ru'),
(58504, 122, 12039, '5 Mpx', 'ru'),
(58505, 41, 12039, '1', 'ru'),
(58506, 135, 12039, 'от 1 до 1.5 GHz', 'ru'),
(58507, 141, 12039, '3.0', 'ru'),
(58508, 139, 12039, 'Android 4.1', 'ru'),
(58509, 310, 12039, 'от 1000 до 1500 mAh', 'ru'),
(58510, 122, 12040, '5 Mpx', 'ru'),
(58511, 41, 12040, '1', 'ru'),
(58512, 135, 12040, 'от 1 до 1.5 GHz', 'ru'),
(58513, 141, 12040, '3.0', 'ru'),
(58514, 139, 12040, 'Android 4.1', 'ru'),
(58515, 310, 12040, 'от 1000 до 1500 mAh', 'ru'),
(58516, 122, 12041, '5 Mpx', 'ru'),
(58517, 41, 12041, '1', 'ru'),
(58518, 135, 12041, 'от 1 до 1.5 GHz', 'ru'),
(58519, 141, 12041, '3.7', 'ru'),
(58520, 139, 12041, 'Android 2.3', 'ru'),
(58521, 310, 12041, 'от 1000 до 1500 mAh', 'ru'),
(58522, 122, 12042, '5 Mpx', 'ru'),
(58523, 41, 12042, '1', 'ru'),
(58524, 135, 12042, 'от 1 до 1.5 GHz', 'ru'),
(58525, 141, 12042, '3.7', 'ru'),
(58526, 139, 12042, 'Android 2.3', 'ru'),
(58527, 310, 12042, 'от 1000 до 1500 mAh', 'ru'),
(58528, 122, 12043, '5 Mpx', 'ru'),
(58529, 41, 12043, '1', 'ru'),
(58530, 135, 12043, 'от 1 до 1.5 GHz', 'ru'),
(58531, 141, 12043, '4.0', 'ru'),
(58532, 139, 12043, 'Windows Phone 7.5', 'ru'),
(58533, 310, 12043, 'от 1500 до 2000 mAh', 'ru'),
(86145, 122, 12045, '5 Mpx', 'ru'),
(86144, 139, 12045, 'Android 4.0', 'ru'),
(86143, 41, 12045, '2', 'ru'),
(59102, 203, 10382, 'Стулья', 'ru'),
(76808, 252, 13278, '2 шт', 'ru'),
(59453, 246, 12737, '21.5"', 'ru'),
(59454, 247, 12737, '1920х1080', 'ru'),
(59455, 248, 12737, '16:09', 'ru'),
(59456, 250, 12737, '200 Гц', 'ru'),
(59457, 251, 12737, 'Есть', 'ru'),
(59458, 252, 12737, '2 шт', 'ru'),
(59459, 253, 12737, '2х3 Вт', 'ru'),
(59460, 246, 12738, '24"', 'ru'),
(59461, 247, 12738, '1920х1080', 'ru'),
(59462, 248, 12738, '16:09', 'ru'),
(59463, 250, 12738, '700 Гц', 'ru'),
(59464, 251, 12738, 'Есть', 'ru'),
(59465, 252, 12738, '2 шт', 'ru'),
(59466, 253, 12738, '2х3 Вт', 'ru'),
(59467, 246, 12739, '15"', 'ru'),
(59468, 247, 12739, '1024x768', 'ru'),
(59469, 248, 12739, '4:03', 'ru'),
(59470, 250, 12739, '1400 Гц', 'ru'),
(59471, 251, 12739, 'Есть', 'ru'),
(59472, 252, 12739, '2 шт', 'ru'),
(59473, 253, 12739, '2х1.5 Вт', 'ru'),
(59474, 246, 12740, '26"', 'ru'),
(59475, 247, 12740, '1366х768', 'ru'),
(59476, 248, 12740, '16:09', 'ru'),
(59477, 250, 12740, '700 Гц', 'ru'),
(59478, 251, 12740, 'Есть', 'ru'),
(59479, 252, 12740, '2 шт', 'ru'),
(59480, 246, 12741, '32"', 'ru'),
(59481, 247, 12741, '1366х768', 'ru'),
(59482, 248, 12741, '16:09', 'ru'),
(59483, 250, 12741, '200 Гц', 'ru'),
(59484, 251, 12741, 'Dolby Digital Plus', 'ru'),
(59485, 252, 12741, '2 шт', 'ru'),
(59486, 253, 12741, '2х5 Вт', 'ru'),
(62145, 253, 12742, '2х8 Вт', 'ru'),
(62144, 252, 12742, '2 шт', 'ru'),
(62143, 251, 12742, 'Dolby Digital Plus', 'ru'),
(62142, 250, 12742, '200 Гц', 'ru'),
(62141, 248, 12742, '16:09', 'ru'),
(62140, 247, 12742, '1920х1080', 'ru'),
(59494, 246, 12743, '22"', 'ru'),
(59495, 247, 12743, '1366х768', 'ru'),
(59496, 248, 12743, '16:09', 'ru'),
(59497, 250, 12743, '200 Гц', 'ru'),
(59498, 251, 12743, 'Dolby Digital Plus', 'ru'),
(59499, 252, 12743, '2 шт', 'ru'),
(59500, 253, 12743, '2х5 Вт', 'ru'),
(59501, 246, 12744, '26"', 'ru'),
(59502, 247, 12744, '1366х768', 'ru'),
(59503, 248, 12744, '16:09', 'ru'),
(59504, 250, 12744, '400 Гц', 'ru'),
(59505, 251, 12744, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio', 'ru'),
(59506, 252, 12744, '2 шт', 'ru'),
(59507, 253, 12744, '2х5 Вт', 'ru'),
(59508, 246, 12745, '26"', 'ru'),
(59509, 247, 12745, '1366х768', 'ru'),
(59510, 248, 12745, '16:09', 'ru'),
(59511, 250, 12745, '400 Гц', 'ru'),
(59512, 251, 12745, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(59513, 252, 12745, '2 шт', 'ru'),
(59514, 253, 12745, '2х7 Вт', 'ru'),
(59515, 246, 12746, '26"', 'ru'),
(59516, 247, 12746, '1366х768', 'ru'),
(59517, 248, 12746, '16:09', 'ru'),
(59518, 250, 12746, '200 Гц', 'ru'),
(59519, 251, 12746, 'Dolby Digital Plus', 'ru'),
(59520, 252, 12746, '2 шт', 'ru'),
(59521, 246, 12747, '32"', 'ru'),
(59522, 247, 12747, '1366х768', 'ru'),
(59523, 248, 12747, '16:09', 'ru'),
(59524, 250, 12747, '200 Гц', 'ru'),
(59525, 251, 12747, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(59526, 252, 12747, '2 шт', 'ru'),
(59527, 253, 12747, '2х10 Вт', 'ru'),
(59528, 246, 12748, '32"', 'ru'),
(59529, 247, 12748, '1920х1080', 'ru'),
(59530, 248, 12748, '16:09', 'ru'),
(59531, 250, 12748, '400 Гц', 'ru'),
(59532, 251, 12748, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(59533, 252, 12748, '2 шт', 'ru'),
(59534, 253, 12748, '2х10 Вт', 'ru'),
(62151, 253, 12749, '2х10 Вт', 'ru'),
(62150, 252, 12749, '2 шт', 'ru'),
(62149, 251, 12749, 'Dolby Digital Plus', 'ru'),
(62148, 250, 12749, '100 ГЦ', 'ru'),
(62147, 248, 12749, '16:09', 'ru'),
(62146, 247, 12749, '1366х768', 'ru'),
(59542, 246, 12750, '32"', 'ru'),
(59543, 247, 12750, '1366х768', 'ru'),
(59544, 248, 12750, '16:09', 'ru'),
(59545, 250, 12750, '100 ГЦ', 'ru'),
(59546, 251, 12750, 'Dolby Digital Plus', 'ru'),
(59547, 252, 12750, '2 шт', 'ru'),
(59548, 253, 12750, '2х10 Вт', 'ru'),
(59549, 246, 12751, '42"', 'ru'),
(59550, 247, 12751, '1366х768', 'ru'),
(59551, 248, 12751, '16:09', 'ru'),
(59552, 250, 12751, '100 ГЦ', 'ru'),
(59553, 251, 12751, 'Dolby Digital Plus', 'ru'),
(59554, 252, 12751, '2 шт', 'ru'),
(59555, 253, 12751, '2х10 Вт', 'ru'),
(62157, 252, 12752, '2 шт', 'ru'),
(62156, 251, 12752, 'Есть', 'ru'),
(62155, 250, 12752, '50 Гц', 'ru'),
(62154, 248, 12752, '16:09', 'ru'),
(62153, 247, 12752, '1920х1080', 'ru'),
(62152, 246, 12752, '42', 'ru'),
(62164, 252, 12753, '2 шт', 'ru'),
(62163, 251, 12753, 'Есть', 'ru'),
(62162, 250, 12753, '50 Гц', 'ru'),
(62161, 248, 12753, '16:09', 'ru'),
(62160, 247, 12753, '1920х1080', 'ru'),
(62159, 246, 12753, '42', 'ru'),
(62170, 252, 12754, '2 шт', 'ru'),
(62169, 251, 12754, 'Есть', 'ru'),
(62168, 250, 12754, '50 Гц', 'ru'),
(62167, 248, 12754, '16:09', 'ru'),
(62166, 247, 12754, '1366х768', 'ru'),
(59576, 246, 12755, '32"', 'ru'),
(59577, 247, 12755, '1920х1080', 'ru'),
(59578, 248, 12755, '16:09', 'ru'),
(59579, 250, 12755, '600 Гц', 'ru'),
(59580, 251, 12755, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(59581, 252, 12755, '2 шт', 'ru'),
(59582, 246, 12756, '32"', 'ru'),
(59583, 247, 12756, '1920х1080', 'ru'),
(59584, 248, 12756, '16:09', 'ru'),
(59585, 250, 12756, '400 Гц', 'ru'),
(59586, 251, 12756, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(59587, 252, 12756, '2 шт', 'ru'),
(76807, 251, 13278, 'Dolby Digital, Clear Voice II', 'ru'),
(76806, 250, 13278, '600 Гц', 'ru'),
(76805, 248, 13278, '16:9', 'ru'),
(60799, 246, 13279, '42"', 'ru'),
(60800, 247, 13279, '1024x768', 'ru'),
(60801, 248, 13279, '16:9', 'ru'),
(60802, 250, 13279, '600 Гц', 'ru'),
(60803, 251, 13279, 'Dolby Digital, Clear Voice II', 'ru'),
(60804, 252, 13279, '2 шт', 'ru'),
(60805, 253, 13279, '2х10 Вт', 'ru'),
(60806, 246, 13280, '50"', 'ru'),
(60807, 247, 13280, '1024x768', 'ru'),
(60808, 248, 13280, '16:9', 'ru'),
(60809, 250, 13280, '600 Гц', 'ru'),
(60810, 251, 13280, 'Dolby Digital, Clear Voice II', 'ru'),
(60811, 252, 13280, '2 шт', 'ru'),
(60812, 253, 13280, '2х10 Вт', 'ru'),
(60813, 246, 13281, '42"', 'ru'),
(60814, 247, 13281, '1920x1080', 'ru'),
(60815, 248, 13281, '16:9', 'ru'),
(60816, 250, 13281, '600 Гц', 'ru'),
(60817, 251, 13281, 'Есть', 'ru'),
(60818, 252, 13281, '2 шт', 'ru'),
(60819, 253, 13281, '2х10 Вт', 'ru'),
(60820, 246, 13282, '42"', 'ru'),
(60821, 247, 13282, '1920x1080', 'ru'),
(60822, 248, 13282, '16:9', 'ru'),
(60823, 250, 13282, '600 Гц', 'ru'),
(60824, 251, 13282, 'Есть', 'ru'),
(60825, 252, 13282, '2 шт', 'ru'),
(60826, 253, 13282, '2х10 Вт', 'ru'),
(60827, 246, 13283, '42"', 'ru'),
(60828, 247, 13283, '1920x1080', 'ru'),
(60829, 248, 13283, '16:9', 'ru'),
(60830, 250, 13283, '600 Гц', 'ru'),
(60831, 251, 13283, 'Есть', 'ru'),
(60832, 252, 13283, '2 шт', 'ru'),
(60833, 253, 13283, '2х10 Вт', 'ru'),
(60834, 246, 13284, '42"', 'ru'),
(60835, 247, 13284, '1920x1080', 'ru'),
(60836, 248, 13284, '16:9', 'ru'),
(60837, 250, 13284, '2500 Гц', 'ru'),
(60838, 251, 13284, 'Есть', 'ru'),
(60839, 252, 13284, '3 шт', 'ru'),
(60840, 253, 13284, '2х4 Вт,1x10 Вт', 'ru'),
(60841, 246, 13285, '42"', 'ru'),
(60842, 247, 13285, '1920x1080', 'ru'),
(60843, 248, 13285, '16:9', 'ru'),
(60844, 250, 13285, '2500 Гц', 'ru'),
(60845, 251, 13285, 'Есть', 'ru'),
(60846, 252, 13285, '2 шт', 'ru'),
(60847, 253, 13285, '2х10 Вт', 'ru'),
(60848, 246, 13286, '42"', 'ru'),
(60849, 247, 13286, '1024x768', 'ru'),
(60850, 248, 13286, '16:9', 'ru'),
(60851, 250, 13286, '600 Гц', 'ru'),
(60852, 251, 13286, 'Есть', 'ru'),
(60853, 252, 13286, '2 шт', 'ru'),
(60854, 253, 13286, '2х10 Вт', 'ru'),
(60855, 246, 13287, '50"', 'ru'),
(60856, 247, 13287, '1920x1080', 'ru'),
(60857, 248, 13287, '16:9', 'ru'),
(60858, 250, 13287, '2500 Гц', 'ru'),
(60859, 251, 13287, 'Есть', 'ru'),
(60860, 252, 13287, '3 шт', 'ru'),
(60861, 253, 13287, '2х4 Вт,1x10 Вт', 'ru'),
(60862, 246, 13288, '50"', 'ru'),
(60863, 247, 13288, '1920x1080', 'ru'),
(60864, 248, 13288, '16:9', 'ru'),
(60865, 250, 13288, '2500 Гц', 'ru'),
(60866, 251, 13288, 'Есть', 'ru'),
(60867, 252, 13288, '3 шт', 'ru'),
(60868, 253, 13288, '2х4 Вт,1x10 Вт', 'ru'),
(60869, 246, 13289, '50"', 'ru'),
(60870, 247, 13289, '1024x768', 'ru'),
(60871, 248, 13289, '16:9', 'ru'),
(60872, 250, 13289, '600 Гц', 'ru'),
(60873, 251, 13289, 'Есть', 'ru'),
(60874, 252, 13289, '2 шт', 'ru'),
(60875, 253, 13289, '2х10 Вт', 'ru'),
(60876, 246, 13290, '55"', 'ru'),
(60877, 247, 13290, '1920x1080', 'ru'),
(60878, 248, 13290, '16:9', 'ru'),
(60879, 250, 13290, '2500 Гц', 'ru'),
(60880, 251, 13290, 'Есть', 'ru'),
(60881, 252, 13290, '2 шт', 'ru'),
(60882, 246, 13291, '55"', 'ru'),
(60883, 247, 13291, '1920x1080', 'ru'),
(60884, 248, 13291, '16:9', 'ru'),
(60885, 250, 13291, '2500 Гц', 'ru'),
(60886, 251, 13291, 'Есть', 'ru'),
(60887, 252, 13291, '3 шт', 'ru'),
(60888, 253, 13291, '2х4 Вт,1x10 Вт', 'ru'),
(60889, 246, 13292, '65"', 'ru'),
(60890, 247, 13292, '1920x1080', 'ru'),
(60891, 248, 13292, '16:9', 'ru'),
(60892, 251, 13292, 'Есть', 'ru'),
(60893, 252, 13292, '2 шт', 'ru'),
(60894, 246, 13293, '65"', 'ru'),
(60895, 247, 13293, '1920x1080', 'ru'),
(60896, 248, 13293, '16:9', 'ru'),
(60897, 250, 13293, '2500 Гц', 'ru'),
(60898, 251, 13293, 'Есть', 'ru'),
(60899, 252, 13293, '3 шт', 'ru'),
(60900, 253, 13293, '2х4 Вт,1x10 Вт', 'ru'),
(60901, 246, 13294, '43"', 'ru'),
(60902, 247, 13294, '1024x768', 'ru'),
(60903, 248, 13294, '16:9', 'ru'),
(60904, 250, 13294, '600 Гц', 'ru'),
(60905, 251, 13294, 'Есть', 'ru'),
(60906, 252, 13294, '2 шт', 'ru'),
(60907, 253, 13294, '2х10 Вт', 'ru'),
(60908, 246, 13295, '43"', 'ru'),
(60909, 247, 13295, '1024x768', 'ru'),
(60910, 248, 13295, '16:9', 'ru'),
(60911, 251, 13295, 'Dolby Digital Plus / Pulse, DTS Sound Studio, DTS Premium Audio 5.1', 'ru'),
(60912, 252, 13295, '2 шт', 'ru'),
(60913, 253, 13295, '2х10 Вт', 'ru'),
(60914, 246, 13296, '51"', 'ru'),
(60915, 247, 13296, '1365х768', 'ru'),
(60916, 248, 13296, '16:9', 'ru'),
(60917, 250, 13296, '600 Гц', 'ru'),
(60918, 251, 13296, 'Есть', 'ru'),
(60919, 252, 13296, '2 шт', 'ru'),
(60920, 253, 13296, '2х10 Вт', 'ru'),
(60921, 246, 13297, '51"', 'ru'),
(60922, 247, 13297, '1024x768', 'ru'),
(60923, 248, 13297, '16:9', 'ru'),
(60924, 250, 13297, '600 Гц', 'ru'),
(60925, 251, 13297, 'Есть', 'ru'),
(60926, 252, 13297, '2 шт', 'ru'),
(60927, 253, 13297, '2х10 Вт', 'ru'),
(65055, 250, 956, '200 Гц', 'ru'),
(65077, 251, 957, 'Dolby Digital Plus', 'ru'),
(65090, 250, 1027, '200 Гц', 'ru'),
(62111, 217, 1028, '16:09', 'ru'),
(62119, 278, 1029, 'LED-телевизор', 'ru'),
(62125, 217, 1029, '16:09', 'ru'),
(62132, 217, 1030, '16:09', 'ru'),
(62139, 217, 1031, '16:09', 'ru'),
(62158, 253, 12752, '2х10 Вт', 'ru'),
(62165, 253, 12753, '2х10 Вт', 'ru'),
(64929, 141, 14173, '21', 'ru'),
(64930, 248, 14173, '4:3', 'ru'),
(64931, 250, 14173, '50 Гц', 'ru'),
(64932, 251, 14173, 'Есть', 'ru'),
(64933, 252, 14173, '2 шт', 'ru'),
(64934, 253, 14173, '2х10 Вт', 'ru'),
(64935, 141, 14174, '21', 'ru'),
(64936, 248, 14174, '4:3', 'ru'),
(64937, 250, 14174, '50 Гц', 'ru'),
(64938, 251, 14174, 'Есть', 'ru'),
(64939, 252, 14174, '2 шт', 'ru'),
(64940, 253, 14174, '2х10 Вт', 'ru'),
(64941, 141, 14175, '21', 'ru'),
(64942, 248, 14175, '4:3', 'ru'),
(64943, 250, 14175, '50 Гц', 'ru'),
(64944, 251, 14175, 'Есть', 'ru'),
(64945, 252, 14175, '4 шт', 'ru'),
(64946, 253, 14175, '4х5 Вт', 'ru'),
(64947, 141, 14176, '21', 'ru'),
(64948, 248, 14176, '4:3', 'ru'),
(64949, 250, 14176, '50 Гц', 'ru'),
(64950, 251, 14176, 'Есть', 'ru'),
(64951, 252, 14176, '2 шт', 'ru'),
(64952, 253, 14176, '2х10 Вт', 'ru'),
(64953, 141, 14177, '21', 'ru'),
(64954, 248, 14177, '4:3', 'ru'),
(64955, 250, 14177, '50 Гц', 'ru'),
(64956, 251, 14177, 'Есть', 'ru'),
(64957, 252, 14177, '2 шт', 'ru'),
(64958, 253, 14177, '2х5 Вт', 'ru'),
(64959, 141, 14178, '21', 'ru'),
(64960, 248, 14178, '4:3', 'ru'),
(64961, 250, 14178, '50 Гц', 'ru'),
(64962, 251, 14178, 'Есть', 'ru'),
(64963, 252, 14178, '2 шт', 'ru'),
(64964, 253, 14178, '2х5 Вт', 'ru'),
(64965, 141, 14179, '21', 'ru'),
(64966, 248, 14179, '4:3', 'ru'),
(64967, 250, 14179, '50 Гц', 'ru'),
(64968, 251, 14179, 'Есть', 'ru'),
(64969, 252, 14179, '2 шт', 'ru'),
(64970, 253, 14179, '2х2,5 Вт', 'ru'),
(64971, 141, 14180, '21', 'ru'),
(64972, 248, 14180, '4:3', 'ru'),
(64973, 250, 14180, '50 Гц', 'ru'),
(64974, 251, 14180, 'Есть', 'ru'),
(64975, 252, 14180, '2 шт', 'ru'),
(64976, 253, 14180, '2х2,5 Вт', 'ru'),
(64977, 141, 14181, '21', 'ru'),
(64978, 248, 14181, '4:3', 'ru'),
(64979, 250, 14181, '50 Гц', 'ru'),
(64980, 251, 14181, 'Есть', 'ru'),
(64981, 252, 14181, '2 шт', 'ru'),
(64982, 253, 14181, '2х2,5 Вт', 'ru'),
(64983, 141, 14182, '21', 'ru'),
(64984, 248, 14182, '4:3', 'ru'),
(64985, 250, 14182, '50 Гц', 'ru'),
(64986, 251, 14182, 'Есть', 'ru'),
(64987, 252, 14182, '2 шт', 'ru'),
(64988, 253, 14182, '2х2,5 Вт', 'ru'),
(64989, 141, 14183, '21', 'ru'),
(64990, 248, 14183, '4:3', 'ru'),
(64991, 250, 14183, '50 Гц', 'ru'),
(64992, 251, 14183, 'Есть', 'ru'),
(64993, 252, 14183, '2 шт', 'ru'),
(64994, 253, 14183, '2х2,5 Вт', 'ru'),
(64995, 141, 14184, '21', 'ru'),
(64996, 248, 14184, '4:3', 'ru'),
(64997, 250, 14184, '50 Гц', 'ru'),
(64998, 251, 14184, 'Есть', 'ru'),
(64999, 252, 14184, '2 шт', 'ru'),
(65000, 253, 14184, '2х2,5 Вт', 'ru'),
(65001, 141, 14185, '14', 'ru'),
(65002, 248, 14185, '4:3', 'ru'),
(65003, 250, 14185, '50 Гц', 'ru'),
(65004, 251, 14185, 'Есть', 'ru'),
(65005, 252, 14185, '2 шт', 'ru'),
(65006, 253, 14185, '2х3 Вт', 'ru'),
(65007, 141, 14186, '21', 'ru'),
(65008, 248, 14186, '4:3', 'ru'),
(65009, 250, 14186, '50 Гц', 'ru'),
(65010, 251, 14186, 'Есть', 'ru'),
(65011, 252, 14186, '2 шт', 'ru'),
(65012, 253, 14186, '2х3 Вт', 'ru'),
(65013, 141, 14187, '21', 'ru'),
(65014, 248, 14187, '4:3', 'ru'),
(65015, 250, 14187, '50 Гц', 'ru'),
(65016, 251, 14187, 'Есть', 'ru'),
(65017, 252, 14187, '2 шт', 'ru'),
(65018, 253, 14187, '2х3 Вт', 'ru'),
(65019, 203, 8433, 'Ручные', 'ru'),
(65020, 324, 8433, 'Аккумулятор', 'ru'),
(65021, 325, 8433, 'Влагозащищенные', 'ru'),
(65022, 203, 8434, 'Ручные', 'ru'),
(65023, 324, 8434, 'Аккумулятор', 'ru'),
(65024, 325, 8434, 'Влагозащищенные', 'ru'),
(65025, 203, 8435, 'Ручные', 'ru'),
(65026, 324, 8435, 'Аккумулятор', 'ru'),
(65027, 325, 8435, 'Влагозащищенные', 'ru'),
(65028, 203, 8436, 'Ручные', 'ru'),
(65029, 324, 8436, 'Аккумулятор', 'ru'),
(65030, 325, 8436, 'Влагозащищенные', 'ru'),
(65031, 203, 8437, 'Фонари-лампы', 'ru'),
(65032, 324, 8437, 'Аккумулятор', 'ru'),
(65033, 325, 8437, 'Влагозащищенные', 'ru'),
(65034, 203, 8438, 'Налобные', 'ru'),
(65035, 324, 8438, 'Батарейки', 'ru'),
(65036, 325, 8438, 'Влагозащищенные', 'ru'),
(65037, 203, 8439, 'Налобные', 'ru'),
(65038, 324, 8439, 'Батарейки', 'ru'),
(65039, 325, 8439, 'Влагозащищенные', 'ru'),
(65040, 203, 8440, 'Налобные', 'ru'),
(65041, 324, 8440, 'Батарейки', 'ru'),
(65042, 325, 8440, 'Влагозащищенные', 'ru'),
(65043, 203, 8441, 'Налобные', 'ru'),
(65044, 324, 8441, 'Батарейки', 'ru'),
(65045, 325, 8441, 'Влагозащищенные', 'ru'),
(65046, 203, 8442, 'Налобные', 'ru'),
(65047, 324, 8442, 'Батарейки', 'ru'),
(65048, 325, 8442, 'Влагозащищенные', 'ru'),
(65049, 203, 8443, 'Налобные', 'ru'),
(65050, 324, 8443, 'Батарейки', 'ru'),
(65051, 325, 8443, 'Влагозащищенные', 'ru'),
(65052, 203, 8444, 'Налобные', 'ru'),
(65053, 324, 8444, 'Батарейки', 'ru'),
(65054, 325, 8444, 'Влагозащищенные', 'ru'),
(65084, 251, 989, 'Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio', 'ru'),
(65083, 250, 989, '400 Гц', 'ru'),
(65097, 203, 8445, 'Фонари-лампы', 'ru'),
(65098, 324, 8445, 'Аккумулятор', 'ru'),
(65099, 325, 8445, 'Нет', 'ru'),
(65100, 203, 8446, 'Фонари-лампы', 'ru'),
(65101, 324, 8446, 'Батарейки', 'ru'),
(65102, 325, 8446, 'Нет', 'ru'),
(85082, 358, 14775, 'от 1 до 1,5 м', 'ru'),
(85083, 359, 14775, 'от 30 до 90 Ом', 'ru'),
(73143, 333, 14775, '5&quot;', 'ru'),
(73144, 337, 14775, 'FM-трансмиттер', 'ru'),
(73145, 335, 14775, 'Есть', 'ru'),
(73146, 336, 14775, '128 МБ', 'ru'),
(73147, 334, 14775, '2 ч', 'ru'),
(85084, 360, 14775, 'от 100 до 120 дБ', 'ru'),
(73870, 233, 14779, 'от 3 до 5 лет', 'ru'),
(73871, 328, 14779, 'Союзмультфильм', 'ru'),
(73872, 204, 14779, '100 см', 'ru'),
(73873, 233, 14780, 'от 3 до 5 лет', 'ru'),
(73874, 328, 14780, 'Союзмультфильм', 'ru'),
(73875, 204, 14780, '70 см', 'ru'),
(73876, 233, 14781, 'от 0 до 1 года', 'ru'),
(73877, 204, 14781, '18 см', 'ru'),
(73878, 233, 14782, 'от 0 до 1 года', 'ru'),
(73879, 204, 14782, '28 см', 'ru'),
(73880, 233, 14783, 'от 0 до 1 года', 'ru'),
(73881, 204, 14783, '23 см', 'ru'),
(73882, 233, 14784, 'от 0 до 1 года', 'ru'),
(73883, 204, 14784, '30 см', 'ru'),
(73884, 233, 14785, 'от 0 до 1 года', 'ru'),
(73885, 204, 14785, '52 см', 'ru'),
(73886, 233, 14786, 'от 0 до 1 года', 'ru'),
(73887, 204, 14786, '18 см', 'ru'),
(73888, 233, 14787, 'от 0 до 1 года', 'ru'),
(73889, 204, 14787, '24 см', 'ru'),
(73890, 233, 14788, 'от 0 до 1 года', 'ru'),
(73891, 204, 14788, '20 см', 'ru'),
(73892, 233, 14789, 'от 0 до 1 года', 'ru'),
(73893, 204, 14789, '24 см', 'ru'),
(73894, 233, 14790, 'от 3 до 5 лет', 'ru'),
(73895, 204, 14790, '27 см', 'ru'),
(73896, 233, 14791, 'от 3 до 5 лет', 'ru'),
(73897, 328, 14791, 'Маша и Медведь', 'ru'),
(73898, 204, 14791, '22 см', 'ru'),
(73899, 233, 14792, 'от 3 до 5 лет', 'ru'),
(73900, 328, 14792, 'Маша и Медведь', 'ru'),
(73901, 204, 14792, '25 см', 'ru'),
(73902, 233, 14793, 'от 3 до 5 лет', 'ru'),
(73903, 328, 14793, 'Барбоскины', 'ru'),
(73904, 204, 14793, '23 см', 'ru'),
(73905, 233, 14794, 'от 3 до 5 лет', 'ru'),
(73906, 328, 14794, 'Viacom', 'ru'),
(73907, 204, 14794, '14 см', 'ru'),
(73908, 233, 14795, 'от 3 до 5 лет', 'ru'),
(73909, 204, 14795, '20 см', 'ru'),
(73910, 233, 14796, 'от 3 до 5 лет', 'ru'),
(73911, 204, 14796, '25 см', 'ru'),
(73912, 233, 14797, 'от 3 до 5 лет', 'ru'),
(73913, 328, 14797, 'Маша и Медведь', 'ru'),
(73914, 204, 14797, '22 см', 'ru'),
(73915, 233, 14798, 'от 3 до 5 лет', 'ru'),
(73916, 328, 14798, 'Маша и Медведь', 'ru'),
(73917, 204, 14798, '28 см', 'ru'),
(74306, 233, 14960, 'от 3 до 5 лет', 'ru'),
(74307, 327, 14960, '1:43', 'ru'),
(74308, 328, 14960, 'FERRARI', 'ru'),
(74309, 233, 14961, 'от 3 до 5 лет', 'ru'),
(74310, 327, 14961, '1:43', 'ru'),
(74311, 328, 14961, 'FERRARI', 'ru'),
(74312, 233, 14962, 'от 7 до 12 лет', 'ru'),
(74313, 327, 14962, '1:24', 'ru'),
(74314, 328, 14962, 'AUDI', 'ru'),
(74315, 233, 14963, 'от 7 до 12 лет', 'ru'),
(74316, 327, 14963, '1:24', 'ru'),
(74317, 328, 14963, 'BMW', 'ru'),
(74318, 233, 14964, 'от 7 до 12 лет', 'ru'),
(74319, 327, 14964, '1:24', 'ru'),
(74320, 328, 14964, 'BMW', 'ru'),
(74321, 233, 14965, 'от 7 до 12 лет', 'ru'),
(74322, 327, 14965, '1:24', 'ru'),
(74323, 328, 14965, 'CITROEN', 'ru'),
(74324, 233, 14966, 'от 7 до 12 лет', 'ru'),
(74325, 327, 14966, '1:24', 'ru'),
(74326, 328, 14966, 'DODGE', 'ru'),
(74327, 233, 14967, 'от 7 до 12 лет', 'ru'),
(74328, 327, 14967, '1:24', 'ru'),
(74329, 328, 14967, 'DODGE', 'ru'),
(74330, 233, 14968, 'от 7 до 12 лет', 'ru'),
(74331, 327, 14968, '1:24', 'ru'),
(74332, 328, 14968, 'JAGUAR', 'ru'),
(74333, 233, 14969, 'от 7 до 12 лет', 'ru'),
(74334, 327, 14969, '1:24', 'ru'),
(74335, 328, 14969, 'LAMBORGHINI', 'ru'),
(74336, 233, 14970, 'от 7 до 12 лет', 'ru'),
(74337, 327, 14970, '1:24', 'ru'),
(74338, 328, 14970, 'LAMBORGHINI', 'ru'),
(74339, 233, 14971, 'от 7 до 12 лет', 'ru'),
(74340, 327, 14971, '1:24', 'ru'),
(74341, 328, 14971, 'LAMBORGHINI', 'ru'),
(74342, 233, 14972, 'от 7 до 12 лет', 'ru'),
(74343, 327, 14972, '1:24', 'ru'),
(74344, 328, 14972, 'LAMBORGHINI', 'ru'),
(74345, 233, 14973, 'от 7 до 12 лет', 'ru'),
(74346, 327, 14973, '1:24', 'ru'),
(74347, 328, 14973, 'LAMBORGHINI', 'ru'),
(74348, 233, 14974, 'от 7 до 12 лет', 'ru'),
(74349, 327, 14974, '1:24', 'ru'),
(74350, 328, 14974, 'LAMBORGHINI', 'ru'),
(74351, 233, 14975, 'от 7 до 12 лет', 'ru'),
(74352, 327, 14975, '1:24', 'ru'),
(74353, 328, 14975, 'MASERATI', 'ru'),
(74354, 233, 14976, 'от 7 до 12 лет', 'ru'),
(74355, 327, 14976, '1:24', 'ru'),
(74356, 328, 14976, 'MERCEDES-BENZ', 'ru'),
(74357, 233, 14977, 'от 7 до 12 лет', 'ru'),
(74358, 327, 14977, '1:24', 'ru'),
(74359, 328, 14977, 'PORSCHE', 'ru'),
(74360, 233, 14978, 'от 7 до 12 лет', 'ru'),
(74361, 327, 14978, '1:24', 'ru'),
(74362, 328, 14978, 'RENAULT', 'ru'),
(74363, 233, 14979, 'от 7 до 12 лет', 'ru'),
(74364, 327, 14979, '1:32', 'ru'),
(74365, 328, 14979, 'ALFA ROMEO', 'ru'),
(74806, 233, 15135, 'от 3 до 5 лет', 'ru'),
(74807, 328, 15135, 'АК-47', 'ru'),
(74808, 204, 15135, '231х358х44 мм', 'ru'),
(74809, 233, 15136, 'от 3 до 5 лет', 'ru'),
(74810, 328, 15136, 'BISON', 'ru'),
(74811, 233, 15137, 'от 3 до 5 лет', 'ru'),
(74812, 328, 15137, 'GUMMY', 'ru'),
(74813, 233, 15138, 'от 3 до 5 лет', 'ru'),
(74814, 328, 15138, 'SUPER DISC', 'ru'),
(74815, 233, 15139, 'от 3 до 5 лет', 'ru'),
(74816, 328, 15139, 'SUPERMATIC', 'ru'),
(74817, 233, 15140, 'от 3 до 5 лет', 'ru'),
(74818, 328, 15140, 'UZI', 'ru'),
(74819, 204, 15140, '50 см', 'ru'),
(74820, 233, 15141, 'от 3 до 5 лет', 'ru'),
(74821, 328, 15141, 'FBI FEDERAL', 'ru'),
(74822, 204, 15141, '12 см', 'ru'),
(74823, 233, 15142, 'от 3 до 5 лет', 'ru'),
(74824, 328, 15142, 'LARAMY', 'ru'),
(74825, 204, 15142, '20 см', 'ru');
INSERT INTO `shop_product_properties_data` (`id`, `property_id`, `product_id`, `value`, `locale`) VALUES
(74826, 233, 15143, 'от 3 до 5 лет', 'ru'),
(74827, 328, 15143, 'STERLING ANTIK', 'ru'),
(74828, 204, 15143, '17 см', 'ru'),
(74829, 233, 15144, 'от 3 до 5 лет', 'ru'),
(74830, 328, 15144, 'JENNY', 'ru'),
(74831, 204, 15144, '21 см', 'ru'),
(74832, 233, 15145, 'от 3 до 5 лет', 'ru'),
(74833, 328, 15145, 'SUSY', 'ru'),
(74834, 204, 15145, '18 см', 'ru'),
(74835, 233, 15146, 'от 3 до 5 лет', 'ru'),
(74836, 328, 15146, 'КИТТИ', 'ru'),
(74837, 204, 15146, '18 см', 'ru'),
(74838, 233, 15147, 'от 3 до 5 лет', 'ru'),
(74839, 328, 15147, 'COBRA', 'ru'),
(74840, 204, 15147, '11 см', 'ru'),
(74841, 233, 15148, 'от 3 до 5 лет', 'ru'),
(74842, 328, 15148, 'JEFF WATSON', 'ru'),
(74843, 204, 15148, '19 см', 'ru'),
(74844, 233, 15149, 'от 3 до 5 лет', 'ru'),
(74845, 328, 15149, 'KIT STONE', 'ru'),
(74846, 204, 15149, '22 см', 'ru'),
(74847, 233, 15150, 'от 3 до 5 лет', 'ru'),
(74848, 328, 15150, 'MULTI TARGET', 'ru'),
(74849, 204, 15150, '22 см', 'ru'),
(74850, 233, 15151, 'от 3 до 5 лет', 'ru'),
(74851, 328, 15151, 'SUPER TARGET', 'ru'),
(74852, 204, 15151, '19 см', 'ru'),
(74853, 233, 15152, 'от 3 до 5 лет', 'ru'),
(74854, 328, 15152, 'Маша и Медведь', 'ru'),
(74855, 204, 15152, '24 см', 'ru'),
(74856, 233, 15153, 'от 3 до 5 лет', 'ru'),
(74857, 328, 15153, 'Маша и Медведь', 'ru'),
(74858, 204, 15153, '25 см', 'ru'),
(74859, 233, 15154, 'от 3 до 5 лет', 'ru'),
(74860, 328, 15154, 'Маша и Медведь', 'ru'),
(74861, 204, 15154, '26 см', 'ru'),
(74862, 233, 15155, 'от 3 до 5 лет', 'ru'),
(74863, 233, 15156, 'от 3 до 5 лет', 'ru'),
(74864, 233, 15157, 'от 3 до 5 лет', 'ru'),
(74865, 233, 15158, 'от 3 до 5 лет', 'ru'),
(74866, 328, 15158, 'CHOU CHOU ', 'ru'),
(74867, 204, 15158, '36 см', 'ru'),
(74868, 233, 15159, 'от 3 до 5 лет', 'ru'),
(74869, 328, 15159, 'MY FIRST BABY ANNABELL', 'ru'),
(74870, 204, 15159, '36 см', 'ru'),
(74871, 233, 15160, 'от 3 до 5 лет', 'ru'),
(74872, 233, 15161, 'от 3 до 5 лет', 'ru'),
(74873, 233, 15162, 'от 3 до 5 лет', 'ru'),
(74874, 233, 15163, 'от 3 до 5 лет', 'ru'),
(74875, 233, 15164, 'от 3 до 5 лет', 'ru'),
(74876, 233, 15165, 'от 3 до 5 лет', 'ru'),
(74877, 233, 15166, 'от 3 до 5 лет', 'ru'),
(74878, 233, 15167, 'от 3 до 5 лет', 'ru'),
(74879, 233, 15168, 'от 3 до 5 лет', 'ru'),
(74880, 233, 15169, 'от 3 до 5 лет', 'ru'),
(74881, 233, 15170, 'от 3 до 5 лет', 'ru'),
(74882, 233, 15171, 'от 3 до 5 лет', 'ru'),
(75505, 233, 15485, 'от 3 до 5 лет', 'ru'),
(75506, 328, 15485, 'ПЕРЕВОРОТ', 'ru'),
(75507, 233, 15486, 'от 3 до 5 лет', 'ru'),
(75508, 328, 15486, 'ПЕРЕВОРОТ', 'ru'),
(75509, 233, 15487, 'от 3 до 5 лет', 'ru'),
(75510, 328, 15487, 'ПЕРЕВОРОТ', 'ru'),
(75511, 233, 15488, 'от 3 до 5 лет', 'ru'),
(75512, 328, 15488, 'ПЕРЕВОРОТ', 'ru'),
(75513, 233, 15489, 'от 3 до 5 лет', 'ru'),
(75514, 328, 15489, 'СУПЕРПЕРЕВОРОТ', 'ru'),
(75515, 233, 15490, 'от 3 до 5 лет', 'ru'),
(75516, 328, 15490, 'СУПЕРПЕРЕВОРОТ', 'ru'),
(75517, 233, 15491, 'от 3 до 5 лет', 'ru'),
(75518, 328, 15491, 'СУПЕРПЕРЕВОРОТ', 'ru'),
(75519, 233, 15492, 'от 3 до 5 лет', 'ru'),
(75520, 328, 15492, 'СУПЕРПЕРЕВОРОТ', 'ru'),
(75521, 233, 15493, 'от 3 до 5 лет', 'ru'),
(75522, 328, 15493, 'ТУРБОПЕРЕВОРОТ', 'ru'),
(75523, 233, 15494, 'от 3 до 5 лет', 'ru'),
(75524, 328, 15494, 'ТУРБОПЕРЕВОРОТ', 'ru'),
(75525, 233, 15495, 'от 3 до 5 лет', 'ru'),
(75526, 328, 15495, 'ТУРБОПЕРЕВОРОТ', 'ru'),
(75527, 233, 15496, 'от 3 до 5 лет', 'ru'),
(75528, 328, 15496, 'ТУРБОПЕРЕВОРОТ', 'ru'),
(75529, 233, 15497, 'от 3 до 5 лет', 'ru'),
(75530, 233, 15498, 'от 3 до 5 лет', 'ru'),
(75531, 233, 15499, 'от 3 до 5 лет', 'ru'),
(75649, 233, 15556, 'от 1 до 2 лет', 'ru'),
(75650, 233, 15557, 'от 1 до 2 лет', 'ru'),
(75651, 204, 15557, '53х53 см', 'ru'),
(75652, 233, 15558, 'от 1 до 2 лет', 'ru'),
(75653, 204, 15558, '80х80 см', 'ru'),
(75654, 233, 15559, 'от 1 до 2 лет', 'ru'),
(75655, 233, 15560, 'от 3 до 5 лет', 'ru'),
(75656, 233, 15561, 'от 3 до 5 лет', 'ru'),
(75657, 328, 15561, 'TECNO', 'ru'),
(75658, 204, 15561, '28х20 см', 'ru'),
(75659, 233, 15562, 'от 3 до 5 лет', 'ru'),
(75660, 233, 15563, 'от 3 до 5 лет', 'ru'),
(75661, 233, 15564, 'от 3 до 5 лет', 'ru'),
(75662, 233, 15565, 'от 3 до 5 лет', 'ru'),
(75663, 233, 15566, 'от 5 до 7 лет', 'ru'),
(75664, 233, 15567, 'от 1 до 2 лет', 'ru'),
(75665, 233, 15568, 'от 1 до 2 лет', 'ru'),
(75666, 233, 15569, 'от 1 до 2 лет', 'ru'),
(75667, 233, 15570, 'от 1 до 2 лет', 'ru'),
(75668, 204, 15570, '27х23 см', 'ru'),
(75669, 233, 15571, 'от 1 до 2 лет', 'ru'),
(75670, 328, 15571, 'БЕБИ', 'ru'),
(75671, 233, 15572, 'от 1 до 2 лет', 'ru'),
(75672, 328, 15572, 'БЕБИ', 'ru'),
(75673, 233, 15573, 'от 3 до 5 лет', 'ru'),
(75674, 204, 15573, '22х16 см', 'ru'),
(75675, 233, 15574, 'от 3 до 5 лет', 'ru'),
(75986, 233, 15742, 'от 0 до 1 года', 'ru'),
(75987, 204, 15742, '33х22х21', 'ru'),
(75988, 233, 15743, 'от 1 до 2 лет', 'ru'),
(75989, 204, 15743, '24,3х21,6х22,3', 'ru'),
(75990, 233, 15744, 'от 1 до 2 лет', 'ru'),
(75991, 204, 15744, '20,3х20,3х18', 'ru'),
(75992, 233, 15745, 'от 2 до 3 лет', 'ru'),
(75993, 204, 15745, '40х35х13,3', 'ru'),
(75994, 233, 15746, 'от 2 до 3 лет', 'ru'),
(75995, 204, 15746, '19х19х24,1', 'ru'),
(75996, 233, 15747, 'от 2 до 3 лет', 'ru'),
(75997, 204, 15747, '19х19х24,1', 'ru'),
(75998, 233, 15748, 'от 2 до 3 лет', 'ru'),
(75999, 204, 15748, '50,80х12,7х25,40', 'ru'),
(76000, 233, 15749, 'от 2 до 3 лет', 'ru'),
(76001, 204, 15749, '24,15х9,55х45,7', 'ru'),
(76002, 233, 15750, 'от 3 до 5 лет', 'ru'),
(76003, 204, 15750, '38х25х8 см', 'ru'),
(76004, 233, 15751, 'от 3 до 5 лет', 'ru'),
(76005, 204, 15751, '15,25х15,25х12,7', 'ru'),
(76006, 233, 15752, 'от 0 до 1 года', 'ru'),
(76007, 204, 15752, '21х7х26,5', 'ru'),
(76008, 233, 15753, 'от 1 до 2 лет', 'ru'),
(76009, 204, 15753, '45х14х13', 'ru'),
(76010, 233, 15754, 'от 0 до 1 года', 'ru'),
(76011, 204, 15754, '12,7х12,7х22,86', 'ru'),
(76012, 233, 15755, 'от 1 до 2 лет', 'ru'),
(76013, 204, 15755, '20 см', 'ru'),
(76014, 233, 15756, 'от 1 до 2 лет', 'ru'),
(76015, 204, 15756, '20 см', 'ru'),
(76016, 233, 15757, 'от 1 до 2 лет', 'ru'),
(76017, 204, 15757, '25х14 см', 'ru'),
(76018, 233, 15758, 'от 0 до 1 года', 'ru'),
(76019, 204, 15758, '16,5х18,15х17,8', 'ru'),
(76020, 233, 15759, 'от 1 до 2 лет', 'ru'),
(76021, 204, 15759, '15,2х15,2х18', 'ru'),
(76022, 233, 15760, 'от 1 до 2 лет', 'ru'),
(76023, 204, 15760, '31х9х30,5 см', 'ru'),
(76024, 233, 15761, 'от 0 до 1 года', 'ru'),
(76025, 204, 15761, '37х9,5х22 см', 'ru'),
(76809, 253, 13278, '2х10 Вт', 'ru'),
(76810, 247, 13278, '1024x768', 'ru'),
(76811, 246, 13278, '42', 'ru'),
(82907, 273, 16424, 'Blu-Ray плеер', 'ru'),
(82908, 272, 16424, 'Есть', 'ru'),
(82909, 276, 16424, 'есть', 'ru'),
(82910, 273, 16425, 'Blu-Ray плеер', 'ru'),
(82911, 272, 16425, 'Есть', 'ru'),
(82912, 276, 16425, 'есть', 'ru'),
(82913, 273, 16426, 'Blu-Ray плеер', 'ru'),
(82914, 272, 16426, 'Есть', 'ru'),
(82915, 276, 16426, 'есть', 'ru'),
(82916, 273, 16427, 'Blu-Ray плеер', 'ru'),
(82917, 272, 16427, 'Есть', 'ru'),
(82918, 276, 16427, 'есть', 'ru'),
(82919, 273, 16428, 'Blu-Ray плеер', 'ru'),
(82920, 272, 16428, 'Есть', 'ru'),
(82921, 276, 16428, 'Нет', 'ru'),
(82922, 273, 16429, 'Blu-Ray плеер', 'ru'),
(82923, 272, 16429, 'Есть', 'ru'),
(82924, 276, 16429, 'есть', 'ru'),
(82925, 273, 16430, 'Blu-Ray плеер', 'ru'),
(82926, 272, 16430, 'Есть', 'ru'),
(82927, 276, 16430, 'есть', 'ru'),
(82928, 273, 16431, 'Blu-Ray плеер', 'ru'),
(82929, 272, 16431, 'Есть', 'ru'),
(82930, 276, 16431, 'есть', 'ru'),
(82931, 273, 16432, 'Blu-Ray плеер', 'ru'),
(82932, 272, 16432, 'Есть', 'ru'),
(82933, 276, 16432, 'есть', 'ru'),
(82934, 273, 16433, 'DVD плеер', 'ru'),
(82935, 272, 16433, 'Есть', 'ru'),
(82936, 276, 16433, 'есть', 'ru'),
(82937, 273, 16434, 'DVD плеер', 'ru'),
(82938, 272, 16434, 'Есть', 'ru'),
(82939, 276, 16434, 'есть', 'ru'),
(82940, 273, 16435, 'Blu-Ray плеер', 'ru'),
(82941, 272, 16435, 'Есть', 'ru'),
(82942, 276, 16435, 'есть', 'ru'),
(82943, 273, 16436, 'Blu-Ray плеер', 'ru'),
(82944, 272, 16436, 'Есть', 'ru'),
(82945, 276, 16436, 'есть', 'ru'),
(82946, 273, 16437, 'DVD плеер', 'ru'),
(82947, 272, 16437, 'Есть', 'ru'),
(82948, 276, 16437, 'есть', 'ru'),
(82949, 273, 16438, 'DVD плеер', 'ru'),
(82950, 272, 16438, 'Есть', 'ru'),
(82951, 276, 16438, 'есть', 'ru'),
(82952, 273, 16439, 'DVD плеер', 'ru'),
(82953, 272, 16439, 'Есть', 'ru'),
(82954, 276, 16439, 'есть', 'ru'),
(82955, 273, 16440, 'DVD плеер', 'ru'),
(82956, 272, 16440, 'Есть', 'ru'),
(82957, 276, 16440, 'есть', 'ru'),
(82958, 273, 16441, 'DVD плеер', 'ru'),
(82959, 272, 16441, 'Нет', 'ru'),
(82960, 276, 16441, 'есть', 'ru'),
(82961, 273, 16442, 'DVD плеер', 'ru'),
(82962, 272, 16442, 'Есть', 'ru'),
(82963, 276, 16442, 'есть', 'ru'),
(82964, 273, 16443, 'Blu-Ray плеер', 'ru'),
(82965, 272, 16443, 'Есть', 'ru'),
(82966, 276, 16443, 'Нет', 'ru'),
(82967, 273, 16444, 'DVD плеер', 'ru'),
(82968, 272, 16444, 'Есть', 'ru'),
(82969, 276, 16444, 'есть', 'ru'),
(82970, 273, 16445, 'DVD плеер', 'ru'),
(82971, 272, 16445, 'Есть', 'ru'),
(82972, 276, 16445, 'Нет', 'ru'),
(82973, 273, 16446, 'DVD плеер', 'ru'),
(82974, 272, 16446, 'Есть', 'ru'),
(82975, 276, 16446, 'есть', 'ru'),
(82976, 273, 16447, 'Blu-Ray плеер', 'ru'),
(82977, 272, 16447, 'Есть', 'ru'),
(82978, 276, 16447, 'есть', 'ru'),
(82979, 273, 16448, 'Blu-Ray плеер', 'ru'),
(82980, 272, 16448, 'Есть', 'ru'),
(82981, 276, 16448, 'есть', 'ru'),
(82982, 273, 16449, 'Blu-Ray плеер', 'ru'),
(82983, 272, 16449, 'Есть', 'ru'),
(82984, 276, 16449, 'есть', 'ru'),
(82985, 273, 16450, 'Blu-Ray плеер', 'ru'),
(82986, 272, 16450, 'Есть', 'ru'),
(82987, 276, 16450, 'Нет', 'ru'),
(82988, 273, 16451, 'DVD плеер', 'ru'),
(82989, 272, 16451, 'Есть', 'ru'),
(82990, 276, 16451, 'Нет', 'ru'),
(82991, 273, 16452, 'DVD плеер', 'ru'),
(82992, 272, 16452, 'Есть', 'ru'),
(82993, 276, 16452, 'есть', 'ru'),
(82994, 273, 16453, 'DVD плеер', 'ru'),
(82995, 272, 16453, 'Есть', 'ru'),
(82996, 276, 16453, 'есть', 'ru'),
(82997, 273, 16454, 'DVD плеер', 'ru'),
(82998, 272, 16454, 'Есть', 'ru'),
(82999, 276, 16454, 'есть', 'ru'),
(83000, 273, 16455, 'DVD плеер', 'ru'),
(83001, 272, 16455, 'Есть', 'ru'),
(83002, 276, 16455, 'есть', 'ru'),
(83003, 273, 16456, 'Blu-Ray плеер', 'ru'),
(83004, 272, 16456, 'Есть', 'ru'),
(83005, 276, 16456, 'Нет', 'ru'),
(83006, 273, 16457, 'DVD плеер', 'ru'),
(83007, 272, 16457, 'Есть', 'ru'),
(83008, 276, 16457, 'есть', 'ru'),
(83009, 273, 16458, 'Blu-Ray плеер', 'ru'),
(83010, 272, 16458, 'Есть', 'ru'),
(83011, 276, 16458, 'есть', 'ru'),
(83012, 272, 16459, 'Есть', 'ru'),
(83013, 276, 16459, 'есть', 'ru'),
(83014, 273, 16460, 'Blu-Ray плеер', 'ru'),
(83015, 272, 16460, 'Есть', 'ru'),
(83016, 276, 16460, 'есть', 'ru'),
(83017, 273, 16461, 'DVD плеер', 'ru'),
(83018, 272, 16461, 'Есть', 'ru'),
(83019, 276, 16461, 'есть', 'ru'),
(83020, 273, 16462, 'DVD плеер', 'ru'),
(83021, 272, 16462, 'Есть', 'ru'),
(83022, 276, 16462, 'есть', 'ru'),
(85085, 358, 16825, 'от 1 до 1,5 м', 'ru'),
(85086, 359, 16825, 'от 30 до 90 Ом', 'ru'),
(85087, 360, 16825, 'от 100 до 120 дБ', 'ru'),
(85088, 358, 16826, 'от 1 до 1,5 м', 'ru'),
(85089, 359, 16826, 'от 30 до 90 Ом', 'ru'),
(85090, 360, 16826, 'до 100 дБ', 'ru'),
(85091, 358, 16827, 'от 1 до 1,5 м', 'ru'),
(85092, 359, 16827, 'от 30 до 90 Ом', 'ru'),
(85093, 360, 16827, 'до 100 дБ', 'ru'),
(85094, 358, 16828, 'от 1 до 1,5 м', 'ru'),
(85095, 359, 16828, 'от 30 до 90 Ом', 'ru'),
(85096, 360, 16828, 'до 100 дБ', 'ru'),
(85097, 358, 16829, 'от 1 до 1,5 м', 'ru'),
(85098, 359, 16829, 'от 15 до 30 Ом', 'ru'),
(85099, 360, 16829, 'от 100 до 120 дБ', 'ru'),
(85100, 358, 16830, 'от 2 до 3,5 м', 'ru'),
(85101, 359, 16830, 'от 30 до 90 Ом', 'ru'),
(85102, 360, 16830, 'от 100 до 120 дБ', 'ru'),
(85103, 358, 16831, 'от 2 до 3,5 м', 'ru'),
(85104, 359, 16831, 'от 30 до 90 Ом', 'ru'),
(85105, 360, 16831, 'от 100 до 120 дБ', 'ru'),
(85106, 358, 16833, 'от 1 до 1,5 м', 'ru'),
(85107, 359, 16833, 'от 15 до 30 Ом', 'ru'),
(85108, 360, 16833, 'от 120 дБ', 'ru'),
(85109, 358, 16834, 'от 1 до 1,5 м', 'ru'),
(85110, 360, 16834, 'от 100 до 120 дБ', 'ru'),
(85111, 358, 16835, 'от 1 до 1,5 м', 'ru'),
(85112, 360, 16835, 'от 100 до 120 дБ', 'ru'),
(85113, 358, 16836, 'от 1 до 1,5 м', 'ru'),
(85114, 359, 16836, 'от 30 до 90 Ом', 'ru'),
(85115, 360, 16836, 'от 100 до 120 дБ', 'ru'),
(85285, 358, 10180, 'от 1 до 1,5 м', 'ru'),
(85286, 359, 10180, 'от 30 до 90 Ом', 'ru'),
(85287, 360, 10180, 'от 100 до 120 дБ', 'ru'),
(85363, 358, 10183, 'от 1 до 1,5 м', 'ru'),
(85364, 359, 10183, 'от 15 до 30 Ом', 'ru'),
(85365, 360, 10183, 'до 100 дБ', 'ru'),
(86142, 310, 12045, 'от 1500 до 2000 mAh', 'ru'),
(86146, 135, 12045, 'от 1 до 1.5 GHz', 'ru'),
(86180, 142, 1104, '', 'ru'),
(86181, 70, 1104, '', 'ru'),
(86183, 42, 1104, '', 'ru'),
(86185, 93, 1104, '', 'ru'),
(86187, 134, 1104, '', 'ru'),
(86189, 137, 1104, '', 'ru'),
(86190, 50, 1104, '', 'ru'),
(86191, 90, 1104, '', 'ru'),
(86192, 92, 1104, '', 'ru'),
(86193, 39, 1104, '', 'ru'),
(86194, 141, 1105, '', 'ru'),
(86195, 310, 1105, '', 'ru'),
(86196, 142, 1105, '', 'ru'),
(86197, 70, 1105, '', 'ru'),
(86198, 41, 1105, '', 'ru'),
(86199, 42, 1105, '', 'ru'),
(86200, 139, 1105, '', 'ru'),
(86201, 93, 1105, '', 'ru'),
(86202, 122, 1105, '', 'ru'),
(86203, 134, 1105, '', 'ru'),
(86204, 135, 1105, '', 'ru'),
(86205, 137, 1105, '', 'ru'),
(86206, 50, 1105, '', 'ru'),
(86207, 90, 1105, '', 'ru'),
(86208, 92, 1105, '', 'ru'),
(86209, 39, 1105, '', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_data_i18n`
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
-- Table structure for table `shop_product_properties_i18n`
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
-- Dumping data for table `shop_product_properties_i18n`
--

INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`, `data`, `description`) VALUES
(26, 'Количество мегапикселей', 'ru', 'a:6:{i:0;s:5:"3 Mп";i:1;s:6:"5 Мп";i:2;s:6:"8 Мп";i:3;s:7:"10 Мп";i:4;s:7:"12 Мп";i:5;s:7:"15 Мп";}', NULL),
(25, 'Настройка фокуса', 'ru', 'a:2:{i:0;s:4:"Да";i:1;s:6:"Нет";}', NULL),
(24, 'Количество цифровых входов', 'ru', 'a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}', NULL),
(23, 'Мощность', 'ru', 'a:5:{i:0;s:7:"40 Вт";i:1;s:7:"50 Вт";i:2;s:7:"80 Вт";i:3;s:8:"100 Вт";i:4;s:9:"1500 Вт";}', NULL),
(22, 'HDMI', 'ru', 'a:5:{i:0;s:6:"Нет";i:1;s:3:"1х";i:2;s:3:"2х";i:3;s:2:"3x";i:4;s:2:"4x";}', NULL),
(121, 'Габариты (ШxВxГ):', 'ru', '', NULL),
(122, 'Камера', 'ru', 'a:11:{i:0;s:5:"2 Mpx";i:1;s:5:"3 Mpx";i:2;s:5:"4 Mpx";i:3;s:5:"5 Mpx";i:4;s:5:"8 Mpx";i:5;s:6:"10 Mpx";i:6;s:7:"3,2 Mpx";i:7;s:6:"13 Mpx";i:8;s:6:"14 Mpx";i:9;s:6:"kamera";i:10;s:7:"3.2 Mpx";}', NULL),
(20, 'Технология дисплея', 'ru', 'a:3:{i:0;s:3:"LED";i:1;s:3:"LCD";i:2;s:6:"Plasma";}', NULL),
(20, 'Технологія дисплею', 'ua', 'a:4:{i:0;s:6:"LED-ua";i:1;s:9:"Plasma-ua";i:2;s:9:"Litium-ua";i:3;s:8:"Freon-ua";}', NULL),
(20, 'Display Technology', 'en', '', NULL),
(22, 'HDMI', 'en', 'a:2:{i:0;s:3:"Yes";i:1;s:2:"No";}', NULL),
(23, 'Power', 'en', '', NULL),
(24, 'Number of digital inputs', 'en', '', NULL),
(25, 'Setting the focus', 'en', '', NULL),
(26, 'The number of megapixels', 'en', '', NULL),
(28, 'Аудио форматы ', 'ru', 'a:10:{i:0;s:3:"MP3";i:1;s:3:"MPA";i:2;s:3:"M4A";i:3;s:3:"WMA";i:4;s:4:"FLAC";i:5;s:3:"WAV";i:6;s:7:"DTS-WAV";i:7;s:3:"DTS";i:8;s:3:"AC3";i:9;s:3:"AAC";}', NULL),
(93, 'GPS-модуль', 'ru', 'a:1:{i:0;s:16:"GPS-модуль";}', NULL),
(31, 'Объем оперативной памяти', 'ru', 'a:6:{i:0;s:8:"256 Мб";i:1;s:8:"512 Мб";i:2;s:6:"1 Гб";i:3;s:6:"2 Гб";i:4;s:6:"4 Гб";i:5;s:6:"8 Гб";}', NULL),
(34, 'Органайзер', 'ru', 'a:6:{i:0;s:18:"Календарь";i:1;s:8:"Часы";i:2;s:16:"Диктофон";i:3;s:18:"Будильник";i:4;s:22:"Калькулятор";i:5;s:14:"Заметки";}', NULL),
(35, 'Технология печати', 'ru', 'a:3:{i:0;s:29:"Струйная печать";i:1;s:29:"Лазерная печать";i:2;s:46:"Лазерная печать (цветная)";}', NULL),
(36, 'Формат бумаги', 'ru', 'a:5:{i:0;s:2:"A1";i:1;s:2:"A2";i:2;s:2:"A3";i:3;s:2:"A4";i:4;s:2:"A5";}', NULL),
(37, 'Сетевые интерфейсы', 'ru', 'a:3:{i:0;s:5:"Wi-Fi";i:1;s:8:"Ethernet";i:2;s:9:"Bluetooth";}', NULL),
(39, 'Материал корпуса', 'ru', 'a:4:{i:0;s:14:"Пластик";i:1;s:12:"Дерево";i:2;s:10:"Метал";i:3;s:27:"Пластик + Метал";}', NULL),
(41, 'Поддержка нескольких sim-карт', 'ru', 'a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:12:"multysimcard";}', NULL),
(42, 'Тип корпуса', 'ru', 'a:79:{i:0;s:16:"Моноблок";i:1;s:20:"Раскладной";i:2;s:14:"Слайдер";i:3;s:9:"С QWERTY";i:4;s:9:"corpstype";i:5;s:35:"купить Чехол HTC HC V841";i:6;s:68:"купить Чехол Samsung EF-C1A2WLECSTD I9100 Flip White/Lime";i:7;s:70:"купить Чехол Samsung EF-C1A2WOECSTD I9100 Flip White/Orange";i:8;s:69:"купит Чехол-книжка Samsung EF-FI908BWEGWW I9082 White";i:9;s:78:"купит Чехол-книжка Samsung EFC-1G6RREGSER I9300 Red (La Fleur)";i:10;s:51:"купит 2 чехла Samsung EFC-1G6SBECSTD Blue";i:11;s:59:"купит Чехол Acme Made Slick Case iPad Matte Black";i:12;s:57:"купит Чехол Lowepro S&amp;F Phone Case 20 Black";i:13;s:55:"купит Чехол Samsung EF-C1A2WGECSTD White/Gray";i:14;s:66:"купит Чехол Samsung EF-FI908BLEGWW Blue I9082 book-cover";i:15;s:50:"купит Чехол Samsung EFC-1B1LCECSTD Camel";i:16;s:50:"купит Чехол Samsung EFC-1E1LBECSTD Black";i:17;s:50:"купит Чехол Samsung EFC-1E1LDECSTD Brown";i:18;s:67:"купит Чехол Samsung EFC-1G5LDECSTD P3100/P3110 Dark Brown";i:19;s:55:"купит Чехол Samsung EFC-1G6LBECSTD I9300 Navy";i:20;s:65:"купит Чехол Samsung EFC-1G6LCECSTD I9300 Chestnut Brown";i:21;s:61:"купит Чехол Samsung EFC-1G6LDECSTD I9300 Dark Brown";i:22;s:55:"купит Чехол Samsung EFC-1G6PLECSTD Light Blue";i:23;s:55:"купит Чехол Samsung EFC-1G6PMECSTD I9300 Mint";i:24;s:55:"купит Чехол Samsung EFC-1G6PPECSTD I9300 Pink";i:25;s:56:"купит Чехол Samsung EFC-1G6SWECSTD I9300 White";i:26;s:49:"купит Чехол Samsung EFC-1G6WBECSTD Blue";i:27;s:55:"купит Чехол Samsung EFC-1G6WPECSTD I9300 Pink";i:28;s:50:"купит Чехол Samsung EFC-1G6WWECSTD White";i:29;s:56:"купит Чехол Samsung EFC-1H8NGECSTD P5100/P5110";i:30;s:56:"купит Чехол Samsung EFC-1J9BBEGSTD N7100 Black";i:31;s:55:"купит Чехол Samsung EFC-1J9BPEGSTD N7100 Pink";i:32;s:56:"купит Чехол Samsung EFC-1J9BWEGSTD N7100 White";i:33;s:69:"купит Чехол-книжка Samsung EFC-1G2NAECSTD Amber Brown";i:34;s:67:"купит Чехол-книжка Samsung EFC-1G2NGECSTD Dark Gray";i:35;s:68:"купит Чехол-книжка Samsung EFC-1G2NLECSTD Light Blue";i:36;s:68:"купит Чехол-книжка Samsung EFC-1G2NRECSTD Garnet Red";i:37;s:75:"купит Чехол-книжка Samsung EFC-1G5NGECSTD P3100/P3110 Black";i:38;s:79:"купит Чехол-книжка Samsung EFC-1G5SGECSTD P3100/P3110 Dark Gray";i:39;s:75:"купит Чехол-книжка Samsung EFC-1G6FBECSTD I9300 Pebble Blue";i:40;s:79:"купит Чехол-книжка Samsung EFC-1G6FGECSTD I9300 Titanium Silver";i:41;s:74:"купит Чехол-книжка Samsung EFC-1G6FLECSTD I9300 Light Blue";i:42;s:68:"купит Чехол-книжка Samsung EFC-1G6FPECSTD I9300 Pink";i:43;s:74:"купит Чехол-книжка Samsung EFC-1G6FRECSTD I9300 Garnet Red";i:44;s:77:"купит Чехол-книжка Samsung EFC-1G6FSECSTD I9300 Metallic Gray";i:45;s:76:"купит Чехол-книжка Samsung EFC-1G6FWECSTD I9300 Marble White";i:46;s:69:"купит Чехол-книжка Samsung EFC-1H8SAECSTD Amber Brown";i:47;s:79:"купит Чехол-книжка Samsung EFC-1H8SGECSTD P5100/P5110 Dark Gray";i:48;s:80:"купит Чехол-книжка Samsung EFC-1H8SLECSTD P5100/P5110 Light Blue";i:49;s:74:"купит Чехол-книжка Samsung EFC-1H8SMECSTD P5100/P5110 Mint";i:50;s:76:"купит Чехол-книжка Samsung EFC-1H8SOECSTD P5100/P5110 Orange";i:51;s:80:"купит Чехол-книжка Samsung EFC-1H8SPECSTD P5100/P5110 Berry Pink";i:52;s:80:"купит Чехол-книжка Samsung EFC-1H8SRECSTD P5100/P5110 Garnet Red";i:53;s:75:"купит Чехол-книжка Samsung EFC-1H8SWECSTD P5100/P5110 White";i:54;s:68:"купит Чехол-книжка Samsung EFC-1J9FBEGSTD N7100 Blue";i:55;s:74:"купит Чехол-книжка Samsung EFC-1J9FLEGSTD N7100 Lime Green";i:56;s:68:"купит Чехол-книжка Samsung EFC-1J9FMEGSTD N7100 Mint";i:57;s:70:"купит Чехол-книжка Samsung EFC-1J9FOEGSTD N7100 Orange";i:58;s:68:"купит Чехол-книжка Samsung EFC-1J9FPEGSTD N7100 Pink";i:59;s:70:"купит Чехол-книжка Samsung EFC-1J9FSEGSTD N7100 Silver";i:60;s:69:"купит Чехол-книжка Samsung EFC-1J9FWEGSTD N7100 White";i:61;s:75:"купит Чехол-книжка Samsung EFC-1M7FAEGSTD I8190 Amber Brown";i:62;s:68:"купит Чехол-книжка Samsung EFC-1M7FBEGSTD I8190 Blue";i:63;s:74:"купит Чехол-книжка Samsung EFC-1M7FLEGSTD I8190 Light Blue";i:64;s:68:"купит Чехол-книжка Samsung EFC-1M7FMEGSTD I8190 Mint";i:65;s:70:"купит Чехол-книжка Samsung EFC-1M7FOEGSTD I8190 Orange";i:66;s:68:"купит Чехол-книжка Samsung EFC-1M7FPEGSTD I8190 Pink";i:67;s:69:"купит Чехол-книжка Samsung EFC-1M7FWEGSTD I8190 White";i:68;s:70:"купит Чехол-книжка Samsung EFC-1M7FYEGSTD I8190 Yellow";i:69;s:55:"купит Чехол-книжка Sony PRSA-CL22 Black";i:70;s:53:"купит Чехол-книжка Sony PRSA-CL22 Red";i:71;s:55:"купит Чехол-книжка Sony PRSA-CL22 White";i:72;s:55:"купит Чехол-книжка Sony PRSA-SC22 Black";i:73;s:53:"купит Чехол-книжка Sony PRSA-SC22 Red";i:74;s:55:"купит Чехол-книжка Sony PRSA-SC22 White";i:75;s:73:"купит Чехол-футляр Samsung EFC-1J9LBEGSTD N7100 Navy Blue";i:76;s:75:"купит Чехол-футляр Samsung EFC-1J9LCEGSTD N7100 Choco Brown";i:77;s:74:"купит Чехол-футляр Samsung EFC-1J9LDEGSTD N7100 Dark Brown";i:78;s:53:"купит Чехол Lowepro S&F Phone Case 20 Black";}', NULL),
(46, 'Разрешение экрана', 'ru', 'a:10:{i:0;s:8:"1024x600";i:1;s:8:"1280x800";i:2;s:8:"1366x768";i:3;s:8:"1440x900";i:4;s:8:"1600x900";i:5;s:9:"1900x1080";i:6;s:9:"1920x1080";i:7;s:9:"1920x1200";i:8;s:9:"2560x1600";i:9;s:9:"2880x1800";}', NULL),
(50, 'Объем оперативной памяти', 'ru', 'a:9:{i:0;s:6:"1 ГБ";i:1;s:6:"2 ГБ";i:2;s:6:"256 Mb";i:3;s:6:"3 ГБ";i:4;s:6:"4 ГБ";i:5;s:6:"6 ГБ";i:6;s:6:"8 ГБ";i:7;s:7:"12 ГБ";i:8;s:7:"16 ГБ";}', NULL),
(51, 'Видеокарта', 'ru', 'a:5:{i:0;s:51:"Интегрированная видеокарта";i:1;s:11:"AMD FirePro";i:2;s:10:"ATI Radeon";i:3;s:14:"nVidia GeForce";i:4;s:12:"nVidia ION 2";}', NULL),
(52, 'Объём HDD', 'ru', 'a:5:{i:0;s:13:"до 160 ГБ";i:1;s:19:"160 ГБ - 200 ГБ";i:2;s:19:"250 ГБ - 400 ГБ";i:3;s:19:"500 ГБ - 750 ГБ";i:4;s:20:"1 ТБ и более";}', NULL),
(92, 'Беспроводная Связь', 'ru', 'a:6:{i:0;s:9:"Bluetooth";i:1;s:5:"Wi-Fi";i:2;s:9:"3G (UMTS)";i:3;s:11:"WWAN (3.5G)";i:4;s:2:"4G";i:5;s:18:"Bluetooth и Wi-Fi";}', NULL),
(183, 'Тип штатива', 'ru', 'a:7:{i:0;s:14:"Монопод";i:1;s:12:"Трипод";i:2;s:12:"Штатив";i:3;s:22:"Видеоштатив";i:4;s:33:"Настольный штатив";i:5;s:33:"Штативная головка";i:6;s:18:"Платформа";}', NULL),
(53, 'Оптический привод', 'ru', 'a:9:{i:0;s:7:"Blu-Ray";i:1;s:3:"DVD";i:2;s:22:"Отсутствует";i:3;s:17:"opticheskiyprivod";i:4;s:18:"DVD Super Multi DL";i:5;s:8:"DVD+/-RW";i:6;s:6:"Нет";i:7;s:15:"DVD Super Multi";i:8;s:13:"Blu-Ray Combo";}', NULL),
(139, 'Операционная система', 'ru', 'a:37:{i:0;s:7:"Android";i:1;s:11:"Android 2.2";i:2;s:11:"Android 2.3";i:3;s:11:"Android 3.0";i:4;s:13:"Android 3.0.1";i:5;s:11:"Android 3.1";i:6;s:23:"Android 3.1 (Honeycomb)";i:7;s:11:"Android 3.2";i:8;s:23:"Android 3.2 (Honeycomb)";i:9;s:11:"Android 4.0";i:10;s:32:"Android 4.0 (Ice Cream Sandwich)";i:11;s:34:"Android 4.0.3 (Ice Cream Sandwich)";i:12;s:13:"Android 4.0.3";i:13;s:13:"Android 4.0.4";i:14;s:11:"Android 4.1";i:15;s:24:"Android 4.1 (Jelly Bean)";i:16;s:26:"Android 4.1.2 (Jelly Bean)";i:17;s:11:"Android 4.2";i:18;s:9:"Windows 8";i:19;s:12:"Windows 8 RT";i:20;s:9:"Windows 7";i:21;s:10:"Windows RT";i:22;s:17:"Windows Phone 7.5";i:23;s:15:"Windows Phone 8";i:24;s:6:"Mac OS";i:25;s:5:"Linux";i:26;s:5:"MeeGo";i:27;s:3:"DOS";i:28;s:7:"Symbian";i:29;s:8:"Bada 2.0";i:30;s:11:"Без ОС";i:31;s:12:"Другая";i:32;s:18:"operazionajsistema";i:33;s:18:"Express Gate + DOS";i:34;s:12:"Express Gate";i:35;s:11:"без ОС";i:36;s:9:"Android 4";}', NULL),
(141, 'Диагональ экрана', 'ru', 'a:90:{i:0;s:10:"1.36&quot;";i:1;s:9:"1.4&quot;";i:2;s:9:"1.5&quot;";i:3;s:9:"1.6&quot;";i:4;s:9:"1.7&quot;";i:5;s:9:"1.8&quot;";i:6;s:9:"2.0&quot;";i:7;s:9:"2.2&quot;";i:8;s:9:"2.4&quot;";i:9;s:9:"2.6&quot;";i:10;s:9:"2.8&quot;";i:11;s:9:"3.0&quot;";i:12;s:9:"3.2&quot;";i:13;s:9:"3.5&quot;";i:14;s:9:"3.7&quot;";i:15;s:9:"3.8&quot;";i:16;s:9:"4.0&quot;";i:17;s:9:"4.3&quot;";i:18;s:9:"4.5&quot;";i:19;s:9:"4.7&quot;";i:20;s:9:"4.8&quot;";i:21;s:9:"5.0&quot;";i:22;s:9:"5.3&quot;";i:23;s:9:"5.5&quot;";i:24;s:3:"4,7";i:25;s:4:"7,67";i:26;s:1:"8";i:27;s:3:"8,9";i:28;s:1:"9";i:29;s:2:"10";i:30;s:4:"10,1";i:31;s:4:"11,6";i:32;s:7:"11-12,5";i:33;s:2:"13";i:34;s:2:"14";i:35;s:7:"15-15.6";i:36;s:5:"16-17";i:37;s:5:"18-20";i:38;s:10:"11.6&quot;";i:39;s:9:"8.0&quot;";i:40;s:8:"10&quot;";i:41;s:10:"10.1&quot;";i:42;s:7:"7&quot;";i:43;s:7:"9&quot;";i:44;s:9:"9.7&quot;";i:45;s:10:"7.67&quot;";i:46;s:9:"8.9&quot;";i:47;s:10:"17.3&quot;";i:48;s:8:"14&quot;";i:49;s:10:"15.6&quot;";i:50;s:10:"13.3&quot;";i:51;s:10:"12.1&quot;";i:52;s:10:"18.4&quot;";i:53;s:8:"15&quot;";i:54;s:8:"27&quot;";i:55;s:8:"24&quot;";i:56;s:10:"18.5&quot;";i:57;s:8:"19&quot;";i:58;s:10:"23.6&quot;";i:59;s:8:"23&quot;";i:60;s:10:"23.8&quot;";i:61;s:8:"21&quot;";i:62;s:10:"21.5&quot;";i:63;s:8:"20&quot;";i:64;s:8:"22&quot;";i:65;s:8:"26&quot;";i:66;s:8:"29&quot;";i:67;s:8:"17&quot;";i:68;s:7:"diagekr";i:69;s:7:"8&quot;";i:70;s:7:"6&quot;";i:71;s:30:"21.5&quot; Full HD (1920x1080)";i:72;s:28:"27&quot; Full HD (1920x1080)";i:73;s:26:"16&quot; WXGA (1366 x 768)";i:74;s:25:"20&quot; WUXGA (1600x900)";i:75;s:28:"23&quot; Full HD (1920x1080)";i:76;s:30:"23.6&quot; Full HD (1920x1080)";i:77;s:28:"24&quot; Full HD (1920x1080)";i:78;s:8:"42&quot;";i:79;s:8:"46&quot;";i:80;s:8:"47&quot;";i:81;s:8:"32&quot;";i:82;s:8:"40&quot;";i:83;s:8:"50&quot;";i:84;s:8:"55&quot;";i:85;s:8:"60&quot;";i:86;s:8:"37&quot;";i:87;s:8:"39&quot;";i:88;s:8:"28&quot;";i:89;s:8:"65&quot;";}', NULL),
(90, 'Количество ядер процессора', 'ru', 'a:7:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"4";i:3;s:1:"6";i:4;s:1:"8";i:5;s:2:"10";i:6;s:2:"12";}', NULL),
(91, 'Емкость жесткого диска', 'ru', 'a:17:{i:0;s:8:"256 МБ";i:1;s:6:"2 ГБ";i:2;s:6:"4 ГБ";i:3;s:6:"8 ГБ";i:4;s:7:"16 ГБ";i:5;s:7:"32 ГБ";i:6;s:7:"64 ГБ";i:7;s:8:"128 ГБ";i:8;s:8:"250 ГБ";i:9;s:8:"320 ГБ";i:10;s:8:"500 ГБ";i:11;s:8:"750 ГБ";i:12;s:6:"1 ТБ";i:13;s:8:"1.5 ТБ";i:14;s:6:"2 ТБ";i:15;s:8:"2.5 ТБ";i:16;s:6:"3 ТБ";}', NULL),
(57, 'Тип холодильника', 'ru', 'a:6:{i:0;s:24:"Двухкамерные";i:1;s:24:"Однокамерные";i:2;s:12:"Side-by-side";i:3;s:40:"Холодильники для вина";i:4;s:42:"Шкафы для сыра и салями";i:5;s:28:"Шкафы для сигар";}', NULL),
(58, 'Объем холодильной камеры (л)', 'ru', 'a:4:{i:0;s:9:"350-400 ";i:1;s:9:"250-349 ";i:2;s:16:"свыше 400 ";i:3;s:9:"130-249 ";}', NULL),
(59, 'Объем морозильной камеры (л)', 'ru', 'a:5:{i:0;s:7:"201-250";i:1;s:9:"141-200 ";i:2;s:9:"201-250 ";i:3;s:8:"30-100 ";i:4;s:9:"101-140 ";}', NULL),
(60, 'Расположение морозильной камеры ', 'ru', 'a:4:{i:0;s:25:"Сбоку (Side-by-side)";i:1;s:9:"Cнизу";i:2;s:12:"Сверху";i:3;s:10:"Снизу";}', NULL),
(62, 'Поддержка 3D', 'ru', '', NULL),
(64, 'Тип управления ', 'ru', 'a:4:{i:0;s:22:"Электронное";i:1;s:24:"Механическое";i:2;s:45:"Электронно-механическое";i:3;s:39:"Электро-механическое";}', NULL),
(79, 'Место установки', 'ru', 'a:3:{i:0;s:27:"Внутри домовые";i:1;s:14:"Уличные";i:2;s:21:"Primeneniesvetilnikov";}', NULL),
(66, 'No Frost (Frost Free)', 'ru', 'a:4:{i:0;s:69:"в морозильном + холодильном отделении";i:1;s:44:"в морозильном отделении";i:2;s:44:"в холодильном отделении";i:3;s:6:"нет";}', NULL),
(67, 'Зона свежести', 'ru', 'a:2:{i:0;s:8:"есть";i:1;s:6:"нет";}', NULL),
(68, 'Класс энергопотребления', 'ru', 'a:11:{i:0;s:1:"A";i:1;s:2:"A+";i:2;s:3:"A++";i:3;s:5:"А+++";i:4;s:1:"B";i:5;s:1:"C";i:6;s:10:"Выше A";i:7;s:2:"А";i:8;s:3:"D-G";i:9;s:3:"А+";i:10;s:4:"А++";}', NULL),
(73, 'Частота развёртки', 'ru', '', NULL),
(74, 'USB', 'ru', '', NULL),
(75, 'Цифровой тюнер', 'ru', '', NULL),
(76, 'Акустика', 'ru', '', NULL),
(77, 'Выход в Интернет', 'ru', '', NULL),
(101, 'Материал плафона', 'ru', 'a:23:{i:0;s:14:"Ракушка";i:1;s:12:"Фарфор";i:2;s:12:"Стекло";i:3;s:30:"Стекло, хрусталь";i:4;s:30:"Металл, хрусталь";i:5;s:24:"Металл, ткань";i:6;s:16:"Хрусталь";i:7;s:10:"Ткань";i:8;s:12:"Металл";i:9;s:14:"Пластик";i:10;s:12:"Дерево";i:11;s:16:"Керамика";i:12;s:16:"Компаунд";i:13;s:12:"Бумага";i:14;s:21:"Без плафона";i:15;s:28:"Металл, пластик";i:16;s:30:"Алюминий, металл";i:17;s:26:"Металл, стекло";i:18;s:24:"Ткань, стекло";i:19;s:16:"Алюминий";i:20;s:28:"Стекло, пластик";i:21;s:26:"Стекло, дерево";i:22;s:26:"Ткань, пластик";}', NULL),
(78, 'Матиериал', 'ru', 'a:2:{i:0;s:14:"Силикон";i:1;s:12:"Латекс";}', NULL),
(89, 'Тип экрана', 'ru', 'a:49:{i:0;s:12:"Super AMOLED";i:1;s:17:"Super AMOLED Plus";i:2;s:3:"IPS";i:3;s:7:"IPS LED";i:4;s:4:"IPS+";i:5;s:3:"LED";i:6;s:10:"Super IPS+";i:7;s:3:"PLS";i:8;s:7:"PLS LCD";i:9;s:7:"PLS TFT";i:10;s:3:"TFT";i:11;s:2:"TN";i:12;s:3:"MVA";i:13;s:9:"tipekrana";i:14;s:9:"SuperIPS+";i:15;s:4:"WXGA";i:16;s:6:"LED HD";i:17;s:7:"LED HD+";i:18;s:10:"TFT LED HD";i:19;s:11:"LED HD Slim";i:20;s:11:"TFT LED HD+";i:21;s:25:"FullHD IPS MultiTouch LED";i:22;s:14:"FullHD IPS LED";i:23;s:18:"HD Multi Touch LED";i:24;s:6:"TFT HD";i:25;s:15:"TFT WXGA LED HD";i:26;s:7:"TFT LED";i:27;s:9:"TFT WSVGA";i:28;s:13:"TFT WSVGA LED";i:29;s:12:"TFT WXGA LED";i:30;s:2:"HD";i:31;s:6:"SD LED";i:32;s:9:"WSVGA LED";i:33;s:11:"TFT WXGA HD";i:34;s:9:"HD 3D LED";i:35;s:13:"TFT LED HD 3D";i:36;s:10:"FullHD LED";i:37;s:9:"FullHD 3D";i:38;s:6:"FullHD";i:39;s:14:"FullHD TFT LED";i:40;s:11:"FullHD+ LED";i:41;s:12:"FullHD Touch";i:42;s:20:"FullHD IPS Touch LED";i:43;s:17:"FullHD IPS WV LED";i:44;s:10:"FullHD IPS";i:45;s:10:"WV LED HD+";i:46;s:14:"HD Multi Touch";i:47;s:11:"LED HD WXGA";i:48;s:5:"E-ink";}', NULL),
(70, 'Цвет', 'ru', 'a:16:{i:0;s:5:"Black";i:1;s:4:"Blue";i:2;s:5:"Brown";i:3;s:4:"Gold";i:4;s:5:"Green";i:5;s:4:"Grey";i:6;s:4:"Pink";i:7;s:3:"Red";i:8;s:6:"Silver";i:9;s:6:"Violet";i:10;s:5:"White";i:11;s:6:"Yellow";i:12;s:6:"Orange";i:13;s:7:"Magenta";i:14;s:6:"Orchid";i:15;s:4:"Cyan";}', NULL),
(95, 'Цвет арматуры', 'ru', 'a:42:{i:0;s:8:"Хром";i:1;s:14:"Бежевый";i:2;s:10:"Белый";i:3;s:12:"Желтый";i:4;s:14:"Зеленый";i:5;s:14:"Золотой";i:6;s:20:"Коричневый";i:7;s:14:"Красный";i:8;s:12:"Медный";i:9;s:18:"Оранжевый";i:10;s:20:"Прозрачный";i:11;s:24:"Разноцветный";i:12;s:14:"Розовый";i:13;s:20:"Серебряный";i:14;s:10:"Серый";i:15;s:16:"Стальной";i:16;s:20:"Фиолетовый";i:17;s:12:"Черный";i:18;s:21:"Черный хром";i:19;s:23:"Без арматуры";i:20;s:27:"Никель матовый";i:21;s:20:"Белый, хром";i:22;s:27:"Латунь матовая";i:23;s:37:"Никель матовый, хром";i:24;s:20:"Хром, белый";i:25;s:62:"Матовый алюминий, белый глянцевый";i:26;s:39:"Хром, блестящий белый";i:27;s:29:"Белый глянцевый";i:28;s:55:"Алюминий матовый, хром, черный";i:29;s:22:"Алюминиевый";i:30;s:31:"Темно-коричневый";i:31;s:22:"Черный, хром";i:32;s:18:"Серебряый";i:33;s:18:"Бронзовый";i:34;s:25:"Тёмная бронза";i:35;s:24:"Белый, золото";i:36;s:49:"Никель матовый, коричневый";i:37;s:34:"Черный, коричневый";i:38;s:31:"Матовый алюминий";i:39;s:43:"Антикварный коричневый";i:40;s:49:"Серебряный, никель матовый";i:41;s:16:"Ржавчина";}', NULL),
(96, 'Цвет плафона', 'ru', 'a:32:{i:0;s:8:"Хром";i:1;s:10:"Белый";i:2;s:14:"Бежевый";i:3;s:12:"Желтый";i:4;s:14:"Зеленый";i:5;s:14:"Золотой";i:6;s:20:"Коричневый";i:7;s:14:"Красный";i:8;s:12:"Медный";i:9;s:18:"Оранжевый";i:10;s:20:"Прозрачный";i:11;s:24:"Разноцветный";i:12;s:14:"Розовый";i:13;s:20:"Серебряный";i:14;s:10:"Серый";i:15;s:10:"Синий";i:16;s:16:"Стальной";i:17;s:20:"Фиолетовый";i:18;s:12:"Черный";i:19;s:21:"Без плафона";i:20;s:27:"Латунь матовая";i:21;s:27:"Никель матовый";i:22;s:20:"Хром, белый";i:23;s:14:"Матовый";i:24;s:37:"Никель матовый, хром";i:25;s:22:"Алюминиевый";i:26;s:20:"Хром, Белый";i:27;s:21:"Тёмно-серый";i:28;s:20:"Белый, хром";i:29;s:20:"Белый, Хром";i:30;s:24:"Белый, Черный";i:31;s:31:"Матовый алюминий";}', NULL),
(97, 'Дизайн', 'ru', 'a:21:{i:0;s:16:"Классика";i:1;s:12:"Модерн";i:2;s:16:"Хрусталь";i:3;s:6:"Hi-Tec";i:4;s:10:"Свечи";i:5;s:10:"Ковка";i:6;s:12:"Резьба";i:7;s:10:"Флора";i:8;s:10:"Фауна";i:9;s:18:"Дворцовый";i:10;s:27:"Тиффани/Витраж";i:11;s:21:"Этно/Кантри";i:12;s:12:"Ванная";i:13;s:10:"Кухня";i:14;s:14:"Детская";i:15;s:14:"Бильярд";i:16;s:10:"Спорт";i:17;s:16:"Прищепка";i:18;s:10:"Факел";i:19;s:12:"Клубок";i:20;s:29:"Гибкая арматура";}', NULL),
(98, 'Геометрия плафона', 'ru', 'a:13:{i:0;s:10:"Сфера";i:1;s:18:"Полусфера";i:2;s:6:"Куб";i:3;s:14:"Цилиндр";i:4;s:10:"Конус";i:5;s:16:"Пирамида";i:6;s:8:"Круг";i:7;s:16:"Полукруг";i:8;s:14:"Квадрат";i:9;s:22:"Треугольник";i:10;s:12:"Каскад";i:11;s:18:"Свободная";i:12;s:21:"Без плафона";}', NULL),
(99, 'Тип лампы', 'ru', 'a:5:{i:0;s:22:"Накаливания";i:1;s:28:"Люминесцентная";i:2;s:20:"Галогенная";i:3;s:3:"LED";i:4;s:27:"Накаливания, LED";}', NULL),
(100, 'Количество ламп', 'ru', 'a:12:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:3:"5-7";i:5;s:4:"8-10";i:6;s:13:"Более 10";i:7;s:1:"5";i:8;s:1:"6";i:9;s:2:"15";i:10;s:1:"7";i:11;s:1:"8";}', NULL),
(184, 'Диаметр фильтра', 'ru', 'a:21:{i:0;s:8:"100 мм";i:1;s:7:"25 мм";i:2;s:7:"27 мм";i:3;s:7:"28 мм";i:4;s:7:"30 мм";i:5;s:9:"30.5 мм";i:6;s:7:"34 мм";i:7;s:9:"35.5 мм";i:8;s:7:"37 мм";i:9;s:9:"40.5 мм";i:10;s:7:"43 мм";i:11;s:7:"46 мм";i:12;s:7:"49 мм";i:13;s:7:"52 мм";i:14;s:7:"55 мм";i:15;s:7:"58 мм";i:16;s:7:"62 мм";i:17;s:7:"67 мм";i:18;s:7:"72 мм";i:19;s:7:"77 мм";i:20;s:7:"82 мм";}', NULL),
(84, 'Диапазон  мощности (Вт)', 'ru', '', NULL),
(355, 'Диапазон мощности (Вт)', 'ru', 'a:9:{i:0;s:17:"более 2000 ";i:1;s:11:"1600-2000 ";i:2;s:11:"1000-1500 ";i:3;s:9:"1850-2200";i:4;s:15:"менее 1000";i:5;s:9:"500-750 ";i:6;s:10:"800-1000 ";i:7;s:16:"менее 500 ";i:8;s:17:"более 1000 ";}', NULL),
(86, 'Система реверса', 'ru', 'a:2:{i:0;s:8:"есть";i:1;s:6:"нет";}', NULL),
(102, 'Материал арматуры', 'ru', 'a:15:{i:0;s:12:"Фарфор";i:1;s:12:"Металл";i:2;s:30:"Металл, хрусталь";i:3;s:12:"Дерево";i:4;s:14:"Пластик";i:5;s:12:"Стекло";i:6;s:16:"Хрусталь";i:7;s:16:"Керамика";i:8;s:8:"Кожа";i:9;s:10:"Смола";i:10;s:23:"Без арматуры";i:11;s:22:"Металл, кожа";i:12;s:26:"Металл, дерево";i:13;s:16:"Алюминий";i:14;s:28:"Металл, пластик";}', NULL),
(103, 'Управление освещением', 'ru', 'a:15:{i:0;s:15:"Пульт ДУ";i:1;s:12:"Диммер";i:2;s:31:"Сенсорный диммер";i:3;s:37:"Разноцветные режимы";i:4;s:29:"Датчик движения";i:5;s:29:"Без выключателя";i:6;s:39:"Выключатель рокерный";i:7;s:42:"Выключатель на проводе";i:8;s:18:"Сенсорный";i:9;s:30:"AL кабель + разъем";i:10;s:4:"ENEC";i:11;s:55:"Выключатель с тяговым шнурком";i:12;s:37:"Регулировка яркости";i:13;s:35:"Выключатель ножной";i:14;s:28:"Светорегулятор";}', NULL),
(104, 'Серия Illuminati', 'ru', 'a:57:{i:0;s:7:"Alberta";i:1;s:4:"Coni";i:2;s:5:"Calma";i:3;s:6:"Angelo";i:4;s:7:"Lattera";i:5;s:3:"Bar";i:6;s:7:"Pioggia";i:7;s:7:"Perlina";i:8;s:5:"Sfera";i:9;s:7:"Marcelo";i:10;s:7:"Cilento";i:11;s:7:"Cottura";i:12;s:7:"Brocato";i:13;s:4:"Peso";i:14;s:7:"Bergamo";i:15;s:8:"Paradiso";i:16;s:6:"Rozone";i:17;s:7:"Stretto";i:18;s:8:"Unicorno";i:19;s:4:"Dune";i:20;s:6:"Piatto";i:21;s:5:"Punto";i:22;s:4:"Cubo";i:23;s:7:"Matrice";i:24;s:6:"Silvia";i:25;s:6:"Aurora";i:26;s:5:"Grumo";i:27;s:4:"Alba";i:28;s:11:"Via Lattera";i:29;s:9:"Primavera";i:30;s:5:"Elica";i:31;s:8:"Eleonora";i:32;s:6:"Regina";i:33;s:8:"Anguilla";i:34;s:5:"Cielo";i:35;s:7:"Flberta";i:36;s:8:"Giardino";i:37;s:7:"Confuso";i:38;s:6:"Foggia";i:39;s:6:"Cucina";i:40;s:13:"Purple Elvira";i:41;s:13:"Cognac Elvira";i:42;s:6:"Cetara";i:43;s:8:"Carolina";i:44;s:8:"Ricciolo";i:45;s:6:"Polare";i:46;s:4:"Otto";i:47;s:7:"Signore";i:48;s:7:"Venezia";i:49;s:6:"Piazze";i:50;s:5:"Cigno";i:51;s:5:"Corso";i:52;s:10:"Cold Flame";i:53;s:7:"Diamond";i:54;s:5:"Geoma";i:55;s:5:"Ambra";i:56;s:4:"Arco";}', NULL),
(140, 'Оперативная память', 'ru', 'a:9:{i:0;s:5:"oppam";i:1;s:6:"2 ГБ";i:2;s:6:"1 ГБ";i:3;s:8:"512 МБ";i:4;s:6:"8 ГБ";i:5;s:6:"4 ГБ";i:6;s:6:"6 ГБ";i:7;s:6:"3 ГБ";i:8;s:7:"16 ГБ";}', NULL),
(111, 'Каркас', 'ru', 'a:8:{i:0;s:7:"Duratec";i:1;s:33:"Алюминиевый сплав";i:2;s:30:"Комбинированный";i:3;s:10:"Сталь";i:4;s:26:"Стекловолокно";i:5;s:7:"Durapol";i:6;s:22:"Дюралюминий";i:7;s:20:"Фибергласс";}', NULL),
(112, 'Внутренняя высота', 'ru', 'a:8:{i:0;s:11:"160 — 190";i:1;s:8:"до 130";i:2;s:14:"свыше 190";i:3;s:14:"свыше 191";i:4;s:14:"свыше 192";i:5;s:14:"свыше 193";i:6;s:14:"свыше 194";i:7;s:8:"до 131";}', NULL),
(113, 'Назначение', 'ru', 'a:3:{i:0;s:23:"Для кемпинга";i:1;s:17:"Для пляжа";i:2;s:21:"Для туризма";}', NULL),
(114, 'Наличие тамбура', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(115, 'Высота холодильника', 'ru', 'a:5:{i:0;s:9:"150-179 ";i:1;s:9:"180-200 ";i:2;s:7:"60-89 ";i:3;s:9:"120-149 ";i:4;s:16:"свыше 200 ";}', NULL),
(116, 'Ширина', 'ru', 'a:5:{i:0;s:7:"45-59.5";i:1;s:5:"60-69";i:2;s:5:"70-79";i:3;s:5:"80-90";i:4;s:13:"свыше 90";}', NULL),
(117, 'Глубина', 'ru', 'a:3:{i:0;s:7:"66-80 ";i:1;s:7:"57-65 ";i:2;s:15:"менее 57 ";}', NULL),
(118, 'Дисплей', 'ru', 'a:2:{i:0;s:8:"есть";i:1;s:6:"нет";}', NULL),
(119, 'Количество компрессоров', 'ru', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', NULL),
(120, 'Цвет ', 'ru', 'a:16:{i:0;s:14:"Бежевый";i:1;s:27:"Металло-графит";i:2;s:33:"Нержавеющая сталь";i:3;s:12:"Черный";i:4;s:22:"Серебристый";i:5;s:10:"Белый";i:6;s:14:"Красный";i:7;s:14:"Шампань";i:8;s:26:"Кофе с молоком";i:9;s:20:"Коричневый";i:10;s:31:"Ванильно-бежевый";i:11;s:22:"Белоснежный";i:12;s:37:"Графитовый металлик";i:13;s:25:"Черное стекло";i:14;s:25:"Серый металик";i:15;s:14:"Серебро";}', NULL),
(345, 'Емкость чаши (л)', 'ru', 'a:3:{i:0;s:5:"1-2 ";i:1;s:5:"3-4 ";i:2;s:17:"5 и более ";}', NULL),
(346, 'Блендер', 'ru', 'a:2:{i:0;s:6:"нет";i:1;s:8:"есть";}', NULL),
(347, 'Мясорубка', 'ru', 'a:2:{i:0;s:6:"нет";i:1;s:8:"есть";}', NULL),
(348, 'Cоковыжималка', 'ru', 'a:2:{i:0;s:6:"нет";i:1;s:8:"есть";}', NULL),
(349, 'Материал корпуса', 'ru', 'a:2:{i:0;s:14:"пластик";i:1;s:12:"металл";}', NULL),
(350, 'Тип', 'ru', '', NULL),
(351, 'Диапазон  мощности (Вт)', 'ru', 'a:3:{i:0;s:17:"diapazonmoshnosti";i:1;s:9:"300-500 ";i:2;s:16:"менее 300 ";}', NULL),
(352, 'Объем (л)', 'ru', 'a:9:{i:0;s:5:"obyem";i:1;s:1:"5";i:2;s:3:"2,5";i:3;s:3:"4,5";i:4;s:3:"1,5";i:5;s:1:"3";i:6;s:1:"6";i:7;s:3:"1,6";i:8;s:1:"4";}', NULL),
(353, 'Спальное место', 'ru', 'a:4:{i:0;s:12:"spalnoemesto";i:1;s:10:"1550 x 750";i:2;s:10:"1551 x 750";i:3;s:10:"1552 x 750";}', NULL),
(354, 'Бельевой ящик', 'ru', 'a:5:{i:0;s:13:"Belevoyyashik";i:1;s:10:"1460 x 730";i:2;s:10:"1220 x 730";i:3;s:10:"1461 x 730";i:4;s:10:"1462 x 730";}', NULL),
(105, 'Категории раздела', 'ru', 'a:12:{i:0;s:20:"Потолочные";i:1;s:18:"Подвесные";i:2;s:18:"Настенные";i:3;s:20:"Настольные";i:4;s:14:"Торшеры";i:5;s:47:"Встраиваемые светильники";i:6;s:31:"Датчики движения";i:7;s:39:"Парковые светильники";i:8;s:14:"Подвесы";i:9;s:33:"Садовая подсветка";i:10;s:35:"Сумеречные датчики";i:11;s:29:"Фонарные столбы";}', NULL),
(107, 'Количество скоростей', 'ru', 'a:2:{i:0;s:6:"до 3";i:1;s:12:"более 3";}', NULL),
(108, 'Мощность (Вт)', 'ru', 'a:4:{i:0;s:14:"менее 300";i:1;s:7:"300-500";i:2;s:7:"600-700";i:3;s:14:"более 700";}', NULL),
(123, 'FM- тюнер', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(124, 'Диктофон', 'ru', 'a:3:{i:0;s:8:"Есть";i:1;s:6:"Нет";i:2;s:8:"diktofon";}', NULL),
(110, 'Количество мест', 'ru', 'a:8:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";i:6;s:1:"7";i:7;s:1:"8";}', NULL),
(125, 'Память', 'ru', 'a:4:{i:0;s:9:"1024 Мб";i:1;s:9:"2048 Мб";i:2;s:9:"4096 Мб";i:3;s:9:"8192 Мб";}', NULL),
(290, 'Тип подключения', 'ru', 'a:2:{i:0;s:24:"Беспроводное";i:1;s:18:"Проводное";}', NULL),
(127, 'Питание Li-Ion', 'ru', 'a:4:{i:0;s:21:"от 400 до 800 mAh";i:1;s:23:"от 1000 до 1500 mAh";i:2;s:23:"от 1500 до 3000 mAh";i:3;s:22:"от 800 до 1000 mAh";}', NULL),
(135, 'Частота процессора', 'ru', 'a:10:{i:0;s:11:"500-600 MHz";i:1;s:11:"600-800 MHz";i:2;s:15:"800-1000 МГц";i:3;s:20:"от 1 до 1.5  GHz";i:4;s:20:"от 1.5 до 2  GHz";i:5;s:16:"zastotaprozesora";i:6;s:19:"от 1 до 1.5 GHz";i:7;s:22:"от 800 до 1000 MHz";i:8;s:19:"от 1.5 до 2 GHz";i:9;s:21:"от 600 до 800 MHz";}', NULL),
(131, 'Производитель', 'ru', '', NULL),
(133, 'Встроеная память', 'ru', 'a:8:{i:0;s:7:"64 МБ";i:1;s:8:"128 МБ";i:2;s:8:"512 МБ";i:3;s:4:"2 GB";i:4;s:4:"4 GB";i:5;s:4:"8 GB";i:6;s:5:"16 GB";i:7;s:5:"32 GB";}', NULL),
(134, 'Поддержка карт памяти', 'ru', 'a:2:{i:0;s:20:"microSD до 32 Гб";i:1;s:7:"microSD";}', NULL),
(137, 'Поддержка карт памяти', 'ru', 'a:4:{i:0;s:20:"microSD до 32 Гб";i:1;s:20:"microSD до 16 Гб";i:2;s:19:"microSD до 8 Гб";i:3;s:19:"microSD до 4 Гб";}', NULL),
(138, 'Тип кофеварки ', 'ru', 'a:3:{i:0;s:35:"Кофеварки эспрессо";i:1;s:37:"Капельные кофеварки";i:2;s:39:"Капсульные кофеварки";}', NULL),
(142, 'Разрешение экрана', 'ru', 'a:28:{i:0;s:5:"96x68";i:1;s:6:"120x64";i:2;s:7:"128x128";i:3;s:6:"128x64";i:4;s:8:"160х128";i:5;s:8:"220х176";i:6;s:8:"320х240";i:7;s:7:"400x240";i:8;s:8:"480х320";i:9;s:8:"1366x768";i:10;s:8:"1024x600";i:11;s:8:"1280x720";i:12;s:6:"razekr";i:13;s:9:"1280х800";i:14;s:9:"1920x1200";i:15;s:7:"800x600";i:16;s:7:"800x480";i:17;s:8:"1024x768";i:18;s:8:"1600x900";i:19;s:9:"1920x1080";i:20;s:9:"1024х600";i:21;s:9:"1280x1024";i:22;s:8:"1440x900";i:23;s:9:"1680x1050";i:24;s:9:"2560x1440";i:25;s:8:"1280x768";i:26;s:9:"2048x1536";i:27;s:8:"1280x800";}', NULL),
(143, 'Процессор', 'ru', 'a:52:{i:0;s:13:"Intel Core i7";i:1;s:13:"Intel Core i5";i:2;s:13:"Intel Core i3";i:3;s:16:"Intel Core 2 Duo";i:4;s:23:"Intel Pentium Dual Core";i:5;s:13:"Intel Celeron";i:6;s:10:"Intel Atom";i:7;s:5:"AMD E";i:8;s:7:"AMD A10";i:9;s:6:"AMD A8";i:10;s:6:"AMD A6";i:11;s:6:"AMD A4";i:12;s:5:"AMD C";i:13;s:12:"nVidia Tegra";i:14;s:16:"Intel Atom Z2760";i:15;s:10:"Mali-400MP";i:16;s:16:"NVIDIA Tegra 250";i:17;s:14:"Nvidia Tegra 3";i:18;s:14:"NVIDIA Tegra 2";i:19;s:14:"Qualcomm 8260A";i:20;s:13:"Qualcomm 8064";i:21;s:15:"AMLogic 8726-M6";i:22;s:15:"AMLogic 8726-MX";i:23;s:21:"Allwinner Boxchip A13";i:24;s:15:"AMLogic 8726-M3";i:25;s:13:"Allwinner A10";i:26;s:8:"Qualcomm";i:27;s:15:"RockChip RK2918";i:28;s:13:"MediaTek 6575";i:29;s:7:"TI OMAP";i:30;s:13:"ARM cortex A9";i:31;s:14:"Nvidia Tegra 2";i:32;s:32:"Intel Graphics Media Accelerator";i:33;s:9:"Cortex A8";i:34;s:13:"Intel Pentium";i:35;s:7:"AMD C60";i:36;s:6:"AMD E2";i:37;s:8:"AMD E450";i:38;s:6:"AMD E1";i:39;s:7:"AMD C70";i:40;s:8:"AMD C450";i:41;s:7:"AMD C50";i:42;s:8:"AMD E300";i:43;s:8:"AMD E350";i:44;s:16:"Intel Atom Z2420";i:45;s:15:"Intel Atom D425";i:46;s:15:"AMD Fusion E450";i:47;s:4:"proc";i:48;s:14:"MediaTek 8317T";i:49;s:9:"Quad Core";i:50;s:25:"MediaTek 8317 (Cortex A9)";i:51;s:30:"MediaTek 8389/8125 (Cortex A9)";}', NULL),
(144, 'Видеокарта', 'ru', 'a:13:{i:0;s:51:"Интегрированная видеокарта";i:1;s:11:"AMD FirePro";i:2;s:10:"ATI Radeon";i:3;s:14:"nVidia GeForce";i:4;s:12:"nVidia ION 2";i:5;s:17:"Intel HD Graphics";i:6;s:14:"NVIDIA GeForce";i:7;s:10:"AMD Radeon";i:8;s:8:"Intel HD";i:9;s:9:"Intel GMA";i:10;s:10:"videokarta";i:11;s:30:"Интегрированная";i:12;s:7:"NV ION2";}', NULL),
(145, 'Объём HDD', 'ru', 'a:21:{i:0;s:5:"obhdd";i:1;s:7:"64 ГБ";i:2;s:7:"16 ГБ";i:3;s:7:"32 ГБ";i:4;s:6:"8 ГБ";i:5;s:6:"4 ГБ";i:6;s:8:"512 МБ";i:7;s:8:"500 ГБ";i:8;s:8:"750 ГБ";i:9;s:8:"320 ГБ";i:10;s:6:"1 ТБ";i:11;s:8:"128 ГБ";i:12;s:8:"640 ГБ";i:13;s:8:"1.5 ТБ";i:14;s:9:"1.75 ТБ";i:15;s:6:"2 ТБ";i:16;s:8:"256 ГБ";i:17;s:6:"3 ТБ";i:18;s:8:"250 ГБ";i:19;s:6:"2 ГБ";i:20;s:13:"До 160 ГБ";}', NULL),
(146, 'Вес', 'ru', 'a:29:{i:0;s:19:"от 10 до 60 г.";i:1;s:19:"от 60 до 80 г.";i:2;s:20:"от 80 до 100 г.";i:3;s:21:"от 100 до 150 г.";i:4;s:11:"до 1 кг";i:5;s:20:"от 1 до 1.5 кг";i:6;s:20:"от 1.5 до 2 кг";i:7;s:20:"от 2 до 2.5 кг";i:8;s:20:"От 2.5 до 3 кг";i:9;s:17:"Более 3 кг";i:10;s:3:"ves";i:11;s:4:"93,3";i:12;s:4:"12,6";i:13;s:4:"15,5";i:14;s:2:"15";i:15;s:2:"29";i:16;s:4:"20,5";i:17;s:2:"10";i:18;s:5:"96,55";i:19;s:4:"29,6";i:20;s:3:"3,7";i:21;s:4:"4,62";i:22;s:2:"16";i:23;s:4:"13,2";i:24;s:4:"24,3";i:25;s:4:"41,5";i:26;s:2:"39";i:27;s:4:"5,73";i:28;s:20:"от 100 до 150 г";}', NULL),
(335, 'GPS приёмник', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(336, 'RAM память', 'ru', 'a:3:{i:0;s:7:"64 МБ";i:1;s:8:"128 МБ";i:2;s:8:"512 МБ";}', NULL),
(333, 'Размер дисплея', 'ru', 'a:2:{i:0;s:1:"5";i:1;s:1:"7";}', NULL),
(334, 'Время работы', 'ru', 'a:3:{i:0;s:4:"1 ч";i:1;s:4:"2 ч";i:2;s:4:"3 ч";}', NULL),
(152, 'Питания', 'ru', 'a:4:{i:0;s:31:"От прикуривателя";i:1;s:20:"От сети 220 В";i:2;s:43:"Встроенный аккумулятор";i:3;s:36:"Элементы питания АА";}', NULL),
(337, 'Особенности', 'ru', 'a:3:{i:0;s:32:"Видеорегистратор";i:1;s:25:"FM-трансмиттер";i:2;s:35:"Встроенный динамик";}', NULL),
(154, 'Высота', 'ru', 'a:14:{i:0;s:3:"220";i:1;s:3:"240";i:2;s:6:"Vusota";i:3;s:7:"71 см";i:4;s:7:"72 см";i:5;s:7:"36 см";i:6;s:7:"55 см";i:7;s:7:"80 см";i:8;s:7:"86 см";i:9;s:7:"70 см";i:10;s:7:"34 см";i:11;s:7:"75 см";i:12;s:7:"85 см";i:13;s:8:"101 см";}', NULL),
(155, 'Количество камер', 'ru', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', NULL),
(156, 'Разрешение видео', 'ru', 'a:15:{i:0;s:9:"1980x1080";i:1;s:9:"1920x1080";i:2;s:9:"1920х720";i:3;s:10:"1440х1080";i:4;s:8:"1280x960";i:5;s:8:"1280x720";i:6;s:8:"1280x480";i:7;s:9:"1280х400";i:8;s:7:"960x720";i:9;s:7:"848x480";i:10;s:7:"840x480";i:11;s:7:"720x576";i:12;s:7:"720x480";i:13;s:7:"640x480";i:14;s:7:"320x240";}', NULL),
(157, 'Питание', 'ru', 'a:7:{i:0;s:45:"Собственный аккумулятор";i:1;s:5:"12 В";i:2;s:5:"24 В";i:3;s:32:"Батарейки типа АА";i:4;s:8:"От USB";i:5;s:27:"От электросети";i:6;s:29:"От аккумулятора";}', NULL),
(158, 'Активация записи', 'ru', 'a:5:{i:0;s:52:"Автоматически при включении";i:1;s:51:"По нажатию аварийной кнопки";i:2;s:70:"По датчику удара/торможения/ускорения";i:3;s:46:"При обнаружении движения";i:4;s:44:"При включении двигателя";}', NULL),
(159, 'Ширина', 'ru', 'a:20:{i:0;s:2:"80";i:1;s:7:"Shirina";i:2;s:7:"62 см";i:3;s:7:"84 см";i:4;s:7:"68 см";i:5;s:8:"133 см";i:6;s:8:"182 см";i:7;s:8:"130 см";i:8;s:8:"121 см";i:9;s:7:"55 см";i:10;s:8:"180 см";i:11;s:8:"160 см";i:12;s:7:"45 см";i:13;s:7:"63 см";i:14;s:7:"99 см";i:15;s:7:"83 см";i:16;s:8:"165 см";i:17;s:8:"120 см";i:18;s:8:"200 см";i:19;s:7:"56 см";}', NULL),
(160, 'Материал', 'ru', 'a:68:{i:0;s:10:"Сосна";i:1;s:6:"Бук";i:2;s:8:"material";i:3;s:12:"Фарфор";i:4;s:16:"Керамика";i:5;s:12:"Нейлон";i:6;s:12:"Графит";i:7;s:16:"Алюминий";i:8;s:22:"Композитный";i:9;s:49:"Комбинированные материалы";i:10;s:12:"Дерево";i:11;s:12:"Бумага";i:12;s:14:"Полимер";i:13;s:10:"Метал";i:14;s:18:"Полистоун";i:15;s:12:"Стекло";i:16;s:20:"Микрокотон";i:17;s:18:"Полиэстер";i:18;s:10:"Махра";i:19;s:12:"Латунь";i:20;s:12:"Бамбук";i:21;s:14:"Силикон";i:22;s:25:"Акрил пластик";i:23;s:14:"Пластик";i:24;s:26:"Кожзаменитель";i:25;s:22:"Техноротанг";i:26;s:48:"Техноротанг, алюминий, тик";i:27;s:54:"Техноротанг, алюминий, стекло";i:28;s:50:"Техноротанг, тик, текстилен";i:29;s:36:"Техноротанг, стекло";i:30;s:42:"Техноротанг, текстилен";i:31;s:10:"Ткань";i:32;s:33:"Нержавеющая сталь";i:33;s:24:"Ткань, металл";i:34;s:12:"Гранит";i:35;s:10:"Сталь";i:36;s:12:"Резина";i:37;s:35:"Восстановленый тик";i:38;s:18:"Ткань, тик";i:39;s:49:"комбинированные материалы";i:40;s:12:"Каштан";i:41;s:35:"Древесина махагони";i:42;s:29:"Имитация дерева";i:43;s:20:"Бук, бамбук";i:44;s:8:"Кожа";i:45;s:26:"Прорезиненный";i:46;s:60:"Ударопрочный силиконовый корпус";i:47;s:12:"Металл";i:48;s:31:"Металл,полиэстер";i:49;s:46:"Металл,полиэстер,пластик";i:50;s:27:"металл,пластик";i:51;s:46:"металл,пластик,полиэстер";i:52;s:19:"металл,ПВХ";i:53;s:14:"пластик";i:54;s:34:"пластик, полиэстер";i:55;s:25:"метал,пластик";i:56;s:31:"металл,полиэстер";i:57;s:12:"металл";i:58;s:29:"металл,текстиль";i:59;s:18:"полиэстер";i:60;s:25:"ПВХ,полиэстер";i:61;s:32:"пластик, текстиль";i:62;s:32:"текстиль, пластик";i:63;s:16:"текстиль";i:64;s:34:"полиэстер, пластик";i:65;s:34:"Пластик ,полиэстер";i:66;s:30:"тексиль, пластик";i:67;s:14:"Кордрой";}', NULL),
(161, 'Перекладины', 'ru', 'a:2:{i:0;s:6:"Бук";i:1;s:11:"Peregladina";}', NULL),
(162, 'Выступ вперед', 'ru', 'a:5:{i:0;s:2:"60";i:1;s:2:"75";i:2;s:2:"85";i:3;s:2:"65";i:4;s:12:"Vustypvpered";}', NULL),
(163, 'Требуемая высота помещения', 'ru', 'a:3:{i:0;s:14:"2,45 - 2,85 м";i:1;s:13:"2,60 - 3.0 м";i:2;s:27:"Trebuemayavusotapomesheniya";}', NULL),
(164, 'Допустимые нагрузки на навесное', 'ru', 'a:5:{i:0;s:2:"60";i:1;s:2:"80";i:2;s:3:"100";i:3;s:3:"130";i:4;s:16:"Nagryzkanavesnoe";}', NULL),
(165, 'Допустимые нагрузки на спортуголок', 'ru', 'a:6:{i:0;s:2:"80";i:1;s:3:"100";i:2;s:3:"130";i:3;s:3:"150";i:4;s:3:"180";i:5;s:21:"Nagryzkinasportygolok";}', NULL),
(166, 'Вид крепления', 'ru', 'a:3:{i:0;s:13:"к стене";i:1;s:38:"не требует крепления";i:2;s:13:"Vidkrepleniya";}', NULL),
(167, 'Вес товара', 'ru', 'a:11:{i:0;s:2:"25";i:1;s:2:"27";i:2;s:2:"22";i:3;s:2:"20";i:4;s:2:"30";i:5;s:2:"45";i:6;s:2:"42";i:7;s:2:"35";i:8;s:2:"55";i:9;s:2:"15";i:10;s:2:"10";}', NULL),
(168, 'Цвет', 'ru', 'a:34:{i:0;s:35:"Натуральное дерево";i:1;s:14:"Цветной";i:2;s:4:"Cvet";i:3;s:20:"Коричневый";i:4;s:14:"Бежевый";i:5;s:12:"Черный";i:6;s:25:"Темно зеленый";i:7;s:12:"Duet Harvest";i:8;s:13:"Duet Charcoal";i:9;s:29:"Taupe (темно-серый)";i:10;s:29:"Anthracite (Антрацит)";i:11;s:5:"Lagun";i:12;s:23:"Carbon (углерод)";i:13;s:4:"Leaf";i:14;s:4:"Pure";i:15;s:21:"Pebble (галька)";i:16;s:8:"Colonial";i:17;s:4:"Rock";i:18;s:21:"Charcoal (уголь)";i:19;s:4:"Gold";i:20;s:14:"Polyloom Mocca";i:21;s:33:"Ebony (черное дерево)";i:22;s:17:"Polyloom Titanium";i:23;s:45:"Black stripe (черный в полоску)";i:24;s:20:"Black (черный)";i:25;s:18:"Mocca (мокка)";i:26;s:38:"Ecru (серовато-бежевый)";i:27;s:17:"Grey (серый)";i:28;s:32:"Champagne (шампанское)";i:29;s:29:"Palm (фисташковый)";i:30;s:18:"White (белый)";i:31;s:31:"Темно-коричневый";i:32;s:33:"Светло-коричневый";i:33;s:27:"В ассортименте";}', NULL),
(169, 'Сетевые Возможности', 'ru', 'a:2:{i:0;s:8:"Ethernet";i:1;s:5:"Wi-Fi";}', NULL),
(170, 'Особенности', 'ru', 'a:2:{i:0;s:21:"Поддержка 3D";i:1;s:23:"Поддержка IPTV";}', NULL),
(171, 'Наличие дисплея', 'ru', 'a:7:{i:0;s:21:"Нет дисплея";i:1;s:52:"Текстово-символьный дисплей";i:2;s:7:"2&quot;";i:3;s:7:"7&quot;";i:4;s:7:"9&quot;";i:5;s:8:"10&quot;";i:6;s:10:"10.1&quot;";}', NULL),
(172, 'Наличие тюнера', 'ru', 'a:1:{i:0;s:8:"Есть";}', NULL),
(173, 'Количество пикселей', 'ru', 'a:2:{i:0;s:29:"9-12 мегапикселей";i:1;s:38:"более 12 мегапикселей";}', NULL),
(174, 'Запись видео', 'ru', 'a:4:{i:0;s:14:"QVGA (320x240)";i:1;s:13:"VGA (640x480)";i:2;s:13:"HD (1280x720)";i:3;s:19:"Full HD (1920x1080)";}', NULL),
(178, 'Тип видеокамеры', 'ru', 'a:4:{i:0;s:21:"Экшн-камеры";i:1;s:35:"Портативные камеры";i:2;s:20:"Камкордеры";i:3;s:71:"Продвинутые и профессиональные камеры";}', NULL),
(176, 'Разрешение видео', 'ru', 'a:6:{i:0;s:10:"1920х1080";i:1;s:10:"1440х1080";i:2;s:9:"1280х720";i:3;s:8:"736х480";i:4;s:8:"720х576";i:5;s:8:"720х480";}', NULL),
(177, 'Тип носителя', 'ru', 'a:4:{i:0;s:18:"Flash память";i:1;s:3:"HDD";i:2;s:11:"HDD + Flash";i:3;s:7:"Mini DV";}', NULL),
(179, 'Раздел', 'ru', 'a:4:{i:0;s:12:"Ремень";i:1;s:12:"Рюкзак";i:2;s:10:"Сумка";i:3;s:10:"Чехол";}', NULL),
(180, 'Максимальное разрешение', 'ru', 'a:3:{i:0;s:19:"Full HD (1920x1080)";i:1;s:9:"1024х576";i:2;s:7:"480x234";}', NULL),
(181, 'Особенности', 'ru', 'a:2:{i:0;s:21:"Поддержка 3D";i:1;s:23:"Поддержка IPTV";}', NULL),
(182, 'Сетевые возможности', 'ru', 'a:3:{i:0;s:8:"Ethernet";i:1;s:5:"Wi-Fi";i:2;s:6:"Нет";}', NULL),
(185, 'Тип аккумулятора', 'ru', 'a:8:{i:0;s:4:"АА";i:1;s:6:"ААА";i:2;s:1:"C";i:3;s:1:"D";i:4;s:6:"CR123A";i:5;s:22:"&quot;Крона&quot;";i:6;s:29:"Батарейный блок";i:7;s:36:"Специализированный";}', NULL),
(186, 'Совместимость', 'ru', 'a:9:{i:0;s:29:"Для видеокамеры";i:1;s:31:"Для фотоаппарата";i:2;s:26:"Универсальные";i:3;s:12:"sovmestimost";i:4;s:5:"Apple";i:5;s:6:"Amazon";i:6;s:4:"Asus";i:7;s:7:"Samsung";i:8;s:6:"Huawei";}', NULL),
(187, 'Тип', 'ru', 'a:47:{i:0;s:17:"NAND-память";i:1;s:16:"SSD-память";i:2;s:20:"Косметички";i:3;s:25:"Деловые сумки";i:4;s:35:"Повседневные сумки";i:5;s:27:"Дорожные сумки";i:6;s:34:"Сумки на колесиках";i:7;s:40:"Чемоданы на колесиках";i:8;s:18:"Портпледы";i:9;s:28:"Сумки для обуви";i:10;s:14:"Рюкзаки";i:11;s:10:"Кокон";i:12;s:12:"Одеяло";i:13;s:39:"Компрессионный мешок";i:14;s:16:"Надувной";i:15;s:14:"Простой";i:16;s:14:"Детские";i:17;s:14:"Ассорти";i:18;s:18:"Свадебные";i:19;s:20:"Подарочные";i:20;s:14:"Элитные";i:21;s:3:"tip";i:22;s:10:"Чехол";i:23;s:10:"Сумка";i:24;s:51:"Сумочка для средств гигиены";i:25;s:36:"Сумочка для мелочей";i:26;s:37:"Сумка туристическая";i:27;s:26:"Сумка на плечо";i:28;s:27:"Сумка кухонная";i:29;s:24:"измельчитель";i:30;s:18:"погружной";i:31;s:24:"стационарный";i:32;s:18:"Бадминтон";i:33;s:20:"Спидминтон";i:34;s:25:"3D LED-телевизор";i:35;s:22:"LED-телевизор";i:36;s:6:"3D LED";i:37;s:28:"LED-телевизор + DVD";i:38;s:4:"ЖК";i:39;s:26:"Виброгасители";i:40;s:18:"Кроссовки";i:41;s:55:"Обмотки для теннисных ракеток";i:42;s:10:"Ручки";i:43;s:31:"Струны теннисные";i:44;s:34:"Чехолы для ракеток";i:45;s:51:"Вкладыш для спального мешка";i:46;s:26:"Сумка на плече";}', NULL),
(188, 'Стандарт памяти', 'ru', 'a:7:{i:0;s:13:"Compact Flash";i:1;s:6:"Eye-Fi";i:2;s:22:"MemoryStick Micro (M2)";i:3;s:19:"MemoryStick PRO Duo";i:4;s:7:"MicroSD";i:5;s:6:"RS MMC";i:6;s:2:"SD";}', NULL),
(189, 'Объём памяти', 'ru', 'a:7:{i:0;s:6:"2 ГБ";i:1;s:6:"4 ГБ";i:2;s:6:"8 ГБ";i:3;s:7:"16 ГБ";i:4;s:7:"32 ГБ";i:5;s:7:"64 ГБ";i:6;s:8:"128 ГБ";}', NULL),
(190, 'Класс', 'ru', 'a:13:{i:0;s:7:"Class 2";i:1;s:7:"Class 4";i:2;s:7:"Class 6";i:3;s:8:"Class 10";i:4;s:5:"UHS-I";i:5;s:24:"Любительские";i:6;s:26:"Тренировочные";i:7;s:27:"Для начинающих";i:8;s:51:"Для игроков среднего уровня";i:9;s:44:"Для продвинутых игроков";i:10;s:35:"Для профессионалов";i:11;s:23:"Для новичков";i:12;s:25:"Для любителей";}', NULL),
(191, 'Поддержка носителей', 'ru', 'a:4:{i:0;s:2:"CD";i:1;s:3:"DVD";i:2;s:3:"USB";i:3;s:6:"SD/MMC";}', NULL),
(192, 'Количество каналов', 'ru', 'a:3:{i:0;s:1:"1";i:1;s:3:"2.0";i:2;s:3:"2.1";}', NULL),
(193, 'Караоке', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(194, 'Поддержка iOS и Android-устройств ', 'ru', 'a:4:{i:0;s:4:"iPad";i:1;s:6:"iPhone";i:2;s:4:"iPod";i:3;s:26:"Android-устройств";}', NULL),
(197, 'Cистема', 'ru', 'a:2:{i:0;s:16:"Активная";i:1;s:18:"Пассивная";}', NULL),
(198, 'Виды сумок', 'ru', 'a:3:{i:0;s:12:"Рюкзак";i:1;s:27:"Сумка-портфель";i:2;s:10:"Чехол";}', NULL),
(199, 'Для ноутбука с размером экрана', 'ru', 'a:6:{i:0;s:13:"до 10&quot;";i:1;s:17:"11&quot;-12&quot;";i:2;s:17:"13&quot;-14&quot;";i:3;s:17:"15&quot;-16&quot;";i:4;s:22:"17&quot; и более";i:5;s:48:"Для портативных устройств";}', NULL),
(200, 'Цвет сумки', 'ru', 'a:22:{i:0;s:12:"Черный";i:1;s:10:"Серый";i:2;s:16:"Бордовый";i:3;s:20:"Коричневый";i:4;s:51:"Черный с голубыми вставками";i:5;s:9:"Cranberry";i:6;s:4:"Navy";i:7;s:14:"Красный";i:8;s:10:"Синий";i:9;s:14:"Розовый";i:10;s:36:"Черный с фиолетовым";i:11;s:14:"Бежевый";i:12;s:21:"Темно-серый";i:13;s:26:"Черный с синим";i:14;s:26:"Черный с серым";i:15;s:19:"Matte Black Chevron";i:16;s:15:"Wet Black Antik";i:17;s:21:"Темно-синий";i:18;s:20:"Фиолетовый";i:19;s:15:"Gray Anthracite";i:20;s:11:"Аnthracite";i:21;s:18:"Оливковый";}', NULL);
INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`, `data`, `description`) VALUES
(201, 'Материал сумки', 'ru', 'a:19:{i:0;s:44:"Водонепроницаемый BombShell";i:1;s:12:"Нейлон";i:2;s:18:"Полиэстер";i:3;s:35:"Жаккард + полиэстер";i:4;s:9:"BombShell";i:5;s:60:"Текстиль + синтетические волокна";i:6;s:35:"Материал EVA + нейлон";i:7;s:8:"Кожа";i:8;s:25:"Прочная ткань";i:9;s:43:"Компрессионный литой EVA";i:10;s:45:"Прессованный материал EVA";i:11;s:14:"Неопрен";i:12;s:3:"EVA";i:13;s:10:"Poly Gucci";i:14;s:33:"Нейлон + полиэстер";i:15;s:26:"Dobby Nylon (нейлон)";i:16;s:20:"Микрозамша";i:17;s:14:"Пластик";i:18;s:14:"Брезент";}', NULL),
(202, 'Назначение', 'ru', 'a:13:{i:0;s:14:"Мужское";i:1;s:14:"Женское";i:2;s:18:"Городские";i:3;s:14:"Детские";i:4;s:29:"Для велотуризма";i:5;s:52:"Для пешего и горного туризма";i:6;s:25:"Для сноуборда";i:7;s:48:"Для экстремальных условий";i:8;s:14:"Детское";i:9;s:14:"Унисекс";i:10;s:22:"Кемпинговая";i:11;s:26:"Туристическая";i:12;s:8:"Тент";}', NULL),
(203, 'Вид', 'ru', 'a:96:{i:0;s:51:"Футболка с коротким рукавом";i:1;s:49:"Футболка с длинным рукавом";i:2;s:47:"Рубашка с длинным рукавом";i:3;s:16:"Кальсоны";i:4;s:10:"Штаны";i:5;s:16:"Комплект";i:6;s:10:"Трусы";i:7;s:10:"Носки";i:8;s:10:"Маска";i:9;s:18:"Балаклава";i:10;s:10:"Шапка";i:11;s:34:"Электроохладители";i:12;s:20:"Термобоксы";i:13;s:10:"Сумки";i:14;s:14:"Рюкзаки";i:15;s:14:"Термосы";i:16;s:10:"Фляги";i:17;s:20:"Аксессуары";i:18;s:10:"Столы";i:19;s:12:"Стулья";i:20;s:22:"Раскладушки";i:21;s:12:"Кресла";i:22;s:10:"Гамак";i:23;s:14:"Шезлонг";i:24;s:10:"Шкафы";i:25;s:25:"Гриль-барбекю";i:26;s:18:"Грильницы";i:27;s:14:"Мангалы";i:28;s:25:"Решетки-гриль";i:29;s:14:"Шампуры";i:30;s:12:"Диваны";i:31;s:14:"Кровати";i:32;s:14:"Матрасы";i:33;s:14:"Подушки";i:34;s:18:"Платформы";i:35;s:12:"Манежи";i:36;s:16:"Бассейны";i:37;s:10:"Круги";i:38;s:12:"Насосы";i:39;s:18:"Паяльники";i:40;s:12:"Резаки";i:41;s:30:"Емкости для воды";i:42;s:16:"Кастрюли";i:43;s:10:"Котлы";i:44;s:12:"Кружки";i:45;s:25:"Наборы посуды";i:46;s:46:"Наборы столовых приборов";i:47;s:27:"Складные ведра";i:48;s:20:"Сковородки";i:49;s:14:"Чайники";i:50;s:8:"Дуги";i:51;s:14:"Каркасы";i:52;s:14:"Колышки";i:53;s:12:"Стойки";i:54;s:26:"Баскетбольные";i:55;s:24:"Волейбольные";i:56;s:37:"Для гандбола и регби";i:57;s:42:"Для пляжного волейбола";i:58;s:20:"Футбольные";i:59;s:20:"Футзальные";i:60;s:14:"Бандажи";i:61;s:10:"Бинты";i:62;s:8:"Капы";i:63;s:16:"Перчатки";i:64;s:14:"Ракушки";i:65;s:16:"Скакалки";i:66;s:10:"Шлемы";i:67;s:10:"Щитки";i:68;s:31:"Корзины складные";i:69;s:14:"Тарелки";i:70;s:12:"Наборы";i:71;s:14:"Ракетки";i:72;s:12:"Воланы";i:73;s:3:"vid";i:74;s:14:"Молотки";i:75;s:16:"Растяжки";i:76;s:22:"Альпенштоки";i:77;s:22:"Экстракторы";i:78;s:16:"Шезлонги";i:79;s:10:"Миски";i:80;s:10:"Брюки";i:81;s:12:"Лосины";i:82;s:20:"Термоноски";i:83;s:33:"Корзинки складные";i:84;s:16:"Дуршлаги";i:85;s:10:"Щетки";i:86;s:16:"Надувной";i:87;s:32:"Подставки для ног";i:88;s:12:"Ручные";i:89;s:16:"Налобные";i:90;s:23:"Фонари-лампы";i:91;s:12:"Домино";i:92;s:29:"Доска шахматная";i:93;s:10:"Нарды";i:94;s:31:"Фигуры шахматные";i:95;s:14:"Шахматы";}', NULL),
(204, 'Размер', 'ru', 'a:243:{i:0;s:10:"74/80 см";i:1;s:10:"86/92 см";i:2;s:11:"98/104 см";i:3;s:12:"110/116 см";i:4;s:12:"122/128 см";i:5;s:3:"XXS";i:6;s:2:"XS";i:7;s:1:"S";i:8;s:3:"S-M";i:9;s:3:"S-L";i:10;s:1:"M";i:11;s:3:"M-L";i:12;s:1:"L";i:13;s:6:"L–XL";i:14;s:2:"XL";i:15;s:3:"XXL";i:16;s:3:"3XL";i:17;s:4:"№2";i:18;s:4:"№3";i:19;s:4:"№4";i:20;s:4:"№5";i:21;s:4:"№6";i:22;s:4:"№7";i:23;s:6:"razmer";i:24;s:4:"№0";i:25;s:4:"№1";i:26;s:8:"100 см";i:27;s:7:"70 см";i:28;s:7:"18 см";i:29;s:7:"28 см";i:30;s:7:"23 см";i:31;s:7:"30 см";i:32;s:7:"52 см";i:33;s:7:"24 см";i:34;s:7:"20 см";i:35;s:7:"27 см";i:36;s:7:"22 см";i:37;s:7:"25 см";i:38;s:7:"14 см";i:39;s:7:"26 см";i:40;s:7:"21 см";i:41;s:7:"16 см";i:42;s:7:"32 см";i:43;s:7:"31 см";i:44;s:7:"38 см";i:45;s:7:"10 см";i:46;s:7:"12 см";i:47;s:6:"9 см";i:48;s:7:"40 см";i:49;s:7:"48 см";i:50;s:7:"33 см";i:51;s:7:"56 см";i:52;s:7:"35 см";i:53;s:7:"17 см";i:54;s:9:"21,5 см";i:55;s:7:"80 см";i:56;s:9:"19,5 см";i:57;s:7:"86 см";i:58;s:7:"85 см";i:59;s:9:"20,5 см";i:60;s:9:"26,5 см";i:61;s:7:"19 см";i:62;s:7:"36 см";i:63;s:9:"14,5 см";i:64;s:10:"19*28 см";i:65;s:10:"20*28 см";i:66;s:7:"44 см";i:67;s:7:"34 см";i:68;s:8:"110 см";i:69;s:11:"до 8 см";i:70;s:6:"7 см";i:71;s:6:"6 см";i:72;s:6:"4 см";i:73;s:6:"8 см";i:74;s:7:"15 см";i:75;s:17:"231х358х44 мм";i:76;s:7:"50 см";i:77;s:7:"11 см";i:78;s:7:"43 см";i:79;s:8:"47х58,5";i:80;s:13:"185х190 мм";i:81;s:13:"254х295 мм";i:82;s:13:"303х235 мм";i:83;s:13:"170х190 мм";i:84;s:13:"206х150 мм";i:85;s:13:"200х175 мм";i:86;s:13:"177х190 мм";i:87;s:13:"215х215 мм";i:88;s:13:"233х302 мм";i:89;s:13:"227х220 мм";i:90;s:13:"295х300 мм";i:91;s:13:"220х190 мм";i:92;s:13:"282х295 мм";i:93;s:13:"210х216 мм";i:94;s:13:"195х222 мм";i:95;s:13:"325х170 мм";i:96;s:13:"262х200 мм";i:97;s:13:"185х150 мм";i:98;s:13:"300х230 мм";i:99;s:15:" 300х230 мм";i:100;s:13:"165х190 мм";i:101;s:13:"625х164 мм";i:102;s:16:"19х12х1,2 см";i:103;s:12:"50,5х15х19";i:104;s:11:"53х53 см";i:105;s:11:"80х80 см";i:106;s:11:"28х20 см";i:107;s:11:"27х23 см";i:108;s:11:"22х16 см";i:109;s:11:"27х21 см";i:110;s:6:"33х26";i:111;s:11:"36х25 см";i:112;s:17:"105х76х105 см";i:113;s:16:"219x122x134 см";i:114;s:20:"168 х 97 х 97 см";i:115;s:22:"127 х 114 х 131 см";i:116;s:22:"147 х 124 х 150 см";i:117;s:21:"160 х 94 х 121 см";i:118;s:22:"160 х 160 х 137 см";i:119;s:16:"167x143x115 см";i:120;s:22:"130 х 207 х 132 см";i:121;s:22:"335 х 140 х 168 см";i:122;s:20:"51 х 59 х 147 см";i:123;s:20:"74 х 81 х 260 см";i:124;s:14:"101x74x96 см";i:125;s:13:"38x38x46 см";i:126;s:21:"136 х 113 х 55 см";i:127;s:20:"120 х 83 х 48 см";i:128;s:14:"143x74x50 см";i:129;s:6:"23см";i:130;s:7:"92 см";i:131;s:7:"55 см";i:132;s:10:"33х22х21";i:133;s:16:"24,3х21,6х22,3";i:134;s:14:"20,3х20,3х18";i:135;s:12:"40х35х13,3";i:136;s:12:"19х19х24,1";i:137;s:18:"50,80х12,7х25,40";i:138;s:17:"24,15х9,55х45,7";i:139;s:14:"38х25х8 см";i:140;s:18:"15,25х15,25х12,7";i:141;s:11:"21х7х26,5";i:142;s:10:"45х14х13";i:143;s:17:"12,7х12,7х22,86";i:144;s:11:"25х14 см";i:145;s:17:"16,5х18,15х17,8";i:146;s:14:"15,2х15,2х18";i:147;s:16:"31х9х30,5 см";i:148;s:16:"37х9,5х22 см";i:149;s:16:"16,5х10,8х32,4";i:150;s:17:"17,8х6,35х26,05";i:151;s:13:"15,3х6,3х21";i:152;s:7:"13 см";i:153;s:11:"14х85 см";i:154;s:12:"100x100 см";i:155;s:13:"140х115 см";i:156;s:10:"90x90 см";i:157;s:13:"25,4х4,5х23";i:158;s:11:"21,6х9х23";i:159;s:14:"35,6х15,3х21";i:160;s:14:"27,3х14,6х21";i:161;s:10:"28х14х23";i:162;s:14:"25,4х14х23,8";i:163;s:16:"25,4х10,8х25,4";i:164;s:16:"15,25х5,8х20,3";i:165;s:15:"10,2х5,1х20,3";i:166;s:13:"6,4х13х20,7";i:167;s:13:"38,1х7х25,4";i:168;s:14:"40,6х17,8х16";i:169;s:19:"31,5х18,5х10 см";i:170;s:10:"32х28х20";i:171;s:14:"31х25,5х17,5";i:172;s:14:"31,5х18,5х10";i:173;s:12:"46,5x27x19,5";i:174;s:12:"7х4х7 см";i:175;s:12:"40х16,5х33";i:176;s:10:"19х17х31";i:177;s:15:"32х20х18 см";i:178;s:10:"32х20х18";i:179;s:12:"42х17х26,5";i:180;s:10:"19х19х20";i:181;s:19:"36х13,5х17,5 см";i:182;s:10:"53х36х52";i:183;s:10:"46х41х83";i:184;s:10:"33х24х33";i:185;s:15:"36х15х26 см";i:186;s:12:"25х12х15,5";i:187;s:17:"29,5x24,5x14 см";i:188;s:14:"36х13,5х17,5";i:189;s:19:"46х12,5х37,3 см";i:190;s:14:"46х12,5х37,3";i:191;s:15:"26х18х15 см";i:192;s:10:"26х18х15";i:193;s:12:"18х18х18,5";i:194;s:13:"19x18x18 см";i:195;s:15:"27,7х37,7х7,5";i:196;s:12:"27х15,5х28";i:197;s:14:"28,2х16,5х29";i:198;s:10:"29х19х15";i:199;s:10:"25х11х41";i:200;s:10:"17х17х23";i:201;s:14:"8х11х21 см";i:202;s:14:"19.5x19x7 см";i:203;s:14:"17,5х13х14,8";i:204;s:15:"13x18.5x20 см";i:205;s:12:"18х12,3х16";i:206;s:10:"20х18х17";i:207;s:18:"22x21.5x6.5 см ";i:208;s:12:"37x10,5x20,5";i:209;s:10:"38х15х17";i:210;s:14:"32,5х23х15,5";i:211;s:8:"61x26x42";i:212;s:10:"70x37,5x49";i:213;s:15:"55х 25,6х43,8";i:214;s:16:"54,5х28,5х47,5";i:215;s:18:" 54,5х28,5х47,5";i:216;s:10:"57х25х36";i:217;s:8:"55x28x46";i:218;s:14:"52,5х23,5х48";i:219;s:14:"21,5х21,5х26";i:220;s:11:"33,5х6х50";i:221;s:10:"15х15х25";i:222;s:16:"30,5х20,4х21,6";i:223;s:21:"20,3х30,5х21,6 см";i:224;s:16:"15,2х25,4х35,5";i:225;s:10:"38х15х27";i:226;s:12:"26х19х27,9";i:227;s:19:"17,78х21,92х33,02";i:228;s:13:"14х7,5х19,1";i:229;s:21:"17,8 х 8 х21,6 см";i:230;s:11:"23х6,5х24";i:231;s:11:"23х8х30,5";i:232;s:12:"23х19,5х30";i:233;s:10:"51х40х89";i:234;s:10:"47х29х70";i:235;s:10:"46х28х80";i:236;s:7:"60 см";i:237;s:6:"60см";i:238;s:8:"105 см";i:239;s:6:"70см";i:240;s:10:"44х30х48";i:241;s:7:"54 см";i:242;s:7:"64 см";}', NULL),
(206, 'Объем рюкзака', 'ru', 'a:19:{i:0;s:20:"До 35 литров";i:1;s:28:"От 35 до 65 литров";i:2;s:29:"От 65 до 100 литров";i:3;s:27:"Свыше 100 литров";i:4;s:5:"25 л";i:5;s:5:"35 л";i:6;s:5:"60 л";i:7;s:5:"65 л";i:8;s:5:"85 л";i:9;s:5:"10 л";i:10;s:5:"30 л";i:11;s:5:"70 л";i:12;s:5:"22 л";i:13;s:4:"18л";i:14;s:6:"110 л";i:15;s:5:"90 л";i:16;s:5:"40 л";i:17;s:5:"32 л";i:18;s:5:"38 л";}', NULL),
(207, 'Тип топлива', 'ru', 'a:2:{i:0;s:34:"На твердом топливе";i:1;s:14:"Газовые";}', NULL),
(208, 'Количество персон', 'ru', 'a:3:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"6";}', NULL),
(209, 'Система смыва', 'ru', 'a:2:{i:0;s:35:"Механическая помпа";i:1;s:23:"Ручная помпа";}', NULL),
(210, 'Ручная помпа', 'ru', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', NULL),
(211, 'Применение', 'ru', 'a:3:{i:0;s:31:"Всепогодный стол";i:1;s:42:"Для закрытых помещений";i:2;s:14:"Уличные";}', NULL),
(212, 'Цвет поверхности', 'ru', 'a:4:{i:0;s:14:"Зеленый";i:1;s:10:"Серый";i:2;s:10:"Синий";i:3;s:24:"Терракотовый";}', NULL),
(213, 'Форма ручки', 'ru', 'a:4:{i:0;s:26:"Анатомическая";i:1;s:16:"Вогнутая";i:2;s:20:"Коническая";i:3;s:12:"Прямая";}', NULL),
(214, 'Стиль игры', 'ru', 'a:5:{i:0;s:38:"Для атакующего стиля";i:1;s:36:"Для защитного стиля";i:2;s:26:"Универсальная";i:3;s:16:"Защитный";i:4;s:18:"Атакующий";}', NULL),
(215, 'Тип матрицы', 'ru', 'a:4:{i:0;s:3:"MVA";i:1;s:3:"IPS";i:2;s:2:"TN";i:3;s:3:"PLS";}', NULL),
(216, 'Ключевые технологии', 'ru', 'a:2:{i:0;s:22:"LED-подсветка";i:1;s:27:"LED-подсветка + 3D";}', NULL),
(217, 'Соотношение сторон', 'ru', 'a:5:{i:0;s:4:"16:9";i:1;s:3:"4:3";i:2;s:5:"16:10";i:3;s:3:"5:4";i:4;s:5:"16:09";}', NULL),
(218, 'Тип крепления', 'ru', 'a:2:{i:0;s:33:"Быстрое крепление";i:1;s:35:"Винтовое крепление";}', NULL),
(219, 'Угол обзора по вертикали', 'ru', 'a:8:{i:0;s:20:"178 градусов";i:1;s:20:"160 градусов";i:2;s:19:"65 градусов";i:3;s:19:"50 градусов";i:4;s:19:"90 градусов";i:5;s:20:"170 градусов";i:6;s:20:"176 градусов";i:7;s:19:"60 градусов";}', NULL),
(220, 'Угол обзора по горизонтали', 'ru', 'a:7:{i:0;s:20:"178 градусов";i:1;s:20:"170 градусов";i:2;s:19:"90 градусов";i:3;s:20:"160 градусов";i:4;s:19:"50 градусов";i:5;s:20:"176 градусов";i:6;s:19:"65 градусов";}', NULL),
(221, 'Яркость монитора', 'ru', 'a:8:{i:0;s:12:"300 кд/м2";i:1;s:12:"250 кд/м2";i:2;s:12:"200 кд/м2";i:3;s:12:"350 кд/м2";i:4;s:12:"400 кд/м2";i:5;s:12:"250 кд/м?";i:6;s:12:"450 кд/м2";i:7;s:12:"285 кд/м?";}', NULL),
(222, 'Время отклика', 'ru', 'a:13:{i:0;s:6:"6 мс";i:1;s:6:"5 мс";i:2;s:6:"1 мс";i:3;s:6:"2 мс";i:4;s:6:"8 мс";i:5;s:7:"14 мс";i:6;s:8:"3.5 мс";i:7;s:8:"8.5 мс";i:8;s:8:"9.5 мс";i:9;s:8:"1.5 мс";i:10;s:6:"7 мс";i:11;s:7:"12 мс";i:12;s:6:"4 мс";}', NULL),
(223, 'ТV-тюнер', 'ru', 'a:2:{i:0;s:6:"Нет";i:1;s:8:"Есть";}', NULL),
(224, 'Возрастная категория', 'ru', 'a:7:{i:0;s:14:"Детские";i:1;s:18:"Юниорские";i:2;s:16:"Взрослые";i:3;s:12:"tipkrepleniy";i:4;s:33:"Быстрое крепление";i:5;s:35:"Винтовое крепление";i:6;s:19:"vozrostnaykategoriy";}', NULL),
(225, 'Цвет монитора', 'ru', 'a:7:{i:0;s:5:"Black";i:1;s:5:"White";i:2;s:9:"Black-Red";i:3;s:12:"Silver-Black";i:4;s:11:"Black-White";i:5;s:6:"Silver";i:6;s:5:"Other";}', NULL),
(310, 'Аккумулятор ', 'ru', 'a:7:{i:0;s:23:"от 1000 до 1500 mAh";i:1;s:23:"от 1500 до 2000 mAh";i:2;s:23:"от 2000 до 3000 mAh";i:3;s:13:"от 3000 mAh";i:4;s:11:"akamulatorl";i:5;s:552:"Li-Ion BP-3L 1300 mAh аккумулятор</p><p>Максимальное время разговора в сети 2G: 8.7 ч.</p><p>Максимальное время работы в режиме ожидания в сети GSM: 540 ч.</p><p>Максимальное время разговора в сети 3G: 6.5 ч.</p><p>Максимальное время работы в режиме ожидания (3G): 540 ч.</p><p>Максимальное время работы в режиме воспроизведения музыки: 68 ч.";i:6;s:700:"Nokia BP-3L 3.7 В 1300 мАч</p><p>Максимальное время разговора в сети 2G: 6.9 часов</p><p>Максимальное время работы в режиме ожидания в сети GSM: 400 часов</p><p>Максимальное время разговора в сети 3G: 7.6 часов</p><p>Максимальное время работы в режиме ожидания (3G): 400 часов</p><p>Максимальное время работы в режиме воспроизведения музыки: 38 часов</p><p>Максимальное время работы в режиме воспроизведения видео: 6 часов";}', NULL),
(226, 'Встроенные колонки', 'ru', 'a:9:{i:0;s:6:"Нет";i:1;s:8:"2x1 Вт";i:2;s:11:"2х1.5 Вт";i:3;s:8:"Есть";i:4;s:9:"2х5 Вт";i:5;s:9:"2х2 Вт";i:6;s:8:"2x3 Вт";i:7;s:10:"2x1.5 Вт";i:8;s:9:"2х4 Вт";}', NULL),
(227, 'Количество в упаковке', 'ru', 'a:4:{i:0;s:12:"3 штуки";i:1;s:12:"4 штуки";i:2;s:1:"4";i:3;s:1:"3";}', NULL),
(228, 'Серия монитора', 'ru', 'a:3:{i:0;s:22:"Графический";i:1;s:32:"Профессиональный";i:2;s:18:"Бюджетный";}', NULL),
(229, 'Тип фотоальбома', 'ru', 'a:5:{i:0;s:14:"Детские";i:1;s:14:"Ассорти";i:2;s:18:"Свадебные";i:3;s:20:"Подарочные";i:4;s:14:"Элитные";}', NULL),
(230, 'Количество фотографий', 'ru', 'a:12:{i:0;s:7:"до 48";i:1;s:2:"56";i:2;s:5:"80-96";i:3;s:7:"100-104";i:4;s:7:"120-160";i:5;s:3:"192";i:6;s:3:"200";i:7;s:3:"260";i:8;s:3:"300";i:9;s:3:"400";i:10;s:3:"500";i:11;s:35:"Неформатный альбом";}', NULL),
(231, 'Цвет чехла', 'ru', 'a:35:{i:0;s:10:"cvetchehla";i:1;s:27:"Черный матовый";i:2;s:14:"Красный";i:3;s:14:"Зеленый";i:4;s:12:"Черный";i:5;s:20:"Коричневый";i:6;s:14:"Розовый";i:7;s:20:"Фиолетовый";i:8;s:10:"Синий";i:9;s:10:"Light Gray";i:10;s:18:"Пурпурный";i:11;s:5:"Black";i:12;s:4:"Pink";i:13;s:5:"Morel";i:14;s:13:"Gotham Purple";i:15;s:10:"Серый";i:16;s:9:"Dark Blue";i:17;s:16:"Бордовый";i:18;s:5:"Phlox";i:19;s:10:"Белый";i:20;s:21:"Темно-серый";i:21;s:14:"Голубой";i:22;s:23:"Светло-серый";i:23;s:18:"Оранжевый";i:24;s:18:"Аквамарин";i:25;s:18:"Бирюзовый";i:26;s:18:"Бронзовый";i:27;s:22:"Серебристый";i:28;s:30:"Черный с розовым";i:29;s:26:"Черный с серым";i:30;s:53:"Черный с флюрисцентым желтым";i:31;s:9:"Cерый";i:32;s:34:"Коричневый с серым";i:33;s:12:"Желтый";i:34;s:30:"Черный с красным";}', NULL),
(232, 'Пыле-влаго защита', 'ru', 'a:3:{i:0;s:9:"pilevlago";i:1;s:8:"Есть";i:2;s:6:"Нет";}', NULL),
(298, 'Высота (см)', 'ru', 'a:136:{i:0;s:12:"visotamebeli";i:1;s:3:"165";i:2;s:3:"150";i:3;s:3:"164";i:4;s:3:"170";i:5;s:3:"160";i:6;s:2:"60";i:7;s:3:"157";i:8;s:3:"238";i:9;s:3:"167";i:10;s:3:"193";i:11;s:3:"180";i:12;s:3:"220";i:13;s:3:"175";i:14;s:2:"80";i:15;s:3:"249";i:16;s:3:"178";i:17;s:3:"145";i:18;s:3:"189";i:19;s:3:"158";i:20;s:3:"143";i:21;s:2:"78";i:22;s:2:"84";i:23;s:2:"83";i:24;s:2:"85";i:25;s:2:"79";i:26;s:2:"76";i:27;s:1:"4";i:28;s:3:"210";i:29;s:3:"120";i:30;s:2:"70";i:31;s:2:"45";i:32;s:2:"50";i:33;s:2:"90";i:34;s:3:"208";i:35;s:3:"188";i:36;s:2:"72";i:37;s:2:"86";i:38;s:2:"65";i:39;s:2:"49";i:40;s:2:"51";i:41;s:2:"63";i:42;s:3:"154";i:43;s:2:"64";i:44;s:2:"75";i:45;s:3:"122";i:46;s:3:"330";i:47;s:3:"250";i:48;s:3:"270";i:49;s:3:"260";i:50;s:3:"350";i:51;s:3:"300";i:52;s:3:"105";i:53;s:2:"41";i:54;s:2:"27";i:55;s:2:"40";i:56;s:1:"8";i:57;s:2:"35";i:58;s:2:"38";i:59;s:2:"44";i:60;s:2:"42";i:61;s:2:"48";i:62;s:2:"34";i:63;s:2:"55";i:64;s:2:"71";i:65;s:2:"74";i:66;s:2:"77";i:67;s:2:"89";i:68;s:2:"92";i:69;s:2:"88";i:70;s:2:"81";i:71;s:2:"96";i:72;s:2:"87";i:73;s:2:"94";i:74;s:3:"108";i:75;s:3:"110";i:76;s:2:"93";i:77;s:3:"109";i:78;s:3:"107";i:79;s:3:"104";i:80;s:3:"114";i:81;s:2:"29";i:82;s:4:"12,5";i:83;s:2:"32";i:84;s:2:"21";i:85;s:2:"10";i:86;s:3:"7,5";i:87;s:4:"30,5";i:88;s:3:"4,5";i:89;s:4:"18,5";i:90;s:3:"6,5";i:91;s:1:"6";i:92;s:2:"14";i:93;s:2:"30";i:94;s:4:"29,5";i:95;s:2:"20";i:96;s:3:"7,6";i:97;s:2:"25";i:98;s:2:"11";i:99;s:2:"22";i:100;s:4:"47,5";i:101;s:2:"24";i:102;s:2:"15";i:103;s:4:"26,5";i:104;s:4:"11,5";i:105;s:3:"8,5";i:106;s:3:"9,5";i:107;s:4:"14,5";i:108;s:3:"130";i:109;s:4:"25,5";i:110;s:4:"37,5";i:111;s:2:"31";i:112;s:3:"153";i:113;s:2:"37";i:114;s:2:"23";i:115;s:4:"42,5";i:116;s:4:"21,5";i:117;s:4:"20,5";i:118;s:3:"155";i:119;s:2:"19";i:120;s:2:"36";i:121;s:2:"28";i:122;s:4:"39,5";i:123;s:2:"52";i:124;s:5:"114,5";i:125;s:3:"137";i:126;s:3:"147";i:127;s:3:"123";i:128;s:5:"118,5";i:129;s:2:"39";i:130;s:5:"153,5";i:131;s:4:"32,5";i:132;s:2:"43";i:133;s:4:"24,5";i:134;s:3:"670";i:135;s:3:"750";}', NULL),
(296, 'Глубина (см)', 'ru', 'a:57:{i:0;s:13:"glubinamebeli";i:1;s:3:"130";i:2;s:2:"90";i:3;s:2:"52";i:4;s:2:"92";i:5;s:2:"88";i:6;s:2:"60";i:7;s:2:"74";i:8;s:2:"69";i:9;s:2:"80";i:10;s:2:"86";i:11;s:2:"95";i:12;s:3:"163";i:13;s:3:"100";i:14;s:2:"55";i:15;s:2:"68";i:16;s:2:"75";i:17;s:2:"78";i:18;s:2:"84";i:19;s:2:"58";i:20;s:2:"83";i:21;s:2:"87";i:22;s:2:"63";i:23;s:3:"120";i:24;s:3:"110";i:25;s:2:"73";i:26;s:2:"53";i:27;s:2:"61";i:28;s:2:"70";i:29;s:2:"56";i:30;s:2:"45";i:31;s:2:"79";i:32;s:2:"47";i:33;s:2:"44";i:34;s:2:"64";i:35;s:2:"49";i:36;s:2:"50";i:37;s:3:"122";i:38;s:3:"250";i:39;s:3:"260";i:40;s:3:"300";i:41;s:3:"200";i:42;s:2:"46";i:43;s:2:"96";i:44;s:2:"43";i:45;s:2:"66";i:46;s:2:"40";i:47;s:2:"65";i:48;s:2:"59";i:49;s:2:"67";i:50;s:2:"42";i:51;s:2:"72";i:52;s:2:"76";i:53;s:3:"112";i:54;s:3:"109";i:55;s:2:"71";i:56;s:3:"172";}', NULL),
(297, 'Ширина (см)', 'ru', 'a:107:{i:0;s:13:"shirinamebeli";i:1;s:2:"80";i:2;s:2:"95";i:3;s:2:"99";i:4;s:2:"84";i:5;s:2:"45";i:6;s:2:"66";i:7;s:2:"74";i:8;s:2:"83";i:9;s:2:"85";i:10;s:2:"65";i:11;s:2:"86";i:12;s:2:"87";i:13;s:2:"81";i:14;s:2:"42";i:15;s:2:"55";i:16;s:2:"76";i:17;s:2:"44";i:18;s:2:"18";i:19;s:2:"17";i:20;s:2:"43";i:21;s:2:"46";i:22;s:2:"39";i:23;s:2:"59";i:24;s:2:"48";i:25;s:2:"47";i:26;s:2:"41";i:27;s:2:"40";i:28;s:2:"90";i:29;s:3:"100";i:30;s:2:"49";i:31;s:3:"120";i:32;s:3:"155";i:33;s:3:"212";i:34;s:3:"180";i:35;s:3:"170";i:36;s:3:"110";i:37;s:3:"115";i:38;s:3:"130";i:39;s:2:"70";i:40;s:2:"60";i:41;s:2:"50";i:42;s:3:"220";i:43;s:3:"240";i:44;s:3:"300";i:45;s:3:"210";i:46;s:3:"122";i:47;s:3:"230";i:48;s:2:"56";i:49;s:2:"57";i:50;s:2:"58";i:51;s:2:"61";i:52;s:2:"62";i:53;s:2:"54";i:54;s:2:"68";i:55;s:2:"64";i:56;s:2:"63";i:57;s:3:"145";i:58;s:3:"200";i:59;s:3:"146";i:60;s:3:"202";i:61;s:3:"205";i:62;s:3:"176";i:63;s:3:"203";i:64;s:3:"135";i:65;s:3:"187";i:66;s:2:"37";i:67;s:2:"13";i:68;s:2:"12";i:69;s:2:"34";i:70;s:1:"8";i:71;s:2:"26";i:72;s:4:"10,5";i:73;s:3:"6,5";i:74;s:1:"7";i:75;s:2:"14";i:76;s:1:"9";i:77;s:2:"24";i:78;s:1:"6";i:79;s:2:"11";i:80;s:2:"23";i:81;s:3:"7,6";i:82;s:2:"25";i:83;s:2:"36";i:84;s:2:"71";i:85;s:4:"90,5";i:86;s:3:"8,5";i:87;s:4:"19,5";i:88;s:4:"35,5";i:89;s:4:"16,5";i:90;s:2:"10";i:91;s:2:"16";i:92;s:2:"28";i:93;s:3:"9,5";i:94;s:3:"7,5";i:95;s:3:"3,6";i:96;s:3:"2,3";i:97;s:4:"29,5";i:98;s:2:"20";i:99;s:2:"21";i:100;s:2:"15";i:101;s:2:"19";i:102;s:4:"20,5";i:103;s:4:"22,5";i:104;s:4:"12,5";i:105;s:3:"820";i:106;s:3:"850";}', NULL),
(293, 'Тип', 'ru', 'a:4:{i:0;s:15:"С грилем";i:1;s:39:"С грилем и конвекцией";i:2;s:23:"С конвекцией";i:3;s:8:"Соло";}', NULL),
(295, 'Мощность', 'ru', 'a:86:{i:0;s:4:"4X6W";i:1;s:4:"1X6W";i:2;s:4:"5X6W";i:3;s:4:"3X6W";i:4;s:3:"18W";i:5;s:3:"24W";i:6;s:3:"12W";i:7;s:10:"6W (12LED)";i:8;s:14:"2X3W (2X6 LED)";i:9;s:6:"2X3,4W";i:10;s:7:"1X4,76W";i:11;s:13:"21W (132 LED)";i:12;s:6:"1X4,5W";i:13;s:6:"2X4,5W";i:14;s:6:"4X4,5W";i:15;s:6:"4X2,5W";i:16;s:6:"6X2,5W";i:17;s:6:"2X2,5W";i:18;s:6:"3X2,5W";i:19;s:6:"1X2,5W";i:20;s:4:"6X3W";i:21;s:4:"1X3W";i:22;s:4:"2X3W";i:23;s:4:"4X3W";i:24;s:4:"3X5W";i:25;s:4:"4X5W";i:26;s:4:"6X5W";i:27;s:4:"1X5W";i:28;s:6:"4X4,6W";i:29;s:6:"3X4,6W";i:30;s:6:"1X4,6W";i:31;s:6:"2X4,6W";i:32;s:4:"2X5W";i:33;s:6:"1X7,5W";i:34;s:6:"2X7,5W";i:35;s:6:"4X7,5W";i:36;s:7:"4X4,76W";i:37;s:7:"2X4,76W";i:38;s:4:"3X3W";i:39;s:13:"7,5W (15 LED)";i:40;s:4:"3X1W";i:41;s:4:"6X1W";i:42;s:5:"3X60W";i:43;s:5:"1X60W";i:44;s:5:"3X33W";i:45;s:5:"5X33W";i:46;s:5:"1X33W";i:47;s:5:"1X40W";i:48;s:5:"3X40W";i:49;s:5:"6X40W";i:50;s:5:"1X50W";i:51;s:5:"2X33W";i:52;s:12:"4X6W 4X1,65W";i:53;s:5:"5X35W";i:54;s:7:"5X2,38W";i:55;s:7:"7X4,76W";i:56;s:5:"4X35W";i:57;s:5:"3X35W";i:58;s:5:"1X35W";i:59;s:5:"1X55W";i:60;s:5:"1X22W";i:61;s:5:"1X21W";i:62;s:5:"1X14W";i:63;s:4:"1X8W";i:64;s:5:"1X80W";i:65;s:5:"2X40W";i:66;s:5:"1X18W";i:67;s:5:"1X15W";i:68;s:5:"1X36W";i:69;s:5:"1X30W";i:70;s:5:"1X28W";i:71;s:5:"1X13W";i:72;s:5:"2X60W";i:73;s:5:"5X60W";i:74;s:5:"4X33W";i:75;s:5:"8X60W";i:76;s:5:"4X60W";i:77;s:5:"6X60W";i:78;s:9:"2X18W 17W";i:79;s:5:"5X40W";i:80;s:5:"1X48W";i:81;s:5:"3X48W";i:82;s:5:"3X50W";i:83;s:11:"1X55W 8,64W";i:84;s:4:"4X9W";i:85;s:6:"1X100W";}', NULL),
(233, 'Возраст', 'ru', 'a:21:{i:0;s:7:"Vozrast";i:1;s:21:"от 1 до 12 лет";i:2;s:24:"от 0-12 месяцев";i:3;s:29:"от 0 до 12 месяцев";i:4;s:21:"от 0 месяцев";i:5;s:21:"от 5 месяцев";i:6;s:21:"от 3 месяцев";i:7;s:21:"от 6 месяцев";i:8;s:20:"от 3 до 5 лет";i:9;s:22:"от 0 до 1 года";i:10;s:21:"от 7 до 12 лет";i:11;s:20:"от 5 до 7 лет";i:12;s:22:"старше 12 лет";i:13;s:13:"от 4 лет";i:14;s:13:"от 6 лет";i:15;s:20:"от 1 до 2 лет";i:16;s:20:"от 2 до 3 лет";i:17;s:20:"от 0 до 2 лет";i:18;s:13:"от 2 лет";i:19;s:14:"от 0 мес.";i:20;s:20:"от 0 до 5 мес";}', NULL),
(234, 'Вес ребенка', 'ru', 'a:2:{i:0;s:10:"Vesrebenka";i:1;s:14:"от 9 до 36";}', NULL),
(235, 'Количество точек крепления', 'ru', 'a:2:{i:0;s:11:"Kolvotochek";i:1;s:1:"5";}', NULL),
(236, 'Группа безопасности ', 'ru', 'a:2:{i:0;s:6:"Gryppa";i:1;s:5:"1-2-3";}', NULL),
(237, 'Тип дисплея', 'ru', 'a:3:{i:0;s:14:"Обычный";i:1;s:11:"Multi-Touch";i:2;s:12:"Single-Touch";}', NULL),
(238, 'Размораживание', 'ru', 'a:3:{i:0;s:12:"Ручное";i:1;s:28:"Автоматическое";i:2;s:8:"No Frost";}', NULL),
(239, 'Суперзаморозка', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(240, 'Мощность замораживания', 'ru', 'a:3:{i:0;s:4:"3-10";i:1;s:5:"11-20";i:2;s:13:"свыше 20";}', NULL),
(241, 'Автономное сохранение холода', 'ru', 'a:3:{i:0;s:15:"0-15 часов";i:1;s:16:"16-25 часов";i:2;s:16:"26-50 часов";}', NULL),
(242, 'Уровень шума,Дб', 'ru', 'a:3:{i:0;s:5:"40-45";i:1;s:5:"50-55";i:2;s:5:"46-50";}', NULL),
(243, 'Перевешиваемые двери', 'ru', 'a:3:{i:0;s:8:"Есть";i:1;s:6:"Нет";i:2;s:4:"Да";}', NULL),
(244, 'Антибактериальное покрытие', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(246, 'Диагональ', 'ru', 'a:31:{i:0;s:8:"42&quot;";i:1;s:8:"46&quot;";i:2;s:8:"47&quot;";i:3;s:8:"32&quot;";i:4;s:8:"40&quot;";i:5;s:8:"22&quot;";i:6;s:8:"19&quot;";i:7;s:8:"50&quot;";i:8;s:8:"55&quot;";i:9;s:8:"60&quot;";i:10;s:8:"37&quot;";i:11;s:8:"39&quot;";i:12;s:8:"28&quot;";i:13;s:8:"65&quot;";i:14;s:10:"18.5&quot;";i:15;s:10:"21.5&quot;";i:16;s:8:"24&quot;";i:17;s:8:"23&quot;";i:18;s:8:"21&quot;";i:19;s:8:"26&quot;";i:20;s:8:"27&quot;";i:23;s:8:"15&quot;";i:24;s:3:"42"";i:25;s:3:"50"";i:26;s:3:"55"";i:27;s:3:"65"";i:28;s:3:"43"";i:29;s:3:"51"";i:30;s:3:"59"";i:31;s:3:"60"";i:32;s:3:"64"";}', NULL),
(247, 'Разрешение', 'ru', 'a:9:{i:0;s:9:"1920x1080";i:1;s:8:"1366x768";i:2;s:10:"1920х1080";i:3;s:8:"1024x768";i:4;s:9:"1366х768";i:5;s:10:"1680х1050";i:6;s:9:"1365х768";i:7;s:10:"1280х1024";i:8;s:7:"852x480";}', NULL),
(248, 'Формат экрана', 'ru', 'a:4:{i:0;s:4:"16:9";i:1;s:3:"4:3";i:2;s:5:"16:09";i:3;s:4:"4:03";}', NULL),
(249, 'Прогрессивная развертка', 'ru', '', NULL),
(250, 'Частота', 'ru', 'a:18:{i:0;s:8:"200 Гц";i:1;s:8:"700 Гц";i:2;s:9:"1400 Гц";i:3;s:8:"400 Гц";i:4;s:8:"100 ГЦ";i:5;s:7:"50 Гц";i:6;s:8:"600 Гц";i:7;s:8:"100 Гц";i:8;s:9:"1000 Гц";i:9;s:8:"300 Гц";i:10;s:9:"1600 Гц";i:11;s:8:"800 Гц";i:12;s:9:"1200 Гц";i:13;s:8:"200 ГЦ";i:14;s:8:"800 гЦ";i:15;s:8:"150 Гц";i:16;s:7:"60 Гц";i:17;s:9:"2500 Гц";}', NULL),
(251, 'Стереозвук', 'ru', 'a:16:{i:0;s:8:"Есть";i:1;s:18:"Dolby Digital Plus";i:2;s:55:"Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio";i:3;s:59:"Dolby Digital Plus, DTS Sound Studio, DTS Premium Audio 5.1";i:4;s:16:"Virtual Surround";i:5;s:12:"Nicam Stereo";i:6;s:19:"SRS TheaterSound HD";i:7;s:58:"Dolby Digital Plus; Dolby Pulse; DTS 2.0; SRS TheaterSound";i:8;s:20:"Infinite 3D Surround";i:9;s:16:"SRS TheaterSound";i:10;s:29:"Dolby Digital, Clear Voice II";i:11;s:67:"Dolby Digital Plus / Pulse, DTS Sound Studio, DTS Premium Audio 5.1";i:12;s:34:"3D Dolby Digital Plus, Dolby Pulse";i:13;s:26:"Dolby Digital Plus / Pulse";i:14;s:32:"Dolby Digital Plus / Dolby Pulse";i:15;s:73:"Dolby Digital Plus / Dolby Pulse, DTS Sound Studio, DTS Premium Audio 5.1";}', NULL),
(252, 'Количество динамиков', 'ru', 'a:3:{i:0;s:6:"2 шт";i:1;s:6:"3 шт";i:2;s:6:"4 шт";}', NULL),
(253, 'Мощность звука', 'ru', 'a:17:{i:0;s:10:"2х10 Вт";i:1;s:10:"2х12 Вт";i:2;s:10:"2х15 Вт";i:3;s:9:"2х5 Вт";i:4;s:9:"2х3 Вт";i:5;s:11:"2х2.5 Вт";i:6;s:10:"2х20 Вт";i:7;s:20:"2х4 Вт,1х10 Вт";i:8;s:10:"2х14 Вт";i:9;s:8:"3x2 Вт";i:10;s:9:"2х7 Вт";i:11;s:9:"2х8 Вт";i:12;s:11:"2х1.5 Вт";i:13;s:7:"30 Вт";i:14;s:19:"2х4 Вт,1x10 Вт";i:15;s:9:"4х5 Вт";i:16;s:11:"2х2,5 Вт";}', NULL),
(254, 'TV-тюнер', 'ru', '', NULL),
(255, 'Таймер сна', 'ru', '', NULL),
(256, 'Телетекст', 'ru', '', NULL),
(257, 'Защита от детей', 'ru', '', NULL),
(258, 'Сабвуфер', 'ru', '', NULL),
(260, 'Коллекция', 'ru', 'a:231:{i:0;s:8:"Frossini";i:1;s:9:"Watercube";i:2;s:5:"Amigo";i:3;s:6:"Childe";i:4;s:5:"Milan";i:5;s:9:"San Pedro";i:6;s:5:"Devon";i:7;s:5:"Jalor";i:8;s:10:"Blockhouse";i:9;s:11:"Beach house";i:10;s:6:"Resort";i:11;s:8:"Zanzibar";i:12;s:5:"Curve";i:13;s:8:"Brighton";i:14;s:7:"Del Mar";i:15;s:7:"Delgado";i:16;s:8:"Eldorado";i:17;s:8:"Kingston";i:18;s:5:"Lodge";i:19;s:5:"Luton";i:20;s:7:"Madoera";i:21;s:6:"Malibu";i:22;s:5:"Mambo";i:23;s:7:"Paddock";i:24;s:8:"Somerset";i:25;s:6:"Sussex";i:26;s:9:"Valentine";i:27;s:11:"Westminster";i:28;s:27:"Kingston Модульный";i:29;s:8:"Aberdeen";i:30;s:5:"Aspen";i:31;s:4:"Hugo";i:32;s:5:"Nexxt";i:33;s:7:"Pacific";i:34;s:5:"Plaza";i:35;s:6:"Quartz";i:36;s:7:"Sentosa";i:37;s:7:"Storage";i:38;s:5:"Bases";i:39;s:7:"Riviera";i:40;s:8:"Shanghai";i:41;s:6:"Siesta";i:42;s:6:"Toledo";i:43;s:4:"Casa";i:44;s:6:"Venice";i:45;s:8:"Galleria";i:46;s:5:"Wales";i:47;s:4:"Lado";i:48;s:6:"London";i:49;s:4:"Eton";i:50;s:7:"Extreme";i:51;s:5:"Lazio";i:52;s:6:"Refton";i:53;s:4:"Baya";i:54;s:6:"Breeze";i:55;s:4:"Elle";i:56;s:5:"Urban";i:57;s:7:"Alberta";i:58;s:4:"Coni";i:59;s:5:"Calma";i:60;s:6:"Angelo";i:61;s:7:"Lattera";i:62;s:3:"Bar";i:63;s:7:"Pioggia";i:64;s:7:"Perlina";i:65;s:5:"Sfera";i:66;s:7:"Marcelo";i:67;s:7:"Cilento";i:68;s:7:"Cottura";i:69;s:7:"Brocato";i:70;s:4:"Peso";i:71;s:7:"Bergamo";i:72;s:8:"Paradiso";i:73;s:6:"Rozone";i:74;s:7:"Stretto";i:75;s:8:"Unicorno";i:76;s:4:"Dune";i:77;s:6:"Piatto";i:78;s:5:"Punto";i:79;s:4:"Cubo";i:80;s:7:"Matrice";i:81;s:6:"Silvia";i:82;s:6:"Aurora";i:83;s:5:"Grumo";i:84;s:4:"Alba";i:85;s:11:"Via Lattera";i:86;s:9:"Primavera";i:87;s:5:"Elica";i:88;s:8:"Eleonora";i:89;s:6:"Regina";i:90;s:8:"Anguilla";i:91;s:5:"Cielo";i:92;s:7:"Flberta";i:93;s:8:"Giardino";i:94;s:7:"Confuso";i:95;s:6:"Foggia";i:96;s:6:"Cucina";i:97;s:13:"Purple Elvira";i:98;s:13:"Cognac Elvira";i:99;s:6:"Cetara";i:100;s:8:"Carolina";i:101;s:8:"Ricciolo";i:102;s:6:"Polare";i:103;s:4:"Otto";i:104;s:7:"Signore";i:105;s:7:"Venezia";i:106;s:6:"Piazze";i:107;s:5:"Cigno";i:108;s:5:"Corso";i:109;s:10:"Cold Flame";i:110;s:7:"Diamond";i:111;s:5:"Geoma";i:112;s:5:"Ambra";i:113;s:4:"Arco";i:114;s:8:"Aleandro";i:115;s:6:"Aggius";i:116;s:6:"Tempio";i:117;s:6:"Crater";i:118;s:8:"Karlanda";i:119;s:6:"Eleana";i:120;s:11:"Led Borgo 2";i:121;s:9:"Led Giron";i:122;s:9:"Led Malva";i:123;s:10:"Led Arezzo";i:124;s:8:"Led Ella";i:125;s:10:"Led Bari 1";i:126;s:10:"Led Toleda";i:127;s:13:"Led Corriente";i:128;s:8:"Led Nube";i:129;s:6:"Calvin";i:130;s:6:"Beramo";i:131;s:5:"Imene";i:132;s:8:"Doreen 1";i:133;s:5:"Bados";i:134;s:6:"Hakana";i:135;s:6:"Quarto";i:136;s:10:"Magnum-led";i:137;s:8:"Buzz-led";i:138;s:8:"Sancho 1";i:139;s:6:"Tabbio";i:140;s:5:"Hania";i:141;s:6:"Davida";i:142;s:8:"Orotelli";i:143;s:7:"Tinnari";i:144;s:8:"Glossy 1";i:145;s:7:"Rottelo";i:146;s:6:"Gemini";i:147;s:6:"Eridan";i:148;s:7:"Tortoli";i:149;s:10:"Chiron-led";i:150;s:6:"Loke 1";i:151;s:5:"Rodeo";i:152;s:4:"Aron";i:153;s:6:"Pigaro";i:154;s:8:"Beramo 1";i:155;s:8:"Pratella";i:156;s:6:"Camile";i:157;s:7:"Biandra";i:158;s:7:"Coretto";i:159;s:4:"Hanu";i:160;s:4:"Tofo";i:161;s:5:"Petto";i:162;s:5:"Omano";i:163;s:7:"Fosforo";i:164;s:6:"Razoni";i:165;s:8:"Sorano 1";i:166;s:7:"Hania 1";i:167;s:6:"Tufara";i:168;s:5:"Debed";i:169;s:5:"Reale";i:170;s:6:"Jamera";i:171;s:7:"Inistra";i:172;s:4:"Alea";i:173;s:5:"Fedra";i:174;s:6:"Alento";i:175;s:7:"Madai 1";i:176;s:6:"Tamara";i:177;s:4:"Lora";i:178;s:6:"Gita 1";i:179;s:9:"Granada 1";i:180;s:7:"Palmera";i:181;s:7:"Sticker";i:182;s:7:"Granada";i:183;s:6:"Enja 8";i:184;s:6:"Enja 5";i:185;s:4:"Lika";i:186;s:6:"Hanifa";i:187;s:5:"Sessa";i:188;s:9:"Fernandez";i:189;s:6:"Bayman";i:190;s:9:"Bastillio";i:191;s:6:"Fenari";i:192;s:6:"Lalita";i:193;s:8:"Pianella";i:194;s:7:"Caramia";i:195;s:6:"Vinovo";i:196;s:6:"Rovigo";i:197;s:9:"Monserrat";i:198;s:8:"Laurenzo";i:199;s:7:"Galaxia";i:200;s:9:"Silvestro";i:201;s:5:"Carda";i:202;s:6:"Melina";i:203;s:10:"La Casedda";i:204;s:6:"Akacia";i:205;s:7:"Pinto 1";i:206;s:7:"Kalunga";i:207;s:7:"Foligno";i:208;s:6:"Corona";i:209;s:8:"Corona 1";i:210;s:8:"Carmelia";i:211;s:7:"Fabiana";i:212;s:5:"Hanna";i:213;s:6:"Varano";i:214;s:8:"Rustic 7";i:215;s:6:"Murcia";i:216;s:6:"Cronos";i:217;s:6:"Nambia";i:218;s:5:"Mongu";i:219;s:3:"Wok";i:220;s:5:"Thebe";i:221;s:7:"Rebecca";i:222;s:4:"Ryan";i:223;s:10:"Pinto Nero";i:224;s:4:"Romy";i:225;s:7:"Fortuna";i:226;s:5:"Oxana";i:227;s:6:"Ferrol";i:228;s:6:"Felice";i:229;s:6:"Dionis";i:230;s:5:"Milea";}', NULL),
(261, 'Ротанг', 'ru', 'a:3:{i:0;s:22:"натуральный";i:1;s:24:"искуственный";i:2;s:6:"rotang";}', NULL),
(262, 'Тип варочной панели', 'ru', 'a:3:{i:0;s:14:"Газовая";i:1;s:30:"Комбинированная";i:2;s:26:"Электрическая";}', NULL),
(263, 'Тип духовки', 'ru', 'a:3:{i:0;s:14:"Газовая";i:1;s:26:"Электрическая";i:2;s:67:"Мультифункциональная электрическая";}', NULL),
(264, 'Ширина, см', 'ru', 'a:5:{i:0;s:15:"свыше 90 ";i:1;s:7:"80-90 ";i:2;s:9:"45-59.5 ";i:3;s:7:"60-69 ";i:4;s:7:"70-79 ";}', NULL),
(265, 'Глубина, см', 'ru', 'a:6:{i:0;s:7:"до 60";i:1;s:18:"60 и больше";i:2;s:2:"50";i:3;s:2:"60";i:4;s:2:"55";i:5;s:2:"58";}', NULL),
(266, 'Высота, см', 'ru', 'a:13:{i:0;s:2:"85";i:1;s:18:"86 и больше";i:2;s:2:"90";i:3;s:3:"220";i:4;s:3:"240";i:5;s:3:"150";i:6;s:3:"120";i:7;s:3:"160";i:8;s:2:"12";i:9;s:6:"visota";i:10;s:12:"visotamebeli";i:11;s:3:"180";i:12;s:3:"163";}', NULL),
(267, 'Гриль', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(268, 'Вертел в духовке', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(269, 'Газ-контроль конфорок', 'ru', 'a:2:{i:0;s:6:"Нет";i:1;s:8:"Есть";}', NULL),
(270, 'Газ-контроль духовки', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(272, 'FM тюнер', 'ru', 'a:4:{i:0;s:4:"да";i:1;s:6:"нет";i:2;s:8:"Есть";i:3;s:6:"Нет";}', NULL),
(273, 'Тип плеера', 'ru', 'a:2:{i:0;s:18:"Blu-Ray плеер";i:1;s:14:"DVD плеер";}', NULL),
(338, 'Интерфейс', 'ru', '', NULL),
(339, 'Интерфейс', 'ru', '', NULL),
(340, 'Производительность', 'ru', 'a:5:{i:0;s:10:"до 300 ";i:1;s:9:"301-500 ";i:2;s:9:"501-800 ";i:3;s:10:"801-1000 ";i:4;s:15:"свыше 1000";}', NULL),
(341, 'Цвет', 'ru', '', NULL),
(342, 'Количество двигателей', 'ru', '', NULL),
(343, 'Ширина для встраивания', 'ru', 'a:6:{i:0;s:15:"менее 55 ";i:1;s:4:"60 ";i:2;s:4:"70 ";i:3;s:4:"80 ";i:4;s:4:"90 ";i:5;s:13:"свыше 90";}', NULL),
(275, 'Комплект акустических систем', 'ru', 'a:4:{i:0;s:3:"9.1";i:1;s:3:"5.1";i:2;s:3:"4.1";i:3;s:3:"2.1";}', NULL),
(276, 'Слот для карт памяти', 'ru', 'a:4:{i:0;s:4:"да";i:1;s:6:"нет";i:2;s:8:"есть";i:3;s:6:"Нет";}', NULL),
(277, 'Производитель', 'ru', '', NULL),
(278, 'Тип телевизора', 'ru', 'a:5:{i:0;s:25:"3D LED-телевизор";i:1;s:22:"LED-телевизор";i:2;s:6:"3D LED";i:3;s:28:"LED-телевизор + DVD";i:4;s:4:"ЖК";}', NULL),
(279, 'Поддержка памяти', 'ru', 'a:3:{i:0;s:4:"DDR3";i:1;s:4:"DDR2";i:2;s:9:"DDR2/DDR3";}', NULL),
(280, 'Чипсет (Северный мост)', 'ru', 'a:36:{i:0;s:9:"Intel B75";i:1;s:12:"GeForce 7025";i:2;s:8:"AMD 880G";i:3;s:8:"AMD 760G";i:4;s:7:"AMD 970";i:5;s:8:"AMD 785G";i:6;s:10:"AMD 990 FX";i:7;s:7:"AMD A55";i:8;s:7:"AMD A75";i:9;s:10:"Intel NM10";i:10;s:12:"AMD A50M FCH";i:11;s:9:"Intel G41";i:12;s:9:"Intel H61";i:13;s:9:"Intel H67";i:14;s:9:"Intel H77";i:15;s:11:"Intel 945GC";i:16;s:10:"nForce 630";i:17;s:10:"Intel 865G";i:18;s:9:"Intel P67";i:19;s:9:"VIA VX900";i:20;s:9:"Intel X79";i:21;s:9:"Intel Z68";i:22;s:9:"Intel Z75";i:23;s:9:"Intel Z77";i:24;s:10:"Intel HM70";i:25;s:11:"AMD A75 FCH";i:26;s:12:"AMD A85X FCH";i:27;s:11:"nForce 630a";i:28;s:11:"nForce 980a";i:29;s:8:"AMD 990X";i:30;s:9:"Intel X58";i:31;s:9:"Intel H55";i:32;s:9:"Intel Q67";i:33;s:9:"Intel Q77";i:34;s:11:"AMD A45 FCH";i:35;s:10:"Intel NM70";}', NULL),
(281, 'Встроенное видео', 'ru', 'a:2:{i:0;s:6:"Нет";i:1;s:8:"Есть";}', NULL),
(282, 'Тип разьема', 'ru', 'a:15:{i:0;s:11:"Socket 1155";i:1;s:10:"Socket AM3";i:2;s:13:"Socket АМ3+";i:3;s:10:"Socket FM1";i:4;s:39:"Встроенный процессор";i:5;s:10:"Socket FM2";i:6;s:10:"Socket 775";i:7;s:10:"Socket 754";i:8;s:11:"Socket AM2+";i:9;s:10:"Socket 478";i:10;s:11:"Socket 2011";i:11;s:11:"Socket 1366";i:12;s:11:"Socket 1156";i:13;s:10:"Socket 437";i:14;s:10:"Socket FT1";}', NULL),
(283, 'Частота шины', 'ru', 'a:26:{i:0;s:11:"2200 МГц";i:1;s:11:"1000 МГц";i:2;s:11:"2600 МГц";i:3;s:11:"2400 МГц";i:4;s:11:"5000 МГц";i:5;s:11:"2500 МГц";i:6;s:11:"1500 МГц";i:7;s:24:"1333/1066/800/533 МГц";i:8;s:18:"800/533/400 МГц";i:9;s:10:"800 МГц";i:10;s:16:"2000-5200 МГц";i:11;s:11:"1333 МГц";i:12;s:16:"4000-5200 МГц";i:13;s:11:"5200 МГц";i:14;s:11:"1650 МГц";i:15;s:11:"1600 МГц";i:16;s:16:"4000-4800 МГц";i:17;s:11:"4800 МГц";i:18;s:11:"2133 МГц";i:19;s:20:"1333/1066/800 МГц";i:20;s:16:"6400/4800 МГц";i:21;s:11:"1866 МГц";i:22;s:11:"1800 МГц";i:23;s:11:"1066 МГц";i:24;s:11:"1100 МГц";i:25;s:11:"2800 МГц";}', NULL),
(292, 'Интерфейс', 'ru', 'a:7:{i:0;s:3:"USB";i:1;s:9:"Bluetooth";i:2;s:10:"USB + PS/2";i:3;s:4:"PS/2";i:4;s:7:"USB 3.0";i:5;s:7:"USB 2.0";i:6;s:21:"USB 2.0, Wi-Fi 802.11";}', NULL),
(291, 'Тип сенсора', 'ru', 'a:3:{i:0;s:20:"Оптический";i:1;s:16:"Лазерный";i:2;s:8:"BlueSpot";}', NULL),
(284, 'Тип загрузки', 'ru', 'a:2:{i:0;s:22:"Фронтальная";i:1;s:24:"Вертикальная";}', NULL),
(285, 'Класс стирки', 'ru', 'a:2:{i:0;s:2:"А";i:1;s:1:"C";}', NULL),
(286, 'Класс отжима', 'ru', 'a:4:{i:0;s:1:"C";i:1;s:1:"B";i:2;s:1:"D";i:3;s:2:"А";}', NULL),
(287, 'Загрузка белья, кг', 'ru', 'a:9:{i:0;s:3:"6,0";i:1;s:3:"5,0";i:2;s:3:"8,0";i:3;s:3:"3,0";i:4;s:3:"3,5";i:5;s:3:"7,0";i:6;s:3:"9,0";i:7;s:3:"4,0";i:8;s:3:"5,5";}', NULL),
(288, 'Максимальная скорость отжима об./мин.', 'ru', 'a:6:{i:0;s:4:"1000";i:1;s:3:"800";i:2;s:4:"1200";i:3;s:4:"1400";i:4;s:4:"1100";i:5;s:4:"1600";}', NULL),
(289, 'Глубина, см', 'ru', 'a:10:{i:0;s:15:"меньше 40";i:1;s:5:"40-55";i:2;s:5:"56-65";i:3;s:2:"60";i:4;s:2:"50";i:5;s:2:"85";i:6;s:13:"glubinamebeli";i:7;s:3:"110";i:8;s:3:"300";i:9;s:2:"92";}', NULL),
(299, 'объем', 'ru', 'a:7:{i:0;s:5:"20 л";i:1;s:5:"19 л";i:2;s:5:"28 л";i:3;s:5:"30 л";i:4;s:5:"25 л";i:5;s:5:"23 л";i:6;s:5:"17 л";}', NULL),
(300, 'Мощность микроволн (Вт)', 'ru', 'a:14:{i:0;s:3:"700";i:1;s:8:"700 Вт";i:2;s:7:"800Вт";i:3;s:7:"850Вт";i:4;s:7:"700Вт";i:5;s:7:"900Вт";i:6;s:8:"1050Вт";i:7;s:8:"800 Вт";i:8;s:8:"1200Вт";i:9;s:8:"950 Вт";i:10;s:8:"900 Вт";i:11;s:8:"750 Вт";i:12;s:8:"850 Вт";i:13;s:9:"2400 Вт";}', NULL),
(301, 'Насадка для колбас', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(303, 'Диапазон производительности (кг/мин) ', 'ru', 'a:3:{i:0;s:5:"1-1.5";i:1;s:5:"1.6-2";i:2;s:12:"более 2";}', NULL),
(304, 'Длина (см)', 'ru', 'a:103:{i:0;s:2:"37";i:1;s:2:"91";i:2;s:4:"31,5";i:3;s:2:"31";i:4;s:2:"12";i:5;s:2:"80";i:6;s:1:"7";i:7;s:2:"87";i:8;s:2:"68";i:9;s:2:"93";i:10;s:2:"34";i:11;s:2:"41";i:12;s:2:"38";i:13;s:2:"28";i:14;s:2:"40";i:15;s:1:"3";i:16;s:4:"30,5";i:17;s:2:"10";i:18;s:3:"5,5";i:19;s:2:"58";i:20;s:1:"8";i:21;s:2:"27";i:22;s:2:"24";i:23;s:4:"64,5";i:24;s:3:"105";i:25;s:2:"33";i:26;s:4:"27,5";i:27;s:4:"68,5";i:28;s:4:"28,5";i:29;s:4:"48,5";i:30;s:5:"165,5";i:31;s:2:"36";i:32;s:2:"64";i:33;s:2:"55";i:34;s:2:"76";i:35;s:3:"110";i:36;s:4:"16,5";i:37;s:2:"78";i:38;s:4:"25,5";i:39;s:2:"39";i:40;s:3:"116";i:41;s:2:"26";i:42;s:4:"97,5";i:43;s:2:"23";i:44;s:2:"16";i:45;s:2:"19";i:46;s:3:"170";i:47;s:4:"88,5";i:48;s:4:"GU10";i:49;s:3:"LED";i:50;s:3:"E27";i:51;s:3:"E14";i:52;s:2:"G9";i:53;s:4:"71,5";i:54;s:2:"60";i:55;s:4:"83,5";i:56;s:2:"84";i:57;s:2:"75";i:58;s:3:"109";i:59;s:2:"86";i:60;s:3:"9,5";i:61;s:2:"46";i:62;s:2:"90";i:63;s:2:"35";i:64;s:4:"12,5";i:65;s:1:"5";i:66;s:2:"21";i:67;s:4:"29,5";i:68;s:2:"67";i:69;s:2:"52";i:70;s:3:"128";i:71;s:4:"97,7";i:72;s:5:"120,5";i:73;s:4:"90,5";i:74;s:2:"57";i:75;s:4:"34,5";i:76;s:5:"100,5";i:77;s:2:"72";i:78;s:2:"18";i:79;s:4:"89,5";i:80;s:2:"92";i:81;s:2:"14";i:82;s:2:"30";i:83;s:4:"91,5";i:84;s:2:"25";i:85;s:2:"77";i:86;s:4:"22,5";i:87;s:2:"20";i:88;s:2:"13";i:89;s:2:"70";i:90;s:4:"14,5";i:91;s:2:"71";i:92;s:1:"9";i:93;s:3:"101";i:94;s:2:"82";i:95;s:2:"88";i:96;s:4:"72,5";i:97;s:4:"87,5";i:98;s:2:"17";i:99;s:8:"dlinavsm";i:100;s:4:"1650";i:101;s:4:"1700";i:102;s:4:"1780";}', NULL),
(305, 'Дополнительно', 'ru', 'a:2:{i:0;s:32:"Лампы в комплекте";i:1;s:48:"Лампы в комплект не входят";}', NULL),
(306, 'Напряжение в сети', 'ru', 'a:5:{i:0;s:17:"220-240V, 50-60Hz";i:1;s:3:"7,5";i:2;s:1:"8";i:3;s:4:"19,5";i:4;s:4:"14,5";}', NULL),
(307, 'Класс защиты', 'ru', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:17:"220-240V, 50-60Hz";}', NULL),
(308, 'Тип защиты', 'ru', 'a:6:{i:0;s:4:"IP20";i:1;s:4:"IP44";i:2;s:1:"2";i:3;s:1:"1";i:4;s:1:"3";i:5;s:4:"IP54";}', NULL),
(309, 'Сертификат', 'ru', 'a:2:{i:0;s:4:"ENEC";i:1;s:4:"IP20";}', NULL),
(311, 'Item No.', 'ru', 'a:378:{i:0;s:5:"92216";i:1;s:5:"92217";i:2;s:5:"92218";i:3;s:5:"92219";i:4;s:5:"91755";i:5;s:5:"91753";i:6;s:5:"91754";i:7;s:5:"91752";i:8;s:5:"91548";i:9;s:5:"91547";i:10;s:5:"91546";i:11;s:5:"91545";i:12;s:5:"91992";i:13;s:5:"91993";i:14;s:5:"92263";i:15;s:5:"92264";i:16;s:5:"92101";i:17;s:5:"92102";i:18;s:5:"91851";i:19;s:5:"91852";i:20;s:5:"91672";i:21;s:5:"91682";i:22;s:5:"91854";i:23;s:5:"91853";i:24;s:5:"91848";i:25;s:5:"91718";i:26;s:5:"91685";i:27;s:5:"91714";i:28;s:5:"91709";i:29;s:5:"91708";i:30;s:5:"91676";i:31;s:5:"91675";i:32;s:5:"92097";i:33;s:5:"92269";i:34;s:5:"92095";i:35;s:5:"92096";i:36;s:5:"91649";i:37;s:5:"91648";i:38;s:5:"91367";i:39;s:5:"91366";i:40;s:5:"91365";i:41;s:5:"91364";i:42;s:5:"92662";i:43;s:5:"92663";i:44;s:5:"92664";i:45;s:5:"92644";i:46;s:5:"92645";i:47;s:5:"92642";i:48;s:5:"92643";i:49;s:5:"92641";i:50;s:5:"92598";i:51;s:5:"92599";i:52;s:5:"92595";i:53;s:5:"92596";i:54;s:5:"92597";i:55;s:5:"92538";i:56;s:5:"92535";i:57;s:5:"92536";i:58;s:5:"92537";i:59;s:5:"92527";i:60;s:5:"92528";i:61;s:5:"92529";i:62;s:5:"92526";i:63;s:5:"92105";i:64;s:5:"92106";i:65;s:5:"92103";i:66;s:5:"92104";i:67;s:5:"92087";i:68;s:5:"92084";i:69;s:5:"92085";i:70;s:5:"92086";i:71;s:5:"91877";i:72;s:5:"91878";i:73;s:5:"91879";i:74;s:5:"91635";i:75;s:5:"91634";i:76;s:5:"91633";i:77;s:5:"91663";i:78;s:5:"91664";i:79;s:5:"91662";i:80;s:5:"90927";i:81;s:5:"90917";i:82;s:5:"90916";i:83;s:5:"90915";i:84;s:5:"90914";i:85;s:5:"90865";i:86;s:5:"90864";i:87;s:5:"90863";i:88;s:5:"90862";i:89;s:5:"90838";i:90;s:5:"90837";i:91;s:5:"90836";i:92;s:5:"90835";i:93;s:5:"90834";i:94;s:5:"90833";i:95;s:5:"90832";i:96;s:5:"90831";i:97;s:5:"90829";i:98;s:5:"90828";i:99;s:5:"90827";i:100;s:5:"90826";i:101;s:5:"90825";i:102;s:5:"90824";i:103;s:5:"90823";i:104;s:5:"90822";i:105;s:5:"92679";i:106;s:5:"92681";i:107;s:5:"92682";i:108;s:5:"92678";i:109;s:5:"91738";i:110;s:5:"91739";i:111;s:5:"91355";i:112;s:5:"91353";i:113;s:5:"91354";i:114;s:5:"91352";i:115;s:5:"89348";i:116;s:5:"88944";i:117;s:5:"88943";i:118;s:5:"92658";i:119;s:5:"92659";i:120;s:5:"92661";i:121;s:5:"92657";i:122;s:5:"92571";i:123;s:5:"92566";i:124;s:5:"92567";i:125;s:5:"92568";i:126;s:5:"92569";i:127;s:5:"92523";i:128;s:5:"92524";i:129;s:5:"92521";i:130;s:5:"92522";i:131;s:5:"92519";i:132;s:5:"92518";i:133;s:5:"92386";i:134;s:5:"92383";i:135;s:5:"92384";i:136;s:5:"92385";i:137;s:5:"92717";i:138;s:5:"92718";i:139;s:5:"92719";i:140;s:5:"92716";i:141;s:5:"92506";i:142;s:5:"92504";i:143;s:5:"92502";i:144;s:5:"92501";i:145;s:5:"92357";i:146;s:5:"92358";i:147;s:5:"92356";i:148;s:5:"92292";i:149;s:5:"92245";i:150;s:5:"92251";i:151;s:5:"92252";i:152;s:5:"92153";i:153;s:5:"92344";i:154;s:5:"92226";i:155;s:5:"92227";i:156;s:5:"92136";i:157;s:5:"92134";i:158;s:5:"92076";i:159;s:5:"92077";i:160;s:5:"92098";i:161;s:5:"92099";i:162;s:5:"91829";i:163;s:5:"91872";i:164;s:5:"91874";i:165;s:5:"91824";i:166;s:5:"91117";i:167;s:5:"91398";i:168;s:5:"91397";i:169;s:5:"90687";i:170;s:5:"90686";i:171;s:5:"90684";i:172;s:5:"90685";i:173;s:5:"90569";i:174;s:5:"90568";i:175;s:5:"90528";i:176;s:5:"90527";i:177;s:5:"90526";i:178;s:5:"89647";i:179;s:5:"90122";i:180;s:5:"90613";i:181;s:5:"87222";i:182;s:5:"87221";i:183;s:5:"87219";i:184;s:5:"87218";i:185;s:5:"85832";i:186;s:5:"85828";i:187;s:5:"85825";i:188;s:5:"85817";i:189;s:5:"85816";i:190;s:5:"86777";i:191;s:5:"86776";i:192;s:5:"86779";i:193;s:5:"86778";i:194;s:5:"86775";i:195;s:5:"86774";i:196;s:5:"86773";i:197;s:5:"86772";i:198;s:5:"89965";i:199;s:5:"92284";i:200;s:5:"92285";i:201;s:5:"92286";i:202;s:5:"92283";i:203;s:5:"92282";i:204;s:5:"92224";i:205;s:5:"92112";i:206;s:5:"92109";i:207;s:5:"92111";i:208;s:5:"92108";i:209;s:5:"92565";i:210;s:5:"91971";i:211;s:5:"91973";i:212;s:5:"92562";i:213;s:5:"92563";i:214;s:5:"92564";i:215;s:5:"92553";i:216;s:5:"91841";i:217;s:5:"91842";i:218;s:5:"91821";i:219;s:5:"91817";i:220;s:5:"91818";i:221;s:5:"91819";i:222;s:5:"91766";i:223;s:5:"91767";i:224;s:5:"91768";i:225;s:5:"91765";i:226;s:5:"91733";i:227;s:5:"91734";i:228;s:5:"91736";i:229;s:5:"91732";i:230;s:5:"91567";i:231;s:5:"91568";i:232;s:5:"91566";i:233;s:5:"91563";i:234;s:5:"91562";i:235;s:5:"91435";i:236;s:5:"91434";i:237;s:5:"91432";i:238;s:5:"91433";i:239;s:5:"90324";i:240;s:5:"90323";i:241;s:5:"90596";i:242;s:5:"90594";i:243;s:5:"90595";i:244;s:5:"90593";i:245;s:5:"92041";i:246;s:5:"92037";i:247;s:5:"92038";i:248;s:5:"91382";i:249;s:5:"91418";i:250;s:5:"91277";i:251;s:5:"91276";i:252;s:5:"91574";i:253;s:5:"91575";i:254;s:5:"91573";i:255;s:5:"91572";i:256;s:5:"91597";i:257;s:5:"91596";i:258;s:5:"91594";i:259;s:5:"91595";i:260;s:5:"91593";i:261;s:5:"91501";i:262;s:5:"91502";i:263;s:5:"91477";i:264;s:5:"91356";i:265;s:5:"91357";i:266;s:5:"91328";i:267;s:5:"91326";i:268;s:5:"91327";i:269;s:5:"91286";i:270;s:5:"91285";i:271;s:5:"91283";i:272;s:5:"91284";i:273;s:5:"91282";i:274;s:5:"91267";i:275;s:5:"91265";i:276;s:5:"91266";i:277;s:5:"91264";i:278;s:5:"91338";i:279;s:5:"91337";i:280;s:5:"91604";i:281;s:5:"91417";i:282;s:5:"91416";i:283;s:5:"91415";i:284;s:5:"91414";i:285;s:5:"90577";i:286;s:5:"90578";i:287;s:5:"90576";i:288;s:5:"90574";i:289;s:5:"90575";i:290;s:5:"91182";i:291;s:5:"91177";i:292;s:5:"91178";i:293;s:5:"91176";i:294;s:5:"91175";i:295;s:5:"91254";i:296;s:5:"91255";i:297;s:5:"91036";i:298;s:5:"91031";i:299;s:5:"91028";i:300;s:5:"91007";i:301;s:5:"91006";i:302;s:5:"91005";i:303;s:5:"91004";i:304;s:5:"91002";i:305;s:5:"91045";i:306;s:5:"91039";i:307;s:5:"91038";i:308;s:5:"91037";i:309;s:5:"91551";i:310;s:5:"91549";i:311;s:5:"90906";i:312;s:5:"90905";i:313;s:5:"91016";i:314;s:5:"91015";i:315;s:5:"91014";i:316;s:5:"91012";i:317;s:5:"91008";i:318;s:5:"90947";i:319;s:5:"90946";i:320;s:5:"90945";i:321;s:5:"90944";i:322;s:5:"91167";i:323;s:5:"90756";i:324;s:5:"91166";i:325;s:5:"90755";i:326;s:5:"90754";i:327;s:5:"90745";i:328;s:5:"90744";i:329;s:5:"90743";i:330;s:5:"90742";i:331;s:5:"90741";i:332;s:5:"90372";i:333;s:5:"90371";i:334;s:5:"90369";i:335;s:5:"90368";i:336;s:5:"90367";i:337;s:5:"90366";i:338;s:5:"90309";i:339;s:5:"90308";i:340;s:5:"90306";i:341;s:5:"90305";i:342;s:5:"90304";i:343;s:5:"91846";i:344;s:5:"91847";i:345;s:5:"90757";i:346;s:5:"90679";i:347;s:5:"90647";i:348;s:5:"90648";i:349;s:5:"90643";i:350;s:5:"90622";i:351;s:5:"91084";i:352;s:5:"90443";i:353;s:5:"90442";i:354;s:5:"90441";i:355;s:5:"90439";i:356;s:5:"90438";i:357;s:5:"90556";i:358;s:5:"90387";i:359;s:5:"90386";i:360;s:5:"90385";i:361;s:5:"90342";i:362;s:5:"90341";i:363;s:5:"90339";i:364;s:5:"90338";i:365;s:5:"89899";i:366;s:5:"89898";i:367;s:5:"89897";i:368;s:5:"89896";i:369;s:5:"89894";i:370;s:5:"89895";i:371;s:5:"89893";i:372;s:5:"89892";i:373;s:5:"89891";i:374;s:5:"89824";i:375;s:5:"89825";i:376;s:5:"89823";i:377;s:5:"89822";}', NULL),
(312, 'Тип уборки', 'ru', 'a:4:{i:0;s:10:"Сухая";i:1;s:25:"Сухая/Влажная";i:2;s:14:"Влажная";i:3;s:25:"Сухая/влажная";}', NULL);
INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`, `data`, `description`) VALUES
(313, 'Максимальная мощность (Вт)', 'ru', 'a:15:{i:0;s:9:"1000 Вт";i:1;s:9:"1200 Вт";i:2;s:9:"1650 Вт";i:3;s:9:"1800 Вт";i:4;s:9:"1400 Вт";i:5;s:9:"1500 Вт";i:6;s:9:"1600 Вт";i:7;s:9:"2000 Вт";i:8;s:9:"1700 Вт";i:9;s:9:"1250 Вт";i:10;s:9:"2050 Вт";i:11;s:9:"1900 Вт";i:12;s:9:"1100 Вт";i:13;s:9:"2100 Вт";i:14;s:9:"2200 Вт";}', NULL),
(314, 'Объем пылесборника', 'ru', 'a:26:{i:0;s:6:"1.0 л";i:1;s:6:"1.6 л";i:2;s:6:"1.5 л";i:3;s:6:"3.5 л";i:4;s:4:"2 л";i:5;s:6:"2.5 л";i:6;s:6:"2.6 л";i:7;s:6:"1.9 л";i:8;s:6:"1.4 л";i:9;s:6:"0.7 л";i:10;s:6:"1.2 л";i:11;s:6:"0.9 л";i:12;s:6:"2.0 л";i:13;s:4:"4 л";i:14;s:4:"1 л";i:15;s:4:"3 л";i:16;s:4:"5 л";i:17;s:6:"1.3 л";i:18;s:6:"2.4 л";i:19;s:6:"3.0 л";i:20;s:3:"2.4";i:21;s:6:"1.8 л";i:22;s:6:"4.0 л";i:23;s:5:"2 л.";i:24;s:9:"02.апр";i:25;s:6:"5.0 л";}', NULL),
(315, 'Турбощетка', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(316, 'Аквафильтр      ', 'ru', 'a:2:{i:0;s:6:"Нет";i:1;s:8:"Есть";}', NULL),
(317, 'Регулятор мощности на рукоятке', 'ru', 'a:2:{i:0;s:8:"Есть";i:1;s:6:"Нет";}', NULL),
(318, 'Диаметр (см)', 'ru', 'a:71:{i:0;s:2:"13";i:1;s:2:"66";i:2;s:2:"12";i:3;s:2:"15";i:4;s:2:"45";i:5;s:2:"42";i:6;s:4:"38,5";i:7;s:4:"31,5";i:8;s:4:"42,5";i:9;s:4:"34,5";i:10;s:2:"35";i:11;s:2:"33";i:12;s:2:"38";i:13;s:1:"7";i:14;s:1:"6";i:15;s:3:"9,5";i:16;s:4:"11,5";i:17;s:4:"12,5";i:18;s:2:"21";i:19;s:3:"2,5";i:20;s:3:"3,2";i:21;s:3:"8,5";i:22;s:1:"3";i:23;s:3:"0,6";i:24;s:3:"0,4";i:25;s:3:"110";i:26;s:2:"25";i:27;s:4:"29,5";i:28;s:3:"147";i:29;s:4:"14,5";i:30;s:4:"23,5";i:31;s:2:"28";i:32;s:2:"23";i:33;s:4:"27,5";i:34;s:2:"40";i:35;s:2:"17";i:36;s:2:"39";i:37;s:2:"19";i:38;s:2:"16";i:39;s:4:"49,5";i:40;s:2:"32";i:41;s:2:"30";i:42;s:2:"18";i:43;s:4:"16,5";i:44;s:4:"59,5";i:45;s:4:"19,5";i:46;s:4:"10,5";i:47;s:2:"20";i:48;s:2:"26";i:49;s:4:"39,5";i:50;s:2:"55";i:51;s:4:"36,5";i:52;s:2:"67";i:53;s:2:"74";i:54;s:2:"82";i:55;s:4:"44,5";i:56;s:4:"61,5";i:57;s:4:"48,5";i:58;s:2:"11";i:59;s:4:"47,5";i:60;s:1:"9";i:61;s:2:"41";i:62;s:2:"63";i:63;s:4:"20,5";i:64;s:4:"40,5";i:65;s:4:"33,5";i:66;s:4:"22,5";i:67;s:2:"10";i:68;s:2:"54";i:69;s:4:"63,5";i:70;s:2:"36";}', NULL),
(319, 'Расстояние от стены (см)', 'ru', 'a:43:{i:0;s:4:"19,5";i:1;s:2:"11";i:2;s:3:"7,5";i:3;s:3:"9,4";i:4;s:2:"12";i:5;s:3:"9,5";i:6;s:3:"7,8";i:7;s:4:"12,5";i:8;s:3:"9,8";i:9;s:1:"9";i:10;s:3:"8,5";i:11;s:2:"13";i:12;s:4:"23,5";i:13;s:2:"25";i:14;s:4:"11,5";i:15;s:2:"20";i:16;s:3:"7,6";i:17;s:3:"6,5";i:18;s:3:"4,5";i:19;s:1:"3";i:20;s:2:"37";i:21;s:4:"28,5";i:22;s:2:"61";i:23;s:4:"20,5";i:24;s:4:"14,5";i:25;s:4:"51,5";i:26;s:2:"14";i:27;s:1:"7";i:28;s:4:"13,5";i:29;s:4:"15,5";i:30;s:4:"12,2";i:31;s:1:"5";i:32;s:2:"22";i:33;s:1:"8";i:34;s:2:"23";i:35;s:2:"16";i:36;s:4:"25,5";i:37;s:2:"30";i:38;s:4:"16,5";i:39;s:4:"22,5";i:40;s:4:"18,5";i:41;s:2:"21";i:42;s:2:"24";}', NULL),
(320, 'Тип патрона', 'ru', 'a:13:{i:0;s:4:"GU10";i:1;s:3:"LED";i:2;s:3:"E27";i:3;s:2:"G9";i:4;s:9:"LED ; LED";i:5;s:6:"GY6,35";i:6;s:5:"2GX13";i:7;s:2:"G5";i:8;s:3:"R7S";i:9;s:3:"E14";i:10;s:3:"G13";i:11;s:7:"E27;LED";i:12;s:11:"2GX13 ; LED";}', NULL),
(321, 'Формат', 'ru', 'a:2:{i:0;s:14:"2.5 дюйма";i:1;s:14:"3.5 дюйма";}', NULL),
(322, 'Тип накопителя', 'ru', 'a:2:{i:0;s:22:"Портативные";i:1;s:20:"Настольные";}', NULL),
(323, 'Цвет накопитель', 'ru', 'a:19:{i:0;s:10:"Белый";i:1;s:12:"Черный";i:2;s:20:"Коричневый";i:3;s:18:"Титановый";i:4;s:14:"Розовый";i:5;s:22:"Серебристый";i:6;s:37:"Черный + серебристый";i:7;s:14:"Металик";i:8;s:29:"Черный + зеленый";i:9;s:20:"Золотистый";i:10;s:14:"Красный";i:11;s:10:"Синий";i:12;s:9:"Iron Grey";i:13;s:6:"Purple";i:14;s:33:"Черный + оранжевый";i:15;s:37:"Черный + Серебристый";i:16;s:29:"Черный + красный";i:17;s:35:"Черный + фиолетовый";i:18;s:34:"Черный + белый узор";}', NULL),
(324, 'Источник энергии', 'ru', 'a:4:{i:0;s:22:"Аккумулятор";i:1;s:18:"Батарейки";i:2;s:38:"От солнечной энергии";i:3;s:12:"Динамо";}', NULL),
(325, 'Защищенность', 'ru', 'a:3:{i:0;s:30:"Влагозащищенные";i:1;s:6:"Нет";i:2;s:34:"Водонепроницаемые";}', NULL),
(326, 'Аксессуары', 'ru', '', NULL),
(327, 'Масштаб', 'ru', 'a:12:{i:0;s:8:"masshtab";i:1;s:4:"1:10";i:2;s:4:"1:16";i:3;s:4:"1:28";i:4;s:4:"1:24";i:5;s:7:"20 см";i:6;s:7:"25 см";i:7;s:7:"16 см";i:8;s:4:"1:43";i:9;s:4:"1:32";i:10;s:4:"1:18";i:11;s:4:"1:12";}', NULL),
(328, 'Марка', 'ru', 'a:159:{i:0;s:5:"marka";i:1;s:28:"Союзмультфильм";i:2;s:26:"Маша и Медведь";i:3;s:20:"Барбоскины";i:4;s:6:"Viacom";i:5;s:14:"Гарфилд";i:6;s:12:"Лунтик";i:7;s:18:"GRAND-ЗООБУМ";i:8;s:13:"MERCEDES-BENZ";i:9;s:5:"HONDA";i:10;s:6:"NISSAN";i:11;s:12:"ASTON MARTIN";i:12;s:4:"AUDI";i:13;s:3:"BMW";i:14;s:5:"DODGE";i:15;s:11:"LAMBORGHINI";i:16;s:9:"CHEVROLET";i:17;s:4:"FORD";i:18;s:10:"MITSUBISHI";i:19;s:6:"SUBARU";i:20;s:6:"TOYOTA";i:21;s:16:"серии DRIFT";i:22;s:7:"FERRARI";i:23;s:7:"CITROEN";i:24;s:6:"JAGUAR";i:25;s:8:"MASERATI";i:26;s:7:"PORSCHE";i:27;s:7:"RENAULT";i:28;s:10:"ALFA ROMEO";i:29;s:6:"HUMMER";i:30;s:4:"JEEP";i:31;s:10:"LAND ROVER";i:32;s:6:"MORGAN";i:33;s:10:"VOLKSWAGEN";i:34;s:5:"LEXUS";i:35;s:11:"RANGE ROVER";i:36;s:5:"LOTUS";i:37;s:5:"MAZDA";i:38;s:6:"ГАЗ";i:39;s:12:"ГАЗЕЛЬ";i:40;s:6:"ЗИЛ";i:41;s:10:"КАМАЗ";i:42;s:14:"ЛИМУЗИН";i:43;s:13:"УАЗ HUNTER";i:44;s:12:"УАЗ-39625";i:45;s:8:"УРАЛ";i:46;s:8:"ШРЕК";i:47;s:31:"ЧЕРЕПАШКИ-НИНДЗЯ";i:48;s:7:"АК-47";i:49;s:5:"BISON";i:50;s:5:"GUMMY";i:51;s:10:"SUPER DISC";i:52;s:10:"SUPERMATIC";i:53;s:3:"UZI";i:54;s:11:"FBI FEDERAL";i:55;s:6:"LARAMY";i:56;s:14:"STERLING ANTIK";i:57;s:5:"JENNY";i:58;s:4:"SUSY";i:59;s:10:"КИТТИ";i:60;s:5:"COBRA";i:61;s:11:"JEFF WATSON";i:62;s:9:"KIT STONE";i:63;s:12:"MULTI TARGET";i:64;s:12:"SUPER TARGET";i:65;s:11:"CHOU CHOU ";i:66;s:22:"MY FIRST BABY ANNABELL";i:67;s:9:"BABY BORN";i:68;s:19:"MY LITTLE BABY BORN";i:69;s:10:"LALALOOPSY";i:70;s:14:"MINILALALOOPSY";i:71;s:16:"MINILALALOOPSY ";i:72;s:7:"BRATZ ";i:73;s:23:"МАЛЫШКА МЕЛЛ";i:74;s:5:"MOXIE";i:75;s:11:"MOXIE TEENZ";i:76;s:10:"Черри";i:77;s:10:"Тоффи";i:78;s:10:"Винни";i:79;s:17:"Винни Пух";i:80;s:10:"Тачки";i:81;s:14:"Золушка";i:82;s:27:"Молния Маккуин";i:83;s:4:"iKID";i:84;s:11:"SPEAK RIGHT";i:85;s:16:"ШКОЛЯРИК";i:86;s:28:"МАША И МЕДВЕДЬ ";i:87;s:25:"КОТ ЛЕОПОЛЬД ";i:88;s:18:"ПРИНЦЕССЫ";i:89;s:28:"ПРОСТОКВАШИНО ";i:90;s:30:"СОЮЗМУЛЬТФИЛЬМ ";i:91;s:54:"ВОЗВРАЩЕНИЕ БЛУДНОГО ПОПУГАЯ";i:92;s:14:"ЗОЛУШКА";i:93;s:20:"ЧЕБУРАШКА ";i:94;s:47:"ЧЕБУРАШКА И КРОКОДИЛ ГЕНА";i:95;s:50:"ПРИКЛЮЧЕНИЯ КОТА ЛЕОПОЛЬДА";i:96;s:35:"СКАЗКИ-МУЛЬТФИЛЬМЫ";i:97;s:40:"ТРОЕ ИЗ ПРОСТОКВАШИНО";i:98;s:22:"БАРБОСКИНЫ ";i:99;s:18:"ПЕРЕВОРОТ";i:100;s:28:"СУПЕРПЕРЕВОРОТ";i:101;s:28:"ТУРБОПЕРЕВОРОТ";i:102;s:8:"ИНЬЮ";i:103;s:37:"ВУЛКАНИЧЕСКИЙ ШАРИК";i:104;s:43:"Батарея аккумуляторная";i:105;s:23:"NARA - КУЗНЕЧИК";i:106;s:21:"NARA - ТАРАКАН";i:107;s:9:"PLEO RB ";i:108;s:20:"FORD FR 500C MUSTANG";i:109;s:9:"FORD GT ";i:110;s:21:"KAWASAKI NINJA ZX-12R";i:111;s:12:"MITSUBISHI ";i:112;s:29:"ПОЖАРНАЯ МАШИНА";i:113;s:14:"ПОЛИЦИЯ";i:114;s:16:"САМОСВАЛ";i:115;s:17:"Губка Боб";i:116;s:5:"TECNO";i:117;s:8:"БЕБИ";i:118;s:4:"FILO";i:119;s:9:"Эко  ";i:120;s:6:"Эко";i:121;s:26:"Исследователь";i:122;s:13:"HELLO KITTY ";i:123;s:16:"СКУБИФАН";i:124;s:8:"АКВА";i:125;s:12:"Футбол";i:126;s:21:"БЛЕСК БАРБИ";i:127;s:17:"ГУБКА БОБ";i:128;s:43:"ДОРА И СОЛНЕЧНЫЕ ЦВЕТЫ ";i:129;s:19:"КЛУБ МИККИ";i:130;s:39:"КОРПОРАЦИЯ МОНСТРОВ ";i:131;s:18:"ЛАЛАЛУПСИ";i:132;s:21:"МИЛЫЙ ВИННИ";i:133;s:8:"НЕМО";i:134;s:35:"ПРИКЛЮЧЕНИЯ ВИННИ ";i:135;s:18:"РУСАЛОЧКА";i:136;s:16:"СМУРФИКИ";i:137;s:27:"ТАЧКИ СКОРОСТЬ";i:138;s:10:"ТАЧКИ";i:139;s:25:"ЧЕЛОВЕК-ПАУК ";i:140;s:26:"В ПОИСКАХ НЕМО";i:141;s:12:"ДИСНЕЙ";i:142;s:18:"Принцессы";i:143;s:22:"УЕФА ЕВРО 2012";i:144;s:10:"БАРБИ";i:145;s:16:"АКРОБАТ ";i:146;s:29:"ЦВЕТНОЙ КЕНГУРУ";i:147;s:10:"Bialetti ";i:148;s:10:"Барби";i:149;s:39:"Итальянский ресторан";i:150;s:18:"Легостина";i:151;s:18:"Принцесса";i:152;s:35:"Волшебное чаепитие";i:153;s:25:"Скорая помощь";i:154;s:16:"HENES M7 PREMIUM";i:155;s:13:"ANGRY BIRDS ";i:156;s:10:"ФЭШЕН";i:157;s:12:"БОНБОН";i:158;s:10:"БАНТ ";}', NULL),
(329, 'Вместимость (количество комплектов)', 'ru', 'a:3:{i:0;s:23:"10 комплектов";i:1;s:22:"9 комплектов";i:2;s:23:"12 комплектов";}', NULL),
(330, 'Класс мойки', 'ru', 'a:1:{i:0;s:1:"A";}', NULL),
(331, 'Класс сушки', 'ru', 'a:2:{i:0;s:1:"A";i:1;s:1:"B";}', NULL),
(332, 'Расход воды, л', 'ru', 'a:6:{i:0;s:1:"9";i:1;s:2:"10";i:2;s:2:"15";i:3;s:2:"13";i:4;s:2:"16";i:5;s:2:"14";}', NULL),
(344, 'материал подошвы', 'ru', 'a:7:{i:0;s:16:"materialpodoshvi";i:1;s:33:"нержавеющая сталь";i:2;s:30:"металлокерамика";i:3;s:16:"алюминий";i:4;s:26:"антипригарная";i:5;s:16:"керамика";i:6;s:10:"титан";}', NULL),
(356, 'Тип ', 'ru', 'a:6:{i:0;s:13:"с паром";i:1;s:26:"парогенератор";i:2;s:16:"дорожный";i:3;s:3:"tip";i:4;s:12:"ручной";i:5;s:24:"стационарный";}', NULL),
(357, 'Кол-во скоростей', 'ru', 'a:3:{i:0;s:20:"kolichestwoskorostey";i:1;s:14:"более 3 ";i:2;s:8:"до 3 ";}', NULL),
(358, 'Длина шнура', 'ru', 'a:3:{i:0;s:18:"от 1 до 1,5 м";i:1;s:18:"от 2 до 3,5 м";i:2;s:11:"от 3,5 м";}', NULL),
(359, 'Импеданс', 'ru', 'a:3:{i:0;s:20:"от 30 до 90 Ом";i:1;s:20:"от 15 до 30 Ом";i:2;s:22:"от 100 до 150 Ом";}', NULL),
(360, 'Чувствительность', 'ru', 'a:3:{i:0;s:13:"до 100 дБ";i:1;s:22:"от 100 до 120 дБ";i:2;s:13:"от 120 дБ";}', NULL),
(361, 'Количество инструментов', 'ru', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_variants`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17894 ;

--
-- Dumping data for table `shop_product_variants`
--

INSERT INTO `shop_product_variants` (`id`, `product_id`, `price`, `number`, `stock`, `position`, `mainImage`, `external_id`, `currency`, `price_in_main`) VALUES
(4227, 4020, 38709.67742, '700203', 10, 0, '', NULL, 1, 1200.00000),
(4225, 4018, 20967.74194, '700201', 10, 0, '4018_main_origin.jpg', NULL, 1, 650.00000),
(1106, 1019, 114903.22581, '20011', 21, 0, '1019_main_origin.jpg', NULL, 1, 3562.00000),
(1035, 937, 1064129.03226, '30 001', 1, 0, '937_main_origin.jpg', NULL, 1, 32988.00000),
(1043, 945, 2065.00000, '30002', 10, 0, '945_main_origin.jpg', NULL, 2, 2065.00000),
(1047, 949, 1762.00000, '30003', 10, 0, '949_main_origin.jpg', NULL, 2, 1762.00000),
(1057, 955, 765.00000, '30004', 10, 0, '955_main_origin.jpg', NULL, 2, 765.00000),
(1058, 956, 724258.06452, '30006', 1, 0, '956_main_origin.jpg', NULL, 1, 22452.00000),
(1059, 957, 223000.00000, '30005', 1, 0, '957_main_origin.jpg', NULL, 1, 6913.00000),
(1061, 959, 17387.09677, '20003', 35, 0, '959_main_origin.jpg', NULL, 1, 539.00000),
(1092, 1006, 90161.29032, '20004', 12, 0, '1006_main_origin.jpg', NULL, 1, 2795.00000),
(1100, 1006, 89903.22581, '20007', 34, 3, '1006_main_origin.jpg', NULL, 1, 2787.00000),
(1099, 1006, 90096.77419, '20006', 18, 2, '1006_main_origin.jpg', NULL, 1, 2793.00000),
(1098, 1006, 90000.00000, '20005', 24, 1, '1006_main_origin.jpg', NULL, 1, 2790.00000),
(1103, 1015, 37096.77419, '20009', 54, 0, '1015_main_origin.jpg', NULL, 1, 1150.00000),
(1102, 1006, 89870.96774, '20008', 6, 4, '1006_main_origin.jpg', NULL, 1, 2786.00000),
(1105, 1018, 12838.70968, '20010', 32, 0, '1018_main_origin.jpg', NULL, 1, 398.00000),
(1107, 1021, 15322.58065, '20012', 19, 0, '1021_main_origin.jpg', NULL, 1, 475.00000),
(1108, 1022, 7354.83871, '20013', 25, 0, '1022_main_origin.jpg', NULL, 1, 228.00000),
(1109, 1023, 32580.64516, '20014', 1, 0, '1023_main_origin.jpg', NULL, 1, 1010.00000),
(1110, 1024, 5000.00000, '20015', 1, 0, '1024_main_origin.jpg', NULL, 1, 155.00000),
(1111, 1025, 3193.54839, '20016', 55, 0, '1025_main_origin.jpg', NULL, 1, 99.00000),
(1213, 1096, 117064.51613, '20018', 10, 0, '1096_main_origin.jpg', NULL, 1, 3629.00000),
(1216, 1099, 245000.00000, '20019', 10, 0, '1099_main_origin.jpg', NULL, 1, 7595.00000),
(1221, 1104, 4999.00000, '20020', 10, NULL, '1104_main_origin.jpg', NULL, 2, 4999.00000),
(1222, 1105, 5295.00000, '20021', 21, NULL, '1105_main_origin.jpg', NULL, 2, 5295.00000),
(1224, 1107, 1580.64516, '200332', 12, 0, '1107_main_origin.jpg', NULL, 1, 49.00000),
(1225, 1108, 175645.16129, '20023', 17, 0, '1108_main_origin.jpg', NULL, 1, 5445.00000),
(1226, 1109, 4354.83871, '20025', 35, 0, '1109_main_origin.jpg', NULL, 1, 135.00000),
(1227, 1110, 2225.80645, '20024', 4, 0, '1110_main_origin.jpg', NULL, 1, 69.00000),
(1228, 1111, 1258.06452, '20026', 2, 0, '1111_main_origin.jpg', NULL, 1, 39.00000),
(1229, 1112, 15709.67742, '2008', 20, 0, '1112_main_origin.jpg', NULL, 1, 487.00000),
(1230, 1113, 2387.09677, '20027', 1, 0, '1113_main_origin.jpg', NULL, 1, 74.00000),
(1231, 1114, 1451.61290, '20029', 3, 0, '1114_main_origin.jpg', NULL, 1, 45.00000),
(1232, 1115, 6064.51613, '20030', 4, 0, '1115_main_origin.jpg', NULL, 1, 188.00000),
(1234, 1117, 29000.00000, '20032', 5, 0, '1117_main_origin.jpg', NULL, 1, 899.00000),
(8365, 7983, 40.00000, '200530', 1, 0, '7983_main_origin.jpg', NULL, 2, 40.00000),
(8364, 7982, 40.00000, '200529', 1, 0, '7982_main_origin.jpg', NULL, 2, 40.00000),
(8361, 7979, 100.00000, '200526', 1, 0, '7979_main_origin.jpg', NULL, 2, 100.00000),
(8359, 7977, 100.00000, '200524', 1, 0, '7977_main_origin.jpg', NULL, 2, 100.00000),
(8357, 7975, 25.00000, '200522', 1, 0, '7975_main_origin.jpg', NULL, 2, 25.00000),
(4223, 4016, 3645.16129, '700200', 10, 0, '4016_main_origin.jpg', NULL, 1, 113.00000),
(4228, 4021, 2903.22581, '700204', 10, 0, '4021_main_origin.jpg', NULL, 1, 90.00000),
(13993, 13393, 2032.25806, '200638', 0, 0, '13393_main_origin.jpg', NULL, 1, 63.00000),
(13992, 13392, 2096.77419, '200637', 1, 0, '13392_main_origin.jpg', NULL, 1, 65.00000),
(13991, 13391, 1935.48387, '200636', 1, 0, '13391_main_origin.jpg', NULL, 1, 60.00000),
(13990, 13390, 1612.90323, '200635', 1, 0, '13390_main_origin.jpg', NULL, 1, 50.00000),
(13989, 13389, 6129.03226, '200634', 1, 0, '13389_main_origin.jpg', NULL, 1, 190.00000),
(13988, 13388, 1612.90323, '200633', 0, 0, '13388_main_origin.jpg', NULL, 1, 50.00000),
(13987, 13387, 2064.51613, '200632', 1, 0, '13387_main_origin.jpg', NULL, 1, 64.00000),
(13986, 13386, 4129.03226, '200631', 0, 0, '13386_main_origin.jpg', NULL, 1, 128.00000),
(13985, 13385, 1387.09677, '200630', 1, 0, '13385_main_origin.jpg', NULL, 1, 43.00000),
(13984, 13384, 2225.80645, '200629', 1, 0, '13384_main_origin.jpg', NULL, 1, 69.00000),
(5001, 4796, 19322.58065, '700300', 10, 0, '4796_main_origin.jpg', NULL, 1, 599.00000),
(5166, 4960, 59419.35484, '70036', 10, NULL, '', NULL, 1, 1842.00000),
(5165, 4959, 78258.06452, '70035', 10, NULL, '4959_main_origin.jpg', NULL, 1, 2426.00000),
(5164, 4958, 78258.06452, '70034', 10, NULL, '4958_main_origin.jpg', NULL, 1, 2426.00000),
(5163, 4957, 59419.35484, '70033', 10, NULL, '4957_main_origin.jpg', NULL, 1, 1842.00000),
(5161, 4955, 60064.51613, '70031', 10, NULL, '4955_main_origin.jpg', NULL, 1, 1862.00000),
(5156, 4950, 66967.74194, '70026', 10, NULL, '4950_main_origin.jpg', NULL, 1, 2076.00000),
(5854, 5624, 55.00000, '200237', 1, 0, '5624_main_origin.jpg', NULL, 2, 55.00000),
(5836, 5606, 100.00000, '200219', 0, 0, '5606_main_origin.jpg', NULL, 2, 100.00000),
(5855, 5625, 100.00000, '200238', 0, 0, '5625_main_origin.jpg', NULL, 2, 100.00000),
(5852, 5622, 100.00000, '200235', 0, 0, '5622_main_origin.jpg', NULL, 2, 100.00000),
(5853, 5623, 55.00000, '200236', 1, 0, '5623_main_origin.jpg', NULL, 2, 55.00000),
(5835, 5605, 100.00000, '200218', 0, 0, '5605_main_origin.jpg', NULL, 2, 100.00000),
(5834, 5604, 100.00000, '200217', 0, 0, '5604_main_origin.jpg', NULL, 2, 100.00000),
(5833, 5603, 100.00000, '200216', 0, 0, '5603_main_origin.jpg', NULL, 2, 100.00000),
(5827, 5596, 100.00000, '200206', 0, 0, '5596_main_origin.jpg', NULL, 2, 100.00000),
(5832, 5602, 100.00000, '200211', 0, 0, '5602_main_origin.jpg', NULL, 2, 100.00000),
(5856, 5626, 100.00000, '200239', 0, 0, '5626_main_origin.jpg', NULL, 2, 100.00000),
(5857, 5627, 100.00000, '200240', 0, 0, '5627_main_origin.jpg', NULL, 2, 100.00000),
(5858, 5628, 100.00000, '200241', 0, 0, '5628_main_origin.jpg', NULL, 2, 100.00000),
(5859, 5629, 100.00000, '200242', 0, 0, '5629_main_origin.jpg', NULL, 2, 100.00000),
(5860, 5630, 100.00000, '200243', 0, 0, '5630_main_origin.jpg', NULL, 2, 100.00000),
(5861, 5631, 100.00000, '200244', 0, 0, '5631_main_origin.jpg', NULL, 2, 100.00000),
(5862, 5632, 100.00000, '200245', 0, 0, '5632_main_origin.jpg', NULL, 2, 100.00000),
(5863, 5633, 100.00000, '200246', 0, 0, '5633_main_origin.jpg', NULL, 2, 100.00000),
(5864, 5634, 100.00000, '200247', 0, 0, '5634_main_origin.jpg', NULL, 2, 100.00000),
(6005, 5775, 100.00000, '200388', 0, 0, '5775_main_origin.jpg', NULL, 2, 100.00000),
(6512, 6192, 100.00000, '200389', 0, 0, '6192_main_origin.jpg', NULL, 2, 100.00000),
(6513, 6193, 100.00000, '200390', 10, NULL, '6193_main_origin.jpg', NULL, 2, 100.00000),
(6514, 6194, 100.00000, '200391', 0, 0, '6194_main_origin.jpg', NULL, 2, 100.00000),
(6515, 6195, 19.00000, '200392', 1, 0, '6195_main_origin.jpg', NULL, 2, 19.00000),
(6516, 6196, 100.00000, '200393', 0, 0, '6196_main_origin.jpg', NULL, 2, 100.00000),
(6517, 6197, 100.00000, '200394', 0, 0, '6197_main_origin.jpg', NULL, 2, 100.00000),
(6518, 6198, 100.00000, '200395', 0, 0, '6198_main_origin.jpg', NULL, 2, 100.00000),
(6519, 6199, 100.00000, '200396', 0, 0, '6199_main_origin.jpg', NULL, 2, 100.00000),
(6520, 6200, 100.00000, '200397', 1, 0, '6200_main_origin.jpg', NULL, 2, 100.00000),
(6521, 6201, 100.00000, '200398', 0, 0, '6201_main_origin.jpg', NULL, 2, 100.00000),
(6522, 6202, 17.00000, '200399', 1, 0, '6202_main_origin.jpg', NULL, 2, 17.00000),
(6523, 6203, 100.00000, '200400', 0, 0, '6203_main_origin.jpg', NULL, 2, 100.00000),
(6524, 6204, 100.00000, '200401', 0, 0, '6204_main_origin.jpg', NULL, 2, 100.00000),
(6525, 6205, 100.00000, '200402', 0, 0, '6205_main_origin.jpg', NULL, 2, 100.00000),
(6526, 6206, 100.00000, '200403', 0, 0, '6206_main_origin.jpg', NULL, 2, 100.00000),
(6527, 6207, 100.00000, '200404', 0, 0, '6207_main_origin.jpg', NULL, 2, 100.00000),
(6528, 6208, 12.00000, '200405', 1, 0, '6208_main_origin.jpg', NULL, 2, 12.00000),
(6531, 6211, 100.00000, '200408', 0, 0, '6211_main_origin.jpg', NULL, 2, 100.00000),
(6532, 6212, 100.00000, '200409', 0, 0, '6212_main_origin.jpg', NULL, 2, 100.00000),
(6535, 6215, 100.00000, '200412', 0, 0, '6215_main_origin.jpg', NULL, 2, 100.00000),
(6536, 6216, 100.00000, '200413', 0, 0, '6216_main_origin.jpg', NULL, 2, 100.00000),
(6537, 6217, 100.00000, '200414', 0, 0, '6217_main_origin.jpg', NULL, 2, 100.00000),
(6538, 6218, 100.00000, '200415', 0, 0, '6218_main_origin.jpg', NULL, 2, 100.00000),
(6539, 6219, 3290.32258, '200416', 1, 0, '6219_main_origin.jpg', NULL, 1, 102.00000),
(6540, 6220, 100.00000, '200417', 0, 0, '6220_main_origin.jpg', NULL, 2, 100.00000),
(6541, 6221, 100.00000, '200418', 0, 0, '6221_main_origin.jpg', NULL, 2, 100.00000),
(6542, 6222, 100.00000, '200419', 0, 0, '6222_main_origin.jpg', NULL, 2, 100.00000),
(6543, 6223, 5806.45161, '200420', 1, 0, '6223_main_origin.jpg', NULL, 1, 180.00000),
(6544, 6224, 100.00000, '200421', 0, 0, '6224_main_origin.jpg', NULL, 2, 100.00000),
(6545, 6225, 100.00000, '200422', 0, 0, '6225_main_origin.jpg', NULL, 2, 100.00000),
(6546, 6226, 100.00000, '200423', 0, 0, '6226_main_origin.jpg', NULL, 2, 100.00000),
(6547, 6227, 6419.35484, '200424', 1, 0, '6227_main_origin.jpg', NULL, 1, 199.00000),
(6548, 6228, 100.00000, '200425', 0, 0, '6228_main_origin.jpg', NULL, 2, 100.00000),
(6549, 6229, 100.00000, '200426', 0, 0, '6229_main_origin.jpg', NULL, 2, 100.00000),
(6550, 6230, 100.00000, '200427', 0, 0, '6230_main_origin.jpg', NULL, 2, 100.00000),
(7187, 6843, 100.00000, '200434', 0, 0, '6843_main_origin.jpg', NULL, 2, 100.00000),
(7188, 6844, 100.00000, '200435', 0, 0, '6844_main_origin.jpg', NULL, 2, 100.00000),
(8363, 7981, 100.00000, '200528', 1, 0, '7981_main_origin.jpg', NULL, 2, 100.00000),
(8366, 7984, 100.00000, '200531', 1, 0, '7984_main_origin.jpg', NULL, 2, 100.00000),
(8362, 7980, 100.00000, '200527', 1, 0, '7980_main_origin.jpg', NULL, 2, 100.00000),
(8360, 7978, 100.00000, '200525', 1, 0, '7978_main_origin.jpg', NULL, 2, 100.00000),
(8358, 7976, 30.00000, '200523', 1, 0, '7976_main_origin.jpg', NULL, 2, 30.00000),
(8356, 7974, 25.00000, '200521', 1, 0, '7974_main_origin.jpg', NULL, 2, 25.00000),
(8367, 7985, 100.00000, '200532', 1, 0, '7985_main_origin.jpg', NULL, 2, 100.00000),
(8368, 7986, 100.00000, '200533', 1, 0, '7986_main_origin.jpg', NULL, 2, 100.00000),
(8369, 7987, 100.00000, '200534', 1, 0, '7987_main_origin.jpg', NULL, 2, 100.00000),
(8370, 7988, 30.00000, '200535', 1, 0, '7988_main_origin.jpg', NULL, 2, 30.00000),
(8371, 7989, 30.00000, '200536', 1, 0, '7989_main_origin.jpg', NULL, 2, 30.00000),
(8372, 7990, 36.00000, '200537', 1, 0, '7990_main_origin.jpg', NULL, 2, 36.00000),
(8373, 7991, 36.00000, '200538', 1, 0, '7991_main_origin.jpg', NULL, 2, 36.00000),
(8374, 7992, 100.00000, '200539', 1, 0, '7992_main_origin.jpg', NULL, 2, 100.00000),
(8837, 8430, 5129.03226, '90300', 5, 0, '8430_main_origin.jpg', NULL, 1, 159.00000),
(8838, 8431, 5129.03226, '90301', 5, 0, '8431_main_origin.jpg', NULL, 1, 159.00000),
(8839, 8432, 21258.06452, '90302', 5, 0, '8432_main_origin.jpg', NULL, 1, 659.00000),
(8840, 8433, 9645.16129, '90303', 5, NULL, '8433_main_origin.jpg', NULL, 1, 299.00000),
(8841, 8434, 9645.16129, '90304', 5, NULL, '8434_main_origin.jpg', NULL, 1, 299.00000),
(10637, 10179, 16.85000, '200609', 1, 0, '10179_main_origin.jpg', NULL, 2, 16.85000),
(10638, 10180, 35.00000, '200610', 1, 0, '10180_main_origin.jpg', NULL, 2, 35.00000),
(10639, 10181, 8.89000, '200611', 1, 0, '10181_main_origin.jpg', NULL, 2, 8.89000),
(10640, 10182, 15.00000, '200612', 1, 0, '10182_main_origin.jpg', NULL, 2, 15.00000),
(10641, 10182, 14.00000, '200613', 1, 1, '10182_main_origin.jpg', NULL, 2, 14.00000),
(10642, 10183, 10.00000, '200614', 1, 0, '10183_main_origin.jpg', NULL, 2, 10.00000),
(10643, 10183, 10.00000, '200615', 1, 1, '10183_main_origin.jpg', NULL, 2, 10.00000),
(10644, 10183, 10.00000, '200616', 1, 2, '10183_main_origin.jpg', NULL, 2, 10.00000),
(10645, 10183, 10.00000, '200618', 1, 3, '10183_main_origin.jpg', NULL, 2, 10.00000),
(10646, 10184, 9.00000, '200619', 1, 0, '10184_main_origin.jpg', NULL, 2, 9.00000),
(11193, 10734, 100.00000, '200448', 0, 0, '10734_main_origin.jpg', NULL, 2, 100.00000),
(12774, 12179, 100.00000, '200484', 0, 0, '12179_main_origin.jpg', NULL, 2, 100.00000),
(12773, 12178, 100.00000, '200483', 0, 0, '12178_main_origin.jpg', NULL, 2, 100.00000),
(12772, 12177, 100.00000, '200482', 0, 0, '12177_main_origin.jpg', NULL, 2, 100.00000),
(12771, 12176, 100.00000, '200481', 0, 0, '12176_main_origin.jpg', NULL, 2, 100.00000),
(12770, 12175, 100.00000, '200480', 0, 0, '12175_main_origin.jpg', NULL, 2, 100.00000),
(12769, 12174, 100.00000, '200479', 0, 0, '12174_main_origin.jpg', NULL, 2, 100.00000),
(12768, 12173, 100.00000, '200478', 0, 0, '12173_main_origin.jpg', NULL, 2, 100.00000),
(12767, 12172, 100.00000, '200477', 0, 0, '12172_main_origin.jpg', NULL, 2, 100.00000),
(12766, 12171, 100.00000, '200476', 0, 0, '12171_main_origin.jpg', NULL, 2, 100.00000),
(12765, 12170, 100.00000, '200475', 0, 0, '12170_main_origin.jpg', NULL, 2, 100.00000),
(12764, 12169, 100.00000, '200474', 0, 0, '12169_main_origin.jpg', NULL, 2, 100.00000),
(12763, 12168, 100.00000, '200473', 0, 0, '12168_main_origin.jpg', NULL, 2, 100.00000),
(12762, 12167, 100.00000, '200472', 0, 0, '12167_main_origin.jpg', NULL, 2, 100.00000),
(12761, 12166, 100.00000, '200471', 0, 0, '1404815.jpg', NULL, 2, 100.00000),
(12760, 12165, 7.00000, '200470', 1, 0, '12165_main_origin.jpg', NULL, 2, 7.00000),
(12759, 12164, 100.00000, '200469', 0, 0, '12164_main_origin.jpg', NULL, 2, 100.00000),
(12758, 12163, 7.00000, '200468', 1, 0, '12163_main_origin.jpg', NULL, 2, 7.00000),
(12757, 12162, 7.00000, '200467', 1, 0, '12162_main_origin.jpg', NULL, 2, 7.00000),
(11667, 11210, 100.00000, '200428', 0, 0, '11210_main_origin.jpg', NULL, 2, 100.00000),
(11668, 11211, 100.00000, '200429', 0, 0, '11211_main_origin.jpg', NULL, 2, 100.00000),
(11669, 11212, 100.00000, '200430', 0, 0, '11212_main_origin.jpg', NULL, 2, 100.00000),
(11670, 11213, 100.00000, '200431', 0, 0, '11213_main_origin.jpg', NULL, 2, 100.00000),
(11671, 11214, 100.00000, '200432', 0, 0, '11214_main_origin.jpg', NULL, 2, 100.00000),
(11672, 11215, 100.00000, '200433', 0, 0, '11215_main_origin.jpg', NULL, 2, 100.00000),
(11673, 11216, 100.00000, '200436', 0, 0, '11216_main_origin.jpg', NULL, 2, 100.00000),
(11674, 11217, 100.00000, '200437', 0, 0, '11217_main_origin.jpg', NULL, 2, 100.00000),
(11675, 11218, 100.00000, '200438', 0, 0, '11218_main_origin.jpg', NULL, 2, 100.00000),
(11676, 11219, 100.00000, '200439', 0, 0, '11219_main_origin.jpg', NULL, 2, 100.00000),
(11677, 11220, 100.00000, '200440', 0, 0, '11220_main_origin.jpg', NULL, 2, 100.00000),
(11678, 11221, 100.00000, '200441', 0, 0, '11221_main_origin.jpg', NULL, 2, 100.00000),
(11679, 11222, 100.00000, '200442', 0, 0, '11222_main_origin.jpg', NULL, 2, 100.00000),
(11680, 11223, 100.00000, '200443', 0, 0, '11223_main_origin.jpg', NULL, 2, 100.00000),
(11681, 11224, 100.00000, '200444', 0, 0, '11224_main_origin.jpg', NULL, 2, 100.00000),
(11682, 11225, 100.00000, '200445', 0, 0, '11225_main_origin.jpg', NULL, 2, 100.00000),
(11683, 11226, 100.00000, '200446', 0, 0, '11226_main_origin.jpg', NULL, 2, 100.00000),
(11684, 11227, 100.00000, '200447', 0, 0, '11227_main_origin.jpg', NULL, 2, 100.00000),
(12810, 12215, 100.00000, '200520', 0, 0, '12215_main_origin.jpg', NULL, 2, 100.00000),
(12625, 12030, 156.00000, '20190', 1, 0, '12030_main_origin.jpg', NULL, 2, 156.00000),
(12626, 12031, 156.00000, '20191', 1, 0, '12031_main_origin.jpg', NULL, 2, 156.00000),
(12627, 12032, 100.00000, '20192', 0, 0, '12032_main_origin.jpg', NULL, 2, 100.00000),
(12628, 12033, 100.00000, '20193', 0, 0, '12033_main_origin.jpg', NULL, 2, 100.00000),
(12629, 12034, 210.00000, '20194', 1, 0, '12034_main_origin.jpg', NULL, 2, 210.00000),
(12630, 12035, 210.00000, '20195', 1, 0, '12035_main_origin.jpg', NULL, 2, 210.00000),
(12631, 12036, 210.00000, '20196', 1, 0, '12036_main_origin.jpg', NULL, 2, 210.00000),
(12633, 12038, 210.00000, '20198', 1, 0, '12038_main_origin.jpg', NULL, 2, 210.00000),
(12634, 12039, 215.00000, '20199', 1, 0, '12039_main_origin.jpg', NULL, 2, 215.00000),
(12635, 12040, 215.00000, '20200', 1, 0, '12040_main_origin.jpg', NULL, 2, 215.00000),
(12636, 12041, 212.00000, '20201', 1, 0, '12041_main_origin.jpg', NULL, 2, 212.00000),
(12637, 12042, 285.00000, '20202', 1, 0, '12042_main_origin.jpg', NULL, 2, 285.00000),
(12638, 12043, 100.00000, '20203', 0, 0, '12043_main_origin.jpg', NULL, 2, 100.00000),
(12640, 12045, 285.00000, '20205', 1, 0, '12045_main_origin.jpg', NULL, 2, 285.00000),
(13330, 12737, 196.00000, '30319', 10, 0, '12737_main_origin.jpg', NULL, 2, 196.00000),
(13982, 13382, 1451.61290, '200627', 1, 0, '13382_main_origin.jpg', NULL, 1, 45.00000),
(13981, 13381, 1612.90323, '200626', 1, 0, '13381_main_origin.jpg', NULL, 1, 50.00000),
(13980, 13380, 1290.32258, '200625', 1, 0, '13380_main_origin.jpg', NULL, 1, 40.00000),
(13979, 13379, 1612.90323, '200624', 1, 0, '13379_main_origin.jpg', NULL, 1, 50.00000),
(13978, 13378, 5.00000, '200623', 1, 0, '13378_main_origin.jpg', NULL, 2, 5.00000),
(13977, 13377, 1451.61290, '200622', 1, 0, '13377_main_origin.jpg', NULL, 1, 45.00000),
(13976, 13376, 4.00000, '200621', 1, 0, '13376_main_origin.jpg', NULL, 2, 4.00000),
(13983, 13383, 4806.45161, '200628', 1, 0, '13383_main_origin.jpg', NULL, 1, 149.00000),
(14487, 13889, 100.00000, '200647', 0, 0, '13889_main_origin.jpg', NULL, 2, 100.00000),
(14488, 13890, 100.00000, '200648', 0, 0, '13890_main_origin.jpg', NULL, 2, 100.00000),
(14489, 13891, 4.00000, '200649', 1, 0, '13891_main_origin.jpg', NULL, 2, 4.00000),
(14490, 13892, 100.00000, '200650', 0, 0, '13892_main_origin.jpg', NULL, 2, 100.00000),
(14491, 13893, 100.00000, '200651', 0, 0, '13893_main_origin.jpg', NULL, 2, 100.00000),
(14492, 13894, 100.00000, '200652', 0, 0, '13894_main_origin.jpg', NULL, 2, 100.00000),
(14493, 13895, 14.00000, '200653', 1, 0, '13895_main_origin.jpg', NULL, 2, 14.00000),
(14494, 13896, 100.00000, '200654', 0, 0, '13896_main_origin.jpg', NULL, 2, 100.00000),
(14495, 13897, 15.00000, '200655', 1, 0, '13897_main_origin.jpg', NULL, 2, 15.00000),
(14496, 13898, 12.00000, '200656', 1, 0, '13898_main_origin.jpg', NULL, 2, 12.00000),
(14497, 13899, 29.00000, '200657', 1, 0, '13899_main_origin.jpg', NULL, 2, 29.00000),
(14498, 13900, 100.00000, '200658', 0, 0, '13900_main_origin.jpg', NULL, 2, 100.00000),
(14499, 13901, 31.00000, '200659', 1, 0, '13901_main_origin.jpg', NULL, 2, 31.00000),
(14500, 13902, 25.00000, '200660', 1, 0, '13902_main_origin.jpg', NULL, 2, 25.00000),
(14501, 13903, 5.00000, '200661', 1, 0, '13903_main_origin.jpg', NULL, 2, 5.00000),
(14502, 13904, 100.00000, '200662', 10, NULL, '13904_main_origin.jpg', NULL, 2, 100.00000),
(14503, 13905, 9.00000, '200663', 1, 0, '13905_main_origin.jpg', NULL, 2, 9.00000),
(14504, 13906, 100.00000, '200664', 0, 0, '13906_main_origin.jpg', NULL, 2, 100.00000),
(14505, 13907, 6.00000, '200665', 1, 0, '13907_main_origin.jpg', NULL, 2, 6.00000),
(14788, 14190, 21.60000, '200931', 1, 0, '14190_main_origin.jpg', NULL, 2, 21.60000),
(14790, 14192, 95.00000, '200932', 1, 0, '14192_main_origin.jpg', NULL, 2, 95.00000),
(14792, 14194, 23.00000, '200933', 1, 0, '14194_main_origin.jpg', NULL, 2, 23.00000),
(14794, 14196, 36.90000, '200934', 1, 0, '14196_main_origin.jpg', NULL, 2, 36.90000),
(14796, 14198, 6290.32258, '200935', 1, 0, '14198_main_origin.jpg', NULL, 1, 195.00000),
(14797, 14199, 9645.16129, '200936', 1, 0, '14199_main_origin.jpg', NULL, 1, 299.00000),
(14798, 14200, 9741.93548, '200937', 1, 0, '14200_main_origin.jpg', NULL, 1, 302.00000),
(14799, 14201, 19193.54839, '200938', 1, 0, '14201_main_origin.jpg', NULL, 1, 595.00000),
(14800, 14202, 6741.93548, '200939', 1, 0, '14202_main_origin.jpg', NULL, 1, 209.00000),
(14801, 14203, 1451.61290, '200940', 1, 0, '14203_main_origin.jpg', NULL, 1, 45.00000),
(14802, 14204, 1935.48387, '200941', 1, 0, '14204_main_origin.jpg', NULL, 1, 60.00000),
(14803, 14205, 1451.61290, '200942', 1, 0, '14205_main_origin.jpg', NULL, 1, 45.00000),
(14804, 14206, 5129.03226, '200943', 1, 0, '14206_main_origin.jpg', NULL, 1, 159.00000),
(15425, 14775, 15.00000, '200958', 1, 0, '14775_main_origin.jpg', NULL, 2, 15.00000),
(17521, 16825, 15.00000, '200959', 1, 0, '16825_main_origin.jpg', NULL, 2, 15.00000),
(17522, 16826, 15.00000, '200960', 1, 0, '16826_main_origin.jpg', NULL, 2, 15.00000),
(17523, 16827, 15.00000, '200961', 1, 0, '16827_main_origin.jpg', NULL, 2, 15.00000),
(17524, 16828, 15.00000, '200962', 1, 0, '16828_main_origin.jpg', NULL, 2, 15.00000),
(17525, 16829, 10.00000, '200963', 1, 0, '16829_main_origin.jpg', NULL, 2, 10.00000),
(17526, 16830, 15.00000, '200964', 1, 0, '16830_main_origin.jpg', NULL, 2, 15.00000),
(17527, 16831, 15.00000, '200965', 1, 0, '16831_main_origin.jpg', NULL, 2, 15.00000),
(17528, 16832, 100.00000, '200966', 0, 0, '16832_main_origin.jpg', NULL, 2, 100.00000),
(17529, 16833, 100.00000, '200967', 10, 0, '16833_main_origin.jpg', NULL, 2, 100.00000),
(17530, 16834, 8.00000, '200968', 1, 0, '16834_main_origin.jpg', NULL, 2, 8.00000),
(17531, 16835, 9.00000, '200969', 1, 0, '16835_main_origin.jpg', NULL, 2, 9.00000),
(17532, 16836, 100.00000, '200970', 0, 0, '16836_main_origin.jpg', NULL, 2, 100.00000),
(17590, 10180, 52.00000, '201028', 1, 0, '10180_main_origin.jpg', NULL, 2, 52.00000),
(17617, 10183, 13.00000, '201055', 1, 0, '10183_main_origin.jpg', NULL, 2, 13.00000);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_variants_i18n`
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
-- Dumping data for table `shop_product_variants_i18n`
--

INSERT INTO `shop_product_variants_i18n` (`id`, `locale`, `name`) VALUES
(1106, 'ru', ''),
(1035, 'ru', ''),
(1043, 'ru', '3D LED-телевизор Philips 46PFL8008S/60'),
(1047, 'ru', '3D LED-телевизор Philips 47PFL7008S/12'),
(1057, 'ru', '3D LED-телевизор Samsung UE32F6100AKXUA'),
(1058, 'ru', '3D LED-телевизор Samsung UE32F6400AKXUA'),
(1059, 'ru', '3D LED-телевизор Samsung UE32F6330AKXUA'),
(1061, 'ru', ''),
(1092, 'ru', ''),
(1098, 'ru', 'MP3 / MP4-плеер Apple iPod touch 5G 32GB pink'),
(1099, 'ru', 'MP3 / MP4-плеер Apple iPod touch 5G 32GB red '),
(1100, 'ru', 'MP3 / MP4-плеер Apple iPod touch 5G 32GB blue'),
(1103, 'ru', ''),
(1102, 'ru', 'MP3 / MP4-плеер Apple iPod touch 5G 32GB yellow '),
(1105, 'ru', ''),
(1107, 'ru', ''),
(1108, 'ru', ''),
(1109, 'ru', ''),
(1110, 'ru', ''),
(1111, 'ru', ''),
(1213, 'ru', ''),
(1216, 'ru', ''),
(1221, 'ru', ''),
(1222, 'ru', ''),
(1224, 'ru', ''),
(1225, 'ru', ''),
(1226, 'ru', ''),
(1227, 'ru', ''),
(1228, 'ru', ''),
(1229, 'ru', ''),
(1230, 'ru', ''),
(1231, 'ru', ''),
(1232, 'ru', ''),
(1234, 'ru', ''),
(4223, 'ru', 'Вставка для беременных в демисезонную слингокуртку (ВБДУ-010.00) ТМ Katinka'),
(4228, 'ru', 'Вставка для беременных в зимнюю слингокуртку (ВБЗ-010.00) ТМ Katinka'),
(4227, 'ru', 'Зимняя универсальная слингокуртка 5 в 1 с возможностью ношения за спиной. (ЗС-020.00) ТМ Katinka'),
(4225, 'ru', 'Демисезонная мужская слингокуртка для папы. Размеры 44, 46, 48, 50, 52, 54 (ДСП-010.00) ТМ Katinka'),
(13993, 'ru', ''),
(13991, 'ru', ''),
(13989, 'ru', ''),
(5001, 'ru', 'Легкая универсальная слингокуртка-ветровка 3 в 1 Белый-розовый, размеры S, M, L (ЛС-010.00) ТМ Katinka'),
(5156, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ СONCORDA CD550'),
(5161, 'ru', 'Електрогітара серії "BADWATER" AL820CKBW'),
(5163, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ STANDARD D350BG'),
(5164, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ STANDARD D350CEBG'),
(5165, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ STANDARD D350CEG'),
(5166, 'ru', 'АКУСТИЧНА ГІТАРА СЕРІЇ STANDARD D350G'),
(5852, 'ru', 'Мобильный телефон Fly E133 Duos White'),
(5853, 'ru', 'Мобильный телефон Fly E141 TV Dual SIM Black'),
(5854, 'ru', 'Мобильный телефон Fly E141 TV Dual SIM White'),
(5863, 'ru', 'Мобильный телефон Fly EZZY Black'),
(5864, 'ru', 'Мобильный телефон Fly Ezzy Flip Dual Sim Black'),
(5856, 'ru', 'Мобильный телефон Fly E145 TV Dual Sim White'),
(5857, 'ru', 'Мобильный телефон Fly E154 Dual Sim Black'),
(5858, 'ru', 'Мобильный телефон Fly E154 Dual Sim Silver'),
(5859, 'ru', 'Мобильный телефон Fly E171 Duos High Glossy Black'),
(5860, 'ru', 'Мобильный телефон Fly E190 Duos Wi-Fi Black'),
(5861, 'ru', 'Мобильный телефон Fly E200 Duos Metalic'),
(5862, 'ru', 'Мобильный телефон Fly E210 Сhrome'),
(5855, 'ru', 'Мобильный телефон Fly E145 TV Dual Sim Black'),
(5836, 'ru', 'Мобильный телефон Fly E176 Duos Silver'),
(5835, 'ru', 'Мобильный телефон Fly E185 Black Bronze'),
(5834, 'ru', 'Мобильный телефон Fly DS103 Duos Grey'),
(5833, 'ru', 'Мобильный телефон Fly B300 Duos Grey'),
(5832, 'ru', 'Мобильный телефон Fly DS103D Duos Black'),
(5827, 'ru', 'Мобильный телефон Alcatel DS 10.60 Dual SIM'),
(6005, 'ru', 'Аккумулятор Samsung EB-F1A2GBUCSTD I9100 Black'),
(6512, 'ru', 'Аккумулятор Samsung EB-K1A2EBEGSTD Black'),
(6513, 'ru', 'Аккумулятор Samsung EB-K1A2EWEGSTD White'),
(6514, 'ru', 'Аккумулятор Samsung EB-L1F2HVUCSTD Black I9250'),
(6515, 'ru', 'Аккумулятор Samsung EB-L1G6LLUCSTD I9300 Black'),
(6516, 'ru', 'Аккумулятор Samsung EB595675LUCSTD N7100 Black'),
(6517, 'ru', 'Аккумулятор Samsung EB615268VUCSTD Black N7000'),
(6518, 'ru', 'Автомобильное зарядное устройство Samsung ECA-P10CBECSTD Black'),
(6519, 'ru', 'Зарядное устройство Samsung ECA-U16CBEGSTD N7000 Black'),
(6520, 'ru', 'Зарядное устройство Samsung ETA-P11EBEGSTD Galaxy P3100/P5100/N8000 Black'),
(6521, 'ru', 'Зарядное устройство Samsung ETA-U90EBEGSTD N7100 Black'),
(6522, 'ru', 'Зарядное устройство Samsung ETA-U90EWEGSTD N7100 White'),
(6523, 'ru', 'Зарядное устройство Samsung ETA0U10EBECSTD Black'),
(6524, 'ru', 'Зарядное устройство Samsung ETA0U80EBEGSTD Black N7000'),
(6525, 'ru', 'Зарядное устройство UFO EC-004 5V (+ 2 адаптора Nokia Kit)'),
(6526, 'ru', 'Зарядное устройство-подставка Samsung EDD-D100WEGSTD TAB/TAB2 desktop dock White'),
(6527, 'ru', 'Подставка с зарядным устройством Samsung EBH1A2USBECSTD Black'),
(6528, 'ru', 'Подставка-держатель Samsung EB-H1J9VNEGSTD N7100 White (+ аккумулятор)'),
(6531, 'ru', 'Гарнитура HTC RC E240 Black'),
(6532, 'ru', 'Гарнитура HTC RC E240 White'),
(6535, 'ru', 'Гарнитура Samsung EHS60ANNBECSTD Black'),
(6536, 'ru', 'Гарнитура Samsung EHS60ANNWECSTD White'),
(6537, 'ru', 'Гарнитура Samsung EHS60ENNBECSTD Black'),
(6538, 'ru', 'Гарнитура Samsung EHS60ENNWECSTD White'),
(6539, 'ru', 'Гарнитура Samsung EHS62ASNKECSTD Blue'),
(6540, 'ru', 'Гарнитура Samsung EHS62ASNPECSTD Pink'),
(6541, 'ru', 'Гарнитура Samsung EHS62ASNWECSTD White'),
(6542, 'ru', 'Гарнитура Samsung EHS63ASNBECSTD Black'),
(6543, 'ru', 'Гарнитура Samsung EHS64ASFWECSTD White'),
(6544, 'ru', 'Комплект свободные руки Jabra Bluetooth Headset  BT 2015'),
(6545, 'ru', 'Комплект свободные руки Jabra Bluetooth Headset  BT 2070'),
(6546, 'ru', 'Комплект свободные руки Nokia Bluetooth Headset BH-104 Black'),
(6547, 'ru', 'Комплект свободные руки Nokia Headset Bluetooth BH-110 Black'),
(6548, 'ru', 'Комплект свободные руки Nokia Headset Bluetooth BH-110 White'),
(6549, 'ru', 'Комплект свободные руки Samsung AWEP460EBEGSEK Black Bluetooth Headset'),
(6550, 'ru', 'Комплект свободные руки Samsung BHM1200EBEGSEK Black'),
(7187, 'ru', 'Док-станция Samsung EDD-D1E1BEGSTD Black'),
(7188, 'ru', 'Док-станция Samsung EDD-H1F2BEGSTD Black I9250'),
(8356, 'ru', 'MP3-флэш плеер Ergo Zen Basic 4 GB Blue'),
(8357, 'ru', 'MP3-флэш плеер Ergo Zen Basic 4 GB White'),
(8358, 'ru', 'MP3-флэш плеер Ergo Zen Basic 8 GB Black'),
(8359, 'ru', 'MP3-флэш плеер Ergo Zen modern 2 GB Black'),
(8360, 'ru', 'MP3-флэш плеер Ergo Zen modern 2 GB Red'),
(8361, 'ru', 'MP3-флэш плеер Ergo Zen modern 4 GB Black'),
(8362, 'ru', 'MP3-флэш плеер Ergo Zen modern 4 GB Blue'),
(8363, 'ru', 'MP3-флэш плеер Ergo Zen modern 4 GB Red'),
(8364, 'ru', 'MP3-флэш плеер Ergo Zen modern 8 GB Black'),
(8365, 'ru', 'MP3-флэш плеер Ergo Zen modern 8 GB Red'),
(8366, 'ru', 'MP3-флэш плеер Ergo Zen Style 4 GB'),
(8367, 'ru', 'MP3-флэш плеер Ergo Zen Style 8 GB'),
(8368, 'ru', 'МР3-флэш плеер Ergo Zen Little 2 GB Blue'),
(8369, 'ru', 'МР3-флэш плеер Ergo Zen Clip 2 GB Black'),
(8370, 'ru', 'MP3-флэш плеер Ergo Zen Volume 4 GB Black'),
(8371, 'ru', 'MP3-флэш плеер Ergo Zen Volume 4 GB White'),
(8372, 'ru', 'MP3-флэш плеер Ergo Zen Volume 8 GB Black'),
(8373, 'ru', 'MP3-флэш плеер Ergo Zen Volume 8 GB White'),
(8374, 'ru', 'MP3-флэш плеер Iriver E-40 4 GB Dark Gray'),
(8837, 'ru', 'Вкладыш для спального мешка EASY CAMP Cotton Travel Sheet - Mummy'),
(8838, 'ru', 'Вкладыш для спального мешка EASY CAMP Cotton Travel Sheet - Rectangular'),
(14487, 'ru', 'Карта памяти Transcend microSDHC 16 GB Class 10 UHS-I Ultimate (X600) (+ адаптер)'),
(8839, 'ru', 'Спальный мешок EASY CAMP Atlanta Plus'),
(8840, 'ru', 'Спальный мешок EASY CAMP Chakra Black'),
(8841, 'ru', 'Спальный мешок EASY CAMP Chakra Pink'),
(13987, 'ru', ''),
(10637, 'ru', ''),
(10638, 'ru', ''),
(10639, 'ru', ''),
(10640, 'ru', 'Sony MDR EX10LP Black'),
(10641, 'ru', 'Sony MDR EX10LP Red'),
(10642, 'ru', 'RP-HJE120E-K'),
(10643, 'ru', 'RP-HJE120E-P '),
(10644, 'ru', ' RP-HJE120E-D'),
(10645, 'ru', 'RP-HJE120E -G '),
(10646, 'ru', ''),
(11193, 'ru', 'Чехол HTC HC V841'),
(12774, 'ru', 'Чехол-книжка Samsung EFC-1G6FLECSTD I9300 Light Blue'),
(12773, 'ru', 'Чехол-книжка Samsung EFC-1G6FGECSTD I9300 Titanium Silver'),
(12772, 'ru', 'Чехол-книжка Samsung EFC-1G6FBECSTD I9300 Pebble Blue'),
(12771, 'ru', 'Чехол-книжка Samsung EFC-1G5SGECSTD P3100/P3110 Dark Gray'),
(12770, 'ru', 'Чехол-книжка Samsung EFC-1G5NGECSTD P3100/P3110 Black'),
(12769, 'ru', 'Чехол-книжка Samsung EFC-1G2NRECSTD Garnet Red'),
(12768, 'ru', 'Чехол-книжка Samsung EFC-1G2NLECSTD Light Blue'),
(12767, 'ru', 'Чехол-книжка Samsung EFC-1G2NGECSTD Dark Gray'),
(12766, 'ru', 'Чехол-книжка Samsung EFC-1G2NAECSTD Amber Brown'),
(12765, 'ru', 'Чехол Samsung EFC-1J9BWEGSTD N7100 White'),
(12764, 'ru', 'Чехол Samsung EFC-1J9BPEGSTD N7100 Pink'),
(12763, 'ru', 'Чехол Samsung EFC-1J9BBEGSTD N7100 Black'),
(12762, 'ru', 'Чехол Samsung EFC-1H8NGECSTD P5100/P5110'),
(12761, 'ru', 'Чехол Samsung EFC-1G6WWECSTD White'),
(12760, 'ru', 'Чехол Samsung EFC-1G6WPECSTD I9300 Pink'),
(12759, 'ru', 'Чехол Samsung EFC-1G6WBECSTD Blue'),
(12758, 'ru', 'Чехол Samsung EFC-1G6SWECSTD I9300 White'),
(12757, 'ru', 'Чехол Samsung EFC-1G6PPECSTD I9300 Pink'),
(11667, 'ru', 'USB кабель HTC DC M410'),
(11668, 'ru', 'Защитная пленка HTC SP P910'),
(11669, 'ru', 'Мультимедийный модуль HTC DG H200'),
(11670, 'ru', 'Cтилус и ручка-чехол Samsung ET-S110EBEGSTD Black'),
(11671, 'ru', 'USB адаптер Samsung EPL-1PL0BEGSTD Black'),
(11672, 'ru', 'Дата-кабель Samsung ECC1DP0UBECSTD Black'),
(11673, 'ru', 'Защитная пленка Samsung ETC-P1G5CEGSTD P3100/P3110'),
(11674, 'ru', 'Кабель для подключения к телевизору Samsung EPL-3FHUBEGSTD Black'),
(11675, 'ru', 'Клавиатура Samsung EKD-K11RWEGSER P3100/P3110 Black'),
(11676, 'ru', 'Клавиатура Samsung EKD-K12RWEGSER P5100/P5110 Black'),
(11677, 'ru', 'Подставка Samsung EDD-D1C9BEGSTD Black'),
(11678, 'ru', 'Подставка-держатель Samsung EBH-1E1SBEGSTD Black'),
(11679, 'ru', 'Стилус Samsung ET-S100EBEGSTD Black'),
(11680, 'ru', 'Стилус Samsung ETC-S10CSEGSTD I9300 Silver'),
(11681, 'ru', 'Стилус Samsung ETC-S1J9SEGSTD N7100 Dark Silver'),
(11682, 'ru', 'Стилус Samsung ETC-S1J9WEGSTD N7100 White'),
(11683, 'ru', 'Универсальная подставка Samsung EDD-D100BEGSTD Black'),
(11684, 'ru', 'Универсальная подставка Samsung EDD-D200BEGSTD Black'),
(12810, 'ru', 'Чехол-футляр Samsung EFC-1J9LDEGSTD N7100 Dark Brown'),
(12625, 'ru', 'Смартфон Samsung GT-S6500 Galaxy Mini 2 RWD Ceramic White'),
(12626, 'ru', 'Смартфон Samsung GT-S6500 Galaxy Mini 2 ZYD Yellow'),
(12627, 'ru', 'Смартфон Samsung GT-S6802 AKA Galaxy Ace Duos Metallic Black'),
(12628, 'ru', 'Смартфон Samsung GT-S6802 CWA Galaxy Ace Duos Сhic White'),
(12629, 'ru', 'Смартфон Samsung GT-S6802 Galaxy Ace Duos ZKA Black'),
(12630, 'ru', 'Смартфон Samsung GT-S6802 TIZ Galaxy Ace Duos Romantic Pink La Fleur'),
(12631, 'ru', 'Смартфон Samsung GT-S6802 ZIA Galaxy Ace Duos Pink'),
(12633, 'ru', 'Смартфон Samsung GT-S6802 ZYA Galaxy Ace Duos Yellow'),
(12634, 'ru', 'Смартфон Samsung GT-S6810 Galaxy Fame Metallic Blue'),
(12635, 'ru', 'Смартфон Samsung GT-S6810 Galaxy Fame Pure White'),
(12636, 'ru', 'Смартфон Samsung GT-S7500 ABA Galaxy Ace Plus Dark Blue'),
(12637, 'ru', 'Смартфон Samsung GT-S7500 CWA Galaxy Ace Plus Chic White'),
(12638, 'ru', 'Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey'),
(12640, 'ru', 'Смартфон Samsung GT-S7562 Galaxy S Duos ZKA Black'),
(13330, 'ru', 'ЖК-телевизор BBK LEM2249HD Black'),
(13992, 'ru', ''),
(13990, 'ru', ''),
(13988, 'ru', ''),
(13985, 'ru', ''),
(13986, 'ru', ''),
(13983, 'ru', ''),
(13984, 'ru', ''),
(13982, 'ru', ''),
(13980, 'ru', ''),
(13981, 'ru', ''),
(13979, 'ru', ''),
(13977, 'ru', ''),
(13978, 'ru', ''),
(13976, 'ru', ''),
(14488, 'ru', 'Карта памяти Transcend microSDHC 32 GB Class 10 UHS-I Ultimate (X600) (+ адаптер)'),
(14489, 'ru', 'Карта памяти GOODRAM microSD 2 GB (+ адаптер Retail 10)'),
(14490, 'ru', 'Карта памяти GOODRAM microSD 2 GB Retail 9 (+ адаптер)'),
(14491, 'ru', 'Карта памяти GOODRAM microSD 4 GB (+ адаптер и USB-кадтридер)'),
(14492, 'ru', 'Карта памяти GOODRAM microSD 8 GB (+ адаптер и USB-кадтридер)'),
(14493, 'ru', 'Карта памяти GOODRAM microSDHC 16 GB Class 10 (+ адаптер Retail 10)'),
(14494, 'ru', 'Карта памяти GOODRAM microSDHC 16 GB Class 10 (+ адаптер)'),
(14495, 'ru', 'Карта памяти GOODRAM microSDHC 16 GB Class 10 UHS I (+ адаптер Retail 10)'),
(14496, 'ru', 'Карта памяти GOODRAM microSDHC 16 GB Class 4 (+ адаптер)'),
(14497, 'ru', 'Карта памяти GOODRAM microSDHC 32 GB Class 10 (+ адаптер Retail 10)'),
(14498, 'ru', 'Карта памяти GOODRAM microSDHC 32 GB Class 10 (+адаптер)'),
(14499, 'ru', 'Карта памяти GOODRAM microSDHC 32 GB Class 10 UHS I (+ адаптер Retail 10)'),
(14500, 'ru', 'Карта памяти GOODRAM microSDHC 32 GB Class 4 (+ адаптер)'),
(14501, 'ru', 'Карта памяти GOODRAM microSDHC 4 GB Class 4 (+ адаптер Retail 10)'),
(14502, 'ru', 'Карта памяти GOODRAM microSDHC 4 GB Class 4 Retail 9 (+ адаптер)'),
(14503, 'ru', 'Карта памяти GOODRAM microSDHC 8 GB Class 10 (+ адаптер Retail 10)'),
(14504, 'ru', 'Карта памяти GOODRAM microSDHC 8 GB Class 10 (+ адаптер)'),
(14505, 'ru', 'Карта памяти GOODRAM microSDHC 8 GB Class 4 (+ адаптер Retail 10)'),
(14788, 'ru', ''),
(14790, 'ru', ''),
(14792, 'ru', ''),
(14794, 'ru', ''),
(14796, 'ru', ''),
(14797, 'ru', ''),
(14798, 'ru', ''),
(14799, 'ru', ''),
(14800, 'ru', ''),
(14801, 'ru', ''),
(14802, 'ru', ''),
(14803, 'ru', ''),
(14804, 'ru', ''),
(15425, 'ru', 'Наушники Ergo VD-290 Black'),
(17521, 'ru', 'Наушники Ergo VD-290 White'),
(17522, 'ru', 'Наушники Ergo VD-390 Gold'),
(17523, 'ru', 'Наушники Ergo VD-390 Grey'),
(17524, 'ru', 'Наушники Ergo VD-390 Red'),
(17525, 'ru', 'Гарнитура внутриканального типа Ergo VM-901 Black'),
(17526, 'ru', 'Мультимедийная гарнитура Ergo VM-280 Black'),
(17527, 'ru', 'Мультимедийная гарнитура Ergo VM-280 Green'),
(17528, 'ru', 'Набор запасных накладных амбушюр KOSS Porta/Sporta Pro(6 шт)'),
(17529, 'ru', 'Наушники  SENNHEISER IE 8i'),
(17530, 'ru', 'Наушники Ergo Ear VT11'),
(17531, 'ru', 'Наушники Ergo Ear VT12'),
(17532, 'ru', 'Наушники JVC HA-S200-B'),
(17590, 'ru', 'Наушники KOSS Porta Pro'),
(17617, 'ru', 'Наушники Panasonic RP-HJE120E-K');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_group`
--

DROP TABLE IF EXISTS `shop_rbac_group`;
CREATE TABLE IF NOT EXISTS `shop_rbac_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `shop_rbac_group`
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
(59, 'base', 'Widgets_manager', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_group_i18n`
--

DROP TABLE IF EXISTS `shop_rbac_group_i18n`;
CREATE TABLE IF NOT EXISTS `shop_rbac_group_i18n` (
  `id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `locale` varchar(5) NOT NULL,
  KEY `id_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_rbac_group_i18n`
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
(59, 'Управление виджетами', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_privileges`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=486 ;

--
-- Dumping data for table `shop_rbac_privileges`
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
(485, 'ShopAdminProducts::get_images', 19, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_privileges_i18n`
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
-- Dumping data for table `shop_rbac_privileges_i18n`
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
(485, 'Поиск картинок', NULL, 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_roles`
--

DROP TABLE IF EXISTS `shop_rbac_roles`;
CREATE TABLE IF NOT EXISTS `shop_rbac_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `importance` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_rbac_roles`
--

INSERT INTO `shop_rbac_roles` (`id`, `name`, `importance`, `description`) VALUES
(1, 'Administrator', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_roles_i18n`
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
-- Dumping data for table `shop_rbac_roles_i18n`
--

INSERT INTO `shop_rbac_roles_i18n` (`id`, `alt_name`, `locale`, `description`) VALUES
(1, 'Администратор', 'ru', 'Доступны все елементы управления');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rbac_roles_privileges`
--

DROP TABLE IF EXISTS `shop_rbac_roles_privileges`;
CREATE TABLE IF NOT EXISTS `shop_rbac_roles_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolepriv` (`role_id`,`privilege_id`),
  KEY `shop_rbac_roles_privileges_FK_2` (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=614 ;

--
-- Dumping data for table `shop_rbac_roles_privileges`
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
(612, 1, 424),
(613, 1, 425);

-- --------------------------------------------------------

--
-- Table structure for table `shop_settings`
--

DROP TABLE IF EXISTS `shop_settings`;
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
('mainImageWidth', '320', ''),
('mainImageHeight', '320', ''),
('smallImageWidth', '140', ''),
('smallImageHeight', '140', ''),
('addImageWidth', '800', ''),
('addImageHeight', '600', ''),
('imagesQuality', '99', ''),
('systemTemplatePath', './templates/newLevel/shop/', ''),
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
('pricePrecision', '0', ''),
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
('selectedProductCats', 'a:4:{i:0;s:2:"36";i:1;s:2:"37";i:2;s:2:"38";i:3;s:2:"39";}', ''),
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
('facebook_int', 'a:3:{s:9:"secretkey";s:0:"";s:9:"appnumber";s:0:"";s:8:"template";s:8:"newLevel";}', ''),
('vk_int', 'a:3:{s:7:"protkey";s:0:"";s:9:"appnumber";s:0:"";s:8:"template";s:8:"newLevel";}', ''),
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
('imageSizesBlock', 'a:4:{s:5:"small";a:3:{s:4:"name";s:5:"small";s:6:"height";s:2:"62";s:5:"width";s:2:"62";}s:6:"medium";a:3:{s:4:"name";s:6:"medium";s:6:"height";s:3:"150";s:5:"width";s:3:"260";}s:4:"main";a:3:{s:4:"name";s:4:"main";s:6:"height";s:3:"288";s:5:"width";s:3:"452";}s:5:"large";a:3:{s:4:"name";s:5:"large";s:6:"height";s:4:"1000";s:5:"width";s:4:"1000";}}', ''),
('imagesMainSize', 'auto', ''),
('additionalImageWidth', '1000', ''),
('additionalImageHeight', '1000', ''),
('arrayFrontProductsPerPage', 'a:3:{i:0;s:2:"12";i:1;s:2:"24";i:2;s:2:"48";}', ''),
('thumbImageWidth', '62', ''),
('thumbImageHeight', '62', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_sorting`
--

DROP TABLE IF EXISTS `shop_sorting`;
CREATE TABLE IF NOT EXISTS `shop_sorting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) DEFAULT NULL,
  `get` varchar(25) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `name_front` varchar(50) DEFAULT NULL,
  `tooltip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `shop_sorting`
--

INSERT INTO `shop_sorting` (`id`, `pos`, `get`, `active`, `name`, `name_front`, `tooltip`) VALUES
(1, 4, 'rating', 1, '', NULL, NULL),
(2, 1, 'price', 1, '', NULL, NULL),
(3, 2, 'price_desc', 1, '', NULL, NULL),
(4, 3, 'hit', 1, '', NULL, NULL),
(5, 5, 'hot', 1, '', NULL, NULL),
(6, 0, 'action', 1, '', NULL, NULL),
(7, 8, 'name', 1, '', NULL, NULL),
(8, 9, 'name_desc', 0, '', NULL, NULL),
(9, 6, 'views', 1, '', NULL, NULL),
(10, 7, 'topsales', 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_sorting_i18n`
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
-- Dumping data for table `shop_sorting_i18n`
--

INSERT INTO `shop_sorting_i18n` (`id`, `locale`, `name`, `name_front`, `tooltip`) VALUES
(1, 'ru', 'По рейтингу', 'Рейтинг', ''),
(2, 'ru', 'От дешевых к дорогим', 'От дешевых к дорогим', ''),
(3, 'ru', 'От дорогих к дешевым', 'От дорогих к дешевым', ''),
(4, 'ru', 'Популярные', 'Популярные', ''),
(5, 'ru', 'Новинки', 'Новинки', ''),
(6, 'ru', 'Акции', 'Акции', ''),
(6, 'ua', '', '', ''),
(7, 'ru', 'А-Я', 'По названию (А-Я)', ''),
(8, 'ru', 'Я-А', 'По названию (Я-А)', ''),
(9, 'ru', 'Просмотров', 'По количеству просмотров', ''),
(10, 'ru', 'Топ продаж', 'Топ продаж', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_spy`
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
-- Dumping data for table `shop_spy`
--

INSERT INTO `shop_spy` (`id`, `user_id`, `product_id`, `price`, `variant_id`, `key`, `email`, `old_price`) VALUES
(3, 69, 102, 550, 113, 'IPrMlWydoeP9Cmex30upNOUsdTa4bIrg', NULL, 549);

-- --------------------------------------------------------

--
-- Table structure for table `shop_warehouse`
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
-- Dumping data for table `shop_warehouse`
--

INSERT INTO `shop_warehouse` (`id`, `name`, `address`, `phone`, `description`) VALUES
(1, 'warehouse 1', 'address', 'phone', ''),
(2, 'warehouse 2', 'address 2', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_warehouse_data`
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

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trash`
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
-- Table structure for table `users`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
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

-- --------------------------------------------------------

--
-- Table structure for table `user_temp`
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
-- Table structure for table `widgets`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `type`, `data`, `method`, `settings`, `description`, `roles`, `created`) VALUES
(3, 'latest_news', 'module', 'core', 'recent_news', 'a:4:{s:10:"news_count";s:1:"3";s:11:"max_symdols";s:3:"150";s:10:"categories";a:1:{i:0;s:2:"69";}s:7:"display";s:6:"recent";}', 'Последние новости', '', 1291632457),
(4, 'recent_product_comments', 'module', 'comments', 'recent_product_comments', 'a:2:{s:14:"comments_count";s:1:"5";s:13:"symbols_count";s:1:"0";}', 'Последние комментарии продукта', '', 1308300371),
(5, 'tags', 'module', 'tags', 'tags_cloud', '', 'Теги', '', 1312362714),
(6, 'path', 'module', 'navigation', 'widget_navigation', '', 'Виджет навигации', '', 1328631622),
(10, 'popular_products', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:11:"popular,hit";s:5:"title";s:33:"Популярные товары";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Популярные товары', '', 1363606273),
(11, 'new_products', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:11:"popular,hot";s:5:"title";s:14:"Новинки";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Новые товары', '', 1363606324),
(12, 'action_products', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:14:"popular,action";s:5:"title";s:31:"Акционные товары";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Акционные товары', '', 1363606361),
(13, 'brands', 'module', 'shop', 'brands', 'a:4:{s:10:"withImages";b:1;s:11:"brandsCount";s:2:"15";s:7:"subpath";s:7:"widgets";s:5:"title";s:39:"Лучшие производители";}', 'Бренды', '', 1363606422),
(15, 'similar', 'module', 'shop', 'similar_products', 'a:3:{s:5:"title";s:27:"Похожие товары";s:13:"productsCount";s:1:"5";s:7:"subpath";s:7:"widgets";}', 'Похожие товары', '', 1363606582),
(28, 'popular_products_category', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:17:"date,hit,category";s:5:"title";s:16:"Popular products";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Популярная категория товара', '', 1374575193),
(27, 'ViewedProducts', 'module', 'shop', 'view_product', 'a:4:{s:12:"productsType";b:0;s:5:"title";s:14:"ViewedProducts";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Просмотренные товары', '', 1374575092),
(16, 'benefits', 'html', '<div class="container">\n<ul class="items items-benefits">\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_1">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Бесплатная</div>\n<p>доставка</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_2">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Гибкая система</div>\n<p>скидок</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_3">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Индивидуальный</div>\n<p>подход</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_4">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">высокий уровень</div>\n<p>сервиса</p>\n</div>\n</div>\n</li>\n</ul>\n</div>', '', '', 'Преимущества', '', 1371214822),
(17, 'payments_delivery_methods_info', 'html', '<div class="frame-delivery-payment"><dl><dt class="title f-s_0"><span class="icon_delivery">&nbsp;</span><span class="text-el">Доставка</span></dt><dd class="frame-list-delivery">\n<ul class="list-style-1">\n<li>Новая Почта</li>\n<li>Другие транспортные службы</li>\n<li>Курьером по Киеву</li>\n<li>Самовывоз</li>\n</ul>\n</dd><dt class="title f-s_0"><span class="icon_payment">&nbsp;</span><span class="text-el">Оплата</span></dt><dd class="frame-list-payment">\n<ul class="list-style-1">\n<li>Наличными при получении</li>\n<li>Безналичный перевод</li>\n<li>Приват 24</li>\n<li>WebMoney</li>\n</ul>\n</dd></dl></div>\n<div class="frame-phone-product">\n<div class="title f-s_0"><span class="icon_phone_product">&nbsp;</span><span class="text-el">Заказы по телефонах</span></div>\n<ul class="list-style-1">\n<li>(097) <span class="d_n">&minus;</span>567-43-21</li>\n<li>(097) <span class="d_n">&minus;</span>567-43-22</li>\n</ul>\n</div>', '', '', 'Информация о способах доставки', '', 1371821417),
(20, 'start_page_seo_text', 'html', '', '', '', '', '', 1378821714);

-- --------------------------------------------------------

--
-- Table structure for table `widget_i18n`
--

DROP TABLE IF EXISTS `widget_i18n`;
CREATE TABLE IF NOT EXISTS `widget_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `locale` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget_i18n`
--

INSERT INTO `widget_i18n` (`id`, `locale`, `data`) VALUES
(16, 'ru', '<div class="container">\n<ul class="items items-benefits">\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_1">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Бесплатная</div>\n<p>доставка</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_2">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Гибкая система</div>\n<p>скидок</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_3">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Индивидуальный</div>\n<p>подход</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_4">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">высокий уровень</div>\n<p>сервиса</p>\n</div>\n</div>\n</li>\n</ul>\n</div>'),
(17, 'ru', '<div class="frame-delivery-payment"><dl><dt class="title f-s_0"><span class="icon_delivery">&nbsp;</span><span class="text-el">Доставка</span></dt><dd class="frame-list-delivery">\n<ul class="list-style-1">\n<li>Новая Почта</li>\n<li>Другие транспортные службы</li>\n<li>Курьером по Киеву</li>\n<li>Самовывоз</li>\n</ul>\n</dd><dt class="title f-s_0"><span class="icon_payment">&nbsp;</span><span class="text-el">Оплата</span></dt><dd class="frame-list-payment">\n<ul class="list-style-1">\n<li>Наличными при получении</li>\n<li>Безналичный перевод</li>\n<li>Приват 24</li>\n<li>WebMoney</li>\n</ul>\n</dd></dl></div>\n<div class="frame-phone-product">\n<div class="title f-s_0"><span class="icon_phone_product">&nbsp;</span><span class="text-el">Заказы по телефонах</span></div>\n<ul class="list-style-1">\n<li>(097) <span class="d_n">&minus;</span>567-43-21</li>\n<li>(097) <span class="d_n">&minus;</span>567-43-22</li>\n</ul>\n</div>'),
(20, 'ru', '<h1>Интернет-магазин</h1>\n<p>Интернет-магазин &mdash; сайт, торгующий товарами в интернете. Позволяет пользователям сформировать заказ на покупку, выбрать способ оплаты и доставки заказа в сети Интернет.</p>\n<h2>Заголовок второго уровня</h2>\n<h3>Заголовок третьего уровня</h3>\n<p>Выбрав необходимые товары или услуги, пользователь обычно имеет возможность тут же на сайте выбрать метод оплаты и доставки.</p>\n<p>Совокупность отобранных товаров, способ оплаты и доставки представляют собой законченный заказ, который оформляется на сайте путем сообщения минимально необходимой информации о покупателе.</p>\n<h3>Заголовок третьего уровня</h3>\n<p><strong>Основные способы оплаты покупок в интернет-магазине:</strong></p>\n<ul>\n<li>наличный расчет &mdash; товар оплачивается курьеру наличными деньгами при получении покупателем товара, наличный расчет &mdash; товар оплачивается курьеру наличными деньгами при получении покупателем товара;</li>\n<li>электронные деньги &mdash; безналичный вид расчёта;</li>\n<li>терминалы моментальной оплаты &mdash; оплата производится в уличных платёжных терминалах;</li>\n</ul>\n<h4>Заголовок четвертого уровня</h4>\n<p>электронные кассы &mdash; вид расчета, объединяющий практически все перечисленные выше способы оплаты.</p>\n<table>\n<tbody>\n<tr>\n<td>название</td>\n<td>размер</td>\n<td>цена</td>\n</tr>\n<tr>\n<td>длинна трубы</td>\n<td>10 метров</td>\n<td>145 уе</td>\n</tr>\n<tr>\n<td>ширина трубы</td>\n<td>2 метра</td>\n<td>134 уе</td>\n</tr>\n</tbody>\n</table>\n<p>При выборе такого способа оплаты пользователю предлагается на выбор наиболее удобный способ перевода денег от пластиковой карточки до терминала и мобильного телефона.</p>\n<p>Основные способы оплаты покупок в интернет-магазине:</p>\n<ol>\n<li>наличный расчет &mdash; товар оплачивается курьеру наличными деньгами при получении покупателем товара, наличный расчет &mdash; товар оплачивается курьеру наличными деньгами при получении покупателем товара;</li>\n<li>электронные деньги &mdash; безналичный вид расчёта;</li>\n<li>терминалы моментальной оплаты &mdash; оплата производится в уличных платёжных терминалах;</li>\n</ol>\n<p>электронные кассы &mdash; вид расчета, объединяющий практически все перечисленные выше способы оплаты.</p>');


--
-- Структура таблиці `template_settings`
--

DROP TABLE IF EXISTS `template_settings`;
CREATE TABLE IF NOT EXISTS `template_settings` (
`id` int(11) NOT NULL,
  `component` varchar(255) NOT NULL,
  `key` text,
  `data` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
