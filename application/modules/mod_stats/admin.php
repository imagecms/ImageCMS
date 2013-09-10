<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Sample Module Admin
 */
class Admin extends \BaseAdminController {

    private $mainTpl = '';

    public function __construct() {
        parent::__construct();
        /** Load model * */
        $this->load->model('stats_model');


        $this->mainTpl = \CMSFactory\assetManager::create()
                ->registerScript('scripts');

        if ($this->input->get('notLoadMain') != 'true') {
            $this->mainTpl
                    ->registerStyle('style')
                    ->registerStyle('nvd3/nv.d3')
                    ->registerScript('nvd3/lib/d3.v3', FALSE, 'before')
                    ->registerScript('nvd3/nv.d3', FALSE, 'before')
                    ->renderAdmin('main', true);
        }
    }
    
    
    /**
     * Loads template
     * @param string $statType first menu level (folder)
     * @param string $statSubType sublevel (template file name)
     */
    public function getStatsTemplate($statType, $statSubType) {
        $template = $statType . "/" . $statSubType;
        $templateData = \CMSFactory\assetManager::create()
                ->setData(array('$data' => $data))
                ->fetchAdminTemplate($template, TRUE);

        echo $templateData;
    }

    /**
     * Returns data for specific diagram
     * (strategy)
     * @param string $statType class of diagram type
     * @param string $statSubType method of diagram type
     * @param array $params params for method
     */
    public function getStatsData($statType, $statSubType) {
        /** Prepare method name* */
        $methodName = 'get' . ucfirst($statSubType);

        try {
            switch ($statType) {
                case "products":
                    $result = \mod_stats\classes\Products::create()->$methodName();
                    break;
                case "orders":
                    $result = \mod_stats\classes\Orders::create()->$methodName();
                    break;
                case "products_categories":
                    $result = \mod_stats\classes\ProductsCategories::create()->$methodName();
                    break;
                case "search":
                    $result = \mod_stats\classes\Search::create()->$methodName();
                    break;
                case "users":
                    $result = \mod_stats\classes\Users::create()->$methodName();
                    break;
                default:
                    throw new Exception;
            }

            echo $result;
        } catch (Exception $e) { // class or method not found
            // print some message
        }
    }

}