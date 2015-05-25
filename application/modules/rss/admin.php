<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Rss Module Admin
 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('rss');

        $this->load->library('DX_Auth');
        //cp_check_perm('module_admin');
    }

    public function index() {
        $this->load->library('lib_category');
        $cats = $this->lib_category->build();

        $this->template->add_array(array(
            'cats' => $cats,
            'settings' => $this->get_settings()
        ));

        //$this->display_tpl('settings');
        $this->render('settings');
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

                $this->template->show('file:' . realpath(dirname(__FILE__)) . '/templates/admin/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . realpath(dirname(__FILE__)) . '/templates/admin/' . $viewName);
        else
            return $this->template->fetch('file:' . realpath(dirname(__FILE__)) . '/templates/admin/' . $viewName);
    }

    public function settings_update() {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'categories' => $this->input->post('categories'),
            'cache_ttl' => (int) $this->input->post('cache_ttl'),
            'pages_count' => (int) $this->input->post('pages_count'),
        );

        $this->db->where('name', 'rss');
        $this->db->update('components', array('settings' => serialize($data)));
        
        $this->lib_admin->log(lang("RSS was edited", "rss"));
        showMessage(lang("Changes have been saved", 'rss'));
    }

    private function get_settings() {
        return $this->load->module('rss')->_load_settings();
    }

    /**
     * Display template file
     */
    function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    /**
     * Fetch template file
     */
    function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file admin.php */
