<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * To add the button "Print" for the page you want to place in the template:
 * {$CI->load->module('print_data')->render_button(array('id' => $page_id))}
 *
 * To add the button "Print" for the product you want to place in the template:
 * {$CI->load->module('print_data')->render_button(array('id' => $product_id,'var' => $variant_id))}
 *
 * Print data module
 *
 */
class Print_data extends MY_Controller {

    public $no_install = true;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('print_data');
        if (count($this->db->where('name', 'print_data')->get('components')->result_array()) == 0)
            $this->no_install = false;

        $this->load->module('core');
    }

    /**
     * Render Print Button
     * @param array $data
     */
    public function render_button($data) {
        /*
         * $data - масив даних для друку (для товару id, var) (для сторінок id)
         * $type - тип сторінки для друку
         */
        $type = $this->core->core_data['data_type'];

        if (!$this->no_install)
            return false;
        \CMSFactory\assetManager::create()->registerScript('script');
        \CMSFactory\assetManager::create()->registerStyle('style');
        switch ($type) {
            case 'product':
                $href = "/" . $this->get_main_lang('identif') . "/print_data/print_" . $type . "/" . $data['id'] . "/" . $data['var'];
                break;
            case 'page':
                $href = "/" . $this->get_main_lang('identif') . "/print_data/print_" . $type . "/" . $data['id'];
                break;

            default:
                break;
        }
        \CMSFactory\assetManager::create()->setData(array('href' => $href))->render('button', TRUE);
    }

    /**
     * Print Product
     * @param int $id
     * @param int $var
     */
    public function print_product($id, $var) {
        if (!$this->no_install)
            return false;
        $product = SProductsQuery::create()->joinWithI18n(MY_Controller::getCurrentLocale())->findPk($id);
        $variant = SProductVariantsQuery::create()->joinWithI18n(MY_Controller::getCurrentLocale())->findPk($var);
        \CMSFactory\assetManager::create()->registerStyleWithoutTemplate('style');
        \CMSFactory\assetManager::create()->setData(array('product' => $product, 'variant' => $variant))->render('print_product', TRUE);
    }

    /**
     * Print Page
     * @param int $id
     */
    public function print_page($id) {
        if (!$this->no_install)
            return false;
        $page = get_page($id);
        \CMSFactory\assetManager::create()->registerStyleWithoutTemplate('style');
        \CMSFactory\assetManager::create()->setData(array('page' => $page))->render('print_page', TRUE);
    }

    /**
     * Install module
     */
    public function _install() {
        $this->db->where('name', 'print_data');
        $this->db->update('components', array('enabled' => 1));
    }

    /**
     * Deinstall module
     */
    public function _deinstall() {
        if ($this->dx_auth->is_admin() == FALSE)
            exit;
    }

    public function get_main_lang($flag = null) {
        $lang = $this->db->get('languages')->result_array();
        $lan_array = array();
        foreach ($lang as $l) {
            $lan_array[$l['identif']] = $l['id'];
            $lan_array_rev[$l['id']] = $l['identif'];
        }

        $lang_uri = $this->uri->segment(1);
        if (in_array($lang_uri, $lan_array_rev)) {
            $lang_id = $lan_array[$lang_uri];
            $lang_ident = $lang_uri;
        } else {
            $lang = $this->db->where('default', 1)->get('languages')->result_array();
            $lang_id = $lang[0]['id'];
            $lang_ident = $lang[0]['identif'];
        }
        if ($flag == 'id')
            return $lang_id;
        if ($flag == 'identif')
            return $lang_ident;
        if ($flag == null)
            return array('id' => $lang_id, 'identif' => $lang_ident);
    }

}

/* End of file user_support.php */
