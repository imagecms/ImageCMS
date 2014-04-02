CREATE TABLE IF NOT EXISTS `template_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(30),
  `key` varchar(50),
  `data` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
