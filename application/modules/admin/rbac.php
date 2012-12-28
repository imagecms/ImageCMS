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

    public function roleCreate() {

        Permitions::roleCreate();
    }

    public function roleList() {

        Permitions::roleList();
    }

    public function roleEdit($roleId) {

        Permitions::roleEdit($roleId);
    }

    public function roleDelete() {

        Permitions::roleDelete();
    }

    public function privilegeList() {

        Permitions::privilegeList();
    }

    public function privilegeEdit($id) {

        Permitions::privilegeEdit($id);
    }

    public function privilegeCreate() {

        Permitions::privilegeCreate();
    }

}

?>
