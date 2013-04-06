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
        $this->load->model('rating_model');
    }

    public function index() {
        $get_settings = $this->rating_model->get_settings();
        $settings = json_decode($get_settings['settings']);
        $this->template->add_array(array(
            'settings' => $settings,
            'is_shop' => $this->rating_model->is_shop(),
        ));
        $this->render('settings');
    }

    public function update_settings() {
        $settings= json_encode($_POST['sr']);
        
        $this->rating_model->update_settings($settings);
        
        if ($this->input->post('action') == 'tomain')
            pjax('/admin/components/modules_table');
        showMessage("Настройки успешно сохранены");
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' . 'application/modules/star_rating/assets/admin/' . $viewName);
        exit;
    }
    
}