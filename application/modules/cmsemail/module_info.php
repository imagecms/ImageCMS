<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Email-notifications managing', 'cmsemail'), // Menu name
    'description' => lang('Allows you to customize letters templates to be sent to users when certain actions', 'cmsemail'),            // Module Description
    'admin_type' => 'window',       // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr',         // Load method. Possible values xhr/iframe
    'w' => 600,                     // Window width
    'h' => 550,                     // Window height
    'version' => '0.1',             // Module version
    'author' => 'dev@imagecms.net',  // Author info
    'type' => 'shop',                // CMS version
    'icon_class' => 'icon-envelope'
);

/* End of file module_info.php */
