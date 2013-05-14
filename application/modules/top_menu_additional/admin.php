<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        include 'application/modules/top_menu_additional/helpers/top_menu_additional_helper.php';
    }

    public function index() {
        if ($_POST){
            $this->db->query ('delete from top_menu_additional');
            $this->db->insert ('top_menu_additional',array('settings'=> json_encode($_POST)));
            showMessage('Дание сохранены');
            exit();
        }
        
        $menu_settings = $this->db->get('top_menu_additional')->result_array();
        $menu_settings = json_decode($menu_settings[0]['settings']);
        if ($menu_settings)
            \CMSFactory\assetManager::create()->setData('menu',$menu_settings);
        \CMSFactory\assetManager::create()->setData('pages',$this->db->where('lang_alias', 0)->get('content')->result_array())
                ->renderAdmin('main');
    }



}

/* End of file admin.php */