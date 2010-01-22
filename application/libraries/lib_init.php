<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_init {

	public function Lib_init()
	{
        $CI =& get_instance();

        log_message('debug', "Lib_init Class Initialized");

        if (file_exists(APPPATH.'modules/install/install.php') AND $CI->config->item('is_installed') !== TRUE)
        {
            if ($CI->uri->segment(1) != 'install')
            {
                header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."/install");
            }
        }
        else
        {
            // Load DB
            $CI->load->database();

            // Load hooks lib
            $CI->load->library('cms_hooks');
        }

		$native_session = TRUE;

		// Cache engine
		// $CI->load->library('mem_cache','','cache');
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
    }

}

/* End of file lib_init.php */
