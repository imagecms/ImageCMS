<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

$com_info = array(
    'menu_name' => lang('WebMoney', 'payment_method_webmoney'), // Menu name
    'description' => lang('Метод оплаты WebMoney', 'payment_method_webmoney'), // Module Description
    'admin_type' => 'window', // Open admin class in new window or not. Possible values window/inside
    'window_type' => 'xhr', // Load method. Possible values xhr/iframe
    'w' => 600, // Window width
    'h' => 550, // Window height
    'author' => 'v.dushko@imagecms.net', // Author info
    'icon_class' => 'icon-barcode'
);

/* End of file module_info.php */