<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
    }

    public function index() {
        $settings = $this->db->select('settings')
                ->where('identif', 'socAuth')
                ->get('components')
                ->row_array();

        $this->template->add_array(array('settings' => unserialize($settings[settings])));
        if (!$this->ajaxRequest)
            $this->display_tpl('settings');
    }

    public function update_settings() {
        var_dump($_POST);
        $this->db->where('identif', 'socAuth')
                ->update('components', array('settings' => serialize($_POST)));

        showMessage("Настройки сохранены");
    }

    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

}

/* End of file admin.php */