<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cache_all extends BaseAdminController
{

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('form_validation');
        $this->lib_admin->init_settings();
    }

    public function index() {

        $this->template->assign('allFile', $this->cache->cache_file());

        $langs = $this->cms_admin->get_langs();

        $this->template->assign('langs', $langs);
        $this->template->show('cache_all', FALSE);
    }

}

/* End of cache.php */