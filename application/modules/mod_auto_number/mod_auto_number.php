<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Mod_auto_number extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_auto_number');
    }

    public function index() {

    }

    public static function adminAutoload() {
        parent::adminAutoload();
        \CMSFactory\Events::create()->onShopProductCreate()->setListener('_numberAdd');
        \CMSFactory\Events::create()->onShopProductFastProdCreate()->setListener('_numberAdd');
    }

    public function autoload() {

    }

    public function _numberAdd($arg) {
        $ci = &get_instance();
        $prodId = $arg['productId'];

        $prodVar = $ci->db
            ->where('product_id', $prodId)
            ->get('shop_product_variants')
            ->result_array();

        foreach ($prodVar as $variant) {
            if ($variant['position'] == 0 || !$variant['position']) {
                $varId = $variant['id'];
                break;
            }
        }
        if ($varId) {
            $ci->db->where('id', $varId)
                ->update('shop_product_variants', array('number' => $prodId));
        }
    }

    public function _install() {
        $this->db->where('name', 'mod_auto_number')
            ->update('components', array('autoload' => '1'));
    }

    public function _deinstall() {

    }

}

/* End of file sample_module.php */