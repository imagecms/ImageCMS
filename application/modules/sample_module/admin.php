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
        $template = \CMSFactory\assetManager::create();
        $template->fetchData(array('debug' => 'DEBUG VARIABLE'));
        $template->registerScript('jstest');
        $template->registerStyle('csstest');
        $template->renderAdmin('index');
    }

}