<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use template_manager\classes\TemplateManager;
use template_manager\legacy\DemodataMigrationsControl;

/**
 * Image CMS
 * Module template_manager
 */
class template_manager extends \MY_Controller {

    private $templateModel;

    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('template_manager');

        $this->load->config('demodata');

        $this->templateName = $this->db->get('settings')->row()->site_template;

        $this->templateModel = TemplateManager::getInstance()->getCurentTemplate();

        \CMSFactory\Events::create()->setListener([new DemodataMigrationsControl, 'run'], TemplateManager::EVENT_DEMODATA_INSTALLED);
    }

    /**
     * Index page
     */
    public function index() {
        $this->core->error_404();
    }

    public function autoload() {
        // assigning template object

        if (defined('UNIT_TESTS')) {
            unset($this->templateModel->xml);
            unset($this->templateModel->mainImage);
        }

        if (SHOP_INSTALLED == true) {
            $this->template->assign('template', $this->templateModel);
            $this->template->assign('colorScheme', 'css/' . CI::$APP->load->module('template_manager')->getComponent('TColorScheme')->getColorSheme());
        }

        // load template helpers
        if ($this->templateModel->isTMCompatible()) {
            $this->loadTemplateHelpers($this->templateModel->name);
        }
    }

    public function current_template_mainimage() {
        header('Content-Type: image/jpeg');
        echo file_get_contents(site_url($this->templateModel->mainImage));
    }

    /**
     * Load template helpers
     * @param string $templateName - curent template name
     */
    private function loadTemplateHelpers($templateName = NULL) {
        if ($templateName) {
            $helpers_path = TEMPLATES_PATH . $templateName . '/helpers';
            if (file_exists($helpers_path)) {
                foreach (new DirectoryIterator($helpers_path) as $helper) {
                    if (!$helper->isDir() && !$helper->isDot() && $helper->getExtension() == 'php' && strstr($helper->getFilename(), '_helper')) {
                        include_once $helper->getPathname();
                    }
                }
            }
        }
    }

    /**
     * Get componeet object
     * @param type $handler - component class name
     * @return TComponent
     */
    public function getComponent($handler) {
        $template = new \template_manager\classes\Template($this->templateName);
        return $template->getComponent($handler);
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