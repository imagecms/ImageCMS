<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends \BaseAdminController{

    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model');
        \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->registerScript('scripts');
    }

    public function index() {
        
        \mod_stats\classes\BaseStats::create()->test();
        
        \CMSFactory\assetManager::create()
                ->setData($data)
                ->renderAdmin('main', true);
    }

}