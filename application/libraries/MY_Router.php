<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* define the modules base path */
define('MODBASE', APPPATH.'modules/');

/* define the offset from application/controllers */
define('MODOFFSET', '../modules/');

/**
 * Modular Extensions - PHP5
 *
 * Adapted from the CodeIgniter Core Classes
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @link		http://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter router class.
 *
 * Install this file as application/libraries/MY_Router.php
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
class MY_Router extends CI_Router
{
	public function _validate_request($segments)
	{
		(isset($segments[1])) OR $segments[1] = NULL;

		/* locate the module controller */
		list($module, $controller) = Router::locate($segments);

		/* no controller found */
		($module === FALSE) AND show_404($controller);

		/* set the module directory */
		Router::$path = ($controller) ? $module : NULL ;

		/* set the module path */
		$path = ($controller) ? MODOFFSET.$module.'/' : NULL;

		$this->set_directory($path);

		/* remove the directory segment */
		if ($controller != $module AND $controller != NULL)

			$segments = array_slice($segments, 1);

		return $segments;
    }

    public function _set_routing()
    {
        // Load Modules custom routes
        $mod_dir = dir(MODBASE);
        while (FALSE !== ($mod_name = $mod_dir->read())) 
        {
            if($mod_name != '.' AND $mod_name != '..' AND file_exists(MODBASE.$mod_name.'/config/routes'.EXT) )
            {
                include(MODBASE.$mod_name.'/config/routes'.EXT); 
            }  
        }
        $mod_dir->close();

        /*  Copied from ./system/libraries/Router.php */ 

		// Are query strings enabled in the config file?
		// If so, we're done since segment based URIs are not used with query strings.
		if ($this->config->item('enable_query_strings') === TRUE AND isset($_GET[$this->config->item('controller_trigger')]))
		{
			$this->set_class(trim($this->uri->_filter_uri($_GET[$this->config->item('controller_trigger')])));

			if (isset($_GET[$this->config->item('function_trigger')]))
			{
				$this->set_method(trim($this->uri->_filter_uri($_GET[$this->config->item('function_trigger')])));
			}
			
			return;
		}
		
        // Load the routes.php file.
		@include(APPPATH.'config/routes'.EXT);
		$this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;
		unset($route);

		// Set the default controller so we can display it in the event
		// the URI doesn't correlated to a valid controller.
		$this->default_controller = ( ! isset($this->routes['default_controller']) OR $this->routes['default_controller'] == '') ? FALSE : strtolower($this->routes['default_controller']);	
		
		// Fetch the complete URI string
		$this->uri->_fetch_uri_string();
	
		// Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
		if ($this->uri->uri_string == '')
		{
			if ($this->default_controller === FALSE)
			{
				show_error("Unable to determine what should be displayed. A default route has not been specified in the routing file.");
			}
			
			if (strpos($this->default_controller, '/') !== FALSE)
			{
				$x = explode('/', $this->default_controller);

				$this->set_class(end($x));
				$this->set_method('index');
				$this->_set_request($x);
			}
			else
			{
				$this->set_class($this->default_controller);
				$this->set_method('index');
				$this->_set_request(array($this->default_controller, 'index'));
			}

			// re-index the routed segments array so it starts with 1 rather than 0
			$this->uri->_reindex_segments();
			
			log_message('debug', "No URI present. Default controller set.");
			return;
		}
		unset($this->routes['default_controller']);
		
		// Do we need to remove the URL suffix?
		$this->uri->_remove_url_suffix();
		
		// Compile the segments into an array
		$this->uri->_explode_segments();
		
		// Parse any custom routing that may exist
		$this->_parse_routes();		
		
		// Re-index the segment array so that it starts with 1 rather than 0
		$this->uri->_reindex_segments();
    }
}

class Router
{
	public static $path;

	/** Locate the controller **/
	public static function locate($segments)
    {
		list($module, $controller) = $segments;

		/* a module? */

		if ($module AND is_dir(MODBASE.$module))
		{
			($controller == NULL) AND $controller = $module;

			/* a module sub-controller? */
			if(is_file(MODBASE.$module.'/'.$controller.EXT))

				return array($module, $controller);

			/* a module controller? */
			return array($module, $module);
		}

		/* an application controller? */
		if (is_file(APPPATH.'controllers/'.$module.EXT))

			return array($module, NULL);

		/* no controller found */
		return array(FALSE, NULL);
	}
}
