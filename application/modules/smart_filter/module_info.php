<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Smart filter', 'smart_filter'), // Menu name
    'description' => lang('Allows you to change the default online store filter to extended', 'smart_filter'), // Module Description
    'admin_type' => 'window', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '0.1', // Module version
    'author' => 'dev@imagecms.net', // Author info
    'icon_class' => 'icon-filter'
);

/* End of file module_info.php */