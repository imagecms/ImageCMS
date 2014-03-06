<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

include_once __DIR__ . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'FileImport' . EXT;

/**
 * Class Mod_stats for mod_stats module
 * @uses \MY_Controller
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property stats_model $stats_model
 * @package ImageCMSModule
 */
class Mod_stats extends \MY_Controller implements FileImport{

    //use FileImportTrait;

    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model');
//        $lang = new MY_Lang();
//        $lang->load('mod_stats');
    }

    public function index() {
        
    }

    public function autoload() {
        /** Check setting 'save_search_result' * */
        if ($this->stats_model->getSettingByName('save_search_results_ac') == '1') {
            //Autocomplete results
            \CMSFactory\Events::create()->on('search:AC')->setListener('saveSearchedKeyWordsAC');
        }

        if (!$this->input->is_ajax_request()) {
            /** Check setting 'save_search_result' * */
            if ($this->stats_model->getSettingByName('save_search_results') == '1') {
                // When enter press
                \CMSFactory\Events::create()->on('ShopBaseSearch:preSearch')->setListener('saveSearchedKeyWords');
            }

            if ($this->stats_model->getSettingByName('save_users_attendance') == '1') {
                \CMSFactory\Events::create()->on('Core:pageLoaded')->setListener('saveAttendance');
            }
        }
    }

    /**
     * Save search keywords for autocomplete
     * @param string $text
     * @return 
     */
    public function saveSearchedKeyWordsAC($text = '') {
        if ($text['search_text'] == '') {
            return;
        }
        $thisObj = new Mod_stats();
        $thisObj->stats_model->saveKeyWordsAC($text['search_text']);
    }

    /**
     * Save user attandance
     */
    public function saveAttendance() {
        $thisObj = new Mod_stats();
        $thisObj->import('classes/Attendance');

        $thisObj->load->library('user_agent');
        if ($thisObj->agent->is_robot()) {
            $thisObj->import('classes/RobotsAttendance');
            if ((int) \mod_stats\classes\AdminHelper::create()->getSetting('save_robots_attendance') == 1) {
                RobotsAttendance::getInstance()->add(CI::$APP->core->core_data, $this->agent->robot());
            }
            return;
        }

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

    /**
     * Save search keywords
     * @param string $text
     * @return 
     */
    public function saveSearchedKeyWords($text = '') {
        if ($text['search_text'] == '') {
            return;
        }
        $thisObj = new Mod_stats();
        $thisObj->stats_model->saveKeyWords($text['search_text']);
    }

    /**
     * Include file (or all recursively files in dir) 
     * The starting directory is the directory where the class is (witch using trait)
     * @param string $filePath
     */
    public function import($filePath) {
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if ($ext != 'php' && $ext != "")
            return;

        $filePath = str_replace('.php', '', $filePath);
        $reflection = new ReflectionClass($this);
        $workingDir = pathinfo($reflection->getFileName(), PATHINFO_DIRNAME);
        $filePath = $workingDir . DIRECTORY_SEPARATOR . str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $filePath);

        if (strpos($filePath, '*') === FALSE) {
            include_once $filePath . EXT;
        } else {
            $filesOfDir = get_filenames(str_replace('*', '', $filePath), TRUE);
            foreach ($filesOfDir as $file) {
                if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) == 'php') {
                    include_once str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $file);
                }
            }
        }
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
