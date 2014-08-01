<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

//namespace Export;

class Export extends \ShopAdminController {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function test(){
        echo json_encode('hello');
    }
    
}
