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
        $this->mod_advice->delimages();
        $this->mod_advice->delimagesadd();
    }

    public function index() {
        CMSFactory\assetManager::create()
                ->setData('countOldImages', count($this->mod_advice->buildImagesList()) + count($this->mod_advice->buildImagesAdditionalList()))
                ->setData('oldImages', $this->mod_advice->buildImagesList())
                ->setData('oldAdditionalImages', $this->mod_advice->buildImagesAdditionalList())
                ->registerScript('script')
                ->renderAdmin('main');
    }

}