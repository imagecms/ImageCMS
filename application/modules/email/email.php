<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Emails
 */
class Email extends email\classes\ParentEmail {

    public function __construct() {
        parent::__construct();
        $this->load->model('email_model');
    }

    public function index() {

    }

    public function autoload() {

    }

    public function _install() {
        $this->email_model->install();
        
    }

    public function _deinstall() {
         $this->email_model->deinstall();
    }

}

/* End of file sample_module.php */
