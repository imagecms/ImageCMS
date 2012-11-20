<?php

class Sample_mail extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('email_model');
    }

    public function _install() {
        $this->email_model->install_samples();
    }
    
    public function _deinstall()
    {
        $this->email_model->deinstall();
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
