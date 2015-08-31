<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Helper controller for maintenance
 */
class Cli extends \MY_Controller {

    public function __construct() {
        if (php_sapi_name() !== 'cli') {
            $this->core->error_404();
        }
        parent::__construct();
        $this->load->helper('cli');
    }

    /**
     * Truncates data for 1C import
     * < php index.php exchange cli truncate >
     */
    public function truncate() {
//        if (true != _confirm('Really truncate data for import', true)) {
//            _outputLine('Canceled');
//            return;
//        }

        $this->db->truncate('shop_category');
        $this->db->truncate('shop_category_i18n');

        $this->db->truncate('shop_brands');
        $this->db->truncate('shop_brands_i18n');

        $this->db->truncate('shop_products');
        $this->db->truncate('shop_products_i18n');
        $this->db->truncate('shop_product_variants');
        $this->db->truncate('shop_product_variants_i18n');
        $this->db->truncate('shop_product_categories');

        $this->db->truncate('shop_product_properties');
        $this->db->truncate('shop_product_properties_i18n');
        $this->db->truncate('shop_product_properties_categories');
        $this->db->truncate('shop_product_properties_data');
        $this->db->truncate('shop_product_properties_data_i18n');
        $this->db->truncate('shop_product_images');

        $this->db->truncate('shop_orders');
        $this->db->truncate('shop_orders_products');

        _outputLine('Data truncated!');
    }

    /**
     * 
     * @param string $name
     * @param string $email
     * @param string $password
     * < php index.php exchange cli create_admin >
     */
    public function create_admin($name = null, $email = null, $password = null) {

        // This is defaults. Order must be like in function arguments
        $argumentsDefaults = array('admin', 'ad@min.com', 'admin');
        $argumentsValues = func_get_args();
        $data = array();

        foreach ($argumentsDefaults as $i => $value) {
            $data[$i] = $argumentsValues[$i] ? : $argumentsDefaults[$i];
        }

        $res = $this->dx_auth->register($data[0], $data[2], $data[1], '', '', '');

        $this->db->update('users', ['role_id' => 1], ['email' => $data[1]], 1);
        
        _outputLine($res ? 'Created' : 'Error');
        
    }

}
