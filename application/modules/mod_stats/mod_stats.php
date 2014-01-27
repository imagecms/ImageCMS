<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

include_once __DIR__ . DIRECTORY_SEPARATOR . 'traits' . DIRECTORY_SEPARATOR . 'FileImportTrait' . EXT;

/**
 * Image CMS
 * Module Frame
 */
class Mod_stats extends MY_Controller {

    use FileImportTrait;

    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model');
//        $lang = new MY_Lang();
//        $lang->load('mod_stats');
    }

    public function index() {
        
    }

    public function autoload() {
        if (!$this->input->is_ajax_request()) {
            /** Check setting 'save_search_result' * */
            if ($this->stats_model->getSettingByName('save_search_results') == '1') {
                \CMSFactory\Events::create()->on('ShopBaseSearch:preSearch')->setListener('saveSearchedKeyWords');
            }
            if ($this->stats_model->getSettingByName('save_users_attendance') == '1') {
                \CMSFactory\Events::create()->on('Core:pageLoaded')->setListener('saveAttendance');
            }
        }
    }

    public function saveAttendance() {
        $thisObj = new Mod_stats();
        $thisObj->import('classes/Attendance');

        /*
         * If user is not registered, he has no id. For accurate data 
         * traffic each user must differ. So for unregistered users 
         * is generating negative random ID. When a user signs up it 
         * changed to its id from users table
         */
        if (0 == $userId = (int) CI::$APP->dx_auth->get_user_id()) {
            if (!isset($_COOKIE['u2id'])) { //unregistered user id
                // setting up new unregistered user id
                $userId = $thisObj->stats_model->getNewUnregisteredUserId();
                setcookie('u2id', $userId, time() + 60 * 60 * 24 * 30, '/');
            } else {
                // just updating time
                setcookie('u2id', $_COOKIE['u2id'], time() + 60 * 60 * 24 * 30, '/');
                $userId = $_COOKIE['u2id'];
            }
        } else { // registered user
            $userId = CI::$APP->dx_auth->get_user_id();
            if (isset($_COOKIE['u2id'])) { // it means that user just make registration
                $thisObj->stats_model->updateAttendanceUserId($_COOKIE['u2id'], $userId);
                setcookie('u2id', $userId, time() - 100, '/'); // deleting cookie
            }
        }
        Attendance::getInstance()->add(CI::$APP->core->core_data, $userId);
    }

    public function saveSearchedKeyWords($text = '') {
        if ($text['search_text'] == '') {
            return;
        }
        $thisObj = new Mod_stats();
        $thisObj->stats_model->saveKeyWords($text['search_text']);
    }

    /**
     * Install module
     */
    public function _install() {
        $this->stats_model->install();
    }

    /**
     * Deinstall module
     */
    public function _deinstall() {
        $this->stats_model->deinstall();
    }

}

/* End of file sample_module.php */
