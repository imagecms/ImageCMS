<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Comments admin
 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        //cp_check_perm('module_admin');
    }

    public function index() {
        $this->render('settings', array(
            'settings' => $this->get_fsettings(),
            'templates' => $this->_get_templates(),
            'vsettings' => $this->get_vsettings()
                
                ));
    }

    public function update_settings() {
        $data = $_POST['facebook'];
        $vdata = $_POST['vk'];
        $string = serialize($data);
        $vstring = serialize($vdata);
        ShopCore::app()->SSettings->set('facebook_int', $string);
        ShopCore::app()->SSettings->set('vk_int', $vstring);
        showMessage("Настройки успешно сохранены");
    }

    public function get_fsettings() {
        $settings = ShopCore::app()->SSettings->__get('facebook_int');
        $settings = unserialize($settings);
        return $settings;
    }

    public function get_vsettings() {
        $settings = ShopCore::app()->SSettings->__get('vk_int');
        $settings = unserialize($settings);
        return $settings;
    }

    function _get_templates() {
        $new_arr = array();
        if ($handle = opendir(TEMPLATES_PATH)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != 'administrator' && $file != 'modules') {
                    if (!is_file(TEMPLATES_PATH . $file)) {
                        $new_arr[$file] = $file;
                    }
                }
            }
            closedir($handle);
        } else {
            return FALSE;
        }
        return $new_arr;
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' . 'application/modules/social_servises/templates/admin/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . 'application/modules/social_servises/templates/admin/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/modules/social_servises/templates/admin/' . $viewName);
    }

}