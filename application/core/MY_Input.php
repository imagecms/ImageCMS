<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Input extends CI_Input {

    public function __construct() {
        parent::__construct();
        $this->_security = & load_class('Security');
    }

    public function xss_clean($string) {
        return $this->_security->xss_clean($string);
    }

    /**
     * Sanitize Globals
     *
     * This function does the following:
     *
     * Unsets $_GET data (if query strings are not enabled)
     *
     * Unsets all globals if register_globals is enabled
     *
     * Standardizes newline characters to \n
     *
     * @access	private
     * @return	void
     */
    public function _sanitize_globals() {
        // It would be "wrong" to unset any of these GLOBALS.
        $protected = array('_SERVER', '_GET', '_POST', '_FILES', '_REQUEST',
            '_SESSION', '_ENV', 'GLOBALS', 'HTTP_RAW_POST_DATA',
            'system_folder', 'application_folder', 'BM', 'EXT',
            'CFG', 'URI', 'RTR', 'OUT', 'IN');

        // Unset globals for securiy.
        // This is effectively the same as register_globals = off
        foreach (array($_GET, $_POST, $_COOKIE) as $global) {
            if (!is_array($global)) {
                if (!in_array($global, $protected)) {
                    global $$global;
                    $$global = NULL;
                }
            } else {
                foreach ($global as $key => $val) {
                    if (!in_array($key, $protected)) {
                        global $$key;
                        $$key = NULL;
                    }
                }
            }
        }

        // Is $_GET data allowed? If not we'll set the $_GET to an empty array
        if ($this->_allow_get_array == FALSE) {
            $_GET = array();
        } else {
            if (is_array($_GET) AND count($_GET) > 0) {
                foreach ($_GET as $key => $val) {
                    $_GET[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
                }
            }
        }

        //for loading raw data from php://input 1C && Moy sklad
        $isExchangeUri = (false !== strpos($_SERVER['REQUEST_URI'], 'exchange?type=catalog&mode=file&filename'));

        if (!$isExchangeUri && is_array($_POST) AND count($_POST) > 0) {
            foreach ($_POST as $key => $val) {
                $_POST[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
            }
        }

        // Clean $_COOKIE Data
        if (is_array($_COOKIE) AND count($_COOKIE) > 0) {
            // Also get rid of specially treated cookies that might be set by a server
            // or silly application, that are of no use to a CI application anyway
            // but that when present will trip our 'Disallowed Key Characters' alarm
            // http://www.ietf.org/rfc/rfc2109.txt
            // note that the key names below are single quoted strings, and are not PHP variables
            unset($_COOKIE['$Version']);
            unset($_COOKIE['$Path']);
            unset($_COOKIE['$Domain']);

            // Work-around for PHP bug #66827 (https://bugs.php.net/bug.php?id=66827)
            //
            // The session ID sanitizer doesn't check for the value type and blindly does
            // an implicit cast to string, which triggers an 'Array to string' E_NOTICE.
            $sess_cookie_name = config_item('cookie_prefix') . config_item('sess_cookie_name');
            if (isset($_COOKIE[$sess_cookie_name]) && !is_string($_COOKIE[$sess_cookie_name])) {
                unset($_COOKIE[$sess_cookie_name]);
            }

            foreach ($_COOKIE as $key => $val) {
                // _clean_input_data() has been reported to break encrypted cookies
                if ($key === $sess_cookie_name && config_item('sess_encrypt_cookie')) {
                    continue;
                }

                $_COOKIE[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
            }
        }

        // Sanitize PHP_SELF
        $_SERVER['PHP_SELF'] = strip_tags($_SERVER['PHP_SELF']);

        // CSRF Protection check on HTTP requests
        if ($this->_enable_csrf == TRUE && !$this->is_cli_request()) {
            $this->security->csrf_verify();
        }

        log_message('debug', "Global POST and COOKIE data sanitized");
    }

}