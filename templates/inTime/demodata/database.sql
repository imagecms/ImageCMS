-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Час створення: Вер 19 2014 р., 13:57
-- Версія сервера: 5.5.35-log
-- Версія PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `intime`
--

-- --------------------------------------------------------

--
-- Структура таблиці `answer_notifications`
--

CREATE TABLE IF NOT EXISTS `answer_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Дамп даних таблиці `answer_notifications`
--

INSERT INTO `answer_notifications` (`id`, `locale`, `name`, `message`) VALUES
(1, 'ua', 'incoming', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(2, 'ua', 'callback', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(3, 'ua', 'order', '<h1>Дякуємо</h1>\n<div>В короткий час наші менеджери звяжуться з Вами</div>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>'),
(4, 'ru', 'incoming', '<h1>Спасибо</h1>\r\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>'),
(5, 'ru', 'callback', '<h1>Спасибо</h1>\r\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>'),
(6, 'ru', 'order', '<h1>Спасибо</h1>\r\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>');

-- --------------------------------------------------------

--
-- Структура таблиці `category`
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
  `settings` varchar(10000) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Дамп даних таблиці `category`
--

INSERT INTO `category` (`id`, `parent_id`, `position`, `name`, `title`, `short_desc`, `url`, `image`, `keywords`, `description`, `fetch_pages`, `main_tpl`, `tpl`, `page_tpl`, `per_page`, `order_by`, `sort_order`, `comments_default`, `field_group`, `category_field_group`, `settings`, `created`, `updated`) VALUES
(69, 0, 1, 'Новости', '', '', 'novosti', '', '', '', 'b:0;', '', '', '', 15, 'publish_date', 'desc', 0, 13, -1, 'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";b:0;}', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `category_translate`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

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
-- Дамп даних таблиці `comments`
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
-- Структура таблиці `components`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=273 ;

--
-- Дамп даних таблиці `components`
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
(272, 'template_manager', 'template_manager', 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `content`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- Дамп даних таблиці `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(64, 'Про компанию', '', 'pro-kompaniu', '', 'магазине', 'О магазине', '<p>Магазин ImageCMS Shop предоставляет огромный выбор техники на любой вкус по лучшим ценам.</p>\n<p>Наш магазин существует более 5 лет и за это время не было ни единого возврата товара.</p>\n<p>Мы обслуживаем ежедневно сотни покупателей и делаем это с радостью.</p>\n<p><strong>Покупайте технику у нас и становитесь обладателем лучшей в мире техники!!!</strong></p>', '', 0, '', '', 0, 0, 0, 'publish', 'Administrator', 1291295776, 0, 1409561136, 391, 3, 0),
(66, 'Доставка', '', 'dostavka', '', 'доставка', 'Доставка', '<p>Мы поддерживаем доставку службой Автомир по всему миру.</p>\n<p>Также возможна доставка курьером для всех больших городов Украины и России (возможность доставки курьером в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>\n<p>При желании Вы можете сами забрать купленный товар в наших офисах.</p>', '', 0, '', '', 1, 0, 0, 'publish', 'Administrator', 1291295844, 1291295851, 1409561148, 235, 3, 0),
(68, 'Контакты', '', 'kontakty', '', 'контакты', 'Контакты', '<div class="contacts">\n<div class="d_i-b"><img dir="/" src="/uploads/images/contacts/contacts_icon_phone.png" alt="телефон" width="34" height="34" />\n<ul>\n<li class="title">Телефон в офисе</li>\n<li>+38 067 123-45-67</li>\n<li>+38 067 123-45-67</li>\n</ul>\n</div>\n<div class="d_i-b"><img dir="/" src="/uploads/images/contacts/contacts_icon_email.png" alt="телефон" width="34" height="34" />\n<ul>\n<li class="title">E-mail</li>\n<li>info@in-time.com</li>\n</ul>\n</div>\n<div class="d_i-b"><img dir="/" src="/uploads/images/contacts/contacts_icon_skype.png" alt="телефон" width="34" height="34" />\n<ul>\n<li class="title">Skype</li>\n<li>in-time</li>\n</ul>\n</div>\n<div class="d_i-b"><img dir="/" src="/uploads/images/contacts/contacts_icon_address.png" alt="телефон" width="34" height="34" />\n<ul>\n<li class="title">Адрес</li>\n<li>Киев, ул. Гагарина 1/2, офис 395</li>\n</ul>\n</div>\n</div>', '', 0, 'contacts', '', 4, 0, 0, 'publish', 'Administrator', 1291295870, 1291295888, 1410354562, 278, 3, 0),
(75, 'Contact', '', 'kontakty', '', 'ssss', 'ssss', '<p><span id="result_box" lang="en"><span>Hot Phone</span><span>:</span> <span>0800</span> <span>80</span> <span>80 800</span><br /><br /> <span>Head office in</span> <span>Moscow</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>095</span> <span>095</span> <span>00</span> <span>00</span><br /><br /> <span>The main office</span> <span>in Kiev</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>098</span> <span>098</span> <span>00</span> <span>00</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295870, 1291295888, 1343664873, 35, 30, 68),
(76, 'Delivery', '', 'dostavka', '', 'support, the, delivery, service, autoworld, around, world, also, possible, all, major, cities, ukraine, and, russia, possibility, courier, your, area, please, call, desired, you, can, pick, purchased, goods, themselves, our, offices', 'We support the delivery of service Autoworld around the world. It is also possible delivery to all major cities of Ukraine and Russia (the possibility of delivery by courier in your area please call 0800820 22 22.) If desired, you can pick up the purchase', '<p><span id="result_box" lang="en"><span>We support the</span> <span>delivery of</span> <span>service</span> <span>Autoworld</span> <span>around the world.</span><br /><br /> <span>It is also possible</span> <span>delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine and Russia</span> <span>(the possibility of</span> <span>delivery</span> <span>by courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span><br /><br /> <span>If desired,</span> <span>you can</span> <span>pick up the</span> <span>purchased goods</span> <span>themselves</span> <span>in our offices.</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295844, 1291295851, 1343664842, 8, 30, 66),
(92, 'Как добавить сайт в Яндекс и Гугл. Советы начинающим вебмастерам', '', 'kak-dobavit-sait-v-iandeks-i-gugl-sovety-nachinaiushchim-vebmasteram', 'novosti/', 'создание, сайта, само, себе, является, нелегким, довольно, продолжительным, процессом, позади, неприятно, обнаружить, ваш, красивый, наполненный, полезными, материалами, сайт, никто, кроме, самих, заходит, пожалуй, владельцы, сайтов, которые, запустили, свой, первый, проект', 'Создание сайта само по себе является нелегким и довольно продолжительным   процессом, и когда все уже позади, довольно неприятно обнаружить, что   на ваш красивый и наполненный полезными материалами сайт никто кроме  вас  самих не заходит. Пожалуй, владел', '<p>Создание сайта само по себе является нелегким и довольно продолжительным процессом, и когда все уже позади, довольно неприятно обнаружить, что на ваш красивый и наполненный полезными материалами сайт никто кроме вас самих не заходит. Пожалуй, владельцы сайтов, которые запустили свой первый проект, чаще всего испытывают неприятное удивление в связи с этим фактом. А на самом деле все просто &ndash; прежде всего, нужно знать как добавить сайт в поисковики.</p>', '<p>Создание сайта само по себе является нелегким и довольно продолжительным процессом, и когда все уже позади, довольно неприятно обнаружить, что на ваш красивый и наполненный полезными материалами сайт никто кроме вас самих не заходит. Пожалуй, владельцы сайтов, которые запустили свой первый проект, чаще всего испытывают неприятное удивление в связи с этим фактом. А на самом деле все просто &ndash; прежде всего, нужно знать как добавить сайт в поисковики.</p>\n<p>Посетители переходят на сайты из результатов поиска, выдаваемых им Google при вводе определенного запроса. Но, чтобы появится в выдаче по этому запросу, нужно сначала, чтобы поисковый робот проиндексировал ваш сайт, то есть, внес его в свою поисковую базу. Поэтому, если вы имеете понятие про <a href="http://www.imagecms.net/blog/obzory/biznes-v-internete-kak-perspektivnyi-trend" target="_blank">бизнес в Интернете</a>, и уже запустили собственный ресурс, вопрос как добавить сайт в поисковики будет актуальным для каждого вебмастера.</p>\n<p><a href="http://www.imagecms.net/download"><img src="http://www.imagecms.net/uploads/images/blog/2.png" alt="Мощная система для создания сайтов любых типов" width="705" height="183" /></a></p>\n<p>Часто бывает, что ресурс может проиндексироваться сразу же после регистрации доменного имени, но лучше всего самостоятельно добавить сайт в поисковые системы. Тем более, учитывая тот факт, что это займет совсем немного времени.</p>\n<p>&nbsp;</p>\n<h3>Добавить сайт в Яндекс</h3>\n<p>&nbsp;</p>\n<p>Для того, чтобы сообщить этому поисковику о новом сайте, нужно перейти на страницу со специальной формой, которая находится по следующему адресу: <a href="http://webmaster.yandex.ua/addurl.xml" target="_blank">http://webmaster.yandex.ua/addurl.xml</a></p>\n<p>С помощью панельки можно просто и быстро добавить сайт в Яндекс с минимальными затратами времени и сил. Перейдя по ссылке, вы увидите следующую форму: <br /><img src="http://www.imagecms.net/uploads/images/blog/add_yandex.jpg" alt="Форма добавления сайта в индекс ПС Яндекс" width="695" height="266" /> <br />В поле URL ведите адрес сайта, ниже введите цифры с картинки каптчи (защита от спама), после чего нажмите кнопку &laquo;Добавить&raquo;. Поздравляем! Только что вы смогли добавить сайт в Яндекс и уже в ближайшее время на него заглянет поисковый паук, чтобы внести в свою базу. После этого он появится в результатах поиска, и вы получите первых посетителей.</p>\n<p>&nbsp;</p>\n<h3>Добавить сайт в Гугл</h3>\n<p>&nbsp;</p>\n<p>Эта поисковая система является мировым лидером в области web-поиска, и сообщить ей о своем сайте нужно обязательно. Добавить сайт в Гугл еще проще, чем в предыдущем случае, ведь не нужно даже вводить каптчу. Перейдите <a href="https://www.google.com/webmasters/tools/submit-url?hl=ru" target="_blank">по этой ссылке</a> и перед вами откроется окно, с помощью которого можно добавить сайт в Google: <br /><img src="http://www.imagecms.net/uploads/images/blog/add_google.jpg" alt="Добавление url в индекс ПС Google" width="695" height="311" /><br /> Введите адрес и по желанию можно добавить примечание. Хотя вряд ли в этом есть смысл, так как это ни на что не влияет. Кстати, не нужно вводить никаких отдельных страниц, чтобы добавить сайт в Гугл достаточно вставить в поле формы URL главной страницы.</p>\n<p>Как видите, добавить сайт в поисковые системы совсем не сложно. Тем более, если учитывать, что хорошая индексация ведет к росту посещаемости, а значит и повышает <a href="http://www.imagecms.net/blog/obzory/otsenka-stoimosti-saita-i-faktory-kotorye-vliiaiut-na-tsenu" target="_blank">стоимость сайта</a> в целом. Это займет у вас минимум времени, но благодаря проделанным операциям вы сможете быть уверены в том, что поисковые системы узнают о сайте и добавят его в базу, а значит, на сайт начнут заходить посетители. Теперь вы знаете как добавить сайт в Google и можете без проблем сделать это самостоятельно.</p>', 69, '', '', 6, 0, 0, 'publish', 'Administrator', 1362225699, 1362225699, 1387364028, 9, 3, 0),
(79, 'About us', '', 'pro-kompaniu', '', 'shop, imagecms, offers, huge, selection, vehicles, suit, every, taste, the, best, prices, our, store, has, more, than, years, and, during, that, time, was, not, single, return, goods, serve, hundreds, customers', 'Shop ImageCMS Shop offers a huge selection of vehicles to suit every taste at the best prices. Our store has more than 5 years and during that time was not a single return of the goods. We serve hundreds of customers every day and do it with joy. Buy equi', '<p><span id="result_box" lang="en"><span>Shop</span> <span>ImageCMS Shop</span> <span>offers</span> <span>a huge selection</span> <span>of vehicles</span> <span>to suit every taste</span> <span>at the best prices</span><span>.</span><br /><br /> <span>Our store</span> <span>has more than</span> <span>5 years</span> <span>and during that time</span> <span>was not a single</span> <span>return of the goods</span><span>.</span><br /><br /> <span>We serve</span> <span>hundreds of</span> <span>customers</span> <span>every day</span> <span>and do</span> <span>it with joy.</span><br /><br /> <span>Buy</span> <span>equipment from</span> <span>us and</span> <span>become the owner of</span> <span>the world''s best</span> <span>technology</span><span>!</span></span></p>', '', 0, '', '', 0, 1, 1, 'publish', 'admin', 1291295776, 1291295792, 1343745649, 5, 30, 64),
(91, 'Как раскрутить сайт? Методы поискового продвижения', '', 'kak-raskrutit-sait-metody-poiskovogo-prodvizheniia', 'novosti/', 'наличие, корпоративного, сайта, стало, стандартом, факто, знаком, хорошего, тона, любой, компании, только, известных, игроков, рынка, независимо, области, вашей, деятельности, собственный, ресурс, любом, случае, принесет, пользу, особенно, знаете, раскрутить, сайт, самостоятельно', 'Наличие корпоративного сайта уже стало стандартом де-факто и знаком   хорошего тона любой компании, а не только известных игроков рынка.   Независимо от области вашей деятельности, собственный ресурс в любом   случае принесет вам пользу, особенно если вы', '<p>Наличие корпоративного сайта уже стало стандартом де-факто и знаком хорошего тона любой компании, а не только известных игроков рынка. Независимо от области вашей деятельности, собственный ресурс в любом случае принесет вам пользу, особенно если вы знаете как раскрутить сайт самостоятельно. Его можно использовать не только для повышения узнаваемости бренда, но и в качестве эффективного инструмента продаж.</p>', '<h1>Интернет-магазин</h1><br><p>Интернет-магазин — сайт, торгующий товарами в интернете. Позволяет пользователям сформировать заказ на покупку, выбрать способ оплаты и доставки заказа в сети Интернет.</p><br><h2>Заголовок второго уровня</h2><br><h3>Заголовок третьего уровня</h3><br><p>Выбрав необходимые товары или услуги, пользователь обычно имеет возможность тут же на сайте выбрать метод оплаты и доставки.</p>\n<p>Совокупность отобранных товаров, способ оплаты и доставки представляют собой законченный заказ, который оформляется на сайте путем сообщения минимально необходимой информации о покупателе.</p><br><h3>Заголовок третьего уровня</h3><br><p><strong>Основные способы оплаты покупок в интернет-магазине:</strong></p><br><ul>\n<li>наличный расчет — товар оплачивается курьеру наличными деньгами при получении покупателем товара, наличный расчет — товар оплачивается курьеру наличными деньгами при получении покупателем товара;</li>\n<li>электронные деньги — безналичный вид расчёта;</li>\n<li>терминалы моментальной оплаты — оплата производится в уличных платёжных терминалах;</li>\n</ul><br><h4>Заголовок четвертого уровня</h4><br><p>электронные кассы — вид расчета, объединяющий практически все перечисленные выше способы оплаты.</p><br><br><table class="adaptive">\n    <thead>\n        <tr>\n            <th>№ Заказа</th>\n            <th>Время покупки</th>\n            <th>Сумма покупки</th>\n            <th>Статус заказа</th>\n            <th>Статус оплаты</th>\n        </tr>\n    </thead>\n    <tbody>\n        <tr>\n            <td title="№ Заказа"><a rel="nofollow" href="http://watchshop.imagecmsdemo.net/shop/order/view/u688p1f586">Заказ №54</a></td>\n            <td title="Время покупки">08-07-2014 10:57</td>\n            <td title="Сумма покупки">\n                        <span class="price">30</span>\n                        <span class="curr">$</span>\n            </td>\n            <td title="Статус заказа">Новый</td>\n            <td title="Статус оплаты"> Оплачен </td>\n        </tr>\n        <tr>\n            <td title="№ Заказа"><a rel="nofollow" href="http://watchshop.imagecmsdemo.net/shop/order/view/x61109e56k">Заказ №53</a></td>\n            <td title="Время покупки">07-07-2014 14:18</td>\n            <td title="Сумма покупки">\n                        <span class="price">76</span>\n                        <span class="curr">$</span>\n            </td>\n            <td title="Статус заказа">Новый</td>\n            <td title="Статус оплаты"> Не оплачен</td>\n        </tr>\n        <tr>\n            <td title="№ Заказа"><a rel="nofollow" href="http://watchshop.imagecmsdemo.net/shop/order/view/c0i1w64340">Заказ №52</a></td>\n            <td title="Время покупки">07-07-2014 12:01</td>\n            <td title="Сумма покупки">\n                        <span class="price">639</span>\n                        <span class="curr">$</span>\n            </td>\n            <td title="Статус заказа">Новый</td>\n            <td title="Статус оплаты"> Не оплачен</td>\n        </tr>\n    </tbody>\n</table><br><br><p>При выборе такого способа оплаты пользователю предлагается на выбор наиболее удобный способ перевода денег от пластиковой карточки до терминала и мобильного телефона.</p>\n<p>Основные способы оплаты покупок в интернет-магазине:</p><br><ol>\n<li>наличный расчет — товар оплачивается курьеру наличными деньгами при получении покупателем товара, наличный расчет — товар оплачивается курьеру наличными деньгами при получении покупателем товара;</li>\n<li>электронные деньги — безналичный вид расчёта;</li>\n<li>терминалы моментальной оплаты — оплата производится в уличных платёжных терминалах;</li>\n</ol><br><p>электронные кассы — вид расчета, объединяющий практически все перечисленные выше способы оплаты.</p>', 69, '', '', 5, 0, 0, 'publish', 'Administrator', 1362225580, 1362225580, 1407513525, 77, 3, 0),
(93, '8Р: Бизнес в сети', '', '8r-biznes-v-seti', 'novosti/', 'редкий, предприниматель, наше, время, задается, вопросом, «как, помощью, интернета, увеличить, продажи, подробный, обстоятельный, ответ, каждый, сможет, получить, традиционной, ежегодной, конференции, бизнес, сети, которая, третий, состоится, одессе, ожидается, около, участников, этом', 'Редкий предприниматель в наше время не задается вопросом: «Как с помощью  интернета увеличить продажи?» Подробный и обстоятельный ответ каждый  сможет получить на традиционной ежегодной конференции “8Р: Бизнес в  сети”, которая в третий раз состоится в Од', '<p>Редкий предприниматель в наше время не задается вопросом: &laquo;Как с помощью интернета увеличить продажи?&raquo; Подробный и обстоятельный ответ каждый сможет получить на традиционной ежегодной конференции &ldquo;8Р: Бизнес в сети&rdquo;, которая в третий раз состоится &nbsp;в Одессе 13.07.2013г. Ожидается около 700 участников.</p>', '<p>&nbsp;</p>\n<p><img src="http://www.imagecms.net/uploads/images/8p_logo.jpg" alt="" width="300" height="70" />Редкий предприниматель в наше время не задается вопросом: &laquo;Как с помощью интернета увеличить продажи?&raquo; Подробный и обстоятельный ответ каждый сможет получить на традиционной ежегодной конференции &ldquo;8Р: Бизнес в сети&rdquo;, которая в третий раз состоится &nbsp;в Одессе 13.07.2013г. Ожидается около 700 участников.</p>\n<p dir="ltr">В этом году оргкомитет выбрал наиболее актуальные темы, пригласил более 40 докладчиков и решил немного отойти от теоретики, сделав упор на примеры из практики. Большое количество кейсов &ndash; отличительная черта &ldquo;8P&rdquo; 2013.</p>\n<p dir="ltr">В программе конференции предусмотрены 4 потока:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">Интернет-маркетинг &nbsp;&ndash; инструменты онлайн продвижения бизнеса</li>\n<li dir="ltr">E-commerce &ndash; привлечение новых клиентов, увеличение конверсии, формирование лояльности</li>\n<li dir="ltr">Кейсы &ndash; примеры успешного продвижения в сети</li>\n<li dir="ltr">Мастер-классы &ndash; полтора часа непрерывного общения&nbsp;</li>\n</ul>\n<p>&nbsp;</p>\n<p>Оформить регистрацию на конференцию &ldquo;8Р: Бизнес в сети&rdquo; 2013 можно <a href="http://8p.ua/?utm_source=p20954&amp;utm_medium=press_release&amp;utm_campaign=8p">здесь</a>.</p>\n<p dir="ltr">Там же вы можете посмотреть фото и видео с прошлогодней конференции, прочитать отзывы участников.</p>\n<p dir="ltr">Стартовая цена билета &ndash; 950 грн. Внимание: с каждым проданным билетом она возрастает на 1 грн.<br />Адрес конференции: г.Одесса, банкетный дом Ренессанс. От железнодорожного вокзала будет курсировать комфортабельный автобус. Добираться можно и на своем автомобиле - бесплатная парковка к вашим услугам.</p>\n<p>В программе также кофе-брейки, обед, афтер-пати.<br />Испытание на стойкость - афтер-афтер-пати.<br /> <br />Организатор конференции: <a href="http://netpeak.ua">Netpeak</a> - агентство интернет-маркетинга</p>', 69, '', '', 7, 0, 0, 'publish', 'Administrator', 1362225792, 1362225792, 1387364038, 11, 3, 0),
(94, 'Lviv Social Media Camp 2013', '', 'lviv-social-media-camp-2013', 'novosti/', 'lviv, social, media, camp, третья, ежегодная, конференция, вопросам, продвижения, малого, бизнеса, социальных, сетях, состоится, февраля, успешные, форумы, года, собравшие, почти, участников, доказали, покорения, изменчивого, мира, медиа, необходимы, незаурядные, знания, опыт', 'Lviv Social Media Camp 2013 - третья ежегодная конференция по вопросам  продвижения малого бизнеса в социальных сетях - состоится 23 февраля.  Успешные форумы 2011 и 2012 года, собравшие почти 700 участников,  доказали - для покорения изменчивого мира соц', '<p>Lviv Social Media Camp 2013 - третья ежегодная конференция по вопросам продвижения малого бизнеса в социальных сетях - состоится 23 февраля. Успешные форумы 2011 и 2012 года, собравшие почти 700 участников, доказали - для покорения &nbsp;изменчивого мира социальных медиа необходимы незаурядные знания и опыт, которыми могут поделиться только настоящие профессионалы. Как следствие - десятки новых ярких звезд, вспыхнувших в украинском бизнес-пространстве. Такие результаты не могли не вдохновить организаторов на продолжение работы в этом перспективном направлении.</p>', '<p><img src="http://www.imagecms.net/uploads/images/smcamp2013.png" alt="" width="850" height="237" /><br /><a href="http://smcamp.com.ua">Lviv Social Media Camp 2013</a> - третья ежегодная конференция по вопросам продвижения малого бизнеса в социальных сетях - состоится 23 февраля. Успешные форумы 2011 и 2012 года, собравшие почти 700 участников, доказали - для покорения &nbsp;изменчивого мира социальных медиа необходимы незаурядные знания и опыт, которыми могут поделиться только настоящие профессионалы. Как следствие - десятки новых ярких звезд, вспыхнувших в украинском бизнес-пространстве. Такие результаты не могли не вдохновить организаторов на продолжение работы в этом перспективном направлении.<br /> <br />Красноречивые факты:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">22 млн. гривен - общий объем видеорекламы в Уанете.</li>\n<li dir="ltr">680 млн. гривен - объем украинского рынка интернет-рекламы</li>\n<li dir="ltr">180 млн. гривен - объем прошлогоднего рынка Digital-услуг</li>\n<li dir="ltr">Около 20% - &nbsp;прогнозируемый рост Digital на 2013 год</li>\n</ul>\n<p>&nbsp;</p>\n<p><br />Нынешняя программа конференции разработана специально для предпринимателей и представителей малого бизнеса, которым интересны &nbsp;новые возможности для продвижения своего продукта. К тому же, конференция станет точкой сбора для украинских профессионалов SMM.<br /> <br />По традиции, в программе конференции будет три потока:<br /> <br />Social Media Marketing:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">Украинский SMM в 2013 году - успехи и провалы</li>\n<li dir="ltr">Нужен ли SMM украинскому бизнесу?</li>\n<li dir="ltr">Методы манипулирования выдачей Facebook</li>\n<li dir="ltr">Как продвигать "звезд" в YouTube</li>\n<li dir="ltr">Вирусные промокампании</li>\n<li dir="ltr">Использование возможностей Pinterest и Instagram</li>\n<li dir="ltr">Social Media Optimization: о секретных алгоритмах Facebook</li>\n<li dir="ltr">Опыт работы лучших украинских Digital-агентств</li>\n</ul>\n<p>&nbsp;</p>\n<p><br />Social Media и бизнес:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">Нуждается ли мой бизнес в использовании &nbsp;соц. сетей - как узнать?</li>\n<li dir="ltr">Успешные локальные маркетинговые кампании - рассмотрим примеры</li>\n<li dir="ltr">Facebook в Украине, Киеве, во Львове - определяем пользу</li>\n<li dir="ltr">Facebook-страница - как правильно оформить?</li>\n<li dir="ltr">Максимум результата за минимум времени - как добиться?</li>\n<li dir="ltr">Агентства &ndash; стоит ли доверяться?</li>\n</ul>\n<p>&nbsp;</p>\n<p><br />Новые медиа, разработка, стартапы:</p>\n<p>&nbsp;</p>\n<ul>\n<li dir="ltr">Собственные сервисы и social media - вопросы интеграции</li>\n<li dir="ltr">Mixed media</li>\n<li dir="ltr">Twitter, Facebook, Foursquare API</li>\n<li dir="ltr">BlogCamp</li>\n<li dir="ltr">SmartTV</li>\n<li dir="ltr">Линчи social media стартапов</li>\n</ul>\n<p>&nbsp;</p>\n<p><br />Стоимость билета:<br />200 грн. - Первые 50 билетов для ранних пташек<br />300 грн. - Следующие 200 билетов<br />500 грн. - Предпоследние 50 билетов<br />800 грн. - Кто поздно приходит, тому последние 20 билетов<br /> <br />Встречаемся&nbsp;23 февраля в конференц-зале УКУ (ул.. Хуторовка, 35а).</p>', 69, '', '', 8, 0, 0, 'publish', 'Administrator', 1362225886, 1362225886, 1387364053, 14, 3, 0),
(95, 'Оценка стоимости сайта и факторы, которые влияют на цену', '', 'otsenka-stoimosti-saita-i-faktory-kotorye-vliiaiut-na-tsenu', 'novosti/', 'как, время, разработки, продажи, интернет, ресурса, учитывается, достаточно, много, факторов, влияющих, цену, поэтому, нужно, уметь, оценить, стоимость, сайта, своими, силами, важно, планируете, создание, коммерческого, собираетесь, запустить, личный, блог, знать, финансовые', 'Как во время разработки, так и во время продажи Интернет-ресурса   учитывается достаточно много факторов, влияющих на его цену. Поэтому   нужно уметь оценить стоимость сайта своими силами. Не важно, планируете   ли вы создание коммерческого сайта или соби', '<p>Как во время разработки, так и во время продажи Интернет-ресурса учитывается достаточно много факторов, влияющих на его цену. Поэтому нужно уметь оценить стоимость сайта своими силами. Не важно, планируете ли вы создание коммерческого сайта или собираетесь запустить личный блог, знать финансовые стороны вопроса никогда не будет лишним.</p>', '<p>&nbsp;</p>\n<p><img src="http://www.imagecms.net/uploads/images/blog/site-price.jpg" alt="Быстрая оценка любого сайта" width="250" height="172" />Как во время разработки, так и во время продажи Интернет-ресурса учитывается достаточно много факторов, влияющих на его цену. Поэтому нужно уметь оценить стоимость сайта своими силами. Не важно, планируете ли вы создание коммерческого сайта или собираетесь запустить личный блог, знать финансовые стороны вопроса никогда не будет лишним. <a title="стоимость создания сайта" href="http://www.imagecms.net/blog/obzory/skolko-stoit-sait-postroit" target="_blank">Стоимость создания сайта</a> для многих является ключевым фактором, влияющим на принятие решения о разработка. Многое зависит от необходимых вам возможностей, ведь для простого блога вполне хватит бесплатной версии ImageCMS, а вот уже для торговой площадки понадобится коммерческий модуль Интернет-магазина.</p>\n<p>Оценка стоимости сайта при его разработке зависит от нескольких факторов. Пройдемся по пунктам:</p>\n<p>&nbsp;</p>\n<ul>\n<li>Дизайн. Если он уникальный &ndash; стоимость будет выше, но в этом случае учитываются все ваши пожелания и специфика вашего бизнеса. Индивидуальный подход позволяет сделать внешний вид сайта именно таким, каким вы бы хотели его видеть, и поднять <a title="юзабилити сайт" href="http://www.imagecms.net/blog/obzory/osnovy-iuzabiliti-saita" target="_blank">юзабилити сайта</a> на действительно высокий уровень. Шаблонный сайт обойдется дешевле, что позволит оценить стоимость сайта ниже, но и качество не будет на высоком уровне. Кроме того, такой же шаблон может использоваться и на десятках других сайтов.</li>\n<li>Функциональность. Думаю, не нужно быть профессионалом в web-разработке, чтобы понять, что различие в цене разработки сайта-визитки для местного фотографа и туристического портала, будет существенным. Оценка стоимости сайта в таком случае определяется сложностью добавляемых модулей.</li>\n<li>Контент. Пожалуй, о важности качественного контента на данный момент можно и не напоминать, это аксиома известная всем, как заказчикам, так и исполнителям. Конечно, качественный копирайтинг не может стоить дешево, и чем больше таких страниц нужно создать, тем дороже это обойдется. Точные знания относительно необходимого количества контента, позволяет узнать стоимость сайта более подробно. Но стоит помнить, что вложения в качество обязательно окупятся в долгосрочной перспективе.</li>\n<li>Оптимизация под поисковые системы (SEO). Если вам не нужны посетители, а сайт сделан просто для галочки и надписи на визитке &ndash; можете смело пропускать этот пункт. Вот только зачем тогда его вообще создавать? Оптимизация сайта является важным пунктом договора, который заранее оговаривается при разработке. Чтобы узнать стоимость сайта, необязательно сразу же просчитывать этот пункт, это скорее затраты будущего периода. Особенно хорошо нужно проработать такой момент как <a title="подбор ключевых слов для сайта" href="http://www.imagecms.net/blog/obzory/podbor-kliuchevyh-slov-kak-sdelat-vse-pravilno" target="_blank">подбор ключевых слов</a> для сайта, то есть, составление семантического ядра.</li>\n<li>Тематика сайта. Коммерческая ниша в любом случае будет цениться гораздо выше, чем развлекательная.</li>\n<li>Количество страниц в индексе. Чем их больше, тем выше можно выставить цену при продаже. Хороший багаж в плане контента будет полезен для любого проекта, как залог лояльности со стороны поисковых систем. Главное &ndash; чтобы все материалы сайта были уникальными, а не обычным копипастом.</li>\n<li>Показатели тИЦ и PR. Пожалуй, оценить стоимость сайта на основе этого показателя проще всего. Тут действует простое правило &ndash; чем больше, тем лучше.</li>\n<li>Посещаемость сайта. Оценка стоимости сайта с высокой посещаемостью всегда была высокой. В последнее время, в связи с ужесточением поисковых алгоритмов и увеличением конкуренции, сайты с более-менее пристойным количеством посетителей стали цениться еще выше.</li>\n<li>Присутствие в каталогах DMOZ, Mail.ru и Яндекс.Каталог. Хотя данный фактор уже не имеет такого веса как во времена расцвета ссылочных бирж, но он все еще играет весомую роль, если вас интересует оценка стоимости сайта, так как является своеобразным знаком качества от поисковиков.</li>\n</ul>\n<p>&nbsp;</p>\n<p><a href="http://www.imagecms.net/download"><img src="http://www.imagecms.net/uploads/images/blog/2.png" alt="Загрузить ImageCMS Corporate бесплатно" width="705" height="183" /></a></p>\n<p>Перечисленные выше факторы позволяют точно оценить стоимость сайта еще на этапе проектирования, и в случае надобности &ndash; внести необходимые корректировки. В случае, если ресурс принадлежит вам лично, а не компании, узнать стоимость сайта также очень важно, ведь он является выгодным активом, который можно в любой момент продать. Это может быть как блог, так и узкотематический проект, который хорошо закрепился в своей нише и представляет ценность для пользователей.</p>\n<p>В таком случае узнать стоимость сайта можно с помощью оценки немного других показателей, чем в первом случае. При продаже на стоимость повлияют такие показатели:</p>\n<p>В этой статье мы перечислили все основные факторы, с учетом которых можно оценить стоимость сайта и применить данные методики по отношению как корпоративному, так и личному проекту.</p>', 69, '', '', 9, 0, 0, 'publish', 'Administrator', 1362225958, 1362225958, 1387364060, 10, 3, 0);
INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(96, 'Зачем вашему оффлайн-бизнесу нужен Интернет-магазин?', '', 'zachem-vashemu-offlain-biznesu-nuzhen-internet-magazin', 'novosti/', 'несмотря, бурный, рост, интернет, коммерции, далеко, предприниматели, понимают, преимущества, магазина, особенно, оффлайная, торговая, точка, именно, таком, случае, проявляются, лучше, всего, ведь, получаете, только, отличный, источник, дополнительного, дохода, возможность, сравнения, эффективности', 'Несмотря на бурный рост Интернет-коммерции, далеко не все  предприниматели понимают, в чем преимущества Интернет-магазина, особенно  если уже есть оффлайная торговая точка. Но именно в таком случае  преимущества Интернет-магазина проявляются лучше всего,', '<p>Несмотря на бурный рост Интернет-коммерции, далеко не все предприниматели понимают, в чем преимущества Интернет-магазина, особенно если уже есть оффлайная торговая точка. Но именно в таком случае преимущества Интернет-магазина проявляются лучше всего, ведь вы получаете не только отличный источник дополнительного дохода, но и возможность сравнения эффективности вложения средств.</p>', '<p>&nbsp;</p>\n<p><img src="http://www.imagecms.net/uploads/images/blog/inet-magaz.jpg" alt="Интернет как перспективная бизнес-среда" width="213" height="200" />Несмотря на бурный рост Интернет-коммерции, далеко не все предприниматели понимают, в чем преимущества Интернет-магазина, особенно если уже есть оффлайная торговая точка. Но именно в таком случае преимущества Интернет-магазина проявляются лучше всего, ведь вы получаете не только отличный источник дополнительного дохода, но и возможность сравнения эффективности вложения средств.</p>\n<p>Так зачем нужен Интернет-магазин современному предпринимателю? В зависимости от того, есть ли у вас уже действующий оффлайн-бизнес, он может быть как дополнением к нему, или же основным источником дохода. Уже отталкиваясь от этого, нужно планировать бюджет создания магазина и его развития. Над онлайновой торговой площадкой нужно вести постоянную работу, подробно проработать <a href="http://www.imagecms.net/blog/obzory/biznes-plan-internet-magazina-na-chto-obratit-vnimanie" target="_blank">бизнес-план Интернет-магазина</a> - это не просто визитка, созданная &laquo;для галочки&raquo;... это полноценный и очень эффективный инструмент продаж. Плюсов у онлайн-бизнеса, по сравнению с оффлайном, довольно много.</p>\n<p><a href="http://www.imagecms.net/download"><img src="http://www.imagecms.net/uploads/images/blog/2.png" alt="Система для создания интернет-магазинов - ImageCMS" width="705" height="183" /></a></p>\n<p>Перечислим основные преимущества Интернет-магазина:</p>\n<p>&nbsp;</p>\n<ul>\n<li>можно обойтись без аренды производственных площадей и складов - достаточно небольшого офиса для обслуживания;</li>\n<li>может быть как основным источником прибыли, так и дополнительным по отношению к основному бизнесу - это важное обоснование при вопросе зачем нужен Интернет-магазин;</li>\n<li>гораздо меньший порог вхождения, хотя конкуренция в разных тематиках отличается;</li>\n<li>нет региональных ограничений: можно находить клиентов как в своем городе или области, так и по всей стране;</li>\n<li>доступность в режиме 24/7: круглосуточно и семь дней в неделю;</li>\n<li>такие преимущества Интернет-магазина как экономия времени и свобода выбора, играют важную роль и для покупателей;</li>\n<li><a title="бизнес в Интернете" href="http://www.imagecms.net/blog/obzory/biznes-v-internete-kak-perspektivnyi-trend" target="_blank">бизнес в Интернете</a> не требует большого количества обслуживающего персонала: можно обойтись одним консультантом там, где обычные торговые точки обслуживают пятерых;</li>\n<li>нет ограничений по количеству представленных на виртуальной витрине товаров;</li>\n<li>в случае с раскруткой и продвижением можно сфокусироваться только на потенциально заинтересованных в ваших товарах или услугах пользователях.</li>\n</ul>\n<p>&nbsp;</p>\n<p>Можно привести несколько примеров развертывания Интернет-магазинов на платформе <a href="http://www.imagecms.net/products/imagecms-shop-professional">ImageCMS Shop Professional</a>: boutique-ekaterinasmolina.ru, euro-technika.com.ua и др. Как видно из примеров, можно торговать в онлайне как с небольшим ассортиментом, так и предлагая тысячи наименований товаров. Учитывая вышеперечисленное, каждый владелец бизнеса может понять, зачем нужен Интернет-магазин и какие выгоды от его разработки можно получить (независимо от того, работаете ли вы с розничной торговлей или в области B2B).</p>', 69, '', '', 10, 0, 0, 'publish', 'Administrator', 1362226037, 1362226037, 1409655971, 39, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `content_fields`
--

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
-- Дамп даних таблиці `content_fields`
--

INSERT INTO `content_fields` (`field_name`, `type`, `label`, `data`, `weight`, `in_search`) VALUES
('field_list_image', 'text', 'Изображение в списке', 'a:7:{s:5:"label";s:38:"Изображение в списке";s:7:"initial";s:0:"";s:9:"help_text";s:109:"Это изображение будет выводиться на странице списка статей";s:4:"type";s:4:"text";s:20:"enable_image_browser";s:1:"1";s:10:"validation";s:0:"";s:6:"groups";a:1:{i:0;s:2:"13";}}', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `content_fields_data`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп даних таблиці `content_fields_data`
--

INSERT INTO `content_fields_data` (`id`, `item_id`, `item_type`, `field_name`, `data`) VALUES
(24, 91, 'page', 'field_list_image', ''),
(25, 96, 'page', 'field_list_image', '');

-- --------------------------------------------------------

--
-- Структура таблиці `content_fields_groups_relations`
--

CREATE TABLE IF NOT EXISTS `content_fields_groups_relations` (
  `field_name` varchar(64) NOT NULL,
  `group_id` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `content_fields_groups_relations`
--

INSERT INTO `content_fields_groups_relations` (`field_name`, `group_id`) VALUES
('field_sfsdfsdf', 0),
('field_sfsdfsdf', 0),
('field_fyjtyutyu', 0),
('field_fg12', 0),
('field_fg12', 0),
('field_list_image', 13),
('field_sfsdfsdf', 0),
('field_sfsdfsdf', 0),
('field_fyjtyutyu', 0),
('field_fg12', 0),
('field_fg12', 0),
('field_list_image', 13);

-- --------------------------------------------------------

--
-- Структура таблиці `content_field_groups`
--

CREATE TABLE IF NOT EXISTS `content_field_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп даних таблиці `content_field_groups`
--

INSERT INTO `content_field_groups` (`id`, `name`, `description`) VALUES
(13, 'Новости', '');

-- --------------------------------------------------------

--
-- Структура таблиці `content_permissions`
--

CREATE TABLE IF NOT EXISTS `content_permissions` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп даних таблиці `content_permissions`
--

INSERT INTO `content_permissions` (`id`, `page_id`, `data`) VALUES
(23, 80, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}');

-- --------------------------------------------------------

--
-- Структура таблиці `content_tags`
--

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
-- Структура таблиці `custom_fields`
--

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
-- Дамп даних таблиці `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `field_type_id`, `field_name`, `is_required`, `is_active`, `is_private`, `validators`, `entity`, `options`, `classes`, `position`) VALUES
(96, 0, 'city', 0, 1, 0, NULL, 'user', NULL, '', NULL),
(97, 0, 'city', 0, 1, 0, NULL, 'order', NULL, '', NULL),
(99, 0, 'addphone', 0, 1, 0, NULL, 'user', NULL, '', NULL),
(100, 0, 'addphone', 0, 1, 0, NULL, 'order', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `custom_fields_data`
--

CREATE TABLE IF NOT EXISTS `custom_fields_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `field_data` text,
  `locale` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=515 ;

--
-- Дамп даних таблиці `custom_fields_data`
--

INSERT INTO `custom_fields_data` (`id`, `field_id`, `entity_id`, `field_data`, `locale`) VALUES
(514, 97, 51, '', 'ru');

-- --------------------------------------------------------

--
-- Структура таблиці `custom_fields_i18n`
--

CREATE TABLE IF NOT EXISTS `custom_fields_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(4) NOT NULL,
  `field_label` varchar(255) DEFAULT NULL,
  `field_description` text,
  `possible_values` text,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `custom_fields_i18n`
--

INSERT INTO `custom_fields_i18n` (`id`, `locale`, `field_label`, `field_description`, `possible_values`) VALUES
(96, 'ru', 'Город', '', NULL),
(97, 'ru', 'Город', '', NULL),
(99, 'ru', 'Доп. телефон', '', NULL),
(100, 'ru', 'Доп. телефон', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `template` text CHARACTER SET utf8 NOT NULL,
  `settings` text CHARACTER SET utf8 NOT NULL,
  `locale` varchar(5) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `emails`
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
('forgotPassword', 'Здравствуйте!<br><br>На сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.<br><br>Для завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri%<br><br>Ваш новый пароль для входа: %password%<br><br>Если это письмо попало к Вам по ошибке просто проигнорируйте его.<br><br>При возникновении любых вопросов, обращайтесь по телефонам:<br><br>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89<br><br>---<br><br>С уважением,<br><br>сотрудники службы продаж %webSiteName%  ', 'a:5:{s:5:"theme";s:41:"Восстановление пароля";s:4:"from";s:37:"Администрация сайта";s:9:"from_mail";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'ru', 'Шаблон письма о восстановлении пароля  '),
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
-- Структура таблиці `gallery_albums`
--

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
-- Структура таблиці `gallery_albums_i18n`
--

CREATE TABLE IF NOT EXISTS `gallery_albums_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `description` text NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `gallery_category`
--

CREATE TABLE IF NOT EXISTS `gallery_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_id` int(11) NOT NULL DEFAULT '0',
  `position` int(9) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Структура таблиці `gallery_category_i18n`
--

CREATE TABLE IF NOT EXISTS `gallery_category_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `description` text,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `gallery_images`
--

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
-- Структура таблиці `gallery_images_i18n`
--

CREATE TABLE IF NOT EXISTS `gallery_images_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `languages`
--

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
-- Дамп даних таблиці `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `identif`, `image`, `folder`, `template`, `default`, `locale`) VALUES
(3, 'Русский', 'ru', '', 'russian', 'newLevel', 1, 'ru_RU');

-- --------------------------------------------------------

--
-- Структура таблиці `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip_address` (`ip_address`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

-- --------------------------------------------------------

--
-- Структура таблиці `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `mail`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп даних таблиці `menus`
--

INSERT INTO `menus` (`id`, `name`, `main_title`, `tpl`, `expand_level`, `description`, `created`) VALUES
(4, 'top_menu', 'Top menu', 'top_menu', 1, 'Меню в верхней части шаблона', '2014-07-30 12:04:34'),
(14, 'left_menu', 'Left menu', 'left_menu', 0, '', '2014-09-02 13:57:57');

-- --------------------------------------------------------

--
-- Структура таблиці `menus_data`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

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
(16, 4, 66, 'page', NULL, '', 0, 'Доставка', 0, 2, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";i:0;}'),
(57, 4, 0, 'url', '', '', 0, 'Бренды', 0, 3, NULL, 'a:2:{s:3:"url";s:11:"/shop/brand";s:7:"newpage";i:0;}'),
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
(40, 4, 69, 'category', NULL, '', 0, 'Новости', 0, 4, NULL, 'N;'),
(48, 4, 64, 'page', NULL, '', 0, 'Про компанию', 0, 1, NULL, 'a:2:{s:4:"page";N;s:7:"newpage";i:0;}'),
(62, 14, 0, 'url', NULL, '', 0, 'Новости', 0, 4, NULL, 'a:2:{s:3:"url";s:8:"/novosti";s:7:"newpage";i:0;}'),
(61, 14, 0, 'url', '', '', 0, 'Бренды', 0, 3, NULL, 'a:2:{s:3:"url";s:10:"shop/brand";s:7:"newpage";i:0;}'),
(60, 14, 68, 'page', '', '', 0, 'Контакты', 0, 5, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(59, 14, 66, 'page', '', '', 0, 'Доставка', 0, 2, NULL, 'a:1:{s:7:"newpage";i:0;}'),
(58, 14, 64, 'page', '', '', 0, 'Про компанию', 0, 1, NULL, 'a:1:{s:7:"newpage";i:0;}');

-- --------------------------------------------------------

--
-- Структура таблиці `menu_translate`
--

CREATE TABLE IF NOT EXISTS `menu_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Дамп даних таблиці `menu_translate`
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
(55, 16, 3, 'Доставка'),
(54, 17, 3, 'Возврат'),
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
-- Структура таблиці `mod_banner`
--

CREATE TABLE IF NOT EXISTS `mod_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(4) NOT NULL,
  `active_to` int(11) DEFAULT NULL,
  `where_show` text,
  `group` text,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп даних таблиці `mod_banner`
--

INSERT INTO `mod_banner` (`id`, `active`, `active_to`, `where_show`, `group`, `position`) VALUES
(13, 1, -1, 'a:1:{i:0;s:6:"main_0";}', 'b:0;', 0),
(14, 1, -1, 'a:1:{i:0;s:6:"main_0";}', 'b:0;', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_banner_groups`
--

CREATE TABLE IF NOT EXISTS `mod_banner_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблиці `mod_banner_i18n`
--

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
-- Дамп даних таблиці `mod_banner_i18n`
--

INSERT INTO `mod_banner_i18n` (`id`, `url`, `locale`, `name`, `description`, `photo`) VALUES
(13, '/shop/category/telefoniia-pleery-gps/naruchnye-chasy/klassicheskie-chasy', 'ru', 'banner-1', '<p>summer dream</p>', '/uploads/shop/banners/b1.jpg'),
(14, '/shop/category/zhenskie-chasy', 'ru', 'banner-2', '<p>Beauty</p>', '/uploads/shop/banners/b2.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `mod_discount_all_order`
--

CREATE TABLE IF NOT EXISTS `mod_discount_all_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `for_autorized` tinyint(4) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `is_gift` tinyint(4) DEFAULT NULL,
  `begin_value` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп даних таблиці `mod_discount_all_order`
--

INSERT INTO `mod_discount_all_order` (`id`, `for_autorized`, `discount_id`, `is_gift`, `begin_value`) VALUES
(2, NULL, 2, 1, 1000);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_discount_brand`
--

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
-- Структура таблиці `mod_discount_category`
--

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
-- Структура таблиці `mod_discount_comulativ`
--

CREATE TABLE IF NOT EXISTS `mod_discount_comulativ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_id` int(11) DEFAULT NULL,
  `begin_value` int(11) DEFAULT NULL,
  `end_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп даних таблиці `mod_discount_comulativ`
--

INSERT INTO `mod_discount_comulativ` (`id`, `discount_id`, `begin_value`, `end_value`) VALUES
(1, 3, 0, 1000),
(2, 4, 1001, 10000),
(3, 6, 1000000, 100000000),
(4, 7, 50000000, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_discount_group_user`
--

CREATE TABLE IF NOT EXISTS `mod_discount_group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `mod_discount_group_user`
--

INSERT INTO `mod_discount_group_user` (`id`, `group_id`, `discount_id`) VALUES
(1, 1, 5);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_discount_product`
--

CREATE TABLE IF NOT EXISTS `mod_discount_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп даних таблиці `mod_discount_product`
--

INSERT INTO `mod_discount_product` (`id`, `product_id`, `discount_id`) VALUES
(1, 1104, 8),
(2, 17259, 2);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_discount_user`
--

CREATE TABLE IF NOT EXISTS `mod_discount_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп даних таблиці `mod_discount_user`
--

INSERT INTO `mod_discount_user` (`id`, `user_id`, `discount_id`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_email_paterns`
--

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
-- Дамп даних таблиці `mod_email_paterns`
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
-- Структура таблиці `mod_email_paterns_i18n`
--

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
-- Дамп даних таблиці `mod_email_paterns_i18n`
--

INSERT INTO `mod_email_paterns_i18n` (`id`, `locale`, `theme`, `user_message`, `admin_message`, `description`, `variables`) VALUES
(1, 'ru', 'Заказ товара', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Мы благодарны Вам за то, что совершили заказ в нашем магазине.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Вы указали следующие контактные данные:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$userEmail$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Номер телефона: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Адрес доставки: </span>$userDeliver$</div>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.</p>\n<p style="font-family: arial; font-size: 13px;">Также, Вы можете всегда посмотреть за статусом Вашего заказа, <a href="$orderLink$" target="_blank">перейдя по ссылке</a>.</p>', '<p>Пользователь&nbsp;$userName$ совершил заказ товара</p>\n<p>Email адрес: $userEmail$</p>\n<p>Номер телефона: $userPhone$</p>\n<p>Адрес доставки: $userDeliver$</p>', '<p><span>Уведомление покупателя о совершении заказа</span></p>', 'a:5:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$userPhone$";s:39:"Телефон Пользователя";s:13:"$userDeliver$";s:27:"Адрес доставки";s:11:"$orderLink$";s:28:"Ссылка на заказ";}'),
(2, 'ru', 'Смена статуса заказа', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Статус вашего заказа изменен на <strong>$status$</strong></p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Вы указали следующие контактные данные:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$userEmail$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Номер телефона: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Адрес доставки: </span>$userDeliver$</div>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.</p>\n<p style="font-family: arial; font-size: 13px;">Также, Вы можете всегда посмотреть за статусом Вашего заказа, <a href="$orderLink$" target="_blank">перейдя по ссылке</a>.</p>', '', '<p>Смена статуса заказа</p>', 'a:6:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$orderLink$";s:28:"Ссылка на заказ";s:8:"$status$";s:25:"Статус заказа";s:11:"$userPhone$";s:39:"Телефон пользователя";s:13:"$userDeliver$";s:27:"Адрес доставки";}'),
(3, 'ru', 'Товар появился на складе!', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Товар&nbsp;<a href="$productLink$" target="_blank">$productName$</a>&nbsp;появился на складе. Вы можете его заказать.</p>', '', '<p>Уведомление о появлении</p>', 'a:5:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:13:"$productName$";s:33:"Название продукта";s:8:"$status$";s:12:"Статус";s:13:"$productLink$";s:32:"Ссылка на продукт";}'),
(4, 'ru', 'Создание пользователя', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $user_name$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Поздравляем! Ваша регистрация прошла успешно.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Данные для входа в магазин:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$user_email$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Пароль: </span>$user_password$</div>', '<p><span>Создан пользователь $user_name$:</span><br /><span>С паролем: $user_password$</span><br /><span>Адресом: &nbsp;$<span>user_</span>address$</span><br /><span>Email пользователя: $user_email$</span><br /><span>Телефон пользователя: $user_phone$</span></p>', '<p>Шаблон письма на создание пользователя</p>', 'a:5:{s:11:"$user_name$";s:31:"Имя пользователя";s:15:"$user_password$";s:12:"Пароль";s:14:"$user_address$";s:12:"Адресс";s:12:"$user_email$";s:5:"Email";s:12:"$user_phone$";s:14:"Телефон";}'),
(5, 'ru', 'Восстановление пароля', '<p><span>Здравствуйте!</span><br /><br /><span>На сайте $webSiteName$ создан запрос на восстановление пароля для Вашего аккаунта.</span><br /><br /><span>Для завершения процедуры восстановления пароля перейдите по ссылке $resetPasswordUri$</span><br /><br /><span>Ваш новый пароль для входа: $password$</span><br /><br /><span>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь по телефонам:</span><br /><br /><span>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89</span><br /><br /><span>---</span><br /><br /><span>С уважением,</span><br /><br /><span>сотрудники службы продаж $webSiteName$</span></p>', '', 'Шаблон письма на  восстановление пароля', 'a:5:{s:13:"$webSiteName$";s:17:"Имя сайта";s:18:"$resetPasswordUri$";s:59:"Ссылка на восстановления пароля";s:10:"$password$";s:12:"Пароль";s:5:"$key$";s:8:"Ключ";s:16:"$webMasterEmail$";s:54:"Email сотрудников службы продаж";}'),
(6, 'ru', 'Смена пароля', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Вы успешно изменили пароль</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Ваш новый пароль для входа: $password$</p>', '', '<p>Шаблон письма изменения пароля</p>', 'a:2:{s:11:"$user_name$";s:31:"Имя пользователя";s:10:"$password$";s:23:"Новый пароль";}'),
(7, 'ru', 'Изменение цены', '<p>Цена на $name$ за которым вы следите на сайте $server$ изменилась.</p>\n<p><a title="Посмотреть список слежения" href="$list_url_look$">Посмотреть список слежения</a></p>\n<p><a title="Отписатся от слежения" href="$delete_list_url_look$">Отписатся от слежения</a></p>', '<p>&nbsp;</p>\n<div id="dc_vk_code">&nbsp;</div>', '<p>Изменение цены</p>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>', ''),
(7, 'ua', 'Ціна змінилася', '<p>Ціна на $name$ за яким Ви слідкуєте на сайті $server$ змінилася.<br /> <a title="Переглянути список слідкувань" href="$list_url_look$">Переглянути список слідкувань</a><br /> <a title="Відписатися від слідкування" href="$delete_list_url_look$">Відписатися від слідкування</a></p>\n<div id="dc_vk_code"  none;">&nbsp;</div>', '<p>&nbsp;</p>\n<div id="dc_vk_code">&nbsp;</div>', '<p>Слідкування за ціною</p>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>', ''),
(8, 'ru', 'Список Желаний', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Вы создали список желаний $wishName$</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Ссылка на просмотр списка желаний <a href="$wishLink$" target="_blank">$wishLink$</a></p>', '<p>Пользователь&nbsp;<span>$userName$ создал список желаний - $wishName$.<br /></span></p>\n<p><span><span>&nbsp;</span></span></p>', '<p><span>Уведомление о создании списка желаний</span></p>', 'a:4:{s:10:"$userName$";s:31:"Имя пользователя";s:10:"$wishName$";s:29:"Название списка";s:10:"$wishLink$";s:30:"Ссилка на список";s:15:"$wishListViews$";s:54:"Количество просмотров списка";}'),
(9, 'ru', 'Заказ звонка', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Вы заказали звонок в нашей компании<br />Менеджеры нашего магазина вскоре свяжутся с Вами.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Вы указали следующие контактные данные:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Телефон: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Коментарий: </span>$userComment$</div>', '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Новий запрос о Заказе дзвонка от $userName$</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Дата колбека: </span>$dateCreated$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Телефон пользователя: </span>$userPhone$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Коментарий пользователя: </span>$userComment$</div>', '<p>Шаблон заказа звонока</p>', 'a:6:{s:16:"$callbackStatus$";s:27:"Статус колбека";s:15:"$callbackTheme$";s:23:"Тема колбека";s:10:"$userName$";s:69:"Имя пользователя запросившего звонок";s:13:"$dateCreated$";s:23:"Дата колбека";s:13:"$userComment$";s:63:" Комментарии пользователя колбека";s:11:"$userPhone$";s:90:"Номер телефона пользователя запросившего колбек";}');

-- --------------------------------------------------------

--
-- Структура таблиці `mod_new_level_columns`
--

CREATE TABLE IF NOT EXISTS `mod_new_level_columns` (
  `category_id` varchar(500) NOT NULL,
  `column` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `mod_new_level_product_properties_types`
--

CREATE TABLE IF NOT EXISTS `mod_new_level_product_properties_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `type` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп даних таблиці `mod_new_level_product_properties_types`
--

INSERT INTO `mod_new_level_product_properties_types` (`id`, `property_id`, `name`, `type`) VALUES
(1, 29, 0, 'a:1:{i:0;s:6:"scroll";}'),
(4, 28, 0, 'a:2:{i:0;s:6:"scroll";i:1;s:8:"dropDown";}'),
(5, 22, 0, 'a:1:{i:0;s:8:"dropDown";}'),
(6, 21, 0, 'a:1:{i:0;s:6:"scroll";}'),
(7, 24, 0, 'a:2:{i:0;s:8:"dropDown";i:1;s:6:"scroll";}');

-- --------------------------------------------------------

--
-- Структура таблиці `mod_sample_settings`
--

CREATE TABLE IF NOT EXISTS `mod_sample_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `mod_sample_settings`
--

INSERT INTO `mod_sample_settings` (`id`, `name`, `value`) VALUES
(1, 'mailTo', 'admin@site.com'),
(2, 'useEmailNotification', 'TRUE'),
(3, 'key', 'UUUsssTTTeee');

-- --------------------------------------------------------

--
-- Структура таблиці `mod_seo`
--

CREATE TABLE IF NOT EXISTS `mod_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(5) DEFAULT NULL,
  `settings` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `mod_seo_inflect`
--

CREATE TABLE IF NOT EXISTS `mod_seo_inflect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original` varchar(250) NOT NULL,
  `inflection_id` int(11) NOT NULL,
  `inflected` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `mod_seo_products`
--

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
-- Структура таблиці `mod_shop_discounts`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп даних таблиці `mod_shop_discounts`
--

INSERT INTO `mod_shop_discounts` (`id`, `key`, `name`, `active`, `max_apply`, `count_apply`, `date_begin`, `date_end`, `type_value`, `value`, `type_discount`) VALUES
(1, '1mf82j8lypb107d5', NULL, 1, NULL, NULL, 1387490400, 0, 1, 12, 'user'),
(2, '0ka9v81ts33cjx21', NULL, 1, NULL, NULL, 1406840400, 0, 1, 10, 'product');

-- --------------------------------------------------------

--
-- Структура таблиці `mod_shop_discounts_i18n`
--

CREATE TABLE IF NOT EXISTS `mod_shop_discounts_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `mod_shop_discounts_i18n`
--

INSERT INTO `mod_shop_discounts_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'знижка адміна'),
(2, 'ru', '123');

-- --------------------------------------------------------

--
-- Структура таблиці `mod_shop_news`
--

CREATE TABLE IF NOT EXISTS `mod_shop_news` (
  `content_id` int(11) NOT NULL,
  `shop_categories_ids` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `mod_sitemap_blocked_urls`
--

CREATE TABLE IF NOT EXISTS `mod_sitemap_blocked_urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `robots_check` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `mod_sitemap_changefreq`
--

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
-- Дамп даних таблиці `mod_sitemap_changefreq`
--

INSERT INTO `mod_sitemap_changefreq` (`id`, `main_page_changefreq`, `pages_changefreq`, `product_changefreq`, `categories_changefreq`, `products_categories_changefreq`, `products_sub_categories_changefreq`, `brands_changefreq`, `sub_categories_changefreq`) VALUES
(1, 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly');

-- --------------------------------------------------------

--
-- Структура таблиці `mod_sitemap_priorities`
--

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
-- Дамп даних таблиці `mod_sitemap_priorities`
--

INSERT INTO `mod_sitemap_priorities` (`id`, `main_page_priority`, `cats_priority`, `pages_priority`, `sub_cats_priority`, `products_priority`, `products_categories_priority`, `products_sub_categories_priority`, `brands_priority`) VALUES
(1, 1, 0.8, 0.9, 0.7, 0.4, 0.6, 0.5, 0.3);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_stats_attendance`
--

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
-- Структура таблиці `mod_stats_attendance_robots`
--

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
-- Структура таблиці `mod_stats_search`
--

CREATE TABLE IF NOT EXISTS `mod_stats_search` (
  `key` varchar(70) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `ac` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `mod_stats_settings`
--

CREATE TABLE IF NOT EXISTS `mod_stats_settings` (
  `setting` varchar(70) DEFAULT NULL,
  `value` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `mod_wish_list`
--

CREATE TABLE IF NOT EXISTS `mod_wish_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(254) NOT NULL,
  `description` text,
  `access` enum('public','private','shared') NOT NULL DEFAULT 'shared',
  `user_id` int(11) NOT NULL,
  `review_count` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп даних таблиці `mod_wish_list`
--

INSERT INTO `mod_wish_list` (`id`, `title`, `description`, `access`, `user_id`, `review_count`, `hash`) VALUES
(4, 'test2', NULL, 'shared', 1, 0, 'FcaZhCPOOCTpgUIC'),
(6, 'алопглюбрдюлд', '0', 'shared', 52, 0, 'vHyfzuSlMkNtDJFL');

-- --------------------------------------------------------

--
-- Структура таблиці `mod_wish_list_products`
--

CREATE TABLE IF NOT EXISTS `mod_wish_list_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wish_list_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп даних таблиці `mod_wish_list_products`
--

INSERT INTO `mod_wish_list_products` (`id`, `wish_list_id`, `variant_id`, `comment`) VALUES
(4, 4, 18147, NULL),
(5, 4, 18149, NULL),
(6, 4, 18155, NULL),
(7, 4, 18158, NULL),
(8, 4, 18160, NULL),
(9, 4, 18161, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_wish_list_users`
--

CREATE TABLE IF NOT EXISTS `mod_wish_list_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(254) DEFAULT NULL,
  `user_image` text,
  `user_birthday` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `mod_wish_list_users`
--

INSERT INTO `mod_wish_list_users` (`id`, `user_name`, `user_image`, `user_birthday`, `description`) VALUES
(1, 'Administrator', NULL, NULL, NULL),
(52, 'Test', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `propel_migration`
--

CREATE TABLE IF NOT EXISTS `propel_migration` (
  `version` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `propel_migration`
--

INSERT INTO `propel_migration` (`version`) VALUES
(1401265086),
(1401265086);

-- --------------------------------------------------------

--
-- Структура таблиці `rating`
--

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
-- Структура таблиці `search`
--

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
-- Структура таблиці `settings`
--

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
-- Дамп даних таблиці `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `google_analytics_id`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`, `lang_sel`, `google_webmaster`, `yandex_webmaster`, `yandex_metric`, `ss`, `cat_list`, `text_editor`, `siteinfo`, `update`, `backup`, `robots_status`) VALUES
(2, 'main', 'auto', 'auto', '0', '0', 1, 1, '/', '0', 'inTime', 'no', '', 'module', 69, '63', 'shop', '', '', 'ru_RU', '', '', '', '', 'yes', 'tinymce', 'a:3:{s:13:"siteinfo_logo";s:8:"logo.png";s:16:"siteinfo_favicon";s:11:"favicon.ico";s:2:"ru";a:5:{s:20:"siteinfo_companytype";s:47:"© Интернет-магазин “InTime”";s:16:"siteinfo_address";s:32:"ул. Мира, 85, офис 305";s:18:"siteinfo_mainphone";s:15:"0 800-123-45-67";s:19:"siteinfo_adminemail";s:19:"webmaster@localhost";s:8:"contacts";a:12:{s:5:"Skype";s:10:"intime.com";s:5:"Email";s:15:"info@intime.com";s:7:"phone-2";s:15:"0 800-123-45-67";s:4:"call";s:27:"Звоните 9:00 - 20:00";s:15:"facebook_iframe";s:354:"<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fimagecms.net&width=380&height=255&colorscheme=light&show_faces=true&header=true&stream=false&show_border=false&appId=335067319954909" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:380px; height:255px;" allowTransparency="true"></iframe>";s:11:"contact-map";s:1058:"<iframe width="100%" height="425" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ua/maps?f=q&source=s_q&hl=uk&geocode=&q=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2+%D1%81%D0%B0%D0%B9%D1%82%D1%96%D0%BC%D1%96%D0%B4%D0%B6&aq=&sll=49.827656,24.044452&sspn=0.011323,0.033023&t=h&g=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2,+%D0%9B%D0%B8%D1%87%D0%B0%D0%BA%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B8%D0%B9+%D1%80%D0%B0%D0%B9%D0%BE%D0%BD,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C&ie=UTF8&hq=%D1%81%D0%B0%D0%B9%D1%82%D1%96%D0%BC%D1%96%D0%B4%D0%B6&hnear=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C&ll=49.827656,24.044452&spn=0.002831,0.008256&z=14&iwloc=A&cid=16384824365677287861&output=embed"></iframe>";s:9:"time_work";s:28:"Пн-Пт с 8:00 до 21:00";s:14:"vkontakte-link";s:1:"#";s:13:"facebook-link";s:1:"#";s:18:"odnoklassniki-link";s:1:"#";s:10:"gplus-link";s:1:"#";s:3:"map";s:1058:"<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ua/maps?f=q&source=s_q&hl=uk&geocode=&q=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2+%D1%81%D0%B0%D0%B9%D1%82%D1%96%D0%BC%D1%96%D0%B4%D0%B6&aq=&sll=49.827656,24.044452&sspn=0.011323,0.033023&t=h&g=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2,+%D0%9B%D0%B8%D1%87%D0%B0%D0%BA%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B8%D0%B9+%D1%80%D0%B0%D0%B9%D0%BE%D0%BD,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C&ie=UTF8&hq=%D1%81%D0%B0%D0%B9%D1%82%D1%96%D0%BC%D1%96%D0%B4%D0%B6&hnear=%D0%92%D0%BE%D0%B4%D0%BE%D0%B3%D1%96%D0%BD%D0%BD%D0%B0+%D0%B2%D1%83%D0%BB.,+2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C&ll=49.827656,24.044452&spn=0.002831,0.008256&z=14&iwloc=A&cid=16384824365677287861&output=embed"></iframe>";}}}', '', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `settings_i18n`
--

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
-- Дамп даних таблиці `settings_i18n`
--

INSERT INTO `settings_i18n` (`id`, `lang_ident`, `name`, `short_name`, `description`, `keywords`) VALUES
(1, 3, 'In Time', 'intime', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_banners`
--

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
-- Дамп даних таблиці `shop_banners`
--

INSERT INTO `shop_banners` (`id`, `position`, `active`, `categories`, `on_main`, `espdate`) VALUES
(7, 23, 1, 'false', 1, 2147483647),
(11, 24, 1, 'false', 1, 2147457600),
(12, 25, 1, 'false', 1, 2147457600);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_banners_i18n`
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
-- Дамп даних таблиці `shop_banners_i18n`
--

INSERT INTO `shop_banners_i18n` (`id`, `locale`, `name`, `text`, `url`, `image`) VALUES
(12, 'ru', 'Samsung', ' ', '/shop/brand/samsung', 'template-imageshop-banner-3.jpg'),
(7, 'ru', 'Epson', ' ', '/shop/brand/epson', 'template-imageshop-banner-1.jpg'),
(11, 'ru', 'Sony', ' ', '/shop/brand/sony', 'template-imageshop-banner-2.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_brands`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=296 ;

--
-- Дамп даних таблиці `shop_brands`
--

INSERT INTO `shop_brands` (`id`, `url`, `image`, `position`, `created`, `updated`) VALUES
(293, 'icewatch', 'icewatch.jpg', 0, 1407149114, 1407149114),
(292, 'fossil', 'fossil.jpg', 0, 1407148925, 1407148925),
(291, 'citizen', 'citizen.jpg', 0, 1407148791, 1407148791),
(290, 'emporioarmani', 'emporioarmani.jpg', 0, 1407148702, 1407148702),
(289, 'seiko', 'seiko.jpg', 0, 1407148259, 1407148259),
(288, 'gshock', 'gshock.png', 0, 1407148209, 1407148209),
(287, 'casio', 'casio.jpg', 0, 1407148081, 1407148136),
(286, 'accurist', 'accurist.jpg', 0, 1407147997, 1407147997),
(294, 'rotary', 'rotary.jpg', 0, 1407149180, 1407149180),
(295, 'sekonda', 'sekonda.gif', 0, 1407149259, 1407149259);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_brands_i18n`
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
-- Дамп даних таблиці `shop_brands_i18n`
--

INSERT INTO `shop_brands_i18n` (`id`, `locale`, `name`, `description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(295, 'ru', 'Sekonda', '<p>SEKONDA - широко известная торговая марка часов с многолетней историей. Часы &laquo;Sekonda&raquo; были созданы Первым московским часовым заводом &laquo;Полет&raquo; в 1966 году и первоначально были предназначены только для экспортных поставок в Великобританию.</p>', '', '', ''),
(294, 'ru', 'Rotary', '<p>Rotary &mdash; одна из старейших швейцарских часовых компаний. Ее история длится уже более века.</p>', '', '', ''),
(293, 'ru', 'Ice Watch', '<p>Часы Ice-Watch &ndash; это не просто прибор для измерения времени, это стильный аксессуар и часть образа. Деятельность компании Ice-Watch началась в 2007 году в Бельгии. Сегодня часы этой марки можно приобрести более чем в 80 странах, на всех континентах. К слову, к концу 2010 года по всему миру было продано около 3 000 000 экземпляров.</p>', '', '', ''),
(292, 'ru', 'Fossil', '<p>История компании Fossil начинается с 1984 года, года ее основания. Оценив рынок, компания сделала ставку на производство новых модных часов, в то время как другие компании уделяли больше внимания функциональности часов. Ниша рынка fashion часов в то время была практически пуста, и они без особого труда заняли высокие позиции.</p>', '', '', ''),
(291, 'ru', 'Citizen', '<p>Citizen &mdash; крупный японский производитель часов. Компания была основана в 1930 году на базе института Shōkōsha Tokei Kenkyūsho, действующего с 1918 года. С 1936 года часы Citizen экспортируются во многие страны мира.</p>', '', '', ''),
(289, 'ru', 'Seiko', '<p>Seiko Holdings Corporation, более широко известная как Seiko &mdash; японская компания по производству часовой продукции, ювелирных изделий, прецизионных инструментов и точной механики.</p>', '', '', ''),
(290, 'ru', 'Emporio Armani', '<p>Часы Emporio Armani уже прочно заняли свое место в области фэшн-часов. Первые коллекции часов этой марки выпустил еще сам Джорджио Армани, который и создал их концепцию и классический дизайн. Как говорил сам известный во всем мире модельер, коллекции от Армани предназначены для молодых людей, которые хорошо понимают классический стиль и в своем выборе руководствуются собственным вкусом, а не веяниям изменчивой моды.</p>', '', '', ''),
(288, 'ru', 'G-shock', '<p>G-Shock &mdash; це назва наручного ударостійкого, та водонепроникного годинника від Японської корпорації Casio. Годинник розроблений в першу чергу для спортсменів, адже може витримувати сильні удари та сильну вібрацію. Також G-Shock можуть користуватись професійні пірнальники та плавці, бо годинники зберігають свою водонепроникність на великій глибині до 200 метрів. Скелелази мають змогу бачити своє місце знаходження над рівнем моря, завдяки деяким моделям G-Shock, що також вимірюють атмосферний тиск.</p>', '', '', ''),
(286, 'ru', 'ACCURIST', '<p>Часы Accurist &mdash; это первые в мире часы, которые при изготовлении оснащались усложненным часовым механизмом 21 JEWEL, ставший этаким лозунгом компании. Спустя какое-то время таким механизмом стали оснащать свою продукцию и другие известные часовые марки.</p>', '', '', ''),
(287, 'ru', 'Casio', '<p>Casio &mdash; японский производитель электронных устройств. Корпорация основана в апреле 1946 года в Токио. Наиболее известна как производитель калькуляторов, аудио оборудования, КПК, фотокамер, музыкальных инструментов, планшетов и наручных часов. В 1957 году фирма Casio выпустила первый в мире полностью электронный калькулятор.</p>', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_callbacks`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп даних таблиці `shop_callbacks`
--

INSERT INTO `shop_callbacks` (`id`, `user_id`, `status_id`, `theme_id`, `phone`, `name`, `comment`, `date`) VALUES
(5, NULL, 1, '1', '0972384758', 'test', 'sghdghnjhm', 1405515843);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_callbacks_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп даних таблиці `shop_callbacks_statuses`
--

INSERT INTO `shop_callbacks_statuses` (`id`, `is_default`) VALUES
(1, 1),
(3, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_callbacks_statuses_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_callbacks_statuses_i18n_I_1` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_callbacks_statuses_i18n`
--

INSERT INTO `shop_callbacks_statuses_i18n` (`id`, `locale`, `text`) VALUES
(1, 'ru', 'Новый'),
(3, 'ru', 'Обработан');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_callbacks_themes`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп даних таблиці `shop_callbacks_themes`
--

INSERT INTO `shop_callbacks_themes` (`id`, `position`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_callbacks_themes_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_themes_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_callbacks_themes_i18n_I_1` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_callbacks_themes_i18n`
--

INSERT INTO `shop_callbacks_themes_i18n` (`id`, `locale`, `text`) VALUES
(1, 'ru', 'Консультация'),
(1, 'ua', 'Перша тема');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_category`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3016 ;

--
-- Дамп даних таблиці `shop_category`
--

INSERT INTO `shop_category` (`id`, `url`, `parent_id`, `position`, `full_path`, `full_path_ids`, `active`, `external_id`, `image`, `tpl`, `order_method`, `showsitetitle`, `created`, `updated`) VALUES
(1, 'aksessuary', 0, 21, 'aksessuary', 'a:0:{}', 1, NULL, '/uploads/shop/categories/Aktivniy otdih/Logoaktivniy turizm.jpg', '', 0, 0, 1401265119, 1407221708),
(3, 'detskie-chasy', 0, 19, 'detskie-chasy', 'a:0:{}', 1, NULL, '/uploads/shop/categories/15687_main_origin.jpg', '', 0, 0, 1401265119, 1407221719),
(7, 'domashnie-chasy', 0, 22, 'domashnie-chasy', 'a:0:{}', 1, NULL, '/uploads/shop/categories/music/clasic gitar.jpeg', '', 0, 0, 1401265119, 1407221698),
(8, 'telefoniia-pleery-gps', 0, 1, 'telefoniia-pleery-gps', 'a:0:{}', 1, NULL, '/uploads/shop/categories/21.jpg', 'categorysubfirst', 0, 0, 1401265119, 1406796689),
(9, 'zhenskie-chasy', 0, 18, 'zhenskie-chasy', 'a:0:{}', 1, NULL, '/uploads/shop/categories/7f43598622805660e8ab4f6c12514588.jpg', '', 0, 0, 1401265119, 1407222353),
(927, 'naruchnye-chasy', 8, 2, 'telefoniia-pleery-gps/naruchnye-chasy', 'a:1:{i:0;i:8;}', 1, NULL, '/uploads/images.jpg', 'categorysubsecond', 0, 0, 1401265119, 1407167742),
(930, 'klassicheskie-chasy', 927, 3, 'telefoniia-pleery-gps/naruchnye-chasy/klassicheskie-chasy', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/images (1).jpg', '', 0, 0, 1401265119, 1407168192),
(931, 'sportivnye-chasy', 927, 4, 'telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/record_107909154.jpg', '', 0, 0, 1401265119, 1407168165),
(2583, 'dizainerskie-chasy', 927, 5, 'telefoniia-pleery-gps/naruchnye-chasy/dizainerskie-chasy', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/Rado.jpg', '', 0, 0, 1401265119, 1407168138),
(3013, 'karmannye-chasy', 8, 8, 'telefoniia-pleery-gps/karmannye-chasy', 'a:1:{i:0;i:8;}', 1, NULL, '/uploads/Karmannye-chasy.jpg', '', 0, 0, 1401265119, 1407221661),
(3015, 'iuvelirnye-chasy', 927, 23, 'telefoniia-pleery-gps/naruchnye-chasy/iuvelirnye-chasy', 'a:2:{i:0;i:8;i:1;i:927;}', 1, NULL, '/uploads/zhenskie-chasy-1.jpg', '', 0, 0, 1407154860, 1407168100);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_category_i18n`
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
-- Дамп даних таблиці `shop_category_i18n`
--

INSERT INTO `shop_category_i18n` (`id`, `locale`, `name`, `h1`, `description`, `meta_desc`, `meta_title`, `meta_keywords`) VALUES
(1, 'ru', 'Аксессуары', '', '', '', '', ''),
(3, 'ru', 'Детские часы', '', '', '', '', ''),
(7, 'ru', 'Домашние часы', '', '', '', '', ''),
(8, 'ru', 'Мужские часы', '', '', '', '', ''),
(9, 'ru', 'Женские часы', '', '', '', '', ''),
(927, 'ru', 'Наручные часы', '', '', '', '', ''),
(930, 'ru', 'Классические часы', '', '', '', '', ''),
(931, 'ru', 'Спортивные часы', '', '', '', '', ''),
(2583, 'ru', 'Дизайнерские часы', '', '', '', '', ''),
(3015, 'ru', 'Ювелирные часы', '', '', '', '', ''),
(3013, 'ru', 'Карманные часы', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_comulativ_discount`
--

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
-- Структура таблиці `shop_currencies`
--

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
-- Дамп даних таблиці `shop_currencies`
--

INSERT INTO `shop_currencies` (`id`, `name`, `main`, `is_default`, `code`, `symbol`, `rate`, `showOnSite`) VALUES
(1, 'Dollars', 1, 1, 'USD', '$', 0.0310, 0),
(2, 'Рубль', 0, 0, 'RUR', 'руб', 1.0000, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_delivery_methods`
--

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
-- Дамп даних таблиці `shop_delivery_methods`
--

INSERT INTO `shop_delivery_methods` (`id`, `price`, `free_from`, `enabled`, `is_price_in_percent`, `position`, `delivery_sum_specified`) VALUES
(5, 80.00000, 5000.00000, 1, 0, NULL, 0),
(6, 0.00000, 0.00000, 1, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_delivery_methods_i18n`
--

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
-- Дамп даних таблиці `shop_delivery_methods_i18n`
--

INSERT INTO `shop_delivery_methods_i18n` (`id`, `locale`, `name`, `description`, `pricedescription`, `delivery_sum_specified_message`) VALUES
(5, 'ru', 'Адресная доставка курьером', '<p>Сроки доставки: 1-2 дня</p>', '', ''),
(6, 'ru', 'Доставка экспресс службой', '<p>Сроки доставки 2-3 дня</p>', '', 'согласно тарифам перевозчиков');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_delivery_methods_systems`
--

CREATE TABLE IF NOT EXISTS `shop_delivery_methods_systems` (
  `delivery_method_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  PRIMARY KEY (`delivery_method_id`,`payment_method_id`),
  KEY `shop_delivery_methods_systems_FI_2` (`payment_method_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_delivery_methods_systems`
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
-- Структура таблиці `shop_discounts`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Структура таблиці `shop_gifts`
--

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
-- Дамп даних таблиці `shop_gifts`
--

INSERT INTO `shop_gifts` (`id`, `key`, `active`, `price`, `created`, `espdate`) VALUES
(1, 'WTWWwPHJ4Al91jnZ', NULL, 100, 1354039607, 1354219200),
(2, '7WMAohSSCA3OViRL', NULL, 4, 1354039810, 1353700800),
(3, 'psnqw6IFxamCOCVmsd', NULL, 35, 1354039839, 1352404800);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_kit`
--

CREATE TABLE IF NOT EXISTS `shop_kit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` smallint(6) NOT NULL,
  `only_for_logged` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shop_kit_FI_1` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп даних таблиці `shop_kit`
--

INSERT INTO `shop_kit` (`id`, `product_id`, `active`, `position`, `only_for_logged`) VALUES
(19, 17344, 1, 1, 0),
(18, 17344, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_kit_product`
--

CREATE TABLE IF NOT EXISTS `shop_kit_product` (
  `product_id` int(11) NOT NULL,
  `kit_id` int(11) NOT NULL,
  `discount` varchar(11) DEFAULT '0',
  PRIMARY KEY (`product_id`,`kit_id`),
  KEY `shop_kit_product_FI_2` (`kit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_kit_product`
--

INSERT INTO `shop_kit_product` (`product_id`, `kit_id`, `discount`) VALUES
(17334, 19, '0'),
(17328, 19, '0'),
(17349, 18, '1'),
(17339, 18, '1');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_notifications`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Структура таблиці `shop_notification_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_notification_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_notification_statuses_I_2` (`position`),
  KEY `shop_notification_statuses_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп даних таблиці `shop_notification_statuses`
--

INSERT INTO `shop_notification_statuses` (`id`, `position`) VALUES
(1, 1),
(2, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_notification_statuses_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_notification_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_notification_statuses_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_notification_statuses_i18n`
--

INSERT INTO `shop_notification_statuses_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Новый'),
(2, 'ru', 'Выполнен');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_orders`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Дамп даних таблиці `shop_orders`
--

INSERT INTO `shop_orders` (`id`, `key`, `delivery_method`, `delivery_price`, `status`, `paid`, `user_full_name`, `user_email`, `user_phone`, `user_deliver_to`, `user_comment`, `date_created`, `date_updated`, `user_ip`, `user_id`, `payment_method`, `total_price`, `external_id`, `gift_cert_key`, `gift_cert_price`, `discount`, `discount_info`, `origin_price`, `user_surname`, `comulativ`) VALUES
(52, 'c0i1w64340', 6, NULL, 1, NULL, 'Administrator', 'ad@min.com', '+33 (333) 333-33-33', '', '', 1404723699, 1404723699, '127.0.0.1', 1, 2, 665086.00, NULL, NULL, NULL, 90694.00, 'user', 755780.00, NULL, NULL),
(53, 'x61109e56k', NULL, NULL, 1, NULL, 'Administrator', 'ad@min.com', '+46 (456) 546-54-65', '', '', 1404731886, 1404731886, '127.0.0.1', 1, 0, 79342.00, NULL, NULL, NULL, 10819.00, 'user', 90161.00, NULL, NULL),
(54, 'u688p1f586', NULL, 0.00, 1, 1, 'Administrator', 'ad@min.com', '+46 (546) 464-65-46', '', '', 1404806273, 1404806273, '127.0.0.1', 1, 0, 31532.00, NULL, NULL, NULL, 5565.00, 'user', 37097.00, '', NULL),
(55, '999dj8y101', 5, NULL, 1, NULL, 'Test', 'test@gmai.com', '+38 (097) 238-47-58', 'test test 14', '', 1405514465, 1405514465, '188.191.47.82', 52, 1, 13551.00, NULL, NULL, NULL, 1500.00, 'product', 15051.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_orders_products`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Дамп даних таблиці `shop_orders_products`
--

INSERT INTO `shop_orders_products` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `price`, `origin_price`, `quantity`, `kit_id`, `is_main`) VALUES
(82, 52, 1104, 1221, 'Мобильный телефон Sony Xperia V LT25i Black ', '', 4999.00, 4999.00, 1, NULL, NULL),
(83, 52, 1111, 1228, 'Зарядное устройство Nokia AC-4E', '', 1258.00, 1258.00, 1, NULL, NULL),
(84, 52, 1104, 1221, 'Мобильный телефон Sony Xperia V LT25i Black ', '', 4999.00, 4999.00, 1, 14, 1),
(85, 52, 6193, 6513, 'Аккумулятор Samsung EB-K1A2EWEGSTD White', 'Аккумулятор Samsung EB-K1A2EWEGSTD White', 96.00, 100.00, 1, 14, 0),
(86, 52, 14196, 14794, ' Гарнитура Jabra EASY CALL', '', 35.00, 36.85, 1, 14, 0),
(87, 52, 1006, 1099, '    MP3 / MP4-плеер Apple iPod touch 5G 32GB black', 'M', 90097.00, 90097.00, 1, NULL, NULL),
(88, 52, 1108, 1225, 'Nokia Lumia 920 White', '', 175645.00, 175645.00, 2, NULL, NULL),
(89, 52, 1117, 1234, 'Гарнитура Samsung BHS6000 EBECSEK', '', 29000.00, 29000.00, 2, NULL, NULL),
(90, 52, 1099, 1216, 'Мобильный телефон Sony Xperia Z C6603 Black', '', 245000.00, 245000.00, 1, NULL, NULL),
(91, 53, 1006, 1092, '    MP3 / MP4-плеер Apple iPod touch 5G 32GB black', 'SS', 90161.00, 90161.00, 1, NULL, NULL),
(92, 54, 1015, 1103, 'MP3 / MP4-плеер Apple iPod touch 4 Gen 8 GB', '', 37097.00, 37097.00, 1, NULL, NULL),
(93, 55, 1104, 1221, 'Мобильный телефон Sony Xperia V LT25i Black ', 'S', 4499.00, 4999.00, 3, NULL, NULL),
(94, 55, 13902, 14500, 'Карта памяти GOODRAM microSDHC 32 GB Class 4 (+ адаптер)', 'Карта памяти GOODRAM microSDHC 32 GB Class 4 (+ адаптер)', 25.00, 25.00, 1, NULL, NULL),
(95, 55, 13899, 14497, 'Карта памяти GOODRAM microSDHC 32 GB Class 10 (+ адаптер Retail 10)', 'Карта памяти GOODRAM microSDHC 32 GB Class 10 (+ адаптер Retail 10)', 29.00, 29.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_orders_status_history`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп даних таблиці `shop_orders_status_history`
--

INSERT INTO `shop_orders_status_history` (`id`, `order_id`, `status_id`, `user_id`, `date_created`, `comment`) VALUES
(24, 52, 1, 1, 1404723700, ''),
(25, 53, 1, 1, 1404731886, ''),
(26, 54, 1, 1, 1404806274, ''),
(27, 55, 1, 52, 1405514465, '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_order_statuses`
--

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
-- Дамп даних таблиці `shop_order_statuses`
--

INSERT INTO `shop_order_statuses` (`id`, `position`, `color`, `fontcolor`) VALUES
(1, 0, '#8b8f8b', '#ffffff'),
(2, 3, '#348c30', '#ffffff');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_order_statuses_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_order_statuses_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_order_statuses_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_order_statuses_i18n`
--

INSERT INTO `shop_order_statuses_i18n` (`id`, `locale`, `name`) VALUES
(1, 'ru', 'Новый'),
(2, 'ru', 'Доставлен');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_payment_methods`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп даних таблиці `shop_payment_methods`
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
-- Структура таблиці `shop_payment_methods_i18n`
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
-- Дамп даних таблиці `shop_payment_methods_i18n`
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
-- Структура таблиці `shop_products`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17414 ;

--
-- Дамп даних таблиці `shop_products`
--

INSERT INTO `shop_products` (`id`, `url`, `active`, `hit`, `brand_id`, `category_id`, `related_products`, `created`, `updated`, `old_price`, `views`, `hot`, `action`, `added_to_cart_count`, `enable_comments`, `external_id`, `tpl`, `user_id`) VALUES
(17413, '17413', 1, 0, 295, 7, NULL, 1407156256, 1407222432, 0.00, 2, NULL, NULL, 0, 0, NULL, '', NULL),
(17406, '17406', 1, 0, 287, 1, NULL, 1407156256, 1407222256, 0.00, 0, NULL, 0, 0, 0, NULL, '', NULL),
(17396, '17396', 1, NULL, 294, 3, NULL, 1407156256, 1407222129, 0.00, 0, 0, NULL, 0, 0, NULL, '', NULL),
(17390, '17390', 1, NULL, 294, 9, NULL, 1407156256, 1407221934, 0.00, 0, 0, NULL, 0, 0, NULL, '', NULL),
(17380, '17380', 1, NULL, 286, 3015, NULL, 1407156256, 1407221308, 0.00, 2, NULL, 0, 0, 0, NULL, '', NULL),
(17384, '17384', 1, NULL, 294, 3013, NULL, 1407156256, 1407221631, 0.00, 1, 0, NULL, 0, 0, NULL, '', NULL),
(17359, '17359', 1, 1, 291, 931, NULL, 1407156995, 1407490742, 0.00, 8, NULL, NULL, 0, 0, NULL, '', NULL),
(17355, '17355', 1, 0, 287, 931, NULL, 1407156256, 1407164273, 0.00, 1, 1, 0, 0, 0, NULL, '', NULL),
(17354, '17354', 1, 1, 287, 931, NULL, 1407156256, 1407164231, 0.00, 0, 0, 0, 0, 0, NULL, '', NULL),
(17372, '17372', 1, 0, 288, 2583, NULL, 1407156256, 1407221097, 0.00, 1, NULL, NULL, 0, 0, NULL, '', NULL),
(17353, '17353', 1, 1, 287, 931, NULL, 1407156995, 1407490841, 0.00, 5, 0, NULL, 0, 0, NULL, '', NULL),
(17352, '17352', 1, NULL, 295, 931, NULL, 1407156256, 1407164179, 0.00, 1, 1, 0, 0, 0, NULL, '', NULL),
(17349, '17349', 1, 1, 295, 930, NULL, 1407156256, 1407157730, 0.00, 2, NULL, NULL, 0, 0, NULL, '', NULL),
(17348, 'muzhskie-chasy-sekonda-etm65007', 1, NULL, 295, 930, NULL, 1407156995, 1407157997, 0.00, 6, 1, NULL, 0, 0, NULL, '', NULL),
(17347, 'muzhskie-chasy-sekonda-gt83723782', 1, NULL, 295, 930, NULL, 1407156256, 1407158165, 0.00, 5, NULL, 1, 0, 0, NULL, '', NULL),
(17346, 'muzhskie-chasy-casio-er65007b9', 1, 1, 287, 930, NULL, 1407156995, 1407490918, 0.00, 5, NULL, NULL, 0, 0, NULL, '', NULL),
(17345, '17345', 1, NULL, 287, 930, NULL, 1407156256, 1407158930, 0.00, 4, NULL, 1, 0, 0, NULL, '', NULL),
(17343, '17343', 1, 1, 287, 930, NULL, 1407156256, 1407160045, 0.00, 2, NULL, 0, 0, 0, NULL, '', NULL),
(17344, 'muzhskie-chasy-emporio-armani-fem650071223', 1, 1, 290, 930, NULL, 1462020995, 1407510073, 250000.00, 17, 0, NULL, 0, 1, NULL, '', NULL),
(17342, '17342', 1, 1, 292, 930, NULL, 1407156995, 1407491004, 0.00, 5, 0, NULL, 0, 0, NULL, '', NULL),
(17341, '17341', 1, NULL, 293, 930, NULL, 1407156256, 1407161087, 0.00, 1, NULL, 1, 0, 0, NULL, '', NULL),
(17340, '17340', 1, 1, 290, 930, NULL, 1407156995, 1407491083, 0.00, 5, NULL, NULL, 0, 0, NULL, '', NULL),
(17339, '17339', 1, 1, 294, 930, NULL, 1407156256, 1407161354, 0.00, 1, NULL, NULL, 0, 0, NULL, '', NULL),
(17338, '17338', 1, NULL, 289, 930, NULL, 1407156995, 1407161469, 0.00, 13, NULL, 1, 0, 0, NULL, '', NULL),
(17336, '17336', 1, NULL, 290, 930, NULL, 1407156995, 1407161676, 0.00, 11, 1, NULL, 0, 0, NULL, '', NULL),
(17335, '17335', 1, 1, 291, 930, NULL, 1407156995, 1407161849, 0.00, 1, NULL, NULL, 0, 0, NULL, '', NULL),
(17334, '17334', 1, 1, 293, 930, NULL, 1407156256, 1407162022, 0.00, 1, NULL, NULL, 0, 0, NULL, '', NULL),
(17333, '17333', 1, NULL, 290, 930, NULL, 1407156995, 1407162139, 0.00, 3, 1, NULL, 0, 0, NULL, '', NULL),
(17332, '17332', 1, NULL, 292, 930, NULL, 1407156256, 1407162734, 0.00, 5, NULL, 1, 0, 0, NULL, '', NULL),
(17330, '17330', 1, NULL, 286, 930, NULL, 1407156256, 1407162963, 0.00, 6, NULL, 1, 0, 0, NULL, '', NULL),
(17328, 'muzhskie-chasy-rotary-swiss-army', 1, NULL, 294, 930, NULL, 1407156256, 1407156908, 0.00, 2, 1, NULL, 0, 0, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_products_i18n`
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
-- Дамп даних таблиці `shop_products_i18n`
--

INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(17347, 'ru', 'Мужские часы Sekonda GT83723782', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17348, 'ru', 'Мужские часы SEKONDA ETM65007', '<p><span>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м.</span></p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>', '', '', ''),
(17349, 'ru', 'Мужские часы Sekonda RD839054', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17352, 'ru', 'Мужские спортивние часы Sekonda GT837237123', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17353, 'ru', 'Мужские спортивние часы Casio ER65007B234', ' ', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>  ', '', '', ''),
(17354, 'ru', 'Мужские спортивние часы Casio Swiss ', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17355, 'ru', 'Мужские спортивние  часы Casio ER5739123', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17359, 'ru', 'Мужские спортивние часы Citizen GT89489923', '', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>', '', '', ''),
(17372, 'ru', 'Мужские дизайнерские часы G-shock RD83905411', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17380, 'ru', 'Мужские ювелирные  часы ACCURIST ЕК-129592', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17384, 'ru', 'Мужские карманные часы Rotary Swiss Army', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17390, 'ru', 'Женские часы Rotary Swiss Army', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17396, 'ru', 'Детские часы Rotary Swiss Army', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17406, 'ru', 'Аксесуары Casio Swiss', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17413, 'ru', 'Домашние часы Sekonda RD8390512', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17345, 'ru', 'Мужские часы Casio Swiss Army', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17346, 'ru', 'Мужские часы Casio ER65007B9', ' ', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>  ', '', '', ''),
(17342, 'ru', 'Мужские часы Fossil FEM6500343', ' ', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>  ', '', '', ''),
(17343, 'ru', 'Мужские часы Casio ER57393', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17344, 'ru', 'Мужские часы Emporio Armani FEM650071223', ' ', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>  ', '', '', ''),
(17340, 'ru', 'Мужские часы Emporio Armani FEM6500111', ' ', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>  ', '', '', ''),
(17341, 'ru', 'Мужские часы Ice Watch HR47292', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17336, 'ru', 'Мужские часы Emporio Armani HT378395', '<p><span>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м.</span></p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>', '', '', ''),
(17338, 'ru', 'Мужские часы Seiko ET392912', '<p><span>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м.</span></p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>', '', '', ''),
(17339, 'ru', 'Мужские часы Rotary UPA3720-1', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17335, 'ru', 'Мужские часы Citizen РН839093-1', '<p><span>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м.</span></p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>', '', '', ''),
(17333, 'ru', 'Мужские часы Emporio Armani FEM6502234', '<p><span>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м.</span></p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота), стекло с антибликовым покрытием, задняя крышка с винтовым фиксатором, застежка "бабочка". Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</p>', '', '', ''),
(17334, 'ru', 'Мужские часы Ice Watch YT-46392', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17332, 'ru', 'Мужские часы Seiko New Citizen', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17328, 'ru', 'Мужские часы Rotary Swiss Army', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', ''),
(17330, 'ru', 'Мужские часы ACCURIST ЕК-1295923', '<p>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.&nbsp;</p>', '<p>Корпус и браслет с частичным покрытием PVD gold (нитрид титана + позолота),cтекло с антибликовым покрытием, задняя крышка с винтовым фиксатором Застежка "бабочка".&nbsp;Центральная секундная стрелка: стрелки с люминесцентным покрытием, позолоченные стрелки и цифры.&nbsp;<span>Тип механизма: кварцевый. Водонепроницаемость: 100 м. Формат времени: 12 ч. Материал ремешка/браслета: нержавеющая сталь. Материал корпуса: нержавеющая сталь. Стекло: сапфировое. Габариты корпуса: 42х42х10 мм. Фабрика сборки: Швейцария.</span></p>', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_products_rating`
--

CREATE TABLE IF NOT EXISTS `shop_products_rating` (
  `product_id` int(11) NOT NULL,
  `votes` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_products_rating`
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
-- Структура таблиці `shop_product_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `shop_product_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_product_categories`
--

INSERT INTO `shop_product_categories` (`product_id`, `category_id`) VALUES
(17328, 930),
(17330, 930),
(17332, 930),
(17333, 930),
(17334, 930),
(17335, 930),
(17336, 930),
(17338, 930),
(17339, 930),
(17340, 930),
(17341, 930),
(17342, 930),
(17343, 930),
(17344, 930),
(17345, 930),
(17346, 930),
(17347, 930),
(17348, 930),
(17349, 930),
(17352, 931),
(17353, 931),
(17354, 931),
(17355, 931),
(17359, 931),
(17372, 2583),
(17380, 3015),
(17384, 3013),
(17390, 9),
(17396, 3),
(17406, 1),
(17413, 7);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_images`
--

CREATE TABLE IF NOT EXISTS `shop_product_images` (
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `position` smallint(6) DEFAULT NULL,
  KEY `shop_product_images_I_1` (`position`),
  KEY `shop_product_images_FK_1` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_product_images`
--

INSERT INTO `shop_product_images` (`product_id`, `image_name`, `position`) VALUES
(17413, '17413_0.jpg', 0),
(17413, '17413_1.jpg', 1),
(17352, '17352_0.jpg', 0),
(17352, '17352_1.jpg', 1),
(17346, '99a15c83206ea9646420c3f0d9db3277.jpg', 1),
(17346, '0ea68839d7e8b26fbc52a0eeecaee352.jpg', 0),
(17349, '61da9d22d23ef853c67c8de9e5e04df1.jpg', 0),
(17349, 'ae26532769174fca100b940214e7bf64.jpg', 1),
(17348, 'd41372e3ee6b518c564350486addf693.jpg', 0),
(17348, '29deb539ea413076861ae21ebae72c39.jpg', 1),
(17347, '3a28c7cb13f00adb3c44dd40907e14b1.jpg', 0),
(17347, '95069dcc604ea7976e1270bc29ab21e9.jpg', 1),
(17344, '41dae39ba1761b71989ecd72f3933520.jpg', 3),
(17344, '854dd9250f73469b3ff72a94ba48fddf.jpg', 2),
(17344, '555ecbd4c9d8686f10ad4f136f569edb.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_properties`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=374 ;

--
-- Дамп даних таблиці `shop_product_properties`
--

INSERT INTO `shop_product_properties` (`id`, `csv_name`, `active`, `show_in_compare`, `position`, `show_on_site`, `multiple`, `external_id`, `show_in_filter`, `main_property`, `show_faq`) VALUES
(372, 'color', 1, 1, 0, 1, NULL, NULL, 1, 1, 1),
(373, 'material', 1, 1, 0, 1, NULL, NULL, 1, 1, 1),
(371, 'Waterresistance', 1, 1, 0, 1, NULL, NULL, 1, 1, 1),
(369, 'typeofdisplay', 1, 1, 0, 1, NULL, NULL, 1, 1, 1),
(370, 'lights', 1, 1, 0, 1, NULL, NULL, 1, 1, 1),
(368, 'mechanism', 1, 1, 0, 1, 0, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_properties_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties_categories` (
  `property_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`category_id`),
  KEY `shop_product_properties_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_product_properties_categories`
--

INSERT INTO `shop_product_properties_categories` (`property_id`, `category_id`) VALUES
(368, 930),
(368, 931),
(368, 2583),
(369, 930),
(369, 931),
(369, 2583),
(369, 3013),
(369, 3015),
(370, 9),
(370, 930),
(370, 931),
(370, 2583),
(370, 3013),
(370, 3015),
(371, 9),
(371, 930),
(371, 931),
(371, 2583),
(371, 3013),
(371, 3015),
(372, 1),
(372, 3),
(372, 7),
(372, 9),
(372, 930),
(372, 931),
(372, 2583),
(372, 3013),
(372, 3015),
(373, 9),
(373, 930),
(373, 931),
(373, 2583),
(373, 3013),
(373, 3015);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_properties_data`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87360 ;

--
-- Дамп даних таблиці `shop_product_properties_data`
--

INSERT INTO `shop_product_properties_data` (`id`, `property_id`, `product_id`, `value`, `locale`) VALUES
(87063, 369, 17341, 'дата, 24 часовой счетчик', 'ru'),
(87332, 372, 17359, 'серебро', 'ru'),
(87333, 371, 17359, '55 м', 'ru'),
(87059, 373, 17341, 'натуральная кожа', 'ru'),
(87060, 372, 17341, 'металлический', 'ru'),
(87061, 371, 17341, 'нет', 'ru'),
(87062, 370, 17341, 'нет', 'ru'),
(87334, 370, 17359, 'нет', 'ru'),
(87338, 372, 17353, 'позолота', 'ru'),
(87346, 370, 17346, 'есть', 'ru'),
(87348, 372, 17342, 'позолота', 'ru'),
(87347, 368, 17346, 'кварцевый', 'ru'),
(87029, 373, 17345, 'нержавеющая сталь', 'ru'),
(87030, 372, 17345, 'металлический', 'ru'),
(87031, 371, 17345, 'нет', 'ru'),
(87032, 370, 17345, 'есть', 'ru'),
(87033, 369, 17345, 'минуты, секунды, часы', 'ru'),
(87034, 368, 17345, 'кварцевый', 'ru'),
(87035, 373, 17343, 'нержавеющая сталь', 'ru'),
(87036, 372, 17343, 'позолота', 'ru'),
(87037, 371, 17343, 'нет', 'ru'),
(87038, 370, 17343, 'есть', 'ru'),
(87039, 369, 17343, 'дата, 24 часовой счетчик', 'ru'),
(87345, 371, 17346, '100 м', 'ru'),
(87040, 368, 17343, 'механический с автоподзаводом', 'ru'),
(87004, 368, 17347, 'кварцевый', 'ru'),
(87350, 368, 17342, 'механика', 'ru'),
(87002, 370, 17347, 'нет', 'ru'),
(87003, 369, 17347, 'минуты, секунды, часы', 'ru'),
(86980, 368, 17349, 'кварцевый', 'ru'),
(86987, 373, 17348, 'натуральная кожа', 'ru'),
(86978, 370, 17349, 'нет', 'ru'),
(86979, 369, 17349, 'минуты, секунды, часы', 'ru'),
(86988, 372, 17348, 'нержавеющая сталь', 'ru'),
(87001, 371, 17347, 'нет', 'ru'),
(86977, 371, 17349, 'нет', 'ru'),
(86976, 372, 17349, 'серебристый', 'ru'),
(86989, 371, 17348, '50 м', 'ru'),
(86990, 370, 17348, 'нет', 'ru'),
(86975, 373, 17349, 'нержавеющая сталь', 'ru'),
(86991, 369, 17348, 'минуты, часы', 'ru'),
(86992, 368, 17348, 'механический с автоподзаводом', 'ru'),
(86999, 373, 17347, 'нержавеющая сталь', 'ru'),
(87000, 372, 17347, 'нержавеющая сталь', 'ru'),
(87349, 371, 17342, '95 м', 'ru'),
(87339, 371, 17353, '25 м', 'ru'),
(87357, 372, 17344, 'позолота', 'ru'),
(87358, 371, 17344, '50 м', 'ru'),
(87359, 370, 17344, 'нет', 'ru'),
(87064, 368, 17341, 'механический с автоподзаводом', 'ru'),
(87354, 372, 17340, 'позолота', 'ru'),
(87355, 370, 17340, 'есть', 'ru'),
(87356, 368, 17340, 'кварцевый', 'ru'),
(87071, 373, 17339, 'натуральная кожа', 'ru'),
(87072, 372, 17339, 'нержавеющая сталь', 'ru'),
(87073, 371, 17339, '50 м', 'ru'),
(87074, 370, 17339, 'есть', 'ru'),
(87075, 369, 17339, 'дата, 24 часовой счетчик', 'ru'),
(87076, 368, 17339, 'кварцевый', 'ru'),
(87077, 373, 17336, 'натуральная кожа', 'ru'),
(87078, 372, 17336, 'нитрид титана', 'ru'),
(87079, 371, 17336, '65 м', 'ru'),
(87080, 370, 17336, 'нет', 'ru'),
(87081, 369, 17336, 'дата, 24 часовой счетчик', 'ru'),
(87082, 368, 17336, 'механический с автоподзаводом', 'ru'),
(87083, 373, 17335, 'натуральная кожа', 'ru'),
(87084, 372, 17335, 'серебристый', 'ru'),
(87085, 371, 17335, '100 м', 'ru'),
(87086, 370, 17335, 'дата, 24 часовой счетчик', 'ru'),
(87087, 369, 17335, 'минуты, секунды, часы', 'ru'),
(87088, 368, 17335, 'кварцевый', 'ru'),
(87089, 373, 17334, 'нержавеющая сталь', 'ru'),
(87090, 372, 17334, 'нержавеющая сталь', 'ru'),
(87091, 371, 17334, '65 м', 'ru'),
(87092, 370, 17334, 'нет', 'ru'),
(87093, 369, 17334, 'минуты, секунды, часы', 'ru'),
(87094, 368, 17334, 'кварцевый', 'ru'),
(87101, 373, 17333, 'натуральная кожа', 'ru'),
(87102, 372, 17333, 'серебристый', 'ru'),
(87103, 371, 17333, 'нет', 'ru'),
(87104, 370, 17333, 'нет', 'ru'),
(87105, 369, 17333, 'минуты, секунды, часы', 'ru'),
(87106, 368, 17333, 'механический с автоподзаводом', 'ru'),
(87107, 373, 17332, 'натуральная кожа', 'ru'),
(87108, 372, 17332, 'позолота', 'ru'),
(87109, 371, 17332, 'нет', 'ru'),
(87110, 370, 17332, 'нет', 'ru'),
(87111, 369, 17332, 'минуты, секунды, часы', 'ru'),
(87112, 368, 17332, 'механический с автоподзаводом', 'ru'),
(87119, 373, 17330, 'нержавеющая сталь', 'ru'),
(87120, 372, 17330, 'нержавеющая сталь', 'ru'),
(87121, 371, 17330, 'нет', 'ru'),
(87122, 370, 17330, 'да', 'ru'),
(87123, 369, 17330, 'минуты, секунды, часы', 'ru'),
(87124, 368, 17330, 'механический с автоподзаводом', 'ru'),
(87340, 370, 17353, 'есть', 'ru');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_properties_data_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties_data_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_properties_data_i18n_I_1` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_properties_i18n`
--

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
-- Дамп даних таблиці `shop_product_properties_i18n`
--

INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`, `data`, `description`) VALUES
(368, 'Механизм', 'ru', '', ''),
(369, 'Тип индикации', 'ru', '', ''),
(370, 'Подсветка', 'ru', '', ''),
(371, 'Водостойкость', 'ru', '', ''),
(372, 'Цвет корпуса', 'ru', '', ''),
(373, 'Материал браслета/ремешка', 'ru', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_variants`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18235 ;

--
-- Дамп даних таблиці `shop_product_variants`
--

INSERT INTO `shop_product_variants` (`id`, `product_id`, `price`, `number`, `stock`, `position`, `mainImage`, `external_id`, `currency`, `price_in_main`) VALUES
(18164, 17347, 176000.00000, 'GT83723782', 1, NULL, 'a59636afbeac7a29f80022067a3d7c9d.jpg', NULL, 2, 176000.00000),
(18165, 17348, 200000.00000, 'ETM65007', 1, NULL, '59dbcaa9895ae8bc332f34cd0f11240a.jpg', NULL, 2, 200000.00000),
(18166, 17349, 170000.00000, 'RD839054', 1, NULL, 'c1185613505d4b221a2bf1d3de505bf9.jpg', NULL, 2, 170000.00000),
(18167, 17342, 200000.00000, 'FEM6500341', 1, 1, NULL, NULL, 2, 200000.00000),
(18168, 17342, 180000.00000, 'FEM6500340', 1, 2, NULL, NULL, 2, 180000.00000),
(18193, 17372, 142000.00000, 'RD839054', 1, NULL, 'c05e4fd72ba0b43477ef92b93fbecfa4.jpg', NULL, 2, 142000.00000),
(18180, 17359, 190000.00000, 'GT89489923', 1, NULL, '113e3fd3807b52da59b90dbdb36714e7.jpg', NULL, 2, 190000.00000),
(18234, 17413, 170000.00000, 'RD839054', 1, NULL, 'c_c1185613505d4b221a2bf1d3de505bf9.jpg', NULL, 2, 170000.00000),
(18227, 17406, 150000.00000, 'VS 8498092', 1, NULL, 'c_9efcd8354ed7e3631d2807ff6fef3994.jpg', NULL, 2, 150000.00000),
(18217, 17396, 150000.00000, 'VS 8498092', 1, NULL, 'b10997bd4d51c7542e7329ad4cd872e3.jpg', NULL, 2, 150000.00000),
(18211, 17390, 150000.00000, 'VS 8498092', 1, NULL, 'c_88ee26bd618220220a658676ac41c9b8.jpg', NULL, 2, 150000.00000),
(18205, 17384, 150000.00000, 'VS 8498092', 1, NULL, '88ee26bd618220220a658676ac41c9b8.jpg', NULL, 2, 150000.00000),
(18201, 17380, 168000.00000, 'ЕК-1295923', 1, NULL, 'c_fd69512ae05db8d2916553a577dc5a47.jpg', NULL, 2, 168000.00000),
(18163, 17346, 210000.00000, 'FEM65007B9', 1, NULL, '31fd34f72dc57b1e991e4f5be60f8b51.jpg', NULL, 2, 210000.00000),
(18162, 17345, 150000.00000, 'VS 8498092', 1, NULL, '3bcaecdab509a4fec45b283ba52a4a3d.jpg', NULL, 2, 150000.00000),
(18161, 17344, 225000.00000, 'FEM650071223', 1, NULL, 'c433452233a4c3983f1dfbabd3ae9a08.jpg', NULL, 2, 225000.00000),
(18160, 17343, 120000.00000, 'VS 8498092', 1, NULL, 'b8557c1075439323e8158dffbc108b45.jpg', NULL, 2, 120000.00000),
(18159, 17342, 210000.00000, 'FEM6500343', 1, NULL, '33a0ad5ce896d62aa4b916765d8c80fc.jpg', NULL, 2, 210000.00000),
(18158, 17341, 160000.00000, 'HR47292', 1, NULL, '6b480c33a6d21994fa1ee836a656e2ff.jpg', NULL, 2, 160000.00000),
(18157, 17340, 190000.00000, 'FEM65007B9', 1, NULL, '549eb51e36b50a07388db015aa44adf3.jpg', NULL, 2, 190000.00000),
(18156, 17339, 155000.00000, 'VS 8498092', 1, NULL, '3d17c0af801bcd72b01650c5d78a5cef.jpg', NULL, 2, 155000.00000),
(18155, 17338, 210000.00000, 'FEM65007B9', 1, NULL, '600a73ad03a28210f60e2e6ac9adae8c.jpg', NULL, 2, 210000.00000),
(18174, 17355, 120000.00000, 'VS 8498092', 1, NULL, 'b289029ffd3278a743af5f17f06a8cc4.jpg', NULL, 2, 120000.00000),
(18152, 17335, 210000.00000, 'РН839093-1', 1, NULL, '218ddc33d0eb015b9b9cafb30a8100ef.jpg', NULL, 2, 210000.00000),
(18153, 17336, 190000.00000, 'HT378395', 1, NULL, '71a2033b09540443ef5bce3c576658d3.jpg', NULL, 2, 190000.00000),
(18151, 17334, 240000.00000, 'YT-46392', 1, NULL, 'f18c87b41e3c890649b1143e2e7aa945.jpg', NULL, 2, 240000.00000),
(18150, 17333, 210000.00000, 'FEM65007B9', 1, NULL, '7dbd9660fa9016872e4e4cac62776ce9.jpg', NULL, 2, 210000.00000),
(18149, 17332, 156000.00000, 'VS 8498092', 1, NULL, 'b4cddac3b3e4e38c37fa9dbb57525aea.jpg', NULL, 2, 156000.00000),
(18145, 17328, 150000.00000, 'VS 8498092', 1, NULL, 'a99132c42376fded02af58e91bdea6fd.jpg', NULL, 2, 150000.00000),
(18147, 17330, 188000.00000, 'ЕК-1295923', 1, NULL, 'fd69512ae05db8d2916553a577dc5a47.jpg', NULL, 2, 188000.00000),
(18171, 17352, 176000.00000, 'GT83723782', 1, NULL, '253fa49a0add5b971cd00f573efb6f1c.jpg', NULL, 2, 176000.00000),
(18172, 17353, 210000.00000, 'FEM65007B9', 1, NULL, '06374b3be4eb504319948edfa0f0a019.jpg', NULL, 2, 210000.00000),
(18173, 17354, 150000.00000, 'VS 8498092', 1, NULL, '9efcd8354ed7e3631d2807ff6fef3994.jpg', NULL, 2, 150000.00000);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_variants_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_product_variants_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_product_variants_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_product_variants_i18n`
--

INSERT INTO `shop_product_variants_i18n` (`id`, `locale`, `name`) VALUES
(18211, 'ru', ''),
(18217, 'ru', ''),
(18227, 'ru', ''),
(18234, 'ru', ''),
(18205, 'ru', ''),
(18201, 'ru', ''),
(18180, 'ru', ''),
(18193, 'ru', ''),
(18174, 'ru', ''),
(18173, 'ru', ''),
(18168, 'ru', '29 см'),
(18171, 'ru', ''),
(18167, 'ru', '27 см'),
(18172, 'ru', ''),
(18166, 'ru', ''),
(18165, 'ru', ''),
(18145, 'ru', ''),
(18147, 'ru', ''),
(18149, 'ru', ''),
(18150, 'ru', ''),
(18151, 'ru', ''),
(18152, 'ru', ''),
(18153, 'ru', ''),
(18155, 'ru', ''),
(18156, 'ru', ''),
(18157, 'ru', ''),
(18158, 'ru', ''),
(18159, 'ru', '25 см'),
(18160, 'ru', ''),
(18161, 'ru', ''),
(18162, 'ru', ''),
(18163, 'ru', ''),
(18164, 'ru', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_rbac_group`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Дамп даних таблиці `shop_rbac_group`
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
-- Структура таблиці `shop_rbac_group_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_group_i18n` (
  `id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `locale` varchar(5) NOT NULL,
  KEY `id_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_rbac_group_i18n`
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
-- Структура таблиці `shop_rbac_privileges`
--

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
-- Дамп даних таблиці `shop_rbac_privileges`
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
-- Структура таблиці `shop_rbac_privileges_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_privileges_i18n` (
  `id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `locale` varchar(45) NOT NULL,
  KEY `id_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_rbac_privileges_i18n`
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
(367, 'Смена порядка альбомов', 'Доступ к смене порядка альбомов', 'ru');
INSERT INTO `shop_rbac_privileges_i18n` (`id`, `title`, `description`, `locale`) VALUES
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
(424, 'sample_module::__construct', '', 'ru'),
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
-- Структура таблиці `shop_rbac_roles`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `importance` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `shop_rbac_roles`
--

INSERT INTO `shop_rbac_roles` (`id`, `name`, `importance`, `description`) VALUES
(1, 'Administrator', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_rbac_roles_i18n`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_roles_i18n` (
  `id` int(11) NOT NULL,
  `alt_name` varchar(45) DEFAULT NULL,
  `locale` varchar(5) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  KEY `role_id_idx` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_rbac_roles_i18n`
--

INSERT INTO `shop_rbac_roles_i18n` (`id`, `alt_name`, `locale`, `description`) VALUES
(1, 'Администратор', 'ru', 'Доступны все елементы управления'),
(1, 'Администратор', 'ru', 'Доступны все елементы управления');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_rbac_roles_privileges`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_roles_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolepriv` (`role_id`,`privilege_id`),
  KEY `shop_rbac_roles_privileges_FK_2` (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=614 ;

--
-- Дамп даних таблиці `shop_rbac_roles_privileges`
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
-- Структура таблиці `shop_settings`
--

CREATE TABLE IF NOT EXISTS `shop_settings` (
  `name` varchar(255) NOT NULL,
  `value` text,
  `locale` varchar(5) NOT NULL,
  PRIMARY KEY (`name`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_settings`
--

INSERT INTO `shop_settings` (`name`, `value`, `locale`) VALUES
('mainImageWidth', '320', ''),
('mainImageHeight', '320', ''),
('smallImageWidth', '140', ''),
('smallImageHeight', '140', ''),
('addImageWidth', '800', ''),
('addImageHeight', '600', ''),
('imagesQuality', '99', ''),
('systemTemplatePath', './templates/inTime/shop/', ''),
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
('thumbImageHeight', '62', ''),
('watermark_delete_watermark_font_path', '0', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_sorting`
--

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
-- Дамп даних таблиці `shop_sorting`
--

INSERT INTO `shop_sorting` (`id`, `pos`, `get`, `active`, `name`, `name_front`, `tooltip`) VALUES
(1, 4, 'rating', 1, '', NULL, NULL),
(2, 1, 'price', 1, '', NULL, NULL),
(3, 2, 'price_desc', 1, '', NULL, NULL),
(4, 3, 'hit', 1, '', NULL, NULL),
(5, 5, 'hot', 1, '', NULL, NULL),
(6, 0, 'action', 1, '', NULL, NULL),
(7, 8, 'name', 0, '', NULL, NULL),
(8, 9, 'name_desc', 0, '', NULL, NULL),
(9, 6, 'views', 0, '', NULL, NULL),
(10, 7, 'topsales', 0, '', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

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
(7, 'ru', 'А-Я', 'По названию (А-Я)', ''),
(8, 'ru', 'Я-А', 'По названию (Я-А)', ''),
(9, 'ru', 'Просмотров', 'По количеству просмотров', ''),
(10, 'ru', 'Топ продаж', 'Топ продаж', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_spy`
--

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
-- Дамп даних таблиці `shop_spy`
--

INSERT INTO `shop_spy` (`id`, `user_id`, `product_id`, `price`, `variant_id`, `key`, `email`, `old_price`) VALUES
(3, 69, 102, 550, 113, 'IPrMlWydoeP9Cmex30upNOUsdTa4bIrg', NULL, 549);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_warehouse`
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
-- Дамп даних таблиці `shop_warehouse`
--

INSERT INTO `shop_warehouse` (`id`, `name`, `address`, `phone`, `description`) VALUES
(1, 'warehouse 1', 'address', 'phone', ''),
(2, 'warehouse 2', 'address 2', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_warehouse_data`
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
-- Дамп даних таблиці `shop_warehouse_data`
--

INSERT INTO `shop_warehouse_data` (`id`, `product_id`, `warehouse_id`, `count`) VALUES
(37, 132, 2, 3),
(36, 132, 1, 2),
(35, 132, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `template_settings`
--

CREATE TABLE IF NOT EXISTS `template_settings` (
  `id` int(11) NOT NULL,
  `component` varchar(255) NOT NULL,
  `key` text,
  `data` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `template_settings`
--

INSERT INTO `template_settings` (`id`, `component`, `key`, `data`) VALUES
(0, 'TColorScheme', 'color_scheme', 'color_scheme_1'),
(0, 'TProperties', 'properties', 'a:53:{i:0;a:2:{s:11:"property_id";i:20;s:6:"values";s:8:"dropDown";}i:1;a:2:{s:11:"property_id";i:22;s:6:"values";s:6:"scroll";}i:2;a:2:{s:11:"property_id";i:23;s:6:"values";s:6:"scroll";}i:3;a:2:{s:11:"property_id";i:24;s:6:"values";s:6:"scroll";}i:4;a:2:{s:11:"property_id";i:25;s:6:"values";s:6:"scroll";}i:5;a:2:{s:11:"property_id";i:26;s:6:"values";s:6:"scroll";}i:6;a:2:{s:11:"property_id";i:28;s:6:"values";s:6:"scroll";}i:7;a:2:{s:11:"property_id";i:31;s:6:"values";s:6:"scroll";}i:8;a:2:{s:11:"property_id";i:34;s:6:"values";s:6:"scroll";}i:9;a:2:{s:11:"property_id";i:35;s:6:"values";s:6:"scroll";}i:10;a:2:{s:11:"property_id";i:36;s:6:"values";s:6:"scroll";}i:11;a:2:{s:11:"property_id";i:37;s:6:"values";s:6:"scroll";}i:12;a:2:{s:11:"property_id";i:39;s:6:"values";s:6:"scroll";}i:13;a:2:{s:11:"property_id";i:41;s:6:"values";s:6:"scroll";}i:14;a:2:{s:11:"property_id";i:42;s:6:"values";s:6:"scroll";}i:15;a:2:{s:11:"property_id";i:46;s:6:"values";s:6:"scroll";}i:16;a:2:{s:11:"property_id";i:50;s:6:"values";s:6:"scroll";}i:17;a:2:{s:11:"property_id";i:51;s:6:"values";s:8:"dropDown";}i:18;a:2:{s:11:"property_id";i:52;s:6:"values";s:8:"dropDown";}i:19;a:2:{s:11:"property_id";i:53;s:6:"values";s:8:"dropDown";}i:20;a:2:{s:11:"property_id";i:57;s:6:"values";s:8:"dropDown";}i:21;a:2:{s:11:"property_id";i:58;s:6:"values";s:8:"dropDown";}i:22;a:2:{s:11:"property_id";i:59;s:6:"values";s:8:"dropDown";}i:23;a:2:{s:11:"property_id";i:60;s:6:"values";s:8:"dropDown";}i:24;a:2:{s:11:"property_id";i:62;s:6:"values";s:8:"dropDown";}i:25;a:2:{s:11:"property_id";i:64;s:6:"values";s:8:"dropDown";}i:26;a:2:{s:11:"property_id";i:66;s:6:"values";s:8:"dropDown";}i:27;a:2:{s:11:"property_id";i:67;s:6:"values";s:8:"dropDown";}i:28;a:2:{s:11:"property_id";i:68;s:6:"values";s:8:"dropDown";}i:29;a:2:{s:11:"property_id";i:70;s:6:"values";s:8:"dropDown";}i:30;a:2:{s:11:"property_id";i:73;s:6:"values";s:8:"dropDown";}i:31;a:2:{s:11:"property_id";i:74;s:6:"values";s:8:"dropDown";}i:32;a:2:{s:11:"property_id";i:75;s:6:"values";s:8:"dropDown";}i:33;a:2:{s:11:"property_id";i:76;s:6:"values";s:8:"dropDown";}i:34;a:2:{s:11:"property_id";i:77;s:6:"values";s:15:"dropDown,scroll";}i:35;a:2:{s:11:"property_id";i:78;s:6:"values";s:15:"dropDown,scroll";}i:36;a:2:{s:11:"property_id";i:79;s:6:"values";s:15:"dropDown,scroll";}i:37;a:2:{s:11:"property_id";i:84;s:6:"values";s:15:"dropDown,scroll";}i:38;a:2:{s:11:"property_id";i:86;s:6:"values";s:15:"dropDown,scroll";}i:39;a:2:{s:11:"property_id";i:89;s:6:"values";s:15:"dropDown,scroll";}i:40;a:2:{s:11:"property_id";i:90;s:6:"values";s:15:"dropDown,scroll";}i:41;a:2:{s:11:"property_id";i:91;s:6:"values";s:15:"dropDown,scroll";}i:42;a:2:{s:11:"property_id";i:92;s:6:"values";s:15:"dropDown,scroll";}i:43;a:2:{s:11:"property_id";i:93;s:6:"values";s:15:"dropDown,scroll";}i:44;a:2:{s:11:"property_id";i:95;s:6:"values";s:15:"dropDown,scroll";}i:45;a:2:{s:11:"property_id";i:96;s:6:"values";s:15:"dropDown,scroll";}i:46;a:2:{s:11:"property_id";i:97;s:6:"values";s:15:"dropDown,scroll";}i:47;a:2:{s:11:"property_id";i:98;s:6:"values";s:15:"dropDown,scroll";}i:48;a:2:{s:11:"property_id";i:99;s:6:"values";s:15:"dropDown,scroll";}i:49;a:2:{s:11:"property_id";i:100;s:6:"values";s:15:"dropDown,scroll";}i:50;a:2:{s:11:"property_id";i:101;s:6:"values";s:15:"dropDown,scroll";}i:51;a:2:{s:11:"property_id";i:160;s:6:"values";s:8:"dropDown";}i:52;a:2:{s:11:"property_id";i:363;s:6:"values";s:8:"dropDown";}}'),
(0, 'TMenuColumn', 'columns', 'a:4:{i:930;s:1:"0";i:931;s:1:"0";i:2583;s:1:"0";i:3015;s:1:"0";}'),
(0, 'TMenuColumn', 'openLevels', 's:1:"2";');

-- --------------------------------------------------------

--
-- Структура таблиці `trash`
--

CREATE TABLE IF NOT EXISTS `trash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trash_id` varchar(255) DEFAULT NULL,
  `trash_url` varchar(255) DEFAULT NULL,
  `trash_redirect_type` varchar(20) DEFAULT NULL,
  `trash_redirect` varchar(255) DEFAULT NULL,
  `trash_type` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=667 ;

--
-- Дамп даних таблиці `trash`
--

INSERT INTO `trash` (`id`, `trash_id`, `trash_url`, `trash_redirect_type`, `trash_redirect`, `trash_type`) VALUES
(612, '930', 'shop/product/muzhskie-chasy-emporio-armani-fem65007b9', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/klassicheskie-chasy', '301'),
(613, '930', 'shop/product/17331', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/klassicheskie-chasy', '301'),
(614, '930', 'shop/product/17337', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/klassicheskie-chasy', '301'),
(615, '931', 'shop/product/17371', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(616, '931', 'shop/product/17370', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(617, '931', 'shop/product/17369', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(618, '931', 'shop/product/17368', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(619, '931', 'shop/product/17367', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(620, '931', 'shop/product/17366', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(621, '931', 'shop/product/17365', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(622, '931', 'shop/product/17364', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(623, '931', 'shop/product/17363', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(624, '931', 'shop/product/17362', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(625, '931', 'shop/product/17361', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(626, '931', 'shop/product/17360', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(627, '931', 'shop/product/17358', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(628, '931', 'shop/product/17357', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(629, '931', 'shop/product/17356', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(630, '931', 'shop/product/17351', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(631, '931', 'shop/product/17350', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/sportivnye-chasy', '301'),
(632, '2583', 'shop/product/17373', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/dizainerskie-chasy', '301'),
(633, '2583', 'shop/product/17374', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/dizainerskie-chasy', '301'),
(634, '2583', 'shop/product/17375', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/dizainerskie-chasy', '301'),
(635, '2583', 'shop/product/17376', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/dizainerskie-chasy', '301'),
(636, '2583', 'shop/product/17377', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/dizainerskie-chasy', '301'),
(637, '3013', 'shop/product/17385', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/karmannye-chasy', '301'),
(638, '3013', 'shop/product/17386', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/karmannye-chasy', '301'),
(639, '3013', 'shop/product/17387', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/karmannye-chasy', '301'),
(640, '3013', 'shop/product/17388', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/karmannye-chasy', '301'),
(641, '3013', 'shop/product/17389', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/karmannye-chasy', '301'),
(642, '9', 'shop/product/17391', 'category', 'http://intime.loc/shop/category/zhenskie-chasy', '301'),
(643, '9', 'shop/product/17392', 'category', 'http://intime.loc/shop/category/zhenskie-chasy', '301'),
(644, '9', 'shop/product/17393', 'category', 'http://intime.loc/shop/category/zhenskie-chasy', '301'),
(645, '9', 'shop/product/17394', 'category', 'http://intime.loc/shop/category/zhenskie-chasy', '301'),
(646, '9', 'shop/product/17395', 'category', 'http://intime.loc/shop/category/zhenskie-chasy', '301'),
(647, '3', 'shop/product/17397', 'category', 'http://intime.loc/shop/category/detskie-chasy', '301'),
(648, '3', 'shop/product/17398', 'category', 'http://intime.loc/shop/category/detskie-chasy', '301'),
(649, '3', 'shop/product/17399', 'category', 'http://intime.loc/shop/category/detskie-chasy', '301'),
(650, '3', 'shop/product/17400', 'category', 'http://intime.loc/shop/category/detskie-chasy', '301'),
(651, '3', 'shop/product/17401', 'category', 'http://intime.loc/shop/category/detskie-chasy', '301'),
(652, '1', 'shop/product/17402', 'category', 'http://intime.loc/shop/category/aksessuary', '301'),
(653, '1', 'shop/product/17403', 'category', 'http://intime.loc/shop/category/aksessuary', '301'),
(654, '1', 'shop/product/17404', 'category', 'http://intime.loc/shop/category/aksessuary', '301'),
(655, '1', 'shop/product/17405', 'category', 'http://intime.loc/shop/category/aksessuary', '301'),
(656, '1', 'shop/product/17407', 'category', 'http://intime.loc/shop/category/aksessuary', '301'),
(657, '7', 'shop/product/17408', 'category', 'http://intime.loc/shop/category/domashnie-chasy', '301'),
(658, '7', 'shop/product/17409', 'category', 'http://intime.loc/shop/category/domashnie-chasy', '301'),
(659, '7', 'shop/product/17410', 'category', 'http://intime.loc/shop/category/domashnie-chasy', '301'),
(660, '7', 'shop/product/17411', 'category', 'http://intime.loc/shop/category/domashnie-chasy', '301'),
(661, '7', 'shop/product/17412', 'category', 'http://intime.loc/shop/category/domashnie-chasy', '301'),
(662, '3015', 'shop/product/17378', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/iuvelirnye-chasy', '301'),
(663, '3015', 'shop/product/17379', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/iuvelirnye-chasy', '301'),
(664, '3015', 'shop/product/17381', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/iuvelirnye-chasy', '301'),
(665, '3015', 'shop/product/17382', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/iuvelirnye-chasy', '301'),
(666, '3015', 'shop/product/17383', 'category', 'http://intime.loc/shop/category/telefoniia-pleery-gps/naruchnye-chasy/iuvelirnye-chasy', '301');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `user_autologin`
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

-- --------------------------------------------------------

--
-- Структура таблиці `user_temp`
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

-- --------------------------------------------------------

--
-- Структура таблиці `widgets`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Дамп даних таблиці `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `type`, `data`, `method`, `settings`, `description`, `roles`, `created`) VALUES
(5, 'tags', 'module', 'tags', 'tags_cloud', '', 'Теги', '', 1312362714),
(6, 'path', 'module', 'navigation', 'widget_navigation', '', 'Виджет навигации', '', 1328631622),
(10, 'popular_products', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:11:"popular,hot";s:5:"title";s:27:"Мы рекомендуем";s:13:"productsCount";s:1:"6";s:7:"subpath";s:7:"widgets";}', 'Популярные товары', '', 1363606273),
(13, 'brands', 'module', 'shop', 'brands', 'a:4:{s:10:"withImages";b:1;s:11:"brandsCount";s:1:"9";s:7:"subpath";s:7:"widgets";s:5:"title";s:33:"Популярные бренды";}', 'Бренды', '', 1363606422),
(15, 'similar', 'module', 'shop', 'similar_products', 'a:3:{s:5:"title";s:27:"Похожие товары";s:13:"productsCount";s:1:"5";s:7:"subpath";s:7:"widgets";}', 'Похожие товары', '', 1363606582),
(27, 'ViewedProducts', 'module', 'shop', 'view_product', 'a:4:{s:12:"productsType";b:0;s:5:"title";s:14:"ViewedProducts";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Просмотренные товары', '', 1374575092),
(16, 'benefits', 'html', '<div class="container">\n<ul class="items items-benefits">\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_1">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Бесплатная</div>\n<p>доставка</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_2">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Гибкая система</div>\n<p>скидок</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_3">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Индивидуальный</div>\n<p>подход</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_4">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">высокий уровень</div>\n<p>сервиса</p>\n</div>\n</div>\n</li>\n</ul>\n</div>', '', '', 'Преимущества', '', 1371214822),
(17, 'payments_delivery_methods_info', 'html', '<div class="frame-delivery-payment"><dl><dt class="title f-s_0"><span class="icon_delivery">&nbsp;</span><span class="text-el">Доставка</span></dt><dd class="frame-list-delivery">\n<ul class="list-style-1">\n<li>Новая Почта</li>\n<li>Другие транспортные службы</li>\n<li>Курьером по Киеву</li>\n<li>Самовывоз</li>\n</ul>\n</dd><dt class="title f-s_0"><span class="icon_payment">&nbsp;</span><span class="text-el">Оплата</span></dt><dd class="frame-list-payment">\n<ul class="list-style-1">\n<li>Наличными при получении</li>\n<li>Безналичный перевод</li>\n<li>Приват 24</li>\n<li>WebMoney</li>\n</ul>\n</dd></dl></div>\n<div class="frame-phone-product">\n<div class="title f-s_0"><span class="icon_phone_product">&nbsp;</span><span class="text-el">Заказы по телефонах</span></div>\n<ul class="list-style-1">\n<li>(097) <span class="d_n">&minus;</span>567-43-21</li>\n<li>(097) <span class="d_n">&minus;</span>567-43-22</li>\n</ul>\n</div>', '', '', 'Информация о способах доставки', '', 1371821417),
(20, 'start_page_seo_text', 'html', '', '', '', '', '', 1378821714),
(30, 'latest_news', 'module', 'core', 'recent_news', 'a:4:{s:10:"news_count";s:1:"3";s:11:"max_symdols";s:3:"100";s:10:"categories";a:1:{i:0;s:2:"69";}s:7:"display";s:7:"popular";}', '', '', 1406903323),
(31, 'action_products', 'module', 'shop', 'products', 'a:4:{s:12:"productsType";s:14:"popular,action";s:5:"title";s:21:"Цена недели";s:13:"productsCount";s:2:"10";s:7:"subpath";s:7:"widgets";}', 'Акционные товары', '', 1409557847);

-- --------------------------------------------------------

--
-- Структура таблиці `widget_i18n`
--

CREATE TABLE IF NOT EXISTS `widget_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `locale` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `widget_i18n`
--

INSERT INTO `widget_i18n` (`id`, `locale`, `data`) VALUES
(16, 'ru', '<div class="container">\n<ul class="items items-benefits">\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_1">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Быстрая доставка</div>\n<p>Кратчайшие сроки доставки</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_2">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Гибкая система скидок</div>\n<p>Для постоянных покупателей</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_3">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Полезная консультация</div>\n<p>Выбор оптимальных решений</p>\n</div>\n</div>\n</li>\n<li>\n<div class="frame-icon-benefit"><span class="helper">&nbsp;</span> <span class="icon-benefits_4">&nbsp;</span></div>\n<div class="frame-description-benefit f-s_0"><span class="helper">&nbsp;</span>\n<div>\n<div class="title">Качественный сервис</div>\n<p>Быстрая обработка заказа</p>\n</div>\n</div>\n</li>\n</ul>\n</div>'),
(17, 'ru', '<div class="frame-delivery-payment"><dl><dt class="title">Доставка и оплата</dt><dd class="frame-list-delivery">\n<ul class="list-delivery">\n<li class="f-s_0"><span class="frame-ico"><span class="icon_d_p1">&nbsp;</span></span>\n<div class="descr"><span class="text-el">Самовывоз</span><span class="d_b s-t">Со склада магазина</span></div>\n</li>\n<li class="f-s_0"><span class="frame-ico"><span class="icon_d_p2">&nbsp;</span></span>\n<div class="descr"><span class="text-el">Курьерской службой </span><span class="d_b s-t">Новая почта и другие</span></div>\n</li>\n<li class="f-s_0"><span class="frame-ico"><span class="icon_d_p3">&nbsp;</span></span>\n<div class="descr"><span class="text-el">Оплата наличными</span><span class="d_b s-t">Курьеру при получении</span></div>\n</li>\n<li class="f-s_0"><span class="frame-ico"><span class="icon_d_p4">&nbsp;</span></span>\n<div class="descr"><span class="text-el">Безналичный платеж</span><span class="d_b s-t">Master Card, Visa; Приват 24</span></div>\n</li>\n</ul>\n</dd></dl></div>\n<div class="frame-delivery-payment"><dl><dt class="title">Нужна помощь?</dt><dd class="frame-list-delivery"><span class="s-t">Наши менеджеры ответят на ваши вопросы и помогут с выбором:</span>\n<ul class="list-style-1 list-phone-number">\n<li class="f-s_15">(093) <span class="d_n">&minus;</span>169-36-98</li>\n<li class="f-s_15">(093) <span class="d_n">&minus;</span>169-36-98</li>\n</ul>\n</dd></dl></div>'),
(20, 'ru', '<h1>Интернет-магазин часов и аксессуаров</h1>\n<p>Существует два основных вида данного предмета зимнего гардероба. Длинные модели прекрасно защитят своих обладательниц от мороза и снегопада. Любительницам спорта, шопинга и вождения автомобилей следует купить пухловики небольшого размера, которые также называют &laquo;короткими&raquo;. Кроме длинных и коротких моделей существуют так называемые универсальные варианты пуховиков. Под такой одеждой располагается специальная прокладка, отстегнув которую можно изменить размеры пуховика. Качественные и удобные пуховики можно в большом ассортименте приобрести в любом магазине зимней одежды. Чтобы найти такие магазины достаточно ввести в поиск купить пуховики киев и в результате посмотреть информацию о расположении предприятий.</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
