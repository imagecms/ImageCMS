<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends \BaseAdminController {

    private $template = 'orders/data';
    private $TL;
    
    
    public function __construct() {
        parent::__construct();
        /** Load model **/
        $this->load->model('stats_model');
        
        /** Prepare template, load scripts and styles **/
        $this->TL = \CMSFactory\assetManager::create()
            ->registerStyle('style')
            ->registerScript('scripts')
            ->registerStyle('nvd3/nv.d3')
            ->registerScript('nvd3/lib/d3.v3', FALSE, 'before')
            ->registerScript('nvd3/nv.d3', FALSE, 'before')
            ->renderAdmin('main', true);
    }

    public function index() {

        \mod_stats\classes\BaseStats::create()->test();
    }

    public function orders($action = 'data') {

        switch ($action) {
            case 'data':
                $this->template = 'orders/data';
                var_dumps(11111111);
                break;

            case 'price':
                $this->template = 'orders/price';
                var_dumps(22222222);
                break;

            case 'brands_and_cat':
                $this->template = 'orders/brands_and_cat';
                break;

            default:
                $this->template = 'orders/data';
                break;
        }
        
//        $templateData = \CMSFactory\assetManager::create()->fetchAdminTemplate($this->template);
//        var_dump($templateData);
        \CMSFactory\assetManager::create()->renderAdmin($this->template);
//                ->appendData('chartsContainer', $templateData);
        
        
    }

}