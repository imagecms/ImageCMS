<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_init {

	public function __construct() {
        $CI =& get_instance();

        log_message('debug', "Lib_init Class Initialized");

        // Set timezone
        if (function_exists('date_default_timezone_set'))
        {
            date_default_timezone_set($CI->config->item('default_time_zone'));
        }

        if (file_exists(APPPATH.'modules/install/install.php') AND $CI->config->item('is_installed') !== TRUE)
        {
            if ($CI->uri->segment(1) != 'install')
            {
                redirect("/install");
            }
        }
        else
        {
            // Load DB
            $CI->load->database();

            // Load hooks lib
            $CI->load->library('cms_hooks');
        }

        // Fake function for hooks.
        if (!function_exists('get_hook'))
        {
            function get_hook()
            {
                return false;
            }
        }

		$native_session = TRUE;

		// Cache engine
		//$CI->load->library('mem_cache','','cache');
		$CI->load->library('cache');

		if($native_session == TRUE)
		{
			// Sessions engine should run on cookies to minimize opportunities
			// of session fixation attack
			ini_set('session.use_only_cookies', 1);

			$CI->load->library('native_session','','session');

		}else{
			$CI->load->library('session');
        }

        // Redirect to url with out ending slash
        $uri = $this->_detect_uri();
        $first_segment = $CI->uri->segment(1);
        if(substr($uri, -1, 1) === '/' && $first_segment !== 'admin' && $uri !== '/')
        {
            $get_params = '';
            if(!empty($_GET))
                $get_params = '?'.http_build_query($_GET);
            redirect(substr($uri,0,-1).$get_params, 'location', 301);
        }

        ($hook = get_hook('system_init_completed')) ? eval($hook) : NULL;
    }

    public function _detect_uri()
    {
        if ( ! isset($_SERVER['REQUEST_URI']))
        {
            return '';
        }

        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
        {
            $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
        }
        elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
        {
            $uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
        }

        // This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
        // URI is found, and also fixes the QUERY_STRING server var and $_GET array.
        if (strncmp($uri, '?/', 2) === 0)
        {
            $uri = substr($uri, 2);
        }
        $parts = preg_split('#\?#i', $uri, 2);
        $uri = $parts[0];
        if (isset($parts[1]))
        {
            $_SERVER['QUERY_STRING'] = $parts[1];
            parse_str($_SERVER['QUERY_STRING'], $_GET);
        }
        else
        {
            $_SERVER['QUERY_STRING'] = '';
            $_GET = array();
        }

        if ($uri == '/' || empty($uri))
        {
            return '/';
        }

        $uri = parse_url($uri, PHP_URL_PATH);
        return $uri;
    }

}

/* End of file lib_init.php */
