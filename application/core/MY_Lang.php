<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Code Igniter Gettext Extension library
 *
 * This Library overides the original CI's language class. Needs the  $config['language'] variable set as it_IT or en_EN or fr_FR ...
 *
 * @package       Gettext Extension
 * @author        wokamoto
 * @copyright     Copyright (c) 2012
 * @license       http://www.gnu.org/licenses/lgpl.txt
 * @link
 * @version       Version 0.1
 * @since         2012 January, 27th
 */
// ------------------------------------------------------------------------

/**
 * MY_Lang
 *
 * @package imaeloc
 * @author Mark0
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class MY_Lang extends MX_Lang {

    private $ci;
    public $gettext_language;
    private $gettext_codeset;
    public $gettext_domain;
    private $gettext_path;
    private $gettext = null;
    static $LANG;

    /**
     * The constructor initialize the library
     *
     * @return MY_Lang
     */
    function __construct() {
        parent::__construct();
        if (!extension_loaded('gettext')) {
            include_once('gettext/gettext.inc');
            $_SESSION['GETTEXT_EXIST'] = FALSE;
        } else {
            $_SESSION['GETTEXT_EXIST'] = TRUE;
        }
    }

    public function getAdminLocale() {
        $this->ci = & get_instance();
        $locale = $this->ci->config->item('language');
//        var_dumps($locale);
        return $locale ? $locale : 'ru_RU';
    }

    public function getDBFrontLanguages() {
        if (!isset($this->ci))
            $this->ci = & get_instance();

        $languages = $this->ci->db->select('lang_name, identif, locale')->get('languages');

        if ($languages) {
            return $languages->result_array();
        }
    }

    public function getFrontLangCode($language) {
        $languages = $this->getDBFrontLanguages();
        foreach ($languages as $lang) {
            if (in_array($language, $lang)) {
                return array($lang['identif'], $lang['locale']);
            }
        }

        return array('ru', 'ru_RU');
    }

    private function _init() {
        if (!isset($this->ci))
            $this->ci = & get_instance();

        if (!strstr($_SERVER['REQUEST_URI'], 'install')) {
            if (is_null($this->ci->db)) {
                $error = & load_class('Exceptions', 'core');
                echo $error->show_error('DB Error', 'Unable to connect to the database', 'error_db');
                exit;
            }

            $sett = $this->ci->db->where('s_name', 'main')->get('settings')->row();
            
            if ($sett->lang_sel) {
                $this->ci->config->set_item('language', str_replace('_lang', '', $sett->lang_sel));
            }
            $this->gettext_language = $this->ci->config->item('language');
        } else {
            if (!$this->ci->session->userdata('language')) {
                $this->ci->session->set_userdata('language', 'ru_RU');
            }
        }
    }

    private function _language() {
        static $language;

        if (!isset($this->ci))
            $this->ci = & get_instance();

        if (!isset($language)) {
            $language = $this->ci->config->item('language');
        }

        if (!isset($language) || !in_array($language, $this->ci->config->item('selectable_languages')))
            $language = 'english';

        if ($language != $this->ci->config->item('language'))
            $this->ci->config->set_item('language', $language);

        return empty($language) ? 'english' : $language;
    }

    /**
     * Load a language file
     *
     * @access	public
     * @param	mixed	the name of the language file to be loaded. Can be an array
     * @param	string	the language (english, etc.)
     * @return	mixed
     */
    public function load($module = 'main') {
        $this->_init();



        if (strstr(uri_string(), 'admin')) {
            $lang = $this->getAdminLocale();
            if (!$module) {
                $module = 'admin';
            }
        } else {
            if (strstr($_SERVER['REQUEST_URI'], 'install')) {
                $lang = $this->ci->session->userdata('language');
            } else {
                $languageFront = $this->getFrontLangCode(MY_Controller::getCurrentLocale());
                $lang = $languageFront[1];
            }
        }

//        var_dumps($lang);
        if (self::$LANG) {
            $lang = self::$LANG;
        }

        if ($module == 'main') {
            $this->addDomain(correctUrl('./application/language/main/' . $lang), getMoFileName('main'), $lang);
            $template_name = \CI_Controller::get_instance()->config->item('template');
            $this->addDomain('templates/' . $template_name . '/language/' . $template_name . '/', getMoFileName($template_name), $lang);
        } else {

            if ($module == 'admin') {
                $this->addDomain(correctUrl('./application/language/main/' . $lang), getMoFileName('main'), $lang);
            }

            $this->addDomain(correctUrl('./application/modules/' . $module . '/language/' . $lang), getMoFileName($module), $lang);
        }
    }

    /**
     * @param String $directory
     * @param String $domain
     * @param String $locale
     * @return mixed|void
     */
    public function addDomain($directory, $domain, $locale) {
        if (!setlocale(LC_ALL, $locale . '.utf8', $locale . '.utf-8', $locale . '.UTF8', $locale . '.UTF-8', $locale . '.utf-8', $locale . '.UTF-8', $locale)) {
            // Set current locale
            setlocale(LC_ALL, '');
        }
        putenv('LC_ALL=' . $locale);
        putenv('LANG=' . $locale);
        putenv('LANGUAGE=' . $locale);

        if (!extension_loaded('gettext')) {
            bindtextdomain($domain, $directory, $locale);
            $_SESSION['GETTEXT_EXIST'] = FALSE;
        } else {
            $_SESSION['GETTEXT_EXIST'] = TRUE;
            bindtextdomain($domain, $directory);
        }
    }

    public function switchDomain($directory, $domain, $locale) {
        $this->addDomain($directory, $domain, $locale);
        textdomain($domain);
    }

    /**
     * This method overides the original load method. Its duty is loading the domain files by config or by default internal settings.
     *
     * @access	public
     * @param	string	$userlang	the language, set as ja_JP or it_IT or en_EN or fr_FR ...
     * @param	string	$codeset	the codeset, set as UTF-8 or EUC ...
     * @return	bool
     */
    public function load_gettext($userlang = '', $codeset = '', $textdomain = 'lang', $path = '') {
        if (!isset($this->ci))
            $this->ci = & get_instance();

        $this->gettext_language = $this->language_select(!empty($userlang) ? $userlang : $this->_language());
        $this->gettext_codeset = !empty($codeset) ? $codeset : $this->ci->config->item('charset');
        $this->gettext_domain = $textdomain;
        $this->gettext_path = !empty($path) ? $path : APPPATH . 'language/locale';
        log_message('debug', 'Gettext Class language was set by parameter:' . $this->gettext_language . ',' . $this->gettext_codeset);

        /* put env and set locale */
        putenv("LANG={$this->gettext_language}");
        setlocale(LC_ALL, $this->gettext_language);

        /* bind text domain */

        $lang = 'en';
        $locale = 'en_US';

        if (!setlocale(LC_ALL, $locale . '.utf8', $locale . '.utf-8', $locale . '.UTF8', $locale . '.UTF-8', $lang . '.utf-8', $lang . '.UTF-8', $lang)) {
            // Set current locale
            setlocale(LC_ALL, '');
        }

        putenv('LC_ALL=' . $locale);
        putenv('LANG=' . $locale);
        putenv('LANGUAGE=' . $locale);

        $textdomain_path = bindtextdomain($this->gettext_domain, $this->gettext_path);
//                var_dump($textdomain_path);
        bind_textdomain_codeset($this->gettext_domain, $this->gettext_codeset);
        textdomain($this->gettext_domain);
        log_message('debug', 'Gettext Class path: ' . $textdomain_path);


        log_message('debug', 'Gettext Class the domain: ' . $this->gettext_domain);

        return true;
    }

    private function language_select($userlang = '') {
        $userlang = !empty($userlang) ? $userlang : $this->_language();

        switch ($userlang) {
            case 'japanese':
                $userlang = 'ja_JP';
                break;
            case 'english':
            default:
                $userlang = 'en';
                break;
        }
        return $userlang;
    }

    /**
     * Fetch a single line of text from the language array
     *
     * @access	public
     * @param	string	$line	the language line
     * @return	string
     */
    public function line($line = '', $params = FALSE) {
        return gettext($line);
    }

    /**
     *  Plural forms added by Tchinkatchuk
     *  http://www.codeigniter.com/forums/viewthread/2168/
     */

    /**
     * The translator method
     *
     * @access private
     * @param string $original the original string to translate
     * @param array $aParams the plural parameters
     * @return the string translated
     */
    private function _trans($original, $aParams = false) {
        if (!isset($this->gettext_domain))
            return false;

        if ($aParams && isset($aParams['plural']) && isset($aParams['count'])) {
            $sTranslate = ngettext($original, $aParams['plural'], $aParams['count']);
            $sTranslate = $this->replaceDynamically($sTranslate, $aParams);
        } else {
            $sTranslate = gettext($original);
            if (is_array($aParams) && count($aParams)) {
                $sTranslate = $this->replaceDynamically($sTranslate, $aParams);
            }
        }

        return $sTranslate;
    }

    /**
     * Allow dynamic allocation in traduction
     *
     * @final
     * @access private
     * @param  string $sString
     * @return string
     */
    private function replaceDynamically($sString) {
        $aTrad = array();
        for ($i = 1, $iMax = func_num_args(); $i < $iMax; $i++) {
            $arg = func_get_arg($i);
            if (is_array($arg)) {
                foreach ($arg as $key => $sValue) {
                    $aTrad['%' . $key] = $sValue;
                }
            } else {
                $aTrad['%' . $key] = $arg;
            }
        }

        return strtr($sString, $aTrad);
    }

    public static function setLang($lang) {
        self::$LANG = $lang;
    }

}
