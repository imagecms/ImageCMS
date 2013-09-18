<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('pricespy');

        $this->load->library('DX_Auth');
    }

    /**
     * register spy script for admin
     */
    private function init() {
        \CMSFactory\assetManager::create()
                ->registerScript('spy');
    }

    public function index() {
        $this->init();

        $spys = $this->db
                ->from('users')
                ->join('mod_price_spy', 'mod_price_spy.userId=users.id')
                ->join('shop_product_variants', 'mod_price_spy.productVariantId=shop_product_variants.id')
                ->join('shop_products_i18n', 'shop_products_i18n.id=mod_price_spy.productId')
                ->join('shop_products', 'shop_products.id=mod_price_spy.productId')
                ->order_by('users.id')
                ->get()
                ->result();

        $this->template->add_array(array('spys' => $spys));

        if (!$this->ajaxRequest)
            $this->display_tpl('list');
    }

    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

}

/* End of file admin.php */