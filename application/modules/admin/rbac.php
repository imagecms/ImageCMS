<?php

class Rbac extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->library('DX_Auth');
        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();
        $url = $this->uri->segment(3);

        switch ($url) {
            case 'permition_denied':
                $this->permition_denied();
                exit();
            case 'not_installed_module_error':
                $this->not_installed_module_error();
                exit();
        }

        $data = $this->uri->segment(4);
        $lang = $this->uri->segment(5);
        Permitions::$url($data, $lang);
        exit();
    }

    public function permition_denied() {
        $this->template->show('permition_error');
    }

    public function not_installed_module_error() {
        $this->template->show('not_installed_module_error');
    }

    public function index() {
        
    }

}

?>
