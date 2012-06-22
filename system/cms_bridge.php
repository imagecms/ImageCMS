<?php if (!defined('CMS_BRIDGE')) exit('No direct script access allowed');

define('ENVIRONMENT', 'production');
error_reporting(0);

$system_path = realpath(dirname(__FILE__));
$system_path = str_replace("\\","/", $system_path);
$system_path = rtrim($system_path, '/').'/';

$application_folder = '../application';

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('EXT', '.php');
define('BASEPATH', str_replace("\\", "/", $system_path));
define('FCPATH', realpath(dirname(__FILE__)."/..")."/");
define('PUBPATH', FCPATH); 
define('TEMPLATES_PATH', FCPATH.'templates/');
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


if (is_dir($application_folder))
{
    define('APPPATH', $application_folder.'/');
}
else
{
    if ( ! is_dir(BASEPATH.$application_folder.'/'))
    {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
    }

    define('APPPATH', BASEPATH.$application_folder.'/');
}

require_once BASEPATH.'core/CodeIgniter'.EXT;

//end copy
