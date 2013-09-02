

drop table `custom_fields`;

drop table `custom_fields_data`;

--
-- Структура таблиці `widget_i18n`
--

CREATE TABLE IF NOT EXISTS `widget_i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(11) CHARACTER SET utf8 NOT NULL,
  `data` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`,`locale`),
  KEY `locale` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=514 ;