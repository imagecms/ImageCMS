<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Comments', 'comments'),
    'description' => lang('User comments management module', 'comments'),
    'admin_type' => 'inside',
    'window_type' => 'xhr', // xhr/iframe - если используем xhr, тогда каждой ссылке нужно добавить класс "ajax"
    'w' => 600,
    'h' => 550,
    'version' => '1.0',
    'author' => 'dev@imagecms.net',
    'setup_rules' => '',
    'icon_class' => 'icon-comment'
);

/* end of file */
