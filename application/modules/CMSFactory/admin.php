<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        cp_check_perm('module_admin');
    }

    public function index() {
        \CMSFactory\assetManager::create()->renderAdmin('index');
    }

}