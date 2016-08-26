<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

$com_info = [
             'menu_name'   => lang('Custom scripts', 'custom_scripts'), // Menu name
             'description' => '', // Module Description
             'admin_type'  => 'window', // Open admin class in new window or not. Possible values window/inside
             'window_type' => 'xhr', // Load method. Possible values xhr/iframe
             'w'           => 600, // Window width
             'h'           => 550, // Window height
             'version'     => '0.1', // Module version
             'author'      => 'dev@imagecms.net', // Author info
             'icon_class'  => 'fa fa-code',// Module menu icon
            ];

/* End of file module_info.php */