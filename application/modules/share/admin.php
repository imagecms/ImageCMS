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
        //$this->display_tpl('settings');
        $this->render('settings');
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
        if($this->input->post('action') == 'tomain')
            pjax('/admin/components/modules_table');
        showMessage("Настройки успешно сохранены");
    }
    
    public function get_settings()
    {
        $settings = ShopCore::app()->SSettings->getss_settings();
        return $settings;
    }
    
    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' . 'application/modules/share/templates/admin/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . 'application/modules/share/templates/admin/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/modules/share/templates/admin/' . $viewName);
    }

}