<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        cp_check_perm('module_admin');
    }

    public function index() {
        $query = $this->db->get('trash');
        $this->template->add_array(array('model' => $query->result()));
        if (!$this->ajaxRequest)
            $this->display_tpl('main');
    }

    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

}

/* End of file admin.php */