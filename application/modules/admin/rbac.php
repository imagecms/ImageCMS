<?php

class Rbac extends BaseAdminController {

    function __construct() {
        $this->load->library('DX_Auth');
        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();
        $url = $this->uri->segment(3);
        $data = $this->uri->segment(4);
        $lang = $this->uri->segment(5);
        Permitions::$url($data, $lang);
        exit();
    }

}

?>
