<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

    function media_url($url = '')
    {
        $CI =& get_instance();
        $config = $CI->config;

		if (is_array($url))
		{
			$uri = implode('/', $url);
        }

        return $config->slash_item('static_base_url').$config->slash_item('index_page').preg_replace("|^/*(.+?)/*$|", "\\1", $url); 
    }
