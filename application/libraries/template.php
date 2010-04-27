<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image CMS
 * Template Class
 */

require 'mabilis/Mabilis.class.php';

class Template extends Mabilis {

    public $template_vars = array();

	function Template()
	{
		$this->CI =& get_instance();

        ($hook = get_hook('lib_template_init')) ? eval($hook) : NULL;

		//$this->compile_dir = BASEPATH.'cache/templates_c/';
		//$this->template_dir = TEMPLATES_PATH.$this->CI->config->item('template').'/';
		$this->modules_template_dir = TEMPLATES_PATH.'modules/';

        $cnf = $this->CI->load->config('template_conf', TRUE);

        $config = array(
            'tpl_path'        => TEMPLATES_PATH.$this->CI->config->item('template').'/',
            'compile_path'    => $cnf['compile_path'],
            'force_compile'   => $cnf['force_compile'],
            'compiled_ttl'    => $cnf['compiled_ttl'],
            'compress_output' => $cnf['compress_output'],
            'use_filemtime'   => $cnf['use_filemtime']
            );

        ($hook = get_hook('lib_template_set_conf')) ? eval($hook) : NULL;

        $this->load_config($config);

        $this->template_dir = $config['tpl_path'];

		$this->assign('JS_URL', base_url().'js'); //URL to JS folder
		$this->assign('THEME', base_url().'templates/'.$this->CI->config->item('template')); //URL to template folder

        // Assign CI instance
        $this->assign('CI', $this->CI);

        ($hook = get_hook('lib_template_init_end')) ? eval($hook) : NULL;
	}

    function assign($key, $value)
    {
        $this->template_vars[$key] = $value;
    }

	/**
	 * Add array to template data
	 *
	 * @arr array
	 * @return bool
	 */
	function add_array($arr)
    {
		if (count($arr) > 0)
		{
            $this->template_vars = array_merge($this->template_vars, $arr);

            return TRUE;
		}
		return FALSE;
	}

	/**
	 * Display template file included in main.tpl if $load_main is TRUE
	 *
	 * @access public
	 * @return true
	 */
	function show($file = FALSE, $load_main = TRUE, $data = array())
	{
        ($hook = get_hook('lib_template_show')) ? eval($hook) : NULL;

		$this->assign('BASE_URL', site_url()); //Base URL

        if (count($data) > 0) $this->add_array($data);

	    if ($file != FALSE)
		{
			$this->add_array(array('content' => $this->fetch($file.'.tpl')));
		}
       
        
        ob_start();
        $load_main == TRUE ? $this->view('main.tpl', $this->template_vars): $this->view($file.'.tpl', $this->template_vars);
        $result = ob_get_contents();
        ob_end_clean();

        $result = $this->splitTplFiles($result);
        echo $result;
    }

    function clear_all_assign()
    {
        $this->template_vars = array();
    }

	function get_var($var)
	{
        return $this->template_vars[$var];
	}

    function run_info()
    {
        ($hook = get_hook('lib_template_run_info')) ? eval($hook) : NULL;

		/************************/
		echo '<!--';
		echo 'Total Time:'.$this->CI->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end').', ';
		echo 'Queries: '.$this->CI->db->total_queries();
		echo ', Cache get: '.$this->CI->cache->get;
		echo ', Cache set: '.$this->CI->cache->set;
		echo ', Memory Usage: '.round(memory_get_usage()/1024/1024, 4).' Mb' ;
		echo ' -->';
		/************************/
    }

	/**
	 * Fetch file
	 *
	 * @access public
	 */
	function read($file = FALSE, $data = array())
    {
        if (count($data) > 0)
        {
            $this->add_array($data);
        }

		$this->assign('BASE_URL',site_url()); //Base URL
		return $this->view($file.'.tpl', $this->template_vars, TRUE);
    }
 
    function fetch($file = FALSE, $data = array())
    {
        if (count($data) > 0)
        {
            $this->add_array($data);
        }

		$this->assign('BASE_URL',site_url()); //Base URL
        return $this->view($file.'.tpl', $this->template_vars, TRUE);
    }

    function display($file, $data = array())
    {
        if (count($data) > 0)
        {
            $this->add_array($data);
        }

		$this->assign('BASE_URL',site_url()); //Base URL
        return $this->view($file.'.tpl', $this->template_vars);
    }

    private $_css_files = array();
    private $_js_files = array();
    private $_js_code = array();
    private $_css_code = array();
    private $_css_code_pos = array();
    private $_js_code_pos = array();

    public function registerCssCode($name, $code, $position = 'before')
    {
        $position = $this->_check_postion($position); 
        $this->_css_code[$name] = $code;
        $this->_css_code_pos[$name] = $position;
    }

    public function registerJsCode($name, $code, $position = 'before')
    {
        $position = $this->_check_postion($position); 
        $this->_js_code[$name] = $code;
        $this->_js_code_pos[$name] = $position;
    }

    // $position possible values: before, after
    public function registerCssFile($url, $position = 'before')
    {
        $position = $this->_check_postion($position);
        $this->_css_files[media_url($url)] = $position;
    }

    public function registerJsFile($url, $position = 'before')
    {
        $position = $this->_check_postion($position);
        $this->_js_files[media_url($url)] = $position; 
    }

    private function _check_postion($position)
    {
        if ($position != 'before' AND $position != 'after') echo '!';
        return $position;
    }

    private function splitTplFiles($tpl)
    {
        $result_before = '';
        $result_after = '';
        $result_css_before = '';
        $result_css_after = '';
        $result_js_before = '';
        $result_js_after = '';

        // split css files
        if (count($this->_css_files) > 0)
        {
            foreach ($this->_css_files as $url => $pos)
            {
                switch ($pos)
                {
                    case 'before':
                    $result_before .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$url\" />\n";
                    break;
                    case 'after':
                    $result_after .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$url\" />\n";
                    break;
                }
            }
        }

        // split js files
        if (count($this->_js_files) > 0)
        {
            foreach ($this->_js_files as $url => $pos)
            {
                switch ($pos)
                {
                    case 'before':
                    $result_before .= "<script type=\"text/javascript\" src=\"$url\"></script>\n";
                    break;
                    case 'after':
                    $result_after .= "<script type=\"text/javascript\" src=\"$url\"></script>\n";  
                    break;
                }
            }
        }


        // split css code
        if (count($this->_css_code ) > 0)
        {
            foreach ($this->_css_code as $key => $code)
            {
                switch ($this->_css_code_pos[$key])
                {
                    case 'before':
                    $result_css_before .= "$code\n";
                    break;
                    case 'after':
                    $result_css_after .= "$code\n";  
                    break;
                }
            }
        }

        // split js code
        if (count($this->_js_code ) > 0)
        {
            foreach ($this->_js_code as $key => $code)
            {
                switch ($this->_js_code_pos[$key])
                {
                    case 'before':
                    $result_js_before .= "$code\n";
                    break;
                    case 'after':
                    $result_js_after .= "$code\n";  
                    break;
                }
            }
        }

        if ($result_before)
            $result = preg_replace('/\<\/head\>/', $result_before.'</head>'."\n", $tpl,1);

        if ($result_after)
            $result = preg_replace('/\<\/html\>/', "</html>\n".$result_after, $result,1);


        if ($result_js_before)
        {
            $result_js_before = "<script type=\"text/javascript\">\n$result_js_before\n</script>\n";
            $result = preg_replace('/\<\/head\>/', $result_js_before."</head>\n", $result,1);
        }

        if ($result_js_after)
        {
            $result_js_after = "<script type=\"text/javascript\">\n$result_js_after\n</script>\n";
            $result = preg_replace('/\<\/html\>/', "</html>\n".$result_js_after, $result, 1);
        }

        if ($result_css_before)
        {
            $result_css_before = "<style type=\"text/css\">\n$result_css_before\n</style>\n";
            $result = preg_replace('/\<\/head\>/', $result_css_before."</head>\n", $result,1);
        } 
    
        if ($result_css_after)
        {
            $result_css_after = "<style type=\"text/css\">\n$result_css_after\n</style>\n";            
            $result = preg_replace('/\<\/html\>/', "</html>\n".$result_css_after, $result, 1);
        }

        if ($result == null) return $tpl;

        return $result;
    }

}

/* End of template.php */
