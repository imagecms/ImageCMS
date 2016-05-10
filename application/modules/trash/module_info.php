<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$com_info = [
             'menu_name'   => lang('Module of redirects', 'trash'),
             'description' => lang('Module for creating redirects 301, 302', 'trash'),
             'admin_type'  => 'inside',
             'window_type' => 'xhr',
             'w'           => 600,
             'h'           => 550,
             'version'     => '1.4',
             'author'      => 'a.gula@imagecms.net',
             'icon_class'  => 'icon-random',
            ];

/* End of file module_info.php */