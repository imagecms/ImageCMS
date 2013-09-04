<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Sample Module Admin
 */
class Admin extends \BaseAdminController {

    private $template = '';
    private $mainTpl = '';

    public function __construct() {
        parent::__construct();
        /** Load model * */
        $this->load->model('stats_model');


        /**         * */
        /** Prepare template, load scripts and styles * */
        $this->mainTpl = \CMSFactory\assetManager::create()
                ->registerScript('scripts');


        if ($this->input->get('notLoadMain') != 'true') {
            $this->mainTpl
                    ->registerStyle('style')
                    ->registerStyle('nvd3/nv.d3')
                    ->registerScript('nvd3/lib/d3.v3', FALSE, 'before')
                    ->registerScript('nvd3/nv.d3.min', FALSE, 'before')
                    ->renderAdmin('main', true);
     
        }
    }

    public function index() {
        //\mod_stats\classes\BaseStats::create()->test();
    }

    public function getStatsData($type, $template) {
        $template = $type . "/" . $template;
        $templateData = \CMSFactory\assetManager::create()
                ->setData(array('$data' => $data))
                ->fetchAdminTemplate($template, TRUE);

        echo $templateData;
    }

    public function prepareOrdersData($param) {
        
    }

}