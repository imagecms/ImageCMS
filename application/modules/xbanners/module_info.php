<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

$com_info = [
    'menu_name' => lang('Banners', 'xbanners'), // Menu name
    'description' => lang('Improved banners module', 'xbanners'),            // Module Description
    'admin_type' => 'window',       // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr',         // Load method. Possible values xhr/iframe
    'w' => 600,                     // Window width
    'h' => 550,                     // Window height
    'version' => '0.1 dev',             // Module version
    'author' => 'dev@imagecms.net',  // Author info
    'icon_class' => 'fa fa-picture-o',
];

/* End of file module_info.php */