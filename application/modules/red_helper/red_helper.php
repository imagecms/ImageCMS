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
                     'field'   => 'pass', 
                     'label'   => 'pass', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'email', 
                     'label'   => 'email', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'phone', 
                     'label'   => 'phone', 
                     'rules'   => 'required|numeric'
                  )
            );
       $this->form_validation->set_rules($config);
       $this->form_validation->run();
       $this->form_validation->set_error_delimiters('<p>', '</p>'); 
       $err = $res = array();
       preg_match_all('#<p>(.+?)</p>#is', validation_errors(), $err);
//       var_dump($err);
//       exit();
       $res = $this->parseErrors($err[0]);
       //echo json_encode(validation_errors());
       echo json_encode($res);
   }
    
    public function autoload() {
        $set = $this->red_helper_model->getSettings();
        if ($set['login']) {
            $this->template->registerJsScript('<!-- RedHelper -->
                <script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
                 src="https://web.redhelper.ru/service/main.js?c=' . $set['login'] . '">
                </script> 
                <!--/Redhelper -->'
            );
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
    
    private function parseErrors($err) {
        $str = "";
        $tmp = array();
        foreach($err as $v) {
            $str .= $v;
        }
        if(strpos($str,'login')){
            $tmp[0] = "<p>Поле login является обязательным.</p>";
        } else {
            $tmp[0] = "";
        }
        if(strpos($str,'pass')){
            $tmp[1] = "<p>Поле pass является обязательным.</p>";
        } else {
            $tmp[1] = "";
        }
        if(strpos($str,'email')){
            $tmp[2] = "<p>Поле email является обязательным.</p>";
        } else {
            $tmp[2] = "";
        }
        if(strpos($str,'phone является')){
            $tmp[3] = "<p>Поле phone является обязательным.</p>";
        } else if(strpos($str,'phone должно')) {
            $tmp[3] = "<p>Поле phone должно содержать только цифры.</p>";
        } else {
            $tmp[3] = "";
        }
        return $tmp;
    }

}

/* End of file red_helper.php */
