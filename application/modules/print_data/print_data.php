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

    public $no_install = false;

    public function __construct() {
        parent::__construct();
        if (count($this->db->where('name', 'print_data')->get('components')->result_array()) == 0)
            $this->no_install = false;

        $this->load->module('core');
    }
    /**
     * Get rating rom database
     * @param array $data 
     */
    public function render_button($data) {

        $type = $this->core->core_data['data_type'];
        /*
         * $data - масив даних для друку (для товару id, var) (для сторінок id)
         * $type - тип сторінки для друку
         */
        if (!$this->no_install)
            return false;
        \CMSFactory\assetManager::create()->registerScript('main');
        \CMSFactory\assetManager::create()->registerStyle('style');
        switch ($type) {
            case 'product':
                $href = "/" . get_main_lang('identif') . "/print_data/print_" . $type . "/" . $data['id'] . "/" . $data['var'];
                break;
            case 'page':
                $href = "/" . get_main_lang('identif') . "/print_data/print_" . $type . "/" . $data['id'];
                break;

            default:
                break;
        }
        \CMSFactory\assetManager::create()->setData(array('href' => $href))->render('button', TRUE);
    }

    public function print_product($id, $var) {
        if (!$this->no_install)
            return false;
        $product = SProductsQuery::create()->joinWithI18n(ShopController::getCurrentLocale())->findPk($id);
        $variant = SProductVariantsQuery::create()->joinWithI18n(ShopController::getCurrentLocale())->findPk($var);
        $style = '/application/modules/print_data/assets/css/style.css';
        \CMSFactory\assetManager::create()->setData(array('style' => $style, 'product' => $product, 'variant' => $variant))->render('print_product', TRUE);
    }

    public function print_page($id) {
        if (!$this->no_install)
            return false;
        $page = get_page($id);
        $style = '/application/modules/print_data/assets/css/style.css';
        \CMSFactory\assetManager::create()->setData(array('style' => $style, 'page' => $page))->render('print_page', TRUE);
    }

    public function _install() {
        $this->db->where('name', 'print_data');
        $this->db->update('components', array('enabled' => 1));
    }

    public function _deinstall() {
        if ($this->dx_auth->is_admin() == FALSE)
            exit;
    }

}

/* End of file user_support.php */
