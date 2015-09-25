<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

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

    public static $LANG;

    protected static $DOMAINS_TRANSLATORS = [];

    /**
     * The constructor initialize the library
     *
     * @return MY_Lang
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return string
     */
    private function getAdminLocale() {
        $locale = CI::$APP->config->item('language');
        return $locale ? $locale : 'ru_RU';
    }

    /**
     *
     * @param string $language
     * @return array
     */
    private function getFrontLangCode($language) {
        $languages = CI::$APP->db->select('lang_name, identif, locale')->get('languages');
        $languages = $languages ? $languages->result_array() : [];

        foreach ($languages as $lang) {
            if (in_array($language, $lang)) {
                return [$lang['identif'], $lang['locale']];
            }
        }

        return ['ru', 'ru_RU'];
    }

    private function _init() {
        if (!strstr(CI::$APP->input->server('REQUEST_URI'), 'install')) {
            if (null == CI::$APP->db) {
                $error = &load_class('Exceptions', 'core');
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
     * @access    public
     * @param    mixed    the name of the language file to be loaded. Can be an array
     * @param    string    the language (english, etc.)
     * @return    mixed
     */
    public function load($module = 'main') {
        $this->_init();

        if (strstr(uri_string(), 'admin')) {
            $lang = $this->getAdminLocale();
            if (!$module) {
                $module = 'admin';
            }
        } else {
            if (strstr(CI::$APP->input->server('REQUEST_URI'), 'install')) {
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
            $template_name = CI_Controller::get_instance()->config->item('template');
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
     * @access    public
     * @param    string $origin the language line
     * @return    string
     */
    public function line($origin = '', $params = FALSE) {
        $origin = str_replace('$', "\\$", $origin);
        $translation = gettext($origin);
        $origin = str_replace('\$', '$', $translation);

        return $translation ? $translation : $origin;
    }

    /**
     * Set locale
     * @param string $lang
     */
    public static function setLang($lang) {
        self::$LANG = $lang;
    }

    /**
     * Switch on using translation mo-file
     * @param $domain - mo-file identifier
     */
    public static function switchDomain($domain) {
        textdomain(getMoFileName($domain));
    }

    /**
     * Returns translation string
     * @param $origin - string to translate
     * @param string $domain - mo-file identifier
     * @return string
     */
    public static function getTranslation($origin, $domain = "main") {
        return self::isNewPHP() ? self::getTranslationForNewPHP($origin, $domain) : self::getTranslationForOldPHP($origin, $domain);
    }

    /**
     * Check is php version is more than or equal 5.5.0
     * @return bool
     */
    protected static function isNewPHP() {
        return (version_compare(PHP_VERSION, '5.5.0') >= 0);
    }

    /**
     * Get translation for php version less then 5.5.0
     * @param $origin
     * @param string $domain
     * @return string
     */
    protected static function getTranslationForOldPHP($origin, $domain = "main") {
        $domain = (new translator\classes\PoFileManager())->prepareDomain($domain);

        self::switchDomain($domain);

        $translation = self::line($origin);

        self::switchDomain('main');

        return $translation;
    }

    /**
     * Get translation for php version more then on equal 5.5.0
     * @param $origin
     * @param string $domain
     * @return string
     */
    protected static function getTranslationForNewPHP($origin, $domain = "main") {
        if (self::$DOMAINS_TRANSLATORS[$domain]) {
            $translator = self::$DOMAINS_TRANSLATORS[$domain];
        } else {
            $translations = Gettext\Translations::fromMoFile(getMoFilePath($domain));
            $translator = (new Gettext\Translator())->loadTranslations($translations);

            self::$DOMAINS_TRANSLATORS[$domain] = $translator;
        }

        return $translator->gettext($origin);
    }

}