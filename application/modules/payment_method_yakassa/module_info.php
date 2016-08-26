<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

$com_info = [
             'menu_name'   => lang('Yandex Kassa', 'payment_method_yakassa'), // Menu name
             'description' => lang('Метод оплаты Yandex Kassa', 'payment_method_yakassa'), // Module Description
             'admin_type'  => 'window', // Open admin class in new window or not. Possible values window/inside
             'window_type' => 'xhr', // Load method. Possible values xhr/iframe
             'w'           => 600, // Window width
             'h'           => 550, // Window height
             'version'     => '0.1b', // Module version
             'author'      => 'v.dushko@imagecms.net', // Author info
             'icon_class'  => 'icon-barcode',
            ];

/* End of file module_info.php */