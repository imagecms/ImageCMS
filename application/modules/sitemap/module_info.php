<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Site map', 'sitemap'), // Menu name
    'description' => lang('Creating a site map for search engines', 'sitemap'), // Module Description
    'admin_type' => 'inside', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '0.1', // Module version
    'author' => 'icon-map-marker', // Author info
    'icon_class' => 'icon-map-marker'
);

/* End of file module_info.php */
