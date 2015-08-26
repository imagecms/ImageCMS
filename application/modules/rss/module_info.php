<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('RSS', 'rss'), // Menu name
    'description' => lang('RSS-каналы', 'rss'), // Module Description
    'admin_type' => 'inside', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '1.0', // Module version
    'author' => 'dev@imagecms.net', // Author info
    'icon_class' => 'icon-bullhorn'
);

/* End of file module_info.php */
