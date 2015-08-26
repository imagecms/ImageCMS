<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Feedback', 'feedback'), // Menu name
    'description' => lang('Manage and configure the feedback form on the site', 'feedback'), // Module Description
    'admin_type' => 'inside', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '0.1', // Module version
    'author' => 'dev@imagecms.net', // Author info
    'icon_class' => 'icon-volume-up'
);

/* End of file module_info.php */
