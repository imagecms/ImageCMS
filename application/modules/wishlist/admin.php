<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Sample Module Admin
 * @property wishlist_model $wishlist_model
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('wishlist_model');
        $this->settings = $this->wishlist_model->getSettings();
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->setData('settings', $this->wishlist_model->getSettings())
                ->renderAdmin('main');
    }

    public function update_settings() {
        if ($_POST) {
            $settings = $_POST[settings];
            $this->wishlist_model->setSettings($_POST[settings]);
        }
        $s="";
        foreach($_POST[settings] as $key => $val){
            $s .=','.$key .' => '.$val;
        }
        echo $s;
    }

    public function viewUsersWL() {

    }

}