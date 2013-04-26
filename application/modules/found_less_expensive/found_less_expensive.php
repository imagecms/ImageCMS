<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author Igor R.
 * @copyright ImageCMS (c) 2013, Igor R. <dev@imagecms.net>
 * 
 * Нашли дешевле
 */

class Found_less_expensive extends MY_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model('Found_less_expensive_model');
    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public function showButtonWithForm(){
       \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->registerScript('scripts')
                ->render('buttonWithForm', true);
    }
 
    public function save_message(){
        $data = $this->input->post();
        unset($data['cms_token']);
        if ($this->db->insert('mod_found_less_expensive',$data)){
            return 'success';
        }
        
    }

    /**
     * Install module
    */
    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '70',
                'null' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
            ),
            'question' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => TRUE,
            ),
            'link' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE,
            ),
            'processed' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE,
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_found_less_expensive');

        $this->db->where('name', 'found_less_expensive');
        $this->db->update('components', array(
            'enabled' => 1,
            'autoload' => 1));
    }

    /**
     * Deinstall module
     */
    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_found_less_expensive');
    }

}
