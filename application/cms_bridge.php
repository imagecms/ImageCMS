<?php

if (!defined('CMS_BRIDGE'))
    exit('No direct script access allowed');

define('ENVIRONMENT', 'development');
error_reporting(1);

$rootPath = realpath(__DIR__ . '/../');

$system_path = $rootPath . '/system';
$system_path = str_replace("\\", "/", $system_path);
$system_path = rtrim($system_path, '/') . '/';

$application_folder = $rootPath . '/application';

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('EXT', '.php');
define('BASEPATH', str_replace("\\", "/", $system_path));
define('FCPATH', realpath(dirname(__FILE__) . "/..") . "/");
define('PUBPATH', FCPATH);
define('TEMPLATES_PATH', FCPATH . 'templates/');
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


if (is_dir($application_folder)) {
    define('APPPATH', $application_folder . '/');
} else {
    if (!is_dir(BASEPATH . $application_folder . '/')) {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }

    define('APPPATH', BASEPATH . $application_folder . '/');
}


// further goes some code from system/core/Codeigniter.php that 
// needs to load framework stuff

require_once BASEPATH . 'core/Common' . EXT;

if (defined('ENVIRONMENT') AND file_exists(APPPATH . 'config/' . ENVIRONMENT . '/constants.php')) {
    require(APPPATH . 'config/' . ENVIRONMENT . '/constants.php');
} else {
    require(APPPATH . 'config/constants.php');
}

if (isset($assign_to_config['subclass_prefix']) AND $assign_to_config['subclass_prefix'] != '') {
    get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
}

$EXT = & load_class('Hooks', 'core');
$EXT->_call_hook('pre_system');

$CFG = & load_class('Config', 'core');

$GLOBALS['CFG'] = $CFG;

$EXT->_call_hook('pre_controller');
