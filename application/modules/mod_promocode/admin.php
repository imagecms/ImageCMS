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
        $lang->load('mod_promocode');
    }

    public function index() {
        $id_custom_field = $this->db->where('identif', 'mod_promocode')->get('components')->row()->settings;
        $codes = $this->db->get('mod_promocode')->result_array();
        
        \CMSFactory\assetManager::create()
                ->setData('id_custom_field', $id_custom_field)
                ->setData('codes', $codes)
                ->renderAdmin('main');
        
    }
    
    public function fDel() {
        if ($this->input->post('id')) {
            $this->db->where('id',$this->input->post('id'))->delete('mod_promocode');
            showMessage(lang('Элемент удалён','mod_promocode'));
        }
    }
    
    public function fAdd() {
        if ($this->input->post('code')) {
            $this->db->insert('mod_promocode',array('value' => $this->input->post('code'), 'disc' => $this->input->post('disc')));
            echo $this->db->order_by('id','desc')->get('mod_promocode')->row()->id;
            
        }else {
            showMessage(lang('Промокод пуст','mod_promocode'),'','r');            
        }
        
        
    }
    
    public function save() {
        $this->db->where('identif', 'mod_promocode')->update('components', array('settings'=>$this->input->post('id_custom_field')));
        showMessage(lang('Сохранено','mod_promocode'));
    }

}