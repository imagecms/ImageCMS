<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();

        $lang = new MY_Lang();
        $lang->load('yandex_maps');
    }

    public function index() {
        $this->db->truncate('mod_yandex_maps');
        showMessage(lang('Addresses were updated', 'yandex_maps'));
        pjax('/admin/components');
    }

}
