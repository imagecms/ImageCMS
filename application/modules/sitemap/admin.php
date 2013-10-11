<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();
         $lang = new MY_Lang();
        $lang->load('sitemap');

        $this->load->library('DX_Auth');
        //cp_check_perm('module_admin');
    }

    function index() {

        $this->render('settings', array(
            'settings' => $this->_load_settings(),
            'changefreq_options' => array(
                'always' => lang('always', 'sitemap'),
                'hourly' => lang('hourly', 'sitemap'),
                'daily' => lang('daily', 'sitemap'),
                'weekly' => lang('weekly', 'sitemap'),
                'monthly' => lang('monthly', 'sitemap'),
                'yearly' => lang('yearly', 'sitemap'),
                'never' => lang('never', 'sitemap')
                )
        ));
    }

    public function _load_settings() {
        return $this->load->module('sitemap')->_load_settings();
    }

    public function update_settings() {
        if (!$this->input->post('sendXML'))
            $XMLDataMap = array(
                'main_page_priority' => $this->input->post('main_page_priority'),
                'cats_priority' => $this->input->post('cats_priority'),
                'pages_priority' => $this->input->post('pages_priority'),
                'main_page_changefreq' => $this->input->post('main_page_changefreq'),
                'categories_changefreq' => $this->input->post('categories_changefreq'),
                'pages_changefreq' => $this->input->post('pages_changefreq'),
                'product_changefreq' => $this->input->post('product_changefreq'),
                'sendXML' => 'false',
                'lastSend' => time()
            );
        else
            $XMLDataMap = array(
                'main_page_priority' => $this->input->post('main_page_priority'),
                'cats_priority' => $this->input->post('cats_priority'),
                'pages_priority' => $this->input->post('pages_priority'),
                'main_page_changefreq' => $this->input->post('main_page_changefreq'),
                'categories_changefreq' => $this->input->post('categories_changefreq'),
                'pages_changefreq' => $this->input->post('pages_changefreq'),
                'product_changefreq' => $this->input->post('product_changefreq'),
                'sendXML' => $this->input->post('sendXML'),
                'lastSend' => time()
            );

        $this->db->limit(1);
        $this->db->where('name', 'sitemap');
        $this->db->update('components', array('settings' => serialize($XMLDataMap)));

        showMessage(lang("Changes have been saved", 'sitemap'));
    }

    /**
     * Display template file
     */
    public function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    /**
     * Fetch template file
     */
    public function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' . 'application/modules/sitemap/templates/admin/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . 'application/modules/sitemap/templates/admin/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/modules/sitemap/templates/admin/' . $viewName);
    }

}

/* End of file admin.php */
