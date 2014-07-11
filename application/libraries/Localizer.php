<?php

/**
 * @property CI $CI
 */
class Localizer {
    /**
     * System locale
     * @var string 
     */

    const SYSTEM_LOCALE = 'en';

    /**
     * Codeigniter object
     * @var CI 
     */
    private $CI;

    /**
     * Settings from localizer config
     * @var array 
     */
    private static $LOCALIZER_SETTINGS;

    /**
     * Doamin locale 
     * @var string 
     */
    private static $DOMAIN_LOCALE;

    /**
     * Domain settings array
     * @var array 
     */
    private static $DOMAIN_SETTINGS;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->config('localizer');

        self::$LOCALIZER_SETTINGS = $this->CI->config->item('localizer');
        self::$DOMAIN_LOCALE = $this->getDomainTL();
        self::$DOMAIN_SETTINGS = isset(self::$LOCALIZER_SETTINGS[self::$DOMAIN_LOCALE]) ? self::$LOCALIZER_SETTINGS[self::$DOMAIN_LOCALE] : self::$LOCALIZER_SETTINGS[self::SYSTEM_LOCALE];
    }

    /**
     * Call unexisting methods(like - getLocale(), where Locale - domain settings key)
     * @param string $name - method name
     * @return null
     */
    public function __call($name, $arguments) {
        if (strpos($name, 'get') === 0) {
            $property = lcfirst(substr($name, 3));
            return isset(self::$DOMAIN_SETTINGS[$property]) ? self::$DOMAIN_SETTINGS[$property] : NULL;
        } else {
            return NULL;
        }
    }

    /**
     * Get current locale 
     * @return string
     */
    public function getLocale() {
        $languages = $this->CI->db->select('identif')->get('languages')->result_array();
        $first_segment = $this->CI->uri->segment(1);

        $uri_locale = NULL;
        foreach ($languages as $language) {
            if ($first_segment == $language['identif']) {
                $uri_locale = $language['identif'];
                break;
            }
        }
        return $uri_locale ? $uri_locale : self::$DOMAIN_SETTINGS['locale'];
    }

    /**
     * Get default domain locale
     * @return string
     */
    public function getDefaultLocale() {
        return self::$DOMAIN_SETTINGS['locale'];
    }

    /**
     * Get domain top level name
     * @return string
     */
    private function getDomainTL() {
        $domain = $_SERVER['HTTP_HOST'];
        $domain_locale = array_pop(explode('.', $domain));

        return $domain_locale;
    }

    /**
     * Get domain settings
     * @return array
     */
    public function getSettings() {
        return self::$DOMAIN_SETTINGS;
    }

}