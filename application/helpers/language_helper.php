<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     CodeIgniter
 * @author      ExpressionEngine Dev Team
 * @copyright   Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license     http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since       Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Language Helpers
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/helpers/language_helper.html
 */
// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access  public
 * @param   string  the language line
 * @param   string  the id of the form element
 * @return  string
 */
if (!function_exists('lang')) {

    function lang($line, $domain = "main", $wraper = TRUE) {

        $poFileManager = new translator\classes\PoFileManager();
        $domain = $poFileManager->prepareDomain($domain);
        $line = str_replace('$', "\\$", $line);

        textdomain(getMoFileName($domain));

        $CI = & get_instance();
        $line_tmp = $line;
        $line = $CI->lang->line($line);

        if (!$line) {
            $line = $line_tmp;
        }
        $line = str_replace('\$', '$', $line);

        if ($wraper && defined('ENABLE_TRANSLATION_API')) {
            $line = "<translate origin='" . $line_tmp . "' domain='" . $domain . "'>" . $line . "</translate>";
        }

        textdomain(getMoFileName('main'));
        return $line;
    }

}
if (!function_exists('getMoFileName')) {

    /**
     * @return string
     */
    function getMoFileName($domain) {
        if ($domain) {
            if (isset($GLOBALS['MO_FILE_NAMES'][$domain])) {
                return $GLOBALS['MO_FILE_NAMES'][$domain];
            }

            if (!defined('CUR_LOCALE')) {
                $CI = & get_instance();

                if (strstr($CI->input->server('REQUEST_URI'), 'install')) {
                    $lang = $CI->config->item('language');

                    $locale = $lang ? $lang : 'ru_RU';
                } else {
                    if (strstr(uri_string(), 'admin')) {
                        $locale = $CI->config->item('language');
                    } else {
                        $currentLocale = MY_Controller::getCurrentLocale();
                        $language = $CI->db->where('identif', $currentLocale)->get('languages');
                        if ($language) {
                            $language = $language->row_array();
                        } else {
                            show_error($CI->db->_error_message());
                        }
                        $locale = $language['locale'];
                    }
                }

                define('CUR_LOCALE', $locale);
            } else {
                $locale = CUR_LOCALE;
            }

            $name = NULL;
            switch ($domain) {

                case 'main':
                    $searched = glob(correctUrl('./application/language/main/' . $locale) . '/' . $locale . '/LC_MESSAGES/main*.mo');
                    if (!empty($searched)) {
                        $name = str_replace('.mo', '', basename(array_pop($searched)));
                    }
                    break;
                default :
                    $module_path = correctUrl('./application/modules/' . $domain . '/language/' . $locale);
                    if (is_dir($module_path)) {
                        $searched = glob($module_path . '/' . $locale . '/LC_MESSAGES/' . $domain . '*.mo');
                        if (!empty($searched)) {
                            $name = str_replace('.mo', '', basename(array_pop($searched)));
                        }
                    } elseif (file_exists(TEMPLATES_PATH . $domain)) {
                        $searched = glob(TEMPLATES_PATH . $domain . '/language/' . $domain . '/' . $locale . '/LC_MESSAGES/' . $domain . '*.mo');
                        if (!empty($searched)) {
                            $name = str_replace('.mo', '', basename(array_pop($searched)));
                        }
                    }
                    break;
            }
            $GLOBALS['MO_FILE_NAMES'] = $GLOBALS['MO_FILE_NAMES'] ? $GLOBALS['MO_FILE_NAMES'] : array();
            $GLOBALS['MO_FILE_NAMES'][$domain] = $name;
            return $name;
        }
        return FALSE;
    }

}

if (!function_exists('correctUrl')) {

    /**
     * @param string $url
     *
     * @return string
     */
    function correctUrl($url) {
        if (MAINSITE) {
            if (!is_dir($url)) {
                $url = MAINSITE . str_replace('./', '/', $url);
            }
        }

        $last_slash_pos = strrpos($url, '/');
        $url = str_replace(substr($url, $last_slash_pos), '', $url);
        return $url;
    }

}

// select language identif from url address
if (!function_exists('chose_language')) {

    function chose_language() {

        $ci = &get_instance();
        $url = $ci->uri->uri_string();
        $url_arr = explode('/', $url);

        $languages = $ci->db->get('languages');

        if ($languages) {
            $languages = $languages->result_array();
        } else {
            show_error($ci->db->_error_message());
        }

        foreach ($languages as $l) {
            if (in_array($l['identif'], $url_arr)) {
                $lang = $l['identif'];
            }
        }

        if (!$lang) {
            $languages = $ci->db->where('default', 1)->get('languages');
            if ($languages) {
                $languages = $languages->row();
            } else {
                show_error($ci->db->_error_message());
            }
            $lang = $languages->identif;
        }

        return $lang;
    }

}

/**
 * @param string $flag
 */
function get_main_lang($flag = null) {
    $ci = & get_instance();
    if (!$ci->db) {
        return FALSE;
    }

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

    if ($flag == 'id') {
        return $lang_id;
    }

    if ($flag == 'identif') {
        return $lang_ident;
    }

    if ($flag == null) {
        return array('id' => $lang_id, 'identif' => $lang_ident);
    }
}

/*
 * Get admin locale name
 */

function get_admin_locale() {
    $ci = & get_instance();
    $admin_language = $ci->config->item('language');
    $all_languages = $ci->config->item('languages');

    return isset($all_languages[$admin_language][0]) ? $all_languages[$admin_language][0] : 'ru';
}

/**
 * Same as lang() function, but can adding data into line
 *
 * @param string $line
 * @param string $name textdomain name
 * @param string|array $data data for adding to line
 * @return string
 */
if (!function_exists('langf')) {

    /**
     * @param string $line
     *
     * @return string|null
     */
    function langf($line, $name = "main", array $data = array()) {
        $line = lang($line, $name);

        foreach ($data as $key => $value) {
            $line = str_replace('|' . $key . '|', $value, $line);
        }

        return $line;
    }

}

if (!function_exists('tlang')) {

    function tlang($line) {
        $CI = & get_instance();
        $name = $CI->config->item('template');

        return lang($line, $name);
    }

}

if (!function_exists('tlangf')) {

    function tlangf($line, array $data = array()) {
        $CI = & get_instance();
        $name = $CI->config->item('template');
        $line = lang($line, $name);

        foreach ($data as $key => $value) {
            $line = str_replace('|' . $key . '|', $value, $line);
        }

        return $line;
    }

}

if (!function_exists('getLanguage')) {

    function getLanguage($where_array = array()) {
        $languages = CI::$APP->db->where($where_array)->get('languages');
        return $languages ? $languages->row_array() : array();
    }

}

function current_language() {
    $language = MY_Controller::getCurrentLanguage();
    /* Return language code from locale */
    return strstr($language['locale'], '_', true);
}

if (!function_exists('pluralize')) {

    /**
     * examp:
     *      pluralize(112, 'пользоват/ель|eля|елей');
     *      pluralize(1, 'user/|s');
     *
     * @param int $count
     * @param string $string start/|(1)|(0,5+)|(2,3,4)
     *                          'пользоват/ель|eля|елей' or
     *                          'пользователь|пользователь|пользователей' or
     *                          'user/|s' or
     *                          'user|users'
     * @return string
     */
    function pluralize($count, $string) {
        $word = explode('/', $string);
        if (isset($word[1])) {
            $root = $word[0];
            $ends = explode('|', $word[1]);
        } else {
            $root = '';
            $ends = explode('|', $word[0]);
        }
        $numeric = (int) abs($count);
        $num = 2;
        if ($numeric % 100 == 1 || ($numeric % 100 > 20) && ( $numeric % 10 == 1 )) {
            $num = 0;
        }
        if ($numeric % 100 == 2 || ($numeric % 100 > 20) && ( $numeric % 10 == 2 )) {
            $num = 1;
        }
        if ($numeric % 100 == 3 || ($numeric % 100 > 20) && ( $numeric % 10 == 3 )) {
            $num = 1;
        }
        if ($numeric % 100 == 4 || ($numeric % 100 > 20) && ( $numeric % 10 == 4 )) {
            $num = 1;
        }
        return $root . (isset($ends[$num]) ? $ends[$num] : array_pop($ends));
    }

}
// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */