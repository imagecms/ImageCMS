<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* autoload base classes */
spl_autoload_register('modules::autoload');

/**
 * Modular Extensions - PHP5
 *
 * Adapted from the CodeIgniter Core Classes
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @link		http://codeigniter.com
 *
 * Description:
 * This library provides functions to load and instantiate controllers
 * and module controllers allowing use of the HMVC design pattern.
 *
 * Install this file as application/libraries/Modules.php
 *
 * @copyright 	Copyright (c) Wiredesignz 2008-11-04
 * @version 	5.1.39
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class Modules
{
	/* the module directory */
	private static $home;

	/* the controller registry */
	public static $registry = array();

	/** Load a module controller **/
	public static function load($module)
	{
		(is_array($module)) AND list($module, $params) = each($module) OR $params = NULL;

		/* get the controller class name */
		$controller = strtolower(end(explode('/', $module)));

		/* is controller in registry? */
		if (isset(self::$registry[$controller]))

			return self::$registry[$controller];

		/* get the module name */
		list($module) = explode('/', $module);

		/* find the module controller */
		list($module, $controller) = Router::locate(array($module, $controller));

		if ($module === FALSE) return;

		/* set the module directory */
		self::$home = $module;

		$path = ($module) ? MODOFFSET.$module.'/' : NULL;

		/* load the module controller class */
		self::load_file($controller, APPPATH.'controllers/'.$path);

		$class = ucfirst($controller);

		/* create the new controller */
		$controller = new $class($params);

		return $controller;
	}

	/** Set the module directory **/
	public static function path()
	{
		if ( ! isset(self::$home)) return Router::$path;

		return self::$home;
	}

	/** Library base class autoload **/
	public static function autoload($class)
	{
		/* don't autoload CI_ or MY_ prefixed classes */
		if (strstr($class, 'CI_') OR strstr($class, 'MY_')) return;

		if(is_file($location = APPPATH.'libraries/'.$class.EXT))

			include_once $location;
	}

	/** Load a module file **/
	public static function load_file($file, $path, $type = 'other', $result = TRUE)
	{
		$file = str_replace(EXT, '', $file);

		if ($type === 'other')
		{
			if (class_exists($file, FALSE))
			{
				log_message('debug', "File already loaded: {$path}{$file}".EXT);

				return $result;
			}

			include_once $path.$file.EXT;
		}
		else /* load config or language arrays */
		{
			include $path.$file.EXT;

			if ( ! isset($$type) OR ! is_array($$type))

				show_error("{$path}{$file}".EXT." does not contain a valid {$type} array");

			$result = $$type;
		}

		log_message('debug', "File loaded: {$path}{$file}".EXT);

		return $result;
	}

	/**
	* Find a file
	* Scans for files located within application/modules directory.
	* Also scans application directories for models and views.
	* Generates fatal error on file not found.
	**/
	public static function find($file, $path, $base, $subpath = NULL)
	{
		$search = array();

		/* override subpath when loading from a subdirectory */
		if ($pos = strrpos($file, '/'))
	    {
			$subpath = substr($file, 0, $pos);

			$file = substr($file, $pos + 1);
	    }

		($path) AND $path .= '/';

		($subpath) AND $subpath .= '/';

		$file_ext = strpos($file, '.') ? $file : $file.EXT;

		if ($path) /* ensure we have a module path */
		{
			($subpath) AND $search[] = MODBASE.$path.$base.$subpath;

			$search[] = MODBASE.$path.$base;
		}

		switch ($base)
		{
			case ('libraries/'):

				$file_ext = ucfirst($file_ext);

				break;

			case ('views/'):

			case ('models/'):

				($subpath) AND $search[] = APPPATH.$base.$subpath;

				$search[] = APPPATH.$base;

				($path) AND $search[] = APPPATH.$base.$path;
		}

		foreach ($search as $path2)
		{
			if (is_file($path2.$file_ext)) return array($path2, $file);
		}

		/* file not found. show an error for these types */
		if ($base == 'views/' OR $base == 'models/')

			show_error("Unable to locate the file: {$file_ext} in: {$base}");

		/* handle the rest back in the controller */
		return array(FALSE, $file);
	}

	/**
	* Run a module controller method
	* Output from module is buffered and returned.
	**/
	public static function run($location,$args = array())
    {
		$method = 'index';

		if(($pos = strrpos($location, '/')) != FALSE)
		{
			$method = substr($location, $pos + 1);

			$location = substr($location, 0, $pos);

		}

		if($class = self::load($location))
		{
			if ( ! method_exists($class, $method))

				show_error("Unable to run the module: {$location}/{$method}");

			ob_start();

			call_user_func_array(array($class, $method), $args);

			return ob_get_clean();
		}
	}
}
