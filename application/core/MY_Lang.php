<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

    public $gettext_language;
    public $gettext_domain;
    static $LANG;

    /**
     * The constructor initialize the library
     *
     * @return MY_Lang
     */
    public function __construct() {
        parent::__construct();
    }

    private function getAdminLocale() {
        $locale = CI::$APP->config->item('language');
        return $locale ? $locale : 'ru_RU';
    }

    private function getFrontLangCode($language) {
        $languages = CI::$APP->db->select('lang_name, identif, locale')->get('languages');
        $languages = $languages ? $languages->result_array() : [];

        foreach ($languages as $lang) {
            if (in_array($language, $lang)) {
                return array($lang['identif'], $lang['locale']);
            }
        }

        return array('ru', 'ru_RU');
    }

    private function _init() {
        if (!strstr($_SERVER['REQUEST_URI'], 'install')) {
            if (is_null(CI::$APP->db)) {
                $error = & load_class('Exceptions', 'core');
                echo $error->show_error('DB Error', 'Unable to connect to the database', 'error_db');
                exit;
            }

            $sett = CI::$APP->db->where('s_name', 'main')->get('settings')->row();

            if ($sett->lang_sel) {
                CI::$APP->config->set_item('language', str_replace('_lang', '', $sett->lang_sel));
            }
            $this->gettext_language = CI::$APP->config->item('language');
        } else {
            if (!CI::$APP->session->userdata('language')) {
                CI::$APP->session->set_userdata('language', 'ru_RU');
            }
        }
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
                $lang = CI::$APP->session->userdata('language');
            } else {
                $languageFront = $this->getFrontLangCode(MY_Controller::getCurrentLocale());
                $lang = $languageFront[1];
            }
        }

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
    private function addDomain($directory, $domain, $locale) {
        if (!setlocale(LC_ALL, $locale . '.utf8', $locale . '.utf-8', $locale . '.UTF8', $locale . '.UTF-8', $locale . '.utf-8', $locale . '.UTF-8', $locale)) {
            // Set current locale
            setlocale(LC_ALL, '');
        }
        putenv('LC_ALL=' . $locale);
        putenv('LANG=' . $locale);
        putenv('LANGUAGE=' . $locale);
        bindtextdomain($domain, $directory);
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
     * Set locale
     * @param string $lang
     */
    public static function setLang($lang) {
        self::$LANG = $lang;
    }

}
