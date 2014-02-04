<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin class for SmartSeo Module
 * @property Smartseo_model $seoexpert_model  
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('seoexpert_model');
    }

    public function index() {
        $locale = $locale == null ? MY_Controller::getCurrentLocale() : $locale;
        $settings = $this->seoexpert_model->getSettings($locale);        
        \CMSFactory\assetManager::create()
                ->setData('locale', $locale)
                ->setData('languages', ShopCore::$ci->cms_admin->get_langs(true))
                ->setData('settings', $settings)
                ->registerStyle('style')
                ->renderAdmin('main');
    }
    public function translit($locale = FALSE) {
        
        $settings = $this->seoexpert_model->getSettings($locale);
        \CMSFactory\assetManager::create()
                ->setData('locale', $locale)
                ->setData('languages', ShopCore::$ci->cms_admin->get_langs(true))
                ->setData('settings', $settings)
                ->registerStyle('style')
                ->renderAdmin('main');
    }

    public function save($locale = FALSE) {
        if ($this->seoexpert_model->setSettings($this->input->post(),$locale))
            showMessage('Сохранено!');
    }

}