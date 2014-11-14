<?php if (!defined('CMS_BRIDGE')) exit('No direct script access allowed');

define('ENVIRONMENT', 'development');
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


function &load_class($class, $directory = 'libraries', $prefix = 'CI_')
{
	static $_classes = array();

	// Does the class exist?  If so, we're done...
	if (isset($_classes[$class]))
	{
		return $_classes[$class];
	}

	$name = FALSE;

	// Look for the class first in the native system/libraries folder
	// thenin the local application/libraries folder
	foreach (array(BASEPATH, APPPATH) as $path)
	{
		if (file_exists($path.$directory.'/'.$class.'.php'))
		{
			$name = $prefix.$class;

			if (class_exists($name) === FALSE)
			{
				require($path.$directory.'/'.$class.'.php');
			}

			break;
		}
	}

	// Is the request a class extension?  If so we load it too
	if (file_exists(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php'))
	{
		$name = config_item('subclass_prefix').$class;

		if (class_exists($name) === FALSE)
		{
			require(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php');
		}
	}

	// Do we have a DataMapper extension for this class?
	if (file_exists($file = APPPATH.'third_party/datamapper/system/'.$class.'.php'))
	{
		require_once($file);
	}

	// Did we find the class?
	if ($name === FALSE)
	{
		// Note: We use exit() rather then show_error() in order to avoid a
		// self-referencing loop with the Excptions class
		exit('Unable to locate the specified class: '.$class.'.php');
	}

	// Keep track of what we just loaded
	is_loaded($class);

	$_classes[$class] = new $name();
	return $_classes[$class];
}

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
