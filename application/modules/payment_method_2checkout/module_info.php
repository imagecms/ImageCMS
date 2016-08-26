<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

$com_info = [
             'menu_name'   => lang('2checkout', 'payment_method_2checkout'), // Menu name
             'description' => lang('Payment method 2checkout', 'payment_method_2checkout'), // Module Description
             'admin_type'  => 'window', // Open admin class in new window or not. Possible values window/inside
             'window_type' => 'xhr', // Load method. Possible values xhr/iframe
             'w'           => 600, // Window width
             'h'           => 550, // Window height
             'version'     => '0.1', // Module version
             'author'      => 'v.dushko@imagecms.net', // Author info
             'icon_class'  => 'icon-barcode',
            ];

/* End of file module_info.php */