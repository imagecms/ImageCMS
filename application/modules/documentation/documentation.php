<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Documentation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('documentation');
        $this->load->model('documentation_model');
    }

    public function create_new_page() {
        $this->template->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW");
        
        if ($this->dx_auth->is_admin()) {
            \CMSFactory\assetManager::create()
                    ->registerStyle('style', TRUE)
                    ->setData('errors', $this->errors)
                    ->render('create_new_page');
        }
        else
            $this->core->error_404();
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
