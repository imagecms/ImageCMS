<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use \mod_stats\classes\Products as Products;
use \mod_stats\classes\Orders as Orders;
use \mod_stats\classes\ProductsCategories as ProductsCategories;
use \mod_stats\classes\Search as Search;
use \mod_stats\classes\Users as Users;

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

        // trying to get template data (if has)
        if (FALSE !== $templateDataArray = $this->getTemplateData($statType, $statSubType)) {
            $data = $templateDataArray;
        } else {
            $data = array();
        }

        $templateData = \CMSFactory\assetManager::create()
                ->setData(array('data' => $data))
                ->fetchAdminTemplate($template, TRUE);
        echo $templateData;
    }

    /**
     * Returns data for specific diagram
     * @param string $statType class of diagram type
     * @param string $statSubType method of diagram type
     * @param array $params params for method
     */
    public function getStatsData($statType, $statSubType) {
        $methodName = 'get' . ucfirst($statSubType);
        $statsObject = $this->getStatsObject($statType);
        if (method_exists($statsObject, $methodName)) {
            echo $statsObject->$methodName();
        } else {
            echo "Error";
        }
    }

    /**
     * Some templates may have their own data - this method is used to obtain them
     * @param string $folder
     * @param string $template
     * @return array associative array with current template data
     */
    protected function getTemplateData($folder, $template) {
        $statsObject = $this->getStatsObject($folder);
        $methodName = 'template' . ucfirst($template);
        if (method_exists($statsObject, $methodName))
            return $statsObject->$methodName();

        return FALSE;
    }

    /**
     * For getting object of needed statistic category
     * @return boolean|object
     */
    protected function getStatsObject($statType) {
        switch ($statType) {
            case "products":
                $object = Products::create();
                break;
            case "orders":
                $object = Orders::create();
                break;
            case "categories":
                $object = Categories::create();
                break;
            case "search":
                $object = Search::create();
                break;
            case "users":
                $object = Users::create();
                break;
            default:
                return FALSE;
        }
        return $object;
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
        /** Get data from post * */
        $settingName = $this->input->get('setting');
        $settingValue = $this->input->get('value');
        var_dump($settingName);

        /** Set setting value * */
        $result = $this->stats_model->updateSettingByNameAndValue($settingName, $settingValue);

        /** Return result * */
        if ($result) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

}