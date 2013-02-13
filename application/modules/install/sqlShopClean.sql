<<<<<<< HEAD
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category_translate`
--

INSERT INTO `category_translate` (`id`, `alias`, `name`, `title`, `short_desc`, `image`, `keywords`, `description`, `lang`) VALUES
(6, 1, 'Home', '', '', '', '', '', 30),
(7, 1, 'Главная', '', '', '', '', '', 3),
(8, 56, 'News and Events', '', '', '', '', '', 30);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `module`, `user_id`, `user_name`, `user_mail`, `user_site`, `item_id`, `text`, `date`, `status`, `agent`, `user_ip`, `rate`, `text_plus`, `text_minus`, `like`, `disslike`, `parent`) VALUES
(25, 'shop', 1, 'admin', 'admin@localhost.loc', '', 108, 'Отличный выбор!', 1328007661, 0, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.77 Safari/535.7', '127.0.0.2', 0, NULL, NULL, 0, 0, NULL);

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
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `identif` (`identif`),
  KEY `enabled` (`enabled`),
  KEY `autoload` (`autoload`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=126 ;

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
(121, 'shop', 'shop', 1, 0, 0, NULL),
(123, 'share', 'share', 0, 0, 0, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(35, 'О сайте', '', 'o-sajte', '', 'это, базовый, шаблон, imagecms, котором, релизованы, следующие, функции, вывод, фотогалереи, статической, статьи, блога', 'Это базовый шаблон ImageCMS, на котором релизованы следующие функции: вывод фотогалереи, вывод статической статьи, вывод блога.', '<p>Это базовый шаблон ImageCMS, на котором релизованы следующие функции: отображение фотогалереи, отображение статической статьи, отображение корпоративного блога, отображение формы обратной связи.</p>\n<p>Общий вид шаблона можно отредактировать и изменить лого, графическую вставку на свои тематические.</p>\n<p>Слева в сайдбаре Вы видите список категорий блога, который легко вставляется с помощью функции {sub_category_list()} в файле main.tpl. Также в левом сайдбаре находится форма поиска по сайту, виджет последних комментариев и виджет тегов сайта. В этот сайдбар можно также добавить виджет последних либо популярных новостей, а также любые счетчики, информеры.</p>\n<p>Верхнее меню реализовано с помощью модуля Меню. Управлять его содержимым можно из административной части в разделе Меню - Главное меню. Сюда как правило можно еще добавить страницы: о компании, контакты, услуги и т.п.</p>\n<p>За дополнительной информацией обращайтесь в официальный раздел документации: <a href="http://www.imagecms.net/wiki">http://www.imagecms.net/wiki</a></p>\n<p>Обсудить дополнительные возможности, а также вопросы по установке, настройке системы можно на официальном форуме: <a href="http://forum.imagecms.net/index.php">http://forum.imagecms.net/</a></p>', '', 0, 'page_static', '', 0, 1, 0, 'publish', 'admin', 1267203253, 1267203328, 1290100400, 8, 3, 0),
(64, 'О магазине', '', 'about', '', 'магазине', 'О магазине', '<p>Магазин ImageCMS Shop предоставляет огромный выбор техники на любой вкус по лучшим ценам.</p>\n<p>Наш магазин существует более 5 лет и за это время не было ни единого возврата товара.</p>\n<p>Мы обслуживаем ежедневно сотни покупателей и делаем это с радостью.</p>\n<p><strong>Покупайте технику у нас и становитесь обладателем лучшей в мире техники!!!</strong></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295776, 1291295792, 1291743386, 287, 3, 0),
(65, 'Оплата', '', 'oplata', '', 'оплата', 'Оплата', '<p>Наш магазин поддерживает все доступные на данный момент методы оплаты.</p>\n<p>Также действует возможность оплаты курьеру при доставке для всех крупных городов Украины и России. (возможность оплаты курьеру в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295824, 1291295836, 1291743521, 167, 3, 0),
(66, 'Доставка', '', 'dostavka', '', 'доставка', 'Доставка', '<p>Мы поддерживаем доставку службой Автомир по всему миру.</p>\n<p>Также возможна доставка курьером для всех больших городов Украины и России (возможность доставки курьером в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>\n<p>При желании Вы можете сами забрать купленный товар в наших офисах.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295844, 1291295851, 1291743683, 125, 3, 0),
(67, 'Помощь', '', 'help', '', 'помощь', 'Помощь', '<p>Для того, чтобы приобрести товар в нашем магазине, Вам нужно выполнить несколько простых шагов:</p>\n<ul>\n<li>Выбрать нужный товар, воспользовавшить навигацией слева, либо поиском.</li>\n<li>Добавить товар в корзину.</li>\n<li>Перейти в корзину, выбрать способ доставки и указать Ваши контактные данные.</li>\n<li>Подтвердить заказ и выбрать способ оплаты.</li>\n</ul>\n<p>После этого наши менеджеры свяжуться с Вами и помогут с оплатой и доставкой товара, а также проконсультируют по любому вопросу.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1291743919, 75, 3, 0),
(68, 'Контакты', '', 'contact_us', '', 'контакты', 'Контакты', '<p><strong>Горячий телефон</strong>: 0 800 80 80 800</p>\n<p><strong>Главный офис в Москве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 095 095 00 00</p>\n<p>&nbsp;</p>\n<p><strong>Главный офис в Киеве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 098 098 00 00</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295870, 1291295888, 1291744068, 73, 3, 0),
(74, 'Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok-1', 'novosti_i_aktsii/', 'windows, отримує, подарунок, сумку, ноутбука, кожен, покупець, акційних, ноутбуків, передвстановленою', 'ОС Windows отримує в подарунок сумку для ноутбука! Кожен покупець акційних ноутбуків з передвстановленою ОС Windows отримує в подарунок сумку для ноутбука!', '<p>ОС Windows получает в подарок сумку для ноутбука! Каждый покупатель акционных ноутбуков с предустановленной ОС Windows получает в подарок сумку для ноутбука!</p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336737588, 1336737588, 1346689293, 3, 3, 0),
(73, 'Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok', 'novosti_i_aktsii/', 'windows, отримує, подарунок, сумку, ноутбука, кожен, покупець, акційних, ноутбуків, передвстановленою', 'ОС Windows отримує в подарунок сумку для ноутбука! Кожен  покупець акційних ноутбуків з передвстановленою ОС Windows отримує в  подарунок сумку для ноутбука!', '<p><span id="result_box" lang="ru"><span>&nbsp;ОС Windows,</span> <span>получает в подарок</span> <span>сумку</span> <span>для ноутбука</span><span>!</span> <span>Каждая покупка</span> <span>рекламных</span> <span>ноутбуков</span> <span>с предустановленной</span> <span>Windows,</span> <span>получает в подарок</span> <span>сумку</span> <span>для ноутбука</span><span>!</span></span></p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336477654, 1336477654, 1346689653, 0, 3, 0),
(75, 'Contact', '', 'contact_us', '', 'ssss', 'ssss', '<p><span id="result_box" lang="en"><span>Hot Phone</span><span>:</span> <span>0800</span> <span>80</span> <span>80 800</span><br /><br /> <span>Head office in</span> <span>Moscow</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>095</span> <span>095</span> <span>00</span> <span>00</span><br /><br /> <span>The main office</span> <span>in Kiev</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>098</span> <span>098</span> <span>00</span> <span>00</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295870, 1291295888, 1343664873, 35, 30, 68),
(76, 'Delivery', '', 'dostavka', '', 'support, the, delivery, service, autoworld, around, world, also, possible, all, major, cities, ukraine, and, russia, possibility, courier, your, area, please, call, desired, you, can, pick, purchased, goods, themselves, our, offices', 'We support the delivery of service Autoworld around the world. It is also possible delivery to all major cities of Ukraine and Russia (the possibility of delivery by courier in your area please call 0800820 22 22.) If desired, you can pick up the purchase', '<p><span id="result_box" lang="en"><span>We support the</span> <span>delivery of</span> <span>service</span> <span>Autoworld</span> <span>around the world.</span><br /><br /> <span>It is also possible</span> <span>delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine and Russia</span> <span>(the possibility of</span> <span>delivery</span> <span>by courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span><br /><br /> <span>If desired,</span> <span>you can</span> <span>pick up the</span> <span>purchased goods</span> <span>themselves</span> <span>in our offices.</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295844, 1291295851, 1343664842, 8, 30, 66),
(77, 'Help', '', 'help', '', 'order, purchase, goods, our, store, you, must, follow, few, simple, steps, choose, the, right, product, vospolzovavshit, navigation, left, search, add, products, cart, shopping, select, shipping, method, and, provide, your, contact', 'In order to purchase goods in our store, you must follow a few simple steps: Choose the right product, vospolzovavshit navigation on the left, or search. Add products to cart. Go to the shopping cart, select shipping method and provide your contact inform', '<p><span id="result_box" lang="en"><span>In order to</span> <span>purchase goods</span> <span>in our store,</span> <span>you must follow</span> <span>a few simple steps</span><span>:</span><br /><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Choose</span> <span>the right product,</span> <span>vospolzovavshit</span> <span>navigation</span> <span>on the left</span><span>, or</span> <span>search.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Add products</span> <span>to cart</span><span>.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Go to the</span> <span>shopping cart,</span> <span>select</span> <span>shipping method</span> <span>and provide</span> <span>your contact information.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Proceed to checkout</span> <span>and select the</span> <span>payment method.</span><br /><br /> <span>After that,</span> <span>our managers</span> <span>will contact</span> <span>you and</span> <span>help you</span> <span>with payment</span> <span>and delivery</span> <span>of the goods</span><span>, as well</span> <span>as give advice on</span> <span>any subject.</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1343664897, 11, 30, 67),
(78, 'Payment', '', 'oplata', '', 'our, store, supports, all, currently, available, methods, payment, also, there, possibility, pay, the, courier, for, delivery, major, cities, ukraine, and, russia, ability, your, area, please, call', 'Our store supports all currently available methods of payment. Also there is a possibility to pay the courier for delivery to all major cities of Ukraine and Russia. (ability to pay for the courier in your area please call 0800820 22 22.)', '<p><span id="result_box" lang="en"><span>Our store</span> <span>supports all</span> <span>currently available</span> <span>methods of payment.</span><br /><br /> <span>Also there is</span> <span>a possibility to pay</span> <span>the courier</span> <span>for delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine</span> <span>and Russia.</span> <span>(ability to</span> <span>pay for</span> <span>the courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295824, 1291295836, 1343664949, 1, 30, 65),
(79, 'About us', '', 'about', '', 'shop, imagecms, offers, huge, selection, vehicles, suit, every, taste, the, best, prices, our, store, has, more, than, years, and, during, that, time, was, not, single, return, goods, serve, hundreds, customers', 'Shop ImageCMS Shop offers a huge selection of vehicles to suit every taste at the best prices. Our store has more than 5 years and during that time was not a single return of the goods. We serve hundreds of customers every day and do it with joy. Buy equi', '<p><span id="result_box" lang="en"><span>Shop</span> <span>ImageCMS Shop</span> <span>offers</span> <span>a huge selection</span> <span>of vehicles</span> <span>to suit every taste</span> <span>at the best prices</span><span>.</span><br /><br /> <span>Our store</span> <span>has more than</span> <span>5 years</span> <span>and during that time</span> <span>was not a single</span> <span>return of the goods</span><span>.</span><br /><br /> <span>We serve</span> <span>hundreds of</span> <span>customers</span> <span>every day</span> <span>and do</span> <span>it with joy.</span><br /><br /> <span>Buy</span> <span>equipment from</span> <span>us and</span> <span>become the owner of</span> <span>the world''s best</span> <span>technology</span><span>!</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295776, 1291295792, 1343745649, 5, 30, 64),
(80, 'Site', '', 'o-sajte', '', 'new', 'new', '<p><span id="result_box" lang="en"><span>This is</span> <span>the basic template</span> <span>ImageCMS,</span> <span>which</span> <span>relizovany</span> <span>the following functions</span><span>: display</span> <span>gallery</span><span>, displaying</span> <span>static</span> <span>articles</span><span>, displaying</span> <span>a corporate blog</span><span>, displaying</span> <span>the feedback form.</span><br /><br /> <span>General view of the</span> <span>template, you can</span> <span>edit and</span> <span>change the</span> <span>logo,</span> <span>a graphic</span> <span>box on</span> <span>your</span> <span>case</span><span>.</span><br /><br /> <span>On the left</span> <span>you can see</span> <span>in the sidebar</span> <span>list of</span> <span>categories of</span> <span>the blog,</span> <span>which is easily</span> <span>inserted</span> <span>by using the</span> <span>{sub_category_list ()}</span> <span>in the file</span> <span>main.tpl.</span> <span>Also</span> <span>in the left</span> <span>sidebar</span> <span>is</span> <span>a search form</span> <span>on the site,</span> <span>recent comments</span> <span>widget</span> <span>and the widget</span> <span>tag</span> <span>site.</span> <span>In</span> <span>this</span> <span>sidebar</span> <span>you can also</span> <span>add a widget</span><span>, or</span> <span>the latest</span> <span>popular</span> <span>news,</span> <span>as well as any</span> <span>counters,</span> <span>widgets</span><span>.</span><br /><br /> <span>The top menu</span> <span>is implemented</span> <span>by the module</span> <span>menu</span><span>.</span> <span>And manage</span> <span>its content</span> <span>can be</span> <span>part</span> <span>of the</span> <span>administration</span> <span>in Menu</span> <span>-</span> <span>Main Menu.</span> <span>It</span> <span>is usually</span> <span>possible to add</span> <span>page</span> <span>about the company</span><span>, contacts,</span> <span>services, etc.</span><br /><br /> <span>For more</span> <span>information, contact the</span> <span>official</span> <span>section of the documentation</span><span>: http://www.imagecms.net/wiki</span><br /><br /> <span>Discuss</span> <span>additional opportunities</span><span>, as well as</span> <span>questions about</span> <span>installation, configuration,</span> <span>the system can be</span> <span>on the official forum</span><span>: http://forum.imagecms.net/</span></span></p>', '', 0, 'page_static', '', 0, 1, 0, 'publish', 'admin', 1267203253, 1267203328, 1343722704, 0, 30, 35),
(81, 'Action! Go to the camera Nikon S9100 - Memory Card 8 GB as a gift', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok', 'novosti_i_aktsii/', 'windows, otrimuє, podarunok, laptop, bag, kozeny, pokupets, aktsіynih, noutbukіv, peredvstanovlenoyu, the', 'Windows OS otrimuє in podarunok laptop bag! Kozeny pokupets aktsіynih noutbukіv s peredvstanovlenoyu of Windows otrimuє podarunok in the laptop bag!', '<p><span id="result_box" lang="en"><span>Windows,</span> <span>receives a gift</span> <span>bag</span> <span>for a</span> <span>laptop!</span> <span>Each purchase</span> <span>advertising</span> <span>laptops</span> <span>preloaded with</span> <span>Windows,</span> <span>receives a gift</span> <span>bag for</span> <span>a laptop</span><span>!</span></span></p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336477654, 1336477654, 1346689406, 4, 30, 73),
(82, 'Action! To the camera Nikon S9100 - 8GB memory card for free!', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok-1', 'novosti_i_aktsii/', 'windows, operating, system, receives, gift, bag, for, laptop, each, purchaser, promotional, notebooks, with', 'Windows operating system receives a gift bag for a laptop! Each purchaser of promotional notebooks with Windows receives a gift bag for a laptop!', '<p><span id="result_box" lang="en"><span>Windows</span> <span>operating system</span> <span>receives a gift</span> <span>bag for</span> <span>a laptop</span><span>!</span> <span>Each purchaser</span> <span>of promotional</span> <span>notebooks</span> <span>with Windows</span> <span>receives a gift</span> <span>bag for</span> <span>a laptop</span><span>!</span></span></p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336737588, 1336737588, 1346689276, 0, 30, 74);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `content_fields_data`
--

INSERT INTO `content_fields_data` (`id`, `item_id`, `item_type`, `field_name`, `data`) VALUES
(10, 74, 'page', 'field_pole2', '0'),
(9, 74, 'page', 'field_field1', ''),
(5, 72, 'page', 'field_field1', ''),
(6, 72, 'page', 'field_pole2', '0'),
(7, 73, 'page', 'field_field1', ''),
(8, 73, 'page', 'field_pole2', '0'),
(11, 81, 'page', 'field_field1', ''),
(12, 81, 'page', 'field_pole2', '0'),
(13, 82, 'page', 'field_field1', ''),
(14, 82, 'page', 'field_pole2', '0');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `content_permissions`
--

INSERT INTO `content_permissions` (`id`, `page_id`, `data`) VALUES
(21, 35, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}'),
(23, 80, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}');

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

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields_data`
--

CREATE TABLE IF NOT EXISTS `custom_fields_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `field_data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(3, 'Русский', 'ru', '', 'russian', 'commerce', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=174 ;

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
(35, 1, 'admin', '\n      Создал страницу\n     <a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336736882),
(36, 1, 'admin', '\n        Изменил страницу\n        <a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737315),
(37, 1, 'admin', 'Изменил язык Русский', 1336737433),
(38, 1, 'admin', 'Удалил страницу ID 69', 1336737581),
(39, 1, 'admin', '\n      Создал страницу\n     <a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/74''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737610),
(40, 1, 'admin', '\n        Изменил страницу\n        <a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737669),
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
(71, 1, 'admin', 'Очистил кеш', 1340031146),
(72, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1340120888),
(73, 1, 'admin', 'Очистил кеш', 1340121004),
(74, 1, 'admin', 'Изменил настройки сайта', 1340121068),
(75, 1, 'admin', 'Изменил настройки сайта', 1340121079),
(76, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1341221521),
(77, 1, 'admin', 'Очистил кеш', 1341225009),
(78, 1, 'admin', 'Очистил кеш', 1341238429),
(79, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1342006563),
(80, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343634959),
(81, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343638277),
(82, 1, 'admin', 'Изменил язык English', 1343660593),
(83, 1, 'admin', 'Изменил настройки сайта', 1343662835),
(84, 1, 'admin', 'Изменил настройки сайта', 1343662840),
(85, 1, 'admin', '\n                    Создал перевод категории \n                    <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663189),
(86, 1, 'admin', '\n                        Изменил категорию   \n                        <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663190),
(87, 1, 'admin', '\n                    Создал перевод категории \n                    <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663206),
(88, 1, 'admin', '\n                    Изменил перевод категории \n                    <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663210),
(89, 1, 'admin', '\n                        Изменил категорию   \n                        <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663212),
(90, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/75''); return false;">Contact</a>', 1343663245),
(91, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/76''); return false;">Delivery</a>', 1343664818),
(92, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/76''); return false;">Delivery</a>', 1343664842),
(93, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/75''); return false;">Contact</a>', 1343664873),
(94, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/77''); return false;">Help</a>', 1343664897),
(95, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/78''); return false;">Payment</a>', 1343664949),
(96, 1, 'admin', 'Назначил язык English по умолчанию', 1343666453),
(97, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343722531),
(98, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/80''); return false;">Site</a>', 1343722690),
(99, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/80''); return false;">Site</a>', 1343722704),
(100, 1, 'admin', 'Назначил язык Русский по умолчанию', 1343722791),
(101, 1, 'admin', 'Назначил язык English по умолчанию', 1343722888),
(102, 1, 'admin', 'Назначил язык Русский по умолчанию', 1343729093),
(103, 1, 'admin', 'Назначил язык English по умолчанию', 1343731979),
(104, 1, 'admin', 'Назначил язык Русский по умолчанию', 1343732620),
(105, 1, 'admin', 'Назначил язык English по умолчанию', 1343732630),
(106, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/81''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок</a>', 1343742434),
(107, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/81''); return false;">Action! Go to the camera Nikon S9100 - Memory Card 8 GB as a gift</a>', 1343743284),
(108, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1343743335),
(109, 1, 'admin', 'Назначил язык Русский по умолчанию', 1343743942),
(110, 1, 'admin', 'Назначил язык English по умолчанию', 1343744091),
(111, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343745310),
(112, 1, 'admin', '\n                    Создал перевод категории \n                    <a href="#" onclick="edit_category(56); return false;">Новости и акции</a>', 1343745337),
(113, 1, 'admin', '\n                        Изменил категорию   \n                        <a href="#" onclick="edit_category(56); return false;">Новости и акции</a>', 1343745338),
(114, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/79''); return false;">О магазине</a>', 1343745634),
(115, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/79''); return false;">About us</a>', 1343745649),
(116, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343746228),
(117, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343817774),
(118, 1, 'admin', 'Очистил кеш', 1343817792),
(119, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343821049),
(120, 1, 'admin', 'Очистил кеш', 1343823630),
(121, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343824889),
(122, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1344417771),
(123, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1344421833),
(124, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1344934178),
(125, 91, 'admin', 'Вышел из панели управления', 1345645124),
(126, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1345645129),
(127, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346317936),
(128, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346317945),
(129, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346324068),
(130, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346324574),
(131, 1, 'admin', 'Назначил язык English по умолчанию', 1346324584),
(132, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346324961),
(133, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346324967),
(134, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346325655),
(135, 1, 'admin', 'Назначил язык English по умолчанию', 1346325661),
(136, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346327229),
(137, 1, 'admin', 'Вышел из панели управления', 1346327242),
(138, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346327269),
(139, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346328114),
(140, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346328122),
(141, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346329962),
(142, 1, 'admin', 'Назначил язык English по умолчанию', 1346329969),
(143, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346330003),
(144, 1, 'admin', 'Установил модуль share', 1346335886),
(145, 1, 'admin', 'Установил модуль mailer', 1346336110),
(146, 1, 'admin', 'Удалил модуль mailer', 1346337410),
(147, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346412457),
(148, 1, 'admin', 'Назначил язык English по умолчанию', 1346412500),
(149, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346412518),
(150, 1, 'admin', 'Назначил язык English по умолчанию', 1346413745),
(151, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346414503),
(152, 1, 'admin', 'Назначил язык English по умолчанию', 1346419627),
(153, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346419656),
(154, 1, 'admin', 'Назначил язык English по умолчанию', 1346420326),
(155, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346426990),
(156, 1, 'admin', 'Установил модуль user_support', 1346427036),
(157, 1, 'admin', 'Удалил модуль user_support', 1346427057),
(158, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346682174),
(159, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346685108),
(160, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346686365),
(161, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346686825),
(162, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346689135),
(163, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/82''); return false;">Action! To the camera Nikon S9100 - 8GB memory card for free!</a>', 1346689276),
(164, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/74''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1346689293),
(165, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1346689386),
(166, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/81''); return false;">Action! Go to the camera Nikon S9100 - Memory Card 8 GB as a gift</a>', 1346689406),
(167, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1346689653),
(168, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346693110),
(169, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346744686),
(170, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346745879),
(171, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346749198),
(172, 1, 'admin', 'Очистил кеш', 1346752792),
(173, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346759724);

-- --------------------------------------------------------

-- Структура таблицы `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `date` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

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
(28, 5, 0, 'url', '', '', 0, 'Авто музыка и видео', 0, 10, NULL, 'a:2:{s:3:"url";s:34:"/shop/category/avto_muzyka_i_video";s:7:"newpage";s:1:"0";}');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `data`) VALUES
(1, 10, 'a:37:{s:9:"cp_access";s:1:"1";s:13:"cp_autoupdate";s:1:"1";s:14:"cp_page_search";s:1:"1";s:11:"lang_create";s:1:"1";s:9:"lang_edit";s:1:"1";s:11:"lang_delete";s:1:"1";s:16:"cp_site_settings";s:1:"1";s:11:"cache_clear";s:1:"1";s:11:"page_create";s:1:"1";s:9:"page_edit";s:1:"1";s:11:"page_delete";s:1:"1";s:15:"category_create";s:1:"1";s:13:"category_edit";s:1:"1";s:15:"category_delete";s:1:"1";s:14:"module_install";s:1:"1";s:16:"module_deinstall";s:1:"1";s:12:"module_admin";s:1:"1";s:13:"widget_create";s:1:"1";s:13:"widget_delete";s:1:"1";s:22:"widget_access_settings";s:1:"1";s:11:"menu_create";s:1:"1";s:9:"menu_edit";s:1:"1";s:11:"menu_delete";s:1:"1";s:11:"user_create";s:1:"1";s:21:"user_create_all_roles";s:1:"1";s:9:"user_edit";s:1:"1";s:11:"user_delete";s:1:"1";s:14:"user_view_data";s:1:"1";s:12:"roles_create";s:1:"1";s:10:"roles_edit";s:1:"1";s:12:"roles_delete";s:1:"1";s:9:"logs_view";s:1:"1";s:13:"backup_create";s:1:"1";s:15:"tinybrowser_all";s:1:"1";s:18:"tinybrowser_upload";s:1:"1";s:16:"tinybrowser_edit";s:1:"1";s:19:"tinybrowser_folders";s:1:"1";}');

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
(1346160931);

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
(10, 0, 'admin', 'Администраторы', '');

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
  PRIMARY KEY (`id`),
  KEY `s_name` (`s_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `site_title`, `site_short_title`, `site_description`, `site_keywords`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `google_analytics_id`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`, `lang_sel`) VALUES
(2, 'main', 'test', 'ImageCMS Shop', 'Продажа качественной техники с гарантией и доставкой', 'магазин техники, покупка техники, доставка техники', 'auto', 'auto', '0', '0', 1, 1, '/', 'full', 'commerce', 'no', '', 'module', 69, '56', 'shop', '', '', 'russian_lang');

-- --------------------------------------------------------

--
-- Table structure for table `shop_banners`
--

CREATE TABLE IF NOT EXISTS `shop_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_banners_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
(1, 'ru', 'Samsung LN40C650 40', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/74', '1_ru.jpg'),
(3, 'ru', 'Panasonic KX-TG7433B Expandable', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/106', '3_ru.jpg'),
(4, 'ru', 'Samsung NX10 14 Megapixel Digital', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/98', '4_ru.jpg'),
(4, 'ua', 'Samsung NX10 14 Megapixel Digital', '<p>Високо технологічний продукт, який допоможе Вам оцінити якість.</p>', '/shop/product/98', '4_ua.jpg'),
(3, 'ua', 'Panasonic KX-TG7433B Expandable', '<p>Високо технологічний продукт, який допоможе Вам оцінити якість.</p>', '/shop/product/106', '3_ua.jpg'),
(4, 'en', 'Samsung NX10 14 Megapixel Digital', '<p> high technology product that will help you evaluate the quality. </ p>', '/shop/product/74', '4_en.jpg'),
(3, 'en', 'Panasonic KX-TG7433B Expandable', '<p> high technology product that will help you evaluate the quality. </ p>', '/shop/product/75', '3_en.jpg'),
(1, 'en', 'Samsung LN40C650 40', '<p><span id=', '/shop/product/76', '1_en.jpg');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

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
(29, 'impression-computers', 'impression-computers.png');

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
(31, 'en', 'Samsung', '', '', '', ''),
(29, 'en', 'Impression Computers', '', '', '', ''),
(26, 'en', 'Hewlett Packard', '', '', '', ''),
(30, 'en', 'Bravo Computers', '', '', '', ''),
(28, 'en', 'Brain', '', '', '', ''),
(27, 'en', 'Apple', '', '', '', ''),
(32, 'en', 'Panasonic', '', '', '', '');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `tpl` varchar(250) DEFAULT NULL,
  `order_method` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_category_I_2` (`url`),
  KEY `shop_category_I_3` (`active`),
  KEY `shop_category_I_4` (`parent_id`),
  KEY `shop_category_I_5` (`position`),
  KEY `shop_category_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

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

-- --------------------------------------------------------

-- Структура таблицы `shop_comulativ_discount`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

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
(1, 'Dollars', 0, 0, 'USD', '$', 0.400),
(2, 'Ruble', 1, 1, 'RUR', 'RUR', 1.000);

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
(7, 'ua', 'Самовивезення', ''),
(5, 'en', 'Courier', ''),
(6, 'en', 'AutoWorld', ''),
(7, 'en', 'Pickup', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_gifts`
--

CREATE TABLE IF NOT EXISTS `shop_gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `espdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_notifications`
--

INSERT INTO `shop_notifications` (`id`, `product_id`, `variant_id`, `user_name`, `user_email`, `user_phone`, `user_comment`, `status`, `date_created`, `active_to`, `manager_id`, `notified_by_email`) VALUES
(2, 102, 113, 'фывывфыв', 'asdsasad@mail.ru', 'фывфвфыв', 'ыфв', 2, 1343638402, 1343638402, NULL, 0),
(3, 102, 113, 'фвыв', 'asdsa@mail.ru', 'adsdasd', 'asdsdsdd', 1, 1343744944, 1343744944, NULL, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`id`, `key`, `delivery_method`, `delivery_price`, `status`, `paid`, `user_full_name`, `user_email`, `user_phone`, `user_deliver_to`, `user_comment`, `date_created`, `date_updated`, `user_ip`, `user_id`, `payment_method`, `total_price`, `external_id`, `gift_cert_key`, `gift_cert_price`) VALUES
(10, 'i5077926yf', 5, 0.00, 1, NULL, 'Administrator', 'admin@localhost.loc', '+7123456789', 'Россия, г Москва', '', 1342007508, 1342007508, '127.0.0.1', 1, 4, 999.99, NULL, NULL, NULL),
(9, 'n0z76159t2', 7, 0.00, 2, 1, 'Administrator', 'admin@localhost.loc', '+7123456789', 'Россия, г Москва', '', 1342007474, 1342007474, '127.0.0.1', 1, 1, 698.00, NULL, NULL, NULL),
(11, 'li865v3686', 7, 0.00, 1, NULL, 'Administrator', 'admin@localhost.loc', '+7123456789', 'Россия, г Москва', '', 1343641791, 1343641791, '127.0.0.1', 1, 1, 44.77, NULL, NULL, NULL),
(12, 'u2051a676j', 7, 0.00, 1, NULL, 'Administrator', 'admin@localhost.loc', '+7123456789', 'Россия, г Москва', '', 1343665999, 1343665999, '127.0.0.1', 1, 1, 99.95, NULL, NULL, NULL),
(13, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `shop_orders_products`
--

INSERT INTO `shop_orders_products` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `price`, `quantity`, `kit_id`, `is_main`) VALUES
(19, 10, 72, 83, 'LG 47LD450 - 47" Widescreen 1080p LCD HDTV', '', 999.99, 1, NULL, NULL),
(18, 9, 87, 98, 'Sony HT-SS370 Home Theater', '', 349.00, 2, NULL, NULL),
(20, 11, 80, 91, 'LG DN898 DVD Player', '', 44.77, 1, NULL, NULL),
(21, 12, 94, 105, 'Yamaha NSIW760 Speaker', '', 99.95, 1, NULL, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shop_orders_status_history`
--

INSERT INTO `shop_orders_status_history` (`id`, `order_id`, `status_id`, `user_id`, `date_created`, `comment`) VALUES
(8, 9, 2, 1, 1342007520, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
(4, 'ru', 'Robokassa', '<p>Оплата с помощью Robokassa</p>'),
(1, 'en', 'Payment for the courier', ''),
(2, 'en', 'Payment by bank', ''),
(3, 'en', 'Sberbank of Russia', ''),
(4, 'en', 'Robokassa', '');

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
  `tpl` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_products_I_2` (`url`),
  KEY `shop_products_I_3` (`brand_id`),
  KEY `shop_products_I_4` (`category_id`),
  KEY `shop_products_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=184 ;

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
(108, 2, 6),
(72, 1, 5),
(74, 2, 8),
(75, 2, 9),
(94, 1, 4),
(87, 1, 5);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `shop_product_properties`
--

INSERT INTO `shop_product_properties` (`id`, `csv_name`, `active`, `show_in_compare`, `position`, `show_on_site`, `multiple`, `external_id`, `show_in_filter`, `main_property`) VALUES
(20, 'displaytech', 1, 1, 1, 1, 0, NULL, 1, 0),
(21, 'razmerekrana', 1, 1, 2, 1, 0, NULL, 0, 0),
(22, 'hdmi', 1, 1, 3, 1, 0, NULL, 1, 0),
(23, 'power', 1, 1, 4, 1, 0, NULL, 0, 0),
(24, 'digitalopticalinput', 1, 1, 5, 1, 0, NULL, 0, 0),
(25, 'focus', 1, 1, 6, 1, 0, NULL, 0, 0),
(26, 'megapixel', 1, 1, 7, 1, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties_data_i18n`
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
-- Table structure for table `shop_product_properties_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties_categories` (
  `property_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`category_id`),
  KEY `shop_product_properties_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_data`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_i18n`
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
-- Dumping data for table `shop_product_properties_i18n`
--

INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`, `data`) VALUES
(26, 'Количество мегапикселей', 'ru', NULL),
(25, 'Настройка фокуса', 'ru', NULL),
(24, 'Количество цифровых входов', 'ru', NULL),
(23, 'Мощность', 'ru', ''),
(22, 'HDMI', 'ru', 'a:2:{i:0;s:4:"Да";i:1;s:6:"Нет";}'),
(21, 'Размер экрана', 'ru', ''),
(20, 'Технология дисплея', 'ru', 'a:3:{i:0;s:3:"LED";i:1;s:3:"LCD";i:2;s:6:"Plasma";}'),
(20, 'Технологія дисплею', 'ua', 'a:4:{i:0;s:6:"LED-ua";i:1;s:9:"Plasma-ua";i:2;s:9:"Litium-ua";i:3;s:8:"Freon-ua";}'),
(20, 'Display Technology', 'en', ''),
(21, 'Screen Size', 'en', ''),
(22, 'HDMI', 'en', 'a:2:{i:0;s:3:"Yes";i:1;s:2:"No";}'),
(23, 'Power', 'en', ''),
(24, 'Number of digital inputs', 'en', ''),
(25, 'Setting the focus', 'en', ''),
(26, 'The number of megapixels', 'en', '');

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
  `currency` int(11) DEFAULT NULL,
  `price_in_main` float(10,5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_variants_I_1` (`product_id`),
  KEY `shop_product_variants_I_2` (`position`),
  KEY `shop_product_variants_I_3` (`number`),
  KEY `shop_product_variants_I_5` (`price`),
  KEY `shop_product_variants_I_4` (`price`),
  KEY `shop_product_variants_FI_2` (`currency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=208 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1943 ;

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
('mainImageWidth', '750', ''),
('mainImageHeight', '635', ''),
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
('watermark_wm_hor_alignment', 'Слева', ''),
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
('1CCatSettings', 'a:4:{s:3:"zip";s:6:"zip=no";s:8:"filesize";s:15:"file_limit=1024";s:7:"validIP";s:9:"127.0.0.1";s:8:"password";s:0:"";}', ''),
('adminMessages', 'a:3:{s:8:"incoming";s:0:"";s:8:"callback";s:27:"вфы вфыв фыв фы";s:5:"order";s:0:"";}', 'ru'),
('selectedProductCats', 'a:5:{i:0;s:2:"36";i:1;s:2:"37";i:2;s:2:"38";i:3;s:2:"39";i:4;s:2:"41";}', ''),
('adminMessageIncoming', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>', ''),
('adminMessageOrderPage', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>', ''),
('mainModImageWidth', '140', ''),
('mainModImageHeight', '100', ''),
('smallModImageWidth', '90', ''),
('smallModImageHeight', '90', ''),
('order_method', '1', ''),
('forgotPasswordMessageText', 'Здравствуйте!\n\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\n\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri% \n\nВаш новый пароль для входа: %password%\n\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\n\n\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\n\nС уважением, \nсотрудники службы продаж %webSiteName%', 'en'),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22', 'en'),
('ordersSenderName', 'DemoShop ImageCms.net', 'en'),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки', 'en'),
('ordersManagerEmail', '', ''),
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
('1CSettingsOS', 'N;', ''),
('MemcachedSettings', 'a:5:{s:11:"MEMCACHE_ON";b:0;s:17:"MEMCACHE_HOSTNAME";s:9:"localhost";s:13:"MEMCACHE_PORT";s:5:"11211";s:18:"MEMCACHE_NAMESPACE";s:13:"imagecms_shop";s:13:"CACHE_EXPIRES";s:4:"3600";}', ''),
('adminMessageMonkey', '', ''),
('adminMessageMonkeylist', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_spy`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_spy`
--

INSERT INTO `shop_spy` (`id`, `user_id`, `product_id`, `price`) VALUES
(1, 1, 73, 899),
(2, 1, 74, 899);

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
  `user_external_id` varchar(255) DEFAULT NULL,
  `amout` float(10,2) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_user_profile_I_1` (`key`),
  KEY `shop_user_profile_FI_1` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) DEFAULT NULL,
  `newpass` varchar(255) DEFAULT NULL,
  `newpass_key` varchar(255) DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
=======
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category_translate`
--

INSERT INTO `category_translate` (`id`, `alias`, `name`, `title`, `short_desc`, `image`, `keywords`, `description`, `lang`) VALUES
(6, 1, 'Home', '', '', '', '', '', 30),
(7, 1, 'Главная', '', '', '', '', '', 3),
(8, 56, 'News and Events', '', '', '', '', '', 30);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `module`, `user_id`, `user_name`, `user_mail`, `user_site`, `item_id`, `text`, `date`, `status`, `agent`, `user_ip`, `rate`, `text_plus`, `text_minus`, `like`, `disslike`, `parent`) VALUES
(25, 'shop', 1, 'admin', 'admin@localhost.loc', '', 108, 'Отличный выбор!', 1328007661, 0, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.77 Safari/535.7', '127.0.0.2', 0, NULL, NULL, 0, 0, NULL);

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
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `identif` (`identif`),
  KEY `enabled` (`enabled`),
  KEY `autoload` (`autoload`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=126 ;

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
(121, 'shop', 'shop', 1, 0, 0, NULL),
(123, 'share', 'share', 0, 0, 0, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`) VALUES
(35, 'О сайте', '', 'o-sajte', '', 'это, базовый, шаблон, imagecms, котором, релизованы, следующие, функции, вывод, фотогалереи, статической, статьи, блога', 'Это базовый шаблон ImageCMS, на котором релизованы следующие функции: вывод фотогалереи, вывод статической статьи, вывод блога.', '<p>Это базовый шаблон ImageCMS, на котором релизованы следующие функции: отображение фотогалереи, отображение статической статьи, отображение корпоративного блога, отображение формы обратной связи.</p>\n<p>Общий вид шаблона можно отредактировать и изменить лого, графическую вставку на свои тематические.</p>\n<p>Слева в сайдбаре Вы видите список категорий блога, который легко вставляется с помощью функции {sub_category_list()} в файле main.tpl. Также в левом сайдбаре находится форма поиска по сайту, виджет последних комментариев и виджет тегов сайта. В этот сайдбар можно также добавить виджет последних либо популярных новостей, а также любые счетчики, информеры.</p>\n<p>Верхнее меню реализовано с помощью модуля Меню. Управлять его содержимым можно из административной части в разделе Меню - Главное меню. Сюда как правило можно еще добавить страницы: о компании, контакты, услуги и т.п.</p>\n<p>За дополнительной информацией обращайтесь в официальный раздел документации: <a href="http://www.imagecms.net/wiki">http://www.imagecms.net/wiki</a></p>\n<p>Обсудить дополнительные возможности, а также вопросы по установке, настройке системы можно на официальном форуме: <a href="http://forum.imagecms.net/index.php">http://forum.imagecms.net/</a></p>', '', 0, 'page_static', '', 0, 1, 0, 'publish', 'admin', 1267203253, 1267203328, 1290100400, 8, 3, 0),
(64, 'О магазине', '', 'about', '', 'магазине', 'О магазине', '<p>Магазин ImageCMS Shop предоставляет огромный выбор техники на любой вкус по лучшим ценам.</p>\n<p>Наш магазин существует более 5 лет и за это время не было ни единого возврата товара.</p>\n<p>Мы обслуживаем ежедневно сотни покупателей и делаем это с радостью.</p>\n<p><strong>Покупайте технику у нас и становитесь обладателем лучшей в мире техники!!!</strong></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295776, 1291295792, 1291743386, 287, 3, 0),
(65, 'Оплата', '', 'oplata', '', 'оплата', 'Оплата', '<p>Наш магазин поддерживает все доступные на данный момент методы оплаты.</p>\n<p>Также действует возможность оплаты курьеру при доставке для всех крупных городов Украины и России. (возможность оплаты курьеру в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295824, 1291295836, 1291743521, 167, 3, 0),
(66, 'Доставка', '', 'dostavka', '', 'доставка', 'Доставка', '<p>Мы поддерживаем доставку службой Автомир по всему миру.</p>\n<p>Также возможна доставка курьером для всех больших городов Украины и России (возможность доставки курьером в Вашем городе уточняйте по телефону <strong>0 800 820 22 22</strong>).</p>\n<p>При желании Вы можете сами забрать купленный товар в наших офисах.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295844, 1291295851, 1291743683, 125, 3, 0),
(67, 'Помощь', '', 'help', '', 'помощь', 'Помощь', '<p>Для того, чтобы приобрести товар в нашем магазине, Вам нужно выполнить несколько простых шагов:</p>\n<ul>\n<li>Выбрать нужный товар, воспользовавшить навигацией слева, либо поиском.</li>\n<li>Добавить товар в корзину.</li>\n<li>Перейти в корзину, выбрать способ доставки и указать Ваши контактные данные.</li>\n<li>Подтвердить заказ и выбрать способ оплаты.</li>\n</ul>\n<p>После этого наши менеджеры свяжуться с Вами и помогут с оплатой и доставкой товара, а также проконсультируют по любому вопросу.</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1291743919, 75, 3, 0),
(68, 'Контакты', '', 'contact_us', '', 'контакты', 'Контакты', '<p><strong>Горячий телефон</strong>: 0 800 80 80 800</p>\n<p><strong>Главный офис в Москве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 095 095 00 00</p>\n<p>&nbsp;</p>\n<p><strong>Главный офис в Киеве</strong></p>\n<p>ул. Гагарина 1/2</p>\n<p>тел. 098 098 00 00</p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295870, 1291295888, 1291744068, 73, 3, 0),
(74, 'Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok-1', 'novosti_i_aktsii/', 'windows, отримує, подарунок, сумку, ноутбука, кожен, покупець, акційних, ноутбуків, передвстановленою', 'ОС Windows отримує в подарунок сумку для ноутбука! Кожен покупець акційних ноутбуків з передвстановленою ОС Windows отримує в подарунок сумку для ноутбука!', '<p>ОС Windows получает в подарок сумку для ноутбука! Каждый покупатель акционных ноутбуков с предустановленной ОС Windows получает в подарок сумку для ноутбука!</p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336737588, 1336737588, 1346689293, 3, 3, 0),
(73, 'Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok', 'novosti_i_aktsii/', 'windows, отримує, подарунок, сумку, ноутбука, кожен, покупець, акційних, ноутбуків, передвстановленою', 'ОС Windows отримує в подарунок сумку для ноутбука! Кожен  покупець акційних ноутбуків з передвстановленою ОС Windows отримує в  подарунок сумку для ноутбука!', '<p><span id="result_box" lang="ru"><span>&nbsp;ОС Windows,</span> <span>получает в подарок</span> <span>сумку</span> <span>для ноутбука</span><span>!</span> <span>Каждая покупка</span> <span>рекламных</span> <span>ноутбуков</span> <span>с предустановленной</span> <span>Windows,</span> <span>получает в подарок</span> <span>сумку</span> <span>для ноутбука</span><span>!</span></span></p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336477654, 1336477654, 1346689653, 0, 3, 0),
(75, 'Contact', '', 'contact_us', '', 'ssss', 'ssss', '<p><span id="result_box" lang="en"><span>Hot Phone</span><span>:</span> <span>0800</span> <span>80</span> <span>80 800</span><br /><br /> <span>Head office in</span> <span>Moscow</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>095</span> <span>095</span> <span>00</span> <span>00</span><br /><br /> <span>The main office</span> <span>in Kiev</span><br /><br /> <span>street</span><span>.</span> <span>Gagarin</span> <span>half</span><br /><br /> <span>tel.</span> <span>098</span> <span>098</span> <span>00</span> <span>00</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295870, 1291295888, 1343664873, 35, 30, 68),
(76, 'Delivery', '', 'dostavka', '', 'support, the, delivery, service, autoworld, around, world, also, possible, all, major, cities, ukraine, and, russia, possibility, courier, your, area, please, call, desired, you, can, pick, purchased, goods, themselves, our, offices', 'We support the delivery of service Autoworld around the world. It is also possible delivery to all major cities of Ukraine and Russia (the possibility of delivery by courier in your area please call 0800820 22 22.) If desired, you can pick up the purchase', '<p><span id="result_box" lang="en"><span>We support the</span> <span>delivery of</span> <span>service</span> <span>Autoworld</span> <span>around the world.</span><br /><br /> <span>It is also possible</span> <span>delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine and Russia</span> <span>(the possibility of</span> <span>delivery</span> <span>by courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span><br /><br /> <span>If desired,</span> <span>you can</span> <span>pick up the</span> <span>purchased goods</span> <span>themselves</span> <span>in our offices.</span></span></p>', '', 0, '', '', 0, 1, 4, 'publish', 'admin', 1291295844, 1291295851, 1343664842, 8, 30, 66),
(77, 'Help', '', 'help', '', 'order, purchase, goods, our, store, you, must, follow, few, simple, steps, choose, the, right, product, vospolzovavshit, navigation, left, search, add, products, cart, shopping, select, shipping, method, and, provide, your, contact', 'In order to purchase goods in our store, you must follow a few simple steps: Choose the right product, vospolzovavshit navigation on the left, or search. Add products to cart. Go to the shopping cart, select shipping method and provide your contact inform', '<p><span id="result_box" lang="en"><span>In order to</span> <span>purchase goods</span> <span>in our store,</span> <span>you must follow</span> <span>a few simple steps</span><span>:</span><br /><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Choose</span> <span>the right product,</span> <span>vospolzovavshit</span> <span>navigation</span> <span>on the left</span><span>, or</span> <span>search.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Add products</span> <span>to cart</span><span>.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Go to the</span> <span>shopping cart,</span> <span>select</span> <span>shipping method</span> <span>and provide</span> <span>your contact information.</span><br />&nbsp;&nbsp;&nbsp;&nbsp; <span>Proceed to checkout</span> <span>and select the</span> <span>payment method.</span><br /><br /> <span>After that,</span> <span>our managers</span> <span>will contact</span> <span>you and</span> <span>help you</span> <span>with payment</span> <span>and delivery</span> <span>of the goods</span><span>, as well</span> <span>as give advice on</span> <span>any subject.</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295855, 1291295867, 1343664897, 11, 30, 67),
(78, 'Payment', '', 'oplata', '', 'our, store, supports, all, currently, available, methods, payment, also, there, possibility, pay, the, courier, for, delivery, major, cities, ukraine, and, russia, ability, your, area, please, call', 'Our store supports all currently available methods of payment. Also there is a possibility to pay the courier for delivery to all major cities of Ukraine and Russia. (ability to pay for the courier in your area please call 0800820 22 22.)', '<p><span id="result_box" lang="en"><span>Our store</span> <span>supports all</span> <span>currently available</span> <span>methods of payment.</span><br /><br /> <span>Also there is</span> <span>a possibility to pay</span> <span>the courier</span> <span>for delivery</span> <span>to all</span> <span>major cities</span> <span>of Ukraine</span> <span>and Russia.</span> <span>(ability to</span> <span>pay for</span> <span>the courier</span> <span>in your area</span> <span>please call</span> <span>0800820</span> <span>22 22</span><span>.)</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295824, 1291295836, 1343664949, 1, 30, 65),
(79, 'About us', '', 'about', '', 'shop, imagecms, offers, huge, selection, vehicles, suit, every, taste, the, best, prices, our, store, has, more, than, years, and, during, that, time, was, not, single, return, goods, serve, hundreds, customers', 'Shop ImageCMS Shop offers a huge selection of vehicles to suit every taste at the best prices. Our store has more than 5 years and during that time was not a single return of the goods. We serve hundreds of customers every day and do it with joy. Buy equi', '<p><span id="result_box" lang="en"><span>Shop</span> <span>ImageCMS Shop</span> <span>offers</span> <span>a huge selection</span> <span>of vehicles</span> <span>to suit every taste</span> <span>at the best prices</span><span>.</span><br /><br /> <span>Our store</span> <span>has more than</span> <span>5 years</span> <span>and during that time</span> <span>was not a single</span> <span>return of the goods</span><span>.</span><br /><br /> <span>We serve</span> <span>hundreds of</span> <span>customers</span> <span>every day</span> <span>and do</span> <span>it with joy.</span><br /><br /> <span>Buy</span> <span>equipment from</span> <span>us and</span> <span>become the owner of</span> <span>the world''s best</span> <span>technology</span><span>!</span></span></p>', '', 0, '', '', 0, 1, 0, 'publish', 'admin', 1291295776, 1291295792, 1343745649, 5, 30, 64),
(80, 'Site', '', 'o-sajte', '', 'new', 'new', '<p><span id="result_box" lang="en"><span>This is</span> <span>the basic template</span> <span>ImageCMS,</span> <span>which</span> <span>relizovany</span> <span>the following functions</span><span>: display</span> <span>gallery</span><span>, displaying</span> <span>static</span> <span>articles</span><span>, displaying</span> <span>a corporate blog</span><span>, displaying</span> <span>the feedback form.</span><br /><br /> <span>General view of the</span> <span>template, you can</span> <span>edit and</span> <span>change the</span> <span>logo,</span> <span>a graphic</span> <span>box on</span> <span>your</span> <span>case</span><span>.</span><br /><br /> <span>On the left</span> <span>you can see</span> <span>in the sidebar</span> <span>list of</span> <span>categories of</span> <span>the blog,</span> <span>which is easily</span> <span>inserted</span> <span>by using the</span> <span>{sub_category_list ()}</span> <span>in the file</span> <span>main.tpl.</span> <span>Also</span> <span>in the left</span> <span>sidebar</span> <span>is</span> <span>a search form</span> <span>on the site,</span> <span>recent comments</span> <span>widget</span> <span>and the widget</span> <span>tag</span> <span>site.</span> <span>In</span> <span>this</span> <span>sidebar</span> <span>you can also</span> <span>add a widget</span><span>, or</span> <span>the latest</span> <span>popular</span> <span>news,</span> <span>as well as any</span> <span>counters,</span> <span>widgets</span><span>.</span><br /><br /> <span>The top menu</span> <span>is implemented</span> <span>by the module</span> <span>menu</span><span>.</span> <span>And manage</span> <span>its content</span> <span>can be</span> <span>part</span> <span>of the</span> <span>administration</span> <span>in Menu</span> <span>-</span> <span>Main Menu.</span> <span>It</span> <span>is usually</span> <span>possible to add</span> <span>page</span> <span>about the company</span><span>, contacts,</span> <span>services, etc.</span><br /><br /> <span>For more</span> <span>information, contact the</span> <span>official</span> <span>section of the documentation</span><span>: http://www.imagecms.net/wiki</span><br /><br /> <span>Discuss</span> <span>additional opportunities</span><span>, as well as</span> <span>questions about</span> <span>installation, configuration,</span> <span>the system can be</span> <span>on the official forum</span><span>: http://forum.imagecms.net/</span></span></p>', '', 0, 'page_static', '', 0, 1, 0, 'publish', 'admin', 1267203253, 1267203328, 1343722704, 0, 30, 35),
(81, 'Action! Go to the camera Nikon S9100 - Memory Card 8 GB as a gift', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok', 'novosti_i_aktsii/', 'windows, otrimuє, podarunok, laptop, bag, kozeny, pokupets, aktsіynih, noutbukіv, peredvstanovlenoyu, the', 'Windows OS otrimuє in podarunok laptop bag! Kozeny pokupets aktsіynih noutbukіv s peredvstanovlenoyu of Windows otrimuє podarunok in the laptop bag!', '<p><span id="result_box" lang="en"><span>Windows,</span> <span>receives a gift</span> <span>bag</span> <span>for a</span> <span>laptop!</span> <span>Each purchase</span> <span>advertising</span> <span>laptops</span> <span>preloaded with</span> <span>Windows,</span> <span>receives a gift</span> <span>bag for</span> <span>a laptop</span><span>!</span></span></p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336477654, 1336477654, 1346689406, 4, 30, 73),
(82, 'Action! To the camera Nikon S9100 - 8GB memory card for free!', '', 'aktsiia-k-fotoapparatu-nikon-s9100-karta-pamiati-8gb-v-podarok-1', 'novosti_i_aktsii/', 'windows, operating, system, receives, gift, bag, for, laptop, each, purchaser, promotional, notebooks, with', 'Windows operating system receives a gift bag for a laptop! Each purchaser of promotional notebooks with Windows receives a gift bag for a laptop!', '<p><span id="result_box" lang="en"><span>Windows</span> <span>operating system</span> <span>receives a gift</span> <span>bag for</span> <span>a laptop</span><span>!</span> <span>Each purchaser</span> <span>of promotional</span> <span>notebooks</span> <span>with Windows</span> <span>receives a gift</span> <span>bag for</span> <span>a laptop</span><span>!</span></span></p>', '', 56, '', '', 0, 1, 0, 'publish', 'admin', 1336737588, 1336737588, 1346689276, 0, 30, 74);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `content_fields_data`
--

INSERT INTO `content_fields_data` (`id`, `item_id`, `item_type`, `field_name`, `data`) VALUES
(10, 74, 'page', 'field_pole2', '0'),
(9, 74, 'page', 'field_field1', ''),
(5, 72, 'page', 'field_field1', ''),
(6, 72, 'page', 'field_pole2', '0'),
(7, 73, 'page', 'field_field1', ''),
(8, 73, 'page', 'field_pole2', '0'),
(11, 81, 'page', 'field_field1', ''),
(12, 81, 'page', 'field_pole2', '0'),
(13, 82, 'page', 'field_field1', ''),
(14, 82, 'page', 'field_pole2', '0');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `content_permissions`
--

INSERT INTO `content_permissions` (`id`, `page_id`, `data`) VALUES
(21, 35, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}'),
(23, 80, 'a:3:{i:0;a:1:{s:7:"role_id";s:1:"0";}i:1;a:1:{s:7:"role_id";s:1:"1";}i:2;a:1:{s:7:"role_id";s:1:"2";}}');

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

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields_data`
--

CREATE TABLE IF NOT EXISTS `custom_fields_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `field_data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(30, 'English', 'en', '', 'english', 'commerce', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=174 ;

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
(35, 1, 'admin', '\n      Создал страницу\n     <a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336736882),
(36, 1, 'admin', '\n        Изменил страницу\n        <a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737315),
(37, 1, 'admin', 'Изменил язык Русский', 1336737433),
(38, 1, 'admin', 'Удалил страницу ID 69', 1336737581),
(39, 1, 'admin', '\n      Создал страницу\n     <a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/74''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737610),
(40, 1, 'admin', '\n        Изменил страницу\n        <a href="#" onclick="ajax_div(''page'',''http://imagecms.shop/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1336737669),
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
(71, 1, 'admin', 'Очистил кеш', 1340031146),
(72, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1340120888),
(73, 1, 'admin', 'Очистил кеш', 1340121004),
(74, 1, 'admin', 'Изменил настройки сайта', 1340121068),
(75, 1, 'admin', 'Изменил настройки сайта', 1340121079),
(76, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1341221521),
(77, 1, 'admin', 'Очистил кеш', 1341225009),
(78, 1, 'admin', 'Очистил кеш', 1341238429),
(79, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1342006563),
(80, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343634959),
(81, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343638277),
(82, 1, 'admin', 'Изменил язык English', 1343660593),
(83, 1, 'admin', 'Изменил настройки сайта', 1343662835),
(84, 1, 'admin', 'Изменил настройки сайта', 1343662840),
(85, 1, 'admin', '\n                    Создал перевод категории \n                    <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663189),
(86, 1, 'admin', '\n                        Изменил категорию   \n                        <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663190),
(87, 1, 'admin', '\n                    Создал перевод категории \n                    <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663206),
(88, 1, 'admin', '\n                    Изменил перевод категории \n                    <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663210),
(89, 1, 'admin', '\n                        Изменил категорию   \n                        <a href="#" onclick="edit_category(1); return false;">Главная</a>', 1343663212),
(90, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/75''); return false;">Contact</a>', 1343663245),
(91, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/76''); return false;">Delivery</a>', 1343664818),
(92, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/76''); return false;">Delivery</a>', 1343664842),
(93, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/75''); return false;">Contact</a>', 1343664873),
(94, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/77''); return false;">Help</a>', 1343664897),
(95, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/78''); return false;">Payment</a>', 1343664949),
(96, 1, 'admin', 'Назначил язык English по умолчанию', 1343666453),
(97, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343722531),
(98, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/80''); return false;">Site</a>', 1343722690),
(99, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/80''); return false;">Site</a>', 1343722704),
(100, 1, 'admin', 'Назначил язык Русский по умолчанию', 1343722791),
(101, 1, 'admin', 'Назначил язык English по умолчанию', 1343722888),
(102, 1, 'admin', 'Назначил язык Русский по умолчанию', 1343729093),
(103, 1, 'admin', 'Назначил язык English по умолчанию', 1343731979),
(104, 1, 'admin', 'Назначил язык Русский по умолчанию', 1343732620),
(105, 1, 'admin', 'Назначил язык English по умолчанию', 1343732630),
(106, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/81''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок</a>', 1343742434),
(107, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/81''); return false;">Action! Go to the camera Nikon S9100 - Memory Card 8 GB as a gift</a>', 1343743284),
(108, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1343743335),
(109, 1, 'admin', 'Назначил язык Русский по умолчанию', 1343743942),
(110, 1, 'admin', 'Назначил язык English по умолчанию', 1343744091),
(111, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343745310),
(112, 1, 'admin', '\n                    Создал перевод категории \n                    <a href="#" onclick="edit_category(56); return false;">Новости и акции</a>', 1343745337),
(113, 1, 'admin', '\n                        Изменил категорию   \n                        <a href="#" onclick="edit_category(56); return false;">Новости и акции</a>', 1343745338),
(114, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/79''); return false;">О магазине</a>', 1343745634),
(115, 1, 'admin', '\n				Изменил страницу\n				<a href="#" onclick="ajax_div(''page'',''http://www.imagecmsshop.loc/admin/pages/edit/79''); return false;">About us</a>', 1343745649),
(116, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343746228),
(117, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343817774),
(118, 1, 'admin', 'Очистил кеш', 1343817792),
(119, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343821049),
(120, 1, 'admin', 'Очистил кеш', 1343823630),
(121, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1343824889),
(122, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1344417771),
(123, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1344421833),
(124, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1344934178),
(125, 91, 'admin', 'Вышел из панели управления', 1345645124),
(126, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1345645129),
(127, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346317936),
(128, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346317945),
(129, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346324068),
(130, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346324574),
(131, 1, 'admin', 'Назначил язык English по умолчанию', 1346324584),
(132, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346324961),
(133, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346324967),
(134, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346325655),
(135, 1, 'admin', 'Назначил язык English по умолчанию', 1346325661),
(136, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346327229),
(137, 1, 'admin', 'Вышел из панели управления', 1346327242),
(138, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346327269),
(139, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346328114),
(140, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346328122),
(141, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346329962),
(142, 1, 'admin', 'Назначил язык English по умолчанию', 1346329969),
(143, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346330003),
(144, 1, 'admin', 'Установил модуль share', 1346335886),
(145, 1, 'admin', 'Установил модуль mailer', 1346336110),
(146, 1, 'admin', 'Удалил модуль mailer', 1346337410),
(147, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346412457),
(148, 1, 'admin', 'Назначил язык English по умолчанию', 1346412500),
(149, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346412518),
(150, 1, 'admin', 'Назначил язык English по умолчанию', 1346413745),
(151, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346414503),
(152, 1, 'admin', 'Назначил язык English по умолчанию', 1346419627),
(153, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346419656),
(154, 1, 'admin', 'Назначил язык English по умолчанию', 1346420326),
(155, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346426990),
(156, 1, 'admin', 'Установил модуль user_support', 1346427036),
(157, 1, 'admin', 'Удалил модуль user_support', 1346427057),
(158, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346682174),
(159, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346685108),
(160, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346686365),
(161, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346686825),
(162, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346689135),
(163, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/82''); return false;">Action! To the camera Nikon S9100 - 8GB memory card for free!</a>', 1346689276),
(164, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/74''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1346689293),
(165, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1346689386),
(166, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/81''); return false;">Action! Go to the camera Nikon S9100 - Memory Card 8 GB as a gift</a>', 1346689406),
(167, 1, 'admin', 'Изменил страницу<a href="#" onclick="ajax_div(''page'',''http://pushlang.loc/admin/pages/edit/73''); return false;">Акция! К фотоаппарату Nikon S9100 - карта памяти 8ГБ в подарок!</a>', 1346689653),
(168, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346693110),
(169, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346744686),
(170, 1, 'admin', 'Назначил язык Русский по умолчанию', 1346745879),
(171, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346749198),
(172, 1, 'admin', 'Очистил кеш', 1346752792),
(173, 1, 'admin', 'Вошел в панель управления IP 127.0.0.1', 1346759724);

-- --------------------------------------------------------

-- Структура таблицы `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `date` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

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
(28, 5, 0, 'url', '', '', 0, 'Авто музыка и видео', 0, 10, NULL, 'a:2:{s:3:"url";s:34:"/shop/category/avto_muzyka_i_video";s:7:"newpage";s:1:"0";}');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `data`) VALUES
(1, 10, 'a:37:{s:9:"cp_access";s:1:"1";s:13:"cp_autoupdate";s:1:"1";s:14:"cp_page_search";s:1:"1";s:11:"lang_create";s:1:"1";s:9:"lang_edit";s:1:"1";s:11:"lang_delete";s:1:"1";s:16:"cp_site_settings";s:1:"1";s:11:"cache_clear";s:1:"1";s:11:"page_create";s:1:"1";s:9:"page_edit";s:1:"1";s:11:"page_delete";s:1:"1";s:15:"category_create";s:1:"1";s:13:"category_edit";s:1:"1";s:15:"category_delete";s:1:"1";s:14:"module_install";s:1:"1";s:16:"module_deinstall";s:1:"1";s:12:"module_admin";s:1:"1";s:13:"widget_create";s:1:"1";s:13:"widget_delete";s:1:"1";s:22:"widget_access_settings";s:1:"1";s:11:"menu_create";s:1:"1";s:9:"menu_edit";s:1:"1";s:11:"menu_delete";s:1:"1";s:11:"user_create";s:1:"1";s:21:"user_create_all_roles";s:1:"1";s:9:"user_edit";s:1:"1";s:11:"user_delete";s:1:"1";s:14:"user_view_data";s:1:"1";s:12:"roles_create";s:1:"1";s:10:"roles_edit";s:1:"1";s:12:"roles_delete";s:1:"1";s:9:"logs_view";s:1:"1";s:13:"backup_create";s:1:"1";s:15:"tinybrowser_all";s:1:"1";s:18:"tinybrowser_upload";s:1:"1";s:16:"tinybrowser_edit";s:1:"1";s:19:"tinybrowser_folders";s:1:"1";}');

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
(1346160931);

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
(10, 0, 'admin', 'Администраторы', '');

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
  PRIMARY KEY (`id`),
  KEY `s_name` (`s_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `site_title`, `site_short_title`, `site_description`, `site_keywords`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `google_analytics_id`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`, `lang_sel`) VALUES
(2, 'main', 'test', 'ImageCMS Shop', 'Продажа качественной техники с гарантией и доставкой', 'магазин техники, покупка техники, доставка техники', 'auto', 'auto', '0', '0', 1, 1, '/', 'full', 'commerce', 'no', '', 'module', 69, '56', 'shop', '', '', 'russian_lang');

-- --------------------------------------------------------

--
-- Table structure for table `shop_banners`
--

CREATE TABLE IF NOT EXISTS `shop_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_banners_I_1` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
(1, 'ru', 'Samsung LN40C650 40', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/74', '1_ru.jpg'),
(3, 'ru', 'Panasonic KX-TG7433B Expandable', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/106', '3_ru.jpg'),
(4, 'ru', 'Samsung NX10 14 Megapixel Digital', '<p>Высоко технологический продукт, который поможет Вам оценить качество.</p>', '/shop/product/98', '4_ru.jpg'),
(4, 'ua', 'Samsung NX10 14 Megapixel Digital', '<p>Високо технологічний продукт, який допоможе Вам оцінити якість.</p>', '/shop/product/98', '4_ua.jpg'),
(3, 'ua', 'Panasonic KX-TG7433B Expandable', '<p>Високо технологічний продукт, який допоможе Вам оцінити якість.</p>', '/shop/product/106', '3_ua.jpg'),
(4, 'en', 'Samsung NX10 14 Megapixel Digital', '<p> high technology product that will help you evaluate the quality. </ p>', '/shop/product/74', '4_en.jpg'),
(3, 'en', 'Panasonic KX-TG7433B Expandable', '<p> high technology product that will help you evaluate the quality. </ p>', '/shop/product/75', '3_en.jpg'),
(1, 'en', 'Samsung LN40C650 40', '<p><span id=', '/shop/product/76', '1_en.jpg');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

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
(29, 'impression-computers', 'impression-computers.png');

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
(31, 'en', 'Samsung', '', '', '', ''),
(29, 'en', 'Impression Computers', '', '', '', ''),
(26, 'en', 'Hewlett Packard', '', '', '', ''),
(30, 'en', 'Bravo Computers', '', '', '', ''),
(28, 'en', 'Brain', '', '', '', ''),
(27, 'en', 'Apple', '', '', '', ''),
(32, 'en', 'Panasonic', '', '', '', '');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `tpl` varchar(250) DEFAULT NULL,
  `order_method` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_category_I_2` (`url`),
  KEY `shop_category_I_3` (`active`),
  KEY `shop_category_I_4` (`parent_id`),
  KEY `shop_category_I_5` (`position`),
  KEY `shop_category_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

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

-- --------------------------------------------------------

-- Структура таблицы `shop_comulativ_discount`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

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
(1, 'Dollars', 0, 0, 'USD', '$', 0.400),
(2, 'Ruble', 1, 1, 'RUR', 'RUR', 1.000);

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
(7, 'ua', 'Самовивезення', ''),
(5, 'en', 'Courier', ''),
(6, 'en', 'AutoWorld', ''),
(7, 'en', 'Pickup', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `shop_gifts`
--

CREATE TABLE IF NOT EXISTS `shop_gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `espdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_notifications`
--

INSERT INTO `shop_notifications` (`id`, `product_id`, `variant_id`, `user_name`, `user_email`, `user_phone`, `user_comment`, `status`, `date_created`, `active_to`, `manager_id`, `notified_by_email`) VALUES
(2, 102, 113, 'фывывфыв', 'asdsasad@mail.ru', 'фывфвфыв', 'ыфв', 2, 1343638402, 1343638402, NULL, 0),
(3, 102, 113, 'фвыв', 'asdsa@mail.ru', 'adsdasd', 'asdsdsdd', 1, 1343744944, 1343744944, NULL, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`id`, `key`, `delivery_method`, `delivery_price`, `status`, `paid`, `user_full_name`, `user_email`, `user_phone`, `user_deliver_to`, `user_comment`, `date_created`, `date_updated`, `user_ip`, `user_id`, `payment_method`, `total_price`, `external_id`, `gift_cert_key`, `gift_cert_price`) VALUES
(10, 'i5077926yf', 5, 0.00, 1, NULL, 'Administrator', 'admin@localhost.loc', '+7123456789', 'Россия, г Москва', '', 1342007508, 1342007508, '127.0.0.1', 1, 4, 999.99, NULL, NULL, NULL),
(9, 'n0z76159t2', 7, 0.00, 2, 1, 'Administrator', 'admin@localhost.loc', '+7123456789', 'Россия, г Москва', '', 1342007474, 1342007474, '127.0.0.1', 1, 1, 698.00, NULL, NULL, NULL),
(11, 'li865v3686', 7, 0.00, 1, NULL, 'Administrator', 'admin@localhost.loc', '+7123456789', 'Россия, г Москва', '', 1343641791, 1343641791, '127.0.0.1', 1, 1, 44.77, NULL, NULL, NULL),
(12, 'u2051a676j', 7, 0.00, 1, NULL, 'Administrator', 'admin@localhost.loc', '+7123456789', 'Россия, г Москва', '', 1343665999, 1343665999, '127.0.0.1', 1, 1, 99.95, NULL, NULL, NULL),
(13, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `shop_orders_products`
--

INSERT INTO `shop_orders_products` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `price`, `quantity`, `kit_id`, `is_main`) VALUES
(19, 10, 72, 83, 'LG 47LD450 - 47" Widescreen 1080p LCD HDTV', '', 999.99, 1, NULL, NULL),
(18, 9, 87, 98, 'Sony HT-SS370 Home Theater', '', 349.00, 2, NULL, NULL),
(20, 11, 80, 91, 'LG DN898 DVD Player', '', 44.77, 1, NULL, NULL),
(21, 12, 94, 105, 'Yamaha NSIW760 Speaker', '', 99.95, 1, NULL, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shop_orders_status_history`
--

INSERT INTO `shop_orders_status_history` (`id`, `order_id`, `status_id`, `user_id`, `date_created`, `comment`) VALUES
(8, 9, 2, 1, 1342007520, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
(4, 'ru', 'Robokassa', '<p>Оплата с помощью Robokassa</p>'),
(1, 'en', 'Payment for the courier', ''),
(2, 'en', 'Payment by bank', ''),
(3, 'en', 'Sberbank of Russia', ''),
(4, 'en', 'Robokassa', '');

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
  `tpl` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_products_I_2` (`url`),
  KEY `shop_products_I_3` (`brand_id`),
  KEY `shop_products_I_4` (`category_id`),
  KEY `shop_products_I_1` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=184 ;

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
(108, 2, 6),
(72, 1, 5),
(74, 2, 8),
(75, 2, 9),
(94, 1, 4),
(87, 1, 5);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `shop_product_properties`
--

INSERT INTO `shop_product_properties` (`id`, `csv_name`, `active`, `show_in_compare`, `position`, `show_on_site`, `multiple`, `external_id`, `show_in_filter`, `main_property`) VALUES
(20, 'displaytech', 1, 1, 1, 1, 0, NULL, 1, 0),
(21, 'razmerekrana', 1, 1, 2, 1, 0, NULL, 0, 0),
(22, 'hdmi', 1, 1, 3, 1, 0, NULL, 1, 0),
(23, 'power', 1, 1, 4, 1, 0, NULL, 0, 0),
(24, 'digitalopticalinput', 1, 1, 5, 1, 0, NULL, 0, 0),
(25, 'focus', 1, 1, 6, 1, 0, NULL, 0, 0),
(26, 'megapixel', 1, 1, 7, 1, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_properties_data_i18n`
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
-- Table structure for table `shop_product_properties_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_properties_categories` (
  `property_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`category_id`),
  KEY `shop_product_properties_categories_FI_2` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_data`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_properties_i18n`
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
-- Dumping data for table `shop_product_properties_i18n`
--

INSERT INTO `shop_product_properties_i18n` (`id`, `name`, `locale`, `data`) VALUES
(26, 'Количество мегапикселей', 'ru', NULL),
(25, 'Настройка фокуса', 'ru', NULL),
(24, 'Количество цифровых входов', 'ru', NULL),
(23, 'Мощность', 'ru', ''),
(22, 'HDMI', 'ru', 'a:2:{i:0;s:4:"Да";i:1;s:6:"Нет";}'),
(21, 'Размер экрана', 'ru', ''),
(20, 'Технология дисплея', 'ru', 'a:3:{i:0;s:3:"LED";i:1;s:3:"LCD";i:2;s:6:"Plasma";}'),
(20, 'Технологія дисплею', 'ua', 'a:4:{i:0;s:6:"LED-ua";i:1;s:9:"Plasma-ua";i:2;s:9:"Litium-ua";i:3;s:8:"Freon-ua";}'),
(20, 'Display Technology', 'en', ''),
(21, 'Screen Size', 'en', ''),
(22, 'HDMI', 'en', 'a:2:{i:0;s:3:"Yes";i:1;s:2:"No";}'),
(23, 'Power', 'en', ''),
(24, 'Number of digital inputs', 'en', ''),
(25, 'Setting the focus', 'en', ''),
(26, 'The number of megapixels', 'en', '');

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
  `currency` int(11) DEFAULT NULL,
  `price_in_main` float(10,5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_product_variants_I_1` (`product_id`),
  KEY `shop_product_variants_I_2` (`position`),
  KEY `shop_product_variants_I_3` (`number`),
  KEY `shop_product_variants_I_5` (`price`),
  KEY `shop_product_variants_I_4` (`price`),
  KEY `shop_product_variants_FI_2` (`currency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=208 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1943 ;

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
('mainImageWidth', '750', ''),
('mainImageHeight', '635', ''),
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
('watermark_wm_hor_alignment', 'Слева', ''),
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
('1CCatSettings', 'a:4:{s:3:"zip";s:6:"zip=no";s:8:"filesize";s:15:"file_limit=1024";s:7:"validIP";s:9:"127.0.0.1";s:8:"password";s:0:"";}', ''),
('adminMessages', 'a:3:{s:8:"incoming";s:0:"";s:8:"callback";s:27:"вфы вфыв фыв фы";s:5:"order";s:0:"";}', 'ru'),
('selectedProductCats', 'a:5:{i:0;s:2:"36";i:1;s:2:"37";i:2;s:2:"38";i:3;s:2:"39";i:4;s:2:"41";}', ''),
('adminMessageIncoming', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>', ''),
('adminMessageOrderPage', '<h1>Спасибо</h1>\n<div>В ближайшее время наши менеджеры свяжутся с Вами</div>', ''),
('mainModImageWidth', '140', ''),
('mainModImageHeight', '100', ''),
('smallModImageWidth', '90', ''),
('smallModImageHeight', '90', ''),
('order_method', '1', ''),
('forgotPasswordMessageText', 'Здравствуйте!\n\nНа сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.\n\nДля завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri% \n\nВаш новый пароль для входа: %password%\n\nЕсли это письмо попало к Вам по ошибке просто проигнорируйте его.\n\n\nПри возникновении любых вопросов, обращайтесь по телефонам:  \n(012)  345-67-89 , (012)  345-67-89 \n---\n\nС уважением, \nсотрудники службы продаж %webSiteName%', 'en'),
('ordersMessageText', 'Здравствуйте, %userName%.  \n\nМы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop" \nВы указали следующие контактные данные: \n\nEmail адрес: %userEmail% \nНомер телефона: %userPhone% \nАдрес доставки: %userDeliver%  \n\nМенеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.  \n\nТакже, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:  %orderLink%.  \n\nСпасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.  \n\nПри возникновении любых вопросов, обращайтесь за телефонами:  \n+7 (095) 222-33-22 +38 (098) 222-33-22', 'en'),
('ordersSenderName', 'DemoShop ImageCms.net', 'en'),
('ordersMessageTheme', 'Данные для просмотра совершенной покупки', 'en'),
('ordersManagerEmail', '', ''),
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
('1CSettingsOS', 'N;', ''),
('MemcachedSettings', 'a:5:{s:11:"MEMCACHE_ON";b:0;s:17:"MEMCACHE_HOSTNAME";s:9:"localhost";s:13:"MEMCACHE_PORT";s:5:"11211";s:18:"MEMCACHE_NAMESPACE";s:13:"imagecms_shop";s:13:"CACHE_EXPIRES";s:4:"3600";}', ''),
('adminMessageMonkey', '', ''),
('adminMessageMonkeylist', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_spy`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_spy`
--

INSERT INTO `shop_spy` (`id`, `user_id`, `product_id`, `price`) VALUES
(1, 1, 73, 899),
(2, 1, 74, 899);

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
  `user_external_id` varchar(255) DEFAULT NULL,
  `amout` float(10,2) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_user_profile_I_1` (`key`),
  KEY `shop_user_profile_FI_1` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) DEFAULT NULL,
  `newpass` varchar(255) DEFAULT NULL,
  `newpass_key` varchar(255) DEFAULT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
>>>>>>> efb012c16d66dccad6fc77c1871609369ac44ea4
