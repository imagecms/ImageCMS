<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_advice');
        $this->load->module('mod_advice');
    }

    public function del() {
        $this->mod_advice->_delimages();
    }

    public function index() {
        CMSFactory\assetManager::create()
                ->setData('countOldImages', count($this->mod_advice->_buildImagesList(), COUNT_RECURSIVE))
                ->setData('oldImages', $this->mod_advice->_buildImagesList())
                ->registerScript('script')
                ->renderAdmin('main');
    }

}