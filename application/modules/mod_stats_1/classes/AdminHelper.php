<?php

namespace mod_stats\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class BaseStats for mod_stats module
 * @uses \MY_Controller
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 */
class AdminHelper extends \MY_Controller {

    protected static $_instance;

     /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {
        parent::__construct();
        /** Load model * */
        $this->load->model('stats_model');
        $lang = new \MY_Lang();
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
     * Autocomlete products
     * @return jsone
     */
    public function autoCompliteProducts() {
        $sCoef = $this->input->get('term');
        $sLimit = $this->input->get('limit');

        $products = $this->stats_model->getProductsByIdNameNumber($sCoef, $sLimit);

        if ($products != false) {
            foreach ($products as $product) {
                $response[] = array(
                    'value' => $product['name'],
                    'id' => $product['id'],
                );
            }
            echo json_encode($response);
            return;
        }
        echo '';
    }
}
