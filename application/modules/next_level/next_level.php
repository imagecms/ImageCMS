<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Next_level extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('next_level_model');
    }

    public function index() {
        
    }

    public function autoload() {
        
    }
    
    public function getPropertyTypes($property_id){
        return $this->next_level_model->getPropertyTypes($property_id);
    }

    public function _install() {
        
        $this->load->dbforge();
        
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'property_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
             'name' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => FALSE
            )            
        );


        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_next_level_product_properties_types');
        
        $this->db
                ->where('identif', 'next_level')
                ->update('components', array(
                    'settings' => serialize(
                            array(
                                'propertiesTypes' => array('scroll','full','dropDown')
                            )
                    ),
                    'enabled' => 1,
                    'autoload' => 1
        ));

        
          $this->db->where('name', 'next_level')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         
    }

    public function _deinstall() {
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_next_level_product_properties_types');
    }

}

/* End of file sample_module.php */
