<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * User support module
 *
 */
class Print_data extends MY_Controller {

    public $no_install = true;

    public function __construct() {
        parent::__construct();
        if (count($this->db->where('name', 'print_data')->get('components')->result_array()) == 0) 
            $this->no_install = false;

        $this->load->module('core');
    }

    public function render_button($data, $type = 'product') {
        if (!$this->no_install) return false;
        \CMSFactory\assetManager::create()->registerScript('main');
        \CMSFactory\assetManager::create()->registerStyle('style');
        switch ($type) {
            case 'product':
                $href = "/print_data/print_" . $type . "/" . $data['id'] . "/" . $data['var'];
                break;
            case 'page':
                $href = "/print_data/print_" . $type . "/" . $data['id'];
                break;

            default:
                break;
        }
        \CMSFactory\assetManager::create()->setData(array('href'=>$href))->render('button', TRUE);
    }

    public function print_product($id, $var) {
        if (!$this->no_install) return false;
        $product = SProductsQuery::create()->joinWithI18n(ShopController::getCurrentLocale())->findPk($id);
        $variant = SProductVariantsQuery::create()->joinWithI18n(ShopController::getCurrentLocale())->findPk($var);
       // \CMSFactory\assetManager::create()->registerStyle('style');
        \CMSFactory\assetManager::create()->setData(array('product' => $product, 'variant' => $variant))->render('print_product', TRUE);
    }
    public function print_page($id) {
        if (!$this->no_install) return false;
        $page = get_page($id);
       // \CMSFactory\assetManager::create()->registerStyle('style');
        \CMSFactory\assetManager::create()->setData(array('page' => $page))->render('print_page', TRUE);
    }

    // Create new ticket


    public function _install() {


        $this->db->where('name', 'print_data');
        $this->db->update('components', array('enabled' => 1));
    }

    public function _deinstall() {
        if ($this->dx_auth->is_admin() == FALSE)
            exit;

        $this->load->dbforge();
    }

}

/* End of file user_support.php */
