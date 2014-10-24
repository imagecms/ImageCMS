<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Yandex Money Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('payment_method_yandexmoney');
    }

    public function index() {
        
    }

}