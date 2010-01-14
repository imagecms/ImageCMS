<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('imagebox_headers'))
{
	function imagebox_headers()
    {
        $ci =& get_instance();

        if ($ci->config->item('imagebox_headers') !== TRUE )
        {
            $url = 'application/modules/imagebox/templates/js/lightbox/';

            $result = '<link rel="stylesheet" href="'.media_url($url.'css/lightbox.css').'" type="text/css" media="screen" />
            <script type="text/javascript" src="'.media_url($url.'js/prototype.lite.js').'"></script>
            <script type="text/javascript" src="'.media_url($url.'js/moo.fx.js').'"></script>
            <script type="text/javascript" src="'.media_url($url.'js/litebox-1.0.js').'"></script>
            <script type="text/javascript">
               window.onload = initLightbox; 
            </script>
            ';

            $ci->config->set_item('imagebox_headers', TRUE); 

            return $result;
        }
    }
}
