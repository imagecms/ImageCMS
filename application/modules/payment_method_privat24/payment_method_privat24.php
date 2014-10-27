<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Sample
 */
class Payment_method_privat24 extends MY_Controller {

    public $paymentMethod;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_liqpay');
    }
    
    public function index() {
        
    }

}

/* End of file sample_module.php */
