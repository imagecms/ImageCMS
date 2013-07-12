<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Next_level extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $properties = $this->select('id, name')->get('shop_product_properties_i18')->result_array();
        var_dumps($properties);
    }

    public function autoload() {
        
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
                'type' => 'ENUM',
                'constraint' => "'scroll','full','dropDown'",
                'default' => "full"
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

        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        /**
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_empty', TRUE);
         */
        
          $this->db->where('name', 'next_level')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }

}

/* End of file sample_module.php */
