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

    public function autoload() {
        $mobileSettings = unserialize(ShopCore::app()->SSettings->MobileVersionSettings);
        if ($mobileSettings['MobileVersionON'] === true && str_replace('www.', '', $_SERVER['HTTP_HOST']) == $mobileSettings['MobileVersionAddress']) {
            $mobPath = ShopCore::app()->SSettings->mobileTemplatePath;
            if ($mobPath) {
                ShopCore::$template_path = set_realpath($mobPath);
                $mobPath = str_replace('shop', '', $mobPath);
//                $this->template_path = set_realpath($mobPath);
                $this->template->set_config_value('tpl_path', set_realpath($mobPath));
                $this->template->add_array(array(
                    'SHOP_THEME' => media_url(ShopCore::app()->SSettings->mobileTemplatePath) . '/',
                    'THEME' => media_url($mobPath) . '/',)
                );
                $this->menu->template->template_dir = $mobPath;
            }
        }
    }

    /**
     * Install module
     */
    public function _install() {
        $this->db->where('name', 'mobile_version');
        $this->db->update('components', array('autoload' => 1));
    }

}
