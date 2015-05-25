<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Social Networking Buttons', 'share'),
    'description' => lang('Adds social networks buttons to products and articles', 'share'),
    'admin_type' => 'inside',
    'window_type' => 'xhr', // xhr/iframe - если используем xhr, тогда каждой ссылке нужно добавить класс "ajax"
    'w' => 600,
    'h' => 550,
    'version' => '1.0',
    'author' => 'dev@imagecms.net',
    'setup_rules' => '',
    'icon_class' => 'icon-globe'
);

/* end of file */
