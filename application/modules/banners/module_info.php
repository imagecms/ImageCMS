<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$com_info = array(
	'menu_name'   => lang('Banners management', 'banners'),     // Menu name
	'description' => lang('Allows you to create banners for any page on the site or online store', 'banners'),                  // Module Description
	'admin_type'  => 'inside',            // Open admin class in new window or not. Possible values window/inside
	'window_type' => 'xhr',               // Load method. Possible values xhr/iframe
        'w'           => 600,                 // Window width
	'h'           => 550,                 // Window height
	'version'     => '1.1',               // Module version
	'author'      => 'l.andriy@siteimage.com.ua', // Author info Andriy Leshko
        'type' => 'shop'                // CMS version
);

/* End of file module_info.php */
