-- --------------------------------------------------------

--
-- Структура таблиці `mod_email_paterns`
--

DROP TABLE IF EXISTS `mod_email_paterns`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп даних таблиці `mod_email_paterns`
--

INSERT INTO `mod_email_paterns` (`id`, `name`, `patern`, `from`, `from_email`, `admin_email`, `type`, `user_message_active`, `admin_message_active`) VALUES
(1, 'make_order', '', 'ImageCMS Shop', 'no-replay@shop.com', '', 'HTML', 1, 1),
(2, 'change_order_status', '', 'ImageCMS Shop', 'no-replay@shop.com', '', 'HTML', 1, 0),
(3, 'notification_email', '', 'ImageCMS Shop', 'no-replay@shop.com', '', 'HTML', 1, 0),
(4, 'create_user', '', 'Admin', 'no-replay@shop.com', '', 'HTML', 1, 1),
(5, 'forgot_password', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 0),
(6, 'change_password', '', 'Администрация сайта', 'no-replay@shop.com', '', 'HTML', 1, 0),
(20, 'pricespy', '', 'Admin', 'admin@local.loc', 'admin@local.loc', 'HTML', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `mod_email_paterns_i18n`
--

DROP TABLE IF EXISTS `mod_email_paterns_i18n`;
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
(1, 'ru', 'Заказ товара', '<p><span>Здравствуйте, $userName$.</span><br /><br /><span>Мы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop"</span><br /><br /><span>Вы указали следующие контактные данные:</span><br /><br /><span>Email адрес: $userEmail$</span><br /><br /><span>Номер телефона: $userPhone$</span><br /><br /><span>Адрес доставки: $userDeliver$</span><br /><br /><span>Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.</span><br /><br /><span>Также, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:&nbsp; $orderLink$.</span><br /><br /><span>Спасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь за телефонами:</span><br /><br /><span>+7 (095) 222-33-22 +38 (098) 222-33-22</span></p>', '<p>Пользователь&nbsp;<span>$userName$ совершил заказ товара&nbsp;</span></p>\n<p><span><span>Email адрес: $userEmail$</span><br /><br /><span>Номер телефона: $userPhone$</span><br /><br /><span>Адрес доставки: $userDeliver$</span></span></p>', '<p><span>Уведомление покупателя о совершении заказа</span></p>', 'a:5:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$userPhone$";s:39:"Телефон Пользователя";s:13:"$userDeliver$";s:27:"Адрес доставки";s:11:"$orderLink$";s:28:"Ссылка на заказ";}'),
(2, 'ru', 'Смена статуса заказа', '<p><span>Здравствуйте, $userName$.</span><br /><br /><span>Статус вашего заказа изменен на&nbsp;<span>$status$</span></span><br /><br /><span>Вы указали следующие контактные данные:</span><br /><br /><span>Email адрес: $userEmail$</span><br /><br /><span>Номер телефона: $userPhone$</span><br /><br /><span>Адрес доставки: $userDeliver$</span><br /><br /><span>Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.</span><br /><br /><span>Также, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:&nbsp; $orderLink$.</span><br /><br /><span>Спасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь за телефонами:</span><br /><br /><span>+7 (095) 222-33-22 +38 (098) 222-33-22</span>&nbsp;</p>', '', '<p>Смена статуса заказа</p>', 'a:4:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$orderLink$";s:28:"Ссылка на заказ";s:8:"$status$";s:25:"статус заказа";}'),
(3, 'ru', 'Уведомление', '<p><span>Здравствуйте, $userName$.</span><br /><br /><span>Статус товара $productName$&nbsp;за которым вы следите изменен на <span>$status$</span></span><br /><br /><span>Спасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь за телефонами:</span><br /><br /><span>+7 (095) 222-33-22 +38 (098) 222-33-22</span>&nbsp;</p>', '', '<p>Уведомление о появлении</p>', 'a:4:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:13:"$productName$";s:33:"Название продукта";s:8:"$status$";s:12:"Статус";}'),
(4, 'ru', 'Создание пользователя', '<p><span>Успешно пройдена реєстрация $user_name$&nbsp;</span></p>\n<p>Ваши данние:<br /><span>Пароль: $user_password$</span><br /><span>Адрес: &nbsp;$user_address$</span><br /><span>Email: $user_email$</span><br /><span>Телефон: $user_phone$</span></p>', '<p><span>Создан пользователь $user_name$:</span><br /><span>С паролем: $user_password$</span><br /><span>Адресом: &nbsp;$<span>user_</span>address$</span><br /><span>Email пользователя: $user_email$</span><br /><span>Телефон пользователя: $user_phone$</span></p>', '<p>Шаблон письма на создание пользователя</p>', 'a:6:{s:11:"$user_name$";s:31:"Имя пользователя";s:14:"$user_address$";s:35:"Адрес пользователя";s:15:"$user_password$";s:37:"Пароль пользователя";s:12:"$user_phone$";s:39:"Телефон пользователя";s:12:"$user_email$";s:30:"Email пользователя";}'),
(5, 'ru', 'Восстановление пароля', '<p><span>Здравствуйте!</span><br /><br /><span>На сайте $webSiteName$ создан запрос на восстановление пароля для Вашего аккаунта.</span><br /><br /><span>Для завершения процедуры восстановления пароля перейдите по ссылке $resetPasswordUri$</span><br /><br /><span>Ваш новый пароль для входа: $password$</span><br /><br /><span>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</span><br /><br /><span>При возникновении любых вопросов, обращайтесь по телефонам:</span><br /><br /><span>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89</span><br /><br /><span>---</span><br /><br /><span>С уважением,</span><br /><br /><span>сотрудники службы продаж $webSiteName$</span></p>', '', 'Шаблон письма на  восстановление пароля', 'a:5:{s:13:"$webSiteName$";s:17:"Имя сайта";s:18:"$resetPasswordUri$";s:57:"Ссылка на восстановления пароля";s:10:"$password$";s:12:"Пароль";s:5:"$key$";s:8:"Ключ";s:16:"$webMasterEmail$";s:52:"Email сотрудников службы продаж";}'),
(6, 'ru', 'Смена пароля', '<p><span>Здравствуйте $user_name$!</span><br /><br /><span>Ваш новый пароль для входа: $password$</span><br /><br /><span>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</span><br /><br /><span><br /></span></p>', '', '<p>Шаблон письма изменения пароля</p>', 'a:2:{s:11:"$user_name$";s:31:"Имя пользователя";s:10:"$password$";s:23:"новый пароль";}'),
(20, 'ru', 'Изминение цены', '<p>Цена на $name$ за которым вы следите на сайте $server$ изменилась.<br /> <a title="Посмотреть список слежения" href="$list_url_look$">Посмотреть список слежения</a><br /> <a title="Отписатся от слежения" href="$delete_list_url_look$">Отписатся от слежения</a></p>\n<div id="dc_vk_code"  none;">&nbsp;</div>', '<p>&nbsp;</p>\n<div id="dc_vk_code">&nbsp;</div>', '<p>Изминение цены</p>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>', ''),
(20, 'ua', 'Ціна змінилася', '<p>Ціна на $name$ за яким Ви слідкуєте на сайті $server$ змінилася.<br /> <a title="Переглянути список слідкувань" href="$list_url_look$">Переглянути список слідкувань</a><br /> <a title="Відписатися від слідкування" href="$delete_list_url_look$">Відписатися від слідкування</a></p>\n<div id="dc_vk_code"  none;">&nbsp;</div>', '<p>&nbsp;</p>\n<div id="dc_vk_code">&nbsp;</div>', '<p>Слідкування за ціною</p>\n<div id="dc_vk_code" style="display: none;">&nbsp;</div>', '');


--
-- Структура таблиці `shop_sorting`
--

DROP TABLE IF EXISTS `shop_sorting`;
CREATE TABLE IF NOT EXISTS `shop_sorting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) DEFAULT NULL,
  `get` varchar(25) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп даних таблиці `shop_sorting`
--

INSERT INTO `shop_sorting` (`id`, `pos`, `get`, `active`) VALUES
(1, 4, 'rating', 1),
(2, 1, 'price', 1),
(3, 2, 'price_desc', 1),
(4, 3, 'hit', 1),
(5, 5, 'hot', 1),
(6, 0, 'action', 1),
(7, 8, 'name', 0),
(8, 9, 'name_desc', 0),
(9, 6, 'views', 0),
(10, 7, 'topsales', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `shop_sorting_i18n`
--

DROP TABLE IF EXISTS `shop_sorting_i18n`;
CREATE TABLE IF NOT EXISTS `shop_sorting_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(11) NOT NULL DEFAULT 'ru',
  `name` varchar(50) NOT NULL,
  `name_front` varchar(50) DEFAULT NULL,
  `tooltip` varchar(256) NOT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп даних таблиці `shop_sorting_i18n`
--

INSERT INTO `shop_sorting_i18n` (`id`, `locale`, `name`, `name_front`, `tooltip`) VALUES
(1, 'ru', 'По рейтингу', 'Рейтинг', ''),
(2, 'ru', 'От дешевих к дорогим', 'От дешевих к дорогим', ''),
(3, 'ru', 'От дорогих к дешевым', 'От дорогих к дешевим', ''),
(4, 'ru', 'Популярные', 'Популярние', ''),
(5, 'ru', 'Новинки', 'Новинки', ''),
(6, 'ru', 'Акции', 'Акции', ''),
(6, 'ua', '', '', ''),
(7, 'ru', 'А-Я', 'Имени', ''),
(8, 'ru', 'Я-А', 'Имени(Я-А)', ''),
(9, 'ru', 'Просмотров', 'Количеству просмотров', ''),
(10, 'ru', 'Топ продаж', 'Топ продаж', '');