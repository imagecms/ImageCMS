<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->registerScript('jstest')
                ->registerStyle('csstest')
                ->renderAdmin('index');
    }

}