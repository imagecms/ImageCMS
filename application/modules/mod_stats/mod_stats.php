<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Mod_stats extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model');
        $lang = new MY_Lang();
        $lang->load('mod_stats');
    }

    public function index() {
        
    }

    public function autoload() {
        /** Check setting 'save_search_result' * */
        if ($this->stats_model->getSettingByName('save_search_results') == '1') {
            \CMSFactory\Events::create()->on('ShopBaseSearch:preSearch')->setListener('saveSearchedKeyWords');
        }
//        if ($this->stats_model->getSettingByName('save_page_urls') == '1') {
//            $this->savePageUrl($this->input->server('HTTP_REFERER'));
//        }
    }

    public function savePageUrl($url) {
        $baseUrl = base_url();
        $url_ = "/" . str_replace($baseUrl, "", $url);
        $userId = $this->dx_auth->get_user_id();
        $this->stats_model->saveUrl($userId, $url_);
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
