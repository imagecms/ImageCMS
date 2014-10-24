<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Payment_method_robokassa extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_robokassa');
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
