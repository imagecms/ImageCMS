-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 09 2012 г., 10:50
-- Версия сервера: 5.5.16
-- Версия PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
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
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `position`, `name`, `title`, `short_desc`, `url`, `image`, `keywords`, `description`, `fetch_pages`, `main_tpl`, `tpl`, `page_tpl`, `per_page`, `order_by`, `sort_order`, `comments_default`, `field_group`, `category_field_group`) VALUES
(1, 0, 0, 'Главная', '', '', 'main', '', '', '', 'b:0;', '', '', '', 10, 'publish_date', 'desc', 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `category_translate`
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

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Структура таблицы `components`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

--
-- Дамп данных таблицы `components`
--

INSERT INTO `components` (`id`, `name`, `identif`, `enabled`, `autoload`, `in_menu`, `settings`) VALUES
(1, 'user_manager', 'user_manager', 0, 0, 1, NULL),
(2, 'auth', 'auth', 1, 0, 0, NULL),
(4, 'comments', 'comments', 1, 1, 1, 'a:5:{s:18:"max_comment_length";i:550;s:6:"period";i:0;s:11:"can_comment";i:0;s:11:"use_captcha";b:1;s:14:"use_moderation";b:0;}'),
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
-- Структура таблицы `content`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Дамп данных таблицы `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(35, 'О сайте', '', 'o-sajte', '', 'это, базовый, шаблон, imagecms, котором, релизованы, следующие, функции, вывод, фотогалереи, статической, статьи, блога', 'Это базовый шаблон ImageCMS, на котором релизованы следующие функции: вывод фотогалереи, вывод статической статьи, вывод блога.', '<p>Это базовый шаблон ImageCMS, на котором релизованы следующие функции: отображение фотогалереи, отображение статической статьи, отображение корпоративного блога, отображение формы обратной связи.</p>\n<p>Общий вид шаблона можно отредактировать и изменить лого, графическую вставку на свои тематические.</p>\n<p>Слева в сайдбаре Вы видите список категорий блога, который легко вставляется с помощью функции {sub_category_list()} в файле main.tpl. Также в левом сайдбаре находится форма поиска по сайту, виджет последних комментариев и виджет тегов сайта. В этот сайдбар можно также добавить виджет последних либо популярных новостей, а также любые счетчики, информеры.</p>\n<p>Верхнее меню реализовано с помощью модуля Меню. Управлять его содержимым можно из административной части в разделе Меню - Главное меню. Сюда как правило можно еще добавить страницы: о компании, контакты, услуги и т.п.</p>\n<p>За дополнительной информацией обращайтесь в официальный раздел документации: <a href="http://www.imagecms.net/wiki">http://www.imagecms.net/wiki</a></p>\n<p>Обсудить дополнительные возможности, а также вопросы по установке, настройке системы можно на официальном форуме: <a href="http://forum.imagecms.net/index.php">http://forum.imagecms.net/</a></p>', '', 0, 'page_static', '', 0, 1, 0, 'publish', 'admin', 1267203253, 1267203328, 1290100400, 8, 3, 0),
(64, 'О магазине', '', 'about', '', 'магазине', 'О магазине', '<p>Магазин ImageCMS Shop предоставляет огромный выбор техники на любой вкус по лучшим ценам.</p>\n<p>Наш магазин существует более 5 лет и за это время не было ни единого возврата товара.</p>\n<p>Мы обслуживаем ежедневно сотни покупателей и делаем это с радостью.</p>\n<p><strong>Покупайте технику у нас и становитесь обладателем лучшей в мире техники!!!</strong></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295776, 1291295792, 1291743386, 284, 3, 0),
(65, 'Оплата', '', 'oplata', '', 'оплата', 'Оплата', '<p>Наш магазин поддерживает все доступные на данный момент методы оплаты.</p>\n<p>Также действует возможность оплаты курьеру при доставке для всех крупных городов Украины и России. (возможность оплаты курьеру в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295824, 1291295836, 1291743521, 168, 3, 0),
(66, 'Доставка', '', 'dostavka', '', 'доставка', 'Доставка', '<p>Мы поддерживаем доставку службой Автомир по всему миру.</p>\n<p>Также возможна доставка курьером для всех больших городов Украины и России (возможность доставки курьером в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>\n<p>При желании Вы можете сами забрать купленный товар в наших офисах.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295844, 1291295851, 1291743683, 120, 3, 0),
(67, 'Помощь', '', 'help', '', 'помощь', 'Помощь', '<p>Для того, чтобы приобрести товар в нашем магазине, Вам нужно выполнить несколько простых шагов:</p>\n<ul>\n<li>Выбрать нужный товар, воспользовавшить навигацией слева, либо поиском.</li>\n<li>Добавить товар в корзину.</li>\n<li>Перейти в корзину, выбрать способ доставки и указать Ваши контактные данные.</li>\n<li>Подтвердить заказ и выбрать способ оплаты.</li>\n</ul>\n<p>После этого наши менеджеры свяжуться с Вами и помогут с оплатой и доставкой товара, а также проконсультируют по любому вопросу.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1291743919, 74, 3, 0),
(68, 'Контакты', '', 'contact_us', '', 'контакты', 'Контакты', '<p><strong>Горячий телефон</strong>: 0 800 80 80 800</p>\n<p><strong>Главный офис в Москве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 095 095 00 00</p>\n<p>&nbsp;</p>\n<p><strong>Главный офис в Киеве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 098 098 00 00</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295870, 1291295888, 1291744068, 63, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `content_fields`
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

-- --------------------------------------------------------

--
-- Структура таблицы `content_fields_data`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Структура таблицы `content_field_groups`
--

CREATE TABLE IF NOT EXISTS `content_field_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Структура таблицы `content_permissions`
--

CREATE TABLE IF NOT EXISTS `content_permissions` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `content_permissions`
--

INSERT INTO `content_permissions` (`id`, `page_id`, `data`) VALUES
(21, 35, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}');

-- --------------------------------------------------------

--
-- Структура таблицы `content_tags`
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
-- Структура таблицы `gallery_albums`
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
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `created` (`created`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `gallery_albums`
--

INSERT INTO `gallery_albums` (`id`, `category_id`, `name`, `description`, `cover_id`, `position`, `created`, `updated`) VALUES
(1, 1, 'new album', '', 0, 0, 1264086406, 1307538865);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_category`
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
-- Дамп данных таблицы `gallery_category`
--

INSERT INTO `gallery_category` (`id`, `name`, `description`, `cover_id`, `position`, `created`) VALUES
(1, 'test category', '', 0, 0, 1264086398);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_images`
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
-- Дамп данных таблицы `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `album_id`, `file_name`, `file_ext`, `file_size`, `position`, `width`, `height`, `description`, `uploaded`, `views`) VALUES
(18, 1, 'test', '.jpg', '201.3 Кб', 1, 800, 600, NULL, 1266935445, 229),
(19, 1, 'Frangipani_Flowers', '.jpg', '53.2 Кб', 2, 800, 600, NULL, 1266935848, 231),
(37, 1, 'flowers', '.jpg', '81.8 Кб', 4, 800, 600, NULL, 1307538860, 0),
(36, 1, 'winter', '.jpg', '103.1 Кб', 3, 800, 600, NULL, 1307538860, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
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
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `identif`, `image`, `folder`, `template`, `default`) VALUES
(3, 'Русский', 'ru', '', 'russian', 'default', 1),
(30, 'ua', 'ua', '', 'english', 'commerce', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip_address` (`ip_address`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Дамп данных таблицы `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `username`, `message`, `date`) VALUES
(47, 1, 'admin', 'Очистил кеш', 1336559787),
(48, 1, 'admin', 'Удалил категорию ID 56', 1336560516),
(49, 1, 'admin', 'Удалил страницу ID 69', 1336560516),
(50, 1, 'admin', 'Удалил страницу ID ', 1336560516),
(51, 1, 'admin', 'Удалил страницу ID ', 1336560516);

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `name`, `main_title`, `tpl`, `expand_level`, `description`, `created`) VALUES
(1, 'main_menu', 'Главное меню', 'shop_menu', 0, '', '2012-02-07 15:34:41');

-- --------------------------------------------------------

--
-- Структура таблицы `menus_data`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `menus_data`
--

INSERT INTO `menus_data` (`id`, `menu_id`, `item_id`, `item_type`, `item_image`, `roles`, `hidden`, `title`, `parent_id`, `position`, `description`, `add_data`) VALUES
(10, 1, 0, 'url', '', '', 0, 'Оплата', 0, 3, NULL, 'a:2:{s:3:"url";s:7:"/oplata";s:7:"newpage";s:1:"0";}'),
(8, 1, 0, 'url', '', '', 0, 'Главная', 0, 1, NULL, 'a:2:{s:3:"url";s:1:"/";s:7:"newpage";s:1:"0";}'),
(9, 1, 0, 'url', '', '', 0, 'О Магазине', 0, 2, NULL, 'a:2:{s:3:"url";s:6:"/about";s:7:"newpage";s:1:"0";}'),
(11, 1, 0, 'url', '', '', 0, 'Доставка', 0, 4, NULL, 'a:2:{s:3:"url";s:9:"/dostavka";s:7:"newpage";s:1:"0";}'),
(12, 1, 0, 'url', '', '', 0, 'Помощь', 0, 5, NULL, 'a:2:{s:3:"url";s:5:"/help";s:7:"newpage";s:1:"0";}'),
(13, 1, 0, 'url', '', '', 0, 'Контакты', 0, 6, NULL, 'a:2:{s:3:"url";s:11:"/contact_us";s:7:"newpage";s:1:"0";}');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_translate`
--

CREATE TABLE IF NOT EXISTS `menu_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `data`) VALUES
(1, 2, 'a:36:{s:9:"cp_access";s:1:"1";s:13:"cp_autoupdate";s:1:"1";s:14:"cp_page_search";s:1:"1";s:11:"lang_create";s:1:"1";s:9:"lang_edit";s:1:"1";s:11:"lang_delete";s:1:"1";s:16:"cp_site_settings";s:1:"1";s:11:"cache_clear";s:1:"1";s:11:"page_create";s:1:"1";s:9:"page_edit";s:1:"1";s:11:"page_delete";s:1:"1";s:15:"category_create";s:1:"1";s:13:"category_edit";s:1:"1";s:15:"category_delete";s:1:"1";s:14:"module_install";s:1:"1";s:16:"module_deinstall";s:1:"1";s:12:"module_admin";s:1:"1";s:13:"widget_create";s:1:"1";s:13:"widget_delete";s:1:"1";s:22:"widget_access_settings";s:1:"1";s:11:"menu_create";s:1:"1";s:9:"menu_edit";s:1:"1";s:11:"menu_delete";s:1:"1";s:11:"user_create";s:1:"1";s:21:"user_create_all_roles";s:1:"1";s:9:"user_edit";s:1:"1";s:11:"user_delete";s:1:"1";s:14:"user_view_data";s:1:"1";s:14:"xfields_create";s:1:"1";s:14:"xfields_delete";s:1:"1";s:12:"xfields_edit";s:1:"1";s:12:"roles_create";s:1:"1";s:10:"roles_edit";s:1:"1";s:12:"roles_delete";s:1:"1";s:9:"logs_view";s:1:"1";s:13:"backup_create";s:1:"1";}');

-- --------------------------------------------------------

--
-- Структура таблицы `propel_migration`
--

CREATE TABLE IF NOT EXISTS `propel_migration` (
  `version` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `propel_migration`
--

INSERT INTO `propel_migration` (`version`) VALUES
(1329385432);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
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
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`, `alt_name`, `desc`) VALUES
(1, 0, 'user', 'Пользователи', ''),
(2, 0, 'admin', 'Администраторы', '');

-- --------------------------------------------------------

--
-- Структура таблицы `search`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
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
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `site_title`, `site_short_title`, `site_description`, `site_keywords`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`) VALUES
(2, 'main', 'anytitle3', 'ImageCMS Shop', 'Продажа качественной техники с гарантией и доставкой', 'магазин техники, покупка техники, доставка техники', 'auto', 'auto', '0', '0', 1, 1, '/', 'advanced', 'commerce', 'no', 'module', 69, '56', 'shop', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_banners`
--

CREATE TABLE IF NOT EXISTS `shop_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_banners_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `shop_banners`
--

INSERT INTO `shop_banners` (`id`, `name`, `text`, `url`, `image`, `position`) VALUES
(1, 'Samsung LN40C650 40" LCD TV', 'Высоко технологический продукт, который поможет Вам оценить качество.', '/shop/product/74', '1.jpg', 19),
(3, 'Panasonic KX-TG7433B Expandable', 'Высоко технологический продукт, который поможет Вам оценить качество.', '/shop/product/106', '3.jpg', NULL),
(4, 'Samsung NX10 14 Megapixel Digital', 'Высоко технологический продукт, который поможет Вам оценить качество.', '/shop/product/98', '4.jpg', 22);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_brands`
--

CREATE TABLE IF NOT EXISTS `shop_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_brands_I_1` (`name`(333)),
  KEY `shop_brands_I_2` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_callbacks`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_callbacks_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `shop_callbacks_statuses`
--

INSERT INTO `shop_callbacks_statuses` (`id`, `text`, `is_default`) VALUES
(1, 'Новый', 1),
(3, 'Обработан', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_callbacks_themes`
--

CREATE TABLE IF NOT EXISTS `shop_callbacks_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_category`
--

CREATE TABLE IF NOT EXISTS `shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text,
  `meta_desc` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `full_path` varchar(1000) DEFAULT NULL,
  `full_path_ids` varchar(250) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_category_I_1` (`name`),
  KEY `shop_category_I_2` (`url`),
  KEY `shop_category_I_3` (`active`),
  KEY `shop_category_I_4` (`parent_id`),
  KEY `shop_category_I_5` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_currencies`
--

CREATE TABLE IF NOT EXISTS `shop_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `main` tinyint(4) DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `symbol` varchar(5) DEFAULT NULL,
  `rate` float(6,3) DEFAULT '1.000',
  PRIMARY KEY (`id`),
  KEY `shop_currencies_I_1` (`name`),
  KEY `shop_currencies_I_2` (`main`),
  KEY `shop_currencies_I_3` (`is_default`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `shop_currencies`
--

INSERT INTO `shop_currencies` (`id`, `name`, `main`, `is_default`, `code`, `symbol`, `rate`) VALUES
(1, 'Доллары', 1, 1, 'USD', '$', 1.000),
(2, 'Рубли', 0, 0, 'RUR', 'руб', 30.600);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_delivery_methods`
--

CREATE TABLE IF NOT EXISTS `shop_delivery_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `description` text,
  `price` float(10,2) NOT NULL,
  `free_from` float(10,2) NOT NULL,
  `enabled` tinyint(4) DEFAULT NULL,
  `is_price_in_percent` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_delivery_methods_I_1` (`name`(333)),
  KEY `shop_delivery_methods_I_2` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_delivery_methods_systems`
--

CREATE TABLE IF NOT EXISTS `shop_delivery_methods_systems` (
  `delivery_method_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  PRIMARY KEY (`delivery_method_id`,`payment_method_id`),
  KEY `shop_delivery_methods_systems_FI_2` (`payment_method_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_discounts`
--

CREATE TABLE IF NOT EXISTS `shop_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_notifications`
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
  `notified_by_email` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_notifications_I_1` (`user_email`),
  KEY `shop_notifications_I_2` (`user_phone`),
  KEY `shop_notifications_I_3` (`status`),
  KEY `shop_notifications_I_4` (`date_created`),
  KEY `shop_notifications_I_5` (`active_to`),
  KEY `shop_notifications_FI_1` (`product_id`),
  KEY `shop_notifications_FI_2` (`variant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_notification_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_notification_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_notification_statuses_I_1` (`name`(333)),
  KEY `shop_notification_statuses_I_2` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_orders`
--

CREATE TABLE IF NOT EXISTS `shop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `delivery_method` int(11) DEFAULT NULL,
  `delivery_price` float(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `paid` tinyint(4) DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_orders_products`
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
  PRIMARY KEY (`id`),
  KEY `shop_orders_products_I_1` (`order_id`),
  KEY `shop_orders_products_FI_1` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_orders_status_history`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_order_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_order_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_order_statuses_I_1` (`name`(333)),
  KEY `shop_order_statuses_I_2` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_payment_methods`
--

CREATE TABLE IF NOT EXISTS `shop_payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `active` tinyint(4) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `payment_system_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_payment_methods_I_1` (`name`),
  KEY `shop_payment_methods_I_2` (`position`),
  KEY `shop_payment_methods_FI_1` (`currency_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_products`
--

CREATE TABLE IF NOT EXISTS `shop_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `url` varchar(255) NOT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `hit` tinyint(4) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `related_products` varchar(255) DEFAULT NULL,
  `mainImage` varchar(255) DEFAULT NULL,
  `smallImage` varchar(255) DEFAULT NULL,
  `short_description` text,
  `full_description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `old_price` float(10,2) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `hot` tinyint(4) DEFAULT NULL,
  `action` tinyint(4) DEFAULT NULL,
  `added_to_cart_count` int(11) DEFAULT NULL,
  `enable_comments` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `shop_products_I_1` (`name`(333)),
  KEY `shop_products_I_2` (`url`),
  KEY `shop_products_I_3` (`brand_id`),
  KEY `shop_products_I_4` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_products_rating`
--

CREATE TABLE IF NOT EXISTS `shop_products_rating` (
  `product_id` int(11) NOT NULL,
  `votes` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `shop_product_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_images`
--

CREATE TABLE IF NOT EXISTS `shop_product_images` (
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`image_name`),
  KEY `shop_product_images_I_1` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `csv_name` varchar(50) NOT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `show_in_compare` tinyint(4) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `data` text,
  `show_on_site` tinyint(4) DEFAULT NULL,
  `multiple` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_properties_I_1` (`name`),
  KEY `shop_product_properties_I_2` (`active`),
  KEY `shop_product_properties_I_3` (`show_on_site`),
  KEY `shop_product_properties_I_4` (`show_in_compare`),
  KEY `shop_product_properties_I_5` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties_categories` (
  `property_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`category_id`),
  KEY `shop_product_properties_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties_data`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_variants`
--

CREATE TABLE IF NOT EXISTS `shop_product_variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `price` float(10,5) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `mainImage` varchar(255) DEFAULT NULL,
  `smallImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_variants_I_1` (`product_id`),
  KEY `shop_product_variants_I_2` (`position`),
  KEY `shop_product_variants_I_3` (`number`),
  KEY `shop_product_variants_I_4` (`name`(333)),
  KEY `shop_product_variants_I_5` (`price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_settings`
--

CREATE TABLE IF NOT EXISTS `shop_settings` (
  `name` varchar(255) NOT NULL,
  `value` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_settings`
--

INSERT INTO `shop_settings` (`name`, `value`) VALUES
('mainImageWidth', '300'),
('mainImageHeight', '500'),
('smallImageWidth', '150'),
('smallImageHeight', '200'),
('addImageWidth', '800'),
('addImageHeight', '600'),
('imagesQuality', '99'),
('systemTemplatePath', './templates/commerce/shop/default'),
('frontProductsPerPage', '12'),
('adminProductsPerPage', '24'),
('ordersMessageFormat', 'text'),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22'),
('ordersSendMessage', 'true'),
('ordersSenderEmail', 'noreply@demoshop.imagecm.net'),
('ordersSenderName', 'DemoShop ImageCms.net'),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки'),
('2_LMI_SECRET_KEY', 'bank'),
('2_LMI_PAYEE_PURSE', 'bank'),
('1_LMI_SECRET_KEY', 'cur'),
('1_LMI_PAYEE_PURSE', 'cur'),
('2_OschadBankData', 'a:5:{s:8:"receiver";s:41:"ТЗОВ "Екзампл Магазин" ";s:4:"code";s:9:"123456789";s:7:"account";s:12:"123456789123";s:3:"mfo";s:6:"123456";s:8:"banknote";s:7:"грн.";}'),
('3_SberBankData', 'a:8:{s:12:"receiverName";s:45:"Наименование получателя";s:8:"bankName";s:29:"Банк получателя";s:11:"receiverInn";s:10:"1231231231";s:7:"account";s:20:"15412398123312341237";s:3:"BIK";s:9:"123123123";s:11:"cor_account";s:20:"12312312334012340123";s:8:"bankNote";s:7:"руб.";s:9:"bankNote2";s:7:"коп.";}'),
('4_RobokassaData', 'a:3:{s:5:"login";s:5:"login";s:9:"password1";s:9:"password1";s:9:"password2";s:9:"password2";}'),
('notifyOrderStatusMessageFormat', 'text'),
('notifyOrderStatusMessageText', ''),
('notifyOrderStatusSenderEmail', 'noreply@example.com'),
('notifyOrderStatusSenderName', ''),
('notifyOrderStatusMessageTheme', ''),
('wishListsMessageFormat', 'text'),
('wishListsMessageText', ''),
('wishListsSenderEmail', 'noreply@example.com'),
('wishListsSenderName', ''),
('wishListsMessageTheme', ''),
('notificationsMessageFormat', 'text'),
('notificationsMessageText', ''),
('notificationsSenderEmail', 'noreply@example.com'),
('notificationsSenderName', ''),
('notificationsMessageTheme', ''),
('callbacksSendNotification', '0'),
('callbacksMessageFormat', 'text'),
('callbacksMessageText', ''),
('callbacksSendEmailTo', ''),
('callbacksSenderEmail', ''),
('callbacksSenderName', ''),
('callbacksMessageTheme', ''),
('userInfoRegister', '0'),
('userInfoMessageFormat', 'text'),
('userInfoMessageText', ''),
('userInfoSenderEmail', ''),
('userInfoSenderName', ''),
('userInfoMessageTheme', ''),
('topSalesBlockFormulaCoef', '1'),
('pricePrecision', '2'),
('smallAddImageWidth', '90'),
('smallAddImageHeight', '90'),
('forgotPasswordMessageText', 'Здравствуйте!\n\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\n\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri% \n\nВаш новый пароль для входа: %password%\n\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\n\n\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\n\nС уважением, \nсотрудники службы продаж %webSiteName%'),
('watermark_wm_hor_alignment', 'right'),
('watermark_wm_vrt_alignment', 'bottom'),
('watermark_watermark_type', 'text'),
('watermark_watermark_image', ''),
('watermark_watermark_image_opacity', '50'),
('watermark_watermark_padding', ''),
('watermark_watermark_text', ''),
('watermark_watermark_font_size', ''),
('watermark_watermark_color', ''),
('watermark_watermark_font_path', ''),
('watermark_active', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_user_profile`
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
  PRIMARY KEY (`id`),
  KEY `shop_user_profile_I_1` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_warehouse`
--

CREATE TABLE IF NOT EXISTS `shop_warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `shop_warehouse_I_1` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_warehouse_data`
--

CREATE TABLE IF NOT EXISTS `shop_warehouse_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_warehouse_data_FI_1` (`product_id`),
  KEY `shop_warehouse_data_FI_2` (`warehouse_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(25) NOT NULL,
  `password` varchar(34) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 2, 'admin', '$1$Ax3.Ji4.$UYqnfiYfMZdRwi4aIX/ek/', 'avgustus@yandex.ru', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2012-05-09 14:35:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `user_autologin`
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
-- Структура таблицы `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`) VALUES
(1, 84),
(2, 85),
(3, 86);

-- --------------------------------------------------------

--
-- Структура таблицы `user_temp`
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
-- Структура таблицы `widgets`
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
-- Дамп данных таблицы `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `type`, `data`, `method`, `settings`, `description`, `roles`, `created`) VALUES
(3, 'latest_news', 'module', 'core', 'recent_news', 'a:4:{s:10:"news_count";s:1:"3";s:11:"max_symdols";s:3:"150";s:10:"categories";a:1:{i:0;s:2:"56";}s:7:"display";s:6:"recent";}', 'Последние новости', '', 1291632457),
(4, 'recent_product_comments', 'module', 'comments', 'recent_product_comments', 'a:2:{s:14:"comments_count";s:1:"5";s:13:"symbols_count";s:1:"0";}', '', '', 1308300371),
(5, 'tags', 'module', 'tags', 'tags_cloud', '', 'tags', '', 1312362714),
(6, 'path', 'module', 'navigation', 'widget_navigation', '', 'path', '', 1328631622);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
