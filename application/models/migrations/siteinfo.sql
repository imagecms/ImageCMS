-- 30.08.2013


-- update for siteinfo
ALTER TABLE  `settings` ADD  `siteinfo` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
UPDATE `settings` SET  `siteinfo` = 'a:7:{s:20:"zsiteinfo_companytype";s:0:"";s:16:"siteinfo_address";s:0:"";s:18:"siteinfo_mainphone";s:18:"+8 (090) 500-50-50";s:19:"siteinfo_adminemail";s:19:"webmaster@localhost";s:13:"siteinfo_logo";s:0:"";s:16:"siteinfo_favicon";s:0:"";s:8:"contacts";a:3:{s:5:"Email";s:17:"Info@imagecms.net";s:5:"Skype";s:8:"ImageCMS";s:7:"Тел.";s:38:"+8 (090) 500-50-50, +8 (100) 500-50-50";}}' WHERE  `settings`.`id` = 2;


-- update for admin's email about order (addind variables $products$, $deliveryPrice$ and $checkLink$
UPDATE `mod_email_paterns` SET  `variables` = 'a:8:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$userPhone$";s:39:"Телефон Пользователя";s:13:"$userDeliver$";s:27:"Адрес доставки";s:11:"$orderLink$";s:28:"Ссылка на заказ";s:15:"$deliveryPrice$";s:25:"Цена доставки";s:10:"$products$";s:34:"Таблица с товарами";s:11:"$checkLink$";s:24:"Ссылка на чек";}' WHERE  `name` = 'make_order';

