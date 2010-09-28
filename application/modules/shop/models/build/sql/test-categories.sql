--
-- Дамп данных таблицы `shop_category`
--

INSERT INTO `shop_category` (`id`, `name`, `url`, `description`, `meta_desc`, `meta_title`, `parent_id`, `position`, `full_path`) VALUES
(8, 'Sony', 'sony', NULL, '', '', 0, 4, 'sony'),
(5, 'Nokia', 'nokia', NULL, '', '', 0, 1, 'nokia'),
(6, 'Alcatel', 'alcatel', NULL, '', '', 0, 2, 'alcatel'),
(7, 'Motorola', 'motorola', NULL, '', '', 0, 3, 'motorola'),
(9, 'Music Editions', 'music-editions', NULL, '', '', 5, 5, 'nokia/music-editions'),
(10, 'For business', 'for-business', NULL, '', '', 5, 6, 'nokia/for-business'),
(11, 'All teleprohnes', 'all-teleprohnes', NULL, '', '', 6, 7, 'alcatel/all-teleprohnes');
