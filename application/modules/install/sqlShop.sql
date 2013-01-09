-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Гру 18 2012 р., 18:36
-- Версія сервера: 5.5.28
-- Версія PHP: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `imagecms`
--

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
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Дамп даних таблиці `category`
--

INSERT INTO `category` (`id`, `parent_id`, `position`, `name`, `title`, `short_desc`, `url`, `image`, `keywords`, `description`, `fetch_pages`, `main_tpl`, `tpl`, `page_tpl`, `per_page`, `order_by`, `sort_order`, `comments_default`, `field_group`, `category_field_group`, `settings`) VALUES
(63, 0, 1, 'root', 'root category', '', 'root', '', '', '', 'b:0;', '', '', '', 5, 'publish_date', 'desc', 0, 11, 9, 'a:2:{s:26:"category_apply_for_subcats";s:1:"1";s:17:"apply_for_subcats";s:1:"1";}');

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
  `text` varchar(500) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Дамп даних таблиці `comments`
--
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- Дамп даних таблиці `components`
--

INSERT INTO `components` (`id`, `name`, `identif`, `enabled`, `autoload`, `in_menu`, `settings`, `position`) VALUES
(1, 'user_manager', 'user_manager', 0, 0, 1, NULL, 1),
(2, 'auth', 'auth', 1, 0, 0, NULL, 2),
(4, 'comments', 'comments', 1, 1, 1, 'a:5:{s:18:"max_comment_length";i:550;s:6:"period";i:0;s:11:"can_comment";i:0;s:11:"use_captcha";b:0;s:14:"use_moderation";b:0;}', 3),
(7, 'navigation', 'navigation', 0, 0, 1, NULL, 4),
(30, 'tags', 'tags', 1, 1, 1, NULL, 5),
(92, 'gallery', 'gallery', 1, 0, 1, 'a:26:{s:13:"max_file_size";s:1:"5";s:9:"max_width";s:1:"0";s:10:"max_height";s:1:"0";s:7:"quality";s:2:"95";s:14:"maintain_ratio";b:1;s:19:"maintain_ratio_prev";b:1;s:19:"maintain_ratio_icon";b:1;s:4:"crop";b:0;s:9:"crop_prev";b:0;s:9:"crop_icon";b:0;s:14:"prev_img_width";s:3:"500";s:15:"prev_img_height";s:3:"500";s:11:"thumb_width";s:3:"100";s:12:"thumb_height";s:3:"100";s:14:"watermark_text";s:0:"";s:16:"wm_vrt_alignment";s:6:"bottom";s:16:"wm_hor_alignment";s:4:"left";s:19:"watermark_font_size";s:2:"14";s:15:"watermark_color";s:6:"ffffff";s:17:"watermark_padding";s:2:"-5";s:19:"watermark_font_path";s:20:"./system/fonts/1.ttf";s:15:"watermark_image";s:0:"";s:23:"watermark_image_opacity";s:2:"50";s:14:"watermark_type";s:4:"text";s:8:"order_by";s:4:"date";s:10:"sort_order";s:4:"desc";}', 6),
(55, 'rss', 'rss', 1, 0, 1, 'a:5:{s:5:"title";s:9:"Image CMS";s:11:"description";s:35:"Тестируем модуль RSS";s:10:"categories";a:1:{i:0;s:1:"3";}s:9:"cache_ttl";i:60;s:11:"pages_count";i:10;}', 7),
(60, 'menu', 'menu', 0, 1, 1, NULL, 8),
(58, 'sitemap', 'sitemap', 1, 0, 1, 'a:6:{s:18:"main_page_priority";s:1:"1";s:13:"cats_priority";s:3:"0.8";s:14:"pages_priority";s:3:"0.6";s:20:"main_page_changefreq";s:6:"always";s:21:"categories_changefreq";s:6:"hourly";s:16:"pages_changefreq";s:5:"daily";}', 9),
(80, 'search', 'search', 1, 0, 0, NULL, 10),
(84, 'feedback', 'feedback', 1, 0, 0, 'a:2:{s:5:"email";s:19:"admin@localhost.loc";s:15:"message_max_len";i:550;}', 11),
(117, 'template_editor', 'template_editor', 0, 0, 0, NULL, 12),
(86, 'group_mailer', 'group_mailer', 0, 0, 1, NULL, 13),
(95, 'filter', 'filter', 1, 0, 0, NULL, 14),
(96, 'cfcm', 'cfcm', 0, 0, 0, NULL, 15),
(121, 'shop', 'shop', 1, 0, 0, NULL, 17),
(123, 'share', 'share', 0, 0, 0, NULL, 16);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Дамп даних таблиці `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(35, 'О сайте', '', 'o-sajte', '', 'это, базовый, шаблон, imagecms, котором, релизованы, следующие, функции, вывод, фотогалереи, статической, статьи, блога', 'Это базовый шаблон ImageCMS, на котором релизованы следующие функции: вывод фотогалереи, вывод статической статьи, вывод блога.', '<p>Это базовый шаблон ImageCMS, на котором релизованы следующие функции: отображение фотогалереи, отображение статической статьи, отображение корпоративного блога, отображение формы обратной связи.</p>\n<p>Общий вид шаблона можно отредактировать и изменить лого, графическую вставку на свои тематические.</p>\n<p>Слева в сайдбаре Вы видите список категорий блога, который легко вставляется с помощью функции {sub_category_list()} в файле main.tpl. Также в левом сайдбаре находится форма поиска по сайту, виджет последних комментариев и виджет тегов сайта. В этот сайдбар можно также добавить виджет последних либо популярных новостей, а также любые счетчики, информеры.</p>\n<p>Верхнее меню реализовано с помощью модуля Меню. Управлять его содержимым можно из административной части в разделе Меню - Главное меню. Сюда как правило можно еще добавить страницы: о компании, контакты, услуги и т.п.</p>\n<p>За дополнительной информацией обращайтесь в официальный раздел документации: <a href="http://www.imagecms.net/wiki">http://www.imagecms.net/wiki</a></p>\n<p>Обсудить дополнительные возможности, а также вопросы по установке, настройке системы можно на официальном форуме: <a href="http://forum.imagecms.net/index.php">http://forum.imagecms.net/</a></p>', '', 0, 'page_static', '', 0, 1, 0, 'publish', 'admin', 1267203253, 1267203328, 1290100400, 13, 3, 0),
(64, 'О магазине', '', 'about', '', 'магазине', 'О магазине', '<p>Магазин ImageCMS Shop предоставляет огромный выбор техники на любой вкус по лучшим ценам.</p>\n<p>Наш магазин существует более 5 лет и за это время не было ни единого возврата товара.</p>\n<p>Мы обслуживаем ежедневно сотни покупателей и делаем это с радостью.</p>\n<p><strong>Покупайте технику у нас и становитесь обладателем лучшей в мире техники!!!</strong></p>', '', 0, '', '', 0, 1, 0, 'publish', 'Roman Koloda', 1291295776, 0, 1354551261, 292, 3, 0),
(65, 'Оплата', '', 'oplata', '', 'оплата', 'Оплата', '<p>Наш магазин поддерживает все доступные на данный момент методы оплаты.</p>\n<p>Также действует возможность оплаты курьеру при доставке для всех крупных городов Украины и России. (возможность оплаты курьеру в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295824, 1291295836, 1291743521, 167, 3, 0),
(66, 'Доставка', '', 'dostavka', '', 'доставка', 'Доставка', '<p>Мы поддерживаем доставку службой Автомир по всему миру.</p>\n<p>Также возможна доставка курьером для всех больших городов Украины и России (возможность доставки курьером в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>\n<p>При желании Вы можете сами забрать купленный товар в наших офисах.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295844, 1291295851, 1291743683, 137, 3, 0),
(67, 'Помощь', '', 'help', '', 'помощь', 'Помощь', '<p>Для того, чтобы приобрести товар в нашем магазине, Вам нужно выполнить несколько простых шагов:</p>\n<ul>\n<li>Выбрать нужный товар, воспользовавшить навигацией слева, либо поиском.</li>\n<li>Добавить товар в корзину.</li>\n<li>Перейти в корзину, выбрать способ доставки и указать Ваши контактные данные.</li>\n<li>Подтвердить заказ и выбрать способ оплаты.</li>\n</ul>\n<p>После этого наши менеджеры свяжуться с Вами и помогут с оплатой и доставкой товара, а также проконсультируют по любому вопросу.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1291743919, 82, 3, 0),
(68, 'Контакты', '', 'contact_us', '', 'контакты', 'Контакты', '<p><strong>Горячий телефон</strong>: 0 800 80 80 800</p>\n<p><strong>Главный офис в Москве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 095 095 00 00</p>\n<p>&nbsp;</p>\n<p><strong>Главный офис в Киеве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 098 098 00 00</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295870, 1291295888, 1291744068, 79, 3, 0),
(75, 'Contact', '', 'contact_us', '', 'ssss', 'ssss', '<p><span id="result_box" lang="en"><span>Hot Phone</span><span>:</span> <span>0800</span> <span>80</span> <span>80 800</span><br /><br /> <span>Head office in</span> <span>Moscow</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>095</span> <span>095</span> <span>00</span> <span>00</span><br /><br /> <span>The main office</span> <span>in Kiev</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>098</span> <span>098</span> <span>00</span> <span>00</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295870, 1291295888, 1343664873, 35, 30, 68),
(76, 'Delivery', '', 'dostavka', '', 'support, the, delivery, service, autoworld, around, world, also, possible, all, major, cities, ukraine, and, russia, possibility, courier, your, area, please, call, desired, you, can, pick, purchased, goods, themselves, our, offices', 'We support the delivery of service Autoworld around the world. It is also possible delivery to all major cities of Ukraine and Russia (the possibility of delivery by courier in your area please call 0800820 22 22.) If desired, you can pick up the purchase', '<p><span id="result_box" lang="en"><span>We support the</span> <span>delivery of</span> <span>service</span> <span>Autoworld</span> <span>around the world.</span><br /><br /> <span>It is also possible</span> <span>delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine and Russia</span> <span>(the possibility of</span> <span>delivery</span> <span>by courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span><br /><br /> <span>If desired,</span> <span>you can</span> <span>pick up the</span> <span>purchased goods</span> <span>themselves</span> <span>in our offices.</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295844, 1291295851, 1343664842, 8, 30, 66),
(77, 'Help', '', 'help', '', 'order, purchase, goods, our, store, you, must, follow, few, simple, steps, choose, the, right, product, vospolzovavshit, navigation, left, search, add, products, cart, shopping, select, shipping, method, and, provide, your, contact', 'In order to purchase goods in our store, you must follow a few simple steps: Choose the right product, vospolzovavshit navigation on the left, or search. Add products to cart. Go to the shopping cart, select shipping method and provide your contact inform', '<p><span id="result_box" lang="en"><span>In order to</span> <span>purchase goods</span> <span>in our store,</span> <span>you must follow</span> <span>a few simple steps</span><span>:</span><br /><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Choose</span> <span>the right product,</span> <span>vospolzovavshit</span> <span>navigation</span> <span>on the left</span><span>, or</span> <span>search.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Add products</span> <span>to cart</span><span>.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Go to the</span> <span>shopping cart,</span> <span>select</span> <span>shipping method</span> <span>and provide</span> <span>your contact information.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Proceed to checkout</span> <span>and select the</span> <span>payment method.</span><br /><br /> <span>After that,</span> <span>our managers</span> <span>will contact</span> <span>you and</span> <span>help you</span> <span>with payment</span> <span>and delivery</span> <span>of the goods</span><span>, as well</span> <span>as give advice on</span> <span>any subject.</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1343664897, 11, 30, 67),
(78, 'Payment', '', 'oplata', '', 'our, store, supports, all, currently, available, methods, payment, also, there, possibility, pay, the, courier, for, delivery, major, cities, ukraine, and, russia, ability, your, area, please, call', 'Our store supports all currently available methods of payment. Also there is a possibility to pay the courier for delivery to all major cities of Ukraine and Russia. (ability to pay for the courier in your area please call 0800820 22 22.)', '<p><span id="result_box" lang="en"><span>Our store</span> <span>supports all</span> <span>currently available</span> <span>methods of payment.</span><br /><br /> <span>Also there is</span> <span>a possibility to pay</span> <span>the courier</span> <span>for delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine</span> <span>and Russia.</span> <span>(ability to</span> <span>pay for</span> <span>the courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span></span></p>', '', 0, '', '', 0, 1, 3, 'publish', 'admin', 1291295824, 1291295836, 1343664949, 1, 30, 65),
(79, 'About us', '', 'about', '', 'shop, imagecms, offers, huge, selection, vehicles, suit, every, taste, the, best, prices, our, store, has, more, than, years, and, during, that, time, was, not, single, return, goods, serve, hundreds, customers', 'Shop ImageCMS Shop offers a huge selection of vehicles to suit every taste at the best prices. Our store has more than 5 years and during that time was not a single return of the goods. We serve hundreds of customers every day and do it with joy. Buy equi', '<p><span id="result_box" lang="en"><span>Shop</span> <span>ImageCMS Shop</span> <span>offers</span> <span>a huge selection</span> <span>of vehicles</span> <span>to suit every taste</span> <span>at the best prices</span><span>.</span><br /><br /> <span>Our store</span> <span>has more than</span> <span>5 years</span> <span>and during that time</span> <span>was not a single</span> <span>return of the goods</span><span>.</span><br /><br /> <span>We serve</span> <span>hundreds of</span> <span>customers</span> <span>every day</span> <span>and do</span> <span>it with joy.</span><br /><br /> <span>Buy</span> <span>equipment from</span> <span>us and</span> <span>become the owner of</span> <span>the world''s best</span> <span>technology</span><span>!</span></span></p>', '', 0, '', '', 0, 1, 1, 'publish', 'admin', 1291295776, 1291295792, 1343745649, 5, 30, 64),
(80, 'Site', '', 'o-sajte', '', 'new', 'new', '<p><span id="result_box" lang="en"><span>This is</span> <span>the basic template</span> <span>ImageCMS,</span> <span>which</span> <span>relizovany</span> <span>the following functions</span><span>: display</span> <span>gallery</span><span>, displaying</span> <span>static</span> <span>articles</span><span>, displaying</span> <span>a corporate blog</span><span>, displaying</span> <span>the feedback form.</span><br /><br /> <span>General view of the</span> <span>template, you can</span> <span>edit and</span> <span>change the</span> <span>logo,</span> <span>a graphic</span> <span>box on</span> <span>your</span> <span>case</span><span>.</span><br /><br /> <span>On the left</span> <span>you can see</span> <span>in the sidebar</span> <span>list of</span> <span>categories of</span> <span>the blog,</span> <span>which is easily</span> <span>inserted</span> <span>by using the</span> <span>{sub_category_list ()}</span> <span>in the file</span> <span>main.tpl.</span> <span>Also</span> <span>in the left</span> <span>sidebar</span> <span>is</span> <span>a search form</span> <span>on the site,</span> <span>recent comments</span> <span>widget</span> <span>and the widget</span> <span>tag</span> <span>site.</span> <span>In</span> <span>this</span> <span>sidebar</span> <span>you can also</span> <span>add a widget</span><span>, or</span> <span>the latest</span> <span>popular</span> <span>news,</span> <span>as well as any</span> <span>counters,</span> <span>widgets</span><span>.</span><br /><br /> <span>The top menu</span> <span>is implemented</span> <span>by the module</span> <span>menu</span><span>.</span> <span>And manage</span> <span>its content</span> <span>can be</span> <span>part</span> <span>of the</span> <span>administration</span> <span>in Menu</span> <span>-</span> <span>Main Menu.</span> <span>It</span> <span>is usually</span> <span>possible to add</span> <span>page</span> <span>about the company</span><span>, contacts,</span> <span>services, etc.</span><br /><br /> <span>For more</span> <span>information, contact the</span> <span>official</span> <span>section of the documentation</span><span>: http://www.imagecms.net/wiki</span><br /><br /> <span>Discuss</span> <span>additional opportunities</span><span>, as well as</span> <span>questions about</span> <span>installation, configuration,</span> <span>the system can be</span> <span>on the official forum</span><span>: http://forum.imagecms.net/</span></span></p>', '', 0, 'page_static', '', 0, 1, 0, 'publish', 'admin', 1267203253, 1267203328, 1343722704, 0, 30, 35);

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
('field_doc', 'text', 'Documentation', 'a:4:{s:7:"initial";s:0:"";s:9:"help_text";s:8:"PDF-file";s:19:"enable_file_browser";s:1:"1";s:10:"validation";s:0:"";}', 6, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Структура таблиці `content_fields_groups_relations`
--

CREATE TABLE IF NOT EXISTS `content_fields_groups_relations` (
  `field_name` varchar(64) NOT NULL,
  `group_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `content_fields_groups_relations`
--

INSERT INTO `content_fields_groups_relations` (`field_name`, `group_id`) VALUES
('field_sfsdfsdf', 0),
('field_sfsdfsdf', 11),
('field_fyjtyutyu', 0),
('field_fg12', 9),
('field_fg12', 9),
('field_doc', 11);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп даних таблиці `content_field_groups`
--

INSERT INTO `content_field_groups` (`id`, `name`, `description`) VALUES
(9, 'g1', ''),
(11, 'g4', ''),
(12, 'g3', '');

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
(21, 35, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}'),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

-- --------------------------------------------------------

--
-- Структура таблиці `custom_fields`
--

CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_type_id` int(11) NOT NULL,
  `field_name` varchar(64) NOT NULL,
  `field_label` varchar(64) NOT NULL,
  `field_description` text,
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  `possible_values` text,
  `validators` varchar(255) DEFAULT NULL,
  `field_access_rules` text,
  `entity` varchar(32) DEFAULT NULL,
  `options` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблиці `custom_fields_data`
--

CREATE TABLE IF NOT EXISTS `custom_fields_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `field_data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `custom_fields_data`
--

INSERT INTO `custom_fields_data` (`id`, `field_id`, `entity_id`, `field_data`) VALUES
(1, 2, 1, ''),
(2, 2, 2, ''),
(3, 2, 3, '');

-- --------------------------------------------------------

--
-- Структура таблиці `gallery_albums`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп даних таблиці `gallery_albums`
--

INSERT INTO `gallery_albums` (`id`, `category_id`, `name`, `description`, `cover_id`, `position`, `created`, `updated`, `tpl_file`) VALUES
(19, 1, 'asd', '', 0, 4, 1354637900, NULL, '0'),
(8, 1, 'hjkhj', '', 0, 0, 1354635933, NULL, '0'),
(9, 1, 'sdf', '', 0, 1, 1354636016, NULL, '0'),
(10, 1, 'asd', 'sdf', 0, 2, 1354636058, NULL, '0'),
(11, 1, 'asdasd', '', 0, 3, 1354636132, NULL, '0'),
(12, 1, 'sdfsdf', '', 0, 5, 1354636795, NULL, '0'),
(13, 1, 'sdfsdf', '', 0, 6, 1354637084, NULL, '0'),
(14, 1, 'dfgdfg', '', 0, 7, 1354637130, NULL, '0'),
(15, 1, 'sdf', '', 0, 8, 1354637157, NULL, '0');

-- --------------------------------------------------------

--
-- Структура таблиці `gallery_category`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп даних таблиці `gallery_category`
--

INSERT INTO `gallery_category` (`id`, `name`, `description`, `cover_id`, `position`, `created`) VALUES
(1, 'test category', '', 0, 0, 1264086398),
(2, 'test', 'sd', 0, 1, 1354634866);

-- --------------------------------------------------------

--
-- Структура таблиці `gallery_images`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

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
  PRIMARY KEY (`id`),
  KEY `identif` (`identif`),
  KEY `default` (`default`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп даних таблиці `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `identif`, `image`, `folder`, `template`, `default`) VALUES
(3, 'Русский', 'ru', '', 'russian', 'commerce', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

--
-- Дамп даних таблиці `logs`
--
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп даних таблиці `menus`
--

INSERT INTO `menus` (`id`, `name`, `main_title`, `tpl`, `expand_level`, `description`, `created`) VALUES
(1, 'main_menu', 'Главное меню', 'shop_menu', 0, '', '2012-02-07 15:34:41'),
(4, 'top_menu', 'Top menu', 'top_menu', 0, 'Menu at the top of template', '2012-05-11 14:53:24'),
(5, 'footer_menu', 'Footer menu', 'footer_menu', 0, '', '2012-05-25 11:43:06');

-- --------------------------------------------------------

--
-- Структура таблиці `menus_data`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

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
(28, 5, 0, 'url', '', '', 0, 'Авто музыка и видео', 0, 10, NULL, 'a:2:{s:3:"url";s:34:"/shop/category/avto_muzyka_i_video";s:7:"newpage";s:1:"0";}');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

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
-- Структура таблиці `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп даних таблиці `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `data`) VALUES
(1, 10, 'a:37:{s:9:"cp_access";s:1:"1";s:13:"cp_autoupdate";s:1:"1";s:14:"cp_page_search";s:1:"1";s:11:"lang_create";s:1:"1";s:9:"lang_edit";s:1:"1";s:11:"lang_delete";s:1:"1";s:16:"cp_site_settings";s:1:"1";s:11:"cache_clear";s:1:"1";s:11:"page_create";s:1:"1";s:9:"page_edit";s:1:"1";s:11:"page_delete";s:1:"1";s:15:"category_create";s:1:"1";s:13:"category_edit";s:1:"1";s:15:"category_delete";s:1:"1";s:14:"module_install";s:1:"1";s:16:"module_deinstall";s:1:"1";s:12:"module_admin";s:1:"1";s:13:"widget_create";s:1:"1";s:13:"widget_delete";s:1:"1";s:22:"widget_access_settings";s:1:"1";s:11:"menu_create";s:1:"1";s:9:"menu_edit";s:1:"1";s:11:"menu_delete";s:1:"1";s:11:"user_create";s:1:"1";s:21:"user_create_all_roles";s:1:"1";s:9:"user_edit";s:1:"1";s:11:"user_delete";s:1:"1";s:14:"user_view_data";s:1:"1";s:12:"roles_create";s:1:"1";s:10:"roles_edit";s:1:"1";s:12:"roles_delete";s:1:"1";s:9:"logs_view";s:1:"1";s:13:"backup_create";s:1:"1";s:15:"tinybrowser_all";s:1:"1";s:18:"tinybrowser_upload";s:1:"1";s:16:"tinybrowser_edit";s:1:"1";s:19:"tinybrowser_folders";s:1:"1";}');

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
(1353942341);

-- --------------------------------------------------------

--
-- Структура таблиці `roles`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Дамп даних таблиці `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`, `alt_name`, `desc`) VALUES
(11, 0, 'user', 'Пользователи', ''),
(10, 0, 'admin', 'Администраторы', ''),
(12, 0, 'Manager', 'Менеджеры', '');

-- --------------------------------------------------------

--
-- Структура таблиці `search`
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

-- --------------------------------------------------------

--
-- Структура таблиці `settings`
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
  PRIMARY KEY (`id`),
  KEY `s_name` (`s_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп даних таблиці `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `site_title`, `site_short_title`, `site_description`, `site_keywords`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `google_analytics_id`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`, `lang_sel`, `google_webmaster`, `yandex_webmaster`, `yandex_metric`) VALUES
(2, 'main', 'ImageCMS TEST SITE', 'ImageCMS', 'Продажа качественной техники с гарантией и доставкой', 'магазин техники, покупка техники, доставка техники', 'auto', 'auto', '0', '0', 1, 1, '/', '0', 'commerce', 'no', '', 'module', 69, '63', 'shop', '', '', 'russian_lang', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_banners`
--

CREATE TABLE IF NOT EXISTS `shop_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_banners_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп даних таблиці `shop_banners`
--

INSERT INTO `shop_banners` (`id`, `position`) VALUES
(7, 23),
(8, 24),
(9, 25);

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
(8, 'ru', 'iPhone5', ' ', '/shop/product/apple-iphone-5-16gb-black-slate', '8_.jpg'),
(7, 'ru', 'Epson', ' ', '/shop/brand/epson', '7_.jpg'),
(9, 'ru', 'SonyYamaha', ' ', '/shop/product/71', '9_.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_brands`
--

CREATE TABLE IF NOT EXISTS `shop_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_brands_I_2` (`url`),
  KEY `shop_brands_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Дамп даних таблиці `shop_brands`
--

INSERT INTO `shop_brands` (`id`, `url`, `image`) VALUES
(30, 'pioneer', 'pioneer.png'),
(39, 'motorola', NULL),
(26, 'sony', 'sony.png'),
(27, 'apple', 'apple.png'),
(28, 'samsung', 'samsung.png'),
(29, 'panasonic', 'panasonic.png'),
(34, 'canon', NULL),
(35, 'lg', NULL),
(36, 'yamaha', 'yamaha.png'),
(37, 'epson', NULL),
(38, 'plantronics', NULL);

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
(30, 'ru', 'Pioneer', '<p><span style="font-weight:bold">Pioneer Corporation </span>— производитель электронной и аудио-видеоаппаратуры для дома, автомобиля, коммерческих и промышленных предприятий.&nbsp;Основана в 1938 году в Токио.</p><br>  ', '', '', ''),
(26, 'ru', 'Sony', '<span style="font-weight:bold">Sony Corporation&nbsp;</span>— транснациональная корпорация со штаб-квартирой в Японии, возникшая в 1946 году.  ', '', '', ''),
(27, 'ru', 'Apple', '', '', '', ''),
(28, 'ru', 'Samsung', '<span style="font-weight:bold">Samsung Group </span>&nbsp; — промышленный концерн (группа компаний), один из крупнейших в Южной Корее, основанный в 1938 году. На мировом рынке известен как производитель высокотехнологичных компонентов, телекоммуникационного оборудования, бытовой техники, аудио- и видео устройств.  ', '', '', ''),
(29, 'ru', 'Panasonic', '<span style="font-weight:bold">Panasonic Corporation </span>— крупная японская машиностроительная корпорация, один из крупнейших в мире производителей бытовой техники и электронных товаров.  ', '', '', ''),
(29, 'en', 'Impression Computers', '', '', '', ''),
(26, 'en', 'Hewlett Packard', '', '', '', ''),
(30, 'en', 'Bravo Computers', '', '', '', ''),
(28, 'en', 'Brain', '', '', '', ''),
(27, 'en', 'Apple', '', '', '', ''),
(34, 'ru', 'Canon', ' ', '', '', ''),
(35, 'ru', 'LG', ' ', '', '', ''),
(36, 'ru', 'Yamaha', '<span style="font-weight:bold">Yamaha Corporation </span>— японский концерн, производящий музыкальные инструменты, акустические системы, звуковое оборудование, спортивный инвентарь и многое другое.  ', '', '', ''),
(37, 'ru', 'Epson', ' ', '', '', ''),
(38, 'ru', 'Plantronics', ' ', '', '', ''),
(39, 'ru', 'Motorola', ' ', '', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
(1, 'ru', 'Первая тема'),
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
  PRIMARY KEY (`id`),
  KEY `shop_category_I_2` (`url`),
  KEY `shop_category_I_3` (`active`),
  KEY `shop_category_I_4` (`parent_id`),
  KEY `shop_category_I_5` (`position`),
  KEY `shop_category_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Дамп даних таблиці `shop_category`
--

INSERT INTO `shop_category` (`id`, `url`, `parent_id`, `position`, `full_path`, `full_path_ids`, `active`, `external_id`, `image`, `tpl`, `order_method`, `showsitetitle`) VALUES
(52, 'avto_muzyka_i_video', 0, 7, 'avto_muzyka_i_video', 'a:0:{}', 1, NULL, NULL, '', 1, NULL),
(51, 'bluetooth', 48, 13, 'domashniaia_elektronika/bluetooth', 'a:1:{i:0;i:48;}', 1, NULL, NULL, '', 1, NULL),
(50, 'telefony', 48, 12, 'domashniaia_elektronika/telefony', 'a:1:{i:0;i:48;}', 1, NULL, NULL, '', 1, NULL),
(48, 'domashniaia_elektronika', 0, 11, 'domashniaia_elektronika', 'a:0:{}', 1, NULL, NULL, '', 1, NULL),
(46, 'fotoprintery', 44, 16, 'foto_i_kamery/fotoprintery', 'a:1:{i:0;i:44;}', 1, NULL, NULL, '', 1, NULL),
(45, 'tsifrovye_kamery', 44, 15, 'foto_i_kamery/tsifrovye_kamery', 'a:1:{i:0;i:44;}', 1, NULL, NULL, '', 1, NULL),
(44, 'foto_i_kamery', 0, 14, 'foto_i_kamery', 'a:0:{}', 1, NULL, NULL, '', 1, NULL),
(43, 'saund_bary', 40, 6, 'domashnee_audio/saund_bary', 'a:1:{i:0;i:40;}', 1, NULL, NULL, '', 1, NULL),
(41, 'domashnie_teatry', 40, 5, 'domashnee_audio/domashnie_teatry', 'a:1:{i:0;i:40;}', 1, NULL, NULL, '', 1, NULL),
(40, 'domashnee_audio', 0, 4, 'domashnee_audio', 'a:0:{}', 1, NULL, NULL, NULL, NULL, NULL),
(36, 'video', 0, 0, 'video', 'a:0:{}', 1, NULL, NULL, NULL, NULL, NULL),
(37, 'tv_hdtv', 36, 1, 'video/tv_hdtv', 'a:1:{i:0;i:36;}', 1, NULL, '', '', 0, NULL),
(38, 'dvd_dvr_pleery', 36, 2, 'video/dvd_dvr_pleery', 'a:1:{i:0;i:36;}', 1, NULL, '', '', 0, NULL),
(39, 'blu-ray', 36, 3, 'video/blu-ray', 'a:1:{i:0;i:36;}', 1, NULL, NULL, NULL, NULL, NULL),
(53, 'subwoofer', 52, 8, 'avto_muzyka_i_video/subwoofer', 'a:1:{i:0;i:52;}', 1, NULL, NULL, '', 1, NULL),
(54, 'cd_chendzhery', 52, 9, 'avto_muzyka_i_video/cd_chendzhery', 'a:1:{i:0;i:52;}', 1, NULL, NULL, '', 1, NULL),
(55, 'gps', 52, 10, 'avto_muzyka_i_video/gps', 'a:1:{i:0;i:52;}', 1, NULL, NULL, '', 1, NULL),
(74, 'tv', 37, 17, 'video/tv_hdtv/tv', 'a:2:{i:0;i:36;i:1;i:37;}', 1, NULL, '', '', 0, NULL),
(75, 'hd-tv', 37, 18, 'video/tv_hdtv/hd-tv', 'a:2:{i:0;i:36;i:1;i:37;}', 1, NULL, '', '', 0, NULL);

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
(37, 'ru', 'TV & HDTV', '', ' ', '', '', ''),
(38, 'ru', 'DVD/DVR Плееры', '', '', '', '', ''),
(39, 'ru', 'Blu-Ray Плееры', '', '', '', '', ''),
(53, 'ru', 'Сабвуферы', '', '', '', '', ''),
(54, 'ru', 'CD Ченджеры', '', '', '', '', ''),
(55, 'ru', 'GPS', '', '', '', '', ''),
(37, 'ua', 'TV & HDTV', '', '<p><span style="color: #384654; font-size: 13px; text-align: right; background-color: #f8f8f8;">Описание&nbsp;</span>укр</p>', 'Meta Description укр', 'Meta Title укр', 'Meta Keywords укр'),
(36, 'en', 'Video', '', '', '', '', ''),
(37, 'en', 'TV & HDTV eng', '', '', '', '', ''),
(38, 'en', 'DVD/DVR', '', '', '', '', ''),
(39, 'en', 'Blu-Ray Player', '', '', '', '', ''),
(40, 'en', 'Home audio', '', '', '', '', ''),
(41, 'en', 'Home Theater', '', '', '', '', ''),
(43, 'en', 'Speakers', '', '', '', '', ''),
(44, 'en', 'Photo & Camera', '', '', '', '', ''),
(45, 'en', 'Digital cameras', '', '', '', '', ''),
(46, 'en', 'Photo Printers', '', '', '', '', ''),
(48, 'en', 'Home Electronics', '', '', '', '', ''),
(50, 'en', 'Phones', '', '', '', '', ''),
(51, 'en', 'Bluetooth', '', '', '', '', ''),
(52, 'en', 'Car Tabs', '', '', '', '', ''),
(53, 'en', 'Subwoofers', '', '', '', '', ''),
(54, 'en', 'CD changer ', '', '', '', '', ''),
(55, 'en', 'GPS', '', '', '', '', ''),
(74, 'ru', 'TV', '', ' ', '', '', ''),
(75, 'ru', 'HD TV', '', ' ', '', '', '');

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
  `rate` float(6,3) DEFAULT '1.000',
  PRIMARY KEY (`id`),
  KEY `shop_currencies_I_1` (`name`),
  KEY `shop_currencies_I_2` (`main`),
  KEY `shop_currencies_I_3` (`is_default`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `shop_currencies`
--

INSERT INTO `shop_currencies` (`id`, `name`, `main`, `is_default`, `code`, `symbol`, `rate`) VALUES
(1, 'Dollars', 0, 0, 'USD', '$', 0.400),
(2, 'Ruble', 1, 1, 'RUR', 'RUR', 1.000);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_delivery_methods`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Дамп даних таблиці `shop_delivery_methods`
--

INSERT INTO `shop_delivery_methods` (`id`, `price`, `free_from`, `enabled`, `is_price_in_percent`) VALUES
(7, 0.00, 0.00, 1, 0),
(5, 56.00, 0.00, 1, 0),
(6, 355.00, 0.00, 1, 0);

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
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_delivery_methods_i18n_I_1` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_delivery_methods_i18n`
--

INSERT INTO `shop_delivery_methods_i18n` (`id`, `locale`, `name`, `description`, `pricedescription`) VALUES
(7, 'ru', 'Самовывоз', ' ', ' '),
(5, 'ru', 'Курьером', '<p>Только по Киеву и Москве</p>  ', ' '),
(6, 'ru', 'АвтоМир', '<p>Доставка по всему миру</p>  ', ' '),
(7, 'ua', 'Самовивезення', '', NULL);

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
(5, 4),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(7, 1),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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
  PRIMARY KEY (`id`),
  KEY `shop_kit_FI_1` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп даних таблиці `shop_kit`
--

INSERT INTO `shop_kit` (`id`, `product_id`, `active`, `position`) VALUES
(8, 185, 1, 0),
(9, 96, 1, 0),
(10, 71, 1, 0);

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
(107, 8, '5'),
(100, 9, '40'),
(93, 10, '0');

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
  `gift_cert_price` int(11) DEFAULT NULL,
  `comulativ` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_orders_I_1` (`key`),
  KEY `shop_orders_I_2` (`status`),
  KEY `shop_orders_I_3` (`date_created`),
  KEY `shop_orders_FI_1` (`delivery_method`),
  KEY `shop_orders_FI_2` (`payment_method`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

--
-- Дамп даних таблиці `shop_orders`
--
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
  `quantity` int(11) DEFAULT NULL,
  `kit_id` int(11) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_orders_products_I_1` (`order_id`),
  KEY `shop_orders_products_FI_1` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  ;

--
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп даних таблиці `shop_orders_status_history`
--
-- --------------------------------------------------------

--
-- Структура таблиці `shop_order_statuses`
--

CREATE TABLE IF NOT EXISTS `shop_order_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_order_statuses_I_2` (`position`),
  KEY `shop_order_statuses_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп даних таблиці `shop_order_statuses`
--

INSERT INTO `shop_order_statuses` (`id`, `position`) VALUES
(1, 1),
(2, 99);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп даних таблиці `shop_payment_methods`
--

INSERT INTO `shop_payment_methods` (`id`, `active`, `currency_id`, `position`, `payment_system_name`) VALUES
(1, 1, 1, 0, 'WebMoneySystem'),
(2, 1, 2, 1, 'OschadBankInvoiceSystem'),
(3, 1, 2, 2, 'SberBankInvoiceSystem'),
(4, 1, 2, 3, 'RobokassaSystem');

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
  `tpl` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_products_I_2` (`url`),
  KEY `shop_products_I_3` (`brand_id`),
  KEY `shop_products_I_4` (`category_id`),
  KEY `shop_products_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Дамп даних таблиці `shop_products`
--

INSERT INTO `shop_products` (`id`, `url`, `active`, `hit`, `brand_id`, `category_id`, `related_products`, `mainImage`, `smallImage`, `created`, `updated`, `old_price`, `views`, `hot`, `action`, `added_to_cart_count`, `enable_comments`, `external_id`, `mainModImage`, `smallModImage`, `tpl`, `user_id`) VALUES
(71, '71', 1, 1, 26, 74, '96', '71_main.jpg', '71_mainMod.jpg', 1307542725, 1355746808, 1150.00, 188, 1, 1, 1, 1, NULL, '71_mainMod.jpg', '71_smallMod.jpg', '', NULL),
(96, '96', 1, 1, 0, 45, '100', '96_main.jpg', '96_mainMod.jpg', 1307542081, 1355747493, 0.00, 6, NULL, NULL, NULL, 1, NULL, '96_mainMod.jpg', '96_smallMod.jpg', '', NULL),
(78, '78', 1, NULL, 29, 38, '', '78_main.jpg', '78_mainMod.jpg', 1307543572, 1355746200, 0.00, 11, NULL, NULL, 2, 1, NULL, '78_mainMod.jpg', '78_smallMod.jpg', '', NULL),
(79, '79', 1, NULL, 29, 38, '', '79_main.jpg', '79_mainMod.jpg', 1307544450, 1355746249, 0.00, 9, 1, NULL, 1, 1, NULL, '79_mainMod.jpg', '79_smallMod.jpg', '', NULL),
(81, '81', 1, 1, 28, 38, '', '81_main.jpg', '81_mainMod.jpg', 1307544442, 1355747465, 0.00, 24, 1, 1, 17, 1, NULL, '81_mainMod.jpg', '81_smallMod.jpg', '', NULL),
(82, '82', 1, NULL, 28, 39, '', '82_main.jpg', '82_small.jpg', 1307542064, 1355495998, 0.00, 10, NULL, 1, NULL, 1, NULL, '82_mainMod.jpg', '82_smallMod.jpg', '', NULL),
(83, '83', 1, NULL, 26, 39, '', '83_main.jpg', '83_small.jpg', 1307545378, 1355496017, 0.00, 7, NULL, 1, 2, 1, NULL, '83_mainMod.jpg', '83_smallMod.jpg', '', NULL),
(84, '84', 1, NULL, 29, 39, '', '84_main.jpg', '84_small.jpg', 1307541602, 1355496060, 0.00, NULL, NULL, 1, NULL, 1, NULL, '84_mainMod.jpg', '84_smallMod.jpg', '', NULL),
(85, '85', 1, NULL, 0, 39, '', '85_main.jpg', '85_small.jpg', 1307544238, 1355496085, 0.00, 5, NULL, NULL, NULL, 1, NULL, '85_mainMod.jpg', '85_smallMod.jpg', '', NULL),
(86, '86', 1, NULL, 28, 39, '', '86_main.jpg', '86_small.jpg', 1307545023, 1355496108, 0.00, 8, NULL, NULL, NULL, 1, NULL, '86_mainMod.jpg', '86_smallMod.jpg', '', NULL),
(87, '87', 1, NULL, 26, 41, '', '87_main.jpg', '87_mainMod.jpg', 1307541766, 1355746473, 0.00, 33, NULL, NULL, 2, 1, NULL, '87_mainMod.jpg', '87_smallMod.jpg', '', NULL),
(88, '88', 1, NULL, 28, 41, '', '88_main.jpg', '88_small.jpg', 1307544977, 1355496171, 0.00, 22, NULL, NULL, NULL, 1, NULL, '88_mainMod.jpg', '88_smallMod.jpg', '', NULL),
(95, '95', 1, NULL, 0, 45, '', '95_main.jpg', '95_small.jpg', 1307542081, 1355496317, 0.00, 4, NULL, NULL, NULL, 1, NULL, '95_mainMod.jpg', '95_smallMod.jpg', '', NULL),
(89, '89', 1, NULL, 29, 41, '', '89_main.jpg', '89_small.jpg', 1307541636, 1355496361, 0.00, 6, NULL, NULL, NULL, 1, NULL, '89_mainMod.jpg', '89_smallMod.jpg', '', NULL),
(90, '90', 1, NULL, 28, 41, '', '90_main.jpg', '90_small.jpg', 1307543337, 1355496381, 0.00, 4, NULL, NULL, 1, 1, NULL, '90_mainMod.jpg', '90_smallMod.jpg', '', NULL),
(91, '91', 1, NULL, 26, 41, '', '91_main.jpg', '91_small.jpg', 1307544214, 1355496404, 0.00, 2, NULL, NULL, NULL, 1, NULL, '91_mainMod.jpg', '91_smallMod.jpg', '', NULL),
(92, '92', 1, NULL, 28, 43, '', '92_main.jpg', '92_small.jpg', 1307544791, 1355496417, 0.00, 1, NULL, NULL, 1, 1, NULL, '92_mainMod.jpg', '92_smallMod.jpg', '', NULL),
(93, '93', 1, NULL, 36, 43, '', '93_main.jpg', '93_small.jpg', 1307542628, 1355496427, 0.00, 3, NULL, NULL, 1, 1, NULL, '93_mainMod.jpg', '93_smallMod.jpg', '', NULL),
(94, '94', 1, 1, 36, 43, '', '94_main.jpg', '94_small.jpg', 1307544425, 1355496438, 0.00, 43, 1, 1, 2, 1, NULL, '94_mainMod.jpg', '94_smallMod.jpg', '', NULL),
(97, '97', 1, NULL, 26, 45, '', '97_main.jpg', '97_small.jpg', 1307541628, 1355496499, 0.00, 35, NULL, NULL, NULL, 1, NULL, '97_mainMod.jpg', '97_smallMod.jpg', '', NULL),
(98, '98', 1, 1, 28, 45, '', '98_main.jpg', '98_small.jpg', 1307542730, 1355496515, 0.00, 19, NULL, NULL, NULL, 1, NULL, '98_mainMod.jpg', '98_smallMod.jpg', '', NULL),
(99, '99', 1, NULL, 28, 45, '', '99_main.jpg', '99_small.jpg', 1307543877, 1355496240, 0.00, 7, NULL, NULL, NULL, 1, NULL, '99_mainMod.jpg', '99_smallMod.jpg', '', NULL),
(100, '100', 1, NULL, 0, 46, '', '100_main.jpg', '100_small.jpg', 1307543018, 1355744136, 0.00, 56, NULL, NULL, 4, 1, NULL, '100_mainMod.jpg', '100_smallMod.jpg', '', NULL),
(101, '101', 1, NULL, 0, 46, '', '101_main.jpg', '101_small.jpg', 1307543107, 1355496292, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '101_mainMod.jpg', '101_smallMod.jpg', '', NULL),
(102, '102', 1, 1, 37, 46, '', '102_main.jpg', '102_small.jpg', 1307545161, 1355844036, 550.00, 21, 0, 1, 1, 1, NULL, '102_mainMod.jpg', '102_smallMod.jpg', '', NULL),
(103, '103', 1, 1, 37, 46, '', '103_main.jpg', '103_small.jpg', 1307543901, 1355844048, 86.00, NULL, 0, 1, NULL, 1, NULL, '103_mainMod.jpg', '103_smallMod.jpg', '', NULL),
(104, '104', 1, 1, 37, 46, '', '104_main.jpg', '104_small.jpg', 1307543227, 1355844058, 800.00, NULL, 0, 1, NULL, 1, NULL, '104_mainMod.jpg', '104_smallMod.jpg', '', NULL),
(105, '105', 1, NULL, 29, 50, '', '105_main.jpg', '105_small.jpg', 1307543429, 1355497850, 0.00, 7, NULL, NULL, 2, 1, NULL, '105_mainMod.jpg', '105_smallMod.jpg', '', NULL),
(106, '106', 1, 1, 29, 50, '', '106_main.jpg', '106_small.jpg', 1307543089, 1355763302, 0.00, 27, NULL, NULL, 2, 1, NULL, '106_mainMod.jpg', '106_smallMod.jpg', '', NULL),
(107, '107', 1, NULL, 0, 51, '', '107_main.jpg', '107_small.jpg', 1307541701, 1355496710, 0.00, 4, NULL, NULL, NULL, 1, NULL, '107_mainMod.jpg', '107_smallMod.jpg', '', NULL),
(108, '108', 1, 1, 0, 51, '', '108_main.jpg', '108_small.jpg', 1307544069, 1355496690, 0.00, 133, NULL, NULL, 5, 1, NULL, '108_mainMod.jpg', '108_smallMod.jpg', '', NULL),
(109, '109', 1, NULL, 29, 50, '', '109_main.jpg', '109_small.jpg', 1307544627, 1355496650, 0.00, 2, NULL, NULL, 1, 1, NULL, '109_mainMod.jpg', '109_smallMod.jpg', '', NULL),
(110, '110', 1, NULL, 0, 51, '', '110_main.jpg', '110_small.jpg', 1307543831, 1355496634, 0.00, 5, NULL, NULL, 2, 1, NULL, '110_mainMod.jpg', '110_smallMod.jpg', '', NULL),
(111, '111', 1, NULL, 0, 51, '', '111_main.jpg', '111_small.jpg', 1307543077, 1355496626, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '111_mainMod.jpg', '111_smallMod.jpg', '', NULL),
(112, '112', 1, NULL, 39, 51, '', '112_main.jpg', '112_small.jpg', 1307543753, 1355496967, 0.00, 5, NULL, NULL, 1, 1, NULL, '112_mainMod.jpg', '112_smallMod.jpg', '', NULL),
(113, '113', 1, NULL, 35, 51, '', '113_main.jpg', '113_small.jpg', 1307542831, 1355496921, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '113_mainMod.jpg', '113_smallMod.jpg', '', NULL),
(114, '114', 1, NULL, 28, 51, '', '114_main.jpg', '114_small.jpg', 1307543699, 1355496903, 0.00, 1, NULL, NULL, NULL, 1, NULL, '114_mainMod.jpg', '114_smallMod.jpg', '', NULL),
(115, '115', 1, NULL, 30, 53, '', '115_main.jpg', '115_small.jpg', 1307543689, 1355496893, 0.00, 15, NULL, NULL, 1, 1, NULL, '115_mainMod.jpg', '115_smallMod.jpg', '', NULL),
(116, '116', 1, NULL, 0, 53, '', '116_main.jpg', '116_small.jpg', 1307542992, 1355496886, 0.00, NULL, NULL, NULL, 1, 1, NULL, '116_mainMod.jpg', '116_smallMod.jpg', '', NULL),
(117, '117', 1, NULL, 0, 53, '', '117_main.jpg', '117_small.jpg', 1307542495, 1355496876, 0.00, NULL, NULL, NULL, NULL, 1, NULL, '117_mainMod.jpg', '117_smallMod.jpg', '', NULL),
(118, '118', 1, NULL, 30, 53, '', '118_main.jpg', '118_small.jpg', 1307543269, 1355496864, 0.00, 1, NULL, NULL, NULL, 1, NULL, '118_mainMod.jpg', '118_smallMod.jpg', '', NULL),
(119, '119', 1, 1, 30, 53, '', '119_main.jpg', '119_small.jpg', 1307543316, 1355496856, 0.00, 7, NULL, NULL, NULL, 1, NULL, '119_mainMod.jpg', '119_smallMod.jpg', '', NULL),
(120, '120', 1, NULL, 30, 54, '', '120_main.jpg', '120_small.jpg', 1307542029, 1355496824, 0.00, 8, NULL, NULL, 2, 1, NULL, '120_mainMod.jpg', '120_smallMod.jpg', '', NULL),
(121, '121', 1, NULL, 30, 54, '', '121_main.jpg', '121_small.jpg', 1307543909, 1355497245, 0.00, 5, NULL, NULL, 2, 1, NULL, '121_mainMod.jpg', '121_smallMod.jpg', '', NULL),
(122, '122', 1, NULL, 29, 54, '', '122_main.jpg', '122_small.jpg', 1307543511, 1355497077, 0.00, 1, NULL, NULL, 2, 1, NULL, '122_mainMod.jpg', '122_smallMod.jpg', '', NULL),
(123, '123', 1, NULL, 0, 54, '', '123_main.jpg', '123_small.jpg', 1307543925, 1355497060, 0.00, 25, NULL, NULL, 1, 1, NULL, '123_mainMod.jpg', '123_smallMod.jpg', '', NULL),
(124, '124', 1, NULL, 0, 54, '', '124_main.jpg', '124_small.jpg', 1307542680, 1355497269, 0.00, NULL, NULL, NULL, 1, 1, NULL, '124_mainMod.jpg', '124_smallMod.jpg', '', NULL),
(185, 'apple-iphone-5-16gb-black-slate', 1, NULL, 27, 50, '108,111,107', '185_main.jpg', '185_small.jpg', 1355428800, 1355499129, 0.00, 16, NULL, NULL, 3, 1, NULL, '185_mainMod.jpg', '185_smallMod.jpg', '', NULL),
(186, 'samsung-ue32eh4030wxua', 1, NULL, 0, 74, '', '186_main.jpg', '186_mainMod.jpg', 1355688000, 1355745194, 0.00, 8, NULL, NULL, NULL, 1, NULL, '186_mainMod.jpg', '186_smallMod.jpg', '', NULL),
(187, 'samsung-ue40es6307uxua', 1, NULL, 28, 74, '', '187_main.jpg', '187_mainMod.jpg', 1355688000, 1355745685, 0.00, 1, NULL, NULL, NULL, 1, NULL, '187_mainMod.jpg', '187_smallMod.jpg', '', NULL),
(188, 'lg-32ls359t', 1, NULL, 29, 74, '', '188_main.jpg', '188_mainMod.jpg', 1355688000, 1355746100, 0.00, 6, NULL, NULL, NULL, 1, NULL, '188_mainMod.jpg', '188_smallMod.jpg', '', NULL),
(189, 'lg-47lm580t', 1, 1, 35, 75, '', '189_main.jpg', '189_mainMod.jpg', 1355688000, 1355750041, 0.00, 2, 1, 1, NULL, 1, NULL, '189_mainMod.jpg', '189_smallMod.jpg', '', NULL),
(190, 'samsung-le40d550k1wxua', 1, 1, 28, 75, '', '190_main.jpg', '190_mainMod.jpg', 1355688000, 1355747897, 0.00, 3, NULL, NULL, NULL, 1, NULL, '190_mainMod.jpg', '190_smallMod.jpg', '', NULL),
(191, 'sony-kdl-22ex553', 1, NULL, 26, 75, '', '191_main.jpg', '191_mainMod.jpg', 1355688000, 1355749805, 0.00, 2, 1, 1, NULL, 1, NULL, '191_mainMod.jpg', '191_smallMod.jpg', '', NULL);

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
(71, 'ru', 'Sony KDL46EX710', 'ЖК ТВ: технология Motionflow 100Hz, эко-функции, экран с Edge LED, \nдиагональ 117 см / 46, Full HD 1080, Wireless LAN Ready  ', '<p><strong>Множество функций для вашего отдыха</strong><br>\nСупертонкий <strong>EX710</strong> очень просто перемещать из комнаты в комнату. \nВеликолепное ТВ-изображение и потрясающий просмотр в Full HD. Дизайн без\n лишних проводов для удобного размещения в любом пространстве. \nОнлайн-развлечения для приятного отдыха на многие часы. Отличные функции\n и экономия электричества.<br>\n<br>\n<strong>Потрясающий просмотр в качестве Full HD</strong><br>\nПередовая технология подсветки Edge LED помогает реализовывать \nбесподобное качество изображения в ультра-тонком корпусе. Технология \nMotionflow 100Hz позволяет добиться бесподобной контрастности и \nчеткости, а также насыщенных цветов и плавного отображения динамичных \nсцен – максимум удовольствия от любимых фильмов и видеоигр.<br>\n<br>\n<strong>Порядок без проводов</strong><br>\nЭта модель позволит сэкономить место в доме. Тонкий корпус с гладкими \nповерхностями идеально впишется в интерьер вашей комнаты. Телевизор \nтакже предусматривает соединение по Wi-Fi, что позволит подключиться к \nИнтернету, без использования неприглядных проводов.<br>\n<br>\n<strong>Развлечения и экономия электроэнергии</strong><br>\nДанная модель позволяет экономить электричество. Датчик присутствия \nопределяет, когда в комнате никого нет, и выключает телевизор \nавтоматически. Датчик освещения автоматически подбирает оптимальные \nнастройки яркости изображения в соответствии с освещением и экономит \nэлектроэнергию при низком освещении.  </p>  ', '', '', ''),
(96, 'ru', 'Canon VIXIA HF R11 Digital', '<strong>Тип</strong>:  компактный, <strong>\nКоличество мегапикселей</strong>:  12,1, <strong>\nОптическое увеличение</strong>:  5, <strong>\nСлот для карт памяти</strong>:  SD, SDHC, SDXC, <strong>\nПитание</strong>:  Li-Ion аккумулятор, <strong>\nВес, г</strong>:  198  ', '<br><h3>Система HS&nbsp;</h3>\n  <p>В представленной модели установлена \nспециальная система HS, в которую входят процессор DIGIC 5 и \n12,1-мегапиксельный сенсор. Их совместная работа обеспечивает фото с \nнизким уровнем шума, высокой детализацией и естественной цветопередачей.\n Вы получите великолепный результат и при плохом освещении без \nиспользования штатива и вспышки.&nbsp;</p>\n  <h3>Универсальный объектив</h3>\n  <p>В отзывах о Canon PowerShot S100 \nSilver упоминают и об универсальных возможностях объектива. \n24-миллиметровый широкоугольный объектив легко справится и с пейзажами, и\n с портретами, и с макросъемкой, а 5-кратный зум приблизит удаленные \nобъекты. Благодаря интеллектуальному стабилизатору изображения камера \nавтоматически выберет наиболее подходящий режим оптической стабилизации \nиз 7-ми возможных вариантов.&nbsp;&lt;p&gt;&lt;a \nhref="http://repka.ua/products/cifrovye-fotoapparaty/canon-powershot-s100-silver/42633.html?gclid=CM2qwKHIl7QCFYJP3godkBEAfA"&gt;.&lt;/a&gt;&lt;/p&gt;</p>  ', '', '', ''),
(78, 'ru', 'Panasonic DVD-S58 DVD Player', 'DVD-S58 - DVD-плеер с функцией VIERA Link&nbsp; для домашнего использования.  ', '<p>DVD-S58 - DVD-плеер с функцией VIERA Link&nbsp; для домашнего использования.\n<br>\n<br>\n • Высококачественное изображение:\n<br>\n С технологией 1080p Up-Conversion и цифроаналоговым преобразователем видеосигнала 108 МГц/12 бит \n<br>\n С прогрессивной разверткой и цифроаналоговым преобразователем видеосигнала 108 МГц/12 бит <strong> \n  <br>\n  <br>\n </strong>• Слайд-шоу JPEG с музыкой MP3 \n<br>\n<br>\n • HDMI-CEC (всего один пульт ДУ) <strong>\n  </strong>  </p>  ', '', '', ''),
(79, 'ru', 'Panasonic DVD-S38 DVD', 'DVD-S38 - DVD-плеер&nbsp; для домашнего использования.  ', '<p>DVD-S38 - DVD-плеер&nbsp; для домашнего использования.\n<br>\n<br>\n • Высококачественное изображение: \n<br>\n С технологией 1080p Up-Conversion и цифроаналоговым преобразователем видеосигнала 108 МГц/12 бит \n<br>\n С прогрессивной разверткой и цифроаналоговым преобразователем видеосигнала 108 МГц/12 бит \n<br>\n<br>\n • Слайд-шоу JPEG с музыкой MP3 \n<br>\n<br>\n • Экологичные материалы и компактный дизайн (ширина 360 мм) <strong>\n  </strong>  </p>  ', '', '', ''),
(81, 'ru', 'Samsung DVD-H1080 - 1080p', 'DVD-плеер/выход HDMI/воспроизведение с USB-накопителей/поддержка видео в формате MPEG4, DivX  ', '<p>Чем занять выдавшийся свободным вечер? Посмотреть телевизор? Но там, как\n назло, нет ничего интересного. Сходить в гости? Но на улице холодно и \nветрено. А может, взять свежий DVD с фильмом и насладиться хорошим кино?\n Было бы неплохо, но вот беда — у вас все еще нет DVD-проигрывателя и вы\n смотрите кассеты на допотопном видеомагнитофоне. Значит, надо срочно \nобзаводиться более прогрессивным устройством. Ну а как же запись любимых\n телепередач, которые идут именно тогда, когда вы заняты? Как же старые \nвидеоархивы? Все решаемо, ведь современный DVD-проигрыватель — это не \nобязательно только воспроизведение DVD-дисков. Есть модели, совмещенные с\n классическим видеомагнитофоном; устройства, способные самостоятельно \nзаписывать DVD-диски; аппараты, оснащенные жесткими дисками для записи \nтелевизионных программ. Осталось только определиться, что вам нужно, и \nсделать правильный выбор.<br>\n<br>\nDVD – формат оптических носителей последнего поколения. DVD-диски \nзначительно объемнее и быстрее, чем обычные CD. Они могут содержать \nвидеоматериалы кинотеатрального качества, музыкальные файлы, цифровые \nфотографии и компьютерные данные. Цель DVD – объединить мультимедиа, \nкомпьютерную и деловую информацию в одном универсальном формате. DVD уже\n практически вытеснил лазерные диски, видеокассеты и игровые картриджи \nи, возможно, в скором будущем вытеснит и CD-диски. Формат DVD обладает \nширокой поддержкой среди основных производителей электроники и \nкомпьютерных изделий, а также среди звукозаписывающих и кино- студий. По\n этой причине DVD завоевал столь огромную популярность среди покупателей\n и стал самым распространенным форматом всего за три года. К 2003 году, \nза шесть лет существования, в мире насчитывалось уже более 250 миллионов\n DVD-устройств: DVD-плееры, рекордеры, компьютерные DVD-приводы и \nигровые приставки, - что сделало DVD передовым стандартом \nвидеоиндустрии.  </p>  ', '', '', ''),
(82, 'ru', 'Samsung BD-C5500 Blu-ray', 'Тип оборудования Blu-ray плеер \nЦвета, использованные в оформлении черный \nМеханизм загрузки дисков лоток \nПоддерживаемые типы дисков (воспроизведение) CD-R, CD-RW, DVD-R, DVD+R, DVD-RW, DVD+RW, BD-R, BD-RE \nПоддерживаемые размеры дисков 12 см, 8 см \nРазъемы и выходы\nРазъемы на передней панели USB 2.0 Type A  ', '<p>Чем занять выдавшийся свободным вечер? Посмотреть телевизор? Но там, как\n назло, нет ничего интересного. Сходить в гости? Но на улице холодно и \nветрено. А может, взять свежий DVD с фильмом и насладиться хорошим кино?\n Было бы неплохо, но вот беда — у вас все еще нет DVD-проигрывателя и вы\n смотрите кассеты на допотопном видеомагнитофоне. Значит, надо срочно \nобзаводиться более прогрессивным устройством. Ну а как же запись любимых\n телепередач, которые идут именно тогда, когда вы заняты? Как же старые \nвидеоархивы? Все решаемо, ведь современный DVD-проигрыватель — это не \nобязательно только воспроизведение DVD-дисков. Есть модели, совмещенные с\n классическим видеомагнитофоном; устройства, способные самостоятельно \nзаписывать DVD-диски; аппараты, оснащенные жесткими дисками для записи \nтелевизионных программ. Осталось только определиться, что вам нужно, и \nсделать правильный выбор.<br>\n<br>\nDVD – формат оптических носителей последнего поколения. DVD-диски \nзначительно объемнее и быстрее, чем обычные CD. Они могут содержать \nвидеоматериалы кинотеатрального качества, музыкальные файлы, цифровые \nфотографии и компьютерные данные. Цель DVD – объединить мультимедиа, \nкомпьютерную и деловую информацию в одном универсальном формате. DVD уже\n практически вытеснил лазерные диски, видеокассеты и игровые картриджи \nи, возможно, в скором будущем вытеснит и CD-диски. Формат DVD обладает \nширокой поддержкой среди основных производителей электроники и \nкомпьютерных изделий, а также среди звукозаписывающих и кино- студий. По\n этой причине DVD завоевал столь огромную популярность среди покупателей\n и стал самым распространенным форматом всего за три года. К 2003 году, \nза шесть лет существования, в мире насчитывалось уже более 250 миллионов\n DVD-устройств: DVD-плееры, рекордеры, компьютерные DVD-приводы и \nигровые приставки, - что сделало DVD передовым стандартом \nвидеоиндустрии.  <br></p>  ', '', '', ''),
(83, 'ru', 'Sony BDP-S470 Network', 'Проигрыватель Blu-ray дисков SONY BDP-S470 B -Сверхсовременный \nвысококачественный проигрыватель дисков Blu-ray Sony , позволяющий \nвоспроизводить как обычные диски Blu-ray, так и диски Blu-ray 3D — с \n3D-видео.  ', '<p>Плеер дисков Blu-ray Disc 3D Ready с мгновенным доступом к онлайн-видеоматериалам!<br>\nBRAVIA Internet Video, Wireless LAN ready, Entertainment Database Browser с Gracenote.<br>\nЕдиное дизайнерское решение с линейкой техники домашних развлечений<br>\nМгновенный доступ к бесплатным фильмам и другому онлайн-содержимому<br>\niPhone/iPod touch для управления Blu-ray Disc<br>\nДомашние развлечения нового поколения, в том числе потрясающая 3D-динамика на экране 3D-телевизора.<br>\nАбсолютно новая модель плеера Blu-ray Disc: доступ к онлайн-контенту, работа с ПК и беспроводное подключение к Интернету.<br>\nDLNA — позволяет плееру Sony Blu-ray Disc Player обмениваться \nинформацией с другими DLNA-устройствами в доме и создавать домашнюю сеть\n для цифровых материалов. <br>\nНовый дизайн 2010 г. BRAVIA Monolith: превосходные материалы и стильный \nминималистичный внешний вид. Подберите к своему телевизору BRAVIA и \nдомашнему кинотеатру плеер Blu-ray Disc в едином стиле.<br>\nФункция BRAVIA Internet Video — это доступ к онлайн-контенту. Смотрите \nтелевизор так, как вы сами пожелаете с функцией просмотра пропущенных \nпрограмм. Находите любимые записи в Интернете на таких интернет-сайтах \nпо запросу, как YouTube и Dailymotion.<br>\nФункция WLAN ready позволяет выходить в сеть без проводов: просто \nподключите ключ USB WIFI (приобретается дополнительно) — и вы в сети \nодним нажатием кнопки<br>\nПолный контроль при помощи iPhone: управление работой плеера Blu-ray \nDisc, просмотр информации на диске и поиск связанного контента на \nYoutube — все это при помощи интерфейса на вашем сенсорном экране.<br>\nСверхбыстрая скорость работы: включение за 3 секунды, открытие лотка за 2 секунды и ускоренная загрузка.<br>\nПросмотр фильмов Blu-ray Disc в формате Full HD 1080p и улучшенный просмотр фильмов из вашей DVD-коллекции.<br>\nУзнать дополнительную информацию о фильме с диска Blu-ray Disc вы можете\n с помощью браузера по базе данных развлечений (Entertainment Database \nBrowser) с технологией Gracenote.  </p>  ', '', '', ''),
(84, 'ru', 'Panasonic DMP-BD45 Ultra-Fast', '<div>\n                <div>\n                Проигрыватели Blu-ray Panasonic&nbsp;DMP-BD45 Ultra-Fast  </div></div>  ', '<p>Процессор цветности PHL Reference Chroma Plus<br>\nPHL Reference Chroma Processor Plus - это высококачественная \nинтегральная схема, созданная для точной обработки каждого пикселя \nBlu-Ray видеосигнала в вертикальном направлении. Она воспроизводит \nцветовую информацию с удвоенной точностью по сравнению с обычными \nсистемами, чтобы поддерживать достоверность и резкость цветопередачи.<br>\n<br>\nСверхбыстрая 0, 5-сек загрузка<br>\nВремя перехода из режима ожидания в рабочий режим значительно \nсократилось по сравнению с прежними моделями. Благодаря этому \nусовершенствованию вы сможете быстрее начать просмотр, не теряя времени \nна ожидание.  </p>  ', '', '', ''),
(85, 'ru', 'LG BD570 Network Audio', 'Програвач BD LG BD570 (V-DAC 162 МГц/12bit, A-DAC 192 кГц/24bit, \n1080p/60 Гц, BD-ROM, BD-R, BD-RE, DVD-R/RW, DVD+R/RW, CD-R/RW, MP3, WMA,\n JPEG, DivX, XviD, MKV(H.264), AVCHD, Dolby True HD/DTS HD MA/DTS / \nDolby Digital, BD Live 2.0, Gracenote, NetCast (Youtube, Picassa, \nAccuWeather), DLNA/CIFS, HDMI 1.3, USB 2.0, Подкючение внешнего HDD, 430\n х 45 х...  ', '<p>LG BD570 является необычным Blu-ray плеером: встроенный модуль \nбеспроводной связи Wi-Fi позволяет новой модели подключаться к домашней \nбеспроводной сети и Интернету, расширяя тем самым возможности домашних \nразвлечений.<br>\n“Люди не должны ограничивать себя только просмотром фильмов, которые \nвыходят на дисках, - сказал Саймон Канг (Simon Kang), исполнительный \nдиректор и президент компании LG Home Entertainment. – Они должны иметь \nдоступ к дополнительному медиа контенту из Интернета. Мы добавили в \nBD570 эту возможность, позволяющую передавать большой объем аудио-, \nвидеофайлов и прочих развлечений прямо на экран телевизора”.<br>\n<br>\nБеспроводный доступ в Интернет, который обеспечивает новая модель \nBlu-Ray проигрывателя LG, позволяет его владельцам смотреть потоковое \nвидео с сайта YouTube или фотографии из веб- альбома Picasa на большом \nэкране Full HD телевизора, а не на маленьком экране компьютерного \nмонитора. Также с помощью BD570 можно дополнить содержимое Blu- Ray \nдиска, загрузив дополнительную информацию через профиль BD Live 2. 0. \nБеспроводное подключение обеспечивает удобный доступ к информационным \nсайтам, например прогнозу погоды от Accuweather, а благодаря интуитивно \nпонятному интерфейсу пользоваться BD570 сможет даже ребенок.<br>\n<br>\n<br>\nВо многих семьях накопились уже целые медиа- библиотеки, состоящие из \nбольшого числа фильмов, музыки, домашнего видео и фотографий. BD570 \nпомогает собрать подобные медиа- файлы воедино, подключаясь ко всем \nкомпьютерам или DNLA- совместимым устройствам хранения данных, входящим в\n домашнюю сеть, посредством Wi- Fi и позволяет просматривать всю эту \nинформацию на экране телевизора. Также плеер способен воспроизводить \nфильмы в формате DivX или MKV непосредственно с внешних жестких дисков \nили флэш- накопителей, подключенных по USB.<br>\n<br>\nИнтерфейс HDMI позволяет подключать LG BD570 к большинству современных \nтелевизоров с помощью единственного кабеля, обеспечивая зрителям \nмаксимально качественное изображение как при воспроизведении Blu- Ray \nдисков, так и обычных DVD, которые он декодирует в разрешении до 1080p.  </p>  ', '', '', ''),
(86, 'ru', 'Samsung BD-C6900 1080p 3D Blu-ray', 'Програвач Blu-ray Samsung BD-C6900 (3D Blu-ray, BD-R/RE, DVD-Video, \nDVD/DVD±R/DVD±RW, USB Storage, MPEG2, H.264,VC-1, AVCHD, DivX HD, MKV, \nMP4, WMV9, HD JPEG, Internet@TV, All Share Ethernet, HDMI (V.1.4 + \n3D)430 x 205 x 43/1,8кг, чорний)  ', '<br><div>\nЧем занять выдавшийся свободным вечер? Посмотреть телевизор? Но там, как\n назло, нет ничего интересного. Сходить в гости? Но на улице холодно и \nветрено. А может, взять свежий DVD с фильмом и насладиться хорошим кино?\n Было бы неплохо, но вот беда — у вас все еще нет DVD-проигрывателя и вы\n смотрите кассеты на допотопном видеомагнитофоне. Значит, надо срочно \nобзаводиться более прогрессивным устройством. Ну а как же запись любимых\n телепередач, которые идут именно тогда, когда вы заняты? Как же старые \nвидеоархивы? Все решаемо, ведь современный DVD-проигрыватель — это не \nобязательно только воспроизведение DVD-дисков. Есть модели, совмещенные с\n классическим видеомагнитофоном; устройства, способные самостоятельно \nзаписывать DVD-диски; аппараты, оснащенные жесткими дисками для записи \nтелевизионных программ. Осталось только определиться, что вам нужно, и \nсделать правильный выбор.<br>\n<br>\nDVD – формат оптических носителей последнего поколения. DVD-диски \nзначительно объемнее и быстрее, чем обычные CD. Они могут содержать \nвидеоматериалы кинотеатрального качества, музыкальные файлы, цифровые \nфотографии и компьютерные данные. Цель DVD – объединить мультимедиа, \nкомпьютерную и деловую информацию в одном универсальном формате. DVD уже\n практически вытеснил лазерные диски, видеокассеты и игровые картриджи \nи, возможно, в скором будущем вытеснит и CD-диски. Формат DVD обладает \nширокой поддержкой среди основных производителей электроники и \nкомпьютерных изделий, а также среди звукозаписывающих и кино- студий. По\n этой причине DVD завоевал столь огромную популярность среди покупателей\n и стал самым распространенным форматом всего за три года. К 2003 году, \nза шесть лет существования, в мире насчитывалось уже более 250 миллионов\n DVD-устройств: DVD-плееры, рекордеры, компьютерные DVD-приводы и \nигровые приставки, - что сделало DVD передовым стандартом \nвидеоиндустрии.</div>  ', '', '', ''),
(87, 'ru', 'Sony HT-SS370 Home Theater', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(88, 'ru', 'Samsung HW-C770BS 7.1 Channel', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(95, 'ru', 'Canon EOS Rebel T2i 18 Megapixel Digital', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(89, 'ru', 'Panasonic SCPTX7 Home Theater', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(90, 'ru', 'Samsung HT-C7530W 5.1 Channel', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(91, 'ru', 'Sony BDV-E770W Home Theater', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(92, 'ru', 'Samsung HW-C700 7.2 Channel', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(93, 'ru', 'Yamaha HS80M Powered Speaker', 'Изящные спикеры с белым конусом, используемые в мониторах HS-ряда \nобеспечивают превосходное звучание, которое улучшено тщательно \nспроектируемым корпусом  ', '<p>Изящные спикеры с белым конусом, используемые в мониторах HS-ряда \nобеспечивают превосходное звучание, которое улучшено тщательно \nспроектируемым корпусом. Комбинация винтов и специально разработанного \nкольца устраняют вибрацию и резонанс, разрешая спикеру выдавать ровный \nзвуковой диапазон. Другая особенность, которая повышает работу басового \nспикера - специально отобранный магнит. Динамик для передачи высокого \nтона использует передовой проект гладкого контура, который минимизирует \nпотери так, чтобы высокочастотные детали воспроизводились с превосходной\n точностью.  </p>  ', '', '', ''),
(94, 'ru', 'Yamaha NSIW760 Speaker', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(97, 'ru', 'Sony Handycam HDR-CX3', 'Flash, AVCHD, Full HD, 1920x1080, 1/4, 1CMOS, фоторежим, zoom 12x/160x, \nMS Duo, SD, SDHC, 112x52x64 мм, 320 г  ', '<p>Запись до 13 ч видео Full HD великолепного качества на встроенную память\n 32 ГБ, и еще больше — с дополнительной картой памяти. Великолепный \nдизайн, передовые оптические технологии и удобные функции помогают \nснимать прекрасные видеофильмы и фотографии с исключительным уровнем \nдетализации.<br>\n<br>\n<strong>Мало света – не проблема</strong><br>\nМногие камеры плохо снимают в условиях низкой освещенности, делая \nзернистые, шумные кадры. Сверхчувствительная матрица CMOS Exmor R™ \nсокращает шум и улучшает четкость. А в сочетании с мощным процессором \nBIONZ камера обеспечивает отличные результаты при плохом свете, в темных\n помещениях и сумерках.<br>\n<br>\n<strong>Уместить больше в одном кадре</strong><br>\nТеперь при съемке праздника, дня рождения и других знаменательных \nсобытий точно никто не останется за кадром. Высококачественный объектив G\n от Sony в камере Handycam® теперь снабжен улучшенными возможностями \nширокоугольной съемки, и снимает почти в 2 раза больше, чем предыдущие \nмодели.<br>\n<br>\n<strong>Двигайтесь. Используйте зум. Делайте снимки: Еще больше четкости</strong><br>\nБез штатива снимки часто получаются смазанные. Новый оптический режим \nSteadyShot Active Mode обеспечивает коррекцию дрожания камеры в трех \nнаправлениях, на любом значении зума, даже если вы снимаете на ходу. \nКамера обладает в десять раз более эффективной стабилизацией изображения\n при широкоугольной съемке.<br>\n<br>\n<strong>Наилучшее качество изображения в стандарте Full HD</strong><br>\nЧем больше бит содержит каждый кадр, тем лучше качество изображения. Для\n наиболее ответственных видеосъемок в камере FX Mode предусмотрен режим с\n разрешением 1920x1080/50i и скоростью передачи данных 24 Мб/с — самое \nвысокое возможное значение для формата AVCHD.<br>\n<br>\n<strong>Ловите момент</strong><br>\nФункция Golf Shot позволяет снимать серию кадров на высокой скорости. \nОтличный способ улучшить свою технику удара... или запечатлеть любую \nдинамичную сцену в мельчайших подробностях.  </p>  ', '', '', ''),
(98, 'ru', 'Samsung NX10 14 Megapixel Digital', 'Матрица 23,4x15,6мм, 14,6 Мп / Объектив: 18-55mm OIS / поддержка карт \nпамяти SD/SDHC / AMOLED-дисплей 3" / поддержка RAW / HD-видео / питание \nот литий-ионного аккумулятора / 123 x 87 x 39,8 мм, 353 г / черный<a href="http://rozetka.com.ua/ru/products/details/90268/index.html"></a>  ', '<p><em>Samsung NX10</em> — 14,6 Мп камера со сменной оптикой и электронным \nвидоискателем. Так как оптического видоискателя с зеркалом и призмой для\n прямого визирования через объектив у нее нет, корпус получился \nсущественно более компактным, чем у зеркалок. Отсутствие зеркала \nпозволило максимально приблизить объектив к матрице. Что, в свою \nочередь, дает возможность делать короткофокусные объективы более \nпростыми и компактными, чем у камер с зеркальной системой видоискателя.  </p>  ', '', '', ''),
(99, 'ru', 'Samsung NX100 Interchangeable Lens', 'Матрица 23.5  ', '<p>Матрица 23.5 × 15.7 мм, 20.3 Мп / объектив: 20-50 мм / поддержка карт \nпамяти SD/SDHC/SDXC / LCD-дисплей 3" / FullHD-видео / Wi-Fi / питание от\n литий-ионного аккумулятора / 114 x 62.5 x 37.5 мм, 220.4 г / черный  <br></p>  ', '', '', ''),
(100, 'ru', 'Canon PIXMA iP100 Photo Printer', 'принтер струменевий з акумулятором iP100 with battery  <a href="http://rozetka.com.ua/fly_e141_tv_black/p217847/"></a>  ', '<p>Принцип действия струйных принтеров похож на матричные принтеры тем, что\n изображение на носителе формируется из точек. Но вместо головок с \nиголками в струйных принтерах используется матрица сопел (т. н. \nголовка), печатающая жидкими красителями. Печатающая головка может быть \nвстроена в картриджи с красителями (в основном такой подход используется\n компаниями Hewlett-Packard, Lexmark), а может и является деталью \nпринтера, а сменные картриджи содержат только краситель (Epson, Canon).<br>\n<br>\nПри длительном простое принтера (неделя и больше) происходит высыхание \nостатков красителя на соплах печатающей головки (особенно критично \nзасорение сопел печатающей матрицы принтеров Epson, Canon). Принтер \nумеет сам автоматически чистить печатающую головку. Но также возможно \nпровести принудительную очистку сопел из соответствующего раздела \nнастройки драйвера принтера. При прочистке сопел печатающей головки \nпроисходит интенсивный расход красителя. Если штатными средствами \nпринтера не удалось очистить сопла печатающей головки, то дальнейшая \nочистка и/или замена печатающей головки проводится в ремонтных \nмастерских. Замена картриджа, содержащего печатающую головку, на новый \nпроблем не вызывает.<br>\n<br>\nДля уменьшения стоимости печати и улучшения некоторых других \nхарактеристик печати также применяют систему непрерывной подачи чернил \n(СНПЧ).  </p>  ', '', '', ''),
(101, 'ru', 'Canon PIXMA iP4820 Premium', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(102, 'ru', 'Epson Stylus R1900 Photo Printer', 'Epson Stylus Photo R1900, компакт-диск с драйверам и программным \nобеспечением, руководство по установке, руководство пользователя, кабель\n питания,&nbsp; СНПЧ Epson Stylus Photo R1900, полностью заправленаня \nчернилами (по 130 мл в каждом цвете), гарантийный талон, Инструкция по \nустановке и эксплуатации СНПЧ  ', '<p>Epson Stylus Photo R1900, компакт-диск с драйверам и программным \nобеспечением, руководство по установке, руководство пользователя, кабель\n питания,&nbsp; СНПЧ Epson Stylus Photo R1900, полностью заправленаня \nчернилами (по 130 мл в каждом цвете), гарантийный талон, Инструкция по \nустановке и эксплуатации СНПЧ  <br></p>  ', '', '', ''),
(103, 'ru', 'Epson Stylus C88+ Inkjet Printer', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(104, 'ru', 'Epson Stylus Photo R2880 Color', 'Насладитесь удивительным результатам на каждом документе по доступной цене с помощью этого мощного струйного принтера  ', '<p>Насладитесь удивительным результатам на каждом документе по доступной цене с помощью этого мощного струйного принтера.  DURABrite ® Ultra пигментные чернила производит яркие, долговечные результаты, которые, несомненно, впечатляет. \n Продукция полей, готовых к отпечатки кадров в популярных размерах до 8 \n1/2 х 11 дюймов Удобный, раздельных картриджей позволяет заменять только\n цвета вам нужно.  Особенности USB и параллельный порт подключения для дополнительного удобства и совместимости.  Большой 120-листов лоток для бумаги максимальную производительность. \n Максимальная скорость печати (черный): 23,0 промилле; сети Ready: Нет, \nТип принтера: струйный; Разрешение печати (цветной) (ширина х высота): \n5760 х 1440 точек на дюйм.  <br></p>  ', '', '', ''),
(105, 'ru', 'Panasonic KX-TG6582T Cordless Phone', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(106, 'ru', 'Panasonic KX-TG7433B Expandable', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', '');
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(107, 'ru', 'Plantronics CS70N Wireless Earset', 'Гарнитура CS70N представляет собой модификацию популярной гарнитуры \nCS70, в которую добавлена система шумоподавления, повышающая качество \nпередаваемого звука. В отличие от предыдущей модели микрофон гарнитуры \nCS70N размещен на элегантном держателе, что позволяет существенно \nснизить уровень посторонних шумов в передаваемом звуке. Кроме того, \nпрозрачный  ', '<p>Гарнитура CS70N представляет собой модификацию популярной гарнитуры \nCS70, в которую добавлена система шумоподавления, повышающая качество \nпередаваемого звука. В отличие от предыдущей модели микрофон гарнитуры \nCS70N размещен на элегантном держателе, что позволяет существенно \nснизить уровень посторонних шумов в передаваемом звуке. Кроме того, \nпрозрачный держатель микрофона делает гарнитуру практически незаметной. \nCS70N состоит из базового блока и самой гарнитуры. Базовый блок \nвыполняет функцию радиоадаптера для подключения гарнитуры к офисным \nтелефонным аппаратам, служит подставкой для гарнитуры, а также выполняет\n роль зарядного устройства. Время работы гарнитуры составляет 5 часов в \nрежиме разговора и 28 часов в режиме ожидания. Для возможности \nудаленного принятия вызова, в комплект CS70N™ входит специальное \nустройство - микролифт HL10, а функция IntelliStand™ позволяет \nавтоматически осуществлять прием вызова снятием гарнитуры с подставки \nбез нажатия на кнопку принятия вызова. Вес гарнитуры составляет всего 22\n грамма. В комплекте с системой CS70N поставляются 3 гелевые подушечки \nразных размеров, что позволяет, оптимально подобрать вариант крепления \nгарнитуры для комфортного использования.  </p>  ', '', '', ''),
(108, 'ru', 'Plantronics CS55 Wireless Earset', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(109, 'ru', 'Panasonic KX-TG6445 Cordless Phone', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(110, 'ru', 'Motorola H720 Earset - Mono', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(111, 'ru', 'Plantronics Discovery 665 Wireless', '- Тип: моно<br>- Тип наушников: вкладыши<br> - Bluetooth 2<br> - Вес: 9 г.  ', '<p>- Ответить-закончить разговор <br> - Ожидание вызова <br> - Голосовой набор <br> - Повтор номера <br> - Автоматическое парное соединение <br> - Автоматическая подстройка громкости <br> - Отключение микрофона <br> - Подавление шума <br> - Индикатор состояния <br> - Крепление с заушиной  <br></p>  ', '', '', ''),
(112, 'ru', 'Motorola H270 Bluetooth Headset', 'Motorola H270 – это беспроводная гарнитура среднего класса.  ', '<p>Motorola H270 – это беспроводная гарнитура среднего класса. \n<br>\n<br>Устройство имеет достаточно типичный дизайн для гарнитур компании. \nКорпус выполнен из качественного пластика и хорошо собран. H270 имеет \nудобные размеры 53,5x16x12 мм и вес — 11 грамм. Благодаря этому, она \nпрактически не чувствуется даже после длительного использования. Также \nэтому способствуют ушной интерфейс True Comfort и мягкая ушная подушка. \nЗа управление отвечают кнопки регулировки громкости и \nмногофункциональная клавиша. В комплекте идёт дужка для ношения, но \nустройство можно носить и без неё.\n<br>\n<br>По функциональным возможностям Motorola H270 ничего выдающегося не \nдемонстрирует, но все функции реализированы чётко и надёжно. Встроенный \nаккумулятор обеспечит работу на протяжении 6 часов в режиме разговора и 6\n дней в режиме ожидания. Поддержка профиля Bluetooth v2.1 с EDR, \nобеспечивает быструю и надёжную связь с телефонами. Гарнитура \nдемонстрирует хорошее качество передачи речи.\n<br>\n<br>Motorola H270 – гарнитура на каждый день. Практичная и удобная, она прекрасно подойдёт водителям.  <br></p>  ', '', '', ''),
(113, 'ru', 'LG HBM-210 Bluetooth Headset', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(114, 'ru', 'Samsung AWEP450PBECSTA Bluetooth Headset Black', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(115, 'ru', 'Pioneer TS-SW3041D Shallow-Mount Subwoofer', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(116, 'ru', 'Pyle PLT-AB8 Subwoofer - PLTAB8', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(117, 'ru', 'Pyle PLSQ10D Red Label Square', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(118, 'ru', 'Pioneer TS-W251R Subwoofer', 'Автомобильный сабвуферный динамик Pioneer TS-W251R  ', '<p>Автомобильный сабвуферный динамик Pioneer TS-W251R представляет собой \nбюджетное решение проблемы баса в вашем автомобиле. Высокая \nчувствительность, непритязательность к акустическому оформлению, \nспособность работать даже под маломощными усилителями делают этот \nсабвуфер выгодным приобретением. Опять же ни для кого не секрет, что \nнизкие частоты и Pioneer это практически слова синонимы - от этого \nдинамика вы получите именно то, чего ожидаете - бас, драйв, скорость.  </p>  ', '', '', ''),
(119, 'ru', 'Pioneer TSSW2541D Subwoofer', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(120, 'ru', 'Pioneer JD-1212S 12-disc CD', '<ul><li>\n    Магазин-кассета для дисков для CD-чейнджера</li><li>\n    Вместимость 12 дисков</li></ul>  ', '<br><ul><li>\n    Магазин-кассета для дисков для CD-чейнджера</li><li>\n    Вместимость 12 дисков</li></ul>  ', '', '', ''),
(121, 'ru', 'Pioneer JD-612V 6-disc CD Magazine', '<div>\n                <ul><li>\n    Магазин-кассета для дисков для CD-чейнджеров</li><li>\n    Вместимость 6 дисков</li></ul></div>  ', '<br><div>\n                <ul><li>\n    Магазин-кассета для дисков для CD-чейнджеров</li><li>\n    Вместимость 6 дисков</li></ul></div>  ', '', '', ''),
(122, 'ru', 'Panasonic CX-DP880U 8-Disc', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(123, 'ru', 'JVC - XCM200 - 12-Disc CD', ' ', '<p>Высоко технологический продукт, который поможет Вам оценить качество на высшем уровне.<br><br>Все продукты доступны в наличии, а наши менеджеры помогу Вам произвести покупку в кратчайшие сроки.<br><br>На все продукты мы предоставляем гарантию качества.<br><br>Приобретайте только в нашем Интернет-магазине по лучшим ценам.</p>  ', '', '', ''),
(124, 'ru', 'JVC - CHX1500RF - FM Modulation', 'JVC CH-X1500 RF - компактный CD чейнджер с возможностью дистанционного управления.  ', '<p>JVC - Компания JVC (Victor Company of Japan) является одним из \nлидирующих мировых производителей аудио и видео продукции. Будучи \nразработчиком VHS-формата, воплощенного в фирменных видеомагнитофонах \nJVC, сегодня компания продолжает удивлять потребителей революционными \nтехническими инновациями. Многолетний опыт JVC позволяет прочно \nудерживать передовые позиции на рынке аудиовизуальной продукции. JVC \nCH-X1500 RF - компактный CD чейнджер с возможностью дистанционного \nуправления. Это автомобильный CD-чейнджер на 12 дисков. Удобство в \nуправлении и эксплуатации.  <br></p>  ', '', '', ''),
(115, 'en', 'Pioneer TS-SW3041D Shallow-Mount Subwoofer', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(124, 'en', 'JVC - CHX1500RF - FM Modulation', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(123, 'en', 'JVC - XCM200 - 12-Disc CD', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(120, 'en', 'Pioneer JD-1212S 12-disc CD', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(102, 'en', 'Epson Stylus R1900 Photo Printer', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(101, 'en', 'Canon PIXMA iP4820 Premium', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(109, 'en', 'Panasonic KX-TG6445 Cordless Phone', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(108, 'en', 'Plantronics CS55 Wireless Earset', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(114, 'en', 'Samsung AWEP450PBECSTA Bluetooth Headset Black', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(113, 'en', 'LG HBM-210 Bluetooth Headset', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(111, 'en', 'Plantronics Discovery 665 Wireless', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(119, 'en', 'Pioneer TSSW2541D Subwoofer', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(118, 'en', 'Pioneer TS-W251R Subwoofer', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(117, 'en', 'Pyle PLSQ10D Red Label Square', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(83, 'en', 'Sony BDP-S470 Network', '', '', '', '', ''),
(91, 'en', 'Sony BDV-E770W Home Theater1', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(90, 'en', 'Samsung HT-C7530W 5.1 Channel', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(89, 'en', 'Panasonic SCPTX7 Home Theater', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(93, 'en', 'Yamaha HS80M Powered Speaker', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(99, 'en', 'Samsung NX100 Interchangeable Lens', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(98, 'en', 'Samsung NX10 14 Megapixel Digital', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(97, 'en', 'Sony Handycam HDR-CX3', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(96, 'en', 'Canon VIXIA HF R11 Digital', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(104, 'en', 'Epson Stylus Photo R2880 Color', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(103, 'en', 'Epson Stylus C88+ Inkjet Printer', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(94, 'en', 'Yamaha NSIW760 Speaker', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(81, 'en', 'Samsung DVD-H1080 - 1080p', '', '', '', '', ''),
(86, 'en', 'Samsung BD-C6900 1080p 3D Blu-ray', '', '', '', '', ''),
(85, 'en', 'LG BD570 Network Audio', '', '', '', '', ''),
(84, 'en', 'Panasonic DMP-BD45 Ultra-Fast', '', '', '', '', ''),
(91, 'ua', 'Sony BDV-E770W Home Theater', '', '', '', '', ''),
(71, 'en', 'Sony KDL46EX710 46', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(79, 'en', 'Panasonic DVD-S38 DVD', '', '', '', '', ''),
(78, 'en', 'Panasonic DVD-S58 DVD Player', '', '', '', '', ''),
(82, 'en', 'Samsung BD-C5500 Blu-ray', '', '', '', '', ''),
(92, 'en', 'Samsung HW-C700 7.2 Channel', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(88, 'en', 'Samsung HW-C770BS 7.1 Channel', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(87, 'en', 'Sony HT-SS370 Home Theater', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(100, 'en', 'Canon PIXMA iP100 Photo Printer', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(95, 'en', 'Canon EOS Rebel T2i 18 Megapixel Digital', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(112, 'en', 'Motorola H270 Bluetooth Headset', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(110, 'en', 'Motorola H720 Earset - Mono', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(107, 'en', 'Plantronics CS70N Wireless Earset', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(106, 'en', 'Panasonic KX-TG7433B Expandable', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(105, 'en', 'Panasonic KX-TG6582T Cordless Phone', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(116, 'en', 'Pyle PLT-AB8 Subwoofer - PLTAB8', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(122, 'en', 'Panasonic CX-DP880U 8-Disc', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(121, 'en', 'Pioneer JD-612V 6-disc CD Magazine', '', '<p><span id="result_box" lang="en"><span>High</span> <span>technology product</span> <span>that will help you</span> <span>evaluate the quality of</span> <span>the highest level.</span><br /><br /> <span>All products are available</span> <span>in stock</span><span>, and our managers</span> <span>will help you</span> <span>to make a purchase</span> <span>as soon as possible</span><span>.</span><br /><br /> <span>On</span> <span>all the products we</span> <span>offer a guarantee</span> <span>of quality.</span><br /><br /> <span>Purchase only</span> <span>from our online</span> <span>store</span> <span>at the best prices</span><span>.</span></span></p>', '', '', ''),
(185, 'ru', 'Apple iPhone 5 16GB Black & Slate', ' ', ' ', '', '', ''),
(186, 'ru', 'Samsung UE32EH4030WXUA', '32 дюйма, 1366x768, 720p, 16:9, LED-подсветка, 300000:1, звук: 2х10 Вт, SCART, RGB, VGA, HDMI x2, USB  ', '<div>\nСупертонкий и плоский LED телевизор Samsung UE32EH4030WXUA идеально \nподойдет для вашей гостиной. При минималистичном дизайне этот телевизор \nобеспечивает кинематографическую реалистичность впечатлений во время \nпросмотра, благодаря светодиодной подсветке матрицы ТВ Samsung \nUE32EH4030WXUA. Получите удовольствие от максимальной четкости \nдинамичного изображения, насыщенности и многообразия цветовых оттенков. \n           </div>  ', '', '', ''),
(187, 'ru', 'Samsung UE40ES6307UXUA', '40 дюймов, LED, 1920x1080, 16:9, Full HD, 178°/178°, 2х10 Вт, 3xHDMI, 3xUSB, Ethernet (LAN), Wi-Fi, Smart TV  ', '<strong>Новый уровень ощущений в формате 3D</strong><br>\nLED телевизоры Samsung внесли в мир развлечений совершенно новые \nощущения. Благодаря новейшим достижениям технологии 3D вы погружаетесь в\n совершенно новый мир ТВ-реальности.<br>\n<br>\n<strong>Смотрите фильмы, загружая их прямо с USB-накопителя</strong><br>\nБлагодаря функции ConnectShare Movie, вы можете росто вставить ваш USB \nнакопитель или жесткий диск в USB разъем телевизора, чтобы записанные на\n носителе фильмы, фотоснимки или музыкальные треки начали \nвоспроизводиться на экране телевизора. Теперь на большом экране \nтелевизора, установленного в гостиной, вы можете просмотреть или \nпрослушать любой контент.<br>\n<br>\n<strong>Видеозвонки по Skype на большом экране</strong><br>\nПриложение Skype для Smart TV доступно бесплатно в магазине Samsung App.\n В сочетании с отдельно приобретаемой веб-камерой Skype вы сможете \nсовершать видеозвонки своим друзьям и близким на большом экране почти \nили совсем бесплатно. С помощью пульта ДУ вы можете легко создать новые \nSkype эккаунты и получать доступ к существующим. Теперь видеосвязь \nбуквально в ваших руках.<br>\n<br>\n<strong>Доступ в Интернет без проводов</strong><br>\nВстроенная поддержка сети, широкие возможности подключения других устройств сочетаются с привлекательным дизайном.<br>\n<br>\n<strong>Наслаждайтесь приложениями, видео, Skype, серфингом в Интернете и многими другими возможностями</strong><br>\nБлагодаря вашей домашней системе развлечений вы откроете для себя новый \nмир социальных и персонализированных развлечений на обновленном портале \nSamsung Smart Hub и трех новых сервисах. Раздел Family Story позволит \nподелиться в друзьями и близкими фотоснимками, текстовыми комментариями и\n самыми знаменательными событиями вашей жизни. Кроме того, дети могут \nвоспользоваться развлекательными, обучающими и познавательными \nпрограммами в разделе Kids (Для детей). С помощью раздела "Фитнес" \n(Fitness) вы можете заниматься фитнесом и контролировать результаты на \nэкране телевизора. Доступ к большой библиотеке контента, приложениям на \nпортале Samsung Apps и возможность бродить по страницам Интернета \nсущественно разнообразит ваш семейный досуг и позволит получить массу \nновых положительных эмоций.  ', '', '', '');
INSERT INTO `shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(188, 'ru', 'LG 32LS359T', 'LED телевізор 32 LG 32LS359T (81,28 см, 16:9, HD Ready, 1366x768, \n1000000:1, 178/178, 3 мс, Pal/Secam-B/G, Pal/Secam-D/K, Pal-I/I'', \nDVB-T2, DVB-C, Triple XD Engine, 2x5 Вт, телетекст (1000), годинник, \nтаймер, CI Slot, RF In (T2/C), Composite, Full Scart, Component \n(Y,Pb,Pr), HDMI/HDCP (1.4)x2, USB 2.0 (JPEG/ MP3/ DivX), LAN, 100~240 В,\n 50-60 Гц, 755x530x288.8  ', 'LED телевізор 32" LG 32LS359T (81, 28 см, 16:9, HD Ready, 1366x768, \n1000000:1, 178/178, 3 мс, Pal/Secam-B/G, Pal/Secam-D/K, Pal-I/I'', \nDVB-T2, DVB-C, Triple XD Engine, 2x5 Вт, телетекст (1000), годинник, \nтаймер, CI Slot, RF In (T2/C), Composite, Full Scart, Component (Y, Pb, \nPr), HDMI/HDCP (1.4)x2, USB 2.0 (JPEG/ MP3/ DivX), LAN, 100~240 В, 50-60\n Гц, 755x530x288.8 мм, 9.1 кг, білий)  ', '', '', ''),
(189, 'ru', 'LG 47LM580T', '<div>\n                <div>ЖК-телевизор, 47, 16:9, 1920x1080, HDTV, 1080p (Full HD), LED-подсветка,\n 200 Гц, 3D, мощность звука 20 Вт, HDMI x3, VGA  </div></div>  ', 'ЖК-телевизор, 47", 16:9, 1920x1080, HDTV, 1080p (Full HD), \nLED-подсветка, 200 Гц, 3D, мощность звука 20 Вт, HDMI x3, VGA  ', '', '', ''),
(190, 'ru', 'Samsung LE40D550K1WXUA', '<div>\n                <div>\n                LCD телевізор 40 Samsung LE-40D550K1WXUA (Full HD 1080p \n1920х1080, 500 cd/m2, 50Hz, 10 Wx2 SRS TheaterSound, HDMI 1.4, USB, \nComponent In (Y/Pb/Pr), Composite In (AV), Digital Audio Out (Optical), \nPC In (D-sub), CI Slot, Scart, RF In (Terrestrial/Cable Input), \nheadphones, PC Audio In (Mini Jack), DVI Audio In (Mini Jack), Ethernet \n(LAN) , VESA 200х200mm</div></div>  ', 'SAMSUNG LE40D550K1WXUA - ЖК телевизор диагональю 40". Уникальная система\n подключения устройств позволит вам централизованно управлять всем \nцифровым контентом. Технология Samsung AllShare дает возможность \nподключить ваш телевизор ко всем совместимым цифровым устройствам, чтобы\n воспроизводить файлы с них на большом экране. Для подсоединения \nустройств, не поддерживающих беспроводную связь, можно использовать \nчетыре порта HDMI . Технология ConnectShare Movie™ позволяет подключить \nотдельный жесткий диск непосредственно к телевизору для потоковой \nпередачи фильмов. Гладкий корпус без видимых стыков и супертонкая рамка \nдовершают впечатление сдержанной элегантности.  ', '', '', ''),
(191, 'ru', 'Sony KDL-22EX553', '22 // 1366x768 пикс // 50 Гц // LED подсветка // эфирный (DVB-T) // \nкабельный (DVB-C) // HDMI: 2 шт // Компонентный //Композитный // SCART \n// USB // LAN // Линейный  ', '<div><strong>KDL-22EX553<br>\nНовый способ просмотра ТВ</strong></div><br>\n55 см / 22", телевизор HD Ready с технологией подсветки Edge LED, X-Reality, встроенным Wi-Fi® и интернет-телевидением от Sony<br>\nНаслаждайтесь четким отображением на тонком экране Edge LED<br>\nWi-Fi обеспечивает быстрый доступ к функции просмотра пропущенных программ, фильмам и приложениям<br>\nДля более комфортного просмотра предусматривается изменение угла наклона телевизора<br>\n<br>\n<div><strong>Мир развлечений на кончиках пальцев</strong></div><br>\nНачните революцию интернет-телевидения у себя дома. Откройте \nувлекательный новый мир передачи контента по запросу, просмотра \nпропущенных программ, приложений и многого другого, и все это - с \nчетким, детализированным изображением, на большом и тонком ЖК-экране. \nПришло время управлять центром развлечений в вашем доме.<br>\n<br>\n<div><strong>Четкое, реалистичное изображение</strong></div><br>\nX-Reality обеспечивает более четкое и реалистичное HD-изображение, вне \nзависимости от источника: будь то интернет-канал, DVD-диск или \nлюбительский клип. Кроме того, эта технология убирает эффект мерцания, \nгарантируя более плавное отображение динамичных спортивных передач.<br>\n<br>\n<div><strong>Новый дизайн, легкие материалы</strong></div><br>\nТелевизоры серии HX75 выполнены из контрастных материалов и имеют \nбезукоризненный дизайн. Вас восхитит легкость этого телевизора, который \nрасполагается на подставке в форме мольберта, позволяющей вращать его в \nвертикальной и горизонтальной плоскости для идеального угла обзора.<br>\n<br>\n<div><strong>Беспроводной доступ к онлайн-развлечениям</strong></div><br>\nТеперь доступ к контенту сетевого сервиса Sony Entertainment Network — \nHD-фильмам, миллионам музыкальных композиций, любимым телеканалам, \nвеб-браузеру, приложениям Twitter™, Facebook®, YouTube™, Skype™ и \nмногому другому — осуществляется с помощью дистанционного пульта или \nмобильного устройства с поддержкой распознавания голоса.<br>\n<br>\n<div><strong>Энергосберегающие функции телевизоров</strong></div><br>\nНовая функция затемнения LED Frame автоматически подстраивает яркость \nподсветки при просмотре и снижает потребление энергии, позволяя \nэкономить деньги. При этом изображение остается резким и \nвысококонтрастным.  ', '', '', '');

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
(88, 1, 1),
(76, 3, 11),
(82, 1, 4),
(77, 2, 7),
(73, 1, 2),
(108, 2, 6),
(72, 1, 5),
(74, 2, 8),
(75, 2, 9),
(94, 1, 4),
(87, 1, 5);

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
(71, 36),
(71, 37),
(71, 74),
(78, 38),
(79, 36),
(79, 38),
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
(87, 36),
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
(96, 36),
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
(107, 51),
(108, 48),
(108, 51),
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
(116, 52),
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
(185, 50),
(186, 36),
(186, 37),
(186, 74),
(187, 36),
(187, 37),
(187, 74),
(188, 36),
(188, 37),
(188, 74),
(189, 36),
(189, 37),
(189, 75),
(190, 36),
(190, 37),
(190, 75),
(191, 36),
(191, 37),
(191, 75);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_images`
--

CREATE TABLE IF NOT EXISTS `shop_product_images` (
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`image_name`),
  KEY `shop_product_images_I_1` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_product_images`
--

INSERT INTO `shop_product_images` (`product_id`, `image_name`, `position`) VALUES
(186, '186_2.jpg', 2),
(186, '186_1.jpg', 1),
(187, '187_0.jpg', 0),
(186, '186_3.jpg', 3),
(186, '186_4.jpg', 4),
(187, '187_1.jpg', 1),
(187, '187_2.jpg', 2),
(187, '187_3.jpg', 3),
(188, '188_0.jpg', 0),
(188, '188_1.jpg', 1),
(188, '188_2.jpg', 2),
(188, '188_3.jpg', 3),
(71, '71_0.jpg', 0),
(71, '71_1.jpg', 1),
(71, '71_2.jpg', 2),
(189, '189_0.jpg', 0),
(189, '189_1.jpg', 1),
(189, '189_2.jpg', 2),
(190, '190_0.jpg', 0),
(190, '190_1.jpg', 1),
(190, '190_2.jpg', 2),
(191, '191_0.jpg', 0),
(191, '191_1.jpg', 1);

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
  PRIMARY KEY (`id`),
  KEY `shop_product_properties_I_2` (`active`),
  KEY `shop_product_properties_I_3` (`show_on_site`),
  KEY `shop_product_properties_I_4` (`show_in_compare`),
  KEY `shop_product_properties_I_5` (`position`),
  KEY `shop_product_properties_I_1` (`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Дамп даних таблиці `shop_product_properties`
--

INSERT INTO `shop_product_properties` (`id`, `csv_name`, `active`, `show_in_compare`, `position`, `show_on_site`, `multiple`, `external_id`, `show_in_filter`, `main_property`) VALUES
(20, 'displaytech', 1, 1, 13, 1, 0, NULL, 1, 0),
(21, 'razmerekrana', 1, 1, 14, 1, 0, NULL, 0, 0),
(22, 'hdmi', 1, 1, 15, 1, 0, NULL, 1, 0),
(23, 'power', 1, 1, 16, 1, 0, NULL, 0, 0),
(24, 'digitalopticalinput', 1, 1, 17, 1, 0, NULL, 0, 0),
(25, 'focus', 1, 1, 18, 1, 0, NULL, 0, 0),
(26, 'megapixel', 1, 1, 19, 1, 0, NULL, 0, 0),
(28, 'audioformats', 1, 1, 12, 1, 1, NULL, 1, 0),
(29, 'videoformats', 1, 1, 11, 1, 1, NULL, 1, 0),
(30, 'warranty', 1, 1, 10, 1, 0, NULL, 0, 0),
(31, 'ram', 1, NULL, 9, NULL, NULL, NULL, NULL, NULL),
(32, 'cpu', 1, 1, 1, 1, NULL, NULL, 1, NULL),
(33, 'displaytype', 1, 1, 2, 1, NULL, NULL, NULL, NULL),
(34, 'organizer', 1, 1, 3, 1, 1, NULL, NULL, NULL),
(35, 'printertype', 1, 1, 4, 1, 1, NULL, 1, 0),
(36, 'paperformat', 1, 1, 5, 1, 1, NULL, 0, 0),
(37, 'network', 1, 1, 6, 1, 1, NULL, 0, 0),
(38, 'sensitivity', 1, 1, 7, 1, 1, NULL, 0, 0),
(39, 'korpys', 1, 1, 8, 1, 0, NULL, 0, 0),
(40, 'range', 1, 1, 0, 1, 0, NULL, 0, 0);

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
(20, 37),
(20, 74),
(20, 75),
(21, 36),
(21, 37),
(21, 48),
(21, 74),
(21, 75),
(22, 36),
(22, 37),
(22, 41),
(22, 74),
(22, 75),
(23, 38),
(23, 39),
(23, 41),
(23, 43),
(23, 53),
(23, 54),
(24, 40),
(24, 41),
(24, 54),
(25, 44),
(25, 45),
(26, 44),
(26, 45),
(28, 38),
(28, 39),
(28, 41),
(28, 54),
(29, 38),
(29, 41),
(30, 36),
(30, 37),
(30, 38),
(30, 39),
(30, 40),
(30, 41),
(30, 43),
(30, 44),
(30, 45),
(30, 46),
(30, 48),
(30, 50),
(30, 51),
(30, 52),
(30, 53),
(30, 54),
(30, 55),
(30, 74),
(30, 75),
(32, 50),
(33, 50),
(35, 46),
(36, 46),
(37, 46),
(37, 50),
(37, 55),
(38, 45),
(39, 41),
(39, 43),
(39, 53),
(40, 51);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=877 ;

--
-- Дамп даних таблиці `shop_product_properties_data`
--

INSERT INTO `shop_product_properties_data` (`id`, `property_id`, `product_id`, `value`, `locale`) VALUES
(429, 29, 91, 'ASF', 'ru'),
(428, 28, 91, 'DTS', 'ru'),
(427, 28, 91, 'AC3', 'ru'),
(22, 22, 91, 'Да', 'en'),
(23, 23, 91, '1500 Вт', 'en'),
(24, 24, 91, '2', 'en'),
(589, 36, 100, 'A1', 'ru'),
(365, 30, 95, '12 месяцев', 'ru'),
(550, 30, 121, '12 месяцев', 'ru'),
(344, 30, 99, '12 месяцев', 'ru'),
(446, 30, 97, '24 месяца', 'ru'),
(795, 22, 71, 'Да', 'ru'),
(794, 20, 71, 'LED', 'ru'),
(819, 29, 81, 'WMV', 'ru'),
(818, 29, 81, 'VOB', 'ru'),
(817, 29, 81, 'VIDEO_TS', 'ru'),
(280, 28, 86, 'AC3', 'ru'),
(324, 28, 88, 'AAC', 'ru'),
(397, 28, 90, 'AC3', 'ru'),
(396, 28, 90, 'AAC', 'ru'),
(450, 30, 98, '12 месяцев', 'ru'),
(526, 28, 122, 'AAC', 'ru'),
(551, 28, 124, 'AAC', 'ru'),
(865, 30, 106, '36 месяцев', 'ru'),
(669, 28, 78, 'FLAC', 'ru'),
(703, 28, 79, 'FLAC', 'ru'),
(259, 28, 84, 'AAC', 'ru'),
(373, 28, 89, 'AC3', 'ru'),
(372, 28, 89, 'AAC', 'ru'),
(565, 33, 105, 'Моноблок', 'ru'),
(461, 30, 109, '12 месяцев', 'ru'),
(255, 28, 83, 'MPA', 'ru'),
(763, 28, 87, 'MPA', 'ru'),
(762, 28, 87, 'MP3', 'ru'),
(426, 28, 91, 'AAC', 'ru'),
(793, 30, 71, '24 месяца', 'ru'),
(825, 30, 96, '12 месяцев', 'ru'),
(668, 28, 78, 'DTS', 'ru'),
(667, 28, 78, 'AC3', 'ru'),
(666, 28, 78, 'AAC', 'ru'),
(665, 29, 78, 'WMV', 'ru'),
(664, 29, 78, 'VOB', 'ru'),
(663, 29, 78, 'VIDEO_TS', 'ru'),
(662, 29, 78, 'QT', 'ru'),
(661, 29, 78, 'MPEG-TS', 'ru'),
(660, 29, 78, 'MPEG-PS', 'ru'),
(659, 29, 78, 'MP4', 'ru'),
(658, 29, 78, 'MOV', 'ru'),
(657, 29, 78, 'MKV', 'ru'),
(656, 29, 78, 'M2TS', 'ru'),
(655, 29, 78, 'DVD-ISO', 'ru'),
(654, 29, 78, 'Blu-ray-ISO', 'ru'),
(653, 29, 78, 'BDMV', 'ru'),
(652, 29, 78, 'AVI', 'ru'),
(651, 29, 78, 'ASF', 'ru'),
(650, 30, 78, '12 месяцев', 'ru'),
(704, 23, 79, '50 Вт', 'ru'),
(702, 28, 79, 'DTS-WAV', 'ru'),
(701, 28, 79, 'DTS', 'ru'),
(700, 28, 79, 'AC3', 'ru'),
(699, 28, 79, 'AAC', 'ru'),
(698, 29, 79, 'BDMV', 'ru'),
(697, 29, 79, 'AVI', 'ru'),
(816, 29, 81, 'QT', 'ru'),
(815, 29, 81, 'MPEG-TS', 'ru'),
(814, 29, 81, 'MPEG-PS', 'ru'),
(813, 29, 81, 'MP4', 'ru'),
(812, 29, 81, 'MOV', 'ru'),
(811, 29, 81, 'MKV', 'ru'),
(810, 29, 81, 'M2TS', 'ru'),
(809, 29, 81, 'DVD-ISO', 'ru'),
(808, 29, 81, 'Blu-ray-ISO', 'ru'),
(807, 29, 81, 'BDMV', 'ru'),
(806, 29, 81, 'AVI', 'ru'),
(805, 29, 81, 'ASF', 'ru'),
(804, 30, 81, '12 месяцев', 'ru'),
(227, 28, 82, 'AAC', 'ru'),
(228, 28, 82, 'AC3', 'ru'),
(229, 28, 82, 'DTS', 'ru'),
(230, 28, 82, 'DTS-WAV', 'ru'),
(231, 28, 82, 'FLAC', 'ru'),
(232, 28, 82, 'M4A', 'ru'),
(233, 28, 82, 'MP3', 'ru'),
(234, 28, 82, 'MPA', 'ru'),
(235, 28, 82, 'WAV', 'ru'),
(236, 28, 82, 'WMA', 'ru'),
(237, 30, 82, '12 месяцев', 'ru'),
(238, 23, 82, '100 Вт', 'ru'),
(254, 28, 83, 'MP3', 'ru'),
(253, 28, 83, 'M4A', 'ru'),
(252, 28, 83, 'FLAC', 'ru'),
(251, 28, 83, 'DTS-WAV', 'ru'),
(250, 28, 83, 'DTS', 'ru'),
(249, 28, 83, 'AC3', 'ru'),
(248, 28, 83, 'AAC', 'ru'),
(256, 28, 83, 'WAV', 'ru'),
(257, 30, 83, '24 месяца', 'ru'),
(258, 23, 83, '100 Вт', 'ru'),
(260, 28, 84, 'AC3', 'ru'),
(261, 28, 84, 'DTS', 'ru'),
(262, 28, 84, 'M4A', 'ru'),
(263, 28, 84, 'MP3', 'ru'),
(264, 28, 84, 'WAV', 'ru'),
(265, 28, 84, 'WMA', 'ru'),
(266, 30, 84, '6 месяцев', 'ru'),
(267, 23, 84, '40 Вт', 'ru'),
(268, 28, 85, 'AAC', 'ru'),
(269, 28, 85, 'AC3', 'ru'),
(270, 28, 85, 'DTS', 'ru'),
(271, 28, 85, 'DTS-WAV', 'ru'),
(272, 28, 85, 'FLAC', 'ru'),
(273, 28, 85, 'M4A', 'ru'),
(274, 28, 85, 'MP3', 'ru'),
(275, 28, 85, 'MPA', 'ru'),
(276, 28, 85, 'WAV', 'ru'),
(277, 28, 85, 'WMA', 'ru'),
(278, 30, 85, '36 месяцев', 'ru'),
(279, 23, 85, '100 Вт', 'ru'),
(281, 28, 86, 'DTS', 'ru'),
(282, 28, 86, 'DTS-WAV', 'ru'),
(283, 28, 86, 'FLAC', 'ru'),
(284, 28, 86, 'M4A', 'ru'),
(285, 28, 86, 'MP3', 'ru'),
(286, 28, 86, 'MPA', 'ru'),
(287, 28, 86, 'WAV', 'ru'),
(288, 28, 86, 'WMA', 'ru'),
(289, 30, 86, '12 месяцев', 'ru'),
(290, 23, 86, '50 Вт', 'ru'),
(761, 28, 87, 'M4A', 'ru'),
(760, 28, 87, 'FLAC', 'ru'),
(759, 28, 87, 'DTS-WAV', 'ru'),
(758, 28, 87, 'DTS', 'ru'),
(757, 28, 87, 'AC3', 'ru'),
(756, 28, 87, 'AAC', 'ru'),
(754, 29, 87, 'WMV', 'ru'),
(753, 29, 87, 'VOB', 'ru'),
(752, 29, 87, 'VIDEO_TS', 'ru'),
(751, 29, 87, 'QT', 'ru'),
(750, 29, 87, 'MPEG-TS', 'ru'),
(749, 29, 87, 'MPEG-PS', 'ru'),
(748, 29, 87, 'MP4', 'ru'),
(747, 29, 87, 'MOV', 'ru'),
(746, 29, 87, 'MKV', 'ru'),
(745, 29, 87, 'M2TS', 'ru'),
(744, 29, 87, 'DVD-ISO', 'ru'),
(743, 29, 87, 'Blu-ray-ISO', 'ru'),
(742, 29, 87, 'BDMV', 'ru'),
(741, 29, 87, 'AVI', 'ru'),
(325, 28, 88, 'AC3', 'ru'),
(326, 28, 88, 'DTS', 'ru'),
(327, 29, 88, 'ASF', 'ru'),
(328, 29, 88, 'AVI', 'ru'),
(329, 29, 88, 'BDMV', 'ru'),
(330, 29, 88, 'Blu-ray-ISO', 'ru'),
(331, 29, 88, 'DVD-ISO', 'ru'),
(332, 29, 88, 'M2TS', 'ru'),
(333, 29, 88, 'MKV', 'ru'),
(334, 29, 88, 'MOV', 'ru'),
(335, 29, 88, 'MP4', 'ru'),
(336, 29, 88, 'MPEG-PS', 'ru'),
(337, 29, 88, 'MPEG-TS', 'ru'),
(338, 29, 88, 'QT', 'ru'),
(339, 29, 88, 'VIDEO_TS', 'ru'),
(340, 30, 88, '12 месяцев', 'ru'),
(341, 39, 88, 'Метал', 'ru'),
(342, 22, 88, 'Да', 'ru'),
(343, 23, 88, '100 Вт', 'ru'),
(345, 38, 99, '80~3200 ISO', 'ru'),
(346, 25, 99, 'Да', 'ru'),
(347, 26, 99, '15 Мп', 'ru'),
(588, 35, 100, 'Лазерная печать (цветная)', 'ru'),
(587, 30, 100, '36 месяцев', 'ru'),
(360, 35, 101, 'Лазерная печать', 'ru'),
(359, 30, 101, '12 месяцев', 'ru'),
(361, 36, 101, 'A3', 'ru'),
(362, 36, 101, 'A4', 'ru'),
(363, 37, 101, 'Bluetooth', 'ru'),
(364, 37, 101, 'Wi-Fi', 'ru'),
(366, 38, 95, 'Авто', 'ru'),
(367, 38, 95, '1600', 'ru'),
(368, 38, 95, '3200', 'ru'),
(369, 38, 95, '6400', 'ru'),
(370, 25, 95, 'Да', 'ru'),
(371, 26, 95, '12 Мп', 'ru'),
(374, 28, 89, 'DTS', 'ru'),
(375, 28, 89, 'M4A', 'ru'),
(376, 28, 89, 'MP3', 'ru'),
(377, 28, 89, 'MPA', 'ru'),
(378, 28, 89, 'WAV', 'ru'),
(379, 29, 89, 'ASF', 'ru'),
(380, 29, 89, 'AVI', 'ru'),
(381, 29, 89, 'BDMV', 'ru'),
(382, 29, 89, 'Blu-ray-ISO', 'ru'),
(383, 29, 89, 'DVD-ISO', 'ru'),
(384, 29, 89, 'M2TS', 'ru'),
(385, 29, 89, 'MKV', 'ru'),
(386, 29, 89, 'MOV', 'ru'),
(387, 29, 89, 'MP4', 'ru'),
(388, 29, 89, 'MPEG-PS', 'ru'),
(389, 29, 89, 'MPEG-TS', 'ru'),
(390, 29, 89, 'QT', 'ru'),
(391, 30, 89, '12 месяцев', 'ru'),
(392, 39, 89, 'Метал', 'ru'),
(393, 22, 89, 'Да', 'ru'),
(394, 23, 89, '100 Вт', 'ru'),
(395, 24, 89, '2', 'ru'),
(398, 28, 90, 'DTS', 'ru'),
(399, 28, 90, 'DTS-WAV', 'ru'),
(400, 28, 90, 'FLAC', 'ru'),
(401, 28, 90, 'M4A', 'ru'),
(402, 28, 90, 'MP3', 'ru'),
(403, 28, 90, 'MPA', 'ru'),
(404, 28, 90, 'WAV', 'ru'),
(405, 28, 90, 'WMA', 'ru'),
(406, 29, 90, 'ASF', 'ru'),
(407, 29, 90, 'AVI', 'ru'),
(408, 29, 90, 'BDMV', 'ru'),
(409, 29, 90, 'Blu-ray-ISO', 'ru'),
(410, 29, 90, 'DVD-ISO', 'ru'),
(411, 29, 90, 'M2TS', 'ru'),
(412, 29, 90, 'MKV', 'ru'),
(413, 29, 90, 'MOV', 'ru'),
(414, 29, 90, 'MP4', 'ru'),
(415, 29, 90, 'MPEG-PS', 'ru'),
(416, 29, 90, 'MPEG-TS', 'ru'),
(417, 29, 90, 'QT', 'ru'),
(418, 29, 90, 'VIDEO_TS', 'ru'),
(419, 29, 90, 'VOB', 'ru'),
(420, 29, 90, 'WMV', 'ru'),
(421, 30, 90, '12 месяцев', 'ru'),
(422, 39, 90, 'Метал', 'ru'),
(423, 22, 90, 'Да', 'ru'),
(424, 23, 90, '100 Вт', 'ru'),
(425, 24, 90, '1', 'ru'),
(430, 29, 91, 'AVI', 'ru'),
(431, 29, 91, 'BDMV', 'ru'),
(432, 30, 91, '36 месяцев', 'ru'),
(433, 39, 91, 'Пластик', 'ru'),
(434, 22, 91, 'Нет', 'ru'),
(435, 23, 91, '100 Вт', 'ru'),
(436, 24, 91, '1', 'ru'),
(437, 30, 92, '36 месяцев', 'ru'),
(438, 39, 92, 'Метал', 'ru'),
(439, 23, 92, '100 Вт', 'ru'),
(440, 30, 93, '12 месяцев', 'ru'),
(441, 39, 93, 'Пластик', 'ru'),
(442, 23, 93, '80 Вт', 'ru'),
(443, 30, 94, '24 месяца', 'ru'),
(444, 39, 94, 'Метал', 'ru'),
(445, 23, 94, '100 Вт', 'ru'),
(447, 38, 97, '80~3200 ISO', 'ru'),
(448, 25, 97, 'Да', 'ru'),
(449, 26, 97, '15 Мп', 'ru'),
(451, 38, 98, 'Авто', 'ru'),
(452, 38, 98, '1600', 'ru'),
(453, 38, 98, '3200', 'ru'),
(454, 38, 98, '6400', 'ru'),
(455, 25, 98, 'Да', 'ru'),
(456, 26, 98, '10 Мп', 'ru'),
(457, 30, 111, '12 месяцев', 'ru'),
(458, 40, 111, '10 м', 'ru'),
(459, 30, 110, '24 месяца', 'ru'),
(460, 40, 110, '20 м', 'ru'),
(462, 33, 109, 'Моноблок', 'ru'),
(469, 40, 108, '5 м', 'ru'),
(468, 30, 108, '12 месяцев', 'ru'),
(471, 30, 107, '24 месяца', 'ru'),
(472, 40, 107, '3 м', 'ru'),
(864, 37, 106, 'Bluetooth', 'ru'),
(564, 30, 105, '12 месяцев', 'ru'),
(874, 35, 104, 'Лазерная печать (цветная)', 'ru'),
(871, 36, 103, 'A3', 'ru'),
(870, 35, 103, 'Струйная печать', 'ru'),
(867, 36, 102, 'A3', 'ru'),
(507, 39, 118, 'Дерево', 'ru'),
(506, 30, 118, '36 месяцев', 'ru'),
(505, 23, 119, '40 Вт', 'ru'),
(504, 39, 119, 'Метал', 'ru'),
(503, 30, 119, '12 месяцев', 'ru'),
(502, 30, 120, '12 месяцев', 'ru'),
(508, 23, 118, '100 Вт', 'ru'),
(509, 30, 117, '12 месяцев', 'ru'),
(510, 39, 117, 'Пластик', 'ru'),
(511, 23, 117, '40 Вт', 'ru'),
(512, 30, 116, '24 месяца', 'ru'),
(513, 39, 116, 'Дерево', 'ru'),
(514, 23, 116, '40 Вт', 'ru'),
(515, 30, 115, '12 месяцев', 'ru'),
(516, 39, 115, 'Дерево', 'ru'),
(517, 23, 115, '40 Вт', 'ru'),
(518, 30, 114, '12 месяцев', 'ru'),
(519, 40, 114, '5 м', 'ru'),
(520, 30, 113, '12 месяцев', 'ru'),
(521, 40, 113, '2 м', 'ru'),
(522, 30, 112, '12 месяцев', 'ru'),
(523, 40, 112, '5 м', 'ru'),
(525, 30, 123, '12 месяцев', 'ru'),
(527, 28, 122, 'AC3', 'ru'),
(528, 28, 122, 'DTS', 'ru'),
(529, 28, 122, 'DTS-WAV', 'ru'),
(530, 28, 122, 'FLAC', 'ru'),
(531, 28, 122, 'M4A', 'ru'),
(532, 28, 122, 'MP3', 'ru'),
(533, 28, 122, 'MPA', 'ru'),
(534, 28, 122, 'WAV', 'ru'),
(535, 28, 122, 'WMA', 'ru'),
(536, 30, 122, '12 месяцев', 'ru'),
(537, 23, 122, '100 Вт', 'ru'),
(538, 24, 122, '4', 'ru'),
(585, 37, 185, 'Ethernet', 'ru'),
(584, 37, 185, 'Bluetooth', 'ru'),
(583, 33, 185, 'Сенсор', 'ru'),
(582, 32, 185, '2 ГГц', 'ru'),
(552, 28, 124, 'AC3', 'ru'),
(553, 28, 124, 'DTS', 'ru'),
(554, 28, 124, 'DTS-WAV', 'ru'),
(555, 28, 124, 'FLAC', 'ru'),
(556, 28, 124, 'M4A', 'ru'),
(557, 28, 124, 'MP3', 'ru'),
(558, 28, 124, 'MPA', 'ru'),
(559, 28, 124, 'WAV', 'ru'),
(560, 28, 124, 'WMA', 'ru'),
(561, 30, 124, '36 месяцев', 'ru'),
(562, 23, 124, '100 Вт', 'ru'),
(563, 24, 124, '2', 'ru'),
(866, 35, 102, 'Лазерная печать', 'ru'),
(824, 38, 96, '80~3200 ISO', 'ru'),
(581, 30, 185, '12 месяцев', 'ru'),
(586, 37, 185, 'Wi-Fi', 'ru'),
(590, 36, 100, 'A2', 'ru'),
(591, 36, 100, 'A3', 'ru'),
(592, 36, 100, 'A4', 'ru'),
(593, 37, 100, 'Wi-Fi', 'ru'),
(613, 22, 186, 'Да', 'ru'),
(612, 21, 186, '32', 'ru'),
(610, 30, 186, '24 месяца', 'ru'),
(611, 20, 186, 'LED', 'ru'),
(641, 22, 187, 'Да', 'ru'),
(640, 21, 187, '40', 'ru'),
(638, 30, 187, '24 месяца', 'ru'),
(639, 20, 187, 'LED', 'ru'),
(648, 21, 188, '32', 'ru'),
(647, 20, 188, 'LED', 'ru'),
(646, 30, 188, '24 месяца', 'ru'),
(649, 22, 188, 'Да', 'ru'),
(670, 28, 78, 'M4A', 'ru'),
(671, 28, 78, 'MP3', 'ru'),
(672, 28, 78, 'WAV', 'ru'),
(673, 28, 78, 'WMA', 'ru'),
(674, 23, 78, '100 Вт', 'ru'),
(696, 29, 79, 'ASF', 'ru'),
(695, 30, 79, '12 месяцев', 'ru'),
(740, 29, 87, 'ASF', 'ru'),
(738, 30, 87, '12 месяцев', 'ru'),
(737, 39, 87, 'Дерево', 'ru'),
(764, 28, 87, 'WAV', 'ru'),
(765, 28, 87, 'WMA', 'ru'),
(766, 22, 87, 'Да', 'ru'),
(767, 23, 87, '100 Вт', 'ru'),
(768, 24, 87, '2', 'ru'),
(859, 22, 189, 'Нет', 'ru'),
(858, 21, 189, '40', 'ru'),
(857, 20, 189, 'Plasma', 'ru'),
(820, 28, 81, 'AAC', 'ru'),
(821, 28, 81, 'AC3', 'ru'),
(822, 28, 81, 'DTS', 'ru'),
(823, 23, 81, '50 Вт', 'ru'),
(826, 25, 96, 'Да', 'ru'),
(827, 26, 96, '15 Мп', 'ru'),
(834, 21, 190, '40', 'ru'),
(833, 20, 190, 'LCD', 'ru'),
(832, 30, 190, '36 месяцев', 'ru'),
(835, 22, 190, 'Нет', 'ru'),
(842, 21, 191, '21', 'ru'),
(841, 20, 191, 'LCD', 'ru'),
(840, 30, 191, '24 месяца', 'ru'),
(843, 22, 191, 'Да', 'ru'),
(856, 30, 189, '24 месяца', 'ru'),
(869, 30, 102, '12 месяцев', 'ru'),
(872, 37, 103, 'Wi-Fi', 'ru'),
(873, 30, 103, '36 месяцев', 'ru'),
(875, 36, 104, 'A4', 'ru'),
(876, 37, 104, 'Ethernet', 'ru');

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
  PRIMARY KEY (`id`,`locale`),
  KEY `shop_product_properties_i18n_I_2` (`name`),
  KEY `shop_product_properties_i18n_I_1` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `shop_product_properties_i18n`
--

INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`, `data`) VALUES
(26, 'Количество мегапикселей', 'ru', 'a:6:{i:0;s:5:"3 Mп";i:1;s:6:"5 Мп";i:2;s:6:"8 Мп";i:3;s:7:"10 Мп";i:4;s:7:"12 Мп";i:5;s:7:"15 Мп";}'),
(25, 'Настройка фокуса', 'ru', 'a:2:{i:0;s:4:"Да";i:1;s:6:"Нет";}'),
(24, 'Количество цифровых входов', 'ru', 'a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}'),
(23, 'Мощность', 'ru', 'a:4:{i:0;s:7:"40 Вт";i:1;s:7:"50 Вт";i:2;s:7:"80 Вт";i:3;s:8:"100 Вт";}'),
(22, 'HDMI', 'ru', 'a:2:{i:0;s:4:"Да";i:1;s:6:"Нет";}'),
(21, 'Размер экрана', 'ru', 'a:6:{i:0;s:2:"17";i:1;s:2:"19";i:2;s:2:"21";i:3;s:2:"23";i:4;s:2:"32";i:5;s:2:"40";}'),
(20, 'Технология дисплея', 'ru', 'a:3:{i:0;s:3:"LED";i:1;s:3:"LCD";i:2;s:6:"Plasma";}'),
(20, 'Технологія дисплею', 'ua', 'a:4:{i:0;s:6:"LED-ua";i:1;s:9:"Plasma-ua";i:2;s:9:"Litium-ua";i:3;s:8:"Freon-ua";}'),
(20, 'Display Technology', 'en', ''),
(21, 'Screen Size', 'en', ''),
(22, 'HDMI', 'en', 'a:2:{i:0;s:3:"Yes";i:1;s:2:"No";}'),
(23, 'Power', 'en', ''),
(24, 'Number of digital inputs', 'en', ''),
(25, 'Setting the focus', 'en', ''),
(26, 'The number of megapixels', 'en', ''),
(28, 'Аудио форматы ', 'ru', 'a:10:{i:0;s:3:"MP3";i:1;s:3:"MPA";i:2;s:3:"M4A";i:3;s:3:"WMA";i:4;s:4:"FLAC";i:5;s:3:"WAV";i:6;s:7:"DTS-WAV";i:7;s:3:"DTS";i:8;s:3:"AC3";i:9;s:3:"AAC";}'),
(29, 'Видео формати', 'ru', 'a:15:{i:0;s:3:"MKV";i:1;s:7:"MPEG-TS";i:2;s:7:"MPEG-PS";i:3;s:4:"M2TS";i:4;s:3:"VOB";i:5;s:3:"AVI";i:6;s:3:"MOV";i:7;s:3:"MP4";i:8;s:2:"QT";i:9;s:3:"ASF";i:10;s:3:"WMV";i:11;s:11:"Blu-ray-ISO";i:12;s:4:"BDMV";i:13;s:7:"DVD-ISO";i:14;s:8:"VIDEO_TS";}'),
(30, 'Гарантия', 'ru', 'a:4:{i:0;s:16:"6 месяцев";i:1;s:17:"12 месяцев";i:2;s:15:"24 месяца";i:3;s:17:"36 месяцев";}'),
(31, 'Объем оперативной памяти', 'ru', 'a:6:{i:0;s:8:"256 Мб";i:1;s:8:"512 Мб";i:2;s:6:"1 Гб";i:3;s:6:"2 Гб";i:4;s:6:"4 Гб";i:5;s:6:"8 Гб";}'),
(32, 'Процессор', 'ru', 'a:6:{i:0;s:8:"600 Гц";i:1;s:8:"800 Гц";i:2;s:8:"1 ГГц";i:3;s:8:"2 ГГц";i:4;s:10:"2,6 ГГц";i:5;s:10:"3,3 ГГц";}'),
(33, 'Тип дисплея', 'ru', 'a:2:{i:0;s:12:"Сенсор";i:1;s:16:"Моноблок";}'),
(34, 'Органайзер', 'ru', 'a:6:{i:0;s:18:"Календарь";i:1;s:8:"Часы";i:2;s:16:"Диктофон";i:3;s:18:"Будильник";i:4;s:22:"Калькулятор";i:5;s:14:"Заметки";}'),
(35, 'Технология печати', 'ru', 'a:3:{i:0;s:29:"Струйная печать";i:1;s:29:"Лазерная печать";i:2;s:46:"Лазерная печать (цветная)";}'),
(36, 'Формат бумаги', 'ru', 'a:5:{i:0;s:2:"A1";i:1;s:2:"A2";i:2;s:2:"A3";i:3;s:2:"A4";i:4;s:2:"A5";}'),
(37, 'Сетевые интерфейсы', 'ru', 'a:3:{i:0;s:5:"Wi-Fi";i:1;s:8:"Ethernet";i:2;s:9:"Bluetooth";}'),
(38, 'Светочувствительность', 'ru', 'a:5:{i:0;s:8:"Авто";i:1;s:4:"6400";i:2;s:4:"3200";i:3;s:4:"1600";i:4;s:11:"80~3200 ISO";}'),
(39, 'Материал корпуса', 'ru', 'a:3:{i:0;s:14:"Пластик";i:1;s:12:"Дерево";i:2;s:10:"Метал";}'),
(40, 'Максимальная дальность связи', 'ru', 'a:6:{i:0;s:4:"2 м";i:1;s:4:"3 м";i:2;s:4:"5 м";i:3;s:5:"10 м";i:4;s:5:"15 м";i:5;s:5:"20 м";}');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_product_variants`
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
  `currency` int(11) DEFAULT NULL,
  `price_in_main` float(10,5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_variants_I_1` (`product_id`),
  KEY `shop_product_variants_I_2` (`position`),
  KEY `shop_product_variants_I_3` (`number`),
  KEY `shop_product_variants_I_5` (`price`),
  KEY `shop_product_variants_I_4` (`price`),
  KEY `shop_product_variants_FI_2` (`currency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=221 ;

--
-- Дамп даних таблиці `shop_product_variants`
--

INSERT INTO `shop_product_variants` (`id`, `product_id`, `price`, `number`, `stock`, `position`, `mainImage`, `smallImage`, `external_id`, `currency`, `price_in_main`) VALUES
(82, 71, 1000.00000, ' 034976', 3, 0, '71_vM82.jpg', '71_vS82.jpg', NULL, 1, 2500.00000),
(89, 78, 67.79000, '', 2, 0, '78_vM89.jpg', NULL, NULL, 1, 169.48000),
(90, 79, 39.95000, '', 9, 0, '79_vM90.jpg', '79_vS90.jpg', NULL, 1, 99.88000),
(92, 81, 68.80000, 'AD-78-SA-QW', 7, 0, '81_vM92.jpg', '81_vS92.jpg', NULL, 1, 172.00000),
(93, 82, 129.00000, '', 5, 0, '82_vM93.jpg', '82_vS93.jpg', NULL, 1, 51.60000),
(94, 83, 129.00000, '', 6, 0, '83_vM94.jpg', '83_vS94.jpg', NULL, 1, 51.60000),
(95, 84, 100.51000, '', 8, 0, '84_vM95.jpg', '84_vS95.jpg', NULL, 1, 40.20000),
(96, 85, 219.99001, 'D01B570', 7, 0, '85_vM96.jpg', '85_vS96.jpg', NULL, 1, 88.00000),
(97, 86, 154.00000, '', 4, 0, '86_vM97.jpg', '86_vS97.jpg', NULL, 1, 61.60000),
(98, 87, 349.00000, '', 7, 0, '87_vM98.jpg', '87_vS98.jpg', NULL, 1, 872.50000),
(99, 88, 549.98999, '', 8, 0, '88_vM99.jpg', '88_vS99.jpg', NULL, 1, 220.00000),
(100, 89, 371.98999, '', 9, 0, '89_vM100.jpg', '89_vS100.jpg', NULL, 1, 148.80000),
(101, 90, 999.00000, '', 2, 0, '90_vM101.jpg', '90_vS101.jpg', NULL, 1, 399.60001),
(102, 91, 548.00000, '', 1, 0, '91_vM102.jpg', '91_vS102.jpg', NULL, 1, 219.20000),
(103, 92, 297.00000, '', 4, 0, '92_vM103.jpg', '92_vS103.jpg', NULL, 1, 118.80000),
(104, 93, 349.98999, '', 8, 0, '93_vM104.jpg', '93_vS104.jpg', NULL, 1, 140.00000),
(105, 94, 99.95000, '', 4, 0, '94_vM105.jpg', '94_vS105.jpg', NULL, 1, 39.98000),
(106, 95, 799.00000, '', 5, 0, NULL, NULL, NULL, 1, 319.60001),
(107, 96, 699.00000, '4383B001', 6, 0, '96_vM107.jpg', '96_vS107.jpg', NULL, 1, 1747.50000),
(108, 97, 799.00000, '', 1, 0, '97_vM108.jpg', '97_vS108.jpg', NULL, 1, 319.60001),
(109, 98, 549.00000, '', 4, 0, '98_vM109.jpg', '98_vS109.jpg', NULL, 1, 219.60001),
(110, 99, 499.98999, '', 8, 0, '99_vM110.jpg', '99_vS110.jpg', NULL, 1, 200.00000),
(111, 100, 179.87000, '', 2, 0, '100_vM111.jpg', '100_vS111.jpg', NULL, 1, 71.95000),
(112, 101, 74.99000, '', 9, 0, '101_vM112.jpg', '101_vS112.jpg', NULL, 1, 30.00000),
(113, 102, 550.00000, '', 2, 0, '102_vM113.jpg', '102_vS113.jpg', NULL, 1, 220.00000),
(114, 103, 86.90000, '', 8, 0, '103_vM114.jpg', '103_vS114.jpg', NULL, 1, 34.76000),
(115, 104, 800.00000, '', 1, 0, '104_vM115.jpg', '104_vS115.jpg', NULL, 1, 320.00000),
(116, 105, 99.95000, '', 2, 0, '105_vM116.jpg', '105_vS116.jpg', NULL, 1, 39.98000),
(117, 106, 272.04999, '', 0, 0, '106_vM117.jpg', '106_vS117.jpg', NULL, 2, 272.04999),
(118, 107, 219.28000, '', 5, 0, '107_vM118.jpg', '107_vS118.jpg', NULL, 1, 87.71000),
(119, 108, 219.99001, '', 2, 0, NULL, NULL, NULL, 1, 88.00000),
(120, 109, 123.37000, '', 9, 0, '109_vM120.jpg', '109_vS120.jpg', NULL, 1, 49.35000),
(121, 110, 36.95000, '', 5, 0, '110_vM121.jpg', '110_vS121.jpg', NULL, 1, 14.78000),
(122, 111, 20.40000, '', 7, 0, '111_vM122.jpg', '111_vS122.jpg', NULL, 1, 8.16000),
(123, 112, 12.99000, '', 6, 0, '112_vM123.jpg', '112_vS123.jpg', NULL, 1, 5.20000),
(124, 113, 10.99000, '', 9, 0, '113_vM124.jpg', '113_vS124.jpg', NULL, 1, 4.40000),
(125, 114, 19.99000, '', 3, 0, '114_vM125.jpg', '114_vS125.jpg', NULL, 1, 8.00000),
(126, 115, 45.00000, '', 5, 0, '115_vM126.jpg', '115_vS126.jpg', NULL, 1, 18.00000),
(127, 116, 60.99000, '', 6, 0, '116_vM127.jpg', '116_vS127.jpg', NULL, 1, 24.40000),
(128, 117, 47.22000, '', 7, 0, '117_vM128.jpg', '117_vS128.jpg', NULL, 1, 18.89000),
(129, 118, 56.00000, '', 2, 0, '118_vM129.jpg', '118_vS129.jpg', NULL, 1, 22.40000),
(130, 119, 69.00000, '', 5, 0, '119_vM130.jpg', '119_vS130.jpg', NULL, 1, 27.60000),
(131, 120, 30.71000, '', 6, 0, '120_vM131.jpg', NULL, NULL, 1, 12.28000),
(132, 121, 28.18000, '', 4, 0, '121_vM132.jpg', '121_vS132.jpg', NULL, 1, 11.27000),
(133, 122, 35.00000, '', 6, 0, '122_vM133.jpg', NULL, NULL, 1, 14.00000),
(134, 123, 42.00000, '', 1, 0, '123_vM134.jpg', '123_vS134.jpg', NULL, 1, 16.80000),
(135, 124, 34.00000, '', 2, 0, '124_vM135.jpg', '124_vS135.jpg', NULL, 1, 13.60000),
(210, 100, 174.87000, '', 1, 1, '100_vM210.jpg', '100_vS210.jpg', NULL, 1, 69.95000),
(211, 110, 36.95000, '', 2, 1, '110_vM211.jpg', '110_vS211.jpg', NULL, 1, 14.78000),
(212, 86, 155.00000, '', 0, 1, '86_vM212.jpg', '86_vS212.jpg', NULL, 1, 62.00000),
(213, 185, 500.00000, '123456', 5, 0, NULL, NULL, NULL, 1, 200.00000),
(214, 186, 300.00000, ' 130835', 4, 0, '186_vM214.jpg', '186_vS214.jpg', NULL, 1, 750.00000),
(215, 187, 350.00000, ' 155763', 0, 0, '187_vM215.jpg', '187_vS215.jpg', NULL, 1, 875.00000),
(216, 188, 250.00000, '', 10, 0, '188_vM216.jpg', '188_vS216.jpg', NULL, 1, 625.00000),
(217, 189, 5000.00000, '', 10, 0, '189_vM217.jpg', NULL, NULL, 1, 12500.00000),
(218, 190, 250.00000, '', 5, 0, '190_vM218.jpg', NULL, NULL, 1, 625.00000),
(219, 191, 330.00000, '', 8, 0, '191_vM219.jpg', '191_vS219.jpg', NULL, 1, 825.00000);

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
(82, 'ru', ''),
(211, 'ru', 'Серый'),
(89, 'ru', ''),
(90, 'ru', ''),
(92, 'ru', ''),
(93, 'ru', ''),
(94, 'ru', ''),
(95, 'ru', ''),
(96, 'ru', ''),
(97, 'ru', 'Черный'),
(98, 'ru', ''),
(99, 'ru', ''),
(100, 'ru', ''),
(101, 'ru', ''),
(102, 'ru', 'Sony BDV-E770W Home Theater'),
(103, 'ru', ''),
(104, 'ru', ''),
(105, 'ru', ''),
(106, 'ru', ''),
(107, 'ru', ''),
(108, 'ru', ''),
(109, 'ru', ''),
(110, 'ru', ''),
(111, 'ru', 'Черный'),
(112, 'ru', ''),
(113, 'ru', ''),
(114, 'ru', ''),
(115, 'ru', ''),
(116, 'ru', ''),
(117, 'ru', 'Panasonic KX-TG7433B Expandabledsf'),
(118, 'ru', ''),
(119, 'ru', ''),
(120, 'ru', ''),
(121, 'ru', 'Черный'),
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
(105, 'en', ''),
(82, 'en', ''),
(90, 'en', ''),
(89, 'en', ''),
(93, 'en', ''),
(92, 'en', ''),
(103, 'en', ''),
(99, 'en', ''),
(98, 'en', ''),
(111, 'en', ''),
(106, 'en', ''),
(123, 'en', ''),
(121, 'en', ''),
(118, 'en', ''),
(117, 'en', ''),
(116, 'en', ''),
(127, 'en', ''),
(133, 'en', ''),
(132, 'en', ''),
(210, 'ru', 'Белый'),
(212, 'ru', 'Белый'),
(213, 'ru', ''),
(214, 'ru', ''),
(215, 'ru', ''),
(216, 'ru', ''),
(217, 'ru', ''),
(218, 'ru', ''),
(219, 'ru', '');

-- --------------------------------------------------------

--
-- Структура таблиці `shop_rbac_group`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_rbac_group_I_1` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Дамп даних таблиці `shop_rbac_group`
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
-- Структура таблиці `shop_rbac_privileges`
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
-- Дамп даних таблиці `shop_rbac_privileges`
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
-- Структура таблиці `shop_rbac_roles`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `importance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп даних таблиці `shop_rbac_roles`
--

INSERT INTO `shop_rbac_roles` (`id`, `name`, `description`, `importance`) VALUES
(10, 'Администартор', '', 1),
(11, 'Менеджер', '', 2),
(15, 'Пользователь', 'Пользователь сайта', 3);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_rbac_roles_privileges`
--

CREATE TABLE IF NOT EXISTS `shop_rbac_roles_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_rbac_roles_privileges_FI_1` (`role_id`),
  KEY `shop_rbac_roles_privileges_FI_2` (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1943 ;

--
-- Дамп даних таблиці `shop_rbac_roles_privileges`
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
(1624, 10, 1464),
(1781, 10, 1466),
(1782, 10, 1467),
(1783, 10, 1468),
(1784, 10, 1469),
(1785, 10, 1465),
(1786, 10, 1464),
(1787, 10, 1463),
(1788, 10, 1462),
(1789, 10, 1461),
(1790, 10, 1460),
(1791, 10, 1457),
(1792, 10, 1459),
(1793, 10, 1458),
(1794, 10, 1456),
(1795, 10, 1455),
(1796, 10, 1453),
(1797, 10, 1454),
(1798, 10, 1452),
(1799, 10, 1451),
(1800, 10, 1450),
(1801, 10, 1447),
(1802, 10, 1448),
(1803, 10, 1449),
(1804, 10, 1446),
(1805, 10, 1445),
(1806, 10, 1444),
(1807, 10, 1443),
(1808, 10, 1442),
(1809, 10, 1441),
(1810, 10, 1439),
(1811, 10, 1440),
(1812, 10, 1437),
(1813, 10, 1438),
(1814, 10, 1436),
(1815, 10, 1435),
(1816, 10, 1434),
(1817, 10, 1433),
(1818, 10, 1432),
(1819, 10, 1431),
(1820, 10, 1430),
(1821, 10, 1429),
(1822, 10, 1428),
(1823, 10, 1427),
(1824, 10, 1426),
(1825, 10, 1424),
(1826, 10, 1425),
(1827, 10, 1421),
(1828, 10, 1422),
(1829, 10, 1423),
(1830, 10, 1420),
(1831, 10, 1418),
(1832, 10, 1419),
(1833, 10, 1415),
(1834, 10, 1416),
(1835, 10, 1417),
(1836, 10, 1413),
(1837, 10, 1414),
(1838, 10, 1408),
(1839, 10, 1409),
(1840, 10, 1410),
(1841, 10, 1411),
(1842, 10, 1412),
(1843, 10, 1402),
(1844, 10, 1403),
(1845, 10, 1404),
(1846, 10, 1405),
(1847, 10, 1406),
(1848, 10, 1407),
(1849, 10, 1401),
(1850, 10, 1400),
(1851, 10, 1399),
(1852, 10, 1396),
(1853, 10, 1397),
(1854, 10, 1398),
(1855, 10, 1394),
(1856, 10, 1395),
(1857, 10, 1391),
(1858, 10, 1392),
(1859, 10, 1393),
(1860, 10, 1390),
(1861, 10, 1388),
(1862, 10, 1389),
(1863, 10, 1387),
(1864, 10, 1386),
(1865, 10, 1385),
(1866, 10, 1381),
(1867, 10, 1382),
(1868, 10, 1383),
(1869, 10, 1384),
(1870, 10, 1380),
(1871, 10, 1378),
(1872, 10, 1379),
(1873, 10, 1377),
(1874, 10, 1376),
(1875, 10, 1375),
(1876, 10, 1374),
(1877, 10, 1373),
(1878, 10, 1372),
(1879, 10, 1371),
(1880, 10, 1370),
(1881, 10, 1369),
(1882, 10, 1368),
(1883, 10, 1367),
(1884, 10, 1358),
(1885, 10, 1359),
(1886, 10, 1360),
(1887, 10, 1361),
(1888, 10, 1362),
(1889, 10, 1363),
(1890, 10, 1364),
(1891, 10, 1365),
(1892, 10, 1366),
(1893, 10, 1354),
(1894, 10, 1355),
(1895, 10, 1356),
(1896, 10, 1357),
(1897, 10, 1351),
(1898, 10, 1353),
(1899, 10, 1352),
(1900, 10, 1350),
(1901, 10, 1349),
(1902, 10, 1347),
(1903, 10, 1348),
(1904, 10, 1346),
(1905, 10, 1344),
(1906, 10, 1342),
(1907, 10, 1345),
(1908, 10, 1343),
(1909, 10, 1341),
(1910, 10, 1340),
(1911, 10, 1339),
(1912, 10, 1338),
(1913, 10, 1337),
(1914, 10, 1336),
(1915, 10, 1335),
(1916, 10, 1332),
(1917, 10, 1334),
(1918, 10, 1333),
(1919, 10, 1331),
(1920, 10, 1330),
(1921, 10, 1327),
(1922, 10, 1328),
(1923, 10, 1329),
(1924, 10, 1325),
(1925, 10, 1326),
(1926, 10, 1324),
(1927, 10, 1323),
(1928, 10, 1322),
(1929, 10, 1321),
(1930, 10, 1320),
(1931, 10, 1319),
(1932, 10, 1318),
(1933, 10, 1313),
(1934, 10, 1314),
(1935, 10, 1315),
(1936, 10, 1316),
(1937, 10, 1317),
(1938, 10, 1312),
(1939, 10, 1310),
(1940, 10, 1308),
(1941, 10, 1311),
(1942, 10, 1309);

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
('systemTemplatePath', './templates/commerce/shop/default', ''),
('frontProductsPerPage', '12', ''),
('adminProductsPerPage', '24', ''),
('ordersMessageFormat', 'text', ''),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22', ''),
('ordersSendMessage', 'true', ''),
('ordersSenderEmail', 'noreply@example.com', ''),
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
('callbacksSendEmailTo', 'manager@example.com', ''),
('callbacksSenderEmail', 'noreply@example.com', ''),
('callbacksSenderName', '', ''),
('callbacksMessageTheme', '', ''),
('userInfoRegister', '0', ''),
('userInfoMessageFormat', 'text', ''),
('userInfoMessageText', '', ''),
('userInfoSenderEmail', 'noreply@example.com', ''),
('userInfoSenderName', '', ''),
('userInfoMessageTheme', '', ''),
('topSalesBlockFormulaCoef', '1', ''),
('pricePrecision', '2', ''),
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
('forgotPasswordMessageText', 'Здравствуйте!\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri%\nВаш новый пароль для входа: %password%\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\nС уважением, \nсотрудники службы продаж %webSiteName%  ', 'ru'),
('ordersMessageText', 'Здравствуйте, %userName%.\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные:\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22  ', 'ru'),
('ordersSenderName', '', 'ru'),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки', 'ru'),
('notifyOrderStatusMessageText', ' ', 'ru'),
('notifyOrderStatusSenderName', '', 'ru'),
('notifyOrderStatusMessageTheme', '', 'ru'),
('wishListsMessageText', ' ', 'ru'),
('wishListsSenderName', 'admin', 'ru'),
('wishListsMessageTheme', '', 'ru'),
('notificationsMessageText', ' ', 'ru'),
('notificationsSenderName', '', 'ru'),
('notificationsMessageTheme', '', 'ru'),
('callbacksMessageText', ' ', 'ru'),
('callbacksSenderName', '', 'ru'),
('callbacksMessageTheme', '', 'ru'),
('userInfoMessageText', ' ', 'ru'),
('userInfoSenderName', '', 'ru'),
('userInfoMessageTheme', '', 'ru'),
('adminMessageCallback', '<h1>Спасибо за заказ звонка</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>  ', ''),
('1CCatSettings', 'a:4:{s:3:"zip";s:6:"zip=no";s:8:"filesize";s:15:"file_limit=1024";s:7:"validIP";s:9:"127.0.0.1";s:8:"password";s:0:"";}', ''),
('adminMessages', 'a:3:{s:8:"incoming";s:0:"";s:8:"callback";s:27:"вфы вфыв фыв фы";s:5:"order";s:0:"";}', 'ru'),
('selectedProductCats', 'a:5:{i:0;s:2:"36";i:1;s:2:"37";i:2;s:2:"38";i:3;s:2:"39";i:4;s:2:"41";}', ''),
('adminMessageIncoming', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>  ', ''),
('adminMessageOrderPage', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>  ', ''),
('mainModImageWidth', '640', ''),
('mainModImageHeight', '480', ''),
('smallModImageWidth', '90', ''),
('smallModImageHeight', '90', ''),
('order_method', '1', ''),
('forgotPasswordMessageText', 'Здравствуйте!\n\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\n\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri% \n\nВаш новый пароль для входа: %password%\n\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\n\n\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\n\nС уважением, \nсотрудники службы продаж %webSiteName%', 'en'),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22', 'en'),
('ordersSenderName', 'DemoShop ImageCms.net', 'en'),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки', 'en'),
('ordersManagerEmail', 'noreply@example.com', ''),
('ordersSendManagerMessage', 'true', ''),
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
('1CSettingsOS', 'a:1:{i:0;s:1:"1";}', ''),
('MemcachedSettings', 'a:5:{s:11:"MEMCACHE_ON";b:0;s:17:"MEMCACHE_HOSTNAME";s:9:"localhost";s:13:"MEMCACHE_PORT";s:5:"11211";s:18:"MEMCACHE_NAMESPACE";s:13:"imagecms_shop";s:13:"CACHE_EXPIRES";s:4:"3600";}', ''),
('adminMessageMonkey', '', ''),
('adminMessageMonkeylist', '', ''),
('MobileVersionSettings', 'a:3:{s:15:"MobileVersionON";b:1;s:17:"MobileVersionSite";s:9:"localhost";s:20:"MobileVersionAddress";s:16:"mobile.localhost";}', ''),
('facebook_int', 'a:3:{s:9:"secretkey";s:0:"";s:9:"appnumber";s:0:"";s:8:"template";s:16:"commerce_mobiles";}', ''),
('vk_int', 'a:3:{s:7:"protkey";s:0:"";s:9:"appnumber";s:0:"";s:8:"template";s:16:"commerce_mobiles";}', ''),
('xmlSiteMap', 'a:6:{s:18:"main_page_priority";s:1:"1";s:13:"cats_priority";s:3:"0.8";s:14:"pages_priority";s:3:"0.6";s:20:"main_page_changefreq";s:6:"always";s:21:"categories_changefreq";s:6:"hourly";s:16:"pages_changefreq";s:5:"daily";}', ''),
('mobileTemplatePath', './templates/commerce_mobiles/shop/default', ''),
('ordersRecountGoods', '0', ''),
('ordersuserInfoRegister', NULL, ''),
('notifyOrderStatusStatusEmail', '1', ''),
('8_LMI_PAYEE_PURSE', '6456456456464', ''),
('8_LMI_SECRET_KEY', '456', ''),
('watermark_watermark_interest', '25', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
-- Структура таблиці `support_comments`
--

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
-- Дамп даних таблиці `support_comments`
--

INSERT INTO `support_comments` (`id`, `ticket_id`, `user_id`, `user_status`, `user_name`, `text`, `date`) VALUES
(1, 3, 1, 1, 'admin', 'Вы можете оплатить услуги безналичным переводом и наличными.', 1353064129);

-- --------------------------------------------------------

--
-- Структура таблиці `support_departments`
--

CREATE TABLE IF NOT EXISTS `support_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `support_departments`
--

INSERT INTO `support_departments` (`id`, `name`) VALUES
(1, 'Техническая поддержка'),
(2, 'Финансовый отдел'),
(3, 'Отдел консультаций');

-- --------------------------------------------------------

--
-- Структура таблиці `support_tickets`
--

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
-- Дамп даних таблиці `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `last_comment_author`, `text`, `theme`, `department`, `status`, `priority`, `date`, `updated`) VALUES
(1, 1, '', 'Не могу настроить на сайте переадресации. На локалке все работает. Помогите пожалуйста.', 'htaccess', 1, 0, '2', 1353061322, 1353061322),
(2, 1, '', 'Какой тарифный план лучше подходит для моего сайта?', 'хостинг', 3, 0, '1', 1353061376, 1353061376),
(3, 1, 'admin', 'Как я могу полатить хостинг?', 'Оплата услуг', 2, 0, '0', 1353061402, 1353064130);

-- --------------------------------------------------------

--
-- Структура таблиці `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

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
  KEY `role_id` (`role_id`),
  KEY `users_I_1` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users`
--
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

--
-- Дамп даних таблиці `user_autologin`
--
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп даних таблиці `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `type`, `data`, `method`, `settings`, `description`, `roles`, `created`) VALUES
(3, 'latest_news', 'module', 'core', 'recent_news', 'a:4:{s:10:"news_count";s:1:"2";s:11:"max_symdols";s:3:"150";s:10:"categories";a:1:{i:0;s:2:"56";}s:7:"display";s:6:"recent";}', 'Последние новости', '', 1291632457),
(4, 'recent_product_comments', 'module', 'comments', 'recent_product_comments', 'a:2:{s:14:"comments_count";s:1:"5";s:13:"symbols_count";s:1:"0";}', '', '', 1308300371),
(5, 'tags', 'module', 'tags', 'tags_cloud', '', 'tags', '', 1312362714),
(6, 'path', 'module', 'navigation', 'widget_navigation', '', 'path', '', 1328631622);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
