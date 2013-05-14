<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
    }

    /**
     * get settings from db and display settings.tpl
     */
    public function index() {
        $settings = $this->db->select('settings')
                ->where('identif', 'socauth')
                ->get('components')
                ->row_array();

        $this->template->add_array(array('settings' => unserialize($settings[settings])));
        if (!$this->ajaxRequest)
            $this->display_tpl('settings');
    }

    /**
     * update settings
     */
    public function update_settings() {
        $result = array_map('trim', $_POST);

        $this->db->where('identif', 'socauth')
                ->update('components', array('settings' => serialize($result)));

        showMessage("Настройки сохранены");
        pjax($_SERVER[HTTP_REFERER]);
    }

    /**
     * 
     * @param string $file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

}

/* End of file admin.php */