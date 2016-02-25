<?php

namespace mod_stats\classes;

use MY_Controller;
use MY_Lang;
use Stats_model;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class AdminHelper for mod_stats module
 * @uses MY_Controller
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property Stats_model $stats_model
 * @package ImageCMSModule
 */
class AdminHelper extends MY_Controller
{

    protected static $_instance;

    /**
     * AdminHelper constructor.
     */
    public function __construct() {

        parent::__construct();
        /** Load model * */
        $this->load->model('stats_model');
        $lang = new MY_Lang();
        $lang->load('mod_stats');
    }

    /**
     *
     * @return AdminHelper
     */
    public static function create() {

        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Ajax update setting by value and setting name
     */
    public function ajaxUpdateSettingValue() {

        /** Get data from post * */
        $settingName = $this->input->get('setting');
        $settingValue = $this->input->get('value');

        /** Set setting value * */
        $result = $this->stats_model->updateSettingByNameAndValue($settingName, $settingValue);

        /** Return result * */
        if ($result) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * Get setting by value
     * @param string $settingName
     * @return array
     */
    public function getSetting($settingName) {

        return $this->stats_model->getSettingByName($settingName);
    }

    /**
     * Get main currency symbol
     * @return array
     */
    public function getCurrencySymbol() {

        return $this->stats_model->getMainCurrencySymbol();
    }

    /**
     * Autocomlete products
     */
    public function autoCompleteProducts() {

        echo json_encode($this->autocomplete('product'));

    }

    /**
     * Autocomlete categories
     */
    public function autoCompleteCategories() {

        echo json_encode($this->autocomplete('category'));
    }

    /**
     * @param string $type
     * @return array
     */
    private function autocomplete($type) {

        $sCoef = $this->input->get('term');
        $sLimit = $this->input->get('limit');

        $response = [];
        $datas = [];

        switch ($type) {
            case 'category':
                $datas = $this->stats_model->getCategoriesByIdName($sCoef, $sLimit);
                break;
            case 'product':
                $datas = $this->stats_model->getProductsByIdNameNumber($sCoef, $sLimit);
                break;
        }

        foreach ($datas as $data) {
            $response[] = [
                'value' => $data['name'],
                'id' => $data['id'],
            ];
        }
        return $response;
    }
}