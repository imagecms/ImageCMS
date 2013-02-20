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

        $this->load->library('DX_Auth');
        //cp_check_perm('module_admin');
    }

    public function index() {
        $get_settings = $this->get_settings();
        $settings = json_decode($get_settings['settings']);
        $this->template->add_array(array(
            'settings' => $settings,
            'is_shop' => $this->is_shop(),
        ));
        $this->render('settings');
    }

    public function update_settings() {
        $settings= json_encode($_POST['sr']);

        $this->db->set('settings', $settings);
        $this->db->where('name', 'star_rating');
        $this->db->update('components');
        
        if ($this->input->post('action') == 'tomain')
            pjax('/admin/components/modules_table');
        showMessage("Настройки успешно сохранены");
    }

    public function get_settings() {
        $settings = $this->db->select('settings')->where('name','star_rating')->get('components')->row_array();
        return $settings;
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' . 'application/modules/star_rating/assets/admin/' . $viewName);
        exit;

//        if ($return === false)
//            $this->template->show('file:' . 'application/modules/star_rating/templates/admin/' . $viewName);
//        else
//            return $this->template->fetch('file:' . 'application/modules/star_rating/templates/admin/' . $viewName);
    }
    
    
    
    private function is_shop()
    {
        $res = $this->db->where('name','star_rating')->get('components')->row();
        return $res; 
    }
            

}