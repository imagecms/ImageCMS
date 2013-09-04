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
<<<<<<< HEAD
                ->registerScript('nvd3/nv.d3', FALSE, 'before')
                ->registerScript('nvd3/stream_layers', FALSE, 'before');
    }

    public function index() {
        /* $data = array();
          $data['brands'] = \mod_stats\classes\Products::getInstance()->getAllBrands();
          \CMSFactory\assetManager::create()
          ->setData($data)
          ->registerStyle('products')
          ->registerScript('products')
          ->renderAdmin('products'); */

        $counts = \mod_stats\models\ProductsBase::getInstance()->getCategoryCount(50);
        echo "<pre>";
        print_r($counts);
        echo "</pre>";
=======
                ->registerScript('nvd3/nv.d3', FALSE, 'before');
    }

    public function index() {

        \mod_stats\classes\BaseStats::create()->test();

        \CMSFactory\assetManager::create()
                ->setData($data)
                ->renderAdmin('main', true);
>>>>>>> 9bcb14328e0c1ab1cb5b0d5976490d9a04487ae8
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