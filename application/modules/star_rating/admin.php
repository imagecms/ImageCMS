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
        $obj = new MY_Lang();
        $obj->load('star_rating');
        
    }

    public function index() {
        
        $get_settings = $this->rating_model->get_settings();
        $settings = json_decode($get_settings['settings']);
        $this->template->add_array(array(
            'settings' => $settings,
            'is_shop' => $this->rating_model->is_shop(),
        ));
        \CMSFactory\assetManager::create()
                ->renderAdmin('settings');
//        $this->render('settings');
    }

    public function update_settings() {
        $settings= json_encode($_POST['sr']);
        
        $this->rating_model->update_settings($settings);
        
        if ($this->input->post('action') == 'tomain')
            pjax('/admin/components/modules_table');
        $this->lib_admin->log(lang("Star rating was edited", "star_rating"));
        showMessage(lang("Settings saved success", 'star_rating'));
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' .  realpath(dirname(__FILE__)) . '/templates/admin/' . $viewName);
        exit;
    }
    
}
