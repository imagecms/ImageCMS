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

		$this->assign('JS_URL',base_url().'js'); //URL to JS folder
		$this->assign('THEME',base_url().'templates/'.$this->CI->config->item('template')); //URL to template folder

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
        
        $load_main == TRUE ?  $this->view('main.tpl', $this->template_vars): $this->view($file.'.tpl', $this->template_vars);
        //$this->run_info();
		//$this->clear_all_assign(); 
    }

    function clear_all_assign()
    {
        $this->template_vars = array();
    }

	function get_var($var)
	{
        //return $this->get_vars($var);
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

}

/* End of template.php */
