<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package        CodeIgniter
 * @author        Dariusz Debowczyk
 * @copyright    Copyright (c) 2006, D.Debowczyk
 * @license        http://www.codeignitor.com/user_guide/license.html
 * @link        http://www.codeigniter.com
 * @since        Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Session class using native PHP session features and hardened against session fixation.
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Sessions
 * @author        Dariusz Debowczyk
 * @link        http://www.codeigniter.com/user_guide/libraries/sessions.html
 */
class Native_session {

    var $session_id_ttl = 7200; // session id time to live (TTL) in seconds

    var $flash_key = 'flash'; // prefix for "flash" variables (eg. flash:new:message)

    public function __construct() {

        log_message('debug', "Native_session Class Initialized");

        $CI = & get_instance();
        $this->session_id_ttl = $CI->config->item('sess_expiration');

        $this->_sess_run();
    }

    /**
     * Regenerates session id
     */
    public function regenerate_id() {

        // copy old session data, including its id
        $old_session_id = session_id();
        $old_session_data = $_SESSION;

        // regenerate session id and store it
        session_regenerate_id();
        $new_session_id = session_id();

        // switch to the old session and destroy its storage
        session_id($old_session_id);
        session_destroy();

        // switch back to the new session id and send the cookie
        session_id($new_session_id);
        session_start();

        // restore the old session data into the new session
        $_SESSION = $old_session_data;

        // update the session creation time
        $_SESSION['regenerated'] = time();

        // session_write_close() patch based on this thread
        // http://www.codeigniter.com/forums/viewthread/1624/
        // there is a question mark ?? as to side affects
        // end the current session and store session data.
        session_write_close();
    }

    public function all_userdata() {

        return $_SESSION;
    }

    /**
     * Destroys the session and erases session storage
     */
    public function destroy() {

        unset($_SESSION);

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }

        session_destroy();
    }

    /**
     * Destroys the session and erases session storage
     */
    public function sess_destroy() {

        unset($_SESSION);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
    }

    /**
     * Reads given session attribute value
     */
    public function userdata($item) {

        if ($item == 'session_id') { //added for backward-compatibility
            return session_id();
        } else {
            return (!isset($_SESSION[$item])) ? false : $_SESSION[$item];
        }
    }

    /**
     * Sets session attributes to the given values
     */
    public function set_userdata($newdata = array(), $newval = '') {

        if (is_string($newdata)) {
            $newdata = array($newdata => $newval);
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                $_SESSION[$key] = $val;
            }
        }
    }

    /**
     * Erases given session attributes
     */
    public function unset_userdata($newdata = array()) {

        if (is_string($newdata)) {
            $newdata = array($newdata => '');
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                unset($_SESSION[$key]);
            }
        }
    }

    /**
     * Starts up the session system for current request
     */
    public function _sess_run() {

        @session_start();

        // check if session id needs regeneration
        if ($this->_session_id_expired()) {
            // regenerate session id (session data stays the
            // same, but old session storage is destroyed)
            $this->regenerate_id();
        }

        // delete old flashdata (from last request)
        $this->_flashdata_sweep();

        // mark all new flashdata as old (data will be deleted before next request)
        $this->_flashdata_mark();
    }

    /**
     * Checks if session has expired
     */
    public function _session_id_expired() {

        if (!isset($_SESSION['regenerated'])) {
            $_SESSION['regenerated'] = time();
            return false;
        }

        $expiry_time = time() - $this->session_id_ttl;

        if ($_SESSION['regenerated'] <= $expiry_time) {
            return true;
        }

        return false;
    }

    /**
     * Sets "flash" data which will be available only in next request (then it will
     * be deleted from session). You can use it to implement "Save succeeded" messages
     * after redirect.
     */
    public function set_flashdata($newdata = array(), $newval = '') {

        // $flash_key = $this->flash_key.':new:'.$key;
        // $this->set_userdata($flash_key, $value);

        if (is_string($newdata)) {
            $newdata = array($newdata => $newval);
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                $flashdata_key = $this->flash_key . ':new:' . $key;
                $this->set_userdata($flashdata_key, $val);
            }
        }
    }

    /**
     * Keeps existing "flash" data available to next request.
     */
    public function keep_flashdata($key) {

        $old_flash_key = $this->flash_key . ':old:' . $key;
        $value = $this->userdata($old_flash_key);

        $new_flash_key = $this->flash_key . ':new:' . $key;
        $this->set_userdata($new_flash_key, $value);
    }

    /**
     * Returns "flash" data for the given key.
     */
    public function flashdata($key) {

        $flash_key = $this->flash_key . ':old:' . $key;
        return $this->userdata($flash_key);
    }

    /**
     * PRIVATE: Internal method - marks "flash" session attributes as 'old'
     */
    public function _flashdata_mark() {

        foreach ($_SESSION as $name => $value) {
            $parts = explode(':new:', $name);
            if (is_array($parts) && count($parts) == 2) {
                $new_name = $this->flash_key . ':old:' . $parts[1];
                $this->set_userdata($new_name, $value);
                $this->unset_userdata($name);
            }
        }
    }

    /**
     * PRIVATE: Internal method - removes "flash" session marked as 'old'
     */
    public function _flashdata_sweep() {

        foreach ($_SESSION as $name => $value) {
            $parts = explode(':old:', $name);
            if (is_array($parts) && count($parts) == 2 && $parts[0] == $this->flash_key) {
                $this->unset_userdata($name);
            }
        }
    }

}

?>