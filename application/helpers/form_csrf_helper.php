<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS csrf helper
 */


if (!function_exists('form_csrf'))
{
    function form_csrf()
    {
        $ci =& get_instance();

        $ci->load->library('lib_csrf');
        return $ci->lib_csrf->create_hidden_html();
    }
    function form_csrf_code()
    {
        $ci =& get_instance();

        $ci->load->library('lib_csrf');
        return $ci->lib_csrf->create_hidden_html(true);        
    }
}
