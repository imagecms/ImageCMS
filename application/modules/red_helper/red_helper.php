<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * RedHelper
 * @property red_helper_model $red_helper_model
 */
class Red_helper extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('red_helper');
        $this->load->model('red_helper_model');
    }

    public function index() {
    }
    
    public function validate() {
        
        $this->load->library('form_validation');
        $config = array(
               array(
                     'field'   => 'login1', 
                     'label'   => 'login', 
                     'rules'   => 'required|min_length[3]'
                  ),   
               array(
                     'field'   => 'phone', 
                     'label'   => 'phone', 
                     'rules'   => 'required|numeric'
                  )
            );
       $this->form_validation->set_rules($config);
       $this->form_validation->run();
       $this->form_validation->set_error_delimiters('', ''); 
       echo (validation_errors());
       }
    
    public function autoload() {
        $set = $this->red_helper_model->getSettings();
        if ($set['login']) {
            $this->template->registerJsScript('<!-- RedHelper -->
<script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
 src="https://web.redhelper.ru/service/main.js?c=' . $set['login'] . '">
</script> 
<!--/Redhelper -->');
        }
    }

    public function _install() {
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        $this->load->dbforge();

//        $fields = array(
//            'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
//            'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
//            'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
//        );
//
//        $this->dbforge->add_key('id', TRUE);
//        $this->dbforge->add_field($fields);
//        $this->dbforge->create_table('mod_empty', TRUE);


        $this->db
                ->where('name', 'red_helper')
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

/* End of file red_helper.php */
