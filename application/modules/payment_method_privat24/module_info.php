<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('Privat24', 'payment_method_privat24'), // Menu name
    'description' => lang('Метод оплаты Privat24', 'payment_method_privat24'), // Module Description
    'admin_type' => 'window', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'version' => '1.0 dev.', // Module version
    'author' => 'dev@imagecms.net' // Author info
);

/* End of file module_info.php */
