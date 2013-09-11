<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Sample Module Admin
 */
class Admin extends \BaseAdminController {

    private $mainTpl = null;

    public function __construct() {
        parent::__construct();
        /** Load model * */
        $this->load->model('stats_model');

        $this->mainTpl = \CMSFactory\assetManager::create()
                ->registerScript('scripts');

        /** Variable for main.tpl wich contain value of setting "save_search_result" * */
        $saveSearchResults = $this->getSetting('save_search_results');

        /** Show main.tpl with scripts, styles and data * */
        if ($this->input->get('notLoadMain') != 'true') {
            $this->mainTpl
                    ->setData(array('saveSearchResults' => $saveSearchResults))
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
                ->setData(array('data' => $data))
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

    /**
     * Get setting by value
     * @param string $settingName
     * @return string|boolean
     */
    public function getSetting($settingName) {
        return $this->stats_model->getSettingByName($settingName);
    }

    public function ajaxUpdateSettingValue() {
        /** Get data from post **/
        $settingName = $this->input->get('setting');
        $settingValue = $this->input->get('value');
        var_dump($settingName);
        
        /** Set setting value **/
        $result = $this->stats_model->updateSettingByNameAndValue($settingName, $settingValue);
        
        /** Return result **/
        if ($result) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

}