<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module template_manager
 */
class template_manager extends \MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('template_manager');
        $this->templateName = $this->db->get('settings')->row()->site_template;
    }

    public function index() {
        
    }

    public function autoload() {
        $schema = $this->getComponent('TColorScheme')->getParam('color_scheme');
        $this->template->assign('colorScheme', $schema['value']);
    }

    public function getComponent($handler) {
        try {
            $template = new \template_manager\classes\Template($this->templateName);
            return ($template->getComponent($handler)) ? $template->getComponent($handler) : false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Install module
     */
    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'component' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'key' => array(
                'type' => 'Text',
                'null' => TRUE
            ),
            'data' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('template_settings');

        $this->db->where('name', 'template_manager');
        $this->db->update('components', array('enabled' => 1, 'autoload' => 1));
    }

    /**
     * Deinstall module
     */
    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $this->dbforge->drop_table('template_settings');
        $this->db->where('name', 'template_manager')->delete('components');
    }

}

/* End of file templateManager.php */
