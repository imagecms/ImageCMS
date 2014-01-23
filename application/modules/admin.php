<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use \mod_stats\classes\Products as Products;
use \mod_stats\classes\Orders as Orders;
use \mod_stats\classes\Categories as Categories;
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
        $lang = new MY_Lang();
        $lang->load('mod_stats');
        /** Load model * */
        $this->load->model('stats_model');

        /** Variable for main.tpl wich contain value of setting "save_search_result" * */
        $saveSearchResults = $this->getSetting('save_search_results');
        $savePageUrls = $this->getSetting('save_page_urls');

        /** Show main.tpl with scripts, styles and data * */
        if ($this->input->get('notLoadMain') != 'true') {
            \CMSFactory\assetManager::create()
                    ->setData(array(
                        'saveSearchResults' => $saveSearchResults,
                        'savePageUrls' => $savePageUrls
                    ))
                    ->registerStyle('style')
                    ->registerStyle('nvd3/nv.d3')
                    ->registerScript('scripts', FALSE, 'after')
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

        echo \CMSFactory\assetManager::create()
                ->setData(array('data' => $data))
                ->fetchAdminTemplate($template, TRUE);
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
     * Some templates may have their own data - this method obtain them
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

    /**
     * Ajax update setting by value and setting name
     */
    public function ajaxUpdateSettingValue() {
        \mod_stats\classes\AdminHelper::create()->ajaxUpdateSettingValue();
    }

    /**
     * Autocomlete products
     * @return jsone
     */
    public function autoCompliteProducts() {
        \mod_stats\classes\AdminHelper::create()->autoCompliteProducts();
    }

    /**
     * Ajax get product info by id (name, count of purchasses, rating, comments count)
     */
    public function ajaxGetProductInfoById($id = null) {
        if ($id == null) {
            echo 'false';
            return;
        }
        \mod_stats\classes\Products::create()->getProductInfoById($id);
    }

}