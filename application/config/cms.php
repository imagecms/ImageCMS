<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['default_time_zone'] = 'Europe/Kiev';

$config['modules_locations'] = array(
    'modules',
    'modules_2'
);

$config['static_base_url'] = '';

$config['is_installed'] = TRUE;
$config['rebuild_hooks_tree'] = FALSE;

$config['tpl_compile_path'] = BASEPATH . 'cache/templates_c/';
$config['tpl_force_compile'] = FALSE;
$config['tpl_compiled_ttl'] = 84600;
$config['tpl_compress_output'] = TRUE;
$config['tpl_use_filemtime'] = TRUE;

/**
 * Use deprecated methods for cart
 */
$config['use_deprecated_cart_methods'] = FALSE;

/**
 * 
 * @var string|boolean this functionallity is present in codegniter 3, so 
 * when will be updating to 3.x this (and code from lib_init.php) shoud 
 * be deleted
 */
$config['composer_autoload'] = APPPATH . 'third_party/autoload.php';



return $config;
