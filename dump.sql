-- MySQL dump 10.13  Distrib 5.1.42, for unknown-linux-gnu (x86_64)
--
-- Host: localhost    Database: imagecms
-- ------------------------------------------------------
-- Server version	5.1.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (42,0,0,'Статьи','','','articles','','','','a:1:{i:0;s:2:\"45\";}','','','',15,'publish_date','desc',0),(40,0,0,'Новости','','<p>Здесь будет описание категории</p>','news','','','','b:0;','','','',10,'publish_date','desc',0),(41,0,0,'Каталог','','','catalog','','','','a:2:{i:0;s:2:\"43\";i:1;s:2:\"44\";}','','catalog/list','catalog/item',10,'publish_date','desc',0),(43,41,0,'Кухонные роботы','','','kuhonnyje-roboty','','','','b:0;','','catalog/list','catalog/item',10,'publish_date','desc',0),(44,41,0,'Рабочие роботы','','','rabochije-roboty','','','','b:0;','','catalog/list','catalog/item',10,'publish_date','desc',0),(45,42,0,'Подкатегория','','','podkategorija','','','','b:0;','','','',15,'publish_date','desc',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_translate`
--

DROP TABLE IF EXISTS `category_translate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `short_desc` text,
  `image` varchar(250) DEFAULT NULL,
  `keywords` text,
  `description` text,
  `lang` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_translate`
--

LOCK TABLES `category_translate` WRITE;
/*!40000 ALTER TABLE `category_translate` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_translate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (5,1,'admin','admin@localhost.loc','0',6,'Зимой очень нужный товар =)',1262117639,0,'Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/532.6 (KHTML, like Gecko) Chrome/4.0.266.0 Safari/532.6','127.0.0.5');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `components`
--

DROP TABLE IF EXISTS `components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `identif` varchar(25) NOT NULL,
  `enabled` int(1) NOT NULL,
  `autoload` int(1) NOT NULL,
  `in_menu` int(1) NOT NULL DEFAULT '0',
  `settings` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `components`
--

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;
INSERT INTO `components` VALUES (1,'user_manager','user_manager',0,0,1,NULL),(2,'auth','auth',1,0,0,NULL),(78,'xfields','xfields',0,1,1,NULL),(4,'comments','comments',1,1,1,'a:5:{s:18:\"max_comment_length\";i:550;s:6:\"period\";i:0;s:11:\"can_comment\";i:0;s:11:\"use_captcha\";b:1;s:14:\"use_moderation\";b:0;}'),(7,'navigation','navigation',0,0,0,NULL),(30,'tags','tags',1,1,1,NULL),(62,'gallery','gallery',1,1,1,'a:23:{s:13:\"max_file_size\";s:1:\"5\";s:9:\"max_width\";s:3:\"800\";s:10:\"max_height\";s:3:\"600\";s:7:\"quality\";s:2:\"95\";s:14:\"maintain_ratio\";b:1;s:19:\"maintain_ratio_prev\";b:1;s:19:\"maintain_ratio_icon\";b:0;s:14:\"prev_img_width\";s:3:\"500\";s:15:\"prev_img_height\";s:3:\"500\";s:11:\"thumb_width\";s:2:\"55\";s:12:\"thumb_height\";s:2:\"55\";s:14:\"watermark_text\";s:0:\"\";s:16:\"wm_vrt_alignment\";s:6:\"bottom\";s:16:\"wm_hor_alignment\";s:5:\"right\";s:19:\"watermark_font_size\";s:2:\"14\";s:15:\"watermark_color\";s:6:\"ffffff\";s:17:\"watermark_padding\";s:2:\"-5\";s:19:\"watermark_font_path\";s:20:\"./system/fonts/1.ttf\";s:15:\"watermark_image\";s:0:\"\";s:23:\"watermark_image_opacity\";s:2:\"50\";s:14:\"watermark_type\";s:4:\"text\";s:8:\"order_by\";s:4:\"date\";s:10:\"sort_order\";s:4:\"desc\";}'),(55,'rss','rss',1,0,1,'a:5:{s:5:\"title\";s:9:\"Image CMS\";s:11:\"description\";b:0;s:10:\"categories\";b:0;s:9:\"cache_ttl\";i:60;s:11:\"pages_count\";i:10;}'),(72,'imagebox','imagebox',0,1,1,'a:6:{s:9:\"max_width\";i:800;s:10:\"max_height\";i:600;s:11:\"thumb_width\";i:100;s:12:\"thumb_height\";i:100;s:14:\"maintain_ratio\";b:1;s:7:\"quality\";s:3:\"95%\";}'),(60,'menu','menu',0,1,1,NULL),(58,'sitemap','sitemap',1,0,1,'a:5:{s:18:\"main_page_priority\";s:1:\"1\";s:13:\"cats_priority\";s:3:\"0.9\";s:14:\"pages_priority\";s:3:\"0.5\";s:20:\"main_page_changefreq\";s:6:\"weekly\";s:16:\"pages_changefreq\";s:7:\"monthly\";}'),(80,'search','search',1,0,0,NULL),(84,'feedback','feedback',1,0,0,'a:2:{s:5:\"email\";s:19:\"admin@localhost.loc\";s:15:\"message_max_len\";i:5;}'),(85,'simple_cart','simple_cart',1,1,0,NULL);
/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'Главная страница','','glavnaja-stranica',NULL,'шаблон, главной, страницы, расположен, файле, main_page, tpl','Шаблон главной страницы расположен в файле main_page.tpl','<p>Шаблон главной страницы расположен в файле main_page.tpl</p>','',0,'main_page',0,1,0,'draft','admin',1260921185,1260921223,1260921313,1,3,0),(9,'Контакты','','contacts',NULL,'страница, контактов','Страница контактов','<p>Страница контактов</p>','',0,'page_static',0,0,0,'publish','admin',1261515198,1261515215,1261515293,32,3,0),(5,'Очень важная новость','','this-is-page-title','news/','есть, много, вариантов, lorem, ipsum, большинство, них, имеет, всегда, приемлемые, модификации, например, юмористические, вставки, слова, которые, отдаленно, напоминают, латынь, нужен, серьезного, проекта, наверняка, хотите, какой, нибудь, шутки, скрытой, середине, абзаца','Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хот','<p>Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца. Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или \"невозможных\" слов.</p>','',40,NULL,0,1,0,'publish','admin',1260994574,1260994627,1262117175,149,3,0),(6,'Робот-Грелка','','robot-grelka','catalog/kuhonnyje-roboty/','описание, робота, робот, грелка, согреет, никто, другой, просто, положите, свой, карман, наслаждайтесь','Описание робота: Робот грелка согреет вас как никто другой. Просто положите его в свой карман и наслаждайтесь.','<p>Описание робота: Робот грелка согреет вас как никто другой. Просто положите его в свой карман и наслаждайтесь.</p>','',43,NULL,0,1,1,'publish','admin',1261083798,1261083870,1262026326,535,3,0),(10,'Робот-фен','','robot-fen','catalog/rabochije-roboty/','описание, робота, фена','описание робота фена.','<p>описание робота фена.</p>','',44,NULL,0,0,0,'publish','admin',1261609179,1261609219,1261609282,32,3,0),(11,'Первая статья','','first-article','articles/podkategorija/','давно, выяснено, при, оценке, дизайна, композиции, читаемый, текст, мешает, сосредоточиться, lorem, ipsum, используют, потому, тот, обеспечивает, более, менее, стандартное, заполнение, шаблона, также, реальное, распределение, букв, пробелов, абзацах, которое, получается, простой','Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которо','<p>Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>','',45,NULL,0,1,0,'publish','admin',1262036216,1262036233,1262117236,4,3,0);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_permissions`
--

DROP TABLE IF EXISTS `content_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_permissions` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_permissions`
--

LOCK TABLES `content_permissions` WRITE;
/*!40000 ALTER TABLE `content_permissions` DISABLE KEYS */;
INSERT INTO `content_permissions` VALUES (22,148,'a:1:{i:0;a:1:{s:7:\"role_id\";s:1:\"0\";}}'),(45,185,'a:1:{i:0;a:1:{s:7:\"role_id\";s:1:\"1\";}}');
/*!40000 ALTER TABLE `content_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_tags`
--

DROP TABLE IF EXISTS `content_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_tags`
--

LOCK TABLES `content_tags` WRITE;
/*!40000 ALTER TABLE `content_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `content_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_albums`
--

DROP TABLE IF EXISTS `gallery_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `cover_id` int(11) DEFAULT '0',
  `position` int(9) DEFAULT '0',
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_albums`
--

LOCK TABLES `gallery_albums` WRITE;
/*!40000 ALTER TABLE `gallery_albums` DISABLE KEYS */;
INSERT INTO `gallery_albums` VALUES (3,1,'Цветы','<p>Просто цветы</p>',33,0,1261008826,1261009375);
/*!40000 ALTER TABLE `gallery_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_category`
--

DROP TABLE IF EXISTS `gallery_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `cover_id` int(11) DEFAULT '0',
  `position` int(9) DEFAULT '0',
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_category`
--

LOCK TABLES `gallery_category` WRITE;
/*!40000 ALTER TABLE `gallery_category` DISABLE KEYS */;
INSERT INTO `gallery_category` VALUES (1,'Все альбомы','',0,0,1260996356);
/*!40000 ALTER TABLE `gallery_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery_images` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` VALUES (28,3,'800px-purple_flowers_2','.jpg','96.8 Кб',1,800,600,NULL,1261009304,125),(29,3,'40750-Spring-Flowers-Screensaver','.jpg','30.5 Кб',2,800,600,'Просто ромашка =)',1261009308,45),(30,3,'Frangipani_Flowers','.jpg','53.2 Кб',3,800,600,NULL,1261009311,65),(33,3,'flowers','.jpg','121.4 Кб',6,800,600,'',1261009358,61),(34,3,'flowers2_800','.jpg','49.4 Кб',7,800,600,NULL,1261009363,53),(37,3,'scilla-flowers','.jpg','47.2 Кб',10,800,600,NULL,1261009375,45);
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(100) NOT NULL,
  `identif` varchar(10) NOT NULL,
  `image` text NOT NULL,
  `folder` varchar(100) NOT NULL,
  `template` varchar(100) NOT NULL,
  `default` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (3,'Русский','ru','','russian','lite',1);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_translate`
--

DROP TABLE IF EXISTS `menu_translate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_translate`
--

LOCK TABLES `menu_translate` WRITE;
/*!40000 ALTER TABLE `menu_translate` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_translate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `main_title` varchar(300) NOT NULL,
  `description` text,
  `created` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'main_menu','Главное меню',NULL,'2009-12-15 16:08:36'),(2,'left_menu','Категории продуктов',NULL,'2009-12-22 16:18:53'),(3,'articles','Articles',NULL,'2009-12-28 13:37:31');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus_data`
--

DROP TABLE IF EXISTS `menus_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus_data` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `menu_id` int(9) NOT NULL,
  `item_id` int(9) NOT NULL,
  `item_type` varchar(15) NOT NULL,
  `roles` text,
  `hidden` smallint(1) NOT NULL DEFAULT '0',
  `title` varchar(300) CHARACTER SET ucs2 NOT NULL,
  `parent_id` int(9) NOT NULL,
  `position` smallint(5) DEFAULT NULL,
  `description` text,
  `add_data` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_data`
--

LOCK TABLES `menus_data` WRITE;
/*!40000 ALTER TABLE `menus_data` DISABLE KEYS */;
INSERT INTO `menus_data` VALUES (1,1,0,'url','',0,'Главная',0,1,NULL,'/'),(2,1,40,'category','',0,'Новости',0,2,NULL,NULL),(3,1,41,'category','',0,'Каталог Продукции',0,3,NULL,NULL),(4,1,0,'module','',0,'Фотогаллерея',0,4,NULL,'a:2:{s:8:\"mod_name\";s:7:\"gallery\";s:6:\"method\";s:0:\"\";}'),(5,1,42,'category','',0,'Статьи',0,5,NULL,NULL),(6,1,0,'module','',0,'Обратная связь',0,6,NULL,'a:2:{s:8:\"mod_name\";s:8:\"feedback\";s:6:\"method\";s:0:\"\";}'),(7,2,43,'category','',0,'Кухонные роботы',0,1,NULL,NULL),(8,2,44,'category','',0,'Рабочие роботы',0,2,NULL,NULL),(9,3,45,'category','',0,'Подкатегория',0,1,NULL,NULL);
/*!40000 ALTER TABLE `menus_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `alt_name` varchar(50) NOT NULL,
  `desc` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,0,'user','Пользователи',''),(2,0,'admin','Администраторы','');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search`
--

DROP TABLE IF EXISTS `search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search`
--

LOCK TABLES `search` WRITE;
/*!40000 ALTER TABLE `search` DISABLE KEYS */;
INSERT INTO `search` VALUES (1,'30555e705d4b5701baf6f53d0cbab37eedefb5a8',1261518997,'a:4:{i:0;a:2:{s:11:\"post_status\";s:7:\"publish\";s:8:\"operator\";s:5:\"WHERE\";}i:1;a:2:{s:15:\"publish_date <=\";s:16:\"UNIX_TIMESTAMP()\";s:9:\"backticks\";b:0;}i:2;a:1:{s:4:\"lang\";s:1:\"3\";}i:3;a:2:{s:6:\"group1\";s:100:\"(title LIKE \"%грелка%\" OR prev_text LIKE \"%грелка%\" OR full_text LIKE \"%грелка%\" )\";s:5:\"group\";b:1;}}','a:2:{i:0;s:9:\"content.*\";i:1;s:55:\"CONCAT_WS(\"\", content.cat_url, content.url) as full_url\";}','content','a:1:{s:12:\"publish_date\";s:4:\"DESC\";}',15,1,'a:1:{i:0;s:1:\"6\";}','грелка'),(2,'5e2e92e1c7a228020a5f6fda13163fbbbfbe12b0',1262117557,'a:5:{i:0;a:2:{s:15:\"publish_date <=\";s:16:\"UNIX_TIMESTAMP()\";s:9:\"backticks\";b:0;}i:1;a:1:{s:11:\"lang_alias \";s:1:\"0\";}i:2;a:3:{s:9:\"prev_text\";s:28:\"Поиск страниц...\";s:8:\"operator\";s:4:\"LIKE\";s:9:\"backticks\";s:4:\"both\";}i:3;a:3:{s:9:\"full_text\";s:28:\"Поиск страниц...\";s:8:\"operator\";s:7:\"OR_LIKE\";s:9:\"backticks\";s:4:\"both\";}i:4;a:3:{s:5:\"title\";s:28:\"Поиск страниц...\";s:8:\"operator\";s:7:\"OR_LIKE\";s:9:\"backticks\";s:4:\"both\";}}','a:0:{}','content','a:1:{s:12:\"publish_date\";s:4:\"DESC\";}',15,0,'a:0:{}','Поиск страниц...');
/*!40000 ALTER TABLE `search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
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
  `sidepanel` varchar(5) NOT NULL,
  `lk` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (2,'main','ImageCMS','','','','auto','auto','0','0',1,1,' - ','advanced','main','no','page',1,'1','','4993041A696E984B');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_autologin`
--

DROP TABLE IF EXISTS `user_autologin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_autologin` (
  `key_id` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_autologin`
--

LOCK TABLES `user_autologin` WRITE;
/*!40000 ALTER TABLE `user_autologin` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_autologin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (8,2);
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_temp`
--

DROP TABLE IF EXISTS `user_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(34) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_key` varchar(50) NOT NULL,
  `last_ip` varchar(40) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_temp`
--

LOCK TABLES `user_temp` WRITE;
/*!40000 ALTER TABLE `user_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'admin','$1$tAfsqkpo$xP9ByZNdprtoB24BeGWly0','admin@localhost.loc',0,NULL,NULL,NULL,NULL,'127.0.0.5','2009-12-29 13:35:23','2008-11-30 04:56:32','2009-12-29 21:35:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widgets` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(15) NOT NULL,
  `data` text NOT NULL,
  `method` varchar(50) NOT NULL,
  `settings` text NOT NULL,
  `description` varchar(300) NOT NULL,
  `roles` text NOT NULL,
  `created` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (62,'latest_news','module','core','recent_news','a:4:{s:10:\"news_count\";s:1:\"3\";s:11:\"max_symdols\";s:3:\"100\";s:10:\"categories\";a:1:{i:0;s:2:\"40\";}s:7:\"display\";s:6:\"recent\";}','Список последних новостей на главной странице','',1260995179);
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xfields`
--

DROP TABLE IF EXISTS `xfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xfields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `data` text,
  `add_data` text,
  `position` smallint(5) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xfields`
--

LOCK TABLES `xfields` WRITE;
/*!40000 ALTER TABLE `xfields` DISABLE KEYS */;
INSERT INTO `xfields` VALUES (12,'textbox','price','a:3:{s:10:\"label_text\";s:9:\"Цена:\";s:13:\"default_value\";s:1:\"0\";s:3:\"css\";b:0;}',NULL,1,2),(13,'image','image','a:3:{s:10:\"label_text\";s:22:\"Изображение\";s:13:\"default_value\";b:0;s:3:\"css\";b:0;}',NULL,2,3),(14,'dropdown','warehouse','a:3:{s:10:\"label_text\";s:27:\"Есть на складе:\";s:6:\"values\";a:2:{i:0;s:4:\"Да\";i:1;s:6:\"Нет\";}s:3:\"css\";b:0;}',NULL,3,2);
/*!40000 ALTER TABLE `xfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xfields_groups`
--

DROP TABLE IF EXISTS `xfields_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xfields_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xfields_groups`
--

LOCK TABLES `xfields_groups` WRITE;
/*!40000 ALTER TABLE `xfields_groups` DISABLE KEYS */;
INSERT INTO `xfields_groups` VALUES (2,'robot_params','Параметры'),(3,'images','Изображения');
/*!40000 ALTER TABLE `xfields_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xfields_sets`
--

DROP TABLE IF EXISTS `xfields_sets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xfields_sets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `field_data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xfields_sets`
--

LOCK TABLES `xfields_sets` WRITE;
/*!40000 ALTER TABLE `xfields_sets` DISABLE KEYS */;
INSERT INTO `xfields_sets` VALUES (45,10,13,'/uploads/images/hot_robot1.jpg'),(48,6,13,'/uploads/images/hot_robot1.jpg'),(47,6,14,'0'),(46,6,12,'150'),(44,10,14,'0'),(43,10,12,'75.99');
/*!40000 ALTER TABLE `xfields_sets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-01-14 11:45:48
