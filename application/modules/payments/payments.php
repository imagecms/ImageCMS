<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payments extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payments');
    }

    public function index() {
        
    }


    public function autoload() {
        
    }

    public function _install() {
        
    }

    public function _deinstall() {
        
    }

}

/* End of file sample_module.php */
