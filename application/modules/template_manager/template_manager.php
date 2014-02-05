<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module template_manager
 */
class template_manager extends MY_Controller {



    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('template_manager');
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

/* End of file templateManager.php */
