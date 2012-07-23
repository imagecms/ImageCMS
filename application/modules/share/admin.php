<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Comments admin
 */
class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        cp_check_perm('module_admin');
    }

    public function index() {
        $this->template->add_array(array(
            'settings' => $this->get_settings(),
        ));
        $this->display_tpl('settings');
    }

    private function display_tpl($file) {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }
    
    public function update_settings()
    {
        $data = $_POST['ss'];
        $string = serialize($data);
        ShopCore::app()->SSettings->set('ss', $string);
        showMessage("Настройки успешно сохранены");
    }
    
    public function get_settings()
    {
        $settings = ShopCore::app()->SSettings->getss_settings();
        return $settings;
    }

}