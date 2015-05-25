<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Langauges switch', 'language_switch'), // Menu name
    'description' => lang('Allows you to insert a widget to switch languages on the site', 'language_switch'), // Module Description
    'admin_type' => 'inside', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '1.0', // Module version
    'author' => 'andrey@itsmedia.ru',   // Author info
    'icon_class' => 'icon-indent-left'
);

/* End of file module_info.php */
