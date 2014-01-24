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
        $coreData = CI::$APP->core->core_data;
        $thisObj = new Mod_stats();
        $thisObj->import('classes/Attendance');
        Attendance::getInstance()->add($coreData);
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
