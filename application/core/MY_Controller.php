<?php

use CMSFactory\DependencyInjection\DependencyInjectionProvider;
use Doctrine\Common\Cache\CacheProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

/**
 * @property Core $core
 * @property CI_DB_active_record $db              This is the platform-independent base Active Record implementation class.
 * @property CI_DB_forge $dbforge                 Database Utility Class
 * @property CI_Benchmark $benchmark              This class enables you to mark points and calculate the time difference between them.<br />  Memory consumption can also be displayed.
 * @property CI_Calendar $calendar                This class enables the creation of calendars
 * @property CI_Config $config                    This class contains functions that enable config files to be managed
 * @property CI_Controller $controller            This class object is the super class that every library in.<br />CodeIgniter will be assigned to.
 * @property CI_Email $email                      Permits email to be sent using Mail, Sendmail, or SMTP.
 * @property CI_Encrypt $encrypt                  Provides two-way keyed encoding using XOR Hashing and Mcrypt
 * @property CI_Exceptions $exceptions            Exceptions Class
 * @property CI_Form_validation $form_validation  Form Validation Class
 * @property CI_Ftp $ftp                          FTP Class
 * @property CI_Hooks $hooks                      Provides a mechanism to extend the base system without hacking.
 * @property CI_Image_lib $image_lib              Image Manipulation class
 * @property CI_Input $input                      Pre-processes global input data for security
 * @property CI_Lang $lang                        Language Class
 * @property CI_Loader $load                      Loads views and files
 * @property CI_Log $log                          Logging Class
 * @property CI_Model $model                      CodeIgniter Model Class
 * @property CI_Output $output                    Responsible for sending final output to browser
 * @property CI_Pagination $pagination            Pagination Class
 * @property CI_Parser $parser                    Parses pseudo-variables contained in the specified template view,<br />replacing them with the data in the second param
 * @property CI_Profiler $profiler                This class enables you to display benchmark, query, and other data<br />in order to help with debugging and optimization.
 * @property CI_Router $router                    Parses URIs and determines routing
 * @property CI_Session $session                  Session Class
 * @property CI_Sha1 $sha1                        Provides 160 bit hashing using The Secure Hash Algorithm
 * @property CI_Table $table                      HTML table generation<br />Lets you create tables manually or from database result objects, or arrays.
 * @property CI_Trackback $trackback              Trackback Sending/Receiving Class
 * @property CI_Typography $typography            Typography Class
 * @property CI_Unit_test $unit_test              Simple testing class
 * @property CI_Upload $upload                    File Uploading Class
 * @property CI_URI $uri                          Parses URIs and determines routing
 * @property CI_User_agent $user_agent            Identifies the platform, browser, robot, or mobile devise of the browsing agent
 * @property CI_Form_validation $validation            //dead
 * @property CI_Xmlrpc $xmlrpc                    XML-RPC request handler class
 * @property CI_Xmlrpcs $xmlrpcs                  XML-RPC server class
 * @property CI_Zip $zip                          Zip Compression Class
 * @property CI_Javascript $javascript            Javascript Class
 * @property CI_Utf8 $utf8                        Provides support for UTF-8 environments
 * @property CI_Security $security                Security Class, xss, csrf, etc...
 * @property DX_Auth $dx_auth                     I know about dx_auth and don't need to write abouth them
 * @property Lib_csrf $lib_csrf
 * @property Template $template Description
 * @property Console $console Description
 * @property CI_DB_Cache $cache
 * @property CI_User_agent $agent
 */
class MY_Controller extends MX_Controller
{

    /**
     * @var bool
     */
    public $pjaxRequest = false;

    /**
     * @var bool
     */
    public $ajaxRequest = false;

    public static $currentLocale = null;

    public static $currentLangId = null;

    public static $currentLanguage = null;

    public static $detect_load_admin = [];

    public static $detect_load = [];

    /**
     * @var array
     */
    private static $getDefaultLanguage;

    public function __construct() {

        parent::__construct();

        if ($this->input->server('HTTP_X_PJAX') && $this->input->server('HTTP_X_PJAX') == true) {
            $this->pjaxRequest = true;
            header('X-PJAX: true');
        }

        if ($this->input->server('HTTP_X_REQUESTED_WITH') && strtolower($this->input->server('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {
            $this->ajaxRequest = true;
        }

        defined('SHOP_INSTALLED') OR define('SHOP_INSTALLED', $this->checkForShop());
    }

    /**
     *
     * @return boolean
     */
    private function checkForShop() {

        if ($this->db) {
            $this->db->cache_on();
            $res = $this->db->where('identif', 'shop')
                ->get('components');

            if ($res) {
                $res = $res->result_array();
            } else {
                show_error($this->db->_error_message());
            }

            $this->db->cache_off();

            return (bool) count($res);
        } else {
            return false;
        }
    }

    /**
     * get current locale
     * @return string
     */
    public static function getCurrentLocale() {

        $ci = get_instance();
        $lang_id = $ci->config->item('cur_lang');
        if (self::$currentLocale && $lang_id == self::$currentLangId) {
            return self::$currentLocale;
        }

        if (preg_match('/^\/install/', $ci->input->server('PATH_INFO'))) {
            return;
        }
        self::$currentLangId = $lang_id;

        if ($lang_id) {
            $query = $ci->db
                ->query("SELECT `identif` FROM `languages` WHERE `id`=$lang_id AND active=1")
                ->result();
            if ($query) {
                self::$currentLocale = $query[0]->identif;
            } else {
                $defaultLanguage = self::getDefaultLanguage();
                self::$currentLocale = $defaultLanguage['identif'];
            }
        } else {
            self::$currentLocale = chose_language(TRUE);
        }
        return self::$currentLocale;
    }

    /**
     * Returns admin interface locale(used for langs translation)
     * @return string
     */
    public static function getAdminInterfaceLocale() {

        $locale = CI::$APP->config->item('language') ?: 'ru_RU';
        return array_shift(explode('_', $locale));
    }

    /**
     * Get current language
     * @param string|null $field
     * @return string|boolean|array
     */
    public static function getCurrentLanguage($field = null) {

        if (!self::$currentLanguage) {
            $ci = get_instance();
            if (preg_match('/^\/install/', $ci->input->server('PATH_INFO'))) {
                return FALSE;
            }

            $language = $ci->db
                ->where('identif', self::getCurrentLocale())
                ->get('languages')
                ->row_array();

            if ($language) {
                self::$currentLanguage = $language;
            } else {
                $defaultLanguage = self::getDefaultLanguage();
                self::$currentLanguage = $defaultLanguage;
            }
        }

        return $field ? self::$currentLanguage[$field] : self::$currentLanguage;
    }

    /**
     *
     * @return string
     */
    public static function defaultLocale() {

        $lang = self::getDefaultLanguage();
        return $lang['identif'];
    }

    /**
     * Get default language
     * @return array
     */
    public static function getDefaultLanguage() {

        if (self::$getDefaultLanguage) {
            return self::$getDefaultLanguage;
        }

        $ci = get_instance();
        $languages = $ci->db
            ->where('default', 1)
            ->get('languages');

        if ($languages) {
            $languages = $languages->row_array();
        }

        self::$getDefaultLanguage = $languages;
        return $languages;
    }

    /**
     * @return array|null
     */
    public static function getAllLocales() {

        $query = \CI::$APP->db->select('identif')->get('languages');
        return $query->num_rows() ? array_column($query->result_array(), 'identif') : null;
    }

    /**
     * Admin Autoload empty method
     */
    public static function adminAutoload() {

        /** Must be an empty */
    }

    /**
     * Check for premium CMS version
     * @return bool
     * @throws Exception
     */
    public static function isPremiumCMS() {

        return self::checkCMSVersion('premium');
    }

    /**
     * Check for professional CMS version
     * @return bool
     * @throws Exception
     */
    public static function isProCMS() {

        return self::checkCMSVersion('pro');
    }

    /**
     * Check for corporate CMS version
     * @return bool
     * @throws Exception
     */
    public static function isCorporateCMS() {

        return self::checkCMSVersion('corporate');
    }

    /**
     * Check current CMS version
     * @param string $version - version name: premium, pro, corporate
     * @return bool
     * @throws Exception
     */
    private static function checkCMSVersion($version) {

        if (!in_array($version, ['premium', 'pro', 'corporate'])) {
            throw new Exception('You must specify version to define it: premium, pro, corporate');
        }
        return strstr(strtolower(IMAGECMS_NUMBER), $version) ? true : false;
    }

    /**
     * @return ContainerBuilder
     */
    public function getContainer() {

        return DependencyInjectionProvider::getContainer();
    }

    /**
     * @return CacheProvider
     * @throws ServiceNotFoundException
     * @throws ServiceCircularReferenceException
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getCache() {

        return $this->getContainer()->get('cache');
    }

    public function get($id) {
        return $this->getContainer()->get($id);
    }

}

//trait Imagecms {
//
//    public static function whoAmI()
//    {
//        echo get_class($this);
//        return get_class($this);
//    }
//
//}