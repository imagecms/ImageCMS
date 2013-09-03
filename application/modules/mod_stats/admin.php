<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends \BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model');
        \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->registerScript('scripts');
    }

    public function index() {
        $data = array();
        $data['brands'] = \mod_stats\classes\Products::getInstance()->getBrands();
        \CMSFactory\assetManager::create()
                ->setData($data)
                ->registerStyle('products')
                ->renderAdmin('products');
    }

}