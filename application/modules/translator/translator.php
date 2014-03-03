<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Translator Module 
 */
class Translator extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->core->error_404();
    }

    public function autoload() {
        
    }

    public function _install() {
        ($this->dx_auth->is_admin()) OR exit;

        $this->db->where('name', 'translator')
                ->update('components', array(
                    'autoload' => '1',
                    'enabled' => '1',
                    'settings' => serialize(array('originsLang' => 'en', 'editorTheme' => 'chrome'))
        ));
    }

    public function _deinstall() {
        ($this->dx_auth->is_admin()) OR exit;

        $this->db->where('name', 'translator')->delete('components');
    }

}

/* End of file sample_module.php */
