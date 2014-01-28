<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Module_frame extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('module_frame');
    }

    public function index() {
        $data = array(
            'product_name' => 'sd',
            'currency' => '2',
            'category_id' => '52',
            'price_in_main' => '2.3',
//            'mainImage'=> 'http://upload.wikimedia.org/wikipedia/commons/2/22/Turkish_Van_Cat.jpg',
        );

          \Products\ProductApi::getInstance()->addProduct($data);
          echo \Products\ProductApi::getInstance()->getError();
       
    }

    public function autoload() {
        
    }

    public function _install() {
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
        /**
          $this->db->where('name', 'module_frame')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         */
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
