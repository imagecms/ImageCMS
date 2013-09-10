<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Template Editor Module
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();

        $lang = new MY_Lang();
        $lang->load('template_editor');
        //cp_check_perm('module_admin');
        //TEMPLATES_PATH
        $this->load->helper('directory');
    }

    // Find templates and redner list of first template folder
    public function index() {
        $this->render('index');
    }

    public function render($tpl) {
        if ($this->ajaxRequest)
            echo $this->fetch_tpl($tpl);
        else
            $this->display_tpl($tpl);
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file admin.php */
