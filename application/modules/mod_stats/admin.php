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
        /*$this->load->model('stats_model');

      
        $this->mainTpl = \CMSFactory\assetManager::create()
                ->registerScript('scripts');


        if ($this->input->get('notLoadMain') != 'true') {
            $this->mainTpl
                    ->registerStyle('style')
                    ->registerStyle('nvd3/nv.d3')
                    ->registerScript('nvd3/lib/d3.v3', FALSE, 'before')
                    ->registerScript('nvd3/nv.d3.min', FALSE, 'before')
                    ->renderAdmin('main', true);
        }*/
        
        \mod_stats\classes\Products::create()->test();
        
        exit;
    }

    public function index() {
//        \mod_stats\classes\BaseStats::create()->test();
    }

    /**
     * Loads template
     * @param string $statType first menu level (folder)
     * @param string $statSubType sublevel (template file name)
     */
    public function getStatsData($statType, $statSubType) {
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
    public function getDiagramData($statType, $statSubType) {
        /** Prepare method name**/
        $methodName = 'get'.ucfirst($statSubType);
        
        try {
            switch ($statType) {
                case "products":
                    $result = \mod_stats\classes\Products::create()->$methodName();
                    break;
                case "orders":
                    $result = \mod_stats\classes\Products::create()->$methodName();
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
            // при потребі дані можуть бути оброблені ще через якусь ф-ю, 
            // але при умові що ці дані є однотипні (тільки по діаграмах, або тільки по таблицях)
            // інакше треба обробляти дані на вивід у самих ф-ях (або добавляти у дану ф-ю ще параметр)
        } catch (Exception $e) { // class or method not found
            // print some message
        }
    }
    
    
    
//    public function dataPie() {
//        $a['type'] = 'pie';
//        $a['data'][0]['key'] = 'one';
//        $a['data'][0]['y'] = '1';
//        $a['data'][1]['key'] = 'two';
//        $a['data'][1]['y'] = '2';
//        $a['data'][2]['key'] = 'four';
//        $a['data'][2]['y'] = '4';
//        $a['data'][3]['key'] = 'five';
//        $a['data'][3]['y'] = '5';
//        
//        echo json_encode($a);
//    }
//    
//    public function dataLine() {
//        $a['type'] = 'line';
//        $a['data'][0]['key'] = 'Оплачение';
//        $a['data'][0]['values'][0]['x'] = 1362100000000;
//        $a['data'][0]['values'][0]['y'] = 15.00 ;
//        $a['data'][0]['values'][1]['x'] = 1362200000000;
//        $a['data'][0]['values'][1]['y'] = 18.00 ;
//        $a['data'][1]['key'] = 'Неоплачение';
//        $a['data'][1]['values'][0]['x'] = 1362100000000 ;
//        $a['data'][1]['values'][0]['y'] = 12.00 ;
//        $a['data'][1]['values'][1]['x'] = 1362200000000;
//        $a['data'][1]['values'][1]['y'] = 15.00 ;
//      
//        echo json_encode($a);
//    }

}