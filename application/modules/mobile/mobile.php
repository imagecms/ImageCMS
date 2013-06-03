<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Mobile version for Shop Module
 * @uses ShopController
 * @uses mobile.collection
 * @author Kaero <dev@imagecms.net>
 * @copyright (c) 2013, ImageCMS
 * @package Shop.ImageCMSModule
 */
class Mobile extends ShopController {

    public function __construct() {
        parent::__construct();
        $this->load->helper('path');
        $this->load->helper('mobile');
    }

    public function index() {
        $this->core->error_404();
    }

    /**
     * Emulatе category behavior
     * @return view
     * @author Kaero <dev@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function category() {
        \mobile\collection\Mobile_category::init();
    }

    /**
     * Emulatе product behavior
     * @return view
     * @author Kaero <dev@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function product() {
        \mobile\collection\Mobile_product::init();
    }

    /**
     * Emulatе user search behavior
     * @return view
     * @author Kaero <dev@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function search() {
        \mobile\collection\Mobile_search::init();
    }

    /**
     * get settings
     * @return view
     * @author Kaero <dev@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function get_settings() {
        $settings = $this->db->where('name', 'mobile')->get('components')->result_array();
        if ($settings)
            $this->settings = $settings[0]['settings'];
        else {
            'Ошибка настроек';
            exit;
        }
    }

    public function autoload() {
        $this->get_settings();
        $mobileSettings = unserialize($this->settings);
        if ($mobileSettings['MobileVersionON'] && str_replace('www.', '', $_SERVER['HTTP_HOST']) == $mobileSettings['MobileVersionAddress']) {
            $mobPath = $mobileSettings['mobileTemplatePath'];
            if ($mobPath) {
                ShopCore::$template_path = set_realpath($mobPath);
                $mobPath = str_replace('shop', '', $mobPath);
//                $this->template_path = set_realpath($mobPath);
                $this->template->set_config_value('tpl_path', set_realpath($mobPath));
                $this->template->add_array(array(
                    'SHOP_THEME' => media_url($mobileSettings['mobileTemplatePath']) . '/',
                    'THEME' => media_url($mobPath) . '/',
                    'settings' => $mobileSettings));
                $this->menu->template->template_dir = $mobPath;
            }
        }
    }

    /**
     * Install module
     */
    public function _install() {


        $this->db->where('name', 'mobile');
        $this->db->update('components', array('autoload' => 1));
    }

    public function _deinstall() {

        if ($this->dx_auth->is_admin() == FALSE)
            exit;

        $this->load->dbforge();
    }

}
