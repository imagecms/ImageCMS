<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$com_info = array(
	'menu_name'   => lang('Hotline', 'hotline'),     // Menu name
	'description' => lang('Allows you to create Hotline.ua xml file', 'hotline'),                  // Module Description
	'admin_type'  => 'inside',            // Open admin class in new window or not. Possible values window/inside
	'window_type' => 'xhr',               // Load method. Possible values xhr/iframe
        'w'           => 600,                 // Window width
	'h'           => 550,                 // Window height
	'version'     => '1.0',               // Module version
	'author'      => 'a.skavronskiy@imagecms.net', // Author info Andriy Skavronskyy
        'type' => 'shop'                // CMS version
);

/* End of file module_info.php */
