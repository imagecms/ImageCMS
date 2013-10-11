<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Language Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/language_helper.html
 */
// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
if (!function_exists('lang')) {

    function lang($line, $name = "main", $id = '') {
        
        textdomain($name);
        $CI = & get_instance();
        $line_tmp = $line;
        $line = $CI->lang->line($line);
        if(!$line)
            return $line_tmp;

        if ($id != '') {
//            $line = '<label for="' . $name . '">' . $line . "</label>";
        }

        textdomain('main');
        return $line;
    }

}

// select language identif from url address
if (!function_exists('chose_language')) {

    function chose_language() {

        $ci = &get_instance();
        $url = $ci->uri->uri_string();
        $url_arr = explode('/', $url);

        $languages = $ci->db->get('languages');

        if ($languages)
            $languages = $languages->result_array();

        foreach ($languages as $l)
            if (in_array($l['identif'], $url_arr))
                $lang = $l['identif'];

        if (!$lang) {
            $languages = $ci->db->where('default', 1)->get('languages')->row();
            $lang = $languages->identif;
        }

        return $lang;
    }

}

function get_main_lang($flag = null) {
    $ci = & get_instance();
    $lang = $ci->db->get('languages')->result_array();
    $lan_array = array();
    foreach ($lang as $l) {
        $lan_array[$l['identif']] = $l['id'];
        $lan_array_rev[$l['id']] = $l['identif'];
    }

    $lang_uri = $ci->uri->segment(1);
    if (in_array($lang_uri, $lan_array_rev)) {
        $lang_id = $lan_array[$lang_uri];
        $lang_ident = $lang_uri;
    } else {
        $lang = $ci->db->where('default', 1)->get('languages')->result_array();
        $lang_id = $lang[0]['id'];
        $lang_ident = $lang[0]['identif'];
    }
    if ($flag == 'id')
        return $lang_id;
    if ($flag == 'identif')
        return $lang_ident;
    if ($flag == null)
        return array('id' => $lang_id, 'identif' => $lang_ident);
}
/*
 * Get admin locale name
 */
function get_admin_locale(){
    $ci = & get_instance();
    $admin_language = $ci->config->item('language');
    $all_languages = $ci->config->item('languages');
    
    return isset($all_languages[$admin_language][0]) ? $all_languages[$admin_language][0] : 'ru';
    
}


// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */