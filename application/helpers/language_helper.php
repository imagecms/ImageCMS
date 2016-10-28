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

    function lang($line, $domain = 'main', $wrapper = TRUE) {

        $translation = MY_Lang::getTranslation($line, $domain);

        if ($wrapper && defined('ENABLE_TRANSLATION_API')) {
            $translation = "<translate origin='" . $line . "' domain='" . $domain . "'>" . $translation . '</translate>';
        }

        return $translation;
    }

}

if (!function_exists('getPoFileAttributes')) {

    /**
     * @param string $domain
     * @return array|bool
     */
    function getPoFileAttributes($domain) {

        if ($domain) {
            $CI = &get_instance();

            if (strstr($CI->input->serevr('HTTP_REFERER'), 'admin')) {
                $language = $CI->config->item('language');
                $locale = $language;
            } else {
                $currentLocale = MY_Controller::getCurrentLocale();
                $language = $CI->db->where('identif', $currentLocale)->get('languages');
                $language = $language->row_array();
                $locale = $language['locale'];
            }

            if ($locale) {
                $attributes = [];

                switch ($domain) {
                    case 'main':
                        $attributes = [
                                       'name' => 'main',
                                       'type' => 'main',
                                       'lang' => $locale,
                                      ];
                        break;
                    default :
                        if (moduleExists($domain)) {
                            $attributes = [
                                           'name' => $domain,
                                           'type' => 'modules',
                                           'lang' => $locale,
                                          ];
                        } elseif (file_exists('./templates/' . $domain)) {
                            $attributes = [
                                           'name' => $domain,
                                           'type' => 'templates',
                                           'lang' => $locale,
                                          ];
                        }
                        break;
                }
                return $attributes;
            }
        }
        return FALSE;
    }

}

if (!function_exists('getModulePathForTranslator')) {

    /**
     *
     * @param string $module_name
     * @return string
     */
    function getModulePathForTranslator($module_name) {

        $module_path = getModulePath($module_name);

        if (MAINSITE) {
            $module_path = str_replace(MAINSITE, '.', $module_path);
        }

        return $module_path;
    }

}


if (!function_exists('getMoFileName')) {

    /**
     * @param string $domain
     * @return string
     */
    function getMoFileName($domain) {

        if ($domain) {
            if (array_key_exists('MO_FILE_NAMES', $GLOBALS) && array_key_exists($domain, $GLOBALS['MO_FILE_NAMES'])) {
                return $GLOBALS['MO_FILE_NAMES'][$domain];
            }

            $GLOBALS['MO_FILE_NAMES'] = array_key_exists('MO_FILE_NAMES', $GLOBALS) && $GLOBALS['MO_FILE_NAMES'] ? $GLOBALS['MO_FILE_NAMES'] : [];
            $GLOBALS['MO_FILE_NAMES'][$domain] = str_replace('.mo', '', basename(getMoFilePath($domain)));
            return $GLOBALS['MO_FILE_NAMES'][$domain];
        }
        return FALSE;
    }

}

if (!function_exists('getMoFilePath')) {

    /**
     * @param string $domain
     * @return string
     */
    function getMoFilePath($domain) {

        if ($domain) {
            if (!defined('CUR_LOCALE')) {
                $CI = &get_instance();

                if (strstr($CI->input->server('REQUEST_URI'), 'install')) {
                    $lang = $CI->config->item('language');

                    $locale = $lang ?: 'ru_RU';
                } else {
                    if (strstr(uri_string(), 'admin')) {
                        $locale = $CI->config->item('language');
                    } else {

                        $locale = MY_Controller::getCurrentLanguage('locale');
                    }
                }

                define('CUR_LOCALE', $locale);
            } else {
                $locale = CUR_LOCALE;
            }

            switch ($domain) {
                case 'main':
                    $searched = glob(correctUrl('./application/language/main/' . $locale) . '/' . $locale . '/LC_MESSAGES/main*.mo');
                    if (!empty($searched)) {
                        $filePath = array_pop($searched);
                    }
                    break;
                default :
                    $module_path = correctUrl('./application/modules/' . $domain . '/language/' . $locale);
                    if (is_dir($module_path)) {
                        $searched = glob($module_path . '/' . $locale . '/LC_MESSAGES/' . $domain . '*.mo');
                        if (!empty($searched)) {
                            $filePath = array_pop($searched);
                        }
                    } elseif (file_exists(TEMPLATES_PATH . $domain)) {
                        $searched = glob(TEMPLATES_PATH . $domain . '/language/' . $domain . '/' . $locale . '/LC_MESSAGES/' . $domain . '*.mo');
                        if (!empty($searched)) {
                            $filePath = array_pop($searched);
                        }
                    }
                    break;
            }

            return $filePath;
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
            $url = MAINSITE . str_replace('./', '/', $url);
        }

        $last_slash_pos = strrpos($url, '/');
        $url = str_replace(substr($url, $last_slash_pos), '', $url);
        return $url;
    }

}

// select language identif from url address
if (!function_exists('chose_language')) {

    /**
     * @param bool|FALSE $active
     * @return mixed
     */
    function chose_language($active = FALSE) {
        $ci = &get_instance();

        $url_arr = $ci->uri->segment_array();
        foreach ((array) MY_Controller::getAllLocales($active) as $l) {
            if (in_array($l, $url_arr)) {
                $lang = $l;
            }
        }

        if (!$lang) {
            $lang = MY_Controller::getDefaultLanguage()['identif'];
        }

        return $lang;
    }

}

/**
 * @param string $flag
 * @return array
 */
function get_main_lang($flag = null) {
    $ci = &get_instance();
    if (!$ci->db) {
        return FALSE;
    }

    $lang = $ci->db->get('languages')->result_array();
    $lan_array = [];
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
        return [
                'id'      => $lang_id,
                'identif' => $lang_ident,
               ];
    }
}

/**
 * Get admin locale name
 */
function get_admin_locale() {

    $ci = &get_instance();
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
     * @param string $name
     * @param array $data
     * @return null|string
     */
    function langf($line, $name = 'main', array $data = []) {

        $line = lang($line, $name);

        foreach ($data as $key => $value) {
            $line = str_replace('|' . $key . '|', $value, $line);
        }

        return $line;
    }

}

if (!function_exists('tlang')) {

    /**
     * @param string $line
     * @return string
     */
    function tlang($line) {

        $CI = &get_instance();
        $name = $CI->config->item('template');

        return lang($line, $name);
    }

}

if (!function_exists('tlangf')) {

    /**
     * @param string $line
     * @param array $data
     * @return mixed|string
     */
    function tlangf($line, array $data = []) {

        $CI = &get_instance();
        $name = $CI->config->item('template');
        $line = lang($line, $name);

        foreach ($data as $key => $value) {
            $line = str_replace('|' . $key . '|', $value, $line);
        }

        return $line;
    }

}

if (!function_exists('getLanguage')) {

    /**
     * @param array $where_array
     * @return array
     */
    function getLanguage($where_array = []) {

        $languages = CI::$APP->db->where($where_array)->get('languages');
        return $languages ? $languages->row_array() : [];
    }

}

if (!function_exists('current_language')) {

    /**
     * @return string
     */
    function current_language() {

        $language = MY_Controller::getCurrentLanguage();
        /* Return language code from locale */
        return strstr($language['locale'], '_', true);
    }

}
// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */