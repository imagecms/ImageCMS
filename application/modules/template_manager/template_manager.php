<?php

namespace template_manager;

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
        $this->templateName = $this->db->get('settings')->row()->site_template;
    }

    public function index() {
        
    }

    public function autoload() {
        
    }


    public function __get($handler) {
        try {
            $template = new \template_manager\classes\Template($this->templateName);

            return ($template->components[$handler]) ? $template->components[$handler] : false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

    }

    public function _install() {
        $this->db->where('name', 'template_manager');
        $this->db->update('components', array('enabled' => 1, 'autoload' => 1));
    }

    public function _deinstall() {
        
    }

}

/* End of file templateManager.php */
