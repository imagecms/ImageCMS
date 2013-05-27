<?php

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
 * @property CI_Validation $validation            //dead
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
 */
class MY_Controller extends MX_Controller {

    public $pjaxRequest = false;
    public $ajaxRequest = false;
    public static $currentLocale = null;

    public function __construct() {
        parent::__construct();

        if (isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == true) {
            $this->pjaxRequest = true;
            header('X-PJAX: true');
        }

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            $this->ajaxRequest = true;

        defined('SHOP_INSTALLED') OR define('SHOP_INSTALLED', $this->checkForShop());
    }

    private function checkForShop() {
        if ($this->db) {
            $res = $this->db->where('identif', 'shop')
                    ->get('components')
                    ->result_array();

            return (bool) count($res);
        }
        else
            return false;
    }

    /**
     * get current locale
     * @return type
     */
    public static function getCurrentLocale() {
        if (self::$currentLocale)
            return self::$currentLocale;

        $ci = get_instance();
        $lang_id = $ci->config->item('cur_lang');

        if ($lang_id) {
            $query = $ci->db
                    ->query("SELECT `identif` FROM `languages` WHERE `id`=$lang_id")
                    ->result();
            if ($query) {
                self::$currentLocale = $query[0]->identif;
            } else {
                $defaultLanguage = self::getDefaultLanguage();
                self::$currentLocale = $defaultLanguage['identif'];
            }
        } else {
            $defaultLanguage = self::getDefaultLanguage();
            self::$currentLocale = $defaultLanguage['identif'];
        }
        return self::$currentLocale;
    }

    /**
     * Get default language
     */
    private function getDefaultLanguage() {
        $ci = get_instance();
        $languages = $ci->db
                ->where('default', 1)
                ->get('languages');

        if ($languages)
            $languages = $languages->row_array();

        return $languages;
    }

    /**
     * Admin Autoload empty method
     * @return boolean
     */
    public static function adminAutoload() {
        /** Must be an empty */
    }

}
