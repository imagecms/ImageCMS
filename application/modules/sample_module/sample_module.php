<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Sample
 */
class Sample_Module extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->fetchData(array('debug' => 'DEBUG VARIABLE'))
                ->registerStyle('csstest')
                ->registerScript('jstest')
                ->render('index');
    }

    public function autoload() {
        \CMSFactory\Events::create()->onShopCategoryEdit()->addСorrelation('read');
    }

    public function read($id) {
        var_dump($id);
    }

    public function _install() {
        /*
          if( $this->dx_auth->is_admin() == FALSE) exit;

          $this->load->dbforge();

          $fields = array(
          'id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'auto_increment' => TRUE,
          ),
          'param1' => array(
          'type' => 'INT',
          'constraint' => 11,
          ),
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('sample_table', TRUE);

          // Enable module autoload
          $this->db->where('name', 'sample_module');
          $this->db->update('components', array('autoload' => '1'));

          // Or
          $this->load->model('model_name');
          $this->model_name->make_install();
         */
    }

    // Delete module
    public function _deinstall() {
        /*
          if( $this->dx_auth->is_admin() == FALSE) exit;

          $this->load->dbforge();
          $this->dbforge->drop_table('sample_table');
         */
    }

}

/* End of file sample_module.php */
