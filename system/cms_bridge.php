<?php if (!defined('CMS_BRIDGE')) exit('No direct script access allowed');

error_reporting(E_ALL);

// Если установить FALSE, система выведет главную страницу 
// или страницу которую вы указали в $_SERVER['PATH_INFO']
// define('ICMS_INIT', TRUE);

// define('ICMS_DISBALE_CSRF', TRUE); // Отключить защиту от CSRF

// $_SERVER['PATH_INFO'] = '/';


// Copied from initial CI index.php
$system_folder = "";

$application_folder = "../application";

if (strpos($system_folder, '/') === FALSE)
{
	if (function_exists('realpath') AND @realpath(dirname(__FILE__)) !== FALSE)
	{
		$system_folder = realpath(dirname(__FILE__)).'/'.$system_folder;
	}
}
else
{
	$system_folder = str_replace("\\", "/", $system_folder);
}

define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
define('FCPATH', __FILE__);
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', $system_folder.'/');
define('PUBPATH',realpath(dirname(__FILE__).'/../'));
define('TEMPLATES_PATH',PUBPATH.'/templates/');

if (is_dir($application_folder))
{
	define('APPPATH', $application_folder.'/');
}
else
{
	if ($application_folder == '')
	{
		$application_folder = 'application';
	}

	define('APPPATH', BASEPATH.$application_folder.'/');
}


require_once BASEPATH.'codeigniter/CodeIgniter'.EXT;
//end copy
