<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class CMSFactory extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function autoload() {
        
    }

    public function _install() {
        ($this->dx_auth->is_admin()) OR exit;
        $this->db->where('name', 'cmsfactory');
        $this->db->update('components', array('name' => 'CMSFactory', 'identif' => 'CMSFactory'));
    }

}

/* End of file comments.php */
