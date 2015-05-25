<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Comments admin
 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('share');

        $this->load->library('DX_Auth');
        //cp_check_perm('module_admin');
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->setData('settings', $this->get_settings())
                ->renderAdmin('settings');
    }

    public function update_settings() {
        $data = $_POST['ss'];
        $string = serialize($data);

        $this->db->set('settings', $string);
        $this->db->where('name', 'share');
        $this->db->update('components');

        if ($this->input->post('action') == 'tomain') {
            pjax('/admin/components/modules_table');
        }
        
        $this->lib_admin->log(lang("Social buttons was updated", "share"));

        showMessage(lang('Settings successfully saved', 'share'));
    }

    public function get_settings() {
        $this->db->select('settings');
        $this->settings = unserialize(implode(',', $this->db->get_where('components', array('name' => 'share'))->row_array()));
        return $this->settings;
    }

}
