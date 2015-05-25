<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Rating', 'star_rating'), // Menu name
    'description' => lang('Allows you to display products, categories and pages rating', 'star_rating'), // Module Description
    'admin_type' => 'window', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '1.0', // Module version
    'author' => 'dev@imagecms.net',      // Author info
    'icon_class' => 'icon-star-empty'
);

/* End of file module_info.php */
