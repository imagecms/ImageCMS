<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	function media_url($url = '')
	{
		$CI =& get_instance();
		$config = $CI->config;

		if (is_array($url))
		{
			$uri = implode('/', $url);
		}

		$index_page = $config->slash_item('index_page');
		if($index_page === '/')
			$index_page = '';

		$return = $config->slash_item('static_base_url').$index_page.preg_replace("|^/*(.+?)/*$|", "\\1", $url);
		return $return;
	}

    function whereami(){
        $CI =& get_instance();
        if($CI->uri->segment(1))
            return 'inside';
        else
            return 'mainpage';
    }
    
