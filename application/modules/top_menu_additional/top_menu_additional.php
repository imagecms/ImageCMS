<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 */
class Top_menu_additional extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->module('core');

        if (count($this->db->where('name', 'top_menu_additional')->get('components')->result_array()) == 0)
            $this->no_install = false;
    }

    public function index() {
        $this->core->error_404();
    }

    public function autoload() {
        if ($row != null) {
            ($row->parse_redirect_type != '404') OR $this->core->error_404();
            redirect($row->parse_redirect, 'location', $row->parse_type);
        }
    }

    public function _install() {
        $sql = "CREATE TABLE IF NOT EXISTS `top_menu_additional` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `settings` text CHARACTER SET utf8 NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;";

        $this->db->query($sql);
        $this->db->where('name', 'top_menu_additional');
        $this->db->update('components', array('enabled' => 0, 'autoload' => 1));
    }

    public function render() {
        if ($this->no_install === false)
            return false;
        $menu_settings = $this->db->get('top_menu_additional')->result_array();
        $menu_settings = json_decode($menu_settings[0]['settings']);


        CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->registerScript('scripts');

        $template = $menu_settings->menu_template;
        
        if ($menu_settings->statil)
            $template = str_replace ('fixed', '', $template);
        if (strstr($template, '#menu_delivery') && $menu_settings->del->href) {
            $delivery = $this->get_content($menu_settings->del->href);
            $template = str_replace('#menu_delivery', $delivery, $template);
        }

        if (strstr($template, '#menu_contacts') && $menu_settings->cont->href) {
            $contacts = $this->get_content($menu_settings->cont->href);
            $template = str_replace('#menu_contacts', $contacts, $template);
        }

        if (strstr($template, '#menu_payment') && $menu_settings->pay->href) {
            $payment = $this->get_content($menu_settings->pay->href);
            $template = str_replace('#menu_payment', $payment, $template);
        }

        if (strstr($template, '#cart_data')) {
            $cart = $this->get_content('cart');
            $template = str_replace('#cart_data', $cart, $template);
        }
        if (strstr($template, '#tel_block')) {
            $tel = $this->get_content('phone');
            $template = str_replace('#tel_block', $tel, $template);
        }

        if (strstr($template, '#wish_data')) {
            $wish = $this->get_content('wish');
            $template = str_replace('#wish_data', $wish, $template);
        }

        if (strstr($template, '#compare_data')) {
            $compare = $this->get_content('compare');
            $template = str_replace('#compare_data', $compare, $template);
        }



        echo $this->clear($template);
    }

    public function get_content($id) {
        ob_start();
        if ((int) $id) {
            $page = $this->db->where('id', $id)->limit(1)->get('content')->result_array();
            \CMSFactory\assetManager::create()->setData('page', $page[0])->render('item_menu', TRUE);
        }
        else
            \CMSFactory\assetManager::create()->render($id . '_data', TRUE);

        return ob_get_clean();
    }

    public function clear($template) {

        $template = str_replace('#menu_payment', '', $template);
        $template = str_replace('#menu_contacts', '', $template);
        $template = str_replace('#menu_delivery', '', $template);
        $template = str_replace('#wish_data', '', $template);
        $template = str_replace('#compare_data', '', $template);
        $template = str_replace('#tel_block', '', $template);
        $template = str_replace('#cart_data', '', $template);

        return $template;
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('top_menu_additional');
    }

}

/* End of file parse.php */
