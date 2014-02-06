<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Translator Module 
 */
class Translator extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        \Products\ProductApi::getInstance()->addProduct();
        var_dumps_exit(\Products\ProductApi::getInstance()->getError());
    }

    public function index() {
        
    }

    public function autoload() {
        
    }

    public function _install() {
        $this->db->where('name', 'translator')
                ->update('components', array(
                    'autoload' => '1',
                    'enabled' => '1',
                    'settings' => serialize(array('originsLang' => 'en', 'editorTheme' => 'chrome'))
        ));
    }

    public function _deinstall() {
        
    }

}

/* End of file sample_module.php */
