<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the modules library */
require_once 'Modules.php';

/**
 * Modular Extensions - PHP5
 *
 * Adapted from the CodeIgniter Core Classes
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @link		http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of the HMVC design pattern.
 *
 * Install this file as application/libraries/Controller.php
 *
 * @copyright 	Copyright (c) Wiredesignz 2008-11-04
 * @version		5.1.39
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
class Controller
{
	/** Constructor **/
	public function __construct()
	{	
		/* set this controller name */
		$class = strtolower(get_class($this));
		
		/* create a new loader */
		$this->load = (class_exists('MX_Loader')) ? new MX_Loader($class) : new Loader($class);
		
		log_message('debug', ucfirst($class)." Controller Initialized");
		
		/* assign core libraries */
		$this->_assign_libraries();	
		
		/* register this controller */
		modules::$registry[$class] = $this;
		
		/* autoload module items */
		$this->load->autoload();
		
		/* activate output profiler from config */
		if ($this->config->item('enable_profiler')) $this->output->enable_profiler();
	}

	/** PHP4 compatibilty **/
	public function Controller()
	{
		self::__construct();
	}
	
	/** Return protected $autoload array **/
	public function _autoload()
	{
		return (isset($this->autoload)) ? $this->autoload : FALSE;
	}

	/** Assign core libraries **/
	private function _assign_libraries()
	{
		if ($core = end(modules::$registry))
		{			
			foreach (get_object_vars($core) as $key => $object)
	        {
				if (is_object($object) AND ! isset($this->$key)) 
					
					$this->$key = $object;	
	        }
        }
		else /* executes only for the first controller */
		{
			/* the CI core classes */
			$classes = array(
				'config'	=> 'Config',
				'input'		=> 'Input',
				'benchmark'	=> 'Benchmark',
				'uri'		=> 'URI',
				'output'	=> 'Output',
				'lang'		=> 'Language',
				'router'	=> 'Router',
			);
			
			/* assign the classes */
			foreach ($classes as $key => $class)
			{
				$this->$key = load_class($class);	
			}
			
			/* initialize CI_Base */
			CI_Base::__construct();
		}
	}
}

class Loader
{	
	public $_ci_classes;
	
	protected $_class, $_module;
	
	protected static $models, $autoload, $loader;
	
	public function __construct($class)
	{
		/* the class name */
		$this->_class = $class;
		
		/* the module name */
		$this->_module = modules::path();
		
		/* the CI_Loader is a singleton */
		(isset(self::$loader)) OR self::$loader = load_class('Loader');	
		
		/* get a reference to CI_Loader classes */
		$this->_ci_classes =& self::$loader->_ci_classes;
	}
	
	/** Load a module config file **/
	public function config($file = '', $use_sections = FALSE)
	{
		$ci = modules::$registry[$this->_class];
		
		($file == '') AND $file = 'config';

		if (in_array($file, $ci->config->is_loaded, TRUE))

			return $ci->config->item($file);

		list($path, $file) = modules::find($file, $this->_module, 'config/');
		
		if ($path === FALSE)
		{
			self::$loader->config($file, TRUE);
						
			return $ci->config->item($file);
		}
		
		if ($config = modules::load_file($file, $path, 'config'))
		{
			/* reference to the config object */
			$current_config =& $ci->config->config;

			if ($use_sections === TRUE)
			{
				if (isset($current_config[$file]))
				{
					$current_config[$file] = array_merge($current_config[$file], $config);
				}
				else
				{
					$current_config[$file] = $config;
				}
			}
			else
			{
				$current_config = array_merge($current_config, $config);
			}

			$ci->config->is_loaded[] = $file;

			unset($config);
			
			return $ci->config->item($file);
		}
	}

	/** Load the database drivers **/
	public function database($params = '', $return = FALSE, $active_record = FALSE)
	{
		if (class_exists('CI_DB', FALSE) AND $return == FALSE AND $active_record == FALSE)

			return;

		require_once BASEPATH.'database/DB'.EXT;

		if ($return === TRUE)

			return DB($params, $active_record);
			
		$ci = modules::$registry[$this->_class];

		$ci->db = get_instance()->db = DB($params, $active_record);

		$this->_ci_assign_to_models();
		
		return $ci->db;
	}

	/** Load dbforge **/
	public function dbforge()
	{
		self::$loader->dbforge();
		
		$ci = modules::$registry[$this->_class];
		
		$ci->dbforge = get_instance()->dbforge;
		
		return $ci->dbforge;
	}

	/** Load dbutil **/
	public function dbutil()
	{
		self::$loader->dbutil();
		
		$ci = modules::$registry[$this->_class];
		
		$ci->dbutil = get_instance()->dbutil;
		
		$ci->dbforge = get_instance()->dbforge;
		
		return $ci->dbutil;
	}

	/** Load files **/
	public function file($path, $return = FALSE)
	{
		return self::$loader->file($path, $return);
	}

	/** Load a module helper **/
	public function helper($helper)
	{
		if (is_array($helper)) return $this->helpers($helper);
		
		if (isset(self::$loader->_ci_helpers[$helper]))

			return;

		list($path, $_helper) = modules::find($helper.'_helper', $this->_module, 'helpers/');

		if ($path === FALSE)

			return self::$loader->helper($helper);

		modules::load_file($_helper, $path);

		self::$loader->_ci_helpers[$_helper] = TRUE;
	}

	/** Load an array of helpers **/
	public function helpers($helpers)
	{
		foreach ($helpers as $_helper) $this->helper($_helper);	
	}

	/** Load a module language file **/
	public function language($langfile, $lang = '')
	{
		$ci = modules::$registry[$this->_class];
		
		$deft_lang = $ci->config->item('language');

		$idiom = ($lang == '') ? $deft_lang : $lang;
	
		if (in_array($langfile.'_lang'.EXT, $ci->lang->is_loaded, TRUE))

			return $ci->lang;
		
		list($path, $_langfile) = modules::find($langfile.'_lang', $this->_module, 'language/', $idiom);

		if ($path === FALSE)
		{
			self::$loader->language($langfile, $lang);
		}
		else
		{
			if($lang = modules::load_file($_langfile, $path, 'lang'))
			{
				$ci->lang->language = array_merge($ci->lang->language, $lang);
	
				$ci->lang->is_loaded[] = $langfile.'_lang'.EXT;
	
				unset($lang);
			}
		}
		
		return $ci->lang;
	}

	/** Load a module library **/
	public function library($library, $params = NULL, $object_name = NULL)
    {
		$ci = modules::$registry[$this->_class];
		
		$class = strtolower(end(explode('/', $library)));
		
		if (isset($this->_ci_classes[$class]) AND $_alias = $this->_ci_classes[$class]) 
		
			return $ci->$_alias;
			
		($_alias = $object_name) OR $_alias = $class;
	
		list($path, $_library) = modules::find($library, $this->_module, 'libraries/');
		
		if ($path === FALSE)
        {
			self::$loader->_ci_load_class($library, $params, $object_name);

			$_alias = $this->_ci_classes[$class];
			
			$ci->$_alias = get_instance()->$_alias;
     	}
		else
		{	
			/* load module config file as params */
			if ($params == NULL)
			{
				list($path2, $file) = modules::find($_alias, $this->_module, 'config/');
				
				($path2) AND $params = modules::load_file($file, $path2, 'config');
			}			
			
			modules::load_file($_library, $path);
			
			$library = ucfirst($_library);
			
			$ci->$_alias = new $library($params);
			
			$this->_ci_classes[$class] = $_alias;
		}

		$ci->$_alias->CI = $ci;
		
		$this->_ci_assign_to_models();
		
		return $ci->$_alias;
    }

	/** Load a module model **/
	public function model($model, $object_name = NULL, $connect = FALSE)
	{
		$ci = modules::$registry[$this->_class];

		($_alias = $object_name) OR $_alias = strtolower(end(explode('/', $model)));
		
		if (isset(self::$models[$_alias]))

			return $ci->$_alias;
		
		list($path, $model) = modules::find($model, $this->_module, 'models/');

		(class_exists('Model', FALSE)) OR load_class('Model', FALSE);

		if ($connect !== FALSE) 
		{
			if ($connect === TRUE) $connect = '';
			
			$this->database($connect, FALSE, TRUE);
		}

		modules::load_file($model, $path);

		$model = ucfirst($model);
		
		$ci->$_alias = new $model();
		
		self::$models[$_alias] = $ci->$_alias;
		
		$ci->$_alias->_assign_libraries();
	
		return $ci->$_alias;
	}

	/** Load a module controller **/
	public function module($module)
	{
		if (is_array($module)) return $this->modules($module);
		
		$ci = modules::$registry[$this->_class];

		/* get the controller name */
		$controller = strtolower(end(explode('/', $module)));

		(isset($ci->$controller)) OR $ci->$controller = modules::load($module);
			
		return $ci->$controller;
	}

	/** Load an array of controllers **/
	public function modules($modules)
	{
		foreach ($modules as $_module) $this->module($_module);	
	}

	/** Load a module plugin **/
	public function plugin($plugin)
	{
		if (isset(self::$loader->_ci_plugins[$plugin]))

			return;

		list($path, $_plugin) = modules::find($plugin.'_pi', $this->_module, 'plugins/');	
		
		if ($path === FALSE) 
	
			return self::$loader->plugin($plugin);

		modules::load_file($_plugin, $path);

		self::$loader->_ci_plugins[$plugin] = TRUE;
	}

	/** Load scripts **/
	public function script($scripts = array())
	{
		return self::$loader->script($scripts);
	}

	/** Load variables into output buffer **/
	public function vars($vars = array())
	{
		return self::$loader->vars($vars);
	}

	/** Load a module view **/
	public function view($view, $vars = array(), $return = FALSE)
	{
		list($path, $view) = modules::find($view, $this->_module, 'views/');

		self::$loader->_ci_view_path = $path;

		return self::$loader->_ci_load(array('_ci_view' => $view, '_ci_vars' => self::$loader->_ci_object_to_array($vars), '_ci_return' => $return));
	}

	/** Assign libraries to models **/
	public function _ci_assign_to_models()
	{
		if (is_array(self::$models))
		{
			foreach (self::$models as $model)
			{
				$model->_assign_libraries();
			}
		}
	}

	/** Autload items **/
	public function autoload()
	{
		/* process application autoload */
		if ( ! isset(self::$autoload) AND self::$autoload = TRUE) 
		{
			self::$loader->_ci_autoloader();
		}
		
		$ci = modules::$registry[$this->_class];
		
		/* controller autoload array */
		($autoload = $ci->_autoload()) OR $autoload = array();
		
		list($path, $file) = modules::find('autoload', $this->_module, 'config/');
		
		/* module autoload file */
		if ($path != FALSE)
		{				
			$autoload = array_merge(modules::load_file($file, $path, 'autoload'), $autoload);
		}
		
		/* autoload database & libraries */
		if (isset($autoload['libraries']))
		{
			if (in_array('database', $autoload['libraries']))
			{
				/* autoload database */
				if ( ! $db = $ci->config->item('database'))
				{
					$db['params'] = 'default';
					$db['active_record'] = TRUE;
				}

				$ci->db = $this->database($db['params'], TRUE, $db['active_record']);

				$autoload['libraries'] = array_diff($autoload['libraries'], array('database'));
			}

			/* autoload libraries */
			foreach ($autoload['libraries'] as $library)
			{
				$this->library($library);
			}
		}		
				
		/* autoload config */
		if (isset($autoload['config']))
		{
			foreach ($autoload['config'] as $key => $val)
			{
				$this->config($val, TRUE);
			}
		}

		/* autoload helpers, plugins, scripts, languages */
		foreach (array('helper', 'plugin', 'script', 'language') as $type)
		{
			if (isset($autoload[$type]))
			{
				foreach ($autoload[$type] as $item)
				{
					$this->$type($item);
				}
			}
		}

		/* autoload base classes */
		if (isset($autoload['class']))
		{
			foreach ($autoload['class'] as $class)
			{
				modules::autoload($class);
			}
		}		

		/* autoload models */
		if (isset($autoload['model']))
		{
			foreach ($autoload['model'] as $model => $alias)
			{
				(is_numeric($model)) ? $this->model($alias) : $this->model($model, $alias);
			}
		}

		/* autoload module controllers */
		if (isset($autoload['modules']) AND ! in_array($this->_class, $autoload['modules']))
		{
			foreach ($autoload['modules'] as $module)
			{
				$this->module($module);
			}
		}
	}
}
