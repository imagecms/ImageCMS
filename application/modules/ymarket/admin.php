<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Sample ymarket Admin
 * @property Ymarket_model $ymarket_model
 */
class Admin extends BaseAdminController
{
    const DEFAULT_TYPE = 1;
    const PRICE_UA_TYPE = 2;
    const NADAVI_UA_TYPE = 3;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('ymarket');
        $this->load->model('ymarket_model');

        if (!$this->load->module('admin/components')->is_installed('ymarket')) {
            $this->core->error_404();
        }
    }

    /**
     * Connects the module template in the administrative part of the site
     */
    public function index() {
        $item = $this->getSelectedCats();

        \CMSFactory\assetManager::create()
            ->registerScript('script')
            ->setData('hold', $item)
            ->renderAdmin('list');
    }

    /**
     * Selecting categories to generate xml
     * @return obj category, check adult and ids selectet category
     */
    public function getSelectedCats() {
        $data->categories = ShopCore::app()->SCategoryTree->getTree();
        $data->brands = $this->ymarket_model->getBrands();
        $data->ymarket_model = $this->ymarket_model->init(self::DEFAULT_TYPE);
        $data->price_ua_model = $this->ymarket_model->init(self::PRICE_UA_TYPE);
        $data->nadavi_ua_model = $this->ymarket_model->init(self::NADAVI_UA_TYPE);

        return $data;
    }

    /**
     * Saves the selected user categories in the table
     */
    public function save() {

        if ($this->dx_auth->is_admin() && $this->input->is_ajax_request()) {
            $this->ymarket_model->setCategories();

            showMessage(lang('Saved', 'admin'));
            $this->lib_admin->log(lang('Yandex marker settings was edited', 'ymarket'));
        }
    }

}