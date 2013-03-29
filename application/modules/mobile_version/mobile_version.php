<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 */
class Mobile_version extends MY_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->helper('path');
    }

    public function autoload() {

        $mobileSettings = unserialize(ShopCore::app()->SSettings->MobileVersionSettings);
        if ($mobileSettings['MobileVersionON'] === true && str_replace('www.', '', $_SERVER['HTTP_HOST']) == $mobileSettings['MobileVersionAddress']) {
            $mobPath = ShopCore::app()->SSettings->mobileTemplatePath;
            if ($mobPath){
                $mobPath = str_replace('shop', '', $mobPath);
                $this->template->set_config_value('tpl_path', set_realpath($mobPath));
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
