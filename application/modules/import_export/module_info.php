<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Module Import Export', 'import_export'), // Menu name
    'description' => lang('The module allows you to import and export of goods by means of formats CSV, XLS, XLSX', 'import_export'), // Module Description
    'admin_type' => 'window', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '1.0', // Module version
    'author' => 'dev@imagecms.net' // Author info
);

/* End of file module_info.php */
