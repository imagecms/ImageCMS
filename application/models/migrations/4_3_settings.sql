CREATE TABLE IF NOT EXISTS `settings_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_ident` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `short_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `settings_i18n` (`id`, `lang_ident`, `name`, `short_name`, `description`, `keywords`) VALUES
(1, 3, 'ImageCMS DemoShop', 'ImageCMS', 'Продажа качественной техники с гарантией и доставкой', 'магазин техники, покупка техники, доставка техники');

ALTER TABLE `settings`
  DROP `site_title`,
  DROP `site_short_title`,
  DROP `site_description`,
  DROP `site_keywords`;
