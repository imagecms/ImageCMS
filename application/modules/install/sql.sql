-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 14 2015 г., 11:14
-- Версия сервера: 5.5.43
-- Версия PHP: 5.5.26-1+deb.sury.org~precise+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id`        INT(11)      NOT NULL AUTO_INCREMENT,
  `place`     VARCHAR(255) NOT NULL,
  `width`     INT(5)       NOT NULL,
  `height`    INT(5)       NOT NULL,
  `effects`   TEXT,
  `page_type` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 3;

--
-- Дамп данных таблицы `banners`
--

INSERT INTO `banners` (`id`, `place`, `width`, `height`, `effects`, `page_type`) VALUES
  (1, 'main_banner', 1980, 572,
   '{"autoplay":1,"autoplaySpeed":"3","arrows":1,"centerMode":0,"dots":1,"draggable":0,"fade":0,"easing":"linear","infinite":0,"pauseOnHover":0,"pauseOnDotsHover":0,"speed":0,"swipe":0,"touchMove":0,"vertical":0,"rtl":0}',
   'main'),
  (2, 'partners', 164, 45,
   '{"autoplay":0,"autoplaySpeed":"3","arrows":1,"centerMode":0,"dots":0,"draggable":1,"fade":0,"easing":"linear","infinite":1,"pauseOnHover":1,"pauseOnDotsHover":0,"speed":0,"swipe":1,"touchMove":1,"vertical":0,"rtl":0}',
   'main');

-- --------------------------------------------------------

--
-- Структура таблицы `banners_i18n`
--

DROP TABLE IF EXISTS `banners_i18n`;
CREATE TABLE IF NOT EXISTS `banners_i18n` (
  `id`     INT(11)    NOT NULL,
  `locale` VARCHAR(5) NOT NULL DEFAULT 'ru',
  `name`   VARCHAR(255)        DEFAULT NULL,
  PRIMARY KEY (`id`, `locale`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `banners_i18n`
--

INSERT INTO `banners_i18n` (`id`, `locale`, `name`) VALUES
  (1, 'ru', 'Main page big banner'),
  (2, 'ru', 'Наши партнеры'),
  (2, 'uk', 'Наші партнери');

-- --------------------------------------------------------

--
-- Структура таблицы `banner_image`
--

DROP TABLE IF EXISTS `banner_image`;
CREATE TABLE IF NOT EXISTS `banner_image` (
  `id`           INT(11) NOT NULL AUTO_INCREMENT,
  `banner_id`    INT(11) NOT NULL,
  `target`       INT(2)           DEFAULT NULL,
  `url`          VARCHAR(255)     DEFAULT NULL,
  `allowed_page` INT(11)          DEFAULT NULL,
  `position`     INT(11)          DEFAULT NULL,
  `active_from`  INT(11)          DEFAULT NULL,
  `active_to`    INT(11)          DEFAULT NULL,
  `active`       INT(1)           DEFAULT NULL,
  `permanent`    INT(1)           DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banner_image_fi_0bb916` (`banner_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 14;

--
-- Дамп данных таблицы `banner_image`
--

INSERT INTO `banner_image` (`id`, `banner_id`, `target`, `url`, `allowed_page`, `position`, `active_from`, `active_to`, `active`, `permanent`)
VALUES
  (5, 1, 1, '/uslugi/business-consulting', 0, 1, NULL, NULL, 1, 1),
  (4, 1, 0, '/uslugi/business-consulting', 0, 0, NULL, NULL, 1, 1),
  (3, 1, 0, '/uslugi/business-consulting', 0, 2, NULL, NULL, 1, 1),
  (6, 2, 0, '', 0, 22, NULL, NULL, 1, 1),
  (7, 2, 0, '', 0, 20, NULL, NULL, 1, 1),
  (9, 2, 0, '', 0, 21, NULL, NULL, 1, 1),
  (10, 2, 1, '', 0, 24, NULL, NULL, 1, 1),
  (11, 2, 0, '', 0, 23, NULL, NULL, 1, 1),
  (13, 2, 0, '', 0, 25, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `banner_image_i18n`
--

DROP TABLE IF EXISTS `banner_image_i18n`;
CREATE TABLE IF NOT EXISTS `banner_image_i18n` (
  `id`          INT(11)    NOT NULL,
  `locale`      VARCHAR(5) NOT NULL DEFAULT 'ru',
  `src`         VARCHAR(255)        DEFAULT NULL,
  `name`        VARCHAR(255)        DEFAULT NULL,
  `clicks`      INT(20)             DEFAULT NULL,
  `description` TEXT,
  PRIMARY KEY (`id`, `locale`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `banner_image_i18n`
--

INSERT INTO `banner_image_i18n` (`id`, `locale`, `src`, `name`, `clicks`, `description`) VALUES
  (4, 'ru', '1436278876.jpg', 'Индивидуальные решения', 0,
   '<p>Мы подходим к каждой компании и бизнес-стратегии индивидуально, обеспечивая решения, гарантирующие успех вашей компании на протяжении длительного периода.</p>'),
  (3, 'ru', '1436278673.jpg', 'Комплексное сопровождение', 0, '<p>Мы полностью включаемся в проект и берем на себя весь комплекс работ, в который входит бизнес-консалтинг, стратегия, маркетинговые решения и реализации проекта в будущем. </p>'),
  (5, 'ru', '1436279003.jpg', 'Независимые консультанты', 0, '<p><span>Наши консультанты всегда являются независимыми объективными экспертами, дающими свежий взгляд со стороны и остающимися беспристрастными в любой ситуации. </span></p>'),
  (6, 'ru', '1436284401.png', 'Business', 0, ''),
  (7, 'ru', '1436284377.png', 'Techstart', 0, ''),
  (9, 'ru', '1436284440.png', 'Besttech', 0, ''),
  (10, 'ru', '1436284464.png', 'Beststart', 0, ''),
  (11, 'ru', '1436284479.png', 'Webcreate', 0, ''),
  (13, 'ru', '1436285526.png', 'NewAgency', 0, ''),
  (5, 'uk', '1436388314.jpg', 'Незалежні консультанти', 0, '<p>Наші консультанти завжди є незалежними об''єктивними експертами, що дають свіжий погляд з боку і залишаються неупередженими в будь-якій ситуації.</p>'),
  (4, 'uk', '1436388489.jpg', 'Індивідуальні рішення', 0, '<p>Ми підходимо до кожної компанії і бізнес-стратегії індивідуально, забезпечуючи рішення, що гарантують успіх вашої компанії протягом тривалого періоду.</p>'),
  (3, 'uk', '1436388690.jpg', 'Комплексний супровід', 0,
   '<p>Ми повністю включаємось в проект і беремо на себе весь комплекс робіт, в який входить бізнес-консалтинг, стратегія, маркетингові рішення і реалізації проекту в майбутньому.</p>'),
  (7, 'uk', '1436389393.png', 'Techstart', 0, ''),
  (9, 'uk', '1436389407.png', 'Business', 0, ''),
  (6, 'uk', '1436389432.png', 'Besttech', 0, ''),
  (11, 'uk', '1436389449.png', 'Beststart', 0, ''),
  (10, 'uk', '1436389467.png', 'Webcreate', 0, ''),
  (13, 'uk', '1436389486.png', 'NewAgency', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id`                   INT(11)      NOT NULL AUTO_INCREMENT,
  `parent_id`            INT(11)      NOT NULL DEFAULT '0',
  `position`             MEDIUMINT(5) NOT NULL DEFAULT '0',
  `name`                 VARCHAR(160) NOT NULL,
  `title`                VARCHAR(250)          DEFAULT NULL,
  `short_desc`           TEXT         NOT NULL,
  `url`                  VARCHAR(300) NOT NULL,
  `image`                VARCHAR(250)          DEFAULT NULL,
  `keywords`             TEXT,
  `description`          TEXT,
  `fetch_pages`          TEXT         NOT NULL,
  `main_tpl`             VARCHAR(50)  NOT NULL,
  `tpl`                  VARCHAR(50)           DEFAULT NULL,
  `page_tpl`             VARCHAR(50)           DEFAULT NULL,
  `per_page`             SMALLINT(5)  NOT NULL,
  `order_by`             VARCHAR(25)  NOT NULL,
  `sort_order`           VARCHAR(25)  NOT NULL,
  `comments_default`     TINYINT(1)   NOT NULL DEFAULT '0',
  `field_group`          INT(11)      NOT NULL,
  `category_field_group` INT(11)      NOT NULL,
  `settings`             VARCHAR(10000)        DEFAULT NULL,
  `created`              INT(11)      NOT NULL,
  `updated`              INT(11)      NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `url` (`url`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 75;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `position`, `name`, `title`, `short_desc`, `url`, `image`, `keywords`, `description`, `fetch_pages`, `main_tpl`, `tpl`, `page_tpl`, `per_page`, `order_by`, `sort_order`, `comments_default`, `field_group`, `category_field_group`, `settings`, `created`, `updated`)
VALUES
  (64, 0, 0, 'Блог', '', '', 'blog', '', '', '', 'a:4:{i:0;s:2:"70";i:1;s:2:"67";i:2;s:2:"68";i:3;s:2:"69";}', '',
                                                                                                               'category_blog',
                                                                                                               'page_blog',
                                                                                                               15,
                                                                                                               'position',
                                                                                                               'asc', 1,
                                                                                                               11, -1,
                                                                                                               'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";s:1:"1";}',
   1428164812, 1436214625),
  (66, 0, 4, 'Клиенты о нас', '', '', 'klienty-o-nas', '', '', '', 'b:0;', '', '', '', 15, 'publish_date', 'desc', 0,
                                                                           12, -1,
                                                                           'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";b:0;}',
   1429361818, 1429362509),
  (67, 64, 1, 'Бизнес', '', '', 'biznes', '', '', '', 'b:0;', '', 'category_blog', 'page_blog', 15, 'publish_date',
                                                              'desc', 1, 11, -1,
                                                              'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";b:0;}',
   1429885611, 1436384636),
  (74, 64, 2, 'Финансы', '', '', 'finansy', '', '', '', 'b:0;', '', '', '', 15, 'publish_date', 'desc', 0, -1, 11,
                                                                'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";b:0;}',
   1436384618, 1436384641),
  (69, 64, 3, 'Экономика', '', '', 'ekonomika', '', '', '', 'b:0;', '', 'category_blog', 'page_blog', 15,
                                                                    'publish_date', 'desc', 1, 11, -1,
                                                                    'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";b:0;}',
   1429885646, 1436384648),
  (62, 0, 5, 'Услуги', '',
       '<p>Консалтинг (консультирование) &mdash; деятельность по консультированию руководителей, управленцев по широкому кругу вопросов в сфере финансовой, коммерческой, юридической, технологической, технической, экспертной деятельности. Цель консалтинга &mdash; помочь системе управления (менеджменту) в достижении заявленных целей.</p>\n<p>Иными словами: консалтинг &mdash; это управленческое консультирование по широкому кругу вопросов в сфере финансовой, юридической, технологической, технической, экспертной деятельности, оказываемое внешними консультантами для решения той или иной проблемы. Консалтинговые компании специализируются по отдельным направлениям деятельности (например, финансовому, кадровому, организационному, стратегическому).</p>\n<p>Основная задача консалтинга заключается в анализе, обосновании перспектив развития и использования научно-технических и организационно-экономических решений с учётом предметной области и проблем клиента.</p>',
       'uslugi', '', '', '', 'b:0;', '', '', '', 10, 'publish_date', 'desc', 1, 13, -1,
                                     'a:2:{s:26:"category_apply_for_subcats";b:0;s:17:"apply_for_subcats";s:1:"1";}',
   1428164759, 1436384496);

-- --------------------------------------------------------

--
-- Структура таблицы `category_translate`
--

DROP TABLE IF EXISTS `category_translate`;
CREATE TABLE IF NOT EXISTS `category_translate` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `alias`       INT(11)      NOT NULL,
  `name`        VARCHAR(160) NOT NULL,
  `title`       VARCHAR(250)          DEFAULT NULL,
  `short_desc`  TEXT,
  `image`       VARCHAR(250)          DEFAULT NULL,
  `keywords`    TEXT,
  `description` TEXT,
  `lang`        INT(11)      NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`, `lang`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 13;

--
-- Дамп данных таблицы `category_translate`
--

INSERT INTO `category_translate` (`id`, `alias`, `name`, `title`, `short_desc`, `image`, `keywords`, `description`, `lang`)
VALUES
  (6, 64, 'Блог', '', '', '', '', '', 32),
  (7, 66, 'Клієнти про нас', '', '', '', '', '', 32),
  (10, 67, 'Бізнес', '', '', '', '', '', 32),
  (9, 62, 'Послуги', '',
   '<p>Консалтинг (консультування) - діяльність з консультування керівників, управлінців з широкого кола питань у сфері фінансової, комерційної, юридичної, технологічної, технічної, експертної діяльності. Мета консалтингу - допомогти системі управління (менеджменту) в досягненні заявлених цілей.</p>\n<p>Іншими словами: консалтинг - це управлінське консультування з широкого кола питань у сфері фінансової, юридичної, технологічної, технічної, експертної діяльності, який чиниться зовнішніми консультантами для вирішення тієї чи іншої проблеми. Консалтингові компанії спеціалізуються за окремими напрямами діяльності (наприклад, фінансовому, кадрового, організаційного, стратегічному).</p>\n<p>Основне завдання консалтингу полягає в аналізі, обгрунтуванні перспектив розвитку і використання науково-технічних і організаційно-економічних рішень з урахуванням предметної області і проблем клієнта.</p>',
   '', '', '', 32),
  (11, 74, 'Фінанси', '', '', '', '', '', 32),
  (12, 69, 'Економіка', '', '', '', '', '', 32);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `module`     VARCHAR(25)  NOT NULL DEFAULT 'core',
  `user_id`    INT(11)      NOT NULL,
  `user_name`  VARCHAR(50)  NOT NULL,
  `user_mail`  VARCHAR(50)  NOT NULL,
  `user_site`  VARCHAR(250) NOT NULL,
  `item_id`    BIGINT(11)   NOT NULL,
  `text`       TEXT,
  `date`       INT(11)      NOT NULL,
  `status`     SMALLINT(1)  NOT NULL,
  `agent`      VARCHAR(250) NOT NULL,
  `user_ip`    VARCHAR(64)  NOT NULL,
  `rate`       INT(11)      NOT NULL,
  `text_plus`  VARCHAR(500)          DEFAULT NULL,
  `text_minus` VARCHAR(500)          DEFAULT NULL,
  `like`       INT(11)      NOT NULL,
  `disslike`   INT(11)      NOT NULL,
  `parent`     INT(11)               DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module` (`module`),
  KEY `item_id` (`item_id`),
  KEY `date` (`date`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 113;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `module`, `user_id`, `user_name`, `user_mail`, `user_site`, `item_id`, `text`, `date`, `status`, `agent`, `user_ip`, `rate`, `text_plus`, `text_minus`, `like`, `disslike`, `parent`)
VALUES
  (99, 'core', 61, 'Александра', 'aleksandra@gmail.com', '0', 89,
       'Абсолютно согласна с данной статьей, сталкивались с таким в собственной компании. Пришли консультанты, нарисовали бизнес-процессы за кругленькую сумму и ушли. Никому эти бизнес-процессы не нужны, они так и остались на бумаге, в бухгалтерии все деньги расписали.',
       1436523850, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 5,
   '', '', 0, 0, 0),
  (100, 'core', 61, 'Александра', 'aleksandra@gmail.com', '0', 109, 'От того насколько квалифицированно решаются задачи в области ИТ напрямую зависит успешность и конкурентоспособность бизнеса. Появление большого количества программных продуктов зачастую приводит непосвященного в состояние полной неразберихи.', 1436523933, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 4, '', '', 0, 0, 0),
  (101, 'core', 62, 'Евгений', 'eugene@gmail.com', '0', 121, 'Но почему при этом не использовать легальные способы оптимизации налогообложения? Налоговая оптимизация – это легитимное, эффективное налоговое планирование начислений в бюджет.', 1436524177, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 4, '', '', 0, 0, 0),
  (103, 'core', 62, 'Евгений', 'eugene@gmail.com', '0', 109, 'Хорошо если рядом есть доверенный профессионал, который поможет советом и даст ответы на насущные вопросы квалифицированно и понятно, с многолетним практическим опытом в предметных областях.', 1436524291, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 4, '', '', 0, 0, 0),
  (105, 'core', 63, 'Ольга', 'olga@gmail.com', '0', 109, 'Представить область человеческой деятельности очень сложно, где бы информационные технологии не использовались в той или иной мере. От того насколько квалифицированно решаются задачи в области ИТ напрямую зависит успешность и конкурентоспособность бизнеса.', 1436524554, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 5, '', '', 0, 0, 0),
  (106, 'core', 63, 'Ольга', 'olga@gmail.com', '0', 121, 'Следует ориентироваться на такие пункты налогового планирования, которые позволят составить индивидуальные схемы оптимизации налогообложения. На нашем рынке можно встретить много различных предложений об оказании налоговых услуг. Но большинство из них помогают устранить только часть проблем.', 1436524858, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 5, '', '', 0, 0, 0),
  (107, 'core', 63, 'Ольга', 'olga@gmail.com', '0', 90, 'Хотела уточнить, что потребители и конкуренты видели необоснованный риск и отступление с занятых позиций. Жертвуя каналом сбыта, компания в то же время сбросила оковы территориальных ограничений, а также замедляющие рост арендные выплаты.', 1436525042, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 5, '', '', 0, 0, 0),
  (108, 'core', 64, 'Михаил', 'michail@gmail.com', '0', 89, 'Но ведь бизнес-процессы это не квадратики на бумаге, это реально работающие процессы на предприятии. Дальше нечестность порождает еще большую нечестность, у консультантов в голове крутятся доллары, бессмысленность и ненужность работы, и в итоге пошел процесс «нужно побольше придумать себе работы и побольше взять денег».', 1436525133, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 3, '', '', 0, 0, 0),
  (112, 'core', 63, 'Ольга', 'olga@gmail.com', '0', 89, 'В итоге получается забавная картина, когда говорят о бизнес-процессах, многие руководители представляет себе толстенную (и надо сказать дорогую) пачку бумаги с нарисованными квадратиками и стрелочками.', 1436525540, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 5, '', '', 0, 0, 0),
  (110, 'core', 64, 'Михаил', 'michail@gmail.com', '0', 121, 'Помните, что представитель налоговой инспекции приходит для того, чтобы найти ошибки в ведении бухгалтерского или налогового учета, а причина возникновения ошибки – случайно или специально – для налоговиков не имеет значения.', 1436525309, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 3, '', '', 0, 0, 0),
  (111, 'core', 64, 'Михаил', 'michail@gmail.com', '0', 90, 'Можно еще сказать о том, что для того, чтобы быть успешным, не всегда следует оставаться упрямым. Потребуется мобилизация всех запасов смелости для отказа от первичного плана в пользу роста.', 1436525379, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '178.136.237.181', 3, '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `components`
--

DROP TABLE IF EXISTS `components`;
CREATE TABLE IF NOT EXISTS `components` (
  `id`       INT(11)     NOT NULL AUTO_INCREMENT,
  `name`     VARCHAR(50) NOT NULL,
  `identif`  VARCHAR(25) NOT NULL,
  `enabled`  INT(1)      NOT NULL DEFAULT '0',
  `autoload` INT(1)      NOT NULL DEFAULT '0',
  `in_menu`  INT(1)      NOT NULL DEFAULT '0',
  `settings` TEXT,
  `position` INT(11)              DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `identif` (`identif`),
  KEY `enabled` (`enabled`),
  KEY `autoload` (`autoload`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 276;

--
-- Дамп данных таблицы `components`
--

INSERT INTO `components` (`name`, `identif`, `enabled`, `autoload`, `in_menu`, `settings`, `position`) VALUES
  ('user_manager', 'user_manager', 0, 0, 0, NULL, 19),
  ('auth', 'auth', 1, 0, 0, NULL, 28),
  ('comments', 'comments', 1, 1, 1, 'a:5:{s:18:"max_comment_length";i:0;s:6:"period";i:0;s:11:"can_comment";i:0;s:11:"use_captcha";b:0;s:14:"use_moderation";b:0;}', 9),
  ('navigation', 'navigation', 0, 0, 0, NULL, 29),
  ('tags', 'tags', 1, 1, 0, NULL, 27),
  ('mod_seo', 'mod_seo', 0, 1, 1, NULL, 5),
  ('gallery', 'gallery', 1, 0, 1, 'a:26:{s:14:"max_image_size";s:1:"5";s:9:"max_width";s:1:"0";s:10:"max_height";s:1:"0";s:7:"quality";s:2:"95";s:14:"maintain_ratio";b:1;s:19:"maintain_ratio_prev";b:1;s:19:"maintain_ratio_icon";b:1;s:4:"crop";b:0;s:9:"crop_prev";b:0;s:9:"crop_icon";b:1;s:14:"prev_img_width";s:4:"1200";s:15:"prev_img_height";s:3:"900";s:11:"thumb_width";s:3:"480";s:12:"thumb_height";s:3:"350";s:14:"watermark_text";s:0:"";s:16:"wm_vrt_alignment";s:6:"bottom";s:16:"wm_hor_alignment";s:4:"left";s:19:"watermark_font_size";s:2:"14";s:15:"watermark_color";s:6:"ffffff";s:17:"watermark_padding";s:2:"-5";s:15:"watermark_image";s:10:"./uploads/";s:23:"watermark_image_opacity";s:2:"50";s:14:"watermark_type";s:4:"text";s:8:"order_by";s:4:"date";s:10:"sort_order";s:4:"desc";s:19:"watermark_font_path";s:25:"./uploads/defaultFont.ttf";}', 13),
  ('rss', 'rss', 1, 0, 0, 'a:5:{s:5:"title";s:9:"Image CMS";s:11:"description";s:35:"Тестируем модуль RSS";s:10:"categories";a:1:{i:0;s:1:"3";}s:9:"cache_ttl";i:60;s:11:"pages_count";i:10;}', 14),
  ('menu', 'menu', 0, 1, 1, NULL, 0),
  ('sitemap', 'sitemap', 1, 1, 0, 'a:6:{s:18:"main_page_priority";b:0;s:13:"cats_priority";b:0;s:14:"pages_priority";b:0;s:20:"main_page_changefreq";b:0;s:21:"categories_changefreq";b:0;s:16:"pages_changefreq";b:0;}', 15),
  ('search', 'search', 1, 1, 0, NULL, 22),
  ('feedback', 'feedback', 1, 0, 0, 'a:2:{s:5:"email";s:19:"admin@localhost.loc";s:15:"message_max_len";i:550;}', 25),
  ('template_editor', 'template_editor', 0, 0, 0, NULL, 17),
  ('group_mailer', 'group_mailer', 0, 0, 1, NULL, 10),
  ('cfcm', 'cfcm', 0, 0, 0, NULL, 16),
  ('sample_mail', 'sample_mail', 0, 0, 0, NULL, 20),
  ('mailer', 'mailer', 1, 0, 0, NULL, 21),
  ('share', 'share', 1, 0, 1, 'a:10:{s:5:"vkcom";s:1:"1";s:8:"facebook";s:1:"1";s:7:"twitter";s:1:"1";s:2:"gg";s:1:"1";s:4:"type";s:7:"counter";s:13:"facebook_like";s:1:"1";s:7:"vk_like";s:1:"1";s:8:"vk_apiid";s:7:"3901548";s:7:"gg_like";s:1:"1";s:12:"twitter_like";s:1:"1";}', 8),
  ('banners', 'banners', 1, 0, 1, 'a:1:{s:8:"show_tpl";i:1;}', 1),
  ('cmsemail', 'cmsemail', 1, 0, 1, 'a:3:{s:2:"ru";a:13:{s:4:"from";s:18:"Corporate UniTheme";s:10:"from_email";s:19:"noreplay@mysite.com";s:11:"admin_email";s:15:"info@mysite.com";s:5:"theme";s:18:"Corporate UniTheme";s:12:"wraper_activ";s:2:"on";s:6:"wraper";s:255:"<h2>Corporate UniTheme</h2>\n<div>$content</div>\n<hr />\n<p>С уважением, Corporate UniTheme</p>\n<p><small>Данное письмо создано автоматически, пожалуйста не отвечайте на него.</small></p>";s:8:"mailpath";s:0:"";s:8:"protocol";s:4:"mail";s:9:"smtp_host";s:0:"";s:9:"smtp_user";s:10:"ad@min.com";s:9:"smtp_pass";s:5:"admin";s:4:"port";s:0:"";s:10:"encryption";s:0:"";}s:2:"en";a:13:{s:4:"from";s:22:"Online store ImageShop";s:10:"from_email";s:19:"noreplay@client.com";s:11:"admin_email";s:15:"info@client.com";s:5:"theme";s:22:"Online store ImageShop";s:12:"wraper_activ";s:2:"on";s:6:"wraper";s:159:"<h2>Online store "ImageShop"</h2>\n<div>$content</div>\n<hr />\n<p>Sincerely, online store "ImageShop"</p>\n<p>This is an automated email, please do not reply.</p>";s:8:"mailpath";s:0:"";s:8:"protocol";s:4:"mail";s:9:"smtp_host";s:0:"";s:9:"smtp_user";s:10:"ad@min.com";s:9:"smtp_pass";s:5:"admin";s:4:"port";s:0:"";s:10:"encryption";s:0:"";}s:2:"ua";a:13:{s:4:"from";s:41:"Інтернет-магазин ImageShop";s:10:"from_email";s:22:"noreplay@client.com.ua";s:11:"admin_email";s:18:"info@client.com.ua";s:5:"theme";s:41:"Інтернет-магазин ImageShop";s:12:"wraper_activ";s:2:"on";s:6:"wraper";s:284:"<h2>Інтернет-магазин "ImageShop"</h2>\n<div>$content</div>\n<hr />\n<p>З повагою, Інтернет-магазин "ImageShop"</p>\n<p>Даний лист створено автоматично, будь ласка не відповідайте на нього.</p>";s:8:"mailpath";s:0:"";s:8:"protocol";s:4:"mail";s:9:"smtp_host";s:0:"";s:9:"smtp_user";s:10:"ad@min.com";s:9:"smtp_pass";s:5:"admin";s:4:"port";s:0:"";s:10:"encryption";s:0:"";}}', 4),
  ('language_switch', 'language_switch', 0, 0, 0, NULL, 23),
  ('star_rating', 'star_rating', 1, 0, 0, NULL, 12),
  ('translator', 'translator', 1, 1, 1, 'a:2:{s:11:"originsLang";s:2:"en";s:11:"editorTheme";s:6:"chrome";}', 11),
  ('imagebox', 'imagebox', 0, 1, 0, NULL, 18),
  ('sample_module', 'sample_module', 1, 1, 0, NULL, NULL),
  ('template_manager', 'template_manager', 1, 1, 1, NULL, NULL),
  ('xbanners', 'xbanners', 1, 1, 1, NULL, NULL),
  ('custom_scripts', 'custom_scripts', 0, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_seo`
--

DROP TABLE IF EXISTS `mod_seo`;
CREATE TABLE IF NOT EXISTS `mod_seo` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `locale`   VARCHAR(5)       DEFAULT NULL,
  `settings` TEXT,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Структура таблицы `mod_seo_inflect`
--

DROP TABLE IF EXISTS `mod_seo_inflect`;
CREATE TABLE IF NOT EXISTS `mod_seo_inflect` (
  `id`            INT(11)      NOT NULL AUTO_INCREMENT,
  `original`      VARCHAR(250) NOT NULL,
  `inflection_id` INT(11)      NOT NULL,
  `inflected`     VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Структура таблицы `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id`              BIGINT(11)   NOT NULL AUTO_INCREMENT,
  `title`           VARCHAR(500) NOT NULL,
  `meta_title`      VARCHAR(300)          DEFAULT NULL,
  `url`             VARCHAR(500) NOT NULL,
  `cat_url`         VARCHAR(260)          DEFAULT NULL,
  `keywords`        TEXT,
  `description`     TEXT,
  `prev_text`       TEXT,
  `full_text`       LONGTEXT     NOT NULL,
  `category`        INT(11)      NOT NULL,
  `full_tpl`        VARCHAR(50)           DEFAULT NULL,
  `main_tpl`        VARCHAR(50)  NOT NULL,
  `position`        SMALLINT(5)  NOT NULL,
  `comments_status` SMALLINT(1)  NOT NULL,
  `comments_count`  INT(9)                DEFAULT '0',
  `post_status`     VARCHAR(15)  NOT NULL,
  `author`          VARCHAR(50)  NOT NULL,
  `publish_date`    INT(11)      NOT NULL,
  `created`         INT(11)      NOT NULL,
  `updated`         INT(11)      NOT NULL,
  `showed`          INT(11)      NOT NULL,
  `lang`            INT(11)      NOT NULL DEFAULT '0',
  `lang_alias`      INT(11)      NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `url` (`url`(333)),
  KEY `lang` (`lang`),
  KEY `post_status` (`post_status`(4)),
  KEY `cat_url` (`cat_url`),
  KEY `publish_date` (`publish_date`),
  KEY `category` (`category`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 142;

--
-- Дамп данных таблицы `content`
--

INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`)
VALUES
  (85, 'Налоговые консультации', '', 'nalogovye-konsultatsii', 'uslugi/', '',
       'Налоог  обязательный, индивидуально безвозмездный платёж, принудительно взимаемый органами государственной власти различных уровней с организаций и физических лиц в целях финансового обеспечения деятельности государства и (или) муниципальных образований.',
       '<p><span>Сегодня ни одно предприятие не обходится без минимальной налоговой консультации. Наша компания предлагает полный спектр услуг в плане правильного построения и составления налоговых обложений, очередности их выплачивания, а также оценивания рисков.</span></p>',
       '<p>Наша юридическая фирма проводит налоговые консультации по налоговому законодательству для физических и для юридических лиц. Организациям предоставляются выгодные условия сотрудничества при возникновении налоговых споров.<br /> <br />Юридические консультации по налогообложению, проводятся профессиональными адвокатами в Киеве, которые имеют опыт как в консультировании по налоговым вопросам, так и опыт в досудебном и судебном разрешении налоговых споров. Консультирование по налогам всегда узкоспециализированная сфера, поэтому задействуется адвокат по определенному правовому направлению, например: консультация по возмещению налога на добавленную стоимость, проводит один адвокат, а по консультацию по обжалованию налогового уведомления-решения, другой налоговый юрист. Такой подход, существенно повышает качество юридической консультации за счет использования опыта адвоката в специфических налоговых спорах.<br /> <br />Обратившись в нашу юридическую компанию за юридической консультацией по налогообложению, мы всегда подтвердим на практике грамотную квалификацию налогового адвоката. Если Вы ищите качественную юридическую консультацию по налогам, вы двигаетесь в нужном направлении. Мы поможем получить гарантированно квалифицированную помощь адвокатов по различным вопросам налогового права, начиная от выезда адвоката на предприятие при проведении налоговой проверки до разрешения налогового спора в судебном порядке.</p>',
       62, '', '', 9, 0, 0, 'publish', 'Administrator', 1428164860, 1428164860, 1436456492, 38, 3, 0),
  (86, 'Услуги адвоката', '', 'uslugi-advokata', 'uslugi/', '', 'Адвокат (лат. advocatus  от advoco  приглашаю)  лицо, профессией которого является оказание квалифицированной юридической помощи физическим лицам (гражданам, лицам без гражданства) и юридическим лицам (организациям), в том числе защита их интересов и прав', '<p><span>У Вас возникли правовые проблемы и вам нужна юридическая поддержка? Обратитесь к квалифицированному адвокату. Наш&nbsp;город включает в себя достаточно разнообразный рынок юридических услуг, которые предоставляют квалифицированные адвокаты. Но довольно сложно найти опытного юриста, знающего свое дело и разбирающегося в действующем законодательстве.&nbsp;</span></p>\n<p></p>', '<p>Впервые адвокаты появились в Древнем Риме. Как отмечал русский юрист и историк права польского происхождения Е. В. Васьковский, &laquo;&hellip; первыми юристами в Риме были патроны. В лице их совмещались две профессии: юрисконсультов и адвокатов&raquo;. Долгое время услуги адвоката выполняли ораторы, которые часто не были знатоками права.</p>\n<p>Цицерон посвятил адвокатам, плохо разбирающимся в правовых вопросов, немало едких слов. Адвокатура республиканского периода Древнего Рима была свободной профессией и никакого корпоративного устройства не имела. Корпорация профессиональных защитников в суде сформировалась в Риме в эпоху Империи, то есть до нашей эры.</p>\n<p>Документально зафиксированная коллегия юристов-защитников формировалась на основе хорошо известных в позднейшие времена принципов: требовалось быть занесённым в матрикулы (официальный список лиц с определённым уровнем доходов) и успешно сдать испытания (экзамены) по праву. Устройство адвокатуры, сложившееся в эпоху Империи, было классическим. Оно стало основой всех последующих видоизменений адвокатуры, вплоть до новейшего времени.</p>', 62, '', '', 7, 0, 0, 'publish', 'Administrator', 1428164894, 1428164894, 1436456711, 319, 3, 0),
  (87, 'Контакты', '', 'kontakty', '', 'контакты', 'Контакты', '<h3>Телефон горячей линии</h3>\n<p>8&nbsp;(800) 269-12-42</p>\n<h3><span>Телефоны нашего офиса</span></h3>\n<p><span>(044) 269-12-42</span></p>\n<p><span>(044) 269-12-43</span></p>\n<h3>Пишите нам на e-mail</h3>\n<p><span></span></p>\n<p>info@businessimage.com</p>\n<h3><span>Адрес нашего офиса</span></h3>\n<p>Минск, ул. Красочная 22а</p>', '', 0, '', '', 6, 0, 0, 'publish', 'Administrator', 1428165320, 1428165320, 1436521040, 121, 3, 0),
  (89, 'Объективность как одна из самых важных составляющих', '', 'obektivnost-kak-odna-iz-samyh-vazhnyh-sostavliaiushchih', 'blog/biznes/', 'марта, года, архиве, электронных, препринтов, появилась, статья, хартмана, hartman, коллегами, посвященная, открытию, четырех, транзитных, планет, три, них, являются, горячими, юпитерами, одна, ndash, горячим, сатурном, hat, gsc, слегка, проэволюционировавшая, звезда, спектрального', '16 марта 2015 года в Архиве электронных препринтов появилась статья Дж. Хартмана (J. D. Hartman) с коллегами, посвященная открытию еще четырех транзитных планет. Три из них являются горячими юпитерами, еще одна  горячим сатурном. HAT-P-50 (GSC 0787-00340)', '<p><span>Эффективность принимаемых решений можно оценить только спустя какое-то время, и нередко нельзя точно определить, что явилось причиной улучшений или, наоборот,&nbsp;негативных изменений.</span></p>', '<p><img src="/uploads/images/articles/chair-designer-desk-4927.jpg" alt="" width="900" height="460" /></p>\n<p>Обычно под ненужной работой подразумевается &laquo;мы это могли сделать сами&raquo;. Ненужность также заключается в том, и это особенность самого консалтинга, что результаты работы консультантов зачастую сразу невидны. Эффективность принимаемых решений можно оценить только спустя какое-то время, и нередко нельзя точно определить, что явилось причиной улучшений. Руководству предприятия часто кажется, что это оно само смогло скорректировать и улучшить ситуацию, а консультанты здесь ни причем. В общем, это вопрос больше исторический, чем риторический.</p>\n<p>Не так&nbsp;далеки те времена, когда бизнес в нашей стране заключался в приобретении и наращивании активов и их последующей перепродаже. Некоторыми предприятиями услуги консалтинга по большому счету использовались как инструмент &laquo;отмывания&raquo; денег. Вот, типа, пришли консультанты, нарисовали бизнес-процессы за кругленькую сумму и ушли. Никому эти бизнес-процессы не нужны, они так и остались на бумаге, деньги &laquo;распилены&raquo; &ndash; все счастливы.</p>\n<p>С другой стороны (и это продолжается до сих пор) многие предприятия приглашают консультантов с целью &laquo;это модно&raquo; или для возможности помахать флагом (особенно, когда приглашают какую-нибудь западную и широкоизвестную компанию) - &laquo;у нас поработали консультанты, нарисовали процессы, а значит мы на мировом уровне&raquo;. В итоге получается забавная картина, когда говорят о бизнес-процессах, многие руководители представляет себе толстенную (и надо сказать дорогую) пачку бумаги с нарисованными квадратиками и стрелочками. Но ведь бизнес-процессы это не квадратики на бумаге, это реально работающие процессы на предприятии. Дальше нечестность порождает еще большую нечестность, у консультантов в голове крутятся доллары, бессмысленность и ненужность работы, и в итоге пошел процесс &laquo;нужно побольше придумать себе работы и побольше взять денег&raquo;. В итоге, получается, что мощный инструмент бизнес-консалтинга используется абсолютно не по назначению.</p>\n<p></p>', 67, '', '', 5, 1, 3, 'publish', 'Administrator', 1429529033, 1429529033, 1436527746, 198, 3, 0),
  (90, 'Не откладывайте запуск лучших бизнес-идей', '', 'ne-otkladyvaite-zapusk-luchshih-biznes-idei', 'blog/biznes/', 'изучение, планетных, систем, звезд, различной, массы, находящихся, разных, стадиях, эволюции, позволяет, глубже, понимать, весь, комплекс, процессов, планетообразования, важной, частью, подобных, исследований, является, поиск, планет, промежуточной, массой, солнечных, будучи, главной, последовательности', 'Изучение планетных систем у звезд различной массы и находящихся на разных стадиях эволюции позволяет глубже понимать весь комплекс процессов планетообразования. Важной частью подобных исследований является поиск и изучение планет у звезд промежуточной мас', '<p>В прошлом году предприниматель и специалист по маркетингу Ной Каган бросил вызов самому себе, запустив бизнес и заработав первые $1000 в течение 24 часов. Тем самым он хотел доказать тот факт, что нет ни единой причины не начать свое предприятие именно сегодня.</p>', '<p><img src="/uploads/images/articles/chair-designer-desk-4929.jpg" alt="" width="900" height="460" /></p>\n<p>В прошлом году предприниматель и специалист по маркетингу Ной Каган бросил вызов самому себе, запустив бизнес и заработав первые $1000 в течение 24 часов. Тем самым он хотел доказать тот факт, что нет ни единой причины не начать свое предприятие именно сегодня. Используя только домен, наскоро созданную landing page и привлеченное к проекту внимание, Каган удивил скептиков и основал прибыльный стартап еще до того, как создал свой первый продукт.</p>\n<p>Лучшие бизнес идеи имеют свойство видоизменяться вместе с бизнес-ландшафтом, об этом стоит помнить. Чтобы быть успешным, не всегда следует оставаться упрямым. Потребуется мобилизация всех запасов смелости для отказа от первичного плана в пользу роста.</p>\n<p>Многие решения предпринимателей могут казаться со стороны безрассудными. Например, оффлайн-ритейлер Amerisleep в один момент полностью отказался от реальных магазинов, сделав ставку на электронную коммерцию. Руководство решило, что лучшие бизнес идеи могут быть воплощены в жизнь в контексте интернета. Потребители и конкуренты видели в этом необоснованный риск и отступление с занятых позиций. Жертвуя каналом сбыта, компания в то же время сбросила оковы территориальных ограничений, а также замедляющие рост арендные выплаты. Помните, стабильность и выгода в краткосрочной перспективе &mdash; главные враги развития и масштабирования бизнеса.</p>', 67, '', '', 4, 1, 2, 'publish', 'Administrator', 1423830381, 1423830381, 1436527719, 35, 3, 0),
  (92, 'Андрей Павличенко', '', 'andrei-pavlichenko', 'klienty-o-nas/', 'компания, показала, себя, надежного, партнера, вовремя, были, сделаны, запланированные, работы, организованы, рекламные, кампании, чувствуется, профессионализм', 'Компания показала себя как надежного партнера, вовремя были сделаны все запланированные работы и организованы рекламные кампании, чувствуется профессионализм', 'Компания показала себя как надежного партнера, вовремя были сделаны все запланированные работы и организованы рекламные кампании, чувствуется профессионализм', '', 66, '', '', 3, 0, 0, 'publish', 'Administrator', 1429362249, 1429362249, 1436386855, 0, 3, 0),
  (93, 'Артур Рудковский', '', 'artur-rudkovskii', 'klienty-o-nas/', 'выражаю, благодарность, компании, реализацию, проекта, повышению, эффективности, бизнес, процессов, нашей, проектированию, новой, организационной, структуры', 'Выражаю благодарность компании за реализацию проекта по повышению эффективности бизнес-процессов в нашей компании и проектированию новой организационной структуры.', '<p>Выражаю благодарность компании за реализацию проекта по повышению эффективности бизнес-процессов в нашей компании и проектированию новой организационной структуры.</p>', '', 66, '', '', 2, 0, 0, 'publish', 'Administrator', 1429362954, 1429362954, 1429376272, 3, 3, 0),
  (84, 'Бизнес-консалтинг', '', 'business-consulting', 'uslugi/', '', 'Бизнес-консалтинг  вид услуг, связанный с подготовкой рекомендаций по достижению поставленных целей в экономической деятельности. Бизнес-консалтинг может включать в себя не только консультационную поддержку, но и саму реализацию управленческих решений. Та', '<p>Бизнес-консалтинг &ndash; вид услуг, связанный с подготовкой рекомендаций по достижению поставленных целей в экономической деятельности. Бизнес-консалтинг может включать в себя не только консультационную поддержку, но и саму реализацию управленческих решений.</p>', '<p>Сообщения для потребителей отправляются бизнесом по традиционным каналам в надежде быть услышанным. Интернет-маркетинг же инициирует постоянный диалог между компаниями и клиентами. При этом охват собеседников может быть по-настоящему широким, но, говоря о качественном составе аудитории, следует отметить тот факт, что не все ее сегменты доступны в рамках цифровых коммуникаций. Кроме того, далеко не каждая группа пользователей интернет является платежеспособной, а, значит, теряется контакт с людьми, представляющими наибольший интерес для бизнеса. Таким образом, конечных пользователей многих брендов до сих пор можно достичь лишь традиционными методами, какими бы технически устаревшими те не были.</p>\n<p>Цифровой маркетинг динамичен, он характеризуется высокой скоростью доставки любых видов контента. Аудитория в мгновение ока может получить информацию, представленную в текстовом или графическом виде. К тому же, эффективность коммуникации может быть измерена в режиме реального времени, что позволяет очень быстро адаптироваться в соответствие с малейшими изменениями для улучшения результатов.</p>', 62, '', '', 11, 0, 0, 'publish', 'Administrator', 1428164555, 1428164555, 1436456692, 66, 3, 0),
  (109, 'Консультирование по управлению компьютерной структурой', '', 'konsultirovanie-po-upravleniiu-kompiuternoi-strukturoi', 'blog/ekonomika/', 'марта, архиве, электронных, препринтов, появилась, статья, посвященная, итогам, мониторинга, наблюдательной, площадки, кампания, который, проводился, мая, августа, года, обнаружено, транзитных, кандидатов, звезды, прошли, процедуру, валидации, статистического, подтверждения, причем, ndash, впервые, достоверность', '26 марта в Архиве электронных препринтов появилась статья, посвященная итогам мониторинга 1-й наблюдательной площадки (Кампания 1), который проводился с 30 мая по 21 августа 2014 года. Обнаружено 36 транзитных кандидатов у 31 звезды. 18 кандидатов прошли', '<p><span>Стремительный прогресс в области информационных технологий привел к тому, что они прочно вошли в нашу повседневную жизнь.&nbsp;</span><span>Сложно представить область человеческой деятельности, где бы информационные технологии не использовались в той или иной мере.&nbsp;</span></p>', '<p><img src="/uploads/images/articles/chair-designer-desk-4936.jpg" alt="" width="900" height="460" /></p>\n<p>Стремительный прогресс в области информационных технологий привел к тому, что они прочно вошли в нашу повседневную жизнь.&nbsp;Сложно представить область человеческой деятельности, где бы информационные технологии не использовались в той или иной мере.&nbsp;От того насколько квалифицированно решаются задачи в области ИТ напрямую зависит успешность и конкурентоспособность бизнеса.&nbsp;В наше время лавинообразного роста предложений на рынке ИТ услуг, появления большого колличества программных продуктов, технических решений от именитых так и не очень производителей зачастую приводит непосвященного в состояние полной неразберихи.&nbsp;Пытаясь принять решение, перед руководителем предприятия зачастую встают вопросы с чего начать,&nbsp;как делать&nbsp;и&nbsp;кому делать?<br /><br />Эти и многие другие вопросы возникают не только у начинающих руководителей малых и средних предприятий, но и у куда более опытных их коллег.&nbsp;Хорошо если рядом есть доверенный профессионал, который поможет советом и даст ответы на насущные вопросы квалифицированно и понятно.&nbsp;Наши консультанты готовы помочь вам. Имея многолетний практический опыт в предметных областях, предлагаем выверенные временем решения.<br /><br />Наша компания&nbsp;осуществляет консультирование предприятий по вопросам управления компьютерной структурой, автоматизации бизнес-процессов, выбора программных, аппаратных платформ и поставщиков оборудования.&nbsp;На основе многолетнего опыта работы предлагаем выверенные временем решения.</p>', 69, '', '', 0, 1, 3, 'publish', 'Administrator', 1427887795, 1427887795, 1436527614, 154, 3, 0),
  (110, 'Главная вещь, которая стоит между вами и успехом', '', 'glavnaia-veshch-kotoraia-stoit-mezhdu-vami-i-uspehom', 'blog/ekonomika/', 'марта, года, архиве, электронных, препринтов, появилась, статья, луиджи, манчини, luigi, mancini, коллегами, посвященная, открытию, двух, новых, экзопланет, hats, подавляющее, большинство, других, обнаруженных, наземными, транзитными, обзорами, обе, планеты, являются, горячими, юпитерами', '12 марта 2015 года в Архиве электронных препринтов появилась статья Луиджи Манчини (Luigi Mancini) с коллегами, посвященная открытию двух новых экзопланет HATS-13 b и HATS-14 b. Как и подавляющее большинство других экзопланет, обнаруженных наземными транз', '<p>Чтобы начать бизнес, нужно сделать очень много действительно важных вещей: исследовать рынок, найти целевую аудиторию, определить ее&nbsp;потребности, разработать удовлетворяющий их продукт, продумать маркетинг, посчитать бюджет.</p>', '<p><img src="/uploads/images/articles/chair-designer-desk-4928.jpg" alt="" width="900" height="460" /></p>\n<p>Мало кто был способен настолько метко формулировать великие мысли, как Генри Форд (Henry Ford), который подметил: &laquo;Верите вы, что сможете, либо верите, что не сможете &ndash; вы правы&raquo;. Kюди не пробуют! Многие талантливые и подающие надежды бизнесмены в самом начале своего пути не добиваются успеха, потому что не верят в свои силы и боятся рисковать. Предпосылки могут быть самые разные:&nbsp;Затянувшиеся размышления, после которых не остается сил &laquo;нажать на курок&raquo;, то есть начать действовать. Консервативные родственники, друзья или &laquo;советчики&raquo;, которые боятся сделать это сами и &laquo;предупреждают&raquo; других. Слишком долгая подготовка, которая не дает желаемого результата и дает преимущество тем, кто действует.</p>\n<p>Если у вас есть идея &mdash; реализуйте ее как можно скорее и с минимальными денежными вложениями. И наблюдайте за происходящим. Возможно, вы поймете, что на правильном пути. В большинстве случаев этот этап показывает, что нужно изменить и над чем поработать, чтобы развиваться в правильном направлении. Это естественно &mdash; и через это проходят все. И даже если у вас не получилось &mdash; в этом нет никакой катастрофы, ведь вы минимизировали свои затраты. Поэтому у вас еще должно остаться достаточно сил и средств на новые попытки.</p>\n<p>Главное препятствие к вашему успеху &mdash; страх. Чтобы добиться успеха в новом бизнесе, не бойтесь идти на риск. У баскетболистов и хоккеистов есть выражение: &laquo;Ты промахиваешься в 100% случаев, когда не пробуешь&raquo;. Думаем, оно лучше всего передает смысл нашего сегодняшнего материала. Действуйте!</p>', 69, '', '', 1, 1, 0, 'publish', 'Administrator', 1426335738, 1426335738, 1436527679, 25, 3, 0),
  (129, 'Контакти', '', 'kontakty', '', '', '', '<h3>Телефон гарячої лінії</h3>\n<p>8&nbsp;(800) 269-12-42</p>\n<h3><span>Телефони нашого&nbsp;офісу</span></h3>\n<p><span>(044) 269-12-42</span></p>\n<p><span>(044) 269-12-43</span></p>\n<h3>Пишіть нам на e-mail</h3>\n<p>info@businessimage.com<br /><span></span></p>\n<h3><span>Адреса нашого офісу</span></h3>\n<p>Мінськ, вул. Барвиста 22а</p>', '', 0, '', '', 0, 0, 0, 'publish', 'Administrator', 1428165320, 1428165320, 1436777787, 4, 32, 87),
  (130, 'Послуги адвоката', '', 'uslugi-advokata', 'uslugi/', '', '',
        '<p>У Вас виникли правові проблеми і вам потрібна юридична підтримка? Зверніться до кваліфікованого адвоката. Наше місто включає в себе досить різноманітний ринок юридичних послуг, які надають кваліфіковані адвокати. Але досить складно знайти досвідченого юриста, який знає свою справу і розбирається в чинному законодавстві.</p>',
        '<p>Вперше адвокати з''явилися в Стародавньому Римі. Як зазначав російський юрист і історик права польського походження Е. В. Васьковський, &laquo;... першими юристами в Римі були патрони. В особі їх поєднувалися дві професії: юрисконсультів і адвокатів &raquo;. Довгий час послуги адвоката виконували оратори, які часто вже не були знавцями права.</p>\n<p>Цицерон присвятив адвокатам, погано розбирається в правових питань, чимало їдких слів. Адвокатура республіканського періоду Стародавнього Риму була вільною професією і ніякого корпоративного пристрою не мала. Корпорація професійних захисників у суді сформувалася в Римі в епоху Імперії, тобто до нашої ери.</p>\n<p>Документально зафіксована колегія юристів-захисників формувалася на основі добре відомих в пізніші часи принципів: вимагалося бути занесеним в матрикули (офіційний список осіб з певним рівнем доходів) та успішно скласти випробування (іспити) по праву. Пристрій адвокатури, що склалося в епоху Імперії, було класичним. Воно стало основою всіх подальших видозмін адвокатури, аж до новітнього часу.</p>',
        62, '', '', 0, 0, 0, 'publish', 'Administrator', 1428164894, 1428164894, 1436779421, 12, 32, 86),
  (131, '', NULL, 'uslugi-advokata', 'uslugi/', NULL, NULL, NULL, '', 62, '', '', 0, 0, 0, 'publish', 'Administrator',
                                                                              1428164894, 1428164894, 0, 3, 33, 86),
  (132, 'Податкові консультації', '', 'nalogovye-konsultatsii', 'uslugi/', '',
        'Податок - обов''язковий, індивідуально безвідплатний платіж, примусово стягується органами державної влади різних рівнів з організацій і фізичних осіб з метою фінансового забезпечення діяльності держави і (або) муніципальних утворень. Податки бувають офіці',
        '<p>Cьогодні жодне підприємство не обходиться без мінімальної податкової консультації. Наша компанія пропонує повний спектр послуг в плані правильної побудови і складання податкових обкладань, черговості їх виплачування, а також оцінювання ризиків.</p>',
        '<p>Наша юридична фірма проводить податкові консультації з податкового законодавства для фізичних і для юридичних осіб. Організаціям надаються вигідні умови співпраці при виникненні податкових спорів.</p>\n<p>Юридичні консультації з оподаткування, проводяться професійними адвокатами в Києві, які мають досвід як у консультуванні з податкових питань, так і досвід в досудовому та судовому вирішенні податкових спорів. Консультування з податків завжди вузькоспеціалізована сфера, тому задіюється адвокат по певному правовому напрямку, наприклад: консультація з відшкодування податку на додану вартість, проводить один адвокат, а по консультацію щодо оскарження податкового повідомлення-рішення, інший податковий юрист. Такий підхід, істотно підвищує якість юридичної консультації за рахунок використання досвіду адвоката в специфічних податкових суперечках.</p>\n<p>Звернувшись в нашу юридичну компанію за юридичною консультацією з оподаткування, ми завжди підтвердимо на практиці грамотну кваліфікацію податкового адвоката. Якщо Ви шукайте якісну юридичну консультацію з податків, ви рухаєтеся в потрібному напрямку. Ми допоможемо отримати гарантовано кваліфіковану допомогу адвокатів з різних питань податкового права, починаючи від виїзду адвоката на підприємство при проведенні податкової перевірки до дозволу податкового спору в судовому порядку.</p>',
        62, '', '', 0, 0, 0, 'publish', 'Administrator', 1428164860, 1428164860, 1436779320, 5, 32, 85),
  (136, 'Не відкладайте запуск кращих бізнес-ідей', '', 'ne-otkladyvaite-zapusk-luchshih-biznes-idei', 'blog/biznes/',
        '', '',
        '<p>Торік підприємець і фахівець з маркетингу Ной Каган кинув виклик самому собі, запустивши бізнес і заробивши перші $ 1000 протягом 24 годин. Тим самим він хотів довести той факт, що немає жодної причини не почати своє підприємство саме сьогодні.</p>',
        '<p><img src="/uploads/images/articles/chair-designer-desk-4929.jpg" alt="" width="900" height="460" /></p>\n<p>Торік підприємець і фахівець з маркетингу Ной Каган кинув виклик самому собі, запустивши бізнес і заробивши перші $ 1000 протягом 24 годин. Тим самим він хотів довести той факт, що немає жодної причини не почати своє підприємство саме сьогодні. Використовуючи тільки домен, нашвидку створену landing page і притягнуте до проекту увагу, Каган здивував скептиків і заснував прибутковий стартап ще до того, як створив свій перший продукт.</p>\n<p>Кращі бізнес ідеї мають властивість видозмінюватися разом з бізнес-ландшафтом, про це варто пам''ятати. Щоб бути успішним, не завжди слід залишатися впертим. Буде потрібно мобілізація всіх запасів сміливості для відмови від первинного плану на користь зростання.</p>\n<p>Багато рішень підприємців можуть здаватися з боку безрозсудними. Наприклад, оффлайн-рітейлер Amerisleep в один момент повністю відмовився від реальних магазинів, зробивши ставку на електронну комерцію. Керівництво вирішило, що кращі бізнес ідеї можуть бути втілені в життя в контексті інтернету. Споживачі і конкуренти бачили в цьому необгрунтований ризик і відступ із зайнятих позицій. Жертвуючи каналом збуту, компанія в той же час скинула окови територіальних обмежень, а також сповільнюють ріст орендні виплати. Пам''ятайте, стабільність і вигода в короткостроковій перспективі - головні вороги розвитку і масштабування бізнесу.</p>',
        67, '', '', 0, 0, 0, 'publish', 'Administrator', 1423830381, 1423830381, 1436776826, 0, 32, 90),
  (133, 'Артур Рудковський', '', 'artur-rudkovskii', 'klienty-o-nas/', '', '',
        '<p>Висловлюю подяку компанії за реалізацію проекту з підвищення ефективності бізнес-процесів в нашій компанії і проектування нової організаційної структури.</p>',
        '', 66, '', '', 0, 0, 0, 'publish', 'Administrator', 1429362954, 1429362954, 1436777676, 1, 32, 93),
  (134, 'Андрій Павличенко', '', 'andrei-pavlichenko', 'klienty-o-nas/', '', '',
        '<p>Компанія показала себе як надійного партнера, вчасно були зроблені всі заплановані роботи і організовані рекламні кампанії, відчувається професіоналізм</p>',
        '', 66, '', '', 0, 0, 0, 'publish', 'Administrator', 1429362249, 1429362249, 1436386848, 1, 32, 92),
  (135, '', NULL, 'andrei-pavlichenko', 'klienty-o-nas/', NULL, NULL, NULL, '', 66, '', '', 0, 0, 0, 'publish',
                                                                                        'Administrator', 1429362249,
                                                                                        1429362249, 0, 0, 33, 92),
  (121, 'Оптимизация налогов и управление налоговыми рисками', '',
        'optimizatsiia-nalogov-i-upravlenie-nalogovymi-riskami', 'blog/',
        'марта, архиве, электронных, препринтов, появилась, статья, посвященная, итогам, мониторинга, наблюдательной, площадки, кампания, который, проводился, мая, августа, года, обнаружено, транзитных, кандидатов, звезды, прошли, процедуру, валидации, статистического, подтверждения, причем, ndash, впервые, достоверность',
        '26 марта в Архиве электронных препринтов появилась статья, посвященная итогам мониторинга 1-й наблюдательной площадки (Кампания 1), который проводился с 30 мая по 21 августа 2014 года. Обнаружено 36 транзитных кандидатов у 31 звезды. 18 кандидатов прошли',
        '<p>Реалии нашего бизнеса таковы, что стремление к снижению налоговой нагрузки присуще практически каждому предприятию, независимо от рода и географии его деятельности. Но почему при этом не использовать легальные способы оптимизации налогообложения?&nbsp;</p>',
        '<p><img src="/uploads/images/articles/woman-typing-writing-windows-4.jpg" alt="" width="900" height="460" /></p>\n<p>Как правило, общение с контролирующими органами не всегда является удовольствием для бухгалтеров или руководителей компаний. Почему так? Потому, что представитель налоговой инспекции приходит для того, чтобы найти ошибки в ведении бухгалтерского или налогового учета, а причина возникновения ошибки &ndash; случайно или специально &ndash; для налоговиков не имеет значения.</p>\n<p>Реалии нашего бизнеса таковы, что стремление к снижению налоговой нагрузки присуще практически каждому предприятию, независимо от рода и географии его деятельности. Но почему при этом не использовать легальные способы оптимизации налогообложения? Налоговая оптимизация &ndash; это легитимное, эффективное налоговое планирование начислений и уплат в бюджет. Использование легальной оптимизации налогов позволит избежать множества проблем и негативных последствий.</p>\n<p>Для того, чтобы правильно использовать методы минимизации налогов, следует ориентироваться на такие пункты налогового планирования, которые позволят составить индивидуальные схемы оптимизации налогообложения. На российском рынке можно встретить много различных предложений об оказании налоговых услуг. Но большинство из них помогают устранить только часть проблем, связанных с налогами. Поэтому необходимо обращаться к экспертам, которые комплексно подойдут к решению данной задачи.</p>',
        64, '', '', 1, 1, 3, 'publish', 'Administrator', 1427887795, 1427887795, 1436527811, 119, 3, 0);
INSERT INTO `content` (`id`, `title`, `meta_title`, `url`, `cat_url`, `keywords`, `description`, `prev_text`, `full_text`, `category`, `full_tpl`, `main_tpl`, `position`, `comments_status`, `comments_count`, `post_status`, `author`, `publish_date`, `created`, `updated`, `showed`, `lang`, `lang_alias`)
VALUES
  (124, 'Про компанию', '', 'pro-kompaniiu', '',
        'heading, lorem, ipsum, dolor, sit, amet, consectetuer, adipiscing, elit, aenean, commodo, ligula, eget, massa, cum, sociis, natoque, penatibus, text, level, semantics, this, should, hidden, all, bsysrowsers, apart, from, the, element',
        'Heading 1 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et m. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa',
        '<p>Компания&nbsp;<span>Business </span><span>Image&nbsp;</span>является передовым экспертом в области повышения эффективности ведения бизнеса и управления проектами. Мы разрабатываем и внедряем маркетинговые кейсы, предоставляя уникальное качество услуг бизнес консалтинга. Мы&nbsp;обладаем&nbsp;навыками системного мышления и многолетним опытом в реализации маркетинговых проектов.&nbsp;</p>\n<p>Нашей специализацией являются&nbsp;информационные технологии в связке с уникальными маркетинговыми инструментами. Мы полностью включаемся в проект и берем на себя его комплексное сопровождение, а не просто раздаем умные советы.&nbsp;</p>',
        '<p>Разработка стратегий и внедрение проектов по развитию бизнеса, повышению эффективности и автоматизации процессов&nbsp;&mdash; наш профиль.&nbsp;Превращаем свой опыт и знания в вашу прибыль&nbsp;и&nbsp;будем для вас надежным партнером в сфере услуг бизнес-консалтинга!</p>\n<h2>Специализация</h2>\n<p>Информационные технологии в связке с уникальными маркетинговыми инструментами являются нашим главным вектором. Наша отличительная черта &mdash; реализация проектов на основе методов процессного консалтинга, т.е. мы полностью включаемся в проект и берем на себя его комплексное сопровождение, а не просто раздаем умные советы. Мы действуем исключительно в рамках интереса клиента, используя только рабочие и эффективные решения.</p>\n<p>Компания Business Image&nbsp;является передовым экспертом в области повышения эффективности ведения бизнеса и управления проектами. Мы разрабатываем и внедряем передовые маркетинговые и ИТ кейсы, предоставляя уникальное качество услуг бизнес консалтинга. Мы &mdash; команда профессионалов, обладающая навыками системного мышления и многолетним опытом в реализации информационно-технических и маркетинговых проектов. Основная цель, которую мы преследуем &mdash; развитие бизнеса и достижение новых высот наших клиентов, путем разработки и внедрения сложных маркетинговых стратегий и передовых систем автоматизации.&nbsp;</p>\n<h2>Наши&nbsp;возможности</h2>\n<p>Если вы еще размышляете, прибегать к услугам нашей компании, обратиться к конкурентам, или же выполнять задачи собственными силами, мы можем продемонстрировать вам&nbsp;краткий перечень аргументов, которые позволят вам сделать правильный выбор.</p>\n<h4>Эффективные решения</h4>\n<p>Безусловно, наши решения отличаются свежестью и современностью, но в первую очередь они являются эффективными и приносящими реально ощутимую выгоду. Проверенные многолетним опытом и критическими ситуациями,&nbsp;наши решения помогут найти выход в любом положении и, кроме того, обеспечит устойчивое положение вашей компании в будущем.</p>\n<h4>Специалисты</h4>\n<p>Наши специалисты обладают особыми знаниями и навыками, которые практически невозможно получить выполняя задачи в рамках одной компании.&nbsp;Для реализации поставленной задачи вам требуется либо отвлечь Вашего штатного специалиста от текущих задач, либо нанять нового. Мы же готовы тратить столько времени, сколько необходимо, ни больше, ни меньше.</p>\n<h4>Консультанты</h4>\n<p>Наши консультанты всегда являются независимыми объективными экспертами, дающими свежий взгляд со стороны и остающимися беспристрастными в любой ситуации.&nbsp;Консультанты нашей компании, конечно, смогут подержать вас и выслушать, но их решение будет основано только на профессионализме и опыте, поэтому будьте готовы к решениям, которые не совсем отвечают вашим ожиданиям.&nbsp;</p>',
        0, '', '', 0, 0, 0, 'publish', 'Administrator', 1433755063, 1433755063, 1436437101, 384, 3, 0),
  (122, 'Kepler spacecraft', '', 'business-consulting', 'uslugi/', '', '',
        '<p>Kepler is a space observatory launched by NASA to discover Earth-like planets orbiting other stars. The spacecraft, named after the Renaissance astronomer Johannes Kepler, was launched on March 7, 2009.</p>',
        '<p>Designed to survey a portion of our region of the Milky Way to discover dozens of Earth-size extrasolar planets in or near the habitable zone and estimate how many of the billions of stars in our galaxy have such planets, Kepler''s sole instrument is a photometer that continually monitors the brightness of over 145,000 main sequence stars in a fixed field of view. These data are transmitted to Earth, then analyzed to detect periodic dimming caused by extrasolar planets that cross in front of their host star.</p>\n<p>Kepler is part of NASA''s Discovery Program of relatively low-cost, focused primary science missions. The telescope''s construction and initial operation were managed by NASA''s Jet Propulsion Laboratory, with Ball Aerospace responsible for developing the Kepler flight system. The Ames Research Center is responsible for the ground system development, mission operations since December 2009, and scientific data analysis. The initial planned lifetime was 3.5 years, but greater-than-expected noise in the data, from both the stars and the spacecraft, meant additional time was needed to fulfill all mission goals. Initially, in 2012, the mission was expected to last until 2016, but this would only have been possible if all remaining reaction wheels used for pointing the spacecraft remained reliable. On May 11, 2013, a second of four reaction wheels failed, disabling the collection of science data and threatening the continuation of the mission.</p>',
        62, '', '', 0, 0, 0, 'publish', 'Administrator', 1428164555, 1428164555, 1431860696, 2, 33, 84),
  (123, 'Бізнес-консалтинг', '', 'business-consulting', 'uslugi/', '',
        'Бізнес-консалтинг - вид послуг, пов''язаний з підготовкою рекомендацій щодо досягнення поставлених цілей в економічній діяльності. Бізнес-консалтинг може включати в себе не тільки консультаційну підтримку, а й саму реалізацію управлінських рішень. Також до',
        '<p>Бізнес-консалтинг - вид послуг, пов''язаний з підготовкою рекомендацій щодо досягнення поставлених цілей в економічній діяльності. Бізнес-консалтинг може включати в себе не тільки консультаційну підтримку, а й саму реалізацію управлінських рішень.</p>',
        '<p>Повідомлення для споживачів відправляються бізнесом за традиційними каналами в надії бути почутим. Інтернет-маркетинг же ініціює постійний діалог між компаніями і клієнтами. При цьому охоплення співрозмовників може бути по-справжньому широким, але, говорячи про якісний склад аудиторії, слід відзначити той факт, що не всі її сегменти доступні в рамках цифрових комунікацій. Крім того, далеко не кожна група користувачів інтернет є платоспроможною, а, значить, втрачається контакт з людьми, що представляють найбільший інтерес для бізнесу. Таким чином, кінцевих користувачів багатьох брендів досі можна досягти лише традиційними методами, якими б технічно застарілими ті були.</p>\n<p>Цифровий маркетинг динамічний, він характеризується високою швидкістю доставки будь-яких видів контенту. Аудиторія миттю може отримати інформацію, представлену в текстовому або графічному вигляді. До того ж, ефективність комунікації може бути виміряна в режимі реального часу, що дозволяє дуже швидко адаптуватися у відповідність із найменшими змінами для покращення результатів.</p>',
        62, '', '', 0, 0, 0, 'publish', 'Administrator', 1428164555, 1428164555, 1436779379, 6, 32, 84),
  (126, 'Про компанію', '', 'pro-kompaniiu', '', '', '',
        '<p>Компанія Business Image є передовим експертом в галузі підвищення ефективності ведення бізнесу та управління проектами. Ми розробляємо і впроваджуємо маркетингові кейси, надаючи унікальну якість послуг бізнес консалтингу. Ми володіємо навичками системного мислення і багаторічним досвідом в реалізації маркетингових проектів.</p>\n<p>Нашою спеціалізацією є інформаційні технології в зв''язці з унікальними маркетинговими інструментами. Ми повністю включаємось в проект і беремо на себе його комплексний супровід, а не просто роздаємо розумні поради.</p>',
        '<p>Розробка стратегій та впровадження проектів з розвитку бізнесу, підвищенню ефективності та автоматизації процесів - наш профіль. Перетворюємо свій досвід і знання в вашу прибуток і будемо для вас надійним партнером у сфері послуг бізнес-консалтингу!</p>\n<h2>Спеціалізація</h2>\n<p>Інформаційні технології в зв''язці з унікальними маркетинговими інструментами є нашим головним вектором. Наша відмінна риса - реалізація проектів на основі методів процесного консалтингу, тобто ми повністю включаємось в проект і беремо на себе його комплексний супровід, а не просто роздаємо розумні поради. Ми діємо виключно в рамках інтересу клієнта, використовуючи тільки робітники і ефективні рішення.</p>\n<p>Компанія Business Image є передовим експертом в галузі підвищення ефективності ведення бізнесу та управління проектами. Ми розробляємо і впроваджуємо передові маркетингові та ІТ кейси, надаючи унікальну якість послуг бізнес консалтингу. Ми - команда професіоналів, що володіє навичками системного мислення і багаторічним досвідом в реалізації інформаційно-технічних і маркетингових проектів. Основна мета, яку ми переслідуємо - розвиток бізнесу і досягнення нових висот наших клієнтів, шляхом розробки та впровадження складних маркетингових стратегій і передових систем автоматизації.</p>\n<h2>Наші можливості</h2>\n<p>Якщо ви ще роздумуєте, вдаватися до послуг нашої компанії, звернутися до конкурентів, або ж виконувати завдання власними силами, ми можемо продемонструвати вам короткий перелік аргументів, які дозволять вам зробити правильний вибір.</p>\n<h4>Эфективні рішення</h4>\n<p>Безумовно, наші рішення відрізняються свіжістю і сучасністю, але в першу чергу вони є ефективними і приносять реально відчутну вигоду. Перевірені багаторічним досвідом і критичними ситуаціями, наші рішення допоможуть знайти вихід у будь-якому положенні і, крім того, забезпечить стійке положення вашої компанії в майбутньому.</p>\n<h4>Спеціалісти</h4>\n<p>Наші фахівці володіють особливими знаннями і навичками, які практично неможливо отримати виконуючи завдання в рамках однієї компанії. Для реалізації поставленого завдання вам потрібно або відвернути Вашої штатного фахівця від поточних завдань, або найняти нового. Ми ж готові витрачати стільки часу, скільки необхідно, ні більше, ні менше.</p>\n<h4>Консультанти</h4>\n<p>Наші консультанти завжди є незалежними об''єктивними експертами, що дають свіжий погляд з боку і залишаються неупередженими в будь-якій ситуації. Консультанти нашої компанії, звичайно, зможуть потримати вас і вислухати, але їхнє рішення буде засновано тільки на професіоналізм і досвід, тому будьте готові до рішень, які не зовсім відповідають вашим очікуванням.</p>',
        0, '', '', 0, 0, 0, 'publish', 'Administrator', 1433755063, 1433755063, 1436779227, 13, 32, 124),
  (137, 'Об''єктивність як одна з найважливіших складових', '',
        'obektivnost-kak-odna-iz-samyh-vazhnyh-sostavliaiushchih', 'blog/biznes/', '', '',
        '<p>Ефективність прийнятих рішень можна оцінити тільки через якийсь час, і нерідко можна точно визначити, що стало причиною поліпшень або, навпаки, негативних змін.</p>',
        '<p><img src="/uploads/images/articles/chair-designer-desk-4927.jpg" alt="" width="900" height="460" /></p>\n<p>Зазвичай під непотрібною роботою мається на увазі &laquo;ми це могли зробити самі&raquo;. Непотрібність також полягає в тому, і це особливість самого консалтингу, що результати роботи консультантів найчастіше відразу невидно. Ефективність прийнятих рішень можна оцінити тільки через якийсь час, і нерідко можна точно визначити, що стало причиною поліпшень. Керівництву підприємства часто здається, що це воно саме змогло скорегувати й поліпшити ситуацію, а консультанти тут ні причому. Загалом, це питання більше історичний, ніж риторичне.</p>\n<p>Не так далекі ті часи, коли бізнес у нашій країні полягав у придбанні та нарощуванні активів та їх подальшої перепродажі. Деякими підприємствами послуги консалтингу за великим рахунком використовувалися як інструмент &laquo;відмивання&raquo; грошей. Ось, типу, прийшли консультанти, намалювали бізнес-процеси за кругленьку суму і пішли. Нікому ці бізнес-процеси не потрібні, вони так і залишилися на папері, гроші &laquo;розпиляні&raquo; - всі щасливі.</p>\n<p>З іншого боку (і це триває досі) багато підприємств запрошують консультантів з метою &laquo;це модно&raquo; або для можливості помахати прапором (особливо, коли запрошують якусь західну і широковідомих компанію) - &laquo;у нас попрацювали консультанти, намалювали процеси, а значить ми на світовому рівні &raquo;. У підсумку виходить кумедна картина, коли говорять про бізнес-процеси, багато керівників уявляє собі толстенную (і треба сказати дорогу) пачку паперу з намальованими квадратиками і стрілочками. Але ж бізнес-процеси це не квадратики на папері, це реально працюючі процеси на підприємстві. Далі нечесність породжує ще більшу нечесність, у консультантів в голові крутяться долари, безглуздість і непотрібність роботи, і в підсумку пішов процес &laquo;потрібно побільше придумати собі роботи і побільше взяти грошей&raquo;. У результаті, виходить, що потужний інструмент бізнес-консалтингу використовується абсолютно не за призначенням.</p>',
        67, '', '', 0, 0, 0, 'publish', 'Administrator', 1429529033, 1429529033, 1436776981, 0, 32, 89),
  (139, 'Консультування з управління комп''ютерної структурою', '',
        'konsultirovanie-po-upravleniiu-kompiuternoi-strukturoi', 'blog/ekonomika/', '', '',
        '<p>Стрімкий прогрес у галузі інформаційних технологій призвів до того, що вони міцно увійшли в наше повсякденне життя. Складно уявити галузь людської діяльності, де б інформаційні технології не використовувалися в тій чи іншій мірі.</p>',
        '<p><img src="/uploads/images/articles/chair-designer-desk-4936.jpg" alt="" width="900" height="460" /></p>\n<p>Стрімкий прогрес у галузі інформаційних технологій призвів до того, що вони міцно увійшли в наше повсякденне життя. Складно уявити галузь людської діяльності, де б інформаційні технології не використовувалися в тій чи іншій мірі. Від того наскільки кваліфіковано вирішуються завдання в галузі ІТ безпосередньо залежить успішність і конкурентоспроможність бізнесу. У наш час лавиноподібного зростання пропозицій на ринку ІТ послуг, появи безлічі програмних продуктів, технічних рішень від іменитих так і не дуже виробників часто призводить необізнаного в стан повної плутанини. Намагаючись прийняти рішення, перед керівником підприємства часто постають питання з чого почати, як робити і кому робити?</p>\n<p>Ці та багато інших питань виникають не тільки у початківців керівників малих і середніх підприємств, а й у куди більш досвідчених їхніх колег. Добре якщо поруч є довірений професіонал, який допоможе порадою і дасть відповіді на нагальні питання кваліфіковано і зрозуміло. Наші консультанти готові допомогти вам. Маючи багаторічний практичний досвід у предметних областях, пропонуємо вивірені часом рішення.</p>\n<p>Наша компанія здійснює консультування підприємств з питань управління комп''ютерною структурою, автоматизації бізнес-процесів, вибору програмних, апаратних платформ і постачальників устаткування. На основі багаторічного досвіду роботи пропонуємо вивірені часом рішення.</p>',
        69, '', '', 0, 1, 0, 'publish', 'Administrator', 1427887795, 1427887795, 1436546533, 1, 32, 109),
  (140, 'Оптимізація податків та управління податковими ризиками', '',
        'optimizatsiia-nalogov-i-upravlenie-nalogovymi-riskami', 'blog/', '', '',
        '<p>Реалії нашого бізнесу такі, що прагнення до зниження податкового навантаження притаманне практично кожному підприємству, незалежно від роду та географії його діяльності. Але чому при цьому не використовувати легальні способи оптимізації оподаткування?</p>',
        '<p><img src="/uploads/images/articles/woman-typing-writing-windows-4.jpg" alt="" width="900" height="460" /></p>\n<p>Як правило, спілкування з контролюючими органами не завжди є задоволенням для бухгалтерів чи керівників компаній. Чому так? Тому, що представник податкової інспекції приходить для того, щоб знайти помилки у веденні бухгалтерського або податкового обліку, а причина виникнення помилки - випадково чи спеціально - для податківців не має значення.</p>\n<p>Реалії нашого бізнесу такі, що прагнення до зниження податкового навантаження притаманне практично кожному підприємству, незалежно від роду та географії його діяльності. Але чому при цьому не використовувати легальні способи оптимізації оподаткування? Податкова оптимізація - це легітимне, ефективне податкове планування нарахувань і сплат до бюджету. Використання легальної оптимізації податків дозволить уникнути безлічі проблем і негативних наслідків.</p>\n<p>Для того, щоб правильно використовувати методи мінімізації податків, слід орієнтуватися на такі пункти податкового планування, які дозволять скласти індивідуальні схеми оптимізації оподаткування. На російському ринку можна зустріти багато різних пропозицій про надання податкових послуг. Але більшість з них допомагають усунути тільки частина проблем, пов''язаних з податками. Тому необхідно звертатися до експертів, які комплексно підійдуть до вирішення даного завдання.</p>',
        64, '', '', 0, 1, 0, 'publish', 'Administrator', 1427887795, 1427887795, 1436776332, 4, 32, 121),
  (141, 'Головна річ, яка стоїть між вами та успіхом', '', 'glavnaia-veshch-kotoraia-stoit-mezhdu-vami-i-uspehom',
        'blog/ekonomika/', '', '',
        '<p>Щоб розпочати бізнес, потрібно зробити дуже багато дійсно важливих речей: дослідити ринок, знайти цільову аудиторію, визначити її потреби, розробити зрозумілий для них&nbsp;продукт, продумати маркетинг, порахувати бюджет.</p>',
        '<p><img src="/uploads/images/articles/chair-designer-desk-4928.jpg" alt="" width="900" height="460" /></p>\n<p>Мало хто був здатний настільки влучно формулювати великі думки, як Генрі Форд (Henry Ford), який помітив: &laquo;Чи вірите ви, що зможете, або вірите, що не зможете - ви праві&raquo;. Люди не пробують! Багато талановитих і подають надії бізнесмени на самому початку свого шляху не домагаються успіху, бо не вірять у свої сили і бояться ризикувати. Передумови можуть бути самі різні: Тривалі роздуми, після яких не залишається сил &laquo;натиснути на курок&raquo;, тобто почати діяти. Консервативні родичі, друзі або &laquo;порадники&raquo;, які бояться зробити це самі і &laquo;попереджають&raquo; інших. Занадто довга підготовка, яка не дає бажаного результату і дає перевагу тим, хто діє.</p>\n<p>Якщо у вас є ідея - реалізуйте її якомога швидше і з мінімальними грошовими вкладеннями. І спостерігайте за подіями. Можливо, ви зрозумієте, що на правильному шляху. У більшості випадків цей етап показує, що потрібно змінити і над чим попрацювати, щоб розвиватися в правильному напрямку. Це природно - і через це проходять всі. І навіть якщо у вас не вийшло - в цьому немає ніякої катастрофи, адже ви мінімізували свої витрати. Тому у вас ще повинно залишитися достатньо сил і засобів на нові спроби.</p>\n<p>Головна перешкода до вашого успіху - страх. Щоб домогтися успіху в новому бізнесі, не бійтеся йти на ризик. У баскетболістів і хокеїстів є вираз: &laquo;Ти промахується в 100% випадках, коли не поробиш&raquo;. Думаємо, воно найкраще передає зміст нашого сьогоднішнього матеріалу. Дійте!</p>',
        69, '', '', 0, 1, 0, 'publish', 'Administrator', 1426335738, 1426335738, 1436776661, 3, 32, 110);

-- --------------------------------------------------------

--
-- Структура таблицы `content_fields`
--

DROP TABLE IF EXISTS `content_fields`;
CREATE TABLE IF NOT EXISTS `content_fields` (
  `field_name` VARCHAR(255) NOT NULL,
  `type`       VARCHAR(255) NOT NULL,
  `label`      VARCHAR(255) NOT NULL,
  `data`       TEXT         NOT NULL,
  `weight`     INT(11)      NOT NULL,
  `in_search`  TINYINT(1) DEFAULT '0',
  PRIMARY KEY (`field_name`),
  UNIQUE KEY `field_name` (`field_name`),
  KEY `type` (`type`),
  KEY `in_search` (`in_search`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `content_fields`
--

INSERT INTO `content_fields` (`field_name`, `type`, `label`, `data`, `weight`, `in_search`) VALUES
  ('field_image', 'text', 'Изображение',
   'a:7:{s:5:"label";s:22:"Изображение";s:7:"initial";s:0:"";s:9:"help_text";s:0:"";s:4:"type";s:4:"text";s:20:"enable_image_browser";s:1:"1";s:10:"validation";s:0:"";s:6:"groups";a:4:{i:0;s:2:"-1";i:1;s:2:"11";i:2;s:2:"12";i:3;s:2:"13";}}',
   1, 0),
  ('field_url', 'text', 'URL-адрес',
   'a:5:{s:10:"field_name";s:3:"url";s:5:"label";s:14:"URL-адрес";s:4:"type";s:4:"text";s:6:"groups";a:2:{i:0;s:2:"11";i:1;s:2:"12";}s:4:"data";s:0:"";}',
   2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `content_fields_data`
--

DROP TABLE IF EXISTS `content_fields_data`;
CREATE TABLE IF NOT EXISTS `content_fields_data` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `item_id`    INT(11)      NOT NULL,
  `item_type`  VARCHAR(15)  NOT NULL,
  `field_name` VARCHAR(255) NOT NULL,
  `data`       TEXT         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `item_type` (`item_type`),
  KEY `field_name` (`field_name`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 89;

--
-- Дамп данных таблицы `content_fields_data`
--

INSERT INTO `content_fields_data` (`id`, `item_id`, `item_type`, `field_name`, `data`) VALUES
  (21, 92, 'page', 'field_image', '/uploads/images/clients/client_tmp1.png'),
  (22, 92, 'page', 'field_url', ''),
  (23, 93, 'page', 'field_image', '/uploads/images/clients/client_tmp2.png'),
  (24, 93, 'page', 'field_url', 'http://www.mysite.com'),
  (65, 74, 'category', 'field_url', ''),
  (64, 74, 'category', 'field_image', ''),
  (35, 90, 'page', 'field_image', '/uploads/images/articles/chair-designer-desk-3929.jpg'),
  (36, 90, 'page', 'field_url', ''),
  (67, 132, 'page', 'field_image', ''),
  (66, 130, 'page', 'field_image', '/uploads/images/articles/business-consulting.png'),
  (68, 123, 'page', 'field_image', ''),
  (69, 133, 'page', 'field_image', '/uploads/images/clients/client_tmp2.png'),
  (70, 133, 'page', 'field_url', 'http://www.mysite.com'),
  (47, 121, 'page', 'field_image', '/uploads/images/articles/woman-typing-writing-windows.jpg'),
  (48, 121, 'page', 'field_url', ''),
  (49, 84, 'page', 'field_image', '/uploads/images/articles/woman-typing-writing-windows.jpg'),
  (50, 85, 'page', 'field_image', '/uploads/images/articles/business-consulting.png'),
  (51, 86, 'page', 'field_image', ''),
  (52, 89, 'page', 'field_image', '/uploads/images/articles/chair-designer-desk-3927.jpg'),
  (53, 89, 'page', 'field_url', ''),
  (71, 134, 'page', 'field_image', '/uploads/images/clients/client_tmp1.png'),
  (72, 134, 'page', 'field_url', ''),
  (60, 110, 'page', 'field_image', '/uploads/images/articles/chair-designer-desk-3928.jpg'),
  (61, 110, 'page', 'field_url', ''),
  (62, 109, 'page', 'field_image', '/uploads/images/articles/chair-designer-desk-3926%20copy.jpg'),
  (63, 109, 'page', 'field_url', ''),
  (73, 124, 'page', 'field_image', '/uploads/images/articles/business-consulting.png'),
  (74, 138, 'page', 'field_image', ''),
  (75, 138, 'page', 'field_url', ''),
  (76, 87, 'page', 'field_image', ''),
  (77, 139, 'page', 'field_image', '/uploads/images/articles/chair-designer-desk-3926%20copy.jpg'),
  (78, 139, 'page', 'field_url', ''),
  (79, 140, 'page', 'field_image', '/uploads/images/articles/woman-typing-writing-windows.jpg'),
  (80, 140, 'page', 'field_url', ''),
  (81, 141, 'page', 'field_image', '/uploads/images/articles/chair-designer-desk-3928.jpg'),
  (82, 141, 'page', 'field_url', ''),
  (83, 136, 'page', 'field_image', '/uploads/images/articles/chair-designer-desk-3929.jpg'),
  (84, 136, 'page', 'field_url', ''),
  (85, 137, 'page', 'field_image', '/uploads/images/articles/chair-designer-desk-3927.jpg'),
  (86, 137, 'page', 'field_url', ''),
  (87, 126, 'page', 'field_image', '/uploads/images/articles/business-consulting.png'),
  (88, 129, 'page', 'field_image', '');

-- --------------------------------------------------------

--
-- Структура таблицы `content_fields_groups_relations`
--

DROP TABLE IF EXISTS `content_fields_groups_relations`;
CREATE TABLE IF NOT EXISTS `content_fields_groups_relations` (
  `field_name` VARCHAR(64) NOT NULL,
  `group_id`   INT(3)      NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Дамп данных таблицы `content_fields_groups_relations`
--

INSERT INTO `content_fields_groups_relations` (`field_name`, `group_id`) VALUES
  ('field_doc', 9),
  ('field_url', 11),
  ('field_url', 12),
  ('field_image', -1),
  ('field_image', 11),
  ('field_image', 12),
  ('field_image', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `content_field_groups`
--

DROP TABLE IF EXISTS `content_field_groups`;
CREATE TABLE IF NOT EXISTS `content_field_groups` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255) NOT NULL,
  `description` TEXT,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 14;

--
-- Дамп данных таблицы `content_field_groups`
--

INSERT INTO `content_field_groups` (`id`, `name`, `description`) VALUES
  (11, 'blog', 'Поля для категории новостей'),
  (12, 'reviews', 'Поля для категории отзывов пользователей'),
  (13, 'services', '');

-- --------------------------------------------------------

--
-- Структура таблицы `content_permissions`
--

DROP TABLE IF EXISTS `content_permissions`;
CREATE TABLE IF NOT EXISTS `content_permissions` (
  `id`      BIGINT(11) NOT NULL AUTO_INCREMENT,
  `page_id` BIGINT(11) NOT NULL,
  `data`    TEXT       NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 7;

-- --------------------------------------------------------

--
-- Структура таблицы `content_tags`
--

DROP TABLE IF EXISTS `content_tags`;
CREATE TABLE IF NOT EXISTS `content_tags` (
  `id`      INT(11) NOT NULL AUTO_INCREMENT,
  `page_id` INT(11) NOT NULL,
  `tag_id`  INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `tag_id` (`tag_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 373;

--
-- Дамп данных таблицы `content_tags`
--

INSERT INTO `content_tags` (`id`, `page_id`, `tag_id`) VALUES
  (344, 90, 38),
  (343, 90, 37),
  (342, 90, 36),
  (350, 121, 31),
  (349, 121, 30),
  (347, 89, 31),
  (346, 89, 30),
  (345, 89, 33),
  (209, 138, 34),
  (210, 138, 35),
  (348, 121, 33),
  (341, 110, 31),
  (340, 110, 30),
  (339, 110, 33),
  (335, 109, 31),
  (334, 109, 30),
  (333, 109, 33),
  (351, 139, 33),
  (352, 139, 34),
  (353, 139, 35),
  (362, 140, 35),
  (361, 140, 34),
  (360, 140, 33),
  (368, 141, 35),
  (367, 141, 34),
  (366, 141, 33),
  (369, 136, 39),
  (370, 137, 34),
  (371, 137, 35),
  (372, 137, 33);

-- --------------------------------------------------------

--
-- Структура таблицы `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id`            INT(11)     NOT NULL AUTO_INCREMENT,
  `field_type_id` INT(11)     NOT NULL,
  `field_name`    VARCHAR(64) NOT NULL,
  `is_required`   TINYINT(1)  NOT NULL DEFAULT '1',
  `is_active`     TINYINT(1)  NOT NULL DEFAULT '1',
  `is_private`    TINYINT(1)  NOT NULL DEFAULT '0',
  `validators`    VARCHAR(255)         DEFAULT NULL,
  `entity`        VARCHAR(32)          DEFAULT NULL,
  `options`       VARCHAR(65)          DEFAULT NULL,
  `classes`       TEXT,
  `position`      TINYINT(4)           DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 96;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_fields_data`
--

DROP TABLE IF EXISTS `custom_fields_data`;
CREATE TABLE IF NOT EXISTS `custom_fields_data` (
  `id`         INT(11)    NOT NULL AUTO_INCREMENT,
  `field_id`   INT(11)    NOT NULL,
  `entity_id`  INT(11)    NOT NULL,
  `field_data` TEXT,
  `locale`     VARCHAR(4) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 514;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_fields_i18n`
--

DROP TABLE IF EXISTS `custom_fields_i18n`;
CREATE TABLE IF NOT EXISTS `custom_fields_i18n` (
  `id`                INT(11)    NOT NULL,
  `locale`            VARCHAR(4) NOT NULL,
  `field_label`       VARCHAR(255) DEFAULT NULL,
  `field_description` TEXT,
  `possible_values`   TEXT,
  PRIMARY KEY (`id`, `locale`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_albums`
--

DROP TABLE IF EXISTS `gallery_albums`;
CREATE TABLE IF NOT EXISTS `gallery_albums` (
  `id`          INT(11)     NOT NULL AUTO_INCREMENT,
  `category_id` INT(11)              DEFAULT NULL,
  `name`        VARCHAR(250)         DEFAULT NULL,
  `description` VARCHAR(500)         DEFAULT NULL,
  `cover_id`    INT(11)              DEFAULT '0',
  `position`    INT(9)               DEFAULT '0',
  `created`     INT(11)              DEFAULT NULL,
  `updated`     INT(11)              DEFAULT NULL,
  `tpl_file`    VARCHAR(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `created` (`created`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 12;

--
-- Дамп данных таблицы `gallery_albums`
--

INSERT INTO `gallery_albums` (`id`, `category_id`, `name`, `description`, `cover_id`, `position`, `created`, `updated`, `tpl_file`)
VALUES
  (5, 6, NULL, NULL, 163, 0, 1428422810, 1436514341, ''),
  (6, 6, NULL, NULL, 165, 1, 1428422886, 1436516014, ''),
  (7, 7, NULL, NULL, 154, 0, 1428423364, 1436513465, ''),
  (8, 7, NULL, NULL, 158, 3, 1428423407, 1436513812, ''),
  (10, 7, NULL, NULL, 162, 1, 1436513897, 1436513927, ''),
  (11, 7, NULL, NULL, 169, 2, 1436516700, 1436516924, '');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_albums_i18n`
--

DROP TABLE IF EXISTS `gallery_albums_i18n`;
CREATE TABLE IF NOT EXISTS `gallery_albums_i18n` (
  `id`          INT(11)      NOT NULL,
  `locale`      VARCHAR(5)   NOT NULL,
  `description` TEXT         NOT NULL,
  `name`        VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`, `locale`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `gallery_albums_i18n`
--

INSERT INTO `gallery_albums_i18n` (`id`, `locale`, `description`, `name`) VALUES
  (5, 'ru',
   '<p><span>Горы &ndash; территория тренировки на результат и успех. Горы - отличный повод отказаться от лени и неработающих разговоров. Здесь, как никогда, видно, что в команде зачет по последнему.&nbsp;</span></p>',
   'Путешествие в горы'),
  (6, 'ru', '<p>Озеро Атитлан является одной из визитных карточек Гватемалы, притягивающем в эту страну любителей медиативного отдыха, завораживающих видов и культуры коренных народов Центральной Америки.</p>', 'Озеро Атитлан'),
  (11, 'ru', '<p>Несколько фотографий путешествия наших сотрудников вокруг света</p>', 'Вокруг света'),
  (5, 'uk', '<p>Гори - територія тренування на результат і успіх. Гори - відмінний привід відмовитися від ліні і непрацюючих розмов. Тут, як ніколи, видно, що в команді залік за останнім.</p>', 'Подорож у гори'),
  (7, 'ru', '<p>Впервые мы представляем новую технологию ведения и управления бизнеса</p>', 'Презентация проекта'),
  (8, 'ru', '<p>Бизнес-проект для компании по организации&nbsp;технологического менеджмента</p>', 'Бизнес-проект'),
  (10, 'ru', '<p>Разработка стратегии для маркетинговой компании</p>', 'Предложение по маркетингу'),
  (6, 'uk', '<p>Озеро Атитлан є однією з візитних карток Гватемали, притягує в цю країну любителів медіативного відпочинку, що зачаровуються видами і культурою корінних народів Центральної Америки.</p>', 'Озеро Атитлан'),
  (7, 'uk', '<p>Вперше ми представляємо нову технологію ведення та управління бізнесу</p>', 'Презентація проекту'),
  (10, 'uk', '<p>Розробка стратегії для маркетингової компанії</p>', 'Пропозиція по маркетингу'),
  (11, 'uk', '<p>Кілька фотографій подорожі наших співробітників навколо світу</p>', 'Навколо світу'),
  (8, 'uk', '<p>Бізнес-проект для компанії з організації технологічного менеджменту</p>', 'Бізнес-проект');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_category`
--

DROP TABLE IF EXISTS `gallery_category`;
CREATE TABLE IF NOT EXISTS `gallery_category` (
  `id`          INT(11) NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(250)     DEFAULT NULL,
  `description` VARCHAR(500)     DEFAULT NULL,
  `cover_id`    INT(11)          DEFAULT '0',
  `position`    INT(9)           DEFAULT '0',
  `created`     INT(11)          DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created` (`created`),
  KEY `position` (`position`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 8;

--
-- Дамп данных таблицы `gallery_category`
--

INSERT INTO `gallery_category` (`id`, `name`, `description`, `cover_id`, `position`, `created`) VALUES
  (6, NULL, NULL, 0, 0, 1428422691),
  (7, NULL, NULL, 0, 0, 1428423332);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_category_i18n`
--

DROP TABLE IF EXISTS `gallery_category_i18n`;
CREATE TABLE IF NOT EXISTS `gallery_category_i18n` (
  `id`          INT(11)    NOT NULL,
  `locale`      VARCHAR(5) NOT NULL,
  `description` TEXT,
  `name`        VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`, `locale`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `gallery_category_i18n`
--

INSERT INTO `gallery_category_i18n` (`id`, `locale`, `description`, `name`) VALUES
  (6, 'ru',
   '<p>Мы дружная команда профессионалов, которая умеет не только качественно работать, но и отдыхать! Ведь хороший отдых &mdash; залог успешной работы. А хороший отдых всегда должен быть активным.</p>',
   'Наша компания'),
  (7, 'ru',
   '<p>Предлагаем просмотреть фотографии с наших последних презентаций,&nbsp;которые мы проводим для наших клиентов на всемирно&nbsp;известных форумах и выставках.&nbsp;Работа с иностранными заказчики помогает нам набраться еще большего опыта, исследовать разные ситуации в разных странах, что в целом повышает квалификацию нашей компании.</p>',
   'Презентации'),
  (6, 'uk',
   '<p>Ми дружна команда професіоналів, яка вміє не тільки якісно працювати, а й відпочивати! Адже хороший відпочинок - запорука успішної роботи. А хороший відпочинок завжди повинен бути активним.</p>',
   'Наша компанія'),
  (7, 'uk',
   '<p>Пропонуємо переглянути фотографії з наших останніх презентацій, які ми проводимо для наших клієнтів на всесвітньо відомих форумах і виставках. Робота з іноземними замовники допомагає нам набратися ще більшого досвіду, досліджувати різні ситуації в різних країнах, що в цілому підвищує кваліфікацію нашої компанії.</p>',
   'Презентації');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id`          INT(11) NOT NULL AUTO_INCREMENT,
  `album_id`    INT(11)          DEFAULT NULL,
  `file_name`   VARCHAR(150)     DEFAULT NULL,
  `file_ext`    VARCHAR(8)       DEFAULT NULL,
  `file_size`   VARCHAR(20)      DEFAULT NULL,
  `position`    INT(9)           DEFAULT NULL,
  `width`       INT(6)           DEFAULT NULL,
  `height`      INT(6)           DEFAULT NULL,
  `description` VARCHAR(500)     DEFAULT NULL,
  `uploaded`    INT(11)          DEFAULT NULL,
  `views`       INT(11)          DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  KEY `position` (`position`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 171;

--
-- Дамп данных таблицы `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `album_id`, `file_name`, `file_ext`, `file_size`, `position`, `width`, `height`, `description`, `uploaded`, `views`)
VALUES
  (149, 7, '871fbac6a42c05f5a22f8b913f349f3f', '.jpeg', '881.8 kilobyte_abbr', 1, 2507, 1674, NULL, 1433857897, 78),
  (148, 6, '6f5762bcb3eda6a70c610a01a801b12f', '.jpeg', '450.7 kilobyte_abbr', 18, 2509, 1673, NULL, 1433857872, 0),
  (166, 11, '3be099ecbc48c3a92597f836f46d98ef', '.jpg', '919.4 kilobyte_abbr', 36, 2580, 1716, NULL, 1436516920, 12),
  (146, 6, 'f5d7d797b41b1409cdd3791fcbadb64e', '.jpeg', '881.8 kilobyte_abbr', 16, 2507, 1674, NULL, 1433857862, 0),
  (152, 6, '2b004f8bc4195d7e03d3da3ace4ee5cf', '.jpeg', '5.9 megabyte_abbr', 22, 4000, 2667, NULL, 1436439453, 0),
  (165, 6, '780549bdad49cf6e670acdc72d20aca9', '.jpg', '216.2 kilobyte_abbr', 35, 900, 600, NULL, 1436516014, 0),
  (137, 5, '38af37da7a648eb9ed771d777bfcf07d', '.jpg', '919.4 kilobyte_abbr', 3, 2580, 1716, NULL, 1432914498, 3),
  (138, 5, '05a672cf0fee47d300dba63eb0ce2ff7', '.jpg', '3.6 megabyte_abbr', 5, 5472, 3648, NULL, 1432914505, 0),
  (164, 6, '4adfe6586bf5112b4c1ea780f7619c62', '.jpg', '421.5 kilobyte_abbr', 34, 900, 600, NULL, 1436516014, 0),
  (163, 5, '6959cb6d4fb1df64e9db8c2b0794f18b', '.jpg', '142.3 kilobyte_abbr', 33, 900, 600, NULL, 1436514341, 0),
  (141, 5, 'd994f7108b8b4fcf899be3cde29266c2', '.jpeg', '450.7 kilobyte_abbr', 11, 2509, 1673, NULL, 1432914517, 0),
  (167, 11, '05420a1b196e16d21b19266def9825d7', '.jpg', '3.6 megabyte_abbr', 37, 5472, 3648, NULL, 1436516923, 0),
  (143, 6, '0e153a7bbdea2f3df7c890c69aba27ce', '.jpg', '919.4 kilobyte_abbr', 13, 2580, 1716, NULL, 1433857849, 4),
  (144, 6, 'c13ea30e08e26f9a696446fe6e3a1f0c', '.jpg', '3.6 megabyte_abbr', 14, 5472, 3648, NULL, 1433857855, 0),
  (150, 7, '30526e4305ae53ac3b330cf09510ffa5', '.jpg', '12.1 megabyte_abbr', 3, 5616, 3744, NULL, 1433857905, 0),
  (151, 7, '0796b80c02543659bd6b9dede9aa9515', '.jpeg', '450.7 kilobyte_abbr', 5, 2509, 1673, NULL, 1433857907, 0),
  (153, 6, '9e8270a52a13050b725165739ae43d84', '.jpg', '3.3 megabyte_abbr', 23, 4000, 2667, NULL, 1436439662, 0),
  (154, 7, '427cf6eb12e903d30d43b418dec3bf67', '.jpg', '352.1 kilobyte_abbr', 24, 900, 600, NULL, 1436513465, 0),
  (155, 8, 'b10f60899afddf7db7318fff156c2705', '.jpg', '472.8 kilobyte_abbr', 25, 900, 600, NULL, 1436513811, 8),
  (156, 8, 'd9201888c54090fd24c8be1a7f5dc181', '.jpg', '367.4 kilobyte_abbr', 26, 900, 600, NULL, 1436513811, 0),
  (157, 8, 'bf8dab48331e368d80fc17d6e0e072a7', '.jpg', '333.8 kilobyte_abbr', 27, 900, 600, NULL, 1436513812, 0),
  (158, 8, '865eba768a9642497808309b22d615f8', '.jpg', '398.6 kilobyte_abbr', 28, 900, 600, NULL, 1436513812, 0),
  (159, 10, '920bda68d067982dbc958e3594c371c7', '.jpg', '333.8 kilobyte_abbr', 29, 900, 600, NULL, 1436513924, 9),
  (160, 10, 'a694befe10283ed38bcc3edac546cded', '.jpg', '12.1 megabyte_abbr', 30, 5616, 3744, NULL, 1436513927, 0),
  (161, 10, '79718f31bb96f751a95455adf894f22c', '.jpg', '280.2 kilobyte_abbr', 31, 900, 600, NULL, 1436513927, 0),
  (162, 10, '0d9f970309fb252acbf6d2baed31b94e', '.jpg', '336.0 kilobyte_abbr', 32, 900, 600, NULL, 1436513927, 0),
  (168, 11, '3dca83c68ff7f8006ce866631eb5a857', '.jpg', '142.3 kilobyte_abbr', 38, 900, 600, NULL, 1436516923, 0),
  (169, 11, 'f3351562c25a58a7616e1a866af13f08', '.jpg', '421.5 kilobyte_abbr', 39, 900, 600, NULL, 1436516923, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_images_i18n`
--

DROP TABLE IF EXISTS `gallery_images_i18n`;
CREATE TABLE IF NOT EXISTS `gallery_images_i18n` (
  `id`          INT(11)    NOT NULL,
  `locale`      VARCHAR(5) NOT NULL,
  `description` TEXT,
  `title`       VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`, `locale`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `gallery_images_i18n`
--

INSERT INTO `gallery_images_i18n` (`id`, `locale`, `description`, `title`) VALUES
  (94, 'ru', 'Kepler 64 by Dirk Terrell, Boulder, CO', ''),
  (95, 'ru', '<p>Starship arriving to Gliese 667C, by L. Nubian, NY, NY</p>', NULL),
  (96, 'ru', '<p>3,000 light years, by Kilo Mora, Atlanta, GA</p>', NULL),
  (97, 'ru', '<p>Kepler 64 Moon by D. Terrell, Boulder, CO</p>', NULL),
  (98, 'ru', '<p>Pale Blue Dots by K. Mora, Atlanta, GA</p>', NULL),
  (99, 'ru', '<p>Edge of Existence by L. Nendza, Leesburg, FL</p>', ''),
  (102, 'ru', '<p>This image from NASA''s Kepler mission shows the telescope''s full field of view -- an expansive star-rich patch of sky in the constellations Cygnus and Lyra stretching across 100 square degrees, or the equivalent of two side-by-side dips of the Big Dipper.</p>', ''),
  (103, 'ru', '<p>Inverted image (dark stars on light sky) Stars in the image are all brighter than magnitude 18.5. Stars brighter than 11.5 are "saturated" (all look the same brightness in the image).</p>', NULL),
  (104, 'ru', '<p>This image from NASA''s Kepler mission shows the telescope''s full field of view -- an expansive star-rich patch of sky in the constellations Cygnus and Lyra stretching across 100 square degrees, or the equivalent of two side-by-side dips of the Big Dipper.</p>', NULL),
  (105, 'ru', '<p>A single Kepler science module with two CCDs and a single field flattening lens mounted onto an Invar carrier. Each of the 21 CCD science modules are covered with lenses of sapphire.</p>', NULL),
  (106, 'ru', '<p>The Kepler focal plane is approximately one foot square. It''s composed of 25 individually mounted modules. The four corner modules are used for fine guiding and the other 21 modules are used for science observing.</p>\n<p>Note that the four fine guidance modules in the corners of the focal plane are much smaller CCDs than the science modules. Each module and its electronics convert light into digital numbers that is analyzed for planet transits.</p>', ''),
  (107, 'ru', '', ''),
  (108, 'ru', '', ''),
  (119, 'ru', '', ''),
  (120, 'ru', '', ''),
  (121, 'ru', '', ''),
  (122, 'ru', '', ''),
  (123, 'ru', '', ''),
  (124, 'ru', '', ''),
  (125, 'ru', '', ''),
  (126, 'ru', '', ''),
  (127, 'ru', '', ''),
  (128, 'ru', '', ''),
  (129, 'ru', '', ''),
  (130, 'ru', '', ''),
  (131, 'ru', '', ''),
  (132, 'ru', '', ''),
  (133, 'ru', '', ''),
  (134, 'ru', '', ''),
  (135, 'ru', '', ''),
  (137, 'ru', '', ''),
  (138, 'ru', '', ''),
  (141, 'ru', '', ''),
  (150, 'ru', '', ''),
  (154, 'ru', '', ''),
  (158, 'ru', '', ''),
  (162, 'ru', '', ''),
  (163, 'ru', '', ''),
  (165, 'ru', '', ''),
  (169, 'ru', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id`        INT(11)      NOT NULL AUTO_INCREMENT,
  `lang_name` VARCHAR(100) NOT NULL,
  `identif`   VARCHAR(10)  NOT NULL,
  `image`     TEXT         NOT NULL,
  `folder`    VARCHAR(100) NOT NULL,
  `template`  VARCHAR(100) NOT NULL,
  `default`   INT(1)       NOT NULL,
  `locale`    VARCHAR(100) NOT NULL,
  `active`    TINYINT(1)            DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `identif` (`identif`),
  KEY `default` (`default`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 34;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `identif`, `image`, `folder`, `template`, `default`, `locale`, `active`)
VALUES
  (3, 'Rus', 'ru', '/uploads/images/flags/Russia.png', 'russian', '0', 1, 'ru_RU', 1),
  (32, 'Ukr', 'uk', '/uploads/images/flags/Ukraine.png', '', '0', 0, 'uk_UA', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id`         INT(11)     NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(40) NOT NULL,
  `time`       TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip_address` (`ip_address`),
  KEY `time` (`time`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 84;

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id`       INT(11)      NOT NULL AUTO_INCREMENT,
  `user_id`  INT(11)      NOT NULL,
  `username` VARCHAR(255) NOT NULL,
  `message`  TEXT         NOT NULL,
  `date`     INT(11)      NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 2373;

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `id`    INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255)     DEFAULT NULL,
  `date`  INT(15)          DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id`           INT(11)      NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(250) NOT NULL,
  `main_title`   VARCHAR(300) NOT NULL,
  `tpl`          VARCHAR(255)          DEFAULT NULL,
  `expand_level` INT(255)              DEFAULT NULL,
  `description`  TEXT,
  `created`      VARCHAR(50)  NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 8;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `name`, `main_title`, `tpl`, `expand_level`, `description`, `created`) VALUES
  (1, 'main_menu', 'Главное меню', 'menus/main_menu', 4, '', '2015-07-01 19:58:17'),
  (7, 'footer_menu', 'Меню в подвале', 'menus/footer_menu', 0, '', '2015-06-02 15:07:58');

-- --------------------------------------------------------

--
-- Структура таблицы `menus_data`
--

DROP TABLE IF EXISTS `menus_data`;
CREATE TABLE IF NOT EXISTS `menus_data` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `menu_id`     INT(9)       NOT NULL,
  `item_id`     INT(9)       NOT NULL,
  `item_type`   VARCHAR(15)  NOT NULL,
  `item_image`  VARCHAR(255) NOT NULL,
  `roles`       TEXT,
  `hidden`      SMALLINT(1)  NOT NULL DEFAULT '0',
  `title`       VARCHAR(300) NOT NULL,
  `parent_id`   INT(9)       NOT NULL,
  `position`    SMALLINT(5)           DEFAULT NULL,
  `description` TEXT,
  `add_data`    TEXT,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `position` (`position`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 67;

--
-- Дамп данных таблицы `menus_data`
--

INSERT INTO `menus_data` (`id`, `menu_id`, `item_id`, `item_type`, `item_image`, `roles`, `hidden`, `title`, `parent_id`, `position`, `description`, `add_data`)
VALUES
  (59, 1, 62, 'category', '', '', 0, 'Услуги', 0, 2, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (52, 1, 64, 'category', '', '', 0, 'Блог', 0, 8, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (66, 1, 66, 'category', '', '', 0, 'Клиенты о нас', 0, 6, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (53, 1, 87, 'page', '', '', 0, 'Контакты', 0, 9, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (38, 1, 0, 'module', '', '', 0, 'Галерея', 0, 7, NULL, 'a:3:{s:8:"mod_name";s:7:"gallery";s:6:"method";s:0:"";s:7:"newpage";i:0;}'),
  (42, 7, 86, 'page', '', '', 0, 'Услуги адвоката', 0, 1, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (43, 7, 85, 'page', '', '', 0, 'Налоговые консультации', 0, 2, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (44, 7, 84, 'page', '', '', 0, 'Бизнес-консалтинг', 0, 3, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (45, 7, 64, 'category', '', '', 0, 'Блог', 0, 4, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (46, 7, 0, 'module', '', '', 0, 'Галерея', 0, 5, NULL, 'a:3:{s:8:"mod_name";s:7:"gallery";s:6:"method";s:0:"";s:7:"newpage";i:0;}'),
  (47, 1, 124, 'page', '', '', 0, 'Про компанию', 0, 1, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (60, 1, 86, 'page', '', '', 0, 'Услуги адвоката', 59, 3, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (61, 1, 85, 'page', '', '', 0, 'Налоговые консультации', 59, 4, NULL, 'a:1:{s:7:"newpage";i:0;}'),
  (62, 1, 84, 'page', '', '', 0, 'Бизнес-консалтинг', 59, 5, NULL, 'a:1:{s:7:"newpage";i:0;}');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_translate`
--

DROP TABLE IF EXISTS `menu_translate`;
CREATE TABLE IF NOT EXISTS `menu_translate` (
  `id`      INT(11)      NOT NULL AUTO_INCREMENT,
  `item_id` INT(11)      NOT NULL,
  `lang_id` INT(11)      NOT NULL,
  `title`   VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `lang_id` (`lang_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 47;

--
-- Дамп данных таблицы `menu_translate`
--

INSERT INTO `menu_translate` (`id`, `item_id`, `lang_id`, `title`) VALUES
  (34, 42, 3, 'Услуги адвоката'),
  (36, 43, 3, 'Налоговые консультации'),
  (38, 44, 3, 'Бизнес-консалтинг'),
  (40, 45, 3, 'Блог'),
  (5, 46, 3, 'Галерея'),
  (25, 47, 3, 'Про компанию'),
  (7, 48, 3, 'Разработка предложений'),
  (8, 49, 3, 'Услуги по дому'),
  (9, 50, 3, 'Сфера услуг'),
  (10, 51, 3, 'Бизнес-консалтинг'),
  (11, 52, 3, 'Блог'),
  (32, 53, 3, 'Контакты'),
  (13, 54, 3, 'Разработка предложений'),
  (14, 55, 3, 'Экономическая деятельность'),
  (15, 56, 3, 'Услуги по дому'),
  (16, 57, 3, 'Особняки'),
  (17, 58, 3, 'Услуги по работе'),
  (27, 59, 3, 'Услуги'),
  (45, 60, 3, 'Услуги адвоката'),
  (43, 61, 3, 'Налоговые консультации'),
  (41, 62, 3, 'Бизнес-консалтинг'),
  (22, 63, 3, 'Про компанию'),
  (23, 64, 3, 'Контакты'),
  (24, 65, 3, 'Видео'),
  (26, 47, 32, 'Про компанію'),
  (28, 59, 32, 'Послуги'),
  (30, 66, 3, 'Клиенты о нас'),
  (31, 66, 32, 'Клієнти про нас'),
  (33, 53, 32, 'Контакти'),
  (35, 42, 32, 'Послуги адвоката'),
  (37, 43, 32, 'Податкові консультації'),
  (39, 44, 32, 'Бізнес-консалтинг'),
  (42, 62, 32, 'Бізнес-консалтинг'),
  (44, 61, 32, 'Податкові консультації'),
  (46, 60, 32, 'Послуги адвоката');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_banner`
--

DROP TABLE IF EXISTS `mod_banner`;
CREATE TABLE IF NOT EXISTS `mod_banner` (
  `id`         INT(11)    NOT NULL AUTO_INCREMENT,
  `active`     TINYINT(4) NOT NULL,
  `active_to`  INT(11)             DEFAULT NULL,
  `where_show` TEXT,
  `group`      TEXT,
  `position`   INT(11)    NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 27;

--
-- Дамп данных таблицы `mod_banner`
--

INSERT INTO `mod_banner` (`id`, `active`, `active_to`, `where_show`, `group`, `position`) VALUES
  (24, 1, -1, 'a:0:{}', 'a:1:{i:0;s:9:"dashboard";}', 0),
  (25, 1, -1, 'a:0:{}', 'a:1:{i:0;s:9:"dashboard";}', 1),
  (26, 1, -1, 'a:0:{}', 'a:1:{i:0;s:9:"dashboard";}', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_banner_groups`
--

DROP TABLE IF EXISTS `mod_banner_groups`;
CREATE TABLE IF NOT EXISTS `mod_banner_groups` (
  `id`   INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255)     DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 2;

--
-- Дамп данных таблицы `mod_banner_groups`
--

INSERT INTO `mod_banner_groups` (`id`, `name`) VALUES
  (1, 'dashboard');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_banner_i18n`
--

DROP TABLE IF EXISTS `mod_banner_i18n`;
CREATE TABLE IF NOT EXISTS `mod_banner_i18n` (
  `id`          INT(11)    NOT NULL,
  `url`         TEXT,
  `locale`      VARCHAR(5) NOT NULL,
  `name`        VARCHAR(25)  DEFAULT NULL,
  `description` TEXT,
  `photo`       VARCHAR(255) DEFAULT NULL,
  KEY `id` (`id`, `locale`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `mod_banner_i18n`
--

INSERT INTO `mod_banner_i18n` (`id`, `url`, `locale`, `name`, `description`, `photo`) VALUES
  (24, 'uslugi', 'ru', 'Управленческий консалтинг',
   '<p>Деятельность, направленная на повышение эффективности фирм, компаний, организаций. В процессе управленческого консалтинга может решаться самый широкий круг задач.</p>',
   'fa-diamond'),
  (25, '', 'ru', 'Экологический консалтинг',
   '<p>Комплекс работ, связанных с экологическим обеспечением деятельности строительных и проектных организаций, предприятий всех отраслей деятельности.</p>',
   'fa-bicycle'),
  (26, '', 'ru', 'ИТ-консалтинг',
   '<p>Проектно-ориентированная деятельность, связанная с информационной поддержкой бизнес-процессов, позволяющая дать независимую экспертную оценку.</p>',
   'fa-file-text-o'),
  (24, '', 'uk', 'Управлінський консалтинг',
   '<p>Діяльність, спрямована на підвищення ефективності фірм, компаній, організацій. У процесі управлінського консалтингу може вирішуватися найширше коло завдань.</p>',
   'fa-diamond'),
  (25, '', 'uk', 'Екологічний консалтинг',
   '<p>Комплекс робіт, пов''язаних з екологічним забезпеченням діяльності будівельних і проектних організацій, підприємств всіх галузей діяльності.</p>',
   'fa-bicycle'),
  (26, '', 'uk', 'ІТ-консалтинг',
   '<p>Проектно-орієнтована діяльність, пов''язана з інформаційною підтримкою бізнес-процесів, що дозволяє дати незалежну експертну оцінку.</p>',
   'fa-file-text-o');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_email_paterns`
--

DROP TABLE IF EXISTS `mod_email_paterns`;
CREATE TABLE IF NOT EXISTS `mod_email_paterns` (
  `id`                   INT(11)               NOT NULL AUTO_INCREMENT,
  `name`                 VARCHAR(256)          NOT NULL,
  `patern`               TEXT,
  `from`                 VARCHAR(256)          NOT NULL,
  `from_email`           VARCHAR(256)          NOT NULL,
  `admin_email`          VARCHAR(256)          NOT NULL,
  `type`                 ENUM ('HTML', 'Text') NOT NULL DEFAULT 'HTML',
  `user_message_active`  TINYINT(1)            NOT NULL,
  `admin_message_active` TINYINT(1)            NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 7;

--
-- Дамп данных таблицы `mod_email_paterns`
--

INSERT INTO `mod_email_paterns` (`id`, `name`, `patern`, `from`, `from_email`, `admin_email`, `type`, `user_message_active`, `admin_message_active`)
VALUES
  (4, 'create_user', '', 'Admin', 'no-replay@mysite.com', '', 'HTML', 1, 1),
  (5, 'forgot_password', '', 'Администрация сайта', 'no-replay@mysite.com', '', 'HTML', 1, 0),
  (6, 'change_password', '', 'Администрация сайта', 'no-replay@mysite.com', '', 'HTML', 1, 0),
  (7, 'feedback', '', '', '', '', 'HTML', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `mod_email_paterns_i18n`
--

DROP TABLE IF EXISTS `mod_email_paterns_i18n`;
CREATE TABLE IF NOT EXISTS `mod_email_paterns_i18n` (
  `id`            INT(11)      NOT NULL,
  `locale`        VARCHAR(5)   NOT NULL,
  `theme`         VARCHAR(256) NOT NULL,
  `user_message`  TEXT         NOT NULL,
  `admin_message` TEXT         NOT NULL,
  `description`   TEXT         NOT NULL,
  `variables`     TEXT         NOT NULL,
  PRIMARY KEY (`id`, `locale`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `mod_email_paterns_i18n`
--

INSERT INTO `mod_email_paterns_i18n` (`id`, `locale`, `theme`, `user_message`, `admin_message`, `description`, `variables`)
VALUES
  (4, 'ru', 'Создание пользователя',
   '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $user_name$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Поздравляем! Ваша регистрация прошла успешно.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Данные для входа в магазин:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$user_email$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Пароль: </span>$user_password$</div>',
   '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">На сайте был зарегистрирован новый пользователь.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;">Данные пользователя:</p>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Имя: </span>$user_name$</div>\n<div style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;">Email адрес: </span>$user_email$</div>',
   '<p>Шаблон письма на создание пользователя</p>',
   'a:5:{s:11:"$user_name$";s:31:"Имя пользователя";s:15:"$user_password$";s:12:"Пароль";s:14:"$user_address$";s:12:"Адресс";s:12:"$user_email$";s:5:"Email";s:12:"$user_phone$";s:14:"Телефон";}'),
  (5, 'ru', 'Восстановление пароля',
   '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">На сайте $webSiteName$ создан запрос на восстановление пароля для Вашего аккаунта.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Для завершения процедуры восстановления пароля перейдите по ссылке $resetPasswordUri$</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">После перехода по ссылке Ваш новый пароль для входа будет: $password$</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Если это письмо попало к Вам по ошибке просто проигнорируйте его</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">С уважением, сотрудники службы продаж $webSiteName$</p>',
   '', '<p>Шаблон письма на восстановление пароля</p>',
   'a:5:{s:13:"$webSiteName$";s:17:"Имя сайта";s:18:"$resetPasswordUri$";s:59:"Ссылка на восстановления пароля";s:10:"$password$";s:12:"Пароль";s:5:"$key$";s:8:"Ключ";s:16:"$webMasterEmail$";s:54:"Email сотрудников службы продаж";}'),
  (6, 'ru', 'Смена пароля',
   '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте $user_name$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Ваш пароль был успешно восстановлен.</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Новый пароль: $password$</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Если это письмо попало к Вам по ошибке просто проигнорируйте его.</p>',
   '', '<p>Шаблон письма изменения пароля</p>',
   'a:2:{s:11:"$user_name$";s:31:"Имя пользователя";s:10:"$password$";s:23:"новый пароль";}'),
  (7, 'ru', 'Обратная связь',
   '<p style="font-family: arial; font-size: 13px; margin-top: 10px;" data-mce-style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!<br>Вы заказали консультацию в нашей компании, мы свяжемся с Вами в ближайшее время</p>',
   '<p style="font-family: arial; font-size: 13px; margin-top: 10px;" data-mce-style="font-family: arial; font-size: 13px; margin-top: 10px;">Новий запрос Обратной связи от $userName$</p><p style="font-family: arial; font-size: 13px; margin-top: 10px;" data-mce-style="font-family: arial; font-size: 13px; margin-top: 10px;"><span data-mce-style="color: #666;" style="color: #666;">Тема: </span>$Theme$<br></p><div style="font-family: arial; font-size: 13px; margin-top: 10px;" data-mce-style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;" data-mce-style="color: #666;">Email: </span>$userEmail$</div><div style="font-family: arial; font-size: 13px; margin-top: 10px;" data-mce-style="font-family: arial; font-size: 13px; margin-top: 10px;"><span style="color: #666;" data-mce-style="color: #666;">Сообщение: </span>$userMessage$</div><p><span><br></span></p>',
   '<p>шаблон заказа обратной связи</p>',
   'a:4:{s:10:"$userName$";s:31:"Имя пользователя";s:7:"$Theme$";s:27:"тема сообщения";s:11:"$userEmail$";s:30:"Email пользователя";s:13:"$userMessage$";s:29:"Сообщение юзера";}');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_sample_settings`
--

DROP TABLE IF EXISTS `mod_sample_settings`;
CREATE TABLE IF NOT EXISTS `mod_sample_settings` (
  `id`    INT(11)      NOT NULL AUTO_INCREMENT,
  `name`  VARCHAR(50)  NOT NULL,
  `value` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 4;

--
-- Дамп данных таблицы `mod_sample_settings`
--

INSERT INTO `mod_sample_settings` (`id`, `name`, `value`) VALUES
  (1, 'mailTo', 'admin@site.com'),
  (2, 'useEmailNotification', 'TRUE'),
  (3, 'key', 'UUUsssTTTeee');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id`      INT(11) NOT NULL AUTO_INCREMENT,
  `role_id` INT(11) NOT NULL,
  `data`    TEXT,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 5;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `data`) VALUES
  (1, 10,
   'a:36:{s:9:"cp_access";s:1:"1";s:13:"cp_autoupdate";s:1:"1";s:14:"cp_page_search";s:1:"1";s:11:"lang_create";s:1:"1";s:9:"lang_edit";s:1:"1";s:11:"lang_delete";s:1:"1";s:16:"cp_site_settings";s:1:"1";s:11:"cache_clear";s:1:"1";s:11:"page_create";s:1:"1";s:9:"page_edit";s:1:"1";s:11:"page_delete";s:1:"1";s:15:"category_create";s:1:"1";s:13:"category_edit";s:1:"1";s:15:"category_delete";s:1:"1";s:14:"module_install";s:1:"1";s:16:"module_deinstall";s:1:"1";s:12:"module_admin";s:1:"1";s:13:"widget_create";s:1:"1";s:13:"widget_delete";s:1:"1";s:22:"widget_access_settings";s:1:"1";s:11:"menu_create";s:1:"1";s:9:"menu_edit";s:1:"1";s:11:"menu_delete";s:1:"1";s:11:"user_create";s:1:"1";s:21:"user_create_all_roles";s:1:"1";s:9:"user_edit";s:1:"1";s:11:"user_delete";s:1:"1";s:14:"user_view_data";s:1:"1";s:14:"xfields_create";s:1:"1";s:14:"xfields_delete";s:1:"1";s:12:"xfields_edit";s:1:"1";s:12:"roles_create";s:1:"1";s:10:"roles_edit";s:1:"1";s:12:"roles_delete";s:1:"1";s:9:"logs_view";s:1:"1";s:13:"backup_\ncreate";s:1:"1";}');

-- --------------------------------------------------------

--
-- Структура таблицы `propel_migration`
--

DROP TABLE IF EXISTS `propel_migration`;
CREATE TABLE IF NOT EXISTS `propel_migration` (
  `version` INT(11) DEFAULT '0'
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `propel_migration`
--

INSERT INTO `propel_migration` (`version`) VALUES
  (1289824919);

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id`      INT(11) NOT NULL AUTO_INCREMENT,
  `id_type` VARCHAR(25)      DEFAULT NULL,
  `type`    VARCHAR(25)      DEFAULT NULL,
  `votes`   INT(11) NOT NULL,
  `rating`  INT(11) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id`        INT(11)      NOT NULL AUTO_INCREMENT,
  `parent_id` INT(11)      NOT NULL DEFAULT '0',
  `name`      VARCHAR(30)  NOT NULL,
  `alt_name`  VARCHAR(50)  NOT NULL,
  `desc`      VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `name` (`name`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 19;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`, `alt_name`, `desc`) VALUES
  (1, 0, 'user', 'Пользователи', ''),
  (10, 0, 'admin', 'Администраторы', '');

-- --------------------------------------------------------

--
-- Структура таблицы `search`
--

DROP TABLE IF EXISTS `search`;
CREATE TABLE IF NOT EXISTS `search` (
  `id`           INT(11)      NOT NULL AUTO_INCREMENT,
  `hash`         VARCHAR(264)          DEFAULT NULL,
  `datetime`     INT(11)               DEFAULT NULL,
  `where_array`  TEXT,
  `select_array` TEXT,
  `table_name`   VARCHAR(100)          DEFAULT NULL,
  `order_by`     TEXT,
  `row_count`    INT(11)               DEFAULT NULL,
  `total_rows`   INT(11)               DEFAULT NULL,
  `ids`          TEXT,
  `search_title` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`),
  KEY `datetime` (`datetime`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 21;

--
-- Дамп данных таблицы `search`
--

INSERT INTO `search` (`id`, `hash`, `datetime`, `where_array`, `select_array`, `table_name`, `order_by`, `row_count`, `total_rows`, `ids`, `search_title`)
VALUES
  (4, '528c695c8924024642f110e994786dc43ff79887', 1436379995,
      'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:82:"(title LIKE "%три%" OR prev_text LIKE "%три%" OR full_text LIKE "%три%" )";s:5:"group";b:1;}}',
      'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content',
      'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 24,
      'a:24:{i:0;s:3:"120";i:1;s:2:"89";i:2;s:2:"86";i:3;s:2:"99";i:4;s:2:"95";i:5;s:3:"103";i:6;s:3:"107";i:7;s:3:"111";i:8;s:3:"115";i:9;s:3:"119";i:10;s:2:"98";i:11;s:2:"88";i:12;s:2:"94";i:13;s:3:"102";i:14;s:3:"106";i:15;s:3:"110";i:16;s:3:"114";i:17;s:3:"118";i:18;s:3:"100";i:19;s:2:"90";i:20;s:2:"96";i:21;s:3:"104";i:22;s:3:"108";i:23;s:3:"116";}',
      'три'),
  (5, '13d58d9588b1da98c8231b23ccc2d2069bfd5869', 1431007535, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:88:"(title LIKE "%один%" OR prev_text LIKE "%один%" OR full_text LIKE "%один%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 16, 'a:16:{i:0;s:2:"89";i:1;s:2:"99";i:2;s:2:"95";i:3;s:3:"103";i:4;s:3:"107";i:5;s:3:"111";i:6;s:3:"115";i:7;s:3:"119";i:8;s:3:"100";i:9;s:2:"90";i:10;s:2:"96";i:11;s:3:"104";i:12;s:3:"108";i:13;s:3:"112";i:14;s:3:"116";i:15;s:3:"120";}', 'один'),
  (6, 'ae7698221cd4cef00ca2ec98e6885333577f265c', 1431007732, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:82:"(title LIKE "%два%" OR prev_text LIKE "%два%" OR full_text LIKE "%два%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 8, 'a:8:{i:0;s:2:"98";i:1;s:2:"88";i:2;s:2:"94";i:3;s:3:"102";i:4;s:3:"106";i:5;s:3:"110";i:6;s:3:"114";i:7;s:3:"118";}', 'два'),
  (7, '3f5f7a64ec455a69c620360398d152161f78048b', 1431007919, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:298:"(title LIKE "%главной последовательности спектрального%" OR prev_text LIKE "%главной последовательности спектрального%" OR full_text LIKE "%главной последовательности спектрального%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 8, 'a:8:{i:0;s:2:"89";i:1;s:2:"99";i:2;s:2:"95";i:3;s:3:"103";i:4;s:3:"107";i:5;s:3:"111";i:6;s:3:"115";i:7;s:3:"119";}', 'главной последовательности спектрального'),
  (8, 'cefd1da7cc8df641e921fa60238a98a1127a6bb9', 1431008621, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:76:"(title LIKE "%****%" OR prev_text LIKE "%****%" OR full_text LIKE "%****%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', '****'),
  (9, '8b6d1f850aaff71402190e96dd5b67a07d32e08f', 1431008632, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:103:"(title LIKE "%.............%" OR prev_text LIKE "%.............%" OR full_text LIKE "%.............%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', '.............'),
  (10, '10b3af3e370a1dbf950751a9c62900368f74d470', 1431008636, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:88:"(title LIKE "%////////%" OR prev_text LIKE "%////////%" OR full_text LIKE "%////////%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', '////////'),
  (11, 'fb810483a7d0cfc4a883831580dc14ded9592fed', 1435762599, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:82:"(title LIKE "%три%" OR prev_text LIKE "%три%" OR full_text LIKE "%три%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 1, 24, 'a:24:{i:0;s:3:"120";i:1;s:2:"89";i:2;s:2:"86";i:3;s:2:"99";i:4;s:2:"95";i:5;s:3:"103";i:6;s:3:"107";i:7;s:3:"111";i:8;s:3:"115";i:9;s:3:"119";i:10;s:2:"98";i:11;s:2:"88";i:12;s:2:"94";i:13;s:3:"102";i:14;s:3:"106";i:15;s:3:"110";i:16;s:3:"114";i:17;s:3:"118";i:18;s:3:"100";i:19;s:2:"90";i:20;s:2:"96";i:21;s:3:"104";i:22;s:3:"108";i:23;s:3:"116";}', 'три'),
  (12, '45b0c6bf6e04bcf8934f352be04f5a7f84787ce2', 1431451616, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:124:"(title LIKE "%консалтинг%" OR prev_text LIKE "%консалтинг%" OR full_text LIKE "%консалтинг%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'консалтинг'),
  (13, '6c3d75b2e68d75056de7020386e5da06c4c99c25', 1431855385, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:2:"32";}i:3;a:2:{s:6:"group1";s:82:"(title LIKE "%три%" OR prev_text LIKE "%три%" OR full_text LIKE "%три%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'три'),
  (14, '2eba28bc09f3d2a3e55ff3c1854800036ba1262e', 1431628817, 'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:100:"(title LIKE "%триdsfsdf%" OR prev_text LIKE "%триdsfsdf%" OR full_text LIKE "%триdsfsdf%" )";s:5:"group";b:1;}}', 'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content', 'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'триdsfsdf'),
  (15, '20470c4e48d28031a141e1433c8430f958d2b4f1', 1431855448,
       'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:130:"(title LIKE "%трифывфывфы%" OR prev_text LIKE "%трифывфывфы%" OR full_text LIKE "%трифывфывфы%" )";s:5:"group";b:1;}}',
       'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content',
       'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'трифывфывфы'),
  (16, '451fb92a0dd6d8dae9fe2aa5a5d26f54026b2ded', 1433416535,
       'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:136:"(title LIKE "%іфвфівфівфів%" OR prev_text LIKE "%іфвфівфівфів%" OR full_text LIKE "%іфвфівфівфів%" )";s:5:"group";b:1;}}',
       'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content',
       'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'іфвфівфівфів'),
  (17, 'e87baf2d95aa7623409d11c69d3c0ab0c1adca2e', 1433770455,
       'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:82:"(title LIKE "%sdfsdf%" OR prev_text LIKE "%sdfsdf%" OR full_text LIKE "%sdfsdf%" )";s:5:"group";b:1;}}',
       'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content',
       'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'sdfsdf'),
  (18, 'dea13c2a3c9ccdaed130cc4dd15b6aa852f11d4e', 1436608397,
       'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:82:"(title LIKE "%Три%" OR prev_text LIKE "%Три%" OR full_text LIKE "%Три%" )";s:5:"group";b:1;}}',
       'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content',
       'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 2, 'a:2:{i:0;s:3:"124";i:1;s:2:"86";}', 'Три'),
  (19, '8650dd45e60cada8317cd36f7eed14ee2bd8f996', 1434111978,
       'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:100:"(title LIKE "%asdasdasdasd%" OR prev_text LIKE "%asdasdasdasd%" OR full_text LIKE "%asdasdasdasd%" )";s:5:"group";b:1;}}',
       'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content',
       'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'asdasdasdasd'),
  (20, '425161489acd931de78c74348d29a7d00b0a4dd1', 1436385715,
       'a:4:{i:0;a:2:{s:11:"post_status";s:7:"publish";s:8:"operator";s:5:"WHERE";}i:1;a:2:{s:15:"publish_date <=";s:16:"UNIX_TIMESTAMP()";s:9:"backticks";b:0;}i:2;a:1:{s:4:"lang";s:1:"3";}i:3;a:2:{s:6:"group1";s:82:"(title LIKE "%asdasd%" OR prev_text LIKE "%asdasd%" OR full_text LIKE "%asdasd%" )";s:5:"group";b:1;}}',
       'a:2:{i:0;s:9:"content.*";i:1;s:57:"CONCAT_WS( "", content.cat_url, content.url ) as full_url";}', 'content',
       'a:1:{s:12:"publish_date";s:4:"DESC";}', 15, 0, 'a:0:{}', 'asdasd');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id`                         INT(11)      NOT NULL AUTO_INCREMENT,
  `s_name`                     VARCHAR(50)  NOT NULL,
  `create_keywords`            VARCHAR(25)  NOT NULL,
  `create_description`         VARCHAR(25)  NOT NULL,
  `create_cat_keywords`        VARCHAR(25)  NOT NULL,
  `create_cat_description`     VARCHAR(25)  NOT NULL,
  `add_site_name`              INT(1)       NOT NULL,
  `add_site_name_to_cat`       INT(1)       NOT NULL,
  `delimiter`                  VARCHAR(5)   NOT NULL,
  `editor_theme`               VARCHAR(10)  NOT NULL,
  `site_template`              VARCHAR(50)  NOT NULL,
  `site_offline`               VARCHAR(5)   NOT NULL,
  `google_analytics_id`        VARCHAR(40)           DEFAULT NULL,
  `main_type`                  VARCHAR(50)  NOT NULL,
  `main_page_id`               INT(11)      NOT NULL,
  `main_page_cat`              TEXT         NOT NULL,
  `main_page_module`           VARCHAR(50)  NOT NULL,
  `sidepanel`                  VARCHAR(5)   NOT NULL,
  `lk`                         VARCHAR(250)          DEFAULT NULL,
  `lang_sel`                   VARCHAR(15)  NOT NULL DEFAULT 'russian_lang',
  `google_webmaster`           VARCHAR(200)          DEFAULT NULL,
  `yandex_webmaster`           VARCHAR(200)          DEFAULT NULL,
  `yandex_metric`              VARCHAR(200) NOT NULL,
  `ss`                         VARCHAR(255) NOT NULL,
  `cat_list`                   VARCHAR(10)  NOT NULL,
  `text_editor`                VARCHAR(30)  NOT NULL,
  `siteinfo`                   TEXT         NOT NULL,
  `update`                     TEXT,
  `backup`                     TEXT,
  `robots_status`              INT(1)       NOT NULL,
  `robots_settings_status`     SMALLINT(1)  NOT NULL DEFAULT '0',
  `robots_settings`            TEXT         NOT NULL,
  `google_analytics_ee`        INT(1)       NOT NULL DEFAULT '1',
  `www_redirect`               VARCHAR(100) NOT NULL DEFAULT 'without',
  `users_registration_role_id` INT(11)               DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `s_name` (`s_name`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 5;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `s_name`, `create_keywords`, `create_description`, `create_cat_keywords`, `create_cat_description`, `add_site_name`, `add_site_name_to_cat`, `delimiter`, `editor_theme`, `site_template`, `site_offline`, `google_analytics_id`, `main_type`, `main_page_id`, `main_page_cat`, `main_page_module`, `sidepanel`, `lk`, `lang_sel`, `google_webmaster`, `yandex_webmaster`, `yandex_metric`, `ss`, `cat_list`, `text_editor`, `siteinfo`, `update`, `backup`, `robots_status`, `robots_settings_status`, `robots_settings`, `google_analytics_ee`, `www_redirect`, `users_registration_role_id`)
VALUES
  (2, 'main', 'auto', 'auto', '0', '0', 1, 1, '/', '0', 'businessimage', 'no', '', 'page', 124, '62', 'menu', '', '',
                                                                         'ru_RU', '', '', '', '', 'yes', 'tinymce',
                                                                                      'a:5:{s:13:"siteinfo_logo";s:8:"logo.png";s:16:"siteinfo_favicon";s:11:"favicon.ico";s:2:"ru";a:5:{s:20:"siteinfo_companytype";s:28:"© Business Image, 2014-2015";s:16:"siteinfo_address";s:41:"Минск ул. Красочная 22 а";s:18:"siteinfo_mainphone";s:15:"8 800 123-45-67";s:19:"siteinfo_adminemail";s:0:"";s:8:"contacts";a:7:{s:8:"schedule";s:37:"Работаем Пн-Сб 9:00-20:00";s:9:"copytight";s:28:"© Business Image, 2014-2015";s:14:"copytight_desc";s:239:"Разработка стратегий и внедрение проектов по развитию бизнеса, повышению эффективности и автоматизации процессов — наш профиль. ";s:8:"vk_group";s:3:"#vk";s:8:"fb_group";s:3:"#fb";s:13:"youtube_group";s:8:"#youtube";s:12:"google_group";s:7:"#google";}}s:2:"en";a:5:{s:8:"contacts";a:7:{s:8:"schedule";N;s:9:"copytight";N;s:14:"copytight_desc";N;s:8:"vk_group";N;s:8:"fb_group";N;s:13:"youtube_group";N;s:12:"google_group";N;}s:20:"siteinfo_companytype";s:28:"© Business Image, 2014-2015";s:16:"siteinfo_address";s:41:"Минск ул. Красочная 22 а";s:18:"siteinfo_mainphone";s:15:"8 800 123-45-67";s:19:"siteinfo_adminemail";s:0:"";}s:2:"uk";a:5:{s:8:"contacts";a:7:{s:8:"schedule";s:37:"Працюємо Пн-Сб 9:00-20:00";s:9:"copytight";s:28:"© Business Image, 2014-2015";s:14:"copytight_desc";s:238:"Розробка стратегій та впровадження проектів з розвитку бізнесу, підвищенню ефективності та автоматизації процесів - наш профіль.";s:8:"vk_group";s:3:"#vk";s:8:"fb_group";s:3:"#fb";s:13:"youtube_group";s:8:"#youtube";s:12:"google_group";s:7:"#google";}s:20:"siteinfo_companytype";s:28:"© Business Image, 2014-2015";s:16:"siteinfo_address";s:43:"Мінськ вул. Барвиста 22 а";s:18:"siteinfo_mainphone";s:15:"8 800 123-45-67";s:19:"siteinfo_adminemail";s:0:"";}}',
                                                                                      'a:3:{i:0;b:0;s:10:"newVersion";s:1:"0";s:9:"checkTime";i:1435216967;}',
                                                                                      NULL, 0, 1, '', 1, 'without', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `settings_i18n`
--

DROP TABLE IF EXISTS `settings_i18n`;
CREATE TABLE IF NOT EXISTS `settings_i18n` (
  `id`          INT(11) NOT NULL   AUTO_INCREMENT,
  `lang_ident`  INT(11) NOT NULL,
  `name`        VARCHAR(255)
                CHARACTER SET utf8 DEFAULT NULL,
  `short_name`  VARCHAR(255)
                CHARACTER SET utf8 DEFAULT NULL,
  `description` VARCHAR(255)
                CHARACTER SET utf8 DEFAULT NULL,
  `keywords`    VARCHAR(255)
                CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 4;

--
-- Дамп данных таблицы `settings_i18n`
--

INSERT INTO `settings_i18n` (`id`, `lang_ident`, `name`, `short_name`, `description`, `keywords`) VALUES
  (1, 3, 'ImageCMS - базовый адаптивный шаблон', 'ImageCMS', 'Базовый адаптивный шаблон для движка ImageCMS',
   'ImageCMS, шаблон, адаптивный шаблон'),
  (2, 32, 'ImageCMS - базовий адаптивний шаблон', 'ImageCMS', 'Базовий адаптивний шаблон для системи ImageCMS',
   'ImageCMS, шаблон, Адаптивний шаблон'),
  (3, 33, 'ImageCMS - responsive template', 'ImageCMS', 'Responsive template for ImageCMS',
   'ImageCMS, template, Responsive template');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_group`
--

DROP TABLE IF EXISTS `shop_rbac_group`;
CREATE TABLE IF NOT EXISTS `shop_rbac_group` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `type`        VARCHAR(10)  NOT NULL,
  `name`        VARCHAR(100) NOT NULL,
  `description` VARCHAR(255)          DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 79;

--
-- Дамп данных таблицы `shop_rbac_group`
--

INSERT INTO `shop_rbac_group` (`id`, `type`, `name`, `description`) VALUES
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
  (64, 'module', 'Cmsemail', NULL),
  (65, 'module', 'Mod_seo', NULL),
  (67, 'module', 'Translator', NULL),
  (68, 'module', 'Imagebox', NULL),
  (69, 'module', 'Star_rating', NULL),
  (70, 'module', 'Mobile', NULL),
  (71, 'module', 'Mod_stats', NULL),
  (73, 'base', 'Sys_update', NULL),
  (74, 'base', 'Sys_info', NULL),
  (77, 'module', 'Hotline', NULL),
  (78, 'module', 'Admin_menu', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_group_i18n`
--

DROP TABLE IF EXISTS `shop_rbac_group_i18n`;
CREATE TABLE IF NOT EXISTS `shop_rbac_group_i18n` (
  `id`          INT(11)    NOT NULL,
  `description` VARCHAR(200) DEFAULT NULL,
  `locale`      VARCHAR(5) NOT NULL,
  KEY `id_idx` (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

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
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255) NOT NULL,
  `group_id`    INT(11)      NOT NULL,
  `description` VARCHAR(255)          DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_rbac_privileges_I_1` (`name`),
  KEY `shop_rbac_privileges_FI_1` (`group_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 732;

--
-- Дамп данных таблицы `shop_rbac_privileges`
--

INSERT INTO `shop_rbac_privileges` (`id`, `name`, `group_id`, `description`) VALUES
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
  (725, 'Widgets_manager::update_html_widget', 59, NULL),
  (726, 'ShopAdminSystem::getCategoryProperties', 25, NULL),
  (727, 'Backup::file_actions', 31, NULL),
  (728, 'Backup::save_settings', 31, NULL),
  (729, 'ShopAdminSettings::runResizeAllJsone', 24, NULL),
  (730, 'ShopAdminSearch::per_page_cookie', 23, NULL),
  (731, 'ShopAdminSettings::setSorting', 24, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_privileges_i18n`
--

DROP TABLE IF EXISTS `shop_rbac_privileges_i18n`;
CREATE TABLE IF NOT EXISTS `shop_rbac_privileges_i18n` (
  `id`          INT(11)     NOT NULL,
  `title`       VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) DEFAULT NULL,
  `locale`      VARCHAR(45) NOT NULL,
  KEY `id_idx` (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

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
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255) NOT NULL,
  `importance`  INT(11)               DEFAULT NULL,
  `description` VARCHAR(255)          DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 7;

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
  `id`          INT(11)    NOT NULL,
  `alt_name`    VARCHAR(45)  DEFAULT NULL,
  `locale`      VARCHAR(5) NOT NULL,
  `description` VARCHAR(200) DEFAULT NULL,
  KEY `role_id_idx` (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `shop_rbac_roles_i18n`
--

INSERT INTO `shop_rbac_roles_i18n` (`id`, `alt_name`, `locale`, `description`) VALUES
  (1, 'Администратор', 'ru', 'Доступны все елементы управления админкой'),
  (1, 'Адмiнiстратор', 'uk', 'Доступні всі елементи управління адмін панеллю'),
  (1, 'Admin', 'en', 'Access to all controls');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_rbac_roles_privileges`
--

DROP TABLE IF EXISTS `shop_rbac_roles_privileges`;
CREATE TABLE IF NOT EXISTS `shop_rbac_roles_privileges` (
  `id`           INT(11) NOT NULL AUTO_INCREMENT,
  `role_id`      INT(11) NOT NULL,
  `privilege_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolepriv` (`role_id`, `privilege_id`),
  KEY `shop_rbac_roles_privileges_FK_2` (`privilege_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 2476;

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
  (2467, 1, 717),
  (2468, 1, 726),
  (2469, 1, 718),
  (2470, 1, 725),
  (2471, 1, 727),
  (2472, 1, 728),
  (2473, 1, 729),
  (2474, 1, 730),
  (2475, 1, 731);

-- --------------------------------------------------------

--
-- Структура таблицы `support_comments`
--

DROP TABLE IF EXISTS `support_comments`;
CREATE TABLE IF NOT EXISTS `support_comments` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `ticket_id`   INT(11)      NOT NULL,
  `user_id`     INT(11)      NOT NULL,
  `user_status` INT(11)      NOT NULL,
  `user_name`   VARCHAR(100) NOT NULL,
  `text`        VARCHAR(500) NOT NULL,
  `date`        INT(11)      NOT NULL,
  UNIQUE KEY `id` (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 2;

--
-- Дамп данных таблицы `support_comments`
--

INSERT INTO `support_comments` (`id`, `ticket_id`, `user_id`, `user_status`, `user_name`, `text`, `date`) VALUES
  (1, 1, 85, 0, 'user', 'фыв фыв фывфыв', 1291726309);

-- --------------------------------------------------------

--
-- Структура таблицы `support_departments`
--

DROP TABLE IF EXISTS `support_departments`;
CREATE TABLE IF NOT EXISTS `support_departments` (
  `id`   INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45)      DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 2;

--
-- Дамп данных таблицы `support_departments`
--

INSERT INTO `support_departments` (`id`, `name`) VALUES
  (1, 'Техническая поддержка');

-- --------------------------------------------------------

--
-- Структура таблицы `support_tickets`
--

DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id`                  INT(11)      NOT NULL AUTO_INCREMENT,
  `user_id`             INT(11)               DEFAULT NULL,
  `last_comment_author` VARCHAR(50)  NOT NULL,
  `text`                TEXT,
  `theme`               VARCHAR(100) NOT NULL,
  `department`          INT(11)      NOT NULL,
  `status`              SMALLINT(1)           DEFAULT NULL,
  `priority`            VARCHAR(15)           DEFAULT NULL,
  `date`                INT(11)               DEFAULT NULL,
  `updated`             INT(11)      NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 2;

--
-- Дамп данных таблицы `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `last_comment_author`, `text`, `theme`, `department`, `status`, `priority`, `date`, `updated`)
VALUES
  (1, 85, 'user', 'фыв фыв фыв фыв ', 'Возникла неполадка', 1, 0, '0', 1291726286, 1291726309);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id`    INT(11)      NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 40;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `value`) VALUES
  (33, 'консалтинг'),
  (30, 'бизнес'),
  (31, 'стратегия'),
  (34, 'бізнес'),
  (35, 'стратегія'),
  (36, 'идея'),
  (37, 'стартап'),
  (38, 'перспектива'),
  (39, 'ідея');

-- --------------------------------------------------------

--
-- Структура таблицы `template_settings`
--

DROP TABLE IF EXISTS `template_settings`;
CREATE TABLE IF NOT EXISTS `template_settings` (
  `id`        INT(11)      NOT NULL,
  `component` VARCHAR(255) NOT NULL,
  `key`       TEXT,
  `data`      TEXT
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id`             INT(11)      NOT NULL AUTO_INCREMENT,
  `role_id`        INT(11)               DEFAULT NULL,
  `username`       VARCHAR(50)           DEFAULT NULL,
  `password`       VARCHAR(255)          DEFAULT NULL,
  `email`          VARCHAR(100)          DEFAULT NULL,
  `banned`         TINYINT(1)            DEFAULT NULL,
  `ban_reason`     VARCHAR(255)          DEFAULT NULL,
  `newpass`        VARCHAR(255)          DEFAULT NULL,
  `newpass_key`    VARCHAR(255)          DEFAULT NULL,
  `newpass_time`   INT(11)               DEFAULT NULL,
  `last_ip`        VARCHAR(40)           DEFAULT NULL,
  `last_login`     VARCHAR(12)           DEFAULT NULL,
  `created`        INT(11)               DEFAULT NULL,
  `modified`       DATETIME              DEFAULT NULL,
  `address`        VARCHAR(255)          DEFAULT NULL,
  `cart_data`      TEXT,
  `wish_list_data` TEXT,
  `key`            VARCHAR(255) NOT NULL,
  `amout`          FLOAT(10, 2) NOT NULL,
  `discount`       VARCHAR(255)          DEFAULT NULL,
  `phone`          VARCHAR(32)           DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `users_I_1` (`key`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 65;

-- --------------------------------------------------------

--
-- Структура таблицы `user_autologin`
--

DROP TABLE IF EXISTS `user_autologin`;
CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id`     CHAR(32)
               CHARACTER SET utf8
               COLLATE utf8_bin NOT NULL,
  `user_id`    MEDIUMINT(8)     NOT NULL DEFAULT '0',
  `user_agent` VARCHAR(150)
               CHARACTER SET utf8
               COLLATE utf8_bin NOT NULL,
  `last_ip`    VARCHAR(40)
               CHARACTER SET utf8
               COLLATE utf8_bin NOT NULL,
  `last_login` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`, `user_id`),
  KEY `last_ip` (`last_ip`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `user_temp`
--

DROP TABLE IF EXISTS `user_temp`;
CREATE TABLE IF NOT EXISTS `user_temp` (
  `id`             INT(11)      NOT NULL AUTO_INCREMENT,
  `username`       VARCHAR(255) NOT NULL,
  `password`       VARCHAR(255) NOT NULL,
  `email`          VARCHAR(100) NOT NULL,
  `activation_key` VARCHAR(50)  NOT NULL,
  `last_ip`        VARCHAR(40)  NOT NULL,
  `created`        TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Структура таблицы `widgets`
--

DROP TABLE IF EXISTS `widgets`;
CREATE TABLE IF NOT EXISTS `widgets` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(50)  NOT NULL,
  `type`        VARCHAR(15)  NOT NULL,
  `data`        TEXT         NOT NULL,
  `method`      VARCHAR(50)  NOT NULL,
  `settings`    TEXT         NOT NULL,
  `description` VARCHAR(300) NOT NULL,
  `roles`       TEXT         NOT NULL,
  `created`     INT(11)      NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 41;

--
-- Дамп данных таблицы `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `type`, `data`, `method`, `settings`, `description`, `roles`, `created`) VALUES
  (29, 'popular_blog_posts', 'module', 'core', 'recent_news',
   'a:4:{s:10:"news_count";s:1:"4";s:11:"max_symdols";s:3:"200";s:10:"categories";a:3:{i:0;s:2:"64";i:1;s:2:"67";i:2;s:2:"69";}s:7:"display";s:7:"popular";}',
   'Выводит несколько записей категории по количеству просмотров', '', 1429890743),
  (33, 'breadcrumbs', 'module', 'navigation', 'widget_navigation', '', '', '', 1430585551),
  (27, 'main_reviews', 'module', 'core', 'recent_news',
   'a:4:{s:10:"news_count";s:1:"3";s:11:"max_symdols";s:5:"99999";s:10:"categories";a:1:{i:0;s:2:"66";}s:7:"display";s:6:"recent";}',
   'Вывод последних записей из категории отзывов клиентов', '', 1429363341),
  (20, 'main_blog', 'module', 'core', 'recent_news',
   'a:4:{s:10:"news_count";s:1:"4";s:11:"max_symdols";s:3:"200";s:10:"categories";a:3:{i:0;s:2:"64";i:1;s:2:"67";i:2;s:2:"69";}s:7:"display";s:6:"recent";}',
   '', '', 1428320393),
  (22, 'main_gallery', 'module', 'gallery', 'latest_fotos', 'a:2:{s:5:"limit";s:2:"15";s:5:"order";s:6:"latest";}', '',
   '', 1428425077),
  (35, 'lang_switcher', 'module', 'language_switch', 'language_switch_show', '', '', '', 1431017112),
  (36, 'page_related_posts', 'module', 'core', 'similar_posts',
   'a:4:{s:11:"search_type";s:4:"tags";s:5:"limit";s:1:"8";s:19:"min_compare_symbols";s:11:"99999999999";s:27:"max_short_description_words";s:3:"300";}',
   '', '', 1434725468),
  (34, 'latest_comments', 'module', 'comments', 'recent_comments',
   'a:2:{s:14:"comments_count";s:1:"4";s:13:"symbols_count";s:2:"50";}', '', '', 1430586517),
  (40, 'page_tag_cloud', 'module', 'tags', 'pages_tags_cloud', '', '', '', 1436347788);

-- --------------------------------------------------------

--
-- Структура таблицы `widget_i18n`
--

DROP TABLE IF EXISTS `widget_i18n`;
CREATE TABLE IF NOT EXISTS `widget_i18n` (
  `id`     INT(11)     NOT NULL,
  `locale` VARCHAR(11) NOT NULL,
  `title`  VARCHAR(500) DEFAULT NULL,
  `data`   TEXT        NOT NULL,
  PRIMARY KEY (`id`, `locale`),
  KEY `locale` (`locale`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Дамп данных таблицы `widget_i18n`
--

INSERT INTO `widget_i18n` (`id`, `locale`, `title`, `data`) VALUES
  (10, 'ru', NULL, '<p>Адрес: Федерация Орион, 12.23.22.22.2233.3</p>\n<p>Телефон: 0 800 345-56-12</p>'),
  (15, 'ru', NULL, '<div class="frame-benefits">\n<div class="container">\n<ul class="items items-benefits">\n<li class="d_i-b">\n<div class="photo-block"><span class="helper">&nbsp;</span><img src="/uploads/images/benefits/benef1.jpg" alt="Предоставление сервиса" /></div>\n<h3>Предоставление сервиса</h3>\n<p>Если вы приобрели робота у нас, но срок гарантии вышел, мы предоставим сервис высшего уровня за некоторое маленькое вознаграждение.</p>\n</li>\n<li class="d_i-b">\n<div class="photo-block"><span class="helper">&nbsp;</span><img src="/uploads/images/benefits/benef2.jpg" alt="Нано технология" /></div>\n<h3>Нано технология</h3>\n<p>Диагностика проблемы и ремонт роботов проходит под средством нано техники от Image Robotics. Ее нельзя приобрети на свободном рынке, такие возможности есть только у нас.</p>\n</li>\n<li class="d_i-b">\n<div class="photo-block"><span class="helper">&nbsp;</span><img src="/uploads/images/benefits/benef3.jpg" alt="Предоставление сервиса" /></div>\n<h3>Диагностика</h3>\n<p>Диагностика любой проблемы занимает несколько секунд, а ремонт составляет не более десяти минут с момента обнаружения проблемы. Если на складе есть ресурсы.</p>\n</li>\n</ul>\n</div>\n</div>'),
  (17, 'ru', NULL, '<div class="d_i-b phones-header"><span>8 800 <span class="f-w_b">772-22-22</span></span>\n<p class="phones-info">бесплатно по Украине</p>\n</div>\n<div class="d_i-b phones-header phones-header-last"><span>097 <span class="f-w_b">772-22-22</span></span>\n<p class="phones-info">Мобильный телефон</p>\n</div>'),
  (18, 'ru', NULL, '<p>&copy; 2014 Image Robotics - лидер в производстве роботов</p>\n<p>Powered by <a href="http://www.imagecms.net/free-cms-corporate">ImageCMS Corporate</a></p>'),
  (19, 'ru', 'Логотип, слоган', '<p>Показать вашу услугу или<br />товар буквально просто</p>'),
  (20, 'ru', 'Последнее из блога', ''),
  (20, 'uk', 'Останнє з блогу', ''),
  (21, 'ru', 'test', ''),
  (22, 'ru', 'Галерея фотографий', ''),
  (22, 'uk', 'Галерея фотографій', ''),
  (23, 'ru', 'галерея2', ''),
  (24, 'ru', 'safasdf', ''),
  (25, 'ru', 'Информация о сайте 1', '<div style="text-align: left;">+38 097 57 25 818</div>\n<div style="text-align: left;">+38 097 57 25 818<br />\n<div style="text-align: left;">+38 097 57 25 818</div>\n</div>'),
  (26, 'ru', 'Информация о сайте 2', 'Адрес: г. Львов. ул. Антоныча, дом 12, квартира 53:<br />Пн-Сб 9:00-20:00<br />Вс выходной'),
  (27, 'ru', 'Клиенты о нас', ''),
  (27, 'uk', 'Клієнти про нас', ''),
  (28, 'ru', 'Хлебные крошки', ''),
  (29, 'ru', 'Популярные посты', ''),
  (29, 'uk', 'Популярні записи', ''),
  (30, 'ru', 'Теги', ''),
  (31, 'ru', 'Последние комментарии', ''),
  (32, 'ru', 'asdsad', ''),
  (33, 'ru', 'Хлебные крошки', ''),
  (34, 'ru', 'Последние комментарии', ''),
  (34, 'uk', 'Останні коментарі', ''),
  (35, 'ru', 'Выбор языка', ''),
  (36, 'ru', 'Похожие посты', ''),
  (36, 'uk', 'Схожі записи', ''),
  (37, 'ru', 'Облако тегов', ''),
  (38, 'ru', 'Облако тегов', ''),
  (39, 'ru', 'Теги', ''),
  (40, 'ru', 'Теги', ''),
  (40, 'uk', 'Теги', '');


DROP TABLE IF EXISTS `mod_sitemap_blocked_urls`;
CREATE TABLE IF NOT EXISTS `mod_sitemap_blocked_urls` (
  `id`           INT(11)      NOT NULL AUTO_INCREMENT,
  `url`          VARCHAR(255) NOT NULL,
  `robots_check` INT(11)               DEFAULT '0',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

--
-- Структура таблицы `mod_sitemap_changefreq`
--

DROP TABLE IF EXISTS `mod_sitemap_changefreq`;
CREATE TABLE IF NOT EXISTS `mod_sitemap_changefreq` (
  `id`                                 INT(11) NOT NULL AUTO_INCREMENT,
  `main_page_changefreq`               VARCHAR(255)     DEFAULT NULL,
  `pages_changefreq`                   VARCHAR(255)     DEFAULT NULL,
  `product_changefreq`                 VARCHAR(255)     DEFAULT NULL,
  `categories_changefreq`              VARCHAR(255)     DEFAULT NULL,
  `products_categories_changefreq`     VARCHAR(255)     DEFAULT NULL,
  `products_sub_categories_changefreq` VARCHAR(255)     DEFAULT NULL,
  `brands_changefreq`                  VARCHAR(255)     DEFAULT NULL,
  `sub_categories_changefreq`          VARCHAR(255)     DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 2;

--
-- Дамп данных таблицы `mod_sitemap_changefreq`
--

INSERT INTO `mod_sitemap_changefreq` (`id`, `main_page_changefreq`, `pages_changefreq`, `product_changefreq`, `categories_changefreq`, `products_categories_changefreq`, `products_sub_categories_changefreq`, `brands_changefreq`, `sub_categories_changefreq`)
VALUES
  (1, 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly', 'weekly');

-- --------------------------------------------------------

--
-- Структура таблицы `mod_sitemap_priorities`
--

DROP TABLE IF EXISTS `mod_sitemap_priorities`;
CREATE TABLE IF NOT EXISTS `mod_sitemap_priorities` (
  `id`                               INT(11) NOT NULL AUTO_INCREMENT,
  `main_page_priority`               FLOAT            DEFAULT '1',
  `cats_priority`                    FLOAT            DEFAULT '1',
  `pages_priority`                   FLOAT            DEFAULT '1',
  `sub_cats_priority`                FLOAT            DEFAULT '1',
  `products_priority`                FLOAT            DEFAULT '1',
  `products_categories_priority`     FLOAT            DEFAULT '1',
  `products_sub_categories_priority` FLOAT            DEFAULT '1',
  `brands_priority`                  FLOAT            DEFAULT '1',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 2;

--
-- Дамп данных таблицы `mod_sitemap_priorities`
--

INSERT INTO `mod_sitemap_priorities` (`id`, `main_page_priority`, `cats_priority`, `pages_priority`, `sub_cats_priority`, `products_priority`, `products_categories_priority`, `products_sub_categories_priority`, `brands_priority`)
VALUES
  (1, 1, 0.8, 0.9, 0.7, 0.4, 0.6, 0.5, 0.3);

-- --------------------------------------------------------

--
-- Структура таблиці `custom_scripts`
--

CREATE TABLE IF NOT EXISTS `custom_scripts` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `name`     TEXT    NOT NULL,
  `value`    TEXT    NOT NULL,
  `position` INT(5)  NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


CREATE TABLE IF NOT EXISTS `shop_products_words` (
  `id`    INT(11)      NOT NULL,
  `name`  VARCHAR(255) NOT NULL,
  `local` VARCHAR(4)   NOT NULL
)
  ENGINE = MyISAM
  AUTO_INCREMENT = 403
  DEFAULT CHARSET = utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `shop_products_words`
--
ALTER TABLE `shop_products_words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_word` (`name`),
  ADD INDEX `local` (`local`),
  ADD FULLTEXT KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `shop_products_words`
--
ALTER TABLE `shop_products_words`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 403;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
