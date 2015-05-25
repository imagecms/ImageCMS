<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Fields constructor', 'cfcm'), // Menu name
    'description' => lang('Allows you to create additional fields in ImageCMS Corporate', 'cfcm'), // Module Description
    'admin_type' => 'inside', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '0.1', // Module version
    'author' => 'dev@imagecms.net', // Author info
    'icon_class' => 'icon-indent-right'
);

/* End of file module_info.php */
