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
                ->registerScript('scripts')
                ->registerStyle('nvd3/nv.d3')
                ->registerScript('nvd3/lib/d3.v3', FALSE, 'before')
                ->registerScript('nvd3/nv.d3', FALSE, 'before');
    }

    public function index() {

        \mod_stats\classes\BaseStats::create()->test();

        \CMSFactory\assetManager::create()
                ->setData($data)
                ->renderAdmin('main', true);
    }

    public function orders($action = 'data') {
        switch ($action) {
            case 'data':
                \CMSFactory\assetManager::create()
                        ->setData($data)
                        ->renderAdmin('main', true);

                break;

            default:
                break;
        }
    }

}