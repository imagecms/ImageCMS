<?php

class Rbac extends BaseAdminController {

    function __construct() {

//        parent::__construct();
        $this->load->library('DX_Auth');
        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();
    }

    public function groupList() {

        Permitions::groupList();
    }

    public function groupEdit($id) {

        Permitions::groupEdit($id);
    }

    public function groupCreate() {

        Permitions::groupCreate();
    }

}

?>
