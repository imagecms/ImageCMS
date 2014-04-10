<?php

define('ENVIRONMENT', 'production');
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

$system_path = realpath(dirname(__FILE__) . '/../system/');
$system_path = str_replace("\\", "/", $system_path);
$system_path = rtrim($system_path, '/') . '/';

$application_folder = '../application';


define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('EXT', '.php');
define('BASEPATH', str_replace("\\", "/", $system_path));
define('FCPATH', realpath(dirname(__FILE__) . "/..") . "/");
define('PUBPATH', FCPATH);
define('TEMPLATES_PATH', FCPATH . 'templates/');
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

define('UNIT_TESTS_PATH', PUBPATH . 'tests/tests/unit/');


if (is_dir($application_folder)) {
    define('APPPATH', $application_folder . '/');
} else {
    if (!is_dir(BASEPATH . $application_folder . '/')) {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }

    define('APPPATH', BASEPATH . $application_folder . '/');
}

require_once $system_path . '../tests/Output' . EXT;
require_once $system_path . '../tests/Utf8' . EXT;
require_once BASEPATH . 'core/CodeIgniter' . EXT;

function doLogin($login = 'ad@min.com', $password = 'admin') {
    global $userId;
    $CI = &get_instance();
    $CI->dx_auth->login($login, $password);
    $GLOBALS['userId'] = $CI->dx_auth->get_user_id();
}

?>